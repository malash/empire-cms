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
CheckLevel($logininid,$loginin,$classid,"yh");
$enews=RepPostStr($_GET['enews'],1);
$url="<a href=ListYh.php".$ecms_hashur['whehref'].">�޲z�u�Ƥ��</a> &gt; �W�[�u�Ƥ��";
$r[hlist]=30;
$r[qlist]=30;
$r[bqnew]=30;
$r[bqhot]=30;
$r[bqpl]=30;
$r[bqgood]=30;
$r[bqfirst]=30;
$r[bqdown]=30;
$r[otherlink]=30;
$r[qmlist]=0;
$r[dobq]=1;
$r[dojs]=1;
$r[dosbq]=0;
$r[rehtml]=0;
//�ƻs
if($enews=="AddYh"&&$_GET['docopy'])
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsyh where id='$id'");
	$url="<a href=ListYh.php".$ecms_hashur['whehref'].">�޲z�u�Ƥ��</a> &gt; �ƻs�u�Ƥ�סG<b>".$r[yhname]."</b>";
}
//�ק�
if($enews=="EditYh")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsyh where id='$id'");
	$url="<a href=ListYh.php".$ecms_hashur['whehref'].">�޲z�u�Ƥ��</a> -&gt; �ק��u�Ƥ�סG<b>".$r[yhname]."</b>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�u�Ƥ��</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListYh.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�u�Ƥ�� 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="id" type="hidden" id="id" value="<?=$id?>"> 
      </td>
    </tr>
    <tr> 
      <td width="20%" height="25" bgcolor="#FFFFFF">��צW��:</td>
      <td width="80%" height="25" bgcolor="#FFFFFF"> <input name="yhname" type="text" id="yhname" value="<?=$r[yhname]?>" size="42"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��׻����G</td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="yhtext" cols="45" rows="4" id="yhtext"><?=ehtmlspecialchars($r[yhtext])?></textarea></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�H���C��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��x�޲z�C��G</td>
      <td height="25" bgcolor="#FFFFFF"> ��� 
        <input name="hlist" type="text" id="hlist" value="<?=$r[hlist]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�e�x�޲z�C��G</td>
      <td height="25" bgcolor="#FFFFFF">��� 
        <input name="qmlist" type="text" id="qmlist" value="<?=$r[qmlist]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�e�x�H���C��G</td>
      <td height="25" bgcolor="#FFFFFF">��� 
        <input name="qlist" type="text" id="qlist" value="<?=$r[qlist]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���ҽե� </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�u�ƽd��G</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dobq" type="checkbox" id="dobq" value="1"<?=$r[dobq]==1?' checked':''?>>
        ���ҽե� 
        <input name="dojs" type="checkbox" id="dojs" value="1"<?=$r[dojs]==1?' checked':''?>>
        JS�ե� 
        <input name="dosbq" type="checkbox" id="dosbq" value="1"<?=$r[dosbq]==1?' checked':''?>>
        �|���Ŷ����ҽե�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�̷s�H���G</td>
      <td height="25" bgcolor="#FFFFFF">�ե� 
        <input name="bqnew" type="text" id="hlist3" value="<?=$r[bqnew]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�I���Ʀ�G</td>
      <td height="25" bgcolor="#FFFFFF">�ե� 
        <input name="bqhot" type="text" id="bqnew" value="<?=$r[bqhot]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���˫H���G</td>
      <td height="25" bgcolor="#FFFFFF">�ե� 
        <input name="bqgood" type="text" id="bqnew2" value="<?=$r[bqgood]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ױƦ�G</td>
      <td height="25" bgcolor="#FFFFFF">�ե� 
        <input name="bqpl" type="text" id="bqnew3" value="<?=$r[bqpl]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Y���H���G</td>
      <td height="25" bgcolor="#FFFFFF">�ե� 
        <input name="bqfirst" type="text" id="bqnew4" value="<?=$r[bqfirst]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�U���Ʀ�G</td>
      <td height="25" bgcolor="#FFFFFF">�ե� 
        <input name="bqdown" type="text" id="bqnew5" value="<?=$r[bqdown]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�䥦����</td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">���e���ͦ��d��G</td>
      <td height="25" bgcolor="#FFFFFF">�ͦ� 
        <input name="rehtml" type="text" id="rehtml" value="<?=$r[rehtml]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����챵�˯��d��G</td>
      <td height="25" bgcolor="#FFFFFF"> �d�� 
        <input name="otherlink" type="text" id="otherlink" value="<?=$r[otherlink]?>" size="8">
        �Ѥ����H�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="����"> 
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
