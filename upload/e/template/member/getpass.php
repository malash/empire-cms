<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='取回密碼';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;取回密碼";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="GetPassForm" method="POST" action="../doaction.php">
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">重設密碼</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">用戶名</td>
      <td width="77%"><?=$username?></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">新密碼</td>
      <td><input name="newpassword" type="password" id="newpassword" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">重複新密碼</td>
      <td><input name="renewpassword" type="password" id="renewpassword" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp; </td>
      <td> <input type="submit" name="button" value="修改"> 
        <input name="enews" type="hidden" id="enews" value="DoGetPassword">
        <input name="id" type="hidden" id="id" value="<?=$r[id]?>">
        <input name="tt" type="hidden" id="tt" value="<?=$r[tt]?>">
        <input name="cc" type="hidden" id="cc" value="<?=$r[cc]?>"></td>
    </tr>
  </form>
</table>
<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>