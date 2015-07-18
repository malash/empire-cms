<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../class/com_functions.php");
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
CheckLevel($logininid,$loginin,$classid,"gbook");

//��q�R���d��(����)
function DelMoreGbook($add,$logininid,$loginin){
	global $empire,$dbtbpre;
    CheckLevel($logininid,$loginin,$classid,"gbook");//�����v��
	//�ܶq�B�z
	$name=RepPostStr($add['name']);
	$ip=RepPostVar($add['ip']);
	$email=RepPostStr($add['email']);
	$mycall=RepPostStr($add['mycall']);
	$lytext=RepPostStr($add['lytext']);
	$startlyid=(int)$add['startlyid'];
	$endlyid=(int)$add['endlyid'];
	$startlytime=RepPostVar($add['startlytime']);
	$endlytime=RepPostVar($add['endlytime']);
	$checked=(int)$add['checked'];
	$ismember=(int)$add['ismember'];
	$bid=(int)$add['bid'];
	$havere=(int)$add['havere'];
	$where='';
	//�d������
	if($bid)
	{
		$where.=" and bid='$bid'";
	}
	//�O�_�|��
	if($ismember)
	{
		if($ismember==1)
		{
			$where.=" and userid=0";
		}
		else
		{
			$where.=" and userid>0";
		}
	}
	//�d��ID
	if($endlyid)
	{
		$where.=' and lyid BETWEEN '.$startlyid.' and '.$endlyid;
	}
	//�o�G�ɶ�
	if($startlytime&&$endlytime)
	{
		$where.=" and lytime>='$startlytime' and lytime<='$endlytime'";
	}
	//�O�_�f��
	if($checked)
	{
		$checkval=$checked==1?0:1;
		$where.=" and checked='$checkval'";
	}
	//�O�_�^�_
	if($havere)
	{
		if($havere==1)
		{
			$where.=" and retext<>''";
		}
		else
		{
			$where.=" and retext=''";
		}
	}
	//�m�W
	if($name)
	{
		$where.=" and name like '%$name%'";
	}
	//�o�GIP
	if($ip)
	{
		$where.=" and ip like '%$ip%'";
	}
	//�l�c
	if($email)
	{
		$where.=" and email like '%$email%'";
	}
	//�q��
	if($mycall)
	{
		$where.=" and `mycall` like '%$mycall%'";
	}
	//�d�����e
	if($lytext)
	{
		$where.=" and lytext like '%$lytext%'";
	}
    if(!$where)
	{
		printerror("EmptyDelMoreGbook","history.go(-1)");
	}
	$where=substr($where,5);
	$sql=$empire->query("delete from {$dbtbpre}enewsgbook where ".$where);
	insert_dolog("");//�ާ@��x
	printerror("DelGbookSuccess","DelMoreGbook.php".hReturnEcmsHashStrHref2(1));
}

$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=='DelMoreGbook')
{
	@set_time_limit(0);
	DelMoreGbook($_POST,$logininid,$loginin);
}

$gbclass=ReturnGbookClass(0,0);

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q�R���d��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href=gbook.php<?=$ecms_hashur['whehref']?>>�޲z�d��</a>&nbsp;>&nbsp;��q�R���d��</td>
  </tr>
</table>
<form name="form1" method="post" action="DelMoreGbook.php" onsubmit="return confirm('�T�{�n�R��?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">��q�R���d�� <input name="enews" type="hidden" id="enews" value="DelMoreGbook"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݯd�������G</td>
      <td height="25"><select name="bid" id="bid">
          <option value="0">����</option>
		  <?=$gbclass?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�d��IP�]�t�G</td>
      <td height="25"><input name=ip type=text id="ip"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�m�W�]�t�G</td>
      <td width="81%" height="25"><input name=name type=text id="name"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�l�c�]�t�G</td>
      <td height="25"><input name=email type=text id="email"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�q�ܥ]�t�G</td>
      <td height="25"><input name=mycall type=text id="mycall"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�d�����e�]�t�G</td>
      <td height="25"><textarea name="lytext" cols="70" rows="5" id="lytext"></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�d��ID ����G</td>
      <td height="25"><input name="startlyid" type="text" id="startlyid">
        -- 
        <input name="endlyid" type="text" id="endlyid"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�d���ɶ� ����G</td>
      <td height="25"><input name="startlytime" type="text" id="startlytime" onclick="setday(this)">
        -- 
        <input name="endlytime" type="text" id="endlytime" onclick="setday(this)">
        <font color="#666666">(�榡�G2011-01-27)</font></td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">�O�_�|���o�G�G</td>
      <td height="25"><input name="ismember" type="radio" value="0" checked>
        ���� 
        <input type="radio" name="ismember" value="1">
        �C�ȵo�G 
        <input type="radio" name="ismember" value="2">
        �|���o�G</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" valign="top">�O�_���^�_�G</td>
      <td height="25"><input name="havere" type="radio" value="0" checked>
        ���� 
        <input name="havere" type="radio" value="1">
        �w�^�_�d�� 
        <input name="havere" type="radio" value="2">
        ���^�_�d��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�O�_�f�֡G</td>
      <td height="25"><input name="checked" type="radio" value="0" checked>
        ���� 
        <input name="checked" type="radio" value="1">
        �w�f�֯d��
<input name="checked" type="radio" value="2">
        ���f�֯d��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�R���d��"> </td>
    </tr>
  </table>
</form>
</body>
</html>
