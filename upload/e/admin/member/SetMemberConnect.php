<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
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
CheckLevel($logininid,$loginin,$classid,"memberconnect");
$enews=ehtmlspecialchars($_GET['enews']);
$id=(int)$_GET['id'];
$r=$empire->fetch1("select * from {$dbtbpre}enewsmember_connect_app where id='$id'");
$url="�~�����f &gt; <a href=MemberConnect.php".$ecms_hashur['whehref'].">�޲z�~���n�����f</a>&nbsp;>&nbsp;�t�m�~���n�����f�G<b>".$r[apptype]."</b>";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�~���n�����f</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">��m�G 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton"></div></td>
  </tr>
</table>
<form name="setmemberconnectform" method="post" action="MemberConnect.php" enctype="multipart/form-data">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�t�m�~���n�����f 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="id" type="hidden" id="id" value="<?=$id?>">      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">���f�����G</div></td>
      <td height="25"> 
        <?=$r[apptype]?>      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">���f���A�G</div></td>
      <td height="25"><input type="radio" name="isclose" value="0"<?=$r[isclose]==0?' checked':''?>>
        �}�� 
        <input type="radio" name="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
        ����</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25"><div align="right">���f�W�١G</div></td>
      <td width="77%" height="25"><input name="appname" type="text" id="appname" value="<?=$r[appname]?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="right">���f�O�W�G</div></td>
      <td height="25"><input name="qappname" type="text" id="qappname" value="<?=$r[qappname]?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><div align="right">���f�y�z�G</div></td>
      <td height="25"><textarea name="appsay" cols="65" rows="6" id="appsay"><?=ehtmlspecialchars($r[appsay])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">appid�G</div></td>
      <td height="25"><input name="appid" type="text" id="appid" value="<?=$r[appid]?>" size="35">
        <font color="#666666">(�ӽЪ�����ID)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">appkey�G</div></td>
      <td height="25"><input name="appkey" type="text" id="appkey" value="<?=$r[appkey]?>" size="35">
        <font color="#666666">(�ӽЪ����αK�_)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="right">��ܱƧǡG</div></td>
      <td height="25"><input name=myorder type=text id="myorder" value='<?=$r[myorder]?>' size="35">
        <font color="#666666">(�ȶV�p��ܶV�e��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value=" �] �m "> &nbsp;&nbsp;&nbsp; 
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
