<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder"><tr>
    <td width=16% height=25 bgcolor=ffffff>�H�����D(*)</td>
    <td bgcolor=ffffff>
<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'title',stripSlashes($r[title]))?>">
</td></tr><tr>
    <td width=16% height=25 bgcolor=ffffff>�H�����e(*)</td>
    <td bgcolor=ffffff><textarea name="smalltext" cols="60" rows="10" id="smalltext"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'smalltext',stripSlashes($r[smalltext]))?></textarea>
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�Ϥ�</td><td bgcolor=ffffff><input type="file" name="titlepicfile" size="45">
</td></tr><tr>
    <td width=16% height=25 bgcolor=ffffff>�Ҧb�a(*)</td>
    <td bgcolor=ffffff><select name="myarea" id="myarea"><option value="�F����"<?=$r[myarea]=="�F����"||$ecmsfirstpost==1?' selected':''?>>�F����</option><option value="�諰��"<?=$r[myarea]=="�諰��"?' selected':''?>>�諰��</option><option value="�R���"<?=$r[myarea]=="�R���"?' selected':''?>>�R���</option><option value="�ŪZ��"<?=$r[myarea]=="�ŪZ��"?' selected':''?>>�ŪZ��</option><option value="�¶���"<?=$r[myarea]=="�¶���"?' selected':''?>>�¶���</option><option value="������"<?=$r[myarea]=="������"?' selected':''?>>������</option><option value="�ץx��"<?=$r[myarea]=="�ץx��"?' selected':''?>>�ץx��</option><option value="�۴��s��"<?=$r[myarea]=="�۴��s��"?' selected':''?>>�۴��s��</option><option value="�q�{��"<?=$r[myarea]=="�q�{��"?' selected':''?>>�q�{��</option><option value="������"<?=$r[myarea]=="������"?' selected':''?>>������</option><option value="�j����"<?=$r[myarea]=="�j����"?' selected':''?>>�j����</option><option value="�䥦"<?=$r[myarea]=="�䥦"?' selected':''?>>�䥦</option></select></td></tr><tr>
    <td width=16% height=25 bgcolor=ffffff>�pô�l�c(*)</td>
    <td bgcolor=ffffff><input name="email" type="text" id="email" value="<?=$ecmsfirstpost==1?$memberinfor[email]:DoReqValue($mid,'email',stripSlashes($r[email]))?>" size="46">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�覡</td><td bgcolor=ffffff><input name="mycontact" type="text" id="mycontact" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'mycontact',stripSlashes($r[mycontact]))?>" size="46">
</td></tr><tr><td width=16% height=25 bgcolor=ffffff>�pô�a�}</td><td bgcolor=ffffff><input name="address" type="text" id="address" value="<?=$ecmsfirstpost==1?$memberinfor[address]:DoReqValue($mid,'address',stripSlashes($r[address]))?>" size="46">
</td></tr></table>