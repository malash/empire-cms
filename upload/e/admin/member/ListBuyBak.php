<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
require "../".LoadLang("pub/fun.php");
require("../../data/dbcache/MemberLevel.php");
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
CheckLevel($logininid,$loginin,$classid,"member");
$userid=(int)$_GET['userid'];
$username=ehtmlspecialchars($_GET['username']);
$search="&username=".$username."&userid=".$userid.$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$totalquery="select count(*) as total from {$dbtbpre}enewsbuybak where userid='$userid'";
$num=$empire->gettotal($totalquery);//���o�`����
$query="select * from {$dbtbpre}enewsbuybak where userid='$userid'";
$query=$query." order by buytime desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ʶR�O��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>�d��<b><?=$username?></b>�ʶR�O��</td>
  </tr>
</table>
<br>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="11%"><div align="center">�R������</div></td>
    <td width="37%" height="25"><div align="center">�R�ȥd��</div></td>
    <td width="11%" height="25"><div align="center">�R�Ȫ��B</div></td>
    <td width="11%" height="25"><div align="center">�ʶR�I��</div></td>
    <td width="11%"><div align="center">���Ĵ�</div></td>
    <td width="19%" height="25"><div align="center">�ʶR�ɶ�</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
		//����
		if($r['type']==0)
		{
			$type='�I�d�R��';
		}
		elseif($r['type']==1)
		{
			$type='�b�u�R��';
		}
		elseif($r['type']==2)
		{
			$type='�R���I��';
		}
		elseif($r['type']==3)
		{
			$type='�R�Ȫ��B';
		}
		else
		{
			$type='';
		}
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td><div align="center"><?=$type?></div></td>
    <td height="25"><div align="center"> 
        <?=$r[card_no]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[money]?>
      </div></td>
    <td height="25"><div align="center"> 
        <?=$r[cardfen]?>
      </div></td>
    <td><div align="center"><?=$r[userdate]?></div></td>
    <td height="25"><div align="center"> 
        <?=$r[buytime]?>
      </div></td>
  </tr>
  <?php
  }
  db_close();
  $empire=null;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
