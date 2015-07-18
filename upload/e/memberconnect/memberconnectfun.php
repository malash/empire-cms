<?php

//驗證登錄方式
function MemberConnect_CheckApptype($apptype){
	global $empire,$dbtbpre;
	$appr=$empire->fetch1("select * from {$dbtbpre}enewsmember_connect_app where apptype='$apptype' and isclose=0 limit 1");
	if(!$appr['id'])
	{
		printerror2('請選擇登錄方式','../../../');
	}
	return $appr;
}

//驗證openid
function MemberConnect_CheckOpenid($apptype,$openid){
	global $empire,$dbtbpre;
	$mcr['id']=0;
	$mcr['userid']=0;
	if(!$apptype||!trim($openid))
	{
		return $mcr;
	}
	$mcr=$empire->fetch1("select id,userid from {$dbtbpre}enewsmember_connect where apptype='$apptype' and bindkey='$openid' limit 1");
	return $mcr;
}

//處理登錄
function MemberConnect_DoLogin($apptype,$openid){
	global $empire,$dbtbpre;
	$apptype=RepPostVar($apptype);
	$openid=RepPostVar($openid);
	$mcr=MemberConnect_CheckOpenid($apptype,$openid);
	if($mcr['id'])
	{
		$lifetime=0;
		$r=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('userid')."='".$mcr['userid']."' limit 1");
		DoEcmsMemberLogin($r,$lifetime);
		MemberConnect_UpdateBindLogin($mcr['id']);
		MemberConnect_ResetVar();
		printerrortourl('../../../');
	}
	else
	{
		printerrortourl('../tobind.php');
	}
}

//更新登錄綁定
function MemberConnect_UpdateBindLogin($id){
	global $empire,$dbtbpre;
	$id=(int)$id;
	$lasttime=time();
	$empire->query("update {$dbtbpre}enewsmember_connect set loginnum=loginnum+1,lasttime='$lasttime' where id='$id' limit 1");
}

//寫入登陸綁定
function MemberConnect_InsertBind($apptype,$openid,$userid){
	global $empire,$dbtbpre;
	$apptype=RepPostVar($apptype);
	$openid=RepPostVar($openid);
	$userid=(int)$userid;
	$time=time();
	//驗證是否重複
	MemberConnect_CheckReBind($apptype,$userid);
	$empire->query("insert into {$dbtbpre}enewsmember_connect(userid,apptype,bindkey,bindtime,loginnum,lasttime) values('$userid','$apptype','$openid','$time',1,'$time');");
}

//驗證是否綁定過
function MemberConnect_CheckReBind($apptype,$userid){
	global $empire,$dbtbpre;
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_connect where userid='$userid' and apptype='$apptype' limit 1");
	if($num)
	{
		printerror2("此帳號已綁定過，不能重複綁定","history.go(-1)");
	}
}

//刪除登陸綁定
function MemberConnect_DelBind($id){
	global $empire,$dbtbpre,$public_r;
	$user_r=islogin();//是否登陸
	$id=(int)$id;
	$sql=$empire->query("delete from {$dbtbpre}enewsmember_connect where id='$id' and userid='$user_r[userid]';");
	if($sql)
	{
		printerror2("已解除綁定","../memberconnect/ListBind.php");
	}
	else
	{
		printerror("DbError","history.go(-1)",1);
	}
}

//原帳號綁定登錄
function MemberConnect_BindUser($userid){
	global $empire,$dbtbpre,$public_r;
	$apptype=RepPostVar($_SESSION['apptype']);
	$openid=RepPostVar($_SESSION['openid']);
	if(!trim($apptype)||!trim($openid))
	{
		printerror2('來自的鏈接不存在','../../../');
	}
	$appr=MemberConnect_CheckApptype($apptype);//驗證登錄方式
	MemberConnect_CheckBindKey($apptype,$openid);
	MemberConnect_InsertBind($apptype,$openid,$userid);
	MemberConnect_ResetVar();
}

//綁定驗證符
function MemberConnect_GetBindKey($apptype,$openid){
	global $ecms_config;
	$checkpass=md5(md5('check-'.$apptype.'-empirecms-'.$openid).'-#empire.cms!-'.$openid.'-|-empirecms-|-'.$ecms_config['cks']['ckrndtwo']);
	return $checkpass;
}

//驗證綁定驗證符
function MemberConnect_CheckBindKey($apptype,$openid){
	global $ecms_config;
	$pass=md5(md5('check-'.$apptype.'-empirecms-'.$openid).'-#empire.cms!-'.$openid.'-|-empirecms-|-'.$ecms_config['cks']['ckrndtwo']);
	$checkpass=$_SESSION['openidkey'];
	if($pass!=$checkpass)
	{
		printerror2('來自的鏈接不存在','../../../');
	}
}

//重置變量
function MemberConnect_ResetVar(){
	$_SESSION['state']='';
	$_SESSION['openid']='';
	$_SESSION['apptype']='';
	$_SESSION['openidkey']='';
}
?>