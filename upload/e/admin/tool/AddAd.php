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
CheckLevel($logininid,$loginin,$classid,"ad");
$t=ehtmlspecialchars($_GET['t']);
$enews=ehtmlspecialchars($_GET['enews']);
$time=ehtmlspecialchars($_GET['time']);
$url="<a href=ListAd.php".$ecms_hashur['whehref'].">管理廣告</a>&nbsp;>&nbsp;增加廣告";
//初始化數據
$r[starttime]=date("Y-m-d");
$r[endtime]=date("Y-m-d",time()+30*24*3600);
$r[pic_width]=468;
$r[pic_height]=60;
$filepass=ReturnTranFilepass();
//修改廣告
if($enews=="EditAd")
{
	$adid=(int)$_GET['adid'];
	$filepass=$adid;
	$r=$empire->fetch1("select * from {$dbtbpre}enewsad where adid='$adid'");
	$url="<a href=ListAd.php".$ecms_hashur['whehref'].">管理廣告</a>&nbsp;>&nbsp;修改廣告：<b>".$r[title]."</b>";
	$a="adtype".$r[adtype];
	$$a=" selected";
	if($r[target]=="_blank")
	{$target1=" selected";}
	elseif($r[target]=="_self")
	{$target2=" selected";}
	else
	{$target3=" selected";}
	$t=$r[t];
}
//廣告模式
if(strlen($_GET[changet])!=0)
{
	$t=RepPostStr($_GET['changet'],1);
}
//廣告類別
$sql=$empire->query("select classid,classname from {$dbtbpre}enewsadclass");
while($cr=$empire->fetch($sql))
{
	if($r[classid]==$cr[classid])
	{$s=" selected";}
	else
	{$s="";}
	$options.="<option value=".$cr[classid].$s.">".$cr[classname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>廣告管理</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function foreColor()
{
  if (!Error())	return;
  var arr = showModalDialog("../ecmseditor/fieldfile/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.form1.titlecolor.value=arr;
  else document.form1.titlecolor.focus();
}
</script>
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="30%" height="25">位置： 
      <?=$url?>
    </td>
    <td><table width="500" border="0" align="right" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="25"> <div align="center">[<a href="AddAd.php?enews=AddAd&t=0<?=$ecms_hashur['ehref']?>"><strong>增加圖片/FLASH廣告</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?enews=AddAd&t=1<?=$ecms_hashur['ehref']?>"><strong>增加文字廣告</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?enews=AddAd&t=2<?=$ecms_hashur['ehref']?>"><strong>增加HTML廣告</strong></a>]</div></td>
          <td><div align="center">[<a href="AddAd.php?enews=AddAd&t=3<?=$ecms_hashur['ehref']?>"><strong>增加彈出廣告</strong></a>]</div></td>
        </tr>
      </table></td>
  </tr>
</table>

<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td><div align="center"> 
        <?php
	//文字廣告
	if($t==1)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
		<?=$ecms_hashur['form']?>
            <tr class="header"> 
              <td height="25" colspan="2">增加文字廣告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
                <input name="add[t]" type="hidden" id="add[t]" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>">
                <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>廣告模式：</strong></td>
              <td height="25"><select name="changet" id="changet" onchange=window.location='AddAd.php?<?=$ecms_hashur['ehref']?>&enews=<?=$enews?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">圖片/FLASH廣告</option>
                  <option value="1" selected>文字廣告</option>
                  <option value="2">HTML廣告</option>
                  <option value="3">彈出廣告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告分類：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit3" value="管理分類" onclick="window.open('AdClass.php<?=$ecms_hashur['whehref']?>');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">廣告名稱：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                <font color="#666666">(如：網站Banner廣告)</font></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告類型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>普通顯示</option>
                  <option value="3"<?=$adtype3?>>可移動透明對話框</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">文字：</td>
              <td height="25"> <input name="picurl" type="text" id="picurl" value="<?=$r[picurl]?>" size="42"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td width="51%">屬性： 
                      <input name="titlefont[b]" type="checkbox" id="titlefont[b]" value="b"<?=strstr($r[titlefont],'b|')?' checked':''?>>
                      粗體 
                      <input name="titlefont[i]" type="checkbox" id="titlefont[i]" value="i"<?=strstr($r[titlefont],'i|')?' checked':''?>>
                      斜體 
                      <input name="titlefont[s]" type="checkbox" id="titlefont[s]" value="s"<?=strstr($r[titlefont],'s|')?' checked':''?>>
                      刪除線</td>
                    <td width="49%">顏色： 
                      <input name="titlecolor" type="text" id="titlecolor" value="<?=$r[titlecolor]?>" size="10"> 
                      <a onclick="foreColor();"><img src="../../data/images/color.gif" width="21" height="21" align="absbottom"></a></td>
                  </tr>
                </table></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">鏈接地址：</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
                <input name="add[ylink]" type="checkbox" id="add[ylink]" value="1"<?=$r[ylink]==1?' checked':''?>>
                顯示原鏈接</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <select name="add[target]" id="select">
                  <option value="_blank"<?=$target1?>>在新窗口打開</option>
                  <option value="_self"<?=$target2?>>在原窗口打開</option>
                  <option value="_parent"<?=$target3?>>在父窗口打開</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">規格：</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (寬×高)<font color="#666666">[可移動透明對話框有效]</font></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">提示文字：</td>
              <td height="25"> <input name="add[alt]" type="text" id="add[alt]" value="<?=$r[alt]?>"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">過期時間：</td>
              <td height="25">從 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 <font color="#666666">(格式：2004-09-01，永不過期可填0000-00-00)</font></td>
            </tr>
            <tr bgcolor="#FFFFFF">
              <td height="25">過期後顯示：</td>
              <td height="25"><textarea name="add[reptext]" cols="65" rows="8" id="add[reptext]"><?=ehtmlspecialchars($r[reptext])?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置點擊數：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">簡單註釋：</td>
              <td height="25"> <textarea name="add[adsay]" cols="65" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?php
	}
	//html廣告
	elseif($t==2)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
		<?=$ecms_hashur['form']?>
            <tr class="header"> 
              <td height="25" colspan="2">增加HTML廣告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
                <input name="add[t]" type="hidden" id="add[t]" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>"> 
                <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>廣告模式：</strong></td>
              <td height="25"><select name="changet" id="select2" onchange=window.location='AddAd.php?<?=$ecms_hashur['ehref']?>&enews=<?=$enews?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">圖片/FLASH廣告</option>
                  <option value="1">文字廣告</option>
                  <option value="2" selected>HTML廣告</option>
                  <option value="3">彈出廣告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告分類：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit32" value="管理分類" onclick="window.open('AdClass.php<?=$ecms_hashur['whehref']?>');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">廣告名稱：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                <font color="#666666">(如：網站Banner廣告)</font></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告類型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>普通顯示</option>
                  <option value="3"<?=$adtype3?>>可移動透明對話框</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">規格：</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]2" type="text" id="add[pic_height]2" value="<?=$r[pic_height]?>" size="4">
                (寬×高)<font color="#666666">[可移動透明對話框有效]</font></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">HTML代碼：</td>
              <td height="25"> <textarea name="add[htmlcode]" cols="42" rows="12" id="add[htmlcode]" style="WIDTH: 100%"><?=ehtmlspecialchars($r[htmlcode])?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">過期時間：</td>
              <td height="25">從 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 <font color="#666666">(格式：2004-09-01，永不過期可填0000-00-00)</font></td>
            </tr>
			<tr bgcolor="#FFFFFF">
              <td height="25">過期後顯示：</td>
              <td height="25"><textarea name="add[reptext]" cols="65" rows="8" id="add[reptext]"><?=ehtmlspecialchars($r[reptext])?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置點擊數：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">簡單註釋：</td>
              <td height="25"> <textarea name="add[adsay]" cols="65" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?php
	}
	//彈出廣告
	elseif($t==3)
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
		<?=$ecms_hashur['form']?>
            <tr class="header"> 
              <td height="25" colspan="2">增加彈出廣告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
                <input name="add[t]" type="hidden" id="add[t]3" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>">
                <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>廣告模式：</strong></td>
              <td height="25"><select name="changet" id="select3" onchange=window.location='AddAd.php?<?=$ecms_hashur['ehref']?>&enews=<?=$enews?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0">圖片/FLASH廣告</option>
                  <option value="1">文字廣告</option>
                  <option value="2">HTML廣告</option>
                  <option value="3" selected>彈出廣告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告分類：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit33" value="管理分類" onclick="window.open('AdClass.php<?=$ecms_hashur['whehref']?>');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">廣告名稱：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                <font color="#666666">(如：網站Banner廣告)</font></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告類型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="8"<?=$adtype8?>>打開新窗口</option>
                  <option value="9"<?=$adtype9?>>彈出新窗口</option>
                  <option value="10"<?=$adtype10?>>普通網頁對話框</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">彈出地址：</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">規格：</td>
              <td height="25"><input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (寬×高)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">過期時間：</td>
              <td height="25">從 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 <font color="#666666">(格式：2004-09-01，永不過期可填0000-00-00)</font></td>
            </tr>
			<tr bgcolor="#FFFFFF">
              <td height="25">過期後顯示：</td>
              <td height="25"><textarea name="add[reptext]" cols="65" rows="8" id="add[reptext]"><?=ehtmlspecialchars($r[reptext])?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置點擊數：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">簡單註釋：</td>
              <td height="25"> <textarea name="add[adsay]" cols="65" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?php
	}
	//圖片/flash廣告
	else
	{
	?>
        <form name="form1" method="post" action="ListAd.php">
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
		<?=$ecms_hashur['form']?>
            <tr class="header"> 
              <td height="25" colspan="2">增加圖片/FLASH廣告 
                <input name="add[adid]" type="hidden" id="add[adid]" value="<?=$adid?>"> 
                <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
                <input name="add[t]" type="hidden" id="add[t]4" value="<?=$t?>"> 
                <input name="time" type="hidden" id="time" value="<?=$time?>">
                <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"><strong>廣告模式：</strong></td>
              <td height="25"><select name="changet" id="select4" onchange=window.location='AddAd.php?<?=$ecms_hashur['ehref']?>&enews=<?=$enews?>&adid=<?=$adid?>&time=<?=$time?>&changet='+this.options[this.selectedIndex].value>
                  <option value="0" selected>圖片/FLASH廣告</option>
                  <option value="1">文字廣告</option>
                  <option value="2">HTML廣告</option>
                  <option value="3">彈出廣告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告分類：</td>
              <td height="25"> <select name="add[classid]" id="add[classid]">
                  <?=$options?>
                </select> <input type="button" name="Submit34" value="管理分類" onclick="window.open('AdClass.php<?=$ecms_hashur['whehref']?>');"></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="27%" height="25">廣告名稱：</td>
              <td width="73%" height="25"> <input name="add[title]" type="text" id="add[title]" value="<?=$r[title]?>">
                <font color="#666666">(如：網站Banner廣告)</font></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">廣告類型：</td>
              <td height="25"> <select name="add[adtype]" id="add[adtype]">
                  <option value="1"<?=$adtype1?>>普通顯示</option>
                  <option value="4"<?=$adtype4?>>滿屏浮動顯示</option>
                  <option value="5"<?=$adtype5?>>上下浮動顯示 - 右</option>
                  <option value="6"<?=$adtype6?>>上下浮動顯示 - 左</option>
                  <option value="7"<?=$adtype7?>>全屏幕漸隱消失</option>
                  <option value="3"<?=$adtype3?>>可移動透明對話框</option>
                  <option value="11"<?=$adtype11?>>對聯式廣告</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">圖片/FLASH地址：</td>
              <td height="25"> <input name="picurl" type="text" id="picurl" value="<?=$r[picurl]?>" size="42"> 
                <a onclick="window.open('../ecmseditor/FileMain.php?<?=$ecms_hashur['ehref']?>&modtype=3&type=1&classid=&doing=2&field=picurl&filepass=<?=$filepass?>&sinfo=1','','width=700,height=550,scrollbars=yes');" title="選擇已上傳的圖片"><img src="../../data/images/changeimg.gif" alt="選擇/上傳圖片" width="22" height="22" border="0" align="absbottom"></a> 
                <a onclick="window.open('../ecmseditor/FileMain.php?<?=$ecms_hashur['ehref']?>&modtype=3&type=2&classid=&doing=2&field=picurl&filepass=<?=$filepass?>&sinfo=1','','width=700,height=550,scrollbars=yes');" title="選擇已上傳的圖片"><img src="../../data/images/changeflash.gif" alt="選擇/上傳FLASH" width="22" height="22" border="0" align="absbottom"></a> 
              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">規格：</td>
              <td height="25"> <input name="add[pic_width]" type="text" id="add[pic_width]" value="<?=$r[pic_width]?>" size="4">
                × 
                <input name="add[pic_height]" type="text" id="add[pic_height]" value="<?=$r[pic_height]?>" size="4">
                (寬×高)</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">鏈接地址：</td>
              <td height="25"> <input name="add[url]" type="text" id="add[url]" value="<?=$r[url]?>" size="42"> 
                <input name="add[ylink]" type="checkbox" id="add[ylink]" value="1"<?=$r[ylink]==1?' checked':''?>>
                顯示原鏈接</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <select name="add[target]" id="select">
                  <option value="_blank"<?=$target1?>>在新窗口打開</option>
                  <option value="_self"<?=$target2?>>在原窗口打開</option>
                  <option value="_parent"<?=$target3?>>在父窗口打開</option>
                </select></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">提示文字：</td>
              <td height="25"> <input name="add[alt]" type="text" id="add[alt]" value="<?=$r[alt]?>">
                <font color="#666666">(FLASH廣告無效)</font></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">過期時間：</td>
              <td height="25">從 
                <input name="add[starttime]" type="text" id="add[starttime]" value="<?=$r[starttime]?>" size="12" onclick="setday(this)">
                到 
                <input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="12" onclick="setday(this)">
                止 <font color="#666666">(格式：2004-09-01，永不過期可填0000-00-00)</font></td>
            </tr>
			<tr bgcolor="#FFFFFF">
              <td height="25">過期後顯示：</td>
              <td height="25"><textarea name="add[reptext]" cols="65" rows="8" id="add[reptext]"><?=ehtmlspecialchars($r[reptext])?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">重置點擊數：</td>
              <td height="25"><input name="add[reset]" type="checkbox" id="add[reset]" value="1">
                重置</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">簡單註釋：</td>
              <td height="25"> <textarea name="add[adsay]" cols="65" rows="5" id="add[adsay]"><?=$r[adsay]?></textarea></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"> <input type="submit" name="Submit" value="提交"> 
                <input type="reset" name="Submit2" value="重置"></td>
            </tr>
          </table>
        </form>
        <?php
	}
	?>
      </div></td>
  </tr>
</table>
</body>
</html>
