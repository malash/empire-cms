<?php
define('EmpireCMSAdmin','1');
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/functions.php');
require '../'.LoadLang('pub/fun.php');
require('../../data/dbcache/class.php');
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

$ztid=(int)$_GET['ztid'];
if(empty($ztid))
{
	$ztid=(int)$_POST['ztid'];
}
//驗證權限
//CheckLevel($logininid,$loginin,$classid,"zt");
$returnandlevel=CheckAndUsernamesLevel('dozt',$ztid,$logininid,$loginin,$loginlevel);

//刪除專題信息
function DoDelZtInfo($add,$userid,$username){
	global $empire,$dbtbpre;
	//CheckLevel($userid,$username,$classid,"zt");
	$ztid=(int)$add['ztid'];
	$zid=$add['zid'];
	$count=count($zid);
	if(!$count||!$ztid)
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	$ztr=$empire->fetch1("select ztid from {$dbtbpre}enewszt where ztid='$ztid'");
	if(!$ztr['ztid'])
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	$zids=eArrayReturnInids($zid);
	DelZtInfo("zid in (".$zids.") and ztid='$ztid'");
	insert_dolog("ztid=$ztid");//操作日誌
	printerror('DelZtInfoSuccess',$_SERVER['HTTP_REFERER']);
}

//轉移專題信息
function DoMoveZtInfo($add,$userid,$username){
	global $empire,$dbtbpre;
	//CheckLevel($userid,$username,$classid,"zt");
	$ztid=(int)$add['ztid'];
	$to_cid=(int)$add['to_cid'];
	$zid=$add['zid'];
	$count=count($zid);
	if(!$count||!$ztid)
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	if(!$to_cid)
	{
		printerror('EmptyMoveZtInfoCid','history.go(-1)');
	}
	$ztr=$empire->fetch1("select ztid from {$dbtbpre}enewszt where ztid='$ztid'");
	if(!$ztr['ztid'])
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	$zids=eArrayReturnInids($zid);
	$sql=$empire->query("update {$dbtbpre}enewsztinfo set cid='$to_cid' where zid in (".$zids.") and ztid='$ztid'");
	if($sql)
	{
		insert_dolog("ztid=$ztid&to_cid=$to_cid");//操作日誌
		printerror('MoveZtInfoSuccess',$_SERVER['HTTP_REFERER']);
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//推薦專題信息
function DoGoodZtInfo($add,$userid,$username){
	global $empire,$dbtbpre;
	//CheckLevel($userid,$username,$classid,"zt");
	$ztid=(int)$add['ztid'];
	$doing=(int)$add['doing'];
	$isgood=(int)$add['isgood'];
	$zid=$add['zid'];
	$count=count($zid);
	if(!$count||!$ztid)
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	$ztr=$empire->fetch1("select ztid from {$dbtbpre}enewszt where ztid='$ztid'");
	if(!$ztr['ztid'])
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	$zids=eArrayReturnInids($zid);
	$sql=$empire->query("update {$dbtbpre}enewsztinfo set isgood='$isgood' where zid in (".$zids.") and ztid='$ztid'");
	if($sql)
	{
		insert_dolog("ztid=$ztid&isgood=$isgood");//操作日誌
		printerror('GoodZtInfoSuccess',$_SERVER['HTTP_REFERER']);
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//修改專題信息發佈時間
function DoEditZtInfoTime($add,$userid,$username){
	global $empire,$dbtbpre;
	//CheckLevel($userid,$username,$classid,"zt");
	$ztid=(int)$add['ztid'];
	$zid=$add['dozid'];
	$count=count($zid);
	$newstime=$add['newstime'];
	if(!$count||!$ztid)
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	$ztr=$empire->fetch1("select ztid from {$dbtbpre}enewszt where ztid='$ztid'");
	if(!$ztr['ztid'])
	{
		printerror('EmptyZtInfoZid','history.go(-1)');
	}
	for($i=0;$i<$count;$i++)
	{
		$dozid=(int)$zid[$i];
		$donewstime=$newstime[$i]?to_time($newstime[$i]):time();
		$empire->query("update {$dbtbpre}enewsztinfo set newstime='$donewstime' where zid='$dozid' and ztid='$ztid'");
	}
	insert_dolog("ztid=$ztid");//操作日誌
	printerror('EditZtInfoTimeSuccess',$_SERVER['HTTP_REFERER']);
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="DoDelZtInfo")//刪除專題信息
{
	DoDelZtInfo($_POST,$logininid,$loginin);
}
elseif($enews=="DoMoveZtInfo")//轉移專題信息
{
	DoMoveZtInfo($_POST,$logininid,$loginin);
}
elseif($enews=="DoGoodZtInfo")//推薦專題信息
{
	DoGoodZtInfo($_POST,$logininid,$loginin);
}
elseif($enews=="DoEditZtInfoTime")//修改專題信息發佈時間
{
	DoEditZtInfoTime($_POST,$logininid,$loginin);
}
else
{}


//專題
if(!$ztid)
{
	printerror('ErrorUrl','');
}
$ztr=$empire->fetch1("select ztid,ztname from {$dbtbpre}enewszt where ztid='$ztid'");
if(!$ztr['ztid'])
{
	printerror('ErrorUrl','');
}

$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=intval($public_r['hlistinfonum']);//每頁顯示
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$add='';
$search='&ztid='.$ztid.$ecms_hashur['ehref'];
//專題子類
$cid=(int)$_GET['cid'];
if($cid)
{
	$add.=" and cid='$cid'";
	$search.='&cid='.$cid;
}
//系統模型
$mid=(int)$_GET['mid'];
if($mid)
{
	$add.=" and mid='$mid'";
	$search.='&mid='.$mid;
}
//欄目
$classid=(int)$_GET['classid'];
if($classid)
{
	$add.=' and '.($class_r[$classid][islast]?"classid='$classid'":"(".ReturnClass($class_r[$classid][sonclass]).")");
	$search.='&classid='.$classid;
}
//推薦
$isgood=(int)$_GET['isgood'];
if($isgood)
{
	$add.=" and isgood>0";
	$search.='&isgood='.$isgood;
}
//排序
$myorder=(int)$_GET['myorder'];
$search.='&myorder='.$myorder;
if($myorder==1)
{
	$doorder='zid desc';
}
elseif($myorder==2)
{
	$doorder='zid asc';
}
elseif($myorder==3)
{
	$doorder='newstime desc';
}
elseif($myorder==4)
{
	$doorder='newstime asc';
}
else
{
	$doorder='zid desc';
}
$totalquery="select count(*) as total from {$dbtbpre}enewsztinfo where ztid='$ztid'".$add;
$num=$empire->gettotal($totalquery);
$query="select zid,cid,id,classid,mid,isgood,newstime from {$dbtbpre}enewsztinfo where ztid='$ztid'".$add;
$query=$query." order by ".$doorder." limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//專題子類
$csql=$empire->query("select cid,cname from {$dbtbpre}enewszttype where ztid='$ztid'");
$ztcs='';
$moveztcs='';
while($cr=$empire->fetch($csql))
{
	$selected='';
	if($cr['cid']==$cid)
	{
		$selected=' selected';
	}
	$ztcs.="<option value='$cr[cid]'".$selected.">$cr[cname]</option>";
	$moveztcs.="<option value='$cr[cid]'>$cr[cname]</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理專題信息</title>
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
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td width="36%" height="25">位置：專題：<b><?=$ztr['ztname']?></b> &gt; <a href="ListZtInfo.php?ztid=<?=$ztid?><?=$ecms_hashur['ehref']?>">管理專題信息</a></td>
    <td width="64%"><div align="right" class="emenubutton">
        <input type="button" name="Submit6" value="組合專題" onclick="window.open('TogZt.php?ztid=<?=$ztid?><?=$ecms_hashur['ehref']?>');"> 
		&nbsp;&nbsp;
		<input type="button" name="Submit6" value="管理專題子類" onclick="window.open('ZtType.php?ztid=<?=$ztid?><?=$ecms_hashur['ehref']?>');">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="SearchForm" method="GET" action="ListZtInfo.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td width="100%"> <div align="right">
          <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>">
          <select name="cid" id="cid">
            <option value="0">所有專題子類</option>
            <?=$ztcs?>
          </select>
          <span id="searchclassnav"></span> 
          <select name="myorder" id="myorder">
            <option value="1"<?=$myorder==1?' selected':''?>>按專題信息ID降序排序</option>
            <option value="2"<?=$myorder==2?' selected':''?>>按專題信息ID升序排序</option>
            <option value="3"<?=$myorder==3?' selected':''?>>按發佈時間降序排序</option>
            <option value="4"<?=$myorder==4?' selected':''?>>按發佈時間升序排序</option>
          </select>
          </select>
          <input name="isgood" type="checkbox" id="isgood" value="1"<?=$isgood==1?' checked':''?>>
          推薦 
          <input type="submit" name="Submit2" value="顯示">
        </div></td>
    </tr>
  </form>
</table>
<br>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="listform" method="post" action="ListZtInfo.php" onsubmit="return confirm('確認要執行此操作？');">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="3%"><div align="center"></div></td>
      <td width="13%"><div align="center">專題子類</div></td>
      <td width="6%" height="25"><div align="center">ID</div></td>
      <td width="43%" height="25"><div align="center">標題</div></td>
      <td width="28%" height="25"> <div align="center">發佈時間</div></td>
      <td width="7%"><div align="center">操作</div></td>
    </tr>
    <?php
	while($zr=$empire->fetch($sql))
	{
		//專題子類
		$cname='---';
		if($zr['cid'])
		{
			$cr=$empire->fetch1("select cname from {$dbtbpre}enewszttype where cid='$zr[cid]'");
			$cname="<a href='ListZtInfo.php?ztid=$ztid&cid=$zr[cid]".$ecms_hashur['ehref']."'>$cr[cname]</a>";
		}
		$tbname=$class_r[$zr[classid]]['tbname'];
		if(!$tbname)
		{
			continue;
		}
		$index_r=$empire->fetch1("select checked from {$dbtbpre}ecms_".$tbname."_index where id='$zr[id]'");
		$infotb=ReturnInfoMainTbname($tbname,$index_r['checked']);
		$r=$empire->fetch1("select id,classid,isurl,isqf,havehtml,newstime,truetime,lastdotime,titlepic,title,titleurl from ".$infotb." where id='$zr[id]'");
		$addecmscheck='';
		if($index_r['checked'])
		{
			$addecmscheck='&ecmscheck=1';
		}
		//狀態
		$st='';
		if($zr['isgood'])//推薦
		{
			$st.="<font color=red>[推".$zr['isgood']."]</font>";
		}
		$oldtitle=$r[title];
		$r[title]=stripSlashes(sub($r[title],0,36,false));
		//時間
		$truetime=date("Y-m-d H:i:s",$r[truetime]);
		$lastdotime=date("Y-m-d H:i:s",$r[lastdotime]);
		//審核
		if(empty($index_r['checked']))
		{
			$checked=" title='未審核' style='background:#99C4E3'";
			$titleurl="../ShowInfo.php?classid=$r[classid]&id=$r[id]".$addecmscheck.$ecms_hashur['ehref'];
		}
		else
		{
			$checked="";
			$titleurl=sys_ReturnBqTitleLink($r);
		}
		//取得類別名
		$do=$r[classid];
		$dob=$class_r[$r[classid]][bclassid];
		//標題圖片
		$showtitlepic="";
		if($r[titlepic])
		{
			$showtitlepic="<a href='".$r[titlepic]."' title='預覽標題圖片' target=_blank><img src='../../data/images/showimg.gif' border=0></a>";
		}
		$myid=$r['id'];
	?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td><div align="center"> 
          <input name="zid[]" type="checkbox" id="zid[]" value="<?=$zr['zid']?>"<?=$checked?>>
        </div></td>
      <td><div align="center"> 
          <?=$cname?>
        </div></td>
      <td height="42"> <div align="center"> 
          <?=$myid?>
        </div></td>
      <td height="42"> <div align="left"> 
          <?=$st?>
          <?=$showtitlepic?>
          <a href='<?=$titleurl?>' target=_blank title="<?=$oldtitle?>"> 
          <?=$r[title]?>
          </a> 
          <?=$qf?>
          <br>
          <font color="#574D5C">欄目:<a href='../ListNews.php?bclassid=<?=$class_r[$r[classid]][bclassid]?>&classid=<?=$r[classid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>'> 
          <font color="#574D5C"> 
          <?=$class_r[$dob][classname]?>
          </font> </a> > <a href='../ListNews.php?bclassid=<?=$class_r[$r[classid]][bclassid]?>&classid=<?=$r[classid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>'> 
          <font color="#574D5C"> 
          <?=$class_r[$r[classid]][classname]?>
          </font> </a></font></div></td>
      <td height="42"> <div align="center"> 
          <input name="dozid[]" type="hidden" id="dozid[]" value="<?=$zr[zid]?>">
          <input name="newstime[]" type="text" value="<?=date("Y-m-d H:i:s",$zr[newstime])?>" size="22">
        </div></td>
      <td><div align="center">[<a href="../AddNews.php?enews=EditNews&id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>" title="<?php echo"增加時間：".$truetime."\r\n最後修改：".$lastdotime;?>" target="_blank">修改</a>]</div></td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center"> 
          <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
        </div></td>
      <td height="25" colspan="5"> <div align="right"> 
          <input type="submit" name="Submit3" value="從專題移除" onclick="document.listform.enews.value='DoDelZtInfo';document.listform.action='ListZtInfo.php';">
          <select name="isgood" id="isgood">
            <option value="0">不推薦</option>
            <option value="1">1級推薦</option>
            <option value="2">2級推薦</option>
            <option value="3">3級推薦</option>
            <option value="4">4級推薦</option>
            <option value="5">5級推薦</option>
            <option value="6">6級推薦</option>
            <option value="7">7級推薦</option>
            <option value="8">8級推薦</option>
            <option value="9">9級推薦</option>
          </select>
          <input type="submit" name="Submit82" value="推薦" onClick="document.listform.enews.value='DoGoodZtInfo';document.listform.doing.value='1';document.listform.action='ListZtInfo.php';">
          <span id="moveclassnav">
          <input type="submit" name="Submit8223" value="批量修改時間" onClick="document.listform.enews.value='DoEditZtInfoTime';document.listform.action='ListZtInfo.php';">
          <select name="to_cid" id="to_cid">
            <option value="">選擇專題子類</option>
            <?=$moveztcs?>
          </select>
          <input type="submit" name="Submit8222" value="轉移" onClick="document.listform.enews.value='DoMoveZtInfo';document.listform.action='ListZtInfo.php';">
          <input name="enews" type="hidden" id="enews" value="DoGoodZtInfo">
          <input type=hidden name=doing value=0>
          </span> </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="6"> 
        <?=$returnpage?>
        <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="6"><font color="#666666">說明：信息是按發佈時間排序，如果要改順序可以修改發佈時間，發佈時間設置空則改為當前時間。</font></td>
    </tr>
  </form>
</table>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="../ShowClassNav.php?ecms=2&classid=<?=$classid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?php
db_close();
$empire=null;
?>