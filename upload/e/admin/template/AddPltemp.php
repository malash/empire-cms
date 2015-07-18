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
$gid=(int)$_GET['gid'];
$gname=CheckTempGroup($gid);
$urlgname=$gname."&nbsp;>&nbsp;";
$enews=ehtmlspecialchars($_GET['enews']);
$url=$urlgname."<a href=ListPltemp.php?gid=$gid".$ecms_hashur['ehref'].">管理評論模板</a>&nbsp;>&nbsp;增加評論模板";
//複製
if($enews=="AddPlTemp"&&$_GET['docopy'])
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempid,tempname,temptext from ".GetDoTemptb("enewspltemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListPltemp.php?gid=$gid".$ecms_hashur['ehref'].">管理評論模板</a>&nbsp;>&nbsp;複製評論模板：<b>".$r[tempname]."</b>";
}
//修改
if($enews=="EditPlTemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempid,tempname,temptext from ".GetDoTemptb("enewspltemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListPltemp.php?gid=$gid".$ecms_hashur['ehref'].">管理評論模板</a>&nbsp;>&nbsp;修改評論模板：<b>".$r[tempname]."</b>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>增加評論模板</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
<script>
function ReTempBak(){
	self.location.reload();
}
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="ListPltemp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">增加評論模板 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>"> 
        <input name="gid" type="hidden" id="gid" value="<?=$gid?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">模板名稱</td>
      <td width="81%" height="25"> <input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>模板內容</strong>(*)</td>
      <td height="25">請將模板內容<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.temptext.value);document.form1.temptext.select()" title="點擊複製模板內容"><strong>複製到Dreamweaver(推薦)</strong></a>或者使用<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.temptext.value&returnvar=opener.document.form1.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>模板在線編輯</strong></a>進行可視化編輯</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="temptext" cols="90" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[temptext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置">
        <?php
		if($enews=='EditPlTemp')
		{
		?>
        &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pltemp&tempid=<?=$tempid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">修改記錄</a>] 
        <?php
		}
		?>
      </td>
    </tr>
	</form>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(showtempvar);">顯示模板變量說明</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看JS調用地址</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看公共模板變量</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"><strong>1、整體頁面支持的變量</strong><br> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield3" type="text" value="[!--newsnav--]">
              :所在位置導航條</td>
            <td width="34%"><input name="textfield72" type="text" value="[!--pagekey--]">
              :頁面關鍵字 </td>
            <td width="33%"><input name="textfield73" type="text" value="[!--pagedes--]">
              :頁面描述 </td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield92" type="text" value="[!--class.menu--]">
              :一級欄目導航</td>
            <td><input name="textfield4" type="text" value="[!--titleurl--]">
              :信息鏈接</td>
            <td><input name="textfield5" type="text" value="[!--title--]">
              :信息標題</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield6" type="text" value="[!--classid--]">
              :欄目ID</td>
            <td><input name="textfield7" type="text" value="[!--id--]">
              :信息ID</td>
            <td><input name="textfield8" type="text" value="[!--pinfopfen--]">
              :信息平均評分</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield9" type="text" value="[!--infopfennum--]">
              :總評分人數</td>
            <td><input name="textfield10" type="text" value="[!--news.url--]">
              :網站地址</td>
            <td><input name="textfield11" type="text" value="[!--key.url--]">
              :發表評論驗證碼地址</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield12" type="text" value="[!--lusername--]">
              :登陸會員帳號</td>
            <td><input name="textfield13" type="text" value="[!--lpassword--]">
              :登陸用戶密碼(加密過)</td>
            <td><input name="textfield14" type="text" value="[!--listpage--]">
              :分頁導航</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield15" type="text" value="[!--plnum--]">
              :總記錄數</td>
            <td><input name="textfield16" type="text" value="[!--hotnews--]">
              :熱門信息JS調用(默認表)</td>
            <td><input name="textfield17" type="text" value="[!--newnews--]">
              :最新信息JS調用(默認表)</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield18" type="text" value="[!--goodnews--]">
              :推薦信息JS調用(默認表)</td>
            <td><input name="textfield19" type="text" value="[!--hotplnews--]">
              :評論熱門信息JS調用(默認表)</td>
            <td><input name="textfield182" type="text" value="&lt;script src=&quot;[!--news.url--]d/js/js/plface.js&quot;&gt;&lt;/script&gt;">
:評論表情選擇調用</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><strong>支持公共模板變量</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <br> <strong>2、列表內容支持的變量</strong><br> <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield20" type="text" value="[!--plid--]">
              :評論ID</td>
            <td width="34%"> <input name="textfield21" type="text" value="[!--pltext--]">
              :評論內容</td>
            <td width="33%"> <input name="textfield22" type="text" value="[!--pltime--]">
              :評論發表時間</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield23" type="text" value="[!--plip--]">
              :評論發表者IP</td>
            <td><input name="textfield24" type="text" value="[!--username--]">
              :發表者</td>
            <td><input name="textfield252" type="text" value="[!--userid--]">
              :發表者ID</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield26" type="text" value="[!--zcnum--]">
              :支持數</td>
            <td><input name="textfield27" type="text" value="[!--fdnum--]">
              :反對數</td>
            <td><input name="textfield28" type="text" value="[!--classid--]">
              :欄目ID</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield29" type="text" value="[!--id--]">
              :信息ID</td>
            <td><input name="textfield25" type="text" value="[!--includelink--]">
              :引用評論鏈接地址</td>
            <td><strong>[!--字段名--]:自定義字段內容調用</strong></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">模板格式:</td>
      <td height="25">列表頭[!--empirenews.listtemp--]列表內容[!--empirenews.listtemp--]列表尾</td>
    </tr>
  </table>
</body>
</html>
