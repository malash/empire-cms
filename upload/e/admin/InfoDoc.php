<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"infodoc");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=InfoDoc.php".$ecms_hashur['whehref'].">�H����q�k��</a>";
//--------------------�ާ@�����
$fcfile="../data/fc/ListEnews.php";
$do_class="<script src=../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$do_class=ShowClass_AddClass("","n",0,"|-",0,0);}
//��
$selecttable="";
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	$selecttable.="<option value='".$tr[tbname]."'>".$tr[tname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�H����q�k��</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form name="form1" method="get" action="ecmsinfo.php" onsubmit="return confirm('�T�{�n���榹�ާ@�H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�H����q�k�� 
          <input name="enews" type="hidden" id="enews" value="InfoToDoc">
          <input name="ecmsdoc" type="hidden" id="ecmsdoc" value="2">
          <input name="docfrom" type="hidden" id="docfrom" value="InfoDoc.php<?=$ecms_hashur['whehref']?>">
        </div></td>
    </tr>
    <tr> 
      <td width="28%" height="25" valign="top" bgcolor="#FFFFFF">
<div align="center"> 
          <p> 
            <select name="classid[]" size="21" multiple id="classid[]" style="width:200">
              <?=$do_class?>
            </select>
          </p>
          </div></td>
      <td width="72%" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
          <tr bgcolor="#FFFFFF"> 
            <td width="26%" height="32">�k�ɼƾڪ�</td>
            <td width="74%"><select name="tbname" id="tbname">
                <option value=''>------ ��ܼƾڪ� ------</option>
                <?=$selecttable?>
              </select></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32"> <input name="retype" type="radio" value="0" checked>
              ���Ѽ��k�� </td>
            <td>�k�ɤj�� <input name="doctime" type="text" id="doctime" value="100" size="6">
              �Ѫ��H��</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="32">&nbsp;</td>
            <td>�٭��k�ɤp��
              <input name="doctime1" type="text" id="doctime1" value="100" size="6">
              �Ѫ��H��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32"> <input name="retype" type="radio" value="1">
              ���ɶ��k��</td>
            <td>�q 
              <input name="startday" type="text" size="12" onclick="setday(this)">
              �� 
              <input name="endday" type="text" size="12" onclick="setday(this)">
              �������H��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32"> <input name="retype" type="radio" value="2">
              ��ID�k��</td>
            <td>�q 
              <input name="startid" type="text" value="0" size="6">
              �� 
              <input name="endid" type="text" value="0" size="6">
              �������H��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">����ާ@</td>
            <td><input name="doing" type="radio" value="0" checked>
              �k�� <input type="radio" name="doing" value="1">
              �٭��k��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">&nbsp;</td>
            <td><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32" colspan="2"> <font color="#666666"><strong>����:</strong><br>
              ��ܦh����ؽХ�CTRL/SHIFT<br>
              �p�G�k�ɰ_�l�ɶ��PID����h������U��</font></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
</body>
</html>
