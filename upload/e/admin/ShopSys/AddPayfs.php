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
CheckLevel($logininid,$loginin,$classid,"shoppayfs");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListPayfs.php".$ecms_hashur['whehref'].">�޲z��I�覡</a>&nbsp;>&nbsp;�W�[��I�覡";
if($enews=="EditPayfs")
{
	$payid=(int)$_GET['payid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsshoppayfs where payid='$payid'");
	$url="<a href=ListPayfs.php".$ecms_hashur['whehref'].">�޲z��I�覡</a>&nbsp;>&nbsp;�ק��I�覡�G<b>".$r[payname]."</b>";
	if($r[userpay])
	{$userpay=" checked";}
	if($r[userfen])
	{$userfen=" checked";}
}
//--------------------html�s�边
include('../ecmseditor/infoeditor/fckeditor.php');
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>��I�覡</title>
<script>
function on()
{
var f=document.add
f.HTML.value=f.paysay.value;
}
function bs(){
var f=document.add
f.paysay.value=f.HTML.value;
}
function br(){
if(!confirm("�O�_�_��H")){return false;}
document.add.title.select()
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="add" method="post" action="ListPayfs.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="21%" height="25">�W�[��I�覡</td>
      <td width="79%" height="25"><input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="payid" type="hidden" id="payid" value="<?=$payid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�覡�W��:</td>
      <td height="25"><input name="payname" type="text" id="payname" value="<?=$r[payname]?>">
        (�p:�l���״�) </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input name="userpay" type="checkbox" id="userpay" value="1"<?=$userpay?>>
        <strong>�������b</strong>(�D���b�Фſ��)</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25"><input name="userfen" type="checkbox" id="userfen" value="1"<?=$userfen?>>
        <strong>�I���ʶR</strong>(�D�I���ʶR�Фſ��)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�b�u��I�a�}:</td>
      <td height="25"><input name="payurl" type="text" id="payurl" value="<?=$r[payurl]?>" size="52">
        (�b�u��I/�����I�ж�g)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�Բӻ���:</td>
      <td height="25">
	  <?=ECMS_ShowEditorVar('paysay',$r[paysay],'Default','../ecmseditor/infoeditor/')?>      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�O�_�ҥ�</td>
      <td height="25"><input type="radio" name="isclose" value="0"<?=$r[isclose]==0?' checked':''?>>
      �}��
        <input type="radio" name="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
      ����</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
