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
CheckLevel($logininid,$loginin,$classid,"card");
$enews=ehtmlspecialchars($_GET['enews']);
$time=ehtmlspecialchars($_GET['time']);
$r[money]=10;
$r[cardfen]=0;
$r[carddate]=0;
$r[endtime]="0000-00-00";
$r[card_no]=time();
$r[password]=strtolower(no_make_password(6));
$url="<a href=ListCard.php".$ecms_hashur['whehref'].">�޲z�I�d</a> &gt; �W�[�I�d";
if($enews=="EditCard")
{
	$cardid=(int)$_GET['cardid'];
	$r=$empire->fetch1("select card_no,password,money,cardfen,endtime,carddate,cdgroupid,cdzgroupid from {$dbtbpre}enewscard where cardid='$cardid' limit 1");
	$url="<a href=ListCard.php".$ecms_hashur['whehref'].">�޲z�I�d</a> &gt; �ק��I�d�G<b>".$r[card_no]."</b>";
}
//----------�|����
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($sql))
{
	if($r[cdgroupid]==$level_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$level_r[groupid].$select.">".$level_r[groupname]."</option>";
	if($r[cdzgroupid]==$level_r[groupid])
	{$zselect=" selected";}
	else
	{$zselect="";}
	$zgroup.="<option value=".$level_r[groupid].$zselect.">".$level_r[groupname]."</option>";
}
$href="AddCard.php?enews=$enews&cardid=$cardid".$ecms_hashur['ehref'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�I�d</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListCard.php">
  <table width="60%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�W�[�I�d 
          <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
          <input name="add[cardid]" type="hidden" id="add[cardid]" value="<?=$cardid?>">
          <input name="time" type="hidden" id="time" value="<?=$time?>">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="36%" height="25">�I�d�b���G</td>
      <td width="64%" height="25"><input name="add[card_no]" type="text" id="add[card_no]" value="<?=$r[card_no]?>">
        <font color="#666666">(&lt;30��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�I�d�K�X�G</td>
      <td height="25"><input name="add[password]" type="text" id="add[password]" value="<?=$r[password]?>">
        <font color="#666666">(&lt;20��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�I�d���B�G</td>
      <td height="25"><input name="add[money]" type="text" id="add[money]" value="<?=$r[money]?>" size="6">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�I�ơG</td>
      <td height="25"><input name="add[cardfen]" type="text" id="add[cardfen]" value="<?=$r[cardfen]?>" size="6">
        �I</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="3">�R�Ȧ��Ĵ�:</td>
      <td height="25"><input name="add[carddate]" type="text" id="add[carddate]" value="<?=$r[carddate]?>" size="6">
        ��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�R�ȳ]�m��V�|����:
        <select name="add[cdgroupid]" id="add[cdgroupid]">
		<option value=0>���]�m</option>
		<?=$group?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�������V���|����:
	  	<select name="add[cdzgroupid]" id="add[cdzgroupid]">
		<option value=0>���]�m</option>
		<?=$zgroup?>
        </select>
	  </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����ɶ��G</td>
      <td height="25"><input name="add[endtime]" type="text" id="add[endtime]" value="<?=$r[endtime]?>" size="20" onclick="setday(this)">
        <font color="#666666">(0000-00-00��������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><div align="center"> 
          <input type="submit" name="Submit" value="����">
          &nbsp; 
          <input type="reset" name="Submit2" value="���m">
          &nbsp; 
          <input type="button" name="Submit3" value="�K�X�H��" onclick="javascript:self.location.href='<?=$href?>'">
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