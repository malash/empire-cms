<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//���ҥΤ�
$lur=is_login();
$logininid=(int)$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();

$user_r=$empire->fetch1("select adminclass,groupid from {$dbtbpre}enewsuser where userid='$logininid'");
//�Τ���v��
$gr=$empire->fetch1("select doall from {$dbtbpre}enewsgroup where groupid='$user_r[groupid]'");
if($gr['doall'])
{
	$fcfile='../data/fc/ListEnews.php';
}
else
{
	$fcfile='../data/fc/ListEnews'.$logininid.'.php';
}
$fclistenews='';
if(file_exists($fcfile))
{
	$fclistenews=str_replace(AddCheckViewTempCode(),'',ReadFiletext($fcfile));
}
//�ƾڪ�
$changetbs='';
$dh='';
$tbi=0;
$tbsql=$empire->query("select tbname,tname from {$dbtbpre}enewstable order by tid");
while($tbr=$empire->fetch($tbsql))
{
	$tbi++;
	$changetbs.=$dh.'new ContextItem("'.$tbr['tname'].'",function(){ parent.document.main.location="ListAllInfo.php?tbname='.$tbr['tbname'].$ecms_hashur['ehref'].'"; })';
	if($tbi%3==0)
	{
		$changetbs.=',new ContextSeperator()';
	}
	$dh=',';
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�H��</title>
<link href="../data/menu/menu.css" rel="stylesheet" type="text/css">
<script src="../data/menu/menu.js" type="text/javascript"></script>
<script language="javascript" src="../data/rightmenu/context_menu.js"></script>
<script language="javascript" src="../data/rightmenu/ieemu.js"></script>
<SCRIPT lanuage="JScript">
if(self==top)
{self.location.href='admin.php<?=$ecms_hashur['whehref']?>';}

function chft(obj,ecms,classid){
	if(ecms==1)
	{
		obj.style.fontWeight='bold';
	}
	else
	{
		obj.style.fontWeight='';
	}
	obj.title='���ID�G'+classid;
}

function goaddclass(){
	parent.main.location.href='AddClass.php?enews=AddClass<?=$ecms_hashur['ehref']?>';
}

function tourl(bclassid,classid){
	parent.main.location.href="ListNews.php?<?=$ecms_hashur['ehref']?>&bclassid="+bclassid+"&classid="+classid;
}

if(moz) {
	extendEventObject();
	extendElementModel();
	emulateAttachEvent();
}
//�k����
function ShRM(obj,bclassid,classid,classurl,showmenu)
{
  var eobj,popupoptions;
  classurl='<?=$public_r[newsurl]?>e/public/ClassUrl/?classid='+classid;
if(showmenu==1)
{
  popupoptions = [
    new ContextItem("�W�[�H��",function(){ parent.document.main.location="AddNews.php?<?=$ecms_hashur['ehref']?>&enews=AddNews&bclassid="+bclassid+"&classid="+classid; }),
	new ContextSeperator(),
    new ContextItem("��s���",function(){ parent.document.main.location="enews.php?<?=$ecms_hashur['href']?>&enews=ReListHtml&classid="+classid; }),
	new ContextItem("��s���JS",function(){ parent.document.main.location="ecmschtml.php?<?=$ecms_hashur['href']?>&enews=ReSingleJs&doing=0&classid="+classid; }),
    new ContextItem("��s����",function(){ parent.document.main.location="ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>"; }),
	new ContextSeperator(),
	new ContextItem("�w������",function(){ window.open("../../"); }),
    new ContextItem("�w�����",function(){ window.open(classurl); }),
	new ContextSeperator(),
	new ContextItem("�ק����",function(){ parent.document.main.location="AddClass.php?<?=$ecms_hashur['ehref']?>&classid="+classid+"&enews=EditClass"; }),
    new ContextItem("�W�[�s���",function(){ parent.document.main.location="AddClass.php?enews=AddClass<?=$ecms_hashur['ehref']?>"; }),
    new ContextItem("�ƻs���",function(){ parent.document.main.location="AddClass.php?<?=$ecms_hashur['ehref']?>&classid="+classid+"&enews=AddClass&docopy=1"; }),
    new ContextSeperator(),
	new ContextItem("�ƾڧ�s",function(){ parent.document.main.location="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>"; }),
	new ContextItem("�W�[�Ķ��`�I",function(){ parent.document.main.location="AddInfoClass.php?<?=$ecms_hashur['ehref']?>&enews=AddInfoClass&newsclassid="+classid; }),
	new ContextItem("�޲z����",function(){ parent.document.main.location="file/ListFile.php?<?=$ecms_hashur['ehref']?>&type=9&classid="+classid; }),
	new ContextSeperator()
  ]
}
else if(showmenu==2)
{
	popupoptions = [
    <?=$changetbs?>
  ]
}
else
{
	popupoptions = [
    new ContextItem("��s���",function(){ parent.document.main.location="enews.php?<?=$ecms_hashur['href']?>&enews=ReListHtml&classid="+classid; }),
	new ContextItem("��s���JS",function(){ parent.document.main.location="ecmschtml.php?<?=$ecms_hashur['href']?>&enews=ReSingleJs&doing=0&classid="+classid; }),
    new ContextItem("��s����",function(){ parent.document.main.location="ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>"; }),
	new ContextItem("�ƾڧ�s",function(){ parent.document.main.location="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>"; }),
	new ContextSeperator(),
	new ContextItem("�w������",function(){ window.open("../../"); }),
	new ContextItem("�w�����",function(){ window.open(classurl); }),
	new ContextSeperator(),
	new ContextItem("�ק����",function(){ parent.document.main.location="AddClass.php?<?=$ecms_hashur['ehref']?>&classid="+classid+"&enews=EditClass"; }),
    new ContextItem("�W�[�s���",function(){ parent.document.main.location="AddClass.php?enews=AddClass<?=$ecms_hashur['ehref']?>"; }),
    new ContextItem("�ƻs���",function(){ parent.document.main.location="AddClass.php?<?=$ecms_hashur['ehref']?>&classid="+classid+"&enews=AddClass&docopy=1"; }),
	new ContextSeperator()
  ]
}
  ContextMenu.display(popupoptions)
}
</SCRIPT>
</head>
<body onLoad="initialize();ContextMenu.intializeContextMenu();" bgcolor="#FFCFAD">
	<table border='0' cellspacing='0' cellpadding='0'>
	<tr height=20>
			<td id="home"><img src="../data/images/homepage.gif" border=0></td>
			<td><a href="#ecms" onclick="parent.main.location.href='ListAllInfo.php<?=$ecms_hashur['whehref']?>';" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'" oncontextmenu="ShRM(this,0,0,'',2)"><b>�޲z�H��</b></a></td>
	</tr>
	</table>
<?php
echo $fclistenews;
?>
</body>
</html>
<?php
db_close();
$empire=null;
?>