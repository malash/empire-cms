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
CheckLevel($logininid,$loginin,$classid,"ztf");
$url="<a href='ListZt.php".$ecms_hashur['whehref']."'>�޲z�M�D</a>&nbsp;>&nbsp;<a href='ListZtF.php".$ecms_hashur['whehref']."'>�޲z�M�D�r�q</a>";
$sql=$empire->query("select * from {$dbtbpre}enewsztf order by myorder,fid");
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
        <input type="button" name="Submit2" value="�W�[�M�D�r�q" onclick="self.location.href='AddZtF.php?enews=AddZtF<?=$ecms_hashur['ehref']?>';">
		&nbsp;&nbsp;
		<input type="button" name="Submit2" value="�޲z�M�D" onclick="self.location.href='ListZt.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmsclass.php" onsubmit="return confirm('�T�{�n�ާ@?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="6%" height="25"><div align="center">����</div></td>
      <td width="27%" height="25">
<div align="center">�r�q�W</div></td>
      <td width="27%">
<div align="center">�r�q����</div></td>
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
          <input name="myorder[]" type="text" id="myorder[]" value="<?=$r[myorder]?>" size="3">
          <input type=hidden name=fid[] value=<?=$r[fid]?>>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[f]?>
        </div></td>
      <td><div align="center"> 
          <?=$r[fname]?>
        </div></td>
      <td><div align="center">
	  	  <?=$ftype?>
	  </div></td>
      <td height="25"><div align="center"> 
         [<a href='AddZtF.php?enews=EditZtF&fid=<?=$r[fid]?><?=$ecms_hashur['ehref']?>'>�ק�</a>]&nbsp;&nbsp;[<a href='../ecmsclass.php?enews=DelZtF&fid=<?=$r[fid]?><?=$ecms_hashur['href']?>' onclick="return confirm('�T�{�n�R��?');">�R��</a>]
        </div></td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="ffffff"> 
      <td height="25">&nbsp;</td>
      <td height="25" colspan="4"><input type="submit" name="Submit" value="�ק�r�q����">
        <font color="#666666">(�ȶV�p�V�e��)</font> 
        <input name="enews" type="hidden" id="enews" value="EditZtFOrder"> 
      </td>
    </tr>
  </table>
</form>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
  <tr class="header">
    <td height="25">�r�q�եλ���</td>
  </tr>
  <tr>
    <td height="25" bgcolor="#FFFFFF">�ϥΤ��m�եαM�D�۩w�q�r�q��ơGReturnZtAddField(�M�DID,�r�q�W)�A�M�DID=0����e�M�DID�C���h�Ӧr�q���e�i�γr���j�}�A�Ҥl�G<br>
      ���o'classtext'�r�q���e�G$value=ReturnZtAddField(0,'classtext'); //$value�N�O�r�q���e�C<br>
      ���o�h�Ӧr�q���e�G$value=ReturnZtAddField(1,'ztid,classtext'); //$value['classtext']�~�O�r�q���e�C</td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
