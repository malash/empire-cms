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
//CheckLevel($logininid,$loginin,$classid,"pl");

$todaydate=date('Y-m-d');
$yesterday=date('Y-m-d',time()-24*3600);
//�|��
$membertb=eReturnMemberTable();
$checkmembernum=$empire->gettotal("select count(*) as total from ".$membertb." where ".egetmf('checked')."=0");
$allmembernum=eGetTableRowNum($membertb);
//�޲z��
$adminnum=eGetTableRowNum($dbtbpre.'enewsuser');
//�q��
$showshopmenu=stristr($public_r['closehmenu'],',shop,')?0:1;
if($showshopmenu)
{
	$allddnum=eGetTableRowNum($dbtbpre.'enewsshopdd');
	$todayddnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsshopdd where ddtime>='".$todaydate." 00:00:00' and ddtime<='".$todaydate." 23:59:59' limit 1");
	$yesterdayddnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsshopdd where ddtime>='".$yesterday." 00:00:00' and ddtime<='".$yesterday." 23:59:59' limit 1");
}
//�d��
$allgbooknum=eGetTableRowNum($dbtbpre.'enewsgbook');
$checkgbooknum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsgbook where checked=1");
//���X
$allfeedbacknum=eGetTableRowNum($dbtbpre.'enewsfeedback');
$noreadfeedbacknum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsfeedback where haveread=0");
//�s�i
$alladnum=eGetTableRowNum($dbtbpre.'enewsad');
$outtimeadnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsad where endtime<'$todaydate' and endtime<>'0000-00-00'");
//���~���i
$errornum=eGetTableRowNum($dbtbpre.'enewsdownerror');
//�ͱ��챵
$sitelinknum=eGetTableRowNum($dbtbpre.'enewslink');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�έp</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function OpenShopSysDdPage(){
	window.open('../openpage/AdminPage.php?leftfile=<?=urlencode('../ShopSys/pageleft.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../ShopSys/ListDd.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�ӫ��t�κ޲z')?><?=$ecms_hashur['ehref']?>','AdminShopSys','');
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="OtherMain.php<?=$ecms_hashur['whehref']?>">��L�έp</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="10%" height="25" bgcolor="#C9F1FF"><div align="center"><a href="../info/InfoMain.php<?=$ecms_hashur['whehref']?>">�H���έp</a></div></td>
      <td width="10%" bgcolor="#C9F1FF"><div align="center"><a href="../pl/PlMain.php<?=$ecms_hashur['whehref']?>">���ײέp</a></div></td>
      <td width="10%" class="header"><div align="center"><a href="../other/OtherMain.php<?=$ecms_hashur['whehref']?>">��L�έp</a></div></td>
      <td width="58%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
    </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="2">��L�έp</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="18%" height="25">
		<div align="center"><strong>�|��</strong></div></td>
    <td width="82%" align="right"><div align="left">�ݼf�ַ|���G<a href="../member/ListMember.php?sear=1&schecked=1<?=$ecms_hashur['ehref']?>" target="_blank"><?=$checkmembernum?></a>�A�|���`�ơG<a href="../member/ListMember.php<?=$ecms_hashur['whehref']?>" target="_blank"><?=$allmembernum?></a></div></td>
  </tr>
  <tr bgcolor="#C3EFFF">
    <td height="25"><div align="center"><strong>�޲z��</strong></div></td>
    <td align="right"><div align="left">�޲z���`�ơG<a href="../user/ListUser.php<?=$ecms_hashur['whehref']?>" target="_blank"><?=$adminnum?></a></div></td>
  </tr>
  <?php
  if($showshopmenu)
  {
  ?>
  <tr bgcolor="#FFFFFF">
    <td height="25"><div align="center"><strong>�ӫ��q��</strong></div></td>
    <td align="right"><div align="left">���ѭq��ơG<a href="#empirecms" onclick="OpenShopSysDdPage();"><?=$todayddnum?></a>�A�Q��q��ơG<a href="#empirecms" onclick="OpenShopSysDdPage();"><?=$yesterdayddnum?></a>�A�`�q��ơG<a href="#empirecms" onclick="OpenShopSysDdPage();"><?=$allddnum?></a></div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#C3EFFF">
    <td height="25"><div align="center"><strong>�d��</strong></div></td>
    <td align="right"><div align="left">�ݼf�֯d���G<a href="../tool/gbook.php?sear=1&checked=2<?=$ecms_hashur['ehref']?>" target="_blank"><?=$checkgbooknum?></a>�A�`�d���ơG<a href="../tool/gbook.php<?=$ecms_hashur['whehref']?>" target="_blank"><?=$allgbooknum?></a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25"><div align="center"><strong>���X</strong></div></td>
    <td align="right"><div align="left">���d�ݤ��X�G<a href="../tool/feedback.php?sear=1&haveread=2<?=$ecms_hashur['ehref']?>" target="_blank"><?=$noreadfeedbacknum?></a>�A�`���X�ơG<a href="../tool/feedback.php<?=$ecms_hashur['whehref']?>" target="_blank"><?=$allfeedbacknum?></a></div></td>
  </tr>
  <tr bgcolor="#C3EFFF">
    <td height="25"><div align="center"><strong>�s�i</strong></div></td>
    <td align="right"><div align="left">�L���s�i�ơG<a href="../tool/ListAd.php?time=1<?=$ecms_hashur['ehref']?>" target="_blank"><?=$outtimeadnum?></a>�A�`�s�i�ơG<a href="../tool/ListAd.php<?=$ecms_hashur['whehref']?>" target="_blank"><?=$alladnum?></a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25"><div align="center"><strong>���~���i</strong></div></td>
    <td align="right"><div align="left">���~���i�ơG<a href="../DownSys/ListError.php<?=$ecms_hashur['whehref']?>" target="_blank"><?=$errornum?></a></div></td>
  </tr>
  <tr bgcolor="#C3EFFF">
    <td height="25"><div align="center"><strong>�ͱ��챵</strong></div></td>
    <td align="right"><div align="left">�ͱ��챵�ơG<a href="../tool/ListLink.php<?=$ecms_hashur['whehref']?>" target="_blank"><?=$sitelinknum?></a></div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td height="23"><font color="#666666">�����G�I���u�ƶq�v�i�i�J�������޲z�C</font></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>