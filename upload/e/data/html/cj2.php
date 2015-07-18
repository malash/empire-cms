<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>軟件名稱正則：</strong><br>
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
    <td height="22" valign="top"><strong>軟件預覽圖正則：</strong><br>
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
    <td height="22" valign="top"><strong>軟件作者正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--softwriter--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_softwriter]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softwriter]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_softwriter]" type="text" id="add[z_softwriter]" value="<?=stripSlashes($r[z_softwriter])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>廠商主頁正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--homepage--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_homepage]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_homepage]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_homepage]" type="text" id="add[z_homepage]" value="<?=stripSlashes($r[z_homepage])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>系統演示正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--demo--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_demo]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_demo]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_demo]" type="text" id="add[z_demo]" value="<?=stripSlashes($r[z_demo])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>運行環境正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--softfj--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_softfj]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softfj]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_softfj]" type="text" id="add[z_softfj]" value="<?=stripSlashes($r[z_softfj])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>軟件語言正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--language--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_language]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_language]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_language]" type="text" id="add[z_language]" value="<?=stripSlashes($r[z_language])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>軟件類型正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--softtype--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_softtype]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softtype]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_softtype]" type="text" id="add[z_softtype]" value="<?=stripSlashes($r[z_softtype])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>授權形式正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--softsq--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_softsq]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softsq]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_softsq]" type="text" id="add[z_softsq]" value="<?=stripSlashes($r[z_softsq])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>軟件評價正則：</strong><br>
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
    <td height="22" valign="top"><strong>文件類型正則：</strong><br>
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
    <td height="22" valign="top"><strong>文件大小正則：</strong><br>
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

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>軟件簡介正則：</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--softsay--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_softsay]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_softsay]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_softsay]" type="text" id="add[z_softsay]" value="<?=stripSlashes($r[z_softsay])?>">
            (如填寫這裡，將為字段的值)</td>
        </tr>
      </table></td>
  </tr>
