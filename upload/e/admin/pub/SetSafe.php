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
CheckLevel($logininid,$loginin,$classid,"setsafe");
if($ecms_config['esafe']['openonlinesetting']==0||$ecms_config['esafe']['openonlinesetting']==1)
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
if($enews=='SetSafe')
{
	SetSafe($_POST,$logininid,$loginin);
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>安全參數配置</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：<a href="SetSafe.php<?=$ecms_hashur['whehref']?>">安全參數配置</a> 
      <div align="right"> </div></td>
  </tr>
</table>
<form name="setform" method="post" action="SetSafe.php" onsubmit="return confirm('確認設置?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">安全參數配置 
        <input name="enews" type="hidden" id="enews" value="SetSafe"> </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">後台安全相關配置</td>
    </tr>
    <tr> 
      <td width="17%" height="25" bgcolor="#FFFFFF"> <div align="left">後台登陸認證碼</div></td>
      <td width="83%" height="25" bgcolor="#FFFFFF"> <input name="loginauth" type="password" id="loginauth" value="<?=$ecms_config['esafe']['loginauth']?>" size="35"> 
        <font color="#666666">(如果設置登錄需要輸入此認證碼才能通過)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="left">後台登錄COOKIE認證碼</div></td>
      <td height="25" bgcolor="#FFFFFF"> <input name="ecookiernd" type="text" id="ecookiernd" value="<?=$ecms_config['esafe']['ecookiernd']?>" size="35"> 
        <input type="button" name="Submit3" value="隨機" onclick="document.setform.ecookiernd.value='<?=make_password(36)?>';"> 
        <font color="#666666">(填寫10~50個任意字符，最好多種字符組合)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">後台開啟驗證登錄IP</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="ckhloginip" value="1"<?=$ecms_config['esafe']['ckhloginip']==1?' checked':''?>>
        開啟 
        <input type="radio" name="ckhloginip" value="0"<?=$ecms_config['esafe']['ckhloginip']==0?' checked':''?>>
        關閉 <font color="#666666">(如果上網的IP是變動的，不要開啟)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">後台啟用SESSION驗證</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ckhsession" value="1"<?=$ecms_config['esafe']['ckhsession']==1?' checked':''?>>
        開啟 
        <input type="radio" name="ckhsession" value="0"<?=$ecms_config['esafe']['ckhsession']==0?' checked':''?>>
        關閉 <font color="#666666">(更安全，需空間支持SESSION)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">記錄登陸日誌</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="theloginlog" value="0"<?=$ecms_config['esafe']['theloginlog']==0?' checked':''?>>
        開啟 
        <input type="radio" name="theloginlog" value="1"<?=$ecms_config['esafe']['theloginlog']==1?' checked':''?>>
        關閉</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">記錄操作日誌</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="thedolog" value="0"<?=$ecms_config['esafe']['thedolog']==0?' checked':''?>>
        開啟 
        <input type="radio" name="thedolog" value="1"<?=$ecms_config['esafe']['thedolog']==1?' checked':''?>>
        關閉</td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">開啟訪問來源驗證</td>
      <td height="25" bgcolor="#FFFFFF"><select name="ckfromurl" id="ckfromurl">
          <option value="0"<?=$ecms_config['esafe']['ckfromurl']==0?' selected':''?>>不開啟驗證</option>
          <option value="1"<?=$ecms_config['esafe']['ckfromurl']==1?' selected':''?>>開啟前後台驗證</option>
          <option value="2"<?=$ecms_config['esafe']['ckfromurl']==2?' selected':''?>>僅開啟後台驗證</option>
          <option value="3"<?=$ecms_config['esafe']['ckfromurl']==3?' selected':''?>>僅開啟前台驗證</option>
        </select>
        <font color="#666666">(設置禁止非本站訪問地址來源)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">開啟後台來源認證碼</td>
      <td height="25" bgcolor="#FFFFFF"><select name="ckhash" id="ckhash">
        <option value="0"<?=$ecms_config['esafe']['ckhash']==0?' selected':''?>>金剛模式</option>
        <option value="1"<?=$ecms_config['esafe']['ckhash']==1?' selected':''?>>刺蝟模式</option>
        <option value="2"<?=$ecms_config['esafe']['ckhash']==2?' selected':''?>>關閉驗證</option>
      </select>
        <font color="#666666">(推薦啟用「金剛模式」，對外部訪問與提交進行防禦)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">COOKIE配置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE作用域</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="cookiedomain" type="text" id="fw_pass3" value="<?=$ecms_config['cks']['ckdomain']?>" size="35">      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE作用路徑</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookiepath" type="text" id="cookiedomain" value="<?=$ecms_config['cks']['ckpath']?>" size="35"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">前台COOKIE變量前綴</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookievarpre" type="text" id="cookievarpre" value="<?=$ecms_config['cks']['ckvarpre']?>" size="35"> 
        <font color="#666666">(由英文字母組成,5~12個字符組成)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">後台COOKIE變量前綴</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookieadminvarpre" type="text" id="cookieadminvarpre" value="<?=$ecms_config['cks']['ckadminvarpre']?>" size="35"> 
        <font color="#666666">(由英文字母組成,5~12個字符組成)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE驗證隨機碼</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="cookieckrnd" type="text" id="cookieckrnd" value="<?=$ecms_config['cks']['ckrnd']?>" size="35"> 
        <input type="button" name="Submit32" value="隨機" onclick="document.setform.cookieckrnd.value='<?=make_password(36)?>';"> 
        <font color="#666666">(填寫10~50個任意字符，最好多種字符組合)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">COOKIE驗證隨機碼2</td>
      <td height="25" bgcolor="#FFFFFF"><input name="cookieckrndtwo" type="text" id="cookieckrndtwo" value="<?=$ecms_config['cks']['ckrndtwo']?>" size="35">
        <input type="button" name="Submit322" value="隨機" onclick="document.setform.cookieckrndtwo.value='<?=make_password(36)?>';">
        <font color="#666666">(填寫10~50個任意字符，最好多種字符組合)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"></td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value=" 設 置 "> 
        &nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
