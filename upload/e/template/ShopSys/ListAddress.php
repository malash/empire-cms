<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�t�e�a�}�C��';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../../member/cp/>�|������</a>&nbsp;>&nbsp;�t�e�a�}�C��&nbsp;&nbsp;(<a href='AddAddress.php?enews=AddAddress'>�W�[�t�e�a�}</a>)";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr>
    <td width="50%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="50%" bgcolor="#FFFFFF"><div align="right">[<a href="AddAddress.php?enews=AddAddress">�W�[�t�e�a�}</a>]&nbsp;&nbsp;</div></td>
  </tr>
</table>
<br>
<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header">
      <td width="65%" height="23"><div align="center">�a�}�W��</div></td>
      <td width="10%"><div align="center">�q�{</div></td>
      <td width="25%"><div align="center">�ާ@</div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		if($r['isdefault'])
		{
			$isdefault='�O';
		}
		else
		{
			$isdefault='--';
		}
	?>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="center"><?=$r['addressname']?></div></td>
      <td><div align="center"><?=$isdefault?></div></td>
      <td><div align="center">[<a href="AddAddress.php?enews=EditAddress&addressid=<?=$r['addressid']?>">�ק�</a>] [<a href="../doaction.php?enews=DefAddress&addressid=<?=$r['addressid']?>" onclick="return confirm('�T�{�n�]���q�{?');">�q�{</a>] [<a href="../doaction.php?enews=DelAddress&addressid=<?=$r['addressid']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>]</div></td>
    </tr>
    <?php
	}
	?>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>