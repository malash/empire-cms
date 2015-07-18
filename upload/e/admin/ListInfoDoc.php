<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
require("../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();

$classid=(int)$_GET['classid'];
$bclassid=(int)$class_r[$classid]['bclassid'];
//取得欄目名
if(!$class_r[$classid][classid]||!$class_r[$classid][tbname])
{
	printerror("ErrorUrl","history.go(-1)");
}
//驗證權限
$doselfinfo=CheckLevel($logininid,$loginin,$classid,"news");
//取得模型表
$fieldexp="<!--field--->";
$recordexp="<!--record-->";
//返回搜索字段列表
function ReturnSearchOptions($enter,$field,$record){
	global $modid,$emod_r;
	$r=explode($record,$enter);
	$count=count($r)-1;
	for($i=0;$i<$count;$i++)
	{
		if($i==0)
		{
			$or="";
		}
		else
		{
			$or=" or ";
		}
		$r1=explode($field,$r[$i]);
		if($r1[1]=="special.field"||strstr($emod_r[$modid]['tbdataf'],','.$r1[1].','))
		{
			continue;
		}
		if($r1[1]=="id")
		{
			$sr['searchallfield'].=$or.$r1[1]."='[!--key--]'";
			$sr['select'].="<option value=\"".$r1[1]."\">".$r1[0]."</option>";
			continue;
		}
		$sr['searchallfield'].=$or.$r1[1]." like '%[!--key--]%'";
		$sr['select'].="<option value=\"".$r1[1]."\">".$r1[0]."</option>";
	}
	return $sr;
}
$modid=(int)$class_r[$classid][modid];
$infomod_r=$empire->fetch1("select enter,tbname,sonclass,listfile from {$dbtbpre}enewsmod where mid=".$modid);
if(empty($infomod_r['tbname']))
{
	printerror("ErrorUrl","history.go(-1)");
}
$infomod_r['enter'].='發佈者<!--field--->username<!--record-->ID<!--field--->id<!--record-->';
$searchoptions_r=ReturnSearchOptions($infomod_r['enter'],$fieldexp,$recordexp);
//審核表
$search='';
$search.=$ecms_hashur['ehref'];
$addecmscheck='';
$ecmscheck=(int)$_GET['ecmscheck'];
$indexchecked=1;
if($ecmscheck)
{
	$search.='&ecmscheck='.$ecmscheck;
	$addecmscheck='&ecmscheck='.$ecmscheck;
	$indexchecked=0;
}
$infotb=ReturnInfoMainTbname($class_r[$classid][tbname],$indexchecked);
//導航
$url=AdminReturnClassLink($classid).'&nbsp;>&nbsp;管理歸檔&nbsp;&nbsp;(<a href="AddNews.php?enews=AddNews&bclassid='.$bclassid.'&classid='.$classid.$addecmscheck.$ecms_hashur['ehref'].'">增加信息</a>)';
$start=0;
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$line=intval($public_r['hlistinfonum']);//每頁顯示
$page_line=16;
$offset=$page*$line;
$search.="&bclassid=$bclassid&classid=$classid";
$add='';
$ewhere='';
//搜索
$sear=RepPostStr($_GET['sear'],1);
if($sear)
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	$show=RepPostVar($_GET['show']);
	//關鍵字
	if($keyboard)
	{
		//搜索全部
		if(!$show)
		{
			$add=" and (".str_replace("[!--key--]",$keyboard,$searchoptions_r['searchallfield']).")";
		}
		//搜索字段
		elseif($show&&strstr($infomod_r['enter'],"<!--field--->".$show."<!--record-->"))
		{
			$add=$show!="id"?" and (".$show." like '%$keyboard%')":" and (".$show."='$keyboard')";
			$searchoptions_r['select']=str_replace(" value=\"".$show."\">"," value=\"".$show."\" selected>",$searchoptions_r['select']);
		}
	}
	//標題分類
	$ttid=(int)$_GET['ttid'];
	if($ttid)
	{
		$add.=" and ttid='$ttid'";
	}
	$search.="&sear=1&keyboard=$keyboard&show=$show&ttid=$ttid";
}
//只能編輯自己的信息
if($doselfinfo['doselfinfo'])
{
	$add.=" and userid='$logininid' and ismember=0";
}
//單欄目單表
$singletable=0;
if($infomod_r[sonclass]=='|'.$classid.'|')
{
	$singletablenum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsclass where tbname='".$class_r[$classid][tbname]."' and islast=1");
	$singletable=$singletablenum==1?1:0;
}
if($infomod_r[sonclass]=='|'.$classid.'|'&&$singletable==1)
{
	$ewhere=$add?' where '.substr($add,5):'';
}
else
{
	$ewhere=" where classid='$classid'".$add;
}
//統計
$totalquery="select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_doc".$ewhere;
$totalnum=(int)$_GET['totalnum'];
if($totalnum<1)
{
	$num=$empire->gettotal($totalquery);//取得總條數
}
else
{
	$num=$totalnum;
}
//排序
$myorder=RepPostStr($_GET['myorder'],1);
if($myorder==1)//時間
{$doorder="newstime desc";}
elseif($myorder==2)//評論數
{$doorder="plnum desc";}
elseif($myorder==3)//人氣
{$doorder="onclick desc";}
elseif($myorder==4)//ID號
{$doorder="id desc";}
else//默認排序
{
	$thisclassr=$empire->fetch1("select listorder from {$dbtbpre}enewsclass where classid='$classid'");
	if(empty($thisclassr[listorder]))
	{
		$doorder="id desc";
	}
	else
	{
		$doorder=$thisclassr[listorder];
	}
}
$search.="&totalnum=$num";
$search1=$search;
$search.="&myorder=$myorder";
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$phpmyself=urlencode(eReturnSelfPage(1));
//標題分類
$tts='';
$ttsql=$empire->query("select typeid,tname from {$dbtbpre}enewsinfotype where mid='$modid' order by myorder");
while($ttr=$empire->fetch($ttsql))
{
	$select='';
	if($ttr[typeid]==$ttid)
	{
		$select=' selected';
	}
	$tts.="<option value='$ttr[typeid]'".$select.">$ttr[tname]</option>";
}
$stts=$tts?"<select name='ttid'><option value='0'>標題分類</option>$tts</select>":"";
//欄目鏈接
$getcurlr['classid']=$classid;
$classurl=sys_ReturnBqClassname($getcurlr,9);
//導入頁面
$deftempfile=ECMS_PATH.'e/data/html/list/doclistinfo.php';
if($infomod_r[listfile])
{
	$tempfile=ECMS_PATH.'e/data/html/list/doc'.$infomod_r[listfile].'.php';
	if(!file_exists($tempfile))
	{
		$tempfile=$deftempfile;
	}
}
else
{
	$tempfile=$deftempfile;
}
require($tempfile);
db_close();
$empire=null;
?>
