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

$enews=RepPostStr($_GET['enews'],1);
if(empty($enews))
{
	$enews='AddSql';
}
$url="<a href='ListSql.php".$ecms_hashur['whehref']."'>�޲zSQL�y�y</a>&nbsp;>&nbsp;�W�[SQL�y�y";
$postword='�W�[SQL�y�y';
if($enews=='EditSql')
{
	$id=intval($_GET['id']);
	$r=$empire->fetch1("select * from {$dbtbpre}enewssql where id='$id'");
	$url="<a href='ListSql.php".$ecms_hashur['whehref']."'>�޲zSQL�y�y</a>&nbsp;>&nbsp;�ק�SQL�y�y: <b>".$r[sqlname]."</b>";
	$postword='�ק�SQL�y�y';
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title><?=$postword?></title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form action="DoSql.php" method="POST" name="sqlform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center"><?=$postword?></div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">(�h���y�y�Х�&quot;�^��&quot;��},�C���y�y�H&quot;;&quot;�����A�ƾڪ�e��i�ΡG�u[!db.pre!]&quot;���)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <textarea name="sqltext" cols="90" rows="12" id="sqltext"><?=ehtmlspecialchars($r[sqltext])?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">SQL�W�١G 
          <input name="sqlname" type="text" id="sqlname" value="<?=$r[sqlname]?>">
          <input type="submit" name="Submit3" value="�O�s">
          &nbsp;<input type="reset" name="Submit2" value="���m">
          <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
          <input name="id" type="hidden" id="id" value="<?=$id?>">
        </div></td>
    </tr>
  </table>
  </form>
</body>
</html>
