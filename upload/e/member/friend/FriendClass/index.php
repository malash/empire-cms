<?php
require("../../../class/connect.php");
require("../../../class/q_functions.php");
require("../../../class/db_sql.php");
require("../../class/user.php");
require('../../class/friendfun.php');
$link=db_connect();
$empire=new mysqlquery();
$editor=2;
eCheckCloseMods('member');//�����Ҷ�
$user=islogin();
$query="select cid,cname from {$dbtbpre}enewshyclass where userid='$user[userid]' order by cid desc";
$sql=$empire->query($query);
//�ɤJ�ҪO
require(ECMS_PATH.'e/template/member/FriendClass.php');
db_close();
$empire=null;
?>