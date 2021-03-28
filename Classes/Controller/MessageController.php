<?php
namespace AshokaTree\Sms\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;

/***
 *
 * This file is part of the "Sms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Nirmalya Mondal <nirmalya.mondal@gmail.com>, https://ashokatree.net/
 *
 ***/

/**
 * MessageController
 */
class MessageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

/**
     * smsRepository
     * 
     * @var \AshokaTree\Sms\Domain\Repository\SmsRepository
     */
    protected $smsRepository = null;

    /**
     * @param \AshokaTree\Sms\Domain\Repository\SmsRepository $smsRepository
     */
    public function injectSmsRepository(\AshokaTree\Sms\Domain\Repository\SmsRepository $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        if (!function_exists('curl_init')){
            die('Sorry cURL is not installed!');
        }
        $allUsers = $this->auxGetAllFeusers();
        $this->view->assign('allUsers', $allUsers);
    }

    /**
     * action create
     * 
     * @param \AshokaTree\Sms\Domain\Model\Sms $newSms
     * @return void
     */
    public function createAction(\AshokaTree\Sms\Domain\Model\Sms $newSms)
    {   
        $smsData    = $newSms->getMessage();
        // Process message
        $smsDataSanitized = filter_var($smsData, FILTER_SANITIZE_STRING);
        $smsDataTags = strip_tags($smsDataSanitized);
        $smsDataTrim = trim($smsDataTags);
        $message = $smsDataTrim;
        $receivers  = $newSms->getTosms();    
        //$mobiles    = [];     
        foreach($receivers as $receiver) {
            $mobileNumber = $receiver->getUsername();
            if(!preg_match('#[^0-9]#', $mobileNumber) && (strlen($mobileNumber) == 10)  && ($message != '')) {
                $indiaMobileNumber = '+91'.$mobileNumber;
                $this->sendSmsCURL($indiaMobileNumber, $message);
            }
            //$mobiles[] = '+91'.$receiver->getUsername();
        }
        //print_r($mobiles);//die();

        $smsPid = $this->settings['smsPid'] ? $this->settings['smsPid'] : 25;
        $newSms->setPid($smsPid);
        $newSms->setFeuser($GLOBALS["TSFE"]->fe_user->user["uid"]);
        $newSms->setSendDate(new \DateTime());
        $this->addFlashMessage('New Sms has been Sent successfully!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->smsRepository->add($newSms);
        $this->redirect('new');
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $sms = $this->smsRepository->findAll();
        $this->view->assign('sms', $sms);
    }

    /**
     * action detail
     * 
     * @param \AshokaTree\Sms\Domain\Model\Sms $sms
     * @return void
     */
    public function detailAction(\AshokaTree\Sms\Domain\Model\Sms $sms)
    {
        $this->view->assign('sms', $sms);
    }

    /**
     * action edit
     * 
     * @param \AshokaTree\Sms\Domain\Model\Sms $sms
     * @return void
     */
    public function editAction(\AshokaTree\Sms\Domain\Model\Sms $sms)
    {
        $this->view->assign('sms', $sms);
    }

    /**
     * action update
     * 
     * @param \AshokaTree\Sms\Domain\Model\Sms $sms
     * @return void
     */
    public function updateAction(\AshokaTree\Sms\Domain\Model\Sms $sms)
    {
        $this->addFlashMessage('Sms "'.$sms->getUid().'-'.$sms->getMessage().'" have been updated.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->smsRepository->update($sms);
        $this->redirect('new');
    }

    /**
     * action delete
     * 
     * @param \AshokaTree\Sms\Domain\Model\Sms $sms
     * @return void
     */
    public function deleteAction(\AshokaTree\Sms\Domain\Model\Sms $sms)
    {
        $this->addFlashMessage('Sms "'.$sms->getUid().'-'.$sms->getMessage().'" have been deleted.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->smsRepository->remove($sms);
        $this->redirect('new');
    }
    
    /**
     * auxuliary function to initialize create action
     * 
     * @param void
     * @return users objects
     */
    public function initializeCreateAction()
      {
        /*$this->arguments->getArgument('mymodel')
            ->getPropertyMappingConfiguration()
            ->forProperty('mydate')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
                DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                'd.m.Y'
            );*/
    }

    //http://msg.adityabroadband.in/submitsms.jsp?user=Aditya12&key=&mobile=+919732623080&message=hello&senderid=ADITYA&accusage=1
    /**
     * Send SMS to users via CURL 
     *
     * @return bool
     */
    public function sendSmsCURL($mobile, $message)
    {
        //$user       = 'Aditya12';      
        //$senderid   = 'ADITYA';
        $baseUrl    = 'http://msg.adityabroadband.in/submitsms.jsp?accusage=1&user=Aditya12&senderid=ADITYA&key=';
        $url        = $baseUrl.'&mobile='.$mobile.'&message='.$message; //echo '$url='.$url; die();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);    // Set CURL Post Data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //comment out curl_setopt when NO ssl/ https
        //curl_setopt($ch, CURLOPT_SSLVERSION,3);
        $data = curl_exec($ch);
        $error = curl_error($ch); 
        curl_close($ch);
        // Use file get contents when CURL is not installed on server.
        if(!$data){
           $data =  file_get_contents($url);  
        }
        //die();
    }

    /**
     * auxuliary function
     * 
     * @param void
     * @return users objects
     */
    public function auxGetAllFeusers()
    {
        $userPid = $this->settings['userPid'] ? $this->settings['userPid'] : 12;
        $queryBuilder   = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $statement      = $queryBuilder
                               ->select('uid','username','name')
                               ->from('fe_users')
                               ->where($queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($userPid, \PDO::PARAM_STR)))
                               ->addOrderBy('name', 'ASC')
                               ->execute();
        $dataRow    = $statement->fetchAll();

        $newObjects = [];
        foreach ($dataRow as $key => $value) {
            $newObj = new \stdClass();
            $newObj->key = $value['uid'];
            $newObj->value = $value['name'].' - '.$value['username'];
            $newObjects[] = $newObj;
        }
    return $newObjects;

    }
    
}
