<?php
define('EmpireCMSAdmin','1');
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/functions.php');
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

$enews=ehtmlspecialchars($_GET['enews']);
$ztid=(int)$_GET['ztid'];
$ztr=$empire->fetch1("select ztid,ztname from {$dbtbpre}enewszt where ztid='$ztid'");
if(!$ztr['ztid'])
{
	printerror('ErrorUrl','');
}
//驗證權限
//CheckLevel($logininid,$loginin,$classid,"zt");
$returnandlevel=CheckAndUsernamesLevel('dozt',$ztid,$logininid,$loginin,$loginlevel);

$url="<a href='ListZt.php".$ecms_hashur['whehref']."'>管理專題</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>".$ztr['ztname']."</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>管理專題子類</a>&nbsp;>&nbsp;增加專題子類";
$postword='增加專題子類';
//初使化數據
$r[myorder]=0;
$r[reorder]="newstime DESC";
$r[maxnum]=0;
$r[tnum]=25;
$r[ttype]=".html";
$r[islist]=1;
//複製
$docopy=RepPostStr($_GET['docopy'],1);
if($docopy&&$enews=="AddZtType")
{
	$copyclass=1;
}
$ecmsfirstpost=1;
//修改
if($enews=="EditZtType"||$copyclass)
{
	$ecmsfirstpost=0;
	if($copyclass)
	{
		$thisdo="複製";
	}
	else
	{
		$thisdo="修改";
	}
	$cid=(int)$_GET['cid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewszttype where cid='$cid'");
	$addr=$empire->fetch1("select * from {$dbtbpre}enewszttypeadd where cid='$cid'");
	$url="<a href='ListZt.php".$ecms_hashur['whehref']."'>管理專題</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>".$ztr['ztname']."</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>管理專題子類</a>&nbsp;>&nbsp;".$thisdo."專題子類：".$r[cname];
	$postword=$thisdo.'專題子類';
	//複製分類
	if($copyclass)
	{
		$r[cname].='(1)';
	}
}
//列表模板
$mod_options='';
$listtemp_options='';
$msql=$empire->query("select mid,mname,usemod from {$dbtbpre}enewsmod order by myorder,mid");
while($mr=$empire->fetch($msql))
{
	if(empty($mr[usemod]))
	{
		if($mr[mid]==$r[mid])
		{$m_d=" selected";}
		else
		{$m_d="";}
		$mod_options.="<option value=".$mr[mid].$m_d.">".$mr[mname]."</option>";
	}
	//列表模板
	$listtemp_options.="<option value=0 style='background:#99C4E3'>".$mr[mname]."</option>";
	$l_sql=$empire->query("select tempid,tempname from ".GetTemptb("enewslisttemp")." where modid='$mr[mid]'");
	while($l_r=$empire->fetch($l_sql))
	{
		if($l_r[tempid]==$r[listtempid])
		{$l_d=" selected";}
		else
		{$l_d="";}
		$listtemp_options.="<option value=".$l_r[tempid].$l_d."> |-".$l_r[tempname]."</option>";
	}
}
//封面模板
$classtemp='';
$classtempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsclasstemp")." order by tempid");
while($classtempr=$empire->fetch($classtempsql))
{
	$select="";
	if($r[classtempid]==$classtempr[tempid])
	{
		$select=" selected";
	}
	$classtemp.="<option value='".$classtempr[tempid]."'".$select.">".$classtempr[tempname]."</option>";
}
//當前使用的模板組
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>增加專題子類</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
//檢查
function CheckForm(obj){
	if(obj.tname.value=='')
	{
		alert("請輸入分類名稱");
		obj.tname.focus();
		return false;
	}
	if(obj.tpath.value=="")
	{
		alert("請輸入分類目錄");
		obj.tpath.focus();
		return false;
	}
	if(obj.listtempid.value==0)
	{
		alert("請選擇列表模板");
		obj.listtempid.focus();
		return false;
	}
}
  </script>

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置： 
      <?=$url?>
    </td>
  </tr>
</table>
<br>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="ZtType.php" onsubmit="return CheckForm(document.form1);">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input type=hidden name=enews value=<?=$enews?>> <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">基本屬性</td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">分類名稱(*)</td>
      <td width="76%" height="25" bgcolor="#FFFFFF"> <input name="cname" type="text" id="cname" value="<?=$r[cname]?>" size="38"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">排序</td>
      <td bgcolor="#FFFFFF"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="38"> 
        <font color="#666666"> (值越小越前面)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">頁面設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">文件擴展名</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ttype" type="text" id="ttype" value="<?=$r[ttype]?>" size="38"> 
        <select name="select" onchange="document.form1.ttype.value=this.value">
          <option value=".html">擴展名</option>
          <option value=".html">.html</option>
          <option value=".htm">.htm</option>
          <option value=".php">.php</option>
          <option value=".shtml">.shtml</option>
        </select> <font color="#666666">(如.html,.xml,.htm等)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">頁面顯示模式</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="islist" value="1"<?=$r[islist]==1?' checked':''?>>
        列表式 
        <input type="radio" name="islist" value="2"<?=$r[islist]==2?' checked':''?>>
        單頁式 
        <input name="oldislist" type="hidden" id="oldislist" value="<?=$r[islist]?>"> 
        <font color="#666666">(列表式要選擇列表模板、單頁式要錄入頁面內容)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">所用列表模板</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="listtempid" id="listtempid">
          <?=$listtemp_options?>
        </select> <input type="button" name="Submit622" value="管理列表模板" onclick="window.open('../template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">列表式頁面排序方式</td>
      <td height="25" bgcolor="#FFFFFF"><input name="reorder" type="text" id="reorder" value="<?=$r[reorder]?>" size="38"> 
        <select name="orderselect" onchange="document.form1.reorder.value=this.value">
          <option value="newstime DESC"></option>
          <option value="newstime DESC">按發佈時間降序排序</option>
          <option value="id DESC">按信息ID降序排序</option>
          <option value="zid DESC">按加入ID降序排序</option>
		  <option value="isgood DESC,newstime DESC">按推薦置頂排序</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">顯示總記錄數</td>
      <td height="25" bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="38">
        條 <font color="#666666">(0為顯示所有記錄)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">每頁顯示記錄數</td>
      <td height="25" bgcolor="#FFFFFF"><input name="tnum" type="text" id="tnum" value="<?=$r[tnum]?>" size="38">
        條記錄</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">頁面內容<font color="#666666">(支持標籤同封面模板)</font></td>
      <td height="25" bgcolor="#FFFFFF">請將內容<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.classtext.value);document.form1.classtext.select()" title="點擊複製模板內容"><strong>複製到Dreamweaver(推薦)</strong></a>或者使用<a href="#ecms" onclick="window.open('../template/editor.php?<?=$ecms_hashur['ehref']?>&getvar=opener.document.form1.classtext.value&returnvar=opener.document.form1.classtext.value&fun=ReturnHtml','editclasstext','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>模板在線編輯</strong></a>進行可視化編輯</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <textarea name="classtext" cols="80" rows="23" id="classtext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($addr[classtext]))?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"></div></td>
      <td bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="提交"> &nbsp;&nbsp; 
        <input type="reset" name="Submit2" value="重置"> </td>
    </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>