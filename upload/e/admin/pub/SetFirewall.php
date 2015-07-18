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
CheckLevel($logininid,$loginin,$classid,"firewall");
if($ecms_config['esafe']['openonlinesetting']==0||$ecms_config['esafe']['openonlinesetting']==2)
{
	echo"沒有開啟後台在線配置參數，如果要使用在線配置先修改/e/config/config.php文件的\$ecms_config['esafe']['openonlinesetting']變量設置開啟";
	exit();
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include('setfun.php');
}
if($enews=='SetFirewall')
{
	SetFirewall($_POST,$logininid,$loginin);
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>網站防火牆</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：<a href="SetFirewall.php<?=$ecms_hashur['whehref']?>">網站防火牆</a> 
      <div align="right"> </div></td>
  </tr>
</table>
<form name="setform" method="post" action="SetFirewall.php" onsubmit="return confirm('確認設置?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">網站防火牆 <input name="enews" type="hidden" id="enews" value="SetFirewall"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="left">開啟防火牆</div></td>
      <td height="25"><input type="radio" name="fw_open" value="1"<?=$ecms_config['fw']['eopen']==1?' checked':''?>>
        開啟 
        <input type="radio" name="fw_open" value="0"<?=$ecms_config['fw']['eopen']==0?' checked':''?>>
        關閉</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="17%" height="25"><div align="left">防火牆加密密鑰</div></td>
      <td width="83%" height="25"><input name="fw_pass" type="text" id="fw_pass" value="<?=$ecms_config['fw']['epass']?>" size="35">
        <font color="#666666">
        <input type="button" name="Submit3" value="隨機" onclick="document.setform.fw_pass.value='<?=make_password(36)?>';">
        (填寫10~50個任意字符，最好多種字符組合)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">
<div align="left">允許後台登陸的域名</div></td>
      <td height="25"><input name="fw_adminloginurl" type="text" id="fw_adminloginurl" value="<?=$ecms_config['fw']['adminloginurl']?>" size="35">
        <font color="#666666"><br>
        (設置後必須通過這個域名才能訪問後台，如：http://admin.phome.net)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">允許登陸後台的時間點<br> <font color="#666666">(不選為不限制)</font></td>
      <td height="25"><table width="500" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="0"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',0,')?' checked':''?>>
              0點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="1"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',1,')?' checked':''?>>
              1點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="2"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',2,')?' checked':''?>>
              2點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="3"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',3,')?' checked':''?>>
              3點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="4"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',4,')?' checked':''?>>
              4點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="5"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',5,')?' checked':''?>>
              5點</td>
          </tr>
          <tr> 
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="6"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',6,')?' checked':''?>>
              6點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="7"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',7,')?' checked':''?>>
              7點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="8"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',8,')?' checked':''?>>
              8點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="9"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',9,')?' checked':''?>>
              9點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="10"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',10,')?' checked':''?>>
              10點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="11"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',11,')?' checked':''?>>
              11點</td>
          </tr>
          <tr> 
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="12"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',12,')?' checked':''?>>
              12點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="13"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',13,')?' checked':''?>>
              13點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="14"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',14,')?' checked':''?>>
              14點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="15"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',15,')?' checked':''?>>
              15點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="16"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',16,')?' checked':''?>>
              16點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="17"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',17,')?' checked':''?>>
              17點</td>
          </tr>
          <tr> 
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="18"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',18,')?' checked':''?>>
              18點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="19"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',19,')?' checked':''?>>
              19點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="20"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',20,')?' checked':''?>>
              20點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="21"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',21,')?' checked':''?>>
              21點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="22"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',22,')?' checked':''?>>
              22點</td>
            <td><input name="fw_adminhour[]" type="checkbox" id="fw_adminhour[]" value="23"<?=strstr(','.$ecms_config['fw']['adminhour'].',',',23,')?' checked':''?>>
              23點</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">允許登陸後台的星期<br> <font color="#666666">(不選為不限制)</font> </td>
      <td height="25"><table width="500" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td><input name="fw_adminweek[]" type="checkbox" id="fw_adminweek[]" value="1"<?=strstr(','.$ecms_config['fw']['adminweek'].',',',1,')?' checked':''?>>
              星期一</td>
            <td><input name="fw_adminweek[]" type="checkbox" id="fw_adminweek[]" value="2"<?=strstr(','.$ecms_config['fw']['adminweek'].',',',2,')?' checked':''?>>
              星期二</td>
            <td><input name="fw_adminweek[]" type="checkbox" id="fw_adminweek[]" value="3"<?=strstr(','.$ecms_config['fw']['adminweek'].',',',3,')?' checked':''?>>
              星期三</td>
            <td><input name="fw_adminweek[]" type="checkbox" id="fw_adminweek[]" value="4"<?=strstr(','.$ecms_config['fw']['adminweek'].',',',4,')?' checked':''?>>
              星期四</td>
          </tr>
          <tr> 
            <td><input name="fw_adminweek[]" type="checkbox" id="fw_adminweek[]" value="5"<?=strstr(','.$ecms_config['fw']['adminweek'].',',',5,')?' checked':''?>>
              星期五</td>
            <td><input name="fw_adminweek[]" type="checkbox" id="fw_adminweek[]" value="6"<?=strstr(','.$ecms_config['fw']['adminweek'].',',',6,')?' checked':''?>>
              星期六</td>
            <td><input name="fw_adminweek[]" type="checkbox" id="fw_adminweek[]" value="0"<?=strstr(','.$ecms_config['fw']['adminweek'].',',',0,')?' checked':''?>>
              星期日</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">防火牆後台預登陸驗證變量名</td>
      <td height="25"><input name="fw_adminckpassvar" type="text" id="fw_pass3" value="<?=$ecms_config['fw']['adminckpassvar']?>" size="35">
        <font color="#666666">(由英文字母組成,5~20個字符組成)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">防火牆後台預登陸認證碼</td>
      <td height="25"><input name="fw_adminckpassval" type="text" id="fw_adminckpassval" value="<?=$ecms_config['fw']['adminckpassval']?>" size="35">
        <font color="#666666">
        <input type="button" name="Submit32" value="隨機" onclick="document.setform.fw_adminckpassval.value='<?=make_password(36)?>';">
        (填寫10~50個任意字符，最好多種字符組合)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">
<div align="left">屏蔽提交敏感字符<br>
          <font color="#666666">(多個用半角逗號格開;<br>
          設置屏蔽前台所有提交內容及後台登陸內容)</font></div></td>
      <td height="25"><textarea name="fw_cleargettext" cols="80" rows="8" style="WIDTH: 100%" id="fw_cleargettext"><?=ehtmlspecialchars($ecms_config['fw']['cleargettext'])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"></td>
      <td height="25"><input type="submit" name="Submit" value=" 設 置 "> &nbsp;&nbsp;&nbsp; 
        <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
