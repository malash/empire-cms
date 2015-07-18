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

$paytype='alipay';
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where paytype='$paytype' limit 1");

$bargainor_id=$payr['payuser'];//商戶號

$paykey=$payr['paykey'];//密鑰

$seller_email=$payr['payemail'];//賣家支付寶帳戶

//----------------------------------------------返回信息

if(!empty($_POST))
{
	foreach($_POST as $key => $data)
	{
		$_GET[$key]=$data;
	}
}

$get_seller_email=rawurldecode($_GET['seller_email']);


//支付驗證
ksort($_GET);
reset($_GET);

$sign='';
foreach($_GET AS $key=>$val)
{
	if($key!='sign'&&$key!='sign_type'&&$key!='code')
	{
		$sign.="$key=$val&";
	}
}

$sign=md5(substr($sign,0,-1).$paykey);
if($sign!=$_GET['sign'])
{
	printerror('驗證MD5簽名失敗.','../../../',1,0,1);
}

if(!($_GET['trade_status']=="TRADE_FINISHED"||$_GET['trade_status']=="WAIT_SELLER_SEND_GOODS"||$_GET['trade_status']=="TRADE_SUCCESS"))
{
	printerror('支付失敗.','../../../',1,0,1);
}

//----------- 支付成功後處理 -----------

include('../payfun.php');
$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");

$orderid=$_GET['trade_no'];	//支付訂單
$ddno=$_GET['out_trade_no'];	//網站的訂單號
$money=$_GET['total_fee'];
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