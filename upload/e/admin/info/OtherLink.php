<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require '../'.LoadLang("pub/fun.php");
require("../../data/dbcache/class.php");
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

$classid=(int)$_GET['classid'];
$id=(int)$_GET['id'];
$enews=ehtmlspecialchars($_GET['enews']);
$form=RepPostVar($_GET['form']);
$field=RepPostVar($_GET['field']);
$keyid=RepPostVar($_GET['keyid']);
$keyboard=RepPostVar($_GET['keyboard']);
$title=RepPostStr($_GET['title']);
if(!$classid||!$class_r[$classid]['tbname'])
{
	printerror("ErrorUrl","history.go(-1)");
}
if($keyboard)
{
	$defaultkeyboard=str_replace(',',' ',str_replace('�A',' ',$keyboard));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�����챵</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function UpdateInfoKeyid(){
	opener.document.<?=$form?>.<?=$field?>.value=document.otherlinkform.returnkeyid.value;
	window.close();
}
function CheckSearchForm(obj){
	if(obj.keyboard.value=='')
	{
		alert('�j������r���ର��');
		obj.keyboard.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr> 
    <td height="25" colspan="2" class="header">
      <?=stripSlashes($title)?>
      �������챵 </td>
  </tr>
  <tr> 
    <td height="25" valign="top" bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
        <form name="otherlinkform" method="post" action="">
          <tr> 
            <td width="80%" height="25"><strong>�w������챵</strong></td>
            <td width="20%">&nbsp;</td>
          </tr>
          <tr> 
            <td height="380" colspan="2" valign="top" bgcolor="#FFFFFF"><IFRAME frameBorder="0" id="showinfopage" name="showinfopage" scrolling="yes" src="OtherLinkShow.php?classid=<?=$classid?>&id=<?=$id?>&enews=<?=$enews?>&keyid=<?=$keyid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:1"></IFRAME></td>
          </tr>
          <tr> 
            <td height="25" colspan="2" bgcolor="#FFFFFF"><div align="center"> 
                <input type="button" name="Submit2" value=" �T �w " onclick="UpdateInfoKeyid();">
                &nbsp;&nbsp;&nbsp;
                <input type="button" name="Submit3" value="����" onclick="window.close();">
                <input name="returnkeyid" type="hidden" id="returnkeyid">
              </div></td>
          </tr>
        </form>
      </table> </td>
    <td width="60%" valign="top" bgcolor="#FFFFFF">
        <table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
		<form action="OtherLinkSearch.php" method="GET" name="searchinfoform" target="searchinfopage" id="searchinfoform" onsubmit="return CheckSearchForm(document.searchinfoform);">
		<?=$ecms_hashur['eform']?>
          <tr> 
            <td height="25">�d�ߡG 
              <input name="keyboard" type="text" id="keyboard" value="<?=$defaultkeyboard?>">
              <select name="show" id="show">
                <option value="1" selected>���D</option>
                <option value="2">����r</option>
                <option value="3">ID</option>
              </select><span id="listfileclassnav"></span>
              <input type="submit" name="Submit" value="�j��">
              <input name="sear" type="hidden" id="sear" value="1">
              <input name="returnkeyid" type="hidden" id="returnkeyid">
              <input name="pclassid" type="hidden" id="pclassid" value="<?=$classid?>">
              <input name="pid" type="hidden" id="pid" value="<?=$id?>">
			  <input name="keyid" type="hidden" id="keyid" value="<?=$keyid?>">
              <input name="enews" type="hidden" id="enews" value="<?=$enews?>"></td>
          </tr>
          <tr> 
            <td height="405" valign="top" bgcolor="#FFFFFF"> 
              <IFRAME frameBorder="0" id="searchinfopage" name="searchinfopage" scrolling="yes" src="OtherLinkSearch.php<?=$ecms_hashur['whehref']?>" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:1"></IFRAME></td>
          </tr>
		  </form>
        </table>
      </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25"><div align="center"><font color="#666666">�����G�j���h������r�i�H�ΪŮ�j�}�C</font></div></td>
  </tr>
</table>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="../ShowClassNav.php?ecms=5&classid=<?=$classid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?php
db_close();
$empire=null;
?>
