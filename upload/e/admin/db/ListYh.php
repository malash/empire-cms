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
CheckLevel($logininid,$loginin,$classid,"yh");

//��^�ܶq�B�z
function ReturnYhVar($add){
	$add['hlist']=(int)$add['hlist'];
	$add['qlist']=(int)$add['qlist'];
	$add['bqnew']=(int)$add['bqnew'];
	$add['bqhot']=(int)$add['bqhot'];
	$add['bqpl']=(int)$add['bqpl'];
	$add['bqgood']=(int)$add['bqgood'];
	$add['bqfirst']=(int)$add['bqfirst'];
	$add['bqdown']=(int)$add['bqdown'];
	$add['otherlink']=(int)$add['otherlink'];
	$add['qmlist']=(int)$add['qmlist'];
	$add['dobq']=(int)$add['dobq'];
	$add['dojs']=(int)$add['dojs'];
	$add['dosbq']=(int)$add['dosbq'];
	$add['rehtml']=(int)$add['rehtml'];
	return $add;
}

//�W�[�u�Ƥ��
function AddYh($add,$userid,$username){
	global $empire,$dbtbpre;
	$add=ReturnYhVar($add);
	if(!$add[yhname])
	{
		printerror("EmptyYhname","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"yh");
	$sql=$empire->query("insert into {$dbtbpre}enewsyh(yhname,yhtext,hlist,qlist,bqnew,bqhot,bqpl,bqgood,bqfirst,bqdown,otherlink,qmlist,dobq,dojs,dosbq,rehtml) values('$add[yhname]','$add[yhtext]','$add[hlist]','$add[qlist]','$add[bqnew]','$add[bqhot]','$add[bqpl]','$add[bqgood]','$add[bqfirst]','$add[bqdown]','$add[otherlink]','$add[qmlist]','$add[dobq]','$add[dojs]','$add[dosbq]','$add[rehtml]');");
	GetClass();//��s�w�s
	if($sql)
	{
		$id=$empire->lastid();
		//�ާ@��x
		insert_dolog("id=$id&yhname=$add[yhname]");
		printerror("AddYhSuccess","AddYh.php?enews=AddYh".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק��u�Ƥ��
function EditYh($add,$userid,$username){
	global $empire,$dbtbpre;
	$add=ReturnYhVar($add);
	$id=(int)$add['id'];
	if(!$id||!$add[yhname])
	{
		printerror("EmptyYhname","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"yh");
	$sql=$empire->query("update {$dbtbpre}enewsyh set yhname='$add[yhname]',yhtext='$add[yhtext]',hlist='$add[hlist]',qlist='$add[qlist]',bqnew='$add[bqnew]',bqhot='$add[bqhot]',bqpl='$add[bqpl]',bqgood='$add[bqgood]',bqfirst='$add[bqfirst]',bqdown='$add[bqdown]',otherlink='$add[otherlink]',qmlist='$add[qmlist]',dobq='$add[dobq]',dojs='$add[dojs]',dosbq='$add[dosbq]',rehtml='$add[rehtml]' where id='$id'");
	GetClass();//��s�w�s
	if($sql)
	{
		//�ާ@��x
	    insert_dolog("id=$id&yhname=$add[yhname]");
		printerror("EditYhSuccess","ListYh.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���u�Ƥ��
function DelYh($id,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(!$id)
	{
		printerror("NotChangeYhid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"yh");
	$r=$empire->fetch1("select yhname from {$dbtbpre}enewsyh where id='$id'");
	$sql=$empire->query("delete from {$dbtbpre}enewsyh where id='$id'");
	GetClass();//��s�w�s
	if($sql)
	{
		//�ާ@��x
		insert_dolog("id=$id&yhname=$r[yhname]");
		printerror("DelYhSuccess","ListYh.php".hReturnEcmsHashStrHref2(1));
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
if($enews=="AddYh")
{
	AddYh($_POST,$logininid,$loginin);
}
elseif($enews=="EditYh")
{
	EditYh($_POST,$logininid,$loginin);
}
elseif($enews=="DelYh")
{
	$id=$_GET['id'];
	DelYh($id,$logininid,$loginin);
}
else
{}
$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//�C����ܱ���
$page_line=20;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select id,yhname from {$dbtbpre}enewsyh";
$totalquery="select count(*) as total from {$dbtbpre}enewsyh";
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�u�Ƥ��</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">��m�G<a href=ListYh.php<?=$ecms_hashur['whehref']?>>�޲z�u�Ƥ��</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit" value="�W�[�u�Ƥ��" onclick="self.location.href='AddYh.php?enews=AddYh<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>

<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="16%" height="25"> <div align="center">ID</div></td>
    <td width="51%" height="25"> <div align="center">��צW��</div></td>
    <td width="33%" height="25"> <div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center"> 
        <?=$r[id]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[yhname]?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddYh.php?enews=EditYh&id=<?=$r[id]?><?=$ecms_hashur['ehref']?>">�ק�</a>]&nbsp;[<a href="AddYh.php?enews=AddYh&docopy=1&id=<?=$r[id]?><?=$ecms_hashur['ehref']?>">�ƻs</a>]&nbsp;[<a href="ListYh.php?enews=DelYh&id=<?=$r[id]?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3">&nbsp;&nbsp;&nbsp; 
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
