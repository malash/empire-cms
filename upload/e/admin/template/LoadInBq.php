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
$enews=$_POST['enews'];
$url="<a href=ListBq.php".$ecms_hashur['whehref'].">�޲z����</a>&nbsp;>&nbsp;<a href=LoadInBq.php".$ecms_hashur['whehref'].">�ɤJ����</a>";
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="LoadInBq")
{
	include('../../class/tempfun.php');
	$file=$_FILES['file']['tmp_name'];
	$file_name=$_FILES['file']['name'];
	$file_type=$_FILES['file']['type'];
	$file_size=$_FILES['file']['size'];
	$r=LoadInBq($_POST,$file,$file_name,$file_type,$file_size,$logininid,$loginin);
}
else
{
	//���O
	$cstr="";
	$csql=$empire->query("select classid,classname from {$dbtbpre}enewsbqclass order by classid");
	while($cr=$empire->fetch($csql))
	{
		$cstr.="<option value='".$cr[classid]."'>".$cr[classname]."</option>";
	}
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ɤJ����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>
<?php
if($enews=="LoadInBq")
{
?>
<form name="form2" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25"><div align="center">�ɤJ���ҧ���</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="34%"><div align="right">�ɤJ���ҦW�١G</div></td>
            <td width="66%" height="27"><b><?php echo $r[0]."&nbsp;(".$r[3].")";?></b></td>
          </tr>
          <tr> 
            <td height="27" colspan="2"><div align="center">���Ҩ�Ƥ��e�G</div></td>
          </tr>
          <tr> 
            <td height="27" colspan="2"> <div align="right"></div>
              <div align="center"> 
                <textarea name="funvalue" cols="86" rows="16" id="funvalue"><?=ehtmlspecialchars($r[5])?></textarea>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center">�����G�ɤJ���ҫ�A�Ч��Ƥ��e�ƻs��e/class/userfun.php���</div></td>
    </tr>
  </table>
</form>
<?php
}
else
{
?>
<form action="LoadInBq.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('�T�{�n�ɤJ�H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
	<?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�ɤJ���� 
          <input name="enews" type="hidden" id="enews" value="LoadInBq">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><table width="500" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="34%"><div align="right">���ҩ��ݤ����G</div></td>
            <td width="66%" height="27"><select name="classid" id="classid">
                <option value="0">�����ݩ�������</option>
                <?=$cstr?>
              </select></td>
          </tr>
          <tr> 
            <td height="27"> <div align="right">�ɤJ���Ҥ��G</div></td>
            <td height="27"><input type="file" name="file">
              (*.bq) </td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><div align="center">
          <input type="submit" name="Submit" value="���W�ɤJ">
          &nbsp;&nbsp;
          <input type="reset" name="Submit2" value="���m">
        </div></td>
    </tr>
  </table>
</form>
<?php
}
?>

</body>
</html>
