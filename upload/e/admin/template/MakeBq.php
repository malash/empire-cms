<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
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

$doobject=(int)$_GET['doobject'];
$selfdoobject=(int)$_GET['selfdoobject'];
$addselfinfo=(int)$_GET['addselfinfo'];
$selfinfooption='';
$parentclass=(int)$_GET['parentclass'];
$addparentclass='';
if($parentclass)
{
	$addparentclass='��';
}
//�ާ@�ﹳ
if($doobject==2)//�����
{
	//�ާ@����
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="0">��س̷s�H��</option>
			  <option value="1">����I���Ʀ�</option>
			  <option value="2">��ر��˫H��</option>
			  <option value="9">��ص��ױƦ�</option>
			  <option value="12">����Y���H��</option>
			  <option value="15">��ؤU���Ʀ�</option>
              </select></td>
          </tr>
        </table>';
	//������
	$fcfile='../../data/fc/ListEnews.php';
	$class="<script src=../../data/fc/cmsclass.js></script>";
	if(!file_exists($fcfile))
	{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
	if($addselfinfo==1)
	{
	}
	elseif($addselfinfo==2)//�@�����+��e���
	{
		$selfinfooption='<option value="\'selfinfo\'">��e���</option><option value="\'0\'">�@�����</option>';
	}
	elseif($addselfinfo==3)//�@�����
	{
		$selfinfooption='<option value="\'0\'">�@�����</option>';
	}
	elseif($addselfinfo==4)//�������
	{
		$selfinfooption='<option value="0">�������</option>';
	}
	else
	{
		$selfinfooption='<option value="\'selfinfo\'">��e���</option>';
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">���'.$addparentclass.'��ءG</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$selfinfooption.'
			  '.$class.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==3)//���M�D
{
	//�ާ@����
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="6">�M�D�̷s�H��</option>
			  <option value="7">�M�D�I���Ʀ�</option>
			  <option value="8">�M�D���˫H��</option>
			  <option value="11">�M�D���ױƦ�</option>
			  <option value="14">�M�D�Y���H��</option>
			  <option value="17">�M�D�U���Ʀ�</option>
              </select></td>
          </tr>
        </table>';
	//��ܱM�D
	$ztclass='';
	$ztsql=$empire->query("select ztid,ztname from {$dbtbpre}enewszt order by ztid desc");
	while($ztr=$empire->fetch($ztsql))
	{
		$ztclass.="<option value='".$ztr['ztid']."'>".$ztr['ztname']."</option>";
	}
	if($addselfinfo==1)
	{
	}
	else
	{
		$selfinfooption='<option value="\'selfinfo\'">��e�M�D</option>';
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">��ܱM�D�G</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$selfinfooption.'
			  '.$ztclass.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==4)//���ƾڪ�
{
	//�ާ@����
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="18">��̷s�H��</option>
			  <option value="19">���I���Ʀ�</option>
			  <option value="20">����˫H��</option>
			  <option value="21">����ױƦ�</option>
			  <option value="22">���Y���H��</option>
			  <option value="23">��U���Ʀ�</option>
              </select></td>
          </tr>
        </table>';
	//��ܼƾڪ�
	$tb='';
	$tbsql=$empire->query("select tbname,tname from {$dbtbpre}enewstable order by tid");
	while($tbr=$empire->fetch($tbsql))
	{
		$tb.="<option value=\"'".$tbr[tbname]."'\">".$tbr[tname]."</option>";
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">��ܼƾڪ�G</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$tb.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==5)//�����D����
{
	//�ާ@����
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="25">���D�����̷s�H��</option>
			  <option value="26">���D�����I���Ʀ�</option>
			  <option value="27">���D�������˫H��</option>
			  <option value="28">���D�������ױƦ�</option>
			  <option value="29">���D�����Y���H��</option>
			  <option value="30">���D�����U���Ʀ�</option>
              </select></td>
          </tr>
        </table>';
	//��ܼ��D����
	$tts='';
	$ttsql=$empire->query("select typeid,tname from {$dbtbpre}enewsinfotype order by typeid");
	while($ttr=$empire->fetch($ttsql))
	{
		$tts.="<option value='$ttr[typeid]'>$ttr[tname]</option>";
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">��ܼ��D�����G</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$tts.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==6)//��SQL
{
	//�ާ@����
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="24">SQL�d��</option>
              </select></td>
          </tr>
        </table>';
	//���SQL
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">��ܡG</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="\'sql�y�y\'">SQL�d��</option>
              </select></td>
          </tr>
        </table>';
}
else//���q�{��
{
	//�ާ@����
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="3">�q�{��̷s�H��</option>
			  <option value="4">�q�{���I���Ʀ�</option>
			  <option value="5">�q�{����˫H��</option>
			  <option value="10">�q�{����ױƦ�</option>
			  <option value="13">�q�{���Y���H��</option>
			  <option value="16">�q�{��U���Ʀ�</option>
              </select></td>
          </tr>
        </table>';
	//���SQL
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">��ܡG</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="0">�q�{��('.$public_r[tbname].')</option>
              </select></td>
          </tr>
        </table>';
}

//���ҼҪO
$bqname=RepPostStr($_GET['bqname'],1);
if(empty($bqname))
{
	$bqname='ecmsinfo';
}
$mydotype=RepPostStr($_GET['mydotype'],1);
$defchangeobject=RepPostStr($_GET['defchangeobject'],1);
if($defchangeobject==1)
{
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">��ܡG</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="\'\'">�q�{</option>
              </select></td>
          </tr>
        </table>';
}
if($bqname=='ecmsinfo'||$bqname=='listsonclass'||$bqname=='otherlink'||$bqname=='eshowphoto'||$bqname=='tagsinfo'||$bqname=='showclasstemp'||$bqname=='eshowzt'||$bqname=='listshowclass'||$bqname=='gbookinfo'||$bqname=='showplinfo')
{
	$bqtemp='';
	$bqtempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsbqtemp")." order by tempid");
	while($bqtempr=$empire->fetch($bqtempsql))
	{
		$bqtemp.="<option value='".$bqtempr[tempid]."'>".$bqtempr[tempname]."</option>";
	}
}
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�Ұ�����޲z�t��--���ҥͦ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript">
window.resizeTo(800,600);
window.focus();
</script>
<script>
//��^���[SQL
function ReturnAddSql(addsql,orderby){
	var addstr='';
	var r;
	var yh="'";
	if(addsql!=''||orderby!='')
	{
		r=addsql.split("'");
		if(r.length!=1)
		{
			yh='"';
		}
		if(addsql!='')
		{
			addstr+=','+yh+addsql+yh;
		}
		else
		{
			addstr+=",''";
		}
		if(orderby!='')
		{
			addstr+=",'"+orderby+"'";
		}
	}
	return addstr;
}

//��^�O�_�[��޸�
function ReturnAddYh(tids){
	var r;
	if(tids=='')
	{
		return "''";
	}
	r=tids.split(",");
	if(r.length!=1)
	{
		tids="'"+tids+"'";
	}
	return tids;
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td height="25">��ܼ��ҡG 
      <select name="bq" id="bq" style= "font-size:16px;" onchange="if(this.options[this.selectedIndex].value!=''){self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname='+this.options[this.selectedIndex].value}">
        <option value="" style="background-color:#AFCFF3">�H���եμ���</option>
        <option value="ecmsinfo"<?=$bqname=='ecmsinfo'?' selected':''?>>&nbsp; &gt; �U����ҽե� (ecmsinfo)</option>
		<option value="eloop"<?=$bqname=='eloop'?' selected':''?>>&nbsp; &gt; �F�ʼ��� (e:loop)</option>
		<option value="eindexloop"<?=$bqname=='eindexloop'?' selected':''?>>&nbsp; &gt; �����F�ʼ��� (e:indexloop)</option>
        <option value="phomenews"<?=$bqname=='phomenews'?' selected':''?>>&nbsp; &gt; ��r�եμ��� (phomenews)</option>
        <option value="phomenewspic"<?=$bqname=='phomenewspic'?' selected':''?>>&nbsp; &gt; �Ϥ�H���ե�[���D�Ϥ����H��] (phomenewspic)</option>
        <option value="phomeflashpic"<?=$bqname=='phomeflashpic'?' selected':''?>>&nbsp; &gt; FLASH�ۿO�H���ե� (phomeflashpic)</option>
		<option value="listsonclass&doobject=2&addselfinfo=2"<?=$bqname=='listsonclass'?' selected':''?>>&nbsp; &gt; �`���l��ؼƾڼ��� (listsonclass)</option>
		<option value="otherlink&defchangeobject=1"<?=$bqname=='otherlink'?' selected':''?>>&nbsp; &gt; �����챵���� (otherlink)</option>
		<option value="tagsinfo"<?=$bqname=='tagsinfo'?' selected':''?>>&nbsp; &gt; �ե�TAGS���H������ (tagsinfo)</option>
		<option value="spinfo"<?=$bqname=='spinfo'?' selected':''?>>&nbsp; &gt; �եθH�����H������ (spinfo)</option>
		<option value="showtags"<?=$bqname=='showtags'?' selected':''?>>&nbsp; &gt; �ե�TAGS���� (showtags)</option>
        <option value="totaldata&doobject=2&addselfinfo=1"<?=$bqname=='totaldata'?' selected':''?>>&nbsp; &gt; �����H���έp (totaldata)</option>
        <option value="eshowphoto"<?=$bqname=='eshowphoto'?' selected':''?>>&nbsp; &gt; �Ϯw�ҫ��������� (eshowphoto)</option>
        <option value="showsearch&doobject=2&addselfinfo=4"<?=$bqname=='showsearch'?' selected':''?>>&nbsp; &gt; �j������r�եμ��� (showsearch)</option>
        <option value="" style="background-color:#AFCFF3">��ؽեμ���</option>
        <option value="showclasstemp&doobject=2&addselfinfo=2&parentclass=1"<?=$bqname=='showclasstemp'?' selected':''?>>&nbsp; &gt; �a�ҪO����ؾɯ���� (showclasstemp)</option>
        <option value="eshowzt"<?=$bqname=='eshowzt'?' selected':''?>>&nbsp; &gt; �M�D�եμ��� (eshowzt)</option>
        <option value='listshowclass&doobject=2&addselfinfo=2&parentclass=1'<?=$bqname=='listshowclass'?' selected':''?>>&nbsp; &gt; �`����ؾɯ���� (listshowclass)</option>
        <option value="" style="background-color:#AFCFF3">�D�H���եμ���</option>
        <option value="phomead"<?=$bqname=='phomead'?' selected':''?>>&nbsp; &gt; �s�i�եμ��� (phomead)</option>
        <option value="phomevote"<?=$bqname=='phomevote'?' selected':''?>>&nbsp; &gt; �벼�եμ��� (phomevote)</option>
        <option value="phomelink"<?=$bqname=='phomelink'?' selected':''?>>&nbsp; &gt; �ͱ��챵�եμ��� (phomelink)</option>
        <option value="gbookinfo"<?=$bqname=='gbookinfo'?' selected':''?>>&nbsp; &gt; �d���O�եμ��� (gbookinfo)</option>
        <option value="showplinfo"<?=$bqname=='showplinfo'?' selected':''?>>&nbsp; &gt; ���׽եμ��� (showplinfo)</option>
        <option value="echocheckbox"<?=$bqname=='echocheckbox'?' selected':''?>>&nbsp; &gt; �_��r�q��X���e���� (echocheckbox)</option>
		<option value="" style="background-color:#AFCFF3">�|�������ե�</option>
		<option value="ShowMemberInfo"<?=$bqname=='ShowMemberInfo'?' selected':''?>>�|���H���եΨ�� (ShowMemberInfo)</option>
		<option value="ListMemberInfo"<?=$bqname=='ListMemberInfo'?' selected':''?>>�|���C��եΨ�� (ListMemberInfo)</option>
		<option value="spaceeloop"<?=$bqname=='spaceeloop'?' selected':''?>>�|���Ŷ��H�����ҽե� (spaceeloop)</option>
        <option value="" style="background-color:#AFCFF3">�䥦����</option>
        <option value="includefile"<?=$bqname=='includefile'?' selected':''?>>&nbsp; &gt; �ޥΤ����� (includefile)</option>
        <option value="readhttp"<?=$bqname=='readhttp'?' selected':''?>>&nbsp; &gt; Ū�����{���� (readhttp)</option>
      </select></td>
  </tr>
</table>
<br>
<?php
if($bqname=='ecmsinfo')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var ftempid=obj.tempid.value;
	var fispic=obj.ispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[ecmsinfo]"+fclassid+","+fline+","+ftitlelen+","+fshowclass+","+fdotype+","+ftempid+","+fispic+addstr+"[/ecmsinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">ecmsinfo���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��ܽեιﹳ�G 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>���q�{��(
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>���</option>
          <option value="4"<?=$doobject==4?' selected':''?>>�ƾڪ�</option>
          <option value="5"<?=$doobject==5?' selected':''?>>���D����</option>
          <option value="6"<?=$doobject==6?' selected':''?>>��SQL�ե�</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select3">
                <?=$bqtemp?>
              </select>
              <input type="button" name="Submit6222323" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�����ئW�G</td>
            <td width="76%"><select name="showclass" id="showclass">
                <option value="0">�_</option>
                <option value="1">�O</option>
              </select> <font color="#666666">(���ҼҪO�n�[[!--class.name--])</font> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�u�եΦ����D�Ϥ����H���G 
        <select name="ispic" id="ispic">
          <option value="0">����</option>
          <option value="1">�O</option>
        </select></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="isgood=1">1�ű���</option>
<option value="firsttitle=1">1���Y��</option>
<option value="field='��'">�r�q����Y��</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
<option value="newstime ASC">���o�G�ɶ��ɧǱƧ�</option>
<option value="id DESC">��ID���ǱƧ�</option>
<option value="onclick DESC">���I���v���ǱƧ�</option>
<option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
<option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
<option value="diggtop DESC">������(digg)���ǱƧ�</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();">
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#ecmsinfo" target="_blank" title="�d�ݸԲӼ��һy�k">[ecmsinfo]���ID/���D����ID,��ܱ���,���D�I����,�O�_�����ئW,�ާ@����,�ҪOID,�u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�[/ecmsinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eloop')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fdotype=obj.dotype.value;
	var fispic=obj.ispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[e:loop={"+fclassid+","+fline+","+fdotype+","+fispic+addstr+"}]\r\n<a href=\"<?="<?=\$bqsr['titleurl']?>"?>\" target=\"_blank\"><?="<?=\$bqr['title']?>"?></a> <br>\r\n[/e:loop]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">�F�ʼ���(e:loop)�ͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��ܽեιﹳ�G 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>���q�{��( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>���</option>
          <option value="4"<?=$doobject==4?' selected':''?>>�ƾڪ�</option>
          <option value="5"<?=$doobject==5?' selected':''?>>���D����</option>
          <option value="6"<?=$doobject==6?' selected':''?>>��SQL�ե�</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">�u�եΦ����D�Ϥ����H���G 
        <select name="ispic" id="select6">
          <option value="0">����</option>
          <option value="1">�O</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="isgood=1">1�ű���</option>
<option value="firsttitle=1">1���Y��</option>
<option value="field='��'">�r�q����Y��</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
<option value="newstime ASC">���o�G�ɶ��ɧǱƧ�</option>
<option value="id DESC">��ID���ǱƧ�</option>
<option value="onclick DESC">���I���v���ǱƧ�</option>
<option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
<option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
<option value="diggtop DESC">������(digg)���ǱƧ�</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eloop" target="_blank" title="�d�ݸԲӼ��һy�k">[e:loop={���ID/���D����ID,��ܱ���,�ާ@����,�u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�}]<br>
        �ҪO�N�X���e<br>
      [/e:loop]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eindexloop')
{
	if($selfdoobject==9)//�M�D�l��
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="4">�M�D�l���̷s�H��</option>
			  <option value="5">�M�D�l���̦��H��</option>
			  <option value="6">�M�D�l�����˫H��</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="�d�ݱM�DID" onclick="window.open(\'../special/ListZt.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(��e�M�DID�ΡG\'selfinfo\'�A�h��ID�Ρu,�v���j�})</font>';
	}
	elseif($selfdoobject==7)//TAGS
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="9">TAGS�̷s�H��</option>
			  <option value="10">TAGS�̦��H��</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="�d��TAGS��ID" onclick="window.open(\'../tags/ListTags.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(�h��ID�Ρu,�v���j�})</font>';
	}
	elseif($selfdoobject==8)//�H��
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="7">�H���̷s�H��</option>
			  <option value="8">�H���̦��H��</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="�d�ݸH��ID" onclick="window.open(\'../sp/ListSp.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(�h��ID�Ρu,�v���j�})</font>';
	}
	elseif($selfdoobject==6)//��SQL
	{
		//�ާ@����
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="11">SQL�d��</option>
              </select></td>
          </tr>
        </table>';
		//���SQL
		$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">��ܡG</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="\'sql�y�y\'">SQL�d��</option>
              </select></td>
          </tr>
        </table>';
	}
	else//�M�D
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="1">�M�D�̷s�H��</option>
			  <option value="2">�M�D�̦��H��</option>
			  <option value="3">�M�D���˫H��</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="�d�ݱM�DID" onclick="window.open(\'../special/ListZt.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(��e�M�DID�ΡG\'selfinfo\'�A�h��ID�Ρu,�v���j�})</font>';
	}
	
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fdotype=obj.dotype.value;
	var fuseclassid=obj.useclassid.value;
	var fmodid=obj.modid.value;
	var faddsql=obj.addsql.value;
	var forderby='';
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[e:indexloop={"+fclassid+","+fline+","+fdotype+",'"+fuseclassid+"','"+fmodid+"'"+addstr+"}]\r\n<a href=\"<?="<?=\$bqsr['titleurl']?>"?>\" target=\"_blank\"><?="<?=\$bqr['title']?>"?></a> <br>\r\n[/e:indexloop]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eindexloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">�����F�ʼ���(e:indexloop)�ͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��ܽեιﹳ�G 
        <select name="selfdoobject" id="selfdoobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&selfdoobject='+this.options[this.selectedIndex].value">
          <option value="3"<?=$selfdoobject==3?' selected':''?>>�M�D</option>
		  <option value="9"<?=$selfdoobject==9?' selected':''?>>�M�D�l��</option>
          <option value="7"<?=$selfdoobject==7?' selected':''?>>TAGS</option>
          <option value="8"<?=$selfdoobject==8?' selected':''?>>�H��</option>
		  <option value="6"<?=$selfdoobject==6?' selected':''?>>��SQL�ե�</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF">
	<?=$dotype?>
              </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%">�������ID�G</td>
          <td width="76%"><input name="useclassid" type="text" id="useclassid"> <font color="#666666">(�h��ID��,���j�})</font></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%">���ݨt�μҫ�ID�G</td>
          <td width="76%"><input name="modid" type="text" id="line6"> <font color="#666666">(�h��ID��,���j�})</font></td>
        </tr>
      </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="��X����" onclick="ShowBqFun();">      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eindexloop" target="_blank" title="�d�ݸԲӼ��һy�k">[e:indexloop={���ޤ���ID,��ܱ���,�ާ@����,���ID,�t�μҫ�ID,���[SQL����}]<br>
        �ҪO�N�X���e<br>
      [/e:indexloop]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomenews')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var fshowtime=obj.showtime.value;
	var fformattime=obj.formattime.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[phomenews]"+fclassid+","+fline+","+ftitlelen+","+fshowtime+","+fdotype+","+fshowclass+",'"+fformattime+"'"+addstr+"[/phomenews]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomenews���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��ܽեιﹳ�G 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>���q�{��( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>���</option>
          <option value="4"<?=$doobject==4?' selected':''?>>�ƾڪ�</option>
          <option value="5"<?=$doobject==5?' selected':''?>>���D����</option>
          <option value="6"<?=$doobject==6?' selected':''?>>��SQL�ե�</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�����ئW�G</td>
            <td width="76%"><select name="showclass" id="select2">
                <option value="0">�_</option>
                <option value="1">�O</option>
              </select> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�O�_��ܮɶ��G</td>
            <td width="76%"><select name="showtime" id="select4">
                <option value="0">�_</option>
                <option value="1">�O</option>
              </select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ɶ��榡�G</td>
            <td width="76%"><input name="formattime" type="text" id="formattime" value="(m-d)"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="isgood=1">1�ű���</option>
<option value="firsttitle=1">1���Y��</option>
<option value="field='��'">�r�q����Y��</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
<option value="newstime ASC">���o�G�ɶ��ɧǱƧ�</option>
<option value="id DESC">��ID���ǱƧ�</option>
<option value="onclick DESC">���I���v���ǱƧ�</option>
<option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
<option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
<option value="diggtop DESC">������(digg)���ǱƧ�</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomenews" target="_blank" title="�d�ݸԲӼ��һy�k">[phomenews]���ID/���D����ID,��ܱ���,���D�I����,�O�_��ܮɶ�,�ާ@����,�O�_�����ئW,'�ɶ��榡��',���[SQL����,��ܱƧ�[/phomenews]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomenewspic')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var flnum=obj.lnum.value;
	var ftitlelen=obj.titlelen.value;
	var fshowtitle=obj.showtitle.value;
	var fdotype=obj.dotype.value;
	var fpicwidth=obj.picwidth.value;
	var fpicheight=obj.picheight.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[phomenewspic]"+fclassid+","+fline+","+flnum+","+fpicwidth+","+fpicheight+","+fshowtitle+","+ftitlelen+","+fdotype+addstr+"[/phomenewspic]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomenewspic���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��ܽեιﹳ�G 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>���q�{��( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>���</option>
          <option value="4"<?=$doobject==4?' selected':''?>>�ƾڪ�</option>
          <option value="5"<?=$doobject==5?' selected':''?>>���D����</option>
          <option value="6"<?=$doobject==6?' selected':''?>>��SQL�ե�</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ե��`�ƶq�G</td>
            <td width="76%"><input name="lnum" type="text" id="line3" value="8"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�C����ܼƶq�G</td>
            <td width="76%"><input name="line" type="text" id="num" value="4"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�Ϥ��j�p�G</td>
            <td width="76%">�e
<input name="picwidth" type="text" id="picwidth" value="170" size="6">
              �Ѱ� 
              <input name="picheight" type="text" id="picheight" value="120" size="6"> </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�O�_��ܼ��D�G</td>
            <td width="76%"><select name="showtitle" id="select5">
                <option value="0">�_</option>
                <option value="1">�O</option>
              </select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen" value="26"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="isgood=1">1�ű���</option>
<option value="firsttitle=1">1���Y��</option>
<option value="field='��'">�r�q����Y��</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
<option value="newstime ASC">���o�G�ɶ��ɧǱƧ�</option>
<option value="id DESC">��ID���ǱƧ�</option>
<option value="onclick DESC">���I���v���ǱƧ�</option>
<option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
<option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
<option value="diggtop DESC">������(digg)���ǱƧ�</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomenewspic" target="_blank" title="�d�ݸԲӼ��һy�k">[phomenewspic]���ID/���D����ID,�C����ܱ���,����`�H����,�Ϥ��e��,�Ϥ�����,�O�_��ܼ��D,���D�I����,�ާ@����,���[SQL����,��ܱƧ�[/phomenewspic]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomeflashpic')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fkeeptime=obj.keeptime.value;
	var ftitlelen=obj.titlelen.value;
	var fshowtitle=obj.showtitle.value;
	var fdotype=obj.dotype.value;
	var fpicwidth=obj.picwidth.value;
	var fpicheight=obj.picheight.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[phomeflashpic]"+fclassid+","+fline+","+fpicwidth+","+fpicheight+","+fshowtitle+","+ftitlelen+","+fdotype+","+fkeeptime+addstr+"[/phomeflashpic]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomeflashpic���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��ܽեιﹳ�G 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>���q�{��( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>���</option>
          <option value="4"<?=$doobject==4?' selected':''?>>�ƾڪ�</option>
          <option value="5"<?=$doobject==5?' selected':''?>>���D����</option>
          <option value="6"<?=$doobject==6?' selected':''?>>��SQL�ե�</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line3" value="5"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���y��ơG</td>
            <td width="76%"><input name="keeptime" type="text" id="num" value="0">
              <font color="#666666">(0���q�{)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�Ϥ��j�p�G</td>
            <td width="76%">�e
<input name="picwidth" type="text" id="picwidth" value="170" size="6">
              �Ѱ� 
              <input name="picheight" type="text" id="picheight" value="120" size="6"> </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�O�_��ܼ��D�G</td>
            <td width="76%"><select name="showtitle" id="select5">
                <option value="0">�_</option>
                <option value="1">�O</option>
              </select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen" value="26"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="isgood=1">1�ű���</option>
<option value="firsttitle=1">1���Y��</option>
<option value="field='��'">�r�q����Y��</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
<option value="newstime ASC">���o�G�ɶ��ɧǱƧ�</option>
<option value="id DESC">��ID���ǱƧ�</option>
<option value="onclick DESC">���I���v���ǱƧ�</option>
<option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
<option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
<option value="diggtop DESC">������(digg)���ǱƧ�</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomeflashpic" target="_blank" title="�d�ݸԲӼ��һy�k">[phomeflashpic]���ID/���D����ID,����`��,�Ϥ��e��,�Ϥ�����,�O�_��ܼ��D,���D�I����,�ާ@����,���y���,���[SQL����,��ܱƧ�[/phomeflashpic]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='listsonclass')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var ftempid=obj.tempid.value;
	var fispic=obj.ispic.value;
	var fclassnum=obj.classnum.value;
	var ffirstdotype=obj.firstdotype.value;
	var ffirsttitlelen=obj.firsttitlelen.value;
	var ffirstsmalltextlen=obj.firstsmalltextlen.value;
	var ffirstispic=obj.firstispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[listsonclass]"+fclassid+","+fline+","+ftitlelen+","+fshowclass+","+fdotype+","+ftempid+","+fispic+","+fclassnum+","+ffirstdotype+","+ffirsttitlelen+","+ffirstsmalltextlen+","+ffirstispic+addstr+"[/listsonclass]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">listsonclass���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="dotype">
                <option value="0">��س̷s</option>
                <option value="1">��ؼ���</option>
                <option value="2">��ر���</option>
                <option value="3">��ص��ױƦ�</option>
                <option value="4">����Y��</option>
                <option value="5">��ؤU���Ʀ�</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եΫH���ơG</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select7">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223232" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen3" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�����ئW�G</td>
            <td width="76%"><select name="showclass" id="select8">
                <option value="0">�_</option>
                <option value="1">�O</option>
              </select> <font color="#666666">(���ҼҪO�n�[[!--class.name--])</font> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�u�եΦ����D�Ϥ����H���G 
        <select name="ispic" id="select9">
          <option value="0">����</option>
          <option value="1">�O</option>
        </select></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">������ؼƶq�G</td>
            <td width="76%"><input name="classnum" type="text" id="titlelen4" value="0"> 
              <font color="#666666">(0��������)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�Y���ާ@�����G</td>
            <td width="76%"><select name="firstdotype" id="select10">
                <option value="0">���������Y��</option>
                <option value="1">��ؤ��e²��</option>
                <option value="2">��ر��˫H��</option>
                <option value="3">����Y���H��</option>
                <option value="4">��س̷s�H��</option>
              </select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�Y�����D�I���r�ơG</td>
            <td width="76%"><input name="firsttitlelen" type="text" id="firsttitlelen" value="32"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�Y��²���I���r�ơG</td>
            <td width="76%"><input name="firstsmalltextlen" type="text" id="firstsmalltextlen" value="0"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">�Y���u�եΦ����D�Ϥ����H���G 
        <select name="firstispic" id="select11">
          <option value="0">����</option>
          <option value="1">�O</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="isgood=1">1�ű���</option>
<option value="firsttitle=1">1���Y��</option>
<option value="field='��'">�r�q����Y��</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
<option value="newstime ASC">���o�G�ɶ��ɧǱƧ�</option>
<option value="id DESC">��ID���ǱƧ�</option>
<option value="onclick DESC">���I���v���ǱƧ�</option>
<option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
<option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
<option value="diggtop DESC">������(digg)���ǱƧ�</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#listsonclass" target="_blank" title="�d�ݸԲӼ��һy�k">[listsonclass]���ID,��ܱ���,���D�I����,�O�_�����ئW,�ާ@����,�ҪOID,�u��ܦ����D�Ϥ�,�����ؼ�,����Y���ާ@����,�Y�����D�I����,�Y��²���I����,�Y���u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�[/listsonclass]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='totaldata')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var fclassid=obj.classid.value;
	var flimittime=obj.limittime.value;
	var fdotype=obj.dotype.value;
	var ftotaltype=obj.totaltype.value;
	bqstr="[totaldata]"+fclassid+","+fdotype+","+flimittime+","+ftotaltype+"[/totaldata]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">totaldata���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select12" onchange="var addurl='';if(this.options[this.selectedIndex].value==0){addurl='&doobject=2';}else if(this.options[this.selectedIndex].value==1){addurl='&doobject=5';}else if(this.options[this.selectedIndex].value==2){addurl='&doobject=4';}self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&addselfinfo=1&mydotype='+this.options[this.selectedIndex].value+addurl;">
                <option value="0"<?=$mydotype==0?' selected':''?>>�έp��ؼƾ�</option>
                <option value="1"<?=$mydotype==1?' selected':''?>>�έp���D����</option>
                <option value="2"<?=$mydotype==2?' selected':''?>>�έp�ƾڪ�</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ɶ��d��G</td>
            <td width="76%"><select name="limittime" id="select13">
                <option value="0">����</option>
                <option value="1">����</option>
                <option value="2">����</option>
                <option value="3">���~</option>
              </select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%">�έp�����G</td>
          <td width="76%"><select name="totaltype" id="select29">
            <option value="0">�έp�H����</option>
            <option value="1">�έp���׼�</option>
            <option value="2">�έp�I����</option>
            <option value="3">�έp�U����</option>
                    </select></td>
        </tr>
      </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#totaldata" target="_blank" title="�d�ݸԲӼ��һy�k">[totaldata]���ID,�ާ@����,�ɶ��d��,�έp����[/totaldata]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='otherlink')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var ftempid=obj.tempid.value;
	var fispic=obj.ispic.value;
	bqstr="[otherlink]"+ftempid+","+fclassid+","+fline+","+ftitlelen+","+fshowclass+","+fdotype+","+fispic+"[/otherlink]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">otherlink���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="dotype" onchange="var addurl='';if(this.options[this.selectedIndex].value==0){addurl='&defchangeobject=1';}else if(this.options[this.selectedIndex].value==1){addurl='&doobject=4';}else if(this.options[this.selectedIndex].value==2){addurl='&doobject=2';}else if(this.options[this.selectedIndex].value==5){addurl='&doobject=5';}self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&addselfinfo=1&mydotype='+this.options[this.selectedIndex].value+addurl;">
                <option value="0"<?=$mydotype==0?' selected':''?>>�q�{</option>
                <option value="1"<?=$mydotype==1?' selected':''?>>���ƾڪ�</option>
                <option value="2"<?=$mydotype==2?' selected':''?>>�����</option>
                <option value="5"<?=$mydotype==5?' selected':''?>>�����D����</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select3">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit6222323" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�����ئW�G</td>
            <td width="76%"><select name="showclass" id="showclass">
                <option value="0">�_</option>
                <option value="1">�O</option>
              </select> <font color="#666666">(���ҼҪO�n�[[!--class.name--])</font> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�u�եΦ����D�Ϥ����H���G 
        <select name="ispic" id="ispic">
          <option value="0">����</option>
          <option value="1">�O</option>
        </select></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#otherlink" target="_blank" title="�d�ݸԲӼ��һy�k">[otherlink]���ҼҪOID,�ާ@�ﹳ,�եα���,���D�I���r��,�O�_�����ئW,�ާ@����,�u��ܼ��D�Ϥ����H��[/otherlink]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eshowphoto')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var ftempid=obj.tempid.value;
	var fpicwidth=obj.picwidth.value;
	var fpicheight=obj.picheight.value;
	bqstr="[eshowphoto]"+ftempid+","+fpicwidth+","+fpicheight+"[/eshowphoto]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eshowphoto">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">eshowphoto���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="tempid">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223233" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ɯ�Ϥ��j�p�G</td>
            <td width="76%">�e
<input name="picwidth" type="text" id="picwidth" value="170" size="6">
              �Ѱ� 
              <input name="picheight" type="text" id="picheight" value="120" size="6"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eshowphoto" target="_blank" title="�d�ݸԲӼ��һy�k">[eshowphoto]���ҼҪOID,�ɯ�Ϥ��e��,�ɯ�Ϥ�����[/eshowphoto]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showsearch')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var fclassid=obj.classid.value;
	var fdotype=obj.dotype.value;
	var flnum=obj.lnum.value;
	var fline=obj.line.value;
	bqstr="[showsearch]"+fline+","+flnum+","+fclassid+","+fdotype+"[/showsearch]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="showsearch">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showsearch���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="dotype">
                <option value="0">�j�������Ʀ�</option>
                <option value="1">�̷s�j���Ʀ�</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ե��`�ƶq�G</td>
            <td width="76%"><input name="lnum" type="text" id="lnum" value="8"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�C����ܼƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line" value="4"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showsearch" target="_blank" title="�d�ݸԲӼ��һy�k">[showsearch]�C����ܱ���,�`����,���id,�ާ@����[/showsearch]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='tagsinfo')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=ReturnAddYh(obj.classid.value);
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var ftids=ReturnAddYh(obj.tids.value);
	var ftempid=obj.tempid.value;
	var fmids=ReturnAddYh(obj.mids.value);
	bqstr="[tagsinfo]"+ftids+","+fline+","+ftitlelen+","+ftempid+","+fclassid+","+fmids+"[/tagsinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="tagsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">tagsinfo���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">TAGS��ID�G</td>
            <td width="76%"><input name="tids" type="text" id="tids"> <input type="button" name="Submit4" value="�d��TAGS" onclick="window.open('../tags/ListTags.php<?=$ecms_hashur['whehref']?>');">
              <font color="#666666">(�h��ID��,���j�})</font></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="tempid">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223234" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�������ID�G</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              <font color="#666666">
              <input type="button" name="Submit42" value="�d�����ID" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');">
              (0�������A�h��ID��,���j�})</font> </td>
          </tr>
        </table> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">����t�μҫ�ID�G</td>
            <td width="76%"><input name="mids" type="text" id="mids" value="0">
              <font color="#666666"> (0�������A�h��ID��,���j�})</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#tagsinfo" target="_blank" title="�d�ݸԲӼ��һy�k">[tagsinfo]TAGS��ID,��ܱ���,���D�I����,���ҼҪOID,���ID,�t�μҫ�ID[/tagsinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='spinfo')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fvname=obj.vname.value;
	bqstr="[spinfo]'"+fvname+"',"+fline+","+ftitlelen+"[/spinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="spinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">spinfo���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�H���ܶq�W�G</td>
            <td width="76%"><input name="vname" type="text" id="vname">
              <input type="button" name="Submit43" value="�d�ݸH��" onclick="window.open('../sp/ListSp.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���D�I���r�ơG</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp; </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#spinfo" target="_blank" title="�d�ݸԲӼ��һy�k">[spinfo]�H���ܶq�W,��ܱ���,���D�I����[/spinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showtags')
{
	$tagsclass='';
	$tcsql=$empire->query("select classid,classname from {$dbtbpre}enewstagsclass order by classid");
	while($tcr=$empire->fetch($tcsql))
	{
		$tagsclass.='<option value="'.$tcr[classid].'">'.$tcr[classname].'</option>';
	}
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var tfont='';
	var dh='';
	var fclassid=obj.tagsclassid.value;
	var flnum=obj.lnum.value;
	var fline=obj.line.value;
	var forderby=obj.orderby.value;
	var fisgood=obj.isgood.value;
	var fjg=obj.jg.value;
	var fshownum=obj.shownum.value;
	var faddcs=obj.addcs.value;
	var fvartype=obj.vartype.value;
	//�ݩ�
	if(obj.tfontb.checked==true)
	{
		tfont+='s';
		dh=',';
	}
	if(obj.tfontr.checked==true)
	{
		tfont+=dh+'r';
	}
	bqstr="[showtags]"+fclassid+","+flnum+","+fline+",'"+forderby+"',"+fisgood+",'"+tfont+"','"+fjg+"',"+fshownum+",'"+faddcs+"','"+fvartype+"'[/showtags]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="showtags">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showtags���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���TAGS�����G</td>
            <td width="76%"><select name="tagsclassid" id="tagsclassid">
                <option value="''">����</option>
                <option value="'selfinfo'">�եη�e�H��TAGS</option>
                <?=$tagsclass?>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ե��`�ƶq�G</td>
            <td width="76%"><input name="lnum" type="text" id="lnum" value="10"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�C����ܼƶq�G</td>
            <td width="76%"><input name="line" type="text" id="titlelen2" value="0">
              <font color="#666666">(0��������) </font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby"> <select name="selectorderby" id="select" onchange="document.bqform.orderby.value=document.bqform.selectorderby.value">
                <option value="">�q�{�Ƨ�</option>
                <option value="tagid desc">��TAGSID����</option>
                <option value="num desc">���H���ƭ���</option>
              </select>
              <font color="#666666">(�եη�eTAGS���]�m�L��)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�u��ܱ��˪��G</td>
            <td width="76%"><select name="isgood" id="select14">
                <option value="0">����</option>
                <option value="1">�O</option>
              </select>
              <font color="#666666">(�եη�eTAGS���]�m�L��)</font> </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">����TAGS�ݩʡG</td>
            <td width="76%"><input name="tfontb" type="checkbox" id="tfontb" value="1">
              �[�� <input name="tfontr" type="checkbox" id="tfontr" value="1">
              �[��<font color="#666666">(�եη�eTAGS���]�m�L��)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܶ��j�šG</td>
            <td width="76%"><input name="jg" type="text" id="line2" value="&amp;nbsp;"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܫH���ƶq�G</td>
            <td width="76%"><select name="shownum" id="select16">
                <option value="0">�����</option>
                <option value="1">���</option>
              </select>
              <font color="#666666">(�եη�eTAGS���]�m�L��)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�챵���[�ѼơG</td>
            <td width="76%"><input name="addcs" type="text" id="line4">
              <font color="#666666">(��p�G&amp;tempid=�ҪOID) </font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�챵�ϥ��ܶq�G</td>
            <td width="76%"><select name="vartype">
				<option value="tagname">tagname</option>
                <option value="tagid">tagid</option>
              </select>
              <font color="#666666">(��p�Gtagname=�Ұ��tagid=1)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showtags" target="_blank" title="�d�ݸԲӼ��һy�k">[showtags]����ID,��ܼƶq,�C����ܼƶq,��ܱƧ�,�u��ܱ���,����TAGS�ݩ�,��ܶ��j��,�O�_��ܫH����,�챵���[�Ѽ�,�챵�ϥ��ܶq[/showtags]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showclasstemp')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fshownum=obj.shownum.value;
	var ftempid=obj.tempid.value;
	var fclassnum=obj.classnum.value;
	bqstr="[showclasstemp]"+fclassid+","+ftempid+","+fshownum+","+fclassnum+"[/showclasstemp]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showclasstemp���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select15">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223235" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�����ثH���ơG</td>
            <td width="76%"><select name="shownum" id="select17">
                <option value="0">�����</option>
                <option value="1">���</option>
              </select>
              <font color="#666666">(���ҼҪO�[[!--num--])</font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���������ؼơG</td>
            <td width="76%"><input name="classnum" type="text" id="titlelen5" value="0">
              <font color="#666666">(0��������)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showclasstemp" target="_blank" title="�d�ݸԲӼ��һy�k">[showclasstemp]�����ID,���ҼҪOID,�O�_�����ثH����,�����ؼ�[/showclasstemp]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eshowzt')
{
	//����
	$zcstr='';
	$zcsql=$empire->query("select classid,classname from {$dbtbpre}enewsztclass order by classid");
	while($zcr=$empire->fetch($zcsql))
	{
		$zcstr.="<option value='".$zcr[classid]."'>".$zcr[classname]."</option>";
	}
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=ReturnAddYh(obj.classid.value);
	var fzcid=obj.zcid.value;
	var ftempid=obj.tempid.value;
	var fclassnum=obj.classnum.value;
	bqstr="[eshowzt]"+ftempid+","+fzcid+","+fclassnum+","+fclassid+"[/eshowzt]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">eshowzt���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select20">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit622232353" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">����M�D�����G</td>
            <td width="76%"><select name="zcid" id="select19">
                <option value="0">����</option>
				<?=$zcstr?>
              </select> <input type="button" name="Submit622232352" value="�޲z�M�D����" onclick="window.open('../special/ListZtClass.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">������ܱM�D�ơG</td>
            <td width="76%"><input name="classnum" type="text" id="classnum" value="0"> 
              <font color="#666666">(0��������)</font> </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">����������ID�G</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0"> 
              <font color="#666666"> 
              <input type="button" name="Submit422" value="�d�����ID" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');">
              (0�������A�h��ID��,���j�})</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eshowzt" target="_blank" title="�d�ݸԲӼ��һy�k">[eshowzt]���ҼҪOID,�M�D���OID,��ܱM�D��,�������ID[/eshowzt]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='listshowclass')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fshownum=obj.shownum.value;
	var ftempid=obj.tempid.value;
	var fclassnum=obj.classnum.value;
	bqstr="[listshowclass]"+fclassid+","+ftempid+","+fshownum+","+fclassnum+"[/listshowclass]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">listshowclass���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select15">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223235" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�����ثH���ơG</td>
            <td width="76%"><select name="shownum" id="select17">
                <option value="0">�����</option>
                <option value="1">���</option>
              </select>
              <font color="#666666">(���ҼҪO�[[!--num--])</font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���������ؼơG</td>
            <td width="76%"><input name="classnum" type="text" id="titlelen5" value="0">
              <font color="#666666">(0��������)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#listshowclass" target="_blank" title="�d�ݸԲӼ��һy�k">[listshowclass]�����ID,���ҼҪOID,�O�_�����ثH����,�����ؼ�[/listshowclass]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomead')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	bqstr="[phomead]"+fclassid+"[/phomead]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomead���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�s�iID�G</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              <input type="button" name="Submit622232354" value="�d�ݼs�iID" onclick="window.open('../tool/ListAd.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomead" target="_blank" title="�d�ݸԲӼ��һy�k">[phomead]�s�iID[/phomead]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomevote')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	bqstr="[phomevote]"+fclassid+"[/phomevote]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomevote���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�벼ID�G</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              <input type="button" name="Submit622232354" value="�d�ݧ벼ID" onclick="window.open('../tool/ListVote.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomevote" target="_blank" title="�d�ݸԲӼ��һy�k">[phomevote]�벼ID[/phomevote]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomelink')
{
	//���O
	$cstr='';
	$csql=$empire->query("select classid,classname from {$dbtbpre}enewslinkclass order by classid");
	while($cr=$empire->fetch($csql))
	{
		$cstr.="<option value='".$cr[classid]."'>".$cr[classname]."</option>";
	}
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var flnum=obj.lnum.value;
	var fcid=obj.cid.value;
	var fdotype=obj.dotype.value;
	var fshowlink=obj.showlink.value;
	bqstr="[phomelink]"+fline+","+flnum+","+fdotype+","+fcid+","+fshowlink+"[/phomelink]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomelink���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select20">
                <option value="0">�Ҧ��챵</option>
                <option value="1">�u�եιϤ��챵</option>
                <option value="2">�u�եΤ�r�챵</option>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��������G</td>
            <td width="76%"><select name="cid" id="select19">
                <option value="0">����</option>
                <?=$cstr?>
              </select> <input type="button" name="Submit622232352" value="�޲z�ͱ��챵����" onclick="window.open('../tool/LinkClass.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ե��`�ƶq�G</td>
            <td width="76%"><input name="lnum" type="text" id="lnum" value="12"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�C����ܼƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line5" value="6">
            </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܭ��챵�G</td>
            <td width="76%"><select name="showlink" id="select18">
                <option value="0">�έp�I���챵</option>
                <option value="1">��ܭ��챵</option>
              </select> </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomelink" target="_blank" title="�d�ݸԲӼ��һy�k">[phomelink]�C����ܼ�,����`��,�ާ@����,����id,�O�_��ܭ��챵[/phomelink]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='gbookinfo')
{
	//����
	$cstr='';
	$csql=$empire->query("select bid,bname from {$dbtbpre}enewsgbookclass order by bid");
	while($cr=$empire->fetch($csql))
	{
		$cstr.="<option value='".$cr[bid]."'>".$cr[bname]."</option>";
	}
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var fcid=obj.cid.value;
	var ftempid=obj.tempid.value;
	bqstr="[gbookinfo]"+fline+","+ftempid+","+fcid+"[/gbookinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">gbookinfo���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select20">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit622232353" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">����d�������G</td>
            <td width="76%"><select name="cid" id="select19">
                <option value="0">����</option>
				<?=$cstr?>
              </select> <input type="button" name="Submit622232352" value="�޲z�d������" onclick="window.open('../tool/GbookClass.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line" value="5">
            </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#gbookinfo" target="_blank" title="�d�ݸԲӼ��һy�k">[gbookinfo]��ܫH����,���ҼҪOID,�d������ID[/gbookinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showplinfo')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var fclassid=obj.classid.value;
	var fid=obj.id.value;
	var ftempid=obj.tempid.value;
	var fisgood=obj.isgood.value;
	var fdotype=obj.dotype.value;
	bqstr="[showplinfo]"+fline+","+ftempid+","+fclassid+","+fid+","+fisgood+","+fdotype+"[/showplinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showplinfo���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ�</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="select22">
                <option value="0">���o�G�ɶ��ƦC</option>
                <option value="1">������ƱƦC</option>
                <option value="2">���Ϲ�ƱƦC</option>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���ҼҪO�G</td>
            <td width="76%"><select name="tempid" id="select21">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit6222323532" value="�޲z���ҼҪO" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�������ID�G</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              [<a href="#empirecms" onclick="document.bqform.classid.value='$GLOBALS[navclassid]';">��e���ID</a>] 
              <font color="#666666"> 
              <input type="button" name="Submit4222" value="�d�����ID" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');">
              (0������)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">����H��ID�G</td>
            <td width="76%"><input name="id" type="text" id="id" value="0">
              [<a href="#empirecms" onclick="document.bqform.id.value='$navinfor[id]';">��e�H��ID</a>] <font color="#666666"> (0������)</font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�u�եα��˵��סG</td>
            <td width="76%"><select name="isgood" id="select23">
                <option value="0">����</option>
                <option value="1">�u�եα��˵���</option>
              </select> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showplinfo" target="_blank" title="�d�ݸԲӼ��һy�k">[showplinfo]�եα���,���ҼҪOID,���ID,�H��ID,��ܱ��˵���,�ާ@����[/showplinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='echocheckbox')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfield=obj.lfield.value;
	var fexpstr=obj.expstr.value;
	bqstr="[echocheckbox]'"+flfield+"','"+fexpstr+"'[/echocheckbox]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">echocheckbox���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�_��r�q�W�G</td>
            <td width="76%"><input name="lfield" type="text" id="lfield" value="title">
            </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���j�šG</td>
            <td width="76%"><input name="expstr" type="text" id="expstr" value="&lt;br&gt;"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#echocheckbox" target="_blank" title="�d�ݸԲӼ��һy�k">[echocheckbox]'�r�q','���j��'[/echocheckbox]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='includefile')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfile=obj.lfile.value;
	bqstr="[includefile]'"+flfile+"'[/includefile]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">includefile���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ޥΤ��a�}�G</td>
            <td width="76%"><input name="lfile" type="text" id="lfile" value="../../header.html">
              <font color="#666666">(�۹���x�ؿ�)</font> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#includefile" target="_blank" title="�d�ݸԲӼ��һy�k">[includefile]'���a�}'[/includefile]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='readhttp')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfile=obj.lfile.value;
	bqstr="[readhttp]'"+flfile+"'[/readhttp]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">readhttp���ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">Ū�������a�}�G</td>
            <td width="76%"><input name="lfile" type="text" id="lfile" value="http://">
            </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#readhttp" target="_blank" title="�d�ݸԲӼ��һy�k">[readhttp]'�����a�}'[/readhttp]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='ShowMemberInfo')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfield=obj.lfield.value;
	var fmuserid=obj.muserid.value;
	bqstr="<?="<?php\\r\\n\$userr=sys_ShowMemberInfo(\"+fmuserid+\",'\"+flfield+\"');\\r\\n?>"?>\r\n";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ShowMemberInfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">ShowMemberInfo��ƽեΥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�|���b��ID�G</td>
            <td width="76%"><input name="muserid" type="text" id="muserid" value="0">
              <input type="button" name="Submit62223235222" value="�d�ݷ|��ID" onclick="window.open('../member/ListMember.php<?=$ecms_hashur['whehref']?>');">
              <font color="#666666">(0���o�G��ID)</font></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�d�ߦr�q�G</td>
            <td width="76%"> 
              <input name="lfield" type="text" id="lfield">
              <font color="#666666">(�Ŭ��d�ߩҦ��|���r�q)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#ShowMemberInfo" target="_blank" title="�d�ݸԲӼ��һy�k">sys_ShowMemberInfo(�Τ�ID,�d�ߦr�q)</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='ListMemberInfo')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var tfont='';
	var dh='';
	var fdotype=obj.dotype.value;
	var fline=obj.line.value;
	var fmgroupid=obj.mgroupid.value;
	var fmuserid=obj.muserid.value;
	var flfield=obj.lfield.value;
	bqstr="<?="<?php\\r\\n\$usersql=sys_ListMemberInfo(\"+fline+\",\"+fdotype+\",'\"+fmgroupid+\"','\"+fmuserid+\"','\"+flfield+\"');\\r\\nwhile(\$userr=\$empire->fetch(\$usersql))\\r\\n{\\r\\n?>\\r\\n<a href=\\\"/e/space/?userid=<?=\$userr[userid]?>\\\"><?=\$userr[username]?></a><br>\\r\\n<?php\\r\\n}\\r\\n?>"?>";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ListMemberInfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">ListMemberInfo�եΨ�ƥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">���Ұ򥻰Ѽ� </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�ާ@�����G</td>
            <td width="76%"><select name="dotype" id="dotype">
                <option value="0">�����U�ɶ��Ƨ�</option>
                <option value="1">���n���ƧǱƧ�</option>
                <option value="2">������Ʀ�Ƨ�</option>
                <option value="3">���|���Ŷ��H��Ʀ�Ƨ�</option>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line7" value="10"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">����|����ID�G</td>
            <td width="76%"><input name="mgroupid" type="text" id="mgroupid">
              <input type="button" name="Submit622232352222" value="�d�ݷ|����ID" onclick="window.open('../member/ListMemberGroup.php<?=$ecms_hashur['whehref']?>');"> 
              <font color="#666666">(���]�m�������A�h�ӷ|���եγr���j�}�A�p�G'1,2') </font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�|���b��ID�G</td>
            <td width="76%"><input name="muserid" type="text" id="muserid"> 
              <input type="button" name="Submit622232352223" value="�d�ݷ|��ID" onclick="window.open('../member/ListMember.php<?=$ecms_hashur['whehref']?>');">
              <font color="#666666">(���]�m�������A�h�ӥΤ�ID�γr���j�}�A�p�G'25,27')</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�d�ߦr�q�G</td>
            <td width="76%"> <input name="lfield" type="text" id="lfield3"> <font color="#666666">(�Ŭ��d�ߩҦ��|���r�q)</font> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#ListMemberInfo" target="_blank" title="�d�ݸԲӼ��һy�k">sys_ListMemberInfo(�եα���,�ާ@����,�|����ID,�Τ�ID,�d�ߦr�q)</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='spaceeloop')
{
?>
<script>
//��^����
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fdotype=obj.dotype.value;
	var fispic=obj.ispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="<?="<?php\\r\\n\$spacesql=espace_eloop(\"+fclassid+\",\"+fline+\",\"+fdotype+\",\"+fispic+addstr+\");\\r\\nwhile(\$spacer=\$empire->fetch(\$spacesql))\\r\\n{\\r\\n        \$spacesr=espace_eloop_sp(\$spacer);\\r\\n?>\\r\\n<a href=\\\"<?=\$spacesr[titleurl]?>\\\" target=\\\"_blank\\\"><?=\$spacer[title]?></a> <br>\\r\\n<?php\\r\\n}\\r\\n?>"?>";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="spaceeloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">spaceeloop�|���Ŷ��F�ʼ��ҥͦ� 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">��ܽեιﹳ�G 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&addselfinfo=1&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>���q�{��( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>���</option>
          <option value="5"<?=$doobject==5?' selected':''?>>���D����</option>
          <option value="4"<?=$doobject==4?' selected':''?>>�ƾڪ�</option>
          <option value="5"<?=$doobject==5?' selected':''?>>���D����</option>
          <option value="6"<?=$doobject==6?' selected':''?>>��SQL�ե�</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">�եμƶq�G</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">�u�եΦ����D�Ϥ����H���G 
        <select name="ispic" id="select6">
          <option value="0">����</option>
          <option value="1">�O</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�ﶵ�]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">���[SQL����G</td>
            <td width="76%"><input name="addsql" type="text" id="addsql"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="isgood=1">1�ű���</option>
<option value="firsttitle=1">1���Y��</option>
<option value="field='��'">�r�q����Y��</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">��ܱƧǡG</td>
            <td width="76%"><input name="orderby" type="text" id="orderby"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- �w�ﶵ -- </option>
<option value="newstime DESC">���o�G�ɶ����ǱƧ�</option>
<option value="newstime ASC">���o�G�ɶ��ɧǱƧ�</option>
<option value="id DESC">��ID���ǱƧ�</option>
<option value="onclick DESC">���I���v���ǱƧ�</option>
<option value="totaldown DESC">���U���ƭ��ǱƧ�</option>
<option value="plnum DESC">�����׼ƭ��ǱƧ�</option>
<option value="diggtop DESC">������(digg)���ǱƧ�</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="��X����" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#spaceeloop" target="_blank" title="�d�ݸԲӼ��һy�k">&lt;?php<br>
        $spacesql=espace_eloop(���ID,��ܱ���,�ާ@����,�u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�);<br>
        while($spacer=$empire-&gt;fetch($spacesql))<br>
        {<br>
        $spacesr=espace_eloop_sp($spacer);<br>
        ?&gt;<br>
        �ҪO�N�X���e<br>
        &lt;?php<br>
        }<br>
        ?&gt;</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="�ƻs�W�����Ҥ��e" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html>
<?php
db_close();
$empire=null;
?>
