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
CheckLevel($logininid,$loginin,$classid,"template");
$url="<a href=LoadTemp.php".$ecms_hashur['whehref'].">��q�ɤJ��ؼҪO</a>";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q�ɤJ��ؼҪO</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="../ecmstemp.php" onsubmit="return confirm('�T�{�n�ɤJ�H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">��q�ɤJ��ؼҪO 
          <input name="enews" type="hidden" id="enews" value="LoadTempInClass">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center"><br>
          <input type="submit" name="Submit" value="�}�l�ɤJ�ҪO">
          <br>
          <br>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="center">(�����G�D�׷���ئ��ġA�бN�n�ɤJ���ҪO�W�ǦܡG<a href="ShowLoadTempPath.php<?=$ecms_hashur['whehref']?>" target="_blank"><strong>/e/data/LoadTemp</strong></a>,�M���I���ɤJ�ҪO�D<br>
          �ҪO���R�W�Φ��G<strong><font color="#FF0000">���ID.htm</font></strong> ,�t�η|�j��������&quot;ID���&quot;�i��ɤJ�D)</div></td>
    </tr>
  </table>
</form>
</body>
</html>
