<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><script>
function AddFj(str)
{var r;
var a;
a=document.add.softfj.value;
r=a.split(str);
if(r.length!=1)
{return true;}
document.add.softfj.value+="/"+str;
}
function DelFj(str)
{
var a;
a=document.add.softfj.value;
document.add.softfj.value=a.replace("/"+str,"");
}
</script>
<table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder">
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�n��W��(*)</td>
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
    <td width=16% height=25 bgcolor=ffffff>�n��w����</td>
    <td bgcolor=ffffff><input type="file" name="titlepicfile" size="45">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�n��@��</td>
    <td bgcolor=ffffff><input name="softwriter" type="text" id="softwriter" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'softwriter',stripSlashes($r[softwriter]))?>" size="42">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�t�ӥD��</td>
    <td bgcolor=ffffff><input name="homepage" type="text" id="homepage" value="<?=$ecmsfirstpost==1?"http://":DoReqValue($mid,'homepage',stripSlashes($r[homepage]))?>" size="42">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�t�κt��</td>
    <td bgcolor=ffffff><input name="demo" type="text" id="demo" value="<?=$ecmsfirstpost==1?"http://":DoReqValue($mid,'demo',stripSlashes($r[demo]))?>" size="42">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�B������</td>
    <td bgcolor=ffffff><input name="softfj" type="text" id="softfj" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'softfj',stripSlashes($r[softfj]))?>" size="42">
</td>
  </tr>
  <tr> 
    <td height=25 bgcolor=ffffff>&nbsp;</td>
    <td bgcolor=ffffff><input type=checkbox name=check value='Win9X/Me' onclick="if(this.checked){AddFj(this.value);}else{DelFj(this.value);}">
      Win9X/Me&nbsp; <input type=checkbox name=check value='WinNT/2000/XP' onclick="if(this.checked){AddFj(this.value);}else{DelFj(this.value);}">
      WinNT/2000/XP&nbsp; <input type=checkbox name=check value='Unix' onclick="if(this.checked){AddFj(this.value);}else{DelFj(this.value);}">
      Unix&nbsp; <input type=checkbox name=check value='Linux' onclick="if(this.checked){AddFj(this.value);}else{DelFj(this.value);}">
      Linux&nbsp; <input type=checkbox name=check value='DOS' onclick="if(this.checked){AddFj(this.value);}else{DelFj(this.value);}">
      DOS&nbsp; <input type=checkbox name=check value='MAC OS' onclick="if(this.checked){AddFj(this.value);}else{DelFj(this.value);}">
      MAC OS&nbsp; <input type=checkbox name=check value='Other' onclick="if(this.checked){AddFj(this.value);}else{DelFj(this.value);}">
      Other</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�n���ݩ�</td>
    <td bgcolor=ffffff>�n��y���G<select name="language" id="language"><option value="²�餤��"<?=$r[language]=="²�餤��"?' selected':''?>>²�餤��</option><option value="�c�餤��"<?=$r[language]=="�c�餤��"?' selected':''?>>�c�餤��</option><option value="�^��"<?=$r[language]=="�^��"?' selected':''?>>�^��</option><option value="�h��y��"<?=$r[language]=="�h��y��"?' selected':''?>>�h��y��</option></select>�A�n�������G<select name="softtype" id="softtype"><option value="�겣�n��"<?=$r[softtype]=="�겣�n��"?' selected':''?>>�겣�n��</option><option value="�~�Ƴn��"<?=$r[softtype]=="�~�Ƴn��"?' selected':''?>>�~�Ƴn��</option><option value="��~�n��"<?=$r[softtype]=="��~�n��"?' selected':''?>>��~�n��</option></select>�A���v�Φ��G<select name="softsq" id="softsq"><option value="�@�ɳn��"<?=$r[softsq]=="�@�ɳn��"?' selected':''?>>�@�ɳn��</option><option value="�K�O�n��"<?=$r[softsq]=="�K�O�n��"?' selected':''?>>�K�O�n��</option><option value="�ۥѳn��"<?=$r[softsq]=="�ۥѳn��"?' selected':''?>>�ۥѳn��</option><option value="�եγn��"<?=$r[softsq]=="�եγn��"?' selected':''?>>�եγn��</option><option value="�t�ܳn��"<?=$r[softsq]=="�t�ܳn��"?' selected':''?>>�t�ܳn��</option><option value="�ӷ~�n��"<?=$r[softsq]=="�ӷ~�n��"?' selected':''?>>�ӷ~�n��</option></select></td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>���</td>
    <td bgcolor=ffffff>��������G<input name="filetype" type="text" id="filetype" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'filetype',stripSlashes($r[filetype]))?>" size="10">
<select name="select2" onchange="document.add.filetype.value=this.value">
        <option value="">����</option>
        <option value=".zip">.zip</option>
        <option value=".rar">.rar</option>
        <option value=".exe">.exe</option>
      </select>�A���j�p�G<input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'filesize',stripSlashes($r[filesize]))?>" size="10">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">���</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�W�ǳn��(*)</td>
    <td bgcolor=ffffff><input type="file" name="downpathfile" size="45">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�n��²��(*)</td>
    <td bgcolor=ffffff><textarea name="softsay" cols="60" rows="10" id="softsay"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'softsay',stripSlashes($r[softsay]))?></textarea>
</td>
  </tr>
</table>