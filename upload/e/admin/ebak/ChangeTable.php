<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"dbdata");
$bakpath=$public_r['bakdbpath'];
$mydbname=RepPostVar($_GET['mydbname']);
if(empty($mydbname))
{
	printerror("NotChangeBakTable","history.go(-1)");
}
//��ܼƾڮw
$udb=$empire->usequery("use `".$mydbname."`");
//�d��
$and="";
$keyboard=RepPostVar($_GET['keyboard']);
$sear=RepPostStr($_GET['sear'],1);
if(empty($sear))
{
	$keyboard=$dbtbpre;
}
if($keyboard)
{
	$and=" LIKE '%$keyboard%'";
}
$sql=$empire->query("SHOW TABLE STATUS".$and);
//�s��ؿ�
$mypath=$mydbname."_".date("YmdHis");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��ܼƾڪ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if(e.name=='bakstru'||e.name=='bakstrufour'||e.name=='beover'||e.name=='autoauf'||e.name=='baktype'||e.name=='bakdatatype')
		{
		continue;
	    }
	if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
function reverseCheckAll(form)
{
  for (var i=0;i<form.elements.length;i++)
  {
    var e = form.elements[i];
    if(e.name=='bakstru'||e.name=='bakstrufour'||e.name=='beover'||e.name=='autoauf'||e.name=='baktype'||e.name=='bakdatatype')
	{
		continue;
	}
	if (e.name != 'chkall')
	{
	   if(e.checked==true)
	   {
       		e.checked = false;
	   }
	   else
	   {
	  		e.checked = true;
	   }
	}
  }
}
function SelectCheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if(e.name=='bakstru'||e.name=='bakstrufour'||e.name=='beover'||e.name=='autoauf'||e.name=='baktype'||e.name=='bakdatatype')
		{
		continue;
	    }
	if (e.name != 'chkall')
	  	e.checked = true;
    }
  }
function check()
{
	var ok;
	ok=confirm("�T�{�n���榹�ާ@?");
	return ok;
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
<form name="searchtb" method="GET" action="ChangeTable.php">
<?=$ecms_hashur['eform']?>
<input name="sear" type="hidden" id="sear" value="1">
<input name="mydbname" type="hidden" value="<?=$mydbname?>">
  <tr> 
    <td width="58%">��m�G�ƥ��ƾ� -&gt; <a href="ChangeDb.php<?=$ecms_hashur['whehref']?>">��ܼƾڮw</a> -&gt; <a href="ChangeTable.php?mydbname=<?=$mydbname?><?=$ecms_hashur['ehref']?>">��ܳƥ���</a>&nbsp;(<?=$mydbname?>)</td>
      <td width="42%"><div align="center">�d��: 
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <input type="submit" name="Submit3" value="��ܼƾڪ�">
        </div></td>
  </tr>
  <tr> 
    <td height="25" colspan="2"><div align="center">
          �ƥ��B�J�G��ܼƾڮw -&gt; <font color="#FF0000">��ܭn�ƥ�����</font> -&gt; �}�l�ƥ� -&gt; 
          ����</div></td>
  </tr>
</form>
</table>
<form action="phome.php" method="post" name="ebakchangetb" target="_blank" onsubmit="return check();">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25">�ƥ��ѼƳ]�m�G 
        <input name="phome" type="hidden" id="phome2" value="DoEbak"> 
        <input name="mydbname" type="hidden" id="mydbname" value="<?=$mydbname?>">
        </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> 
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="23%"><input type="radio" name="baktype" value="0"<?=$dbaktype==0?' checked':''?>> 
              <strong>�����j�p�ƥ�</strong> </td>
            <td width="77%" height="23"> �C�ճƥ��j�p�G 
              <input name="filesize" type="text" id="filesize" value="300" size="6">
              KB <font color="#666666">(1 MB = 1024 KB)</font></td>
          </tr>
          <tr> 
            <td><input type="radio" name="baktype" value="1"<?=$dbaktype==1?' checked':''?>> 
              <strong>���O���Ƴƥ�</strong></td>
            <td height="23">�C�ճƥ� 
              <input name="bakline" type="text" id="bakline" value="500" size="6">
              ���O���A 
              <input name="autoauf" type="checkbox" id="autoauf" value="1" checked>
              �۰��ѧO�ۼW�r�q<font color="#666666">(���覡�Ĳv��)</font></td>
          </tr>
          <tr> 
            <td>�ƥ��ƾڮw���c</td>
            <td height="23"><input name="bakstru" type="checkbox" id="bakstru" value="1" checked> 
              <font color="#666666">(�S�S���p�A�п��)</font></td>
          </tr>
          <tr> 
            <td valign="top">�ƾڽs�X</td>
            <td height="23"> <select name="dbchar" id="dbchar">
                <option value="auto"<?=$ddbchar=='auto'?' selected':''?>>�۰��ѧO�s�X</option>
                <option value=""<?=$ecms_config['db']['setchar']==''?' selected':''?>>���]�m</option>
                <option value="gbk"<?=$ecms_config['db']['setchar']=='gbk'?' selected':''?>>gbk</option>
                <option value="utf8"<?=$ecms_config['db']['setchar']=='utf8'?' selected':''?>>utf8</option>
                <option value="gb2312"<?=$ecms_config['db']['setchar']=='gb2312'?' selected':''?>>gb2312</option>
                <option value="big5"<?=$ecms_config['db']['setchar']=='big5'?' selected':''?>>big5</option>
                <option value="latin1"<?=$ecms_config['db']['setchar']=='latin1'?' selected':''?>>latin1</option>
              </select> <font color="#666666">(�qmysql4.0�ɤJmysql4.1�H�W�����ݭn��ܩT�w�s�X�A�����۰�)</font></td>
          </tr>
          <tr>
            <td valign="top">�ƾڦs��榡</td>
            <td height="23"><input name="bakdatatype" type="radio" value="0" checked>
              ���` 
              <input type="radio" name="bakdatatype" value="1">
              �Q���i��覡<font color="#666666">(�Q���i��ƥ����|���Χ�h���Ŷ�)</font></td>
          </tr>
          <tr> 
            <td>�s��ؿ�</td>
            <td height="23">admin/ebak/ 
              <?=$bakpath?>
              / 
              <input name="mypath" type="text" id="mypath" value="<?=$mypath?>"> 
              <input type="button" name="Submit2" value="��ܥؿ�" onclick="javascript:window.open('ChangePath.php?change=1&toform=ebakchangetb<?=$ecms_hashur['ehref']?>','','width=600,height=500,scrollbars=yes');"> 
              <font color="#666666">(�ؿ����s�b�A�t�η|�۰ʫإ�)</font></td>
          </tr>
          <tr> 
            <td valign="top">�ƥ��ﶵ</td>
            <td height="23">�ɤJ�覡: 
              <select name="insertf" id="insertf">
                <option value="replace">REPLACE</option>
                <option value="insert">INSERT</option>
              </select>
              , 
              <input name="beover" type="checkbox" id="beover" value="1"<?=$dbeover==1?' checked':''?>>
              ���㴡�J, 
              <input name="bakstrufour" type="checkbox" id="bakstrufour" value="1"> 
              <a title="�ݭn�ഫ�ƾڪ�s�X�ɿ��">�নMYSQL4.0�榡</a>, �C�ճƥ����j�G 
              <input name="waitbaktime" type="text" id="waitbaktime" value="0" size="2">
              ��</td>
          </tr>
          <tr> 
            <td valign="top">�ƥ�����<br> <font color="#666666">(�t�η|�ͦ��@��readme.txt)</font></td>
            <td height="23"><textarea name="readme" cols="80" rows="8" id="readme"></textarea></td>
          </tr>
          <tr> 
            <td valign="top">�h���ۼW�Ȫ��r�q�C��G<br> <font color="#666666">(�榡�G<strong>��W.�r�q�W</strong><br>
              �h�ӽХ�&quot;,&quot;��})</font></td>
            <td height="23"><textarea name="autofield" cols="80" rows="5" id="autofield"></textarea></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr class="header"> 
      <td height="25">��ܭn�ƥ�����G( <a href="#ebak" onclick="SelectCheckAll(document.ebakchangetb)"><u>����</u></a> 
        | <a href="#ebak" onclick="reverseCheckAll(document.ebakchangetb);"><u>�Ͽ�</u></a> 
        )</td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr bgcolor="#DBEAF5"> 
            <td width="5%" height="23"> <div align="center">���</div></td>
            <td width="27%" height="23" bgcolor="#DBEAF5"> <div align="center">��W(�I���d�ݦr�q)</div></td>
            <td width="13%" height="23" bgcolor="#DBEAF5"> <div align="center">����</div></td>
            <td width="15%" bgcolor="#DBEAF5"><div align="center">�s�X</div></td>
            <td width="15%" height="23"> <div align="center">�O����</div></td>
            <td width="14%" height="23"> <div align="center">�j�p</div></td>
            <td width="11%" height="23"> <div align="center">�H��</div></td>
          </tr>
          <?php
		  $totaldatasize=0;//�`�ƾڤj�p
		  $tablenum=0;//�`���
		  $datasize=0;//�ƾڤj�p
		  $rownum=0;//�`�O����
		  while($r=$empire->fetch($sql))
		  {
		  $rownum+=$r[Rows];
		  $tablenum++;
		  $datasize=$r[Data_length]+$r[Index_length];
		  $totaldatasize+=$r[Data_length]+$r[Index_length]+$r[Data_free];
		  $collation=$r[Collation]?$r[Collation]:'---';
		  ?>
          <tr id=tb<?=$r[Name]?>> 
            <td height="23"> <div align="center"> 
                <input name="tablename[]" type="checkbox" id="tablename[]" value="<?=$r[Name]?>" onclick="if(this.checked){tb<?=$r[Name]?>.style.backgroundColor='#F1F7FC';}else{tb<?=$r[Name]?>.style.backgroundColor='#ffffff';}" checked>
              </div></td>
            <td height="23"> <a href="#ebak" onclick="window.open('ListField.php?mydbname=<?=$mydbname?>&mytbname=<?=$r[Name]?><?=$ecms_hashur['ehref']?>','','width=660,height=500,scrollbars=yes');" title="�I���d�ݪ�r�q�C��"> 
              <?=$r[Name]?>
              </a></td>
            <td height="23"> <div align="center">
                <?=$r[Type]?$r[Type]:$r[Engine]?>
              </div></td>
            <td><div align="center">
				<?=$collation?>
			</div></td>
            <td height="23"> <div align="right">
                <?=$r[Rows]?>
              </div></td>
            <td height="23"> <div align="right">
                <?=Ebak_ChangeSize($datasize)?>
              </div></td>
            <td height="23"> <div align="right">
                <?=Ebak_ChangeSize($r[Data_free])?>
              </div></td>
          </tr>
          <?php
		  }
		  db_close();
		  $empire=null;
		  ?>
          <tr bgcolor="#DBEAF5"> 
            <td height="23"> <div align="center">
                <input type=checkbox name=chkall value=on onclick=CheckAll(this.form) checked>
              </div></td>
            <td height="23"> <div align="center"> 
                <?=$tablenum?>
              </div></td>
            <td height="23"> <div align="center">---</div></td>
            <td><div align="center">---</div></td>
            <td height="23"> <div align="center">
                <?=$rownum?>
              </div></td>
            <td height="23" colspan="2"> <div align="center">
                <?=Ebak_ChangeSize($totaldatasize)?>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr class="header"> 
      <td height="25">
<div align="center">
          <input type="submit" name="Submit" value="�}�l�ƥ�" onclick="document.ebakchangetb.phome.value='DoEbak';">
          &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit2" value="�״_�ƾڪ�" onclick="document.ebakchangetb.phome.value='DoRep';">
          &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="�u�Ƽƾڪ�" onclick="document.ebakchangetb.phome.value='DoOpi';">
        &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="�R���ƾڪ�" onclick="document.ebakchangetb.phome.value='DoDrop';">
		&nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="�M�żƾڪ�" onclick="document.ebakchangetb.phome.value='EmptyTable';">
		</div></td>
    </tr>
  </table>
</form>
</body>
</html>
