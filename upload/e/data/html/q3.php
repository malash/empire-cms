<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1 class=tableborder><tr><td width=16% height=25 bgcolor=ffffff>圖片名稱</td><td bgcolor=ffffff>
<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'title',stripSlashes($r[title]))?>">
</td></tr>
  <tr>
    <td width='16%' height=25 bgcolor='ffffff'>關鍵字</td>
    <td bgcolor='ffffff'>
<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">
<font color="#666666">(多個請用&quot;,&quot;隔開)</font>
</td>
  </tr>
<tr><td width=16% height=25 bgcolor=ffffff>文件大小</td><td bgcolor=ffffff><input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'filesize',stripSlashes($r[filesize]))?>" size="42">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">單位</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td></tr><tr><td width=16% height=25 bgcolor=ffffff>圖片尺寸</td><td bgcolor=ffffff><input name="picsize" type="text" id="picsize" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'picsize',stripSlashes($r[picsize]))?>" size="42">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>圖片分辨率</td><td bgcolor=ffffff><input name="picfbl" type="text" id="picfbl" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'picfbl',stripSlashes($r[picfbl]))?>" size="42">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>來源</td><td bgcolor=ffffff><input name="picfrom" type="text" id="picfrom" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'picfrom',stripSlashes($r[picfrom]))?>" size="42">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>圖片小圖</td><td bgcolor=ffffff><input type="file" name="titlepicfile" size="45">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>圖片大圖</td><td bgcolor=ffffff><input type="file" name="picurlfile" size="45">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>圖片簡介</td><td bgcolor=ffffff><textarea name="picsay" cols="60" rows="10" id="picsay"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'picsay',stripSlashes($r[picsay]))?></textarea>
</td></tr></table>