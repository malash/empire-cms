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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>更新數據</title>
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
    <td width="34%" height="25">位置：<a href="ChangeData.php<?=$ecms_hashur['whehref']?>">數據更新</a></td>
    <td width="66%"><table width="420" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr> 
          <td> <div align="center">[<a href="#ReAllHtml">總體刷新</a>]</div></td>
          <td> <div align="center">[<a href="#ReMoreListHtml">多欄目刷新</a>]</div></td>
          <td> <div align="center">[<a href="#ReIfInfoHtml">按條件刷新內容頁</a>]</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="6">
  <tr id=ReAllHtml> 
    <td width="69%" valign="top"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <div align="center">頁面刷新管理</div></td>
        </tr>
        <tr> 
          <td height="25"><div align="center"><strong>整站主要頁面刷新</strong></div></td>
          <td height="25"><div align="center"><strong>其他頁面刷新</strong></div></td>
        </tr>
        <tr> 
          <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit2" value="刷新首頁" onclick="self.location.href='../ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>'" title="生成首頁">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit22" value="刷新所有信息欄目頁" onclick="window.open('../ecmschtml.php?enews=ReListHtml_all&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成所有欄目頁面">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <form action="ecmschtml.php" method="post" name="dorehtml" id="dorehtml">
					  <?=$ecms_hashur['form']?>
                        <tr> 
                          <td><div align="center"> 
                              <input type="button" name="Submit3" value="刷新所有信息內容頁面" onclick="var toredohtml=0;if(document.dorehtml.havehtml.checked==true){toredohtml=1;}window.open('DoRehtml.php?enews=ReNewsHtml&start=0&havehtml='+toredohtml+'&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成所有內容頁">
                            </div></td>
                        </tr>
                        <tr> 
                          <td height="25" valign="top"> <div align="center">全部刷新 
                              <input name="havehtml" type="checkbox" id="havehtml" value="1" title="把已經生成的內容頁一起更新">
                            </div></td>
                        </tr>
                      </form>
                    </table>
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit4" value="刷新所有信息JS調用" onclick="window.open('../ecmschtml.php?enews=ReAllNewsJs&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成所有JS調用文件">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"><div align="center"> 
                    <input type="button" name="Submit422232" value="批量更新動態頁面" onclick="self.location.href='../ecmschtml.php?enews=ReDtPage<?=$ecms_hashur['href']?>';" title="生成控制面板模板、登陸狀態、登陸JS等動態頁面">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td height="48"><div align="center">
                  <input type="button" name="Submit222" value="刷新所有標題分類頁" onclick="window.open('../ecmschtml.php?enews=ReTtListHtml_all&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成所有標題分類頁面">
                </div></td>
              </tr>
            </table></td>
          <td width="50%" valign="top" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td height="48"><div align="center">
                  <input type="button" name="Submit2222" value="刷新所有專題頁" onClick="window.open('../ecmschtml.php?enews=ReZtListHtml_all&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成所有專題頁面">
                </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit422" value="批量刷新碎片文件" onclick="window.open('../ecmschtml.php?enews=ReSpAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成碎片文件">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit422" value="批量刷新投票JS" onclick="window.open('../tool/ListVote.php?enews=ReVoteJs_all&from=../ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成投票插件的JS文件">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit4222" value="批量刷新廣告JS" onclick="window.open('../tool/ListAd.php?enews=ReAdJs_all&from=../ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="生成廣告插件的JS文件">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <form action="../ecmsmod.php" method="GET" name="dochangemodform" id="dochangemodform">
					  <?=$ecms_hashur['form']?>
                        <input type=hidden name=enews value="ChangeAllModForm">
                        <tr> 
                          <td><div align="center"> 
                              <input type="submit" name="Submit3" value="批量更新模型表單" title="生成發佈跟投稿表單(一般是網站搬家時使用)">
                            </div></td>
                        </tr>
                        <tr> 
                          <td height="25"> <div align="center">更新欄目導航 
                              <input name="ChangeClass" type="checkbox" id="ChangeClass" value="1" title="更新投稿時選擇的欄目">
                            </div></td>
                        </tr>
                      </form>
                    </table>
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"><div align="center"> 
                    <input type="button" name="Submit4222322" value="批量更新反饋表單" onclick="self.location.href='../tool/FeedbackClass.php?enews=ReMoreFeedbackClassFile<?=$ecms_hashur['href']?>';" title="生成自定義反饋的表單(一般是網站搬家時使用)">
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td width="31%" valign="top"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr> 
          <td height="25" class="header"> <div align="center">更新緩存數據</div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../enews.php?enews=ChangeEnewsData<?=$ecms_hashur['href']?>" title="更新系統的緩存(一般是網站搬家時使用)">更新數據庫緩存</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReClassPath<?=$ecms_hashur['href']?>" title="重新建立欄目目錄(一般是網站搬家時使用)">恢復欄目目錄</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmsclass.php?enews=DelFcListClass<?=$ecms_hashur['href']?>" title="重新更新「信息管理」菜單下的欄目列表及「欄目管理」菜單下的管理欄目頁面。(一般是網站搬家時使用)">刪除欄目緩存文件</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmsclass.php?enews=ChangeSonclass<?=$ecms_hashur['href']?>" title="一般應用於修改欄目所屬父欄目後使用此功能。">更新欄目關係</a></div></td>
        </tr>
        <tr>
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"><div align="center"><a href="../ecmschtml.php?enews=UpdateClassInfosAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" title="重新統計欄目下信息數量，一般應用於批量刪除信息後使用此功能。" target="_blank">更新欄目信息數</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmscom.php?enews=ClearTmpFileData<?=$ecms_hashur['href']?>" onclick="return confirm('清除前請確認用戶沒有正在採集、批量刷新頁面與遠程發佈，確認?');" title="清除臨時和緩存文件，可清空產生的臨時文件，還有就是更新動態頁面模板時使用，用於實時更換模板">清除臨時文件和數據</a></div></td>
        </tr>
      </table>
      <br>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr> 
          <td height="25" class="header"> <div align="center">自定義頁面刷新</div></td>
        </tr>
        <tr> 
          <td height="30" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReUserpageAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" target="_blank" title="生成所有自定義頁面">刷新所有自定義頁面</a></div></td>
        </tr>
        <tr> 
          <td height="30" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReUserlistAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" target="_blank" title="生成所有自定義列表">刷新所有自定義列表</a></div></td>
        </tr>
        <tr> 
          <td height="30" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReUserjsAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" target="_blank" title="生成所有自定義JS">刷新所有自定義JS</a></div></td>
        </tr>
      </table> </td>
  </tr>
  <tr id=ReMoreListHtml> 
    <td width="69%" valign="top"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form2" method="post" action="../ecmschtml.php">
		<?=$ecms_hashur['form']?>
          <tr class="header"> 
            <td height="25"> <div align="center"><strong>刷新多欄目頁面 </strong></div></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="3">
                  <tr> 
                    <td><div align="center"> 
                        <select name="classid[]" size="12" multiple id="classid[]" style="width:310">
                          <?=$class?>
                        </select>
                      </div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"> 
                        <input type="submit" name="Submit8" value="開始刷新">
                        <strong> 
                        <input name="enews" type="hidden" id="enews3" value="GoReListHtmlMore">
                        <input name="gore" type="hidden" id="enews4" value="0">
                        <input name="from" type="hidden" id="gore" value="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">
                        </strong></div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"><font color="#666666">多個用ctrl/shift選擇</font></div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </form>
      </table></td>
    <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form2" method="post" action="../ecmschtml.php">
		<?=$ecms_hashur['form']?>
          <tr class="header"> 
            <td height="25"> <div align="center"><strong>刷新多專題頁面 </strong></div></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="3">
                  <tr> 
                    <td><div align="center"> 
                        <select name="classid[]" size="12" multiple id="select2" style="width:250">
                          <?=$ztclass?>
                        </select>
                      </div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"> 
                        <input name="ecms" type="checkbox" id="ecms" value="1" checked>
                        含子分類
                        <input type="submit" name="Submit82" value="開始刷新">
                        <strong> 
                        <input name="enews" type="hidden" id="enews5" value="GoReListHtmlMore">
                        <input name="gore" type="hidden" id="gore" value="1">
                        <input name="from" type="hidden" id="from" value="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">
                        </strong></div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"><font color="#666666">多個用ctrl/shift選擇</font></div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </form>
      </table></td>
  </tr>
</table>
<form action="DoRehtml.php" method="get" name="reform" target="_blank" onsubmit="return confirm('確認要刷新?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=ReIfInfoHtml>
  <?=$ecms_hashur['form']?>
    <input name="from" type="hidden" id="from" value="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">
    <tr class="header"> 
      <td height="25"> <div align="center">按條件刷新信息內容頁面</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td height="25">刷新數據表：
                <input name=chkall type=checkbox onClick=CheckAll(this.form) value=on checked>
                <font color="#666666">全選</font></td>
              <td height="25">
                <?=$retable?>
              </td>
            </tr>
            <tr> 
              <td height="25">刷新欄目</td>
              <td height="25"><select name="classid" id="classid">
                  <option value="0">所有欄目</option>
                  <?=$class?>
                </select>
                <font color="#666666"> (如選擇父欄目，將刷新所有子欄目)</font></td>
            </tr>
            <tr> 
              <td width="23%" height="25"> <input name="retype" type="radio" value="0" checked>
                按時間刷新：</td>
              <td width="77%" height="25">從 
                <input name="startday" type="text" size="12" onclick="setday(this)">
                到 
                <input name="endday" type="text" size="12" onclick="setday(this)">
                之間的數據 
                <?=$changeday?>
                <font color="#666666"> (不填將刷新所有頁面)</font></td>
            </tr>
            <tr> 
              <td height="25"> <input name="retype" type="radio" value="1">
                按ID刷新：</td>
              <td height="25">從 
                <input name="startid" type="text" id="startid" value="0" size="6">
                到 
                <input name="endid" type="text" id="endid" value="0" size="6">
                之間的數據 <font color="#666666">(兩個值為0將刷新所有頁面)</font></td>
            </tr>
            <tr>
              <td height="25">全部刷新：</td>
              <td height="25"><input name="havehtml" type="checkbox" id="havehtml" value="1">
                是<font color="#666666"> (不選擇將不刷新已生成過的信息)</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit6" value="開始刷新"> 
                <input type="reset" name="Submit7" value="重置"> <input name="enews" type="hidden" id="enews" value="ReNewsHtml"> 
              </td>
            </tr>
          </table>
        </div></td>
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
