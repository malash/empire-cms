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

//�f��
$ecmscheck=(int)$_GET['ecmscheck'];
$addecmscheck='';
$indexchecked=1;
if($ecmscheck)
{
	$addecmscheck='&ecmscheck='.$ecmscheck;
	$indexchecked=0;
}
//�O�_����
$isclose=(int)$_GET['isclose'];
if($isclose)
{
	$reload=(int)$_GET['reload'];
	$reloadjs='';
	if($reload)
	{
		$reloadjs='opener.parent.main.location.reload();';
	}
	echo"<script>".$reloadjs."window.close();</script>";
	exit();
}

$classid=(int)$_GET['classid'];
if(empty($class_r[$classid][classid]))
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
$id=(int)$_GET['id'];
//�������ҽX
if(!$doselfinfo['doeditinfo'])//�s���v��
{
	printerror("NotEditInfoLevel","EditInfoSimple.php?isclose=1".$ecms_hashur['ehref']);
}
$filepass=$id;
$ecmsfirstpost=0;
//�ҫ�
$modid=$class_r[$classid][modid];
$enter=$emod_r[$modid]['enter'];
//�|����
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	$ygroup.="<option value=".$l_r[groupid].">".$l_r[groupname]."</option>";
}
//��l�Ƽƾ�
$r=array();
$todaytime=date("Y-m-d H:i:s");

//-----------------------------------------�ק�H��
//���ު�
$index_r=$empire->fetch1("select classid,id,checked from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_index where id='$id' limit 1");
if(!$index_r['id']||$index_r['classid']!=$classid)
{
	printerror("ErrorUrl","history.go(-1)");
}
//��^��
$infotb=ReturnInfoMainTbname($class_r[$classid][tbname],$index_r['checked']);
//�D��
$r=$empire->fetch1("select * from ".$infotb." where id='$id' limit 1");
//��^��H��
$infodatatb=ReturnInfoDataTbname($class_r[$classid][tbname],$index_r['checked'],$r['stb']);
//�ƪ�
$finfor=$empire->fetch1("select closepl from ".$infodatatb." where id='$id'");
$r=array_merge($r,$finfor);
//ñ�o��
if($r[isqf])
{
	$wfinfor=$empire->fetch1("select tstatus,checktno from {$dbtbpre}enewswfinfo where id='$id' and classid='$classid' limit 1");
}
//�u��s��ۤv���H��
if($doselfinfo['doselfinfo']&&($r[userid]<>$logininid||$r[ismember]))
{
	printerror("NotDoSelfinfo","EditInfoSimple.php?isclose=1".$ecms_hashur['ehref']);
}
//�w�f�֫H�����i�ק�
if($doselfinfo['docheckedit']&&$index_r['checked'])
{
	printerror("NotEditCheckInfoLevel","EditInfoSimple.php?isclose=1".$ecms_hashur['ehref']);
}
//�ɶ�
$newstime=$r['newstime'];
$r['newstime']=date("Y-m-d H:i:s",$r['newstime']);
//�챵�a�}
$titleurl=$r['titleurl'];
if(!$r['isurl'])
{
	$r['titleurl']='';
}
//�|����
$group=str_replace(" value=".$r[groupid].">"," value=".$r[groupid]." selected>",$ygroup);
//���D�ݩ�
if(strstr($r[titlefont],','))
{
	$tfontr=explode(',',$r[titlefont]);
	$r[titlecolor]=$tfontr[0];
	$r[titlefont]=$tfontr[1];
}
if(strstr($r[titlefont],"b|"))
{
	$titlefontb=" checked";
}
if(strstr($r[titlefont],"i|"))
{
	$titlefonti=" checked";
}
if(strstr($r[titlefont],"s|"))
{
	$titlefonts=" checked";
}
//���D����
$cttidswhere='';
$tts='';
$caddr=$empire->fetch1("select ttids from {$dbtbpre}enewsclassadd where classid='$classid'");
if($caddr['ttids']!='-')
{
	if($caddr['ttids']&&$caddr['ttids']!=',')
	{
		$cttidswhere=' and typeid in ('.substr($caddr['ttids'],1,-1).')';
	}
	$ttsql=$empire->query("select typeid,tname from {$dbtbpre}enewsinfotype where mid='$modid'".$cttidswhere." order by myorder");
	while($ttr=$empire->fetch($ttsql))
	{
		$select='';
		if($ttr[typeid]==$r[ttid])
		{
			$select=' selected';
		}
		$tts.="<option value='$ttr[typeid]'".$select.">$ttr[tname]</option>";
	}
}
//����챵
$getcurlr['classid']=$classid;
$classurl=sys_ReturnBqClassname($getcurlr,9);
//��e�ϥΪ��ҪO��
$thegid=GetDoTempGid();
$phpmyself=urlencode(eReturnSelfPage(1));
//��^�Y���M���˯ŧO�W��
$ftnr=ReturnFirsttitleNameList($r['firsttitle'],$r['isgood']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title><?=stripSlashes($r[title])?></title>
<link rel="stylesheet" href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" type="text/css">
<script>
function foreColor(){
  if(!Error())	return;
  var arr = showModalDialog("../../data/html/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.add.titlecolor.value=arr;
  else document.add.titlecolor.focus();
}
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="add" method="post" action="../ecmsinfo.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> �ֳt�ק�H�����ݩ� 
        <input type=hidden value=EditInfoSimple name=enews> <input type=hidden value=<?=$classid?> name=classid> 
        <input type=hidden value=<?=$bclassid?> name=bclassid> <input name=id type=hidden value=<?=$id?>> 
        <input type=hidden value="<?=$r[newspath]?>" name=newspath> <input type=hidden value="<?=$r[ztid]?>" name=oldztid> 
        <input type=hidden value="<?=$filepass?>" name=filepass> <input type=hidden value="<?=$r[username]?>" name=username> 
        <input name="oldfilename" type="hidden" value="<?=$r[filename]?>"> <input name="oldgroupid" type="hidden" value="<?=$r[groupid]?>"> 
        <input name="oldchecked" type="hidden" value="<?=$index_r[checked]?>">
        <input name="ecmsfrom" type="hidden" value="<?=RepPostStrUrl($_SERVER['HTTP_REFERER'])?>"> 
        <input name="ecmsnfrom" type="hidden" value="<?=RepPostStrUrl($_GET['ecmsnfrom'])?>">
		<input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="16%" height="25">���D</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> 
              <?=$tts?"<select name='ttid'><option value='0'>���D����</option>$tts</select>":""?>
              <input type=text name=title value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>" size="60"> 
            </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF">�ݩ�: 
              <input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>
              ���� 
              <input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>
              ���� 
              <input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>
              �R���u &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: 
              <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"> 
              <a onclick="foreColor();"><img src="../../data/images/color.gif" width="21" height="21" align="absbottom"></a> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�S���ݩ�</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DBEAF5">
          <tr> 
            <td height="25" bgcolor="#FFFFFF">�H���ݩ�: 
              <input name="checked" type="checkbox" value="1"<?=$index_r[checked]?' checked':''?>>
              �f�� &nbsp;&nbsp; ����
              <select name="isgood" id="isgood">
                <option value="0"<?=$r[isgood]==0?' selected':''?>>������</option>
                <?=$ftnr['igname']?>
              </select>
              &nbsp;&nbsp; �Y�� 
              <select name="firsttitle" id="firsttitle">
                <option value="0"<?=$r[firsttitle]==0?' selected':''?>>�D�Y��</option>
                <?=$ftnr['ftname']?>
              </select> </td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF">�~���챵: 
              <input name="titleurl" type="text" value="<?=stripSlashes($r[titleurl])?>" size="49"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�o�G�ɶ�</td>
      <td><input name="newstime" type="text" value="<?=$r[newstime]?>"> <input type=button name=button2 value="�]����e�ɶ�" onclick="document.add.newstime.value='<?=$todaytime?>'"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���D�Ϥ�</td>
      <td><input name="titlepic" type="text" id="titlepic" value="<?=$ecmsfirstpost==1?"":ehtmlspecialchars(stripSlashes($r[titlepic]))?>" size="45"> 
        <a onclick="window.open('../ecmseditor/FileMain.php?type=1&classid=<?=$classid?>&infoid=<?=$id?>&filepass=<?=$filepass?>&doing=1&field=titlepic&sinfo=1<?=$ecms_hashur['ehref']?>','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" border="0" align="absbottom"></a> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td rowspan="2">�䥦�ﶵ</td>
      <td height="25">�m���ŧO: 
        <select name="istop">
          <option value="0"<?=$r[istop]==0?' selected':''?>>���m��</option>
          <option value="1"<?=$r[istop]==1?' selected':''?>>�@�Ÿm��</option>
          <option value="2"<?=$r[istop]==2?' selected':''?>>�G�Ÿm��</option>
          <option value="3"<?=$r[istop]==3?' selected':''?>>�T�Ÿm��</option>
          <option value="4"<?=$r[istop]==4?' selected':''?>>�|�Ÿm��</option>
          <option value="5"<?=$r[istop]==5?' selected':''?>>���Ÿm��</option>
          <option value="6"<?=$r[istop]==6?' selected':''?>>���Ÿm��</option>
          <option value="7"<?=$r[istop]==7?' selected':''?>>�C�Ÿm��</option>
          <option value="8"<?=$r[istop]==8?' selected':''?>>�K�Ÿm��</option>
		  <option value="9"<?=$r[istop]==9?' selected':''?>>�E�Ÿm��</option>
        </select>
        , 
        <input type=checkbox name=closepl value=1<?=$r[closepl]==1?" checked":""?>>
        ��������</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�I����&nbsp;&nbsp;&nbsp;: 
        <input name="onclick" type="text" id="onclick2" value="<?=$r[onclick]?>" size="8">
        �U����&nbsp;&nbsp;&nbsp;: 
        <input name="totaldown" type="text" id="totaldown2" value="<?=$r[totaldown]?>" size="8"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td><input type="submit" name="addnews" value=" �� �� "> &nbsp;&nbsp;&nbsp; 
        <input type="reset" name="Submit2" value="���m">
        &nbsp;&nbsp;&nbsp; <input type="button" name="Submit22" value="����" onclick="window.close();"></td>
    </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>