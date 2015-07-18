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

//修改密碼
function EditPassword($userid,$username,$oldpassword,$password,$repassword,$styleid,$oldstyleid,$add){
	global $empire,$dbtbpre,$gr;
	$styleid=(int)$styleid;
	$oldstyleid=(int)$oldstyleid;
	$username=RepPostVar($username);
	$oldpassword=RepPostVar($oldpassword);
	$password=RepPostVar($password);
	$truename=RepPostStr($add[truename]);
	$email=RepPostStr($add[email]);
	if(!$userid||!$username)
	{
		printerror("EmptyOldPassword","history.go(-1)");
	}
	//修改密碼
	$a='';
	if($oldpassword)
	{
		if(!$username||!$oldpassword)
		{
			printerror("EmptyOldPassword","history.go(-1)");
		}
		if(!trim($password)||!trim($repassword))
		{
			printerror("EmptyNewPassword","history.go(-1)");
		}
		if($password<>$repassword)
		{
			printerror("NotRepassword","history.go(-1)");
		}
		if(strlen($password)<6)
		{
			printerror("LessPassword","history.go(-1)");
		}
		$user_r=$empire->fetch1("select userid,password,salt,salt2 from {$dbtbpre}enewsuser where username='".$username."' limit 1");
		if(!$user_r['userid'])
		{
			printerror("OldPasswordFail","history.go(-1)");
		}
		$ch_oldpassword=DoEmpireCMSAdminPassword($oldpassword,$user_r['salt'],$user_r['salt2']);
		if($user_r['password']!=$ch_oldpassword)
		{
			printerror("OldPasswordFail","history.go(-1)");
		}
		$salt=make_password(8);
		$salt2=make_password(20);
		$password=DoEmpireCMSAdminPassword($password,$salt,$salt2);
		$a=",password='$password',salt='$salt',salt2='$salt2'";
	}
	//風格
	if($gr['dochadminstyle'])
	{
		$a.=",styleid='$styleid'";
	}
	$sql=$empire->query("update {$dbtbpre}enewsuser set truename='$truename',email='$email'".$a." where username='$username'");
	//安全提問
	$equestion=(int)$_POST['equestion'];
	$eanswer=$_POST['eanswer'];
	$uadd='';
	if($equestion)
	{
		if($equestion!=$_POST['oldequestion']&&!$eanswer)
		{
			printerror('EmptyEAnswer','');
		}
		if($eanswer)
		{
			$eanswer=ReturnHLoginQuestionStr($userid,$username,$equestion,$eanswer);
			$uadd=",eanswer='$eanswer'";
		}
	}
	else
	{
		$uadd=",eanswer=''";
	}
	$empire->query("update {$dbtbpre}enewsuseradd set equestion='$equestion'".$uadd." where userid='$userid'");
	if($sql)
	{
		//操作日誌
		insert_dolog("");
		//改變風格
		if($styleid!=$oldstyleid)
		{
			$styler=$empire->fetch1("select path from {$dbtbpre}enewsadminstyle where styleid='$styleid'");
			if($styler['path'])
			{
				$set=esetcookie("loginadminstyleid",$styler['path'],0,1);
			}
			printerror("EditPasswordSuccessLogin","../index.php");
			//echo"Edit password success!<script>parent.location.href='../admin.php".hReturnEcmsHashStrHref2(1)."';</script>";
			exit();
		}
		else
		{
			printerror("EditPasswordSuccess","EditPassword.php".hReturnEcmsHashStrHref2(1));
		}
	}
	else
	{printerror("DbError","history.go(-1)");}
}

$gr=$empire->fetch1("select dochadminstyle from {$dbtbpre}enewsgroup where groupid='$loginlevel'");

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//修改密碼
if($enews=="EditPassword")
{
	$oldpassword=$_POST['oldpassword'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	$styleid=(int)$_POST['styleid'];
	$oldstyleid=(int)$_POST['oldstyleid'];
	EditPassword($logininid,$loginin,$oldpassword,$password,$repassword,$styleid,$oldstyleid,$_POST);
}

$r=$empire->fetch1("select userid,styleid,truename,email from {$dbtbpre}enewsuser where userid='$logininid'");
$addur=$empire->fetch1("select equestion from {$dbtbpre}enewsuseradd where userid='$r[userid]'");
if($gr['dochadminstyle'])
{
	//後台樣式
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
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>修改資料</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href="EditPassword.php<?=$ecms_hashur['whehref']?>">修改個人資料</a></td>
  </tr>
</table>
<form name="form1" method="post" action="EditPassword.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">修改資料 
        <input name="enews" type="hidden" id="enews" value="EditPassword"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">用戶名：</td>
      <td width="81%" height="25"> 
        <?=$loginin?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">舊密碼：</td>
      <td height="25"><input name="oldpassword" type="password" id="oldpassword" size="32"> 
        <font color="#666666">(不修改密碼,請留空) </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">新密碼：</td>
      <td height="25"><input name="password" type="password" id="password" size="32"> 
        <font color="#666666">(不修改密碼,請留空) </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">重複新密碼：</td>
      <td height="25"><input name="repassword" type="password" id="repassword" size="32"> 
        <font color="#666666">(不修改密碼,請留空) </font></td>
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
    <?php
	if($gr['dochadminstyle'])
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">操作界面：</td>
      <td height="25"><select name="styleid" id="styleid">
          <?=$style?>
        </select> <input type="button" name="Submit6222322" value="管理後台樣式" onclick="window.open('../template/AdminStyle.php<?=$ecms_hashur['whehref']?>');"> 
        <input name="oldstyleid" type="hidden" id="oldstyleid" value="<?=$r[styleid]?>"> 
      </td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置">
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><font color="#666666">說明：密碼設置6位以上，且密碼不能包含：$ 
        &amp; * # &lt; &gt; ' &quot; / \ % ; 空格</font></td>
    </tr>
  </table>
</form>

</body>
</html>
