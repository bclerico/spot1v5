--
-- Create Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `oid` int(11) NOT NULL auto_increment,
  `cnkey` varchar(128) NOT NULL,
  `cnhtml` varchar(5000) NOT NULL,
  `dto` varchar(255) NOT NULL,
  PRIMARY KEY  (`oid`),
  UNIQUE KEY `cnkey` (`cnkey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Insert initial data for table `content`
--

LOCK TABLES `content` WRITE;
INSERT INTO `content` (cnkey, cnhtml, dto)
  VALUES ('home_01','<h1>Welcome to WatchMySpot!</h1><p>I am a lone adventurer that enjoys the quiet solitude of the extreme outdoors. The allure of lone adventuring is about being self reliant while experiencing the wonders of nature. One of the drawbacks of lone adventuring is that there are people that worry about us when we are wandering about. I recently purchased a <a href=\'http://www.amazon.com/dp/B002PHRDO2?tag=opt4lif-20&camp=14573&creative=327641&linkCode=as1&creativeASIN=B002PHRDO2&adid=0CH8ZY0A0WGWMGV2TCWX&\' target=\'_blank\'>SPOT GPS Messenger</a> for the specific purpose of being able to let my loved ones know my status while out on an expedition. I\'ve created this site in order to bring together a community of lone adventurers so we can look after each other and perhaps collaborate on our expeditions. I hope you find this site useful.  <em><b>--<a href=\'mailto:bclerico@watchmyspot.com\'>Bill Clerico</a></b></em></p><h1>Get Started using the WatchMySpot Global Expedition Portal</h1><h2>Already a SPOT GPS Messenger user?</h2><p>Great!  A simple update to your SPOT Message Profile(s) is all it takes. Add the email address watchmyspotgeop@gmail.com to the &quot;Send Messages To&quot; list and include the tag #WatchMySpot in the &quot;Message To Send&quot;. That\'s it! Your SPOT notifications will now show up on the <a href=\'cons_01.php\'>WatchMySpot Console</a>.</p><h2>Not using SPOT GPS Messenger?</h2><p>No Problem! We currently support:<ul><li>iPhone App <a href=\'https://itunes.apple.com/us/app/my-gps-coordinates/id945482414?mt=8\' target=\'blank\'>My GPS Coordinates</a> - simply add the email address &quot;watchmyspotgeop@gmail.com&quot; to the <em>Email to auto fill</em> field in <em>Settings</em>.</li><li>Android support coming soon!</li></ul><h1>Support this site</h1><p>I continually improve this site and am open to your suggestions - please send me <a href=\'mailto:bclerico@gmail.com\'>email</a> and let me know your ideas. If you find this site useful and would like to provide some monetary support, please consider purchasing some of my <em>Essential Gear</em> using this site. Thanks!</p>','20180404113039'),('donate_01','Donations Page is currently under construction.','20180404113039'),('help_01','Help Page is currently under construction.','20180404113039'),('exped_01','Expeditions Page is currently under construction.','20180404113039');
UNLOCK TABLES;


--
-- Create Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `oid` int(11) NOT NULL auto_increment,
  `uid` varchar(24) NOT NULL,
  `pwd` varchar(24) NOT NULL,
  `email` varchar(128) NOT NULL,
  `fname` varchar(35) NOT NULL,
  `mi` varchar(1) NOT NULL,
  `lname` varchar(35) NOT NULL,
  `bc_long` decimal(8,5) NOT NULL,
  `bc_lat` decimal(8,5) NOT NULL,
  `spot_id` varchar(20) NOT NULL,
  `spot_device_name` varchar(255) NOT NULL,
  `dto` varchar(255) NOT NULL,
  PRIMARY KEY  (`oid`),
  UNIQUE KEY `uid_index` (`uid`),
  UNIQUE KEY `email_index` (`email`),
  UNIQUE KEY `spot_id_index` (`spot_id`),
  UNIQUE KEY `spot_index` (`spot_id`,`spot_device_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Insert initial data for table `profile`
--

LOCK TABLES `profile` WRITE;
INSERT INTO `profile` (uid, pwd, email, fname, mi, lname, bc_long, bc_lat, spot_id, spot_device_name, dto)
  VALUES ('bclerico','password','bclerico@gmail.com','Bill','','Clerico','-74.12097','40.33067','0-8132285','wjclerico','20180404113039');
UNLOCK TABLES;


--
-- Create Table structure for table `raw_msg`
--

DROP TABLE IF EXISTS `raw_msg`;
CREATE TABLE `raw_msg` (
  `oid` int(11) NOT NULL auto_increment,
  `msg` varchar(4096) NOT NULL,
  PRIMARY KEY  (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Create Table structure for table `spot_msg`
--

DROP TABLE IF EXISTS `spot_msg`;
CREATE TABLE `spot_msg` (
  `oid` int(11) NOT NULL auto_increment,
  `device` varchar(255) NOT NULL,
  `latitude` decimal(8,5) NOT NULL,
  `longitude` decimal(8,5) NOT NULL,
  `location_dto` varchar(255) NOT NULL,
  `point_date_time` datetime NOT NULL,
  `time_zone` varchar(3) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `msg` varchar(2048) NOT NULL,
  `orig_email` varchar(4096) NOT NULL,
  PRIMARY KEY  (`oid`),
  UNIQUE KEY `individual_msg` (`device`,`location_dto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
