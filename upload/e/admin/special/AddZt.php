<?php
define('EmpireCMSAdmin','1');
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/functions.php');
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//���ҥΤ�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();

$enews=ehtmlspecialchars($_GET['enews']);
$ztid=(int)$_GET['ztid'];
if($enews=='EditZt')
{
	//�����v��
	$returnandlevel=CheckAndUsernamesLevel('dozt',$ztid,$logininid,$loginin,$loginlevel);
}
else
{
	//�����v��
	CheckLevel($logininid,$loginin,$classid,"zt");
	$returnandlevel=2;
}
$url="<a href=ListZt.php".$ecms_hashur['whehref'].">�޲z�M�D</a>&nbsp;>&nbsp;�W�[�M�D";
$postword='�W�[�M�D';
//��ϤƼƾ�
$r[reorder]="newstime DESC";
$r[maxnum]=0;
$r[ztnum]=25;
$r[zttype]=".html";
$r[newline]=10;
$r[hotline]=10;
$r[goodline]=10;
$r[hotplline]=10;
$r[firstline]=10;
$pripath='s/';
//�ƻs�M�D
$docopy=RepPostStr($_GET['docopy'],1);
if($docopy&&$enews=="AddZt")
{
	$copyclass=1;
}
$ecmsfirstpost=1;
if($enews=='EditZt')
{
	$filepass=$ztid;
}
else
{
	$filepass=ReturnTranFilepass();
}
//�ק�M�D
if($enews=="EditZt"||$copyclass)
{
	$ecmsfirstpost=0;
	if($copyclass)
	{
		$thisdo="�ƻs";
	}
	else
	{
		$thisdo="�ק�";
	}
	$r=$empire->fetch1("select * from {$dbtbpre}enewszt where ztid='$ztid'");
	$addr=$empire->fetch1("select * from {$dbtbpre}enewsztadd where ztid='$ztid'");
	$usernames=substr($r['usernames'],1,-1);
	$url="<a href=ListZt.php".$ecms_hashur['whehref'].">�޲z�M�D</a>&nbsp;>&nbsp;".$thisdo."�M�D�G".$r[ztname];
	$postword=$thisdo.'�M�D';
	//�M�D�ؿ�
	$mycr=GetPathname($r[ztpath]);
	$pripath=$mycr[1];
	$ztpath=$mycr[0];
	//�ƻs�M�D
	if($copyclass)
	{
		$r[ztname].='(1)';
		$ztpath.='1';
	}
}
//�C��ҪO
$msql=$empire->query("select mid,mname from {$dbtbpre}enewsmod order by myorder,mid");
while($mr=$empire->fetch($msql))
{
	$listtemp_options.="<option value=0 style='background:#99C4E3'>".$mr[mname]."</option>";
	$l_sql=$empire->query("select tempid,tempname from ".GetTemptb("enewslisttemp")." where modid='$mr[mid]'");
	while($l_r=$empire->fetch($l_sql))
	{
		if($l_r[tempid]==$r[listtempid])
		{$l_d=" selected";}
		else
		{$l_d="";}
		$listtemp_options.="<option value=".$l_r[tempid].$l_d."> |-".$l_r[tempname]."</option>";
	}
}
//���
$options=ShowClass_AddClass("",$r[classid],0,"|-",0,0);
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
//���׼ҪO
$pltemp='';
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
//����
$zcstr="";
$zcsql=$empire->query("select classid,classname from {$dbtbpre}enewsztclass order by classid");
while($zcr=$empire->fetch($zcsql))
{
	$select="";
	if($zcr[classid]==$r[zcid])
	{
		$select=" selected";
	}
	$zcstr.="<option value='".$zcr[classid]."'".$select.">".$zcr[classname]."</option>";
}
//�u�Ƥ��
$yh_options='';
$yhsql=$empire->query("select id,yhname from {$dbtbpre}enewsyh order by id");
while($yhr=$empire->fetch($yhsql))
{
	$select='';
	if($r[yhid]==$yhr[id])
	{
		$select=' selected';
	}
	$yh_options.="<option value='".$yhr[id]."'".$select.">".$yhr[yhname]."</option>";
}
$from=(int)$_GET['from'];
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>�W�[�M�D</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
//�ˬd
function CheckForm(obj){
	if(obj.ztname.value=='')
	{
		alert("�п�J�M�D�W��");
		obj.ztname.focus();
		return false;
	}
	if(obj.ztpath.value=="")
	{
		alert("�п�J�M�D�ؿ�");
		obj.ztpath.focus();
		return false;
	}
	if(obj.listtempid.value==0)
	{
		alert("�п�ܦC��ҪO");
		obj.listtempid.focus();
		return false;
	}
}
  </script>
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G 
      <?=$url?>
    </td>
  </tr>
</table>
<br>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../ecmsclass.php" onsubmit="return CheckForm(document.form1);">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input type=hidden name=enews value=<?=$enews?>> <input name="from" type="hidden" id="from" value="<?=$from?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���ݩ�</td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">�M�D�W��(*)</td>
      <td width="76%" height="25" bgcolor="#FFFFFF"> <input name="ztname" type="text" id="ztname" value="<?=$r[ztname]?>" size="38"> 
        <?php
	  if($enews=="AddZt")
	  {
	  ?>
        <input type="button" name="Submit5" value="�ͦ������ؿ�" onclick="window.open('../GetPinyin.php?<?=$ecms_hashur['href']?>&hz='+document.form1.ztname.value+'&returnform=opener.document.form1.ztpath.value','','width=160,height=100');"> 
        <?php
	  }
	  ?>
        <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"> <input name="oldztid" type="hidden" id="oldztid" value="<?=$ztid?>">      <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
    </tr>
	<?php
	if($returnandlevel==2)
	{
	?>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�i��s�M�D���Τ�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="usernames" type="text" id="usernames" value="<?=$usernames?>" size="38">
        <font color="#666666">
        <input type="button" name="Submit32" value="���" onclick="window.open('../ChangeUser.php?field=usernames&form=form1<?=$ecms_hashur['ehref']?>','','width=300,height=520,scrollbars=yes');">
(�h�ӥΤ�Ρu,�v�r���j�})</font></td>
    </tr>
	<?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ݫH�����</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="classid" id="classid">
          <option value="0">���ݩ�Ҧ����</option>
          <?=$options?>
        </select> <input type="button" name="Submit622232" value="�޲z���" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');"> 
        <font color="#666666">(��ܤ���ءA�N���Ω�l���)</font></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">�s����(*) 
        <input name="oldztpath" type="hidden" id="oldztpath2" value="<?=$r[ztpath]?>"> 
        <input name="oldpripath" type="hidden" id="oldztpath3" value="<?=$pripath?>">      </td>
      <td bgcolor="#FFFFFF"> <table border="0" cellspacing="1" cellpadding="3">
          <tr bgcolor="DBEAF5"> 
            <td bgcolor="DBEAF5">&nbsp;</td>
            <td bgcolor="DBEAF5">�W�h�ؿ�</td>
            <td bgcolor="DBEAF5">���M�D�ؿ�</td>
            <td bgcolor="DBEAF5">&nbsp;</td>
          </tr>
          <tr> 
            <td><div align="right">�ڥؿ�/</div></td>
            <td><input name="pripath" type="text" id="pripath" value="<?=$pripath?>" size="30"></td>
            <td><input name="ztpath" type="text" id="ztpath2" value="<?=$ztpath?>" size="16"></td>
            <td><input type="button" name="Submit3" value="�˴��ؿ�" onclick="javascript:window.open('../ecmscom.php?<?=$ecms_hashur['href']?>&enews=CheckPath&pripath='+document.form1.pripath.value+'&classpath='+document.form1.ztpath.value,'','width=100,height=100,top=250,left=450');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ϥ��u�Ƥ��</td>
      <td bgcolor="#FFFFFF"><select name="yhid" id="yhid">
          <option name="0">���ϥ�</option>
          <?=$yh_options?>
        </select> <input type="button" name="Submit63" value="�޲z�u�Ƥ��" onclick="window.open('../db/ListYh.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����X�i�W</td>
      <td bgcolor="#FFFFFF"> <input name="zttype" type="text" id="zttype4" value="<?=$r[zttype]?>" size="38"> 
        <select name="select" onchange="document.form1.zttype.value=this.value">
          <option value=".html">�X�i�W</option>
          <option value=".html">.html</option>
          <option value=".htm">.htm</option>
          <option value=".php">.php</option>
          <option value=".shtml">.shtml</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�j�w��W</td>
      <td bgcolor="#FFFFFF"> <input name="zturl" type="text" id="zturl" value="<?=$r[zturl]?>" size="38"> 
        <font color="#666666"> (�p���j�w,�Яd��.�᭱�L�ݥ[&quot;/&quot;)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ݤ���</td>
      <td bgcolor="#FFFFFF"><select name="zcid" id="zcid">
          <option value="0">�����ݩ�������</option>
          <?=$zcstr?>
        </select> <input type="button" name="Submit6222322" value="�޲z����" onclick="window.open('ListZtClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�M�D�Y����</td>
      <td bgcolor="#FFFFFF"> <input name="ztimg" type="text" id="ztimg" value="<?=$r[ztimg]?>" size="38"> 
        <a onclick="window.open('../ecmseditor/FileMain.php?<?=$ecms_hashur['ehref']?>&modtype=2&type=1&classid=&doing=2&field=ztimg&filepass=<?=$filepass?>&sinfo=1','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" width="22" height="22" border="0" align="absbottom"></a></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��������r</td>
      <td bgcolor="#FFFFFF"> <input name="ztpagekey" type="text" id="ztpagekey" value="<?=$r[ztpagekey]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">�M�D²��</td>
      <td bgcolor="#FFFFFF"> <textarea name="intro" cols="70" rows="8" id="intro"><?=stripSlashes($r[intro])?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Ƨ�</td>
      <td bgcolor="#FFFFFF"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="38"> 
        <font color="#666666"> (�ȶV�p�V�e��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ܨ�ɯ�</td>
      <td bgcolor="#FFFFFF"> <input type="radio" name="showzt" value="0"<?=$r[showzt]==0?' checked':''?>>
        �O 
        <input type="radio" name="showzt" value="1"<?=$r[showzt]==1?' checked':''?>>
        �_<font color="#666666">�]�p�G�M�D�ɯ���ҡ^</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�H���i���</td>
      <td bgcolor="#FFFFFF"><input type="radio" name="usezt" value="0"<?=$r[usezt]==0?' checked':''?>>
        �O 
        <input type="radio" name="usezt" value="1"<?=$r[usezt]==1?' checked':''?>>
        �_<font color="#666666">�]�p�G��ܧ_����W�[�H���ɤ��|��ܳo�ӱM�D�^</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�L���ɶ�</td>
      <td bgcolor="#FFFFFF"><input name="endtime" type="text" id="endtime" value="<?=$r[endtime]?date('Y-m-d',$r[endtime]):''?>" size="12" onClick="setday(this)">
        <font color="#666666">(�W�L���������A��s�M����,�Ŭ�������)
        <input name="oldendtime" type="hidden" id="oldendtime" value="<?=$r[endtime]?>">
        </font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">����</td>
      <td bgcolor="#FFFFFF"><input type="radio" name="closepl" value="0"<?=$r['closepl']==0?' checked':''?>>
        �}��
          <input type="radio" name="closepl" value="1"<?=$r['closepl']==1?' checked':''?>>
        �����A���׬O�_�f�֡G
        <input name="checkpl" type="checkbox" id="checkpl" value="1"<?=$r['checkpl']==1?' checked':''?>>
        �O</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�����]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">������ܼҦ�</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="islist" value="0"<?=$r[islist]==0?' checked':''?>>
        �ʭ��� 
        <input type="radio" name="islist" value="1"<?=$r[islist]==1?' checked':''?>>
        �C�� 
        <input type="radio" name="islist" value="2"<?=$r[islist]==2?' checked':''?>>
        �������e�� 
        <input name="oldislist" type="hidden" id="oldislist" value="<?=$r[islist]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><font color="#666666">�����G�ʭ����n��ܫʭ��ҪO�B�C���n��ܦC��ҪO�B���e���n���J�������e</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ʭ��ҪO</td>
      <td height="25" bgcolor="#FFFFFF"><select name="classtempid">
          <?=$classtemp?>
        </select> <input type="button" name="Submit6223" value="�޲z�ʭ��ҪO" onclick="window.open('../template/ListClasstemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ҥΦC��ҪO</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="listtempid" id="listtempid">
          <?=$listtemp_options?>
        </select> <input type="button" name="Submit622" value="�޲z�C��ҪO" onclick="window.open('../template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">���׼ҪO</td>
      <td height="25" bgcolor="#FFFFFF"><select name="pltempid" id="pltempid">
        <option value="0">�ϥ��q�{�ҪO </option>
        <?=$pltemp?>
      </select>
        <input type="button" name="Submit62" value="�޲z���׼ҪO" onclick="window.open('../template/ListPltemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr> 
      <td rowspan="3" valign="top" bgcolor="#FFFFFF">�C���]�m</td>
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="90">�ƧǤ覡</td>
            <td><input name="reorder" type="text" id="reorder" value="<?=$r[reorder]?>"> 
              <select name="orderselect" onchange="document.form1.reorder.value=this.value">
                <option value="newstime DESC"></option>
                <option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
                <option value="id DESC">���H��ID���ǱƧ�</option>
                <option value="zid DESC">���[�JID���ǱƧ�</option>
				<option value="isgood DESC,newstime DESC">�����˸m���Ƨ�</option>
              </select> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="90">����`�O����</td>
            <td><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="6"> 
              <font color="#666666">(0����ܩҦ��O��)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="90">�C����ܰO����</td>
            <td><input name="ztnum" type="text" id="ztnum3" value="<?=$r[ztnum]?>" size="6"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�������e<font color="#666666">(������ҦP�ʭ��ҪO)</font></td>
      <td height="25" bgcolor="#FFFFFF">�бN���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.classtext.value);document.form1.classtext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('../template/editor.php?<?=$ecms_hashur['ehref']?>&getvar=opener.document.form1.classtext.value&returnvar=opener.document.form1.classtext.value&fun=ReturnHtml','editclasstext','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <textarea name="classtext" cols="80" rows="23" id="classtext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($addr[classtext]))?></textarea></td>
    </tr>
    <?php
  	$ztfnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsztf");
  	if($ztfnum)
  	{
  		$editorfnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsztf where fform='editor' limit 1");	
		if($editorfnum)
		{
			include('../ecmseditor/infoeditor/fckeditor.php');
		}
  	?>
    <tr> 
      <td height="25" colspan="2">�۩w�q�r�q�]�m</td>
    </tr>
    <?php
	@include('../../data/html/ztaddform.php');
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="2"><strong>�M�D�۩w�q�r�q�եλ���</strong><br>
        ���m�եαM�D�۩w�q�r�q��ơGReturnZtAddField(�M�DID,�r�q�W)�A�M�DID=0����e�M�DID�C���h�Ӧr�q���e�i�γr���j�}�A�Ҥl�G<br>
        ���o'classtext'�r�q���e�G$value=ReturnZtAddField(0,'classtext'); //$value�N�O�r�q���e�C<br>
        ���o�h�Ӧr�q���e�G$value=ReturnZtAddField(1,'ztid,classtext'); //$value['classtext']�~�O�r�q���e�C</td>
    </tr>
    <?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"></div></td>
      <td bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="����"> &nbsp;&nbsp; 
        <input type="reset" name="Submit2" value="���m"> </td>
    </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>