<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
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

//�M�z�h�l�ƾ�
function ClearTags($start,$line,$userid,$username){
	global $empire,$dbtbpre,$class_r,$fun_r;
	$line=(int)$line;
	if(empty($line))
	{
		$line=500;
	}
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select id,classid,tid,tagid from {$dbtbpre}enewstagsdata where tid>$start order by tid limit ".$line);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r['tid'];
		if(empty($class_r[$r[classid]]['tbname']))
		{
			$empire->query("delete from {$dbtbpre}enewstagsdata where tid='$r[tid]'");
			$empire->query("update {$dbtbpre}enewstags set num=num-1 where tagid='$r[tagid]'");
			continue;
		}
		$index_r=$empire->fetch1("select id,classid,checked from {$dbtbpre}ecms_".$class_r[$r[classid]]['tbname']."_index where id='$r[id]' limit 1");
		if(!$index_r['id'])
		{
			$empire->query("delete from {$dbtbpre}enewstagsdata where tid='$r[tid]'");
			$empire->query("update {$dbtbpre}enewstags set num=num-1 where tagid='$r[tagid]'");
		}
		else
		{
			//��^��
			$infotb=ReturnInfoMainTbname($class_r[$r[classid]]['tbname'],$index_r['checked']);
			//�D��
			$infor=$empire->fetch1("select stb from ".$infotb." where id='$r[id]' limit 1");
			//��^��H��
			$infodatatb=ReturnInfoDataTbname($class_r[$r[classid]]['tbname'],$index_r['checked'],$infor['stb']);
			//�ƪ�
			$finfor=$empire->fetch1("select infotags from ".$infodatatb." where id='$r[id]' limit 1");
			$tagr=$empire->fetch1("select tagname from {$dbtbpre}enewstags where tagid='$r[tagid]'");
			if(!stristr(','.$finfor['infotags'].',',','.$tagr['tagname'].','))
			{
				$empire->query("delete from {$dbtbpre}enewstagsdata where tid='$r[tid]'");
				$empire->query("update {$dbtbpre}enewstags set num=num-1 where tagid='$r[tagid]'");
			}
			elseif($index_r['classid']!=$r[classid])
			{
				$empire->query("update {$dbtbpre}enewstagsdata set classid='$index_r[classid]' where tid='$r[tid]'");
			}
		}
	}
	if(empty($b))
	{
		//�ާ@��x
		insert_dolog("");
		printerror('ClearTagsSuccess','ClearTags.php'.hReturnEcmsHashStrHref2(1));
	}
	echo"<meta http-equiv=\"refresh\" content=\"0;url=ClearTags.php?enews=ClearTags&line=$line&start=$newstart".hReturnEcmsHashStrHref(0)."\">".$fun_r[OneClearTagsSuccess]."(ID:<font color=red><b>".$newstart."</b></font>)";
	exit();
}

$enews=$_GET['enews'];
if($enews)
{
	hCheckEcmsRHash();
	include("../../data/dbcache/class.php");
	include "../".LoadLang("pub/fun.php");
	ClearTags($_GET[start],$_GET[line],$logininid,$loginin);
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>TAGS</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href=ListTags.php<?=$ecms_hashur['whehref']?>>�޲zTAGS</a> &gt; �M�z�h�lTAGS�H��</td>
  </tr>
</table>
<form name="tagsclear" method="get" action="ClearTags.php" onsubmit="return confirm('�T�{�n�ާ@?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�M�z�h�lTAGS�H�� <input name=enews type=hidden value=ClearTags></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�C�վ�z�ơG</td>
      <td width="81%" height="25"><input name="line" type="text" id="line" value="500"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�}�l�M�z"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>