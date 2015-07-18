<?php
//返回編碼
function InstallReturnDbChar(){
	if(EmpireCMS_CHARVER=='UTF-8')//簡體UTF-8
	{
		$ret_r['dbchar']='utf8';
		$ret_r['setchar']='utf8';
		$ret_r['headerchar']='utf-8';
	}
	elseif(EmpireCMS_CHARVER=='BIG5')//繁體BIG5
	{
		$ret_r['dbchar']='big5';
		$ret_r['setchar']='big5';
		$ret_r['headerchar']='big5';
	}
	elseif(EmpireCMS_CHARVER=='TC-UTF-8')//繁體UTF-8
	{
		$ret_r['dbchar']='utf8';
		$ret_r['setchar']='utf8';
		$ret_r['headerchar']='utf-8';
	}
	else//簡體GBK
	{
		$ret_r['dbchar']='gbk';
		$ret_r['setchar']='gbk';
		$ret_r['headerchar']='gb2312';
	}
	return $ret_r;
}

//取得隨機數
function InstallMakePassword($pw_length){
	$low_ascii_bound=65;
	$upper_ascii_bound=90;
	$notuse=array(58,59,60,61,62,63,64,91,92,93,94,95,96,108,111);
	while($i<$pw_length)
	{
		if(PHP_VERSION<'4.2.0')
		{
			mt_srand((double)microtime()*1000000);
		}
		$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
		if(!in_array($randnum,$notuse))
		{
			$password1=$password1.chr($randnum);
			$i++;
		}
	}
	return $password1;
}
//函數是否存在
function HaveFun($fun){
	if(function_exists($fun))
	{
		$word="支持";
	}
	else
	{
		$word="不支持";
	}
	return $word;
}
//返回符號
function ReturnResult($st){
	if($st==1)
	{
		$w="√";
	}
	elseif($st==2)
	{
		$w="---";
	}
	else
	{
		$w="<font color=red>×</font>";
	}
	return $w;
}
//取得php版本
function GetPhpVer(){
	$r['ver']=PHP_VERSION;
	if($r['ver'])
	{
		$r['result']=($r['ver']<"4.2.3")?ReturnResult(0):ReturnResult(1);
	}
	else
	{
		$r['ver']="---";
		$r['result']=ReturnResult(2);
	}
	return $r;
}
//取得php運行模式
function GetPhpMod(){
	$mod=strtoupper(php_sapi_name());
	if(empty($mod))
	{
		$mod="---";
	}
	return $mod;
}
//是否運行於安全模式
function GetPhpSafemod(){
	$phpsafemod=get_cfg_var("safe_mode");
	if($phpsafemod==1)
	{
		$r['word']="是";
		$r['result']=ReturnResult(0);
	}
	else
	{
		$r['word']="否";
		$r['result']=ReturnResult(1);
	}
	return $r;
}
//是否支持mysql
function CanMysql(){
	$r['can']=HaveFun("mysql_connect");
	$r['result']=$r[can]=="支持"?ReturnResult(1):ReturnResult(0);
	return $r;
}
//取得mysql版本
function GetMysqlVer(){
	$r['ver']=@mysql_get_server_info();
	if(empty($r['ver']))
	{
		$r['ver']="---";
		$r['result']=ReturnResult(2);
	}
	else
	{
		$r['result']=ReturnResult(1);
	}
	return $r;
}
//取得mysql版本(數據庫)
function GetMysqlVerForDb(){
	$sql=mysql_query("select version() as version");
	$r=mysql_fetch_array($sql);
	return ReturnMysqlVer($r['version']);
}
//返回mysql版本
function ReturnMysqlVer($dbver){
	if(empty($dbver))
	{
		return '';
	}
	if($dbver>='6.0')
	{
		$dbver='6.0';
	}
	elseif($dbver>='5.0')
	{
		$dbver='5.0';
	}
	elseif($dbver>='4.1')
	{
		$dbver='4.1';
	}
	else
	{
		$dbver='4.0';
	}
	return $dbver;
}
//取得操作系統
function GetUseSys(){
	$phpos=explode(" ",php_uname());
	$sys=$phpos[0]."&nbsp;".$phpos[1];
	if(empty($phpos[0]))
	{
	$sys="---";
	}
	return $sys;
}
//是否支持zend
function GetZend(){
	@ob_start();
	@include("data/zend.php");
	$string=@ob_get_contents();
	@ob_end_clean();
	if($string=="www.phome.net"||strstr($string,"bytes in"))
	{
		$r['word']="支持";
		$r['result']=ReturnResult(1);
	}
	else
	{
		$r['word']="不支持";
		$r['result']=ReturnResult(0);
	}
	return $r;
}
//檢查上傳
function CheckTranMode(){
	@ob_start();
	@include("../class/connect.php");
	@include("../class/functions.php");
	$string=@ob_get_contents();
	@ob_end_clean();
	if(strstr($string,"bytes in"))
	{
		echo"您沒有二進制上傳文件！請重新二進制上傳文件，然後再安裝。";
		exit();
	}
}
//是否支持採集
function GetCj(){
	$cj=get_cfg_var("allow_url_fopen");
	if($cj==1)
	{
		$r['word']="支持";
		$r['result']=ReturnResult(1);
	}
	else
	{
		$r['word']="不支持";
		$r['result']=ReturnResult(0);
	}
	return $r;
}
//測試採集
function TestCj(){
	$r=@file("http://www.163.com");
	if($r[5])
	{
		echo"<br>測試結果：<b>支持採集</b>";
	}
	else
	{
		echo"<br>測試結果：<b>不支持採集</b>";
	}
	exit();
}
//是否支持gd庫
function GetGd(){
	$r['can']=HaveFun("gd_info");
	$r['result']=$r[can]=="支持"?ReturnResult(1):ReturnResult(0);
	return $r;
}
//是否支持ICONV庫
function GetIconv(){
	$r['can']=HaveFun("iconv");
	$r['result']=$r[can]=="支持"?ReturnResult(1):ReturnResult(0);
	return $r;
}

//提示信息
function InstallShowMsg($msg,$url=''){
	if(empty($url))
	{
		echo"<script>alert('".$msg."');history.go(-1);</script>";
	}
	else
	{
		echo"<script>alert('".$msg."');self.location.href='$url';</script>";
	}
	exit();
}
//返回目錄權限結果
function ReturnPathLevelResult($path){
	$testfile=$path."/test.test";
	$fp=@fopen($testfile,"wb");
	if($fp)
	{
		@fclose($fp);
		@unlink($testfile);
		return 1;
	}
	else
	{
		return 0;
	}
}
//返回文件權限結果
function ReturnFileLevelResult($filename){
	return is_writable($filename);
}
//檢測目錄權限
function CheckFileMod($filename,$smallfile=""){
	$succ="√";
	$error="<font color=red>×</font>";
	if(!file_exists($filename)||($smallfile&&!file_exists($smallfile)))
	{
		return $error;
	}
	if(is_dir($filename))//目錄
	{
		if(!ReturnPathLevelResult($filename))
		{
			return $error;
		}
		//子目錄
		if($smallfile)
		{
			if(is_dir($smallfile))
			{
				if(!ReturnPathLevelResult($smallfile))
				{
					return $error;
				}
			}
			else//文件
			{
				if(!ReturnFileLevelResult($smallfile))
				{
					return $error;
				}
			}
		}
	}
	else//文件
	{
		if(!ReturnFileLevelResult($filename))
		{
			return $error;
		}
		if($smallfile)
		{
			if(!ReturnFileLevelResult($smallfile))
			{
				return $error;
			}
		}
	}
	return $succ;
}
//信息
function InstallSuccessShowInfo(){
	$time=time();
	$chkey='ta1-pb2h-b8ot-ftm87ep-fhng-ftt';
	$key=md5($chkey.md5($time));
	$getver=base64_encode("empirecms,".EmpireCMS_VERSION.",".EmpireCMS_CHARVER.",".EmpireCMS_LASTTIME.",".$_SERVER['HTTP_HOST'].",".$_SERVER['REMOTE_ADDR'].",".urlencode($_SERVER['PHP_SELF'])."");
	$dourl="http://ecmsuser.phome.net/empirecmsupdate/?ecms=EmpireCMSUpdate&time=$time&key=$key&ver=$getver";
	echo'<img src="'.$dourl.'" width="0" height="0">';
}
//建表
function DoCreateTable($sql,$mysqlver,$dbcharset){
	$type=strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU","\\2",$sql));
	$type=in_array($type,array('MYISAM','HEAP'))?$type:'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU","\\1",$sql).
		($mysqlver>='4.1'?" ENGINE=$type DEFAULT CHARSET=$dbcharset":" TYPE=$type");
}
//運行SQL
function DoRunQuery($sql,$mydbchar,$mydbtbpre,$mydbver){
	$sql=str_replace("\r","\n",str_replace(' `phome_',' `'.$mydbtbpre,$sql));
	$ret=array();
	$num=0;
	foreach(explode(";\n",trim($sql)) as $query)
	{
		$queries=explode("\n",trim($query));
		foreach($queries as $query)
		{
			$ret[$num].=$query[0]=='#'||$query[0].$query[1]=='--'?'':$query;
		}
		$num++;
	}
	unset($sql);
	foreach($ret as $query)
	{
		$query=trim($query);
		if($query)
		{
			if(substr($query,0,12)=='CREATE TABLE')
			{
				$name=preg_replace("/CREATE TABLE `([a-z0-9_]+)` .*/is","\\1",$query);
				echo"建立數據表: <b>".$name."</b> 完畢......<br>";
				mysql_query(DoCreateTable($query,$mydbver,$mydbchar)) or die(mysql_error()."<br>".$query);
			}
			else
			{
				mysql_query($query) or die(mysql_error()."<br>".$query);
			}
		}
	}
}

//password
function ins_DoEmpireCMSAdminPassword($password,$salt,$salt2){
	$pw=md5($salt2.'E!m^p-i(r#e.C:M?S'.md5(md5($password).$salt).'d)i.g^o-d'.$salt);
	return $pw;
}

//取得隨機數
function ins_make_password($pw_length){
	$low_ascii_bound=48;
	$upper_ascii_bound=122;
	$notuse=array(58,59,60,61,62,63,64,91,92,93,94,95,96);
	while($i<$pw_length)
	{
		if(PHP_VERSION<'4.2.0')
		{
			mt_srand((double)microtime()*1000000);
		}
		$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
		if(!in_array($randnum,$notuse))
		{
			$password1=$password1.chr($randnum);
			$i++;
		}
	}
	return $password1;
}
//取得IP
function ins_egetip(){
	if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')) 
	{
		$ip=getenv('HTTP_CLIENT_IP');
	} 
	elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown'))
	{
		$ip=getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown'))
	{
		$ip=getenv('REMOTE_ADDR');
	}
	elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown'))
	{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	$ip=addslashes(preg_replace("/^([\d\.]+).*/","\\1",$ip));
	return $ip;
}

//取得端口
function ins_egetipport(){
	$ipport=(int)$_SERVER['REMOTE_PORT'];
	return $ipport;
}

//初使化管理員
function FirstAdmin($add){
	if(!trim($add['username'])||!trim($add['password']))
	{
		InstallShowMsg('請輸入管理員用戶名與密碼');
	}
	if($add['password']!=$add['repassword'])
	{
		InstallShowMsg('兩次輸入的密碼不一致，請重新輸入');
	}
	//鏈接數據庫
	@include("../config/config.php");
	$dbver=InstallConnectDb($ecms_config['db']['dbver'],$ecms_config['db']['dbserver'],$ecms_config['db']['dbport'],$ecms_config['db']['dbusername'],$ecms_config['db']['dbpassword'],$ecms_config['db']['dbname'],$ecms_config['db']['setchar'],$ecms_config['db']['dbchar']);
	$salt=ins_make_password(8);
	$salt2=ins_make_password(20);
	$username=addslashes($add['username']);
	$password=ins_DoEmpireCMSAdminPassword($add['password'],$salt,$salt2);
	$rnd=ins_make_password(20);
	$userprikey=ins_make_password(48);
	$addtime=time();
	$addip=ins_egetip();
	$addipport=ins_egetipport();
	$sql=mysql_query("INSERT INTO `".$dbtbpre."enewsuser`(userid,username,password,rnd,adminclass,groupid,checked,styleid,filelevel,salt,loginnum,lasttime,lastip,truename,email,classid,pretime,preip,addtime,addip,userprikey,salt2,lastipport,preipport,addipport) VALUES (1,'$username','$password','$rnd','',1,0,1,0,'$salt',0,0,'','','',0,0,'','$addtime','$addip','$userprikey','$salt2','$addipport','$addipport','$addipport');");
	$sql2=mysql_query("INSERT INTO `".$dbtbpre."enewsuseradd` VALUES (1,0,'','','',0);");
	mysql_close();
	//認證碼
	RepEcmsConfigLoginauth($add);
	if($sql)
	{
		echo"初始化管理員賬號完畢!<script>self.location.href='changedata.php?defaultdata=$add[defaultdata]';</script>";
		exit();
	}
	else
	{
		InstallShowMsg('無法完成初使化管理員，意外出錯，請重新安裝一次.');
	}
}
//導入測試數據
function InstallDefaultData($add){
	//鏈接數據庫
	@include("../config/config.php");
	$dbver=InstallConnectDb($ecms_config['db']['dbver'],$ecms_config['db']['dbserver'],$ecms_config['db']['dbport'],$ecms_config['db']['dbusername'],$ecms_config['db']['dbpassword'],$ecms_config['db']['dbname'],$ecms_config['db']['setchar'],$ecms_config['db']['dbchar']);
	//執行SQL語句
	DoRunQuery(ReturnInstallSql(1),$ecms_config['db']['dbchar'],$dbtbpre,$ecms_config['db']['dbver']);
	mysql_close();
	echo"導入測試數據完畢!<script>self.location.href='index.php?enews=firstadmin&f=5&defaultdata=$add[defaultdata]';</script>";
	exit();
}
//導入模板數據
function InstallTemplateData($add){
	//鏈接數據庫
	@include("../config/config.php");
	$dbver=InstallConnectDb($ecms_config['db']['dbver'],$ecms_config['db']['dbserver'],$ecms_config['db']['dbport'],$ecms_config['db']['dbusername'],$ecms_config['db']['dbpassword'],$ecms_config['db']['dbname'],$ecms_config['db']['setchar'],$ecms_config['db']['dbchar']);
	//執行SQL語句
	DoRunQuery(ReturnInstallSql(2),$ecms_config['db']['dbchar'],$dbtbpre,$ecms_config['db']['dbver']);
	mysql_close();
	if(empty($add['defaultdata']))
	{
		InstallDelArticleTxtFile();
		echo"導入模板數據完畢!<script>self.location.href='index.php?enews=firstadmin&f=5&defaultdata=$add[defaultdata]';</script>";
	}
	else
	{
		echo"導入模板數據完畢，正進入測試數據導入......<script>self.location.href='index.php?enews=defaultdata&f=4&ok=1&defaultdata=$add[defaultdata]';</script>";
	}
	exit();
}
//導入系統模型數據
function InstallModData($add){
	//鏈接數據庫
	@include("../config/config.php");
	$dbver=InstallConnectDb($ecms_config['db']['dbver'],$ecms_config['db']['dbserver'],$ecms_config['db']['dbport'],$ecms_config['db']['dbusername'],$ecms_config['db']['dbpassword'],$ecms_config['db']['dbname'],$ecms_config['db']['setchar'],$ecms_config['db']['dbchar']);
	//執行SQL語句
	DoRunQuery(ReturnInstallSql(3),$ecms_config['db']['dbchar'],$dbtbpre,$ecms_config['db']['dbver']);
	mysql_close();
	echo"導入系統模型數據完畢，正進入模板數據導入......<script>self.location.href='index.php?enews=templatedata&f=4&ok=1&defaultdata=$add[defaultdata]';</script>";
	exit();
}
//鏈接數據庫
function InstallConnectDb($phome_use_dbver,$phome_db_server,$phome_db_port,$phome_db_username,$phome_db_password,$phome_db_dbname,$phome_db_char,$phome_db_dbchar){
	$dblocalhost=$phome_db_server;
	//端口
	if($phome_db_port)
	{
		$dblocalhost.=":".$phome_db_port;
	}
	$link=@mysql_connect($dblocalhost,$phome_db_username,$phome_db_password);
	if(!$link)
	{
		InstallShowMsg('您的數據庫用戶名或密碼有誤，鏈接不上MYSQL數據庫');
	}
	//mysql版本
	if($phome_use_dbver=='auto')
	{
		$phome_use_dbver=GetMysqlVerForDb();
		if(!$phome_use_dbver)
		{
			InstallShowMsg('系統無法自動識別MYSQL版本，請手動選擇MYSQL版本');
		}
	}
	//編碼
	if($phome_use_dbver>='4.1')
	{
		$q='';
		if($phome_db_char)
		{
			$q='character_set_connection='.$phome_db_char.',character_set_results='.$phome_db_char.',character_set_client=binary';
		}
		if($phome_use_dbver>='5.0')
		{
			$q.=(empty($q)?'':',').'sql_mode=\'\'';
		}
		if($q)
		{
			@mysql_query('SET '.$q);
		}
	}
	$db=@mysql_select_db($phome_db_dbname);
	//數據庫不存在
	if(!$db)
	{
		if($phome_use_dbver>='4.1')
		{
			$createdb=@mysql_query("CREATE DATABASE IF NOT EXISTS ".$phome_db_dbname." DEFAULT CHARACTER SET ".$phome_db_dbchar);
		}
		else
		{
			$createdb=@mysql_query("CREATE DATABASE IF NOT EXISTS ".$phome_db_dbname);
		}
		if(!$createdb)
		{
			InstallShowMsg('您輸入的數據庫名不存在');
		}
		@mysql_select_db($phome_db_dbname);
	}
	return $phome_use_dbver;
}
//配置數據庫
function SetDb($add){
	global $version;
	if(!$add['mydbver']||!$add['mydbhost']||!$add['mydbname']||!$add['mydbtbpre']||!$add['mycookievarpre']||!$add['myadmincookievarpre'])
	{
		InstallShowMsg('帶*項不能為空');
	}
	//鏈接數據庫
	$dbver=InstallConnectDb($add['mydbver'],$add['mydbhost'],$add['mydbport'],$add['mydbusername'],$add['mydbpassword'],$add['mydbname'],$add['mysetchar'],$add['mydbchar']);
	if($add['mydbver']=='auto')
	{
		$add['mydbver']=$dbver;
	}
	//初使化網站信息
	$siteurl=ReturnEcmsSiteUrl();
	$add[keyrnd]=ins_make_password(30);
	$add[downpass]=ins_make_password(20);
	//配置文件
	RepEcmsConfig($add,$siteurl);
	//執行SQL語句
	DoRunQuery(ReturnInstallSql(0),$add['mydbchar'],$add['mydbtbpre'],$add['mydbver']);
	@mysql_query("update ".$add['mydbtbpre']."enewspublic set newsurl='$siteurl',fileurl='".$siteurl."d/file/',softversion='$version',keyrnd='$add[keyrnd]',downpass='$add[downpass]' limit 1");
	@mysql_query("update ".$add['mydbtbpre']."enewspl_set set plurl='".$siteurl."e/pl/' limit 1");
	@mysql_query("update ".$add['mydbtbpre']."enewsshoppayfs set payurl='".$siteurl."e/payapi/ShopPay.php?paytype=alipay' where payid=3");
	@mysql_close();
	echo"配置數據庫完畢，正進入系統模型數據導入......<script>self.location.href='index.php?enews=moddata&f=4&ok=1&defaultdata=$add[defaultdata]';</script>";
	exit();
}
//處理配置文件
function RepEcmsConfig($add,$siteurl){
	global $headerchar;
	//初使化配置文件
	$fp=@fopen("data/config.php","r");
	if(!$fp)
	{
		InstallShowMsg('請檢查 /e/install/data/config.php 文件是否存在!');
	}
	$data=@fread($fp,filesize("data/config.php"));
	fclose($fp);
	$data=str_replace('<!--dbtype.phome.net-->',$add['mydbtype'],$data);
	$data=str_replace('<!--dbver.phome.net-->',$add['mydbver'],$data);
	$data=str_replace('<!--host.phome.net-->',$add['mydbhost'],$data);
	$data=str_replace('<!--port.phome.net-->',$add['mydbport'],$data);
	$data=str_replace('<!--username.phome.net-->',$add['mydbusername'],$data);
	$data=str_replace('<!--password.phome.net-->',$add['mydbpassword'],$data);
	$data=str_replace('<!--name.phome.net-->',$add['mydbname'],$data);
	$data=str_replace('<!--char.phome.net-->',$add['mysetchar'],$data);
	$data=str_replace('<!--dbchar.phome.net-->',$add['mydbchar'],$data);
	$data=str_replace('<!--tbpre.phome.net-->',$add['mydbtbpre'],$data);
	$data=str_replace('<!--cookiepre.phome.net-->',$add['mycookievarpre'],$data);
	$data=str_replace('<!--admincookiepre.phome.net-->',$add['myadmincookievarpre'],$data);
	$data=str_replace('<!--headerchar.phome.net-->',$headerchar,$data);
	$data=str_replace('<!--cookiernd.phome.net-->',ins_make_password(30),$data);
	$data=str_replace('<!--qcookiernd.phome.net-->',ins_make_password(30),$data);
	$data=str_replace('<!--qcookierndtwo.phome.net-->',ins_make_password(30),$data);
	$data=str_replace('<!--ecms.newsurl-->',$siteurl,$data);
	$data=str_replace('<!--ecms.fileurl-->',$siteurl."d/file/",$data);
	$data=str_replace('<!--ecms.plurl-->',$siteurl."e/pl/",$data);
	$data=str_replace('<!--ecms.downpass-->',$add['downpass'],$data);
	$data=str_replace('<!--ecms.keyrnd-->',$add['keyrnd'],$data);
	//寫入配置文件
	$fp1=@fopen("../config/config.php","w");
	if(!$fp1)
	{
		InstallShowMsg(' /e/config/config.php 文件權限沒有設為0777，無法完成配置數據庫');
	}
	@fputs($fp1,$data);
	@fclose($fp1);
}
//處理認證碼
function RepEcmsConfigLoginauth($add){
	global $headerchar;
	//初使化配置文件
	$fp=@fopen("../config/config.php","r");
	if(!$fp)
	{
		InstallShowMsg('請檢查 /e/config/config.php 文件是否存在!');
	}
	$data=@fread($fp,filesize("../config/config.php"));
	fclose($fp);
	$data=str_replace('<!--loginauth.phome.net-->',$add['loginauth'],$data);
	//寫入配置文件
	$fp1=@fopen("../config/config.php","w");
	if(!$fp1)
	{
		InstallShowMsg(' /e/config/config.php 文件權限沒有設為0777，無法完成配置');
	}
	@fputs($fp1,$data);
	@fclose($fp1);
}
//返回SQL語句
function ReturnInstallSql($defaultdata=1){
	if($defaultdata==0)
	{
		$sqlfile="data/empirecms.com.sql";
	}
	elseif($defaultdata==2)
	{
		$sqlfile="data/empirecms.temp.sql";
	}
	elseif($defaultdata==3)
	{
		$sqlfile="data/empirecms.mod.sql";
	}
	else
	{
		$sqlfile="data/empirecms.data.sql";
	}
	$fp=fopen($sqlfile,'r');
	$sql=fread($fp,filesize($sqlfile));
	fclose($fp);
	if(empty($sql))
	{
		InstallShowMsg(' /e/install/'.$sqlfile.' 文件丟失,無法完成安裝','index.php?enews=setdb&f=4');
	}
	//替換測試數據網址
	if($sqlfile=='data/empirecms.data.sql')
	{
		$sql=InstallReplaceTestDataUrl($sql);
	}
	return $sql;
}
//取得網站地址
function ReturnEcmsSiteUrl(){
	$siteurl=str_replace('e/install/index.php','',$_SERVER['PHP_SELF']);
	$siteurl=str_replace('e/install/','',$siteurl);
	$siteurl=str_replace('e/install','',$siteurl);
	return $siteurl;
}
//刪除存文本文件
function InstallDelArticleTxtFile(){
	@include("../class/delpath.php");
	$DelPath="../../d/txt/2012";
	$wm_chief=new del_path();
	$wm_chief_ok=$wm_chief->wm_chief_delpath($DelPath);
	return $wm_chief_ok;
}
//替換測試數據網址
function InstallReplaceTestDataUrl($text){
	$baseurl=ReturnEcmsSiteUrl();
	$text=str_replace('/ecms72/',$baseurl,$text);
	$text=str_replace('http://demo.phome.net/defdata/demopic/',$baseurl.'testdata/demopic/',$text);
	return $text;
}
?>