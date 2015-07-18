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
CheckLevel($logininid,$loginin,$classid,"link");

//------------------�W�[�ͱ��챵
function AddLink($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[lname]||!$add[lurl])
	{printerror("EmptyLname","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"link");
	$ltime=date("Y-m-d H:i:s");
	$add[lname]=hRepPostStr($add[lname],1);
	$add[lpic]=hRepPostStr($add[lpic],1);
	$add[lurl]=hRepPostStr($add[lurl],1);
	$add[email]=hRepPostStr($add[email],1);
	$add[onclick]=(int)$add[onclick];
	$add[myorder]=(int)$add[myorder];
	$add[ltype]=(int)$add[ltype];
	$add[checked]=(int)$add[checked];
	$add[classid]=(int)$add[classid];
	$add[cid]=(int)$add[cid];
	$sql=$empire->query("insert into {$dbtbpre}enewslink(lname,lpic,lurl,ltime,onclick,width,height,target,myorder,email,lsay,ltype,checked,classid) values('".$add[lname]."','".$add[lpic]."','".$add[lurl]."','$ltime',$add[onclick],'$add[width]','$add[height]','$add[target]',$add[myorder],'".$add[email]."','".eaddslashes($add[lsay])."',$add[ltype],$add[checked],$add[classid]);");
	$lastid=$empire->lastid();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("lid=".$lastid."<br>lname=".$add[lname]);
		printerror("AddLinkSuccess","AddLink.php?enews=AddLink&cid=$add[cid]".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//----------------�ק�ͱ��챵
function EditLink($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[lid]=(int)$add[lid];
	if(!$add[lname]||!$add[lurl]||!$add[lid])
	{printerror("EmptyLname","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"link");
	$add[lname]=hRepPostStr($add[lname],1);
	$add[lpic]=hRepPostStr($add[lpic],1);
	$add[lurl]=hRepPostStr($add[lurl],1);
	$add[email]=hRepPostStr($add[email],1);
	$add[onclick]=(int)$add[onclick];
	$add[myorder]=(int)$add[myorder];
	$add[ltype]=(int)$add[ltype];
	$add[checked]=(int)$add[checked];
	$add[classid]=(int)$add[classid];
	$add[cid]=(int)$add[cid];
	$sql=$empire->query("update {$dbtbpre}enewslink set lname='".$add[lname]."',lpic='".$add[lpic]."',lurl='".$add[lurl]."',onclick=$add[onclick],width='$add[width]',height='$add[height]',target='$add[target]',myorder=$add[myorder],email='".$add[email]."',lsay='".eaddslashes($add[lsay])."',ltype=$add[ltype],checked=$add[checked],classid=$add[classid] where lid='$add[lid]'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("lid=".$add[lid]."<br>lname=".$add[lname]);
		printerror("EditLinkSuccess","ListLink.php?classid=$add[cid]".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//---------------�R���ͱ��챵
function DelLink($lid,$cid,$userid,$username){
	global $empire,$dbtbpre;
	$lid=(int)$lid;
	$cid=(int)$cid;
	if(!$lid)
	{printerror("EmptyLid","history.go(-1)");}
	//�����v��
	CheckLevel($userid,$username,$classid,"link");
	$r=$empire->fetch1("select lname from {$dbtbpre}enewslink where lid='$lid'");
	$sql=$empire->query("delete from {$dbtbpre}enewslink where lid='$lid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("lid=".$lid."<br>lname=".$r[lname]);
		printerror("DelLinkSuccess","ListLink.php?classid=$cid".hReturnEcmsHashStrHref2(0));
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
if($enews=="AddLink")
{
	AddLink($_POST,$logininid,$loginin);
}
elseif($enews=="EditLink")
{
	EditLink($_POST,$logininid,$loginin);
}
elseif($enews=="DelLink")
{
	$lid=$_GET['lid'];
	$cid=$_GET['cid'];
	DelLink($lid,$cid,$logininid,$loginin);
}
else
{}

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=16;//�C����ܱ���
$page_line=25;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select * from {$dbtbpre}enewslink";
$totalquery="select count(*) as total from {$dbtbpre}enewslink";
//���O
$add="";
$classid=(int)$_GET['classid'];
if($classid)
{
	$add=" where classid=$classid";
	$search.="&classid=$classid";
}
$query.=$add;
$totalquery.=$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by myorder,lid limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//���O
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewslinkclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$classid)
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�޲z�ͱ��챵</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">��m�G<a href="ListLink.php<?=$ecms_hashur['whehref']?>">�޲z�ͱ��챵</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�W�[�ͱ��챵" onclick="self.location.href='AddLink.php?enews=AddLink<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td> ������O�G 
      <select name="classid" id="classid" onchange=window.location='ListLink.php?<?=$ecms_hashur['ehref']?>&classid='+this.options[this.selectedIndex].value>
        <option value="0">��ܩҦ����O</option>
        <?=$cstr?>
      </select> </td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="51%" height="25"> <div align="center">�w��</div></td>
    <td width="11%" height="25"> <div align="center">�I��</div></td>
    <td width="12%"><div align="center">���A</div></td>
    <td width="20%" height="25"> <div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  //��r
  if(empty($r[lpic]))
  {
  $logo="<a href='".$r[lurl]."' title='".$r[lname]."' target=".$r[target].">".$r[lname]."</a>";
  }
  //�Ϥ�
  else
  {
  $logo="<a href='".$r[lurl]."' target=".$r[target]."><img src='".$r[lpic]."' alt='".$r[lname]."' border=0 width='".$r[width]."' height='".$r[height]."'></a>";
  }
  if(empty($r[checked]))
  {$checked="����";}
  else
  {$checked="���";}
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center"> 
        <?=$r[lid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$logo?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[onclick]?>
      </div></td>
    <td><div align="center"><?=$checked?></div></td>
    <td height="25"> <div align="center">[<a href="AddLink.php?enews=EditLink&lid=<?=$r[lid]?>&cid=<?=$classid?><?=$ecms_hashur['ehref']?>">�ק�</a>]&nbsp;[<a href="ListLink.php?enews=DelLink&lid=<?=$r[lid]?>&cid=<?=$classid?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="5">&nbsp;&nbsp;&nbsp; 
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
