<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
$link=db_connect();
$empire=new mysqlquery();
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
CheckLevel($logininid,$loginin,$classid,"class");

//�i�}
if($_GET['doopen'])
{
	$open=(int)$_GET['open'];
	SetDisplayClass($open);
}
//�ϼ�
if(getcvar('displayclass',1))
{
	$img="<a href='ListClass.php?doopen=1&open=0".$ecms_hashur['ehref']."' title='�i�}'><img src='../data/images/displaynoadd.gif' width='15' height='15' border='0'></a>";
}
else
{
	$img="<a href='ListClass.php?doopen=1&open=1".$ecms_hashur['ehref']."' title='���Y'><img src='../data/images/displayadd.gif' width='15' height='15' border='0'></a>";
}
//�w�s
$displayclass=(int)getcvar('displayclass',1);
$fcfile="../data/fc/ListClass".$displayclass.".php";
$fclistclass='';
if(file_exists($fcfile))
{
	$fclistclass=str_replace(AddCheckViewTempCode(),'',ReadFiletext($fcfile));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z���</title>
<link rel="stylesheet" href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" type="text/css">
<SCRIPT lanuage="JScript">
function turnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
var newWindow = null

//�եΦa�}
function tvurl(classid){
	window.open('view/ClassUrl.php?<?=$ecms_hashur['ehref']?>&classid='+classid,'','width=500,height=250');
}
//��s���
function relist(classid){
	self.location.href='enews.php?<?=$ecms_hashur['href']?>&enews=ReListHtml&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?>&classid='+classid;
}
//��s�H��
function renews(classid,tbname){
	window.open('ReHtml/DoRehtml.php?<?=$ecms_hashur['href']?>&enews=ReNewsHtml&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?>&classid='+classid+'&tbname[]='+tbname);
}
//�k��
function docinfo(classid){
	if(confirm('�T�{�k��?'))
	{
		self.location.href='ecmsinfo.php?<?=$ecms_hashur['href']?>&enews=InfoToDoc&ecmsdoc=1&docfrom=ListClass.php<?=urlencode($ecms_hashur['whehref'])?>&classid='+classid;
	}
}
//��sJS
function rejs(classid){
	self.location.href='ecmschtml.php?<?=$ecms_hashur['href']?>&enews=ReSingleJs&doing=0&classid='+classid;
}
//�ƻs
function copyc(classid){
	self.location.href='AddClass.php?<?=$ecms_hashur['ehref']?>&classid='+classid+'&enews=AddClass&docopy=1';
}
//�ק�
function editc(classid){
	self.location.href='AddClass.php?<?=$ecms_hashur['ehref']?>&classid='+classid+'&enews=EditClass';
}
//�R��
function delc(classid){
	if(confirm('�T�{�n�R������ءA�N�R�����ݤl��ؤΫH��'))
	{
		self.location.href='ecmsclass.php?<?=$ecms_hashur['href']?>&classid='+classid+'&enews=DelClass';
	}
}
//���D����
function ttc(classid){
	window.open('ClassInfoType.php?<?=$ecms_hashur['ehref']?>&classid='+classid);
}
//�o�G�H��
function addi(classid){
	window.open('AddNews.php?<?=$ecms_hashur['ehref']?>&enews=AddNews&classid='+classid);
}
</SCRIPT>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="18%">��m: <a href="ListClass.php<?=$ecms_hashur['whehref']?>">�޲z���</a></td>
    <td width="82%"> <div align="right" class="emenubutton">
        <input type="button" name="Submit6" value="�W�[���" onclick="self.location.href='AddClass.php?enews=AddClass<?=$ecms_hashur['ehref']?>'">
        <input type="button" name="Submit" value="��s����" onclick="self.location.href='ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>'">
        <input type="button" name="Submit2" value="��s�Ҧ���ح�" onclick="window.open('ecmschtml.php?enews=ReListHtml_all&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');">
        <input type="button" name="Submit3" value="��s�Ҧ��H������" onclick="window.open('ReHtml/DoRehtml.php?enews=ReNewsHtml&start=0&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');">
        <input type="button" name="Submit4" value="��s�Ҧ�JS�ե�" onclick="window.open('ecmschtml.php?enews=ReAllNewsJs&from=ListClass.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <form name=editorder method=post action=ecmsclass.php onsubmit="return confirm('�T�{�n�ާ@?');">
  <?=$ecms_hashur['form']?>
    <tr class="header" height="25"> 
      <td width="5%" align="center">����</td>
      <td width="7%" align="center"><?=$img?></td>
      <td width="6%" align="center">ID</td>
      <td width="36%">��ئW</td>
      <td width="6%" align="center">�X��</td>
      <td width="14%">��غ޲z</td>
      <td width="29%">�ާ@</td>
    </tr>
    <?php
	echo $fclistclass;
	?>
    <tr class="header"> 
      <td height="25" colspan="7"> <div align="left"> &nbsp;&nbsp;
          <input type="submit" name="Submit5" value="�ק���ض���" onClick="document.editorder.enews.value='EditClassOrder';document.editorder.action='ecmsclass.php';">&nbsp;&nbsp;
          <input name="enews" type="hidden" id="enews" value="EditClassOrder">
          <input type="submit" name="Submit7" value="��s��ح���" onClick="document.editorder.enews.value='GoReListHtmlMoreA';document.editorder.action='ecmschtml.php';">&nbsp;&nbsp;
          <input type="submit" name="Submit72" value="�׷�����ݩ��ഫ" onClick="document.editorder.enews.value='ChangeClassIslast';document.editorder.action='ecmsclass.php';">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="7"><strong>�׷�����ݩ��ഫ����(�u���ܳ�����)�G</strong><br>
        �p�G�A��ܪ��O<font color="#FF0000">�D�׷����</font>�A�h�ର<font color="#FF0000">�׷����</font><font color="#666666">(����ؤ��঳�l���)</font><br>
        �p�G�A��ܪ��O<font color="#FF0000">�׷����</font>�A�h�ର<font color="#FF0000">�D�׷����</font><font color="#666666">(�Х����e��ت��ƾ��ಾ�A�_�h�|�X�{���l�ƾ�)<br>
        </font><strong>�ק���ض���:���ǭȶV�p�V�e��</strong></td>
    </tr>
    <input name="from" type="hidden" value="ListClass.php<?=$ecms_hashur['whehref']?>">
    <input name="gore" type="hidden" value="0">
  </form>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="13%" height="25"> 
      <div align="center">�W��</div></td>
    <td width="39%" height="25">�եΦa�}</td>
    <td width="13%">
<div align="center">�W��</div></td>
    <td width="35%"> 
      <div align="center">�եΦa�}</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"><div align="center">�����H���ե�</div></td>
    <td height="25" bgcolor="#FFFFFF"> <input name="textfield" type="text" value="<?=$public_r[newsurl]?>d/js/js/hotnews.js">
      [<a href="ecmschtml.php?enews=ReHot_NewNews<?=$ecms_hashur['href']?>">��s</a>][<a href="view/js.php?js=hotnews&p=js<?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center">��V�j�����</div></td>
    <td bgcolor="#FFFFFF"> <div align="left"> 
        <input name="textfield3" type="text" value="<?=$public_r[newsurl]?>d/js/js/search_news1.js">
        [<a href="view/js.php?js=search_news1&p=js<?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>]</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"> <div align="center">�̷s�H���ե�</div></td>
    <td height="25" bgcolor="#FFFFFF"> <input name="textfield2" type="text" value="<?=$public_r[newsurl]?>d/js/js/newnews.js">
      [<a href="ecmschtml.php?enews=ReHot_NewNews<?=$ecms_hashur['href']?>">��s</a>][<a href="view/js.php?js=newnews&p=js<?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center">�a�V�j�����</div></td>
    <td bgcolor="#FFFFFF"> <div align="left"> 
        <input name="textfield4" type="text" value="<?=$public_r[newsurl]?>d/js/js/search_news2.js">
        [<a href="view/js.php?js=search_news2&p=js<?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>]</div></td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#FFFFFF"><div align="center">���˫H���ե�</div></td>
    <td height="25" bgcolor="#FFFFFF"><input name="textfield22" type="text" value="<?=$public_r[newsurl]?>d/js/js/goodnews.js">
      [<a href="ecmschtml.php?enews=ReHot_NewNews<?=$ecms_hashur['href']?>">��s</a>][<a href="view/js.php?js=goodnews&p=js<?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center">�j�������a�}</div></td>
    <td bgcolor="#FFFFFF"> <div align="left"> 
        <input name="textfield5" type="text" value="<?=$public_r[newsurl]?>search">
        [<a href="../../search" target="_blank">�w��</a>]</div></td>
  </tr>
  <tr> 
    <td height="24" bgcolor="#FFFFFF"> 
      <div align="center">����O�a�}</div></td>
    <td height="24" bgcolor="#FFFFFF">
<input name="textfield52" type="text" value="<?=$public_r[newsurl]?>e/member/cp">
      [<a href="../member/cp" target="_blank">�w��</a>]</td>
    <td bgcolor="#FFFFFF"><div align="center"></div></td>
    <td bgcolor="#FFFFFF"><div align="center"></div></td>
  </tr>
  <tr class="header"> 
    <td height="25" colspan="4">js�եΤ覡�G&lt;script src=js�a�}&gt;&lt;/script&gt;</td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
