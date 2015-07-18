<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
require "../".LoadLang("pub/fun.php");
require("../../data/dbcache/MemberLevel.php");
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
CheckLevel($logininid,$loginin,$classid,"member");
$userid=(int)$_GET['userid'];
$username=ehtmlspecialchars($_GET['username']);
$search="&username=".$username."&userid=".$userid.$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$totalquery="select count(*) as total from {$dbtbpre}enewsbuybak where userid='$userid'";
$num=$empire->gettotal($totalquery);//取得總條數
$query="select * from {$dbtbpre}enewsbuybak where userid='$userid'";
$query=$query." order by buytime desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>購買記錄</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>查看<b><?=$username?></b>購買記錄</td>
  </tr>
</table>
<br>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="11%"><div align="center">充值類型</div></td>
    <td width="37%" height="25"><div align="center">充值卡號</div></td>
    <td width="11%" height="25"><div align="center">充值金額</div></td>
    <td width="11%" height="25"><div align="center">購買點數</div></td>
    <td width="11%"><div align="center">有效期</div></td>
    <td width="19%" height="25"><div align="center">購買時間</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
		//類型
		if($r['type']==0)
		{
			$type='點卡充值';
		}
		elseif($r['type']==1)
		{
			$type='在線充值';
		}
		elseif($r['type']==2)
		{
			$type='充值點數';
		}
		elseif($r['type']==3)
		{
			$type='充值金額';
		}
		else
		{
			$type='';
		}
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td><div align="center"><?=$type?></div></td>
    <td height="25"><div align="center"> 
        <?=$r[card_no]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[money]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[cardfen]?>
      </div></td>
    <td><div align="center"><?=$r[userdate]?></div></td>
    <td height="25"><div align="center"> 
        <?=$r[buytime]?>
      </div></td>
  </tr>
  <?php
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
