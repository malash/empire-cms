<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"dbdata");
$bakpath=$public_r['bakdbpath'];
$hand=@opendir($bakpath);
$form='ebakredata';
if($_GET['toform'])
{
	$form=RepPostVar($_GET['toform']);
}
$onclickword='(�I����V��_�ƾ�)';
$change=(int)$_GET['change'];
if($change==1)
{
	$onclickword='(�I�����)';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�ƥ��ؿ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ChangePath(pathname)
{
opener.document.<?=$form?>.mypath.value=pathname;
window.close();
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G<a href="ChangePath.php<?=$ecms_hashur['whehref']?>">�޲z�ƥ��ؿ�</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="45%" height="25"> 
      <div align="center">�ƥ��ؿ��W<?=$onclickword?></div></td>
    <td width="20%" height="25"> 
      <div align="center">�d�ݻ������</div></td>
    <td width="35%"> 
      <div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($file=@readdir($hand))
  {
	if($file!="."&&$file!=".."&&is_dir($bakpath."/".$file))
	{
		if($change==1)
		{
			$showfile="<a href='#ebak' onclick=\"javascript:ChangePath('$file');\" title='$file'>$file</a>";
		}
		else
		{
			$showfile="<a href='phome.php?phome=PathGotoRedata&mypath=$file".$ecms_hashur['href']."' title='$file'>$file</a>";
		}
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="left"><img src="images/dir.gif" width="19" height="15">&nbsp; 
        <?=$showfile?> </div></td>
    <td height="25"> <div align="center"> [<a href="<?php echo $bakpath."/".$file."/readme.txt"?>" target=_blank>�d�ݳƥ�����</a>]</div></td>
    <td><div align="center">[<a href="#ebak" onclick="window.open('phome.php?phome=DoZip&p=<?=$file?>&change=<?=$change?><?=$ecms_hashur['href']?>','','width=350,height=160');">���]�äU��</a>]&nbsp;&nbsp;&nbsp;[<a href="phome.php?phome=DelBakpath&path=<?=$file?>&change=<?=$change?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R���ؿ�</a>]</div></td>
  </tr>
  <?php
     }
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3">&nbsp;</td>
  </tr>
</table>
</body>
</html>