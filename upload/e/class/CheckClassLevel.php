<?php
if(!defined('empirecms'))
{
	exit();
}
//���I
require_once($check_path."e/class/connect.php");
if(!defined('InEmpireCMS'))
{
	exit();
}
require_once(ECMS_PATH."e/class/db_sql.php");
$check_classid=(int)$check_classid;
$toreturnurl=eReturnSelfPage(0);	//��^�����a�}
$gotourl=$ecms_config['member']['loginurl']?$ecms_config['member']['loginurl']:$public_r['newsurl']."e/member/login/";	//�n���a�}
$loginuserid=(int)getcvar('mluserid');
$logingroupid=(int)getcvar('mlgroupid');
if(!$loginuserid)
{
	printerror2('����ػݭn�|���ŧO�H�W�~��d��','');
}
if(!strstr($check_groupid,','.$logingroupid.','))
{
	printerror2('�z�S�������v���d�ݦ����','');
}
?>