<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='增加收藏夾';
$url="<a href=../../../../>首頁</a>&nbsp;>&nbsp;<a href=../../cp/>會員中心</a>&nbsp;>&nbsp;<a href=../../fava/>收藏夾</a>&nbsp;>&nbsp;增加收藏夾";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<br>
        <table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form name="form1" method="POST" action="../../doaction.php">
            <tr class="header"> 
              <td height="25"><div align="center"> 
                  <input name="enews" type="hidden" id="enews" value="AddFava">
                  增加收藏夾 
                  <input name="from" type="hidden" id="from2" value="<?=$from?>">
                  <input name="classid" type="hidden" id="classid2" value="<?=$classid?>">
                  <input name="id" type="hidden" id="id2" value="<?=$id?>">
                  [<a href="../FavaClass/" target="_blank">增加收藏分類</a>] </div></td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF"><div align="center">收藏頁面：<a href='<?=$titleurl?>' target=_blank><?=stripSlashes($r[title])?></a></div></td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF"><div align="center">選擇收藏分類: 
                  <select name="cid" id="select">
                    <option value="0">不設置</option>
                    <?=$select?>
                  </select>
                </div></td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                  <input type="submit" name="Submit" value="收藏">
                  &nbsp;&nbsp; 
                  <input type="button" name="Submit2" value="返回" onclick="javascript:history.go(-1)">
                </div></td>
            </tr>
          </form>
        </table>
        <br>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>