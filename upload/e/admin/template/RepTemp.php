<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//喷靡ノめ
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//喷靡舦
CheckLevel($logininid,$loginin,$classid,"template");
$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="RepTemp")
{
	include("../../class/tempfun.php");
	DoRepTemp($_POST,$logininid,$loginin);
}
$gid=(int)$_GET['gid'];
$gname=CheckTempGroup($gid);
$urlgname=$gname."&nbsp;->&nbsp;";
$url=$urlgname."<a href=RepTemp.php?gid=$gid".$ecms_hashur['ehref'].">у秖蠢传家狾ず甧</a>";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>у秖蠢传家狾ず甧</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">竚<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="RepTemp.php" onsubmit="return confirm('絋粄璶蠢传');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center"><strong>у秖蠢传家狾ず甧</strong> 
          <input name="enews" type="hidden" id="enews" value="RepTemp">
          <input name="gid" type="hidden" id="gid" value="<?=$gid?>">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="21%" height="23"><div align="center"> </div>
              <div align="center"><strong>才</strong></div></td>
            <td width="79%" height="23"><textarea name="oldword" cols="78" rows="8" id="textarea3"></textarea></td>
          </tr>
          <tr> 
            <td height="23"><div align="center"><strong>穝才</strong></div></td>
            <td height="23"><textarea name="newword" cols="78" rows="8" id="textarea4"></textarea></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <table width="98%" border="0" cellspacing="1" cellpadding="3">
            <tr> 
              <td width="16%" height="25"> <div align="left"> 
                  <input name="classtemp" type="checkbox" id="classtemp" value="1">
                  家狾</div></td>
              <td width="16%"> <div align="left"> 
                  <input name="bqtemp" type="checkbox" id="bqtemp" value="1">
                  夹乓家狾</div></td>
              <td width="16%"> <div align="left"> 
                  <input name="listtemp" type="checkbox" id="listtemp" value="1">
                  家狾</div></td>
              <td width="16%"> <div align="left"> 
                  <input name="newstemp" type="checkbox" id="classtemp3" value="1">
                  ず甧家狾</div></td>
              <td width="16%"> <div align="left"> 
                  <input name="searchtemp" type="checkbox" id="newstemp" value="1">
                  穓家狾</div></td>
            </tr>
            <tr> 
              <td height="25"> <div align="left"> 
                  <input name="pltemp" type="checkbox" id="pltemp3" value="1">
                  蝶阶家狾 </div></td>
              <td> <div align="left"> 
                  <input name="indextemp" type="checkbox" id="indextemp2" value="1">
                  家狾</div></td>
              <td> <div align="left"> 
                  <input name="cptemp" type="checkbox" id="cptemp" value="1">
                  北狾家狾</div></td>
              <td> <div align="left"> 
                  <input name="sformtemp" type="checkbox" id="sformtemp" value="1">
                  蔼穓虫家狾</div></td>
              <td> <div align="left"> 
                  <input name="printtemp" type="checkbox" id="searchtemp" value="1">
                  ゴ家狾</div></td>
            </tr>
            <tr> 
              <td height="25"> <input name="userpage" type="checkbox" id="userpage" value="1">
                ﹚竡</td>
              <td> <input name="tempvar" type="checkbox" id="tempvar" value="1">
                家狾跑秖</td>
              <td><input name="gbooktemp" type="checkbox" id="gbooktemp" value="1">
                痙ē狾家狾</td>
              <td><input name="loginiframe" type="checkbox" id="loginiframe" value="1">
                祅嘲篈家狾</td>
              <td><input name="votetemp" type="checkbox" id="votetemp" value="1">
                щ布家狾</td>
            </tr>
            <tr> 
              <td height="25"><input name="pagetemp" type="checkbox" id="pagetemp" value="1">
                ﹚竡家狾</td>
              <td> <input name="pljstemp" type="checkbox" id="pljstemp" value="1">
                蝶阶JS家狾</td>
              <td> <input name="schalltemp" type="checkbox" id="schalltemp" value="1">
                穓家狾</td>
              <td><input name="loginjstemp" type="checkbox" id="loginjstemp" value="1">
                JS秸ノ祅嘲篈家狾 </td>
              <td><input name="downpagetemp" type="checkbox" id="downpagetemp" value="1">
                程沧更家狾</td>
            </tr>
            <tr>
              <td height="25"><input name="jstemp" type="checkbox" id="feedbackbtemp" value="1">
                JS家狾</td>
              <td><input name="otherlinktemp" type="checkbox" id="jstemp" value="1">
                闽獺家狾</td>
              <td><input name="feedbackbtemp" type="checkbox" id="feedbackbtemp3" value="1">
                は鮔虫家狾</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="30">
<div align="center">
          <input type="submit" name="Submit" value=" 蠢 传 ">&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="竚">
          &nbsp;&nbsp;<input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
          匡い场</div></td>
    </tr>
  </table>
</form>
</body>
</html>
