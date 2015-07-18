<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
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
CheckLevel($logininid,$loginin,$classid,"repdownpath");
$url="<a href=RepDownLevel.php".$ecms_hashur['whehref'].">批量更改地址權限</a>";
//欄目
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//數據表
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	$table.="<option value='".$tr[tbname]."'>".$tr[tname]."</option>";
}
$table="<select name='tbname'><option value='0'>--- 選擇數據表 ---</option>".$table."</select>";
//----------會員組
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	$ygroup.="<option value=".$l_r[groupid].">".$l_r[groupname]."</option>";
}
//----------地址前綴
$qz="";
$downsql=$empire->query("select urlname,urlid from {$dbtbpre}enewsdownurlqz order by urlid");
while($downr=$empire->fetch($downsql))
{
	$qz.="<option value='".$downr[urlid]."'>".$downr[urlname]."</option>";
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>批量更改地址權限</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="../ecmscom.php" target="_blank" onsubmit="return confirm('確認要操作？');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> <div align="center">批量更改下載/在線地址權限 
          <input name="enews" type="hidden" id="enews" value="RepDownLevel">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">操作數據表(*)：</td>
      <td width="79%" height="25"> 
        <?=$table?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">操作欄目：</td>
      <td height="25"><select name="classid" id="classid">
          <option value=0>所有欄目</option>
          <?=$class?>
        </select>
        <font color="#666666"> (如選擇大欄目，將應用於所有子欄目)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">操作字段(*)：</td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="32%"><input name="downpath" type="checkbox" id="downpath" value="1">
              下載地址(downpath)</td>
            <td width="68%"><input name="onlinepath" type="checkbox" id="onlinepath" value="1">
              在線地址(onlinepath)</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">權限轉換： 
        <input name="dogroup" type="checkbox" id="dogroup" value="1"></td>
      <td height="25"><div align="left"> 
          <table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
            <tr> 
              <td width="49%"><div align="center">原會員組</div></td>
              <td width="51%"><div align="center">新會員組</div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"> 
                  <select name="oldgroupid" id="oldgroupid">
                    <option value="no">不設置</option>
                    <option value="0">遊客</option>
					<?=$ygroup?>
                  </select>
                </div></td>
              <td><div align="center"> 
                  <select name="newgroupid" id="newgroupid">
                    <option value="0">遊客</option>
					<?=$ygroup?>
                  </select>
                </div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">點數轉換： 
        <input name="dofen" type="checkbox" id="dofen" value="1"></td>
      <td height="25"><table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">原點數</div></td>
            <td width="51%"><div align="center">新點數</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldfen" type="text" id="oldfen" value="no" size="6">
              </div></td>
            <td><div align="center"> 
                <input name="newfen" type="text" id="newfen" value="0" size="6">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">前綴轉換： 
        <input name="doqz" type="checkbox" id="doqz" value="1"></td>
      <td height="25"><table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">原前綴</div></td>
            <td width="51%"><div align="center">新前綴</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <select name="oldqz" id="oldqz">
                  <option value="no">不設置</option>
				  <option value="0">空前綴</option>
                  <?=$qz?>
                </select>
              </div></td>
            <td><div align="center"> 
                <select name="newqz">
				<option value="0">空前綴</option>
                  <?=$qz?>
                </select>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">地址替換：
        <input name="dopath" type="checkbox" id="dopath" value="1"></td>
      <td height="25"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">原下載地址字符</div></td>
            <td width="51%"><div align="center">新下載地址字符</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldpath" type="text" id="oldpath">
              </div></td>
            <td><div align="center"> 
                <input name="newpath" type="text" id="newpath">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">名稱替換：
        <input name="doname" type="checkbox" id="doname" value="1"></td>
      <td height="25"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">原下載名稱字符</div></td>
            <td width="51%"><div align="center">新下載名稱字符</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldname" type="text" id="oldname">
              </div></td>
            <td><div align="center"> 
                <input name="newname" type="text" id="newname">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">附加SQL條件：</td>
      <td height="25"><input name="query" type="text" id="query" size="75"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><font color="#666666">如：title='標題' and writer='作者'</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">說明：如原點數為no，則所有信息的點數都為新點數，如果選項為不設置，則所有信息都為新的值。<br>
        注意：<font color="#FF0000">使用此功能，最好備份一下數據，以防萬一</font></td>
    </tr>
  </table>
</form>
</body>
</html>
