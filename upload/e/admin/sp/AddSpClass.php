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
CheckLevel($logininid,$loginin,$classid,"sp");
$enews=ehtmlspecialchars($_GET['enews']);
$postword='�W�[�H������';
$url="<a href=ListSp.php".$ecms_hashur['whehref'].">�޲z�H��</a>&nbsp;>&nbsp;<a href=ListSpClass.php".$ecms_hashur['whehref'].">�޲z�H������</a>&nbsp;>&nbsp;�W�[�H������";
//�ק�
if($enews=="EditSpClass")
{
	$postword='�ק�H������';
	$classid=(int)$_GET['classid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsspclass where classid='$classid'");
	$url="<a href=ListSp.php".$ecms_hashur['whehref'].">�޲z�H��</a>&nbsp;>&nbsp;<a href=ListSpClass.php".$ecms_hashur['whehref'].">�޲z�H������</a>&nbsp;>&nbsp;�ק�H�������G".$r[classname];
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�H������</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListSpClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><?=$postword?></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">�����W�١G</td>
      <td width="79%" height="25"><input name="classname" type="text" id="classname" size="42" value="<?=$r[classname]?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="classid" type="hidden" id="classid" value="<?=$r[classid]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���������G</td>
      <td height="25"><textarea name="classsay" cols="60" rows="5" id="classsay"><?=ehtmlspecialchars($r[classsay])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
