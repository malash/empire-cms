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

$modid=(int)$_GET['modid'];
$msql=$empire->query("select mid,mname,searchvar from {$dbtbpre}enewsmod order by mid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�j���r�q�C��</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G�j���r�q�C��</td>
  </tr>
</table>
<br>
<?php
while($mr=$empire->fetch($msql))
{
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#698CC3" id=m<?=$mr[mid]?>>
  <tr> 
    <td><div align="center"><b><font color=ffffff> 
        <?=$mr[mname]?>
        </font></b></div></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <?php
	$r=explode(",",$mr[searchvar]);
	$count=count($r)-1;
	for($i=1;$i<$count;$i++)
	{
	?>
        <tr> 
          <td><div align="center"><b> </b> 
              <input name="textfield" type="text" value="<?=$r[$i]?>">
            </div></td>
        </tr>
        <?php
		}
		?>
      </table></td>
  </tr>
    <tr> 
    <td><div align="center"><b><font color=ffffff> 
        <input name="textfield2" type="text" value="<?=substr($mr[searchvar],1,strlen($mr[searchvar])-2);?>" size="36">
        
        </font></b></div></td>
  </tr>
</table>
<br>
<?php
}
?>
</body>
</html>
<?php
db_close();
$empire=null;
?>