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
CheckLevel($logininid,$loginin,$classid,"ad");

//�W�[�s�i���O
function AddAdClass($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[classname])
	{
		printerror("EmptyAdClassname","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"ad");
	$sql=$empire->query("insert into {$dbtbpre}enewsadclass(classname) values('$add[classname]');");
	$classid=$empire->lastid();
	if($sql)
	{
		//�ާ@��x
	    insert_dolog("classid=".$classid."<br>classname=".$add[classname]);
		printerror("AddAdClassSuccess","AdClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק�s�i���O
function EditAdClass($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[classid]=(int)$add[classid];
	if(!$add[classname]||!$add[classid])
	{printerror("EmptyAdClassname","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"ad");
	$sql=$empire->query("update {$dbtbpre}enewsadclass set classname='$add[classname]' where classid='$add[classid]'");
    if($sql)
	{
		//�ާ@��x
		insert_dolog("classid=".$add[classid]."<br>classname=".$add[classname]);
		printerror("EditAdClassSuccess","AdClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���s�i���O
function DelAdClass($classid,$userid,$username){
	global $empire,$public_r,$dbtbpre;
	$classid=(int)$classid;
	if(!$classid)
	{printerror("NotChangeAdClassid","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"ad");
	$c=$empire->fetch1("select classname from {$dbtbpre}enewsadclass where classid='$classid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsadclass where classid='$classid'");
	/*
	//�R���s�i���e
	$a=$empire->query("select adid from {$dbtbpre}enewsad where classid='$classid'");
	while($r=$empire->fetch($a))
	{
		$file="../../../d/js/acmsd/".$public_r[adfile].$r[adid].".js";
		DelFiletext($file);
    }
	*/
	if($sql)
	{
		//�ާ@��x
		insert_dolog("classid=".$classid."<br>classname=".$c[classname]);
		printerror("DelAdClassSuccess","AdClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//�W�[�s�i���O
if($enews=="AddAdClass")
{
	$add=$_POST['add'];
	AddAdClass($add,$logininid,$loginin);
}
//�ק�s�i���O
elseif($enews=="EditAdClass")
{
	$add=$_POST['add'];
	EditAdClass($add,$logininid,$loginin);
}
//�R���s�i����
elseif($enews=="DelAdClass")
{
	$classid=$_GET['classid'];
	DelAdClass($classid,$logininid,$loginin);
}

$sql=$empire->query("select classid,classname from {$dbtbpre}enewsadclass order by classid desc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title></title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="ListAd.php<?=$ecms_hashur['whehref']?>">�޲z�s�i</a> &gt; <a href="AdClass.php<?=$ecms_hashur['whehref']?>">�޲z�s�i���O</a></td>
  </tr>
</table>
<form name="form1" method="post" action="AdClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header">
      <td height="25">�W�[�s�i���O:
        <input type=hidden name=enews value=AddAdClass>
        </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> ���O�W��: 
        <input name="add[classname]" type="text" id="add[classname]">
        <input type="submit" name="Submit" value="�W�[">
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td width="10%"><div align="center">ID</div></td>
    <td width="59%" height="25"><div align="center">���O�W��</div></td>
    <td width="31%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=AdClass.php>
	  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=EditAdClass>
    <input type=hidden name=add[classid] value=<?=$r[classid]?>>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
      <td><div align="center"><?=$r[classid]?></div></td>
      <td height="25"> <div align="center">
          <input name="add[classname]" type="text" id="add[classname]" value="<?=$r[classname]?>">
        </div></td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="�ק�">
          &nbsp; 
          <input type="button" name="Submit4" value="�R��" onclick="self.location.href='AdClass.php?enews=DelAdClass&classid=<?=$r[classid]?><?=$ecms_hashur['href']?>';">
        </div></td>
    </tr>
  </form>
  <?php
  }
  db_close();
  $empire=null;
  ?>
</table>
</body>
</html>
