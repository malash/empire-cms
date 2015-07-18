<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

if(file_exists("install.off"))
{
	echo"《帝國網站管理系統》安裝程序已鎖定。如果要重新安裝，請刪除<b>/e/install/install.off</b>文件！";
	exit();
}

require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
require("../class/t_functions.php");
require("../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();

$ecms=$_GET['ecms'];
$defaultdata=$_GET['defaultdata'];

//----------------生成表情JS
function InstallGetPlfaceJs(){
	global $empire,$dbtbpre,$public_r;
	$r=$empire->fetch1("select plface,plfacenum from {$dbtbpre}enewspl_set limit 1");
	if(empty($r['plfacenum']))
	{
		return '';
	}
	$filename="../../d/js/js/plface.js";
	$facer=explode('||',$r['plface']);
	$count=count($facer);
	for($i=1;$i<$count-1;$i++)
	{
		if($i%$r['plfacenum']==0)
		{
			$br="<br>";
		}
		else
		{
			$br="&nbsp;";
		}
		$face=explode('##',$facer[$i]);
		$allface.="<a href='#eface' onclick=\\\"eaddplface('".$face[0]."');\\\"><img src='".$public_r[newsurl]."e/data/face/".$face[1]."' border=0></a>".$br;
	}
	$allface="document.write(\"<script src='".$public_r[newsurl]."e/data/js/addplface.js'></script>\");document.write(\"".$allface."\");";
	WriteFiletext_n($filename,$allface);
}

//更新其它數據
if($ecms=='ChangeInstallOtherData')
{
	//--- 刪除緩存文件 ---
	DelListEnews();
	//--- 更新動態頁面 ---
	GetPlTempPage();//評論列表模板
	GetPlJsPage();//評論JS模板
	ReCptemp();//控制面板模板
	GetSearch();//三搜索表單模板
	GetPrintPage();//打印模板
	GetDownloadPage();//下載地址頁面
	ReGbooktemp();//留言板模板
	ReLoginIframe();//登陸狀態模板
	ReSchAlltemp();//全站搜索模板
	//生成首頁
	$indextemp=GetIndextemp();
	NewsBq(0,$indextemp,1,0);
	//--- 更新反饋表單 ---
	$sql=$empire->query("select bid,btemp from {$dbtbpre}enewsfeedbackclass order by bid");
	while($r=$empire->fetch($sql))
	{
		//替換公共變量
		$btemp=ReplaceTempvar($r['btemp']);
		$btemp=str_replace("[!--cp.header--]","<?php include(\"../../data/template/cp_1.php\");?>",$btemp);
		$btemp=str_replace("[!--cp.footer--]","<?php include(\"../../data/template/cp_2.php\");?>",$btemp);
		$btemp=str_replace("[!--member.header--]","<?php include(\"../../template/incfile/header.php\");?>",$btemp);
		$btemp=str_replace("[!--member.footer--]","<?php include(\"../../template/incfile/footer.php\");?>",$btemp);
		$file="../tool/feedback/temp/feedback".$r[bid].".php";
		$btemp="<?php
if(!defined('InEmpireCMS'))
{exit();}
?>".$btemp;
		WriteFiletext($file,$btemp);
	}
	//--- 評論表情文件 ---
	InstallGetPlfaceJs();
	echo"更新文件完畢.<script>self.location.href='index.php?enews=success&f=6&defaultdata=$defaultdata';</script>";
	exit();
}
else//更新數據庫緩存
{
	GetConfig(1);//更新參數設置
	GetClass();//更新欄目
	GetMemberLevel();//更新會員組
	GetSearchAllTb();//更新全站搜索數據表
	echo"更新數據庫緩存完畢.<script>self.location.href='changedata.php?ecms=ChangeInstallOtherData&defaultdata=$defaultdata';</script>";
	exit();
}
?>