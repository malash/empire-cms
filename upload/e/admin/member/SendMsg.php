<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//���ҥΤ�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//�����v��
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
//----------�|����
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
<title>�o�e�����u����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m: <a href="SendMsg.php<?=$ecms_hashur['whehref']?>">�o�e�����u����</a></td>
  </tr>
</table>
<form name="sendform" method="post" action="SendMsg.php" onsubmit="return confirm('�T�{�n�o�e?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�o�e�����u���� 
          <input name="enews" type="hidden" id="enews" value="SendMsg">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����|����</td>
      <td bgcolor="#FFFFFF"> <select name="groupid[]" size="5" multiple id="groupid[]">
          <?=$membergroup?>
        </select> <font color="#666666">(�����&quot;CTRL+A&quot;,��ܦh�ӥ�CTRL/SHIFT+�I�����)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�����|���Τ�W</td>
      <td bgcolor="#FFFFFF"><input name="username" type="text" id="username" size="60">
        <font color="#666666">(�h�ӥΤ�W�u|�v�j�})</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�C�յo�e�Ӽ�</td>
      <td bgcolor="#FFFFFF"><input name="line" type="text" id="line" value="300" size="8"> 
      </td>
    </tr>
    <tr> 
      <td width="23%" height="25" bgcolor="#FFFFFF">���D</td>
      <td width="77%" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="60"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF"> <div align="left">���e<br>
          (���html�N�X)</div></td>
      <td bgcolor="#FFFFFF"><textarea name="msgtext" cols="60" rows="16" id="msgtext"></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="left"></div></td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="�o�e"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">�i�H�b���D�P���e���ϥΡG[!--username--]�N��Τ�W</td>
    </tr>
  </table>
</form>
</body>
</html>
