<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$buycar=getcvar('mybuycar');
if(empty($buycar))
{
	printerror('你的購物車沒有商品','',1,0,1);
}
$record="!";
$field="|";
$totalmoney=0;	//商品總金額
$buytype=0;	//支付類型：1為金額,0為點數
$totalfen=0;	//商品總積分
$classids='';	//欄目集合
$cdh='';
$buycarr=explode($record,$buycar);
$bcount=count($buycarr);
?>
<table width="100%" border=0 align=center cellpadding=3 cellspacing=1>
<tr class="header"> 
	<td width="41%" height=23><div align="center">商品名稱</div></td>
	<td width="15%"><div align="center">市場價格</div></td>
	<td width="15%"><div align="center">優惠價格</div></td>
	<td width="8%"><div align="center">數量</div></td>
	<td width="21%"><div align="center">小計</div></td>
</tr>
<?php
for($i=0;$i<$bcount-1;$i++)
{
	$pr=explode($field,$buycarr[$i]);
	$productid=$pr[1];
	$fr=explode(",",$pr[1]);
	//ID
	$classid=(int)$fr[0];
	$id=(int)$fr[1];
	if(empty($class_r[$classid][tbname]))
	{
		continue;
	}
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
	//取得產品信息
	$productr=$empire->fetch1("select title,tprice,price,isurl,titleurl,classid,id,titlepic,buyfen from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where id='$id' limit 1");
	if(!$productr['id']||$productr['classid']!=$classid)
	{
		continue;
	}
	//是否全部點數
	if(!$productr[buyfen])
	{
		$buytype=1;
	}
	$thistotalfen=$productr[buyfen]*$pnum;
	$totalfen+=$thistotalfen;
	//產品圖片
	if(empty($productr[titlepic]))
	{
		$productr[titlepic]="../../data/images/notimg.gif";
	}
	//返回鏈接
	$titleurl=sys_ReturnBqTitleLink($productr);
	$thistotal=$productr[price]*$pnum;
	$totalmoney+=$thistotal;
	//欄目集合
	$classids.=$cdh.$productr['classid'];
	$cdh=',';
?>
<tr>
	<td align="center" height=23><a href="<?=$titleurl?>" target="_blank"><?=$productr[title]?></a><?=$addatt?' - '.$addatt:''?></td>
	<td align="right">￥<?=$productr[tprice]?></td>
	<td align="right"><b>￥<?=$productr[price]?></b></td>
	<td align="right"><?=$pnum?></td>
	<td align="right">￥<?=$thistotal?></td>
</tr>
<?php
}
?>
<?php
if(!$buytype)//點數付費
{
?>
<tr height="25"> 
    <td colspan="5"><div align="right">合計點數:<strong><?=$totalfen?></strong></div></td>
</tr>
<?php
}
else
{
?>
<tr height="27"> 
    <td colspan="5"><div align="right">合計:<strong>￥<?=$totalmoney?></strong></div></td>
</tr>
<?php
}
?>
</table>
