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
</td>
  </tr>
  <tr>
    <td width='16%' height=25 bgcolor='ffffff'>�S���ݩ�</td>
    <td bgcolor='ffffff'>
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
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�o�G�ɶ�</td>
    <td bgcolor=ffffff>
<input name="newstime" type="text" value="<?=$r[newstime]?>"><input type=button name=button value="�]����e�ɶ�" onclick="document.add.newstime.value='<?=$todaytime?>'">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�n��w����</td>
    <td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�n��@��</td>
    <td bgcolor=ffffff><input name="softwriter" type="text" id="softwriter" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[softwriter]))?>" size="60">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�t�ӥD��</td>
    <td bgcolor=ffffff><input name="homepage" type="text" id="homepage" value="<?=$ecmsfirstpost==1?"http://":ehtmlspecialchars(stripSlashes($r[homepage]))?>" size="60">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�t�κt��</td>
    <td bgcolor=ffffff><input name="demo" type="text" id="demo" value="<?=$ecmsfirstpost==1?"http://":ehtmlspecialchars(stripSlashes($r[demo]))?>" size="60">
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�B������</td>
    <td bgcolor=ffffff><input name="softfj" type="text" id="softfj" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[softfj]))?>" size="60">
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
    <td bgcolor=ffffff>�n��y���G<select name="language" id="language"><option value="²�餤��"<?=$r[language]=="²�餤��"?' selected':''?>>²�餤��</option><option value="�c�餤��"<?=$r[language]=="�c�餤��"?' selected':''?>>�c�餤��</option><option value="�^��"<?=$r[language]=="�^��"?' selected':''?>>�^��</option><option value="�h��y��"<?=$r[language]=="�h��y��"?' selected':''?>>�h��y��</option></select>�A�n�������G<select name="softtype" id="softtype"><option value="�겣�n��"<?=$r[softtype]=="�겣�n��"?' selected':''?>>�겣�n��</option><option value="�~�Ƴn��"<?=$r[softtype]=="�~�Ƴn��"?' selected':''?>>�~�Ƴn��</option><option value="��~�n��"<?=$r[softtype]=="��~�n��"?' selected':''?>>��~�n��</option></select>�A���v�Φ��G<select name="softsq" id="softsq"><option value="�@�ɳn��"<?=$r[softsq]=="�@�ɳn��"?' selected':''?>>�@�ɳn��</option><option value="�K�O�n��"<?=$r[softsq]=="�K�O�n��"?' selected':''?>>�K�O�n��</option><option value="�ۥѳn��"<?=$r[softsq]=="�ۥѳn��"?' selected':''?>>�ۥѳn��</option><option value="�եγn��"<?=$r[softsq]=="�եγn��"?' selected':''?>>�եγn��</option><option value="�t�ܳn��"<?=$r[softsq]=="�t�ܳn��"?' selected':''?>>�t�ܳn��</option><option value="�ӷ~�n��"<?=$r[softsq]=="�ӷ~�n��"?' selected':''?>>�ӷ~�n��</option></select>�A�n������G<select name="star" id="star"><option value="1"<?=$r[star]=="1"?' selected':''?>>1�P</option><option value="2"<?=$r[star]=="2"||$ecmsfirstpost==1?' selected':''?>>2�P</option><option value="3"<?=$r[star]=="3"?' selected':''?>>3�P</option><option value="4"<?=$r[star]=="4"?' selected':''?>>4�P</option><option value="5"<?=$r[star]=="5"?' selected':''?>>5�P</option></select></td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>���</td>
    <td bgcolor=ffffff>��������G<input name="filetype" type="text" id="filetype" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filetype]))?>" size="">
<select name="select2" onchange="document.add.filetype.value=this.value">
        <option value="">����</option>
        <option value=".zip">.zip</option>
        <option value=".rar">.rar</option>
        <option value=".exe">.exe</option>
      </select>�A���j�p�G<input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filesize]))?>" size="">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">���</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�U���a�}(*)</td>
    <td bgcolor=ffffff><script>
function doadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.editnum.value);
for(i=1;i<=document.add.downnum.value;i++)
{
j=i+oldi;
str=str+"<tr><td width=7%> <div align=center>"+j+"</div></td><td width=19%><div align=left><input name=downname[] type=text id=downname[] value=�U���a�}"+j+" size=17></div></td><td width=40%><input name=downpath[] type=text size=36 id=downpath"+j+" ondblclick=SpOpenChFile(0,'downpath"+j+"')><select name=thedownqz[]><option value=''>--�a�}�e��--</option><?=$newdownqz?></select></td><td width=21%><div align=center><select name=downuser[] id=select><option value=0>�C��</option><?=$ygroup?></select></div></td><td width=13%><div align=center><input name=fen[] type=text id=fen[] value=0 size=6></div></td></tr>";
}
document.getElementById("adddown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25">�U���a�}�e��&nbsp;:
      <input name="downurl_qz" type="text" size="32">
      <select name="changeurl_qz" onchange="document.add.downurl_qz.value=document.add.changeurl_qz.value">
        <option value="" selected>��ܫe��</option>
        <?=$downurlqz?>
      </select>
	  </td>
  </tr>
  <tr>
    <td height="25">���/�W�Ǫ���:
      <input name="changedown_url" id="changedown_url" type="text" size="32">
      <input type="button" name="Submit" value="���" onclick="window.open('ecmseditor/FileMain.php?type=0&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=changedown_url<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');">&nbsp;
	  <input type="button" name="Submit" value="�ƻs" onclick="document.getElementById('changedown_url').focus();document.getElementById('changedown_url').select();clipboardData.setData('text',document.getElementById('changedown_url').value);"></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
        <tr> 
          <td width="7%"> <div align="center">�s��</div></td>
          <td width="19%"><div align="left">�U���W��</div></td>
          <td width="40%">�U���a�} <font color="#666666">(�������)</font></td>
          <td width="21%"> <div align="center">�v��</div></td>
          <td width="13%"> <div align="center">�I��</div></td>
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
                  <input name=downname[] type=text value='�U���a�}<?=$pathi?>' size=17>
                    </div></td>
              <td width='40%'>
	      <input name=downpath[] type=text size=36 id='downpath<?=$pathi?>' ondblclick="SpOpenChFile(0,'downpath<?=$pathi?>');">
	      <select name=thedownqz[]><option value=''>--�a�}�e��--</option><?=$newdownqz?></select> 
                  </td>
                  <td width='21%'><div align=center> 
                      <select name=downuser[]>
                        <option value=0>�C��</option>
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
		//�U���a�}
		$j=0;
		$d_record=explode("\r\n",$r[downpath]);
		for($i=0;$i<count($d_record);$i++)
		{
			$j=$i+1;
			$d_field=explode("::::::",$d_record[$i]);
			//�v��
			$tgroup=str_replace(" value=".$d_field[2].">"," value=".$d_field[2]." selected>",$ygroup);
			//�a�}�e��
			$tnewdownqz=str_replace(" value='".$d_field[4]."'>"," value='".$d_field[4]."' selected>",$newdownqz);
			$downloadpath.="<tr><td width='7%'><div align=center>".$j."</div></td><td width='19%'><div align=left><input name=downname[] type=text id=downname[] value='".$d_field[0]."' size=17></div></td><td width='40%'><input name=downpath[] type=text id=downpath".$j." value='".$d_field[1]."' size=36 ondblclick=\"SpOpenChFile(0,'downpath".$j."');\"><select name=thedownqz[]><option value=''>--�a�}�e��--</option>".$tnewdownqz."</select><input type=hidden name=pathid[] value=".$j."><input type=checkbox name=delpathid[] value=".$j.">�R</td><td width='21%'><div align=center><select name=downuser[] id=select><option value=0>�C��</option>".$tgroup."</select></div></td><td width='13%'><div align=center><input name=fen[] type=text id=fen[] value='".$d_field[3]."' size=6></div></td></tr>";
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
    <td height="25">�U���a�}�X�i�ƶq: <input name="editnum" type="hidden" id="editnum" value="<?=$editnum?>">
      <input name="downnum" type="text" id="downnum" value="1" size="6"> <input type="button" name="Submit5" value="��X�a�}" onclick="javascript:doadd();"></td>
  </tr>
  <tr> 
    <td id=adddown></td>
  </tr>
</table>
</td>
  </tr>
  <tr> 
    <td width=16% height=25 bgcolor=ffffff>�n��²��(*)</td>
    <td bgcolor=ffffff><textarea name="softsay" cols="80" rows="10" id="softsay"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[softsay]))?></textarea>
</td>
  </tr>
</table>