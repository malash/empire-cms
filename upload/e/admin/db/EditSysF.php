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
$fid=(int)$_GET['fid'];
$url="�ƾڪ�:[".$dbtbpre."ecms_".$tbname."]&nbsp;>&nbsp;<a href=ListF.php?tid=$tid&tbname=$tbname".$ecms_hashur['ehref'].">�r�q�޲z</a>&nbsp;>&nbsp;�ק�t�Φr�q";
$r=$empire->fetch1("select * from {$dbtbpre}enewsf where fid='$fid' and tid='$tid'");
if(!$r[fid])
{
	printerror("ErrorUrl","history.go(-1)");
}
$oftype="type".$r[ftype];
$$oftype=" selected";
$ofform="form".$r[fform];
$$ofform=" selected";
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ק�t�Φr�q</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ShowFieldFormSet(obj,val){
	if(val=='text')
	{
		fsizediv.style.display="";
		flinkfielddiv.style.display="none";
	}
	else if(val=='img')
	{
		fsizediv.style.display="";
		flinkfielddiv.style.display="none";
	}
	else if(val=='linkfield')
	{
		fsizediv.style.display="";
		flinkfielddiv.style.display="";
	}
	else if(val=='linkfieldselect')
	{
		fsizediv.style.display="none";
		flinkfielddiv.style.display="";
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
  <?=$ecms_hashur['form']?>
    <tr> 
      <td height="25" colspan="2" class="header"> �ק�ƾڪ�( 
        <?=$dbtbpre?>
        ecms_ 
        <?=$tbname?>
        )���t�Φr�q 
        <input name="fid" type="hidden" id="fid" value="<?=$fid?>"> <input name="enews" type="hidden" id="enews" value="EditSysF"> 
        <input name="oldfform" type="hidden" id="oldfform" value="<?=$r[fform]?>"> 
        <input name="oldf" type="hidden" id="oldf" value="<?=$r[f]?>"> <input name="tbname" type="hidden" id="tbname" value="<?=$tbname?>"> 
        <input name="tid" type="hidden" id="tid" value="<?=$tid?>"> <input name="oldfvalue" type="hidden" id="oldfvalue" value="<?=ehtmlspecialchars(stripSlashes($r[fvalue]))?>"> 
        <input name="oldiskey" type="hidden" id="oldiskey" value="<?=$r[iskey]?>"> 
        <input name="oldsavetxt" type="hidden" id="oldsavetxt" value="<?=$r[savetxt]?>"> 
        <input name="oldisonly" type="hidden" id="oldisonly" value="<?=$r[isonly]?>"> 
        <input name="oldlinkfieldval" type="hidden" id="oldlinkfieldval" value="<?=$r[linkfieldval]?>"> 
        <input name="oldfformsize" type="hidden" id="oldfformsize" value="<?=$r[fformsize]?>"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">�򥻳]�m</td>
    </tr>
    <tr> 
      <td width="25%" height="25" bgcolor="#FFFFFF">�r�q�W</td>
      <td width="75%" height="25" bgcolor="#FFFFFF"><b> 
        <?=$r[f]?>
        <input name="f" type="hidden" id="f" value="<?=$r[f]?>">
        </b></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�r�q����</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="fname" type="text" id="fname" value="<?=$r[fname]?>"></td>
    </tr>
	<?php
	if($r[f]=='title'||$r[f]=='titlepic')
	{
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�r�q����</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="ftype" id="select">
          <option value="CHAR"<?=$typeCHAR?>>�w���r�ū�0-255�r�`(CHAR)</option>
          <option value="VARCHAR"<?=$typeVARCHAR?>>�r�ū�0-255�r�`(VARCHAR)</option>
        </select>
        ���� 
        <input name="flen" type="text" id="flen" value="<?=$r[flen]?>" size="6"> 
      </td>
    </tr>
	<?php
	}
	else
	{
	?>
	<input type="hidden" name="ftype" value="<?=$r[ftype]?>">
	<input type="hidden" name="flen" value="<?=$r[flen]?>">
	<?php
	}
	?>
    <tr> 
      <td height="25" colspan="2">�S���ݩ�</td>
    </tr>
	<?php
	if($r[f]!='special.field')
	{
	?>
	<?php
	if($r[f]!='newstime')
	{
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�[����</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="iskey" value="1"<?=$r[iskey]==1?' checked':''?>>
        �O 
        <input type="radio" name="iskey" value="0"<?=$r[iskey]==0?' checked':''?>>
        �_</td>
    </tr>
	<?php
	}
	else
	{
	?>
	<input type="hidden" name="iskey" value="<?=$r[iskey]?>">
	<?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�Ȱߤ@</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="radio" name="isonly" value="1"<?=$r[isonly]==1?' checked':''?>>
        �O 
        <input type="radio" name="isonly" value="0"<?=$r[isonly]==0?' checked':''?>>
        �_</td>
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
	<?php
	}	
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">��ܶ���</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>"> 
        <font color="#666666">(�Ʀr�V�p�V�e��)</font></td>
    </tr>
	<tr> 
      <td height="25" colspan="2">�����ܳ]�m</td>
    </tr>
	<?php
	if($r[f]!='special.field')
	{
	?>
    <tr> 
      <td bgcolor="#FFFFFF">��J�����ܤ���</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="fform" id="fform" onchange="ShowFieldFormSet(document.addfform,this.options[this.selectedIndex].value)">
          <option value="text"<?=$formtext?>>���奻��(text)</option>
          <option value="img"<?=$formimg?>>�Ϥ�(img)</option>
          <option value="linkfield"<?=$formlinkfield?>>��ܥ~�����p�r�q(linkfield)</option>
          <option value="linkfieldselect"<?=$formlinkfieldselect?>>�U�ԥ~�����p�r�q(linkfieldselect)</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ﶵ</td>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr id="fsizediv"> 
            <td height="23"><strong>��������</strong><br> <input name="fformsize" type="text" id="fformsize2" value="<?=$r[fformsize]?>"> 
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
              <input name="oldlinkfieldtb" type="hidden" id="oldlinkfieldtb" value="<?=$r[linkfieldtb]?>"> 
              <input name="oldlinkfieldshow" type="hidden" id="oldlinkfieldshow" value="<?=$r[linkfieldshow]?>"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF">��l��</td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="fvalue" cols="65" rows="8" id="fvalue" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes(str_replace("|","\r\n",$r[fvalue])))?></textarea></td>
    </tr>
	<?php
	}
	?>
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
</form>
</body>
</html>
