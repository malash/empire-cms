<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../class/qinfofun.php");
require("../member/class/user.php");
require("../data/dbcache/class.php");
require("../data/dbcache/MemberLevel.php");
$link=db_connect();
$empire=new mysqlquery();
if($public_r['addnews_ok'])//關閉投稿
{
	printerror("NotOpenCQInfo","",1);
}
//驗證本時間允許操作
eCheckTimeCloseDo('info');
//驗證IP
eCheckAccessDoIp('postinfo');
$classid=(int)$_GET['classid'];
$mid=$class_r[$classid]['modid'];
if(empty($classid)||empty($mid)||InfoIsInTable($class_r[$classid]['tbname']))
{
	printerror("EmptyQinfoCid","",1);
}
$enews=RepPostStr($_GET['enews'],1);
if(empty($enews))
{
	$enews="MAddInfo";
}
$r=array();
$memberinfor=array();
$muserid=(int)getcvar('mluserid');
$musername=RepPostVar(getcvar('mlusername'));
$mrnd=RepPostVar(getcvar('mlrnd'));
$id=0;
$newstime=time();
$r[newstime]=date("Y-m-d H:i:s");
$todaytime=$r[newstime];
$showkey="";
$r['newstext']="";
$rechangeclass='';
//驗證會員信息
$mloginauthr=qCheckLoginAuthstr();
//取得登陸會員資料
if($muserid&&$mloginauthr['islogin'])
{
	$memberinfor=$empire->fetch1("select ".eReturnSelectMemberF('*','u.').",ui.* from ".eReturnMemberTable()." u LEFT JOIN {$dbtbpre}enewsmemberadd ui ON u.".egetmf('userid')."=ui.userid where u.".egetmf('userid')."='$muserid' limit 1");
}
//增加
if($enews=="MAddInfo")
{
	$cr=DoQCheckAddLevel($classid,$muserid,$musername,$mrnd,0,1);
	$mr=$empire->fetch1("select qenter,qmname from {$dbtbpre}enewsmod where mid='$cr[modid]'");
	if(empty($mr['qenter']))
	{
		printerror("NotOpenCQInfo","history.go(-1)",1);
	}
	//IP發佈數限制
	$check_ip=egetip();
	$check_checked=$cr['wfid']?0:$cr['checkqadd'];
	eCheckIpAddInfoNum($check_ip,$cr['tbname'],$cr['modid'],$check_checked);
	//初始變量
	$word="增加信息";
	$ecmsfirstpost=1;
	$rechangeclass="&nbsp;[<a href='ChangeClass.php?mid=".$mid."'>重新選擇</a>]";
	//驗證碼
	if($cr['qaddshowkey'])
	{
		$showkey="<tr bgcolor=\"#FFFFFF\">
      <td width=\"11%\" height=\"25\">驗證碼</td>
      <td height=\"25\"><input name=\"key\" type=\"text\" size=\"6\">
        <img src=\"../ShowKey/?v=info\" name=\"infoKeyImg\" id=\"infoKeyImg\" onclick=\"infoKeyImg.src='../ShowKey/?v=info&t='+Math.random()\" title=\"看不清楚,點擊刷新\"></td></tr>";
	}
	//圖片
	$imgwidth=0;
	$imgheight=0;
	//文件驗證碼
	$filepass=time();
}
else
{
	$word="修改信息";
	$ecmsfirstpost=0;
	$id=(int)$_GET['id'];
	if(empty($id))
	{
		printerror("EmptyQinfoCid","",1);
	}
	$cr=DoQCheckAddLevel($classid,$muserid,$musername,$mrnd,1,0);
	$mr=$empire->fetch1("select qenter,qmname from {$dbtbpre}enewsmod where mid='$cr[modid]'");
	if(empty($mr['qenter']))
	{
		printerror("NotOpenCQInfo","history.go(-1)",1);
	}
	$r=CheckQdoinfo($classid,$id,$muserid,$cr['tbname'],$cr['adminqinfo'],1);
	//檢測時間
	if($public_r['qeditinfotime'])
	{
		if(time()-$r['truetime']>$public_r['qeditinfotime']*60)
		{
			printerror("QEditInfoOutTime","history.go(-1)",1);
		}
	}
	$newstime=$r['newstime'];
	$r['newstime']=date("Y-m-d H:i:s",$r['newstime']);
	//圖片
	$imgwidth=170;
	$imgheight=120;
	//文件驗證碼
	$filepass=$id;
}
$tbname=$cr['tbname'];
esetcookie("qeditinfo","dgcms");
//標題分類
$cttidswhere='';
$tts='';
$caddr=$empire->fetch1("select ttids from {$dbtbpre}enewsclassadd where classid='$classid'");
if($caddr['ttids']!='-')
{
	if($caddr['ttids']&&$caddr['ttids']!=',')
	{
		$cttidswhere=' and typeid in ('.substr($caddr['ttids'],1,-1).')';
	}
	$ttsql=$empire->query("select typeid,tname from {$dbtbpre}enewsinfotype where mid='$cr[modid]'".$cttidswhere." order by myorder");
	while($ttr=$empire->fetch($ttsql))
	{
		$select='';
		if($ttr[typeid]==$r[ttid])
		{
			$select=' selected';
		}
		$tts.="<option value='$ttr[typeid]'".$select.">$ttr[tname]</option>";
	}
}
//欄目
$classurl=sys_ReturnBqClassname($cr,9);
$postclass="<a href='".$classurl."' target='_blank'>".$class_r[$classid]['classname']."</a>".$rechangeclass;
if($cr['bclassid'])
{
	$bcr['classid']=$cr['bclassid'];
	$bclassurl=sys_ReturnBqClassname($bcr,9);
	$postclass="<a href='".$bclassurl."' target=_blank>".$class_r[$cr['bclassid']]['classname']."</a>&nbsp;>&nbsp;".$postclass;
}
//html編輯器
if($emod_r[$mid]['editorf']&&$emod_r[$mid]['editorf']!=',')
{
	include('../data/ecmseditor/infoeditor/fckeditor.php');
}
if(empty($musername))
{
	$musername="遊客";
}
$modfile="../data/html/q".$cr['modid'].".php";
//導入模板
require(ECMS_PATH.'e/template/DoInfo/AddInfo.php');
db_close();
$empire=null;
?>