<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../class/t_functions.php");
$link=db_connect();
$empire=new mysqlquery();
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//驗證權限
CheckLevel($logininid,$loginin,$classid,"public");

//參數設置
function SetEnews($add,$userid,$username){
	global $empire,$dbtbpre;
	//操作權限
	CheckLevel($userid,$username,$classid,"public");
	$add[newsurl]=ehtmlspecialchars($add[newsurl],ENT_QUOTES);
	if(empty($add[indextype])){
		$add[indextype]=".html";
	}
	if(empty($add[searchtype])){
		$add[searchtype]=".html";
	}
	//備份目錄
	if(empty($add[bakdbpath])){
		$add[bakdbpath]="bdata";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbpath])))
	{
		printerror("NotBakDbPath","");
	}
	if(empty($add[bakdbzip])){
		$add[bakdbzip]="zip";
	}
	if(!file_exists("ebak/".RepPathStr($add[bakdbzip]))){
		printerror("NotbakZipPath","");
	}
	//函數是否存在
    if(!function_exists($add['listpagefun'])||!function_exists($add['textpagefun'])||!function_exists($add['listpagelistfun']))
	{
		printerror("NotPageFun","history.go(-1)");
    }
	//adfile
	$add['adfile']=RepFilenameQz($add['adfile']);
	//修改ftp密碼
	if($add[ftppassword])
	{
		$a="ftppassword='$add[ftppassword]',";
    }
	//變量處理
	$add[filesize]=(int)$add[filesize];
	$add[hotnum]=(int)$add[hotnum];
	$add[newnum]=(int)$add[newnum];
	$add[relistnum]=(int)$add[relistnum];
	$add[renewsnum]=(int)$add[renewsnum];
	$add[min_keyboard]=(int)$add[min_keyboard];
	$add[max_keyboard]=(int)$add[max_keyboard];
	$add[search_num]=(int)$add[search_num];
	$add[search_pagenum]=(int)$add[search_pagenum];
	$add[newslink]=(int)$add[newslink];
	$add[checked]=(int)$add[checked];
	$add[searchtime]=(int)$add[searchtime];
	$add[loginnum]=(int)$add[loginnum];
	$add[logintime]=(int)$add[logintime];
	$add[addnews_ok]=(int)$add[addnews_ok];
	$add[register_ok]=(int)$add[register_ok];
	$add[goodlencord]=(int)$add[goodlencord];
	$add[goodnum]=(int)$add[goodnum];
	$add[exittime]=(int)$add[exittime];
	$add[smalltextlen]=(int)$add[smalltextlen];
	$add[defaultgroupid]=(int)$add[defaultgroupid];
	$add[phpmode]=(int)$add[phpmode];
	$add[install]=(int)$add[install];
	$add[hotplnum]=(int)$add[hotplnum];
	$add[dorepnum]=(int)$add[dorepnum];
	$add[loadtempnum]=(int)$add[loadtempnum];
	$add[firstnum]=(int)$add[firstnum];
	$add[min_userlen]=(int)$add[min_userlen];
	$add[max_userlen]=(int)$add[max_userlen];
	$add[min_passlen]=(int)$add[min_passlen];
	$add[max_passlen]=(int)$add[max_passlen];
	$add[filechmod]=(int)$add[filechmod];
	$add[sametitle]=(int)$add[sametitle];
	$add[addrehtml]=(int)$add[addrehtml];
	$add[loginkey_ok]=(int)$add[loginkey_ok];
	$add[limittype]=(int)$add[limittype];
	$add[redodown]=(int)$add[redodown];
	$add[candocode]=(int)$add[candocode];
	$add[opennotcj]=(int)$add[opennotcj];
	$add[reuserpagenum]=(int)$add[reuserpagenum];
	$add[revotejsnum]=(int)$add[revotejsnum];
	$add[readjsnum]=(int)$add[readjsnum];
	$add[qaddtran]=(int)$add[qaddtran];
	$add[qaddtransize]=(int)$add[qaddtransize];
	$add[ebakthisdb]=(int)$add[ebakthisdb];
	$add[delnewsnum]=(int)$add[delnewsnum];
	$add[markpos]=(int)$add[markpos];
	$add[adminloginkey]=(int)$add[adminloginkey];
	$add[php_outtime]=(int)$add[php_outtime];
	$add[addreinfo]=(int)$add[addreinfo];
	$add[rssnum]=(int)$add[rssnum];
	$add[rsssub]=(int)$add[rsssub];
	$add[dorepdlevelnum]=(int)$add[dorepdlevelnum];
	$add[listpagelistnum]=(int)$add[listpagelistnum];
	$add[infolinknum]=(int)$add[infolinknum];
	$add[searchgroupid]=(int)$add[searchgroupid];
	$add[opencopytext]=(int)$add[opencopytext];
	$add[reuserjsnum]=(int)$add[reuserjsnum];
	$add[reuserlistnum]=(int)$add[reuserlistnum];
	$add[opentitleurl]=(int)$add[opentitleurl];
	$add['qaddtranfile']=(int)$add['qaddtranfile'];
	$add['qaddtranfilesize']=(int)$add['qaddtranfilesize'];
	$add['sendmailtype']=(int)$add['sendmailtype'];
	$add['loginemail']=(int)$add['loginemail'];
	$add['feedbacktfile']=(int)$add['feedbacktfile'];
	$add['feedbackfilesize']=(int)$add['feedbackfilesize'];
	$add['searchtempvar']=(int)$add['searchtempvar'];
	$add['showinfolevel']=(int)$add['showinfolevel'];
	$add['spicwidth']=(int)$add['spicwidth'];
	$add['spicheight']=(int)$add['spicheight'];
	$add['spickill']=(int)$add['spickill'];
	$add['jpgquality']=(int)$add['jpgquality'];
	$add['markpct']=(int)$add['markpct'];
	$add['redoview']=(int)$add['redoview'];
	$add['reggetfen']=(int)$add['reggetfen'];
	$add['regbooktime']=(int)$add['regbooktime'];
	$add['revotetime']=(int)$add['revotetime'];
	$add['fpath']=(int)$add['fpath'];
	$add['openmembertranimg']=(int)$add['openmembertranimg'];
	$add['memberimgsize']=(int)$add['memberimgsize'];
	$add['openmembertranfile']=(int)$add['openmembertranfile'];
	$add['memberfilesize']=(int)$add['memberfilesize'];
	$add['openspace']=(int)$add['openspace'];
	$add['realltime']=(int)$add['realltime'];
	$add['textpagelistnum']=(int)$add['textpagelistnum'];
	$add['memberlistlevel']=(int)$add['memberlistlevel'];
	$add['ebakcanlistdb']=(int)$add['ebakcanlistdb'];
	$add['keytog']=(int)$add['keytog'];
	$add['keytime']=(int)$add['keytime'];
	$add['regkey_ok']=(int)$add['regkey_ok'];
	$add['opengetdown']=(int)$add['opengetdown'];
	$add['gbkey_ok']=(int)$add['gbkey_ok'];
	$add['fbkey_ok']=(int)$add['fbkey_ok'];
	$add['newaddinfotime']=(int)$add['newaddinfotime'];
	$add['classnavline']=(int)$add['classnavline'];
	$add['docnewsnum']=(int)$add['docnewsnum'];
	$add['dtcanbq']=(int)$add['dtcanbq'];
	$add['dtcachetime']=(int)$add['dtcachetime'];
	$add['regretime']=(int)$add['regretime'];
	$add['regemailonly']=(int)$add['regemailonly'];
	$add['repkeynum']=(int)$add['repkeynum'];
	$add['getpasstime']=(int)$add['getpasstime'];
	$add['acttime']=(int)$add['acttime'];
	$add['regacttype']=(int)$add['regacttype'];
	$add['opengetpass']=(int)$add['opengetpass'];
	$add['hlistinfonum']=(int)$add['hlistinfonum'];
	if(empty($add['hlistinfonum']))
	{
		$add['hlistinfonum']=30;
	}
	$add['qlistinfonum']=(int)$add['qlistinfonum'];
	if(empty($add['qlistinfonum']))
	{
		$add['qlistinfonum']=30;
	}
	$add['dtncanbq']=(int)$add['dtncanbq'];
	$add['dtncachetime']=(int)$add['dtncachetime'];
	$add['readdinfotime']=(int)$add['readdinfotime'];
	$add['qeditinfotime']=(int)$add['qeditinfotime'];
	$add['ftpmode']=(int)$add['ftpmode'];
	$add['ftpssl']=(int)$add['ftpssl'];
	$add['ftppasv']=(int)$add['ftppasv'];
	$add['ftpouttime']=(int)$add['ftpouttime'];
	$add['onclicktype']=(int)$add['onclicktype'];
	$add['onclickfilesize']=(int)$add['onclickfilesize'];
	$add['onclickfiletime']=(int)$add['onclickfiletime'];
	$add['closeqdt']=(int)$add['closeqdt'];
	$add['settop']=(int)$add['settop'];
	$add['qlistinfomod']=(int)$add['qlistinfomod'];
	$add['gb_num']=(int)$add['gb_num'];
	$add['member_num']=(int)$add['member_num'];
	$add['space_num']=(int)$add['space_num'];
	$add['infolday']=(int)$add['infolday'];
	$add['filelday']=(int)$add['filelday'];
	$add['baktempnum']=(int)$add['baktempnum'];
	$add['dorepkey']=(int)$add['dorepkey'];
	$add['dorepword']=(int)$add['dorepword'];
	$add['indexpagedt']=(int)$add['indexpagedt'];
	$add['closeqdtmsg']=AddAddsData($add['closeqdtmsg']);
	$add['openfileserver']=(int)$add['openfileserver'];
	$add['fieldandtop']=(int)$add['fieldandtop'];
	$add['fieldandclosetb']=$add['fieldandclosetb']?','.$add['fieldandclosetb'].',':'';
	$add['firsttitlename']=ehtmlspecialchars(str_replace("\r\n","|",$add['firsttitlename']));
	$add['isgoodname']=ehtmlspecialchars(str_replace("\r\n","|",$add['isgoodname']));
	$add['closelisttemp']=ehtmlspecialchars($add['closelisttemp']);
	$add['ipaddinfonum']=(int)$add['ipaddinfonum'];
	$add['ipaddinfotime']=(int)$add['ipaddinfotime'];
	$add['indexaddpage']=(int)$add['indexaddpage'];
	$add['modmemberedittran']=(int)$add['modmemberedittran'];
	$add['modinfoedittran']=(int)$add['modinfoedittran'];
	//提交IP
	$doiptypes='';
	$doiptype=$add['doiptype'];
	$doiptypecount=count($doiptype);
	if($doiptypecount)
	{
		$doiptypes=',';
		for($di=0;$di<$doiptypecount;$di++)
		{
			$doiptypes.=$doiptype[$di].',';
		}
	}
	//關閉相關模塊
	$closemodss='';
	$closemods=$add['closemods'];
	$closemodscount=count($closemods);
	if($closemodscount)
	{
		$closemodss=',';
		for($cmi=0;$cmi<$closemodscount;$cmi++)
		{
			$closemodss.=$closemods[$cmi].',';
		}
	}
	//關閉後台菜單
	$closehmenus='';
	$closehmenu=$add['closehmenu'];
	$closehmenucount=count($closehmenu);
	if($closehmenucount)
	{
		$closehmenus=',';
		for($chmi=0;$chmi<$closehmenucount;$chmi++)
		{
			$closehmenus.=$closehmenu[$chmi].',';
		}
	}
	//限制操作的時間點
	$timecloses='';
	$timeclose=$add['timeclose'];
	$timeclosecount=count($timeclose);
	if($timeclosecount)
	{
		$timecloses=',';
		for($tci=0;$tci<$timeclosecount;$tci++)
		{
			$timecloses.=$timeclose[$tci].',';
		}
	}
	//限制使用時間的操作
	$timeclosedos='';
	$timeclosedo=$add['timeclosedo'];
	$timeclosedocount=count($timeclosedo);
	if($timeclosedocount)
	{
		$timeclosedos=',';
		for($tcdi=0;$tcdi<$timeclosedocount;$tcdi++)
		{
			$timeclosedos.=$timeclosedo[$tcdi].',';
		}
	}

	$add[filetype]="|".$add[filetype]."|";
	$add[qimgtype]="|".$add['qaddtranimgtype']."|";
	$add[qfiletype]="|".$add['qaddtranfiletype']."|";
	$add[feedbackfiletype]="|".$add['feedbackfiletype']."|";
	$add[memberimgtype]="|".$add['memberimgtype']."|";
	$add[memberfiletype]="|".$add['memberfiletype']."|";
	$sql=$empire->query("update {$dbtbpre}enewspublic set ".$a."sitename='$add[sitename]',newsurl='$add[newsurl]',email='$add[email]',filetype='$add[filetype]',filesize=$add[filesize],hotnum=$add[hotnum],newnum=$add[newnum],relistnum=$add[relistnum],renewsnum=$add[renewsnum],min_keyboard=$add[min_keyboard],max_keyboard=$add[max_keyboard],search_num=$add[search_num],search_pagenum=$add[search_pagenum],newslink=$add[newslink],checked=$add[checked],searchtime=$add[searchtime],loginnum=$add[loginnum],logintime=$add[logintime],addnews_ok=$add[addnews_ok],register_ok=$add[register_ok],indextype='$add[indextype]',goodlencord=$add[goodlencord],goodtype='$add[goodtype]',goodnum=$add[goodnum],searchtype='$add[searchtype]',exittime=$add[exittime],smalltextlen=$add[smalltextlen],defaultgroupid=$add[defaultgroupid],fileurl='$add[fileurl]',phpmode=$add[phpmode],ftphost='$add[ftphost]',ftpport='$add[ftpport]',ftpusername='$add[ftpusername]',ftppath='$add[ftppath]',ftpmode='$add[ftpmode]',install=$add[install],hotplnum=$add[hotplnum],dorepnum=$add[dorepnum],loadtempnum=$add[loadtempnum],firstnum=$add[firstnum],bakdbpath='$add[bakdbpath]',bakdbzip='$add[bakdbzip]',downpass='$add[downpass]',min_userlen=$add[min_userlen],max_userlen=$add[max_userlen],min_passlen=$add[min_passlen],max_passlen=$add[max_passlen],filechmod=$add[filechmod],loginkey_ok=$add[loginkey_ok],limittype=$add[limittype],redodown=$add[redodown],candocode=$add[candocode],opennotcj=$add[opennotcj],reuserpagenum=$add[reuserpagenum],revotejsnum=$add[revotejsnum],readjsnum=$add[readjsnum],qaddtran=$add[qaddtran],qaddtransize=$add[qaddtransize],ebakthisdb=$add[ebakthisdb],delnewsnum=$add[delnewsnum],markpos=$add[markpos],markimg='$add[markimg]',marktext='$add[marktext]',markfontsize='$add[markfontsize]',markfontcolor='$add[markfontcolor]',markfont='$add[markfont]',adminloginkey=$add[adminloginkey],php_outtime=$add[php_outtime],listpagefun='$add[listpagefun]',textpagefun='$add[textpagefun]',adfile='$add[adfile]',notsaveurl='$add[notsaveurl]',rssnum=$add[rssnum],rsssub=$add[rsssub],dorepdlevelnum=$add[dorepdlevelnum],listpagelistfun='$add[listpagelistfun]',listpagelistnum=$add[listpagelistnum],infolinknum=$add[infolinknum],searchgroupid=$add[searchgroupid],opencopytext=$add[opencopytext],reuserjsnum=$add[reuserjsnum],reuserlistnum=$add[reuserlistnum],opentitleurl='$add[opentitleurl]',qaddtranimgtype='$add[qimgtype]',qaddtranfile=$add[qaddtranfile],qaddtranfilesize=$add[qaddtranfilesize],qaddtranfiletype='$add[qfiletype]',sendmailtype=$add[sendmailtype],smtphost='$add[smtphost]',fromemail='$add[fromemail]',loginemail=$add[loginemail],emailusername='$add[emailusername]',emailpassword='$add[emailpassword]',smtpport='$add[smtpport]',emailname='$add[emailname]',feedbacktfile=$add[feedbacktfile],feedbackfilesize=$add[feedbackfilesize],feedbackfiletype='$add[feedbackfiletype]',searchtempvar=$add[searchtempvar],showinfolevel=$add[showinfolevel],navfh='".eaddslashes($add[navfh])."',spicwidth=$add[spicwidth],spicheight=$add[spicheight],spickill=$add[spickill],jpgquality=$add[jpgquality],markpct=$add[markpct],redoview=$add[redoview],reggetfen=$add[reggetfen],regbooktime=$add[regbooktime],revotetime=$add[revotetime],fpath=$add[fpath],filepath='$add[filepath]',openmembertranimg=$add[openmembertranimg],memberimgsize=$add[memberimgsize],openmembertranfile=$add[openmembertranfile],memberfilesize=$add[memberfilesize],memberimgtype='$add[memberimgtype]',memberfiletype='$add[memberfiletype]',canposturl='$add[canposturl]',openspace='$add[openspace]',realltime=$add[realltime],closeip='$add[closeip]',openip='$add[openip]',hopenip='$add[hopenip]',closewords='$add[closewords]',closewordsf='$add[closewordsf]',textpagelistnum=$add[textpagelistnum],memberlistlevel=$add[memberlistlevel],ebakcanlistdb=$add[ebakcanlistdb],keytog='$add[keytog]',keyrnd='$add[keyrnd]',keytime='$add[keytime]',regkey_ok='$add[regkey_ok]',opengetdown='$add[opengetdown]',gbkey_ok='$add[gbkey_ok]',fbkey_ok='$add[fbkey_ok]',newaddinfotime='$add[newaddinfotime]',classnavline='$add[classnavline]',classnavfh='".eaddslashes($add[classnavfh])."',sitekey='$add[sitekey]',siteintro='$add[siteintro]',docnewsnum='$add[docnewsnum]',dtcanbq='$add[dtcanbq]',dtcachetime='$add[dtcachetime]',regretime='$add[regretime]',regclosewords='$add[regclosewords]',regemailonly='$add[regemailonly]',repkeynum='$add[repkeynum]',getpasstime='$add[getpasstime]',acttime='$add[acttime]',regacttype='$add[regacttype]',acttext='".eaddslashes($add[acttext])."',getpasstext='".eaddslashes($add[getpasstext])."',acttitle='".eaddslashes($add[acttitle])."',getpasstitle='".eaddslashes($add[getpasstitle])."',opengetpass='$add[opengetpass]',hlistinfonum='$add[hlistinfonum]',qlistinfonum='$add[qlistinfonum]',dtncanbq='$add[dtncanbq]',dtncachetime='$add[dtncachetime]',readdinfotime='$add[readdinfotime]',qeditinfotime='$add[qeditinfotime]',ftpssl='$add[ftpssl]',ftppasv='$add[ftppasv]',ftpouttime='$add[ftpouttime]',onclicktype='$add[onclicktype]',onclickfilesize='$add[onclickfilesize]',onclickfiletime='$add[onclickfiletime]',closeqdt='$add[closeqdt]',settop='$add[settop]',qlistinfomod='$add[qlistinfomod]',gb_num='$add[gb_num]',member_num='$add[member_num]',space_num='$add[space_num]',opendoip='$add[opendoip]',closedoip='$add[closedoip]',doiptype='$doiptypes',infolday='$add[infolday]',filelday='$add[filelday]',baktempnum='$add[baktempnum]',dorepkey='$add[dorepkey]',dorepword='$add[dorepword]',onclickrnd='$add[onclickrnd]',indexpagedt='$add[indexpagedt]',keybgcolor='$add[keybgcolor]',keyfontcolor='$add[keyfontcolor]',keydistcolor='$add[keydistcolor]',closeqdtmsg='$add[closeqdtmsg]',openfileserver='$add[openfileserver]',closemods='$closemodss',fieldandtop='$add[fieldandtop]',fieldandclosetb='$add[fieldandclosetb]',firsttitlename='".eaddslashes($add[firsttitlename])."',isgoodname='".eaddslashes($add[isgoodname])."',closelisttemp='".eaddslashes($add[closelisttemp])."',chclasscolor='".eaddslashes($add[chclasscolor])."',timeclose='".eaddslashes($timecloses)."',timeclosedo='".eaddslashes($timeclosedos)."',ipaddinfonum='$add[ipaddinfonum]',ipaddinfotime='$add[ipaddinfotime]',closehmenu='$closehmenus',indexaddpage='$add[indexaddpage]',modmemberedittran='$add[modmemberedittran]',modinfoedittran='$add[modinfoedittran]';");
	DoSetFileServer($add);//遠程附件更新
	GetConfig();
	//首頁動態文件
	if($add['indexpagedt']!=$add['oldindexpagedt'])
	{
		if($add['indexpagedt'])
		{
			DelFiletext(ECMS_PATH.'index'.$add[indextype]);
			@copy(ECMS_PATH.'e/data/template/dtindexpage.txt',ECMS_PATH.'index.php');
		}
		else
		{
			DelFiletext(ECMS_PATH.'index.php');
			$indextemp=GetIndextemp();
			NewsBq(0,$indextemp,1,0);
		}
	}
	if($sql){
		insert_dolog("");//操作日誌
		printerror("SetPublicSuccess","SetEnews.php".hReturnEcmsHashStrHref2(1));
	}
	else{
		printerror("DbError","history.go(-1)");
	}
}

//遠程附件更新
function DoSetFileServer($add){
	global $empire,$dbtbpre;
	$update='';
	if($add['fs_ftppassword'])
	{
		$update=",ftppassword='$add[fs_ftppassword]'";
	}
	$add['fs_ftpmode']=(int)$add['fs_ftpmode'];
	$add['fs_ftpssl']=(int)$add['fs_ftpssl'];
	$add['fs_ftppasv']=(int)$add['fs_ftppasv'];
	$add['fs_ftpouttime']=(int)$add['fs_ftpouttime'];
	$sql=$empire->query("update {$dbtbpre}enewspostserver set purl='$add[fs_purl]',ftphost='$add[fs_ftphost]',ftpport='$add[fs_ftpport]',ftpusername='$add[fs_ftpusername]',ftppath='$add[fs_ftppath]',ftpmode='$add[fs_ftpmode]',ftpssl='$add[fs_ftpssl]',ftppasv='$add[fs_ftppasv]',ftpouttime='$add[fs_ftpouttime]'".$update." where pid='1'");
}

//測試遠程附件FTP
function CheckFileServerFtp($add,$userid,$username){
	global $empire,$dbtbpre;
	//操作權限
	CheckLevel($userid,$username,$classid,"public");
	$ftphost=$add[fs_ftphost];
	$ftpport=$add[fs_ftpport];
	$ftpusername=$add[fs_ftpusername];
	if($add[fs_ftppassword])
	{
		$ftppassword=$add[fs_ftppassword];
	}
	else
	{
		$fsr=$empire->fetch1("select ftppassword from {$dbtbpre}enewspostserver where pid='1' limit 1");
		$ftppassword=$fsr[ftppassword];
	}
	$ftppath=$add[fs_ftppath];
	$tranmode=(int)$add['fs_ftpmode'];
	$ftpssl=(int)$add['fs_ftpssl'];
	$pasv=(int)$add['fs_ftppasv'];
	$timeout=(int)$add['fs_ftpouttime'];
	CheckFtpConnect($ftphost,$ftpport,$ftpusername,$ftppassword,$ftppath,$ftpssl,$pasv,$tranmode,$timeout);
}

//測試遠程發佈FTP
function CheckPostServerFtp($add,$userid,$username){
	global $empire,$dbtbpre;
	//操作權限
	CheckLevel($userid,$username,$classid,"public");
	$ftphost=$add[ftphost];
	$ftpport=$add[ftpport];
	$ftpusername=$add[ftpusername];
	if($add[ftppassword])
	{
		$ftppassword=$add[ftppassword];
	}
	else
	{
		$fsr=$empire->fetch1("select ftppassword from {$dbtbpre}enewspublic limit 1");
		$ftppassword=$fsr[ftppassword];
	}
	$ftppath=$add[ftppath];
	$tranmode=(int)$add['ftpmode'];
	$ftpssl=(int)$add['ftpssl'];
	$pasv=(int)$add['ftppasv'];
	$timeout=(int)$add['ftpouttime'];
	CheckFtpConnect($ftphost,$ftpport,$ftpusername,$ftppassword,$ftppath,$ftpssl,$pasv,$tranmode,$timeout);
}

$enews=$_POST['enews'];
if(empty($enews))
{
	$enews=$_GET['enews'];
}
if($enews)
{
	hCheckEcmsRHash();
	include LoadLang("pub/fun.php");
	include("../data/dbcache/class.php");
	include("../data/dbcache/MemberLevel.php");
}
if($enews=="SetEnews")//參數設置
{
	SetEnews($_POST,$logininid,$loginin);
}
elseif($enews=='CheckFileServerFtp')//測試附件FTP
{
	CheckFileServerFtp($_POST,$logininid,$loginin);
}
elseif($enews=='CheckPostServerFtp')//測試遠程發佈FTP
{
	CheckPostServerFtp($_POST,$logininid,$loginin);
}

$r=$empire->fetch1("select * from {$dbtbpre}enewspublic limit 1");
//文件類別
$filetype=substr($r[filetype],1,strlen($r[filetype]));
$filetype=substr($filetype,0,strlen($filetype)-1);
//投稿圖片擴展名
$qaddimgtype=substr($r[qaddtranimgtype],1,strlen($r[qaddtranimgtype]));
$qaddimgtype=substr($qaddimgtype,0,strlen($qaddimgtype)-1);
//投稿附件擴展名
$qaddfiletype=substr($r[qaddtranfiletype],1,strlen($r[qaddtranfiletype]));
$qaddfiletype=substr($qaddfiletype,0,strlen($qaddfiletype)-1);
//反饋附件
$feedbackfiletype=substr($r[feedbackfiletype],1,strlen($r[feedbackfiletype])-2);
//會員表單
$memberimgtype=substr($r[memberimgtype],1,strlen($r[memberimgtype]));
$memberimgtype=substr($memberimgtype,0,strlen($memberimgtype)-1);
$memberfiletype=substr($r[memberfiletype],1,strlen($r[memberfiletype]));
$memberfiletype=substr($memberfiletype,0,strlen($memberfiletype)-1);
//----------會員組
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	if($r[defaultgroupid]==$l_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	//搜索會員組
	if($r[searchgroupid]==$l_r[groupid])
	{$s_select=" selected";}
	else
	{$s_select="";}
	//查看資料權限
	if($r[showinfolevel]==$l_r[groupid])
	{$showinfo_select=" selected";}
	else
	{$showinfo_select="";}
	//會員列表查看權限
	if($r[memberlistlevel]==$l_r[groupid])
	{$memberlist_select=" selected";}
	else
	{$memberlist_select="";}
	$membergroup.="<option value=".$l_r[groupid].$select.">".$l_r[groupname]."</option>";
	$searchmembergroup.="<option value=".$l_r[groupid].$s_select.">".$l_r[groupname]."</option>";
	$showinfolevel.="<option value=".$l_r[groupid].$showinfo_select.">".$l_r[groupname]."</option>";
	$memberlistlevel.="<option value=".$l_r[groupid].$memberlist_select.">".$l_r[groupname]."</option>";
}
//遠程附件
if($r['openfileserver']==1)
{
	$hiddenfileserver="<script>document.getElementById('setfileserver').style.display='';</script>";
}
else
{
	$hiddenfileserver="<script>document.getElementById('setfileserver').style.display='none';</script>";
}
$fsr=$empire->fetch1("select * from {$dbtbpre}enewspostserver where pid='1' limit 1");
//當前使用的模板組
$thegid=GetDoTempGid();
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>參數設置</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<link id="luna-tab-style-sheet" type="text/css" rel="stylesheet" href="adminstyle/<?=$loginadminstyleid?>/tab.winclassic.css" disabled="disabled" /> 
<!-- the id is not needed. It is used here to be able to change css file at runtime -->
<style type="text/css"> 
   .dynamic-tab-pane-control .tab-page { 
          width:                100%;
 } 
  .dynamic-tab-pane-control .tab-page .dynamic-tab-pane-control .tab-page { 
         height:                150px; 
 } 
  form { 
         margin:        0; 
         padding:        0; 
 } 
  /* over ride styles from webfxlayout */ 
  .dynamic-tab-pane-control h2 { 
         font-size:12px;
		 font-weight:normal;
		 text-align:        center; 
         width:                auto;
		 height:            20; 
 } 
   .dynamic-tab-pane-control h2 a { 
         display:        inline; 
         width:                auto; 
 } 
  .dynamic-tab-pane-control a:hover { 
         background: transparent; 
 } 
  </style>
 <script type="text/javascript" src="../data/images/tabpane.js"></script> <script type="text/javascript"> 
  function setLinkSrc( sStyle ) { 
         document.getElementById( "luna-tab-style-sheet" ).disabled = sStyle != "luna"; 
  
         //document.documentElement.style.background = "";
         //document.body.style.background = sStyle == "webfx" ? "white" : "ThreeDFace"; 
 } 
function chgBg(obj,color){
 if (document.all || document.getElementById)
   obj.style.backgroundColor=color;
 else if (document.layers)
   obj.bgColor=color;
}
  setLinkSrc( "luna" ); 
  
  function foreColor(objf)
{
  if (!Error())	return;
  var arr = showModalDialog("ecmseditor/fieldfile/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) objf.value=arr;
  else objf.focus();
}
  </script> 
</head>

<body>
<table width="100%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href="SetEnews.php<?=$ecms_hashur['whehref']?>">參數設置</a></td>
  </tr>
</table>
<form name="form1" method="post" action="SetEnews.php">
<div class="tab-pane" id="TabPane1"> <script type="text/javascript">
tb1 = new WebFXTabPane( document.getElementById( "TabPane1" ) );
</script>
<div class="tab-page" id="baseinfo"> 
                    
      <h2 class="tab">&nbsp;<font class=tabcolor>基本屬性</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "baseinfo" ) );</script>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
	  <?=$ecms_hashur['form']?>
        <input type=hidden name=enews value=SetEnews>
        <tr class="header"> 
          <td height="25" colspan="2">基本信息設置</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">站點名稱</td>
          <td width="78%" height="25" bgcolor="#FFFFFF"> <input name="sitename" type="text" id="sitename" value="<?=$r[sitename]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">網站地址</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="newsurl" type="text" id="newsurl4" value="<?=$r[newsurl]?>" size="38"> 
            <font color="#666666">(結尾需加「/」，如：/)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">附件地址</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fileurl" type="text" id="fileurl" value="<?=$r[fileurl]?>" size="38"> 
            <font color="#666666">(綁定域名時設置，結尾需加「/」，如：/d/file/)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">管理員郵箱</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="email" type="text" id="email" value="<?=$r[email]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">網站關鍵字</td>
          <td height="25" bgcolor="#FFFFFF"><input name="sitekey" type="text" id="sitekey" value="<?=$r[sitekey]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">網站簡介</td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="siteintro" cols="80" rows="5" id="siteintro"><?=$r[siteintro]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">首頁文件擴展名</td>
          <td height="25" bgcolor="#FFFFFF"><input name="indextype" type="text" id="indextype" value="<?=$r[indextype]?>" size="38"> 
            <font color="#666666"> 
            <select name="select" onchange="document.form1.indextype.value=this.value">
              <option value=".html">擴展名</option>
              <option value=".html">.html</option>
              <option value=".htm">.htm</option>
              <option value=".php">.php</option>
              <option value=".shtml">.shtml</option>
            </select>
            <input name="oldindextype" type="hidden" id="oldindextype" value="<?=$r[indextype]?>">
            <font color="#666666"></font>(如：.html,.htm,.xml,.php)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">首頁模式</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="indexpagedt" value="0"<?=$r['indexpagedt']==0?' checked':''?>>
            靜態首頁 
            <input type="radio" name="indexpagedt" value="1"<?=$r['indexpagedt']==1?' checked':''?>>
            動態首頁 
            <input name="oldindexpagedt" type="hidden" id="oldindexpagedt" value="<?=$r[indexpagedt]?>"></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">首頁鏈接加文件名</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="indexaddpage" value="1"<?=$r['indexaddpage']==1?' checked':''?>>
            增加
            <input type="radio" name="indexaddpage" value="0"<?=$r['indexaddpage']==0?' checked':''?>>
  不增加</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">PHP超時時間設置</td>
          <td height="25" bgcolor="#FFFFFF"><input name="php_outtime" type="text" id="php_outtime" value="<?=$r[php_outtime]?>" size="38">
            秒 <font color="#666666">(一般不需要設置)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">關閉前台所有動態頁面</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="closeqdt" value="1"<?=$r[closeqdt]==1?' checked':''?>>
            是 
            <input type="radio" name="closeqdt" value="0"<?=$r[closeqdt]==0?' checked':''?>>
            否<font color="#666666">(如果開啟，前台所有動態文件都無法使用，但性能和安全性最高)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">關閉動態頁面提示內容</td>
          <td height="25" bgcolor="#FFFFFF"> <textarea name="closeqdtmsg" cols="80" rows="5" id="closeqdtmsg"><?=ehtmlspecialchars($r[closeqdtmsg])?></textarea></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">關閉前台模塊相關功能</td>
          <td height="25" bgcolor="#FFFFFF"><input name="closemods[]" type="checkbox" id="closemods[]" value="down"<?=strstr($r['closemods'],',down,')?' checked':''?>>
            下載 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="movie"<?=strstr($r['closemods'],',movie,')?' checked':''?>>
            電影 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="shop"<?=strstr($r['closemods'],',shop,')?' checked':''?>>
            商城 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="pay"<?=strstr($r['closemods'],',pay,')?' checked':''?>>
            在線支付 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="rss"<?=strstr($r['closemods'],',rss,')?' checked':''?>>
            RSS 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="search"<?=strstr($r['closemods'],',search,')?' checked':''?>>
            搜索
			<input name="closemods[]" type="checkbox" id="closemods[]" value="sch"<?=strstr($r['closemods'],',sch,')?' checked':''?>>
            全站搜索<br>
            <input name="closemods[]" type="checkbox" id="closemods[]" value="member"<?=strstr($r['closemods'],',member,')?' checked':''?>>
            會員
			<input name="closemods[]" type="checkbox" id="closemods[]" value="pl"<?=strstr($r['closemods'],',pl,')?' checked':''?>>
            評論
			<input name="closemods[]" type="checkbox" id="closemods[]" value="print"<?=strstr($r['closemods'],',print,')?' checked':''?>>
            打印 
            <input name="closemods[]" type="checkbox" id="closemods[]" value="mconnect"<?=strstr($r['closemods'],',mconnect,')?' checked':''?>>
外部登錄
<input name="closemods[]" type="checkbox" id="closemods[]" value="fieldand"<?=strstr($r['closemods'],',fieldand,')?' checked':''?>>
            結合項</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">不開啟操作的時間點</td>
          <td height="25" bgcolor="#FFFFFF"><table width="500" border="0" cellspacing="1" cellpadding="3">
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="0"<?=strstr($r['timeclose'],',0,')?' checked':''?>>
                0點</td>
              <td><input name="timeclose[]" type="checkbox" value="1"<?=strstr($r['timeclose'],',1,')?' checked':''?>>
                1點</td>
              <td><input name="timeclose[]" type="checkbox" value="2"<?=strstr($r['timeclose'],',2,')?' checked':''?>>
                2點</td>
              <td><input name="timeclose[]" type="checkbox" value="3"<?=strstr($r['timeclose'],',3,')?' checked':''?>>
                3點</td>
              <td><input name="timeclose[]" type="checkbox" value="4"<?=strstr($r['timeclose'],',4,')?' checked':''?>>
                4點</td>
              <td><input name="timeclose[]" type="checkbox" value="5"<?=strstr($r['timeclose'],',5,')?' checked':''?>>
                5點</td>
            </tr>
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="6"<?=strstr($r['timeclose'],',6,')?' checked':''?>>
                6點</td>
              <td><input name="timeclose[]" type="checkbox" value="7"<?=strstr($r['timeclose'],',7,')?' checked':''?>>
                7點</td>
              <td><input name="timeclose[]" type="checkbox" value="8"<?=strstr($r['timeclose'],',8,')?' checked':''?>>
                8點</td>
              <td><input name="timeclose[]" type="checkbox" value="9"<?=strstr($r['timeclose'],',9,')?' checked':''?>>
                9點</td>
              <td><input name="timeclose[]" type="checkbox" value="10"<?=strstr($r['timeclose'],',10,')?' checked':''?>>
                10點</td>
              <td><input name="timeclose[]" type="checkbox" value="11"<?=strstr($r['timeclose'],',11,')?' checked':''?>>
                11點</td>
            </tr>
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="12"<?=strstr($r['timeclose'],',12,')?' checked':''?>>
                12點</td>
              <td><input name="timeclose[]" type="checkbox" value="13"<?=strstr($r['timeclose'],',13,')?' checked':''?>>
                13點</td>
              <td><input name="timeclose[]" type="checkbox" value="14"<?=strstr($r['timeclose'],',14,')?' checked':''?>>
                14點</td>
              <td><input name="timeclose[]" type="checkbox" value="15"<?=strstr($r['timeclose'],',15,')?' checked':''?>>
                15點</td>
              <td><input name="timeclose[]" type="checkbox" value="16"<?=strstr($r['timeclose'],',16,')?' checked':''?>>
                16點</td>
              <td><input name="timeclose[]" type="checkbox" value="17"<?=strstr($r['timeclose'],',17,')?' checked':''?>>
                17點</td>
            </tr>
            <tr>
              <td><input name="timeclose[]" type="checkbox" value="18"<?=strstr($r['timeclose'],',18,')?' checked':''?>>
                18點</td>
              <td><input name="timeclose[]" type="checkbox" value="19"<?=strstr($r['timeclose'],',19,')?' checked':''?>>
                19點</td>
              <td><input name="timeclose[]" type="checkbox" value="20"<?=strstr($r['timeclose'],',20,')?' checked':''?>>
                20點</td>
              <td><input name="timeclose[]" type="checkbox" value="21"<?=strstr($r['timeclose'],',21,')?' checked':''?>>
                21點</td>
              <td><input name="timeclose[]" type="checkbox" value="22"<?=strstr($r['timeclose'],',22,')?' checked':''?>>
                22點</td>
              <td><input name="timeclose[]" type="checkbox" value="23"<?=strstr($r['timeclose'],',23,')?' checked':''?>>
                23點</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">限定操作時間的操作</td>
          <td height="25" bgcolor="#FFFFFF"><input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="reg"<?=strstr($r['timeclosedo'],',reg,')?' checked':''?>>
          註冊會員
            <input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="info"<?=strstr($r['timeclosedo'],',info,')?' checked':''?>>
投稿
<input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="pl"<?=strstr($r['timeclosedo'],',pl,')?' checked':''?>>
評論
<input name="timeclosedo[]" type="checkbox" id="timeclosedo[]" value="gbook"<?=strstr($r['timeclosedo'],',gbook,')?' checked':''?>>
留言板</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">遠程保存忽略地址<br> <br> <font color="#666666">(一行為一個地址)</font></td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="notsaveurl" cols="80" rows="8" id="notsaveurl"><?=$r[notsaveurl]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">前台允許提交的來源地址<br> <br> 
            <font color="#666666">(一行為一個地址)</font></td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="canposturl" cols="80" rows="8" id="canposturl"><?=$r[canposturl]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">驗證碼字符組成</td>
          <td height="25" bgcolor="#FFFFFF"><select name="keytog" id="keytog">
              <option value="0"<?=$r[keytog]==0?' selected':''?>>數字</option>
              <option value="1"<?=$r[keytog]==1?' selected':''?>>字母</option>
              <option value="2"<?=$r[keytog]==2?' selected':''?>>數字+字母</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">驗證碼過期時間</td>
          <td height="25" bgcolor="#FFFFFF"><input name="keytime" type="text" id="keytime" value="<?=$r[keytime]?>" size="38">
            分鐘 </td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">驗證碼加密字符串</td>
          <td height="25" bgcolor="#FFFFFF"><input name="keyrnd" type="text" id="keyrnd" value="<?=$r[keyrnd]?>" size="38"> 
            <font color="#666666">(10~60個任意字符，最好多種字符組合)</font></td>
        </tr>
        <tr> 
          <td rowspan="3" bgcolor="#FFFFFF">驗證碼配色</td>
          <td height="25" bgcolor="#FFFFFF">背景顏色： 
            <input name="keybgcolor" type="text" id="keybgcolor" value="<?=$r[keybgcolor]?>"> 
            <a onclick="foreColor(document.form1.keybgcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">文字顏色： 
            <input name="keyfontcolor" type="text" id="keyfontcolor" value="<?=$r[keyfontcolor]?>"> 
            <a onclick="foreColor(document.form1.keyfontcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">干擾顏色： 
            <input name="keydistcolor" type="text" id="keydistcolor" value="<?=$r[keydistcolor]?>"> 
            <a onclick="foreColor(document.form1.keydistcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a>          </td>
        </tr>
      </table>
  </div>
    <div class="tab-page" id="login"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">用戶設置</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "login" ) );</script>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
          <td height="25" colspan="2">後台設置</td>
    </tr>
	<tr> 
          <td height="25" bgcolor="#FFFFFF">後台登陸驗證碼</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="adminloginkey" value="0"<?=$r[adminloginkey]==0?' checked':''?>>
            開啟 
            <input type="radio" name="adminloginkey" value="1"<?=$r[adminloginkey]==1?' checked':''?>>
            關閉</td>
        </tr>
    <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">後台登錄次數限制</td>
      <td height="25" bgcolor="#FFFFFF"><input name="loginnum" type="text" id="loginnum" value="<?=$r[loginnum]?>" size="38">
        次</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">重新登錄時間間隔</td>
      <td height="25" bgcolor="#FFFFFF"><input name="logintime" type="text" id="logintime" value="<?=$r[logintime]?>" size="38">
        分鐘</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">登錄超時限制</td>
      <td height="25" bgcolor="#FFFFFF"><input name="exittime" type="text" id="exittime" value="<?=$r[exittime]?>" size="38">
        分鐘</td>
    </tr>
	</table>
	
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="24" colspan="2">前台設置</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><p>會員註冊</p></td>
          <td height="25" bgcolor="#FFFFFF"><p> 
              <input type="radio" name="register_ok" value="0"<?=$r[register_ok]==0?' checked':''?>>
              開啟 
              <input type="radio" name="register_ok" value="1"<?=$r[register_ok]==1?' checked':''?>>
              關閉</p></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">註冊會員默認會員組</td>
          <td height="25" bgcolor="#FFFFFF"><select name="defaultgroupid">
              <?=$membergroup?>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">註冊贈送點數</td>
          <td height="25" bgcolor="#FFFFFF"><input name="reggetfen" type="text" id="reggetfen" value="<?=$r[reggetfen]?>" size="38"></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">註冊用戶名限制</td>
          <td height="25" bgcolor="#FFFFFF"><input name="min_userlen" type="text" id="min_userlen" value="<?=$r[min_userlen]?>" size="6">
            ~ 
            <input name="max_userlen" type="text" id="max_userlen" value="<?=$r[max_userlen]?>" size="6">
            個字節</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">註冊密碼限制</td>
          <td height="25" bgcolor="#FFFFFF"><input name="min_passlen" type="text" id="min_passlen" value="<?=$r[min_passlen]?>" size="6">
            ~ 
            <input name="max_passlen" type="text" id="max_passlen" value="<?=$r[max_passlen]?>" size="6">
            個字節</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">會員郵箱唯一性檢查:</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regemailonly" type="radio" value="1"<?=$r[regemailonly]==1?' checked':''?>>
            開啟 
            <input name="regemailonly" type="radio" value="0"<?=$r[regemailonly]==0?' checked':''?>>
            關閉</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">同一IP註冊間隔限制:</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regretime" type="text" id="regretime" value="<?=$r[regretime]?>" size="38">
            個小時</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">用戶名保留關鍵字:</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regclosewords" type="text" id="repnum3" value="<?=$r[regclosewords]?>" size="38">
            <font color="#666666">(禁止包含字符,多個用&quot;|&quot;號隔開,支持多字驗證)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">投稿功能</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="addnews_ok" value="0"<?=$r[addnews_ok]==0?' checked':''?>>
            開啟 
            <input type="radio" name="addnews_ok" value="1"<?=$r[addnews_ok]==1?' checked':''?>>
            關閉</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">會員空間</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="openspace" value="0"<?=$r[openspace]==0?' checked':''?>>
            開啟 
            <input type="radio" name="openspace" value="1"<?=$r[openspace]==1?' checked':''?>>
            關閉 </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">會員登陸驗證碼</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="loginkey_ok" value="1"<?=$r[loginkey_ok]==1?' checked':''?>>
            開啟 
            <input type="radio" name="loginkey_ok" value="0"<?=$r[loginkey_ok]==0?' checked':''?>>
            關閉</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">會員註冊驗證碼</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="regkey_ok" value="1"<?=$r[regkey_ok]==1?' checked':''?>>
            開啟 
            <input type="radio" name="regkey_ok" value="0"<?=$r[regkey_ok]==0?' checked':''?>>
            關閉</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">會員列表查看權限</td>
          <td height="25" bgcolor="#FFFFFF"><select name="memberlistlevel" id="memberlistlevel">
              <option value=0>遊客</option>
              <?=$memberlistlevel?>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">查看會員資料權限</td>
          <td height="25" bgcolor="#FFFFFF"><select name="showinfolevel" id="showinfolevel">
              <option value=0>遊客</option>
              <?=$showinfolevel?>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">會員列表每頁顯示</td>
          <td height="25" bgcolor="#FFFFFF"><input name="member_num" type="text" id="member_num" value="<?=$r[member_num]?>" size="38">
            個會員</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">會員空間信息每頁顯示</td>
          <td height="25" bgcolor="#FFFFFF"><input name="space_num" type="text" id="space_num" value="<?=$r[space_num]?>" size="38">
            個信息</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">會員註冊審核方式</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regacttype" type="radio" value="0"<?=$r[regacttype]==0?' checked':''?>>
            無 
            <input name="regacttype" type="radio" value="1"<?=$r[regacttype]==1?' checked':''?>>
            郵件激活</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">激活帳號鏈接有效期</td>
          <td height="25" bgcolor="#FFFFFF"><input name="acttime" type="text" id="acttime" value="<?=$r[acttime]?>" size="38">
            小時</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">帳號激活郵件內容<br> <br> <font color="#666666">[!--pageurl--]:激活地址 
            <br>
            [!--username--]:用戶名<br>
            [!--email--]:郵箱地址<br>
            [!--date--]:發送時間<br>
            [!--sitename--]:網站名稱<br>
            [!--news.url--]:網站地址</font></td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td>標題： 
                  <input name="acttitle" type="text" id="acttitle" value="<?=stripSlashes($r[acttitle])?>" size="38"></td>
              </tr>
              <tr> 
                <td><textarea name="acttext" cols="80" rows="12" style="WIDTH: 100%" id="acttext"><?=ehtmlspecialchars(stripSlashes($r[acttext]))?></textarea></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">開啟取回密碼功能</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opengetpass" value="1"<?=$r[opengetpass]==1?' checked':''?>>
            開啟 
            <input type="radio" name="opengetpass" value="0"<?=$r[opengetpass]==0?' checked':''?>>
            關閉</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">取回密碼鏈接有效期</td>
          <td height="25" bgcolor="#FFFFFF"><input name="getpasstime" type="text" id="getpasstime" value="<?=$r[getpasstime]?>" size="38">
            小時</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">取回密碼郵件內容<br> <br> <font color="#666666">[!--pageurl--]:取回地址 
            <br>
            [!--username--]:用戶名<br>
            [!--email--]:郵箱地址<br>
            [!--date--]:發送時間<br>
            [!--sitename--]:網站名稱<br>
            [!--news.url--]:網站地址 </font></td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td>標題： 
                  <input name="getpasstitle" type="text" id="getpasstitle" value="<?=stripSlashes($r[getpasstitle])?>" size="38"></td>
              </tr>
              <tr> 
                <td><textarea name="getpasstext" cols="80" rows="12" style="WIDTH: 100%" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[getpasstext]))?></textarea></td>
              </tr>
            </table></td>
        </tr>
      </table>
	  
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">訪問控制設置</td>
        </tr>
        <tr> 
          <td width="22%" height="25" valign="top" bgcolor="#FFFFFF"> <strong>禁止 
            IP 訪問列表:(前台及後台有效)</strong><br>
            每個 IP 一行，既可輸入完整地址，也可只輸入 IP 開頭，例如 &quot;192.168.&quot;(不含引號) 可匹配 192.168.0.0～192.168.255.255 
            範圍內的所有地址，留空為不設置 <br> </td>
          <td height="25" valign="top" bgcolor="#FFFFFF"> <textarea name="closeip" cols="80" rows="8" id="closeip"><?=$r[closeip]?></textarea> 
          </td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>允許 IP 訪問列表:(前台及後台有效)</strong><br>
            只有當用戶處於本列表中的 IP 地址時才可以訪問網站，列表以外的地址訪問將視為 IP 被禁止.每個 IP 一行，既可輸入完整地址，也可只輸入 
            IP 開頭，例如 &quot;192.168.&quot;(不含引號) 可匹配 192.168.0.0～192.168.255.255 
            範圍內的所有地址，留空為所有 IP 除明確禁止的以外均可訪問<br></td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="openip" cols="80" rows="8" id="textarea2"><?=$r[openip]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>允許後台 IP 訪問列表:(後台有效)<br>
            </strong>只有當管理員處於本列表中的 IP 地址時才可以訪問後台，列表以外的地址訪問將視為 IP 被禁止.每個 IP 一行，既可輸入完整地址，也可只輸入 
            IP 開頭，例如 &quot;192.168.&quot;(不含引號) 可匹配 192.168.0.0～192.168.255.255 
            範圍內的所有地址，留空為所有 IP 除明確禁止的以外均可訪問<strong> </strong></td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="hopenip" cols="80" rows="8" id="textarea3"><?=$r[hopenip]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" colspan="2" class="header">提交控制設置</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">控制動作</td>
          <td height="25" bgcolor="#FFFFFF">
<input name="doiptype[]" type="checkbox" id="doiptype[]" value="register"<?=strstr($r['doiptype'],',register,')?' checked':''?>>
            註冊 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="pl"<?=strstr($r['doiptype'],',pl,')?' checked':''?>>
            評論 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="postinfo"<?=strstr($r['doiptype'],',postinfo,')?' checked':''?>>
            投稿 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="gbook"<?=strstr($r['doiptype'],',gbook,')?' checked':''?>>
            留言 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="downinfo"<?=strstr($r['doiptype'],',downinfo,')?' checked':''?>>
            下載 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="onlineinfo"<?=strstr($r['doiptype'],',onlineinfo,')?' checked':''?>>
            在線觀看 
            <input name="doiptype[]" type="checkbox" id="doiptype[]" value="showinfo"<?=strstr($r['doiptype'],',showinfo,')?' checked':''?>>
            查看信息</td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>禁止 IP 提交列表:</strong><br>
            每個 IP 一行，既可輸入完整地址，也可只輸入 IP 開頭，例如 &quot;192.168.&quot;(不含引號) 可匹配 192.168.0.0～192.168.255.255 
            範圍內的所有地址，留空為不設置</td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="closedoip" cols="80" rows="8" id="closedoip"><?=$r[closedoip]?></textarea></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF"><strong>允許 IP 提交列表:</strong><br>
            只有當用戶處於本列表中的 IP 地址時才可以提交數據，列表以外的地址提交將視為 IP 被禁止.每個 IP 一行，既可輸入完整地址，也可只輸入 
            IP 開頭，例如 &quot;192.168.&quot;(不含引號) 可匹配 192.168.0.0～192.168.255.255 
            範圍內的所有地址，留空為所有 IP 除明確禁止的以外均可訪問</td>
          <td height="25" valign="top" bgcolor="#FFFFFF"><textarea name="opendoip" cols="80" rows="8" id="opendoip"><?=$r[opendoip]?></textarea></td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="file"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">文件設置</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "file" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">文件設置</td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">附件存放目錄</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="fpath" value="0"<?=$r[fpath]==0?' checked':''?>>
            欄目目錄 
            <input type="radio" name="fpath" value="1"<?=$r[fpath]==1?' checked':''?>>
            /d/file/p目錄 
            <input type="radio" name="fpath" value="2"<?=$r[fpath]==2?' checked':''?>>
            /d/file目錄</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><input name="filepath" type="text" id="filepath" value="<?=$r[filepath]?>" size="38"> 
            <select name="select6" onchange="document.form1.filepath.value=this.value">
              <option value="Y-m-d">選擇</option>
              <option value="Y-m-d">2005-01-27</option>
              <option value="Y/m-d">2005/01-27</option>
              <option value="Y/m/d">2005/01/27</option>
              <option value="Ymd">20050127</option>
              <option value="">不設置目錄</option>
            </select> <font color="#666666">(如Y-m-d，Y/m-d，Y/m/d，Ymd等形式)</font></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">後台上傳附件大小</td>
          <td height="25" bgcolor="#FFFFFF"><input name="filesize" type="text" id="filesize" value="<?=$r[filesize]?>" size="38">
            KB</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">後台上傳文件擴展名</td>
          <td height="25" bgcolor="#FFFFFF"><input name="filetype" type="text" id="filetype" value="<?=$filetype?>" size="38"> 
            <font color="#666666">(多個請用「|」格開，如：.gif|.jpg)</font></td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">前台投稿附件設置</td>
          <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="qaddtran" type="checkbox" value="1"<?=$r[qaddtran]==1?' checked':''?>>
                  開啟上傳圖片,最大圖片： 
                  <input name="qaddtransize" type="text" id="qaddtransize" value="<?=$r[qaddtransize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>圖片擴展名: 
                  <input name="qaddtranimgtype" type="text" value="<?=$qaddimgtype?>" size="30"> 
                  <font color="#666666"> (多個用&quot;|&quot;格開) </font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="qaddtranfile" type="checkbox" value="1"<?=$r[qaddtranfile]==1?' checked':''?>>
                  開啟上傳附件,最大附件： 
                  <input name="qaddtranfilesize" type="text" value="<?=$r[qaddtranfilesize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>附件擴展名: 
                  <input name="qaddtranfiletype" type="text" value="<?=$qaddfiletype?>" size="30"> 
                  <font color="#666666">(多個用&quot;|&quot;格開)</font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" valign="top" bgcolor="#FFFFFF">前台反饋附件設置</td>
          <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="feedbacktfile" type="checkbox" id="feedbacktfile" value="1"<?=$r[feedbacktfile]==1?' checked':''?>>
                  開啟上傳附件,最大附件： 
                  <input name="feedbackfilesize" type="text" value="<?=$r[feedbackfilesize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>附件擴展名: 
                  <input name="feedbackfiletype" type="text" value="<?=$feedbackfiletype?>" size="30"> 
                  <font color="#666666">(多個用&quot;|&quot;格開)</font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">會員表單附件設置</td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="openmembertranimg" type="checkbox" id="openmembertranimg" value="1"<?=$r[openmembertranimg]==1?' checked':''?>>
                  開啟上傳圖片,最大圖片： 
                  <input name="memberimgsize" type="text" id="memberimgsize" value="<?=$r[memberimgsize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>圖片擴展名: 
                  <input name="memberimgtype" type="text" id="memberimgtype" value="<?=$memberimgtype?>" size="30"> 
                  <font color="#666666"> (多個用&quot;|&quot;格開) </font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><input name="openmembertranfile" type="checkbox" id="openmembertranfile" value="1"<?=$r[openmembertranfile]==1?' checked':''?>>
                  開啟上傳附件,最大附件： 
                  <input name="memberfilesize" type="text" id="memberfilesize" value="<?=$r[memberfilesize]?>" size="6">
                  KB </td>
              </tr>
              <tr> 
                <td>附件擴展名: 
                  <input name="memberfiletype" type="text" id="memberfiletype" value="<?=$memberfiletype?>" size="30"> 
                  <font color="#666666">(多個用&quot;|&quot;格開)</font></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">會員附件字段支持填寫</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="modmemberedittran" value="1"<?=$r[modmemberedittran]==1?' checked':''?>>是
              <input type="radio" name="modmemberedittran" value="0"<?=$r[modmemberedittran]==0?' checked':''?>>否
          </td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">投稿附件字段支持填寫</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="modinfoedittran" value="1"<?=$r[modinfoedittran]==1?' checked':''?>>是
              <input type="radio" name="modinfoedittran" value="0"<?=$r[modinfoedittran]==0?' checked':''?>>否
          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">文件生成權限</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="filechmod" value="0"<?=$r[filechmod]==0?' checked':''?>>
            0777 
            <input type="radio" name="filechmod" value="1"<?=$r[filechmod]==1?' checked':''?>>
            不限制</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">廣告JS文件前綴</td>
          <td height="25" bgcolor="#FFFFFF"><input name="adfile" type="text" id="adfile" value="<?=$r[adfile]?>" size="38">
		  <iframe name="checkftpiframe" style="display: none" src="blank.php"></iframe></td>
        </tr>
        <tbody id="setfileserver" style="display:none">
        </tbody>
      </table>
		<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">備份設置</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">數據備份存放目錄</td>
          <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
            <input name="bakdbpath" type="text" id="bakdbpath" value="<?=$r[bakdbpath]?>"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">壓縮包存放目錄</td>
          <td height="25" bgcolor="#FFFFFF">admin/ebak/ 
            <input name="bakdbzip" type="text" id="bakdbzip" value="<?=$r[bakdbzip]?>"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">備份只選擇當前數據庫</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ebakthisdb" type="checkbox" id="ebakthisdb" value="1"<?=$r[ebakthisdb]==1?' checked':''?>>
            是</td>
        </tr>
		<tr>
          <td height="25" bgcolor="#FFFFFF">空間不支持數據庫列表</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ebakcanlistdb" type="checkbox" id="ebakcanlistdb" value="1"<?=$r[ebakcanlistdb]==1?' checked':''?>>
            是<font color="#666666">(如果空間不允許列出數據庫,請打勾)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">支持MYSQL查詢方式</td>
          <td height="25" bgcolor="#FFFFFF"><input name="limittype" type="checkbox" id="limittype" value="1"<?=$r[limittype]==1?' checked':''?>>
            支持</td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="dojs"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">JS設置</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "dojs" ) );</script>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="2">信息排行設置(JS)</td>
    </tr>
    <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">熱門信息顯示</td>
      <td height="25" bgcolor="#FFFFFF"><input name="hotnum" type="text" id="hotnum" value="<?=$r[hotnum]?>" size="38">
            條信息</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">最新信息顯示</td>
      <td height="25" bgcolor="#FFFFFF"><input name="newnum" type="text" id="newnum" value="<?=$r[newnum]?>" size="38">
            條信息</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">推薦信息顯示</td>
      <td height="25" bgcolor="#FFFFFF"><input name="goodnum" type="text" id="goodnum" value="<?=$r[goodnum]?>" size="38">
            條信息</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">熱門評論顯示</td>
      <td height="25" bgcolor="#FFFFFF"><input name="hotplnum" type="text" id="hotplnum" value="<?=$r[hotplnum]?>" size="38">
            條信息</td>
    </tr>
    <tr> 
          <td height="25" bgcolor="#FFFFFF">頭條信息顯示</td>
      <td height="25" bgcolor="#FFFFFF"><input name="firstnum" type="text" id="firstnum" value="<?=$r[firstnum]?>" size="38">
            條信息</td>
    </tr>
  </table>
	</div>
	  
    <div class="tab-page" id="rehtml"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">分組生成</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "rehtml" ) );</script>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">分組生成設置（依服務器配置設置大小）</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">每組生成間隔</td>
          <td height="25" bgcolor="#FFFFFF"><input name="realltime" type="text" id="realltime" value="<?=$r[realltime]?>" size="38">
            秒<font color="#666666">(0為連續生成)</font></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">欄目生成每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="relistnum" type="text" id="relistnum" value="<?=$r[relistnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">信息生成每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="renewsnum" type="text" id="renewsnum" value="<?=$r[renewsnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">更新相關鏈接每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="infolinknum" type="text" id="infolinknum" value="<?=$r[infolinknum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">生成自定義JS每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="reuserjsnum" type="text" id="reuserjsnum" value="<?=$r[reuserjsnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">生成自定義列表每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="reuserlistnum" type="text" id="reuserlistnum" value="<?=$r[reuserlistnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">自定義頁面每組</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="reuserpagenum" type="text" id="reuserpagenum" value="<?=$r[reuserpagenum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">投票JS每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="revotejsnum" type="text" id="revotejsnum" value="<?=$r[revotejsnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">廣告JS每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="readjsnum" type="text" id="readjsnum" value="<?=$r[readjsnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">替換字段值每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dorepnum" type="text" id="dorepnum" value="<?=$r[dorepnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">替換地址權限每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dorepdlevelnum" type="text" id="dorepdlevelnum" value="<?=$r[dorepdlevelnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">批量刪除信息每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="delnewsnum" type="text" id="delnewsnum" value="<?=$r[delnewsnum]?>" size="38">
            個</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">批量歸檔信息每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="docnewsnum" type="text" id="docnewsnum" value="<?=$r[docnewsnum]?>" size="38">
            個</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">導入欄目模板每組</td>
          <td height="25" bgcolor="#FFFFFF"><input name="loadtempnum" type="text" id="loadtempnum" value="<?=$r[loadtempnum]?>" size="38">
            個</td>
        </tr>
      </table>
  </div>
    <div class="tab-page" id="setsearch"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">搜索設置</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "setsearch" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">搜索設置</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">搜索用戶組</td>
          <td height="25" bgcolor="#FFFFFF"><select name="searchgroupid" id="searchgroupid">
              <option value=0>遊客</option>
              <?=$searchmembergroup?>
            </select></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">搜索關鍵字</td>
          <td height="25" bgcolor="#FFFFFF">在 
            <input name="min_keyboard" type="text" id="min_keyboard" value="<?=$r[min_keyboard]?>" size="6">
            個字符與 
            <input name="max_keyboard" type="text" id="max_keyboard" value="<?=$r[max_keyboard]?>" size="6">
            個字符之間</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">搜索時間間隔</td>
          <td height="25" bgcolor="#FFFFFF">在 
            <input name="searchtime" type="text" id="searchtime" value="<?=$r[searchtime]?>" size="6">
            秒</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">頁面顯示</td>
          <td height="25" bgcolor="#FFFFFF">每頁 
            <input name="search_num" type="text" id="search_num" value="<?=$r[search_num]?>" size="6">
            顯示條記錄， 
            <input name="search_pagenum" type="text" id="search_pagenum" value="<?=$r[search_pagenum]?>" size="6">
            個分頁鏈接<font color="#666666">(為0的話，系統默認25條，12個鏈接)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">支持公共模板變量</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="searchtempvar" value="0"<?=$r['searchtempvar']==0?' checked':''?>>
            不支持 
            <input type="radio" name="searchtempvar" value="1"<?=$r['searchtempvar']==1?' checked':''?>>
            支持<font color="#666666">(搜索模板及動態頁面)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">高級搜索頁擴展名</td>
          <td height="25" bgcolor="#FFFFFF"><input name="searchtype" type="text" id="searchtype" value="<?=$r[searchtype]?>" size="10"> 
            <font color="#666666"> 
            <select name="select2" onchange="document.form1.searchtype.value=this.value">
              <option value=".html">擴展名</option>
              <option value=".html">.html</option>
              <option value=".htm">.htm</option>
              <option value=".php">.php</option>
              <option value=".shtml">.shtml</option>
            </select>
            (如：.html,.htm,.xml,.php)</font></td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="donews"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">信息設置</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "donews" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">信息設置</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">後台管理信息</td>
          <td height="25" bgcolor="#FFFFFF">每頁顯示 
            <input name="hlistinfonum" type="text" id="hlistinfonum" value="<?=$r[hlistinfonum]?>">
            個信息</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">前台結合項列表</td>
          <td height="25" bgcolor="#FFFFFF">每頁顯示 
            <input name="qlistinfonum" type="text" id="qlistinfonum" value="<?=$r[qlistinfonum]?>">
            個信息</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">後台信息默認顯示時間範圍</td>
          <td height="25" bgcolor="#FFFFFF"><select name="infolday" id="infolday">
              <option value="0"<?=$r['infolday']==0?' selected':''?>>全部顯示</option>
              <option value="86400"<?=$r['infolday']==86400?' selected':''?>>1 
              天</option>
              <option value="172800"<?=$r['infolday']==172800?' selected':''?>>2 
              天</option>
              <option value="604800"<?=$r['infolday']==604800?' selected':''?>>一周</option>
              <option value="2592000"<?=$r['infolday']==2592000?' selected':''?>>1 
              個月</option>
              <option value="7948800"<?=$r['infolday']==7948800?' selected':''?>>3 
              個月</option>
              <option value="15897600"<?=$r['infolday']==15897600?' selected':''?>>6 
              個月</option>
              <option value="31536000"<?=$r['infolday']==31536000?' selected':''?>>1 
              年</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">後台附件默認顯示時間範圍</td>
          <td height="25" bgcolor="#FFFFFF"><select name="filelday" id="filelday">
              <option value="0"<?=$r['filelday']==0?' selected':''?>>全部顯示</option>
              <option value="86400"<?=$r['filelday']==86400?' selected':''?>>1 
              天</option>
              <option value="172800"<?=$r['filelday']==172800?' selected':''?>>2 
              天</option>
              <option value="604800"<?=$r['filelday']==604800?' selected':''?>>一周</option>
              <option value="2592000"<?=$r['filelday']==2592000?' selected':''?>>1 
              個月</option>
              <option value="7948800"<?=$r['filelday']==7948800?' selected':''?>>3 
              個月</option>
              <option value="15897600"<?=$r['filelday']==15897600?' selected':''?>>6 
              個月</option>
              <option value="31536000"<?=$r['filelday']==31536000?' selected':''?>>1 
              年</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">信息置頂設置</td>
          <td height="25" bgcolor="#FFFFFF"><select name="settop" id="settop">
              <option value="0"<?=$r[settop]==0?' selected':''?>>不使用置頂</option>
              <option value="1"<?=$r[settop]==1?' selected':''?>>欄目列表置頂</option>
              <option value="2"<?=$r[settop]==2?' selected':''?>>標籤調用置頂</option>
              <option value="3"<?=$r[settop]==3?' selected':''?>>JS調用置頂</option>
              <option value="4"<?=$r[settop]==4?' selected':''?>>欄目/標籤/JS置頂</option>
              <option value="5"<?=$r[settop]==5?' selected':''?>>欄目/標籤置頂</option>
              <option value="6"<?=$r[settop]==6?' selected':''?>>欄目/JS置頂</option>
              <option value="7"<?=$r[settop]==7?' selected':''?>>標籤/JS置頂</option>
            </select></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fieldandtop" type="checkbox" id="fieldandtop" value="1"<?=$r[fieldandtop]==1?' checked':''?>>
            結合項支持置頂</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">結合項不啟用的表</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fieldandclosetb" type="text" id="fieldandclosetb" value="<?=substr($r[fieldandclosetb],1,strlen($r[fieldandclosetb])-2)?>" size="38"> 
            <font color="#666666">(多個表名用半角逗號隔開，如：news,download)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">動態列表支持標籤</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="dtcanbq" value="0"<?=$r[dtcanbq]==0?' checked':''?>>
            不支持 
            <input type="radio" name="dtcanbq" value="1"<?=$r[dtcanbq]==1?' checked':''?>>
            支持</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">動態列表變量緩存</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dtcachetime" type="text" id="dtcachetime" value="<?=$r[dtcachetime]?>" size="38">
            分鐘</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">動態內容頁支持標籤</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="dtncanbq" value="0"<?=$r[dtncanbq]==0?' checked':''?>>
            不支持 
            <input type="radio" name="dtncanbq" value="1"<?=$r[dtncanbq]==1?' checked':''?>>
            支持</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">動態內容頁變量緩存</td>
          <td height="25" bgcolor="#FFFFFF"><input name="dtncachetime" type="text" id="dtncachetime" value="<?=$r[dtncachetime]?>" size="38">
            分鐘</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">新會員投稿限制</td>
          <td height="25" bgcolor="#FFFFFF">最新註冊會員必須過 
            <input name="newaddinfotime" type="text" id="newaddinfotime" value="<?=$r[newaddinfotime]?>" size="6">
            分鐘才能投稿 <font color="#666666">(0為不限制)</font></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">投稿數量限制</td>
          <td height="25" bgcolor="#FFFFFF">同一個IP在
            <input name="ipaddinfotime" type="text" id="ipaddinfotime" value="<?=$r[ipaddinfotime]?>" size="6">
          個小時內最大只允許增加
          <input name="ipaddinfonum" type="text" id="ipaddinfonum" value="<?=$r[ipaddinfonum]?>" size="6">
          個信息<font color="#666666">(0為不限，且模型要增加infoip字段)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">重複投稿時間限制</td>
          <td height="25" bgcolor="#FFFFFF"><input name="readdinfotime" type="text" id="readdinfotime" value="<?=$r[readdinfotime]?>" size="38">
            秒</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">投稿信息修改時間限制：</td>
          <td height="25" bgcolor="#FFFFFF"><input name="qeditinfotime" type="text" id="qeditinfotime" value="<?=$r[qeditinfotime]?>" size="38">
            分鐘<font color="#666666">(0為不限制)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">投稿管理信息顯示方式：</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="qlistinfomod" value="0"<?=$r[qlistinfomod]==0?' checked':''?>>
            按表顯示 
            <input type="radio" name="qlistinfomod" value="1"<?=$r[qlistinfomod]==1?' checked':''?>>
            按模型顯示 <font color="#666666">(按模型顯示影響效率)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">欄目導航分隔字符</td>
          <td height="25" bgcolor="#FFFFFF"><input name="classnavfh" type="text" id="navfh3" value="<?=ehtmlspecialchars($r[classnavfh])?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">欄目導航顯示個數</td>
          <td height="25" bgcolor="#FFFFFF"><input name="classnavline" type="text" id="classnavline" value="<?=$r[classnavline]?>" size="38"> 
            <font color="#666666">(0為不限)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">所在位置導航分隔字符</td>
          <td height="25" bgcolor="#FFFFFF"><input name="navfh" type="text" id="navfh" value="<?=$r[navfh]?>" size="38"> 
            <font color="#666666">(如:「首頁 &gt; 新聞」中的「&gt;」)</font></td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">信息簡介截取</td>
          <td height="25" bgcolor="#FFFFFF"> <input name="smalltextlen" type="text" id="smalltextlen" value="<?=$r[smalltextlen]?>" size="38">
            個字<font color="#666666"> (簡介為空時，截取信息內容)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">相關鏈接依據</td>
          <td height="25" bgcolor="#FFFFFF"><select name="newslink" id="newslink">
              <option value="0"<?=$r['newslink']==0?' selected':''?>>標題包含關鍵字</option>
              <option value="1"<?=$r['newslink']==1?' selected':''?>>關鍵字相同</option>
              <option value="2"<?=$r['newslink']==2?' selected':''?>>標題包含與關鍵字相同</option>
            </select> </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">增加信息隨機點擊數範圍</td>
          <td height="25" bgcolor="#FFFFFF"><input name="onclickrnd" type="text" id="onclickrnd" value="<?=$r[onclickrnd]?>" size="38"> 
            <font color="#666666">(格式:「最小數,最大數」，空表示不使用。例子：20,100)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">開啟信息內容過濾字符替換</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="dorepword" value="0"<?=$r['dorepword']==0?' checked':''?>>
            生成頁面時替換 
            <input type="radio" name="dorepword" value="1"<?=$r['dorepword']==1?' checked':''?>>
            增加信息時替換 
            <input type="radio" name="dorepword" value="2"<?=$r['dorepword']==2?' checked':''?>>
            關閉替換<font color="#666666"> (關閉替換效率高)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">開啟信息內容關鍵字替換</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="dorepkey" value="0"<?=$r['dorepkey']==0?' checked':''?>>
            生成頁面時替換 
            <input type="radio" name="dorepkey" value="1"<?=$r['dorepkey']==1?' checked':''?>>
            增加信息時替換 
            <input type="radio" name="dorepkey" value="2"<?=$r['dorepkey']==2?' checked':''?>>
            關閉替換<font color="#666666"> (關閉替換效率高)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">信息內容關鍵字重複替換</td>
          <td height="25" bgcolor="#FFFFFF"><input name="repkeynum" type="text" id="repkeynum" value="<?=$r[repkeynum]?>" size="38">
            次<font color="#666666"> (0為不限,效率高；限制替換次數會影響生成效率。)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">反饋驗證碼</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="fbkey_ok" value="1"<?=$r[fbkey_ok]==1?' checked':''?>>
            開啟 
            <input type="radio" name="fbkey_ok" value="0"<?=$r[fbkey_ok]==0?' checked':''?>>
            關閉 </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">留言驗證碼</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="gbkey_ok" value="1"<?=$r[gbkey_ok]==1?' checked':''?>>
            開啟 
            <input type="radio" name="gbkey_ok" value="0"<?=$r[gbkey_ok]==0?' checked':''?>>
            關閉 </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">重複留言時間限制</td>
          <td height="25" bgcolor="#FFFFFF"><input name="regbooktime" type="text" id="regbooktime" value="<?=$r[regbooktime]?>" size="38">
            秒</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">重複投票時間限制</td>
          <td height="25" bgcolor="#FFFFFF"><input name="revotetime" type="text" id="revotetime" value="<?=$r[revotetime]?>" size="38">
            秒</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">留言每頁顯示</td>
          <td height="25" bgcolor="#FFFFFF"><input name="gb_num" type="text" id="gb_num" value="<?=$r[gb_num]?>" size="38">
            個留言</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">模板備份記錄數</td>
          <td height="25" bgcolor="#FFFFFF"><input name="baktempnum" type="text" id="baktempnum" value="<?=$r[baktempnum]?>" size="38"> 
            <font color="#666666">(0為不備份)</font></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">關閉動態使用的列表模板ID</td>
          <td height="25" bgcolor="#FFFFFF"><input name="closelisttemp" type="text" id="closelisttemp" value="<?=$r[closelisttemp]?>" size="38">
            <input type="button" name="Submit6222" value="管理列表模板" onclick="window.open('template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"> 
            <font color="#666666">(多個ID用半角逗號「,」隔開)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">模板支持程序代碼</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="candocode" value="1"<?=$r[candocode]==1?' checked':''?>>
            開啟 
            <input type="radio" name="candocode" value="0"<?=$r[candocode]==0?' checked':''?>>
            關閉</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">防採集</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opennotcj" value="1"<?=$r[opennotcj]==1?' checked':''?>>
            開啟 
            <input type="radio" name="opennotcj" value="0"<?=$r[opennotcj]==0?' checked':''?>>
            關閉</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">內容防複製</td>
          <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="opencopytext" value="1"<?=$r[opencopytext]==1?' checked':''?>>
            開啟 
            <input type="radio" name="opencopytext" value="0"<?=$r[opencopytext]==0?' checked':''?>>
            關閉<font color="#666666"> (內容隨機字符)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">列表分頁函數(下拉)</td>
          <td height="25" bgcolor="#FFFFFF"><input name="listpagefun" type="text" id="listpagefun" value="<?=$r[listpagefun]?>" size="38"> 
            <font color="#666666"> (可加到e/class/userfun.php文件裡)</font></td>
        </tr>
        <tr> 
          <td rowspan="2" valign="top" bgcolor="#FFFFFF">列表分頁函數(列表)</td>
          <td height="25" bgcolor="#FFFFFF"><input name="listpagelistfun" type="text" id="listpagelistfun" value="<?=$r[listpagelistfun]?>" size="38"> 
            <font color="#666666">(可加到e/class/userfun.php文件裡)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">每頁顯示 
            <input name="listpagelistnum" type="text" id="listpagelistnum" value="<?=$r[listpagelistnum]?>" size="6">
            個頁碼</td>
        </tr>
        <tr> 
          <td height="25" rowspan="2" bgcolor="#FFFFFF">內容分頁函數</td>
          <td height="12" bgcolor="#FFFFFF"><input name="textpagefun" type="text" id="textpagefun" value="<?=$r[textpagefun]?>" size="38"> 
            <font color="#666666">(可加到e/class/userfun.php文件裡)</font></td>
        </tr>
        <tr> 
          <td height="12" bgcolor="#FFFFFF">每頁顯示 
            <input name="textpagelistnum" type="text" id="textpagelistnum" value="<?=$r[textpagelistnum]?>" size="6">
            個頁碼</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">RSS/XML設置</td>
          <td height="25" bgcolor="#FFFFFF">顯示最新 
            <input name="rssnum" type="text" id="rssnum" value="<?=$r[rssnum]?>" size="6">
            條記錄，簡介截取 
            <input name="rsssub" type="text" id="rsssub" value="<?=$r[rsssub]?>" size="6">
            個字</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">點擊統計設置</td>
          <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25">類型： 
                  <select name="onclicktype" id="onclicktype">
                    <option value="0"<?=$r[onclicktype]==0?' selected':''?>>實時統計</option>
                    <option value="1"<?=$r[onclicktype]==1?' selected':''?>>文本緩存</option>
                    <option value="2"<?=$r[onclicktype]==2?' selected':''?>>不統計</option>
                  </select></td>
              </tr>
              <tr> 
                <td height="25">文本緩存最大文件： 
                  <input name="onclickfilesize" type="text" id="onclickfilesize" value="<?=$r[onclickfilesize]?>" size="38">
                  KB</td>
              </tr>
              <tr> 
                <td height="25">文本緩存最長時間： 
                  <input name="onclickfiletime" type="text" id="onclickfiletime" value="<?=$r[onclickfiletime]?>" size="38">
                  分鐘</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">信息外部鏈接設置</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opentitleurl" value="0"<?=$r[opentitleurl]==0?' checked':''?>>
            統計點擊 
            <input type="radio" name="opentitleurl" value="1"<?=$r[opentitleurl]==1?' checked':''?>>
            顯示原鏈接</td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">選擇終極欄目的背景顏色</td>
          <td height="25" bgcolor="#FFFFFF"><input name="chclasscolor" type="text" id="chclasscolor" value="<?=$r[chclasscolor]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">九級頭條名稱</td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="firsttitlename" cols="80" rows="8" id="firsttitlename"><?=str_replace("|","\r\n",$r[firsttitlename])?></textarea></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">九級推薦名稱</td>
          <td height="25" bgcolor="#FFFFFF"><textarea name="isgoodname" cols="80" rows="8" id="isgoodname"><?=str_replace("|","\r\n",$r[isgoodname])?></textarea></td>
        </tr>
      </table>
	</div>
	  
    <div class="tab-page" id="doftp"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">FTP/EMAIL</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "doftp" ) );</script>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">發送郵件設置</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">郵件發送模式</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="sendmailtype" value="0"<?=$r[sendmailtype]==0?' checked':''?>>
            mail 函數發送 
            <input type="radio" name="sendmailtype" value="1"<?=$r[sendmailtype]==1?' checked':''?>>
            SMTP 模塊發送</td>
        </tr>
        <tr> 
          <td height="25" colspan="2" bgcolor="#FFFFFF"><strong>SMTP 模塊發送設置</strong></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">SMTP服務器</td>
          <td height="25" bgcolor="#FFFFFF"><input name="smtphost" type="text" id="smtphost" value="<?=$r[smtphost]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">SMTP端口</td>
          <td height="25" bgcolor="#FFFFFF"><input name="smtpport" type="text" id="smtpport" value="<?=$r[smtpport]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">發信人地址</td>
          <td height="25" bgcolor="#FFFFFF"><input name="fromemail" type="text" id="fromemail" value="<?=$r[fromemail]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">發信人呢稱</td>
          <td height="25" bgcolor="#FFFFFF"><input name="emailname" type="text" id="emailname" value="<?=$r[emailname]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">是否需要登錄驗證</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="loginemail" value="1"<?=$r[loginemail]==1?' checked':''?>>
            是 
            <input type="radio" name="loginemail" value="0"<?=$r[loginemail]==0?' checked':''?>>
            否</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">郵箱登錄用戶名</td>
          <td height="25" bgcolor="#FFFFFF"><input name="emailusername" type="text" id="emailusername" value="<?=$r[emailusername]?>" size="38"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">郵箱登錄密碼</td>
          <td height="25" bgcolor="#FFFFFF"><input name="emailpassword" type="password" id="emailpassword" value="<?=$r[emailpassword]?>" size="38"></td>
        </tr>
        <tr class="header"> 
          <td height="25" colspan="2">FTP設置(遠程發佈 / PHP運行於安全模式等情況下需設置以下選項)</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">PHP運行於安全模式</td>
          <td height="25" bgcolor="#FFFFFF"><input name="phpmode" type="checkbox" id="phpmode" value="1"<?=$r[phpmode]==1?' checked':''?>>
            是</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">安裝形式</td>
          <td height="25" bgcolor="#FFFFFF"><select name="install" id="select">
              <option value="0"<?=$r[install]==0?' selected':''?>>服務端</option>
              <option value="1"<?=$r[install]==1?' selected':''?>>客戶端</option>
            </select> <font color="#666666">(如是遠程發佈，請選客戶端，並且需配置FTP選項)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">啟用 SSL 連接</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ftpssl" value="1"<?=$r[ftpssl]==1?' checked':''?>>
            是 
            <input type="radio" name="ftpssl" value="0"<?=$r[ftpssl]==0?' checked':''?>>
            否 </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">被動模式(pasv)連接</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ftppasv" value="1"<?=$r[ftppasv]==1?' checked':''?>>
            是 
            <input type="radio" name="ftppasv" value="0"<?=$r[ftppasv]==0?' checked':''?>>
            否 </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP服務器地址</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftphost" type="text" id="ftphost" value="<?=$r[ftphost]?>" size="38">
            端口： 
            <input name="ftpport" type="text" id="ftpport" value="<?=$r[ftpport]?>" size="4"></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP用戶名</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftpusername" type="text" id="ftpusername" value="<?=$r[ftpusername]?>" size="38"> 
          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP密碼</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftppassword" type="password" size="38">
            <font color="#666666">(不修改密碼請留空) </font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">傳送模式</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ftpmode" value="1"<?=$r[ftpmode]==1?' checked':''?>>
            ASCII 
            <input type="radio" name="ftpmode" value="0"<?=$r[ftpmode]==0?' checked':''?>>
            二進制</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">FTP 傳輸超時時間</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftpouttime" type="text" id="ftpouttime" value="<?=$r[ftpouttime]?>" size="38">
            秒<font color="#666666">(0為服務器默認)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">系統根目錄(FTP)</td>
          <td height="25" bgcolor="#FFFFFF"><input name="ftppath" type="text" value="<?=$r[ftppath]?>" size="38"> 
            <font color="#666666">(目錄結尾不要加斜槓「/」，空為根目錄)</font></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#FFFFFF">測試FTP服務器</td>
          <td height="25" bgcolor="#FFFFFF"><input type="submit" name="Submit32" value="測試FTP服務器" onClick="document.form1.enews.value='CheckPostServerFtp';document.form1.action='SetEnews.php';document.form1.target='checkftpiframe';">
            <font color="#666666">(無需保存設置即可測試，請在測試通過後再保存)</font></td>
        </tr>
      </table>
	</div>
	
	<div class="tab-page" id="dom"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">模型設置</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "dom" ) );</script>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">信息投稿屏蔽設置</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="22%" height="25" valign="top"><strong>屏蔽字段</strong><br>
            多個用「|」格開，如「title|newstext」<br>
            <br>
            <a href="db/ListTable.php<?=$ecms_hashur['whehref']?>" target="_blank"><font color="#666666">[點擊查看字段]</font></a></td>
          <td><textarea name="closewordsf" cols="80" rows="5"><?=$r[closewordsf]?></textarea></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25" valign="top">
<strong>屏蔽字符列表</strong><br>
            (1)、多個用「|」隔開，如「字符1|字符2」 。<br>
            (2)、同時包含多字時屏蔽可用雙「#」隔開，如「破##解|字符2」 。這樣只要內容同時包含「破」和「解」字都會被屏蔽。</td>
          <td><textarea name="closewords" cols="80" rows="8"><?=$r[closewords]?></textarea></td>
        </tr>
      </table>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">新聞/下載/電影/商城等模型設置</td>
        </tr>
		<tr>
          <td height="25" bgcolor="#FFFFFF">關閉後台菜單</td>
          <td height="25" bgcolor="#FFFFFF"><input name="closehmenu[]" type="checkbox" id="closehmenu[]" value="shop"<?=stristr($r['closehmenu'],',shop,')?' checked':''?>>
          商城</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">同一地址下載/觀看超過</td>
          <td height="25" bgcolor="#FFFFFF"><input name="redodown" type="text" id="redodown" value="<?=$r[redodown]?>" size="38">
            個小時 將重複扣點</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">同一信息查看超過</td>
          <td height="25" bgcolor="#FFFFFF"><input name="redoview" type="text" id="redoview" value="<?=$r[redoview]?>" size="38">
            個小時 將重複扣點</td>
        </tr>
        <tr> 
          <td width="22%" height="25" bgcolor="#FFFFFF">下載驗證碼</td>
          <td height="25" bgcolor="#FFFFFF"><input name="downpass" type="text" id="downpass" value="<?=$r[downpass]?>" size="38"> 
            <font color="#666666">(主要用於防盜鏈,請定期更新一次密碼)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">開啟直接下載</td>
          <td height="25" bgcolor="#FFFFFF"><input type="radio" name="opengetdown" value="1"<?=$r[opengetdown]==1?' checked':''?>>
            是 
            <input type="radio" name="opengetdown" value="0"<?=$r[opengetdown]==0?' checked':''?>>
            否</td>
        </tr>
      </table>
    </div>
	<div class="tab-page" id="doimage"> 
      <h2 class="tab">&nbsp;<font class="tabcolor">圖片設置</font>&nbsp;</h2>
                    <script type="text/javascript">tb1.addTabPage( document.getElementById( "doimage" ) );</script>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">圖片縮略圖設置</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="22%" height="25">默認值</td>
          <td>寬: 
            <input name="spicwidth" type="text" id="spicwidth" value="<?=$r[spicwidth]?>" size="6">
            ×高: 
            <input name="spicheight" type="text" id="spicheight" value="<?=$r[spicheight]?>" size="6"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">超出部分是否截取</td>
          <td><input type="radio" name="spickill" value="1"<?=$r['spickill']==1?' checked':''?>>
            是 
            <input type="radio" name="spickill" value="0"<?=$r['spickill']==0?' checked':''?>>
            否</td>
        </tr>
      </table>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">圖片水印設置(不想用圖片水印，請留空)</td>
        </tr>
        <tr> 
          <td width="22%" height="25" valign="top" bgcolor="#FFFFFF">水印位置</td>
          <td height="25" bgcolor="#FFFFFF"> <table width="200" border="0" cellpadding="6" cellspacing="1" bgcolor="#CCCCCC">
              <tr bgcolor="#FFFFFF"> 
                <td rowspan="3"> <div align="center"> 
                    <input type="radio" name="markpos" value="0"<?=$r[markpos]==0?' checked':'';?>>
                    <br>
                    隨機 </div></td>
                <td> <div align="center"> 
                    <input type="radio" name="markpos" value="1"<?=$r[markpos]==1?' checked':'';?>>
                  </div></td>
                <td> <div align="center"> 
                    <input type="radio" name="markpos" value="2"<?=$r[markpos]==2?' checked':'';?>>
                  </div></td>
                <td> <div align="center"> 
                    <input type="radio" name="markpos" value="3"<?=$r[markpos]==3?' checked':'';?>>
                  </div></td>
              </tr>
              <tr> 
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="4"<?=$r[markpos]==4?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="5"<?=$r[markpos]==5?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="6"<?=$r[markpos]==6?' checked':'';?>>
                  </div></td>
              </tr>
              <tr> 
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="7"<?=$r[markpos]==7?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="8"<?=$r[markpos]==8?' checked':'';?>>
                  </div></td>
                <td bgcolor="#FFFFFF"> <div align="center"> 
                    <input type="radio" name="markpos" value="9"<?=$r[markpos]==9?' checked':'';?>>
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td rowspan="4" valign="top" bgcolor="#FFFFFF">文字水印</td>
          <td height="25" bgcolor="#FFFFFF">文字內容 
            <input name="marktext" type="text" id="marktext" value="<?=$r[marktext]?>"> 
            <font color="#666666">(目前不支持中文)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">文字字體 
            <input name="markfont" type="text" id="markfont" value="<?=$r[markfont]?>"> 
            <font color="#666666">(從後台開始算，如../data就是data目錄)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">文字顏色 
            <input name="markfontcolor" type="text" id="markfontcolor" value="<?=$r[markfontcolor]?>"> 
            <a onclick="foreColor(document.form1.markfontcolor);"><img src="../data/images/color.gif" width="21" height="21" align="absbottom"></a> 
          </td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">文字大小 
            <input name="markfontsize" type="text" value="<?=$r[markfontsize]?>"> 
            <font color="#666666">(1~5之間的數字)</font> </td>
        </tr>
        <tr> 
          <td rowspan="3" valign="top" bgcolor="#FFFFFF">圖片水印</td>
          <td height="25" bgcolor="#FFFFFF"> 圖片文件 
            <input name="markimg" type="text" id="markimg" value="<?=$r[markimg]?>"> 
            <font color="#666666">(從後台開始算，如../data就是data目錄)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">圖片質量 
            <input name="jpgquality" type="text" id="jpgquality" value="<?=$r[jpgquality]?>"> 
            <font color="#666666">(該值決定 jpg 格式圖片的質量，範圍從 0 到 100)</font></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">水印透明度 
            <input name="markpct" type="text" id="markpct" value="<?=$r[markpct]?>"> 
            <font color="#666666">(該值決定圖片水印清晰度，其值範圍從 0 到 100)</font></td>
        </tr>
      </table>
	</div>
	
	
	</div>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr> 
        <td height="25" bgcolor="#FFFFFF"> <div align="center">
            <input type="submit" name="Submit" value=" 設置 " onClick="document.form1.enews.value='SetEnews';document.form1.action='SetEnews.php';document.form1.target='';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" name="Submit2" value=" 重置 ">
          </div></td>
      </tr>
    </table>
</form>
<?=$hiddenfileserver?>
</body>
</html>
