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
CheckLevel($logininid,$loginin,$classid,"shopps");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListPs.php".$ecms_hashur['whehref'].">�޲z�t�e�覡</a>&nbsp;>&nbsp;�W�[�t�e�覡";
if($enews=="EditPs")
{
	$pid=(int)$_GET['pid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsshopps where pid='$pid'");
	$url="<a href=ListPs.php".$ecms_hashur['whehref'].">�޲z�t�e�覡</a>&nbsp;>&nbsp;�ק�t�e�覡�G<b>".$r[pname]."</b>";
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
<title>�t�e�覡</title>
<script>
function on()
{
var f=document.add
f.HTML.value=f.psay.value;
}
function bs(){
var f=document.add
f.psay.value=f.HTML.value;
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
<form name="add" method="post" action="ListPs.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="21%" height="25">�W�[�t�e�覡</td>
      <td width="79%" height="25"><input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="pid" type="hidden" id="pid" value="<?=$pid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�覡�W��:</td>
      <td height="25"><input name="pname" type="text" id="pname" value="<?=$r[pname]?>">
        (�p:���q�l��) </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�B�O���B:</td>
      <td height="25"><input name="price" type="text" id="price" value="<?=$r[price]?>" size="8">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�Բӻ���:</td>
      <td height="25">
		<?=ECMS_ShowEditorVar('psay',$r[psay],'Default','../ecmseditor/infoeditor/')?>      </td>
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
