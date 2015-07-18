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
CheckLevel($logininid,$loginin,$classid,"bq");

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select bqid,bqname,bq,issys,funname,isclose,classid from {$dbtbpre}enewsbq";
$totalquery="select count(*) as total from {$dbtbpre}enewsbq";
//類別
$add="";
$classid=(int)$_GET['classid'];
if($classid)
{
	$add=" where classid=$classid";
	$search.="&classid=$classid";
}
$query.=$add;
$totalquery.=$add;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by myorder desc,isclose,bqid limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//類別
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsbqclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$classid)
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理標籤</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">位置：<a href="ListBq.php<?=$ecms_hashur['whehref']?>">管理標籤</a></td>
    <td><div align="right" class="emenubutton"> 
        <input type="button" name="Submit5" value="增加標籤" onclick="self.location.href='AddBq.php?enews=AddBq&gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit5" value="導入標籤" onclick="self.location.href='LoadInBq.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit52" value="管理標籤分類" onclick="self.location.href='BqClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td> 選擇類別： 
      <select name="classid" id="classid" onchange=window.location='ListBq.php?<?=$ecms_hashur['ehref']?>&classid='+this.options[this.selectedIndex].value>
        <option value="0">顯示所有類別</option>
        <?=$cstr?>
      </select> </td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"> <div align="center">ID</div></td>
    <td width="27%" height="25"> <div align="center">標籤名稱</div></td>
    <td width="26%" height="25"> <div align="center">標籤符號</div></td>
    <td width="11%" height="25"> <div align="center">系統標籤</div></td>
    <td width="8%"><div align="center">開啟</div></td>
    <td width="23%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  if($r[issys])
  {$issys="是";}
  else
  {$issys="否";}
  //開啟
  if($r[isclose])
  {
  $isclose="<font color=red>關閉</font>";
  }
  else
  {
  $isclose="開啟";
  }
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center">
        <?=$r[bqid]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[bqname]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[bq]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$issys?>
      </div></td>
    <td><div align="center"><?=$isclose?></div></td>
    <td height="25"> <div align="center">[<a href="AddBq.php?enews=EditBq&bqid=<?=$r[bqid]?>&cid=<?=$classid?><?=$ecms_hashur['ehref']?>">修改</a>]&nbsp;[<a href="../ecmstemp.php?enews=DelBq&bqid=<?=$r[bqid]?>&cid=<?=$classid?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a>]&nbsp;[<a href="#ecms" onclick="window.open('LoadOutBq.php?bqid=<?=$r[bqid]?><?=$ecms_hashur['ehref']?>','','width=500,height=500,scrollbars=auto');">導出</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6">&nbsp;&nbsp;&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
