<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"dbdata");
//�q�{�ƾڮw
if(!empty($public_r['ebakthisdb'])){
	echo"������q�{���ƾڮw,�еy��......<script>self.location.href='ChangeTable.php?mydbname=".$ecms_config['db']['dbname'].$ecms_hashur['ehref']."'</script>";
	exit();
}
$sql=$empire->query("SHOW DATABASES");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��ܼƾڮw</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function DoDrop(dbname)
{var ok;
ok=confirm("�T�{�n�R�����ƾڮw?");
if(ok)
{
self.location.href='phome.php?<?=$ecms_hashur['href']?>&phome=DropDb&mydbname='+dbname;
}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G�ƥ��ƾ� -&gt; <a href="ChangeDb.php<?=$ecms_hashur['whehref']?>">��ܼƾڮw</a></td>
  </tr>
  <tr>
    <td height="25"><div align="center">�ƥ��B�J�G<font color="#FF0000">��ܼƾڮw</font> 
        -&gt; ��ܭn�ƥ����� -&gt; �}�l�ƥ� -&gt; ����</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="60%" height="25"> 
      <div align="center">�ƾڮw�W</div></td>
    <td width="40%" height="25"> 
      <div align="center">�ƥ�</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  if($r[0]==$ecms_config['db']['dbname'])
  {
  $bgcolor="#DBEAF5";
  }
  else
  {
  $bgcolor="#FFFFFF";
  }
  ?>
  <tr bgcolor="<?=$bgcolor?>"> 
    <td height="25"> 
      <div align="center"><?=$r[0]?></div></td>
    <td height="25"> 
      <div align="center"> 
        <input type="button" name="Submit" value="�ƥ��ƾ�" onclick="self.location.href='ChangeTable.php?mydbname=<?=$r[0]?><?=$ecms_hashur['ehref']?>';">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Submit3" value="�R���ƾڮw" onclick="javascript:DoDrop('<?=$r[0]?>')">
      </div></td>
  </tr>
  <?php
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="2"><form name="form1" method="post" action="phome.php">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
		<?=$ecms_hashur['form']?>
          <tr class="header"> 
            <td height="25">�إ߼ƾڮw
              <input name="phome" type="hidden" id="phome" value="CreateDb">
              </td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">�ƾڮw�W�G 
              <input name="mydbname" type="text" id="mydbname">
              <select name="mydbchar" id="mydbchar">
                <option value="">�q�{�s�X</option>
                <option value="gbk">gbk</option>
                <option value="utf8">utf8</option>
                <option value="gb2312">gb2312</option>
                <option value="big5">big5</option>
				<option value="latin1">latin1</option>
              </select> 
              <input type="submit" name="Submit2" value="�إ�">
            </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>
