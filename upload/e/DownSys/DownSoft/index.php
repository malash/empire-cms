<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../../member/class/user.php");
require("../../data/dbcache/class.php");
require("../../data/dbcache/MemberLevel.php");
require("../class/DownSysFun.php");
eCheckCloseMods('down');//�����Ҷ�
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
$ecmsreurl=2;
//����IP
eCheckAccessDoIp('downinfo');
$id=(int)$_GET['id'];
$pathid=(int)$_GET['pathid'];
$classid=(int)$_GET['classid'];
if(!$classid||empty($class_r[$classid][tbname])||!$id)
{
	echo"<script>alert('���H�����s�b');window.close();</script>";
	exit();
}
$mid=$class_r[$classid][modid];
$tbname=$class_r[$classid][tbname];
$query="select * from {$dbtbpre}ecms_".$tbname." where id='$id' limit 1";
$r=$empire->fetch1($query);
if(!$r['id']||$r['classid']!=$classid)
{
	echo"<script>alert('���H�����s�b');window.close();</script>";
	exit();
}
//�ƪ�
$finfor=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$r[id]' limit 1");
$r=array_merge($r,$finfor);
//�Ϥ��U���a�}
$path_r=explode("\r\n",$r[downpath]);
if(!$path_r[$pathid])
{
	echo"<script>alert('���H�����s�b');window.close();</script>";
	exit();
}
$showdown_r=explode("::::::",$path_r[$pathid]);
//�U���v��
$user=array();
$downgroup=$showdown_r[2];
if($downgroup)
{
	$user=islogin();
	//���o�|�����
	$u=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$user[userid]' and ".egetmf('rnd')."='$user[rnd]' limit 1");
	if(empty($u['userid']))
	{
		echo"<script>alert('�P�@�b���A�u��@�H�b�u');window.close();</script>";
        exit();
    }
	//�U�����ƭ���
	if($level_r[$u['groupid']]['daydown'])
	{
		$setuserday=DoCheckMDownNum($user['userid'],$u['groupid'],2);
		if($setuserday=='error')
		{
			echo"<script>alert('�z���U���P�[�ݦ��Ƥw�W�L�t�έ���(".$level_r[$u['groupid']]['daydown']." ��)!');window.close();</script>";
			exit();
		}
	}
	if($level_r[$downgroup][level]>$level_r[$u['groupid']][level])
	{
		echo"<script>alert('�z���|���ŧO����(".$level_r[$downgroup][groupname].")�A�S���U�����n���v��!');window.close();</script>";
		exit();
	}
	//�I�ƬO�_����
	if($showdown_r[3])
	{
		//---------�O�_�����v�O��
		$bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$user[userid]' and pathid='$pathid' and online=0 order by truetime desc limit 1");
		if($bakr[id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
		{}
		else
		{
			//�]��d
			if($u['userdate']-time()>0)
			{}
			//�I��
			else
			{
				if($showdown_r[3]>$u['userfen'])
			    {
					echo"<script>alert('�z���I�Ƥ��� $showdown_r[3] �I�A�L�k�U�����n��');window.close();</script>";
					exit();
			    }
			}
		}
	}
}
//�ܶq
$thisdownname=$showdown_r[0];	//��e�U���a�}�W��
$classname=$class_r[$r[classid]]['classname'];	//��ئW
$bclassid=$class_r[$r[classid]]['bclassid'];	//�����ID
$bclassname=$class_r[$bclassid]['classname'];	//����ئW
$titleurl=sys_ReturnBqTitleLink($r);	//�H���챵
$newstime=date('Y-m-d H:i:s',$r['newstime']);
$titlepic=$r['titlepic']?$r['titlepic']:$public_r[newsurl]."e/data/images/notimg.gif";
$ip=egetip();
$pass=md5(ReturnDownSysCheckIp()."wm_chief".$public_r[downpass].$user[userid]);	//���ҽX
$url="../doaction.php?enews=DownSoft&classid=$classid&id=$id&pathid=$pathid&pass=".$pass."&p=".$user[userid].":::".$user[rnd];	//�U���a�}
$trueurl=ReturnDSofturl($showdown_r[1],$showdown_r[4],'../../',1);	//�u����a�}
$fen=$showdown_r[3];	//�U���I��
$downuser=$level_r[$downgroup][groupname];	//�U������
@include('../../data/template/downpagetemp.php');
db_close();
$empire=null;
?>