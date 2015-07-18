<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
eCheckCloseMods('pay');//關閉模塊
$link=db_connect();
$empire=new mysqlquery();

$money=(float)$_POST['money'];
if($money<=0)
{
	printerror('支付金額不能為0','',1,0,1);
}
$payid=(int)$_POST['payid'];
if(!$payid)
{
	printerror('請選擇支付平台','',1,0,1);
}
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where payid='$payid' and isclose=0");
if(!$payr[payid])
{
	printerror('請選擇支付平台','',1,0,1);
}
$ddno='';
$productname='';
$productsay='';
$phome=$_POST['phome'];
if($phome=='PayToFen')//購買點數
{
	$productname='購買點數';
}
elseif($phome=='PayToMoney')//存預付款
{
	$productname='存預付款';
}
elseif($phome=='ShopPay')//商城支付
{
	$productname='商城支付';
}
else
{
	printerror('您來自的鏈接不存在','',1,0,1);
}

include('payfun.php');

if($phome=='PayToFen'||$phome=='PayToMoney')
{
	$user=islogin();//是否登陸
	$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");
	if($money<$pr['payminmoney'])
	{
		printerror('金額不能小於 '.$pr['payminmoney'].' 元','',1,0,1);
	}
	$productname.=",UID:".$user['userid'].",UName:".$user['username'];
	$productsay="用戶ID:".$user['userid'].",用戶名:".$user['username'];
}
elseif($phome=='ShopPay')
{
	$ddid=(int)getcvar('paymoneyddid');
	$ddr=PayApiShopDdMoney($ddid);
	if($money!=$ddr['tmoney'])
	{
		printerror('訂單金額有誤','',1,0,1);
	}
	$ddno=$ddr[ddno];
	$productname="支付訂單號:".$ddno;
	$productsay="訂單號:".$ddno;
}

esetcookie("payphome",$phome,0);
//返回地址前綴
$PayReturnUrlQz=$public_r['newsurl'];
if(!stristr($public_r['newsurl'],'://'))
{
	$PayReturnUrlQz=eReturnDomain().$public_r['newsurl'];
}
//編碼
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