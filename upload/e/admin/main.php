<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//���ҥΤ�
$lur=is_login();
$logininid=(int)$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=(int)$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//�ڪ����A
$user_r=$empire->fetch1("select pretime,preip,loginnum,preipport from {$dbtbpre}enewsuser where userid='$logininid'");
$gr=$empire->fetch1("select groupname from {$dbtbpre}enewsgroup where groupid='$loginlevel'");
//�޲z���έp
$adminnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsuser");
$date=date("Y-m-d");
$noplnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspl_".$public_r['pldeftb']." where checked=1");
//���f�ַ|��
$nomembernum=$empire->gettotal("select count(*) as total from ".eReturnMemberTable()." where ".egetmf('checked')."=0");
//�L���s�i
$outtimeadnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsad where endtime<'$date' and endtime<>'0000-00-00'");
//�t�ΫH��
	if(function_exists('ini_get')){
        $onoff = ini_get('register_globals');
    } else {
        $onoff = get_cfg_var('register_globals');
    }
    if($onoff){
        $onoff="���}";
    }else{
        $onoff="����";
    }
    if(function_exists('ini_get')){
        $upload = ini_get('file_uploads');
    } else {
        $upload = get_cfg_var('file_uploads');
    }
    if ($upload){
        $upload="�i�H";
    }else{
        $upload="���i�H";
    }
	if(function_exists('ini_get')){
        $uploadsize = ini_get('upload_max_filesize');
    } else {
        $uploadsize = get_cfg_var('upload_max_filesize');
    }
	if(function_exists('ini_get')){
        $uploadpostsize = ini_get('post_max_size');
    } else {
        $uploadpostsize = get_cfg_var('post_max_size');
    }
//�}��
$register_ok="�}��";
if($public_r[register_ok])
{$register_ok="����";}
$addnews_ok="�}��";
if($public_r[addnews_ok])
{$addnews_ok="����";}
//����
@include("../class/EmpireCMS_version.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�Ұ�����޲z�t��</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><div align="center"><strong> 
        <h3>�w��ϥΫҰ�����޲z�t�� (EmpireCMS)</h3>
        </strong></div></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">�ڪ����A</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"> <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="22">�n����:&nbsp;<b>
                  <?=$loginin?>
                  </b>&nbsp;&nbsp;,���ݥΤ��:&nbsp;<b>
                  <?=$gr[groupname]?>
                  </b></td>
              </tr>
              <tr>
                <td height="22">�o�O�z�� <b>
                  <?=$user_r[loginnum]?>
                  </b> ���n���A�W���n���ɶ��G
                  <?=$user_r[pretime]?date('Y-m-d H:i:s',$user_r[pretime]):'---'?>
                  �A�n��IP�G
                  <?=$user_r[preip]?$user_r[preip].':'.$user_r[preipport]:'---'?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td width="100%" height="25"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><strong><a href="#ecms">�ֱ����</a></strong></td>
                <td><div align="right"><a href="http://www.phome.net/edown25/" target="_blank"><strong>�Ұ�U���t��</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>�H���ާ@</strong>�G&nbsp;&nbsp;<a href="AddInfoChClass.php<?=$ecms_hashur['whehref']?>">�W�[�H��</a>&nbsp;&nbsp; 
            <a href="ListAllInfo.php<?=$ecms_hashur['whehref']?>">�޲z�H��</a>&nbsp;&nbsp; <a href="ListAllInfo.php?ecmscheck=1<?=$ecms_hashur['ehref']?>">�f�֫H��</a> 
            &nbsp;&nbsp; <a href="workflow/ListWfInfo.php<?=$ecms_hashur['whehref']?>">ñ�o�H��</a>&nbsp;&nbsp; <a href="openpage/AdminPage.php?leftfile=<?=urlencode('../pl/PlNav.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../pl/PlMain.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�޲z����')?><?=$ecms_hashur['ehref']?>">�޲z����</a>&nbsp;&nbsp; <a href="sp/UpdateSp.php<?=$ecms_hashur['whehref']?>">��s�H��</a>&nbsp;&nbsp; 
            <a href="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">�ƾڧ�s����</a></td>
           </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>��ؾާ@</strong>�G&nbsp;&nbsp;<a href="ListClass.php<?=$ecms_hashur['whehref']?>">�޲z���</a>&nbsp;&nbsp; 
            <a href="special/ListZt.php<?=$ecms_hashur['whehref']?>">�޲z�M�D</a>&nbsp;&nbsp; <a href="ListInfoClass.php<?=$ecms_hashur['whehref']?>">�޲z�Ķ�</a> 
            &nbsp;&nbsp; <a href="openpage/AdminPage.php?leftfile=<?=urlencode('../file/FileNav.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�޲z����')?><?=$ecms_hashur['ehref']?>">����޲z</a>&nbsp;&nbsp; 
            <a href="SetEnews.php<?=$ecms_hashur['whehref']?>">�t�ΰѼƳ]�m</a></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>�Τ�ާ@</strong>�G&nbsp;&nbsp;<a href="member/ListMember.php?sear=1&schecked=1<?=$ecms_hashur['ehref']?>">�f�ַ|��</a>&nbsp;&nbsp; 
            <a href="member/ListMember.php<?=$ecms_hashur['whehref']?>">�޲z�|��</a> &nbsp; <a href="user/ListLog.php<?=$ecms_hashur['whehref']?>">�޲z�n����x</a> 
            &nbsp;&nbsp; <a href="user/ListDolog.php<?=$ecms_hashur['whehref']?>">�޲z�ާ@��x</a>&nbsp;&nbsp; <a href="user/EditPassword.php<?=$ecms_hashur['whehref']?>">�ק�ӤH���</a>&nbsp;&nbsp; 
            <a href="user/UserTotal.php<?=$ecms_hashur['whehref']?>">�Τ�o�G�έp</a></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>���X�޲z</strong>�G&nbsp;&nbsp;<a href="tool/gbook.php<?=$ecms_hashur['whehref']?>">�޲z�d��</a>&nbsp;&nbsp; 
            <a href="tool/feedback.php<?=$ecms_hashur['whehref']?>">�޲z���X�H��</a>&nbsp;&nbsp;<a href="DownSys/ListError.php<?=$ecms_hashur['whehref']?>">�޲z���~���i</a>&nbsp;&nbsp; 
            <a href="#empirecms" onclick="window.open('openpage/AdminPage.php?leftfile=<?=urlencode('../ShopSys/pageleft.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../ShopSys/ListDd.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('�ӫ��t�κ޲z')?><?=$ecms_hashur['ehref']?>','AdminShopSys','');">�޲z�q��</a>&nbsp;&nbsp;<a href="pay/ListPayRecord.php<?=$ecms_hashur['whehref']?>">�޲z��I�O��</a>&nbsp;&nbsp; 
            <a href="PathLevel.php<?=$ecms_hashur['whehref']?>">�d�ݥؿ��v�����A</a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="42"> <div align="center"><strong><font color="#0000FF" size="3">�Ұ�����޲z�t�Υ����}�� 
              �� �̦w���B��í�w���}��CMS�t��</font></strong></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%"><a href="#"><strong>�t�ΫH��</strong></a></td>
                <td><div align="right"><a href="http://www.phome.net/ebak2010/" target="_blank"><strong>�Ұ�MYSQL�ƥ����U��</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td width="43%"><strong>�����H��</strong></td>
          <td width="57%"><strong>�A�Ⱦ��H��</strong></td>
        </tr>
        <tr> 
          <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td width="28%" height="23">�|�����U:</td>
                <td width="72%"> 
                  <?=$register_ok?>
                </td>
              </tr>
              <tr> 
                <td height="23">�|����Z:</td>
                <td> 
                  <?=$addnews_ok?>
                </td>
              </tr>
              <tr> 
                <td height="23">�޲z���Ӽ�:</td>
                <td><a href="user/ListUser.php<?=$ecms_hashur['whehref']?>"><?=$adminnum?></a> �H</td>
              </tr>
              <tr> 
                <td height="23">���f�ֵ���:</td>
                <td><a href="openpage/AdminPage.php?leftfile=<?=urlencode('../pl/PlNav.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../pl/ListAllPl.php?checked=2'.$ecms_hashur['ehref'])?>&title=<?=urlencode('�޲z����')?><?=$ecms_hashur['ehref']?>"><?=$noplnum?></a> ��</td>
              </tr>
              <tr> 
                <td height="23">���f�ַ|��:</td>
                <td><a href="member/ListMember.php?sear=1&schecked=1<?=$ecms_hashur['ehref']?>"><?=$nomembernum?></a> �H</td>
              </tr>
              <tr> 
                <td height="23">�L���s�i:</td>
                <td><a href="tool/ListAd.php?time=1<?=$ecms_hashur['ehref']?>"><?=$outtimeadnum?></a> ��</td>
              </tr>
              <tr> 
                <td height="23">�n����IP:</td>
                <td><?php echo egetip();?></td>
              </tr>
              <tr> 
                <td height="23">�{�Ǫ���:</td>
                <td> <a href="http://www.phome.net" target="_blank"><strong>EmpireCMS 
                  v<?=EmpireCMS_VERSION?> Free</strong></a> <font color="#666666">(<?=EmpireCMS_LASTTIME?>)</font></td>
              </tr>
              <tr>
                <td height="23">�{�ǽs�X:</td>
                <td><?=EmpireCMS_CHARVER?></td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td width="25%" height="23">�A�Ⱦ��n��:</td>
                <td width="75%"> 
                  <?=$_SERVER['SERVER_SOFTWARE']?>
                </td>
              </tr>
              <tr> 
                <td height="23">�ާ@�t��:</td>
                <td><?php echo defined('PHP_OS')?PHP_OS:'����';?></td>
              </tr>
              <tr> 
                <td height="23">PHP����:</td>
                <td><?php echo @phpversion();?></td>
              </tr>
              <tr> 
                <td height="23">MYSQL����:</td>
                <td><?php echo @mysql_get_server_info();?></td>
              </tr>
              <tr> 
                <td height="23">�����ܶq:</td>
                <td> 
                  <?=$onoff?>
                  <font color="#666666">(��ĳ����)</font></td>
              </tr>
              <tr>
                <td height="23">�]�N�ޥ�:</td>
                <td> 
                  <?=MAGIC_QUOTES_GPC?'�}��':'����'?>
                  <font color="#666666">(��ĳ�}��)</font></td>
              </tr>
              <tr> 
                <td height="23">�W�Ǥ��:</td>
                <td> 
                  <?=$upload?>
                  <font color="#666666">(�̤j���G<?=$uploadsize?>�A���G<?=$uploadpostsize?>)</font> </td>
              </tr>
              <tr> 
                <td height="23">��e�ɶ�:</td>
                <td><?php echo date("Y-m-d H:i:s");?></td>
              </tr>
              <tr> 
                <td height="23">�ϥΰ�W:</td>
                <td> 
                  <?=$_SERVER['HTTP_HOST']?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">�x��H��</td>
        </tr>
        <tr> 
          <td width="43%" bgcolor="#FFFFFF"> 
            <table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="28%" height="25">�Ұ�x��D��</td>
                <td width="72%" height="25"><a href="http://www.phome.net" target="_blank">http://www.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�Ұ�x��׾�</td>
                <td height="25"><a href="http://bbs.phome.net" target="_blank">http://bbs.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�Ұ겣�~����</td>
                <td height="25"><a href="http://www.phome.net/product/" target="_blank">http://www.phome.net/product/</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">���q����</td>
                <td height="25"><a href="http://www.digod.com" target="_blank">http://www.digod.com</a></td>
              </tr>
            </table>
          </td>
          <td width="57%" height="125" valign="top" bgcolor="#FFFFFF"> 
            <IFRAME frameBorder="0" name="getinfo" scrolling="no" src="ginfo.php<?=$ecms_hashur['whehref']?>" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">EmpireCMS �}�o�ζ�</td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="80%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="15%" height="25">���v�Ҧ�</td>
                <td width="85%"><a href="http://www.digod.com" target="_blank">�s�{���R���ҿ��n��}�o�������q</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�}�o�P����ζ�</td>
                <td>wm_chief�Bamt�B�ҿ��B�p��Bzeedy</td>
              </tr>
              
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�S�O�P��</td>
                <td>�ݤ��쭷�Byingnt�Bhicode�Bsooden�B�Ѱ��B�p�L�B�Ѯ��q�BTryLife�B5starsgeneral</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>