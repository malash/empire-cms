<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/functions.php");
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
//驗證權限
CheckLevel($logininid,$loginin,$classid,"dbdata");
$bakpath=$public_r['bakdbpath'];
$hand=@opendir($bakpath);
$form='ebakredata';
if($_GET['toform'])
{
	$form=RepPostVar($_GET['toform']);
}
$onclickword='(點擊轉向恢復數據)';
$change=(int)$_GET['change'];
if($change==1)
{
	$onclickword='(點擊選擇)';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理備份目錄</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ChangePath(pathname)
{
opener.document.<?=$form?>.mypath.value=pathname;
window.close();
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：<a href="ChangePath.php<?=$ecms_hashur['whehref']?>">管理備份目錄</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="45%" height="25"> 
      <div align="center">備份目錄名<?=$onclickword?></div></td>
    <td width="20%" height="25"> 
      <div align="center">查看說明文件</div></td>
    <td width="35%"> 
      <div align="center">操作</div></td>
  </tr>
  <?php
  while($file=@readdir($hand))
  {
	if($file!="."&&$file!=".."&&is_dir($bakpath."/".$file))
	{
		if($change==1)
		{
			$showfile="<a href='#ebak' onclick=\"javascript:ChangePath('$file');\" title='$file'>$file</a>";
		}
		else
		{
			$showfile="<a href='phome.php?phome=PathGotoRedata&mypath=$file".$ecms_hashur['href']."' title='$file'>$file</a>";
		}
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"> <div align="left"><img src="images/dir.gif" width="19" height="15">&nbsp; 
        <?=$showfile?> </div></td>
    <td height="25"> <div align="center"> [<a href="<?php echo $bakpath."/".$file."/readme.txt"?>" target=_blank>查看備份說明</a>]</div></td>
    <td><div align="center">[<a href="#ebak" onclick="window.open('phome.php?phome=DoZip&p=<?=$file?>&change=<?=$change?><?=$ecms_hashur['href']?>','','width=350,height=160');">打包並下載</a>]&nbsp;&nbsp;&nbsp;[<a href="phome.php?phome=DelBakpath&path=<?=$file?>&change=<?=$change?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除目錄</a>]</div></td>
  </tr>
  <?php
     }
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="3">&nbsp;</td>
  </tr>
</table>
</body>
</html>