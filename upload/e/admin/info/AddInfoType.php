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
//�����v��
CheckLevel($logininid,$loginin,$classid,"infotype");
$enews=RepPostStr($_GET['enews'],1);
$url="<a href='InfoType.php".$ecms_hashur['whehref']."'>�޲z���D����</a>&nbsp;>&nbsp;�W�[���D����";
$postword='�W�[���D����';
//��ϤƼƾ�
$r[myorder]=0;
$r[reorder]="newstime DESC";
$r[maxnum]=0;
$r[tnum]=25;
$r[repagenum]=0;
$r[ttype]=".html";
$r[newline]=10;
$r[hotline]=10;
$r[goodline]=10;
$r[hotplline]=10;
$r[firstline]=10;
$pripath='t/';
//�ƻs
$docopy=RepPostStr($_GET['docopy'],1);
if($docopy&&$enews=="AddInfoType")
{
	$copyclass=1;
}
$ecmsfirstpost=1;
//�ק�
if($enews=="EditInfoType"||$copyclass)
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
	$typeid=(int)$_GET['typeid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsinfotype where typeid='$typeid'");
	$url="<a href='InfoType.php".$ecms_hashur['whehref']."'>�޲z���D����</a>&nbsp;>&nbsp;".$thisdo."���D�����G".$r[tname];
	$postword=$thisdo.'���D����';
	//�����ؿ�
	$mycr=GetPathname($r[tpath]);
	$pripath=$mycr[1];
	$tpath=$mycr[0];
	//�ƻs����
	if($copyclass)
	{
		$r[tname].='(1)';
		$tpath.='1';
	}
}
//�C��ҪO
$mod_options='';
$listtemp_options='';
$msql=$empire->query("select mid,mname,usemod from {$dbtbpre}enewsmod order by myorder,mid");
while($mr=$empire->fetch($msql))
{
	if(empty($mr[usemod]))
	{
		if($mr[mid]==$r[mid])
		{$m_d=" selected";}
		else
		{$m_d="";}
		$mod_options.="<option value=".$mr[mid].$m_d.">".$mr[mname]."</option>";
	}
	//�C��ҪO
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
//js�ҪO
$jstemp='';
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
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[���D����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
//�ˬd
function CheckForm(obj){
	if(obj.tname.value=='')
	{
		alert("�п�J�����W��");
		obj.tname.focus();
		return false;
	}
	if(obj.tpath.value=="")
	{
		alert("�п�J�����ؿ�");
		obj.tpath.focus();
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
  <form name="form1" method="post" action="InfoType.php" onsubmit="return CheckForm(document.form1);">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input type=hidden name=enews value=<?=$enews?>> </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���ݩ�</td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">�����W��(*)</td>
      <td width="76%" height="25" bgcolor="#FFFFFF"> <input name="tname" type="text" id="tname" value="<?=$r[tname]?>" size="38"> 
        <?php
	  if($enews=="AddInfoType"||$docopy)
	  {
	  ?>
        <input type="button" name="Submit5" value="�ͦ������ؿ�" onclick="window.open('../GetPinyin.php?<?=$ecms_hashur['href']?>&hz='+document.form1.tname.value+'&returnform=opener.document.form1.tpath.value','','width=160,height=100');"> 
        <?php
	  }
	  ?>
        <input name="typeid" type="hidden" id="typeid" value="<?=$typeid?>"> </td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">�s����(*) 
        <input name="oldtpath" type="hidden" id="oldtpath" value="<?=$r[tpath]?>"> 
        <input name="oldpripath" type="hidden" id="oldpripath" value="<?=$pripath?>"> 
      </td>
      <td bgcolor="#FFFFFF"> <table border="0" cellspacing="1" cellpadding="3">
          <tr bgcolor="DBEAF5"> 
            <td bgcolor="DBEAF5">&nbsp;</td>
            <td bgcolor="DBEAF5">�W�h�ؿ�</td>
            <td bgcolor="DBEAF5">�������ؿ�</td>
            <td bgcolor="DBEAF5">&nbsp;</td>
          </tr>
          <tr> 
            <td><div align="right">�ڥؿ�/</div></td>
            <td><input name="pripath" type="text" id="pripath" value="<?=$pripath?>" size="30"></td>
            <td><input name="tpath" type="text" id="tpath" value="<?=$tpath?>" size="16"></td>
            <td><input type="button" name="Submit3" value="�˴��ؿ�" onclick="javascript:window.open('../ecmscom.php?<?=$ecms_hashur['href']?>&enews=CheckPath&pripath='+document.form1.pripath.value+'&classpath='+document.form1.tpath.value,'','width=100,height=100,top=250,left=450');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�j�w���t�μҫ�</td>
      <td bgcolor="#FFFFFF"><select name="mid" id="mid">
          <?=$mod_options?>
        </select> <input type="button" name="Submit6" value="�޲z�t�μҫ�" onclick="window.open('../db/ListTable.php<?=$ecms_hashur['whehref']?>');">
        * 
        <input name="oldmodid" type="hidden" id="oldmodid" value="<?=$r[modid]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ϥ��u�Ƥ��</td>
      <td bgcolor="#FFFFFF"><select name="yhid" id="yhid">
          <option name="0">���ϥ�</option>
          <?=$yh_options?>
        </select> <input type="button" name="Submit63" value="�޲z�u�Ƥ��" onclick="window.open('../db/ListYh.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����Y����</td>
      <td bgcolor="#FFFFFF"> <input name="timg" type="text" id="timg" value="<?=$r[timg]?>" size="38"> 
        <a onclick="window.open('../ecmseditor/FileMain.php?modtype=5&type=1&classid=&doing=2&field=timg<?=$ecms_hashur['ehref']?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" width="22" height="22" border="0" align="absbottom"></a></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��������r</td>
      <td bgcolor="#FFFFFF"> <input name="pagekey" type="text" id="pagekey" value="<?=$r[pagekey]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">����²��</td>
      <td bgcolor="#FFFFFF"> <textarea name="intro" cols="70" rows="8" id="intro"><?=ehtmlspecialchars(stripSlashes($r[intro]))?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Ƨ�</td>
      <td bgcolor="#FFFFFF"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="38"> 
        <font color="#666666"> (�ȶV�p�V�e��)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�����]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����Ҧ�</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="listdt" value="0"<?=$r[listdt]==0?' checked':''?>>
        �R�A���� 
        <input type="radio" name="listdt" value="1"<?=$r[listdt]==1?' checked':''?>>
        �ʺA����</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ҥΦC��ҪO(*)</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="listtempid" id="listtempid">
          <?=$listtemp_options?>
        </select> <input type="button" name="Submit622" value="�޲z�C��ҪO" onclick="window.open('../template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');">
        *</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�C�������ƧǤ覡</td>
      <td height="25" bgcolor="#FFFFFF"><input name="reorder" type="text" id="reorder" value="<?=$r[reorder]?>" size="38"> 
        <select name="orderselect" onchange="document.form1.reorder.value=this.value">
          <option value="newstime DESC"></option>
          <option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
          <option value="id DESC">��ID���ǱƧ�</option>
          <option value="onclick DESC">���I���v���ǱƧ�</option>
          <option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
          <option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����X�i�W</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ttype" type="text" id="ttype" value="<?=$r[ttype]?>" size="38"> 
        <select name="select" onchange="document.form1.ttype.value=this.value">
          <option value=".html">�X�i�W</option>
          <option value=".html">.html</option>
          <option value=".htm">.htm</option>
          <option value=".php">.php</option>
          <option value=".shtml">.shtml</option>
        </select> <font color="#666666">(�p.html,.xml,.htm��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����`�O����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="38">
        �� <font color="#666666">(0����ܩҦ��O��)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�ͦ��R�A����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="repagenum" type="text" id="repagenum" value="<?=$r[repagenum]?>" size="38">
        ��<font color="#666666">(�W�L�����ĥΰʺA�챵�A0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�C����ܰO����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="tnum" type="text" id="tnum" value="<?=$r[tnum]?>" size="38">
        ���O��</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">JS�����]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O�_�ͦ�JS�ե�</td>
      <td bgcolor="#FFFFFF"> <input type="radio" name="nrejs" value="0"<?=$r[nrejs]==0?' checked':''?>>
        �ͦ� 
        <input type="radio" name="nrejs" value="1"<?=$r[nrejs]==1?' checked':''?>>
        ���ͦ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ҥ�JS�ҪO</td>
      <td bgcolor="#FFFFFF"> <select name="jstempid" id="jstempid">
          <?=$jstemp?>
        </select> <input type="button" name="Submit62223" value="�޲zJS�ҪO" onclick="window.open('../template/ListJstemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�̷s�H��JS���</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="newline" type="text" id="newline" value="<?=$r[newline]?>" size="38">
        ���O��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����H��JS���</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="hotline" type="text" id="hotline" value="<?=$r[hotline]?>" size="38">
        ���O��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���˫H��JS���</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="goodline" type="text" id="goodline" value="<?=$r[goodline]?>" size="38">
        ���O��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�������׫H��js���</td>
      <td bgcolor="#FFFFFF"> <input name="hotplline" type="text" id="hotplline" value="<?=$r[hotplline]?>" size="38">
        ���O��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Y���H��js���</td>
      <td bgcolor="#FFFFFF"> <input name="firstline" type="text" id="firstline" value="<?=$r[firstline]?>" size="38">
        ���O��</td>
    </tr>
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