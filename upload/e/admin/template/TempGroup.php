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
CheckLevel($logininid,$loginin,$classid,"tempgroup");
$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
	include("../../class/tempfun.php");
}
if($enews=="LoadInTempGroup")//�ɤJ
{
	include "../".LoadLang("pub/fun.php");
	$file=$_FILES['file']['tmp_name'];
    $file_name=$_FILES['file']['name'];
    $file_type=$_FILES['file']['type'];
    $file_size=$_FILES['file']['size'];
	LoadInTempGroup($_POST,$file,$file_name,$file_type,$file_size,$logininid,$loginin);
}
elseif($enews=="LoadTempGroup")//�ɥX
{
	LoadTempGroup($_POST,$logininid,$loginin);
}
elseif($enews=="EditTempGroup")//�ק�
{
	EditTempGroup($_POST,$logininid,$loginin);
}
elseif($enews=="DefTempGroup")//�q�{
{
	DefTtempGroup($_POST,$logininid,$loginin);
}
elseif($enews=="DelTempGroup")//�R��
{
	DelTempGroup($_POST,$logininid,$loginin);
}
else
{}
$sql=$empire->query("select gid,gname,isdefault from {$dbtbpre}enewstempgroup order by gid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ҪO�պ޲z</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckDel(gid){
	var ok=confirm("�T�{�n�R��?");
	if(ok)
	{
		self.location.href='TempGroup.php?<?=$ecms_hashur['href']?>&enews=DelTempGroup&gid='+gid;
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="TempGroup.php<?=$ecms_hashur['whehref']?>">�ҪO�պ޲z</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center">
  <tr>
    <td width="48%" valign="top"> 
      <table width="93%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
	  <form name=tempgroup method=post action=TempGroup.php onsubmit="return confirm('�T�{�n����?');">
	  <?=$ecms_hashur['form']?>
      <input type=hidden name=enews value=EditTempGroup>
        <tr class="header"> 
          <td width="10%" height="25"> <div align="center"></div></td>
          <td width="90%" height="25">�ҪO�զW��</td>
        </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  	$tempgroup_options.="<option value='".$r['gid']."'>".$r['gname']."</option>";
  	$bgcolor="#FFFFFF";
	$checked="";
	$movejs=' onmouseout="this.style.backgroundColor=\'#ffffff\'" onmouseover="this.style.backgroundColor=\'#C3EFFF\'"';
  	if($r['isdefault'])
	{
		$bgcolor="#DBEAF5";
		$checked=" checked";
		$movejs='';
	}
  ?>
          <input type=hidden name=gid[] value=<?=$r[gid]?>>
          <tr bgcolor="<?=$bgcolor?>"<?=$movejs?>> 
            <td height="25"> <div align="center"> 
                <input type="radio" name="changegid" value="<?=$r[gid]?>"<?=$checked?>>
              </div></td>
            <td height="25"> <input name="gname[]" type="text" id="gname[]" value="<?=$r[gname]?>" size="30">(ID�G<?=$r[gid]?>) 
            </td>
          </tr>
  <?php
  }
  ?>
  		  <tr bgcolor="#FFFFFF"> 
            <td height="25">&nbsp;</td>
            <td height="25"><input type="submit" name="Submit3" value="�ק�" onclick="document.tempgroup.enews.value='EditTempGroup';">&nbsp; 
              <input type="submit" name="Submit4" value="�]���q�{" onclick="document.tempgroup.enews.value='DefTempGroup';">&nbsp;
              <input type="submit" name="Submit6" value="�ɥX" onclick="document.tempgroup.enews.value='LoadTempGroup';">&nbsp;
              <input type="submit" name="Submit7" value="�R��" onclick="document.tempgroup.enews.value='DelTempGroup';">&nbsp; 
              <input type="reset" name="Submit5" value="���m">
            </td>
          </tr>
  		</form>
      </table>
    </td>
    <td width="52%" valign="top"> 
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form action=TempGroup.php method=post enctype="multipart/form-data" name=loadform onsubmit="return confirm('�T�{�n����?');">
		<?=$ecms_hashur['form']?>
          <input type=hidden name=enews value=LoadInTempGroup>
          <tr class="header"> 
            <td height="25" colspan="2">�ɤJ�ҪO��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="24%" height="32">�W�ǼҪO���</td>
            <td width="76%"> <input type="file" name="file">
              <font color="#666666">(*.temp���)</font></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">�ҪO�s�X</td>
            <td> <input name="ChangeChar" type="checkbox" id="ChangeChar" value="1" onclick="if(this.checked){changechardiv.style.display='';}else{changechardiv.style.display='none';}">
              �ҪO�ݭn��s�X &nbsp;&nbsp;<font color="#666666">(��e���I�s�X�G<b><?=$ecms_config['sets']['pagechar']?></b>)</font></td>
          </tr>
          <tr bgcolor="#FFFFFF" id="changechardiv" style="display:none">
            <td height="32">&nbsp;</td>
            <td> �n�ɤJ���ҪO�s�X: 
              <select name="tempchar" id="tempchar">
                <option value="GB2312">²��GB2312</option>
                <option value="UTF8">²��UTF-8</option>
                <option value="BIG5">�c��BIG5</option>
                <option value="TCUTF8">�c��UTF-8</option>
              </select>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">�л\�ҪO��</td>
            <td> <select name="gid" id="gid">
                <option value="0">�s�طs���ҪO��</option>
                <?=$tempgroup_options?>
              </select> </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="32">&nbsp;</td>
            <td height="25"> <input type="submit" name="Submit" value="�� �J">
              &nbsp;&nbsp; </td>
          </tr>
        </form>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td height="25"><font color="#666666">�d�ݷ��ҪO�s�X�ޥ��G�ΰO�ƥ����}.temp���A�M��j���u<strong>charset=</strong>�v�N��d�ݽs�X</font></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>