<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
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
CheckLevel($logininid,$loginin,$classid,"msg");
$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="SendMsg")
{
	include("../../class/com_functions.php");
	include "../".LoadLang("pub/fun.php");
	DoSendMsg($_POST,0,$logininid,$loginin);
}
$groupid=(int)$_GET['groupid'];
//----------會員組
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($sql))
{
	if($groupid==$level_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$membergroup.="<option value=".$level_r[groupid].$select.">".$level_r[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>發送站內短消息</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: <a href="SendMsg.php<?=$ecms_hashur['whehref']?>">發送站內短消息</a></td>
  </tr>
</table>
<form name="sendform" method="post" action="SendMsg.php" onsubmit="return confirm('確認要發送?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">發送站內短消息 
          <input name="enews" type="hidden" id="enews" value="SendMsg">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">接收會員組</td>
      <td bgcolor="#FFFFFF"> <select name="groupid[]" size="5" multiple id="groupid[]">
          <?=$membergroup?>
        </select> <font color="#666666">(全選用&quot;CTRL+A&quot;,選擇多個用CTRL/SHIFT+點擊選擇)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">接收會員用戶名</td>
      <td bgcolor="#FFFFFF"><input name="username" type="text" id="username" size="60">
        <font color="#666666">(多個用戶名「|」隔開)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每組發送個數</td>
      <td bgcolor="#FFFFFF"><input name="line" type="text" id="line" value="300" size="8"> 
      </td>
    </tr>
    <tr> 
      <td width="23%" height="25" bgcolor="#FFFFFF">標題</td>
      <td width="77%" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="60"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF"> <div align="left">內容<br>
          (支持html代碼)</div></td>
      <td bgcolor="#FFFFFF"><textarea name="msgtext" cols="60" rows="16" id="msgtext"></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="left"></div></td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="發送"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">可以在標題與內容中使用：[!--username--]代表用戶名</td>
    </tr>
  </table>
</form>
</body>
</html>
