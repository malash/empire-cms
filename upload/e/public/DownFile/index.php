<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//更ン
function DoDownFile($fileid){
	global $empire,$public_r,$class_r,$dbtbpre;
	if(empty($fileid))
	{
		printerror("ErrorUrl","history.go(-1)",1);
	}
	$r=$empire->fetch1("select fileid,path,filename,classid,fpath from {$dbtbpre}enewsfile_1 where fileid='$fileid'");
	if(empty($r[fileid]))
	{
		printerror("ErrorUrl","history.go(-1)",1);
	}
	//更计
	$sql=$empire->query("update {$dbtbpre}enewsfile_1 set onclick=onclick+1 where fileid='$fileid'");
	$ok=1;
	//逆ヘ
	$fspath=ReturnFileSavePath($r[classid],$r[fpath]);
	$filepath=$r[path]?$r[path].'/':$r[path];
	$downurl=$fspath['fileurl'].$filepath.$r[filename];
	if($ok)
	{
		Header("Location:$downurl");
	}
}
//更ン
$fileid=(int)$_GET['fileid'];
DoDownFile($fileid);
db_close();
$empire=null;
?>