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
CheckLevel($logininid,$loginin,$classid,"feedbackf");
$enews=ehtmlspecialchars($_GET['enews']);
$btype=" checked";
$usernames='';
$r['mustenter']=",title,";
$record="<!--record-->";
$field="<!--field--->";
$url="<a href=feedback.php".$ecms_hashur['whhref'].">�޲z�H�����X</a>&nbsp;>&nbsp;<a href=FeedbackClass.php".$ecms_hashur['whhref'].">�޲z���X����</a>&nbsp;>&nbsp;�W�[���X����";
if($enews=="AddFeedbackClass"&&$_GET['docopy'])
{
	$bid=(int)$_GET['bid'];
	$btype="";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsfeedbackclass where bid='$bid'");
	$url="<a href=feedback.php".$ecms_hashur['whhref'].">�޲z�H�����X</a>&nbsp;>&nbsp;<a href=FeedbackClass.php".$ecms_hashur['whhref'].">�޲z���X����</a>&nbsp;>&nbsp;�ƻs���X����: ".$r['bname'];
	$usernames=substr($r['usernames'],1,-1);
}
//�ק�
if($enews=="EditFeedbackClass")
{
	$bid=(int)$_GET['bid'];
	$btype="";
	$url="<a href=feedback.php".$ecms_hashur['whhref'].">�޲z�H�����X</a>&nbsp;->&nbsp;<a href=FeedbackClass.php".$ecms_hashur['whhref'].">�޲z���X����</a>&nbsp;->&nbsp;�ק���X����";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsfeedbackclass where bid='$bid'");
	$usernames=substr($r['usernames'],1,-1);
}
//���o�r�q
$fsql=$empire->query("select f,fname from {$dbtbpre}enewsfeedbackf order by myorder,fid");
while($fr=$empire->fetch($fsql))
{
	$like=$field.$fr[f].$record;
	$slike=",".$fr[f].",";
	//���J��
	$enterchecked="";
	if(strstr($r[enter],$like))
	{
		$enterchecked=" checked";
		//���o�r�q����
		$dor=explode($like,$r[enter]);
		if(strstr($dor[0],$record))
		{
			$dor1=explode($record,$dor[0]);
			$last=count($dor1)-1;
			$fr[fname]=$dor1[$last];
		}
		else
		{
			$fr[fname]=$dor[0];
		}
	}
	//���D
	if($enews=="AddFeedbackClass"&&$fr[f]=="title")
	{
		$enterchecked=" checked";
	}
	$entercheckbox="<input name=center[] type=checkbox value='".$fr[f]."'".$enterchecked.">";
	//����
	$mustfchecked="";
	if(strstr($r[mustenter],$slike))
	{$mustfchecked=" checked";}
	if($enews=="AddFeedbackClass"&&$fr[f]=="title")
	{
		$mustfchecked=" checked";
	}
	$mustfcheckbox="<input name=menter[] type=checkbox value='".$fr[f]."'".$mustfchecked.">";
	$data.="<tr> 
            <td height=25> <div align=center> 
                <input name=cname[".$fr[f]."] type=text value='".$fr[fname]."'>
              </div></td>
            <td> <div align=center> 
                <input name=cfield type=text value='".$fr[f]."' readonly>
              </div></td>
            <td><div align=center> 
                ".$entercheckbox."
              </div></td>
			  <td><div align=center> 
                ".$mustfcheckbox."
              </div></td>
          </tr>";
}
//----------�|����
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	if($r[groupid]==$l_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$membergroup.="<option value=".$l_r[groupid].$select.">".$l_r[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[���X����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="FeedbackClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header">�W�[���X���� 
        <input name="bid" type="hidden" id="bid" value="<?=$bid?>"> <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">�����W��</td>
      <td width="77%" height="25"><input name="bname" type="text" id="bname" value="<?=$r[bname]?>" size="43"> 
        <font color="#666666">(��p�G&quot;��ĳ�P���X&quot;)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�޲z���X���Τ�</td>
      <td height="25"><input name="usernames" type="text" id="usernames" value="<?=$usernames?>" size="42">
        <font color="#666666"> 
        <input type="button" name="Submit32" value="���" onclick="window.open('../ChangeUser.php?field=usernames&form=form1<?=$ecms_hashur['ehref']?>','','width=300,height=520,scrollbars=yes');">
        (�Ŭ������A�h�ӥΤ�Ρu,�v�r���j�})</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����|�����v��</td>
      <td height="25"><select name="groupid" id="groupid">
          <option value="0">�C��</option>
          <?=$membergroup?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">��ܥ���檺�r�q��<br>
        (<font color="#FF0000"> 
        <input name="btype" type="checkbox" value="1"<?=$btype?>>
        �۰ʥͦ����</font>)<br> <br> <input type="button" name="Submit3" value="�r�q�޲z" onclick="window.open('ListFeedbackF.php<?=$ecms_hashur['whehref']?>');"> 
      </td>
      <td height="25" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr bgcolor="#DBEAF5"> 
            <td width="35%" height="25"> <div align="center">�r�q����</div></td>
            <td width="35%" height="25"> <div align="center">�r�q�W</div></td>
            <td width="15%"> <div align="center">���涵</div></td>
            <td width="15%"> <div align="center">����</div></td>
          </tr>
          <?=$data?>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><p>���J���ҪO<br>
          (�p<font color="#FF0000">�۰ʥͦ����ҪO</font><br>
          �A���ζ�ҪO���e)<br>
          <br>
          ����O�Y�����ҡG<br>
          [!--cp.header--]<br>
          <br>
          ����O�������ҡG<br>
          [!--cp.footer--]<br>
          <br>
          �|�������Y�����ҡG<br>
[!--member.header--]<br>
<br>
�|�����ߧ������ҡG<br>
[!--member.footer--]<br>
          <br>
          (������@�ҪO�ܶq)</p></td>
      <td height="25"><textarea name="btemp" cols="75" rows="20" style="WIDTH: 100%" id="btemp"><?=ehtmlspecialchars(stripSlashes($r[btemp]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�����G</td>
      <td height="25"><textarea name="bzs" cols="75" rows="10" style="WIDTH: 100%" id="textarea"><?=stripSlashes($r[bzs])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
