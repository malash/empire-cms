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
CheckLevel($logininid,$loginin,$classid,"pubvar");
$enews=ehtmlspecialchars($_GET['enews']);
$cid=(int)$_GET['cid'];
$r[myorder]=0;
$url="<a href=ListPubVar.php".$ecms_hashur['whehref'].">�޲z�X�i�ܶq</a>&nbsp;>&nbsp;�W�[�X�i�ܶq";
//�ק�
if($enews=="EditPubVar")
{
	$varid=(int)$_GET['varid'];
	$r=$empire->fetch1("select myvar,varname,varvalue,varsay,classid,tocache,myorder from {$dbtbpre}enewspubvar where varid='$varid'");
	$r[varvalue]=ehtmlspecialchars($r[varvalue]);
	$url="<a href=ListPubVar.php".$ecms_hashur['whehref'].">�޲z�X�i�ܶq</a>&nbsp;>&nbsp;�ק��X�i�ܶq�G".$r[myvar];
}
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewspubvarclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$r[classid])
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�X�i�ܶq</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="ListPubVar.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�X�i�ܶq 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="varid" type="hidden" value="<?=$varid?>"> 
        <input name="cid" type="hidden" value="<?=$cid?>">
        <input name="oldmyvar" type="hidden" id="oldmyvar" value="<?=$r[myvar]?>">
        <input name="oldtocache" type="hidden" id="oldtocache" value="<?=$r[tocache]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�ܶq�W(*)</td>
      <td width="81%" height="25"> <input name="myvar" type="text" value="<?=$r[myvar]?>">
        <font color="#666666">(�ѭ^��P�Ʀr�զ��A�B����H�Ʀr�}�Y�C�p�G&quot;title&quot;)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݤ���</td>
      <td height="25"><select name="classid">
          <option value="0">�����ݩ�������</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit6222322" value="�޲z����" onclick="window.open('PubVarClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ܶq����(*)</td>
      <td height="25"><input name="varname" type="text" value="<?=$r[varname]?>"> 
        <font color="#666666">(�p�G���D)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�ܶq����</td>
      <td height="25"><input name="varsay" type="text" id="varsay" value="<?=$r[varsay]?>" size="60"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�O�_�g�J�w�s</td>
      <td height="25"><input type="radio" name="tocache" value="1"<?=$r[tocache]==1?' checked':''?>>
        �g�J�w�s 
        <input type="radio" name="tocache" value="0"<?=$r[tocache]==0?' checked':''?>>
        ���g�J�w�s<font color="#666666">�]�j���e����ĳ�g�J�w�s�A�w�s�ե��ܶq�G$public_r['add_�ܶq�W']�^</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ܶq�Ƨ�</td>
      <td height="25"><input name="myorder" type="text" value="<?=$r[myorder]?>">
        <font color="#666666">(�ȶV�p��ܶV�e��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>�ܶq��</strong></td>
      <td height="25">�бN�ܶq���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.varvalue.value);document.form1.varvalue.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('../template/editor.php?<?=$ecms_hashur['ehref']?>&getvar=opener.document.form1.varvalue.value&returnvar=opener.document.form1.varvalue.value&fun=ReturnHtml&notfullpage=1','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="varvalue" cols="90" rows="16" wrap="OFF" style="WIDTH: 100%"><?=$r[varvalue]?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> &nbsp; <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
