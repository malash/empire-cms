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
CheckLevel($logininid,$loginin,$classid,"repnewstext");
$url="<a href=RepNewstext.php".$ecms_hashur['whehref'].">��q�����H�����e</a>";
//���
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//�ƾڪ�
$tbname=RepPostVar($_GET['tbname']);
$table='';
$first=1;
$htb=0;
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	if($first==1)
	{
		$firsttable=$tr[tbname];
		$firsttid=$tr[tid];
		$first=0;
	}
	else
	{$first=0;}
	if($tbname==$tr[tbname])
	{
		$htb=1;
		$select=" selected";
		$thistid=$tr[tid];
	}
	else
	{
		$select="";
	}
	$table.="<option value='".$tr[tbname]."'".$select.">".$tr[tname]."</option>";
}
if(!$table)
{printerror("NotRepNewstextTb","history.go(-1)");}
$table="<select name='tbname' onchange=self.location='RepNewstext.php?".$ecms_hashur['ehref']."&tbname='+this.options[this.selectedIndex].value>".$table."</select>";
//�r�q
if(empty($tbname))
{
	$showtable=$firsttable;
	$showtid=$firsttid;
}
else
{
	if($htb==0)
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$showtable=$tbname;
	$showtid=$thistid;
}
$field='';
$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}ecms_".$showtable);
$noshowfield=",id,onclick,newspath,keyboard,keyid,userid,username,istop,truetime,ismember,dokey,isgood,titlecolor,titlefont,isurl,titleurl,filename,plnum,firsttitle,totaldown,";
while($r=$empire->fetch($s))
{
	//����ܦr�q
	if(strstr($noshowfield,",".$r[Field].","))
	{
		//continue;
	}
	$field.="<option value='".$r[Field]."'>".$r[Field]."</option>";
}
$datafsql=$empire->query("SHOW FIELDS FROM {$dbtbpre}ecms_".$showtable."_data_1");
while($dfr=$empire->fetch($datafsql))
{
	if($dfr[Field]=='classid'||$dfr[Field]=='id')
	{
		continue;
	}
	$field.="<option value='".$dfr[Field]."'>".$dfr[Field]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q�����H�����e</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form action="../ecmscom.php" method="post" name="form1" target="_blank" onsubmit="return confirm('�T�{�n�����H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">��q�����H�����e 
        <input name="enews" type="hidden" id="enews" value="DoRepNewstext"> <input name="tid" type="hidden" id="tid" value="<?=$showtid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">��ܴ�����(*)�G</td>
      <td height="25"> 
        <?=$table?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="15%" height="25">�ާ@��ءG</td>
      <td width="85%" height="25"><select name="classid" id="classid">
          <option value=0>�Ҧ����</option>
          <?=$class?>
        </select> <font color="#666666">(�p��ܤ���ءA�N���Ω�Ҧ��l���)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����r�q(*)�G</td>
      <td height="25"><select name="field" size="12" id="field" style="width:180">
          <?=$field?>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="26">�������e�G</td>
      <td height="26"> <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td> <div align="center">��r��</div></td>
            <td bgcolor="#FFFFFF"> <div align="left"> 
                <textarea name="oldword" cols="100" rows="5" id="textarea"></textarea>
                (*)</div></td>
          </tr>
          <tr> 
            <td> <div align="center">�s�r�� </div></td>
            <td bgcolor="#FFFFFF"> <div align="left"> 
                <textarea name="newword" cols="100" rows="5" id="newword2"></textarea>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="26">��s�覡�G</td>
      <td height="26"><input name="dotype" type="radio" value="0" checked>
        ����
        <input type="radio" name="dotype" value="1">
        �л\ <font color="#666666">(�л\�覡���N�r�q�������e��s���s�r�Ť��e�A�л\�覡��r�ťi�H���]�m)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2">�ﶵ�]�m�G</td>
      <td height="26"><p>�ۦP��s 
          <input name="over" type="checkbox" id="over" value="1">
          <font color="#666666">(�ۦP��s:��u�r�q��=��r�šv������U�~�������л\)</font></p>
        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="26">���h���� 
        <input name="dozz" type="checkbox" id="dozz" value="1">
        <font color="#666666"> (���h����:��r�ťi�H�O�Υ��h��ܡA�Ρu*�v��ܥ��N�r��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2">�Ƶ��G�����ɳ̦n�ƥ��@�U�ƾڡD</td>
    </tr>
  </table>
</form>
</body>
</html>
