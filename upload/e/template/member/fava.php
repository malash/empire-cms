<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='收藏夾';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;收藏夾";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form name="form1" method="post" action="">
            <tr> 
              <td width="50%" height="30" bgcolor="#FFFFFF">選擇分類: 
                <select name="cid" id="select" onchange=window.location='../fava/?cid='+this.options[this.selectedIndex].value>
                  <option value="0">顯示全部</option>
                  <?=$select?>
                </select></td>
              <td width="50%" bgcolor="#FFFFFF"><div align="right">[<a href="FavaClass/">管理分類</a>]&nbsp;&nbsp;</div></td>
            </tr>
          </form>
</table>
        <br>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
          <form name=favaform method=post action="../doaction.php" onsubmit="return confirm('確認要操作?');">
            <input type=hidden value=DelFava_All name=enews>
            <tr class="header"> 
              <td width="4%" height="25"><div align="center"></div></td>
              <td width="57%"><div align="center">標題</div></td>
              <td width="12%"><div align="center">點擊</div></td>
              <td width="20%"><div align="center">收藏時間</div></td>
              <td width="7%"><div align="center">選擇</div></td>
            </tr>
            <?php
			while($fr=$empire->fetch($sql))
			{
				if(empty($class_r[$fr[classid]][tbname]))
				{continue;}
				$r=$empire->fetch1("select title,isurl,titleurl,onclick,classid,id from {$dbtbpre}ecms_".$class_r[$fr[classid]][tbname]." where id='$fr[id]' limit 1");
				//標題鏈接
				$titlelink=sys_ReturnBqTitleLink($r);
				if(!$r['id'])
				{
					$r['title']="此信息已刪除";
					$titlelink="#EmpireCMS";
				}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="center"><img src="../../data/images/dir.gif" border=0></div></td>
              <td> <div align="left"><a href="<?=$titlelink?>" target=_blank> 
                  <?=stripSlashes($r[title])?>
                  </a></div></td>
              <td> <div align="center"> 
                  <?=$r[onclick]?>
                </div></td>
              <td> <div align="center"> 
                  <?=$fr[favatime]?>
                </div></td>
              <td> <div align="center"> 
                  <input name="favaid[]" type="checkbox" id="favaid[]2" value="<?=$fr[favaid]?>">
                </div></td>
            </tr>
            <?php
			}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td height="25" colspan="5"> &nbsp;&nbsp;&nbsp; 
                <?=$returnpage?>
                &nbsp;&nbsp; <select name="cid">
                  <option value="0">請選擇要轉移的目標分類</option>
                  <?=$select?>
                </select> <input type="submit" name="Submit" value="轉移選中" onclick="document.favaform.enews.value='MoveFava_All'"> 
              &nbsp;&nbsp; <input type="submit" name="Submit" value="刪除選中" onclick="document.favaform.enews.value='DelFava_All'"></td>
            </tr>
          </form>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>