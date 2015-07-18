<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>菜單</title>
<link href="../../../data/menu/menu.css" rel="stylesheet" type="text/css">
<script src="../../../data/menu/menu.js" type="text/javascript"></script>
<SCRIPT lanuage="JScript">
function tourl(url){
	parent.main.location.href=url;
}
</SCRIPT>
</head>
<body onLoad="initialize()">
<table border='0' cellspacing='0' cellpadding='0'>
	<tr height=20>
			<td id="home"><img src="../../../data/images/homepage.gif" border=0></td>
			<td><b>用戶面板</b></td>
	</tr>
</table>

<table border='0' cellspacing='0' cellpadding='0'>
  <tr> 
    <td id="pruser" class="menu1" onclick="chengstate('user')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">用戶管理</a>
	</td>
  </tr>
  <tr id="itemuser" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../user/EditPassword.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">修改個人資料</a>
          </td>
        </tr>
		<?php
		if($r[dogroup])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../user/ListGroup.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理用戶組</a>
          </td>
        </tr>
		<?php
		}
		if($r[douserclass])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../user/UserClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理部門</a>
          </td>
        </tr>
		<?php
		}
		if($r[douser])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../user/ListUser.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理用戶</a>
          </td>
        </tr>
		<?php
		}
		if($r[dolog])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../user/ListLog.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理登陸日誌</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../user/ListDolog.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理操作日誌</a>
          </td>
        </tr>
		<?php
		}
		if($r[doadminstyle])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../template/AdminStyle.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理後颱風格</a>
          </td>
        </tr>
		<?php
		}
		?>
      </table>
	</td>
  </tr>

<?php
if($r[domember]||$r[domemberf])
{
?>
  <tr> 
    <td id="prmember" class="menu1" onclick="chengstate('member')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">會員管理</a>
	</td>
  </tr>
  <tr id="itemmember" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[domember])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../member/ListMemberGroup.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理會員組</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../member/ListMember.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理會員</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../member/ClearMember.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量清理會員</a>
          </td>
        </tr>
		<?php
		}
		if($r[domemberf])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../member/ListMemberF.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理會員字段</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../member/ListMemberForm.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理會員表單</a>
          </td>
        </tr>
		<?php
		}
		?>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dospacestyle]||$r[dospacedata])
{
?>
  <tr> 
    <td id="prmemberspace" class="menu1" onclick="chengstate('memberspace')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">會員空間管理</a>
	</td>
  </tr>
  <tr id="itemmemberspace" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dospacestyle])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../member/ListSpaceStyle.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理空間模板</a>
          </td>
        </tr>
		<?php
		}
		if($r[dospacedata])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../member/MemberGbook.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理空間留言</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../member/MemberFeedback.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理空間反饋</a>
          </td>
        </tr>
		<?php
		}
		?>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[domemberconnect])
{
?>
  <tr> 
    <td id="prmemberconnect" class="menu1" onclick="chengstate('memberconnect')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">外部接口</a>
	</td>
  </tr>
  <tr id="itemmemberconnect" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file1">
			<a href="../../member/MemberConnect.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理外部登錄接口</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[docard]||$r[dosendemail]||$r[domsg]||$r[dobuygroup])
{
?>
  <tr> 
    <td id="prmother" class="menu3" onclick="chengstate('mother')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">其他功能</a>
	</td>
  </tr>
  <tr id="itemmother" style="display:none"> 
    <td class="list1">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dobuygroup])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../member/ListBuyGroup.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理充值類型</a>
          </td>
        </tr>
		<?php
		}
		if($r[docard])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../member/ListCard.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理點卡</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../member/GetFen.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量贈送點數</a>
          </td>
        </tr>
		<?php
		}
		if($r[dosendemail])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../member/SendEmail.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量發送郵件</a>
          </td>
        </tr>
		<?php
		}
		if($r[domsg])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../member/SendMsg.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量發送短消息</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../member/DelMoreMsg.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量刪除短消息</a>
          </td>
        </tr>
		<?php
		}
		?>
      </table>
	</td>
  </tr>
<?php
}
?>
</table>
</body>
</html>