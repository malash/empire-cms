<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�d�ݮ���';
$url="<a href=../../../../>����</a>&nbsp;>&nbsp;<a href=../../cp/>�|������</a>&nbsp;>&nbsp;<a href=../../msg/>�����C��</a>&nbsp;>&nbsp;�d�ݮ���";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form name="form1" method="post" action="../../doaction.php">
            <tr class="header"> 
              <td height="23" colspan="2">
                <?=stripSlashes($r[title])?>              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td width="19%" height="25">�o�e�̡G</td>
              <td width="81%" height="25"><a href="../../ShowInfo/?userid=<?=$r[from_userid]?>"> 
                <?=$r[from_username]?>
                </a></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">�o�e�ɶ��G</td>
              <td height="25">
                <?=$r[msgtime]?>              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25" valign="top">���e�G</td>
              <td height="25"> 
                <?=nl2br(stripSlashes($r[msgtext]))?>              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25" valign="top">&nbsp;</td>
              <td height="25">[<a href="#ecms" onclick="javascript:history.go(-1);"><strong>��^</strong></a>] 
                [<a href="../AddMsg/?enews=AddMsg&re=1&mid=<?=$mid?>"><strong>�^�_</strong></a>] 
                [<a href="../AddMsg/?enews=AddMsg&mid=<?=$mid?>"><strong>��o</strong></a>] 
                [<a href="../../doaction.php?enews=DelMsg&mid=<?=$mid?>" onclick="return confirm('�T�{�n�R��?');"><strong>�R��</strong></a>]</td>
            </tr>
          </form>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>