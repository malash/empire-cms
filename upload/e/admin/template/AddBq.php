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
CheckLevel($logininid,$loginin,$classid,"bq");
$enews=ehtmlspecialchars($_GET['enews']);
$cid=ehtmlspecialchars($_GET['cid']);
$url="<a href=ListBq.php".$ecms_hashur['whehref'].">管理標籤</a>&nbsp;>&nbsp;增加標籤";
//修改標籤
if($enews=="EditBq")
{
	$bqid=(int)$_GET['bqid'];
	$url="<a href=ListBq.php".$ecms_hashur['whehref'].">管理標籤</a>&nbsp;>&nbsp;修改標籤";
	$r=$empire->fetch1("select bqname,bqsay,funname,bq,issys,bqgs,isclose,classid,myorder from {$dbtbpre}enewsbq where bqid='$bqid'");
}
//分類
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsbqclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$r[classid])
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
db_close();
$empire=null;

//--------------------html編輯器
include('../ecmseditor/infoeditor/fckeditor.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>標籤管理</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function on()
{
var f=document.add
f.HTML.value=f.bqsay.value;
}
function bs(){
var f=document.add
f.bqsay.value=f.HTML.value;
}
function br(){
if(!confirm("是否復位？")){return false;}
document.add.title.select()
}
</script><noscript>
<iframe src=*.htm></iframe>
</noscript>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：<?=$url?></td>
  </tr>
</table>

<form action="../ecmstemp.php" method="post" name="add" id="add">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">增加模板標籤 
        <input name="add[bqid]" type="hidden" id="add[bqid]" value="<?=$bqid?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="add[cid]" type="hidden" id="add[cid]" value="<?=$cid?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">標籤名：</td>
      <td width="79%" height="25"><input name="add[bqname]" type="text" id="add[bqname]" value="<?=$r[bqname]?>" size="38">
        <font color="#666666">(如〞調用文字信息標籤〞)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">標籤符號：</td>
      <td height="25"><input name="add[bq]" type="text" id="add[bq]" value="<?=$r[bq]?>" size="38">
        <font color="#666666">(如：[ad]參數[/ad]，則符號為〞ad〞)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">所屬類別：</td>
      <td height="25"><select name="add[classid]" id="add[classid]">
          <option value="0">不隸屬於任何類別</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit3" value="管理分類" onclick="window.open('BqClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">函數名：</td>
      <td height="25"><input name="add[funname]" type="text" id="add[funname]" value="<?=$r[funname]?>" size="38"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"> <p>系統標籤：(相對於e/class/t_functions.php文件的函數名)<br>
          用戶自定義標籤：(相對於e/class/userfun.php文件的函數名，函數命名請以〞<strong><font color="#FF0000">user_</font></strong>〞開頭)</p></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">標籤格式：</td>
      <td height="25"><input name="add[bqgs]" type="text" id="add[bqgs]" value="<?=stripSlashes($r[bqgs])?>" size="80"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">如：<font color="#FF0000">[phomenews]欄目ID/專題ID,顯示條數,標題截取數,是否顯示時間,操作類型[/phomenews]</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">標籤說明：</td>
      <td height="25"> 
        <?=ECMS_ShowEditorVar('bqsay',stripSlashes($r[bqsay]),'Default','../ecmseditor/infoeditor/')?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">是否開啟標籤：</td>
      <td height="25"><input type="radio" name="add[isclose]" value="0"<?=$r[isclose]==0?' checked':''?>>
        是 
        <input type="radio" name="add[isclose]" value="1"<?=$r[isclose]==1?' checked':''?>>
        否 <font color="#666666">（開啟才會在模板中生效）</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">排序：</td>
      <td height="25"><input name="add[myorder]" type="text" id="add[myorder]" value="<?=$r[myorder]?>" size="38">
        <font color="#666666">(值越大越前面)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置"></td>
    </tr>
  </table>
</form>
</body>
</html>