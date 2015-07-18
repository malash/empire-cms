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
CheckLevel($logininid,$loginin,$classid,"group");
$url="位置：<a href=ListGroup.php".$ecms_hashur['whehref'].">管理用戶組</a>&nbsp;>&nbsp;增加用戶組";
//默認值
$checked="";
$doall=$checked;
$dopublic=$checked;
$doclass=$checked;
$dotemplate=$checked;
$dopicnews=$checked;
$dofile=$checked;
$douser=$checked;
$dolog=$checked;
$domember=$checked;
$dobefrom=$checked;
$doword=$checked;
$dokey=$checked;
$doad=$checked;
$dovote=$checked;
$dogroup=$checked;
$docj=$checked;
$dobq=$checked;
$domovenews=$checked;
$dopostdata=$checked;
$dochangedata=$checked;
$dopl=$checked;
$doselfinfo=$checked;
$dotable=$checked;
$doexecsql=$checked;
$dodownurl=$checked;
$dodownrecord=$checked;
$doshoppayfs=$checked;
$doshopps=$checked;
$doshopdd=$checked;
$dogbook=$checked;
$dofeedback=$checked;
$donotcj=$checked;
$dodownerror=$checked;
$douserpage=$checked;
$dodelinfodata=$checked;
$doadminstyle=$checked;
$dorepdownpath=$checked;
$douserjs=$checked;
$douserlist=$checked;
$domsg=$checked;
$dosendemail=$checked;
$dosetmclass=$checked;
$doinfodoc=$checked;
$dotempgroup=$checked;
$dofeedbackf=$checked;
$dotask=$checked;
$domemberf=$checked;
$dospacestyle=$checked;
$dospacedata=$checked;
$dovotemod=$checked;
$doplayer=$checked;
$dowap=$checked;
$dopay=$checked;

$enews=ehtmlspecialchars($_GET['enews']);
//修改用戶組
if($enews=="EditGroup")
{
$groupid=(int)$_GET['groupid'];
$r=$empire->fetch1("select * from {$dbtbpre}enewsgroup where groupid='$groupid'");
$url="位置：<a href=ListGroup.php".$ecms_hashur['whehref'].">管理用戶組</a>&nbsp;>&nbsp;修改用戶組：<b>".$r[groupname]."</b>";
if($r[doall])
{
$doall=" checked";
}
if($r[dopublic])
{
$dopublic=" checked";
}
if($r[doclass])
{
$doclass=" checked";
}
if($r[dotemplate])
{
$dotemplate=" checked";
}
if($r[dopicnews])
{
$dopicnews=" checked";
}
if($r[dofile])
{
$dofile=" checked";
}
if($r[douser])
{
$douser=" checked";
}
if($r[dolog])
{
$dolog=" checked";
}
if($r[domember])
{
$domember=" checked";
}
if($r[dobefrom])
{
$dobefrom=" checked";
}
if($r[doword])
{
$doword=" checked";
}
if($r[dokey])
{
$dokey=" checked";
}
if($r[doad])
{
$doad=" checked";
}
if($r[dovote])
{
$dovote=" checked";
}
if($r[dogroup])
{
$dogroup=" checked";
}
if($r[docj])
{
$docj=" checked";
}
if($r[dobq])
{
$dobq=" checked";
}
if($r[domovenews])
{
$domovenews=" checked";
}
if($r[dopostdata])
{
$dopostdata=" checked";
}
if($r[dochangedata])
{
$dochangedata=" checked";
}
if($r[dopl])
{
$dopl=" checked";
}

if($r[dof])
{
$dof=" checked";
}
if($r[dom])
{
$dom=" checked";
}
if($r[dodo])
{
$dodo=" checked";
}
if($r[dodbdata])
{
$dodbdata=" checked";
}
if($r[dorepnewstext])
{
$dorepnewstext=" checked";
}
if($r[dotempvar])
{
$dotempvar=" checked";
}
if($r[dostats])
{
$dostats=" checked";
}
if($r[dowriter])
{
$dowriter=" checked";
}
if($r[dototaldata])
{
$dototaldata=" checked";
}
if($r[dosearchkey])
{
$dosearchkey=" checked";
}
if($r[dozt])
{
$dozt=" checked";
}
if($r[docard])
{
$docard=" checked";
}
if($r[dolink])
{
$dolink=" checked";
}
if($r[doselfinfo])
{
$doselfinfo=" checked";
}
if($r[dotable])
{
$dotable=" checked";
}
if($r[doexecsql])
{
$doexecsql=" checked";
}
if($r[dodownurl])
{
$dodownurl=" checked";
}
if($r[dodeldownrecord])
{
$dodeldownrecord=" checked";
}
if($r[doshoppayfs])
{
$doshoppayfs=" checked";
}
if($r[doshopps])
{
$doshopps=" checked";
}
if($r[doshopdd])
{
$doshopdd=" checked";
}
if($r[dogbook])
{
$dogbook=" checked";
}
if($r[dofeedback])
{
$dofeedback=" checked";
}
if($r[donotcj])
{
$donotcj=" checked";
}
if($r[dodownerror])
{
$dodownerror=" checked";
}
if($r[douserpage])
{
$douserpage=" checked";
}
if($r[dodelinfodata])
{
$dodelinfodata=" checked";
}
if($r[doadminstyle])
{
$doadminstyle=" checked";
}
if($r[dorepdownpath])
{
$dorepdownpath=" checked";
}
if($r[douserjs])
{
$douserjs=" checked";
}
if($r[douserlist])
{
$douserlist=" checked";
}
if($r[domsg])
{
$domsg=" checked";
}
if($r[dosendemail])
{
$dosendemail=" checked";
}
if($r[dosetmclass])
{
$dosetmclass=" checked";
}
if($r[doinfodoc])
{
$doinfodoc=" checked";
}
if($r[dotempgroup])
{
$dotempgroup=" checked";
}
if($r[dofeedbackf])
{
$dofeedbackf=" checked";
}
if($r[dotask])
{
$dotask=" checked";
}
if($r[domemberf])
{
$domemberf=" checked";
}
if($r[dospacestyle])
{
$dospacestyle=" checked";
}
if($r[dospacedata])
{
$dospacedata=" checked";
}
if($r[dovotemod])
{
$dovotemod=" checked";
}
if($r[doplayer])
{
$doplayer=" checked";
}
if($r[dowap])
{
$dowap=" checked";
}
if($r[dopay])
{
$dopay=" checked";
}

}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>用戶組</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
	if(e.name=='gr[doselfinfo]'||e.name=='gr[domustcheck]'||e.name=='gr[docheckedit]')
		{
		continue;
	    }
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListGroup.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">增加用戶組 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
        <input name="groupid" type="hidden" id="groupid" value="<?=$groupid?>">
        </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">名稱</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="20%" height="25">用戶組名稱：</td>
      <td width="80%" height="25"><input name="groupname" type="text" id="groupname" value="<?=$r[groupname]?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">權限</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">權限分配：</td>
      <td height="25"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#C3EFFF">
          <tr> 
            <td>系統設置</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="33%" height="23"> <input name="gr[dopublic]" type="checkbox" id="gr[dopublic]" value="1"<?=$dopublic?>>
                    系統參數設置</td>
                  <td width="33%" height="23"> <input name="gr[dopostdata]" type="checkbox" id="gr[dopostdata]" value="1"<?=$dopostdata?>>
                    遠程發佈</td>
                  <td width="33%" height="23"> <input name="gr[dochangedata]" type="checkbox" id="gr[dochangedata]" value="1"<?=$dochangedata?>>
                    數據更新</td>
                </tr>
                <tr> 
                  <td width="33%" height="23"><input name="gr[dof]" type="checkbox" id="gr[dof]" value="1"<?=$dof?>>
                    自定義字段</td>
                  <td width="33%" height="23"><input name="gr[dom]" type="checkbox" id="gr[dom]" value="1"<?=$dom?>>
                    系統模型管理</td>
                  <td width="33%" height="23"><input name="gr[dotable]" type="checkbox" id="gr[dotable]2" value="1"<?=$dotable?>>
                    數據表管理</td>
                </tr>
                <tr> 
                  <td width="33%" height="23"><input name="gr[dodbdata]" type="checkbox" id="gr[dodbdata]" value="1"<?=$dodbdata?>>
                    數據備份</td>
                  <td width="33%" height="23"><input name="gr[dodo]" type="checkbox" id="gr[dodo]2" value="1"<?=$dodo?>>
                    刷新任務管理</td>
                  <td width="33%" height="23"><input name="gr[dotask]" type="checkbox" value="1"<?=$dotask?>>
                    計劃任務管理</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[doexecsql]" type="checkbox" id="gr[doexecsql]" value="1"<?=$doexecsql?>>
                    執行SQL語句</td>
                  <td height="23"><input name="gr[doyh]" type="checkbox" id="gr[doyh]" value="1"<?=$r[doyh]==1?' checked':''?>>
                    優化方案管理</td>
                  <td height="23"><input name="gr[dofirewall]" type="checkbox" id="gr[dofirewall]" value="1"<?=$r[dofirewall]==1?' checked':''?>>
                    網站防火牆</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[dosetsafe]" type="checkbox" id="gr[dosetsafe]" value="1"<?=$r[dosetsafe]==1?' checked':''?>>
                    安全參數設置</td>
                  <td height="23"><input name="gr[doworkflow]" type="checkbox" id="gr[doworkflow]" value="1"<?=$r[doworkflow]==1?' checked':''?>>
                    工作流管理</td>
                  <td height="23"><input name="gr[dopubvar]" type="checkbox" id="gr[dopubvar]" value="1"<?=$r[dopubvar]==1?' checked':''?>>
                    擴展變量管理</td>
                </tr>
                <tr>
                  <td height="23"><input name="gr[domenu]" type="checkbox" id="gr[domenu]" value="1"<?=$r[domenu]==1?' checked':''?>>
                    菜單管理</td>
                  <td height="23"><input name="gr[domoreport]" type="checkbox" id="gr[domoreport]" value="1"<?=$r[domoreport]==1?' checked':''?>>
網站多訪問端管理</td>
                  <td height="23">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>信息管理</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="33%" height="23"> <input name="gr[doall]" type="checkbox" id="gr[doall]3" value="1"<?=$doall?>>
                    可操作所有信息</td>
                  <td><input name="gr[doselfinfo]" type="checkbox" id="gr[doselfinfo]" value="1"<?=$doselfinfo?>> 
                    <strong>只能操作自己發佈的信息</strong></td>
                </tr>
                <tr> 
                  <td height="23" colspan="2"><input name="gr[doaddinfo]" type="checkbox" id="gr[doaddinfo]" value="1"<?=$r['doaddinfo']==1?' checked':''?>>
                    增加權限， 
                    <input name="gr[doeditinfo]" type="checkbox" id="gr[doeditinfo]" value="1"<?=$r['doeditinfo']==1?' checked':''?>>
                    修改權限， 
                    <input name="gr[dodelinfo]" type="checkbox" id="gr[dodelinfo]" value="1"<?=$r['dodelinfo']==1?' checked':''?>>
                    刪除權限， 
                    
<input name="gr[dogoodinfo]" type="checkbox" id="gr[dogoodinfo]" value="1"<?=$r['dogoodinfo']==1?' checked':''?>>
推薦/頭條/置頂權限<br>
<input name="gr[docheckinfo]" type="checkbox" id="gr[docheckinfo]" value="1"<?=$r['docheckinfo']==1?' checked':''?>>
審核權限，
<input name="gr[dodocinfo]" type="checkbox" id="gr[dodocinfo]" value="1"<?=$r['dodocinfo']==1?' checked':''?>>
歸檔權限，
<input name="gr[domoveinfo]" type="checkbox" id="gr[domoveinfo]" value="1"<?=$r['domoveinfo']==1?' checked':''?>>
移動/複製權限，
<input name="gr[domustcheck]" type="checkbox" id="gr[domustcheck]" value="1"<?=$r['domustcheck']==1?' checked':''?>>
發佈的信息必須審核<br>
<input name="gr[docheckedit]" type="checkbox" id="gr[docheckedit]" value="1"<?=$r['docheckedit']==1?' checked':''?>>
審核後的信息不可修改</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>欄目管理</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="33%" height="23"><input name="gr[doclass]" type="checkbox" id="gr[doclass]2" value="1"<?=$doclass?>>
                    欄目管理</td>
                  <td width="33%" height="23"><input name="gr[dozt]" type="checkbox" id="gr[doclass]3" value="1"<?=$dozt?>>
                    專題管理</td>
                  <td width="33%" height="23"><input name="gr[docj]" type="checkbox" id="gr[docj]2" value="1"<?=$docj?>>
                    採集管理</td>
                </tr>
                <tr> 
                  <td width="33%" height="23"><input name="gr[dopl]" type="checkbox" id="gr[dopl]2" value="1"<?=$dopl?>>
                    評論管理</td>
                  <td width="33%" height="23"><input name="gr[dosetmclass]" type="checkbox" id="gr[dosetmclass]" value="1"<?=$dosetmclass?>>
                    批量設置欄目屬性</td>
                  <td width="33%" height="23"><input name="gr[doloadcj]" type="checkbox" id="gr[doloadcj]" value="1"<?=$r[doloadcj]==1?' checked':''?>>
採集規則導入與導出</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[domovenews]" type="checkbox" id="gr[domovenews]" value="1"<?=$domovenews?>>
                    批量轉移信息</td>
                  <td height="23"><input name="gr[dorepnewstext]" type="checkbox" id="gr[dorepnewstext]2" value="1"<?=$dorepnewstext?>>
                    批量替換字段值</td>
                  <td height="23"><input name="gr[dodelinfodata]" type="checkbox" id="gr[dodelinfodata]" value="1"<?=$dodelinfodata?>>
                    批量刪除信息</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[dofile]" type="checkbox" id="gr[dofile]2" value="1"<?=$dofile?>>
                    附件管理</td>
                  <td height="23"><input name="gr[dototaldata]" type="checkbox" id="gr[dototaldata]2" value="1"<?=$dototaldata?>>
                    統計信息數據</td>
                  <td height="23"><input name="gr[dosearchkey]" type="checkbox" id="gr[dosearchkey]2" value="1"<?=$dosearchkey?>>
                    搜索關鍵字</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[dovotemod]" type="checkbox" id="gr[dovotemod]" value="1"<?=$dovotemod?>>
                    預設投票管理</td>
                  <td height="23"><input name="gr[dowap]" type="checkbox" id="gr[dowap]" value="1"<?=$dowap?>>
                    WAP設置</td>
                  <td height="23"><input name="gr[dosearchall]" type="checkbox" id="gr[dosearchall]" value="1"<?=$r[dosearchall]==1?' checked':''?>>
                    全站搜索</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[doinfotype]" type="checkbox" value="1"<?=$r[doinfotype]==1?' checked':''?>>
                    標題分類管理</td>
                  <td height="23"><input name="gr[dopltable]" type="checkbox" id="gr[dopltable]" value="1"<?=$r[dopltable]==1?' checked':''?>>
                    管理評論分表</td>
                  <td height="23"><input name="gr[doplf]" type="checkbox" id="gr[doplf]" value="1"<?=$r[doplf]==1?' checked':''?>>
                    評論自定義字段</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[dotags]" type="checkbox" id="gr[dotags]" value="1"<?=$r[dotags]==1?' checked':''?>>
                    TAGS管理</td>
                  <td height="23"><input name="gr[dosp]" type="checkbox" id="gr[dosp]" value="1"<?=$r[dosp]==1?' checked':''?>>
                    碎片管理</td>
                  <td height="23"><input name="gr[doclassf]" type="checkbox" id="gr[doclassf]" value="1"<?=$r[doclassf]==1?' checked':''?>>
                    欄目自定義字段</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[doztf]" type="checkbox" id="gr[doztf]" value="1"<?=$r[doztf]==1?' checked':''?>>
                    專題自定義字段</td>
                  <td height="23"><input name="gr[douserpage]" type="checkbox" id="gr[douserpage]" value="1"<?=$douserpage?>>
                    自定義頁面管理</td>
                  <td height="23"><input name="gr[douserlist]" type="checkbox" value="1"<?=$douserlist?>>
                    自定義列表管理</td>
                </tr>
                <tr> 
                  <td height="22"><input name="gr[douserjs]" type="checkbox" value="1"<?=$douserjs?>>
                    自定義JS管理</td>
                  <td><input name="gr[dofiletable]" type="checkbox" id="gr[dofiletable]" value="1"<?=$r['dofiletable']==1?' checked':''?>>
                    附件分表管理</td>
                  <td><input name="gr[doinfodoc]" type="checkbox" id="gr[doinfodoc]" value="1"<?=$doinfodoc?>>
批量歸檔信息</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>模板管理</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="33%" height="23"><font color="#FF0000"> 
                    <input name="gr[dobq]" type="checkbox" id="gr[dobq]2" value="1"<?=$dobq?>>
                    </font>標籤管理 </td>
                  <td width="33%"><input name="gr[dotemplate]" type="checkbox" id="gr[dotemplate]" value="1"<?=$dotemplate?>>
                    模板管理</td>
                  <td width="33%"><input name="gr[dotempvar]" type="checkbox" id="gr[dotempvar]" value="1"<?=$dotempvar?>>
                    模板變量管理</td>
                </tr>
                <tr> 
                  <td height="22"><input name="gr[dotempgroup]" type="checkbox" id="gr[dotempgroup]2" value="1"<?=$dotempgroup?>>
                    模板組管理</td>
                  <td><input name="gr[dodttemp]" type="checkbox" id="gr[dodttemp]" value="1"<?=$r['dodttemp']==1?' checked':''?>>
動態頁面模板管理</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>用戶面板</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="33%" height="23"><input name="gr[dogroup]" type="checkbox" id="gr[dogroup]2" value="1"<?=$dogroup?>>
                    用戶組管理</td>
                  <td width="33%"><input name="gr[douser]" type="checkbox" id="gr[douser]2" value="1"<?=$douser?>>
                    用戶管理</td>
                  <td width="33%"><input name="gr[dolog]" type="checkbox" id="gr[dolog]" value="1"<?=$dolog?>>
                    日誌管理</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[domember]" type="checkbox" id="gr[domember]3" value="1"<?=$domember?>>
                    會員管理</td>
                  <td><input name="gr[domemberf]" type="checkbox" value="1"<?=$domemberf?>>
                    會員字段管理</td>
                  <td><input name="gr[docard]" type="checkbox" id="gr[docard]3" value="1"<?=$docard?>>
                    點卡管理</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[doadminstyle]" type="checkbox" id="gr[doadminstyle]4" value="1"<?=$doadminstyle?>>
                    後颱風格管理</td>
                  <td><input name="gr[dospacestyle]" type="checkbox" id="gr[dospacestyle]3" value="1"<?=$dospacestyle?>>
                    會員空間模板管理</td>
                  <td><input name="gr[dosendemail]" type="checkbox" id="gr[dosendemail]3" value="1"<?=$dosendemail?>>
                    批量發送郵件</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[domsg]" type="checkbox" value="1"<?=$domsg?>>
                    站內短消息管理</td>
                  <td><input name="gr[dospacedata]" type="checkbox" value="1"<?=$dospacedata?>>
                    會員空間數據管理</td>
                  <td><input name="gr[dobuygroup]" type="checkbox" value="1"<?=$r[dobuygroup]==1?' checked':''?>>
                    充值類型管理</td>
                </tr>
                <tr>
                  <td height="23"><input name="gr[dochadminstyle]" type="checkbox" id="gr[dochadminstyle]" value="1"<?=$r[dochadminstyle]==1?' checked':''?>>
                    改變後颱風格</td>
                  <td><input name="gr[douserclass]" type="checkbox" id="gr[douserclass]" value="1"<?=$r[douserclass]==1?' checked':''?>>
                    部門管理</td>
                  <td><input name="gr[domemberconnect]" type="checkbox" id="gr[domemberconnect]" value="1"<?=$r[domemberconnect]==1?' checked':''?>>
外部登錄管理</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>插件管理</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="33%" height="23"><input name="gr[doad]" type="checkbox" id="gr[doad]" value="1"<?=$doad?>>
                    廣告管理</td>
                  <td width="33%"><input name="gr[dovote]" type="checkbox" id="gr[dovote]2" value="1"<?=$dovote?>>
                    投票管理</td>
                  <td width="33%"><input name="gr[dolink]" type="checkbox" id="gr[dolink]2" value="1"<?=$dolink?>>
                    友情鏈接管理</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[dogbook]" type="checkbox" id="gr[dogbook]2" value="1"<?=$dogbook?>>
                    留言管理</td>
                  <td><input name="gr[dofeedback]" type="checkbox" id="gr[dofeedback]2" value="1"<?=$dofeedback?>>
                    反饋信息管理</td>
                  <td><input name="gr[dofeedbackf]" type="checkbox" id="gr[dofeedbackf]2" value="1"<?=$dofeedbackf?>>
                    自定義反饋字段</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[donotcj]" type="checkbox" id="gr[donotcj]" value="1"<?=$donotcj?>>
                    防採集隨機字符管理</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td>其他管理</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td width="33%" height="23"><input name="gr[dobefrom]" type="checkbox" id="gr[dobefrom]" value="1"<?=$dobefrom?>>
                    信息來源管理</td>
                  <td width="33%" height="23"><input name="gr[dowriter]" type="checkbox" id="gr[dowriter]" value="1"<?=$dowriter?>>
                    作者管理</td>
                  <td width="33%" height="23"><input name="gr[dokey]" type="checkbox" id="gr[dokey]2" value="1"<?=$dokey?>>
                    內容關鍵字管理</td>
                </tr>
                <tr> 
                  <td width="33%" height="23"><input name="gr[doword]" type="checkbox" id="gr[doword]2" value="1"<?=$doword?>>
                    過濾字符管理</td>
                  <td width="33%" height="23"><input name="gr[dodownurl]" type="checkbox" id="gr[dodownurl]2" value="1"<?=$dodownurl?>>
                    下載地址前綴管理</td>
                  <td width="33%" height="23"><input name="gr[dodeldownrecord]" type="checkbox" id="gr[dodeldownrecord]2" value="1"<?=$dodeldownrecord?>>
                    刪除下載記錄</td>
                </tr>
                <tr> 
                  <td width="33%" height="23"><input name="gr[dodownerror]" type="checkbox" id="gr[dodownerror]2" value="1"<?=$dodownerror?>>
                    錯誤報告管理</td>
                  <td width="33%" height="23"><input name="gr[dorepdownpath]" type="checkbox" id="gr[dorepdownpath]" value="1"<?=$dorepdownpath?>>
                    批量替換地址權限</td>
                  <td width="33%" height="23"><input name="gr[doplayer]" type="checkbox" id="gr[doplayer]" value="1"<?=$doplayer?>>
                    電影播放器管理</td>
                </tr>
                <tr> 
                  <td height="23"><input name="gr[doshopps]" type="checkbox" id="gr[doshopps]" value="1"<?=$doshopps?>>
                    商城配送方式管理</td>
                  <td height="23"><input name="gr[doshoppayfs]" type="checkbox" id="gr[doshoppayfs]" value="1"<?=$doshoppayfs?>>
                    商城支付方式管理</td>
                  <td height="23"><input name="gr[doshopdd]" type="checkbox" id="gr[doshopdd]" value="1"<?=$doshopdd?>>
                    商城訂單管理</td>
                </tr>
                <tr>
                  <td height="23"><input name="gr[dopicnews]" type="checkbox" id="gr[dopicnews]" value="1"<?=$dopicnews?>>
                    圖片信息管理</td>
                  <td height="23"><input name="gr[dopay]" type="checkbox" id="gr[dopay]" value="1"<?=$dopay?>>
                    在線支付管理</td>
                  <td height="23"><input name="gr[doprecode]" type="checkbox" id="gr[doprecode]" value="1"<?=$r[doprecode]==1?' checked':''?>>
商城優惠碼管理</td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置">
        <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
        選中全部</td>
    </tr>
  </table>
</form>
</body>
</html>
