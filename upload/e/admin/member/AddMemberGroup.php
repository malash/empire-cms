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
CheckLevel($logininid,$loginin,$classid,"member");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListMemberGroup.php".$ecms_hashur['whehref'].">�޲z�|����</a>&nbsp;>&nbsp;�W�[�|����";
$r[level]=1;
$r[favanum]=120;
$r[daydown]=0;
$r[msgnum]=50;
$r[msglen]=255;
if($enews=="EditMemberGroup")
{
	$groupid=(int)$_GET['groupid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmembergroup where groupid='$groupid'");
	$url="<a href=ListMemberGroup.php".$ecms_hashur['whehref'].">�޲z�|����</a>&nbsp;>&nbsp;�ק�|���աG<b>".$r[groupname]."</b>";
	if($r[checked])
	{$checked=" checked";}
}
//�|�����
$memberform='';
$fsql=$empire->query("select fid,fname from {$dbtbpre}enewsmemberform order by fid");
while($fr=$empire->fetch($fsql))
{
	if($r['formid']==$fr[fid])
	{
		$selected=' selected';
	}
	else
	{
		$selected='';
	}
	$memberform.="<option value='".$fr[fid]."'".$selected.">".$fr[fname]."</option>";
}
//�Ŷ��ҪO
$spacestyle='';
$sssql=$empire->query("select styleid,stylename from {$dbtbpre}enewsspacestyle order by styleid");
while($ssr=$empire->fetch($sssql))
{
	if($r['spacestyleid']==$ssr[styleid])
	{
		$selected=' selected';
	}
	else
	{
		$selected='';
	}
	$spacestyle.="<option value='".$ssr[styleid]."'".$selected.">".$ssr[stylename]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�|����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td height="25">��m�G 
      <?=$url?>
    </td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmsmember.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="22%" height="25">�W�[�|����</td>
      <td width="78%" height="25"><input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="groupid" type="hidden" id="groupid" value="<?=$groupid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�|���զW��</td>
      <td height="25"> <input name="groupname" type="text" id="groupname" value="<?=$r[groupname]?>" size="38"> 
        <font color="#666666">(��p�GVIP�|��,���q�|��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�|���կŧO��</td>
      <td height="25"> <input name="level" type="text" id="level" value="<?=$r[level]?>" size="38"> 
        <font color="#666666">(�p�G1,2...���A�ŧO�ȶV���v���V�j)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�̤j���ç���</td>
      <td height="25"><input name="favanum" type="text" id="favanum" value="<?=$r[favanum]?>" size="38"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�C�ѳ̤j�U����</td>
      <td height="25"><input name="daydown" type="text" id="daydown" value="<?=$r[daydown]?>" size="38"> 
        <font color="#666666">(0��������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�C�ѳ̤j��Z��</td>
      <td height="25"><input name="dayaddinfo" type="text" id="dayaddinfo" value="<?=$r[dayaddinfo]?>" size="38"> 
        <font color="#666666">(0��������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��Z�H���O�_�f��</td>
      <td height="25"><input name="infochecked" type="checkbox" id="infochecked" value="1"<?=$r[infochecked]==1?' checked':''?>>
        �����q�L,���μf��</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���׬O�_�f��</td>
      <td height="25"><input name="plchecked" type="checkbox" id="plchecked" value="1"<?=$r[plchecked]==1?' checked':''?>>
        �����q�L,���μf��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�̤j�u������</td>
      <td height="25"><input name="msgnum" type="text" id="msgnum" value="<?=$r[msgnum]?>" size="38"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�u�����̤j�r��</td>
      <td height="25"><input name="msglen" type="text" id="msglen" value="<?=$r[msglen]?>" size="38">
        �Ӧr�`</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�H���ϥΪ��</td>
      <td height="25"><select name="formid" id="formid">
          <?=$memberform?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�e�x�i���U</td>
      <td height="25"><input type="radio" name="canreg" value="1"<?=$r[canreg]==1?' checked':''?>>
        �O 
        <input type="radio" name="canreg" value="0"<?=$r[canreg]==0?' checked':''?>>
        �_</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���U�ݭn�f��</td>
      <td height="25"><input type="radio" name="regchecked" value="1"<?=$r[regchecked]==1?' checked':''?>>
        �O 
        <input type="radio" name="regchecked" value="0"<?=$r[regchecked]==0?' checked':''?>>
        �_</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�|���q�{�Ŷ��ҪO</td>
      <td height="25"><select name="spacestyleid" id="spacestyleid">
          <option value=0>���]�m</option>
          <?=$spacestyle?>
        </select> <font color="#666666">(���]�m�h�ϥ��q�{�Ŷ��ҪO) </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
