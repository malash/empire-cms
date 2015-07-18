<?php
//--------------- 會員空間函數 ---------------

//選擇空間模板
function ChangeSpaceStyle($add){
	global $empire,$dbtbpre;
	$user_r=islogin();//是否登陸
	$styleid=intval($add['styleid']);
	if(!$styleid)
	{
		printerror('NotChangeSpaceStyleId','',1);
	}
	$sr=$empire->fetch1("select styleid,membergroup from {$dbtbpre}enewsspacestyle where styleid='$styleid'");
	if(!$sr['styleid']||($sr['membergroup']&&!strstr($sr['membergroup'],','.$user_r[groupid].',')))
	{
		printerror('NotChangeSpaceStyleId','',1);
	}
	$sql=$empire->query("update {$dbtbpre}enewsmemberadd set spacestyleid='$styleid' where userid='$user_r[userid]' limit 1");
	if($sql)
	{
		printerror('ChangeSpaceStyleSuccess','ChangeStyle.php',1);
	}
	else
	{
		printerror('DbError','',1);
	}
}

//設置空間
function DoSetSpace($add){
	global $empire,$dbtbpre;
	$user_r=islogin();//是否登陸
	$spacename=RepPostStr($add['spacename']);
	$spacegg=RepPostStr($add['spacegg']);
	$sql=$empire->query("update {$dbtbpre}enewsmemberadd set spacename='$spacename',spacegg='$spacegg' where userid='$user_r[userid]' limit 1");
	if($sql)
	{
		printerror('SetSpaceSuccess','SetSpace.php',1);
	}
	else
	{
		printerror('DbError','',1);
	}
}
?>