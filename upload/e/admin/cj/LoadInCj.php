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
CheckLevel($logininid,$loginin,$classid,"loadcj");
$from=(int)$_GET['from'];
if($from)
{
	$listclasslink="ListPageInfoClass.php";
}
else
{
	$listclasslink="ListInfoClass.php";
}
$url="<a href=../".$listclasslink.$ecms_hashur['whehref'].">管理採集</a>&nbsp;>&nbsp;導入採集規則";
//--------------------操作的欄目
$fcfile="../../data/fc/ListEnews.php";
$do_class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$do_class=ShowClass_AddClass("","n",0,"|-",0,0);}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>導入採集規則</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>
<form action="../ecmscj.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('確認要導入？');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center">導入採集規則 
          <input name="enews" type="hidden" id="enews" value="LoadInCj">
		  <?=$ecms_hashur['form']?>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="650" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="29%"><div align="right">選擇採集入庫的欄目：</div></td>
            <td width="71%" height="27"><select name="classid" id="classid">
            <option value='0'>選擇欄目</option>
            <?=$do_class?>
          </select> 
              <font color="#666666">(要選擇終極欄目)</font></td>
          </tr>
          <tr> 
            <td height="27"> <div align="right">導入採集規則文件：</div></td>
            <td height="27"><input type="file" name="file">
              <font color="#666666">(*.cj)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="center">
          <input type="submit" name="Submit" value="馬上導入">
          &nbsp;&nbsp;
          <input type="reset" name="Submit2" value="重置">
		  <input type="hidden" name="from" value="<?=$from?>">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>