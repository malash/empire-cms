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
$tname=ehtmlspecialchars($_GET['tname']);
$r=$empire->fetch1("select * from ".GetDoTemptb('enewspubtemp',$gid)." limit 1");
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>���@�ҪO</title>
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
    <td width="83%"><p>��m: 
        <?=$gname?>
        &nbsp;>&nbsp;<a href="EditPublicTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>">���@�ҪO�޲z</a></p></td>
    <td width="17%"> <div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�i�J�ƾڧ�s" onclick="window.open('../ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>');">
      </div></td>
  </tr>
</table>
<?php
if($tname=="indextemp"||empty($tname))
{
?>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=indextemp>
	<form name="formindex" method="post" action="../ecmstemp.php">
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�קﭺ���ҪO(<a href="../../../" target="_blank">�w��</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><div align="center">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.formindex.temptext.value);document.formindex.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.formindex.temptext.value&returnvar=opener.document.formindex.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</div></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[indextemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�ק�">
          &nbsp;&nbsp; 
          <input name="enews" type="hidden" id="enews" value="EditPublicTemp">
          <input name="templatename" type="hidden" id="templatename" value="indextemp">
          <input type="reset" name="Submit2" value="���m">
          <input name="gid" type="hidden" id="gid" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubindextemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
      <td bgcolor="#FFFFFF"><div align="right" class="emenubutton">
          <input type="button" name="Submit3" value="�޲z�������" onclick="window.open('ListIndexpage.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>');">
        </div></td>
    </tr>
	</form>
	<tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(indexshowtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=500,scrollbars=yes,resizable=yes');">�d�ݼҪO���һy�k</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListBqtemp.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݼ��ҼҪO</a>]</td>
    </tr>
    <tr id="indexshowtempvar" style="display:none"> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><strong>�����ҪO������ܶq����</strong> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="50%" height="25"> <input name="textfield" type="text" value="[!--pagetitle--]">
              :�����W��</td>
            <td width="50%"> <input name="textfield2" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td width="50%"><input name="textfield923" type="text" value="[!--class.menu--]">
              :�@����ؾɯ�</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield72" type="text" value="[!--pagekey--]">
              :��������r</td>
            <td><input name="textfield73" type="text" value="[!--pagedes--]">
              :�����y�z</td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>������@�ҪO�ܶq</strong></td>
            <td><strong>����Ҧ��ҪO����</strong></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
<br>
<?php
}
if($tname=="cptemp"||empty($tname))
{
?>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=cptemp>
	<form name="formcp" method="post" action="../ecmstemp.php">
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">����O�ҪO (<a href="../../member/cp" target="_blank">�w��</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.formcp.temptext.value);document.formcp.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.formcp.temptext.value&returnvar=opener.document.formcp.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[cptemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          &nbsp;&nbsp; 
          <input name="enews" type="hidden" id="enews" value="EditCptemp">
          <input name="templatename" type="hidden" id="templatename" value="cptemp">
          <input type="reset" name="Submit22" value="���m">
          <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubcptemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
	</form>
	<tr>
      <td height="25" bgcolor="#FFFFFF">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(cpshowtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>]</td>
    </tr>
    <tr id="cpshowtempvar" style="display:none">
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"><input name="textfield30" type="text" value="[!--newsnav--]">
              :�Ҧb��m�ɯ��</td>
            <td width="34%"><input name="textfield31" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td width="33%"><input name="textfield3" type="text" value="[!--pagetitle--]">
              �G�������D</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield722" type="text" value="[!--pagekey--]">
              :��������r</td>
            <td><input name="textfield732" type="text" value="[!--pagedes--]">
              :�����y�z</td>
            <td><input name="textfield922" type="text" value="[!--class.menu--]">
              :�@����ؾɯ�</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><strong>������@�ҪO�ܶq</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����: �b�n��ܤ��e���a��(�p���U�A�n����)�[�W�u[!--empirenews.template--]�v</td>
    </tr>
  </table>
<br>
<?php
}
if($tname=="schalltemp"||empty($tname))
{
?>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=schalltemp>
	<form name="formschall" method="post" action="../ecmstemp.php">
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�����j���ҪO(<a href="../../sch/sch.html" target="_blank">���ռҪO</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.formschall.temptext.value);document.formschall.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.formschall.temptext.value&returnvar=opener.document.formschall.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[schalltemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">²���I���r�ơG 
          <input name="schallsubnum" type="text" id="schallsubnum" value="<?=$r[schallsubnum]?>">
          �A�ɶ��榡�G 
          <input name="schalldate" type="text" id="schalldate" value="<?=$r[schalldate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditSchallTemp">
          <input name="tempname" type="hidden" id="tempname" value="schalltemp">
          <input type="reset" name="Submit22" value="���m">
          <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubschalltemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
	</form>
	<tr>
      <td height="25" bgcolor="#FFFFFF">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(schallshowtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>]</td>
    </tr>
    <tr id="schallshowtempvar" style="display:none">
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"><input name="textfield3023" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td width="34%"><input name="textfield3123" type="text" value="[!--newsnav--]">
              :�ɯ��</td>
            <td width="33%"><input name="textfield31222" type="text" value="[!--keyboard--]">
              :�j������r</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield302232" type="text" value="[!--num--]">
              :�`�O����</td>
            <td><input name="textfield57" type="text" value="[!--listpage--]">
              :�����ɯ�</td>
            <td><input name="textfield58" type="text" value="[!--no.num--]">
              :�s��</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield55" type="text" value="[!--titleurl--]">
              :�H���챵</td>
            <td><input name="textfield56" type="text" value="[!--id--]">
              :�H��ID</td>
            <td><input name="textfield59" type="text" value="[!--classid--]">
              :���ID</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield60" type="text" value="[!--titlepic--]">
              :���D�Ϥ�</td>
            <td><input name="textfield61" type="text" value="[!--newstime--]">
              :�o�G�ɶ�</td>
            <td><input name="textfield62" type="text" value="[!--title--]">
              :�H�����D</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield63" type="text" value="[!--smalltext--]">
              :²��</td>
            <td><input name="textfield92" type="text" value="[!--class.menu--]">
              :�@����ؾɯ�</td>
            <td><strong>������@�ҪO�ܶq</strong></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p>�ҪO�榡:�C���Y[!--empirenews.listtemp--]�C���e[!--empirenews.listtemp--]�C���<br>
        </p></td>
    </tr>
  </table>
<br>
<?php
}
if($tname=="searchformtemp"||empty($tname))
{
?>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=searchtemp>
	<form name="formsearchform" method="post" action="../ecmstemp.php">
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">���ŷj�����ҪO (<a href="../../../search/" target="_blank">�w��</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.formsearchform.temptext.value);document.formsearchform.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.formsearchform.temptext.value&returnvar=opener.document.formsearchform.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[searchtemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          &nbsp;&nbsp; 
          <input name="enews" type="hidden" id="enews" value="EditSearchTemp">
          <input name="tempname" type="hidden" id="tempname" value="searchtemp">
          <input type="reset" name="Submit22" value="���m">
          <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubsearchtemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
	</form>
	<tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(searchformshowtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>]</td>
    </tr>
    <tr id="searchformshowtempvar" style="display:none"> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"><input name="textfield302" type="text" value="[!--class--]">
              :�j����ئC��</td>
            <td width="34%"><input name="textfield312" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td width="33%"><input name="textfield31232" type="text" value="[!--newsnav--]">
              :�ɯ��</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield723" type="text" value="[!--pagekey--]">
              :��������r</td>
            <td><input name="textfield733" type="text" value="[!--pagedes--]">
              :�����y�z</td>
            <td><input name="textfield924" type="text" value="[!--class.menu--]">
              :�@����ؾɯ�</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>������@�ҪO�ܶq</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
<br>
<?php
}
if($tname=="searchformjs"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=searchjstemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�j��JS�ҪO[��V]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="18" id="temptext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[searchjstemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditSearchTemp">
          <input name="tempname" type="hidden" id="tempname" value="searchjstemp">
          <input type="reset" name="Submit22" value="���m">
          <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubsearchjstemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�ܶq����:</strong> <br>
          ���I�a�}: [!--news.url--]�A�j����ئC��: [!--class--] <br>
          <br>
          <strong>�եΦa�}�G</strong> 
          <input name="textfield1322" type="text" id="textfield1322" size="60" value="&lt;script src=&quot;<?=$public_r[newsurl]."d/js/js/search_news1.js";?>&quot;&gt;&lt;/script&gt;">
          [<a href="../view/js.php?classid=1&js=<?=$public_r[newsurl]."d/js/js/search_news1.js";?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>] 
        </p></td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="searchformjs1"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=searchjstemp1>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�j��JS�ҪO[�a�V]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="18" id="temptext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[searchjstemp1]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditSearchTemp">
          <input name="tempname" type="hidden" id="tempname" value="searchjstemp1">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubsearchjstemp1&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�ܶq����:</strong> <br>
          ���I�a�}: [!--news.url--]�A�j����ئC��: [!--class--] <br>
          <br>
          <strong>�եΦa�}�G</strong> 
          <input name="textfield13222" type="text" id="textfield13222" size="60" value="&lt;script src=&quot;<?=$public_r[newsurl]."d/js/js/search_news2.js";?>&quot;&gt;&lt;/script&gt;">
          [<a href="../view/js.php?classid=1&js=<?=$public_r[newsurl]."d/js/js/search_news2.js";?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>] 
        </p>
        </td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="otherlinktemp"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=otherlinktemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�����H���챵�ҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="18" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[otherlinktemp]))?></textarea>
        </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="center">���D�I���r�ơG
          <input name="otherlinktempsub" type="text" id="otherlinktempsub" value="<?=$r[otherlinktempsub]?>">
          �A�ɶ��榡�G
          <input name="otherlinktempdate" type="text" id="otherlinktempdate" value="<?=$r[otherlinktempdate]?>">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditOtherLinkTemp">
          <input name="tempname" type="hidden" id="tempname" value="otherlinktemp">
          <input type="reset" name="Submit22" value="���m">
          <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubotherlinktemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�榡:</strong>�C���Y[!--empirenews.listtemp--]�C���e[!--empirenews.listtemp--]�C���<br>
          <strong>�ҪO�ܶq�����G</strong><br>
          ���D: [!--title--]�A���Dalt�G[!--oldtitle--], ���D�챵: [!--titleurl--] <br>
          �o�G�ɶ�: [!--newstime--], ���D�Ϥ�: [!--titlepic--]</p></td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="gbooktemp"||empty($tname))
{
?>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=gbooktemp>
	<form name="formgbook" method="post" action="../ecmstemp.php">
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�d���O�ҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.formgbook.temptext.value);document.formgbook.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.formgbook.temptext.value&returnvar=opener.document.formgbook.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r['gbooktemp']))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit" value="�ק�">
          &nbsp;&nbsp; 
          <input name="enews" type="hidden" id="enews" value="EditGbooktemp">
          <input name="templatename" type="hidden" id="templatename" value="gbooktemp">
          <input type="reset" name="Submit2" value="���m">
          <input name="gid" type="hidden" id="gid" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubgbooktemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
	</form>
	<tr>
      <td height="25" bgcolor="#FFFFFF">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(gbookshowtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>]</td>
    </tr>
    <tr id="gbookshowtempvar" style="display:none">
      <td height="25" bgcolor="#FFFFFF"><strong>1�B���魶��������ܶq</strong><br> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield32" type="text" value="[!--newsnav--]">
              :�Ҧb��m�ɯ��</td>
            <td width="34%"><input name="textfield724" type="text" value="[!--pagekey--]">
              :��������r </td>
            <td width="33%"><input name="textfield734" type="text" value="[!--pagedes--]">
              :�����y�z </td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield33" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td><input name="textfield34" type="text" value="[!--bname--]">
              :�d�������W��</td>
            <td><input name="textfield925" type="text" value="[!--class.menu--]">
              :�@����ؾɯ�</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield35" type="text" value="[!--bid--]">
              :�d������ID</td>
            <td><input name="textfield36" type="text" value="[!--listpage--]">
              :�����ɯ�</td>
            <td><input name="textfield37" type="text" value="[!--num--]">
              :�`�O����</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>������@�ҪO�ܶq</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <br>
        <strong>2�B�C���e������ܶq</strong><br> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25">
<input name="textfield38" type="text" value="[!--lyid--]">
              :�d��ID</td>
            <td width="34%"> 
              <input name="textfield39" type="text" value="[!--name--]">
              :�d����</td>
            <td width="33%">
<input name="textfield40" type="text" value="[!--email--]">
              :�d���̶l�c</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield41" type="text" value="[!--mycall--]">
              :�d���̹q��</td>
            <td><input name="textfield42" type="text" value="[!--lytime--]">
              :�d���ɶ�</td>
            <td><input name="textfield43" type="text" value="[!--lytext--]">
              :�d�����e</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield44" type="text" value="[!--retext--]">
              :�^�_���e</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�����榡:</strong> �C���Y[!--empirenews.listtemp--]�C���e[!--empirenews.listtemp--]�C���<br>
          <strong>�^�_��ܮ榡�G</strong>[!--start.regbook--]�^�_��ܮ榡���e[!--end.regbook--]</p></td>
    </tr>
  </table>
<br>
<?php
}
if($tname=="pljstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=pljstemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�ק����JS�եμҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[pljstemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditOtherPubTemp">
          <input name="tempname" type="hidden" id="tempname" value="pljstemp">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubpljstemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�榡:�C���Y[!--empirenews.listtemp--]�C���e[!--empirenews.listtemp--]�C���<br>
          �ҪO�ܶq�����G</strong><br>
          �����a�}�G[!--news.url--],���ID�G[!--classid--],�H��ID�G[!--id--]<br>
          ����ID�G[!--plid--],���פ��e�G[!--pltext--],���׵o��ɶ��G[!--pltime--],�o���IP�G[!--plip--]<br>
          �o���ID�G[!--userid--],�o��̡G[!--username--],����ơG[!--zcnum--],�Ϲ�ơG[!--fdnum--]<br>
          <br>
          <strong>�H�����׽եΦa�}�G</strong>&lt;script src=&quot;[!--news.url--]e/pl/more/?classid=[!--classid--]&amp;id=[!--id--]&amp;num=10&quot;&gt;&lt;/script&gt;<br>
          <strong>�M�D���׽եΦa�}�G</strong>&lt;script src=&quot;[!--news.url--]e/pl/more/?doaction=dozt&amp;classid=[!--classid--]&amp;num=10&quot;&gt;&lt;/script&gt;<br>
        </p></td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="downpagetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=downpagetemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�ק�̲פU�����ҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[downpagetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditOtherPubTemp">
          <input name="tempname" type="hidden" id="tempname" value="downpagetemp">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubdownpagetemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�ܶq�����G</strong><br>
          �����a�}�G[!--news.url--],�������D�G[!--pagetitle--],�ɯ���G[!--newsnav--]<br>
          ��������r�G[!--pagekey--],�����y�z�G[!--pagedes--],�@����ؾɯ�G[!--class.menu--],���ID�G[!--classid--]<br>
          ��ئW�١G[!--class.name--],�����ID�G[!--bclass.id--],����ئW�١G[!--bclass.name--],�H��ID�G[!--id--]<br>
          �a�}ID:[!--pathid--],�a�}�W��:[!--down.name--],�U���a�}:[!--down.url--],���u��a�}�G[!--true.down.url--]<br>
          �����n��:[!--fen--],�U������:[!--group--],�H���a�}�G[!--titleurl--],�H�����D�G[!--title--]<br>
          �o�G�ɶ��G[!--newstime--],���D�Ϥ��G[!--titlepic--],����r�G[!--keyboard--],�I���ơG[!--onclick--]<br>
          �U���ơG[!--totaldown--],�o�G�Τ�ID�G[!--userid--],�o�G�Τ�W�G[!--username--]</p></td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="downsofttemp"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=downsofttemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�U���a�}�ҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="18" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[downsofttemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditOtherPubTemp">
          <input name="tempname" type="hidden" id="tempname" value="downsofttemp">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubdownsofttemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�ܶq�����G</strong><br>
          �U���W��:[!--down.name--],�u�X�U���a�}:[!--down.url--],���u��a�}�G[!--true.down.url--]<br>
          �U���a�}��:[!--pathid--],���ID:[!--classid--],�H��ID:[!--id--],�����n��:[!--fen--],�U������:[!--group--]<br>
          �����a�}�G[!--news.url--],�H�����D�G[!--title--] </p></td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="onlinemovietemp"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=onlinemovietemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�b�u����a�}�ҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="18" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[onlinemovietemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditOtherPubTemp">
          <input name="tempname" type="hidden" id="tempname" value="onlinemovietemp">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=pubonlinemovietemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�ܶq�����G</strong><br>
          �[�ݦW��:[!--down.name--],�u�X�[�ݦa�}:[!--down.url--],���u��a�}�G[!--true.down.url--]<br>
          �[�ݦa�}��:[!--pathid--],���ID:[!--classid--],�H��ID:[!--id--],�����n��:[!--fen--],�U������:[!--group--]<br>
          �����a�}�G[!--news.url--],�H�����D�G[!--title--]</p></td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="listpagetemp"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=listpagetemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�C������ҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="18" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[listpagetemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditOtherPubTemp">
          <input name="tempname" type="hidden" id="tempname" value="listpagetemp">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=publistpagetemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�ܶq�����G</strong><br>
          �������X:[!--thispage--], �`����:[!--pagenum--], �C����ܱ���:[!--lencord--] <br>
          �`����:[!--num--], �����챵:[!--pagelink--], �U�Ԥ���:[!--options--] </p>
        </td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="loginiframe"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=loginiframe>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�n�����A�ҪO (<a href="../../member/iframe" target="_blank">�w��</a>)</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="25" id="temptext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[loginiframe]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditLoginIframe">
          <input name="tempname" type="hidden" id="tempname" value="loginiframe">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=publoginiframe&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�榡�G</strong>�n���e��ܤ��e[!--empirenews.template--]�n������ܤ��e<br>
          <strong>�ҪO�ܶq�����G </strong><br>
          �Τ�ID:[!--userid--]�A�Τ�W:[!--username--]�A�����a�}�G[!--news.url--]<br>
          �|������:[!--groupname--]�A�{��:[!--money--]�A�b�ᦳ�ĤѼ�:[!--userdate--]<br>
          ���s�H��:[!--havemsg--]�A�n��:[!--userfen--]</p>
        </td>
    </tr>
  </table>
</form>
<?php
}
if($tname=="loginjstemp"||empty($tname))
{
?>
<form name="form1" method="post" action="../ecmstemp.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=loginjstemp>
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">JS�եεn�����A�ҪO</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <textarea name="temptext" cols="110" rows="25" id="temptext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[loginjstemp]))?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <input type="submit" name="Submit4" value="�ק�">
          <input name="enews" type="hidden" id="enews" value="EditLoginJstemp">
          <input name="tempname" type="hidden" id="tempname" value="loginjstemp">
          <input type="reset" name="Submit22" value="���m">
		  <input name="gid" type="hidden" id="gid3" value="<?=$gid?>">
          &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=publoginjstemp&tempid=1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>]</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><p><strong>�ҪO�榡�G</strong>�n���e��ܤ��e[!--empirenews.template--]�n������ܤ��e<br>
          <strong>�ҪO�ܶq�����G</strong> <br>
          �Τ�ID:[!--userid--]�A�Τ�W:[!--username--]�A�����a�}�G[!--news.url--]<br>
          �|������:[!--groupname--]�A�{��:[!--money--]�A�b�ᦳ�ĤѼ�:[!--userdate--]<br>
          ���s�H��:[!--havemsg--]�A�n��:[!--userfen--]<br>
          <br>
          <strong>�եΦa�}�G</strong> 
          <input name="textfield132" type="text" id="textfield132" size="60" value="&lt;script src=&quot;<?=$public_r[newsurl]."e/member/login/loginjs.php";?>&quot;&gt;&lt;/script&gt;">
          [<a href="../view/js.php?classid=1&js=<?=$public_r[newsurl]."e/member/login/loginjs.php";?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a>] 
        </p>
        </td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html>
