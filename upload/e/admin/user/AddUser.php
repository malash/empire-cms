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
CheckLevel($logininid,$loginin,$classid,"user");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListUser.php".$ecms_hashur['whehref'].">�޲z�Τ�</a>&nbsp;>�W�[�Τ�";
if($enews=="EditUser")
{
	$userid=(int)$_GET['userid'];
	$r=$empire->fetch1("select username,adminclass,groupid,checked,styleid,filelevel,truename,email,classid from {$dbtbpre}enewsuser where userid='$userid'");
	$addur=$empire->fetch1("select equestion,openip from {$dbtbpre}enewsuseradd where userid='$userid'");
	$url="<a href=ListUser.php".$ecms_hashur['whehref'].">�޲z�Τ�</a>&nbsp;>�ק�Τ�G<b>".$r[username]."</b>";
	if($r[checked])
	{$checked=" checked";}
}
//-----------�Τ��
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsgroup order by groupid desc");
while($gr=$empire->fetch($sql))
{
	if($r[groupid]==$gr[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$gr[groupid].$select.">".$gr[groupname]."</option>";
}
//-----------��x�˦�
$stylesql=$empire->query("select styleid,stylename,path from {$dbtbpre}enewsadminstyle order by styleid");
$style="";
while($styler=$empire->fetch($stylesql))
{
	if($r[styleid]==$styler[styleid])
	{$sselect=" selected";}
	else
	{$sselect="";}
	$style.="<option value=".$styler[styleid].$sselect.">".$styler[stylename]."</option>";
}
//-----------����
$userclasssql=$empire->query("select classid,classname from {$dbtbpre}enewsuserclass order by classid");
$userclass='';
while($ucr=$empire->fetch($userclasssql))
{
	if($r[classid]==$ucr[classid])
	{$select=" selected";}
	else
	{$select="";}
	$userclass.="<option value='$ucr[classid]'".$select.">".$ucr[classname]."</option>";
}
//--------------------�ާ@�����
$fcfile="../../data/fc/ListEnews.php";
$fcjsfile="../../data/fc/cmsclass.js";
if(file_exists($fcjsfile)&&file_exists($fcfile))
{
	$class=GetFcfiletext($fcjsfile);
	$acr=explode("|",$r[adminclass]);
	$count=count($acr);
	for($i=1;$i<$count-1;$i++)
	{
		$class=str_replace("<option value='$acr[$i]'","<option value='$acr[$i]' selected",$class);
	}
}
else
{
	$class=ShowClass_AddClass($r[adminclass],"n",0,"|-",0,3);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�Τ�@</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
<form name="form1" method="post" action="ListUser.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�Τ� 
        <input name="userid" type="hidden" id="userid" value="<?=$userid?>"> <input name="oldusername" type="hidden" id="oldusername" value="<?=$r[username]?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="oldadminclass" type="hidden" id="oldadminclass" value="<?=$r[adminclass]?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="22%" height="25">�Τ�W�G</td>
      <td width="78%" height="25"><input name="username" type="text" id="username" value="<?=$r[username]?>" size="32">
        *</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�O�_�T��G</td>
      <td height="25"><input name="checked" type="checkbox" id="checked" value="1"<?=$checked?>>
        �O</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�K�X�G</td>
      <td height="25"><input name="password" type="password" id="password" size="32">
        * <font color="#666666">(���Q�ק�Яd��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ƱK�X�G</td>
      <td height="25"><input name="repassword" type="password" id="repassword" size="32">
        * <font color="#666666">(���Q�ק�Яd��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�w�����ݡG</td>
      <td height="25"> <select name="equestion" id="equestion">
          <option value="0"<?=$addur[equestion]==0?' selected':''?>>�L�w������</option>
          <option value="1"<?=$addur[equestion]==1?' selected':''?>>���˪��W�r</option>
          <option value="2"<?=$addur[equestion]==2?' selected':''?>>�ݷݪ��W�r</option>
          <option value="3"<?=$addur[equestion]==3?' selected':''?>>���˥X�ͪ�����</option>
          <option value="4"<?=$addur[equestion]==4?' selected':''?>>�z�䤤�@��Ѯv���W�r</option>
          <option value="5"<?=$addur[equestion]==5?' selected':''?>>�z�ӤH�p���������</option>
          <option value="6"<?=$addur[equestion]==6?' selected':''?>>�z�̳��w���\�]�W��</option>
          <option value="7"<?=$addur[equestion]==7?' selected':''?>>�r�p���Ӫ��̫�|��Ʀr</option>
        </select> <font color="#666666"> 
        <input name="oldequestion" type="hidden" id="oldequestion" value="<?=$addur[equestion]?>">
        (�p�G�ҥΦw�����ݡA�n���ɻݶ�J���������ؤ~��n��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�w���^���G</td>
      <td height="25"><input name="eanswer" type="text" id="eanswer" size="32"> 
        <font color="#666666">(�p�G�קﵪ�סA�Цb����J�s����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�m�W�G</td>
      <td height="25"><input name="truename" type="text" id="truename" value="<?=$r[truename]?>" size="32"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�l�c�G</td>
      <td height="25"><input name="email" type="text" id="email" value="<?=$r[email]?>" size="32"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�Τ��(*)�G</td>
      <td height="25"><select name="groupid" id="groupid">
          <?=$group?>
        </select> <input type="button" name="Submit62223222" value="�޲z�Τ��" onclick="window.open('ListGroup.php<?=$ecms_hashur['whehref']?>');">
        *</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݳ����G</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">�����t</option>
          <?=$userclass?>
        </select> <input type="button" name="Submit622232222" value="�޲z����" onclick="window.open('UserClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��x�˦�(*)�G</td>
      <td height="25"><select name="styleid" id="styleid">
          <?=$style?>
        </select> <input type="button" name="Submit6222322" value="�޲z��x�˦�" onclick="window.open('../template/AdminStyle.php<?=$ecms_hashur['whehref']?>');">
        *</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top"> <p><strong>�޲z����ثH���G</strong><br>
          <br>
          <input name="filelevel" type="checkbox" id="filelevel" value="1"<?=$r[filelevel]==1?' checked':''?>>
          ���Ω�����v��<br>
          <br>
          (�h�ӡA�Х�ctrl�C)</p></td>
      <td height="25" valign="top"> <select name="adminclass[]" size="12" multiple id="adminclassselect" style="width:270;">
          <?=$class?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'adminclassselect')">��������</a>] 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top"> �`�N�ƶ��G<font color="#FF0000">��ܤ���ط|���Ω�l��ءA�åB�p�G��ܤ���ءA�Фſ�ܨ�l���</font>)</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25"><strong>���\�n����x�� IP �C��:</strong><br>
        �u����޲z���B�󥻦C���� IP �a�}�ɤ~�i�H�n����x�A�C��H�~���a�}�X�ݱN���� IP �Q�T��.�C�� IP �@��A�J�i��J����a�}�A�]�i�u��J 
        IP �}�Y�A�Ҧp &quot;192.168.&quot;(���t�޸�) �i�ǰt 192.168.0.0��192.168.255.255 �d�򤺪��Ҧ��a�}�A�d�Ŭ�����</td>
      <td height="25"><textarea name="openip" cols="50" rows="8" id="openip"><?=$addur[openip]?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"><font color="#666666">�����G�K�X�]�m6��H�W�A�B�K�X����]�t�G$ 
        &amp; * # &lt; &gt; ' &quot; / \ % ; �Ů�</font></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
