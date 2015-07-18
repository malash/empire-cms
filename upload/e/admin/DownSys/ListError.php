<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
require("../../data/dbcache/class.php");
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
CheckLevel($logininid,$loginin,$classid,"downerror");

//刪除單個報告
function DelError($errorid,$userid,$username){
	global $empire,$dbtbpre;
	//驗證權限
	CheckLevel($userid,$username,$classid,"downerror");
	$errorid=(int)$errorid;
	if(empty($errorid))
	{
		printerror("EmptyDelErrorid","history.go(-1)");
    }
	$sql=$empire->query("delete from {$dbtbpre}enewsdownerror where errorid='$errorid'");
	if($sql)
	{
		//操作日誌
		insert_dolog("errorid=$errorid");
		printerror("DelErrorSuccess","ListError.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//批量刪除報告
function DelError_all($errorid,$userid,$username){
	global $empire,$dbtbpre;
	//驗證權限
	CheckLevel($userid,$username,$classid,"downerror");
	$count=count($errorid);
	if(empty($count))
	{
		printerror("EmptyDelErrorid","history.go(-1)");
	}
	for($i=0;$i<$count;$i++)
	{
		$add.="errorid='".intval($errorid[$i])."' or ";
	}
	$add=substr($add,0,strlen($add)-4);
	$sql=$empire->query("delete from {$dbtbpre}enewsdownerror where ".$add);
	if($sql)
	{
		//操作日誌
		insert_dolog("");
		printerror("DelErrorSuccess","ListError.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//刪除單個錯誤報告
if($enews=="DelError")
{
	$errorid=$_GET['errorid'];
	DelError($errorid,$logininid,$loginin);
}
//批量刪除錯誤報告
elseif($enews=="DelError_all")
{
	$errorid=$_POST['errorid'];
	DelError_all($errorid,$logininid,$loginin);
}
$start=0;
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$line=15;//每行顯示
$page_line=15;
$offset=$page*$line;
//類別
$search='';
$search.=$ecms_hashur['ehref'];
$add="";
$cid=(int)$_GET['cid'];
if($cid)
{
	$add=" where cid='$cid'";
	$search.="&cid=$cid";
}
$totalquery="select count(*) as total from {$dbtbpre}enewsdownerror".$add;
$num=$empire->gettotal($totalquery);//取得總條數
$query="select * from {$dbtbpre}enewsdownerror".$add;
$query.=" order by errorid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//分類
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewserrorclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$cid)
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理錯誤報告</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
    <td>位置：<a href="ListError.php<?=$ecms_hashur['whehref']?>">管理錯誤報告</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="管理錯誤報告分類" onclick="self.location.href='ErrorClass.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="chclassform" method="get" action="ListError.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25">限制顯示： 
        <select name="cid" onchange="document.chclassform.submit()">
          <option value="0">顯示所有分類</option>
          <?=$cstr?>
        </select> </td>
    </tr>
  </form>
</table>
<form name="form1" method="post" action="ListError.php" onsubmit="return confirm('確認要刪除？');">
<?=$ecms_hashur['form']?>
<input type=hidden name=cid value="<?=$cid?>">
<?php
while($r=$empire->fetch($sql))
{
	if($class_r[$r[classid]][tbname])
	{
		$tr=$empire->fetch1("select title,isurl,titleurl,classid,id from {$dbtbpre}ecms_".$class_r[$r[classid]][tbname]." where id='$r[id]' limit 1");
		$titleurl=sys_ReturnBqTitleLink($tr);
	}
	//分類
	$cr[classname]="---";
	if($r[cid])
	{
		$cr=$empire->fetch1("select classname,classid from {$dbtbpre}enewserrorclass where classid='$r[cid]' limit 1");
	}
?>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr bgcolor="#FFFFFF" class="header"> 
      <td width="57%" height="25">信息標題：<a href="<?=$titleurl?>" target=_blank>
        <?=stripSlashes($tr[title])?>
        </a></td>
      <td width="28%" height="25">所屬分類：<a href="ListError.php?cid=<?=$r[cid]?><?=$ecms_hashur['ehref']?>"><?=$cr[classname]?></a></td>
      <td width="15%"><div align="center">
          <input name="errorid[]" type="checkbox" id="errorid[]" value="<?=$r[errorid]?>">
          <a href="ListError.php?enews=DelError&errorid=<?=$r[errorid]?>&cid=<?=$cid?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">發佈者IP： 
        <?=$r[errorip]?>
        &nbsp;(
        <?=stripSlashes($r[email])?>
        ) </td>
      <td height="25" colspan="2">發佈時間： 
        <?=$r[errortime]?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="3"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td> 
              <?=nl2br(ehtmlspecialchars(stripSlashes($r[errortext])))?>
            </td>
          </tr>
        </table></td>
    </tr>
  </table>
  <?php
  }
  db_close();
  $empire=null;
  ?>

  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="cccccc">
    <tr bgcolor="#FFFFFF"> 
    <td height="25">
      <?=$returnpage?>
      &nbsp;&nbsp;
      <input type=submit name=submit value=批量刪除><input type=hidden name=enews value=DelError_all>
      &nbsp;&nbsp;<input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
      全選</td>
  </tr>
</table>
</form>
</body>
</html>
