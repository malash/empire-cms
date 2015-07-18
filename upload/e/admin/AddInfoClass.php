<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../data/dbcache/class.php");
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
CheckLevel($logininid,$loginin,$classid,"cj");

//��ܵL���ŵ��I[�W�[���I��]
function ShowClass_AddInfoClass($obclassid,$bclassid,$exp,$enews=0){
	global $empire,$dbtbpre;
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="|-";
    }
	else
	{$exp="&nbsp;&nbsp;".$exp;}
	$sql=$empire->query("select classid,classname,bclassid from {$dbtbpre}enewsinfoclass where bclassid='$bclassid' order by classid");
	$returnstr="";
	while($r=$empire->fetch($sql))
	{
		if($r[classid]==$obclassid)
		{$select=" selected";}
		else
		{$select="";}
		$returnstr.="<option value=".$r[classid].$select.">".$exp.$r[classname]."</option>";
		$returnstr.=ShowClass_AddInfoClass($obclassid,$r[classid],$exp,$enews);
	}
	return $returnstr;
}

$enews=ehtmlspecialchars($_GET['enews']);
$r[newsclassid]=(int)$_GET['newsclassid'];
/*
if(empty($r[newsclassid])&&($enews=="AddInfoClass"||empty($enews)))
{
echo"<script>self.location.href='AddInfoC.php".$ecms_hashur['whehref']."';</script>";
exit();
}
*/
if($_GET['from'])
{
	$listclasslink="ListPageInfoClass.php";
}
else
{
	$listclasslink="ListInfoClass.php";
}

$docopy=ehtmlspecialchars($_GET['docopy']);
$url="�Ķ�&nbsp;>&nbsp;<a href=".$listclasslink.$ecms_hashur['whehref'].">�޲z�`�I</a>&nbsp;>&nbsp;�W�[�`�I";
//��ϤƼƾ�
$r[startday]=date("Y-m-d");
$r[endday]="2099-12-31";
$r[num]=0;
$r[renum]=2;
$r[relistnum]=1;
$r[insertnum]=10;
$r[keynum]=0;
$r[keeptime]=0;
$r[smalltextlen]=200;
$r[titlelen]=0;
$r['getfirstspicw']=$public_r['spicwidth'];
$r['getfirstspich']=$public_r['spicheight'];
$pagetype0="";
$pagetype1=" checked";
//�ƻs���I
if($docopy)
{
	$classid=(int)$_GET['classid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsinfoclass where classid='$classid'");
	//�Ķ��`�I
	if($r[newsclassid])
	{
		$ra=$empire->fetch1("select * from {$dbtbpre}ecms_infoclass_".$r[tbname]." where classid='$classid'");
		$r=TogTwoArray($r,$ra);
	}
	if(empty($r[pagetype]))
	{
		$pagetype0=" checked";
		$pagetype1="";
	}
	else
	{
		$pagetype0="";
		$pagetype1=" checked";
	}
	$url="�Ķ�&nbsp;>&nbsp;<a href=".$listclasslink.$ecms_hashur['whehref'].">�޲z�`�I</a>&nbsp;>&nbsp;�ƻs�`�I�G".$r[classname];
	$r[classname].="(1)";
}
//�ק�`�I
if($enews=="EditInfoClass")
{
	$classid=(int)$_GET['classid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsinfoclass where classid='$classid'");
	//�Ķ��`�I
	if($r[newsclassid])
	{
		$ra=$empire->fetch1("select * from {$dbtbpre}ecms_infoclass_".$r[tbname]." where classid='$classid'");
		$r=TogTwoArray($r,$ra);
	}
	if(empty($r[pagetype]))
	{
		$pagetype0=" checked";
		$pagetype1="";
	}
	else
	{
		$pagetype0="";
		$pagetype1=" checked";
	}
	$url="�Ķ�&nbsp;>&nbsp;<a href=".$listclasslink.$ecms_hashur['whehref'].">�޲z�`�I</a>&nbsp;>&nbsp;�ק�`�I";
}
//�ҫ�
$modid=$class_r[$r[newsclassid]][modid];
$modr=$empire->fetch1("select enter from {$dbtbpre}enewsmod where mid='$modid'");
//���
$options=ShowClass_AddClass("",$r[newsclassid],0,"|-",$class_r[$r[newsclassid]][modid],4);
if($r[retitlewriter])
{
	$retitlewriter=" checked";
}
if($r[copyimg])
{
	$copyimg=" checked";
}
if($r[copyflash])
{$copyflash=" checked";}
//�`�I
$infoclass=ShowClass_AddInfoClass($r[bclassid],0,"|-",0);

//�Ķ������
$cjfile="../data/html/cj".$class_r[$r[newsclassid]][modid].".php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�W�[�`�I</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function AddRepAd(obj,val){
	var dh='';
	if(obj==1)
	{
		if(document.form1.pagerepad.value!='')
		{
			dh=',';
		}
		document.form1.pagerepad.value+=dh+val;
	}
	else
	{
		if(document.form1.repad.value!='')
		{
			dh=',';
		}
		document.form1.repad.value+=dh+val;
	}
}
</script>
</head>

<body>
<script src="ecmseditor/fieldfile/setday.js"></script>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListInfoClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="30%">�򥻫H��</td>
      <td width="70%"><input type=hidden name=from value="<?=ehtmlspecialchars($_GET['from'])?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="add[classid]" type="hidden" id="add[classid]" value="<?=$classid?>"> 
        <input name="add[oldbclassid]" type="hidden" id="add[oldbclassid]" value="<?=$r[bclassid]?>"> 
        <input name="add[oldnewsclassid]" type="hidden" id="add[oldnewsclassid]" value="<?=$r[newsclassid]?>"></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�`�I�W�١G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[classname]" type="text" id="add[classname]" value="<?=$r[classname]?>" size=50> 
        <font color="#666666">(�p�G��|�A�T�ֵ�)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">���`�I�G</td>
      <td height="23" bgcolor="#FFFFFF"> <select name="bclassid" id="bclassid">
          <option value="0">�s�ؤ��`�I</option>
          <?=$infoclass?>
        </select></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">�Ķ������a�}�G<br>
        <font color="#666666">(�@�欰�@�ӦC��)<br>
        <br>
        <br>
        <input name="add[infourlispage]" type="checkbox" id="add[infourlispage]" value="1"<?=$r[infourlispage]?' checked':''?>>
        </font>�Ķ��������������e��</td>
      <td height="23" bgcolor="#FFFFFF"> <textarea name="add[infourl]" cols="72" rows="10" id="add[infourl]"><?=stripSlashes($r[infourl])?></textarea></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">�Ķ������a�}�覡�G�G<br> <font color="#666666">(���覡�A�t�Φ۰ʥͦ������a�})</font></td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td>�a�}�G 
              <input name="add[infourl1]" type="text" id="add[infourl1]2" size="42">
              (�����ܶq�� 
              <input name="textfield" type="text" value="[page]" size="8">
              ����)</td>
          </tr>
          <tr> 
            <td>���X�q 
              <input name="add[urlstart]" type="text" id="add[urlstart]4" value="1" size="6">
              �� 
              <input name="add[urlend]" type="text" id="add[urlend]3" value="1" size="6">
              ����,���j���� 
              <input name="add[urlbs]" type="text" id="add[urlbs]" value="1" size="6"> 
              <input name="add[urldx]" type="checkbox" id="add[urldx]" value="1">
              �˧� 
              <input name="add[urlbl]" type="checkbox" id="add[urlbl]" value="1">
              �ɹs</td>
          </tr>
          <tr> 
            <td><font color="#666666">(�p:http://www.phome.net/index.php?page=[page])</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">���e���a�}�e��G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[httpurl]" type="text" id="add[httpurl]" value="<?=$r[httpurl]?>" size="50"> 
        <br> <font color="#666666">(�p�a�}�e���S��W���ܡA�t�η|�[�W���e��)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�Ϥ�/FLASH�a�}�e��(���e)�G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[imgurl]" type="text" id="add[imgurl]" value="<?=$r[imgurl]?>" size="50"> 
        <font color="#666666">(�Ϥ��a�}���۹�a�}�ɨϥ�)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�J�w��ءG</td>
      <td height="23" bgcolor="#FFFFFF"> <select name="newsclassid" id="newsclassid">
          <option value="0">������</option>
          <?=$options?>
        </select> <input type="button" name="Submit622232" value="�޲z���" onclick="window.open('ListClass.php<?=$ecms_hashur['whehref']?>');"> 
        <font color="#666666">(�p���`�I���O�Ķ��`�I�A�Ф���)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�}�l�ɶ��G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[startday]" type="text" id="add[startday]" value="<?=$r[startday]?>" size="12" onclick="setday(this)"> 
        <font color="#666666">(�榡�G2007-11-01)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�����ɶ��G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[endday]" type="text" id="add[endday]" value="<?=$r[endday]?>" size="12" onclick="setday(this)"> 
        <font color="#666666">(�榡�G2007-11-01)</font></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">�Ƶ��G</td>
      <td height="23" bgcolor="#FFFFFF"> <textarea name="add[bz]" cols="72" rows="8" id="add[bz]"><?=ehtmlspecialchars(stripSlashes($r[bz]))?></textarea></td>
    </tr>
    <tr class="header"> 
      <td height="23" colspan="2">�ﶵ</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�q�{��������r�G</td>
      <td height="23" bgcolor="#FFFFFF">�I�����D�e 
        <input name="add[keynum]" type="text" id="add[keynum]" value="<?=$r[keynum]?>" size="6">
        �Ӧr</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF"> <p>�Ķ��O���ơG</p></td>
      <td height="23" bgcolor="#FFFFFF">�Ķ��e 
        <input name="add[num]" type="text" id="add[num]" value="<?=$r[num]?>" size="6">
        ���O��<font color="#666666">(&quot;0&quot;�������A�t�η|�q�Y�Ĩ쭶����)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">���{�O�s�Ϥ��쥻�a(���e)�G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[copyimg]" type="checkbox" id="add[copyimg]" value="1"<?=$copyimg?>>
        (�J�w�ɤ~�|�O�s, 
        <input name="add[mark]" type="checkbox" id="add[mark]" value="1"<?=$r[mark]==1?' checked':''?>> 
        <a href="SetEnews.php<?=$ecms_hashur['whehref']?>" target="_blank">�[���L</a>) </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">���{�O�sFLASH�쥻�a(���e)�G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[copyflash]" type="checkbox" id="add[copyflash]" value="1"<?=$copyflash?>>
        (�J�w�ɤ~�|�O�s) </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">���D�Ϥ��]�m�G</td>
      <td height="23" bgcolor="#FFFFFF">���� 
        <input name="add[getfirstpic]" type="text" id="add[getfirstpic]" value="<?=$r[getfirstpic]?>" size="3">
        �i�Ϥ������D�Ϥ�( 
        <input name="add[getfirstspic]" type="checkbox" id="add[getfirstspic]" value="1"<?=$r[getfirstspic]==1?' checked':''?>>
        �ͦ��Y����:�e�� 
        <input name="add[getfirstspicw]" type="text" id="add[getfirstspicw]" value="<?=$r[getfirstspicw]?>" size="3">
        �Ѱ��� 
        <input name="add[getfirstspich]" type="text" id="add[getfirstspich]" value="<?=$r[getfirstspich]?>" size="3">
        )</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�C�զC��Ķ��ӼơG</td>
      <td height="23" bgcolor="#FFFFFF">�C�ձĶ� 
        <input name="add[relistnum]" type="text" id="add[relistnum]" value="<?=$r[relistnum]?>" size="6">
        �ӦC��<font color="#666666">(����Ķ��W��) </font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�C�իH���Ķ��ӼơG</td>
      <td height="23" bgcolor="#FFFFFF">�C�ձĶ� 
        <input name="add[renum]" type="text" id="add[renum]" value="<?=$r[renum]?>" size="6">
        �ӫH����<font color="#666666">(����Ķ��W��)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�C�դJ�w�ơG</td>
      <td height="23" bgcolor="#FFFFFF">�C�դJ 
        <input name="add[insertnum]" type="text" id="add[insertnum]" value="<?=$r[insertnum]?>" size="6">
        ���O��<font color="#666666">(����J�w�W��) </font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�C�ձĶ��ɶ����j</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[keeptime]" type="text" id="add[keeptime]" value="<?=$r[keeptime]?>" size="6">
        �� <font color="#666666">(0���s��Ķ�)</font></td>
    </tr>
    <tr class="header"> 
      <td height="23" colspan="2">���[�ﶵ</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�����s�X�ഫ</td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="1" cellspacing="1">
          <?php
	  $trueenpagecode="<input type='radio' name='add[enpagecode]' value='0'".($r[enpagecode]==0?' checked':'').">���`�s�X";
	  if(empty($ecms_config['sets']['pagechar'])||$ecms_config['sets']['pagechar']=='gb2312')
	  {
	  ?>
          <tr> 
            <td height="22">
              <?=$trueenpagecode?>            </td>
            <td><input type="radio" name="add[enpagecode]" value="1"<?=$r[enpagecode]==1?' checked':''?>>
              UTF8-&gt;GB2312</td>
            <td> <input type="radio" name="add[enpagecode]" value="3"<?=$r[enpagecode]==3?' checked':''?>>
              BIG5-&gt;GB2312</td>
            <td><input type="radio" name="add[enpagecode]" value="5"<?=$r[enpagecode]==5?' checked':''?>>
              UNICODE-&gt;GB2312</td>
          </tr>
          <?php
		$trueenpagecode='';
		}
		if(empty($ecms_config['sets']['pagechar'])||$ecms_config['sets']['pagechar']=='big5')
		{
		?>
          <tr> 
            <td height="22">
              <?=$trueenpagecode?>            </td>
            <td> <input type="radio" name="add[enpagecode]" value="2"<?=$r[enpagecode]==2?' checked':''?>>
              UTF8-&gt;BIG5</td>
            <td> <input type="radio" name="add[enpagecode]" value="4"<?=$r[enpagecode]==4?' checked':''?>>
              GB2312-&gt;BIG5</td>
            <td><input type="radio" name="add[enpagecode]" value="6"<?=$r[enpagecode]==6?' checked':''?>>
              UNICODE-&gt;BIG5</td>
          </tr>
          <?php
		 $trueenpagecode='';
		 }
		 if($ecms_config['sets']['pagechar']=='utf-8')
		 {
		 ?>
          <tr> 
            <td height="22">
              <?=$trueenpagecode?>            </td>
            <td><input type="radio" name="add[enpagecode]" value="7"<?=$r[enpagecode]==7?' checked':''?>>
              GB2312-&gt;UTF8</td>
            <td><input type="radio" name="add[enpagecode]" value="8"<?=$r[enpagecode]==8?' checked':''?>>
              BIG5-&gt;UTF8</td>
            <td><input type="radio" name="add[enpagecode]" value="9"<?=$r[enpagecode]==9?' checked':''?>>
              UNICODE-&gt;UTF8</td>
          </tr>
          <?php
		  }
		  ?>
        </table></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�O�_���ƱĶ��P�@�챵</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[recjtheurl]" type="checkbox" id="add[recjtheurl]" value="1"<?=$r[recjtheurl]==1?' checked':''?>>
        ���ƱĶ�<font color="#666666">�]���אּ�����ƱĶ��^</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF"><p>�O�_���äw�ɤJ���H��</p></td>
      <td height="23" bgcolor="#FFFFFF"><input type="radio" name="add[hiddenload]" value="0"<?=$r[hiddenload]==0?' checked':''?>>
        �O 
        <input type="radio" name="add[hiddenload]" value="1"<?=$r[hiddenload]==1?' checked':''?>>
        �_</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�Ķ���۰ʤJ�w</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[justloadin]" type="checkbox" id="add[justloadin]" value="1"<?=$r[justloadin]==1?' checked':''?>>
        �O�A 
        <input name="add[justloadcheck]" type="checkbox" id="add[justloadcheck]" value="1"<?=$r[justloadcheck]==1?' checked':''?>>
        �����f��<font color="#666666">(�����˿�ܡA�]���i��J�w�W��)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[delloadinfo]" type="checkbox" id="add[delloadinfo]" value="1"<?=$r[delloadinfo]==1?' checked':''?>>
        �J�w��۰ʧR���w�ɤJ���H���O��</td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">���魶���L�o���h<br> <font color="#666666">�榡�G�s�i�}�l[!--pad--]�s�i����</font></td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td> <textarea name="pagerepad" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[pagerepad]))?></textarea>            </td>
            <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<iframe[!--pad--]</iframe>,<IFRAME[!--pad--]</IFRAME>');">IFRAME</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<table[!--pad--]>,</table>,<TABLE[!--pad--]>,</TABLE>');">TABLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<form[!--pad--]</form>,<FORM[!--pad--]</FORM>');">FORM</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<object[!--pad--]</object>,<OBJECT[!--pad--]</OBJECT>');">OBJECT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<tr[!--pad--]>,</tr>,<TR[!--pad--]>,</TR>');">TR</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<tbody[!--pad--]>,</tbody>,<TBODY[!--pad--]>,</TBODY>');">TBODY</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<script[!--pad--]</script>,<SCRIPT[!--pad--]</SCRIPT>');">SCRIPT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<td[!--pad--]>,</td>,<TD[!--pad--]>,</TD>');">TD</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<style[!--pad--]</style>,<STYLE[!--pad--]</STYLE>');">STYLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<a[!--pad--]>,</a>,<A[!--pad--]>,</A>');">A</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<div[!--pad--]>,</div>,<DIV[!--pad--]>,</DIV>');">DIV</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<font[!--pad--]>,</font>,<FONT[!--pad--]>,</FONT>');">FONT</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<span[!--pad--]>,</span>,<SPAN[!--pad--]>,</SPAN>');">SPAN</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<img[!--pad--]>,<IMG[!--pad--]>');">IMG</a></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><font color="#666666">(�h�ӽХ�&quot;,&quot;��})</font></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="23" rowspan="2" valign="top" bgcolor="#FFFFFF">���魶������</td>
      <td height="11" bgcolor="#FFFFFF">�N 
        <textarea name="add[oldpagerep]" cols="36" rows="10" id="add[oldpagerep]"><?=ehtmlspecialchars(stripSlashes($r[oldpagerep]))?></textarea>
        ������ 
        <textarea name="add[newpagerep]" cols="36" rows="10" id="textarea4"><?=ehtmlspecialchars(stripSlashes($r[newpagerep]))?></textarea>      </td>
    </tr>
    <tr> 
      <td height="11" bgcolor="#FFFFFF"><font color="#666666">(��r�Ŧh�ӽХ�&quot;,&quot;��},�p�G�O�s�r�ŬO�h�ӡA�i�H��&quot;,&quot;��}�A�t�η|��������)</font></td>
    </tr>
    <tr class="header"> 
      <td height="23" colspan="2">�L�o�ﶵ</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�Ķ�����r(�]�t����r�~�|��)�G</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[keyboard]" type="text" id="add[keyboard]" value="<?=$r[keyboard]?>"> 
        <font color="#666666">(�u�w����D�C�p������A�Яd�šC�h�ӽХ�&quot;,&quot;��})</font></td>
    </tr>
    <tr> 
      <td rowspan="2" valign="top" bgcolor="#FFFFFF">�����G<br>
        (�w����D�P���e) </td>
      <td height="23" bgcolor="#FFFFFF">�N 
        <textarea name="add[oldword]" cols="36" rows="10" id="add[oldword]"><?=ehtmlspecialchars(stripSlashes($r[oldword]))?></textarea>
        ������ 
        <textarea name="add[newword]" cols="36" rows="10" id="add[newword]"><?=ehtmlspecialchars(stripSlashes($r[newword]))?></textarea>      </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF"><font color="#666666">(��r�Ŧh�ӽХ�&quot;,&quot;��},�p�G�O�s�r�ŬO�h�ӡA�i�H��&quot;,&quot;��}�A�t�η|��������)</font></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF"><strong>�L�o�s�i���h�G</strong><br> 
        <font color="#666666">�榡�G�s�i�}�l[!--ad--]�s�i����<br>
        (�w�鷺�e) </font></td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td> <textarea name="repad" cols="60" rows="10" id="repad"><?=ehtmlspecialchars(stripSlashes($r[repad]))?></textarea>            </td>
            <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<iframe[!--ad--]</iframe>,<IFRAME[!--ad--]</IFRAME>');">IFRAME</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<table[!--ad--]>,</table>,<TABLE[!--ad--]>,</TABLE>');">TABLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<form[!--ad--]</form>,<FORM[!--ad--]</FORM>');">FORM</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<object[!--ad--]</object>,<OBJECT[!--ad--]</OBJECT>');">OBJECT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<tr[!--ad--]>,</tr>,<TR[!--ad--]>,</TR>');">TR</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<tbody[!--ad--]>,</tbody>,<TBODY[!--ad--]>,</TBODY>');">TBODY</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<script[!--ad--]</script>,<SCRIPT[!--ad--]</SCRIPT>');">SCRIPT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<td[!--ad--]>,</td>,<TD[!--ad--]>,</TD>');">TD</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<style[!--ad--]</style>,<STYLE[!--ad--]</STYLE>');">STYLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<a[!--ad--]>,</a>,<A[!--ad--]>,</A>');">A</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<div[!--ad--]>,</div>,<DIV[!--ad--]>,</DIV>');">DIV</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<font[!--ad--]>,</font>,<FONT[!--ad--]>,</FONT>');">FONT</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<span[!--ad--]>,</span>,<SPAN[!--ad--]>,</SPAN>');">SPAN</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<img[!--ad--]>,<IMG[!--ad--]>');">IMG</a></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><font color="#666666">(�h�ӽХ�&quot;,&quot;��})</font></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">���e���Ť��Ķ�</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[newstextisnull]" type="checkbox" id="add[newstextisnull]" value="1"<?=$r[newstextisnull]==1?' checked':''?>>
        �O<font color="#666666"> (newstext�r�q)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�L�o�ۦ��G</td>
      <td height="23" bgcolor="#FFFFFF">���Ķ����D�ۦ��W�L 
        <input name="add[titlelen]" type="text" id="add[titlelen]" value="<?=$r[titlelen]?>" size="6">
        �r���H��[�P�J�w�H�����]<font color="#666666">(�p������ж�&quot;0&quot;)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="23" bgcolor="#FFFFFF">���Ķ����D�����ۦP���H��(�P�J�w�H�����) 
        <input name="add[retitlewriter]" type="checkbox" id="add[retitlewriter]" value="1"<?=$retitlewriter?>></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">�I�����e²���G</td>
      <td height="23" bgcolor="#FFFFFF"> <p>�I���H�����e 
          <input name="add[smalltextlen]" type="text" id="add[smalltextlen]" value="<?=$r[smalltextlen]?>" size="6">
          �Ӧr<font color="#666666">�]�b�S���]�m�u���e²���v���h�A�t�αĨ������I�^</font></p></td>
    </tr>
    <tr class="header"> 
      <td height="25" colspan="2">�Ķ����e���h(���Ķ����A�Яd��)</td>
    </tr>
    <tr> 
      <td bgcolor="#C7D4F7">�C��</td>
      <td bgcolor="#C7D4F7">&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF"><strong>�H���챵�ϰ쥿�h�G</strong><br>
        (<font color="#FF0000">�p�����A�Ь���</font>)<br>
        �I�����a��[�W 
        <input name="textfield" type="text" id="textfield" value="[!--smallurl--]" size="20"> 
        <br>
        �p�G&lt;tr&gt;&lt;td&gt;�챵�ϰ�&lt;/td&gt;&lt;/tr&gt;<br>
        ���h�N�O:<br> &lt;tr&gt;&lt;td&gt;[!--smallurl--]&lt;/td&gt;&lt;/tr&gt;</td>
      <td bgcolor="#FFFFFF"> <textarea name="add[zz_smallurl]" cols="60" rows="10" id="textarea8"><?=ehtmlspecialchars(stripSlashes($r[zz_smallurl]))?></textarea></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF"><strong>�H�����챵���h�G</strong><br>
        �I�����a��[�W 
        <input name="textfield" type="text" id="textfield3" value="[!--newsurl--]" size="20"> 
        <br>
        �p�G&lt;a href=&quot;�H���챵&quot;&gt;���D&lt;/a&gt;<br>
        ���h�N�O:<br> &lt;a href=&quot;[!--newsurl--]&quot;&gt;*&lt;/a&gt;</td>
      <td bgcolor="#FFFFFF"> <textarea name="add[zz_newsurl]" cols="60" rows="10" id="add[zz_newsurl]"><?=ehtmlspecialchars(stripSlashes($r[zz_newsurl]))?></textarea></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF"><p><strong>���D�Ϥ����h�G<br>
          (�p�Ϥ��b���e���A�Яd��)</strong><br>
          <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">
        </p></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td>�Ϥ��a�}�e��G 
              <input name="add[qz_titlepicl]" type="text" id="add[qz_titlepicl]" value="<?=stripSlashes($r[qz_titlepicl])?>" size="32"> 
              <input name="add[save_titlepicl]" type="checkbox" id="add[save_titlepicl]" value=" checked"<?=$r[save_titlepicl]?>>
              �O�s���a </td>
          </tr>
          <tr> 
            <td><textarea name="add[zz_titlepicl]" cols="60" rows="10" id="add[zz_titlepicl]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepicl]))?></textarea></td>
          </tr>
          <tr> 
            <td><input name="add[z_titlepicl]" type="text" id="add[z_titlepicl]" value="<?=stripSlashes($r[z_titlepicl])?>" size="32">
              (�p��o�̡A�N�����r�q��)</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="2" bgcolor="C7D4F7">���e��(���L�j���Ф��n��ܫO�s���a)</td>
    </tr>
    <?php
	@include($cjfile);
	?>
    <tr> 
      <td colspan="2" bgcolor="C7D4F7">���e�������Ķ��]�m:(�p�S�������Яd��,�u��newstext����)</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">�J�w�O�_�O�d������G</td>
      <td bgcolor="#FFFFFF"><input type="radio" name="add[doaddtextpage]" value="0"<?=$r[doaddtextpage]==0?' checked':''?>>
        �O�d����
        <input type="radio" name="add[doaddtextpage]" value="1"<?=$r[doaddtextpage]==1?' checked':''?>>
        ���O�d����</td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF">�����Φ�:</td>
      <td bgcolor="#FFFFFF"> <input type="radio" name="add[pagetype]" value="0"<?=$pagetype0?>>
        �W�U���ɯ覡 
        <input type="radio" name="add[pagetype]" value="1"<?=$pagetype1?>>
        �����C�X�� </td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF">&quot;�����C�X&quot;�����h�]�m:</td>
      <td bgcolor="#FFFFFF"> <table width="100%%" border="0" cellspacing="1" cellpadding="2">
          <tr> 
            <td width="50%" height="23"><strong>�����ϰ쥿�h(<font color="#FF0000">[!--smallpageallzz--]</font>)</strong></td>
            <td><strong>�����챵���h(<font color="#FF0000">[!--pageallzz--]</font>)</strong></td>
          </tr>
          <tr> 
            <td><textarea name="add[smallpageallzz]" cols="42" rows="12" id="textarea2"><?=ehtmlspecialchars(stripSlashes($r[smallpageallzz]))?></textarea></td>
            <td><textarea name="add[pageallzz]" cols="42" rows="12" id="textarea3"><?=ehtmlspecialchars(stripSlashes($r[pageallzz]))?></textarea></td>
          </tr>
        </table></td>
    </tr>
	<tr> 
      <td valign="top" bgcolor="#FFFFFF">&quot;�W�U���ɯ�&quot;�����h�]�m:</td>
      <td bgcolor="#FFFFFF"> <table width="100%%" border="0" cellspacing="1" cellpadding="2">
          <tr> 
            <td width="50%" height="23"><strong>�����ϰ쥿�h(<font color="#FF0000">[!--smallpagezz--]</font>)</strong></td>
            <td><strong>�����챵���h(<font color="#FF0000">[!--pagezz--]</font>)</strong></td>
          </tr>
          <tr> 
            <td><textarea name="add[smallpagezz]" cols="42" rows="12" id="add[smallpagezz]"><?=ehtmlspecialchars(stripSlashes($r[smallpagezz]))?></textarea></td>
            <td><textarea name="add[pagezz]" cols="42" rows="12" id="add[pagezz]"><?=ehtmlspecialchars(stripSlashes($r[pagezz]))?></textarea></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m">      </td>
    </tr>
  </table>
  <br>
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td><strong>�`�N�ƶ��G<font color="#FF0000"><br>
        </font></strong>1.*:��ܤ�����e�C��P�椧�������j�̦n��*��}<br>
        2.�W�[�`�I��A�̦n���u�w���v�C<br>
        3.���S��r�ŽЦb�e���[�W�u\\�v�A��M�����N�S��r�ŧאּ�u*�v�̦X�A�F�C�S��r�Ŧp�U�G<br>
        ),(,{,}�A[,]�A\�A?<br>
        4.�P�@�H���챵�t�Τ��|���ƱĶ��C</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>