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
CheckLevel($logininid,$loginin,$classid,"workflow");
$wfid=(int)$_GET['wfid'];
if(!$wfid)
{
	printerror('ErrorUrl','');
}
$wfr=$empire->fetch1("select wfid,wfname from {$dbtbpre}enewsworkflow where wfid='$wfid'");
if(!$wfr['wfid'])
{
	printerror('ErrorUrl','');
}
$enews=ehtmlspecialchars($_GET['enews']);
$postword='增加節點';
$url="<a href=ListWf.php".$ecms_hashur['whehref'].">管理工作流</a> &gt; ".$wfr[wfname]." &gt; <a href='ListWfItem.php?wfid=$wfid".$ecms_hashur['ehref']."'>管理節點</a> &gt; 增加節點";
//複製
if($enews=="AddWorkflowItem"&&$_GET['docopy'])
{
	$tid=(int)$_GET['tid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsworkflowitem where tid='$tid'");
	$url="<a href=ListWf.php".$ecms_hashur['whehref'].">管理工作流</a> &gt; ".$wfr[wfname]." &gt; <a href='ListWfItem.php?wfid=$wfid".$ecms_hashur['ehref']."'>管理節點</a> &gt; 複製節點：<b>".$r[tname]."</b>";
	$username=substr($r[username],1,-1);
}
//修改
if($enews=="EditWorkflowItem")
{
	$postword='修改節點';
	$tid=(int)$_GET['tid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsworkflowitem where tid='$tid'");
	$url="<a href=ListWf.php".$ecms_hashur['whehref'].">管理工作流</a> &gt; ".$wfr[wfname]." &gt; <a href='ListWfItem.php?wfid=$wfid".$ecms_hashur['ehref']."'>管理節點</a> &gt; 修改節點：<b>".$r[tname]."</b>";
	$username=substr($r[username],1,-1);
}
//用戶組
$group='';
$groupsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsgroup order by groupid");
while($groupr=$empire->fetch($groupsql))
{
	$select='';
	if(strstr($r[groupid],','.$groupr[groupid].','))
	{
		$select=' selected';
	}
	$group.="<option value='".$groupr[groupid]."'".$select.">".$groupr[groupname]."</option>";
}
//部門
$userclass='';
$ucsql=$empire->query("select classid,classname from {$dbtbpre}enewsuserclass order by classid");
while($ucr=$empire->fetch($ucsql))
{
	$select='';
	if(strstr($r[userclass],','.$ucr[classid].','))
	{
		$select=' selected';
	}
	$userclass.="<option value='".$ucr[classid]."'".$select.">".$ucr[classname]."</option>";
}
//原節點
$items='';
$maxtno=0;
$ytsql=$empire->query("select tid,tname,tno from {$dbtbpre}enewsworkflowitem where wfid='$wfid'");
while($ytr=$empire->fetch($ytsql))
{
	if($ytr[tno]>$maxtno)
	{
		$maxtno=$ytr[tno];
	}
	$select='';
	if($ytr[tid]==$r[tbdo])
	{
		$select=' selected';
	}
	$items.="<option value='".$ytr[tid]."'".$select.">".$ytr[tname]."(".$ytr[tno].")</option>";
}
if($enews=="AddWorkflowItem")
{
	$r[tno]=$maxtno+1;
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>工作流</title>
<script>
function selectalls(doselect,formvar)
{  
	 var bool=doselect==1?true:false;
	 var selectform=document.getElementById(formvar);
	 for(var i=0;i<selectform.length;i++)
	 { 
		  selectform.all[i].selected=bool;
	 } 
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListWfItem.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="tid" type="hidden" id="tid" value="<?=$tid?>"> 
        <input name="wfid" type="hidden" id="wfid" value="<?=$wfid?>"> </td>
    </tr>
    <tr> 
      <td width="18%" height="25" bgcolor="#FFFFFF">節點編號</td>
      <td width="82%" height="25" bgcolor="#FFFFFF"> <input name="tno" type="text" id="tno" value="<?=$r[tno]?>" size="42"> 
        <select name="changetno" id="changetno" onchange="document.form1.tno.value=this.options[this.selectedIndex].value">
          <option>選擇</option>
          <option value="1">起始編號(1)</option>
          <option value="100">結束編號(100)</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">節點名稱</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="tname" type="text" id="tname" value="<?=$r[tname]?>" size="42"></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">狀態說明</td>
      <td height="25" bgcolor="#FFFFFF"><input name="tstatus" type="text" id="tstatus" value="<?=$r[tstatus]?>" size="42"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">節點描述</td>
      <td height="25" bgcolor="#FFFFFF"> <textarea name="ttext" cols="60" rows="5" id="varname3"><?=ehtmlspecialchars($r[ttext])?></textarea></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">接收對像</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">用戶</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" value="<?=$username?>" size="42"> 
        <font color="#666666"> 
        <input type="button" name="Submit3" value="選擇" onclick="window.open('../ChangeUser.php?field=username&form=form1<?=$ecms_hashur['ehref']?>','','width=300,height=520,scrollbars=yes');">
        (多個用戶用「,」逗號隔開)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">用戶組</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="groupid[]" size="5" multiple id="groupidselect" style="width:180">
          <?=$group?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'groupidselect')">全部取消</a>]</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">部門</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="userclass[]" size="5" multiple id="userclassselect" style="width:180">
          <?=$userclass?>
        </select>
        [<a href="#empirecms" onclick="selectalls(0,'userclassselect')">全部取消</a>]</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">流轉方式</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="lztype" value="0"<?=$r[lztype]==0?' checked':''?>>
        普通流轉 
        <input type="radio" name="lztype" value="1"<?=$r[lztype]==1?' checked':''?>>
        會簽</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">返工時打回</td>
      <td height="25" bgcolor="#FFFFFF"><select name="tbdo" id="tbdo">
          <option value="0"<?=$r[tbdo]==0?' selected':''?>>打回作者</option>
          <?=$items?>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">否決時操作</td>
      <td height="25" bgcolor="#FFFFFF"><select name="tddo" id="tddo">
          <option value="0"<?=$r[tddo]==0?' selected':''?>>不操作</option>
          <option value="1"<?=$r[tddo]==1?' selected':''?>>刪除信息</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="提交"> 
        <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>
