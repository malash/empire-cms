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
$enews=ehtmlspecialchars($_GET['enews']);
$url=$urlgname."<a href=ListVotetemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲z�벼�ҪO</a>&nbsp;>&nbsp;�W�[�벼�ҪO";
//�ƻs
if($enews=="AddVoteTemp"&&$_GET['docopy'])
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempid,tempname,temptext from ".GetDoTemptb("enewsvotetemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListVotetemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲z�벼�ҪO</a>&nbsp;>&nbsp;�ƻs�벼�ҪO�G<b>".$r[tempname]."</b>";
}
//�ק�
if($enews=="EditVoteTemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempid,tempname,temptext from ".GetDoTemptb("enewsvotetemp",$gid)." where tempid=$tempid");
	$url=$urlgname."<a href=ListVotetemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲z�벼�ҪO</a>&nbsp;>&nbsp;�ק�벼�ҪO�G<b>".$r[tempname]."</b>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�벼�ҪO</title>
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
  <form name="form1" method="post" action="ListVotetemp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�벼�ҪO 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>"> 
        <input name="gid" type="hidden" id="gid" value="<?=$gid?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">�ҪO�W��</td>
      <td width="81%" height="25"> <input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>�ҪO���e</strong>(*)</td>
      <td height="25">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.temptext.value);document.form1.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.temptext.value&returnvar=opener.document.form1.temptext.value&fun=ReturnHtml&notfullpage=1<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <textarea name="temptext" cols="90" rows="23" id="temptext" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[temptext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m">
        <?php
		if($enews=='EditVoteTemp')
		{
		?>
        &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=votetemp&tempid=<?=$tempid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
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
      <td height="25" colspan="2"><strong>(1)�B�벼����ϥήɤ�����ҪO�ܶq�C�� </strong><br> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF">
            <td height="25"><div align="center">[!--news.url--]</div></td>
            <td>�����a�}</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="36%" height="25"> <div align="center">[!--vote.action--]</div></td>
            <td width="64%">�벼��洣��a�}</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--title--]</div></td>
            <td>��ܧ벼�����D</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--vote.view--]</div></td>
            <td>�d�ݧ벼���G�a�}</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--width--](�e��)�B[!--height--](����)</div></td>
            <td>�u�X�벼���G���f�j�p</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--voteid--]</div></td>
            <td>���벼��ID</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--vote.box--]</div></td>
            <td>�벼�ﶵ�]���� 
              <input type="radio" name="radiobutton" value="radiobutton">
              �P�_��� 
              <input type="checkbox" name="checkbox" value="checkbox">
              �^</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--vote.name--]</div></td>
            <td>�벼�ﶵ�W��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><div align="center">�벼�ƥ��ܶq</div></td>
            <td>&lt;input type=&quot;hidden&quot; name=&quot;<strong>enews</strong>&quot; 
              value=&quot;<strong>AddVote</strong>&quot;&gt;</td>
          </tr>
        </table>
        <br> <strong>(2)�B�H���벼�ϥήɤ�����ҪO�ܶq�C�� </strong><br> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF">
            <td height="25"><div align="center">[!--news.url--]</div></td>
            <td>�����a�}</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="36%" height="25"> <div align="center">�벼��洣��a�}</div></td>
            <td width="64%">/e/enews/index.php</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><div align="center">�d�ݧ벼���G�a�}</div></td>
            <td>/e/public/vote/?classid=[!--classid--]&amp;id=[!--id--]</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--title--]</div></td>
            <td>��ܧ벼�����D</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--width--](�e��)�B[!--height--](����)</div></td>
            <td>�u�X�벼���G���f�j�p</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--id--]</div></td>
            <td>�H��ID</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><div align="center">[!--classid--]</div></td>
            <td>���ID</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--vote.box--]</div></td>
            <td>�벼�ﶵ�]���� 
              <input type="radio" name="radiobutton" value="radiobutton">
              �P�_��� 
              <input type="checkbox" name="checkbox2" value="checkbox">
              �^</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center">[!--vote.name--]</div></td>
            <td>�벼�ﶵ�W��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><div align="center">�벼�ƥ��ܶq</div></td>
            <td>&lt;input type=&quot;hidden&quot; name=&quot;<strong>enews</strong>&quot; 
              value=&quot;<strong>AddInfoVote</strong>&quot;&gt;</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ҪO�榡:</td>
      <td height="25">�C���Y[!--empirenews.listtemp--]�C���e[!--empirenews.listtemp--]�C���</td>
    </tr>
  </table>
</body>
</html>
