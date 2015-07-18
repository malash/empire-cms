<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='修改資料';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;修改安全信息";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr>
    <td width="50%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="50%" bgcolor="#FFFFFF"><div align="right">[<a href="../EditInfo/">修改基本資料</a>]&nbsp;&nbsp;</div></td>
  </tr>
</table>
<br>
<table width='100%' border='0' align='center' cellpadding='3' cellspacing='1' class="tableborder">
  <form name=userinfoform method=post enctype="multipart/form-data" action=../doaction.php>
    <input type=hidden name=enews value=EditSafeInfo>
    <tr class="header"> 
      <td height="25" colspan="2">密碼安全修改</td>
    </tr>
    <tr> 
      <td width='21%' height="25" bgcolor="#FFFFFF"> <div align='left'>用戶名 </div></td>
      <td width='79%' height="25" bgcolor="#FFFFFF"> 
        <?=$user[username]?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>原密碼</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='oldpassword' type='password' id='oldpassword' size="38" maxlength='20'>
        (修改密碼或郵箱時需要密碼驗證)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>新密碼</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='password' type='password' id='password' size="38" maxlength='20'>
        (不想修改請留空)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>確認新密碼</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='repassword' type='password' id='repassword' size="38" maxlength='20'>
        (不想修改請留空)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>郵箱</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='email' type='text' id='email' value='<?=$user[email]?>' size="38" maxlength='50'>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type='submit' name='Submit' value='修改信息'>
      </td>
    </tr>
  </form>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>