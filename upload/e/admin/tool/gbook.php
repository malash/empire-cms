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
$line=12;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$search='';
$search.=$ecms_hashur['ehref'];
$add='';
$and=' where ';
//選擇分類
$bid=(int)$_GET['bid'];
if($bid)
{
	$add.=$and."bid='$bid'";
	$search.="&bid=$bid";
	$and=' and ';
}
//是否審核
$checked=(int)$_GET['checked'];
if($checked)
{
	if($checked==1)//已審核
	{
		$add.=$and."checked=0";
	}
	else//待審核
	{
		$add.=$and."checked=1";
	}
	$and=' and ';
	$search.="&checked=$checked";
}
//搜索
$sear=(int)$_GET['sear'];
if($sear)
{
	$keyboard=RepPostVar2($_GET['keyboard']);
	$show=(int)$_GET['show'];
	if($keyboard)
	{
		if($show==1)//留言者
		{
			$add.=$and."name like '%$keyboard%'";
		}
		elseif($show==2)//留言內容
		{
			$add.=$and."lytext like '%$keyboard%'";
		}
		elseif($show==3)//郵箱
		{
			$add.=$and."email like '%$keyboard%'";
		}
		else//留言IP
		{
			$add.=$and."ip like '%$keyboard%'";
		}
		$and=' and ';
		$search.="&show=$show&keyboard=$keyboard";
	}
}
$query="select lyid,name,email,`mycall`,lytime,lytext,retext,bid,ip,checked,userid,username,eipport from {$dbtbpre}enewsgbook".$add;
$totalquery="select count(*) as total from {$dbtbpre}enewsgbook".$add;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by lyid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
$url="<a href=gbook.php".$ecms_hashur['whehref'].">管理留言</a>";
$gbclass=ReturnGbookClass($bid,0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>留言管理</title>
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
    <td width="50%">位置: 
      <?=$url?>
    </td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="留言分類管理" onclick="self.location.href='GbookClass.php<?=$ecms_hashur['whehref']?>';">
		&nbsp;&nbsp;
        <input type="button" name="Submit52" value="批量刪除留言" onclick="self.location.href='DelMoreGbook.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td width="29%">選擇留言分類:
        <select name="bid" id="bid" onchange=window.location='gbook.php?<?=$ecms_hashur['ehref']?>&bid='+this.options[this.selectedIndex].value>
          <option value="0">顯示全部留言</option>
          <?=$gbclass?>
        </select>      </td>
		<form name="searchform" method="GET" action="gbook.php">
		<?=$ecms_hashur['eform']?>
    <td width="71%"><div align="right">
      搜索：
          <select name="show" id="show">
            <option value="1"<?=$show==1?' selected':''?>>留言者</option>
            <option value="2"<?=$show==2?' selected':''?>>留言內容</option>
            <option value="3"<?=$show==3?' selected':''?>>郵箱</option>
            <option value="4"<?=$show==4?' selected':''?>>IP地址</option>
          </select>
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="checked" id="checked">
            <option value="0"<?=$checked==0?' selected':''?>>不限</option>
            <option value="1"<?=$checked==1?' selected':''?>>已審核</option>
            <option value="2"<?=$checked==2?' selected':''?>>待審核</option>
          </select>
          <input type="submit" name="Submit3" value="搜索">
          <input name="bid" type="hidden" id="bid" value="<?=$bid?>">
		  <input name="sear" type="hidden" id="sear" value="1">
		  &nbsp;&nbsp;
    </div></td>
	  </form>
  </tr>
</table>
<form name=thisform method=post action=gbook.php onsubmit="return confirm('確認要執行操作?');">
<?=$ecms_hashur['form']?>
<?php
while($r=$empire->fetch($sql))
{
$br=$empire->fetch1("select bname from {$dbtbpre}enewsgbookclass where bid='$r[bid]'");
//審核
$checked="";
if($r[checked])
{
$checked=" title='未審核' style='background:#99C4E3'";
}
$username="遊客";
if($r['userid'])
{
	$username="<a href='../member/AddMember.php?enews=EditMember&userid=".$r['userid'].$ecms_hashur['ehref']."' target=_blank>".$r['username']."</a>";
}
?>
  <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder>
    <tr class=header> 
      <td width="55%" height="23">發佈者: 
        <?=stripSlashes($r[name])?>
        &nbsp;(<?=$username?>)</td>  
      <td width="45%">發佈時間: 
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
          <td><img src="../../data/images/regb.gif" width="18" height="18"><strong><font color="#FF0000">回復:</font></strong> 
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
            <td width="65%"><strong>郵箱:<?=$r[email]?>,電話:<?=$r[mycall]?></strong></td>
            <td width="35%"> <div align="left"><strong>操作:</strong>[<a href="#ecms" onclick="window.open('ReGbook.php?lyid=<?=$r[lyid]?>&bid=<?=$bid?><?=$ecms_hashur['ehref']?>','','width=600,height=380,scrollbars=yes');">回復/修改回復</a>]&nbsp;&nbsp;[<a href="gbook.php?enews=DelGbook&lyid=<?=$r[lyid]?>&bid=<?=$bid?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除?');">刪除</a>] 
                  <input name="lyid[]" type="checkbox" id="lyid[]" value="<?=$r[lyid]?>"<?=$checked?>>
                </div></td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr>
            <td><div align="center">所屬留言分類:<a href="gbook.php?bid=<?=$r[bid]?><?=$ecms_hashur['ehref']?>"><?=$br[bname]?></a></div></td>
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
      <td>分頁:
        <?=$returnpage?>
        &nbsp;&nbsp;
        <input type="submit" name="Submit" value="審核留言" onClick="document.thisform.enews.value='CheckGbook_all';">
        &nbsp;&nbsp; <input type="submit" name="Submit2" value="刪除留言" onClick="document.thisform.enews.value='DelGbook_all';">
        <input name="enews" type="hidden" id="enews" value="DelGbook_all">
        <input name="bid" type="hidden" id="bid" value="<?=$bid?>">
        &nbsp;&nbsp;<input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>全選</td>
  </tr>
</table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>
