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
CheckLevel($logininid,$loginin,$classid,"bq");
$enews=ehtmlspecialchars($_GET['enews']);
$cid=ehtmlspecialchars($_GET['cid']);
$url="<a href=ListBq.php".$ecms_hashur['whehref'].">�޲z����</a>&nbsp;>&nbsp;�W�[����";
//�ק����
if($enews=="EditBq")
{
	$bqid=(int)$_GET['bqid'];
	$url="<a href=ListBq.php".$ecms_hashur['whehref'].">�޲z����</a>&nbsp;>&nbsp;�ק����";
	$r=$empire->fetch1("select bqname,bqsay,funname,bq,issys,bqgs,isclose,classid,myorder from {$dbtbpre}enewsbq where bqid='$bqid'");
}
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsbqclass order by classid");
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

//--------------------html�s�边
include('../ecmseditor/infoeditor/fckeditor.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>���Һ޲z</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function on()
{
var f=document.add
f.HTML.value=f.bqsay.value;
}
function bs(){
var f=document.add
f.bqsay.value=f.HTML.value;
}
function br(){
if(!confirm("�O�_�_��H")){return false;}
document.add.title.select()
}
</script><noscript>
<iframe src=*.htm></iframe>
</noscript>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form action="../ecmstemp.php" method="post" name="add" id="add">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�ҪO���� 
        <input name="add[bqid]" type="hidden" id="add[bqid]" value="<?=$bqid?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="add[cid]" type="hidden" id="add[cid]" value="<?=$cid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">���ҦW�G</td>
      <td width="79%" height="25"><input name="add[bqname]" type="text" id="add[bqname]" value="<?=$r[bqname]?>" size="38">
        <font color="#666666">(�p���եΤ�r�H�����ҡ�)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ҲŸ��G</td>
      <td height="25"><input name="add[bq]" type="text" id="add[bq]" value="<?=$r[bq]?>" size="38">
        <font color="#666666">(�p�G[ad]�Ѽ�[/ad]�A�h�Ÿ�����ad��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������O�G</td>
      <td height="25"><select name="add[classid]" id="add[classid]">
          <option value="0">�����ݩ�������O</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit3" value="�޲z����" onclick="window.open('BqClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ƦW�G</td>
      <td height="25"><input name="add[funname]" type="text" id="add[funname]" value="<?=$r[funname]?>" size="38"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <p>�t�μ��ҡG(�۹��e/class/t_functions.php��󪺨�ƦW)<br>
          �Τ�۩w�q���ҡG(�۹��e/class/userfun.php��󪺨�ƦW�A��ƩR�W�ХH��<strong><font color="#FF0000">user_</font></strong>���}�Y)</p></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���Ү榡�G</td>
      <td height="25"><input name="add[bqgs]" type="text" id="add[bqgs]" value="<?=stripSlashes($r[bqgs])?>" size="80"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">�p�G<font color="#FF0000">[phomenews]���ID/�M�DID,��ܱ���,���D�I����,�O�_��ܮɶ�,�ާ@����[/phomenews]</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">���һ����G</td>
      <td height="25"> 
        <?=ECMS_ShowEditorVar('bqsay',stripSlashes($r[bqsay]),'Default','../ecmseditor/infoeditor/')?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�O�_�}�Ҽ��ҡG</td>
      <td height="25"><input type="radio" name="add[isclose]" value="0"<?=$r[isclose]==0?' checked':''?>>
        �O 
        <input type="radio" name="add[isclose]" value="1"<?=$r[isclose]==1?' checked':''?>>
        �_ <font color="#666666">�]�}�Ҥ~�|�b�ҪO���ͮġ^</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�ƧǡG</td>
      <td height="25"><input name="add[myorder]" type="text" id="add[myorder]" value="<?=$r[myorder]?>" size="38">
        <font color="#666666">(�ȶV�j�V�e��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>