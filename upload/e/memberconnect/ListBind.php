<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
eCheckCloseMods('member');//關閉模塊
eCheckCloseMods('mconnect');//關閉模塊
//是否登陸
$user=islogin();
$query="select * from {$dbtbpre}enewsmember_connect_app where isclose=0 order by myorder,id";
$sql=$empire->query($query);
//導入模板
require(ECMS_PATH.'e/template/memberconnect/ListBind.php');
db_close();
$empire=null;
?>