<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�n���j�w';
$url="<a href=../../>����</a>&nbsp;>&nbsp;<a href=../member/cp/>�|������</a>&nbsp;>&nbsp;�n���j�w";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td width="36%"><div align="center">���x</div></td>
    <td width="20%" height="25"><div align="center">�j�w�ɶ�</div></td>
    <td width="20%" height="25"><div align="center">�W���n��</div></td>
    <td width="9%" height="25"><div align="center">�n������</div></td>
    <td width="15%"><div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
	  $bindr=$empire->fetch1("select id,bindtime,loginnum,lasttime from {$dbtbpre}enewsmember_connect where userid='$user[userid]' and apptype='$r[apptype]' limit 1");
	  if($bindr['id'])
	  {
		  $dourl='<a href="doaction.php?enews=DelBind&id='.$bindr['id'].'" onclick="return confirm(\'�T�{�n�Ѱ��j�w?\');">�Ѱ��j�w</a>';
	  }
	  else
	  {
		  $dourl='<a href="index.php?apptype='.$r['apptype'].'&ecms=1">�ߧY�j�w</a>';
	  }
  ?>
  <tr bgcolor="#FFFFFF">
    <td><div align="center">
      <?=$r['appname']?>
    </div></td>
    <td height="25"><div align="center">
      <?=$bindr['bindtime']?date('Y-m-d H:i:s',$bindr['bindtime']):'���j�w'?>
    </div></td>
    <td height="25"><div align="center">
      <?=$bindr['lasttime']?date('Y-m-d H:i:s',$bindr['lasttime']):'--'?>
    </div></td>
    <td height="25"><div align="center">
      <?=$bindr['loginnum']?>
    </div></td>
    <td><div align="center"><?=$dourl?></div></td>
  </tr>
  <?php
  }
  ?>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>