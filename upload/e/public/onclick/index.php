<?php
require('../../class/connect.php');
require('../../class/db_sql.php');

if($public_r['onclicktype']==2)
{
	exit();
}

$link=db_connect();
$empire=new mysqlquery();
require('../../class/onclickfun.php');
$id=(int)$_GET['id'];
$classid=(int)$_GET['classid'];
$ztid=(int)$_GET['ztid'];
$enews=$_GET['enews'];
if($enews=='donews')//信息點擊
{
	InfoOnclick($classid,$id);
}
elseif($enews=='doclass')//欄目點擊
{
	ClassOnclick($classid);
}
elseif($enews=='dozt')//專題點擊
{
	ZtOnclick($ztid);
}
db_close();
$empire=null;
?>