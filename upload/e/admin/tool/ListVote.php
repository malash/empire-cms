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
CheckLevel($logininid,$loginin,$classid,"vote");

//�W�[�벼
function AddVote($title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$userid,$username){
	global $empire,$dbtbpre;
	if(!$title||!$tempid)
	{printerror("EmptyVoteTitle","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"vote");
	//��^�զX
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,0);
	//�έp�`����
	for($i=0;$i<count($votename);$i++)
	{$t_votenum+=$votenum[$i];}
	$votetime=to_date($dotime);
	$addtime=date("Y-m-d H:i:s");
	$t_votenum=(int)$t_votenum;
	$voteclass=(int)$voteclass;
	$votetime=(int)$votetime;
	$width=(int)$width;
	$height=(int)$height;
	$doip=(int)$doip;
	$tempid=(int)$tempid;
	$sql=$empire->query("insert into {$dbtbpre}enewsvote(title,votetext,votenum,voteip,voteclass,doip,votetime,dotime,width,height,addtime,tempid) values('$title','$votetext',$t_votenum,'',$voteclass,$doip,$votetime,'$dotime',$width,$height,'$addtime',$tempid);");
	//�ͦ��벼js
	$voteid=$empire->lastid();
	GetVoteJs($voteid);
	if($sql)
	{
		//�ާ@��x
		insert_dolog("voteid=".$voteid."<br>title=".$title);
		printerror("AddVoteSuccess","AddVote.php?enews=AddVote".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק�벼
function EditVote($voteid,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid||!$title||!$tempid)
	{printerror("EmptyVoteTitle","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"vote");
	//��^�զX
	$votetext=ReturnVote($votename,$votenum,$delvid,$vid,1);
	//�έp�`����
	for($i=0;$i<count($votename);$i++)
	{$t_votenum+=$votenum[$i];}
	$r=$empire->fetch1("select dotime,votetime from {$dbtbpre}enewsvote where voteid='$voteid'");
	$votetime=to_date($dotime);
	//�B�z�ܶq
	$t_votenum=(int)$t_votenum;
	$voteclass=(int)$voteclass;
	$votetime=(int)$votetime;
	$width=(int)$width;
	$height=(int)$height;
	$doip=(int)$doip;
	$tempid=(int)$tempid;
	$sql=$empire->query("update {$dbtbpre}enewsvote set title='$title',votetext='$votetext',votenum=$t_votenum,voteclass=$voteclass,doip=$doip,dotime='$dotime',votetime=$votetime,width=$width,height=$height,tempid=$tempid where voteid='$voteid'");
	//�ͦ��벼js
	GetVoteJs($voteid);
	if($sql)
	{
		//�ާ@��x
		insert_dolog("voteid=".$voteid."<br>title=".$title);
		printerror("EditVoteSuccess","ListVote.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���벼
function DelVote($voteid,$userid,$username){
	global $empire,$dbtbpre;
	$voteid=(int)$voteid;
	if(!$voteid)
	{printerror("NotDelVoteid","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"vote");
	$r=$empire->fetch1("select title from {$dbtbpre}enewsvote where voteid='$voteid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsvote where voteid='$voteid'");
	$file="../../../d/js/vote/vote".$voteid.".js";
	DelFiletext($file);
	if($sql)
	{
		//�ާ@��x
		insert_dolog("voteid=".$voteid."<br>title=".$r[title]);
		printerror("DelVoteSuccess","ListVote.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//��q�ͦ��벼
function ReVoteJs_all($start=0,$from,$userid,$username){
	global $empire,$public_r,$fun_r,$dbtbpre;
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select voteid from {$dbtbpre}enewsvote where voteid>$start order by voteid limit ".$public_r['revotejsnum']);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[voteid];
		GetVoteJs($r[voteid]);
	}
	if(empty($b))
	{
		//�ާ@��x
	    insert_dolog("");
		printerror("ReVoteJsSuccess",$from);
	}
	echo $fun_r['OneReVoteJsSuccess']."(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='ListVote.php?enews=ReVoteJs_all&start=$newstart&from=".urlencode($from).hReturnEcmsHashStrHref(0)."';</script>";
	exit();
}

//�ͦ��벼js
function GetVoteJs($voteid){
	global $empire,$public_r,$fun_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}enewsvote where voteid='$voteid'");
	//�ҪO
	$votetemp=ReturnVoteTemp($r[tempid],1);
	$votetemp=RepVoteTempAllvar($votetemp,$r);
	$listexp="[!--empirenews.listtemp--]";
	$listtemp_r=explode($listexp,$votetemp);
	$file="../../../d/js/vote/vote".$voteid.".js";
	$r_exp="\r\n";
	$f_exp="::::::";
	//���ؼ�
	$r_r=explode($r_exp,$r[votetext]);
	$checked=0;
	for($i=0;$i<count($r_r);$i++)
	{
		$checked++;
		$f_r=explode($f_exp,$r_r[$i]);
		//�벼����
		if($r[voteclass])
		{$vote="<input type=checkbox name=vote[] value=".$checked.">";}
		else
		{$vote="<input type=radio name=vote value=".$checked.">";}
		$votetext.=RepVoteTempListvar($listtemp_r[1],$vote,$f_r[0]);
    }
	$votetext="document.write(\"".addslashes(stripSlashes($listtemp_r[0].$votetext.$listtemp_r[2]))."\");";
	WriteFiletext_n($file,$votetext);
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//�W�[�벼
if($enews=="AddVote")
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
	AddVote($title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$logininid,$loginin);
}
//�ק�벼
elseif($enews=="EditVote")
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
	EditVote($voteid,$title,$votename,$votenum,$delvid,$vid,$voteclass,$doip,$dotime,$width,$height,$tempid,$logininid,$loginin);
}
//�R���벼
elseif($enews=="DelVote")
{
	$voteid=$_GET['voteid'];
	DelVote($voteid,$logininid,$loginin);
}
//��q��s�벼JS
elseif($enews=="ReVoteJs_all")
{
	ReVoteJs_all($_GET['start'],$_GET['from'],$logininid,$loginin);
}

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select voteid,title,addtime from {$dbtbpre}enewsvote";
$num=$empire->num($query);//���o�`����
$query=$query." order by voteid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=ListVote.php".$ecms_hashur['whehref'].">�޲z�벼</a>";
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
        <input type="button" name="Submit5" value="�W�[�벼" onclick="self.location.href='AddVote.php?enews=AddVote<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"><div align="center">ID</div></td>
    <td width="32%" height="25"><div align="center">�벼���D</div></td>
    <td width="18%" height="25"><div align="center">�o�G�ɶ�</div></td>
    <td width="26%" height="25">�եΦa�}</td>
    <td width="19%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"><div align="center"><?=$r[voteid]?></div></td>
    <td height="25"><?=$r[title]?></td>
    <td height="25"><div align="center"><?=$r[addtime]?></div>
      </td>
    <td height="25"><input name="textfield" type="text" value="<?=$public_r[newsurl]?>d/js/vote/vote<?=$r[voteid]?>.js">
      [<a href="../view/js.php?js=vote<?=$r[voteid]?>&p=vote<?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>]</td>
    <td height="25"><div align="center">[<a href="AddVote.php?enews=EditVote&voteid=<?=$r[voteid]?><?=$ecms_hashur['ehref']?>">�ק�</a>] 
        [<a href="ListVote.php?enews=DelVote&voteid=<?=$r[voteid]?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF">
    <td height="25" colspan="5">&nbsp;<?=$returnpage?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5"><font color="#666666">����:�ҪO����ܧ벼���a��[�W:&lt;script 
      src=�եΦa�}&gt;&lt;/script&gt; �Ϊ� [phomevote]�벼ID[/phomevote]</font></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
