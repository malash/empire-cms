<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�ק���';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../cp/>�|������</a>&nbsp;>&nbsp;�ק�w���H��";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr>
    <td width="50%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="50%" bgcolor="#FFFFFF"><div align="right">[<a href="../EditInfo/">�ק�򥻸��</a>]&nbsp;&nbsp;</div></td>
  </tr>
</table>
<br>
<table width='100%' border='0' align='center' cellpadding='3' cellspacing='1' class="tableborder">
  <form name=userinfoform method=post enctype="multipart/form-data" action=../doaction.php>
    <input type=hidden name=enews value=EditSafeInfo>
    <tr class="header"> 
      <td height="25" colspan="2">�K�X�w���ק�</td>
    </tr>
    <tr> 
      <td width='21%' height="25" bgcolor="#FFFFFF"> <div align='left'>�Τ�W </div></td>
      <td width='79%' height="25" bgcolor="#FFFFFF"> 
        <?=$user[username]?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>��K�X</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='oldpassword' type='password' id='oldpassword' size="38" maxlength='20'>
        (�ק�K�X�ζl�c�ɻݭn�K�X����)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>�s�K�X</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='password' type='password' id='password' size="38" maxlength='20'>
        (���Q�ק�Яd��)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>�T�{�s�K�X</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='repassword' type='password' id='repassword' size="38" maxlength='20'>
        (���Q�ק�Яd��)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>�l�c</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='email' type='text' id='email' value='<?=$user[email]?>' size="38" maxlength='50'>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type='submit' name='Submit' value='�ק�H��'>
      </td>
    </tr>
  </form>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>