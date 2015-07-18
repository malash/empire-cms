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
CheckLevel($logininid,$loginin,$classid,"moreport");

//�W�[�X�ݺ�
function AddMoreport($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[pname]||!$add[ppath]||!$add[purl]||!$add[postpass]||!$add[tempgid])
	{
		printerror("EmptyMoreport","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"moreport");
	$add['pname']=hRepPostStr($add['pname'],1);
	$add['purl']=RepPostStr($add['purl'],1);
	$add['ppath']=RepPostStr($add['ppath'],1);
	$add['postpass']=RepPostStr($add['postpass'],1);
	$add['postfile']=RepPostStr($add['postfile'],1);
	$add['tempgid']=(int)$add['tempgid'];
	$add['mustdt']=(int)$add['mustdt'];
	$add['isclose']=(int)$add['isclose'];
	$add['closeadd']=(int)$add['closeadd'];
	if(!file_exists($add['ppath'].'e/config/config.php'))
	{
		printerror("ErrorMoreportPath","history.go(-1)");
	}
	$sql=$empire->query("insert into {$dbtbpre}enewsmoreport(pname,purl,ppath,postpass,postfile,tempgid,mustdt,isclose,closeadd) values('$add[pname]','$add[purl]','$add[ppath]','$add[postpass]','$add[postfile]','$add[tempgid]','$add[mustdt]','$add[isclose]','$add[closeadd]');");
	$pid=$empire->lastid();
	//��s�w�s
	Moreport_UpdateIsclose();
	GetConfig();
	if($sql)
	{
		//�ާ@��x
	    insert_dolog("pid=$pid&pname=$add[pname]");
		printerror("AddMoreportSuccess","AddMoreport.php?enews=AddMoreport".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק�X�ݺ�
function EditMoreport($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[pid]=(int)$add[pid];
	if(!$add[pid]||!$add[pname]||!$add[ppath]||!$add[purl]||!$add[postpass]||!$add[tempgid])
	{
		printerror("EmptyMoreport","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"moreport");
	$add['pname']=hRepPostStr($add['pname'],1);
	$add['purl']=RepPostStr($add['purl'],1);
	$add['ppath']=RepPostStr($add['ppath'],1);
	$add['postpass']=RepPostStr($add['postpass'],1);
	$add['postfile']=RepPostStr($add['postfile'],1);
	$add['tempgid']=(int)$add['tempgid'];
	$add['mustdt']=(int)$add['mustdt'];
	$add['isclose']=(int)$add['isclose'];
	$add['closeadd']=(int)$add['closeadd'];
	if(!file_exists($add['ppath'].'e/config/config.php'))
	{
		printerror("ErrorMoreportPath","history.go(-1)");
	}
	$sql=$empire->query("update {$dbtbpre}enewsmoreport set pname='$add[pname]',purl='$add[purl]',ppath='$add[ppath]',postpass='$add[postpass]',postfile='$add[postfile]',tempgid='$add[tempgid]',mustdt='$add[mustdt]',isclose='$add[isclose]',closeadd='$add[closeadd]' where pid='$add[pid]'");
	//��s�w�s
	Moreport_UpdateIsclose();
	GetConfig();
	if($sql)
	{
		//�ާ@��x
	    insert_dolog("pid=$add[pid]&pname=$add[pname]");
		printerror("EditMoreportSuccess","ListMoreport.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���X�ݺ�
function DelMoreport($add,$userid,$username){
	global $empire,$dbtbpre;
	$pid=(int)$add['pid'];
	if(!$pid)
	{
		printerror("NotChangeMoreportId","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"moreport");
	$r=$empire->fetch1("select pname from {$dbtbpre}enewsmoreport where pid='$pid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsmoreport where pid='$pid'");
	//��s�w�s
	Moreport_UpdateIsclose();
	GetConfig();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("pid=$pid&pname=$r[pname]");
		printerror("DelMoreportSuccess","ListMoreport.php".hReturnEcmsHashStrHref2(1));
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
	include('../../class/copypath.php');
	include('moreportfun.php');
}
//�W�[�X�ݺ�
if($enews=="AddMoreport")
{
	AddMoreport($_POST,$logininid,$loginin);
}
elseif($enews=="EditMoreport")//�ק�X�ݺ�
{
	EditMoreport($_POST,$logininid,$loginin);
}
elseif($enews=="DelMoreport")//�R���X�ݺ�
{
	DelMoreport($_GET,$logininid,$loginin);
}
elseif($enews=="MoreportChangeCacheAll")//��s�X�ݺݼƾڮw�w�s
{
	Moreport_ChangeCacheAll($_GET,$logininid,$loginin);
}
elseif($enews=="MoreportUpdateClassfileAll")//��s�X�ݺ���ؽw�s���
{
	Moreport_UpdateClassfileAll($_GET,$logininid,$loginin);
}
elseif($enews=="MoreportReDtPageAll")//��s�X�ݺݰʺA����
{
	Moreport_ReDtPageAll($_GET,$logininid,$loginin);
}
elseif($enews=="MoreportClearTmpfileAll")//�M�z�X�ݺ��{�ɤ��
{
	Moreport_ClearTmpfileAll($_GET,$logininid,$loginin);
}
elseif($enews=="MoreportReIndexfileAll")//��s�X�ݺݰʺA�������
{
	Moreport_ReIndexfileAll($_GET,$logininid,$loginin);
}

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;
$page_line=25;
$add="";
$offset=$line*$page;
$totalquery="select count(*) as total from {$dbtbpre}enewsmoreport";
$num=$empire->gettotal($totalquery);
$query="select * from {$dbtbpre}enewsmoreport";
$query.=" order by pid limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�����X�ݺ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">��m�G<a href="ListMoreport.php<?=$ecms_hashur['whehref']?>">�޲z�����X�ݺ�</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�W�[�X�ݺ�" onclick="self.location.href='AddMoreport.php?enews=AddMoreport<?=$ecms_hashur['ehref']?>';">
		&nbsp;&nbsp;
        <input type="button" name="Submit52" value="��s�Ҧ��X�ݺݽw�s�P�ʺA����" onclick="if(document.getElementById('moreportchangedata').style.display==''){document.getElementById('moreportchangedata').style.display='none';}else{document.getElementById('moreportchangedata').style.display='';}">
    </div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="tableborder" id="moreportchangedata" style="display:none">
	<form name="moreportchangedataform" method="GET" action="ListMoreport.php" onsubmit="return confirm('�T�{�n��s?');">
	<?=$ecms_hashur['form']?>
	<input type="hidden" name="enews" value="MoreportChangeCacheAll">
    <tr class="header">
      <td height="25">��s�Ҧ��X�ݺݽw�s�P�ʺA����</td>
    </tr>
    <tr>
    <td height="25" bgcolor="#FFFFFF"><input name="docache" type="checkbox" id="docache" value="1" checked>
      ��s�ƾڮw�w�s
      <input name="doclassfile" type="checkbox" id="doclassfile" value="1" checked>
      ��s��ؽw�s���
      <input name="dodtpage" type="checkbox" id="dodtpage" value="1" checked>
      ��s�ʺA����
      <input name="dotmpfile" type="checkbox" id="dotmpfile" value="1" checked>
      �M�z�{�ɤ��
      <input name="doreindex" type="checkbox" id="doreindex" value="1" checked>
      ��s�ʺA�������
      <input type="submit" name="Submit" value="����"></td>
  </tr>
  </form>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tableborder">
  <form name="listmoreportform" method="post" action="ListMoreport.php" onsubmit="return confirm('�T�{�n�R��?');">
  <?=$ecms_hashur['form']?>
    <input type="hidden" name="enews" value="DelMoreport_all">
    <tr class="header"> 
      <td width="7%" height="25"> <div align="center">ID</div></td>
      <td width="25%" height="25"> <div align="center">�X�ݺ�</div></td>
      <td width="27%" height="25"> <div align="center">�ϥμҪO��</div></td>
      <td width="11%"><div align="center">�j��ʺA���Ҧ�</div></td>
      <td width="11%"><div align="center">���A</div></td>
      <td width="19%" height="25"> <div align="center">�ާ@</div></td>
    </tr>
    <?php
  while($r=$empire->fetch($sql))
  {
	//�D�X�ݺ�
	if($r['pid']==1)
	{
		$r['pname']='<b>'.$r['pname'].'</b>';
		if(empty($r['purl']))
		{
			$r['purl']=$public_r['newsurl'];
		}
		$tgr=$empire->fetch1("select gid,gname,isdefault from {$dbtbpre}enewstempgroup where isdefault=1");
	}
	else
	{
		$tgr=$empire->fetch1("select gid,gname,isdefault from {$dbtbpre}enewstempgroup where gid='$r[tempgid]'");
	}
  ?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"> <div align="center"> 
          <?=$r[pid]?>
        </div></td>
      <td height="25"> <div align="center"> 
	  <a href="<?=$r[purl]?>" target="_blank"><?=$r[pname]?></a>
	   </div></td>
      <td height="25"> <div align="center"> 
          <?=$tgr[gname]?>
        </div></td>
      <td><div align="center"><?=$r[mustdt]==1?'�O':'�_'?></div></td>
      <td><div align="center"><?=$r[isclose]==1?'����':'�}��'?></div></td>
      <td height="25"> <div align="center">
	  <?php
	  if($r['pid']==1)
	  {
	  ?>
	  	�D�X�ݺ�
	  <?php
	  }
	  else
	  {
	  ?>
		 [<a href="AddMoreport.php?enews=EditMoreport&pid=<?=$r[pid]?><?=$ecms_hashur['ehref']?>">�ק�</a>] [<a href="ListMoreport.php?enews=DelMoreport&pid=<?=$r[pid]?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>]
	  <?php
	  }
	  ?>
		</div></td>
    </tr>
    <?php
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="6">&nbsp; 
        <?=$returnpage?>
        &nbsp;&nbsp;</td>
    </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>