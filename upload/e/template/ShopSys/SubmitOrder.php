<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
//��ܰt�e�覡
function ShowPs($pid){
	global $empire,$dbtbpre,$shoppr,$totalr;
	$pid=(int)$pid;
	$r=$empire->fetch1("select pid,pname,price,psay from {$dbtbpre}enewsshopps where pid='$pid' and isclose=0");
	if(empty($r[pid]))
	{
		printerror('�п�ܰt�e�覡','',1,0,1);
	}
	$r['price']=ShopSys_PrePsTotal($r['pid'],$r['price'],$totalr['truetotalmoney'],$shoppr);
	echo"<table width='100%' border=0 align=center cellpadding=3 cellspacing=1>
  <tr> 
    <td width='69%' height=25> 
      <strong>".$r[pname]."</strong>
    </td>
    <td width='31%'><strong>�O��:�D".$r['price']."</strong></td>
  </tr>
  <tr> 
    <td colspan=2><table width='98%' border=0 align=right cellpadding=3 cellspacing=1><tr><td>".$r[psay]."</td></tr></table></td>
  </tr>
</table>";
	return $r['price'];
}

//��ܤ�I�覡
function ShowPayfs($payfsid,$r,$price){
	global $empire,$public_r,$dbtbpre,$totalr,$shoppr;
	$payfsid=(int)$payfsid;
	$add=$empire->fetch1("select payid,payname,payurl,paysay,userpay,userfen from {$dbtbpre}enewsshoppayfs where payid='$payfsid' and isclose=0");
	if(empty($add[payid]))
	{
		printerror('�п�ܤ�I�覡','',1,0,1);
	}
	//�`���B
	$buyallmoney=$totalr['totalmoney']+$price-$totalr['pretotal'];
	if($add[userfen]&&$r[fp])
	{
		printerror("FenNotFp","history.go(-1)",1);
	}
	//�o��
	if($r[fp])
	{
		$fptotal=($totalr['totalmoney']-$totalr['pretotal'])*($shoppr[fpnum]/100);
		$afp="+�o���O(".$fptotal.")";
		$buyallmoney+=$fptotal;
	}
	$buyallfen=$totalr['totalfen']+$price;
	$returntotal="�����`�B(".$totalr['totalmoney'].")+�t�e�O(".$price.")".$afp."-�u�f(".$totalr['pretotal'].")=�`�B(<b>".$buyallmoney." ��</b>)";
	$mytotal="�����`���B��:<b><font color=red>".$buyallmoney." ��</font></b> ����";
	//�O�_�n��
	if($add[userfen]||$add[userpay])
	{
		if(!getcvar('mluserid'))
		{
			printerror("NotLoginTobuy","history.go(-1)",1);
		}
		$user=islogin();
		//�I���ʶR
		if($add[userfen])
		{
			if($buyallfen>$user[userfen])
			{
				printerror("NotEnoughFenBuy","history.go(-1)",1);
			}
			$returntotal="�����`�I��(".$totalr['totalfen'].")+�t�e�I�ƶO(".$price.")=�`�I��(<b>".$buyallfen." �I</b>)";
			$mytotal="�����`�I�Ƭ�:<b><font color=red>".$buyallfen." �I</font></b> ����";
		}
		else//�����l�B
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
<meta http-equiv=Content-Type content=text/html; charset=big5>
<title>�q��T�{</title>
<link href=../../data/images/css.css rel=stylesheet type=text/css>
</head>

<body>
<form action="../doaction.php" method="post" name="myorder" id="myorder">
<input type=hidden name=enews value=AddDd>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
      <td height="27" bgcolor="#FFFFFF"><strong>�q�渹: 
        <?=$ddno?>
        <input name="ddno" type="hidden" id="ddno" value="<?=$ddno?>">
        </strong></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>��ܪ��ӫ~</strong></td>
    </tr>
    <tr> 
      <td> 
      <?php
	  include('buycar/buycar_order.php');
	  $totalr=array();
	  $totalr['totalmoney']=$totalmoney;
	  $totalr['buytype']=$buytype;
	  $totalr['totalfen']=$totalfen;
	  //�u�f�X
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
      <td height="23" bgcolor="#EFEFEF"><strong>���f�H�H��</strong></td>
    </tr>
    <tr> 
      <td><table width="100%%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="20%">�u��m�W:</td>
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
            <td>�T�w�q��:</td>
            <td> 
              <?=$r[mycall]?>
              <input name="mycall" type="hidden" id="mycall" value="<?=$r[mycall]?>">            </td>
          </tr>
          <tr> 
            <td>���ʹq��:</td>
            <td> 
              <?=$r[phone]?>
              <input name="phone" type="hidden" id="phone" value="<?=$r[phone]?>"></td>
          </tr>
          <tr> 
            <td>�pô�l�c:</td>
            <td> 
              <?=$r[email]?>
              <input name="email" type="hidden" id="email" value="<?=$r[email]?>">            </td>
          </tr>
          <tr> 
            <td>�pô�a�}:</td>
            <td> 
              <?=$r[address]?>
              <input name="address" type="hidden" id="address" value="<?=$r[address]?>" size="60">            </td>
          </tr>
          <tr> 
            <td>�l�s:</td>
            <td> 
              <?=$r[zip]?>
              <input name="zip" type="hidden" id="zip" value="<?=$r[zip]?>" size="8">            </td>
          </tr>
          <tr>
            <td>�P��лx�ؿv:</td>
            <td><?=$r[signbuild]?>
              <input name="signbuild" type="hidden" id="signbuild" value="<?=$r[signbuild]?>" size="8"></td>
          </tr>
          <tr>
            <td>�̨ΰe�f�ɶ�:</td>
            <td><?=$r[besttime]?>
              <input name="besttime" type="hidden" id="besttime" value="<?=$r[besttime]?>" size="8"></td>
          </tr>
          <tr> 
            <td>�Ƶ�:</td>
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
      <td height="23" bgcolor="#EFEFEF"><strong>��ܰt�e�覡 
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
      <td height="23" bgcolor="#EFEFEF"><strong>��ܤ�I�覡 
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
      <td height="23" bgcolor="#EFEFEF"><strong>�o���H��</strong></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td width="20%">�o���O��:</td>
          <td width="80%"><?=$shoppr[fpnum]?>%</td>
        </tr>
        <tr>
          <td>�o�����Y:</td>
          <td><?=$r['fptt']?></td>
        </tr>
        <tr>
          <td>�o���W��:</td>
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
      <td height="23" bgcolor="#EFEFEF"><strong>�u�f</strong></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td width="20%">�u�f�X:</td>
          <td width="80%"><?=$prer[precode]?><input name="precode" type="hidden" id="precode" value="<?=$r[precode]?>"></td>
        </tr>
        <tr>
          <td>�u�f���B:</td>
          <td><?=$pretotal?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#EFEFEF"><strong>����H�� 
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
          <input type="button" name="Submit3" value=" �W�@�B " onclick="history.go(-1)">
		  &nbsp;&nbsp;
		  <input type="submit" name="Submit" value=" ����q�� ">
        </div></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>