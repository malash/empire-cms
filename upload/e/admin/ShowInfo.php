<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../data/dbcache/class.php");
require("../data/dbcache/MemberLevel.php");
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

$id=(int)$_GET['id'];
$classid=(int)$_GET['classid'];
if(empty($class_r[$classid][classid])||!$id)
{
	printerror("ErrorUrl","history.go(-1)");
}
//�����v��
$doselfinfo=CheckLevel($logininid,$loginin,$classid,"news");
if(!$class_r[$classid][tbname]||!$class_r[$classid][classid])
{
	printerror("ErrorUrl","history.go(-1)");
}
//�D�׷����
if(!$class_r[$classid]['islast'])
{
	printerror("AddInfoErrorClassid","history.go(-1)");
}
$bclassid=$class_r[$classid][bclassid];
$fun_r['AdminInfo']='�޲z�H��';
//�ҫ�
$fieldexp="<!--field--->";
$recordexp="<!--record-->";
$tbname=$class_r[$classid][tbname];
$mid=$class_r[$classid][modid];
$mr=$empire->fetch1("select enter,tbname from {$dbtbpre}enewsmod where mid='$mid'");
if(empty($mr['tbname']))
{
	printerror("ErrorUrl","history.go(-1)");
}
$enter=$mr['enter'];
$savetxtf=$emod_r[$mid]['savetxtf'];
//�ɯ�
$url=AdminReturnClassLink($classid).'&nbsp;>&nbsp;�d�ݫH��';

//���ު�
$index_r=$empire->fetch1("select id,classid,checked from {$dbtbpre}ecms_".$tbname."_index where id='$id' limit 1");
if(!$index_r['id']||$index_r['classid']!=$classid)
{
	printerror("ErrorUrl","history.go(-1)");
}
//�D��
$infotb=ReturnInfoMainTbname($tbname,$index_r['checked']);//��^��
$r=$empire->fetch1("select * from ".$infotb." where id='$id' limit 1");
$r[newstime]=date("Y-m-d H:i:s",$r[newstime]);
//�ƪ�
$infodatatb=ReturnInfoDataTbname($tbname,$index_r['checked'],$r['stb']);//��^�ƪ�
$finfor=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from ".$infodatatb." where id='$id'");
$r=array_merge($r,$finfor);
//���e�s�奻
if($savetxtf)
{
	$r[$savetxtf]=GetTxtFieldText($r[$savetxtf]);
}
//�o�G��
if($r[ismember])
{
	$username=empty($r[userid])?'�C��':"�|���G<a href='member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target='_blank'>".$r[username]."</a>";
}
else
{
	$username="<a href='user/AddUser.php?enews=EditUser&userid=".$r[userid].$ecms_hashur['ehref']."' target='_blank'>".$r[username]."</a>";
}
//���A
$st='';
if($index_r[checked])//�f��
{
	$st.="[�w�f��]&nbsp;&nbsp;";
}
else
{
	$st.="[���f��]&nbsp;&nbsp;";
}
if($r[istop])//�m��
{
	$st.="[��".$r[istop]."]&nbsp;&nbsp;";
}
if($r[isgood])//����
{
	$st.="[��".$r[isgood]."]&nbsp;&nbsp;";
}
if($r[firsttitle])//�Y��
{
	$st.="[�Y".$r[firsttitle]."]";
}
//���D
$titleurl=sys_ReturnBqTitleLink($r);
$r[title]="<a href='$titleurl' target='_blank'>".DoTitleFont($r[titlefont],$r[title])."</a>";
//�v��
$group='';
if($r[groupid])
{
	$group=$level_r[$r[groupid]][groupname];
	if($r[userfen])
	{
		$group.=" �A�����I�ơG".$r[userfen];
	}
}
//����챵
$classurl=sys_ReturnBqClassname($r,9);
$getclassurlr['classid']=$bclassid;
$bclassurl=sys_ReturnBqClassname($getclassurlr,9);
$classes="<a href='$bclassurl' target='_blank'>".$class_r[$bclassid][classname]."</a>&nbsp;>&nbsp;<a href='$classurl' target='_blank'>".$class_r[$classid][classname]."</a>";
//�M�D
$zts='';
if($r[ztid]&&$r[ztid]<>'|')
{
	$ztr=explode('|',$r[ztid]);
	$count=count($ztr)-1;
	for($i=1;$i<$count;$i++)
	{
		$zturlr[ztid]=$ztr[$i];
		$zturl=sys_ReturnBqZtname($zturlr);
		$zts.="<a href='$zturl' target='_blank'>".$class_zr[$ztr[$i]][ztname]."</a>&nbsp;&nbsp;";
	}
}
//���D����
$titletype=$class_tr[$r[ttid]]['tname'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�d�ݫH��</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ecmsinfo.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" style="word-wrap: break-word">
  <?=$ecms_hashur['eform']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�d�ݫH��</div></td>
    </tr>
    <tr> 
      <td width="5%" height="25" bgcolor="#FFFFFF">
<div align="right"><strong>�o�G��</strong></div></td>
      <td bgcolor="#FFFFFF"> 
        <?=$username?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>�o�G�ɶ�</strong></div></td>
      <td bgcolor="#FFFFFF">�W�[�ɶ��G 
        <?=date("Y-m-d H:i:s",$r[truetime])?>
        �A�̫�ק�G 
        <?=date("Y-m-d H:i:s",$r[lastdotime])?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>�H��</strong></div></td>
      <td bgcolor="#FFFFFF">�I���ơG 
        <?=$r[onclick]?>
        �A���׼ơG 
        <?=$r[plnum]?>
        �A�U���ơG 
        <?=$r[totaldown]?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>�H�����A</strong></div></td>
      <td bgcolor="#FFFFFF"> 
        <?=$st?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>���</strong></div></td>
      <td bgcolor="#FFFFFF"> 
        <?=$classes?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>�M�D</strong></div></td>
      <td bgcolor="#FFFFFF"> 
        <?=$zts?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>���D����</strong></div></td>
      <td bgcolor="#FFFFFF">
        <?=$titletype?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>����r</strong></div></td>
      <td bgcolor="#FFFFFF"> 
        <?=$r[keyboard]?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>�����H��ID</strong></div></td>
      <td bgcolor="#FFFFFF"> 
        <?=$r[keyid]?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>�d���v��</strong></div></td>
      <td bgcolor="#FFFFFF"> 
        <?=$group?>
      </td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><div align="right"><strong>�����챵</strong></div></td>
      <td bgcolor="#FFFFFF"><a href="<?=$titleurl?>" target="_blank"><?=$titleurl?></a></td>
    </tr>
    <?php
	$fr=explode($recordexp,$enter);
	$count=count($fr)-1;
	for($i=0;$i<$count;$i++)
	{
		$fr1=explode($fieldexp,$fr[$i]);
		$fname=$fr1[0];
		$f=$fr1[1];
		if($f=="special.field")
		{
			continue;
		}
	?>
    <tr> 
      <td width="13%" height="25" bgcolor="#FFFFFF"><div align="right"> <strong> 
          <?=$fname?>
          </strong> </div></td>
      <td width="87%" bgcolor="#FFFFFF"> 
        <?=stripSlashes($r[$f])?>
      </td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>