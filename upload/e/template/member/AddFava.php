<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�W�[���ç�';
$url="<a href=../../../../>����</a>&nbsp;>&nbsp;<a href=../../cp/>�|������</a>&nbsp;>&nbsp;<a href=../../fava/>���ç�</a>&nbsp;>&nbsp;�W�[���ç�";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
        <table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form name="form1" method="POST" action="../../doaction.php">
            <tr class="header"> 
              <td height="25"><div align="center"> 
                  <input name="enews" type="hidden" id="enews" value="AddFava">
                  �W�[���ç� 
                  <input name="from" type="hidden" id="from2" value="<?=$from?>">
                  <input name="classid" type="hidden" id="classid2" value="<?=$classid?>">
                  <input name="id" type="hidden" id="id2" value="<?=$id?>">
                  [<a href="../FavaClass/" target="_blank">�W�[���ä���</a>] </div></td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF"><div align="center">���í����G<a href='<?=$titleurl?>' target=_blank><?=stripSlashes($r[title])?></a></div></td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF"><div align="center">��ܦ��ä���: 
                  <select name="cid" id="select">
                    <option value="0">���]�m</option>
                    <?=$select?>
                  </select>
                </div></td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                  <input type="submit" name="Submit" value="����">
                  &nbsp;&nbsp; 
                  <input type="button" name="Submit2" value="��^" onclick="javascript:history.go(-1)">
                </div></td>
            </tr>
          </form>
        </table>
        <br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>