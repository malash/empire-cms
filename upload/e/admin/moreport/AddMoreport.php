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
CheckLevel($logininid,$loginin,$classid,"moreport");
$enews=ehtmlspecialchars($_GET['enews']);
$r['ppath']=ReturnAbsEcmsPath();
$url="<a href=ListMoreport.php".$ecms_hashur['whehref'].">管理網站訪問端</a> &gt; 增加網站訪問端";
$postword='增加網站訪問端';
if($enews=="EditMoreport")
{
	$pid=(int)$_GET['pid'];
	if($pid==1)
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmoreport where pid='$pid' limit 1");
	$url="<a href=ListMoreport.php".$ecms_hashur['whehref'].">管理網站訪問端</a> &gt; 修改網站訪問端：<b>".$r[pname]."</b>";
	$postword='修改網站訪問端';
}
$tgtemps='';
$tgsql=$empire->query("select gid,gname,isdefault from {$dbtbpre}enewstempgroup order by gid");
while($tgr=$empire->fetch($tgsql))
{
	$selected='';
	if($tgr['gid']==$r['tempgid'])
	{
		$selected=' selected';
	}
	$tgtemps.="<option value='".$tgr['gid']."'".$selected.">".$tgr['gname']."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>網站訪問端</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="moreportform" method="post" action="ListMoreport.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><?=$postword?> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
        <input name="pid" type="hidden" id="pid" value="<?=$pid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="25%" height="25">訪問端名稱：</td>
      <td width="75%" height="25"><input name="pname" type="text" id="pname" value="<?=$r[pname]?>" size="50">
      *
        <font color="#666666">(比如：手機訪問端)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">訪問端地址：</td>
      <td height="25"><input name="purl" type="text" id="purl" value="<?=$r[purl]?>" size="50">
        *        <font color="#666666">(結尾需加「/」，比如：http://3g.phome.net/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">訪問端目錄：</td>
      <td height="25"><input name="ppath" type="text" id="ppath" value="<?=$r[ppath]?>" size="50">
        *<font color="#666666">(需填絕對目錄地址，結尾需加「/」，比如：d:/abc/3g/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">通訊密鑰：</td>
      <td height="25"><input name="postpass" type="text" id="postpass" value="<?=$r[postpass]?>" size="50">
        *
        <input type="button" name="Submit32" value="隨機" onclick="document.moreportform.postpass.value='<?=make_password(60)?>';">
      <font color="#666666">(填寫10~100個任意字符，最好多種字符組合)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">使用模板組：</td>
      <td height="25"><select name="tempgid" id="tempgid">
        <?=$tgtemps?>
      </select>
        *        <font color="#666666">(選擇本訪問端使用的模板組)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">頁面模式：</td>
      <td height="25"><input type="radio" name="mustdt" value="1"<?=$r[mustdt]==1?' checked':''?>>
        <a href="#empirecms" title="強制動態頁面模式時，訪問端首頁、欄目、內容頁等均採用動態頁面方式顯示，好處是：不用再生成靜態頁面">強制動態頁面模式</a>
        <input type="radio" name="mustdt" value="0"<?=$r[mustdt]==0?' checked':''?>>
        <a href="#empirecms" title="與主端相同：如果主端是採用靜態頁面模式，需要在本訪問端後台生成頁面，才會同步顯示。">與主端相同</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">關閉訪問端：</td>
      <td height="25"><input name="isclose" type="checkbox" id="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
      關閉</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">關閉投稿：</td>
      <td height="25"><input name="closeadd" type="checkbox" id="closeadd" value="1"<?=$r[closeadd]==1?' checked':''?>>
        關閉</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交">&nbsp;<input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>