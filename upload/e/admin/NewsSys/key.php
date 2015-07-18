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
CheckLevel($logininid,$loginin,$classid,"key");

//增加關鍵字
function AddKey($keyname,$keyurl,$userid,$username){
	global $empire,$dbtbpre;
	$cid=(int)$_POST['cid'];
	$fcid=(int)$_POST['fcid'];
	if(!$keyname||!$keyurl)
	{printerror("EmptyKeyname","history.go(-1)");}
	//驗證權限
	CheckLevel($userid,$username,$classid,"key");
	$keyname=hRepPostStr($keyname,1);
	$keyurl=hRepPostStr($keyurl,1);
	$sql=$empire->query("insert into {$dbtbpre}enewskey(keyname,keyurl,cid) values('$keyname','$keyurl','$cid');");
	$keyid=$empire->lastid();
	GetConfig();//更新緩存
	if($sql)
	{
		//操作日誌
		insert_dolog("keyid=".$keyid."<br>keyname=".$keyname);
		printerror("AddKeySuccess","key.php?fcid=$fcid".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//修改關鍵字
function EditKey($keyid,$keyname,$keyurl,$userid,$username){
	global $empire,$dbtbpre;
	$cid=(int)$_POST['cid'];
	$fcid=(int)$_POST['fcid'];
	if(!$keyname||!$keyurl||!$keyid)
	{printerror("EmptyKeyname","history.go(-1)");}
	//驗證權限
	CheckLevel($userid,$username,$classid,"key");
	$keyid=(int)$keyid;
	$keyname=hRepPostStr($keyname,1);
	$keyurl=hRepPostStr($keyurl,1);
	$sql=$empire->query("update {$dbtbpre}enewskey set keyname='$keyname',keyurl='$keyurl',cid='$cid' where keyid='$keyid'");
	GetConfig();//更新緩存
	if($sql)
	{
		//操作日誌
		insert_dolog("keyid=".$keyid."<br>keyname=".$keyname);
		printerror("EditKeySuccess","key.php?fcid=$fcid".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//刪除關鍵字
function DelKey($keyid,$userid,$username){
	global $empire,$dbtbpre;
	$fcid=(int)$_GET['fcid'];
	$keyid=(int)$keyid;
	if(!$keyid)
	{printerror("NotDelKeyid","history.go(-1)");}
	//驗證權限
	CheckLevel($userid,$username,$classid,"key");
	$r=$empire->fetch1("select keyname from {$dbtbpre}enewskey where keyid='$keyid'");
	$sql=$empire->query("delete from {$dbtbpre}enewskey where keyid='$keyid'");
	GetConfig();//更新緩存
	if($sql)
	{
		//操作日誌
		insert_dolog("keyid=".$keyid."<br>keyname=".$r[keyname]);
		printerror("DelKeySuccess","key.php?fcid=$fcid".hReturnEcmsHashStrHref2(0));
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
//增加關鍵字
if($enews=="AddKey")
{
	$keyname=$_POST['keyname'];
	$keyurl=$_POST['keyurl'];
	AddKey($keyname,$keyurl,$logininid,$loginin);
}
//修改關鍵字
elseif($enews=="EditKey")
{
	$keyid=$_POST['keyid'];
	$keyname=$_POST['keyname'];
	$keyurl=$_POST['keyurl'];
	EditKey($keyid,$keyname,$keyurl,$logininid,$loginin);
}
//刪除關鍵字
elseif($enews=="DelKey")
{
	$keyid=$_GET['keyid'];
	DelKey($keyid,$logininid,$loginin);
}
else
{}

$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$search='';
$search.=$ecms_hashur['ehref'];
$add='';
//分類
$fcid=(int)$_GET['fcid'];
if($fcid)
{
	$add=" where cid='$fcid'";
	$search.='&fcid='.$fcid;
}
$totalquery="select count(*) as total from {$dbtbpre}enewskey".$add;
$num=$empire->gettotal($totalquery);
$query="select keyid,keyname,keyurl,cid from {$dbtbpre}enewskey".$add." order by keyid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//分類
$cstr='';
$csql=$empire->query("select classid,classname from {$dbtbpre}enewskeyclass");
while($cr=$empire->fetch($csql))
{
	$cstr.="<option value='$cr[classid]'>$cr[classname]</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>關鍵字</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="56%">位置：<a href="key.php<?=$ecms_hashur['whehref']?>">管理內容關鍵字</a></td>
    <td width="44%"><div align="right" class="emenubutton">
        <input type="button" name="Submit52" value="管理內容關鍵字分類" onclick="self.location.href='KeyClass.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">

  <tr> 
    <td> 選擇分類： 
      <select name="fcid" id="fcid" onchange=window.location='key.php?<?=$ecms_hashur['ehref']?>&fcid='+this.options[this.selectedIndex].value>
        <option value="0">顯示所有分類</option>
		<?=$fcid?str_replace("'$fcid'>","'$fcid' selected>",$cstr):$cstr?>
      </select> </td>
  </tr>
</table>

<br>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="key.php">
  <?=$ecms_hashur['form']?>
  <input type=hidden name=enews value=AddKey>
  <input type=hidden name=fcid value=<?=$fcid?>>
    <tr class="header">
      <td height="25">增加關鍵字:</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 關鍵字: 
        <input name="keyname" type="text" id="keyname">
        鏈接地址:
        <input name="keyurl" type="text" id="keyurl" value="http://" size="30">
        所屬分類:
        <select name="cid" id="cid">
          <option value="0">不隸屬分類</option>
		  <?=$cstr?>
        </select> 
        <input type="submit" name="Submit" value="增加">
        <input type="reset" name="Submit2" value="重置"></td>
    </tr>
	</form>
  </table>
<br>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="70%" height="25">關鍵字</td>
    <td width="30%" height="25"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=key.php>
	  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=EditKey>
    <input type=hidden name=keyid value=<?=$r[keyid]?>>
	<input type=hidden name=fcid value=<?=$fcid?>>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25">關鍵字: 
        <input name="keyname" type="text" id="keyname" value="<?=$r[keyname]?>">
        鏈接地址: 
        <input name="keyurl" type="text" id="keyurl" value="<?=$r[keyurl]?>" size="30">
        所屬分類: 
        <select name="cid" id="cid">
          <option value="0">不隸屬分類</option>
          <?=$r[cid]?str_replace("'$r[cid]'>","'$r[cid]' selected>",$cstr):$cstr?>
        </select> </td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="修改">
          &nbsp; 
          <input type="button" name="Submit4" value="刪除" onclick="if(confirm('確認要刪除?')){self.location.href='key.php?enews=DelKey&keyid=<?=$r[keyid]?>&fcid=<?=$fcid?><?=$ecms_hashur['href']?>';}">
        </div></td>
    </tr>
  </form>
  <?php
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">
	  <?=$returnpage?>
	  </td>
    </tr>
</table>
</body>
</html>
