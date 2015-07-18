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
CheckLevel($logininid,$loginin,$classid,"delinfodata");
//欄目
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//刷新表
$retable="";
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	$retable.="<option value='".$tr[tbname]."'>".$tr[tname]."(".$tr[tbname].")</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>按條件刪除信息</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<a href="DelData.php<?=$ecms_hashur['whehref']?>">按條件刪除信息</a></td>
  </tr>
</table>
<form action="../ecmsinfo.php" method="get" name="form1" onsubmit="return confirm('確認要刪除?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> <div align="center">按條件刪除信息</div></td>
    </tr>
    <tr> 
      <td width="20%" height="25" bgcolor="#FFFFFF">選擇數據表</td>
      <td width="80%" bgcolor="#FFFFFF"><select name="tbname" id="tbname">
          <option value=''>------ 選擇數據表 ------</option>
          <?=$retable?>
        </select>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">選擇欄目</td>
      <td bgcolor="#FFFFFF"><select name="classid" id="select">
          <option value="0">所有欄目</option>
          <?=$class?>
        </select> <font color="#666666">(如選擇父欄目，將刪除所有子欄目)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <input name="retype" type="radio" value="0" checked>
        按時間刪除</td>
      <td bgcolor="#FFFFFF">從 
        <input name="startday" type="text" size="12" onclick="setday(this)">
        到 
        <input name="endday" type="text" size="12" onclick="setday(this)">
        之間的數據 <font color="#666666">(不填為不限)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><input name="retype" type="radio" value="1">
        按ID刪除</td>
      <td bgcolor="#FFFFFF">從 
        <input name="startid" type="text" id="startid2" value="0" size="6">
        到 
        <input name="endid" type="text" id="endid2" value="0" size="6">
        之間的數據 <font color="#666666">(兩個值0為不限)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">是否審核</td>
      <td bgcolor="#FFFFFF"><input name="infost" type="radio" value="0" checked>
        不限 
        <input name="infost" type="radio" value="1">
        已審核 
        <input name="infost" type="radio" value="2">
        未審核</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">是否用戶發佈</td>
      <td bgcolor="#FFFFFF"><input name="ismember" type="radio" value="0" checked>
        不限 <input type="radio" name="ismember" value="1">
        遊客發佈 
        <input type="radio" name="ismember" value="2">
        會員+用戶發佈 
        <input type="radio" name="ismember" value="3">
        會員發佈 
        <input type="radio" name="ismember" value="4">
        用戶發佈</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">是否外部鏈接</td>
      <td bgcolor="#FFFFFF"><input name="isurl" type="radio" value="0" checked>
        不限 <input type="radio" name="isurl" value="1">
        外部鏈接信息 
        <input type="radio" name="isurl" value="2">
        內部信息</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">評論數少於</td>
      <td bgcolor="#FFFFFF"><input name="plnum" type="text" id="plnum" size="38"> <font color="#666666">(不設置為不限)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">點擊數少於</td>
      <td bgcolor="#FFFFFF"><input name="onclick" type="text" id="onclick" size="38"> <font color="#666666">(不設置為不限)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">下載數少於</td>
      <td bgcolor="#FFFFFF"><input name="totaldown" type="text" id="totaldown" size="38"> 
        <font color="#666666">(不設置為不限)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">標題包含字符</td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="38"> <font color="#666666">(多個字符用「|」隔開)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">發佈者帳號ID</td>
      <td bgcolor="#FFFFFF"><select name="usertype" id="usertype">
          <option value="0">會員ID</option>
          <option value="1">用戶ID</option>
        </select>
        <input name="userids" type="text" id="userids" size="28">
        <font color="#666666">(多個用「,」逗號隔開)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">刪除HTML文件</td>
      <td bgcolor="#FFFFFF"><input name="delhtml" type="radio" value="0" checked>
        刪除 
        <input type="radio" name="delhtml" value="1">
        不刪除 </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit6" value="批量刪除"> 
        <input name="enews" type="hidden" id="enews2" value="DelInfoData"> </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25">說明: 會員為前台註冊會員，用戶為後台管理員。刪除後的數據不能恢復,請謹慎使用。</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
