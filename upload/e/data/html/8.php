<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder"><tr><td width=16% height=25 bgcolor=ffffff>���D</td><td bgcolor=ffffff>
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
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�S���ݩ�</td><td bgcolor=ffffff>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">
  <tr>
    <td height="25" bgcolor="#FFFFFF">�H���ݩ�: 
      <input name="checked" type="checkbox" value="1"<?=$r[checked]?' checked':''?>>
      �f�� &nbsp;&nbsp; ���� 
      <select name="isgood" id="isgood">
        <option value="0">������</option>
	<?=$ftnr['igname']?>
      </select>
      &nbsp;&nbsp; �Y�� 
      <select name="firsttitle" id="firsttitle">
        <option value="0">�D�Y��</option>
	<?=$ftnr['ftname']?>
      </select></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF">����r&nbsp;&nbsp;&nbsp;: 
      <input name="keyboard" type="text" size="52" value="<?=stripSlashes($r[keyboard])?>">
      <font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF">�~���챵: 
      <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="52">
      <font color="#666666">(��g��H���s���a�}�N�����챵)</font></td>
  </tr>
</table>
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td><td bgcolor=ffffff>
<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�H�����e</td><td bgcolor=ffffff><textarea name="smalltext" cols="80" rows="10" id="smalltext"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea>
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ�</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ҧb�a</td><td bgcolor=ffffff><select name="myarea" id="myarea"><option value="�F����"<?=$r[myarea]=="�F����"||$ecmsfirstpost==1?' selected':''?>>�F����</option><option value="�諰��"<?=$r[myarea]=="�諰��"?' selected':''?>>�諰��</option><option value="�R���"<?=$r[myarea]=="�R���"?' selected':''?>>�R���</option><option value="�ŪZ��"<?=$r[myarea]=="�ŪZ��"?' selected':''?>>�ŪZ��</option><option value="�¶���"<?=$r[myarea]=="�¶���"?' selected':''?>>�¶���</option><option value="������"<?=$r[myarea]=="������"?' selected':''?>>������</option><option value="�ץx��"<?=$r[myarea]=="�ץx��"?' selected':''?>>�ץx��</option><option value="�۴��s��"<?=$r[myarea]=="�۴��s��"?' selected':''?>>�۴��s��</option><option value="�q�{��"<?=$r[myarea]=="�q�{��"?' selected':''?>>�q�{��</option><option value="������"<?=$r[myarea]=="������"?' selected':''?>>������</option><option value="�j����"<?=$r[myarea]=="�j����"?' selected':''?>>�j����</option><option value="�䥦"<?=$r[myarea]=="�䥦"?' selected':''?>>�䥦</option></select></td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�l�c</td><td bgcolor=ffffff><input name="email" type="text" id="email" value="<?=$ecmsfirstpost==1?$memberinfor[email]:ehtmlspecialchars(stripSlashes($r[email]))?>" size="60">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�覡</td><td bgcolor=ffffff><input name="mycontact" type="text" id="mycontact" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[mycontact]))?>" size="60">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�a�}</td><td bgcolor=ffffff><input name="address" type="text" id="address" value="<?=$ecmsfirstpost==1?$memberinfor[address]:ehtmlspecialchars(stripSlashes($r[address]))?>" size="60">
</td></tr></table>