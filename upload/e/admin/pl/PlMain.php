<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//驗證權限
//CheckLevel($logininid,$loginin,$classid,"pl");

$plr=$empire->fetch1("select pldatatbs,pldeftb from {$dbtbpre}enewspl_set limit 1");
$tr=explode(',',$plr['pldatatbs']);
//今日評論
$pur=$empire->fetch1("select lasttimepl,lastnumpl,lastnumpltb,todaytimeinfo,todaytimepl,todaynumpl,yesterdaynumpl from {$dbtbpre}enewspublic_update limit 1");
//更新昨日信息
$todaydate=date('Y-m-d');
if(date('Y-m-d',$pur['todaytimeinfo'])<>$todaydate||date('Y-m-d',$pur['todaytimepl'])<>$todaydate)
{
	DoUpdateYesterdayAddDataNum();
	$pur=$empire->fetch1("select lasttimepl,lastnumpl,lastnumpltb,todaytimeinfo,todaytimepl,todaynumpl,yesterdaynumpl from {$dbtbpre}enewspublic_update limit 1");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>評論</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<a href="PlMain.php<?=$ecms_hashur['whehref']?>">評論統計</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="10%" height="25" bgcolor="#C9F1FF"><div align="center"><a href="../info/InfoMain.php<?=$ecms_hashur['whehref']?>">信息統計</a></div></td>
    <td width="10%" class="header"><div align="center"><a href="../pl/PlMain.php<?=$ecms_hashur['whehref']?>">評論統計</a></div></td>
    <td width="10%" bgcolor="#C9F1FF"><div align="center"><a href="../other/OtherMain.php<?=$ecms_hashur['whehref']?>">其他統計</a></div></td>
    <td width="58%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td height="25" colspan="5">評論發佈統計 (今日評論數：<?=$pur['todaynumpl']?>，昨天評論數：<?=$pur['yesterdaynumpl']?>) </td>
  </tr>
  <tr class="header">
    <td width="12%" height="25"><div align="center">分表</div></td>
    <td width="8%"><div align="center">已審核</div></td>
    <td width="8%"><div align="center">待審核</div></td>
    <td width="8%"><div align="center">總數</div></td>
    <td width="64%">從 
      <?=date('Y-m-d H:i:s',$pur['lasttimepl'])?> 
    截止至現在的新增數量</td>
  </tr>
	  <?php
	  $j=0;
	  $alltbpls=0;
	  $count=count($tr)-1;
	  for($i=1;$i<$count;$i++)
	  {
	  	$j++;
		$bgcolor='#FFFFFF';
		if($j%2==0)
		{
			$bgcolor='';
		}
		$thistb=$tr[$i];
		$restbname="評論表".$thistb;
		$pltbname='enewspl_'.$thistb;
		$alltbpls=eGetTableRowNum($dbtbpre.$pltbname);
		$checktbpls=$empire->gettotal("select count(*) as total from ".$dbtbpre.$pltbname." where checked=1");
		$tbpls=$alltbpls-$checktbpls;
		if($thistb==$plr['pldeftb'])
		{
			$restbname='<b>'.$restbname.'</b>';
		}
		$exp='|'.$thistb.',';
		$addnumr=explode($exp,$pur['lastnumpltb']);
		$addnumrt=explode('|',$addnumr[1]);
		$addnum=(int)$addnumrt[0];
		$totalalltbpls+=$alltbpls;
		$totalchecktbpls+=$checktbpls;
		$totaltbpls+=$tbpls;
	  ?>
  <tr bgcolor="<?=$bgcolor?>"> 
    <td height="25">
		<div align="center"><a href="ListAllPl.php?restb=<?=$tr[$i]?><?=$ecms_hashur['ehref']?>" title="*<?=$pltbname?>" target="_blank">
	    <?=$restbname?>
    </a></div></td>
    <td align="right"><div align="right"><a href="ListAllPl.php?restb=<?=$tr[$i]?>&checked=1<?=$ecms_hashur['ehref']?>" target="_blank"><?=$tbpls?></a></div></td>
    <td align="right"><div align="right"><a href="ListAllPl.php?restb=<?=$tr[$i]?>&checked=2<?=$ecms_hashur['ehref']?>" target="_blank"><?=$checktbpls?></a></div></td>
    <td align="right"><a href="ListAllPl.php?restb=<?=$tr[$i]?><?=$ecms_hashur['ehref']?>" target="_blank"><?=$alltbpls?></a></td>
    <td><table width="320" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="40%" align="right"><?=$addnum?></td>
          <td width="60%"><div align="center"></div></td>
        </tr>
    </table></td>
  </tr>
	  <?php
	  }
	  ?>
  <tr class="header">
    <td height="25"><div align="right">總計：</div></td>
    <td align="right"><div align="right"><?=$totaltbpls?></div></td>
    <td align="right"><div align="right"><?=$totalchecktbpls?></div></td>
    <td align="right"><?=$totalalltbpls?></td>
    <td><table width="320" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="40%" align="right"><font color="#FFFFFF"><b><?=$pur['lastnumpl']?></b></font></td>
          <td width="60%"><div align="center">
            <input type="button" name="Submit" value="重置截止統計" onclick="if(confirm('確認要重置評論數統計?')){self.location.href='../ecmscom.php?enews=ResetAddDataNum&type=pl&from=pl/PlMain.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>';}">
          </div></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td height="23"><font color="#666666">說明：點擊「已審核」、「未審核」數或「總數」可進入相應的管理。</font></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>