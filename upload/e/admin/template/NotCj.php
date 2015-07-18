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
CheckLevel($logininid,$loginin,$classid,"notcj");

//�W�[�Ķ��H���r��
function AddNotcj($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"notcj");
	if(empty($add[word]))
	{
		printerror("EmptyNotcjWord","history.go(-1)");
    }
	$word=RepPhpAspJspcode($add[word]);
	$sql=$empire->query("insert into {$dbtbpre}enewsnotcj(word) values('".eaddslashes($word)."');");
	$id=$empire->lastid();
	GetNotcj();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("id=$id");
		printerror("AddNotcjSuccess","NotCj.php".hReturnEcmsHashStrHref2(1));
    }
	else
	{
		printerror("DbError","history.go(-1)");
    }
}

//�ק�Ķ��H���r��
function EditNotcj($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"notcj");
	$id=(int)$add['id'];
	if(empty($add[word])||!$id)
	{
		printerror("EmptyNotcjWord","history.go(-1)");
    }
	$word=RepPhpAspJspcode($add[word]);
	$sql=$empire->query("update {$dbtbpre}enewsnotcj set word='".eaddslashes($word)."' where id='$id'");
	GetNotcj();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("id=$id");
		printerror("EditNotcjSuccess","NotCj.php".hReturnEcmsHashStrHref2(1));
    }
	else
	{
		printerror("DbError","history.go(-1)");
    }
}

//�R���Ķ��H���r��
function DelNotcj($id,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"notcj");
	$id=(int)$id;
	if(!$id)
	{
		printerror("EmptyDelNotcjid","history.go(-1)");
    }
	$sql=$empire->query("delete from {$dbtbpre}enewsnotcj where id='$id'");
	GetNotcj();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("id=$id");
		printerror("DelNotcjSuccess","NotCj.php".hReturnEcmsHashStrHref2(1));
    }
	else
	{
		printerror("DbError","history.go(-1)");
    }
}

//�ͦ��H���r�Žw�s
function GetNotcj(){
	global $empire,$dbtbpre;
	$file=ECMS_PATH."e/data/dbcache/notcj.php";
	$sql=$empire->query("select id,word from {$dbtbpre}enewsnotcj");
	$i=0;
	while($r=$empire->fetch($sql))
	{
		$i++;
		$str.="\$notcj_r[$i]='".addslashes($r[word])."';
";
    }
	$string="<?php
\$notcj_r=array();
".$str."\$notcjnum=".$i.";
?>";
	WriteFiletext_n($file,$string);
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//�W�[�H���r��
if($enews=="AddNotcj")
{
	AddNotcj($_POST,$logininid,$loginin);
}
//�ק��H���r��
elseif($enews=="EditNotcj")
{
	EditNotcj($_POST,$logininid,$loginin);
}
//�R���H���r��
elseif($enews=="DelNotcj")
{
	$id=$_GET['id'];
	DelNotcj($id,$logininid,$loginin);
}
else
{}

$search=$ecms_hashur['ehref'];
$start=0;
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$line=15;//�C�����
$page_line=15;
$offset=$page*$line;
$totalquery="select count(*) as total from {$dbtbpre}enewsnotcj";
$num=$empire->gettotal($totalquery);//���o�`����
$query="select id,word from {$dbtbpre}enewsnotcj";
$query.=" order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z���Ķ��H���r��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G���Ķ��޲z &gt; <a href="NotCj.php<?=$ecms_hashur['whehref']?>">�޲z���Ķ��H���r��</a></td>
  </tr>
</table>
<form name="form1" method="post" action="NotCj.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25">�W�[���Ķ��H���r��: 
        <input type=hidden name=enews value=AddNotcj>
        </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 
        <textarea name="word" cols="65" rows="8" id="word"></textarea>
      </td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="�W�[">
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td width="7%"><div align="center">ID</div></td>
    <td width="75%" height="25">���Ķ��H���r��</td>
    <td width="18%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  $word=ehtmlspecialchars($r[word]);
  ?>
  <form name=form2 method=post action=NotCj.php>
	  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=EditNotcj>
    <input type=hidden name=id value=<?=$r[id]?>>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
      <td><div align="center"><?=$r[id]?></div></td>
      <td height="25"><textarea name="word" cols="65" rows="8" id="word"><?=$word?></textarea> 
      </td>
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit3" value="�ק�">
          &nbsp; 
          <input type="button" name="Submit4" value="�R��" onclick="self.location.href='NotCj.php?enews=DelNotcj&id=<?=$r[id]?><?=$ecms_hashur['href']?>';">
        </div></td>
    </tr>
	</form>
  <?php
  }
  db_close();
  $empire=null;
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="3">&nbsp;<?=$returnpage?></td>
    </tr>
</table>
</body>
</html>
