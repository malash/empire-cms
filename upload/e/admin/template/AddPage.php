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
CheckLevel($logininid,$loginin,$classid,"userpage");
$gid=(int)$_GET['gid'];
if(!$gid)
{
	$gid=GetDoTempGid();
}
$cid=ehtmlspecialchars($_GET['cid']);
$enews=ehtmlspecialchars($_GET['enews']);
$r[path]='../../page.html';
$r['tempid']=0;
$url="<a href=ListPage.php".$ecms_hashur['whehref'].">管理自定義頁面</a>&nbsp;>&nbsp;增加自定義頁面";
//複製
if($enews=="AddUserpage"&&$_GET['docopy'])
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select id,title,path,pagetext,classid,pagetitle,pagekeywords,pagedescription,tempid from {$dbtbpre}enewspage where id='$id'");
	$url="<a href=ListPage.php".$ecms_hashur['whehref'].">管理自定義頁面</a>&nbsp;>&nbsp;複製自定義頁面：<b>".$r[title]."</b>";
}
//修改
if($enews=="EditUserpage")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select id,title,path,pagetext,classid,pagetitle,pagekeywords,pagedescription,tempid from {$dbtbpre}enewspage where id='$id'");
	$url="<a href=ListPage.php".$ecms_hashur['whehref'].">管理自定義頁面</a>&nbsp;>&nbsp;修改自定義頁面：<b>".$r[title]."</b>";
}
//模式
$pagemod=1;
if($r['tempid'])
{
	$pagemod=2;
}
if($_GET['ChangePagemod'])
{
	$pagemod=(int)$_GET['ChangePagemod'];
}
//分類
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewspageclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$r[classid])
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
if($pagemod==2)
{
//模板
$pagetempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewspagetemp")." order by tempid");
while($pagetempr=$empire->fetch($pagetempsql))
{
	$select="";
	if($r[tempid]==$pagetempr[tempid])
	{
		$select=" selected";
	}
	$pagetemp.="<option value='".$pagetempr[tempid]."'".$select.">".$pagetempr[tempname]."</option>";
}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>增加用戶自定義頁面</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.pagetext.value=html;
}
</script>
<SCRIPT lanuage="JScript">
<!--
function tempturnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
-->
</SCRIPT>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../ecmscom.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">增加用戶自定義頁面 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="id" type="hidden" id="id" value="<?=$id?>"> 
        <input name="oldpath" type="hidden" id="oldpath" value="<?=$r[path]?>"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> <input name="gid" type="hidden" id="gid" value="<?=$gid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">頁面模式：</td>
      <td height="25"><input type="radio" name="pagemod" value="1" onclick="self.location.href='AddPage.php?enews=<?=$enews?>&id=<?=$id?>&cid=<?=$cid?>&docopy=<?=RepPostStr($_GET['docopy'],1)?>&gid=<?=$gid?>&ChangePagemod=1<?=$ecms_hashur['ehref']?>';"<?=$pagemod==1?' checked':''?>>
        直接頁面式 
        <input type="radio" name="pagemod" value="2" onclick="self.location.href='AddPage.php?enews=<?=$enews?>&id=<?=$id?>&cid=<?=$cid?>&docopy=<?=RepPostStr($_GET['docopy'],1)?>&gid=<?=$gid?>&ChangePagemod=2<?=$ecms_hashur['ehref']?>';"<?=$pagemod==2?' checked':''?>>
        採用模板式</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">頁面名稱(*)</td>
      <td width="81%" height="25"> <input name="title" type="text" id="title" value="<?=$r[title]?>" size="42"> 
        <font color="#666666">(如：聯繫我們)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">文件名(*)</td>
      <td height="25"><input name="path" type="text" id="path" value="<?=$r[path]?>" size="42"> 
        <input type="button" name="Submit4" value="選擇目錄" onclick="window.open('../file/ChangePath.php?returnform=opener.document.form1.path.value<?=$ecms_hashur['ehref']?>','','width=400,height=500,scrollbars=yes');"> 
        <font color="#666666">(如：../../about.html，放於根目錄)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">所屬分類</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">不隸屬於任何類別</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit6222322" value="管理分類" onclick="window.open('PageClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
	<?php
	if($pagemod==2)
	{
	?>
    <tr bgcolor="#FFFFFF">
      <td height="25">使用的模板</td>
      <td height="25"><select name="tempid" id="tempid">
          <?=$pagetemp?>
        </select> 
        <input type="button" name="Submit62223" value="管理自定義頁面模板" onclick="window.open('../template/ListPagetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
	<?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">網頁標題</td>
      <td height="25"><input name="pagetitle" type="text" id="pagetitle" value="<?=ehtmlspecialchars(stripSlashes($r[pagetitle]))?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">網頁關鍵詞</td>
      <td height="25"><input name="pagekeywords" type="text" id="pagekeywords" value="<?=ehtmlspecialchars(stripSlashes($r[pagekeywords]))?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">網頁描述</td>
      <td height="25"><input name="pagedescription" type="text" id="pagedescription" value="<?=ehtmlspecialchars(stripSlashes($r[pagedescription]))?>" size="42"></td>
    </tr>
	<?php
	if($pagemod==2)
	{
		//--------------------html編輯器
		include('../ecmseditor/infoeditor/fckeditor.php');
	?>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><strong>頁面內容</strong>(*)</td>
      <td height="25"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"> 
        <?=ECMS_ShowEditorVar('pagetext',stripSlashes($r[pagetext]),'Default','../ecmseditor/infoeditor/','300','100%')?>
      </td>
    </tr>
	<?php
	}
	else
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><strong>頁面內容</strong>(*)</td>
      <td height="25">請將頁面內容<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.pagetext.value);document.form1.pagetext.select()" title="點擊複製模板內容"><strong>複製到Dreamweaver(推薦)</strong></a>或者使用<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.pagetext.value&returnvar=opener.document.form1.pagetext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>模板在線編輯</strong></a>進行可視化編輯</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><div align="center"> 
          <textarea name="pagetext" cols="90" rows="27" id="pagetext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[pagetext]))?></textarea>
        </div></td>
    </tr>
	<?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
	</form>
	<?php
	if($pagemod!=2)
	{
	?>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(showtempvar);">顯示模板變量說明</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=500,scrollbars=yes,resizable=yes');">查看模板標籤語法</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看JS調用地址</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看公共模板變量</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListBqtemp.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看標籤模板</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield" type="text" value="[!--pagetitle--]">
              : 網頁標題</td>
            <td width="34%"><input name="textfield2" type="text" value="[!--pagekeywords--]">
              : 網頁關鍵詞</td>
            <td width="33%"><input name="textfield3" type="text" value="[!--pagedescription--]">
              : 網頁描述</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield322" type="text" value="[!--pagename--]">
              : 頁面名稱</td>
            <td><input name="textfield3222" type="text" value="[!--pageid--]">
              : 頁面ID</td>
            <td><input name="textfield4" type="text" value="[!--news.url--]">
              : 網站地址</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>支持公共模板變量</strong></td>
            <td><strong>支持所有模板標籤</strong></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
	<?php
	}
	?>
  </table>
</body>
</html>
<?php
db_close();
$empire=null;
?>