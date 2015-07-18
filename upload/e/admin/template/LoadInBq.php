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
CheckLevel($logininid,$loginin,$classid,"bq");
$enews=$_POST['enews'];
$url="<a href=ListBq.php".$ecms_hashur['whehref'].">管理標籤</a>&nbsp;>&nbsp;<a href=LoadInBq.php".$ecms_hashur['whehref'].">導入標籤</a>";
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="LoadInBq")
{
	include('../../class/tempfun.php');
	$file=$_FILES['file']['tmp_name'];
	$file_name=$_FILES['file']['name'];
	$file_type=$_FILES['file']['type'];
	$file_size=$_FILES['file']['size'];
	$r=LoadInBq($_POST,$file,$file_name,$file_type,$file_size,$logininid,$loginin);
}
else
{
	//類別
	$cstr="";
	$csql=$empire->query("select classid,classname from {$dbtbpre}enewsbqclass order by classid");
	while($cr=$empire->fetch($csql))
	{
		$cstr.="<option value='".$cr[classid]."'>".$cr[classname]."</option>";
	}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>導入標籤</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>
<?php
if($enews=="LoadInBq")
{
?>
<form name="form2" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center">導入標籤完畢</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="34%"><div align="right">導入標籤名稱：</div></td>
            <td width="66%" height="27"><b><?php echo $r[0]."&nbsp;(".$r[3].")";?></b></td>
          </tr>
          <tr> 
            <td height="27" colspan="2"><div align="center">標籤函數內容：</div></td>
          </tr>
          <tr> 
            <td height="27" colspan="2"> <div align="right"></div>
              <div align="center"> 
                <textarea name="funvalue" cols="86" rows="16" id="funvalue"><?=ehtmlspecialchars($r[5])?></textarea>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center">說明：導入標籤後，請把函數內容複製到e/class/userfun.php文件</div></td>
    </tr>
  </table>
</form>
<?php
}
else
{
?>
<form action="LoadInBq.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('確認要導入？');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">導入標籤 
          <input name="enews" type="hidden" id="enews" value="LoadInBq">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="500" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="34%"><div align="right">標籤所屬分類：</div></td>
            <td width="66%" height="27"><select name="classid" id="classid">
                <option value="0">不隸屬於任何分類</option>
                <?=$cstr?>
              </select></td>
          </tr>
          <tr> 
            <td height="27"> <div align="right">導入標籤文件：</div></td>
            <td height="27"><input type="file" name="file">
              (*.bq) </td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="center">
          <input type="submit" name="Submit" value="馬上導入">
          &nbsp;&nbsp;
          <input type="reset" name="Submit2" value="重置">
        </div></td>
    </tr>
  </table>
</form>
<?php
}
?>

</body>
</html>
