<?php
//------------------參數配置
$open=1;	//1為關閉，0為開啟
$type=0;	//0為按ip(同一ip不重複增加點數)，1為按cookie(同一機器不重複增加點數)
$retime=3600;	//重複增加點數時間間隔，單位為秒
$fen=1;		//單一點擊點數
$gotourl="../../../";	//轉向地址


//------------------
if($open)
{
	exit();
}

require("../../class/connect.php");
$id=(int)$_GET['id'];
$n=RepPostVar($_GET['n']);
if(!($id||$n))
{
	Header("Location:$gotourl");
	exit();
}
require("../../class/db_sql.php");
require("../../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
if($id)
{
	$where=egetmf('userid')."='".$id."'";
}
else
{
	$where=egetmf('username')."='".$n."'";
}
$r=$empire->fetch1("select ".eReturnSelectMemberF('userid,username')." from ".eReturnMemberTable()." where ".$where." limit 1");
if(empty($r[userid]))
{
	Header("Location:$gotourl");
	exit();
}
//cookie
if($type==1)
{
	$gfencookie=getcvar('ecmsgfen');
	if($gfencookie)
	{
		Header("Location:$gotourl");
		exit();
	}
	$set=esetcookie("ecmsgfen","ecms",time()+$retime);
}
//ip
else
{
	$ip=egetip();
	$time=time();
	//刪除過期記錄
	$del=$empire->query("delete from {$dbtbpre}enewsgfenip where ".$time."-addtime>".$retime);
	$ipr=$empire->fetch1("select ip,addtime from {$dbtbpre}enewsgfenip where ip='$ip' limit 1");
	if($ipr['ip'])
	{
		Header("Location:$gotourl");
		exit();
	}
	else
	{
		$usql=$empire->query("insert into {$dbtbpre}enewsgfenip(ip,addtime) values('$ip',$time);");
	}
}
$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."+".$fen." where ".$where);
$set=esetcookie("gfenuserid",$r[userid],0);
$set=esetcookie("gfenusername",$r[username],0);
db_close();
$empire=null;
header("Refresh:0; URL=$gotourl");
?>