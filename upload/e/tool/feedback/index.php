<?php
require("../../class/connect.php");
$editor=1;
//����id
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
//�v��
if($br['groupid'])
{
	include("../../class/q_functions.php");
	include("../../member/class/user.php");
	$user=islogin();
	include("../../data/dbcache/MemberLevel.php");
	if($level_r[$br[groupid]][level]>$level_r[$user[groupid]][level])
	{
		echo"<script>alert('�z���|���ŧO����(".$level_r[$br[groupid]][groupname].")�A�S���v������H��!');history.go(-1);</script>";
		exit();
	}
}
esetcookie("feedbackbid",$bid);
$bname=$br['bname'];
$url="<a href=../../../>����</a>&nbsp;>&nbsp;�H�����X";
@include("temp/feedback".$bid.".php");
?>