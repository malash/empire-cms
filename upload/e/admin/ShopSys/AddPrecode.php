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
CheckLevel($logininid,$loginin,$classid,"precode");
$enews=ehtmlspecialchars($_GET['enews']);
$time=(int)$_GET['time'];
$endtime='';
$r[precode]=strtoupper(make_password(20));
$classid='';
$r[musttotal]=0;
$url="<a href=ListPrecode.php".$ecms_hashur['whehref'].">管理優惠碼</a> &gt; 增加優惠碼";
if($enews=="EditPrecode")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsshop_precode where id='$id' limit 1");
	$url="<a href=ListPrecode.php".$ecms_hashur['whehref'].">管理優惠碼</a> &gt; 修改優惠碼";
	$endtime=$r['endtime']?date('Y-m-d',$r['endtime']):'';
	$classid=substr($r['classid'],1,strlen($r['classid'])-2);
}
//會員組
$membergroup='';
$line=5;//一行顯示五個
$i=0;
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($mgsql))
{
	$i++;
	$br='';
	if($i%$line==0)
	{
		$br='<br>';
	}
	if(strstr($r['groupid'],','.$level_r['groupid'].','))
	{$checked=" checked";}
	else
	{$checked="";}
	$membergroup.="<input type='checkbox' name='groupid[]' value='$level_r[groupid]'".$checked.">".$level_r[groupname]."&nbsp;".$br;
}
$href="AddPrecode.php?enews=$enews&time=$time&id=$id".$ecms_hashur['ehref'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>增加優惠碼</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListPrecode.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">增加優惠碼 
          <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
		  <input name="time" type="hidden" id="time" value="<?=$time?>">
          <input name="id" type="hidden" id="id" value="<?=$id?>">
      </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="17%" height="25">優惠碼名稱(*)：</td>
      <td width="83%" height="25"><input name="prename" type="text" id="prename" value="<?=$r[prename]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">優惠碼(*)：</td>
      <td height="25"><input name="precode" type="text" id="precode" value="<?=$r[precode]?>" size="42">
        <input type="button" name="Submit3" value="隨機優惠碼" onclick="javascript:self.location.href='<?=$href?>'">
        <font color="#666666">(&lt;36位)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">優惠類型：</td>
      <td height="25"><select name="pretype" id="pretype">
        <option value="0"<?=$r['pretype']==0?' selected':''?>>減金額</option>
        <option value="1"<?=$r['pretype']==1?' selected':''?>>商品百分比</option>
      </select>
      <font color="#666666">（「減金額」即訂單金額-優惠金額，「商品百分比」即給商品打多少折）</font>      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">優惠金額(*)：</td>
      <td height="25"><input name="premoney" type="text" id="premoney" value="<?=$r[premoney]?>" size="42">
        <font color="#666666">(當減金額時填金額，單位：元，當商品百分比時填百分比，單位：%)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">過期時間：</td>
      <td height="25"><input name="endtime" type="text" id="endtime" value="<?=$endtime?>" size="42" onclick="setday(this)">
        <font color="#666666">(空為不限制)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">優惠碼重複使用：</td>
      <td height="25"><input type="radio" name="reuse" value="0"<?=$r['reuse']==0?' checked':''?>>
      一次性使用
      <input type="radio" name="reuse" value="1"<?=$r['reuse']==1?' checked':''?>>
      可以重複使用</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25">限制重複使用次數：
      <input name="usenum" type="text" id="usenum" value="<?=$r[usenum]?>"><?=$r[haveusenum]?'[已使用：'.$r[haveusenum].']':''?>
	  <font color="#666666">(0為不限)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">滿多少金額可使用：</td>
      <td height="25"><input name="musttotal" type="text" id="musttotal" value="<?=$r[musttotal]?>" size="42">
        元 <font color="#666666">(0為不限)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">可使用的會員組：<br>
        <font color="#666666">(不選為不限)</font></td>
      <td height="25"><?=$membergroup?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">可使用的欄目商品：</td>
      <td height="25"><input name="classid" type="text" id="classid" value="<?=$classid?>" size="42">
        <font color="#666666">(空為不限，要填寫終極欄目ID，多個ID可用半角逗號隔開「,」)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <input type="submit" name="Submit" value="提交">
          &nbsp; 
          <input type="reset" name="Submit2" value="重置">
          &nbsp;</div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>