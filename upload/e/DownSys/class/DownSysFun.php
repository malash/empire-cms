<?php
$DownSys_CheckIp=0;	//�U�����ҽX�˴��Τ�IP�A0�����}�ҡA1���}��

//��^�˴�IP
function ReturnDownSysCheckIp(){
	global $DownSys_CheckIp;
	$ip=$DownSys_CheckIp?egetip():'127.0.0.1';
	return $ip;
}

//�U���n��
function DownSoft($classid,$id,$pathid,$p,$pass){
	global $empire,$dbtbpre,$public_r,$level_r,$class_r,$emod_r,$ecms_config;
	//����IP
	eCheckAccessDoIp('downinfo');
	$id=(int)$id;
	$classid=(int)$classid;
	$pathid=(int)$pathid;
	if(empty($id)||empty($p)||empty($classid))
	{
		printerror("ErrorUrl","history.go(-1)",1);
	}
	$p=RepPostVar($p);
	$p_r=explode(":::",$p);
	$userid=$p_r[0];
	$rnd=$p_r[1];
	//���ҽX
	$cpass=md5(ReturnDownSysCheckIp()."wm_chief".$public_r[downpass].$userid);
	if($cpass<>$pass)
	{
		printerror("FailDownpass","history.go(-1)",1);
    }
	//���s�b
	if(empty($class_r[$classid][tbname]))
	{
		printerror("ExiestSoftid","history.go(-1)",1);
	}
	$mid=$class_r[$classid][modid];
	$tbname=$class_r[$classid][tbname];
	$ok=1;
	$r=$empire->fetch1("select * from {$dbtbpre}ecms_".$tbname." where id='$id' limit 1");
	if(empty($r['id'])||$r['classid']!=$classid)
	{
		printerror("ExiestSoftid","history.go(-1)",1);
	}
	//�ƪ�
	$finfor=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$r[id]' limit 1");
	$r=array_merge($r,$finfor);
	//�Ϥ��U���a�}
	$path_r=explode("\r\n",$r[downpath]);
	if(!$path_r[$pathid])
	{
		printerror("ExiestSoftid","history.go(-1)",1);
	}
	$showdown_r=explode("::::::",$path_r[$pathid]);
	$downgroup=$showdown_r[2];
	//�U���v��
	if($downgroup)
	{
		$userid=(int)$userid;
		$rnd=RepPostVar($rnd);
		//���o�|�����
		$u=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('rnd')."='$rnd' limit 1");
		if(empty($u['userid']))
		{printerror("MustSingleUser","history.go(-1)",1);}
		//�U�����ƭ���
		$setuserday="";
		if($level_r[$u['groupid']]['daydown'])
		{
			$setuserday=DoCheckMDownNum($userid,$u['groupid']);
		}
		if($level_r[$downgroup][level]>$level_r[$u[groupid]][level])
		{
			printerror("NotDownLevel","history.go(-1)",1);
		}
		//�I�ƬO�_����
		$showdown_r[3]=intval($showdown_r[3]);
		if($showdown_r[3])
		{
			//---------�O�_�����v�O��
			$bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$userid' and pathid='$pathid' and online=0 order by truetime desc limit 1");
			if($bakr[id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
			{}
			else
			{
				//�]��d
				if($u['userdate']-time()>0)
				{}
				//�I��
				else
				{
					if($showdown_r[3]>$u['userfen'])
					{
						printerror("NotEnoughFen","history.go(-1)",1);
					}
					//�h���I��
					$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."-".$showdown_r[3]." where ".egetmf('userid')."='$userid'");
				}
				//�ƥ��U���O��
				$utfusername=$u['username'];
				BakDown($classid,$id,$pathid,$userid,$utfusername,$r[title],$showdown_r[3],0);
			}
		}
		//��s�Τ�U������
		if($setuserday)
		{
			$usql=$empire->query($setuserday);
		}
	}
	//�`�U���ƾڼW�@
    $usql=$empire->query("update {$dbtbpre}ecms_".$class_r[$classid][tbname]." set totaldown=totaldown+1 where id='$id'");
    $downurl=stripSlashes($showdown_r[1]);
	$downurlr=ReturnDownQzPath($downurl,$showdown_r[4]);
	$downurl=$downurlr['repath'];
	//���s��
	@include(ECMS_PATH."e/DownSys/class/enpath.php");
	$downurl=DoEnDownpath($downurl);
    db_close();
    $empire=null;
	DoTypeForDownurl($downurl,$downurlr['downtype']);
}

//�U���ާ@
function DoTypeForDownurl($downurl,$type=0){
	global $public_r;
	if($type==1)//meta
	{
		echo"<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;url=$downurl\">";
	}
	elseif($type==2)//read
	{
		QDownLoadFile($downurl);
	}
	else//header
	{
		Header("Location:$downurl");
	}
	exit();
}

//�U��
function QDownLoadFile($file){
	global $public_r;
	if(strstr($file,"\\"))
	{
		$exp="\\";
	}
	elseif(strstr($file,"/"))
	{
		$exp="/";
	}
	else
	{
		Header("Location:$file");
		exit();
	}
	if(strstr($file,$exp."e".$exp)||strstr($file,"..")||strstr($file,"?")||strstr($file,"#"))
	{
		Header("Location:$file");
		exit();
    }
	$efileurl=eReturnFileUrl();
	if(strstr($file,$efileurl))
	{
		$file=str_replace($efileurl,'/d/file/',$file);
	}
	if(!strstr($file,"://"))
	{
		if(!file_exists($file))
		{
			$file=eReturnEcmsMainPortPath().substr($file,1);
		}
	}
	$filename=GetDownurlFilename($file,$exp);
	if(empty($filename))
	{
		Header("Location:$file");
		exit();
	}
	//�U��
	Header("Content-type: application/octet-stream");
	//Header("Accept-Ranges: bytes");
	//Header("Accept-Length: ".$filesize);
	Header("Content-Disposition: attachment; filename=".$filename);
	echo ReadFiletext($file);
}

//���o�U�����W
function GetDownurlFilename($file,$expstr){
	$r=explode($expstr,$file);
	$count=count($r)-1;
	$filename=$r[$count];
	return $filename;
}

//----------------------�b�u�q�v�ҫ�
//���o���ҽX
function GetOnlinePass(){
	global $public_r;
	$onlinep=$public_r[downpass]."qweirtydui4opttt.,mvcfvxzzf3dsfm,.dsa";
	$r[0]=time();
	$r[1]=md5($onlinep.$r[0]);
	return $r;
}

//�������ҽX
function CheckOnlinePass($onlinetime,$onlinepass){
	global $movtime,$public_r;
	if($onlinetime+$movtime<time()||$onlinetime>time())
	{
		exit();
	}
	$onlinep=$public_r[downpass]."qweirtydui4opttt.,mvcfvxzzf3dsfm,.dsa";
	$cpass=md5($onlinep.$onlinetime);
	if($onlinepass<>$cpass)
	{
		exit();
	}
}

//--------���o�n��a�}
function GetSofturl($classid,$id,$pathid,$p,$pass,$onlinetime,$onlinepass){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r,$level_r,$ecms_config;
	//����IP
	eCheckAccessDoIp('onlineinfo');
	$classid=(int)$classid;
	$id=(int)$id;
	$pathid=(int)$pathid;
	$onlinetime=(int)$onlinetime;
	$p=RepPostVar($p);
	if(!$classid||empty($id)||empty($p))
	{exit();}
	$p_r=explode(":::",$p);
	$userid=$p_r[0];
	$rnd=$p_r[1];
	//���ҽX
	$cpass=md5(ReturnDownSysCheckIp()."wm_chief".$public_r[downpass].$userid);
	if($cpass<>$pass)
	{exit();}
	//�������ҽX
	CheckOnlinePass($onlinetime,$onlinepass);
	//���s�b
	if(empty($class_r[$classid][tbname]))
	{exit();}
	$mid=$class_r[$classid][modid];
	$tbname=$class_r[$classid][tbname];
	$r=$empire->fetch1("select * from {$dbtbpre}ecms_".$tbname." where id='$id' limit 1");
	if(empty($r['id'])||$r['classid']!=$classid)
	{exit();}
	//�ƪ�
	$finfor=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$r[id]' limit 1");
	$r=array_merge($r,$finfor);
	//�Ϥ��U���a�}
	$path_r=explode("\r\n",$r[onlinepath]);
	if(!$path_r[$pathid])
	{
		exit();
	}
	$showdown_r=explode("::::::",$path_r[$pathid]);
	$downgroup=$showdown_r[2];
	//�U���v��
	if($downgroup)
	{
		$userid=(int)$userid;
		$rnd=RepPostVar($rnd);
		//���o�|�����
		$u=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('rnd')."='$rnd' limit 1");
		if(empty($u['userid']))
		{exit();}
		//�U�����ƭ���
		$setuserday="";
		if($level_r[$u['groupid']]['daydown'])
		{
			$setuserday=DoCheckMDownNum($userid,$u['groupid'],1);
		}
		if($level_r[$downgroup][level]>$level_r[$u[groupid]][level])
		{
			exit();
		}
		//�I�ƬO�_����
		$showdown_r[3]=intval($showdown_r[3]);
		if($showdown_r[3])
		{
			//---------�O�_�����v�O��
		    $bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$userid' and pathid='$pathid' and online=1 order by truetime desc limit 1");
			if($bakr[id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
			{}
			else
			{
				//�]��d
				if($u['userdate']-time()>0)
				{}
				//�I��
				else
				{
			       if($showdown_r[3]>$u['userfen'])
			       {
					   exit();
			       }
			       //�h���I��
				   $usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."-".$showdown_r[3]." where ".egetmf('userid')."='$userid'");
				}
				//�ƥ��U���O��
				$utfusername=$u['username'];
				BakDown($classid,$id,$pathid,$userid,$utfusername,$r[title],$showdown_r[3],1);
			}
		}
		//��s�Τ�U������
		if($setuserday)
		{
			$usql=$empire->query($setuserday);
		}
	}
	//�`�U���ƾڼW�@
    $usql=$empire->query("update {$dbtbpre}ecms_".$class_r[$classid][tbname]." set totaldown=totaldown+1 where id='$id'");
	//��ܼ���
	$ftype=GetFiletype($showdown_r[1]);
	if(strstr($ecms_config['sets']['realplayertype'],','.$ftype.','))
	{
		Header("Content-Type: audio/x-pn-realaudio");
	}
	else
	{
		Header("Content-Type: video/x-ms-asf");
	}
    $downurl=stripSlashes($showdown_r[1]);
	$downurlr=ReturnDownQzPath($downurl,$showdown_r[4]);
	$downurl=$downurlr['repath'];
	//���s��
	@include(ECMS_PATH."e/DownSys/class/enpath.php");
	$downurl=DoEnOnlinepath($downurl);
    db_close();
    $empire=null;
	echo $downurl;
	exit();
}
?>