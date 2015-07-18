<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;

//訂單號
if(!getcvar('checkpaysession'))
{
	printerror('非法操作','../../../',1,0,1);
}
else
{
	esetcookie("checkpaysession","",0);
}
//操作事件
$phome=getcvar('payphome');
if($phome=='PayToFen')//購買點數
{}
elseif($phome=='PayToMoney')//存預付款
{}
elseif($phome=='ShopPay')//商城支付
{}
elseif($phome=='BuyGroupPay')//購買充值類型
{}
else
{
	printerror('您來自的鏈接不存在','',1,0,1);
}

$user=array();
if($phome=='PayToFen'||$phome=='PayToMoney'||$phome=='BuyGroupPay')
{
	$user=islogin();//是否登陸
}

$paytype='chinabank';
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where paytype='$paytype' limit 1");

$v_mid=$payr['payuser'];//商戶號

$key=$payr['paykey'];//密鑰

//----------------------------------------------返回信息
$v_oid    =trim($_POST['v_oid']);      
$v_pmode   =trim($_POST['v_pmode']);      
$v_pstatus=trim($_POST['v_pstatus']);      
$v_pstring=trim($_POST['v_pstring']);      
$v_amount=trim($_POST['v_amount']);     
$v_moneytype  =trim($_POST['v_moneytype']);     
$remark1  =trim($_POST['remark1']);     
$remark2  =trim($_POST['remark2']);     
$v_md5str =trim($_POST['v_md5str']);    

//md5
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));

if($v_md5str!=$md5string)
{
	printerror('驗證MD5簽名失敗.','../../../',1,0,1);
}

if($v_pstatus!="20")
{
	printerror('支付失敗.','../../../',1,0,1);
}

//----------- 支付成功後處理 -----------

include('../payfun.php');
$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");

$orderid=$v_oid;	//支付訂單
$ddno=$remark1;	//網站的訂單號
$money=$v_amount;
$fen=floor($money)*$pr[paymoneytofen];

if($phome=='PayToFen')//購買點數
{
	$paybz='購買點數: '.$fen;
	PayApiBuyFen($fen,$money,$paybz,$orderid,$user[userid],$user[username],$paytype);
}
elseif($phome=='PayToMoney')//存預付款
{
	$paybz='存預付款';
	PayApiPayMoney($money,$paybz,$orderid,$user[userid],$user[username],$paytype);
}
elseif($phome=='ShopPay')//商城支付
{
	include('../../data/dbcache/class.php');
	$ddid=(int)getcvar('paymoneyddid');
	$paybz='商城購買 [!--ddno--] 的訂單(ddid='.$ddid.')';
	PayApiShopPay($ddid,$money,$paybz,$orderid,'','',$paytype);
}
elseif($phome=='BuyGroupPay')//購買充值類型
{
	include("../../data/dbcache/MemberLevel.php");
	$bgid=(int)getcvar('paymoneybgid');
	PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
}

db_close();
$empire=null;
?>