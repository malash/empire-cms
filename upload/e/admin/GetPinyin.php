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
hCheckEcmsRHash();
db_close();
$empire=null;

//���o�~�r
$hz=ehtmlspecialchars($_GET['hz']);
$returnform=RepPostVar($_GET['returnform']);
if(empty($hz)||empty($returnform))
{
	echo"<script>alert('�S��J�~�r!');window.close();</script>";
	exit();
}

$py=ReturnPinyinFun($hz);
?>
<script>
<?=$returnform?>="<?=$py?>";
window.close();
</script>
