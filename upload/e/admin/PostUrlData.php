<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"postdata");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>���{�o�G</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<a href="PostUrlData.php<?=$ecms_hashur['whehref']?>">���{�o�G</a></td>
  </tr>
</table>
<form name="form1" method="post" action="enews.php" onsubmit="return confirm('�T�{�n�o�G�H');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="2">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="6%" height="25"> <div align="center"></div></td>
      <td width="49%" height="25">����</td>
      <td width="45%" height="25">����</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"></div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>����] (/d)</strong></td>
      <td height="25" bgcolor="#DBEAF5">�s�����ؿ�</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="d/file!!!0">
        </div></td>
      <td height="25">�W�Ǫ���] (/d/file)</td>
      <td height="25">�t�ΤW�Ǫ�����s��ؿ�</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="d/js!!!0">
        </div></td>
      <td height="25">���@JS�] (/d/js)</td>
      <td height="25">�@��JS�]�A�s�iJS,�벼JS,�Ϥ��H��JS,�`�Ʀ�/�̷sJS��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="s!!!0">
        </div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>�M�D�] (/s)</strong></td>
      <td height="25" bgcolor="#DBEAF5">�M�D�s��ؿ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"></div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>�t�ΰʺA�][�P�ƾڮw����] (/e)</strong></td>
      <td height="25" bgcolor="#DBEAF5">�P�ƾڮw����D���]</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]3" value="search!!!0">
        </div></td>
      <td height="25">�H���j�����] (/search)</td>
      <td height="25">�H���j�����</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]5" value="e/pl!!!0">
        </div></td>
      <td height="25">�H�����ץ] (/e/pl)</td>
      <td height="25">�H�����׭���</td>
    </tr>
    <tr> 
      <td height="25"><div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="e/DoPrint!!!0">
        </div></td>
      <td height="25">�H�����L�](/e/DoPrint)</td>
      <td height="25">�H�����L����</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]6" value="e/data/template!!!0">
        </div></td>
      <td height="25">�|������O�ҪO�] (/e/data/template)</td>
      <td height="25">�|������O�ҪO</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]7" value="e/config/config.php,e/data/dbcache/class.php,e/data/dbcache/class1.php,e/data/dbcache/ztclass.php,e/data/dbcache/MemberLevel.php!!!1">
        </div></td>
      <td height="25">�w�s�] (/e/config/config.php,e/data/dbcache/class.php)</td>
      <td height="25">�t�γ]�m���@�ǰѼƽw�s</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"></div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>���I�ؿ��] (/)</strong></td>
      <td height="25" bgcolor="#DBEAF5">�H����ئs��ؿ�</td>
    </tr>
    <?php
	$sql=$empire->query("select classid,classurl,classname,classpath from {$dbtbpre}enewsclass where bclassid=0 order by classid desc");
	while($r=$empire->fetch($sql))
	{
	if($r[classurl])
	{
	$classurl=$r[classurl];
	}
	else
	{
	$classurl="../../".$r[classpath];
	}
	?>
    <tr> 
      <td height="25"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]10" value="<?=$r[classpath]?>!!!0">
        </div></td>
      <td height="25"><a href='<?=$classurl?>' target=_blank> 
        <?=$r[classname]?>
        </a>&nbsp;(/ 
        <?=$r[classpath]?>
        )</td>
      <td height="25"> 
        <?=$r[classurl]?>
      </td>
    </tr>
    <?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#DBEAF5"> <div align="center"> 
          <input name="postdata[]" type="checkbox" id="postdata[]" value="index<?=$public_r[indextype]?>!!!1">
        </div></td>
      <td height="25" bgcolor="#DBEAF5"><strong>���� (/index 
        <?=$public_r[indextype]?>
        )</strong></td>
      <td height="25" bgcolor="#DBEAF5">��������</td>
    </tr>
    <tr> 
      <td height="25"> <div align="center"> 
          <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
        </div></td>
      <td height="25"> <input type="submit" name="Submit" value="�}�l�o�G"> &nbsp;&nbsp; 
        <input type="button" name="Submit2" value="�]�mFTP�Ѽ�" onclick="javascript:window.open('SetEnews.php<?=$ecms_hashur['whehref']?>');"> 
        <input name="enews" type="hidden" id="enews" value="AddPostUrlData"></td>
      <td height="25">�C <input name="line" type="text" id="line" value="10" size="6">
        �Ӷ��ج��@��</td>
    </tr>
    <tr> 
      <td height="25" colspan="3"><div align="left">(�Ƶ��G���{�o�G�ҵo�O���ɶ������A�Э@�ߵ���.�̦n�N�{�ǹB��ɶ��]���̪�)</div></td>
    </tr>
  </table>
  <br>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
