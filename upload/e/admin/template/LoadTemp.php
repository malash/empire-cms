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
CheckLevel($logininid,$loginin,$classid,"template");
$url="<a href=LoadTemp.php".$ecms_hashur['whehref'].">批量導入欄目模板</a>";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>批量導入欄目模板</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="../ecmstemp.php" onsubmit="return confirm('確認要導入？');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">批量導入欄目模板 
          <input name="enews" type="hidden" id="enews" value="LoadTempInClass">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center"><br>
          <input type="submit" name="Submit" value="開始導入模板">
          <br>
          <br>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="center">(說明：非終極欄目有效，請將要導入的模板上傳至：<a href="ShowLoadTempPath.php<?=$ecms_hashur['whehref']?>" target="_blank"><strong>/e/data/LoadTemp</strong></a>,然後點擊導入模板．<br>
          模板文件命名形式：<strong><font color="#FF0000">欄目ID.htm</font></strong> ,系統會搜索相應的&quot;ID文件&quot;進行導入．)</div></td>
    </tr>
  </table>
</form>
</body>
</html>
