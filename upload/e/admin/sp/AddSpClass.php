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
CheckLevel($logininid,$loginin,$classid,"sp");
$enews=ehtmlspecialchars($_GET['enews']);
$postword='增加碎片分類';
$url="<a href=ListSp.php".$ecms_hashur['whehref'].">管理碎片</a>&nbsp;>&nbsp;<a href=ListSpClass.php".$ecms_hashur['whehref'].">管理碎片分類</a>&nbsp;>&nbsp;增加碎片分類";
//修改
if($enews=="EditSpClass")
{
	$postword='修改碎片分類';
	$classid=(int)$_GET['classid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsspclass where classid='$classid'");
	$url="<a href=ListSp.php".$ecms_hashur['whehref'].">管理碎片</a>&nbsp;>&nbsp;<a href=ListSpClass.php".$ecms_hashur['whehref'].">管理碎片分類</a>&nbsp;>&nbsp;修改碎片分類：".$r[classname];
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>碎片分類</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListSpClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><?=$postword?></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">分類名稱：</td>
      <td width="79%" height="25"><input name="classname" type="text" id="classname" size="42" value="<?=$r[classname]?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="classid" type="hidden" id="classid" value="<?=$r[classid]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">分類說明：</td>
      <td height="25"><textarea name="classsay" cols="60" rows="5" id="classsay"><?=ehtmlspecialchars($r[classsay])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
