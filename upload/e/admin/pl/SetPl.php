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
CheckLevel($logininid,$loginin,$classid,"public");
$r=$empire->fetch1("select * from {$dbtbpre}enewspl_set limit 1");
//評論權限
$plgroup='';
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[plgroupid]==$mgr[groupid])
	{
		$plgroup_select=' selected';
	}
	else
	{
		$plgroup_select='';
	}
	$plgroup.="<option value=".$mgr[groupid].$plgroup_select.">".$mgr[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>評論參數設置</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><p>位置：評論參數設置</p>
      </td>
  </tr>
</table>
<form name="plset" method="post" action="../ecmspl.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">評論參數設置 
        <input name=enews type=hidden value=SetPl></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">評論地址</td>
      <td height="25" bgcolor="#FFFFFF"><input name="plurl" type="text" id="plurl" value="<?=$r[plurl]?>" size="38">
        <font color="#666666">(綁定域名時設置，結尾需加「/」，如：/e/pl/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">評論權限限制</td>
      <td height="25"><select name="plgroupid" id="plgroupid">
          <option value=0>遊客</option>
          <?=$plgroup?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">評論內容限制</td>
      <td width="81%" height="25"><input name="plsize" type="text" id="plsize" value="<?=$r[plsize]?>" size="38">
        個字節<font color="#666666"> (兩個字節為一個漢字)</font> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">評論時間間隔</td>
      <td height="25"><input name="pltime" type="text" id="pltime" value="<?=$r[pltime]?>" size="38">
        秒</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">評論驗證碼</td>
      <td height="25"><input type="radio" name="plkey_ok" value="1"<?=$r[plkey_ok]==1?' checked':''?>>
        開啟 
        <input type="radio" name="plkey_ok" value="0"<?=$r[plkey_ok]==0?' checked':''?>>
        關閉</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">評論每頁顯示</td>
      <td height="25"><input name="pl_num" type="text" id="pl_num" value="<?=$r[pl_num]?>" size="38">
        個評論</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">評論表情每行顯示</td>
      <td height="25"><input name="plfacenum" type="text" id="plfacenum" value="<?=$r[plfacenum]?>" size="38">
        個表情</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">評論屏蔽字符<br> <font color="#666666">(1)、多個用「|」隔開，如「字符1|字符2」。<br>
        (2)、同時包含多字時屏蔽可用雙「#」隔開，如「破##解|字符2」 。這樣只要內容同時包含「破」和「解」字都會被屏蔽。</font></td>
      <td height="25"><textarea name="plclosewords" cols="80" rows="8" id="plclosewords"><?=ehtmlspecialchars($r[plclosewords])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">評論蓋樓最高樓層</td>
      <td height="25"><input name="plmaxfloor" type="text" id="plmaxfloor" value="<?=$r[plmaxfloor]?>" size="38">
        樓 <font color="#666666">(0為不限)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" valign="top">評論引用內容格式：<br>
      <br>
      評論ID：[!--plid--]<br>
      發表者：[!--username--]<br>
      評論內容：[!--pltext--]<br>
      發表時間：[!--pltime--]</td>
      <td height="25"><textarea name="plquotetemp" cols="80" rows="8" id="plquotetemp"><?=ehtmlspecialchars(stripSlashes($r[plquotetemp]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
