<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='���U�|��';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../cp/>�|������</a>&nbsp;>&nbsp;��ܵ��U�|������";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="ChRegForm" method="GET" action="index.php">
  <input name="tobind" type="hidden" id="tobind" value="<?=$tobind?>">
    <tr class="header"> 
      <td height="25"><div align="center">��ܵ��U�|������<?=$tobind?' (�j�w�㸹)':''?></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="70%" height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
		<?php
		while($r=$empire->fetch($sql))
		{
			$checked='';
			if($r[groupid]==eReturnMemberDefGroupid())
			{
				$checked=' checked';
			}
		?>
          <tr>
            <td height="23">
			<input type="radio" name="groupid" value="<?=$r[groupid]?>"<?=$checked?>>
              <?=$r[groupname]?>
            </td>
          </tr>
		<?php
		}
		?>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> &nbsp;<input type="submit" name="button" value="�U�@�B"></td>
    </tr>
  </form>
</table>
<br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>