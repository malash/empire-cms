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
CheckLevel($logininid,$loginin,$classid,"movenews");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=MoveClassNews.php".$ecms_hashur['whehref'].">��q�ಾ�H��</a>";
//--------------------�ާ@�����
$fcfile="../data/fc/ListEnews.php";
$do_class="<script src=../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$do_class=ShowClass_AddClass("","n",0,"|-",0,0);}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ಾ�H��</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="ecmsinfo.php" onsubmit="return confirm('�T�{�n���榹�ާ@�H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">��q�ಾ��ثH��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">�N 
          <select name="add[classid]" id="add[classid]">
            <option value=0>�п�ܭ�H�����</option><?=$do_class?>
          </select>
          ���H���ಾ�� 
          <select name="add[toclassid]" id="add[toclassid]">
            <option value=0>�п�ܥؼЫH�����</option><?=$do_class?>
          </select>
          ��� 
          <input type="submit" name="Submit" value="�ಾ">
          <input name="enews" type="hidden" id="enews" value="MoveClassNews">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
