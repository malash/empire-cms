<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../../member/class/user.php");
require("../class/ShopSysFun.php");
eCheckCloseMods('shop');//�����Ҷ�
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//�O�_�n��
$user=islogin();
$ddid=(int)$_GET['ddid'];
$r=$empire->fetch1("select * from {$dbtbpre}enewsshopdd where ddid='$ddid' and userid='$user[userid]' limit 1");
if(empty($r['ddid']))
{
	printerror('���q�椣�s�b','',1,0,1);
}
$addr=$empire->fetch1("select * from {$dbtbpre}enewsshopdd_add where ddid='$ddid' limit 1");
//�ݭn�o��
$fp="�_";
if($r[fp])
{
	$fp="�O";
}
//���B
$total=0;
if($r[payby]==1)
{
	$pstotal=$r[pstotal]." �I";
	$alltotal=$r[alltotalfen]." �I";
	$total=$r[pstotal]+$r[alltotalfen];
	$mytotal=$total." �I";
}
else
{
	$pstotal=$r[pstotal]." ��";
	$alltotal=$r[alltotal]." ��";
	$total=$r[pstotal]+$r[alltotal]+$r[fptotal]-$r[pretotal];
	$mytotal=$total." ��";
}
//��I�覡
if($r[payby]==1)
{
	$payfsname=$r[payfsname]."(�I���ʶR)";
}
elseif($r[payby]==2)
{
	$payfsname=$r[payfsname]."(�l�B�ʶR)";
}
else
{
	$payfsname=$r[payfsname];
}
//���A
if($r['checked']==1)
{
	$ch="�w�T�{";
}
elseif($r['checked']==2)
{
	$ch="����";
}
elseif($r['checked']==3)
{
	$ch="�h�f";
}
else
{
	$ch="<font color=red>���T�{</font>";
}
//�o�f
if($r['outproduct']==1)
{
	$ou="�w�o�f";
}
elseif($r['outproduct']==2)
{
	$ou="�Ƴf��";
}
else
{
	$ou="<font color=red>���o�f</font>";
}
$topay='';
if($r['haveprice']==1)
{
	$ha="�w�I��";
}
else
{
	//�O�_���Ȥ�I
	$payfs_r=$empire->fetch1("select payurl from {$dbtbpre}enewsshoppayfs where payid='$r[payfsid]'");
	if($payfs_r['payurl'])
	{
		$topay="&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' name='button' value='�I����I' onclick=\"window.open('../doaction.php?ddid=$ddid&enews=ShopDdToPay','','width=760,height=600,scrollbars=yes,resizable=yes');\">";
	}
	$ha="<font color=red>���I��</font>";
}
//�ɤJ�ҪO
require(ECMS_PATH.'e/template/ShopSys/ShowDd.php');
db_close();
$empire=null;
?>