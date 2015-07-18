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
CheckLevel($logininid,$loginin,$classid,"pay");
$r=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");
$url="在線支付&gt; <a href=PayApi.php".$ecms_hashur['whehref'].">管理支付接口</a>&nbsp;>&nbsp;支付參數配置";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>支付參數配置</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置： 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="管理支付記錄" onclick="self.location.href='ListPayRecord.php<?=$ecms_hashur['whehref']?>';">
		&nbsp;&nbsp; 
        <input type="button" name="Submit52" value="管理支付接口" onclick="self.location.href='PayApi.php<?=$ecms_hashur['whehref']?>';">
        </div></td>
  </tr>
</table>
<form name="setpayform" method="post" action="PayApi.php" enctype="multipart/form-data">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">支付參數配置 
        <input name="enews" type="hidden" id="enews" value="SetPayFen"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25"><div align="right">一元可購買：</div></td>
      <td width="77%" height="25"><input name="paymoneytofen" type="text" id="paymoneytofen" value="<?=$r[paymoneytofen]?>" size="35">
        點數</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="right">最小支付金額：</div></td>
      <td height="25"><input name="payminmoney" type="text" id="payminmoney" value="<?=$r[payminmoney]?>" size="35">
        元</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value=" 設 置 "> &nbsp;&nbsp;&nbsp;<input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
