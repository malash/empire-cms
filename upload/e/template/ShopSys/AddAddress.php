<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$postword=$enews=='EditAddress'?'�ק�a�}':'�W�[�a�}';
$public_diyr['pagetitle']=$postword;
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../../member/cp/>�|������</a>&nbsp;>&nbsp;<a href='ListAddress.php'>�t�e�a�}�C��</a>&nbsp;>&nbsp;".$postword;
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form action="../doaction.php" method="post" name="addform" id="addform">
    <tr class="header">
      <td height="23" colspan="2"><?=$postword?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="22%" height="25">�a�}�W�١G</td>
      <td width="78%" height="25"><input name="addressname" type="text" id="title2" value="<?=$r[addressname]?>" size="42">
      *</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�m�W�G</td>
      <td height="25"><input name="truename" type="text" id="addressname" value="<?=$r[truename]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�l�c�a�}�G</td>
      <td height="25"><input name="email" type="text" id="truename" value="<?=$r[email]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�T�w�q�ܡG</td>
      <td height="25"><input name="mycall" type="text" id="email" value="<?=$r[mycall]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">������X�G</td>
      <td height="25"><input name="phone" type="text" id="mycall" value="<?=$r[phone]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">QQ���X�G</td>
      <td height="25"><input name="oicq" type="text" id="oicq" value="<?=$r[oicq]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">MSN�G</td>
      <td height="25"><input name="msn" type="text" id="msn" value="<?=$r[msn]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���f�a�}�G</td>
      <td height="25"><input name="address" type="text" id="phone" value="<?=$r[address]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�l�s�G</td>
      <td height="25"><input name="zip" type="text" id="address" value="<?=$r[zip]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�a�}�P��лx�ʫؿv�G</td>
      <td height="25"><input name="signbuild" type="text" id="zip" value="<?=$r[signbuild]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�̨Φ��f�ɶ��G</td>
      <td height="25"><input name="besttime" type="text" id="signbuild" value="<?=$r[besttime]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����">
        &nbsp;
        <input type="reset" name="Submit2" value="���m">
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>">      <input name="addressid" type="hidden" id="addressid" value="<?=$addressid?>"></td>
    </tr>
  </form>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>
