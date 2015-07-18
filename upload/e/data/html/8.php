<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder"><tr><td width=16% height=25 bgcolor=ffffff>標題</td><td bgcolor=ffffff>
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
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>特殊屬性</td><td bgcolor=ffffff>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">
  <tr>
    <td height="25" bgcolor="#FFFFFF">信息屬性: 
      <input name="checked" type="checkbox" value="1"<?=$r[checked]?' checked':''?>>
      審核 &nbsp;&nbsp; 推薦 
      <select name="isgood" id="isgood">
        <option value="0">不推薦</option>
	<?=$ftnr['igname']?>
      </select>
      &nbsp;&nbsp; 頭條 
      <select name="firsttitle" id="firsttitle">
        <option value="0">非頭條</option>
	<?=$ftnr['ftname']?>
      </select></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF">關鍵字&nbsp;&nbsp;&nbsp;: 
      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">
      <font color="#666666">(多個請用&quot;,&quot;隔開)</font></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF">外部鏈接: 
      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">
      <font color="#666666">(填寫後信息連接地址將為此鏈接)</font></td>
  </tr>
</table>
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>發佈時間</td><td bgcolor=ffffff>
<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="設為當前時間" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>信息內容</td><td bgcolor=ffffff><textarea name="smalltext" cols="80" rows="10" id="smalltext"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>圖片</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="選擇已上傳的圖片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>所在地</td><td bgcolor=ffffff><select name="myarea" id="myarea"><option value="東城區"<?=$r[myarea]=="東城區"||$ecmsfirstpost==1?' selected':''?>>東城區</option><option value="西城區"<?=$r[myarea]=="西城區"?' selected':''?>>西城區</option><option value="崇文區"<?=$r[myarea]=="崇文區"?' selected':''?>>崇文區</option><option value="宣武區"<?=$r[myarea]=="宣武區"?' selected':''?>>宣武區</option><option value="朝陽區"<?=$r[myarea]=="朝陽區"?' selected':''?>>朝陽區</option><option value="海澱區"<?=$r[myarea]=="海澱區"?' selected':''?>>海澱區</option><option value="豐台區"<?=$r[myarea]=="豐台區"?' selected':''?>>豐台區</option><option value="石景山區"<?=$r[myarea]=="石景山區"?' selected':''?>>石景山區</option><option value="通州區"<?=$r[myarea]=="通州區"?' selected':''?>>通州區</option><option value="昌平區"<?=$r[myarea]=="昌平區"?' selected':''?>>昌平區</option><option value="大興區"<?=$r[myarea]=="大興區"?' selected':''?>>大興區</option><option value="其它"<?=$r[myarea]=="其它"?' selected':''?>>其它</option></select></td></tr><tr><td width=16% height=25 bgcolor=ffffff>聯繫郵箱</td><td bgcolor=ffffff><input name="email" type="text" id="email" value="<?=$ecmsfirstpost==1?$memberinfor[email]:ehtmlspecialchars(stripSlashes($r[email]))?>" size="60">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>聯繫方式</td><td bgcolor=ffffff><input name="mycontact" type="text" id="mycontact" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[mycontact]))?>" size="60">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>聯繫地址</td><td bgcolor=ffffff><input name="address" type="text" id="address" value="<?=$ecmsfirstpost==1?$memberinfor[address]:ehtmlspecialchars(stripSlashes($r[address]))?>" size="60">
</td></tr></table>