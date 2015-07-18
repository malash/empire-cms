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
    <td width=16% height=25 bgcolor=ffffff>軟件名稱(*)</td>
    <td bgcolor=ffffff>
<input name="title" type="text" size="42" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'title',stripSlashes($r[title]))?>">
</td>
  </tr>
  <tr>
    <td width='16%' height=25 bgcolor='ffffff'>關鍵字</td>
    <td bgcolor='ffffff'>
<input name="keyboard" type="text" size=42 value="<?=stripSlashes($r[keyboard])?>">
<font color="#666666">(多個請用&quot;,&quot;隔開)</font>
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>軟件預覽圖</td>
    <td bgcolor=ffffff><input type="file" name="titlepicfile" size="45">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>軟件作者</td>
    <td bgcolor=ffffff><input name="softwriter" type="text" id="softwriter" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'softwriter',stripSlashes($r[softwriter]))?>" size="42">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>廠商主頁</td>
    <td bgcolor=ffffff><input name="homepage" type="text" id="homepage" value="<?=$ecmsfirstpost==1?"http://":DoReqValue($mid,'homepage',stripSlashes($r[homepage]))?>" size="42">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>系統演示</td>
    <td bgcolor=ffffff><input name="demo" type="text" id="demo" value="<?=$ecmsfirstpost==1?"http://":DoReqValue($mid,'demo',stripSlashes($r[demo]))?>" size="42">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>運行環境</td>
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
    <td width=16% height=25 bgcolor=ffffff>軟件屬性</td>
    <td bgcolor=ffffff>軟件語言：<select name="language" id="language"><option value="簡體中文"<?=$r[language]=="簡體中文"?' selected':''?>>簡體中文</option><option value="繁體中文"<?=$r[language]=="繁體中文"?' selected':''?>>繁體中文</option><option value="英文"<?=$r[language]=="英文"?' selected':''?>>英文</option><option value="多國語言"<?=$r[language]=="多國語言"?' selected':''?>>多國語言</option></select>，軟件類型：<select name="softtype" id="softtype"><option value="國產軟件"<?=$r[softtype]=="國產軟件"?' selected':''?>>國產軟件</option><option value="漢化軟件"<?=$r[softtype]=="漢化軟件"?' selected':''?>>漢化軟件</option><option value="國外軟件"<?=$r[softtype]=="國外軟件"?' selected':''?>>國外軟件</option></select>，授權形式：<select name="softsq" id="softsq"><option value="共享軟件"<?=$r[softsq]=="共享軟件"?' selected':''?>>共享軟件</option><option value="免費軟件"<?=$r[softsq]=="免費軟件"?' selected':''?>>免費軟件</option><option value="自由軟件"<?=$r[softsq]=="自由軟件"?' selected':''?>>自由軟件</option><option value="試用軟件"<?=$r[softsq]=="試用軟件"?' selected':''?>>試用軟件</option><option value="演示軟件"<?=$r[softsq]=="演示軟件"?' selected':''?>>演示軟件</option><option value="商業軟件"<?=$r[softsq]=="商業軟件"?' selected':''?>>商業軟件</option></select></td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>文件</td>
    <td bgcolor=ffffff>文件類型：<input name="filetype" type="text" id="filetype" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'filetype',stripSlashes($r[filetype]))?>" size="10">
<select name="select2" onchange="document.add.filetype.value=this.value">
        <option value="">類型</option>
        <option value=".zip">.zip</option>
        <option value=".rar">.rar</option>
        <option value=".exe">.exe</option>
      </select>，文件大小：<input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":DoReqValue($mid,'filesize',stripSlashes($r[filesize]))?>" size="10">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">單位</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>上傳軟件(*)</td>
    <td bgcolor=ffffff><input type="file" name="downpathfile" size="45">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>軟件簡介(*)</td>
    <td bgcolor=ffffff><textarea name="softsay" cols="60" rows="10" id="softsay"><?=$ecmsfirstpost==1?"":DoReqValue($mid,'softsay',stripSlashes($r[softsay]))?></textarea>
</td>
  </tr>
</table>