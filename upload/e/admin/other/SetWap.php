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
CheckLevel($logininid,$loginin,$classid,"wap");

//�]�m
function SetWap($add,$userid,$username){
	global $empire,$dbtbpre;
	$wapopen=(int)$add['wapopen'];
	$wapdefstyle=(int)$add['wapdefstyle'];
	$wapshowmid=RepPostVar($add['wapshowmid']);
	$waplistnum=(int)$add['waplistnum'];
	$wapsubtitle=(int)$add['wapsubtitle'];
	$wapchar=(int)$add['wapchar'];
	$sql=$empire->query("update {$dbtbpre}enewspublic set wapopen=$wapopen,wapdefstyle=$wapdefstyle,wapshowmid='$wapshowmid',waplistnum=$waplistnum,wapsubtitle=$wapsubtitle,wapshowdate='$add[wapshowdate]',wapchar=$wapchar limit 1");
	//�ާ@��x
	insert_dolog("");
	printerror("SetWapSuccess","SetWap.php".hReturnEcmsHashStrHref2(1));
}

$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=='SetWap')
{
	SetWap($_POST,$logininid,$loginin);
}

$r=$empire->fetch1("select wapopen,wapdefstyle,wapshowmid,waplistnum,wapsubtitle,wapshowdate,wapchar from {$dbtbpre}enewspublic limit 1");
//wap�ҪO
$wapdefstyles='';
$stylesql=$empire->query("select styleid,stylename from {$dbtbpre}enewswapstyle order by styleid");
while($styler=$empire->fetch($stylesql))
{
	$select='';
	if($styler['styleid']==$r['wapdefstyle'])
	{
		$select=' selected';
	}
	$wapdefstyles.="<option value='".$styler[styleid]."'".$select.">".$styler[stylename]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>WAP�]�m</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">��m�G<a href="SetWap.php<?=$ecms_hashur['whehref']?>">WAP�]�m</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit522" value="�޲zWAP�ҪO" onclick="self.location.href='WapStyle.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<form name="setwapform" method="post" action="SetWap.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">WAP�]�m 
        <input name=enews type=hidden value=SetWap></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�}��WAP</td>
      <td height="25"><input type="radio" name="wapopen" value="1"<?=$r[wapopen]==1?' checked':''?>>
        �O 
        <input type="radio" name="wapopen" value="0"<?=$r[wapopen]==0?' checked':''?>>
        �_ </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">WAP�r�Ŷ�</td>
      <td height="25"><input type="radio" name="wapchar" value="1"<?=$r[wapchar]==1?' checked':''?>>
        UTF-8 
        <input type="radio" name="wapchar" value="0"<?=$r[wapchar]==0?' checked':''?>>
        UNICODE <font color="#666666">(�q�{�� UNICODE �s�X)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�u��ܨt�μҫ��C��</td>
      <td height="25"><input name="wapshowmid" type="text" id="wapshowmid" value="<?=$r[wapshowmid]?>"> 
        <font color="#666666">(�h�Ӽҫ�ID��&quot;,&quot;�j�},�Ŭ���ܩҦ�)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="20%" height="25">�q�{�ϥ�WAP�ҪO</td>
      <td width="80%" height="25"><select name="wapdefstyle" id="wapdefstyle">
          <?=$wapdefstyles?>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�C��C�����</td>
      <td height="25"> <input name="waplistnum" type="text" id="waplistnum" value="<?=$r[waplistnum]?>">
        ���H��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���D�I��</td>
      <td height="25"> <input name="wapsubtitle" type="text" id="wapsubtitle" value="<?=$r[wapsubtitle]?>">
        �Ӧr�` <font color="#666666">(0�����I��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ɶ���ܮ榡</td>
      <td height="25"><input name="wapshowdate" type="text" id="wapshowdate" value="<?=$r[wapshowdate]?>"> 
        <font color="#666666">(�榡�GY��ܦ~,m��ܤ�,d��ܤ�)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25">WAP�a�}�G<a href="<?=$public_r[newsurl]?>e/wap/" target="_blank"><?=$public_r[newsurl]?>e/wap/</a></td>
    </tr>
  </table>
</form>
</body>
</html>
