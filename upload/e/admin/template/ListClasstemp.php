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
CheckLevel($logininid,$loginin,$classid,"template");

//�W�[�ʭ��ҪO
function AddClasstemp($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add[tempname]||!$add[temptext])
	{
		printerror("EmptyClasstempname","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"template");
	$classid=(int)$add['classid'];
	$gid=(int)$add['gid'];
	$add[tempname]=hRepPostStr($add[tempname],1);
	$add[temptext]=RepPhpAspJspcode($add[temptext]);
	$sql=$empire->query("insert into ".GetDoTemptb("enewsclasstemp",$gid)."(tempname,temptext,classid) values('$add[tempname]','".eaddslashes2($add[temptext])."',$classid);");
	$tempid=$empire->lastid();
	//�ƥ��ҪO
	AddEBakTemp('classtemp',$gid,$tempid,$add[tempname],$add[temptext],0,0,'',0,0,'',0,$classid,0,$userid,$username);
	if($sql)
	{
		//�ާ@��x
		insert_dolog("tempid=$tempid&tempname=$add[tempname]&gid=$gid");
		printerror("AddClasstempSuccess","AddClasstemp.php?enews=AddClasstemp&gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק�ʭ��ҪO
function EditClasstemp($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$add['tempid'];
	if(!$tempid||!$add[tempname]||!$add[temptext])
	{
		printerror("EmptyClasstempname","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"template");
	$classid=(int)$add['classid'];
	$gid=(int)$add['gid'];
	$add[tempname]=hRepPostStr($add[tempname],1);
	$add[temptext]=RepPhpAspJspcode($add[temptext]);
	$sql=$empire->query("update ".GetDoTemptb("enewsclasstemp",$gid)." set tempname='$add[tempname]',temptext='".eaddslashes2($add[temptext])."',classid=$classid where tempid=$tempid");
	//�ƥ��ҪO
	AddEBakTemp('classtemp',$gid,$tempid,$add[tempname],$add[temptext],0,0,'',0,0,'',0,$classid,0,$userid,$username);
	if($gid==$public_r['deftempid']||(!$public_r['deftempid']&&($gid==1||$gid==0)))
	{
		//�R���ʺA�ҪO�w�s���
		DelOneTempTmpfile('classtemp'.$tempid);
	}
	if($sql)
	{
		//�ާ@��x
		insert_dolog("tempid=$tempid&tempname=$add[tempname]&gid=$gid");
		printerror("EditClasstempSuccess","ListClasstemp.php?classid=$add[cid]&gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���ʭ��ҪO
function DelClasstemp($add,$userid,$username){
	global $empire,$dbtbpre,$public_r;
	$tempid=(int)$add['tempid'];
	if(!$tempid)
	{
		printerror("EmptyClasstempid","history.go(-1)");
    }
	//�����v��
	CheckLevel($userid,$username,$classid,"template");
	$gid=(int)$add['gid'];
	$r=$empire->fetch1("select tempname from ".GetDoTemptb("enewsclasstemp",$gid)." where tempid=$tempid");
	$sql=$empire->query("delete from ".GetDoTemptb("enewsclasstemp",$gid)." where tempid=$tempid");
	//�R���ƥ��O��
	DelEbakTempAll('classtemp',$gid,$tempid);
	if($gid==$public_r['deftempid']||(!$public_r['deftempid']&&($gid==1||$gid==0)))
	{
		//�R���ʺA�ҪO�w�s���
		DelOneTempTmpfile('classtemp'.$tempid);
	}
	if($sql)
	{
		//�ާ@��x
		insert_dolog("tempid=$tempid&tempname=$r[tempname]&gid=$gid");
		printerror("DelClasstempSuccess","ListClasstemp.php?classid=$add[cid]&gid=$gid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ާ@
$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include("../../class/tempfun.php");
}
//�W�[�ҪO
if($enews=="AddClasstemp")
{
	AddClasstemp($_POST,$logininid,$loginin);
}
//�ק�ҪO
elseif($enews=="EditClasstemp")
{
	EditClasstemp($_POST,$logininid,$loginin);
}
//�R���ҪO
elseif($enews=="DelClasstemp")
{
	DelClasstemp($_GET,$logininid,$loginin);
}
else
{}
$gid=(int)$_GET['gid'];
$gname=CheckTempGroup($gid);
$urlgname=$gname."&nbsp;>&nbsp;";
$url=$urlgname."<a href=ListClasstemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲z�ʭ��ҪO</a>";
$search="&gid=$gid".$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select tempid,tempname from ".GetDoTemptb("enewsclasstemp",$gid);
$totalquery="select count(*) as total from ".GetDoTemptb("enewsclasstemp",$gid);
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
$query=$query." order by tempid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsclasstempclass order by classid");
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
<title>�޲z�ʭ��ҪO</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">��m�G 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�W�[�ʭ��ҪO" onclick="self.location.href='AddClasstemp.php?enews=AddClasstemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
		&nbsp;&nbsp;
		<input type="button" name="Submit5" value="�޲z�ʭ��ҪO����" onclick="self.location.href='ClassTempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="form1" method="get" action="ListClasstemp.php">
  <?=$ecms_hashur['eform']?>
  <input type=hidden name=gid value="<?=$gid?>">
    <tr> 
      <td height="25">������ܡG 
        <select name="classid" id="classid" onchange="document.form1.submit()">
          <option value="0">��ܩҦ�����</option>
		  <?=$cstr?>
        </select>
      </td>
    </tr>
	</form>
  </table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="10%" height="25"><div align="center">ID</div></td>
    <td width="61%" height="25"><div align="center">�ҪO�W</div></td>
    <td width="29%" height="25"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#ffffff" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"><div align="center"> 
        <?=$r[tempid]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[tempname]?>
      </div></td>
    <td height="25"><div align="center"> [<a href="AddClasstemp.php?enews=EditClasstemp&tempid=<?=$r[tempid]?>&cid=<?=$classid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>">�ק�</a>] 
        [<a href="AddClasstemp.php?enews=AddClasstemp&docopy=1&tempid=<?=$r[tempid]?>&cid=<?=$classid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>">�ƻs</a>] 
        [<a href="ListClasstemp.php?enews=DelClasstemp&tempid=<?=$r[tempid]?>&cid=<?=$classid?>&gid=<?=$gid?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="ffffff"> 
    <td height="25" colspan="3">&nbsp; 
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
