<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
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
$bclassid=(int)$_GET['bclassid'];
$id=(int)$_GET['id'];
//�����v��
CheckLevel($logininid,$loginin,$classid,"news");
//�f�֪�
$search='';
$search.=$ecms_hashur['ehref'];
$addecmscheck='';
$ecmscheck=(int)$_GET['ecmscheck'];
$indexchecked=1;
if($ecmscheck)
{
	$search.='&ecmscheck='.$ecmscheck;
	$addecmscheck='&ecmscheck='.$ecmscheck;
	$indexchecked=0;
}
if(!$classid||!$class_r[$classid][tbname]||!$id)
{
	printerror('ErrorUrl','');
}
//�H��
$index_r=$empire->fetch1("select classid,checked from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_index where id='$id' limit 1");
if(!$index_r['classid']||$index_r['classid']!=$classid)
{
	printerror('ErrorUrl','');
}
//��^��
$infotb=ReturnInfoMainTbname($class_r[$index_r[classid]][tbname],$index_r['checked']);
$n_r=$empire->fetch1("select classid,title,restb from ".$infotb." where id='$id' limit 1");
$pubid=ReturnInfoPubid($classid,$id);
$start=0;
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
//�C�����
$line=(int)$_GET['line'];
if($line>0&&$line<1000)
{
	$search.='&line='.$line;
}
else
{
	$line=30;
}
$page_line=12;
$offset=$page*$line;
$search.="&bclassid=$bclassid&classid=$classid&id=$id";
$add='';
//����
$isgood=(int)$_GET['isgood'];
if($isgood)
{
	$add.=' and isgood=1';
	$search.="&isgood=$isgood";
}
//�f��
$checked=(int)$_GET['checked'];
if($checked)
{
	$add.=" and checked='".($checked==1?0:1)."'";
	$search.="&checked=$checked";
}
//�j��
$keyboard=RepPostVar2($_GET['keyboard']);
if($keyboard)
{
	$show=(int)$_GET['show'];
	if($show==1)
	{
		$where="username like '%".$keyboard."%'";
	}
	elseif($show==3)
	{
		$where="saytext like '%".$keyboard."%'";
	}
	else
	{
		$where="sayip like '%".$keyboard."%'";
	}
	$add.=' and '.$where;
	$search.="&keyboard=$keyboard&show=$show";
}
$query="select plid,username,saytime,sayip,checked,zcnum,fdnum,userid,isgood,saytext,pubid,eipport from {$dbtbpre}enewspl_".$n_r['restb']." where pubid='$pubid'".$add;
$totalquery="select count(*) as total from {$dbtbpre}enewspl_".$n_r['restb']." where pubid='$pubid'".$add;
//���o�`����
$totalnum=(int)$_GET['totalnum'];
if($totalnum>0)
{
	$num=$totalnum;
}
else
{
	$num=$empire->gettotal($totalquery);
}
$query.=" order by plid desc limit $offset,$line";
$sql=$empire->query($query);
$search.='&totalnum='.$num;
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//�ɯ�
$url=AdminReturnClassLink($classid).'&nbsp;>&nbsp;<a href="../../public/InfoUrl/?classid='.$classid.'&id='.$id.'" target="_blank">'.stripSlashes($n_r[title]).'</a>&nbsp;>&nbsp;�޲z����';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
<style>
.ecomment {margin:0;padding:0;}
.ecomment {margin-bottom:12px;overflow-x:hidden;overflow-y:hidden;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:3px;background:#FFFFEE;padding:3px;border:solid 1px #999;}
.ecommentauthor {float:left; color:#F96; font-weight:bold;}
.ecommenttext {clear:left;margin:0;padding:0;}
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m:<?=$url?></td>
  </tr>
</table>

  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="form2" method="get" action="ListPl.php">
  <?=$ecms_hashur['eform']?>
    <tr>
      <td>����r�G 
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        <select name="show" id="show">
          <option value="1"<?=$show==1?' selected':''?>>�o���</option>
          <option value="2"<?=$show==2?' selected':''?>>IP�a�}</option>
		  <option value="3"<?=$show==3?' selected':''?>>���פ��e</option>
        </select>
		<select name="checked" id="checked">
          <option value="0"<?=$checked==0?' selected':''?>>����</option>
          <option value="1"<?=$checked==1?' selected':''?>>�w�f��</option>
          <option value="2"<?=$checked==2?' selected':''?>>���f��</option>
        </select>
        <input name="isgood" type="checkbox" id="isgood" value="1"<?=$isgood==1?' checked':''?>>
        ����
        <select name="line" id="line">
          <option value="30"<?=$line==30?' selected':''?>>�C��30��</option>
          <option value="50"<?=$line==50?' selected':''?>>�C��50��</option>
          <option value="100"<?=$line==100?' selected':''?>>�C��100��</option>
        </select>
        <input type="submit" name="Submit2" value="�j������">
        <input name=id type=hidden id="id" value=<?=$id?>>
        <input name=classid type=hidden id="classid" value=<?=$classid?>>
        <input name=bclassid type=hidden id="bclassid" value=<?=$bclassid?>></td>
    </tr>
	</form>
  </table>

<form name="form1" method="post" action="../ecmspl.php">
<?=$ecms_hashur['form']?>
<input type=hidden name=bclassid value=<?=$bclassid?>>
<input type=hidden name=classid value=<?=$classid?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=restb value=<?=$n_r['restb']?>>
  <input name="isgood" type="hidden" id="isgood" value="1">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" style="WORD-BREAK: break-all; WORD-WRAP: break-word">
    <tr class="header"> 
      <td width="4%" height="25"><div align="center">���</div></td>
      <td width="19%" height="25"><div align="center">���W</div></td>
      <td width="49%" height="25"><div align="center">���פ��e</div></td>
      <td width="14%" height="25"><div align="center">�o��ɶ�</div></td>
      <td width="14%" height="25"><div align="center">IP</div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		if(!empty($r[checked]))
		{$checked=" title='���f��' style='background:#99C4E3'";}
		else
		{$checked="";}
		if($r['userid'])
		{
			$r['username']="<a href='../member/AddMember.php?enews=EditMember&userid=$r[userid]".$ecms_hashur['ehref']."' target='_blank'><b>$r[username]</b></a>";
		}
		if(empty($r['username']))
		{
			$r['username']='�ΦW';
		}
		$r['saytime']=date('Y-m-d H:i:s',$r['saytime']);
		if($r[isgood])
		{
			$r[saytime]='<font color=red>'.$r[saytime].'</font>';
		}
		//������
		$saytext=RepPltextFace(stripSlashes($r['saytext']));
	?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'" id=pl<?=$r[plid]?>> 
      <td height="25" valign="top"><div align="center"> 
          <input name="plid[]" type="checkbox" id="plid[]" value="<?=$r[plid]?>"<?=$checked?>>
        </div></td>
      <td height="25" valign="top"><div align="center"> 
          <?=$r[username]?>
        </div></td>
      <td height="25" valign="top"> 
        <?=$saytext?>
      </td>
      <td height="25" valign="top"><div align="center"> 
          <?=$r['saytime']?>
        </div></td>
      <td height="25" valign="top"><div align="center"> 
          <?=$r[sayip]?>:<?=$r[eipport]?>
        </div></td>
    </tr>
    <?php
	}
	db_close();
	$empire=null;
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center"> 
          <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
        </div></td>
      <td height="25" colspan="4"> <div align="right"> 
          <input type="submit" name="Submit" value="�f�ֵ���" onClick="document.form1.enews.value='CheckPl_all';">
          &nbsp;&nbsp;&nbsp; 
          <input type="submit" name="Submit3" value="���˵���" onClick="document.form1.enews.value='DoGoodPl_all';document.form1.isgood.value='1';">
          &nbsp;&nbsp;&nbsp; 
          <input type="submit" name="Submit4" value="�������˵���" onClick="document.form1.enews.value='DoGoodPl_all';document.form1.isgood.value='0';">
          &nbsp;&nbsp; &nbsp; 
          <input type="submit" name="Submit" value="�R��" onClick="document.form1.enews.value='DelPl_all';">
          <input name="enews" type="hidden" id="enews" value="DelPl_all">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp; </td>
      <td height="25" colspan="4">
        <?=$returnpage?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="5"><font color="#666666">�����G�h��ج��Ŧ�N���f�ֵ��סA�[�ʺ��W���n���|���A�o�G�ɶ����⬰���˵���</font></td>
    </tr>
  </table>
</form>
</body>
</html>
