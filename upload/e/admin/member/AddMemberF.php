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
CheckLevel($logininid,$loginin,$classid,"memberf");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href='ListMemberF.php".$ecms_hashur['whehref']."'>�޲z�|���r�q</a>&nbsp;>&nbsp;�W�[�|���r�q";
$postword='�W�[�r�q';
$r[myorder]=0;
//�ק�r�q
if($enews=="EditMemberF")
{
	$fid=(int)$_GET['fid'];
	$url="<a href='ListMemberF.php".$ecms_hashur['whehref']."'>�޲z�|���r�q</a>&nbsp;>&nbsp;�ק�|���r�q";
	$postword='�ק�r�q';
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmemberf where fid='$fid'");
	if(!$r[fid])
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$oftype="type".$r[ftype];
	$$oftype=" selected";
	$ofform="form".$r[fform];
	$$ofform=" selected";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�r�q</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmsmember.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header"> 
        <?=$postword?>
        <input name="fid" type="hidden" id="fid" value="<?=$fid?>"> <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="oldfform" type="hidden" id="oldfform" value="<?=$r[fform]?>"> 
        <input name="oldf" type="hidden" id="oldf" value="<?=$r[f]?>"> <input name="oldfvalue" type="hidden" id="oldfvalue" value="<?=$r[fvalue]?>">
        <input name="oldfformsize" type="hidden" id="oldfformsize" value="<?=$r[fformsize]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="25%" height="25">�r�q�W</td>
      <td width="75%" height="25"><input name="f" type="text" id="f" value="<?=$r[f]?>"> 
        <font color="#666666">(��p�G&quot;title&quot;)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�r�q����</td>
      <td height="25"><input name="fname" type="text" id="fname" value="<?=$r[fname]?>"> 
        <font color="#666666">(��p�G&quot;���D&quot;)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�r�q����</td>
      <td height="25"><select name="ftype" id="select">
          <option value="VARCHAR"<?=$typeVARCHAR?>>�r�ū�0-255�r�`(VARCHAR)</option>
          <option value="TEXT"<?=$typeTEXT?>>�p���r�ū�(TEXT)</option>
          <option value="MEDIUMTEXT"<?=$typeMEDIUMTEXT?>>�����r�ū�(MEDIUMTEXT)</option>
          <option value="LONGTEXT"<?=$typeLONGTEXT?>>�j���r�ū�(LONGTEXT)</option>
          <option value="TINYINT"<?=$typeTINYINT?>>�p�ƭȫ�(TINYINT)</option>
          <option value="SMALLINT"<?=$typeSMALLINT?>>���ƭȫ�(SMALLINT)</option>
          <option value="INT"<?=$typeINT?>>�j�ƭȫ�(INT)</option>
          <option value="BIGINT"<?=$typeBIGINT?>>�W�j�ƭȫ�(BIGINT)</option>
          <option value="FLOAT"<?=$typeFLOAT?>>�ƭȯB�I��(FLOAT)</option>
          <option value="DOUBLE"<?=$typeDOUBLE?>>�ƭ�����׫�(DOUBLE)</option>
        </select>
        �r�q���� 
        <input name="flen" type="text" id="flen" value="<?=$r[flen]?>" size="6"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2">��J�����ܤ���</td>
      <td height="25"><select name="fform" id="fform">
          <option value="text"<?=$formtext?>>���奻��(text)</option>
          <option value="password"<?=$formpassword?>>�K�X��(password)</option>
          <option value="select"<?=$formselect?>>�U�Ԯ�(select)</option>
          <option value="radio"<?=$formradio?>>����(radio)</option>
		  <option value="checkbox"<?=$formcheckbox?>>�_���(checkbox)</option>
          <option value="textarea"<?=$formtextarea?>>�h��奻��(textarea)</option>
          <option value="img"<?=$formimg?>>�Ϥ�(img)</option>
          <option value="file"<?=$formfile?>>���(file)</option>
        </select>
        �������� 
        <input name="fformsize" type="text" id="fformsize" value="<?=$r[fformsize]?>" size="12"> 
        <font color="#666666">(�Ŭ����q�{)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><font color="#666666">�����G���צp�G�O�u�h��奻�ءv�A���׻P��ƥγr����}�A�p�u60,6�v.</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">��l��<br>
        <font color="#666666"><span id="defvaldiv">(�h�ӭȥ�&quot;�^��&quot;��}�F<br>
        �q�{�ﶵ�᭱�[�G:default)</span></font></td>
      <td height="25"><textarea name="fvalue" cols="65" rows="8" id="fvalue" style="WIDTH: 100%"><?=str_replace("|","\r\n",$r[fvalue])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ܶ���</td>
      <td height="25"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="6"> 
        <font color="#666666">(�Ʀr�V�p�V�e��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">��J������html�N�X<br> <font color="#666666">(�W�[�r�q�ɽЯd��)</font></td>
      <td height="25"><textarea name="fhtml" cols="65" rows="10" id="fhtml" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[fhtml]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">����</td>
      <td height="25"><textarea name="fzs" cols="65" rows="10" id="fzs" style="WIDTH: 100%"><?=stripSlashes($r[fzs])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
