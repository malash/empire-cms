<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<title><?=defined('empirecms')?$public_diyr[pagetitle]:'�Τᱱ��O'?> - Powered by EmpireCMS</title>
<meta name="keywords" content="<?=defined('empirecms')?$public_diyr[pagetitle]:'�Τᱱ��O'?>" />
<meta name="description" content="<?=defined('empirecms')?$public_diyr[pagetitle]:'�Τᱱ��O'?>" />
<link href="/ecms72/skin/default/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/ecms72/skin/default/js/tabs.js"></script>
</head>
<body class="listpage">
<!-- ���Y -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="top">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="63%">
<!-- �n�� -->
<script>
document.write('<script src="/ecms72/e/member/login/loginjs.php?t='+Math.random()+'"><'+'/script>');
</script>
</td>
<td align="right">
<a onclick="window.external.addFavorite(location.href,document.title)" href="#ecms">�[�J����</a> | <a onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('/ecms72/')" href="#ecms">�]������</a> | <a href="/ecms72/e/member/cp/">�|������</a> | <a href="/ecms72/e/DoInfo/">�ڭn��Z</a> | <a href="/ecms72/e/web/?type=rss2" target="_blank">RSS<img src="/ecms72/skin/default/images/rss.gif" border="0" hspace="2" /></a>
</td>
</tr>
</table></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="10">
<tr valign="middle">
<td width="240" align="center"><a href="/ecms72/"><img src="/ecms72/skin/default/images/logo.gif" width="200" height="65" border="0" /></a></td>
<td align="center"><a href="http://www.phome.net/OpenSource/" target="_blank"><img src="/ecms72/skin/default/images/opensource.gif" width="100%" height="70" border="0" /></a></td>
</tr>
</table>
<!-- �ɯ�tab�ﶵ�d -->
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="nav">
  <tr> 
    <td class="nav_global"><ul>
        <li class="curr" id="tabnav_btn_0" onmouseover="tabit(this)"><a href="/ecms72/">����</a></li>
        <li id="tabnav_btn_1" onmouseover="tabit(this)"><a href="/ecms72/news/">�s�D����</a></li>
        <li id="tabnav_btn_2" onmouseover="tabit(this)"><a href="/ecms72/download/">�U������</a></li>
        <li id="tabnav_btn_3" onmouseover="tabit(this)"><a href="/ecms72/movie/">�v���W�D</a></li>
        <li id="tabnav_btn_4" onmouseover="tabit(this)"><a href="/ecms72/shop/">���W�ӫ�</a></li>
        <li id="tabnav_btn_5" onmouseover="tabit(this)"><a href="/ecms72/flash/">FLASH�W�D</a></li>
        <li id="tabnav_btn_6" onmouseover="tabit(this)"><a href="/ecms72/photo/">�Ϥ��W�D</a></li>
        <li id="tabnav_btn_7" onmouseover="tabit(this)"><a href="/ecms72/article/">�峹����</a></li>
        <li id="tabnav_btn_8" onmouseover="tabit(this)"><a href="/ecms72/info/">�����H��</a></li>
      </ul></td>
  </tr>
</table> 
<table width="100%" border="0" cellspacing="10" cellpadding="0">
<tr valign="top">
<td class="list_content"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="position">
<tr>
<td>�{�b����m�G<?=$url?>
</td>
</tr>
</table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="box">
        <tr> 
          <td width="300" valign="top"> 
		  <?php
		  $lguserid=intval(getcvar('mluserid'));//�n���Τ�ID
		  $lgusername=RepPostVar(getcvar('mlusername'));//�n���Τ�
		  $lggroupid=intval(getcvar('mlgroupid'));//�|����ID
		  if($lggroupid)	//�n���|����ܵ��
		  {
		  ?>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
              <tr class="header"> 
                <td height="20" bgcolor="#FFFFFF"> <div align="center"><strong><a href="/ecms72/e/member/cp/">�\����</a></strong></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/EditInfo/">�ק���</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/my/">�b�����A</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/msg/">�����H��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/mspace/SetSpace.php">�Ŷ��]�m</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/DoInfo/">�޲z�H��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/fava/">���ç�</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/payapi/">�b�u��I</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/friend/">�ڪ��n��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/buybak/">���O�O��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/buygroup/">�b�u�R��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/card/">�I�d�R��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="#ecms" onclick="window.open('/ecms72/e/ShopSys/buycar/','','width=680,height=500,scrollbars=yes,resizable=yes');">�ڪ��ʪ���</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/ShopSys/ListDd/">�ڪ��q��</a></div></td>
              </tr>
			  <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/login/">���s�n��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/doaction.php?enews=exit" onclick="return confirm('�T�{�n�h�X?');">�h�X�n��</a></div></td>
              </tr>
            </table>
			<?php
			}
			else	//�C����ܵ��
			{
			?>  
            <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
              <tr class="header"> 
                <td height="20" bgcolor="#FFFFFF"> <div align="center"><strong><a href="/ecms72/e/member/cp/">�\����</a></strong></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/login/">�|���n��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/member/register/">���U�b��</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="/ecms72/e/DoInfo/">�o�G��Z</a></div></td>
              </tr>
              <tr> 
                <td height="25" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBF3FC'"><div align="center"><a href="#ecms" onclick="window.open('/ecms72/e/ShopSys/buycar/','','width=680,height=500,scrollbars=yes,resizable=yes');">�ڪ��ʪ���</a></div></td>
              </tr>
            </table>
			<?php
			}
			?>
			</td>
          <td width="85%" valign="top">