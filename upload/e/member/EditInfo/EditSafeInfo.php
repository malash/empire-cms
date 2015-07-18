<?php
require("../../class/connect.php");
require("../../class/q_functions.php");
require("../../class/db_sql.php");
require("../class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMods('member');//Ãö³¬¼Ò¶ô
$user=islogin();
$r=ReturnUserInfo($user[userid]);
//¾É¤J¼ÒªO
require(ECMS_PATH.'e/template/member/EditSafeInfo.php');
db_close();
$empire=null;
?>