<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/functions.php");
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
//驗證權限
CheckLevel($logininid,$loginin,$classid,"dbdata");
$mypath=ehtmlspecialchars($_GET['mypath']);
$mydbname=ehtmlspecialchars($_GET['mydbname']);
$selectdbname=$ecms_config['db']['dbname'];
if($mydbname)
{
	$selectdbname=$mydbname;
}
$bakpath=$public_r['bakdbpath'];
$db='';
if($public_r['ebakcanlistdb'])
{
	$db.="<option value='".$selectdbname."' selected>".$selectdbname."</option>";
}
else
{
	$sql=$empire->query("SHOW DATABASES");
	while($r=$empire->fetch($sql))
	{
		if($r[0]==$selectdbname)
		{$select=" selected";}
		else
		{$select="";}
		$db.="<option value='".$r[0]."'".$select.">".$r[0]."</option>";
	}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>恢復數據</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：<a href="ReData.php<?=$ecms_hashur['whehref']?>">恢復數據</a></td>
  </tr>
</table>
<form action="phome.php" method="post" name="ebakredata" target="_blank" onsubmit="return confirm('確認要恢復？');">
  <table width="70%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="34%" height="25">恢復數據 
        <input name="phome" type="hidden" id="phome" value="ReData"></td>
      <td width="66%" height="25">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">恢復數據源目錄：</td>
      <td height="25">
        <?=$bakpath?>
        / 
        <input name="mypath" type="text" id="mypath" value="<?=$mypath?>">
        <input type="button" name="Submit2" value="選擇目錄" onclick="javascript:window.open('ChangePath.php?change=1<?=$ecms_hashur['ehref']?>','','width=600,height=500,scrollbars=yes');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">要導入的數據庫：</td>
      <td height="25"> <select name="add[mydbname]" size="23" id="add[mydbname]" style="width=200">
          <?=$db?>
        </select></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td height="25">恢復選項：</td>
      <td height="25">每組恢復間隔： 
        <input name="add[waitbaktime]" type="text" id="add[waitbaktime]" value="0" size="2">
        秒</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"> <div align="left"> 
          <input type="submit" name="Submit" value="開始恢復">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
