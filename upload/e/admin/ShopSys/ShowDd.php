<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/hShopSysFun.php");
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
CheckLevel($logininid,$loginin,$classid,"shopdd");
$enews=ehtmlspecialchars($_GET['enews']);
$url="�d�ݭq��";
$ddid=(int)$_GET['ddid'];
if(!$ddid)
{
	printerror('ErrorUrl','');
}
$r=$empire->fetch1("select * from {$dbtbpre}enewsshopdd where ddid='$ddid'");
if(!$r['ddid'])
{
	printerror('ErrorUrl','');
}
$addr=$empire->fetch1("select * from {$dbtbpre}enewsshopdd_add where ddid='$ddid'");
//�����
if(empty($r[userid]))//�D�|��
{
	$username="<font color=cccccc>�C��</font>";
}
else
{
	$username="<a href='../member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target=_blank>".$r[username]."</a>";
}
//�ݭn�o��
$fp="�_";
if($r[fp])
{
	$fp="�O";
}
//���B
$total=0;
if($r[payby]==1)
{
	$pstotal=$r[pstotal]." �I";
	$alltotal=$r[alltotalfen]." �I";
	$total=$r[pstotal]+$r[alltotalfen];
	$mytotal=$total." �I";
}
else
{
	$pstotal=$r[pstotal]." ��";
	$alltotal=$r[alltotal]." ��";
	$total=$r[pstotal]+$r[alltotal]+$r[fptotal]-$r[pretotal];
	$mytotal=$total." ��";
}
//��I�覡
if($r[payby]==1)
{
	$payfsname=$r[payfsname]."(�n���ʶR)";
}
elseif($r[payby]==2)
{
	$payfsname=$r[payfsname]."(�l�B�ʶR)";
}
else
{
	$payfsname=$r[payfsname];
}
//���A
if($r['checked']==1)
{
	$ch="�w�T�{";
}
elseif($r['checked']==2)
{
	$ch="����";
}
elseif($r['checked']==3)
{
	$ch="�h�f";
}
else
{
	$ch="<font color=red>���T�{</font>";
}
//�o�f
if($r['outproduct']==1)
{
	$ou="�w�o�f";
}
elseif($r['outproduct']==2)
{
	$ou="�Ƴf��";
}
else
{
	$ou="<font color=red>���o�f</font>";
}
if($r['haveprice']==1)
{
	$ha="�w�I��";
}
else
{
	$ha="<font color=red>���I��</font>";
}
//��ܰӫ~�H��
function ShowBuyproduct($buycar,$payby){
	global $empire,$dbtbpre;
	$record="!";
	$field="|";
	$buycarr=explode($record,$buycar);
	$bcount=count($buycarr);
	$totalmoney=0;
	$totalfen=0;
	?>
	<table width='100%' border=0 align=center cellpadding=3 cellspacing=1>
        <tr class='header'> 
            <td width='9%' height=23> <div align=center>�Ǹ�</div></td>
            <td width='42%'> <div align=center>�ӫ~�W��</div></td>
            <td width='15%'> <div align=center>���</div></td>
            <td width='10%'> <div align=center>�ƶq</div></td>
            <td width='19%'> <div align=center>�p�p</div></td>
        </tr>
	<?php
	$j=0;
	for($i=0;$i<$bcount-1;$i++)
	{
		$j++;
		$pr=explode($field,$buycarr[$i]);
		$productid=$pr[1];
		$fr=explode(",",$pr[1]);
		//ID
		$classid=(int)$fr[0];
		$id=(int)$fr[1];
		//�ݩ�
		$addatt='';
		if($pr[2])
		{
			$addatt=$pr[2];
		}
		//�ƶq
		$pnum=(int)$pr[3];
		if(empty($pnum))
		{
			$pnum=1;
		}
		//���
		$price=$pr[4];
		$thistotal=$price*$pnum;
		$buyfen=$pr[5];
		$thistotalfen=$buyfen*$pnum;
		if($payby==1)
		{
			$showprice=$buyfen." �I";
			$showthistotal=$thistotalfen." �I";
		}
		else
		{
			$showprice=$price." ��";
			$showthistotal=$thistotal." ��";
		}
		//���~�W��
		$title=stripSlashes($pr[6]);
		//��^�챵
		$titleurl="../../public/InfoUrl/?classid=$classid&id=$id";
		$totalmoney+=$thistotal;
		$totalfen+=$thistotalfen;
		?>
		<tr>
	<td align=center><?=$j?></td>
	<td align=center><a href="<?=$titleurl?>" target="_blank"><?=$title?></a><?=$addatt?' - '.$addatt:''?></td>
	<td align=right><b>�D<?=$showprice?></b></td>
	<td align=right><?=$pnum?></td>
	<td align=right><?=$showthistotal?></td>
	</tr>
		<?php
    }
	//�I�ƥI�O
	if($payby==1)
	{
		?>
	<tr> 
      <td colspan=5><div align=right>�X�p�I��:<strong><?=$totalfen?></strong></div></td>
      <td>&nbsp;</td>
    </tr>
		<?php
	}
	else
	{
		?>
	<tr> 
      <td colspan=5><div align=right>�X�p:<strong>�D<?=$totalmoney?></strong></div></td>
      <td>&nbsp;</td>
    </tr>
		<?php
	}
	?>
	</table>
	<?php
}

//------ �ާ@��x ------
//�ާ@�ƥ�

$shopecms_r=array
(
	'SetChecked'=>'�]�m�q�檬�A',
	'SetOutProduct'=>'�]�m�o�f���A',
	'SetHaveprice'=>'�]�m�I�ڪ��A',
	'DelDd'=>'�R���q��',
	'EditPretotal'=>'�ק��u�f���B',
	'DdRetext'=>'�ק��x�q��Ƶ�',
	'DoCutMaxnum'=>'�]�m�w�s',
);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�d�ݭq��</title>
<script>
function PrintDd()
{
	pdiv.style.display="none";
	window.print();
}
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
<form name="showddform" id="showddform" method="post" action="ecmsshop.php" onsubmit="return confirm('�T�{�n�ާ@?');">
<?=$ecms_hashur['form']?>
  <input name="enews" type="hidden" id="enews" value="DdRetext">
  <input name="ddid" type="hidden" id="ddid" value="<?=$ddid?>">
  <tr> 
    <td width="61%" height="27" bgcolor="#FFFFFF"><strong>�q��ID: 
      <?=$r[ddno]?>
      </strong></td>
    <td width="39%" bgcolor="#FFFFFF"><strong>�U��ɶ�: 
      <?=$r[ddtime]?>
      </strong></td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>�ӫ~�H��</strong></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <?php
	  ShowBuyproduct($addr[buycar],$r[payby]);
	  ?>    </td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>�q��H��</strong></td>
  </tr>
  <tr> 
    <td height="23" colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        
        <tr>
          <td height="25"><div align="right">����̡G</div></td>
          <td><?=$username?></td>
          <td><div align="right">�����IP�a�}�G</div></td>
          <td><strong>
            <?=$r[userip]?>
          </strong></td>
        </tr>
        <tr> 
          <td width="15%" height="25"> 
            <div align="right">�q�渹�G</div></td>
          <td width="35%"><strong> 
            <?=$r[ddno]?>
            </strong></td>
          <td width="15%"><div align="right">�q�檬�A�G</div></td>
          <td width="35%"><strong> 
            <?=$ha?>
            </strong>/<strong> 
            <?=$ou?>
            </strong>/<strong> 
            <?=$ch?>
            </strong></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">�U��ɶ��G</div></td>
          <td><strong> 
            <?=$r[ddtime]?>
            </strong></td>
          <td><div align="right">�ӫ~�`���B�G</div></td>
          <td><strong>
            <?=$alltotal?>
            </strong></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">�t�e�覡�G</div></td>
          <td><strong>
            <?=$r[psname]?>
            </strong></td>
          <td><div align="right">+ �ӫ~�B�O�G</div></td>
          <td><strong>
            <?=$pstotal?>
            </strong></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">��I�覡�G</div></td>
          <td><strong>
            <?=$payfsname?>
            </strong></td>
          <td><div align="right">+ �o���O�ΡG</div></td>
          <td><?=$r[fptotal]?></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">�ݭn�o���G</div></td>
          <td><?=$fp?></td>
          <td><div align="right">- �u�f�G</div></td>
          <td><?=$r[pretotal]?></td>
        </tr>
        <tr> 
          <td height="25"> 
            <div align="right">�o�����Y�G</div></td>
          <td><strong> 
            <?=$r[fptt]?>
            </strong></td>
          <td><div align="right">�q���`���B�G</div></td>
          <td><strong>
            <?=$mytotal?>
          </strong></td>
        </tr>
        <tr>
          <td height="25"><div align="right">�o���W�١G</div></td>
          <td colspan="3"><strong>
            <?=$r[fpname]?>
          </strong></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>���f�H�H��</strong></td>
  </tr>
  <tr> 
    <td colspan="2"><table width="100%%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="20%" height="25">�u��m�W:</td>
          <td width="80%"> 
            <?=$r[truename]?>          </td>
        </tr>
        <tr> 
          <td height="25">QQ:</td>
          <td> 
            <?=$r[oicq]?>          </td>
        </tr>
        <tr> 
          <td height="25">MSN:</td>
          <td> 
            <?=$r[msn]?>          </td>
        </tr>
        <tr> 
          <td height="25">�T�w�q��:</td>
          <td> 
            <?=$r[mycall]?>          </td>
        </tr>
        <tr> 
          <td height="25">���:</td>
          <td> 
            <?=$r[phone]?>          </td>
        </tr>
        <tr> 
          <td height="25">�pô�l�c:</td>
          <td> 
            <?=$r[email]?>          </td>
        </tr>
        <tr> 
          <td height="25">�pô�a�}:</td>
          <td> 
            <?=$r[address]?>          </td>
        </tr>
        <tr> 
          <td height="25">�l�s:</td>
          <td> 
            <?=$r[zip]?>          </td>
        </tr>
        <tr>
          <td height="25">�лx�ؿv:</td>
          <td><?=$r[signbuild]?></td>
        </tr>
        <tr>
          <td height="25">�̨ΰe�f�ɶ�:</td>
          <td><?=$r[besttime]?></td>
        </tr>
        <tr> 
          <td height="25">�Ƶ�:</td>
          <td> 
            <?=nl2br($addr[bz])?>          </td>
        </tr>
      </table></td>
  </tr>
  <tbody id="pdiv">
  <tr>
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>�����ާ@</strong></td>
  </tr>
  <tr>
    <td height="23" colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="16%">��x�Ƶ����e:<br>
          <br>
          <font color="#666666">(�e�x�|���i�d�ݡA��p���ѧֻ������H��)</font></td>
        <td width="77%"><textarea name="retext" cols="65" rows="6" id="retext"><?=$addr['retext']?></textarea></td>
        <td width="7%"><input type="submit" name="Submit2" value="����" onClick="document.showddform.enews.value='DdRetext';"></td>
      </tr>
      <tr>
        <td height="25">�ק��u�f���B�G</td>
        <td><input name="pretotal" type="text" id="pretotal" value="<?=$r[pretotal]?>">
        �ק��]�G
          <input name="bz" type="text" id="bz"></td>
        <td><input type="submit" name="Submit3" value="����" onClick="document.showddform.enews.value='EditPretotal';"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="23" colspan="2" bgcolor="#EFEFEF"><strong>�q��ާ@��x</strong></td>
  </tr>
  <tr>
    <td height="23" colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="3" class="tableborder">
      <tr class="header">
        <td width="21%" height="23"><div align="center">�ާ@�ɶ�</div></td>
        <td width="17%"><div align="center">�ާ@��</div></td>
        <td width="19%"><div align="center">�ƥ�</div></td>
        <td width="19%"><div align="center">�ާ@���e</div></td>
        <td width="24%"><div align="center">�ާ@��]</div></td>
      </tr>
	  <?php
	  $logsql=$empire->query("select logid,userid,username,ecms,bz,addbz,logtime from {$dbtbpre}enewsshop_ddlog where ddid='$ddid' order by logid desc");
	  while($logr=$empire->fetch($logsql))
	  {
		  $empirecms=$shopecms_r[$logr['ecms']];
		  if($logr['ecms']=='DoCutMaxnum')
		  {
			  $logr['addbz']=$logr['addbz']=='ecms=1'?'�٭�w�s':'��֮w�s';
		  }
	  ?>
      <tr bgcolor="#ffffff">
        <td height="23"><div align="center"><?=$logr['logtime']?></div></td>
        <td><div align="center"><?=$logr['username']?></div></td>
        <td><div align="center"><?=$empirecms?></div></td>
        <td><?=$logr['addbz']?></td>
        <td><?=$logr['bz']?></td>
      </tr>
      <?php
	  }
	  ?>
    </table></td>
  </tr>
  <tr> 
    <td colspan="2"><div align="center"> 
        <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td><div align="center">
                <input type="button" name="Submit" value=" �� �L " onclick="javascript:PrintDd();">
              </div></td>
          </tr>
        </table>
      </div></td>
  </tr>
  </tbody>
 </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>