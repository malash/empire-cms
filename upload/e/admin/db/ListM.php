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
CheckLevel($logininid,$loginin,$classid,"m");
$enews=$_GET['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
//�ɥX�ҫ�
if($enews=="LoadOutMod")
{
	include("../../class/moddofun.php");
	LoadOutMod($_GET,$logininid,$loginin);
}
$tid=(int)$_GET['tid'];
$tbname=RepPostVar($_GET['tbname']);
if(!$tid||!$tbname)
{
	printerror("ErrorUrl","history.go(-1)");
}
$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListM.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�޲z�t�μҫ�</a>";
$sql=$empire->query("select * from {$dbtbpre}enewsmod where tid='$tid' order by myorder,mid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�t�μҫ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td class="emenubutton"><input type="button" name="Submit2" value="�W�[�t�μҫ�" onclick="self.location.href='AddM.php?enews=AddM&tid=<?=$tid?>&tbname=<?=$tbname?><?=$ecms_hashur['ehref']?>';">
      &nbsp;&nbsp;&nbsp;
      <input type="button" name="Submit22" value="�ɤJ�t�μҫ�" onclick="window.open('LoadInM.php<?=$ecms_hashur['whehref']?>','','width=520,height=300,scrollbars=yes,top=130,left=120');"></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"><div align="center">ID</div></td>
    <td width="33%" height="25"><div align="center">�ҫ��W��</div></td>
    <td width="7%"><div align="center">�ҥ�</div></td>
    <td width="55%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  	//�q�{
	$defbgcolor='#ffffff';
	$movejs=' onmouseout="this.style.backgroundColor=\'#ffffff\'" onmouseover="this.style.backgroundColor=\'#C3EFFF\'"';
	if($r[isdefault])
	{
		$defbgcolor='#DBEAF5';
		$movejs='';
	}
	$do="[<a href='../../DoInfo/ChangeClass.php?mid=".$r[mid]."' target=_blank>��Z�a�}</a>]&nbsp;&nbsp;[<a href='AddM.php?tid=$tid&tbname=$tbname&enews=AddM&mid=".$r[mid].$ecms_hashur['ehref']."&docopy=1'>�ƻs</a>]&nbsp;&nbsp;[<a href='ListM.php?tid=$tid&tbname=$tbname&enews=LoadOutMod&mid=".$r[mid].$ecms_hashur['href']."' onclick=\"return confirm('�T�{�n�ɥX?');\">�ɥX</a>]&nbsp;&nbsp;[<a href='../ecmsmod.php?tid=$tid&tbname=$tbname&enews=DefM&mid=".$r[mid].$ecms_hashur['href']."' onclick=\"return confirm('�T�{�n�]�m���q�{�t�μҫ�?');\">�]���q�{</a>]&nbsp;&nbsp;[<a href='AddM.php?tid=$tid&tbname=$tbname&enews=EditM&mid=".$r[mid].$ecms_hashur['ehref']."'>�ק�</a>]&nbsp;&nbsp;[<a href='../ecmsmod.php?tid=$tid&tbname=$tbname&enews=DelM&mid=".$r[mid].$ecms_hashur['href']."' onclick=\"return confirm('�T�{�n�R���H');\">�R��</a>]";
	$usemod=$r[usemod]==0?'�O':'<font color="red">�_</font>';
	?>
  <tr bgcolor="<?=$defbgcolor?>"<?=$movejs?>> 
    <td height="32"><div align="center"> 
        <?=$r[mid]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[mname]?>
      </div></td>
    <td><div align="center"><?=$usemod?></div></td>
    <td height="25"><div align="center"> 
        <?=$do?>
      </div></td>
  </tr>
  <?php
	}
	?>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
