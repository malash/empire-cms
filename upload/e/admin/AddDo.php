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
CheckLevel($logininid,$loginin,$classid,"do");
$enews=ehtmlspecialchars($_GET['enews']);
$url="<a href=ListDo.php".$ecms_hashur['whehref'].">�޲z��s����</a>&nbsp;>&nbsp;�W�[�w�ɨ�s����";
$cdoing=(int)$_GET['cdoing'];
$cname='';
$class='';
$r[dotime]=30;
$r[isopen]=1;
//�ק�
if($enews=="EditDo")
{
	$doid=(int)$_GET['doid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsdo where doid='$doid'");
	$url="<a href=ListDo.php".$ecms_hashur['whehref'].">�޲z��s����</a>&nbsp;>&nbsp;�ק�w�ɨ�s����";
	if($cdoing&&$cdoing<>$r['doing'])
	{
		$r[classid]='';
	}
}
//���
if($r['doing']==1||$cdoing==1)
{
	$cname='���';
	$fcfile="../data/fc/ListEnews.php";
	$fcjsfile="../data/fc/cmsclass.js";
	if(file_exists($fcjsfile)&&file_exists($fcfile))
	{
		$class=GetFcfiletext($fcjsfile);
		$acr=explode(",",$r[classid]);
		$count=count($acr);
		for($i=1;$i<$count-1;$i++)
		{
			$class=str_replace("<option value='$acr[$i]'","<option value='$acr[$i]' selected",$class);
		}
	}
	else
	{
		$class=ShowClass_AddClass(str_replace(',','|',$r[classid]),"n",0,"|-",0,3);
	}
}
elseif($r['doing']==2||$cdoing==2)//�M�D
{
	$cname='�M�D';
	$ztsql=$empire->query("select ztid,ztname from {$dbtbpre}enewszt order by ztid");
	while($ztr=$empire->fetch($ztsql))
	{
		$selected=strstr($r[classid],','.$ztr[ztid].',')?' selected':'';
		$class.="<option value='$ztr[ztid]'".$selected.">$ztr[ztname]</option>";
	}
}
elseif($r['doing']==3||$cdoing==3)//�۩w�q�C��
{
	$cname='�C��';
	$ulsql=$empire->query("select listid,listname from {$dbtbpre}enewsuserlist order by listid");
	while($ulr=$empire->fetch($ulsql))
	{
		$selected=strstr($r[classid],','.$ulr[listid].',')?' selected':'';
		$class.="<option value='$ulr[listid]'".$selected.">$ulr[listname]</option>";
	}
}
elseif($r['doing']==4||$cdoing==4)//�۩w�q����
{
	$cname='����';
	$upsql=$empire->query("select id,title from {$dbtbpre}enewspage order by id");
	while($upr=$empire->fetch($upsql))
	{
		$selected=strstr($r[classid],','.$upr[id].',')?' selected':'';
		$class.="<option value='$upr[id]'".$selected.">$upr[title]</option>";
	}
}
elseif($r['doing']==5||$cdoing==5)//�۩w�qJS
{
	$cname='JS';
	$jssql=$empire->query("select jsid,jsname from {$dbtbpre}enewsuserjs order by jsid");
	while($jsr=$empire->fetch($jssql))
	{
		$selected=strstr($r[classid],','.$jsr[jsid].',')?' selected':'';
		$class.="<option value='$jsr[jsid]'".$selected.">$jsr[jsname]</option>";
	}
}
elseif($r['doing']==6||$cdoing==6)//���D��������
{
	$cname='���D����';
	$infotypesql=$empire->query("select typeid,tname from {$dbtbpre}enewsinfotype order by typeid");
	while($infotyper=$empire->fetch($infotypesql))
	{
		$selected=strstr($r[classid],','.$infotyper[typeid].',')?' selected':'';
		$class.="<option value='$infotyper[typeid]'".$selected.">$infotyper[tname]</option>";
	}
}
if($cdoing)
{
	$r['doing']=$cdoing;
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�w�ɨ�s����</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="ListDo.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�W�[�w�ɨ�s���� 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="doid" type="hidden" value="<?=$doid?>"></td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">���������G</td>
      <td height="25"> <select name="doing" size="8" style="width:270" onchange="self.location.href='AddDo.php?<?=$ecms_hashur['ehref']?>&enews=<?=$enews?>&doid=<?=$doid?>&cdoing='+this.options[this.selectedIndex].value;">
          <option value="0"<?=$r[doing]==0?' selected':''?>>��s����</option>
          <option value="1"<?=$r[doing]==1?' selected':''?>>��s��ح���</option>
		  <option value="6"<?=$r[doing]==6?' selected':''?>>��s���D��������</option>
		  <option value="2"<?=$r[doing]==2?' selected':''?>>��s�M�D����</option>
		  <option value="3"<?=$r[doing]==3?' selected':''?>>��s�۩w�q�C��</option>
		  <option value="4"<?=$r[doing]==4?' selected':''?>>��s�۩w�q����</option>
		  <option value="5"<?=$r[doing]==5?' selected':''?>>��s�۩w�qJS</option>
        </select>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="22%" height="25">���ȦW�G</td>
      <td width="78%" height="25"><input name="doname" type="text" value="<?=$r[doname]?>" size="38">
        <font color="#666666">(��p�����w�ɨ�s)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���Ȫ��A�G</td>
      <td height="25"><input type="radio" name="isopen" value="1"<?=$r[isopen]==1?' checked':''?>>
        �}��
        <input type="radio" name="isopen" value="0"<?=$r[isopen]==0?' checked':''?>>
        ����</td>
    </tr>
	<tr bgcolor="#FFFFFF"> 
      <td height="25">����ɶ����j�G</td>
      <td height="25"><input name="dotime" type="text" value="<?=$r[dotime]?>" size="38">
        ����<font color="#666666">(�p��5�����t�αN����5����)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><p>���<?=$cname?>�G<br>
          <br>
          <br>
          <font color="#666666">(������s���楢�ġF<br>
          �i�P�ɿ�ܦh�ӡF<br>
          �����G��ܶV�h���θ귽�V�j.</font><font color="#666666">)</font></p>
        </td>
      <td height="25"><select name="classid[]" size="16" multiple style="width:270" id="classidselect">
          <?=$class?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'classidselect')">��������</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
