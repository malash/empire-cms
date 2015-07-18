<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='訂單列表';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../../member/cp/>會員中心</a>&nbsp;>&nbsp;訂單列表";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script src=../../data/images/setday.js></script>
<form name="form1" method="get" action="index.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
      <td>訂單號為: 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        時間從 
        <input name="starttime" type="text" id="starttime2" value="<?=$starttime?>" size="12" onclick="setday(this)">
        到 
        <input name="endtime" type="text" id="endtime2" value="<?=$endtime?>" size="12" onclick="setday(this)">
        止的訂單 
        <input type="submit" name="Submit6" value="搜索"> <input name="sear" type="hidden" id="sear2" value="1"> 
      </td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
    <tr class=header> 
      <td width="5%" height="23"> <div align="center">序號</div></td>
      <td width="17%"><div align="center">編號(點擊查看)</div></td>
      <td width="17%"><div align="center">訂購時間</div></td>
      <td width="12%"><div align="center">總金額</div></td>
      <td width="14%"><div align="center">支付方式</div></td>
      <td width="28%"><div align="center">狀態</div></td>
      <td width="7%"><div align="center">操作</div></td>
    </tr>
<?php
$todaytime=time();
$j=0;
while($r=$empire->fetch($sql))
{
	$j++;
	//點數購買
	$total=0;
	if($r[payby]==1)
	{
		$total=$r[alltotalfen]+$r[pstotal];
		$mytotal="<a href='#ecms' title='商品額(".$r[alltotalfen].")+運費(".$r[pstotal].")'>".$total." 點</a>";
	}
	else
	{
		//發票
		$fpa='';
		$pre='';
		if($r[fp])
		{
			$fpa="+發票費(".$r[fptotal].")";
		}
		//優惠
		if($r['pretotal'])
		{
			$pre="-優惠(".$r[pretotal].")";
		}
		$total=$r[alltotal]+$r[pstotal]+$r[fptotal]-$r[pretotal];
		$mytotal="<a href='#ecms' title='商品額(".$r[alltotal].")+運費(".$r[pstotal].")".$fpa.$pre."'>".$total." 元</a>";
	}
	//支付方式
	if($r[payby]==1)
	{
		$payfsname=$r[payfsname]."<br>(點數購買)";
	}
	elseif($r[payby]==2)
	{
		$payfsname=$r[payfsname]."<br>(餘額購買)";
	}
	else
	{
		$payfsname=$r[payfsname];
	}
	//狀態
	if($r['checked']==1)
	{
		$ch="已確認";
	}
	elseif($r['checked']==2)
	{
		$ch="取消";
	}
	elseif($r['checked']==3)
	{
		$ch="退貨";
	}
	else
	{
		$ch="<font color=red>未確認</font>";
	}
	if($r['outproduct']==1)
	{
		$ou="已發貨";
	}
	elseif($r['outproduct']==2)
	{
		$ou="備貨中";
	}
	else
	{
		$ou="<font color=red>未發貨</font>";
	}
	if($r['haveprice']==1)
	{
		$ha="已付款";
	}
	else
	{
		$ha="<font color=red>未付款</font>";
	}
	//操作
	$doing='<a href="../doaction.php?enews=DelDd&ddid='.$r[ddid].'" onclick="return confirm(\'確認要取消？\');">取消</a>';
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