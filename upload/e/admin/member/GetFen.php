<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
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
CheckLevel($logininid,$loginin,$classid,"card");
$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="GetFen")
{
	include('../../member/class/member_adminfun.php');
	$cardfen=$_POST['cardfen'];
	GetFen_all($cardfen,$logininid,$loginin);
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>批量贈送點數</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置: <a href="GetFen.php<?=$ecms_hashur['whehref']?>">批量贈送點數</a></td>
  </tr>
</table>
<form name="form1" method="post" action="GetFen.php">
  <table width="60%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">批量增加點數 
          <input name="enews" type="hidden" id="enews" value="GetFen">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">請輸入點數： 
          <input name="cardfen" type="text" id="cardfen" value="0" size="6">
          點 
          <input type="submit" name="Submit" value="批量增加">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
