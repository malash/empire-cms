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
$url="<a href=ChangeListTemp.php".$ecms_hashur['whehref'].">��q����ئC��ҪO</a>";
//���
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//�C��ҪO
$listtemp="";
$sql=$empire->query("select mname,mid from {$dbtbpre}enewsmod order by myorder,mid");
while($r=$empire->fetch($sql))
{
	$listtemp.="<option value=0 style='background:#99C4E3'>".$r[mname]."</option>";
	$sql1=$empire->query("select tempname,tempid from ".GetTemptb("enewslisttemp")." where modid='$r[mid]'");
	while($r1=$empire->fetch($sql1))
	{
		$listtemp.="<option value='".$r1[tempid]."'>|-".$r1[tempname]."</option>";
	}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q����ئC��ҪO</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="../ecmstemp.php" onsubmit="return confirm('�T�{�n�󴫡H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">��q����ئC��ҪO 
        <input name="enews" type="hidden" id="enews" value="ChangeClassListtemp"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="15%" height="25">�ާ@��ءG</td>
      <td width="85%" height="25"><select name="classid" size="16" id="classid" style="width:220">
          <option selected>�Ҧ����</option>
          <?=$class?>
        </select> <font color="#666666">�]�p��ܤ���ءA�N���Ω�Ҧ��l��ء^</font> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�s���C��ҪO�G</td>
      <td height="25"><select name="listtempid" id="listtempid">
          <option value=0>��ܦC��ҪO</option>
		  <?=$listtemp?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
