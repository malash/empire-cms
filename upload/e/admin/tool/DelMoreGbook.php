<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../class/com_functions.php");
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
CheckLevel($logininid,$loginin,$classid,"gbook");

//批量刪除留言(條件)
function DelMoreGbook($add,$logininid,$loginin){
	global $empire,$dbtbpre;
    CheckLevel($logininid,$loginin,$classid,"gbook");//驗證權限
	//變量處理
	$name=RepPostStr($add['name']);
	$ip=RepPostVar($add['ip']);
	$email=RepPostStr($add['email']);
	$mycall=RepPostStr($add['mycall']);
	$lytext=RepPostStr($add['lytext']);
	$startlyid=(int)$add['startlyid'];
	$endlyid=(int)$add['endlyid'];
	$startlytime=RepPostVar($add['startlytime']);
	$endlytime=RepPostVar($add['endlytime']);
	$checked=(int)$add['checked'];
	$ismember=(int)$add['ismember'];
	$bid=(int)$add['bid'];
	$havere=(int)$add['havere'];
	$where='';
	//留言分類
	if($bid)
	{
		$where.=" and bid='$bid'";
	}
	//是否會員
	if($ismember)
	{
		if($ismember==1)
		{
			$where.=" and userid=0";
		}
		else
		{
			$where.=" and userid>0";
		}
	}
	//留言ID
	if($endlyid)
	{
		$where.=' and lyid BETWEEN '.$startlyid.' and '.$endlyid;
	}
	//發佈時間
	if($startlytime&&$endlytime)
	{
		$where.=" and lytime>='$startlytime' and lytime<='$endlytime'";
	}
	//是否審核
	if($checked)
	{
		$checkval=$checked==1?0:1;
		$where.=" and checked='$checkval'";
	}
	//是否回復
	if($havere)
	{
		if($havere==1)
		{
			$where.=" and retext<>''";
		}
		else
		{
			$where.=" and retext=''";
		}
	}
	//姓名
	if($name)
	{
		$where.=" and name like '%$name%'";
	}
	//發佈IP
	if($ip)
	{
		$where.=" and ip like '%$ip%'";
	}
	//郵箱
	if($email)
	{
		$where.=" and email like '%$email%'";
	}
	//電話
	if($mycall)
	{
		$where.=" and `mycall` like '%$mycall%'";
	}
	//留言內容
	if($lytext)
	{
		$where.=" and lytext like '%$lytext%'";
	}
    if(!$where)
	{
		printerror("EmptyDelMoreGbook","history.go(-1)");
	}
	$where=substr($where,5);
	$sql=$empire->query("delete from {$dbtbpre}enewsgbook where ".$where);
	insert_dolog("");//操作日誌
	printerror("DelGbookSuccess","DelMoreGbook.php".hReturnEcmsHashStrHref2(1));
}

$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=='DelMoreGbook')
{
	@set_time_limit(0);
	DelMoreGbook($_POST,$logininid,$loginin);
}

$gbclass=ReturnGbookClass(0,0);

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>批量刪除留言</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href=gbook.php<?=$ecms_hashur['whehref']?>>管理留言</a>&nbsp;>&nbsp;批量刪除留言</td>
  </tr>
</table>
<form name="form1" method="post" action="DelMoreGbook.php" onsubmit="return confirm('確認要刪除?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">批量刪除留言 <input name="enews" type="hidden" id="enews" value="DelMoreGbook"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">所屬留言分類：</td>
      <td height="25"><select name="bid" id="bid">
          <option value="0">不限</option>
		  <?=$gbclass?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">留言IP包含：</td>
      <td height="25"><input name=ip type=text id="ip"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">姓名包含：</td>
      <td width="81%" height="25"><input name=name type=text id="name"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">郵箱包含：</td>
      <td height="25"><input name=email type=text id="email"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">電話包含：</td>
      <td height="25"><input name=mycall type=text id="mycall"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">留言內容包含：</td>
      <td height="25"><textarea name="lytext" cols="70" rows="5" id="lytext"></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">留言ID 介於：</td>
      <td height="25"><input name="startlyid" type="text" id="startlyid">
        -- 
        <input name="endlyid" type="text" id="endlyid"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">留言時間 介於：</td>
      <td height="25"><input name="startlytime" type="text" id="startlytime" onclick="setday(this)">
        -- 
        <input name="endlytime" type="text" id="endlytime" onclick="setday(this)">
        <font color="#666666">(格式：2011-01-27)</font></td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">是否會員發佈：</td>
      <td height="25"><input name="ismember" type="radio" value="0" checked>
        不限 
        <input type="radio" name="ismember" value="1">
        遊客發佈 
        <input type="radio" name="ismember" value="2">
        會員發佈</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" valign="top">是否有回復：</td>
      <td height="25"><input name="havere" type="radio" value="0" checked>
        不限 
        <input name="havere" type="radio" value="1">
        已回復留言 
        <input name="havere" type="radio" value="2">
        未回復留言</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">是否審核：</td>
      <td height="25"><input name="checked" type="radio" value="0" checked>
        不限 
        <input name="checked" type="radio" value="1">
        已審核留言
<input name="checked" type="radio" value="2">
        未審核留言</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="刪除留言"> </td>
    </tr>
  </table>
</form>
</body>
</html>
