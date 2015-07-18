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
CheckLevel($logininid,$loginin,$classid,"msg");
$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="DelMoreMsg")
{
	include("../../class/com_functions.php");
	DelMoreMsg($_POST,$logininid,$loginin);
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>批量刪除站內短消息</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: <a href="DelMoreMsg.php<?=$ecms_hashur['whehref']?>">批量刪除站內短消息</a></td>
  </tr>
</table>
<form name="form1" method="post" action="DelMoreMsg.php" onsubmit="return confirm('確認要刪除?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">刪除站內短消息 
          <input name="enews" type="hidden" id="enews" value="DelMoreMsg">
        </div></td>
    </tr>
    <tr> 
      <td width="20%" height="25" bgcolor="#FFFFFF">消息類型</td>
      <td width="80%" bgcolor="#FFFFFF"><select name="msgtype" id="msgtype">
          <option value="0">前台全部消息</option>
		  <option value="2">只刪除前台系統消息</option>
		  <option value="1">後台全部消息</option>
		  <option value="3">只刪除後台系統消息</option>
        </select></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">發件人</td>
      <td bgcolor="#FFFFFF"><input name="from_username" type="text" id="from_username">
        <input name="fromlike" type="checkbox" id="fromlike" value="1" checked>
        模糊匹配 (不填為不限)</td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">收件人</td>
      <td bgcolor="#FFFFFF"><input name="to_username" type="text" id="to_username">
        <input name="tolike" type="checkbox" id="tolike" value="1" checked>
        模糊匹配(不填為不限)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">包含關鍵字</td>
      <td bgcolor="#FFFFFF"><input name="keyboard" type="text" id="keyboard"> 
        <select name="keyfield" id="keyfield">
          <option value="0">檢索標題和內容</option>
          <option value="1">檢索信息標題</option>
          <option value="2">檢索信息內容</option>
        </select>
        (多個請用&quot;,&quot;格開)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">時間</td>
      <td bgcolor="#FFFFFF">刪除從 
        <input name="starttime" type="text" id="starttime" onclick="setday(this)" size="12">
        到 
        <input name="endtime" type="text" id="endtime" onclick="setday(this)" size="12">
        之間的短消息</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="批量刪除"></td>
    </tr>
  </table>
</form>
</body>
</html>
