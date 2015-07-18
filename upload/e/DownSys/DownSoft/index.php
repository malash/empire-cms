<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../../member/class/user.php");
require("../../data/dbcache/class.php");
require("../../data/dbcache/MemberLevel.php");
require("../class/DownSysFun.php");
eCheckCloseMods('down');//關閉模塊
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
$ecmsreurl=2;
//驗證IP
eCheckAccessDoIp('downinfo');
$id=(int)$_GET['id'];
$pathid=(int)$_GET['pathid'];
$classid=(int)$_GET['classid'];
if(!$classid||empty($class_r[$classid][tbname])||!$id)
{
	echo"<script>alert('此信息不存在');window.close();</script>";
	exit();
}
$mid=$class_r[$classid][modid];
$tbname=$class_r[$classid][tbname];
$query="select * from {$dbtbpre}ecms_".$tbname." where id='$id' limit 1";
$r=$empire->fetch1($query);
if(!$r['id']||$r['classid']!=$classid)
{
	echo"<script>alert('此信息不存在');window.close();</script>";
	exit();
}
//副表
$finfor=$empire->fetch1("select ".ReturnSqlFtextF($mid)." from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$r[id]' limit 1");
$r=array_merge($r,$finfor);
//區分下載地址
$path_r=explode("\r\n",$r[downpath]);
if(!$path_r[$pathid])
{
	echo"<script>alert('此信息不存在');window.close();</script>";
	exit();
}
$showdown_r=explode("::::::",$path_r[$pathid]);
//下載權限
$user=array();
$downgroup=$showdown_r[2];
if($downgroup)
{
	$user=islogin();
	//取得會員資料
	$u=$empire->fetch1("select ".eReturnSelectMemberF('*')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$user[userid]' and ".egetmf('rnd')."='$user[rnd]' limit 1");
	if(empty($u['userid']))
	{
		echo"<script>alert('同一帳號，只能一人在線');window.close();</script>";
        exit();
    }
	//下載次數限制
	if($level_r[$u['groupid']]['daydown'])
	{
		$setuserday=DoCheckMDownNum($user['userid'],$u['groupid'],2);
		if($setuserday=='error')
		{
			echo"<script>alert('您的下載與觀看次數已超過系統限制(".$level_r[$u['groupid']]['daydown']." 次)!');window.close();</script>";
			exit();
		}
	}
	if($level_r[$downgroup][level]>$level_r[$u['groupid']][level])
	{
		echo"<script>alert('您的會員級別不足(".$level_r[$downgroup][groupname].")，沒有下載此軟件的權限!');window.close();</script>";
		exit();
	}
	//點數是否足夠
	if($showdown_r[3])
	{
		//---------是否有歷史記錄
		$bakr=$empire->fetch1("select id,truetime from {$dbtbpre}enewsdownrecord where id='$id' and classid='$classid' and userid='$user[userid]' and pathid='$pathid' and online=0 order by truetime desc limit 1");
		if($bakr[id]&&(time()-$bakr[truetime]<=$public_r[redodown]*3600))
		{}
		else
		{
			//包月卡
			if($u['userdate']-time()>0)
			{}
			//點數
			else
			{
				if($showdown_r[3]>$u['userfen'])
			    {
					echo"<script>alert('您的點數不足 $showdown_r[3] 點，無法下載此軟件');window.close();</script>";
					exit();
			    }
			}
		}
	}
}
//變量
$thisdownname=$showdown_r[0];	//當前下載地址名稱
$classname=$class_r[$r[classid]]['classname'];	//欄目名
$bclassid=$class_r[$r[classid]]['bclassid'];	//父欄目ID
$bclassname=$class_r[$bclassid]['classname'];	//父欄目名
$titleurl=sys_ReturnBqTitleLink($r);	//信息鏈接
$newstime=date('Y-m-d H:i:s',$r['newstime']);
$titlepic=$r['titlepic']?$r['titlepic']:$public_r[newsurl]."e/data/images/notimg.gif";
$ip=egetip();
$pass=md5(ReturnDownSysCheckIp()."wm_chief".$public_r[downpass].$user[userid]);	//驗證碼
$url="../doaction.php?enews=DownSoft&classid=$classid&id=$id&pathid=$pathid&pass=".$pass."&p=".$user[userid].":::".$user[rnd];	//下載地址
$trueurl=ReturnDSofturl($showdown_r[1],$showdown_r[4],'../../',1);	//真實文件地址
$fen=$showdown_r[3];	//下載點數
$downuser=$level_r[$downgroup][groupname];	//下載等級
@include('../../data/template/downpagetemp.php');
db_close();
$empire=null;
?>