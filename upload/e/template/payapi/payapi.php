<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�b�u��I';
$url="<a href='../../'>����</a>&nbsp;>&nbsp;<a href=../member/cp/>�|������</a>&nbsp;>&nbsp;�b�u��I";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script>
function ChangeShowBuyFen(amount){
	var fen;
	fen=Math.floor(amount)*<?=$pr[paymoneytofen]?>;
	document.getElementById("showbuyfen").innerHTML=fen+" �I";
}
</script>
<form name="paytofenform" method="post" action="pay.php">
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�ʶR�I�ơG 
      <input type="hidden" name="phome" value="PayToFen"></td>
    </tr>
    <tr> 
      <td width="127" height="25" bgcolor="#FFFFFF">�ʶR���B�G</td>
      <td width="358" bgcolor="#FFFFFF"> <input name="money" type="text" value="" size="8" onchange="ChangeShowBuyFen(document.paytofenform.money.value);">
        �� <font color="#333333">( 1�� = 
        <?=$pr[paymoneytofen]?>
        �I��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ʶR�I�ơG</td>
      <td bgcolor="#FFFFFF" id="showbuyfen"> 0 �I</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��I���x�G</td>
      <td height="25" bgcolor="#FFFFFF"><SELECT name="payid" style="WIDTH: 120px">
          <?=$pays?>
        </SELECT></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="�T�w�ʶR"></td>
    </tr>
  </table>
</form>
<br><br>
<form name="paytomoneyform" method="post" action="pay.php">
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">�s�w�I�ڡG 
      <input name="phome" type="hidden" id="phome" value="PayToMoney"></td>
    </tr>
    <tr> 
      <td width="127" height="25" bgcolor="#FFFFFF">���B�G</td>
      <td width="358" bgcolor="#FFFFFF"> <input name="money" type="text" value="" size="8">
        ��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��I���x�G</td>
      <td height="25" bgcolor="#FFFFFF"><SELECT name="payid" style="WIDTH: 120px">
          <?=$pays?>
        </SELECT></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit3" value="�T�w��I"></td>
    </tr>
  </table>
</form>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>