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
//�Ѽ�
$returnform=RepPostVar($_GET['returnform']);
//��ؿ�
$openpath="../../data/face";
$hand=@opendir($openpath);
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��ܤ��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="56%">��m�G<a href="ChangePlfaceFile.php<?=$ecms_hashur['whehref']?>">��ܤ��</a></td>
    <td width="44%"><div align="right"> </div></td>
  </tr>
</table>
<form name="chfile" method="post" action="../enews.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <?=$ecms_hashur['eform']?>
    <tr class="header"> 
      <td height="25">���W (��e�ؿ��G<strong>/e/data/face/</strong>)</td>
    </tr>
    <?php
	while($file=@readdir($hand))
	{
		$truefile=$file;
		if($file=="."||$file=="..")
		{
			continue;
		}
		//�ؿ�
		if(is_dir($openpath."/".$file))
		{
			continue;
		}
		$filetype=GetFiletype($file);
		if(!strstr($ecms_config['sets']['tranpicturetype'],','.$filetype.','))
		{
			continue;
		}
	 ?>
    <tr> 
      <td width="88%" height="25"><a href="#ecms" onclick="<?=$returnform?>='<?=$truefile?>';window.close();" title="���"> 
        <img src="../../data/face/<?=$truefile?>" border=0>&nbsp;<?=$truefile?>
        </a></td>
    </tr>
    <?php
	}
	@closedir($hand);
	?>
  </table>
</form>
</body>
</html>