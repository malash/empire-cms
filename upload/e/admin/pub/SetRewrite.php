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
CheckLevel($logininid,$loginin,$classid,"public");

//�]�m���R�A�Ѽ�
function SetRewrite($add,$userid,$username){
	global $empire,$dbtbpre;
	CheckLevel($userid,$username,$classid,"public");//�����v��
	$sql=$empire->query("update {$dbtbpre}enewspublic set rewriteinfo='".eaddslashes($add[rewriteinfo])."',rewriteclass='".eaddslashes($add[rewriteclass])."',rewriteinfotype='".eaddslashes($add[rewriteinfotype])."',rewritetags='".eaddslashes($add[rewritetags])."',rewritepl='".eaddslashes($add[rewritepl])."' limit 1");
	if($sql)
	{
		GetConfig();
		//�ާ@��x
		insert_dolog("");
		printerror("SetRewriteSuccess","SetRewrite.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="SetRewrite")//�]�m���R�A�Ѽ�
{
	SetRewrite($_POST,$logininid,$loginin);
}

$r=$empire->fetch1("select rewriteinfo,rewriteclass,rewriteinfotype,rewritetags,rewritepl from {$dbtbpre}enewspublic limit 1");
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�]�m���R�A</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><p>��m�G<a href="SetRewrite.php<?=$ecms_hashur['whehref']?>">���R�A�]�m</a></p>
    </td>
  </tr>
</table>
<form name="setpublic" method="post" action="SetRewrite.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="4">���R�A�ѼƳ]�m 
        <input name="enews" type="hidden" value="SetRewrite"></td>
    </tr>
    <tr>
      <td width="135" height="25">����</td>
      <td width="302" height="25">�аO</td>
      <td width="554">�榡</td>
      <td width="323">��������</td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td height="25">�H�����e��</td>
      <td height="25">[!--classid--],[!--id--],[!--page--]</td>
      <td>/
        <input name="rewriteinfo" type="text" id="rewriteinfo" value="<?=$r[rewriteinfo]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewriteinfo.value='showinfo-[!--classid--]-[!--id--]-[!--page--].html';">�q�{</a>]</td>
      <td>/e/action/ShowInfo.php?classid=���ID&amp;id=�H��ID&amp;page=������</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�H���C��</td>
      <td height="25">[!--classid--],[!--page--]</td>
      <td>/
        <input name="rewriteclass" type="text" id="rewriteclass" value="<?=$r[rewriteclass]?>" size="55">
      [<a href="#empirecms" onclick="document.setpublic.rewriteclass.value='listinfo-[!--classid--]-[!--page--].html';">�q�{</a>]</td>
      <td>/e/action/ListInfo/index.php?classid=���ID&amp;page=������</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���D�����C��</td>
      <td height="25">[!--ttid--],[!--page--]</td>
      <td>/
        <input name="rewriteinfotype" type="text" id="rewriteinfotype" value="<?=$r[rewriteinfotype]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewriteinfotype.value='infotype-[!--ttid--]-[!--page--].html';">�q�{</a>]</td>
      <td>/e/action/InfoType/index.php?ttid=���D����ID&amp;page=������</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">TAGS�H���C��</td>
      <td height="25">[!--tagname--],[!--page--]</td>
      <td>/
        <input name="rewritetags" type="text" id="rewritetags" value="<?=$r[rewritetags]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewritetags.value='tags-[!--tagname--]-[!--page--].html';">�q�{</a>]</td>
      <td>/e/tags/index.php?tagname=TAGS�W��&amp;page=������</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���צC��</td>
      <td height="25">[!--doaction--],[!--classid--],[!--id--],<br>
      [!--page--],[!--myorder--],[!--tempid--]</td>
      <td>/
        <input name="rewritepl" type="text" id="rewritepl" value="<?=$r[rewritepl]?>" size="55">
[<a href="#empirecms" onclick="document.setpublic.rewritepl.value='comment-[!--doaction--]-[!--classid--]-[!--id--]-[!--page--]-[!--myorder--]-[!--tempid--].html';">�q�{</a>]</td>
      <td>/e/pl/index.php?doaction=�ƥ�&amp;classid=���ID&amp;id=�H��ID&amp;page=������&amp;myorder=�Ƨ�&amp;tempid=���׼ҪOID</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25" colspan="3"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
	<tr bgcolor="#FFFFFF">
      <td height="25" colspan="4">�����G�ĥ��R�A�����ɤ��ݭn�]�m�A�u����ĥΰʺA�����ɥi�q�L�]�m���R�A�Ӵ���SEO�u�ơA�p�G���ҥνЯd�šC�`�N�G���R�A�|�W�[�A�Ⱦ��t��A�קﰰ�R�A�榡��A�ݭn�ק�A�Ⱦ��� Rewrite �W�h�]�m�C</td>
    </tr>
  </table>
</form>
</body>
</html>
