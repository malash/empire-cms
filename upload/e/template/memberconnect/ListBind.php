<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='登錄綁定';
$url="<a href=../../>首頁</a>&nbsp;>&nbsp;<a href=../member/cp/>會員中心</a>&nbsp;>&nbsp;登錄綁定";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td width="36%"><div align="center">平台</div></td>
    <td width="20%" height="25"><div align="center">綁定時間</div></td>
    <td width="20%" height="25"><div align="center">上次登錄</div></td>
    <td width="9%" height="25"><div align="center">登錄次數</div></td>
    <td width="15%"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
	  $bindr=$empire->fetch1("select id,bindtime,loginnum,lasttime from {$dbtbpre}enewsmember_connect where userid='$user[userid]' and apptype='$r[apptype]' limit 1");
	  if($bindr['id'])
	  {
		  $dourl='<a href="doaction.php?enews=DelBind&id='.$bindr['id'].'" onclick="return confirm(\'確認要解除綁定?\');">解除綁定</a>';
	  }
	  else
	  {
		  $dourl='<a href="index.php?apptype='.$r['apptype'].'&ecms=1">立即綁定</a>';
	  }
  ?>
  <tr bgcolor="#FFFFFF">
    <td><div align="center">
      <?=$r['appname']?>
    </div></td>
    <td height="25"><div align="center">
      <?=$bindr['bindtime']?date('Y-m-d H:i:s',$bindr['bindtime']):'未綁定'?>
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