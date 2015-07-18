<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"spacedata");

//刪除反饋
function hDelMemberFeedback($add,$userid,$username){
	global $empire,$dbtbpre;
	$fid=intval($add['fid']);
	if(!$fid)
	{
		printerror("NotDelMemberFeedbackid","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}enewsmemberfeedback where fid='$fid'");
	if($sql)
	{
		//操作日誌
		insert_dolog("fid=".$fid);
		printerror("DelMemberFeedbackSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//批量刪除反饋
function hDelMemberFeedback_All($add,$userid,$username){
	global $empire,$dbtbpre;
	$fid=$add['fid'];
	$count=count($fid);
	if(empty($count))
	{
		printerror("NotDelMemberFeedbackid","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$addsql.="fid='".intval($fid[$i])."' or ";
    }
	$addsql=substr($addsql,0,strlen($addsql)-4);
	$sql=$empire->query("delete from {$dbtbpre}enewsmemberfeedback where (".$addsql.")");
	if($sql)
	{
		//操作日誌
		insert_dolog("");
		printerror("DelMemberFeedbackSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

$enews=$_GET['enews'];
if(empty($enews))
{
	$enews=$_POST['enews'];
}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="hDelMemberFeedback")
{
	hDelMemberFeedback($_GET,$logininid,$loginin);
}
elseif($enews=="hDelMemberFeedback_All")
{
	hDelMemberFeedback_All($_POST,$logininid,$loginin);
}
include("../../member/class/user.php");
include "../".LoadLang("pub/fun.php");
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
//搜索
$search='';
$search.=$ecms_hashur['ehref'];
$and='';
if($_GET['sear'])
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	if($keyboard)
	{
		$show=RepPostStr($_GET['show'],1);
		if($show==1)//反饋標題
		{
			$and.=" where title like '%$keyboard%'";	
		}
		elseif($show==2)//反饋內容
		{
			$and.=" where ftext like '%$keyboard%'";
		}
		elseif($show==3)//空間主人用戶ID
		{
			$and.=" where userid='$keyboard'";
		}
		elseif($show==4)//留言者IP
		{
			$and.=" where ip like '%$keyboard%'";
		}
		$search.="&sear=1&keyboard=$keyboard&show=$show";
	}
}
$query="select fid,title,uid,uname,addtime,userid from {$dbtbpre}enewsmemberfeedback".$and;
$totalquery="select count(*) as total from {$dbtbpre}enewsmemberfeedback".$and;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by fid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="會員空間&nbsp;>&nbsp;<a href=MemberFeedback.php".$ecms_hashur['whehref'].">管理反饋</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理反饋</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置： 
      <?=$url?>
    </td>
    <td><div align="right"> 
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="searchfb" method="get" action="MemberFeedback.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td><div align="center">搜索： 
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="show" id="show">
            <option value="1"<?=$show==1?' selected':''?>>反饋標題</option>
            <option value="2"<?=$show==2?' selected':''?>>反饋內容</option>
            <option value="3"<?=$show==3?' selected':''?>>空間主人用戶ID</option>
            <option value="4"<?=$show==4?' selected':''?>>留言者IP</option>
          </select>
          <input type="submit" name="Submit2" value="搜索">
          <input name="sear" type="hidden" id="sear" value="1">
        </div></td>
    </tr>
  </form>
</table>
<form name="form1" method="post" action="MemberFeedback.php" onsubmit="return confirm('確認要刪除?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
  <?=$ecms_hashur['form']?>
    <tr class=header> 
      <td width="7%" height="23"><div align="center">ID</div></td>
      <td width="43%" height="23"><div align="center">標題(點擊查看)</div></td>
      <td width="20%" height="23"><div align="center">空間主人</div></td>
      <td width="18%" height="23"><div align="center">發佈時間</div></td>
      <td width="12%" height="23"><div align="center">操作</div></td>
    </tr>
    <?php
  while($r=$empire->fetch($sql))
  {
  	$ur=$empire->fetch1("select ".egetmf('username')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$r[userid]'");
	$username=$ur['username'];
	if($r['uid'])
	{
		$r['uname']="<a href='../../space/?userid=$r[uid]' target='_blank'>$r[uname]</a>";
	}
	else
	{
		$r['uname']='遊客';
	}
  ?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"><div align="center"> 
          <?=$r[fid]?>
        </div></td>
      <td height="25"><div align="left"><a href="#ecms" onclick="window.open('MemberShowFeedback.php?fid=<?=$r[fid]?><?=$ecms_hashur['ehref']?>','','width=650,height=600,scrollbars=yes,top=70,left=100');"> 
          <?=$r[title]?>
          </a>&nbsp;(<?=$r['uname']?>)</div></td>
      <td height="25"><div align="center"><a href="MemberFeedback.php?sear=1&show=3&keyboard=<?=$r[userid]?><?=$ecms_hashur['ehref']?>"> 
                <?=$username?>
                </a></div></td>
      <td height="25"><div align="center"> 
          <?=$r[addtime]?>
        </div></td>
      <td height="25"><div align="center">[<a href="MemberFeedback.php?enews=hDelMemberFeedback&fid=<?=$r[fid]?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除?');">刪除</a>
          <input name="fid[]" type="checkbox" value="<?=$r[fid]?>">
          ]</div></td>
    </tr>
    <?php
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="5">&nbsp; 
        <?=$returnpage?>
        &nbsp;&nbsp;&nbsp;
        <input type="submit" name="Submit" value="批量刪除">
        <input name="enews" type="hidden" id="enews" value="hDelMemberFeedback_All"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
