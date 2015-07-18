<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<title><?=defined('empirecms')?$public_diyr[pagetitle]:'用戶控制面板'?> - Powered by EmpireCMS</title>
<meta name="keywords" content="<?=defined('empirecms')?$public_diyr[pagetitle]:'用戶控制面板'?>" />
<meta name="description" content="<?=defined('empirecms')?$public_diyr[pagetitle]:'用戶控制面板'?>" />
<link href="/ecms72/skin/default/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/ecms72/skin/default/js/tabs.js"></script>
</head>
<body class="listpage">
<!-- 頁頭 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="top">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="63%">
<!-- 登錄 -->
<script>
document.write('<script src="/ecms72/e/member/login/loginjs.php?t='+Math.random()+'"><'+'/script>');
</script>
</td>
<td align="right">
<a onclick="window.external.addFavorite(location.href,document.title)" href="#ecms">加入收藏</a> | <a onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('/ecms72/')" href="#ecms">設為首頁</a> | <a href="/ecms72/e/member/cp/">會員中心</a> | <a href="/ecms72/e/DoInfo/">我要投稿</a> | <a href="/ecms72/e/web/?type=rss2" target="_blank">RSS<img src="/ecms72/skin/default/images/rss.gif" border="0" hspace="2" /></a>
</td>
</tr>
</table></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="10">
<tr valign="middle">
<td width="240" align="center"><a href="/ecms72/"><img src="/ecms72/skin/default/images/logo.gif" width="200" height="65" border="0" /></a></td>
<td align="center"><a href="http://www.phome.net/OpenSource/" target="_blank"><img src="/ecms72/skin/default/images/opensource.gif" width="100%" height="70" border="0" /></a></td>
</tr>
</table>
<!-- 導航tab選項卡 -->
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="nav">
  <tr> 
    <td class="nav_global"><ul>
        <li class="curr" id="tabnav_btn_0" onmouseover="tabit(this)"><a href="/ecms72/">首頁</a></li>
        <li id="tabnav_btn_1" onmouseover="tabit(this)"><a href="/ecms72/news/">新聞中心</a></li>
        <li id="tabnav_btn_2" onmouseover="tabit(this)"><a href="/ecms72/download/">下載中心</a></li>
        <li id="tabnav_btn_3" onmouseover="tabit(this)"><a href="/ecms72/movie/">影視頻道</a></li>
        <li id="tabnav_btn_4" onmouseover="tabit(this)"><a href="/ecms72/shop/">網上商城</a></li>
        <li id="tabnav_btn_5" onmouseover="tabit(this)"><a href="/ecms72/flash/">FLASH頻道</a></li>
        <li id="tabnav_btn_6" onmouseover="tabit(this)"><a href="/ecms72/photo/">圖片頻道</a></li>
        <li id="tabnav_btn_7" onmouseover="tabit(this)"><a href="/ecms72/article/">文章中心</a></li>
        <li id="tabnav_btn_8" onmouseover="tabit(this)"><a href="/ecms72/info/">分類信息</a></li>
      </ul></td>
  </tr>
</table> 
<table width="100%" border="0" cellspacing="10" cellpadding="0">
<tr valign="top">
<td class="list_content"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="position">
<tr>
<td>現在的位置：<?=$url?>
</td>
</tr>
</table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="box">
        <tr> 
          <td width="300" valign="top"> 
		  <?php
		  $lguserid=intval(getcvar('mluserid'));//登陸用戶ID
		  $lgusername=RepPostVar(getcvar('mlusername'));//登陸用戶
		  $lggroupid=intval(getcvar('mlgroupid'));//會員組ID
		  if($lggroupid)	//登陸會員顯示菜單
		  {
		  ?>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
              <tr class="header"> 
                <td height="20" bgcolor="#FFFFFF"> <div align="center"><strong><a href="/ecms72/e/member/cp/">功能菜單</a></strong></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/EditInfo/">修改資料</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/my/">帳號狀態</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/msg/">站內信息</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/mspace/SetSpace.php">空間設置</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/DoInfo/">管理信息</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/fava/">收藏夾</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/payapi/">在線支付</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/friend/">我的好友</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/buybak/">消費記錄</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/buygroup/">在線充值</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/card/">點卡充值</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="#ecms" onclick="window.open('/ecms72/e/ShopSys/buycar/','','width=680,height=500,scrollbars=yes,resizable=yes');">我的購物車</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/ShopSys/ListDd/">我的訂單</a></div></td>
              </tr>
			  <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/login/">重新登陸</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/doaction.php?enews=exit" onclick="return confirm('確認要退出?');">退出登陸</a></div></td>
              </tr>
            </table>
			<?php
			}
			else	//遊客顯示菜單
			{
			?>  
            <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
              <tr class="header"> 
                <td height="20" bgcolor="#FFFFFF"> <div align="center"><strong><a href="/ecms72/e/member/cp/">功能菜單</a></strong></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/login/">會員登陸</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/register/">註冊帳號</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/DoInfo/">發佈投稿</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="#ecms" onclick="window.open('/ecms72/e/ShopSys/buycar/','','width=680,height=500,scrollbars=yes,resizable=yes');">我的購物車</a></div></td>
              </tr>
            </table>
			<?php
			}
			?>
			</td>
          <td width="85%" valign="top">