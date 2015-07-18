<?php
$DownSys_CheckIp=0;	//下載驗證碼檢測用戶IP，0為不開啟，1為開啟

//返回檢測IP
function ReturnDownSysCheckIp(){
	global $DownSys_CheckIp;
	$ip=$DownSys_CheckIp?egetip():'127.0.0.1';
	return $ip;
}

//下載軟件
function DownSoft($classid,$id,$pathid,$p,$pass){
	global $empire,$dbtbpre,$public_r,$level_r,$class_r,$emod_r,$ecms_config;
	//驗證IP
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
	//驗證碼
	$cpass=md5(ReturnDownSysCheckIp()."wm_chief".$public_r[downpass].$userid);
	if($cpass<>$pass)
	{
		printerror("FailDownpass","history.go(-1)",1);
    }
	//表不存在
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
	//副表
	$finfor=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$r[id]' limit 1");
	$r=array_merge($r,$finfor);
	//區分下載地址
	$path_r=explode("\r\n",$r[downpath]);
	if(!$path_r[$pathid])
	{
		printerror("ExiestSoftid","history.go(-1)",1);
	}
	$showdown_r=explode("::::::",$path_r[$pathid]);
	$downgroup=$showdown_r[2];
	//下載權限
	if($downgroup)
	{
		$userid=(int)$userid;
		$rnd=RepPostVar($rnd);
		//取得會員資料
		$u=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('rnd')."='$rnd' limit 1");
		if(empty($u['userid']))
		{printerror("MustSingleUser","history.go(-1)",1);}
		//下載次數限制
		$setuserday="";
		if($level_r[$u['groupid']]['daydown'])
		{
			$setuserday=DoCheckMDownNum($userid,$u['groupid']);
		}
		if($level_r[$downgroup][level]>$level_r[$u[groupid]][level])
		{
			printerror("NotDownLevel","history.go(-1)",1);
		}
		//點數是否足夠
		$showdown_r[3]=intval($showdown_r[3]);
		if($showdown_r[3])
		{
			//---------是否有歷史記錄
			$bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$userid' and pathid='$pathid' and online=0 order by truetime desc limit 1");
			if($bakr[id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
			{}
			else
			{
				//包月卡
				if($u['userdate']-time()>0)
				{}
				//點數
				else
				{
					if($showdown_r[3]>$u['userfen'])
					{
						printerror("NotEnoughFen","history.go(-1)",1);
					}
					//去除點數
					$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."-".$showdown_r[3]." where ".egetmf('userid')."='$userid'");
				}
				//備份下載記錄
				$utfusername=$u['username'];
				BakDown($classid,$id,$pathid,$userid,$utfusername,$r[title],$showdown_r[3],0);
			}
		}
		//更新用戶下載次數
		if($setuserday)
		{
			$usql=$empire->query($setuserday);
		}
	}
	//總下載數據增一
    $usql=$empire->query("update {$dbtbpre}ecms_".$class_r[$classid][tbname]." set totaldown=totaldown+1 where id='$id'");
    $downurl=stripSlashes($showdown_r[1]);
	$downurlr=ReturnDownQzPath($downurl,$showdown_r[4]);
	$downurl=$downurlr['repath'];
	//防盜鏈
	@include(ECMS_PATH."e/DownSys/class/enpath.php");
	$downurl=DoEnDownpath($downurl);
    db_close();
    $empire=null;
	DoTypeForDownurl($downurl,$downurlr['downtype']);
}

//下載操作
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

//下載
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
	//下載
	Header("Content-type: application/octet-stream");
	//Header("Accept-Ranges: bytes");
	//Header("Accept-Length: ".$filesize);
	Header("Content-Disposition: attachment; filename=".$filename);
	echo ReadFiletext($file);
}

//取得下載文件名
function GetDownurlFilename($file,$expstr){
	$r=explode($expstr,$file);
	$count=count($r)-1;
	$filename=$r[$count];
	return $filename;
}

//----------------------在線電影模型
//取得驗證碼
function GetOnlinePass(){
	global $public_r;
	$onlinep=$public_r[downpass]."qweirtydui4opttt.,mvcfvxzzf3dsfm,.dsa";
	$r[0]=time();
	$r[1]=md5($onlinep.$r[0]);
	return $r;
}

//驗證驗證碼
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

//--------取得軟件地址
function GetSofturl($classid,$id,$pathid,$p,$pass,$onlinetime,$onlinepass){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r,$level_r,$ecms_config;
	//驗證IP
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
	//驗證碼
	$cpass=md5(ReturnDownSysCheckIp()."wm_chief".$public_r[downpass].$userid);
	if($cpass<>$pass)
	{exit();}
	//驗證驗證碼
	CheckOnlinePass($onlinetime,$onlinepass);
	//表不存在
	if(empty($class_r[$classid][tbname]))
	{exit();}
	$mid=$class_r[$classid][modid];
	$tbname=$class_r[$classid][tbname];
	$r=$empire->fetch1("select * from {$dbtbpre}ecms_".$tbname." where id='$id' limit 1");
	if(empty($r['id'])||$r['classid']!=$classid)
	{exit();}
	//副表
	$finfor=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$r[id]' limit 1");
	$r=array_merge($r,$finfor);
	//區分下載地址
	$path_r=explode("\r\n",$r[onlinepath]);
	if(!$path_r[$pathid])
	{
		exit();
	}
	$showdown_r=explode("::::::",$path_r[$pathid]);
	$downgroup=$showdown_r[2];
	//下載權限
	if($downgroup)
	{
		$userid=(int)$userid;
		$rnd=RepPostVar($rnd);
		//取得會員資料
		$u=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('rnd')."='$rnd' limit 1");
		if(empty($u['userid']))
		{exit();}
		//下載次數限制
		$setuserday="";
		if($level_r[$u['groupid']]['daydown'])
		{
			$setuserday=DoCheckMDownNum($userid,$u['groupid'],1);
		}
		if($level_r[$downgroup][level]>$level_r[$u[groupid]][level])
		{
			exit();
		}
		//點數是否足夠
		$showdown_r[3]=intval($showdown_r[3]);
		if($showdown_r[3])
		{
			//---------是否有歷史記錄
		    $bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$userid' and pathid='$pathid' and online=1 order by truetime desc limit 1");
			if($bakr[id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
			{}
			else
			{
				//包月卡
				if($u['userdate']-time()>0)
				{}
				//點數
				else
				{
			       if($showdown_r[3]>$u['userfen'])
			       {
					   exit();
			       }
			       //去除點數
				   $usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."-".$showdown_r[3]." where ".egetmf('userid')."='$userid'");
				}
				//備份下載記錄
				$utfusername=$u['username'];
				BakDown($classid,$id,$pathid,$userid,$utfusername,$r[title],$showdown_r[3],1);
			}
		}
		//更新用戶下載次數
		if($setuserday)
		{
			$usql=$empire->query($setuserday);
		}
	}
	//總下載數據增一
    $usql=$empire->query("update {$dbtbpre}ecms_".$class_r[$classid][tbname]." set totaldown=totaldown+1 where id='$id'");
	//選擇播放器
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
	//防盜鏈
	@include(ECMS_PATH."e/DownSys/class/enpath.php");
	$downurl=DoEnOnlinepath($downurl);
    db_close();
    $empire=null;
	echo $downurl;
	exit();
}
?>