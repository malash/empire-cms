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

$ztid=(int)$_GET['ztid'];
if(empty($ztid))
{
	$ztid=(int)$_POST['ztid'];
}
//驗證權限
//CheckLevel($logininid,$loginin,$classid,"zt");
$returnandlevel=CheckAndUsernamesLevel('dozt',$ztid,$logininid,$loginin,$loginlevel);

//處理變量
function DoPostZtTypeVar($add){
	if(empty($add['ttype']))
	{
		$add['ttype']='.html';
	}
	$add['cname']=eaddslashes(ehtmlspecialchars($add['cname']));
	$add['myorder']=(int)$add['myorder'];
	$add['islist']=(int)$add['islist'];
	$add['listtempid']=(int)$add['listtempid'];
	$add['maxnum']=(int)$add['maxnum'];
	$add['tnum']=(int)$add['tnum'];
	$add['reorder']=RepPostVar2($add['reorder']);
	$add['classtext']=RepPhpAspJspcode($add['classtext']);
	return $add;
}

//增加子類
function AddZtType($add,$userid,$username){
	global $empire,$dbtbpre;
	$add=DoPostZtTypeVar($add);
	$ztid=(int)$add['ztid'];
	if(!$ztid||!$add[cname])
	{
		printerror("EmptyZtType","history.go(-1)");
	}
	//驗證權限
	//CheckLevel($userid,$username,$classid,"zt");
	$sql=$empire->query("insert into {$dbtbpre}enewszttype(ztid,cname,myorder,islist,listtempid,maxnum,tnum,reorder,ttype) values('$ztid','$add[cname]','$add[myorder]','$add[islist]','$add[listtempid]','$add[maxnum]','$add[tnum]','$add[reorder]','$add[ttype]');");
	$lastid=$empire->lastid();
	$empire->query("insert into {$dbtbpre}enewszttypeadd(cid,classtext) values('$lastid','".eaddslashes2($add[classtext])."');");
	//生成頁面
	ListHtmlIndex($lastid,'',1);
	if($sql)
	{
		//操作日誌
		insert_dolog("ztid=".$ztid."<br>cid=".$lastid."&cname=".$add[cname]);
		printerror("AddZtTypeSuccess","ZtType.php?ztid=$ztid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//修改子類
function EditZtType($add,$userid,$username){
	global $empire,$dbtbpre;
	$add=DoPostZtTypeVar($add);
	$ztid=(int)$add['ztid'];
	$cid=(int)$add['cid'];
	if(!$ztid||!$cid||!$add[cname])
	{
		printerror("EmptyZtType","history.go(-1)");
	}
	//驗證權限
	//CheckLevel($userid,$username,$classid,"zt");
	$r=$empire->fetch1("select ztid,cname from {$dbtbpre}enewszttype where cid='$cid' and ztid='$ztid' limit 1");
	if(!$r['ztid'])
	{
		printerror('ErrorUrl','');
	}
	$sql=$empire->query("update {$dbtbpre}enewszttype set cname='$add[cname]',myorder='$add[myorder]',islist='$add[islist]',listtempid='$add[listtempid]',maxnum='$add[maxnum]',tnum='$add[tnum]',reorder='$add[reorder]',ttype='$add[ttype]' where cid='$cid'");
	$empire->query("update {$dbtbpre}enewszttypeadd set classtext='".eaddslashes2($add[classtext])."' where cid='$cid'");
	//生成頁面
	ListHtmlIndex($cid,'',1);
	if($sql)
	{
		//操作日誌
		insert_dolog("ztid=".$ztid."<br>cid=".$cid."<br>cname=".$add[cname]);
		printerror("EditZtTypeSuccess","ZtType.php?ztid=$ztid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//刪除子類
function DelZtType($add,$userid,$username){
	global $empire,$dbtbpre;
	$ztid=(int)$add['ztid'];
	$cid=(int)$add['cid'];
	if(!$ztid||!$cid)
	{
		printerror("EmptyZtTypeId","history.go(-1)");
	}
	//驗證權限
	//CheckLevel($userid,$username,$classid,"zt");
	$r=$empire->fetch1("select ztid,cname from {$dbtbpre}enewszttype where cid='$cid' and ztid='$ztid' limit 1");
	if(!$r['ztid'])
	{
		printerror('ErrorUrl','');
	}
	$sql=$empire->query("delete from {$dbtbpre}enewszttype where cid='$cid'");
	$empire->query("delete from {$dbtbpre}enewszttypeadd where cid='$cid'");
	$empire->query("update {$dbtbpre}enewsztinfo set cid=0 where cid='$cid'");
	//刪除頁面
	DelZtcFile($cid);
	if($sql)
	{
		//操作日誌
		insert_dolog("ztid=".$ztid."<br>cid=".$cid."<br>cname=".$r[cname]);
		printerror("DelZtTypeSuccess","ZtType.php?ztid=$ztid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}


$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include '../'.LoadLang('pub/fun.php');
	include('../../class/t_functions.php');
	include('../../data/dbcache/class.php');
	include('../../data/dbcache/MemberLevel.php');
}
if($enews=="AddZtType")//增加子類
{
	AddZtType($_POST,$logininid,$loginin);
}
elseif($enews=="EditZtType")//修改子類
{
	EditZtType($_POST,$logininid,$loginin);
}
elseif($enews=="DelZtType")//刪除子類
{
	DelZtType($_GET,$logininid,$loginin);
}
else
{}


$ztr=$empire->fetch1("select ztid,ztname,ztpath,zturl,zttype from {$dbtbpre}enewszt where ztid='$ztid'");
if(!$ztr['ztid'])
{
	printerror('ErrorUrl','');
}
if($ztr[zturl])
{
	$ztlink=$ztr[zturl];
}
else
{
	$ztlink=$public_r['newsurl'].$ztr[ztpath];
}
$sql=$empire->query("select cid,cname,ttype from {$dbtbpre}enewszttype where ztid='$ztid' order by cid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理專題子類</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="74%">位置：<a href="ListZt.php<?=$ecms_hashur['whehref']?>">管理專題</a> &gt; 
      <?=$ztr[ztname]?>
      &gt; <a href="ZtType.php?ztid=<?=$ztid?><?=$ecms_hashur['whehref']?>">管理專題子類</a></td>
    <td width="26%"><div align="right">
        <input type="button" name="Submit22" value="增加專題子類" onclick="self.location.href='AddZtType.php?enews=AddZtType&ztid=<?=$ztid?><?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%"><div align="center">ID</div></td>
    <td width="27%" height="25"><div align="center">分類名稱</div></td>
    <td width="48%"><div align="center">頁面地址</div></td>
    <td width="19%" height="25"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
	  $curl=$ztlink.'/type'.$r[cid].$r[ttype];
  ?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td><div align="center">
          <?=$r[cid]?>
        </div></td>
      <td height="25"> <div align="center"> 
          <?=$r[cname]?>
        </div></td>
      <td><div align="center"><input type="text" name="textfield" value="<?=$curl?>">
        <a href="<?=$curl?>" target="_blank">[查看]</a></div></td>
      <td height="25"><div align="center">[<a href='AddZtType.php?enews=EditZtType&cid=<?=$r[cid]?>&ztid=<?=$ztid?><?=$ecms_hashur['ehref']?>'>修改</a>]&nbsp;&nbsp;[<a href='ZtType.php?enews=DelZtType&cid=<?=$r[cid]?>&ztid=<?=$ztid?><?=$ecms_hashur['href']?>' onclick="return confirm('確認要刪除?');">刪除</a>]</div></td>
    </tr>
  <?php
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
