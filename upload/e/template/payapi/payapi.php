<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='在線支付';
$url="<a href='../../'>首頁</a>&nbsp;>&nbsp;<a href=../member/cp/>會員中心</a>&nbsp;>&nbsp;在線支付";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script>
function ChangeShowBuyFen(amount){
	var fen;
	fen=Math.floor(amount)*<?=$pr[paymoneytofen]?>;
	document.getElementById("showbuyfen").innerHTML=fen+" 點";
}
</script>
<form name="paytofenform" method="post" action="pay.php">
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">購買點數： 
      <input type="hidden" name="phome" value="PayToFen"></td>
    </tr>
    <tr> 
      <td width="127" height="25" bgcolor="#FFFFFF">購買金額：</td>
      <td width="358" bgcolor="#FFFFFF"> <input name="money" type="text" value="" size="8" onchange="ChangeShowBuyFen(document.paytofenform.money.value);">
        元 <font color="#333333">( 1元 = 
        <?=$pr[paymoneytofen]?>
        點數)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">購買點數：</td>
      <td bgcolor="#FFFFFF" id="showbuyfen"> 0 點</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">支付平台：</td>
      <td height="25" bgcolor="#FFFFFF"><SELECT name="payid" style="WIDTH: 120px">
          <?=$pays?>
        </SELECT></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="確定購買"></td>
    </tr>
  </table>
</form>
<br><br>
<form name="paytomoneyform" method="post" action="pay.php">
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">存預付款： 
      <input name="phome" type="hidden" id="phome" value="PayToMoney"></td>
    </tr>
    <tr> 
      <td width="127" height="25" bgcolor="#FFFFFF">金額：</td>
      <td width="358" bgcolor="#FFFFFF"> <input name="money" type="text" value="" size="8">
        元</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">支付平台：</td>
      <td height="25" bgcolor="#FFFFFF"><SELECT name="payid" style="WIDTH: 120px">
          <?=$pays?>
        </SELECT></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit3" value="確定支付"></td>
    </tr>
  </table>
</form>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>