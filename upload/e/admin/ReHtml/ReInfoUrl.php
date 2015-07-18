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
CheckLevel($logininid,$loginin,$classid,"changedata");

//��q��s�H�����a�}
function ReInfoUrl($start,$classid,$from,$retype,$startday,$endday,$startid,$endid,$tbname,$userid,$username){
	global $empire,$public_r,$class_r,$fun_r,$dbtbpre;
	//�����v��
	//CheckLevel($userid,$username,$classid,"changedata");
	$start=(int)$start;
	$tbname=RepPostVar($tbname);
	if(empty($tbname)||!eCheckTbname($tbname))
	{
		printerror("ErrorUrl","history.go(-1)");
    }
	$add1='';
	//����ب�s
	$classid=(int)$classid;
	if($classid)
	{
		if(empty($class_r[$classid][islast]))//�����
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		else//�׷����
		{
			$where="classid='$classid'";
		}
		$add1=" and (".$where.")";
    }
	//��ID��s
	if($retype)
	{
		$startid=(int)$startid;
		$endid=(int)$endid;
		if($endid)
		{
			$add1.=" and id>=$startid and id<=$endid";
	    }
    }
	else
	{
		$startday=RepPostVar($startday);
		$endday=RepPostVar($endday);
		if($startday&&$endday)
		{
			$add1.=" and truetime>=".to_time($startday." 00:00:00")." and truetime<=".to_time($endday." 23:59:59");
	    }
    }
	$b=0;
	$sql=$empire->query("select id,classid,checked from {$dbtbpre}ecms_".$tbname."_index where id>$start".$add1." order by id limit ".$public_r[delnewsnum]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$new_start=$r[id];
		//��^��
		$infotb=ReturnInfoMainTbname($tbname,$r['checked']);
		$infor=$empire->fetch1("select newspath,filename,groupid,isurl,titleurl from ".$infotb." where id='$r[id]' limit 1");
		$infourl=GotoGetTitleUrl($r['classid'],$r['id'],$infor['newspath'],$infor['filename'],$infor['groupid'],$infor['isurl'],$infor['titleurl']);
		$empire->query("update ".$infotb." set titleurl='$infourl' where id='$r[id]' limit 1");
	}
	if(empty($b))
	{
	    insert_dolog("");//�ާ@��x
		printerror("ReInfoUrlSuccess",$from);
	}
	echo $fun_r[OneReInfoUrlSuccess]."(ID:<font color=red><b>".$new_start."</b></font>)<script>self.location.href='ReInfoUrl.php?enews=ReInfoUrl&tbname=$tbname&classid=$classid&start=$new_start&from=".urlencode($from)."&retype=$retype&startday=$startday&endday=$endday&startid=$startid&endid=$endid".hReturnEcmsHashStrHref(0)."';</script>";
	exit();
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include('../../data/dbcache/class.php');
}
if($enews=="ReInfoUrl")//��q��s�H�����a�}
{
	$start=$_GET['start'];
	$classid=$_GET['classid'];
	$from=$_GET['from'];
	$retype=$_GET['retype'];
	$startday=$_GET['startday'];
	$endday=$_GET['endday'];
	$startid=$_GET['startid'];
	$endid=$_GET['endid'];
	$tbname=$_GET['tbname'];
	ReInfoUrl($start,$classid,$from,$retype,$startday,$endday,$startid,$endid,$tbname,$logininid,$loginin);
}

//���
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//��s��
$retable="";
$selecttable="";
$i=0;
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable where intb=0 order by tid");
while($tr=$empire->fetch($tsql))
{
	$i++;
	if($i%4==0)
	{
		$br="<br>";
	}
	else
	{
		$br="";
	}
	$retable.="<input type=checkbox name=tbname[] value='$tr[tbname]' checked>$tr[tname]&nbsp;&nbsp;".$br;
	$selecttable.="<option value='".$tr[tbname]."'>".$tr[tname]."</option>";
}
//��ܤ��
$todaydate=date("Y-m-d");
$todaytime=time();
$changeday="<select name=selectday onchange=\"document.reform.startday.value=this.value;document.reform.endday.value='".$todaydate."'\">
<option value='".$todaydate."'>--���--</option>
<option value='".$todaydate."'>����</option>
<option value='".ToChangeTime($todaytime,7)."'>�@�P</option>
<option value='".ToChangeTime($todaytime,30)."'>�@��</option>
<option value='".ToChangeTime($todaytime,90)."'>�T��</option>
<option value='".ToChangeTime($todaytime,180)."'>�b�~</option>
<option value='".ToChangeTime($todaytime,365)."'>�@�~</option>
</select>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q��s�H�����a�}</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td height="25">��m�G<a href="ReInfoUrl.php<?=$ecms_hashur['whehref']?>">��q��s�H�����a�}</a></td>
  </tr>
</table>
<form action="ReInfoUrl.php" method="get" name="form1" target="_blank" onsubmit="return confirm('�T�{�n��s?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ReInfoUrl">
  <?=$ecms_hashur['form']?>
    <input name="from" type="hidden" id="from" value="ReInfoUrl.php<?=$ecms_hashur['whehref']?>">
    <tr class="header"> 
      <td height="25"> <div align="center">��q��s�H�����a�}</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td height="25">�ƾڪ�G</td>
              <td height="25"> <select name="tbname" id="tbname">
                  <option value=''>------ ��ܼƾڪ� ------</option>
                  <?=$selecttable?>
                </select>
                (*) </td>
            </tr>
            <tr> 
              <td height="25">���</td>
              <td height="25"><select name="classid">
                  <option value="0">�Ҧ����</option>
                  <?=$class?>
                </select>
                <font color="#666666">(�p��ܤ���ءA�N��s�Ҧ��l���)</font></td>
            </tr>
            <tr> 
              <td width="23%" height="25"> <input name="retype" type="radio" value="0" checked>
                ���ɶ���s�G</td>
              <td width="77%" height="25">�q 
                <input name="startday" type="text" size="12" onclick="setday(this)">
                �� 
                <input name="endday" type="text" size="12" onclick="setday(this)">
                �������H�� <font color="#666666">(����N��s�Ҧ��H��)</font></td>
            </tr>
            <tr> 
              <td height="25"> <input name="retype" type="radio" value="1">
                ��ID��s�G</td>
              <td height="25">�q 
                <input name="startid" type="text" value="0" size="6">
                �� 
                <input name="endid" type="text" value="0" size="6">
                �������H�� <font color="#666666">(��ӭȬ�0�N��s�Ҧ��H��)</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit62" value="�}�l��s"> 
                <input type="reset" name="Submit72" value="���m"> 
                <input name="enews" type="hidden" value="ReInfoUrl"> 
              </td>
            </tr>
            <tr> 
              <td height="25" colspan="2"><font color="#666666">�����G����ܫH���ؿ��Φ��ɡA�ХΦ��\��ӧ�q��s���e���a�}�C</font></td>
            </tr>
          </table>
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
