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
CheckLevel($logininid,$loginin,$classid,"tags");

//�R��TAGS
function DelTags($add,$userid,$username){
	global $empire,$dbtbpre;
	$tagid=(int)$add['tagid'];
	if(!$tagid)
	{
		printerror("EmptyTagid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$r=$empire->fetch1("select tagname from {$dbtbpre}enewstags where tagid='$tagid'");
	$sql=$empire->query("delete from {$dbtbpre}enewstags where tagid='$tagid'");
	$sql2=$empire->query("delete from {$dbtbpre}enewstagsdata where tagid='$tagid'");
	if($sql&&$sql2)
	{
		//�ާ@��x
		insert_dolog("tagid=$tagid&tagname=$r[tagname]");
		printerror("DelTagsSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//��q�R��TAGS
function DelTags_all($add,$userid,$username){
	global $empire,$dbtbpre;
	$tagid=$add['tagid'];
	$count=count($tagid);
	if(!$count)
	{
		printerror("EmptyTagid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$ids='';
	$dh='';
	for($i=0;$i<$count;$i++)
	{
		$id=(int)$tagid[$i];
		$ids.=$dh.$id;
		$dh=',';
	}
	$sql=$empire->query("delete from {$dbtbpre}enewstags where tagid in ($ids)");
	$sql2=$empire->query("delete from {$dbtbpre}enewstagsdata where tagid in ($ids)");
	if($sql&&$sql2)
	{
		//�ާ@��x
		insert_dolog("");
		printerror("DelTagsSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���ϥβv�C��TAGS
function DelLessTags($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$num=(int)$add['num'];
	$ids='';
	$dh='';
	$sql=$empire->query("select tagid from {$dbtbpre}enewstags where num<=$num");
	while($r=$empire->fetch($sql))
	{
		$ids.=$dh.$r[tagid];
		$dh=',';
	}
	if(!$ids)
	{
		printerror("EmptyLessTags","history.go(-1)");
	}
	$del=$empire->query("delete from {$dbtbpre}enewstags where num<=$num");
	$del2=$empire->query("delete from {$dbtbpre}enewstagsdata where tagid in ($ids)");
	if($del&&$del2)
	{
		//�ާ@��x
		insert_dolog("num=$num");
		printerror("DelLessTagsSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���L����TAG�H��
function DelOldTagsInfo($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	if(empty($add['newstime']))
	{
		printerror("EmptyTagsTime","history.go(-1)");
	}
	$newstime=to_time($add['newstime']);
	$sql=$empire->query("select tagid from {$dbtbpre}enewstagsdata where newstime<=$newstime");
	while($r=$empire->fetch($sql))
	{
		$empire->query("update {$dbtbpre}enewstags set num=num-1 where tagid='$r[tagid]'");
	}
	$del=$empire->query("delete from {$dbtbpre}enewstagsdata where newstime<=$newstime");
	if($del)
	{
		//�ާ@��x
		insert_dolog("newstime=$add[newstime]");
		printerror("DelOldTagsInfoSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�X��TAGS
function MergeTags($add,$userid,$username){
	global $empire,$dbtbpre;
	$tagid=$add['tagid'];
	$count=count($tagid);
	if(!$count)
	{
		printerror("EmptyTagid","history.go(-1)");
	}
	$newtagname=RepPostVar($add['newtagname']);
	if(!$newtagname)
	{
		printerror("NotMergeTagname","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$r=$empire->fetch1("select tagid from {$dbtbpre}enewstags where tagname='$newtagname' limit 1");
	if(!$r[tagid])
	{
		printerror("NotMergeTagname","history.go(-1)");
	}
	$ids='';
	$dh='';
	$allnum=0;
	for($i=0;$i<$count;$i++)
	{
		$id=(int)$tagid[$i];
		if(!$id)
		{
			continue;
		}
		$tr=$empire->fetch1("select tagid,num from {$dbtbpre}enewstags where tagid='$id'");
		if(!$tr[tagid])
		{
			continue;
		}
		$ids.=$dh.$id;
		$dh=',';
		$allnum+=$tr[num];
	}
	if(empty($ids))
	{
		printerror("EmptyTagid","history.go(-1)");
	}
	$sql=$empire->query("update {$dbtbpre}enewstags set num=num+$allnum where tagid='$r[tagid]'");
	$sql2=$empire->query("update {$dbtbpre}enewstagsdata set tagid='$r[tagid]' where tagid in ($ids)");
	$sql3=$empire->query("delete from {$dbtbpre}enewstags where tagid in ($ids)");
	if($sql&&$sql2&&$sql3)
	{
		//�ާ@��x
		insert_dolog("newtagname=$newtagname");
		printerror("MergeTagsSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�W�[TAGS
function AddTags($add,$userid,$username){
	global $empire,$dbtbpre;
	$tagname=RepPostVar($add['tagname']);
	$cid=(int)$add['cid'];
	if(!$tagname)
	{
		printerror("EmptyTagname","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewstags where tagname='$tagname' limit 1");
	if($num)
	{
		printerror("HaveTagname","history.go(-1)");
	}
	$sql=$empire->query("insert into {$dbtbpre}enewstags(tagname,num,isgood,cid) values('$tagname',0,0,'$cid');");
	if($sql)
	{
		$tagid=$empire->lastid();
		//�ާ@��x
		insert_dolog("tagid=$tagid&tagname=$tagname");
		printerror("AddTagsSuccess","AddTags.php?enews=AddTags".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק�TAGS
function EditTags($add,$userid,$username){
	global $empire,$dbtbpre;
	$tagid=(int)$add['tagid'];
	$tagname=RepPostVar($add['tagname']);
	$cid=(int)$add['cid'];
	if(!$tagid||!$tagname)
	{
		printerror("EmptyTagname","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewstags where tagname='$tagname' and tagid<>$tagid limit 1");
	if($num)
	{
		printerror("HaveTagname","history.go(-1)");
	}
	$sql=$empire->query("update {$dbtbpre}enewstags set tagname='$tagname',cid='$cid' where tagid='$tagid'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("tagid=$tagid&tagname=$tagname");
		printerror("EditTagsSuccess","ListTags.php?cid=$add[fcid]".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//��q����TAGS
function GoodTags($add,$userid,$username){
	global $empire,$dbtbpre;
	$tagid=$add['tagid'];
	$count=count($tagid);
	$isgood=(int)$add['isgood'];
	if(!$count)
	{
		printerror("EmptyTagid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$ids='';
	$dh='';
	for($i=0;$i<$count;$i++)
	{
		$id=(int)$tagid[$i];
		$ids.=$dh.$id;
		$dh=',';
	}
	$sql=$empire->query("update {$dbtbpre}enewstags set isgood=$isgood where tagid in ($ids)");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("");
		printerror("GoodTagsSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�]�mTAGS
function SetTags($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"tags");
	$opentags=(int)$add['opentags'];
	$tagstempid=(int)$add['tagstempid'];
	$usetags=eReturnRDataStr($add['umid']);
	$chtags=eReturnRDataStr($add['cmid']);
	$tagslistnum=(int)$add['tagslistnum'];
	$sql=$empire->query("update {$dbtbpre}enewspublic set opentags='$opentags',tagstempid='$tagstempid',usetags='$usetags',chtags='$chtags',tagslistnum='$tagslistnum' limit 1");
	if($sql)
	{
		GetConfig();
		//�ާ@��x
		insert_dolog("");
		printerror("SetTagsSuccess","SetTags.php".hReturnEcmsHashStrHref2(1));
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
if($enews=="AddTags")//�W�[TAGS
{
	AddTags($_POST,$logininid,$loginin);
}
elseif($enews=="EditTags")//�ק�TAGS
{
	EditTags($_POST,$logininid,$loginin);
}
elseif($enews=="DelTags")//�R��TAGS
{
	DelTags($_GET,$logininid,$loginin);
}
elseif($enews=="DelTags_all")//��q�R��TAGS
{
	DelTags_all($_POST,$logininid,$loginin);
}
elseif($enews=="MergeTags")//�X��TAGS
{
	MergeTags($_POST,$logininid,$loginin);
}
elseif($enews=="GoodTags")//����TAGS
{
	GoodTags($_POST,$logininid,$loginin);
}
elseif($enews=="DelLessTags")//�R���ϥβv�C��TAGS
{
	DelLessTags($_POST,$logininid,$loginin);
}
elseif($enews=="DelOldTagsInfo")//�R���L��TAGS�H��
{
	DelOldTagsInfo($_POST,$logininid,$loginin);
}
elseif($enews=="SetTags")//�]�mTAGS
{
	SetTags($_POST,$logininid,$loginin);
}
else
{}

$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//�C����ܱ���
$page_line=20;//�C������챵��
$offset=$page*$line;//�`�����q
//�j��
$add='';
$search='';
$search.=$ecms_hashur['ehref'];
//����
$isgood=(int)$_GET[isgood];
if($isgood)
{
	$add.=' and isgood=1';
	$search.="&isgood=$isgood";
}
//����
$cid=(int)$_GET[cid];
if($cid)
{
	$add.=" and cid='$cid'";
	$search.="&cid=$cid";
}
//����r
if($_GET['keyboard'])
{
	$keyboard=RepPostVar($_GET['keyboard']);
	$show=(int)$_GET['show'];
	if($show==1)
	{
		$add.=" and tagid='$keyboard'";
	}
	else
	{
		$add.=" and tagname like '%$keyboard%'";
	}
	$search.="&show=$show&keyboard=$keyboard";
}
//�Ƨ�
$orderby=RepPostStr($_GET['orderby'],1);
if($orderby==1)//��TAGID�ɧǱƧ�
{$doorder='tagid asc';}
elseif($orderby==2)//���H���ƭ��ǱƧ�
{$doorder='num desc';}
elseif($orderby==3)//���H���ƤɧǱƧ�
{$doorder='num asc';}
else//��TAGID���ǱƧ�
{$doorder='tagid desc';}
$search.="&orderby=$orderby";
$add=$add?' where '.substr($add,5):'';
$query="select tagid,tagname,num,isgood,cid from {$dbtbpre}enewstags".$add;
$totalquery="select count(*) as total from {$dbtbpre}enewstags".$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by ".$doorder." limit $offset,$line";
$sql=$empire->query($query);
//����
$csql=$empire->query("select classid,classname from {$dbtbpre}enewstagsclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cid==$cr[classid])
	{
		$select=" selected";
	}
	$cs.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�޲zTAGS</title>
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
    <td width="22%" height="25">��m�G<a href="ListTags.php<?=$ecms_hashur['whehref']?>">�޲zTAGS</a></td>
    <td width="78%"><div align="right" class="emenubutton">
        <input type="button" name="Submit" value="�W�[TAGS" onclick="self.location.href='AddTags.php?enews=AddTags<?=$ecms_hashur['ehref']?>';">&nbsp;
        <input type="button" name="Submit4" value="TAGS�����޲z" onclick="self.location.href='TagsClass.php<?=$ecms_hashur['whehref']?>';">&nbsp;
        <input type="button" name="Submit42" value="�]�mTAGS" onclick="self.location.href='SetTags.php<?=$ecms_hashur['whehref']?>';">&nbsp;
        <input type="button" name="Submit422" value="�M�z�h�lTAGS�H��" onclick="self.location.href='ClearTags.php<?=$ecms_hashur['whehref']?>';">&nbsp;
        <input type="button" name="Submit5" value="�R���ϥβv�C��TAGS" onclick="self.location.href='DelLessTags.php<?=$ecms_hashur['whehref']?>';">&nbsp;
        <input type="button" name="Submit6" value="�R���L����TAGS�H��" onclick="self.location.href='DelOldTagsInfo.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
  <table width="100%" border="0" cellspacing="1" cellpadding="3">
  <form name="searchform" method="GET" action="ListTags.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25">�j���G
        <select name="show" id="show">
          <option value="0"<?=$show==0?' selected':''?>>TAG�W��</option>
		  <option value="1"<?=$show==1?' selected':''?>>TAGID</option>
        </select> 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        <select name="cid" id="cid">
          <option value="0">��������</option>
		  <?=$cs?>
        </select>
        <input name="isgood" type="checkbox" id="isgood" value="1"<?=$isgood==1?' checked':''?>>
        ����TAGS
        <select name="orderby" id="orderby">
          <option value="0"<?=$orderby==0?' selected':''?>>��TAGID���ǱƧ�</option>
		  <option value="1"<?=$orderby==1?' selected':''?>>��TAGID�ɧǱƧ�</option>
          <option value="2"<?=$orderby==2?' selected':''?>>���H���ƭ��ǱƧ�</option>
		  <option value="3"<?=$orderby==3?' selected':''?>>���H���ƤɧǱƧ�</option>
        </select> 
        <input type="submit" name="Submit2" value="���"></td>
    </tr>
  </form>
  </table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="listform" method="post" action="ListTags.php" onsubmit="return confirm('�T�{�n�ާ@?');">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="4%"><div align="center">���</div></td>
      <td width="7%" height="25"> <div align="center">ID</div></td>
      <td width="25%" height="25"> <div align="center">TAG�W��</div></td>
      <td width="25%" height="25"> <div align="center">�H����</div></td>
      <td width="21%"><div align="center">����</div></td>
      <td width="18%" height="25"> <div align="center">�ާ@</div></td>
    </tr>
    <?php
  while($r=$empire->fetch($sql))
  {
  	$st='';
  	if($r[isgood]==1)
	{
		$st='<font color="red">[��]</font>';
	}
	if($r[cid])
	{
		$cr=$empire->fetch1("select classname from {$dbtbpre}enewstagsclass where classid='$r[cid]'");
		$classname='<a href="ListTags.php?cid='.$r[cid].$ecms_hashur['ehref'].'">'.$cr[classname].'</a>';
	}
	else
	{
		$classname='������';
	}
	$rewriter=eReturnRewriteTagsUrl($r['tagid'],$r['tagname'],1);
	$tagsurl=$rewriter['pageurl'];
  ?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td><div align="center"> 
          <input name="tagid[]" type="checkbox" id="tagid[]" value="<?=$r[tagid]?>">
        </div></td>
      <td height="25"> <div align="center"> 
          <?=$r[tagid]?>
        </div></td>
      <td height="25"> 
        <?=$st?>
        <a href="<?=$tagsurl?>" target="_blank">
        <?=$r[tagname]?>
        </a> </td>
      <td height="25"> <div align="center">
          <?=$r[num]?>
        </div></td>
      <td><div align="center">
          <?=$classname?>
        </div></td>
      <td height="25"> <div align="center">[<a href="AddTags.php?enews=EditTags&tagid=<?=$r[tagid]?>&fcid=<?=$cid?><?=$ecms_hashur['ehref']?>">�ק�</a>]&nbsp;&nbsp;[<a href="ListTags.php?enews=DelTags&tagid=<?=$r[tagid]?>&fcid=<?=$cid?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a>]</div></td>
    </tr>
    <?php
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <input type=checkbox name=chkall value=on onClick=CheckAll(this.form)>
        </div></td>
      <td height="25" colspan="5"> <div align="right">
          <input type="submit" name="Submit8" value="����" onClick="document.listform.enews.value='GoodTags';document.listform.isgood.value='1';">
          <input type="submit" name="Submit82" value="��������" onClick="document.listform.enews.value='GoodTags';document.listform.isgood.value='0';">
          <input type="submit" name="Submit822" value="�R��" onClick="document.listform.enews.value='DelTags_all';">
          �ؼ�TAGS 
          <input name="newtagname" type="text" size="20">
          <input type="submit" name="Submit3" value="�X��" onClick="document.listform.enews.value='MergeTags';">
          <input name="enews" type="hidden" id="enews" value="DelTags_all">
          <input name="isgood" type="hidden" id="isgood" value="1">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25" colspan="5">
        <?=$returnpage?>
      </td>
    </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>