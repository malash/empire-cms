<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
//顯示配送方式
function ShowPs($pid){
	global $empire,$dbtbpre,$shoppr,$totalr;
	$pid=(int)$pid;
	$r=$empire->fetch1("select pid,pname,price,psay from {$dbtbpre}enewsshopps where pid='$pid' and isclose=0");
	if(empty($r[pid]))
	{
		printerror('請選擇配送方式','',1,0,1);
	}
	$r['price']=ShopSys_PrePsTotal($r['pid'],$r['price'],$totalr['truetotalmoney'],$shoppr);
	echo"<table width='100%' border=0 align=center cellpadding=3 cellspacing=1>
  <tr> 
    <td width='69%' height=25> 
      <strong>".$r[pname]."</strong>
    </td>
    <td width='31%'><strong>費用:￥".$r['price']."</strong></td>
  </tr>
  <tr> 
    <td colspan=2><table width='98%' border=0 align=right cellpadding=3 cellspacing=1><tr><td>".$r[psay]."</td></tr></table></td>
  </tr>
</table>";
	return $r['price'];
}

//顯示支付方式
function ShowPayfs($payfsid,$r,$price){
	global $empire,$public_r,$dbtbpre,$totalr,$shoppr;
	$payfsid=(int)$payfsid;
	$add=$empire->fetch1("select payid,payname,payurl,paysay,userpay,userfen from {$dbtbpre}enewsshoppayfs where payid='$payfsid' and isclose=0");
	if(empty($add[payid]))
	{
		printerror('請選擇支付方式','',1,0,1);
	}
	//總金額
	$buyallmoney=$totalr['totalmoney']+$price-$totalr['pretotal'];
	if($add[userfen]&&$r[fp])
	{
		printerror("FenNotFp","history.go(-1)",1);
	}
	//發票
	if($r[fp])
	{
		$fptotal=($totalr['totalmoney']-$totalr['pretotal'])*($shoppr[fpnum]/100);
		$afp="+發票費(".$fptotal.")";
		$buyallmoney+=$fptotal;
	}
	$buyallfen=$totalr['totalfen']+$price;
	$returntotal="採購總額(".$totalr['totalmoney'].")+配送費(".$price.")".$afp."-優惠(".$totalr['pretotal'].")=總額(<b>".$buyallmoney." 元</b>)";
	$mytotal="結算總金額為:<b><font color=red>".$buyallmoney." 元</font></b> 全部";
	//是否登陸
	if($add[userfen]||$add[userpay])
	{
		if(!getcvar('mluserid'))
		{
			printerror("NotLoginTobuy","history.go(-1)",1);
		}
		$user=islogin();
		//點數購買
		if($add[userfen])
		{
			if($buyallfen>$user[userfen])
			{
				printerror("NotEnoughFenBuy","history.go(-1)",1);
			}
			$returntotal="採購總點數(".$totalr['totalfen'].")+配送點數費(".$price.")=總點數(<b>".$buyallfen." 點</b>)";
			$mytotal="結算總點數為:<b><font color=red>".$buyallfen." 點</font></b> 全部";
		}
		else//扣除餘額
		{
			if($buyallmoney>$user[money])
			{
				printerror("NotEnoughMoneyBuy","history.go(-1)",1);
			}
		}
	}
	echo "<table width='100%' border=0 align=center cellpadding=3 cellspacing=1><tr><td>".$add[payname]."</td></tr></table>";
	$return[0]=$returntotal;
	$return[1]=$mytotal;
	return $return;
}
?>
<!DOCTYPE HTML PUBLIC -//W3C//DTD HTML 4.01 Transitional//EN>
<html>
<head>
<meta http-equiv=Content-Type content=text/html; charset=utf-8>
<title>訂單確認</title>
<link href=../../data/images/css.css rel=stylesheet type=text/css>
</head>

<body>
<form action="../doaction.php" method="post" name="myorder" id="myorder">
<input type=hidden name=enews value=AddDd>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
      <td height="27" bgcolor="#FFFFFF"><strong>訂單號: 
        <?=$ddno?>
        <input name="ddno" type="hidden" id="ddno" value="<?=$ddno?>">
        </strong></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>選擇的商品</strong></td>
    </tr>
    <tr> 
      <td> 
      <?php
	  include('buycar/buycar_order.php');
	  $totalr=array();
	  $totalr['totalmoney']=$totalmoney;
	  $totalr['buytype']=$buytype;
	  $totalr['totalfen']=$totalfen;
	  //優惠碼
	  $prer=array();
	  $pretotal=0;
	  if($r['precode'])
	  {
		$prer=ShopSys_GetPre($r['precode'],$totalr['totalmoney'],$user,$classids);
		$pretotal=ShopSys_PreMoney($prer,$totalr['totalmoney']);
	  }
	  $totalr['pretotal']=$pretotal;
	  $totalr['truetotalmoney']=$totalr['totalmoney']-$pretotal;
	  ?>
	  </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>收貨人信息</strong></td>
    </tr>
    <tr> 
      <td><table width="100%%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="20%">真實姓名:</td>
            <td width="80%"> 
              <?=$r[truename]?>
              <input name="truename" type="hidden" id="truename" value="<?=$r[truename]?>">            </td>
          </tr>
          <tr> 
            <td>OICQ:</td>
            <td> 
              <?=$r[oicq]?>
              <input name="oicq" type="hidden" id="oicq" value="<?=$r[oicq]?>"></td>
          </tr>
          <tr> 
            <td>MSN:</td>
            <td> 
              <?=$r[msn]?>
              <input name="msn" type="hidden" id="msn" value="<?=$r[msn]?>"></td>
          </tr>
          <tr> 
            <td>固定電話:</td>
            <td> 
              <?=$r[mycall]?>
              <input name="mycall" type="hidden" id="mycall" value="<?=$r[mycall]?>">            </td>
          </tr>
          <tr> 
            <td>移動電話:</td>
            <td> 
              <?=$r[phone]?>
              <input name="phone" type="hidden" id="phone" value="<?=$r[phone]?>"></td>
          </tr>
          <tr> 
            <td>聯繫郵箱:</td>
            <td> 
              <?=$r[email]?>
              <input name="email" type="hidden" id="email" value="<?=$r[email]?>">            </td>
          </tr>
          <tr> 
            <td>聯繫地址:</td>
            <td> 
              <?=$r[address]?>
              <input name="address" type="hidden" id="address" value="<?=$r[address]?>" size="60">            </td>
          </tr>
          <tr> 
            <td>郵編:</td>
            <td> 
              <?=$r[zip]?>
              <input name="zip" type="hidden" id="zip" value="<?=$r[zip]?>" size="8">            </td>
          </tr>
          <tr>
            <td>周邊標誌建築:</td>
            <td><?=$r[signbuild]?>
              <input name="signbuild" type="hidden" id="signbuild" value="<?=$r[signbuild]?>" size="8"></td>
          </tr>
          <tr>
            <td>最佳送貨時間:</td>
            <td><?=$r[besttime]?>
              <input name="besttime" type="hidden" id="besttime" value="<?=$r[besttime]?>" size="8"></td>
          </tr>
          <tr> 
            <td>備註:</td>
            <td> 
              <?=nl2br($r[bz])?> <input name="bz" type="hidden" value="<?=$r[bz]?>" size="8">            </td>
          </tr>
        </table></td>
    </tr>
	<?php
	if($shoppr['shoppsmust'])
	{
	?>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>選擇配送方式 
        <input name="psid" type="hidden" id="psid" value="<?=$r[psid]?>" size="8">
        </strong></td>
    </tr>
    <tr> 
      <td height="27"> 
      <?php
	  $price=ShowPs($r[psid]);
	  ?>      </td>
    </tr>
	<?php
	}
	?>
	<?php
	if($shoppr['shoppayfsmust'])
	{
	?>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>選擇支付方式 
        <input name="payfsid" type="hidden" id="payfsid" value="<?=$r[payfsid]?>" size="8">
        </strong></td>
    </tr>
    <tr> 
      <td height="27"> 
        <?php
	  $total=ShowPayfs($r[payfsid],$r,$price);
	  ?>      </td>
    </tr>
	<?php
	}
	?>
	<?php
	if($shoppr[havefp]&&$r[fp])
	{
	?>
    <tr>
      <td height="23" bgcolor="#EFEFEF"><strong>發票信息</strong></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td width="20%">發票費用:</td>
          <td width="80%"><?=$shoppr[fpnum]?>%</td>
        </tr>
        <tr>
          <td>發票抬頭:</td>
          <td><?=$r['fptt']?></td>
        </tr>
        <tr>
          <td>發票名稱:</td>
          <td><?=$r['fpname']?></td>
        </tr>
      </table>
	  	<input name="fp" type="hidden" id="fp" value="<?=$r[fp]?>">
        <input name="fptt" type="hidden" id="fptt" value="<?=$r[fptt]?>">
		<input name="fpname" type="hidden" id="fpname" value="<?=$r[fpname]?>">	  </td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td height="23" bgcolor="#EFEFEF"><strong>優惠</strong></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td width="20%">優惠碼:</td>
          <td width="80%"><?=$prer[precode]?><input name="precode" type="hidden" id="precode" value="<?=$r[precode]?>"></td>
        </tr>
        <tr>
          <td>優惠金額:</td>
          <td><?=$pretotal?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#EFEFEF"><strong>結算信息 
        </strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr>
            <td><div align="center"><?=$total[0]?></div></td>
          </tr>
          <tr> 
            <td><div align="center">
                <?=$total[1]?>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr height=27> 
      <td><div align="center"> 
          <input type="button" name="Submit3" value=" 上一步 " onclick="history.go(-1)">
		  &nbsp;&nbsp;
		  <input type="submit" name="Submit" value=" 提交訂單 ">
        </div></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>