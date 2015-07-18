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
//默認數據庫
if(!empty($public_r['ebakthisdb'])){
	echo"正轉到默認的數據庫,請稍等......<script>self.location.href='ChangeTable.php?mydbname=".$ecms_config['db']['dbname'].$ecms_hashur['ehref']."'</script>";
	exit();
}
$sql=$empire->query("SHOW DATABASES");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>選擇數據庫</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function DoDrop(dbname)
{var ok;
ok=confirm("確認要刪除此數據庫?");
if(ok)
{
self.location.href='phome.php?<?=$ecms_hashur['href']?>&phome=DropDb&mydbname='+dbname;
}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置：備份數據 -&gt; <a href="ChangeDb.php<?=$ecms_hashur['whehref']?>">選擇數據庫</a></td>
  </tr>
  <tr>
    <td height="25"><div align="center">備份步驟：<font color="#FF0000">選擇數據庫</font> 
        -&gt; 選擇要備份的表 -&gt; 開始備份 -&gt; 完成</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="60%" height="25"> 
      <div align="center">數據庫名</div></td>
    <td width="40%" height="25"> 
      <div align="center">備份</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  if($r[0]==$ecms_config['db']['dbname'])
  {
  $bgcolor="#DBEAF5";
  }
  else
  {
  $bgcolor="#FFFFFF";
  }
  ?>
  <tr bgcolor="<?=$bgcolor?>"> 
    <td height="25"> 
      <div align="center"><?=$r[0]?></div></td>
    <td height="25"> 
      <div align="center"> 
        <input type="button" name="Submit" value="備份數據" onclick="self.location.href='ChangeTable.php?mydbname=<?=$r[0]?><?=$ecms_hashur['ehref']?>';">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Submit3" value="刪除數據庫" onclick="javascript:DoDrop('<?=$r[0]?>')">
      </div></td>
  </tr>
  <?php
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="2"><form name="form1" method="post" action="phome.php">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
		<?=$ecms_hashur['form']?>
          <tr class="header"> 
            <td height="25">建立數據庫
              <input name="phome" type="hidden" id="phome" value="CreateDb">
              </td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">數據庫名： 
              <input name="mydbname" type="text" id="mydbname">
              <select name="mydbchar" id="mydbchar">
                <option value="">默認編碼</option>
                <option value="gbk">gbk</option>
                <option value="utf8">utf8</option>
                <option value="gb2312">gb2312</option>
                <option value="big5">big5</option>
				<option value="latin1">latin1</option>
              </select> 
              <input type="submit" name="Submit2" value="建立">
            </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>
