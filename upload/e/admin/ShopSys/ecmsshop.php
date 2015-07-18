<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
$enews=$_POST['enews'];
if(empty($enews))
{
	$enews=$_GET['enews'];
}
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
hCheckEcmsRHash();
require("class/hShopSysFun.php");

if($enews=="SetShopSys")//商城參數設置
{
	ShopSys_set($_POST,$logininid,$loginin);
}
elseif($enews=="DdRetext")//後台訂單備註
{
	ShopSys_DdRetext($_POST,$logininid,$loginin);
}
elseif($enews=='EditPretotal')//修改訂單優惠價格
{
	ShopSys_EditPretotal($_POST,$logininid,$loginin);
}
elseif($enews=='DoCutMaxnum')//減少或還原庫存
{
	Shopsys_DoCutMaxnum($_POST,$logininid,$loginin);
}
else
{printerror("ErrorUrl","history.go(-1)");}
db_close();
$empire=null;
?>