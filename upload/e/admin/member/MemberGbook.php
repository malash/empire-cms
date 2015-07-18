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

//刪除留言
function hDelMemberGbook($add,$userid,$username){
	global $empire,$dbtbpre;
	$gid=intval($add['gid']);
	if(!$gid)
	{
		printerror("NotDelMemberGbookid","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}enewsmembergbook where gid='$gid'");
	if($sql)
	{
		//操作日誌
		insert_dolog("gid=".$gid);
		printerror("DelMemberGbookSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//批量刪除留言
function hDelMemberGbook_All($add,$userid,$username){
	global $empire,$dbtbpre;
	$gid=$add['gid'];
	$count=count($gid);
	if(empty($count))
	{
		printerror("NotDelMemberGbookid","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$addsql.="gid='".intval($gid[$i])."' or ";
    }
	$addsql=substr($addsql,0,strlen($addsql)-4);
	$sql=$empire->query("delete from {$dbtbpre}enewsmembergbook where (".$addsql.")");
	if($sql)
	{
		//操作日誌
		insert_dolog("");
		printerror("DelMemberGbookSuccess",$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

$enews=$_GET['enews'];
if(empty($enews))
{$enews=$_POST['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="hDelMemberGbook")
{
	hDelMemberGbook($_GET,$logininid,$loginin);
}
elseif($enews=="hDelMemberGbook_All")
{
	hDelMemberGbook_All($_POST,$logininid,$loginin);
}
include("../../member/class/user.php");
include "../".LoadLang("pub/fun.php");
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=12;//每頁顯示條數
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
		if($show==1)//留言內容
		{
			$and.=" where gbtext like '%$keyboard%'";	
		}
		elseif($show==2)//回復內容
		{
			$and.=" where retext like '%$keyboard%'";
		}
		elseif($show==3)//留言者
		{
			$and.=" where uname like '%$keyboard%'";
		}
		elseif($show==4)//空間主人用戶ID
		{
			$and.=" where userid='$keyboard'";
		}
		elseif($show==5)//留言者IP
		{
			$and.=" where ip like '%$keyboard%'";
		}
		$search.="&sear=1&keyboard=$keyboard&show=$show";
	}
}
$query="select gid,isprivate,uid,uname,ip,addtime,gbtext,retext,userid,eipport from {$dbtbpre}enewsmembergbook".$and;
$totalquery="select count(*) as total from {$dbtbpre}enewsmembergbook".$and;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by gid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="會員空間&nbsp;>&nbsp;<a href=MemberGbook.php".$ecms_hashur['whehref'].">管理留言</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>留言管理</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置: 
      <?=$url?>
    </td>
    <td><div align="right"> </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
<form name="searchgb" method="get" action="MemberGbook.php">
<?=$ecms_hashur['eform']?>
  <tr>
    <td><div align="center">搜索：
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="show" id="show">
            <option value="1"<?=$show==1?' selected':''?>>留言內容</option>
			<option value="2"<?=$show==2?' selected':''?>>回復內容</option>
            <option value="3"<?=$show==3?' selected':''?>>留言者</option>
            <option value="4"<?=$show==4?' selected':''?>>空間主人用戶ID</option>
            <option value="5"<?=$show==5?' selected':''?>>留言者IP</option>
          </select>
          <input type="submit" name="Submit" value="搜索">
          <input name="sear" type="hidden" id="sear" value="1">
        </div></td>
  </tr>
</form>
</table>
<form name=thisform method=post action=MemberGbook.php onsubmit="return confirm('確認要執行操作?');">
<?=$ecms_hashur['form']?>
<?php
while($r=$empire->fetch($sql))
{
	$ur=$empire->fetch1("select ".egetmf('username')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$r[userid]'");
	if($r['uid'])
	{
		$r['uname']="<b><a href='../../space/?userid=$r[uid]' target='_blank'>$r[uname]</a></b>";
	}
	$username=$ur['username'];
	$private='';
	if($r['isprivate'])
	{
		$private='<b>[悄悄話]</b>';
	}
?>
  <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
    <tr class=header> 
      <td width="55%" height="23">發佈者: 
        <?=$r[uname]?>
        </td>  
      <td width="45%">發佈時間: 
        <?=$r[addtime]?>&nbsp;
        (IP: <?=$r[ip]?>:<?=$r[eipport]?>) </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="23" colspan="2"> <table border=0 width='100%' cellspacing=1 cellpadding=10 bgcolor='#cccccc'>
        <tr> 
          <td width='100%' bgcolor='#FFFFFF' style='word-break:break-all'> 
            <?=$private.nl2br($r[gbtext])?>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" style='word-break:break-all'>
        <tr> 
          <td><img src="../../data/images/regb.gif" width="18" height="18"><strong><font color="#FF0000">回復:</font></strong> 
            <?=nl2br($r[retext])?>
          </td>
        </tr>
      </table> 
    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="23" colspan="2"><div align="right">
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
              <td width="55%"><strong>空間主人: <a href="MemberGbook.php?sear=1&show=4&keyboard=<?=$r[userid]?><?=$ecms_hashur['ehref']?>"> 
                <?=$username?>
                </a> </strong></td>
              <td width="45%"> 
                <div align="left"><strong>操作:</strong>&nbsp;[<a href="MemberGbook.php?enews=hDelMemberGbook&gid=<?=$r[gid]?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除?');">刪除</a>] 
                  <input name="gid[]" type="checkbox" value="<?=$r[gid]?>">
                </div></td>
          </tr>
        </table>
        </div></td>
  </tr>
</table>
<br>
<?php
}
?>
  <table width="700" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
      <td>分頁: 
        <?=$returnpage?>
        &nbsp;&nbsp; 
        <input type="submit" name="Submit2" value="批量刪除" onClick="document.thisform.enews.value='hDelMemberGbook_All';">
        <input name="enews" type="hidden" id="enews" value="hDelMemberGbook_All">
      </td>
  </tr>
</table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
