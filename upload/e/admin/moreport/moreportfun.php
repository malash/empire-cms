<?php

//更新數據庫緩存
function Moreport_ChangeCacheAll($add,$userid,$username){
	global $empire,$dbtbpre,$public_r,$ecms_config,$fun_r;
	$addcs=Moreport_ChangeAddCs($add);
	if(!$add['docache'])
	{
		echo"<script>self.location.href='ListMoreport.php?enews=MoreportUpdateClassfileAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	$start=(int)$add['start'];
	$num=1;
	$b=0;
	$sql=$empire->query("select * from {$dbtbpre}enewsmoreport where pid>$start order by pid limit ".$num);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$new_start=$r['pid'];
		if($r['pid']==1)
		{
			continue;
		}
		if(!$r['ppath']||!file_exists($r['ppath'].'e/config/config.php'))
		{
			continue;
		}
		define('ECMS_SELFPATH',$r['ppath']);
		Moreport_ChangeData($r,0);
	}
	if(empty($b))
	{
		echo $fun_r[MoreportChangeCacheSuccess]."<script>self.location.href='ListMoreport.php?enews=MoreportUpdateClassfileAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	echo"<meta http-equiv=\"refresh\" content=\"".$public_r['realltime'].";url=ListMoreport.php?enews=MoreportChangeCacheAll&start=$new_start".$addcs.hReturnEcmsHashStrHref(0)."\">".$fun_r[OneMoreportChangeCacheSuccess]."(ID:<font color=red><b>".$new_start."</b></font>)";
	exit();
}

//更新欄目緩存文件
function Moreport_UpdateClassfileAll($add,$userid,$username){
	global $empire,$dbtbpre,$public_r,$ecms_config,$fun_r;
	$addcs=Moreport_ChangeAddCs($add);
	if(!$add['doclassfile'])
	{
		echo"<script>self.location.href='ListMoreport.php?enews=MoreportReDtPageAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	$start=(int)$add['start'];
	$num=1;
	$b=0;
	$sql=$empire->query("select * from {$dbtbpre}enewsmoreport where pid>$start order by pid limit ".$num);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$new_start=$r['pid'];
		if($r['pid']==1)
		{
			continue;
		}
		if(!$r['ppath']||!file_exists($r['ppath'].'e/config/config.php'))
		{
			continue;
		}
		define('ECMS_SELFPATH',$r['ppath']);
		Moreport_ChangeData($r,3);
	}
	if(empty($b))
	{
		echo $fun_r[MoreportUpdateClassfileSuccess]."<script>self.location.href='ListMoreport.php?enews=MoreportReDtPageAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	echo"<meta http-equiv=\"refresh\" content=\"".$public_r['realltime'].";url=ListMoreport.php?enews=MoreportUpdateClassfileAll&start=$new_start".$addcs.hReturnEcmsHashStrHref(0)."\">".$fun_r[OneMoreportUpdateClassfileSuccess]."(ID:<font color=red><b>".$new_start."</b></font>)";
	exit();
}

//更新動態頁面
function Moreport_ReDtPageAll($add,$userid,$username){
	global $empire,$dbtbpre,$public_r,$ecms_config,$fun_r;
	$addcs=Moreport_ChangeAddCs($add);
	if(!$add['dodtpage'])
	{
		echo"<script>self.location.href='ListMoreport.php?enews=MoreportClearTmpfileAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	$start=(int)$add['start'];
	$num=1;
	$b=0;
	$sql=$empire->query("select * from {$dbtbpre}enewsmoreport where pid>$start order by pid limit ".$num);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$new_start=$r['pid'];
		if($r['pid']==1)
		{
			continue;
		}
		if(!$r['ppath']||!file_exists($r['ppath'].'e/config/config.php'))
		{
			continue;
		}
		define('ECMS_SELFPATH',$r['ppath']);
		Moreport_ChangeData($r,1);
	}
	if(empty($b))
	{
		echo $fun_r[MoreportReDtPageSuccess]."<script>self.location.href='ListMoreport.php?enews=MoreportClearTmpfileAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	echo"<meta http-equiv=\"refresh\" content=\"".$public_r['realltime'].";url=ListMoreport.php?enews=MoreportReDtPageAll&start=$new_start".$addcs.hReturnEcmsHashStrHref(0)."\">".$fun_r[OneMoreportReDtPageSuccess]."(ID:<font color=red><b>".$new_start."</b></font>)";
	exit();
}

//清理臨時文件
function Moreport_ClearTmpfileAll($add,$userid,$username){
	global $empire,$dbtbpre,$public_r,$ecms_config,$fun_r;
	$addcs=Moreport_ChangeAddCs($add);
	if(!$add['dotmpfile'])
	{
		echo "<script>self.location.href='ListMoreport.php?enews=MoreportReIndexfileAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	$start=(int)$add['start'];
	$num=1;
	$b=0;
	$sql=$empire->query("select * from {$dbtbpre}enewsmoreport where pid>$start order by pid limit ".$num);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$new_start=$r['pid'];
		if($r['pid']==1)
		{
			continue;
		}
		if(!$r['ppath']||!file_exists($r['ppath'].'e/config/config.php'))
		{
			continue;
		}
		define('ECMS_SELFPATH',$r['ppath']);
		Moreport_ChangeData($r,2);
	}
	if(empty($b))
	{
		echo $fun_r[MoreportClearTmpfileSuccess]."<script>self.location.href='ListMoreport.php?enews=MoreportReIndexfileAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	echo"<meta http-equiv=\"refresh\" content=\"".$public_r['realltime'].";url=ListMoreport.php?enews=MoreportClearTmpfileAll&start=$new_start".$addcs.hReturnEcmsHashStrHref(0)."\">".$fun_r[OneMoreportClearTmpfileSuccess]."(ID:<font color=red><b>".$new_start."</b></font>)";
	exit();
}

//更新首頁文件
function Moreport_ReIndexfileAll($add,$userid,$username){
	global $empire,$dbtbpre,$public_r,$ecms_config,$fun_r;
	$addcs=Moreport_ChangeAddCs($add);
	if(!$add['doreindex'])
	{
		insert_dolog("");//操作日誌
		printerror("MoreportChangeAllDataSuccess","ListMoreport.php".hReturnEcmsHashStrHref2(1));
	}
	$start=(int)$add['start'];
	$num=1;
	$b=0;
	$sql=$empire->query("select * from {$dbtbpre}enewsmoreport where pid>$start order by pid limit ".$num);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$new_start=$r['pid'];
		if($r['pid']==1)
		{
			continue;
		}
		if(!$r['ppath']||!file_exists($r['ppath'].'e/config/config.php'))
		{
			continue;
		}
		define('ECMS_SELFPATH',$r['ppath']);
		Moreport_ChangeData($r,4);
	}
	if(empty($b))
	{
		insert_dolog("");//操作日誌
		printerror("MoreportChangeAllDataSuccess","ListMoreport.php".hReturnEcmsHashStrHref2(1));
		//echo $fun_r[MoreportReIndexfileSuccess]."<script>self.location.href='ListMoreport.php?enews=MoreportReIndexfileAll&start=0".$addcs.hReturnEcmsHashStrHref(0)."';</script>";
		exit();
	}
	echo"<meta http-equiv=\"refresh\" content=\"".$public_r['realltime'].";url=ListMoreport.php?enews=MoreportReIndexfileAll&start=$new_start".$addcs.hReturnEcmsHashStrHref(0)."\">".$fun_r[OneMoreportReIndexfileSuccess]."(ID:<font color=red><b>".$new_start."</b></font>)";
	exit();
}

//附加參數
function Moreport_ChangeAddCs($add){
	$docache=(int)$add['docache'];
	$doclassfile=(int)$add['doclassfile'];
	$dodtpage=(int)$add['dodtpage'];
	$dotmpfile=(int)$add['dotmpfile'];
	$doreindex=(int)$add['doreindex'];
	$cs='';
	if($docache)
	{
		$cs.="&docache=".$docache;
	}
	if($doclassfile)
	{
		$cs.="&doclassfile=".$doclassfile;
	}
	if($dodtpage)
	{
		$cs.="&dodtpage=".$dodtpage;
	}
	if($dotmpfile)
	{
		$cs.="&dotmpfile=".$dotmpfile;
	}
	if($doreindex)
	{
		$cs.="&doreindex=".$doreindex;
	}
	return $cs;
}

//更新數據
function Moreport_ChangeData($portr,$ecms=0){
	global $empire,$dbtbpre,$public_r,$ecms_config;
	$ecms_config['sets']['deftempid']=$portr['tempgid'];
	if($ecms==1)//更新動態頁面
	{
		GetPlTempPage();//評論列表模板
		GetPlJsPage();//評論JS模板
		ReCptemp();//控制面板模板
		GetSearch();//三搜索表單模板
		GetPrintPage();//打印模板
		GetDownloadPage();//下載地址頁面
		ReGbooktemp();//留言板模板
		ReLoginIframe();//登陸狀態模板
		ReSchAlltemp();//全站搜索模板
		//防採集緩存
		$yfile=ECMS_PATH.'e/data/dbcache/notcj.php';
		$nfile=ECMS_SELFPATH.'e/data/dbcache/notcj.php';
		@copy($yfile,$nfile);
	}
	elseif($ecms==2)//清理臨時文件
	{
		//臨時文件目錄
		$tmppath=ECMS_SELFPATH.'e/data/tmp';
		$hand=@opendir($tmppath);
		while($file=@readdir($hand))
		{
			if($file=='.'||$file=='..'||$file=='test.txt'||$file=='index.html'||$file=='mod'||$file=='temp'||$file=='titlepic'||$file=='cj')
			{
				continue;
			}
			$filename=$tmppath.'/'.$file;
			if(!is_dir($filename))
			{
				DelFiletext($filename);
			}
		}
	}
	elseif($ecms==3)//更新欄目緩存文件
	{
		$ypath=ECMS_PATH.'d/js';
		$npath=ECMS_SELFPATH.'d/js';
		CopyPath($ypath,$npath);
		$ypath=ECMS_PATH.'e/data/fc';
		$npath=ECMS_SELFPATH.'e/data/fc';
		CopyPath($ypath,$npath);
		$ypath=ECMS_PATH.'e/data/html';
		$npath=ECMS_SELFPATH.'e/data/html';
		CopyPath($ypath,$npath);
		$ypath=ECMS_PATH.'e/data/template';
		$npath=ECMS_SELFPATH.'e/data/template';
		CopyPath($ypath,$npath);
	}
	elseif($ecms==4)//更新動態首頁
	{
		if($portr['mustdt']||$public_r['indexpagedt'])
		{
			DelFiletext(ECMS_SELFPATH.'index'.$public_r['indextype']);
			@copy(ECMS_SELFPATH.'e/data/template/dtindexpage.txt',ECMS_SELFPATH.'index.php');
		}
	}
	else//更新數據庫緩存
	{
		//更新參數設置
		GetConfig(1);
		//更新類別
		GetClass();
		//更新會員組
		GetMemberLevel();
		//更新全站搜索數據表
		GetSearchAllTb();
	}
}

?>