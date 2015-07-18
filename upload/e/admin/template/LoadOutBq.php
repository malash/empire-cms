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
CheckLevel($logininid,$loginin,$classid,"bq");
$mess="<script>alert('請選擇要導出的標籤');window.close();</script>";
$bqid=(int)$_GET['bqid'];
if(empty($bqid))
{
	echo $mess;
	exit();
}
$r=$empire->fetch1("select bqid,bqname,bq from {$dbtbpre}enewsbq where bqid=$bqid");
if(empty($r['bqid']))
{
	echo $mess;
	exit();
}
$url="&nbsp;導出標籤：".$r['bqname'];
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>導出標籤</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="../ecmstemp.php" onsubmit="return confirm('確認要導出？');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">導出標籤 
          <input name="enews" type="hidden" id="enews" value="LoadOutBq">
          <input name="bqid" type="hidden" id="bqid" value="<?=$bqid?>">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="37%"><div align="right">標籤名稱：</div></td>
            <td width="63%" height="27"><b><?php echo $r[bqname]."&nbsp;(".$r[bq].")";?></b></td>
          </tr>
          <tr> 
            <td height="27" colspan="2"> 
              <div align="center">標籤函數內容(e/class/userfun.php)：</div></td>
          </tr>
          <tr> 
            <td colspan="2"><div align="center">
                <textarea name="funvalue" cols="86" rows="16" id="funvalue"></textarea>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="center">
          <input type="submit" name="Submit" value="馬上導出">&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="重置">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
