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
CheckLevel($logininid,$loginin,$classid,"setsafe");
if($ecms_config['esafe']['openonlinesetting']==0||$ecms_config['esafe']['openonlinesetting']==1)
{
	echo"�S���}�ҫ�x�b�u�t�m�ѼơA�p�G�n�ϥΦb�u�t�m���ק�/e/config/config.php���\$ecms_config['esafe']['openonlinesetting']�ܶq�]�m�}��";
	exit();
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include('setfun.php');
}
if($enews=='SetSafe')
{
	SetSafe($_POST,$logininid,$loginin);
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�w���Ѽưt�m</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G<a href="SetSafe.php<?=$ecms_hashur['whehref']?>">�w���Ѽưt�m</a> 
      <div align="right"> </div></td>
  </tr>
</table>
<form name="setform" method="post" action="SetSafe.php" onsubmit="return confirm('�T�{�]�m?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�w���Ѽưt�m 
        <input name="enews" type="hidden" id="enews" value="SetSafe"> </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��x�w�������t�m</td>
    </tr>
    <tr> 
      <td width="17%" height="25" bgcolor="#FFFFFF"> <div align="left">��x�n���{�ҽX</div></td>
      <td width="83%" height="25" bgcolor="#FFFFFF"> <input name="loginauth" type="password" id="loginauth" value="<?=$ecms_config['esafe']['loginauth']?>" size="35"> 
        <font color="#666666">(�p�G�]�m�n���ݭn��J���{�ҽX�~��q�L)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="left">��x�n��COOKIE�{�ҽX</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name="ecookiernd" type="text" id="ecookiernd" value="<?=$ecms_config['esafe']['ecookiernd']?>" size="35"> 
        <input type="button" name="Submit3" value="�H��" onclick="document.setform.ecookiernd.value='<?=make_password(36)?>';"> 
        <font color="#666666">(��g10~50�ӥ��N�r�šA�̦n�h�ئr�ŲզX)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��x�}�����ҵn��IP</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="ckhloginip" value="1"<?=$ecms_config['esafe']['ckhloginip']==1?' checked':''?>>
        �}�� 
        <input type="radio" name="ckhloginip" value="0"<?=$ecms_config['esafe']['ckhloginip']==0?' checked':''?>>
        ���� <font color="#666666">(�p�G�W����IP�O�ܰʪ��A���n�}��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��x�ҥ�SESSION����</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ckhsession" value="1"<?=$ecms_config['esafe']['ckhsession']==1?' checked':''?>>
        �}�� 
        <input type="radio" name="ckhsession" value="0"<?=$ecms_config['esafe']['ckhsession']==0?' checked':''?>>
        ���� <font color="#666666">(��w���A�ݪŶ����SESSION)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O���n����x</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="theloginlog" value="0"<?=$ecms_config['esafe']['theloginlog']==0?' checked':''?>>
        �}�� 
        <input type="radio" name="theloginlog" value="1"<?=$ecms_config['esafe']['theloginlog']==1?' checked':''?>>
        ����</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O���ާ@��x</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="thedolog" value="0"<?=$ecms_config['esafe']['thedolog']==0?' checked':''?>>
        �}�� 
        <input type="radio" name="thedolog" value="1"<?=$ecms_config['esafe']['thedolog']==1?' checked':''?>>
        ����</td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�}�ҳX�ݨӷ�����</td>
      <td height="25" bgcolor="#FFFFFF"><select name="ckfromurl" id="ckfromurl">
          <option value="0"<?=$ecms_config['esafe']['ckfromurl']==0?' selected':''?>>���}������</option>
          <option value="1"<?=$ecms_config['esafe']['ckfromurl']==1?' selected':''?>>�}�ҫe��x����</option>
          <option value="2"<?=$ecms_config['esafe']['ckfromurl']==2?' selected':''?>>�ȶ}�ҫ�x����</option>
          <option value="3"<?=$ecms_config['esafe']['ckfromurl']==3?' selected':''?>>�ȶ}�ҫe�x����</option>
        </select>
        <font color="#666666">(�]�m�T��D�����X�ݦa�}�ӷ�)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�}�ҫ�x�ӷ��{�ҽX</td>
      <td height="25" bgcolor="#FFFFFF"><select name="ckhash" id="ckhash">
        <option value="0"<?=$ecms_config['esafe']['ckhash']==0?' selected':''?>>����Ҧ�</option>
        <option value="1"<?=$ecms_config['esafe']['ckhash']==1?' selected':''?>>��糼Ҧ�</option>
        <option value="2"<?=$ecms_config['esafe']['ckhash']==2?' selected':''?>>��������</option>
      </select>
        <font color="#666666">(���˱ҥΡu����Ҧ��v�A��~���X�ݻP����i�樾�m)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">COOKIE�t�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE�@�ΰ�</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="cookiedomain" type="text" id="fw_pass3" value="<?=$ecms_config['cks']['ckdomain']?>" size="35">      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE�@�θ��|</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookiepath" type="text" id="cookiedomain" value="<?=$ecms_config['cks']['ckpath']?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�e�xCOOKIE�ܶq�e��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookievarpre" type="text" id="cookievarpre" value="<?=$ecms_config['cks']['ckvarpre']?>" size="35"> 
        <font color="#666666">(�ѭ^��r���զ�,5~12�Ӧr�Ųզ�)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��xCOOKIE�ܶq�e��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookieadminvarpre" type="text" id="cookieadminvarpre" value="<?=$ecms_config['cks']['ckadminvarpre']?>" size="35"> 
        <font color="#666666">(�ѭ^��r���զ�,5~12�Ӧr�Ųզ�)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE�����H���X</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="cookieckrnd" type="text" id="cookieckrnd" value="<?=$ecms_config['cks']['ckrnd']?>" size="35"> 
        <input type="button" name="Submit32" value="�H��" onclick="document.setform.cookieckrnd.value='<?=make_password(36)?>';"> 
        <font color="#666666">(��g10~50�ӥ��N�r�šA�̦n�h�ئr�ŲզX)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">COOKIE�����H���X2</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookieckrndtwo" type="text" id="cookieckrndtwo" value="<?=$ecms_config['cks']['ckrndtwo']?>" size="35">
        <input type="button" name="Submit322" value="�H��" onclick="document.setform.cookieckrndtwo.value='<?=make_password(36)?>';">
        <font color="#666666">(��g10~50�ӥ��N�r�šA�̦n�h�ئr�ŲզX)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"></td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value=" �] �m "> 
        &nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
