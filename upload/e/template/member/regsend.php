<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�o�e�b���E���l��';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../cp/>�|������</a>&nbsp;>&nbsp;���o�b���E���l��";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="RegSendForm" method="POST" action="../doaction.php">
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">���o�b���E���l��</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">�Τ�W(*)</td>
      <td width="77%"><input name="username" type="text" id="username" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�K�X(*)</td>
      <td><input name="password" type="password" id="password" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�l�c(*)</td>
      <td><input name="email" type="text" id="email" size="38"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�s�����l�c</td>
      <td><input name="newemail" type="text" id="newemail" size="38">
        <font color="#666666">(�n���ܱ����l�c�i��g)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ҽX</td>
      <td><input name="key" type="text" id="key" size="6"> <img src="../../ShowKey/?v=regsend" name="regsendKeyImg" id="regsendKeyImg" onclick="regsendKeyImg.src='../../ShowKey/?v=regsend&t='+Math.random()" title="�ݤ��M��,�I����s"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp; </td>
      <td> <input type="submit" name="button" value="����"> 
        <input name="enews" type="hidden" id="enews" value="RegSend"></td>
    </tr>
  </form>
</table>
<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>