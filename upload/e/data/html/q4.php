<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width='100%' align=center cellpadding=3 cellspacing=1 class=tableborder>
  <tr>
    <td width=16% height=25 bgcolor=ffffff>�@�~�W(*)</td>
    <td bgcolor=ffffff>
<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'title',stripSlashes($r[title]))?>">
</td>
  </tr>
  <tr> 
    <td width='16%' height=25 bgcolor='ffffff'>����r</td>
    <td bgcolor='ffffff'>
<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">
<font color="#666666">(�h�ӽХ�&quot;,&quot;�j�})</font>
</td>
  </tr>
  <tr>
    <td width=16% height=25 bgcolor=ffffff>�@�~�w����</td>
    <td bgcolor=ffffff><input type="file" name="titlepicfile" size="45">
</td>
  </tr>
  <tr>
    <td width=16% height=25 bgcolor=ffffff>�@��</td>
    <td bgcolor=ffffff><input name="flashwriter" type="text" id="flashwriter" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'flashwriter',stripSlashes($r[flashwriter]))?>" size="42">
</td>
  </tr>
  <tr>
    <td width=16% height=25 bgcolor=ffffff>�@�̶l�c</td>
    <td bgcolor=ffffff><input name="email" type="text" id="email" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'email',stripSlashes($r[email]))?>" size="42">
</td>
  </tr>
  <tr>
    <td width=16% height=25 bgcolor=ffffff>���j�p</td>
    <td bgcolor=ffffff><input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'filesize',stripSlashes($r[filesize]))?>" size="42">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">���</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td>
  </tr>
  <tr>
    <td width=16% height=25 bgcolor=ffffff>�W��Flash(*)</td>
    <td bgcolor=ffffff><input type="file" name="flashurlfile" size="45">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>Flash�W��</td>
    <td bgcolor=ffffff><input name="width" type="text" id="width" value="<?=$ecmsfirstpost==1?"600":DoReqValue($mid,'width',stripSlashes($r[width]))?>" size="6">
*<input name="height" type="text" id="height" value="<?=$ecmsfirstpost==1?"450":DoReqValue($mid,'height',stripSlashes($r[height]))?>" size="6">
<font color="#666666">(�e��*����)</font></td>
  </tr>
  <tr>
    <td width=16% height=25 bgcolor=ffffff>�@�~²��(*)</td>
    <td bgcolor=ffffff><textarea name="flashsay" cols="60" rows="10" id="flashsay"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'flashsay',stripSlashes($r[flashsay]))?></textarea>
</td>
  </tr>
</table>
