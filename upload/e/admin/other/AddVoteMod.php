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
CheckLevel($logininid,$loginin,$classid,"votemod");
$enews=ehtmlspecialchars($_GET['enews']);
$r[width]=500;
$r[height]=300;
$voteclass0=" checked";
$doip0=" checked";
$editnum=8;
$url="<a href=ListVoteMod.php".$ecms_hashur['whehref'].">�޲z�w�]�벼</a>&nbsp;>&nbsp;�W�[�w�]�벼";
//�ƻs
$docopy=RepPostStr($_GET['docopy'],1);
if($docopy&&$enews=="AddVoteMod")
{
	$copyvote=1;
}
//�ק�
if($enews=="EditVoteMod"||$copyvote)
{
	if($copyvote)
	{
		$thisdo="�ƻs";
	}
	else
	{
		$thisdo="�ק�";
	}
	$voteid=(int)$_GET['voteid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsvotemod where voteid='$voteid'");
	$url="<a href=ListVoteMod.php".$ecms_hashur['whehref'].">�޲z�w�]�벼</a>&nbsp;>&nbsp;".$thisdo."�w�]�벼�G<b>".$r[title]."</b>";
	$str="dotime".$r[dotime];
	$$str=" selected";
	if($r[voteclass]==1)
	{
		$voteclass0="";
		$voteclass1=" checked";
	}
	if($r[doip]==1)
	{
		$doip0="";
		$doip1=" checked";
	}
	$d_record=explode("\r\n",$r[votetext]);
	for($i=0;$i<count($d_record);$i++)
	{
		$j=$i+1;
		$d_field=explode("::::::",$d_record[$i]);
		$allv.="<tr><td width=9%><div align=center>".$j."</div></td><td width=65%><input name=votename[] type=text id=votename[] value='".$d_field[0]."' size=30></td><td width=26%><input name=votenum[] type=text id=votenum[] value='".$d_field[1]."' size=6><input type=hidden name=vid[] value=".$j."><input type=checkbox name=delvid[] value=".$j.">�R��</td></tr>";
	}
	$editnum=$j;
	$allv="<table width=100% border=0 cellspacing=1 cellpadding=3>".$allv."</table>";
}
//�ҪO
$votetemp="";
$tsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsvotetemp")." order by tempid");
while($tr=$empire->fetch($tsql))
{
	if($r[tempid]==$tr[tempid])
	{
		$select=" selected";
	}
	else
	{
		$select="";
	}
	$votetemp.="<option value='".$tr[tempid]."'".$select.">".$tr[tempname]."</option>";
}
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�w�]�벼</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function doadd()
{var i;
var str="";
var oldi=0;
var j=0;
oldi=parseInt(document.add.editnum.value);
for(i=1;i<=document.add.vote_num.value;i++)
{
j=i+oldi;
str=str+"<tr><td width=9% height=20> <div align=center>"+j+"</div></td><td width=65%> <div align=center><input type=text name=votename[] size=30></div></td><td width=26%> <div align=center><input type=text name=votenum[] value=0 size=6></div></td></tr>";
}
document.getElementById("addvote").innerHTML="<table width=100% border=0 cellspacing=1 cellpadding=3>"+str+"</table>";
}
</script>
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="add" method="post" action="ListVoteMod.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="AddVotetb">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><p>�W�[�w�]�벼</p></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�벼�W��</td>
      <td height="25"><input name="ysvotename" type="text" id="ysvotename" value="<?=$r[ysvotename]?>" size="50"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">�D�D���D<font color="#666666">(�̤j60�Ӻ~�r)</font></td>
      <td width="79%" height="25"><input name="title" type="text" id="title" size="50" value="<?=$r[title]?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="voteid" type="hidden" id="voteid" value="<?=$r[voteid]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"><p>�벼����<br>
        </p></td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr bgcolor="#DBEAF5"> 
                  <td width="9%" height="20"> <div align="center">�s��</div></td>
                  <td width="65%"> <div align="center">���ئW��</div></td>
                  <td width="26%"> <div align="center">�벼��</div></td>
                </tr>
              </table>
              <?php
				if($enews=="EditVoteMod"||$copyvote)
				{echo"$allv";}
				else
				{
				?>
              <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td height="24" width="9%"> <div align="center">1</div></td>
                  <td height="24" width="65%"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24" width="26%"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">2</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">3</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">4</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">5</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">6</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">7</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
                <tr> 
                  <td height="24"> <div align="center">8</div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votename[]" type="text" id="votename[]" size="30">
                    </div></td>
                  <td height="24"> <div align="center"> 
                      <input name="votenum[]" type="text" id="votenum[]" value="0" size="6">
                    </div></td>
                </tr>
              </table>
              <?php
			  }
			  ?>
            </td>
          </tr>
          <tr> 
            <td>�벼�X�i�ƶq: 
              <input name="vote_num" type="text" id="vote_num" value="1" size="6"> 
              <input type="button" name="Submit52" value="��X�a�}" onclick="javascript:doadd();"> 
              <input name="editnum" type="hidden" id="editnum" value="<?=$editnum?>"> 
            </td>
          </tr>
          <tr> 
            <td id=addvote></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�벼����:</td>
      <td height="25"><input name="voteclass" type="radio" value="0"<?=$voteclass0?>>
        ��� 
        <input type="radio" name="voteclass" value="1"<?=$voteclass1?>>
        �_��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">����IP:</td>
      <td height="25"><input type="radio" name="doip" value="0"<?=$doip0?>>
        ������ 
        <input name="doip" type="radio" value="1"<?=$doip1?>>
        ����<font color="#666666">(�����P�@IP�u���@����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�L���ɶ�:</td>
      <td height="25"> <input name=olddotime type=hidden value="<?=$r[dotime]?>"> 
        <input name="dotime" type="text" id="dotime2" value="<?=$r[dotime]?>" size="12" onClick="setday(this)"> 
        <font color="#666666">(�W�L������,�N����벼,0000-00-00��������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�d�ݧ벼���f:</td>
      <td height="25">�e��: 
        <input name="width" type="text" id="width" value="<?=$r[width]?>" size="6">
        ����: 
        <input name="height" type="text" id="height" value="<?=$r[height]?>" size="6"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ܼҪO�G</td>
      <td height="25"><select name="tempid" id="tempid">
          <?=$votetemp?>
        </select> <input type="button" name="Submit62223" value="�޲z�벼�ҪO" onclick="window.open('../template/ListVotetemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
