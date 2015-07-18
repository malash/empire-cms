<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../../member/class/user.php");
require("../class/ShopSysFun.php");
eCheckCloseMods('shop');//關閉模塊
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//是否登陸
$user=islogin();
$ddid=(int)$_GET['ddid'];
$r=$empire->fetch1("select * from {$dbtbpre}enewsshopdd where ddid='$ddid' and userid='$user[userid]' limit 1");
if(empty($r['ddid']))
{
	printerror('此訂單不存在','',1,0,1);
}
$addr=$empire->fetch1("select * from {$dbtbpre}enewsshopdd_add where ddid='$ddid' limit 1");
//需要發票
$fp="否";
if($r[fp])
{
	$fp="是";
}
//金額
$total=0;
if($r[payby]==1)
{
	$pstotal=$r[pstotal]." 點";
	$alltotal=$r[alltotalfen]." 點";
	$total=$r[pstotal]+$r[alltotalfen];
	$mytotal=$total." 點";
}
else
{
	$pstotal=$r[pstotal]." 元";
	$alltotal=$r[alltotal]." 元";
	$total=$r[pstotal]+$r[alltotal]+$r[fptotal]-$r[pretotal];
	$mytotal=$total." 元";
}
//支付方式
if($r[payby]==1)
{
	$payfsname=$r[payfsname]."(點數購買)";
}
elseif($r[payby]==2)
{
	$payfsname=$r[payfsname]."(餘額購買)";
}
else
{
	$payfsname=$r[payfsname];
}
//狀態
if($r['checked']==1)
{
	$ch="已確認";
}
elseif($r['checked']==2)
{
	$ch="取消";
}
elseif($r['checked']==3)
{
	$ch="退貨";
}
else
{
	$ch="<font color=red>未確認</font>";
}
//發貨
if($r['outproduct']==1)
{
	$ou="已發貨";
}
elseif($r['outproduct']==2)
{
	$ou="備貨中";
}
else
{
	$ou="<font color=red>未發貨</font>";
}
$topay='';
if($r['haveprice']==1)
{
	$ha="已付款";
}
else
{
	//是否網銀支付
	$payfs_r=$empire->fetch1("select payurl from {$dbtbpre}enewsshoppayfs where payid='$r[payfsid]'");
	if($payfs_r['payurl'])
	{
		$topay="&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' name='button' value='點擊支付' onclick=\"window.open('../doaction.php?ddid=$ddid&enews=ShopDdToPay','','width=760,height=600,scrollbars=yes,resizable=yes');\">";
	}
	$ha="<font color=red>未付款</font>";
}
//導入模板
require(ECMS_PATH.'e/template/ShopSys/ShowDd.php');
db_close();
$empire=null;
?>