<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//驗證權限
CheckLevel($logininid,$loginin,$classid,"f");
$fid=(int)$_GET['fid'];
$tid=(int)$_GET['tid'];
$tbname=RepPostVar($_GET['tbname']);
if(!$fid||!$tid||!$tbname)
{
	printerror("ErrorUrl","history.go(-1)");
}
$fr=$empire->fetch1("select fid,f,fname,isadd,tid,tbname,tbdataf from {$dbtbpre}enewsf where fid='$fid'");
if(!$fr[fid])
{
	printerror("ErrorUrl","history.go(-1)");
}
if(empty($fr[isadd]))
{
	printerror("NotIsAdd","history.go(-1)");
}
$tid=$fr[tid];
$tbname=$fr[tbname];
if($fr[tbdataf])
{
	$doing='字段轉移到主表';
}
else
{
	$doing='字段轉移到副表';
}
$url="數據表:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListF.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">字段管理</a>&nbsp;>&nbsp;".$doing;
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>轉移字段</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置： 
      <?=$url?>
    </td>
  </tr>
</table>
<form action="../ecmsmod.php" method="GET" enctype="multipart/form-data" name="form1" onsubmit="return confirm('確認要轉移?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header"> 
        <?=$doing?>
      </td>
    </tr>
    <tr> 
      <td width="28%" height="25" bgcolor="#FFFFFF">數據表:</td>
      <td width="72%" height="25" bgcolor="#FFFFFF"> <strong> 
        <?=$dbtbpre?>
        ecms_ 
        <?=$tbname?>
        </strong></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">字段名:</td>
      <td height="25" bgcolor="#FFFFFF"><strong> 
        <?=$fr[f]?>
        </strong>&nbsp;( 
        <?=$fr[fname]?>
        )</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每組轉換數量:</td>
      <td height="25" bgcolor="#FFFFFF"><input name="line" type="text" id="line" value="200"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="開始轉移"> 
        <input name="enews" type="hidden" id="enews" value="ChangeDataTableF"> 
        <input name="tid" type="hidden" id="tid" value="<?=$tid?>"> <input name="tbname" type="hidden" id="tbname" value="<?=$tbname?>"> 
        <input name="fid" type="hidden" id="fid" value="<?=$fid?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#666666">說明：轉換前建議先備份數據。</font></td>
    </tr>
  </table>
</form>
</body>
</html>
