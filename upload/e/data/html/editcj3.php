<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><tr><td bgcolor=ffffff>�Ϥ��W��</td><td bgcolor=ffffff>
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
</td></tr><tr><td bgcolor=ffffff>���j�p</td><td bgcolor=ffffff><input name="filesize" type="text" id="filesize" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[filesize]))?>" size="60">
<select name="select" onchange="document.add.filesize.value+=this.value">
        <option value="">���</option>
        <option value=" MB">MB</option>
        <option value=" KB">KB</option>
        <option value=" GB">GB</option>
        <option value=" BYTES">BYTES</option>
      </select></td></tr><tr><td bgcolor=ffffff>�Ϥ��ؤo</td><td bgcolor=ffffff><input name="picsize" type="text" id="picsize" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[picsize]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�Ϥ�����v</td><td bgcolor=ffffff><input name="picfbl" type="text" id="picfbl" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[picfbl]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�ӷ�</td><td bgcolor=ffffff><input name="picfrom" type="text" id="picfrom" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[picfrom]))?>" size="60">
</td></tr><tr><td bgcolor=ffffff>�Ϥ��p��</td><td bgcolor=ffffff><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=titlepic<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td bgcolor=ffffff>�Ϥ��j��</td><td bgcolor=ffffff><input name="picurl" type="text" id="picurl" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[picurl]))?>" size="45">
<a onclick="window.open('ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&sinfo=1&doing=1&field=picurl<?=$ecms_hashur[ehref]?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../data/images/changeimg.gif" border="0" align="absbottom"></a> 
</td></tr><tr><td bgcolor=ffffff>�Ϥ���</td><td bgcolor=ffffff><script>
function dopicadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.morepicnum.value);
for(i=1;i<=document.add.downmorepicnum.value;i++)
{
j=i+oldi;
str=str+"<tr><td width=7%><div align=center>"+j+"</div></td><td width=33%><div align=center><input name=msmallpic[] type=text size=28 id=msmallpic"+j+" ondblclick=SpOpenChFile(1,'msmallpic"+j+"')><br><input type=file name=msmallpfile[] size=15></div></td><td width=30%><div align=center><input name=mbigpic[] type=text size=28 id=mbigpic"+j+" ondblclick=SpOpenChFile(1,'mbigpic"+j+"')><br><input type=file name=mbigpfile[] size=15></div></td><td width=30%><div align=center><input name=mpicname[] type=text></div></td></tr>";
}
document.getElementById("addpicdown").innerHTML="<table width='100%' border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25">
	�Ϥ��a�}�e��:
      <input name="mpicurl_qz" type="text" id="mpicurl_qz">&nbsp;&nbsp;
	  <input type="checkbox" name="msavepic" value="1">���{�O�s&nbsp;<input type="checkbox" name="mcreatespic" value="1" onclick="if(this.checked){setmcreatespic.style.display='';}else{setmcreatespic.style.display='none';}">�ͦ��Y��
	  <span id="setmcreatespic" style="display:none">�G<input type=text name="mcreatespicwidth" size=4 value="<?=$public_r[spicwidth]?>">*<input type=text name="mcreatespicheight" size=4 value="<?=$public_r[spicheight]?>">(�e*��)</span>
<?php
if(TranmoreIsOpen())
{
?>
<input type="button" name="Submit" value="�h��W��" onclick="window.open('ecmseditor/tranmore/tranmore.php?type=1&classid=<?=$classid?>&filepass=<?=$filepass?>&infoid=<?=$id?>&modtype=0&sinfo=1&ecmsdo=ecmstmmorepic&tranfrom=2<?=$ecms_hashur['ehref']?>&oldmorepicnum='+document.add.morepicnum.value,'ecmstmpage','width=700,height=550,scrollbars=yes');">
<?php
}
?>
 </td>
  </tr>
  <tr> 
    <td><table width="100%" border=0 align=center cellpadding=3 cellspacing=1>
  <tr bgcolor="#DBEAF5"> 
    <td width="7%"><div align=center>�s��</div></td>
    <td width="33%"><div align=center>�Y�� <font color="#666666">(�������)</font></div></td>
    <td width="30%"><div align=center>�j�� <font color="#666666">(�������)</font></div></td>
    <td width="30%"><div align=center>�Ϥ�����</div></td>
  </tr>
</table></td>
  </tr>
  <tr> 
    <td id=defmorepicid>
    <?php
    if($ecmsfirstpost==1)
    {
	?>
	<table width='100%' border=0 align=center cellpadding=3 cellspacing=1>
	<?php
	$morepicnum=3;
	for($mppathi=1;$mppathi<=$morepicnum;$mppathi++)
	{
	?>
	<tr> 
		<td width='7%'><div align=center><?=$mppathi?></div></td>
		<td width='33%'><div align=center>
		<input name=msmallpic[] type=text id='msmallpic<?=$mppathi?>' size=28 ondblclick="SpOpenChFile(1,'msmallpic<?=$mppathi?>');">
		<br><input type=file name=msmallpfile[] size=15>
		</div></td>
		<td width='30%'><div align=center>
		<input name=mbigpic[] type=text id='mbigpic<?=$mppathi?>' size=28 ondblclick="SpOpenChFile(1,'mbigpic<?=$mppathi?>');">
		<br><input type=file name=mbigpfile[] size=15>
		</div></td>
		<td width='30%'><div align=center>
		<input name=mpicname[] type=text id='mpicname<?=$mppathi?>'>
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
	$morepicpath="";
	$morepicnum=0;
	if($r[morepic])
    	{
    		$r[morepic]=stripSlashes($r[morepic]);
    		//�a�}
    		$j=0;
    		$pd_record=explode("\r\n",$r[morepic]);
    		for($i=0;$i<count($pd_record);$i++)
    		{
			$j=$i+1;
    			$pd_field=explode("::::::",$pd_record[$i]);
			$morepicpath.="<tr> 
    <td width='7%'><div align=center>".$j."</div></td>
    <td width='33%'><div align=center>
        <input name=msmallpic[] type=text value='".$pd_field[0]."' size=28 id=msmallpic".$j." ondblclick=\"SpOpenChFile(1,'msmallpic".$j."');\">
		<br><input type=file name=msmallpfile[] size=15>
      </div></td>
    <td width='30%'><div align=center>
        <input name=mbigpic[] type=text value='".$pd_field[1]."' size=28 id=mbigpic".$j." ondblclick=\"SpOpenChFile(1,'mbigpic".$j."');\">
		<br><input type=file name=mbigpfile[] size=15>
      </div></td>
    <td width='30%'><div align=center>
        <input name=mpicname[] type=text value='".$pd_field[2]."'><input type=hidden name=mpicid[] value=".$j."><input type=checkbox name=mdelpicid[] value=".$j.">�R
      </div></td>
  </tr>";
    		}
    		$morepicnum=$j;
    		$morepicpath="<table width='100%' border=0 cellspacing=1 cellpadding=3>".$morepicpath."</table>";
    	}
	echo $morepicpath;
    }
    ?>
    </td>
  </tr>
  <tr> 
    <td height="25">�a�}�X�i�ƶq: <input name="morepicnum" type="hidden" id="morepicnum" value="<?=$morepicnum?>">
      <input name="downmorepicnum" type="text" value="1" size="6"> <input type="button" name="Submit5" value="��X�a�}" onclick="javascript:dopicadd();"></td>
  </tr>
  <tr> 
    <td id=addpicdown></td>
  </tr>
</table>
</td></tr><tr><td bgcolor=ffffff>�C����ܱ���</td><td bgcolor=ffffff><input name="num" type="text" id="num" value="<?=$ecmsfirstpost==1?"3":ehtmlspecialchars(stripSlashes($r[num]))?>" size="">
</td></tr><tr><td bgcolor=ffffff>�Y�ϼe��</td><td bgcolor=ffffff><input name="width" type="text" id="width" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[width]))?>" size="6">
</td></tr><tr><td bgcolor=ffffff>�Y�ϰ���</td><td bgcolor=ffffff><input name="height" type="text" id="height" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[height]))?>" size="6">
</td></tr><tr><td bgcolor=ffffff>�Ϥ�²��</td><td bgcolor=ffffff><textarea name="picsay" cols="80" rows="10" id="picsay"><?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[picsay]))?></textarea>
</td></tr>