-- 
-- Table structure for table `shortenedurls`
-- 

CREATE TABLE `shortenedurls` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `long_url` varchar(255) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `creator` char(15) NOT NULL,
  `referrals` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `long` (`long_url`),
  KEY `referrals` (`referrals`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE tbUsers (
	pkUserId int(11) NOT NULL auto_increment,
	email char(128) NOT NULL,
	password char(128) NOT NULL,
	user_salt varchar(50) NOT NULL,
	is_verified tinyint(1) NOT NULL,
	is_active tinyint(1) NOT NULL,
	is_admin tinyint(1) NOT NULL,
	verification_code varchar(65) NOT NULL,
	PRIMARY KEY (`pkId`)
) ENGINE = INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbLoggedInUsers` (
  `pkId` int(11) NOT NULL AUTO_INCREMENT,
  `fkUserId` int(11) NOT NULL,
  `session_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `token` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastUpdate` datetime NOT NULL,
  PRIMARY KEY (`pkId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
