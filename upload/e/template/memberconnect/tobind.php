<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$qappname=$appr['qappname'];

$public_diyr['pagetitle']='�j�w�n��';
$url="��m:<a href='../../'>����</a>&nbsp;>&nbsp;�j�w�n��";
$regurl=$public_r['newsurl'].'e/member/register/?tobind=1';
$loginurl=$public_r['newsurl'].'e/member/login/?tobind=1';
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td height="30" colspan="2"><font color="#FF0000"><strong>�z�n�I�w�q�L<?=$qappname?>���\�n���I</strong></font></td>
  </tr>
  <tr>
    <td width="50%" valign="top"><form name="bindform" method="post" action="doaction.php">
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25"><div align="center"><strong>1�B�p�G�z�w���㸹�A�i�H�I���U���n���j�w</strong></div></td>
        </tr>
        <tr>
          <td height="50"><div align="center">
            <input type="button" name="Submit" value="���W�n���j�w" onclick="window.open('<?=$loginurl?>');">
            <input name="enews" type="hidden" id="enews" value="BindUser">
          </div></td>
          </tr>
        <tr>
          <td height="25"><div align="center">���ܡG���j���\��A�U��
            <?=$qappname?>
            �覡�n���Y�i�����n���쮹�j�᪺�㸹�C</div></td>
          </tr>
      </table>
        </form>
    </td>
    <td width="50%" valign="top"><form name="bindregform" method="post" action="doaction.php">
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25"><div align="center"><strong>2�B�p�G�٨S���㸹�A�z�i�H�ֳt���U</strong></div></td>
          </tr>
        <tr>
          <td height="50"><div align="center">
            <input type="button" name="Submit2" value="���W���U�j�w" onclick="window.open('<?=$regurl?>');">
            <input name="enews" type="hidden" id="enews" value="BindReg">
          </div></td>
          </tr>
        <tr>
          <td height="25"><div align="center">���ܡG���j���\��A�U��
            <?=$qappname?>
            �覡�n���Y�i�����n���쮹�j�᪺�㸹�C</div></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>