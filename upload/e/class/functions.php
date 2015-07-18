<?php
define('InEmpireCMSHfun',TRUE);
//-------------- 公共區 ----------------------

//返回後颱風格
function EcmsReturnAdminStyle(){
	global $public_r;
	$adminstyle=(int)getcvar('loginadminstyleid',1);
	if(!strstr($public_r['adminstyle'],','.$adminstyle.','))
	{
		$adminstyle=$public_r['defadminstyle']?$public_r['defadminstyle']:1;
	}
	return $adminstyle;
}

//返回後台管理信息欄目導航字符串
function AdminReturnClassLink($classid){
	global $class_r,$editor,$fun_r,$ecmscheck,$ecms_hashur;
	$addcheck='';
	if($ecmscheck)
	{
		$addcheck='&ecmscheck=1';
	}
	if($editor==1)
	{
		$addurl='../';
	}
	if(empty($class_r[$classid][featherclass]))
	{
		$class_r[$classid][featherclass]="|";
	}
	$r=explode("|",$class_r[$classid][featherclass].$classid."|");
	$string="<a href=\"".$addurl."ListAllInfo.php?tbname=".$class_r[$classid][tbname].$addcheck.$ecms_hashur['ehref']."\">".$fun_r['AdminInfo']."</a>";
	$count=count($r)-1;
	for($i=1;$i<$count;$i++)
	{
		$curl=$class_r[$r[$i]][islast]?"ListNews.php?classid=".$r[$i].$addcheck.$ecms_hashur['ehref']:"ListAllInfo.php?tbname=".$class_r[$r[$i]][tbname]."&classid=".$r[$i].$addcheck.$ecms_hashur['ehref'];
		$string.="&nbsp;>&nbsp;<a href=\"".$addurl."$curl\">".$class_r[$r[$i]][classname]."</a>";
    }
	return $string;
}

//加驗證代碼
function AddCheckViewCode(){
	$code="if(!defined('InEmpireCMS'))
{
	exit();
}";
	return $code;
}

//加模板驗證代碼
function AddCheckViewTempCode(){
	$code="<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>";
	return $code;
}

//後台分頁
function page2($num,$line,$page_line,$start,$page,$search){
	global $fun_r;
	if($num<=$line)
	{
		return '<span class="epages"><a title="'.$fun_r['admintrecord'].'">&nbsp;<b>'.$num.'</b> </a>&nbsp;&nbsp;</span>';
	}
	$search=RepPostStr($search,1);
	$url=eReturnSelfPage(0).'?page';
	$snum=2;//最小頁數
	$totalpage=ceil($num/$line);//取得總頁數
	$firststr='<a title="'.$fun_r['admintrecord'].'">&nbsp;<b>'.$num.'</b> </a>&nbsp;&nbsp;';
	//上一頁
	if($page<>0)
	{
		$toppage='<a href="'.$url.'=0'.$search.'">'.$fun_r['adminstartpage'].'</a>&nbsp;';
		$pagepr=$page-1;
		$prepage='<a href="'.$url.'='.$pagepr.$search.'">'.$fun_r['adminpripage'].'</a>';
	}
	//下一頁
	if($page!=$totalpage-1)
	{
		$pagenex=$page+1;
		$nextpage='&nbsp;<a href="'.$url.'='.$pagenex.$search.'">'.$fun_r['adminnextpage'].'</a>';
		$lastpage='&nbsp;<a href="'.$url.'='.($totalpage-1).$search.'">'.$fun_r['adminlastpage'].'</a>';
	}
	$starti=$page-$snum<0?0:$page-$snum;
	$no=0;
	for($i=$starti;$i<$totalpage&&$no<$page_line;$i++)
	{
		$no++;
		if($page==$i)
		{
			$is_1="<b>";
			$is_2="</b>";
		}
		else
		{
			$is_1='<a href="'.$url.'='.$i.$search.'">';
			$is_2="</a>";
		}
		$pagenum=$i+1;
		$returnstr.="&nbsp;".$is_1.$pagenum.$is_2;
	}
	$returnstr=$firststr.$toppage.$prepage.$returnstr.$nextpage.$lastpage;
	return '<span class="epages">'.$returnstr.'</span>';
}

//後台分頁
function postpage($num,$line,$page_line,$start,$page,$form){
	global $fun_r;
	if($num<=$line)
	{
		return '';
	}
	$snum=2;//最小頁數
	$totalpage=ceil($num/$line);//取得總頁數
	$firststr='<a title="'.$fun_r['admintrecord'].'">&nbsp;<b>'.$num.'</b> </a>&nbsp;&nbsp;';
	//上一頁
	if($page<>0)
	{
		$toppage='<a href="#ecms" onclick="javascript:GotoPostPage(0,0);">'.$fun_r['adminstartpage'].'</a>&nbsp;';
		$pagepr=$page-1;
		$prepage='<a href="#ecms" onclick="javascript:GotoPostPage('.$pagepr.',0);">'.$fun_r['adminpripage'].'</a>';
	}
	//下一頁
	if($page!=$totalpage-1)
	{
		$pagenex=$page+1;
		$nextpage='&nbsp;<a href="#ecms" onclick="javascript:GotoPostPage('.$pagenex.',0);">'.$fun_r['adminnextpage'].'</a>';
		$lastpage='&nbsp;<a href="#ecms" onclick="javascript:GotoPostPage('.($totalpage-1).',0);">'.$fun_r['adminlastpage'].'</a>';
	}
	$starti=$page-$snum<0?0:$page-$snum;
	$no=0;
	for($i=$starti;$i<$totalpage&&$no<$page_line;$i++)
	{
		$no++;
		if($page==$i)
		{
			$is_1="<b>";
			$is_2="</b>";
		}
		else
		{
			$is_1='<a href="#ecms" onclick="javascript:GotoPostPage('.$i.',0);">';
			$is_2="</a>";
		}
		$pagenum=$i+1;
		$returnstr.="&nbsp;".$is_1.$pagenum.$is_2;
	}
	$returnstr=$firststr.$toppage.$prepage.$returnstr.$nextpage.$lastpage;
	$returnstr.="<script>
	function GotoPostPage(page,start){
		".$form.".page.value=page;
		".$form.".start.value=start;
		".$form.".submit();
	}
	</script>";
	return $returnstr;
}

//取得模型表名
function GetModTable($mid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select tid,tbname from {$dbtbpre}enewsmod where mid='$mid'");
	return $r;
}

//建立專題目錄
function CreateZtPath($ztpath){
	$createpath=ECMS_PATH.$ztpath;
    $mk=DoMkdir($createpath);
	$createfilepath=$createpath.'/uploadfile';//建立附件目錄
    $mk1=DoMkdir($createfilepath);
}

//建立欄目目錄
function CreateClassPath($classpath){
	$createpath=ECMS_PATH.$classpath;
	$mk=DoMkdir($createpath);
	$createfilepath=ECMS_PATH.'d/file/'.$classpath;//建立附件目錄
    $mk1=DoMkdir($createfilepath);
}

//建立標題分類目錄
function CreateInfoTypePath($tpath){
	$createpath=ECMS_PATH.$tpath;
    $mk=DoMkdir($createpath);
}

//刪除欄目緩存文件
function DelListEnews(){
	$file=ECMS_PATH."e/data/fc/ListEnews.php";
	DelFiletext($file);
	$file1=ECMS_PATH."e/data/fc/ListClass0.php";
	DelFiletext($file1);
	$file2=ECMS_PATH."e/data/fc/ListClass1.php";
	DelFiletext($file2);
}

//刪除模板臨時緩存文件
function DelOneTempTmpfile($classid){
	$file=ECMS_PATH.'e/data/tmp/dt_temp'.$classid.'.php';
	if(file_exists($file))
	{
		DelFiletext($file);
	}
}

//替換php代碼
function RepPhpAspJspcode($string){
	global $public_r;
	if(!$public_r[candocode]){
		//$string=str_replace("<?xml","[!--ecms.xml--]",$string);
		$string=str_replace("<\\","&lt;\\",$string);
		$string=str_replace("<?","&lt;?",$string);
		$string=str_replace("<%","&lt;%",$string);
		if(@stristr($string,' language'))
		{
			$string=preg_replace(array('!<script!i','!</script>!i'),array('&lt;script','&lt;/script&gt;'),$string);
		}
		//$string=str_replace("[!--ecms.xml--]","<?xml",$string);
	}
	return $string;
}

//替換php代碼
function RepPhpAspJspcodeText($string){
	//$string=str_replace("<?xml","[!--ecms.xml--]",$string);
	$string=str_replace("<\\","&lt;\\",$string);
	$string=str_replace("<?","&lt;?",$string);
	$string=str_replace("<%","&lt;%",$string);
	if(@stristr($string,' language'))
	{
		$string=preg_replace(array('!<script!i','!</script>!i'),array('&lt;script','&lt;/script&gt;'),$string);
	}
	//$string=str_replace("[!--ecms.xml--]","<?xml",$string);
	$string=str_replace("<!--code.start-->","&lt;!--code.start--&gt;",$string);
	$string=str_replace("<!--code.end-->","&lt;!--code.end--&gt;",$string);
	return $string;
}

//替換文件前綴
function RepFilenameQz($qz,$ecms=0){
	if(empty($ecms))
	{
		$qz=str_replace("/","",$qz);
		$qz=str_replace("\\","",$qz);
	}
	$qz=str_replace("#","",$qz);
	$qz=str_replace("&","",$qz);
	$qz=str_replace(":","",$qz);
	$qz=str_replace(";","",$qz);
	$qz=str_replace("<","",$qz);
	$qz=str_replace(">","",$qz);
	$qz=str_replace("?","",$qz);
	$qz=str_replace("*","",$qz);
	$qz=str_replace("%","",$qz);
	$qz=str_replace("|","",$qz);
	$qz=str_replace("\"","",$qz);
	$qz=str_replace("'","",$qz);
	$qz=str_replace(".","",$qz);
	return $qz;
}

//替換目錄值
function RepPathStr($path){
	$path=str_replace("\\","",$path);
	$path=str_replace("/","",$path);
	return $path;
}

//返回替換字符
function ReturnCheckDoRep(){
	global $empire,$dbtbpre;
	//信息來源
	$befrom=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsbefrom");
	//作者
	$writer=$empire->gettotal("select count(*) as total from {$dbtbpre}enewswriter");
	//替換字符
	$words=$empire->gettotal("select count(*) as total from {$dbtbpre}enewswords");
	//內容關鍵字
	$key=$empire->gettotal("select count(*) as total from {$dbtbpre}enewskey");
	$str=",$befrom,$writer,$words,$key,";
	return $str;
}

//返回替換驗證
function ReturnCheckDoRepStr(){
	global $public_r;
	return explode(',',$public_r[checkdorepstr]);
}

//取得欄目目錄名稱
function GetPathname($classname){
	$c=explode("/",$classname);
	$count=count($c)-1;
	$cr[0]=$c[$count];//欄目目錄名
	$len=strlen($cr[0]);
	//上級欄目目錄名
	$cr[1]=substr($classname,0,strlen($classname)-$len);
	return $cr;
}

//更新緩存
function ChangeEnewsData($userid,$username){
	//操作權限
	CheckLevel($userid,$username,$classid,"changedata");
	//更新參數設置
	GetConfig(1);
	//更新類別
	GetClass();
	//更新會員組
	GetMemberLevel();
	//更新全站搜索數據表
	GetSearchAllTb();
	//操作日誌
	insert_dolog("");
	printerror("ChangeDataSuccess","history.go(-1)");
}

//返回文件名
function ReturnPathFile($filename){
	$fr=explode("/",$filename);
	$count=count($fr)-1;
	return $fr[$count];
}

//返回欄目鏈接(無緩存)
function sys_ReturnBqClassUrl($r){
	global $public_r;
	//外部欄目
	if($r[wburl])
	{
		$classurl=$r[wburl];
	}
	//動態列表
	elseif($r['listdt'])
	{
		$rewriter=eReturnRewriteClassUrl($r['classid'],1);
		$classurl=$rewriter['pageurl'];
	}
	elseif($r['classurl'])
	{
		$classurl=$r['classurl'];
	}
	else
	{
		$classurl=$public_r['newsurl'].$r['classpath']."/";
	}
	return $classurl;
}

//返回專題鏈接(無緩存)
function sys_ReturnBqZtUrl($r){
	global $public_r;
	if($r['zturl'])
	{
		$zturl=$r['zturl'];
    }
	else
	{
		$zturl=$public_r['newsurl'].$r['ztpath']."/";
    }
	return $zturl;
}

//組合兩數組
function TogTwoArray($r,$ra){
	$returnr=array_merge($r,$ra);
	return $returnr;
}

//下載
function DownLoadFile($file,$filepath,$ecms=0){
	if(empty($file))
	{
		printerror("FileNotExist","history.go(-1)");
    }
	if(!file_exists($filepath))
	{
		printerror("FileNotExist","");
	}
	$filesize=@filesize($filepath);
	//下載
	Header("Content-type: application/octet-stream");
	Header("Accept-Ranges: bytes");
	Header("Accept-Length: ".$filesize);
	Header("Content-Disposition: attachment; filename=".$file);
	echo ReadFiletext($filepath);
	if($ecms==1)
	{
		DelFiletext($filepath);
	}
}

//下載內容
function DownLoadFileText($filetext,$filename){
	if(empty($filetext)||empty($filename))
	{
		return '';
    }
	$filesize=strlen($filetext);
	//下載
	Header("Content-type: application/octet-stream");
	Header("Accept-Ranges: bytes");
	Header("Accept-Length: ".$filesize);
	Header("Content-Disposition: attachment; filename=".$filename);
	echo $filetext;
}

//取得緩存文件內容
function GetFcfiletext($file){
	$str1="document.write(\"";
	$str2="\");";
	$text=ReadFiletext($file);
	$text=stripSlashes(str_replace($str2,"",str_replace($str1,"",$text)));
	return $text;
}

//驗證模板組是否存在
function CheckTempGroup($gid){
	global $empire,$dbtbpre;
	if(empty($gid))
	{
		$gid=GetDoTempGid();
	}
	$gid=(int)$gid;
	$r=$empire->fetch1("select gid,gname from {$dbtbpre}enewstempgroup where gid='$gid'");
	if(empty($r['gid']))
	{
		printerror("ErrorUrl","");
	}
	return $r['gname'];
}

//附加隱藏表單項
function ReturnFormHidden($vname,$value){
	$value=ehtmlspecialchars(ClearAddsData($value));
	return "<input type=hidden name=\"".$vname."\" value=\"".$value."\">";
}

//驗證多選上傳插件是否開啟
function TranmoreIsOpen($ecms='addinfo'){
	$open=0;
	$file='ecmseditor/tranmore/tranmore.php';
	if($ecms=='addinfo')
	{
		$file='ecmseditor/tranmore/tranmore.php';
	}
	elseif($ecms=='editor')
	{
		$file='../../tranmore/tranmore.php';
	}
	elseif($ecms=='filemain')
	{
		$file='tranmore/tranmore.php';
	}
	if(file_exists($file))
	{
		$open=1;
	}
	return $open;
}

//-------------- 信息處理區 ----------------------

//替換關鍵字
function ReplaceKey($newstext,$classid=0){
	global $empire,$dbtbpre,$public_r,$class_r;
	if(empty($newstext)||$class_r[$classid]['keycid']==-1)
	{return $newstext;}
	$where='';
	if(!empty($class_r[$classid]['keycid']))
	{
		$where=" where cid='".$class_r[$classid]['keycid']."'";
	}
	$sql=$empire->query("select keyname,keyurl from {$dbtbpre}enewskey".$where);
	while($r=$empire->fetch($sql))
	{
		if(STR_IREPLACE)
		{
			$newstext=empty($public_r[repkeynum])?str_ireplace($r[keyname],'<a href='.$r[keyurl].' target=_blank class=infotextkey>'.$r[keyname].'</a>',$newstext):preg_replace('/'.$r[keyname].'/i','<a href='.$r[keyurl].' target=_blank class=infotextkey>'.$r[keyname].'</a>',$newstext,$public_r[repkeynum]);
		}
		else
		{
			$newstext=empty($public_r[repkeynum])?str_replace($r[keyname],'<a href='.$r[keyurl].' target=_blank class=infotextkey>'.$r[keyname].'</a>',$newstext):preg_replace('/'.$r[keyname].'/i','<a href='.$r[keyurl].' target=_blank class=infotextkey>'.$r[keyname].'</a>',$newstext,$public_r[repkeynum]);
		}
	}
	return $newstext;
}

//替換禁用字符
function ReplaceWord($newstext){
	global $empire,$dbtbpre;
	if(empty($newstext))
	{return $newstext;}
	$sql=$empire->query("select newword,oldword from {$dbtbpre}enewswords");
	while($r=$empire->fetch($sql))
	{
		$newstext=str_replace($r[oldword],$r[newword],$newstext);
	}
	return $newstext;
}

//編輯信息時替換關鍵字和過濾字符
function DoReplaceKeyAndWord($newstext,$dokey,$classid=0){
	global $public_r;
	$docheckrep=ReturnCheckDoRepStr();//返回替換驗證字符
	if($public_r['dorepword']==1&&$docheckrep[3])//過濾字符
	{
		$newstext=ReplaceWord($newstext);
	}
	if($public_r['dorepkey']==1&&$docheckrep[4]&&!empty($dokey))//內容關鍵字
	{
		$newstext=ReplaceKey($newstext,$classid);
	}
	return $newstext;
}

//重命名列表文件
function RenameListfile($classid,$lencord,$num,$type,$newtype,$classpath){
	$page=ceil($num/$lencord);
	for($j=1;$j<=$page;$j++)
	{
		if($j==1)
		{
			$listfile=ECMS_PATH.$classpath."/index";
		}
		else
		{
			$listfile=ECMS_PATH.$classpath."/index_".$j;
		}
		@rename($listfile.$type,$listfile.$newtype);
	}
}

//組合標題屬性
function TitleFont($titlefont,$titlecolor=''){
	$add=$titlecolor.',';
	if($titlecolor=='no')
	{
		$add='';
	}
	if($titlefont[b])//粗體
	{$add.='b|';}
	if($titlefont[i])//斜體
	{$add.='i|';}
	if($titlefont[s])//刪除線
	{$add.='s|';}
	if($add==',')
	{
		$add='';
	}
	return $add;
}

//單信息加入專題
function AddInfoToZt($ztid,$zcid,$classid,$id,$newstime,$isgood=0,$ecms=0){
	global $empire,$dbtbpre,$class_r;
	if($ecms==1)//檢查是否增加過
	{
		$infor=$empire->fetch1("select zid,ztid,cid from {$dbtbpre}enewsztinfo where ztid='$ztid' and classid='$classid' and id='$id' limit 1");
		if($infor['ztid'])
		{
			if($infor['cid']!=$zcid)
			{
				$empire->query("update {$dbtbpre}enewsztinfo set cid='$zcid',newstime='$newstime' where zid='$infor[zid]' limit 1");
			}
		}
		else
		{
			$mid=$class_r[$classid]['modid'];
			$empire->query("insert into {$dbtbpre}enewsztinfo(ztid,cid,classid,id,newstime,mid,isgood) values('$ztid','$zcid','$classid','$id','$newstime','$mid','$isgood');");
		}
	}
	else
	{
		$mid=$class_r[$classid]['modid'];
		$empire->query("insert into {$dbtbpre}enewsztinfo(ztid,cid,classid,id,newstime,mid,isgood) values('$ztid','$zcid','$classid','$id','$newstime','$mid','$isgood');");
	}
}

//多信息加入專題
function AddMoreInfoToZt($ztid,$zcid,$tbname,$where,$ecms=0){
	global $empire,$dbtbpre,$class_r;
	if(empty($where))
	{
		return '';
	}
	$sql=$empire->query("select id,classid,newstime from {$dbtbpre}ecms_".$tbname.($ecms==0?'':'_index')." where ".$where);
	while($r=$empire->fetch($sql))
	{
		$zinfor=$empire->fetch1("select zid,ztid,cid from {$dbtbpre}enewsztinfo where ztid='$ztid' and classid='$r[classid]' and id='$r[id]' limit 1");
		if($zinfor['ztid'])
		{
			if($zinfor['cid']!=$zcid)
			{
				$empire->query("update {$dbtbpre}enewsztinfo set cid='$zcid' where zid='$zinfor[zid]' limit 1");
			}
		}
		else
		{
			$mid=$class_r[$r[classid]]['modid'];
			$empire->query("insert into {$dbtbpre}enewsztinfo(ztid,cid,classid,id,newstime,mid,isgood) values('$ztid','$zcid','$r[classid]','$r[id]','$r[newstime]','$mid','0');");
		}
	}
}

//加入專題
function InsertZtInfo($ztids,$zcids,$oldztids,$oldzcids,$classid,$id,$newstime){
	global $empire,$dbtbpre,$class_r;
	if($zcids==$oldzcids)
	{
		return '';
	}
	$haveztids='';
	$dh='';
	//加入專題分類
	if($zcids)
	{
		$r=explode(',',$zcids);
		$count=count($r);
		for($i=0;$i<$count;$i++)
		{
			$cid=(int)$r[$i];
			if(!$cid)
			{
				continue;
			}
			if($cid<0)
			{
				$thisztid=abs($cid);
				$cid=0;
			}
			else
			{
				$zcr=$empire->fetch1("select ztid from {$dbtbpre}enewszttype where cid='$cid' limit 1");
				if(!$zcr['ztid'])
				{
					continue;
				}
				$thisztid=$zcr['ztid'];
			}
			AddInfoToZt($thisztid,$cid,$classid,$id,$newstime,0,1);
			$haveztids.=$dh.$thisztid;
			$dh=',';
		}
	}
	//清理沒選專題
	if($oldztids)
	{
		$dr=explode(',',$oldztids);
		$dcount=count($dr);
		for($di=0;$di<$dcount;$di++)
		{
			$dztid=(int)$dr[$di];
			if(!$dztid||strstr(','.$haveztids.',',','.$dztid.','))
			{
				continue;
			}
			$empire->query("delete from {$dbtbpre}enewsztinfo where ztid='$dztid' and classid='$classid' and id='$id'");
		}
	}
}

//取消加入專題
function DelZtInfo($where){
	global $empire,$dbtbpre,$class_r;
	if(!$where)
	{
		return '';
	}
	$empire->query("delete from {$dbtbpre}enewsztinfo where ".$where);
}

//信息送審
function InfoInsertToWorkflow($id,$classid,$wfid,$userid,$username){
	global $empire,$dbtbpre,$class_r;
	$wfitemr=$empire->fetch1("select tid,tno,groupid,userclass,username,tstatus from {$dbtbpre}enewsworkflowitem where wfid='$wfid' order by tno limit 1");
	//狀態更新
	$empire->query("insert into {$dbtbpre}enewswfinfo(id,classid,wfid,tid,groupid,userclass,username,checknum,tstatus,checktno) values('$id','$classid','$wfid','$wfitemr[tid]','$wfitemr[groupid]','$wfitemr[userclass]','$wfitemr[username]',1,'$wfitemr[tstatus]',0);");
	//日誌
	InsertWfLog($classid,$id,$wfid,0,$username,'',1,0);
}

//信息返工送審
function InfoUpdateToWorkflow($id,$classid,$wfid,$userid,$username){
	global $empire,$dbtbpre,$class_r;
	$wfinfor=$empire->fetch1("select checknum,wfid,tid,checktno from {$dbtbpre}enewswfinfo where id='$id' and classid='$classid' limit 1");
	if($wfinfor[checktno]!='101')
	{
		return '';
	}
	if($wfinfor[tid])
	{
		$ywfitemr=$empire->fetch1("select tno from {$dbtbpre}enewsworkflowitem where tid='$wfinfor[tid]'");
		$wfitemr=$empire->fetch1("select tid,tno,groupid,userclass,username,tstatus from {$dbtbpre}enewsworkflowitem where wfid='$wfinfor[wfid]' and tno>$ywfitemr[tno] order by tno limit 1");
	}
	else
	{
		$wfitemr=$empire->fetch1("select tid,tno,groupid,userclass,username,tstatus from {$dbtbpre}enewsworkflowitem where wfid='$wfinfor[wfid]' order by tno limit 1");
	}
	//狀態更新
	$empire->query("update {$dbtbpre}enewswfinfo set tid='$wfitemr[tid]',groupid='$wfitemr[groupid]',userclass='$wfitemr[userclass]',username='$wfitemr[username]',checknum=checknum+1,tstatus='$wfitemr[tstatus]',checktno='0' where id='$id' and classid='$classid' limit 1");
	//日誌
	InsertWfLog($classid,$id,$wfinfor[wfid],0,$username,'',$wfinfor[checknum],0);
}

//寫入簽發日誌
function InsertWfLog($classid,$id,$wfid,$tid,$username,$checktext,$checknum,$checktype){
	global $empire,$dbtbpre,$class_r,$lur;
	$checktime=time();
	$checktext=RepPostStr($checktext);
	$empire->query("insert into {$dbtbpre}enewswfinfolog(id,classid,wfid,tid,username,checktime,checktext,checknum,checktype) values('$id','$classid','$wfid','$tid','$username','$checktime','$checktext','$checknum','$checktype');");
}

//加入TAG表
function eInsertTags($tags,$classid,$id,$newstime){
	global $empire,$dbtbpre,$class_r;
	if(!trim($tags))
	{
		return '';
	}
	$tags=RepPostVar($tags);
	$classid=(int)$classid;
	$id=(int)$id;
	$mid=(int)$class_r[$classid][modid];
	$tr=explode(',',$tags);
	$count=count($tr);
	for($i=0;$i<$count;$i++)
	{
		$tagname=$tr[$i];
		if(empty($tagname))
		{
			continue;
		}
		$r=$empire->fetch1("select tagid from {$dbtbpre}enewstags where tagname='$tagname' limit 1");
		if($r[tagid])
		{
			$datar=$empire->fetch1("select tagid,classid,newstime from {$dbtbpre}enewstagsdata where tagid='$r[tagid]' and id='$id' and mid='$mid' limit 1");
			if($datar[tagid])
			{
				if($datar[classid]!=$classid||$datar[newstime]!=$newstime)
				{
					$empire->query("update {$dbtbpre}enewstagsdata set classid='$classid',newstime='$newstime' where tagid='$r[tagid]' and id='$id' and mid='$mid' limit 1");
				}
			}
			else
			{
				$empire->query("update {$dbtbpre}enewstags set num=num+1 where tagid='$r[tagid]'");
				$empire->query("insert into {$dbtbpre}enewstagsdata(tagid,classid,id,newstime,mid) values('$r[tagid]','$classid','$id','$newstime','$mid');");
			}
		}
		else
		{
			$empire->query("insert into {$dbtbpre}enewstags(tagname,num,isgood,cid) values('$tagname',1,0,0);");
			$tagid=$empire->lastid();
			$empire->query("insert into {$dbtbpre}enewstagsdata(tagid,classid,id,newstime,mid) values('$tagid','$classid','$id','$newstime','$mid');");
		}
	}
}

//返回信息TAGS
function eReturnInfoTags($classid,$id,$mid){
	global $empire,$dbtbpre,$class_r;
	if(!$mid||!$id)
	{
		return '';
	}
	$tags='';
	$dh='';
	$sql=$empire->query("select tagid from {$dbtbpre}enewstagsdata where id='$id' and mid='$mid' order by tagid");
	while($r=$empire->fetch($sql))
	{
		$tr=$empire->fetch1("select tagname from {$dbtbpre}enewstags where tagid='$r[tagid]'");
		$tags.=$dh.$tr[tagname];
		$dh=',';
	}
	return $tags;
}

//未審核表信息轉換
function MoveCheckInfoData($tbname,$checked,$stb,$where){
	global $empire,$dbtbpre;
	if(empty($checked))
	{
		$ytbname=$dbtbpre.'ecms_'.$tbname.'_check';
		$ydatatbname=$dbtbpre.'ecms_'.$tbname.'_check_data';
		$ntbname=$dbtbpre.'ecms_'.$tbname;
		$ndatatbname=$dbtbpre.'ecms_'.$tbname.'_data_'.$stb;
	}
	else
	{
		$ytbname=$dbtbpre.'ecms_'.$tbname;
		$ydatatbname=$dbtbpre.'ecms_'.$tbname.'_data_'.$stb;
		$ntbname=$dbtbpre.'ecms_'.$tbname.'_check';
		$ndatatbname=$dbtbpre.'ecms_'.$tbname.'_check_data';
	}
	$empire->query("replace into ".$ntbname." select * from ".$ytbname." where ".$where);
	$empire->query("replace into ".$ndatatbname." select * from ".$ydatatbname." where ".$where);
	//刪除原表
	$empire->query("delete from ".$ytbname." where ".$where);
	$empire->query("delete from ".$ydatatbname." where ".$where);
}

//更新副表字段內容
function UpdateAllDataTbField($tbname,$update,$where,$upcheck=1,$updoc=1){
	global $empire,$dbtbpre;
	//已審核
	$tbr=$empire->fetch1("select datatbs from {$dbtbpre}enewstable where tbname='$tbname' limit 1");
	if($tbr['datatbs'])
	{
		$dtbr=explode(',',$tbr['datatbs']);
		$count=count($dtbr);
		for($i=1;$i<$count-1;$i++)
		{
			$empire->query("update {$dbtbpre}ecms_".$tbname."_data_".$dtbr[$i]." set ".$update.$where);
		}
	}
	//未審核
	if($upcheck==1)
	{
		$empire->query("update {$dbtbpre}ecms_".$tbname."_check_data set ".$update.$where);
	}
	//歸檔
	if($updoc==1)
	{
		$empire->query("update {$dbtbpre}ecms_".$tbname."_doc_data set ".$update.$where);
	}
}

//刪除副表信息(批量)
function DelAllDataTbInfo($tbname,$where,$delcheck=1,$deldoc=1){
	global $empire,$dbtbpre;
	if(empty($where))
	{
		return '';
	}
	//已審核
	$tbr=$empire->fetch1("select datatbs from {$dbtbpre}enewstable where tbname='$tbname' limit 1");
	if($tbr['datatbs'])
	{
		$dtbr=explode(',',$tbr['datatbs']);
		$count=count($dtbr);
		for($i=1;$i<$count-1;$i++)
		{
			$empire->query("delete from {$dbtbpre}ecms_".$tbname."_data_".$dtbr[$i]." where ".$where);
		}
	}
	//未審核
	if($delcheck==1)
	{
		$empire->query("delete from {$dbtbpre}ecms_".$tbname."_check_data where ".$where);
	}
	//歸檔
	if($deldoc==1)
	{
		$empire->query("delete from {$dbtbpre}ecms_".$tbname."_doc_data where ".$where);
	}
}

//返回命名方式
function ReturnInfoFilename($classid,$id,$filenameqz){
	global $class_r;
	if($class_r[$classid][filename]==1)	//time命名
	{
		$filename=$class_r[$classid][filename_qz].time().$id;
	}
	elseif($class_r[$classid][filename]==2)	//md5命名
	{
		$filename=$class_r[$classid][filename_qz].md5(uniqid(microtime()));
	}
	elseif($class_r[$classid][filename]==3)	//目錄
	{
		$filename=$class_r[$classid][filename_qz].$id.'/index';
	}
	elseif($class_r[$classid][filename]==4)	//date命名
	{
		$filename=$class_r[$classid][filename_qz].date('Ymd').$id;
	}
	elseif($class_r[$classid][filename]==5)	//公共信息ID
	{
		$filename=$class_r[$classid][filename_qz].ReturnInfoPubid($classid,$id);
	}
	else	//id
	{
		$filename=$class_r[$classid][filename_qz].$id;
	}
	$filename=$filenameqz.$filename;
	return $filename;
}

//刪除其他相關附件
function DelFileOtherTable($where,$tb='other'){
	global $empire,$dbtbpre,$public_r;
	if(empty($where))
	{
		return '';
	}
	//刪除附件
	$filesql=$empire->query("select filename,path,modtype,fpath from {$dbtbpre}enewsfile_{$tb} where ".$where);
	while($filer=$empire->fetch($filesql))
	{
		DoDelFile($filer);
	}
	$empire->query("delete from {$dbtbpre}enewsfile_{$tb} where ".$where);
}

//按條件刪除信息附件
function DelFileAllTable($where){
	global $empire,$dbtbpre,$public_r;
	if(empty($where))
	{
		return '';
	}
	if($public_r['filedatatbs'])
	{
		$dtbr=explode(',',$public_r['filedatatbs']);
		$count=count($dtbr);
		for($i=1;$i<$count-1;$i++)
		{
			//刪除附件
			$filesql=$empire->query("select filename,path,classid,fpath from {$dbtbpre}enewsfile_".$dtbr[$i]." where ".$where);
			while($filer=$empire->fetch($filesql))
			{
				DoDelFile($filer);
			}
			$empire->query("delete from {$dbtbpre}enewsfile_".$dtbr[$i]." where ".$where);
		}
	}
}

//按條件刪除信息評論
function DelPlAllTable($where){
	global $empire,$dbtbpre,$public_r;
	if(empty($where))
	{
		return '';
	}
	if($public_r['pldatatbs'])
	{
		$pldtbr=explode(',',$public_r['pldatatbs']);
		$count=count($pldtbr)-1;
		for($i=1;$i<$count;$i++)
		{
			$empire->query("delete from {$dbtbpre}enewspl_".$pldtbr[$i]." where ".$where);
		}
	}
}

//更新相應的附件
function UpdateTheFile($id,$checkpass,$classid,$fstb=1){
	global $empire,$dbtbpre;
	if(empty($id)||empty($checkpass))
	{
		return "";
    }
	$id=(int)$id;
	$checkpass=(int)$checkpass;
	$classid=(int)$classid;
	$pubid=ReturnInfoPubid($classid,$id);
	$sql=$empire->query("update {$dbtbpre}enewsfile_{$fstb} set pubid='$pubid',classid='$classid',id='$id',cjid=0 where cjid='$checkpass'");
}

//修改時更新附件
function UpdateTheFileEdit($classid,$id,$fstb=1){
	global $empire,$dbtbpre;
	$pubid=ReturnInfoPubid($classid,$id);
	$sql=$empire->query("update {$dbtbpre}enewsfile_{$fstb} set pubid='$pubid',cjid=0 where id='$id' and classid='$classid'");
}

//獲取信息分表
function GetInfoTranFstb($classid,$id,$fstb){
	global $empire,$dbtbpre,$public_r,$class_r;
	if($id)
	{
		$classid=(int)$classid;
		$id=(int)$id;
		if(!$classid||!$class_r[$classid]['tbname'])
		{
			return $public_r['filedeftb'];
		}
		$index_r=$empire->fetch1("select id,classid,checked from {$dbtbpre}ecms_".$class_r[$classid]['tbname']."_index where id='$id' limit 1");
		if(!$index_r['id'])
		{
			return $public_r['filedeftb'];
		}
		//主表
		$infotb=ReturnInfoMainTbname($class_r[$classid]['tbname'],$index_r['checked']);//返回表
		$infor=$empire->fetch1("select fstb from ".$infotb." where id='$id' limit 1");
		$fstb=$infor['fstb'];
	}
	elseif($fstb)
	{
		$fstb=eReturnFileStb($fstb);
	}
	else
	{
		$fstb=$public_r['filedeftb'];
	}
	$fstb=(int)$fstb;
	return $fstb;
}

//更新ispic標識
function UpdateTheIspic($classid,$id,$checked){
	global $empire,$dbtbpre,$class_r;
	$infotb=empty($checked)?$dbtbpre.'ecms_'.$class_r[$classid][tbname].'_check':$dbtbpre.'ecms_'.$class_r[$classid][tbname];
	$r=$empire->fetch1("select titlepic,ispic from ".$infotb." where id='$id' limit 1");
	$ispic=$r['titlepic']?1:0;
	if($ispic<>$r['ispic'])
	{
		$empire->query("update ".$infotb." set ispic='$ispic' where id='$id'");
	}
}

//取第幾張圖片
function GetFpicToTpic($classid,$id,$num=1,$getfirsttitlespic=0,$swidth=0,$sheight=0,$fstb=1){
	global $empire,$dbtbpre,$public_r,$class_r;
	$pubid=ReturnInfoPubid($classid,$id);
	$num=(int)$num;
	$num=$num-1;
	$picr=$empire->fetch1("select fileid,filename,path,id,classid,no,fpath from {$dbtbpre}enewsfile_{$fstb} where pubid='$pubid' and type=1 order by fileid limit $num,1");
	$firsttitlepic="";
	if($picr['fileid'])
	{
		$rpath=$picr['path']?$picr['path'].'/':$picr['path'];
		$fspath=ReturnFileSavePath($picr[classid],$picr[fpath]);
		if($getfirsttitlespic==1&&$swidth&&$sheight)//縮略圖
		{
			$path=eReturnEcmsMainPortPath().$fspath['filepath'].$rpath;//moreport
			$yname=$path.$picr[filename];
			$filetype=GetFiletype($picr[filename]);
			$insertfile=substr($picr[filename],0,strlen($picr[filename])-strlen($filetype)).time();
			$name=$path."small".$insertfile;
			$sfiler=GetMySmallImg($classid,$picr[no],$insertfile,$picr[path],$yname,$swidth,$sheight,$name,$id,$add['filepass'],$userid,$username,0,$fstb);
			$firsttitlepic=$fspath['fileurl'].$rpath."small".$insertfile.$sfiler['filetype'];
		}
		else
		{
			$firsttitlepic=$fspath['fileurl'].$rpath.$picr[filename];
		}
	}
	return $firsttitlepic;
}

//更新替換圖片下一頁鏈接內容
function UpdateImgNexturl($classid,$id,$checked=1){
	global $empire,$dbtbpre,$class_r,$public_r,$emod_r;
	$mid=$class_r[$classid][modid];
	$tbname=$class_r[$classid][tbname];
	$pf=$emod_r[$mid]['pagef'];
	$stf=$emod_r[$mid]['savetxtf'];
	if(!$pf)
	{
		return '';
	}
	$infotbname=$checked?$dbtbpre.'ecms_'.$tbname:$dbtbpre.'ecms_'.$tbname.'_check';
	//分頁字段
	$tbdataf=strstr($emod_r[$mid]['tbdataf'],','.$pf.',')?1:0;
	if($tbdataf)
	{
		$r=$empire->fetch1("select id,classid,titleurl,groupid,newspath,filename,stb from ".$infotbname." where id='$id'");
		$infodatatbname=$checked?$dbtbpre.'ecms_'.$tbname.'_data_'.$r[stb]:$dbtbpre.'ecms_'.$tbname.'_check_data';
		$finfor=$empire->fetch1("select ".$pf." from ".$infodatatbname." where id='$id'");
		$r[$pf]=$finfor[$pf];
	}
	else
	{
		$r=$empire->fetch1("select id,classid,titleurl,groupid,newspath,filename,".$pf." from ".$infotbname." where id='$id'");
	}
	//存文本
	if($stf&&$stf==$pf)
	{
		$newstextfile=$r[$stf];
		$r[$stf]=GetTxtFieldText($r[$stf]);
	}
	if(!$r[$pf])
	{
		return '';
	}
	$newstext=RepNewstextImgLink($r[$pf],$r);
	if(empty($newstext))
	{
		return '';
	}
	//存文本
	if($stf&&$stf==$pf)
	{
		EditTxtFieldText($newstextfile,$newstext);
		return '';
	}
	if($tbdataf)
	{
		$empire->query("update ".$infodatatbname." set ".$pf."='$newstext' where id='$id'");
	}
	else
	{
		$empire->query("update ".$infotbname." set ".$pf."='$newstext' where id='$id'");
	}
}

//給圖片加下一頁鏈接
function RepNewstextImgLink($newstext,$add){
	global $public_r;
	$expage='[!--empirenews.page--]';//分頁符
	if(!stristr($newstext,$expage)||!stristr($newstext,'<img '))
	{
		return '';
	}
	$newstext=stripSlashes($newstext);
	$repurl='[!--empirecms.rep.nextpageurl--]';
	$newstext=DoRepImgLink($newstext,$repurl);
	$nr=explode($expage,$newstext);
	$count=count($nr);
	//頁面地址
	$urlqzr=ReturnInfoPageQz($add);
	$lastpageurl=$public_r['newsurl'].'e/public/ClassUrl/?classid='.$add['classid'];	//最後一頁鏈接地址
	$new_newstext='';
	$addexpage='';
	for($i=0;$i<$count;$i++)
	{
		$thispagetext=$nr[$i];
		if(stristr($thispagetext,'<img '))
		{
			if($i==$count-1)
			{
				$newurl=$lastpageurl;
			}
			else
			{
				//下一頁鏈接
				if($urlqzr['nametype']==1)
				{
					$newurl=eReturnRewritePageLink($urlqzr,$i+1);
				}
				else
				{
					$newurl=$urlqzr['titleurl'].'_'.($i+2).$urlqzr['filetype'];
				}
			}
			$thispagetext=str_replace($repurl,$newurl,$thispagetext);
		}
		$new_newstext.=$addexpage.$thispagetext;
		$addexpage=$expage;
	}
	return addslashes($new_newstext);
}

//返回相關鏈接信息ID
function GetKeyid($keyboard,$classid,$id,$link_num){
	global $empire,$public_r,$class_r,$fun_r,$dbtbpre,$eyh_r,$etable_r;
	if($keyboard)
	{
		if(empty($link_num))
		{
			return '';
		}
		$keyboard=RepDyh($keyboard);
		$r=explode(",",$keyboard);
		for($i=0;$i<count($r);$i++)
		{
			if($i==0)
			{
				$or="";
			}
			else
			{
				$or=" or ";
			}
			$repadd.=$or."[!--f--!]"." like '%".$r[$i]."%'";
	    }
		//搜索範圍
		if($public_r['newslink']==1)
		{
			$add='('.str_replace('[!--f--!]','keyboard',$repadd).')';
		}
		elseif($public_r['newslink']==2)
		{
			$add='('.str_replace('[!--f--!]','keyboard',$repadd).' or '.str_replace('[!--f--!]','title',$repadd).')';
		}
		else
		{
			$add='('.str_replace('[!--f--!]','title',$repadd).')';
		}
		//模型
		if(!empty($class_r[$classid][modid]))
		{
			$mr=$empire->fetch1("select sonclass from {$dbtbpre}enewsmod where mid='".$class_r[$classid][modid]."'");
			$where=" and (".ReturnClass($mr[sonclass]).")";
		}
		//優化
		$tbname=$class_r[$classid][tbname];
		$yhvar='otherlink';
		$yhid=$etable_r[$tbname][yhid];
		$yhadd='';
		if($yhid)
		{
			$yhadd=ReturnYhSql($yhid,$yhvar,1);
		}
		//ID聲名
		$keyid="";
		$first=0;
		$key_sql=$empire->query("select id from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where ".$yhadd.$add.$where." and id<>$id order by newstime desc limit $link_num");
		while($link_r=$empire->fetch($key_sql))
		{
			if(empty($first))
			{
				$dh="";
				$first=1;
			}
			else
			{
				$dh=",";
			}
			$keyid.=$dh.$link_r[id];
		}
	}
	else
	{
		$keyid="";
	}
	return $keyid;
}

//刪除信息存文本文件
function DelInfoSaveTxtfile($mid,$tbname,$where){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r;
	if(empty($where))
	{
		return '';
	}
	$savetxtf=$emod_r[$mid]['savetxtf'];
	if($savetxtf)
	{
		//已審核
		$txtsql=$empire->query("select ".$savetxtf." from {$dbtbpre}ecms_".$tbname." where ".$where);
		while($txtr=$empire->fetch($txtsql))
		{
			$newstextfile=$txtr[$savetxtf];
			//$txtr[$savetxtf]=GetTxtFieldText($txtr[$savetxtf]);
			DelTxtFieldText($newstextfile);//刪除文件
		}
		//未審核
		$txtsql=$empire->query("select ".$savetxtf." from {$dbtbpre}ecms_".$tbname."_check where ".$where);
		while($txtr=$empire->fetch($txtsql))
		{
			$newstextfile=$txtr[$savetxtf];
			//$txtr[$savetxtf]=GetTxtFieldText($txtr[$savetxtf]);
			DelTxtFieldText($newstextfile);//刪除文件
		}
		//歸檔
		$txtsql=$empire->query("select ".$savetxtf." from {$dbtbpre}ecms_".$tbname."_doc where ".$where);
		while($txtr=$empire->fetch($txtsql))
		{
			$newstextfile=$txtr[$savetxtf];
			//$txtr[$savetxtf]=GetTxtFieldText($txtr[$savetxtf]);
			DelTxtFieldText($newstextfile);//刪除文件
		}
	}
}

//刪除信息相關記錄
function DelSingleInfoOtherData($classid,$id,$r,$delfile=0,$delpl=0){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r;
	$pubid=ReturnInfoPubid($classid,$id);
	//刪除其它表記錄
	$empire->query("delete from {$dbtbpre}enewswfinfo where id='$id' and classid='$classid'");
	$empire->query("delete from {$dbtbpre}enewswfinfolog where id='$id' and classid='$classid'");
	$empire->query("delete from {$dbtbpre}enewsinfovote where pubid='$pubid'");
	$empire->query("delete from {$dbtbpre}enewsdiggips where id='$id' and classid='$classid'");
	$empire->query("delete from {$dbtbpre}enewsztinfo where id='$id' and classid='$classid'");
	if($delfile==0)
	{
		DelNewsTheFile($id,$classid,$r['fstb'],$delpl,$r['restb']);//刪除附件
	}
}

//刪除信息相關記錄(整欄目)
function DelMoreInfoOtherData($classid,$delfile=0,$delpl=0){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r;
	//刪除其它表記錄
	$empire->query("delete from {$dbtbpre}enewswfinfo where classid='$classid'");
	$empire->query("delete from {$dbtbpre}enewswfinfolog where classid='$classid'");
	$empire->query("delete from {$dbtbpre}enewsinfovote where classid='$classid'");
	$empire->query("delete from {$dbtbpre}enewsdiggips where classid='$classid'");
	$empire->query("delete from {$dbtbpre}enewsztinfo where classid='$classid'");
	//附件
	if($delfile==0)
	{
		DelFileAllTable("classid='$classid'");
	}
	//評論
	if($delpl==0)
	{
		DelPlAllTable("classid='$classid'");
	}
}

//更新信息相關記錄
function UpdateSingleInfoOtherData($classid,$id,$to_classid,$r,$updatefile=0,$updatepl=0){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r;
	$pubid=ReturnInfoPubid($classid,$id);
	//更新其它表記錄
	$empire->query("update {$dbtbpre}enewswfinfo set classid='$to_classid' where id='$id' and classid='$classid'");
	$empire->query("update {$dbtbpre}enewswfinfolog set classid='$to_classid' where id='$id' and classid='$classid'");
	$empire->query("update {$dbtbpre}enewsinfovote set classid='$to_classid' where pubid='$pubid'");
	$empire->query("update {$dbtbpre}enewsdiggips set classid='$to_classid' where id='$id' and classid='$classid'");
	$empire->query("update {$dbtbpre}enewsztinfo set classid='$to_classid' where id='$id' and classid='$classid'");
	//附件
	if($updatefile==0)
	{
		$empire->query("update {$dbtbpre}enewsfile_".$r['fstb']." set classid='$to_classid' where pubid='$pubid'");
	}
	//評論
	if($updatepl==0)
	{
		$empire->query("update {$dbtbpre}enewspl_".$r['restb']." set classid='$to_classid' where pubid='$pubid'");
	}
}

//更新信息相關記錄(整欄目)
function UpdateMoreInfoOtherData($classid,$to_classid,$updatefile=0,$updatepl=0){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r;
	//更新其它表記錄
	$empire->query("update {$dbtbpre}enewswfinfo set classid='$to_classid' where classid='$classid'");
	$empire->query("update {$dbtbpre}enewswfinfolog set classid='$to_classid' where classid='$classid'");
	$empire->query("update {$dbtbpre}enewsinfovote set classid='$to_classid' where classid='$classid'");
	$empire->query("update {$dbtbpre}enewsdiggips set classid='$to_classid' where classid='$classid'");
	$empire->query("update {$dbtbpre}enewsztinfo set classid='$to_classid' where classid='$classid'");
	//附件
	if($updatefile==0)
	{
		if($public_r['filedatatbs'])
		{
			$dtbr=explode(',',$public_r['filedatatbs']);
			$count=count($dtbr);
			for($i=1;$i<$count-1;$i++)
			{
				$empire->query("update {$dbtbpre}enewsfile_".$dtbr[$i]." set classid='$to_classid' where classid='$classid'");
			}
		}
	}
	//評論
	if($updatepl==0)
	{
		if($public_r['pldatatbs'])
		{
			$pldtbr=explode(',',$public_r['pldatatbs']);
			$count=count($pldtbr)-1;
			for($i=1;$i<$count;$i++)
			{
				$empire->query("update {$dbtbpre}enewspl_".$pldtbr[$i]." set classid='$to_classid' where classid='$classid'");
			}
		}
	}
}

//刪除信息附件
function DelNewsTheFile($id,$classid,$fstb='1',$delpl=0,$restb='1'){
	global $empire,$dbtbpre;
	if(empty($id))
	{
		return "";
	}
	$pubid=ReturnInfoPubid($classid,$id);
	$i=0;
	$sql=$empire->query("select classid,filename,path,fpath from {$dbtbpre}enewsfile_{$fstb} where pubid='$pubid'");
	while($r=$empire->fetch($sql))
	{
		$i=1;
		DoDelFile($r);
    }
	if($i)
	{
		$empire->query("delete from {$dbtbpre}enewsfile_{$fstb} where pubid='$pubid'");
	}
	//刪除評論
	if($delpl==0)
	{
		$empire->query("delete from {$dbtbpre}enewspl_{$restb} where pubid='$pubid'");
	}
}

//刪除信息文件
function DelNewsFile($filename,$newspath,$classid,$newstext,$groupid=0){
	global $class_r,$addgethtmlpath;
	//文件類型
	if($groupid)
	{
		$filetype=".php";
	}
	else
	{
		$filetype=$class_r[$classid][filetype];
	}
	//是否有日期目錄
	if(empty($newspath))
	{
		$mynewspath="";
    }
	else
	{
		$mynewspath=$newspath."/";
    }
	$iclasspath=ReturnSaveInfoPath($classid,$id);
	$r=explode("[!--empirenews.page--]",$newstext);
	for($i=1;$i<=count($r);$i++)
	{
		if(strstr($filename,'/'))
		{
			DelPath(eReturnTrueEcmsPath().$iclasspath.$mynewspath.ReturnInfoSPath($filename));
		}
		else
		{
			if($i==1)
			{
				$file=eReturnTrueEcmsPath().$iclasspath.$mynewspath.$filename.$filetype;
			}
			else
			{
				$file=eReturnTrueEcmsPath().$iclasspath.$mynewspath.$filename."_".$i.$filetype;
			}
			DelFiletext($file);
		}
	}
}

//刪除專題子類列表文件
function DelZtcFile($cid){
	global $empire,$dbtbpre,$class_zr;
	$cr=$empire->fetch1("select ztid,islist,maxnum,tnum,ttype from {$dbtbpre}enewszttype where cid='$cid'");
	if(!$cr['ztid'])
	{
		return '';
	}
	//文件類型
	$filetype=$cr['ttype'];
	$doclasspath=ReturnSaveZtPath($cr['ztid'],0);
	$dopath=ECMS_PATH.$doclasspath."/";
	//單頁
	if($cr['islist']!=1)
	{
		$file=$dopath.'type'.$cid.$filetype;
		DelFiletext($file);
		return '';
	}
	//數量
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsztinfo where cid='$cid'");
	$totalpage=ceil($num/$cr['tnum']);
	for($i=1;$i<=$totalpage;$i++)
	{
		if($i==1)
		{
			$file=$dopath.'type'.$cid.$filetype;
		}
		else
		{
			$file=$dopath.'type'.$cid.'_'.$i.$filetype;
		}
		DelFiletext($file);
	}
}

//替換圖片標籤
function RepImg($text,$copyflash){
	global $ecms_config;
	$exp1="[--copyimg--]";
	$exp2="[/--copyimg--]";
	//去掉圖片鏈接
	if($ecms_config['sets']['saveurlimgclearurl']==1)
	{
		$zz2="/\<(a|A) (.*?)(href|Href)=('|\"|\\\\\"|)(.+?)><(img|IMG) (.*?)(src|SRC)=('|\"|\\\\\"|)(.+?)(\.jpg|\.JPG|\.gif|\.GIF|\.png|\.PNG|\.bmp|\.BMP|\.jpeg|\.JPEG)(.*?)><\/(a|A)>/is";
		$text=preg_replace($zz2,"<\\6 \\7\\8=\\9\\10\\11\\12>",$text);
	}
	$zz1="/\<(img|IMG) (.*?)(src|SRC)=('|\"|\\\\\"|)(.+?)(\.jpg|\.JPG|\.gif|\.GIF|\.png|\.PNG|\.bmp|\.BMP|\.jpeg|\.JPEG)(.*?)>/is";
	$text=preg_replace($zz1,"<\\1 \\2\\3=\\4".$exp1."\\5\\6".$exp2."\\7>",$text);
	return $text;
}

//替換flash標籤
function RepFlash($text,$copyflash){
	$exp1="[--copyimg--]";
	$exp2="[/--copyimg--]";
	//去掉flash多餘鏈接
	$zz2="/\<(embed|EMBED) (.*?)(src|SRC)=('|\"|\\\\\"|)(.+?)(\.swf|\.SWF)(.*?)>(.*?)<\/(embed|EMBED)>/is";
	$text=preg_replace($zz2,"",$text);
	$zz3="/\<(param|PARAM) (name|NAME)=\"(Src|src|SRC)\" (.*?)(value|VALUE)=('|\"|\\\\\"|)(.+?)(\.swf|\.SWF)(.*?)>/is";
	$text=preg_replace($zz3,"",$text);

	$zz1="/\<(param|PARAM) (.*?)(name|NAME)=\"(movie|MOVIE)\" (.*?)(value|VALUE)=('|\"|\\\\\"|)(.+?)(\.swf|.SWF)(\.*?)>/is";
	$text=preg_replace($zz1,"<\\1 \\2\\3=\"\\4\" \\5\\6=\\7".$exp1."\\8\\9".$exp2."\\10>",$text);
	return $text;
}

//替換圖片鏈接
function DoRepImgLink($text,$newurl){
	//去掉圖片鏈接
	$zz2="/\<(a|A) (.*?)(href|Href)=('|\"|\\\\\"|)(.+?)><(img|IMG) (.*?)(src|SRC)=('|\"|\\\\\"|)(.*?)><\/(a|A)>/is";
	$text=preg_replace($zz2,"<\\6 \\7\\8=\\9\\10>",$text);
	//新鏈接
	$zz1="/\<(img|IMG) (.*?)(src|SRC)=('|\"|\\\\\"|)(.*?)>/is";
	$text=preg_replace($zz1,"<a href=\"".$newurl."\"><\\1 \\2\\3=\\4\\5></a>",$text);
	return $text;
}

//截取圖片
function CopyImg($text,$copyimg,$copyflash,$classid,$qz,$username,$theid,$cjid,$mark,$fstb=1){
	global $empire,$public_r,$cjnewsurl,$navtheid,$dbtbpre;
	if(empty($text))
	{return "";}
	$navtheid=(int)$navtheid;
	$fstb=(int)$fstb;
	if($copyimg)
	{
		$text=RepImg($text,$copyflash);
	}
	if($copyflash)
	{$text=RepFlash($text,$copyflash);}
	$exp1="[--copyimg--]";
	$exp2="[/--copyimg--]";
	$r=explode($exp1,$text);
	for($i=1;$i<count($r);$i++)
	{
		$r1=explode($exp2,$r[$i]);
		if(strstr($r1[0],"http://")||strstr($r1[0],"https://"))
	    {
			$dourl=$r1[0];
		}
		else
	    {
			//是否是本地址
			if(!strstr($r1[0],"/")&&$cjnewsurl)
			{
				$fileqz_r=GetPageurlQz($cjnewsurl);
				$fileqz=$fileqz_r['selfqz'];
				$dourl=$fileqz.$r1[0];
			}
			else
			{
				$dourl=$qz.$r1[0];
			}
		}
		$return_r=DoTranUrl($dourl,$classid);
		$text=str_replace($exp1.$r1[0].$exp2,$return_r[url],$text);
		if($return_r[tran])
	    {
			//記錄數據庫
			//變量處理
			$return_r[filesize]=(int)$return_r[filesize];
			$classid=(int)$classid;
			$return_r[type]=(int)$return_r[type];
			$theid=(int)$theid;
			$cjid=(int)$cjid;
			eInsertFileTable($return_r[filename],$return_r[filesize],$return_r[filepath],$username,$classid,'[URL]'.$return_r[filename],$return_r[type],$theid,$cjid,$public_r[fpath],0,0,$fstb);
			//加水
			if($mark&&$return_r[type]==1)
			{
				GetMyMarkImg($return_r['yname']);
			}
        }
	}
	return $text;
}

//生成縮略圖
function GetMySmallImg($classid,$no,$insertfile,$filepath,$yname,$maxwidth,$maxheight,$name,$id,$cjid,$userid,$username,$modtype=0,$fstb=1){
	global $empire,$dbtbpre,$public_r,$efileftp_fr;
	if(empty($yname))
	{
		return "";
    }
	$no="[s]".$no;
	$maxwidth=(int)$maxwidth;
	$maxheight=(int)$maxheight;
	$filer=ResizeImage($yname,$name,$maxwidth,$maxheight,$public_r['spickill']);
	if($filer['file'])
	{
		$insertfile="small".$insertfile.$filer['filetype'];
		$filesize=@filesize($filer['file']);
		//寫入數據庫
		$pubid=0;
		if($id&&!$cjid)
		{
			$pubid=ReturnInfoPubid($classid,$id);
		}
		//變量處理
		$filesize=(int)$filesize;
		$classid=(int)$classid;
		$id=(int)$id;
		$cjid=(int)$cjid;
		eInsertFileTable($insertfile,$filesize,$filepath,$username,$classid,$no,1,$id,$cjid,$public_r[fpath],$pubid,$modtype,$fstb);
		//FileServer
		if($public_r['openfileserver'])
		{
			$efileftp_fr[]=$name.$filer['filetype'];
		}
    }
	return $filer;
}

//圖片加水印
function GetMyMarkImg($groundImage){
	global $public_r;
	if(empty($groundImage))
	{
		return "";
    }
	imageWaterMark($groundImage,$public_r['markpos'],$public_r['markimg'],$public_r['marktext'],$public_r['markfontsize'],$public_r['markfontcolor'],$public_r['markfont'],$public_r['markpct'],$public_r['jpgquality']);
}

//投票組合
function ReturnVote($votename,$votenum,$delvid,$vid,$enews=0){
	global $empire,$dbtbpre;
	$f_exp="::::::";
	$r_exp="\r\n";
	$returnstr="";
	//增加投票
	if(empty($enews))
	{
		for($i=0;$i<count($votename);$i++)
		{
			//替換非法字符
			$name=str_replace($f_exp,"",$votename[$i]);
			$name=str_replace($r_exp,"",$name);
			$num=str_replace($f_exp,"",$votenum[$i]);
			$num=str_replace($r_exp,"",$num);
			if($name)
			{
				if(empty($num))
				{$num=0;}
				$returnstr.=$name.$f_exp.$num.$r_exp;
			}
		}
	}
	//修改投票
	else
	{
		for($i=0;$i<count($votename);$i++)
		{
			//刪除下載地址
			$del=0;
			for($j=0;$j<count($delvid);$j++)
			{
				if($delvid[$j]==$vid[$i])
				{$del=1;}
			}
			if($del)
			{continue;}
			//替換非法字符
			$name=str_replace($f_exp,"",$votename[$i]);
			$name=str_replace($r_exp,"",$name);
			$num=str_replace($f_exp,"",$votenum[$i]);
			$num=str_replace($r_exp,"",$num);
			if($name)
			{
				if(empty($num))
				{$num=0;}
				$returnstr.=$name.$f_exp.$num.$r_exp;
			}
		}
	}
	/*
	if(empty($returnstr))
	{printerror("EmptyVotenum","history.go(-1)");}
	*/
	//去掉最後的字符
	$returnstr=substr($returnstr,0,strlen($returnstr)-2);
	return $returnstr;
}

//顯示無限級欄目[增加欄目時]
function ShowClass_AddClass($adminclass,$obclassid,$bclassid,$exp,$modid,$enews=0,$addminfocid=''){
	global $empire,$dbtbpre,$public_r;
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="|-";
		if($enews==2)
		{
			$modr=$empire->fetch1("select sonclass from {$dbtbpre}enewsmod where mid='$modid'");
			$addminfocid=$modr['sonclass'];
		}
    }
	else
	{$exp="&nbsp;&nbsp;".$exp;}
	$sql=$empire->query("select classid,classname,bclassid,islast,openadd,modid,sonclass from {$dbtbpre}enewsclass where bclassid='$bclassid' and wburl='' order by myorder,classid");
	$returnstr="";
	while($r=$empire->fetch($sql))
	{
		//投稿顯示
		if($enews==2)
		{
			if($r[openadd])
			{
				continue;
			}
			if(CheckHaveInClassid($r,$addminfocid)==0)
			{
				continue;
			}
		}
		if($r[islast])
		{
			if(empty($enews)||$enews==2||$enews==3||$enews==4)
			{
				$color=" style='background:".$public_r['chclasscolor']."'";
			}
			//隱藏不能投稿的欄目
			if($enews==2)
			{
				if($modid)
				{
					if($r[modid]<>$modid)
				    {continue;}
				}
			}
			//模型
			if($enews==4)
			{
				if($r[modid]<>$modid)
				{continue;}
			}
		}
		else
		{$color="";}
		if($r[classid]==$obclassid)
		{$select=" selected";}
		else
		{$select="";}
		//-----------增加用戶時
		if($enews==3)
		{
			$c=explode("|".$r[classid]."|",$adminclass);
			if(count($c)>1)
			{$select=" selected";}
			else
			{$select="";}
	    }
		$returnstr.="<option value=".$r[classid].$select.$color.">".$exp.$r[classname]."</option>";
		if(empty($r[islast]))
		{
			$returnstr.=ShowClass_AddClass($adminclass,$obclassid,$r[classid],$exp,$modid,$enews,$addminfocid);
		}
	}
	return $returnstr;
}

//設置伸縮
function SetDisplayClass($open){
	$time=time()+365*24*3600;
	$set=esetcookie("displayclass",$open,$time,1);
	echo"<script>self.location.href='ListClass.php".hReturnEcmsHashStrHref2(1)."';</script>";
	exit();
}

//刪除目錄函數
function DelPath($DelPath){
	if($DelPath=="../../"||$DelPath=="../../d/file/")
	{return "";}
	$wm_chief=new del_path();
	$wm_chief_ok=$wm_chief->wm_chief_delpath($DelPath);
	return $wm_chief_ok;
}

//複製目錄
function CopyPath($oldpath,$newpath){
	$wm_chief=new copy_path();
    $wm_chief_ok=$wm_chief->wm_chief_copypath($oldpath,$newpath);
	return $wm_chief_ok;
}

//移動目錄
function MovePath($oldpath,$newpath){
	//複製
	CopyPath($oldpath,$newpath);
	//刪除
	DelPath($oldpath);
}

//替換字符
function RepInfoZZ($text,$exp,$enews=0){
	$text=str_replace(".","\\.",$text);
	$text=str_replace("(","\\(",$text);
	$text=str_replace(")","\\)",$text);
	$text=str_replace("?","\\?",$text);
	$text=str_replace("*","(.*?)",$text);
	$text=str_replace("[!--".$exp."--]","(.*?)",$text);
	//$text=str_replace("\\","\\\\",$text);
	//$text=str_replace("\"","\"",$text);
	$text=str_replace("/","\\/",$text);
	$text=str_replace("-","\\-",$text);
	$text=str_replace("|","\\|",$text);
	$text=str_replace("+","\\+",$text);
	$text=str_replace("^","\\^",$text);
	$text=str_replace("{","\\{",$text);
	$text=str_replace("}","\\}",$text);
	$text=str_replace("[","\\[",$text);
	$text=str_replace("]","\\]",$text);
	$text=str_replace("\$","\\\$",$text);
	$text="/".$text."/is";
	return $text;
}

//取得地址前綴
function GetPageurlQz($self){
	$sr=explode("/",$self);
	$count=count($sr)-1;
	$sfile=$sr[$count];
	$r[selfqz]=substr($self,0,strlen($self)-strlen($sfile));
	//取得域名
	$sr1=explode("http://",$self);
	$sr2=explode("/",$sr1[1]);
	$r[domain]="http://".$sr2[0];
	return $r;
}

//去掉單引號
function RepDyh($text){
	//$text=str_replace("\'","\\\'",stripSlashes($text));
	$text=addslashes(stripSlashes($text));
	return $text;
}

//補零
function AddNumZero($no,$endno){
	$len=strlen($endno);
	$forlen=$len-strlen($no);
	for($i=1;$i<=$forlen;$i++)
	{
		$no="0".$no;
	}
	return $no;
}

//自動分頁
function AutoDoPage($mybody,$spsize){
  $sptag="[!--empirenews.page--]";
  if(strlen($mybody)<$spsize) return $mybody;
  $bds = explode('<',$mybody);
  $npageBody = "";
  $istable = 0;
  $mybody = "";
  foreach($bds as $i=>$k)
  {
  	 if($i==0){ $npageBody .= $bds[$i]; continue;}
  	 $bds[$i] = "<".$bds[$i];
  	 if(strlen($bds[$i])>6){
  		  $tname = substr($bds[$i],1,5);
  		  if(strtolower($tname)=='table') $istable++;
  		  else if(strtolower($tname)=='/tabl') $istable--;
  		  if($istable>0){ $npageBody .= $bds[$i]; continue; }
  		  else $npageBody .= $bds[$i];
  	 }else{
  		  $npageBody .= $bds[$i];
  	 }
  	 if(strlen($npageBody)>$spsize){
  		  $mybody .= $npageBody.$sptag;
  		  $npageBody = "";
     }
  }
  if($npageBody!="") $mybody .= $npageBody;
  return $mybody;
}



//-------------- 模板區 ----------------------

//取得模型ID
function GetListtempMid($tempid){
	global $empire;
	$r=$empire->fetch1("select modid from ".GetTemptb("enewslisttemp")." where tempid='$tempid'");
	return $r[modid];
}

//替換模板JS地址
function RepTemplateJsUrl($temp,$classid,$enews=0){
	global $public_r,$class_r,$class_zr;
	$allpath='[!--news.url--]d/js/js/';
	$temp=str_replace("[!--hotnews--]","<script src='".$allpath."hotnews.js'></script>",$temp);
	$temp=str_replace("[!--newnews--]","<script src='".$allpath."newnews.js'></script>",$temp);
	$temp=str_replace("[!--goodnews--]","<script src='".$allpath."goodnews.js'></script>",$temp);
	$temp=str_replace("[!--hotplnews--]","<script src='".$allpath."hotplnews.js'></script>",$temp);
	$temp=str_replace("[!--firstnews--]","<script src='".$allpath."firstnews.js'></script>",$temp);
	if(!empty($classid))
	{
		$path=$enews==1?'[!--news.url--]d/js/class/zt[!--self.classid--]_':'[!--news.url--]d/js/class/class[!--self.classid--]_';
		$temp=str_replace("[!--self.hotnews--]","<script src='".$path."hotnews.js'></script>",$temp);
		$temp=str_replace("[!--self.newnews--]","<script src='".$path."newnews.js'></script>",$temp);
		$temp=str_replace("[!--self.goodnews--]","<script src='".$path."goodnews.js'></script>",$temp);
		$temp=str_replace("[!--self.hotplnews--]","<script src='".$path."hotplnews.js'></script>",$temp);
		$temp=str_replace("[!--self.firstnews--]","<script src='".$path."firstnews.js'></script>",$temp);
	}
	return $temp;
}




//-------------- 生成區 ----------------------

//取得列表模板
function GetListTemp($tempid){
	global $empire;
	$r=$empire->fetch1("select temptext,subnews,listvar,rownum,showdate,modid,subtitle,docode from ".GetTemptb("enewslisttemp")." where tempid='$tempid'");
	$r[temptext]=InfoNewsBq('list'.$tempid,$r[temptext]);
	return $r;
}

//取得封面模板
function GetClassTemp($tempid){
	global $empire;
	$r=$empire->fetch1("select temptext from ".GetTemptb("enewsclasstemp")." where tempid='$tempid'");
	return $r['temptext'];
}

//取得欄目頁面內容
function GetClassText($classid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select classtext from {$dbtbpre}enewsclassadd where classid='$classid'");
	return $r['classtext'];
}

//取得專題頁面內容
function GetZtText($ztid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select classtext from {$dbtbpre}enewsztadd where ztid='$ztid'");
	return $r['classtext'];
}

//取得專題子類頁面內容
function GetZtcText($cid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select classtext from {$dbtbpre}enewszttypeadd where cid='$cid'");
	return $r['classtext'];
}

//取得首頁模板
function GetIndextemp(){
	global $empire,$dbtbpre,$public_r;
	if($public_r['indexpageid'])
	{
		$r=$empire->fetch1("select temptext from {$dbtbpre}enewsindexpage where tempid='".$public_r['indexpageid']."'");
		return $r['temptext'];
	}
	$r=$empire->fetch1("select indextemp from ".GetTemptb("enewspubtemp")." limit 1");
	return $r['indextemp'];
}

//取得內容模板
function GetNewsTemp($newstempid){
	global $empire,$public_r;
	$r=$empire->fetch1("select temptext,showdate from ".GetTemptb("enewsnewstemp")." where tempid='$newstempid'");
	$r[temptext]=InfoNewsBq('news'.$newstempid,$r[temptext]);
	if($public_r[opennotcj])//啟用反採集
	{
		$r[temptext]=ReturnNotcj($r[temptext]);
    }
	return $r;
}

//取得js模板
function GetTheJstemp($tempid){
	global $empire;
	$r=$empire->fetch1("select temptext,showdate,modid,subnews,subtitle from ".GetTemptb("enewsjstemp")." where tempid='$tempid'");
	return $r;
}

//替換全局模板變量
function ReplaceTempvar($temp){
	global $empire;
	if(empty($temp))
	{return $temp;}
	$sql=$empire->query("select myvar,varvalue from ".GetTemptb("enewstempvar")." where isclose=0 order by myorder desc,varid");
	while($r=$empire->fetch($sql))
	{
		$temp=str_replace('[!--temp.'.$r[myvar].'--]',$r[varvalue],$temp);
    }
	return $temp;
}

//欄目頁替換公共標記
function Class_ReplaceSvars($temp,$url,$classid,$title,$key,$des,$classimg,$add,$enews=0){
	global $public_r,$class_r,$class_zr;
	$temp=str_replace('[!--class.menu--]',$public_r['classnavs'],$temp);//欄目導航
	$temp=str_replace('[!--pagetitle--]',$title,$temp);
	$temp=str_replace('[!--pagekey--]',$key,$temp);
	$temp=str_replace('[!--pagedes--]',$des,$temp);
	$temp=str_replace('[!--class.intro--]',$des,$temp);
	$temp=str_replace('[!--class.keywords--]',$key,$temp);
	$temp=str_replace('[!--class.classimg--]',$classimg,$temp);
	$temp=str_replace('[!--self.classid--]',$classid,$temp);
	if($enews==0)//欄目
	{
		$temp=str_replace('[!--class.name--]',$class_r[$classid]['classname'],$temp);
		$bclassid=$class_r[$classid]['bclassid'];
		$temp=str_replace('[!--bclass.id--]',$bclassid,$temp);
		$temp=str_replace('[!--bclass.name--]',$class_r[$bclassid]['classname'],$temp);
		$path=$public_r['newsurl'].'d/js/class/class'.$classid.'_';
	}
	else//專題
	{
		$temp=str_replace('[!--class.name--]',$class_zr[$classid]['ztname'],$temp);
		$path=$public_r['newsurl'].'d/js/class/zt'.$classid.'_';
	}
	$allpath=$public_r[newsurl].'d/js/js/';
	//熱門文章
	$temp=str_replace("[!--hotnews--]","<script src='".$allpath."hotnews.js'></script>",$temp);
	$temp=str_replace("[!--self.hotnews--]","<script src='".$path."hotnews.js'></script>",$temp);
	//點擊排行
	$temp=str_replace("[!--newnews--]","<script src='".$allpath."newnews.js'></script>",$temp);
	$temp=str_replace("[!--self.newnews--]","<script src='".$path."newnews.js'></script>",$temp);
	//推薦
	$temp=str_replace("[!--goodnews--]","<script src='".$allpath."goodnews.js'></script>",$temp);
	$temp=str_replace("[!--self.goodnews--]","<script src='".$path."goodnews.js'></script>",$temp);
	//評論排行
	$temp=str_replace("[!--hotplnews--]","<script src='".$allpath."hotplnews.js'></script>",$temp);
	$temp=str_replace("[!--self.hotplnews--]","<script src='".$path."hotplnews.js'></script>",$temp);
	//頭條排行
	$temp=str_replace("[!--firstnews--]","<script src='".$allpath."firstnews.js'></script>",$temp);
	$temp=str_replace("[!--self.firstnews--]","<script src='".$path."firstnews.js'></script>",$temp);
	$temp=str_replace('[!--news.url--]',$public_r['newsurl'],$temp);
	return $temp;
}

//內容頁替換公共標記
function Info_ReplaceSvars($temp,$url,$classid,$title,$key,$des){
	global $public_r,$class_r;
	$temp=str_replace('[!--class.menu--]',$public_r['classnavs'],$temp);//欄目導航
	$temp=str_replace('[!--newsnav--]','<?=$grurl?>',$temp);//位置導航
	$temp=str_replace('[!--pagetitle--]','<?=$grpagetitle?>',$temp);
	$temp=str_replace('[!--pagekey--]','<?=$ecms_gr[keyboard]?>',$temp);
	$temp=str_replace('[!--pagedes--]','<?=$grpagetitle?>',$temp);
	$temp=str_replace('[!--self.classid--]','<?=$ecms_gr[classid]?>',$temp);
	$bclassid=$class_r[$classid]['bclassid'];
	$temp=str_replace('[!--bclass.id--]','<?=$grbclassid?>',$temp);
	$temp=str_replace('[!--bclass.name--]','<?=$class_r[$grbclassid][classname]?>',$temp);
	$temp=str_replace('[!--news.url--]',$public_r['newsurl'],$temp);
	return $temp;
}

//動態內容頁替換公共標記
function DtInfo_ReplaceSvars($temp,$url,$classid,$title,$key,$des){
	global $public_r,$class_r;
	$temp=str_replace('[!--class.menu--]',$public_r['classnavs'],$temp);//欄目導航
	$temp=str_replace('[!--newsnav--]',$url,$temp);//位置導航
	$temp=str_replace('[!--pagetitle--]',$title,$temp);
	$temp=str_replace('[!--pagekey--]',$key,$temp);
	$temp=str_replace('[!--pagedes--]',$des,$temp);
	$temp=str_replace('[!--self.classid--]',$classid,$temp);
	$bclassid=$class_r[$classid]['bclassid'];
	$temp=str_replace('[!--bclass.id--]',$bclassid,$temp);
	$temp=str_replace('[!--bclass.name--]',$class_r[$bclassid]['classname'],$temp);
	$temp=str_replace('[!--news.url--]',$public_r['newsurl'],$temp);
	return $temp;
}

//替換搜索模板文件
function ReplaceStemp($temptext,$class,$url,$classid,$title,$key,$des,$repvar=1){
	global $public_r;
	if($repvar==1)//全局模板變量
	{
		$temptext=ReplaceTempvar($temptext);
	}
	$temptext=str_replace('[!--class.menu--]',$public_r['classnavs'],$temptext);//欄目導航
	$temptext=str_replace("[!--class--]",$class,$temptext);
	$temptext=str_replace('[!--pagetitle--]',$title,$temptext);
	$temptext=str_replace('[!--pagekey--]',$key,$temptext);
	$temptext=str_replace('[!--pagedes--]',$des,$temptext);
	$temptext=str_replace('[!--self.classid--]',$classid,$temptext);
	//熱門文章
	$temptext=str_replace("[!--hotnews--]","<script src='".$public_r[newsurl]."d/js/js/hotnews.js'></script>",$temptext);
	//點擊排行
	$temptext=str_replace("[!--newnews--]","<script src='".$public_r[newsurl]."d/js/js/newnews.js'></script>",$temptext);
	//推薦
	$temptext=str_replace("[!--goodnews--]","<script src='".$public_r[newsurl]."d/js/js/goodnews.js'></script>",$temptext);
	//評論排行
	$temptext=str_replace("[!--hotplnews--]","<script src='".$public_r[newsurl]."d/js/js/hotplnews.js'></script>",$temptext);
	//導航條
	$temptext=str_replace("[!--url--]",$url,$temptext);
	$temptext=str_replace('[!--newsnav--]',$url,$temptext);//位置導航
	$temptext=str_replace("[!--news.url--]",$public_r[newsurl],$temptext);
	$temptext=str_replace("[!--newsurl--]",$public_r[newsurl],$temptext);
	return $temptext;
}

//欄目頁驗證
function AddCheckClassLevel($classid,$groupid,$classpath){
	$classpath=ReturnSaveClassPath($classid);
	$pr=explode('/',$classpath);
	$pcount=count($pr);
	for($i=0;$i<$pcount;$i++)
	{
		$include.='../';
	}
	$include1=$include;
	$include.='e/class/CheckClassLevel.php';
	$addlevel="<?php
	define('empirecms','wm_chief');
	\$check_groupid=\"".$groupid."\";
	\$check_classid=".$classid.";
	\$check_path=\"".$include1."\";
	require(\"".$include."\");
	?>";
	return $addlevel;
}

//生成欄目綁定信息頁面
function ReClassBdInfo($classid){
	global $empire,$dbtbpre;
	$cr=$empire->fetch1("select classid,bdinfoid from {$dbtbpre}enewsclass where classid='$classid'");
	if(!$cr['classid']||!$cr['bdinfoid'])
	{
		return '';
	}
	$infor=explode(',',$cr['bdinfoid']);
	$infofile=GetInfoFilename(intval($infor[0]),intval($infor[1]));
	$classtext='';
	if($infofile)
	{
		$classtext=ReadFiletext($infofile);
	}
	$classfile=eReturnTrueEcmsPath().ReturnSaveClassPath($classid,1);//moreport
	WriteFiletext_n($classfile,$classtext);
}

//生成碎片文件
function DoSpReFile($r,$spid=0){
	global $empire,$dbtbpre;
	if($spid)
	{
		$r=$empire->fetch1("select varname,refile,spfile,spfileline,spfilesub from {$dbtbpre}enewssp where spid='$spid' limit 1");
	}
	if(!$r['refile'])
	{
		return '';
	}
	ob_start();
	sys_eShowSpInfo($r['varname'],$r['spfileline'],$r['spfilesub']);
	$string=ob_get_contents();
	ob_end_clean();
	$filename=ECMS_PATH.$r['spfile'];
	WriteFiletext($filename,$string);
}

//標籤替換
function NewsBq($classid,$indextext,$enews=0,$doing=0){
	global $empire,$dbtbpre,$public_r,$emod_r,$class_r,$class_zr,$fun_r,$navclassid,$navinfor,$class_tr,$level_r,$etable_r;
	$indextext=stripSlashes($indextext);
	$indextext=ReplaceTempvar($indextext);//替換全局模板變量
	$classlevel='';
	if($enews==0)//生成大欄目
	{
		if($class_r[$classid]['listdt']||$class_r[$classid]['wburl']||strstr($public_r['nreclass'],','.$classid.',')||InfoIsInTable($class_r[$classid]['tbname']))//不生成欄目
		{
			return '';
		}
		$GLOBALS['navclassid']=$classid;
		$url=ReturnClassLink($classid);//導航
		$cf=$doing==1?',classpath,classtype,classname':'';
		$cr=$empire->fetch1("select classpagekey,intro,classimg,cgroupid".$cf." from {$dbtbpre}enewsclass where classid='$classid'");
		if(!empty($cf))
		{
			$class_r[$classid][classpath]=$cr[classpath];
			$class_r[$classid][classtype]=$cr[classtype];
			$class_r[$classid][classname]=$cr[classname];
		}
		//權限
		if($cr['cgroupid'])
		{
			$classlevel=AddCheckClassLevel($classid,$cr['cgroupid'],'');
		}
		//頁面
		$pagetitle=ehtmlspecialchars($class_r[$classid][classname]);
		$pagekey=ehtmlspecialchars($cr['classpagekey']);
		$pagedes=ehtmlspecialchars($cr['intro']);
		$classimg=$cr['classimg'];
		$onclick="<script src=".$public_r[newsurl]."e/public/onclick/?enews=doclass&classid=$classid></script>";
		$truefile=eReturnTrueEcmsPath().ReturnSaveClassPath($classid,1);//moreport
		$file=ECMS_PATH.'e/data/tmp/class'.$classid.'.php';
		$indextext=str_replace("[!--newsnav--]",$url,$indextext);//位置導航
		$indextext=Class_ReplaceSvars($indextext,$url,$classid,$pagetitle,$pagekey,$pagedes,$classimg,$add,0);
	}
	elseif($enews==3)//專題
	{
		$GLOBALS['navclassid']=$classid;
		$url=ReturnZtLink($classid);//導航
		$cf=$doing==1?',ztpath,zttype,ztname':'';
		$cr=$empire->fetch1("select ztpagekey,intro,ztimg".$cf." from {$dbtbpre}enewszt where ztid='$classid'");
		if(!empty($cf))
		{
			$class_zr[$classid][ztpath]=$cr[ztpath];
			$class_zr[$classid][zttype]=$cr[zttype];
			$class_zr[$classid][ztname]=$cr[ztname];
	    }
		$pagetitle=ehtmlspecialchars($class_zr[$classid][ztname]);
		$pagekey=ehtmlspecialchars($cr['ztpagekey']);
		$pagedes=ehtmlspecialchars($cr['intro']);
		$classimg=$cr['ztimg'];
		$onclick="<script src=".$public_r[newsurl]."e/public/onclick/?enews=dozt&ztid=$classid></script>";
		$truefile=ECMS_PATH.ReturnSaveZtPath($classid,1);
		$file=ECMS_PATH.'e/data/tmp/zt'.$classid.'.php';
		$indextext=str_replace("[!--newsnav--]",$url,$indextext);//位置導航
		$indextext=Class_ReplaceSvars($indextext,$url,$classid,$pagetitle,$pagekey,$pagedes,$classimg,$add,1);
	}
	elseif($enews==4)//專題子類
	{
		$cr=$empire->fetch1("select ztid,cname,ttype from {$dbtbpre}enewszttype where cid='$classid'");
		$GLOBALS['navclassid']=$classid;
		$GLOBALS['navinfor']['ecmsbid']=$cr['ztid'];
		$url=ReturnZtLink($cr['ztid']);//導航
		$pagetitle=ehtmlspecialchars($cr['cname']);
		$pagekey=ehtmlspecialchars($cr['cname']);
		$pagedes=ehtmlspecialchars($cr['cname']);
		$onclick="<script src=".$public_r[newsurl]."e/public/onclick/?enews=dozt&ztid=$cr[ztid]></script>";
		$truefile=ECMS_PATH.ReturnSaveZtPath($cr['ztid'],0).'/type'.$classid.$cr['ttype'];
		$file=ECMS_PATH.'e/data/tmp/ztc'.$classid.'.php';
		$indextext=str_replace("[!--newsnav--]",$url,$indextext);//位置導航
		$indextext=Class_ReplaceSvars($indextext,$url,$classid,$pagetitle,$pagekey,$pagedes,$classimg,$add,1);
	}
	elseif($enews==1)//生成首頁文件
	{
		$pr=$empire->fetch1("select sitekey,siteintro,indexpagedt from {$dbtbpre}enewspublic limit 1");
		if($pr['indexpagedt']||(Moreport_ReturnMustDt()&&!defined('ECMS_SELFPATH')))//moreport
		{
			return '';
		}
		//頁面
		$pagetitle=ehtmlspecialchars($public_r['sitename']);
		$pagekey=ehtmlspecialchars($pr['sitekey']);
		$pagedes=ehtmlspecialchars($pr['siteintro']);
		$url="<a href=\"".ReturnSiteIndexUrl()."\">".$fun_r['index']."</a>";//欄目導航
		$onclick='';
		$truefile=eReturnTrueEcmsPath().ReturnSaveIndexFile();//moreport
		$file=ECMS_PATH.'e/data/tmp/index.php';
		$indextext=ReplaceSvars($indextext,$url,0,$pagetitle,$pagekey,$pagedes,$add,0);
	}
	$indextext=str_replace("[!--page.stats--]",$onclick,$indextext);
	//替換標籤
	$indextext=DoRepEcmsLoopBq($indextext);
	$indextext=RepBq($indextext);
	//寫文件
	WriteFiletext($file,AddCheckViewTempCode().$indextext);
	//讀取文件內容
    ob_start();
	include($file);
	$string=ob_get_contents();
	ob_end_clean();
	$string=RepExeCode($string);//解析代碼
	WriteFiletext($truefile,$classlevel.$string);
	return $string;
}

//標籤替換2
function InfoNewsBq($classid,$indextext){
	global $empire,$dbtbpre,$public_r,$emod_r,$class_r,$class_zr,$fun_r,$navclassid,$navinfor,$class_tr,$level_r,$etable_r;
	if(!defined('EmpireCMSAdmin'))
	{
		$_GET['reallinfotime']=0;
	}
	if($_GET['reallinfotime'])
	{
		$classid.='_all';
	}
	$file=ECMS_PATH.'e/data/tmp/temp'.$classid.'.php';
	if($_GET['reallinfotime']&&file_exists($file))
	{
		$filetime=filemtime($file);
		if($_GET['reallinfotime']<=$filetime)
		{
			ob_start();
			include($file);
			$string=ob_get_contents();
			ob_end_clean();
			$string=RepExeCode($string);//解析代碼
			return $string;
		}
	}
	$indextext=stripSlashes($indextext);
	$indextext=ReplaceTempvar($indextext);//替換全局模板變量
	//替換標籤
	$indextext=DoRepEcmsLoopBq($indextext);
	$indextext=RepBq($indextext);
	//寫文件
	WriteFiletext($file,AddCheckViewTempCode().$indextext);
	//讀取文件內容
    ob_start();
	include($file);
	$string=ob_get_contents();
	ob_end_clean();
	$string=RepExeCode($string);//解析代碼
	return $string;
}

//標籤替換3
function GetInfoNewsBq($classid,$newstemp_r,$ecms_gr,$docheckrep){
	global $empire,$dbtbpre,$public_r,$emod_r,$class_r,$class_zr,$fun_r,$navclassid,$navinfor,$class_tr,$level_r,$etable_r;
	if(!defined('EmpireCMSAdmin'))
	{
		$_GET['reallinfotime']=0;
	}
	if($_GET['reallinfotime'])
	{
		$file=ECMS_PATH.'e/data/tmp/tempnews'.$newstemp_r['tempid'].'_all.php';
	}
	else
	{
		$file=ECMS_PATH.'e/data/tmp/tempnews'.$newstemp_r['tempid'].'.php';
	}
	//變量處理
	$grurl=ReturnClassLink($ecms_gr['classid']);//導航
	$grpagetitle=ehtmlspecialchars($ecms_gr['title']);
	$grbclassid=$class_r[$ecms_gr['classid']]['bclassid'];
	$grtitleurl=sys_ReturnBqTitleLink($ecms_gr);
	$grclassurl=sys_ReturnBqClassname($ecms_gr,9);

	if($_GET['reallinfotime']&&file_exists($file))
	{
		$filetime=filemtime($file);
		if($_GET['reallinfotime']<=$filetime)
		{
			ob_start();
			include($file);
			$string=ob_get_contents();
			ob_end_clean();
			$string=RepExeCode($string);//解析代碼
			return $string;
		}
	}
	$formatdate=$newstemp_r['showdate'];
	
	$newstemp_r['temptext']=stripSlashes($newstemp_r['temptext']);
	$newstemp_r['temptext']=ReplaceTempvar($newstemp_r['temptext']);//替換全局模板變量
	//替換標籤
	$newstemp_r['temptext']=DoRepEcmsLoopBq($newstemp_r['temptext']);
	$newstemp_r['temptext']=RepBq($newstemp_r['temptext']);
	//替換變量
	$indextext=GetHtmlRepVar($newstemp_r,$ecms_gr['classid']);
	//寫文件
	WriteFiletext($file,AddCheckViewTempCode().$indextext);
	//讀取文件內容
    ob_start();
	include($file);
	$string=ob_get_contents();
	ob_end_clean();
	$string=RepExeCode($string);//解析代碼
	return $string;
}

//標籤替換4
function DtNewsBq($classid,$indextext,$ecms=0){
	global $empire,$dbtbpre,$public_r,$emod_r,$class_r,$class_zr,$fun_r,$navclassid,$navinfor,$class_tr,$level_r,$etable_r;
	$cachetime=$ecms==1?$public_r['dtncachetime']:$public_r['dtcachetime'];
	$file=ECMS_PATH.'e/data/tmp/dt_temp'.$classid.'.php';
	if($cachetime&&file_exists($file))
	{
		$filetime=filemtime($file);
		if(time()-$cachetime*60<=$filetime)
		{
			ob_start();
			include($file);
			$string=ob_get_contents();
			ob_end_clean();
			$string=RepExeCode($string);//解析代碼
			return $string;
		}
	}
	$indextext=stripSlashes($indextext);
	$indextext=ReplaceTempvar($indextext);//替換全局模板變量
	//替換標籤
	$indextext=DoRepEcmsLoopBq($indextext);
	$indextext=RepBq($indextext);
	//寫文件
	WriteFiletext($file,AddCheckViewTempCode().$indextext);
	//讀取文件內容
    ob_start();
	include($file);
	$string=ob_get_contents();
	ob_end_clean();
	$string=RepExeCode($string);//解析代碼
	return $string;
}

//解析代碼
function RepExeCode($string){
	global $public_r;
	if($public_r[candocode])
	{
		$string=str_replace('<!--code.start-->','<',$string);
		$string=str_replace('<!--code.end-->','>',$string);
    }
	return $string;
}

function ClearRepDoECode($string){
	$string=str_replace('<!--code.start-->','&lt;!--code.start--&gt;',$string);
	$string=str_replace('<!--code.end-->','&lt;!--code.end--&gt;',$string);
	return $string;
}

//替換標籤
function RepBq($indextext){
	global $empire,$dbtbpre;
	$sql=$empire->query("select bq,funname from {$dbtbpre}enewsbq where isclose=0 order by bqid");
	while($r=$empire->fetch($sql))
	{
        $preg_str="/\[".$r[bq]."\](.+?)\[\/".$r[bq]."\]/is";
		$indextext=preg_replace($preg_str,"<?php @".$r[funname]."(\\1);?>",$indextext);
	}
	return $indextext;
}

//替換靈動標籤
function DoRepEcmsLoopBq($temp){
	$yzz="/\[e:loop={(.+?)}\](.+?)\[\/e:loop\]/is";
	$xzz="<?php
\$bqno=0;
\$ecms_bq_sql=sys_ReturnEcmsLoopBq(\\1);
if(\$ecms_bq_sql){
while(\$bqr=\$empire->fetch(\$ecms_bq_sql)){
\$bqsr=sys_ReturnEcmsLoopStext(\$bqr);
\$bqno++;
?>\\2<?php
}
}
?>";
	$temp=preg_replace($yzz,$xzz,$temp);
	$temp=DoRepEcmsIndexLoopBq($temp);
	return $temp;
}

//替換索引靈動標籤
function DoRepEcmsIndexLoopBq($temp){
	$yzz="/\[e:indexloop={(.+?)}\](.+?)\[\/e:indexloop\]/is";
	$xzz="<?php
\$bqno=0;
\$ecms_bq_sql=sys_ReturnEcmsIndexLoopBq(\\1);
if(\$ecms_bq_sql){
while(\$indexbqr=\$empire->fetch(\$ecms_bq_sql)){
if(empty(\$class_r[\$indexbqr['classid']]['tbname'])){continue;}
\$bqr=\$empire->fetch1(\"select * from {\$dbtbpre}ecms_\".\$class_r[\$indexbqr['classid']]['tbname'].\" where id='\$indexbqr[id]'\");
\$bqsr=sys_ReturnEcmsLoopStext(\$bqr);
\$bqno++;
?>\\2<?php
}
}
?>";
	return preg_replace($yzz,$xzz,$temp);
}

//無信息的信息列表
function NotinfoListHtml($path,$list_r,$classlevel){
	global $fun_r;
	$word=$fun_r['HaveNotListInfo'];
	$pagetext=$list_r[0].$word.$list_r[2];
	$pagetext=str_replace('[!--show.page--]','',$pagetext);
	$pagetext=str_replace('[!--show.listpage--]','',$pagetext);
	$pagetext=str_replace('[!--list.pageno--]','',$pagetext);
	WriteFiletext($path,$classlevel.$pagetext);
}

//生成信息列表
function ListHtml($classid,$fields,$enews=0,$userlistr=""){
	global $empire,$dbtbpre,$emod_r,$public_r,$class_r,$class_zr,$fun_r,$class_tr,$level_r,$etable_r;
	//不生成欄目
	if(($enews==0||$enews==3)&&($class_r[$classid]['listdt']||$class_r[$classid]['wburl']||strstr($public_r['nreclass'],','.$classid.',')))
	{
		return '';
	}
	$GLOBALS['navclassid']=$classid;
	$doclass="index";
	$classlevel='';
	$yhvar='qlist';
	if($enews==0)//子欄目列表
	{
		if(InfoIsInTable($class_r[$classid][tbname]))//內部表
		{
			return '';
		}
		$selfclassid=$classid;
		$doenews=0;
		$cr=$empire->fetch1("select classpagekey,intro,classimg,cgroupid,repagenum,bdinfoid from {$dbtbpre}enewsclass where classid='$classid'");
		//綁定信息
		if(!empty($cr['bdinfoid']))
		{
			ReClassBdInfo($classid);
			return '';
		}
		$mid=$class_r[$classid][modid];
		//權限
		if($cr['cgroupid'])
		{
			$classlevel=AddCheckClassLevel($classid,$cr['cgroupid'],'');
		}
		//頁面
		$pagetitle=ehtmlspecialchars($class_r[$classid][classname]);
		$pagekey=ehtmlspecialchars($cr['classpagekey']);
		$pagedes=ehtmlspecialchars($cr['intro']);
		$classimg=$cr['classimg'];
		$url=ReturnClassLink($classid);
		$haveclass=0;
		//排序
		if(empty($class_r[$classid][reorder]))
		{
			$addorder="newstime desc";
	    }
		else
		{
			$addorder=$class_r[$classid][reorder];
	    }
		//分頁參數
		$pagefunr=eReturnRewriteLink('classpage',$classid,0);
		$pagefunr['repagenum']=$cr['repagenum'];
		$totalrepage=$cr['repagenum']*$class_r[$classid][lencord];
		if($totalrepage)
		{
			$limit=" limit ".$totalrepage;
		}
		if($class_r[$classid][maxnum])//總記錄數
		{
			if($class_r[$classid][maxnum]<$totalrepage)
			{
				$limit=" limit ".$class_r[$classid][maxnum];
			}
			$limitnum=$class_r[$classid][maxnum];
		}
		//優化
		$yhid=$class_r[$classid][yhid];
		if($yhid)
		{
			$yhadd=ReturnYhSql($yhid,$yhvar,1);
		}
		$query="select ".ReturnSqlListF($mid)." from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where ".$yhadd."classid='$classid' order by ".ReturnSetTopSql('list').$addorder.$limit;
		$totalquery="select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where ".$yhadd."classid='$classid'";//統計
		$doclasspath=ReturnSaveClassPath($classid,0);
		$dopath=eReturnTrueEcmsPath().$doclasspath."/";//moreport
		if(empty($class_r[$classid][classurl]))
		{
			$dolink=$public_r[newsurl].$doclasspath."/";
		}
		else
		{
			$dolink=$class_r[$classid][classurl]."/";
		}
		$dotype=$class_r[$classid][classtype];
		$classname=$class_r[$classid][classname];
		$lencord=$class_r[$classid][lencord];//記錄數
		$onclick="<script src='".$public_r[newsurl]."e/public/onclick/?enews=doclass&classid=$classid'></script>";
		//模板
		$listtempid=$class_r[$classid][listtempid];
	}
	elseif($enews==5)//標題分類列表
	{
		$mid=$class_tr[$classid]['mid'];
		$tbname=$emod_r[$mid]['tbname'];
		if(InfoIsInTable($tbname))//內部表
		{
			return '';
		}
		$selfclassid=$classid;
		$doenews=1;
		$cr=$empire->fetch1("select tnum,listtempid,maxnum,reorder,timg,intro,pagekey,listdt,repagenum from {$dbtbpre}enewsinfotype where typeid='$classid'");
		//頁面
		$pagetitle=ehtmlspecialchars($class_tr[$classid]['tname']);
		$pagekey=ehtmlspecialchars($cr['pagekey']);
		$pagedes=ehtmlspecialchars($cr['intro']);
		$classimg=$cr['timg'];
		$url=ReturnInfoTypeLink($classid);
		$haveclass=1;
		if($cr['listdt'])//動態頁面
		{
			return '';
		}
		//排序
		if(empty($cr['reorder']))
		{
			$addorder='newstime desc';
	    }
		else
		{
			$addorder=$cr['reorder'];
	    }
		//分頁參數
		$pagefunr=eReturnRewriteLink('ttpage',$classid,0);
		$pagefunr['repagenum']=$cr['repagenum'];
		$totalrepage=$cr['repagenum']*$cr['tnum'];
		if($totalrepage)
		{
			$limit=" limit ".$totalrepage;
		}
		if($cr['maxnum'])
		{
			if($cr['maxnum']<$totalrepage)
			{
				$limit=" limit ".$cr['maxnum'];
			}
			$limitnum=$cr['maxnum'];
		}
		//優化
		$yhid=$class_tr[$classid]['yhid'];
		if($yhid)
		{
			$yhadd=ReturnYhSql($yhid,$yhvar,1);
		}
		$query="select ".ReturnSqlListF($mid)." from {$dbtbpre}ecms_".$tbname." where ".$yhadd."ttid='$classid' order by ".$addorder.$limit;
		$totalquery="select count(*) as total from {$dbtbpre}ecms_".$tbname." where ".$yhadd."ttid='$classid'";//統計
		$doclasspath=ReturnSaveInfoTypePath($classid,0);
		$dopath=eReturnTrueEcmsPath().$doclasspath."/";//moreport
		$dolink=$public_r[newsurl].$doclasspath."/";
		$dotype=$class_tr[$classid]['ttype'];
		$classname=$class_tr[$classid]['tname'];
		$lencord=$cr['tnum'];//記錄數
		$onclick="";
		//模板
		$listtempid=$cr['listtempid'];
	}
	elseif($enews==3)//大欄目列表
	{
		if(InfoIsInTable($class_r[$classid][tbname]))//內部表
		{
			return '';
		}
		$selfclassid=$classid;
		$doenews=0;
		$cr=$empire->fetch1("select classpagekey,intro,classimg,cgroupid,repagenum from {$dbtbpre}enewsclass where classid='$classid'");
		$mid=$class_r[$classid][modid];
		//權限
		if($cr['cgroupid'])
		{
			$classlevel=AddCheckClassLevel($classid,$cr['cgroupid'],'');
		}
		//頁面
		$pagetitle=ehtmlspecialchars($class_r[$classid][classname]);
		$pagekey=ehtmlspecialchars($cr['classpagekey']);
		$pagedes=ehtmlspecialchars($cr['intro']);
		$classimg=$cr['classimg'];
		$url=ReturnClassLink($classid);
		$haveclass=1;
		//排序
		if(empty($class_r[$classid][reorder]))
		{
			$addorder="newstime desc";
	    }
		else
		{
			$addorder=$class_r[$classid][reorder];
	    }
		//分頁參數
		$pagefunr=eReturnRewriteLink('classpage',$classid,0);
		$pagefunr['repagenum']=$cr['repagenum'];
		$totalrepage=$cr['repagenum']*$class_r[$classid][lencord];
		if($totalrepage)
		{
			$limit=" limit ".$totalrepage;
		}
		if($class_r[$classid][maxnum])
		{
			if($class_r[$classid][maxnum]<$totalrepage)
			{
				$limit=" limit ".$class_r[$classid][maxnum];
			}
			$limitnum=$class_r[$classid][maxnum];
		}
		$whereclass=ReturnClass($class_r[$classid][sonclass]);
		//優化
		$yhid=$class_r[$classid][yhid];
		if($yhid)
		{
			$yhadd=ReturnYhSql($yhid,$yhvar,1);
		}
		$query="select ".ReturnSqlListF($mid)." from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where ".$yhadd."(".$whereclass.") order by ".ReturnSetTopSql('list').$addorder.$limit;
		$totalquery="select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where ".$yhadd."(".$whereclass.")";//統計
		$doclasspath=ReturnSaveClassPath($classid,0);
		$dopath=eReturnTrueEcmsPath().$doclasspath."/";//moreport
		if(empty($class_r[$classid][classurl]))
		{
			$dolink=$public_r[newsurl].$doclasspath."/";
		}
		else
		{
			$dolink=$class_r[$classid][classurl]."/";
		}
		$dotype=$class_r[$classid][classtype];
		$classname=$class_r[$classid][classname];
		$lencord=$class_r[$classid][lencord];//記錄數
		$onclick="<script src='".$public_r[newsurl]."e/public/onclick/?enews=doclass&classid=$classid'></script>";
		//模板
		$listtempid=$class_r[$classid][listtempid];
	}
	elseif($enews==4)//按sql語句生成列表
	{
		$selfclassid=0;
		$doenews=1;
		$userlistr['listsql']=RepSqlTbpre($userlistr['listsql']);
		$userlistr['totalsql']=RepSqlTbpre($userlistr['totalsql']);
		//頁面
		$pagetitle=ehtmlspecialchars($userlistr['pagetitle']);
		$pagekey=ehtmlspecialchars($userlistr['pagekeywords']);
		$pagedes=ehtmlspecialchars($userlistr['pagedescription']);
		$haveclass=1;
		if($userlistr['maxnum'])//最大查詢數
		{
			$limit=" limit ".$userlistr['maxnum'];
			$limitnum=$userlistr['maxnum'];
		}
		$query=stripSlashes($userlistr['listsql']).$limit;
		//統計
		$totalquery=stripSlashes($userlistr['totalsql']);
		$dopath=$userlistr['addpath'].$userlistr['filepath'];
		$dolink=$public_r[newsurl].str_replace($userlistr['addpath'].'../../','',$dopath);
		$dotype=$userlistr['filetype'];
		$classname=$userlistr['pagetitle'];
		$lencord=$userlistr['lencord'];//記錄數
		$onclick='';
		$url=ReturnUserPLink($pagetitle,$dolink);
		//模板
		$listtempid=$userlistr['listtempid'];
	}
	if(empty($lencord))
	{
		$lencord=25;
	}
	//列表模板
	$listtemp_r=GetListTemp($listtempid);
    $listtemp=$listtemp_r[temptext];
	$subnews=$listtemp_r[subnews];
	$subtitle=$listtemp_r[subtitle];
	$docode=$listtemp_r[docode];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$listtemp_r[listvar]);
	$rownum=$listtemp_r[rownum];
	$formatdate=$listtemp_r[showdate];
	if(empty($rownum))
	{
		$rownum=1;
	}
	if(empty($mid))
	{
		$mid=$listtemp_r[modid];
	}
	$field=ReturnReplaceListF($mid);
	//分頁參數
	$pagefunr['dofile']=$dofile;
	//分頁列表函數
	if(!empty($public_r['listpagefun'])||!empty($public_r['listpagelistfun']))
	{
		if(strstr($listtemp,'[!--show.page--]'))//下拉式
		{
			$thefun=$public_r['listpagefun'];
			$bereplistpage='[!--show.page--]';
		}
		else//列表式
		{
			$thefun=$public_r['listpagelistfun'];
			$bereplistpage='[!--show.listpage--]';
		}
	}
	else
	{
		$thefun='sys_ShowListPage';
		$bereplistpage='[!--show.page--]';
	}
	//替換模板變量
	$listtemp=str_replace('[!--newsnav--]',$url,$listtemp);//位置導航
	$listtemp=Class_ReplaceSvars($listtemp,$url,$selfclassid,$pagetitle,$pagekey,$pagedes,$classimg,$add,$doenews);
	$listtemp=str_replace('[!--page.stats--]',$onclick,$listtemp);
	$no=1;
	$ok=0;
	$changerow=1;
	$num=$empire->gettotal($totalquery);
	//最大數
	if($limitnum&&$limitnum<$num)
	{
		$num=$limitnum;
	}
	$page=ceil($num/$lencord);
	//取得列表模板
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	//無信息
	if(empty($num))
	{
		$noinfopath=$dopath."index".$dotype;
		NotinfoListHtml($noinfopath,$list_r,$classlevel);
		return "";
	}
	$sql=$empire->query($query);
	$listtext=$list_r[1];
	while($k=$empire->fetch($sql))
	{
		//替換列表變量
		$repvar=ReplaceListVars($no,$listvar,$subnews,$subtitle,$formatdate,$url,$haveclass,$k,$field,$docode);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		if($no%$lencord==0||($num%$lencord<>0&&$num==$no))
		{
			$ok+=1;
			$pagenum=ceil($no/$lencord);
			//首頁
			if($pagenum==1)
			{
				$path=$dopath."index".$dotype;
			}
			else
			{
				$path=$dopath."index_".$ok.$dotype;
			}
			//取得分頁參數
			$returnpager=$thefun($num,$pagenum,$dolink,$dotype,$page,$lencord,$ok,$myoptions,$pagefunr);
			$showpage=$returnpager['showpage'];
			$myoptions=$returnpager['option'];
			$list1=str_replace($bereplistpage,$showpage,$list_r[0]);
			$list2=str_replace($bereplistpage,$showpage,$list_r[2]);
			//多餘數據
			if($changerow<=$rownum&&$listtext<>$list_r[1])
			{
				$string.=$listtext;
			}
			$listtext=$list_r[1];
			$changerow=1;
			$string=$list1.$string.$list2;
			//替換分頁數
			$string=str_replace('[!--list.pageno--]',($pagenum==1?'':$pagenum),$string);
			WriteFiletext($path,$classlevel.$string);
			$string='';
		}
		$no++;
	}
	$empire->free($sql);
}

//生成索引類信息列表
function ListHtmlIndex($classid,$fields,$enews=0,$userlistr=""){
	global $empire,$dbtbpre,$emod_r,$public_r,$class_r,$class_zr,$fun_r,$class_tr,$level_r,$etable_r;
	$GLOBALS['navclassid']=$classid;
	$dofile="index";
	$classlevel='';
	$yhvar='qlist';
	$mid=0;
	if($enews==0)//專題列表
	{
		$selfclassid=$classid;
		$doenews=1;
		$cr=$empire->fetch1("select ztpagekey,intro,ztimg,classtempid from {$dbtbpre}enewszt where ztid='$classid'");
		//頁面
		$pagetitle=ehtmlspecialchars($class_zr[$classid][ztname]);
		$pagekey=ehtmlspecialchars($cr['ztpagekey']);
		$pagedes=ehtmlspecialchars($cr['intro']);
		$classimg=$cr['ztimg'];
		$url=ReturnZtLink($classid);
		$haveclass=1;
		if($class_zr[$classid][islist]!=1)//非列表式
		{
			$classtemp=$class_zr[$classid][islist]==2?GetZtText($classid):GetClassTemp($cr['classtempid']);
			NewsBq($classid,$classtemp,3,0);
			return "";
		}
		//排序
		if(empty($class_zr[$classid][reorder]))
		{
			$addorder='newstime desc';
	    }
		else
		{
			$addorder=$class_zr[$classid][reorder];
	    }
		if($class_zr[$classid][maxnum])
		{
			$limit=' limit '.$class_zr[$classid][maxnum];
			$limitnum=$class_zr[$classid][maxnum];
		}
		//優化
		$yhid=$class_zr[$classid][yhid];
		if($yhid)
		{
			$yhadd=ReturnYhSql($yhid,$yhvar,1);
		}
		$query="select ztid,cid,classid,id,isgood from {$dbtbpre}enewsztinfo where ".$yhadd."ztid='$classid' order by ".$addorder.$limit;
		$totalquery="select count(*) as total from {$dbtbpre}enewsztinfo where ".$yhadd."ztid='$classid'";//統計
		$doclasspath=ReturnSaveZtPath($classid,0);
		$dopath=ECMS_PATH.$doclasspath."/";
		if(empty($class_zr[$classid][zturl]))
		{
			$dolink=$public_r[newsurl].$doclasspath."/";
		}
		else
		{
			$dolink=$class_zr[$classid][zturl]."/";
		}
		$dotype=$class_zr[$classid][zttype];
		$classname=$class_zr[$classid][ztname];
		$lencord=$class_zr[$classid][ztnum];//記錄數
		$onclick="<script src='".$public_r[newsurl]."e/public/onclick/?enews=dozt&ztid=$classid'></script>";
		//模板
		$listtempid=$class_zr[$classid][listtempid];
	}
	elseif($enews==1)//專題子類列表
	{
		$selfclassid=$classid;
		$doenews=1;
		$cr=$empire->fetch1("select ztid,cname,islist,listtempid,maxnum,tnum,reorder,ttype from {$dbtbpre}enewszttype where cid='$classid'");
		$GLOBALS['navinfor']['ecmsbid']=$cr['ztid'];
		//頁面
		$pagetitle=ehtmlspecialchars($cr['cname']);
		$pagekey=ehtmlspecialchars($cr['cname']);
		$pagedes=ehtmlspecialchars($cr['cname']);
		$url=ReturnZtLink($cr['ztid']);
		$haveclass=1;
		if($cr['islist']!=1)//非列表式
		{
			$classtemp=GetZtcText($classid);
			NewsBq($classid,$classtemp,4,0);
			return '';
		}
		//排序
		if(empty($cr['reorder']))
		{
			$addorder='newstime desc';
	    }
		else
		{
			$addorder=$cr['reorder'];
	    }
		if($cr['maxnum'])
		{
			$limit=" limit ".$cr['maxnum'];
			$limitnum=$cr['maxnum'];
		}
		//優化
		$ztid=$cr['ztid'];
		$yhid=$class_zr[$ztid][yhid];
		if($yhid)
		{
			$yhadd=ReturnYhSql($yhid,$yhvar,1);
		}
		$query="select ztid,cid,classid,id,isgood from {$dbtbpre}enewsztinfo where ".$yhadd."cid='$classid' order by ".$addorder.$limit;
		$totalquery="select count(*) as total from {$dbtbpre}enewsztinfo where ".$yhadd."cid='$classid'";//統計
		$doclasspath=ReturnSaveZtPath($ztid,0);
		$dopath=ECMS_PATH.$doclasspath."/";
		if(empty($class_zr[$ztid][zturl]))
		{
			$dolink=$public_r[newsurl].$doclasspath."/";
		}
		else
		{
			$dolink=$class_zr[$ztid][zturl]."/";
		}
		$dofile='type'.$classid;//文件名
		$dotype=$cr['ttype'];
		$classname=$cr['cname'];
		$lencord=$cr['tnum'];//記錄數
		$onclick="<script src='".$public_r[newsurl]."e/public/onclick/?enews=dozt&ztid=$ztid'></script>";
		//模板
		$listtempid=$cr['listtempid'];
	}
	elseif($enews==4)//按sql語句生成列表
	{
		$selfclassid=0;
		$doenews=1;
		$userlistr['listsql']=RepSqlTbpre($userlistr['listsql']);
		$userlistr['totalsql']=RepSqlTbpre($userlistr['totalsql']);
		//頁面
		$pagetitle=ehtmlspecialchars($userlistr['pagetitle']);
		$pagekey=ehtmlspecialchars($userlistr['pagekeywords']);
		$pagedes=ehtmlspecialchars($userlistr['pagedescription']);
		$haveclass=1;
		if($userlistr['maxnum'])//最大查詢數
		{
			$limit=" limit ".$userlistr['maxnum'];
			$limitnum=$userlistr['maxnum'];
		}
		$query=stripSlashes($userlistr['listsql']).$limit;
		//統計
		$totalquery=stripSlashes($userlistr['totalsql']);
		$dopath=$userlistr['addpath'].$userlistr['filepath'];
		$dolink=$public_r[newsurl].str_replace($userlistr['addpath'].'../../','',$dopath);
		$dotype=$userlistr['filetype'];
		$classname=$userlistr['pagetitle'];
		$lencord=$userlistr['lencord'];//記錄數
		$onclick='';
		$url=ReturnUserPLink($pagetitle,$dolink);
		//模板
		$listtempid=$userlistr['listtempid'];
	}
	if(empty($lencord))
	{
		$lencord=25;
	}
	//列表模板
	$listtemp_r=GetListTemp($listtempid);
    $listtemp=$listtemp_r[temptext];
	$subnews=$listtemp_r[subnews];
	$subtitle=$listtemp_r[subtitle];
	$docode=$listtemp_r[docode];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$listtemp_r[listvar]);
	$rownum=$listtemp_r[rownum];
	$formatdate=$listtemp_r[showdate];
	if(empty($rownum))
	{
		$rownum=1;
	}
	if(empty($mid))
	{
		$mid=$listtemp_r[modid];
	}
	$field=ReturnReplaceListF($mid);
	//分頁參數
	$pagefunr['dofile']=$dofile;
	//分頁列表函數
	if(!empty($public_r['listpagefun'])||!empty($public_r['listpagelistfun']))
	{
		if(strstr($listtemp,'[!--show.page--]'))//下拉式
		{
			$thefun=$public_r['listpagefun'];
			$bereplistpage='[!--show.page--]';
		}
		else//列表式
		{
			$thefun=$public_r['listpagelistfun'];
			$bereplistpage='[!--show.listpage--]';
		}
	}
	else
	{
		$thefun='sys_ShowListPage';
		$bereplistpage='[!--show.page--]';
	}
	//替換模板變量
	$listtemp=str_replace('[!--newsnav--]',$url,$listtemp);//位置導航
	$listtemp=Class_ReplaceSvars($listtemp,$url,$selfclassid,$pagetitle,$pagekey,$pagedes,$classimg,$add,$doenews);
	$listtemp=str_replace('[!--page.stats--]',$onclick,$listtemp);
	$no=1;
	$ok=0;
	$changerow=1;
	$num=$empire->gettotal($totalquery);
	//最大數
	if($limitnum&&$limitnum<$num)
	{
		$num=$limitnum;
	}
	$page=ceil($num/$lencord);
	//取得列表模板
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	//無信息
	if(empty($num))
	{
		$noinfopath=$dopath.$dofile.$dotype;
		NotinfoListHtml($noinfopath,$list_r,$classlevel);
		return "";
	}
	$sql=$empire->query($query);
	$listtext=$list_r[1];
	while($k=$empire->fetch($sql))
	{
		if(empty($class_r[$k[classid]][tbname]))
		{
			$no++;
			continue;
		}
		$infor=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$k[classid]][tbname]." where id='$k[id]' limit 1");
		if(empty($infor['id']))
		{
			$no++;
			continue;
		}
		//替換列表變量
		$repvar=ReplaceListVars($no,$listvar,$subnews,$subtitle,$formatdate,$url,$haveclass,$infor,$field,$docode);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		if($no%$lencord==0||($num%$lencord<>0&&$num==$no))
		{
			$ok+=1;
			$pagenum=ceil($no/$lencord);
			//首頁
			if($pagenum==1)
			{
				$path=$dopath.$dofile.$dotype;
			}
			else
			{
				$path=$dopath.$dofile.'_'.$ok.$dotype;
			}
			//取得分頁參數
			$returnpager=$thefun($num,$pagenum,$dolink,$dotype,$page,$lencord,$ok,$myoptions,$pagefunr);
			$showpage=$returnpager['showpage'];
			$myoptions=$returnpager['option'];
			$list1=str_replace($bereplistpage,$showpage,$list_r[0]);
			$list2=str_replace($bereplistpage,$showpage,$list_r[2]);
			//多餘數據
			if($changerow<=$rownum&&$listtext<>$list_r[1])
			{
				$string.=$listtext;
			}
			$listtext=$list_r[1];
			$changerow=1;
			$string=$list1.$string.$list2;
			//替換分頁數
			$string=str_replace('[!--list.pageno--]',($pagenum==1?'':$pagenum),$string);
			WriteFiletext($path,$classlevel.$string);
			$string='';
		}
		$no++;
	}
	$empire->free($sql);
}

//返回分頁
function ReturnListpageStr($pagenum,$page,$lencord,$num,$pagelink,$options){
	global $public_r;
	$temp=$public_r['listpagetemp'];
	$temp=str_replace('[!--thispage--]',$pagenum,$temp);//頁次
	$temp=str_replace('[!--pagenum--]',$page,$temp);//總頁數
	$temp=str_replace('[!--lencord--]',$lencord,$temp);//每頁顯示條數
	$temp=str_replace('[!--num--]',$num,$temp);//總條數
	$temp=str_replace('[!--pagelink--]',$pagelink,$temp);//頁面鏈接
	$temp=str_replace('[!--options--]',$options,$temp);//下拉分頁
	return $temp;
}

//投稿生成html
function DoGetHtml($classid,$id){
	global $empire,$class_r,$public_r,$dbtbpre;
	$classid=intval($classid);
	$id=intval($id);
	$tbname=$class_r[$classid][tbname];
	//不存在
	if(!$id||!$classid||!$tbname)
	{
		echo"<script>self.location.href='".$public_r['newsurl']."';</script>";
		exit();
	}
	$r=$empire->fetch1("select * from {$dbtbpre}ecms_".$tbname." where id='$id'");
	if(!$r['id']||$classid!=$r['classid'])
	{
		echo"<script>self.location.href='".$public_r['newsurl']."';</script>";
		exit();
	}
	$titleurl=sys_ReturnBqAutoTitleLink($r);
	//已生成
	if(!empty($r[havehtml]))
	{
		return $titleurl;
	}
	//生成html
	GetHtml($r['classid'],$r['id'],$r,1);
	return $titleurl;
}

//內容變量處理
function GetHtmlRepVar($tempr,$classid){
	global $public_r,$class_r,$class_zr,$fun_r,$empire,$dbtbpre,$emod_r,$class_tr,$level_r,$etable_r;
	$mid=$class_r[$classid]['modid'];
	$tbname=$class_r[$classid][tbname];
	$newstemptext=$tempr[temptext];
	$formatdate=$tempr[showdate];
	//分頁字段
	$expage='[!--empirenews.page--]';//分頁符
	$pf=$emod_r[$mid]['pagef'];
	//變量
	$tempf=$emod_r[$mid]['tempf'];
	$fr=explode(',',$tempf);
	$fcount=count($fr)-1;
	//變量替換
	$newstempstr=$newstemptext;//模板
	//總體頁面變量
	$newstempstr=str_replace('[!--class.menu--]',$public_r['classnavs'],$newstempstr);//欄目導航
	$newstempstr=str_replace('[!--newsnav--]','<?=$grurl?>',$newstempstr);//位置導航
	$newstempstr=str_replace('[!--pagetitle--]','<?=$grpagetitle?>',$newstempstr);
	$newstempstr=str_replace('[!--pagekey--]','<?=$ecms_gr[keyboard]?>',$newstempstr);
	$newstempstr=str_replace('[!--pagedes--]','<?=$grpagetitle?>',$newstempstr);
	$newstempstr=str_replace('[!--self.classid--]','<?=$ecms_gr[classid]?>',$newstempstr);
	$newstempstr=str_replace('[!--bclass.id--]','<?=$grbclassid?>',$newstempstr);
	$newstempstr=str_replace('[!--bclass.name--]','<?=$class_r[$grbclassid][classname]?>',$newstempstr);
	$newstempstr=str_replace('[!--news.url--]',$public_r['newsurl'],$newstempstr);
	//信息字段變量
	for($i=1;$i<$fcount;$i++)
	{
		$f=$fr[$i];
		$value='$ecms_gr['.$f.']';
		if($f==$pf)//分頁字段
		{
			$value='strstr('.$value.',\''.$expage.'\')?\'[!--'.$f.'--]\':'.$value;
		}
		elseif($f=='downpath')//下載地址
		{
			$value='ReturnDownSoftHtml($ecms_gr)';
		}
		elseif($f=='onlinepath')//觀看地址
		{
			$value='ReturnOnlinepathHtml($ecms_gr)';
		}
		elseif($f=='morepic')//圖片集
		{
			$value='ReturnMorepicpathHtml($ecms_gr)';
		}
		elseif($f=='newstime')//時間
		{
			$value='date(\''.$formatdate.'\','.$value.')';
		}
		elseif($f=='befrom')//信息來源
		{
			$value='$docheckrep[1]?ReplaceBefrom('.$value.'):'.$value;
		}
		elseif($f=='writer')//作者
		{
			$value='$docheckrep[2]?ReplaceWriter('.$value.'):'.$value;
		}
		elseif($f=='titlepic')//標題圖片
		{
			$value='empty('.$value.')?$public_r[newsurl].\'e/data/images/notimg.gif\':'.$value;
		}
		elseif($f=='title')//標題
		{
		}
		else//正常字段
		{
			if(!strstr($emod_r[$mid]['editorf'],','.$f.','))
			{
				if(strstr($emod_r[$mid]['tobrf'],','.$f.','))//加br
				{
					$value='nl2br('.$value.')';
				}
				if(!strstr($emod_r[$mid]['dohtmlf'],','.$f.','))//去除html
				{
					$value='RepFieldtextNbsp(ehtmlspecialchars('.$value.'))';
				}
			}
		}
		$newstempstr=str_replace('[!--'.$f.'--]','<?='.$value.'?>',$newstempstr);
	}
	//固定變量
	$newstempstr=str_replace('[!--id--]','<?=$ecms_gr[id]?>',$newstempstr);
	$newstempstr=str_replace('[!--classid--]','<?=$ecms_gr[classid]?>',$newstempstr);
	$newstempstr=str_replace('[!--class.name--]','<?=$class_r[$ecms_gr[classid]][classname]?>',$newstempstr);
	$newstempstr=str_replace('[!--ttid--]','<?=$ecms_gr[ttid]?>',$newstempstr);
	$newstempstr=str_replace('[!--tt.name--]','<?=$class_tr[$ecms_gr[ttid]][tname]?>',$newstempstr);
	$newstempstr=str_replace('[!--tt.url--]','<?=sys_ReturnBqInfoTypeUrl($ecms_gr[ttid])?>',$newstempstr);
	$newstempstr=str_replace('[!--onclick--]','<?=$ecms_gr[onclick]?>',$newstempstr);
	$newstempstr=str_replace('[!--userfen--]','<?=$ecms_gr[userfen]?>',$newstempstr);
	$newstempstr=str_replace('[!--username--]','<?=$ecms_gr[username]?>',$newstempstr);
	//帶鏈接的用戶名
	$newstempstr=str_replace('[!--linkusername--]','<?=$ecms_gr[ismember]==1&&$ecms_gr[userid]?\'<a href="\'.$public_r[newsurl].\'e/space/?userid=\'.$ecms_gr[userid].\'" target=_blank>\'.$ecms_gr[username].\'</a>\':$ecms_gr[username]?>',$newstempstr);
	$newstempstr=str_replace('[!--userid--]','<?=$ecms_gr[userid]?>',$newstempstr);
	//相關鏈接
	$keyboardtext='<?=GetKeyboard($ecms_gr[keyboard],$ecms_gr[keyid],$ecms_gr[classid],$ecms_gr[id],$class_r[$ecms_gr[classid]][link_num])?>';
	$newstempstr=str_replace('[!--other.link--]',$keyboardtext,$newstempstr);
	$newstempstr=str_replace('[!--plnum--]','<?=$ecms_gr[plnum]?>',$newstempstr);
	$newstempstr=str_replace('[!--totaldown--]','<?=$ecms_gr[totaldown]?>',$newstempstr);
	$newstempstr=str_replace('[!--keyboard--]','<?=$ecms_gr[keyboard]?>',$newstempstr);
	//鏈接
	$newstempstr=str_replace('[!--titleurl--]','<?=$grtitleurl?>',$newstempstr);
	//點擊
	$onclick='<?=\'<script src="\'.$public_r[newsurl].\'e/public/onclick/?enews=donews&classid=\'.$ecms_gr[classid].\'&id=\'.$ecms_gr[id].\'"></script>\'?>';
	$newstempstr=str_replace('[!--page.stats--]',$onclick,$newstempstr);
	$newstempstr=str_replace('[!--class.url--]','<?=$grclassurl?>',$newstempstr);
	//下一篇
	if(strstr($newstemptext,'[!--info.next--]'))
	{
	$infonext='<?php
	$next_r=$empire->fetch1("select isurl,titleurl,classid,id,title from {$dbtbpre}ecms_".$class_r[$ecms_gr[classid]][tbname]." where id>$ecms_gr[id] and classid=\'$ecms_gr[classid]\' order by id limit 1");
	if(empty($next_r[id]))
	{$infonext="<a href=\'".$grclassurl."\'>'.$fun_r['HaveNoNextLink'].'</a>";}
	else
	{
		$nexttitleurl=sys_ReturnBqTitleLink($next_r);
		$infonext="<a href=\'".$nexttitleurl."\'>".$next_r[title]."</a>";
	}
	echo $infonext;
	?>';
	$newstempstr=str_replace('[!--info.next--]',$infonext,$newstempstr);
	}
	//上一篇
	if(strstr($newstemptext,'[!--info.pre--]'))
	{
	$infopre='<?php
	$next_r=$empire->fetch1("select isurl,titleurl,classid,id,title from {$dbtbpre}ecms_".$class_r[$ecms_gr[classid]][tbname]." where id<$ecms_gr[id] and classid=\'$ecms_gr[classid]\' order by id desc limit 1");
	if(empty($next_r[id]))
	{$infonext="<a href=\'".$grclassurl."\'>'.$fun_r['HaveNoNextLink'].'</a>";}
	else
	{
		$nexttitleurl=sys_ReturnBqTitleLink($next_r);
		$infonext="<a href=\'".$nexttitleurl."\'>".$next_r[title]."</a>";
	}
	echo $infonext;
	?>';
	$newstempstr=str_replace('[!--info.pre--]',$infopre,$newstempstr);
	}
	//投票
	if(strstr($newstemptext,'[!--info.vote--]'))
	{
		$newstempstr=str_replace('[!--info.vote--]','<?=sys_GetInfoVote($ecms_gr[classid],$ecms_gr[id])?>',$newstempstr);
	}
	return $newstempstr;
}

//生成內容文件
function GetHtml($classid,$id,$add,$ecms=0,$doall=0){
	global $public_r,$class_r,$class_zr,$fun_r,$empire,$dbtbpre,$emod_r,$class_tr,$level_r,$etable_r;
	$mid=$class_r[$classid]['modid'];
	$tbname=$class_r[$classid][tbname];
	if(InfoIsInTable($tbname))//內部表
	{
		return '';
	}
	if($ecms==0)//主表
	{
		$add=$empire->fetch1("select ".ReturnSqlTextF($mid,1)." from {$dbtbpre}ecms_".$tbname." where id='$id' limit 1");
	}
	$add['id']=$id;
	$add['classid']=$classid;
	if($add['isurl'])
	{
		return '';
	}
	if(empty($doall))
	{
		if(!$add['stb']||$class_r[$add[classid]][showdt]==2||strstr($public_r['nreinfo'],','.$add['classid'].','))//不生成
		{
			return '';
		}
	}
	//副表
	$addr=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from {$dbtbpre}ecms_".$tbname."_data_".$add[stb]." where id='$add[id]' limit 1");
	$add=array_merge($add,$addr);
	//路徑
	$iclasspath=ReturnSaveInfoPath($add[classid],$add[id]);
	$doclasspath=eReturnTrueEcmsPath().$iclasspath;//moreport
	$createinfopath=$doclasspath;
	//建立日期目錄
	$newspath='';
	if($add[newspath])
	{
		$createpath=$doclasspath.$add[newspath];
		if(!file_exists($createpath))
		{
			$r[newspath]=FormatPath($add[classid],$add[newspath],1);
		}
		$createinfopath.=$add[newspath].'/';
		$newspath=$add[newspath].'/';
	}
	//新建存放目錄
	if($class_r[$add[classid]][filename]==3)
	{
		$createinfopath.=ReturnInfoSPath($add['filename']);
		DoMkdir($createinfopath);
		$fn3=1;
	}
	//存文本
	if($emod_r[$mid]['savetxtf'])
	{
		$stf=$emod_r[$mid]['savetxtf'];
		if($add[$stf])
		{
			$add[$stf]=GetTxtFieldText($add[$stf]);
		}
	}
	$GLOBALS['navclassid']=$add[classid];
	$GLOBALS['navinfor']=$add;
	//取得內容模板
	$add[newstempid]=$add[newstempid]?$add[newstempid]:$class_r[$add[classid]][newstempid];
	$newstemp_r=$empire->fetch1("select temptext,showdate from ".GetTemptb("enewsnewstemp")." where tempid='$add[newstempid]' limit 1");
	$newstemp_r['tempid']=$add['newstempid'];
	if($public_r['opennotcj'])//啟用反採集
	{
		$newstemp_r['temptext']=ReturnNotcj($newstemp_r['temptext']);
	}
	$newstemptext=$newstemp_r[temptext];
	$formatdate=$newstemp_r[showdate];
	//文件類型/權限
	if($add[groupid]||$class_r[$add[classid]]['cgtoinfo'])
	{
		if(empty($add[newspath]))
		{
			$include='';
	    }
		else
		{
			$pr=explode('/',$add[newspath]);
			for($i=0;$i<count($pr);$i++)
			{
				$include.='../';
			}
		}
		if($fn3==1)
		{
			$include.='../';
		}
		$pr=explode('/',$iclasspath);
		$pcount=count($pr);
		for($i=0;$i<$pcount-1;$i++)
		{
			$include.='../';
		}
		$include1=$include;
		$include.='e/class/CheckLevel.php';
		$filetype='.php';
		$addlevel="<?php
		define('empirecms','wm_chief');
		\$check_tbname='".$class_r[$add[classid]][tbname]."';
		\$check_infoid=".$add[id].";
		\$check_classid=".$add[classid].";
		\$check_path=\"".$include1."\";
		require(\"".$include."\");
		?>";
    }
	else
	{
		$filetype=$class_r[$add[classid]][filetype];
		$addlevel='';
	}
	//取得本目錄鏈接
	if($class_r[$add[classid]][classurl]&&$class_r[$add[classid]][ipath]=='')//域名
	{
		$dolink=$class_r[$add[classid]][classurl].'/'.$newspath;
	}
	else
	{
		$dolink=$public_r[newsurl].$iclasspath.$newspath;
	}
	//返回替換驗證字符
	$docheckrep=ReturnCheckDoRepStr();
	if($add[newstext])
	{
		if(empty($public_r['dorepword'])&&$docheckrep[3])
		{
			$add[newstext]=ReplaceWord($add[newstext]);//過濾字符
		}
		if(empty($public_r['dorepkey'])&&$docheckrep[4]&&!empty($add[dokey]))//替換關鍵字
		{
			$add[newstext]=ReplaceKey($add['newstext'],$add['classid']);
		}
		if($public_r['opencopytext'])
		{
			$add[newstext]=AddNotCopyRndStr($add[newstext]);//隨機複製字符
		}
	}
	//返回編譯
	$newstemptext=GetInfoNewsBq($classid,$newstemp_r,$add,$docheckrep);
	//分頁字段
	$expage='[!--empirenews.page--]';//分頁符
	$pf=$emod_r[$mid]['pagef'];
	//變量替換
	$newstempstr=$newstemptext;//模板
	//分頁
	if($pf&&strstr($add[$pf],$expage))//有分頁
	{
		$n_r=explode($expage,$add[$pf]);
		$thispagenum=count($n_r);
		//取得分頁
		$thefun=$public_r['textpagefun']?$public_r['textpagefun']:'sys_ShowTextPage';
		//下拉式分頁
		if(strstr($newstemptext,'[!--title.select--]'))
		{
			$dotitleselect=sys_ShowTextPageSelect($thispagenum,$dolink,$add,$filetype,$n_r);
		}
		for($j=1;$j<=$thispagenum;$j++)
		{
			$string=$newstempstr;//模板
			$truepage='';
			$titleselect='';
			//下一頁鏈接
			if($thispagenum==$j)
			{
				$thisnextlink=$dolink.$add[filename].$filetype;
			}
			else
			{
				$thisj=$j+1;
				$thisnextlink=$dolink.$add[filename].'_'.$thisj.$filetype;
			}
			$k=$j-1;
			if($j==1)
			{
				$file=$doclasspath.$newspath.$add[filename].$filetype;
				$ptitle=$add[title];
			}
			else
			{
				$file=$doclasspath.$newspath.$add[filename].'_'.$j.$filetype;
				$ti_r=explode('[/!--empirenews.page--]',$n_r[$k]);
				if(count($ti_r)>=2)
				{
					$ptitle=$ti_r[0];
					$n_r[$k]=$ti_r[1];
				}
				else
				{
					$ptitle=$add[title].'('.$j.')';
				}
			}
			//取得當前頁
			if($thispagenum!=1)
			{
				$truepage=$thefun($thispagenum,$j,$dolink,$add,$filetype,'');
				$titleselect=str_replace("?".$j."\">","?".$j."\" selected>",$dotitleselect);
			}
			//替換變量
			$newstext=$n_r[$k];
			if(!strstr($emod_r[$mid]['editorf'],','.$pf.','))
			{
				if(strstr($emod_r[$mid]['tobrf'],','.$pf.','))//加br
				{
					$newstext=nl2br($newstext);
				}
				if(!strstr($emod_r[$mid]['dohtmlf'],','.$pf.','))//去除html
				{
					$newstext=ehtmlspecialchars($newstext);
					$newstext=RepFieldtextNbsp($newstext);
				}
			}
			$string=str_replace('[!--'.$pf.'--]',$newstext,$string);
			$string=str_replace('[!--p.title--]',strip_tags($ptitle),$string);
			$string=str_replace('[!--next.page--]',$thisnextlink,$string);
			$string=str_replace('[!--page.url--]',$truepage,$string);
			$string=str_replace('[!--title.select--]',$titleselect,$string);
			//寫文件
			WriteFiletext($file,$addlevel.$string);
		}
	}
	else
	{
		$file=$doclasspath.$newspath.$add[filename].$filetype;
		$string=$newstempstr;//模板
		//替換變量
		$string=str_replace('[!--p.title--]',$add[title],$string);
		$string=str_replace('[!--next.page--]','',$string);
		$string=str_replace('[!--page.url--]','',$string);
		$string=str_replace('[!--title.select--]','',$string);
		//寫文件
		WriteFiletext($file,$addlevel.$string);
	}
	//設為已生成
	if(empty($doall)&&empty($add['havehtml']))
	{
		$empire->query("update {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]."_index set havehtml=1 where id='$add[id]' limit 1");
		$empire->query("update {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]." set havehtml=1 where id='$add[id]' limit 1");
	}
}

//返回隨機字符
function ReturnNotcj($string){
	global $notcj_r,$notcjnum;
	if(empty($notcjnum))
	{
		$rep="";
    }
	else
	{
		$i=rand(1,$notcjnum);
		$rep=$notcj_r[$i];
    }
	$cjword="<!--ecms.*-->";
	$string=str_replace($cjword,$rep,$string);
	return $string;
}

//取得相關鏈接
function GetKeyboard($keyboard,$keyid,$classid,$id,$link_num){
	global $empire,$public_r,$class_r,$fun_r,$dbtbpre;
	if($keyid&&$link_num)
	{
		$add="id in (".$keyid.")";
		$tr=$empire->fetch1("select otherlinktemp,otherlinktempsub,otherlinktempdate from ".GetTemptb("enewspubtemp")." limit 1");//取得相關鏈接模板
		$temp_r=explode("[!--empirenews.listtemp--]",$tr[otherlinktemp]);
		$key_sql=$empire->query("select id,newstime,title,isurl,titleurl,classid,titlepic from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where ".$add." order by newstime desc limit $link_num");
		while($link_r=$empire->fetch($key_sql))
		{
			$keyboardtext.=RepOtherTemp($temp_r[1],$link_r,$tr);
		}
		$keyboardtext=$temp_r[0].$keyboardtext.$temp_r[2];
	}
	else
	{
		$keyboardtext=$fun_r['NotLinkNews'];
	}
	return $keyboardtext;
}

//替換相關鏈接模板
function RepOtherTemp($temptext,$r,$tr){
	global $public_r,$class_r;
	$title=sub($r[title],0,$tr['otherlinktempsub'],false);
	$r['newstime']=date($tr['otherlinktempdate'],$r['newstime']);
	$titlelink=sys_ReturnBqTitleLink($r);//標題鏈接
	$temptext=str_replace("[!--title--]",$title,$temptext);
	$temptext=str_replace("[!--oldtitle--]",$r[title],$temptext);
	$temptext=str_replace("[!--titleurl--]",$titlelink,$temptext);
	$temptext=str_replace("[!--newstime--]",$r[newstime],$temptext);
	if(empty($r[titlepic]))
	{
		$titlepic=$public_r[newsurl]."e/data/images/notimg.gif";
	}
	else
	{
		$titlepic=$r[titlepic];
	}
	$temptext=str_replace("[!--titlepic--]",$titlepic,$temptext);
	return $temptext;
}

//返回下載地址html代碼
function ReturnDownSoftHtml($add){
	global $class_r,$public_r,$fun_r,$level_r;
	if(empty($add[downpath]))
	{
		return '';
	}
	//每行顯示條數
	$down_num=$class_r[$add[classid]][down_num]?$class_r[$add[classid]][down_num]:1;
	//替換模板
	$ydownsofttemp=$public_r[downsofttemp];
	$ydownsofttemp=str_replace('[!--classid--]',$add[classid],$ydownsofttemp);
	$ydownsofttemp=str_replace('[!--id--]',$add[id],$ydownsofttemp);
	$ydownsofttemp=str_replace('[!--title--]',$add[title],$ydownsofttemp);
	$ydownsofttemp=str_replace('[!--news.url--]',$public_r[newsurl],$ydownsofttemp);
	//組合地址
	$all_downpath='';
	$path_r=explode("\r\n",$add[downpath]);
	$count=count($path_r);
    for($pj=0;$pj<$count;$pj++)
    {
		$p=$pj+1;
        if($p%$down_num==0)
        {
			$ok='<br>';
		}
        else
        {
			$ok='';
		}
		//相同
		if($count==$p)
		{
			$ok='';
		}
		if($pj%$down_num==0||$pj==0)
        {
			$nbsp='';
		}
        else
        {
			$nbsp='&nbsp;&nbsp;';
		}
	    $showdown_r=explode('::::::',$path_r[$pj]);
	    if(count($showdown_r)<2)
		{
			$showdown_r[0]=$fun_r['DownPath'].$p;
		}
		//模板
		$downsofttemp=RepDownOnlinePathTemp($add,$ydownsofttemp,$pj,$showdown_r,0);
        $all_downpath.=$nbsp.stripSlashes($downsofttemp).$ok;
    }
	$value=$all_downpath;
	return $value;
}

//替換下載在線地址模板
function RepDownOnlinePathTemp($add,$downsofttemp,$pj,$showdown_r,$ecms){
	global $public_r,$level_r,$fun_r;
	if($ecms==0)//下載
	{
		$downurl=$public_r[newsurl]."e/DownSys/DownSoft/?classid=$add[classid]&id=$add[id]&pathid=$pj";
	}
	else//在線
	{
		$downurl=$public_r[newsurl]."e/DownSys/play/?classid=$add[classid]&id=$add[id]&pathid=$pj";
	}
	$downsofttemp=str_replace('[!--down.url--]',$downurl,$downsofttemp);
	$downsofttemp=str_replace('[!--down.name--]',$showdown_r[0],$downsofttemp);
	$downsofttemp=str_replace('[!--pathid--]',$pj,$downsofttemp);
	$downsofttemp=str_replace('[!--fen--]',$showdown_r[3],$downsofttemp);
	$group=$showdown_r[2]?$level_r[$showdown_r[2]][groupname]:$fun_r['hguest'];
	$downsofttemp=str_replace('[!--group--]',$group,$downsofttemp);
	if(strstr($downsofttemp,'[!--true.down.url--]'))
	{
		$durl=stripSlashes($showdown_r[1]);
		$durlr=ReturnDownQzPath($durl,$showdown_r[4]);
		$durl=$durlr['repath'];
		$downsofttemp=str_replace('[!--true.down.url--]',$durl,$downsofttemp);
	}
	return $downsofttemp;
}

//返回在線地址html代碼
function ReturnOnlinepathHtml($add){
	global $class_r,$public_r,$fun_r,$level_r;
	if(empty($add[onlinepath]))
	{
		return '';
	}
	//每行顯示條數
	$down_num=$class_r[$add[classid]][online_num]?$class_r[$add[classid]][online_num]:1;
	//替換模板
	$yonlinemovietemp=$public_r[onlinemovietemp];
	$yonlinemovietemp=str_replace('[!--classid--]',$add[classid],$yonlinemovietemp);
	$yonlinemovietemp=str_replace('[!--id--]',$add[id],$yonlinemovietemp);
	$yonlinemovietemp=str_replace('[!--title--]',$add[title],$yonlinemovietemp);
	$yonlinemovietemp=str_replace('[!--news.url--]',$public_r[newsurl],$yonlinemovietemp);
	//地址
	$all_downpath='';
	$path_r=explode("\r\n",$add[onlinepath]);
	$count=count($path_r);
    for($pj=0;$pj<$count;$pj++)
    {
		$p=$pj+1;
        if($p%$down_num==0)
        {
			$ok='<br>';
		}
        else
        {
			$ok='';
		}
		//相同
		if($count==$p)
		{
			$ok='';
		}
		if($pj%$down_num==0||$pj==0)
        {
			$nbsp='';
		}
        else
        {
			$nbsp='&nbsp;&nbsp;';
		}
	    $showdown_r=explode('::::::',$path_r[$pj]);
	    if(count($showdown_r)<2)
		{
			$showdown_r[0]=$p;
		}
		//模板
		$downsofttemp=RepDownOnlinePathTemp($add,$yonlinemovietemp,$pj,$showdown_r,1);
        $all_downpath.=$nbsp.stripSlashes($downsofttemp).$ok;
	}
	$value=$all_downpath;
	return $value;
}

//返回圖片集html代碼
function ReturnMorepicpathHtml($add){
	global $public_r,$fun_r;
	if(empty($add[morepic]))
	{
		return '';
	}
	$line=$add[num]?$add[num]:1;//每行顯示
	$picpath='';
	$path_r=explode("\r\n",$add[morepic]);
	for($pj=0;$pj<count($path_r);$pj++)
    {
		$p=$pj+1;
		if(($p-1)%$line==0||$p==1)
		{
			$picpath.='<tr>';
		}
	    $showdown_r=explode('::::::',$path_r[$pj]);
		//顯示圖片名稱
		$name='';
		if(!empty($showdown_r[2]))
		{
			$name="<br><span style='line-height=18pt'>".$showdown_r[2]."</span>";
		}
		$width=$add[width]?" width='".$add[width]."'":'';//寬度
		$height=$add[height]?" height='".$add[height]."'":'';//高度
		$picpath.="<td align=center><a href='".$public_r[newsurl]."e/ViewImg/index.html?url=".$showdown_r[1]."' target=_blank><img src='".$showdown_r[0]."'".$width.$height." border=0>".$name."</a></td>";
		//分割
        if($p%$line==0)
		{
			$picpath.='</tr>';
		}
	}
	if($p<>0)
	{
		$table="<table width='100%' border=0 cellpadding=4 cellspacing=4>";
		$table1="</table>";
        $ys=$line-$p%$line;
		$dotr=0;
        for($j=0;$j<$ys&&$ys!=$line;$j++)
		{
			$dotr=1;
            $picpath.='<td></td>';
        }
		if($dotr==1)
		{
			$picpath.='</tr>';
		}
	}
	$value=$table.$picpath.$table1;
	return $value;
}

//生成js
function GetNewsJs($classid,$line,$sub,$showdate,$enews=0,$tempr){
	global $empire,$public_r,$class_r,$class_tr,$emod_r,$etable_r,$dbtbpre,$eyh_r;
	if(empty($line))
	{
		$line=10;
	}
	if(empty($sub))
	{
		$sub=26;
	}
	//欄目
	if($enews==0||$enews==1||$enews==2||$enews==9||$enews==12||$enews==15)
	{
		$where=$class_r[$classid][islast]?"classid='$classid'":ReturnClass($class_r[$classid][sonclass]);
		$tbname=$class_r[$classid][tbname];
		$mid=$class_r[$classid][modid];
		$yhid=$class_r[$classid][yhid];
    }
	elseif($enews==25||$enews==26||$enews==27||$enews==28||$enews==29||$enews==30)//標題分類
	{
		$where="ttid='$classid'";
		$mid=$class_tr[$classid][mid];
		$tbname=$emod_r[$mid][tbname];
		$yhid=$class_tr[$classid][yhid];
	}
	$allpath=ECMS_PATH.'d/js/js/';
	$ttpath=ECMS_PATH.'d/js/class/tt'.$classid.'_';
	$classpath=ECMS_PATH.'d/js/class/class'.$classid.'_';
	$query='';
	$qand=' and ';
	if($enews==0)//欄目最新
	{
	   $query=' where '.$where;
	   $order='newstime';
	   $newsjs=$classpath.'newnews.js';
	   $yhvar='bqnew';
    }
	elseif($enews==1)//欄目熱門
	{
	   $query=' where '.$where;
	   $order="onclick";
	   $newsjs=$classpath.'hotnews.js';
	   $yhvar='bqhot';
    }
	elseif($enews==2)//欄目推薦
	{
	   $query=' where '.$where.' and isgood>0';
	   $order='newstime';
	   $newsjs=$classpath.'goodnews.js';
	   $yhvar='bqgood';
    }
	elseif($enews==9)//各欄目評論排行
	{
	   $query=' where '.$where;
	   $order='plnum';
	   $newsjs=$classpath.'hotplnews.js';
	   $yhvar='bqpl';
    }
	elseif($enews==12)//各欄目頭條
	{
		$query=' where '.$where.' and firsttitle>0';
		$order='newstime';
		$newsjs=$classpath.'firstnews.js';
		$yhvar='bqfirst';
    }
	elseif($enews==3)//所有最新
	{
		$qand=' where ';
		$tbname=$public_r['tbname'];
		$order='newstime';
		$newsjs=$allpath.'newnews.js';
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==4)//所有點擊排行
	{
		$qand=' where ';
		$tbname=$public_r['tbname'];
		$order='onclick';
		$newsjs=$allpath.'hotnews.js';
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==5)//所有推薦
	{
		$tbname=$public_r['tbname'];
		$query=' where isgood>0';
		$order='newstime';
		$newsjs=$allpath.'goodnews.js';
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==10)//所有評論排行
	{
		$qand=' where ';
		$tbname=$public_r['tbname'];
		$order='plnum';
		$newsjs=$allpath.'hotplnews.js';
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==13)//所有頭條
	{
	   $tbname=$public_r['tbname'];
	   $query=' where firsttitle>0';
	   $order='newstime';
	   $newsjs=$allpath.'firstnews.js';
	   $mid=$etable_r[$tbname][mid];
	   $yhvar='bqfirst';
	   $yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==25)//標題分類最新
	{
	   $query=' where '.$where;
	   $order='newstime';
	   $newsjs=$ttpath.'newnews.js';
	   $yhvar='bqnew';
    }
	elseif($enews==26)//標題分類點擊排行
	{
	   $query=' where '.$where;
	   $order='onclick';
	   $newsjs=$ttpath.'hotnews.js';
	   $yhvar='bqhot';
    }
	elseif($enews==27)//標題分類推薦
	{
	   $query=' where '.$where.' and isgood>0';
	   $order='newstime';
	   $newsjs=$ttpath.'goodnews.js';
	   $yhvar='bqgood';
    }
	elseif($enews==28)//標題分類評論排行
	{
	   $query=' where '.$where;
	   $order='plnum';
	   $newsjs=$ttpath.'hotplnews.js';
	   $yhvar='bqpl';
    }
	elseif($enews==29)//標題分類頭條
	{
	   $query=' where '.$where.' and firsttitle>0';
	   $order='newstime';
	   $newsjs=$ttpath.'firstnews.js';
	   $yhvar='bqfirst';
    }
	$ret_r=ReturnReplaceListF($tempr[modid]);//字段
	//優化
	$yhadd='';
	if(!empty($eyh_r[$yhid]['dojs']))
	{
		$yhadd=ReturnYhSql($yhid,$yhvar);
		if(!empty($yhadd))
		{
			$query.=$qand.$yhadd;
			$qand=' and ';
		}
	}
	$query='select '.ReturnSqlListF($mid).' from '.$dbtbpre.'ecms_'.$tbname.$query.' order by '.ReturnSetTopSql('js').$order.' desc limit '.$line;
	$sql=$empire->query($query);
	//取得js模板
	$tempr[temptext]=str_replace('[!--news.url--]',$public_r[newsurl],$tempr[temptext]);
	$temp_r=explode("[!--empirenews.listtemp--]",$tempr[temptext]);
	$no=1;
	while($r=$empire->fetch($sql))
	{
		$r[oldtitle]=$r[title];
		//替換列表變量
		$repvar=ReplaceListVars($no,$temp_r[1],$tempr[subnews],$tempr[subtitle],$tempr[showdate],$url,0,$r,$ret_r);
		$allnew.=$repvar;
		$no++;
	}
	$allnew="document.write(\"".addslashes(stripSlashes(str_replace("\r\n","",$temp_r[0].$allnew.$temp_r[2])))."\");";
	WriteFiletext_n($newsjs,$allnew);
}

//生成自定義js
function ReUserjs($jsr,$addpath){
	global $empire,$public_r;
	DoFileMkDir($addpath.$jsr['jsfilename']);//建目錄
	//取得js模板
	$jstemptext=GetTheJstemp($jsr[jstempid]);
	$ret_r=ReturnReplaceListF($jstemptext[modid]);//字段
	$jstemptext[temptext]=str_replace('[!--news.url--]',$public_r[newsurl],$jstemptext[temptext]);
	$temp_r=explode("[!--empirenews.listtemp--]",$jstemptext[temptext]);
	$query=$jsr[jssql];
	$query=RepSqlTbpre($query);
	$sql=$empire->query($query);
	$no=1;
	while($r=$empire->fetch($sql))
	{
		$r[oldtitle]=$r[title];
		//替換列表變量
		$repvar=ReplaceListVars($no,$temp_r[1],$jstemptext[subnews],$jstemptext[subtitle],$jstemptext[showdate],$url,0,$r,$ret_r);
		$allnew.=$repvar;
		$no++;
	}
	$allnew="document.write(\"".addslashes(stripSlashes(str_replace("\r\n","",$temp_r[0].$allnew.$temp_r[2])))."\");";
	WriteFiletext_n($addpath.$jsr['jsfilename'],$allnew);
}

//刷新信息列表
function ReListHtml($classid,$enews=0){
	global $empire,$class_r,$dbtbpre;
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("NotChangeReClassid","history.go(-1)");
	}
	$r=$empire->fetch1("select classtempid,islist from {$dbtbpre}enewsclass where classid='$classid'");
	if($class_r[$classid][islast])//終極欄目
	{
		ListHtml($classid,$ret_r,0);
	}
	else
	{
		if($r[islist]==1)
		{
			ListHtml($classid,$ret_r,3);
		}
		elseif($r[islist]==3)
		{
			ReClassBdInfo($classid);
		}
		else
		{
			$classtemp=$r[islist]==2?GetClassText($classid):GetClassTemp($r['classtempid']);
			NewsBq($classid,$classtemp,0,0);
		}
	}
	if($enews==1)//內部刷新
	{return "";}
	insert_dolog("");//操作日誌
	printerror("ReClassidSuccess","history.go(-1)");
}

//取得自定義頁面模板
function GetPageTemp($tempid){
	global $empire;
	$r=$empire->fetch1("select temptext from ".GetTemptb("enewspagetemp")." where tempid='$tempid'");
	return $r['temptext'];
}

//替換自定義頁面標籤
function RepUserpageVar($pagetext,$title,$pagetitle,$pagekeywords,$pagedescription,$pagestr,$id){
	$pagestr=str_replace("[!--pagetext--]",$pagetext,$pagestr);
	$pagestr=str_replace("[!--pagetitle--]",$pagetitle,$pagestr);
	$pagestr=str_replace("[!--pagekeywords--]",$pagekeywords,$pagestr);
	$pagestr=str_replace("[!--pagedescription--]",$pagedescription,$pagestr);
	$pagestr=str_replace("[!--pageid--]",$id,$pagestr);
	$pagestr=str_replace("[!--pagename--]",$title,$pagestr);
	return $pagestr;
}

//生成自定義頁面
function ReUserpage($id,$pagetext,$path,$title="",$pagetitle,$pagekeywords,$pagedescription,$tempid=0){
	global $public_r;
	if(empty($path))
	{
		return "";
	}
	DoFileMkDir($path);//建目錄
	if(empty($pagetitle))
	{
		$pagetitle=$title;
	}
	//模板式
	if($tempid)
	{
		$pagestr=GetPageTemp($tempid);
	}
	else
	{
		$pagestr=$pagetext;
	}
	$pagestr=InfoNewsBq("page".$id,$pagestr);
	$pagestr=RepUserpageVar($pagetext,$title,$pagetitle,$pagekeywords,$pagedescription,$pagestr,$id);
	$pagestr=str_replace("[!--news.url--]",$public_r['newsurl'],$pagestr);
	WriteFiletext($path,$pagestr);
}

//生成自定義信息列表
function ReUserlist($listr,$addpath){
	$listr['addpath']=$addpath;
	DoFileMkDir($listr['addpath'].$listr['filepath']);//建目錄
	ListHtml($classid,$field,4,$listr);
}

//生成搜索文件
function GetSearch($mid=0){
	global $empire,$public_r,$fun_r,$dbtbpre;
	//取得模板
	$tr=$empire->fetch1("select searchtemp,searchjstemp,searchjstemp1 from ".GetTemptb("enewspubtemp")." limit 1");
	//返回欄目搜索
	$fcfile=eReturnTrueEcmsPath()."e/data/fc/ListEnews.php";
	$fcjsfile=eReturnTrueEcmsPath()."e/data/fc/cmsclass.js";
	if(file_exists($fcjsfile)&&file_exists($fcfile))
	{
		$options=GetFcfiletext($fcjsfile);
	}
	else
	{
		$options=ShowClass_AddClass("","n",0,"|-",0,1);
	}
	//$options="<script src=".$public_r[newsurl]."e/data/fc/searchclass.js></script>";
	$functions="function search_check(obj){if(obj.keyboard.value.length==0){alert('".$fun_r['EmptyKey']."');return false;}return true;}";
	//橫向搜索
	$searchjstemp=ReplaceStemp($tr[searchjstemp],$options,$url,0,'','','');
	$text2=$functions."document.write(\"".$searchjstemp."\");";
	//縱向搜索
	$searchjstemp1=ReplaceStemp($tr[searchjstemp1],$options,$url,0,'','','');
	$text3.=$functions."document.write(\"".$searchjstemp1."\");";
	//高級搜索
	$url="<a href='".ReturnSiteIndexUrl()."'>".$fun_r['index']."</a>&nbsp;>&nbsp;<a href='../search/'>".$fun_r['adsearch']."</a>&nbsp;>";//導航欄
	//搜索模板替換
	$dbsearchtemp=ReplaceStemp($tr[searchtemp],$options,$url,0,$fun_r['adsearch'],$fun_r['adsearch'],$fun_r['adsearch'],1);
	$text4=$dbsearchtemp;
	//增加信息欄目
	if($mid)
	{
		$options1=ShowClass_AddClass("","n",0,"|-",$mid,2);
		$addnews_class="document.write(\"".addslashes($options1)."\");";
		$filename3=eReturnTrueEcmsPath()."d/js/js/addinfo".$mid.".js";
		WriteFiletext_n($filename3,$addnews_class);
    }
	$filename=eReturnTrueEcmsPath()."d/js/js/search_news1.js";
	WriteFiletext_n($filename,$text2);
	$filename1=eReturnTrueEcmsPath()."d/js/js/search_news2.js";
	WriteFiletext_n($filename1,$text3);
	$filename2=eReturnTrueEcmsPath()."search/index".$public_r[searchtype];
	WriteFiletext($filename2,$text4);
}

//替換搜索結果變量
function RepSearchRtemp($temptext,$url){
	global $public_r;
	//熱門文章
	$temptext=str_replace("[!--hotnews--]","<script src=".$public_r[newsurl]."d/js/js/hotnews.js></script>",$temptext);
	//點擊排行
	$temptext=str_replace("[!--newnews--]","<script src=".$public_r[newsurl]."d/js/js/newnews.js></script>",$temptext);
	//推薦
	$temptext=str_replace("[!--goodnews--]","<script src=".$public_r[newsurl]."d/js/js/goodnews.js></script>",$temptext);
	//評論排行
	$temptext=str_replace("[!--hotplnews--]","<script src=".$public_r[newsurl]."d/js/js/hotplnews.js></script>",$temptext);
	//分頁
	$temptext=str_replace("[!--listpage--]","<?=\$listpage?>",$temptext);
	//關鍵字
	$temptext=str_replace("[!--keyboard--]","<?=\$keyboard?>",$temptext);
	//總記錄數
	$temptext=str_replace("[!--num--]","<?=\$num?>",$temptext);
	//導行條
	$temptext=str_replace("[!--url--]",$url,$temptext);
	$temptext=str_replace("[!--newsurl--]",$public_r[newsurl],$temptext);
	return $temptext;
}

//生成評論文件
function GetPlTempPage($pltempid=0){
	global $empire,$public_r,$fun_r,$dbtbpre;
	$pl_t_filename=eReturnTrueEcmsPath().'e/data/template/pltemp.txt';
	$yplfiletemp=ReadFiletext($pl_t_filename);
	$yplfiletemp=str_replace("\\","\\\\",$yplfiletemp);
	//導航欄
	$url="<a href='".ReturnSiteIndexUrl()."'>".$fun_r['index']."</a>&nbsp;>&nbsp;[!--title--]&nbsp;>&nbsp;".$fun_r['newspl']."&nbsp;>";
	$pagetitle="<?=\$pagetitle?> ".$fun_r['newspl'];
	$pagekey=$pagetitle;
	$pagedes=$pagetitle;
	$pr=$empire->fetch1("select plf from {$dbtbpre}enewspl_set limit 1");
	//回車字段
	$tobrf=',';
	$plfsql=$empire->query("select f from {$dbtbpre}enewsplf where ftype='VARCHAR' or ftype='TEXT' or ftype='MEDIUMTEXT' or ftype='LONGTEXT'");
	while($plfr=$empire->fetch($plfsql))
	{
		$tobrf.=$plfr[f].',';
	}
	$pr['pltobrf']=$tobrf;
	//取得評論頁面模板
	$where=$pltempid?" where tempid='$pltempid'":'';
	$ptsql=$empire->query("select tempid,temptext from ".GetTemptb("enewspltemp").$where);
	while($ptr=$empire->fetch($ptsql))
	{
		$plfiletemp=$yplfiletemp;
		$pl_filename=eReturnTrueEcmsPath().'e/data/filecache/template/pl'.$ptr[tempid].'.php';
		$pltemp=$ptr['temptext'];
		//頭部變量
		$pltemp=ReplaceSvars($pltemp,$url,0,$pagetitle,$pagekey,$pagedes,$add,1);
		$pltemp=RepSearchRtemp($pltemp,$url);
		//變量
		$pltemp=str_replace("[!--title--]","<?=\$title?>",$pltemp);
		$pltemp=str_replace("[!--titleurl--]","<?=\$titleurl?>",$pltemp);
		$pltemp=str_replace("[!--id--]","<?=\$id?>",$pltemp);
		$pltemp=str_replace("[!--classid--]","<?=\$classid?>",$pltemp);
		$pltemp=str_replace("[!--plnum--]","<?=\$num?>",$pltemp);
		//評分
		$pltemp=str_replace("[!--pinfopfen--]","<?=\$pinfopfen?>",$pltemp);
		$pltemp=str_replace("[!--infopfennum--]","<?=\$infopfennum?>",$pltemp);
		//登錄
		$pltemp=str_replace("[!--key.url--]",$public_r[newsurl]."e/ShowKey/?v=pl",$pltemp);
		$pltemp=str_replace("[!--lusername--]","<?=\$lusername?>",$pltemp);
		$pltemp=str_replace("[!--lpassword--]","<?=\$lpassword?>",$pltemp);
		//列表變量
		$listtemp_r=explode("[!--empirenews.listtemp--]",$pltemp);
		$plfiletemp=str_replace("<!--empire.listtemp.top-->",$listtemp_r[0],$plfiletemp);
		$plfiletemp=str_replace("<!--empire.listtemp.footer-->",$listtemp_r[2],$plfiletemp);
		//列表中間
		$listtemp_center=str_replace("[!--plid--]","<?=\$r[plid]?>",$listtemp_r[1]);
		$listtemp_center=str_replace("[!--pltext--]","<?=\$saytext?>",$listtemp_center);
		$listtemp_center=str_replace("[!--pltime--]","<?=\$saytime?>",$listtemp_center);
		$listtemp_center=str_replace("[!--plip--]","<?=\$sayip?>",$listtemp_center);
		$listtemp_center=str_replace("[!--username--]","<?=\$plusername?>",$listtemp_center);
		$listtemp_center=str_replace("[!--userid--]","<?=\$r[userid]?>",$listtemp_center);
		$listtemp_center=str_replace("[!--includelink--]","<?=\$includelink?>",$listtemp_center);
		$listtemp_center=str_replace("[!--zcnum--]","<?=\$r[zcnum]?>",$listtemp_center);
		$listtemp_center=str_replace("[!--fdnum--]","<?=\$r[fdnum]?>",$listtemp_center);
		$listtemp_center=ReplacePlListVars($listtemp_center,$r,$pr,0);
		$plfiletemp=str_replace("<!--empire.listtemp.center-->",$listtemp_center,$plfiletemp);
		WriteFiletext($pl_filename,$plfiletemp);
	}
}

//替換評論字段
function ReplacePlListVars($temp,$r,$pr,$ecms=0){
	$fr=explode(',',$pr['plf']);
	$count=count($fr)-1;
	for($i=1;$i<$count;$i++)
	{
		$f=$fr[$i];
		if($ecms==1)
		{
			if(strstr($pr['pltobrf'],','.$f.','))
			{
				$temp=str_replace('[!--'.$f.'--]',"<?=addslashes(stripSlashes(str_replace(\"\\r\\n\",\"\",\$r[".$f."])))?>",$temp);
			}
			else
			{
				$temp=str_replace('[!--'.$f.'--]',"<?=\$r[".$f."]?>",$temp);
			}
		}
		else
		{
			if(strstr($pr['pltobrf'],','.$f.','))
			{
				$temp=str_replace('[!--'.$f.'--]',"<?=stripSlashes(\$r[".$f."])?>",$temp);
			}
			else
			{
				$temp=str_replace('[!--'.$f.'--]',"<?=\$r[".$f."]?>",$temp);
			}
		}
	}
	return $temp;
}

//生成評論JS文件
function GetPlJsPage(){
	global $empire,$public_r,$fun_r,$dbtbpre;
	$pl_t_filename=eReturnTrueEcmsPath()."e/data/template/pljstemp.txt";
	$pl_filename=eReturnTrueEcmsPath()."e/pl/more/index.php";
	$pltemp=ReadFiletext($pl_t_filename);
	$pr=$empire->fetch1("select plf from {$dbtbpre}enewspl_set limit 1");
	//回車字段
	$tobrf=',';
	$plfsql=$empire->query("select f from {$dbtbpre}enewsplf where ftype='VARCHAR' or ftype='TEXT' or ftype='MEDIUMTEXT' or ftype='LONGTEXT'");
	while($plfr=$empire->fetch($plfsql))
	{
		$tobrf.=$plfr[f].',';
	}
	$pr['pltobrf']=$tobrf;
	//取得評論JS模板
	$pl_r=$empire->fetch1("select pljstemp from ".GetTemptb("enewspubtemp")." limit 1");
	$pljstemp=str_replace("\r\n","",$pl_r['pljstemp']);
	$pljstemp=addslashes(stripSlashes($pljstemp));
	$pljstemp=str_replace("[!--id--]","<?=\$id?>",$pljstemp);
	$pljstemp=str_replace("[!--classid--]","<?=\$classid?>",$pljstemp);
	$pljstemp=str_replace("[!--news.url--]",$public_r[newsurl],$pljstemp);
	$listtemp_r=explode("[!--empirenews.listtemp--]",$pljstemp);
	$pltemp=str_replace("<!--empire.listtemp.top-->",$listtemp_r[0],$pltemp);
	$pltemp=str_replace("<!--empire.listtemp.footer-->",$listtemp_r[2],$pltemp);
	//列表中間
	$listtemp_center=str_replace("[!--plid--]","<?=\$r[plid]?>",$listtemp_r[1]);
	$listtemp_center=str_replace("[!--pltext--]","<?=\$saytext?>",$listtemp_center);
	$listtemp_center=str_replace("[!--pltime--]","<?=\$saytime?>",$listtemp_center);
	$listtemp_center=str_replace("[!--plip--]","<?=\$sayip?>",$listtemp_center);
	$listtemp_center=str_replace("[!--username--]","<?=\$plusername?>",$listtemp_center);
	$listtemp_center=str_replace("[!--userid--]","<?=\$r[userid]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--zcnum--]","<?=\$r[zcnum]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--fdnum--]","<?=\$r[fdnum]?>",$listtemp_center);
	$listtemp_center=ReplacePlListVars($listtemp_center,$r,$pr,1);
	$pltemp=str_replace("<!--empire.listtemp.center-->",$listtemp_center,$pltemp);
    WriteFiletext_n($pl_filename,$pltemp);
}

//生成留言板文件
function ReGbooktemp(){
	global $empire,$public_r,$fun_r,$dbtbpre;
	$tfile=eReturnTrueEcmsPath()."e/data/template/gbooktemp.txt";
	$file=eReturnTrueEcmsPath()."e/tool/gbook/index.php";
	$gbtemp=ReadFiletext($tfile);
	//取得留言頁面模板
	$pr=$empire->fetch1("select gbooktemp from ".GetTemptb("enewspubtemp")." limit 1");
	$url="<?=\$url?>";
	$pagetitle="<?=\$bname?>";
	$pr['gbooktemp']=ReplaceSvars($pr['gbooktemp'],$url,0,$pagetitle,$pagetitle,$pagetitle,$add,1);
	$pr['gbooktemp']=RepSearchRtemp($pr['gbooktemp'],$url);
	$pr['gbooktemp']=str_replace("[!--bname--]","<?=\$bname?>",$pr['gbooktemp']);
	$pr['gbooktemp']=str_replace("[!--bid--]","<?=\$bid?>",$pr['gbooktemp']);

	$listtemp_r=explode("[!--empirenews.listtemp--]",$pr['gbooktemp']);
	$gbtemp=str_replace("<!--empire.listtemp.top-->",$listtemp_r[0],$gbtemp);
	$gbtemp=str_replace("<!--empire.listtemp.footer-->",$listtemp_r[2],$gbtemp);
	//---列表中間
	//處理回復
	$restart="
<?php
if(\$r[retext])
{
?>
";
	$endstart="
<?php
}
?>";
	$listtemp_center=str_replace("[!--start.regbook--]",$restart,$listtemp_r[1]);
	$listtemp_center=str_replace("[!--end.regbook--]",$endstart,$listtemp_center);

	$listtemp_center=str_replace("[!--lyid--]","<?=\$r[lyid]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--name--]","<?=\$r[name]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--email--]","<?=\$r[email]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--mycall--]","<?=\$r[mycall]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--lytime--]","<?=\$r[lytime]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--lytext--]","<?=\$r[lytext]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--retext--]","<?=\$r[retext]?>",$listtemp_center);

	$gbtemp=str_replace("<!--empire.listtemp.center-->",$listtemp_center,$gbtemp);
	WriteFiletext($file,$gbtemp);
}

//更新控制面板模板
function ReCptemp(){
	global $empire,$public_r,$dbtbpre,$fun_r;
	$pr=$empire->fetch1("select cptemp from ".GetTemptb("enewspubtemp")." limit 1");
	$url="<?=\$url?>";
	$pagetitle="<?=defined('empirecms')?\$public_diyr[pagetitle]:'".$fun_r['membercp']."'?>";
	$temptext=ReplaceSvars($pr['cptemp'],$url,0,$pagetitle,$pagetitle,$pagetitle,$add,1);
	//生成頭尾文件
	$r=explode("[!--empirenews.template--]",$temptext);
	$file1=eReturnTrueEcmsPath()."e/data/template/cp_1.php";
	WriteFiletext($file1,AddCheckViewTempCode().$r[0]);
	$file2=eReturnTrueEcmsPath()."e/data/template/cp_2.php";
	WriteFiletext($file2,AddCheckViewTempCode().$r[1]);
}

//更新登陸狀態模板
function ReLoginIframe(){
	global $empire,$public_r,$dbtbpre;
	$tfile=eReturnTrueEcmsPath()."e/data/template/loginiframetemp.txt";
	$loginiframetemp=ReadFiletext($tfile);
	$pr=$empire->fetch1("select loginiframe,loginjstemp from ".GetTemptb("enewspubtemp")." limit 1");
	//框架登陸狀態調用
	$temptext=str_replace("[!--news.url--]",$public_r['newsurl'],$pr['loginiframe']);
	$temptext=str_replace("[!--userid--]","<?=\$myuserid?>",$temptext);
	$temptext=str_replace("[!--username--]","<?=\$myusername?>",$temptext);
	$temptext=str_replace("[!--groupname--]","<?=\$groupname?>",$temptext);
	$temptext=str_replace("[!--money--]","<?=\$money?>",$temptext);
	$temptext=str_replace("[!--userdate--]","<?=\$userdate?>",$temptext);
	$temptext=str_replace("[!--havemsg--]","<?=\$havemsg?>",$temptext);
	$temptext=str_replace("[!--userfen--]","<?=\$userfen?>",$temptext);
	$r=explode("[!--empirenews.template--]",$temptext);
	$text=str_replace("<!--login-->",$r[0],$loginiframetemp);
	$text=str_replace("<!--loginin-->",$r[1],$text);
	$file=eReturnTrueEcmsPath()."e/member/iframe/index.php";
	WriteFiletext($file,$text);
	//JS登陸狀態調用
	$temptext=str_replace("[!--news.url--]",$public_r['newsurl'],$pr['loginjstemp']);
	$temptext=str_replace("[!--userid--]","<?=\$myuserid?>",$temptext);
	$temptext=str_replace("[!--username--]","<?=\$myusername?>",$temptext);
	$temptext=str_replace("[!--groupname--]","<?=\$groupname?>",$temptext);
	$temptext=str_replace("[!--money--]","<?=\$money?>",$temptext);
	$temptext=str_replace("[!--userdate--]","<?=\$userdate?>",$temptext);
	$temptext=str_replace("[!--havemsg--]","<?=\$havemsg?>",$temptext);
	$temptext=str_replace("[!--userfen--]","<?=\$userfen?>",$temptext);
	$r=explode("[!--empirenews.template--]",$temptext);
	$login="document.write(\"".addslashes(stripSlashes(str_replace("\r\n","",$r[0])))."\");";
	$loginin="document.write(\"".addslashes(stripSlashes(str_replace("\r\n","",$r[1])))."\");";
	$text=str_replace("<!--login-->",$login,$loginiframetemp);
	$text=str_replace("<!--loginin-->",$loginin,$text);
	$file=eReturnTrueEcmsPath()."e/member/login/loginjs.php";
	WriteFiletext_n($file,$text);
}

//返回投票模板
function ReturnVoteTemp($tempid,$enews=0){
	global $empire;
	$r=$empire->fetch1("select temptext from ".GetTemptb("enewsvotetemp")." where tempid='$tempid'");
	if($enews)
	{
		$r[temptext]=str_replace("\r\n","",$r[temptext]);
	}
	return $r[temptext];
}

//替換投票模板總體變量
function RepVoteTempAllvar($temptext,$r){
	global $public_r;
	$action=$public_r['newsurl']."e/enews/index.php";
	$temptext=str_replace("[!--vote.action--]",$action,$temptext);
	$temptext=str_replace("[!--title--]",$r[title],$temptext);
	$viewurl=$public_r[newsurl]."e/tool/vote/?voteid=".$r[voteid];
	$temptext=str_replace("[!--vote.view--]",$viewurl,$temptext);
	$temptext=str_replace("[!--width--]",$r[width],$temptext);
	$temptext=str_replace("[!--height--]",$r[height],$temptext);
	$temptext=str_replace("[!--voteid--]",$r[voteid],$temptext);
	$temptext=str_replace("[!--id--]",$r[id],$temptext);
	$temptext=str_replace("[!--classid--]",$r[classid],$temptext);
	$temptext=str_replace("[!--news.url--]",$public_r[newsurl],$temptext);
	return $temptext;
}

//替換投票模板列表
function RepVoteTempListvar($temptext,$votebox,$votename){
	$temptext=str_replace("[!--vote.box--]",$votebox,$temptext);
	$temptext=str_replace("[!--vote.name--]",$votename,$temptext);
	return $temptext;
}

//生成打印頁面
function GetPrintPage($printtempid=0){
	global $empire,$dbtbpre,$fun_r,$public_r;
	$file=eReturnTrueEcmsPath().'e/data/template/printtemp.txt';
	$string=ReadFiletext($file);
	$url="<?=\$url?>";
	$pagetitle="<?=ehtmlspecialchars(\$r[title])?> ".$fun_r['PrintPage'];
	//取得評論頁面模板
	$where=$printtempid?" where tempid='$printtempid'":'';
	$ptsql=$empire->query("select tempid,temptext,showdate,modid from ".GetTemptb("enewsprinttemp").$where);
	while($ptr=$empire->fetch($ptsql))
	{
		$ptr[temptext]=ReplaceSvars($ptr[temptext],$url,0,$pagetitle,$pagetitle,$pagetitle,$add,1);
		$printtemp=RepPrintTempV($ptr);
		$printtemp=str_replace("<!--empire.print-->",$printtemp,$string);
		$truefile=eReturnTrueEcmsPath().'e/data/filecache/template/print'.$ptr[tempid].'.php';
		WriteFiletext($truefile,$printtemp);
	}
}

//替換打印模板變量
function RepPrintTempV($tr){
	global $empire,$dbtbpre,$fun_r,$public_r,$emod_r;
	$temptext=$tr['temptext'];
	$mid=$tr['modid'];
	//字段
	$tempf=$emod_r[$mid]['tempf'];
	$fr=explode(',',$tempf);
	$fcount=count($fr)-1;
	for($i=1;$i<$fcount;$i++)
	{
		$f=$fr[$i];
		$value="stripSlashes(\$r[".$f."])";
		if($f=='newstime')//時間
		{
			$value="date('".$tr[showdate]."',\$r[".$f."])";
		}
		elseif($f=='title')//標題
		{
		}
		else//正常字段
		{
			if(!strstr($emod_r[$mid]['editorf'],','.$f.','))
			{
				if(strstr($emod_r[$mid]['tobrf'],','.$f.','))//加br
				{
					$value='nl2br('.$value.')';
				}
				if(!strstr($emod_r[$mid]['dohtmlf'],','.$f.','))//去除html
				{
					$value='RepFieldtextNbsp(ehtmlspecialchars('.$value.'))';
				}
			}
		}
		$temptext=str_replace('[!--'.$f.'--]','<?='.$value.'?>',$temptext);
	}
	$temptext=str_replace("[!--id--]","<?=\$r[id]?>",$temptext);
	$temptext=str_replace("[!--classid--]","<?=\$r[classid]?>",$temptext);
	$temptext=str_replace("[!--keyboard--]","<?=\$r[keyboard]?>",$temptext);
	$temptext=str_replace("[!--class.name--]","<?=\$class_r[\$classid][classname]?>",$temptext);
	$temptext=str_replace("[!--bclass.id--]","<?=\$bclassid?>",$temptext);
	$temptext=str_replace("[!--bclass.name--]","<?=\$class_r[\$bclassid][classname]?>",$temptext);
	$temptext=str_replace('[!--ttid--]',"<?=\$r[ttid]?>",$temptext);
	$temptext=str_replace('[!--tt.name--]',"<?=\$class_tr[\$r[ttid]][tname]?>",$temptext);
	$temptext=str_replace('[!--tt.url--]',"<?=sys_ReturnBqInfoTypeUrl(\$r[ttid])?>",$temptext);
	$temptext=str_replace("[!--userfen--]","<?=\$r[userfen]?>",$temptext);
	$temptext=str_replace("[!--onclick--]","<?=\$r[onclick]?>",$temptext);
	$temptext=str_replace("[!--totaldown--]","<?=\$r[totaldown]?>",$temptext);
	$temptext=str_replace("[!--plnum--]","<?=\$r[plnum]?>",$temptext);
	$temptext=str_replace("[!--userid--]","<?=\$r[userid]?>",$temptext);
	$temptext=str_replace("[!--username--]","<?=\$r[username]?>",$temptext);
	$temptext=str_replace("[!--titlelink--]","<?=\$titleurl?>",$temptext);
	$temptext=str_replace("[!--titleurl--]","<?=\$titleurl?>",$temptext);
	$temptext=str_replace("[!--url--]","<?=\$url?>",$temptext);
	return $temptext;
}

//更新下載頁面模板
function GetDownloadPage(){
	global $empire,$public_r,$dbtbpre,$fun_r;
	$pr=$empire->fetch1("select downpagetemp from ".GetTemptb("enewspubtemp")." limit 1");
	$temptext=$pr['downpagetemp'];
	$url="<a href='".ReturnSiteIndexUrl()."'>".$fun_r['index']."</a>&nbsp;>&nbsp;<a href='<?=\$titleurl?>'><?=\$r[title]?></a>&nbsp;>&nbsp;<?=\$thisdownname?>";
	$pagetitle="<?=ehtmlspecialchars(\$r[title])?> - <?=ehtmlspecialchars(\$thisdownname)?>";
	$temptext=ReplaceSvars($temptext,$url,"<?=\$r[classid]?>",$pagetitle,$pagetitle,$pagetitle,$add,1);
	//分類
	$temptext=str_replace("[!--classid--]","<?=\$r[classid]?>",$temptext);
	$temptext=str_replace("[!--class.name--]","<?=\$classname?>",$temptext);
	$temptext=str_replace("[!--bclass.id--]","<?=\$bclassid?>",$temptext);
	$temptext=str_replace("[!--bclass.name--]","<?=\$bclassname?>",$temptext);
	//下載地址
	$temptext=str_replace("[!--down.url--]","<?=\$url?>",$temptext);
	$temptext=str_replace("[!--true.down.url--]","<?=\$trueurl?>",$temptext);
	$temptext=str_replace("[!--down.name--]","<?=\$thisdownname?>",$temptext);
	//下載權限
	$temptext=str_replace("[!--fen--]","<?=\$fen?>",$temptext);
	$temptext=str_replace("[!--group--]","<?=\$downuser?>",$temptext);
	//信息
	$temptext=str_replace("[!--id--]","<?=\$r[id]?>",$temptext);
	$temptext=str_replace("[!--titleurl--]","<?=\$titleurl?>",$temptext);
	$temptext=str_replace("[!--title--]","<?=\$r[title]?>",$temptext);
	$temptext=str_replace("[!--newstime--]","<?=\$newstime?>",$temptext);
	$temptext=str_replace("[!--titlepic--]","<?=\$titlepic?>",$temptext);
	$temptext=str_replace("[!--keyboard--]","<?=\$r[keyboard]?>",$temptext);
	$temptext=str_replace("[!--userid--]","<?=\$r[userid]?>",$temptext);
	$temptext=str_replace("[!--username--]","<?=\$r[username]?>",$temptext);
	$temptext=str_replace("[!--pathid--]","<?=\$pathid?>",$temptext);
	$temptext=str_replace("[!--totaldown--]","<?=\$r[totaldown]?>",$temptext);
	$temptext=str_replace("[!--onclick--]","<?=\$r[onclick]?>",$temptext);
	$file=eReturnTrueEcmsPath()."e/data/template/downpagetemp.php";
	WriteFiletext($file,AddCheckViewTempCode().$temptext);
}

//生成全站搜索文件
function ReSchAlltemp(){
	global $empire,$public_r,$fun_r,$dbtbpre;
	$tfile=eReturnTrueEcmsPath()."e/data/template/schalltemp.txt";
	$file=eReturnTrueEcmsPath()."e/sch/index.php";
	$temp=ReadFiletext($tfile);
	//取得頁面模板
	$pr=$empire->fetch1("select schalltemp,schallsubnum,schalldate from ".GetTemptb("enewspubtemp")." limit 1");
	$url="<?=\$url?>";
	$pagetitle=$fun_r['SearchAllNav'];
	$pr['schalltemp']=ReplaceSvars($pr['schalltemp'],$url,0,$pagetitle,$pagetitle,$pagetitle,$add,1);
	$temp=str_replace("<!--empire.listtemp.subnum-->",$pr['schallsubnum'],$temp);
	$temp=str_replace("<!--empire.listtemp.formatdate-->",$pr['schalldate'],$temp);

	$pr['schalltemp']=str_replace("[!--keyboard--]","<?=\$keyboard?>",$pr['schalltemp']);
	$pr['schalltemp']=str_replace("[!--num--]","<?=\$num?>",$pr['schalltemp']);
	$pr['schalltemp']=str_replace("[!--listpage--]","<?=\$listpage?>",$pr['schalltemp']);

	$listtemp_r=explode("[!--empirenews.listtemp--]",$pr['schalltemp']);
	$temp=str_replace("<!--empire.listtemp.top-->",$listtemp_r[0],$temp);
	$temp=str_replace("<!--empire.listtemp.footer-->",$listtemp_r[2],$temp);
	//---列表中間
	$listtemp_center=str_replace("[!--no.num--]","<?=\$no?>",$listtemp_r[1]);
	$listtemp_center=str_replace("[!--titleurl--]","<?=\$titleurl?>",$listtemp_center);
	$listtemp_center=str_replace("[!--id--]","<?=\$r[id]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--classid--]","<?=\$r[classid]?>",$listtemp_center);
	$listtemp_center=str_replace("[!--titlepic--]","<?=\$titlepic?>",$listtemp_center);
	$listtemp_center=str_replace("[!--newstime--]","<?=\$newstime?>",$listtemp_center);
	$listtemp_center=str_replace("[!--title--]","<?=\$title?>",$listtemp_center);
	$listtemp_center=str_replace("[!--smalltext--]","<?=\$smalltext?>",$listtemp_center);

	$temp=str_replace("<!--empire.listtemp.center-->",$listtemp_center,$temp);
	WriteFiletext($file,$temp);
}


//-------------- 用戶區 ----------------------

//返回操作權限
function ReturnLeftLevel($groupid){
	global $empire,$dbtbpre;
	if(empty($groupid))
	{return "";}
	$groupid=(int)$groupid;
	$r=$empire->fetch1("select * from {$dbtbpre}enewsgroup where groupid='$groupid'");
	return $r;
}

//password
function DoEmpireCMSAdminPassword($password,$salt,$salt2){
	$pw=md5($salt2.'E!m^p-i(r#e.C:M?S'.md5(md5($password).$salt).'d)i.g^o-d'.$salt);
	return $pw;
}

//返回操作權限
function CheckLevel($userid,$username,$classid,$enews){
	global $empire,$dbtbpre;
	$userid=(int)$userid;
	$r=$empire->fetch1("select groupid,adminclass from {$dbtbpre}enewsuser where userid='$userid' limit 1");
	//操作信息
	if($enews=="news")
	{
		//操作所有欄目權限
		$gr=$empire->fetch1("select doall,doselfinfo,doaddinfo,doeditinfo,dodelinfo,docheckinfo,dogoodinfo,dodocinfo,domoveinfo,domustcheck,docheckedit from {$dbtbpre}enewsgroup where groupid='$r[groupid]'");
		if(empty($gr[doall]))
		{
			$e_r=explode("|".$classid."|",$r[adminclass]);
			if(count($e_r)!=2)
			{printerror("NotNewsLevel","history.go(-1)");}
		}
		$gr['add_adminclass']=$r['adminclass'];
		return $gr;
    }
	else
	{
		//用戶組
		$gr=$empire->fetch1("select * from {$dbtbpre}enewsgroup where groupid='$r[groupid]'");
		$enews="do".$enews;
		if(empty($gr[$enews]))
		{
			printerror("NotLevel","history.go(-1)");
	    }
		$gr['add_adminclass']=$r['adminclass'];
		return $gr;
    }
}

//驗證設置權限
function CheckDoLevel($lur,$groupid,$userclass,$username,$ecms=0){
	$ret=0;
	if(strstr($groupid,','.$lur[groupid].','))
	{
		$ret=1;
	}
	elseif(strstr($userclass,','.$lur[classid].','))
	{
		$ret=1;
	}
	elseif(stristr($username,','.$lur[username].','))
	{
		$ret=1;
	}
	if($ecms==0&&$ret==0)
	{
		printerror('NotLevel','history.go(-1)');
	}
	return $ret;
}

//驗證固定用戶權限
function CheckAndUsernamesLevel($level,$id,$userid,$username,$groupid){
	global $empire,$dbtbpre;
	$id=(int)$id;
	if(!$id)
	{
		printerror('ErrorUrl','history.go(-1)');
	}
	if($level=='dozt')//專題
	{
		$getquery="select ztid,usernames from {$dbtbpre}enewszt where ztid='$id'";
		$id_field='ztid';
		$users_field='usernames';
	}
	else
	{
		printerror('ErrorUrl','history.go(-1)');
	}
	$getr=$empire->fetch1($getquery);
	if(!$getr[$id_field])
	{
		printerror('ErrorUrl','history.go(-1)');
	}
	$gr=$empire->fetch1("select groupid,".$level." from {$dbtbpre}enewsgroup where groupid='$groupid'");
	if(!$gr['groupid'])
	{
		printerror('NotLevel','history.go(-1)');
	}
	if($gr[$level])
	{
		return 2;
	}
	if(!stristr(','.$getr[$users_field].',',','.$username.','))
	{
		printerror('NotLevel','history.go(-1)');
	}
	return 1;
}

//是否登陸
function is_login($uid=0,$uname='',$urnd=''){
	global $empire,$public_r,$dbtbpre;
	$userid=$uid?$uid:getcvar('loginuserid',1);
	$username=$uname?$uname:getcvar('loginusername',1);
	$rnd=$urnd?$urnd:getcvar('loginrnd',1);
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$rnd=RepPostVar($rnd);
	if(!$userid||!$username||!$rnd)
	{
		printerror("NotLogin","index.php");
	}
	$groupid=(int)getcvar('loginlevel',1);
	$adminstyle=(int)getcvar('loginadminstyleid',1);
	if(!strstr($public_r['adminstyle'],','.$adminstyle.','))
	{
		$adminstyle=$public_r['defadminstyle']?$public_r['defadminstyle']:1;
	}
	$truelogintime=(int)getcvar('truelogintime',1);
	$cdbdata=0;
	//COOKIE驗證
	$cdbdata=getcvar('ecmsdodbdata',1)?1:0;
	DoChECookieRnd($userid,$username,$rnd,'',$cdbdata,$groupid,$adminstyle,$truelogintime);
	//db
	$adminr=$empire->fetch1("select userid,groupid,classid,userprikey,uprnd from {$dbtbpre}enewsuser where userid='$userid' and username='".$username."' and rnd='".$rnd."' and checked=0 limit 1");
	if(!$adminr['userid'])
	{
		printerror("SingleUser","index.php");
	}
	DoECheckAndAuthRnd($userid,$username,$rnd,$adminr['userprikey'],$cdbdata,$groupid,$adminstyle,$truelogintime);
	//登陸超時
	$logintime=getcvar('logintime',1);
	if($logintime)
	{
		if(time()-$logintime>$public_r['exittime']*60)
		{
			esetcookie("loginrnd","",0,1);
			printerror("LoginTime","index.php");
	    }
		esetcookie("logintime",time(),0,1);
	}
	if(getcvar('eloginlic',1)<>"empirecmslic")
	{
		printerror("NotLogin","index.php");
	}
	$ur[userid]=$userid;
	$ur[username]=$username;
	$ur[rnd]=$rnd;
	$ur[groupid]=$adminr[groupid];
	$ur[adminstyleid]=(int)$adminstyle;
	$ur[classid]=$adminr[classid];
	return $ur;
}

function is_login_ebak($userid,$username,$rnd){
	global $empire,$public_r;
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$dodbdata=getcvar('ecmsdodbdata',1);
	if(!$userid||!$username)
	{
		printerror("NotLogin","index.php");
	}
	if($dodbdata!="empirecms")
	{
		printerror("NotLogin","index.php");
	}
	$rnd=RepPostVar($rnd);
	//COOKIE驗證
	$cdbdata=$dodbdata?1:0;
	$groupid=(int)getcvar('loginlevel',1);
	$adminstyle=(int)getcvar('loginadminstyleid',1);
	$truelogintime=(int)getcvar('truelogintime',1);
	DoChECookieRnd($userid,$username,$rnd,'',$cdbdata,$groupid,$adminstyle,$truelogintime);
	//超時
	$logintime=getcvar('logintime',1);
	if($logintime)
	{
		if(time()-$logintime>$public_r['exittime']*60)
		{
			esetcookie("loginrnd","",0,1);
			printerror("LoginTime","index.php");
	    }
		esetcookie("logintime",time(),0,1);
	}
	$ur[userid]=$userid;
	$ur[username]=$username;
	$ur[rnd]=$rnd;
	$ur[groupid]=$groupid;
	$ur[adminstyleid]=$adminstyle;
	$ur[classid]=0;
	return $ur;
}

//是否登陸
function is_login_other($userid,$username,$rnd){
	global $empire,$public_r,$dbtbpre;
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$rnd=RepPostVar($rnd);
	if(!$userid||!$username||!$rnd)
	{
		printerror("NotLogin","index.php");
	}
	$adminstyle=1;
	//db
	$adminr=$empire->fetch1("select userid,groupid,classid,userprikey from {$dbtbpre}enewsuser where userid='$userid' and username='".$username."' and rnd='".$rnd."' and checked=0 limit 1");
	if(!$adminr['userid'])
	{
		printerror("NotLogin","index.php");
	}
	$ur[userid]=$userid;
	$ur[username]=$username;
	$ur[rnd]=$rnd;
	$ur[groupid]=$adminr[groupid];
	$ur[adminstyleid]=(int)$adminstyle;
	$ur[classid]=$adminr[classid];
	return $ur;
}

//設置加密驗證
function DoECreateOtherRnd($userid,$username,$rnd,$ckoi=0){
	global $ecms_config;
	$ip=$ecms_config['esafe']['ckhloginip']==0?'127.0.0.1':egetip();
	$otherinfo=$ckoi==1?DoECkOtherInfo():'empire.cms';
	$r['otherrndtime']=time();
	$r['otherrndtwo']=make_password(12);
	$r['otherrndpass']=md5(md5($rnd.'-empirecms.2002!check.other-'.$ecms_config['cks']['ckrndtwo']).'-'.$ip.'empire.cms'.'-'.$otherinfo.'-'.$userid.'-'.$r['otherrndtime'].'-'.$username.'db.check.rnd'.'-'.$rnd.'-phome'.$r['otherrndtwo']);
	return $r;
}

//驗證加密驗證
function DoECheckOtherRnd($userid,$username,$rnd,$loginecmsotherpass,$loginecmsothertime,$loginecmsotherrndtwo,$ckoi=0,$outtime=1800){
	global $ecms_config;
	if(!$loginecmsotherpass||!$loginecmsothertime)
	{
		printerror("NotLogin","index.php");
	}
	$loginecmsothertime=(int)$loginecmsothertime;
	$todaytime=time();
	if($loginecmsothertime+$outtime<$todaytime||$loginecmsothertime>$todaytime)
	{
		printerror("NotLogin","index.php");
	}
	$ip=$ecms_config['esafe']['ckhloginip']==0?'127.0.0.1':egetip();
	$otherinfo=$ckoi==1?DoECkOtherInfo():'empire.cms';
	$ecmsckpass=md5(md5($rnd.'-empirecms.2002!check.other-'.$ecms_config['cks']['ckrndtwo']).'-'.$ip.'empire.cms'.'-'.$otherinfo.'-'.$userid.'-'.$loginecmsothertime.'-'.$username.'db.check.rnd'.'-'.$rnd.'-phome'.$loginecmsotherrndtwo);
	if($ecmsckpass<>$loginecmsotherpass)
	{
		printerror("NotLogin","index.php");
	}
}

//返回SESSION驗證
function DoESessionRnd(){
	global $ecms_config;
	if(empty($ecms_config['esafe']['ckhsession']))
	{
		return '';
	}
	$sessval=make_password(27);
	$_SESSION['ecmsckhspass']=$sessval;
	return $sessval;
}

function ReESessionRnd(){
	global $ecms_config;
	if(empty($ecms_config['esafe']['ckhsession']))
	{
		return '';
	}
	return $_SESSION['ecmsckhspass'];
}

function DelESessionRnd(){
	global $ecms_config;
	if(empty($ecms_config['esafe']['ckhsession']))
	{
		return '';
	}
	unset($_SESSION['ecmsckhspass']);
	session_destroy();
}

//返回其他驗證信息
function DoECkOtherInfo(){
	$otherinfo=$_SERVER['HTTP_USER_AGENT'];
	return $otherinfo;
}

//COOKIE加密
function DoECookieRnd($userid,$username,$rnd,$userkey,$dbdata,$groupid,$adminstyle,$truelogintime){
	global $ecms_config;
	$ip=$ecms_config['esafe']['ckhloginip']==0?'127.0.0.1':egetip();
	$otherinfo=DoECkOtherInfo();
	//session
	$sessval=DoESessionRnd();
	$ecmsckpass=md5(md5($rnd.$ecms_config['esafe']['ecookiernd']).'-'.$ip.'-'.$otherinfo.'-'.$userid.'-'.$username.'-'.$dbdata.$rnd.$groupid.'-'.$adminstyle.$sessval);
	esetcookie("loginecmsckpass",$ecmsckpass,0,1);
	DoECreatFileRnd($userid,$username,$rnd,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval);
	DoECreatAndAuthRnd($userid,$username,$rnd,$userkey,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval);
}

function DoChECookieRnd($userid,$username,$rnd,$userkey,$dbdata,$groupid,$adminstyle,$truelogintime){
	global $ecms_config;
	$ip=$ecms_config['esafe']['ckhloginip']==0?'127.0.0.1':egetip();
	$otherinfo=DoECkOtherInfo();
	$sessval=ReESessionRnd();
	$ecmsckpass=md5(md5($rnd.$ecms_config['esafe']['ecookiernd']).'-'.$ip.'-'.$otherinfo.'-'.$userid.'-'.$username.'-'.$dbdata.$rnd.$groupid.'-'.$adminstyle.$sessval);
	if($ecmsckpass<>getcvar('loginecmsckpass',1))
	{
		printerror("NotLogin","index.php");
	}
	DoECheckFileRnd($userid,$username,$rnd,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval);
	//ehash
	hCheckEcmsEHash();
}

function DelECookieRnd(){
	esetcookie("loginecmsckpass",'',0,1);
}

//文件認證

//返回用戶緩存信息
function hReturnAdminLoginFileInfo($userid,$username,$rnd,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval){
	$adminlogins='';
	$ernd=make_password(27);
	$erndtwo=make_password(20);
	$erndadd=make_password(32);
	$ehash=make_password(20);
	$ehashname='ehash_'.make_password(4);
	$rhash=make_password(12);
	$rhashname='rhash_'.make_password(4);
	$userid=(int)$userid;
	$dbdata=(int)$dbdata;
	$defhash=$ehashname.'='.$ehash.'||'.$rhashname.'='.$rhash.'||'.$ernd.'||'.$erndtwo;
	define('EmpireCMSHDefHash',$defhash);
	$adminlogins.="<?php
\$ecms_adminloginr=array();
\$ecms_adminloginr=Array('userid'=>'".$userid."',
'ernd'=>'".addslashes($ernd)."',
'erndtwo'=>'".addslashes($erndtwo)."',
'erndadd'=>'".addslashes($erndadd)."',
'ehash'=>'".addslashes($ehash)."',
'ehashname'=>'".addslashes($ehashname)."',
'rhash'=>'".addslashes($rhash)."',
'rhashname'=>'".addslashes($rhashname)."',
'edbdata'=>'".$dbdata."');
?>";
	esetcookie("loginecmsckfrnd",$ernd,0,1);
	return $adminlogins;
}

//文件緩存內容驗證
function hCheckAadminLoginFileInfo(){
	global $ecms_config,$ecms_adminloginr;
	if(!$ecms_adminloginr['ernd']||$ecms_adminloginr['ernd']<>getcvar('loginecmsckfrnd',1))
	{
		printerror("NotLogin","index.php");
	}
}

function DelECookieAdminLoginFileInfo(){
	esetcookie("loginecmsckfrnd",'',0,1);
}

//來源Hash驗證
//驗證rhash內容
function hCheckEcmsRHash(){
	global $ecms_config,$ecms_adminloginr;
	if($ecms_config['esafe']['ckhash']==2)//關閉HASH模式
	{
		return '';
	}
	//刺蝟模式
	$rhashvar=$ecms_adminloginr['rhashname'];
	$rhash=$ecms_adminloginr['rhash'];
	if($_GET[$rhashvar]&&$_GET[$rhashvar]==$rhash)
	{
	}
	elseif($_POST[$rhashvar]&&$_POST[$rhashvar]==$rhash)
	{
	}
	else
	{
		printerror("FailHash","history.go(-1)");
	}
}

//驗證ehash內容
function hCheckEcmsEHash(){
	global $ecms_config,$ecms_adminloginr;
	if($ecms_config['esafe']['ckhash']==2)//關閉HASH模式
	{
		return '';
	}
	if($ecms_config['esafe']['ckhash']==1)//刺蝟模式
	{
		return '';
	}
	//金剛模式
	$ehashvar=$ecms_adminloginr['ehashname'];
	$ehash=$ecms_adminloginr['ehash'];
	if($_GET[$ehashvar]&&$_GET[$ehashvar]==$ehash)
	{
	}
	elseif($_POST[$ehashvar]&&$_POST[$ehashvar]==$ehash)
	{
	}
	else
	{
		printerror("FailHash","history.go(-1)");
	}
}

//返回hash變量
function hReturnEcmsHashStrAll(){
	global $ecms_config,$ecms_adminloginr;
	//刺蝟模式
	$rhashvar=$ecms_adminloginr['rhashname'];
	$rhash=$ecms_adminloginr['rhash'];
	//金剛模式
	$ehashvar=$ecms_adminloginr['ehashname'];
	$ehash=$ecms_adminloginr['ehash'];
	//返回
	if($ecms_config['esafe']['ckhash']==2)//關閉HASH模式
	{
		$hashhrefr['href']='';
		$hashhrefr['whhref']='';
		$hashhrefr['form']='';
		$hashhrefr['ehref']='';
		$hashhrefr['whehref']='';
		$hashhrefr['eform']='';
	}
	elseif($ecms_config['esafe']['ckhash']==1)//刺蝟模式
	{
		$hashhrefr['href']='&'.$rhashvar.'='.$rhash;
		$hashhrefr['whhref']='?'.$rhashvar.'='.$rhash;
		$hashhrefr['form']='<input type=hidden name='.$rhashvar.' value='.$rhash.'>';
		$hashhrefr['ehref']='';
		$hashhrefr['whehref']='';
		$hashhrefr['eform']='';
	}
	else//金剛模式
	{
		$hashhrefr['href']='&'.$ehashvar.'='.$ehash.'&'.$rhashvar.'='.$rhash;
		$hashhrefr['whhref']='?'.$ehashvar.'='.$ehash.'&'.$rhashvar.'='.$rhash;
		$hashhrefr['form']='<input type=hidden name='.$ehashvar.' value='.$ehash.'><input type=hidden name='.$rhashvar.' value='.$rhash.'>';
		$hashhrefr['ehref']='&'.$ehashvar.'='.$ehash;
		$hashhrefr['whehref']='?'.$ehashvar.'='.$ehash;
		$hashhrefr['eform']='<input type=hidden name='.$ehashvar.' value='.$ehash.'>';
	}
	return $hashhrefr;
}

//返回hash變量(href)
function hReturnEcmsHashStrHref($wh=0){
	$hashhrefr=hReturnEcmsHashStrAll();
	return $wh?$hashhrefr['whhref']:$hashhrefr['href'];
}

//返回hash變量(ehref)
function hReturnEcmsHashStrHref2($wh=0){
	$hashhrefr=hReturnEcmsHashStrAll();
	return $wh?$hashhrefr['whehref']:$hashhrefr['ehref'];
}

//返回hash變量(form)
function hReturnEcmsHashStrForm($wh=0){
	$hashhrefr=hReturnEcmsHashStrAll();
	return $hashhrefr['form'];
}

//返回hash變量(eform)
function hReturnEcmsHashStrForm2($wh=0){
	$hashhrefr=hReturnEcmsHashStrAll();
	return $hashhrefr['eform'];
}

//返回hash變量(def)
function hReturnEcmsHashStrDef($wh=0,$ecms='ehref'){
	if($ecms_config['esafe']['ckhash']==2)//關閉HASH模式
	{
		return '';
	}
	$str='';
	$fh=$wh?'?':'&';
	$hr=explode('||',EmpireCMSHDefHash);
	if($ecms=='href')
	{
		if($ecms_config['esafe']['ckhash']==1)//刺蝟模式
		{
			$str=$fh.$hr[1];
		}
		else
		{
			$str=$fh.$hr[0].'&'.$hr[1];
		}
	}
	elseif($ecms=='ehref')
	{
		$str=$fh.$hr[0];
	}
	return $str;
}

//返回hash變量(erndtwo)
function hReturnEcmsHashErndDef($ecms=0){
	$str='';
	$hr=explode('||',EmpireCMSHDefHash);
	if($ecms==0)
	{
		$str=$hr[2];
	}
	else
	{
		$str=$hr[3];
	}
	return $str;
}

//文件認證處理
function DoECreatFileRnd($userid,$username,$rnd,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval){
	global $ecms_config;
	$file=ECMS_PATH.'e/data/adminlogin/user'.$userid.'_'.md5(md5($username.'-empirecms!check.file'.$truelogintime.'-'.$rnd.$ecms_config['esafe']['ecookiernd']).'-'.$ip.'-'.$userid.'-'.$rnd.$adminstyle.'-'.$groupid.'-'.$dbdata.$sessval).'.php';
	$filetext=hReturnAdminLoginFileInfo($userid,$username,$rnd,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval);
	WriteFiletext_n($file,$filetext);
}

function DoECheckFileRnd($userid,$username,$rnd,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval){
	global $ecms_config,$ecms_adminloginr;
	$file=ECMS_PATH.'e/data/adminlogin/user'.$userid.'_'.md5(md5($username.'-empirecms!check.file'.$truelogintime.'-'.$rnd.$ecms_config['esafe']['ecookiernd']).'-'.$ip.'-'.$userid.'-'.$rnd.$adminstyle.'-'.$groupid.'-'.$dbdata.$sessval).'.php';
	if(!file_exists($file))
	{
		printerror('NotLogin','index.php');
	}
	include($file);
	hCheckAadminLoginFileInfo();
	/*
	$filetime=filemtime($file);
	if($filetime>$truelogintime)
	{
		printerror('NotLogin','index.php');
	}
	*/
}

function DoEDelFileRnd($userid){
	$path=ECMS_PATH.'e/data/adminlogin/';
	$hand=@opendir($path);
	while($file=@readdir($hand))
	{
		if($file=='.'||$file=='..')
		{
			continue;
		}
		if(strstr($file,'user'.$userid.'_'))
		{
			DelFiletext($path.$file);
		}
	}
}

//附加碼認證
function DoECreatAndAuthRnd($userid,$username,$rnd,$userkey,$dbdata,$groupid,$adminstyle,$truelogintime,$ip,$sessval){
	global $empire,$dbtbpre,$ecms_config;
	$andauth=md5(md5($rnd.'-'.$username.'-empirecms!check.andauth'.$truelogintime.'-'.$ecms_config['esafe']['ecookiernd'].$userkey).$sessval.'-'.$ip.'-'.$userid.$rnd.'-'.$adminstyle.'-'.$groupid.$username.'-'.$dbdata);
	DoEDelAndAuthRnd($userid);
	$empire->query("replace into {$dbtbpre}enewsuserloginck(userid,andauth) values('$userid','$andauth');");
}

function DoECheckAndAuthRnd($userid,$username,$rnd,$userkey,$dbdata,$groupid,$adminstyle,$truelogintime){
	global $empire,$dbtbpre,$ecms_config;
	$anduser_r=$empire->fetch1("select andauth from {$dbtbpre}enewsuserloginck where userid='$userid'");
	if(!$anduser_r['andauth'])
	{
		printerror('NotLogin','index.php');
	}	
	$ip=$ecms_config['esafe']['ckhloginip']==0?'127.0.0.1':egetip();
	//$otherinfo=DoECkOtherInfo();
	$sessval=ReESessionRnd();
	$ckandauth=md5(md5($rnd.'-'.$username.'-empirecms!check.andauth'.$truelogintime.'-'.$ecms_config['esafe']['ecookiernd'].$userkey).$sessval.'-'.$ip.'-'.$userid.$rnd.'-'.$adminstyle.'-'.$groupid.$username.'-'.$dbdata);
	if($anduser_r['andauth']<>$ckandauth)
	{
		printerror('NotLogin','index.php');
	}
}

function DoEDelAndAuthRnd($userid){
	global $empire,$dbtbpre;
	$empire->query("delete from {$dbtbpre}enewsuserloginck where userid='$userid'");
}

//寫入操作日誌
function insert_dolog($doing,$pubid=0){
	global $empire,$enews,$phome,$logininid,$loginin,$ecms_config,$dbtbpre;
	if($ecms_config['esafe']['thedolog'])
	{
		return "";
	}
	if(empty($doing))
	{$doing="---";}
	$doing=addslashes(stripSlashes($doing));
	//ip
	$logip=egetip();
	$ipport=egetipport();
	$logtime=date("Y-m-d H:i:s");
	if(empty($enews))
	{$enews=$phome;}
	$enews=RepPostVar($enews);
	$pubid=RepPostVar($pubid);
	$loginin=RepPostVar($loginin);
	$sql=$empire->query("insert into {$dbtbpre}enewsdolog(username,logip,logtime,enews,doing,pubid,ipport) values('$loginin','$logip','$logtime','$enews','$doing','$pubid','$ipport');");
}

//返回安全提問問題
function ReturnHLoginQuestionStr($userid,$username,$question,$answer){
	$pass=md5(md5('-#20empire27#-'.$question.'-empirecms-'.$userid.'-www.phome.net-'.$answer.'-wm-').'-dg2002-'.$answer.'-wm_chief-'.$userid.'-wangmeng-');
	return $pass;
}


//-------------- 遠程發佈區 ----------------------

//返回FTP目錄或文件絕對地址
function FtpRTruePath($ftppath,$path){
	$truepath=$ftppath.'/'.$path;
	return $truepath;
}

//目錄轉向
function FtpChPath($e,$r){
	$path=$r[ftppath].'/e/ftp';
	$e->fChdir($path);
	return '';
}

//上傳ftp目錄
function FtpTranPath($ftpid,$ldir,$hdir){
	$r=ReturnFtpInfo($ftpid);
	$e=new EmpireCMSFTP();
	$e->fconnect($r[ftphost],$r[ftpport],$r[ftpusername],$r[ftppassword],$r[ftppath],$r[ftpssl],$r[ftppasv],$r[ftpmode],$r[ftpouttime]);
	FtpChPath($e,$r);
    //上傳目錄
    $e->ftp_copy($ldir,$hdir);
    $e->fExit();
}

//刪除ftp目錄
function FtpDelPath($ftpid,$dir){
	$r=ReturnFtpInfo($ftpid);
	$e=new EmpireCMSFTP();
	$e->fconnect($r[ftphost],$r[ftpport],$r[ftpusername],$r[ftppassword],$r[ftppath],$r[ftpssl],$r[ftppasv],$r[ftpmode],$r[ftpouttime]);
	FtpChPath($e,$r);
    //刪除目錄
    $e->ftp_rmAll($dir);
    $e->fExit();
}

//刪除ftp文件
function FtpDelFile($ftpid,$fr){
	$r=ReturnFtpInfo($ftpid);
    $e=new EmpireCMSFTP();
	$e->fconnect($r[ftphost],$r[ftpport],$r[ftpusername],$r[ftppassword],$r[ftppath],$r[ftpssl],$r[ftppasv],$r[ftpmode],$r[ftpouttime]);
	FtpChPath($e,$r);
    //刪除文件
	$e->fMoreDelFile($fr);
    $e->fExit();
}

//上傳文件
function FtpTranFile($ftpid,$fr,$fr1){
	$r=ReturnFtpInfo($ftpid);
    $e=new EmpireCMSFTP();
	$e->fconnect($r[ftphost],$r[ftpport],$r[ftpusername],$r[ftppassword],$r[ftppath],$r[ftpssl],$r[ftppasv],$r[ftpmode],$r[ftpouttime]);
	FtpChPath($e,$r);
    //上傳文件
	$e->fMoreTranFile($fr1,$fr);
    $e->fExit();
}

//建立ftp目錄
function FtpMkdir($ftpid,$pr,$mod){
	$r=ReturnFtpInfo($ftpid);
	$e=new EmpireCMSFTP();
	$e->fconnect($r[ftphost],$r[ftpport],$r[ftpusername],$r[ftppassword],$r[ftppath],$r[ftpssl],$r[ftppasv],$r[ftpmode],$r[ftpouttime]);
	FtpChPath($e,$r);
	for($i=0;$i<count($pr);$i++)
	{
		if(stristr($pr[$i],ECMS_PATH))
		{
			$pr[$i]=FtpRTruePath($r[ftppath],str_replace(ECMS_PATH,'',$pr[$i]));
		}
		if(!$e->fChdir($pr[$i]))
		{
			$e->fMkdir($pr[$i]);
			if($mod)
			{
				$e->fChmoddir($mod,$pr[$i]);
			}
		}
	}
    $e->fExit();
}

//返回ftp信息
function ReturnFtpInfo($ftpid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}enewspublic limit 1");
	return $r;
}

//初使化發佈任務
function AddPostUrlData($postdata,$userid,$username){
	global $empire,$fun_r,$dbtbpre;
	$count=count($postdata);
	if(empty($count))
	{printerror("NotPostData","history.go(-1)");}
	//操作權限
	CheckLevel($userid,$username,$classid,"postdata");
	$e="!!!";
	$rnd=md5(uniqid(microtime()));
	for($i=0;$i<$count;$i++)
	{
		$r=explode($e,$postdata[$i]);
		$r[1]=(int)$r[1];
		$r[0]=AddAddsData($r[0]);
		$sql=$empire->query("insert into {$dbtbpre}enewspostdata(rnd,postdata,ispath) values('$rnd','$r[0]','$r[1]');");
    }
	$line=(int)$_POST['line'];
	if($line==0)
	{
		$line=10;
	}
	echo $fun_r[AddPostDataSuccess]."<script>self.location.href='enews.php?enews=PostUrlData&start=0&line=$line&rnd=$rnd".hReturnEcmsHashStrHref(0)."';</script>";
	exit();
}

//遠程發佈
function PostUrlData($start,$rnd,$userid,$username){
	global $empire,$fun_r,$dbtbpre,$incftp;
	$rnd=RepPostVar($rnd);
	if(empty($rnd))
	{printerror("FailCX","history.go(-1)");}
	//操作權限
	CheckLevel($userid,$username,$classid,"postdata");
	//鏈接FTP
	if(empty($incftp))
	{
		@include(ECMS_PATH."e/class/ftp.php");
	}
	$pr=ReturnFtpInfo($ftpid);
	$e=new EmpireCMSFTP();
	$e->fconnect($pr[ftphost],$pr[ftpport],$pr[ftpusername],$pr[ftppassword],$pr[ftppath],$pr[ftpssl],$pr[ftppasv],$pr[ftpmode],$pr[ftpouttime]);
	FtpChPath($e,$pr);

	$line=(int)$_GET['line'];//每10個為一組
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select postid,postdata,ispath from {$dbtbpre}enewspostdata where rnd='$rnd' and postid>$start order by postid limit ".$line);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[postid];
		//文件
		if($r[ispath])
		{
			$fr=explode(",",$r[postdata]);
			for($i=0;$i<count($fr);$i++)
			{
				$e->fTranFile(FtpRTruePath($pr[ftppath],$fr[$i]),ECMS_PATH.$fr[$i]);
			}
		}
		//目錄
		else
		{
			$e->ftp_copy(ECMS_PATH.$r[postdata],FtpRTruePath($pr[ftppath],$r[postdata]));
		}
	}
	$e->fExit();
	if(empty($b))
	{
		$sql=$empire->query("delete from {$dbtbpre}enewspostdata where rnd='$rnd'");
		//操作日誌
		insert_dolog("");
		printerror("PostDataSuccess","PostUrlData.php".hReturnEcmsHashStrHref2(1));
	}
	echo $fun_r[OnePostDataSuccess]."<script>self.location.href='enews.php?enews=PostUrlData&start=$newstart&line=$line&rnd=$rnd".hReturnEcmsHashStrHref(0)."';</script>";
	exit();
}

//測試FTP
function CheckFtpConnect($ftphost,$ftpport,$ftpusername,$ftppassword,$ftppath,$ftpssl=0,$pasv=0,$tranmode=0,$timeout=0){
	if(!defined('InEmpireCMSFtp'))
	{
		include(ECMS_PATH.'e/class/ftp.php');
	}
	$eftp=new EmpireCMSFTP();
	$result=$eftp->fconnect($ftphost,$ftpport,$ftpusername,$ftppassword,$ftppath,$ftpssl,$pasv,$tranmode,$timeout,1);
	if($result=='HostFail')
	{
		printerror('FtpHostFail','',8);
	}
	elseif($result=='UserFail')
	{
		printerror('FtpUserFail','',8);
	}
	elseif($result=='PathFail')
	{
		printerror('FtpPathFail','',8);
	}
	else
	{
		printerror('FtpConnectSuccess','',8);
	}
	$eftp->fExit();
}


//-------------- 模型區 ----------------------

//複製表
function CopyEcmsTb($otb,$tb){
	global $empire;
	$usql=$empire->query("SET SQL_QUOTE_SHOW_CREATE=1;");//設置引號
	$r=$empire->fetch1("SHOW CREATE TABLE `$otb`;");//數據表結構
	$create=str_replace("\"","\\\"",$r[1]);
	$create=str_replace($otb,$tb,$create);
	$empire->query($create);
}

//建立數據表
function SetCreateTable($sql,$dbcharset) {
	global $ecms_config;
	$type=strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
	$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
		($ecms_config['db']['dbver']>='4.1'&&$dbcharset ? " ENGINE=$type DEFAULT CHARSET=$dbcharset" : " TYPE=$type");
}

//組合存文本
function TogSaveTxtF($ecms=0){
	global $empire,$dbtbpre;
	$savesql=$empire->query("select f,tbname from {$dbtbpre}enewsf where savetxt=1");
	$savef=',';
	while($saver=$empire->fetch($savesql))
	{
		$savef.=$saver[tbname].'.'.$saver[f].',';
	}
	$empire->query("update {$dbtbpre}enewspublic set savetxtf='$savef' limit 1");
	if($ecms==0)
	{
		GetConfig();
	}
}

//返回附件字段
function ReturnMFileF($enter,$tbname,$tid,$fform="file"){
	global $empire;
	$record="<!--record-->";
	$field="<!--field--->";
	if($tid)
	{
		$a=" and tid='$tid'";
	}
	$f=",";
	$sql=$empire->query("select f from ".$tbname." where fform='$fform'".$a);
	while($r=$empire->fetch($sql))
	{
		if(strstr($enter,$field.$r[f].$record))
		{
			$f.=$r[f].",";
		}
	}
	return $f;
}

//執行字段函數
function DoFFun($mid,$f,$value,$isadd=1,$isq=0){
	global $empire,$dbtbpre,$emod_r;
	if($isq==1)//前台
	{
		$dofun=$isadd==1?$emod_r[$mid]['qadddofunf']:$emod_r[$mid]['qeditdofunf'];
	}
	else//後台
	{
		$dofun=$isadd==1?$emod_r[$mid]['adddofunf']:$emod_r[$mid]['editdofunf'];
	}
	if(!strstr($dofun,'||'.$f.'!#!'))
	{
		return $value;
	}
	$dfr=explode('||'.$f.'!#!',$dofun);
	$dfr1=explode('||',$dfr[1]);
	$r=explode('##',$dfr1[0]);
	if($r[0])
	{
		$fun=$r[0];
		$value=$fun($mid,$f,$isadd,$isq,$value,$r[1]);
	}
	return $value;
}

//取得字段名
function ChGetFname($mid,$f){
	global $empire,$dbtbpre,$emod_r;
	$r=$empire->fetch1("select fname from {$dbtbpre}enewsf where f='$f' and tid='".$emod_r[$mid]['tid']."' limit 1");
	return $r[fname]?$r[fname]:$f;
}

//驗證必填項
function ChMustAddF($mid,$f,$value){
	global $empire,$dbtbpre,$emod_r;
	if(strstr($emod_r[$mid]['mustqenterf'],','.$f.','))
	{
		if(!trim($value))
		{
			$GLOBALS['msgmustf']=ChGetFname($mid,$f);
			printerror("EmptyMustF","history.go(-1)");
		}
	}
}

//驗證唯一項
function ChIsOnlyAddF($mid,$id,$f,$value,$isq=0){
	global $empire,$dbtbpre,$emod_r;
	$mid=(int)$mid;
	if(strstr($emod_r[$mid]['onlyf'],','.$f.','))
	{
		$id=(int)$id;
		$and='';
		if($id)
		{
			$and=" and id<>$id";
		}
		$value=RepPostStr($value);
		//已審核
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_".$emod_r[$mid]['tbname']." where ".$f."='".addslashes($value)."'".$and." limit 1");
		//未審核
		if(empty($num))
		{
			$num=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_".$emod_r[$mid]['tbname']."_check where ".$f."='".addslashes($value)."'".$and." limit 1");
		}
		if($num)
		{
			$GLOBALS['msgisonlyf']=ChGetFname($mid,$f);
			if($isq==1)
			{
				printerror("ReIsOnlyF","history.go(-1)",1);
			}
			else
			{
				printerror("ReIsOnlyF","history.go(-1)");
			}
		}
	}
}

//數據同步
function SameDataAddF($id,$classid,$mid,$f,$value){
	global $empire,$public_r,$dbtbpre,$emod_r,$emod_pubr;
	if(strstr($emod_pubr['linkfields'],','.$emod_r[$mid]['tbname'].'.'.$f.'|'))
	{
		$index_r=$empire->fetch1("select checked from {$dbtbpre}ecms_".$emod_r[$mid]['tbname']."_index where id='$id' limit 1");
		//返回表
		$infotb=empty($index_r['checked'])?$dbtbpre.'ecms_'.$emod_r[$mid]['tbname'].'_check':$dbtbpre.'ecms_'.$emod_r[$mid]['tbname'];
		$value=addslashes($value);
		$r=$empire->fetch1("select ".$f." from ".$infotb." where id='$id' limit 1");
		if($r[$f]<>$value)
		{
			$tbr=ReturnSameDataTb($emod_r[$mid]['tbname'],$f);
			$ltbname=$tbr[0];
			$lf=$tbr[1];
			if($ltbname&&$lf)
			{
				$empire->query("update {$dbtbpre}ecms_".$ltbname." set ".$lf."='$value' where ".$lf."='$r[$f]'");
			}
		}
	}
}

//返回數據同步表與字段名
function ReturnSameDataTb($tbname,$f){
	global $public_r,$emod_pubr;
	$expr=explode(','.$tbname.'.'.$f.'|',$emod_pubr['linkfields']);
	$expr1=explode('|',$expr[0]);
	$count=count($expr1)-1;
	$tbr=explode('.',$expr1[$count]);
	return $tbr;
}

//自定義字段返回模板字段處理
function doReturnAddTempf($temp){
	$record="<!--record-->";
	$field="<!--field--->";
	$r=explode($record,$temp);
	$count=count($r);
	$str=',';
	for($i=0;$i<$count-1;$i++)
	{
		$r1=explode($field,$r[$i]);
		$str.=$r1[1].",";
	}
	if($str==',,')
	{
		$str=',';
	}
	return $str;
}

//處理多值字段
function DoFieldMoreValue($f,$add,$ecms=0){
	$rvarname=$f.'_1';
	$count=count($add[$rvarname]);
	if(empty($count))
	{
		return '';
	}
	//變量
	$mvnumvar='mvnum_'.$f;
	$mvmustvar='mvmust_'.$f;
	$mvidvarname=$f.'_mvid';
	$mvid=$add[$mvidvarname];
	$mvdelidvarname=$f.'_mvdelid';
	$mvdelid=$add[$mvdelidvarname];
	//處理
	$mvnum=(int)$add[$mvnumvar];
	if($mvnum<1||$mvnum>50)
	{
		$mvnum=1;
	}
	$mvmust=(int)$add[$mvmustvar];
	if($mvmust<1)
	{
		$mvmust=0;
	}
	if($ecms==1)
	{
		$delcount=count($mvdelid);
	}
	$rexp='||||||';
	$fexp='::::::';
	$rstr='';
	$rstrexp='';
	for($i=0;$i<$count;$i++)
	{
		//刪除
		if($ecms==1)
		{
			$del=0;
			for($d=0;$d<$delcount;$d++)
			{
				if($mvdelid[$d]==$mvid[$i])
				{
					$del=1;
					break;
				}
			}
			if($del)
			{continue;}
		}
		$fstr='';
		$fstrexp='';
		$fstrempty=0;
		for($j=0;$j<$mvnum;$j++)
		{
			$k=$j+1;
			$fsvarname=$f.'_'.$k;
			$fsval=$add[$fsvarname][$i];
			$fsval=str_replace($rexp,'',$fsval);
			$fsval=str_replace($fexp,'',$fsval);
			if(CheckValEmpty($fsval))
			{
				if($k==$mvmust)
				{
					break;
					$fstrempty=1;
				}
			}
			$fstr.=$fstrexp.$fsval;
			$fstrexp=$fexp;
		}
		if(empty($fstr)||$fstrempty)
		{
			continue;
		}
		$rstr.=$rstrexp.$fstr;
		$rstrexp=$rexp;
	}
	return $rstr;
}

//返回多值字段數據
function ReturnMoreValueAddF($add,$r,$mid,$f,$ecms=0){
	global $public_r,$emod_r;
	$val=$r;
	if(strstr($emod_r[$mid]['morevaluef'],'|'.$f.','))
	{
		$varname=$f.'_1';
		if(is_array($add[$varname]))
		{
			$val=DoFieldMoreValue($f,$add,$ecms);
		}
		else
		{
			$val='';
		}
	}
	return $val;
}

//組合復選框數據
function ReturnCheckboxAddF($r,$mid,$f){
	global $public_r,$emod_r;
	$val=$r;
	if(is_array($r)&&strstr($emod_r[$mid]['checkboxf'],','.$f.','))
	{
		$val='';
		$count=count($r);
		for($i=0;$i<$count;$i++)
		{
			$val.=$r[$i].'|';
		}
		if($val)
		{
			$val='|'.$val;
		}
	}
	return $val;
}

//返回自定義字段
function ReturnAddF($add,$modid,$userid,$username,$do=0,$rdata=0,$ch=0){
	global $empire,$public_r,$dbtbpre,$emod_r;
	if($do==0||$do==1)
	{
		//導入gd處理文件
		if($add['mark']||$add['getfirsttitlespic']||$add['mcreatespic'])
		{
			include_once(ECMS_PATH.'e/class/gd.php');
		}
	}
	$ret_r['tb']=$emod_r[$modid]['deftb'];
	$pagef=$emod_r[$modid]['pagef'];
	$r=explode(',',$emod_r[$modid][enter]);
	$count=count($r)-1;
	if(empty($do))//增加
	{
		//數據庫操作
		for($i=1;$i<$count;$i++)
		{
			$f=$r[$i];
			if($f=='special.field'||!strstr($emod_r[$modid]['canaddf'],','.$f.','))
			{
				continue;
			}
			$add[$f]=ReturnCheckboxAddF($add[$f],$modid,$f);//復選框
			$add[$f]=ReturnMoreValueAddF($add,$add[$f],$modid,$f,$do);//多值
			$value=RepPhpAspJspcodeText($add[$f]);
			if($f=='newstime')//時間
			{
				$value=empty($value)?time():to_time($value);
			}
			elseif($f=="morepic")//圖片集
			{
				$value=ReturnMorepicpath($add['msmallpic'],$add['mbigpic'],$add['mpicname'],$add['mdelpicid'],$add['mpicid'],$add,$add['mpicurl_qz'],0,0,$public_r['filedeftb']);
			}
			elseif($f=="downpath")//下載地址
			{
				$value=ReturnDownpath($add['downname'],$add['downpath'],$add['delpathid'],$add['pathid'],$add['downuser'],$add['fen'],$add['thedownqz'],$add,$add['foruser'],$add['downurl_qz'],0);
			}
			elseif($f=="onlinepath")//在線地址
			{
				$value=ReturnDownpath($add['odownname'],$add['odownpath'],$add['odelpathid'],$add['opathid'],$add['odownuser'],$add['ofen'],$add['othedownqz'],$add,$add['oforuser'],$add['onlineurl_qz'],0);
			}
			elseif($f=="smalltext")//簡介
			{
				if(!trim($value))
				{
					$value=SubSmalltextVal($add[newstext],$public_r[smalltextlen]);//截取新聞內容
				}
			}
			elseif($f=='infoip')//ip
			{
				$value=egetip();
			}
			elseif($f=='infoipport')//ip端口
			{
				$value=egetipport();
			}
			elseif($f=='infozm')//字母
			{
				$value=$value?$value:GetInfoZm($add[title]);
			}
			//處理函數
			$value=DoFFun($modid,$f,$value,1,0);
			$modispagef=$pagef==$f?1:0;
			$value=RepTempvarPostStrT($value,$modispagef);
			if($pagef!=$f)
			{
				$value=RepTempvarPostStr($value);
			}
			//檢測必填字段
			if($ch==1&&empty($add['titleurl']))
			{
				ChMustAddF($modid,$f,$value);
				ChIsOnlyAddF($modid,0,$f,$value,0);//唯一值
			}
			$value=hRepPostStr2($value);
			//編輯器
			if($f=="newstext")
			{
				//遠程保存
				$value=addslashes(CopyImg(stripSlashes($value),$add[copyimg],$add[copyflash],$add[classid],$add[qz_url],$username,$add['id'],$add['filepass'],$add['mark'],$public_r['filedeftb']));
				//替換關鍵字和字符
				$value=DoReplaceKeyAndWord($value,$add['dokey'],$add['classid']);
				//自動分頁
				if($add[autopage]&&!strstr($value,"[!--empirenews.page--]"))
				{
					if(empty($add[autosize]))
					{$add[autosize]=5000;}
					$value=AutoDoPage($value,$add[autosize]);
				}
			}
			//存文本
			if($emod_r[$modid]['savetxtf']&&$f==$emod_r[$modid]['savetxtf'])
			{
				//建立目錄
				$thetxtfile=GetFileMd5();
				$truevalue=MkDirTxtFile(date("Y/md"),$thetxtfile);
				//寫放文件
				EditTxtFieldText($truevalue,$value);
				$value=$truevalue;
			}
			if(strstr($emod_r[$modid]['tbdataf'],','.$f.','))//副表
			{
				$ret_r['datafields'].=",".$f;
				$ret_r['datavalues'].=",'".addslashes($value)."'";
			}
			else//主表
			{
				$ret_r['fields'].=",".$f;
				$ret_r['values'].=",'".addslashes($value)."'";
			}
		}
	}
	elseif($do==1)//修改
	{
		//數據庫操作
		for($i=1;$i<$count;$i++)
		{
			$f=$r[$i];
			if($f=="special.field"||!strstr($emod_r[$modid]['caneditf'],','.$f.','))
			{
				continue;
			}
			$add[$f]=ReturnCheckboxAddF($add[$f],$modid,$f);//復選框
			$add[$f]=ReturnMoreValueAddF($add,$add[$f],$modid,$f,$do);//多值
			$value=RepPhpAspJspcodeText($add[$f]);
			if($f=='newstime')//時間
			{
				$value=empty($value)?time():to_time($value);
			}
			elseif($f=="morepic")//圖片集
			{
				$value=ReturnMorepicpath($add['msmallpic'],$add['mbigpic'],$add['mpicname'],$add['mdelpicid'],$add['mpicid'],$add,$add['mpicurl_qz'],1,0,intval($add['fstb']));
			}
			elseif($f=="downpath")//下載地址
			{
				$value=ReturnDownpath($add['downname'],$add['downpath'],$add['delpathid'],$add['pathid'],$add['downuser'],$add['fen'],$add['thedownqz'],$add,$add['foruser'],$add['downurl_qz'],1);
			}
			elseif($f=="onlinepath")//在線地址
			{
				$value=ReturnDownpath($add['odownname'],$add['odownpath'],$add['odelpathid'],$add['opathid'],$add['odownuser'],$add['ofen'],$add['othedownqz'],$add,$add['oforuser'],$add['onlineurl_qz'],1);
			}
			elseif($f=="smalltext")//簡介
			{
				if(!trim($value))
				{
					$value=SubSmalltextVal($add[newstext],$public_r[smalltextlen]);//截取新聞內容
				}
			}
			elseif($f=='infozm')//字母
			{
				$value=$value?$value:GetInfoZm($add[title]);
			}
			//處理函數
			$value=DoFFun($modid,$f,$value,0,0);
			$modispagef=$pagef==$f?1:0;
			$value=RepTempvarPostStrT($value,$modispagef);
			if($pagef!=$f)
			{
				$value=RepTempvarPostStr($value);
			}
			//檢測必填字段
			if($ch==1&&empty($add['titleurl']))
			{
				ChMustAddF($modid,$f,$value);
				ChIsOnlyAddF($modid,$add[id],$f,$value,0);//唯一值
			}
			$value=hRepPostStr2($value);
			//數據同步
			SameDataAddF($add[id],$add[classid],$modid,$f,$value);
			//內容
			if($f=="newstext")
			{
				//遠程保存
				$value=addslashes(CopyImg(stripSlashes($value),$add[copyimg],$add[copyflash],$add[classid],$add[qz_url],$username,$add['id'],$add['filepass'],$add['mark'],intval($add['fstb'])));
				//自動分頁
				if($add[autopage]&&!strstr($value,"[!--empirenews.page--]"))
				{
					if(empty($add[autosize]))
					{$add[autosize]=5000;}
					$value=AutoDoPage($value,$add[autosize]);
				}
			}
			//存文本
			if($emod_r[$modid]['savetxtf']&&$f==$emod_r[$modid]['savetxtf'])
			{
				//建立目錄
				$newstexttxt_r=explode("/",$add[newstext_url]);
				$thetxtfile=$newstexttxt_r[2];
				$truevalue=MkDirTxtFile($newstexttxt_r[0]."/".$newstexttxt_r[1],$thetxtfile);
				//寫放文件
				EditTxtFieldText($truevalue,$value);
				$value=$truevalue;
			}
			if(strstr($emod_r[$modid]['tbdataf'],','.$f.','))//副表
			{
				$ret_r['datafields'].=",".$f;
				$ret_r['datavalues'].=",".$f."='".addslashes($value)."'";
			}
			else//主表
			{
				$ret_r['fields'].=",".$f;
				$ret_r['values'].=",".$f."='".addslashes($value)."'";
			}
		}
	}
	elseif($do==8)//同步修改
	{
		//數據庫操作
		for($i=1;$i<$count;$i++)
		{
			$f=$r[$i];
			if($f=='special.field')
			{
				continue;
			}
			$value=$add[$f];
			//存文本
			if($emod_r[$modid]['savetxtf']&&$f==$emod_r[$modid]['savetxtf'])
			{
				//建立目錄
				$newstexttxt_r=explode("/",$add[newstext_url]);
				$thetxtfile=$newstexttxt_r[2];
				$truevalue=MkDirTxtFile($newstexttxt_r[0]."/".$newstexttxt_r[1],$thetxtfile);
				//寫放文件
				EditTxtFieldText($truevalue,$value);
				$value=$truevalue;
			}
			if(strstr($emod_r[$modid]['tbdataf'],','.$f.','))//副表
			{
				$ret_r['datafields'].=",".$f;
				$ret_r['datavalues'].=",".$f."='".StripAddsData($value)."'";
			}
			else//主表
			{
				$ret_r['fields'].=",".$f;
				$ret_r['values'].=",".$f."='".StripAddsData($value)."'";
			}
		}
	}
	elseif($do==9)//複製
	{
		//數據庫操作
		for($i=1;$i<$count;$i++)
		{
			$f=$r[$i];
			if($f=='special.field')
			{
				continue;
			}
			$value=$add[$f];
			//存文本
			if($emod_r[$modid]['savetxtf']&&$f==$emod_r[$modid]['savetxtf'])
			{
				//建立目錄
				$thetxtfile=GetFileMd5();
				$truevalue=MkDirTxtFile(date("Y/md"),$thetxtfile);
				//寫放文件
				EditTxtFieldText($truevalue,$value);
				$value=$truevalue;
			}
			if(strstr($emod_r[$modid]['tbdataf'],','.$f.','))//副表
			{
				$ret_r['datafields'].=",".$f;
				$ret_r['datavalues'].=",'".StripAddsData($value)."'";
			}
			else//主表
			{
				$ret_r['fields'].=",".$f;
				$ret_r['values'].=",'".StripAddsData($value)."'";
			}
		}
	}
	elseif($do==10)//歸檔
	{
		//數據庫操作
		for($i=1;$i<$count;$i++)
		{
			$f=$r[$i];
			if($f=='special.field')
			{
				continue;
			}
			$value=$add[$f];
			if(strstr($emod_r[$modid]['tbdataf'],','.$f.','))//副表
			{
				$ret_r['datafields'].=",".$f;
				$ret_r['datavalues'].=",'".StripAddsData($value)."'";
			}
			else//主表
			{
				$ret_r['fields'].=",".$f;
				$ret_r['values'].=",'".StripAddsData($value)."'";
			}
		}
	}
	return $ret_r;
}

//返回採集字段
function ReturnAddCj($add,$cj,$do=0){
	global $empire;
	$record="<!--record-->";
	$field="<!--field--->";
	$record_r=explode($record,$cj);
	for($i=0;$i<count($record_r)-1;$i++)
	{
		$field_r=explode($field,$record_r[$i]);
		//增加
		if(empty($do))
		{
			$f1="zz_".$field_r[1];
			$f2="z_".$field_r[1];
			$f3="qz_".$field_r[1];
			$f4="save_".$field_r[1];
			$ret_r[0].=",".$f1.",".$f2.",".$f3.",".$f4;
			$ret_r[1].=",'".eaddslashes2($add[$f1])."','".eaddslashes2($add[$f2])."','".eaddslashes2($add[$f3])."','".$add[$f4]."'";
	    }
		//修改
		else
		{
			$f1="zz_".$field_r[1];
			$f2="z_".$field_r[1];
			$f3="qz_".$field_r[1];
			$f4="save_".$field_r[1];
			$ret_r[0].=",".$f1."='".eaddslashes2($add[$f1])."',".$f2."='".eaddslashes2($add[$f2])."',".$f3."='".eaddslashes2($add[$f3])."',".$f4."='".$add[$f4]."'";
	    }
    }
	return $ret_r;
}

//圖片集上傳圖片
function SaveMorepicFile($varname,$msavepic,$i,$picurl,$picname,$classid,$id,$add,$modtype=0,$fstb=1){
	global $public_r,$empire,$loginin,$dbtbpre,$ecms_config;
	if($varname=="mbigpfile")
	{
		$addname="[b]";
	}
	$type=1;
	$r[url]=$picurl;
	//上傳
	if($_FILES[$varname]['name'][$i])
	{
		//取得文件類型
		$filetype=GetFiletype($_FILES[$varname]['name'][$i]);
		//允許上傳類型
		if(CheckSaveTranFiletype($filetype))
		{
			return $r;
		}
		if(!strstr($public_r['filetype'],"|".$filetype."|"))
		{
			return $r;
		}
		//圖片文件
		if(!strstr($ecms_config['sets']['tranpicturetype'],','.$filetype.','))
		{
			return $r;
		}
		//文件大小
		if($_FILES[$varname]['size'][$i]>$public_r['filesize']*1024)
		{
			return $r;
		}
		//上傳
		$r=DoTranFile($_FILES[$varname]['tmp_name'][$i],$_FILES[$varname]['name'][$i],$_FILES[$varname]['type'][$i],$_FILES[$varname]['size'][$i],$classid);
		//------------------------寫入數據庫
		$r[filesize]=(int)$r[filesize];
		$classid=(int)$classid;
		if(empty($picname))
		{
			$picname=$r[filename];
		}
		else
		{
			$picname=$addname.$picname;
		}
		$picname=RepPostStr($picname);
		$id=(int)$id;
		$cjid=0;
		if(!$id)
		{
			$cjid=(int)$add['filepass'];
		}
		eInsertFileTable($r[filename],$r[filesize],$r[filepath],$loginin,$classid,$picname,$type,$id,$cjid,$public_r[fpath],0,0,$fstb);
		return $r;
	}
	//遠程保存
	else
	{
		if(empty($msavepic))
		{
			return $r;
		}
		if(empty($picurl))
		{
			return $r;
		}
		//----------------取得文件類型
		$filetype=GetFiletype($picurl);
		//允許上傳類型
		if(CheckSaveTranFiletype($filetype))
		{
			return $r;
		}
		if(!strstr($public_r['filetype'],"|".$filetype."|"))
		{
			return $r;
		}
		//圖片文件
		if(!strstr($ecms_config['sets']['tranpicturetype'],','.$filetype.','))
		{
			return $r;
		}
		//保存
		$r=DoTranUrl($picurl,$classid);
		if($r['tran'])
		{
			//記錄數據庫
			//變量處理
			$r[filesize]=(int)$r[filesize];
			$classid=(int)$classid;
			$r[type]=(int)$r[type];
			if(empty($picname))
			{
				$picname=$r[filename];
			}
			else
			{
				$picname=$addname.$picname;
			}
			$picname=RepPostStr($picname);
			$id=(int)$id;
			$cjid=0;
			if(!$id)
			{
				$cjid=(int)$add['filepass'];
			}

			eInsertFileTable($r[filename],$r[filesize],$r[filepath],$loginin,$classid,$picname,$type,$id,$cjid,$public_r[fpath],0,0,$fstb);
			return $r;
		}
		return $r;
	}
}

//入庫時遠程保存
function LoadInSaveMorepicFile($morepic,$msavepic,$classid,$id,$add,$modtype=0,$fstb=1){
	if(empty($morepic)||!$msavepic)
	{
		return $morepic;
	}
	$f_exp="::::::";
	$r_exp="\r\n";
	$returnstr="";
	$r=explode($r_exp,$morepic);
	$countr=count($r);
	for($i=0;$i<$countr;$i++)
	{
		$r1=explode($f_exp,$r[$i]);
		//小圖
		$smpr=SaveMorepicFile("msmallpfile",$msavepic,0,$r1[0],$r1[2],$classid,$id,$add,$modtype,$fstb);
		$spic=$smpr[url];
		//大圖
		if($r1[0]!=$r1[1])
		{
			$bmpr=SaveMorepicFile("mbigpfile",$msavepic,0,$r1[1],$r1[2],$classid,$id,$add,$modtype,$fstb);
			$bpic=$bmpr[url];
		}
		else
		{
			$bpic=$spic;
		}
		if($spic)
		{
			$returnstr.=$spic.$f_exp.$bpic.$f_exp.$r1[2].$r_exp;
		}
	}
	//去掉最後的字符
	$returnstr=substr($returnstr,0,strlen($returnstr)-2);
	return $returnstr;
}

//---------圖片地址組合
function ReturnMorepicpath($smallpic,$bigpic,$picname,$delpicid,$picid,$add,$downurl,$down=0,$modtype=0,$fstb=1){
	global $loginin,$logininid;
	$f_exp="::::::";
	$r_exp="\r\n";
	$returnstr="";
    $downurl=str_replace($f_exp,"",$downurl);
	$downurl=str_replace($r_exp,"",$downurl);
	$add[msavepic]=(int)$add[msavepic];
	$add[classid]=(int)$add[classid];
	$add[id]=(int)$add[id];
	$add[filepass]=(int)$add[filepass];
	$modtype=(int)$modtype;
	$fstb=(int)$fstb;
	$logininid=(int)$logininid;
	$loginin=RepPostVar($loginin);
	//增加信息
	if(empty($down))
	{
		for($i=0;$i<count($smallpic);$i++)
		{
			$name=str_replace($f_exp,"",$picname[$i]);
			$name=str_replace($r_exp,"",$name);
			//替換非法字符
			$spic=str_replace($f_exp,"",$smallpic[$i]);
			$spic=str_replace($r_exp,"",$spic);
			$spic=$spic?$downurl.$spic:'';
			//保存圖片
			$smpr=SaveMorepicFile("msmallpfile",$add[msavepic],$i,$spic,$name,$add[classid],$add[id],$add,$modtype,$fstb);
			$spic=$smpr[url];

			//如沒有大圖的話跟縮略圖一樣
			if(empty($bigpic[$i])&&!$_FILES['mbigpfile']['name'][$i])
			{
				$bpic=$spic;
			}
			else
			{
				$bpic=str_replace($f_exp,"",$bigpic[$i]);
				$bpic=str_replace($r_exp,"",$bpic);
				$bpic=$bpic?$downurl.$bpic:'';
				//保存圖片
				$bmpr=SaveMorepicFile("mbigpfile",$add[msavepic],$i,$bpic,$name,$add[classid],$add[id],$add,$modtype,$fstb);
				$bpic=$bmpr[url];
				//生成縮圖
				if(empty($spic)&&$bpic&&$bmpr[tran]&&$add[mcreatespic])
				{
					$picno='[b]'.($name?$name:$bmpr[filename]);
					$sfiler=GetMySmallImg($add['classid'],$picno,$bmpr[insertfile],$bmpr[filepath],$bmpr[yname],$add[mcreatespicwidth],$add[mcreatespicheight],$bmpr[name],$add['filepass'],$add['filepass'],$logininid,$loginin,$modtype,$fstb);
					$spic=str_replace("/".$bmpr[filename],"/small".$bmpr[insertfile].$sfiler['filetype'],$bmpr[url]);
				}
			}
			if(empty($spic))
			{
				$spic=$bpic;
			}
			if($spic)
			{$returnstr.=$spic.$f_exp.$bpic.$f_exp.$name.$r_exp;}
		}
	}
	//修改信息
	else
	{
		for($i=0;$i<count($smallpic);$i++)
		{
			//刪除地址
			$del=0;
			for($j=0;$j<count($delpicid);$j++)
			{
				if($delpicid[$j]==$picid[$i])
				{$del=1;}
			}
			if($del)
			{continue;}
			$name=str_replace($f_exp,"",$picname[$i]);
			$name=str_replace($r_exp,"",$name);
			//替換非法字符
			$spic=str_replace($f_exp,"",$smallpic[$i]);
			$spic=str_replace($r_exp,"",$spic);
			$spic=$spic?$downurl.$spic:'';
			//保存圖片
			$smpr=SaveMorepicFile("msmallpfile",$add[msavepic],$i,$spic,$name,$add[classid],$add[id],$add,$modtype,$fstb);
			$spic=$smpr[url];

			//如沒有大圖的話跟縮略圖一樣
			if(empty($bigpic[$i])&&!$_FILES['mbigpfile']['name'][$i])
			{
				$bpic=$spic;
			}
			else
			{
				$bpic=str_replace($f_exp,"",$bigpic[$i]);
				$bpic=str_replace($r_exp,"",$bpic);
				$bpic=$bpic?$downurl.$bpic:'';
				//保存圖片
				$bmpr=SaveMorepicFile("mbigpfile",$add[msavepic],$i,$bpic,$name,$add[classid],$add[id],$add,$modtype,$fstb);
				$bpic=$bmpr[url];
				//生成縮圖
				if(empty($spic)&&$bpic&&$bmpr[tran]&&$add[mcreatespic])
				{
					$picno='[b]'.($name?$name:$bmpr[filename]);
					$sfiler=GetMySmallImg($add['classid'],$picno,$bmpr[insertfile],$bmpr[filepath],$bmpr[yname],$add[mcreatespicwidth],$add[mcreatespicheight],$bmpr[name],$add['filepass'],$add['filepass'],$logininid,$loginin,$modtype,$fstb);
					$spic=str_replace("/".$bmpr[filename],"/small".$bmpr[insertfile].$sfiler['filetype'],$bmpr[url]);
				}
			}
			if(empty($spic))
			{
				$spic=$bpic;
			}
			if($spic)
			{$returnstr.=$spic.$f_exp.$bpic.$f_exp.$name.$r_exp;}
		}
	}
	//去掉最後的字符
	$returnstr=substr($returnstr,0,strlen($returnstr)-2);
	return $returnstr;
}

//---------下載地址組合
function ReturnDownpath($downname,$downpath,$delpathid,$pathid,$downuser,$fen,$thedownqz,$add,$foruser,$downurl,$down=0){
	$f_exp="::::::";
	$r_exp="\r\n";
	$returnstr="";
    $downurl=str_replace($f_exp,"",$downurl);
	$downurl=str_replace($r_exp,"",$downurl);
	//增加軟件
	if(empty($down))
	{
		for($i=0;$i<count($downname);$i++)
		{
			//替換非法字符
			$name=str_replace($f_exp,"",$downname[$i]);
			$name=str_replace($r_exp,"",$name);
			$path=str_replace($f_exp,"",$downpath[$i]);
			$path=str_replace($r_exp,"",$path);
			//批量更換權限
			if($add[doforuser])
			{
				if(empty($foruser))
				{
					$foruser=0;
			    }
				$fuser=$foruser;
		    }
			else
			{
				if(empty($downuser[$i]))
				{
					$fuser=0;
			    }
				else
				{
					$fuser=$downuser[$i];
				}
		    }
			//批量更新點數
			if($add[dodownfen])
			{
				if(empty($add[downfen]))
				{
					$add[downfen]=0;
				}
				$ffen=$add[downfen];
			}
			else
			{
				if(empty($fen[$i]))
				{
					$ffen=0;
				}
				else
				{
					$ffen=$fen[$i];
				}
			}
			$downqz=$thedownqz[$i];
			if($path&&$name)
			{$returnstr.=$name.$f_exp.$downurl.$path.$f_exp.$fuser.$f_exp.$ffen.$f_exp.$downqz.$r_exp;}
		}
	}
	//修改軟件
	else
	{
		for($i=0;$i<count($downname);$i++)
		{
			//刪除下載地址
			$del=0;
			for($j=0;$j<count($delpathid);$j++)
			{
				if($delpathid[$j]==$pathid[$i])
				{$del=1;}
			}
			if($del)
			{continue;}
			//替換非法字符
			$name=str_replace($f_exp,"",$downname[$i]);
			$name=str_replace($r_exp,"",$name);
			$path=str_replace($f_exp,"",$downpath[$i]);
			$path=str_replace($r_exp,"",$path);
			//批量更換權限
			if($add[doforuser])
			{
				if(empty($foruser))
				{
					$foruser=0;
			    }
				$fuser=$foruser;
		    }
			else
			{
				if(empty($downuser[$i]))
				{
					$fuser=0;
			    }
				else
				{
					$fuser=$downuser[$i];
				}
		    }
			//批量更新點數
			if($add[dodownfen])
			{
				if(empty($add[downfen]))
				{
					$add[downfen]=0;
				}
				$ffen=$add[downfen];
			}
			else
			{
				if(empty($fen[$i]))
				{
					$ffen=0;
				}
				else
				{
					$ffen=$fen[$i];
				}
			}
			$downqz=$thedownqz[$i];
			if($path&&$name)
			{$returnstr.=$name.$f_exp.$downurl.$path.$f_exp.$fuser.$f_exp.$ffen.$f_exp.$downqz.$r_exp;}
		}
	}
	//去掉最後的字符
	$returnstr=substr($returnstr,0,strlen($returnstr)-2);
	return $returnstr;
}

//-------------- 緩存區 ----------------------

//一級欄目導航
function GetClassNavCache($line,$navfh){
	global $empire,$dbtbpre,$public_r;
	$limit='';
	if($line)
	{
		$limit=" limit ".$line;
	}
	$navs='';
	$fh='';
	$sql=$empire->query("select classid,classname,wburl,listdt,classurl,classpath from {$dbtbpre}enewsclass where bclassid=0 and showclass=0 order by myorder,classid".$limit);
	while($r=$empire->fetch($sql))
	{
		$classurl=sys_ReturnBqClassUrl($r);
		if($navs)
		{
			$fh=$navfh;
		}
		$navs.=$fh."<a href=\"".$classurl."\">".$r[classname]."</a>";
	}
	return $navs;
}

//生成配置文件
function GetConfig($domod=0){
	$filename=eReturnTrueEcmsPath()."e/config/config.php";
	$exp='//-------EmpireCMS.Public.Cache-------';
	$text=ReadFiletext($filename);
	$r=explode($exp,$text);
	if($r[0]=='')
	{
		return false;
	}
	$r[1]=GetPubCache();
	if($domod==1)
	{
		$r[2]=GetModCache();
	}
	$setting=$r[0].$exp.$r[1].$exp.$r[2].$exp.$r[3];
	WriteFiletext_n($filename,$setting);
}

//更新公共緩存
function GetPubCache(){
	global $empire,$dbtbpre;
	//擴展變量
	$pvstring='';
	$pvsql=$empire->query("select myvar,varvalue from {$dbtbpre}enewspubvar where tocache=1");
	while($pvr=$empire->fetch($pvsql))
	{
		$pvstring.=",'add_".$pvr['myvar']."'=>'".addslashes($pvr['varvalue'])."'";
	}
	//公共變量
	$r=$empire->fetch1("select * from {$dbtbpre}enewspublic limit 1");
	$tr=$empire->fetch1("select downsofttemp,onlinemovietemp,listpagetemp from ".GetTemptb("enewspubtemp")." limit 1");
	$fsr=$empire->fetch1("select purl from {$dbtbpre}enewspostserver where ptype=1 limit 1");
	$plr=$empire->fetch1("select * from {$dbtbpre}enewspl_set limit 1");
	$memberconnectnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsmember_connect_app where isclose=0");
	$GLOBALS['public_r']['newsurl']=$r['newsurl'];
	$r[filedeftb]=1;
	$plr[pldeftb]=1;
	$classnavs=GetClassNavCache($r[classnavline],$r[classnavfh]);
	$checkdorepstr=ReturnCheckDoRep();
	$setting.="

//------------e_public
\$public_r=array('sitename'=>'".addslashes($r[sitename])."',
'newsurl'=>'".addslashes($r[newsurl])."',
'filetype'=>'".addslashes($r[filetype])."',
'filesize'=>".$r[filesize].",
'relistnum'=>".$r[relistnum].",
'renewsnum'=>".$r[renewsnum].",
'min_keyboard'=>".$r[min_keyboard].",
'max_keyboard'=>".$r[max_keyboard].",
'search_num'=>".$r[search_num].",
'search_pagenum'=>".$r[search_pagenum].",
'newslink'=>".$r[newslink].",
'checked'=>".$r[checked].",
'searchtime'=>".$r[searchtime].",
'loginnum'=>".$r[loginnum].",
'logintime'=>".$r[logintime].",
'addnews_ok'=>".$r[addnews_ok].",
'register_ok'=>".$r[register_ok].",
'indextype'=>'".addslashes($r[indextype])."',
'goodlencord'=>".$r[goodlencord].",
'goodtype'=>'".addslashes($r[goodtype])."',
'searchtype'=>'".addslashes($r[searchtype])."',
'exittime'=>".$r[exittime].",
'smalltextlen'=>".$r[smalltextlen].",
'defaultgroupid'=>".$r[defaultgroupid].",
'fileurl'=>'".addslashes($r[fileurl])."',
'install'=>".$r[install].",
'phpmode'=>".$r[phpmode].",
'dorepnum'=>".$r[dorepnum].",
'loadtempnum'=>".$r[loadtempnum].",
'bakdbpath'=>'".addslashes($r[bakdbpath])."',
'bakdbzip'=>'".addslashes($r[bakdbzip])."',
'downpass'=>'".addslashes($r[downpass])."',
'filechmod'=>".$r[filechmod].",
'loginkey_ok'=>".$r[loginkey_ok].",
'tbname'=>'".addslashes($r[tbname])."',
'limittype'=>".$r[limittype].",
'redodown'=>".$r[redodown].",
'downsofttemp'=>'".addslashes(stripSlashes($tr[downsofttemp]))."',
'onlinemovietemp'=>'".addslashes(stripSlashes($tr[onlinemovietemp]))."',
'lctime'=>".$r[lctime].",
'candocode'=>".$r[candocode].",
'opennotcj'=>".$r[opennotcj].",
'listpagetemp'=>'".addslashes(stripSlashes($tr[listpagetemp]))."',
'reuserpagenum'=>".$r[reuserpagenum].",
'revotejsnum'=>".$r[revotejsnum].",
'readjsnum'=>".$r[readjsnum].",
'qaddtran'=>".$r[qaddtran].",
'qaddtransize'=>".$r[qaddtransize].",
'ebakthisdb'=>".$r[ebakthisdb].",
'delnewsnum'=>".$r[delnewsnum].",
'markpos'=>".$r[markpos].",
'markimg'=>'".addslashes($r[markimg])."',
'marktext'=>'".addslashes($r[marktext])."',
'markfontsize'=>'".addslashes($r[markfontsize])."',
'markfontcolor'=>'".addslashes($r[markfontcolor])."',
'markfont'=>'".addslashes($r[markfont])."',
'adminloginkey'=>".$r[adminloginkey].",
'php_outtime'=>".$r[php_outtime].",
'listpagefun'=>'".addslashes($r[listpagefun])."',
'textpagefun'=>'".addslashes($r[textpagefun])."',
'adfile'=>'".addslashes($r[adfile])."',
'notsaveurl'=>'".addslashes($r[notsaveurl])."',
'rssnum'=>".$r[rssnum].",
'rsssub'=>".$r[rsssub].",
'savetxtf'=>'".addslashes($r[savetxtf])."',
'dorepdlevelnum'=>".$r[dorepdlevelnum].",
'listpagelistfun'=>'".addslashes($r[listpagelistfun])."',
'listpagelistnum'=>".$r[listpagelistnum].",
'infolinknum'=>".$r[infolinknum].",
'searchgroupid'=>".$r[searchgroupid].",
'opencopytext'=>".$r[opencopytext].",
'reuserjsnum'=>".$r[reuserjsnum].",
'reuserlistnum'=>".$r[reuserlistnum].",
'opentitleurl'=>".$r[opentitleurl].",
'searchtempvar'=>".$r[searchtempvar].",
'showinfolevel'=>".$r[showinfolevel].",
'navfh'=>'".addslashes($r[navfh])."',
'spicwidth'=>".$r[spicwidth].",
'spicheight'=>".$r[spicheight].",
'spickill'=>".$r[spickill].",
'jpgquality'=>".$r[jpgquality].",
'markpct'=>".$r[markpct].",
'redoview'=>".$r[redoview].",
'reggetfen'=>".$r[reggetfen].",
'regbooktime'=>".$r[regbooktime].",
'revotetime'=>".$r[revotetime].",
'fpath'=>".$r[fpath].",
'filepath'=>'".addslashes($r[filepath])."',
'nreclass'=>'".addslashes($r[nreclass])."',
'nreinfo'=>'".addslashes($r[nreinfo])."',
'nrejs'=>'".addslashes($r[nrejs])."',
'nottobq'=>'".addslashes($r[nottobq])."',
'defspacestyleid'=>".$r[defspacestyleid].",
'canposturl'=>'".addslashes($r[canposturl])."',
'openspace'=>".$r[openspace].",
'defadminstyle'=>".$r[defadminstyle].",
'realltime'=>".$r[realltime].",
'closeip'=>'".addslashes($r[closeip])."',
'openip'=>'".addslashes($r[openip])."',
'hopenip'=>'".addslashes($r[hopenip])."',
'textpagelistnum'=>".$r[textpagelistnum].",
'memberlistlevel'=>".$r[memberlistlevel].",
'ebakcanlistdb'=>".$r[ebakcanlistdb].",
'keytog'=>".$r[keytog].",
'keytime'=>".$r[keytime].",
'keyrnd'=>'".addslashes($r[keyrnd])."',
'checkdorepstr'=>'".addslashes($checkdorepstr)."',
'regkey_ok'=>".$r[regkey_ok].",
'opengetdown'=>".$r[opengetdown].",
'gbkey_ok'=>".$r[gbkey_ok].",
'fbkey_ok'=>".$r[fbkey_ok].",
'newaddinfotime'=>".$r[newaddinfotime].",
'classnavs'=>'".addslashes($classnavs)."',
'adminstyle'=>'".addslashes($r[adminstyle])."',
'docnewsnum'=>".$r[docnewsnum].",
'openschall'=>".$r[openschall].",
'schallfield'=>".$r[schallfield].",
'schallminlen'=>".$r[schallminlen].",
'schallmaxlen'=>".$r[schallmaxlen].",
'schallnum'=>".$r[schallnum].",
'schallpagenum'=>".$r[schallpagenum].",
'dtcanbq'=>".$r[dtcanbq].",
'dtcachetime'=>".$r[dtcachetime].",
'repkeynum'=>".$r[repkeynum].",
'regacttype'=>".$r[regacttype].",
'opengetpass'=>".$r[opengetpass].",
'hlistinfonum'=>".$r[hlistinfonum].",
'qlistinfonum'=>".$r[qlistinfonum].",
'dtncanbq'=>".$r[dtncanbq].",
'dtncachetime'=>".$r[dtncachetime].",
'readdinfotime'=>".$r[readdinfotime].",
'qeditinfotime'=>".$r[qeditinfotime].",
'onclicktype'=>".$r[onclicktype].",
'onclickfilesize'=>".$r[onclickfilesize].",
'onclickfiletime'=>".$r[onclickfiletime].",
'schalltime'=>".$r[schalltime].",
'defprinttempid'=>".$r[defprinttempid].",
'opentags'=>".$r[opentags].",
'tagstempid'=>".$r[tagstempid].",
'usetags'=>'".addslashes($r[usetags])."',
'chtags'=>'".addslashes($r[chtags])."',
'tagslistnum'=>".$r[tagslistnum].",
'closeqdt'=>".$r[closeqdt].",
'settop'=>".$r[settop].",
'qlistinfomod'=>".$r[qlistinfomod].",
'gb_num'=>".$r[gb_num].",
'member_num'=>".$r[member_num].",
'space_num'=>".$r[space_num].",
'infolday'=>".$r[infolday].",
'filelday'=>".$r[filelday].",
'dorepkey'=>".$r[dorepkey].",
'dorepword'=>".$r[dorepword].",
'onclickrnd'=>'".addslashes($r[onclickrnd])."',
'indexpagedt'=>".$r[indexpagedt].",
'keybgcolor'=>'".addslashes($r[keybgcolor])."',
'keyfontcolor'=>'".addslashes($r[keyfontcolor])."',
'keydistcolor'=>'".addslashes($r[keydistcolor])."',
'indexpageid'=>".$r[indexpageid].",
'closeqdtmsg'=>'".addslashes($r[closeqdtmsg])."',
'openfileserver'=>".$r[openfileserver].",
'fs_purl'=>'".addslashes($fsr[purl])."',
'closemods'=>'".addslashes($r[closemods])."',
'fieldandtop'=>".$r[fieldandtop].",
'fieldandclosetb'=>'".addslashes($r[fieldandclosetb])."',
'filedatatbs'=>'".addslashes($r[filedatatbs])."',
'filedeftb'=>".$r[filedeftb].",
'pldeftb'=>".$plr[pldeftb].",
'plurl'=>'".addslashes($plr[plurl])."',
'plkey_ok'=>".$plr[plkey_ok].",
'plface'=>'".addslashes($plr[plface])."',
'plf'=>'".addslashes($plr[plf])."',
'pldatatbs'=>'".addslashes($plr[pldatatbs])."',
'defpltempid'=>".$plr[defpltempid].",
'pl_num'=>".$plr[pl_num].",
'plgroupid'=>".$plr[plgroupid].",
'closelisttemp'=>'".addslashes($r[closelisttemp])."',
'chclasscolor'=>'".addslashes($r[chclasscolor])."',
'timeclose'=>'".addslashes($r[timeclose])."',
'timeclosedo'=>'".addslashes($r[timeclosedo])."',
'ipaddinfonum'=>".$r[ipaddinfonum].",
'ipaddinfotime'=>".$r[ipaddinfotime].",
'rewriteinfo'=>'".addslashes($r[rewriteinfo])."',
'rewriteclass'=>'".addslashes($r[rewriteclass])."',
'rewriteinfotype'=>'".addslashes($r[rewriteinfotype])."',
'rewritetags'=>'".addslashes($r[rewritetags])."',
'rewritepl'=>'".addslashes($r[rewritepl])."',
'memberconnectnum'=>".$memberconnectnum.",
'closehmenu'=>'".addslashes($r[closehmenu])."',
'indexaddpage'=>".$r[indexaddpage].",
'modmemberedittran'=>".$r[modmemberedittran].",
'modinfoedittran'=>".$r[modinfoedittran].",
'deftempid'=>".$r[deftempid].$pvstring.");
//------------e_public
".GetMoreportCache()."

";
	return $setting;
}

//更新模型緩存
function GetModCache(){
	global $empire,$dbtbpre;
	//數據表
	$tablesql=$empire->query("select tbname,deftb,yhid,mid,intb from {$dbtbpre}enewstable");
	while($tabler=$empire->fetch($tablesql))
	{
		$tables.="\$etable_r['".$tabler[tbname]."']=Array('deftb'=>'".addslashes($tabler[deftb])."',
'yhid'=>".$tabler[yhid].",
'intb'=>".$tabler[intb].",
'mid'=>".$tabler[mid].");
";
	}
	//系統模型
	$alllinkfields='|';//關聯同步
	$modsql=$empire->query("select * from {$dbtbpre}enewsmod");
	while($mr=$empire->fetch($modsql))
	{
		$listtempf=doReturnAddTempf($mr['listtempvar']);//列表模板
		$texttempf=doReturnAddTempf($mr['tempvar']);//內容模板
		$enter=doReturnAddTempf($mr['enter']);//錄入項
		$qenter=doReturnAddTempf($mr['qenter']);//投稿項
		$cj=doReturnAddTempf($mr['cj']);//採集項
		//表字段
		$mainf=',';//主表字段
		$dataf=',';//副表字段
		$tobrf=',';//回車字段
		$dohtmlf=',';//html字段
		$savetxtf='';//存文本字段
		$pagef='';//分頁字段
		$smalltextf=',';//簡介字段
		$checkboxf=',';//復選框字段
		$filef=',';//附件字段
		$imgf=',';//圖片字段
		$flashf=',';//FLASH字段
		$onlyf=',';//唯一字段
		$linkfields='|';//關聯同步
		$morevaluef='|';//多值字段
		$editorf=',';//編輯器字段
		$ubbeditorf=',';//UBB編輯器字段
		$adddofunf='||';//增加處理函數
		$editdofunf='||';//修改處理函數
		$qadddofunf='||';//投稿增加處理函數
		$qeditdofunf='||';//投稿修改處理函數
		$fsql=$empire->query("select * from {$dbtbpre}enewsf where tid='$mr[tid]'");
		while($fr=$empire->fetch($fsql))
		{
			if($fr['tbdataf'])
			{
				$dataf.=$fr['f'].',';
			}
			elseif($fr['f']!='special.field')
			{
				$mainf.=$fr['f'].',';
			}
			if($fr['tobr'])
			{
				$tobrf.=$fr['f'].',';
			}
			if($fr['dohtml'])
			{
				$dohtmlf.=$fr['f'].',';
			}
			if($fr['savetxt'])
			{
				$savetxtf=$fr['f'];
			}
			if($fr['ispage'])
			{
				$pagef=$fr['f'];
			}
			if($fr['issmalltext'])
			{
				$smalltextf.=$fr['f'].',';
			}
			if($fr['fform']=='checkbox')
			{
				$checkboxf.=$fr['f'].',';
			}
			if($fr['fform']=='file')
			{
				$filef.=$fr['f'].',';
			}
			if($fr['fform']=='img')
			{
				$imgf.=$fr['f'].',';
			}
			if($fr['fform']=='flash')
			{
				$flashf.=$fr['f'].',';
			}
			if($fr['isonly'])
			{
				$onlyf.=$fr['f'].',';
			}
			if(($fr['fform']=='linkfield'||$fr['fform']=='linkfieldselect')&&$fr['samedata']&&$fr['linkfieldval'])
			{
				$linkfields.=$fr[f].','.$fr[linkfieldtb].'.'.$fr[linkfieldval].'|';
				$alllinkfields.=$fr[tbname].'.'.$fr[f].','.$fr[linkfieldtb].'.'.$fr[linkfieldval].'|';
			}
			if($fr['fform']=='morevaluefield')
			{
				$morevaluef.=$fr[f].','.$fr[fmvnum].'|';
			}
			if($fr['fform']=='editor')
			{
				$editorf.=$fr['f'].',';
			}
			if($fr['fform']=='ubbeditor')
			{
				$ubbeditorf.=$fr['f'].',';
			}
			if($fr['adddofun'])
			{
				$adddofunf.=$fr[f].'!#!'.$fr[adddofun].'||';
			}
			if($fr['editdofun'])
			{
				$editdofunf.=$fr[f].'!#!'.$fr[editdofun].'||';
			}
			if($fr['qadddofun'])
			{
				$qadddofunf.=$fr[f].'!#!'.$fr[qadddofun].'||';
			}
			if($fr['qeditdofun'])
			{
				$qeditdofunf.=$fr[f].'!#!'.$fr[qeditdofun].'||';
			}
		}
		//表數據
		$tr=$empire->fetch1("select * from {$dbtbpre}enewstable where tid='$mr[tid]'");
		//字符
		$mods.="\$emod_r[".$mr[mid]."]=Array('mid'=>".$mr[mid].",
'mname'=>'".addslashes($mr[mname])."',
'qmname'=>'".addslashes($mr[qmname])."',
'defaulttb'=>".$tr[isdefault].",
'datatbs'=>'".addslashes($tr[datatbs])."',
'deftb'=>'".addslashes($tr[deftb])."',
'enter'=>'".addslashes($enter)."',
'qenter'=>'".addslashes($qenter)."',
'listtempf'=>'".addslashes($listtempf)."',
'tempf'=>'".addslashes($texttempf)."',
'mustqenterf'=>'".addslashes($mr[mustqenterf])."',
'listandf'=>'".addslashes($mr[listandf])."',
'setandf'=>".$mr[setandf].",
'searchvar'=>'".addslashes($mr[searchvar])."',
'cj'=>'".addslashes($cj)."',
'canaddf'=>'".addslashes($mr[canaddf])."',
'caneditf'=>'".addslashes($mr[caneditf])."',
'tbmainf'=>'".addslashes($mainf)."',
'tbdataf'=>'".addslashes($dataf)."',
'tobrf'=>'".addslashes($tobrf)."',
'dohtmlf'=>'".addslashes($dohtmlf)."',
'checkboxf'=>'".addslashes($checkboxf)."',
'savetxtf'=>'".addslashes($savetxtf)."',
'editorf'=>'".addslashes($editorf)."',
'ubbeditorf'=>'".addslashes($ubbeditorf)."',
'pagef'=>'".addslashes($pagef)."',
'smalltextf'=>'".addslashes($smalltextf)."',
'filef'=>'".addslashes($filef)."',
'imgf'=>'".addslashes($imgf)."',
'flashf'=>'".addslashes($flashf)."',
'linkfields'=>'".addslashes($linkfields)."',
'morevaluef'=>'".addslashes($morevaluef)."',
'onlyf'=>'".addslashes($onlyf)."',
'adddofunf'=>'".addslashes($adddofunf)."',
'editdofunf'=>'".addslashes($editdofunf)."',
'qadddofunf'=>'".addslashes($qadddofunf)."',
'qeditdofunf'=>'".addslashes($qeditdofunf)."',
'definfovoteid'=>".$mr[definfovoteid].",
'orderf'=>'".addslashes($mr[orderf])."',
'sonclass'=>'".addslashes($mr[sonclass])."',
'tid'=>".$mr[tid].",
'tbname'=>'".addslashes($mr[tbname])."');
";
	}
	$mods="

\$emod_pubr=Array('linkfields'=>'".addslashes($alllinkfields)."');

\$etable_r=array();
".$tables."

\$emod_r=array();
".$mods."

";
	return $mods;
}

//會員組緩存
function GetMemberLevel(){
	global $empire,$dbtbpre;
	$file=eReturnTrueEcmsPath()."e/data/dbcache/MemberLevel.php";
	$sql=$empire->query("select * from {$dbtbpre}enewsmembergroup order by groupid");
	while($r=$empire->fetch($sql))
	{
		$levels.="\$level_r[".$r[groupid]."]=Array('groupid'=>".$r[groupid].",
'groupname'=>'".addslashes($r[groupname])."',
'level'=>".$r[level].",
'checked'=>".$r[checked].",
'favanum'=>".$r[favanum].",
'daydown'=>".$r[daydown].",
'msglen'=>".$r[msglen].",
'regchecked'=>".$r[regchecked].",
'spacestyleid'=>".$r[spacestyleid].",
'dayaddinfo'=>".$r[dayaddinfo].",
'infochecked'=>".$r[infochecked].",
'plchecked'=>".$r[plchecked].",
'msgnum'=>".$r[msgnum].");
";
	}
	$levels="<?php
//level
\$level_r=array();
".$levels."
//level
?>";
	WriteFiletext_n($file,$levels);
}

//優化緩存
function GetYh(){
	global $empire,$dbtbpre;
	$sql=$empire->query("select * from {$dbtbpre}enewsyh");
	while($r=$empire->fetch($sql))
	{
		$yhs.="\$eyh_r[".$r[id]."]=Array('id'=>".$r[id].",
'hlist'=>".$r[hlist].",
'qlist'=>".$r[qlist].",
'bqnew'=>".$r[bqnew].",
'bqhot'=>".$r[bqhot].",
'bqpl'=>".$r[bqpl].",
'bqgood'=>".$r[bqgood].",
'bqfirst'=>".$r[bqfirst].",
'qmlist'=>".$r[qmlist].",
'dobq'=>".$r[dobq].",
'dojs'=>".$r[dojs].",
'dosbq'=>".$r[dosbq].",
'rehtml'=>".$r[rehtml].",
'otherlink'=>".$r[otherlink].",
'bqdown'=>".$r[bqdown].");
";
	}
	$yhs="
".$yhs."
";
	return $yhs;
}

//返回字段緩存
function ReturnEmptyFCache($f,$val,$isint=0){
	$str='';
	if($val)
	{
		if($isint)
		{
			$str="'".$f."'=>".$val.",";
		}
		else
		{
			$str="'".$f."'=>'".addslashes($val)."',";
		}
	}
	return $str;
}

//欄目緩存
function GetClass(){
	global $empire,$dbtbpre;
	$fileqz=eReturnTrueEcmsPath().'e/data/dbcache/';
	$filename=$fileqz.'class.php';
	$line=250;//每個文件存放欄目數
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsclass");
	$sql=$empire->query("select * from {$dbtbpre}enewsclass");
	$no=0;
	$p=0;
	$l="";
	$mod="";
	$modstr=",";
	while($r=$empire->fetch($sql))
	{
		$no++;
		$l="";
		if($r[wburl])//外部欄目
		{
			$l=",
'wburl'=>'".addslashes($r[wburl])."'";
		}
		elseif($r[islast])//終極欄目
		{
			//組合模型
			if(empty($mod[$r[modid]]))
			{
				$mod[$r[modid]]="|";
		    }
			$mod[$r[modid]].=$r[classid]."|";
			if(!strstr($modstr,",".$r[modid].","))
			{
				$modstr.=$r[modid].",";
			}
			$l=",
'lencord'=>".$r[lencord].",".ReturnEmptyFCache('link_num',$r[link_num],1)."
'newstempid'=>".$r[newstempid].",
'listtempid'=>".$r[listtempid].",".ReturnEmptyFCache('pltempid',$r[pltempid],1)."
".ReturnEmptyFCache('newspath',$r[newspath],0).ReturnEmptyFCache('filename',$r[filename],1)."
'filetype'=>'".addslashes($r[filetype])."',".ReturnEmptyFCache('ipath',$r[ipath],0)."
".ReturnEmptyFCache('openpl',$r[openpl],1).ReturnEmptyFCache('openadd',$r[openadd],1)."
".ReturnEmptyFCache('groupid',$r[groupid],0).ReturnEmptyFCache('filename_qz',$r[filename_qz],0)."
'checked'=>".$r[checked].",".ReturnEmptyFCache('wfid',$r[wfid],1)."
'bname'=>'".addslashes($r[bname])."',".ReturnEmptyFCache('cgtoinfo',$r[cgtoinfo],1)."
".ReturnEmptyFCache('showdt',$r[showdt],1).ReturnEmptyFCache('checkpl',$r[checkpl],1).ReturnEmptyFCache('keycid',$r[keycid],1)."
'reorder'=>'".addslashes($r[reorder])."'";
	    }
		else
		{
			//列表式
			if($r[islist]==1&&empty($r[islast]))
			{
				$l=",
'lencord'=>".$r[lencord].",
'reorder'=>'".addslashes($r[reorder])."',
'listtempid'=>".$r[listtempid];
			}
			elseif($r[listtempid])
			{
				$l=",
'lencord'=>".$r[lencord].",
'reorder'=>'".addslashes($r[reorder])."',
'listtempid'=>".$r[listtempid];
			}
		}
		if($r[dtlisttempid])
		{
			$l.=",
'dtlisttempid'=>".$r[dtlisttempid];
		}
		$classes.="\$class_r[".$r[classid]."]=Array('classid'=>".$r[classid].",
'bclassid'=>".$r[bclassid].",
'classname'=>'".addslashes($r[classname])."',
'sonclass'=>'".addslashes($r[sonclass])."',
'featherclass'=>'".addslashes($r[featherclass])."',
'islast'=>".$r[islast].",
'classpath'=>'".addslashes($r[classpath])."',".ReturnEmptyFCache('searchtempid',$r[searchtempid],1)."
'classtype'=>'".addslashes($r[classtype])."',".ReturnEmptyFCache('classurl',$r[classurl],0)."
".ReturnEmptyFCache('maxnum',$r[maxnum],1).ReturnEmptyFCache('yhid',$r[yhid],1)."
'down_num'=>".$r[down_num].",
'online_num'=>".$r[online_num].",
'islist'=>".$r[islist].",".ReturnEmptyFCache('listdt',$r[listdt],1)."
'tid'=>".$r[tid].",
'tbname'=>'".addslashes($r[tbname])."',
'modid'=>".$r[modid].$l.");
";
		if($no%$line==0||($num%$line<>0&&$num==$no))
		{
			$p++;
			$file="class".$p.".php";
			$include.="require(ECMS_PATH.'e/data/dbcache/".$file."');\r\n";
			$classes="<?php
".$classes."?>";
			WriteFiletext_n($fileqz.$file,$classes);
			$classes="";
        }
	}
	//-----專題緩存
	$zsql=$empire->query("select * from {$dbtbpre}enewszt");
	$zt="";
	$zfile=$fileqz."ztclass.php";
	while($zr=$empire->fetch($zsql))
	{
		$zt.="\$class_zr[".$zr[ztid]."]=Array('ztid'=>".$zr[ztid].",
'ztname'=>'".addslashes($zr[ztname])."',
'ztnum'=>".$zr[ztnum].",
'listtempid'=>".$zr[listtempid].",
'ztpath'=>'".addslashes($zr[ztpath])."',".ReturnEmptyFCache('pltempid',$r[pltempid],1)."
'zttype'=>'".addslashes($zr[zttype])."',".ReturnEmptyFCache('zturl',$zr[zturl],0)."
'islist'=>".$zr[islist].",".ReturnEmptyFCache('maxnum',$zr[maxnum],1)."
'reorder'=>'".addslashes($zr[reorder])."',".ReturnEmptyFCache('yhid',$zr[yhid],1)."
'tbname'=>'".addslashes($zr[tbname])."');
";
	}
	$zt="<?php
".$zt.GetTitleTypeCache()."?>";
	WriteFiletext_n($zfile,$zt);
	$include.="require(ECMS_PATH.'e/data/dbcache/ztclass.php');\r\n";
	$include="<?php
".AddCheckViewCode()."
\$class_r=array();
\$class_zr=array();
\$class_tr=array();
\$eyh_r=array();
".$include."
".GetYh()."
?>";
	WriteFiletext_n($filename,$include);
	//組合模型
	$er=explode(",",$modstr);
	for($i=1;$i<count($er)-1;$i++)
	{
		$mid=$er[$i];
		$usql=$empire->query("update {$dbtbpre}enewsmod set sonclass='".$mod[$mid]."' where mid='$mid'");
    }
}

//標題分類緩存
function GetTitleTypeCache(){
	global $empire,$dbtbpre;
	$sql=$empire->query("select typeid,tname,mid,yhid,tpath,tid,tbname,listdt,ttype from {$dbtbpre}enewsinfotype");
	while($r=$empire->fetch($sql))
	{
		$string.="\$class_tr[".$r[typeid]."]=Array('typeid'=>".$r[typeid].",
'tname'=>'".addslashes($r[tname])."',
'tpath'=>'".addslashes($r[tpath])."',
'ttype'=>'".addslashes($r[ttype])."',
'yhid'=>".$r[yhid].",
'listdt'=>".$r[listdt].",
'tbname'=>'".addslashes($r[tbname])."',
'mid'=>".$r[mid].");
";
	}
	return $string;
}

//全站搜索數據源緩存
function GetSearchAllTb(){
	global $empire,$dbtbpre;
	$file=eReturnTrueEcmsPath()."e/data/dbcache/SearchAllTb.php";
	$sql=$empire->query("select tbname,titlefield,smalltextfield from {$dbtbpre}enewssearchall_load");
	while($r=$empire->fetch($sql))
	{
		$tbs.="\$schalltb_r['".$r[tbname]."']=Array('tbname'=>'".addslashes($r[tbname])."',
'titlefield'=>'".addslashes($r[titlefield])."',
'smalltextfield'=>'".addslashes($r[smalltextfield])."');
";
	}
	$tbs="<?php
//tbs
\$schalltb_r=array();
".$tbs."
//tbs
?>";
	WriteFiletext_n($file,$tbs);
}


//-------------- moreport ----------------------

//網站訪問端緩存
function GetMoreportCache(){
	global $empire,$dbtbpre;
	$sql=$empire->query("select * from {$dbtbpre}enewsmoreport");
	$i=0;
	while($r=$empire->fetch($sql))
	{
		$i++;
		$moreports.="\$emoreport_r['".$r[pid]."']=Array('pid'=>'".$r[pid]."',
'pname'=>'".addslashes($r[pname])."',
'purl'=>'".addslashes($r[purl])."',
'ppath'=>'".addslashes($r[ppath])."',
'postpass'=>'".addslashes($r[postpass])."',
'postfile'=>'".addslashes($r[postfile])."',
'tempgid'=>'".addslashes($r[tempgid])."',
'isclose'=>'".addslashes($r[isclose])."',
'closeadd'=>'".addslashes($r[closeadd])."',
'mustdt'=>'".$r[mustdt]."');
";
	}
	if($i>1)
	{
		$moreports="
//moreports
\$emoreport_r=array();
".$moreports."
//moreports
";
	}
	else
	{
		$moreports="
//moreports
\$emoreport_r=array();
//moreports
";
	}
	return $moreports;
}

//開啟或關閉訪問端信息
function Moreport_UpdateIsclose(){
	global $empire,$dbtbpre,$public_r;
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsmoreport where isclose=0");
	if($num>1)
	{
		$purl=addslashes($public_r['newsurl']);
		$ppath=addslashes(ReturnAbsEcmsPath());
		$postpass=make_password(60);
		$empire->query("update {$dbtbpre}enewsmoreport set purl='$purl',ppath='$ppath',postpass='$postpass' where pid=1");
	}
	else
	{
		$postpass=make_password(60);
		$empire->query("update {$dbtbpre}enewsmoreport set purl='',ppath='',postpass='$postpass' where pid=1");
	}
	return $num;
}

//是否主訪問端管理
function Moreport_CheckAdminIsMain(){
	global $ecms_config;
	if($ecms_config['sets']['selfmoreportid']>1)
	{
		printerror("NotMainMoreport","history.go(-1)");
	}
}
?>