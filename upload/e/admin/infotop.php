<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
//���ҥΤ�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();

//�Ʀ����
function ecmsShowInfoTop($query,$where,$field,$topnum,$day){
	global $empire,$dbtbpre,$class_r;
	if($day)
	{
		$and=$where?' and ':' where ';
		$query.=$and."newstime>=".time()."-".($day*24*3600);
	}
	if($field=='plnum')
	{
		$word='���׼�';
	}
	elseif($field=='totaldown')
	{
		$word='�U����';
	}
	elseif($field=='onclick')
	{
		$word='�I����';
	}
	$query.=" order by ".$field." desc limit ".$topnum;
	echo"<table width='100%' border='0' cellpadding='3' cellspacing='1' class='tableborder'><tr><td width='85%'>���D</td><td width='15%'>$word</td></tr>";
	$sql=$empire->query($query);
	while($r=$empire->fetch($sql))
	{
		$classurl=sys_ReturnBqClassname($r,9);
		$titleurl=sys_ReturnBqTitleLink($r);
		echo"<tr bgcolor='#ffffff' height='23'><td>[<a href='".$classurl."' target='_blank'>".$class_r[$r[classid]][classname]."</a>] <a href='$titleurl' target='_blank' title='�o�G�ɶ��G".date("Y-m-d H:i:s",$r[newstime])."'>".stripSlashes($r[title])."</a></td><td>".$r[$field]."</td></tr>";
	}
	echo"</table>";
}

$where='';
//�ƾڪ�
$tbname=RepPostVar($_GET['tbname']);
if(empty($tbname))
{
	$tbname=$public_r['tbname'];
}
$htb=0;
$tbsql=$empire->query("select tbname,tname from {$dbtbpre}enewstable order by tid");
while($tbr=$empire->fetch($tbsql))
{
	$select="";
	if($tbr[tbname]==$tbname)
	{
		$htb=1;
		$select=" selected";
	}
	$tbs.="<option value='".$tbr[tbname]."'".$select.">".$tbr[tname]."</option>";
}
if($htb==0)
{
	printerror('ErrorUrl','');
}
//���
$classid=(int)$_GET['classid'];
if($classid)
{
	$and=$where?' and ':' where ';
	if($class_r[$classid][islast])
	{
		$where.=$and."classid='$classid'";
	}
	else
	{
		$where.=$and."(".ReturnClass($class_r[$classid][sonclass]).")";
	}
}
//���D����
$ttid=(int)$_GET['ttid'];
if($ttid)
{
	$and=$where?' and ':' where ';
	$where.=$and." ttid='$ttid'";
}
$ttclass="";
$tt_sql=$empire->query("select typeid,tname from {$dbtbpre}enewsinfotype order by typeid");
while($tt_r=$empire->fetch($tt_sql))
{
	$selected='';
	if($tt_r[typeid]==$ttid)
	{
		$selected=" selected";
	}
	$ttclass.="<option value='".$tt_r[typeid]."'".$selected.">".$tt_r[tname]."</option>";
}
//�r�q
$myorder=(int)$_GET['myorder'];
if($myorder==1)
{
	$field='plnum';
}
elseif($myorder==2)
{
	$field='totaldown';
}
else
{
	$field='onclick';
}
//�j��
if($_GET['keyboard'])
{
	$and=$where?' and ':' where ';
	$keyboard=RepPostVar2($_GET['keyboard']);
	$show=RepPostStr($_GET['show'],1);
	if($show==0)//�j�����D
	{
		$where.=$and."title like '%$keyboard%'";
	}
	else//�j���@��
	{
		$where.=$and."username like '%$keyboard%'";
	}
}
//��ܱ���
$topnum=(int)$_GET['topnum'];
if($topnum<1||$topnum>100)
{
	$topnum=10;
}
$query="select id,title,classid,newstime,isurl,titleurl,".$field." from {$dbtbpre}ecms_".$tbname.$where;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�H���Ʀ�</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G<a href="infotop.php<?=$ecms_hashur['whehref']?>">�H���Ʀ�</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<form name="searchform" method="GET" action="infotop.php">
<?=$ecms_hashur['eform']?>
  <tr>
      <td>�ƾڪ� 
        <select name="tbname" id="tbname">
		<?=$tbs?>
        </select>
        �A��� <span id="listfileclassnav"></span> �A���D���� 
        <select name="ttid" id="ttid">
            <option value="0">�Ҧ��M�D</option>
            <?=$ttclass?>
        </select>
        �A�Ʀ� 
        <select name="myorder" id="myorder">
          <option value="0"<?=$myorder==0?' selected':''?>>�I���Ʀ�</option>
          <option value="1"<?=$myorder==1?' selected':''?>>���ױƦ�</option>
          <option value="2"<?=$myorder==2?' selected':''?>>�U���Ʀ�</option>
        </select>
        �A��� 
        <input name="topnum" type="text" id="topnum" value="<?=$topnum?>" size="6">
        �A����r
<input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        <select name="show" id="show">
          <option value="0"<?=$show==0?' selected':''?>>���D</option>
          <option value="1"<?=$show==1?' selected':''?>>�o�G��</option>
        </select> 
        <input type="submit" name="Submit" value="��ܱƦ�"></td>
  </tr>
</form>
</table>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr valign="top"> 
    <td width="50%"> 
      <table width="98%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">24�p�ɱƦ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">
            <?php ecmsShowInfoTop($query,$where,$field,$topnum,1);?>
          </td>
        </tr>
      </table></td>
    <td width="50%"><table width="98%" border="0" align="right" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">�@�P�Ʀ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"> 
            <?php ecmsShowInfoTop($query,$where,$field,$topnum,7);?>
          </td>
        </tr>
      </table> </td>
  </tr>
  <tr valign="top"> 
    <td> 
      <table width="98%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">�@�Ӥ�Ʀ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">
            <?php ecmsShowInfoTop($query,$where,$field,$topnum,30);?>
          </td>
        </tr>
      </table></td>
    <td><table width="98%" border="0" align="right" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">�T�Ӥ�Ʀ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">
            <?php ecmsShowInfoTop($query,$where,$field,$topnum,90);?>
          </td>
        </tr>
      </table>
      
    </td>
  </tr>
  <tr valign="top"> 
    <td><table width="98%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">�@�~�Ʀ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"> 
            <?php ecmsShowInfoTop($query,$where,$field,$topnum,365);?>
          </td>
        </tr>
      </table> </td>
    <td><table width="98%" border="0" align="right" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">�Ҧ��Ʀ�</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF">
            <?php ecmsShowInfoTop($query,$where,$field,$topnum,0);?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="ShowClassNav.php?ecms=5&classid=<?=$classid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>
<?php
db_close();
$empire=null;
?>