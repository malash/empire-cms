<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

if(file_exists("install.off"))
{
	echo"�m�Ұ�����޲z�t�Ρn�w�˵{�Ǥw��w�C�p�G�n���s�w�ˡA�ЧR��<b>/e/install/install.off</b>���I";
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

//----------------�ͦ���JS
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

//��s�䥦�ƾ�
if($ecms=='ChangeInstallOtherData')
{
	//--- �R���w�s��� ---
	DelListEnews();
	//--- ��s�ʺA���� ---
	GetPlTempPage();//���צC��ҪO
	GetPlJsPage();//����JS�ҪO
	ReCptemp();//����O�ҪO
	GetSearch();//�T�j�����ҪO
	GetPrintPage();//���L�ҪO
	GetDownloadPage();//�U���a�}����
	ReGbooktemp();//�d���O�ҪO
	ReLoginIframe();//�n�����A�ҪO
	ReSchAlltemp();//�����j���ҪO
	//�ͦ�����
	$indextemp=GetIndextemp();
	NewsBq(0,$indextemp,1,0);
	//--- ��s���X��� ---
	$sql=$empire->query("select bid,btemp from {$dbtbpre}enewsfeedbackclass order by bid");
	while($r=$empire->fetch($sql))
	{
		//�������@�ܶq
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
	//--- ���ת���� ---
	InstallGetPlfaceJs();
	echo"��s��󧹲�.<script>self.location.href='index.php?enews=success&f=6&defaultdata=$defaultdata';</script>";
	exit();
}
else//��s�ƾڮw�w�s
{
	GetConfig(1);//��s�ѼƳ]�m
	GetClass();//��s���
	GetMemberLevel();//��s�|����
	GetSearchAllTb();//��s�����j���ƾڪ�
	echo"��s�ƾڮw�w�s����.<script>self.location.href='changedata.php?ecms=ChangeInstallOtherData&defaultdata=$defaultdata';</script>";
	exit();
}
?>