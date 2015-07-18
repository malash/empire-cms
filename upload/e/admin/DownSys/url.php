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
CheckLevel($logininid,$loginin,$classid,"downurl");

//增加url地址
function AddDownurl($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[urlname]))
	{printerror("EmptyDownurl","history.go(-1)");}
	//驗證權限
	CheckLevel($userid,$username,$classid,"downurl");
	$downtype=(int)$add['downtype'];
	$sql=$empire->query("insert into {$dbtbpre}enewsdownurlqz(urlname,url,downtype) values('$add[urlname]','$add[url]',$downtype);");
	$urlid=$empire->lastid();
	if($sql)
	{
		//操作日誌
		insert_dolog("urlid=".$urlid);
		printerror("AddDownurlSuccess","url.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//修改url地址
function EditDownurl($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[urlid]=(int)$add[urlid];
	if(empty($add[urlname])||empty($add[urlid]))
	{printerror("EmptyDownurl","history.go(-1)");}
	//驗證權限
	CheckLevel($userid,$username,$classid,"downurl");
	$downtype=(int)$add['downtype'];
	$sql=$empire->query("update {$dbtbpre}enewsdownurlqz set urlname='$add[urlname]',url='$add[url]',downtype=$downtype where urlid='$add[urlid]'");
	if($sql)
	{
		//操作日誌
		insert_dolog("urlid=".$add[urlid]);
		printerror("EditDownurlSuccess","url.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//刪除url地址
function DelDownurl($urlid,$userid,$username){
	global $empire,$dbtbpre;
	$urlid=(int)$urlid;
	if(empty($urlid))
	{printerror("NotChangeDownurlid","history.go(-1)");}
	//驗證權限
	CheckLevel($userid,$username,$classid,"downurl");
	$sql=$empire->query("delete from {$dbtbpre}enewsdownurlqz where urlid='$urlid'");
	if($sql)
	{
		//操作日誌
		insert_dolog("urlid=".$urlid);
		printerror("DelDownurlSuccess","url.php".hReturnEcmsHashStrHref2(1));
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
//增加前綴
if($enews=="AddDownurl")
{
	AddDownurl($_POST,$logininid,$loginin);
}
//修改前綴
elseif($enews=="EditDownurl")
{
	EditDownurl($_POST,$logininid,$loginin);
}
//刪除前綴
elseif($enews=="DelDownurl")
{
	$urlid=$_GET['urlid'];
	DelDownurl($urlid,$logininid,$loginin);
}
else
{}
$sql=$empire->query("select urlid,urlname,url,downtype from {$dbtbpre}enewsdownurlqz order by urlid desc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>管理下載地址前綴</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href="url.php<?=$ecms_hashur['whehref']?>">管理下載地址前綴</a></td>
  </tr>
</table>
<form name="form1" method="post" action="url.php">
  <input type=hidden name=enews value=AddDownurl>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" class="header">增加下載地址前綴:</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 名稱: 
        <input name="urlname" type="text" id="urlname">
        地址: 
        <input name="url" type="text" id="url" value="http://" size="38">
        下載方式: <select name="downtype" id="downtype">
          <option value="0">HEADER</option>
          <option value="1">META</option>
          <option value="2">READ</option>
        </select> <input type="submit" name="Submit" value="增加"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="74%" height="25">下載地址前綴管理:</td>
    <td width="26%" height="25"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=url.php>
	  <?=$ecms_hashur['form']?>
  <input type=hidden name=enews value=EditDownurl>
  <input type=hidden name=urlid value=<?=$r[urlid]?>>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25">名稱: 
        <input name="urlname" type="text" id="urlname" value="<?=$r[urlname]?>">
        地址: 
        <input name="url" type="text" id="url" value="<?=$r[url]?>" size="30">
        <select name="downtype" id="downtype">
          <option value="0"<?=$r['downtype']==0?' selected':''?>>HEADER</option>
          <option value="1"<?=$r['downtype']==1?' selected':''?>>META</option>
          <option value="2"<?=$r['downtype']==2?' selected':''?>>READ</option>
        </select> </td>
    <td height="25"><div align="center">
          <input type="submit" name="Submit3" value="修改">&nbsp;
          <input type="button" name="Submit4" value="刪除" onclick="if(confirm('確認要刪除?')){self.location.href='url.php?enews=DelDownurl&urlid=<?=$r[urlid]?><?=$ecms_hashur['href']?>';}">
        </div></td>
  </tr>
  </form>
  <?php
  }
  db_close();
  $empire=null;
  ?>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class=tableborder>
  <tr> 
    <td height="26" bgcolor="#FFFFFF"><strong>下載方式說明：</strong></td>
  </tr>
  <tr>
    <td height="26" bgcolor="#FFFFFF"><strong>HEADER：</strong>使用header轉向，通常設為這個。<br>
      <strong>META：</strong>直接轉自，如果是FTP地址推薦選擇這個。<br>
      <strong>READ：</strong>使用PHP程序讀取，防盜鏈較強，但較占資源，服務器本地小文件可選擇。</td>
  </tr>
</table>
</body>
</html>
