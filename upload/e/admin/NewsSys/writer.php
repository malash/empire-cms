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
CheckLevel($logininid,$loginin,$classid,"writer");

//------------------�W�[�@��
function AddWriter($writer,$email,$userid,$username){
	global $empire,$dbtbpre;
	if(!$writer)
	{printerror("EmptyWriter","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"writer");
	$sql=$empire->query("insert into {$dbtbpre}enewswriter(writer,email) values('$writer','$email');");
	$lastid=$empire->lastid();
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("wid=".$lastid."<br>writer=".$writer);
		printerror("AddWriterSuccess","writer.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//----------------�ק�@��
function EditWriter($wid,$writer,$email,$userid,$username){
	global $empire,$dbtbpre;
	if(!$writer||!$wid)
	{printerror("EmptyWriter","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"writer");
	$wid=(int)$wid;
	$sql=$empire->query("update {$dbtbpre}enewswriter set writer='$writer',email='$email' where wid='$wid'");
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("wid=".$wid."<br>writer=".$writer);
		printerror("EditWriterSuccess","writer.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//---------------�R���@��
function DelWriter($wid,$userid,$username){
	global $empire,$dbtbpre;
	$wid=(int)$wid;
	if(!$wid)
	{printerror("NotDelWid","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"writer");
	$r=$empire->fetch1("select writer from {$dbtbpre}enewswriter where wid='$wid'");
	$sql=$empire->query("delete from {$dbtbpre}enewswriter where wid='$wid'");
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("wid=".$wid."<br>writer=".$r[writer]);
		printerror("DelWriterSuccess","writer.php".hReturnEcmsHashStrHref2(1));
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
if($enews=="AddWriter")
{
	$writer=$_POST['writer'];
	$email=$_POST['email'];
	AddWriter($writer,$email,$logininid,$loginin);
}
elseif($enews=="EditWriter")
{
	$wid=$_POST['wid'];
	$writer=$_POST['writer'];
	$email=$_POST['email'];
	EditWriter($wid,$writer,$email,$logininid,$loginin);
}
elseif($enews=="DelWriter")
{
	$wid=$_GET['wid'];
	DelWriter($wid,$logininid,$loginin);
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
$totalquery="select count(*) as total from {$dbtbpre}enewswriter";
$num=$empire->gettotal($totalquery);
$query="select wid,writer,email from {$dbtbpre}enewswriter order by wid desc limit $offset,$line";
$sql=$empire->query($query);
$addwritername=RepPostStr($_GET['addwritername'],1);
$search.="&addwritername=$addwritername";
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�@��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="writer.php<?=$ecms_hashur['whehref']?>">�޲z�@��</a></td>
  </tr>
</table>
<form name="form1" method="post" action="writer.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header">
      <td height="25">�W�[�@��: 
        <input name=enews type=hidden id="enews" value=AddWriter>
        </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> �@�̦W��: 
        <input name="writer" type="text" id="writer" value="<?=$addwritername?>">
        �pô�l�c: 
        <input name="email" type="text" id="email" value="mailto:" size="36"> 
        <input type="submit" name="Submit" value="�W�[">
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="70%" height="25">�@��</td>
    <td width="30%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=writer.php>
	  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=EditWriter>
    <input type=hidden name=wid value=<?=$r[wid]?>>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25">�@�̦W��: 
        <input name="writer" type="text" id="writer" value="<?=$r[writer]?>">
        �pô�l�c: 
        <input name="email" type="text" id="email" value="<?=$r[email]?>" size="30"> 
      </td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="�ק�">
          &nbsp; 
          <input type="button" name="Submit4" value="�R��" onclick="if(confirm('�T�{�n�R��?')){self.location.href='writer.php?enews=DelWriter&wid=<?=$r[wid]?><?=$ecms_hashur['href']?>';}">
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
