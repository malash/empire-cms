<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
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

$ttid=(int)$_GET['ttid'];
$url=$public_r['newsurl'].$class_tr[$ttid][tpath]."/";
$jspath=$public_r['newsurl'].'d/js/class/tt'.$ttid.'_';
?>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">

<title>�եΦa�}</title><table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class=header> 
    <td height="25">&nbsp;</td>
    <td height="25">�եΦa�}</td>
    <td height="25"> <div align="center">�w��</div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="22%" height="25">���D�����a�}:</td>
    <td width="71%" height="25"> <input name="textfield" type="text" value="<?=$url?>" size="35"></td>
    <td width="7%" height="25"> <div align="center"><a href="<?=$url?>" target="_blank">�w��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�̷s�H��JS:</td>
    <td height="25"> <input name="textfield2" type="text" value="<?=$jspath?>newnews.js" size="35"></td>
    <td height="25"> <div align="center"><a href="js.php?classid=<?=$ttid?>&js=<?php echo urlencode($jspath."newnews.js");?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�����H��JS:</td>
    <td height="25"> <input name="textfield3" type="text" value="<?=$jspath?>hotnews.js" size="35"></td>
    <td height="25"> <div align="center"><a href="js.php?classid=<?=$ttid?>&js=<?php echo urlencode($jspath."hotnews.js");?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">���˫H��JS:</td>
    <td height="25"> <input name="textfield4" type="text" value="<?=$jspath?>goodnews.js" size="35"></td>
    <td height="25"> <div align="center"><a href="js.php?classid=<?=$ttid?>&js=<?php echo urlencode($jspath."goodnews.js");?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a></div></td>
  </tr>

  <tr bgcolor="#FFFFFF"> 
    <td height="25">���I���׫H��JS:</td>
    <td height="25"> <input name="textfield4" type="text" value="<?=$jspath?>hotplnews.js" size="35"></td>
    <td height="25"> <div align="center"><a href="js.php?classid=<?=$ttid?>&js=<?php echo urlencode($jspath."hotplnews.js");?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�Y���H��JS:</td>
    <td height="25"> <input name="textfield4" type="text" value="<?=$jspath?>firstnews.js" size="35"></td>
    <td height="25"> <div align="center"><a href="js.php?classid=<?=$ttid?>&js=<?php echo urlencode($jspath."firstnews.js");?><?=$ecms_hashur['ehref']?>" target="_blank">�w��</a></div></td>
  </tr>
</table>
