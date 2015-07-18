<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
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
CheckLevel($logininid,$loginin,$classid,"cj");

//顯示無限級結點[增加結點時]
function ShowClass_AddInfoClass($obclassid,$bclassid,$exp,$enews=0){
	global $empire,$dbtbpre;
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="|-";
    }
	else
	{$exp="&nbsp;&nbsp;".$exp;}
	$sql=$empire->query("select classid,classname,bclassid from {$dbtbpre}enewsinfoclass where bclassid='$bclassid' order by classid");
	$returnstr="";
	while($r=$empire->fetch($sql))
	{
		if($r[classid]==$obclassid)
		{$select=" selected";}
		else
		{$select="";}
		$returnstr.="<option value=".$r[classid].$select.">".$exp.$r[classname]."</option>";
		$returnstr.=ShowClass_AddInfoClass($obclassid,$r[classid],$exp,$enews);
	}
	return $returnstr;
}

$enews=ehtmlspecialchars($_GET['enews']);
$r[newsclassid]=(int)$_GET['newsclassid'];
/*
if(empty($r[newsclassid])&&($enews=="AddInfoClass"||empty($enews)))
{
echo"<script>self.location.href='AddInfoC.php".$ecms_hashur['whehref']."';</script>";
exit();
}
*/
if($_GET['from'])
{
	$listclasslink="ListPageInfoClass.php";
}
else
{
	$listclasslink="ListInfoClass.php";
}

$docopy=ehtmlspecialchars($_GET['docopy']);
$url="採集&nbsp;>&nbsp;<a href=".$listclasslink.$ecms_hashur['whehref'].">管理節點</a>&nbsp;>&nbsp;增加節點";
//初使化數據
$r[startday]=date("Y-m-d");
$r[endday]="2099-12-31";
$r[num]=0;
$r[renum]=2;
$r[relistnum]=1;
$r[insertnum]=10;
$r[keynum]=0;
$r[keeptime]=0;
$r[smalltextlen]=200;
$r[titlelen]=0;
$r['getfirstspicw']=$public_r['spicwidth'];
$r['getfirstspich']=$public_r['spicheight'];
$pagetype0="";
$pagetype1=" checked";
//複製結點
if($docopy)
{
	$classid=(int)$_GET['classid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsinfoclass where classid='$classid'");
	//採集節點
	if($r[newsclassid])
	{
		$ra=$empire->fetch1("select * from {$dbtbpre}ecms_infoclass_".$r[tbname]." where classid='$classid'");
		$r=TogTwoArray($r,$ra);
	}
	if(empty($r[pagetype]))
	{
		$pagetype0=" checked";
		$pagetype1="";
	}
	else
	{
		$pagetype0="";
		$pagetype1=" checked";
	}
	$url="採集&nbsp;>&nbsp;<a href=".$listclasslink.$ecms_hashur['whehref'].">管理節點</a>&nbsp;>&nbsp;複製節點：".$r[classname];
	$r[classname].="(1)";
}
//修改節點
if($enews=="EditInfoClass")
{
	$classid=(int)$_GET['classid'];
	$r=$empire->fetch1("select * from {$dbtbpre}enewsinfoclass where classid='$classid'");
	//採集節點
	if($r[newsclassid])
	{
		$ra=$empire->fetch1("select * from {$dbtbpre}ecms_infoclass_".$r[tbname]." where classid='$classid'");
		$r=TogTwoArray($r,$ra);
	}
	if(empty($r[pagetype]))
	{
		$pagetype0=" checked";
		$pagetype1="";
	}
	else
	{
		$pagetype0="";
		$pagetype1=" checked";
	}
	$url="採集&nbsp;>&nbsp;<a href=".$listclasslink.$ecms_hashur['whehref'].">管理節點</a>&nbsp;>&nbsp;修改節點";
}
//模型
$modid=$class_r[$r[newsclassid]][modid];
$modr=$empire->fetch1("select enter from {$dbtbpre}enewsmod where mid='$modid'");
//欄目
$options=ShowClass_AddClass("",$r[newsclassid],0,"|-",$class_r[$r[newsclassid]][modid],4);
if($r[retitlewriter])
{
	$retitlewriter=" checked";
}
if($r[copyimg])
{
	$copyimg=" checked";
}
if($r[copyflash])
{$copyflash=" checked";}
//節點
$infoclass=ShowClass_AddInfoClass($r[bclassid],0,"|-",0);

//採集表單文件
$cjfile="../data/html/cj".$class_r[$r[newsclassid]][modid].".php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>增加節點</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function AddRepAd(obj,val){
	var dh='';
	if(obj==1)
	{
		if(document.form1.pagerepad.value!='')
		{
			dh=',';
		}
		document.form1.pagerepad.value+=dh+val;
	}
	else
	{
		if(document.form1.repad.value!='')
		{
			dh=',';
		}
		document.form1.repad.value+=dh+val;
	}
}
</script>
</head>

<body>
<script src="ecmseditor/fieldfile/setday.js"></script>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListInfoClass.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="30%">基本信息</td>
      <td width="70%"><input type=hidden name=from value="<?=ehtmlspecialchars($_GET['from'])?>"> 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> <input name="add[classid]" type="hidden" id="add[classid]" value="<?=$classid?>"> 
        <input name="add[oldbclassid]" type="hidden" id="add[oldbclassid]" value="<?=$r[bclassid]?>"> 
        <input name="add[oldnewsclassid]" type="hidden" id="add[oldnewsclassid]" value="<?=$r[newsclassid]?>"></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">節點名稱：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[classname]" type="text" id="add[classname]" value="<?=$r[classname]?>" size=50> 
        <font color="#666666">(如：體育，娛樂等)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">父節點：</td>
      <td height="23" bgcolor="#FFFFFF"> <select name="bclassid" id="bclassid">
          <option value="0">新建父節點</option>
          <?=$infoclass?>
        </select></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">採集頁面地址：<br>
        <font color="#666666">(一行為一個列表)<br>
        <br>
        <br>
        <input name="add[infourlispage]" type="checkbox" id="add[infourlispage]" value="1"<?=$r[infourlispage]?' checked':''?>>
        </font>採集頁面為直接內容頁</td>
      <td height="23" bgcolor="#FFFFFF"> <textarea name="add[infourl]" cols="72" rows="10" id="add[infourl]"><?=stripSlashes($r[infourl])?></textarea></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">採集頁面地址方式二：<br> <font color="#666666">(此方式，系統自動生成頁面地址)</font></td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td>地址： 
              <input name="add[infourl1]" type="text" id="add[infourl1]2" size="42">
              (分頁變量用 
              <input name="textfield" type="text" value="[page]" size="8">
              替換)</td>
          </tr>
          <tr> 
            <td>頁碼從 
              <input name="add[urlstart]" type="text" id="add[urlstart]4" value="1" size="6">
              到 
              <input name="add[urlend]" type="text" id="add[urlend]3" value="1" size="6">
              之間,間隔倍數 
              <input name="add[urlbs]" type="text" id="add[urlbs]" value="1" size="6"> 
              <input name="add[urldx]" type="checkbox" id="add[urldx]" value="1">
              倒序 
              <input name="add[urlbl]" type="checkbox" id="add[urlbl]" value="1">
              補零</td>
          </tr>
          <tr> 
            <td><font color="#666666">(如:http://www.phome.net/index.php?page=[page])</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">內容頁地址前綴：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[httpurl]" type="text" id="add[httpurl]" value="<?=$r[httpurl]?>" size="50"> 
        <br> <font color="#666666">(如地址前面沒域名的話，系統會加上此前綴)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">圖片/FLASH地址前綴(內容)：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[imgurl]" type="text" id="add[imgurl]" value="<?=$r[imgurl]?>" size="50"> 
        <font color="#666666">(圖片地址為相對地址時使用)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">入庫欄目：</td>
      <td height="23" bgcolor="#FFFFFF"> <select name="newsclassid" id="newsclassid">
          <option value="0">選擇欄目</option>
          <?=$options?>
        </select> <input type="button" name="Submit622232" value="管理欄目" onclick="window.open('ListClass.php<?=$ecms_hashur['whehref']?>');"> 
        <font color="#666666">(如本節點不是採集節點，請不選)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">開始時間：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[startday]" type="text" id="add[startday]" value="<?=$r[startday]?>" size="12" onclick="setday(this)"> 
        <font color="#666666">(格式：2007-11-01)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">結束時間：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[endday]" type="text" id="add[endday]" value="<?=$r[endday]?>" size="12" onclick="setday(this)"> 
        <font color="#666666">(格式：2007-11-01)</font></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">備註：</td>
      <td height="23" bgcolor="#FFFFFF"> <textarea name="add[bz]" cols="72" rows="8" id="add[bz]"><?=ehtmlspecialchars(stripSlashes($r[bz]))?></textarea></td>
    </tr>
    <tr class="header"> 
      <td height="23" colspan="2">選項</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">默認相關關鍵字：</td>
      <td height="23" bgcolor="#FFFFFF">截取標題前 
        <input name="add[keynum]" type="text" id="add[keynum]" value="<?=$r[keynum]?>" size="6">
        個字</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF"> <p>採集記錄數：</p></td>
      <td height="23" bgcolor="#FFFFFF">採集前 
        <input name="add[num]" type="text" id="add[num]" value="<?=$r[num]?>" size="6">
        條記錄<font color="#666666">(&quot;0&quot;為不限，系統會從頭採到頁面尾)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">遠程保存圖片到本地(內容)：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[copyimg]" type="checkbox" id="add[copyimg]" value="1"<?=$copyimg?>>
        (入庫時才會保存, 
        <input name="add[mark]" type="checkbox" id="add[mark]" value="1"<?=$r[mark]==1?' checked':''?>> 
        <a href="SetEnews.php<?=$ecms_hashur['whehref']?>" target="_blank">加水印</a>) </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">遠程保存FLASH到本地(內容)：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[copyflash]" type="checkbox" id="add[copyflash]" value="1"<?=$copyflash?>>
        (入庫時才會保存) </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">標題圖片設置：</td>
      <td height="23" bgcolor="#FFFFFF">取第 
        <input name="add[getfirstpic]" type="text" id="add[getfirstpic]" value="<?=$r[getfirstpic]?>" size="3">
        張圖片為標題圖片( 
        <input name="add[getfirstspic]" type="checkbox" id="add[getfirstspic]" value="1"<?=$r[getfirstspic]==1?' checked':''?>>
        生成縮略圖:寬度 
        <input name="add[getfirstspicw]" type="text" id="add[getfirstspicw]" value="<?=$r[getfirstspicw]?>" size="3">
        ×高度 
        <input name="add[getfirstspich]" type="text" id="add[getfirstspich]" value="<?=$r[getfirstspich]?>" size="3">
        )</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">每組列表採集個數：</td>
      <td height="23" bgcolor="#FFFFFF">每組採集 
        <input name="add[relistnum]" type="text" id="add[relistnum]" value="<?=$r[relistnum]?>" size="6">
        個列表頁<font color="#666666">(防止採集超時) </font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">每組信息採集個數：</td>
      <td height="23" bgcolor="#FFFFFF">每組採集 
        <input name="add[renum]" type="text" id="add[renum]" value="<?=$r[renum]?>" size="6">
        個信息頁<font color="#666666">(防止採集超時)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">每組入庫數：</td>
      <td height="23" bgcolor="#FFFFFF">每組入 
        <input name="add[insertnum]" type="text" id="add[insertnum]" value="<?=$r[insertnum]?>" size="6">
        條記錄<font color="#666666">(防止入庫超時) </font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">每組採集時間間隔</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[keeptime]" type="text" id="add[keeptime]" value="<?=$r[keeptime]?>" size="6">
        秒 <font color="#666666">(0為連續採集)</font></td>
    </tr>
    <tr class="header"> 
      <td height="23" colspan="2">附加選項</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">頁面編碼轉換</td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="1" cellspacing="1">
          <?php
	  $trueenpagecode="<input type='radio' name='add[enpagecode]' value='0'".($r[enpagecode]==0?' checked':'').">正常編碼";
	  if(empty($ecms_config['sets']['pagechar'])||$ecms_config['sets']['pagechar']=='gb2312')
	  {
	  ?>
          <tr> 
            <td height="22">
              <?=$trueenpagecode?>            </td>
            <td><input type="radio" name="add[enpagecode]" value="1"<?=$r[enpagecode]==1?' checked':''?>>
              UTF8-&gt;GB2312</td>
            <td> <input type="radio" name="add[enpagecode]" value="3"<?=$r[enpagecode]==3?' checked':''?>>
              BIG5-&gt;GB2312</td>
            <td><input type="radio" name="add[enpagecode]" value="5"<?=$r[enpagecode]==5?' checked':''?>>
              UNICODE-&gt;GB2312</td>
          </tr>
          <?php
		$trueenpagecode='';
		}
		if(empty($ecms_config['sets']['pagechar'])||$ecms_config['sets']['pagechar']=='big5')
		{
		?>
          <tr> 
            <td height="22">
              <?=$trueenpagecode?>            </td>
            <td> <input type="radio" name="add[enpagecode]" value="2"<?=$r[enpagecode]==2?' checked':''?>>
              UTF8-&gt;BIG5</td>
            <td> <input type="radio" name="add[enpagecode]" value="4"<?=$r[enpagecode]==4?' checked':''?>>
              GB2312-&gt;BIG5</td>
            <td><input type="radio" name="add[enpagecode]" value="6"<?=$r[enpagecode]==6?' checked':''?>>
              UNICODE-&gt;BIG5</td>
          </tr>
          <?php
		 $trueenpagecode='';
		 }
		 if($ecms_config['sets']['pagechar']=='utf-8')
		 {
		 ?>
          <tr> 
            <td height="22">
              <?=$trueenpagecode?>            </td>
            <td><input type="radio" name="add[enpagecode]" value="7"<?=$r[enpagecode]==7?' checked':''?>>
              GB2312-&gt;UTF8</td>
            <td><input type="radio" name="add[enpagecode]" value="8"<?=$r[enpagecode]==8?' checked':''?>>
              BIG5-&gt;UTF8</td>
            <td><input type="radio" name="add[enpagecode]" value="9"<?=$r[enpagecode]==9?' checked':''?>>
              UNICODE-&gt;UTF8</td>
          </tr>
          <?php
		  }
		  ?>
        </table></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">是否重複採集同一鏈接</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[recjtheurl]" type="checkbox" id="add[recjtheurl]" value="1"<?=$r[recjtheurl]==1?' checked':''?>>
        重複採集<font color="#666666">（不選為不重複採集）</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF"><p>是否隱藏已導入的信息</p></td>
      <td height="23" bgcolor="#FFFFFF"><input type="radio" name="add[hiddenload]" value="0"<?=$r[hiddenload]==0?' checked':''?>>
        是 
        <input type="radio" name="add[hiddenload]" value="1"<?=$r[hiddenload]==1?' checked':''?>>
        否</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">採集後自動入庫</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[justloadin]" type="checkbox" id="add[justloadin]" value="1"<?=$r[justloadin]==1?' checked':''?>>
        是， 
        <input name="add[justloadcheck]" type="checkbox" id="add[justloadcheck]" value="1"<?=$r[justloadcheck]==1?' checked':''?>>
        直接審核<font color="#666666">(不推薦選擇，因為可能入庫超時)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[delloadinfo]" type="checkbox" id="add[delloadinfo]" value="1"<?=$r[delloadinfo]==1?' checked':''?>>
        入庫後自動刪除已導入的信息記錄</td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF">整體頁面過濾正則<br> <font color="#666666">格式：廣告開始[!--pad--]廣告結束</font></td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td> <textarea name="pagerepad" cols="60" rows="10" id="textarea"><?=ehtmlspecialchars(stripSlashes($r[pagerepad]))?></textarea>            </td>
            <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<iframe[!--pad--]</iframe>,<IFRAME[!--pad--]</IFRAME>');">IFRAME</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<table[!--pad--]>,</table>,<TABLE[!--pad--]>,</TABLE>');">TABLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<form[!--pad--]</form>,<FORM[!--pad--]</FORM>');">FORM</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<object[!--pad--]</object>,<OBJECT[!--pad--]</OBJECT>');">OBJECT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<tr[!--pad--]>,</tr>,<TR[!--pad--]>,</TR>');">TR</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<tbody[!--pad--]>,</tbody>,<TBODY[!--pad--]>,</TBODY>');">TBODY</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<script[!--pad--]</script>,<SCRIPT[!--pad--]</SCRIPT>');">SCRIPT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<td[!--pad--]>,</td>,<TD[!--pad--]>,</TD>');">TD</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<style[!--pad--]</style>,<STYLE[!--pad--]</STYLE>');">STYLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<a[!--pad--]>,</a>,<A[!--pad--]>,</A>');">A</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<div[!--pad--]>,</div>,<DIV[!--pad--]>,</DIV>');">DIV</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<font[!--pad--]>,</font>,<FONT[!--pad--]>,</FONT>');">FONT</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(1,'<span[!--pad--]>,</span>,<SPAN[!--pad--]>,</SPAN>');">SPAN</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(1,'<img[!--pad--]>,<IMG[!--pad--]>');">IMG</a></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><font color="#666666">(多個請用&quot;,&quot;格開)</font></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="23" rowspan="2" valign="top" bgcolor="#FFFFFF">整體頁面替換</td>
      <td height="11" bgcolor="#FFFFFF">將 
        <textarea name="add[oldpagerep]" cols="36" rows="10" id="add[oldpagerep]"><?=ehtmlspecialchars(stripSlashes($r[oldpagerep]))?></textarea>
        替換成 
        <textarea name="add[newpagerep]" cols="36" rows="10" id="textarea4"><?=ehtmlspecialchars(stripSlashes($r[newpagerep]))?></textarea>      </td>
    </tr>
    <tr> 
      <td height="11" bgcolor="#FFFFFF"><font color="#666666">(原字符多個請用&quot;,&quot;格開,如果是新字符是多個，可以用&quot;,&quot;格開，系統會對應替換)</font></td>
    </tr>
    <tr class="header"> 
      <td height="23" colspan="2">過濾選項</td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">採集關鍵字(包含關鍵字才會采)：</td>
      <td height="23" bgcolor="#FFFFFF"> <input name="add[keyboard]" type="text" id="add[keyboard]" value="<?=$r[keyboard]?>"> 
        <font color="#666666">(只針對標題。如不限制，請留空。多個請用&quot;,&quot;格開)</font></td>
    </tr>
    <tr> 
      <td rowspan="2" valign="top" bgcolor="#FFFFFF">替換：<br>
        (針對標題與內容) </td>
      <td height="23" bgcolor="#FFFFFF">將 
        <textarea name="add[oldword]" cols="36" rows="10" id="add[oldword]"><?=ehtmlspecialchars(stripSlashes($r[oldword]))?></textarea>
        替換成 
        <textarea name="add[newword]" cols="36" rows="10" id="add[newword]"><?=ehtmlspecialchars(stripSlashes($r[newword]))?></textarea>      </td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF"><font color="#666666">(原字符多個請用&quot;,&quot;格開,如果是新字符是多個，可以用&quot;,&quot;格開，系統會對應替換)</font></td>
    </tr>
    <tr> 
      <td height="23" valign="top" bgcolor="#FFFFFF"><strong>過濾廣告正則：</strong><br> 
        <font color="#666666">格式：廣告開始[!--ad--]廣告結束<br>
        (針對內容) </font></td>
      <td height="23" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td> <textarea name="repad" cols="60" rows="10" id="repad"><?=ehtmlspecialchars(stripSlashes($r[repad]))?></textarea>            </td>
            <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<iframe[!--ad--]</iframe>,<IFRAME[!--ad--]</IFRAME>');">IFRAME</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<table[!--ad--]>,</table>,<TABLE[!--ad--]>,</TABLE>');">TABLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<form[!--ad--]</form>,<FORM[!--ad--]</FORM>');">FORM</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<object[!--ad--]</object>,<OBJECT[!--ad--]</OBJECT>');">OBJECT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<tr[!--ad--]>,</tr>,<TR[!--ad--]>,</TR>');">TR</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<tbody[!--ad--]>,</tbody>,<TBODY[!--ad--]>,</TBODY>');">TBODY</a></td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<script[!--ad--]</script>,<SCRIPT[!--ad--]</SCRIPT>');">SCRIPT</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<td[!--ad--]>,</td>,<TD[!--ad--]>,</TD>');">TD</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<style[!--ad--]</style>,<STYLE[!--ad--]</STYLE>');">STYLE</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<a[!--ad--]>,</a>,<A[!--ad--]>,</A>');">A</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<div[!--ad--]>,</div>,<DIV[!--ad--]>,</DIV>');">DIV</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<font[!--ad--]>,</font>,<FONT[!--ad--]>,</FONT>');">FONT</a></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td><a href="#ecms" onclick="AddRepAd(0,'<span[!--ad--]>,</span>,<SPAN[!--ad--]>,</SPAN>');">SPAN</a></td>
                  <td><a href="#ecms" onclick="AddRepAd(0,'<img[!--ad--]>,<IMG[!--ad--]>');">IMG</a></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><font color="#666666">(多個請用&quot;,&quot;格開)</font></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">內容為空不採集</td>
      <td height="23" bgcolor="#FFFFFF"><input name="add[newstextisnull]" type="checkbox" id="add[newstextisnull]" value="1"<?=$r[newstextisnull]==1?' checked':''?>>
        是<font color="#666666"> (newstext字段)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">過濾相似：</td>
      <td height="23" bgcolor="#FFFFFF">不採集標題相似超過 
        <input name="add[titlelen]" type="text" id="add[titlelen]" value="<?=$r[titlelen]?>" size="6">
        字的信息[與入庫信息比較]<font color="#666666">(如不限制請填&quot;0&quot;)</font></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="23" bgcolor="#FFFFFF">不採集標題完全相同的信息(與入庫信息比較) 
        <input name="add[retitlewriter]" type="checkbox" id="add[retitlewriter]" value="1"<?=$retitlewriter?>></td>
    </tr>
    <tr> 
      <td height="23" bgcolor="#FFFFFF">截取內容簡介：</td>
      <td height="23" bgcolor="#FFFFFF"> <p>截取信息內容 
          <input name="add[smalltextlen]" type="text" id="add[smalltextlen]" value="<?=$r[smalltextlen]?>" size="6">
          個字<font color="#666666">（在沒有設置「內容簡介」正則，系統採取的措施）</font></p></td>
    </tr>
    <tr class="header"> 
      <td height="25" colspan="2">採集內容正則(不採集項，請留空)</td>
    </tr>
    <tr> 
      <td bgcolor="#C7D4F7">列表頁</td>
      <td bgcolor="#C7D4F7">&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF"><strong>信息鏈接區域正則：</strong><br>
        (<font color="#FF0000">如不限，請為空</font>)<br>
        截取的地方加上 
        <input name="textfield" type="text" id="textfield" value="[!--smallurl--]" size="20"> 
        <br>
        如：&lt;tr&gt;&lt;td&gt;鏈接區域&lt;/td&gt;&lt;/tr&gt;<br>
        正則就是:<br> &lt;tr&gt;&lt;td&gt;[!--smallurl--]&lt;/td&gt;&lt;/tr&gt;</td>
      <td bgcolor="#FFFFFF"> <textarea name="add[zz_smallurl]" cols="60" rows="10" id="textarea8"><?=ehtmlspecialchars(stripSlashes($r[zz_smallurl]))?></textarea></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF"><strong>信息頁鏈接正則：</strong><br>
        截取的地方加上 
        <input name="textfield" type="text" id="textfield3" value="[!--newsurl--]" size="20"> 
        <br>
        如：&lt;a href=&quot;信息鏈接&quot;&gt;標題&lt;/a&gt;<br>
        正則就是:<br> &lt;a href=&quot;[!--newsurl--]&quot;&gt;*&lt;/a&gt;</td>
      <td bgcolor="#FFFFFF"> <textarea name="add[zz_newsurl]" cols="60" rows="10" id="add[zz_newsurl]"><?=ehtmlspecialchars(stripSlashes($r[zz_newsurl]))?></textarea></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF"><p><strong>標題圖片正則：<br>
          (如圖片在內容頁，請留空)</strong><br>
          <input name="textfield" type="text" id="textfield" value="[!--titlepic--]" size="20">
        </p></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td>圖片地址前綴： 
              <input name="add[qz_titlepicl]" type="text" id="add[qz_titlepicl]" value="<?=stripSlashes($r[qz_titlepicl])?>" size="32"> 
              <input name="add[save_titlepicl]" type="checkbox" id="add[save_titlepicl]" value=" checked"<?=$r[save_titlepicl]?>>
              保存本地 </td>
          </tr>
          <tr> 
            <td><textarea name="add[zz_titlepicl]" cols="60" rows="10" id="add[zz_titlepicl]"><?=ehtmlspecialchars(stripSlashes($r[zz_titlepicl]))?></textarea></td>
          </tr>
          <tr> 
            <td><input name="add[z_titlepicl]" type="text" id="add[z_titlepicl]" value="<?=stripSlashes($r[z_titlepicl])?>" size="32">
              (如填這裡，將為此字段值)</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="2" bgcolor="C7D4F7">內容頁(文件過大的請不要選擇保存本地)</td>
    </tr>
    <?php
	@include($cjfile);
	?>
    <tr> 
      <td colspan="2" bgcolor="C7D4F7">內容頁分頁採集設置:(如沒有分頁請留空,只對newstext有效)</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">入庫是否保留原分頁：</td>
      <td bgcolor="#FFFFFF"><input type="radio" name="add[doaddtextpage]" value="0"<?=$r[doaddtextpage]==0?' checked':''?>>
        保留分頁
        <input type="radio" name="add[doaddtextpage]" value="1"<?=$r[doaddtextpage]==1?' checked':''?>>
        不保留分頁</td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF">分頁形式:</td>
      <td bgcolor="#FFFFFF"> <input type="radio" name="add[pagetype]" value="0"<?=$pagetype0?>>
        上下頁導航式 
        <input type="radio" name="add[pagetype]" value="1"<?=$pagetype1?>>
        全部列出式 </td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#FFFFFF">&quot;全部列出&quot;式正則設置:</td>
      <td bgcolor="#FFFFFF"> <table width="100%%" border="0" cellspacing="1" cellpadding="2">
          <tr> 
            <td width="50%" height="23"><strong>分頁區域正則(<font color="#FF0000">[!--smallpageallzz--]</font>)</strong></td>
            <td><strong>分頁鏈接正則(<font color="#FF0000">[!--pageallzz--]</font>)</strong></td>
          </tr>
          <tr> 
            <td><textarea name="add[smallpageallzz]" cols="42" rows="12" id="textarea2"><?=ehtmlspecialchars(stripSlashes($r[smallpageallzz]))?></textarea></td>
            <td><textarea name="add[pageallzz]" cols="42" rows="12" id="textarea3"><?=ehtmlspecialchars(stripSlashes($r[pageallzz]))?></textarea></td>
          </tr>
        </table></td>
    </tr>
	<tr> 
      <td valign="top" bgcolor="#FFFFFF">&quot;上下頁導航&quot;式正則設置:</td>
      <td bgcolor="#FFFFFF"> <table width="100%%" border="0" cellspacing="1" cellpadding="2">
          <tr> 
            <td width="50%" height="23"><strong>分頁區域正則(<font color="#FF0000">[!--smallpagezz--]</font>)</strong></td>
            <td><strong>分頁鏈接正則(<font color="#FF0000">[!--pagezz--]</font>)</strong></td>
          </tr>
          <tr> 
            <td><textarea name="add[smallpagezz]" cols="42" rows="12" id="add[smallpagezz]"><?=ehtmlspecialchars(stripSlashes($r[smallpagezz]))?></textarea></td>
            <td><textarea name="add[pagezz]" cols="42" rows="12" id="add[pagezz]"><?=ehtmlspecialchars(stripSlashes($r[pagezz]))?></textarea></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="提交"> <input type="reset" name="Submit2" value="重置">      </td>
    </tr>
  </table>
  <br>
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td><strong>注意事項：<font color="#FF0000"><br>
        </font></strong>1.*:表示不限制內容。行與行之間的間隔最好用*格開<br>
        2.增加節點後，最好先「預覽」。<br>
        3.對於特殊字符請在前面加上「\\」，當然直接將特殊字符改為「*」最合適了。特殊字符如下：<br>
        ),(,{,}，[,]，\，?<br>
        4.同一信息鏈接系統不會重複採集。</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>