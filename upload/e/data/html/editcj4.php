<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>�@�~�W</td><td bgcolor=ffffff>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">
<tr> 
  <td height="25" bgcolor="#FFFFFF">
	<?=$tts?"<select name='ttid'><option value='0'>���D����</option>$tts</select>":""?>
	<input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> 
	<input type="button" name="button" value="�Ϥ�" onclick="document.add.title.value=document.add.title.value+'(�Ϥ�)';"> 
  </td>
</tr>
<tr> 
  <td height="25" bgcolor="#FFFFFF">�ݩ�: 
	<input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>����
	<input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>����
	<input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>�R���u
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"><a onclick="foreColor();"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>
  </td>
</tr>
</table>
</td></tr><tr><td bgcolor=ffffff>�o�G�ɶ�</td><td bgcolor=ffffff>
<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr><tr><td bgcolor=ffffff>�@�~�w����</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td bgcolor=ffffff>�@��</td><td bgcolor=ffffff><input name="flashwriter" type="text" id="flashwriter" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[flashwriter]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>�@�̶l�c</td><td bgcolor=ffffff><input name="email" type="text" id="email" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[email]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>�@�~����</td><td bgcolor=ffffff><select name="star" id="star"><option value="1"<?=$r[star]=="1"?' selected':''?>>1�P</option><option value="2"<?=$r[star]=="2"||$ecmsfirstpost==1?' selected':''?>>2�P</option><option value="3"<?=$r[star]=="3"?' selected':''?>>3�P</option><option value="4"<?=$r[star]=="4"?' selected':''?>>4�P</option><option value="5"<?=$r[star]=="5"?' selected':''?>>5�P</option></select></td></tr><tr><td bgcolor=ffffff>���j�p</td><td bgcolor=ffffff><input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filesize]))?>" size="60">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">���</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td></tr><tr><td bgcolor=ffffff>Flash�a�}</td><td bgcolor=ffffff><input name="flashurl" type="text" id="flashurl" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[flashurl]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=2&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=flashurl<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ�FLASH"><img src="../data/images/changeflash.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td bgcolor=ffffff>Flash�e��</td><td bgcolor=ffffff><input name="width" type="text" id="width" value="<?=$ecmsfirstpost==1?"600":ehtmlspecialchars(stripSlashes($r[width]))?>" size="6">
</td></tr><tr><td bgcolor=ffffff>Flash����</td><td bgcolor=ffffff><input name="height" type="text" id="height" value="<?=$ecmsfirstpost==1?"450":ehtmlspecialchars(stripSlashes($r[height]))?>" size="6">
</td></tr><tr><td bgcolor=ffffff>�@�~²��</td><td bgcolor=ffffff><textarea name="flashsay" cols="80" rows="10" id="flashsay"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[flashsay]))?></textarea>
</td></tr>