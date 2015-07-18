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
CheckLevel($logininid,$loginin,$classid,"user");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListUser.php".$ecms_hashur['whehref'].">管理用戶</a>&nbsp;>增加用戶";
if($enews=="EditUser")
{
	$userid=(int)$_GET['userid'];
	$r=$empire->fetch1("select username,adminclass,groupid,checked,styleid,filelevel,truename,email,classid from {$dbtbpre}enewsuser where userid='$userid'");
	$addur=$empire->fetch1("select equestion,openip from {$dbtbpre}enewsuseradd where userid='$userid'");
	$url="<a href=ListUser.php".$ecms_hashur['whehref'].">管理用戶</a>&nbsp;>修改用戶：<b>".$r[username]."</b>";
	if($r[checked])
	{$checked=" checked";}
}
//-----------用戶組
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsgroup order by groupid desc");
while($gr=$empire->fetch($sql))
{
	if($r[groupid]==$gr[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$gr[groupid].$select.">".$gr[groupname]."</option>";
}
//-----------後台樣式
$stylesql=$empire->query("select styleid,stylename,path from {$dbtbpre}enewsadminstyle order by styleid");
$style="";
while($styler=$empire->fetch($stylesql))
{
	if($r[styleid]==$styler[styleid])
	{$sselect=" selected";}
	else
	{$sselect="";}
	$style.="<option value=".$styler[styleid].$sselect.">".$styler[stylename]."</option>";
}
//-----------部門
$userclasssql=$empire->query("select classid,classname from {$dbtbpre}enewsuserclass order by classid");
$userclass='';
while($ucr=$empire->fetch($userclasssql))
{
	if($r[classid]==$ucr[classid])
	{$select=" selected";}
	else
	{$select="";}
	$userclass.="<option value='$ucr[classid]'".$select.">".$ucr[classname]."</option>";
}
//--------------------操作的欄目
$fcfile="../../data/fc/ListEnews.php";
$fcjsfile="../../data/fc/cmsclass.js";
if(file_exists($fcjsfile)&&file_exists($fcfile))
{
	$class=GetFcfiletext($fcjsfile);
	$acr=explode("|",$r[adminclass]);
	$count=count($acr);
	for($i=1;$i<$count-1;$i++)
	{
		$class=str_replace("<option value='$acr[$i]'","<option value='$acr[$i]' selected",$class);
	}
}
else
{
	$class=ShowClass_AddClass($r[adminclass],"n",0,"|-",0,3);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>增加用戶　</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function selectalls(doselect,formvar)
{  
	 var bool=doselect==1?true:false;
	 var selectform=document.getElementById(formvar);
	 for(var i=0;i<selectform.length;i++)
	 { 
		  selectform.all[i].selected=bool;
	 } 
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListUser.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">增加用戶 
        <input name="userid" type="hidden" id="userid" value="<?=$userid?>"> <input name="oldusername" type="hidden" id="oldusername" value="<?=$r[username]?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="oldadminclass" type="hidden" id="oldadminclass" value="<?=$r[adminclass]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="22%" height="25">用戶名：</td>
      <td width="78%" height="25"><input name="username" type="text" id="username" value="<?=$r[username]?>" size="32">
        *</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">是否禁止：</td>
      <td height="25"><input name="checked" type="checkbox" id="checked" value="1"<?=$checked?>>
        是</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">密碼：</td>
      <td height="25"><input name="password" type="password" id="password" size="32">
        * <font color="#666666">(不想修改請留空)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">重複密碼：</td>
      <td height="25"><input name="repassword" type="password" id="repassword" size="32">
        * <font color="#666666">(不想修改請留空)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">安全提問：</td>
      <td height="25"> <select name="equestion" id="equestion">
          <option value="0"<?=$addur[equestion]==0?' selected':''?>>無安全提問</option>
          <option value="1"<?=$addur[equestion]==1?' selected':''?>>母親的名字</option>
          <option value="2"<?=$addur[equestion]==2?' selected':''?>>爺爺的名字</option>
          <option value="3"<?=$addur[equestion]==3?' selected':''?>>父親出生的城市</option>
          <option value="4"<?=$addur[equestion]==4?' selected':''?>>您其中一位老師的名字</option>
          <option value="5"<?=$addur[equestion]==5?' selected':''?>>您個人計算機的型號</option>
          <option value="6"<?=$addur[equestion]==6?' selected':''?>>您最喜歡的餐館名稱</option>
          <option value="7"<?=$addur[equestion]==7?' selected':''?>>駕駛執照的最後四位數字</option>
        </select> <font color="#666666"> 
        <input name="oldequestion" type="hidden" id="oldequestion" value="<?=$addur[equestion]?>">
        (如果啟用安全提問，登錄時需填入相應的項目才能登錄)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">安全回答：</td>
      <td height="25"><input name="eanswer" type="text" id="eanswer" size="32"> 
        <font color="#666666">(如果修改答案，請在此輸入新答案)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">姓名：</td>
      <td height="25"><input name="truename" type="text" id="truename" value="<?=$r[truename]?>" size="32"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">郵箱：</td>
      <td height="25"><input name="email" type="text" id="email" value="<?=$r[email]?>" size="32"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">用戶組(*)：</td>
      <td height="25"><select name="groupid" id="groupid">
          <?=$group?>
        </select> <input type="button" name="Submit62223222" value="管理用戶組" onclick="window.open('ListGroup.php<?=$ecms_hashur['whehref']?>');">
        *</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">所屬部門：</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">未分配</option>
          <?=$userclass?>
        </select> <input type="button" name="Submit622232222" value="管理部門" onclick="window.open('UserClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">後台樣式(*)：</td>
      <td height="25"><select name="styleid" id="styleid">
          <?=$style?>
        </select> <input type="button" name="Submit6222322" value="管理後台樣式" onclick="window.open('../template/AdminStyle.php<?=$ecms_hashur['whehref']?>');">
        *</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top"> <p><strong>管理的欄目信息：</strong><br>
          <br>
          <input name="filelevel" type="checkbox" id="filelevel" value="1"<?=$r[filelevel]==1?' checked':''?>>
          應用於附件權限<br>
          <br>
          (多個，請用ctrl。)</p></td>
      <td height="25" valign="top"> <select name="adminclass[]" size="12" multiple id="adminclassselect" style="width:270;">
          <?=$class?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'adminclassselect')">全部取消</a>] 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"> 注意事項：<font color="#FF0000">選擇父欄目會應用於子欄目，並且如果選擇父欄目，請勿選擇其子欄目</font>)</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><strong>允許登錄後台的 IP 列表:</strong><br>
        只有當管理員處於本列表中的 IP 地址時才可以登錄後台，列表以外的地址訪問將視為 IP 被禁止.每個 IP 一行，既可輸入完整地址，也可只輸入 
        IP 開頭，例如 &quot;192.168.&quot;(不含引號) 可匹配 192.168.0.0～192.168.255.255 範圍內的所有地址，留空為不限</td>
      <td height="25"><textarea name="openip" cols="50" rows="8" id="openip"><?=$addur[openip]?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><font color="#666666">說明：密碼設置6位以上，且密碼不能包含：$ 
        &amp; * # &lt; &gt; ' &quot; / \ % ; 空格</font></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
