<?php
if(!defined('empirecms'))
{
	exit();
}

//返回權限列表
function ShowViewInfoLevels($groupid){
	global $level_r;
	if(empty($groupid))
	{
		return '至少會員';
	}
	$r=explode(',',$groupid);
	$count=count($r)-1;
	$groups='';
	$dh='';
	for($i=1;$i<$count;$i++)
	{
		$groups.=$dh.$level_r[$r[$i]][groupname];
		$dh=',';
	}
	return $groups;
}

//顯示提示頁面
function ShowViewInfoMsg($r,$msg){
	global $public_r,$check_path,$level_r,$class_r,$public_diyr;
	//查看權限
	if(empty($r['userfen']))
	{
		if($class_r[$r[classid]]['cgtoinfo'])//欄目設置
		{
			$ViewLevel="需要 [".ShowViewInfoLevels($r['eclass_cgroupid'])."] 級別才能查看。";
		}
		else
		{
			$ViewLevel="需要 [".$level_r[$r[groupid]][groupname]."] 級別以上才能查看。";
		}
	}
	else
	{
		if($class_r[$r[classid]]['cgtoinfo'])//欄目設置
		{
			$ViewLevel="需要 [".ShowViewInfoLevels($r['eclass_cgroupid'])."] 級別與扣除 ".$r['userfen']." 點積分才能查看。";
		}
		else
		{
			$ViewLevel="需要 [".$level_r[$r[groupid]][groupname]."] 級別以上與扣除 ".$r['userfen']." 點積分才能查看。";
		}
	}
	$r['title']=stripSlashes($r['title']);
	$public_diyr['pagetitle']=$r['title'];
	$url="<a href='".$public_r[newsurl]."'>首頁</a>&nbsp;>&nbsp;<a href='".$public_r[newsurl]."e/member/cp/'>會員中心</a>&nbsp;>&nbsp;查看信息：".$r['title'];
	include($check_path."e/data/template/cp_1.php");
	?>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25">提示信息</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><?=$msg?></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="2">標題：
      <?=$r[title]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">查看權限：</td>
    <td height="25">
      <?=$ViewLevel?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="17%" height="25">發佈時間：</td>
    <td width="83%" height="25"> 
      <?=date("Y-m-d H:i:s",$r[newstime])?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">信息簡介：</td>
    <td height="25"> 
      <?=ReturnTheIntroField($r)?>
    </td>
  </tr>
	</table>
	<?php
	include($check_path."e/data/template/cp_2.php");
	exit();
}

//返回簡介字段
function ReturnTheIntroField($r){
	global $public_r,$class_r,$emod_r,$check_tbname;
	$sublen=120;//截取120個字
	$mid=$class_r[$r[classid]]['modid'];
	$smalltextf=$emod_r[$mid]['smalltextf'];
	$stf=$emod_r[$mid]['savetxtf'];
	//簡介
	$value='';
	$showf='';
	if($smalltextf&&$smalltextf<>',')
	{
		$smr=explode(',',$smalltextf);
		$smcount=count($smr)-1;
		for($i=1;$i<$smcount;$i++)
		{
			$smf=$smr[$i];
			if($r[$smf])
			{
				$value=$r[$smf];
				$showf=$smf;
				break;
			}
		}
	}
	if(empty($showf))
	{
		$value=strip_tags($r['newstext']);
		$value=esub($value,$sublen);
		$showf='newstext';
	}
	//存文本
	if($stf==$showf)
	{
		$value='';
	}
	return stripSlashes($value);
}

//是否登陸
function ViewCheckLogin($infor){
	global $empire,$public_r,$ecms_config,$toreturnurl,$gotourl;
	$userid=(int)getcvar('mluserid');
	$rnd=RepPostVar(getcvar('mlrnd'));
	if(!$userid)
	{
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		$msg="您還未登陸，<a href='$gotourl'><u>點擊這裡</u></a>進行登陸操作；註冊請<a href='".$public_r['newsurl']."e/member/register/'><u>點擊這裡</u></a>。";
		ShowViewInfoMsg($infor,$msg);
	}
	$cr=$empire->fetch1("select ".eReturnSelectMemberF('checked,userid,username,groupid,userfen,userdate,zgroupid')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('rnd')."='$rnd' limit 1");
	if(!$cr['userid'])
	{
		EmptyEcmsCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		$msg="同一帳號只能一人在線，<a href='$gotourl'><u>點擊這裡</u></a>重新登陸；註冊請<a href='".$public_r['newsurl']."e/member/register/'><u>點擊這裡</u></a>。";
		ShowViewInfoMsg($infor,$msg);
	}
	if($cr['checked']==0)
	{
		EmptyEcmsCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		$msg="您的帳號還未審核通過，<a href='$gotourl'><u>點擊這裡</u></a>重新登陸；註冊請<a href='".$public_r['newsurl']."e/member/register/'><u>點擊這裡</u></a>。";
		ShowViewInfoMsg($infor,$msg);
	}
	//默認會員組
	if(empty($cr['groupid']))
	{
		$user_groupid=eReturnMemberDefGroupid();
		$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('groupid')."='$user_groupid' where ".egetmf('userid')."='".$cr[userid]."'");
		$cr['groupid']=$user_groupid;
	}
	//是否過期
	if($cr['userdate'])
	{
		if($cr['userdate']-time()<=0)
		{
			OutTimeZGroup($cr['userid'],$cr['zgroupid']);
			$cr['userdate']=0;
			if($cr['zgroupid'])
			{
				$cr['groupid']=$cr['zgroupid'];
				$cr['zgroupid']=0;
			}
		}
	}
	$re[userid]=$cr['userid'];
	$re[username]=$cr['username'];
	$re[userfen]=$cr['userfen'];
	$re[groupid]=$cr['groupid'];
	$re[userdate]=$cr['userdate'];
	$re[zgroupid]=$cr['zgroupid'];
	return $re;
}

//查看權限函數
function CheckShowNewsLevel($infor){
	global $check_path,$level_r,$empire,$gotourl,$toreturnurl,$public_r,$dbtbpre,$class_r;
	$groupid=$infor['groupid'];
	$userfen=$infor['userfen'];
	$id=$infor['id'];
	$classid=$infor['classid'];
	//是否登陸
	$user_r=ViewCheckLogin($infor);
	//驗證權限
	if($class_r[$infor[classid]]['cgtoinfo'])//欄目設置
	{
		$checkcr=$empire->fetch1("select cgroupid from {$dbtbpre}enewsclass where classid='$infor[classid]'");
		if($checkcr['cgroupid'])
		{
			if(!strstr($checkcr[cgroupid],','.$user_r[groupid].','))
			{
				$infor['eclass_cgroupid']=$checkcr[cgroupid];
				if(!getcvar('returnurl'))
				{
					esetcookie("returnurl",$toreturnurl,0);
				}
				$msg="您沒有足夠權限查看此信息! <a href='$gotourl'><u>點擊這裡</u></a>重新登陸；註冊請<a href='".$public_r['newsurl']."e/member/register/'><u>點擊這裡</u></a>。";
				ShowViewInfoMsg($infor,$msg);
			}
		}
	}
	if($groupid)//信息設置
	{
		if($level_r[$groupid][level]>$level_r[$user_r[groupid]][level])
		{
			if(!getcvar('returnurl'))
			{
				esetcookie("returnurl",$toreturnurl,0);
			}
			$msg="您的會員級別不足(您的當前級別：".$level_r[$user_r[groupid]][groupname].")，沒有查看此信息的權限! <a href='$gotourl'><u>點擊這裡</u></a>重新登陸；註冊請<a href='".$public_r['newsurl']."e/member/register/'><u>點擊這裡</u></a>。";
			ShowViewInfoMsg($infor,$msg);
		}
	}
	//扣點
	if(!empty($userfen))
	{
		//是否有歷史記錄
		$bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$user_r[userid]' and online=2 order by truetime desc limit 1");
		if($bakr['id']&&(time()-$bakr['truetime']<=$public_r['redoview']*3600))
		{}
		else
		{
			if($user_r[userdate]-time()>0)//包月
			{}
			else
			{
				if($user_r[userfen]<$userfen)
				{
					if(!getcvar('returnurl'))
					{
						esetcookie("returnurl",$toreturnurl,0);
					}
					$msg="您的點數不足(您當前擁有的點數 ".$user_r[userfen]." 點)，沒有查看此信息的權限! <a href='$gotourl'><u>點擊這裡</u></a>重新登陸；註冊請<a href='".$public_r['newsurl']."e/member/register/'><u>點擊這裡</u></a>。";
					ShowViewInfoMsg($infor,$msg);
				}
				//扣點
				$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."-".$userfen." where ".egetmf('userid')."='$user_r[userid]'");
			}
			//備份下載記錄
			$utfusername=$user_r['username'];
			BakDown($classid,$id,0,$user_r['userid'],$utfusername,$infor[title],$userfen,2);
		}
	}
}
$check_infoid=(int)$check_infoid;
$check_classid=(int)$check_classid;
if(!defined('PageCheckLevel'))
{
	require_once($check_path.'e/class/connect.php');
	if(!defined('InEmpireCMS'))
	{
		exit();
	}
	require_once(ECMS_PATH.'e/class/db_sql.php');
	require_once(ECMS_PATH.'e/data/dbcache/class.php');
	require_once(ECMS_PATH.'e/data/dbcache/MemberLevel.php');
	$link=db_connect();
	$empire=new mysqlquery();
	$check_tbname=RepPostVar($check_tbname);
	$checkinfor=$empire->fetch1("select * from {$dbtbpre}ecms_".$check_tbname." where id='$check_infoid' limit 1");
	if(!$checkinfor['id']||$checkinfor['classid']!=$check_classid)
	{
		echo"<script>alert('此信息不存在');history.go(-1);</script>";
		exit();
	}
	//副表
	$check_mid=$class_r[$checkinfor[classid]]['modid'];
	$checkfinfor=$empire->fetch1("select ".ReturnSqlFtextF($check_mid)." from {$dbtbpre}ecms_".$check_tbname."_data_".$checkinfor[stb]." where id='$checkinfor[id]' limit 1");
	$checkinfor=array_merge($checkinfor,$checkfinfor);
}
else
{
	$check_tbname=RepPostVar($check_tbname);
}
require_once(ECMS_PATH.'e/member/class/user.php');
//驗證IP
eCheckAccessDoIp('showinfo');
if($checkinfor['groupid']||$class_r[$checkinfor[classid]]['cgtoinfo'])
{
	$toreturnurl=eReturnSelfPage(1);	//返回頁面地址
	$gotourl=$ecms_config['member']['loginurl']?$ecms_config['member']['loginurl']:$public_r['newsurl']."e/member/login/";	//登陸地址
	CheckShowNewsLevel($checkinfor);
}
if(!defined('PageCheckLevel'))
{
	db_close();
	$empire=null;
}
?>