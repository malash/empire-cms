<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
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
CheckLevel($logininid,$loginin,$classid,"befrom");

//�W�[�ӷ�
function AddBefrom($sitename,$siteurl,$userid,$username){
	global $empire,$dbtbpre;
	if(!$sitename||!$siteurl)
	{
		printerror("EmptyBefrom","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"befrom");
	$sitename=hRepPostStr($sitename,1);
	$siteurl=hRepPostStr($siteurl,1);
	$sql=$empire->query("insert into {$dbtbpre}enewsbefrom(sitename,siteurl) values('".$sitename."','".$siteurl."');");
	$lastid=$empire->lastid();
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("befromid=".$lastid."<br>sitename=".$sitename);
		printerror("AddBefromSuccess","BeFrom.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק�ӷ�
function EditBefrom($befromid,$sitename,$siteurl,$userid,$username){
	global $empire,$dbtbpre;
	if(!$sitename||!$siteurl||!$befromid)
	{
		printerror("EmptyBefrom","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"befrom");
	$befromid=(int)$befromid;
	$sitename=hRepPostStr($sitename,1);
	$siteurl=hRepPostStr($siteurl,1);
	$sql=$empire->query("update {$dbtbpre}enewsbefrom set sitename='".$sitename."',siteurl='".$siteurl."' where befromid='$befromid'");
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("befromid=".$befromid."<br>sitename=".$sitename);
		printerror("EditBefromSuccess","BeFrom.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���ӷ�
function DelBefrom($befromid,$userid,$username){
	global $empire,$dbtbpre;
	$befromid=(int)$befromid;
	if(!$befromid)
	{
		printerror("NotDelBefromid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"befrom");
	$r=$empire->fetch1("select sitename from {$dbtbpre}enewsbefrom where befromid='$befromid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsbefrom where befromid='$befromid'");
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("befromid=".$befromid."<br>sitename=".$r[sitename]);
		printerror("DelBefromSuccess","BeFrom.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//�W�[�H���ӷ�
if($enews=="AddBefrom")
{
	$sitename=$_POST['sitename'];
	$siteurl=$_POST['siteurl'];
	AddBefrom($sitename,$siteurl,$logininid,$loginin);
}
//�ק�H���ӷ�
elseif($enews=="EditBefrom")
{
	$sitename=$_POST['sitename'];
	$siteurl=$_POST['siteurl'];
	$befromid=$_POST['befromid'];
	EditBefrom($befromid,$sitename,$siteurl,$logininid,$loginin);
}
//�R���H���ӷ�
elseif($enews=="DelBefrom")
{
	$befromid=$_GET['befromid'];
	DelBefrom($befromid,$logininid,$loginin);
}
else
{}

$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$search='';
$search.=$ecms_hashur['ehref'];
$totalquery="select count(*) as total from {$dbtbpre}enewsbefrom";
$num=$empire->gettotal($totalquery);
$query="select sitename,siteurl,befromid from {$dbtbpre}enewsbefrom order by befromid desc limit $offset,$line";
$sql=$empire->query($query);
$addsitename=ehtmlspecialchars($_GET['addsitename']);
$search.="&addsitename=$addsitename";
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�H���ӷ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="BeFrom.php<?=$ecms_hashur['whehref']?>">�޲z�H���ӷ�</a></td>
  </tr>
</table>
<form name="form1" method="post" action="BeFrom.php">
  <input type=hidden name=enews value=AddBefrom>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr>
      <td height="25" class="header">�W�[�H���ӷ�:</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> ���I�W��: 
        <input name="sitename" type="text" id="sitename" value="<?=$addsitename?>">
        �챵�a�}:
        <input name="siteurl" type="text" id="siteurl" value="http://" size="50"> 
        <input type="submit" name="Submit" value="�W�[">
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="70%" height="25">�H���ӷ�</td>
    <td width="30%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=BeFrom.php>
	  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=EditBefrom>
    <input type=hidden name=befromid value=<?=$r[befromid]?>>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25">���I�W��: 
        <input name="sitename" type="text" id="sitename" value="<?=$r[sitename]?>">
        �챵�a�}: 
        <input name="siteurl" type="text" id="siteurl" value="<?=$r[siteurl]?>" size="30"> 
      </td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="�ק�">
          &nbsp; 
          <input type="button" name="Submit4" value="�R��" onclick="if(confirm('�T�{�n�R��?')){self.location.href='BeFrom.php?enews=DelBefrom&befromid=<?=$r[befromid]?><?=$ecms_hashur['href']?>';}">
        </div></td>
    </tr>
  </form>
  <?php
  }
  db_close();
  $empire=null;
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">
	  <?=$returnpage?>
	  </td>
    </tr>
</table>
</body>
</html>
