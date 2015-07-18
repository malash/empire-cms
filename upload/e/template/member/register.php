<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='註冊會員';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;註冊會員";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width='100%' border='0' align='center' cellpadding='3' cellspacing='1' class="tableborder">
  <form name=userinfoform method=post enctype="multipart/form-data" action=../doaction.php>
    <input type=hidden name=enews value=register>
    <tr class="header"> 
      <td height="25" colspan="2">註冊會員<?=$tobind?' (綁定賬號)':''?></td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>基本信息 
        <input name="groupid" type="hidden" id="groupid" value="<?=$groupid?>">
        <input name="tobind" type="hidden" id="tobind" value="<?=$tobind?>">
      </strong></td>
    </tr>
    <tr> 
      <td width='25%' height="25" bgcolor="#FFFFFF"> <div align='left'>用戶名</div></td>
      <td width='75%' height="25" bgcolor="#FFFFFF"> <input name='username' type='text' id='username' maxlength='30'>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>密碼</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='password' type='password' id='password' maxlength='20'>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>重複密碼</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='repassword' type='password' id='repassword' maxlength='20'>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>郵箱</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='email' type='text' id='email' maxlength='50'>
        *</td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>其他信息</strong></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> 
    <?php
	@include($formfile);
	?>
      </td>
    </tr>
	<?php
	if($public_r['regkey_ok'])
	{
	?>
    <tr>
      <td height="25" bgcolor="#FFFFFF">驗證碼：</td>
      <td height="25" bgcolor="#FFFFFF"><input name="key" type="text" id="key" size="6"> 
        <img src="../../ShowKey/?v=reg" name="regKeyImg" id="regKeyImg" onclick="regKeyImg.src='../../ShowKey/?v=reg&t='+Math.random()" title="看不清楚,點擊刷新"></td>
    </tr>
	<?php
	}	
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type='submit' name='Submit' value='馬上註冊'> 
        &nbsp;&nbsp; <input type='button' name='Submit2' value='返回' onclick='history.go(-1)'></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">說明：帶*項為必填。</td>
    </tr>
  </form>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>