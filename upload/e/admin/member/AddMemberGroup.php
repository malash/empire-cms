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
CheckLevel($logininid,$loginin,$classid,"member");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListMemberGroup.php".$ecms_hashur['whehref'].">管理會員組</a>&nbsp;>&nbsp;增加會員組";
$r[level]=1;
$r[favanum]=120;
$r[daydown]=0;
$r[msgnum]=50;
$r[msglen]=255;
if($enews=="EditMemberGroup")
{
	$groupid=(int)$_GET['groupid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmembergroup where groupid='$groupid'");
	$url="<a href=ListMemberGroup.php".$ecms_hashur['whehref'].">管理會員組</a>&nbsp;>&nbsp;修改會員組：<b>".$r[groupname]."</b>";
	if($r[checked])
	{$checked=" checked";}
}
//會員表單
$memberform='';
$fsql=$empire->query("select fid,fname from {$dbtbpre}enewsmemberform order by fid");
while($fr=$empire->fetch($fsql))
{
	if($r['formid']==$fr[fid])
	{
		$selected=' selected';
	}
	else
	{
		$selected='';
	}
	$memberform.="<option value='".$fr[fid]."'".$selected.">".$fr[fname]."</option>";
}
//空間模板
$spacestyle='';
$sssql=$empire->query("select styleid,stylename from {$dbtbpre}enewsspacestyle order by styleid");
while($ssr=$empire->fetch($sssql))
{
	if($r['spacestyleid']==$ssr[styleid])
	{
		$selected=' selected';
	}
	else
	{
		$selected='';
	}
	$spacestyle.="<option value='".$ssr[styleid]."'".$selected.">".$ssr[stylename]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>會員組</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td height="25">位置： 
      <?=$url?>
    </td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmsmember.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="22%" height="25">增加會員組</td>
      <td width="78%" height="25"><input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="groupid" type="hidden" id="groupid" value="<?=$groupid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">會員組名稱</td>
      <td height="25"> <input name="groupname" type="text" id="groupname" value="<?=$r[groupname]?>" size="38"> 
        <font color="#666666">(比如：VIP會員,普通會員)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">會員組級別值</td>
      <td height="25"> <input name="level" type="text" id="level" value="<?=$r[level]?>" size="38"> 
        <font color="#666666">(如：1,2...等，級別值越高權限越大)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">最大收藏夾數</td>
      <td height="25"><input name="favanum" type="text" id="favanum" value="<?=$r[favanum]?>" size="38"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">每天最大下載數</td>
      <td height="25"><input name="daydown" type="text" id="daydown" value="<?=$r[daydown]?>" size="38"> 
        <font color="#666666">(0為不限制)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">每天最大投稿數</td>
      <td height="25"><input name="dayaddinfo" type="text" id="dayaddinfo" value="<?=$r[dayaddinfo]?>" size="38"> 
        <font color="#666666">(0為不限制)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">投稿信息是否審核</td>
      <td height="25"><input name="infochecked" type="checkbox" id="infochecked" value="1"<?=$r[infochecked]==1?' checked':''?>>
        直接通過,不用審核</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">評論是否審核</td>
      <td height="25"><input name="plchecked" type="checkbox" id="plchecked" value="1"<?=$r[plchecked]==1?' checked':''?>>
        直接通過,不用審核</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">最大短消息數</td>
      <td height="25"><input name="msgnum" type="text" id="msgnum" value="<?=$r[msgnum]?>" size="38"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">短消息最大字數</td>
      <td height="25"><input name="msglen" type="text" id="msglen" value="<?=$r[msglen]?>" size="38">
        個字節</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">信息使用表單</td>
      <td height="25"><select name="formid" id="formid">
          <?=$memberform?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">前台可註冊</td>
      <td height="25"><input type="radio" name="canreg" value="1"<?=$r[canreg]==1?' checked':''?>>
        是 
        <input type="radio" name="canreg" value="0"<?=$r[canreg]==0?' checked':''?>>
        否</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">註冊需要審核</td>
      <td height="25"><input type="radio" name="regchecked" value="1"<?=$r[regchecked]==1?' checked':''?>>
        是 
        <input type="radio" name="regchecked" value="0"<?=$r[regchecked]==0?' checked':''?>>
        否</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">會員默認空間模板</td>
      <td height="25"><select name="spacestyleid" id="spacestyleid">
          <option value=0>不設置</option>
          <?=$spacestyle?>
        </select> <font color="#666666">(不設置則使用默認空間模板) </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
