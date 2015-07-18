<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/hShopSysFun.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//驗證權限
CheckLevel($logininid,$loginin,$classid,"public");
$r=$empire->fetch1("select * from {$dbtbpre}enewsshop_set limit 1");
//刷新表
$changetable='';
$i=0;
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	$i++;
	if($i%4==0)
	{
		$br="<br>";
	}
	else
	{
		$br="";
	}
	$checked='';
	if(stristr($r['shoptbs'],','.$tr[tbname].','))
	{
		$checked=' checked';
	}
	$changetable.="<input type=checkbox name=tbname[] value='$tr[tbname]'".$checked.">$tr[tname]&nbsp;&nbsp;".$br;
}
//權限
$shopddgroup='';
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[shopddgroupid]==$mgr[groupid])
	{
		$shopddgroup_select=' selected';
	}
	else
	{
		$shopddgroup_select='';
	}
	$shopddgroup.="<option value=".$mgr[groupid].$shopddgroup_select.">".$mgr[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>商城參數設置</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><p>位置：商城參數設置</p>
      </td>
  </tr>
</table>
<form name="plset" method="post" action="ecmsshop.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">商城參數設置 
        <input name=enews type=hidden value=SetShopSys></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	  <td height="25">指定使用商城功能的數據表</td>
	  <td width="81%"><?=$changetable?></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	  <td height="25">購買流程</td>
	  <td><select name="buystep" size="1" id="buystep">
	    <option value="0"<?=$r['buystep']==0?' selected':''?>>購物車 &gt; 聯繫方式+配送方式+支付方式 &gt; 確認訂單 &gt; 提交訂單</option>
		<option value="1"<?=$r['buystep']==1?' selected':''?>>購物車 &gt; 聯繫方式+配送方式+支付方式 &gt; 提交訂單</option>
		<option value="2"<?=$r['buystep']==2?' selected':''?>>聯繫方式+配送方式+支付方式 &gt; 提交訂單</option>
	    </select>	  </td>
    </tr>
	<tr bgcolor="#FFFFFF">
	  <td height="25">&nbsp;</td>
	  <td><input name="shoppsmust" type="checkbox" id="shoppsmust" value="1"<?=$r['shoppsmust']==1?' checked':''?>>
      顯示配送方式
      <input name="shoppayfsmust" type="checkbox" id="shoppayfsmust" value="1"<?=$r['shoppayfsmust']==1?' checked':''?>>
      顯示支付方式 <font color="#666666">(提交訂單時不顯示且為非必選項)</font></td>
    </tr>
	<tr bgcolor="#FFFFFF">
          <td height="25">提交訂單權限</td>
          <td><select name="shopddgroupid" id="shopddgroupid">
              <option value="0"<?=$r['shopddgroupid']==0?' selected':''?>>遊客</option>
			  <option value="1"<?=$r['shopddgroupid']==1?' selected':''?>>會員才能提交訂單</option>
            </select></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">購物車最大商品數</td>
          <td><input name="buycarnum" type="text" id="buycarnum" value="<?=$r[buycarnum]?>">
            <font color="#666666">(0為不限，為1時購物車會採用替換原商品方式)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">單商品最大購買數</td>
          <td><input name="singlenum" type="text" id="singlenum" value="<?=$r[singlenum]?>">
            <font color="#666666">(0為不限，限制訂單裡單個商品最大購買數量)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">滿多少金額免運費</td>
          <td><input name="freepstotal" type="text" id="freepstotal" value="<?=$r[freepstotal]?>">
            元
          <font color="#666666">(0為無免運費)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">購物車支持附加屬性</td>
          <td><input type="radio" name="haveatt" value="1"<?=$r['haveatt']==1?' checked':''?>>
開啟
  <input type="radio" name="haveatt" value="0"<?=$r['haveatt']==0?' checked':''?>>
關閉<font color="#666666">（加入商品可用「addatt」數組變量傳遞，例如：&amp;addatt[]=藍色）</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">會員可自己取消訂單的時間</td>
          <td><input name="dddeltime" type="text" id="dddeltime" value="<?=$r[dddeltime]?>">
            分鐘 <font color="#666666">(超過設定時間會員自己不能刪除訂單，0為不可刪除)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">庫存減少設置</td>
          <td><select name="cutnumtype" id="cutnumtype">
            <option value="0"<?=$r[cutnumtype]==0?' selected':''?>>下訂單時減少庫存</option>
            <option value="1"<?=$r[cutnumtype]==1?' selected':''?>>下訂單並支付時減少庫存</option>
          </select>          </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">未付款多少時間後還原庫存</td>
          <td><input name="cutnumtime" type="text" id="cutnumtime" value="<?=$r[cutnumtime]?>">
            分鐘 <font color="#666666">(0為不限，超過設定時間自動取消訂單，並還源庫存)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="22%" height="25">是否提供發票</td>
          <td><input name="havefp" type="checkbox" id="havefp" value="1"<?=$r[havefp]==1?' checked':''?>>
            是,收取 
            <input name="fpnum" type="text" id="fpnum" value="<?=$r[fpnum]?>" size="6">
            % 的發票費</td>
    </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">發票名稱<br>
          <br>
          <font color="#666666">(一行一個，比如：辦公用品)</font></td>
          <td><textarea name="fpname" cols="38" rows="8" id="fpname"><?=ehtmlspecialchars($r[fpname])?></textarea></td>
        </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">訂單必填項</td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="truename"<?=stristr($r['ddmust'],',truename,')?' checked':''?>>
            姓名</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="oicq"<?=stristr($r['ddmust'],',oicq,')?' checked':''?>>
            QQ</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="msn"<?=stristr($r['ddmust'],',msn,')?' checked':''?>>
            MSN</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="email"<?=stristr($r['ddmust'],',email,')?' checked':''?>>
            郵箱</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="mycall"<?=stristr($r['ddmust'],',mycall,')?' checked':''?>>
            固定電話</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="phone"<?=stristr($r['ddmust'],',phone,')?' checked':''?>>
            手機</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="address"<?=stristr($r['ddmust'],',address,')?' checked':''?>>
            聯繫地址</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="zip"<?=stristr($r['ddmust'],',zip,')?' checked':''?>>
郵編</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="signbuild"<?=stristr($r['ddmust'],',signbuild,')?' checked':''?>>
            標誌建築</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="besttime"<?=stristr($r['ddmust'],',besttime,')?' checked':''?>>
            送貨最佳時間</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="bz"<?=stristr($r['ddmust'],',bz,')?' checked':''?>> 
            備註</td>
        </tr>
      </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
