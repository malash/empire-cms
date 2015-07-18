<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
eCheckCloseMods('member');//關閉模塊
eCheckCloseMods('mconnect');//關閉模塊
$link=db_connect();
$empire=new mysqlquery();
eCheckCloseMemberConnect();//驗證開啟的接口
session_start();
require('memberconnectfun.php');

$apptype=RepPostVar($_SESSION['apptype']);
$openid=RepPostVar($_SESSION['openid']);
if(!trim($apptype)||!trim($openid))
{
	printerror2('來自的鏈接不存在','../../../');
}
$appr=MemberConnect_CheckApptype($apptype);//驗證登錄方式
MemberConnect_CheckBindKey($apptype,$openid);

//導入模板
require(ECMS_PATH.'e/template/memberconnect/tobind.php');
db_close();
$empire=null;
?>