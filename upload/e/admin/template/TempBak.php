<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//喷靡ノめ
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();

$temptype=RepPostVar($_GET['temptype']);
$gid=(int)$_GET['gid'];
if(!$gid)
{
	$gid=GetDoTempGid();
}
if($temptype=='indexpage')
{
	$gid=1;
}
$tempid=(int)$_GET['tempid'];
if(!$temptype||!$gid||!$tempid)
{
	printerror("ErrorUrl","history.go(-1)");
}
//巨舦
if($temptype=='tempvar')
{
	CheckLevel($logininid,$loginin,$classid,"tempvar");
}
else
{
	CheckLevel($logininid,$loginin,$classid,"template");
}
$gname=CheckTempGroup($gid);
$sql=$empire->query("select bid,tempname,baktime,lastuser from {$dbtbpre}enewstempbak where temptype='$temptype' and gid='$gid' and tempid='$tempid' order by bid desc");
$url='';
$urlgname=$gname."&nbsp;>&nbsp;";
//家狾嘿
if($temptype=='bqtemp')//夹乓家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsbqtemp",$gid)." where tempid='$tempid'");
	$tname='夹乓家狾';
	$url=$urlgname."<a href='ListBqtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶夹乓家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='classtemp')//家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsclasstemp",$gid)." where tempid='$tempid'");
	$tname='家狾';
	$url=$urlgname."<a href='ListClasstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='jstemp')//JS家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsjstemp",$gid)." where tempid='$tempid'");
	$tname='JS家狾';
	$url=$urlgname."<a href='ListJstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶JS家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='listtemp')//家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewslisttemp",$gid)." where tempid='$tempid'");
	$tname='家狾';
	$url=$urlgname."<a href='ListListtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='newstemp')//ず甧家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsnewstemp",$gid)." where tempid='$tempid'");
	$tname='ず甧家狾';
	$url=$urlgname."<a href='ListNewstemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶ず甧家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='pltemp')//蝶阶家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewspltemp",$gid)." where tempid='$tempid'");
	$tname='蝶阶家狾';
	$url=$urlgname."<a href='ListPltemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶蝶阶家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='printtemp')//ゴ家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsprinttemp",$gid)." where tempid='$tempid'");
	$tname='ゴ家狾';
	$url=$urlgname."<a href='ListPrinttemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶ゴ家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='searchtemp')//穓家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewssearchtemp",$gid)." where tempid='$tempid'");
	$tname='穓家狾';
	$url=$urlgname."<a href='ListSearchtemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶穓家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='tempvar')//そ家狾跑秖
{
	$tr=$empire->fetch1("select myvar,varname from ".GetDoTemptb("enewstempvar",$gid)." where varid='$tempid'");
	$tname='そ家狾跑秖';
	$url=$urlgname."<a href='ListTempvar.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶そ家狾跑秖</a>&nbsp;>&nbsp;跑秖 <b>".$tr[myvar]." (".$tr[varname].")</b> э癘魁";
}
elseif($temptype=='votetemp')//щ布家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewsvotetemp",$gid)." where tempid='$tempid'");
	$tname='щ布家狾';
	$url=$urlgname."<a href='ListVotetemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶щ布家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='pagetemp')//﹚竡家狾
{
	$tr=$empire->fetch1("select tempname from ".GetDoTemptb("enewspagetemp",$gid)." where tempid='$tempid'");
	$tname='﹚竡家狾';
	$url=$urlgname."<a href='ListPagetemp.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶﹚竡家狾</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
elseif($temptype=='indexpage')//よ家狾
{
	$tr=$empire->fetch1("select tempname from {$dbtbpre}enewsindexpage where tempid='$tempid'");
	$tname='よ';
	$url=$urlgname."<a href='ListIndexpage.php?gid=$gid".$ecms_hashur['ehref']."' target='_blank'>恨瞶よ</a>&nbsp;>&nbsp;家狾 <b>$tr[tempname]</b> э癘魁";
}
//そ家狾
elseif($temptype=='pubindextemp')//家狾
{
	$tname='家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>家狾</b> э癘魁";
}
elseif($temptype=='pubcptemp')//北狾家狾
{
	$tname='北狾家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>北狾家狾</b> э癘魁";
}
elseif($temptype=='pubsearchtemp')//蔼穓虫家狾
{
	$tname='蔼穓虫家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>蔼穓虫家狾</b> э癘魁";
}
elseif($temptype=='pubsearchjstemp')//穓JS家狾[绢]
{
	$tname='穓JS家狾[绢]';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>穓JS家狾[绢]</b> э癘魁";
}
elseif($temptype=='pubsearchjstemp1')//穓JS家狾[羇]
{
	$tname='穓JS家狾[羇]';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>穓JS家狾[羇]</b> э癘魁";
}
elseif($temptype=='pubotherlinktemp')//闽渺钡家狾
{
	$tname='闽渺钡家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>闽渺钡家狾</b> э癘魁";
}
elseif($temptype=='pubdownsofttemp')//更家狾
{
	$tname='更家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>更家狾</b> э癘魁";
}
elseif($temptype=='pubonlinemovietemp')//絬冀家狾
{
	$tname='絬冀家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>絬冀家狾</b> э癘魁";
}
elseif($temptype=='publistpagetemp')//だ家狾
{
	$tname='だ家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>だ家狾</b> э癘魁";
}
elseif($temptype=='pubpljstemp')//蝶阶JS秸ノ家狾
{
	$tname='蝶阶JS秸ノ家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>蝶阶JS秸ノ家狾</b> э癘魁";
}
elseif($temptype=='pubdownpagetemp')//程沧更家狾
{
	$tname='程沧更家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>程沧更家狾</b> э癘魁";
}
elseif($temptype=='pubgbooktemp')//痙ē狾家狾
{
	$tname='痙ē狾家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>痙ē狾家狾</b> э癘魁";
}
elseif($temptype=='publoginiframe')//祅嘲篈家狾
{
	$tname='祅嘲篈家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>祅嘲篈家狾</b> э癘魁";
}
elseif($temptype=='publoginjstemp')//JS秸ノ祅嘲篈家狾
{
	$tname='JS秸ノ祅嘲篈家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>JS秸ノ祅嘲篈家狾</b> э癘魁";
}
elseif($temptype=='pubschalltemp')//穓家狾
{
	$tname='穓家狾';
	$url=$urlgname."そ家狾&nbsp;>&nbsp;<b>穓家狾</b> э癘魁";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title><?=$tname?> э癘魁</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript">
window.resizeTo(550,600);
window.focus();
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
    <td height="25">竚<?=$url?></td>
    </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="52%" height="25"> <div align="center">э丁</div></td>
    <td width="29%" height="25"> <div align="center">э</div></td>
    <td width="19%"><div align="center">临</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25"><div align="center"> 
        <?=date("Y-m-d H:i:s",$r['baktime'])?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r['lastuser']?>
      </div></td>
    <td><div align="center">[<a href="../ecmstemp.php?enews=ReEBakTemp&bid=<?=$r['bid']?><?=$ecms_hashur['href']?>" onclick="return confirm('絋粄璶临?');">临</a>]</div></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>