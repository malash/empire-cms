<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../data/dbcache/class.php");
require "../".LoadLang("pub/fun.php");
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

//�q��]�w
function SetShopDd($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"shopdd");
	$ddid=$add['ddid'];
	$doing=$add['doing'];
	$checked=(int)$add['checked'];
	$haveprice=(int)$add['haveprice'];
	$outproduct=(int)$add['outproduct'];
	$count=count($ddid);
	if(empty($count))
	{
		printerror("NotSetDdid","history.go(-1)");
	}
	$shoppr=ShopSys_hReturnSet();
	$add='';
	$ids='';
	$dh='';
	for($i=0;$i<$count;$i++)
	{
		$ddid[$i]=(int)$ddid[$i];
		$ids.=$dh.$ddid[$i];
		$dh=',';
    }
	$add='ddid in ('.$ids.')';
	$mess='ErrorUrl';
	$log='';
	if($doing==1)	//�q�檬�A
	{
		$sql=$empire->query("update {$dbtbpre}enewsshopdd set checked='$checked' where ".$add);
		$mess="SetCheckedSuccess";
		$log="doing=$doing&do=SetChecked&checked=$checked<br>ddid=$ids";
		//�q���x
		$log_ecms='SetChecked';
		$log_bz='';
		if($checked==1)
		{
			$log_addbz='�T�{';
		}
		elseif($checked==2)
		{
			$log_addbz='����';
		}
		elseif($checked==3)
		{
			$log_addbz='�h�f';
		}
		elseif($checked==0)
		{
			$log_addbz='���T�{';
		}
		//�g�J�q���x
		if($ids)
		{
			$logsql=$empire->query("select ddid,havecutnum from {$dbtbpre}enewsshopdd where ".$add);
			while($logr=$empire->fetch($logsql))
			{
				ShopSys_DdInsertLog($logr['ddid'],$log_ecms,$log_bz,$log_addbz);//�q���x
				//�w�s
				if($shoppr['cutnumtype']==0&&$checked==2&&$logr['havecutnum'])
				{
					$ddaddr=$empire->fetch1("select buycar from {$dbtbpre}enewsshopdd_add where ddid='$logr[ddid]'");
					Shopsys_hCutMaxnum($logr['ddid'],$ddaddr['buycar'],$logr['havecutnum'],$shoppr,1);
				}
			}
		}
    }
	elseif($doing==2)	//�o�f���A
	{
		$sql=$empire->query("update {$dbtbpre}enewsshopdd set outproduct='$outproduct' where ".$add);
		$mess="SetOutProductSuccess";
		$log="doing=$doing&do=SetOutProduct&outproduct=$outproduct<br>ddid=$ids";
		//�q���x
		$log_ecms='SetOutProduct';
		$log_bz='';
		if($outproduct==1)
		{
			$log_addbz='�w�o�f';
		}
		elseif($outproduct==2)
		{
			$log_addbz='�Ƴf��';
		}
		elseif($outproduct==0)
		{
			$log_addbz='���o�f';
		}
		//�g�J�q���x
		if($ids)
		{
			$logsql=$empire->query("select ddid from {$dbtbpre}enewsshopdd where ".$add);
			while($logr=$empire->fetch($logsql))
			{
				ShopSys_DdInsertLog($logr['ddid'],$log_ecms,$log_bz,$log_addbz);//�q���x
			}
		}
    }
	elseif($doing==3)	//�I�ڪ��A
	{
		$sql=$empire->query("update {$dbtbpre}enewsshopdd set haveprice='$haveprice' where ".$add);
		$mess="SetHavepriceSuccess";
		$log="doing=$doing&do=SetHaveprice&haveprice=$haveprice<br>ddid=$ids";
		//�q���x
		$log_ecms='SetHaveprice';
		$log_bz='';
		if($haveprice==1)
		{
			$log_addbz='�w�I��';
		}
		elseif($haveprice==0)
		{
			$log_addbz='���I��';
		}
		//�g�J�q���x
		if($ids)
		{
			$logsql=$empire->query("select ddid,havecutnum from {$dbtbpre}enewsshopdd where ".$add);
			while($logr=$empire->fetch($logsql))
			{
				ShopSys_DdInsertLog($logr['ddid'],$log_ecms,$log_bz,$log_addbz);//�q���x
				//�w�s
				if($shoppr['cutnumtype']==1&&$haveprice==1&&!$logr['havecutnum'])
				{
					$ddaddr=$empire->fetch1("select buycar from {$dbtbpre}enewsshopdd_add where ddid='$logr[ddid]'");
					Shopsys_hCutMaxnum($logr['ddid'],$ddaddr['buycar'],$logr['havecutnum'],$shoppr,0);
				}
			}
		}
    }
	elseif($doing==4)	//�R���q��
	{
		$log_ecms='DelDd';
		$log_bz='';
		$log_addbz='';
		//�w�s
		if($ids)
		{
			$logsql=$empire->query("select ddid,havecutnum,checked,haveprice from {$dbtbpre}enewsshopdd where ".$add." and havecutnum=1");
			while($logr=$empire->fetch($logsql))
			{
				if($logr['haveprice']==1)
				{
					continue;
				}
				if($logr['havecutnum'])
				{
					$ddaddr=$empire->fetch1("select buycar from {$dbtbpre}enewsshopdd_add where ddid='$logr[ddid]'");
					Shopsys_hCutMaxnum($logr['ddid'],$ddaddr['buycar'],$logr['havecutnum'],$shoppr,1);
				}
			}
		}
		$sql=$empire->query("delete from {$dbtbpre}enewsshopdd where ".$add);
		$sql2=$empire->query("delete from {$dbtbpre}enewsshopdd_add where ".$add);
		$sql3=$empire->query("delete from {$dbtbpre}enewsshop_ddlog where ".$add);
		$mess="DelDdSuccess";
		$log="doing=$doing&do=DelDd<br>ddid=$ids";
    }
	else
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	if($sql)
	{
		//�ާ@��x
		insert_dolog($log);
		printerror($mess,$_SERVER['HTTP_REFERER']);
	}
	else
	{printerror("DbError","history.go(-1)");}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="SetShopDd")
{
	SetShopDd($_POST,$logininid,$loginin);
}
else
{}

//��s�w�s
$shoppr=ShopSys_hReturnSet();
ShopSys_hTimeCutMaxnum(0,$shoppr);

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//�C����ܱ���
$page_line=18;//�C������챵��
$offset=$page*$line;//�`�����q
$totalquery="select count(*) as total from {$dbtbpre}enewsshopdd";
$query="select ddid,ddno,ddtime,userid,username,outproduct,haveprice,checked,truename,psid,psname,pstotal,alltotal,payfsid,payfsname,payby,alltotalfen,fp,fptotal,pretotal from {$dbtbpre}enewsshopdd";
$add='';
$and=' where ';
//�j��
$sear=RepPostStr($_GET['sear'],1);
if($sear)
{
	$keyboard=$_GET['keyboard'];
	$keyboard=RepPostVar2($keyboard);
	if($keyboard)
	{
		$show=(int)$_GET['show'];
		if($show==1)//�j���q�渹
		{
			$add=$and."ddno like '%$keyboard%'";
		}
		elseif($show==2)//�Τ�W
		{
			$add=$and."username like '%$keyboard%'";
		}
		elseif($show==3)//�m�W
		{
			$add=$and."truename like '%$keyboard%'";
		}
		elseif($show==4)//�l�c
		{
			$add=$and."email like '%$keyboard%'";
		}
		else//�a�}
		{
			$add=$and."address like '%$keyboard%'";
		}
		$and=' and ';
	}
	//�q�檬�A
	$checked=(int)$_GET['checked'];
	if($checked==1)//�w�T�{
	{
		$add.=$and."checked=1";
		$and=' and ';
	}
	elseif($checked==9)//���T�{
	{
		$add.=$and."checked=0";
		$and=' and ';
	}
	elseif($checked==2)//����
	{
		$add.=$and."checked=2";
		$and=' and ';
	}
	elseif($checked==3)//�h�f
	{
		$add.=$and."checked=3";
		$and=' and ';
	}
	//�O�_�I��
	$haveprice=(int)$_GET['haveprice'];
	if($haveprice==1)//�w�I��
	{
		$add.=$and."haveprice=1";
		$and=' and ';
	}
	elseif($haveprice==9)//���I��
	{
		$add.=$and."haveprice=0";
		$and=' and ';
	}
	//�O�_�o�f
	$outproduct=(int)$_GET['outproduct'];
	if($outproduct==1)//�w�o�f
	{
		$add.=$and."outproduct=1";
		$and=' and ';
	}
	elseif($outproduct==9)//���o�f
	{
		$add.=$and."outproduct=0";
		$and=' and ';
	}
	elseif($outproduct==2)//�Ƴf��
	{
		$add.=$and."outproduct=2";
		$and=' and ';
	}
	//�ɶ�
	$starttime=RepPostVar($_GET['starttime']);
	$endtime=RepPostVar($_GET['endtime']);
	if($endtime!="")
	{
		$ostarttime=$starttime." 00:00:00";
		$oendtime=$endtime." 23:59:59";
		$add.=$and."ddtime>='$ostarttime' and ddtime<='$oendtime'";
		$and=' and ';
	}
	$search.="&sear=1&keyboard=$keyboard&show=$show&checked=$checked&outproduct=$outproduct&haveprice=$haveprice&starttime=$starttime&endtime=$endtime";
}
//�Ƨ�
$myorder=(int)$_GET['myorder'];
if($myorder==2)//�ӫ~���B
{
	$orderby='alltotal desc';
}
elseif($myorder==3)
{
	$orderby='alltotal asc';
}
elseif($myorder==4)//�ӫ~�I��
{
	$orderby='alltotalfen desc';
}
elseif($myorder==5)
{
	$orderby='alltotalfen asc';
}
elseif($myorder==6)//�u�f���B
{
	$orderby='pretotal desc';
}
elseif($myorder==7)
{
	$orderby='pretotal asc';
}
elseif($myorder==1)//�q��ɶ�
{
	$orderby='ddid asc';
}
else
{
	$orderby='ddid desc';
}
$totalquery.=$add;
$query.=$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by ".$orderby." limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�޲z�q��</title>
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
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<a href="ListDd.php<?=$ecms_hashur['whehref']?>">�޲z�q��</a></td>
  </tr>
</table>

  
<form name="form1" method="get" action="ListDd.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td>�j��: <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>"> 
        <select name="show" id="show">
          <option value="1"<?=$show==1?' selected':''?>>�q�渹</option>
          <option value="2"<?=$show==2?' selected':''?>>�Τ�W</option>
		  <option value="3"<?=$show==3?' selected':''?>>���f�H�m�W</option>
		  <option value="4"<?=$show==4?' selected':''?>>���f�H�l�c</option>
		  <option value="5"<?=$show==5?' selected':''?>>���f�H�a�}</option>
        </select> 
        <select name="checked" id="checked">
          <option value="0"<?=$checked==0?' selected':''?>>�����q�檬�A</option>
          <option value="1"<?=$checked==1?' selected':''?>>�w�T�{</option>
          <option value="9"<?=$checked==9?' selected':''?>>���T�{</option>
		  <option value="2"<?=$checked==2?' selected':''?>>����</option>
		  <option value="3"<?=$checked==3?' selected':''?>>�h�f</option>
        </select> 
        <select name="outproduct" id="outproduct">
          <option value="0"<?=$outproduct==0?' selected':''?>>�����o�f���A</option>
          <option value="1"<?=$outproduct==1?' selected':''?>>�w�o�f</option>
          <option value="9"<?=$outproduct==9?' selected':''?>>���o�f</option>
		  <option value="2"<?=$outproduct==2?' selected':''?>>�Ƴf��</option>
        </select>
        <select name="haveprice" id="haveprice">
          <option value="0"<?=$haveprice==0?' selected':''?>>�����I�ڪ��A</option>
          <option value="1"<?=$haveprice==1?' selected':''?>>�w�I��</option>
          <option value="9"<?=$haveprice==9?' selected':''?>>���I��</option>
        </select>
        <select name="myorder" id="myorder">
          <option value="0"<?=$myorder==0?' selected':''?>>�q��ɶ�����</option>
          <option value="1"<?=$myorder==1?' selected':''?>>�q��ɶ��ɧ�</option>
          <option value="2"<?=$myorder==2?' selected':''?>>�ӫ~���B����</option>
          <option value="3"<?=$myorder==3?' selected':''?>>�ӫ~���B�ɧ�</option>
          <option value="4"<?=$myorder==4?' selected':''?>>�ӫ~�I�ƭ���</option>
          <option value="5"<?=$myorder==5?' selected':''?>>�ӫ~�I�Ƥɧ�</option>
          <option value="6"<?=$myorder==6?' selected':''?>>�u�f���B�ɧ�</option>
          <option value="7"<?=$myorder==7?' selected':''?>>�u�f���B����</option>
        </select></td>
    </tr>
    <tr>
      <td>�ɶ�:�q 
        <input name="starttime" type="text" id="starttime2" value="<?=$starttime?>" size="12" onclick="setday(this)">
        �� 
        <input name="endtime" type="text" id="endtime2" value="<?=$endtime?>" size="12" onclick="setday(this)">
        ��q�� 
        <input type="submit" name="Submit6" value="�j��"> <input name="sear" type="hidden" id="sear2" value="1"></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
  <form name="listdd" method="post" action="ListDd.php" onsubmit="return confirm('�T�{�n�ާ@?');">
  <?=$ecms_hashur['form']?>
    <input type=hidden name=enews value=SetShopDd>
    <input type=hidden name=doing value=0>
    <tr class=header> 
      <td width="5%" height="23"> <div align="center">���</div></td>
      <td width="19%"><div align="center">�s��(�I���d��)</div></td>
      <td width="21%"><div align="center">�q�ʮɶ�</div></td>
      <td width="13%"><div align="center">�q�ʪ�</div></td>
      <td width="11%"><div align="center">�`���B</div></td>
      <td width="12%"><div align="center">��I�覡</div></td>
      <td width="19%"><div align="center">���A</div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		if(empty($r[userid]))//�D�|��
		{
			$username="<font color=cccccc>".$r[truename]."</font>";
		}
		else
		{
			$username="<a href='../member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target=_blank>".$r[username]."</a>";
		}
		//�I���ʶR
		$total=0;
		if($r[payby]==1)
		{
			$total=$r[alltotalfen]+$r[pstotal];
			$mytotal="<a href='#ecms' title='�ӫ~�B(".$r[alltotalfen].")+�B�O(".$r[pstotal].")'>".$total." �I</a>";
		}
		else
		{
			//�o��
			$fpa='';
			$pre='';
			if($r[fp])
			{
				$fpa="+�o���O(".$r[fptotal].")";
			}
			//�u�f
			if($r['pretotal'])
			{
				$pre="-�u�f(".$r[pretotal].")";
			}
			$total=$r[alltotal]+$r[pstotal]+$r[fptotal]-$r[pretotal];
			$mytotal="<a href='#ecms' title='�ӫ~�B(".$r[alltotal].")+�B�O(".$r[pstotal].")".$fpa.$pre."'>".$total." ��</a>";
		}
		//��I�覡
		if($r[payby]==1)
		{
			$payfsname=$r[payfsname]."<br>(�I���ʶR)";
		}
		elseif($r[payby]==2)
		{
			$payfsname=$r[payfsname]."<br>(�l�B�ʶR)";
		}
		else
		{
			$payfsname=$r[payfsname];
		}
		//�q�檬�A
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
		//�o�f���A
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
		//�I�ڪ��A
		if($r['haveprice']==1)
		{
			$ha="�w�I��";
		}
		else
		{
			$ha="<font color=red>���I��</font>";
		}
	?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"> <div align="center"> 
          <input name="ddid[]" type="checkbox" id="ddid[]" value="<?=$r[ddid]?>">
        </div></td>
      <td> <div align="center"><a href="#ecms" onclick="window.open('ShowDd.php?ddid=<?=$r[ddid]?><?=$ecms_hashur['ehref']?>','','width=700,height=600,scrollbars=yes,resizable=yes');">
          <?=$r[ddno]?>
          </a></div></td>
      <td> <div align="center">
          <?=$r[ddtime]?>
        </div></td>
      <td> <div align="center">
          <?=$username?>
        </div></td>
      <td> <div align="center">
          <?=$mytotal?>
        </div></td>
      <td><div align="center">
          <?=$payfsname?>
        </div></td>
      <td> <div align="center"><strong><?=$ha?></strong>/<strong><?=$ou?></strong>/<strong><?=$ch?></strong></div></td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td> <div align="center"> 
          <input type=checkbox name=chkall value=on onClick='CheckAll(this.form)'>
        </div></td>
      <td colspan="6"><select name="checked" id="checked">
        <option value="1">�T�{</option>
        <option value="2">����</option>
        <option value="3">�h�f</option>
        <option value="0">���T�{</option>
      </select>
      <input type="submit" name="Submit" value="�]�m�q�檬�A" onClick="document.listdd.doing.value='1';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';"> 
        &nbsp;
        <select name="outproduct" id="outproduct">
          <option value="1">�w�o�f</option>
          <option value="2">�Ƴf��</option>
          <option value="0">���o�f</option>
        </select> 
        <input type="submit" name="Submit2" value="�]�m�o�f���A" onClick="document.listdd.doing.value='2';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';"> 
        &nbsp;
        <select name="haveprice" id="haveprice">
          <option value="1">�w�I��</option>
          <option value="0">���I��</option>
        </select> 
        <input type="submit" name="Submit3" value="�]�m�I�ڪ��A" onClick="document.listdd.doing.value='3';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';">
&nbsp;
<select name="cutmaxnum" id="cutmaxnum">
  <option value="1">�٭�w�s</option>
  <option value="0">��֮w�s</option>
</select>
<input type="submit" name="Submit32" value="�]�m�w�s" onClick="document.listdd.doing.value='5';document.listdd.enews.value='DoCutMaxnum';document.listdd.action='ecmsshop.php';">
        &nbsp; 
		<input type="submit" name="Submit5" value="�R���q��" onClick="document.listdd.doing.value='4';document.listdd.enews.value='SetShopDd';document.listdd.action='ListDd.php';"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td> <div align="center"></div></td>
      <td colspan="6"> <div align="left">&nbsp;
          <?=$returnpage?>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>&nbsp;</td>
      <td colspan="6"><font color="#666666">�q�ʪ̬��Ǧ�,�h���D�|���ʶR�F�h�f���۰��٭�w�s�A�ݤ���٭�w�s�F�w�٭�L���w�s�t�Τ��|�����٭�C</font></td>
    </tr>
  </form>
</table>

</body>
</html>
<?php
db_close();
$empire=null;
?>
