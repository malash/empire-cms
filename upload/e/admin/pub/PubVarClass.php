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
//驗證權限
CheckLevel($logininid,$loginin,$classid,"pubvar");

//增加分類
function AddPubVarClass($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[classname])
	{
		printerror("EmptyPubVarClass","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"pubvar");
	$add['classname']=hRepPostStr($add['classname'],1);
	$add['classsay']=hRepPostStr($add['classsay'],1);
	$sql=$empire->query("insert into {$dbtbpre}enewspubvarclass(classname,classsay) values('".$add[classname]."','".$add[classsay]."');");
	$lastid=$empire->lastid();
	if($sql)
	{
		//操作日誌
		insert_dolog("classid=".$lastid."<br>classname=".$add[classname]);
		printerror("AddPubVarClassSuccess","PubVarClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//修改分類
function EditPubVarClass($add,$userid,$username){
	global $empire,$dbtbpre;
	$classid=(int)$add[classid];
	if(!$add[classname]||!$classid)
	{
		printerror("EmptyPubVarClass","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"pubvar");
	$add['classname']=hRepPostStr($add['classname'],1);
	$add['classsay']=hRepPostStr($add['classsay'],1);
	$sql=$empire->query("update {$dbtbpre}enewspubvarclass set classname='".$add[classname]."',classsay='".$add[classsay]."' where classid='$classid'");
	if($sql)
	{
		//操作日誌
		insert_dolog("classid=".$classid."<br>classname=".$add[classname]);
		printerror("EditPubVarClassSuccess","PubVarClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//刪除分類
function DelPubVarClass($classid,$userid,$username){
	global $empire,$dbtbpre;
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("NotDelPubVarClassid","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"pubvar");
	$r=$empire->fetch1("select classname from {$dbtbpre}enewspubvarclass where classid='$classid'");
	$sql=$empire->query("delete from {$dbtbpre}enewspubvarclass where classid='$classid'");
	//刪除變量
	$delsql=$empire->query("delete from {$dbtbpre}enewspubvar where classid='$classid'");
	if($sql)
	{
		GetConfig();
		//操作日誌
		insert_dolog("classid=".$classid."<br>classname=".$r[classname]);
		printerror("DelPubVarClassSuccess","PubVarClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="AddPubVarClass")//增加分類
{
	AddPubVarClass($_POST,$logininid,$loginin);
}
elseif($enews=="EditPubVarClass")//修改分類
{
	EditPubVarClass($_POST,$logininid,$loginin);
}
elseif($enews=="DelPubVarClass")//刪除分類
{
	$classid=$_GET['classid'];
	DelPubVarClass($classid,$logininid,$loginin);
}
else
{}

$sql=$empire->query("select classid,classname,classsay from {$dbtbpre}enewspubvarclass order by classid desc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置：<a href="ListPubVar.php<?=$ecms_hashur['whehref']?>">管理擴展變量</a> &gt; <a href="PubVarClass.php<?=$ecms_hashur['whehref']?>">管理變量分類</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="管理擴展變量" onclick="self.location.href='ListPubVar.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="PubVarClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25">增加變量分類: 
        <input name=enews type=hidden id="enews" value=AddPubVarClass> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 分類名稱: 
        <input name="classname" type="text" id="classname">
        分類說明: <input name="classsay" type="text" id="classsay" size="42"> <input type="submit" name="Submit" value="增加"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%"><div align="center">ID</div></td>
    <td width="29%" height="25">分類名稱</td>
    <td width="49%">分類說明</td>
    <td width="16%" height="25"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=PubVarClass.php>
	  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=EditPubVarClass>
    <input type=hidden name=classid value=<?=$r[classid]?>>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td><div align="center">
          <?=$r[classid]?>
        </div></td>
      <td height="25"> <input name="classname" type="text" id="classname" value="<?=$r[classname]?>">
        [<a href="ListPubVar.php?classid=<?=$r[classid]?><?=$ecms_hashur['ehref']?>" target="_blank">變量列表</a>]</td>
      <td><input name="classsay" type="text" id="classsay" value="<?=$r[classsay]?>" size="42"></td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="修改">
          &nbsp; 
          <input type="button" name="Submit4" value="刪除" onclick="if(confirm('刪除會刪除分類下的所有變量，確認要刪除?')){self.location.href='PubVarClass.php?enews=DelPubVarClass&classid=<?=$r[classid]?><?=$ecms_hashur['href']?>';}">
        </div></td>
    </tr>
  </form>
  <?php
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
