<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../class/com_functions.php");
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
CheckLevel($logininid,$loginin,$classid,"gbook");
$enews=$_GET['enews'];
if(empty($enews))
{$enews=$_POST['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="DelGbook")
{
	$lyid=$_GET['lyid'];
	$bid=$_GET['bid'];
	DelGbook($lyid,$bid,$logininid,$loginin);
}
elseif($enews=="ReGbook")
{
	$lyid=$_POST['lyid'];
	$bid=$_POST['bid'];
	$retext=$_POST['retext'];
	ReGbook($lyid,$retext,$bid,$logininid,$loginin);
}
elseif($enews=="DelGbook_all")
{
	$lyid=$_POST['lyid'];
	$bid=$_POST['bid'];
	DelGbook_all($lyid,$bid,$logininid,$loginin);
}
elseif($enews=="CheckGbook_all")
{
	$lyid=$_POST['lyid'];
	$bid=$_POST['bid'];
	CheckGbook_all($lyid,$bid,$logininid,$loginin);
}
else
{}
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=12;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$search='';
$search.=$ecms_hashur['ehref'];
$add='';
$and=' where ';
//��ܤ���
$bid=(int)$_GET['bid'];
if($bid)
{
	$add.=$and."bid='$bid'";
	$search.="&bid=$bid";
	$and=' and ';
}
//�O�_�f��
$checked=(int)$_GET['checked'];
if($checked)
{
	if($checked==1)//�w�f��
	{
		$add.=$and."checked=0";
	}
	else//�ݼf��
	{
		$add.=$and."checked=1";
	}
	$and=' and ';
	$search.="&checked=$checked";
}
//�j��
$sear=(int)$_GET['sear'];
if($sear)
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	$show=(int)$_GET['show'];
	if($keyboard)
	{
		if($show==1)//�d����
		{
			$add.=$and."name like '%$keyboard%'";
		}
		elseif($show==2)//�d�����e
		{
			$add.=$and."lytext like '%$keyboard%'";
		}
		elseif($show==3)//�l�c
		{
			$add.=$and."email like '%$keyboard%'";
		}
		else//�d��IP
		{
			$add.=$and."ip like '%$keyboard%'";
		}
		$and=' and ';
		$search.="&show=$show&keyboard=$keyboard";
	}
}
$query="select lyid,name,email,`mycall`,lytime,lytext,retext,bid,ip,checked,userid,username,eipport from {$dbtbpre}enewsgbook".$add;
$totalquery="select count(*) as total from {$dbtbpre}enewsgbook".$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by lyid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=gbook.php".$ecms_hashur['whehref'].">�޲z�d��</a>";
$gbclass=ReturnGbookClass($bid,0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�d���޲z</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="50%">��m: 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="�d�������޲z" onclick="self.location.href='GbookClass.php<?=$ecms_hashur['whehref']?>';">
		&nbsp;&nbsp;
        <input type="button" name="Submit52" value="��q�R���d��" onclick="self.location.href='DelMoreGbook.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td width="29%">��ܯd������:
        <select name="bid" id="bid" onchange=window.location='gbook.php?<?=$ecms_hashur['ehref']?>&bid='+this.options[this.selectedIndex].value>
          <option value="0">��ܥ����d��</option>
          <?=$gbclass?>
        </select>      </td>
		<form name="searchform" method="GET" action="gbook.php">
		<?=$ecms_hashur['eform']?>
    <td width="71%"><div align="right">
      �j���G
          <select name="show" id="show">
            <option value="1"<?=$show==1?' selected':''?>>�d����</option>
            <option value="2"<?=$show==2?' selected':''?>>�d�����e</option>
            <option value="3"<?=$show==3?' selected':''?>>�l�c</option>
            <option value="4"<?=$show==4?' selected':''?>>IP�a�}</option>
          </select>
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="checked" id="checked">
            <option value="0"<?=$checked==0?' selected':''?>>����</option>
            <option value="1"<?=$checked==1?' selected':''?>>�w�f��</option>
            <option value="2"<?=$checked==2?' selected':''?>>�ݼf��</option>
          </select>
          <input type="submit" name="Submit3" value="�j��">
          <input name="bid" type="hidden" id="bid" value="<?=$bid?>">
		  <input name="sear" type="hidden" id="sear" value="1">
		  &nbsp;&nbsp;
    </div></td>
	  </form>
  </tr>
</table>
<form name=thisform method=post action=gbook.php onsubmit="return confirm('�T�{�n����ާ@?');">
<?=$ecms_hashur['form']?>
<?php
while($r=$empire->fetch($sql))
{
$br=$empire->fetch1("select bname from {$dbtbpre}enewsgbookclass where bid='$r[bid]'");
//�f��
$checked="";
if($r[checked])
{
$checked=" title='���f��' style='background:#99C4E3'";
}
$username="�C��";
if($r['userid'])
{
	$username="<a href='../member/AddMember.php?enews=EditMember&userid=".$r['userid'].$ecms_hashur['ehref']."' target=_blank>".$r['username']."</a>";
}
?>
  <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
    <tr class=header> 
      <td width="55%" height="23">�o�G��: 
        <?=stripSlashes($r[name])?>
        &nbsp;(<?=$username?>)</td>  
      <td width="45%">�o�G�ɶ�: 
        <?=$r[lytime]?>&nbsp;
        (IP:
        <?=$r[ip]?>:<?=$r[eipport]?>) </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="23" colspan="2"> <table border=0 width=100% cellspacing=1 cellpadding=10 bgcolor='#cccccc' style="WORD-BREAK: break-all; WORD-WRAP: break-word">
        <tr> 
          <td width='100%' bgcolor='#FFFFFF' style='word-break:break-all'> 
            <?=nl2br(stripSlashes($r[lytext]))?>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" style="WORD-BREAK: break-all; WORD-WRAP: break-word">
        <tr> 
          <td><img src="../../data/images/regb.gif" width="18" height="18"><strong><font color="#FF0000">�^�_:</font></strong> 
            <?=nl2br(stripSlashes($r[retext]))?>
          </td>
        </tr>
      </table> 
    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="23" colspan="2"><div align="right">
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td width="65%"><strong>�l�c:<?=$r[email]?>,�q��:<?=$r[mycall]?></strong></td>
            <td width="35%"> <div align="left"><strong>�ާ@:</strong>[<a href="#ecms" onclick="window.open('ReGbook.php?lyid=<?=$r[lyid]?>&bid=<?=$bid?><?=$ecms_hashur['ehref']?>','','width=600,height=380,scrollbars=yes');">�^�_/�ק�^�_</a>]&nbsp;&nbsp;[<a href="gbook.php?enews=DelGbook&lyid=<?=$r[lyid]?>&bid=<?=$bid?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>] 
                  <input name="lyid[]" type="checkbox" id="lyid[]" value="<?=$r[lyid]?>"<?=$checked?>>
                </div></td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr>
            <td><div align="center">���ݯd������:<a href="gbook.php?bid=<?=$r[bid]?><?=$ecms_hashur['ehref']?>"><?=$br[bname]?></a></div></td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
<br>
<?php
}
?>
  <table width="700" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr> 
      <td>����:
        <?=$returnpage?>
        &nbsp;&nbsp;
        <input type="submit" name="Submit" value="�f�֯d��" onClick="document.thisform.enews.value='CheckGbook_all';">
        &nbsp;&nbsp; <input type="submit" name="Submit2" value="�R���d��" onClick="document.thisform.enews.value='DelGbook_all';">
        <input name="enews" type="hidden" id="enews" value="DelGbook_all">
        <input name="bid" type="hidden" id="bid" value="<?=$bid?>">
        &nbsp;&nbsp;<input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>����</td>
  </tr>
</table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
