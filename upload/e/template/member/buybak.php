<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�I�d�R�ȰO��';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../cp/>�|������</a>&nbsp;>&nbsp;�I�d�R�ȰO��";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <tr class="header"> 
            <td width="12%"><div align="center">����</div></td>
            <td width="36%" height="25"><div align="center">�R�ȥd��</div></td>
            <td width="10%" height="25"><div align="center">�R�Ȫ��B</div></td>
            <td width="10%" height="25"><div align="center">�ʶR�I��</div></td>
			<td width="10%"><div align="center">���Ĵ�</div></td>
            <td width="22%" height="25"><div align="center">�ʶR�ɶ�</div></td>
          </tr>
		<?php
		while($r=$empire->fetch($sql))
		{
			//����
			if($r['type']==0)
			{
				$type='�I�d�R��';
			}
			elseif($r['type']==1)
			{
				$type='�b�u�R��';
			}
			elseif($r['type']==2)
			{
				$type='�R���I��';
			}
			elseif($r['type']==3)
			{
				$type='�R�Ȫ��B';
			}
			else
			{
				$type='';
			}
		?>
          <tr bgcolor="#FFFFFF">
			<td><div align="center">
			<?=$type?>
			</div></td>
            <td height="25"><div align="center"> 
                <?=$r[card_no]?>
              </div></td>
            <td height="25"><div align="center"> 
                <?=$r[money]?>
              </div></td>
            <td height="25"><div align="center"> 
                <?=$r[cardfen]?>
              </div></td>
			<td><div align="center"><?=$r[userdate]?></div></td>
            <td height="25"><div align="center"> 
                <?=$r[buytime]?>
              </div></td>
          </tr>
        <?php
		}
		?>
          <tr bgcolor="#FFFFFF"> 
            <td height="25" colspan="6"> 
              <?=$returnpage?>            </td>
          </tr>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>