<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
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
//驗證權限
CheckLevel($logininid,$loginin,$classid,"template");

//增加首頁方案
function AddIndexpage($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[tempname]||!$add[temptext])
	{
		printerror("EmptyIndexpageName","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"template");
	$gid=(int)$add['gid'];
	$add[tempname]=hRepPostStr($add[tempname],1);
	$add[temptext]=RepPhpAspJspcode($add[temptext]);
	$sql=$empire->query("insert into {$dbtbpre}enewsindexpage(tempname,temptext) values('".$add[tempname]."','".eaddslashes2($add[temptext])."');");
	$tempid=$empire->lastid();
	//備份模板
	AddEBakTemp('indexpage',1,$tempid,$add[tempname],$add[temptext],0,0,'',0,0,'',0,0,0,$userid,$username);
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=$tempid&tempname=$add[tempname]");
		printerror("AddIndexpageSuccess","AddIndexpage.php?enews=AddIndexpage&gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//修改首頁方案
function EditIndexpage($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$add[tempid];
	if(!$tempid||!$add[tempname]||!$add[temptext])
	{
		printerror("EmptyIndexpageName","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"template");
	$gid=(int)$add['gid'];
	$add[tempname]=hRepPostStr($add[tempname],1);
	$add[temptext]=RepPhpAspJspcode($add[temptext]);
	$sql=$empire->query("update {$dbtbpre}enewsindexpage set tempname='".$add[tempname]."',temptext='".eaddslashes2($add[temptext])."' where tempid='$tempid'");
	//備份模板
	AddEBakTemp('indexpage',1,$tempid,$add[tempname],$add[temptext],0,0,'',0,0,'',0,0,0,$userid,$username);
	//刷新首頁
	if($tempid==$public_r['indexpageid'])
	{
		NewsBq($classid,eaddslashes($add[temptext]),1,0);
		//刪除動態模板緩存文件
		DelOneTempTmpfile('indexpage');
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=$tempid&tempname=$add[tempname]");
		printerror("EditIndexpageSuccess","ListIndexpage.php?gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//刪除首頁方案
function DelIndexpage($tempid,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$tempid;
	if(empty($tempid))
	{
		printerror("NotChangeIndexpageid","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"template");
	$gid=(int)$_GET['gid'];
	$r=$empire->fetch1("select tempname from {$dbtbpre}enewsindexpage where tempid='$tempid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsindexpage where tempid='$tempid'");
	if($tempid==$public_r['indexpageid'])
	{
		$empire->query("update {$dbtbpre}enewspublic set indexpageid=0");
		GetConfig();//更新緩存
	}
	//刪除備份記錄
	DelEbakTempAll('indexpage',1,$tempid);
	//刷新首頁
	if($tempid==$public_r['indexpageid'])
	{
		$indextempr=$empire->fetch1("select indextemp from ".GetTemptb("enewspubtemp")." limit 1");
		$indextemp=$indextempr['indextemp'];
		NewsBq($classid,$indextemp,1,0);
		//刪除動態模板緩存文件
		DelOneTempTmpfile('indexpage');
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=$tempid&tempname=$r[tempname]");
		printerror("DelIndexpageSuccess","ListIndexpage.php?gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//啟用首頁方案
function DefIndexpage($tempid,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$tempid;
	if(empty($tempid))
	{
		printerror("NotChangeIndexpageid","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"template");
	$gid=(int)$_GET['gid'];
	$r=$empire->fetch1("select tempname,temptext from {$dbtbpre}enewsindexpage where tempid='$tempid'");
	if($tempid==$public_r['indexpageid'])
	{
		$def=0;
		$mess='NoDefIndexpageSuccess';
		$sql=$empire->query("update {$dbtbpre}enewspublic set indexpageid=0");
	}
	else
	{
		$def=1;
		$mess='DefIndexpageSuccess';
		$sql=$empire->query("update {$dbtbpre}enewspublic set indexpageid='$tempid'");
	}
	GetConfig();//更新緩存
	//刷新首頁
	if($def)
	{
		NewsBq($classid,$r[temptext],1,0);
		//刪除動態模板緩存文件
		DelOneTempTmpfile('indexpage');
	}
	else
	{
		$indextempr=$empire->fetch1("select indextemp from ".GetTemptb("enewspubtemp")." limit 1");
		$indextemp=$indextempr['indextemp'];
		NewsBq($classid,$indextemp,1,0);
		//刪除動態模板緩存文件
		DelOneTempTmpfile('indexpage');
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=$tempid&tempname=$r[tempname]&def=$def");
		printerror($mess,"ListIndexpage.php?gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//操作
$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include("../../class/t_functions.php");
	include("../../data/dbcache/class.php");
	include("../../data/dbcache/MemberLevel.php");
	include("../../class/tempfun.php");
}
//增加首頁方案
if($enews=="AddIndexpage")
{
	AddIndexpage($_POST,$logininid,$loginin);
}
//修改首頁方案
elseif($enews=="EditIndexpage")
{
	EditIndexpage($_POST,$logininid,$loginin);
}
//刪除首頁方案
elseif($enews=="DelIndexpage")
{
	DelIndexpage($_GET['tempid'],$logininid,$loginin);
}
//啟用首頁方案
elseif($enews=="DefIndexpage")
{
	DefIndexpage($_GET['tempid'],$logininid,$loginin);
}

$gid=(int)$_GET['gid'];
$url="<a href=ListIndexpage.php?gid=$gid".$ecms_hashur['ehref'].">管理首頁方案</a>";
$search="&gid=$gid".$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select tempid,tempname from {$dbtbpre}enewsindexpage";
$totalquery="select count(*) as total from {$dbtbpre}enewsindexpage";
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by tempid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理首頁方案</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置： 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton"> 
        <input type="button" name="Submit5" value="增加首頁方案" onclick="self.location.href='AddIndexpage.php?enews=AddIndexpage&gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
  
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"><div align="center">ID</div></td>
    <td width="49%" height="25"><div align="center">方案名稱</div></td>
    <td width="17%"><div align="center">啟用/取消</div></td>
    <td width="29%" height="25"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  	//默認方案
	if($public_r['indexpageid']==$r['tempid'])
	{
		$bgcolor='#DBEAF5';
		$openindexpage='取消此方案';
		$movejs='';
	}
	else
	{
		$bgcolor='#ffffff';
		$openindexpage='啟用此方案';
		$movejs=' onmouseout="this.style.backgroundColor=\'#ffffff\'" onmouseover="this.style.backgroundColor=\'#C3EFFF\'"';
	}
  ?>
  <tr bgcolor="<?=$bgcolor?>"<?=$movejs?>> 
    <td height="25"><div align="center"> 
        <?=$r[tempid]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[tempname]?>
      </div></td>
    <td><div align="center"> <a href="ListIndexpage.php?enews=DefIndexpage&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['href']?>" onclick="return confirm('確定設置?');"><?=$openindexpage?></a></div></td>
    <td height="25"><div align="center"> [<a href="AddIndexpage.php?enews=EditIndexpage&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>">修改</a>] 
        [<a href="AddIndexpage.php?enews=AddIndexpage&docopy=1&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>">複製</a>] 
        [<a href="../ecmstemp.php?enews=PreviewIndexpage&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['href']?>" target="_blank">預覽</a>] 
        [<a href="ListIndexpage.php?enews=DelIndexpage&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="ffffff"> 
    <td height="25" colspan="4">&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td height="25"><font color="#666666">說明：首頁方案：可以將某一方案作為臨時首頁，特別是在節假日製作特別首頁非常有用。全部取消時為使用默認首頁模板。</font></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
