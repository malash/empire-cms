<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
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
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q�R�������u����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m: <a href="DelMoreMsg.php<?=$ecms_hashur['whehref']?>">��q�R�������u����</a></td>
  </tr>
</table>
<form name="form1" method="post" action="DelMoreMsg.php" onsubmit="return confirm('�T�{�n�R��?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�R�������u���� 
          <input name="enews" type="hidden" id="enews" value="DelMoreMsg">
        </div></td>
    </tr>
    <tr> 
      <td width="20%" height="25" bgcolor="#FFFFFF">��������</td>
      <td width="80%" bgcolor="#FFFFFF"><select name="msgtype" id="msgtype">
          <option value="0">�e�x��������</option>
		  <option value="2">�u�R���e�x�t�ή���</option>
		  <option value="1">��x��������</option>
		  <option value="3">�u�R����x�t�ή���</option>
        </select></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�o��H</td>
      <td bgcolor="#FFFFFF"><input name="from_username" type="text" id="from_username">
        <input name="fromlike" type="checkbox" id="fromlike" value="1" checked>
        �ҽk�ǰt (���񬰤���)</td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">����H</td>
      <td bgcolor="#FFFFFF"><input name="to_username" type="text" id="to_username">
        <input name="tolike" type="checkbox" id="tolike" value="1" checked>
        �ҽk�ǰt(���񬰤���)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�]�t����r</td>
      <td bgcolor="#FFFFFF"><input name="keyboard" type="text" id="keyboard"> 
        <select name="keyfield" id="keyfield">
          <option value="0">�˯����D�M���e</option>
          <option value="1">�˯��H�����D</option>
          <option value="2">�˯��H�����e</option>
        </select>
        (�h�ӽХ�&quot;,&quot;��})</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ɶ�</td>
      <td bgcolor="#FFFFFF">�R���q 
        <input name="starttime" type="text" id="starttime" onclick="setday(this)" size="12">
        �� 
        <input name="endtime" type="text" id="endtime" onclick="setday(this)" size="12">
        �������u����</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="��q�R��"></td>
    </tr>
  </table>
</form>
</body>
</html>
