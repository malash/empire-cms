<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>�v���W</td><td bgcolor=ffffff>
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
</td></tr><tr><td bgcolor=ffffff>�v���Y����</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td bgcolor=ffffff>�v������</td><td bgcolor=ffffff><select name="movietype" id="movietype"><option value="��x�v��"<?=$r[movietype]=="��x�v��"?' selected':''?>>��x�v��</option><option value="���~�v��"<?=$r[movietype]=="���~�v��"?' selected':''?>>���~�v��</option><option value="�j���v��"<?=$r[movietype]=="�j���v��"?' selected':''?>>�j���v��</option><option value="�����v��"<?=$r[movietype]=="�����v��"?' selected':''?>>�����v��</option></select></td></tr><tr><td bgcolor=ffffff>�X�~���q</td><td bgcolor=ffffff>
<input name="company" type="text" id="company" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[company]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�X�~�ɶ�</td><td bgcolor=ffffff>
<input name="movietime" type="text" id="movietime" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[movietime]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�D�t</td><td bgcolor=ffffff>
<input name="player" type="text" id="player" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[player]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�ɺt</td><td bgcolor=ffffff>
<input name="playadmin" type="text" id="playadmin" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[playadmin]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�v���榡</td><td bgcolor=ffffff><input name="filetype" type="text" id="filetype" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filetype]))?>" size="8">
<select name="select2" onchange="document.add.filetype.value=this.value">
        <option value="">����</option>
        <option value=".rm">.rm</option>
        <option value=".rmvb">.rmvb</option>
        <option value=".mp3">.mp3</option>
        <option value=".asf">.asf</option>
        <option value=".wmv">.wmv</option>
        <option value=".avi">.avi</option>
      </select></td></tr><tr><td bgcolor=ffffff>�v���j�p</td><td bgcolor=ffffff><input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filesize]))?>" size="12">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">���</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td></tr><tr><td bgcolor=ffffff>���˵���</td><td bgcolor=ffffff><select name="star" id="star"><option value="1"<?=$r[star]=="1"?' selected':''?>>1�P</option><option value="2"<?=$r[star]=="2"||$ecmsfirstpost==1?' selected':''?>>2�P</option><option value="3"<?=$r[star]=="3"?' selected':''?>>3�P</option><option value="4"<?=$r[star]=="4"?' selected':''?>>4�P</option><option value="5"<?=$r[star]=="5"?' selected':''?>>5�P</option></select></td></tr><tr><td bgcolor=ffffff>�a�e�n�D</td><td bgcolor=ffffff>
<input name="playdk" type="text" id="playdk" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[playdk]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>����</td><td bgcolor=ffffff>
<input name="playtime" type="text" id="playtime" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[playtime]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�����I��</td><td bgcolor=ffffff>
<input name="moviefen" type="text" id="moviefen" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[moviefen]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�U���a�}</td><td bgcolor=ffffff><script>
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
</td></tr><tr><td bgcolor=ffffff>����</td><td bgcolor=ffffff>
<?php
$player_sql=$empire->query("select id,player from {$dbtbpre}enewsplayer");
while($player_r=$empire->fetch($player_sql))
{
	$select_player='';
	if($r[playerid]==$player_r[id])
	{
		$select_player=' selected';
	}
	$player_class.="<option value='".$player_r[id]."'".$select_player.">".$player_r[player]."</option>";
}
?>
<select name="playerid">
<option value=0>�۰��ѧO</option>
<?=$player_class?>
</select>
</td></tr><tr><td bgcolor=ffffff>�b�u�[�ݦa�}</td><td bgcolor=ffffff><script>
function dooadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.oeditnum.value);
for(i=1;i<=document.add.odownnum.value;i++)
{
j=i+oldi;
str=str+"<tr><td width=7%> <div align=center>"+j+"</div></td><td width=19%><div align=left><input name=odownname[] type=text value="+j+" size=17></div></td><td width=40%><input name=odownpath[] type=text size=36 id=odownpath"+j+" ondblclick=SpOpenChFile(0,'odownpath"+j+"')><select name=othedownqz[]><option value=''>--�a�}�e��--</option><?=$newdownqz?></select></td><td width=21%><div align=center><select name=odownuser[] id=select><option value=0>�C��</option><?=$ygroup?></select></div></td><td width=13%><div align=center><input name=ofen[] type=text value=0 size=6></div></td></tr>";
}
document.getElementById("addonline").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="25">�[�ݦa�}�e��&nbsp;: 
      <input name="onlineurl_qz" type="text" size="32"> <select name="changeonlineurl_qz" onchange="document.add.onlineurl_qz.value=document.add.changeonlineurl_qz.value">
        <option value="" selected>��ܫe��</option>
        <?=$downurlqz?>
      </select>
      </td>
  </tr>
  <tr> 
    <td height="25">���/�W�Ǫ���: 
      <input name="changeonline_url" id="changeonline_url" type="text" size="32"> <input type="button" name="Submit" value="���" onclick="window.open('ecmseditor/FileMain.php?type=0&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=changeonline_url<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');">&nbsp;
	  <input type="button" name="Submit" value="�ƻs" onclick="document.getElementById('changeonline_url').focus();document.getElementById('changeonline_url').select();clipboardData.setData('text',document.getElementById('changeonline_url').value);"></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
        <tr> 
          <td width="7%"> <div align="center">�s��</div></td>
          <td width="19%"><div align="left">�[�ݦW��</div></td>
          <td width="40%">�[�ݦa�} <font color="#666666">(�������)</font></td>
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
	$oeditnum=3;
	for($opathi=1;$opathi<=$oeditnum;$opathi++)
	{
	?>
		<tr> 
                  <td width='7%'> <div align=center><?=$opathi?></div></td>
                  <td width='19%'> <div align=left> 
                      <input name=odownname[] type=text value='<?=$opathi?>' size=17>
                    </div></td>
                  <td width='40%'> 
		  <input name=odownpath[] type=text id='odownpath<?=$opathi?>' size=36 ondblclick="SpOpenChFile(0,'odownpath<?=$opathi?>');">
		  <select name=othedownqz[]><option value=''>--�a�}�e��--</option><?=$newdownqz?></select> 
                  </td>
                  <td width='21%'><div align=center> 
                      <select name=odownuser[] id=select>
                        <option value=0>�C��</option>
                        <?=$ygroup?>
                      </select>
                    </div></td>
                  <td width='13%'> <div align=center> 
                      <input name=ofen[] type=text id=ofen[] value=0 size=6>
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
	$oeditnum=0;
	$onlinemoviepath="";
	if($r[onlinepath])
	{
		$j=0;
		$od_record=explode("\r\n",$r[onlinepath]);
		for($i=0;$i<count($od_record);$i++)
		{
			$j=$i+1;
			$od_field=explode("::::::",$od_record[$i]);
			//�v��
			$tgroup=str_replace(" value=".$od_field[2].">"," value=".$od_field[2]." selected>",$ygroup);
			//�a�}�e��
			$tnewdownqz=str_replace(" value='".$od_field[4]."'>"," value='".$od_field[4]."' selected>",$newdownqz);
			$onlinemoviepath.="<tr><td width='7%'><div align=center>".$j."</div></td><td width='19%'><div align=left><input name=odownname[] type=text value='".$od_field[0]."' size=17></div></td><td width='40%'><input name=odownpath[] type=text value='".$od_field[1]."' size=36 id=odownpath".$j." ondblclick=\"SpOpenChFile(0,'odownpath".$j."');\"><select name=othedownqz[]><option value=''>--�a�}�e��--</option>".$tnewdownqz."</select><input type=hidden name=opathid[] value=".$j."><input type=checkbox name=odelpathid[] value=".$j.">�R</td><td width='21%'><div align=center><select name=odownuser[] id=select><option value=0>�C��</option>".$tgroup."</select></div></td><td width='13%'><div align=center><input name=ofen[] type=text value='".$od_field[3]."' size=6></div></td></tr>";
		}
		$oeditnum=$j;
		$onlinemoviepath="<table width='100%' border=0 cellspacing=1 cellpadding=3>".$onlinemoviepath."</table>";
	}
	echo $onlinemoviepath;
    }
    ?>
    </td>
  </tr>
  <tr> 
    <td height="25">�b�u�a�}�X�i�ƶq: <input name="oeditnum" type="hidden" id="oeditnum" value="<?=$oeditnum?>">
      <input name="odownnum" type="text" id="odownnum" value="1" size="6"> <input type="button" name="Submit5" value="��X�a�}" onclick="javascript:dooadd();"></td>
  </tr>
  <tr> 
    <td id=addonline></td>
  </tr>
</table>
</td></tr><tr><td bgcolor=ffffff>�v��²��</td><td bgcolor=ffffff><textarea name="moviesay" cols="80" rows="10" id="moviesay"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[moviesay]))?></textarea>
</td></tr>