<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>���D���h�G</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--title--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_title]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_title]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_title]" type="text" id="add[z_title]" value="<?=stripSlashes($r[z_title])?>">
            (�p��g�o�̡A�N���r�q����)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>�o�G�ɶ����h�G</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--newstime--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_newstime]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_newstime]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_newstime]" type="text" id="add[z_newstime]" value="<?=stripSlashes($r[z_newstime])?>">
            (�p��g�o�̡A�N���r�q����)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>�H�����e���h�G</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--smalltext--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_smalltext]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_smalltext]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_smalltext]" type="text" id="add[z_smalltext]" value="<?=stripSlashes($r[z_smalltext])?>">
            (�p��g�o�̡A�N���r�q����)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>�Ϥ����h�G</strong><br>
      ( 
      <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">
      )</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td>����e�� 
        <input name="add[qz_titlepic]" type="text" id="add[qz_titlepic]" value="<?=stripSlashes($r[qz_titlepic])?>"> 
        <input name="add[save_titlepic]" type="checkbox" id="add[save_titlepic]" value=" checked"<?=$r[save_titlepic]?>>
        ���{�O�s </td>
    </tr>
    <tr> 
      <td><textarea name="add[zz_titlepic]" cols="60" rows="10" id="add[zz_titlepic]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepic]))?></textarea></td>
    </tr>
    <tr> 
      <td><input name="add[z_titlepic]" type="text" id="titlepic5" value="<?=stripSlashes($r[z_titlepic])?>">
        (�p��g�o�̡A�o�N�O�r�q����)</td>
    </tr>
  </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>�Ҧb�a���h�G</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--myarea--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_myarea]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_myarea]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_myarea]" type="text" id="add[z_myarea]" value="<?=stripSlashes($r[z_myarea])?>">
            (�p��g�o�̡A�N���r�q����)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>�pô�l�c���h�G</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--email--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_email]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_email]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_email]" type="text" id="add[z_email]" value="<?=stripSlashes($r[z_email])?>">
            (�p��g�o�̡A�N���r�q����)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>�pô�覡���h�G</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--mycontact--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_mycontact]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_mycontact]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_mycontact]" type="text" id="add[z_mycontact]" value="<?=stripSlashes($r[z_mycontact])?>">
            (�p��g�o�̡A�N���r�q����)</td>
        </tr>
      </table></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="22" valign="top"><strong>�pô�a�}���h�G</strong><br>
      (<input name="textfield" type="text" id="textfield" value="[!--address--]" size="20">)</td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><textarea name="add[zz_address]" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[zz_address]))?></textarea></td>
        </tr>
        <tr> 
          <td><input name="add[z_address]" type="text" id="add[z_address]" value="<?=stripSlashes($r[z_address])?>">
            (�p��g�o�̡A�N���r�q����)</td>
        </tr>
      </table></td>
  </tr>
