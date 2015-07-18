<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>影片名正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>發佈時間正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>影片縮略圖正則：</strong><br>
      ( 
      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">
      )</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td>附件前綴 
        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> 
        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>
        遠程保存 </td>
    </tr>
    <tr> 
      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>
    </tr>
    <tr> 
      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">
        (如填寫這裡，這就是字段的值)</td>
    </tr>
  </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>影片類型正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--movietype--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_movietype]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_movietype]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_movietype]" type="text" id="add[z_movietype]" value="<?=stripSlashes($r[z_movietype])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>出品公司正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--company--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_company]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_company]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_company]" type="text" id="add[z_company]" value="<?=stripSlashes($r[z_company])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>出品時間正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--movietime--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_movietime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_movietime]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_movietime]" type="text" id="add[z_movietime]" value="<?=stripSlashes($r[z_movietime])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>主演正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--player--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_player]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_player]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_player]" type="text" id="add[z_player]" value="<?=stripSlashes($r[z_player])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>導演正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--playadmin--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_playadmin]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_playadmin]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_playadmin]" type="text" id="add[z_playadmin]" value="<?=stripSlashes($r[z_playadmin])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>影片格式正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--filetype--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_filetype]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_filetype]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_filetype]" type="text" id="add[z_filetype]" value="<?=stripSlashes($r[z_filetype])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>影片大小正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--filesize--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_filesize]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_filesize]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_filesize]" type="text" id="add[z_filesize]" value="<?=stripSlashes($r[z_filesize])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>推薦等級正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--star--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_star]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_star]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_star]" type="text" id="add[z_star]" value="<?=stripSlashes($r[z_star])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>帶寬要求正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--playdk--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_playdk]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_playdk]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_playdk]" type="text" id="add[z_playdk]" value="<?=stripSlashes($r[z_playdk])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>片長正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--playtime--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_playtime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_playtime]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_playtime]" type="text" id="add[z_playtime]" value="<?=stripSlashes($r[z_playtime])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>扣除點數正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--moviefen--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_moviefen]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_moviefen]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_moviefen]" type="text" id="add[z_moviefen]" value="<?=stripSlashes($r[z_moviefen])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>下載地址正則：</strong><br>
      (
      <input name="textfield" type="text" id="textfield" value="[!--ecmsdownpathurl--]" size="20">
      <br>
      <input name="textfield2" type="text" id="textfield2" value="[!--ecmsdownpathname--]" size="20">
      )<br>
      格式:地址正則(url)[!empirecms!]名稱正則(name)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_downpath]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_downpath]))?></textarea></td>
        </tr>
        <tr> 
          <td>地址前綴:
<input name="add[qz_downpath]" type="text" id="add[qz_downpath]" value="<?=stripSlashes($r[qz_downpath])?>">
        </td>
        </tr>
      </table></td>
  </tr>

<?php
$player_sql=$empire->query("select id,player from {$dbtbpre}enewsplayer");
while($player_r=$empire->fetch($player_sql))
{
	$select_player='';
	if($r[z_playerid]==$player_r[id])
	{
		$select_player=' selected';
	}
	$player_class.="<option value='".$player_r[id]."'".$select_player.">".$player_r[player]."</option>";
}
?>
  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>播放器：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--playerid--]" size="20">)</td>
    <td><select name="add[z_playerid]"><option value=0>自動識別</option><?=$player_class?></select></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>在線觀看地址正則：</strong><br>
      (
      <input name="textfield" type="text" id="textfield" value="[!--ecmsonlinepathurl--]" size="20">
      <br>
      <input name="textfield2" type="text" id="textfield2" value="[!--ecmsonlinepathname--]" size="20">
      )<br>
      格式:地址正則(url)[!empirecms!]名稱正則(name)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_onlinepath]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_onlinepath]))?></textarea></td>
        </tr>
        <tr> 
          <td>地址前綴:
<input name="add[qz_onlinepath]" type="text" id="add[qz_onlinepath]" value="<?=stripSlashes($r[qz_onlinepath])?>">
        </td>
        </tr>
      </table>
	  </td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>影片簡介正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--moviesay--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_moviesay]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_moviesay]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_moviesay]" type="text" id="add[z_moviesay]" value="<?=stripSlashes($r[z_moviesay])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>
