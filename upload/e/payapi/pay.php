<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
eCheckCloseMods('pay');//�����Ҷ�
$link=db_connect();
$empire=new mysqlquery();

$money=(float)$_POST['money'];
if($money<=0)
{
	printerror('��I���B���ର0','',1,0,1);
}
$payid=(int)$_POST['payid'];
if(!$payid)
{
	printerror('�п�ܤ�I���x','',1,0,1);
}
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where payid='$payid' and isclose=0");
if(!$payr[payid])
{
	printerror('�п�ܤ�I���x','',1,0,1);
}
$ddno='';
$productname='';
$productsay='';
$phome=$_POST['phome'];
if($phome=='PayToFen')//�ʶR�I��
{
	$productname='�ʶR�I��';
}
elseif($phome=='PayToMoney')//�s�w�I��
{
	$productname='�s�w�I��';
}
elseif($phome=='ShopPay')//�ӫ���I
{
	$productname='�ӫ���I';
}
else
{
	printerror('�z�Ӧ۪��챵���s�b','',1,0,1);
}

include('payfun.php');

if($phome=='PayToFen'||$phome=='PayToMoney')
{
	$user=islogin();//�O�_�n��
	$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");
	if($money<$pr['payminmoney'])
	{
		printerror('���B����p�� '.$pr['payminmoney'].' ��','',1,0,1);
	}
	$productname.=",UID:".$user['userid'].",UName:".$user['username'];
	$productsay="�Τ�ID:".$user['userid'].",�Τ�W:".$user['username'];
}
elseif($phome=='ShopPay')
{
	$ddid=(int)getcvar('paymoneyddid');
	$ddr=PayApiShopDdMoney($ddid);
	if($money!=$ddr['tmoney'])
	{
		printerror('�q����B���~','',1,0,1);
	}
	$ddno=$ddr[ddno];
	$productname="��I�q�渹:".$ddno;
	$productsay="�q�渹:".$ddno;
}

esetcookie("payphome",$phome,0);
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