<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
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
CheckLevel($logininid,$loginin,$classid,"movenews");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=MoveClassNews.php".$ecms_hashur['whehref'].">批量轉移信息</a>";
//--------------------操作的欄目
$fcfile="../data/fc/ListEnews.php";
$do_class="<script src=../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$do_class=ShowClass_AddClass("","n",0,"|-",0,0);}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>轉移信息</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="ecmsinfo.php" onsubmit="return confirm('確認要執行此操作？');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">批量轉移欄目信息</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">將 
          <select name="add[classid]" id="add[classid]">
            <option value=0>請選擇原信息欄目</option><?=$do_class?>
          </select>
          的信息轉移到 
          <select name="add[toclassid]" id="add[toclassid]">
            <option value=0>請選擇目標信息欄目</option><?=$do_class?>
          </select>
          欄目 
          <input type="submit" name="Submit" value="轉移">
          <input name="enews" type="hidden" id="enews" value="MoveClassNews">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
