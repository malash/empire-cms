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
$url=$urlgname."<a href=ListClasstemp.php?gid=$gid&classid=$cid".$ecms_hashur['ehref'].">�޲z�ʭ��ҪO</a>&nbsp;>&nbsp;�W�[�ʭ��ҪO";
$postword='�W�[�ʭ��ҪO';
//�ƻs
if($enews=="AddClasstemp"&&$_GET['docopy'])
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempid,tempname,temptext,classid from ".GetDoTemptb("enewsclasstemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListClasstemp.php?gid=$gid&classid=$cid".$ecms_hashur['ehref'].">�޲z�ʭ��ҪO</a>&nbsp;>&nbsp;�ƻs�ʭ��ҪO: ".$r[tempname];
	$postword='�ק�ʭ��ҪO';
}
//�ק�
if($enews=="EditClasstemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempid,tempname,temptext,classid from ".GetDoTemptb("enewsclasstemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListClasstemp.php?gid=$gid&classid=$cid".$ecms_hashur['ehref'].">�޲z�ʭ��ҪO</a>&nbsp;>&nbsp;�ק�ʭ��ҪO: ".$r[tempname];
	$postword='�ק�ʭ��ҪO';
}
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsclasstempclass order by classid");
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
<title><?=$postword?></title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.temptext.value=html;
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
  <form name="form1" method="post" action="ListClasstemp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> <input name="gid" type="hidden" id="gid" value="<?=$gid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�ҪO�W��(*)</td>
      <td width="81%" height="25"> <input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>" size="30"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݤ���</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">�����ݩ�������O</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit6222322" value="�޲z����" onclick="window.open('ClassTempClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>�ҪO���e</strong>(*)</td>
      <td height="25">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.temptext.value);document.form1.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.temptext.value&returnvar=opener.document.form1.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="temptext" cols="90" rows="27" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[temptext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�O�s�ҪO"> &nbsp;<input type="reset" name="Submit2" value="���m">
        <?php
		if($enews=='EditClasstemp')
		{
		?>
        &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=classtemp&tempid=<?=$tempid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        <?php
		}
		?>
      </td>
    </tr>
	</form>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(showtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=500,scrollbars=yes,resizable=yes');">�d�ݼҪO���һy�k</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListBqtemp.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݼ��ҼҪO</a>] 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield7" type="text" value="[!--pagetitle--]">
              :�������D</td>
            <td width="34%"><input name="textfield72" type="text" value="[!--pagekey--]">
              :��������r</td>
            <td width="33%"><input name="textfield73" type="text" value="[!--pagedes--]">
              :�����y�z</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield8" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td><input name="textfield9" type="text" value="[!--newsnav--]">
              :�Ҧb��m�ɯ��</td>
            <td><input name="textfield92" type="text" value="[!--class.menu--]">
              :�@����ؾɯ�</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield10" type="text" value="[!--self.classid--]">
              :�����/�M�DID</td>
            <td><input name="textfield11" type="text" value="[!--class.keywords--]">
              :���/�M�D����r</td>
            <td><input name="textfield12" type="text" value="[!--class.classimg--]">
              :���/�M�D�Y����</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield132" type="text" value="[!--class.name--]">
              :��ئW</td>
            <td><input name="textfield13" type="text" value="[!--class.intro--]">
              :���/�M�D²��</td>
            <td><input name="textfield14" type="text" value="[!--bclass.id--]">
              : �����ID</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield15" type="text" value="[!--bclass.name--]">
              :����ئW��</td>
            <td><strong>������@�ҪO�ܶq</strong></td>
            <td><strong>����Ҧ��ҪO����</strong></td>
          </tr>
        </table></td>
    </tr>
  </table>
</body>
</html>
