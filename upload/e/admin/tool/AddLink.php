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
CheckLevel($logininid,$loginin,$classid,"link");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href='ListLink.php".$ecms_hashur['whehref']."'>�޲z�ͱ��챵</a>  &gt; �W�[�ͱ��챵";
$r[lurl]="http://";
$r[width]=88;
$r[height]=31;
$target0="";
$target1="";
$r[onclick]=0;
$r[myorder]=0;
$checked=" checked";
$cid=(int)$_GET['cid'];
if($enews=="EditLink")
{
	$lid=(int)$_GET['lid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewslink where lid='$lid'");
	if($r[target]=="_parent")
	{$target1=" selected";}
	if(empty($r[checked]))
	{$checked="";}
	$url="<a href='ListLink.php".$ecms_hashur['whehref']."'>�޲z�ͱ��챵</a>  &gt; �ק�ͱ��챵�G<b>".$r[lname]."</b>";
}
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewslinkclass order by classid");
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
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�ͱ��챵</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListLink.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�ͱ��챵 <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="lid" type="hidden" id="lid" value="<?=$lid?>"> <input name="cid" type="hidden" id="cid" value="<?=$cid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="26%" height="25">���I�W��:(*)</td>
      <td width="74%" height="25"> <input name="lname" type="text" id="lname" value="<?=$r[lname]?>" size="42"> 
        <input name="checked" type="checkbox" id="checked" value="1"<?=$checked?>>
        ���</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top">���I�ϼ�:</td>
      <td height="25"> <input name="lpic" type="text" id="lpic" value="<?=$r[lpic]?>" size="42"> 
        <a onclick="window.open('../ecmseditor/FileMain.php?modtype=5&type=1&classid=&doing=2&field=lpic<?=$ecms_hashur['ehref']?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" width="22" height="22" border="0" align="absbottom"></a> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�e 
        <input name="width" type="text" id="width" value="<?=$r[width]?>" size="6">
        * �� 
        <input name="height" type="text" id="height" value="<?=$r[height]?>" size="6">
        (����ܹϤ�����r�챵)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���I�a�}:(*)</td>
      <td height="25"> <input name="lurl" type="text" id="lurl" value="<?=$r[lurl]?>" size="42"> 
        <select name=target>
          <option value="_blank"<?=$target0?>>�b�s���f���}</option>
          <option value="_parent"<?=$target1?>>�b�쵡�f���}</option>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݤ����G</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">�����ݩ�������</option>
          <?=$cstr?>
        </select>
        <input type="button" name="Submit3" value="�޲z����" onclick="window.open('LinkClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�I��:</td>
      <td height="25"><input name="onclick" type="text" id="onclick" value="<?=$r[onclick]?>" size="6"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ܶ���:</td>
      <td height="25"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="6">
        (�V�p�V�e��)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����Email:</td>
      <td height="25"><input name="email" type="text" id="email" value="<?=$r[email]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���I²��:</td>
      <td height="25"><textarea name="lsay" cols="60" rows="6" id="lsay"><?=ehtmlspecialchars($r[lsay])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
