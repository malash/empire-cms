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
CheckLevel($logininid,$loginin,$classid,"table");
$url="<a href=ListTable.php".$ecms_hashur['whehref'].">�޲z�ƾڪ�</a>&nbsp;>&nbsp;�ɤJ�t�μҫ�";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ɤJ�t�μҫ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G 
      <?=$url?>
    </td>
  </tr>
</table>
<form action="../ecmsmod.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('�T�{�n�ɤJ?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header">�ɤJ�t�μҫ�</td>
    </tr>
    <tr> 
      <td width="28%" height="25" bgcolor="#FFFFFF">�s�񪺼ƾڪ�W:</td>
      <td width="72%" height="25" bgcolor="#FFFFFF"><strong><?=$dbtbpre?>ecms_</strong> 
        <input name="tbname" type="text" id="tbname">
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ܾɤJ�ҫ����:</td>
      <td height="25" bgcolor="#FFFFFF"><input type="file" name="file">
        *.mod</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="���W�ɤJ"> 
        <input type="reset" name="Submit2" value="���m">
        <input name="enews" type="hidden" id="enews" value="LoadInMod">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
