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
CheckLevel($logininid,$loginin,$classid,"f");
$tid=(int)$_GET['tid'];
$tbname=RepPostVar($_GET['tbname']);
if(empty($tid)||empty($tbname))
{
	printerror("ErrorUrl","history.go(-1)");
}
$enews=RepPostStr($_GET['enews'],1);
$r[iscj]=1;
$r[tobr]=0;
$r[dohtml]=1;
$r[myorder]=0;
$disabled='';
$tbdatafhidden='';
$savetxthidden='';
$fmvnum=1;
$fmvline=3;
$fmvmust=1;
$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListF.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�r�q�޲z</a>&nbsp;>&nbsp;�W�[�r�q";
$postword='�W�[';
//�ק�r�q
if($enews=="EditF")
{
	$fid=(int)$_GET['fid'];
	$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListF.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�r�q�޲z</a>&nbsp;>&nbsp;�ק�r�q";
	$postword='�ק�';
	$r=$empire->fetch1("select * from {$dbtbpre}enewsf where fid='$fid' and tid='$tid'");
	if(!$r[fid])
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	//��������
	if($r[fform]=='textarea'||$r[fform]=='editor')
	{
		$fsr=explode(',',$r['fformsize']);
		$fformwidth=$fsr[0];
		$fformheight=$fsr[1];
	}
	//�h�Ȥ���
	if($r[fform]=='morevaluefield')
	{
		$fmvr=explode(',',$r['fmvnum']);
		$fmvnum=$fmvr[0];
		$fmvline=$fmvr[1];
		$fmvmust=$fmvr[2];
	}
	$oftype="type".$r[ftype];
	$$oftype=" selected";
	$ofform="form".$r[fform];
	$$ofform=" selected";
	$disabled=' disabled';
	$tbdatafhidden='<input type="hidden" name="tbdataf" value="'.$r[tbdataf].'">';
	$savetxthidden='<input type="hidden" name="savetxt" value="'.$r[savetxt].'">';
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title><?=$postword?>�r�q</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ShowFieldFormSet(obj,val){
	if(val=='text'||val=='password'||val=='flash'||val=='file'||val=='date'||val=='color')
	{
		fsizediv.style.display="";
		fwidthdiv.style.display="none";
		flinkfielddiv.style.display="none";
		feditordiv.style.display="none";
		defvaldiv.style.display="none";
		fmorevaluediv.style.display="none";
	}
	else if(val=='img')
	{
		fsizediv.style.display="";
		fwidthdiv.style.display="none";
		flinkfielddiv.style.display="none";
		feditordiv.style.display="none";
		defvaldiv.style.display="none";
		fmorevaluediv.style.display="none";
	}
	else if(val=='editor')
	{
		fsizediv.style.display="none";
		fwidthdiv.style.display="";
		flinkfielddiv.style.display="none";
		feditordiv.style.display="";
		defvaldiv.style.display="none";
		fmorevaluediv.style.display="none";
	}
	else if(val=='textarea'||val=='ubbeditor')
	{
		fsizediv.style.display="none";
		fwidthdiv.style.display="";
		flinkfielddiv.style.display="none";
		feditordiv.style.display="none";
		defvaldiv.style.display="none";
		fmorevaluediv.style.display="none";
	}
	else if(val=='select'||val=='radio'||val=='checkbox')
	{
		fsizediv.style.display="none";
		fwidthdiv.style.display="none";
		flinkfielddiv.style.display="none";
		feditordiv.style.display="none";
		defvaldiv.style.display="";
		fmorevaluediv.style.display="none";
	}
	else if(val=='linkfield')
	{
		fsizediv.style.display="";
		fwidthdiv.style.display="none";
		flinkfielddiv.style.display="";
		feditordiv.style.display="none";
		defvaldiv.style.display="none";
		fmorevaluediv.style.display="none";
	}
	else if(val=='linkfieldselect')
	{
		fsizediv.style.display="none";
		fwidthdiv.style.display="none";
		flinkfielddiv.style.display="";
		feditordiv.style.display="none";
		defvaldiv.style.display="none";
		fmorevaluediv.style.display="none";
	}
	else if(val=='morevaluefield')
	{
		fsizediv.style.display="none";
		fwidthdiv.style.display="none";
		flinkfielddiv.style.display="none";
		feditordiv.style.display="none";
		defvaldiv.style.display="none";
		fmorevaluediv.style.display="";
	}
}
</script>
</head>

<body onload="ShowFieldFormSet(document.addfform,'<?=$r[fform]?$r[fform]:'text'?>')">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="addfform" method="post" action="../ecmsmod.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr> 
      <td height="25" colspan="2" class="header"> 
        <?=$postword?>
        �ƾڪ�( 
        <?=$dbtbpre?>
        ecms_ 
        <?=$tbname?>
        )�r�q 
        <input name="fid" type="hidden" id="fid" value="<?=$fid?>"> <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> 
        <input name="oldfform" type="hidden" id="oldfform" value="<?=$r[fform]?>"> 
        <input name="oldf" type="hidden" id="oldf" value="<?=$r[f]?>"> <input name="tbname" type="hidden" id="tbname" value="<?=$tbname?>"> 
        <input name="tid" type="hidden" id="tid" value="<?=$tid?>"> <input name="oldfvalue" type="hidden" id="oldfvalue" value="<?=ehtmlspecialchars(stripSlashes($r[fvalue]))?>"> 
        <input name="oldsavetxt" type="hidden" id="oldsavetxt" value="<?=$r[savetxt]?>"> 
        <input name="oldlinkfieldval" type="hidden" id="oldlinkfieldval" value="<?=$r[linkfieldval]?>"> 
        <input name="oldfformsize" type="hidden" id="oldfformsize" value="<?=$r[fformsize]?>"> 
		<?=$ecms_hashur['form']?>
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�򥻳]�m</td>
    </tr>
    <tr> 
      <td width="25%" height="25" bgcolor="#FFFFFF">�r�q�W</td>
      <td width="75%" height="25" bgcolor="#FFFFFF"> <input name="f" type="text" id="f" value="<?=$r[f]?>">
        <font color="#666666">(�ѭ^��P�Ʀr�զ��A�B����H�Ʀr�}�Y�C��p�G&quot;title&quot;)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�r�q����</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="fname" type="text" id="fname" value="<?=$r[fname]?>"> 
        <font color="#666666">(��p�G&quot;���D&quot;)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�r�q����</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="ftype" id="select">
          <option value="VARCHAR"<?=$typeVARCHAR?>>�r�ū�0-255�r�`(VARCHAR)</option>
		  <option value="CHAR"<?=$typeCHAR?>>�w���r�ū�0-255�r�`(CHAR)</option>
          <option value="TEXT"<?=$typeTEXT?>>�p���r�ū�(TEXT)</option>
          <option value="MEDIUMTEXT"<?=$typeMEDIUMTEXT?>>�����r�ū�(MEDIUMTEXT)</option>
          <option value="LONGTEXT"<?=$typeLONGTEXT?>>�j���r�ū�(LONGTEXT)</option>
          <option value="TINYINT"<?=$typeTINYINT?>>�p�ƭȫ�(TINYINT)</option>
          <option value="SMALLINT"<?=$typeSMALLINT?>>���ƭȫ�(SMALLINT)</option>
          <option value="INT"<?=$typeINT?>>�j�ƭȫ�(INT)</option>
          <option value="BIGINT"<?=$typeBIGINT?>>�W�j�ƭȫ�(BIGINT)</option>
          <option value="FLOAT"<?=$typeFLOAT?>>�ƭȯB�I��(FLOAT)</option>
          <option value="DOUBLE"<?=$typeDOUBLE?>>�ƭ�����׫�(DOUBLE)</option>
          <option value="DATE"<?=$typeDATE?>>�����(DATE)</option>
          <option value="DATETIME"<?=$typeDATETIME?>>����ɶ���(DATETIME)</option>
        </select>
        ���� 
        <input name="flen" type="text" id="flen" value="<?=$r[flen]?>" size="6"> 
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�s���</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="tbdataf" value="0"<?=$r[tbdataf]==0?' checked':''?><?=$disabled?>>
        �D�� 
        <input type="radio" name="tbdataf" value="1"<?=$r[tbdataf]==1?' checked':''?><?=$disabled?>>
        �ƪ�<?=$tbdatafhidden?><font color="#666666"> (�]�m�ᤣ��ק�)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�S���ݩ�</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�[����</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="iskey" value="1"<?=$r[iskey]==1?' checked':''?>>
        �O 
        <input type="radio" name="iskey" value="0"<?=$r[iskey]==0?' checked':''?>>
        �_ 
        <input name="oldiskey" type="hidden" id="oldiskey" value="<?=$r[iskey]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Ȱߤ@</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="isonly" value="1"<?=$r[isonly]==1?' checked':''?>>
        �O 
        <input type="radio" name="isonly" value="0"<?=$r[isonly]==0?' checked':''?>>
        �_ 
        <input name="oldisonly" type="hidden" id="oldisonly" value="<?=$r[isonly]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Ķ���</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="iscj" type="radio" value="1"<?=$r[iscj]==1?' checked':''?>>
        �O 
        <input name="iscj" type="radio" value="0"<?=$r[iscj]==0?' checked':''?>>
        �_ 
        <input name="oldiscj" type="hidden" id="oldiscj" value="<?=$r[iscj]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�����r�q</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="ispage" value="1"<?=$r[ispage]==1?' checked':''?>>
        �O 
        <input type="radio" name="ispage" value="0"<?=$r[ispage]==0?' checked':''?>>
        �_<font color="#666666">(��u�i�]�m�@�Ӧr�q)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">²���r�q</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="issmalltext" value="1"<?=$r[issmalltext]==1?' checked':''?>>
        �O 
        <input type="radio" name="issmalltext" value="0"<?=$r[issmalltext]==0?' checked':''?>>
        �_<font color="#666666">(�ҪO�̳]�m�I��²���r�ƪ��r�q)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���e�s�奻</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="savetxt" value="1"<?=$r[savetxt]==1?' checked':''?><?=$disabled?>>
        �O 
        <input type="radio" name="savetxt" value="0"<?=$r[savetxt]==0?' checked':''?><?=$disabled?>>
        �_<?=$savetxthidden?><font color="#666666">(�]�m�ᤣ��ק�,��u�i�]�m�@�Ӧr�q)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�e�x���e���</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="tobr" type="checkbox" id="tobr" value="1"<?=$r[tobr]==1?' checked':''?>>
        �N�^�������������, 
        <input name="dohtml" type="checkbox" id="dohtml" value="1"<?=$r[dohtml]==1?' checked':''?>>
        ���html�N�X</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��x�W�[�H���B�z���</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adddofun" type="text" id="adddofun" value="<?=$r[adddofun]?>">
        <font color="#666666">(�@�뤣�]�m�A�榡�u��ƦW##�Ѽơv�Ѽƥi���]�m)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��x�ק�H���B�z���</td>
      <td height="25" bgcolor="#FFFFFF"><input name="editdofun" type="text" id="editdofun" value="<?=$r[editdofun]?>">
        <font color="#666666">(�@�뤣�]�m�A�榡�u��ƦW##�Ѽơv�Ѽƥi���]�m)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�e�x�W�[�H���B�z���</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qadddofun" type="text" id="qadddofun" value="<?=$r[qadddofun]?>">
        <font color="#666666">(�@�뤣�]�m�A�榡�u��ƦW##�Ѽơv�Ѽƥi���]�m)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�e�x�ק�H���B�z���</td>
      <td height="25" bgcolor="#FFFFFF"><input name="qeditdofun" type="text" id="qeditdofun" value="<?=$r[qeditdofun]?>">
        <font color="#666666">(�@�뤣�]�m�A�榡�u��ƦW##�Ѽơv�Ѽƥi���]�m)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ܶ���</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>"> 
        <font color="#666666">(�Ʀr�V�p�V�e��)</font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�����ܳ]�m</td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF">��J�����ܤ���</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="fform" id="fform" onchange="ShowFieldFormSet(document.addfform,this.options[this.selectedIndex].value)">
          <option value="text"<?=$formtext?>>���奻��(text)</option>
          <option value="password"<?=$formpassword?>>�K�X��(password)</option>
          <option value="select"<?=$formselect?>>�U�Ԯ�(select)</option>
          <option value="radio"<?=$formradio?>>����(radio)</option>
          <option value="checkbox"<?=$formcheckbox?>>�_���(checkbox)</option>
          <option value="textarea"<?=$formtextarea?>>�h��奻��(textarea)</option>
          <option value="editor"<?=$formeditor?>>�s�边(editor)</option>
          <option value="img"<?=$formimg?>>�Ϥ�(img)</option>
          <option value="flash"<?=$formflash?>>FLASH���(flash)</option>
          <option value="file"<?=$formfile?>>���(file)</option>
          <option value="date"<?=$formdate?>>���(date)</option>
          <option value="color"<?=$formcolor?>>�C��(color)</option>
		  <option value="morevaluefield"<?=$formmorevaluefield?>>�h�Ȧr�q(morevaluefield)</option>
          <option value="linkfield"<?=$formlinkfield?>>��ܥ~�����p�r�q(linkfield)</option>
          <option value="linkfieldselect"<?=$formlinkfieldselect?>>�U�ԥ~�����p�r�q(linkfieldselect)</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ﶵ</td>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr id="fsizediv"> 
            <td height="23"><strong>��������</strong><br> <input name="fformsize" type="text" id="fformsize" value="<?=$r[fformsize]?>"> 
              <font color="#666666">(�Ŭ����q�{)</font></td>
          </tr>
          <tr id="fwidthdiv"> 
            <td height="23"><strong>�����j�p</strong><br>
              �e�� 
              <input name="fformwidth" type="text" id="fformwidth" value="<?=$fformwidth?>" size="6">
              �Ѱ��� 
              <input name="fformheight" type="text" id="fformheight" value="<?=$fformheight?>" size="6"> 
              <font color="#666666">(�Ŭ����q�{)</font></td>
          </tr>
          <tr id="flinkfielddiv"> 
            <td height="23"><strong>��ܼҫ��r�q�]�m</strong><br>
              �ƾڪ�W 
              <input name="linkfieldtb" type="text" id="linkfieldtb" value="<?=$r[linkfieldtb]?>"> 
              <br>
              �Ȧr�q�W 
              <input name="linkfieldval" type="text" id="linkfieldval" value="<?=$r[linkfieldval]?>"> 
              <input name="samedata" type="checkbox" id="samedata" value="1"<?=$r[samedata]==1?' checked':''?>>
              �ƾڦP�B<br>
              ��ܦr�q 
              <input name="linkfieldshow" type="text" id="linkfieldshow" value="<?=$r[linkfieldshow]?>"> 
            </td>
          </tr>
          <tr id="feditordiv"> 
            <td height="23"><strong>�s�边�˦�</strong><br> <input type="radio" name="editorys" value="0"<?=$r[editorys]==0?' checked':''?>>
              �зǫ� 
              <input type="radio" name="editorys" value="1"<?=$r[editorys]==1?' checked':''?>>
              ²�䫬</td>
          </tr>
		  <tr id="fmorevaluediv"> 
            <td height="23"><strong>�h�Ȧr�q�����榡</strong><br>
              �]�m�C�� 
              <input name="fmvnum" type="text" id="fmvnum" value="<?=$fmvnum?>" size="6">
              �A�q�{��� 
              <input name="fmvline" type="text" id="fmvline" value="<?=$fmvline?>" size="6">
              �A��
              <input name="fmvmust" type="text" id="fmvmust" value="<?=$fmvmust?>" size="6">
              �C����</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF"><p>��l��<br>
          <font color="#666666"><span id="defvaldiv">(�h�ӭȥ�&quot;�^��&quot;��}�F<br>
          �u�U��/���/�_��v�榡�ΡG��==�W�١F<br>
          ��ȵ���W�ٮɡA�W�٥i�ٲ��F<br>
          �q�{�ﶵ�᭱�[�G:default)</span></font></p></td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="fvalue" cols="65" rows="8" id="fvalue" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes(str_replace("|","\r\n",$r[fvalue])))?></textarea></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">��J������html�N�X<br> <font color="#666666">(�W�[�r�q�ɽЯd��)</font></td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="fhtml" cols="65" rows="10" id="fhtml" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[fhtml]))?></textarea></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">��Z������html�N�X<br> <font color="#666666">(�W�[�r�q�ɽЯd��)</font></td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="qfhtml" cols="65" rows="10" id="qfhtml" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[qfhtml]))?></textarea></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">����</td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="fzs" cols="65" rows="6" id="fzs" style="WIDTH: 100%"><?=stripSlashes($r[fzs])?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="����"> 
        <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td height="25"><font color="#666666">�����G�D��r�q�V�֮Ĳv�V���A���b�C��եΦr�q��ĳ�N�r�q�s�b�ƪ�C</font></td>
    </tr>
  </table>
</form>
</body>
</html>
