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
CheckLevel($logininid,$loginin,$classid,"moreport");
$enews=ehtmlspecialchars($_GET['enews']);
$r['ppath']=ReturnAbsEcmsPath();
$url="<a href=ListMoreport.php".$ecms_hashur['whehref'].">�޲z�����X�ݺ�</a> &gt; �W�[�����X�ݺ�";
$postword='�W�[�����X�ݺ�';
if($enews=="EditMoreport")
{
	$pid=(int)$_GET['pid'];
	if($pid==1)
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmoreport where pid='$pid' limit 1");
	$url="<a href=ListMoreport.php".$ecms_hashur['whehref'].">�޲z�����X�ݺ�</a> &gt; �ק�����X�ݺݡG<b>".$r[pname]."</b>";
	$postword='�ק�����X�ݺ�';
}
$tgtemps='';
$tgsql=$empire->query("select gid,gname,isdefault from {$dbtbpre}enewstempgroup order by gid");
while($tgr=$empire->fetch($tgsql))
{
	$selected='';
	if($tgr['gid']==$r['tempgid'])
	{
		$selected=' selected';
	}
	$tgtemps.="<option value='".$tgr['gid']."'".$selected.">".$tgr['gname']."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�����X�ݺ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="moreportform" method="post" action="ListMoreport.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><?=$postword?> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
        <input name="pid" type="hidden" id="pid" value="<?=$pid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="25%" height="25">�X�ݺݦW�١G</td>
      <td width="75%" height="25"><input name="pname" type="text" id="pname" value="<?=$r[pname]?>" size="50">
      *
        <font color="#666666">(��p�G����X�ݺ�)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�X�ݺݦa�}�G</td>
      <td height="25"><input name="purl" type="text" id="purl" value="<?=$r[purl]?>" size="50">
        *        <font color="#666666">(�����ݥ[�u/�v�A��p�Ghttp://3g.phome.net/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�X�ݺݥؿ��G</td>
      <td height="25"><input name="ppath" type="text" id="ppath" value="<?=$r[ppath]?>" size="50">
        *<font color="#666666">(�ݶ񵴹�ؿ��a�}�A�����ݥ[�u/�v�A��p�Gd:/abc/3g/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�q�T�K�_�G</td>
      <td height="25"><input name="postpass" type="text" id="postpass" value="<?=$r[postpass]?>" size="50">
        *
        <input type="button" name="Submit32" value="�H��" onclick="document.moreportform.postpass.value='<?=make_password(60)?>';">
      <font color="#666666">(��g10~100�ӥ��N�r�šA�̦n�h�ئr�ŲզX)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ϥμҪO�աG</td>
      <td height="25"><select name="tempgid" id="tempgid">
        <?=$tgtemps?>
      </select>
        *        <font color="#666666">(��ܥ��X�ݺݨϥΪ��ҪO��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�����Ҧ��G</td>
      <td height="25"><input type="radio" name="mustdt" value="1"<?=$r[mustdt]==1?' checked':''?>>
        <a href="#empirecms" title="�j��ʺA�����Ҧ��ɡA�X�ݺݭ����B��ءB���e�������ĥΰʺA�����覡��ܡA�n�B�O�G���ΦA�ͦ��R�A����">�j��ʺA�����Ҧ�</a>
        <input type="radio" name="mustdt" value="0"<?=$r[mustdt]==0?' checked':''?>>
        <a href="#empirecms" title="�P�D�ݬۦP�G�p�G�D�ݬO�ĥ��R�A�����Ҧ��A�ݭn�b���X�ݺݫ�x�ͦ������A�~�|�P�B��ܡC">�P�D�ݬۦP</a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�����X�ݺݡG</td>
      <td height="25"><input name="isclose" type="checkbox" id="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
      ����</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">������Z�G</td>
      <td height="25"><input name="closeadd" type="checkbox" id="closeadd" value="1"<?=$r[closeadd]==1?' checked':''?>>
        ����</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����">&nbsp;<input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>