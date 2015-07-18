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

//��^�H���H�����e
function ReturnSpInfoidGetData($add,$userid,$username){
	global $empire,$dbtbpre,$class_r,$emod_r;
	$idr=explode(',',$add['getinfoid']);
	$classid=(int)$idr[0];
	$id=(int)$idr[1];
	if(!$classid||!$id||!$class_r[$classid][tbname])
	{
		return '';
	}
	$mid=$class_r[$classid]['modid'];
	$smalltextf=$emod_r[$mid]['smalltextf'];
	$sf='';
	if($smalltextf&&$smalltextf<>',')
	{
		$smr=explode(',',$smalltextf);
		$sf=$smr[1];
	}
	$addf='';
	if($sf&&!strstr($emod_r[$mid]['tbdataf'],','.$sf.','))
	{
		$addf=','.$sf;
	}
	$index_r=$empire->fetch1("select id,checked from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_index where id='$id' limit 1");
	if(!$index_r['id'])
	{
		return '';
	}
	//��^��
	$infotb=ReturnInfoMainTbname($class_r[$classid][tbname],$index_r['checked']);
	$infor=$empire->fetch1("select id,classid,isurl,titleurl,isgood,firsttitle,plnum,totaldown,onclick,newstime,titlepic,title,stb".$addf." from ".$infotb." where id='$id' limit 1");
	if($sf&&!$addf)
	{
		//��^��H��
		$infodatatb=ReturnInfoDataTbname($class_r[$classid][tbname],$index_r['checked'],$infor['stb']);
		$finfor=$empire->fetch1("select ".$sf." from ".$infodatatb." where id='$id' limit 1");
		$infor[$sf]=$finfor[$sf];
	}
	$ret_r['title']=$infor[title];
	$ret_r['titleurl']=sys_ReturnBqTitleLink($infor);
	$ret_r['titlepic']=$infor[titlepic];
	$ret_r['smalltext']=$infor[$sf];
	$ret_r['newstime']=$infor[newstime];
	return $ret_r;
}

$spid=(int)$_GET['spid'];
//�H��
$spr=$empire->fetch1("select spid,spname,varname,sptype,maxnum,groupid,userclass,username from {$dbtbpre}enewssp where spid='$spid'");
if(!$spr['spid'])
{
	printerror('ErrorUrl','');
}
//���Ҿާ@�v��
CheckDoLevel($lur,$spr[groupid],$spr[userclass],$spr[username]);
$enews=ehtmlspecialchars($_GET['enews']);
$postword='�W�[�H���H��';
$todaytime=date("Y-m-d H:i:s");
$url="<a href=UpdateSp.php".$ecms_hashur['whehref'].">��s�H��</a>&nbsp;>&nbsp;<a href=ListSpInfo.php?spid=$spid".$ecms_hashur['ehref'].">".$spr[spname]."</a>&nbsp;>&nbsp;�W�[�H���H��";
$filepass=$spid;
//�ק�
if($enews=="EditSpInfo")
{
	$postword='�ק�H���H��';
	$sid=(int)$_GET['sid'];
	if($spr[sptype]==1)
	{
		$r=$empire->fetch1("select * from {$dbtbpre}enewssp_1 where sid='$sid' and spid='$spid'");
		$newstime=date('Y-m-d H:i:s',$r[newstime]);
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
		$url="<a href=UpdateSp.php".$ecms_hashur['whehref'].">��s�H��</a>&nbsp;>&nbsp;<a href=ListSpInfo.php?spid=$spid".$ecms_hashur['ehref'].">".$spr[spname]."</a>&nbsp;>&nbsp;�ק�H���H��";
	}
	elseif($spr[sptype]==2)
	{
		$r=$empire->fetch1("select * from {$dbtbpre}enewssp_2 where sid='$sid' and spid='$spid'");
		$newstime=date('Y-m-d H:i:s',$r[newstime]);
		$url="<a href=UpdateSp.php".$ecms_hashur['whehref'].">��s�H��</a>&nbsp;>&nbsp;<a href=ListSpInfo.php?spid=$spid".$ecms_hashur['ehref'].">".$spr[spname]."</a>&nbsp;>&nbsp;�ק�H���H��";
	}
	elseif($spr[sptype]==3)
	{
		$r=$empire->fetch1("select * from {$dbtbpre}enewssp_3 where spid='$spid' limit 1");
		$url="<a href=UpdateSp.php".$ecms_hashur['whehref'].">��s�H��</a>&nbsp;>&nbsp;".$spr[spname]."&nbsp;>&nbsp;�ק�H���H��";
	}
}
//���o�H��
$ecms=RepPostStr($_GET['ecms'],1);
if($ecms=='InfoidGetData')
{
	include("../../data/dbcache/class.php");
	$getinfor=ReturnSpInfoidGetData($_GET,$logininid,$loginin);
	if($getinfor['title'])
	{
		$r['title']=$getinfor['title'];
		$r['titlepic']=$getinfor['titlepic'];
		$r['titleurl']=$getinfor['titleurl'];
		$r['newstime']=$getinfor['newstime'];
		$r['smalltext']=$getinfor['smalltext'];
		$newstime=date('Y-m-d H:i:s',$r[newstime]);
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�H��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function foreColor(){
  if(!Error())	return;
  var arr = showModalDialog("../../data/html/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.form1.titlecolor.value=arr;
  else document.form1.titlecolor.focus();
}
</script>
<script>
function ToGetInfo(){
	var infoid;
	infoid=prompt('�п�J�H��ID�A�榡�G���ID,�H��ID',',');
	if(infoid==''||infoid==null||infoid==',')
	{
		return false;
	}
	self.location.href='AddSpInfo.php?<?=$ecms_hashur['ehref']?>&enews=<?=$enews?>&spid=<?=$spid?>&sid=<?=$sid?>&ecms=InfoidGetData&getinfoid='+infoid;
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<?php
if($spr['sptype']==1)
{
?>
<form name="form1" method="post" action="ListSpInfo.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
	<?=$ecms_hashur['form']?>
  <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>">
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="14%" height="25">���D�G</td>
      <td width="86%" height="25"><input name="title" type="text" id="title" size="60" value="<?=ehtmlspecialchars(stripSlashes($r[title]))?>">
        <input type="button" name="Submit5" value="�q�L�H��ID���" onclick="ToGetInfo();"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���D�챵�G</td>
      <td height="25"><input name="titleurl" type="text" id="titleurl" size="60" value="<?=stripSlashes($r[titleurl])?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���D�ݩʡG</td>
      <td height="25"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td> <input name="titlefont[b]" type="checkbox" value="b"<?=$titlefontb?>>
              ���� 
              <input name="titlefont[i]" type="checkbox" value="i"<?=$titlefonti?>>
              ���� 
              <input name="titlefont[s]" type="checkbox" value="s"<?=$titlefonts?>>
              �R���u &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�C��: 
              <input name="titlecolor" type="text" value="<?=stripSlashes($r[titlecolor])?>" size="10"> 
              <a onclick="foreColor();"><img src="../../data/images/color.gif" width="21" height="21" align="absbottom"></a></td>
          </tr>
          <tr> 
            <td>����: 
              <input name="titlepre" type="text" id="titlepre3" value="<?=ehtmlspecialchars(stripSlashes($r[titlepre]))?>" size="21">
              �k��: 
              <input name="titlenext" type="text" id="titlenext" value="<?=ehtmlspecialchars(stripSlashes($r[titlenext]))?>" size="21"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���D�Y�ϡG</td>
      <td height="25"><input name="titlepic" type="text" id="titlepic" size="60" value="<?=stripSlashes($r[titlepic])?>">
        <a onclick="window.open('../ecmseditor/FileMain.php?<?=$ecms_hashur['ehref']?>&modtype=7&type=1&classid=&doing=2&field=titlepic&filepass=<?=$filepass?>&sinfo=1','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" alt="���/�W�ǹϤ�" width="22" height="22" border="0" align="absbottom"></a></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���D�j�ϡG</td>
      <td height="25"><input name="bigpic" type="text" id="bigpic" size="60" value="<?=stripSlashes($r[bigpic])?>">
        <a onclick="window.open('../ecmseditor/FileMain.php?<?=$ecms_hashur['ehref']?>&modtype=7&type=1&classid=&doing=2&field=bigpic&filepass=<?=$filepass?>&sinfo=1','','width=700,height=550,scrollbars=yes');" title="��ܤw�W�Ǫ��Ϥ�"><img src="../../data/images/changeimg.gif" alt="���/�W�ǹϤ�" width="22" height="22" border="0" align="absbottom"></a></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�o�G�ɶ��G</td>
      <td height="25"><input name="newstime" type="text" id="title3" size="60" value="<?=$newstime?>">
        <input type="button" name="Submit3" value="��e�ɶ�" onclick="document.form1.newstime.value='<?=$todaytime?>';"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���e²���G</td>
      <td height="25"><textarea name="smalltext" cols="60" rows="5" id="smalltext"><?=ehtmlspecialchars(stripSlashes($r[smalltext]))?></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="sid" type="hidden" id="sid" value="<?=$r['sid']?>"> 
        <input name="spid" type="hidden" id="spid" value="<?=$spid?>"></td>
    </tr>
  </table>
</form>
<?php
}
elseif($spr['sptype']==2)
{
?>
<form name="form1" method="post" action="ListSpInfo.php">
  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
	<?=$ecms_hashur['form']?>
  <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>">
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="14%" height="25">�H����m�G</td>
      <td width="86%" height="25">���ID: 
        <input name="classid" type="text" id="titlepre5" value="<?=$r[classid]?>" size="21">
        �H��ID: 
        <input name="id" type="text" id="classid" value="<?=$r[id]?>" size="21"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�o�G�ɶ��G</td>
      <td height="25"><input name="newstime" type="text" id="newstime" size="60" value="<?=$newstime?>"> 
        <input type="button" name="Submit32" value="��e�ɶ�" onclick="document.form1.newstime.value='<?=$todaytime?>';"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit4" value="����"> <input type="reset" name="Submit22" value="���m"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="sid" type="hidden" id="sid3" value="<?=$r['sid']?>"> 
        <input name="spid" type="hidden" id="spid" value="<?=$spid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">&nbsp;</td>
      <td height="25"><font color="#666666">���]�m�ɶ�����Ū���H���������o�G�ɶ�.</font></td>
    </tr>
  </table>
</form>
<?php
}
elseif($spr['sptype']==3)
{
?>
	<script>
	function ReSpInfoBak(){
		self.location.href='AddSpInfo.php?<?=$ecms_hashur['ehref']?>&enews=EditSpInfo&spid=<?=$spid?>';
	}
	</script>
<form name="form1" method="post" action="ListSpInfo.php">
  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
		<?=$ecms_hashur['form']?>
  <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>">
    <tr class="header"> 
      <td height="25">
        <div align="center"><?=$postword?></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="86%" height="25"><div align="center"> 
          <textarea name="sptext" cols="80" rows="27" id="sptext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[sptext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><div align="center"> 
          <input type="submit" name="Submit4" value="����">&nbsp;&nbsp;
          &nbsp;&nbsp;<input type="reset" name="Submit22" value="���m">
          &nbsp;&nbsp; [<a href="#ecms" onclick="window.open('../template/editor.php?<?=$ecms_hashur['ehref']?>&getvar=opener.document.form1.sptext.value&returnvar=opener.document.form1.sptext.value&fun=ReturnHtml&notfullpage=1','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');">�i���ƽs��</a>]&nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('SpInfoBak.php?spid=<?=$r[spid]?>&sid=<?=$r['sid']?><?=$ecms_hashur['ehref']?>','ViewSpInfoBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
          <input name="enews" type="hidden" id="enews" value="<?=$enews?>">
          <input name="sid" type="hidden" id="sid" value="<?=$r['sid']?>">
          <input name="spid" type="hidden" id="spid" value="<?=$spid?>">
        </div></td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html>
<?php
db_close();
$empire=null;
?>