<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�b�����A';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../cp/>�|������</a>&nbsp;>&nbsp;�b�����A";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br> 
<table width="50%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="2">�b�����A</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">�Τ�ID:</td>
    <td height="25"> 
      <?=$user[userid]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�Τ�W:</td>
    <td height="25"> 
      <?=$user[username]?>
      &nbsp;&nbsp;(<a href="../../space/?userid=<?=$user[userid]?>" target="_blank">�ڪ��|���Ŷ�</a>) 
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="33%" height="25">���U�ɶ�:</td>
    <td width="67%" height="25"> 
      <?=$registertime?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�|������:</td>
    <td height="25"> 
      <?=$level_r[$r[groupid]][groupname]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�Ѿl���Ĵ�:</td>
    <td height="25"> 
      <?=$userdate?>
      �� </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�Ѿl�I��:</td>
    <td height="25"> 
      <?=$r[userfen]?>
      �I</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�b��l�B:</td>
    <td height="25"> 
      <?=$r[money]?>
      �� </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�s�u����:</td>
    <td height="25">
      <?=$havemsg?>
    </td>
  </tr>
</table>
<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>