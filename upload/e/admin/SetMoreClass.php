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
//�����v��
CheckLevel($logininid,$loginin,$classid,"setmclass");
$r[newline]=10;
$r[hotline]=10;
$r[goodline]=10;
$r[hotplline]=10;
$r[firstline]=10;
$url="<a href=SetMoreClass.php".$ecms_hashur['whehref'].">��q�]�m���</a>";
//�t�μҫ�
$m_sql=$empire->query("select mid,mname,usemod from {$dbtbpre}enewsmod order by myorder,mid");
while($m_r=$empire->fetch($m_sql))
{
	if(empty($m_r[usemod]))
	{
		if($m_r[mid]==$r[modid])
		{$m_d=" selected";}
		else
		{$m_d="";}
		$mod_options.="<option value=".$m_r[mid].$m_d.">".$m_r[mname]."</option>";
	}
	//�C��ҪO
	$listtemp_options.="<option value=0 style='background:#99C4E3'>".$m_r[mname]."</option>";
	$lt_sql=$empire->query("select tempid,tempname from ".GetTemptb("enewslisttemp")." where modid='$m_r[mid]'");
	while($lt_r=$empire->fetch($lt_sql))
	{
		if($lt_r[tempid]==$r[listtempid])
		{$lt_d=" selected";}
		else
		{$lt_d="";}
		$listtemp_options.="<option value=".$lt_r[tempid].$lt_d."> |-".$lt_r[tempname]."</option>";
	}
	//�j���ҪO
	$searchtemp.="<option value=0 style='background:#99C4E3'>".$m_r[mname]."</option>";
	$st_sql=$empire->query("select tempid,tempname from ".GetTemptb("enewssearchtemp")." where modid='$m_r[mid]'");
	while($st_r=$empire->fetch($st_sql))
	{
		if($st_r[tempid]==$r[searchtempid])
		{$st_d=" selected";}
		else
		{$st_d="";}
		$searchtemp.="<option value=".$st_r[tempid].$st_d."> |-".$st_r[tempname]."</option>";
	}
	$newstemp_options.="<option value=0 style='background:#99C4E3'>".$m_r[mname]."</option>";
	$nt_sql=$empire->query("select tempid,tempname from ".GetTemptb("enewsnewstemp")." where modid='$m_r[mid]'");
	while($nt_r=$empire->fetch($nt_sql))
	{
		if($nt_r[tempid]==$r[newstempid])
		{$nt_d=" selected";}
		else
		{$nt_d="";}
		$newstemp_options.="<option value=".$nt_r[tempid].$nt_d."> |-".$nt_r[tempname]."</option>";
	}
}
//�|����
$qgroup='';
$qgbr='';
$qgi=0;
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	if($r[groupid]==$l_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$l_r[groupid].$select.">".$l_r[groupname]."</option>";
	//��Z
	$qgi++;
	if($qgi%6==0)
	{
		$qgbr='<br>';
	}
	else
	{
		$qgbr='';
	}
	$qgchecked='';
	if(strstr($r[qaddgroupid],','.$l_r[groupid].','))
	{
		$qgchecked=' checked';
	}
	$qgroup.="<input type=checkbox name=qaddgroupidck[] value='".$l_r[groupid]."'".$qgchecked.">".$l_r[groupname]."&nbsp;".$br;
}
//�ʭ��ҪO
$classtempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsclasstemp")." order by tempid");
while($classtempr=$empire->fetch($classtempsql))
{
	$select="";
	if($r[classtempid]==$classtempr[tempid])
	{
		$select=" selected";
	}
	$classtemp.="<option value='".$classtempr[tempid]."'".$select.">".$classtempr[tempname]."</option>";
}
//js�ҪO
$jstempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsjstemp")." order by tempid");
while($jstempr=$empire->fetch($jstempsql))
{
	$select="";
	if($r[jstempid]==$jstempr[tempid])
	{
		$select=" selected";
	}
	$jstemp.="<option value='".$jstempr[tempid]."'".$select.">".$jstempr[tempname]."</option>";
}
//���׼ҪO
$pltempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewspltemp")." order by tempid");
while($pltempr=$empire->fetch($pltempsql))
{
	$select="";
	if($r[pltempid]==$pltempr[tempid])
	{
		$select=" selected";
	}
	$pltemp.="<option value='".$pltempr[tempid]."'".$select.">".$pltempr[tempname]."</option>";
}
//WAP�ҪO
$wapstyles='';
$wapstyle_sql=$empire->query("select styleid,stylename from {$dbtbpre}enewswapstyle order by styleid");
while($wapstyle_r=$empire->fetch($wapstyle_sql))
{
	$select="";
	if($r[wapstyleid]==$wapstyle_r[styleid])
	{
		$select=" selected";
	}
	$wapstyles.="<option value='".$wapstyle_r[styleid]."'".$select.">".$wapstyle_r[stylename]."</option>";
}
//�w�]�벼
$infovotesql=$empire->query("select voteid,ysvotename from {$dbtbpre}enewsvotemod order by voteid desc");
while($infovoter=$empire->fetch($infovotesql))
{
	$select="";
	if($r[definfovoteid]==$infovoter[voteid])
	{
		$select=" selected";
	}
	$definfovote.="<option value='".$infovoter[voteid]."'".$select.">".$infovoter[ysvotename]."</option>";
}
//--------------------�ާ@�����
$fcfile="../data/fc/ListEnews.php";
$do_class="<script src=../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$do_class=ShowClass_AddClass("","n",0,"|-",0,0);}
db_close();
$empire=null;
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q�]�m���</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="ecmsclass.php" onsubmit="return confirm('�T�{�n�ާ@?');">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">��q�]�m����ݩ�</div></td>
    </tr>
    <tr> 
      <td width="23%" height="25" valign="top" bgcolor="#FFFFFF">
<div align="center">
          <select name="classid[]" size="73" multiple id="classid[]" style="width:180">
            <?=$do_class?>
          </select>
          <br>
          ��ܦh����ؽХ�CTRL/SHIFT</div></td>
      <td width="77%" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><div align="center">�ק�</div></td>
            <td colspan="2">�]�m����</td>
          </tr>
          <tr class="header"> 
            <td width="6%" height="25"> <div align="center"></div></td>
            <td colspan="2"><font class=tabcolor><strong>���ݩʳ]�m</strong></font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="doclasstype" type="checkbox" id="doclasstype" value="1">
              </div></td>
            <td width="23%" bgcolor="#FFFFFF">��ؤ���X�i�W</td>
            <td width="71%" bgcolor="#FFFFFF"> <input name="classtype" type="text" id="classtype" value=".html" size="10"> 
              <select name="select" onchange="document.form1.classtype.value=this.value">
                <option value=".html">�X�i�W</option>
                <option value=".html">.html</option>
                <option value=".htm">.htm</option>
                <option value=".php">.php</option>
                <option value=".shtml">.shtml</option>
              </select> </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dolisttempid" type="checkbox" id="dolisttempid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">���ݦC��ҪO</td>
            <td bgcolor="#FFFFFF"><select name="listtempid" id="listtempid">
                <?=$listtemp_options?>
              </select> <input type="button" name="Submit6222" value="�޲z�C��ҪO" onclick="window.open('template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dodtlisttempid" type="checkbox" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�ʺA�C��ҪO</td>
            <td bgcolor="#FFFFFF"><select name="dtlisttempid">
                <?=$listtemp_options?>
              </select> <input type="button" name="Submit62226" value="�޲z�C��ҪO" onclick="window.open('template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"> 
            </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="domaxnum" type="checkbox" id="dobmaxnum" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">����`�O����</td>
            <td bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="0" size="5">
              ��<font color="#666666">(0����ܩҦ��O��)</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dolencord" type="checkbox" id="domaxnum" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�C����ܰO����</td>
            <td bgcolor="#FFFFFF"><input name="lencord" type="text" id="lencord" value="25" size="5">
              ��</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="dosearchtempid" type="checkbox" id="dosearchtempid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�j���ҪO</td>
            <td bgcolor="#FFFFFF"> <select name="searchtempid" id="searchtempid">
                <option value="0">�ϥ��q�{�ҪO </option>
                <?=$searchtemp?>
              </select> <input type="button" name="Submit62" value="�޲z�j���ҪO" onclick="window.open('template/ListSearchtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dowapstyleid" type="checkbox" id="dowapstyleid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">WAP�ҪO</td>
            <td bgcolor="#FFFFFF"><select name="wapstyleid" id="wapstyleid">
                <option value="0">�ϥ��q�{�ҪO</option>
                <?=$wapstyles?>
              </select> <input type="button" name="Submit6232" value="�޲zWAP�ҪO" onclick="window.open('other/WapStyle.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="dolistorder" type="checkbox" id="dosearchtempid3" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�޲z�H���ƧǤ覡</td>
            <td bgcolor="#FFFFFF">
<input name="listorder" type="text" id="listorder" value="id DESC" size="38">
            </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="doreorder" type="checkbox" id="doreorder" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�C�������ƧǤ覡</td>
            <td bgcolor="#FFFFFF">
<input name="reorder" type="text" id="reorder" value="newstime DESC" size="38">
            </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="dolistdt" type="checkbox" id="dolistdt" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">��ح��Ҧ�</td>
            <td bgcolor="#FFFFFF"> <input type="radio" name="listdt" value="0"<?=$r[listdt]==0?' checked':''?>>
              �R�A����
<input type="radio" name="listdt" value="1"<?=$r[listdt]==1?' checked':''?>>
              �ʺA����</td>
          </tr>
          <tr> 
            <td height="24" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="doshowdt" type="checkbox" id="doshowdt" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">���e���Ҧ�</td>
            <td bgcolor="#FFFFFF"> <input type="radio" name="showdt" value="0"<?=$r[showdt]==0?' checked':''?>>
              �R�A���� 
              <input type="radio" name="showdt" value="1"<?=$r[showdt]==1?' checked':''?>>
              �ʺA�ͦ� 
              <input type="radio" name="showdt" value="2"<?=$r[showdt]==2?' checked':''?>>
              �ʺA����</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="doshowclass" type="checkbox" id="doshowclass" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�O�_��ܨ�ɯ�</td>
            <td bgcolor="#FFFFFF"> <input type="radio" name="showclass" value="0"<?=$r[showclass]==0?' checked':''?>>
              �O 
              <input type="radio" name="showclass" value="1"<?=$r[showclass]==1?' checked':''?>>
              �_<font color="#666666">&nbsp; </font><font color="#666666">(�p�G�ɯ���ҡA�a�ϼ���)</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doopenadd" type="checkbox" id="doopenadd" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�}���Z�\��</td>
            <td bgcolor="#FFFFFF"><input name="openadd" type="radio" value="0" checked<?=$openadd0?>>
              �O 
              <input type="radio" name="openadd" value="1"<?=$openadd1?>>
              �_</td>
          </tr>
          <tr class="header"> 
            <td height="25"> <div align="center"></div></td>
            <td colspan="2"><strong>�ﶵ�]�m[�j���]</strong></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doclasstempid" type="checkbox" id="doclasstempid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�ʭ��ҪO</td>
            <td bgcolor="#FFFFFF"><select name="classtempid">
                <?=$classtemp?>
              </select> <input type="button" name="Submit62232" value="�޲z�ʭ��ҪO" onclick="window.open('template/ListClasstemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"> 
            </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <input name="doislist" type="checkbox" id="doshowclass3" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�C��</td>
            <td bgcolor="#FFFFFF"><input type="radio" name="islist" value="0"<?=$r[islist]==0?' checked':''?>>
              �ʭ��� 
              <input type="radio" name="islist" value="1"<?=$r[islist]==1?' checked':''?>>
              �C�� 
              <input type="radio" name="islist" value="2"<?=$r[islist]==2?' checked':''?>>
              �������e��</td>
          </tr>
          <tr class="header"> 
            <td height="25"> <div align="center"></div></td>
            <td colspan="2"><strong>�ﶵ�]�m[�׷����]</strong></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="donewstempid" type="checkbox" id="donewstempid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">���ݤ��e�ҪO</td>
            <td bgcolor="#FFFFFF"><select name="newstempid" id="newstempid">
                <?=$newstemp_options?>
              </select> <input type="button" name="Submit62222" value="�޲z���e�ҪO" onclick="window.open('template/ListNewstemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');">
              ( 
              <input name="tobetempinfo" type="checkbox" id="tobetempinfo" value="1">
              ���Ω�w�ͦ����H��)</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dopltempid" type="checkbox" id="dopltempid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">���ݵ��׼ҪO</td>
            <td bgcolor="#FFFFFF"><select name="pltempid" id="pltempid">
                <option value="0">�ϥ��q�{�ҪO </option>
                <?=$pltemp?>
              </select> <input type="button" name="Submit623" value="�޲z���׼ҪO" onclick="window.open('template/ListPltemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dolink_num" type="checkbox" id="dolencord" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�����챵��ܰO����</td>
            <td bgcolor="#FFFFFF"><input name="link_num" type="text" id="link_num" value="10" size="5">
              ��<font color="#666666">(0�����ͦ������챵)</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doinfopath" type="checkbox" id="doinfopath" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">���e���s��ؿ�</td>
            <td bgcolor="#FFFFFF"><input type="radio" name="infopath" value="0"<?=$r[ipath]==''?' checked':''?>>
              ��إؿ� 
              <input type="radio" name="infopath" value="1"<?=$r[ipath]<>''?' checked':''?>>
              �۩w�q�G / 
              <input name="ipath" type="text" id="ipath" value="<?=$r[ipath]?>"> 
              <font color="#666666">(�q�ڥؿ��}�l)</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="donewspath" type="checkbox" id="dolink_num" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�H�����ؿ��s��Φ�</td>
            <td bgcolor="#FFFFFF"><input name="newspath" type="text" id="newspath" value="<?=$r[newspath]?>" size="10"> 
              <select name="select2" onchange="document.form1.newspath.value=this.value">
                <option value="Y-m-d">���</option>
                <option value="Y-m-d">2005-01-27</option>
                <option value="Y/m-d">2005/01-27</option>
                <option value="Y/m/d">2005/01/27</option>
                <option value="Ymd">20050127</option>
                <option value="">���]�m�ؿ�</option>
              </select> <font color="#666666">(�pY-m-d,Y/m-d,Ymd���Φ�)</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dofilename_qz" type="checkbox" id="donewspath" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�H�������W�e��</td>
            <td bgcolor="#FFFFFF"> <input name="filename_qz" type="text" id="filename_qz" value="<?=$r[filename_qz]?>" size="15"> 
            </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dofilename" type="checkbox" id="dofilename" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�H�������R�W�W�h</td>
            <td bgcolor="#FFFFFF"><input name="filename" type="radio" value="0" checked>
              �H��ID 
              <input type="radio" name="filename" value="1">
              time() 
              <input type="radio" name="filename" value="2">
              md5() 
              <input type="radio" name="filename" value="3">
              �ؿ�</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dofiletype" type="checkbox" id="dofiletype" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�H��������X�i�W</td>
            <td bgcolor="#FFFFFF"><input name="filetype" type="text" id="filetype" value=".html" size="10"> 
              <select name="select3" onchange="document.form1.filetype.value=this.value">
                <option value=".html">�X�i�W</option>
                <option value=".html">.html</option>
                <option value=".htm">.htm</option>
                <option value=".php">.php</option>
                <option value=".shtml">.shtml</option>
              </select>
              (�p.html,.xml,.htm��)</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doopenpl" type="checkbox" id="doopenpl" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�O�_�}����ץ\��</td>
            <td bgcolor="#FFFFFF"><input name="openpl" type="radio" value="0" checked<?=$openpl0?>>
              �O 
              <input type="radio" name="openpl" value="1"<?=$openpl1?>>
              �_</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="docheckpl" type="checkbox" id="docheckpl" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">���׻ݭn�f��</td>
            <td bgcolor="#FFFFFF"><input name="checkpl" type="checkbox" id="checkpl2" value="1"<?=$checkpl?>>
              �O</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doqaddshowkey" type="checkbox" id="docheckpl3" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">��Z�}�����ҽX</td>
            <td bgcolor="#FFFFFF"><input name="qaddshowkey" type="checkbox" id="qaddshowkey2" value="1"<?=$r['qaddshowkey']==1?' checked':''?>>
              �O </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="docheckqadd" type="checkbox" id="doqaddshowkey" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">��Z�ݭn�f��</td>
            <td bgcolor="#FFFFFF"><input name="checkqadd" type="checkbox" id="checkqadd2" value="1"<?=$r['checkqadd']==1?' checked':''?>>
              �����q�L�f��</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doqaddgroupid" type="checkbox" id="doqaddgroupid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">��Z�v��</td>
            <td bgcolor="#FFFFFF"> 
              <?=$qgroup?>
            </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doqaddlist" type="checkbox" id="doqaddlist" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">��Z�ͦ��C��</td>
            <td bgcolor="#FFFFFF"><select name="qaddlist" id="qaddlist">
                <option value="0"<?=$r['qaddlist']==0?' selected':''?>>���ͦ�</option>
                <option value="1"<?=$r['qaddlist']==1?' selected':''?>>�ͦ���e���</option>
                <option value="2"<?=$r['qaddlist']==2?' selected':''?>>�ͦ�����</option>
                <option value="3"<?=$r['qaddlist']==3?' selected':''?>>�ͦ������</option>
                <option value="4"<?=$r['qaddlist']==4?' selected':''?>>�ͦ���e��ػP�����</option>
                <option value="5"<?=$r['qaddlist']==5?' selected':''?>>�ͦ�����ػP����</option>
                <option value="6"<?=$r['qaddlist']==6?' selected':''?>>�ͦ���e��ءB����ػP����</option>
              </select></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doaddinfofen" type="checkbox" id="doaddinfofen" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">��g��Z�f�֫���o</td>
            <td bgcolor="#FFFFFF"><input name="addinfofen" type="text" id="addinfofen" value="<?=$r[addinfofen]?>" size="6">
              �I�� <font color="#666666">(���W�[�г]��0,���I�г]���t��)</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doadminqinfo" type="checkbox" id="doadminqinfo" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�޲z��Z</td>
            <td bgcolor="#FFFFFF"><strong> 
              <select name="adminqinfo" id="adminqinfo">
                <option value="0"<?=$r['adminqinfo']==0?' selected':''?>>����޲z�H��</option>
                <option value="1"<?=$r['adminqinfo']==1?' selected':''?>>�i�޲z���f�֫H��</option>
                <option value="2"<?=$r['adminqinfo']==2?' selected':''?>>�u�i�s�襼�f�֫H��</option>
                <option value="3"<?=$r['adminqinfo']==3?' selected':''?>>�u�i�R�����f�֫H��</option>
                <option value="4"<?=$r['adminqinfo']==4?' selected':''?>>�i�޲z�Ҧ��H��</option>
                <option value="5"<?=$r['adminqinfo']==5?' selected':''?>>�u�i�s��Ҧ��H��</option>
                <option value="6"<?=$r['adminqinfo']==6?' selected':''?>>�u�i�R���Ҧ��H��</option>
              </select>
              </strong></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doqeditchecked" type="checkbox" id="doqeditchecked" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�s���Z�ݭn�f��</td>
            <td bgcolor="#FFFFFF"><strong> 
              <input name="qeditchecked" type="checkbox" id="qeditchecked" value="1"<?=$r['qeditchecked']==1?' checked':''?>>
              </strong>�O</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doaddreinfo" type="checkbox" id="doaddreinfo" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�o�G�H���ͦ����e��</td>
            <td bgcolor="#FFFFFF"><input name="addreinfo" type="checkbox" id="addreinfo" value="1"<?=$r['addreinfo']==1?' checked':''?>>
              �O</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dohaddlist" type="checkbox" id="dohaddlist" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�o�G�H���ͦ��C��</td>
            <td bgcolor="#FFFFFF"><select name="haddlist" id="haddlist">
                <option value="0"<?=$r['haddlist']==0?' selected':''?>>���ͦ�</option>
                <option value="1"<?=$r['haddlist']==1?' selected':''?>>�ͦ���e���</option>
                <option value="2"<?=$r['haddlist']==2?' selected':''?>>�ͦ�����</option>
                <option value="3"<?=$r['haddlist']==3?' selected':''?>>�ͦ������</option>
                <option value="4"<?=$r['haddlist']==4?' selected':''?>>�ͦ���e��ػP�����</option>
                <option value="5"<?=$r['haddlist']==5?' selected':''?>>�ͦ�����ػP����</option>
                <option value="6"<?=$r['haddlist']==6?' selected':''?>>�ͦ���e��ءB����ػP����</option>
              </select></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dosametitle" type="checkbox" id="dosametitle" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�˴����D����</td>
            <td bgcolor="#FFFFFF"><input name="sametitle" type="checkbox" id="sametitle" value="1"<?=$r['sametitle']==1?' checked':''?>>
              �O</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dochecked" type="checkbox" id="dochecked" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�o�G�H���O�_�����f��</td>
            <td bgcolor="#FFFFFF"><input name="checked" type="checkbox" id="checked" value="1"<?=$checked?>>
              �O</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dorepreinfo" type="checkbox" id="dorepreinfo" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�o�G�H���ͦ��W�@�g�H��</td>
            <td bgcolor="#FFFFFF"><input name="repreinfo" type="checkbox" id="repreinfo" value="1"<?=$r[repreinfo]==1?' checked':''?>>
              �O</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dodefinfovoteid" type="checkbox" id="dodefinfovoteid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�H���w�]�벼</td>
            <td bgcolor="#FFFFFF"><select name="definfovoteid" id="definfovoteid">
                <option value="0">���]�m</option>
                <?=$definfovote?>
              </select> <input type="button" name="Submit622" value="�޲z�w�]�벼" onclick="window.open('other/ListVoteMod.php<?=$ecms_hashur['whehref']?>');"> 
              <font color="#666666">&nbsp;</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dogroupid" type="checkbox" id="dogroupid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�q�{�d�ݫH���v��</td>
            <td bgcolor="#FFFFFF"><select name="groupid" id="groupid">
                <option value="0">�C��</option>
                <?=$group?>
              </select> <font color="#666666">(�W�[�H�����q�{���|�����v��)</font></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dodoctime" type="checkbox" id="dodoctime" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�k�ɮɶ�</td>
            <td bgcolor="#FFFFFF">�k�ɤj�� 
              <input name="doctime" type="text" id="doctime" value="100" size="6">
              �Ѫ��H��<font color="#666666">(0�����k��)</font></td>
          </tr>
          <tr class="header"> 
            <td height="25"> <div align="center"></div></td>
            <td colspan="2"><strong>�S��ҫ��]�m</strong></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dodown_num" type="checkbox" id="dodown_num" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�U��/�v���ҫ�</td>
            <td bgcolor="#FFFFFF">�C����� 
              <input name="down_num" type="text" id="link_num3" value="1" size="5">
              �ӤU���a�}</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="doonline_num" type="checkbox" id="do3" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�v���ҫ�</td>
            <td bgcolor="#FFFFFF">�C����� 
              <input name="online_num" type="text" id="down_num" value="1" size="5">
              �Ӧb�u�[�ݦa�}</td>
          </tr>
          <tr class="header"> 
            <td height="25"> <div align="center"></div></td>
            <td colspan="2"><strong>JS�եγ]�m</strong></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dojstempid" type="checkbox" id="doonline_num" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�ҥ�JS�ҪO</td>
            <td bgcolor="#FFFFFF"><select name="jstempid" id="jstempid">
                <?=$jstemp?>
              </select> <input type="button" name="Submit62223" value="�޲zJS�ҪO" onclick="window.open('template/ListJstemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="donewjs" type="checkbox" id="dojstempid" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�̷s�H��js�]�m</td>
            <td bgcolor="#FFFFFF">�ե� 
              <input name="newline" type="text" id="newline" value="<?=$r[newline]?>" size="6">
              ���O��</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dohotjs" type="checkbox" id="do4" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�����H��js�]�m</td>
            <td bgcolor="#FFFFFF">�ե� 
              <input name="hotline" type="text" id="hotline" value="<?=$r[hotline]?>" size="6">
              ���O��</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dogoodjs" type="checkbox" id="do5" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">���˫H��js�]�m</td>
            <td bgcolor="#FFFFFF">�ե� 
              <input name="goodline" type="text" id="goodline" value="<?=$r[goodline]?>" size="6">
              ���O��</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dohotpljs" type="checkbox" id="do6" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�������׫H��js�]�m</td>
            <td bgcolor="#FFFFFF">�ե� 
              <input name="hotplline" type="text" id="hotplline" value="<?=$r[hotplline]?>" size="6">
              ���O��</td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"><div align="center"> 
                <input name="dofirstjs" type="checkbox" id="do7" value="1">
              </div></td>
            <td bgcolor="#FFFFFF">�Y���H��js�]�m</td>
            <td bgcolor="#FFFFFF">�ե� 
              <input name="firstline" type="text" id="firstline" value="<?=$r[firstline]?>" size="6">
              ���O��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <div align="center"> </div></td>
            <td colspan="2"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"> 
              <input name="enews" type="hidden" id="enews" value="SetMoreClass"></td>
          </tr>
        </table></td>
    </tr>
  </form>
</table>
</body>
</html>
