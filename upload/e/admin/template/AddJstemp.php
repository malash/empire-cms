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
CheckLevel($logininid,$loginin,$classid,"template");
$gid=(int)$_GET['gid'];
$gname=CheckTempGroup($gid);
$urlgname=$gname."&nbsp;>&nbsp;";
$cid=ehtmlspecialchars($_GET['cid']);
$enews=ehtmlspecialchars($_GET['enews']);
$r[showdate]="[m-d]";
$url=$urlgname."<a href=ListJstemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲zJS�ҪO</a>&nbsp;>&nbsp;�W�[JS�ҪO";
//�ƻs
if($enews=="AddJstemp"&&$_GET['docopy'])
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select * from ".GetDoTemptb("enewsjstemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListJstemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲zJS�ҪO</a>&nbsp;>&nbsp;�ƻsJS�ҪO: ".$r[tempname];
}
//�ק�
if($enews=="EditJstemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select * from ".GetDoTemptb("enewsjstemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListJstemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲zJS�ҪO</a>&nbsp;>&nbsp;�ק�JS�ҪO: ".$r[tempname];
}
//�t�μҫ�
$msql=$empire->query("select mid,mname from {$dbtbpre}enewsmod where usemod=0 order by myorder,mid");
while($mr=$empire->fetch($msql))
{
	if($mr[mid]==$r[modid])
	{$select=" selected";}
	else
	{$select="";}
	$mod.="<option value=".$mr[mid].$select.">".$mr[mname]."</option>";
}
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsjstempclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$r[classid])
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[JS�ҪO</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
<script>
function ReTempBak(){
	self.location.reload();
}
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="ListJstemp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[JS�ҪO 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> <input name="gid" type="hidden" id="gid" value="<?=$gid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�ҪO�W��(*)</td>
      <td width="81%" height="25"> <input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>"> 
      </td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">���ݨt�μҫ�(*)</td>
      <td height="25"><select name="modid" id="modid">
          <?=$mod?>
        </select> <input type="button" name="Submit6" value="�޲z�t�μҫ�" onclick="window.open('../db/ListTable.php<?=$ecms_hashur['whehref']?>');"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݤ���</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">�����ݩ�������O</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit6222322" value="�޲z����" onclick="window.open('JsTempClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">²���I���r��</td>
      <td height="25"><input name="subnews" type="text" id="subnews" value="<?=$r[subnews]?>" size="6">
        �Ӧr�`<font color="#666666">(0�����I��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���D�I���r��</td>
      <td height="25"><input name="subtitle" type="text" id="subtitle" value="<?=$r[subtitle]?>" size="6">
        �Ӧr�`<font color="#666666">(0�����I��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ɶ���ܮ榡</td>
      <td height="25"><input name="showdate" type="text" id="showdate" value="<?=$r[showdate]?>" size="20"> 
        <select name="select4" onchange="document.form1.showdate.value=this.value">
          <option value="Y-m-d H:i:s">���</option>
          <option value="Y-m-d H:i:s">2005-01-27 11:04:27</option>
          <option value="Y-m-d">2005-01-27</option>
          <option value="m-d">01-27</option>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>�ҪO���e</strong>(*)</td>
      <td height="25">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.temptext.value);document.form1.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.temptext.value&returnvar=opener.document.form1.temptext.value&fun=ReturnHtml&notfullpage=1<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="temptext" cols="90" rows="18" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[temptext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m">
        <?php
		if($enews=='EditJstemp')
		{
		?>
        &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=jstemp&tempid=<?=$tempid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        <?php
		}
		?>
      </td>
    </tr>
	</form>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(showtempvar);">��ܼҪO�ܶq����</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield42" type="text" value="[!--id--]">
              :�H��ID</td>
            <td width="34%"> <input name="textfield52" type="text" value="[!--titleurl--]">
              :���D�챵</td>
            <td width="33%"> <input name="textfield62" type="text" value="[!--oldtitle--]">
              :���DALT(���I���r��)</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield72" type="text" value="[!--classid--]">
              :���ID</td>
            <td><input name="textfield82" type="text" value="[!--class.name--]">
              :��ئW��(�a�챵)</td>
            <td><input name="textfield92" type="text" value="[!--this.classname--]">
              :��ئW��(���a�챵)</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield10" type="text" value="[!--this.classlink--]">
              :��ئa�}</td>
            <td><input name="textfield11" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td><input name="textfield12" type="text" value="[!--no.num--]">
              :�H���s��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield13" type="text" value="[!--userid--]">
              :�o�G��ID</td>
            <td><input name="textfield14" type="text" value="[!--username--]">
              :�o�G��</td>
            <td><input name="textfield15" type="text" value="[!--userfen--]">
              :�d�ݫH�������I��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield16" type="text" value="[!--onclick--]">
              :�I����</td>
            <td><input name="textfield17" type="text" value="[!--totaldown--]">
              :�U����</td>
            <td><input name="textfield18" type="text" value="[!--plnum--]">
              :���׼�</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield19" type="text" value="[!--ttid--]">
              :���D����ID</td>
            <td><input name="textfield192" type="text" value="[!--tt.name--]">
              :���D�����W��</td>
            <td><input name="textfield1922" type="text" value="[!--tt.url--]">
:���D�����a�}</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>[!--�r�q�W--]:�ƾڪ�r�q���e�եΡA�I 
              <input type="button" name="Submit3" value="�o��" onclick="window.open('ShowVar.php?<?=$ecms_hashur['ehref']?>&modid='+document.form1.modid.value,'','width=300,height=520,scrollbars=yes');">
              �i�d��</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ҪO�榡�G</td>
      <td height="25">�C���Y[!--empirenews.listtemp--]�C���e[!--empirenews.listtemp--]�C���</td>
    </tr>
  </table>
</body>
</html>
