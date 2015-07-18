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
CheckLevel($logininid,$loginin,$classid,"userjs");

//�W�[�Τ�۩w�qjs
function AddUserjs($add,$userid,$username){
	global $empire,$dbtbpre;
	$cid=(int)$add['cid'];
	$jstempid=(int)$add['jstempid'];
	if(!$add[jsname]||!$jstempid||!$add[jssql]||!$add[jsfilename])
	{
		printerror("EmptyUserJsname","history.go(-1)");
	}
	$query_first=substr($add['jssql'],0,7);
	if(!($query_first=="select "||$query_first=="SELECT "))
	{
		printerror("JsSqlError","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"userjs");
	$add[jssql]=ClearAddsData($add[jssql]);
	$add[jsname]=hRepPostStr($add[jsname],1);
	$add['classid']=(int)$add['classid'];
	$sql=$empire->query("insert into {$dbtbpre}enewsuserjs(jsname,jssql,jstempid,jsfilename,classid) values('$add[jsname]','".addslashes($add[jssql])."',$jstempid,'$add[jsfilename]','$add[classid]');");
	//��sjs
	ReUserjs($add,"../");
	if($sql)
	{
		$jsid=$empire->lastid();
		//�ާ@��x
		insert_dolog("jsid=$jsid&jsname=$add[jsname]");
		printerror("AddUserjsSuccess","AddUserjs.php?enews=AddUserjs&classid=$cid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק�Τ�۩w�qjs
function EditUserjs($add,$userid,$username){
	global $empire,$dbtbpre;
	$cid=(int)$add['cid'];
	$jsid=(int)$add['jsid'];
	$jstempid=(int)$add['jstempid'];
	if(!$jsid||!$add[jsname]||!$jstempid||!$add[jssql]||!$add[jsfilename])
	{
		printerror("EmptyUserJsname","history.go(-1)");
	}
	$query_first=substr($add['jssql'],0,7);
	if(!($query_first=="select "||$query_first=="SELECT "))
	{
		printerror("JsSqlError","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"userjs");
	//�R����js���
	if($add['oldjsfilename']<>$add['jsfilename'])
	{
		DelFiletext($add['oldjsfilename']);
	}
	$add[jssql]=ClearAddsData($add[jssql]);
	$add[jsname]=hRepPostStr($add[jsname],1);
	$add['classid']=(int)$add['classid'];
	$sql=$empire->query("update {$dbtbpre}enewsuserjs set jsname='$add[jsname]',jssql='".addslashes($add[jssql])."',jstempid=$jstempid,jsfilename='$add[jsfilename]',classid='$add[classid]' where jsid=$jsid");
	//��sjs
	ReUserjs($add,"../");
	if($sql)
	{
		//�ާ@��x
	    insert_dolog("jsid=$jsid&jsname=$add[jsname]");
		printerror("EditUserjsSuccess","ListUserjs.php?classid=$cid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���Τ�۩w�qjs
function DelUserjs($jsid,$userid,$username){
	global $empire,$dbtbpre;
	$cid=(int)$add['cid'];
	$jsid=(int)$jsid;
	if(!$jsid)
	{
		printerror("NotChangeUserjsid","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"userjs");
	$r=$empire->fetch1("select jsname,jsfilename from {$dbtbpre}enewsuserjs where jsid=$jsid");
	$sql=$empire->query("delete from {$dbtbpre}enewsuserjs where jsid=$jsid");
	//�R�����
	DelFiletext("../".$r['jsfilename']);
	if($sql)
	{
		//�ާ@��x
		insert_dolog("jsid=$jsid&jsname=$r[jsname]");
		printerror("DelUserjsSuccess","ListUserjs.php?classid=$cid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//��s�۩w�qJS
function DoReUserjs($add,$userid,$username){
	global $empire,$dbtbpre;
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,"userjs");
	$jsid=$add['jsid'];
	$count=count($jsid);
	if(!$count)
	{
		printerror("EmptyReUserjsid","history.go(-1)");
    }
	for($i=0;$i<$count;$i++)
	{
		$jsid[$i]=(int)$jsid[$i];
		if(empty($jsid[$i]))
		{
			continue;
		}
		$ur=$empire->fetch1("select jsid,jsname,jssql,jstempid,jsfilename from {$dbtbpre}enewsuserjs where jsid='".$jsid[$i]."'");
		ReUserjs($ur,'../');
	}
	//�ާ@��x
	insert_dolog("");
	printerror("DoReUserjsSuccess",$_SERVER['HTTP_REFERER']);
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	require("../../data/dbcache/class.php");
}
if($enews=="AddUserjs")
{
	AddUserjs($_POST,$logininid,$loginin);
}
elseif($enews=="EditUserjs")
{
	EditUserjs($_POST,$logininid,$loginin);
}
elseif($enews=="DelUserjs")
{
	$jsid=$_GET['jsid'];
	DelUserjs($jsid,$logininid,$loginin);
}
elseif($enews=="DoReUserjs")
{
	DoReUserjs($_POST,$logininid,$loginin);
}
else
{}
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//�C����ܱ���
$page_line=20;//�C������챵��
$offset=$page*$line;//�`�����q
$search='';
$search.=$ecms_hashur['ehref'];
$query="select jsid,jsname,jsfilename from {$dbtbpre}enewsuserjs";
$totalquery="select count(*) as total from {$dbtbpre}enewsuserjs";
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
$query=$query." order by jsid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsuserjsclass order by classid");
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
<title>�޲z�Τ�۩w�qJS</title>
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
    <td width="50%" height="25">��m�G<a href=ListUserjs.php<?=$ecms_hashur['whehref']?>>�޲z�Τ�۩w�qJS</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit" value="�W�[�۩w�qJS" onclick="self.location.href='AddUserjs.php?enews=AddUserjs<?=$ecms_hashur['ehref']?>';">
		&nbsp;&nbsp;
        <input type="button" name="Submit5" value="�޲z�۩w�qJS����" onclick="self.location.href='UserjsClass.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td> ������O�G
      <select name="classid" id="classid" onchange=window.location='ListUserjs.php?<?=$ecms_hashur['ehref']?>&classid='+this.options[this.selectedIndex].value>
          <option value="0">��ܩҦ����O</option>
          <?=$cstr?>
        </select>
    </td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
<form name="form1" method="post" action="ListUserjs.php">
<?=$ecms_hashur['form']?>
  <tr class="header">
    <td width="5%"><div align="center">
        <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
      </div></td>
    <td width="9%" height="25"> <div align="center">ID</div></td>
    <td width="32%" height="25"> <div align="center">JS�W��</div></td>
    <td width="26%" height="25"> <div align="center">JS�a�}</div></td>
    <td width="10%"><div align="center">�w��</div></td>
    <td width="18%" height="25"> <div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  $jspath=$public_r['newsurl'].str_replace("../../","",$r['jsfilename']);
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
    <td><div align="center">
        <input name="jsid[]" type="checkbox" id="jsid[]" value="<?=$r[jsid]?>">
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[jsid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[jsname]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <input name="jspath" type="text" id="jspath" value="<?=$jspath?>">
      </div></td>
    <td><div align="center">[<a href="../view/js.php?js=<?=$jspath?>&classid=1<?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>]</div></td>
    <td height="25"> <div align="center">[<a href="AddUserjs.php?enews=EditUserjs&jsid=<?=$r[jsid]?>&cid=<?=$classid?><?=$ecms_hashur['ehref']?>">�ק�</a>]&nbsp;[<a href="AddUserjs.php?enews=AddUserjs&docopy=1&jsid=<?=$r[jsid]?>&cid=<?=$classid?><?=$ecms_hashur['ehref']?>">�ƻs</a>]&nbsp;[<a href="ListUserjs.php?enews=DelUserjs&jsid=<?=$r[jsid]?>&cid=<?=$classid?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> 
      <?=$returnpage?>
      &nbsp;&nbsp;&nbsp; <input type="submit" name="Submit3" value="��s"> <input name="enews" type="hidden" id="enews" value="DoReUserjs"> 
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6">JS�եΤ�k�G 
      <input name="textfield" type="text" size="60" value="&lt;script src=&quot;JS�a�}&quot;&gt;&lt;/script&gt;"></td>
  </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
