<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../class/com_functions.php");
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
CheckLevel($logininid,$loginin,$classid,"feedback");
$enews=$_GET['enews'];
if(empty($enews))
{
	$enews=$_POST['enews'];
}
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="DelFeedback")
{
	$id=$_GET['id'];
	$bid=$_GET['bid'];
	DelFeedback($id,$bid,$logininid,$loginin);
}
elseif($enews=="DelFeedback_all")
{
	$id=$_POST['id'];
	$bid=$_POST['bid'];
	DelFeedback_all($id,$bid,$logininid,$loginin);
}
include "../".LoadLang("pub/fun.php");
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//�C����ܱ���
$page_line=12;//�C������챵��
$offset=$page*$line;//�`�����q
$add='';
$and=' where ';
$search='';
$search.=$ecms_hashur['ehref'];
//��ܤ���
$bid=(int)$_GET['bid'];
$bidr=ReturnAdminFeedbackClass($bid,$logininid,$loginin);
if($bid)
{
	$add.=$and."bid='$bid'";
	$search.="&bid=$bid";
	$and=' and ';
}
elseif($bidr['bids']&&$bidr['allbid']==0)
{
	$add.=$and.'bid in ('.$bidr['bids'].')';
	$and=' and ';
}
//�O�_�\Ū
$haveread=(int)$_GET['haveread'];
if($haveread)
{
	if($haveread==1)//�wŪ
	{
		$add.=$and."haveread=1";
	}
	else//��Ū
	{
		$add.=$and."haveread=0";
	}
	$and=' and ';
	$search.="&haveread=$haveread";
}
//�j��
$sear=(int)$_GET['sear'];
if($sear)
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	$show=(int)$_GET['show'];
	if($keyboard)
	{
		if($show==1)//���D
		{
			$add.=$and."title like '%$keyboard%'";
		}
		elseif($show==2)//���X���e
		{
			$add.=$and."saytext like '%$keyboard%'";
		}
		elseif($show==3)//�m�W
		{
			$add.=$and."name like '%$keyboard%'";
		}
		elseif($show==4)//���W��
		{
			$add.=$and."company like '%$keyboard%'";
		}
		elseif($show==5)//�l�c
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
$gbclass=$bidr['selects'];
$query="select id,bid,title,saytime,userid,username,haveread,eipport from {$dbtbpre}enewsfeedback".$add;
$totalquery="select count(*) as total from {$dbtbpre}enewsfeedback".$add;
$num=$empire->gettotal($totalquery);//���o�`����
$query=$query." order by id desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=feedback.php".$ecms_hashur['whehref'].">�޲z�H�����X</a>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�H�����X</title>
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
    <td width="50%">��m�G 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton"> 
        <input type="button" name="Submit5" value="�޲z���X����" onclick="self.location.href='FeedbackClass.php<?=$ecms_hashur['whehref']?>';">
        &nbsp;&nbsp; 
        <input type="button" name="Submit52" value="�޲z���X�r�q" onclick="self.location.href='ListFeedbackF.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td width="35%"><div align="center">
        <p align="left">��ܤ��X����: 
          <select name="bid" id="bid" onchange=window.location='feedback.php?<?=$ecms_hashur['ehref']?>&bid='+this.options[this.selectedIndex].value>
            <option value="0">��ܥ������X</option>
            <?=$gbclass?>
          </select>
        </p>
        </div></td>
		<form name="searchform" method="GET" action="feedback.php">
		<?=$ecms_hashur['eform']?>
    <td width="65%"><div align="right">�j���G
        <select name="show" id="show">
          <option value="1"<?=$show==1?' selected':''?>>���D</option>
          <option value="2"<?=$show==2?' selected':''?>>���X���e</option>
		  <option value="3"<?=$show==3?' selected':''?>>�m�W</option>
		  <option value="4"<?=$show==4?' selected':''?>>���W��</option>
          <option value="5"<?=$show==5?' selected':''?>>�l�c</option>
          <option value="6"<?=$show==6?' selected':''?>>IP�a�}</option>
        </select>
        <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        <select name="haveread" id="haveread">
          <option value="0"<?=$haveread==0?' selected':''?>>����</option>
          <option value="1"<?=$haveread==1?' selected':''?>>�wŪ</option>
          <option value="2"<?=$haveread==2?' selected':''?>>��Ū</option>
        </select>
        <input type="submit" name="Submit3" value="�j��">
        <input name="bid" type="hidden" id="bid" value="<?=$bid?>">
        <input name="sear" type="hidden" id="sear" value="1">
&nbsp;&nbsp;
      
      </div></td>
	  </form>
  </tr>
</table>
<form name="form1" method="post" action="feedback.php" onsubmit="return confirm('�T�{�n�R��?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
  <?=$ecms_hashur['form']?>
    <tr class=header> 
      <td width="7%" height="23"><div align="center">ID</div></td>
      <td width="43%" height="23"><div align="center">���D(�I���d��)</div></td>
      <td width="20%" height="23"><div align="center">���ݤ���</div></td>
      <td width="18%" height="23"><div align="center">�o�G�ɶ�</div></td>
      <td width="12%" height="23"><div align="center">�ާ@</div></td>
    </tr>
    <?php
  while($r=$empire->fetch($sql))
  {
  	$br=$empire->fetch1("select bname from {$dbtbpre}enewsfeedbackclass where bid='$r[bid]'");
  	$username="�C��";
  	if($r['userid'])
  	{
    	$username="<a href='../member/AddMember.php?enews=EditMember&userid=".$r['userid'].$ecms_hashur['ehref']."' target=_blank>".$r['username']."</a>";
  	}
	$r['title']=stripSlashes($r['title']);
	if(empty($r['haveread']))
	{
		$r['title']='<b>'.$r['title'].'</b>';
	}
  ?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"><div align="center"> 
          <?=$r[id]?>
        </div></td>
      <td height="25"><div align="left"><a href=#ecms onclick="window.open('ShowFeedback.php?id=<?=$r[id]?><?=$ecms_hashur['ehref']?>','','width=650,height=600,scrollbars=yes,top=70,left=100');"> 
          <?=$r[title]?>
          </a>&nbsp;(
          <?=$username?>
          )</div></td>
      <td height="25"><div align="center"><a href="feedback.php?bid=<?=$r[bid]?><?=$ecms_hashur['ehref']?>"> 
          <?=$br[bname]?>
          </a></div></td>
      <td height="25"><div align="center"> 
          <?=$r[saytime]?>
        </div></td>
      <td height="25"><div align="center">[<a href="feedback.php?enews=DelFeedback&id=<?=$r[id]?>&bid=<?=$bid?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R��?');">�R��</a> 
          <input name="id[]" type="checkbox" id="id[]" value="<?=$r[id]?>">
          ]</div></td>
    </tr>
    <?php
  }
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="5">&nbsp; 
        <?=$returnpage?>
        &nbsp;&nbsp;&nbsp; <input type="submit" name="Submit" value="��q�R��"> <input name="bid" type="hidden" id="bid" value="<?=$bid?>"> 
        <input name="enews" type="hidden" id="enews" value="DelFeedback_all"> 
        &nbsp;&nbsp;
        <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
        ����</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="5">�����G��Ū�H�����D������r�C</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
