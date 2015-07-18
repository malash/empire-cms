<?php
if(!defined('InEmpireCMS'))
{exit();}
?><table width='100%' align='center' cellpadding=3 cellspacing=1 bgcolor='#DBEAF5'>
<tr><td width='25%' height=25 bgcolor='ffffff'>真實姓名</td><td bgcolor='ffffff'>
<input name="truename" type="text" id="truename" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[truename]))?>">
</td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>QQ號碼</td><td bgcolor='ffffff'><input name="oicq" type="text" id="oicq" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[oicq]))?>">
</td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>MSN</td><td bgcolor='ffffff'><input name="msn" type="text" id="msn" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[msn]))?>">
</td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>聯繫電話</td><td bgcolor='ffffff'><input name="mycall" type="text" id="mycall" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[mycall]))?>">
</td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>手機</td><td bgcolor='ffffff'><input name="phone" type="text" id="phone" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[phone]))?>">
</td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>網站地址</td><td bgcolor='ffffff'>
<input name="homepage" type="text" id="homepage" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[homepage]))?>">
</td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>會員頭像</td><td bgcolor='ffffff'><input type="file" name="userpicfile">&nbsp;&nbsp;
<?=empty($addr[userpic])?"":"<img src='".htmlspecialchars(stripSlashes($addr[userpic]))."' border=0>"?></td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>聯繫地址</td><td bgcolor='ffffff'><input name="address" type="text" id="address" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[address]))?>" size="50">
&nbsp;郵編: <input name="zip" type="text" id="zip" value="<?=$ecmsfirstpost==1?"":htmlspecialchars(stripSlashes($addr[zip]))?>" size="8">
</td></tr>
<tr><td width='16%' height=25 bgcolor='ffffff'>個人介紹</td><td bgcolor='ffffff'><textarea name="saytext" cols="65" rows="10" id="saytext"><?=$ecmsfirstpost==1?"":stripSlashes($addr[saytext])?></textarea>
</td></tr>
</table>