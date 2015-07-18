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
CheckLevel($logininid,$loginin,$classid,"word");

//------------------�W�[�T�Φr��
function AddWord($oldword,$newword,$userid,$username){
	global $empire,$dbtbpre;
	if(!$oldword)
	{printerror("EmptyWord","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"word");
	$sql=$empire->query("insert into {$dbtbpre}enewswords(oldword,newword) values('".eaddslashes($oldword)."','".eaddslashes($newword)."');");
	$wordid=$empire->lastid();
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("wordid=".$wordid);
		printerror("AddWordSuccess","word.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//----------------�ק�T�Φr��
function EditWord($wordid,$oldword,$newword,$userid,$username){
	global $empire,$dbtbpre;
	if(!$oldword||!$wordid)
	{printerror("EmptyWord","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"word");
	$wordid=(int)$wordid;
	$sql=$empire->query("update {$dbtbpre}enewswords set oldword='".eaddslashes($oldword)."',newword='".eaddslashes($newword)."' where wordid='$wordid'");
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("wordid=".$wordid);
	printerror("EditWordSuccess","word.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//---------------�R���T�Φr��
function DelWord($wordid,$userid,$username){
	global $empire,$dbtbpre;
	$wordid=(int)$wordid;
	if(!$wordid)
	{printerror("NotDelWordid","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"word");
	$sql=$empire->query("delete from {$dbtbpre}enewswords where wordid='$wordid'");
	GetConfig();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("wordid=".$wordid);
		printerror("DelWordSuccess","word.php".hReturnEcmsHashStrHref2(1));
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
//�W�[�L�o�r��
if($enews=="AddWord")
{
	$oldword=$_POST['oldword'];
	$newword=$_POST['newword'];
	AddWord($oldword,$newword,$logininid,$loginin);
}
//�ק�L�o�r��
elseif($enews=="EditWord")
{
	$wordid=$_POST['wordid'];
	$oldword=$_POST['oldword'];
	$newword=$_POST['newword'];
	EditWord($wordid,$oldword,$newword,$logininid,$loginin);
}
//�R���L�o�r��
elseif($enews=="DelWord")
{
	$wordid=$_GET['wordid'];
	DelWord($wordid,$logininid,$loginin);
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
$totalquery="select count(*) as total from {$dbtbpre}enewswords";
$num=$empire->gettotal($totalquery);
$query="select wordid,oldword,newword from {$dbtbpre}enewswords order by wordid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�L�o�r��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="word.php<?=$ecms_hashur['whehref']?>">�޲z�L�o�r��</a></td>
  </tr>
</table>
<form name="form1" method="post" action="word.php">
  <input type=hidden name=enews value=AddWord>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header">
      <td height="25">�W�[�L�o�r��:</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> �N�s�D���e�]�t 
        <textarea name="oldword" cols="45" rows="5" id="oldword"></textarea>
        ������ 
        <textarea name="newword" cols="45" rows="5" id="newword"></textarea> 
        <input type="submit" name="Submit" value="�W�[">
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="86%" height="25">�L�o�r��</td>
    <td width="14%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <form name=form2 method=post action=word.php>
	  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=EditWord>
    <input type=hidden name=wordid value=<?=$r[wordid]?>>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"> �N�s�D���e�]�t 
        <textarea name="oldword" cols="43" rows="5" id="oldword"><?=ehtmlspecialchars($r[oldword])?></textarea>
        ������ 
        <textarea name="newword" cols="43" rows="5" id="newword"><?=ehtmlspecialchars($r[newword])?></textarea> 
      </td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="�ק�">
          &nbsp; 
          <input type="button" name="Submit4" value="�R��" onclick="if(confirm('�T�{�n�R��?')){self.location.href='word.php?enews=DelWord&wordid=<?=$r[wordid]?><?=$ecms_hashur['href']?>';}">
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
