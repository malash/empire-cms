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
//���
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//��s��
$retable="";
$selecttable="";
$cleartable='';
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
	$cleartable.="<option value='".$tr[tid]."'>".$tr[tname]."</option>";
}
//�M�D
$ztclass="";
$ztsql=$empire->query("select ztid,ztname from {$dbtbpre}enewszt order by ztid desc");
while($ztr=$empire->fetch($ztsql))
{
	$ztclass.="<option value='".$ztr['ztid']."'>".$ztr['ztname']."</option>";
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
<title>�ƾھ�z</title>
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
    <td width="34%" height="25">��m�G<a href="DoUpdateData.php<?=$ecms_hashur['whehref']?>">�ƾھ�z</a></td>
    <td width="66%"><table width="460" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr> 
          <td> <div align="center">[<a href="#IfTotalPlNum">��q��s�H�����׼�</a>]</div></td>
          <td> <div align="center">[<a href="#IfOtherInfo">��q��s�����챵</a>]</div></td>
          <td><div align="center">[<a href="#IfClearBreakInfo">�M�z�h�l�H��</a>]</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<form action="../ecmspl.php" method="get" name="form1" target="_blank" onsubmit="return confirm('�T�{�n��s?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=IfTotalPlNum>
  <?=$ecms_hashur['form']?>
    <input name="from" type="hidden" id="from" value="ReHtml/DoUpdateData.php<?=$ecms_hashur['whehref']?>">
    <tr class="header"> 
      <td height="25"> <div align="center">��q��s�H�����׼�</div></td>
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
              <td height="25">���w�T�w�H��ID�G</td>
              <td height="25"><input name="doids" type="text" id="doids" size="50">
                <font color="#666666">�]�h��ID�i�Υb���r���u,�v�j�}�^</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit62" value="�}�l��s"> 
                <input type="reset" name="Submit72" value="���m"> <input name="enews" type="hidden" value="UpdateAllInfoPlnum">              </td>
            </tr>
            <tr> 
              <td height="25" colspan="2"><font color="#666666">�����G��H����̪����׼ƻP��ڵ��׼Ƥ��ŮɨϥΡC</font></td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</form>
<form action="../ecmscom.php" method="get" name="form1" target="_blank" onsubmit="return confirm('�T�{�n��s?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=IfOtherInfo>
  <?=$ecms_hashur['form']?>
    <input name="from" type="hidden" id="from" value="ReHtml/DoUpdateData.php<?=$ecms_hashur['whehref']?>">
    <tr class="header"> 
      <td height="25"> <div align="center">��q��s�����챵</div></td>
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
                <input type="reset" name="Submit72" value="���m"> <input name="enews" type="hidden" value="ChangeInfoOtherLink"> 
              </td>
            </tr>
            <tr> 
              <td height="25" colspan="2"><font color="#666666">�ͱ������G���\�����Ӹ귽�A�D���n�ɽФťΡC</font></td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</form>
<form action="../ecmscom.php" method="POST" name="form1" onsubmit="return confirm('�T�{�n�M�z?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="IfClearBreakInfo">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> <div align="center">�M�z�h�l�H��</div></td>
    </tr>
    <tr> 
      <td width="20%" height="25" bgcolor="#FFFFFF">��ܭn�M�z���ƾڪ�</td>
      <td width="80%" bgcolor="#FFFFFF"><select name="tid" id="tid">
          <option value=''>------ ��ܼƾڪ� ------</option>
          <?=$cleartable?>
        </select>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit6" value="���W�M�z"> 
        <input name="enews" type="hidden" id="enews2" value="ClearBreakInfo"> </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25"><font color="#666666">����: ��ͦ��H�����e���ɴ��ܦp�U���~�ɨϥΥ��\��ӲM�z�h�l�H���G<br>
      �ͦ����e�����ܡuTable '*.phome_ecms_' doesn't exist......update ***_ecms_ set havehtml=1   where id='' limit 1�v�ɨϥΡC</font></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br>
</p>
</body>
</html>
<?php
db_close();
$empire=null;
?>
