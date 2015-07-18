<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
$link=db_connect();
$empire=new mysqlquery();
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
CheckLevel($logininid,$loginin,$classid,"do");

//組合欄目
function AddDoTogClassid($classid){
	$count=count($classid);
	$class=',';
	for($i=0;$i<$count;$i++)
	{
		$class.=intval($classid[$i]).',';
	}
	return $class;
}

//增加刷新任務
function AddDo($add,$userid,$username){
	global $empire,$dbtbpre;
	$count=count($add[classid]);
	if(empty($add[doname])||($add[doing]&&!$count))
	{
		printerror("EmptyDoname","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"do");
	if($add[dotime]<5)
	{
		$add[dotime]=5;
	}
	$lasttime=time();
	//變量處理
	$add[dotime]=(int)$add[dotime];
	$add[isopen]=(int)$add[isopen];
	$add[doing]=(int)$add[doing];
	$classid=AddDoTogClassid($add[classid]);
	$sql=$empire->query("insert into {$dbtbpre}enewsdo(doname,dotime,isopen,doing,classid,lasttime) values('$add[doname]',$add[dotime],$add[isopen],$add[doing],'$classid',$lasttime);");
	$doid=$empire->lastid();
	if($sql)
	{
		//操作日誌
		insert_dolog("doid=$doid&doname=$add[doname]");
		printerror("AddDoSuccess","AddDo.php?enews=AddDo".hReturnEcmsHashStrHref2(0));
    }
	else
	{printerror("DbError","history.go(-1)");}
}

//修改刷新任務
function EditDo($add,$userid,$username){
	global $empire,$dbtbpre;
	$count=count($add[classid]);
	if(empty($add[doname])||($add[doing]&&!$count))
	{
		printerror("EmptyDoname","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"do");
	if($add[dotime]<5)
	{
		$add[dotime]=5;
	}
	//變量處理
	$add[dotime]=(int)$add[dotime];
	$add[isopen]=(int)$add[isopen];
	$add[doing]=(int)$add[doing];
	$classid=AddDoTogClassid($add[classid]);
	$sql=$empire->query("update {$dbtbpre}enewsdo set doname='$add[doname]',dotime=$add[dotime],isopen=$add[isopen],doing=$add[doing],classid='$classid' where doid='$add[doid]'");
	if($sql)
	{
		//操作日誌
		insert_dolog("doid=$add[doid]&doname=$add[doname]");
		printerror("EditDoSuccess","ListDo.php".hReturnEcmsHashStrHref2(1));
    }
	else
	{printerror("DbError","history.go(-1)");}
}

//刪除刷新任務
function DelDo($doid,$userid,$username){
	global $empire,$dbtbpre;
	$doid=(int)$doid;
	if(empty($doid))
	{printerror("EmptyDoid","history.go(-1)");}
	//驗證權限
	CheckLevel($userid,$username,$classid,"do");
	$r=$empire->fetch1("select doname from {$dbtbpre}enewsdo where doid='$doid'");
	$sql=$empire->query("delete from {$dbtbpre}enewsdo where doid='$doid'");
	if($sql)
	{
		//操作日誌
		insert_dolog("doid=$doid&doname=$r[doname]");
		printerror("EditDoSuccess","ListDo.php".hReturnEcmsHashStrHref2(1));
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
//增加刷新任務
if($enews=="AddDo")
{
	$add=$_POST;
	AddDo($add,$logininid,$loginin);
}
//修改刷新任務
elseif($enews=="EditDo")
{
	$add=$_POST;
	EditDo($add,$logininid,$loginin);
}
//刪除刷新任務
elseif($enews=="DelDo")
{
	$doid=$_GET['doid'];
	DelDo($doid,$logininid,$loginin);
}

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select * from {$dbtbpre}enewsdo";
$num=$empire->num($query);//取得總條數
$query=$query." order by doid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理刷新任務</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">位置：<a href="ListDo.php<?=$ecms_hashur['whehref']?>">管理定時刷新任務</a></td>
    <td> <div align="right" class="emenubutton">
        <input type="button" name="Submit" value="增加刷新任務" onclick="self.location.href='AddDo.php?enews=AddDo<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>

<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="6%" height="25"> <div align="center">ID</div></td>
    <td width="46%" height="25"> <div align="center">任務名</div></td>
    <td width="8%"><div align="center">時間間隔</div></td>
    <td width="18%"><div align="center">最後執行時間</div></td>
    <td width="8%" height="25"> <div align="center">開啟</div></td>
    <td width="14%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  if($r[isopen])
  {$isopen="開啟";}
  else
  {$isopen="關閉";}
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center"> 
        <?=$r[doid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[doname]?>
      </div></td>
    <td><div align="center">
        <?=$r[dotime]?>
      </div></td>
    <td><div align="center"> 
        <?=date("Y-m-d H:i:s",$r[lasttime])?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$isopen?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddDo.php?enews=EditDo&doid=<?=$r[doid]?><?=$ecms_hashur['ehref']?>">修改</a>]&nbsp;[<a href="ListDo.php?enews=DelDo&doid=<?=$r[doid]?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6">&nbsp;&nbsp;&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25" colspan="6"><font color="#666666">說明：執行定時刷新任務需要開著後台或者<a href="DoTimeRepage.php<?=$ecms_hashur['whehref']?>" target="_blank"><strong>點擊這裡</strong></a>開著這個頁面才會執行。</font></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
