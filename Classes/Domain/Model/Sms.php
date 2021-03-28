<?php
namespace AshokaTree\Sms\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/***
 *
 * This file is part of the "Short Message Service" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Nirmalya Mondal <nirmalya.mondal@gmail.com>, Ashoka Tree
 *
 ***/
/**
 * Sms
 */
class Sms extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    
   /**
     * feuser
     * 
     * @var int
     */
    protected $feuser = 0;

    /**
     * Returns the feuser
     * 
     * @return int $feuser
     */
    public function getFeuser()
    {
        return $this->feuser;
    }

    /**
     * Sets the feuser
     * 
     * @param int $feuser
     * @return void
     */
    public function setFeuser($feuser)
    {
        $this->feuser = $feuser;
    }

    /**
     * fromsms
     * 
     * @var string
     */
    protected $fromsms = '';

    /**
     * Returns the fromsms
     * 
     * @return string fromsms
     */
    public function getFromsms()
    {
        return $this->fromsms;
    }

    /**
     * Sets the fromsms
     * 
     * @param string $fromsms
     * @return void
     */
    public function setFromsms($fromsms)
    {
        $this->fromsms = $fromsms;
    }    

    /**
     * senddate
     * 
     * @var \DateTime
     * 
     */
    protected $senddate;

    /**
     * Returns the senddate
     * 
     * @return \DateTime senddate
     */
    public function getSenddate()
    {
        return $this->senddate;
    }

    /**
     * Sets the senddate
     * 
     * @param \DateTime $senddate enddate
     * @return void
     */
    public function setSenddate($senddate)
    {
        $this->senddate = $senddate;
    }

    /**
     * message
     * 
     * @var string
     */
    protected $message = '';

    /**
     * Returns the message
     * 
     * @return string message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message
     * 
     * @param string $message
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


    /**
     * tosms
     *
     * @var ObjectStorage<FrontendUser>
     */
    protected $tosms = '';

    /**
     * Returns the tosms
     * 
     * @return ObjectStorage tosms
     */
    public function getTosms()
    {
        return clone $this->tosms;
    }

    /**
     * Sets the tosms
     * 
     * @param ObjectStorage $tosms
     * @return void
     */
    public function setTosms(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tosms)
    {
        $this->tosms = $tosms;
    } 
}
