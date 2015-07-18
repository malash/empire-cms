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
CheckLevel($logininid,$loginin,$classid,"memberf");
$enews=ehtmlspecialchars($_GET['enews']);
$ftype=" checked";
$record="<!--record-->";
$field="<!--field--->";
$url="<a href='ListMemberForm.php".$ecms_hashur['whehref']."'>管理會員表單</a>&nbsp;>&nbsp;增加會員表單";
$postword='增加會員表單';
if($enews=="AddMemberForm"&&$_GET['docopy'])
{
	$fid=(int)$_GET['fid'];
	$ftype="";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmemberform where fid='$fid'");
	$url="<a href='ListMemberForm.php".$ecms_hashur['whehref']."'>管理會員表單</a>&nbsp;>&nbsp;複製會員表單: ".$r['fname'];
	$postword='複製會員表單';
}
//修改
if($enews=="EditMemberForm")
{
	$fid=(int)$_GET['fid'];
	$ftype="";
	$url="<a href='ListMemberForm.php".$ecms_hashur['whehref']."'>管理會員表單</a>&nbsp;>&nbsp;修改會員表單";
	$postword='修改會員表單';
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmemberform where fid='$fid'");
}
//取得字段
$no=0;
$fsql=$empire->query("select f,fname from {$dbtbpre}enewsmemberf order by myorder,fid");
while($fr=$empire->fetch($fsql))
{
	$no++;
	$bgcolor="ffffff";
	if($no%2==0)
	{
		$bgcolor="#F8F8F8";
	}
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
	$entercheckbox="<input name=center[] type=checkbox value='".$fr[f]."'".$enterchecked.">";
	//前台顯示項
	if(strstr($r[viewenter],$like))
	{
		$viewenterchecked=" checked";
	}
	else
	{
		$viewenterchecked="";
	}
	$viewentercheckbox="<input name=venter[] type=checkbox value='".$fr[f]."'".$viewenterchecked.">";
	//必填項
	$mustfchecked="";
	if(strstr($r[mustenter],$slike))
	{$mustfchecked=" checked";}
	$mustfcheckbox="<input name=menter[] type=checkbox value='".$fr[f]."'".$mustfchecked.">";
	//搜索項
	$searchchecked="";
	if(strstr($r[searchvar],$slike))
	{
		$searchchecked=" checked";
	}
	$searchcheckbox="<input name=schange[] type=checkbox value='".$fr[f]."'".$searchchecked.">";
	//可增加
	$canaddfchecked="";
	if(strstr($r[canaddf],$slike))
	{
		$canaddfchecked=" checked";
	}
	if($enews=="AddMemberForm")
	{
		$canaddfchecked=" checked";
	}
	$canaddfcheckbox="<input name=canadd[] type=checkbox value='".$fr[f]."'".$canaddfchecked.">";
	//可修改
	$caneditfchecked="";
	if(strstr($r[caneditf],$slike))
	{
		$caneditfchecked=" checked";
	}
	if($enews=="AddMemberForm")
	{
		$caneditfchecked=" checked";
	}
	$caneditfcheckbox="<input name=canedit[] type=checkbox value='".$fr[f]."'".$caneditfchecked.">";
	$data.="<tr bgcolor='".$bgcolor."'> 
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
			  <td><div align=center> 
                ".$canaddfcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$caneditfcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$searchcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$viewentercheckbox."
              </div></td>
          </tr>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>增加會員表單</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmsmember.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header"><?=$postword?> 
        <input name="fid" type="hidden" id="fid" value="<?=$fid?>"> <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">表單名稱</td>
      <td width="81%" height="25"><input name="fname" type="text" id="fname" value="<?=$r[fname]?>" size="43">
        <font color="#666666">(比如：個人註冊) </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">選擇本表單的字段項<br>
        <br> <br> <input type="button" name="Submit3" value="字段管理" onclick="window.open('ListMemberF.php<?=$ecms_hashur['whehref']?>');"> 
      </td>
      <td height="25" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr bgcolor="#DBEAF5"> 
            <td width="26%" height="25"> <div align="center">字段標識</div></td>
            <td width="25%" height="25"> <div align="center">字段名</div></td>
            <td width="8%"> <div align="center">錄入項</div></td>
            <td width="8%"> <div align="center">必填項</div></td>
            <td width="8%"><div align="center">可增加</div></td>
            <td width="8%"><div align="center">可修改</div></td>
            <td width="8%"><div align="center">搜索項</div></td>
            <td width="9%"><div align="center">前台顯示</div></td>
          </tr>
          <?=$data?>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><p>錄入表單模板<br>
          <br>
          (<font color="#FF0000"> 
          <input name="ftype" type="checkbox" id="ftype" value="1"<?=$ftype?>>
          自動生成表單</font>)</p></td>
      <td height="25"><textarea name="ftemp" cols="75" rows="20" id="ftemp" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[ftemp]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">註釋：</td>
      <td height="25"><textarea name="fzs" cols="75" rows="10" id="fzs" style="WIDTH: 100%"><?=stripSlashes($r[fzs])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
