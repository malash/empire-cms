<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='���ç�����';
$url="<a href=../../../../>����</a>&nbsp;>&nbsp;<a href=../../cp/>�|������</a>&nbsp;>&nbsp;<a href=../../fava/>���ç�</a>&nbsp;>&nbsp;�޲z����";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script>
function DelFavaClass(cid)
{
var ok;
ok=confirm("�T�{�n�R��?");
if(ok)
{
self.location.href='../../doaction.php?enews=DelFavaClass&cid='+cid;
}
}
</script>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form name="form1" method="post" action="../../doaction.php">
            <tr class="header"> 
              <td height="25">�W�[���ç�����</td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF">�����W��: 
                <input name="cname" type="text" id="cname"> <input type="submit" name="Submit" value="�W�["> 
              <input name="enews" type="hidden" id="enews" value="AddFavaClass"></td>
            </tr>
          </form>
        </table>
        <br>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <tr class="header"> 
            <td width="10%" height="25"> <div align="center">ID</div></td>
            <td width="56%"><div align="center">�����W��</div></td>
            <td width="34%"><div align="center">�ާ@</div></td>
          </tr>
		<?php
		while($r=$empire->fetch($sql))
		{
		?>
          <form name=form method=post action=../../doaction.php>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="center"> 
                  <?=$r[cid]?>
                </div></td>
              <td><div align="center"> 
                  <input name="enews" type="hidden" id="enews" value="EditFavaClass">
                  <input name="cid" type="hidden" value="<?=$r[cid]?>">
                  <input name="cname" type="text" id="cname" value="<?=$r[cname]?>">
                </div></td>
              <td><div align="center"> 
                  <input type="submit" name="Submit2" value="�ק�">
                  &nbsp; 
                  <input type="button" name="Submit3" value="�R��" onclick="javascript:DelFavaClass(<?=$r[cid]?>);">
                </div></td>
            </tr>
          </form>
		<?php
		}
		?>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>