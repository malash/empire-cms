<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//�����Ҷ�
//�O�_�n��
$user=islogin();
//�ɤJ�ҪO
require(ECMS_PATH.'e/template/member/card.php');
db_close();
$empire=null;
?>