<?php
define('EmpireCMSAdmin','1');
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/functions.php');
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

$enews=ehtmlspecialchars($_GET['enews']);
$ztid=(int)$_GET['ztid'];
$ztr=$empire->fetch1("select ztid,ztname from {$dbtbpre}enewszt where ztid='$ztid'");
if(!$ztr['ztid'])
{
	printerror('ErrorUrl','');
}
//�����v��
//CheckLevel($logininid,$loginin,$classid,"zt");
$returnandlevel=CheckAndUsernamesLevel('dozt',$ztid,$logininid,$loginin,$loginlevel);

$url="<a href='ListZt.php".$ecms_hashur['whehref']."'>�޲z�M�D</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>".$ztr['ztname']."</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>�޲z�M�D�l��</a>&nbsp;>&nbsp;�W�[�M�D�l��";
$postword='�W�[�M�D�l��';
//��ϤƼƾ�
$r[myorder]=0;
$r[reorder]="newstime DESC";
$r[maxnum]=0;
$r[tnum]=25;
$r[ttype]=".html";
$r[islist]=1;
//�ƻs
$docopy=RepPostStr($_GET['docopy'],1);
if($docopy&&$enews=="AddZtType")
{
	$copyclass=1;
}
$ecmsfirstpost=1;
//�ק�
if($enews=="EditZtType"||$copyclass)
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
	$cid=(int)$_GET['cid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewszttype where cid='$cid'");
	$addr=$empire->fetch1("select * from {$dbtbpre}enewszttypeadd where cid='$cid'");
	$url="<a href='ListZt.php".$ecms_hashur['whehref']."'>�޲z�M�D</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>".$ztr['ztname']."</a>&nbsp;>&nbsp;<a href='ZtType.php?ztid=$ztid".$ecms_hashur['ehref']."'>�޲z�M�D�l��</a>&nbsp;>&nbsp;".$thisdo."�M�D�l���G".$r[cname];
	$postword=$thisdo.'�M�D�l��';
	//�ƻs����
	if($copyclass)
	{
		$r[cname].='(1)';
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
//�ʭ��ҪO
$classtemp='';
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
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�M�D�l��</title>
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
  <form name="form1" method="post" action="ZtType.php" onsubmit="return CheckForm(document.form1);">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input type=hidden name=enews value=<?=$enews?>> <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���ݩ�</td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">�����W��(*)</td>
      <td width="76%" height="25" bgcolor="#FFFFFF"> <input name="cname" type="text" id="cname" value="<?=$r[cname]?>" size="38"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> </td>
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
      <td height="25" bgcolor="#FFFFFF">������ܼҦ�</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="islist" value="1"<?=$r[islist]==1?' checked':''?>>
        �C�� 
        <input type="radio" name="islist" value="2"<?=$r[islist]==2?' checked':''?>>
        �歶�� 
        <input name="oldislist" type="hidden" id="oldislist" value="<?=$r[islist]?>"> 
        <font color="#666666">(�C���n��ܦC��ҪO�B�歶���n���J�������e)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ҥΦC��ҪO</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="listtempid" id="listtempid">
          <?=$listtemp_options?>
        </select> <input type="button" name="Submit622" value="�޲z�C��ҪO" onclick="window.open('../template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�C�������ƧǤ覡</td>
      <td height="25" bgcolor="#FFFFFF"><input name="reorder" type="text" id="reorder" value="<?=$r[reorder]?>" size="38"> 
        <select name="orderselect" onchange="document.form1.reorder.value=this.value">
          <option value="newstime DESC"></option>
          <option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
          <option value="id DESC">���H��ID���ǱƧ�</option>
          <option value="zid DESC">���[�JID���ǱƧ�</option>
		  <option value="isgood DESC,newstime DESC">�����˸m���Ƨ�</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">����`�O����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="38">
        �� <font color="#666666">(0����ܩҦ��O��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�C����ܰO����</td>
      <td height="25" bgcolor="#FFFFFF"><input name="tnum" type="text" id="tnum" value="<?=$r[tnum]?>" size="38">
        ���O��</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�������e<font color="#666666">(������ҦP�ʭ��ҪO)</font></td>
      <td height="25" bgcolor="#FFFFFF">�бN���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.classtext.value);document.form1.classtext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('../template/editor.php?<?=$ecms_hashur['ehref']?>&getvar=opener.document.form1.classtext.value&returnvar=opener.document.form1.classtext.value&fun=ReturnHtml','editclasstext','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <textarea name="classtext" cols="80" rows="23" id="classtext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($addr[classtext]))?></textarea></td>
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