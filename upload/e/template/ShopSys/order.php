<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
//��ܰt�e�覡
function ShowPs(){
	global $empire,$dbtbpre;
	$sql=$empire->query("select pid,pname,price,psay,isdefault from {$dbtbpre}enewsshopps where isclose=0 order by pid");
	$str='';
	while($r=$empire->fetch($sql))
	{
		$checked=$r[isdefault]==1?' checked':'';
		$str.="<table width='100%' border=0 align=center cellpadding=3 cellspacing=1>
  <tr> 
    <td width='69%' height=23> 
      <input type=radio name=psid value='".$r[pid]."'".$checked."><strong>".$r[pname]."</strong>
    </td>
    <td width='31%'><strong>�O��:�D".$r[price]."</strong></td>
  </tr>
  <tr> 
    <td colspan=2><table width='98%' border=0 align=right cellpadding=3 cellspacing=1><tr><td>".$r[psay]."</td></tr></table></td>
  </tr>
</table>";
	}
	return $str;
}

//��ܤ�I�覡
function ShowPayfs($pr,$user){
	global $empire,$dbtbpre;
	$str='';
	$sql=$empire->query("select payid,payname,payurl,paysay,userpay,userfen,isdefault from {$dbtbpre}enewsshoppayfs where isclose=0 order by payid");
	while($r=$empire->fetch($sql))
	{
		$checked=$r[isdefault]==1?' checked':'';
		$dis="";
		$words="";
		//���I��
		if($r[userfen])
		{
			if($pr['buytype'])
			{
				$dis=" disabled";
				$words="&nbsp;<font color='#666666'>(�z��ܪ��ӫ~�ܤ֦��@�Ӥ�����I���ʶR)</font>";
			}
			else
			{
				if(getcvar('mluserid'))
				{
					if($user[userfen]<$pr['totalfen'])
					{
						$dis=" disabled";
						$words="&nbsp;<font color='#666666'>(�z���b���I�Ƥ���,����ϥΦ���I�覡)</font>";
					}
				}
				else
				{
					$dis=" disabled";
					$words="&nbsp;<font color='#666666'>(�z���n��,����ϥΦ���I�覡)</font>";
				}
			}
		}
		//�l�B����
		elseif($r[userpay])
		{
			if(getcvar('mluserid'))
			{
				if($user[money]<$pr['totalmoney'])
				{
					$dis=" disabled";
					$words="&nbsp;<font color='#666666'>(�z���b���l�B����,����ϥΦ���I�覡)</font>";
				}
			}
			else
			{
				$dis=" disabled";
				$words="&nbsp;<font color='#666666'>(�z���n��,����ϥΦ���I�覡)</font>";
			}
		}
		//���W��I
		elseif($r[payurl])
		{
			$words="";
		}
		else
		{}
		$str.="<tr><td><b><input type=radio name=payfsid value='".$r[payid]."'".$checked."".$dis.">".$r[payname]."</b>".$words."</td></tr><tr><td><table width='98%' border=0 align=right cellpadding=3 cellspacing=1><tr><td>".$r[paysay]."</td></tr></table></td></tr>";
	}
	if($str)
	{
		$str="<table width='100%' border=0 align=center cellpadding=3 cellspacing=1>".$str."</table>";
	}
	return $str;
}

//����a�}
if($shoppr['buystep']==0)
{
	$formaction='../SubmitOrder/index.php';
	$formconfirm='';
	$formsubmit='<input type="submit" name="Submit" value=" �U�@�B ">';
	$enewshidden='';
	$ddno='';
}
else
{
	$formaction='../doaction.php';
	$formconfirm=' onsubmit="return confirm(\'�T�{����?\');"';
	$formsubmit='<input type="submit" name="Submit" value=" ����q�� ">';
	$enewshidden='<input type=hidden name=enews value=AddDd>';
	$ddno=ShopSys_ReturnDdNo();//�q��ID
}
?>
<!DOCTYPE HTML PUBLIC -//W3C//DTD HTML 4.01 Transitional//EN>
<html>
<head>
<meta http-equiv=Content-Type content=text/html; charset=big5>
<title>��g�q��</title>
<link href=../../data/images/qcss.css rel=stylesheet type=text/css>
</head>

<body>
<form action="<?=$formaction?>" method="post" name="myorder" id="myorder"<?=$formconfirm?>>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <?php
  if($ddno)
  {
  ?>
    <tr> 
      <td height="27" bgcolor="#FFFFFF"><strong>�q�渹: 
        <?=$ddno?>
        <input name="ddno" type="hidden" id="ddno" value="<?=$ddno?>">
        </strong></td>
    </tr>
  <?php
  }
  ?>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>��ܪ��ӫ~</strong>�@<?=$shoppr['buystep']!=2?'[<a href="../buycar/">�ק��ʪ���</a>]':''?></td>
    </tr>
    <tr> 
      <td> 
      <?php
	  include('buycar/buycar_order.php');
	  $pr=array();
	  $pr['totalmoney']=$totalmoney;
	  $pr['buytype']=$buytype;
	  $pr['totalfen']=$totalfen;
	  ?>
	  </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%"><strong>���f�H�H��</strong></td>
            <td><div align="right">
			<?php
			if($user['userid'])
			{
				$addresssql=$empire->query("select addressid,addressname from {$dbtbpre}enewsshop_address where userid='$user[userid]'");
			?>
              <select name="addressid" id="addressid" onchange="window.location='index.php?addressid='+this.options[this.selectedIndex].value">
                <option value="0">��ܹw�W�[���t�e�a�}</option>
				<?php
				while($chaddressr=$empire->fetch($addresssql))
				{
				?>
				<option value="<?=$chaddressr['addressid']?>"<?=$chaddressr['addressid']==$addressid?' selected':''?>><?=$chaddressr['addressname']?></option>
				<?php
				}
				?>
              </select>
			 <?php
			 }
			 ?>
            </div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td><table width="100%%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="20%" height="25">�u��m�W:</td>
            <td width="80%"><input name="truename" type="text" id="truename" value="<?=$useraddr[truename]?>" size="65">
              <?=stristr($shoppr['ddmust'],',truename,')?'*':''?></td>
          </tr>
          <tr> 
            <td height="25">�T�w�q��:</td>
            <td><input name="mycall" type="text" id="mycall" value="<?=$useraddr[mycall]?>" size="65">
              <?=stristr($shoppr['ddmust'],',mycall,')?'*':''?></td>
          </tr>
          <tr> 
            <td height="25">���:</td>
            <td><input name="phone" type="text" id="phone" value="<?=$useraddr[phone]?>" size="65">
			  <?=stristr($shoppr['ddmust'],',phone,')?'*':''?></td>
          </tr>
          <tr> 
            <td height="25">�pô�l�c:</td>
            <td><input name="email" type="text" id="email" value="<?=$email?>" size="65">
              <?=stristr($shoppr['ddmust'],',email,')?'*':''?></td>
          </tr>
		  <tr> 
            <td height="25">OICQ:</td>
            <td><input name="oicq" type="text" id="oicq" value="<?=$useraddr[oicq]?>" size="65">
			  <?=stristr($shoppr['ddmust'],',oicq,')?'*':''?></td>
          </tr>
          <tr> 
            <td height="25">MSN:</td>
            <td><input name="msn" type="text" id="msn" value="<?=$useraddr[msn]?>" size="65">
			  <?=stristr($shoppr['ddmust'],',msn,')?'*':''?></td>
          </tr>
          <tr> 
            <td height="25">�pô�a�}:</td>
            <td><input name="address" type="text" id="address" value="<?=$useraddr[address]?>" size="65">
              <?=stristr($shoppr['ddmust'],',address,')?'*':''?></td>
          </tr>
          <tr> 
            <td height="25">�l�s:</td>
            <td><input name="zip" type="text" id="zip" value="<?=$useraddr[zip]?>" size="65">
			  <?=stristr($shoppr['ddmust'],',zip,')?'*':''?></td>
          </tr>
          <tr>
            <td height="25">�P��лx�ؿv:</td>
            <td><input name="signbuild" type="text" id="signbuild" value="<?=$useraddr[signbuild]?>" size="65">
              <?=stristr($shoppr['ddmust'],',signbuild,')?'*':''?></td>
          </tr>
          <tr>
            <td height="25">�̨ΰe�f�ɶ�:</td>
            <td><input name="besttime" type="text" id="besttime" value="<?=$useraddr[besttime]?>" size="65">
              <?=stristr($shoppr['ddmust'],',besttime,')?'*':''?></td>
          </tr>
          <tr> 
            <td height="25">�Ƶ�:</td>
            <td><textarea name="bz" cols="65" rows="6" id="bz"></textarea>
			  <?=stristr($shoppr['ddmust'],',bz,')?'*':''?></td>
          </tr>
        </table></td>
    </tr>
	<?php
	if($shoppr['shoppsmust'])
	{
	$showps=ShowPs();
	if($showps)
	{
	?>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>��ܰt�e�覡</strong></td>
    </tr>
    <tr> 
      <td> 
        <?=$showps?>      </td>
    </tr>
	<?php
	}
	}
	?>
	<?php
	if($shoppr['shoppayfsmust'])
	{
	$showpayfs=ShowPayfs($pr,$user);
	if($showpayfs)
	{
	?>
    <tr> 
      <td height="23" bgcolor="#EFEFEF"><strong>��ܤ�I�覡</strong></td>
    </tr>
    <tr> 
      <td> 
        <?=$showpayfs?>      </td>
    </tr>
	<?php
	}
	}
	?>
	<?php
	//���ѵo��
	if($shoppr[havefp])
	{
	?>
    <tr> 
      <td height="23" bgcolor="#EFEFEF">�O�_�ݭn�o��:
        <input name="fp" type="checkbox" id="fp" value="1">
        �O(�ݼW�[ <?=$shoppr[fpnum]?>% ���O��)</td>
    </tr>
    <tr>
      <td height="23" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td>�o�����Y:
            <input name="fptt" type="text" id="fptt" size="38"></td>
          </tr>
        <tr>
          <td>�o���W��:
            <select name="fpname" id="fpname">
			<?php
			$fpnamer=explode("\r\n",$shoppr['fpname']);
			$fncount=count($fpnamer);
			for($i=0;$i<$fncount;$i++)
			{
			?>
			<option value="<?=$fpnamer[$i]?>"><?=$fpnamer[$i]?></option>
			<?php
			}
			?>
            </select>            </td>
          </tr>
      </table></td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td height="23" bgcolor="#EFEFEF">�ϥ��u�f�X</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td width="20%">�u�f�X:</td>
          <td width="80%"><input name="precode" type="text" id="precode" size="65"></td>
        </tr>
      </table></td>
    </tr>
    <tr> 
      <td height="25">
<div align="center"> 
		<?php
		if($shoppr['buystep']!=2)
		{
		?>
          <input type="button" name="Submit3" value=" �W�@�B " onclick="history.go(-1)">
          &nbsp;&nbsp; &nbsp;&nbsp; 
		<?php
		}
		?>
		<?=$formsubmit?>
		<?=$enewshidden?>
          <input name="alltotal" type="hidden" id="alltotal" value="<?=$pr['totalmoney']?>">
          <input name="alltotalfen" type="hidden" id="alltotalfen" value="<?=$pr['totalfen']?>">
        </div></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>