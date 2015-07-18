<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$qappname=$appr['qappname'];

$public_diyr['pagetitle']='綁定登錄';
$url="位置:<a href='../../'>首頁</a>&nbsp;>&nbsp;綁定登錄";
$regurl=$public_r['newsurl'].'e/member/register/?tobind=1';
$loginurl=$public_r['newsurl'].'e/member/login/?tobind=1';
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td height="30" colspan="2"><font color="#FF0000"><strong>您好！已通過<?=$qappname?>成功登錄！</strong></font></td>
  </tr>
  <tr>
    <td width="50%" valign="top"><form name="bindform" method="post" action="doaction.php">
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25"><div align="center"><strong>1、如果您已有賬號，可以點擊下面登錄綁定</strong></div></td>
        </tr>
        <tr>
          <td height="50"><div align="center">
            <input type="button" name="Submit" value="馬上登錄綁定" onclick="window.open('<?=$loginurl?>');">
            <input name="enews" type="hidden" id="enews" value="BindUser">
          </div></td>
          </tr>
        <tr>
          <td height="25"><div align="center">提示：捆綁成功後，下次
            <?=$qappname?>
            方式登錄即可直接登錄到捆綁後的賬號。</div></td>
          </tr>
      </table>
        </form>
    </td>
    <td width="50%" valign="top"><form name="bindregform" method="post" action="doaction.php">
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25"><div align="center"><strong>2、如果還沒有賬號，您可以快速註冊</strong></div></td>
          </tr>
        <tr>
          <td height="50"><div align="center">
            <input type="button" name="Submit2" value="馬上註冊綁定" onclick="window.open('<?=$regurl?>');">
            <input name="enews" type="hidden" id="enews" value="BindReg">
          </div></td>
          </tr>
        <tr>
          <td height="25"><div align="center">提示：捆綁成功後，下次
            <?=$qappname?>
            方式登錄即可直接登錄到捆綁後的賬號。</div></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>