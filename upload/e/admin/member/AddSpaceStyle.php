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
CheckLevel($logininid,$loginin,$classid,"spacestyle");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href='ListSpaceStyle.php".$ecms_hashur['whehref']."'>�޲z�|���Ŷ��ҪO</a>&nbsp;->&nbsp;�W�[�|���Ŷ��ҪO";
if($enews=="EditSpaceStyle")
{
	$styleid=(int)$_GET['styleid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsspacestyle where styleid='$styleid'");
	$url="<a href='ListSpaceStyle.php".$ecms_hashur['whehref']."'>�޲z�|���Ŷ��ҪO</a>&nbsp;->&nbsp;�ק�|���Ŷ��ҪO�G<b>".$r[stylename]."</b>";
}
//�|����
$line=5;//�@����ܤ���
$i=0;
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($mgsql))
{
	$i++;
	$br='';
	if($i%$line==0)
	{
		$br='<br>';
	}
	if(strstr($r['membergroup'],','.$level_r['groupid'].','))
	{$checked=" checked";}
	else
	{$checked="";}
	$membergroup.="<input type='checkbox' name='membergroup[]' value='$level_r[groupid]'".$checked.">".$level_r[groupname]."&nbsp;".$br;
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�|���Ŷ��ҪO</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListSpaceStyle.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="21%" height="25">�W�[�|���Ŷ��ҪO</td>
      <td width="79%" height="25"><input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="styleid" type="hidden" id="styleid" value="<?=$styleid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ҪO�W��</td>
      <td height="25"> <input name="stylename" type="text" id="stylename" value="<?=$r[stylename]?>" size="30"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ҪO�Y����</td>
      <td height="25"> <input name="stylepic" type="text" id="stylepic" value="<?=$r[stylepic]?>" size="30"> 
        <a onclick="window.open('../ecmseditor/FileMain.php?modtype=5&type=1&classid=&doing=2&field=stylepic<?=$ecms_hashur['ehref']?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" width="22" height="22" border="0" align="absbottom"></a> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�i��ܦ��ҪO���|����<br>
        <font color="#666666">(���אּ������|����)</font> </td>
      <td height="25"><?=$membergroup?></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ҪO�ؿ�</td>
      <td height="25"> e/space/template/ 
        <input name="stylepath" type="text" id="stylepath" value="<?=$r[stylepath]?>" size="9"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"> <p>�ҪO����</p></td>
      <td height="25"><textarea name="stylesay" cols="60" rows="5"><?=$r[stylesay]?></textarea> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
