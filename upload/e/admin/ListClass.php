<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
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
CheckLevel($logininid,$loginin,$classid,"class");

//展開
if($_GET['doopen'])
{
	$open=(int)$_GET['open'];
	SetDisplayClass($open);
}
//圖標
if(getcvar('displayclass',1))
{
	$img="<a href='ListClass.php?doopen=1&open=0".$ecms_hashur['ehref']."' title='展開'><img src='../data/images/displaynoadd.gif' width='15' height='15' border='0'></a>";
}
else
{
	$img="<a href='ListClass.php?doopen=1&open=1".$ecms_hashur['ehref']."' title='收縮'><img src='../data/images/displayadd.gif' width='15' height='15' border='0'></a>";
}
//緩存
$displayclass=(int)getcvar('displayclass',1);
$fcfile="../data/fc/ListClass".$displayclass.".php";
$fclistclass='';
if(file_exists($fcfile))
{
	$fclistclass=str_replace(AddCheckViewTempCode(),'',ReadFiletext($fcfile));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>管理欄目</title>
<link rel="stylesheet" href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" type="text/css">
<SCRIPT lanuage="JScript">
function turnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
var newWindow = null

//調用地址
function tvurl(classid){
	window.open('view/ClassUrl.php?<?=$ecms_hashur['ehref']?>&classid='+classid,'','width=500,height=250');
}
//刷新欄目
function relist(classid){
	self.location.href='enews.php?<?=$ecms_hashur['href']?>&enews=ReListHtml&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?>&classid='+classid;
}
//刷新信息
function renews(classid,tbname){
	window.open('ReHtml/DoRehtml.php?<?=$ecms_hashur['href']?>&enews=ReNewsHtml&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?>&classid='+classid+'&tbname[]='+tbname);
}
//歸檔
function docinfo(classid){
	if(confirm('確認歸檔?'))
	{
		self.location.href='ecmsinfo.php?<?=$ecms_hashur['href']?>&enews=InfoToDoc&ecmsdoc=1&docfrom=ListClass.php<?=urlencode($ecms_hashur['whehref'])?>&classid='+classid;
	}
}
//刷新JS
function rejs(classid){
	self.location.href='ecmschtml.php?<?=$ecms_hashur['href']?>&enews=ReSingleJs&doing=0&classid='+classid;
}
//複製
function copyc(classid){
	self.location.href='AddClass.php?<?=$ecms_hashur['ehref']?>&classid='+classid+'&enews=AddClass&docopy=1';
}
//修改
function editc(classid){
	self.location.href='AddClass.php?<?=$ecms_hashur['ehref']?>&classid='+classid+'&enews=EditClass';
}
//刪除
function delc(classid){
	if(confirm('確認要刪除此欄目，將刪除所屬子欄目及信息'))
	{
		self.location.href='ecmsclass.php?<?=$ecms_hashur['href']?>&classid='+classid+'&enews=DelClass';
	}
}
//標題分類
function ttc(classid){
	window.open('ClassInfoType.php?<?=$ecms_hashur['ehref']?>&classid='+classid);
}
//發佈信息
function addi(classid){
	window.open('AddNews.php?<?=$ecms_hashur['ehref']?>&enews=AddNews&classid='+classid);
}
</SCRIPT>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="18%">位置: <a href="ListClass.php<?=$ecms_hashur['whehref']?>">管理欄目</a></td>
    <td width="82%"> <div align="right" class="emenubutton">
        <input type="button" name="Submit6" value="增加欄目" onclick="self.location.href='AddClass.php?enews=AddClass<?=$ecms_hashur['ehref']?>'">
        <input type="button" name="Submit" value="刷新首頁" onclick="self.location.href='ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>'">
        <input type="button" name="Submit2" value="刷新所有欄目頁" onclick="window.open('ecmschtml.php?enews=ReListHtml_all&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');">
        <input type="button" name="Submit3" value="刷新所有信息頁面" onclick="window.open('ReHtml/DoRehtml.php?enews=ReNewsHtml&start=0&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');">
        <input type="button" name="Submit4" value="刷新所有JS調用" onclick="window.open('ecmschtml.php?enews=ReAllNewsJs&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <form name=editorder method=post action=ecmsclass.php onsubmit="return confirm('確認要操作?');">
  <?=$ecms_hashur['form']?>
    <tr class="header" height="25"> 
      <td width="5%" align="center">順序</td>
      <td width="7%" align="center"><?=$img?></td>
      <td width="6%" align="center">ID</td>
      <td width="36%">欄目名</td>
      <td width="6%" align="center">訪問</td>
      <td width="14%">欄目管理</td>
      <td width="29%">操作</td>
    </tr>
    <?php
	echo $fclistclass;
	?>
    <tr class="header"> 
      <td height="25" colspan="7"> <div align="left"> &nbsp;&nbsp;
          <input type="submit" name="Submit5" value="修改欄目順序" onClick="document.editorder.enews.value='EditClassOrder';document.editorder.action='ecmsclass.php';">&nbsp;&nbsp;
          <input name="enews" type="hidden" id="enews" value="EditClassOrder">
          <input type="submit" name="Submit7" value="刷新欄目頁面" onClick="document.editorder.enews.value='GoReListHtmlMoreA';document.editorder.action='ecmschtml.php';">&nbsp;&nbsp;
          <input type="submit" name="Submit72" value="終極欄目屬性轉換" onClick="document.editorder.enews.value='ChangeClassIslast';document.editorder.action='ecmsclass.php';">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7"><strong>終極欄目屬性轉換說明(只能選擇單個欄目)：</strong><br>
        如果你選擇的是<font color="#FF0000">非終極欄目</font>，則轉為<font color="#FF0000">終極欄目</font><font color="#666666">(此欄目不能有子欄目)</font><br>
        如果你選擇的是<font color="#FF0000">終極欄目</font>，則轉為<font color="#FF0000">非終極欄目</font><font color="#666666">(請先把當前欄目的數據轉移，否則會出現冗餘數據)<br>
        </font><strong>修改欄目順序:順序值越小越前面</strong></td>
    </tr>
    <input name="from" type="hidden" value="ListClass.php<?=$ecms_hashur['whehref']?>">
    <input name="gore" type="hidden" value="0">
  </form>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="13%" height="25"> 
      <div align="center">名稱</div></td>
    <td width="39%" height="25">調用地址</td>
    <td width="13%">
<div align="center">名稱</div></td>
    <td width="35%"> 
      <div align="center">調用地址</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"><div align="center">熱門信息調用</div></td>
    <td height="25" bgcolor="#FFFFFF"> <input name="textfield" type="text" value="<?=$public_r[newsurl]?>d/js/js/hotnews.js">
      [<a href="ecmschtml.php?enews=ReHot_NewNews<?=$ecms_hashur['href']?>">刷新</a>][<a href="view/js.php?js=hotnews&p=js<?=$ecms_hashur['ehref']?>" target="_blank">預覽</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center">橫向搜索表單</div></td>
    <td bgcolor="#FFFFFF"> <div align="left"> 
        <input name="textfield3" type="text" value="<?=$public_r[newsurl]?>d/js/js/search_news1.js">
        [<a href="view/js.php?js=search_news1&p=js<?=$ecms_hashur['ehref']?>" target="_blank">預覽</a>]</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"> <div align="center">最新信息調用</div></td>
    <td height="25" bgcolor="#FFFFFF"> <input name="textfield2" type="text" value="<?=$public_r[newsurl]?>d/js/js/newnews.js">
      [<a href="ecmschtml.php?enews=ReHot_NewNews<?=$ecms_hashur['href']?>">刷新</a>][<a href="view/js.php?js=newnews&p=js<?=$ecms_hashur['ehref']?>" target="_blank">預覽</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center">縱向搜索表單</div></td>
    <td bgcolor="#FFFFFF"> <div align="left"> 
        <input name="textfield4" type="text" value="<?=$public_r[newsurl]?>d/js/js/search_news2.js">
        [<a href="view/js.php?js=search_news2&p=js<?=$ecms_hashur['ehref']?>" target="_blank">預覽</a>]</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"><div align="center">推薦信息調用</div></td>
    <td height="25" bgcolor="#FFFFFF"><input name="textfield22" type="text" value="<?=$public_r[newsurl]?>d/js/js/goodnews.js">
      [<a href="ecmschtml.php?enews=ReHot_NewNews<?=$ecms_hashur['href']?>">刷新</a>][<a href="view/js.php?js=goodnews&p=js<?=$ecms_hashur['ehref']?>" target="_blank">預覽</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center">搜索頁面地址</div></td>
    <td bgcolor="#FFFFFF"> <div align="left"> 
        <input name="textfield5" type="text" value="<?=$public_r[newsurl]?>search">
        [<a href="../../search" target="_blank">預覽</a>]</div></td>
  </tr>
  <tr> 
    <td height="24" bgcolor="#FFFFFF"> 
      <div align="center">控制面板地址</div></td>
    <td height="24" bgcolor="#FFFFFF">
<input name="textfield52" type="text" value="<?=$public_r[newsurl]?>e/member/cp">
      [<a href="../member/cp" target="_blank">預覽</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center"></div></td>
    <td bgcolor="#FFFFFF"><div align="center"></div></td>
  </tr>
  <tr class="header"> 
    <td height="25" colspan="4">js調用方式：&lt;script src=js地址&gt;&lt;/script&gt;</td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
