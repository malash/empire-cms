<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../member/class/user.php");
eCheckCloseMods('pay');//�����Ҷ�
$link=db_connect();
$empire=new mysqlquery();
//�O�_�n��
$user=islogin();
$pr=$empire->fetch1("select paymoneytofen,payminmoney from {$dbtbpre}enewspublic limit 1");
$paysql=$empire->query("select payid,paytype,payfee,paysay,payname from {$dbtbpre}enewspayapi where isclose=0 order by myorder,payid");
$pays='';
while($payr=$empire->fetch($paysql))
{
	$pays.="<option value='".$payr[payid]."'>".$payr[payname]."</option>";
}
//�ɤJ�ҪO
require(ECMS_PATH.'e/template/payapi/payapi.php');
db_close();
$empire=null;
?>