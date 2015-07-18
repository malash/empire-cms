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
require('memberconnectfun.php');
//接口
$apptype=RepPostVar($_GET['apptype']);
$appr=$empire->fetch1("select * from {$dbtbpre}enewsmember_connect_app where apptype='$apptype' and isclose=0 limit 1");
if(!$appr['id'])
{
	printerror2('請選擇登錄方式','');
}
$ReturnUrlQz=eReturnDomainSiteUrl();
$file=$appr['apptype'].'/to_login.php';
@include($file);
db_close();
$empire=null;
?>