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
CheckLevel($logininid,$loginin,$classid,"precode");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListPrecode.php".$ecms_hashur['whehref'].">�޲z�u�f�X</a> &gt; <a href=AddMorePrecode.php".$ecms_hashur['whehref'].">��q�W�[�u�f�X</a>";
//�|����
$membergroup='';
$line=5;//�@����ܤ���
$i=0;
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($mgsql))
{
	$i++;
	$br='';
	if($i%$line==0)
	{
		$br='<br>';
	}
	$membergroup.="<input type='checkbox' name='groupid[]' value='$level_r[groupid]'>".$level_r[groupname]."&nbsp;".$br;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q�W�[�u�f�X</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListPrecode.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">��q�W�[�u�f�X 
          <input name="enews" type="hidden" id="enews" value="AddMorePrecode">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="17%" height="25">��q�ͦ��ƶq(*)�G</td>
      <td width="83%" height="25"><input name="donum" type="text" id="donum" value="10" size="42">
      ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�u�f�X���(*)�G</td>
      <td height="25"><input name="precodenum" type="text" id="cardnum" value="20" size="42">
        �� </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="17%" height="25">�u�f�X�W��(*)�G</td>
      <td width="83%" height="25"><input name="prename" type="text" id="prename" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�u�f�����G</td>
      <td height="25"><select name="pretype" id="pretype">
        <option value="0" selected>����B</option>
        <option value="1">�ӫ~�ʤ���</option>
      </select>
      <font color="#666666">�]�u����B�v�Y�q����B-�u�f���B�A�u�ӫ~�ʤ���v�Y���ӫ~���h�֧�^</font>      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�u�f���B(*)�G</td>
      <td height="25"><input name="premoney" type="text" id="premoney" size="42">
        <font color="#666666">(�����B�ɶ���B�A���G���A��ӫ~�ʤ���ɶ�ʤ���A���G%)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�L���ɶ��G</td>
      <td height="25"><input name="endtime" type="text" id="endtime" size="42" onclick="setday(this)">
        <font color="#666666">(�Ŭ�������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�u�f�X���ƨϥΡG</td>
      <td height="25"><input name="reuse" type="radio" value="0" checked>
        �@���ʨϥ�
        <input type="radio" name="reuse" value="1">
�i�H���ƨϥ�</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25">����ƨϥΦ��ơG
      <input name="usenum" type="text" id="usenum" value="0">
      <font color="#666666">(0������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���h�֪��B�i�ϥΡG</td>
      <td height="25"><input name="musttotal" type="text" id="musttotal" value="0" size="42">
�� <font color="#666666">(0������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�i�ϥΪ��|���աG<br>
        <font color="#666666">(���אּ����)</font></td>
      <td height="25"><?=$membergroup?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�i�ϥΪ���ذӫ~�G</td>
      <td height="25"><input name="classid" type="text" id="classid" size="42" onclick="setday(this)">
        <font color="#666666">(�Ŭ������A�n��g�׷����ID�A�h��ID�i�Υb���r���j�}�u,�v)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <input type="submit" name="Submit" value="����">
          &nbsp; 
          <input type="reset" name="Submit2" value="���m">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>