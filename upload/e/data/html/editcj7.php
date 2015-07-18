<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>標題</td><td bgcolor=ffffff>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">
<tr> 
  <td height="25" bgcolor="#FFFFFF">
	<?=$tts?"<select name='ttid'><option value='0'>標題分類</option>$tts</select>":""?>
	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> 
	<input type="button" name="button" value="圖文" onclick="document.add.title.value=document.add.title.value+'(圖文)';"> 
  </td>
</tr>
<tr> 
  <td height="25" bgcolor="#FFFFFF">屬性: 
	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>粗體
	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>斜體
	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>刪除線
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;顏色: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>
  </td>
</tr>
</table>
</td></tr><tr><td bgcolor=ffffff>副標題</td><td bgcolor=ffffff><input name="ftitle" type="text" id="ftitle" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[ftitle]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>發佈時間</td><td bgcolor=ffffff>
<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="設為當前時間" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr><tr><td bgcolor=ffffff>標題圖片</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="選擇已上傳的圖片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td bgcolor=ffffff>內容簡介</td><td bgcolor=ffffff><textarea name="smalltext" cols="80" rows="10" id="smalltext"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>
</td></tr><tr><td bgcolor=ffffff>作者</td><td bgcolor=ffffff><?php
$writer_sql=$empire->query("select writer from {$dbtbpre}enewswriter");
while($w_r=$empire->fetch($writer_sql))
{
	$w_class.="<option value='".$w_r[writer]."'>".$w_r[writer]."</option>";
}
?>
<input type=text name=writer value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[writer]))?>" size=""> 
        <select name="w_id" id="select7" onchange="document.add.writer.value=document.add.w_id.value">
          <option>選擇作者</option>
		  <?=$w_class?>
        </select>
<input type="button" name="wbutton" value="增加作者" onclick="window.open('NewsSys/writer.php?<?=$ecms_hashur[ehref]?>&addwritername='+document.add.writer.value);">
</td></tr><tr><td bgcolor=ffffff>信息來源</td><td bgcolor=ffffff><?php
$befrom_sql=$empire->query("select sitename from {$dbtbpre}enewsbefrom");
while($b_r=$empire->fetch($befrom_sql))
{
	$b_class.="<option value='".$b_r[sitename]."'>".$b_r[sitename]."</option>";
}
?>
<input type="text" name="befrom" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[befrom]))?>" size=""> 
        <select name="befrom_id" id="befromid" onchange="document.add.befrom.value=document.add.befrom_id.value">
          <option>選擇信息來源</option>
          <?=$b_class?>
        </select>
<input type="button" name="wbutton" value="增加來源" onclick="window.open('NewsSys/BeFrom.php?<?=$ecms_hashur[ehref]?>&addsitename='+document.add.befrom.value);">
</td></tr><tr><td bgcolor=ffffff>新聞正文</td><td bgcolor=ffffff><?=ECMS_ShowEditorVar("newstext",$ecmsfirstpost==1?"":stripSlashes($r[newstext]),"Default","","300","100%")?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td bgcolor="#FFFFFF"> <input name="dokey" type="checkbox" value="1"<?=$r[dokey]==1?' checked':''?>>
              關鍵字替換&nbsp;&nbsp; <input name="copyimg" type="checkbox" id="copyimg" value="1">
      遠程保存圖片(
      <input name="mark" type="checkbox" id="mark" value="1">
      <a href="SetEnews.php<?=$ecms_hashur[whehref]?>" target="_blank">加水印</a>)&nbsp;&nbsp; 
      <input name="copyflash" type="checkbox" id="copyflash" value="1">
      遠程保存FLASH(地址前綴： 
      <input name="qz_url" type="text" id="qz_url" size="">
              )</td>
          </tr>
          <tr>
            
    <td bgcolor="#FFFFFF"><input name="repimgnexturl" type="checkbox" id="repimgnexturl" value="1"> 圖片鏈接轉為下一頁&nbsp;&nbsp; <input name="autopage" type="checkbox" id="autopage" value="1"> 自動分頁
      ,每 
      <input name="autosize" type="text" id="autosize" value="5000" size="5">
      個字節為一頁&nbsp;&nbsp; 取第 
      <input name="getfirsttitlepic" type="text" id="getfirsttitlepic" value="" size="1">
      張上傳圖為標題圖片( 
      <input name="getfirsttitlespic" type="checkbox" id="getfirsttitlespic" value="1">
      縮略圖: 寬 
      <input name="getfirsttitlespicw" type="text" id="getfirsttitlespicw" size="3" value="<?=$public_r[spicwidth]?>">
      *高
      <input name="getfirsttitlespich" type="text" id="getfirsttitlespich" size="3" value="<?=$public_r[spicheight]?>">
      )</td>
          </tr>
        </table>
</td></tr>