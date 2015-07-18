<?php
if(!defined('empirecms'))
{
	exit();
}
//扣點
require_once($check_path."e/class/connect.php");
if(!defined('InEmpireCMS'))
{
	exit();
}
require_once(ECMS_PATH."e/class/db_sql.php");
$check_classid=(int)$check_classid;
$toreturnurl=eReturnSelfPage(0);	//返回頁面地址
$gotourl=$ecms_config['member']['loginurl']?$ecms_config['member']['loginurl']:$public_r['newsurl']."e/member/login/";	//登陸地址
$loginuserid=(int)getcvar('mluserid');
$logingroupid=(int)getcvar('mlgroupid');
if(!$loginuserid)
{
	printerror2('本欄目需要會員級別以上才能查看','');
}
if(!strstr($check_groupid,','.$logingroupid.','))
{
	printerror2('您沒有足夠權限查看此欄目','');
}
?>