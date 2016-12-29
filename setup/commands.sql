--
-- Create schema commands
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ commands;
USE commands;

--
-- Table structure for table `commands`.`commands`
--

DROP TABLE IF EXISTS `commands`;
CREATE TABLE `commands` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `done` tinyint(1) NOT NULL default '0',
  `command` tinytext NOT NULL,
  `ip` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;