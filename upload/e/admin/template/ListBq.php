<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
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
CheckLevel($logininid,$loginin,$classid,"bq");

$search=$ecms_hashur['ehref'];
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=20;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$query="select bqid,bqname,bq,issys,funname,isclose,classid from {$dbtbpre}enewsbq";
$totalquery="select count(*) as total from {$dbtbpre}enewsbq";
//���O
$add="";
$classid=(int)$_GET['classid'];
if($classid)
{
	$add=" where classid=$classid";
	$search.="&classid=$classid";
}
$query.=$add;
$totalquery.=$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by myorder desc,isclose,bqid limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
//���O
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsbqclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$classid)
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>�޲z����</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%" height="25">��m�G<a href="ListBq.php<?=$ecms_hashur['whehref']?>">�޲z����</a></td>
    <td><div align="right" class="emenubutton"> 
        <input type="button" name="Submit5" value="�W�[����" onclick="self.location.href='AddBq.php?enews=AddBq&gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit5" value="�ɤJ����" onclick="self.location.href='LoadInBq.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit52" value="�޲z���Ҥ���" onclick="self.location.href='BqClass.php?gid=<?=$gid?><?=$ecms_hashur['ehref']?>';">
      </div></td>
  </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td> ������O�G 
      <select name="classid" id="classid" onchange=window.location='ListBq.php?<?=$ecms_hashur['ehref']?>&classid='+this.options[this.selectedIndex].value>
        <option value="0">��ܩҦ����O</option>
        <?=$cstr?>
      </select> </td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="5%" height="25"> <div align="center">ID</div></td>
    <td width="27%" height="25"> <div align="center">���ҦW��</div></td>
    <td width="26%" height="25"> <div align="center">���ҲŸ�</div></td>
    <td width="11%" height="25"> <div align="center">�t�μ���</div></td>
    <td width="8%"><div align="center">�}��</div></td>
    <td width="23%" height="25"> <div align="center">�ާ@</div></td>
  </tr>
  <?php
  while($r=$empire->fetch($sql))
  {
  if($r[issys])
  {$issys="�O";}
  else
  {$issys="�_";}
  //�}��
  if($r[isclose])
  {
  $isclose="<font color=red>����</font>";
  }
  else
  {
  $isclose="�}��";
  }
  ?>
  <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
    <td height="25"> <div align="center">
        <?=$r[bqid]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[bqname]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$r[bq]?>
      </div></td>
    <td height="25"> <div align="center">
        <?=$issys?>
      </div></td>
    <td><div align="center"><?=$isclose?></div></td>
    <td height="25"> <div align="center">[<a href="AddBq.php?enews=EditBq&bqid=<?=$r[bqid]?>&cid=<?=$classid?><?=$ecms_hashur['ehref']?>">�ק�</a>]&nbsp;[<a href="../ecmstemp.php?enews=DelBq&bqid=<?=$r[bqid]?>&cid=<?=$classid?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a>]&nbsp;[<a href="#ecms" onclick="window.open('LoadOutBq.php?bqid=<?=$r[bqid]?><?=$ecms_hashur['ehref']?>','','width=500,height=500,scrollbars=auto');">�ɥX</a>]</div></td>
  </tr>
  <?php
  }
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6">&nbsp;&nbsp;&nbsp; 
      <?=$returnpage?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
