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
CheckLevel($logininid,$loginin,$classid,"task");

//��^�ﶵ
function ReturnDaySelect($zero,$num,$thisno){
	global $enews;
	$start=1;
	if($zero)
	{
		$start=0;
	}
	for($i=$start;$i<=$num;$i++)
	{
		$select='';
		if($enews=='EditTask'&&(','.$i.','==','.$thisno.','||strstr($thisno,','.$i.',')))
		{
			$select=' selected';
		}
		$options.="<option value='".$i."'".$select.">".$i."</option>";
	}
	echo $options;
}

$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href='ListTask.php".$ecms_hashur['whehref']."'>�޲z�p������</a>  &gt; �W�[�p������";
$postword='�W�[�p������';
$r['isopen']=1;
$r['doday']='*';
$r['doweek']='*';
$r['dohour']='*';
$r['dominute']=',';
if($enews=="EditTask")
{
	$id=(int)$_GET['id'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewstask where id='$id'");
	$url="<a href='ListTask.php".$ecms_hashur['whehref']."'>�޲z�p������</a>  &gt; �ק�p�����ȡG<b>".$r[taskname]."</b>";
	$postword='�ק�p������';
}
//�Τ�
$userselect='';
$usersql=$empire->query("select userid,username from {$dbtbpre}enewsuser order by userid");
while($ur=$empire->fetch($usersql))
{
	$select="";
	if($ur[userid]==$r[userid])
	{
		$select=" selected";
	}
	$userselect.="<option value='".$ur[userid]."'".$select.">".$ur[username]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�p������</title>
<script>
function selectalls(doselect,formvar)
{  
	 var bool=doselect==1?true:false;
	 var selectform=document.getElementById(formvar);
	 for(var i=0;i<selectform.length;i++)
	 { 
		  selectform.all[i].selected=bool;
	 } 
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListTask.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><?=$postword?> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="id" type="hidden" id="id" value="<?=$id?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="30%" height="25">���ȦW��</td>
      <td width="70%" height="25"> <input name="taskname" type="text" id="taskname" value="<?=$r[taskname]?>" size="42"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�O�_�}�Ҹӭp������</td>
      <td height="25"><input type="radio" name="isopen" value="1"<?=$r[isopen]==1?' checked':''?>>
        �O <input type="radio" name="isopen" value="0"<?=$r[isopen]==0?' checked':''?>>
        �_</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�����</td>
      <td height="25"><select name="userid" id="userid">
          <option value="0">*</option>
		  <?=$userselect?>
        </select>
        <font color="#666666"> (��ܥΤ��A�u�����n���b���~�|����o�ӭp������) </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�C��X������</td>
      <td height="25"><select name="doday" id="doday">
          <option value="*">*</option>
          <?php
		  ReturnDaySelect(0,31,$r[doday]);
		  ?>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�C�g�P���X����</td>
      <td height="25"><select name="doweek" id="doweek">
          <option value="*"<?=$r['doweek']=='*'?' selected':''?>>*</option>
          <option value="1"<?=$r['doweek']=='1'?' selected':''?>>�P���@</option>
          <option value="2"<?=$r['doweek']=='2'?' selected':''?>>�P���G</option>
          <option value="3"<?=$r['doweek']=='3'?' selected':''?>>�P���T</option>
          <option value="4"<?=$r['doweek']=='4'?' selected':''?>>�P���|</option>
          <option value="5"<?=$r['doweek']=='5'?' selected':''?>>�P����</option>
          <option value="6"<?=$r['doweek']=='6'?' selected':''?>>�P����</option>
          <option value="0"<?=$r['doweek']=='0'?' selected':''?>>�P����</option>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�C��X�I����</td>
      <td height="25"><select name="dohour">
          <option value="*">*</option>
          <?php
		  ReturnDaySelect(1,23,$r[dohour]);
		  ?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�C�p�ɴX��������<br>
        <font color="#666666">�]�m���Ǥ������楻����<br>
        ���אּ�����A��ܦh�ӥi�H��CTRL/SHIFT</font></td>
      <td height="25">
		<select name="min[]" size="12" multiple id="minselect" style="width:180">
          <?php
		ReturnDaySelect(1,59,$r['dominute']);
		?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'minselect')">��������</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">������W<br>
        (�be/tasks/�ؿ��U)</td>
      <td height="25"><input name="filename" type="text" id="filename" value="<?=$r[filename]?>" size="42"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><font color="#666666">�����G�u*�v��ܤ���</font></td>
    </tr>
  </table>
</form>
</body>
</html>
