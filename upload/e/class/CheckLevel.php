<?php
if(!defined('empirecms'))
{
	exit();
}

//��^�v���C��
function ShowViewInfoLevels($groupid){
	global $level_r;
	if(empty($groupid))
	{
		return '�ܤַ|��';
	}
	$r=explode(',',$groupid);
	$count=count($r)-1;
	$groups='';
	$dh='';
	for($i=1;$i<$count;$i++)
	{
		$groups.=$dh.$level_r[$r[$i]][groupname];
		$dh=',';
	}
	return $groups;
}

//��ܴ��ܭ���
function ShowViewInfoMsg($r,$msg){
	global $public_r,$check_path,$level_r,$class_r,$public_diyr;
	//�d���v��
	if(empty($r['userfen']))
	{
		if($class_r[$r[classid]]['cgtoinfo'])//��س]�m
		{
			$ViewLevel="�ݭn [".ShowViewInfoLevels($r['eclass_cgroupid'])."] �ŧO�~��d�ݡC";
		}
		else
		{
			$ViewLevel="�ݭn [".$level_r[$r[groupid]][groupname]."] �ŧO�H�W�~��d�ݡC";
		}
	}
	else
	{
		if($class_r[$r[classid]]['cgtoinfo'])//��س]�m
		{
			$ViewLevel="�ݭn [".ShowViewInfoLevels($r['eclass_cgroupid'])."] �ŧO�P���� ".$r['userfen']." �I�n���~��d�ݡC";
		}
		else
		{
			$ViewLevel="�ݭn [".$level_r[$r[groupid]][groupname]."] �ŧO�H�W�P���� ".$r['userfen']." �I�n���~��d�ݡC";
		}
	}
	$r['title']=stripSlashes($r['title']);
	$public_diyr['pagetitle']=$r['title'];
	$url="<a href='".$public_r[newsurl]."'>����</a>&nbsp;>&nbsp;<a href='".$public_r[newsurl]."e/member/cp/'>�|������</a>&nbsp;>&nbsp;�d�ݫH���G".$r['title'];
	include($check_path."e/data/template/cp_1.php");
	?>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25">���ܫH��</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><?=$msg?></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="2">���D�G
      <?=$r[title]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�d���v���G</td>
    <td height="25">
      <?=$ViewLevel?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="17%" height="25">�o�G�ɶ��G</td>
    <td width="83%" height="25"> 
      <?=date("Y-m-d H:i:s",$r[newstime])?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�H��²���G</td>
    <td height="25"> 
      <?=ReturnTheIntroField($r)?>
    </td>
  </tr>
	</table>
	<?php
	include($check_path."e/data/template/cp_2.php");
	exit();
}

//��^²���r�q
function ReturnTheIntroField($r){
	global $public_r,$class_r,$emod_r,$check_tbname;
	$sublen=120;//�I��120�Ӧr
	$mid=$class_r[$r[classid]]['modid'];
	$smalltextf=$emod_r[$mid]['smalltextf'];
	$stf=$emod_r[$mid]['savetxtf'];
	//²��
	$value='';
	$showf='';
	if($smalltextf&&$smalltextf<>',')
	{
		$smr=explode(',',$smalltextf);
		$smcount=count($smr)-1;
		for($i=1;$i<$smcount;$i++)
		{
			$smf=$smr[$i];
			if($r[$smf])
			{
				$value=$r[$smf];
				$showf=$smf;
				break;
			}
		}
	}
	if(empty($showf))
	{
		$value=strip_tags($r['newstext']);
		$value=esub($value,$sublen);
		$showf='newstext';
	}
	//�s�奻
	if($stf==$showf)
	{
		$value='';
	}
	return stripSlashes($value);
}

//�O�_�n��
function ViewCheckLogin($infor){
	global $empire,$public_r,$ecms_config,$toreturnurl,$gotourl;
	$userid=(int)getcvar('mluserid');
	$rnd=RepPostVar(getcvar('mlrnd'));
	if(!$userid)
	{
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		$msg="�z�٥��n���A<a href='$gotourl'><u>�I���o��</u></a>�i��n���ާ@�F���U��<a href='".$public_r['newsurl']."e/member/register/'><u>�I���o��</u></a>�C";
		ShowViewInfoMsg($infor,$msg);
	}
	$cr=$empire->fetch1("select ".eReturnSelectMemberF('checked,userid,username,groupid,userfen,userdate,zgroupid')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid' and ".egetmf('rnd')."='$rnd' limit 1");
	if(!$cr['userid'])
	{
		EmptyEcmsCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		$msg="�P�@�b���u��@�H�b�u�A<a href='$gotourl'><u>�I���o��</u></a>���s�n���F���U��<a href='".$public_r['newsurl']."e/member/register/'><u>�I���o��</u></a>�C";
		ShowViewInfoMsg($infor,$msg);
	}
	if($cr['checked']==0)
	{
		EmptyEcmsCookie();
		if(!getcvar('returnurl'))
		{
			esetcookie("returnurl",$toreturnurl,0);
		}
		$msg="�z���b���٥��f�ֳq�L�A<a href='$gotourl'><u>�I���o��</u></a>���s�n���F���U��<a href='".$public_r['newsurl']."e/member/register/'><u>�I���o��</u></a>�C";
		ShowViewInfoMsg($infor,$msg);
	}
	//�q�{�|����
	if(empty($cr['groupid']))
	{
		$user_groupid=eReturnMemberDefGroupid();
		$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('groupid')."='$user_groupid' where ".egetmf('userid')."='".$cr[userid]."'");
		$cr['groupid']=$user_groupid;
	}
	//�O�_�L��
	if($cr['userdate'])
	{
		if($cr['userdate']-time()<=0)
		{
			OutTimeZGroup($cr['userid'],$cr['zgroupid']);
			$cr['userdate']=0;
			if($cr['zgroupid'])
			{
				$cr['groupid']=$cr['zgroupid'];
				$cr['zgroupid']=0;
			}
		}
	}
	$re[userid]=$cr['userid'];
	$re[username]=$cr['username'];
	$re[userfen]=$cr['userfen'];
	$re[groupid]=$cr['groupid'];
	$re[userdate]=$cr['userdate'];
	$re[zgroupid]=$cr['zgroupid'];
	return $re;
}

//�d���v�����
function CheckShowNewsLevel($infor){
	global $check_path,$level_r,$empire,$gotourl,$toreturnurl,$public_r,$dbtbpre,$class_r;
	$groupid=$infor['groupid'];
	$userfen=$infor['userfen'];
	$id=$infor['id'];
	$classid=$infor['classid'];
	//�O�_�n��
	$user_r=ViewCheckLogin($infor);
	//�����v��
	if($class_r[$infor[classid]]['cgtoinfo'])//��س]�m
	{
		$checkcr=$empire->fetch1("select cgroupid from {$dbtbpre}enewsclass where classid='$infor[classid]'");
		if($checkcr['cgroupid'])
		{
			if(!strstr($checkcr[cgroupid],','.$user_r[groupid].','))
			{
				$infor['eclass_cgroupid']=$checkcr[cgroupid];
				if(!getcvar('returnurl'))
				{
					esetcookie("returnurl",$toreturnurl,0);
				}
				$msg="�z�S�������v���d�ݦ��H��! <a href='$gotourl'><u>�I���o��</u></a>���s�n���F���U��<a href='".$public_r['newsurl']."e/member/register/'><u>�I���o��</u></a>�C";
				ShowViewInfoMsg($infor,$msg);
			}
		}
	}
	if($groupid)//�H���]�m
	{
		if($level_r[$groupid][level]>$level_r[$user_r[groupid]][level])
		{
			if(!getcvar('returnurl'))
			{
				esetcookie("returnurl",$toreturnurl,0);
			}
			$msg="�z���|���ŧO����(�z����e�ŧO�G".$level_r[$user_r[groupid]][groupname].")�A�S���d�ݦ��H�����v��! <a href='$gotourl'><u>�I���o��</u></a>���s�n���F���U��<a href='".$public_r['newsurl']."e/member/register/'><u>�I���o��</u></a>�C";
			ShowViewInfoMsg($infor,$msg);
		}
	}
	//���I
	if(!empty($userfen))
	{
		//�O�_�����v�O��
		$bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$user_r[userid]' and online=2 order by truetime desc limit 1");
		if($bakr['id']&&(time()-$bakr['truetime']<=$public_r['redoview']*3600))
		{}
		else
		{
			if($user_r[userdate]-time()>0)//�]��
			{}
			else
			{
				if($user_r[userfen]<$userfen)
				{
					if(!getcvar('returnurl'))
					{
						esetcookie("returnurl",$toreturnurl,0);
					}
					$msg="�z���I�Ƥ���(�z��e�֦����I�� ".$user_r[userfen]." �I)�A�S���d�ݦ��H�����v��! <a href='$gotourl'><u>�I���o��</u></a>���s�n���F���U��<a href='".$public_r['newsurl']."e/member/register/'><u>�I���o��</u></a>�C";
					ShowViewInfoMsg($infor,$msg);
				}
				//���I
				$usql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."-".$userfen." where ".egetmf('userid')."='$user_r[userid]'");
			}
			//�ƥ��U���O��
			$utfusername=$user_r['username'];
			BakDown($classid,$id,0,$user_r['userid'],$utfusername,$infor[title],$userfen,2);
		}
	}
}
$check_infoid=(int)$check_infoid;
$check_classid=(int)$check_classid;
if(!defined('PageCheckLevel'))
{
	require_once($check_path.'e/class/connect.php');
	if(!defined('InEmpireCMS'))
	{
		exit();
	}
	require_once(ECMS_PATH.'e/class/db_sql.php');
	require_once(ECMS_PATH.'e/data/dbcache/class.php');
	require_once(ECMS_PATH.'e/data/dbcache/MemberLevel.php');
	$link=db_connect();
	$empire=new mysqlquery();
	$check_tbname=RepPostVar($check_tbname);
	$checkinfor=$empire->fetch1("select * from {$dbtbpre}ecms_".$check_tbname." where id='$check_infoid' limit 1");
	if(!$checkinfor['id']||$checkinfor['classid']!=$check_classid)
	{
		echo"<script>alert('���H�����s�b');history.go(-1);</script>";
		exit();
	}
	//�ƪ�
	$check_mid=$class_r[$checkinfor[classid]]['modid'];
	$checkfinfor=$empire->fetch1("select ".ReturnSqlFtextF($check_mid)." from {$dbtbpre}ecms_".$check_tbname."_data_".$checkinfor[stb]." where id='$checkinfor[id]' limit 1");
	$checkinfor=array_merge($checkinfor,$checkfinfor);
}
else
{
	$check_tbname=RepPostVar($check_tbname);
}
require_once(ECMS_PATH.'e/member/class/user.php');
//����IP
eCheckAccessDoIp('showinfo');
if($checkinfor['groupid']||$class_r[$checkinfor[classid]]['cgtoinfo'])
{
	$toreturnurl=eReturnSelfPage(1);	//��^�����a�}
	$gotourl=$ecms_config['member']['loginurl']?$ecms_config['member']['loginurl']:$public_r['newsurl']."e/member/login/";	//�n���a�}
	CheckShowNewsLevel($checkinfor);
}
if(!defined('PageCheckLevel'))
{
	db_close();
	$empire=null;
}
?>