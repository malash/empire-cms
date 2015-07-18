<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
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
db_close();
$empire=null;
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>帝國網站管理系統</title>

<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="">
    <tr class="header"> 
      <td height="25"> <div align="center">目錄權限檢測</div></td>
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
                    <td height="25"> <li>將下面目錄權限設為0777, 除了紅色目錄外，是目錄全部要把權限應用於子目錄與文件。<br>
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
              <td> <div align="center"> 
                  <?=CheckFileMod("../../");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/d</div></td>
              <td> <div align="center"><font color="#666666">附件目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../d","../../d/txt");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/s</div></td>
              <td> <div align="center"><font color="#666666">專題存放目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../s");?>
                </div></td>
            </tr>
			<tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/t</div></td>
              <td> <div align="center"><font color="#666666">標題分類存放目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../t");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/search</div></td>
              <td> <div align="center"><font color="#666666">搜索表單</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../search","../../search/test.txt");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/index.html</div></td>
              <td> <div align="center"><font color="#666666">網站首頁</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../index.html");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/html</div></td>
              <td> <div align="center"><font color="#666666">默認可選的HTML存放目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../html");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/admin/ebak/bdata</td>
              <td> <div align="center"><font color="#666666">備份數據存放目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("ebak/bdata");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/admin/ebak/zip</td>
              <td> <div align="center"><font color="#666666">備份數據壓縮存放目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("ebak/zip");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/e/config/config.php</div></td>
              <td> <div align="center"><font color="#666666">數據庫等參數配置文件</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../config/config.php");?>
                </div></td>
            </tr>
            
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/e/data</div></td>
              <td> <div align="center"><font color="#666666">部分配置文件存放目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../data","../data/tmp");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/install</td>
              <td> <div align="center"><font color="#666666">安裝目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../install");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/member/iframe/index.php</td>
              <td><div align="center"><font color="#666666">登陸狀態顯示</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../member/iframe/index.php");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/member/login/loginjs.php</td>
              <td><div align="center"><font color="#666666">JS登陸狀態顯示</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../member/login/loginjs.php");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/pl/more/index.php</td>
              <td> <div align="center"><font color="#666666">評論JS調用文件</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../pl/more/index.php");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/sch/index.php</td>
              <td><div align="center"><font color="#666666">全站搜索文件</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../sch/index.php");?>
                </div></td>
            </tr>
			<tr bgcolor="#FFFFFF"> 
              <td height="25">/e/template</td>
              <td> <div align="center"><font color="#666666">動態頁面的模板目錄</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../template");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/tool/feedback/temp</td>
              <td><div align="center"><font color="#666666">信息反饋</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../tool/feedback/temp","../tool/feedback/temp/test.txt");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/tool/gbook/index.php</td>
              <td><div align="center"><font color="#666666">留言板</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../tool/gbook/index.php");?>
                </div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr class="header"> 
      <td><div align="center"> 
          &nbsp;&nbsp; &nbsp;&nbsp; </div></td>
    </tr>
  </form>
</table>
</body>
</html>