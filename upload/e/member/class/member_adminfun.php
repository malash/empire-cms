<?php
//--------------- ��x�޲z�|����� ---------------

//��x�ק���
function admin_EditMember($add,$logininid,$loginin){
	global $empire,$dbtbpre;
	if(!trim($add[userid])||!trim($add[email])||!trim($add[username])||!$add[groupid])
	{
		printerror("EmptyEmail","history.go(-1)");
	}
    CheckLevel($logininid,$loginin,$classid,"member");//�����v��
	//�ܶq
	$add[userid]=(int)$add[userid];
	$add[checked]=(int)$add[checked];
	$add[username]=RepPostVar($add[username]);
	$add[oldusername]=RepPostVar($add[oldusername]);
	$add[password]=RepPostVar($add[password]);
	$add[email]=RepPostStr($add[email]);
	$dousername=$add[username];
	$dooldusername=$add[oldusername];
	//�ק�K�X
	$add1='';
	if($add[password])
	{
		$salt=eReturnMemberSalt();
		$add[password]=eDoMemberPw($add[password],$salt);
		$add1=",".egetmf('password')."='$add[password]',".egetmf('salt')."='$salt'";
    }
	//�ק�Τ�W
	if($add[oldusername]<>$add[username])
	{
		$num=$empire->gettotal("select count(*) as total from ".eReturnMemberTable()." where ".egetmf('username')."='$add[username]' and ".egetmf('userid')."<>".$add[userid]." limit 1");
		$add1.=",".egetmf('username')."='$add[username]'";
		if($num)
		{
			printerror("ReUsername","history.go(-1)");
		}
	}
	//�]��
	$add[zgroupid]=(int)$add[zgroupid];
	if($add[userdate]>0)
	{
		$userdate=time()+$add[userdate]*24*3600;
	}
	else
	{
		$add[zgroupid]=0;
	}
	//�ܶq
	$add[groupid]=(int)$add[groupid];
	$add[userfen]=(int)$add[userfen];
	$userdate=(int)$userdate;
	$add[money]=(float)$add[money];
	$add[spacestyleid]=(int)$add[spacestyleid];
	//���Ҫ��[����
	$addr=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='$add[userid]'");
	$fid=GetMemberFormId($add[groupid]);
	if(empty($addr[userid]))
	{
		$mr['add_filepass']=$add['userid'];
		$member_r=ReturnDoMemberF($fid,$_POST,$mr,0,$dousername,1);
	}
	else
	{
		$addr['add_filepass']=$add['userid'];
		$member_r=ReturnDoMemberF($fid,$_POST,$addr,1,$dousername,1);
	}

	$sql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('email')."='$add[email]',".egetmf('groupid')."='$add[groupid]',".egetmf('userfen')."='$add[userfen]',".egetmf('money')."='$add[money]',".egetmf('userdate')."='$userdate',".egetmf('zgroupid')."='$add[zgroupid]',".egetmf('checked')."='$add[checked]'".$add1." where ".egetmf('userid')."='$add[userid]'");

	//���Τ�W
	if($add[oldusername]<>$add[username])
	{
		//�u����
		$empire->query("update {$dbtbpre}enewsqmsg set to_username='$dousername' where to_username='$dooldusername'");
		$empire->query("update {$dbtbpre}enewsqmsg set from_username='$dousername' where from_username='$dooldusername'");
		//����
		$empire->query("update {$dbtbpre}enewsfava set username='$dousername' where userid='$add[userid]'");
		//�ʶR�O��
		$empire->query("update {$dbtbpre}enewsbuybak set username='$dousername' where userid='$add[userid]'");
		//�U���O��
		$empire->query("update {$dbtbpre}enewsdownrecord set username='$dousername' where userid='$add[userid]'");
		//�H����
		$tbsql=$empire->query("select tbname from {$dbtbpre}enewstable");
		while($tbr=$empire->fetch($tbsql))
		{
			$empire->query("update {$dbtbpre}ecms_".$tbr['tbname']." set username='$dousername' where userid='$add[userid]' and ismember=1");
			$empire->query("update {$dbtbpre}ecms_".$tbr['tbname']."_check set username='$dousername' where userid='$add[userid]' and ismember=1");
		}
	}

	//���[��
	if(empty($addr[userid]))
	{
		$sql1=$empire->query("insert into {$dbtbpre}enewsmemberadd(userid,spacestyleid".$member_r[0].") values($add[userid],$add[spacestyleid]".$member_r[1].");");
    }
	else
	{
		$sql1=$empire->query("update {$dbtbpre}enewsmemberadd set spacestyleid=$add[spacestyleid]".$member_r[0]." where userid='$add[userid]'");
    }
	//��s����
	UpdateTheFileEditOther(6,$add['userid'],'member');
	if($sql)
	{
	   insert_dolog("userid=".$add[userid]."<br>username=".$dousername);//�ާ@��x
	   printerror("EditMemberSuccess","ListMember.php".hReturnEcmsHashStrHref2(1));
	}
    else
	{
		printerror("DbError","history.go(-1)");
	}
}

//��x�R���|��
function admin_DelMember($userid,$loginuserid,$loginusername){
	global $empire,$dbtbpre;
	$userid=(int)$userid;
	if(empty($userid))
	{
		printerror("NotDelMemberid","history.go(-1)");
	}
    CheckLevel($loginuserid,$loginusername,$classid,"member");//�����v��
	$r=$empire->fetch1("select ".eReturnSelectMemberF('username,groupid')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid'");
	if(empty($r['username']))
	{
		printerror("NotDelMemberid","history.go(-1)");
	}
    $sql=$empire->query("delete from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid'");
	$dousername=$r['username'];
	//�R�����[��
	$fid=GetMemberFormId($r['groupid']);
	DoDelMemberF($fid,$userid,$dousername);
	//�R������
	$del=$empire->query("delete from {$dbtbpre}enewsfava where userid='$userid'");
	$del=$empire->query("delete from {$dbtbpre}enewsfavaclass where userid='$userid'");
	//�R���u����
	$del=$empire->query("delete from {$dbtbpre}enewsqmsg where to_username='".$dousername."'");
	//�R���ʶR�O��
	$del=$empire->query("delete from {$dbtbpre}enewsbuybak where userid='$userid'");
	//�R���U���O��
	$del=$empire->query("delete from {$dbtbpre}enewsdownrecord where userid='$userid'");
	//�R���n�ͰO��
	$del=$empire->query("delete from {$dbtbpre}enewshy where userid='$userid'");
	$del=$empire->query("delete from {$dbtbpre}enewshyclass where userid='$userid'");
	//�R���d��
	$del=$empire->query("delete from {$dbtbpre}enewsmembergbook where userid='$userid'");
	//�R�����X
	$del=$empire->query("delete from {$dbtbpre}enewsmemberfeedback where userid='$userid'");
	//�R���j�w
	$del=$empire->query("delete from {$dbtbpre}enewsmember_connect where userid='$userid';");
    if($sql)
	{
	    insert_dolog("userid=".$userid."<br>username=".$dousername);//�ާ@��x
		printerror("DelMemberSuccess","ListMember.php".hReturnEcmsHashStrHref2(1));
	}
    else
	{
		printerror("DbError","history.go(-1)");
	}
}

//��x��q�R���|��
function admin_DelMember_all($userid,$logininid,$loginin){
	global $empire,$dbtbpre;
    CheckLevel($logininid,$loginin,$classid,"member");//�����v��
    $count=count($userid);
    if(!$count)
	{
		 printerror("NotDelMemberid","history.go(-1)");
	}
	$dh="";
	for($i=0;$i<$count;$i++)
	{
		$euid=(int)$userid[$i];
		//�R���u����
		$ur=$empire->fetch1("select ".eReturnSelectMemberF('username,groupid')." from ".eReturnMemberTable()." where ".egetmf('userid')."='".$euid."'");
		if(empty($ur['username']))
		{
			continue;
		}
		$dousername=$ur['username'];
		//�R�����[��
		$fid=GetMemberFormId($ur['groupid']);
		DoDelMemberF($fid,$euid,$dousername);
		$del=$empire->query("delete from {$dbtbpre}enewsqmsg where to_username='".$dousername."'");
		//���X
		$inid.=$dh.$euid;
		$dh=",";
    }
	if(empty($inid))
	{
		printerror("NotDelMemberid","history.go(-1)");
	}
	$add=egetmf('userid')." in (".$inid.")";
	$adda="userid in (".$inid.")";
	$sql=$empire->query("delete from ".eReturnMemberTable()." where ".$add);
	//�R������
	$del=$empire->query("delete from {$dbtbpre}enewsfava where ".$adda);
	$del=$empire->query("delete from {$dbtbpre}enewsfavaclass where ".$adda);
	//�R���ʶR�O��
	$del=$empire->query("delete from {$dbtbpre}enewsbuybak where ".$adda);
	//�R���U���O��
	$del=$empire->query("delete from {$dbtbpre}enewsdownrecord where ".$adda);
	//�R���n�ͰO��
	$del=$empire->query("delete from {$dbtbpre}enewshy where ".$adda);
	$del=$empire->query("delete from {$dbtbpre}enewshyclass where ".$adda);
	//�R���d��
	$del=$empire->query("delete from {$dbtbpre}enewsmembergbook where ".$adda);
	//�R�����X
	$del=$empire->query("delete from {$dbtbpre}enewsmemberfeedback where ".$adda);
	//�R���j�w
	$del=$empire->query("delete from {$dbtbpre}enewsmember_connect where ".$adda);
	if($sql)
	{
	    insert_dolog("");//�ާ@��x
		printerror("DelMemberSuccess","ListMember.php".hReturnEcmsHashStrHref2(1));
    }
	else
	{
		printerror("DbError","history.go(-1)");
    }
}

//�f�ַ|��
function admin_DoCheckMember_all($userid,$logininid,$loginin){
	global $empire,$dbtbpre;
    CheckLevel($logininid,$loginin,$classid,"member");//�����v��
    $count=count($userid);
    if(!$count)
	{
		 printerror("NotChangeDoCheckMember","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$dh=",";
		if($i==0)
		{
			$dh="";
		}
		//���X
		$inid.=$dh.intval($userid[$i]);
	}
	$sql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('checked')."=1 where ".egetmf('userid')." in (".$inid.")");
	if($sql)
	{
		insert_dolog("");//�ާ@��x
		printerror("DoCheckMemberSuccess","ListMember.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//��x�M�z�|��
function admin_ClearMember($add,$logininid,$loginin){
	global $empire,$dbtbpre,$level_r;
    CheckLevel($logininid,$loginin,$classid,"member");//�����v��
	//�ܶq�B�z
	$username=RepPostVar($add['username']);
	$email=RepPostStr($add['email']);
	$startuserid=(int)$add['startuserid'];
	$enduserid=(int)$add['enduserid'];
	$groupid=(int)$add['groupid'];
	$startregtime=RepPostVar($add['startregtime']);
	$endregtime=RepPostVar($add['endregtime']);
	$startuserfen=(int)$add['startuserfen'];
	$enduserfen=(int)$add['enduserfen'];
	$startmoney=(int)$add['startmoney'];
	$endmoney=(int)$add['endmoney'];
	$checked=(int)$add['checked'];
	$where='';
	if($username)
	{
		$where.=" and ".egetmf('username')." like '%$username%'";
	}
	if($email)
	{
		$where.=" and ".egetmf('email')." like '%$email%'";
	}
	if($enduserid)
	{
		$where.=' and '.egetmf('userid').' BETWEEN '.$startuserid.' and '.$enduserid;
	}
	if($groupid)
	{
		$where.=" and ".egetmf('groupid')."='$groupid'";
	}
	if($startregtime&&$endregtime)
	{
		$startregtime=to_time($startregtime);
		$endregtime=to_time($endregtime);
		$where.=" and ".egetmf('registertime').">='$startregtime' and ".egetmf('registertime')."<='$endregtime'";
	}
	if($enduserfen)
	{
		$where.=' and '.egetmf('userfen').' BETWEEN '.$startuserfen.' and '.$enduserfen;
	}
	if($endmoney)
	{
		$where.=' and '.egetmf('money').' BETWEEN '.$startmoney.' and '.$endmoney;
	}
	if($checked)
	{
		$checkval=$checked==1?1:0;
		$where.=" and ".egetmf('checked')."='$checkval'";
	}
    if(!$where)
	{
		 printerror("EmptyClearMember","history.go(-1)");
	}
	$where=substr($where,5);
	$sql=$empire->query("select ".eReturnSelectMemberF('userid,username,groupid')." from ".eReturnMemberTable()." where ".$where);
	$dh='';
	$inid='';
	while($r=$empire->fetch($sql))
	{
		$euid=$r['userid'];
		//�R���u����
		$dousername=$r['username'];
		//�R�����[��
		$fid=GetMemberFormId($r['groupid']);
		DoDelMemberF($fid,$euid,$dousername);
		$empire->query("delete from {$dbtbpre}enewsqmsg where to_username='".$dousername."'");
		//���X
		$inid.=$dh.$euid;
		$dh=',';
    }
	if($inid)
	{
		$addw=egetmf('userid')." in (".$inid.")";
		$addaw="userid in (".$inid.")";
		$sql=$empire->query("delete from ".eReturnMemberTable()." where ".$addw);
		//�R������
		$del=$empire->query("delete from {$dbtbpre}enewsfava where ".$addaw);
		$del=$empire->query("delete from {$dbtbpre}enewsfavaclass where ".$addaw);
		//�R���ʶR�O��
		$del=$empire->query("delete from {$dbtbpre}enewsbuybak where ".$addaw);
		//�R���U���O��
		$del=$empire->query("delete from {$dbtbpre}enewsdownrecord where ".$addaw);
		//�R���n�ͰO��
		$del=$empire->query("delete from {$dbtbpre}enewshy where ".$addaw);
		$del=$empire->query("delete from {$dbtbpre}enewshyclass where ".$addaw);
		//�R���d��
		$del=$empire->query("delete from {$dbtbpre}enewsmembergbook where ".$addaw);
		//�R�����X
		$del=$empire->query("delete from {$dbtbpre}enewsmemberfeedback where ".$addaw);
		//�R���j�w
		$del=$empire->query("delete from {$dbtbpre}enewsmember_connect where ".$addaw);
	}
	insert_dolog("");//�ާ@��x
	printerror("DelMemberSuccess","ClearMember.php".hReturnEcmsHashStrHref2(1));
}

//��q�ذe�I��
function GetFen_all($cardfen,$userid,$username){
	global $empire,$dbtbpre;
	$cardfen=(int)$cardfen;
	if(!$cardfen)
	{printerror("EmptyGetFen","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"card");
	$sql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."+$cardfen");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("cardfen=$cardfen");
		printerror("GetFenSuccess","GetFen.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}
?>