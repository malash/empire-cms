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
CheckLevel($logininid,$loginin,$classid,"userjs");
$enews=ehtmlspecialchars($_GET['enews']);
$cid=(int)$_GET['cid'];
$url="<a href=ListUserjs.php".$ecms_hashur['whehref'].">管理用戶自定義JS</a> &gt; 增加自定義JS";
$r[jsfilename]="../../d/js/js/".time().".js";
$r[jssql]="select * from [!db.pre!]ecms_news order by id desc limit 10";
//複製
if($enews=="AddUserjs"&&$_GET['docopy'])
{
	$jsid=(int)$_GET['jsid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsuserjs where jsid='$jsid'");
	$url="<a href=ListUserjs.php".$ecms_hashur['whehref'].">管理用戶自定義JS</a> &gt; 複製自定義JS：<b>".$r[jsname]."</b>";
}
//修改
if($enews=="EditUserjs")
{
	$jsid=(int)$_GET['jsid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsuserjs where jsid='$jsid'");
	$url="<a href=ListUserjs.php".$ecms_hashur['whehref'].">管理用戶自定義JS</a> -&gt; 修改自定義JS：<b>".$r[jsname]."</b>";
}
//js模板
$jstempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsjstemp")." order by tempid");
while($jstempr=$empire->fetch($jstempsql))
{
	$select="";
	if($r[jstempid]==$jstempr[tempid])
	{
		$select=" selected";
	}
	$jstemp.="<option value='".$jstempr[tempid]."'".$select.">".$jstempr[tempname]."</option>";
}
//當前使用的模板組
$thegid=GetDoTempGid();
//分類
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsuserjsclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$r[classid])
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>用戶自定義JS</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListUserjs.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">增加用戶自定義JS 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="jsid" type="hidden" id="jsid" value="<?=$jsid?>"> 
        <input name="oldjsfilename" type="hidden" id="oldjsfilename" value="<?=$r[jsfilename]?>">
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="18%" height="25">JS名稱:</td>
      <td width="82%" height="25"> <input name="jsname" type="text" id="jsname" value="<?=$r[jsname]?>" size="42">      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">所屬分類</td>
      <td height="25"><select name="classid" id="classid">
        <option value="0">不隸屬於任何類別</option>
        <?=$cstr?>
      </select>
        <input type="button" name="Submit6222322" value="管理分類" onclick="window.open('UserjsClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">JS存放地址：</td>
      <td height="25"><input name="jsfilename" type="text" id="jsfilename" value="<?=$r[jsfilename]?>" size="42"> 
        <font color="#666666"> 
        <input type="button" name="Submit4" value="選擇目錄" onclick="window.open('../file/ChangePath.php?<?=$ecms_hashur['ehref']?>&returnform=opener.document.form1.jsfilename.value','','width=400,height=500,scrollbars=yes');">
        (如:<strong>&quot;../../1.js</strong>&quot;表示根目錄下的1.js)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2">查詢SQL語句:</td>
      <td height="25"><input name="jssql" type="text" id="jssql" value="<?=ehtmlspecialchars(stripSlashes($r[jssql]))?>" size="72"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><font color="#666666">(如：select * from phome_ecms_news where 
        classid=1 order by id desc limit 10)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">使用JS模板：</td>
      <td height="25"><select name="jstempid" id="jstempid">
          <?=$jstemp?>
        </select> <input type="button" name="Submit62223" value="管理JS模板" onclick="window.open('../template/ListJstemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">表前綴可用「<strong>[!db.pre!]</strong>」表示</td>
    </tr>
  </table>
</form>
</body>
</html>
