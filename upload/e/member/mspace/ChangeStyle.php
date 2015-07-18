<?php
require("../../class/connect.php");
require("../../class/q_functions.php");
require("../../class/db_sql.php");
require "../".LoadLang("pub/fun.php");
require("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//關閉模塊
$user=islogin();
$addr=$empire->fetch1("select spacestyleid from {$dbtbpre}enewsmemberadd where userid='$user[userid]' limit 1");
if(empty($addr[spacestyleid]))
{
	$addr[spacestyleid]=$public_r['defspacestyleid'];
}
//分頁
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=16;//每頁顯示條數
$page_line=10;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select styleid,stylename,stylepic,stylesay,isdefault from {$dbtbpre}enewsspacestyle where membergroup='' or (membergroup<>'' and membergroup like '%,".$user[groupid].",%')";
$totalquery="select count(*) as total from {$dbtbpre}enewsspacestyle where membergroup='' or (membergroup<>'' and membergroup like '%,".$user[groupid].",%')";
$num=$empire->gettotal($totalquery);//取得總條數
$query.=" order by styleid limit $offset,$line";
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//導入模板
require(ECMS_PATH.'e/template/member/mspace/ChangeStyle.php');
db_close();
$empire=null;
?>