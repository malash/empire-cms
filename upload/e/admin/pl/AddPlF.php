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
CheckLevel($logininid,$loginin,$classid,"plf");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListAllPl.php".$ecms_hashur['whehref'].">�޲z����</a>&nbsp;>&nbsp;<a href=ListPlF.php".$ecms_hashur['whehref'].">�޲z���צ۩w�q�r�q</a>&nbsp;>&nbsp;�W�[�r�q";
//�ק�r�q
if($enews=="EditPlF")
{
	$fid=(int)$_GET['fid'];
	$url="<a href=ListAllPl.php".$ecms_hashur['whehref'].">�޲z����</a>&nbsp;>&nbsp;<a href=ListPlF.php".$ecms_hashur['whehref'].">�޲z���צ۩w�q�r�q</a>&nbsp;>&nbsp;�ק�r�q";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsplf where fid='$fid'");
	if(!$r[fid])
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$oftype="type".$r[ftype];
	$$oftype=" selected";
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmspl.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header">�W�[/�ק�r�q 
        <input name="fid" type="hidden" id="fid" value="<?=$fid?>"> <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="oldf" type="hidden" id="oldf" value="<?=$r[f]?>"> </td>
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
      <td height="25">����</td>
      <td height="25"><input type="radio" name="ismust" value="1"<?=$r[ismust]==1?' checked':''?>>
        �O 
        <input type="radio" name="ismust" value="0"<?=$r[ismust]==0?' checked':''?>>
        �_</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�����G</td>
      <td height="25"><textarea name="fzs" cols="65" rows="10" id="fzs"><?=stripSlashes($r[fzs])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
