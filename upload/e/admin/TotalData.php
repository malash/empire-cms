<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
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
CheckLevel($logininid,$loginin,$classid,"totaldata");
$totaltype=(int)$_POST['totaltype'];
$classid=(int)$_POST['classid'];
$tbname=RepPostVar($_POST['tbname']);
$startday=RepPostVar($_POST['startday']);
$endday=RepPostVar($_POST['endday']);
$userid=(int)$_POST['userid'];
$onclick=0;
$allnum=0;
$nochecknum=0;
$checknum=0;
$bfb=0;
$and=' where ';
//�����O�έp
if($totaltype==0)
{
	$tbname='';
	if($classid&&!$class_r[$classid][tbname])
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	//���f��
	$query="select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_check";
	//�w�f��
	$query1="select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname];
	//�I��
	$onclickquery="select avg(onclick) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname];
	if($classid)
	{
		//�������O
		if(empty($class_r[$classid][islast]))
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		//�׷����O
		else
		{
			$where="classid='$classid'";
		}
		$query.=" where ".$where;
		$query1.=" where ".$where;
		$onclickquery.=" where ".$where;
		$and=' and ';
	}
}
//����έp
elseif($totaltype==1)
{
	$classid=0;
	if(!$tbname)
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	//���f��
	$query="select count(*) as total from {$dbtbpre}ecms_".$tbname."_check";
	//�w�f��
	$query1="select count(*) as total from {$dbtbpre}ecms_".$tbname;
	//�I��
	$onclickquery="select avg(onclick) as total from {$dbtbpre}ecms_".$tbname;
}
else
{
	printerror("ErrorUrl","history.go(-1)");
}
//�ɶ�
if($startday&&$endday)
{
	$start=$startday." 00:00:00";
	$end=$endday." 23:59:59";
	$timeadd=$and."(newstime>='".to_time($start)."' and newstime<='".to_time($end)."')";
	$query.=$timeadd;
	$query1.=$timeadd;
	$onclickquery.=$timeadd;
	$and=' and ';
}
//�Τ�
if($userid)
{
	$useradd=$and."userid='$userid'";
	$query.=$useradd;
	$query1.=$useradd;
	$onclickquery.=$useradd;
	$and=' and ';
}
//�ƾڪ�
$htb=0;
$tbsql=$empire->query("select tbname,tname from {$dbtbpre}enewstable order by tid");
while($tbr=$empire->fetch($tbsql))
{
	$select="";
	if($tbr[tbname]==$tbname)
	{
		$htb=1;
		$select=" selected";
	}
	$tbstr.="<option value='".$tbr[tbname]."'".$select.">".$tbr[tname]."</option>";
}
if($totaltype==1&&$htb==0)
{
	printerror('ErrorUrl','');
}
if($classid||$tbname)
{
	//�f��
	$checknum=$empire->gettotal($query1);
	//���f��
	$nochecknum=$empire->gettotal($query);
	//�`�H����
	$allnum=$checknum+$nochecknum;
	//�I���v
	$onclick=$empire->gettotal($onclickquery);
}
//���
$fcfile="../data/fc/ListEnews.php";
$class="<script src=../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",$classid,0,"|-",0,0);}
//�Τ�
$usersql=$empire->query("select userid,username from {$dbtbpre}enewsuser order by userid");
while($userr=$empire->fetch($usersql))
{
	if($userr[userid]==$userid)
	{$select=" selected";}
	else
	{$select="";}
	$user.="<option value='".$userr[userid]."'".$select.">".$userr[username]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�έp�ƾ�</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<a href="TotalData.php<?=$ecms_hashur['whehref']?>">�έp�ƾ�</a></td>
  </tr>
</table>

<form name="form1" method="post" action="TotalData.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['eform']?>
    <tr class="header"> 
      <td height="25" colspan="2">�έp�ƾ� 
        <input name="enews" type="hidden" id="enews" value="TotalData"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25"><input name="totaltype" type="radio" value="0"<?=$totaltype==0?' checked':''?>>
        ����زέp</td>
      <td width="81%" height="25"><select name="classid" id="classid">
          <?=$class?>
        </select>
        �]�p��ܤ���ءA�N�έp��Ҧ��l��ء^ </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><input name="totaltype" type="radio" value="1"<?=$totaltype==1?' checked':''?>>
        ���ƾڪ�έp</td>
      <td height="25"><select name="tbname" id="tbname">
          <?=$tbstr?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���J�̡G</td>
      <td height="25"><select name="userid" id="userid">
          <option value="0">�Ҧ����J��</option>
          <?=$user?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ɶ��d��G</td>
      <td height="25">�q 
        <input name="startday" type="text" value="<?=$startday?>" size="12" onclick="setday(this)">
        �� 
        <input name="endday" type="text" value="<?=$endday?>" size="12" onclick="setday(this)">
        �������ƾ�(���䬰�ūh����������)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�}�l�έp"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="4"> <div align="center">�έp�ɶ��G 
        <?=date("Y-m-d H:i:s")?>
      </div></td>
  </tr>
  <tr class="header"> 
    <td width="23%" height="25"><div align="center">�`�H����</div></td>
    <td width="23%" height="25"> <p align="center">���f�ּ�</p></td>
    <td width="23%" height="25"> <div align="center">�w�f�ּ�</div></td>
    <td width="15%"><div align="center">�����I����</div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><div align="center"><font color=red> 
        <?=$allnum?>
        </font></div></td>
    <td height="25"><div align="center"> 
        <?=$nochecknum?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$checknum?>
      </div></td>
    <td><div align="center">
        <?=$onclick?>
      </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
