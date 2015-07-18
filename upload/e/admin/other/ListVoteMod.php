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
CheckLevel($logininid,$loginin,$classid,"votemod");

//�W�[�w�]�벼
function AddVoteMod($ysvotename,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$userid,$username){
	global $empire,$dbtbpre;
	if(!$ysvotename||!$tempid)
	{
		printerror("EmptyVoteTitle","history.go(-1)");
	}
	//��^�զX
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,0);
	//�έp�`����
	for($i=0;$i<count($votename);$i++)
	{
		$t_votenum+=$votenum[$i];
	}
	$dotime=date("Y-m-d");
	$t_votenum=(int)$t_votenum;
	$voteclass=(int)$voteclass;
	$width=(int)$width;
	$height=(int)$height;
	$doip=(int)$doip;
	$tempid=(int)$tempid;
	$sql=$empire->query("insert into {$dbtbpre}enewsvotemod(title,votetext,voteclass,doip,dotime,tempid,width,height,votenum,ysvotename) values('$title','$votetext',$voteclass,$doip,'$dotime',$tempid,$width,$height,$t_votenum,'$ysvotename');");
	$voteid=$empire->lastid();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("voteid=".$voteid."<br>title=".$title);
		printerror("AddVoteSuccess","AddVoteMod.php?enews=AddVoteMod".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק�w�]�벼
function EditVoteMod($voteid,$ysvotename,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid||!$ysvotename||!$tempid)
	{
		printerror("EmptyVoteTitle","history.go(-1)");
	}
	//��^�զX
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,1);
	//�έp�`����
	for($i=0;$i<count($votename);$i++)
	{
		$t_votenum+=$votenum[$i];
	}
	//�B�z�ܶq
	$t_votenum=(int)$t_votenum;
	$voteclass=(int)$voteclass;
	$width=(int)$width;
	$height=(int)$height;
	$doip=(int)$doip;
	$tempid=(int)$tempid;
	$sql=$empire->query("update {$dbtbpre}enewsvotemod set title='$title',votetext='$votetext',voteclass=$voteclass,doip=$doip,dotime='$dotime',tempid=$tempid,width=$width,height=$height,votenum=$t_votenum,ysvotename='$ysvotename' where voteid='$voteid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("voteid=".$voteid."<br>title=".$title);
		printerror("EditVoteSuccess","ListVoteMod.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���w�]�벼
function DelVoteMod($voteid,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid)
	{
		printerror("NotDelVoteid","history.go(-1)");
	}
	$r=$empire->fetch1("select title from {$dbtbpre}enewsvotemod where voteid='$voteid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsvotemod where voteid='$voteid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("voteid=".$voteid."<br>title=".$r[title]);
		printerror("DelVoteSuccess","ListVoteMod.php".hReturnEcmsHashStrHref2(1));
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
//�W�[�벼
if($enews=="AddVoteMod")
{
	$title=$_POST['title'];
	$votename=$_POST['votename'];
	$votenum=$_POST['votenum'];
	$delvid=$_POST['delvid'];
	$vid=$_POST['vid'];
	$voteclass=$_POST['voteclass'];
	$doip=$_POST['doip'];
	$dotime=$_POST['dotime'];
	$width=$_POST['width'];
	$height=$_POST['height'];
	$tempid=$_POST['tempid'];
	$ysvotename=$_POST['ysvotename'];
	AddVoteMod($ysvotename,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$logininid,$loginin);
}
//�ק�벼
elseif($enews=="EditVoteMod")
{
	$voteid=$_POST['voteid'];
	$title=$_POST['title'];
	$votename=$_POST['votename'];
	$votenum=$_POST['votenum'];
	$delvid=$_POST['delvid'];
	$vid=$_POST['vid'];
	$voteclass=$_POST['voteclass'];
	$doip=$_POST['doip'];
	$dotime=$_POST['dotime'];
	$width=$_POST['width'];
	$height=$_POST['height'];
	$tempid=$_POST['tempid'];
	$ysvotename=$_POST['ysvotename'];
	EditVoteMod($voteid,$ysvotename,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$logininid,$loginin);
}
//�R���벼
elseif($enews=="DelVoteMod")
{
	$voteid=$_GET['voteid'];
	DelVoteMod($voteid,$logininid,$loginin);
}

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select voteid,ysvotename,title,voteclass from {$dbtbpre}enewsvotemod";
$num=$empire->num($query);//���o�`����
$query=$query." order by voteid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=ListVoteMod.php".$ecms_hashur['whehref'].">�޲z�w�]�벼</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�벼</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td width="50%">��m: 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�W�[�w�]�벼" onclick="self.location.href='AddVoteMod.php?enews=AddVoteMod<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="10%" height="25"><div align="center">ID</div></td>
    <td width="43%" height="25"><div align="center">�벼�W��</div></td>
    <td width="18%" height="25"><div align="center">����</div></td>
    <td width="29%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  	$voteclass=empty($r['voteclass'])?'���':'�h��';
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"><div align="center"> 
        <?=$r[voteid]?>
      </div></td>
    <td height="25"> 
      <?=$r[ysvotename]?>
    </td>
    <td height="25"><div align="center"> 
        <?=$voteclass?>
      </div></td>
    <td height="25"><div align="center">[<a href="AddVoteMod.php?enews=EditVoteMod&voteid=<?=$r[voteid]?><?=$ecms_hashur['ehref']?>">�ק�</a>] 
        [<a href="ListVoteMod.php?enews=DelVoteMod&voteid=<?=$r[voteid]?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="4">&nbsp; 
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
