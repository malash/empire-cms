<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>軟件名稱</td><td bgcolor=ffffff>
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
</td></tr><tr><td bgcolor=ffffff>發佈時間</td><td bgcolor=ffffff>
<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="設為當前時間" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr><tr><td bgcolor=ffffff>軟件預覽圖</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="選擇已上傳的圖片"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td bgcolor=ffffff>軟件作者</td><td bgcolor=ffffff><input name="softwriter" type="text" id="softwriter" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[softwriter]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>廠商主頁</td><td bgcolor=ffffff><input name="homepage" type="text" id="homepage" value="<?=$ecmsfirstpost==1?"http://":ehtmlspecialchars(stripSlashes($r[homepage]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>系統演示</td><td bgcolor=ffffff><input name="demo" type="text" id="demo" value="<?=$ecmsfirstpost==1?"http://":ehtmlspecialchars(stripSlashes($r[demo]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>運行環境</td><td bgcolor=ffffff><input name="softfj" type="text" id="softfj" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[softfj]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>軟件語言</td><td bgcolor=ffffff><select name="language" id="language"><option value="簡體中文"<?=$r[language]=="簡體中文"?' selected':''?>>簡體中文</option><option value="繁體中文"<?=$r[language]=="繁體中文"?' selected':''?>>繁體中文</option><option value="英文"<?=$r[language]=="英文"?' selected':''?>>英文</option><option value="多國語言"<?=$r[language]=="多國語言"?' selected':''?>>多國語言</option></select></td></tr><tr><td bgcolor=ffffff>軟件類型</td><td bgcolor=ffffff><select name="softtype" id="softtype"><option value="國產軟件"<?=$r[softtype]=="國產軟件"?' selected':''?>>國產軟件</option><option value="漢化軟件"<?=$r[softtype]=="漢化軟件"?' selected':''?>>漢化軟件</option><option value="國外軟件"<?=$r[softtype]=="國外軟件"?' selected':''?>>國外軟件</option></select></td></tr><tr><td bgcolor=ffffff>授權形式</td><td bgcolor=ffffff><select name="softsq" id="softsq"><option value="共享軟件"<?=$r[softsq]=="共享軟件"?' selected':''?>>共享軟件</option><option value="免費軟件"<?=$r[softsq]=="免費軟件"?' selected':''?>>免費軟件</option><option value="自由軟件"<?=$r[softsq]=="自由軟件"?' selected':''?>>自由軟件</option><option value="試用軟件"<?=$r[softsq]=="試用軟件"?' selected':''?>>試用軟件</option><option value="演示軟件"<?=$r[softsq]=="演示軟件"?' selected':''?>>演示軟件</option><option value="商業軟件"<?=$r[softsq]=="商業軟件"?' selected':''?>>商業軟件</option></select></td></tr><tr><td bgcolor=ffffff>軟件評價</td><td bgcolor=ffffff><select name="star" id="star"><option value="1"<?=$r[star]=="1"?' selected':''?>>1星</option><option value="2"<?=$r[star]=="2"||$ecmsfirstpost==1?' selected':''?>>2星</option><option value="3"<?=$r[star]=="3"?' selected':''?>>3星</option><option value="4"<?=$r[star]=="4"?' selected':''?>>4星</option><option value="5"<?=$r[star]=="5"?' selected':''?>>5星</option></select></td></tr><tr><td bgcolor=ffffff>文件類型</td><td bgcolor=ffffff><input name="filetype" type="text" id="filetype" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filetype]))?>" size="">
<select name="select2" onchange="document.add.filetype.value=this.value">
        <option value="">類型</option>
        <option value=".zip">.zip</option>
        <option value=".rar">.rar</option>
        <option value=".exe">.exe</option>
      </select></td></tr><tr><td bgcolor=ffffff>文件大小</td><td bgcolor=ffffff><input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filesize]))?>" size="">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">單位</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td></tr><tr><td bgcolor=ffffff>下載地址</td><td bgcolor=ffffff><script>
function doadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.editnum.value);
for(i=1;i<=document.add.downnum.value;i++)
{
j=i+oldi;
str=str+"<tr><td width=7%> <div align=center>"+j+"</div></td><td width=19%><div align=left><input name=downname[] type=text id=downname[] value=下載地址"+j+" size=17></div></td><td width=40%><input name=downpath[] type=text size=36 id=downpath"+j+" ondblclick=SpOpenChFile(0,'downpath"+j+"')><select name=thedownqz[]><option value=''>--地址前綴--</option><?=$newdownqz?></select></td><td width=21%><div align=center><select name=downuser[] id=select><option value=0>遊客</option><?=$ygroup?></select></div></td><td width=13%><div align=center><input name=fen[] type=text id=fen[] value=0 size=6></div></td></tr>";
}
document.getElementById("adddown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25">下載地址前綴&nbsp;:
      <input name="downurl_qz" type="text" size="32">
      <select name="changeurl_qz" onchange="document.add.downurl_qz.value=document.add.changeurl_qz.value">
        <option value="" selected>選擇前綴</option>
        <?=$downurlqz?>
      </select>
	  </td>
  </tr>
  <tr>
    <td height="25">選擇/上傳附件:
      <input name="changedown_url" id="changedown_url" type="text" size="32">
      <input type="button" name="Submit" value="選擇" onclick="window.open('ecmseditor/FileMain.php?type=0&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=changedown_url<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');">&nbsp;
	  <input type="button" name="Submit" value="複製" onclick="document.getElementById('changedown_url').focus();document.getElementById('changedown_url').select();clipboardData.setData('text',document.getElementById('changedown_url').value);"></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
        <tr> 
          <td width="7%"> <div align="center">編號</div></td>
          <td width="19%"><div align="left">下載名稱</div></td>
          <td width="40%">下載地址 <font color="#666666">(雙擊選擇)</font></td>
          <td width="21%"> <div align="center">權限</div></td>
          <td width="13%"> <div align="center">點數</div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>
    <?php
    if($ecmsfirstpost==1)
    {
    ?>
	<table width='100%' border=0 cellspacing=1 cellpadding=3>
	<?php
	$editnum=3;
	for($pathi=1;$pathi<=$editnum;$pathi++)
	{
	?>
           <tr> 
              <td width='7%'> <div align=center><?=$pathi?></div></td>
              <td width='19%'> <div align=left> 
                  <input name=downname[] type=text value='下載地址<?=$pathi?>' size=17>
                    </div></td>
              <td width='40%'>
	      <input name=downpath[] type=text size=36 id='downpath<?=$pathi?>' ondblclick="SpOpenChFile(0,'downpath<?=$pathi?>');">
	      <select name=thedownqz[]><option value=''>--地址前綴--</option><?=$newdownqz?></select> 
                  </td>
                  <td width='21%'><div align=center> 
                      <select name=downuser[]>
                        <option value=0>遊客</option>
                        <?=$ygroup?>
                      </select>
                    </div></td>
                  <td width='13%'> <div align=center> 
                      <input name=fen[] type=text value=0 size=6>
                    </div></td>
            </tr>
	<?php
	}
	?>
	</table>
    <?php
    }
    else
    {
	$editnum=0;
	$downloadpath="";
	if($r[downpath])
	{
		$r[downpath]=stripSlashes($r[downpath]);
		//下載地址
		$j=0;
		$d_record=explode("\r\n",$r[downpath]);
		for($i=0;$i<count($d_record);$i++)
		{
			$j=$i+1;
			$d_field=explode("::::::",$d_record[$i]);
			//權限
			$tgroup=str_replace(" value=".$d_field[2].">"," value=".$d_field[2]." selected>",$ygroup);
			//地址前綴
			$tnewdownqz=str_replace(" value='".$d_field[4]."'>"," value='".$d_field[4]."' selected>",$newdownqz);
			$downloadpath.="<tr><td width='7%'><div align=center>".$j."</div></td><td width='19%'><div align=left><input name=downname[] type=text id=downname[] value='".$d_field[0]."' size=17></div></td><td width='40%'><input name=downpath[] type=text id=downpath".$j." value='".$d_field[1]."' size=36 ondblclick=\"SpOpenChFile(0,'downpath".$j."');\"><select name=thedownqz[]><option value=''>--地址前綴--</option>".$tnewdownqz."</select><input type=hidden name=pathid[] value=".$j."><input type=checkbox name=delpathid[] value=".$j.">刪</td><td width='21%'><div align=center><select name=downuser[] id=select><option value=0>遊客</option>".$tgroup."</select></div></td><td width='13%'><div align=center><input name=fen[] type=text id=fen[] value='".$d_field[3]."' size=6></div></td></tr>";
		}
		$editnum=$j;
		$downloadpath="<table width='100%' border=0 cellspacing=1 cellpadding=3>".$downloadpath."</table>";
	}
	echo $downloadpath;
    }
    ?>
    </td>
  </tr>
  <tr> 
    <td height="25">下載地址擴展數量: <input name="editnum" type="hidden" id="editnum" value="<?=$editnum?>">
      <input name="downnum" type="text" id="downnum" value="1" size="6"> <input type="button" name="Submit5" value="輸出地址" onclick="javascript:doadd();"></td>
  </tr>
  <tr> 
    <td id=adddown></td>
  </tr>
</table>
</td></tr><tr><td bgcolor=ffffff>軟件簡介</td><td bgcolor=ffffff><textarea name="softsay" cols="80" rows="10" id="softsay"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[softsay]))?></textarea>
</td></tr>