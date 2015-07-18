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
CheckLevel($logininid,$loginin,$classid,"shopdd");
$enews=ehtmlspecialchars($_GET['enews']);
$url="查看訂單";
$ddid=(int)$_GET['ddid'];
if(!$ddid)
{
	printerror('ErrorUrl','');
}
$r=$empire->fetch1("select * from {$dbtbpre}enewsshopdd where ddid='$ddid'");
if(!$r['ddid'])
{
	printerror('ErrorUrl','');
}
$addr=$empire->fetch1("select * from {$dbtbpre}enewsshopdd_add where ddid='$ddid'");
//提交者
if(empty($r[userid]))//非會員
{
	$username="<font color=cccccc>遊客</font>";
}
else
{
	$username="<a href='../member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target=_blank>".$r[username]."</a>";
}
//需要發票
$fp="否";
if($r[fp])
{
	$fp="是";
}
//金額
$total=0;
if($r[payby]==1)
{
	$pstotal=$r[pstotal]." 點";
	$alltotal=$r[alltotalfen]." 點";
	$total=$r[pstotal]+$r[alltotalfen];
	$mytotal=$total." 點";
}
else
{
	$pstotal=$r[pstotal]." 元";
	$alltotal=$r[alltotal]." 元";
	$total=$r[pstotal]+$r[alltotal]+$r[fptotal]-$r[pretotal];
	$mytotal=$total." 元";
}
//支付方式
if($r[payby]==1)
{
	$payfsname=$r[payfsname]."(積分購買)";
}
elseif($r[payby]==2)
{
	$payfsname=$r[payfsname]."(餘額購買)";
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
//發貨
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
//顯示商品信息
function ShowBuyproduct($buycar,$payby){
	global $empire,$dbtbpre;
	$record="!";
	$field="|";
	$buycarr=explode($record,$buycar);
	$bcount=count($buycarr);
	$totalmoney=0;
	$totalfen=0;
	?>
	<table width='100%' border=0 align=center cellpadding=3 cellspacing=1>
        <tr class='header'> 
            <td width='9%' height=23> <div align=center>序號</div></td>
            <td width='42%'> <div align=center>商品名稱</div></td>
            <td width='15%'> <div align=center>單價</div></td>
            <td width='10%'> <div align=center>數量</div></td>
            <td width='19%'> <div align=center>小計</div></td>
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
		if(empty($pnum))
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
	<td align=center><?=$j?></td>
	<td align=center><a href="<?=$titleurl?>" target="_blank"><?=$title?></a><?=$addatt?' - '.$addatt:''?></td>
	<td align=right><b>￥<?=$showprice?></b></td>
	<td align=right><?=$pnum?></td>
	<td align=right><?=$showthistotal?></td>
	</tr>
		<?php
    }
	//點數付費
	if($payby==1)
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
	<?php
}

//------ 操作日誌 ------
//操作事件

$shopecms_r=array
(
	'SetChecked'=>'設置訂單狀態',
	'SetOutProduct'=>'設置發貨狀態',
	'SetHaveprice'=>'設置付款狀態',
	'DelDd'=>'刪除訂單',
	'EditPretotal'=>'修改優惠金額',
	'DdRetext'=>'修改後台訂單備註',
	'DoCutMaxnum'=>'設置庫存',
);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
<form name="showddform" id="showddform" method="post" action="ecmsshop.php" onsubmit="return confirm('確認要操作?');">
<?=$ecms_hashur['form']?>
  <input name="enews" type="hidden" id="enews" value="DdRetext">
  <input name="ddid" type="hidden" id="ddid" value="<?=$ddid?>">
  <tr> 
    <td width="61%" height="27" bgcolor="#FFFFFF"><strong>訂單ID: 
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
	  ShowBuyproduct($addr[buycar],$r[payby]);
	  ?>    </td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>訂單信息</strong></td>
  </tr>
  <tr> 
    <td height="23" colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        
        <tr>
          <td height="25"><div align="right">提交者：</div></td>
          <td><?=$username?></td>
          <td><div align="right">提交者IP地址：</div></td>
          <td><strong>
            <?=$r[userip]?>
          </strong></td>
        </tr>
        <tr> 
          <td width="15%" height="25"> 
            <div align="right">訂單號：</div></td>
          <td width="35%"><strong> 
            <?=$r[ddno]?>
            </strong></td>
          <td width="15%"><div align="right">訂單狀態：</div></td>
          <td width="35%"><strong> 
            <?=$ha?>
            </strong>/<strong> 
            <?=$ou?>
            </strong>/<strong> 
            <?=$ch?>
            </strong></td>
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
          <td height="25">手機:</td>
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
          <td height="25">最佳送貨時間:</td>
          <td><?=$r[besttime]?></td>
        </tr>
        <tr> 
          <td height="25">備註:</td>
          <td> 
            <?=nl2br($addr[bz])?>          </td>
        </tr>
      </table></td>
  </tr>
  <tbody id="pdiv">
  <tr>
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>相關操作</strong></td>
  </tr>
  <tr>
    <td height="23" colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="16%">後台備註內容:<br>
          <br>
          <font color="#666666">(前台會員可查看，比如提供快遞號等信息)</font></td>
        <td width="77%"><textarea name="retext" cols="65" rows="6" id="retext"><?=$addr['retext']?></textarea></td>
        <td width="7%"><input type="submit" name="Submit2" value="提交" onClick="document.showddform.enews.value='DdRetext';"></td>
      </tr>
      <tr>
        <td height="25">修改優惠金額：</td>
        <td><input name="pretotal" type="text" id="pretotal" value="<?=$r[pretotal]?>">
        修改原因：
          <input name="bz" type="text" id="bz"></td>
        <td><input type="submit" name="Submit3" value="提交" onClick="document.showddform.enews.value='EditPretotal';"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>訂單操作日誌</strong></td>
  </tr>
  <tr>
    <td height="23" colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
      <tr class="header">
        <td width="21%" height="23"><div align="center">操作時間</div></td>
        <td width="17%"><div align="center">操作者</div></td>
        <td width="19%"><div align="center">事件</div></td>
        <td width="19%"><div align="center">操作內容</div></td>
        <td width="24%"><div align="center">操作原因</div></td>
      </tr>
	  <?php
	  $logsql=$empire->query("select logid,userid,username,ecms,bz,addbz,logtime from {$dbtbpre}enewsshop_ddlog where ddid='$ddid' order by logid desc");
	  while($logr=$empire->fetch($logsql))
	  {
		  $empirecms=$shopecms_r[$logr['ecms']];
		  if($logr['ecms']=='DoCutMaxnum')
		  {
			  $logr['addbz']=$logr['addbz']=='ecms=1'?'還原庫存':'減少庫存';
		  }
	  ?>
      <tr bgcolor="#ffffff">
        <td height="23"><div align="center"><?=$logr['logtime']?></div></td>
        <td><div align="center"><?=$logr['username']?></div></td>
        <td><div align="center"><?=$empirecms?></div></td>
        <td><?=$logr['addbz']?></td>
        <td><?=$logr['bz']?></td>
      </tr>
      <?php
	  }
	  ?>
    </table></td>
  </tr>
  <tr> 
    <td colspan="2"><div align="center"> 
        <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td><div align="center">
                <input type="button" name="Submit" value=" 打 印 " onclick="javascript:PrintDd();">
              </div></td>
          </tr>
        </table>
      </div></td>
  </tr>
  </tbody>
 </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>