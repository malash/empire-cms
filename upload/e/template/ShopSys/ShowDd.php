<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../../data/images/css.css" rel="stylesheet" type="text/css">
<title>查看訂單</title>
<script>
function PrintDd()
{
	pdiv.style.display="none";
	window.print();
}
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="61%" height="27" bgcolor="#FFFFFF"><strong>訂單號: 
      <?=$r[ddno]?>
      </strong></td>
    <td width="39%" bgcolor="#FFFFFF"><strong>下單時間: 
      <?=$r[ddtime]?>
      </strong></td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>商品信息</strong></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <?php
	  $buycar=$addr['buycar'];
	  $payby=$r['payby'];
	  include('buycar/buycar_showdd.php');
	  ?>
    </td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>訂單信息</strong></td>
  </tr>
  <tr> 
    <td height="23" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="12%" height="25"> 
            <div align="right">訂單號：</div></td>
          <td width="32%"><strong> 
            <?=$r[ddno]?>
            </strong></td>
          <td width="14%"> 
            <div align="right">訂單狀態：</div></td>
          <td width="41%"><strong> 
            <?=$ha?>
            </strong>/<strong> 
            <?=$ou?>
            </strong>/<strong> 
            <?=$ch?>
            </strong> 
            <?=$topay?>          </td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">下單時間：</div></td>
          <td><strong> 
            <?=$r[ddtime]?>
            </strong></td>
          <td><div align="right">商品總金額：</div></td>
          <td><strong>
            <?=$alltotal?>
            </strong></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">配送方式：</div></td>
          <td><strong>
            <?=$r[psname]?>
            </strong></td>
          <td><div align="right">+ 商品運費：</div></td>
          <td><strong>
            <?=$pstotal?>
            </strong></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">支付方式：</div></td>
          <td><strong>
            <?=$payfsname?>
            </strong></td>
          <td><div align="right">+ 發票費用：</div></td>
          <td><?=$r[fptotal]?></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">需要發票：</div></td>
          <td><?=$fp?></td>
          <td><div align="right">- 優惠：</div></td>
          <td><?=$r[pretotal]?></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">發票抬頭：</div></td>
          <td><strong> 
            <?=$r[fptt]?>
            </strong></td>
          <td><div align="right">訂單總金額：</div></td>
          <td><strong>
            <?=$mytotal?>
          </strong></td>
        </tr>
        <tr>
          <td height="25"><div align="right">發票名稱：</div></td>
          <td colspan="3"><strong>
            <?=$r[fpname]?>
          </strong></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>收貨人信息</strong></td>
  </tr>
  <tr> 
    <td colspan="2"><table width="100%%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="20%" height="25">真實姓名:</td>
          <td width="80%"> 
            <?=$r[truename]?>          </td>
        </tr>
        <tr> 
          <td height="25">QQ:</td>
          <td> 
            <?=$r[oicq]?>          </td>
        </tr>
        <tr> 
          <td height="25">MSN:</td>
          <td> 
            <?=$r[msn]?>          </td>
        </tr>
        <tr> 
          <td height="25">固定電話:</td>
          <td> 
            <?=$r[mycall]?>          </td>
        </tr>
        <tr> 
          <td height="25">移動電話:</td>
          <td> 
            <?=$r[phone]?>          </td>
        </tr>
        <tr> 
          <td height="25">聯繫郵箱:</td>
          <td> 
            <?=$r[email]?>          </td>
        </tr>
        <tr> 
          <td height="25">聯繫地址:</td>
          <td> 
            <?=$r[address]?>          </td>
        </tr>
        <tr> 
          <td height="25">郵編:</td>
          <td> 
            <?=$r[zip]?>          </td>
        </tr>
        <tr>
          <td height="25">標誌建築:</td>
          <td><?=$r[signbuild]?></td>
        </tr>
        <tr>
          <td height="25">最佳送貨地址:</td>
          <td><?=$r[besttime]?></td>
        </tr>
        <tr> 
          <td height="25">備註:</td>
          <td> 
            <?=nl2br($addr[bz])?>          </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>管理員備註信息</strong></td>
  </tr>
  <tr> 
    <td colspan="2"><table width="100%%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="20%" height="25">備註內容:</td>
          <td width="80%"> 
            <?=nl2br($addr['retext'])?>          </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2"><div align="center"> 
        <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" id="pdiv">
          <tr> 
            <td><div align="center">
                <input type="button" name="Submit" value=" 打 印 " onclick="javascript:PrintDd();">
              </div></td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
</body>
</html>