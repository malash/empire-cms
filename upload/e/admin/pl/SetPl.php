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
$r=$empire->fetch1("select * from {$dbtbpre}enewspl_set limit 1");
//�����v��
$plgroup='';
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[plgroupid]==$mgr[groupid])
	{
		$plgroup_select=' selected';
	}
	else
	{
		$plgroup_select='';
	}
	$plgroup.="<option value=".$mgr[groupid].$plgroup_select.">".$mgr[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>���װѼƳ]�m</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><p>��m�G���װѼƳ]�m</p>
      </td>
  </tr>
</table>
<form name="plset" method="post" action="../ecmspl.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">���װѼƳ]�m 
        <input name=enews type=hidden value=SetPl></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">���צa�}</td>
      <td height="25" bgcolor="#FFFFFF"><input name="plurl" type="text" id="plurl" value="<?=$r[plurl]?>" size="38">
        <font color="#666666">(�j�w��W�ɳ]�m�A�����ݥ[�u/�v�A�p�G/e/pl/)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����v������</td>
      <td height="25"><select name="plgroupid" id="plgroupid">
          <option value=0>�C��</option>
          <?=$plgroup?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">���פ��e����</td>
      <td width="81%" height="25"><input name="plsize" type="text" id="plsize" value="<?=$r[plsize]?>" size="38">
        �Ӧr�`<font color="#666666"> (��Ӧr�`���@�Ӻ~�r)</font> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���׮ɶ����j</td>
      <td height="25"><input name="pltime" type="text" id="pltime" value="<?=$r[pltime]?>" size="38">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������ҽX</td>
      <td height="25"><input type="radio" name="plkey_ok" value="1"<?=$r[plkey_ok]==1?' checked':''?>>
        �}�� 
        <input type="radio" name="plkey_ok" value="0"<?=$r[plkey_ok]==0?' checked':''?>>
        ����</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���רC�����</td>
      <td height="25"><input name="pl_num" type="text" id="pl_num" value="<?=$r[pl_num]?>" size="38">
        �ӵ���</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ת��C�����</td>
      <td height="25"><input name="plfacenum" type="text" id="plfacenum" value="<?=$r[plfacenum]?>" size="38">
        �Ӫ�</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���׫̽��r��<br> <font color="#666666">(1)�B�h�ӥΡu|�v�j�}�A�p�u�r��1|�r��2�v�C<br>
        (2)�B�P�ɥ]�t�h�r�ɫ̽��i�����u#�v�j�}�A�p�u�}##��|�r��2�v �C�o�˥u�n���e�P�ɥ]�t�u�}�v�M�u�ѡv�r���|�Q�̽��C</font></td>
      <td height="25"><textarea name="plclosewords" cols="80" rows="8" id="plclosewords"><?=ehtmlspecialchars($r[plclosewords])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���׻\�ӳ̰��Ӽh</td>
      <td height="25"><input name="plmaxfloor" type="text" id="plmaxfloor" value="<?=$r[plmaxfloor]?>" size="38">
        �� <font color="#666666">(0������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" valign="top">���פޥΤ��e�榡�G<br>
      <br>
      ����ID�G[!--plid--]<br>
      �o��̡G[!--username--]<br>
      ���פ��e�G[!--pltext--]<br>
      �o��ɶ��G[!--pltime--]</td>
      <td height="25"><textarea name="plquotetemp" cols="80" rows="8" id="plquotetemp"><?=ehtmlspecialchars(stripSlashes($r[plquotetemp]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
