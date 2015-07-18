<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>菜單</title>
<link href="../../../data/menu/menu.css" rel="stylesheet" type="text/css">
<script src="../../../data/menu/menu.js" type="text/javascript"></script>
<SCRIPT lanuage="JScript">
function tourl(url){
	parent.main.location.href=url;
}
</SCRIPT>
</head>
<body onLoad="initialize()">
<table border='0' cellspacing='0' cellpadding='0'>
	<tr height=20>
			<td id="home"><img src="../../../data/images/homepage.gif" border=0></td>
			<td><b>其他管理</b></td>
	</tr>
</table>

<table border='0' cellspacing='0' cellpadding='0'>
<?php
if($r[dobefrom]||$r[dowriter]||$r[dokey]||$r[doword])
{
?>
  <tr> 
    <td id="prnewsadmin" class="menu1" onclick="chengstate('newsadmin')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">新聞模型相關</a>
	</td>
  </tr>
  <tr id="itemnewsadmin" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dobefrom])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../NewsSys/BeFrom.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理信息來源</a>
          </td>
        </tr>
		<?php
		}
		if($r[dowriter])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../NewsSys/writer.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理作者</a>
          </td>
        </tr>
		<?php
		}
		if($r[dokey])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../NewsSys/key.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理內容關鍵字</a>
          </td>
        </tr>
		<?php
		}
		if($r[doword])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../NewsSys/word.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理過濾字符</a>
          </td>
        </tr>
		<?php
		}
		?>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dodownurl]||$r[dodeldownrecord]||$r[dodownerror]||$r[dorepdownpath]||$r[doplayer])
{
?>
  <tr> 
    <td id="prdownadmin" class="menu1" onclick="chengstate('downadmin')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">下載模型相關</a>
	</td>
  </tr>
  <tr id="itemdownadmin" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dodownurl])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../DownSys/url.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理地址前綴</a>
          </td>
        </tr>
		<?php
		}
		if($r[dodeldownrecord])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../DownSys/DelDownRecord.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">刪除下載記錄</a>
          </td>
        </tr>
		<?php
		}
		if($r[dodownerror])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../DownSys/ListError.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理錯誤報告</a>
          </td>
        </tr>
		<?php
		}
		if($r[dorepdownpath])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../DownSys/RepDownLevel.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量替換地址權限</a>
          </td>
        </tr>
		<?php
		}
		if($r[doplayer])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../DownSys/player.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">播放器管理</a>
          </td>
        </tr>
		<?php
		}
		?>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dopay])
{
?>
  <tr> 
    <td id="prpay" class="menu1" onclick="chengstate('pay')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">在線支付</a>
	</td>
  </tr>
  <tr id="itempay" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../pay/SetPayFen.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">支付參數配置</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../pay/PayApi.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理支付接口</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../pay/ListPayRecord.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理支付記錄</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dopicnews])
{
?>
  <tr> 
    <td id="prpicnews" class="menu3" onclick="chengstate('picnews')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">圖片信息管理</a>
	</td>
  </tr>
  <tr id="itempicnews" style="display:none"> 
    <td class="list1">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../NewsSys/PicClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理圖片信息分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../NewsSys/ListPicNews.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理圖片信息</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>
</table>
</body>
</html>