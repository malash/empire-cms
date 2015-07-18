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

//��^�Τ��
function ReturnSpGroup($groupid){
	$count=count($groupid);
	if($count==0)
	{
		return '';
	}
	$ids=',';
	for($i=0;$i<$count;$i++)
	{
		$ids.=$groupid[$i].',';
	}
	return $ids;
}

//�W�[�H��
function AddSp($add,$userid,$username){
	global $empire,$dbtbpre;
	$add['varname']=RepPostVar($add['varname']);
	if(!$add[spname]||!$add[varname])
	{
		printerror("EmptySp","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"sp");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewssp where varname='$add[varname]' limit 1");
	if($num)
	{
		printerror("HaveSp","history.go(-1)");
	}
	$add[sptype]=(int)$add[sptype];
	$add[cid]=(int)$add[cid];
	$add[classid]=(int)$add[classid];
	$add[tempid]=(int)$add[tempid];
	$add[maxnum]=(int)$add[maxnum];
	$sptime=time();
	$groupid=ReturnSpGroup($add[groupid]);
	$userclass=ReturnSpGroup($add[userclass]);
	$username=','.$add[username].',';
	$add[isclose]=(int)$add[isclose];
	$add[cladd]=(int)$add[cladd];
	$add['refile']=(int)$add['refile'];
	$add['spfile']=DoRepFileXg($add['spfile']);
	$add['spfileline']=(int)$add['spfileline'];
	$add['spfilesub']=(int)$add['spfilesub'];
	$add['filepass']=(int)$add['filepass'];
	$sql=$empire->query("insert into {$dbtbpre}enewssp(spname,varname,sppic,spsay,sptype,cid,classid,tempid,maxnum,sptime,groupid,userclass,username,isclose,cladd,refile,spfile,spfileline,spfilesub) values('$add[spname]','$add[varname]','$add[sppic]','$add[spsay]','$add[sptype]','$add[cid]','$add[classid]','$add[tempid]','$add[maxnum]','$sptime','$groupid','$userclass','$username','$add[isclose]','$add[cladd]','$add[refile]','$add[spfile]','$add[spfileline]','$add[spfilesub]');");
	$spid=$empire->lastid();
	//��s����
	UpdateTheFileOther(7,$spid,$add['filepass'],'other');
	//�ͦ��H�����
	if($add['refile'])
	{
		DoSpReFile($add,0);
	}
	if($sql)
	{
		//�ާ@��x
		insert_dolog("spid=".$spid."<br>spname=".$add[spname]);
		printerror("AddSpSuccess","AddSp.php?enews=AddSp".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק�H��
function EditSp($add,$userid,$username){
	global $empire,$dbtbpre;
	$add['varname']=RepPostVar($add['varname']);
	$spid=(int)$add[spid];
	if(!$spid||!$add[spname]||!$add[varname])
	{
		printerror("EmptySp","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"sp");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewssp where varname='$add[varname]' and spid<>$spid limit 1");
	if($num)
	{
		printerror("HaveSp","history.go(-1)");
	}
	$add[sptype]=(int)$add[sptype];
	$add[cid]=(int)$add[cid];
	$add[classid]=(int)$add[classid];
	$add[tempid]=(int)$add[tempid];
	$add[maxnum]=(int)$add[maxnum];
	$sptime=time();
	$groupid=ReturnSpGroup($add[groupid]);
	$userclass=ReturnSpGroup($add[userclass]);
	$username=','.$add[username].',';
	$add[isclose]=(int)$add[isclose];
	$add[cladd]=(int)$add[cladd];
	$add['refile']=(int)$add['refile'];
	$add['spfile']=DoRepFileXg($add['spfile']);
	$add['oldspfile']=DoRepFileXg($add['oldspfile']);
	$add['spfileline']=(int)$add['spfileline'];
	$add['spfilesub']=(int)$add['spfilesub'];
	$add['filepass']=(int)$add['filepass'];
	$sql=$empire->query("update {$dbtbpre}enewssp set spname='$add[spname]',varname='$add[varname]',sppic='$add[sppic]',spsay='$add[spsay]',sptype='$add[sptype]',cid='$add[cid]',classid='$add[classid]',tempid='$add[tempid]',maxnum='$add[maxnum]',groupid='$groupid',userclass='$userclass',username='$username',isclose='$add[isclose]',cladd='$add[cladd]',refile='$add[refile]',spfile='$add[spfile]',spfileline='$add[spfileline]',spfilesub='$add[spfilesub]' where spid='$spid'");
	//��s����
	UpdateTheFileEditOther(7,$spid,'other');
	//�ͦ��H�����
	if($add['refile'])
	{
		//�¤��
		if($add['spfile']!=$add['oldspfile'])
		{
			DelSpReFile($add['oldspfile']);
		}
		DoSpReFile($add,0);
	}
	if($sql)
	{
		//�ާ@��x
		insert_dolog("spid=".$spid."<br>spname=".$add[spname]);
		printerror("EditSpSuccess","ListSp.php?cid=$add[fcid]&fclassid=$add[fclassid]&fsptype=$add[fsptype]".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���H��
function DelSp($add,$userid,$username){
	global $empire,$dbtbpre;
	$spid=(int)$add[spid];
	if(!$spid)
	{
		printerror("NotDelSpid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"sp");
	$r=$empire->fetch1("select spname,sptype,refile,spfile from {$dbtbpre}enewssp where spid='$spid'");
	$sql=$empire->query("delete from {$dbtbpre}enewssp where spid='$spid'");
	if($r[sptype]==1)
	{
		$empire->query("delete from {$dbtbpre}enewssp_1 where spid='$spid'");
	}
	elseif($r[sptype]==2)
	{
		$empire->query("delete from {$dbtbpre}enewssp_2 where spid='$spid'");
	}
	if($r[sptype]==3)
	{
		$empire->query("delete from {$dbtbpre}enewssp_3 where spid='$spid'");
		$empire->query("delete from {$dbtbpre}enewssp_3_bak where spid='$spid'");
	}
	//�R���H�����
	if($r['refile'])
	{
		DelSpReFile($r['spfile']);
	}
	//�R������
	DelFileOtherTable("modtype=7 and id='$spid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("spid=".$spid."<br>spname=".$r[spname]);
		printerror("DelSpSuccess","ListSp.php?cid=$add[fcid]&fclassid=$add[fclassid]&fsptype=$add[fsptype]".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���H�����
function DelSpReFile($file){
	$filename=ECMS_PATH.$file;
	if($file&&file_exists($filename)&&!stristr('/'.$file,'/e/'))
	{
		DelFiletext($filename);
	}
}

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
if($enews=="AddSp")//�W�[�H��
{
	AddSp($_POST,$logininid,$loginin);
}
elseif($enews=="EditSp")//�ק�H��
{
	EditSp($_POST,$logininid,$loginin);
}
elseif($enews=="DelSp")//�R���H��
{
	DelSp($_GET,$logininid,$loginin);
}
elseif($enews=='ReSp')//��s�H�����
{
	ReSp($_POST,$logininid,$loginin,0);
}

$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$add='';
$and='';
$search='';
$search.=$ecms_hashur['ehref'];
//�H������
$sptype=(int)$_GET['sptype'];
if($sptype)
{
	$add.=$and."sptype='$sptype'";
	$and=' and ';
	$search.="&sptype=$sptype";
}
//����
$cid=(int)$_GET['cid'];
if($cid)
{
	$add.=$and."cid='$cid'";
	$and=' and ';
	$search.="&cid=$cid";
}
//���
$classid=(int)$_GET['classid'];
if($classid)
{
	$add.=$and."classid='$classid'";
	$search.="&classid=$classid";
}
if($add)
{
	$add=' where '.$add;
}
$query="select spid,spname,varname,cid,classid,isclose,sptype,sptime,refile,spfile from {$dbtbpre}enewssp".$add;
$totalquery="select count(*) as total from {$dbtbpre}enewssp".$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by spid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=ListSp.php".$ecms_hashur['whehref'].">�޲z�H��</a>";
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
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td width="50%">��m: 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�W�[�H��" onclick="self.location.href='AddSp.php?enews=AddSp<?=$ecms_hashur['ehref']?>';">
		&nbsp;&nbsp;
        <input type="button" name="Submit52" value="�޲z�H������" onclick="self.location.href='ListSpClass.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td> ��ܤ����G 
      <select name="classid" id="classid" onchange=window.location='ListSp.php?<?=$ecms_hashur['ehref']?>&cid='+this.options[this.selectedIndex].value>
        <option value="0">��ܩҦ�����</option>
        <?=$scstr?>
      </select> </td>
  </tr>
</table>
<br>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="listspform" method="post" action="ListSp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header">
      <td width="4%"><div align="center"><input type=checkbox name=chkall value=on onClick="CheckAll(this.form)"></div></td>
      <td width="6%" height="25"><div align="center">ID</div></td>
      <td width="20%" height="25"><div align="center">�H���W��</div></td>
      <td width="17%"><div align="center">�ܶq�W</div></td>
      <td width="15%"><div align="center">���ݤ���</div></td>
      <td width="12%"><div align="center">�H������</div></td>
      <td width="6%"><div align="center">���A</div></td>
      <td width="20%" height="25"><div align="center">�ާ@</div></td>
    </tr>
    <?php
  while($r=$empire->fetch($sql))
  {
  	$spclassname='--';
  	if($r[cid])
	{
		$scr=$empire->fetch1("select classname from {$dbtbpre}enewsspclass where classid='$r[cid]'");
		$spclassname=$scr['classname'];
	}
	if($r[sptype]==1)
	{
		$sptypename='�R�A�H��';
	}
	elseif($r[sptype]==2)
	{
		$sptypename='�ʺA�H��';
	}
	else
	{
		$sptypename='�N�X�H��';
	}
	//�챵
	$sphref='';
	if($r['refile'])
	{
		$sphref=' href="'.$public_r['newsurl'].$r['spfile'].'" target="_blank"';
	}
  ?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
      <td><div align="center">
        <?php
		if($r['refile'])
		{
		?>
		<input name="spid[]" type="checkbox" id="spid[]" value="<?=$r[spid]?>">
		<?php
		}
		?>
      </div></td>
      <td height="32"><div align="center">
          <?=$r[spid]?>
      </div></td>
      <td height="25"><a<?=$sphref?> title="�W�[�ɶ��G<?=date('Y-m-d H:i:s',$r[sptime])?>">
        <?=$r[spname]?>
      </a> </td>
      <td><div align="center">
        <?=$r[varname]?>
      </div></td>
      <td><div align="center"><a href="ListSp.php?cid=<?=$r[cid]?><?=$ecms_hashur['ehref']?>">
        <?=$spclassname?>
      </a></div></td>
      <td><div align="center"><a href="ListSp.php?sptype=<?=$r[sptype]?><?=$ecms_hashur['ehref']?>">
        <?=$sptypename?>
      </a></div></td>
      <td><div align="center">
        <?=$r[isclose]==1?'<font color="red">����</font>':'�}��'?>
      </div></td>
      <td height="25"><div align="center">[<a href="AddSp.php?enews=EditSp&spid=<?=$r[spid]?>&fcid=<?=$cid?>&fclassid=<?=$classid?>&fsptype=<?=$sptype?><?=$ecms_hashur['ehref']?>">�ק�</a>] 
        [<a href="AddSp.php?enews=AddSp&spid=<?=$r[spid]?>&fcid=<?=$cid?>&fclassid=<?=$classid?>&fsptype=<?=$sptype?>&docopy=1<?=$ecms_hashur['ehref']?>">�ƻs</a>] 
        [<a href="ListSp.php?enews=DelSp&spid=<?=$r[spid]?>&fcid=<?=$cid?>&fclassid=<?=$classid?>&fsptype=<?=$sptype?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>]</div></td>
    </tr>
    <?php
  }
  ?>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="8">&nbsp;
          <?=$returnpage?>
      &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="Submit" value="��s�H�����">
      <input name="enews" type="hidden" id="enews" value="ReSp"></td>
    </tr>
  </form>
  </table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
