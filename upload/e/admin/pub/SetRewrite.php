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
CheckLevel($logininid,$loginin,$classid,"public");

//設置偽靜態參數
function SetRewrite($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"public");//驗證權限
	$sql=$empire->query("update {$dbtbpre}enewspublic set rewriteinfo='".eaddslashes($add[rewriteinfo])."',rewriteclass='".eaddslashes($add[rewriteclass])."',rewriteinfotype='".eaddslashes($add[rewriteinfotype])."',rewritetags='".eaddslashes($add[rewritetags])."',rewritepl='".eaddslashes($add[rewritepl])."' limit 1");
	if($sql)
	{
		GetConfig();
		//操作日誌
		insert_dolog("");
		printerror("SetRewriteSuccess","SetRewrite.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="SetRewrite")//設置偽靜態參數
{
	SetRewrite($_POST,$logininid,$loginin);
}

$r=$empire->fetch1("select rewriteinfo,rewriteclass,rewriteinfotype,rewritetags,rewritepl from {$dbtbpre}enewspublic limit 1");
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>設置偽靜態</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><p>位置：<a href="SetRewrite.php<?=$ecms_hashur['whehref']?>">偽靜態設置</a></p>
    </td>
  </tr>
</table>
<form name="setpublic" method="post" action="SetRewrite.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="4">偽靜態參數設置 
        <input name="enews" type="hidden" value="SetRewrite"></td>
    </tr>
    <tr>
      <td width="135" height="25">頁面</td>
      <td width="302" height="25">標記</td>
      <td width="554">格式</td>
      <td width="323">對應頁面</td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td height="25">信息內容頁</td>
      <td height="25">[!--classid--],[!--id--],[!--page--]</td>
      <td>/
        <input name="rewriteinfo" type="text" id="rewriteinfo" value="<?=$r[rewriteinfo]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewriteinfo.value='showinfo-[!--classid--]-[!--id--]-[!--page--].html';">默認</a>]</td>
      <td>/e/action/ShowInfo.php?classid=欄目ID&amp;id=信息ID&amp;page=分頁號</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">信息列表頁</td>
      <td height="25">[!--classid--],[!--page--]</td>
      <td>/
        <input name="rewriteclass" type="text" id="rewriteclass" value="<?=$r[rewriteclass]?>" size="55">
      [<a href="#empirecms" onclick="document.setpublic.rewriteclass.value='listinfo-[!--classid--]-[!--page--].html';">默認</a>]</td>
      <td>/e/action/ListInfo/index.php?classid=欄目ID&amp;page=分頁號</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">標題分類列表頁</td>
      <td height="25">[!--ttid--],[!--page--]</td>
      <td>/
        <input name="rewriteinfotype" type="text" id="rewriteinfotype" value="<?=$r[rewriteinfotype]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewriteinfotype.value='infotype-[!--ttid--]-[!--page--].html';">默認</a>]</td>
      <td>/e/action/InfoType/index.php?ttid=標題分類ID&amp;page=分頁號</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">TAGS信息列表頁</td>
      <td height="25">[!--tagname--],[!--page--]</td>
      <td>/
        <input name="rewritetags" type="text" id="rewritetags" value="<?=$r[rewritetags]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewritetags.value='tags-[!--tagname--]-[!--page--].html';">默認</a>]</td>
      <td>/e/tags/index.php?tagname=TAGS名稱&amp;page=分頁號</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">評論列表頁</td>
      <td height="25">[!--doaction--],[!--classid--],[!--id--],<br>
      [!--page--],[!--myorder--],[!--tempid--]</td>
      <td>/
        <input name="rewritepl" type="text" id="rewritepl" value="<?=$r[rewritepl]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewritepl.value='comment-[!--doaction--]-[!--classid--]-[!--id--]-[!--page--]-[!--myorder--]-[!--tempid--].html';">默認</a>]</td>
      <td>/e/pl/index.php?doaction=事件&amp;classid=欄目ID&amp;id=信息ID&amp;page=分頁號&amp;myorder=排序&amp;tempid=評論模板ID</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25" colspan="3"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td height="25" colspan="4">說明：採用靜態頁面時不需要設置，只有當採用動態頁面時可通過設置偽靜態來提高SEO優化，如果不啟用請留空。注意：偽靜態會增加服務器負擔，修改偽靜態格式後你需要修改服務器的 Rewrite 規則設置。</td>
    </tr>
  </table>
</form>
</body>
</html>
