<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//���ҥΤ�
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
<title>��x�a��</title>
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
    <td width="9%" height="25">�t�γ]�m</td>
    <td width="6%">�H���޲z</td>
    <td width="21%">��غ޲z</td>
    <td width="34%">�ҪO�޲z</td>
    <td width="9%">�Τ᭱�O</td>
    <td width="11%">����޲z</td>
    <td width="10%">��L�޲z</td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>�t�γ]�m</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('SetEnews.php<?=$ecms_hashur['whehref']?>','');">�t�ΰѼƳ]�m</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/SetRewrite.php<?=$ecms_hashur['whehref']?>','');">���R�A�ѼƳ]�m</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/ListPubVar.php<?=$ecms_hashur['whehref']?>','');">�X�i�ܶq</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/SetSafe.php<?=$ecms_hashur['whehref']?>','');">�w���Ѽưt�m</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pub/SetFirewall.php<?=$ecms_hashur['whehref']?>','');">����������</a></td>
        </tr>
        <tr> 
          <td><strong>�ƾڧ�s</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>','');">�ƾڧ�s����</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ReHtml/ReInfoUrl.php<?=$ecms_hashur['whehref']?>','');">��s�H�����a�}</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ReHtml/DoUpdateData.php<?=$ecms_hashur['whehref']?>','');">�ƾھ�z</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('PostUrlData.php<?=$ecms_hashur['whehref']?>','');">���{�o�G</a></td>
        </tr>
        <tr> 
          <td><strong>�ƾڪ�P�ҫ�</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/AddTable.php?enews=AddTable<?=$ecms_hashur['ehref']?>','');">�s�ؼƾڪ�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/ListTable.php<?=$ecms_hashur['whehref']?>','');">�޲z�ƾڪ�</a></td>
        </tr>
        <tr> 
          <td><strong>�p������</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListDo.php<?=$ecms_hashur['whehref']?>','');">�޲z��s����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListTask.php<?=$ecms_hashur['whehref']?>','');">�޲z�p������</a></td>
        </tr>
        <tr> 
          <td><strong>�u�@�y</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('workflow/AddWf.php?enews=AddWorkflow<?=$ecms_hashur['ehref']?>','');">�W�[�u�@�y</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('workflow/ListWf.php<?=$ecms_hashur['whehref']?>','');">�޲z�u�@�y</a></td>
        </tr>
        <tr> 
          <td><strong>�u�Ƥ��</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/ListYh.php<?=$ecms_hashur['whehref']?>','');">�޲z�u�Ƥ��</a></td>
        </tr>
		<tr> 
          <td><strong>�����h�X�ݺ�</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('moreport/ListMoreport.php<?=$ecms_hashur['whehref']?>','');">�޲z�����X�ݺ�</a></td>
        </tr>
		<tr> 
          <td><strong>�X�i���</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/MenuClass.php<?=$ecms_hashur['whehref']?>','');">�޲z���</a></td>
        </tr>
        <tr> 
          <td><strong>�ƥ�/��_�ƾ�</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ebak/ChangeDb.php<?=$ecms_hashur['whehref']?>','');">�ƥ��ƾ�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ebak/ReData.php<?=$ecms_hashur['whehref']?>','');">��_�ƾ�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ebak/ChangePath.php<?=$ecms_hashur['whehref']?>','');">�޲z�ƥ��ؿ�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/DoSql.php<?=$ecms_hashur['whehref']?>','');">����SQL�y�y</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('AddInfoChClass.php<?=$ecms_hashur['whehref']?>','');">�W�[�H��</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('ListAllInfo.php<?=$ecms_hashur['whehref']?>','');">�޲z�H��</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('ListAllInfo.php?ecmscheck=1<?=$ecms_hashur['ehref']?>','');">�f�֫H��</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('workflow/ListWfInfo.php<?=$ecms_hashur['whehref']?>','');">ñ�o�H��</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('sp/UpdateSp.php<?=$ecms_hashur['whehref']?>','');">��s�H��</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('special/UpdateZt.php<?=$ecms_hashur['whehref']?>','');">��s�M�D</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('openpage/AdminPage.php?leftfile=<?=urlencode('../pl/PlNav.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../pl/PlMain.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�޲z����')?><?=$ecms_hashur['ehref']?>','');">�޲z����</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('info/InfoMain.php<?=$ecms_hashur['whehref']?>','');">�ƾڲέp</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="GoToUrl('infotop.php<?=$ecms_hashur['whehref']?>','');">�Ʀ�έp</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="50%"><strong>��غ޲z</strong></td>
          <td><strong>�۩w�q����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListClass.php<?=$ecms_hashur['whehref']?>','');">�޲z���</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/PageClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�۩w�q��������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListPageClass.php<?=$ecms_hashur['whehref']?>','');">�޲z���(����)</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPage.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�۩w�q����</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" title="Not for free version.">��سX�ݱƦ�</a></td>
          <td><strong>�۩w�q�C��</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" title="Not for free version.">�]�m�X�ݲέp�Ѽ�</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/UserlistClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�۩w�q�C����� </a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('info/ListClassF.php<?=$ecms_hashur['whehref']?>','');">��ئ۩w�q�r�q</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListUserlist.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�۩w�q�C��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('SetMoreClass.php<?=$ecms_hashur['whehref']?>','');">��q�]�m����ݩ�</a></td>
          <td><strong>�۩w�qJS</strong></td>
        </tr>
        <tr> 
          <td><strong>�M�D�޲z</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/UserjsClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�۩w�qJS����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('special/ListZtClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�M�D����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListUserjs.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�۩w�qJS</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('special/ListZt.php<?=$ecms_hashur['whehref']?>','');">�޲z�M�D</a></td>
          <td><strong>�Ķ��޲z</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('special/ListZtF.php<?=$ecms_hashur['whehref']?>','');">�M�D�۩w�q�r�q 
            </a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('AddInfoC.php<?=$ecms_hashur['whehref']?>','');">�W�[�Ķ��`�I</a></td>
        </tr>
        <tr>
          <td><strong>���D�����޲z</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListInfoClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�Ķ��`�I</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('info/InfoType.php<?=$ecms_hashur['whehref']?>','');">�޲z���D����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('ListPageInfoClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�Ķ��`�I(����)</a></td>
        </tr>
        <tr> 
          <td><strong>�H���޲z</strong></td>
          <td><strong>WAP�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('sp/ListSpClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�H������</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/SetWap.php<?=$ecms_hashur['whehref']?>','');">WAP�]�m</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('sp/ListSp.php<?=$ecms_hashur['whehref']?>','');">�޲z�H��</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/WapStyle.php<?=$ecms_hashur['whehref']?>','');">�޲zWAP�ҪO</a></td>
        </tr>
        <tr> 
          <td><strong>TAGS�޲z</strong></td>
          <td><strong>��L�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tags/SetTags.php<?=$ecms_hashur['whehref']?>','');">�]�mTAGS�Ѽ�</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('TotalData.php<?=$ecms_hashur['whehref']?>','');">�έp�H���ƾ�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tags/TagsClass.php<?=$ecms_hashur['whehref']?>','');">�޲zTAGS����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/UserTotal.php<?=$ecms_hashur['whehref']?>','');">�Τ�o�G�έp</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tags/ListTags.php<?=$ecms_hashur['whehref']?>','');">�޲zTAGS</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('SearchKey.php<?=$ecms_hashur['whehref']?>','');">�޲z�j������r</a></td>
        </tr>
        <tr> 
          <td><strong>����޲z</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/RepNewstext.php<?=$ecms_hashur['whehref']?>','');">��q�����r�q��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('openpage/AdminPage.php?leftfile=<?=urlencode('../file/FileNav.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�޲z����')?><?=$ecms_hashur['ehref']?>','');">�޲z����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('MoveClassNews.php<?=$ecms_hashur['whehref']?>','');">��q�ಾ�H��</a></td>
        </tr>
        <tr> 
          <td><strong>��������j��</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('InfoDoc.php<?=$ecms_hashur['whehref']?>','');">�H����q�k��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('searchall/SetSearchAll.php<?=$ecms_hashur['whehref']?>','');">�����j���]�m</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('db/DelData.php<?=$ecms_hashur['whehref']?>','');">��q�R���H��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('searchall/ListSearchLoadTb.php<?=$ecms_hashur['whehref']?>','');">�޲z�j���ƾڷ�</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('other/ListVoteMod.php<?=$ecms_hashur['whehref']?>','');">�޲z�w�]�벼</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('searchall/ClearSearchAll.php<?=$ecms_hashur['whehref']?>','');">�M�z�j���ƾ�</a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="32%"><a href="#ecms" onclick="window.open('template/EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=600,scrollbars=yes,resizable=yes');window.close();"><strong>�d�ݼ��һy�k</strong></a></td>
          <td width="36%"><strong>���@�ҪO</strong></td>
          <td width="32%"><strong>�۩w�q�����ҪO</strong></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="window.open('template/MakeBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=600,scrollbars=yes,resizable=yes');window.close();"><strong>�۰ʥͦ�����</strong></a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=indextemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�קﭺ���ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddPagetemp.php?enews=AddPagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�W�[�۩w�q�����ҪO</a></td>
        </tr>
        <tr>
          <td><a href="#ecms" onclick="window.open('openpage/AdminPage.php?leftfile=<?=urlencode('../template/dttemppageleft.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�ʺA�����ҪO�޲z')?><?=$ecms_hashur['ehref']?>','dttemppage','');window.close();"><strong>�ʺA�����ҪO�޲z</strong></a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=cptemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�קﱱ��O�ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPagetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�۩w�q�����ҪO</a></td>
        </tr>
        <tr> 
          <td><strong>��ثʭ��ҪO</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=schalltemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�����j���ҪO</a></td>
          <td><strong>�벼�ҪO</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ClassTempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�ʭ��ҪO����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=searchformtemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�קﰪ�ŷj�����ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddVotetemp.php?enews=AddVoteTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�W�[�벼�ҪO</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListClasstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�ʭ��ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=searchformjs&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק��V�j��JS�ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListVotetemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�벼�ҪO</a></td>
        </tr>
        <tr> 
          <td><strong>�C��ҪO</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=searchformjs1&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק��a�V�j��JS�ҪO</a></td>
          <td><strong>���Һ޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�C��ҪO����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=otherlinktemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�����H���ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/BqClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z���Ҥ���</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListListtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�C��ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=gbooktemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�d���O�ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListBq.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z����</a></td>
        </tr>
        <tr> 
          <td><strong>���e�ҪO</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=pljstemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק����JS�եμҪO</a></td>
          <td><strong>��L�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/NewstempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z���e�ҪO����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=downpagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�̲פU�����ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/LoadTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">��q�ɤJ��ؼҪO</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListNewstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z���e�ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=downsofttemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�U���a�}�ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ChangeListTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">��q�󴫦C��ҪO</a></td>
        </tr>
        <tr> 
          <td><strong>���ҼҪO</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=onlinemovietemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�b�u����a�}�ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/RepTemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">��q�����ҪO�r��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/BqtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z���ҼҪO����</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=listpagetemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�C������ҪO</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListBqtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z���ҼҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=loginiframe&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�n�����A�ҪO</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><strong>���@�ҪO�ܶq</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/EditPublicTemp.php?tname=loginjstemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�ק�JS�եεn���ҪO</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/TempvarClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�ҪO�ܶq����</a></td>
          <td><strong>���L�ҪO</strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListTempvar.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�ҪO�ܶq</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddPrinttemp.php?enews=AddPrintTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�W�[���L�ҪO</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><strong>JS�ҪO</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPrinttemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z���L�ҪO</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/JsTempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲zJS�ҪO����</a></td>
          <td><strong>�j���ҪO</strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListJstemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲zJS�ҪO</a></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/SearchtempClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�j���ҪO����</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><strong>���צC��ҪO</strong></td>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListSearchtemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z�j���ҪO</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AddPltemp.php?enews=AddPlTemp&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�W�[���׼ҪO</a></td>
          <td><a href="#ecms" onclick="GoToUrl('template/TempGroup.php<?=$ecms_hashur['whehref']?>','');"><strong>�ҪO�պ޲z</strong></a></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/ListPltemp.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>','');">�޲z���׼ҪO</a></td>
          <td><a href="#ecms" onclick="GoToUrl('template/TempGroup.php<?=$ecms_hashur['whehref']?>','');"></a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>�Τ�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/EditPassword.php<?=$ecms_hashur['whehref']?>','');">�ק�ӤH���</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListGroup.php<?=$ecms_hashur['whehref']?>','');">�޲z�Τ��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/UserClass.php<?=$ecms_hashur['whehref']?>','');">�޲z����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListUser.php<?=$ecms_hashur['whehref']?>','');">�޲z�Τ�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListLog.php<?=$ecms_hashur['whehref']?>','');">�޲z�n����x</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('user/ListDolog.php<?=$ecms_hashur['whehref']?>','');">�޲z�ާ@��x</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('template/AdminStyle.php<?=$ecms_hashur['whehref']?>','');">�޲z��䭷��</a></td>
        </tr>
        <tr> 
          <td><strong>�|���޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMemberGroup.php<?=$ecms_hashur['whehref']?>','');">�޲z�|����</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMember.php<?=$ecms_hashur['whehref']?>','');">�޲z�|��</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ClearMember.php<?=$ecms_hashur['whehref']?>','');">��q�M�z�|��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMemberF.php<?=$ecms_hashur['whehref']?>','');">�޲z�|���r�q</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListMemberForm.php<?=$ecms_hashur['whehref']?>','');">�޲z�|�����</a></td>
        </tr>
        <tr> 
          <td><strong>�|���Ŷ��޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListSpaceStyle.php<?=$ecms_hashur['whehref']?>','');">�޲z�Ŷ��ҪO</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/MemberGbook.php<?=$ecms_hashur['whehref']?>','');">�޲z�Ŷ��d��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/MemberFeedback.php<?=$ecms_hashur['whehref']?>','');">�޲z�Ŷ����X</a></td>
        </tr>
        <tr>
          <td><strong>�~�����f</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/MemberConnect.php<?=$ecms_hashur['whehref']?>','');">�~���n�����f</a></td>
        </tr>
        <tr> 
          <td><strong>��L�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListBuyGroup.php<?=$ecms_hashur['whehref']?>','');">�޲z�R������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/ListCard.php<?=$ecms_hashur['whehref']?>','');">�޲z�I�d</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/GetFen.php<?=$ecms_hashur['whehref']?>','');">��q�ذe�I��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/SendEmail.php<?=$ecms_hashur['whehref']?>','');">��q�o�e�l��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/SendMsg.php<?=$ecms_hashur['whehref']?>','');">��q�o�e�u����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('member/DelMoreMsg.php<?=$ecms_hashur['whehref']?>','');">��q�R���u����</a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>�s�i�t��</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/AdClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�s�i����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListAd.php<?=$ecms_hashur['whehref']?>','');">�޲z�s�i</a></td>
        </tr>
        <tr> 
          <td><strong>�벼�t��</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/AddVote.php?enews=AddVote<?=$ecms_hashur['ehref']?>','');">�W�[�벼</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListVote.php<?=$ecms_hashur['whehref']?>','');">�޲z�벼</a></td>
        </tr>
        <tr> 
          <td><strong>�ͱ��챵�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/LinkClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�ͱ��챵����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListLink.php<?=$ecms_hashur['whehref']?>','');">�޲z�ͱ��챵</a></td>
        </tr>
        <tr> 
          <td><strong>�d���O�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/GbookClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�d������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/gbook.php<?=$ecms_hashur['whehref']?>','');">�޲z�d��</a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/DelMoreGbook.php<?=$ecms_hashur['whehref']?>','');">��q�R���d��</a></td>
        </tr>
        <tr> 
          <td><strong>�H�����X�޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/FeedbackClass.php<?=$ecms_hashur['whehref']?>','');">�޲z���X����</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/ListFeedbackF.php<?=$ecms_hashur['whehref']?>','');">�޲z���X�r�q</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('tool/feedback.php<?=$ecms_hashur['whehref']?>','');">�޲z�H�����X</a></td>
        </tr>
        <tr> 
          <td><a href="#ecms" onclick="GoToUrl('template/NotCj.php<?=$ecms_hashur['whehref']?>','');"><strong>�޲z���Ķ��H���r��</strong></a></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td><strong>�s�D�ҫ�����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/BeFrom.php<?=$ecms_hashur['whehref']?>','');">�޲z�H���ӷ�</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/writer.php<?=$ecms_hashur['whehref']?>','');">�޲z�@��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/key.php<?=$ecms_hashur['whehref']?>','');">�޲z���e����r</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/word.php<?=$ecms_hashur['whehref']?>','');">�޲z�L�o�r��</a></td>
        </tr>
        <tr> 
          <td><strong>�U���ҫ�����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/url.php<?=$ecms_hashur['whehref']?>','');">�޲z�a�}�e��</a></td>
        </tr>
        <tr> 
          <td> &nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/DelDownRecord.php<?=$ecms_hashur['whehref']?>','');">�R���U���O��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/ListError.php<?=$ecms_hashur['whehref']?>','');">�޲z���~���i</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/RepDownLevel.php<?=$ecms_hashur['whehref']?>','');">��q�����a�}�v��</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('DownSys/player.php<?=$ecms_hashur['whehref']?>','');">���񾹺޲z</a></td>
        </tr>
        <tr> 
          <td><strong>�ӫ��ҫ�����</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="window.open('openpage/AdminPage.php?leftfile=<?=urlencode('../ShopSys/pageleft.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../other/OtherMain.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�ӫ��t�κ޲z')?><?=$ecms_hashur['ehref']?>','AdminShopSys','');window.close();">�޲z�ӫ�</a></td>
        </tr>
        <tr> 
          <td><strong>�b�u��I</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/SetPayFen.php<?=$ecms_hashur['whehref']?>','');">��I�Ѽưt�m</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/PayApi.php<?=$ecms_hashur['whehref']?>','');">�޲z��I���f</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('pay/ListPayRecord.php<?=$ecms_hashur['whehref']?>','');">�޲z��I�O��</a></td>
        </tr>
        <tr> 
          <td><strong>�Ϥ��H���޲z</strong></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/PicClass.php<?=$ecms_hashur['whehref']?>','');">�޲z�Ϥ��H������</a></td>
        </tr>
        <tr> 
          <td>&nbsp;&nbsp;<a href="#ecms" onclick="GoToUrl('NewsSys/ListPicNews.php<?=$ecms_hashur['whehref']?>','');">�޲z�Ϥ��H��</a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
