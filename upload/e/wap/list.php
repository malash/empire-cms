<?php
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/q_functions.php");
require("../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
define('WapPage','list');
$usewapstyle='';
$wapstyle=0;
$pr=array();
require("wapfun.php");

//���ID
$classid=(int)$_GET['classid'];
if(!$classid||!$class_r[$classid]['tbname']||InfoIsInTable($class_r[$classid]['tbname']))
{
	DoWapShowMsg('�z�Ӧ۪��챵���s�b','index.php?style='.$wapstyle);
}
$pagetitle=$class_r[$classid]['classname'];

$bclassid=(int)$_GET['bclassid'];
$search='';
$add='';
if($class_r[$classid]['islast'])
{
	$add.="classid='$classid'";
}
else
{
	$where=ReturnClass($class_r[$classid][sonclass]);
	$add.="(".$where.")";
}
$modid=$class_r[$classid][modid];
//�u��
$yhid=$class_r[$classid][yhid];
$yhvar='qlist';
$yhadd='';
if($yhid)
{
	$yhadd=ReturnYhSql($yhid,$yhvar,1);
}
$search.="&classid=$classid&style=$wapstyle&bclassid=$bclassid";

$page=intval($_GET['page']);
$page=RepPIntvar($page);
$line=$pr['waplistnum'];//�C����ܰO����
$offset=$page*$line;
$query="select ".ReturnSqlListF($modid)." from {$dbtbpre}ecms_".$class_r[$classid]['tbname']." where ".$yhadd.$add;
$totalnum=intval($_GET['totalnum']);
if($totalnum<1)
{
	$totalquery="select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid]['tbname']." where ".$yhadd.$add;
	$num=$empire->gettotal($totalquery);//���o�`����
}
else
{
	$num=$totalnum;
}
$search.="&totalnum=$num";
//�Ƨ�
if(empty($class_r[$classid][reorder]))
{
	$addorder="newstime desc";
}
else
{
	$addorder=$class_r[$classid][reorder];
}
$query.=" order by ".ReturnSetTopSql('list').$addorder." limit $offset,$line";
$sql=$empire->query($query);
$returnpage=DoWapListPage($num,$line,$page,$search);
//�t�μҫ�
$ret_r=ReturnAddF($modid,2);
//�Ѽ�
$ecmsvar_mbr=array();
$ecmsvar_mbr['wapstyle']=$wapstyle;
$ecmsvar_mbr['fbclassid']=$bclassid;
$ecmsvar_mbr['fclassid']=$classid;
$ecmsvar_mbr['fcpage']=$page;
$ecmsvar_mbr['urladdcs']=ewap_UrlAddCs();

require('template/'.$usewapstyle.'/list.temp.php');
db_close();
$empire=null;
?>