<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;

//�q�渹
if(!getcvar('checkpaysession'))
{
	printerror('�D�k�ާ@','../../../',1,0,1);
}
else
{
	esetcookie("checkpaysession","",0);
}
//�ާ@�ƥ�
$phome=getcvar('payphome');
if($phome=='PayToFen')//�ʶR�I��
{}
elseif($phome=='PayToMoney')//�s�w�I��
{}
elseif($phome=='ShopPay')//�ӫ���I
{}
elseif($phome=='BuyGroupPay')//�ʶR�R������
{}
else
{
	printerror('�z�Ӧ۪��챵���s�b','',1,0,1);
}

$user=array();
if($phome=='PayToFen'||$phome=='PayToMoney'||$phome=='BuyGroupPay')
{
	$user=islogin();//�O�_�n��
}

$paytype='alipay';
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where paytype='$paytype' limit 1");

$bargainor_id=$payr['payuser'];//�Ӥḹ

$paykey=$payr['paykey'];//�K�_

$seller_email=$payr['payemail'];//��a��I�_�b��

//----------------------------------------------��^�H��

if(!empty($_POST))
{
	foreach($_POST as $key => $data)
	{
		$_GET[$key]=$data;
	}
}

$get_seller_email=rawurldecode($_GET['seller_email']);


//��I����
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
	printerror('����MD5ñ�W����.','../../../',1,0,1);
}

if(!($_GET['trade_status']=="TRADE_FINISHED"||$_GET['trade_status']=="WAIT_SELLER_SEND_GOODS"||$_GET['trade_status']=="TRADE_SUCCESS"))
{
	printerror('��I����.','../../../',1,0,1);
}

//----------- ��I���\��B�z -----------

include('../payfun.php');
$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");

$orderid=$_GET['trade_no'];	//��I�q��
$ddno=$_GET['out_trade_no'];	//�������q�渹
$money=$_GET['total_fee'];
$fen=floor($money)*$pr[paymoneytofen];

if($phome=='PayToFen')//�ʶR�I��
{
	$paybz='�ʶR�I��: '.$fen;
	PayApiBuyFen($fen,$money,$paybz,$orderid,$user[userid],$user[username],$paytype);
}
elseif($phome=='PayToMoney')//�s�w�I��
{
	$paybz='�s�w�I��';
	PayApiPayMoney($money,$paybz,$orderid,$user[userid],$user[username],$paytype);
}
elseif($phome=='ShopPay')//�ӫ���I
{
	include('../../data/dbcache/class.php');
	$ddid=(int)getcvar('paymoneyddid');
	$paybz='�ӫ��ʶR [!--ddno--] ���q��(ddid='.$ddid.')';
	PayApiShopPay($ddid,$money,$paybz,$orderid,'','',$paytype);
}
elseif($phome=='BuyGroupPay')//�ʶR�R������
{
	include("../../data/dbcache/MemberLevel.php");
	$bgid=(int)getcvar('paymoneybgid');
	PayApiBuyGroupPay($bgid,$money,$orderid,$user[userid],$user[username],$user[groupid],$paytype);
}

db_close();
$empire=null;
?>