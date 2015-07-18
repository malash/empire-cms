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
CheckLevel($logininid,$loginin,$classid,"feedbackf");
$enews=ehtmlspecialchars($_GET['enews']);
$btype=" checked";
$usernames='';
$r['mustenter']=",title,";
$record="<!--record-->";
$field="<!--field--->";
$url="<a href=feedback.php".$ecms_hashur['whhref'].">管理信息反饋</a>&nbsp;>&nbsp;<a href=FeedbackClass.php".$ecms_hashur['whhref'].">管理反饋分類</a>&nbsp;>&nbsp;增加反饋分類";
if($enews=="AddFeedbackClass"&&$_GET['docopy'])
{
	$bid=(int)$_GET['bid'];
	$btype="";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsfeedbackclass where bid='$bid'");
	$url="<a href=feedback.php".$ecms_hashur['whhref'].">管理信息反饋</a>&nbsp;>&nbsp;<a href=FeedbackClass.php".$ecms_hashur['whhref'].">管理反饋分類</a>&nbsp;>&nbsp;複製反饋分類: ".$r['bname'];
	$usernames=substr($r['usernames'],1,-1);
}
//修改
if($enews=="EditFeedbackClass")
{
	$bid=(int)$_GET['bid'];
	$btype="";
	$url="<a href=feedback.php".$ecms_hashur['whhref'].">管理信息反饋</a>&nbsp;->&nbsp;<a href=FeedbackClass.php".$ecms_hashur['whhref'].">管理反饋分類</a>&nbsp;->&nbsp;修改反饋分類";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsfeedbackclass where bid='$bid'");
	$usernames=substr($r['usernames'],1,-1);
}
//取得字段
$fsql=$empire->query("select f,fname from {$dbtbpre}enewsfeedbackf order by myorder,fid");
while($fr=$empire->fetch($fsql))
{
	$like=$field.$fr[f].$record;
	$slike=",".$fr[f].",";
	//錄入項
	$enterchecked="";
	if(strstr($r[enter],$like))
	{
		$enterchecked=" checked";
		//取得字段標識
		$dor=explode($like,$r[enter]);
		if(strstr($dor[0],$record))
		{
			$dor1=explode($record,$dor[0]);
			$last=count($dor1)-1;
			$fr[fname]=$dor1[$last];
		}
		else
		{
			$fr[fname]=$dor[0];
		}
	}
	//標題
	if($enews=="AddFeedbackClass"&&$fr[f]=="title")
	{
		$enterchecked=" checked";
	}
	$entercheckbox="<input name=center[] type=checkbox value='".$fr[f]."'".$enterchecked.">";
	//必填項
	$mustfchecked="";
	if(strstr($r[mustenter],$slike))
	{$mustfchecked=" checked";}
	if($enews=="AddFeedbackClass"&&$fr[f]=="title")
	{
		$mustfchecked=" checked";
	}
	$mustfcheckbox="<input name=menter[] type=checkbox value='".$fr[f]."'".$mustfchecked.">";
	$data.="<tr> 
            <td height=25> <div align=center> 
                <input name=cname[".$fr[f]."] type=text value='".$fr[fname]."'>
              </div></td>
            <td> <div align=center> 
                <input name=cfield type=text value='".$fr[f]."' readonly>
              </div></td>
            <td><div align=center> 
                ".$entercheckbox."
              </div></td>
			  <td><div align=center> 
                ".$mustfcheckbox."
              </div></td>
          </tr>";
}
//----------會員組
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	if($r[groupid]==$l_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$membergroup.="<option value=".$l_r[groupid].$select.">".$l_r[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>增加反饋分類</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="FeedbackClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header">增加反饋分類 
        <input name="bid" type="hidden" id="bid" value="<?=$bid?>"> <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">分類名稱</td>
      <td width="77%" height="25"><input name="bname" type="text" id="bname" value="<?=$r[bname]?>" size="43"> 
        <font color="#666666">(比如：&quot;建議與反饋&quot;)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">管理反饋的用戶</td>
      <td height="25"><input name="usernames" type="text" id="usernames" value="<?=$usernames?>" size="42">
        <font color="#666666"> 
        <input type="button" name="Submit32" value="選擇" onclick="window.open('../ChangeUser.php?field=usernames&form=form1<?=$ecms_hashur['ehref']?>','','width=300,height=520,scrollbars=yes');">
        (空為不限，多個用戶用「,」逗號隔開)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">提交會員組權限</td>
      <td height="25"><select name="groupid" id="groupid">
          <option value="0">遊客</option>
          <?=$membergroup?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">選擇本表單的字段項<br>
        (<font color="#FF0000"> 
        <input name="btype" type="checkbox" value="1"<?=$btype?>>
        自動生成表單</font>)<br> <br> <input type="button" name="Submit3" value="字段管理" onclick="window.open('ListFeedbackF.php<?=$ecms_hashur['whehref']?>');"> 
      </td>
      <td height="25" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr bgcolor="#DBEAF5"> 
            <td width="35%" height="25"> <div align="center">字段標識</div></td>
            <td width="35%" height="25"> <div align="center">字段名</div></td>
            <td width="15%"> <div align="center">提交項</div></td>
            <td width="15%"> <div align="center">必填項</div></td>
          </tr>
          <?=$data?>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><p>錄入表單模板<br>
          (如<font color="#FF0000">自動生成表單模板</font><br>
          ，不用填模板內容)<br>
          <br>
          控制面板頭部標籤：<br>
          [!--cp.header--]<br>
          <br>
          控制面板尾部標籤：<br>
          [!--cp.footer--]<br>
          <br>
          會員中心頭部標籤：<br>
[!--member.header--]<br>
<br>
會員中心尾部標籤：<br>
[!--member.footer--]<br>
          <br>
          (支持公共模板變量)</p></td>
      <td height="25"><textarea name="btemp" cols="75" rows="20" style="WIDTH: 100%" id="btemp"><?=ehtmlspecialchars(stripSlashes($r[btemp]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">註釋：</td>
      <td height="25"><textarea name="bzs" cols="75" rows="10" style="WIDTH: 100%" id="textarea"><?=stripSlashes($r[bzs])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
