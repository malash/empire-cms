<?php
require("../../class/connect.php");
require("../../class/q_functions.php");
require("../../class/db_sql.php");
require("../../data/dbcache/class.php");
require("../../member/class/user.php");
require('../class/ShopSysFun.php');
eCheckCloseMods('shop');//關閉模塊
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
$shoppr=ShopSys_ReturnSet();
//驗證權限
ShopCheckAddDdGroup($shoppr);

$r=$_POST;
if(!getcvar('mybuycar'))
{
	printerror('你的購物車沒有商品','',1,0,1);
}
//變量處理
$r['truename']=ehtmlspecialchars($r['truename']);
$r['mycall']=ehtmlspecialchars($r['mycall']);
$r['phone']=ehtmlspecialchars($r['phone']);
$r['email']=ehtmlspecialchars($r['email']);
$r['oicq']=ehtmlspecialchars($r['oicq']);
$r['msn']=ehtmlspecialchars($r['msn']);
$r['address']=ehtmlspecialchars($r['address']);
$r['zip']=ehtmlspecialchars($r['zip']);
$r['signbuild']=ehtmlspecialchars($r['signbuild']);
$r['besttime']=ehtmlspecialchars($r['besttime']);
$r['bz']=ehtmlspecialchars($r['bz']);
$r['fptt']=ehtmlspecialchars($r['fptt']);
$r['fpname']=ehtmlspecialchars($r['fpname']);
$r['fp']=(int)$r['fp'];
$r['psid']=(int)$r['psid'];
$r['payfsid']=(int)$r['payfsid'];
$r['precode']=RepPostVar($r['precode']);
$total=array();
//必填項
ShopSys_CheckDdMust($r,$shoppr);

$ddno=ShopSys_ReturnDdNo();//訂單ID
$classids='';
$price=0;

//取得用戶信息
$user=array();
$userid=(int)getcvar('mluserid');
$username=RepPostVar(getcvar('mlusername'));
if($userid)
{
	$rnd=RepPostVar(getcvar('mlrnd'));
	$user=$empire->fetch1("select ".eReturnSelectMemberF('userid,money,userfen,groupid')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('rnd')."='$rnd' limit 1");
	if(!$user['userid'])
	{
		printerror("MustSingleUser","history.go(-1)",1);
	}
}
//導入模板
require(ECMS_PATH.'e/template/ShopSys/SubmitOrder.php');
db_close();
$empire=null;
?>