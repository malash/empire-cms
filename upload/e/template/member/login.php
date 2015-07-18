<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='會員登錄';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;會員登錄";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../doaction.php">
    <input type=hidden name=ecmsfrom value="<?=ehtmlspecialchars($_GET['from'])?>">
    <input type=hidden name=enews value=login>
	<input name="tobind" type="hidden" id="tobind" value="<?=$tobind?>">
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">會員登錄<?=$tobind?' (綁定賬號)':''?></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">用戶名：</td>
      <td width="77%" height="25"><input name="username" type="text" id="username" size="30">
	  	<?php
		if($public_r['regacttype']==1)
		{
		?>
        &nbsp;&nbsp;<a href="../register/regsend.php" target="_blank">帳號未激活？</a>
		<?php
		}
		?>
		</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">密碼：</td>
      <td height="25"><input name="password" type="password" id="password" size="30">
        &nbsp;&nbsp;<a href="../GetPassword/" target="_blank">忘記密碼？</a></td>
    </tr>
	 <tr bgcolor="#FFFFFF">
      <td height="25">保存時間：</td>
      <td height="25">
	  <input name=lifetime type=radio value=0 checked>
        不保存
	    <input type=radio name=lifetime value=3600>
        一小時 
        <input type=radio name=lifetime value=86400>
        一天 
        <input type=radio name=lifetime value=2592000>
        一個月
<input type=radio name=lifetime value=315360000>
        永久 </td>
    </tr>
    <?php
	if($public_r['loginkey_ok'])
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">驗證碼：</td>
      <td height="25"><input name="key" type="text" id="key" size="6">
        <img src="../../ShowKey/?v=login" name="loginKeyImg" id="loginKeyImg" onclick="loginKeyImg.src='../../ShowKey/?v=login&t='+Math.random()" title="看不清楚,點擊刷新"></td>
    </tr>
    <?php
	}	
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value=" 登 錄 ">&nbsp;&nbsp;&nbsp; <input type="button" name="button" value="馬上註冊" onclick="parent.location.href='../register/<?=$tobind?'?tobind=1':''?>';"></td>
    </tr>
	</form>
  </table>
<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>