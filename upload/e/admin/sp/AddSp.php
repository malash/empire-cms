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
CheckLevel($logininid,$loginin,$classid,"sp");
$enews=ehtmlspecialchars($_GET['enews']);
$postword='�W�[�H��';
$noteditword='<font color="#666666">(�]�m�ᤣ�i�ק�)</font>';
$disabled='';
$sptypehidden='';
$r[maxnum]=0;
$url="<a href=ListSp.php".$ecms_hashur['whehref'].">�޲z�H��</a> &gt; �W�[�H��";
$fcid=(int)$_GET['fcid'];
$fclassid=(int)$_GET['fclassid'];
$fsptype=(int)$_GET['fsptype'];
$r['spfile']='html/sp/'.time().'.html';
$spid=(int)$_GET['spid'];
if($enews=='EditSp')
{
	$filepass=$spid;
}
else
{
	$filepass=ReturnTranFilepass();
}
//�ƻs
if($enews=="AddSp"&&$_GET['docopy'])
{
	$r=$empire->fetch1("select * from {$dbtbpre}enewssp where spid='$spid'");
	$url="<a href=ListSp.php".$ecms_hashur['whehref'].">�޲z�H��</a> &gt; �ƻs�H���G<b>".$r[spname]."</b>";
	$username=substr($r[username],1,-1);
}
//�ק�
if($enews=="EditSp")
{
	$r=$empire->fetch1("select * from {$dbtbpre}enewssp where spid='$spid'");
	$postword='�ק�H��';
	$noteditword='';
	$disabled=' disabled';
	$sptypehidden='<input type="hidden" name="sptype" value="'.$r[sptype].'">';
	$url="<a href=ListSp.php".$ecms_hashur['whehref'].">�޲z�H��</a> &gt; �ק�H���G<b>".$r[spname]."</b>";
	$username=substr($r[username],1,-1);
}
//���ҼҪO
$bqtemp='';
$bqtempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsbqtemp")." order by tempid");
while($bqtempr=$empire->fetch($bqtempsql))
{
	$select="";
	if($r[tempid]==$bqtempr[tempid])
	{
		$select=" selected";
	}
	$bqtemp.="<option value='".$bqtempr[tempid]."'".$select.">".$bqtempr[tempname]."</option>";
}
//���
$options=ShowClass_AddClass("",$r[classid],0,"|-",0,0);
//����
$scstr='';
$scsql=$empire->query("select classid,classname from {$dbtbpre}enewsspclass order by classid");
while($scr=$empire->fetch($scsql))
{
	$select="";
	if($scr[classid]==$r[cid])
	{
		$select=" selected";
	}
	$scstr.="<option value='".$scr[classid]."'".$select.">".$scr[classname]."</option>";
}
//�Τ��
$group='';
$groupsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsgroup order by groupid");
while($groupr=$empire->fetch($groupsql))
{
	$select='';
	if(strstr($r[groupid],','.$groupr[groupid].','))
	{
		$select=' selected';
	}
	$group.="<option value='".$groupr[groupid]."'".$select.">".$groupr[groupname]."</option>";
}
//����
$userclass='';
$ucsql=$empire->query("select classid,classname from {$dbtbpre}enewsuserclass order by classid");
while($ucr=$empire->fetch($ucsql))
{
	$select='';
	if(strstr($r[userclass],','.$ucr[classid].','))
	{
		$select=' selected';
	}
	$userclass.="<option value='".$ucr[classid]."'".$select.">".$ucr[classname]."</option>";
}
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�H��</title>
<script>
function selectalls(doselect,formvar)
{  
	 var bool=doselect==1?true:false;
	 var selectform=document.getElementById(formvar);
	 for(var i=0;i<selectform.length;i++)
	 { 
		  selectform.all[i].selected=bool;
	 } 
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListSp.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="spid" type="hidden" id="spid" value="<?=$spid?>"> 
        <input name="fcid" type="hidden" id="fcid" value="<?=$fcid?>"> <input name="fclassid" type="hidden" id="fclassid" value="<?=$fclassid?>"> 
        <input name="fsptype" type="hidden" id="fsptype" value="<?=$fsptype?>">
		<input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�H�������G</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="sptype" id="sptype"<?=$disabled?>>
          <option value="1"<?=$r[sptype]==1?' selected':''?>>�R�A�H���H��</option>
          <option value="2"<?=$r[sptype]==2?' selected':''?>>�ʺA�H���H��</option>
          <option value="3"<?=$r[sptype]==3?' selected':''?>>�N�X�H��</option>
        </select> 
        <?=$noteditword?>
        <?=$sptypehidden?>
      </td>
    </tr>
    <tr> 
      <td width="18%" height="25" bgcolor="#FFFFFF">�H���W��:</td>
      <td width="82%" height="25" bgcolor="#FFFFFF"> <input name="spname" type="text" id="spname" value="<?=$r[spname]?>" size="42"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�H���ܶq�W�G</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="varname" type="text" id="varname" value="<?=$r[varname]?>" size="42"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ݤ����G</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="cid" id="cid">
          <option value="0">�����ݩ�������O</option>
          <?=$scstr?>
        </select> <input type="button" name="Submit6222322" value="�޲z����" onclick="window.open('ListSpClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ݫH����ءG</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="classid" id="classid">
          <option value="0">���ݩ�Ҧ����</option>
          <?=$options?>
        </select> <input type="button" name="Submit622232" value="�޲z���" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');"> 
        <font color="#666666">(��ܤ���ءA�N���Ω�l���)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�̤j�H���ƶq�G</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="maxnum" type="text" id="spname3" value="<?=$r[maxnum]?>" size="42"> 
        <font color="#666666">(0������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ϥμ��ҼҪO�G</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="tempid" id="tempid">
          <?=$bqtemp?>
        </select> <input type="button" name="Submit6222323" value="�޲z���ҼҪO" onclick="window.open('../template/ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O�_�ͦ��H�����G</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="refile" value="0"<?=$r[refile]==0?' checked':''?>>
        ���ͦ� 
        <input type="radio" name="refile" value="1"<?=$r[refile]==1?' checked':''?>>
        �ͦ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ͦ��H�����W�G</td>
      <td height="25" bgcolor="#FFFFFF">/ 
        <input name="spfile" type="text" id="spfile" value="<?=$r[spfile]?>" size="42">
        <input name="oldspfile" type="hidden" id="oldspfile" value="<?=$r[spfile]?>"> </td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�ͦ��H����󤺮e�]�m�G</td>
      <td height="25" bgcolor="#FFFFFF">��ܫH���ƶq�G
        <input name="spfileline" type="text" id="spfileline" value="<?=$r[spfileline]?>" size="6">
        �A���D�I���r�ơG
        <input name="spfilesub" type="text" id="spfilesub" value="<?=$r[spfilesub]?>" size="6"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�H���ĪG�ϡG</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="sppic" type="text" id="sppic" value="<?=$r[sppic]?>" size="42"> 
        <a onclick="window.open('../ecmseditor/FileMain.php?<?=$ecms_hashur['ehref']?>&modtype=7&type=1&classid=&doing=2&field=sppic&filepass=<?=$filepass?>&sinfo=1','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" alt="���/�W�ǹϤ�" width="22" height="22" border="0" align="absbottom"></a></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�H���y�z�G</td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="spsay" cols="60" rows="5" id="varname3"><?=ehtmlspecialchars($r[spsay])?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�i�V�v�����e�G</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="cladd" value="0"<?=$r[cladd]==0?' checked':''?>>
        �O 
        <input type="radio" name="cladd" value="1"<?=$r[cladd]==1?' checked':''?>>
        �_ <font color="#666666">(���b�v���]�m�d�򤺪��Τ�]����e�H��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�O�_�}�ҡG</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="isclose" value="0"<?=$r[isclose]==0?' checked':''?>>
        �O 
        <input type="radio" name="isclose" value="1"<?=$r[isclose]==1?' checked':''?>>
        �_</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�v���]�m</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Τ�աG</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="groupid[]" size="5" multiple id="groupidselect" style="width:180">
          <?=$group?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'groupidselect')">��������</a>]</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����G</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="userclass[]" size="5" multiple id="userclassselect" style="width:180">
          <?=$userclass?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'userclassselect')">��������</a>]</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Τ�G</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" value="<?=$username?>" size="42"> 
        <font color="#666666"> 
        <input type="button" name="Submit3" value="���" onclick="window.open('../ChangeUser.php?field=username&form=form1<?=$ecms_hashur['ehref']?>','','width=300,height=520,scrollbars=yes');">
        (�h�ӥΤ�Ρu,�v�r���j�})</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="����"> 
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
