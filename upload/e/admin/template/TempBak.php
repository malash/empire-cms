<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();

$temptype=RepPostVar($_GET['temptype']);
$gid=(int)$_GET['gid'];
if(!$gid)
{
	$gid=GetDoTempGid();
}
if($temptype=='indexpage')
{
	$gid=1;
}
$tempid=(int)$_GET['tempid'];
if(!$temptype||!$gid||!$tempid)
{
	printerror("ErrorUrl","history.go(-1)");
}
//操作權限
if($temptype=='tempvar')
{
	CheckLevel($logininid,$loginin,$classid,"tempvar");
}
else
{
	CheckLevel($logininid,$loginin,$classid,"template");
}
$gname=CheckTempGroup($gid);
$sql=$empire->query("select bid,tempname,baktime,lastuser from {$dbtbpre}enewstempbak where temptype='$temptype' and gid='$gid' and tempid='$tempid' order by bid desc");
$url='';
$urlgname=$gname."&nbsp;>&nbsp;";
//模板名稱
if($temptype=='bqtemp')//標籤模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsbqtemp",$gid)." where tempid='$tempid'");
	$tname='標籤模板';
	$url=$urlgname."<a href='ListBqtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理標籤模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='classtemp')//封面模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsclasstemp",$gid)." where tempid='$tempid'");
	$tname='封面模板';
	$url=$urlgname."<a href='ListClasstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理封面模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='jstemp')//JS模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsjstemp",$gid)." where tempid='$tempid'");
	$tname='JS模板';
	$url=$urlgname."<a href='ListJstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理JS模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='listtemp')//列表模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewslisttemp",$gid)." where tempid='$tempid'");
	$tname='列表模板';
	$url=$urlgname."<a href='ListListtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理列表模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='newstemp')//內容模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsnewstemp",$gid)." where tempid='$tempid'");
	$tname='內容模板';
	$url=$urlgname."<a href='ListNewstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理內容模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='pltemp')//評論模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewspltemp",$gid)." where tempid='$tempid'");
	$tname='評論模板';
	$url=$urlgname."<a href='ListPltemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理評論模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='printtemp')//打印模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsprinttemp",$gid)." where tempid='$tempid'");
	$tname='打印模板';
	$url=$urlgname."<a href='ListPrinttemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理打印模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='searchtemp')//搜索模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewssearchtemp",$gid)." where tempid='$tempid'");
	$tname='搜索模板';
	$url=$urlgname."<a href='ListSearchtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理搜索模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='tempvar')//公共模板變量
{
	$tr=$empire->fetch1("select myvar,varname from ".GetDoTemptb("enewstempvar",$gid)." where varid='$tempid'");
	$tname='公共模板變量';
	$url=$urlgname."<a href='ListTempvar.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理公共模板變量</a>&nbsp;>&nbsp;變量 <b>".$tr[myvar]." (".$tr[varname].")</b> 的修改記錄";
}
elseif($temptype=='votetemp')//投票模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsvotetemp",$gid)." where tempid='$tempid'");
	$tname='投票模板';
	$url=$urlgname."<a href='ListVotetemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理投票模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='pagetemp')//自定義頁面模板
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewspagetemp",$gid)." where tempid='$tempid'");
	$tname='自定義頁面模板';
	$url=$urlgname."<a href='ListPagetemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理自定義頁面模板</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
elseif($temptype=='indexpage')//首頁方案模板
{
	$tr=$empire->fetch1("select tempname from {$dbtbpre}enewsindexpage where tempid='$tempid'");
	$tname='首頁方案';
	$url=$urlgname."<a href='ListIndexpage.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>管理首頁方案</a>&nbsp;>&nbsp;模板 <b>$tr[tempname]</b> 的修改記錄";
}
//公共模板
elseif($temptype=='pubindextemp')//首頁模板
{
	$tname='首頁模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>首頁模板</b> 的修改記錄";
}
elseif($temptype=='pubcptemp')//控制面板模板
{
	$tname='控制面板模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>控制面板模板</b> 的修改記錄";
}
elseif($temptype=='pubsearchtemp')//高級搜索表單模板
{
	$tname='高級搜索表單模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>高級搜索表單模板</b> 的修改記錄";
}
elseif($temptype=='pubsearchjstemp')//搜索JS模板[橫向]
{
	$tname='搜索JS模板[橫向]';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>搜索JS模板[橫向]</b> 的修改記錄";
}
elseif($temptype=='pubsearchjstemp1')//搜索JS模板[縱向]
{
	$tname='搜索JS模板[縱向]';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>搜索JS模板[縱向]</b> 的修改記錄";
}
elseif($temptype=='pubotherlinktemp')//相關鏈接模板
{
	$tname='相關鏈接模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>相關鏈接模板</b> 的修改記錄";
}
elseif($temptype=='pubdownsofttemp')//下載地址模板
{
	$tname='下載地址模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>下載地址模板</b> 的修改記錄";
}
elseif($temptype=='pubonlinemovietemp')//在線播放地址模板
{
	$tname='在線播放地址模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>在線播放地址模板</b> 的修改記錄";
}
elseif($temptype=='publistpagetemp')//列表分頁模板
{
	$tname='列表分頁模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>列表分頁模板</b> 的修改記錄";
}
elseif($temptype=='pubpljstemp')//評論JS調用模板
{
	$tname='評論JS調用模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>評論JS調用模板</b> 的修改記錄";
}
elseif($temptype=='pubdownpagetemp')//最終下載頁模板
{
	$tname='最終下載頁模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>最終下載頁模板</b> 的修改記錄";
}
elseif($temptype=='pubgbooktemp')//留言板模板
{
	$tname='留言板模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>留言板模板</b> 的修改記錄";
}
elseif($temptype=='publoginiframe')//登陸狀態模板
{
	$tname='登陸狀態模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>登陸狀態模板</b> 的修改記錄";
}
elseif($temptype=='publoginjstemp')//JS調用登陸狀態模板
{
	$tname='JS調用登陸狀態模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>JS調用登陸狀態模板</b> 的修改記錄";
}
elseif($temptype=='pubschalltemp')//全站搜索模板
{
	$tname='全站搜索模板';
	$url=$urlgname."公共模板&nbsp;>&nbsp;<b>全站搜索模板</b> 的修改記錄";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$tname?> 的修改記錄</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript">
window.resizeTo(550,600);
window.focus();
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
    <td height="25">位置：<?=$url?></td>
    </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="52%" height="25"> <div align="center">修改時間</div></td>
    <td width="29%" height="25"> <div align="center">修改者</div></td>
    <td width="19%"><div align="center">還原</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><div align="center"> 
        <?=date("Y-m-d H:i:s",$r['baktime'])?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r['lastuser']?>
      </div></td>
    <td><div align="center">[<a href="../ecmstemp.php?enews=ReEBakTemp&bid=<?=$r['bid']?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要還原?');">還原</a>]</div></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>