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
CheckLevel($logininid,$loginin,$classid,"changedata");
//欄目
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//刷新表
$retable="";
$selecttable="";
$cleartable='';
$i=0;
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable where intb=0 order by tid");
while($tr=$empire->fetch($tsql))
{
	$i++;
	if($i%4==0)
	{
		$br="<br>";
	}
	else
	{
		$br="";
	}
	$retable.="<input type=checkbox name=tbname[] value='$tr[tbname]' checked>$tr[tname]&nbsp;&nbsp;".$br;
	$selecttable.="<option value='".$tr[tbname]."'>".$tr[tname]."</option>";
	$cleartable.="<option value='".$tr[tid]."'>".$tr[tname]."</option>";
}
//專題
$ztclass="";
$ztsql=$empire->query("select ztid,ztname from {$dbtbpre}enewszt order by ztid desc");
while($ztr=$empire->fetch($ztsql))
{
	$ztclass.="<option value='".$ztr['ztid']."'>".$ztr['ztname']."</option>";
}
//選擇日期
$todaydate=date("Y-m-d");
$todaytime=time();
$changeday="<select name=selectday onchange=\"document.reform.startday.value=this.value;document.reform.endday.value='".$todaydate."'\">
<option value='".$todaydate."'>--選擇--</option>
<option value='".$todaydate."'>今天</option>
<option value='".ToChangeTime($todaytime,7)."'>一周</option>
<option value='".ToChangeTime($todaytime,30)."'>一月</option>
<option value='".ToChangeTime($todaytime,90)."'>三月</option>
<option value='".ToChangeTime($todaytime,180)."'>半年</option>
<option value='".ToChangeTime($todaytime,365)."'>一年</option>
</select>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>數據整理</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="34%" height="25">位置：<a href="DoUpdateData.php<?=$ecms_hashur['whehref']?>">數據整理</a></td>
    <td width="66%"><table width="460" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr> 
          <td> <div align="center">[<a href="#IfTotalPlNum">批量更新信息評論數</a>]</div></td>
          <td> <div align="center">[<a href="#IfOtherInfo">批量更新相關鏈接</a>]</div></td>
          <td><div align="center">[<a href="#IfClearBreakInfo">清理多餘信息</a>]</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<form action="../ecmspl.php" method="get" name="form1" target="_blank" onsubmit="return confirm('確認要更新?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=IfTotalPlNum>
  <?=$ecms_hashur['form']?>
    <input name="from" type="hidden" id="from" value="ReHtml/DoUpdateData.php<?=$ecms_hashur['whehref']?>">
    <tr class="header"> 
      <td height="25"> <div align="center">批量更新信息評論數</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td height="25">數據表：</td>
              <td height="25"> <select name="tbname" id="tbname">
                  <option value=''>------ 選擇數據表 ------</option>
                  <?=$selecttable?>
                </select>
                (*) </td>
            </tr>
            <tr> 
              <td height="25">欄目</td>
              <td height="25"><select name="classid">
                  <option value="0">所有欄目</option>
                  <?=$class?>
                </select>
                <font color="#666666">(如選擇父欄目，將更新所有子欄目)</font></td>
            </tr>
            <tr> 
              <td width="23%" height="25"> <input name="retype" type="radio" value="0" checked>
                按時間更新：</td>
              <td width="77%" height="25">從 
                <input name="startday" type="text" size="12" onclick="setday(this)">
                到 
                <input name="endday" type="text" size="12" onclick="setday(this)">
                之間的信息 <font color="#666666">(不填將更新所有信息)</font></td>
            </tr>
            <tr> 
              <td height="25"> <input name="retype" type="radio" value="1">
                按ID更新：</td>
              <td height="25">從 
                <input name="startid" type="text" value="0" size="6">
                到 
                <input name="endid" type="text" value="0" size="6">
                之間的信息 <font color="#666666">(兩個值為0將更新所有信息)</font></td>
            </tr>
            <tr>
              <td height="25">指定固定信息ID：</td>
              <td height="25"><input name="doids" type="text" id="doids" size="50">
                <font color="#666666">（多個ID可用半角逗號「,」隔開）</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit62" value="開始更新"> 
                <input type="reset" name="Submit72" value="重置"> <input name="enews" type="hidden" value="UpdateAllInfoPlnum">              </td>
            </tr>
            <tr> 
              <td height="25" colspan="2"><font color="#666666">說明：當信息表裡的評論數與實際評論數不符時使用。</font></td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</form>
<form action="../ecmscom.php" method="get" name="form1" target="_blank" onsubmit="return confirm('確認要更新?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=IfOtherInfo>
  <?=$ecms_hashur['form']?>
    <input name="from" type="hidden" id="from" value="ReHtml/DoUpdateData.php<?=$ecms_hashur['whehref']?>">
    <tr class="header"> 
      <td height="25"> <div align="center">批量更新相關鏈接</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td height="25">數據表：</td>
              <td height="25"> <select name="tbname" id="tbname">
                  <option value=''>------ 選擇數據表 ------</option>
                  <?=$selecttable?>
                </select>
                (*) </td>
            </tr>
            <tr> 
              <td height="25">欄目</td>
              <td height="25"><select name="classid">
                  <option value="0">所有欄目</option>
                  <?=$class?>
                </select>
                <font color="#666666">(如選擇父欄目，將更新所有子欄目)</font></td>
            </tr>
            <tr> 
              <td width="23%" height="25"> <input name="retype" type="radio" value="0" checked>
                按時間更新：</td>
              <td width="77%" height="25">從 
                <input name="startday" type="text" size="12" onclick="setday(this)">
                到 
                <input name="endday" type="text" size="12" onclick="setday(this)">
                之間的信息 <font color="#666666">(不填將更新所有信息)</font></td>
            </tr>
            <tr> 
              <td height="25"> <input name="retype" type="radio" value="1">
                按ID更新：</td>
              <td height="25">從 
                <input name="startid" type="text" value="0" size="6">
                到 
                <input name="endid" type="text" value="0" size="6">
                之間的信息 <font color="#666666">(兩個值為0將更新所有信息)</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit62" value="開始更新"> 
                <input type="reset" name="Submit72" value="重置"> <input name="enews" type="hidden" value="ChangeInfoOtherLink"> 
              </td>
            </tr>
            <tr> 
              <td height="25" colspan="2"><font color="#666666">友情提醒：此功能比較耗資源，非必要時請勿用。</font></td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</form>
<form action="../ecmscom.php" method="POST" name="form1" onsubmit="return confirm('確認要清理?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="IfClearBreakInfo">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> <div align="center">清理多餘信息</div></td>
    </tr>
    <tr> 
      <td width="20%" height="25" bgcolor="#FFFFFF">選擇要清理的數據表</td>
      <td width="80%" bgcolor="#FFFFFF"><select name="tid" id="tid">
          <option value=''>------ 選擇數據表 ------</option>
          <?=$cleartable?>
        </select>
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit6" value="馬上清理"> 
        <input name="enews" type="hidden" id="enews2" value="ClearBreakInfo"> </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25"><font color="#666666">說明: 當生成信息內容頁時提示如下錯誤時使用本功能來清理多餘信息：<br>
      生成內容頁提示「Table '*.phome_ecms_' doesn't exist......update ***_ecms_ set havehtml=1   where id='' limit 1」時使用。</font></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br>
</p>
</body>
</html>
<?php
db_close();
$empire=null;
?>
