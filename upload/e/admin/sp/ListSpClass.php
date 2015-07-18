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
CheckLevel($logininid,$loginin,$classid,"sp");

//�W�[�H������
function AddSpClass($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[classname])
	{
		printerror("EmptySpClassname","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"sp");
	$sql=$empire->query("insert into {$dbtbpre}enewsspclass(classname,classsay) values('$add[classname]','$add[classsay]');");
	$classid=$empire->lastid();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("classid=".$classid."<br>classname=".$add[classname]);
		printerror("AddSpClassSuccess","AddSpClass.php?enews=AddSpClass".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק�H������
function EditSpClass($add,$userid,$username){
	global $empire,$dbtbpre;
	$classid=(int)$add[classid];
	if(!$classid||!$add[classname])
	{
		printerror("EmptySpClassname","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"sp");
	$sql=$empire->query("update {$dbtbpre}enewsspclass set classname='$add[classname]',classsay='$add[classsay]' where classid='$classid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("classid=".$classid."<br>classname=".$add[classname]);
		printerror("EditSpClassSuccess","ListSpClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���H������
function DelSpClass($classid,$userid,$username){
	global $empire,$dbtbpre;
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("NotDelSpClassid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"sp");
	$r=$empire->fetch1("select classname from {$dbtbpre}enewsspclass where classid='$classid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsspclass where classid='$classid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("classid=".$classid."<br>classname=".$r[classname]);
		printerror("DelSpClassSuccess","ListSpClass.php".hReturnEcmsHashStrHref2(1));
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
if($enews=="AddSpClass")//�W�[�H������
{
	AddSpClass($_POST,$logininid,$loginin);
}
elseif($enews=="EditSpClass")//�ק�H������
{
	EditSpClass($_POST,$logininid,$loginin);
}
elseif($enews=="DelSpClass")//�R���H������
{
	$classid=$_GET['classid'];
	DelSpClass($classid,$logininid,$loginin);
}

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select classid,classname from {$dbtbpre}enewsspclass";
$totalquery="select count(*) as total from {$dbtbpre}enewsspclass";
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by classid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=ListSp.php".$ecms_hashur['whehref'].">�޲z�H��</a>&nbsp;>&nbsp;<a href=ListSpClass.php".$ecms_hashur['whehref'].">�޲z�H������</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�H������</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td width="50%">��m: 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�W�[�H������" onclick="self.location.href='AddSpClass.php?enews=AddSpClass<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="9%" height="25"><div align="center">ID</div></td>
    <td width="70%" height="25"><div align="center">�����W��</div></td>
    <td width="21%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"><div align="center"> 
        <?=$r[classid]?>
      </div></td>
    <td height="25" align="center"> 
      <a href="ListSp.php?<?=$ecms_hashur['ehref']?>&cid=<?=$r[classid]?>" target="_blank"><?=$r[classname]?></a>
    </td>
    <td height="25"><div align="center">[<a href="AddSpClass.php?enews=EditSpClass&classid=<?=$r[classid]?><?=$ecms_hashur['ehref']?>">�ק�</a>] 
        [<a href="ListSpClass.php?enews=DelSpClass&classid=<?=$r[classid]?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3">&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
