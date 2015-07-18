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
CheckLevel($logininid,$loginin,$classid,"pubvar");

//增加變量
function AddPubVar($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[myvar]=RepPostVar($add[myvar]);
	if(!$add[myvar]||!$add[varname])
	{
		printerror("EmptyPubVar","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"pubvar");
	//驗證重複
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspubvar where myvar='$add[myvar]' limit 1");
	if($num)
	{
		printerror("RePubVar","history.go(-1)");
	}
	$classid=(int)$add[classid];
	$tocache=(int)$add[tocache];
	$add[myorder]=(int)$add[myorder];
	$add[varvalue]=AddAddsData(RepPhpAspJspcode($add[varvalue]));
	$sql=$empire->query("insert into {$dbtbpre}enewspubvar(myvar,varname,varvalue,varsay,myorder,classid,tocache) values('$add[myvar]','$add[varname]','".$add[varvalue]."','$add[varsay]','$add[myorder]','$classid','$tocache');");
	$lastid=$empire->lastid();
	if($tocache)
	{
		GetConfig();
	}
	if($sql)
	{
		//操作日誌
	    insert_dolog("varid=".$lastid."<br>var=".$add[myvar]);
		printerror("AddPubVarSuccess","AddPubVar.php?enews=AddPubVar".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//修改變量
function EditPubVar($add,$userid,$username){
	global $empire,$dbtbpre;
	$add[varid]=(int)$add['varid'];
	$add[myvar]=RepPostVar($add[myvar]);
	if(!$add[varid]||!$add[myvar]||!$add[varname])
	{
		printerror("EmptyPubVar","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"pubvar");
	if($add[myvar]!=$add[oldmyvar])
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspubvar where myvar='$add[myvar]' and varid<>$add[varid] limit 1");
		if($num)
		{
			printerror("RePubVar","history.go(-1)");
		}
	}
	$add[varvalue]=AddAddsData(RepPhpAspJspcode($add[varvalue]));
	$classid=(int)$add[classid];
	$tocache=(int)$add[tocache];
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("update {$dbtbpre}enewspubvar set myvar='$add[myvar]',varname='$add[varname]',varvalue='".$add[varvalue]."',varsay='$add[varsay]',myorder='$add[myorder]',classid='$classid',tocache='$tocache' where varid='$add[varid]'");
	if($tocache||$add['oldtocache'])
	{
		GetConfig();
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("varid=".$add[varid]."<br>var=".$add[myvar]);
		printerror("EditPubVarSuccess","ListPubVar.php?classid=$add[cid]".hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//刪除變量
function DelPubVar($varid,$cid,$userid,$username){
	global $empire,$dbtbpre;
	$varid=(int)$varid;
	if(!$varid)
	{
		printerror("NotDelPubVarid","history.go(-1)");
	}
	//驗證權限
	CheckLevel($userid,$username,$classid,"pubvar");
	$r=$empire->fetch1("select myvar,tocache from {$dbtbpre}enewspubvar where varid='$varid'");
	$sql=$empire->query("delete from {$dbtbpre}enewspubvar where varid='$varid'");
	if($r['tocache'])
	{
		GetConfig();
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("varid=".$varid."<br>var=".$r[myvar]);
		printerror("DelPubVarSuccess","ListPubVar.php?classid=$cid".hReturnEcmsHashStrHref2(0));
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
//增加變量
if($enews=="AddPubVar")
{
	$add=$_POST;
	AddPubVar($add,$logininid,$loginin);
}
//修改變量
elseif($enews=="EditPubVar")
{
	$add=$_POST;
	EditPubVar($add,$logininid,$loginin);
}
//刪除變量
elseif($enews=="DelPubVar")
{
	$varid=$_GET['varid'];
	$cid=$_GET['cid'];
	DelPubVar($varid,$cid,$logininid,$loginin);
}

$search='';
$search.=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=30;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$query="select varid,myvar,varvalue,varname,tocache,classid from {$dbtbpre}enewspubvar";
$totalquery="select count(*) as total from {$dbtbpre}enewspubvar";
//分類
$add='';
$classid=(int)$_GET['classid'];
if($classid)
{
	$add=" where classid='$classid'";
	$search.="&classid=$classid";
}
$query.=$add;
$totalquery.=$add;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by myorder,varid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//分類
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewspubvarclass order by classid");
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理擴展變量</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">位置: <a href="ListPubVar.php<?=$ecms_hashur['whehref']?>">管理擴展變量</a></td>
    <td><div align="right" class="emenubutton"> 
        <input type="button" name="Submit5" value="增加擴展變量" onclick="self.location.href='AddPubVar.php?enews=AddPubVar<?=$ecms_hashur['ehref']?>';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit5" value="管理擴展變量分類" onclick="self.location.href='PubVarClass.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
      
    <td> 選擇分類： 
      <select name="classid" id="classid" onchange=window.location='ListPubVar.php?<?=$ecms_hashur['ehref']?>&classid='+this.options[this.selectedIndex].value>
          <option value="0">顯示所有分類</option>
		  <?=$cstr?>
        </select>
      </td>
    </tr>
  </table><br>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"> <div align="center">ID</div></td>
    <td width="28%" height="25"> <div align="center">變量名</div></td>
    <td width="28%" height="25"> <div align="center">變量標識</div></td>
    <td width="17%"><div align="center">所屬分類</div></td>
    <td width="8%"><div align="center">寫入緩存</div></td>
    <td width="14%" height="25"> <div align="center">操作</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  	//分類
	$cname='未分類';
	if($r['classid'])
	{
		$lcr=$empire->fetch1("select classname from {$dbtbpre}enewspubvarclass where classid='$r[classid]'");
		$cname='<a href="ListPubVar.php?classid='.$r[classid].$ecms_hashur['ehref'].'">'.$lcr[classname].'</a>';
	}
  	if($r[tocache])
  	{
  		$tocache='<font color=red>寫入</font>';
  	}
  	else
  	{
 	 	$tocache='不寫入';
  	}
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center"> 
        <?=$r[varid]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[myvar]?>
      </div></td>
    <td height="25"> <div align="center"> 
        <?=$r[varname]?>
      </div></td>
    <td><div align="center"><?=$cname?></div></td>
    <td><div align="center">
        <?=$tocache?>
      </div></td>
    <td height="25"> <div align="center">[<a href="AddPubVar.php?enews=EditPubVar&varid=<?=$r[varid]?>&cid=<?=$classid?><?=$ecms_hashur['ehref']?>">修改</a>]&nbsp;[<a href="ListPubVar.php?enews=DelPubVar&varid=<?=$r[varid]?>&cid=<?=$classid?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a>]</div></td>
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
<br>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
  <tr class="header">
    <td height="25">擴展變量調用說明</td>
  </tr>
  <tr>
    <td height="25" bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>1、寫入緩存的變量調用</strong></td>
        </tr>
        <tr> 
          <td height="30" valign="top">在任意php或模板中用$public_r['add_變量名']可取得變量內容。</td>
        </tr>
        <tr> 
          <td><strong>2、沒有寫入緩存的變量調用</strong></td>
        </tr>
        <tr> 
          <td valign="top">可以用內置變量返回函數(數據庫讀取變量內容)：ReturnPublicAddVar(變量名)。取多個變量內容可用逗號隔開，例子：<br>
            取得單變量內容：$value=ReturnPublicAddVar('myvar'); //$value就是變量內容。<br>
            取得多個變量內容：$value=ReturnPublicAddVar('myvar1,myvar2,myvar3'); //$value['myvar1']才是變量內容。</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
