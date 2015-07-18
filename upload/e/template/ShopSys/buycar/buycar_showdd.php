<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$record="!";
$field="|";
$totalmoney=0;
$totalfen=0;
$buycarr=explode($record,$buycar);
$bcount=count($buycarr);
?>
<table width="100%" border=0 align=center cellpadding=3 cellspacing=1>
<tr class="header"> 
	<td width="9%" height=23><div align=center>序號</div></td>
	<td width="43%"><div align=center>商品名稱</div></td>
	<td width="19%"><div align=center>單價</div></td>
	<td width="10%"><div align=center>數量</div></td>
	<td width="19%"><div align=center>小計</div></td>
</tr>
<?php
$j=0;
for($i=0;$i<$bcount-1;$i++)
{
	$j++;
	$pr=explode($field,$buycarr[$i]);
	$productid=$pr[1];
	$fr=explode(",",$pr[1]);
	//ID
	$classid=(int)$fr[0];
	$id=(int)$fr[1];
	//屬性
	$addatt='';
	if($pr[2])
	{
		$addatt=$pr[2];
	}
	//數量
	$pnum=(int)$pr[3];
	if($pnum<1)
	{
		$pnum=1;
	}
	//單價
	$price=$pr[4];
	$thistotal=$price*$pnum;
	$buyfen=$pr[5];
	$thistotalfen=$buyfen*$pnum;
	if($payby==1)
	{
		$showprice=$buyfen." 點";
		$showthistotal=$thistotalfen." 點";
	}
	else
	{
		$showprice=$price." 元";
		$showthistotal=$thistotal." 元";
	}
	//產品名稱
	$title=stripSlashes($pr[6]);
	//返回鏈接
	$titleurl="../../public/InfoUrl/?classid=$classid&id=$id";
	$totalmoney+=$thistotal;
	$totalfen+=$thistotalfen;
?>
<tr>
	<td align="center"><?=$j?></td>
	<td align="center"><a href="<?=$titleurl?>" target="_blank"><?=$title?></a><?=$addatt?' - '.$addatt:''?></td>
	<td align="right"><b>￥<?=$showprice?></b></td>
	<td align="right"><?=$pnum?></td>
	<td align="right"><?=$showthistotal?></td>
</tr>
<?php
}
?>
<?php
if($payby==1)//點數付費
{
?>
<tr> 
	<td colspan=5><div align=right>合計點數:<strong><?=$totalfen?></strong></div></td>
	<td>&nbsp;</td>
</tr>
<?php
}
else
{
?>
<tr> 
     <td colspan=5><div align=right>合計:<strong>￥<?=$totalmoney?></strong></div></td>
     <td>&nbsp;</td>
</tr>
<?php
}
?>
</table>
