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
if($enews=='donews')//�H���I��
{
	InfoOnclick($classid,$id);
}
elseif($enews=='doclass')//����I��
{
	ClassOnclick($classid);
}
elseif($enews=='dozt')//�M�D�I��
{
	ZtOnclick($ztid);
}
db_close();
$empire=null;
?>