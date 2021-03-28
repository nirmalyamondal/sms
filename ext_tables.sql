#
# Table structure for table 'tx_sms_domain_model_sms'
#
CREATE TABLE tx_sms_domain_model_sms (
	feuser int(11) DEFAULT '0' NOT NULL,
	fromsms varchar(255) DEFAULT '' NOT NULL,
	tosms varchar(255) DEFAULT '' NOT NULL,
	senddate int(11) DEFAULT '0' NOT NULL,
	message text
);
