<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='���U�|��';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../cp/>�|������</a>&nbsp;>&nbsp;���U�|��";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width='100%' border='0' align='center' cellpadding='3' cellspacing='1' class="tableborder">
  <form name=userinfoform method=post enctype="multipart/form-data" action=../doaction.php>
    <input type=hidden name=enews value=register>
    <tr class="header"> 
      <td height="25" colspan="2">���U�|��<?=$tobind?' (�j�w�㸹)':''?></td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>�򥻫H�� 
        <input name="groupid" type="hidden" id="groupid" value="<?=$groupid?>">
        <input name="tobind" type="hidden" id="tobind" value="<?=$tobind?>">
      </strong></td>
    </tr>
    <tr> 
      <td width='25%' height="25" bgcolor="#FFFFFF"> <div align='left'>�Τ�W</div></td>
      <td width='75%' height="25" bgcolor="#FFFFFF"> <input name='username' type='text' id='username' maxlength='30'>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>�K�X</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='password' type='password' id='password' maxlength='20'>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>���ƱK�X</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='repassword' type='password' id='repassword' maxlength='20'>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align='left'>�l�c</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name='email' type='text' id='email' maxlength='50'>
        *</td>
    </tr>
    <tr> 
      <td height="25" colspan="2"><strong>��L�H��</strong></td>
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
      <td height="25" bgcolor="#FFFFFF">���ҽX�G</td>
      <td height="25" bgcolor="#FFFFFF"><input name="key" type="text" id="key" size="6"> 
        <img src="../../ShowKey/?v=reg" name="regKeyImg" id="regKeyImg" onclick="regKeyImg.src='../../ShowKey/?v=reg&t='+Math.random()" title="�ݤ��M��,�I����s"></td>
    </tr>
	<?php
	}	
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type='submit' name='Submit' value='���W���U'> 
        &nbsp;&nbsp; <input type='button' name='Submit2' value='��^' onclick='history.go(-1)'></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">�����G�a*��������C</td>
    </tr>
  </form>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>