<?php

//���ҵn���覡
function MemberConnect_CheckApptype($apptype){
	global $empire,$dbtbpre;
	$appr=$empire->fetch1("select * from {$dbtbpre}enewsmember_connect_app where apptype='$apptype' and isclose=0 limit 1");
	if(!$appr['id'])
	{
		printerror2('�п�ܵn���覡','../../../');
	}
	return $appr;
}

//����openid
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

//�B�z�n��
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

//��s�n���j�w
function MemberConnect_UpdateBindLogin($id){
	global $empire,$dbtbpre;
	$id=(int)$id;
	$lasttime=time();
	$empire->query("update {$dbtbpre}enewsmember_connect set loginnum=loginnum+1,lasttime='$lasttime' where id='$id' limit 1");
}

//�g�J�n���j�w
function MemberConnect_InsertBind($apptype,$openid,$userid){
	global $empire,$dbtbpre;
	$apptype=RepPostVar($apptype);
	$openid=RepPostVar($openid);
	$userid=(int)$userid;
	$time=time();
	//���ҬO�_����
	MemberConnect_CheckReBind($apptype,$userid);
	$empire->query("insert into {$dbtbpre}enewsmember_connect(userid,apptype,bindkey,bindtime,loginnum,lasttime) values('$userid','$apptype','$openid','$time',1,'$time');");
}

//���ҬO�_�j�w�L
function MemberConnect_CheckReBind($apptype,$userid){
	global $empire,$dbtbpre;
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_connect where userid='$userid' and apptype='$apptype' limit 1");
	if($num)
	{
		printerror2("���b���w�j�w�L�A���୫�Ƹj�w","history.go(-1)");
	}
}

//�R���n���j�w
function MemberConnect_DelBind($id){
	global $empire,$dbtbpre,$public_r;
	$user_r=islogin();//�O�_�n��
	$id=(int)$id;
	$sql=$empire->query("delete from {$dbtbpre}enewsmember_connect where id='$id' and userid='$user_r[userid]';");
	if($sql)
	{
		printerror2("�w�Ѱ��j�w","../memberconnect/ListBind.php");
	}
	else
	{
		printerror("DbError","history.go(-1)",1);
	}
}

//��b���j�w�n��
function MemberConnect_BindUser($userid){
	global $empire,$dbtbpre,$public_r;
	$apptype=RepPostVar($_SESSION['apptype']);
	$openid=RepPostVar($_SESSION['openid']);
	if(!trim($apptype)||!trim($openid))
	{
		printerror2('�Ӧ۪��챵���s�b','../../../');
	}
	$appr=MemberConnect_CheckApptype($apptype);//���ҵn���覡
	MemberConnect_CheckBindKey($apptype,$openid);
	MemberConnect_InsertBind($apptype,$openid,$userid);
	MemberConnect_ResetVar();
}

//�j�w���Ҳ�
function MemberConnect_GetBindKey($apptype,$openid){
	global $ecms_config;
	$checkpass=md5(md5('check-'.$apptype.'-empirecms-'.$openid).'-#empire.cms!-'.$openid.'-|-empirecms-|-'.$ecms_config['cks']['ckrndtwo']);
	return $checkpass;
}

//���Ҹj�w���Ҳ�
function MemberConnect_CheckBindKey($apptype,$openid){
	global $ecms_config;
	$pass=md5(md5('check-'.$apptype.'-empirecms-'.$openid).'-#empire.cms!-'.$openid.'-|-empirecms-|-'.$ecms_config['cks']['ckrndtwo']);
	$checkpass=$_SESSION['openidkey'];
	if($pass!=$checkpass)
	{
		printerror2('�Ӧ۪��챵���s�b','../../../');
	}
}

//���m�ܶq
function MemberConnect_ResetVar(){
	$_SESSION['state']='';
	$_SESSION['openid']='';
	$_SESSION['apptype']='';
	$_SESSION['openidkey']='';
}
?>