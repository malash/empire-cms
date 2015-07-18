<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder"><tr>
    <td width=16% height=25 bgcolor=ffffff>信息標題(*)</td>
    <td bgcolor=ffffff>
<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'title',stripSlashes($r[title]))?>">
</td></tr><tr>
    <td width=16% height=25 bgcolor=ffffff>信息內容(*)</td>
    <td bgcolor=ffffff><textarea name="smalltext" cols="60" rows="10" id="smalltext"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'smalltext',stripSlashes($r[smalltext]))?></textarea>
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>圖片</td><td bgcolor=ffffff><input type="file" name="titlepicfile" size="45">
</td></tr><tr>
    <td width=16% height=25 bgcolor=ffffff>所在地(*)</td>
    <td bgcolor=ffffff><select name="myarea" id="myarea"><option value="東城區"<?=$r[myarea]=="東城區"||$ecmsfirstpost==1?' selected':''?>>東城區</option><option value="西城區"<?=$r[myarea]=="西城區"?' selected':''?>>西城區</option><option value="崇文區"<?=$r[myarea]=="崇文區"?' selected':''?>>崇文區</option><option value="宣武區"<?=$r[myarea]=="宣武區"?' selected':''?>>宣武區</option><option value="朝陽區"<?=$r[myarea]=="朝陽區"?' selected':''?>>朝陽區</option><option value="海澱區"<?=$r[myarea]=="海澱區"?' selected':''?>>海澱區</option><option value="豐台區"<?=$r[myarea]=="豐台區"?' selected':''?>>豐台區</option><option value="石景山區"<?=$r[myarea]=="石景山區"?' selected':''?>>石景山區</option><option value="通州區"<?=$r[myarea]=="通州區"?' selected':''?>>通州區</option><option value="昌平區"<?=$r[myarea]=="昌平區"?' selected':''?>>昌平區</option><option value="大興區"<?=$r[myarea]=="大興區"?' selected':''?>>大興區</option><option value="其它"<?=$r[myarea]=="其它"?' selected':''?>>其它</option></select></td></tr><tr>
    <td width=16% height=25 bgcolor=ffffff>聯繫郵箱(*)</td>
    <td bgcolor=ffffff><input name="email" type="text" id="email" value="<?=$ecmsfirstpost==1?$memberinfor[email]:DoReqValue($mid,'email',stripSlashes($r[email]))?>" size="46">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>聯繫方式</td><td bgcolor=ffffff><input name="mycontact" type="text" id="mycontact" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'mycontact',stripSlashes($r[mycontact]))?>" size="46">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>聯繫地址</td><td bgcolor=ffffff><input name="address" type="text" id="address" value="<?=$ecmsfirstpost==1?$memberinfor[address]:DoReqValue($mid,'address',stripSlashes($r[address]))?>" size="46">
</td></tr></table>