<?php
require("../../class/connect.php");
require("../class/user.php");
require("../../class/db_sql.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//關閉模塊
//關閉
if($public_r[register_ok])
{
	printerror("CloseRegister","history.go(-1)",1);
}
//驗證時間段允許操作
eCheckTimeCloseDo('reg');
//驗證IP
eCheckAccessDoIp('register');
$tobind=(int)$_GET['tobind'];
//轉向註冊
if(!empty($ecms_config['member']['registerurl']))
{
	Header("Location:".$ecms_config['member']['registerurl']);
	exit();
}
//已經登陸不能註冊
if(getcvar('mluserid'))
{
	printerror("LoginToRegister","history.go(-1)",1);
}
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup where canreg=1 order by level,groupid");
//導入模板
require(ECMS_PATH.'e/template/member/ChangeRegister.php');
db_close();
$empire=null;
?>