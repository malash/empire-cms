<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<title><?=$infor[title]?> щ布</title>
<meta name="keywords" content="<?=$infor[title]?> щ布" />
<meta name="description" content="<?=$infor[title]?> щ布" />
<link href="../../data/images/qcss.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header">
    <td height="25">夹肈:<?=$r[title]?>&nbsp;(<?=$voteclass?>)</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
<?php
//眔︽
$r_r=explode($r_exp,$r[votetext]);
$count=count($r_r);
for($i=0;$i<$count;$i++)
{
	$f_r=explode($f_exp,$r_r[$i]);
	if($r['votenum'])
	{
		$width=number_format(($f_r[1]/$r['votenum'])*100,2);
	}
	else
	{
		$width=0;
	}
	?>
        <tr height=24> 
          <td width="48%">
			<img src="../../data/images/msgnav.gif" width="5" height="5">&nbsp; 
            <?=$f_r[0]?>
          </td>
          <td width="10%">
				<div align="center"><?=$f_r[1]?>布</div>
		  </td>
          <td width="42%">
				<img src="../../data/images/showvote.gif" width="<?=$width?>" height="6" border=0>
				<?=$width?>%
          </td>
        </tr>
	<?php
}
?>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="right" cellpadding="3" cellspacing="1">
        <tr>
          <td>&nbsp;&nbsp;<b><?=$r['votenum']?></b>&nbsp;布</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<br>
<br>
<center><input type=button name=button value=闽超 onclick="self.window.close();"></center>
</body>
</html>