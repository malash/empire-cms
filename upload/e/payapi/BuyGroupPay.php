<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
require("../data/dbcache/MemberLevel.php");
eCheckCloseMods('pay');//�����Ҷ�
$link=db_connect();
$empire=new mysqlquery();
//�O�_�n��
$user=islogin();
//��I���x
$payid=intval($_POST['payid']);
if(!$payid)
{
	printerror('�п�ܤ�I���x','',1,0,1);
}
//�R������
$id=intval($_POST['id']);
if(!$id)
{
	printerror('�п�ܥR������','',1,0,1);
}
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where payid='$payid' and isclose=0 limit 1");
if(!$payr[payid])
{
	printerror('�п�ܤ�I���x','',1,0,1);
}
$buyr=$empire->fetch1("select * from {$dbtbpre}enewsbuygroup where id='$id'");
if(!$buyr['id'])
{
	printerror('�п�ܥR������','',1,0,1);
}
//�v��
if($buyr[buygroupid]&&$level_r[$buyr[buygroupid]][level]>$level_r[$user[groupid]][level])
{
	printerror('���R�������ݭn '.$level_r[$buyr[buygroupid]][groupname].' �|���ŧO�H�W','',1,0,1);
}
include('payfun.php');

$money=$buyr['gmoney'];
if(!$money)
{
	printerror('���R���������B���~','',1,0,1);
}
$ddno='';
$productname="�R������:".$buyr['gname'].",UID:".$user['userid'].",UName:".$user['username'];
$productsay="�Τ�ID:".$user['userid'].",�Τ�W:".$user['username'];

esetcookie("payphome","BuyGroupPay",0);
esetcookie("paymoneybgid",$id,0);
//��^�a�}�e��
$PayReturnUrlQz=$public_r['newsurl'];
if(!stristr($public_r['newsurl'],'://'))
{
	$PayReturnUrlQz=eReturnDomain().$public_r['newsurl'];
}
//�s�X
if($ecms_config['sets']['pagechar']!='gb2312')
{
	@include_once("../class/doiconv.php");
	$iconv=new Chinese('');
	$char=$ecms_config['sets']['pagechar']=='big5'?'BIG5':'UTF8';
	$targetchar='GB2312';
	$productname=$iconv->Convert($char,$targetchar,$productname);
	$productsay=$iconv->Convert($char,$targetchar,$productsay);
	@header('Content-Type: text/html; charset=gb2312');
}
$file=$payr['paytype'].'/to_pay.php';
@include($file);
db_close();
$empire=null;
?>