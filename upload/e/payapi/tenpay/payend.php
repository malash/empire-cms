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

$paytype='tenpay';
$payr=$empire->fetch1("select * from {$dbtbpre}enewspayapi where paytype='$paytype' limit 1");

$bargainor_id=$payr['payuser'];//�Ӥḹ

$key=$payr['paykey'];//�K�_

//----------------------------------------------��^�H��
import_request_variables("gpc", "frm_");
$strCmdno			= $frm_cmdno;
$strPayResult		= $frm_pay_result;
$strPayInfo		= $frm_pay_info;
$strBillDate		= $frm_date;
$strBargainorId	= $frm_bargainor_id;
$strTransactionId	= $frm_transaction_id;
$strSpBillno		= $frm_sp_billno;
$strTotalFee		= $frm_total_fee;
$strFeeType		= $frm_fee_type;
$strAttach			= $frm_attach;
$strMd5Sign		= $frm_sign;

//��I����
$checkkey="cmdno=".$strCmdno."&pay_result=".$strPayResult."&date=".$strBillDate."&transaction_id=".$strTransactionId."&sp_billno=".$strSpBillno."&total_fee=".$strTotalFee."&fee_type=".$strFeeType."&attach=".$strAttach."&key=".$key;
$checkSign=strtoupper(md5($checkkey));
  
if($checkSign!=$strMd5Sign)
{
	printerror('����MD5ñ�W����.','../../../',1,0,1);
}  

if($bargainor_id!=$strBargainorId)
{
	printerror('���~���Ӥḹ.','../../../',1,0,1);
}

if($strPayResult!="0")
{
	printerror('��I����.','../../../',1,0,1);
}

//----------- ��I���\��B�z -----------

include('../payfun.php');
$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");

$orderid=$strSpBillno;	//��I�q��
$ddno=$strAttach;	//�������q�渹
$money=$strTotalFee/100;
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