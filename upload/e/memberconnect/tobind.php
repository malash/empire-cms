<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
eCheckCloseMods('member');//�����Ҷ�
eCheckCloseMods('mconnect');//�����Ҷ�
$link=db_connect();
$empire=new mysqlquery();
eCheckCloseMemberConnect();//���Ҷ}�Ҫ����f
session_start();
require('memberconnectfun.php');

$apptype=RepPostVar($_SESSION['apptype']);
$openid=RepPostVar($_SESSION['openid']);
if(!trim($apptype)||!trim($openid))
{
	printerror2('�Ӧ۪��챵���s�b','../../../');
}
$appr=MemberConnect_CheckApptype($apptype);//���ҵn���覡
MemberConnect_CheckBindKey($apptype,$openid);

//�ɤJ�ҪO
require(ECMS_PATH.'e/template/memberconnect/tobind.php');
db_close();
$empire=null;
?>