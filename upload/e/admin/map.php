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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>後台地圖</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function GoToUrl(url,totarget){
	if(totarget=='')
	{
		totarget='main';
	}
	opener.document.getElementById(totarget).src=url;
	window.close();
}
</script>
</head>

<body leftmargin="0" topmargin="0">
<table width="100%" height="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
  <tr class="header">
    <td width="9%" height="25">系統設置</td>
    <td width="6%">信息管理</td>
    <td width="21%">欄目管理</td>
    <td width="34%">模板管理</td>
    <td width="9%">用戶面板</td>
    <td width="11%">插件管理</td>
    <td width="10%">其他管理</td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>系統設置</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('SetEnews.php<?=$ecms_hashur['whehref']?>','');">系統參數設置</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/SetRewrite.php<?=$ecms_hashur['whehref']?>','');">偽靜態參數設置</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/ListPubVar.php<?=$ecms_hashur['whehref']?>','');">擴展變量</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/SetSafe.php<?=$ecms_hashur['whehref']?>','');">安全參數配置</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/SetFirewall.php<?=$ecms_hashur['whehref']?>','');">網站防火牆</a></td>
        </tr>
        <tr> 
          <td><strong>數據更新</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>','');">數據更新中心</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ReHtml/ReInfoUrl.php<?=$ecms_hashur['whehref']?>','');">更新信息頁地址</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ReHtml/DoUpdateData.php<?=$ecms_hashur['whehref']?>','');">數據整理</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('PostUrlData.php<?=$ecms_hashur['whehref']?>','');">遠程發佈</a></td>
        </tr>
        <tr> 
          <td><strong>數據表與模型</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/AddTable.php?enews=AddTable<?=$ecms_hashur['ehref']?>','');">新建數據表</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/ListTable.php<?=$ecms_hashur['whehref']?>','');">管理數據表</a></td>
        </tr>
        <tr> 
          <td><strong>計劃任務</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListDo.php<?=$ecms_hashur['whehref']?>','');">管理刷新任務</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListTask.php<?=$ecms_hashur['whehref']?>','');">管理計劃任務</a></td>
        </tr>
        <tr> 
          <td><strong>工作流</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('workflow/AddWf.php?enews=AddWorkflow<?=$ecms_hashur['ehref']?>','');">增加工作流</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('workflow/ListWf.php<?=$ecms_hashur['whehref']?>','');">管理工作流</a></td>
        </tr>
        <tr> 
          <td><strong>優化方案</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/ListYh.php<?=$ecms_hashur['whehref']?>','');">管理優化方案</a></td>
        </tr>
		<tr> 
          <td><strong>網站多訪問端</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('moreport/ListMoreport.php<?=$ecms_hashur['whehref']?>','');">管理網站訪問端</a></td>
        </tr>
		<tr> 
          <td><strong>擴展菜單</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/MenuClass.php<?=$ecms_hashur['whehref']?>','');">管理菜單</a></td>
        </tr>
        <tr> 
          <td><strong>備份/恢復數據</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ebak/ChangeDb.php<?=$ecms_hashur['whehref']?>','');">備份數據</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ebak/ReData.php<?=$ecms_hashur['whehref']?>','');">恢復數據</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ebak/ChangePath.php<?=$ecms_hashur['whehref']?>','');">管理備份目錄</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/DoSql.php<?=$ecms_hashur['whehref']?>','');">執行SQL語句</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('AddInfoChClass.php<?=$ecms_hashur['whehref']?>','');">增加信息</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('ListAllInfo.php<?=$ecms_hashur['whehref']?>','');">管理信息</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('ListAllInfo.php?ecmscheck=1<?=$ecms_hashur['ehref']?>','');">審核信息</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('workflow/ListWfInfo.php<?=$ecms_hashur['whehref']?>','');">簽發信息</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('sp/UpdateSp.php<?=$ecms_hashur['whehref']?>','');">更新碎片</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('special/UpdateZt.php<?=$ecms_hashur['whehref']?>','');">更新專題</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('openpage/AdminPage.php?leftfile=<?=urlencode('../pl/PlNav.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../pl/PlMain.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('管理評論')?><?=$ecms_hashur['ehref']?>','');">管理評論</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('info/InfoMain.php<?=$ecms_hashur['whehref']?>','');">數據統計</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('infotop.php<?=$ecms_hashur['whehref']?>','');">排行統計</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="50%"><strong>欄目管理</strong></td>
          <td><strong>自定義頁面</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListClass.php<?=$ecms_hashur['whehref']?>','');">管理欄目</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/PageClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理自定義頁面分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListPageClass.php<?=$ecms_hashur['whehref']?>','');">管理欄目(分頁)</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPage.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理自定義頁面</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" title="Not for free version.">欄目訪問排行</a></td>
          <td><strong>自定義列表</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" title="Not for free version.">設置訪問統計參數</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/UserlistClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理自定義列表分類 </a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('info/ListClassF.php<?=$ecms_hashur['whehref']?>','');">欄目自定義字段</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListUserlist.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理自定義列表</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('SetMoreClass.php<?=$ecms_hashur['whehref']?>','');">批量設置欄目屬性</a></td>
          <td><strong>自定義JS</strong></td>
        </tr>
        <tr> 
          <td><strong>專題管理</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/UserjsClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理自定義JS分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('special/ListZtClass.php<?=$ecms_hashur['whehref']?>','');">管理專題分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListUserjs.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理自定義JS</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('special/ListZt.php<?=$ecms_hashur['whehref']?>','');">管理專題</a></td>
          <td><strong>採集管理</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('special/ListZtF.php<?=$ecms_hashur['whehref']?>','');">專題自定義字段 
            </a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddInfoC.php<?=$ecms_hashur['whehref']?>','');">增加採集節點</a></td>
        </tr>
        <tr>
          <td><strong>標題分類管理</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListInfoClass.php<?=$ecms_hashur['whehref']?>','');">管理採集節點</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('info/InfoType.php<?=$ecms_hashur['whehref']?>','');">管理標題分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListPageInfoClass.php<?=$ecms_hashur['whehref']?>','');">管理採集節點(分頁)</a></td>
        </tr>
        <tr> 
          <td><strong>碎片管理</strong></td>
          <td><strong>WAP管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('sp/ListSpClass.php<?=$ecms_hashur['whehref']?>','');">管理碎片分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/SetWap.php<?=$ecms_hashur['whehref']?>','');">WAP設置</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('sp/ListSp.php<?=$ecms_hashur['whehref']?>','');">管理碎片</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/WapStyle.php<?=$ecms_hashur['whehref']?>','');">管理WAP模板</a></td>
        </tr>
        <tr> 
          <td><strong>TAGS管理</strong></td>
          <td><strong>其他管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tags/SetTags.php<?=$ecms_hashur['whehref']?>','');">設置TAGS參數</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('TotalData.php<?=$ecms_hashur['whehref']?>','');">統計信息數據</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tags/TagsClass.php<?=$ecms_hashur['whehref']?>','');">管理TAGS分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/UserTotal.php<?=$ecms_hashur['whehref']?>','');">用戶發佈統計</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tags/ListTags.php<?=$ecms_hashur['whehref']?>','');">管理TAGS</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('SearchKey.php<?=$ecms_hashur['whehref']?>','');">管理搜索關鍵字</a></td>
        </tr>
        <tr> 
          <td><strong>附件管理</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/RepNewstext.php<?=$ecms_hashur['whehref']?>','');">批量替換字段值</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('openpage/AdminPage.php?leftfile=<?=urlencode('../file/FileNav.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('管理附件')?><?=$ecms_hashur['ehref']?>','');">管理附件</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('MoveClassNews.php<?=$ecms_hashur['whehref']?>','');">批量轉移信息</a></td>
        </tr>
        <tr> 
          <td><strong>全站全文搜索</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('InfoDoc.php<?=$ecms_hashur['whehref']?>','');">信息批量歸檔</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('searchall/SetSearchAll.php<?=$ecms_hashur['whehref']?>','');">全站搜索設置</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/DelData.php<?=$ecms_hashur['whehref']?>','');">批量刪除信息</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('searchall/ListSearchLoadTb.php<?=$ecms_hashur['whehref']?>','');">管理搜索數據源</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListVoteMod.php<?=$ecms_hashur['whehref']?>','');">管理預設投票</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('searchall/ClearSearchAll.php<?=$ecms_hashur['whehref']?>','');">清理搜索數據</a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="32%"><a href="#ecms" onclick="window.open('template/EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=600,scrollbars=yes,resizable=yes');window.close();"><strong>查看標籤語法</strong></a></td>
          <td width="36%"><strong>公共模板</strong></td>
          <td width="32%"><strong>自定義頁面模板</strong></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="window.open('template/MakeBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=600,scrollbars=yes,resizable=yes');window.close();"><strong>自動生成標籤</strong></a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=indextemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改首頁模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddPagetemp.php?enews=AddPagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">增加自定義頁面模板</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="window.open('openpage/AdminPage.php?leftfile=<?=urlencode('../template/dttemppageleft.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('動態頁面模板管理')?><?=$ecms_hashur['ehref']?>','dttemppage','');window.close();"><strong>動態頁面模板管理</strong></a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=cptemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改控制面板模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPagetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理自定義頁面模板</a></td>
        </tr>
        <tr> 
          <td><strong>欄目封面模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=schalltemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改全站搜索模板</a></td>
          <td><strong>投票模板</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ClassTempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理封面模板分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=searchformtemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改高級搜索表單模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddVotetemp.php?enews=AddVoteTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">增加投票模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListClasstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理封面模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=searchformjs&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改橫向搜索JS模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListVotetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理投票模板</a></td>
        </tr>
        <tr> 
          <td><strong>列表模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=searchformjs1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改縱向搜索JS模板</a></td>
          <td><strong>標籤管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理列表模板分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=otherlinktemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改相關信息模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/BqClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理標籤分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListListtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理列表模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=gbooktemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改留言板模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListBq.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理標籤</a></td>
        </tr>
        <tr> 
          <td><strong>內容模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=pljstemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改評論JS調用模板</a></td>
          <td><strong>其他管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/NewstempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理內容模板分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=downpagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改最終下載頁模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/LoadTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">批量導入欄目模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListNewstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理內容模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=downsofttemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改下載地址模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ChangeListTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">批量更換列表模板</a></td>
        </tr>
        <tr> 
          <td><strong>標籤模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=onlinemovietemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改在線播放地址模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/RepTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">批量替換模板字符</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/BqtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理標籤模板分類</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=listpagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改列表分頁模板</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListBqtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理標籤模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=loginiframe&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改登陸狀態模板</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><strong>公共模板變量</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=loginjstemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">修改JS調用登陸模板</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/TempvarClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理模板變量分類</a></td>
          <td><strong>打印模板</strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListTempvar.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理模板變量</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddPrinttemp.php?enews=AddPrintTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">增加打印模板</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><strong>JS模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPrinttemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理打印模板</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/JsTempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理JS模板分類</a></td>
          <td><strong>搜索模板</strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListJstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理JS模板</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/SearchtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理搜索模板分類</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><strong>評論列表模板</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListSearchtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理搜索模板</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddPltemp.php?enews=AddPlTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">增加評論模板</a></td>
          <td><a href="#ecms" onclick="GoToUrl('template/TempGroup.php<?=$ecms_hashur['whehref']?>','');"><strong>模板組管理</strong></a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPltemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">管理評論模板</a></td>
          <td><a href="#ecms" onclick="GoToUrl('template/TempGroup.php<?=$ecms_hashur['whehref']?>','');"></a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>用戶管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/EditPassword.php<?=$ecms_hashur['whehref']?>','');">修改個人資料</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListGroup.php<?=$ecms_hashur['whehref']?>','');">管理用戶組</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/UserClass.php<?=$ecms_hashur['whehref']?>','');">管理部門</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListUser.php<?=$ecms_hashur['whehref']?>','');">管理用戶</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListLog.php<?=$ecms_hashur['whehref']?>','');">管理登陸日誌</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListDolog.php<?=$ecms_hashur['whehref']?>','');">管理操作日誌</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AdminStyle.php<?=$ecms_hashur['whehref']?>','');">管理後颱風格</a></td>
        </tr>
        <tr> 
          <td><strong>會員管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMemberGroup.php<?=$ecms_hashur['whehref']?>','');">管理會員組</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMember.php<?=$ecms_hashur['whehref']?>','');">管理會員</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ClearMember.php<?=$ecms_hashur['whehref']?>','');">批量清理會員</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMemberF.php<?=$ecms_hashur['whehref']?>','');">管理會員字段</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMemberForm.php<?=$ecms_hashur['whehref']?>','');">管理會員表單</a></td>
        </tr>
        <tr> 
          <td><strong>會員空間管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListSpaceStyle.php<?=$ecms_hashur['whehref']?>','');">管理空間模板</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/MemberGbook.php<?=$ecms_hashur['whehref']?>','');">管理空間留言</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/MemberFeedback.php<?=$ecms_hashur['whehref']?>','');">管理空間反饋</a></td>
        </tr>
        <tr>
          <td><strong>外部接口</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/MemberConnect.php<?=$ecms_hashur['whehref']?>','');">外部登錄接口</a></td>
        </tr>
        <tr> 
          <td><strong>其他管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListBuyGroup.php<?=$ecms_hashur['whehref']?>','');">管理充值類型</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListCard.php<?=$ecms_hashur['whehref']?>','');">管理點卡</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/GetFen.php<?=$ecms_hashur['whehref']?>','');">批量贈送點數</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/SendEmail.php<?=$ecms_hashur['whehref']?>','');">批量發送郵件</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/SendMsg.php<?=$ecms_hashur['whehref']?>','');">批量發送短消息</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/DelMoreMsg.php<?=$ecms_hashur['whehref']?>','');">批量刪除短消息</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>廣告系統</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/AdClass.php<?=$ecms_hashur['whehref']?>','');">管理廣告分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListAd.php<?=$ecms_hashur['whehref']?>','');">管理廣告</a></td>
        </tr>
        <tr> 
          <td><strong>投票系統</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/AddVote.php?enews=AddVote<?=$ecms_hashur['ehref']?>','');">增加投票</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListVote.php<?=$ecms_hashur['whehref']?>','');">管理投票</a></td>
        </tr>
        <tr> 
          <td><strong>友情鏈接管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/LinkClass.php<?=$ecms_hashur['whehref']?>','');">管理友情鏈接分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListLink.php<?=$ecms_hashur['whehref']?>','');">管理友情鏈接</a></td>
        </tr>
        <tr> 
          <td><strong>留言板管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/GbookClass.php<?=$ecms_hashur['whehref']?>','');">管理留言分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/gbook.php<?=$ecms_hashur['whehref']?>','');">管理留言</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/DelMoreGbook.php<?=$ecms_hashur['whehref']?>','');">批量刪除留言</a></td>
        </tr>
        <tr> 
          <td><strong>信息反饋管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/FeedbackClass.php<?=$ecms_hashur['whehref']?>','');">管理反饋分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListFeedbackF.php<?=$ecms_hashur['whehref']?>','');">管理反饋字段</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/feedback.php<?=$ecms_hashur['whehref']?>','');">管理信息反饋</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('template/NotCj.php<?=$ecms_hashur['whehref']?>','');"><strong>管理防採集隨機字符</strong></a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>新聞模型相關</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/BeFrom.php<?=$ecms_hashur['whehref']?>','');">管理信息來源</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/writer.php<?=$ecms_hashur['whehref']?>','');">管理作者</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/key.php<?=$ecms_hashur['whehref']?>','');">管理內容關鍵字</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/word.php<?=$ecms_hashur['whehref']?>','');">管理過濾字符</a></td>
        </tr>
        <tr> 
          <td><strong>下載模型相關</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/url.php<?=$ecms_hashur['whehref']?>','');">管理地址前綴</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/DelDownRecord.php<?=$ecms_hashur['whehref']?>','');">刪除下載記錄</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/ListError.php<?=$ecms_hashur['whehref']?>','');">管理錯誤報告</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/RepDownLevel.php<?=$ecms_hashur['whehref']?>','');">批量替換地址權限</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/player.php<?=$ecms_hashur['whehref']?>','');">播放器管理</a></td>
        </tr>
        <tr> 
          <td><strong>商城模型相關</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="window.open('openpage/AdminPage.php?leftfile=<?=urlencode('../ShopSys/pageleft.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../other/OtherMain.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('商城系統管理')?><?=$ecms_hashur['ehref']?>','AdminShopSys','');window.close();">管理商城</a></td>
        </tr>
        <tr> 
          <td><strong>在線支付</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/SetPayFen.php<?=$ecms_hashur['whehref']?>','');">支付參數配置</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/PayApi.php<?=$ecms_hashur['whehref']?>','');">管理支付接口</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/ListPayRecord.php<?=$ecms_hashur['whehref']?>','');">管理支付記錄</a></td>
        </tr>
        <tr> 
          <td><strong>圖片信息管理</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/PicClass.php<?=$ecms_hashur['whehref']?>','');">管理圖片信息分類</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/ListPicNews.php<?=$ecms_hashur['whehref']?>','');">管理圖片信息</a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
