<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

define('InEmpireCMS',TRUE);

//導入文件
require('data/fun.php');
require('../class/EmpireCMS_version.php');

//------ 參數開始 ------

$char_r=array();
$char_r=InstallReturnDbChar();
$version="7.2,1421510410";
$dbchar=$char_r['dbchar'];
$setchar=$char_r['setchar'];
$headerchar=$char_r['headerchar'];

//------ 參數結束 ------

@header('Content-Type: text/html; charset='.$headerchar);

if(file_exists("install.off"))
{
	echo"《帝國網站管理系統》安裝程序已鎖定。如果要重新安裝，請刪除<b>/e/install/install.off</b>文件！";
	exit();
}

$enews=$_GET['enews'];
if(empty($enews))
{
	$enews=$_POST['enews'];
}
//測試採集
if($enews=="TestCj")
{
	echo"<title>TEST</title>";
	TestCj();
}
$ok=$_GET['ok'];
if(empty($ok))
{
	$ok=$_POST['ok'];
}
$f=$_GET['f'];
if(empty($f))
{
	$f=$_POST['f'];
}
if(empty($f))
{
	$f=1;
}
$font="f".$f;
$$font="red";
//處理
if($enews=="setdb"&&$ok)
{
	SetDb($_POST);
}
elseif($enews=="firstadmin"&&$ok)
{
	FirstAdmin($_POST);
}
elseif($enews=="defaultdata"&&$ok)
{
	InstallDefaultData($_GET);
}
elseif($enews=="templatedata"&&$ok)
{
	InstallTemplateData($_GET);
}
elseif($enews=="moddata"&&$ok)
{
	InstallModData($_GET);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>帝國網站管理系統安裝程序 - Powered by EmpireCMS</title>

<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="C9F1FF" leftmargin="0" topmargin="0">
<table width="776" height="100%" border="0" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF">
  <tr> 
    <td height="56" colspan="2" background="images/topbg.gif"> 
      <div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="80%"><div align="center"><img src="images/installsay.gif" width="500" height="50"></div></td>
            <td width="20%" valign="bottom"><font color="#FFFFFF">最後更新: <?php echo EmpireCMS_LASTTIME;?></font></td>
          </tr>
        </table>
        
      </div></td>
  </tr>
  <tr> 
    <td width="21%" rowspan="3" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><div align="center"><a href="http://www.phome.net" target="_blank"><img src="images/logo.gif" width="170" height="72" border="0"></a></div></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <div align="left"><strong><font color="#FFFFFF">版權信息</font></strong></div></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="34%" height="25">軟件名稱</td>
          <td width="66%" height="25">帝國網站管理系統</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">英文名稱</td>
          <td height="25">EmpireCMS</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">程序版本</td>
          <td height="25">Version 7.2 </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">開發團隊</td>
          <td height="25">帝國軟件開發團隊</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">公司名稱</td>
          <td height="25">漳州市薌城帝興軟件開發有限公司</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">官方網站</td>
          <td height="25"><a href="http://www.PHome.Net" target="_blank">www.PHome.Net</a></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><strong><font color="#FFFFFF">安裝進程</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f1;?>">閱讀用戶使用條款</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f2;?>">檢測運行環境</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f3;?>">設置目錄權限</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f4;?>">配置數據庫</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f5;?>">初始化管理員賬號</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f6;?>">安裝完畢</font></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td><div align="center"><strong><font color="#0000FF" size="3">想到即可做到 - 帝國網站管理系統</font></strong></div></td>
  </tr>
  <tr> 
    <td valign="top"> 
    <?php
	//用戶條款
	if($enews=="checkfj")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第二步：檢測運行環境</font></strong></div></td>
          </tr>
          <tr> 
            <td height="350" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="21"> <li>粗體字項目是必須支持的項目。</li></td>
                        </tr>
                        <tr> 
                          <td height="21"> <li>不支持GD庫不影響系統正常運行，但圖片縮略圖與水印功能不能使用。</li></td>
                        </tr>
                        <tr> 
                          <td height="21"> <li>不支持採集不影響系統正常使用，但採集功能與遠程保存附件不能正常使用。</li></td>
                        </tr>
                        <tr> 
                          <td height="21"> <li>點擊「支持採集」鏈接可對採集進行測試。</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="25%" height="23"> <div align="center"><strong>項目</strong></div></td>
                    <td width="30%"> <div align="center"><strong>帝國CMS所需配置</strong></div></td>
                    <td width="30%"> <div align="center"><strong>當前服務器</strong></div></td>
                    <td width="15%"> <div align="center"><strong>測試結果</strong></div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center">操作系統</div></td>
                    <td><div align="center">不限</div></td>
                    <td><div align="center"> 
                        <?php echo GetUseSys();?>
                      </div></td>
                    <td><div align="center">√</div></td>
                  </tr>
					<?php
					$phpr=GetPhpVer();
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>PHP版本</strong></div></td>
                    <td><div align="center"><strong>4.2.3+<br>
                        </strong></div></td>
                    <td><div align="center"> <b> 
                        <?php echo $phpr['ver'];?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?php echo $phpr['result'];?>
                      </div></td>
                  </tr>
					<?php
  					$mysqlr=CanMysql();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>MYSQL支持</strong></div></td>
                    <td><div align="center"><strong>支持</strong></div></td>
                    <td><div align="center"> <b> 
                        <?php echo $mysqlr['can'];?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?php echo $mysqlr['result'];?>
                      </div></td>
                  </tr>
					<?php
 					$phpsafer=GetPhpSafemod();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>PHP運行於安全模式</strong></div></td>
                    <td><div align="center"><strong>否</strong></div></td>
                    <td><div align="center"> <b> 
                        <?php echo $phpsafer['word'];?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?php echo $phpsafer['result'];?>
                      </div></td>
                  </tr>
					<?php
  					$gdr=GetGd();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center">支持GD庫</div></td>
                    <td><div align="center">不限</div></td>
                    <td><div align="center"> 
                        <?php echo $gdr['can'];?>
                      </div></td>
                    <td><div align="center"> 
                        <?php echo $gdr['result'];?>
                      </div></td>
                  </tr>
					<?php
  					$cjr=GetCj();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="24"> <div align="center"><a title="測試採集" href="#empirecms" onclick="window.open('index.php?enews=TestCj','','width=200,height=80');"><u>支持採集</u></a></div></td>
                    <td><div align="center">不限</div></td>
                    <td><div align="center"> 
                        <?php echo $cjr['word'];?>
                      </div></td>
                    <td><div align="center"> 
                        <?php echo $cjr['result'];?>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit523" value="上一步" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="下一步" onclick="self.location.href='index.php?enews=path&f=3';">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//設置目錄權限
	elseif($enews=="path")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第三步：設置目錄權限</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="25"><li><font color="#FF0000">如果您的服務器使用 
                              Windows 操作系統，可跳過這一步。</font></li></td>
                        </tr>
                        <tr> 
                          <td height="25"> <li>將下面目錄權限設為0777, 除了紅色目錄外，是目錄全部要把權限應用於子目錄與文件。 
                            </li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="34%" height="23"> <div align="center"><strong>目錄文件名稱</strong></div></td>
                    <td width="42%"> <div align="center"><strong>說明</strong></div></td>
                    <td width="24%"> <div align="center"><strong>權限檢查</strong></div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left"><font color="#FF0000"><strong>/</strong></font></div></td>
                    <td> <div align="center"><font color="#FF0000">系統根目錄(不要應用於子目錄)</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/d</div></td>
                    <td> <div align="center"><font color="#666666">附件目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../d","../../d/txt");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/s</div></td>
                    <td> <div align="center"><font color="#666666">專題存放目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../s");?> 
                      </div></td>
                  </tr>
				  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/t</div></td>
                    <td> <div align="center"><font color="#666666">標題分類存放目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../t");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/search</div></td>
                    <td> <div align="center"><font color="#666666">搜索表單</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../search","../../search/test.txt");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/index.html</div></td>
                    <td> <div align="center"><font color="#666666">網站首頁</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../index.html");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/html</div></td>
                    <td> <div align="center"><font color="#666666">默認可選的HTML存放目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../html");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/admin/ebak/bdata</td>
                    <td> <div align="center"><font color="#666666">備份數據存放目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../admin/ebak/bdata");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/admin/ebak/zip</td>
                    <td> <div align="center"><font color="#666666">備份數據壓縮存放目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../admin/ebak/zip");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/e/config/config.php</div></td>
                    <td> <div align="center"><font color="#666666">數據庫等參數配置文件</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../config/config.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/e/data</div></td>
                    <td> <div align="center"><font color="#666666">部分配置文件存放目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../data","../data/tmp");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/install</td>
                    <td> <div align="center"><font color="#666666">安裝目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../install");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/member/iframe/index.php</td>
                    <td><div align="center"><font color="#666666">登陸狀態顯示</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../member/iframe/index.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/member/login/loginjs.php</td>
                    <td><div align="center"><font color="#666666">JS登陸狀態顯示</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../member/login/loginjs.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/pl/more/index.php</td>
                    <td> <div align="center"><font color="#666666">評論JS調用文件</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../pl/more/index.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/sch/index.php</td>
                    <td><div align="center"><font color="#666666">全站搜索文件</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../sch/index.php");?> 
                      </div></td>
                  </tr>
				  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/template</td>
                    <td> <div align="center"><font color="#666666">動態頁面的模板目錄</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../template");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/tool/feedback/temp</td>
                    <td><div align="center"><font color="#666666">信息反饋</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../tool/feedback/temp","../tool/feedback/temp/test.txt");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/tool/gbook/index.php</td>
                    <td><div align="center"><font color="#666666">留言板</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../tool/gbook/index.php");?> 
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <script>
			  function CheckNext()
			  {
			  var ok;
			  //ok=confirm("確認有應用於子目錄?");
			  ok=true;
			  if(ok)
			  {
			  self.location.href='index.php?enews=setdb&f=4';
			  }
			  }
			  </script>
                <input type="button" name="Submit523" value="上一步" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit72" value="刷新權限狀態" onclick="javascript:self.location.href='index.php?enews=path&f=3';">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="下一步" onclick="javascript:CheckNext();">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//設置配置數據庫
	elseif($enews=="setdb")
	{
		$mycookievarpre=strtolower(InstallMakePassword(5));
		$myadmincookievarpre=strtolower(InstallMakePassword(5));
	?>
      <script>
		  function CheckSubmit()
		  {
		  	var ok;
			ok=confirm("確認要進入下一步?");
			if(ok)
			{
		  		document.form1.Submit6223.disabled=true;
				return true;
			}
			return false;
		  }
		  </script> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?enews=setdb&ok=1&f=5" onsubmit="document.form1.Submit6223.disabled=true;">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第四步：配置數據庫</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="23"> <li>請在下面填寫您的數據庫賬號信息, 通常情況下不需要修改綠色選項內容。</li></td>
                        </tr>
                        <tr> 
                          <td height="23"> <li>帶*項為不能為空。</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="21%" height="23"> <div align="center"><strong>設置選項</strong></div></td>
                    <td width="36%"><div align="center"><strong>當前值</strong></div></td>
                    <td width="43%"><div align="center"><strong>註釋</strong></div></td>
                  </tr>
					<?php
					$getmysqlver=@mysql_get_server_info();
					$selectmysqlver=$getmysqlver;
					if(empty($selectmysqlver))
					{
						$selectmysqlver='5.0';
					}
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">MYSQL版本:</td>
                    <td><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="22"><input type="radio" name="mydbver" value="auto" checked>
                            自動識別</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.0">
                            MYSQL 4.0.*/3.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.1">
                            MYSQL 4.1.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="5.0">
                            MYSQL 5.*或以上</td>
                        </tr>
                      </table></td>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                          <td>系統檢測到的版本號: <b> <u> 
                            <?php echo $getmysqlver?$getmysqlver:'';?>
                            </u> </b></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td width="21%" height="25"><font color="#009900">數據庫服務器(*):</font></td>
                    <td width="36%"> <input name="mydbhost" type="text" id="mydbhost" value="localhost" size="30"></td>
                    <td width="43%"><font color="#666666">數據庫服務器地址, 一般為 localhost</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">數據庫服務器端口:</font></td>
                    <td> <input name="mydbport" type="text" id="mydbport" size="30"> 
                    </td>
                    <td><font color="#666666">MYSQL端口,空為默認端口, 一般為空</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">數據庫用戶名:</td>
                    <td> <input name="mydbusername" type="text" id="mydbusername" value="username" size="30"></td>
                    <td><font color="#666666">MYSQL數據庫鏈接賬號</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">數據庫密碼:</td>
                    <td> <input name="mydbpassword" type="password" id="mydbpassword" size="30"></td>
                    <td><font color="#666666">MYSQL數據庫鏈接密碼</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">數據庫名(*):</td>
                    <td> <input name="mydbname" type="text" id="mydbname" value="empirecms" size="30"> 
                    </td>
                    <td><font color="#666666">數據庫名稱</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">表名前綴(*):</font></td>
                    <td><input name="mydbtbpre" type="text" id="mydbtbpre" value="phome_" size="30"></td>
                    <td><font color="#666666">同一數據庫安裝多個CMS時可改變默認，不能數字開頭</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">COOKIE前綴(*):</font></td>
                    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <td>前台：
                            <input name="mycookievarpre" type="text" id="mycookievarpre" value="<?php echo $mycookievarpre;?>" size="22"></td>
                        </tr>
                        <tr>
                          <td>後台：
                            <input name="myadmincookievarpre" type="text" id="myadmincookievarpre" value="<?php echo $myadmincookievarpre;?>" size="22"></td>
                        </tr>
                      </table>
                      
                    </td>
                    <td><font color="#666666">由<strong>英文字母</strong>組成，默認即可</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">內置初始數據:</td>
                    <td><input name="defaultdata" type="checkbox" id="defaultdata" value="1">
                      是</td>
                    <td><font color="#666666">測試軟件時選擇</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5223" value="上一步" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit6223" value="下一步">
                <input name="mydbtype" type="hidden" id="mydbtype" value="mysql">
                <input name="mydbchar" type="hidden" id="mydbchar" value="<?php echo $dbchar;?>">
                <input name="mysetchar" type="hidden" id="mysetchar" value="<?php echo $setchar;?>">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//初使化管理員
	elseif($enews=="firstadmin")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?enews=firstadmin&ok=1&f=6" onsubmit="document.form1.Submit62222.disabled=true">
          <input type="hidden" name="defaultdata" value="<?php echo $_GET['defaultdata'];?>">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第五步：初始化管理員賬號</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>提示信息</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="25"> <li>請在下面填寫您要設置的管理員賬號信息。</li></td>
                        </tr>
                        <tr>
                          <td height="25"> <li>密碼不能包含：$、&amp;、*、#、&lt;、&gt;、'、&quot;、/、\、%、;、空格</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23" colspan="3"><strong>初始化管理員賬號</strong></td>
                  </tr>
                  <tr> 
                    <td width="21%" height="25" bgcolor="#FFFFFF">用戶名:</td>
                    <td width="36%" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" size="30"> 
                    </td>
                    <td width="43%" bgcolor="#FFFFFF"><font color="#666666">管理員用戶名</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF">密碼:</td>
                    <td bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">管理員賬號密碼</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"> <p>重複密碼:</p></td>
                    <td bgcolor="#FFFFFF"> <input name="repassword" type="password" id="repassword" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">確認賬號密碼</font></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><font color="#FF0000">登陸認證碼:</font></td>
                    <td bgcolor="#FFFFFF"><input name="loginauth" type="text" id="loginauth" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#FF0000">如果設置後台登陸要輸入認證碼，更安全</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit52223" value="上一步" onclick="javascript:history.go(-3);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit62222" value="下一步">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//安裝完畢
	elseif($enews=="success")
	{
		//鎖定安裝程序
		$fp=@fopen("install.off","w");
		@fclose($fp);
		$word='恭喜您！您已成功安裝帝國網站管理系統．';
		if($_GET['defaultdata'])
		{
			$word='恭喜您！您已成功安裝帝國網站管理系統．<br>請繼續操作初始化內置數據(看安裝說明第三大步)。';
		}
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?enews=setdb&ok=1&f=7">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第六步：安裝完畢</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100"> <div align="center"> 
                <table width="92%" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td bgcolor="#FFFFFF"> <div align="center"> 
                        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                          <tr> 
                            <td height="42"> <div align="center"><font color="#FF0000"> 
                                <?php echo $word;?>
                                </font></div></td>
                          </tr>
                          <tr> 
                            <td height="30"> <div align="center">(友情提示：請馬上刪除/e/install目錄，以避免被再次安裝.)</div></td>
                          </tr>
                          <tr> 
                            <td height="42"> <div align="center"> 
                                <input type="button" name="Submit82" value="進入後台控制面板" onclick="javascript:self.location.href='../admin/index.php'">
                              </div></td>
                          </tr>
                          <tr> 
                            <td height="25"> <div align="center" style="DISPLAY:none"><?=InstallSuccessShowInfo()?></div></td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//條款
	else
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">第一步：帝國CMS用戶許可協議</font></strong></div></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" height="350" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td><div align="center"> 
                        <IFRAME frameBorder=0 name=xy scrolling=auto src="data/xieyi.html" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5" value="我不同意" onclick="window.close();">
				                &nbsp;&nbsp; 
				<input type="button" name="Submit6" value="我同意" onclick="javascript:self.location.href='index.php?enews=checkfj&f=2';">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
		}
		?>
    </td>
  </tr>
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td><hr align="center"></td>
        </tr>
        <tr> 
          <td height="25"><div align="center"><a href="http://www.PHome.Net" target="_blank">官方網站</a>&nbsp; 
              | &nbsp;<a href="http://bbs.PHome.Net" target="_blank">支持論壇</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/EmpireCMS/UserSite/" target="_blank">部分案例</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/ecms7/?ecms=EmpireCMS" target="_blank">系統特性</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/zy/template/" target="_blank">模板下載</a>&nbsp; 
              | &nbsp;<a href="http://bbs.phome.net/showthread-13-18902-0.html" target="_blank">教程下載</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/service/about.html" target="_blank">關於帝國</a></div></td>
        </tr>
        <tr> 
          <td height="36"> <div align="center">帝興軟件開發有限公司 版權所有<BR>
              <font face="Arial, Helvetica, sans-serif">Copyright &copy; 2002 
              - 2015<b> <a href="http://www.PHome.net"><font color="#000000">PHome</font><font color="#FF6600">.Net</font></a></b></font></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
