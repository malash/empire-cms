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

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include('../../class/chtmlfun.php');
	include('../../data/dbcache/class.php');
	include('../../class/t_functions.php');
}
if($enews=='ReSp')//��s�H�����
{
	ReSp($_GET,$logininid,$loginin,1);
}

$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$add='';
$search='';
$search.=$ecms_hashur['ehref'];
//�H������
$sptype=(int)$_GET['sptype'];
if($sptype)
{
	$add.=" and sptype='$sptype'";
	$search.="&sptype=$sptype";
}
//����
$cid=(int)$_GET['cid'];
if($cid)
{
	$add.=" and cid='$cid'";
	$search.="&cid=$cid";
}
//���
$classid=(int)$_GET['classid'];
if($classid)
{
	$add.=" and classid='$classid'";
	$search.="&classid=$classid";
}
$query="select spid,spname,varname,cid,classid,sptype,sppic,spsay,refile,spfile from {$dbtbpre}enewssp where isclose=0 and (groupid like '%,".$lur[groupid].",%' or userclass like '%,".$lur[classid].",%' or username like '%,".$lur[username].",%')".$add;
$totalquery="select count(*) as total from {$dbtbpre}enewssp where isclose=0 and (groupid like '%,".$lur[groupid].",%' or userclass like '%,".$lur[classid].",%' or username like '%,".$lur[username].",%')".$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by spid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=UpdateSp.php".$ecms_hashur['whehref'].">��s�H��</a>";
//����
$scstr="";
$scsql=$empire->query("select classid,classname from {$dbtbpre}enewsspclass order by classid");
while($scr=$empire->fetch($scsql))
{
	$select="";
	if($scr[classid]==$cid)
	{
		$select=" selected";
	}
	$scstr.="<option value='".$scr[classid]."'".$select.">".$scr[classname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�H��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td>��m: 
      <?=$url?>
      <div align="right"> </div></td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
<form name="searchform" method="GET" action="UpdateSp.php">
<?=$ecms_hashur['eform']?>
  <tr> 
      <td> 
        <select name="cid">
        <option value="0">�Ҧ�����</option>
        <?=$scstr?>
      </select>
        <select name="sptype" id="�Ҧ�����">
          <option value="0">�Ҧ�����</option>
		  <option value="1"<?=$sptype==1?' selected':''?>>�R�A�H���H��</option>
          <option value="2"<?=$sptype==2?' selected':''?>>�ʺA�H���H��</option>
          <option value="3"<?=$sptype==3?' selected':''?>>�N�X�H��</option>
        </select>
        <span id="listplclassnav"></span>  
		&nbsp;<input type="submit" name="Submit" value="���"></td>
  </tr>
</form>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="21%" height="25"> <div align="center">�H���W��</div></td>
    <td width="19%"><div align="center">�ܶq�W</div></td>
    <td width="40%"> <div align="center">�y�z</div></td>
    <td width="20%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
	if($r[sptype]==1)
	{
		$sptype='�R�A�H��';
		$dourl="ListSpInfo.php?spid=$r[spid]".$ecms_hashur['ehref'];
	}
	elseif($r[sptype]==2)
	{
		$sptype='�ʺA�H��';
		$dourl="ListSpInfo.php?spid=$r[spid]".$ecms_hashur['ehref'];
	}
	else
	{
		$sptype='�N�X�H��';
		$dourl="AddSpInfo.php?enews=EditSpInfo&spid=$r[spid]".$ecms_hashur['ehref'];
	}
	//�챵
	$sphref='';
	if($r['refile'])
	{
		$sphref=' href="'.$public_r['newsurl'].$r['spfile'].'" target="_blank"';
	}
	$sppic='';
	if($r[sppic])
	{
		$sppic='<a href="'.$r[sppic].'" title="�H���ĪG��" target="_blank"><img src="../../data/images/showimg.gif" border=0 align="absmiddle"></a>';
	}
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="32"><a<?=$sphref?> title="<?=$sptype?>"> 
      <?=$r[spname]?>
      </a> <?=$sppic?></td>
    <td><div align="center"> 
        <?=$r[varname]?>
      </div></td>
    <td> 
      <?=$r[spsay]?>
    </td>
    <td height="25"><div align="center">[<a href="<?=$dourl?>" target="_blank">��s�H��</a>]
	<?php
	if($r['refile'])
	{
	?>
	 [<a href="UpdateSp.php?enews=ReSp&spid[]=<?=$r[spid]?><?=$ecms_hashur['href']?>">��s�H�����</a>]
	<?php
	}
	?>
	</div></td>
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
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="../ShowClassNav.php?ecms=6&classid=<?=$classid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?php
db_close();
$empire=null;
?>
