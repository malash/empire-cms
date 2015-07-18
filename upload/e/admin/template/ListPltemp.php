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

//增加評論模板
function AddPlTemp($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	if(!$add[tempname]||!$add[temptext])
	{
		printerror("EmptyPltempName","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"template");
	$add[tempname]=hRepPostStr($add[tempname],1);
	$add[temptext]=RepPhpAspJspcode($add[temptext]);
	$gid=(int)$add['gid'];
	$sql=$empire->query("insert into ".GetDoTemptb("enewspltemp",$gid)."(tempname,temptext,isdefault) values('".$add[tempname]."','".eaddslashes2($add[temptext])."',0);");
	$tempid=$empire->lastid();
	//備份模板
	AddEBakTemp('pltemp',$gid,$tempid,$add[tempname],$add[temptext],0,0,'',0,0,'',0,0,0,$userid,$username);
	//更新頁面
	if($gid==$public_r['deftempid']||(!$public_r['deftempid']&&($gid==1||$gid==0)))
	{
		GetPlTempPage($tempid);
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=$tempid&tempname=$add[tempname]&gid=$gid");
		printerror("AddPltempSuccess","AddPltemp.php?enews=AddPlTemp&gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//修改評論模板
function EditPlTemp($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$add[tempid];
	if(!$tempid||!$add[tempname]||!$add[temptext])
	{
		printerror("EmptyPltempName","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"template");
	$add[tempname]=hRepPostStr($add[tempname],1);
	$add[temptext]=RepPhpAspJspcode($add[temptext]);
	$gid=(int)$add['gid'];
	$sql=$empire->query("update ".GetDoTemptb("enewspltemp",$gid)." set tempname='".$add[tempname]."',temptext='".eaddslashes2($add[temptext])."' where tempid='$tempid'");
	//備份模板
	AddEBakTemp('pltemp',$gid,$tempid,$add[tempname],$add[temptext],0,0,'',0,0,'',0,0,0,$userid,$username);
	//更新頁面
	if($gid==$public_r['deftempid']||(!$public_r['deftempid']&&($gid==1||$gid==0)))
	{
		GetPlTempPage($tempid);
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=$tempid&tempname=$add[tempname]&gid=$gid");
		printerror("EditPltempSuccess","ListPltemp.php?gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//刪除評論模板
function DelPlTemp($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$add[tempid];
	if(empty($tempid))
	{
		printerror("NotChangePlTempid","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"template");
	$gid=(int)$add['gid'];
	$r=$empire->fetch1("select tempname,isdefault from ".GetDoTemptb("enewspltemp",$gid)." where tempid=$tempid");
	if($r['isdefault'])
	{
		printerror("NotDelDefPlTempid","history.go(-1)");
	}
	$sql=$empire->query("delete from ".GetDoTemptb("enewspltemp",$gid)." where tempid=$tempid");
	if($gid==$public_r['deftempid']||(!$public_r['deftempid']&&($gid==1||$gid==0)))
	{
		DelFiletext(ECMS_PATH.'e/data/filecache/template/pl'.$tempid.'.php');
	}
	//刪除備份記錄
	DelEbakTempAll('pltemp',$gid,$tempid);
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=$tempid&tempname=$r[tempname]&gid=$gid");
		printerror("DelPltempSuccess","ListPltemp.php?gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//設為默認評論模板
function DefPlTemp($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$add[tempid];
	if(!$tempid)
	{
		printerror("NotChangePlTempid","history.go(-1)");
	}
	//操作權限
	CheckLevel($userid,$username,$classid,"template");
	$gid=(int)$add['gid'];
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewspltemp",$gid)." where tempid='$tempid'");
	$usql=$empire->query("update ".GetDoTemptb("enewspltemp",$gid)." set isdefault=0");
	$sql=$empire->query("update ".GetDoTemptb("enewspltemp",$gid)." set isdefault=1 where tempid='$tempid'");
	if($gid==$public_r['deftempid']||(!$public_r['deftempid']&&($gid==1||$gid==0)))
	{
		$empire->query("update {$dbtbpre}enewspl_set set defpltempid='$tempid' limit 1");
		GetConfig();//更新緩存
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("tempid=".$tempid."<br>tempname=".$tr[tempname]."&gid=$gid");
		printerror("DefPltempSuccess","ListPltemp.php?gid=$gid".hReturnEcmsHashStrHref2(0));
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
	include("../../class/tempfun.php");
}
if($enews=="AddPlTemp")//增加評論模板
{
	AddPlTemp($_POST,$logininid,$loginin);
}
elseif($enews=="EditPlTemp")//修改評論模板
{
	EditPlTemp($_POST,$logininid,$loginin);
}
elseif($enews=="DelPlTemp")//刪除評論模板
{
	DelPlTemp($_GET,$logininid,$loginin);
}
elseif($enews=="DefPlTemp")//默認評論模板
{
	DefPlTemp($_GET,$logininid,$loginin);
}

$gid=(int)$_GET['gid'];
$gname=CheckTempGroup($gid);
$urlgname=$gname."&nbsp;>&nbsp;";
$url=$urlgname."<a href=ListPltemp.php?gid=$gid".$ecms_hashur['ehref'].">管理評論模板</a>";
$search="&gid=$gid".$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select tempid,tempname,isdefault from ".GetDoTemptb("enewspltemp",$gid);
$totalquery="select count(*) as total from ".GetDoTemptb("enewspltemp",$gid);
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by tempid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理評論模板</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置： 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton"> 
        <input type="button" name="Submit5" value="增加評論模板" onclick="self.location.href='AddPltemp.php?enews=AddPlTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
  
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="10%" height="25"><div align="center">ID</div></td>
    <td width="61%" height="25"><div align="center">模板名</div></td>
    <td width="29%" height="25"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  	$color="#ffffff";
	$movejs=' onmouseout="this.style.backgroundColor=\'#ffffff\'" onmouseover="this.style.backgroundColor=\'#C3EFFF\'"';
  	if($r[isdefault])
  	{
  		$color="#DBEAF5";
		$movejs='';
  	}
  ?>
  <tr bgcolor="<?=$color?>"<?=$movejs?>> 
    <td height="25"><div align="center"> 
        <?=$r[tempid]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[tempname]?>
      </div></td>
    <td height="25"><div align="center"> [<a href="AddPltemp.php?enews=EditPlTemp&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>">修改</a>] 
        [<a href="AddPltemp.php?enews=AddPlTemp&docopy=1&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>">複製</a>] 
        [<a href="ListPltemp.php?enews=DefPlTemp&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要默認？');">設為默認</a>] 
        [<a href="ListPltemp.php?enews=DelPlTemp&tempid=<?=$r[tempid]?>&gid=<?=$gid?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="ffffff"> 
    <td height="25" colspan="3">&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
