<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../data/dbcache/class.php");
require "../".LoadLang("pub/fun.php");
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

//訂單設定
function SetShopDd($add,$userid,$username){
	global $empire,$dbtbpre;
	//驗證權限
	CheckLevel($userid,$username,$classid,"shopdd");
	$ddid=$add['ddid'];
	$doing=$add['doing'];
	$checked=(int)$add['checked'];
	$haveprice=(int)$add['haveprice'];
	$outproduct=(int)$add['outproduct'];
	$count=count($ddid);
	if(empty($count))
	{
		printerror("NotSetDdid","history.go(-1)");
	}
	$shoppr=ShopSys_hReturnSet();
	$add='';
	$ids='';
	$dh='';
	for($i=0;$i<$count;$i++)
	{
		$ddid[$i]=(int)$ddid[$i];
		$ids.=$dh.$ddid[$i];
		$dh=',';
    }
	$add='ddid in ('.$ids.')';
	$mess='ErrorUrl';
	$log='';
	if($doing==1)	//訂單狀態
	{
		$sql=$empire->query("update {$dbtbpre}enewsshopdd set checked='$checked' where ".$add);
		$mess="SetCheckedSuccess";
		$log="doing=$doing&do=SetChecked&checked=$checked<br>ddid=$ids";
		//訂單日誌
		$log_ecms='SetChecked';
		$log_bz='';
		if($checked==1)
		{
			$log_addbz='確認';
		}
		elseif($checked==2)
		{
			$log_addbz='取消';
		}
		elseif($checked==3)
		{
			$log_addbz='退貨';
		}
		elseif($checked==0)
		{
			$log_addbz='未確認';
		}
		//寫入訂單日誌
		if($ids)
		{
			$logsql=$empire->query("select ddid,havecutnum from {$dbtbpre}enewsshopdd where ".$add);
			while($logr=$empire->fetch($logsql))
			{
				ShopSys_DdInsertLog($logr['ddid'],$log_ecms,$log_bz,$log_addbz);//訂單日誌
				//庫存
				if($shoppr['cutnumtype']==0&&$checked==2&&$logr['havecutnum'])
				{
					$ddaddr=$empire->fetch1("select buycar from {$dbtbpre}enewsshopdd_add where ddid='$logr[ddid]'");
					Shopsys_hCutMaxnum($logr['ddid'],$ddaddr['buycar'],$logr['havecutnum'],$shoppr,1);
				}
			}
		}
    }
	elseif($doing==2)	//發貨狀態
	{
		$sql=$empire->query("update {$dbtbpre}enewsshopdd set outproduct='$outproduct' where ".$add);
		$mess="SetOutProductSuccess";
		$log="doing=$doing&do=SetOutProduct&outproduct=$outproduct<br>ddid=$ids";
		//訂單日誌
		$log_ecms='SetOutProduct';
		$log_bz='';
		if($outproduct==1)
		{
			$log_addbz='已發貨';
		}
		elseif($outproduct==2)
		{
			$log_addbz='備貨中';
		}
		elseif($outproduct==0)
		{
			$log_addbz='未發貨';
		}
		//寫入訂單日誌
		if($ids)
		{
			$logsql=$empire->query("select ddid from {$dbtbpre}enewsshopdd where ".$add);
			while($logr=$empire->fetch($logsql))
			{
				ShopSys_DdInsertLog($logr['ddid'],$log_ecms,$log_bz,$log_addbz);//訂單日誌
			}
		}
    }
	elseif($doing==3)	//付款狀態
	{
		$sql=$empire->query("update {$dbtbpre}enewsshopdd set haveprice='$haveprice' where ".$add);
		$mess="SetHavepriceSuccess";
		$log="doing=$doing&do=SetHaveprice&haveprice=$haveprice<br>ddid=$ids";
		//訂單日誌
		$log_ecms='SetHaveprice';
		$log_bz='';
		if($haveprice==1)
		{
			$log_addbz='已付款';
		}
		elseif($haveprice==0)
		{
			$log_addbz='未付款';
		}
		//寫入訂單日誌
		if($ids)
		{
			$logsql=$empire->query("select ddid,havecutnum from {$dbtbpre}enewsshopdd where ".$add);
			while($logr=$empire->fetch($logsql))
			{
				ShopSys_DdInsertLog($logr['ddid'],$log_ecms,$log_bz,$log_addbz);//訂單日誌
				//庫存
				if($shoppr['cutnumtype']==1&&$haveprice==1&&!$logr['havecutnum'])
				{
					$ddaddr=$empire->fetch1("select buycar from {$dbtbpre}enewsshopdd_add where ddid='$logr[ddid]'");
					Shopsys_hCutMaxnum($logr['ddid'],$ddaddr['buycar'],$logr['havecutnum'],$shoppr,0);
				}
			}
		}
    }
	elseif($doing==4)	//刪除訂單
	{
		$log_ecms='DelDd';
		$log_bz='';
		$log_addbz='';
		//庫存
		if($ids)
		{
			$logsql=$empire->query("select ddid,havecutnum,checked,haveprice from {$dbtbpre}enewsshopdd where ".$add." and havecutnum=1");
			while($logr=$empire->fetch($logsql))
			{
				if($logr['haveprice']==1)
				{
					continue;
				}
				if($logr['havecutnum'])
				{
					$ddaddr=$empire->fetch1("select buycar from {$dbtbpre}enewsshopdd_add where ddid='$logr[ddid]'");
					Shopsys_hCutMaxnum($logr['ddid'],$ddaddr['buycar'],$logr['havecutnum'],$shoppr,1);
				}
			}
		}
		$sql=$empire->query("delete from {$dbtbpre}enewsshopdd where ".$add);
		$sql2=$empire->query("delete from {$dbtbpre}enewsshopdd_add where ".$add);
		$sql3=$empire->query("delete from {$dbtbpre}enewsshop_ddlog where ".$add);
		$mess="DelDdSuccess";
		$log="doing=$doing&do=DelDd<br>ddid=$ids";
    }
	else
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	if($sql)
	{
		//操作日誌
		insert_dolog($log);
		printerror($mess,$_SERVER['HTTP_REFERER']);
	}
	else
	{printerror("DbError","history.go(-1)");}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="SetShopDd")
{
	SetShopDd($_POST,$logininid,$loginin);
}
else
{}

//更新庫存
$shoppr=ShopSys_hReturnSet();
ShopSys_hTimeCutMaxnum(0,$shoppr);

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=18;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$totalquery="select count(*) as total from {$dbtbpre}enewsshopdd";
$query="select ddid,ddno,ddtime,userid,username,outproduct,haveprice,checked,truename,psid,psname,pstotal,alltotal,payfsid,payfsname,payby,alltotalfen,fp,fptotal,pretotal from {$dbtbpre}enewsshopdd";
$add='';
$and=' where ';
//搜索
$sear=RepPostStr($_GET['sear'],1);
if($sear)
{
	$keyboard=$_GET['keyboard'];
	$keyboard=RepPostVar2($keyboard);
	if($keyboard)
	{
		$show=(int)$_GET['show'];
		if($show==1)//搜索訂單號
		{
			$add=$and."ddno like '%$keyboard%'";
		}
		elseif($show==2)//用戶名
		{
			$add=$and."username like '%$keyboard%'";
		}
		elseif($show==3)//姓名
		{
			$add=$and."truename like '%$keyboard%'";
		}
		elseif($show==4)//郵箱
		{
			$add=$and."email like '%$keyboard%'";
		}
		else//地址
		{
			$add=$and."address like '%$keyboard%'";
		}
		$and=' and ';
	}
	//訂單狀態
	$checked=(int)$_GET['checked'];
	if($checked==1)//已確認
	{
		$add.=$and."checked=1";
		$and=' and ';
	}
	elseif($checked==9)//未確認
	{
		$add.=$and."checked=0";
		$and=' and ';
	}
	elseif($checked==2)//取消
	{
		$add.=$and."checked=2";
		$and=' and ';
	}
	elseif($checked==3)//退貨
	{
		$add.=$and."checked=3";
		$and=' and ';
	}
	//是否付款
	$haveprice=(int)$_GET['haveprice'];
	if($haveprice==1)//已付款
	{
		$add.=$and."haveprice=1";
		$and=' and ';
	}
	elseif($haveprice==9)//未付款
	{
		$add.=$and."haveprice=0";
		$and=' and ';
	}
	//是否發貨
	$outproduct=(int)$_GET['outproduct'];
	if($outproduct==1)//已發貨
	{
		$add.=$and."outproduct=1";
		$and=' and ';
	}
	elseif($outproduct==9)//未發貨
	{
		$add.=$and."outproduct=0";
		$and=' and ';
	}
	elseif($outproduct==2)//備貨中
	{
		$add.=$and."outproduct=2";
		$and=' and ';
	}
	//時間
	$starttime=RepPostVar($_GET['starttime']);
	$endtime=RepPostVar($_GET['endtime']);
	if($endtime!="")
	{
		$ostarttime=$starttime." 00:00:00";
		$oendtime=$endtime." 23:59:59";
		$add.=$and."ddtime>='$ostarttime' and ddtime<='$oendtime'";
		$and=' and ';
	}
	$search.="&sear=1&keyboard=$keyboard&show=$show&checked=$checked&outproduct=$outproduct&haveprice=$haveprice&starttime=$starttime&endtime=$endtime";
}
//排序
$myorder=(int)$_GET['myorder'];
if($myorder==2)//商品金額
{
	$orderby='alltotal desc';
}
elseif($myorder==3)
{
	$orderby='alltotal asc';
}
elseif($myorder==4)//商品點數
{
	$orderby='alltotalfen desc';
}
elseif($myorder==5)
{
	$orderby='alltotalfen asc';
}
elseif($myorder==6)//優惠金額
{
	$orderby='pretotal desc';
}
elseif($myorder==7)
{
	$orderby='pretotal asc';
}
elseif($myorder==1)//訂單時間
{
	$orderby='ddid asc';
}
else
{
	$orderby='ddid desc';
}
$totalquery.=$add;
$query.=$add;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by ".$orderby." limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理訂單</title>
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<a href="ListDd.php<?=$ecms_hashur['whehref']?>">管理訂單</a></td>
  </tr>
</table>

  
<form name="form1" method="get" action="ListDd.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td>搜索: <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>"> 
        <select name="show" id="show">
          <option value="1"<?=$show==1?' selected':''?>>訂單號</option>
          <option value="2"<?=$show==2?' selected':''?>>用戶名</option>
		  <option value="3"<?=$show==3?' selected':''?>>收貨人姓名</option>
		  <option value="4"<?=$show==4?' selected':''?>>收貨人郵箱</option>
		  <option value="5"<?=$show==5?' selected':''?>>收貨人地址</option>
        </select> 
        <select name="checked" id="checked">
          <option value="0"<?=$checked==0?' selected':''?>>不限訂單狀態</option>
          <option value="1"<?=$checked==1?' selected':''?>>已確認</option>
          <option value="9"<?=$checked==9?' selected':''?>>未確認</option>
		  <option value="2"<?=$checked==2?' selected':''?>>取消</option>
		  <option value="3"<?=$checked==3?' selected':''?>>退貨</option>
        </select> 
        <select name="outproduct" id="outproduct">
          <option value="0"<?=$outproduct==0?' selected':''?>>不限發貨狀態</option>
          <option value="1"<?=$outproduct==1?' selected':''?>>已發貨</option>
          <option value="9"<?=$outproduct==9?' selected':''?>>未發貨</option>
		  <option value="2"<?=$outproduct==2?' selected':''?>>備貨中</option>
        </select>
        <select name="haveprice" id="haveprice">
          <option value="0"<?=$haveprice==0?' selected':''?>>不限付款狀態</option>
          <option value="1"<?=$haveprice==1?' selected':''?>>已付款</option>
          <option value="9"<?=$haveprice==9?' selected':''?>>未付款</option>
        </select>
        <select name="myorder" id="myorder">
          <option value="0"<?=$myorder==0?' selected':''?>>訂單時間降序</option>
          <option value="1"<?=$myorder==1?' selected':''?>>訂單時間升序</option>
          <option value="2"<?=$myorder==2?' selected':''?>>商品金額降序</option>
          <option value="3"<?=$myorder==3?' selected':''?>>商品金額升序</option>
          <option value="4"<?=$myorder==4?' selected':''?>>商品點數降序</option>
          <option value="5"<?=$myorder==5?' selected':''?>>商品點數升序</option>
          <option value="6"<?=$myorder==6?' selected':''?>>優惠金額升序</option>
          <option value="7"<?=$myorder==7?' selected':''?>>優惠金額降序</option>
        </select></td>
    </tr>
    <tr>
      <td>時間:從 
        <input name="starttime" type="text" id="starttime2" value="<?=$starttime?>" size="12" onclick="setday(this)">
        到 
        <input name="endtime" type="text" id="endtime2" value="<?=$endtime?>" size="12" onclick="setday(this)">
        止的訂單 
        <input type="submit" name="Submit6" value="搜索"> <input name="sear" type="hidden" id="sear2" value="1"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
  <form name="listdd" method="post" action="ListDd.php" onsubmit="return confirm('確認要操作?');">
  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=SetShopDd>
    <input type=hidden name=doing value=0>
    <tr class=header> 
      <td width="5%" height="23"> <div align="center">選擇</div></td>
      <td width="19%"><div align="center">編號(點擊查看)</div></td>
      <td width="21%"><div align="center">訂購時間</div></td>
      <td width="13%"><div align="center">訂購者</div></td>
      <td width="11%"><div align="center">總金額</div></td>
      <td width="12%"><div align="center">支付方式</div></td>
      <td width="19%"><div align="center">狀態</div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		if(empty($r[userid]))//非會員
		{
			$username="<font color=cccccc>".$r[truename]."</font>";
		}
		else
		{
			$username="<a href='../member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target=_blank>".$r[username]."</a>";
		}
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
		//訂單狀態
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
		//發貨狀態
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
		//付款狀態
		if($r['haveprice']==1)
		{
			$ha="已付款";
		}
		else
		{
			$ha="<font color=red>未付款</font>";
		}
	?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"> <div align="center"> 
          <input name="ddid[]" type="checkbox" id="ddid[]" value="<?=$r[ddid]?>">
        </div></td>
      <td> <div align="center"><a href="#ecms" onclick="window.open('ShowDd.php?ddid=<?=$r[ddid]?><?=$ecms_hashur['ehref']?>','','width=700,height=600,scrollbars=yes,resizable=yes');">
          <?=$r[ddno]?>
          </a></div></td>
      <td> <div align="center">
          <?=$r[ddtime]?>
        </div></td>
      <td> <div align="center">
          <?=$username?>
        </div></td>
      <td> <div align="center">
          <?=$mytotal?>
        </div></td>
      <td><div align="center">
          <?=$payfsname?>
        </div></td>
      <td> <div align="center"><strong><?=$ha?></strong>/<strong><?=$ou?></strong>/<strong><?=$ch?></strong></div></td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td> <div align="center"> 
          <input type=checkbox name=chkall value=on onClick='CheckAll(this.form)'>
        </div></td>
      <td colspan="6"><select name="checked" id="checked">
        <option value="1">確認</option>
        <option value="2">取消</option>
        <option value="3">退貨</option>
        <option value="0">未確認</option>
      </select>
      <input type="submit" name="Submit" value="設置訂單狀態" onClick="document.listdd.doing.value='1';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';"> 
        &nbsp;
        <select name="outproduct" id="outproduct">
          <option value="1">已發貨</option>
          <option value="2">備貨中</option>
          <option value="0">未發貨</option>
        </select> 
        <input type="submit" name="Submit2" value="設置發貨狀態" onClick="document.listdd.doing.value='2';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';"> 
        &nbsp;
        <select name="haveprice" id="haveprice">
          <option value="1">已付款</option>
          <option value="0">未付款</option>
        </select> 
        <input type="submit" name="Submit3" value="設置付款狀態" onClick="document.listdd.doing.value='3';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';">
&nbsp;
<select name="cutmaxnum" id="cutmaxnum">
  <option value="1">還原庫存</option>
  <option value="0">減少庫存</option>
</select>
<input type="submit" name="Submit32" value="設置庫存" onClick="document.listdd.doing.value='5';document.listdd.enews.value='DoCutMaxnum';document.listdd.action='ecmsshop.php';">
        &nbsp; 
		<input type="submit" name="Submit5" value="刪除訂單" onClick="document.listdd.doing.value='4';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td> <div align="center"></div></td>
      <td colspan="6"> <div align="left">&nbsp;
          <?=$returnpage?>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>&nbsp;</td>
      <td colspan="6"><font color="#666666">訂購者為灰色,則為非會員購買；退貨不自動還原庫存，需手動還原庫存；已還原過的庫存系統不會重複還原。</font></td>
    </tr>
  </form>
</table>

</body>
</html>
<?php
db_close();
$empire=null;
?>
