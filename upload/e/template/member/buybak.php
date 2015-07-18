<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='點卡充值記錄';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;點卡充值記錄";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <tr class="header"> 
            <td width="12%"><div align="center">類型</div></td>
            <td width="36%" height="25"><div align="center">充值卡號</div></td>
            <td width="10%" height="25"><div align="center">充值金額</div></td>
            <td width="10%" height="25"><div align="center">購買點數</div></td>
			<td width="10%"><div align="center">有效期</div></td>
            <td width="22%" height="25"><div align="center">購買時間</div></td>
          </tr>
		<?php
		while($r=$empire->fetch($sql))
		{
			//類型
			if($r['type']==0)
			{
				$type='點卡充值';
			}
			elseif($r['type']==1)
			{
				$type='在線充值';
			}
			elseif($r['type']==2)
			{
				$type='充值點數';
			}
			elseif($r['type']==3)
			{
				$type='充值金額';
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