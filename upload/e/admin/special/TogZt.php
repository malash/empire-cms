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

$ztid=(int)$_GET['ztid'];
if(empty($ztid))
{
	$ztid=(int)$_POST['ztid'];
}
//�����v��
//CheckLevel($logininid,$loginin,$classid,"zt");
$returnandlevel=CheckAndUsernamesLevel('dozt',$ztid,$logininid,$loginin,$loginlevel);

$enews=$_POST['enews'];
if(empty($enews))
{
	$enews=$_GET['enews'];
}
if($enews)
{
	hCheckEcmsRHash();
	include('../../class/classfun.php');
}
if($enews=="TogZt")
{
	include('../../data/dbcache/class.php');
	$re=TogZt($_POST,$logininid,$loginin);
}
elseif($enews=='SaveTogZtInfo')
{
	SaveTogZtInfo($_POST,$logininid,$loginin);
}
elseif($enews=='DelTogZtInfo')
{
	DelTogZtInfo($_GET,$logininid,$loginin);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�զX�M�D</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if($enews=="TogZt")
{
	include '../'.LoadLang("pub/fun.php");
	$totalnum=(int)$_POST['totalnum'];
	$start=0;
	$page=(int)$_POST['page'];
	$page=RepPIntvar($page);
	$line=(int)$_POST['pline'];//�C�����
	$page_line=12;
	$offset=$page*$line;
	$addsql='';
	if($ecms_config['db']['dbver']>=4.1)
	{
		$addsql=" and id not in (select id from {$dbtbpre}enewsztinfo where ztid='$ztid' and mid in (".eGetTableModids(0,$re[2])."))";
	}
	$query="select id,title,ismember,username,plnum,isqf,classid,totaldown,onclick,newstime,isurl,titleurl,titlepic,havehtml,truetime,lastdotime,istop,isgood,firsttitle from {$dbtbpre}ecms_".$re[2]." where ".$re[0].$addsql;
	$totalquery="select count(*) as total from {$dbtbpre}ecms_".$re[2]." where ".$re[0].$addsql;
	if($totalnum<1)
	{
		$num=$empire->gettotal($totalquery);//���o�`����
	}
	else
	{
		$num=$totalnum;
	}
	$query.=" order by newstime desc limit $offset,$line";
	$sql=$empire->query($query);
	//�M�D�l��
	$zcurl='';
	$zcid=(int)$_POST['zcid'];
	if($zcid)
	{
		$zcr=$empire->fetch1("select cname from {$dbtbpre}enewszttype where cid='$zcid'");
		$zcurl='&nbsp;->&nbsp;<b>'.$zcr[cname].'</b>';
	}
	$url="�M�D: <b>".$re[3]."</b>".$zcurl."&nbsp;->&nbsp;<a href='TogZt.php?ztid=".$ztid.$ecms_hashur['ehref']."'>�զX�M�D</a>&nbsp;(".$dbtbpre."ecms_".$re[2].")";
	$returnpage=postpage($num,$line,$page_line,$start,$page,"document.ListZtInfo");
?>
<script>
function DelInfoid(id){
	var inid=document.ListZtInfo.inid.value;
	var dh="",cinid="";
	if(inid=="")
	{
		dh="";
	}
	else
	{
		dh=",";
	}
	cinid=","+inid+",";
	if(cinid.indexOf(","+id+",")==-1)
	{
		document.ListZtInfo.inid.value+=dh+id;
	}
}
function ReInfoid(id){
	var inid=","+document.ListZtInfo.inid.value+",";
	var dh="",newinid="",len;
	if(inid=="")
	{
		return "";
	}
	if(inid.indexOf(","+id+",")!=-1)
	{
		newinid=inid.replace(","+id+",",",");
		if(newinid==",")
		{
			document.ListZtInfo.inid.value="";
			return "";
		}
		//�h���e��,
		len=newinid.length;
		newinid=newinid.substring(1,len-1);
		document.ListZtInfo.inid.value=newinid;
	}
}
function DoTogzt(){
	document.ListZtInfo.doecmszt.value=1;
	document.ListZtInfo.submit();
}
</script>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>
  
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="ListZtInfo" method="POST" action="TogZt.php">
	<?=$ecms_hashur['form']?>
	<input type=hidden name=totalnum value="<?=$num?>">
	<input type=hidden name=page value="<?=$page?>">
	<input type=hidden name=start value="<?=$start?>">
	<?=$re[1]?>
    <tr class="header"> 
      <td width="6%" height="25"> <div align="center">���</div></td>
      <td width="55%"><div align="center">���D</div></td>
      <td width="18%"><div align="center">�o�G��</div></td>
      <td width="21%"><div align="center">�o�G�ɶ�</div></td>
    </tr>
	<?php
	while($r=$empire->fetch($sql))
	{
		//�ɶ�
		$truetime=date_time($r[truetime],"Y-m-d H:i:s");
		$lastdotime=date_time($r[lastdotime],"Y-m-d H:i:s");
		$oldtitle=$r[title];
		$r[title]=stripSlashes(sub($r[title],0,45,false));
		//�|����Z
		if($r[ismember])
		{
			$r[username]="<font color=red>".$r[username]."</font>";
		}
		$titleurl=sys_ReturnBqTitleLink($r);
		$checked='';
		$bgcolor="#FFFFFF";
		if(strstr(",".$_POST['inid'].",",",".$r[id].","))
		{
			$bgcolor="#DBEAF5";
			$checked=" checked";
		}
		//�O�_�w�[�J�M�D
		$checkbox='<input name="checkid" type="checkbox" id="checkid" onClick="if(this.checked){DelInfoid('.$r[id].');news'.$r[id].'.style.backgroundColor=\'#DBEAF5\';}else{ReInfoid('.$r[id].');news'.$r[id].'.style.backgroundColor=\'#ffffff\';}" value="'.$r[id].'"'.$checked.'>';
		if(empty($addsql))
		{
			$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsztinfo where ztid='$ztid' and classid='$r[classid]' and id='$r[id]' limit 1");
			if($num)
			{
				$checkbox='';
			}
		}
	?>
    <tr bgcolor="<?=$bgcolor?>" id=news<?=$r[id]?>> 
      <td height="25"> <div align="center"> 
          <?=$checkbox?>
        </div></td>
      <td>
	  	<a href='<?=$titleurl?>' target=_blank title="<?=$oldtitle?>"> 
        <?=$r[title]?>
        </a>
	  </td>
      <td><div align="center"><?=$r[username]?></div></td>
      <td><div align="center"><a href="../AddNews.php?enews=EditNews&id=<?=$r[id]?>&classid=<?=$r[classid]?><?=$ecms_hashur['ehref']?>" title="<?php echo"�W�[�ɶ��G".$truetime."\r\n�̫�ק�G".$lastdotime;?>" target=_blank><?=date("Y-m-d H:i:s",$r[newstime])?></a></div></td>
    </tr>
	<?php
	}
	?>
    <tr bgcolor="ffffff"> 
      <td height="25"> <div align="center"></div></td>
      <td colspan="3"><?=$returnpage?></td>
    </tr>
    <tr bgcolor="ffffff"> 
      <td height="25"> <div align="center"></div></td>
      <td colspan="3"><input name="togtype" type="radio" value="0" checked>
      �ư��襤
        <input type="radio" name="togtype" value="1">
        �զX�襤
        <input type="button" name="Submit3" value="�}�l�զX�M�D" onclick="javascript:DoTogzt();"></td>
    </tr>
  </form>
</table>
<?php
}
else
{
	if(empty($ztid))
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$r=$empire->fetch1("select ztid,ztname from {$dbtbpre}enewszt where ztid='$ztid'");
	if(empty($r['ztid']))
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	//��l��
	$togr[startid]=0;
	$togr[endid]=0;
	$togr[pline]=50;
	$togr[searchf]=",stitle,";
	$togr[doecmszt]=0;
	$url="�M�D: <b>".$r[ztname]."</b>&nbsp;->&nbsp;�զX�M�D";
	//--------------------�ާ@�����
	$fcjsfile='../../data/fc/cmsclass.js';
	$class=GetFcfiletext($fcjsfile);
	$togid=(int)$_GET['togid'];
	if($togid)
	{
		$togr=$empire->fetch1("select * from {$dbtbpre}enewstogzts where togid='$togid'");
		$class=str_replace("<option value='$togr[classid]'","<option value='$togr[classid]' selected",$class);
	}
	//�Ѽ�
	$togsql=$empire->query("select togid,togztname from {$dbtbpre}enewstogzts order by togid");
	while($tgr=$empire->fetch($togsql))
	{
		$selected='';
		if($togid==$tgr[togid])
		{
			$selected=' selected';
		}
		$togzts.="<option value='".$tgr[togid]."'".$selected.">".$tgr[togztname]."</option>";
	}
	//�ƾڪ�
	$tables='';
	$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
	while($tr=$empire->fetch($tsql))
	{
		$tables.="<option value='".$tr[tbname]."'>".$tr[tname]."(".$tr[tbname].")</option>";
	}
	//�M�D�l��
	$zttypes='';
	$zttypesql=$empire->query("select cid,cname from {$dbtbpre}enewszttype where ztid='$ztid'");
	while($zttyper=$empire->fetch($zttypesql))
	{
		$zttypes.="<option value='".$zttyper['cid']."'>".$zttyper['cname']."</option>";
	}
?>
<script src="../ecmseditor/fieldfile/setday.js"></script>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
<form name="loadtogzt" method="get" action="TogZt.php">
	<?=$ecms_hashur['form']?>
  <tr> 
    <td width="50%" height="25">��m�G 
      <?=$url?>
    </td>
    <td><div align="right">
          <select name="togid" id="togid">
		  <option name="">��ܲզX�Ѽ�</option>
		  <?=$togzts?>
          </select>
          <input type="submit" name="Submit5" value="�ɤJ�Ѽ�" onclick="document.loadtogzt.enews.value='';">
          &nbsp; 
          <input type="submit" name="Submit6" value="�R��" onclick="document.loadtogzt.enews.value='DelTogZtInfo';">
          <input name="enews" type="hidden" id="enews" value="">
          <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>">
        </div></td>
  </tr>
  </form>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class=tableborder>
  <form name="form1" method="post" action="TogZt.php" onsubmit="if(document.form1.doecmszt.checked){return confirm('�T�{�n���榹�ާ@�H');}else{return true;}">
    <tr class=header> 
			  <?=$ecms_hashur['form']?>
      <td height="27" colspan="2">�զX�M�D</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="27">�[�J�M�D</td>
      <td height="27"><b><?=$r[ztname]?></b></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="27">�[�J�M�D�l��</td>
      <td height="27"><select name="zcid" id="zcid">
        <option value="0">���ݱM�D�l��</option>
		<?=$zttypes?>
      </select>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="22%" height="27">��ܼƾڪ�(*)</td>
      <td width="78%" height="27"><select name="tbname" id="tbname">
          <?=$tables?>
        </select></td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="27">�d�����</td>
      <td height="27"> <select name="classid" id="select">
          <option value="0">�Ҧ����</option>
          <?=$class?>
        </select> <font color="#666666">�]�p��ܤj��ءA�N�d�ߩҦ��l��ء^</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27">�զX����r</td>
      <td height="27"> <input name="keyboard" type="text" id="keyboard2" size="38" value="<?=stripSlashes($togr[keyboard])?>"> 
        <font color="#666666">(���񬰤�����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27">�d�ߦr�q</td>
      <td height="27"> <input name="stitle" type="checkbox" id="stitle3" value="1"<?=strstr($togr[searchf],',stitle,')?' checked':''?>>
        ���D 
        <input name="susername" type="checkbox" id="susername2" value="1"<?=strstr($togr[searchf],',susername,')?' checked':''?>>
        �o�G��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27">���[SQL����</td>
      <td height="27"><input name="query" type="text" id="query" value="<?=stripSlashes($togr[query])?>" size="60"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27">&nbsp;</td>
      <td height="27"><font color="#666666">(�榡�p�G�uwriter='�@��'�v)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27">�S�����</td>
      <td height="27"> <input name="isgood" type="checkbox" id="isgood3" value="1"<?=strstr($togr[specialsearch],',isgood,')?' checked':''?>>
        ���� 
        <input name="firsttitle" type="checkbox" id="firsttitle2" value="1"<?=strstr($togr[specialsearch],',firsttitle,')?' checked':''?>>
        �Y�� 
        <input name="titlepic" type="checkbox" id="titlepic2" value="1"<?=strstr($togr[specialsearch],',titlepic,')?' checked':''?>>
        �����D�Ϥ�<font color="#666666">(���אּ������)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27"> <input name="retype" type="radio" value="0"<?=$togr[retype]==0?' checked':''?>>
        ���ɶ��d��</td>
      <td height="27">�q 
        <input name="startday" type="text" onclick="setday(this)" value="<?=$togr[startday]?>" size="12">
        �� 
        <input name="endday" type="text" onclick="setday(this)" value="<?=$togr[endday]?>" size="12">
        �������ƾ�<font color="#666666">(����N�d�ߩҦ��H��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27"> <input name="retype" type="radio" value="1"<?=$togr[retype]==1?' checked':''?>>
        ��ID�d��</td>
      <td height="27">�q 
        <input name="startid" type="text" id="startid2" value="<?=$togr[startid]?>" size="6">
        �� 
        <input name="endid" type="text" id="endid2" value="<?=$togr[endid]?>" size="6">
        �������ƾ�<font color="#666666">(�p��ӭȬ�0�N�d�ߩҦ��H��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27">�C����ܦ��</td>
      <td height="27"><input name="pline" type="text" id="pline" value="<?=$togr[pline]?>" size="6"> 
        <input name="doecmszt" type="checkbox" id="doecmszt" value="1"<?=$togr[doecmszt]==1?' checked':''?>>
        �����զX�M�D<font color="#666666">(����ܦC��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27">&nbsp;</td>
      <td height="27"> <input type="submit" name="Submit" value=" �}�l�զX " onclick="document.form1.enews.value='TogZt';"> <input type="reset" name="Submit2" value="���m"> 
        <input name="enews" type="hidden" id="enews2" value="TogZt"> <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="27">&nbsp;</td>
      <td height="27">�ѼƦW: 
        <input name="togztname" type="text" id="togztname" value="<?=$togr[togztname]?>">
        <input type="submit" name="Submit4" value="�O�s�Ѽ�" onclick="document.form1.enews.value='SaveTogZtInfo';"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="27" colspan="2"><font color="#666666">�����G���\��O�N�d�ߪ��H���[�J�M�D�C</font></td>
    </tr>
	</form>
  </table>
<?php
}
?>
</body>
</html>
<?php
db_close();
$empire=null;
?>