<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�o�e����';
$url="<a href=../../../../>����</a>&nbsp;>&nbsp;<a href=../../cp/>�|������</a>&nbsp;>&nbsp;<a href=../../msg/>�����C��</a>&nbsp;>&nbsp;�o�e����";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form action="../../doaction.php" method="post" name="sendmsg" id="sendmsg">
            <tr class="header"> 
              <td height="23" colspan="2">�o�e����</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="21%" height="25">���D</td>
              <td width="79%" height="25"><input name="title" type="text" id="title2" value="<?=ehtmlspecialchars(stripSlashes($title))?>" size="43">
                *</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">������</td>
              <td height="25"><input name="to_username" type="text" id="to_username2" value="<?=$username?>">
                [<a href="#EmpireCMS" onclick="window.open('../../friend/change/?fm=sendmsg&f=to_username','','width=250,height=360');">��ܦn��</a>] 
                *</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25" valign="top">���e</td>
              <td height="25"><textarea name="msgtext" cols="60" rows="12" id="textarea"><?=ehtmlspecialchars(stripSlashes($msgtext))?></textarea>
                *</td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit" value="�o�e">
                &nbsp; 
                <input type="reset" name="Submit2" value="���m"> <input name="enews" type="hidden" id="enews" value="AddMsg">              </td>
            </tr>
          </form>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>