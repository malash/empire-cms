<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php

//�t�m�d�ߦ۩w�q�r�q�C��,�r���}�Y�A�h�ӥγr����}�A�榡�uui.�r�q�W�v
$useraddf=',ui.userpic';

//����SQL
$query='select '.eReturnSelectMemberF('userid,username,email,registertime,groupid','u.').$useraddf.' from '.eReturnMemberTable().' u'.$add." order by u.".egetmf('userid')." desc limit $offset,$line";
$sql=$empire->query($query);

//�ɯ�
$public_diyr['pagetitle']='�|���C��';
$url="<a href='../../../'>����</a>&nbsp;>&nbsp;�|���C��";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="memberform" method="get" action="index.php">
    <input type="hidden" name="sear" value="1">
    <input type="hidden" name="groupid" value="<?=$groupid?>">
    <tr class="header"> 
      <td width="10%"><div align="center">ID</div></td>
      <td width="38%" height="25"><div align="center">�Τ�W</div></td>
      <td width="30%" height="25"><div align="center">���U�ɶ�</div></td>
      <td width="22%" height="25"><div align="center"></div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		//���U�ɶ�
		$registertime=eReturnMemberRegtime($r['registertime'],"Y-m-d H:i:s");
		//�Τ��
		$groupname=$level_r[$r['groupid']]['groupname'];
		//�Τ��Y��
		$userpic=$r['userpic']?$r['userpic']:$public_r[newsurl].'e/data/images/nouserpic.gif';
	?>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="center"> 
          <?=$r['userid']?>
        </div></td>
      <td height="25"> <a href='<?=$public_r[newsurl]?>e/space/?userid=<?=$r['userid']?>' target='_blank'> 
        <?=$r['username']?>
        </a> </td>
      <td height="25"><div align="center"> 
          <?=$registertime?>
        </div></td>
      <td height="25"><div align="center"> [<a href="<?=$public_r[newsurl]?>e/member/ShowInfo/?userid=<?=$r['userid']?>" target="_blank">�|�����</a>] 
          [<a href="<?=$public_r[newsurl]?>e/space/?userid=<?=$r['userid']?>" target="_blank">�|���Ŷ�</a>]</div></td>
    </tr>
    <?php
  	}
  	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="3"> 
        <?=$returnpage?>
      </td>
      <td height="25"> <div align="center"> 
          <input name="keyboard" type="text" id="keyboard" size="10">
          <input type="submit" name="Submit" value="�j��">
        </div></td>
    </tr>
  </form>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>