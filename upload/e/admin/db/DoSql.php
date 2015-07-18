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
CheckLevel($logininid,$loginin,$classid,"execsql");

//����SQL�y�y
function DoExecSql($add,$userid,$username){
	global $empire,$dbtbpre;
	$dosave=(int)$add['dosave'];
	$query=$add['query'];
	if(!$query)
	{
		printerror("EmptyDoSqlQuery","history.go(-1)");
    }
	if($dosave==1&&!$add['sqlname'])
	{
		printerror("EmptySqltext","history.go(-1)");
	}
	$query=ClearAddsData($query);
	//�O�s
	if($dosave==1)
	{
		$add['sqlname']=hRepPostStr($add['sqlname'],1);
		$isql=$empire->query("insert into {$dbtbpre}enewssql(sqlname,sqltext) values('".$add['sqlname']."','".addslashes($query)."');");
	}
	$query=RepSqlTbpre($query);
	DoRunQuery($query);
	//�ާ@��x
	insert_dolog("query=".$query);
	printerror("DoExecSqlSuccess","DoSql.php".hReturnEcmsHashStrHref2(1));
}

//�B��SQL
function DoRunQuery($sql){
	global $empire;
	$sql=str_replace("\r","\n",$sql);
	$ret=array();
	$num=0;
	foreach(explode(";\n",trim($sql)) as $query)
	{
		$queries=explode("\n",trim($query));
		foreach($queries as $query)
		{
			$ret[$num].=$query[0]=='#'||$query[0].$query[1]=='--'?'':$query;
		}
		$num++;
	}
	unset($sql);
	foreach($ret as $query)
	{
		$query=trim($query);
		if($query)
		{
			$empire->query($query);
		}
	}
}

//�W�[SQL�y�y
function AddSql($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!$add['sqlname']||!$add['sqltext'])
	{
		printerror("EmptySqltext","history.go(-1)");
	}
	$add['sqlname']=hRepPostStr($add['sqlname'],1);
	$add[sqltext]=ClearAddsData($add[sqltext]);
	$sql=$empire->query("insert into {$dbtbpre}enewssql(sqlname,sqltext) values('".$add['sqlname']."','".addslashes($add[sqltext])."');");
	$lastid=$empire->lastid();
	if($sql)
	{
		//�ާ@��x
		insert_dolog("id=".$lastid."<br>sqlname=".$add[sqlname]);
		printerror("AddSqlSuccess","AddSql.php?enews=AddSql".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק�SQL�y�y
function EditSql($add,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$add[id];
	if(!$add['sqlname']||!$add['sqltext']||!$id)
	{
		printerror("EmptySqltext","history.go(-1)");
	}
	$add['sqlname']=hRepPostStr($add['sqlname'],1);
	$add[sqltext]=ClearAddsData($add[sqltext]);
	$sql=$empire->query("update {$dbtbpre}enewssql set sqlname='".$add['sqlname']."',sqltext='".addslashes($add[sqltext])."' where id='$id'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("id=".$id."<br>sqlname=".$add[sqlname]);
		printerror("EditSqlSuccess","ListSql.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R��SQL�y�y
function DelSql($id,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(!$id)
	{
		printerror("EmptySqlid","history.go(-1)");
	}
	$r=$empire->fetch1("select sqlname from {$dbtbpre}enewssql where id='$id'");
	$sql=$empire->query("delete from {$dbtbpre}enewssql where id='$id'");
	if($sql)
	{
		//�ާ@��x
		insert_dolog("id=".$id."<br>sqlname=".$r[sqlname]);
		printerror("DelSqlSuccess","ListSql.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�B��SQL�y�y
function ExecSql($id,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(empty($id))
	{
		printerror('EmptyExecSqlid','');
	}
	$r=$empire->fetch1("select sqltext from {$dbtbpre}enewssql where id='$id'");
	if(!$r['sqltext'])
	{
		printerror('EmptyExecSqlid','');
    }
	$query=RepSqlTbpre($r['sqltext']);
	DoRunQuery($query);
	//�ާ@��x
	insert_dolog("query=".$query);
	printerror("DoExecSqlSuccess","ListSql.php".hReturnEcmsHashStrHref2(1));
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//����SQL�y�y
if($enews=='DoExecSql')
{
	DoExecSql($_POST,$logininid,$loginin);
}
elseif($enews=='AddSql')//�W�[
{
	AddSql($_POST,$logininid,$loginin);
}
elseif($enews=='EditSql')//�ק�
{
	EditSql($_POST,$logininid,$loginin);
}
elseif($enews=='DelSql')//�R��
{
	DelSql($_GET['id'],$logininid,$loginin);
}
elseif($enews=='ExecSql')//����
{
	ExecSql($_GET['id'],$logininid,$loginin);
}

$url="<a href=DoSql.php".$ecms_hashur['whehref'].">����SQL�y�y</a>";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>����SQL�y�y</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td height="25">��m�G
      <?=$url?>
    </td>
    <td width="50%"><div align="right" class="emenubutton"> 
        <input type="button" name="Submit5" value="�W�[SQL�y�y" onclick="self.location.href='AddSql.php?enews=AddSql<?=$ecms_hashur['ehref']?>';">&nbsp;&nbsp;
        <input type="button" name="Submit4" value="�޲zSQL�y�y" onclick="self.location.href='ListSql.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>

<form action="DoSql.php" method="POST" name="sqlform" onsubmit="return confirm('�T�{�n����H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">����SQL�y�y</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">(�h���y�y�Х�&quot;�^��&quot;��},�C���y�y�H&quot;;&quot;�����A�ƾڪ�e��i�ΡG�u[!db.pre!]&quot;���)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <textarea name="query" cols="90" rows="12" id="query"></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <input type="submit" name="Submit" value=" ����SQL">
          &nbsp;&nbsp; 
          <input type="reset" name="Submit2" value="���m">
          <input name="enews" type="hidden" id="enews" value="DoExecSql" onclick="document.sqlform.dosave.value=0;">
          <input name="dosave" type="hidden" id="dosave" value="0">
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">SQL�W�١G 
          <input name="sqlname" type="text" id="sqlname">
          <input type="submit" name="Submit3" value="����SQL�ëO�s" onclick="document.sqlform.dosave.value=1;">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">���\��v�T���Өt�Ϊ��ƾ�,�зV��.</div></td>
    </tr>
  </table>
  </form>
</body>
</html>
