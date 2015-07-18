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
CheckLevel($logininid,$loginin,$classid,"tempgroup");
$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include("../../class/tempfun.php");
}
if($enews=="LoadInTempGroup")//導入
{
	include "../".LoadLang("pub/fun.php");
	$file=$_FILES['file']['tmp_name'];
    $file_name=$_FILES['file']['name'];
    $file_type=$_FILES['file']['type'];
    $file_size=$_FILES['file']['size'];
	LoadInTempGroup($_POST,$file,$file_name,$file_type,$file_size,$logininid,$loginin);
}
elseif($enews=="LoadTempGroup")//導出
{
	LoadTempGroup($_POST,$logininid,$loginin);
}
elseif($enews=="EditTempGroup")//修改
{
	EditTempGroup($_POST,$logininid,$loginin);
}
elseif($enews=="DefTempGroup")//默認
{
	DefTtempGroup($_POST,$logininid,$loginin);
}
elseif($enews=="DelTempGroup")//刪除
{
	DelTempGroup($_POST,$logininid,$loginin);
}
else
{}
$sql=$empire->query("select gid,gname,isdefault from {$dbtbpre}enewstempgroup order by gid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>模板組管理</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckDel(gid){
	var ok=confirm("確認要刪除?");
	if(ok)
	{
		self.location.href='TempGroup.php?<?=$ecms_hashur['href']?>&enews=DelTempGroup&gid='+gid;
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href="TempGroup.php<?=$ecms_hashur['whehref']?>">模板組管理</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center">
  <tr>
    <td width="48%" valign="top"> 
      <table width="93%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
	  <form name=tempgroup method=post action=TempGroup.php onsubmit="return confirm('確認要執行?');">
	  <?=$ecms_hashur['form']?>
      <input type=hidden name=enews value=EditTempGroup>
        <tr class="header"> 
          <td width="10%" height="25"> <div align="center"></div></td>
          <td width="90%" height="25">模板組名稱</td>
        </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  	$tempgroup_options.="<option value='".$r['gid']."'>".$r['gname']."</option>";
  	$bgcolor="#FFFFFF";
	$checked="";
	$movejs=' onmouseout="this.style.backgroundColor=\'#ffffff\'" onmouseover="this.style.backgroundColor=\'#C3EFFF\'"';
  	if($r['isdefault'])
	{
		$bgcolor="#DBEAF5";
		$checked=" checked";
		$movejs='';
	}
  ?>
          <input type=hidden name=gid[] value=<?=$r[gid]?>>
          <tr bgcolor="<?=$bgcolor?>"<?=$movejs?>> 
            <td height="25"> <div align="center"> 
                <input type="radio" name="changegid" value="<?=$r[gid]?>"<?=$checked?>>
              </div></td>
            <td height="25"> <input name="gname[]" type="text" id="gname[]" value="<?=$r[gname]?>" size="30">(ID：<?=$r[gid]?>) 
            </td>
          </tr>
  <?php
  }
  ?>
  		  <tr bgcolor="#FFFFFF"> 
            <td height="25">&nbsp;</td>
            <td height="25"><input type="submit" name="Submit3" value="修改" onclick="document.tempgroup.enews.value='EditTempGroup';">&nbsp; 
              <input type="submit" name="Submit4" value="設為默認" onclick="document.tempgroup.enews.value='DefTempGroup';">&nbsp;
              <input type="submit" name="Submit6" value="導出" onclick="document.tempgroup.enews.value='LoadTempGroup';">&nbsp;
              <input type="submit" name="Submit7" value="刪除" onclick="document.tempgroup.enews.value='DelTempGroup';">&nbsp; 
              <input type="reset" name="Submit5" value="重置">
            </td>
          </tr>
  		</form>
      </table>
    </td>
    <td width="52%" valign="top"> 
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form action=TempGroup.php method=post enctype="multipart/form-data" name=loadform onsubmit="return confirm('確認要執行?');">
		<?=$ecms_hashur['form']?>
          <input type=hidden name=enews value=LoadInTempGroup>
          <tr class="header"> 
            <td height="25" colspan="2">導入模板組</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="24%" height="32">上傳模板文件</td>
            <td width="76%"> <input type="file" name="file">
              <font color="#666666">(*.temp文件)</font></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">模板編碼</td>
            <td> <input name="ChangeChar" type="checkbox" id="ChangeChar" value="1" onclick="if(this.checked){changechardiv.style.display='';}else{changechardiv.style.display='none';}">
              模板需要轉編碼 &nbsp;&nbsp;<font color="#666666">(當前站點編碼：<b><?=$ecms_config['sets']['pagechar']?></b>)</font></td>
          </tr>
          <tr bgcolor="#FFFFFF" id="changechardiv" style="display:none">
            <td height="32">&nbsp;</td>
            <td> 要導入的模板編碼: 
              <select name="tempchar" id="tempchar">
                <option value="GB2312">簡體GB2312</option>
                <option value="UTF8">簡體UTF-8</option>
                <option value="BIG5">繁體BIG5</option>
                <option value="TCUTF8">繁體UTF-8</option>
              </select>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">覆蓋模板組</td>
            <td> <select name="gid" id="gid">
                <option value="0">新建新的模板組</option>
                <?=$tempgroup_options?>
              </select> </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">&nbsp;</td>
            <td height="25"> <input type="submit" name="Submit" value="導 入">
              &nbsp;&nbsp; </td>
          </tr>
        </form>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25"><font color="#666666">查看源模板編碼技巧：用記事本打開.temp文件，然後搜索「<strong>charset=</strong>」就能查看編碼</font></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>