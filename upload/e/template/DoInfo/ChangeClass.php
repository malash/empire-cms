<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�W�[�H��';
$url="<a href='../../'>����</a>&nbsp;>&nbsp;<a href='../member/cp/'>�|������</a>&nbsp;>&nbsp;<a href='ListInfo.php?mid=".$mid."'>�޲z�H��</a>&nbsp;>&nbsp;�W�[�H��&nbsp;(".$mr[qmname].")";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script>
function CheckChangeClass()
{
	if(document.changeclass.classid.value==0||document.changeclass.classid.value=='')
	{
		alert("�п�����");
		return false;
	}
	return true;
}
</script>
      <table width="500" border="0" align="center">
        <tr> 
          <td>�A�n�A<b><?=$musername?></b></td>
        </tr>
      </table>
      <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form action="AddInfo.php" method="get" name="changeclass" id="changeclass" onsubmit="return CheckChangeClass();">
          <tr class="header"> 
            <td height="23"><strong>�п�ܭn�W�[�H������� 
                <input name="mid" type="hidden" id="mid" value="<?=$mid?>">
              <input name="enews" type="hidden" id="enews" value="MAddInfo">
              </strong></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32"> <select name=classid size="22" style="width:300px">
                <script src="<?=$classjs?>"></script>
              </select> </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><input type="submit" name="Submit" value="�K�[�H��"> <font color="#666666">(�п�ܲ׷����[�Ŧ��])</font></td>
          </tr>
        </form>
      </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>