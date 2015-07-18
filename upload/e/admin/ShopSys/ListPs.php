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
CheckLevel($logininid,$loginin,$classid,"shopps");

//�W�[�t�e�覡
function AddPs($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add[pname]))
	{
		printerror("EmptyPayname","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"shopps");
	$add[price]=(float)$add[price];
	$add['isclose']=(int)$add['isclose'];
	$sql=$empire->query("insert into {$dbtbpre}enewsshopps(pname,price,otherprice,psay,isclose) values('".eaddslashes($add[pname])."','$add[price]','$add[otherprice]','".eaddslashes($add[psay])."','$add[isclose]');");
	$pid=$empire->lastid();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("pid=".$pid."<br>pname=".$add[pname]);
		printerror("AddPayfsSuccess","AddPs.php?enews=AddPs".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק�t�e�覡
function EditPs($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[pid]=(int)$add[pid];
	if(empty($add[pname])||!$add[pid])
	{
		printerror("EmptyPayname","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"shopps");
	$add[price]=(float)$add[price];
	$add['isclose']=(int)$add['isclose'];
	$sql=$empire->query("update {$dbtbpre}enewsshopps set pname='".eaddslashes($add[pname])."',price='$add[price]',otherprice='$add[otherprice]',psay='".eaddslashes($add[psay])."',isclose='$add[isclose]' where pid='$add[pid]'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("pid=".$add[pid]."<br>pname=".$add[pname]);
		printerror("EditPayfsSuccess","ListPs.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���t�e�覡
function DelPs($pid,$userid,$username){
	global $empire,$dbtbpre;
	$pid=(int)$pid;
	if(!$pid)
	{
		printerror("EmptyPayfsid","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"shopps");
	$r=$empire->fetch1("select pname from {$dbtbpre}enewsshopps where pid='$pid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsshopps where pid='$pid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("pid=".$pid."<br>pname=".$r[pname]);
		printerror("DelPayfsSuccess","ListPs.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�]�m���q�{�t�e�覡
function DefPs($pid,$userid,$username){
	global $empire,$dbtbpre;
	$pid=(int)$pid;
	if(!$pid)
	{
		printerror("EmptyPayfsid","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"shopps");
	$r=$empire->fetch1("select pname from {$dbtbpre}enewsshopps where pid='$pid'");
	$upsql=$empire->query("update {$dbtbpre}enewsshopps set isdefault=0");
	$sql=$empire->query("update {$dbtbpre}enewsshopps set isdefault=1 where pid='$pid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("pid=".$pid."<br>pname=".$r[pname]);
		printerror("DefPayfsSuccess","ListPs.php".hReturnEcmsHashStrHref2(1));
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
if($enews=="AddPs")
{
	AddPs($_POST,$logininid,$loginin);
}
elseif($enews=="EditPs")
{
	EditPs($_POST,$logininid,$loginin);
}
elseif($enews=="DelPs")
{
	$pid=$_GET['pid'];
	DelPs($pid,$logininid,$loginin);
}
elseif($enews=="DefPs")
{
	$pid=$_GET['pid'];
	DefPs($pid,$logininid,$loginin);
}
else
{}

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=16;//�C����ܱ���
$page_line=18;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select * from {$dbtbpre}enewsshopps";
$num=$empire->num($query);//���o�`����
$query=$query." order by pid limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�޲z�t�e�覡</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">��m�G<a href="ListPs.php<?=$ecms_hashur['whehref']?>">�޲z�t�e�覡</a>&nbsp;&nbsp;&nbsp; 
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit" value="�W�[�t�e�覡" onclick="self.location.href='AddPs.php?enews=AddPs<?=$ecms_hashur['ehref']?>'">
      </div></td>
  </tr>
</table>

<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"> <div align="center">ID</div></td>
    <td width="36%" height="25"> <div align="center">�t�e�覡</div></td>
    <td width="15%"><div align="center">����</div></td>
    <td width="11%"><div align="center">�q�{</div></td>
    <td width="11%"><div align="center">�ҥ�</div></td>
    <td width="22%" height="25"> <div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center"> 
        <?=$r[pid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[pname]?>
      </div></td>
    <td><div align="center"> 
        <?=$r[price]?>
        �� </div></td>
    <td><div align="center"><?=$r[isdefault]==1?'�O':'--'?></div></td>
    <td><div align="center"><?=$r[isclose]==1?'����':'�}��'?></div></td>
    <td height="25"> <div align="center">[<a href="AddPs.php?enews=EditPs&pid=<?=$r[pid]?><?=$ecms_hashur['ehref']?>">�ק�</a>] [<a href="ListPs.php?enews=DefPs&pid=<?=$r[pid]?><?=$ecms_hashur['href']?>">�]���q�{</a>] [<a href="ListPs.php?enews=DelPs&pid=<?=$r[pid]?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6">&nbsp;&nbsp;&nbsp; 
      <?=$returnpage?>    </td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
