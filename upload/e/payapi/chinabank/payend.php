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

$paytype='chinabank';
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where paytype='$paytype' limit 1");

$v_mid=$payr['payuser'];//�Ӥḹ

$key=$payr['paykey'];//�K�_

//----------------------------------------------��^�H��
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
	printerror('����MD5ñ�W����.','../../../',1,0,1);
}

if($v_pstatus!="20")
{
	printerror('��I����.','../../../',1,0,1);
}

//----------- ��I���\��B�z -----------

include('../payfun.php');
$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");

$orderid=$v_oid;	//��I�q��
$ddno=$remark1;	//�������q�渹
$money=$v_amount;
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