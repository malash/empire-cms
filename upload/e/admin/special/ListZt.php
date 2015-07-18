<?php
define('EmpireCMSAdmin','1');
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/functions.php');
require '../'.LoadLang('pub/fun.php');
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
CheckLevel($logininid,$loginin,$classid,"zt");

//修改欄目順序
function EditZtOrder($ztid,$myorder,$userid,$username){
	global $empire,$dbtbpre;
	for($i=0;$i<count($ztid);$i++)
	{
		$newmyorder=(int)$myorder[$i];
		$ztid[$i]=(int)$ztid[$i];
		$sql=$empire->query("update {$dbtbpre}enewszt set myorder='$newmyorder' where ztid='$ztid[$i]'");
    }
	//操作日誌
	insert_dolog("");
	printerror("EditZtOrderSuccess",$_SERVER['HTTP_REFERER']);
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//修改顯示順序
if($enews=="EditZtOrder")
{
	EditZtOrder($_POST['ztid'],$_POST['myorder'],$logininid,$loginin);
}

$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$add="";
$search="";
$search.=$ecms_hashur['ehref'];
$url="<a href=ListZt.php".$ecms_hashur['whehref'].">管理專題</a>";
//類別
$zcid=(int)$_GET['zcid'];
if($zcid)
{
	$add=" where zcid=$zcid";
	$search.="&zcid=$zcid";
}
//分類
$zcstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsztclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$zcid)
	{
		$select=" selected";
	}
	$zcstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
$totalquery="select count(*) as total from {$dbtbpre}enewszt".$add;
$query="select * from {$dbtbpre}enewszt".$add;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by myorder,ztid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>專題</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置： 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit52" value="增加專題" onclick="self.location.href='AddZt.php?enews=AddZt<?=$ecms_hashur['ehref']?>';"> 
		&nbsp;&nbsp;
        <input type="button" name="Submit6" value="數據更新中心" onclick="window.open('../ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>');">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="form1" method="get" action="ListZt.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td height="30">限制顯示： 
        <select name="zcid" id="zcid" onchange="document.form1.submit()">
          <option value="0">顯示所有分類</option>
          <?=$zcstr?>
        </select>
      </td>
    </tr>
  </form>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="editorder" method="post" action="ListZt.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="5%"><div align="center">順序</div></td>
      <td width="6%" height="25"><div align="center">ID</div></td>
      <td width="34%" height="25"><div align="center">專題名</div></td>
      <td width="20%"><div align="center">增加時間</div></td>
      <td width="11%"><div align="center">訪問量</div></td>
      <td width="13%">專題管理</td>
      <td width="11%" height="25"><div align="center">操作</div></td>
    </tr>
    <?php
  while($r=$empire->fetch($sql))
  {
  if($r[zturl])
  {
  	$ztlink=$r[zturl];
  }
  else
  {
  	$ztlink="../../../".$r[ztpath];
  }
  ?>
    <tr bgcolor="ffffff" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td><div align="center"> 
          <input name="myorder[]" type="text" id="myorder[]" value="<?=$r[myorder]?>" size="2">
          <input name="ztid[]" type="hidden" id="ztid[]" value="<?=$r[ztid]?>">
        </div></td>
      <td height="25"><div align="center"> 
          <a href="../ecmschtml.php?enews=ReZtHtml&ztid=<?=$r[ztid]?><?=$ecms_hashur['href']?>"><?=$r[ztid]?></a>
        </div></td>
      <td height="25"><div align="center"> 
          <a href="<?=$ztlink?>" target="_blank"><?=$r[ztname]?></a>
        </div></td>
      <td><div align="center"><?=$r['addtime']?date("Y-m-d",$r['addtime']):'---'?></div></td>
      <td><div align="center"> 
          <?=$r[onclick]?>
        </div></td>
      <td><a href="AddZt.php?enews=EditZt&ztid=<?=$r[ztid]?><?=$ecms_hashur['ehref']?>">修改</a> <a href="../ecmschtml.php?enews=ReZtHtml&ztid=<?=$r[ztid]?>&ecms=1<?=$ecms_hashur['href']?>">刷新</a> <a href="AddZt.php?enews=AddZt&ztid=<?=$r[ztid]?>&docopy=1<?=$ecms_hashur['ehref']?>">複製</a> <a href="../ecmsclass.php?enews=DelZt&ztid=<?=$r[ztid]?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除此專題？');">刪除</a></td>
      <td height="25"><div align="center"><a href="#ecms" onclick="window.open('../openpage/AdminPage.php?leftfile=<?=urlencode('../special/pageleft.php?ztid='.$r[ztid].$ecms_hashur['ehref'])?>&title=<?=urlencode($r[ztname])?><?=$ecms_hashur['ehref']?>','','');">更新專題</a></div></td>
    </tr>
    <?php
  }
  ?>
    <tr bgcolor="ffffff"> 
      <td height="25" colspan="7"><div align="right">
        <input type="submit" name="Submit5" value="修改專題順序" onClick="document.editorder.enews.value='EditZtOrder';"> 
        <input name="enews" type="hidden" id="enews" value="EditZtOrder"> 
      <font color="#666666">(順序值越小越前面)</font></div></td>
    </tr>
    <tr bgcolor="ffffff">
      <td height="25" colspan="7">&nbsp;&nbsp; 
        <?=$returnpage?></td>
    </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
