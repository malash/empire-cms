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
CheckLevel($logininid,$loginin,$classid,"postdata");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>遠程發佈</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href="PostUrlData.php<?=$ecms_hashur['whehref']?>">遠程發佈</a></td>
  </tr>
</table>
<form name="form1" method="post" action="enews.php" onsubmit="return confirm('確認要發佈？');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="2">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="6%" height="25"> <div align="center"></div></td>
      <td width="49%" height="25">任務</td>
      <td width="45%" height="25">說明</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"></div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>附件包 (/d)</strong></td>
      <td height="25" bgcolor="#DBEAF5">存放附件目錄</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="d/file!!!0">
        </div></td>
      <td height="25">上傳附件包 (/d/file)</td>
      <td height="25">系統上傳的附件存放目錄</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="d/js!!!0">
        </div></td>
      <td height="25">公共JS包 (/d/js)</td>
      <td height="25">共公JS包括廣告JS,投票JS,圖片信息JS,總排行/最新JS等</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="s!!!0">
        </div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>專題包 (/s)</strong></td>
      <td height="25" bgcolor="#DBEAF5">專題存放目錄</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"></div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>系統動態包[與數據庫相關] (/e)</strong></td>
      <td height="25" bgcolor="#DBEAF5">與數據庫打交道的包</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]3" value="search!!!0">
        </div></td>
      <td height="25">信息搜索表單包 (/search)</td>
      <td height="25">信息搜索表單</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]5" value="e/pl!!!0">
        </div></td>
      <td height="25">信息評論包 (/e/pl)</td>
      <td height="25">信息評論頁面</td>
    </tr>
    <tr> 
      <td height="25"><div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="e/DoPrint!!!0">
        </div></td>
      <td height="25">信息打印包(/e/DoPrint)</td>
      <td height="25">信息打印頁面</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]6" value="e/data/template!!!0">
        </div></td>
      <td height="25">會員控制面板模板包 (/e/data/template)</td>
      <td height="25">會員控制面板模板</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]7" value="e/config/config.php,e/data/dbcache/class.php,e/data/dbcache/class1.php,e/data/dbcache/ztclass.php,e/data/dbcache/MemberLevel.php!!!1">
        </div></td>
      <td height="25">緩存包 (/e/config/config.php,e/data/dbcache/class.php)</td>
      <td height="25">系統設置的一些參數緩存</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"></div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>站點目錄包 (/)</strong></td>
      <td height="25" bgcolor="#DBEAF5">信息欄目存放目錄</td>
    </tr>
    <?php
	$sql=$empire->query("select classid,classurl,classname,classpath from {$dbtbpre}enewsclass where bclassid=0 order by classid desc");
	while($r=$empire->fetch($sql))
	{
	if($r[classurl])
	{
	$classurl=$r[classurl];
	}
	else
	{
	$classurl="../../".$r[classpath];
	}
	?>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]10" value="<?=$r[classpath]?>!!!0">
        </div></td>
      <td height="25"><a href='<?=$classurl?>' target=_blank> 
        <?=$r[classname]?>
        </a>&nbsp;(/ 
        <?=$r[classpath]?>
        )</td>
      <td height="25"> 
        <?=$r[classurl]?>
      </td>
    </tr>
    <?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="index<?=$public_r[indextype]?>!!!1">
        </div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>首頁 (/index 
        <?=$public_r[indextype]?>
        )</strong></td>
      <td height="25" bgcolor="#DBEAF5">網站首頁</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
        </div></td>
      <td height="25"> <input type="submit" name="Submit" value="開始發佈"> &nbsp;&nbsp; 
        <input type="button" name="Submit2" value="設置FTP參數" onclick="javascript:window.open('SetEnews.php<?=$ecms_hashur['whehref']?>');"> 
        <input name="enews" type="hidden" id="enews" value="AddPostUrlData"></td>
      <td height="25">每 <input name="line" type="text" id="line" value="10" size="6">
        個項目為一組</td>
    </tr>
    <tr> 
      <td height="25" colspan="3"><div align="left">(備註：遠程發佈所發費的時間較長，請耐心等待.最好將程序運行時間設為最長)</div></td>
    </tr>
  </table>
  <br>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
