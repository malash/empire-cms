# --------------------------------------------------------
# 
# �Ұ�����޲z�t�� 
# 
# http://www.PHome.Net
# 
# EmpireCMS Version 7.2
# 
# --------------------------------------------------------


# --------------------------- article -----------------------------

DROP TABLE IF EXISTS `phome_ecms_article`;
CREATE TABLE `phome_ecms_article` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` char(20) NOT NULL default '',
  `filename` char(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` char(14) NOT NULL default '',
  `titleurl` char(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` char(80) NOT NULL default '',
  `title` char(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` char(120) NOT NULL default '',
  `ftitle` char(120) NOT NULL default '',
  `smalltext` char(255) NOT NULL default '',
  `writer` char(30) NOT NULL default '',
  `befrom` char(60) NOT NULL default '',
  `newstext` char(50) NOT NULL default '',
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_article_check`;
CREATE TABLE `phome_ecms_article_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` char(20) NOT NULL default '',
  `filename` char(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` char(14) NOT NULL default '',
  `titleurl` char(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` char(80) NOT NULL default '',
  `title` char(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` char(120) NOT NULL default '',
  `ftitle` char(120) NOT NULL default '',
  `smalltext` char(255) NOT NULL default '',
  `writer` char(30) NOT NULL default '',
  `befrom` char(60) NOT NULL default '',
  `newstext` char(50) NOT NULL default '',
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_article_check_data`;
CREATE TABLE `phome_ecms_article_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_article_data_1`;
CREATE TABLE `phome_ecms_article_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_article_doc`;
CREATE TABLE `phome_ecms_article_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` char(20) NOT NULL default '',
  `filename` char(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` char(14) NOT NULL default '',
  `titleurl` char(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` char(80) NOT NULL default '',
  `title` char(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` char(120) NOT NULL default '',
  `ftitle` char(120) NOT NULL default '',
  `smalltext` char(255) NOT NULL default '',
  `writer` char(30) NOT NULL default '',
  `befrom` char(60) NOT NULL default '',
  `newstext` char(50) NOT NULL default '',
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_article_doc_data`;
CREATE TABLE `phome_ecms_article_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_article_doc_index`;
CREATE TABLE `phome_ecms_article_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_article_index`;
CREATE TABLE `phome_ecms_article_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_article`;
CREATE TABLE `phome_ecms_infoclass_article` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_ftitle` text NOT NULL,
  `z_ftitle` varchar(255) NOT NULL default '',
  `qz_ftitle` varchar(255) NOT NULL default '',
  `save_ftitle` varchar(10) NOT NULL default '',
  `zz_smalltext` text NOT NULL,
  `z_smalltext` varchar(255) NOT NULL default '',
  `qz_smalltext` varchar(255) NOT NULL default '',
  `save_smalltext` varchar(10) NOT NULL default '',
  `zz_writer` text NOT NULL,
  `z_writer` varchar(255) NOT NULL default '',
  `qz_writer` varchar(255) NOT NULL default '',
  `save_writer` varchar(10) NOT NULL default '',
  `zz_befrom` text NOT NULL,
  `z_befrom` varchar(255) NOT NULL default '',
  `qz_befrom` varchar(255) NOT NULL default '',
  `save_befrom` varchar(10) NOT NULL default '',
  `zz_newstext` text NOT NULL,
  `z_newstext` varchar(255) NOT NULL default '',
  `qz_newstext` varchar(255) NOT NULL default '',
  `save_newstext` varchar(10) NOT NULL default '',
  `zz_diggtop` text NOT NULL,
  `z_diggtop` varchar(255) NOT NULL default '',
  `qz_diggtop` varchar(255) NOT NULL default '',
  `save_diggtop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_article`;
CREATE TABLE `phome_ecms_infotmp_article` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `ftitle` varchar(120) NOT NULL default '',
  `smalltext` varchar(255) NOT NULL default '',
  `writer` varchar(30) NOT NULL default '',
  `befrom` varchar(60) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;



# --------------------------- download -----------------------------

DROP TABLE IF EXISTS `phome_ecms_download`;
CREATE TABLE `phome_ecms_download` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `softfj` varchar(255) NOT NULL default '',
  `language` varchar(16) NOT NULL default '',
  `softtype` varchar(16) NOT NULL default '',
  `softsq` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `softsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_download_check`;
CREATE TABLE `phome_ecms_download_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `softfj` varchar(255) NOT NULL default '',
  `language` varchar(16) NOT NULL default '',
  `softtype` varchar(16) NOT NULL default '',
  `softsq` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `softsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_download_check_data`;
CREATE TABLE `phome_ecms_download_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `softwriter` varchar(30) NOT NULL default '',
  `homepage` varchar(80) NOT NULL default '',
  `demo` varchar(120) NOT NULL default '',
  `downpath` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_download_data_1`;
CREATE TABLE `phome_ecms_download_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `softwriter` varchar(30) NOT NULL default '',
  `homepage` varchar(80) NOT NULL default '',
  `demo` varchar(120) NOT NULL default '',
  `downpath` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_download_doc`;
CREATE TABLE `phome_ecms_download_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `softfj` varchar(255) NOT NULL default '',
  `language` varchar(16) NOT NULL default '',
  `softtype` varchar(16) NOT NULL default '',
  `softsq` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `softsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_download_doc_data`;
CREATE TABLE `phome_ecms_download_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `softwriter` varchar(30) NOT NULL default '',
  `homepage` varchar(80) NOT NULL default '',
  `demo` varchar(120) NOT NULL default '',
  `downpath` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_download_doc_index`;
CREATE TABLE `phome_ecms_download_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_download_index`;
CREATE TABLE `phome_ecms_download_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_download`;
CREATE TABLE `phome_ecms_infoclass_download` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_softwriter` text NOT NULL,
  `z_softwriter` varchar(255) NOT NULL default '',
  `qz_softwriter` varchar(255) NOT NULL default '',
  `save_softwriter` varchar(10) NOT NULL default '',
  `zz_homepage` text NOT NULL,
  `z_homepage` varchar(255) NOT NULL default '',
  `qz_homepage` varchar(255) NOT NULL default '',
  `save_homepage` varchar(10) NOT NULL default '',
  `zz_demo` text NOT NULL,
  `z_demo` varchar(255) NOT NULL default '',
  `qz_demo` varchar(255) NOT NULL default '',
  `save_demo` varchar(10) NOT NULL default '',
  `zz_softfj` text NOT NULL,
  `z_softfj` varchar(255) NOT NULL default '',
  `qz_softfj` varchar(255) NOT NULL default '',
  `save_softfj` varchar(10) NOT NULL default '',
  `zz_language` text NOT NULL,
  `z_language` varchar(255) NOT NULL default '',
  `qz_language` varchar(255) NOT NULL default '',
  `save_language` varchar(10) NOT NULL default '',
  `zz_softtype` text NOT NULL,
  `z_softtype` varchar(255) NOT NULL default '',
  `qz_softtype` varchar(255) NOT NULL default '',
  `save_softtype` varchar(10) NOT NULL default '',
  `zz_softsq` text NOT NULL,
  `z_softsq` varchar(255) NOT NULL default '',
  `qz_softsq` varchar(255) NOT NULL default '',
  `save_softsq` varchar(10) NOT NULL default '',
  `zz_star` text NOT NULL,
  `z_star` varchar(255) NOT NULL default '',
  `qz_star` varchar(255) NOT NULL default '',
  `save_star` varchar(10) NOT NULL default '',
  `zz_filetype` text NOT NULL,
  `z_filetype` varchar(255) NOT NULL default '',
  `qz_filetype` varchar(255) NOT NULL default '',
  `save_filetype` varchar(10) NOT NULL default '',
  `zz_filesize` text NOT NULL,
  `z_filesize` varchar(255) NOT NULL default '',
  `qz_filesize` varchar(255) NOT NULL default '',
  `save_filesize` varchar(10) NOT NULL default '',
  `zz_downpath` text NOT NULL,
  `z_downpath` varchar(255) NOT NULL default '',
  `qz_downpath` varchar(255) NOT NULL default '',
  `save_downpath` varchar(10) NOT NULL default '',
  `zz_softsay` text NOT NULL,
  `z_softsay` varchar(255) NOT NULL default '',
  `qz_softsay` varchar(255) NOT NULL default '',
  `save_softsay` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_download`;
CREATE TABLE `phome_ecms_infotmp_download` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `softwriter` varchar(30) NOT NULL default '',
  `homepage` varchar(80) NOT NULL default '',
  `demo` varchar(120) NOT NULL default '',
  `softfj` varchar(255) NOT NULL default '',
  `language` varchar(16) NOT NULL default '',
  `softtype` varchar(16) NOT NULL default '',
  `softsq` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `downpath` mediumtext NOT NULL,
  `softsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;



# -------------------------- flash ------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash`;
CREATE TABLE `phome_ecms_flash` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `flashwriter` varchar(30) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filesize` varchar(16) NOT NULL default '',
  `flashurl` varchar(255) NOT NULL default '',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  `flashsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash_check`;
CREATE TABLE `phome_ecms_flash_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `flashwriter` varchar(30) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filesize` varchar(16) NOT NULL default '',
  `flashurl` varchar(255) NOT NULL default '',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  `flashsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash_check_data`;
CREATE TABLE `phome_ecms_flash_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash_data_1`;
CREATE TABLE `phome_ecms_flash_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash_doc`;
CREATE TABLE `phome_ecms_flash_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `flashwriter` varchar(30) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filesize` varchar(16) NOT NULL default '',
  `flashurl` varchar(255) NOT NULL default '',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  `flashsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash_doc_data`;
CREATE TABLE `phome_ecms_flash_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash_doc_index`;
CREATE TABLE `phome_ecms_flash_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_flash_index`;
CREATE TABLE `phome_ecms_flash_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_flash`;
CREATE TABLE `phome_ecms_infoclass_flash` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_flashwriter` text NOT NULL,
  `z_flashwriter` varchar(255) NOT NULL default '',
  `qz_flashwriter` varchar(255) NOT NULL default '',
  `save_flashwriter` varchar(10) NOT NULL default '',
  `zz_email` text NOT NULL,
  `z_email` varchar(255) NOT NULL default '',
  `qz_email` varchar(255) NOT NULL default '',
  `save_email` varchar(10) NOT NULL default '',
  `zz_star` text NOT NULL,
  `z_star` varchar(255) NOT NULL default '',
  `qz_star` varchar(255) NOT NULL default '',
  `save_star` varchar(10) NOT NULL default '',
  `zz_filesize` text NOT NULL,
  `z_filesize` varchar(255) NOT NULL default '',
  `qz_filesize` varchar(255) NOT NULL default '',
  `save_filesize` varchar(10) NOT NULL default '',
  `zz_flashurl` text NOT NULL,
  `z_flashurl` varchar(255) NOT NULL default '',
  `qz_flashurl` varchar(255) NOT NULL default '',
  `save_flashurl` varchar(10) NOT NULL default '',
  `zz_width` text NOT NULL,
  `z_width` varchar(255) NOT NULL default '',
  `qz_width` varchar(255) NOT NULL default '',
  `save_width` varchar(10) NOT NULL default '',
  `zz_height` text NOT NULL,
  `z_height` varchar(255) NOT NULL default '',
  `qz_height` varchar(255) NOT NULL default '',
  `save_height` varchar(10) NOT NULL default '',
  `zz_flashsay` text NOT NULL,
  `z_flashsay` varchar(255) NOT NULL default '',
  `qz_flashsay` varchar(255) NOT NULL default '',
  `save_flashsay` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_flash`;
CREATE TABLE `phome_ecms_infotmp_flash` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `flashwriter` varchar(30) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `filesize` varchar(16) NOT NULL default '',
  `flashurl` varchar(255) NOT NULL default '',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  `flashsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;



# --------------------------- info -----------------------------

DROP TABLE IF EXISTS `phome_ecms_info`;
CREATE TABLE `phome_ecms_info` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `smalltext` text NOT NULL,
  `myarea` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_info_check`;
CREATE TABLE `phome_ecms_info_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `smalltext` text NOT NULL,
  `myarea` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_info_check_data`;
CREATE TABLE `phome_ecms_info_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `mycontact` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_info_data_1`;
CREATE TABLE `phome_ecms_info_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `mycontact` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_info_doc`;
CREATE TABLE `phome_ecms_info_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `smalltext` text NOT NULL,
  `myarea` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_info_doc_data`;
CREATE TABLE `phome_ecms_info_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `mycontact` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_info_doc_index`;
CREATE TABLE `phome_ecms_info_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_info_index`;
CREATE TABLE `phome_ecms_info_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_info`;
CREATE TABLE `phome_ecms_infoclass_info` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_smalltext` text NOT NULL,
  `z_smalltext` varchar(255) NOT NULL default '',
  `qz_smalltext` varchar(255) NOT NULL default '',
  `save_smalltext` varchar(10) NOT NULL default '',
  `zz_myarea` text NOT NULL,
  `z_myarea` varchar(255) NOT NULL default '',
  `qz_myarea` varchar(255) NOT NULL default '',
  `save_myarea` varchar(10) NOT NULL default '',
  `zz_email` text NOT NULL,
  `z_email` varchar(255) NOT NULL default '',
  `qz_email` varchar(255) NOT NULL default '',
  `save_email` varchar(10) NOT NULL default '',
  `zz_mycontact` text NOT NULL,
  `z_mycontact` varchar(255) NOT NULL default '',
  `qz_mycontact` varchar(255) NOT NULL default '',
  `save_mycontact` varchar(10) NOT NULL default '',
  `zz_address` text NOT NULL,
  `z_address` varchar(255) NOT NULL default '',
  `qz_address` varchar(255) NOT NULL default '',
  `save_address` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_info`;
CREATE TABLE `phome_ecms_infotmp_info` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `smalltext` text NOT NULL,
  `myarea` varchar(30) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `mycontact` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;



# ----------------------------- movie ---------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_movie`;
CREATE TABLE `phome_ecms_infoclass_movie` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_movietype` text NOT NULL,
  `z_movietype` varchar(255) NOT NULL default '',
  `qz_movietype` varchar(255) NOT NULL default '',
  `save_movietype` varchar(10) NOT NULL default '',
  `zz_company` text NOT NULL,
  `z_company` varchar(255) NOT NULL default '',
  `qz_company` varchar(255) NOT NULL default '',
  `save_company` varchar(10) NOT NULL default '',
  `zz_movietime` text NOT NULL,
  `z_movietime` varchar(255) NOT NULL default '',
  `qz_movietime` varchar(255) NOT NULL default '',
  `save_movietime` varchar(10) NOT NULL default '',
  `zz_player` text NOT NULL,
  `z_player` varchar(255) NOT NULL default '',
  `qz_player` varchar(255) NOT NULL default '',
  `save_player` varchar(10) NOT NULL default '',
  `zz_playadmin` text NOT NULL,
  `z_playadmin` varchar(255) NOT NULL default '',
  `qz_playadmin` varchar(255) NOT NULL default '',
  `save_playadmin` varchar(10) NOT NULL default '',
  `zz_filetype` text NOT NULL,
  `z_filetype` varchar(255) NOT NULL default '',
  `qz_filetype` varchar(255) NOT NULL default '',
  `save_filetype` varchar(10) NOT NULL default '',
  `zz_filesize` text NOT NULL,
  `z_filesize` varchar(255) NOT NULL default '',
  `qz_filesize` varchar(255) NOT NULL default '',
  `save_filesize` varchar(10) NOT NULL default '',
  `zz_star` text NOT NULL,
  `z_star` varchar(255) NOT NULL default '',
  `qz_star` varchar(255) NOT NULL default '',
  `save_star` varchar(10) NOT NULL default '',
  `zz_playdk` text NOT NULL,
  `z_playdk` varchar(255) NOT NULL default '',
  `qz_playdk` varchar(255) NOT NULL default '',
  `save_playdk` varchar(10) NOT NULL default '',
  `zz_playtime` text NOT NULL,
  `z_playtime` varchar(255) NOT NULL default '',
  `qz_playtime` varchar(255) NOT NULL default '',
  `save_playtime` varchar(10) NOT NULL default '',
  `zz_moviefen` text NOT NULL,
  `z_moviefen` varchar(255) NOT NULL default '',
  `qz_moviefen` varchar(255) NOT NULL default '',
  `save_moviefen` varchar(10) NOT NULL default '',
  `zz_downpath` text NOT NULL,
  `z_downpath` varchar(255) NOT NULL default '',
  `qz_downpath` varchar(255) NOT NULL default '',
  `save_downpath` varchar(10) NOT NULL default '',
  `zz_playerid` text NOT NULL,
  `z_playerid` varchar(255) NOT NULL default '',
  `qz_playerid` varchar(255) NOT NULL default '',
  `save_playerid` varchar(10) NOT NULL default '',
  `zz_onlinepath` text NOT NULL,
  `z_onlinepath` varchar(255) NOT NULL default '',
  `qz_onlinepath` varchar(255) NOT NULL default '',
  `save_onlinepath` varchar(10) NOT NULL default '',
  `zz_moviesay` text NOT NULL,
  `z_moviesay` varchar(255) NOT NULL default '',
  `qz_moviesay` varchar(255) NOT NULL default '',
  `save_moviesay` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_movie`;
CREATE TABLE `phome_ecms_infotmp_movie` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `movietype` varchar(16) NOT NULL default '',
  `company` varchar(200) NOT NULL default '',
  `movietime` varchar(20) NOT NULL default '',
  `player` varchar(255) NOT NULL default '',
  `playadmin` varchar(255) NOT NULL default '',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `playdk` varchar(30) NOT NULL default '',
  `playtime` varchar(20) NOT NULL default '',
  `moviefen` int(11) NOT NULL default '0',
  `downpath` mediumtext NOT NULL,
  `playerid` smallint(6) NOT NULL default '0',
  `onlinepath` mediumtext NOT NULL,
  `moviesay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie`;
CREATE TABLE `phome_ecms_movie` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `movietype` varchar(16) NOT NULL default '',
  `company` varchar(200) NOT NULL default '',
  `movietime` varchar(20) NOT NULL default '',
  `player` varchar(255) NOT NULL default '',
  `playadmin` varchar(255) NOT NULL default '',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `moviefen` int(11) NOT NULL default '0',
  `moviesay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie_check`;
CREATE TABLE `phome_ecms_movie_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `movietype` varchar(16) NOT NULL default '',
  `company` varchar(200) NOT NULL default '',
  `movietime` varchar(20) NOT NULL default '',
  `player` varchar(255) NOT NULL default '',
  `playadmin` varchar(255) NOT NULL default '',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `moviefen` int(11) NOT NULL default '0',
  `moviesay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie_check_data`;
CREATE TABLE `phome_ecms_movie_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `playdk` varchar(30) NOT NULL default '',
  `playtime` varchar(20) NOT NULL default '',
  `downpath` mediumtext NOT NULL,
  `playerid` smallint(6) NOT NULL default '0',
  `onlinepath` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie_data_1`;
CREATE TABLE `phome_ecms_movie_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `playdk` varchar(30) NOT NULL default '',
  `playtime` varchar(20) NOT NULL default '',
  `downpath` mediumtext NOT NULL,
  `playerid` smallint(6) NOT NULL default '0',
  `onlinepath` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie_doc`;
CREATE TABLE `phome_ecms_movie_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `movietype` varchar(16) NOT NULL default '',
  `company` varchar(200) NOT NULL default '',
  `movietime` varchar(20) NOT NULL default '',
  `player` varchar(255) NOT NULL default '',
  `playadmin` varchar(255) NOT NULL default '',
  `filetype` varchar(10) NOT NULL default '',
  `filesize` varchar(16) NOT NULL default '',
  `star` tinyint(1) NOT NULL default '0',
  `moviefen` int(11) NOT NULL default '0',
  `moviesay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie_doc_data`;
CREATE TABLE `phome_ecms_movie_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `playdk` varchar(30) NOT NULL default '',
  `playtime` varchar(20) NOT NULL default '',
  `downpath` mediumtext NOT NULL,
  `playerid` smallint(6) NOT NULL default '0',
  `onlinepath` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie_doc_index`;
CREATE TABLE `phome_ecms_movie_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_movie_index`;
CREATE TABLE `phome_ecms_movie_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;



# -------------------------- news ------------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_news`;
CREATE TABLE `phome_ecms_infoclass_news` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_ftitle` text NOT NULL,
  `z_ftitle` varchar(255) NOT NULL default '',
  `qz_ftitle` varchar(255) NOT NULL default '',
  `save_ftitle` varchar(10) NOT NULL default '',
  `zz_smalltext` text NOT NULL,
  `z_smalltext` varchar(255) NOT NULL default '',
  `qz_smalltext` varchar(255) NOT NULL default '',
  `save_smalltext` varchar(10) NOT NULL default '',
  `zz_writer` text NOT NULL,
  `z_writer` varchar(255) NOT NULL default '',
  `qz_writer` varchar(255) NOT NULL default '',
  `save_writer` varchar(10) NOT NULL default '',
  `zz_befrom` text NOT NULL,
  `z_befrom` varchar(255) NOT NULL default '',
  `qz_befrom` varchar(255) NOT NULL default '',
  `save_befrom` varchar(10) NOT NULL default '',
  `zz_newstext` text NOT NULL,
  `z_newstext` varchar(255) NOT NULL default '',
  `qz_newstext` varchar(255) NOT NULL default '',
  `save_newstext` varchar(10) NOT NULL default '',
  `zz_diggtop` text NOT NULL,
  `z_diggtop` varchar(255) NOT NULL default '',
  `qz_diggtop` varchar(255) NOT NULL default '',
  `save_diggtop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_news`;
CREATE TABLE `phome_ecms_infotmp_news` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `ftitle` varchar(120) NOT NULL default '',
  `smalltext` varchar(255) NOT NULL default '',
  `writer` varchar(30) NOT NULL default '',
  `befrom` varchar(60) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news`;
CREATE TABLE `phome_ecms_news` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` char(20) NOT NULL default '',
  `filename` char(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` char(14) NOT NULL default '',
  `titleurl` char(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` char(80) NOT NULL default '',
  `title` char(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` char(120) NOT NULL default '',
  `ftitle` char(120) NOT NULL default '',
  `smalltext` char(255) NOT NULL default '',
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news_check`;
CREATE TABLE `phome_ecms_news_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` char(20) NOT NULL default '',
  `filename` char(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` char(14) NOT NULL default '',
  `titleurl` char(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` char(80) NOT NULL default '',
  `title` char(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` char(120) NOT NULL default '',
  `ftitle` char(120) NOT NULL default '',
  `smalltext` char(255) NOT NULL default '',
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news_check_data`;
CREATE TABLE `phome_ecms_news_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `writer` varchar(30) NOT NULL default '',
  `befrom` varchar(60) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news_data_1`;
CREATE TABLE `phome_ecms_news_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `writer` varchar(30) NOT NULL default '',
  `befrom` varchar(60) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news_doc`;
CREATE TABLE `phome_ecms_news_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` char(20) NOT NULL default '',
  `filename` char(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` char(14) NOT NULL default '',
  `titleurl` char(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` char(80) NOT NULL default '',
  `title` char(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` char(120) NOT NULL default '',
  `ftitle` char(120) NOT NULL default '',
  `smalltext` char(255) NOT NULL default '',
  `diggtop` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news_doc_data`;
CREATE TABLE `phome_ecms_news_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `writer` varchar(30) NOT NULL default '',
  `befrom` varchar(60) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news_doc_index`;
CREATE TABLE `phome_ecms_news_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_news_index`;
CREATE TABLE `phome_ecms_news_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;



# --------------------------- photo -----------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_photo`;
CREATE TABLE `phome_ecms_infoclass_photo` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_filesize` text NOT NULL,
  `z_filesize` varchar(255) NOT NULL default '',
  `qz_filesize` varchar(255) NOT NULL default '',
  `save_filesize` varchar(10) NOT NULL default '',
  `zz_picsize` text NOT NULL,
  `z_picsize` varchar(255) NOT NULL default '',
  `qz_picsize` varchar(255) NOT NULL default '',
  `save_picsize` varchar(10) NOT NULL default '',
  `zz_picfbl` text NOT NULL,
  `z_picfbl` varchar(255) NOT NULL default '',
  `qz_picfbl` varchar(255) NOT NULL default '',
  `save_picfbl` varchar(10) NOT NULL default '',
  `zz_picfrom` text NOT NULL,
  `z_picfrom` varchar(255) NOT NULL default '',
  `qz_picfrom` varchar(255) NOT NULL default '',
  `save_picfrom` varchar(10) NOT NULL default '',
  `zz_picurl` text NOT NULL,
  `z_picurl` varchar(255) NOT NULL default '',
  `qz_picurl` varchar(255) NOT NULL default '',
  `save_picurl` varchar(10) NOT NULL default '',
  `zz_morepic` text NOT NULL,
  `z_morepic` varchar(255) NOT NULL default '',
  `qz_morepic` varchar(255) NOT NULL default '',
  `save_morepic` varchar(10) NOT NULL default '',
  `zz_num` text NOT NULL,
  `z_num` varchar(255) NOT NULL default '',
  `qz_num` varchar(255) NOT NULL default '',
  `save_num` varchar(10) NOT NULL default '',
  `zz_width` text NOT NULL,
  `z_width` varchar(255) NOT NULL default '',
  `qz_width` varchar(255) NOT NULL default '',
  `save_width` varchar(10) NOT NULL default '',
  `zz_height` text NOT NULL,
  `z_height` varchar(255) NOT NULL default '',
  `qz_height` varchar(255) NOT NULL default '',
  `save_height` varchar(10) NOT NULL default '',
  `zz_picsay` text NOT NULL,
  `z_picsay` varchar(255) NOT NULL default '',
  `qz_picsay` varchar(255) NOT NULL default '',
  `save_picsay` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_photo`;
CREATE TABLE `phome_ecms_infotmp_photo` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `filesize` varchar(10) NOT NULL default '',
  `picsize` varchar(20) NOT NULL default '',
  `picfbl` varchar(20) NOT NULL default '',
  `picfrom` varchar(120) NOT NULL default '',
  `picurl` varchar(200) NOT NULL default '',
  `morepic` mediumtext NOT NULL,
  `num` tinyint(4) NOT NULL default '0',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  `picsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo`;
CREATE TABLE `phome_ecms_photo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `picurl` varchar(200) NOT NULL default '',
  `picsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo_check`;
CREATE TABLE `phome_ecms_photo_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `picurl` varchar(200) NOT NULL default '',
  `picsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo_check_data`;
CREATE TABLE `phome_ecms_photo_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `filesize` varchar(10) NOT NULL default '',
  `picsize` varchar(20) NOT NULL default '',
  `picfbl` varchar(20) NOT NULL default '',
  `picfrom` varchar(120) NOT NULL default '',
  `morepic` mediumtext NOT NULL,
  `num` tinyint(4) NOT NULL default '0',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo_data_1`;
CREATE TABLE `phome_ecms_photo_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `filesize` varchar(10) NOT NULL default '',
  `picsize` varchar(20) NOT NULL default '',
  `picfbl` varchar(20) NOT NULL default '',
  `picfrom` varchar(120) NOT NULL default '',
  `morepic` mediumtext NOT NULL,
  `num` tinyint(4) NOT NULL default '0',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo_doc`;
CREATE TABLE `phome_ecms_photo_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `picurl` varchar(200) NOT NULL default '',
  `picsay` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo_doc_data`;
CREATE TABLE `phome_ecms_photo_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` varchar(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` varchar(80) NOT NULL default '',
  `filesize` varchar(10) NOT NULL default '',
  `picsize` varchar(20) NOT NULL default '',
  `picfbl` varchar(20) NOT NULL default '',
  `picfrom` varchar(120) NOT NULL default '',
  `morepic` mediumtext NOT NULL,
  `num` tinyint(4) NOT NULL default '0',
  `width` varchar(12) NOT NULL default '',
  `height` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo_doc_index`;
CREATE TABLE `phome_ecms_photo_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_photo_index`;
CREATE TABLE `phome_ecms_photo_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;



# -------------------------- shop ------------------------------

DROP TABLE IF EXISTS `phome_ecms_infoclass_shop`;
CREATE TABLE `phome_ecms_infoclass_shop` (
  `classid` int(10) unsigned NOT NULL default '0',
  `zz_title` text NOT NULL,
  `z_title` varchar(255) NOT NULL default '',
  `qz_title` varchar(255) NOT NULL default '',
  `save_title` varchar(10) NOT NULL default '',
  `zz_titlepic` text NOT NULL,
  `z_titlepic` varchar(255) NOT NULL default '',
  `qz_titlepic` varchar(255) NOT NULL default '',
  `save_titlepic` varchar(10) NOT NULL default '',
  `zz_newstime` text NOT NULL,
  `z_newstime` varchar(255) NOT NULL default '',
  `qz_newstime` varchar(255) NOT NULL default '',
  `save_newstime` varchar(10) NOT NULL default '',
  `zz_productno` text NOT NULL,
  `z_productno` varchar(255) NOT NULL default '',
  `qz_productno` varchar(255) NOT NULL default '',
  `save_productno` varchar(10) NOT NULL default '',
  `zz_pbrand` text NOT NULL,
  `z_pbrand` varchar(255) NOT NULL default '',
  `qz_pbrand` varchar(255) NOT NULL default '',
  `save_pbrand` varchar(10) NOT NULL default '',
  `zz_intro` text NOT NULL,
  `z_intro` varchar(255) NOT NULL default '',
  `qz_intro` varchar(255) NOT NULL default '',
  `save_intro` varchar(10) NOT NULL default '',
  `zz_unit` text NOT NULL,
  `z_unit` varchar(255) NOT NULL default '',
  `qz_unit` varchar(255) NOT NULL default '',
  `save_unit` varchar(10) NOT NULL default '',
  `zz_weight` text NOT NULL,
  `z_weight` varchar(255) NOT NULL default '',
  `qz_weight` varchar(255) NOT NULL default '',
  `save_weight` varchar(10) NOT NULL default '',
  `zz_tprice` text NOT NULL,
  `z_tprice` varchar(255) NOT NULL default '',
  `qz_tprice` varchar(255) NOT NULL default '',
  `save_tprice` varchar(10) NOT NULL default '',
  `zz_price` text NOT NULL,
  `z_price` varchar(255) NOT NULL default '',
  `qz_price` varchar(255) NOT NULL default '',
  `save_price` varchar(10) NOT NULL default '',
  `zz_buyfen` text NOT NULL,
  `z_buyfen` varchar(255) NOT NULL default '',
  `qz_buyfen` varchar(255) NOT NULL default '',
  `save_buyfen` varchar(10) NOT NULL default '',
  `zz_pmaxnum` text NOT NULL,
  `z_pmaxnum` varchar(255) NOT NULL default '',
  `qz_pmaxnum` varchar(255) NOT NULL default '',
  `save_pmaxnum` varchar(10) NOT NULL default '',
  `zz_productpic` text NOT NULL,
  `z_productpic` varchar(255) NOT NULL default '',
  `qz_productpic` varchar(255) NOT NULL default '',
  `save_productpic` varchar(10) NOT NULL default '',
  `zz_newstext` text NOT NULL,
  `z_newstext` varchar(255) NOT NULL default '',
  `qz_newstext` varchar(255) NOT NULL default '',
  `save_newstext` varchar(10) NOT NULL default '',
  `zz_psalenum` text NOT NULL,
  `z_psalenum` varchar(255) NOT NULL default '',
  `qz_psalenum` varchar(255) NOT NULL default '',
  `save_psalenum` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_infotmp_shop`;
CREATE TABLE `phome_ecms_infotmp_shop` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `classid` int(10) unsigned NOT NULL default '0',
  `oldurl` varchar(200) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `tmptime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `truetime` int(10) unsigned NOT NULL default '0',
  `keyboard` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` datetime NOT NULL default '0000-00-00 00:00:00',
  `titlepic` varchar(120) NOT NULL default '',
  `productno` varchar(30) NOT NULL default '',
  `pbrand` varchar(30) NOT NULL default '',
  `intro` text NOT NULL,
  `unit` varchar(16) NOT NULL default '',
  `weight` varchar(20) NOT NULL default '',
  `tprice` float(11,2) NOT NULL default '0.00',
  `price` float(11,2) NOT NULL default '0.00',
  `buyfen` int(11) NOT NULL default '0',
  `pmaxnum` int(11) NOT NULL default '0',
  `productpic` varchar(255) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  `psalenum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop`;
CREATE TABLE `phome_ecms_shop` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `productno` varchar(30) NOT NULL default '',
  `pbrand` varchar(30) NOT NULL default '',
  `intro` text NOT NULL,
  `unit` varchar(16) NOT NULL default '',
  `weight` varchar(20) NOT NULL default '',
  `tprice` float(11,2) NOT NULL default '0.00',
  `price` float(11,2) NOT NULL default '0.00',
  `buyfen` int(11) NOT NULL default '0',
  `pmaxnum` int(11) NOT NULL default '0',
  `productpic` varchar(255) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  `psalenum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop_check`;
CREATE TABLE `phome_ecms_shop_check` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `productno` varchar(30) NOT NULL default '',
  `pbrand` varchar(30) NOT NULL default '',
  `intro` text NOT NULL,
  `unit` varchar(16) NOT NULL default '',
  `weight` varchar(20) NOT NULL default '',
  `tprice` float(11,2) NOT NULL default '0.00',
  `price` float(11,2) NOT NULL default '0.00',
  `buyfen` int(11) NOT NULL default '0',
  `pmaxnum` int(11) NOT NULL default '0',
  `productpic` varchar(255) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  `psalenum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop_check_data`;
CREATE TABLE `phome_ecms_shop_check_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop_data_1`;
CREATE TABLE `phome_ecms_shop_data_1` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop_doc`;
CREATE TABLE `phome_ecms_shop_doc` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `ttid` smallint(5) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `plnum` mediumint(8) unsigned NOT NULL default '0',
  `totaldown` mediumint(8) unsigned NOT NULL default '0',
  `newspath` varchar(20) NOT NULL default '',
  `filename` varchar(36) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `firsttitle` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `istop` tinyint(1) NOT NULL default '0',
  `isqf` tinyint(1) NOT NULL default '0',
  `ismember` tinyint(1) NOT NULL default '0',
  `isurl` tinyint(1) NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` smallint(5) unsigned NOT NULL default '0',
  `titlefont` varchar(14) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `stb` tinyint(3) unsigned NOT NULL default '1',
  `fstb` tinyint(3) unsigned NOT NULL default '1',
  `restb` tinyint(3) unsigned NOT NULL default '1',
  `keyboard` varchar(80) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepic` varchar(120) NOT NULL default '',
  `productno` varchar(30) NOT NULL default '',
  `pbrand` varchar(30) NOT NULL default '',
  `intro` text NOT NULL,
  `unit` varchar(16) NOT NULL default '',
  `weight` varchar(20) NOT NULL default '',
  `tprice` float(11,2) NOT NULL default '0.00',
  `price` float(11,2) NOT NULL default '0.00',
  `buyfen` int(11) NOT NULL default '0',
  `pmaxnum` int(11) NOT NULL default '0',
  `productpic` varchar(255) NOT NULL default '',
  `newstext` mediumtext NOT NULL,
  `psalenum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `newstime` (`newstime`),
  KEY `ttid` (`ttid`),
  KEY `firsttitle` (`firsttitle`),
  KEY `isgood` (`isgood`),
  KEY `ispic` (`ispic`),
  KEY `useridis` (`userid`,`ismember`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop_doc_data`;
CREATE TABLE `phome_ecms_shop_doc_data` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `keyid` char(255) NOT NULL default '',
  `dokey` tinyint(1) NOT NULL default '0',
  `newstempid` smallint(5) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `haveaddfen` tinyint(1) NOT NULL default '0',
  `infotags` char(80) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop_doc_index`;
CREATE TABLE `phome_ecms_shop_doc_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_ecms_shop_index`;
CREATE TABLE `phome_ecms_shop_index` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `classid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `truetime` int(10) unsigned NOT NULL default '0',
  `lastdotime` int(10) unsigned NOT NULL default '0',
  `havehtml` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`),
  KEY `checked` (`checked`),
  KEY `newstime` (`newstime`),
  KEY `truetime` (`truetime`,`id`),
  KEY `havehtml` (`classid`,`truetime`,`havehtml`,`checked`,`id`)
) TYPE=MyISAM;



# --------------------------------------------------------

INSERT INTO `phome_enewsf` VALUES (1, 'title', '���D', 'text', '<table width=\\"100%\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" bgcolor=\\"#DBEAF5\\">\r\n<tr> \r\n  <td height=\\"25\\" bgcolor=\\"#FFFFFF\\">\r\n	<?=$tts?\\"<select name=\\\'ttid\\\'><option value=\\\'0\\\'>���D����</option>$tts</select>\\":\\"\\"?>\r\n	<input type=text name=title value=\\"<?=ehtmlspecialchars(stripSlashes($r[title]))?>\\" size=\\"60\\"> \r\n	<input type=\\"button\\" name=\\"button\\" value=\\"�Ϥ�\\" onclick=\\"document.add.title.value=document.add.title.value+\\\'(�Ϥ�)\\\';\\"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height=\\"25\\" bgcolor=\\"#FFFFFF\\">�ݩ�: \r\n	<input name=\\"titlefont[b]\\" type=\\"checkbox\\" value=\\"b\\"<?=$titlefontb?>>����\r\n	<input name=\\"titlefont[i]\\" type=\\"checkbox\\" value=\\"i\\"<?=$titlefonti?>>����\r\n	<input name=\\"titlefont[s]\\" type=\\"checkbox\\" value=\\"s\\"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name=\\"titlecolor\\" type=\\"text\\" value=\\"<?=stripSlashes($r[titlecolor])?>\\" size=\\"10\\"><a onclick=\\"foreColor();\\"><img src=\\"../data/images/color.gif\\" width=\\"21\\" height=\\"21\\" align=\\"absbottom\\"></a>\r\n  </td>\r\n</tr>\r\n</table>', '���D', 0, 1, 1, '  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>', 0, 'CHAR', '100', 1, 1, 'news', 0, '', 0, 0, 0, '<input name=\\"title\\" type=\\"text\\" size=\\"42\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'title\\\',stripSlashes($r[title]))?>\\">', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (2, 'special.field', '�S���ݩ�', '', '<table width=\\"100%\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" bgcolor=\\"#DBEAF5\\">\r\n  <tr>\r\n    <td height=\\"25\\" bgcolor=\\"#FFFFFF\\">�H���ݩ�: \r\n      <input name=\\"checked\\" type=\\"checkbox\\" value=\\"1\\"<?=$r[checked]?\\\' checked\\\':\\\'\\\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name=\\"isgood\\" id=\\"isgood\\">\r\n        <option value=\\"0\\">������</option>\r\n	<?=$ftnr[\\\'igname\\\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name=\\"firsttitle\\" id=\\"firsttitle\\">\r\n        <option value=\\"0\\">�D�Y��</option>\r\n	<?=$ftnr[\\\'ftname\\\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\" bgcolor=\\"#FFFFFF\\">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name=\\"keyboard\\" type=\\"text\\" size=\\"52\\" value=\\"<?=stripSlashes($r[keyboard])?>\\">\r\n      <font color=\\"#666666\\">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\" bgcolor=\\"#FFFFFF\\">�~���챵: \r\n      <input name=\\"titleurl\\" type=\\"text\\" value=\\"<?=stripSlashes($r[titleurl])?>\\" size=\\"52\\">\r\n      <font color=\\"#666666\\">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>', '�S���ݩ�', 0, 1, 0, '', 1, '', '', 0, 1, 'news', 0, '', 0, 0, 0, '<input name=\\"keyboard\\" type=\\"text\\" size=42 value=\\"<?=stripSlashes($r[keyboard])?>\\">\r\n<font color=\\"#666666\\">(�h�ӽХ�&quot;,&quot;�j�})</font>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (3, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a>', '���D�Ϥ�', 0, 1, 1, '  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--titlepic--]\\" size=\\"20\\">\r\n      )</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name=\\"add[qz_titlepic]\\" type=\\"text\\" id=\\"add[qz_titlepic]\\" value=\\"<?=stripSlashes($r[qz_titlepic])?>\\"> \r\n        <input name=\\"add[save_titlepic]\\" type=\\"checkbox\\" id=\\"add[save_titlepic]\\" value=\\" checked\\"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name=\\"add[zz_titlepic]\\" cols=\\"60\\" rows=\\"10\\" id=\\"add[zz_titlepic]\\"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name=\\"add[z_titlepic]\\" type=\\"text\\" id=\\"titlepic5\\" value=\\"<?=stripSlashes($r[z_titlepic])?>\\">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '120', 1, 1, 'news', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (4, 'newstime', '�o�G�ɶ�', 'text', '<input name=\\"newstime\\" type=\\"text\\" value=\\"<?=$r[newstime]?>\\"><input type=button name=button value=\\"�]����e�ɶ�\\" onclick=\\"document.add.newstime.value=\\\'<?=$todaytime?>\\\'\\">', '�o�G�ɶ�', 0, 1, 1, '  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>', 1, 'INT', '11', 1, 1, 'news', 0, '', 1, 0, 0, '', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (5, 'ftitle', '�Ƽ��D', 'text', '<input name=\\"ftitle\\" type=\\"text\\" size=60 id=\\"ftitle\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[ftitle]))?>\\">\r\n', '�Ƽ��D', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--ftitle--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_ftitle]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_ftitle]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_ftitle]" type="text" id="add[z_ftitle]" value="<?=stripSlashes($r[z_ftitle])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '120', 1, 1, 'news', 0, '', 0, 0, 1, '<input name=\\"ftitle\\" type=\\"text\\" size=42 id=\\"ftitle\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'ftitle\\\',stripSlashes($r[ftitle]))?>\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (6, 'smalltext', '���e²��', 'textarea', '<textarea name=\\"smalltext\\" cols=\\"80\\" rows=\\"10\\" id=\\"smalltext\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>\r\n', '���e²��', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--smalltext--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_smalltext]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_smalltext]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_smalltext]" type="text" id="add[z_smalltext]" value="<?=stripSlashes($r[z_smalltext])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '255', 1, 1, 'news', 0, '', 0, 1, 1, '<textarea name=\\"smalltext\\" cols=\\"60\\" rows=\\"10\\" id=\\"smalltext\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'smalltext\\\',stripSlashes($r[smalltext]))?></textarea>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 1, '');
INSERT INTO `phome_enewsf` VALUES (7, 'writer', '�@��', 'text', '<?php\r\n$writer_sql=$empire->query(\\"select writer from {$dbtbpre}enewswriter\\");\r\nwhile($w_r=$empire->fetch($writer_sql))\r\n{\r\n	$w_class.=\\"<option value=\\\'\\".$w_r[writer].\\"\\\'>\\".$w_r[writer].\\"</option>\\";\r\n}\r\n?>\r\n<input type=text name=writer value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[writer]))?>\\" size=\\"\\"> \r\n        <select name=\\"w_id\\" id=\\"select7\\" onchange=\\"document.add.writer.value=document.add.w_id.value\\">\r\n          <option>��ܧ@��</option>\r\n		  <?=$w_class?>\r\n        </select>\r\n<input type=\\"button\\" name=\\"wbutton\\" value=\\"�W�[�@��\\" onclick=\\"window.open(\\\'NewsSys/writer.php?<?=$ecms_hashur[ehref]?>&addwritername=\\\'+document.add.writer.value);\\">\r\n', '�@��', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--writer--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_writer]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_writer]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_writer]\\" type=\\"text\\" id=\\"add[z_writer]\\" value=\\"<?=stripSlashes($r[z_writer])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '30', 1, 1, 'news', 0, '', 0, 0, 1, '<input name=\\"writer\\" type=\\"text\\" id=\\"writer\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'writer\\\',stripSlashes($r[writer]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (8, 'befrom', '�H���ӷ�', 'text', '<?php\r\n$befrom_sql=$empire->query(\\"select sitename from {$dbtbpre}enewsbefrom\\");\r\nwhile($b_r=$empire->fetch($befrom_sql))\r\n{\r\n	$b_class.=\\"<option value=\\\'\\".$b_r[sitename].\\"\\\'>\\".$b_r[sitename].\\"</option>\\";\r\n}\r\n?>\r\n<input type=\\"text\\" name=\\"befrom\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[befrom]))?>\\" size=\\"\\"> \r\n        <select name=\\"befrom_id\\" id=\\"befromid\\" onchange=\\"document.add.befrom.value=document.add.befrom_id.value\\">\r\n          <option>��ܫH���ӷ�</option>\r\n          <?=$b_class?>\r\n        </select>\r\n<input type=\\"button\\" name=\\"wbutton\\" value=\\"�W�[�ӷ�\\" onclick=\\"window.open(\\\'NewsSys/BeFrom.php?<?=$ecms_hashur[ehref]?>&addsitename=\\\'+document.add.befrom.value);\\">\r\n', '�H���ӷ�', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--befrom--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_befrom]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_befrom]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_befrom]\\" type=\\"text\\" id=\\"add[z_befrom]\\" value=\\"<?=stripSlashes($r[z_befrom])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '60', 1, 1, 'news', 0, '', 0, 0, 1, '<input name=\\"befrom\\" type=\\"text\\" id=\\"befrom\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'befrom\\\',stripSlashes($r[befrom]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (9, 'newstext', '�s�D����', 'editor', '<?=ECMS_ShowEditorVar(\\"newstext\\",$ecmsfirstpost==1?\\"\\":stripSlashes($r[newstext]),\\"Default\\",\\"\\",\\"300\\",\\"100%\\")?>\r\n<table width=\\"100%\\" border=\\"0\\" cellpadding=\\"3\\" cellspacing=\\"1\\" bgcolor=\\"#DBEAF5\\">\r\n          <tr> \r\n            <td bgcolor=\\"#FFFFFF\\"> <input name=\\"dokey\\" type=\\"checkbox\\" value=\\"1\\"<?=$r[dokey]==1?\\\' checked\\\':\\\'\\\'?>>\r\n              ����r����&nbsp;&nbsp; <input name=\\"copyimg\\" type=\\"checkbox\\" id=\\"copyimg\\" value=\\"1\\">\r\n      ���{�O�s�Ϥ�(\r\n      <input name=\\"mark\\" type=\\"checkbox\\" id=\\"mark\\" value=\\"1\\">\r\n      <a href=\\"SetEnews.php<?=$ecms_hashur[whehref]?>\\" target=\\"_blank\\">�[���L</a>)&nbsp;&nbsp; \r\n      <input name=\\"copyflash\\" type=\\"checkbox\\" id=\\"copyflash\\" value=\\"1\\">\r\n      ���{�O�sFLASH(�a�}�e��G \r\n      <input name=\\"qz_url\\" type=\\"text\\" id=\\"qz_url\\" size=\\"\\">\r\n              )</td>\r\n          </tr>\r\n          <tr>\r\n            \r\n    <td bgcolor=\\"#FFFFFF\\"><input name=\\"repimgnexturl\\" type=\\"checkbox\\" id=\\"repimgnexturl\\" value=\\"1\\"> �Ϥ��챵�ର�U�@��&nbsp;&nbsp; <input name=\\"autopage\\" type=\\"checkbox\\" id=\\"autopage\\" value=\\"1\\">�۰ʤ���\r\n      ,�C \r\n      <input name=\\"autosize\\" type=\\"text\\" id=\\"autosize\\" value=\\"5000\\" size=\\"5\\">\r\n      �Ӧr�`���@��&nbsp;&nbsp; ���� \r\n      <input name=\\"getfirsttitlepic\\" type=\\"text\\" id=\\"getfirsttitlepic\\" value=\\"\\" size=\\"1\\">\r\n      �i�W�ǹϬ����D�Ϥ�( \r\n      <input name=\\"getfirsttitlespic\\" type=\\"checkbox\\" id=\\"getfirsttitlespic\\" value=\\"1\\">\r\n      �Y����: �e \r\n      <input name=\\"getfirsttitlespicw\\" type=\\"text\\" id=\\"getfirsttitlespicw\\" size=\\"3\\" value=\\"<?=$public_r[spicwidth]?>\\">\r\n      *��\r\n      <input name=\\"getfirsttitlespich\\" type=\\"text\\" id=\\"getfirsttitlespich\\" size=\\"3\\" value=\\"<?=$public_r[spicheight]?>\\">\r\n      )</td>\r\n          </tr>\r\n        </table>\r\n', '�s�D����', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--newstext--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_newstext]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_newstext]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_newstext]\\" type=\\"text\\" id=\\"add[z_newstext]\\" value=\\"<?=stripSlashes($r[z_newstext])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'MEDIUMTEXT', '', 1, 1, 'news', 0, '', 0, 1, 1, '<?=ECMS_ShowEditorVar(\\"newstext\\",$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'newstext\\\',stripSlashes($r[newstext])),\\"Default\\",\\"\\",\\"300\\",\\"100%\\")?>\r\n', 0, '', 0, '', 1, 1, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (10, 'diggtop', '��', 'text', '\r\n<input name="diggtop" type="text" id="diggtop" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[diggtop]))?>" size="">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--diggtop--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_diggtop]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_diggtop]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_diggtop]" type="text" id="add[z_diggtop]" value="<?=stripSlashes($r[z_diggtop])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 3, 'INT', '', 1, 1, 'news', 0, '', 0, 0, 1, '\r\n<input name="diggtop" type="text" id="diggtop" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'diggtop\',stripSlashes($r[diggtop]))?>" size="">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (11, 'title', '���D', 'text', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">\r\n	<?=$tts?"<select name=\'ttid\'><option value=\'0\'>���D����</option>$tts</select>":""?>\r\n	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> \r\n	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+\'(�Ϥ�)\';"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">�ݩ�: \r\n	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����\r\n	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����\r\n	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>\r\n  </td>\r\n</tr>\r\n</table>\r\n', '���D', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '100', 1, 2, 'download', 0, '', 0, 0, 0, '\r\n<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'title\',stripSlashes($r[title]))?>">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (12, 'special.field', '�S���ݩ�', '', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n  <tr>\r\n    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: \r\n      <input name="checked" type="checkbox" value="1"<?=$r[checked]?\' checked\':\'\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name="isgood" id="isgood">\r\n        <option value="0">������</option>\r\n	<?=$ftnr[\'igname\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name="firsttitle" id="firsttitle">\r\n        <option value="0">�D�Y��</option>\r\n	<?=$ftnr[\'ftname\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">\r\n      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">�~���챵: \r\n      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">\r\n      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>\r\n', '�S���ݩ�', 0, 1, 0, '\r\n\r\n', 0, '', '0', 0, 2, 'download', 0, '', 0, 0, 0, '\r\n<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">\r\n<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (13, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '���D�Ϥ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">\r\n      )</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> \r\n        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 1, 'CHAR', '120', 1, 2, 'download', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (14, 'newstime', '�o�G�ɶ�', 'text', '\r\n<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value=\'<?=$todaytime?>\'">\r\n', '�o�G�ɶ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '11', 1, 2, 'download', 0, '', 1, 0, 0, '\r\n\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (15, 'softwriter', '�@��', 'text', '<input name=\\"softwriter\\" type=\\"text\\" id=\\"softwriter\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[softwriter]))?>\\" size=\\"60\\">\r\n', '�@��', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--softwriter--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_softwriter]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softwriter]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_softwriter]" type="text" id="add[z_softwriter]" value="<?=stripSlashes($r[z_softwriter])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '30', 1, 2, 'download', 0, '', 0, 0, 1, '<input name=\\"softwriter\\" type=\\"text\\" id=\\"softwriter\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'softwriter\\\',stripSlashes($r[softwriter]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (16, 'homepage', '�x�����', 'text', '<input name=\\"homepage\\" type=\\"text\\" id=\\"homepage\\" value=\\"<?=$ecmsfirstpost==1?\\"http://\\":ehtmlspecialchars(stripSlashes($r[homepage]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--homepage--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_homepage]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_homepage]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_homepage]" type="text" id="add[z_homepage]" value="<?=stripSlashes($r[z_homepage])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '80', 1, 2, 'download', 0, 'http://', 0, 0, 1, '<input name=\\"homepage\\" type=\\"text\\" id=\\"homepage\\" value=\\"<?=$ecmsfirstpost==1?\\"http://\\":DoReqValue($mid,\\\'homepage\\\',stripSlashes($r[homepage]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (17, 'demo', '�t�κt��', 'text', '<input name=\\"demo\\" type=\\"text\\" id=\\"demo\\" value=\\"<?=$ecmsfirstpost==1?\\"http://\\":ehtmlspecialchars(stripSlashes($r[demo]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--demo--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_demo]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_demo]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_demo]" type="text" id="add[z_demo]" value="<?=stripSlashes($r[z_demo])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '120', 1, 2, 'download', 0, 'http://', 0, 0, 1, '<input name=\\"demo\\" type=\\"text\\" id=\\"demo\\" value=\\"<?=$ecmsfirstpost==1?\\"http://\\":DoReqValue($mid,\\\'demo\\\',stripSlashes($r[demo]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (18, 'softfj', '�B������', 'text', '<input name=\\"softfj\\" type=\\"text\\" id=\\"softfj\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[softfj]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--softfj--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_softfj]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softfj]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_softfj]" type="text" id="add[z_softfj]" value="<?=stripSlashes($r[z_softfj])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '255', 1, 2, 'download', 0, '', 0, 0, 1, '<input name=\\"softfj\\" type=\\"text\\" id=\\"softfj\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'softfj\\\',stripSlashes($r[softfj]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (19, 'language', '�n��y��', 'select', '<select name="language" id="language"><option value="²�餤��"<?=$r[language]=="²�餤��"?\' selected\':\'\'?>>²�餤��</option><option value="�c�餤��"<?=$r[language]=="�c�餤��"?\' selected\':\'\'?>>�c�餤��</option><option value="�^��"<?=$r[language]=="�^��"?\' selected\':\'\'?>>�^��</option><option value="�h��y��"<?=$r[language]=="�h��y��"?\' selected\':\'\'?>>�h��y��</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--language--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_language]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_language]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_language]" type="text" id="add[z_language]" value="<?=stripSlashes($r[z_language])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '16', 1, 2, 'download', 0, '²�餤��|�c�餤��|�^��|�h��y��', 0, 0, 1, '<select name="language" id="language"><option value="²�餤��"<?=$r[language]=="²�餤��"?\' selected\':\'\'?>>²�餤��</option><option value="�c�餤��"<?=$r[language]=="�c�餤��"?\' selected\':\'\'?>>�c�餤��</option><option value="�^��"<?=$r[language]=="�^��"?\' selected\':\'\'?>>�^��</option><option value="�h��y��"<?=$r[language]=="�h��y��"?\' selected\':\'\'?>>�h��y��</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (20, 'softtype', '�n������', 'select', '<select name="softtype" id="softtype"><option value="�겣�n��"<?=$r[softtype]=="�겣�n��"?\' selected\':\'\'?>>�겣�n��</option><option value="�~�Ƴn��"<?=$r[softtype]=="�~�Ƴn��"?\' selected\':\'\'?>>�~�Ƴn��</option><option value="��~�n��"<?=$r[softtype]=="��~�n��"?\' selected\':\'\'?>>��~�n��</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--softtype--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_softtype]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softtype]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_softtype]" type="text" id="add[z_softtype]" value="<?=stripSlashes($r[z_softtype])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '16', 1, 2, 'download', 0, '�겣�n��|�~�Ƴn��|��~�n��', 0, 0, 1, '<select name="softtype" id="softtype"><option value="�겣�n��"<?=$r[softtype]=="�겣�n��"?\' selected\':\'\'?>>�겣�n��</option><option value="�~�Ƴn��"<?=$r[softtype]=="�~�Ƴn��"?\' selected\':\'\'?>>�~�Ƴn��</option><option value="��~�n��"<?=$r[softtype]=="��~�n��"?\' selected\':\'\'?>>��~�n��</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (21, 'softsq', '���v�Φ�', 'select', '<select name="softsq" id="softsq"><option value="�@�ɳn��"<?=$r[softsq]=="�@�ɳn��"?\' selected\':\'\'?>>�@�ɳn��</option><option value="�K�O�n��"<?=$r[softsq]=="�K�O�n��"?\' selected\':\'\'?>>�K�O�n��</option><option value="�ۥѳn��"<?=$r[softsq]=="�ۥѳn��"?\' selected\':\'\'?>>�ۥѳn��</option><option value="�եγn��"<?=$r[softsq]=="�եγn��"?\' selected\':\'\'?>>�եγn��</option><option value="�t�ܳn��"<?=$r[softsq]=="�t�ܳn��"?\' selected\':\'\'?>>�t�ܳn��</option><option value="�ӷ~�n��"<?=$r[softsq]=="�ӷ~�n��"?\' selected\':\'\'?>>�ӷ~�n��</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--softsq--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_softsq]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softsq]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_softsq]" type="text" id="add[z_softsq]" value="<?=stripSlashes($r[z_softsq])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '16', 1, 2, 'download', 0, '�@�ɳn��|�K�O�n��|�ۥѳn��|�եγn��|�t�ܳn��|�ӷ~�n��', 0, 0, 1, '<select name="softsq" id="softsq"><option value="�@�ɳn��"<?=$r[softsq]=="�@�ɳn��"?\' selected\':\'\'?>>�@�ɳn��</option><option value="�K�O�n��"<?=$r[softsq]=="�K�O�n��"?\' selected\':\'\'?>>�K�O�n��</option><option value="�ۥѳn��"<?=$r[softsq]=="�ۥѳn��"?\' selected\':\'\'?>>�ۥѳn��</option><option value="�եγn��"<?=$r[softsq]=="�եγn��"?\' selected\':\'\'?>>�եγn��</option><option value="�t�ܳn��"<?=$r[softsq]=="�t�ܳn��"?\' selected\':\'\'?>>�t�ܳn��</option><option value="�ӷ~�n��"<?=$r[softsq]=="�ӷ~�n��"?\' selected\':\'\'?>>�ӷ~�n��</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (22, 'star', '�n�󵥯�', 'select', '<select name=\\"star\\" id=\\"star\\"><option value=\\"1\\"<?=$r[star]==\\"1\\"?\\\' selected\\\':\\\'\\\'?>>1�P</option><option value=\\"2\\"<?=$r[star]==\\"2\\"||$ecmsfirstpost==1?\\\' selected\\\':\\\'\\\'?>>2�P</option><option value=\\"3\\"<?=$r[star]==\\"3\\"?\\\' selected\\\':\\\'\\\'?>>3�P</option><option value=\\"4\\"<?=$r[star]==\\"4\\"?\\\' selected\\\':\\\'\\\'?>>4�P</option><option value=\\"5\\"<?=$r[star]==\\"5\\"?\\\' selected\\\':\\\'\\\'?>>5�P</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--star--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_star]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_star]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_star]" type="text" id="add[z_star]" value="<?=stripSlashes($r[z_star])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'TINYINT', '1', 1, 2, 'download', 0, '1|2:default|3|4|5', 0, 0, 1, '<select name=\\"star\\" id=\\"star\\"><option value=\\"1\\"<?=$r[star]==\\"1\\"?\\\' selected\\\':\\\'\\\'?>>1�P</option><option value=\\"2\\"<?=$r[star]==\\"2\\"||$ecmsfirstpost==1?\\\' selected\\\':\\\'\\\'?>>2�P</option><option value=\\"3\\"<?=$r[star]==\\"3\\"?\\\' selected\\\':\\\'\\\'?>>3�P</option><option value=\\"4\\"<?=$r[star]==\\"4\\"?\\\' selected\\\':\\\'\\\'?>>4�P</option><option value=\\"5\\"<?=$r[star]==\\"5\\"?\\\' selected\\\':\\\'\\\'?>>5�P</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (23, 'filetype', '�������', 'text', '<input name=\\"filetype\\" type=\\"text\\" id=\\"filetype\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[filetype]))?>\\" size=\\"\\">\r\n<select name=\\"select2\\" onchange=\\"document.add.filetype.value=this.value\\">\r\n        <option value=\\"\\">����</option>\r\n        <option value=\\".zip\\">.zip</option>\r\n        <option value=\\".rar\\">.rar</option>\r\n        <option value=\\".exe\\">.exe</option>\r\n      </select>', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--filetype--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_filetype]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_filetype]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_filetype]" type="text" id="add[z_filetype]" value="<?=stripSlashes($r[z_filetype])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '10', 1, 2, 'download', 0, '', 0, 0, 1, '<input name=\\"filetype\\" type=\\"text\\" id=\\"filetype\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'filetype\\\',stripSlashes($r[filetype]))?>\\" size=\\"10\\">\r\n<select name=\\"select2\\" onchange=\\"document.add.filetype.value=this.value\\">\r\n        <option value=\\"\\">����</option>\r\n        <option value=\\".zip\\">.zip</option>\r\n        <option value=\\".rar\\">.rar</option>\r\n        <option value=\\".exe\\">.exe</option>\r\n      </select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (24, 'filesize', '���j�p', 'text', '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[filesize]))?>\\" size=\\"\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', '', 1, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--filesize--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_filesize]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_filesize]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_filesize]" type="text" id="add[z_filesize]" value="<?=stripSlashes($r[z_filesize])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '16', 1, 2, 'download', 0, '', 0, 0, 1, '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'filesize\\\',stripSlashes($r[filesize]))?>\\" size=\\"10\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (25, 'downpath', '�U���a�}', 'text', '<script>\r\nfunction doadd()\r\n{var i;\r\nvar str=\\"\\";\r\nvar oldi=0;\r\nvar j=0;\r\noldi=parseInt(document.add.editnum.value);\r\nfor(i=1;i<=document.add.downnum.value;i++)\r\n{\r\nj=i+oldi;\r\nstr=str+\\"<tr><td width=7%> <div align=center>\\"+j+\\"</div></td><td width=19%><div align=left><input name=downname[] type=text id=downname[] value=�U���a�}\\"+j+\\" size=17></div></td><td width=40%><input name=downpath[] type=text size=36 id=downpath\\"+j+\\" ondblclick=SpOpenChFile(0,\\\'downpath\\"+j+\\"\\\')><select name=thedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option><?=$newdownqz?></select></td><td width=21%><div align=center><select name=downuser[] id=select><option value=0>�C��</option><?=$ygroup?></select></div></td><td width=13%><div align=center><input name=fen[] type=text id=fen[] value=0 size=6></div></td></tr>\\";\r\n}\r\ndocument.getElementById(\\"adddown\\").innerHTML=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\"+str+\\"</table>\\";\r\n}\r\n</script>\r\n<table width=\\"100%\\" border=\\"0\\" cellspacing=\\"0\\" cellpadding=\\"0\\">\r\n  <tr>\r\n    <td height=\\"25\\">�U���a�}�e��&nbsp;:\r\n      <input name=\\"downurl_qz\\" type=\\"text\\" size=\\"32\\">\r\n      <select name=\\"changeurl_qz\\" onchange=\\"document.add.downurl_qz.value=document.add.changeurl_qz.value\\">\r\n        <option value=\\"\\" selected>��ܫe��</option>\r\n        <?=$downurlqz?>\r\n      </select>\r\n	  </td>\r\n  </tr>\r\n  <tr>\r\n    <td height=\\"25\\">���/�W�Ǫ���:\r\n      <input name=\\"changedown_url\\" id=\\"changedown_url\\" type=\\"text\\" size=\\"32\\">\r\n      <input type=\\"button\\" name=\\"Submit\\" value=\\"���\\" onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=0&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=changedown_url<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\">&nbsp;\r\n	  <input type=\\"button\\" name=\\"Submit\\" value=\\"�ƻs\\" onclick=\\"document.getElementById(\\\'changedown_url\\\').focus();document.getElementById(\\\'changedown_url\\\').select();clipboardData.setData(\\\'text\\\',document.getElementById(\\\'changedown_url\\\').value);\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td><table width=\\"100%\\" border=\\"0\\" cellpadding=\\"3\\" cellspacing=\\"1\\" bgcolor=\\"#DBEAF5\\">\r\n        <tr> \r\n          <td width=\\"7%\\"> <div align=\\"center\\">�s��</div></td>\r\n          <td width=\\"19%\\"><div align=\\"left\\">�U���W��</div></td>\r\n          <td width=\\"40%\\">�U���a�} <font color=\\"#666666\\">(�������)</font></td>\r\n          <td width=\\"21%\\"> <div align=\\"center\\">�v��</div></td>\r\n          <td width=\\"13%\\"> <div align=\\"center\\">�I��</div></td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n  <tr> \r\n    <td>\r\n    <?php\r\n    if($ecmsfirstpost==1)\r\n    {\r\n    ?>\r\n	<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\r\n	<?php\r\n	$editnum=3;\r\n	for($pathi=1;$pathi<=$editnum;$pathi++)\r\n	{\r\n	?>\r\n           <tr> \r\n              <td width=\\\'7%\\\'> <div align=center><?=$pathi?></div></td>\r\n              <td width=\\\'19%\\\'> <div align=left> \r\n                  <input name=downname[] type=text value=\\\'�U���a�}<?=$pathi?>\\\' size=17>\r\n                    </div></td>\r\n              <td width=\\\'40%\\\'>\r\n	      <input name=downpath[] type=text size=36 id=\\\'downpath<?=$pathi?>\\\' ondblclick=\\"SpOpenChFile(0,\\\'downpath<?=$pathi?>\\\');\\">\r\n	      <select name=thedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option><?=$newdownqz?></select> \r\n                  </td>\r\n                  <td width=\\\'21%\\\'><div align=center> \r\n                      <select name=downuser[]>\r\n                        <option value=0>�C��</option>\r\n                        <?=$ygroup?>\r\n                      </select>\r\n                    </div></td>\r\n                  <td width=\\\'13%\\\'> <div align=center> \r\n                      <input name=fen[] type=text value=0 size=6>\r\n                    </div></td>\r\n            </tr>\r\n	<?php\r\n	}\r\n	?>\r\n	</table>\r\n    <?php\r\n    }\r\n    else\r\n    {\r\n	$editnum=0;\r\n	$downloadpath=\\"\\";\r\n	if($r[downpath])\r\n	{\r\n		$r[downpath]=stripSlashes($r[downpath]);\r\n		//�U���a�}\r\n		$j=0;\r\n		$d_record=explode(\\"\\\\r\\\\n\\",$r[downpath]);\r\n		for($i=0;$i<count($d_record);$i++)\r\n		{\r\n			$j=$i+1;\r\n			$d_field=explode(\\"::::::\\",$d_record[$i]);\r\n			//�v��\r\n			$tgroup=str_replace(\\" value=\\".$d_field[2].\\">\\",\\" value=\\".$d_field[2].\\" selected>\\",$ygroup);\r\n			//�a�}�e��\r\n			$tnewdownqz=str_replace(\\" value=\\\'\\".$d_field[4].\\"\\\'>\\",\\" value=\\\'\\".$d_field[4].\\"\\\' selected>\\",$newdownqz);\r\n			$downloadpath.=\\"<tr><td width=\\\'7%\\\'><div align=center>\\".$j.\\"</div></td><td width=\\\'19%\\\'><div align=left><input name=downname[] type=text id=downname[] value=\\\'\\".$d_field[0].\\"\\\' size=17></div></td><td width=\\\'40%\\\'><input name=downpath[] type=text id=downpath\\".$j.\\" value=\\\'\\".$d_field[1].\\"\\\' size=36 ondblclick=\\\\\\"SpOpenChFile(0,\\\'downpath\\".$j.\\"\\\');\\\\\\"><select name=thedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option>\\".$tnewdownqz.\\"</select><input type=hidden name=pathid[] value=\\".$j.\\"><input type=checkbox name=delpathid[] value=\\".$j.\\">�R</td><td width=\\\'21%\\\'><div align=center><select name=downuser[] id=select><option value=0>�C��</option>\\".$tgroup.\\"</select></div></td><td width=\\\'13%\\\'><div align=center><input name=fen[] type=text id=fen[] value=\\\'\\".$d_field[3].\\"\\\' size=6></div></td></tr>\\";\r\n		}\r\n		$editnum=$j;\r\n		$downloadpath=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\".$downloadpath.\\"</table>\\";\r\n	}\r\n	echo $downloadpath;\r\n    }\r\n    ?>\r\n    </td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\">�U���a�}�X�i�ƶq: <input name=\\"editnum\\" type=\\"hidden\\" id=\\"editnum\\" value=\\"<?=$editnum?>\\">\r\n      <input name=\\"downnum\\" type=\\"text\\" id=\\"downnum\\" value=\\"1\\" size=\\"6\\"> <input type=\\"button\\" name=\\"Submit5\\" value=\\"��X�a�}\\" onclick=\\"javascript:doadd();\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td id=adddown></td>\r\n  </tr>\r\n</table>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (\r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--ecmsdownpathurl--]\\" size=\\"20\\">\r\n      <br>\r\n      <input name=\\"textfield2\\" type=\\"text\\" id=\\"textfield2\\" value=\\"[!--ecmsdownpathname--]\\" size=\\"20\\">\r\n      )<br>\r\n      �榡:�a�}���h(url)[!empirecms!]�W�٥��h(name)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_downpath]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_downpath]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td>�a�}�e��:\r\n<input name=\\"add[qz_downpath]\\" type=\\"text\\" id=\\"add[qz_downpath]\\" value=\\"<?=stripSlashes($r[qz_downpath])?>\\">\r\n        </td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'MEDIUMTEXT', '', 1, 2, 'download', 0, '', 0, 0, 1, '<input type=\\"file\\" name=\\"downpathfile\\" size=\\"45\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (26, 'softsay', '�n��²��', 'textarea', '<textarea name=\\"softsay\\" cols=\\"80\\" rows=\\"10\\" id=\\"softsay\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[softsay]))?></textarea>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--softsay--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_softsay]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_softsay]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_softsay]\\" type=\\"text\\" id=\\"add[z_softsay]\\" value=\\"<?=stripSlashes($r[z_softsay])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'TEXT', '', 1, 2, 'download', 0, '', 0, 1, 1, '<textarea name=\\"softsay\\" cols=\\"60\\" rows=\\"10\\" id=\\"softsay\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'softsay\\\',stripSlashes($r[softsay]))?></textarea>\r\n', 0, '', 0, '80,10', 0, 0, '', '', '', '', '', '', 0, 1, '');
INSERT INTO `phome_enewsf` VALUES (27, 'title', '���D', 'text', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">\r\n	<?=$tts?"<select name=\'ttid\'><option value=\'0\'>���D����</option>$tts</select>":""?>\r\n	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> \r\n	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+\'(�Ϥ�)\';"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">�ݩ�: \r\n	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����\r\n	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����\r\n	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>\r\n  </td>\r\n</tr>\r\n</table>\r\n', '���D', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '100', 1, 3, 'photo', 0, '', 0, 0, 0, '\r\n<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'title\',stripSlashes($r[title]))?>">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (28, 'special.field', '�S���ݩ�', '', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n  <tr>\r\n    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: \r\n      <input name="checked" type="checkbox" value="1"<?=$r[checked]?\' checked\':\'\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name="isgood" id="isgood">\r\n        <option value="0">������</option>\r\n	<?=$ftnr[\'igname\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name="firsttitle" id="firsttitle">\r\n        <option value="0">�D�Y��</option>\r\n	<?=$ftnr[\'ftname\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">\r\n      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">�~���챵: \r\n      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">\r\n      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>\r\n', '�S���ݩ�', 0, 1, 0, '\r\n\r\n', 0, '', '0', 0, 3, 'photo', 0, '', 0, 0, 0, '\r\n<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">\r\n<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (29, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '���D�Ϥ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">\r\n      )</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> \r\n        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '120', 1, 3, 'photo', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (30, 'newstime', '�o�G�ɶ�', 'text', '\r\n<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value=\'<?=$todaytime?>\'">\r\n', '�o�G�ɶ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '11', 1, 3, 'photo', 0, '', 1, 0, 0, '\r\n\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (31, 'filesize', '���j�p', 'text', '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[filesize]))?>\\" size=\\"60\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--filesize--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_filesize]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_filesize]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_filesize]\\" type=\\"text\\" id=\\"add[z_filesize]\\" value=\\"<?=stripSlashes($r[z_filesize])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '10', 1, 3, 'photo', 0, '', 0, 0, 1, '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'filesize\\\',stripSlashes($r[filesize]))?>\\" size=\\"42\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (32, 'picsize', '�Ϥ��ؤo', 'text', '<input name=\\"picsize\\" type=\\"text\\" id=\\"picsize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[picsize]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--picsize--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_picsize]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_picsize]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_picsize]\\" type=\\"text\\" id=\\"add[z_picsize]\\" value=\\"<?=stripSlashes($r[z_picsize])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '20', 1, 3, 'photo', 0, '', 0, 0, 1, '<input name=\\"picsize\\" type=\\"text\\" id=\\"picsize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'picsize\\\',stripSlashes($r[picsize]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (33, 'picfbl', '�Ϥ�����v', 'text', '<input name=\\"picfbl\\" type=\\"text\\" id=\\"picfbl\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[picfbl]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--picfbl--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_picfbl]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_picfbl]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_picfbl]\\" type=\\"text\\" id=\\"add[z_picfbl]\\" value=\\"<?=stripSlashes($r[z_picfbl])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '20', 1, 3, 'photo', 0, '', 0, 0, 1, '<input name=\\"picfbl\\" type=\\"text\\" id=\\"picfbl\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'picfbl\\\',stripSlashes($r[picfbl]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (34, 'picfrom', '�ӷ�', 'text', '<input name=\\"picfrom\\" type=\\"text\\" id=\\"picfrom\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[picfrom]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--picfrom--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_picfrom]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_picfrom]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_picfrom]\\" type=\\"text\\" id=\\"add[z_picfrom]\\" value=\\"<?=stripSlashes($r[z_picfrom])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '120', 1, 3, 'photo', 0, '', 0, 0, 1, '<input name=\\"picfrom\\" type=\\"text\\" id=\\"picfrom\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'picfrom\\\',stripSlashes($r[picfrom]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (35, 'picurl', '�Ϥ��j��', 'img', '<input name=\\"picurl\\" type=\\"text\\" id=\\"picurl\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[picurl]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=picurl<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--picurl--]\\" size=\\"20\\">\r\n      )</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name=\\"add[qz_picurl]\\" type=\\"text\\" id=\\"add[qz_picurl]\\" value=\\"<?=stripSlashes($r[qz_picurl])?>\\"> \r\n        <input name=\\"add[save_picurl]\\" type=\\"checkbox\\" id=\\"add[save_picurl]\\" value=\\" checked\\"<?=$r[save_picurl]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name=\\"add[zz_picurl]\\" cols=\\"60\\" rows=\\"10\\" id=\\"add[zz_picurl]\\"><?=ehtmlspecialchars(stripSlashes($r[zz_picurl]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name=\\"add[z_picurl]\\" type=\\"text\\" id=\\"picurl5\\" value=\\"<?=stripSlashes($r[z_picurl])?>\\">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 2, 'VARCHAR', '200', 1, 3, 'photo', 0, '', 0, 0, 1, '<input type=\\"file\\" name=\\"picurlfile\\" size=\\"45\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (36, 'morepic', '�Ϥ���', 'text', '<script>\r\nfunction dopicadd()\r\n{var i;\r\nvar str=\\"\\";\r\nvar oldi=0;\r\nvar j=0;\r\noldi=parseInt(document.add.morepicnum.value);\r\nfor(i=1;i<=document.add.downmorepicnum.value;i++)\r\n{\r\nj=i+oldi;\r\nstr=str+\\"<tr><td width=7%><div align=center>\\"+j+\\"</div></td><td width=33%><div align=center><input name=msmallpic[] type=text size=28 id=msmallpic\\"+j+\\" ondblclick=SpOpenChFile(1,\\\'msmallpic\\"+j+\\"\\\')><br><input type=file name=msmallpfile[] size=15></div></td><td width=30%><div align=center><input name=mbigpic[] type=text size=28 id=mbigpic\\"+j+\\" ondblclick=SpOpenChFile(1,\\\'mbigpic\\"+j+\\"\\\')><br><input type=file name=mbigpfile[] size=15></div></td><td width=30%><div align=center><input name=mpicname[] type=text></div></td></tr>\\";\r\n}\r\ndocument.getElementById(\\"addpicdown\\").innerHTML=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\"+str+\\"</table>\\";\r\n}\r\n</script>\r\n<table width=\\"100%\\" border=\\"0\\" cellspacing=\\"0\\" cellpadding=\\"0\\">\r\n  <tr>\r\n    <td height=\\"25\\">\r\n	�Ϥ��a�}�e��:\r\n      <input name=\\"mpicurl_qz\\" type=\\"text\\" id=\\"mpicurl_qz\\">&nbsp;&nbsp;\r\n	  <input type=\\"checkbox\\" name=\\"msavepic\\" value=\\"1\\">���{�O�s&nbsp;<input type=\\"checkbox\\" name=\\"mcreatespic\\" value=\\"1\\" onclick=\\"if(this.checked){setmcreatespic.style.display=\\\'\\\';}else{setmcreatespic.style.display=\\\'none\\\';}\\">�ͦ��Y��\r\n	  <span id=\\"setmcreatespic\\" style=\\"display:none\\">�G<input type=text name=\\"mcreatespicwidth\\" size=4 value=\\"<?=$public_r[spicwidth]?>\\">*<input type=text name=\\"mcreatespicheight\\" size=4 value=\\"<?=$public_r[spicheight]?>\\">(�e*��)</span>\r\n<?php\r\nif(TranmoreIsOpen())\r\n{\r\n?>\r\n<input type="button" name="Submit" value="�h��W��" onclick="window.open(\'ecmseditor/tranmore/tranmore.php?type=1&classid=<?=$classid?>&filepass=<?=$filepass?>&infoid=<?=$id?>&modtype=0&sinfo=1&ecmsdo=ecmstmmorepic&tranfrom=2<?=$ecms_hashur[\'ehref\']?>&oldmorepicnum=\'+document.add.morepicnum.value,\'ecmstmpage\',\'width=700,height=550,scrollbars=yes\');">\r\n<?php\r\n}\r\n?>\r\n </td>\r\n  </tr>\r\n  <tr> \r\n    <td><table width=\\"100%\\" border=0 align=center cellpadding=3 cellspacing=1>\r\n  <tr bgcolor=\\"#DBEAF5\\"> \r\n    <td width=\\"7%\\"><div align=center>�s��</div></td>\r\n    <td width=\\"33%\\"><div align=center>�Y�� <font color=\\"#666666\\">(�������)</font></div></td>\r\n    <td width=\\"30%\\"><div align=center>�j�� <font color=\\"#666666\\">(�������)</font></div></td>\r\n    <td width=\\"30%\\"><div align=center>�Ϥ�����</div></td>\r\n  </tr>\r\n</table></td>\r\n  </tr>\r\n  <tr> \r\n    <td id=defmorepicid>\r\n    <?php\r\n    if($ecmsfirstpost==1)\r\n    {\r\n	?>\r\n	<table width=\\\'100%\\\' border=0 align=center cellpadding=3 cellspacing=1>\r\n	<?php\r\n	$morepicnum=3;\r\n	for($mppathi=1;$mppathi<=$morepicnum;$mppathi++)\r\n	{\r\n	?>\r\n	<tr> \r\n		<td width=\\\'7%\\\'><div align=center><?=$mppathi?></div></td>\r\n		<td width=\\\'33%\\\'><div align=center>\r\n		<input name=msmallpic[] type=text id=\\\'msmallpic<?=$mppathi?>\\\' size=28 ondblclick=\\"SpOpenChFile(1,\\\'msmallpic<?=$mppathi?>\\\');\\">\r\n		<br><input type=file name=msmallpfile[] size=15>\r\n		</div></td>\r\n		<td width=\\\'30%\\\'><div align=center>\r\n		<input name=mbigpic[] type=text id=\\\'mbigpic<?=$mppathi?>\\\' size=28 ondblclick=\\"SpOpenChFile(1,\\\'mbigpic<?=$mppathi?>\\\');\\">\r\n		<br><input type=file name=mbigpfile[] size=15>\r\n		</div></td>\r\n		<td width=\\\'30%\\\'><div align=center>\r\n		<input name=mpicname[] type=text id=\\\'mpicname<?=$mppathi?>\\\'>\r\n		</div></td>\r\n	</tr>\r\n	<?php\r\n	}\r\n	?>\r\n	</table>\r\n	<?php\r\n    }\r\n    else\r\n    {\r\n	$morepicpath=\\"\\";\r\n	$morepicnum=0;\r\n	if($r[morepic])\r\n    	{\r\n    		$r[morepic]=stripSlashes($r[morepic]);\r\n    		//�a�}\r\n    		$j=0;\r\n    		$pd_record=explode(\\"\\\\r\\\\n\\",$r[morepic]);\r\n    		for($i=0;$i<count($pd_record);$i++)\r\n    		{\r\n			$j=$i+1;\r\n    			$pd_field=explode(\\"::::::\\",$pd_record[$i]);\r\n			$morepicpath.=\\"<tr> \r\n    <td width=\\\'7%\\\'><div align=center>\\".$j.\\"</div></td>\r\n    <td width=\\\'33%\\\'><div align=center>\r\n        <input name=msmallpic[] type=text value=\\\'\\".$pd_field[0].\\"\\\' size=28 id=msmallpic\\".$j.\\" ondblclick=\\\\\\"SpOpenChFile(1,\\\'msmallpic\\".$j.\\"\\\');\\\\\\">\r\n		<br><input type=file name=msmallpfile[] size=15>\r\n      </div></td>\r\n    <td width=\\\'30%\\\'><div align=center>\r\n        <input name=mbigpic[] type=text value=\\\'\\".$pd_field[1].\\"\\\' size=28 id=mbigpic\\".$j.\\" ondblclick=\\\\\\"SpOpenChFile(1,\\\'mbigpic\\".$j.\\"\\\');\\\\\\">\r\n		<br><input type=file name=mbigpfile[] size=15>\r\n      </div></td>\r\n    <td width=\\\'30%\\\'><div align=center>\r\n        <input name=mpicname[] type=text value=\\\'\\".$pd_field[2].\\"\\\'><input type=hidden name=mpicid[] value=\\".$j.\\"><input type=checkbox name=mdelpicid[] value=\\".$j.\\">�R\r\n      </div></td>\r\n  </tr>\\";\r\n    		}\r\n    		$morepicnum=$j;\r\n    		$morepicpath=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\".$morepicpath.\\"</table>\\";\r\n    	}\r\n	echo $morepicpath;\r\n    }\r\n    ?>\r\n    </td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\">�a�}�X�i�ƶq: <input name=\\"morepicnum\\" type=\\"hidden\\" id=\\"morepicnum\\" value=\\"<?=$morepicnum?>\\">\r\n      <input name=\\"downmorepicnum\\" type=\\"text\\" value=\\"1\\" size=\\"6\\"> <input type=\\"button\\" name=\\"Submit5\\" value=\\"��X�a�}\\" onclick=\\"javascript:dopicadd();\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td id=addpicdown></td>\r\n  </tr>\r\n</table>\r\n', '', 1, 1, 1, '  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (\r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--ecmsspicurl--]\\" size=\\"20\\">\r\n      <br>\r\n      <input name=\\"textfield2\\" type=\\"text\\" id=\\"textfield2\\" value=\\"[!--ecmsbpicurl--]\\" size=\\"20\\">\r\n	  <br>\r\n      <input name=\\"textfield2\\" type=\\"text\\" id=\\"textfield2\\" value=\\"[!--ecmspicname--]\\" size=\\"20\\">\r\n      )<br>\r\n      �榡:�Y����[!empirecms!]�j��[!empirecms!]�W��</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_morepic]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_morepic]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td>�a�}�e��:\r\n<input name=\\"add[qz_morepic]\\" type=\\"text\\" id=\\"add[qz_morepic]\\" value=\\"<?=stripSlashes($r[qz_morepic])?>\\">\r\n<input name=\\"add[save_morepic]\\" type=\\"checkbox\\" id=\\"add[save_morepic]\\" value=\\" checked\\"<?=$r[save_morepic]?>>\r\n        ���{�O�s\r\n        </td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'MEDIUMTEXT', '', 1, 3, 'photo', 0, '', 0, 0, 1, '<script>\r\nfunction dopicadd()\r\n{var i;\r\nvar str=\\"\\";\r\nvar oldi=0;\r\nvar j=0;\r\noldi=parseInt(document.add.morepicnum.value);\r\nfor(i=1;i<=document.add.downmorepicnum.value;i++)\r\n{\r\nj=i+oldi;\r\nstr=str+\\"<tr><td width=7%><div align=center>\\"+j+\\"</div></td><td width=33%><div align=center><input name=msmallpic[] type=text size=28 id=msmallpic\\"+j+\\"></div></td><td width=30%><div align=center><input name=mbigpic[] type=text size=28 id=mbigpic\\"+j+\\"></div></td><td width=30%><div align=center><input name=mpicname[] type=text></div></td></tr>\\";\r\n}\r\ndocument.getElementById(\\"addpicdown\\").innerHTML=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\"+str+\\"</table>\\";\r\n}\r\n</script>\r\n<table width=\\"100%\\" border=\\"0\\" cellspacing=\\"0\\" cellpadding=\\"0\\">\r\n  <tr>\r\n    <td height=\\"25\\">\r\n	�Ϥ��a�}�e��:\r\n      <input name=\\"mpicurl_qz\\" type=\\"text\\" id=\\"mpicurl_qz\\" size=\\"32\\">\r\n      &nbsp;</td>\r\n  </tr>\r\n  <tr> \r\n    <td><table width=100% border=0 align=center cellpadding=3 cellspacing=1>\r\n  <tr bgcolor=\\\'#DBEAF5\\\'> \r\n    <td width=7%><div align=center>�s��</div></td>\r\n    <td width=33%><div align=center>�Y��</div></td>\r\n    <td width=30%><div align=center>�j��</div></td>\r\n    <td width=30%><div align=center>�Ϥ�����</div></td>\r\n  </tr>\r\n</table></td>\r\n  </tr>\r\n  <tr> \r\n    <td id=defmorepicid> \r\n    <?php\r\n    if($ecmsfirstpost==1)\r\n    {\r\n	?>\r\n	<table width=\\\'100%\\\' border=0 align=center cellpadding=3 cellspacing=1>\r\n	<?php\r\n	$morepicnum=3;\r\n	for($mppathi=1;$mppathi<=$morepicnum;$mppathi++)\r\n	{\r\n	?>\r\n	<tr> \r\n		<td width=\\\'7%\\\'><div align=center><?=$mppathi?></div></td>\r\n		<td width=\\\'33%\\\'><div align=center>\r\n		<input name=msmallpic[] type=text id=msmallpic[] size=28>\r\n		</div></td>\r\n		<td width=\\\'30%\\\'><div align=center>\r\n		<input name=mbigpic[] type=text id=mbigpic[] size=28>\r\n		</div></td>\r\n		<td width=\\\'30%\\\'><div align=center>\r\n		<input name=mpicname[] type=text id=mpicname[]>\r\n		</div></td>\r\n	</tr>\r\n	<?php\r\n	}\r\n	?>\r\n	</table>\r\n	<?php\r\n    }\r\n    else\r\n    {\r\n	$morepicpath=\\"\\";\r\n	$morepicnum=0;\r\n	if($r[morepic])\r\n	{\r\n		$r[morepic]=stripSlashes($r[morepic]);\r\n		//�a�}\r\n		$j=0;\r\n		$pd_record=explode(\\"\\\\r\\\\n\\",$r[morepic]);\r\n		for($i=0;$i<count($pd_record);$i++)\r\n		{\r\n			$j=$i+1;\r\n			$pd_field=explode(\\"::::::\\",$pd_record[$i]);\r\n			$morepicpath.=\\"<tr> \r\n	<td width=\\\'7%\\\'><div align=center>\\".$j.\\"</div></td>\r\n    <td width=\\\'33%\\\'><div align=center>\r\n        <input name=msmallpic[] type=text value=\\\'\\".$pd_field[0].\\"\\\' size=28>\r\n      </div></td>\r\n    <td width=\\\'30%\\\'><div align=center>\r\n        <input name=mbigpic[] type=text value=\\\'\\".$pd_field[1].\\"\\\' size=28>\r\n      </div></td>\r\n    <td width=\\\'30%\\\'><div align=center>\r\n        <input name=mpicname[] type=text value=\\\'\\".$pd_field[2].\\"\\\'><input type=hidden name=mpicid[] value=\\".$j.\\"><input type=checkbox name=mdelpicid[] value=\\".$j.\\">�R\r\n      </div></td></tr>\\";\r\n		}\r\n		$morepicnum=$j;\r\n		$morepicpath=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\".$morepicpath.\\"</table>\\";\r\n	}\r\n	echo $morepicpath;\r\n    }\r\n    ?>\r\n    </td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\">�a�}�X�i�ƶq: <input name=\\"morepicnum\\" type=\\"hidden\\" id=\\"morepicnum\\" value=\\"<?=$morepicnum?>\\">\r\n      <input name=\\"downmorepicnum\\" type=\\"text\\" value=\\"1\\" size=\\"6\\"> <input type=\\"button\\" name=\\"Submit5\\" value=\\"��X�a�}\\" onclick=\\"javascript:dopicadd();\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td id=addpicdown></td>\r\n  </tr>\r\n</table>\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (37, 'num', '�C����ܱ���', 'text', '<input name=\\"num\\" type=\\"text\\" id=\\"num\\" value=\\"<?=$ecmsfirstpost==1?\\"3\\":ehtmlspecialchars(stripSlashes($r[num]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--num--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_num]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_num]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_num]\\" type=\\"text\\" id=\\"add[z_num]\\" value=\\"<?=stripSlashes($r[z_num])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'TINYINT', '', 1, 3, 'photo', 0, '3', 0, 0, 1, '<input name=\\"num\\" type=\\"text\\" id=\\"num\\" value=\\"<?=$ecmsfirstpost==1?\\"3\\":DoReqValue($mid,\\\'num\\\',stripSlashes($r[num]))?>\\" size=\\"3\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (38, 'width', '�Y�ϼe��', 'text', '<input name=\\"width\\" type=\\"text\\" id=\\"width\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[width]))?>\\" size=\\"6\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--width--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_width]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_width]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_width]\\" type=\\"text\\" id=\\"add[z_width]\\" value=\\"<?=stripSlashes($r[z_width])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'VARCHAR', '12', 1, 3, 'photo', 0, '', 0, 0, 1, '<input name=\\"width\\" type=\\"text\\" id=\\"width\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'width\\\',stripSlashes($r[width]))?>\\" size=\\"6\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (39, 'height', '�Y�ϰ���', 'text', '<input name=\\"height\\" type=\\"text\\" id=\\"height\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[height]))?>\\" size=\\"6\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--height--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_height]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_height]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_height]\\" type=\\"text\\" id=\\"add[z_height]\\" value=\\"<?=stripSlashes($r[z_height])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'VARCHAR', '12', 1, 3, 'photo', 0, '', 0, 0, 1, '<input name=\\"height\\" type=\\"text\\" id=\\"height\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'height\\\',stripSlashes($r[height]))?>\\" size=\\"6\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (40, 'picsay', '�Ϥ�²��', 'textarea', '<textarea name=\\"picsay\\" cols=\\"80\\" rows=\\"10\\" id=\\"picsay\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[picsay]))?></textarea>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--picsay--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_picsay]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_picsay]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_picsay]\\" type=\\"text\\" id=\\"add[z_picsay]\\" value=\\"<?=stripSlashes($r[z_picsay])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'TEXT', '', 1, 3, 'photo', 0, '', 0, 1, 1, '<textarea name=\\"picsay\\" cols=\\"60\\" rows=\\"10\\" id=\\"picsay\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'picsay\\\',stripSlashes($r[picsay]))?></textarea>\r\n', 0, '', 0, '80,10', 0, 0, '', '', '', '', '', '', 0, 1, '');
INSERT INTO `phome_enewsf` VALUES (41, 'title', '���D', 'text', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">\r\n	<?=$tts?"<select name=\'ttid\'><option value=\'0\'>���D����</option>$tts</select>":""?>\r\n	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> \r\n	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+\'(�Ϥ�)\';"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">�ݩ�: \r\n	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����\r\n	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����\r\n	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>\r\n  </td>\r\n</tr>\r\n</table>\r\n', '���D', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '100', 1, 4, 'flash', 0, '', 0, 0, 0, '\r\n<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'title\',stripSlashes($r[title]))?>">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (42, 'special.field', '�S���ݩ�', '', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n  <tr>\r\n    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: \r\n      <input name="checked" type="checkbox" value="1"<?=$r[checked]?\' checked\':\'\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name="isgood" id="isgood">\r\n        <option value="0">������</option>\r\n	<?=$ftnr[\'igname\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name="firsttitle" id="firsttitle">\r\n        <option value="0">�D�Y��</option>\r\n	<?=$ftnr[\'ftname\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">\r\n      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">�~���챵: \r\n      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">\r\n      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>\r\n', '�S���ݩ�', 0, 1, 0, '\r\n\r\n', 0, '', '0', 0, 4, 'flash', 0, '', 0, 0, 0, '\r\n<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">\r\n<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (43, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '���D�Ϥ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">\r\n      )</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> \r\n        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 1, 'CHAR', '120', 1, 4, 'flash', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (44, 'newstime', '�o�G�ɶ�', 'text', '\r\n<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value=\'<?=$todaytime?>\'">\r\n', '�o�G�ɶ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '11', 1, 4, 'flash', 0, '', 1, 0, 0, '\r\n\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (45, 'flashwriter', '�@��', 'text', '<input name=\\"flashwriter\\" type=\\"text\\" id=\\"flashwriter\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[flashwriter]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--flashwriter--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_flashwriter]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_flashwriter]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_flashwriter]\\" type=\\"text\\" id=\\"add[z_flashwriter]\\" value=\\"<?=stripSlashes($r[z_flashwriter])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '30', 1, 4, 'flash', 0, '', 0, 0, 1, '<input name=\\"flashwriter\\" type=\\"text\\" id=\\"flashwriter\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'flashwriter\\\',stripSlashes($r[flashwriter]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (46, 'email', '�@�̶l�c', 'text', '<input name=\\"email\\" type=\\"text\\" id=\\"email\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[email]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--email--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_email]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_email]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_email]\\" type=\\"text\\" id=\\"add[z_email]\\" value=\\"<?=stripSlashes($r[z_email])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '80', 1, 4, 'flash', 0, '', 0, 0, 1, '<input name=\\"email\\" type=\\"text\\" id=\\"email\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'email\\\',stripSlashes($r[email]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (47, 'star', '�@�~����', 'select', '<select name=\\"star\\" id=\\"star\\"><option value=\\"1\\"<?=$r[star]==\\"1\\"?\\\' selected\\\':\\\'\\\'?>>1�P</option><option value=\\"2\\"<?=$r[star]==\\"2\\"||$ecmsfirstpost==1?\\\' selected\\\':\\\'\\\'?>>2�P</option><option value=\\"3\\"<?=$r[star]==\\"3\\"?\\\' selected\\\':\\\'\\\'?>>3�P</option><option value=\\"4\\"<?=$r[star]==\\"4\\"?\\\' selected\\\':\\\'\\\'?>>4�P</option><option value=\\"5\\"<?=$r[star]==\\"5\\"?\\\' selected\\\':\\\'\\\'?>>5�P</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--star--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_star]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_star]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_star]\\" type=\\"text\\" id=\\"add[z_star]\\" value=\\"<?=stripSlashes($r[z_star])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'TINYINT', '1', 1, 4, 'flash', 0, '1|2:default|3|4|5', 0, 0, 1, '<select name=\\"star\\" id=\\"star\\"><option value=\\"1\\"<?=$r[star]==\\"1\\"?\\\' selected\\\':\\\'\\\'?>>1�P</option><option value=\\"2\\"<?=$r[star]==\\"2\\"||$ecmsfirstpost==1?\\\' selected\\\':\\\'\\\'?>>2�P</option><option value=\\"3\\"<?=$r[star]==\\"3\\"?\\\' selected\\\':\\\'\\\'?>>3�P</option><option value=\\"4\\"<?=$r[star]==\\"4\\"?\\\' selected\\\':\\\'\\\'?>>4�P</option><option value=\\"5\\"<?=$r[star]==\\"5\\"?\\\' selected\\\':\\\'\\\'?>>5�P</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (48, 'filesize', '���j�p', 'text', '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[filesize]))?>\\" size=\\"60\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--filesize--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_filesize]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_filesize]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_filesize]\\" type=\\"text\\" id=\\"add[z_filesize]\\" value=\\"<?=stripSlashes($r[z_filesize])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '16', 1, 4, 'flash', 0, '', 0, 0, 1, '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'filesize\\\',stripSlashes($r[filesize]))?>\\" size=\\"42\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (49, 'flashurl', 'Flash�a�}', 'flash', '<input name=\\"flashurl\\" type=\\"text\\" id=\\"flashurl\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[flashurl]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=2&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=flashurl<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ�FLASH\\"><img src=\\"../data/images/changeflash.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--flashurl--]\\" size=\\"20\\">\r\n      )</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name=\\"add[qz_flashurl]\\" type=\\"text\\" id=\\"add[qz_flashurl]\\" value=\\"<?=stripSlashes($r[qz_flashurl])?>\\"> \r\n        <input name=\\"add[save_flashurl]\\" type=\\"checkbox\\" id=\\"add[save_flashurl]\\" value=\\" checked\\"<?=$r[save_flashurl]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name=\\"add[zz_flashurl]\\" cols=\\"60\\" rows=\\"10\\" id=\\"add[zz_flashurl]\\"><?=ehtmlspecialchars(stripSlashes($r[zz_flashurl]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name=\\"add[z_flashurl]\\" type=\\"text\\" id=\\"flashurl5\\" value=\\"<?=stripSlashes($r[z_flashurl])?>\\">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '255', 1, 4, 'flash', 0, '', 0, 0, 1, '<input type=\\"file\\" name=\\"flashurlfile\\" size=\\"45\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (50, 'width', 'Flash�e��', 'text', '<input name=\\"width\\" type=\\"text\\" id=\\"width\\" value=\\"<?=$ecmsfirstpost==1?\\"600\\":ehtmlspecialchars(stripSlashes($r[width]))?>\\" size=\\"6\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--width--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_width]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_width]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_width]\\" type=\\"text\\" id=\\"add[z_width]\\" value=\\"<?=stripSlashes($r[z_width])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '12', 1, 4, 'flash', 0, '600', 0, 0, 1, '<input name=\\"width\\" type=\\"text\\" id=\\"width\\" value=\\"<?=$ecmsfirstpost==1?\\"600\\":DoReqValue($mid,\\\'width\\\',stripSlashes($r[width]))?>\\" size=\\"6\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (51, 'height', 'Flash����', 'text', '<input name=\\"height\\" type=\\"text\\" id=\\"height\\" value=\\"<?=$ecmsfirstpost==1?\\"450\\":ehtmlspecialchars(stripSlashes($r[height]))?>\\" size=\\"6\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--height--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_height]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_height]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_height]\\" type=\\"text\\" id=\\"add[z_height]\\" value=\\"<?=stripSlashes($r[z_height])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '12', 1, 4, 'flash', 0, '450', 0, 0, 1, '<input name=\\"height\\" type=\\"text\\" id=\\"height\\" value=\\"<?=$ecmsfirstpost==1?\\"450\\":DoReqValue($mid,\\\'height\\\',stripSlashes($r[height]))?>\\" size=\\"6\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (52, 'flashsay', '�@�~²��', 'textarea', '<textarea name=\\"flashsay\\" cols=\\"80\\" rows=\\"10\\" id=\\"flashsay\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[flashsay]))?></textarea>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--flashsay--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_flashsay]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_flashsay]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_flashsay]\\" type=\\"text\\" id=\\"add[z_flashsay]\\" value=\\"<?=stripSlashes($r[z_flashsay])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'TEXT', '', 1, 4, 'flash', 0, '', 0, 1, 1, '<textarea name=\\"flashsay\\" cols=\\"60\\" rows=\\"10\\" id=\\"flashsay\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'flashsay\\\',stripSlashes($r[flashsay]))?></textarea>\r\n', 0, '', 0, '80,10', 0, 0, '', '', '', '', '', '', 0, 1, '');
INSERT INTO `phome_enewsf` VALUES (53, 'title', '���D', 'text', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">\r\n	<?=$tts?"<select name=\'ttid\'><option value=\'0\'>���D����</option>$tts</select>":""?>\r\n	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> \r\n	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+\'(�Ϥ�)\';"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">�ݩ�: \r\n	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����\r\n	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����\r\n	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>\r\n  </td>\r\n</tr>\r\n</table>\r\n', '���D', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '100', 1, 5, 'movie', 0, '', 0, 0, 0, '\r\n<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'title\',stripSlashes($r[title]))?>">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (54, 'special.field', '�S���ݩ�', '', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n  <tr>\r\n    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: \r\n      <input name="checked" type="checkbox" value="1"<?=$r[checked]?\' checked\':\'\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name="isgood" id="isgood">\r\n        <option value="0">������</option>\r\n	<?=$ftnr[\'igname\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name="firsttitle" id="firsttitle">\r\n        <option value="0">�D�Y��</option>\r\n	<?=$ftnr[\'ftname\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">\r\n      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">�~���챵: \r\n      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">\r\n      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>\r\n', '�S���ݩ�', 0, 1, 0, '\r\n\r\n', 0, '', '0', 0, 5, 'movie', 0, '', 0, 0, 0, '\r\n<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">\r\n<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (55, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '���D�Ϥ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">\r\n      )</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> \r\n        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 1, 'CHAR', '120', 1, 5, 'movie', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (56, 'newstime', '�o�G�ɶ�', 'text', '\r\n<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value=\'<?=$todaytime?>\'">\r\n', '�o�G�ɶ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '11', 1, 5, 'movie', 0, '', 1, 0, 0, '\r\n\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (57, 'movietype', '�v������', 'select', '<select name="movietype" id="movietype"><option value="��x�v��"<?=$r[movietype]=="��x�v��"?\' selected\':\'\'?>>��x�v��</option><option value="���~�v��"<?=$r[movietype]=="���~�v��"?\' selected\':\'\'?>>���~�v��</option><option value="�j���v��"<?=$r[movietype]=="�j���v��"?\' selected\':\'\'?>>�j���v��</option><option value="�����v��"<?=$r[movietype]=="�����v��"?\' selected\':\'\'?>>�����v��</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--movietype--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_movietype]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_movietype]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_movietype]\\" type=\\"text\\" id=\\"add[z_movietype]\\" value=\\"<?=stripSlashes($r[z_movietype])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '16', 1, 5, 'movie', 0, '��x�v��|���~�v��|�j���v��|�����v��', 0, 0, 1, '<select name="movietype" id="movietype"><option value="��x�v��"<?=$r[movietype]=="��x�v��"?\' selected\':\'\'?>>��x�v��</option><option value="���~�v��"<?=$r[movietype]=="���~�v��"?\' selected\':\'\'?>>���~�v��</option><option value="�j���v��"<?=$r[movietype]=="�j���v��"?\' selected\':\'\'?>>�j���v��</option><option value="�����v��"<?=$r[movietype]=="�����v��"?\' selected\':\'\'?>>�����v��</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (58, 'company', '�X�~���q', 'text', '\r\n<input name=\\"company\\" type=\\"text\\" id=\\"company\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[company]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--company--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_company]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_company]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_company]\\" type=\\"text\\" id=\\"add[z_company]\\" value=\\"<?=stripSlashes($r[z_company])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '200', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<input name=\\"company\\" type=\\"text\\" id=\\"company\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'company\\\',stripSlashes($r[company]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (59, 'movietime', '�X�~�ɶ�', 'text', '\r\n<input name=\\"movietime\\" type=\\"text\\" id=\\"movietime\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[movietime]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--movietime--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_movietime]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_movietime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_movietime]\\" type=\\"text\\" id=\\"add[z_movietime]\\" value=\\"<?=stripSlashes($r[z_movietime])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '20', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<input name=\\"movietime\\" type=\\"text\\" id=\\"movietime\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'movietime\\\',stripSlashes($r[movietime]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (60, 'player', '�D�t', 'text', '\r\n<input name=\\"player\\" type=\\"text\\" id=\\"player\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[player]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--player--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_player]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_player]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_player]\\" type=\\"text\\" id=\\"add[z_player]\\" value=\\"<?=stripSlashes($r[z_player])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '255', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<input name=\\"player\\" type=\\"text\\" id=\\"player\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'player\\\',stripSlashes($r[player]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (61, 'playadmin', '�ɺt', 'text', '\r\n<input name=\\"playadmin\\" type=\\"text\\" id=\\"playadmin\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[playadmin]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--playadmin--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_playadmin]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_playadmin]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_playadmin]\\" type=\\"text\\" id=\\"add[z_playadmin]\\" value=\\"<?=stripSlashes($r[z_playadmin])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '255', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<input name=\\"playadmin\\" type=\\"text\\" id=\\"playadmin\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'playadmin\\\',stripSlashes($r[playadmin]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (62, 'filetype', '�v���榡', 'text', '<input name=\\"filetype\\" type=\\"text\\" id=\\"filetype\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[filetype]))?>\\" size=\\"8\\">\r\n<select name=\\"select2\\" onchange=\\"document.add.filetype.value=this.value\\">\r\n        <option value=\\"\\">����</option>\r\n        <option value=\\".rm\\">.rm</option>\r\n        <option value=\\".rmvb\\">.rmvb</option>\r\n        <option value=\\".mp3\\">.mp3</option>\r\n        <option value=\\".asf\\">.asf</option>\r\n        <option value=\\".wmv\\">.wmv</option>\r\n        <option value=\\".avi\\">.avi</option>\r\n      </select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--filetype--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_filetype]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_filetype]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_filetype]\\" type=\\"text\\" id=\\"add[z_filetype]\\" value=\\"<?=stripSlashes($r[z_filetype])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '10', 1, 5, 'movie', 0, '', 0, 0, 1, '<input name=\\"filetype\\" type=\\"text\\" id=\\"filetype\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'filetype\\\',stripSlashes($r[filetype]))?>\\" size=\\"\\">\r\n<select name=\\"select2\\" onchange=\\"document.add.filetype.value=this.value\\">\r\n        <option value=\\"\\">����</option>\r\n        <option value=\\".rm\\">.rm</option>\r\n        <option value=\\".rmvb\\">.rmvb</option>\r\n        <option value=\\".mp3\\">.mp3</option>\r\n        <option value=\\".asf\\">.asf</option>\r\n        <option value=\\".wmv\\">.wmv</option>\r\n        <option value=\\".avi\\">.avi</option>\r\n      </select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (63, 'filesize', '�v���j�p', 'text', '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[filesize]))?>\\" size=\\"12\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--filesize--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_filesize]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_filesize]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_filesize]\\" type=\\"text\\" id=\\"add[z_filesize]\\" value=\\"<?=stripSlashes($r[z_filesize])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '16', 1, 5, 'movie', 0, '', 0, 0, 1, '<input name=\\"filesize\\" type=\\"text\\" id=\\"filesize\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'filesize\\\',stripSlashes($r[filesize]))?>\\" size=\\"\\">\r\n<select name=\\"select\\" onchange=\\"document.add.filesize.value+=this.value\\">\r\n        <option value=\\"\\">���</option>\r\n        <option value=\\" MB\\">MB</option>\r\n        <option value=\\" KB\\">KB</option>\r\n        <option value=\\" GB\\">GB</option>\r\n        <option value=\\" BYTES\\">BYTES</option>\r\n      </select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (64, 'star', '���˵���', 'select', '<select name=\\"star\\" id=\\"star\\"><option value=\\"1\\"<?=$r[star]==\\"1\\"?\\\' selected\\\':\\\'\\\'?>>1�P</option><option value=\\"2\\"<?=$r[star]==\\"2\\"||$ecmsfirstpost==1?\\\' selected\\\':\\\'\\\'?>>2�P</option><option value=\\"3\\"<?=$r[star]==\\"3\\"?\\\' selected\\\':\\\'\\\'?>>3�P</option><option value=\\"4\\"<?=$r[star]==\\"4\\"?\\\' selected\\\':\\\'\\\'?>>4�P</option><option value=\\"5\\"<?=$r[star]==\\"5\\"?\\\' selected\\\':\\\'\\\'?>>5�P</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--star--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_star]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_star]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_star]\\" type=\\"text\\" id=\\"add[z_star]\\" value=\\"<?=stripSlashes($r[z_star])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'TINYINT', '1', 1, 5, 'movie', 0, '1|2:default|3|4|5', 0, 0, 1, '<select name=\\"star\\" id=\\"star\\"><option value=\\"1\\"<?=$r[star]==\\"1\\"?\\\' selected\\\':\\\'\\\'?>>1�P</option><option value=\\"2\\"<?=$r[star]==\\"2\\"||$ecmsfirstpost==1?\\\' selected\\\':\\\'\\\'?>>2�P</option><option value=\\"3\\"<?=$r[star]==\\"3\\"?\\\' selected\\\':\\\'\\\'?>>3�P</option><option value=\\"4\\"<?=$r[star]==\\"4\\"?\\\' selected\\\':\\\'\\\'?>>4�P</option><option value=\\"5\\"<?=$r[star]==\\"5\\"?\\\' selected\\\':\\\'\\\'?>>5�P</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (65, 'playdk', '�a�e�n�D', 'text', '\r\n<input name=\\"playdk\\" type=\\"text\\" id=\\"playdk\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[playdk]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--playdk--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_playdk]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_playdk]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_playdk]\\" type=\\"text\\" id=\\"add[z_playdk]\\" value=\\"<?=stripSlashes($r[z_playdk])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '30', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<input name=\\"playdk\\" type=\\"text\\" id=\\"playdk\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'playdk\\\',stripSlashes($r[playdk]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (66, 'playtime', '����', 'text', '\r\n<input name=\\"playtime\\" type=\\"text\\" id=\\"playtime\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[playtime]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--playtime--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_playtime]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_playtime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_playtime]\\" type=\\"text\\" id=\\"add[z_playtime]\\" value=\\"<?=stripSlashes($r[z_playtime])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '20', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<input name=\\"playtime\\" type=\\"text\\" id=\\"playtime\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'playtime\\\',stripSlashes($r[playtime]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (67, 'moviefen', '�����I��', 'text', '\r\n<input name=\\"moviefen\\" type=\\"text\\" id=\\"moviefen\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[moviefen]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--moviefen--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_moviefen]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_moviefen]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_moviefen]\\" type=\\"text\\" id=\\"add[z_moviefen]\\" value=\\"<?=stripSlashes($r[z_moviefen])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'INT', '', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<input name=\\"moviefen\\" type=\\"text\\" id=\\"moviefen\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'moviefen\\\',stripSlashes($r[moviefen]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (68, 'downpath', '�U���a�}', 'text', '<script>\r\nfunction doadd()\r\n{var i;\r\nvar str=\\"\\";\r\nvar oldi=0;\r\nvar j=0;\r\noldi=parseInt(document.add.editnum.value);\r\nfor(i=1;i<=document.add.downnum.value;i++)\r\n{\r\nj=i+oldi;\r\nstr=str+\\"<tr><td width=7%> <div align=center>\\"+j+\\"</div></td><td width=19%><div align=left><input name=downname[] type=text id=downname[] value=�U���a�}\\"+j+\\" size=17></div></td><td width=40%><input name=downpath[] type=text size=36 id=downpath\\"+j+\\" ondblclick=SpOpenChFile(0,\\\'downpath\\"+j+\\"\\\')><select name=thedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option><?=$newdownqz?></select></td><td width=21%><div align=center><select name=downuser[] id=select><option value=0>�C��</option><?=$ygroup?></select></div></td><td width=13%><div align=center><input name=fen[] type=text id=fen[] value=0 size=6></div></td></tr>\\";\r\n}\r\ndocument.getElementById(\\"adddown\\").innerHTML=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\"+str+\\"</table>\\";\r\n}\r\n</script>\r\n<table width=\\"100%\\" border=\\"0\\" cellspacing=\\"0\\" cellpadding=\\"0\\">\r\n  <tr>\r\n    <td height=\\"25\\">�U���a�}�e��&nbsp;:\r\n      <input name=\\"downurl_qz\\" type=\\"text\\" size=\\"32\\">\r\n      <select name=\\"changeurl_qz\\" onchange=\\"document.add.downurl_qz.value=document.add.changeurl_qz.value\\">\r\n        <option value=\\"\\" selected>��ܫe��</option>\r\n        <?=$downurlqz?>\r\n      </select>\r\n	  </td>\r\n  </tr>\r\n  <tr>\r\n    <td height=\\"25\\">���/�W�Ǫ���:\r\n      <input name=\\"changedown_url\\" id=\\"changedown_url\\" type=\\"text\\" size=\\"32\\">\r\n      <input type=\\"button\\" name=\\"Submit\\" value=\\"���\\" onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=0&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=changedown_url<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\">&nbsp;\r\n	  <input type=\\"button\\" name=\\"Submit\\" value=\\"�ƻs\\" onclick=\\"document.getElementById(\\\'changedown_url\\\').focus();document.getElementById(\\\'changedown_url\\\').select();clipboardData.setData(\\\'text\\\',document.getElementById(\\\'changedown_url\\\').value);\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td><table width=\\"100%\\" border=\\"0\\" cellpadding=\\"3\\" cellspacing=\\"1\\" bgcolor=\\"#DBEAF5\\">\r\n        <tr> \r\n          <td width=\\"7%\\"> <div align=\\"center\\">�s��</div></td>\r\n          <td width=\\"19%\\"><div align=\\"left\\">�U���W��</div></td>\r\n          <td width=\\"40%\\">�U���a�} <font color=\\"#666666\\">(�������)</font></td>\r\n          <td width=\\"21%\\"> <div align=\\"center\\">�v��</div></td>\r\n          <td width=\\"13%\\"> <div align=\\"center\\">�I��</div></td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n  <tr> \r\n    <td>\r\n    <?php\r\n    if($ecmsfirstpost==1)\r\n    {\r\n    ?>\r\n	<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\r\n	<?php\r\n	$editnum=3;\r\n	for($pathi=1;$pathi<=$editnum;$pathi++)\r\n	{\r\n	?>\r\n           <tr> \r\n              <td width=\\\'7%\\\'> <div align=center><?=$pathi?></div></td>\r\n              <td width=\\\'19%\\\'> <div align=left> \r\n                  <input name=downname[] type=text value=\\\'�U���a�}<?=$pathi?>\\\' size=17>\r\n                    </div></td>\r\n              <td width=\\\'40%\\\'>\r\n	      <input name=downpath[] type=text size=36 id=\\\'downpath<?=$pathi?>\\\' ondblclick=\\"SpOpenChFile(0,\\\'downpath<?=$pathi?>\\\');\\">\r\n	      <select name=thedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option><?=$newdownqz?></select> \r\n                  </td>\r\n                  <td width=\\\'21%\\\'><div align=center> \r\n                      <select name=downuser[]>\r\n                        <option value=0>�C��</option>\r\n                        <?=$ygroup?>\r\n                      </select>\r\n                    </div></td>\r\n                  <td width=\\\'13%\\\'> <div align=center> \r\n                      <input name=fen[] type=text value=0 size=6>\r\n                    </div></td>\r\n            </tr>\r\n	<?php\r\n	}\r\n	?>\r\n	</table>\r\n    <?php\r\n    }\r\n    else\r\n    {\r\n	$editnum=0;\r\n	$downloadpath=\\"\\";\r\n	if($r[downpath])\r\n	{\r\n		$r[downpath]=stripSlashes($r[downpath]);\r\n		//�U���a�}\r\n		$j=0;\r\n		$d_record=explode(\\"\\\\r\\\\n\\",$r[downpath]);\r\n		for($i=0;$i<count($d_record);$i++)\r\n		{\r\n			$j=$i+1;\r\n			$d_field=explode(\\"::::::\\",$d_record[$i]);\r\n			//�v��\r\n			$tgroup=str_replace(\\" value=\\".$d_field[2].\\">\\",\\" value=\\".$d_field[2].\\" selected>\\",$ygroup);\r\n			//�a�}�e��\r\n			$tnewdownqz=str_replace(\\" value=\\\'\\".$d_field[4].\\"\\\'>\\",\\" value=\\\'\\".$d_field[4].\\"\\\' selected>\\",$newdownqz);\r\n			$downloadpath.=\\"<tr><td width=\\\'7%\\\'><div align=center>\\".$j.\\"</div></td><td width=\\\'19%\\\'><div align=left><input name=downname[] type=text id=downname[] value=\\\'\\".$d_field[0].\\"\\\' size=17></div></td><td width=\\\'40%\\\'><input name=downpath[] type=text id=downpath\\".$j.\\" value=\\\'\\".$d_field[1].\\"\\\' size=36 ondblclick=\\\\\\"SpOpenChFile(0,\\\'downpath\\".$j.\\"\\\');\\\\\\"><select name=thedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option>\\".$tnewdownqz.\\"</select><input type=hidden name=pathid[] value=\\".$j.\\"><input type=checkbox name=delpathid[] value=\\".$j.\\">�R</td><td width=\\\'21%\\\'><div align=center><select name=downuser[] id=select><option value=0>�C��</option>\\".$tgroup.\\"</select></div></td><td width=\\\'13%\\\'><div align=center><input name=fen[] type=text id=fen[] value=\\\'\\".$d_field[3].\\"\\\' size=6></div></td></tr>\\";\r\n		}\r\n		$editnum=$j;\r\n		$downloadpath=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\".$downloadpath.\\"</table>\\";\r\n	}\r\n	echo $downloadpath;\r\n    }\r\n    ?>\r\n    </td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\">�U���a�}�X�i�ƶq: <input name=\\"editnum\\" type=\\"hidden\\" id=\\"editnum\\" value=\\"<?=$editnum?>\\">\r\n      <input name=\\"downnum\\" type=\\"text\\" id=\\"downnum\\" value=\\"1\\" size=\\"6\\"> <input type=\\"button\\" name=\\"Submit5\\" value=\\"��X�a�}\\" onclick=\\"javascript:doadd();\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td id=adddown></td>\r\n  </tr>\r\n</table>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (\r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--ecmsdownpathurl--]\\" size=\\"20\\">\r\n      <br>\r\n      <input name=\\"textfield2\\" type=\\"text\\" id=\\"textfield2\\" value=\\"[!--ecmsdownpathname--]\\" size=\\"20\\">\r\n      )<br>\r\n      �榡:�a�}���h(url)[!empirecms!]�W�٥��h(name)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_downpath]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_downpath]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td>�a�}�e��:\r\n<input name=\\"add[qz_downpath]\\" type=\\"text\\" id=\\"add[qz_downpath]\\" value=\\"<?=stripSlashes($r[qz_downpath])?>\\">\r\n        </td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'MEDIUMTEXT', '', 1, 5, 'movie', 0, '', 0, 0, 1, '<input type=\\"file\\" name=\\"downpathfile\\" size=\\"45\\">\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (69, 'playerid', '����', 'text', '\r\n<?php\r\n$player_sql=$empire->query(\\"select id,player from {$dbtbpre}enewsplayer\\");\r\nwhile($player_r=$empire->fetch($player_sql))\r\n{\r\n	$select_player=\\\'\\\';\r\n	if($r[playerid]==$player_r[id])\r\n	{\r\n		$select_player=\\\' selected\\\';\r\n	}\r\n	$player_class.=\\"<option value=\\\'\\".$player_r[id].\\"\\\'\\".$select_player.\\">\\".$player_r[player].\\"</option>\\";\r\n}\r\n?>\r\n<select name=\\"playerid\\">\r\n<option value=0>�۰��ѧO</option>\r\n<?=$player_class?>\r\n</select>\r\n', '���W����', 1, 1, 1, '\r\n<?php\r\n$player_sql=$empire->query(\\"select id,player from {$dbtbpre}enewsplayer\\");\r\nwhile($player_r=$empire->fetch($player_sql))\r\n{\r\n	$select_player=\\\'\\\';\r\n	if($r[z_playerid]==$player_r[id])\r\n	{\r\n		$select_player=\\\' selected\\\';\r\n	}\r\n	$player_class.=\\"<option value=\\\'\\".$player_r[id].\\"\\\'\\".$select_player.\\">\\".$player_r[player].\\"</option>\\";\r\n}\r\n?>\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--playerid--]\\" size=\\"20\\">)</td>\r\n    <td><select name=\\"add[z_playerid]\\"><option value=0>�۰��ѧO</option><?=$player_class?></select></td>\r\n  </tr>\r\n', 1, 'SMALLINT', '', 1, 5, 'movie', 0, '', 0, 0, 1, '\r\n<?php\r\n$player_sql=$empire->query(\\"select id,player from {$dbtbpre}enewsplayer\\");\r\nwhile($player_r=$empire->fetch($player_sql))\r\n{\r\n	$select_player=\\\'\\\';\r\n	if($r[playerid]==$player_r[id])\r\n	{\r\n		$select_player=\\\' selected\\\';\r\n	}\r\n	$player_class.=\\"<option value=\\\'\\".$player_r[id].\\"\\\'\\".$select_player.\\">\\".$player_r[player].\\"</option>\\";\r\n}\r\n?>\r\n<select name=\\"playerid\\">\r\n<option value=0>�۰��ѧO</option>\r\n<?=$player_class?>\r\n</select>\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (70, 'onlinepath', '�b�u�[�ݦa�}', 'text', '<script>\r\nfunction dooadd()\r\n{var i;\r\nvar str=\\"\\";\r\nvar oldi=0;\r\nvar j=0;\r\noldi=parseInt(document.add.oeditnum.value);\r\nfor(i=1;i<=document.add.odownnum.value;i++)\r\n{\r\nj=i+oldi;\r\nstr=str+\\"<tr><td width=7%> <div align=center>\\"+j+\\"</div></td><td width=19%><div align=left><input name=odownname[] type=text value=\\"+j+\\" size=17></div></td><td width=40%><input name=odownpath[] type=text size=36 id=odownpath\\"+j+\\" ondblclick=SpOpenChFile(0,\\\'odownpath\\"+j+\\"\\\')><select name=othedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option><?=$newdownqz?></select></td><td width=21%><div align=center><select name=odownuser[] id=select><option value=0>�C��</option><?=$ygroup?></select></div></td><td width=13%><div align=center><input name=ofen[] type=text value=0 size=6></div></td></tr>\\";\r\n}\r\ndocument.getElementById(\\"addonline\\").innerHTML=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\"+str+\\"</table>\\";\r\n}\r\n</script>\r\n<table width=\\"100%\\" border=\\"0\\" cellspacing=\\"0\\" cellpadding=\\"0\\">\r\n  <tr> \r\n    <td height=\\"25\\">�[�ݦa�}�e��&nbsp;: \r\n      <input name=\\"onlineurl_qz\\" type=\\"text\\" size=\\"32\\"> <select name=\\"changeonlineurl_qz\\" onchange=\\"document.add.onlineurl_qz.value=document.add.changeonlineurl_qz.value\\">\r\n        <option value=\\"\\" selected>��ܫe��</option>\r\n        <?=$downurlqz?>\r\n      </select>\r\n      </td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\">���/�W�Ǫ���: \r\n      <input name=\\"changeonline_url\\" id=\\"changeonline_url\\" type=\\"text\\" size=\\"32\\"> <input type=\\"button\\" name=\\"Submit\\" value=\\"���\\" onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=0&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=changeonline_url<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\">&nbsp;\r\n	  <input type=\\"button\\" name=\\"Submit\\" value=\\"�ƻs\\" onclick=\\"document.getElementById(\\\'changeonline_url\\\').focus();document.getElementById(\\\'changeonline_url\\\').select();clipboardData.setData(\\\'text\\\',document.getElementById(\\\'changeonline_url\\\').value);\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td><table width=\\"100%\\" border=\\"0\\" cellpadding=\\"3\\" cellspacing=\\"1\\" bgcolor=\\"#DBEAF5\\">\r\n        <tr> \r\n          <td width=\\"7%\\"> <div align=\\"center\\">�s��</div></td>\r\n          <td width=\\"19%\\"><div align=\\"left\\">�[�ݦW��</div></td>\r\n          <td width=\\"40%\\">�[�ݦa�} <font color=\\"#666666\\">(�������)</font></td>\r\n          <td width=\\"21%\\"> <div align=\\"center\\">�v��</div></td>\r\n          <td width=\\"13%\\"> <div align=\\"center\\">�I��</div></td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n  <tr> \r\n    <td>\r\n    <?php\r\n    if($ecmsfirstpost==1)\r\n    {\r\n	?>\r\n	<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\r\n	<?php\r\n	$oeditnum=3;\r\n	for($opathi=1;$opathi<=$oeditnum;$opathi++)\r\n	{\r\n	?>\r\n		<tr> \r\n                  <td width=\\\'7%\\\'> <div align=center><?=$opathi?></div></td>\r\n                  <td width=\\\'19%\\\'> <div align=left> \r\n                      <input name=odownname[] type=text value=\\\'<?=$opathi?>\\\' size=17>\r\n                    </div></td>\r\n                  <td width=\\\'40%\\\'> \r\n		  <input name=odownpath[] type=text id=\\\'odownpath<?=$opathi?>\\\' size=36 ondblclick=\\"SpOpenChFile(0,\\\'odownpath<?=$opathi?>\\\');\\">\r\n		  <select name=othedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option><?=$newdownqz?></select> \r\n                  </td>\r\n                  <td width=\\\'21%\\\'><div align=center> \r\n                      <select name=odownuser[] id=select>\r\n                        <option value=0>�C��</option>\r\n                        <?=$ygroup?>\r\n                      </select>\r\n                    </div></td>\r\n                  <td width=\\\'13%\\\'> <div align=center> \r\n                      <input name=ofen[] type=text id=ofen[] value=0 size=6>\r\n                    </div></td>\r\n                </tr>\r\n	<?php\r\n	}\r\n	?>\r\n	</table>\r\n	<?php\r\n    }\r\n    else\r\n    {\r\n	$oeditnum=0;\r\n	$onlinemoviepath=\\"\\";\r\n	if($r[onlinepath])\r\n	{\r\n		$j=0;\r\n		$od_record=explode(\\"\\\\r\\\\n\\",$r[onlinepath]);\r\n		for($i=0;$i<count($od_record);$i++)\r\n		{\r\n			$j=$i+1;\r\n			$od_field=explode(\\"::::::\\",$od_record[$i]);\r\n			//�v��\r\n			$tgroup=str_replace(\\" value=\\".$od_field[2].\\">\\",\\" value=\\".$od_field[2].\\" selected>\\",$ygroup);\r\n			//�a�}�e��\r\n			$tnewdownqz=str_replace(\\" value=\\\'\\".$od_field[4].\\"\\\'>\\",\\" value=\\\'\\".$od_field[4].\\"\\\' selected>\\",$newdownqz);\r\n			$onlinemoviepath.=\\"<tr><td width=\\\'7%\\\'><div align=center>\\".$j.\\"</div></td><td width=\\\'19%\\\'><div align=left><input name=odownname[] type=text value=\\\'\\".$od_field[0].\\"\\\' size=17></div></td><td width=\\\'40%\\\'><input name=odownpath[] type=text value=\\\'\\".$od_field[1].\\"\\\' size=36 id=odownpath\\".$j.\\" ondblclick=\\\\\\"SpOpenChFile(0,\\\'odownpath\\".$j.\\"\\\');\\\\\\"><select name=othedownqz[]><option value=\\\'\\\'>--�a�}�e��--</option>\\".$tnewdownqz.\\"</select><input type=hidden name=opathid[] value=\\".$j.\\"><input type=checkbox name=odelpathid[] value=\\".$j.\\">�R</td><td width=\\\'21%\\\'><div align=center><select name=odownuser[] id=select><option value=0>�C��</option>\\".$tgroup.\\"</select></div></td><td width=\\\'13%\\\'><div align=center><input name=ofen[] type=text value=\\\'\\".$od_field[3].\\"\\\' size=6></div></td></tr>\\";\r\n		}\r\n		$oeditnum=$j;\r\n		$onlinemoviepath=\\"<table width=\\\'100%\\\' border=0 cellspacing=1 cellpadding=3>\\".$onlinemoviepath.\\"</table>\\";\r\n	}\r\n	echo $onlinemoviepath;\r\n    }\r\n    ?>\r\n    </td>\r\n  </tr>\r\n  <tr> \r\n    <td height=\\"25\\">�b�u�a�}�X�i�ƶq: <input name=\\"oeditnum\\" type=\\"hidden\\" id=\\"oeditnum\\" value=\\"<?=$oeditnum?>\\">\r\n      <input name=\\"odownnum\\" type=\\"text\\" id=\\"odownnum\\" value=\\"1\\" size=\\"6\\"> <input type=\\"button\\" name=\\"Submit5\\" value=\\"��X�a�}\\" onclick=\\"javascript:dooadd();\\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td id=addonline></td>\r\n  </tr>\r\n</table>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (\r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--ecmsonlinepathurl--]\\" size=\\"20\\">\r\n      <br>\r\n      <input name=\\"textfield2\\" type=\\"text\\" id=\\"textfield2\\" value=\\"[!--ecmsonlinepathname--]\\" size=\\"20\\">\r\n      )<br>\r\n      �榡:�a�}���h(url)[!empirecms!]�W�٥��h(name)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_onlinepath]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_onlinepath]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td>�a�}�e��:\r\n<input name=\\"add[qz_onlinepath]\\" type=\\"text\\" id=\\"add[qz_onlinepath]\\" value=\\"<?=stripSlashes($r[qz_onlinepath])?>\\">\r\n        </td>\r\n        </tr>\r\n      </table>\r\n	  </td>\r\n  </tr>\r\n', 2, 'MEDIUMTEXT', '', 1, 5, 'movie', 0, '', 0, 0, 1, '<input type=\\"file\\" name=\\"onlinepathfile\\" size=\\"45\\">\r\n<input type=\\"hidden\\" name=\\"onlinepathmtfile\\" value=1>\r\n', 0, '', 0, '', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (71, 'moviesay', '�v��²��', 'textarea', '<textarea name=\\"moviesay\\" cols=\\"80\\" rows=\\"10\\" id=\\"moviesay\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[moviesay]))?></textarea>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--moviesay--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_moviesay]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_moviesay]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_moviesay]\\" type=\\"text\\" id=\\"add[z_moviesay]\\" value=\\"<?=stripSlashes($r[z_moviesay])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'TEXT', '', 1, 5, 'movie', 0, '', 0, 1, 1, '<textarea name=\\"moviesay\\" cols=\\"60\\" rows=\\"10\\" id=\\"moviesay\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'moviesay\\\',stripSlashes($r[moviesay]))?></textarea>\r\n', 0, '', 0, '80,10', 0, 0, '', '', '', '', '', '', 0, 1, '');
INSERT INTO `phome_enewsf` VALUES (72, 'title', '���D', 'text', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">\r\n	<?=$tts?"<select name=\'ttid\'><option value=\'0\'>���D����</option>$tts</select>":""?>\r\n	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> \r\n	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+\'(�Ϥ�)\';"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">�ݩ�: \r\n	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����\r\n	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����\r\n	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>\r\n  </td>\r\n</tr>\r\n</table>\r\n', '���D', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '100', 1, 6, 'shop', 0, '', 0, 0, 0, '\r\n<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'title\',stripSlashes($r[title]))?>">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (73, 'special.field', '�S���ݩ�', '', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n  <tr>\r\n    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: \r\n      <input name="checked" type="checkbox" value="1"<?=$r[checked]?\' checked\':\'\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name="isgood" id="isgood">\r\n        <option value="0">������</option>\r\n	<?=$ftnr[\'igname\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name="firsttitle" id="firsttitle">\r\n        <option value="0">�D�Y��</option>\r\n	<?=$ftnr[\'ftname\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">\r\n      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">�~���챵: \r\n      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">\r\n      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>\r\n', '�S���ݩ�', 0, 1, 0, '\r\n\r\n', 0, '', '0', 0, 6, 'shop', 0, '', 0, 0, 0, '\r\n<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">\r\n<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (74, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"60\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '���D�Ϥ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">\r\n      )</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> \r\n        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 1, 'CHAR', '120', 1, 6, 'shop', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (75, 'newstime', '�o�G�ɶ�', 'text', '\r\n<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value=\'<?=$todaytime?>\'">\r\n', '�o�G�ɶ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '11', 1, 6, 'shop', 0, '', 1, 0, 0, '\r\n\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (76, 'productno', '�ӫ~�s��', 'text', '<input name=\\"productno\\" type=\\"text\\" id=\\"productno\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[productno]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--productno--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_productno]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_productno]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_productno]\\" type=\\"text\\" id=\\"add[z_productno]\\" value=\\"<?=stripSlashes($r[z_productno])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'VARCHAR', '30', 1, 6, 'shop', 0, '', 0, 0, 1, '<input name=\\"productno\\" type=\\"text\\" id=\\"productno\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'productno\\\',stripSlashes($r[productno]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (77, 'pbrand', '�~�P', 'text', '<input name=\\"pbrand\\" type=\\"text\\" id=\\"pbrand\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[pbrand]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--pbrand--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_pbrand]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_pbrand]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_pbrand]\\" type=\\"text\\" id=\\"add[z_pbrand]\\" value=\\"<?=stripSlashes($r[z_pbrand])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'VARCHAR', '30', 1, 6, 'shop', 0, '', 0, 0, 1, '<input name=\\"pbrand\\" type=\\"text\\" id=\\"pbrand\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'pbrand\\\',stripSlashes($r[pbrand]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (78, 'intro', '²��y�z', 'textarea', '<textarea name=\\"intro\\" cols=\\"80\\" rows=\\"10\\" id=\\"intro\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[intro]))?></textarea>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--intro--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_intro]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_intro]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_intro]\\" type=\\"text\\" id=\\"add[z_intro]\\" value=\\"<?=stripSlashes($r[z_intro])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'TEXT', '', 1, 6, 'shop', 0, '', 0, 1, 1, '<textarea name=\\"intro\\" cols=\\"60\\" rows=\\"10\\" id=\\"intro\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'intro\\\',stripSlashes($r[intro]))?></textarea>\r\n', 0, '', 0, '80,10', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (79, 'unit', '�p�q���', 'text', '<input name=\\"unit\\" type=\\"text\\" id=\\"unit\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[unit]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--unit--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_unit]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_unit]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_unit]\\" type=\\"text\\" id=\\"add[z_unit]\\" value=\\"<?=stripSlashes($r[z_unit])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'VARCHAR', '16', 1, 6, 'shop', 0, '', 0, 0, 1, '<input name=\\"unit\\" type=\\"text\\" id=\\"unit\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'unit\\\',stripSlashes($r[unit]))?>\\" size=\\"\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (80, 'weight', '��쭫�q', 'text', '<input name=\\"weight\\" type=\\"text\\" id=\\"weight\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[weight]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--weight--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_weight]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_weight]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_weight]\\" type=\\"text\\" id=\\"add[z_weight]\\" value=\\"<?=stripSlashes($r[z_weight])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'VARCHAR', '20', 1, 6, 'shop', 0, '', 0, 0, 1, '<input name=\\"weight\\" type=\\"text\\" id=\\"weight\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'weight\\\',stripSlashes($r[weight]))?>\\" size=\\"\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (81, 'tprice', '��������', 'text', '<input name=\\"tprice\\" type=\\"text\\" id=\\"tprice\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[tprice]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--tprice--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_tprice]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_tprice]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_tprice]\\" type=\\"text\\" id=\\"add[z_tprice]\\" value=\\"<?=stripSlashes($r[z_tprice])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'FLOAT', '11,2', 1, 6, 'shop', 0, '', 0, 0, 1, '<input name=\\"tprice\\" type=\\"text\\" id=\\"tprice\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'tprice\\\',stripSlashes($r[tprice]))?>\\" size=\\"\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (82, 'price', '�ʶR����', 'text', '<input name=\\"price\\" type=\\"text\\" id=\\"price\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[price]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--price--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_price]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_price]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_price]\\" type=\\"text\\" id=\\"add[z_price]\\" value=\\"<?=stripSlashes($r[z_price])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'FLOAT', '11,2', 1, 6, 'shop', 0, '', 0, 0, 1, '<input name=\\"price\\" type=\\"text\\" id=\\"price\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'price\\\',stripSlashes($r[price]))?>\\" size=\\"\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (83, 'buyfen', '�n���ʶR', 'text', '<input name=\\"buyfen\\" type=\\"text\\" id=\\"buyfen\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[buyfen]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--buyfen--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_buyfen]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_buyfen]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_buyfen]\\" type=\\"text\\" id=\\"add[z_buyfen]\\" value=\\"<?=stripSlashes($r[z_buyfen])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '', 1, 6, 'shop', 0, '', 0, 0, 1, '<input name=\\"buyfen\\" type=\\"text\\" id=\\"buyfen\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'buyfen\\\',stripSlashes($r[buyfen]))?>\\" size=\\"\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (84, 'pmaxnum', '�w�s', 'text', '<input name=\\"pmaxnum\\" type=\\"text\\" id=\\"pmaxnum\\" value=\\"<?=$ecmsfirstpost==1?\\"100\\":ehtmlspecialchars(stripSlashes($r[pmaxnum]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--pmaxnum--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_pmaxnum]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_pmaxnum]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_pmaxnum]\\" type=\\"text\\" id=\\"add[z_pmaxnum]\\" value=\\"<?=stripSlashes($r[z_pmaxnum])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '', 1, 6, 'shop', 0, '100', 0, 0, 1, '<input name=\\"pmaxnum\\" type=\\"text\\" id=\\"pmaxnum\\" value=\\"<?=$ecmsfirstpost==1?\\"100\\":DoReqValue($mid,\\\'pmaxnum\\\',stripSlashes($r[pmaxnum]))?>\\" size=\\"\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (85, 'productpic', '�ӫ~�j��', 'img', '<input name=\\"productpic\\" type=\\"text\\" id=\\"productpic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[productpic]))?>\\" size=\\"60\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=productpic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--productpic--]\\" size=\\"20\\">\r\n      )</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name=\\"add[qz_productpic]\\" type=\\"text\\" id=\\"add[qz_productpic]\\" value=\\"<?=stripSlashes($r[qz_productpic])?>\\"> \r\n        <input name=\\"add[save_productpic]\\" type=\\"checkbox\\" id=\\"add[save_productpic]\\" value=\\" checked\\"<?=$r[save_productpic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name=\\"add[zz_productpic]\\" cols=\\"60\\" rows=\\"10\\" id=\\"add[zz_productpic]\\"><?=ehtmlspecialchars(stripSlashes($r[zz_productpic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name=\\"add[z_productpic]\\" type=\\"text\\" id=\\"productpic5\\" value=\\"<?=stripSlashes($r[z_productpic])?>\\">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '255', 1, 6, 'shop', 0, '', 0, 0, 1, '<input type=\\"file\\" name=\\"productpicfile\\" size=\\"45\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (86, 'newstext', '�ӫ~����', 'editor', '<?=ECMS_ShowEditorVar(\\"newstext\\",$ecmsfirstpost==1?\\"\\":stripSlashes($r[newstext]),\\"Default\\",\\"\\",\\"300\\",\\"100%\\")?>\r\n<table width=\\"100%\\" border=\\"0\\" cellpadding=\\"3\\" cellspacing=\\"1\\" bgcolor=\\"#DBEAF5\\">\r\n          <tr> \r\n            <td bgcolor=\\"#FFFFFF\\"> <input name=\\"dokey\\" type=\\"checkbox\\" value=\\"1\\"<?=$r[dokey]==1?\\\' checked\\\':\\\'\\\'?>>\r\n              ����r����&nbsp;&nbsp; <input name=\\"copyimg\\" type=\\"checkbox\\" id=\\"copyimg\\" value=\\"1\\">\r\n      ���{�O�s�Ϥ�(\r\n      <input name=\\"mark\\" type=\\"checkbox\\" id=\\"mark\\" value=\\"1\\">\r\n      <a href=\\"SetEnews.php<?=$ecms_hashur[whehref]?>\\" target=\\"_blank\\">�[���L</a>)&nbsp;&nbsp; \r\n      <input name=\\"copyflash\\" type=\\"checkbox\\" id=\\"copyflash\\" value=\\"1\\">\r\n      ���{�O�sFLASH(�a�}�e��G \r\n      <input name=\\"qz_url\\" type=\\"text\\" id=\\"qz_url\\" size=\\"\\">\r\n              )</td>\r\n          </tr>\r\n          <tr>\r\n            \r\n    <td bgcolor=\\"#FFFFFF\\"><input name=\\"repimgnexturl\\" type=\\"checkbox\\" id=\\"repimgnexturl\\" value=\\"1\\"> �Ϥ��챵�ର�U�@��&nbsp;&nbsp; <input name=\\"autopage\\" type=\\"checkbox\\" id=\\"autopage\\" value=\\"1\\"> �۰ʤ���\r\n      ,�C \r\n      <input name=\\"autosize\\" type=\\"text\\" id=\\"autosize\\" value=\\"5000\\" size=\\"5\\">\r\n      �Ӧr�`���@��&nbsp;&nbsp; ���� \r\n      <input name=\\"getfirsttitlepic\\" type=\\"text\\" id=\\"getfirsttitlepic\\" value=\\"\\" size=\\"1\\">\r\n      �i�W�ǹϬ����D�Ϥ�( \r\n      <input name=\\"getfirsttitlespic\\" type=\\"checkbox\\" id=\\"getfirsttitlespic\\" value=\\"1\\">\r\n      �Y����: �e \r\n      <input name=\\"getfirsttitlespicw\\" type=\\"text\\" id=\\"getfirsttitlespicw\\" size=\\"3\\" value=\\"<?=$public_r[spicwidth]?>\\">\r\n      *��\r\n      <input name=\\"getfirsttitlespich\\" type=\\"text\\" id=\\"getfirsttitlespich\\" size=\\"3\\" value=\\"<?=$public_r[spicheight]?>\\">\r\n      )</td>\r\n          </tr>\r\n        </table>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--newstext--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_newstext]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_newstext]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_newstext]\\" type=\\"text\\" id=\\"add[z_newstext]\\" value=\\"<?=stripSlashes($r[z_newstext])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'MEDIUMTEXT', '', 1, 6, 'shop', 0, '', 0, 1, 1, '<?=ECMS_ShowEditorVar(\\"newstext\\",$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'newstext\\\',stripSlashes($r[newstext])),\\"Default\\",\\"\\",\\"300\\",\\"100%\\")?>\r\n', 0, '', 0, '', 0, 1, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (87, 'psalenum', '�P��q', 'text', '\r\n<input name=\\"psalenum\\" type=\\"text\\" id=\\"psalenum\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[psalenum]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--psalenum--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_psalenum]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_psalenum]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_psalenum]\\" type=\\"text\\" id=\\"add[z_psalenum]\\" value=\\"<?=stripSlashes($r[z_psalenum])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'INT', '', 1, 6, 'shop', 0, '', 0, 0, 1, '\r\n<input name=\\"psalenum\\" type=\\"text\\" id=\\"psalenum\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'psalenum\\\',stripSlashes($r[psalenum]))?>\\" size=\\"60\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (88, 'title', '���D', 'text', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">\r\n	<?=$tts?"<select name=\'ttid\'><option value=\'0\'>���D����</option>$tts</select>":""?>\r\n	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> \r\n	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+\'(�Ϥ�)\';"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">�ݩ�: \r\n	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����\r\n	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����\r\n	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>\r\n  </td>\r\n</tr>\r\n</table>\r\n', '���D', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '100', 1, 7, 'article', 0, '', 0, 0, 0, '\r\n<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'title\',stripSlashes($r[title]))?>">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (89, 'special.field', '�S���ݩ�', '', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n  <tr>\r\n    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: \r\n      <input name="checked" type="checkbox" value="1"<?=$r[checked]?\' checked\':\'\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name="isgood" id="isgood">\r\n        <option value="0">������</option>\r\n	<?=$ftnr[\'igname\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name="firsttitle" id="firsttitle">\r\n        <option value="0">�D�Y��</option>\r\n	<?=$ftnr[\'ftname\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">\r\n      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">�~���챵: \r\n      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">\r\n      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>\r\n', '�S���ݩ�', 0, 1, 0, '\r\n\r\n', 1, '', '0', 0, 7, 'article', 0, '', 0, 0, 0, '\r\n<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">\r\n<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (90, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '���D�Ϥ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">\r\n      )</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> \r\n        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '120', 1, 7, 'article', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (91, 'newstime', '�o�G�ɶ�', 'text', '\r\n<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value=\'<?=$todaytime?>\'">\r\n', '�o�G�ɶ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'INT', '11', 1, 7, 'article', 0, '', 1, 0, 0, '\r\n\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (92, 'ftitle', '�Ƽ��D', 'text', '<input name=\\"ftitle\\" type=\\"text\\" id=\\"ftitle\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[ftitle]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--ftitle--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_ftitle]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_ftitle]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_ftitle]\\" type=\\"text\\" id=\\"add[z_ftitle]\\" value=\\"<?=stripSlashes($r[z_ftitle])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '120', 1, 7, 'article', 0, '', 0, 0, 1, '<input name=\\"ftitle\\" type=\\"text\\" id=\\"ftitle\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'ftitle\\\',stripSlashes($r[ftitle]))?>\\" size=\\"42\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (93, 'smalltext', '���e²��', 'textarea', '<textarea name=\\"smalltext\\" cols=\\"80\\" rows=\\"10\\" id=\\"smalltext\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--smalltext--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_smalltext]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_smalltext]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_smalltext]\\" type=\\"text\\" id=\\"add[z_smalltext]\\" value=\\"<?=stripSlashes($r[z_smalltext])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '255', 1, 7, 'article', 0, '', 0, 1, 1, '<textarea name=\\"smalltext\\" cols=\\"60\\" rows=\\"10\\" id=\\"smalltext\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'smalltext\\\',stripSlashes($r[smalltext]))?></textarea>\r\n', 0, '', 0, '80,10', 0, 0, '', '', '', '', '', '', 0, 1, '');
INSERT INTO `phome_enewsf` VALUES (94, 'writer', '�@��', 'text', '<?php\r\n$writer_sql=$empire->query(\\"select writer from {$dbtbpre}enewswriter\\");\r\nwhile($w_r=$empire->fetch($writer_sql))\r\n{\r\n	$w_class.=\\"<option value=\\\'\\".$w_r[writer].\\"\\\'>\\".$w_r[writer].\\"</option>\\";\r\n}\r\n?>\r\n<input type=text name=writer value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[writer]))?>\\" size=\\"\\"> \r\n        <select name=\\"w_id\\" id=\\"select7\\" onchange=\\"document.add.writer.value=document.add.w_id.value\\">\r\n          <option>��ܧ@��</option>\r\n		  <?=$w_class?>\r\n        </select>\r\n<input type=\\"button\\" name=\\"wbutton\\" value=\\"�W�[�@��\\" onclick=\\"window.open(\\\'NewsSys/writer.php?<?=$ecms_hashur[ehref]?>&addwritername=\\\'+document.add.writer.value);\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--writer--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_writer]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_writer]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_writer]\\" type=\\"text\\" id=\\"add[z_writer]\\" value=\\"<?=stripSlashes($r[z_writer])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '30', 1, 7, 'article', 0, '', 0, 0, 1, '<input name=\\"writer\\" type=\\"text\\" id=\\"writer\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'writer\\\',stripSlashes($r[writer]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (95, 'befrom', '�H���ӷ�', 'text', '<?php\r\n$befrom_sql=$empire->query(\\"select sitename from {$dbtbpre}enewsbefrom\\");\r\nwhile($b_r=$empire->fetch($befrom_sql))\r\n{\r\n	$b_class.=\\"<option value=\\\'\\".$b_r[sitename].\\"\\\'>\\".$b_r[sitename].\\"</option>\\";\r\n}\r\n?>\r\n<input type=\\"text\\" name=\\"befrom\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[befrom]))?>\\" size=\\"\\"> \r\n        <select name=\\"befrom_id\\" id=\\"befromid\\" onchange=\\"document.add.befrom.value=document.add.befrom_id.value\\">\r\n          <option>��ܫH���ӷ�</option>\r\n          <?=$b_class?>\r\n        </select>\r\n<input type=\\"button\\" name=\\"wbutton\\" value=\\"�W�[�ӷ�\\" onclick=\\"window.open(\\\'NewsSys/BeFrom.php?<?=$ecms_hashur[ehref]?>&addsitename=\\\'+document.add.befrom.value);\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--befrom--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_befrom]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_befrom]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_befrom]\\" type=\\"text\\" id=\\"add[z_befrom]\\" value=\\"<?=stripSlashes($r[z_befrom])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '60', 1, 7, 'article', 0, '', 0, 0, 1, '<input name=\\"befrom\\" type=\\"text\\" id=\\"befrom\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'befrom\\\',stripSlashes($r[befrom]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (96, 'newstext', '�s�D����', 'editor', '<?=ECMS_ShowEditorVar(\\"newstext\\",$ecmsfirstpost==1?\\"\\":stripSlashes($r[newstext]),\\"Default\\",\\"\\",\\"300\\",\\"100%\\")?>\r\n<table width=\\"100%\\" border=\\"0\\" cellpadding=\\"3\\" cellspacing=\\"1\\" bgcolor=\\"#DBEAF5\\">\r\n          <tr> \r\n            <td bgcolor=\\"#FFFFFF\\"> <input name=\\"dokey\\" type=\\"checkbox\\" value=\\"1\\"<?=$r[dokey]==1?\\\' checked\\\':\\\'\\\'?>>\r\n              ����r����&nbsp;&nbsp; <input name=\\"copyimg\\" type=\\"checkbox\\" id=\\"copyimg\\" value=\\"1\\">\r\n      ���{�O�s�Ϥ�(\r\n      <input name=\\"mark\\" type=\\"checkbox\\" id=\\"mark\\" value=\\"1\\">\r\n      <a href=\\"SetEnews.php<?=$ecms_hashur[whehref]?>\\" target=\\"_blank\\">�[���L</a>)&nbsp;&nbsp; \r\n      <input name=\\"copyflash\\" type=\\"checkbox\\" id=\\"copyflash\\" value=\\"1\\">\r\n      ���{�O�sFLASH(�a�}�e��G \r\n      <input name=\\"qz_url\\" type=\\"text\\" id=\\"qz_url\\" size=\\"\\">\r\n              )</td>\r\n          </tr>\r\n          <tr>\r\n            \r\n    <td bgcolor=\\"#FFFFFF\\"><input name=\\"repimgnexturl\\" type=\\"checkbox\\" id=\\"repimgnexturl\\" value=\\"1\\"> �Ϥ��챵�ର�U�@��&nbsp;&nbsp; <input name=\\"autopage\\" type=\\"checkbox\\" id=\\"autopage\\" value=\\"1\\"> �۰ʤ���\r\n      ,�C \r\n      <input name=\\"autosize\\" type=\\"text\\" id=\\"autosize\\" value=\\"5000\\" size=\\"5\\">\r\n      �Ӧr�`���@��&nbsp;&nbsp; ���� \r\n      <input name=\\"getfirsttitlepic\\" type=\\"text\\" id=\\"getfirsttitlepic\\" value=\\"\\" size=\\"1\\">\r\n      �i�W�ǹϬ����D�Ϥ�( \r\n      <input name=\\"getfirsttitlespic\\" type=\\"checkbox\\" id=\\"getfirsttitlespic\\" value=\\"1\\">\r\n      �Y����: �e \r\n      <input name=\\"getfirsttitlespicw\\" type=\\"text\\" id=\\"getfirsttitlespicw\\" size=\\"3\\" value=\\"<?=$public_r[spicwidth]?>\\">\r\n      *��\r\n      <input name=\\"getfirsttitlespich\\" type=\\"text\\" id=\\"getfirsttitlespich\\" size=\\"3\\" value=\\"<?=$public_r[spicheight]?>\\">\r\n      )</td>\r\n          </tr>\r\n        </table>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--newstext--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_newstext]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_newstext]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_newstext]\\" type=\\"text\\" id=\\"add[z_newstext]\\" value=\\"<?=stripSlashes($r[z_newstext])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'CHAR', '50', 1, 7, 'article', 1, '', 0, 1, 1, '<?=ECMS_ShowEditorVar(\\"newstext\\",$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'newstext\\\',stripSlashes($r[newstext])),\\"Default\\",\\"\\",\\"300\\",\\"100%\\")?>\r\n', 0, '', 0, '', 0, 1, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (97, 'diggtop', '��', 'text', '\r\n<input name=\\"diggtop\\" type=\\"text\\" id=\\"diggtop\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[diggtop]))?>\\" size=\\"\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--diggtop--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_diggtop]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_diggtop]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_diggtop]\\" type=\\"text\\" id=\\"add[z_diggtop]\\" value=\\"<?=stripSlashes($r[z_diggtop])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 3, 'INT', '', 1, 7, 'article', 0, '', 0, 0, 1, '\r\n<input name=\\"diggtop\\" type=\\"text\\" id=\\"diggtop\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'diggtop\\\',stripSlashes($r[diggtop]))?>\\" size=\\"\\">\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (98, 'title', '���D', 'text', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">\r\n	<?=$tts?"<select name=\'ttid\'><option value=\'0\'>���D����</option>$tts</select>":""?>\r\n	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> \r\n	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+\'(�Ϥ�)\';"> \r\n  </td>\r\n</tr>\r\n<tr> \r\n  <td height="25" bgcolor="#FFFFFF">�ݩ�: \r\n	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����\r\n	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����\r\n	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>\r\n  </td>\r\n</tr>\r\n</table>\r\n', '���D', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'CHAR', '100', 1, 8, 'info', 0, '', 0, 0, 0, '\r\n<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,\'title\',stripSlashes($r[title]))?>">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (99, 'special.field', '�S���ݩ�', '', '\r\n<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">\r\n  <tr>\r\n    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: \r\n      <input name="checked" type="checkbox" value="1"<?=$r[checked]?\' checked\':\'\'?>>\r\n      �f�� &nbsp;&nbsp; ���� \r\n      <select name="isgood" id="isgood">\r\n        <option value="0">������</option>\r\n	<?=$ftnr[\'igname\']?>\r\n      </select>\r\n      &nbsp;&nbsp; �Y�� \r\n      <select name="firsttitle" id="firsttitle">\r\n        <option value="0">�D�Y��</option>\r\n	<?=$ftnr[\'ftname\']?>\r\n      </select></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: \r\n      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">\r\n      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td height="25" bgcolor="#FFFFFF">�~���챵: \r\n      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">\r\n      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>\r\n  </tr>\r\n</table>\r\n', '�S���ݩ�', 0, 1, 0, '\r\n\r\n', 0, '', '0', 0, 8, 'info', 0, '', 0, 0, 0, '\r\n<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">\r\n<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (100, 'titlepic', '���D�Ϥ�', 'img', '<input name=\\"titlepic\\" type=\\"text\\" id=\\"titlepic\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[titlepic]))?>\\" size=\\"45\\">\r\n<a onclick=\\"window.open(\\\'ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>\\\',\\\'\\\',\\\'width=700,height=550,scrollbars=yes\\\');\\" title=\\"��ܤw�W�Ǫ��Ϥ�\\"><img src=\\"../data/images/changeimg.gif\\" border=\\"0\\" align=\\"absbottom\\"></a> \r\n', '���D�Ϥ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      ( \r\n      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">\r\n      )</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n    <tr>\r\n      <td>����e�� \r\n        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> \r\n        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>\r\n        ���{�O�s </td>\r\n    </tr>\r\n    <tr> \r\n      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>\r\n    </tr>\r\n    <tr> \r\n      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">\r\n        (�p��g�o�̡A�o�N�O�r�q����)</td>\r\n    </tr>\r\n  </table></td>\r\n  </tr>\r\n', 1, 'CHAR', '120', 1, 8, 'info', 0, '', 0, 0, 0, '<input type=\\"file\\" name=\\"titlepicfile\\" size=\\"45\\">\r\n', 0, '', 0, '60', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (101, 'newstime', '�o�G�ɶ�', 'text', '\r\n<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value=\'<?=$todaytime?>\'">\r\n', '�o�G�ɶ�', 0, 1, 1, '\r\n  <tr bgcolor="#FFFFFF"> \r\n    <td height="22" valign="top"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>\r\n    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">\r\n        <tr> \r\n          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'INT', '11', 1, 8, 'info', 0, '', 1, 0, 0, '\r\n\r\n', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (102, 'smalltext', '�H�����e', 'textarea', '<textarea name=\\"smalltext\\" cols=\\"80\\" rows=\\"10\\" id=\\"smalltext\\"><?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--smalltext--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_smalltext]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_smalltext]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_smalltext]\\" type=\\"text\\" id=\\"add[z_smalltext]\\" value=\\"<?=stripSlashes($r[z_smalltext])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 0, 'TEXT', '', 1, 8, 'info', 0, '', 0, 1, 1, '<textarea name=\\"smalltext\\" cols=\\"60\\" rows=\\"10\\" id=\\"smalltext\\"><?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'smalltext\\\',stripSlashes($r[smalltext]))?></textarea>\r\n', 0, '', 0, '80,10', 0, 0, '', '', '', '', '', '', 0, 1, '');
INSERT INTO `phome_enewsf` VALUES (103, 'myarea', '�Ҧb�a', 'select', '<select name="myarea" id="myarea"><option value="�F����"<?=$r[myarea]=="�F����"||$ecmsfirstpost==1?\' selected\':\'\'?>>�F����</option><option value="�諰��"<?=$r[myarea]=="�諰��"?\' selected\':\'\'?>>�諰��</option><option value="�R���"<?=$r[myarea]=="�R���"?\' selected\':\'\'?>>�R���</option><option value="�ŪZ��"<?=$r[myarea]=="�ŪZ��"?\' selected\':\'\'?>>�ŪZ��</option><option value="�¶���"<?=$r[myarea]=="�¶���"?\' selected\':\'\'?>>�¶���</option><option value="������"<?=$r[myarea]=="������"?\' selected\':\'\'?>>������</option><option value="�ץx��"<?=$r[myarea]=="�ץx��"?\' selected\':\'\'?>>�ץx��</option><option value="�۴��s��"<?=$r[myarea]=="�۴��s��"?\' selected\':\'\'?>>�۴��s��</option><option value="�q�{��"<?=$r[myarea]=="�q�{��"?\' selected\':\'\'?>>�q�{��</option><option value="������"<?=$r[myarea]=="������"?\' selected\':\'\'?>>������</option><option value="�j����"<?=$r[myarea]=="�j����"?\' selected\':\'\'?>>�j����</option><option value="�䥦"<?=$r[myarea]=="�䥦"?\' selected\':\'\'?>>�䥦</option></select>', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--myarea--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_myarea]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_myarea]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_myarea]\\" type=\\"text\\" id=\\"add[z_myarea]\\" value=\\"<?=stripSlashes($r[z_myarea])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 1, 'VARCHAR', '30', 1, 8, 'info', 0, '�F����:default|�諰��|�R���|�ŪZ��|�¶���|������|�ץx��|�۴��s��|�q�{��|������|�j����|�䥦', 0, 0, 1, '<select name="myarea" id="myarea"><option value="�F����"<?=$r[myarea]=="�F����"||$ecmsfirstpost==1?\' selected\':\'\'?>>�F����</option><option value="�諰��"<?=$r[myarea]=="�諰��"?\' selected\':\'\'?>>�諰��</option><option value="�R���"<?=$r[myarea]=="�R���"?\' selected\':\'\'?>>�R���</option><option value="�ŪZ��"<?=$r[myarea]=="�ŪZ��"?\' selected\':\'\'?>>�ŪZ��</option><option value="�¶���"<?=$r[myarea]=="�¶���"?\' selected\':\'\'?>>�¶���</option><option value="������"<?=$r[myarea]=="������"?\' selected\':\'\'?>>������</option><option value="�ץx��"<?=$r[myarea]=="�ץx��"?\' selected\':\'\'?>>�ץx��</option><option value="�۴��s��"<?=$r[myarea]=="�۴��s��"?\' selected\':\'\'?>>�۴��s��</option><option value="�q�{��"<?=$r[myarea]=="�q�{��"?\' selected\':\'\'?>>�q�{��</option><option value="������"<?=$r[myarea]=="������"?\' selected\':\'\'?>>������</option><option value="�j����"<?=$r[myarea]=="�j����"?\' selected\':\'\'?>>�j����</option><option value="�䥦"<?=$r[myarea]=="�䥦"?\' selected\':\'\'?>>�䥦</option></select>', 0, '', 0, '', 0, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (104, 'email', '�l�c', 'text', '<input name=\\"email\\" type=\\"text\\" id=\\"email\\" value=\\"<?=$ecmsfirstpost==1?$memberinfor[email]:ehtmlspecialchars(stripSlashes($r[email]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--email--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_email]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_email]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_email]\\" type=\\"text\\" id=\\"add[z_email]\\" value=\\"<?=stripSlashes($r[z_email])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'VARCHAR', '80', 1, 8, 'info', 0, '$memberinfor[email]', 0, 0, 1, '<input name=\\"email\\" type=\\"text\\" id=\\"email\\" value=\\"<?=$ecmsfirstpost==1?$memberinfor[email]:DoReqValue($mid,\\\'email\\\',stripSlashes($r[email]))?>\\" size=\\"46\\">\r\n', 0, '', 0, '46', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (105, 'mycontact', '�pô�覡', 'text', '<input name=\\"mycontact\\" type=\\"text\\" id=\\"mycontact\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":ehtmlspecialchars(stripSlashes($r[mycontact]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--mycontact--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_mycontact]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_mycontact]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_mycontact]\\" type=\\"text\\" id=\\"add[z_mycontact]\\" value=\\"<?=stripSlashes($r[z_mycontact])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'VARCHAR', '255', 1, 8, 'info', 0, '', 0, 0, 1, '<input name=\\"mycontact\\" type=\\"text\\" id=\\"mycontact\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":DoReqValue($mid,\\\'mycontact\\\',stripSlashes($r[mycontact]))?>\\" size=\\"46\\">\r\n', 0, '', 0, '46', 1, 0, '', '', '', '', '', '', 0, 0, '');
INSERT INTO `phome_enewsf` VALUES (106, 'address', '�pô�a�}', 'text', '<input name=\\"address\\" type=\\"text\\" id=\\"address\\" value=\\"<?=$ecmsfirstpost==1?$memberinfor[address]:ehtmlspecialchars(stripSlashes($r[address]))?>\\" size=\\"60\\">\r\n', '', 1, 1, 1, '\r\n  <tr bgcolor=\\"#FFFFFF\\"> \r\n    <td height=\\"22\\" valign=\\"top\\"><strong>[!--enews.name--]���h�G</strong><br>\r\n      (<input name=\\"textfield\\" type=\\"text\\" id=\\"textfield\\" value=\\"[!--address--]\\" size=\\"20\\">)</td>\r\n    <td><table width=\\"100%\\" border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\">\r\n        <tr> \r\n          <td><textarea name=\\"add[zz_address]\\" cols=\\"60\\" rows=\\"10\\" id=\\"textarea\\"><?=ehtmlspecialchars(stripSlashes($r[zz_address]))?></textarea></td>\r\n        </tr>\r\n        <tr> \r\n          <td><input name=\\"add[z_address]\\" type=\\"text\\" id=\\"add[z_address]\\" value=\\"<?=stripSlashes($r[z_address])?>\\">\r\n            (�p��g�o�̡A�N���r�q����)</td>\r\n        </tr>\r\n      </table></td>\r\n  </tr>\r\n', 2, 'VARCHAR', '255', 1, 8, 'info', 0, '$memberinfor[address]', 0, 0, 1, '<input name=\\"address\\" type=\\"text\\" id=\\"address\\" value=\\"<?=$ecmsfirstpost==1?$memberinfor[address]:DoReqValue($mid,\\\'address\\\',stripSlashes($r[address]))?>\\" size=\\"46\\">\r\n', 0, '', 0, '46', 1, 0, '', '', '', '', '', '', 0, 0, '');



INSERT INTO `phome_enewsmod` VALUES (1, '�s�D�t�μҫ�', '<table width=\\\'100%\\\' align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\"><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D(*)</td><td bgcolor=\\\'ffffff\\\'>[!--title--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�Ƽ��D</td><td bgcolor=\\\'ffffff\\\'>[!--ftitle--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�S���ݩ�</td><td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�o�G�ɶ�</td><td bgcolor=\\\'ffffff\\\'>[!--newstime--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D�Ϥ�</td><td bgcolor=\\\'ffffff\\\'>[!--titlepic--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���e²��</td><td bgcolor=\\\'ffffff\\\'>[!--smalltext--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�@��</td><td bgcolor=\\\'ffffff\\\'>[!--writer--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�H���ӷ�</td><td bgcolor=\\\'ffffff\\\'>[!--befrom--]</td></tr><tr><td height=25 colspan=2 bgcolor=\\\'ffffff\\\'><div align=left>�s�D����(*)</div></td></tr></table><div style=\\"background-color:#D0D0D0\\">[!--newstext--]</div>', '�s�D�t�μҫ�', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->��<!--field--->diggtop<!--record-->', '|34|35|36|37|', ',title,smalltext,', 1, 'news', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�S���ݩ�<!--field--->special.field<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->', ',title,newstext,', '<table width=100% align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\"><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D(*)</td><td bgcolor=\\\'ffffff\\\'>[!--title--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�Ƽ��D</td><td bgcolor=\\\'ffffff\\\'>[!--ftitle--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>����r</td><td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D�Ϥ�</td><td bgcolor=\\\'ffffff\\\'>[!--titlepic--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���e²��</td><td bgcolor=\\\'ffffff\\\'>[!--smalltext--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�@��</td><td bgcolor=\\\'ffffff\\\'>[!--writer--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�H���ӷ�</td><td bgcolor=\\\'ffffff\\\'>[!--befrom--]</td></tr><tr><td height=25 colspan=2 bgcolor=\\\'ffffff\\\'><div align=left>�s�D����(*)</div></td></tr></table><div style=\\"background-color:#D0D0D0\\">[!--newstext--]</div>', '', 0, '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->��<!--field--->diggtop<!--record-->', '�s�D', ',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,', ',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,', 0, 0, 0, 0, '', 1, '', 0);
INSERT INTO `phome_enewsmod` VALUES (2, '�U���t�μҫ�', '<script>\r\nfunction AddFj(str)\r\n{var r;\r\nvar a;\r\na=document.add.softfj.value;\r\nr=a.split(str);\r\nif(r.length!=1)\r\n{return true;}\r\ndocument.add.softfj.value+=\\"/\\"+str;\r\n}\r\nfunction DelFj(str)\r\n{\r\nvar a;\r\na=document.add.softfj.value;\r\ndocument.add.softfj.value=a.replace(\\"/\\"+str,\\"\\");\r\n}\r\n</script>\r\n<table width=100% align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\">\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��W��(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�S���ݩ�</td>\r\n    <td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td>\r\n    <td bgcolor=ffffff>[!--newstime--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��w����</td>\r\n    <td bgcolor=ffffff>[!--titlepic--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��@��</td>\r\n    <td bgcolor=ffffff>[!--softwriter--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�t�ӥD��</td>\r\n    <td bgcolor=ffffff>[!--homepage--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�t�κt��</td>\r\n    <td bgcolor=ffffff>[!--demo--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�B������</td>\r\n    <td bgcolor=ffffff>[!--softfj--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td height=25 bgcolor=ffffff>&nbsp;</td>\r\n    <td bgcolor=ffffff><input type=checkbox name=check value=\\\'Win9X/Me\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Win9X/Me&nbsp; <input type=checkbox name=check value=\\\'WinNT/2000/XP\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      WinNT/2000/XP&nbsp; <input type=checkbox name=check value=\\\'Unix\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Unix&nbsp; <input type=checkbox name=check value=\\\'Linux\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Linux&nbsp; <input type=checkbox name=check value=\\\'DOS\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      DOS&nbsp; <input type=checkbox name=check value=\\\'MAC OS\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      MAC OS&nbsp; <input type=checkbox name=check value=\\\'Other\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Other</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n���ݩ�</td>\r\n    <td bgcolor=ffffff>�n��y���G[!--language--]�A�n�������G[!--softtype--]�A���v�Φ��G[!--softsq--]�A�n������G[!--star--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>���</td>\r\n    <td bgcolor=ffffff>��������G[!--filetype--]�A���j�p�G[!--filesize--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�U���a�}(*)</td>\r\n    <td bgcolor=ffffff>[!--downpath--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��²��(*)</td>\r\n    <td bgcolor=ffffff>[!--softsay--]</td>\r\n  </tr>\r\n</table>', '', '�n��W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�n��w����<!--field--->titlepic<!--record-->�n��@��<!--field--->softwriter<!--record-->�t�ӥD��<!--field--->homepage<!--record-->�t�κt��<!--field--->demo<!--record-->�B������<!--field--->softfj<!--record-->�n��y��<!--field--->language<!--record-->�n������<!--field--->softtype<!--record-->���v�Φ�<!--field--->softsq<!--record-->�n�����<!--field--->star<!--record-->�������<!--field--->filetype<!--record-->���j�p<!--field--->filesize<!--record-->�U���a�}<!--field--->downpath<!--record-->�n��²��<!--field--->softsay<!--record-->', '�n��W��<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�n��w����<!--field--->titlepic<!--record-->�n��@��<!--field--->softwriter<!--record-->�t�ӥD��<!--field--->homepage<!--record-->�t�κt��<!--field--->demo<!--record-->�B������<!--field--->softfj<!--record-->�n��y��<!--field--->language<!--record-->�n������<!--field--->softtype<!--record-->���v�Φ�<!--field--->softsq<!--record-->�n�����<!--field--->star<!--record-->�������<!--field--->filetype<!--record-->���j�p<!--field--->filesize<!--record-->�U���a�}<!--field--->downpath<!--record-->�n��²��<!--field--->softsay<!--record-->', '�n��W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�n��w����<!--field--->titlepic<!--record-->�n��@��<!--field--->softwriter<!--record-->�t�ӥD��<!--field--->homepage<!--record-->�t�κt��<!--field--->demo<!--record-->�B������<!--field--->softfj<!--record-->�n��y��<!--field--->language<!--record-->�n������<!--field--->softtype<!--record-->���v�Φ�<!--field--->softsq<!--record-->�n�����<!--field--->star<!--record-->�������<!--field--->filetype<!--record-->���j�p<!--field--->filesize<!--record-->�U���a�}<!--field--->downpath<!--record-->�n��²��<!--field--->softsay<!--record-->', '|38|39|40|41|', ',title,softsay,', 2, 'download', '�n��W��<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�n��w����<!--field--->titlepic<!--record-->�n��@��<!--field--->softwriter<!--record-->�t�ӥD��<!--field--->homepage<!--record-->�t�κt��<!--field--->demo<!--record-->�B������<!--field--->softfj<!--record-->�n��y��<!--field--->language<!--record-->�n������<!--field--->softtype<!--record-->���v�Φ�<!--field--->softsq<!--record-->�������<!--field--->filetype<!--record-->���j�p<!--field--->filesize<!--record-->�U���a�}<!--field--->downpath<!--record-->�n��²��<!--field--->softsay<!--record-->', ',title,downpath,softsay,', '<script>\r\nfunction AddFj(str)\r\n{var r;\r\nvar a;\r\na=document.add.softfj.value;\r\nr=a.split(str);\r\nif(r.length!=1)\r\n{return true;}\r\ndocument.add.softfj.value+=\\"/\\"+str;\r\n}\r\nfunction DelFj(str)\r\n{\r\nvar a;\r\na=document.add.softfj.value;\r\ndocument.add.softfj.value=a.replace(\\"/\\"+str,\\"\\");\r\n}\r\n</script>\r\n<table width=100% align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\">\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��W��(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>����r</td>\r\n    <td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��w����</td>\r\n    <td bgcolor=ffffff>[!--titlepic--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��@��</td>\r\n    <td bgcolor=ffffff>[!--softwriter--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�t�ӥD��</td>\r\n    <td bgcolor=ffffff>[!--homepage--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�t�κt��</td>\r\n    <td bgcolor=ffffff>[!--demo--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�B������</td>\r\n    <td bgcolor=ffffff>[!--softfj--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td height=25 bgcolor=ffffff>&nbsp;</td>\r\n    <td bgcolor=ffffff><input type=checkbox name=check value=\\\'Win9X/Me\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Win9X/Me&nbsp; <input type=checkbox name=check value=\\\'WinNT/2000/XP\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      WinNT/2000/XP&nbsp; <input type=checkbox name=check value=\\\'Unix\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Unix&nbsp; <input type=checkbox name=check value=\\\'Linux\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Linux&nbsp; <input type=checkbox name=check value=\\\'DOS\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      DOS&nbsp; <input type=checkbox name=check value=\\\'MAC OS\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      MAC OS&nbsp; <input type=checkbox name=check value=\\\'Other\\\' onclick=\\"if(this.checked){AddFj(this.value);}else{DelFj(this.value);}\\">\r\n      Other</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n���ݩ�</td>\r\n    <td bgcolor=ffffff>�n��y���G[!--language--]�A�n�������G[!--softtype--]�A���v�Φ��G[!--softsq--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>���</td>\r\n    <td bgcolor=ffffff>��������G[!--filetype--]�A���j�p�G[!--filesize--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�W�ǳn��(*)</td>\r\n    <td bgcolor=ffffff>[!--downpath--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�n��²��(*)</td>\r\n    <td bgcolor=ffffff>[!--softsay--]</td>\r\n  </tr>\r\n</table>', '', 0, '�n��W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�n��w����<!--field--->titlepic<!--record-->�B������<!--field--->softfj<!--record-->�n��y��<!--field--->language<!--record-->�n������<!--field--->softtype<!--record-->���v�Φ�<!--field--->softsq<!--record-->�n�����<!--field--->star<!--record-->�������<!--field--->filetype<!--record-->���j�p<!--field--->filesize<!--record-->�n��²��<!--field--->softsay<!--record-->', '�n��', ',title,newstime,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,', ',title,newstime,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,', 0, 0, 0, 0, '', 1, '', 0);
INSERT INTO `phome_enewsmod` VALUES (3, '�Ϥ��t�μҫ�', '<table width=100% align=center cellpadding=3 cellspacing=1 class=tableborder>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�Ϥ��W��(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�S���ݩ�</td>\r\n    <td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td>\r\n    <td bgcolor=ffffff>[!--newstime--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>���j�p</td>\r\n    <td bgcolor=ffffff>[!--filesize--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>����ݩ�</td>\r\n    <td bgcolor=ffffff>�Ϥ��ؤo�G[!--picsize--]�A�Ϥ�����v�G[!--picfbl--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�ӷ�</td>\r\n    <td bgcolor=ffffff>[!--picfrom--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�Ϥ��p��</td>\r\n    <td bgcolor=ffffff>[!--titlepic--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�Ϥ��j��</td>\r\n    <td bgcolor=ffffff>[!--picurl--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�Ϥ���</td>\r\n    <td bgcolor=ffffff>[!--morepic--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�϶��ݩ�</td>\r\n    <td bgcolor=ffffff>�C����ܱ��ơG[!--num--]�A�Y�Ϥj�p�G[!--width--]*[!--height--]<font color=\\"#666666\\">(�e*��)</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�Ϥ�²��(*)</td>\r\n    <td bgcolor=ffffff>[!--picsay--]</td>\r\n  </tr>\r\n</table>', '', '�Ϥ��W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���j�p<!--field--->filesize<!--record-->�Ϥ��ؤo<!--field--->picsize<!--record-->�Ϥ�����v<!--field--->picfbl<!--record-->�ӷ�<!--field--->picfrom<!--record-->�Ϥ��p��<!--field--->titlepic<!--record-->�Ϥ��j��<!--field--->picurl<!--record-->�Ϥ���<!--field--->morepic<!--record-->�C����ܱ���<!--field--->num<!--record-->�Y�ϼe��<!--field--->width<!--record-->�Y�ϰ���<!--field--->height<!--record-->�Ϥ�²��<!--field--->picsay<!--record-->', '�Ϥ��W��<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���j�p<!--field--->filesize<!--record-->�Ϥ��ؤo<!--field--->picsize<!--record-->�Ϥ�����v<!--field--->picfbl<!--record-->�ӷ�<!--field--->picfrom<!--record-->�Ϥ��p��<!--field--->titlepic<!--record-->�Ϥ��j��<!--field--->picurl<!--record-->�Ϥ���<!--field--->morepic<!--record-->�C����ܱ���<!--field--->num<!--record-->�Y�ϼe��<!--field--->width<!--record-->�Y�ϰ���<!--field--->height<!--record-->�Ϥ�²��<!--field--->picsay<!--record-->', '�Ϥ��W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���j�p<!--field--->filesize<!--record-->�Ϥ��ؤo<!--field--->picsize<!--record-->�Ϥ�����v<!--field--->picfbl<!--record-->�ӷ�<!--field--->picfrom<!--record-->�Ϥ��p��<!--field--->titlepic<!--record-->�Ϥ��j��<!--field--->picurl<!--record-->�Ϥ���<!--field--->morepic<!--record-->�C����ܱ���<!--field--->num<!--record-->�Y�ϼe��<!--field--->width<!--record-->�Y�ϰ���<!--field--->height<!--record-->�Ϥ�²��<!--field--->picsay<!--record-->', '|52|53|54|', ',title,picsay,', 3, 'photo', '�Ϥ��W��<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->���j�p<!--field--->filesize<!--record-->�Ϥ��ؤo<!--field--->picsize<!--record-->�Ϥ�����v<!--field--->picfbl<!--record-->�ӷ�<!--field--->picfrom<!--record-->�Ϥ��p��<!--field--->titlepic<!--record-->�Ϥ��j��<!--field--->picurl<!--record-->�Ϥ�²��<!--field--->picsay<!--record-->', ',title,picsay,', '<table width=100% align=center cellpadding=3 cellspacing=1 class=tableborder><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ��W��</td><td bgcolor=ffffff>[!--title--]</td></tr>\r\n  <tr>\r\n    <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>����r</td>\r\n    <td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td>\r\n  </tr>\r\n<tr><td width=16% height=25 bgcolor=ffffff>���j�p</td><td bgcolor=ffffff>[!--filesize--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ��ؤo</td><td bgcolor=ffffff>[!--picsize--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ�����v</td><td bgcolor=ffffff>[!--picfbl--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�ӷ�</td><td bgcolor=ffffff>[!--picfrom--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ��p��</td><td bgcolor=ffffff>[!--titlepic--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ��j��</td><td bgcolor=ffffff>[!--picurl--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ�²��</td><td bgcolor=ffffff>[!--picsay--]</td></tr></table>', '', 0, '�Ϥ��W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�Ϥ��p��<!--field--->titlepic<!--record-->�Ϥ��j��<!--field--->picurl<!--record-->�Ϥ�²��<!--field--->picsay<!--record-->', '�Ϥ�', ',title,newstime,filesize,picsize,picfbl,picfrom,titlepic,picurl,morepic,num,width,height,picsay,', ',title,newstime,filesize,picsize,picfbl,picfrom,titlepic,picurl,morepic,num,width,height,picsay,', 0, 0, 0, 0, '', 1, '', 0);
INSERT INTO `phome_enewsmod` VALUES (4, 'FLASH�t�μҫ�', '<table width=100% align=center cellpadding=3 cellspacing=1 class=tableborder>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�@�~�W(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�S���ݩ�</td>\r\n    <td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td>\r\n    <td bgcolor=ffffff>[!--newstime--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�@�~�w����</td>\r\n    <td bgcolor=ffffff>[!--titlepic--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�@��</td>\r\n    <td bgcolor=ffffff>[!--flashwriter--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�@�̶l�c</td>\r\n    <td bgcolor=ffffff>[!--email--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�@�~����</td>\r\n    <td bgcolor=ffffff>[!--star--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>���j�p</td>\r\n    <td bgcolor=ffffff>[!--filesize--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>Flash�a�}(*)</td>\r\n    <td bgcolor=ffffff>[!--flashurl--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>Flash�W��</td>\r\n    <td bgcolor=ffffff>[!--width--]*[!--height--]<font color=\\"#666666\\">(�e��*����)</font></td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�@�~²��(*)</td>\r\n    <td bgcolor=ffffff>[!--flashsay--]</td>\r\n  </tr>\r\n</table>', '', '�@�~�W<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�@�~�w����<!--field--->titlepic<!--record-->�@��<!--field--->flashwriter<!--record-->�@�̶l�c<!--field--->email<!--record-->�@�~����<!--field--->star<!--record-->���j�p<!--field--->filesize<!--record-->Flash�a�}<!--field--->flashurl<!--record-->Flash�e��<!--field--->width<!--record-->Flash����<!--field--->height<!--record-->�@�~²��<!--field--->flashsay<!--record-->', '�@�~�W<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�@�~�w����<!--field--->titlepic<!--record-->�@��<!--field--->flashwriter<!--record-->�@�̶l�c<!--field--->email<!--record-->�@�~����<!--field--->star<!--record-->���j�p<!--field--->filesize<!--record-->Flash�a�}<!--field--->flashurl<!--record-->Flash�e��<!--field--->width<!--record-->Flash����<!--field--->height<!--record-->�@�~²��<!--field--->flashsay<!--record-->', '�@�~�W<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�@�~�w����<!--field--->titlepic<!--record-->�@��<!--field--->flashwriter<!--record-->�@�̶l�c<!--field--->email<!--record-->�@�~����<!--field--->star<!--record-->���j�p<!--field--->filesize<!--record-->Flash�a�}<!--field--->flashurl<!--record-->Flash�e��<!--field--->width<!--record-->Flash����<!--field--->height<!--record-->�@�~²��<!--field--->flashsay<!--record-->', '|50|51|', ',title,flashwriter,flashsay,', 4, 'flash', '�@�~�W<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�@�~�w����<!--field--->titlepic<!--record-->�@��<!--field--->flashwriter<!--record-->�@�̶l�c<!--field--->email<!--record-->���j�p<!--field--->filesize<!--record-->Flash�a�}<!--field--->flashurl<!--record-->Flash�e��<!--field--->width<!--record-->Flash����<!--field--->height<!--record-->�@�~²��<!--field--->flashsay<!--record-->', ',title,flashurl,flashsay,', '<table width=\\\'100%\\\' align=center cellpadding=3 cellspacing=1 class=tableborder>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�@�~�W(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>����r</td>\r\n    <td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�@�~�w����</td>\r\n    <td bgcolor=ffffff>[!--titlepic--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�@��</td>\r\n    <td bgcolor=ffffff>[!--flashwriter--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�@�̶l�c</td>\r\n    <td bgcolor=ffffff>[!--email--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>���j�p</td>\r\n    <td bgcolor=ffffff>[!--filesize--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�W��Flash(*)</td>\r\n    <td bgcolor=ffffff>[!--flashurl--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>Flash�W��</td>\r\n    <td bgcolor=ffffff>[!--width--]*[!--height--]<font color=\\"#666666\\">(�e��*����)</font></td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�@�~²��(*)</td>\r\n    <td bgcolor=ffffff>[!--flashsay--]</td>\r\n  </tr>\r\n</table>\r\n', '', 0, '�@�~�W<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�@�~�w����<!--field--->titlepic<!--record-->�@��<!--field--->flashwriter<!--record-->�@�~����<!--field--->star<!--record-->���j�p<!--field--->filesize<!--record-->Flash�a�}<!--field--->flashurl<!--record-->�@�~²��<!--field--->flashsay<!--record-->', 'FLASH', ',title,newstime,titlepic,flashwriter,email,star,filesize,flashurl,width,height,flashsay,', ',title,newstime,titlepic,flashwriter,email,star,filesize,flashurl,width,height,flashsay,', 0, 0, 0, 0, '', 1, '', 0);
INSERT INTO `phome_enewsmod` VALUES (5, '�q�v�t�μҫ�', '<table width=100% align=center cellpadding=3 cellspacing=1 class=tableborder>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�v���W(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�S���ݩ�</td>\r\n    <td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td>\r\n    <td bgcolor=ffffff>[!--newstime--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�v���Y����</td>\r\n    <td bgcolor=ffffff>[!--titlepic--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�v������</td>\r\n    <td bgcolor=ffffff>[!--movietype--]�A���˵��šG[!--star--]�A�����I�ơG[!--moviefen--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�X�~���q</td>\r\n    <td bgcolor=ffffff>[!--company--]�A�X�~�ɶ��G[!--movietime--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�D�t</td>\r\n    <td bgcolor=ffffff>[!--player--]�A�ɺt&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�G[!--playadmin--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�v�����</td>\r\n    <td bgcolor=ffffff>�v���榡�G[!--filetype--]�A�v���j�p�G[!--filesize--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�v���ݩ�</td>\r\n    <td bgcolor=ffffff>�a�e�n�D�G[!--playdk--]�A�����G[!--playtime--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�U���a�}</td>\r\n    <td bgcolor=ffffff>[!--downpath--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�b�u�[�ݼ���</td>\r\n    <td bgcolor=ffffff>[!--playerid--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�b�u�[�ݦa�}</td>\r\n    <td bgcolor=ffffff>[!--onlinepath--]</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=16% height=25 bgcolor=ffffff>�v��²��(*)</td>\r\n    <td bgcolor=ffffff>[!--moviesay--]</td>\r\n  </tr>\r\n</table>\r\n', '', '�v���W<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�v���Y����<!--field--->titlepic<!--record-->�v������<!--field--->movietype<!--record-->�X�~���q<!--field--->company<!--record-->�X�~�ɶ�<!--field--->movietime<!--record-->�D�t<!--field--->player<!--record-->�ɺt<!--field--->playadmin<!--record-->�v���榡<!--field--->filetype<!--record-->�v���j�p<!--field--->filesize<!--record-->���˵���<!--field--->star<!--record-->�a�e�n�D<!--field--->playdk<!--record-->����<!--field--->playtime<!--record-->�����I��<!--field--->moviefen<!--record-->�U���a�}<!--field--->downpath<!--record-->����<!--field--->playerid<!--record-->�b�u�[�ݦa�}<!--field--->onlinepath<!--record-->�v��²��<!--field--->moviesay<!--record-->', '�v���W<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�v���Y����<!--field--->titlepic<!--record-->�v������<!--field--->movietype<!--record-->�X�~���q<!--field--->company<!--record-->�X�~�ɶ�<!--field--->movietime<!--record-->�D�t<!--field--->player<!--record-->�ɺt<!--field--->playadmin<!--record-->�v���榡<!--field--->filetype<!--record-->�v���j�p<!--field--->filesize<!--record-->���˵���<!--field--->star<!--record-->�a�e�n�D<!--field--->playdk<!--record-->����<!--field--->playtime<!--record-->�����I��<!--field--->moviefen<!--record-->�U���a�}<!--field--->downpath<!--record-->����<!--field--->playerid<!--record-->�b�u�[�ݦa�}<!--field--->onlinepath<!--record-->�v��²��<!--field--->moviesay<!--record-->', '�v���W<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�v���Y����<!--field--->titlepic<!--record-->�v������<!--field--->movietype<!--record-->�X�~���q<!--field--->company<!--record-->�X�~�ɶ�<!--field--->movietime<!--record-->�D�t<!--field--->player<!--record-->�ɺt<!--field--->playadmin<!--record-->�v���榡<!--field--->filetype<!--record-->�v���j�p<!--field--->filesize<!--record-->���˵���<!--field--->star<!--record-->�a�e�n�D<!--field--->playdk<!--record-->����<!--field--->playtime<!--record-->�����I��<!--field--->moviefen<!--record-->�U���a�}<!--field--->downpath<!--record-->����<!--field--->playerid<!--record-->�b�u�[�ݦa�}<!--field--->onlinepath<!--record-->�v��²��<!--field--->moviesay<!--record-->', '|42|43|44|45|', ',title,movietype,company,player,playadmin,moviesay,', 5, 'movie', '', ',title,moviesay,', '<table width=100% align=center cellpadding=3 cellspacing=1 bgcolor=#DBEAF5></table>', '', 0, '�v���W<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�v���Y����<!--field--->titlepic<!--record-->�v������<!--field--->movietype<!--record-->�X�~���q<!--field--->company<!--record-->�X�~�ɶ�<!--field--->movietime<!--record-->�D�t<!--field--->player<!--record-->�ɺt<!--field--->playadmin<!--record-->�v���榡<!--field--->filetype<!--record-->�v���j�p<!--field--->filesize<!--record-->���˵���<!--field--->star<!--record-->�����I��<!--field--->moviefen<!--record-->�v��²��<!--field--->moviesay<!--record-->', '�q�v', ',title,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,', ',title,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,', 0, 0, 0, 0, '', 1, '', 0);
INSERT INTO `phome_enewsmod` VALUES (6, '�ӫ��t�μҫ�', '<table width=100% align=center cellpadding=3 cellspacing=1 class=tableborder>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�ӫ~�W��(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td>\r\n  </tr>\r\n  <tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�S���ݩ�</td><td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td></tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td>\r\n    <td bgcolor=ffffff>[!--newstime--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�ӫ~�s��</td>\r\n    <td bgcolor=ffffff>[!--productno--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�~�P</td>\r\n    <td bgcolor=ffffff>[!--pbrand--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>²��y�z</td>\r\n    <td bgcolor=ffffff>[!--intro--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�p�q���</td>\r\n    <td bgcolor=ffffff>[!--unit--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>��쭫�q</td>\r\n    <td bgcolor=ffffff>[!--weight--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>��������</td>\r\n    <td bgcolor=ffffff>[!--tprice--]��</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�ʶR����</td>\r\n    <td bgcolor=ffffff>[!--price--]��</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�n���ʶR</td>\r\n    <td bgcolor=ffffff>[!--buyfen--]�I</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�w�s</td>\r\n    <td bgcolor=ffffff>[!--pmaxnum--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�ӫ~�Y����</td>\r\n    <td bgcolor=ffffff>[!--titlepic--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�ӫ~�j��</td>\r\n    <td bgcolor=ffffff>[!--productpic--]</td>\r\n  </tr>\r\n  <tr>\r\n    <td height=25 colspan=2 bgcolor=ffffff><div align=left>�ӫ~����(*)</div></td>\r\n  </tr>\r\n</table>\r\n<div style=\\"background-color:#D0D0D0\\">[!--newstext--]</div>', '', '�ӫ~�W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�ӫ~�s��<!--field--->productno<!--record-->�~�P<!--field--->pbrand<!--record-->²��y�z<!--field--->intro<!--record-->�p�q���<!--field--->unit<!--record-->��쭫�q<!--field--->weight<!--record-->��������<!--field--->tprice<!--record-->�ʶR����<!--field--->price<!--record-->�n���ʶR<!--field--->buyfen<!--record-->�w�s<!--field--->pmaxnum<!--record-->�ӫ~�Y����<!--field--->titlepic<!--record-->�ӫ~�j��<!--field--->productpic<!--record-->�ӫ~����<!--field--->newstext<!--record-->', '�ӫ~�W��<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�ӫ~�s��<!--field--->productno<!--record-->�~�P<!--field--->pbrand<!--record-->²��y�z<!--field--->intro<!--record-->�p�q���<!--field--->unit<!--record-->��쭫�q<!--field--->weight<!--record-->��������<!--field--->tprice<!--record-->�ʶR����<!--field--->price<!--record-->�n���ʶR<!--field--->buyfen<!--record-->�w�s<!--field--->pmaxnum<!--record-->�ӫ~�Y����<!--field--->titlepic<!--record-->�ӫ~�j��<!--field--->productpic<!--record-->�ӫ~����<!--field--->newstext<!--record-->', '�ӫ~�W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�ӫ~�s��<!--field--->productno<!--record-->�~�P<!--field--->pbrand<!--record-->²��y�z<!--field--->intro<!--record-->�p�q���<!--field--->unit<!--record-->��쭫�q<!--field--->weight<!--record-->��������<!--field--->tprice<!--record-->�ʶR����<!--field--->price<!--record-->�n���ʶR<!--field--->buyfen<!--record-->�w�s<!--field--->pmaxnum<!--record-->�ӫ~�Y����<!--field--->titlepic<!--record-->�ӫ~�j��<!--field--->productpic<!--record-->�ӫ~����<!--field--->newstext<!--record-->�P��q<!--field--->psalenum<!--record-->', '|46|47|48|49|', ',title,productno,pbrand,intro,price,newstext,', 6, 'shop', '', ',title,newstext,', '<table width=100% align=center cellpadding=3 cellspacing=1 bgcolor=#DBEAF5></table>', '', 0, '�ӫ~�W��<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�ӫ~�s��<!--field--->productno<!--record-->�~�P<!--field--->pbrand<!--record-->²��y�z<!--field--->intro<!--record-->�p�q���<!--field--->unit<!--record-->��쭫�q<!--field--->weight<!--record-->��������<!--field--->tprice<!--record-->�ʶR����<!--field--->price<!--record-->�n���ʶR<!--field--->buyfen<!--record-->�w�s<!--field--->pmaxnum<!--record-->�ӫ~�Y����<!--field--->titlepic<!--record-->�ӫ~�j��<!--field--->productpic<!--record-->�ӫ~����<!--field--->newstext<!--record-->�P��q<!--field--->psalenum<!--record-->', '�ӫ~', ',title,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,', ',title,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,', 0, 0, 0, 0, '', 1, '', 0);
INSERT INTO `phome_enewsmod` VALUES (7, '�峹�t�μҫ�', '<table width=\\\'100%\\\' align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\"><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D(*)</td><td bgcolor=\\\'ffffff\\\'>[!--title--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�Ƽ��D</td><td bgcolor=\\\'ffffff\\\'>[!--ftitle--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�S���ݩ�</td><td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�o�G�ɶ�</td><td bgcolor=\\\'ffffff\\\'>[!--newstime--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D�Ϥ�</td><td bgcolor=\\\'ffffff\\\'>[!--titlepic--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���e²��</td><td bgcolor=\\\'ffffff\\\'>[!--smalltext--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�@��</td><td bgcolor=\\\'ffffff\\\'>[!--writer--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�H���ӷ�</td><td bgcolor=\\\'ffffff\\\'>[!--befrom--]</td></tr><tr><td height=25 colspan=2 bgcolor=\\\'ffffff\\\'><div align=left>�s�D����(*)</div></td></tr></table><div style=\\"background-color:#D0D0D0\\">[!--newstext--]</div>', '', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->��<!--field--->diggtop<!--record-->', '|55|56|57|', ',title,smalltext,', 7, 'article', '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�S���ݩ�<!--field--->special.field<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->�@��<!--field--->writer<!--record-->�H���ӷ�<!--field--->befrom<!--record-->�s�D����<!--field--->newstext<!--record-->', ',title,newstext,', '<table width=100% align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\"><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D(*)</td><td bgcolor=\\\'ffffff\\\'>[!--title--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�Ƽ��D</td><td bgcolor=\\\'ffffff\\\'>[!--ftitle--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>����r</td><td bgcolor=\\\'ffffff\\\'>[!--special.field--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���D�Ϥ�</td><td bgcolor=\\\'ffffff\\\'>[!--titlepic--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>���e²��</td><td bgcolor=\\\'ffffff\\\'>[!--smalltext--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�@��</td><td bgcolor=\\\'ffffff\\\'>[!--writer--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>�H���ӷ�</td><td bgcolor=\\\'ffffff\\\'>[!--befrom--]</td></tr><tr><td height=25 colspan=2 bgcolor=\\\'ffffff\\\'><div align=left>�s�D����(*)</div></td></tr></table><div style=\\"background-color:#D0D0D0\\">[!--newstext--]</div>', '', 0, '���D<!--field--->title<!--record-->�Ƽ��D<!--field--->ftitle<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->���D�Ϥ�<!--field--->titlepic<!--record-->���e²��<!--field--->smalltext<!--record-->��<!--field--->diggtop<!--record-->', '�峹', ',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,', ',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,', 0, 0, 0, 0, '', 1, '', 0);
INSERT INTO `phome_enewsmod` VALUES (8, '�����H���t�μҫ�', '<table width=100% align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\"><tr><td width=16% height=25 bgcolor=ffffff>���D</td><td bgcolor=ffffff>[!--title--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�S���ݩ�</td><td bgcolor=ffffff>[!--special.field--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td><td bgcolor=ffffff>[!--newstime--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�H�����e</td><td bgcolor=ffffff>[!--smalltext--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ�</td><td bgcolor=ffffff>[!--titlepic--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ҧb�a</td><td bgcolor=ffffff>[!--myarea--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�l�c</td><td bgcolor=ffffff>[!--email--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�覡</td><td bgcolor=ffffff>[!--mycontact--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�a�}</td><td bgcolor=ffffff>[!--address--]</td></tr></table>', '', '���D<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�H�����e<!--field--->smalltext<!--record-->�Ϥ�<!--field--->titlepic<!--record-->�Ҧb�a<!--field--->myarea<!--record-->�pô�l�c<!--field--->email<!--record-->�pô�覡<!--field--->mycontact<!--record-->�pô�a�}<!--field--->address<!--record-->', '���D<!--field--->title<!--record-->�S���ݩ�<!--field--->special.field<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�H�����e<!--field--->smalltext<!--record-->�Ϥ�<!--field--->titlepic<!--record-->�Ҧb�a<!--field--->myarea<!--record-->�pô�l�c<!--field--->email<!--record-->�pô�覡<!--field--->mycontact<!--record-->�pô�a�}<!--field--->address<!--record-->', '���D<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�H�����e<!--field--->smalltext<!--record-->�Ϥ�<!--field--->titlepic<!--record-->�Ҧb�a<!--field--->myarea<!--record-->�pô�l�c<!--field--->email<!--record-->�pô�覡<!--field--->mycontact<!--record-->�pô�a�}<!--field--->address<!--record-->', '|11|12|13|14|15|16|18|19|20|21|23|24|25|26|28|29|30|31|', ',title,smalltext,myarea,', 8, 'info', '���D<!--field--->title<!--record-->�H�����e<!--field--->smalltext<!--record-->�Ϥ�<!--field--->titlepic<!--record-->�Ҧb�a<!--field--->myarea<!--record-->�pô�l�c<!--field--->email<!--record-->�pô�覡<!--field--->mycontact<!--record-->�pô�a�}<!--field--->address<!--record-->', ',title,smalltext,myarea,email,', '<table width=100% align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\"><tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�H�����D(*)</td>\r\n    <td bgcolor=ffffff>[!--title--]</td></tr><tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�H�����e(*)</td>\r\n    <td bgcolor=ffffff>[!--smalltext--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ�</td><td bgcolor=ffffff>[!--titlepic--]</td></tr><tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�Ҧb�a(*)</td>\r\n    <td bgcolor=ffffff>[!--myarea--]</td></tr><tr>\r\n    <td width=16% height=25 bgcolor=ffffff>�pô�l�c(*)</td>\r\n    <td bgcolor=ffffff>[!--email--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�覡</td><td bgcolor=ffffff>[!--mycontact--]</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�a�}</td><td bgcolor=ffffff>[!--address--]</td></tr></table>', ',myarea,', 0, '���D<!--field--->title<!--record-->�o�G�ɶ�<!--field--->newstime<!--record-->�H�����e<!--field--->smalltext<!--record-->�Ϥ�<!--field--->titlepic<!--record-->�Ҧb�a<!--field--->myarea<!--record-->', '�����H��', ',title,newstime,smalltext,titlepic,myarea,email,mycontact,address,', ',title,newstime,smalltext,titlepic,myarea,email,mycontact,address,', 0, 0, 0, 0, '', 1, '', 0);



INSERT INTO `phome_enewstable` VALUES (1, 'news', '�s�D�t�μƾڪ�', '�s�D�t�μƾڪ�', 1, ',1,', '1', 0, 1, 0);
INSERT INTO `phome_enewstable` VALUES (2, 'download', '�U���t�μƾڪ�', '�U���t�μƾڪ�', 0, ',1,', '1', 0, 2, 0);
INSERT INTO `phome_enewstable` VALUES (3, 'photo', '�Ϥ��t�μƾڪ�', '�Ϥ��t�μƾڪ�', 0, ',1,', '1', 0, 3, 0);
INSERT INTO `phome_enewstable` VALUES (4, 'flash', 'FLASH�t�μƾڪ�', 'FLASH�t�μƾڪ�', 0, ',1,', '1', 0, 4, 0);
INSERT INTO `phome_enewstable` VALUES (5, 'movie', '�q�v�t�μƾڪ�', '�q�v�t�μƾڪ�', 0, ',1,', '1', 0, 5, 0);
INSERT INTO `phome_enewstable` VALUES (6, 'shop', '�ӫ��t�μƾڪ�', '�ӫ��t�μƾڪ�', 0, ',1,', '1', 0, 6, 0);
INSERT INTO `phome_enewstable` VALUES (7, 'article', '�峹�t�μƾڪ�', '�峹�t�μƾڪ�(���e�s�奻)', 0, ',1,', '1', 0, 7, 0);
INSERT INTO `phome_enewstable` VALUES (8, 'info', '�����H���ƾڪ�', '�����H���ƾڪ�', 0, ',1,', '1', 0, 8, 0);


