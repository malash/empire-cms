<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php

//配置查詢自定義字段列表,逗號開頭，多個用逗號格開，格式「ui.字段名」
$useraddf=',ui.userpic';

//分頁SQL
$query='select '.eReturnSelectMemberF('userid,username,email,registertime,groupid','u.').$useraddf.' from '.eReturnMemberTable().' u'.$add." order by u.".egetmf('userid')." desc limit $offset,$line";
$sql=$empire->query($query);

//導航
$public_diyr['pagetitle']='會員列表';
$url="<a href='../../../'>首頁</a>&nbsp;>&nbsp;會員列表";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="memberform" method="get" action="index.php">
    <input type="hidden" name="sear" value="1">
    <input type="hidden" name="groupid" value="<?=$groupid?>">
    <tr class="header"> 
      <td width="10%"><div align="center">ID</div></td>
      <td width="38%" height="25"><div align="center">用戶名</div></td>
      <td width="30%" height="25"><div align="center">註冊時間</div></td>
      <td width="22%" height="25"><div align="center"></div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		//註冊時間
		$registertime=eReturnMemberRegtime($r['registertime'],"Y-m-d H:i:s");
		//用戶組
		$groupname=$level_r[$r['groupid']]['groupname'];
		//用戶頭像
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
      <td height="25"><div align="center"> [<a href="<?=$public_r[newsurl]?>e/member/ShowInfo/?userid=<?=$r['userid']?>" target="_blank">會員資料</a>] 
          [<a href="<?=$public_r[newsurl]?>e/space/?userid=<?=$r['userid']?>" target="_blank">會員空間</a>]</div></td>
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
          <input type="submit" name="Submit" value="搜索">
        </div></td>
    </tr>
  </form>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>