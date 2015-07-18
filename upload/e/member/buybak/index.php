<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../class/user.php");
require "../".LoadLang("pub/fun.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//關閉模塊
//是否登陸
$user=islogin();
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=10;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$totalquery="select count(*) as total from {$dbtbpre}enewsbuybak where userid='$user[userid]'";
$num=$empire->gettotal($totalquery);//取得總條數
$query="select * from {$dbtbpre}enewsbuybak where userid='$user[userid]'";
$query=$query." order by buytime desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//導入模板
require(ECMS_PATH.'e/template/member/buybak.php');
db_close();
$empire=null;
?>