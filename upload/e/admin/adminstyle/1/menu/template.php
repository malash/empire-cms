<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
//模板組
$gid=(int)$_GET['gid'];
if(!$gid)
{
	if($ecms_config['sets']['deftempid'])
	{
		$gid=$ecms_config['sets']['deftempid'];
	}
	elseif($public_r['deftempid'])
	{
		$gid=$public_r['deftempid'];
	}
	else
	{
		$gid=1;
	}
}
$tempgroup="";
$tgname="";
$tgsql=$empire->query("select gid,gname,isdefault from {$dbtbpre}enewstempgroup order by gid");
while($tgr=$empire->fetch($tgsql))
{
	$tgselect="";
	if($tgr['gid']==$gid)
	{
		$tgname=$tgr['gname'];
		$tgselect=" selected";
	}
	$tempgroup.="<option value='".$tgr['gid']."'".$tgselect.">".$tgr['gname']."</option>";
}
if(empty($tgname))
{
	printerror("ErrorUrl","");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<table border='0' cellspacing='0' cellpadding='0' align='center' width='100%'>
  <tr>
    <td>
	<select name="selecttempgroup" onchange="self.location.href='left.php?<?=$ecms_hashur['ehref']?>&ecms=template&gid='+this.options[this.selectedIndex].value">
	<?=$tempgroup?>
	</select>
	</td>
  </tr>
  </table>

<table border='0' cellspacing='0' cellpadding='0' align='center' width='100%'>
  <tr>
    <td height="20"><img src="images/noadd.gif" width="20" height="9"><a href="#empirecms" onclick="window.open('../../template/EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=600,scrollbars=yes,resizable=yes');">查看標籤語法</a> 
    </td>
  </tr>
  <tr>
    <td height="20"><img src="images/noadd.gif" width="20" height="9"><a href="#empirecms" onclick="window.open('../../template/MakeBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=600,scrollbars=yes,resizable=yes');">自動生成標籤</a> 
    </td>
  </tr>
  </table>
<?php
if($ecms_config['esafe']['openeditdttemp']&&$r[dodttemp])
{
?>
<table border='0' cellspacing='0' cellpadding='0' align='center' width='100%'>
  <tr>
    <td height="20"><img src="images/noadd.gif" width="20" height="9"><a href="#empirecms" onclick="window.open('../../openpage/AdminPage.php?leftfile=<?=urlencode('../template/dttemppageleft.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('動態頁面模板管理')?><?=$ecms_hashur['ehref']?>','dttemppage','');">動態頁面模板管理</a> 
    </td>
  </tr>
  </table>
<?php
}
?>

<table border='0' cellspacing='0' cellpadding='0'>
	<tr height=20>
			<td id="home"><img src="../../../data/images/homepage.gif" border=0></td>
			<td><b>模板管理</b></td>
	</tr>
</table>

<table border='0' cellspacing='0' cellpadding='0'>
<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prindextemp" class="menu1" onclick="chengstate('indextemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">首頁模板</a>
	</td>
  </tr>
  <tr id="itemindextemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=indextemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">首頁模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListIndexpage.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理首頁方案</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prclasstemp" class="menu1" onclick="chengstate('classtemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">封面模板</a>
	</td>
  </tr>
  <tr id="itemclasstemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/ClassTempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理封面模板分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListClasstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理封面模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prlisttemp" class="menu1" onclick="chengstate('listtemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">列表模板</a>
	</td>
  </tr>
  <tr id="itemlisttemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/ListtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理列表模板分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListListtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理列表模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prnewstemp" class="menu1" onclick="chengstate('newstemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">內容模板</a>
	</td>
  </tr>
  <tr id="itemnewstemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/NewstempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理內容模板分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListNewstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理內容模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prsearchtemp" class="menu1" onclick="chengstate('searchtemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">搜索模板</a>
	</td>
  </tr>
  <tr id="itemsearchtemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../template/SearchtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理搜索模板分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListSearchtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理搜索模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prbqtemp" class="menu1" onclick="chengstate('bqtemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">標籤模板</a>
	</td>
  </tr>
  <tr id="itembqtemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/BqtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理標籤模板分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListBqtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理標籤模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotempvar])
{
?>
  <tr> 
    <td id="prtempvar" class="menu1" onclick="chengstate('tempvar')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">公共模板變量</a>
	</td>
  </tr>
  <tr id="itemtempvar" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/TempvarClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理模板變量分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListTempvar.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理模板變量</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prpubtemp" class="menu1" onclick="chengstate('pubtemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">公共模板</a>
	</td>
  </tr>
  <tr id="itempubtemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=cptemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">控制面板模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=schalltemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">全站搜索模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=searchformtemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">高級搜索表單模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=searchformjs&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">橫向搜索JS模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=searchformjs1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">縱向搜索JS模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=otherlinktemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">相關信息模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=gbooktemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">留言板模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=pljstemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">評論JS調用模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=downpagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">最終下載頁模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=downsofttemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">下載地址模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=onlinemovietemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">在線播放地址模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=listpagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">列表分頁模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/EditPublicTemp.php?tname=loginiframe&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">登陸狀態模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/EditPublicTemp.php?tname=loginjstemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">JS調用登陸模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prjstemp" class="menu1" onclick="chengstate('jstemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">JS模板</a>
	</td>
  </tr>
  <tr id="itemjstemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../template/JsTempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理JS模板分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListJstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理JS模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prpltemp" class="menu1" onclick="chengstate('pltemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">評論列表模板</a>
	</td>
  </tr>
  <tr id="itempltemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../template/AddPltemp.php?enews=AddPlTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">增加評論模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListPltemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理評論模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prprinttemp" class="menu1" onclick="chengstate('printtemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">打印模板</a>
	</td>
  </tr>
  <tr id="itemprinttemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../template/AddPrinttemp.php?enews=AddPrintTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">增加打印模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListPrinttemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理打印模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="pruserpagetemp" class="menu1" onclick="chengstate('userpagetemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">自定義頁面模板</a>
	</td>
  </tr>
  <tr id="itemuserpagetemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/AddPagetemp.php?enews=AddPagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">增加自定義頁面模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListPagetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理自定義頁面模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prvotetemp" class="menu1" onclick="chengstate('votetemp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">投票模板</a>
	</td>
  </tr>
  <tr id="itemvotetemp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../template/AddVotetemp.php?enews=AddVoteTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">增加投票模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListVotetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理投票模板</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dobq])
{
?>
  <tr> 
    <td id="prbq" class="menu1" onclick="chengstate('bq')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">標籤</a>
	</td>
  </tr>
  <tr id="itembq" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../template/BqClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理標籤分類</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/ListBq.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">管理標籤</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotempgroup])
{
?>
  <tr> 
    <td id="prtempgroup" class="menu1" onclick="chengstate('tempgroup')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">模板組管理</a>
	</td>
  </tr>
  <tr id="itemtempgroup" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file1">
			<a href="../../template/TempGroup.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">導入/導出模板組</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotemplate])
{
?>
  <tr> 
    <td id="prtother" class="menu3" onclick="chengstate('tother')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">其他相關</a>
	</td>
  </tr>
  <tr id="itemtother" style="display:none"> 
    <td class="list1">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/LoadTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量導入欄目模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/ChangeListTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量更換列表模板</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../template/RepTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">批量替換模板字符</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>
</table>
</body>
</html>