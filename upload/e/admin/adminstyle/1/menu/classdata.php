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
<title>���</title>
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
			<td><b>��غ޲z</b></td>
	</tr>
</table>

<table border='0' cellspacing='0' cellpadding='0'>
  <tr> 
    <td id="prcinfo" class="menu1" onclick="chengstate('cinfo')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�H�������޲z</a>
	</td>
  </tr>
  <tr id="itemcinfo" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../ListAllInfo.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�H��</a>
          </td>
        </tr>
        <tr> 
          <td class="file">
			<a href="../../ListAllInfo.php?ecmscheck=1<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�f�֫H��</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../workflow/ListWfInfo.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">ñ�o�H��</a>
          </td>
        </tr>
		<?php
		if($r[dopl])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../openpage/AdminPage.php?leftfile=<?=urlencode('../pl/PlNav.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../pl/PlMain.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�޲z����')?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z����</a>
          </td>
        </tr>
		<?php
		}
		?>
		<tr> 
          <td class="file">
			<a href="../../sp/UpdateSp.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��s�H��</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../special/UpdateZt.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��s�M�D</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../info/InfoMain.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�ƾڲέp</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../infotop.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�Ʀ�έp</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>

<?php
if($r[doclass]||$r[dosetmclass]||$r[doclassf])
{
?>
  <tr> 
    <td id="prclassdata" class="menu1" onclick="chengstate('classdata')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��غ޲z</a>
	</td>
  </tr>
  <tr id="itemclassdata" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[doclass])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../ListClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z���</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../ListPageClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z���(����)</a>
          </td>
        </tr>
		<?php
		}
		if($r[doclassf])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../info/ListClassF.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��ئ۩w�q�r�q</a>
          </td>
        </tr>
		<?php
		}
		if($r[dosetmclass])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../SetMoreClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��q�]�m����ݩ�</a>
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
if($r[dozt]||$r[doztf])
{
?>
  <tr> 
    <td id="przt" class="menu1" onclick="chengstate('zt')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�M�D�޲z</a>
	</td>
  </tr>
  <tr id="itemzt" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dozt])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../special/ListZtClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�M�D����</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../special/ListZt.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�M�D</a>
          </td>
        </tr>
		<?php
		}
		if($r[doztf])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../special/ListZtF.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�M�D�۩w�q�r�q</a>
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
if($r[doinfotype])
{
?>
  <tr> 
    <td id="prinfotype" class="menu1" onclick="chengstate('infotype')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">���D�����޲z</a>
	</td>
  </tr>
  <tr id="iteminfotype" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../info/AddInfoType.php?enews=AddInfoType<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�W�[���D����</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../info/InfoType.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z���D����</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dosp])
{
?>
  <tr> 
    <td id="prsp" class="menu1" onclick="chengstate('sp')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�H���޲z</a>
	</td>
  </tr>
  <tr id="itemsp" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../sp/ListSpClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�H������</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../sp/ListSp.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�H��</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[douserpage])
{
?>
  <tr> 
    <td id="pruserpage" class="menu1" onclick="chengstate('userpage')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�۩w�q����</a>
	</td>
  </tr>
  <tr id="itemuserpage" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../template/PageClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�۩w�q��������</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/AddPage.php?enews=AddUserpage<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�W�[�۩w�q����</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../template/ListPage.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�۩w�q����</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[douserlist])
{
?>
  <tr> 
    <td id="pruserlist" class="menu1" onclick="chengstate('userlist')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�۩w�q�C��</a>
	</td>
  </tr>
  <tr id="itemuserlist" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../other/UserlistClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�۩w�q�C�����</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../other/AddUserlist.php?enews=AddUserlist<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�W�[�۩w�q�C��</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../other/ListUserlist.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�۩w�q�C��</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[douserjs])
{
?>
  <tr> 
    <td id="pruserjs" class="menu1" onclick="chengstate('userjs')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�۩w�qJS</a>
	</td>
  </tr>
  <tr id="itemuserjs" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../other/UserjsClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�۩w�qJS����</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../other/AddUserjs.php?enews=AddUserjs<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�W�[�۩w�qJS</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../other/ListUserjs.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�۩w�qJS</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dotags])
{
?>
  <tr> 
    <td id="prtags" class="menu1" onclick="chengstate('tags')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">TAGS�޲z</a>
	</td>
  </tr>
  <tr id="itemtags" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../tags/SetTags.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�]�mTAGS�Ѽ�</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../tags/TagsClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲zTAGS����</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../tags/ListTags.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲zTAGS</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dofile])
{
?>
  <tr> 
    <td id="prfile" class="menu1" onclick="chengstate('file')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">����޲z</a>
	</td>
  </tr>
  <tr id="itemfile" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file1">
			<a href="../../openpage/AdminPage.php?leftfile=<?=urlencode('../file/FileNav.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�޲z����')?><?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z����</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[docj])
{
?>
  <tr> 
    <td id="prcj" class="menu1" onclick="chengstate('cj')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�Ķ��޲z</a>
	</td>
  </tr>
  <tr id="itemcj" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../AddInfoC.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�W�[�Ķ��`�I</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../ListInfoClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�Ķ��`�I</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../ListPageInfoClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�Ķ��`�I(����)</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dosearchall])
{
?>
  <tr> 
    <td id="prsearchall" class="menu1" onclick="chengstate('searchall')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��������j��</a>
	</td>
  </tr>
  <tr id="itemsearchall" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file">
			<a href="../../searchall/SetSearchAll.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�����j���]�m</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../searchall/ListSearchLoadTb.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�j���ƾڷ�</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../searchall/ClearSearchAll.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�M�z�j���ƾ�</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dowap])
{
?>
  <tr> 
    <td id="prwap" class="menu1" onclick="chengstate('wap')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">WAP�޲z</a>
	</td>
  </tr>
  <tr id="itemwap" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../other/SetWap.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">WAP�]�m</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../other/WapStyle.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲zWAP�ҪO</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[domovenews]||$r[doinfodoc]||$r[dodelinfodata]||$r[dorepnewstext]||$r[dototaldata]||$r[dosearchkey]||$r[dovotemod])
{
?>
  <tr> 
    <td id="prcother" class="menu3" onclick="chengstate('cother')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��L����</a>
	</td>
  </tr>
  <tr id="itemcother" style="display:none"> 
    <td class="list1">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dototaldata])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../TotalData.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�έp�H���ƾ�</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../user/UserTotal.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�Τ�o�G�έp</a>
          </td>
        </tr>
		<?php
		}
		if($r[dosearchkey])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../SearchKey.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�j������r</a>
          </td>
        </tr>
		<?php
		}
		if($r[dorepnewstext])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../db/RepNewstext.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��q�����r�q��</a>
          </td>
        </tr>
		<?php
		}
		if($r[domovenews])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../MoveClassNews.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��q�ಾ�H��</a>
          </td>
        </tr>
		<?php
		}
		if($r[doinfodoc])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../InfoDoc.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�H����q�k��</a>
          </td>
        </tr>
		<?php
		}
		if($r[dodelinfodata])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../db/DelData.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��q�R���H��</a>
          </td>
        </tr>
		<?php
		}
		if($r[dovotemod])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../other/ListVoteMod.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�w�]�벼</a>
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