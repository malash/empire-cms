<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../class/user.php");
require("../../data/dbcache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//關閉模塊
//是否登陸
$user=islogin();
$r=ReturnUserInfo($user[userid]);
$userdate=0;
//時間
if($r[userdate])
{
	$userdate=$r[userdate]-time();
	if($userdate<=0)
	{
		$userdate=0;
	}
	else
	{
		$userdate=round($userdate/(24*3600));
	}
}
//是否有短消息
$havemsg="無";
if($user[havemsg])
{
	$havemsg="<a href='".$public_r['newsurl']."e/member/msg/' target=_blank><font color=red>您有新消息</font></a>";
}
//註冊時間
$registertime=eReturnMemberRegtime($r['registertime'],"Y-m-d H:i:s");
//導入模板
require(ECMS_PATH.'e/template/member/my.php');
db_close();
$empire=null;
?>