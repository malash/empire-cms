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

$temptype=RepPostVar($_GET['temptype']);
$gid=(int)$_GET['gid'];
if(!$gid)
{
	$gid=GetDoTempGid();
}
if($temptype=='indexpage')
{
	$gid=1;
}
$tempid=(int)$_GET['tempid'];
if(!$temptype||!$gid||!$tempid)
{
	printerror("ErrorUrl","history.go(-1)");
}
//�ާ@�v��
if($temptype=='tempvar')
{
	CheckLevel($logininid,$loginin,$classid,"tempvar");
}
else
{
	CheckLevel($logininid,$loginin,$classid,"template");
}
$gname=CheckTempGroup($gid);
$sql=$empire->query("select bid,tempname,baktime,lastuser from {$dbtbpre}enewstempbak where temptype='$temptype' and gid='$gid' and tempid='$tempid' order by bid desc");
$url='';
$urlgname=$gname."&nbsp;>&nbsp;";
//�ҪO�W��
if($temptype=='bqtemp')//���ҼҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsbqtemp",$gid)." where tempid='$tempid'");
	$tname='���ҼҪO';
	$url=$urlgname."<a href='ListBqtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z���ҼҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='classtemp')//�ʭ��ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsclasstemp",$gid)." where tempid='$tempid'");
	$tname='�ʭ��ҪO';
	$url=$urlgname."<a href='ListClasstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z�ʭ��ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='jstemp')//JS�ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsjstemp",$gid)." where tempid='$tempid'");
	$tname='JS�ҪO';
	$url=$urlgname."<a href='ListJstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲zJS�ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='listtemp')//�C��ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewslisttemp",$gid)." where tempid='$tempid'");
	$tname='�C��ҪO';
	$url=$urlgname."<a href='ListListtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z�C��ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='newstemp')//���e�ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsnewstemp",$gid)." where tempid='$tempid'");
	$tname='���e�ҪO';
	$url=$urlgname."<a href='ListNewstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z���e�ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='pltemp')//���׼ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewspltemp",$gid)." where tempid='$tempid'");
	$tname='���׼ҪO';
	$url=$urlgname."<a href='ListPltemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z���׼ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='printtemp')//���L�ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsprinttemp",$gid)." where tempid='$tempid'");
	$tname='���L�ҪO';
	$url=$urlgname."<a href='ListPrinttemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z���L�ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='searchtemp')//�j���ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewssearchtemp",$gid)." where tempid='$tempid'");
	$tname='�j���ҪO';
	$url=$urlgname."<a href='ListSearchtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z�j���ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='tempvar')//���@�ҪO�ܶq
{
	$tr=$empire->fetch1("select myvar,varname from ".GetDoTemptb("enewstempvar",$gid)." where varid='$tempid'");
	$tname='���@�ҪO�ܶq';
	$url=$urlgname."<a href='ListTempvar.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z���@�ҪO�ܶq</a>&nbsp;>&nbsp;�ܶq <b>".$tr[myvar]." (".$tr[varname].")</b> ���ק�O��";
}
elseif($temptype=='votetemp')//�벼�ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsvotetemp",$gid)." where tempid='$tempid'");
	$tname='�벼�ҪO';
	$url=$urlgname."<a href='ListVotetemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z�벼�ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='pagetemp')//�۩w�q�����ҪO
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewspagetemp",$gid)." where tempid='$tempid'");
	$tname='�۩w�q�����ҪO';
	$url=$urlgname."<a href='ListPagetemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z�۩w�q�����ҪO</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
elseif($temptype=='indexpage')//������׼ҪO
{
	$tr=$empire->fetch1("select tempname from {$dbtbpre}enewsindexpage where tempid='$tempid'");
	$tname='�������';
	$url=$urlgname."<a href='ListIndexpage.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>�޲z�������</a>&nbsp;>&nbsp;�ҪO <b>$tr[tempname]</b> ���ק�O��";
}
//���@�ҪO
elseif($temptype=='pubindextemp')//�����ҪO
{
	$tname='�����ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�����ҪO</b> ���ק�O��";
}
elseif($temptype=='pubcptemp')//����O�ҪO
{
	$tname='����O�ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>����O�ҪO</b> ���ק�O��";
}
elseif($temptype=='pubsearchtemp')//���ŷj�����ҪO
{
	$tname='���ŷj�����ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>���ŷj�����ҪO</b> ���ק�O��";
}
elseif($temptype=='pubsearchjstemp')//�j��JS�ҪO[��V]
{
	$tname='�j��JS�ҪO[��V]';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�j��JS�ҪO[��V]</b> ���ק�O��";
}
elseif($temptype=='pubsearchjstemp1')//�j��JS�ҪO[�a�V]
{
	$tname='�j��JS�ҪO[�a�V]';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�j��JS�ҪO[�a�V]</b> ���ק�O��";
}
elseif($temptype=='pubotherlinktemp')//�����챵�ҪO
{
	$tname='�����챵�ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�����챵�ҪO</b> ���ק�O��";
}
elseif($temptype=='pubdownsofttemp')//�U���a�}�ҪO
{
	$tname='�U���a�}�ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�U���a�}�ҪO</b> ���ק�O��";
}
elseif($temptype=='pubonlinemovietemp')//�b�u����a�}�ҪO
{
	$tname='�b�u����a�}�ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�b�u����a�}�ҪO</b> ���ק�O��";
}
elseif($temptype=='publistpagetemp')//�C������ҪO
{
	$tname='�C������ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�C������ҪO</b> ���ק�O��";
}
elseif($temptype=='pubpljstemp')//����JS�եμҪO
{
	$tname='����JS�եμҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>����JS�եμҪO</b> ���ק�O��";
}
elseif($temptype=='pubdownpagetemp')//�̲פU�����ҪO
{
	$tname='�̲פU�����ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�̲פU�����ҪO</b> ���ק�O��";
}
elseif($temptype=='pubgbooktemp')//�d���O�ҪO
{
	$tname='�d���O�ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�d���O�ҪO</b> ���ק�O��";
}
elseif($temptype=='publoginiframe')//�n�����A�ҪO
{
	$tname='�n�����A�ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�n�����A�ҪO</b> ���ק�O��";
}
elseif($temptype=='publoginjstemp')//JS�եεn�����A�ҪO
{
	$tname='JS�եεn�����A�ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>JS�եεn�����A�ҪO</b> ���ק�O��";
}
elseif($temptype=='pubschalltemp')//�����j���ҪO
{
	$tname='�����j���ҪO';
	$url=$urlgname."���@�ҪO&nbsp;>&nbsp;<b>�����j���ҪO</b> ���ק�O��";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title><?=$tname?> ���ק�O��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript">
window.resizeTo(550,600);
window.focus();
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
    <td height="25">��m�G<?=$url?></td>
    </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="52%" height="25"> <div align="center">�ק�ɶ�</div></td>
    <td width="29%" height="25"> <div align="center">�ק��</div></td>
    <td width="19%"><div align="center">�٭�</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><div align="center"> 
        <?=date("Y-m-d H:i:s",$r['baktime'])?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r['lastuser']?>
      </div></td>
    <td><div align="center">[<a href="../ecmstemp.php?enews=ReEBakTemp&bid=<?=$r['bid']?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�٭�?');">�٭�</a>]</div></td>
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