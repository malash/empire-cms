<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
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
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��_�ƾ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G<a href="ReData.php<?=$ecms_hashur['whehref']?>">��_�ƾ�</a></td>
  </tr>
</table>
<form action="phome.php" method="post" name="ebakredata" target="_blank" onsubmit="return confirm('�T�{�n��_�H');">
  <table width="70%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="34%" height="25">��_�ƾ� 
        <input name="phome" type="hidden" id="phome" value="ReData"></td>
      <td width="66%" height="25">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��_�ƾڷ��ؿ��G</td>
      <td height="25">
        <?=$bakpath?>
        / 
        <input name="mypath" type="text" id="mypath" value="<?=$mypath?>">
        <input type="button" name="Submit2" value="��ܥؿ�" onclick="javascript:window.open('ChangePath.php?change=1<?=$ecms_hashur['ehref']?>','','width=600,height=500,scrollbars=yes');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�n�ɤJ���ƾڮw�G</td>
      <td height="25"> <select name="add[mydbname]" size="23" id="add[mydbname]" style="width=200">
          <?=$db?>
        </select></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td height="25">��_�ﶵ�G</td>
      <td height="25">�C�ի�_���j�G 
        <input name="add[waitbaktime]" type="text" id="add[waitbaktime]" value="0" size="2">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"> <div align="left"> 
          <input type="submit" name="Submit" value="�}�l��_">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
