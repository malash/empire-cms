<?php
require("../../class/connect.php");
$editor=1;
//分類id
$bid=(int)$_GET['bid'];
if(empty($bid))
{
	printerror("EmptyFeedback","",1);
}
require("../../class/db_sql.php");
$link=db_connect();
$empire=new mysqlquery();
$br=$empire->fetch1("select bid,bname,groupid from {$dbtbpre}enewsfeedbackclass where bid='$bid'");
if(empty($br['bid']))
{
	printerror("EmptyFeedback","",1);
}
//權限
if($br['groupid'])
{
	include("../../class/q_functions.php");
	include("../../member/class/user.php");
	$user=islogin();
	include("../../data/dbcache/MemberLevel.php");
	if($level_r[$br[groupid]][level]>$level_r[$user[groupid]][level])
	{
		echo"<script>alert('您的會員級別不足(".$level_r[$br[groupid]][groupname].")，沒有權限提交信息!');history.go(-1);</script>";
		exit();
	}
}
esetcookie("feedbackbid",$bid);
$bname=$br['bname'];
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;信息反饋";
@include("temp/feedback".$bid.".php");
?>