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
			<td><b>插件管理</b></td>
	</tr>
</table>

<table border='0' cellspacing='0' cellpadding='0'>
<?php
if($r[doad])
{
?>
  <tr> 
    <td id="prad" class="menu1" onclick="chengstate('ad')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">廣告系統</a>
	</td>
  </tr>
  <tr id="itemad" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../tool/AdClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理廣告分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../tool/ListAd.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理廣告</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dovote])
{
?>
  <tr> 
    <td id="prvote" class="menu1" onclick="chengstate('vote')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">投票系統</a>
	</td>
  </tr>
  <tr id="itemvote" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../tool/AddVote.php?enews=AddVote<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">增加投票</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../tool/ListVote.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理投票</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dolink])
{
?>
  <tr> 
    <td id="prlink" class="menu1" onclick="chengstate('link')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">友情鏈接管理</a>
	</td>
  </tr>
  <tr id="itemlink" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../tool/LinkClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理友情鏈接分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../tool/ListLink.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理友情鏈接</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dogbook])
{
?>
  <tr> 
    <td id="prgbook" class="menu1" onclick="chengstate('gbook')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">留言板管理</a>
	</td>
  </tr>
  <tr id="itemgbook" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../tool/GbookClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理留言分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../tool/gbook.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理留言</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../tool/DelMoreGbook.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量刪除留言</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dofeedback]||$r[dofeedbackf])
{
?>
  <tr> 
    <td id="prfeedback" class="menu1" onclick="chengstate('feedback')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">信息反饋管理</a>
	</td>
  </tr>
  <tr id="itemfeedback" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dofeedbackf])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../tool/FeedbackClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理反饋分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../tool/ListFeedbackF.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理反饋字段</a>
          </td>
        </tr>
		<?php
		}
		if($r[dofeedback])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../tool/feedback.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理信息反饋</a>
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
if($r[donotcj])
{
?>
  <tr> 
    <td id="prnotcj" class="menu3" onclick="chengstate('notcj')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">防採集插件</a>
	</td>
  </tr>
  <tr id="itemnotcj" style="display:none"> 
    <td class="list1">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file1">
			<a href="../../template/NotCj.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理防採集隨機字符</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
$b=0;
//自定義插件菜單
$menucsql=$empire->query("select classid,classname from {$dbtbpre}enewsmenuclass where classtype=2 and (groupids='' or groupids like '%,".intval($lur[groupid]).",%') order by myorder,classid");
while($menucr=$empire->fetch($menucsql))
{
	$menujsvar='diymenu'.$menucr['classid'];
	$b=1;
?>
  <tr> 
    <td id="pr<?=$menujsvar?>" class="menu1" onclick="chengstate('<?=$menujsvar?>')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'"><?=$menucr['classname']?></a>
	</td>
  </tr>
  <tr id="item<?=$menujsvar?>" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		$menusql=$empire->query("select menuid,menuname,menuurl,addhash from {$dbtbpre}enewsmenu where classid='$menucr[classid]' order by myorder,menuid");
		while($menur=$empire->fetch($menusql))
		{
			if(!(strstr($menur['menuurl'],'://')||substr($menur['menuurl'],0,1)=='/'))
			{
				$menur['menuurl']='../../'.$menur['menuurl'];
			}
			$menu_ecmshash='';
			if($menur['addhash'])
			{
				if(strstr($menur['menuurl'],'?'))
				{
					$menu_ecmshash=$menur['addhash']==2?$ecms_hashur['href']:$ecms_hashur['ehref'];
				}
				else
				{
					$menu_ecmshash=$menur['addhash']==2?$ecms_hashur['whhref']:$ecms_hashur['whehref'];
				}
				$menur['menuurl'].=$menu_ecmshash;
			}
		?>
        <tr> 
          <td class="file">
			<a href="<?=$menur['menuurl']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'"><?=$menur['menuname']?></a>
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