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
CheckLevel($logininid,$loginin,$classid,"delinfodata");
//���
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//��s��
$retable="";
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	$retable.="<option value='".$tr[tbname]."'>".$tr[tname]."(".$tr[tbname].")</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>������R���H��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<a href="DelData.php<?=$ecms_hashur['whehref']?>">������R���H��</a></td>
  </tr>
</table>
<form action="../ecmsinfo.php" method="get" name="form1" onsubmit="return confirm('�T�{�n�R��?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> <div align="center">������R���H��</div></td>
    </tr>
    <tr> 
      <td width="20%" height="25" bgcolor="#FFFFFF">��ܼƾڪ�</td>
      <td width="80%" bgcolor="#FFFFFF"><select name="tbname" id="tbname">
          <option value=''>------ ��ܼƾڪ� ------</option>
          <?=$retable?>
        </select>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������</td>
      <td bgcolor="#FFFFFF"><select name="classid" id="select">
          <option value="0">�Ҧ����</option>
          <?=$class?>
        </select> <font color="#666666">(�p��ܤ���ءA�N�R���Ҧ��l���)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <input name="retype" type="radio" value="0" checked>
        ���ɶ��R��</td>
      <td bgcolor="#FFFFFF">�q 
        <input name="startday" type="text" size="12" onclick="setday(this)">
        �� 
        <input name="endday" type="text" size="12" onclick="setday(this)">
        �������ƾ� <font color="#666666">(���񬰤���)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><input name="retype" type="radio" value="1">
        ��ID�R��</td>
      <td bgcolor="#FFFFFF">�q 
        <input name="startid" type="text" id="startid2" value="0" size="6">
        �� 
        <input name="endid" type="text" id="endid2" value="0" size="6">
        �������ƾ� <font color="#666666">(��ӭ�0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O�_�f��</td>
      <td bgcolor="#FFFFFF"><input name="infost" type="radio" value="0" checked>
        ���� 
        <input name="infost" type="radio" value="1">
        �w�f�� 
        <input name="infost" type="radio" value="2">
        ���f��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O�_�Τ�o�G</td>
      <td bgcolor="#FFFFFF"><input name="ismember" type="radio" value="0" checked>
        ���� <input type="radio" name="ismember" value="1">
        �C�ȵo�G 
        <input type="radio" name="ismember" value="2">
        �|��+�Τ�o�G 
        <input type="radio" name="ismember" value="3">
        �|���o�G 
        <input type="radio" name="ismember" value="4">
        �Τ�o�G</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O�_�~���챵</td>
      <td bgcolor="#FFFFFF"><input name="isurl" type="radio" value="0" checked>
        ���� <input type="radio" name="isurl" value="1">
        �~���챵�H�� 
        <input type="radio" name="isurl" value="2">
        �����H��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���׼Ƥ֩�</td>
      <td bgcolor="#FFFFFF"><input name="plnum" type="text" id="plnum" size="38"> <font color="#666666">(���]�m������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�I���Ƥ֩�</td>
      <td bgcolor="#FFFFFF"><input name="onclick" type="text" id="onclick" size="38"> <font color="#666666">(���]�m������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�U���Ƥ֩�</td>
      <td bgcolor="#FFFFFF"><input name="totaldown" type="text" id="totaldown" size="38"> 
        <font color="#666666">(���]�m������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���D�]�t�r��</td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="38"> <font color="#666666">(�h�Ӧr�ťΡu|�v�j�})</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�o�G�̱b��ID</td>
      <td bgcolor="#FFFFFF"><select name="usertype" id="usertype">
          <option value="0">�|��ID</option>
          <option value="1">�Τ�ID</option>
        </select>
        <input name="userids" type="text" id="userids" size="28">
        <font color="#666666">(�h�ӥΡu,�v�r���j�})</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�R��HTML���</td>
      <td bgcolor="#FFFFFF"><input name="delhtml" type="radio" value="0" checked>
        �R�� 
        <input type="radio" name="delhtml" value="1">
        ���R�� </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit6" value="��q�R��"> 
        <input name="enews" type="hidden" id="enews2" value="DelInfoData"> </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25">����: �|�����e�x���U�|���A�Τᬰ��x�޲z���C�R���᪺�ƾڤ����_,���ԷV�ϥΡC</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
