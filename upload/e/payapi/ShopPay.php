<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
eCheckCloseMods('pay');//�����Ҷ�
$link=db_connect();
$empire=new mysqlquery();
//��I���x
$paytype=RepPostVar($_GET['paytype']);
if(!$paytype)
{
	printerror('�п�ܤ�I���x','',1,0,1);
}
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where paytype='$paytype' and isclose=0 limit 1");
if(!$payr[payid])
{
	printerror('�п�ܤ�I���x','',1,0,1);
}

include('payfun.php');

//�q��H��
$ddid=(int)getcvar('paymoneyddid');
$ddr=PayApiShopDdMoney($ddid);
$money=$ddr['tmoney'];
if(!$money)
{
	printerror('�q����B���~','',1,0,1);
}
$ddno=$ddr[ddno];
$productname="��I�q�渹:".$ddno;
$productsay="�q�渹:".$ddno;

esetcookie("payphome","ShopPay",0);
//��^�a�}�e��
$PayReturnUrlQz=$public_r['newsurl'];
if(!stristr($public_r['newsurl'],'://'))
{
	$PayReturnUrlQz=eReturnDomain().$public_r['newsurl'];
}
//char
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