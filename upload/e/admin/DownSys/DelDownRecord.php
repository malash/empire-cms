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
CheckLevel($logininid,$loginin,$classid,"deldownrecord");

//��q�R���ƥ��O��
function DelDownRecord($add,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($add['downtime']))
	{
		printerror("EmptyDownTime","history.go(-1)");
	}
	//�����v��
	CheckLevel($userid,$username,$classid,"deldownrecord");
	$truetime=to_time($add['downtime']);
	$sql=$empire->query("delete from {$dbtbpre}enewsdownrecord where truetime<=".$truetime);
	if($sql)
	{
		//�ާ@��x
		insert_dolog("time=$add[downtime]");
		printerror("DelDownRecordSuccess","DelDownRecord.php".hReturnEcmsHashStrHref2(1));
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
//�R���U���O��
if($enews=="DelDownRecord")
{
	$add=$_POST['add'];
	DelDownRecord($add,$logininid,$loginin);
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�R���U���ƥ��O��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="DelDownRecord.php<?=$ecms_hashur['whehref']?>">�R���U���ƥ��O��</a></td>
  </tr>
</table>
<form name="form1" method="post" action="DelDownRecord.php" onsubmit="return confirm('�T�{�n�R��?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"><div align="center">�R���U���ƥ��O�� 
          <input name="enews" type="hidden" id="enews" value="DelDownRecord">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">�R���I��� 
          <input name="add[downtime]" type="text" id="add[downtime]" value="<?=date("Y-m-d H:i:s")?>" size="20">
          ���e���ƥ��O�� 
          <input type="submit" name="Submit" value="����">
          &nbsp; </div></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><font color="#666666">����: �R���U���ƥ��O��,�H��ּƾڮw�Ŷ�.</font></td>
    </tr>
  </table>
</form>
</body>
</html>
