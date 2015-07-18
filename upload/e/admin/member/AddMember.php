<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
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
CheckLevel($logininid,$loginin,$classid,"member");
$userdate=0;
$enews=ehtmlspecialchars($_GET['enews']);
$changegroupid=(int)$_GET['changegroupid'];
$url="<a href=ListMember.php".$ecms_hashur['whehref'].">管理會員</a>&nbsp;>&nbsp;增加會員";
if($enews=="EditMember")
{
	$userid=(int)$_GET['userid'];
	//取得用戶資料
	$r=ReturnUserInfo($userid);
	$r['groupid']=$r['groupid']?$r['groupid']:eReturnMemberDefGroupid();
	$addr=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='$userid' limit 1");
	$url="<a href=ListMember.php".$ecms_hashur['whehref'].">管理會員</a>&nbsp;>&nbsp;修改會員資料：<b>".$r[username]."</b>";
	//時間
	if($r[userdate])
	{
		$userdate=$r[userdate]-time();
		if($userdate<=0)
		{
			OutTimeZGroup($userid,$r['zgroupid']);
			if($r['zgroupid'])
			{
				$r['groupid']=$r['zgroupid'];
				$r['zgroupid']=0;
			}
			$userdate=0;
		}
		else
		{
			$userdate=round($userdate/(24*3600));
		}
	}
}
if($changegroupid)
{
	$r['groupid']=$changegroupid;
}
//----------會員組
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($sql))
{
	if($r[groupid]==$level_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$level_r[groupid].$select.">".$level_r[groupname]."</option>";
	if($r[zgroupid]==$level_r[groupid])
	{$zselect=" selected";}
	else
	{$zselect="";}
	$zgroup.="<option value=".$level_r[groupid].$zselect.">".$level_r[groupname]."</option>";
}
//風格
$spacestyle='';
$spacesql=$empire->query("select styleid,stylename from {$dbtbpre}enewsspacestyle");
while($spacer=$empire->fetch($spacesql))
{
	$selected='';
	if($spacer[styleid]==$addr[spacestyleid])
	{
		$selected=' selected';
	}
	$spacestyle.="<option value='$spacer[styleid]'".$selected.">".$spacer[stylename]."</option>";
}
//取得表單
$formid=GetMemberFormId($r[groupid]);
$formfile='../../data/html/memberform'.$formid.'.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>修改資料</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListMember.php" enctype="multipart/form-data">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <input type=hidden name=add[oldusername] value='<?=$r[username]?>'>
    <input type=hidden name=add[userid] value='<?=$userid?>'>
    <tr class="header"> 
      <td height="25" colspan="2">修改資料 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="25%" height="25">用戶名</td>
      <td width="75%" height="25"><input name=add[username] type=text id="add[username]" value='<?=$r[username]?>'></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">密碼</td>
      <td height="25"><input name="add[password]" type="password" id="add[password]">
        (修改時：如不想修改,請留空)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">審核</td>
      <td height="25"><input name="add[checked]" type="checkbox" id="add[checked]" value="1"<?=$r[checked]==1?' checked':''?>>
        審核通過</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">所屬會員組<br> <br> <input type="button" name="Submit3" value="管理會員組" onclick="window.open('ListMemberGroup.php<?=$ecms_hashur['whehref']?>');">      </td>
      <td height="25"><select name="add[groupid]" size="6" id="add[groupid]" onchange="self.location.href='AddMember.php?<?=$ecms_hashur['ehref']?>&enews=EditMember&userid=<?=$userid?>&changegroupid='+this.options[this.selectedIndex].value;">
          <?=$group?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">郵箱</td>
      <td height="25"><input name="add[email]" type="text" id="add[email]" value="<?=$r[email]?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">剩餘天數</td>
      <td height="25"><input name=add[userdate] type=text id="add[userdate]" value='<?=$userdate?>' size="6">
        天，到期後轉向用戶組: 
        <select name="add[zgroupid]" id="add[zgroupid]">
          <option value="0">不設置</option>
          <?=$zgroup?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">點數</td>
      <td height="25"><input name=add[userfen] type=text id="add[userfen]" value='<?=$r[userfen]?>' size="6">
        點</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">帳戶餘額</td>
      <td height="25"><input name=add[money] type=text id="add[money]" value='<?=$r[money]?>' size="6">
        元 </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">空間使用模板</td>
      <td height="25"><select name="add[spacestyleid]" id="add[spacestyleid]">
          <?=$spacestyle?>
        </select> <input type="button" name="Submit32" value="管理空間模板" onclick="window.open('ListSpaceStyle.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">註冊時間</td>
      <td height="25"><?=eReturnMemberRegtime($r['registertime'],"Y-m-d H:i:s")?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">註冊IP</td>
      <td height="25"><?=$addr[regip]?>:<?=$addr[regipport]?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">最後登錄</td>
      <td height="25">總登錄次數：<?=$addr[loginnum]?>，時間：<?=date("Y-m-d H:i:s",$addr[lasttime])?>，登錄IP：<?=$addr[lastip]?>:<?=$addr[lastipport]?></td>
    </tr>
    <tr bgcolor="#FFFFFF" class="header"> 
      <td height="25" colspan="2">其他信息</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"> 
        <?php
	  @include($formfile);
	  ?>      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="修改"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>