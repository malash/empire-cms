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
//�����v��
CheckLevel($logininid,$loginin,$classid,"m");
$tid=(int)$_GET['tid'];
$tbname=RepPostVar($_GET['tbname']);
if(!$tid||!$tbname)
{
	printerror("ErrorUrl","history.go(-1)");
}
$enews=RepPostStr($_GET['enews'],1);
$docopy=(int)$_GET['docopy'];
$mtype=" checked";
$r['mustqenterf']=",title,";
$r[myorder]=0;
$record="<!--record-->";
$field="<!--field--->";
$postword='�W�[';
$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListM.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�t�μҫ��޲z</a>&nbsp;>&nbsp;�W�[�t�μҫ�";
if($enews=="AddM"&&$docopy)
{
	$postword='�ƻs';
	$mid=(int)$_GET['mid'];
	$mtype="";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmod where mid='$mid' and tid='$tid'");
	$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListM.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�t�μҫ��޲z</a>&nbsp;>&nbsp;�ƻs�t�μҫ�: ".$r['mname'];
}
//�ק�t�μҫ�
if($enews=="EditM")
{
	$postword='�ק�';
	$mid=(int)$_GET['mid'];
	$mtype="";
	$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListM.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�t�μҫ��޲z</a>&nbsp;>&nbsp;�ק�t�μҫ�";
	$r=$empire->fetch1("select * from {$dbtbpre}enewsmod where mid='$mid' and tid='$tid'");
}
//���o�r�q
$no=0;
$fsql=$empire->query("select f,fname,iscj,dotemp,tbdataf from {$dbtbpre}enewsf where isshow=1 and tid='$tid' order by myorder,fid");
while($fr=$empire->fetch($fsql))
{
	$no++;
	$bgcolor="ffffff";
	if($no%2==0)
	{
		$bgcolor="#F8F8F8";
	}
	$like=$field.$fr[f].$record;
	$slike=",".$fr[f].",";
	//���J��
	if(strstr($r[enter],$like))
	{
		$enterchecked=" checked";
		//���o�r�q����
		$dor=explode($like,$r[enter]);
		if(strstr($dor[0],$record))
		{
			$dor1=explode($record,$dor[0]);
			$last=count($dor1)-1;
			$fr[fname]=$dor1[$last];
		}
		else
		{
			$fr[fname]=$dor[0];
		}
	}
	else
	{
		$enterchecked="";
	}
	//���D
	if($enews=="AddM"&&($fr[f]=="title"||$fr[f]=="special.field"))
	{
		$enterchecked=" checked";
	}
	$entercheckbox="<input name=center[] type=checkbox class='docheckbox' value='".$fr[f]."'".$enterchecked.">";
	//��Z��
	if(strstr($r[qenter],$like))
	{
		$qenterchecked=" checked";
	}
	else
	{
		$qenterchecked="";
	}
	$qentercheckbox="<input name=cqenter[] type=checkbox class='docheckbox' value='".$fr[f]."'".$qenterchecked.">";
	$listtempfcheckbox="";
	$pagetempfcheckbox="";
	if($fr['dotemp'])
	{
		//�C��ҪO��
		if(empty($fr['tbdataf']))//�D��
		{
			if(strstr($r[listtempvar],$like))
			{
				$listtempfchecked=" checked";
			}
			else
			{
				$listtempfchecked="";
			}
			$listtempfcheckbox="<input name=ltempf[] type=checkbox class='docheckbox' value='".$fr[f]."'".$listtempfchecked.">";
		}
		//���e�ҪO��
		if(strstr($r[tempvar],$like))
		{
			$pagetempfchecked=" checked";
		}
		else
		{
			$pagetempfchecked="";
		}
		$pagetempfcheckbox="<input name=ptempf[] type=checkbox class='docheckbox' value='".$fr[f]."'".$pagetempfchecked.">";
	}
	//�Ķ���
	$cjcheckbox="";
	if($fr[iscj])
	{
		if(strstr($r[cj],$like))
		{$cjchecked=" checked";}
		else
		{$cjchecked="";}
		//���D
		if($enews=="AddM"&&$fr[f]=="title")
		{
			$cjchecked=" checked";
		}
		$cjcheckbox="<input name=cchange[] type=checkbox class='docheckbox' value='".$fr[f]."'".$cjchecked.">";
	}
	//�j����
	$searchcheckbox="";
	if($fr[f]!="special.field"&&empty($fr['tbdataf'])&&empty($fr['tbdataf']))
	{
		if(strstr($r[searchvar],$slike))
		{$searchchecked=" checked";}
		else
		{$searchchecked="";}
		$searchcheckbox="<input name=schange[] type=checkbox class='docheckbox' value='".$fr[f]."'".$searchchecked.">";
	}
	//����
	$mustfcheckbox="";
	if($fr[f]!="special.field")
	{
		$mustfchecked="";
		if(strstr($r[mustqenterf],$slike))
		{$mustfchecked=" checked";}
		if($enews=="AddM"&&$fr[f]=="title")
		{
			$mustfchecked=" checked";
		}
		$mustfcheckbox="<input name=menter[] type=checkbox class='docheckbox' value='".$fr[f]."'".$mustfchecked.">";
	}
	//���X��
	$listandfcheckbox="";
	if($fr[f]!="special.field"&&empty($fr['tbdataf']))
	{
		$listandfchecked="";
		if(strstr($r[listandf],$slike))
		{$listandfchecked=" checked";}
		$listandfcheckbox="<input name=listand[] type=checkbox class='docheckbox' value='".$fr[f]."'".$listandfchecked.">";
	}
	//�ƧǶ�
	$orderfcheckbox="";
	if($fr[f]!="special.field"&&empty($fr['tbdataf']))
	{
		$orderfchecked="";
		if(strstr($r[orderf],$slike))
		{$orderfchecked=" checked";}
		$orderfcheckbox="<input name=listorder[] type=checkbox class='docheckbox' value='".$fr[f]."'".$orderfchecked.">";
	}
	//�i�W�[
	$canaddfcheckbox="";
	if($fr[f]!="special.field")
	{
		$canaddfchecked="";
		if(strstr($r[canaddf],$slike))
		{$canaddfchecked=" checked";}
		if($enews=="AddM"&&!$docopy)
		{
			$canaddfchecked=" checked";
		}
		$canaddfcheckbox="<input name=canadd[] type=checkbox class='docheckbox' value='".$fr[f]."'".$canaddfchecked.">";
	}
	//�i�ק�
	$caneditfcheckbox="";
	if($fr[f]!="special.field")
	{
		$caneditfchecked="";
		if(strstr($r[caneditf],$slike))
		{$caneditfchecked=" checked";}
		if($enews=="AddM"&&!$docopy)
		{
			$caneditfchecked=" checked";
		}
		$caneditfcheckbox="<input name=canedit[] type=checkbox class='docheckbox' value='".$fr[f]."'".$caneditfchecked.">";
	}
	$data.="<tr bgcolor='".$bgcolor."'> 
            <td height=32> <div align=center> 
                <input name=cname[".$fr[f]."] type=text value='".$fr[fname]."'>
              </div></td>
            <td> <div align=center> 
                <input name=cfield type=text value='".$fr[f]."' readonly>
              </div></td>
			<td><div align=center> 
                ".$entercheckbox."
              </div></td>
			<td><div align=center> 
                ".$qentercheckbox."
              </div></td>
			<td><div align=center> 
                ".$mustfcheckbox."
              </div></td>
			<td><div align=center> 
                ".$canaddfcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$caneditfcheckbox."
              </div></td>
            <td> <div align=center> 
                ".$cjcheckbox."
              </div></td>
            <td><div align=center> 
                ".$listtempfcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$pagetempfcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$searchcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$orderfcheckbox."
              </div></td>
			  <td><div align=center> 
                ".$listandfcheckbox."
              </div></td>
          </tr>";
}
//�w�]�벼
$infovotesql=$empire->query("select voteid,ysvotename from {$dbtbpre}enewsvotemod order by voteid");
while($infovoter=$empire->fetch($infovotesql))
{
	$select="";
	if($r[definfovoteid]==$infovoter[voteid])
	{
		$select=" selected";
	}
	$definfovote.="<option value='".$infovoter[voteid]."'".$select.">".$infovoter[ysvotename]."</option>";
}
//���L�ҪO
$printtemp_options='';
$ptsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsprinttemp")." order by tempid");
while($ptr=$empire->fetch($ptsql))
{
	$select="";
	if($ptr[tempid]==$r[printtempid])
	{
		$select=" selected";
	}
	$printtemp_options.="<option value=".$ptr[tempid].$select.">".$ptr[tempname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�t�μҫ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function DoCheckAll(form,chf)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
	if(e.name==chf)
		{
		e.checked=true;
	    }
	}
  }
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="../ecmsmod.php">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr> 
      <td height="25" colspan="2" class="header">�W�[�t�μҫ� 
        <input name="add[mid]" type="hidden" id="add[mid]" value="<?=$mid?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="add[tbname]" type="hidden" id="add[tbname]" value="<?=$tbname?>"> 
        <input name="add[tid]" type="hidden" id="add[tid]" value="<?=$tid?>"> 
		<?=$ecms_hashur['form']?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="23%" height="25">�ҫ��W��</td>
      <td width="77%" height="25"><input name="add[mname]" type="text" id="add[mname]" value="<?=$r[mname]?>" size="43"> 
        <font color="#666666">(��p�G&quot;�s�D�t�μҫ�&quot;)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ҫ��O�W</td>
      <td height="25"><input name="add[qmname]" type="text" id="add[qmname]" value="<?=$r[qmname]?>" size="43"> 
        <font color="#666666">(��p�G&quot;�s�D&quot;�A�Ω�e�x���)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�O�_�ҥ�</td>
      <td height="25"><input type="radio" name="add[usemod]" value="0"<?=$r[usemod]==0?' checked':''?>>
        �}�� 
        <input type="radio" name="add[usemod]" value="1"<?=$r[usemod]==1?' checked':''?>>
        ���ϥ�</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ܨ�e�x�ɯ�</td>
      <td height="25"><input type="radio" name="add[showmod]" value="0"<?=$r[showmod]==0?' checked':''?>>
        ��� 
        <input type="radio" name="add[showmod]" value="1"<?=$r[showmod]==1?' checked':''?>>
        �����</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ܶ���</td>
      <td height="25"><input name="add[myorder]" type="text" id="add[myorder]" value="<?=$r[myorder]?>" size="43"> 
        <font color="#666666">(�ȶV�p��ܶV�e��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top">��ܥ��ҫ����r�q��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#DBEAF5">
          <tr> 
            <td width="15%" height="25"> <div align="center">�r�q����</div></td>
            <td width="17%" height="25"> <div align="center">�r�q�W</div></td>
            <td width="6%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'center[]');">���J��</a></div></td>
            <td width="6%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'cqenter[]');">��Z��</a></div></td>
            <td width="6%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'menter[]');">����</a></div></td>
            <td width="6%"><div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'canadd[]');">�i�W�[</a></div></td>
            <td width="6%"><div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'canedit[]');">�i�ק�</a></div></td>
            <td width="6%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'cchange[]');">�Ķ���</a></div></td>
            <td width="7%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'ltempf[]');">�C��ҪO</a></div></td>
            <td width="7%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'ptempf[]');">���e�ҪO</a></div></td>
            <td width="6%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'schange[]');">�j����</a></div></td>
            <td width="6%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'listorder[]');">�ƧǶ�</a></div></td>
            <td width="6%"> <div align="center"><a href="#empirecms" title="����" onclick="DoCheckAll(document.form1,'listand[]');">���X��</a></div></td>
          </tr>
          <?=$data?>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2" valign="top"><p>��ئC�����X���]�m�G 
          <input type="radio" name="add[setandf]" value="0"<?=$r[setandf]==0?' checked':''?>>
          �����ǰt 
          <input type="radio" name="add[setandf]" value="1"<?=$r[setandf]==1?' checked':''?>>
          �ҽk�ǰt</p></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">���J���ҪO<br>
        (<font color="#FF0000"> 
        <input name="add[mtype]" type="checkbox" id="add[mtype]" value="1"<?=$mtype?>>
        �۰ʥͦ����ҪO</font>)</td>
      <td height="25"><textarea name="add[mtemp]" cols="75" rows="20" id="add[mtemp]" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[mtemp]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�e�x��Z���ҪO<br>
        (<font color="#FF0000"> 
        <input name="add[qmtype]" type="checkbox" id="add[qmtype]" value="1"<?=$mtype?>>
        �۰ʥͦ����ҪO</font>) </td>
      <td height="25"><textarea name="add[qmtemp]" cols="75" rows="20" id="textarea2" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[qmtemp]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2" valign="top">�H���C��W��</td>
      <td height="25"><input name="add[listfile]" type="text" id="add[listfile]" value="<?=$r[listfile]?>" size="43"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><font color="#666666">(���]�m���ϥ��q�{�C��A�W�[�C��i�be/data/html/list�̼W�[���A<a href="../../data/html/list/ReadMe.txt" target="_blank">�I���o��</a>�d�ݻ���)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�H���w�]�벼</td>
      <td height="25"><select name="add[definfovoteid]" id="add[definfovoteid]">
          <option value="0">���]�m</option>
          <?=$definfovote?>
        </select> <input type="button" name="Submit622" value="�޲z�w�]�벼" onclick="window.open('../other/ListVoteMod.php<?=$ecms_hashur['whehref']?>');"> 
        <font color="#666666">(�W�[�H�����q�{���벼��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���L�ҪO</td>
      <td height="25"><select name="add[printtempid]" id="add[printtempid]">
	  		<option value="0">�ϥ��q�{</option>
          <?=$printtemp_options?>
        </select> 
        <input type="button" name="Submit6222" value="�޲z���L�ҪO" onclick="window.open('../template/ListPrinttemp.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">����</td>
      <td height="25"><textarea name="add[mzs]" cols="75" rows="10" id="textarea" style="WIDTH: 100%"><?=stripSlashes($r[mzs])?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
