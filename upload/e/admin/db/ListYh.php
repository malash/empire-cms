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
CheckLevel($logininid,$loginin,$classid,"yh");

//返回變量處理
function ReturnYhVar($add){
	$add['hlist']=(int)$add['hlist'];
	$add['qlist']=(int)$add['qlist'];
	$add['bqnew']=(int)$add['bqnew'];
	$add['bqhot']=(int)$add['bqhot'];
	$add['bqpl']=(int)$add['bqpl'];
	$add['bqgood']=(int)$add['bqgood'];
	$add['bqfirst']=(int)$add['bqfirst'];
	$add['bqdown']=(int)$add['bqdown'];
	$add['otherlink']=(int)$add['otherlink'];
	$add['qmlist']=(int)$add['qmlist'];
	$add['dobq']=(int)$add['dobq'];
	$add['dojs']=(int)$add['dojs'];
	$add['dosbq']=(int)$add['dosbq'];
	$add['rehtml']=(int)$add['rehtml'];
	return $add;
}

//增加優化方案
function AddYh($add,$userid,$username){
	global $empire,$dbtbpre;
	$add=ReturnYhVar($add);
	if(!$add[yhname])
	{
		printerror("EmptyYhname","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"yh");
	$sql=$empire->query("insert into {$dbtbpre}enewsyh(yhname,yhtext,hlist,qlist,bqnew,bqhot,bqpl,bqgood,bqfirst,bqdown,otherlink,qmlist,dobq,dojs,dosbq,rehtml) values('$add[yhname]','$add[yhtext]','$add[hlist]','$add[qlist]','$add[bqnew]','$add[bqhot]','$add[bqpl]','$add[bqgood]','$add[bqfirst]','$add[bqdown]','$add[otherlink]','$add[qmlist]','$add[dobq]','$add[dojs]','$add[dosbq]','$add[rehtml]');");
	GetClass();//更新緩存
	if($sql)
	{
		$id=$empire->lastid();
		//操作日誌
		insert_dolog("id=$id&yhname=$add[yhname]");
		printerror("AddYhSuccess","AddYh.php?enews=AddYh".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//修改優化方案
function EditYh($add,$userid,$username){
	global $empire,$dbtbpre;
	$add=ReturnYhVar($add);
	$id=(int)$add['id'];
	if(!$id||!$add[yhname])
	{
		printerror("EmptyYhname","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"yh");
	$sql=$empire->query("update {$dbtbpre}enewsyh set yhname='$add[yhname]',yhtext='$add[yhtext]',hlist='$add[hlist]',qlist='$add[qlist]',bqnew='$add[bqnew]',bqhot='$add[bqhot]',bqpl='$add[bqpl]',bqgood='$add[bqgood]',bqfirst='$add[bqfirst]',bqdown='$add[bqdown]',otherlink='$add[otherlink]',qmlist='$add[qmlist]',dobq='$add[dobq]',dojs='$add[dojs]',dosbq='$add[dosbq]',rehtml='$add[rehtml]' where id='$id'");
	GetClass();//更新緩存
	if($sql)
	{
		//操作日誌
	    insert_dolog("id=$id&yhname=$add[yhname]");
		printerror("EditYhSuccess","ListYh.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//刪除優化方案
function DelYh($id,$userid,$username){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(!$id)
	{
		printerror("NotChangeYhid","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"yh");
	$r=$empire->fetch1("select yhname from {$dbtbpre}enewsyh where id='$id'");
	$sql=$empire->query("delete from {$dbtbpre}enewsyh where id='$id'");
	GetClass();//更新緩存
	if($sql)
	{
		//操作日誌
		insert_dolog("id=$id&yhname=$r[yhname]");
		printerror("DelYhSuccess","ListYh.php".hReturnEcmsHashStrHref2(1));
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
if($enews=="AddYh")
{
	AddYh($_POST,$logininid,$loginin);
}
elseif($enews=="EditYh")
{
	EditYh($_POST,$logininid,$loginin);
}
elseif($enews=="DelYh")
{
	$id=$_GET['id'];
	DelYh($id,$logininid,$loginin);
}
else
{}
$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//每頁顯示條數
$page_line=20;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select id,yhname from {$dbtbpre}enewsyh";
$totalquery="select count(*) as total from {$dbtbpre}enewsyh";
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>優化方案</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">位置：<a href=ListYh.php<?=$ecms_hashur['whehref']?>>管理優化方案</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit" value="增加優化方案" onclick="self.location.href='AddYh.php?enews=AddYh<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>

<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="16%" height="25"> <div align="center">ID</div></td>
    <td width="51%" height="25"> <div align="center">方案名稱</div></td>
    <td width="33%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center"> 
        <?=$r[id]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[yhname]?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddYh.php?enews=EditYh&id=<?=$r[id]?><?=$ecms_hashur['ehref']?>">修改</a>]&nbsp;[<a href="AddYh.php?enews=AddYh&docopy=1&id=<?=$r[id]?><?=$ecms_hashur['ehref']?>">複製</a>]&nbsp;[<a href="ListYh.php?enews=DelYh&id=<?=$r[id]?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3">&nbsp;&nbsp;&nbsp; 
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
