<?php
require("../../class/connect.php");
require("../../class/q_functions.php");
require("../../class/db_sql.php");
require("../../data/dbcache/class.php");
require("../class/ShopSysFun.php");
eCheckCloseMods('shop');//Ãö³¬¼Ò¶ô
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//¾É¤J¼ÒªO
require(ECMS_PATH.'e/template/ShopSys/buycar.php');
db_close();
$empire=null;
?>