<?php
require("../../class/connect.php");
require("../../class/q_functions.php");
require("../../class/db_sql.php");
require "../".LoadLang("pub/fun.php");
require("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//�����Ҷ�
$user=islogin();
$addr=$empire->fetch1("select spacestyleid from {$dbtbpre}enewsmemberadd where userid='$user[userid]' limit 1");
if(empty($addr[spacestyleid]))
{
	$addr[spacestyleid]=$public_r['defspacestyleid'];
}
//����
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=16;//�C����ܱ���
$page_line=10;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select styleid,stylename,stylepic,stylesay,isdefault from {$dbtbpre}enewsspacestyle where membergroup='' or (membergroup<>'' and membergroup like '%,".$user[groupid].",%')";
$totalquery="select count(*) as total from {$dbtbpre}enewsspacestyle where membergroup='' or (membergroup<>'' and membergroup like '%,".$user[groupid].",%')";
$num=$empire->gettotal($totalquery);//���o�`����
$query.=" order by styleid limit $offset,$line";
$returnpage=page1($num,$line,$page_line,$start,$page,$search);
//�ɤJ�ҪO
require(ECMS_PATH.'e/template/member/mspace/ChangeStyle.php');
db_close();
$empire=null;
?>