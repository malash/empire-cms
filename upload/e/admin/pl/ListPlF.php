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
CheckLevel($logininid,$loginin,$classid,"plf");
$url="<a href=ListAllPl.php".$ecms_hashur['whehref'].">�޲z����</a>&nbsp;>&nbsp;<a href=ListPlF.php".$ecms_hashur['whehref'].">�޲z���צ۩w�q�r�q</a>";
$sql=$empire->query("select * from {$dbtbpre}enewsplf order by fid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�r�q</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">��m�G 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit2" value="�W�[�r�q" onclick="self.location.href='AddPlF.php?enews=AddPlF<?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmspl.php" onsubmit="return confirm('�T�{�n�ާ@?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="27%" height="25"> <div align="center">�r�q�W</div></td>
      <td width="27%"> <div align="center">�r�q����</div></td>
      <td width="23%"><div align="center">�r�q����</div></td>
      <td width="17%" height="25"><div align="center">�ާ@</div></td>
    </tr>
    <?php
  while($r=$empire->fetch($sql))
  {
  	$ftype=$r[ftype];
  	if($r[flen])
	{
		if($r[ftype]!="TEXT"&&$r[ftype]!="MEDIUMTEXT"&&$r[ftype]!="LONGTEXT")
		{
			$ftype.="(".$r[flen].")";
		}
	}
  ?>
    <tr bgcolor="ffffff"> 
      <td height="25"><div align="center"> 
          <?=$r[f]?>
        </div></td>
      <td><div align="center"> 
          <?=$r[fname]?>
        </div></td>
      <td><div align="center"> 
          <?=$ftype?>
        </div></td>
      <td height="25"><div align="center"> [<a href='AddPlF.php?enews=EditPlF&fid=<?=$r[fid]?><?=$ecms_hashur['ehref']?>'>�ק�</a>]&nbsp;&nbsp;[<a href='../ecmspl.php?enews=DelPlF&fid=<?=$r[fid]?><?=$ecms_hashur['href']?>' onclick="return confirm('�T�{�n�R��?');">�R��</a>] 
        </div></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
