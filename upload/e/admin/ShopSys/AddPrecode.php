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
$time=(int)$_GET['time'];
$endtime='';
$r[precode]=strtoupper(make_password(20));
$classid='';
$r[musttotal]=0;
$url="<a href=ListPrecode.php".$ecms_hashur['whehref'].">�޲z�u�f�X</a> &gt; �W�[�u�f�X";
if($enews=="EditPrecode")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsshop_precode where id='$id' limit 1");
	$url="<a href=ListPrecode.php".$ecms_hashur['whehref'].">�޲z�u�f�X</a> &gt; �ק��u�f�X";
	$endtime=$r['endtime']?date('Y-m-d',$r['endtime']):'';
	$classid=substr($r['classid'],1,strlen($r['classid'])-2);
}
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
	if(strstr($r['groupid'],','.$level_r['groupid'].','))
	{$checked=" checked";}
	else
	{$checked="";}
	$membergroup.="<input type='checkbox' name='groupid[]' value='$level_r[groupid]'".$checked.">".$level_r[groupname]."&nbsp;".$br;
}
$href="AddPrecode.php?enews=$enews&time=$time&id=$id".$ecms_hashur['ehref'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�u�f�X</title>
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
      <td height="25" colspan="2"><div align="center">�W�[�u�f�X 
          <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
		  <input name="time" type="hidden" id="time" value="<?=$time?>">
          <input name="id" type="hidden" id="id" value="<?=$id?>">
      </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="17%" height="25">�u�f�X�W��(*)�G</td>
      <td width="83%" height="25"><input name="prename" type="text" id="prename" value="<?=$r[prename]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�u�f�X(*)�G</td>
      <td height="25"><input name="precode" type="text" id="precode" value="<?=$r[precode]?>" size="42">
        <input type="button" name="Submit3" value="�H���u�f�X" onclick="javascript:self.location.href='<?=$href?>'">
        <font color="#666666">(&lt;36��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�u�f�����G</td>
      <td height="25"><select name="pretype" id="pretype">
        <option value="0"<?=$r['pretype']==0?' selected':''?>>����B</option>
        <option value="1"<?=$r['pretype']==1?' selected':''?>>�ӫ~�ʤ���</option>
      </select>
      <font color="#666666">�]�u����B�v�Y�q����B-�u�f���B�A�u�ӫ~�ʤ���v�Y���ӫ~���h�֧�^</font>      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�u�f���B(*)�G</td>
      <td height="25"><input name="premoney" type="text" id="premoney" value="<?=$r[premoney]?>" size="42">
        <font color="#666666">(�����B�ɶ���B�A���G���A��ӫ~�ʤ���ɶ�ʤ���A���G%)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�L���ɶ��G</td>
      <td height="25"><input name="endtime" type="text" id="endtime" value="<?=$endtime?>" size="42" onclick="setday(this)">
        <font color="#666666">(�Ŭ�������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�u�f�X���ƨϥΡG</td>
      <td height="25"><input type="radio" name="reuse" value="0"<?=$r['reuse']==0?' checked':''?>>
      �@���ʨϥ�
      <input type="radio" name="reuse" value="1"<?=$r['reuse']==1?' checked':''?>>
      �i�H���ƨϥ�</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25">����ƨϥΦ��ơG
      <input name="usenum" type="text" id="usenum" value="<?=$r[usenum]?>"><?=$r[haveusenum]?'[�w�ϥΡG'.$r[haveusenum].']':''?>
	  <font color="#666666">(0������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���h�֪��B�i�ϥΡG</td>
      <td height="25"><input name="musttotal" type="text" id="musttotal" value="<?=$r[musttotal]?>" size="42">
        �� <font color="#666666">(0������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�i�ϥΪ��|���աG<br>
        <font color="#666666">(���אּ����)</font></td>
      <td height="25"><?=$membergroup?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�i�ϥΪ���ذӫ~�G</td>
      <td height="25"><input name="classid" type="text" id="classid" value="<?=$classid?>" size="42">
        <font color="#666666">(�Ŭ������A�n��g�׷����ID�A�h��ID�i�Υb���r���j�}�u,�v)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <input type="submit" name="Submit" value="����">
          &nbsp; 
          <input type="reset" name="Submit2" value="���m">
          &nbsp;</div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>