<?php
require("../../class/connect.php");
require("../../class/q_functions.php");
require("../../class/db_sql.php");
require("../../data/dbcache/class.php");
require("../class/ShopSysFun.php");
eCheckCloseMods('shop');//關閉模塊
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//導入模板
require(ECMS_PATH.'e/template/ShopSys/buycar.php');
db_close();
$empire=null;
?>