<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
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
CheckLevel($logininid,$loginin,$classid,"memberf");
$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//每頁顯示條數
$page_line=23;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select fid,fname from {$dbtbpre}enewsmemberform";
$totalquery="select count(*) as total from {$dbtbpre}enewsmemberform";
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by fid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">位置：<a href="ListMemberForm.php<?=$ecms_hashur['whehref']?>">管理會員表單</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="增加會員表單" onclick="self.location.href='AddMemberForm.php?enews=AddMemberForm<?=$ecms_hashur['ehref']?>';">
		&nbsp;&nbsp;
		<input type="button" name="Submit5" value="管理會員字段" onclick="self.location.href='ListMemberF.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="8%"><div align="center">ID</div></td>
    <td width="64%" height="25"><div align="center">表單名稱</div></td>
    <td width="28%" height="25"><div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td><div align="center"> 
        <?=$r[fid]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[fname]?>
      </div></td>
    <td height="25"><div align="center">[<a href="AddMemberForm.php?enews=EditMemberForm&fid=<?=$r[fid]?><?=$ecms_hashur['ehref']?>">修改</a>] 
        [<a href="AddMemberForm.php?enews=AddMemberForm&fid=<?=$r[fid]?>&docopy=1<?=$ecms_hashur['ehref']?>">複製</a>] 
        [<a href="../ecmsmember.php?enews=DelMemberForm&fid=<?=$r[fid]?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除?');">刪除</a>] 
      </div></td>
  </tr>
  <?php
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3"> 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
