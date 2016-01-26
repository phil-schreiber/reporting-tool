DROP TABLE IF EXISTS feusers;
CREATE TABLE feusers (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	username varchar(255) COLLATE utf8_general_ci NOT NULL,
	password varchar(255) COLLATE utf8_general_ci NOT NULL,
	first_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	last_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,
	email varchar(255) COLLATE utf8_general_ci NOT NULL,
	phone varchar(255) COLLATE utf8_general_ci NOT NULL,
        address varchar(255) COLLATE utf8_general_ci NOT NULL,
        city  varchar(255) COLLATE utf8_general_ci NOT NULL,
	zip int(11) DEFAULT '0' NOT NULL,
	company  varchar(255) COLLATE utf8_general_ci NOT NULL,
	profileid int(11) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,
	superuser tinyint(4) DEFAULT '0' NOT NULL,
	userlanguage int(11) DEFAULT '0' NOT NULL,
        contractbegin int(11) DEFAULT '0' NOT NULL,
        contractruntime int(11) DEFAULT '0' NOT NULL,    
  PRIMARY KEY (uid),
  KEY email (email)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



LOCK TABLES feusers WRITE;
INSERT INTO feusers VALUES (1,0,NOW(),NOW(),0,0,0,'denkfabrik','$2a$10$3d34c49b983bab20eeba8uqotZMs4qmE74REKms2xR8vL0d1/M7k.','','','','schreiber@denkfabrik-group.com','','','',0,'',1,1,1,0);
UNLOCK TABLES;


--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS permissions;
CREATE TABLE IF NOT EXISTS permissions (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	profileid int(10) unsigned NOT NULL,
	resourceid int(10) unsigned NOT NULL,
	resourceaction varchar(55) NOT NULL,
  PRIMARY KEY (uid),
  KEY profilesid (profileid)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;


LOCK TABLES permissions WRITE;
INSERT INTO permissions (uid, crdate, profileid, resourceid, resourceaction) VALUES
(1, NOW(), 1, 1, 'index'),
(2, NOW(), 1, 1, 'create'),
(3, NOW(), 1, 1, 'retrieve'),
(4, NOW(), 1, 1, 'update'),
(5, NOW(), 1, 1, 'delete');
UNLOCK TABLES;



--
-- Table structure for table `resources`
--
DROP TABLE IF EXISTS resources;
CREATE TABLE IF NOT EXISTS resources(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;


LOCK TABLES resources WRITE;
INSERT INTO resources (uid, crdate, title) VALUES
(1, NOW(),'resources'),
(2, NOW(),'profiles'),
(3, NOW(),'usergroups'),
(4, NOW(),'feusers'),
(5, NOW(),'languages'),
(6, NOW(),'permissions'),
(7, NOW(),'campaignobjects'),
(8, NOW(),'mailobjects'),
(9, NOW(),'templateobjects'),
(10, NOW(),'contentobjects'),
(11, NOW(),'configurationobjects'),
(12, NOW(),'sendoutobjects'),
(13, NOW(),'addresses'),
(14, NOW(),'addressfolders'),
(15, NOW(),'segmentobjects'),
(16, NOW(),'addressconditions'),
(17, NOW(),'review'),
(18, NOW(),'testmail'),
(19, NOW(),'distributors'),
(20, NOW(),'clickconditions'),
(21, NOW(),'triggerevents'),
(22, NOW(),'subscriptionobjects'),
(23, NOW(),'feuserscategories');
UNLOCK TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS profiles;
CREATE TABLE IF NOT EXISTS profiles (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,	
  PRIMARY KEY (uid),
  KEY hidden (hidden)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

LOCK TABLES profiles WRITE;
INSERT INTO profiles (uid, crdate, title) VALUES
(1,NOW() ,'Admin'),
(2,NOW(), 'Customer');
UNLOCK TABLES;
--
-- Table structure for table `usergroups`
--

DROP TABLE IF EXISTS usergroups;
CREATE TABLE IF NOT EXISTS usergroups (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,	
	lang int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY hidden (hidden)
) ENGINE=InnoDB  AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


LOCK TABLES usergroups WRITE;
INSERT INTO usergroups (uid, crdate, title, lang) VALUES
(1,NOW(),'denkfabrik',1)
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL,
	shorttitle varchar(4) NOT NULL,
  PRIMARY KEY (uid),
  KEY hidden (hidden)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

LOCK TABLES `languages` WRITE;
INSERT INTO `languages` (uid, crdate, title,shorttitle) VALUES
(1,NOW(),'Deutsch','de'),
(2,NOW(),'English','en');
UNLOCK TABLES;


--
-- Table structure for table `failed_logins`
--

DROP TABLE IF EXISTS `failed_logins`;
CREATE TABLE IF NOT EXISTS `failed_logins` (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	userid	 int(10) unsigned DEFAULT NULL,
	ipaddress char(15) NOT NULL,
	attempted int(10) unsigned DEFAULT NULL,
	useragent varchar(120) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


--
-- Table structure for table `success_logins`
--

DROP TABLE IF EXISTS `success_logins`;
CREATE TABLE IF NOT EXISTS `success_logins` (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	endsession int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	userid	 int(10) unsigned DEFAULT NULL,
	ipaddress char(15) NOT NULL,
	attempted int(10) unsigned DEFAULT NULL,
	useragent varchar(120) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS budgets;
CREATE TABLE budgets (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,	
	amount int(11) DEFAULT '0' NOT NULL,	
	
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS distributors_segmentobjects_lookup;
CREATE TABLE distributors_segmentobjects_lookup (
	uid int(11) NOT NULL auto_increment,		
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS distributors_addressfolders_lookup;
CREATE TABLE distributors_addressfolders_lookup (
	uid int(11) NOT NULL auto_increment,			
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS configurationobjects_feusers_lookup;
CREATE TABLE configurationobjects_feusers_lookup (
	uid int(11) NOT NULL auto_increment,			
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS templateobjects_usergroups_lookup;
CREATE TABLE templateobjects_usergroups_lookup (
	uid int(11) NOT NULL auto_increment,		
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS addressfolders;
CREATE TABLE addressfolders (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,	
	title varchar(255) COLLATE utf8_general_ci NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS addresses_segmentobjects_lookup;
CREATE TABLE addresses_segmentobjects_lookup (
	uid int(11) NOT NULL auto_increment,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,	
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS addresses;
CREATE TABLE addresses (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,	
	first_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	last_name varchar(255) COLLATE utf8_general_ci NOT NULL,
	salutation varchar(255) COLLATE utf8_general_ci NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,
	email varchar(255) COLLATE utf8_general_ci NOT NULL,
	phone varchar(255) COLLATE utf8_general_ci NOT NULL,
    address varchar(255) COLLATE utf8_general_ci NOT NULL,
    city  varchar(255) COLLATE utf8_general_ci NOT NULL,	
	company varchar(255) COLLATE utf8_general_ci NOT NULL,	
	zip int(11) DEFAULT '0' NOT NULL,		
	region int(11) DEFAULT '0' NOT NULL,
	province varchar(255) COLLATE utf8_general_ci NOT NULL,			
	userlanguage int(11) DEFAULT '0' NOT NULL,
	gender tinyint(4) DEFAULT '0' NOT NULL,
	formal tinyint(4) DEFAULT '1' NOT NULL,
	hashtags varchar(255) COLLATE utf8_general_ci NOT NULL,
	itemsource  varchar(255) COLLATE utf8_general_ci NOT NULL,	
	hasprofile tinyint(4) DEFAULT '1' NOT NULL,
	birthday DATE NOT NULL,
  PRIMARY KEY (uid),
	KEY pid (pid)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



DROP TABLE IF EXISTS addressconditions;
CREATE TABLE addressconditions(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,	
	junctor int(11) DEFAULT '0' NOT NULL,	
	conditionaloperator int(11) DEFAULT '0' NOT NULL,	
	argument int(11) DEFAULT '0' NOT NULL,		
	operator int(11) DEFAULT '0' NOT NULL,	
	argumentcondition varchar(255) COLLATE utf8_general_ci NOT NULL,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS clickconditions;
CREATE TABLE clickconditions(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,	
	junctor int(11) DEFAULT '0' NOT NULL,	
	conditionaloperator int(11) DEFAULT '0' NOT NULL,		
	thecondition int(11) DEFAULT '0' NOT NULL,		
	argumentcondition varchar(1000) COLLATE utf8_general_ci NOT NULL,	
	conditiontrue tinyint(4) DEFAULT '0' NOT NULL,
	sourcesendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS mailqueue;
CREATE TABLE mailqueue (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	sent tinyint(4) DEFAULT '0' NOT NULL,	
	distributoruid int(11) DEFAULT '0' NOT NULL,
	addressuid int(11) DEFAULT '0' NOT NULL,
	campaignuid int(11) DEFAULT '0' NOT NULL,
	sendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	mailobjectuid int(11) DEFAULT '0' NOT NULL,
	configurationuid int(11) DEFAULT '0' NOT NULL,
	email varchar(255) COLLATE utf8_general_ci NOT NULL,		
	subject varchar(255) COLLATE utf8_general_ci NOT NULL,
	sendermail varchar(255) COLLATE utf8_general_ci NOT NULL,	
	sendername varchar(255) COLLATE utf8_general_ci NOT NULL,	
	answermail varchar(255) COLLATE utf8_general_ci NOT NULL,	
	answername varchar(255) COLLATE utf8_general_ci NOT NULL,	
	returnpath varchar(255) COLLATE utf8_general_ci NOT NULL,	
	organisation varchar(255) COLLATE utf8_general_ci NOT NULL,	
	mailbody mediumtext,
	PRIMARY KEY (uid)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS linklookup;
CREATE TABLE linklookup(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	campaignuid int(11) DEFAULT '0' NOT NULL,
	mailobjectuid int(11) DEFAULT '0' NOT NULL,
	sendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	url mediumtext,	
	linknumber int(11) DEFAULT '0' NOT NULL,
	params mediumtext,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS linkclicks;
CREATE TABLE linkclicks(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	campaignuid int(11) DEFAULT '0' NOT NULL,
	mailobjectuid int(11) DEFAULT '0' NOT NULL,
	sendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	url mediumtext,	
	linkuid int(11) DEFAULT '0' NOT NULL,
	addressuid int(11) DEFAULT '0' NOT NULL,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS openclicks;
CREATE TABLE openclicks(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	sendoutobjectuid int(11) DEFAULT '0' NOT NULL,
	addressuid int(11) DEFAULT '0' NOT NULL,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS triggerevents;
CREATE TABLE triggerevents(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	eventtype int(11) DEFAULT '0' NOT NULL,
	title varchar(255) COLLATE utf8_general_ci NOT NULL,
	repetitive tinyint(4) DEFAULT '0' NOT NULL,	
	repeatcycle varchar(255) COLLATE utf8_general_ci NOT NULL,
	dayofweek tinyint(4) DEFAULT '0' NOT NULL,	
	repeatcycletime int(11) DEFAULT '0' NOT NULL,
	sendoutdate int(11) DEFAULT '0' NOT NULL,
	reviewed tinyint(4) DEFAULT '0' NOT NULL,
	cleared tinyint(4) DEFAULT '0' NOT NULL,
	inprogress tinyint(4) DEFAULT '0' NOT NULL,
	usergroup int(11) DEFAULT '0' NOT NULL,	
	mailobjectuid int(11) DEFAULT '0' NOT NULL,
	configurationuid int(11) DEFAULT '0' NOT NULL,
	subject varchar(255) COLLATE utf8_general_ci NOT NULL,		
	distributoruid int(11) DEFAULT '0' NOT NULL,		
	addressfolder int(11) DEFAULT '0' NOT NULL,
	birthday DATE NOT NULL,	
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



DROP TABLE IF EXISTS subscriptionobjects;
CREATE TABLE subscriptionobjects(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,		
	cruser_id int(11) DEFAULT '0' NOT NULL,
	addressfolder int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS subscriptionobjects_feuserscategories_lookup;
CREATE TABLE subscriptionobjects_feuserscategories_lookup (
	uid int(11) NOT NULL auto_increment,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,	
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS feuserscategories;
CREATE TABLE feuserscategories(
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,	
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,	
	title varchar(255) COLLATE utf8_general_ci NOT NULL,	
	usergroup int(11) DEFAULT '0' NOT NULL,		
	cruser_id int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS feusers_feuserscategories_lookup;
CREATE TABLE feusers_feuserscategories_lookup (
	uid int(11) NOT NULL auto_increment,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,	
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS addresses_feuserscategories_lookup;
CREATE TABLE addresses_feuserscategories_lookup (
	uid int(11) NOT NULL auto_increment,	
	deleted tinyint(4) DEFAULT '0' NOT NULL,	
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,		
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
