<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//���ҥΤ�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//�����v��
CheckLevel($logininid,$loginin,$classid,"userpage");
$gid=(int)$_GET['gid'];
if(!$gid)
{
	$gid=GetDoTempGid();
}
$cid=ehtmlspecialchars($_GET['cid']);
$enews=ehtmlspecialchars($_GET['enews']);
$r[path]='../../page.html';
$r['tempid']=0;
$url="<a href=ListPage.php".$ecms_hashur['whehref'].">�޲z�۩w�q����</a>&nbsp;>&nbsp;�W�[�۩w�q����";
//�ƻs
if($enews=="AddUserpage"&&$_GET['docopy'])
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select id,title,path,pagetext,classid,pagetitle,pagekeywords,pagedescription,tempid from {$dbtbpre}enewspage where id='$id'");
	$url="<a href=ListPage.php".$ecms_hashur['whehref'].">�޲z�۩w�q����</a>&nbsp;>&nbsp;�ƻs�۩w�q�����G<b>".$r[title]."</b>";
}
//�ק�
if($enews=="EditUserpage")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select id,title,path,pagetext,classid,pagetitle,pagekeywords,pagedescription,tempid from {$dbtbpre}enewspage where id='$id'");
	$url="<a href=ListPage.php".$ecms_hashur['whehref'].">�޲z�۩w�q����</a>&nbsp;>&nbsp;�ק�۩w�q�����G<b>".$r[title]."</b>";
}
//�Ҧ�
$pagemod=1;
if($r['tempid'])
{
	$pagemod=2;
}
if($_GET['ChangePagemod'])
{
	$pagemod=(int)$_GET['ChangePagemod'];
}
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewspageclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$r[classid])
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
if($pagemod==2)
{
//�ҪO
$pagetempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewspagetemp")." order by tempid");
while($pagetempr=$empire->fetch($pagetempsql))
{
	$select="";
	if($r[tempid]==$pagetempr[tempid])
	{
		$select=" selected";
	}
	$pagetemp.="<option value='".$pagetempr[tempid]."'".$select.">".$pagetempr[tempname]."</option>";
}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>�W�[�Τ�۩w�q����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.pagetext.value=html;
}
</script>
<SCRIPT lanuage="JScript">
<!--
function tempturnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
-->
</SCRIPT>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../ecmscom.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�Τ�۩w�q���� 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="id" type="hidden" id="id" value="<?=$id?>"> 
        <input name="oldpath" type="hidden" id="oldpath" value="<?=$r[path]?>"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> <input name="gid" type="hidden" id="gid" value="<?=$gid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����Ҧ��G</td>
      <td height="25"><input type="radio" name="pagemod" value="1" onclick="self.location.href='AddPage.php?enews=<?=$enews?>&id=<?=$id?>&cid=<?=$cid?>&docopy=<?=RepPostStr($_GET['docopy'],1)?>&gid=<?=$gid?>&ChangePagemod=1<?=$ecms_hashur['ehref']?>';"<?=$pagemod==1?' checked':''?>>
        ���������� 
        <input type="radio" name="pagemod" value="2" onclick="self.location.href='AddPage.php?enews=<?=$enews?>&id=<?=$id?>&cid=<?=$cid?>&docopy=<?=RepPostStr($_GET['docopy'],1)?>&gid=<?=$gid?>&ChangePagemod=2<?=$ecms_hashur['ehref']?>';"<?=$pagemod==2?' checked':''?>>
        �ĥμҪO��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�����W��(*)</td>
      <td width="81%" height="25"> <input name="title" type="text" id="title" value="<?=$r[title]?>" size="42"> 
        <font color="#666666">(�p�G�pô�ڭ�)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���W(*)</td>
      <td height="25"><input name="path" type="text" id="path" value="<?=$r[path]?>" size="42"> 
        <input type="button" name="Submit4" value="��ܥؿ�" onclick="window.open('../file/ChangePath.php?returnform=opener.document.form1.path.value<?=$ecms_hashur['ehref']?>','','width=400,height=500,scrollbars=yes');"> 
        <font color="#666666">(�p�G../../about.html�A���ڥؿ�)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݤ���</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">�����ݩ�������O</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit6222322" value="�޲z����" onclick="window.open('PageClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
	<?php
	if($pagemod==2)
	{
	?>
    <tr bgcolor="#FFFFFF">
      <td height="25">�ϥΪ��ҪO</td>
      <td height="25"><select name="tempid" id="tempid">
          <?=$pagetemp?>
        </select> 
        <input type="button" name="Submit62223" value="�޲z�۩w�q�����ҪO" onclick="window.open('../template/ListPagetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
	<?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������D</td>
      <td height="25"><input name="pagetitle" type="text" id="pagetitle" value="<?=ehtmlspecialchars(stripSlashes($r[pagetitle]))?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���������</td>
      <td height="25"><input name="pagekeywords" type="text" id="pagekeywords" value="<?=ehtmlspecialchars(stripSlashes($r[pagekeywords]))?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����y�z</td>
      <td height="25"><input name="pagedescription" type="text" id="pagedescription" value="<?=ehtmlspecialchars(stripSlashes($r[pagedescription]))?>" size="42"></td>
    </tr>
	<?php
	if($pagemod==2)
	{
		//--------------------html�s�边
		include('../ecmseditor/infoeditor/fckeditor.php');
	?>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><strong>�������e</strong>(*)</td>
      <td height="25"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"> 
        <?=ECMS_ShowEditorVar('pagetext',stripSlashes($r[pagetext]),'Default','../ecmseditor/infoeditor/','300','100%')?>
      </td>
    </tr>
	<?php
	}
	else
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><strong>�������e</strong>(*)</td>
      <td height="25">�бN�������e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.pagetext.value);document.form1.pagetext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.pagetext.value&returnvar=opener.document.form1.pagetext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><div align="center"> 
          <textarea name="pagetext" cols="90" rows="27" id="pagetext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[pagetext]))?></textarea>
        </div></td>
    </tr>
	<?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
	</form>
	<?php
	if($pagemod!=2)
	{
	?>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(showtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=500,scrollbars=yes,resizable=yes');">�d�ݼҪO���һy�k</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListBqtemp.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݼ��ҼҪO</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield" type="text" value="[!--pagetitle--]">
              : �������D</td>
            <td width="34%"><input name="textfield2" type="text" value="[!--pagekeywords--]">
              : ���������</td>
            <td width="33%"><input name="textfield3" type="text" value="[!--pagedescription--]">
              : �����y�z</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield322" type="text" value="[!--pagename--]">
              : �����W��</td>
            <td><input name="textfield3222" type="text" value="[!--pageid--]">
              : ����ID</td>
            <td><input name="textfield4" type="text" value="[!--news.url--]">
              : �����a�}</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>������@�ҪO�ܶq</strong></td>
            <td><strong>����Ҧ��ҪO����</strong></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
	<?php
	}
	?>
  </table>
</body>
</html>
<?php
db_close();
$empire=null;
?>