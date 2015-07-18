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
CheckLevel($logininid,$loginin,$classid,"dttemp");
//����
if(!$ecms_config['esafe']['openeditdttemp'])
{
	echo"�S���}�Ҧb�u�ק�ʺA�����ҪO";
	exit();
}

//���o�ʺA�ҪO���e
function GetDtTempFiletext($tempid){
	global $empire,$dbtbpre;
	$tempid=(int)$tempid;
	if(!$tempid)
	{
		printerror('ErrorUrl','');
	}
	$tempr=$empire->fetch1("select * from {$dbtbpre}enewstempdt where tempid='$tempid'");
	if(!$tempr['tempid'])
	{
		printerror('ErrorUrl','');
	}
	$file=ECMS_PATH.$tempr['tempfile'];
	if(!file_exists($file))
	{
		printerror('FileNotExist','');
	}
	$tempr['temptext']=ReadFiletext($file);
	return $tempr;
}

//�ק�ʺA�ҪO���e
function EditDtTempFiletext($add,$userid,$username){
	global $empire,$dbtbpre;
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,'dttemp');
	$tempid=(int)$add['tempid'];
	if(!$tempid)
	{
		printerror('ErrorUrl','');
	}
	$tempr=$empire->fetch1("select tempid,tempname,tempvar,tempfile from {$dbtbpre}enewstempdt where tempid='$tempid'");
	if(!$tempr['tempid'])
	{
		printerror('ErrorUrl','');
	}
	$file=ECMS_PATH.$tempr['tempfile'];
	if(!file_exists($file))
	{
		printerror('FileNotExist','');
	}
	$temptext=ClearAddsData($add['temptext']);
	WriteFiletext_n($file,$temptext);
	//�ާ@��x
	insert_dolog("tempid=".$tempid."<br>tempname=".$tempr['tempname']);
	printerror("EditDttempSuccess","EditDttemp.php?tempid=$tempid".hReturnEcmsHashStrHref2(0));
}

//�ާ@
$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include("../../class/tempfun.php");
}
//�W�[�ҪO
if($enews=="EditDtTempFiletext")
{
	EditDtTempFiletext($_POST,$logininid,$loginin);
}
else
{}

//�ק�
$tempid=(int)$_GET['tempid'];
$r=GetDtTempFiletext($tempid);
$url="�ק�ʺA�����ҪO: ".$r['tempname'];
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ק�ʺA�����ҪO</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.temptext.value=html;
}
</script>
<SCRIPT lanuage="JScript">
<!--
function tempturnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
-->
</SCRIPT>
<script>
function ReTempBak(){
	self.location.reload();
}
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="EditDttemp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        �ק�ʺA�����ҪO
        <input name="enews" type="hidden" id="enews" value="EditDtTempFiletext"> <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�ҪO�W��(*)</td>
      <td width="81%" height="25"> <input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>" size="30">      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ҪO���a�}</td>
      <td height="25">/<?=$r[tempfile]?></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>�ҪO���e</strong>(*)</td>
      <td height="25">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.temptext.value);document.form1.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="temptext" cols="90" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars($r[temptext])?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�O�s�ҪO"> &nbsp;<input type="reset" name="Submit2" value="���m"></td>
    </tr>
	</form>
  </table>
</body>
</html>
