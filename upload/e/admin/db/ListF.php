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
CheckLevel($logininid,$loginin,$classid,"f");
$tid=(int)$_GET['tid'];
$tbname=RepPostVar($_GET['tbname']);
if(!$tid||!$tbname)
{
	printerror("ErrorUrl","history.go(-1)");
}
$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListF.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�r�q�޲z</a>";
$sql=$empire->query("select * from {$dbtbpre}enewsf where tid='$tid' order by myorder,fid");
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
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmsmod.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <?=$ecms_hashur['form']?>
    <tr> 
      <td class="emenubutton"><input type="button" name="Submit2" value="�W�[�r�q" onclick="self.location.href='AddF.php?enews=AddF&tid=<?=$tid?>&tbname=<?=$tbname?><?=$ecms_hashur['ehref']?>';"></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="6%" height="25"><div align="center">����</div></td>
      <td width="8%"><div align="center">��</div></td>
      <td width="29%" height="25"><div align="center">�r�q�W</div></td>
      <td width="20%"><div align="center">�r�q����</div></td>
      <td width="15%"> <div align="center">�r�q����</div></td>
      <td width="8%"><div align="center">�Ķ���</div></td>
      <td width="14%" height="25"><div align="center">�ާ@</div></td>
    </tr>
    <?php
  	while($r=$empire->fetch($sql))
  	{
  		$ftype=$r[ftype];
  		if($r[flen])
  		{
			if($r[ftype]!="TEXT"&&$r[ftype]!="MEDIUMTEXT"&&$r[ftype]!="LONGTEXT"&&$r[ftype]!="DATE"&&$r[ftype]!="DATETIME")
			{
				$ftype.="(".$r[flen].")";
			}
  		}
  		if($r[iscj])
  		{$iscj="�O";}
  		else
  		{$iscj="�_";}
  		if($r[isadd])
  		{
  			$do="[<a href='AddF.php?tid=$tid&tbname=$tbname&enews=EditF&fid=".$r[fid].$ecms_hashur['ehref']."'>�ק�</a>]&nbsp;&nbsp;[<a href='../ecmsmod.php?tid=$tid&tbname=$tbname&enews=DelF&fid=".$r[fid].$ecms_hashur['href']."' onclick=\"return confirm('�T�{�n�R���H');\">�R��</a>]";
 		 }
  		else
  		{
  			$ftype="�t�Φr�q";
  			$r[f]="<a title='�t�Φr�q'><font color=red>".$r[f]."</font></a>";
  			$do="<a href='EditSysF.php?tid=$tid&tbname=$tbname&fid=".$r[fid].$ecms_hashur['ehref']."'><font color=red>[�ק�t�Φr�q]</font></a>";
  		}
  		if($r[tbdataf]==1)
  		{
  			$tbdataf=$r[isadd]?"<a href='ChangeDataTableF.php?tid=$tid&tbname=$tbname&fid=".$r[fid].$ecms_hashur['ehref']."' title='�I���N�r�q�ಾ��D��'>�ƪ�</a>":"�ƪ�";
  		}
  		else
  		{
			$tbdataf=$r[isadd]?"<a href='ChangeDataTableF.php?tid=$tid&tbname=$tbname&fid=".$r[fid].$ecms_hashur['ehref']."' title='�I���N�r�q�ಾ��ƪ�'>�D��</a>":"�D��";
  		}
  ?>
    <tr bgcolor="#ffffff" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"><div align="center"> 
          <input name="myorder[]" type="text" id="myorder[]" value="<?=$r[myorder]?>" size="3">
          <input type=hidden name=fid[] value=<?=$r[fid]?>>
        </div></td>
      <td><div align="center">
          <?=$tbdataf?>
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
      <td><div align="center"> 
          <?=$iscj?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$do?>
        </div></td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="ffffff"> 
      <td height="25">&nbsp;</td>
      <td height="25" colspan="6"><input type="submit" name="Submit" value="�ק�r�q����">
        <input name="enews" type="hidden" id="enews" value="EditFOrder"> <input name="tid" type="hidden" id="tid" value="<?=$tid?>"> 
        <input name="tbname" type="hidden" id="tbname" value="<?=$tbname?>"></td>
    </tr>
    <tr bgcolor="ffffff">
      <td height="25">&nbsp;</td>
      <td height="25" colspan="6"><font color="#666666">�����G���ǭȶV�p�V��ܫe���A����r�q�W���t�Φr�q�A�I���u�D��v/�u�ƪ�v�i�H�i��r�q�ಾ.</font></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
      <td><div align="center"> [<a href="javascript:window.close();">����</a>] </div></td>
    </tr>
  </table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
