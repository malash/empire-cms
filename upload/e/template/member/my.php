<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='帳號狀態';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;帳號狀態";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br> 
<table width="50%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="2">帳號狀態</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">用戶ID:</td>
    <td height="25"> 
      <?=$user[userid]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">用戶名:</td>
    <td height="25"> 
      <?=$user[username]?>
      &nbsp;&nbsp;(<a href="../../space/?userid=<?=$user[userid]?>" target="_blank">我的會員空間</a>) 
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="33%" height="25">註冊時間:</td>
    <td width="67%" height="25"> 
      <?=$registertime?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">會員等級:</td>
    <td height="25"> 
      <?=$level_r[$r[groupid]][groupname]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">剩餘有效期:</td>
    <td height="25"> 
      <?=$userdate?>
      天 </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">剩餘點數:</td>
    <td height="25"> 
      <?=$r[userfen]?>
      點</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">帳戶餘額:</td>
    <td height="25"> 
      <?=$r[money]?>
      元 </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">新短消息:</td>
    <td height="25">
      <?=$havemsg?>
    </td>
  </tr>
</table>
<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>