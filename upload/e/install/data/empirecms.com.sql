# --------------------------------------------------------
# 
# 帝國網站管理系統 
# 
# http://www.PHome.Net
# 
# EmpireCMS Version 7.2
# 
# --------------------------------------------------------


# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsad`;
CREATE TABLE `phome_enewsad` (
  `adid` int(10) unsigned NOT NULL auto_increment,
  `picurl` varchar(255) NOT NULL default '',
  `url` text NOT NULL,
  `pic_width` int(10) unsigned NOT NULL default '0',
  `pic_height` int(10) unsigned NOT NULL default '0',
  `onclick` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `adtype` tinyint(3) unsigned NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `target` varchar(10) NOT NULL default '',
  `alt` varchar(120) NOT NULL default '',
  `starttime` date NOT NULL default '0000-00-00',
  `endtime` date NOT NULL default '0000-00-00',
  `adsay` varchar(255) NOT NULL default '',
  `titlefont` varchar(14) NOT NULL default '',
  `titlecolor` varchar(10) NOT NULL default '',
  `htmlcode` text NOT NULL,
  `t` tinyint(3) unsigned NOT NULL default '0',
  `ylink` tinyint(1) NOT NULL default '0',
  `reptext` text NOT NULL,
  PRIMARY KEY  (`adid`),
  KEY `classid` (`classid`),
  KEY `t` (`t`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsadclass`;
CREATE TABLE `phome_enewsadclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` char(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsadclass` VALUES (1, '默認廣告分類');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsadminstyle`;
CREATE TABLE `phome_enewsadminstyle` (
  `styleid` smallint(5) unsigned NOT NULL auto_increment,
  `stylename` char(30) NOT NULL default '',
  `path` smallint(5) unsigned NOT NULL default '0',
  `isdefault` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`styleid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsadminstyle` VALUES (1, '管理員後台界面', 1, 1);
INSERT INTO `phome_enewsadminstyle` VALUES (2, '編輯後台界面', 2, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsbefrom`;
CREATE TABLE `phome_enewsbefrom` (
  `befromid` smallint(5) unsigned NOT NULL auto_increment,
  `sitename` char(60) NOT NULL default '',
  `siteurl` char(200) NOT NULL default '',
  PRIMARY KEY  (`befromid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsbq`;
CREATE TABLE `phome_enewsbq` (
  `bqid` smallint(5) unsigned NOT NULL auto_increment,
  `bqname` varchar(60) NOT NULL default '',
  `bqsay` text NOT NULL,
  `funname` varchar(60) NOT NULL default '',
  `bq` varchar(60) NOT NULL default '',
  `issys` tinyint(1) NOT NULL default '0',
  `bqgs` text NOT NULL,
  `isclose` tinyint(1) NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`bqid`),
  KEY `classid` (`classid`),
  KEY `isclose` (`isclose`),
  KEY `myorder` (`myorder`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsbq` VALUES (1, '文字調用標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看欄目ID點<a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>，查看標題分類ID點<a onclick=\\"window.open(\\\'../info/InfoType.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>,當前ID=\\\'selfinfo\\\'<br />\r\n            多個欄目ID與標題分類ID可用,號格開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示條數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示前幾條記錄</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示時間</div>\r\n            </td>\r\n            <td height=\\"25\\">是否在標題後顯示時間，0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">操作類型</div>\r\n            </td>\r\n            <td height=\\"25\\">具體看操作類型說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示欄目名</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">時間格式化</div>\r\n            </td>\r\n            <td height=\\"25\\">形式：Y-m-d H:i:s．默認為：\\\'(m-d)\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">附加SQL條件</div>\r\n            </td>\r\n            <td height=\\"25\\">附加調用條件，如：&quot;title=\\\'帝國\\\'&quot;</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示排序</div>\r\n            </td>\r\n            <td height=\\"25\\">可指定按相應的字段排序，如：&quot;id desc&quot;</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td colspan=\\"2\\">\r\n            <div align=\\"center\\">（註：在欄目ID中寫大欄目，系統會自己搜索子欄目的信息）</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_GetClassNews', 'phomenews', 1, '[phomenews]欄目ID,顯示條數,標題截取數,是否顯示時間,操作類型,是否顯示欄目名,\\\'時間格式化\\\',附加SQL條件,顯示排序[/phomenews]', 0, 1, 9);
INSERT INTO `phome_enewsbq` VALUES (22, '留言板調用', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td width=\\"40%\\">\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td width=\\"60%\\">參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示信息數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示記錄數</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <div align=\\"left\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></div>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">&nbsp;</div>\r\n            </td>\r\n            <td height=\\"25\\">模板標籤變量說明：<br />\r\n            留言ID：[!--lyid--]，留言內容：[!--lytext--]<br />\r\n            回復內容：[!--retext--]，留言時間：[!--lytime--]<br />\r\n            留言者：[!--name--]，留言者郵箱：[!--email--]<br />\r\n            序號：[!--no--]</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">留言分類ID</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <div align=\\"left\\">點擊<strong><a onclick=\\"window.open(\\\'../tool/GbookClass.php?[!--ehash--]\\\');\\">這裡</a></strong>查看分類ID，0為不限制</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_ShowLyInfo', 'gbookinfo', 1, '[gbookinfo]顯示信息數,標籤模板ID,留言分類ID[/gbookinfo]', 0, 3, 5);
INSERT INTO `phome_enewsbq` VALUES (23, '專題調用標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </div>\r\n            </td>\r\n            <td height=\\"25\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">&nbsp;</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <p>模板標籤變量說明：(list.var)<br />\r\n            [!--classurl--]：專題鏈接，[!--classname--]：專題名稱<br />\r\n            [!--classid--]：專題id，[!--classimg--]：專題圖片<br />\r\n            [!--intro--]：專題簡介,[!--no--]：序號</p>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">專題類別ID</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <div align=\\"left\\">點擊<strong><a onclick=\\"window.open(\\\'../special/ListZtClass.php?[!--ehash--]\\\');\\">這裡</a></strong>查看分類ID，0為不限制，多個分類ID用逗號隔開，如\\\'1,2\\\'</div>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示專題數</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不限制</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">所屬欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">點擊<strong><a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\">這裡</a></strong>查看欄目ID，0為不限制，多個欄目ID用逗號隔開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_ShowZtData', 'eshowzt', 1, '[eshowzt]標籤模板ID,專題類別ID,顯示專題數,所屬欄目ID[/eshowzt]', 0, 2, 6);
INSERT INTO `phome_enewsbq` VALUES (2, '圖文信息調用(標題圖片的信息)', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看欄目ID點<a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>，查看標題分類ID點<a onclick=\\"window.open(\\\'../info/InfoType.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>,當前ID=\\\'selfinfo\\\'<br />\r\n            多個欄目ID與標題分類ID可用,號格開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">每行顯示條數</div>\r\n            </td>\r\n            <td height=\\"25\\">每行顯示幾個圖片</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示總信息數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示信息總數</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">圖片寬度，圖片高度</div>\r\n            </td>\r\n            <td height=\\"25\\">圖文信息圖片大小</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示標題</div>\r\n            </td>\r\n            <td height=\\"25\\">是否在圖片下顯示標題，0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td bgcolor=\\"#ffffff\\" height=\\"25\\">\r\n            <div align=\\"center\\">標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td bgcolor=\\"#ffffff\\" height=\\"25\\">\r\n            <div align=\\"center\\">操作類型說明</div>\r\n            </td>\r\n            <td height=\\"25\\">具體看操作類型說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">附加SQL條件</div>\r\n            </td>\r\n            <td height=\\"25\\">附加調用條件，如：&quot;title=\\\'帝國\\\'&quot;</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示排序</div>\r\n            </td>\r\n            <td height=\\"25\\">可指定按相應的字段排序，如：&quot;id desc&quot;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_GetClassNewsPic', 'phomenewspic', 1, '[phomenewspic]欄目ID,每行顯示條數,顯示總信息數,圖片寬度,圖片高度,是否顯示標題,標題截取數,操作類型,附加SQL條件,顯示排序[/phomenewspic]', 0, 1, 9);
INSERT INTO `phome_enewsbq` VALUES (5, '廣告標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">廣告ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看廣告ID點<a onclick=\\"window.open(\\\'../tool/ListAd.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_GetAd', 'phomead', 1, '[phomead]廣告ID[/phomead]', 0, 3, 5);
INSERT INTO `phome_enewsbq` VALUES (6, '投票標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">投票ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看投票ID點<a onclick=\\"window.open(\\\'../tool/ListVote.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_GetVote', 'phomevote', 1, '[phomevote]投票ID[/phomevote]', 0, 3, 5);
INSERT INTO `phome_enewsbq` VALUES (11, '帶模板的信息調用標籤[萬能標籤]', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看欄目ID點<a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>，查看標題分類ID點<a onclick=\\"window.open(\\\'../info/InfoType.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>,當前ID=\\\'selfinfo\\\'<br />\r\n            多個欄目ID與標題分類ID可用,號格開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示條數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示前幾條記錄</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示欄目名</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">操作類型</div>\r\n            </td>\r\n            <td height=\\"25\\">具體看操作類型說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">只顯示有標題圖片</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不限制，1為只顯示有標題圖片的信息</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">附加SQL條件</div>\r\n            </td>\r\n            <td height=\\"25\\">附加調用條件，如：&quot;title=\\\'帝國\\\'&quot;</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示排序</div>\r\n            </td>\r\n            <td height=\\"25\\">可指定按相應的字段排序，如：&quot;id desc&quot;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_GetEcmsInfo', 'ecmsinfo', 1, '[ecmsinfo]欄目ID,顯示條數,標題截取數,是否顯示欄目名,操作類型,模板ID,只顯示有標題圖片,附加SQL條件,顯示排序[/ecmsinfo]', 0, 1, 10);
INSERT INTO `phome_enewsbq` VALUES (12, '友情鏈接標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td width=\\"40%\\">\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td width=\\"60%\\">參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">每行顯示記錄數</div>\r\n            </td>\r\n            <td height=\\"25\\">每行顯示記錄數</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示總記錄數</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <div align=\\"left\\">總記錄數</div>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">操作類型</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <div align=\\"left\\">0為所有記錄，1為圖片鏈接，2為文字鏈接</div>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">分類ID</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <div align=\\"left\\">點擊<strong><a onclick=\\"window.open(\\\'../tool/LinkClass.php?[!--ehash--]\\\');\\">這裡</a></strong>查看分類ID，0為不限制</div>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示原鏈接</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <div align=\\"left\\">0為統計點擊鏈接，1為顯示原鏈接</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_GetSitelink', 'phomelink', 1, '[phomelink]每行顯示數,顯示總數,操作類型,分類id,是否顯示原鏈接[/phomelink]', 0, 3, 5);
INSERT INTO `phome_enewsbq` VALUES (15, '引用文件標籤', '<p>[includefile]\\\'文件地址\\\'[/includefile]<br />\r\n文件地址需要為相對地址,並且從後台目錄算起：&quot;../../header.html&quot;（這個地址的header.html是放在ecms根目錄）</p>', 'sys_IncludeFile', 'includefile', 1, '[includefile]\\\'文件地址\\\'[/includefile]', 1, 4, 4);
INSERT INTO `phome_enewsbq` VALUES (16, '讀取遠程頁面', '<p>[readhttp]\\\'頁面地址\\\'[/readhttp]</p>', 'sys_ReadFile', 'readhttp', 1, '[readhttp]\\\'頁面地址\\\'[/readhttp]', 1, 4, 4);
INSERT INTO `phome_enewsbq` VALUES (17, '網站信息統計', '<p>操作類型說明：\r\n<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\">\r\n    <tbody>\r\n        <tr bgcolor=\\"#dbeaf5\\">\r\n            <td width=\\"25%\\">\r\n            <div align=\\"center\\">操作類型</div>\r\n            </td>\r\n            <td width=\\"75%\\">內容</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">0</div>\r\n            </td>\r\n            <td>統計欄目數據</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">1</div>\r\n            </td>\r\n            <td>統計標題分類</td>\r\n        </tr>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">2</div>\r\n            </td>\r\n            <td>統計數據表</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<br />\r\n時間範圍：0為不限；1為今日；2為本月；3為本年。<br />\r\n統計類型：0為統計信息數；1為統計評論數；2為統計點擊數；3為統計下載數。<br />\r\n如果操作類型是&ldquo;統計數據表&rdquo;，欄目ID=\\\'數據表名\\\'</p>', 'sys_TotalData', 'totaldata', 1, '[totaldata]欄目ID,操作類型,時間範圍,統計類型[/totaldata]', 0, 1, 7);
INSERT INTO `phome_enewsbq` VALUES (18, 'FLASH幻燈信息調用', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">\r\n            <div align=\\"center\\">欄目ID</div>\r\n            </div>\r\n            </td>\r\n            <td height=\\"25\\">查看欄目ID點<a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>，查看標題分類ID點<a onclick=\\"window.open(\\\'../info/InfoType.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>,當前ID=\\\'selfinfo\\\'<br />\r\n            多個欄目ID與標題分類ID可用,號格開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示總數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示信息總數</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">圖片寬度，圖片高度</div>\r\n            </td>\r\n            <td height=\\"25\\">圖文信息圖片大小</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示標題</div>\r\n            </td>\r\n            <td height=\\"25\\">是否在圖片下顯示標題，0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td bgcolor=\\"#ffffff\\" height=\\"25\\">\r\n            <div align=\\"center\\">標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td bgcolor=\\"#ffffff\\" height=\\"25\\">\r\n            <div align=\\"center\\">操作類型說明</div>\r\n            </td>\r\n            <td height=\\"25\\">具體看操作類型說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">附加SQL條件</div>\r\n            </td>\r\n            <td height=\\"25\\">附加調用條件，如：&quot;title=\\\'帝國\\\'&quot;</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示排序</div>\r\n            </td>\r\n            <td height=\\"25\\">可指定按相應的字段排序，如：&quot;id desc&quot;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_FlashPixpic', 'phomeflashpic', 1, '[phomeflashpic]欄目ID,顯示總數,圖片寬度,圖片高度,是否顯示標題,標題截取數,操作類型,停頓秒數,附加SQL條件,顯示排序[/phomeflashpic]', 0, 1, 9);
INSERT INTO `phome_enewsbq` VALUES (19, '搜索關鍵字調用標籤', '<p>欄目id為0，則顯示所有欄目的關鍵字</p>\r\n<p>操作類型：0為搜索熱門排行，1為最新搜索排行</p>', 'sys_ShowSearchKey', 'showsearch', 1, '[showsearch]每行顯示條數,總條數,欄目id,操作類型[/showsearch]', 0, 1, 7);
INSERT INTO `phome_enewsbq` VALUES (20, '循環子欄目數據標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看欄目ID點<a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a>，單個為父欄目ID，多欄目可用&quot;,&quot;格開<br />\r\n            當前欄目ID用：\\\'selfinfo\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示條數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示前幾條記錄</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示欄目名</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">操作類型</div>\r\n            </td>\r\n            <td height=\\"25\\">0：欄目最新<br />\r\n            1：欄目熱門<br />\r\n            2：欄目推薦<br />\r\n            3：欄目評論排行<br />\r\n            4：欄目頭條<br />\r\n            5：欄目下載排行</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">只顯示有標題圖片</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不限制，1為只顯示有標題圖片的信息</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示欄目數</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不限制</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示頭條操作類型</div>\r\n            </td>\r\n            <td height=\\"25\\">0：不顯示欄目頭條<br />\r\n            1：欄目內容簡介<br />\r\n            2：欄目推薦信息<br />\r\n            3：欄目頭條信息<br />\r\n            4：欄目最新信息</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">頭條標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">頭條簡介截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">頭條只顯示有標題圖片</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不限制，1為只顯示有標題圖片的信息</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">附加SQL條件</div>\r\n            </td>\r\n            <td height=\\"25\\">附加調用條件，如：&quot;title=\\\'帝國\\\'&quot;</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示排序</div>\r\n            </td>\r\n            <td height=\\"25\\">可指定按相應的字段排序，如：&quot;id desc&quot;</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">頭條的模板變量<br />\r\n            (標籤模板的頁面模板內容中使用)</div>\r\n            </td>\r\n            <td height=\\"25\\">[!--sonclass.id--]：信息ID<br />\r\n            [!--sonclass.title--]：信息標題<br />\r\n            [!--sonclass.oldtitle--]：信息標題(不截取字數)<br />\r\n            [!--sonclass.titlepic--]：標題圖片<br />\r\n            [!--sonclass.titleurl--]：信息鏈接<br />\r\n            [!--sonclass.text--]：信息簡介</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_ForSonclassData', 'listsonclass', 1, '[listsonclass]欄目ID,顯示條數,標題截取數,是否顯示欄目名,操作類型,模板ID,只顯示有標題圖片,顯示欄目數,顯示頭條操作類型,頭條標題截取數,頭條簡介截取數,頭條只顯示有標題圖片,附加SQL條件,顯示排序[/listsonclass]', 0, 1, 9);
INSERT INTO `phome_enewsbq` VALUES (21, '帶模板的欄目導航標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">父欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看欄目ID點<a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a><br />\r\n            \\\'0\\\'為顯示所有一級欄目<br />\r\n            \\\'selfinfo\\\'顯示本欄目下級欄目</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </div>\r\n            </td>\r\n            <td height=\\"25\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">&nbsp;</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <p>模板標籤變量說明：[!--bclassname--]：父欄目名,[!--bclassurl--]：父欄目鏈接,[!--bclassid--]：父欄目id</p>\r\n            <p>list.var模板標籤：<br />\r\n            [!--classurl--]：欄目鏈接,[!--classname--]：欄目名稱,[!--classid--]：欄目id,[!--classimg--]：欄目圖片,[!--intro--]：欄目簡介,[!--num--]：信息數,[!--no--]：序號</p>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示欄目信息數</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示欄目數</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不限制</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_ShowClassByTemp', 'showclasstemp', 1, '[showclasstemp]父欄目ID,標籤模板ID,是否顯示欄目信息數,顯示欄目數[/showclasstemp]', 0, 2, 6);
INSERT INTO `phome_enewsbq` VALUES (24, '圖庫模型分頁標籤', '<p>\r\n<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </div>\r\n            </td>\r\n            <td height=\\"25\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">&nbsp;</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <p><strong>模板標籤變量說明：</strong><br />\r\n            圖片集JS數組：[!--photor--]，縮略圖導航：[!--smalldh--]<br />\r\n            分頁導航：[!--select--]，標題分頁導航：[!--titleselect--]，分頁列表式導航：[!--listpage--]</p>\r\n            <p><strong>list.var模板標籤：</strong><br />\r\n            圖片名稱：[!--picname--]，圖片地址：[!--picurl--]</p>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">導航圖片寬度<br />\r\n            導航圖片高度</div>\r\n            </td>\r\n            <td height=\\"25\\">0為按原圖大小</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n</p>', 'sys_PhotoMorepage', 'eshowphoto', 1, '[eshowphoto]標籤模板ID,導航圖片寬度,導航圖片高度[/eshowphoto]', 0, 1, 7);
INSERT INTO `phome_enewsbq` VALUES (25, '復選項輸出函數', '<p>如：[echocheckbox]\\\'title\\\',\\\'&lt;br&gt;\\\'[/echocheckbox]：表示按回車分隔輸出title字段的項</p>', 'sys_EchoCheckboxFValue', 'echocheckbox', 1, '[echocheckbox]\\\'字段\\\',\\\'分隔符\\\'[/echocheckbox]', 0, 3, 5);
INSERT INTO `phome_enewsbq` VALUES (26, '相關鏈接標籤', '<p><strong>標籤模板ID</strong>：查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a><br />\r\n<strong>操作類型</strong>：0為默認；1為按表；2為按欄目；3為按標題分類<br />\r\n<strong>操作對像</strong>：對應操作類型的表/欄目/標題分類。空則為默認。<br />\r\n<strong>是否顯示欄目名</strong>：0為不顯示；1為顯示<br />\r\n<strong>只顯示標題圖片的信息</strong>：0為不限；1為只顯示標題圖片的信息</p>', 'sys_GetOtherLinkInfo', 'otherlink', 1, '[otherlink]標籤模板ID,操作對像,調用條數,標題截取字數,是否顯示欄目名,操作類型,只顯示標題圖片的信息[/otherlink]', 0, 1, 9);
INSERT INTO `phome_enewsbq` VALUES (27, '評論調用標籤', '<p><strong>標籤模板ID</strong>：查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a><br />\r\n<strong>欄目ID</strong>：0為不限調用欄目，父欄目會應用於子欄目<br />\r\n<strong>信息ID</strong>：0為不限<br />\r\n<strong>顯示推薦評論</strong>：0為不限；1為只顯示推薦評論<br />\r\n<strong>操作類型</strong>：0為按發佈時間；1為按支持數；2為按反對數<br />\r\n<strong>標籤模板說明</strong>：[!--title--]:信息標題；[!--titleurl--]:信息鏈接；[!--titlepic--]:信息標題圖片；[!--id--]:信息ID<br />\r\n[!--classid--]:欄目ID；[!--plid--]:評論ID；[!--username--]:發表者；[!--no--]:編號<br />\r\n[!--pltext--]:評論內容；[!--pltime--]:評論時間；[!--zcnum--]:支持數；[!--fdnum--]:反對數</p>', 'sys_ShowPlInfo', 'showplinfo', 1, '[showplinfo]調用條數,標籤模板ID,欄目ID,信息ID,顯示推薦評論,操作類型[/showplinfo]', 0, 3, 5);
INSERT INTO `phome_enewsbq` VALUES (28, '循環欄目導航標籤', '<p>\r\n<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">父欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看欄目ID點<a onclick=\\"window.open(\\\'../ListClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a><br />\r\n            \\\'0\\\'為顯示所有一級欄目<br />\r\n            \\\'selfinfo\\\'顯示本欄目下級欄目<br />\r\n            多欄目固定調用可用&quot;,&quot;格開</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </div>\r\n            </td>\r\n            <td height=\\"25\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">&nbsp;</div>\r\n            </td>\r\n            <td height=\\"25\\">\r\n            <p>模板標籤變量說明：[!--bclassname--]：父欄目名,[!--bclassurl--]：父欄目鏈接,[!--bclassid--]：父欄目id，[!--bclassimg--]：父欄目圖片,[!--bintro--]：父欄目簡介,[!--bnum--]：父欄目信息數,[!--bno--]：父欄目序號</p>\r\n            <p>list.var模板標籤：<br />\r\n            [!--classurl--]：欄目鏈接,[!--classname--]：欄目名稱,[!--classid--]：欄目id,[!--classimg--]：欄目圖片,[!--intro--]：欄目簡介,[!--num--]：信息數,[!--no--]：序號</p>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示欄目信息數</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不顯示，1為顯示</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示欄目數</div>\r\n            </td>\r\n            <td height=\\"25\\">0為不限制</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n</p>', 'sys_ForShowSonClass', 'listshowclass', 1, '[listshowclass]父欄目ID,標籤模板ID,是否顯示欄目信息數,顯示欄目數[/listshowclass]', 0, 2, 6);
INSERT INTO `phome_enewsbq` VALUES (29, '調用TAGS的信息標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">TAGS的ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看TAGS的ID點<a onclick=\\"window.open(\\\'../tags/ListTags.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a><br />\r\n            多個ID可以用,號格開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示條數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示前幾條記錄</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標籤模板ID</div>\r\n            </td>\r\n            <td height=\\"25\\">查看標籤模板ID點<a onclick=\\"window.open(\\\'ListBqtemp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">欄目ID</div>\r\n            </td>\r\n            <td height=\\"25\\">限制只調用某一個或多個欄目的信息<br />\r\n            多個ID可以用,號格開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">系統模型ID</div>\r\n            </td>\r\n            <td height=\\"25\\">限制只調用某一個或多個系統模型的信息<br />\r\n            多個ID可以用,號格開，如\\\'1,2\\\'</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_eShowTagsInfo', 'tagsinfo', 0, '[tagsinfo]TAGS的ID,顯示條數,標題截取數,標籤模板ID,欄目ID,系統模型ID[/tagsinfo]', 0, 0, 9);
INSERT INTO `phome_enewsbq` VALUES (30, '調用碎片的信息標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">碎片變量名</div>\r\n            </td>\r\n            <td height=\\"25\\">查看碎片變量名點<a onclick=\\"window.open(\\\'../sp/ListSp.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a></td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示條數</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示前幾條記錄</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">標題截取數</div>\r\n            </td>\r\n            <td height=\\"25\\">截取幾個字符</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p><br />\r\n&nbsp;</p>\r\n<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td colspan=\\"2\\">\r\n            <div align=\\"center\\">碎片標籤模板變量說明</div>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\" width=\\"34%\\">\r\n            <div align=\\"center\\">靜態碎片</div>\r\n            </td>\r\n            <td height=\\"25\\" width=\\"66%\\">模板標籤變量說明：[!--the.spname--]：碎片名稱,[!--the.spid--]：碎片ID,[!--the.sppic--]：碎片效果圖,[!--the.spsay--]：碎片描述\r\n            <p>list.var模板標籤：<br />\r\n            [!--title--]：標題,[!--oldtitle--]：標題ALT,[!--newstime--]：發佈時間,[!--id--]：碎片信息ID,[!--titleurl--]：標題鏈接,[!--titlepic--]：標題縮圖,[!--bigpic--]：標題大圖,[!--titlepre--]：標題左邊,[!--titlenext--]：標題右邊,[!--smalltext--]：內容簡介,[!--no.num--]：編號</p>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">動態碎片</div>\r\n            </td>\r\n            <td height=\\"25\\">模板標籤變量說明：[!--the.spname--]：碎片名稱,[!--the.spid--]：碎片ID,[!--the.sppic--]：碎片效果圖,[!--the.spsay--]：碎片描述\r\n            <p>list.var模板標籤：<br />\r\n            支持變量同模型信息調用</p>\r\n            </td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">代碼碎片</div>\r\n            </td>\r\n            <td height=\\"25\\">無需標籤模板，直接顯示代碼內容</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_eShowSpInfo', 'spinfo', 0, '[spinfo]碎片變量名,顯示條數,標題截取數[/spinfo]', 0, 0, 9);
INSERT INTO `phome_enewsbq` VALUES (31, '調用TAGS標籤', '<table border=\\"0\\" cellspacing=\\"1\\" cellpadding=\\"3\\" width=\\"100%\\" bgcolor=\\"#dbeaf5\\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <div align=\\"center\\">參數</div>\r\n            </td>\r\n            <td>參數說明</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">分類ID</div>\r\n            </td>\r\n            <td height=\\"25\\">\\\'\\\'空為不限制，查看TAGS分類ID點<a onclick=\\"window.open(\\\'../tags/TagsClass.php?[!--ehash--]\\\');\\"><strong><u>這裡</u></strong></a><br />\r\n            多個可以用,號格開，如\\\'1,2\\\'<br />\r\n            內容頁顯示當前TAGS可以用\\\'selfinfo\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示數量</div>\r\n            </td>\r\n            <td height=\\"25\\">顯示前幾條記錄，0為顯示所有（\\\'selfinfo\\\'本設置無效）</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">每行顯示數量</div>\r\n            </td>\r\n            <td height=\\"25\\">一行顯示多少個TAGS，0為不換行</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示排序</div>\r\n            </td>\r\n            <td height=\\"25\\">使用默認設置\\\'\\\'空就可以，默認是\\\'tagid desc\\\'（\\\'selfinfo\\\'本設置無效）</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">只顯示推薦</div>\r\n            </td>\r\n            <td height=\\"25\\">只顯示推薦的TAGS，0為不限制，1為限制（\\\'selfinfo\\\'本設置無效）</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">推薦TAGS屬性</div>\r\n            </td>\r\n            <td height=\\"25\\">如果是推薦的TAGS，內容是否要加粗或加紅（\\\'selfinfo\\\'本設置無效）<br />\r\n            設置\\\'s\\\'表示加粗、\\\'r\\\'表示加紅、同時加粗加紅用\\\'s,r\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">顯示間隔符</div>\r\n            </td>\r\n            <td height=\\"25\\">TAGS之間顯示間隔符，默認是\\\' &amp;nbsp; \\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">是否顯示信息數量</div>\r\n            </td>\r\n            <td height=\\"25\\">是否在TAGS後顯示信息數量，0為不顯示，1為顯示（\\\'selfinfo\\\'本設置無效）</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">鏈接附加參數</div>\r\n            </td>\r\n            <td height=\\"25\\">可指定在TAGS鏈接後面增加參數，比如：\\\'&amp;tempid=模板ID\\\'</td>\r\n        </tr>\r\n        <tr bgcolor=\\"#ffffff\\">\r\n            <td height=\\"25\\">\r\n            <div align=\\"center\\">鏈接變量名</div>\r\n            </td>\r\n            <td height=\\"25\\">可指定在鏈接使用的變量名(需加引號)：tagname或tagid，默認為tagname，比如：\\\'tagname\\\'</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 'sys_eShowTags', 'showtags', 0, '[showtags]分類ID,顯示數量,每行顯示數量,顯示排序,只顯示推薦,推薦TAGS屬性,顯示間隔符,是否顯示信息數,鏈接附加參數,鏈接變量名[/showtags]', 0, 0, 9);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsbqclass`;
CREATE TABLE `phome_enewsbqclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` char(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsbqclass` VALUES (1, '信息調用');
INSERT INTO `phome_enewsbqclass` VALUES (2, '欄目調用');
INSERT INTO `phome_enewsbqclass` VALUES (3, '非信息調用');
INSERT INTO `phome_enewsbqclass` VALUES (4, '其它標籤');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsbuybak`;
CREATE TABLE `phome_enewsbuybak` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` char(20) NOT NULL default '',
  `card_no` char(120) NOT NULL default '',
  `buytime` datetime NOT NULL default '0000-00-00 00:00:00',
  `cardfen` int(10) unsigned NOT NULL default '0',
  `money` int(10) unsigned NOT NULL default '0',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `userdate` int(10) unsigned NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `type` (`type`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsbuygroup`;
CREATE TABLE `phome_enewsbuygroup` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `gname` varchar(255) NOT NULL default '',
  `gmoney` int(10) unsigned NOT NULL default '0',
  `gfen` int(10) unsigned NOT NULL default '0',
  `gdate` int(10) unsigned NOT NULL default '0',
  `ggroupid` smallint(5) unsigned NOT NULL default '0',
  `gzgroupid` smallint(5) unsigned NOT NULL default '0',
  `buygroupid` smallint(5) unsigned NOT NULL default '0',
  `gsay` text NOT NULL,
  `myorder` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewscard`;
CREATE TABLE `phome_enewscard` (
  `cardid` int(10) unsigned NOT NULL auto_increment,
  `card_no` char(30) NOT NULL default '',
  `password` char(20) NOT NULL default '',
  `money` int(10) unsigned NOT NULL default '0',
  `cardfen` int(10) unsigned NOT NULL default '0',
  `endtime` date NOT NULL default '0000-00-00',
  `cardtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `carddate` int(10) unsigned NOT NULL default '0',
  `cdgroupid` smallint(5) unsigned NOT NULL default '0',
  `cdzgroupid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cardid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsclass`;
CREATE TABLE `phome_enewsclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `bclassid` smallint(5) unsigned NOT NULL default '0',
  `classname` varchar(50) NOT NULL default '',
  `sonclass` text NOT NULL,
  `is_zt` tinyint(1) NOT NULL default '0',
  `lencord` smallint(6) NOT NULL default '0',
  `link_num` tinyint(4) NOT NULL default '0',
  `newstempid` smallint(6) NOT NULL default '0',
  `onclick` int(11) NOT NULL default '0',
  `listtempid` smallint(6) NOT NULL default '0',
  `featherclass` text NOT NULL,
  `islast` tinyint(1) NOT NULL default '0',
  `classpath` text NOT NULL,
  `classtype` varchar(10) NOT NULL default '',
  `newspath` varchar(20) NOT NULL default '',
  `filename` tinyint(1) NOT NULL default '0',
  `filetype` varchar(10) NOT NULL default '',
  `openpl` tinyint(1) NOT NULL default '0',
  `openadd` tinyint(1) NOT NULL default '0',
  `newline` int(11) NOT NULL default '0',
  `hotline` int(11) NOT NULL default '0',
  `goodline` int(11) NOT NULL default '0',
  `classurl` varchar(200) NOT NULL default '',
  `groupid` smallint(6) NOT NULL default '0',
  `myorder` smallint(6) NOT NULL default '0',
  `filename_qz` varchar(20) NOT NULL default '',
  `hotplline` tinyint(4) NOT NULL default '0',
  `modid` smallint(6) NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `firstline` tinyint(4) NOT NULL default '0',
  `bname` varchar(50) NOT NULL default '',
  `islist` tinyint(1) NOT NULL default '0',
  `searchtempid` smallint(6) NOT NULL default '0',
  `tid` smallint(6) NOT NULL default '0',
  `tbname` varchar(60) NOT NULL default '',
  `maxnum` int(11) NOT NULL default '0',
  `checkpl` tinyint(1) NOT NULL default '0',
  `down_num` tinyint(4) NOT NULL default '0',
  `online_num` tinyint(4) NOT NULL default '0',
  `listorder` varchar(50) NOT NULL default '',
  `reorder` varchar(50) NOT NULL default '',
  `intro` text NOT NULL,
  `classimg` varchar(255) NOT NULL default '',
  `jstempid` smallint(6) NOT NULL default '0',
  `addinfofen` int(11) NOT NULL default '0',
  `listdt` tinyint(1) NOT NULL default '0',
  `showclass` tinyint(1) NOT NULL default '0',
  `showdt` tinyint(1) NOT NULL default '0',
  `checkqadd` tinyint(1) NOT NULL default '0',
  `qaddlist` tinyint(1) NOT NULL default '0',
  `qaddgroupid` text NOT NULL,
  `qaddshowkey` tinyint(1) NOT NULL default '0',
  `adminqinfo` tinyint(1) NOT NULL default '0',
  `doctime` smallint(6) NOT NULL default '0',
  `classpagekey` varchar(255) NOT NULL default '',
  `dtlisttempid` smallint(6) NOT NULL default '0',
  `classtempid` smallint(6) NOT NULL default '0',
  `nreclass` tinyint(1) NOT NULL default '0',
  `nreinfo` tinyint(1) NOT NULL default '0',
  `nrejs` tinyint(1) NOT NULL default '0',
  `nottobq` tinyint(1) NOT NULL default '0',
  `ipath` varchar(255) NOT NULL default '',
  `addreinfo` tinyint(1) NOT NULL default '0',
  `haddlist` tinyint(4) NOT NULL default '0',
  `sametitle` tinyint(1) NOT NULL default '0',
  `definfovoteid` smallint(6) NOT NULL default '0',
  `wburl` varchar(255) NOT NULL default '',
  `qeditchecked` tinyint(1) NOT NULL default '0',
  `wapstyleid` smallint(6) NOT NULL default '0',
  `repreinfo` tinyint(1) NOT NULL default '0',
  `pltempid` smallint(6) NOT NULL default '0',
  `cgroupid` text NOT NULL,
  `yhid` smallint(6) NOT NULL default '0',
  `wfid` smallint(6) NOT NULL default '0',
  `cgtoinfo` tinyint(1) NOT NULL default '0',
  `bdinfoid` varchar(25) NOT NULL default '',
  `repagenum` smallint(5) unsigned NOT NULL default '0',
  `keycid` smallint(6) NOT NULL default '0',
  `allinfos` int(10) unsigned NOT NULL default '0',
  `infos` int(10) unsigned NOT NULL default '0',
  `addtime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`classid`),
  KEY `bclassid` (`bclassid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsclass_stats`;
CREATE TABLE `phome_enewsclass_stats` (
  `classid` smallint(5) unsigned NOT NULL default '0',
  `uptime` int(10) unsigned NOT NULL default '0',
  `pvall` int(10) unsigned NOT NULL default '0',
  `pvyear` int(10) unsigned NOT NULL default '0',
  `pvhalfyear` int(10) unsigned NOT NULL default '0',
  `pvquarter` int(10) unsigned NOT NULL default '0',
  `pvmonth` int(10) unsigned NOT NULL default '0',
  `pvweek` int(10) unsigned NOT NULL default '0',
  `pvday` int(10) unsigned NOT NULL default '0',
  `pvyesterday` int(10) unsigned NOT NULL default '0',
  `ipall` int(10) unsigned NOT NULL default '0',
  `ipyear` int(10) unsigned NOT NULL default '0',
  `iphalfyear` int(10) unsigned NOT NULL default '0',
  `ipquarter` int(10) unsigned NOT NULL default '0',
  `ipmonth` int(10) unsigned NOT NULL default '0',
  `ipweek` int(10) unsigned NOT NULL default '0',
  `ipday` int(10) unsigned NOT NULL default '0',
  `ipyesterday` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsclass_stats_ip`;
CREATE TABLE `phome_enewsclass_stats_ip` (
  `ip` char(21) NOT NULL default '',
  PRIMARY KEY  (`ip`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsclass_stats_set`;
CREATE TABLE `phome_enewsclass_stats_set` (
  `openstats` tinyint(1) NOT NULL default '0',
  `pvtime` int(10) unsigned NOT NULL default '0',
  `statsdate` int(10) unsigned NOT NULL default '0',
  `changedate` int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `phome_enewsclass_stats_set` VALUES (1, 3600, 0, 20130717);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsclassadd`;
CREATE TABLE `phome_enewsclassadd` (
  `classid` smallint(5) unsigned NOT NULL default '0',
  `classtext` mediumtext NOT NULL,
  `ttids` text NOT NULL,
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsclassf`;
CREATE TABLE `phome_enewsclassf` (
  `fid` smallint(5) unsigned NOT NULL auto_increment,
  `f` varchar(30) NOT NULL default '',
  `fname` varchar(30) NOT NULL default '',
  `fform` varchar(20) NOT NULL default '',
  `fhtml` mediumtext NOT NULL,
  `fzs` varchar(255) NOT NULL default '',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `ftype` varchar(30) NOT NULL default '',
  `flen` varchar(20) NOT NULL default '',
  `fvalue` text NOT NULL,
  `fformsize` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`fid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsclassnavcache`;
CREATE TABLE `phome_enewsclassnavcache` (
  `navtype` char(16) NOT NULL default '',
  `userid` int(10) unsigned NOT NULL default '0',
  `modid` smallint(5) unsigned NOT NULL default '0',
  KEY `navtype` (`navtype`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsdiggips`;
CREATE TABLE `phome_enewsdiggips` (
  `classid` smallint(5) unsigned NOT NULL default '0',
  `id` int(11) NOT NULL default '0',
  `ips` mediumtext NOT NULL,
  KEY `classid` (`classid`,`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsdo`;
CREATE TABLE `phome_enewsdo` (
  `doid` smallint(5) unsigned NOT NULL auto_increment,
  `doname` varchar(60) NOT NULL default '',
  `dotime` smallint(6) NOT NULL default '0',
  `isopen` tinyint(1) NOT NULL default '0',
  `doing` tinyint(4) NOT NULL default '0',
  `classid` text NOT NULL,
  `lasttime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`doid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsdo` VALUES (1, '自動刷新首頁', 12, 0, 0, ',', 1273215883);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsdolog`;
CREATE TABLE `phome_enewsdolog` (
  `logid` bigint(20) NOT NULL auto_increment,
  `logip` varchar(20) NOT NULL default '',
  `logtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `username` varchar(30) NOT NULL default '',
  `enews` varchar(30) NOT NULL default '',
  `doing` varchar(255) NOT NULL default '',
  `pubid` bigint(16) unsigned NOT NULL default '0',
  `ipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`logid`),
  KEY `pubid` (`pubid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsdownerror`;
CREATE TABLE `phome_enewsdownerror` (
  `errorid` int(10) unsigned NOT NULL auto_increment,
  `id` int(10) unsigned NOT NULL default '0',
  `errortext` varchar(255) NOT NULL default '',
  `errortime` datetime NOT NULL default '0000-00-00 00:00:00',
  `errorip` varchar(20) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `cid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`errorid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsdownrecord`;
CREATE TABLE `phome_enewsdownrecord` (
  `id` int(11) NOT NULL default '0',
  `pathid` int(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `title` varchar(120) NOT NULL default '',
  `cardfen` int(11) NOT NULL default '0',
  `truetime` int(11) NOT NULL default '0',
  `classid` smallint(6) NOT NULL default '0',
  `online` tinyint(1) NOT NULL default '0',
  KEY `userid` (`userid`),
  KEY `truetime` (`truetime`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsdownurlqz`;
CREATE TABLE `phome_enewsdownurlqz` (
  `urlid` smallint(5) unsigned NOT NULL auto_increment,
  `urlname` varchar(30) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `downtype` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`urlid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewserrorclass`;
CREATE TABLE `phome_enewserrorclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsf`;
CREATE TABLE `phome_enewsf` (
  `fid` smallint(5) unsigned NOT NULL auto_increment,
  `f` varchar(30) NOT NULL default '',
  `fname` varchar(30) NOT NULL default '',
  `fform` varchar(20) NOT NULL default '',
  `fhtml` mediumtext NOT NULL,
  `fzs` varchar(255) NOT NULL default '',
  `isadd` tinyint(1) NOT NULL default '0',
  `isshow` tinyint(1) NOT NULL default '0',
  `iscj` tinyint(1) NOT NULL default '0',
  `cjhtml` mediumtext NOT NULL,
  `myorder` smallint(6) NOT NULL default '0',
  `ftype` varchar(30) NOT NULL default '',
  `flen` varchar(20) NOT NULL default '',
  `dotemp` tinyint(1) NOT NULL default '0',
  `tid` smallint(6) NOT NULL default '0',
  `tbname` varchar(60) NOT NULL default '',
  `savetxt` tinyint(1) NOT NULL default '0',
  `fvalue` text NOT NULL,
  `iskey` tinyint(1) NOT NULL default '0',
  `tobr` tinyint(1) NOT NULL default '0',
  `dohtml` tinyint(1) NOT NULL default '0',
  `qfhtml` mediumtext NOT NULL,
  `isonly` tinyint(1) NOT NULL default '0',
  `linkfieldval` varchar(30) NOT NULL default '',
  `samedata` tinyint(1) NOT NULL default '0',
  `fformsize` varchar(12) NOT NULL default '',
  `tbdataf` tinyint(1) NOT NULL default '0',
  `ispage` tinyint(1) NOT NULL default '0',
  `adddofun` varchar(255) NOT NULL default '',
  `editdofun` varchar(255) NOT NULL default '',
  `qadddofun` varchar(255) NOT NULL default '',
  `qeditdofun` varchar(255) NOT NULL default '',
  `linkfieldtb` varchar(60) NOT NULL default '',
  `linkfieldshow` varchar(30) NOT NULL default '',
  `editorys` tinyint(1) NOT NULL default '0',
  `issmalltext` tinyint(1) NOT NULL default '0',
  `fmvnum` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`fid`),
  KEY `tid` (`tid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfava`;
CREATE TABLE `phome_enewsfava` (
  `favaid` bigint(20) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `favatime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` int(11) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `classid` smallint(6) NOT NULL default '0',
  `cid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`favaid`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfavaclass`;
CREATE TABLE `phome_enewsfavaclass` (
  `cid` int(11) NOT NULL auto_increment,
  `cname` varchar(30) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`cid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfeedback`;
CREATE TABLE `phome_enewsfeedback` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `bid` smallint(5) unsigned NOT NULL default '0',
  `title` varchar(120) NOT NULL default '',
  `saytext` text NOT NULL,
  `name` varchar(30) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `mycall` varchar(30) NOT NULL default '',
  `homepage` varchar(160) NOT NULL default '',
  `company` varchar(80) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `saytime` datetime NOT NULL default '0000-00-00 00:00:00',
  `job` varchar(36) NOT NULL default '',
  `ip` varchar(20) NOT NULL default '',
  `filepath` varchar(20) NOT NULL default '',
  `filename` text NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `haveread` tinyint(1) NOT NULL default '0',
  `eipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `bid` (`bid`),
  KEY `haveread` (`haveread`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfeedbackclass`;
CREATE TABLE `phome_enewsfeedbackclass` (
  `bid` smallint(5) unsigned NOT NULL auto_increment,
  `bname` varchar(60) NOT NULL default '',
  `btemp` mediumtext NOT NULL,
  `bzs` varchar(255) NOT NULL default '',
  `enter` text NOT NULL,
  `mustenter` text NOT NULL,
  `filef` varchar(255) NOT NULL default '',
  `groupid` smallint(6) NOT NULL default '0',
  `checkboxf` text NOT NULL,
  `usernames` text NOT NULL,
  PRIMARY KEY  (`bid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsfeedbackclass` VALUES (1, '默認反饋分類', '[!--cp.header--]\r\n<table width=100% align=center cellpadding=3 cellspacing=1 class=\\"tableborder\\">\r\n  <form name=\\\'feedback\\\' method=\\\'post\\\' enctype=\\\'multipart/form-data\\\' action=\\\'../../enews/index.php\\\'>\r\n    <input name=\\\'enews\\\' type=\\\'hidden\\\' value=\\\'AddFeedback\\\'>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">您的姓名:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'name\\\' type=\\\'text\\\' size=\\\'42\\\'>\r\n        (*)</td>\r\n    </tr>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">職務:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'job\\\' type=\\\'text\\\' size=\\\'42\\\'></td>\r\n    </tr>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">公司名稱:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'company\\\' type=\\\'text\\\' size=\\\'42\\\'></td>\r\n    </tr>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">聯繫郵箱:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'email\\\' type=\\\'text\\\' size=\\\'42\\\'></td>\r\n    </tr>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">聯繫電話:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'mycall\\\' type=\\\'text\\\' size=\\\'42\\\'>\r\n        (*)</td>\r\n    </tr>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">網站:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'homepage\\\' type=\\\'text\\\' size=\\\'42\\\'></td>\r\n    </tr>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">聯繫地址:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'address\\\' type=\\\'text\\\' size=\\"42\\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">信息標題:</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input name=\\\'title\\\' type=\\\'text\\\' size=\\"42\\"> (*)</td>\r\n    </tr>\r\n    <tr> \r\n      <td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'><div align=\\"right\\">信息內容(*):</div></td>\r\n      <td bgcolor=\\\'ffffff\\\'><textarea name=\\\'saytext\\\' cols=\\\'60\\\' rows=\\\'12\\\'></textarea> \r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td bgcolor=\\\'ffffff\\\'></td>\r\n      <td bgcolor=\\\'ffffff\\\'><input type=\\\'submit\\\' name=\\\'submit\\\' value=\\\'提交\\\'></td>\r\n    </tr>\r\n  </form>\r\n</table>\r\n[!--cp.footer--]', '', '您的姓名<!--field--->name<!--record-->職務<!--field--->job<!--record-->公司名稱<!--field--->company<!--record-->聯繫郵箱<!--field--->email<!--record-->聯繫電話<!--field--->mycall<!--record-->網站<!--field--->homepage<!--record-->聯繫地址<!--field--->address<!--record-->信息標題<!--field--->title<!--record-->信息內容<!--field--->saytext<!--record-->', ',name,mycall,title,saytext,', ',', 0, '', '');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfeedbackf`;
CREATE TABLE `phome_enewsfeedbackf` (
  `fid` smallint(5) unsigned NOT NULL auto_increment,
  `f` varchar(30) NOT NULL default '',
  `fname` varchar(30) NOT NULL default '',
  `fform` varchar(20) NOT NULL default '',
  `fzs` varchar(255) NOT NULL default '',
  `myorder` smallint(6) NOT NULL default '0',
  `ftype` varchar(30) NOT NULL default '',
  `flen` varchar(20) NOT NULL default '',
  `fformsize` varchar(12) NOT NULL default '',
  `fvalue` text NOT NULL,
  PRIMARY KEY  (`fid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsfeedbackf` VALUES (1, 'title', '標題', 'text', '', 7, 'VARCHAR', '120', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (2, 'saytext', '內容', 'textarea', '', 8, 'TEXT', '', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (3, 'name', '姓名', 'text', '', 0, 'VARCHAR', '30', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (4, 'email', '郵箱', 'text', '', 3, 'VARCHAR', '80', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (5, 'mycall', '電話', 'text', '', 4, 'VARCHAR', '30', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (6, 'homepage', '網站', 'text', '', 5, 'VARCHAR', '160', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (7, 'company', '公司名稱', 'text', '', 2, 'VARCHAR', '80', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (8, 'address', '聯繫地址', 'text', '', 6, 'VARCHAR', '255', '', '');
INSERT INTO `phome_enewsfeedbackf` VALUES (9, 'job', '職務', 'text', '', 1, 'VARCHAR', '36', '', '');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfile_1`;
CREATE TABLE `phome_enewsfile_1` (
  `fileid` int(10) unsigned NOT NULL auto_increment,
  `pubid` bigint(16) unsigned NOT NULL default '0',
  `filename` char(60) NOT NULL default '',
  `filesize` int(10) unsigned NOT NULL default '0',
  `path` char(20) NOT NULL default '',
  `adduser` char(30) NOT NULL default '',
  `filetime` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `no` char(60) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `onclick` mediumint(8) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `cjid` int(10) unsigned NOT NULL default '0',
  `fpath` tinyint(1) NOT NULL default '0',
  `modtype` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`fileid`),
  KEY `id` (`id`),
  KEY `type` (`type`),
  KEY `classid` (`classid`),
  KEY `pubid` (`pubid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfile_member`;
CREATE TABLE `phome_enewsfile_member` (
  `fileid` int(10) unsigned NOT NULL auto_increment,
  `pubid` tinyint(1) NOT NULL default '0',
  `filename` char(60) NOT NULL default '',
  `filesize` int(10) unsigned NOT NULL default '0',
  `path` char(20) NOT NULL default '',
  `adduser` char(30) NOT NULL default '',
  `filetime` int(10) unsigned NOT NULL default '0',
  `classid` tinyint(1) NOT NULL default '0',
  `no` char(60) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `onclick` mediumint(8) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `cjid` int(10) unsigned NOT NULL default '0',
  `fpath` tinyint(1) NOT NULL default '0',
  `modtype` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`fileid`),
  KEY `id` (`id`),
  KEY `type` (`type`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfile_other`;
CREATE TABLE `phome_enewsfile_other` (
  `fileid` int(10) unsigned NOT NULL auto_increment,
  `pubid` tinyint(1) NOT NULL default '0',
  `filename` char(60) NOT NULL default '',
  `filesize` int(10) unsigned NOT NULL default '0',
  `path` char(20) NOT NULL default '',
  `adduser` char(30) NOT NULL default '',
  `filetime` int(10) unsigned NOT NULL default '0',
  `classid` tinyint(1) NOT NULL default '0',
  `no` char(60) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `onclick` mediumint(8) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `cjid` int(10) unsigned NOT NULL default '0',
  `fpath` tinyint(1) NOT NULL default '0',
  `modtype` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`fileid`),
  KEY `id` (`id`),
  KEY `type` (`type`),
  KEY `modtype` (`modtype`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsfile_public`;
CREATE TABLE `phome_enewsfile_public` (
  `fileid` int(10) unsigned NOT NULL auto_increment,
  `pubid` tinyint(1) NOT NULL default '0',
  `filename` char(60) NOT NULL default '',
  `filesize` int(10) unsigned NOT NULL default '0',
  `path` char(20) NOT NULL default '',
  `adduser` char(30) NOT NULL default '',
  `filetime` int(10) unsigned NOT NULL default '0',
  `classid` tinyint(1) NOT NULL default '0',
  `no` char(60) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `onclick` mediumint(8) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `cjid` int(10) unsigned NOT NULL default '0',
  `fpath` tinyint(1) NOT NULL default '0',
  `modtype` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`fileid`),
  KEY `id` (`id`),
  KEY `type` (`type`),
  KEY `modtype` (`modtype`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsgbook`;
CREATE TABLE `phome_enewsgbook` (
  `lyid` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `mycall` varchar(30) NOT NULL default '',
  `lytime` datetime NOT NULL default '0000-00-00 00:00:00',
  `lytext` text NOT NULL,
  `retext` text NOT NULL,
  `bid` smallint(5) unsigned NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `eipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`lyid`),
  KEY `bid` (`bid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsgbookclass`;
CREATE TABLE `phome_enewsgbookclass` (
  `bid` smallint(5) unsigned NOT NULL auto_increment,
  `bname` varchar(60) NOT NULL default '',
  `checked` tinyint(1) NOT NULL default '0',
  `groupid` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`bid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsgbookclass` VALUES (1, '默認留言分類', 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsgfenip`;
CREATE TABLE `phome_enewsgfenip` (
  `ip` varchar(20) NOT NULL default '',
  `addtime` int(11) NOT NULL default '0',
  UNIQUE KEY `ip` (`ip`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsgroup`;
CREATE TABLE `phome_enewsgroup` (
  `groupid` smallint(6) NOT NULL auto_increment,
  `groupname` varchar(50) NOT NULL default '',
  `dopublic` tinyint(1) NOT NULL default '0',
  `doclass` tinyint(1) NOT NULL default '0',
  `dotemplate` tinyint(1) NOT NULL default '0',
  `dopicnews` tinyint(1) NOT NULL default '0',
  `dofile` tinyint(1) NOT NULL default '0',
  `douser` tinyint(1) NOT NULL default '0',
  `dolog` tinyint(1) NOT NULL default '0',
  `domember` tinyint(1) NOT NULL default '0',
  `dobefrom` tinyint(1) NOT NULL default '0',
  `doword` tinyint(1) NOT NULL default '0',
  `dokey` tinyint(1) NOT NULL default '0',
  `doad` tinyint(1) NOT NULL default '0',
  `dovote` tinyint(1) NOT NULL default '0',
  `dogroup` tinyint(1) NOT NULL default '0',
  `doall` tinyint(1) NOT NULL default '0',
  `docj` tinyint(1) NOT NULL default '0',
  `dobq` tinyint(1) NOT NULL default '0',
  `domovenews` tinyint(1) NOT NULL default '0',
  `dopostdata` tinyint(1) NOT NULL default '0',
  `dochangedata` tinyint(1) NOT NULL default '0',
  `dopl` tinyint(1) NOT NULL default '0',
  `dof` tinyint(1) NOT NULL default '0',
  `dom` tinyint(1) NOT NULL default '0',
  `dodo` tinyint(1) NOT NULL default '0',
  `dodbdata` tinyint(1) NOT NULL default '0',
  `dorepnewstext` tinyint(1) NOT NULL default '0',
  `dotempvar` tinyint(1) NOT NULL default '0',
  `dostats` tinyint(1) NOT NULL default '0',
  `dowriter` tinyint(1) NOT NULL default '0',
  `dototaldata` tinyint(1) NOT NULL default '0',
  `dosearchkey` tinyint(1) NOT NULL default '0',
  `dozt` tinyint(1) NOT NULL default '0',
  `docard` tinyint(1) NOT NULL default '0',
  `dolink` tinyint(1) NOT NULL default '0',
  `doselfinfo` tinyint(1) NOT NULL default '0',
  `doexecsql` tinyint(1) NOT NULL default '0',
  `dotable` tinyint(1) NOT NULL default '0',
  `dodownurl` tinyint(1) NOT NULL default '0',
  `dodeldownrecord` tinyint(1) NOT NULL default '0',
  `doshoppayfs` tinyint(1) NOT NULL default '0',
  `doshopps` tinyint(1) NOT NULL default '0',
  `doshopdd` tinyint(1) NOT NULL default '0',
  `dogbook` tinyint(1) NOT NULL default '0',
  `dofeedback` tinyint(1) NOT NULL default '0',
  `douserpage` tinyint(1) NOT NULL default '0',
  `donotcj` tinyint(1) NOT NULL default '0',
  `dodownerror` tinyint(1) NOT NULL default '0',
  `dodelinfodata` tinyint(1) NOT NULL default '0',
  `doaddinfo` tinyint(1) NOT NULL default '0',
  `doeditinfo` tinyint(1) NOT NULL default '0',
  `dodelinfo` tinyint(1) NOT NULL default '0',
  `doadminstyle` tinyint(1) NOT NULL default '0',
  `dorepdownpath` tinyint(1) NOT NULL default '0',
  `douserjs` tinyint(1) NOT NULL default '0',
  `douserlist` tinyint(1) NOT NULL default '0',
  `domsg` tinyint(1) NOT NULL default '0',
  `dosendemail` tinyint(1) NOT NULL default '0',
  `dosetmclass` tinyint(1) NOT NULL default '0',
  `doinfodoc` tinyint(1) NOT NULL default '0',
  `dotempgroup` tinyint(1) NOT NULL default '0',
  `dofeedbackf` tinyint(1) NOT NULL default '0',
  `dotask` tinyint(1) NOT NULL default '0',
  `domemberf` tinyint(1) NOT NULL default '0',
  `dospacestyle` tinyint(1) NOT NULL default '0',
  `dospacedata` tinyint(1) NOT NULL default '0',
  `dovotemod` tinyint(1) NOT NULL default '0',
  `doplayer` tinyint(1) NOT NULL default '0',
  `dowap` tinyint(1) NOT NULL default '0',
  `dopay` tinyint(1) NOT NULL default '0',
  `dobuygroup` tinyint(1) NOT NULL default '0',
  `dosearchall` tinyint(1) NOT NULL default '0',
  `doinfotype` tinyint(1) NOT NULL default '0',
  `doplf` tinyint(1) NOT NULL default '0',
  `dopltable` tinyint(1) NOT NULL default '0',
  `dochadminstyle` tinyint(1) NOT NULL default '0',
  `dotags` tinyint(1) NOT NULL default '0',
  `dosp` tinyint(1) NOT NULL default '0',
  `doyh` tinyint(1) NOT NULL default '0',
  `dofirewall` tinyint(1) NOT NULL default '0',
  `dosetsafe` tinyint(1) NOT NULL default '0',
  `douserclass` tinyint(1) NOT NULL default '0',
  `doworkflow` tinyint(1) NOT NULL default '0',
  `domenu` tinyint(1) NOT NULL default '0',
  `dopubvar` tinyint(1) NOT NULL default '0',
  `doclassf` tinyint(1) NOT NULL default '0',
  `doztf` tinyint(1) NOT NULL default '0',
  `dofiletable` tinyint(1) NOT NULL default '0',
  `docheckinfo` tinyint(1) NOT NULL default '0',
  `dogoodinfo` tinyint(1) NOT NULL default '0',
  `dodocinfo` tinyint(1) NOT NULL default '0',
  `domoveinfo` tinyint(1) NOT NULL default '0',
  `dodttemp` tinyint(1) NOT NULL default '0',
  `doloadcj` tinyint(1) NOT NULL default '0',
  `domustcheck` tinyint(1) NOT NULL default '0',
  `docheckedit` tinyint(1) NOT NULL default '0',
  `domemberconnect` tinyint(1) NOT NULL default '0',
  `doprecode` tinyint(1) NOT NULL default '0',
  `domoreport` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`groupid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsgroup` VALUES (1, '超級管理員', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewshmsg`;
CREATE TABLE `phome_enewshmsg` (
  `mid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(80) NOT NULL default '',
  `msgtext` text NOT NULL,
  `haveread` tinyint(1) NOT NULL default '0',
  `msgtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `to_username` varchar(30) NOT NULL default '',
  `from_userid` int(10) unsigned NOT NULL default '0',
  `from_username` varchar(30) NOT NULL default '',
  `isadmin` tinyint(1) NOT NULL default '0',
  `issys` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`mid`),
  KEY `to_username` (`to_username`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewshnotice`;
CREATE TABLE `phome_enewshnotice` (
  `mid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(80) NOT NULL default '',
  `msgtext` text NOT NULL,
  `haveread` tinyint(1) NOT NULL default '0',
  `msgtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `to_username` varchar(30) NOT NULL default '',
  `from_userid` int(10) unsigned NOT NULL default '0',
  `from_username` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`mid`),
  KEY `to_username` (`to_username`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewshy`;
CREATE TABLE `phome_enewshy` (
  `fid` bigint(20) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `fname` varchar(30) NOT NULL default '',
  `cid` int(11) NOT NULL default '0',
  `fsay` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`fid`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewshyclass`;
CREATE TABLE `phome_enewshyclass` (
  `cid` int(11) NOT NULL auto_increment,
  `cname` varchar(30) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`cid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsinfoclass`;
CREATE TABLE `phome_enewsinfoclass` (
  `classid` int(11) NOT NULL auto_increment,
  `bclassid` int(11) NOT NULL default '0',
  `classname` varchar(100) NOT NULL default '',
  `infourl` mediumtext NOT NULL,
  `newsclassid` smallint(6) NOT NULL default '0',
  `startday` date NOT NULL default '0000-00-00',
  `endday` date NOT NULL default '0000-00-00',
  `bz` text NOT NULL,
  `num` smallint(6) NOT NULL default '0',
  `copyimg` tinyint(1) NOT NULL default '0',
  `renum` smallint(6) NOT NULL default '0',
  `keyboard` text NOT NULL,
  `oldword` text NOT NULL,
  `newword` text NOT NULL,
  `titlelen` smallint(6) NOT NULL default '0',
  `retitlewriter` tinyint(1) NOT NULL default '0',
  `smalltextlen` smallint(6) NOT NULL default '0',
  `zz_smallurl` text NOT NULL,
  `zz_newsurl` text NOT NULL,
  `httpurl` varchar(255) NOT NULL default '',
  `repad` text NOT NULL,
  `imgurl` varchar(255) NOT NULL default '',
  `relistnum` smallint(6) NOT NULL default '0',
  `zz_titlepicl` text NOT NULL,
  `z_titlepicl` varchar(255) NOT NULL default '',
  `qz_titlepicl` varchar(255) NOT NULL default '',
  `save_titlepicl` varchar(10) NOT NULL default '',
  `keynum` tinyint(4) NOT NULL default '0',
  `insertnum` smallint(6) NOT NULL default '0',
  `copyflash` tinyint(1) NOT NULL default '0',
  `tid` smallint(6) NOT NULL default '0',
  `tbname` varchar(60) NOT NULL default '',
  `pagetype` tinyint(1) NOT NULL default '0',
  `smallpagezz` text NOT NULL,
  `pagezz` text NOT NULL,
  `smallpageallzz` text NOT NULL,
  `pageallzz` text NOT NULL,
  `mark` tinyint(1) NOT NULL default '0',
  `enpagecode` tinyint(1) NOT NULL default '0',
  `recjtheurl` tinyint(1) NOT NULL default '0',
  `hiddenload` tinyint(1) NOT NULL default '0',
  `justloadin` tinyint(1) NOT NULL default '0',
  `justloadcheck` tinyint(1) NOT NULL default '0',
  `delloadinfo` tinyint(1) NOT NULL default '0',
  `pagerepad` mediumtext NOT NULL,
  `newsztid` text NOT NULL,
  `getfirstpic` tinyint(4) NOT NULL default '0',
  `oldpagerep` text NOT NULL,
  `newpagerep` text NOT NULL,
  `keeptime` smallint(6) NOT NULL default '0',
  `lasttime` int(11) NOT NULL default '0',
  `newstextisnull` tinyint(1) NOT NULL default '0',
  `getfirstspic` tinyint(1) NOT NULL default '0',
  `getfirstspicw` smallint(6) NOT NULL default '0',
  `getfirstspich` smallint(6) NOT NULL default '0',
  `doaddtextpage` tinyint(1) NOT NULL default '0',
  `infourlispage` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`classid`),
  KEY `newsclassid` (`newsclassid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsinfotype`;
CREATE TABLE `phome_enewsinfotype` (
  `typeid` smallint(5) unsigned NOT NULL auto_increment,
  `tname` varchar(30) NOT NULL default '',
  `mid` smallint(6) NOT NULL default '0',
  `myorder` smallint(6) NOT NULL default '0',
  `yhid` smallint(6) NOT NULL default '0',
  `tnum` tinyint(3) unsigned NOT NULL default '0',
  `listtempid` smallint(5) unsigned NOT NULL default '0',
  `tpath` varchar(100) NOT NULL default '',
  `ttype` varchar(10) NOT NULL default '',
  `maxnum` int(10) unsigned NOT NULL default '0',
  `reorder` varchar(50) NOT NULL default '',
  `tid` smallint(5) unsigned NOT NULL default '0',
  `tbname` varchar(60) NOT NULL default '',
  `timg` varchar(200) NOT NULL default '',
  `intro` varchar(255) NOT NULL default '',
  `pagekey` varchar(255) NOT NULL default '',
  `newline` tinyint(3) unsigned NOT NULL default '0',
  `hotline` tinyint(3) unsigned NOT NULL default '0',
  `goodline` tinyint(3) unsigned NOT NULL default '0',
  `hotplline` tinyint(3) unsigned NOT NULL default '0',
  `firstline` tinyint(3) unsigned NOT NULL default '0',
  `jstempid` smallint(5) unsigned NOT NULL default '0',
  `nrejs` tinyint(1) NOT NULL default '0',
  `listdt` tinyint(1) NOT NULL default '0',
  `repagenum` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`typeid`),
  KEY `mid` (`mid`),
  KEY `myorder` (`myorder`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsinfovote`;
CREATE TABLE `phome_enewsinfovote` (
  `pubid` bigint(16) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `title` varchar(120) NOT NULL default '',
  `votenum` int(10) unsigned NOT NULL default '0',
  `voteip` mediumtext NOT NULL,
  `votetext` text NOT NULL,
  `voteclass` tinyint(1) NOT NULL default '0',
  `doip` tinyint(1) NOT NULL default '0',
  `dotime` date NOT NULL default '0000-00-00',
  `tempid` smallint(5) unsigned NOT NULL default '0',
  `width` int(10) unsigned NOT NULL default '0',
  `height` int(10) unsigned NOT NULL default '0',
  `diyotherlink` tinyint(1) NOT NULL default '0',
  `infouptime` int(10) unsigned NOT NULL default '0',
  `infodowntime` int(10) unsigned NOT NULL default '0',
  `copyids` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`pubid`),
  KEY `id` (`id`,`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewskey`;
CREATE TABLE `phome_enewskey` (
  `keyid` smallint(5) unsigned NOT NULL auto_increment,
  `keyname` char(50) NOT NULL default '',
  `keyurl` char(200) NOT NULL default '',
  `cid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`keyid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewskeyclass`;
CREATE TABLE `phome_enewskeyclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` char(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewslink`;
CREATE TABLE `phome_enewslink` (
  `lid` smallint(5) unsigned NOT NULL auto_increment,
  `lname` varchar(100) NOT NULL default '',
  `lpic` varchar(255) NOT NULL default '',
  `lurl` varchar(255) NOT NULL default '',
  `ltime` datetime NOT NULL default '0000-00-00 00:00:00',
  `onclick` int(11) NOT NULL default '0',
  `width` varchar(10) NOT NULL default '',
  `height` varchar(10) NOT NULL default '',
  `target` varchar(10) NOT NULL default '',
  `myorder` tinyint(4) NOT NULL default '0',
  `email` varchar(60) NOT NULL default '',
  `lsay` text NOT NULL,
  `checked` tinyint(1) NOT NULL default '0',
  `ltype` smallint(6) NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`lid`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewslinkclass`;
CREATE TABLE `phome_enewslinkclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewslinktmp`;
CREATE TABLE `phome_enewslinktmp` (
  `newsurl` varchar(255) NOT NULL default '',
  `checkrnd` varchar(50) NOT NULL default '',
  `linkid` bigint(20) NOT NULL auto_increment,
  `titlepic` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`linkid`),
  KEY `checkrnd` (`checkrnd`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewslog`;
CREATE TABLE `phome_enewslog` (
  `loginid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `logintime` datetime NOT NULL default '0000-00-00 00:00:00',
  `loginip` varchar(20) NOT NULL default '',
  `status` tinyint(1) NOT NULL default '0',
  `password` varchar(30) NOT NULL default '',
  `loginauth` tinyint(1) NOT NULL default '0',
  `ipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`loginid`),
  KEY `status` (`status`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsloginfail`;
CREATE TABLE `phome_enewsloginfail` (
  `ip` varchar(20) NOT NULL default '',
  `num` tinyint(4) NOT NULL default '0',
  `lasttime` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ip`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmember`;
CREATE TABLE `phome_enewsmember` (
  `userid` int(10) unsigned NOT NULL auto_increment,
  `username` char(20) NOT NULL default '',
  `password` char(32) NOT NULL default '',
  `rnd` char(20) NOT NULL default '',
  `email` char(50) NOT NULL default '',
  `registertime` int(10) unsigned NOT NULL default '0',
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `userfen` mediumint(8) unsigned NOT NULL default '0',
  `userdate` int(10) unsigned NOT NULL default '0',
  `money` float(11,2) NOT NULL default '0.00',
  `zgroupid` smallint(5) unsigned NOT NULL default '0',
  `havemsg` tinyint(1) NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `salt` char(8) NOT NULL default '',
  `userkey` char(12) NOT NULL default '',
  PRIMARY KEY  (`userid`),
  UNIQUE KEY `username` (`username`),
  KEY `groupid` (`groupid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmember_connect`;
CREATE TABLE `phome_enewsmember_connect` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `apptype` char(20) NOT NULL default '',
  `bindkey` char(32) NOT NULL default '',
  `bindtime` int(10) unsigned NOT NULL default '0',
  `loginnum` int(10) unsigned NOT NULL default '0',
  `lasttime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `bindkey` (`bindkey`),
  KEY `apptype` (`apptype`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmember_connect_app`;
CREATE TABLE `phome_enewsmember_connect_app` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `apptype` char(20) NOT NULL default '',
  `appname` char(30) NOT NULL default '',
  `appid` char(60) NOT NULL default '',
  `appkey` char(120) NOT NULL default '',
  `isclose` tinyint(1) NOT NULL default '0',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `qappname` char(30) NOT NULL default '',
  `appsay` char(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `apptype` (`apptype`),
  KEY `isclose` (`isclose`),
  KEY `myorder` (`myorder`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmemberadd`;
CREATE TABLE `phome_enewsmemberadd` (
  `userid` int(10) unsigned NOT NULL default '0',
  `truename` varchar(20) NOT NULL default '',
  `oicq` varchar(25) NOT NULL default '',
  `msn` varchar(120) NOT NULL default '',
  `mycall` varchar(30) NOT NULL default '',
  `phone` varchar(30) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `zip` varchar(8) NOT NULL default '',
  `spacestyleid` smallint(6) NOT NULL default '0',
  `homepage` varchar(200) NOT NULL default '',
  `saytext` text NOT NULL,
  `company` varchar(255) NOT NULL default '',
  `fax` varchar(30) NOT NULL default '',
  `userpic` varchar(200) NOT NULL default '',
  `spacename` varchar(255) NOT NULL default '',
  `spacegg` text NOT NULL,
  `viewstats` int(11) NOT NULL default '0',
  `regip` varchar(20) NOT NULL default '',
  `lasttime` int(10) unsigned NOT NULL default '0',
  `lastip` varchar(20) NOT NULL default '',
  `loginnum` int(10) unsigned NOT NULL default '0',
  `regipport` varchar(6) NOT NULL default '',
  `lastipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmemberf`;
CREATE TABLE `phome_enewsmemberf` (
  `fid` smallint(5) unsigned NOT NULL auto_increment,
  `f` varchar(30) NOT NULL default '',
  `fname` varchar(30) NOT NULL default '',
  `fform` varchar(20) NOT NULL default '',
  `fhtml` mediumtext NOT NULL,
  `fzs` varchar(255) NOT NULL default '',
  `myorder` smallint(6) NOT NULL default '0',
  `ftype` varchar(30) NOT NULL default '',
  `flen` varchar(20) NOT NULL default '',
  `fvalue` text NOT NULL,
  `fformsize` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`fid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsmemberf` VALUES (1, 'truename', '真實姓名', 'text', '\r\n<input name="truename" type="text" id="truename" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[truename]))?>">\r\n', '', 1, 'VARCHAR', '20', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (2, 'oicq', 'QQ號碼', 'text', '<input name=\\"oicq\\" type=\\"text\\" id=\\"oicq\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":htmlspecialchars(stripSlashes($addr[oicq]))?>\\">\r\n', '', 5, 'VARCHAR', '25', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (3, 'msn', 'MSN', 'text', '<input name=\\"msn\\" type=\\"text\\" id=\\"msn\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":htmlspecialchars(stripSlashes($addr[msn]))?>\\">\r\n', '', 6, 'VARCHAR', '120', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (4, 'mycall', '聯繫電話', 'text', '<input name=\\"mycall\\" type=\\"text\\" id=\\"mycall\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":htmlspecialchars(stripSlashes($addr[mycall]))?>\\">\r\n', '', 2, 'VARCHAR', '30', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (5, 'phone', '手機', 'text', '<input name=\\"phone\\" type=\\"text\\" id=\\"phone\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":htmlspecialchars(stripSlashes($addr[phone]))?>\\">\r\n', '', 4, 'VARCHAR', '30', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (6, 'address', '聯繫地址', 'text', '<input name=\\"address\\" type=\\"text\\" id=\\"address\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":htmlspecialchars(stripSlashes($addr[address]))?>\\" size=\\"50\\">\r\n', '', 9, 'VARCHAR', '255', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (7, 'zip', '郵編', 'text', '<input name=\\"zip\\" type=\\"text\\" id=\\"zip\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":htmlspecialchars(stripSlashes($addr[zip]))?>\\" size=\\"8\\">\r\n', '', 10, 'VARCHAR', '8', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (9, 'homepage', '網址', 'text', '\r\n<input name="homepage" type="text" id="homepage" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[homepage]))?>">\r\n', '', 7, 'VARCHAR', '200', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (10, 'saytext', '簡介', 'textarea', '<textarea name=\\"saytext\\" cols=\\"65\\" rows=\\"10\\" id=\\"saytext\\"><?=$ecmsfirstpost==1?\\"\\":stripSlashes($addr[saytext])?></textarea>\r\n', '', 11, 'TEXT', '', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (11, 'company', '公司名稱', 'text', '<input name=\\"company\\" type=\\"text\\" id=\\"company\\" value=\\"<?=$ecmsfirstpost==1?\\"\\":htmlspecialchars(stripSlashes($addr[company]))?>\\" size=\\"38\\">\r\n', '', 0, 'VARCHAR', '255', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (12, 'fax', '傳真', 'text', '\r\n<input name="fax" type="text" id="fax" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[fax]))?>">\r\n', '', 3, 'VARCHAR', '30', '', '');
INSERT INTO `phome_enewsmemberf` VALUES (13, 'userpic', '會員頭像', 'img', '<input type=\\"file\\" name=\\"userpicfile\\">&nbsp;&nbsp;\r\n<?=empty($addr[userpic])?\\"\\":\\"<img src=\\\'\\".htmlspecialchars(stripSlashes($addr[userpic])).\\"\\\' border=0>\\"?>', '', 8, 'VARCHAR', '200', '', '');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmemberfeedback`;
CREATE TABLE `phome_enewsmemberfeedback` (
  `fid` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(12) NOT NULL default '',
  `company` varchar(80) NOT NULL default '',
  `phone` varchar(30) NOT NULL default '',
  `fax` varchar(20) NOT NULL default '',
  `email` varchar(80) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `zip` varchar(8) NOT NULL default '',
  `title` varchar(120) NOT NULL default '',
  `ftext` text NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `uname` varchar(20) NOT NULL default '',
  `addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `eipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`fid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmemberform`;
CREATE TABLE `phome_enewsmemberform` (
  `fid` smallint(5) unsigned NOT NULL auto_increment,
  `fname` varchar(60) NOT NULL default '',
  `ftemp` mediumtext NOT NULL,
  `fzs` varchar(255) NOT NULL default '',
  `enter` text NOT NULL,
  `mustenter` text NOT NULL,
  `filef` varchar(255) NOT NULL default '',
  `imgf` varchar(255) NOT NULL default '0',
  `tobrf` text NOT NULL,
  `viewenter` text NOT NULL,
  `searchvar` varchar(255) NOT NULL default '',
  `canaddf` text NOT NULL,
  `caneditf` text NOT NULL,
  `checkboxf` text NOT NULL,
  PRIMARY KEY  (`fid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsmemberform` VALUES (1, '個人註冊表單', '<table width=\\\'100%\\\' align=\\\'center\\\' cellpadding=3 cellspacing=1 bgcolor=\\\'#DBEAF5\\\'>\r\n<tr><td width=\\\'25%\\\' height=25 bgcolor=\\\'ffffff\\\'>真實姓名</td><td bgcolor=\\\'ffffff\\\'>[!--truename--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>QQ號碼</td><td bgcolor=\\\'ffffff\\\'>[!--oicq--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>MSN</td><td bgcolor=\\\'ffffff\\\'>[!--msn--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>聯繫電話</td><td bgcolor=\\\'ffffff\\\'>[!--mycall--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>手機</td><td bgcolor=\\\'ffffff\\\'>[!--phone--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>網站地址</td><td bgcolor=\\\'ffffff\\\'>[!--homepage--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>會員頭像</td><td bgcolor=\\\'ffffff\\\'>[!--userpic--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>聯繫地址</td><td bgcolor=\\\'ffffff\\\'>[!--address--]&nbsp;郵編: [!--zip--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>個人介紹</td><td bgcolor=\\\'ffffff\\\'>[!--saytext--]</td></tr>\r\n</table>', '', '真實姓名<!--field--->truename<!--record-->聯繫電話<!--field--->mycall<!--record-->手機<!--field--->phone<!--record-->QQ號碼<!--field--->oicq<!--record-->MSN<!--field--->msn<!--record-->網站地址<!--field--->homepage<!--record-->會員頭像<!--field--->userpic<!--record-->聯繫地址<!--field--->address<!--record-->郵編<!--field--->zip<!--record-->簡介<!--field--->saytext<!--record-->', '', ',', ',userpic,', ',saytext,', '真實姓名<!--field--->truename<!--record-->聯繫電話<!--field--->mycall<!--record-->手機<!--field--->phone<!--record-->QQ號碼<!--field--->oicq<!--record-->MSN<!--field--->msn<!--record-->網站地址<!--field--->homepage<!--record-->會員頭像<!--field--->userpic<!--record-->聯繫地址<!--field--->address<!--record-->郵編<!--field--->zip<!--record-->簡介<!--field--->saytext<!--record-->', '', ',truename,mycall,phone,oicq,msn,homepage,userpic,address,zip,saytext,', ',truename,mycall,phone,oicq,msn,homepage,userpic,address,zip,saytext,', ',');
INSERT INTO `phome_enewsmemberform` VALUES (2, '企員註冊表單', '<table width=\\\'100%\\\' align=\\\'center\\\' cellpadding=3 cellspacing=1 bgcolor=\\\'#DBEAF5\\\'><tr><td width=\\\'25%\\\' height=25 bgcolor=\\\'ffffff\\\'>公司名稱</td><td bgcolor=\\\'ffffff\\\'>[!--company--](*)</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>聯繫人</td><td bgcolor=\\\'ffffff\\\'>[!--truename--](*)</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>聯繫電話</td><td bgcolor=\\\'ffffff\\\'>[!--mycall--](*)</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>傳真</td><td bgcolor=\\\'ffffff\\\'>[!--fax--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>手機</td><td bgcolor=\\\'ffffff\\\'>[!--phone--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>QQ號碼</td><td bgcolor=\\\'ffffff\\\'>[!--oicq--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>MSN</td><td bgcolor=\\\'ffffff\\\'>[!--msn--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>網址</td><td bgcolor=\\\'ffffff\\\'>[!--homepage--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>會員頭像</td><td bgcolor=\\\'ffffff\\\'>[!--userpic--]</td></tr>\r\n<tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>聯繫地址</td><td bgcolor=\\\'ffffff\\\'>[!--address--]&nbsp;郵編: [!--zip--]</td></tr><tr><td width=\\\'16%\\\' height=25 bgcolor=\\\'ffffff\\\'>公司介紹</td><td bgcolor=\\\'ffffff\\\'>[!--saytext--]</td></tr></table>', '', '公司名稱<!--field--->company<!--record-->聯繫人<!--field--->truename<!--record-->聯繫電話<!--field--->mycall<!--record-->傳真<!--field--->fax<!--record-->手機<!--field--->phone<!--record-->QQ號碼<!--field--->oicq<!--record-->MSN<!--field--->msn<!--record-->網址<!--field--->homepage<!--record-->會員頭像<!--field--->userpic<!--record-->聯繫地址<!--field--->address<!--record-->郵編<!--field--->zip<!--record-->公司介紹<!--field--->saytext<!--record-->', ',company,truename,mycall,', ',', ',userpic,', ',saytext,', '公司名稱<!--field--->company<!--record-->聯繫人<!--field--->truename<!--record-->聯繫電話<!--field--->mycall<!--record-->傳真<!--field--->fax<!--record-->手機<!--field--->phone<!--record-->QQ號碼<!--field--->oicq<!--record-->MSN<!--field--->msn<!--record-->網址<!--field--->homepage<!--record-->會員頭像<!--field--->userpic<!--record-->聯繫地址<!--field--->address<!--record-->郵編<!--field--->zip<!--record-->公司介紹<!--field--->saytext<!--record-->', ',company,', ',company,truename,mycall,fax,phone,oicq,msn,homepage,userpic,address,zip,saytext,', ',company,truename,mycall,fax,phone,oicq,msn,homepage,userpic,address,zip,saytext,', ',');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmembergbook`;
CREATE TABLE `phome_enewsmembergbook` (
  `gid` int(10) unsigned NOT NULL auto_increment,
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `isprivate` tinyint(1) NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `uname` varchar(20) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `gbtext` text NOT NULL,
  `retext` text NOT NULL,
  `checked` tinyint(1) NOT NULL default '0',
  `eipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`gid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmembergroup`;
CREATE TABLE `phome_enewsmembergroup` (
  `groupid` smallint(6) NOT NULL auto_increment,
  `groupname` varchar(60) NOT NULL default '',
  `level` smallint(6) NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `favanum` smallint(6) NOT NULL default '0',
  `daydown` int(11) NOT NULL default '0',
  `msglen` int(11) NOT NULL default '0',
  `msgnum` int(11) NOT NULL default '0',
  `canreg` tinyint(1) NOT NULL default '0',
  `formid` smallint(6) NOT NULL default '0',
  `regchecked` tinyint(1) NOT NULL default '0',
  `spacestyleid` smallint(6) NOT NULL default '0',
  `dayaddinfo` smallint(6) NOT NULL default '0',
  `infochecked` tinyint(1) NOT NULL default '0',
  `plchecked` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`groupid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsmembergroup` VALUES (1, '普通會員', 1, 0, 120, 0, 255, 50, 1, 1, 0, 1, 0, 0, 0);
INSERT INTO `phome_enewsmembergroup` VALUES (2, 'VIP會員', 2, 0, 200, 0, 255, 120, 0, 1, 0, 1, 0, 0, 0);
INSERT INTO `phome_enewsmembergroup` VALUES (3, '企業會員', 1, 0, 120, 0, 255, 50, 1, 2, 0, 2, 0, 0, 0);
INSERT INTO `phome_enewsmembergroup` VALUES (4, '企業VIP會員', 2, 0, 200, 0, 255, 120, 0, 2, 0, 2, 0, 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmemberpub`;
CREATE TABLE `phome_enewsmemberpub` (
  `userid` mediumint(8) unsigned NOT NULL auto_increment,
  `todayinfodate` char(10) NOT NULL default '',
  `todayaddinfo` mediumint(8) unsigned NOT NULL default '0',
  `todaydate` char(10) NOT NULL default '',
  `todaydown` mediumint(8) unsigned NOT NULL default '0',
  `authstr` char(30) NOT NULL default '',
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmenu`;
CREATE TABLE `phome_enewsmenu` (
  `menuid` int(10) unsigned NOT NULL auto_increment,
  `menuname` varchar(60) NOT NULL default '',
  `menuurl` varchar(255) NOT NULL default '',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `addhash` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`menuid`),
  KEY `myorder` (`myorder`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmenuclass`;
CREATE TABLE `phome_enewsmenuclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(60) NOT NULL default '',
  `issys` tinyint(1) NOT NULL default '0',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `classtype` tinyint(1) NOT NULL default '0',
  `groupids` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`classid`),
  KEY `myorder` (`myorder`),
  KEY `classtype` (`classtype`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmod`;
CREATE TABLE `phome_enewsmod` (
  `mid` smallint(5) unsigned NOT NULL auto_increment,
  `mname` varchar(100) NOT NULL default '',
  `mtemp` mediumtext NOT NULL,
  `mzs` varchar(255) NOT NULL default '',
  `cj` mediumtext NOT NULL,
  `enter` mediumtext NOT NULL,
  `tempvar` mediumtext NOT NULL,
  `sonclass` text NOT NULL,
  `searchvar` varchar(255) NOT NULL default '',
  `tid` smallint(5) unsigned NOT NULL default '0',
  `tbname` varchar(60) NOT NULL default '',
  `qenter` mediumtext NOT NULL,
  `mustqenterf` text NOT NULL,
  `qmtemp` mediumtext NOT NULL,
  `listandf` text NOT NULL,
  `setandf` tinyint(1) NOT NULL default '0',
  `listtempvar` mediumtext NOT NULL,
  `qmname` varchar(30) NOT NULL default '',
  `canaddf` text NOT NULL,
  `caneditf` text NOT NULL,
  `definfovoteid` smallint(6) NOT NULL default '0',
  `showmod` tinyint(1) NOT NULL default '0',
  `usemod` tinyint(1) NOT NULL default '0',
  `myorder` smallint(6) NOT NULL default '0',
  `orderf` text NOT NULL,
  `isdefault` tinyint(1) NOT NULL default '0',
  `listfile` varchar(30) NOT NULL default '',
  `printtempid` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`mid`),
  KEY `tid` (`tid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsmoreport`;
CREATE TABLE `phome_enewsmoreport` (
  `pid` int(11) NOT NULL auto_increment,
  `pname` char(60) NOT NULL default '',
  `purl` char(255) NOT NULL default '',
  `ppath` char(255) NOT NULL default '',
  `postpass` char(120) NOT NULL default '',
  `postfile` char(255) NOT NULL default '',
  `tempgid` smallint(5) unsigned NOT NULL default '0',
  `mustdt` tinyint(1) NOT NULL default '0',
  `isclose` tinyint(1) NOT NULL default '0',
  `closeadd` tinyint(1) NOT NULL default '0',
  `headersign` char(255) NOT NULL default '',
  PRIMARY KEY  (`pid`),
  KEY `isclose` (`isclose`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsmoreport` VALUES (1, '主訪問端', '', '', '', '', 0, 0, 0, 0, '');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsnotcj`;
CREATE TABLE `phome_enewsnotcj` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `word` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsnotcj` VALUES (1, '<input type=hidden value=\'歡迎使用帝國網站管理系統：www.phome.net\'>');
INSERT INTO `phome_enewsnotcj` VALUES (2, '<phome 帝國網站管理系統,phome.net>');
INSERT INTO `phome_enewsnotcj` VALUES (3, '<!--帝國CMS,phome.net-->');
INSERT INTO `phome_enewsnotcj` VALUES (4, '<table style=display:none><tr><td>\r\nEmpire CMS,phome.net\r\n</td></tr></table>');
INSERT INTO `phome_enewsnotcj` VALUES (5, '<div style=display:none>\r\n擁有帝國一切，皆有可能。歡迎訪問phome.net\r\n</div>');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsnotice`;
CREATE TABLE `phome_enewsnotice` (
  `mid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(80) NOT NULL default '',
  `msgtext` text NOT NULL,
  `haveread` tinyint(1) NOT NULL default '0',
  `msgtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `to_username` varchar(30) NOT NULL default '',
  `from_userid` int(10) unsigned NOT NULL default '0',
  `from_username` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`mid`),
  KEY `to_username` (`to_username`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspage`;
CREATE TABLE `phome_enewspage` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(120) NOT NULL default '',
  `pagetext` mediumtext NOT NULL,
  `path` varchar(255) NOT NULL default '',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `pagetitle` varchar(120) NOT NULL default '',
  `pagekeywords` varchar(255) NOT NULL default '',
  `pagedescription` varchar(255) NOT NULL default '',
  `tempid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspageclass`;
CREATE TABLE `phome_enewspageclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspayapi`;
CREATE TABLE `phome_enewspayapi` (
  `payid` smallint(5) unsigned NOT NULL auto_increment,
  `paytype` varchar(20) NOT NULL default '',
  `myorder` tinyint(4) NOT NULL default '0',
  `payfee` varchar(10) NOT NULL default '',
  `payuser` varchar(60) NOT NULL default '',
  `partner` varchar(60) NOT NULL default '',
  `paykey` varchar(120) NOT NULL default '',
  `paylogo` varchar(200) NOT NULL default '',
  `paysay` text NOT NULL,
  `payname` varchar(120) NOT NULL default '',
  `isclose` tinyint(1) NOT NULL default '0',
  `payemail` varchar(120) NOT NULL default '',
  `paymethod` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`payid`),
  UNIQUE KEY `paytype` (`paytype`)
) TYPE=MyISAM;

INSERT INTO `phome_enewspayapi` VALUES (1, 'tenpay', 1, '0', '', '', '', '', '財付通（www.tenpay.com） - 騰訊旗下在線支付平台，通過國家權威安全認證，支持各大銀行網上支付。', '財付通', 0, '', 0);
INSERT INTO `phome_enewspayapi` VALUES (2, 'chinabank', 2, '0', '', '', '', '', '網銀在線與中國工商銀行、招商銀行、中國建設銀行、農業銀行、民生銀行等數十家金融機構達成協議。全面支持全國19家銀行的信用卡及借記卡實現網上支付。（網址：http://www.chinabank.com.cn）', '網銀在線', 0, '', 0);
INSERT INTO `phome_enewspayapi` VALUES (3, 'alipay', 0, '0', '', '', '', '', '支付寶網站(www.alipay.com) 是國內先進的網上支付平台。', '支付寶接口', 0, '', 1);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspayrecord`;
CREATE TABLE `phome_enewspayrecord` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `orderid` varchar(50) NOT NULL default '',
  `money` varchar(20) NOT NULL default '',
  `posttime` datetime NOT NULL default '0000-00-00 00:00:00',
  `paybz` varchar(255) NOT NULL default '',
  `type` varchar(12) NOT NULL default '',
  `payip` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`,`orderid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspic`;
CREATE TABLE `phome_enewspic` (
  `picid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(120) NOT NULL default '',
  `pic_url` varchar(200) NOT NULL default '',
  `url` varchar(200) NOT NULL default '',
  `pic_width` varchar(20) NOT NULL default '',
  `pic_height` varchar(20) NOT NULL default '',
  `open_pic` varchar(20) NOT NULL default '',
  `border` tinyint(1) NOT NULL default '0',
  `pictext` text NOT NULL,
  `classid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`picid`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspicclass`;
CREATE TABLE `phome_enewspicclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewspicclass` VALUES (1, '默認圖片信息類別');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspl_1`;
CREATE TABLE `phome_enewspl_1` (
  `plid` int(10) unsigned NOT NULL auto_increment,
  `pubid` bigint(16) NOT NULL default '0',
  `username` varchar(20) NOT NULL default '',
  `sayip` varchar(20) NOT NULL default '',
  `saytime` int(10) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `zcnum` smallint(5) unsigned NOT NULL default '0',
  `fdnum` smallint(5) unsigned NOT NULL default '0',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `saytext` text NOT NULL,
  `eipport` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`plid`),
  KEY `id` (`id`),
  KEY `classid` (`classid`),
  KEY `pubid` (`pubid`,`checked`,`plid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspl_set`;
CREATE TABLE `phome_enewspl_set` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `pltime` smallint(5) unsigned NOT NULL default '0',
  `plsize` smallint(5) unsigned NOT NULL default '0',
  `plincludesize` smallint(5) unsigned NOT NULL default '0',
  `plkey_ok` tinyint(1) NOT NULL default '0',
  `plface` text NOT NULL,
  `plfacenum` tinyint(3) unsigned NOT NULL default '0',
  `plgroupid` smallint(5) unsigned NOT NULL default '0',
  `plclosewords` text NOT NULL,
  `plf` text NOT NULL,
  `plmustf` text NOT NULL,
  `pldatatbs` text NOT NULL,
  `defpltempid` smallint(5) unsigned NOT NULL default '0',
  `pl_num` smallint(5) unsigned NOT NULL default '0',
  `pldeftb` smallint(5) unsigned NOT NULL default '0',
  `plurl` varchar(200) NOT NULL default '',
  `plmaxfloor` smallint(5) unsigned NOT NULL default '0',
  `plquotetemp` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `phome_enewspl_set` VALUES (1, 20, 500, 0, 1, '||[~e.jy~]##1.gif||[~e.kq~]##2.gif||[~e.se~]##3.gif||[~e.sq~]##4.gif||[~e.lh~]##5.gif||[~e.ka~]##6.gif||[~e.hh~]##7.gif||[~e.ys~]##8.gif||[~e.ng~]##9.gif||[~e.ot~]##10.gif||', 10, 0, '', '', '', ',1,', 1, 12, 1, '/ecms72/e/pl/', 0, '<div class=\\"ecomment\\">\r\n<span class=\\"ecommentauthor\\">網友 [!--username--] 的原文：</span>\r\n<p class=\\"ecommenttext\\">[!--pltext--]</p>\r\n</div>');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsplayer`;
CREATE TABLE `phome_enewsplayer` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `player` varchar(30) NOT NULL default '',
  `filename` varchar(20) NOT NULL default '',
  `bz` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsplayer` VALUES (1, 'RealPlayer', 'realplayer.php', 'RealPlayer播放器');
INSERT INTO `phome_enewsplayer` VALUES (2, 'MediaPlayer', 'mediaplayer.php', 'MediaPlayer播放器');
INSERT INTO `phome_enewsplayer` VALUES (3, 'FLASH', 'flasher.php', 'FLASH播放器');
INSERT INTO `phome_enewsplayer` VALUES (4, 'FLV播放器', 'flver.php', 'FLV播放器');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsplf`;
CREATE TABLE `phome_enewsplf` (
  `fid` smallint(5) unsigned NOT NULL auto_increment,
  `f` varchar(30) NOT NULL default '',
  `fname` varchar(30) NOT NULL default '',
  `fzs` varchar(255) NOT NULL default '',
  `ftype` varchar(30) NOT NULL default '',
  `flen` varchar(20) NOT NULL default '',
  `ismust` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`fid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspostdata`;
CREATE TABLE `phome_enewspostdata` (
  `postid` bigint(20) unsigned NOT NULL auto_increment,
  `rnd` varchar(32) NOT NULL default '',
  `postdata` varchar(255) NOT NULL default '',
  `ispath` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`postid`),
  KEY `rnd` (`rnd`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspostserver`;
CREATE TABLE `phome_enewspostserver` (
  `pid` smallint(5) unsigned NOT NULL auto_increment,
  `pname` varchar(60) NOT NULL default '',
  `purl` varchar(255) NOT NULL default '',
  `ptype` tinyint(1) NOT NULL default '0',
  `ftphost` varchar(255) NOT NULL default '',
  `ftpport` varchar(20) NOT NULL default '',
  `ftpusername` varchar(120) NOT NULL default '',
  `ftppassword` varchar(120) NOT NULL default '',
  `ftppath` varchar(255) NOT NULL default '',
  `ftpmode` tinyint(1) NOT NULL default '0',
  `ftpssl` tinyint(1) NOT NULL default '0',
  `ftppasv` tinyint(1) NOT NULL default '0',
  `ftpouttime` smallint(5) unsigned NOT NULL default '0',
  `lastposttime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`pid`),
  KEY `ptype` (`ptype`)
) TYPE=MyISAM;

INSERT INTO `phome_enewspostserver` VALUES (1, '附件服務器', '', 1, '', '', '', '', '', 0, 0, 0, 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspublic`;
CREATE TABLE `phome_enewspublic` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `newsurl` varchar(120) NOT NULL default '',
  `sitename` varchar(60) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `filetype` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `hotnum` tinyint(4) NOT NULL default '0',
  `newnum` tinyint(4) NOT NULL default '0',
  `relistnum` int(11) NOT NULL default '0',
  `renewsnum` int(11) NOT NULL default '0',
  `min_keyboard` tinyint(4) NOT NULL default '0',
  `max_keyboard` tinyint(4) NOT NULL default '0',
  `search_num` tinyint(4) NOT NULL default '0',
  `search_pagenum` tinyint(4) NOT NULL default '0',
  `newslink` tinyint(4) NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `searchtime` int(11) NOT NULL default '0',
  `loginnum` smallint(6) NOT NULL default '0',
  `logintime` int(11) NOT NULL default '0',
  `addnews_ok` tinyint(1) NOT NULL default '0',
  `register_ok` tinyint(1) NOT NULL default '0',
  `indextype` varchar(10) NOT NULL default '',
  `goodlencord` tinyint(4) NOT NULL default '0',
  `goodtype` varchar(10) NOT NULL default '',
  `goodnum` tinyint(4) NOT NULL default '0',
  `searchtype` varchar(10) NOT NULL default '',
  `exittime` smallint(6) NOT NULL default '0',
  `smalltextlen` smallint(6) NOT NULL default '0',
  `defaultgroupid` smallint(6) NOT NULL default '0',
  `fileurl` varchar(255) NOT NULL default '',
  `phpmode` tinyint(1) NOT NULL default '0',
  `ftphost` varchar(255) NOT NULL default '',
  `ftpport` varchar(20) NOT NULL default '21',
  `ftpusername` varchar(120) NOT NULL default '',
  `ftppassword` varchar(120) NOT NULL default '',
  `ftppath` varchar(255) NOT NULL default '',
  `ftpmode` tinyint(1) NOT NULL default '0',
  `install` tinyint(1) NOT NULL default '0',
  `hotplnum` tinyint(4) NOT NULL default '0',
  `softversion` varchar(30) NOT NULL default '0',
  `lctime` int(11) NOT NULL default '0',
  `dorepnum` smallint(6) NOT NULL default '0',
  `loadtempnum` smallint(6) NOT NULL default '0',
  `firstnum` tinyint(4) NOT NULL default '0',
  `bakdbpath` varchar(50) NOT NULL default '',
  `bakdbzip` varchar(50) NOT NULL default '',
  `downpass` varchar(32) NOT NULL default '',
  `min_userlen` tinyint(4) NOT NULL default '0',
  `max_userlen` tinyint(4) NOT NULL default '0',
  `min_passlen` tinyint(4) NOT NULL default '0',
  `max_passlen` tinyint(4) NOT NULL default '0',
  `filechmod` tinyint(1) NOT NULL default '0',
  `tid` smallint(6) NOT NULL default '0',
  `tbname` varchar(60) NOT NULL default '',
  `loginkey_ok` tinyint(1) NOT NULL default '0',
  `limittype` tinyint(1) NOT NULL default '0',
  `redodown` smallint(6) NOT NULL default '0',
  `candocode` tinyint(1) NOT NULL default '0',
  `opennotcj` tinyint(1) NOT NULL default '0',
  `reuserpagenum` int(11) NOT NULL default '0',
  `revotejsnum` int(11) NOT NULL default '0',
  `readjsnum` int(11) NOT NULL default '0',
  `qaddtran` tinyint(1) NOT NULL default '0',
  `qaddtransize` int(11) NOT NULL default '0',
  `ebakthisdb` tinyint(1) NOT NULL default '0',
  `delnewsnum` int(11) NOT NULL default '0',
  `markpos` tinyint(4) NOT NULL default '0',
  `markimg` varchar(80) NOT NULL default '',
  `marktext` varchar(80) NOT NULL default '',
  `markfontsize` varchar(12) NOT NULL default '',
  `markfontcolor` varchar(12) NOT NULL default '',
  `markfont` varchar(80) NOT NULL default '',
  `adminloginkey` tinyint(1) NOT NULL default '0',
  `php_outtime` int(11) NOT NULL default '0',
  `listpagefun` varchar(36) NOT NULL default '',
  `textpagefun` varchar(36) NOT NULL default '',
  `adfile` varchar(30) NOT NULL default '',
  `notsaveurl` text NOT NULL,
  `jstempid` smallint(6) NOT NULL default '0',
  `rssnum` smallint(6) NOT NULL default '0',
  `rsssub` smallint(6) NOT NULL default '0',
  `savetxtf` text NOT NULL,
  `dorepdlevelnum` int(11) NOT NULL default '0',
  `listpagelistfun` varchar(36) NOT NULL default '',
  `listpagelistnum` smallint(6) NOT NULL default '0',
  `infolinknum` int(11) NOT NULL default '0',
  `searchgroupid` smallint(6) NOT NULL default '0',
  `opencopytext` tinyint(1) NOT NULL default '0',
  `reuserjsnum` int(11) NOT NULL default '0',
  `reuserlistnum` int(11) NOT NULL default '0',
  `opentitleurl` tinyint(1) NOT NULL default '0',
  `qaddtranimgtype` text NOT NULL,
  `qaddtranfile` tinyint(1) NOT NULL default '0',
  `qaddtranfilesize` int(11) NOT NULL default '0',
  `qaddtranfiletype` text NOT NULL,
  `sendmailtype` tinyint(1) NOT NULL default '0',
  `smtphost` varchar(255) NOT NULL default '',
  `fromemail` varchar(120) NOT NULL default '',
  `loginemail` tinyint(1) NOT NULL default '0',
  `emailusername` varchar(60) NOT NULL default '',
  `emailpassword` varchar(60) NOT NULL default '',
  `smtpport` varchar(20) NOT NULL default '',
  `emailname` varchar(120) NOT NULL default '',
  `deftempid` smallint(6) NOT NULL default '0',
  `feedbacktfile` tinyint(1) NOT NULL default '0',
  `feedbackfilesize` int(11) NOT NULL default '0',
  `feedbackfiletype` text NOT NULL,
  `searchtempvar` tinyint(1) NOT NULL default '0',
  `showinfolevel` smallint(6) NOT NULL default '0',
  `navfh` varchar(20) NOT NULL default '',
  `spicwidth` smallint(6) NOT NULL default '0',
  `spicheight` smallint(6) NOT NULL default '0',
  `spickill` tinyint(1) NOT NULL default '0',
  `jpgquality` tinyint(4) NOT NULL default '0',
  `markpct` tinyint(4) NOT NULL default '0',
  `redoview` smallint(6) NOT NULL default '0',
  `reggetfen` smallint(6) NOT NULL default '0',
  `regbooktime` smallint(6) NOT NULL default '0',
  `revotetime` smallint(6) NOT NULL default '0',
  `nreclass` text NOT NULL,
  `nreinfo` text NOT NULL,
  `nrejs` text NOT NULL,
  `fpath` tinyint(1) NOT NULL default '0',
  `filepath` varchar(30) NOT NULL default '',
  `openmembertranimg` tinyint(1) NOT NULL default '0',
  `memberimgsize` int(11) NOT NULL default '0',
  `memberimgtype` text NOT NULL,
  `openmembertranfile` tinyint(1) NOT NULL default '0',
  `memberfilesize` int(11) NOT NULL default '0',
  `memberfiletype` text NOT NULL,
  `nottobq` text NOT NULL,
  `defspacestyleid` smallint(6) NOT NULL default '0',
  `canposturl` text NOT NULL,
  `openspace` tinyint(1) NOT NULL default '0',
  `defadminstyle` smallint(6) NOT NULL default '0',
  `realltime` smallint(6) NOT NULL default '0',
  `closeip` text NOT NULL,
  `openip` text NOT NULL,
  `hopenip` text NOT NULL,
  `closewords` text NOT NULL,
  `closewordsf` text NOT NULL,
  `textpagelistnum` smallint(6) NOT NULL default '0',
  `memberlistlevel` smallint(6) NOT NULL default '0',
  `wapopen` tinyint(1) NOT NULL default '0',
  `wapdefstyle` smallint(6) NOT NULL default '0',
  `wapshowmid` varchar(255) NOT NULL default '',
  `waplistnum` tinyint(4) NOT NULL default '0',
  `wapsubtitle` tinyint(4) NOT NULL default '0',
  `wapshowdate` varchar(50) NOT NULL default '',
  `wapchar` tinyint(1) NOT NULL default '0',
  `ebakcanlistdb` tinyint(1) NOT NULL default '0',
  `paymoneytofen` int(11) NOT NULL default '0',
  `payminmoney` int(11) NOT NULL default '0',
  `keytog` tinyint(1) NOT NULL default '0',
  `keyrnd` varchar(60) NOT NULL default '',
  `keytime` int(11) NOT NULL default '0',
  `regkey_ok` tinyint(1) NOT NULL default '0',
  `opengetdown` tinyint(1) NOT NULL default '0',
  `gbkey_ok` tinyint(1) NOT NULL default '0',
  `fbkey_ok` tinyint(1) NOT NULL default '0',
  `newaddinfotime` smallint(6) NOT NULL default '0',
  `classnavline` smallint(6) NOT NULL default '0',
  `classnavfh` varchar(120) NOT NULL default '',
  `adminstyle` text NOT NULL,
  `sitekey` varchar(255) NOT NULL default '',
  `siteintro` text NOT NULL,
  `docnewsnum` int(11) NOT NULL default '0',
  `openschall` tinyint(1) NOT NULL default '0',
  `schallfield` tinyint(1) NOT NULL default '0',
  `schallminlen` tinyint(4) NOT NULL default '0',
  `schallmaxlen` tinyint(4) NOT NULL default '0',
  `schallnotcid` text NOT NULL,
  `schallnum` smallint(6) NOT NULL default '0',
  `schallpagenum` smallint(6) NOT NULL default '0',
  `dtcanbq` tinyint(1) NOT NULL default '0',
  `dtcachetime` int(11) NOT NULL default '0',
  `regretime` smallint(6) NOT NULL default '0',
  `regclosewords` text NOT NULL,
  `regemailonly` tinyint(1) NOT NULL default '0',
  `repkeynum` smallint(6) NOT NULL default '0',
  `getpasstime` int(11) NOT NULL default '0',
  `acttime` int(11) NOT NULL default '0',
  `regacttype` tinyint(1) NOT NULL default '0',
  `acttext` text NOT NULL,
  `getpasstext` text NOT NULL,
  `acttitle` varchar(120) NOT NULL default '',
  `getpasstitle` varchar(120) NOT NULL default '',
  `opengetpass` tinyint(1) NOT NULL default '0',
  `hlistinfonum` int(11) NOT NULL default '0',
  `qlistinfonum` int(11) NOT NULL default '0',
  `dtncanbq` tinyint(1) NOT NULL default '0',
  `dtncachetime` int(11) NOT NULL default '0',
  `readdinfotime` smallint(6) NOT NULL default '0',
  `qeditinfotime` int(11) NOT NULL default '0',
  `ftpssl` tinyint(1) NOT NULL default '0',
  `ftppasv` tinyint(1) NOT NULL default '0',
  `ftpouttime` smallint(6) NOT NULL default '0',
  `onclicktype` tinyint(1) NOT NULL default '0',
  `onclickfilesize` int(11) NOT NULL default '0',
  `onclickfiletime` int(11) NOT NULL default '0',
  `schalltime` smallint(6) NOT NULL default '0',
  `defprinttempid` smallint(6) NOT NULL default '0',
  `opentags` tinyint(1) NOT NULL default '0',
  `tagstempid` smallint(6) NOT NULL default '0',
  `usetags` text NOT NULL,
  `chtags` text NOT NULL,
  `tagslistnum` smallint(6) NOT NULL default '0',
  `closeqdt` tinyint(1) NOT NULL default '0',
  `settop` tinyint(1) NOT NULL default '0',
  `qlistinfomod` tinyint(1) NOT NULL default '0',
  `gb_num` tinyint(4) NOT NULL default '0',
  `member_num` tinyint(4) NOT NULL default '0',
  `space_num` tinyint(4) NOT NULL default '0',
  `opendoip` text NOT NULL,
  `closedoip` text NOT NULL,
  `doiptype` varchar(255) NOT NULL default '',
  `filelday` int(11) NOT NULL default '0',
  `infolday` int(11) NOT NULL default '0',
  `baktempnum` tinyint(4) NOT NULL default '0',
  `dorepkey` tinyint(1) NOT NULL default '0',
  `dorepword` tinyint(1) NOT NULL default '0',
  `onclickrnd` varchar(20) NOT NULL default '',
  `indexpagedt` tinyint(1) NOT NULL default '0',
  `keybgcolor` varchar(8) NOT NULL default '',
  `keyfontcolor` varchar(8) NOT NULL default '',
  `keydistcolor` varchar(8) NOT NULL default '',
  `indexpageid` smallint(6) NOT NULL default '0',
  `closeqdtmsg` varchar(255) NOT NULL default '',
  `openfileserver` tinyint(1) NOT NULL default '0',
  `closemods` varchar(255) NOT NULL default '',
  `fieldandtop` tinyint(1) NOT NULL default '0',
  `fieldandclosetb` text NOT NULL,
  `filedatatbs` text NOT NULL,
  `filedeftb` smallint(5) unsigned NOT NULL default '0',
  `firsttitlename` varchar(255) NOT NULL default '',
  `isgoodname` varchar(255) NOT NULL default '',
  `closelisttemp` varchar(255) NOT NULL default '',
  `chclasscolor` varchar(8) NOT NULL default '',
  `timeclose` varchar(255) NOT NULL default '',
  `timeclosedo` varchar(255) NOT NULL default '',
  `ipaddinfonum` int(10) unsigned NOT NULL default '0',
  `ipaddinfotime` smallint(5) unsigned NOT NULL default '0',
  `rewriteinfo` varchar(120) NOT NULL default '',
  `rewriteclass` varchar(120) NOT NULL default '',
  `rewriteinfotype` varchar(120) NOT NULL default '',
  `rewritetags` varchar(120) NOT NULL default '',
  `closehmenu` varchar(80) NOT NULL default '',
  `indexaddpage` tinyint(1) NOT NULL default '0',
  `rewritepl` varchar(150) NOT NULL default '',
  `modmemberedittran` tinyint(1) NOT NULL default '0',
  `modinfoedittran` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `phome_enewspublic` VALUES (1, '/ecms72/', '帝國網站管理系統', 'admin@phome.net', '|.gif|.jpg|.swf|.rar|.zip|.mp3|.wmv|.txt|.doc|', 2048, 10, 10, 8, 100, 2, 20, 20, 10, 0, 0, 30, 5, 60, 0, 0, '.html', 0, '', 10, '.html', 40, 160, 1, '/ecms72/d/file/', 0, '', '21', '', '', '', 0, 0, 10, '7.0,1357574410', 1222406370, 300, 50, 10, 'bdata', 'zip', 'ZWfUcSHhRGvMfC5Xf4Q9', 3, 20, 6, 20, 1, 1, 'news', 0, 0, 1, 1, 0, 50, 100, 100, 1, 50, 1, 300, 5, '../data/mark/maskdef.gif', '', '5', '', '../data/mark/cour.ttf', 1, 0, 'sys_ShowListPage', 'sys_ShowTextPage', 'thea', '', 1, 50, 300, ',article.newstext,', 300, 'sys_ShowListMorePage', 10, 100, 0, 0, 100, 8, 1, '|.gif|.jpg|', 1, 500, '|.zip|.rar|', 1, 'smtp.163.com', 'ecms@163.com', 1, 'ecms', 'ecms', '25', '帝國CMS', 0, 1, 500, '|.zip|.rar|', 1, 0, '>', 105, 118, 1, 80, 65, 24, 0, 30, 30, ',', ',', ',', 0, 'Y-m-d', 1, 50, '|.gif|.jpg|', 1, 500, '|.zip|.rar|', ',', 1, '', 0, 1, 0, '', '', '', '', '', 6, 0, 1, 1, '', 10, 30, 'm-d', 0, 0, 10, 1, 2, 'AEuFgKy82pL6Zw3YGm582CGCc7DFkn', 30, 0, 0, 0, 0, 0, 20, '&nbsp;|&nbsp;', ',1,2,', '帝國網站管理系統,EmpireCMS', '　　帝國軟件是一家專注於網絡軟件開發的科技公司，其主營產品「帝國網站管理系統(EmpireCMS)」是目前國內應用最廣泛的CMS程序。通過十多年的不斷創新與完善，使系統集安全、穩定、強大、靈活於一身。目前EmpireCMS程序已經廣泛應用在國內上百萬家網站，覆蓋國內上千萬上網人群，並經過上千家知名網站的嚴格檢測，被稱為國內最安全、最穩定的開源CMS系統。', 300, 0, 1, 3, 20, ',,', 20, 10, 1, 43200, 0, '', 1, 0, 72, 720, 0, '[!--username--] ，\r\n這封信是由 [!--sitename--] 發送的。\r\n\r\n您收到這封郵件，是因為在我們網站的新用戶註冊 Email 使用\r\n了您的地址。如果您並沒有訪問過我們的網站，或沒有進行上述操作，請忽\r\n略這封郵件。您不需要退訂或進行其他進一步的操作。\r\n\r\n----------------------------------------------------------------------\r\n帳號激活說明\r\n----------------------------------------------------------------------\r\n\r\n您是我們網站的新用戶，註冊 Email 時使用了本地址，我們需\r\n要對您的地址有效性進行驗證以避免垃圾郵件或地址被濫用。\r\n\r\n您只需點擊下面的鏈接即可激活您的帳號：\r\n\r\n[!--pageurl--]\r\n\r\n(如果上面不是鏈接形式，請將地址手工粘貼到瀏覽器地址欄再訪問)\r\n\r\n感謝您的訪問，祝您使用愉快！\r\n\r\n\r\n\r\n此致\r\n\r\n[!--sitename--] 管理團隊.\r\n[!--news.url--]', '[!--username--] ，\r\n這封信是由 [!--sitename--] 發送的。\r\n\r\n您收到這封郵件，是因為在我們的網站上這個郵箱地址被登記為用戶郵箱，\r\n且該用戶請求使用 Email 密碼重置所致。\r\n\r\n----------------------------------------------------------------------\r\n重要！\r\n----------------------------------------------------------------------\r\n\r\n如果您沒有提交密碼重置的請求或不是我們網站的註冊用戶，請立即忽略\r\n並刪除這封郵件。只在您確認需要重置密碼的情況下，才繼續閱讀下面的\r\n內容。\r\n\r\n----------------------------------------------------------------------\r\n密碼重置說明\r\n----------------------------------------------------------------------\r\n\r\n您只需在提交請求後的三天之內，通過點擊下面的鏈接重置您的密碼：\r\n\r\n[!--pageurl--]\r\n\r\n(如果上面不是鏈接形式，請將地址手工粘貼到瀏覽器地址欄再訪問)\r\n\r\n上面的頁面打開後，輸入新的密碼後提交，之後您即可使用新的密碼登錄\r\n網站了。您可以在用戶控制面板中隨時修改您的密碼。\r\n\r\n\r\n\r\n此致\r\n\r\n[!--sitename--] 管理團隊.\r\n[!--news.url--]', '[[!--sitename--]] Email 地址驗證', '[[!--sitename--]] 取回密碼說明', 0, 30, 25, 1, 43200, 0, 0, 0, 0, 0, 0, 10, 60, 0, 1, 1, 1, ',1,2,3,4,5,6,7,8,', '', 25, 0, 0, 0, 20, 20, 25, '', '', '', 0, 0, 3, 0, 0, '', 0, '', '', '', 0, '', 0, '', 0, '', ',1,', 1, '一級頭條|二級頭條|三級頭條|四級頭條|五級頭條|六級頭條|七級頭條|八級頭條|九級頭條', '一級推薦|二級推薦|三級推薦|四級推薦|五級推薦|六級推薦|七級推薦|八級推薦|九級推薦', '', '#99C4E3', '', '', 0, 0, '', '', '', '', '', 0, '', 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspublic_update`;
CREATE TABLE `phome_enewspublic_update` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `lasttimeinfo` int(10) unsigned NOT NULL default '0',
  `lasttimepl` int(10) unsigned NOT NULL default '0',
  `lastnuminfo` int(10) unsigned NOT NULL default '0',
  `lastnumpl` int(10) unsigned NOT NULL default '0',
  `lastnuminfotb` text NOT NULL,
  `lastnumpltb` text NOT NULL,
  `todaytimeinfo` int(10) unsigned NOT NULL default '0',
  `todaytimepl` int(10) unsigned NOT NULL default '0',
  `todaynuminfo` int(10) unsigned NOT NULL default '0',
  `yesterdaynuminfo` int(10) unsigned NOT NULL default '0',
  `todaynumpl` int(10) unsigned NOT NULL default '0',
  `yesterdaynumpl` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `phome_enewspublic_update` VALUES (1, 1355124469, 1355124476, 0, 0, '', '', 1408520771, 1408520771, 0, 0, 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspubvar`;
CREATE TABLE `phome_enewspubvar` (
  `varid` smallint(5) unsigned NOT NULL auto_increment,
  `myvar` varchar(60) NOT NULL default '',
  `varname` varchar(20) NOT NULL default '',
  `varvalue` text NOT NULL,
  `varsay` varchar(255) NOT NULL default '',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `tocache` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`varid`),
  UNIQUE KEY `varname` (`varname`),
  KEY `classid` (`classid`),
  KEY `tocache` (`tocache`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewspubvarclass`;
CREATE TABLE `phome_enewspubvarclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  `classsay` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsqmsg`;
CREATE TABLE `phome_enewsqmsg` (
  `mid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(80) NOT NULL default '',
  `msgtext` text NOT NULL,
  `haveread` tinyint(1) NOT NULL default '0',
  `msgtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `to_username` varchar(30) NOT NULL default '',
  `from_userid` int(10) unsigned NOT NULL default '0',
  `from_username` varchar(30) NOT NULL default '',
  `isadmin` tinyint(1) NOT NULL default '0',
  `issys` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`mid`),
  KEY `to_username` (`to_username`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssearch`;
CREATE TABLE `phome_enewssearch` (
  `searchid` bigint(20) unsigned NOT NULL auto_increment,
  `keyboard` varchar(255) NOT NULL default '',
  `searchtime` int(10) unsigned NOT NULL default '0',
  `searchclass` varchar(255) NOT NULL default '',
  `result_num` int(10) unsigned NOT NULL default '0',
  `searchip` varchar(20) NOT NULL default '',
  `classid` varchar(255) NOT NULL default '',
  `onclick` int(10) unsigned NOT NULL default '0',
  `orderby` varchar(30) NOT NULL default '0',
  `myorder` tinyint(1) NOT NULL default '0',
  `checkpass` varchar(32) NOT NULL default '',
  `tbname` varchar(60) NOT NULL default '',
  `tempid` smallint(5) unsigned NOT NULL default '0',
  `iskey` tinyint(1) NOT NULL default '0',
  `andsql` text NOT NULL,
  `trueclassid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`searchid`),
  KEY `checkpass` (`checkpass`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssearchall`;
CREATE TABLE `phome_enewssearchall` (
  `sid` int(10) unsigned NOT NULL auto_increment,
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `title` text NOT NULL,
  `infotime` int(10) unsigned NOT NULL default '0',
  `infotext` mediumtext NOT NULL,
  PRIMARY KEY  (`sid`),
  KEY `id` (`id`,`classid`,`infotime`),
  FULLTEXT KEY `title` (`title`,`infotext`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssearchall_load`;
CREATE TABLE `phome_enewssearchall_load` (
  `lid` smallint(5) unsigned NOT NULL auto_increment,
  `tbname` varchar(60) NOT NULL default '',
  `titlefield` varchar(30) NOT NULL default '',
  `infotextfield` varchar(30) NOT NULL default '',
  `smalltextfield` varchar(30) NOT NULL default '',
  `loadnum` smallint(5) unsigned NOT NULL default '0',
  `lasttime` int(10) unsigned NOT NULL default '0',
  `lastid` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`lid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshop_address`;
CREATE TABLE `phome_enewsshop_address` (
  `addressid` int(10) unsigned NOT NULL auto_increment,
  `addressname` char(50) NOT NULL default '',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `truename` char(20) NOT NULL default '',
  `oicq` char(20) NOT NULL default '',
  `msn` char(60) NOT NULL default '',
  `email` char(60) NOT NULL default '',
  `address` char(255) NOT NULL default '',
  `zip` char(8) NOT NULL default '',
  `mycall` char(30) NOT NULL default '',
  `phone` char(30) NOT NULL default '',
  `signbuild` char(100) NOT NULL default '',
  `besttime` char(120) NOT NULL default '',
  `isdefault` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`addressid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshop_ddlog`;
CREATE TABLE `phome_enewsshop_ddlog` (
  `logid` int(10) unsigned NOT NULL auto_increment,
  `ddid` int(10) unsigned NOT NULL default '0',
  `userid` int(10) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `ecms` varchar(30) NOT NULL default '',
  `bz` varchar(255) NOT NULL default '',
  `addbz` varchar(255) NOT NULL default '',
  `logtime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`logid`),
  KEY `ddid` (`ddid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshop_precode`;
CREATE TABLE `phome_enewsshop_precode` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `prename` varchar(30) NOT NULL default '',
  `precode` varchar(36) NOT NULL default '',
  `premoney` int(10) unsigned NOT NULL default '0',
  `pretype` tinyint(1) NOT NULL default '0',
  `reuse` tinyint(1) NOT NULL default '0',
  `addtime` int(10) unsigned NOT NULL default '0',
  `endtime` int(10) unsigned NOT NULL default '0',
  `groupid` varchar(255) NOT NULL default '',
  `classid` text NOT NULL,
  `musttotal` int(10) unsigned NOT NULL default '0',
  `usenum` int(11) NOT NULL default '0',
  `haveusenum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `precode` (`precode`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshop_set`;
CREATE TABLE `phome_enewsshop_set` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `shopddgroupid` smallint(5) unsigned NOT NULL default '0',
  `buycarnum` smallint(5) unsigned NOT NULL default '0',
  `havefp` tinyint(1) NOT NULL default '0',
  `fpnum` smallint(5) unsigned NOT NULL default '0',
  `fpname` text NOT NULL,
  `ddmust` text NOT NULL,
  `haveatt` tinyint(1) NOT NULL default '0',
  `shoptbs` varchar(255) NOT NULL default '',
  `buystep` tinyint(3) unsigned NOT NULL default '0',
  `shoppsmust` tinyint(1) NOT NULL default '0',
  `shoppayfsmust` tinyint(1) NOT NULL default '0',
  `dddeltime` smallint(5) unsigned NOT NULL default '0',
  `cutnumtype` tinyint(1) NOT NULL default '0',
  `cutnumtime` int(10) unsigned NOT NULL default '0',
  `freepstotal` int(10) unsigned NOT NULL default '0',
  `singlenum` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsshop_set` VALUES (1, 0, 0, 0, 10, '商品名稱\r\n辦公用品\r\n日用品', ',truename,mycall,address,', 0, ',shop,', 0, 1, 1, 0, 0, 120, 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshopdd`;
CREATE TABLE `phome_enewsshopdd` (
  `ddid` int(10) unsigned NOT NULL auto_increment,
  `ddno` varchar(30) NOT NULL default '',
  `ddtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `outproduct` tinyint(1) NOT NULL default '0',
  `haveprice` tinyint(1) NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `truename` varchar(20) NOT NULL default '',
  `oicq` varchar(25) NOT NULL default '',
  `msn` varchar(120) NOT NULL default '',
  `email` varchar(120) NOT NULL default '',
  `mycall` varchar(30) NOT NULL default '',
  `phone` varchar(30) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `zip` varchar(8) NOT NULL default '',
  `psid` smallint(6) NOT NULL default '0',
  `psname` varchar(60) NOT NULL default '',
  `pstotal` float(11,2) NOT NULL default '0.00',
  `alltotal` float(11,2) NOT NULL default '0.00',
  `payfsid` smallint(6) NOT NULL default '0',
  `payfsname` varchar(60) NOT NULL default '',
  `payby` tinyint(4) NOT NULL default '0',
  `alltotalfen` float(11,2) NOT NULL default '0.00',
  `fp` tinyint(1) NOT NULL default '0',
  `fptt` varchar(255) NOT NULL default '',
  `fptotal` float(11,2) NOT NULL default '0.00',
  `fpname` varchar(50) NOT NULL default '',
  `userip` varchar(20) NOT NULL default '',
  `signbuild` varchar(100) NOT NULL default '',
  `besttime` varchar(120) NOT NULL default '',
  `pretotal` float(11,2) NOT NULL default '0.00',
  `ddtruetime` int(10) unsigned NOT NULL default '0',
  `havecutnum` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ddid`),
  KEY `ddno` (`ddno`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshopdd_add`;
CREATE TABLE `phome_enewsshopdd_add` (
  `ddid` int(10) unsigned NOT NULL default '0',
  `buycar` mediumtext NOT NULL,
  `bz` text NOT NULL,
  `retext` text NOT NULL,
  PRIMARY KEY  (`ddid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshoppayfs`;
CREATE TABLE `phome_enewsshoppayfs` (
  `payid` smallint(5) unsigned NOT NULL auto_increment,
  `payname` varchar(60) NOT NULL default '',
  `payurl` varchar(255) NOT NULL default '',
  `paysay` text NOT NULL,
  `userpay` tinyint(1) NOT NULL default '0',
  `userfen` tinyint(1) NOT NULL default '0',
  `isclose` tinyint(1) NOT NULL default '0',
  `isdefault` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`payid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsshoppayfs` VALUES (1, '郵政匯款', '', '郵政匯款地址:******', 0, 0, 0, 0);
INSERT INTO `phome_enewsshoppayfs` VALUES (2, '銀行轉帳', '', '銀行轉帳帳號:******', 0, 0, 0, 0);
INSERT INTO `phome_enewsshoppayfs` VALUES (3, '網銀支付', '/ecms72/e/payapi/ShopPay.php?paytype=alipay', '<p>網銀支付</p>', 0, 0, 0, 1);
INSERT INTO `phome_enewsshoppayfs` VALUES (4, '預付款支付', '', '預付款支付', 1, 0, 0, 0);
INSERT INTO `phome_enewsshoppayfs` VALUES (5, '貨到付款(或上門收款)', '', '貨到付款(或上門收款)說明', 0, 0, 0, 0);
INSERT INTO `phome_enewsshoppayfs` VALUES (6, '點數購買', '', '點數購買', 0, 1, 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsshopps`;
CREATE TABLE `phome_enewsshopps` (
  `pid` smallint(5) unsigned NOT NULL auto_increment,
  `pname` varchar(60) NOT NULL default '',
  `price` float(11,2) NOT NULL default '0.00',
  `otherprice` text NOT NULL,
  `psay` text NOT NULL,
  `isclose` tinyint(1) NOT NULL default '0',
  `isdefault` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`pid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsshopps` VALUES (1, '送貨上門', '10.00', '', '送貨上門', 0, 0);
INSERT INTO `phome_enewsshopps` VALUES (2, '特快專遞（EMS）', '25.00', '', '特快專遞（EMS）', 0, 0);
INSERT INTO `phome_enewsshopps` VALUES (3, '普通郵遞', '5.00', '', '普通郵遞', 0, 1);
INSERT INTO `phome_enewsshopps` VALUES (4, '郵局快郵', '12.00', '', '郵局快郵', 0, 0);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssp`;
CREATE TABLE `phome_enewssp` (
  `spid` int(10) unsigned NOT NULL auto_increment,
  `spname` varchar(30) NOT NULL default '',
  `varname` varchar(30) NOT NULL default '',
  `sppic` varchar(255) NOT NULL default '',
  `spsay` varchar(255) NOT NULL default '',
  `sptype` tinyint(1) NOT NULL default '0',
  `cid` smallint(5) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `tempid` smallint(5) unsigned NOT NULL default '0',
  `maxnum` int(11) NOT NULL default '0',
  `sptime` int(10) unsigned NOT NULL default '0',
  `groupid` text NOT NULL,
  `userclass` text NOT NULL,
  `username` text NOT NULL,
  `isclose` tinyint(1) NOT NULL default '0',
  `cladd` tinyint(1) NOT NULL default '0',
  `refile` tinyint(1) NOT NULL default '0',
  `spfile` varchar(255) NOT NULL default '',
  `spfileline` smallint(6) NOT NULL default '0',
  `spfilesub` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`spid`),
  UNIQUE KEY `varname` (`varname`),
  KEY `refile` (`refile`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssp_1`;
CREATE TABLE `phome_enewssp_1` (
  `sid` int(10) unsigned NOT NULL auto_increment,
  `spid` int(10) unsigned NOT NULL default '0',
  `title` varchar(200) NOT NULL default '',
  `titlepic` varchar(200) NOT NULL default '',
  `bigpic` varchar(200) NOT NULL default '',
  `titleurl` varchar(200) NOT NULL default '',
  `smalltext` varchar(255) NOT NULL default '',
  `titlefont` varchar(20) NOT NULL default '',
  `newstime` int(10) unsigned NOT NULL default '0',
  `titlepre` varchar(30) NOT NULL default '',
  `titlenext` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`sid`),
  KEY `spid` (`spid`),
  KEY `newstime` (`newstime`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssp_2`;
CREATE TABLE `phome_enewssp_2` (
  `sid` int(10) unsigned NOT NULL auto_increment,
  `spid` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sid`),
  KEY `spid` (`spid`),
  KEY `newstime` (`newstime`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssp_3`;
CREATE TABLE `phome_enewssp_3` (
  `sid` int(10) unsigned NOT NULL auto_increment,
  `spid` int(10) unsigned NOT NULL default '0',
  `sptext` mediumtext NOT NULL,
  PRIMARY KEY  (`sid`),
  UNIQUE KEY `spid` (`spid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssp_3_bak`;
CREATE TABLE `phome_enewssp_3_bak` (
  `bid` int(10) unsigned NOT NULL auto_increment,
  `sid` int(10) unsigned NOT NULL default '0',
  `spid` int(10) unsigned NOT NULL default '0',
  `sptext` mediumtext NOT NULL,
  `lastuser` varchar(30) NOT NULL default '',
  `lasttime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`bid`),
  KEY `sid` (`sid`),
  KEY `spid` (`spid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsspacestyle`;
CREATE TABLE `phome_enewsspacestyle` (
  `styleid` smallint(5) unsigned NOT NULL auto_increment,
  `stylename` varchar(30) NOT NULL default '',
  `stylepic` varchar(255) NOT NULL default '',
  `stylesay` varchar(255) NOT NULL default '',
  `stylepath` varchar(30) NOT NULL default '0',
  `isdefault` tinyint(1) NOT NULL default '0',
  `membergroup` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`styleid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewsspacestyle` VALUES (1, '默認個人空間模板', '', '默認個人空間模板', 'default', 1, ',1,2,');
INSERT INTO `phome_enewsspacestyle` VALUES (2, '默認企業空間模板', '', '默認企業空間模板', 'comdefault', 0, ',3,4,');

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsspclass`;
CREATE TABLE `phome_enewsspclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  `classsay` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewssql`;
CREATE TABLE `phome_enewssql` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `sqlname` varchar(60) NOT NULL default '',
  `sqltext` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewstable`;
CREATE TABLE `phome_enewstable` (
  `tid` smallint(5) unsigned NOT NULL auto_increment,
  `tbname` varchar(60) NOT NULL default '',
  `tname` varchar(60) NOT NULL default '',
  `tsay` text NOT NULL,
  `isdefault` tinyint(1) NOT NULL default '0',
  `datatbs` text NOT NULL,
  `deftb` varchar(6) NOT NULL default '',
  `yhid` smallint(5) unsigned NOT NULL default '0',
  `mid` smallint(5) unsigned NOT NULL default '0',
  `intb` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`tid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewstags`;
CREATE TABLE `phome_enewstags` (
  `tagid` int(10) unsigned NOT NULL auto_increment,
  `tagname` char(20) NOT NULL default '',
  `num` int(10) unsigned NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `cid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`tagid`),
  UNIQUE KEY `tagname` (`tagname`),
  KEY `isgood` (`isgood`),
  KEY `cid` (`cid`),
  KEY `num` (`num`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewstagsclass`;
CREATE TABLE `phome_enewstagsclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewstagsdata`;
CREATE TABLE `phome_enewstagsdata` (
  `tid` int(10) unsigned NOT NULL auto_increment,
  `tagid` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `mid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`tid`),
  KEY `tagid` (`tagid`),
  KEY `classid` (`classid`),
  KEY `id` (`id`),
  KEY `newstime` (`newstime`),
  KEY `mid` (`mid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewstask`;
CREATE TABLE `phome_enewstask` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `taskname` varchar(60) NOT NULL default '',
  `userid` int(10) unsigned NOT NULL default '0',
  `isopen` tinyint(1) NOT NULL default '0',
  `filename` varchar(60) NOT NULL default '',
  `lastdo` int(10) unsigned NOT NULL default '0',
  `doweek` char(1) NOT NULL default '0',
  `doday` char(2) NOT NULL default '0',
  `dohour` char(2) NOT NULL default '0',
  `dominute` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewstogzts`;
CREATE TABLE `phome_enewstogzts` (
  `togid` int(10) unsigned NOT NULL auto_increment,
  `keyboard` varchar(255) NOT NULL default '',
  `searchf` varchar(255) NOT NULL default '',
  `query` text NOT NULL,
  `specialsearch` varchar(255) NOT NULL default '',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `retype` tinyint(1) NOT NULL default '0',
  `startday` varchar(20) NOT NULL default '',
  `endday` varchar(20) NOT NULL default '',
  `startid` int(10) unsigned NOT NULL default '0',
  `endid` int(10) unsigned NOT NULL default '0',
  `pline` int(11) NOT NULL default '0',
  `doecmszt` tinyint(1) NOT NULL default '0',
  `togztname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`togid`),
  KEY `togztname` (`togztname`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuser`;
CREATE TABLE `phome_enewsuser` (
  `userid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `rnd` varchar(20) NOT NULL default '',
  `adminclass` mediumtext NOT NULL,
  `groupid` smallint(5) unsigned NOT NULL default '0',
  `checked` tinyint(1) NOT NULL default '0',
  `styleid` smallint(5) unsigned NOT NULL default '0',
  `filelevel` tinyint(1) NOT NULL default '0',
  `salt` varchar(8) NOT NULL default '',
  `loginnum` int(10) unsigned NOT NULL default '0',
  `lasttime` int(10) unsigned NOT NULL default '0',
  `lastip` varchar(20) NOT NULL default '',
  `truename` varchar(20) NOT NULL default '',
  `email` varchar(120) NOT NULL default '',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `pretime` int(10) unsigned NOT NULL default '0',
  `preip` varchar(20) NOT NULL default '',
  `addtime` int(10) unsigned NOT NULL default '0',
  `addip` varchar(20) NOT NULL default '',
  `userprikey` varchar(50) NOT NULL default '',
  `salt2` varchar(20) NOT NULL default '',
  `lastipport` varchar(6) NOT NULL default '',
  `preipport` varchar(6) NOT NULL default '',
  `addipport` varchar(6) NOT NULL default '',
  `uprnd` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`userid`),
  UNIQUE KEY `username` (`username`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuseradd`;
CREATE TABLE `phome_enewsuseradd` (
  `userid` int(10) unsigned NOT NULL auto_increment,
  `equestion` tinyint(4) NOT NULL default '0',
  `eanswer` varchar(32) NOT NULL default '',
  `openip` text NOT NULL,
  `certkey` varchar(60) NOT NULL default '',
  `certtime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuserclass`;
CREATE TABLE `phome_enewsuserclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuserjs`;
CREATE TABLE `phome_enewsuserjs` (
  `jsid` smallint(5) unsigned NOT NULL auto_increment,
  `jsname` varchar(60) NOT NULL default '',
  `jssql` text NOT NULL,
  `jstempid` smallint(5) unsigned NOT NULL default '0',
  `jsfilename` varchar(120) NOT NULL default '',
  `classid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`jsid`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuserjsclass`;
CREATE TABLE `phome_enewsuserjsclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuserlist`;
CREATE TABLE `phome_enewsuserlist` (
  `listid` smallint(5) unsigned NOT NULL auto_increment,
  `listname` varchar(60) NOT NULL default '',
  `pagetitle` varchar(120) NOT NULL default '',
  `filepath` varchar(120) NOT NULL default '',
  `filetype` varchar(12) NOT NULL default '',
  `totalsql` text NOT NULL,
  `listsql` text NOT NULL,
  `maxnum` int(11) NOT NULL default '0',
  `lencord` int(11) NOT NULL default '0',
  `listtempid` smallint(5) unsigned NOT NULL default '0',
  `pagekeywords` varchar(255) NOT NULL default '',
  `pagedescription` varchar(255) NOT NULL default '',
  `classid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`listid`),
  KEY `classid` (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuserlistclass`;
CREATE TABLE `phome_enewsuserlistclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsuserloginck`;
CREATE TABLE `phome_enewsuserloginck` (
  `userid` int(10) unsigned NOT NULL auto_increment,
  `andauth` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsvote`;
CREATE TABLE `phome_enewsvote` (
  `voteid` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(120) NOT NULL default '',
  `votenum` int(10) unsigned NOT NULL default '0',
  `voteip` mediumtext NOT NULL,
  `votetext` text NOT NULL,
  `voteclass` tinyint(1) NOT NULL default '0',
  `doip` tinyint(1) NOT NULL default '0',
  `votetime` int(10) unsigned NOT NULL default '0',
  `dotime` date NOT NULL default '0000-00-00',
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `addtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `tempid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`voteid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsvotemod`;
CREATE TABLE `phome_enewsvotemod` (
  `voteid` smallint(5) unsigned NOT NULL auto_increment,
  `title` varchar(120) NOT NULL default '',
  `votetext` text NOT NULL,
  `voteclass` tinyint(1) NOT NULL default '0',
  `doip` tinyint(1) NOT NULL default '0',
  `dotime` date NOT NULL default '0000-00-00',
  `tempid` smallint(5) unsigned NOT NULL default '0',
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `votenum` int(10) unsigned NOT NULL default '0',
  `ysvotename` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`voteid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewswapstyle`;
CREATE TABLE `phome_enewswapstyle` (
  `styleid` smallint(5) unsigned NOT NULL auto_increment,
  `stylename` varchar(60) NOT NULL default '',
  `path` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`styleid`)
) TYPE=MyISAM;

INSERT INTO `phome_enewswapstyle` VALUES (1, '新聞模板', 1);
INSERT INTO `phome_enewswapstyle` VALUES (2, '分類信息模板', 2);

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewswfinfo`;
CREATE TABLE `phome_enewswfinfo` (
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `wfid` smallint(5) unsigned NOT NULL default '0',
  `tid` int(10) unsigned NOT NULL default '0',
  `groupid` text NOT NULL,
  `userclass` text NOT NULL,
  `username` text NOT NULL,
  `checknum` tinyint(4) NOT NULL default '0',
  `tstatus` varchar(30) NOT NULL default '0',
  `checktno` tinyint(4) NOT NULL default '0',
  KEY `id` (`id`,`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewswfinfolog`;
CREATE TABLE `phome_enewswfinfolog` (
  `logid` int(10) unsigned NOT NULL auto_increment,
  `id` int(10) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `wfid` smallint(5) unsigned NOT NULL default '0',
  `tid` int(10) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `checktime` int(10) unsigned NOT NULL default '0',
  `checktext` text NOT NULL,
  `checknum` tinyint(4) NOT NULL default '0',
  `checktype` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`logid`),
  KEY `id` (`id`,`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewswords`;
CREATE TABLE `phome_enewswords` (
  `wordid` smallint(5) unsigned NOT NULL auto_increment,
  `oldword` varchar(255) NOT NULL default '',
  `newword` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`wordid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsworkflow`;
CREATE TABLE `phome_enewsworkflow` (
  `wfid` smallint(5) unsigned NOT NULL auto_increment,
  `wfname` varchar(60) NOT NULL default '',
  `wftext` varchar(255) NOT NULL default '',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `addtime` int(10) unsigned NOT NULL default '0',
  `adduser` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`wfid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsworkflowitem`;
CREATE TABLE `phome_enewsworkflowitem` (
  `tid` int(10) unsigned NOT NULL auto_increment,
  `wfid` smallint(5) unsigned NOT NULL default '0',
  `tname` varchar(60) NOT NULL default '',
  `tno` int(11) NOT NULL default '0',
  `ttext` varchar(255) NOT NULL default '',
  `groupid` text NOT NULL,
  `userclass` text NOT NULL,
  `username` text NOT NULL,
  `lztype` tinyint(1) NOT NULL default '0',
  `tbdo` int(10) unsigned NOT NULL default '0',
  `tddo` int(10) unsigned NOT NULL default '0',
  `tstatus` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`tid`),
  KEY `wfid` (`wfid`),
  KEY `tno` (`tno`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewswriter`;
CREATE TABLE `phome_enewswriter` (
  `wid` smallint(5) unsigned NOT NULL auto_increment,
  `writer` varchar(30) NOT NULL default '',
  `email` varchar(120) NOT NULL default '',
  PRIMARY KEY  (`wid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsyh`;
CREATE TABLE `phome_enewsyh` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `yhname` varchar(30) NOT NULL default '',
  `yhtext` varchar(255) NOT NULL default '',
  `hlist` int(11) NOT NULL default '0',
  `qlist` int(11) NOT NULL default '0',
  `bqnew` int(11) NOT NULL default '0',
  `bqhot` int(11) NOT NULL default '0',
  `bqpl` int(11) NOT NULL default '0',
  `bqgood` int(11) NOT NULL default '0',
  `bqfirst` int(11) NOT NULL default '0',
  `bqdown` int(11) NOT NULL default '0',
  `otherlink` int(11) NOT NULL default '0',
  `qmlist` int(11) NOT NULL default '0',
  `dobq` tinyint(1) NOT NULL default '0',
  `dojs` tinyint(1) NOT NULL default '0',
  `dosbq` tinyint(1) NOT NULL default '0',
  `rehtml` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewszt`;
CREATE TABLE `phome_enewszt` (
  `ztid` smallint(5) unsigned NOT NULL auto_increment,
  `ztname` varchar(60) NOT NULL default '',
  `onclick` int(10) unsigned NOT NULL default '0',
  `ztnum` tinyint(3) unsigned NOT NULL default '0',
  `listtempid` smallint(5) unsigned NOT NULL default '0',
  `ztpath` varchar(255) NOT NULL default '',
  `zttype` varchar(10) NOT NULL default '',
  `zturl` varchar(200) NOT NULL default '',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `islist` tinyint(1) NOT NULL default '0',
  `maxnum` int(11) NOT NULL default '0',
  `reorder` varchar(50) NOT NULL default '',
  `intro` text NOT NULL,
  `ztimg` varchar(255) NOT NULL default '',
  `zcid` smallint(5) unsigned NOT NULL default '0',
  `showzt` tinyint(1) NOT NULL default '0',
  `ztpagekey` varchar(255) NOT NULL default '',
  `classtempid` smallint(5) unsigned NOT NULL default '0',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `usezt` tinyint(1) NOT NULL default '0',
  `yhid` smallint(5) unsigned NOT NULL default '0',
  `endtime` int(10) unsigned NOT NULL default '0',
  `closepl` tinyint(1) NOT NULL default '0',
  `checkpl` tinyint(1) NOT NULL default '0',
  `restb` tinyint(3) unsigned NOT NULL default '0',
  `usernames` varchar(255) NOT NULL default '',
  `addtime` int(10) unsigned NOT NULL default '0',
  `pltempid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ztid`),
  KEY `classid` (`classid`),
  KEY `zcid` (`zcid`),
  KEY `usezt` (`usezt`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsztadd`;
CREATE TABLE `phome_enewsztadd` (
  `ztid` smallint(5) unsigned NOT NULL default '0',
  `classtext` mediumtext NOT NULL,
  PRIMARY KEY  (`ztid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsztclass`;
CREATE TABLE `phome_enewsztclass` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `classname` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`classid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsztf`;
CREATE TABLE `phome_enewsztf` (
  `fid` smallint(5) unsigned NOT NULL auto_increment,
  `f` varchar(30) NOT NULL default '',
  `fname` varchar(30) NOT NULL default '',
  `fform` varchar(20) NOT NULL default '',
  `fhtml` mediumtext NOT NULL,
  `fzs` varchar(255) NOT NULL default '',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `ftype` varchar(30) NOT NULL default '',
  `flen` varchar(20) NOT NULL default '',
  `fvalue` text NOT NULL,
  `fformsize` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`fid`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewsztinfo`;
CREATE TABLE `phome_enewsztinfo` (
  `zid` int(10) unsigned NOT NULL auto_increment,
  `ztid` smallint(5) unsigned NOT NULL default '0',
  `cid` smallint(5) unsigned NOT NULL default '0',
  `classid` smallint(5) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL default '0',
  `newstime` int(10) unsigned NOT NULL default '0',
  `mid` smallint(5) unsigned NOT NULL default '0',
  `isgood` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`zid`),
  KEY `ztid` (`ztid`),
  KEY `cid` (`cid`),
  KEY `classid` (`classid`),
  KEY `id` (`id`),
  KEY `newstime` (`newstime`),
  KEY `mid` (`mid`),
  KEY `isgood` (`isgood`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewszttype`;
CREATE TABLE `phome_enewszttype` (
  `cid` mediumint(8) unsigned NOT NULL auto_increment,
  `ztid` smallint(5) unsigned NOT NULL default '0',
  `cname` varchar(20) NOT NULL default '',
  `myorder` smallint(5) unsigned NOT NULL default '0',
  `islist` tinyint(1) NOT NULL default '0',
  `listtempid` smallint(5) unsigned NOT NULL default '0',
  `maxnum` int(10) unsigned NOT NULL default '0',
  `tnum` tinyint(3) unsigned NOT NULL default '0',
  `reorder` varchar(50) NOT NULL default '',
  `ttype` varchar(10) NOT NULL default '',
  `endtime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cid`),
  KEY `ztid` (`ztid`),
  KEY `myorder` (`myorder`)
) TYPE=MyISAM;

# --------------------------------------------------------

DROP TABLE IF EXISTS `phome_enewszttypeadd`;
CREATE TABLE `phome_enewszttypeadd` (
  `cid` mediumint(8) unsigned NOT NULL default '0',
  `classtext` mediumtext NOT NULL,
  PRIMARY KEY  (`cid`)
) TYPE=MyISAM;


