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
			<td><b>�t�γ]�m</b></td>
	</tr>
</table>

<table border='0' cellspacing='0' cellpadding='0'>
<?php
if($r[dopublic]||$r[dofirewall]||$r[dosetsafe]||$r[dopubvar])
{
?>
  <tr> 
    <td id="prsetting" class="menu1" onclick="chengstate('setting')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�t�γ]�m</a>
	</td>
  </tr>
  <tr id="itemsetting" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dopublic])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../SetEnews.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�t�ΰѼƳ]�m</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../pub/SetRewrite.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">���R�A�ѼƳ]�m</a>
          </td>
        </tr>
		<?php
		}
		if($r[dopubvar])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../pub/ListPubVar.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�X�i�ܶq</a>
          </td>
        </tr>
		<?php
		}
		if($r[dosetsafe])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../pub/SetSafe.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�w���Ѽưt�m</a>
          </td>
        </tr>
		<?php
		}
		if($r[dofirewall])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../pub/SetFirewall.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">����������</a>
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
if($r[dochangedata]||$r[dopostdata])
{
?>
  <tr> 
    <td id="prchangedata" class="menu1" onclick="chengstate('changedata')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�ƾڧ�s</a>
	</td>
  </tr>
  <tr id="itemchangedata" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dochangedata])
		{
		?>
		<tr> 
          <td class="file">
			<a href="../../ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�ƾڧ�s����</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../ReHtml/ReInfoUrl.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��s�H�����a�}</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../ReHtml/DoUpdateData.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�ƾھ�z</a>
          </td>
        </tr>
		<?php
		}
		if($r[dopostdata])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../PostUrlData.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">���{�o�G</a>
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
if($r[dof]||$r[dom]||$r[dotable])
{
?>
  <tr> 
    <td id="prtable" class="menu1" onclick="chengstate('table')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�ƾڪ�P�t�μҫ�</a>
	</td>
  </tr>
  <tr id="itemtable" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../db/AddTable.php?enews=AddTable<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�s�ؼƾڪ�</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../db/ListTable.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�ƾڪ�</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dodo]||$r[dotask])
{
?>
  <tr> 
    <td id="prtask" class="menu1" onclick="chengstate('task')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�p������</a>
	</td>
  </tr>
  <tr id="itemtask" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dodo])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../ListDo.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z��s����</a>
          </td>
        </tr>
		<?php
		}
		if($r[dotask])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../other/ListTask.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�p������</a>
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
if($r[doworkflow])
{
?>
  <tr> 
    <td id="prwf" class="menu1" onclick="chengstate('wf')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�u�@�y</a>
	</td>
  </tr>
  <tr id="itemwf" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file">
			<a href="../../workflow/AddWf.php?enews=AddWorkflow<?=$ecms_hashur['ehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�W�[�u�@�y</a>
          </td>
        </tr>
		<tr> 
          <td class="file1">
			<a href="../../workflow/ListWf.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�u�@�y</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[doyh])
{
?>
  <tr> 
    <td id="pryh" class="menu1" onclick="chengstate('yh')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�u�Ƥ��</a>
	</td>
  </tr>
  <tr id="itemyh" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file1">
			<a href="../../db/ListYh.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�u�Ƥ��</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r['domoreport'])
{
?>
  <tr> 
    <td id="prmport" class="menu1" onclick="chengstate('mport')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�����h�X�ݺ�</a>
    </td>
  </tr>
  <tr id="itemmport" style="display:none"> 
    <td class="list">
      <table border='0' cellspacing='0' cellpadding='0'>
        <tr> 
          <td class="file1">
		<a href="../../moreport/ListMoreport.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�����X�ݺ�</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
<?php
}
?>

<?php
if($r[domenu])
{
?>
  <tr> 
    <td id="prmenu" class="menu1" onclick="chengstate('menu')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�X�i���</a>
	</td>
  </tr>
  <tr id="itemmenu" style="display:none"> 
    <td class="list">
		<table border='0' cellspacing='0' cellpadding='0'>
		<tr> 
          <td class="file1">
			<a href="../../other/MenuClass.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z���</a>
          </td>
        </tr>
      </table>
	</td>
  </tr>
<?php
}
?>

<?php
if($r[dodbdata]||$r[doexecsql])
{
?>
  <tr> 
    <td id="prbak" class="menu3" onclick="chengstate('bak')">
		<a onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�ƥ��P��_�ƾ�</a>
	</td>
  </tr>
  <tr id="itembak" style="display:none"> 
    <td class="list1">
		<table border='0' cellspacing='0' cellpadding='0'>
		<?php
		if($r[dodbdata])
		{
		?>
        <tr> 
          <td class="file">
			<a href="../../ebak/ChangeDb.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�ƥ��ƾ�</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../ebak/ReData.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">��_�ƾ�</a>
          </td>
        </tr>
		<tr> 
          <td class="file">
			<a href="../../ebak/ChangePath.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">�޲z�ƥ��ؿ�</a>
          </td>
        </tr>
		<?php
		}
		if($r[doexecsql])
		{
		?>
		<tr> 
          <td class="file1">
			<a href="../../db/DoSql.php<?=$ecms_hashur['whehref']?>" target="main" onmouseout="this.style.fontWeight=''" onmouseover="this.style.fontWeight='bold'">����SQL�y�y</a>
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