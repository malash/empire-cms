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
CheckLevel($logininid,$loginin,$classid,"cj");
//--------------------�ާ@�����
$fcfile="../data/fc/ListEnews.php";
$do_class="<script src=../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$do_class=ShowClass_AddClass("","n",0,"|-",0,0);}
db_close();
$empire=null;
if($_GET['from'])
{
	$listclasslink="ListPageInfoClass.php";
}
else
{
	$listclasslink="ListInfoClass.php";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�Ķ��`�I</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function changecj(obj)
{
	if(obj.newsclassid.value=="nono")
	{
		alert("�п�����");
	}
	else
	{
		self.location.href='AddInfoClass.php?<?=$ecms_hashur['ehref']?>&enews=AddInfoClass&from=<?=RepPostStr($_GET['from'],1)?>&newsclassid='+obj.newsclassid.value;
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G�Ķ�&nbsp;&gt;&nbsp;<a href='<?=$listclasslink?><?=$ecms_hashur['whehref']?>'>�޲z�`�I</a>&nbsp;&gt;&nbsp;�W�[�`�I</td>
  </tr>
</table>

<form name="form1" method="post" action="enews.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['eform']?>
    <tr class="header"> 
      <td height="25"><div align="center">�п�ܭn�W�[�Ķ������</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <select name="newsclassid" id="newsclassid" onchange='javascript:changecj(document.form1);'>
            <option value=''>������</option>
            <option value='0'>�D�Ķ��`�I(���`�I)</option>
            <?=$do_class?>
          </select>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center"><font color="#666666">(�Ķ��`�I�n��ܲ׷����)</font></div></td>
    </tr>
  </table>
</form>
</body>
</html>
