<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�q��C��';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../../member/cp/>�|������</a>&nbsp;>&nbsp;�q��C��";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script src=../../data/images/setday.js></script>
<form name="form1" method="get" action="index.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
      <td>�q�渹��: 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        �ɶ��q 
        <input name="starttime" type="text" id="starttime2" value="<?=$starttime?>" size="12" onclick="setday(this)">
        �� 
        <input name="endtime" type="text" id="endtime2" value="<?=$endtime?>" size="12" onclick="setday(this)">
        ��q�� 
        <input type="submit" name="Submit6" value="�j��"> <input name="sear" type="hidden" id="sear2" value="1"> 
      </td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
    <tr class=header> 
      <td width="5%" height="23"> <div align="center">�Ǹ�</div></td>
      <td width="17%"><div align="center">�s��(�I���d��)</div></td>
      <td width="17%"><div align="center">�q�ʮɶ�</div></td>
      <td width="12%"><div align="center">�`���B</div></td>
      <td width="14%"><div align="center">��I�覡</div></td>
      <td width="28%"><div align="center">���A</div></td>
      <td width="7%"><div align="center">�ާ@</div></td>
    </tr>
<?php
$todaytime=time();
$j=0;
while($r=$empire->fetch($sql))
{
	$j++;
	//�I���ʶR
	$total=0;
	if($r[payby]==1)
	{
		$total=$r[alltotalfen]+$r[pstotal];
		$mytotal="<a href='#ecms' title='�ӫ~�B(".$r[alltotalfen].")+�B�O(".$r[pstotal].")'>".$total." �I</a>";
	}
	else
	{
		//�o��
		$fpa='';
		$pre='';
		if($r[fp])
		{
			$fpa="+�o���O(".$r[fptotal].")";
		}
		//�u�f
		if($r['pretotal'])
		{
			$pre="-�u�f(".$r[pretotal].")";
		}
		$total=$r[alltotal]+$r[pstotal]+$r[fptotal]-$r[pretotal];
		$mytotal="<a href='#ecms' title='�ӫ~�B(".$r[alltotal].")+�B�O(".$r[pstotal].")".$fpa.$pre."'>".$total." ��</a>";
	}
	//��I�覡
	if($r[payby]==1)
	{
		$payfsname=$r[payfsname]."<br>(�I���ʶR)";
	}
	elseif($r[payby]==2)
	{
		$payfsname=$r[payfsname]."<br>(�l�B�ʶR)";
	}
	else
	{
		$payfsname=$r[payfsname];
	}
	//���A
	if($r['checked']==1)
	{
		$ch="�w�T�{";
	}
	elseif($r['checked']==2)
	{
		$ch="����";
	}
	elseif($r['checked']==3)
	{
		$ch="�h�f";
	}
	else
	{
		$ch="<font color=red>���T�{</font>";
	}
	if($r['outproduct']==1)
	{
		$ou="�w�o�f";
	}
	elseif($r['outproduct']==2)
	{
		$ou="�Ƴf��";
	}
	else
	{
		$ou="<font color=red>���o�f</font>";
	}
	if($r['haveprice']==1)
	{
		$ha="�w�I��";
	}
	else
	{
		$ha="<font color=red>���I��</font>";
	}
	//�ާ@
	$doing='<a href="../doaction.php?enews=DelDd&ddid='.$r[ddid].'" onclick="return confirm(\'�T�{�n�����H\');">����</a>';
	if($r['checked']||$r['outproduct']||$r['haveprice'])
	{
		$doing='--';
	}
	$dddeltime=$shoppr['dddeltime']*60;
	if($todaytime-$dddeltime>to_time($r['ddtime']))
	{
		$doing='--';
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center">
          <?=$j?>
          </div></td>
      <td> <div align="center"><a href="#ecms" onclick="window.open('../ShowDd/?ddid=<?=$r[ddid]?>','','width=700,height=600,scrollbars=yes,resizable=yes');"> 
          <?=$r[ddno]?>
          </a></div></td>
      <td> <div align="center"> 
          <?=$r[ddtime]?>
        </div></td>
      <td> <div align="center"> 
          <?=$mytotal?>
        </div></td>
      <td><div align="center"> 
          <?=$payfsname?>
        </div></td>
      <td> <div align="center"><strong> 
          <?=$ha?>
          </strong>/<strong> 
          <?=$ou?>
          </strong>/<strong> 
          <?=$ch?>
          </strong></div></td>
      <td><div align="center"><?=$doing?></div></td>
    </tr>
<?php
}
?>
    <tr bgcolor="#FFFFFF"> 
      <td> <div align="center"></div></td>
      <td colspan="6"> <div align="left">&nbsp; 
          <?=$returnpage?>
        </div></td>
    </tr>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>