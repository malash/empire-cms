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

$doobject=(int)$_GET['doobject'];
$selfdoobject=(int)$_GET['selfdoobject'];
$addselfinfo=(int)$_GET['addselfinfo'];
$selfinfooption='';
$parentclass=(int)$_GET['parentclass'];
$addparentclass='';
if($parentclass)
{
	$addparentclass='父';
}
//操作對像
if($doobject==2)//按欄目
{
	//操作類型
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="0">欄目最新信息</option>
			  <option value="1">欄目點擊排行</option>
			  <option value="2">欄目推薦信息</option>
			  <option value="9">欄目評論排行</option>
			  <option value="12">欄目頭條信息</option>
			  <option value="15">欄目下載排行</option>
              </select></td>
          </tr>
        </table>';
	//選擇欄目
	$fcfile='../../data/fc/ListEnews.php';
	$class="<script src=../../data/fc/cmsclass.js></script>";
	if(!file_exists($fcfile))
	{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
	if($addselfinfo==1)
	{
	}
	elseif($addselfinfo==2)//一級欄目+當前欄目
	{
		$selfinfooption='<option value="\'selfinfo\'">當前欄目</option><option value="\'0\'">一級欄目</option>';
	}
	elseif($addselfinfo==3)//一級欄目
	{
		$selfinfooption='<option value="\'0\'">一級欄目</option>';
	}
	elseif($addselfinfo==4)//不限欄目
	{
		$selfinfooption='<option value="0">不限欄目</option>';
	}
	else
	{
		$selfinfooption='<option value="\'selfinfo\'">當前欄目</option>';
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇'.$addparentclass.'欄目：</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$selfinfooption.'
			  '.$class.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==3)//按專題
{
	//操作類型
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="6">專題最新信息</option>
			  <option value="7">專題點擊排行</option>
			  <option value="8">專題推薦信息</option>
			  <option value="11">專題評論排行</option>
			  <option value="14">專題頭條信息</option>
			  <option value="17">專題下載排行</option>
              </select></td>
          </tr>
        </table>';
	//選擇專題
	$ztclass='';
	$ztsql=$empire->query("select ztid,ztname from {$dbtbpre}enewszt order by ztid desc");
	while($ztr=$empire->fetch($ztsql))
	{
		$ztclass.="<option value='".$ztr['ztid']."'>".$ztr['ztname']."</option>";
	}
	if($addselfinfo==1)
	{
	}
	else
	{
		$selfinfooption='<option value="\'selfinfo\'">當前專題</option>';
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇專題：</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$selfinfooption.'
			  '.$ztclass.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==4)//按數據表
{
	//操作類型
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="18">表最新信息</option>
			  <option value="19">表點擊排行</option>
			  <option value="20">表推薦信息</option>
			  <option value="21">表評論排行</option>
			  <option value="22">表頭條信息</option>
			  <option value="23">表下載排行</option>
              </select></td>
          </tr>
        </table>';
	//選擇數據表
	$tb='';
	$tbsql=$empire->query("select tbname,tname from {$dbtbpre}enewstable order by tid");
	while($tbr=$empire->fetch($tbsql))
	{
		$tb.="<option value=\"'".$tbr[tbname]."'\">".$tbr[tname]."</option>";
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇數據表：</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$tb.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==5)//按標題分類
{
	//操作類型
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="25">標題分類最新信息</option>
			  <option value="26">標題分類點擊排行</option>
			  <option value="27">標題分類推薦信息</option>
			  <option value="28">標題分類評論排行</option>
			  <option value="29">標題分類頭條信息</option>
			  <option value="30">標題分類下載排行</option>
              </select></td>
          </tr>
        </table>';
	//選擇標題分類
	$tts='';
	$ttsql=$empire->query("select typeid,tname from {$dbtbpre}enewsinfotype order by typeid");
	while($ttr=$empire->fetch($ttsql))
	{
		$tts.="<option value='$ttr[typeid]'>$ttr[tname]</option>";
	}
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇標題分類：</td>
            <td width="76%"><select name="classid" id="select2">
			  '.$tts.'
              </select></td>
          </tr>
        </table>';
}
elseif($doobject==6)//按SQL
{
	//操作類型
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="24">SQL查詢</option>
              </select></td>
          </tr>
        </table>';
	//選擇SQL
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇：</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="\'sql語句\'">SQL查詢</option>
              </select></td>
          </tr>
        </table>';
}
else//按默認表
{
	//操作類型
	$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="3">默認表最新信息</option>
			  <option value="4">默認表點擊排行</option>
			  <option value="5">默認表推薦信息</option>
			  <option value="10">默認表評論排行</option>
			  <option value="13">默認表頭條信息</option>
			  <option value="16">默認表下載排行</option>
              </select></td>
          </tr>
        </table>';
	//選擇SQL
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇：</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="0">默認表('.$public_r[tbname].')</option>
              </select></td>
          </tr>
        </table>';
}

//標籤模板
$bqname=RepPostStr($_GET['bqname'],1);
if(empty($bqname))
{
	$bqname='ecmsinfo';
}
$mydotype=RepPostStr($_GET['mydotype'],1);
$defchangeobject=RepPostStr($_GET['defchangeobject'],1);
if($defchangeobject==1)
{
	$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇：</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="\'\'">默認</option>
              </select></td>
          </tr>
        </table>';
}
if($bqname=='ecmsinfo'||$bqname=='listsonclass'||$bqname=='otherlink'||$bqname=='eshowphoto'||$bqname=='tagsinfo'||$bqname=='showclasstemp'||$bqname=='eshowzt'||$bqname=='listshowclass'||$bqname=='gbookinfo'||$bqname=='showplinfo')
{
	$bqtemp='';
	$bqtempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsbqtemp")." order by tempid");
	while($bqtempr=$empire->fetch($bqtempsql))
	{
		$bqtemp.="<option value='".$bqtempr[tempid]."'>".$bqtempr[tempname]."</option>";
	}
}
//當前使用的模板組
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>帝國網站管理系統--標籤生成</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript">
window.resizeTo(800,600);
window.focus();
</script>
<script>
//返回附加SQL
function ReturnAddSql(addsql,orderby){
	var addstr='';
	var r;
	var yh="'";
	if(addsql!=''||orderby!='')
	{
		r=addsql.split("'");
		if(r.length!=1)
		{
			yh='"';
		}
		if(addsql!='')
		{
			addstr+=','+yh+addsql+yh;
		}
		else
		{
			addstr+=",''";
		}
		if(orderby!='')
		{
			addstr+=",'"+orderby+"'";
		}
	}
	return addstr;
}

//返回是否加單引號
function ReturnAddYh(tids){
	var r;
	if(tids=='')
	{
		return "''";
	}
	r=tids.split(",");
	if(r.length!=1)
	{
		tids="'"+tids+"'";
	}
	return tids;
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td height="25">選擇標籤： 
      <select name="bq" id="bq" style= "font-size:16px;" onchange="if(this.options[this.selectedIndex].value!=''){self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname='+this.options[this.selectedIndex].value}">
        <option value="" style="background-color:#AFCFF3">信息調用標籤</option>
        <option value="ecmsinfo"<?=$bqname=='ecmsinfo'?' selected':''?>>&nbsp; &gt; 萬能標籤調用 (ecmsinfo)</option>
		<option value="eloop"<?=$bqname=='eloop'?' selected':''?>>&nbsp; &gt; 靈動標籤 (e:loop)</option>
		<option value="eindexloop"<?=$bqname=='eindexloop'?' selected':''?>>&nbsp; &gt; 索引靈動標籤 (e:indexloop)</option>
        <option value="phomenews"<?=$bqname=='phomenews'?' selected':''?>>&nbsp; &gt; 文字調用標籤 (phomenews)</option>
        <option value="phomenewspic"<?=$bqname=='phomenewspic'?' selected':''?>>&nbsp; &gt; 圖文信息調用[標題圖片的信息] (phomenewspic)</option>
        <option value="phomeflashpic"<?=$bqname=='phomeflashpic'?' selected':''?>>&nbsp; &gt; FLASH幻燈信息調用 (phomeflashpic)</option>
		<option value="listsonclass&doobject=2&addselfinfo=2"<?=$bqname=='listsonclass'?' selected':''?>>&nbsp; &gt; 循環子欄目數據標籤 (listsonclass)</option>
		<option value="otherlink&defchangeobject=1"<?=$bqname=='otherlink'?' selected':''?>>&nbsp; &gt; 相關鏈接標籤 (otherlink)</option>
		<option value="tagsinfo"<?=$bqname=='tagsinfo'?' selected':''?>>&nbsp; &gt; 調用TAGS的信息標籤 (tagsinfo)</option>
		<option value="spinfo"<?=$bqname=='spinfo'?' selected':''?>>&nbsp; &gt; 調用碎片的信息標籤 (spinfo)</option>
		<option value="showtags"<?=$bqname=='showtags'?' selected':''?>>&nbsp; &gt; 調用TAGS標籤 (showtags)</option>
        <option value="totaldata&doobject=2&addselfinfo=1"<?=$bqname=='totaldata'?' selected':''?>>&nbsp; &gt; 網站信息統計 (totaldata)</option>
        <option value="eshowphoto"<?=$bqname=='eshowphoto'?' selected':''?>>&nbsp; &gt; 圖庫模型分頁標籤 (eshowphoto)</option>
        <option value="showsearch&doobject=2&addselfinfo=4"<?=$bqname=='showsearch'?' selected':''?>>&nbsp; &gt; 搜索關鍵字調用標籤 (showsearch)</option>
        <option value="" style="background-color:#AFCFF3">欄目調用標籤</option>
        <option value="showclasstemp&doobject=2&addselfinfo=2&parentclass=1"<?=$bqname=='showclasstemp'?' selected':''?>>&nbsp; &gt; 帶模板的欄目導航標籤 (showclasstemp)</option>
        <option value="eshowzt"<?=$bqname=='eshowzt'?' selected':''?>>&nbsp; &gt; 專題調用標籤 (eshowzt)</option>
        <option value='listshowclass&doobject=2&addselfinfo=2&parentclass=1'<?=$bqname=='listshowclass'?' selected':''?>>&nbsp; &gt; 循環欄目導航標籤 (listshowclass)</option>
        <option value="" style="background-color:#AFCFF3">非信息調用標籤</option>
        <option value="phomead"<?=$bqname=='phomead'?' selected':''?>>&nbsp; &gt; 廣告調用標籤 (phomead)</option>
        <option value="phomevote"<?=$bqname=='phomevote'?' selected':''?>>&nbsp; &gt; 投票調用標籤 (phomevote)</option>
        <option value="phomelink"<?=$bqname=='phomelink'?' selected':''?>>&nbsp; &gt; 友情鏈接調用標籤 (phomelink)</option>
        <option value="gbookinfo"<?=$bqname=='gbookinfo'?' selected':''?>>&nbsp; &gt; 留言板調用標籤 (gbookinfo)</option>
        <option value="showplinfo"<?=$bqname=='showplinfo'?' selected':''?>>&nbsp; &gt; 評論調用標籤 (showplinfo)</option>
        <option value="echocheckbox"<?=$bqname=='echocheckbox'?' selected':''?>>&nbsp; &gt; 復選字段輸出內容標籤 (echocheckbox)</option>
		<option value="" style="background-color:#AFCFF3">會員相關調用</option>
		<option value="ShowMemberInfo"<?=$bqname=='ShowMemberInfo'?' selected':''?>>會員信息調用函數 (ShowMemberInfo)</option>
		<option value="ListMemberInfo"<?=$bqname=='ListMemberInfo'?' selected':''?>>會員列表調用函數 (ListMemberInfo)</option>
		<option value="spaceeloop"<?=$bqname=='spaceeloop'?' selected':''?>>會員空間信息標籤調用 (spaceeloop)</option>
        <option value="" style="background-color:#AFCFF3">其它標籤</option>
        <option value="includefile"<?=$bqname=='includefile'?' selected':''?>>&nbsp; &gt; 引用文件標籤 (includefile)</option>
        <option value="readhttp"<?=$bqname=='readhttp'?' selected':''?>>&nbsp; &gt; 讀取遠程頁面 (readhttp)</option>
      </select></td>
  </tr>
</table>
<br>
<?php
if($bqname=='ecmsinfo')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var ftempid=obj.tempid.value;
	var fispic=obj.ispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[ecmsinfo]"+fclassid+","+fline+","+ftitlelen+","+fshowclass+","+fdotype+","+ftempid+","+fispic+addstr+"[/ecmsinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">ecmsinfo標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選擇調用對像： 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>按默認表(
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>欄目</option>
          <option value="4"<?=$doobject==4?' selected':''?>>數據表</option>
          <option value="5"<?=$doobject==5?' selected':''?>>標題分類</option>
          <option value="6"<?=$doobject==6?' selected':''?>>按SQL調用</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select3">
                <?=$bqtemp?>
              </select>
              <input type="button" name="Submit6222323" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示欄目名：</td>
            <td width="76%"><select name="showclass" id="showclass">
                <option value="0">否</option>
                <option value="1">是</option>
              </select> <font color="#666666">(標籤模板要加[!--class.name--])</font> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">只調用有標題圖片的信息： 
        <select name="ispic" id="ispic">
          <option value="0">不限</option>
          <option value="1">是</option>
        </select></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="isgood=1">1級推薦</option>
<option value="firsttitle=1">1級頭條</option>
<option value="field='值'">字段等於某值</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="newstime DESC">按發佈時間降序排序</option>
<option value="newstime ASC">按發佈時間升序排序</option>
<option value="id DESC">按ID降序排序</option>
<option value="onclick DESC">按點擊率降序排序</option>
<option value="totaldown DESC">按下載數降序排序</option>
<option value="plnum DESC">按評論數降序排序</option>
<option value="diggtop DESC">按頂數(digg)降序排序</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();">
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#ecmsinfo" target="_blank" title="查看詳細標籤語法">[ecmsinfo]欄目ID/標題分類ID,顯示條數,標題截取數,是否顯示欄目名,操作類型,模板ID,只顯示有標題圖片,附加SQL條件,顯示排序[/ecmsinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eloop')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fdotype=obj.dotype.value;
	var fispic=obj.ispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[e:loop={"+fclassid+","+fline+","+fdotype+","+fispic+addstr+"}]\r\n<a href=\"<?="<?=\$bqsr['titleurl']?>"?>\" target=\"_blank\"><?="<?=\$bqr['title']?>"?></a> <br>\r\n[/e:loop]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">靈動標籤(e:loop)生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選擇調用對像： 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>按默認表( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>欄目</option>
          <option value="4"<?=$doobject==4?' selected':''?>>數據表</option>
          <option value="5"<?=$doobject==5?' selected':''?>>標題分類</option>
          <option value="6"<?=$doobject==6?' selected':''?>>按SQL調用</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">只調用有標題圖片的信息： 
        <select name="ispic" id="select6">
          <option value="0">不限</option>
          <option value="1">是</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="isgood=1">1級推薦</option>
<option value="firsttitle=1">1級頭條</option>
<option value="field='值'">字段等於某值</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="newstime DESC">按發佈時間降序排序</option>
<option value="newstime ASC">按發佈時間升序排序</option>
<option value="id DESC">按ID降序排序</option>
<option value="onclick DESC">按點擊率降序排序</option>
<option value="totaldown DESC">按下載數降序排序</option>
<option value="plnum DESC">按評論數降序排序</option>
<option value="diggtop DESC">按頂數(digg)降序排序</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eloop" target="_blank" title="查看詳細標籤語法">[e:loop={欄目ID/標題分類ID,顯示條數,操作類型,只顯示有標題圖片,附加SQL條件,顯示排序}]<br>
        模板代碼內容<br>
      [/e:loop]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eindexloop')
{
	if($selfdoobject==9)//專題子類
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="4">專題子類最新信息</option>
			  <option value="5">專題子類最早信息</option>
			  <option value="6">專題子類推薦信息</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="查看專題ID" onclick="window.open(\'../special/ListZt.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(當前專題ID用：\'selfinfo\'，多個ID用「,」號隔開)</font>';
	}
	elseif($selfdoobject==7)//TAGS
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="9">TAGS最新信息</option>
			  <option value="10">TAGS最早信息</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="查看TAGS的ID" onclick="window.open(\'../tags/ListTags.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(多個ID用「,」號隔開)</font>';
	}
	elseif($selfdoobject==8)//碎片
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="7">碎片最新信息</option>
			  <option value="8">碎片最早信息</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="查看碎片ID" onclick="window.open(\'../sp/ListSp.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(多個ID用「,」號隔開)</font>';
	}
	elseif($selfdoobject==6)//按SQL
	{
		//操作類型
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="11">SQL查詢</option>
              </select></td>
          </tr>
        </table>';
		//選擇SQL
		$changeobject='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">選擇：</td>
            <td width="76%"><select name="classid" id="select2">
			  <option value="\'sql語句\'">SQL查詢</option>
              </select></td>
          </tr>
        </table>';
	}
	else//專題
	{
		$dotype='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select">
			  <option value="1">專題最新信息</option>
			  <option value="2">專題最早信息</option>
			  <option value="3">專題推薦信息</option>
              </select></td>
          </tr>
        </table>';
		$changeobject='<input name="classid" type="text" id="classid" value="0"><input type="button" name="Submit42" value="查看專題ID" onclick="window.open(\'../special/ListZt.php'.$ecms_hashur['whehref'].'\');"><font color="#666666">(當前專題ID用：\'selfinfo\'，多個ID用「,」號隔開)</font>';
	}
	
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fdotype=obj.dotype.value;
	var fuseclassid=obj.useclassid.value;
	var fmodid=obj.modid.value;
	var faddsql=obj.addsql.value;
	var forderby='';
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[e:indexloop={"+fclassid+","+fline+","+fdotype+",'"+fuseclassid+"','"+fmodid+"'"+addstr+"}]\r\n<a href=\"<?="<?=\$bqsr['titleurl']?>"?>\" target=\"_blank\"><?="<?=\$bqr['title']?>"?></a> <br>\r\n[/e:indexloop]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eindexloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">索引靈動標籤(e:indexloop)生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選擇調用對像： 
        <select name="selfdoobject" id="selfdoobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&selfdoobject='+this.options[this.selectedIndex].value">
          <option value="3"<?=$selfdoobject==3?' selected':''?>>專題</option>
		  <option value="9"<?=$selfdoobject==9?' selected':''?>>專題子類</option>
          <option value="7"<?=$selfdoobject==7?' selected':''?>>TAGS</option>
          <option value="8"<?=$selfdoobject==8?' selected':''?>>碎片</option>
		  <option value="6"<?=$selfdoobject==6?' selected':''?>>按SQL調用</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF">
	<?=$dotype?>
              </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%">所屬欄目ID：</td>
          <td width="76%"><input name="useclassid" type="text" id="useclassid"> <font color="#666666">(多個ID用,號隔開)</font></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%">所屬系統模型ID：</td>
          <td width="76%"><input name="modid" type="text" id="line6"> <font color="#666666">(多個ID用,號隔開)</font></td>
        </tr>
      </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="輸出標籤" onclick="ShowBqFun();">      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eindexloop" target="_blank" title="查看詳細標籤語法">[e:indexloop={索引分類ID,顯示條數,操作類型,欄目ID,系統模型ID,附加SQL條件}]<br>
        模板代碼內容<br>
      [/e:indexloop]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomenews')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var fshowtime=obj.showtime.value;
	var fformattime=obj.formattime.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[phomenews]"+fclassid+","+fline+","+ftitlelen+","+fshowtime+","+fdotype+","+fshowclass+",'"+fformattime+"'"+addstr+"[/phomenews]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomenews標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選擇調用對像： 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>按默認表( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>欄目</option>
          <option value="4"<?=$doobject==4?' selected':''?>>數據表</option>
          <option value="5"<?=$doobject==5?' selected':''?>>標題分類</option>
          <option value="6"<?=$doobject==6?' selected':''?>>按SQL調用</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示欄目名：</td>
            <td width="76%"><select name="showclass" id="select2">
                <option value="0">否</option>
                <option value="1">是</option>
              </select> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">是否顯示時間：</td>
            <td width="76%"><select name="showtime" id="select4">
                <option value="0">否</option>
                <option value="1">是</option>
              </select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">時間格式：</td>
            <td width="76%"><input name="formattime" type="text" id="formattime" value="(m-d)"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="isgood=1">1級推薦</option>
<option value="firsttitle=1">1級頭條</option>
<option value="field='值'">字段等於某值</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="newstime DESC">按發佈時間降序排序</option>
<option value="newstime ASC">按發佈時間升序排序</option>
<option value="id DESC">按ID降序排序</option>
<option value="onclick DESC">按點擊率降序排序</option>
<option value="totaldown DESC">按下載數降序排序</option>
<option value="plnum DESC">按評論數降序排序</option>
<option value="diggtop DESC">按頂數(digg)降序排序</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomenews" target="_blank" title="查看詳細標籤語法">[phomenews]欄目ID/標題分類ID,顯示條數,標題截取數,是否顯示時間,操作類型,是否顯示欄目名,'時間格式化',附加SQL條件,顯示排序[/phomenews]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomenewspic')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var flnum=obj.lnum.value;
	var ftitlelen=obj.titlelen.value;
	var fshowtitle=obj.showtitle.value;
	var fdotype=obj.dotype.value;
	var fpicwidth=obj.picwidth.value;
	var fpicheight=obj.picheight.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[phomenewspic]"+fclassid+","+fline+","+flnum+","+fpicwidth+","+fpicheight+","+fshowtitle+","+ftitlelen+","+fdotype+addstr+"[/phomenewspic]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomenewspic標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選擇調用對像： 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>按默認表( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>欄目</option>
          <option value="4"<?=$doobject==4?' selected':''?>>數據表</option>
          <option value="5"<?=$doobject==5?' selected':''?>>標題分類</option>
          <option value="6"<?=$doobject==6?' selected':''?>>按SQL調用</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用總數量：</td>
            <td width="76%"><input name="lnum" type="text" id="line3" value="8"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">每行顯示數量：</td>
            <td width="76%"><input name="line" type="text" id="num" value="4"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">圖片大小：</td>
            <td width="76%">寬
<input name="picwidth" type="text" id="picwidth" value="170" size="6">
              ×高 
              <input name="picheight" type="text" id="picheight" value="120" size="6"> </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">是否顯示標題：</td>
            <td width="76%"><select name="showtitle" id="select5">
                <option value="0">否</option>
                <option value="1">是</option>
              </select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen" value="26"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="isgood=1">1級推薦</option>
<option value="firsttitle=1">1級頭條</option>
<option value="field='值'">字段等於某值</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="newstime DESC">按發佈時間降序排序</option>
<option value="newstime ASC">按發佈時間升序排序</option>
<option value="id DESC">按ID降序排序</option>
<option value="onclick DESC">按點擊率降序排序</option>
<option value="totaldown DESC">按下載數降序排序</option>
<option value="plnum DESC">按評論數降序排序</option>
<option value="diggtop DESC">按頂數(digg)降序排序</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomenewspic" target="_blank" title="查看詳細標籤語法">[phomenewspic]欄目ID/標題分類ID,每行顯示條數,顯示總信息數,圖片寬度,圖片高度,是否顯示標題,標題截取數,操作類型,附加SQL條件,顯示排序[/phomenewspic]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomeflashpic')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fkeeptime=obj.keeptime.value;
	var ftitlelen=obj.titlelen.value;
	var fshowtitle=obj.showtitle.value;
	var fdotype=obj.dotype.value;
	var fpicwidth=obj.picwidth.value;
	var fpicheight=obj.picheight.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[phomeflashpic]"+fclassid+","+fline+","+fpicwidth+","+fpicheight+","+fshowtitle+","+ftitlelen+","+fdotype+","+fkeeptime+addstr+"[/phomeflashpic]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomeflashpic標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選擇調用對像： 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>按默認表( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>欄目</option>
          <option value="4"<?=$doobject==4?' selected':''?>>數據表</option>
          <option value="5"<?=$doobject==5?' selected':''?>>標題分類</option>
          <option value="6"<?=$doobject==6?' selected':''?>>按SQL調用</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line3" value="5"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">停頓秒數：</td>
            <td width="76%"><input name="keeptime" type="text" id="num" value="0">
              <font color="#666666">(0為默認)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">圖片大小：</td>
            <td width="76%">寬
<input name="picwidth" type="text" id="picwidth" value="170" size="6">
              ×高 
              <input name="picheight" type="text" id="picheight" value="120" size="6"> </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">是否顯示標題：</td>
            <td width="76%"><select name="showtitle" id="select5">
                <option value="0">否</option>
                <option value="1">是</option>
              </select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen" value="26"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="isgood=1">1級推薦</option>
<option value="firsttitle=1">1級頭條</option>
<option value="field='值'">字段等於某值</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="newstime DESC">按發佈時間降序排序</option>
<option value="newstime ASC">按發佈時間升序排序</option>
<option value="id DESC">按ID降序排序</option>
<option value="onclick DESC">按點擊率降序排序</option>
<option value="totaldown DESC">按下載數降序排序</option>
<option value="plnum DESC">按評論數降序排序</option>
<option value="diggtop DESC">按頂數(digg)降序排序</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomeflashpic" target="_blank" title="查看詳細標籤語法">[phomeflashpic]欄目ID/標題分類ID,顯示總數,圖片寬度,圖片高度,是否顯示標題,標題截取數,操作類型,停頓秒數,附加SQL條件,顯示排序[/phomeflashpic]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='listsonclass')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var ftempid=obj.tempid.value;
	var fispic=obj.ispic.value;
	var fclassnum=obj.classnum.value;
	var ffirstdotype=obj.firstdotype.value;
	var ffirsttitlelen=obj.firsttitlelen.value;
	var ffirstsmalltextlen=obj.firstsmalltextlen.value;
	var ffirstispic=obj.firstispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="[listsonclass]"+fclassid+","+fline+","+ftitlelen+","+fshowclass+","+fdotype+","+ftempid+","+fispic+","+fclassnum+","+ffirstdotype+","+ffirsttitlelen+","+ffirstsmalltextlen+","+ffirstispic+addstr+"[/listsonclass]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">listsonclass標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="dotype">
                <option value="0">欄目最新</option>
                <option value="1">欄目熱門</option>
                <option value="2">欄目推薦</option>
                <option value="3">欄目評論排行</option>
                <option value="4">欄目頭條</option>
                <option value="5">欄目下載排行</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用信息數：</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select7">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223232" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen3" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示欄目名：</td>
            <td width="76%"><select name="showclass" id="select8">
                <option value="0">否</option>
                <option value="1">是</option>
              </select> <font color="#666666">(標籤模板要加[!--class.name--])</font> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">只調用有標題圖片的信息： 
        <select name="ispic" id="select9">
          <option value="0">不限</option>
          <option value="1">是</option>
        </select></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制欄目數量：</td>
            <td width="76%"><input name="classnum" type="text" id="titlelen4" value="0"> 
              <font color="#666666">(0為不限制)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">頭條操作類型：</td>
            <td width="76%"><select name="firstdotype" id="select10">
                <option value="0">不顯示欄目頭條</option>
                <option value="1">欄目內容簡介</option>
                <option value="2">欄目推薦信息</option>
                <option value="3">欄目頭條信息</option>
                <option value="4">欄目最新信息</option>
              </select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">頭條標題截取字數：</td>
            <td width="76%"><input name="firsttitlelen" type="text" id="firsttitlelen" value="32"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">頭條簡介截取字數：</td>
            <td width="76%"><input name="firstsmalltextlen" type="text" id="firstsmalltextlen" value="0"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">頭條只調用有標題圖片的信息： 
        <select name="firstispic" id="select11">
          <option value="0">不限</option>
          <option value="1">是</option>
        </select></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql2"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="isgood=1">1級推薦</option>
<option value="firsttitle=1">1級頭條</option>
<option value="field='值'">字段等於某值</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby2"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="newstime DESC">按發佈時間降序排序</option>
<option value="newstime ASC">按發佈時間升序排序</option>
<option value="id DESC">按ID降序排序</option>
<option value="onclick DESC">按點擊率降序排序</option>
<option value="totaldown DESC">按下載數降序排序</option>
<option value="plnum DESC">按評論數降序排序</option>
<option value="diggtop DESC">按頂數(digg)降序排序</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#listsonclass" target="_blank" title="查看詳細標籤語法">[listsonclass]欄目ID,顯示條數,標題截取數,是否顯示欄目名,操作類型,模板ID,只顯示有標題圖片,顯示欄目數,顯示頭條操作類型,頭條標題截取數,頭條簡介截取數,頭條只顯示有標題圖片,附加SQL條件,顯示排序[/listsonclass]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='totaldata')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var fclassid=obj.classid.value;
	var flimittime=obj.limittime.value;
	var fdotype=obj.dotype.value;
	var ftotaltype=obj.totaltype.value;
	bqstr="[totaldata]"+fclassid+","+fdotype+","+flimittime+","+ftotaltype+"[/totaldata]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">totaldata標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select12" onchange="var addurl='';if(this.options[this.selectedIndex].value==0){addurl='&doobject=2';}else if(this.options[this.selectedIndex].value==1){addurl='&doobject=5';}else if(this.options[this.selectedIndex].value==2){addurl='&doobject=4';}self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&addselfinfo=1&mydotype='+this.options[this.selectedIndex].value+addurl;">
                <option value="0"<?=$mydotype==0?' selected':''?>>統計欄目數據</option>
                <option value="1"<?=$mydotype==1?' selected':''?>>統計標題分類</option>
                <option value="2"<?=$mydotype==2?' selected':''?>>統計數據表</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">時間範圍：</td>
            <td width="76%"><select name="limittime" id="select13">
                <option value="0">不限</option>
                <option value="1">今日</option>
                <option value="2">本月</option>
                <option value="3">本年</option>
              </select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%">統計類型：</td>
          <td width="76%"><select name="totaltype" id="select29">
            <option value="0">統計信息數</option>
            <option value="1">統計評論數</option>
            <option value="2">統計點擊數</option>
            <option value="3">統計下載數</option>
                    </select></td>
        </tr>
      </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#totaldata" target="_blank" title="查看詳細標籤語法">[totaldata]欄目ID,操作類型,時間範圍,統計類型[/totaldata]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='otherlink')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fshowclass=obj.showclass.value;
	var fdotype=obj.dotype.value;
	var ftempid=obj.tempid.value;
	var fispic=obj.ispic.value;
	bqstr="[otherlink]"+ftempid+","+fclassid+","+fline+","+ftitlelen+","+fshowclass+","+fdotype+","+fispic+"[/otherlink]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">otherlink標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="dotype" onchange="var addurl='';if(this.options[this.selectedIndex].value==0){addurl='&defchangeobject=1';}else if(this.options[this.selectedIndex].value==1){addurl='&doobject=4';}else if(this.options[this.selectedIndex].value==2){addurl='&doobject=2';}else if(this.options[this.selectedIndex].value==5){addurl='&doobject=5';}self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&addselfinfo=1&mydotype='+this.options[this.selectedIndex].value+addurl;">
                <option value="0"<?=$mydotype==0?' selected':''?>>默認</option>
                <option value="1"<?=$mydotype==1?' selected':''?>>按數據表</option>
                <option value="2"<?=$mydotype==2?' selected':''?>>按欄目</option>
                <option value="5"<?=$mydotype==5?' selected':''?>>按標題分類</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select3">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit6222323" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示欄目名：</td>
            <td width="76%"><select name="showclass" id="showclass">
                <option value="0">否</option>
                <option value="1">是</option>
              </select> <font color="#666666">(標籤模板要加[!--class.name--])</font> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">只調用有標題圖片的信息： 
        <select name="ispic" id="ispic">
          <option value="0">不限</option>
          <option value="1">是</option>
        </select></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#otherlink" target="_blank" title="查看詳細標籤語法">[otherlink]標籤模板ID,操作對像,調用條數,標題截取字數,是否顯示欄目名,操作類型,只顯示標題圖片的信息[/otherlink]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eshowphoto')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var ftempid=obj.tempid.value;
	var fpicwidth=obj.picwidth.value;
	var fpicheight=obj.picheight.value;
	bqstr="[eshowphoto]"+ftempid+","+fpicwidth+","+fpicheight+"[/eshowphoto]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eshowphoto">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">eshowphoto標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="tempid">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223233" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">導航圖片大小：</td>
            <td width="76%">寬
<input name="picwidth" type="text" id="picwidth" value="170" size="6">
              ×高 
              <input name="picheight" type="text" id="picheight" value="120" size="6"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eshowphoto" target="_blank" title="查看詳細標籤語法">[eshowphoto]標籤模板ID,導航圖片寬度,導航圖片高度[/eshowphoto]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showsearch')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var fclassid=obj.classid.value;
	var fdotype=obj.dotype.value;
	var flnum=obj.lnum.value;
	var fline=obj.line.value;
	bqstr="[showsearch]"+fline+","+flnum+","+fclassid+","+fdotype+"[/showsearch]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="showsearch">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showsearch標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="dotype">
                <option value="0">搜索熱門排行</option>
                <option value="1">最新搜索排行</option>
              </select></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用總數量：</td>
            <td width="76%"><input name="lnum" type="text" id="lnum" value="8"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">每行顯示數量：</td>
            <td width="76%"><input name="line" type="text" id="line" value="4"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showsearch" target="_blank" title="查看詳細標籤語法">[showsearch]每行顯示條數,總條數,欄目id,操作類型[/showsearch]</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='tagsinfo')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=ReturnAddYh(obj.classid.value);
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var ftids=ReturnAddYh(obj.tids.value);
	var ftempid=obj.tempid.value;
	var fmids=ReturnAddYh(obj.mids.value);
	bqstr="[tagsinfo]"+ftids+","+fline+","+ftitlelen+","+ftempid+","+fclassid+","+fmids+"[/tagsinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="tagsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">tagsinfo標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">TAGS的ID：</td>
            <td width="76%"><input name="tids" type="text" id="tids"> <input type="button" name="Submit4" value="查看TAGS" onclick="window.open('../tags/ListTags.php<?=$ecms_hashur['whehref']?>');">
              <font color="#666666">(多個ID用,號隔開)</font></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="tempid">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223234" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line3" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制欄目ID：</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              <font color="#666666">
              <input type="button" name="Submit42" value="查看欄目ID" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');">
              (0為不限，多個ID用,號隔開)</font> </td>
          </tr>
        </table> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制系統模型ID：</td>
            <td width="76%"><input name="mids" type="text" id="mids" value="0">
              <font color="#666666"> (0為不限，多個ID用,號隔開)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#tagsinfo" target="_blank" title="查看詳細標籤語法">[tagsinfo]TAGS的ID,顯示條數,標題截取數,標籤模板ID,欄目ID,系統模型ID[/tagsinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='spinfo')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var ftitlelen=obj.titlelen.value;
	var fvname=obj.vname.value;
	bqstr="[spinfo]'"+fvname+"',"+fline+","+ftitlelen+"[/spinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="spinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">spinfo標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">碎片變量名：</td>
            <td width="76%"><input name="vname" type="text" id="vname">
              <input type="button" name="Submit43" value="查看碎片" onclick="window.open('../sp/ListSp.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標題截取字數：</td>
            <td width="76%"><input name="titlelen" type="text" id="titlelen2" value="32"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp; </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#spinfo" target="_blank" title="查看詳細標籤語法">[spinfo]碎片變量名,顯示條數,標題截取數[/spinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showtags')
{
	$tagsclass='';
	$tcsql=$empire->query("select classid,classname from {$dbtbpre}enewstagsclass order by classid");
	while($tcr=$empire->fetch($tcsql))
	{
		$tagsclass.='<option value="'.$tcr[classid].'">'.$tcr[classname].'</option>';
	}
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var tfont='';
	var dh='';
	var fclassid=obj.tagsclassid.value;
	var flnum=obj.lnum.value;
	var fline=obj.line.value;
	var forderby=obj.orderby.value;
	var fisgood=obj.isgood.value;
	var fjg=obj.jg.value;
	var fshownum=obj.shownum.value;
	var faddcs=obj.addcs.value;
	var fvartype=obj.vartype.value;
	//屬性
	if(obj.tfontb.checked==true)
	{
		tfont+='s';
		dh=',';
	}
	if(obj.tfontr.checked==true)
	{
		tfont+=dh+'r';
	}
	bqstr="[showtags]"+fclassid+","+flnum+","+fline+",'"+forderby+"',"+fisgood+",'"+tfont+"','"+fjg+"',"+fshownum+",'"+faddcs+"','"+fvartype+"'[/showtags]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="showtags">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showtags標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">選擇TAGS分類：</td>
            <td width="76%"><select name="tagsclassid" id="tagsclassid">
                <option value="''">不限</option>
                <option value="'selfinfo'">調用當前信息TAGS</option>
                <?=$tagsclass?>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用總數量：</td>
            <td width="76%"><input name="lnum" type="text" id="lnum" value="10"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">每行顯示數量：</td>
            <td width="76%"><input name="line" type="text" id="titlelen2" value="0">
              <font color="#666666">(0為不換行) </font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby"> <select name="selectorderby" id="select" onchange="document.bqform.orderby.value=document.bqform.selectorderby.value">
                <option value="">默認排序</option>
                <option value="tagid desc">按TAGSID降序</option>
                <option value="num desc">按信息數降序</option>
              </select>
              <font color="#666666">(調用當前TAGS本設置無效)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">只顯示推薦的：</td>
            <td width="76%"><select name="isgood" id="select14">
                <option value="0">不限</option>
                <option value="1">是</option>
              </select>
              <font color="#666666">(調用當前TAGS本設置無效)</font> </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">推薦TAGS屬性：</td>
            <td width="76%"><input name="tfontb" type="checkbox" id="tfontb" value="1">
              加粗 <input name="tfontr" type="checkbox" id="tfontr" value="1">
              加紅<font color="#666666">(調用當前TAGS本設置無效)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示間隔符：</td>
            <td width="76%"><input name="jg" type="text" id="line2" value="&amp;nbsp;"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示信息數量：</td>
            <td width="76%"><select name="shownum" id="select16">
                <option value="0">不顯示</option>
                <option value="1">顯示</option>
              </select>
              <font color="#666666">(調用當前TAGS本設置無效)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">鏈接附加參數：</td>
            <td width="76%"><input name="addcs" type="text" id="line4">
              <font color="#666666">(比如：&amp;tempid=模板ID) </font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">鏈接使用變量：</td>
            <td width="76%"><select name="vartype">
				<option value="tagname">tagname</option>
                <option value="tagid">tagid</option>
              </select>
              <font color="#666666">(比如：tagname=帝國或tagid=1)</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showtags" target="_blank" title="查看詳細標籤語法">[showtags]分類ID,顯示數量,每行顯示數量,顯示排序,只顯示推薦,推薦TAGS屬性,顯示間隔符,是否顯示信息數,鏈接附加參數,鏈接使用變量[/showtags]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showclasstemp')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fshownum=obj.shownum.value;
	var ftempid=obj.tempid.value;
	var fclassnum=obj.classnum.value;
	bqstr="[showclasstemp]"+fclassid+","+ftempid+","+fshownum+","+fclassnum+"[/showclasstemp]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showclasstemp標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select15">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223235" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示欄目信息數：</td>
            <td width="76%"><select name="shownum" id="select17">
                <option value="0">不顯示</option>
                <option value="1">顯示</option>
              </select>
              <font color="#666666">(標籤模板加[!--num--])</font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制顯示欄目數：</td>
            <td width="76%"><input name="classnum" type="text" id="titlelen5" value="0">
              <font color="#666666">(0為不限制)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showclasstemp" target="_blank" title="查看詳細標籤語法">[showclasstemp]父欄目ID,標籤模板ID,是否顯示欄目信息數,顯示欄目數[/showclasstemp]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='eshowzt')
{
	//分類
	$zcstr='';
	$zcsql=$empire->query("select classid,classname from {$dbtbpre}enewsztclass order by classid");
	while($zcr=$empire->fetch($zcsql))
	{
		$zcstr.="<option value='".$zcr[classid]."'>".$zcr[classname]."</option>";
	}
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=ReturnAddYh(obj.classid.value);
	var fzcid=obj.zcid.value;
	var ftempid=obj.tempid.value;
	var fclassnum=obj.classnum.value;
	bqstr="[eshowzt]"+ftempid+","+fzcid+","+fclassnum+","+fclassid+"[/eshowzt]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">eshowzt標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select20">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit622232353" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制專題分類：</td>
            <td width="76%"><select name="zcid" id="select19">
                <option value="0">不限</option>
				<?=$zcstr?>
              </select> <input type="button" name="Submit622232352" value="管理專題分類" onclick="window.open('../special/ListZtClass.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制顯示專題數：</td>
            <td width="76%"><input name="classnum" type="text" id="classnum" value="0"> 
              <font color="#666666">(0為不限制)</font> </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制所屬欄目ID：</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0"> 
              <font color="#666666"> 
              <input type="button" name="Submit422" value="查看欄目ID" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');">
              (0為不限，多個ID用,號隔開)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#eshowzt" target="_blank" title="查看詳細標籤語法">[eshowzt]標籤模板ID,專題類別ID,顯示專題數,所屬欄目ID[/eshowzt]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='listshowclass')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fshownum=obj.shownum.value;
	var ftempid=obj.tempid.value;
	var fclassnum=obj.classnum.value;
	bqstr="[listshowclass]"+fclassid+","+ftempid+","+fshownum+","+fclassnum+"[/listshowclass]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">listshowclass標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select15">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit62223235" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示欄目信息數：</td>
            <td width="76%"><select name="shownum" id="select17">
                <option value="0">不顯示</option>
                <option value="1">顯示</option>
              </select>
              <font color="#666666">(標籤模板加[!--num--])</font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制顯示欄目數：</td>
            <td width="76%"><input name="classnum" type="text" id="titlelen5" value="0">
              <font color="#666666">(0為不限制)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#listshowclass" target="_blank" title="查看詳細標籤語法">[listshowclass]父欄目ID,標籤模板ID,是否顯示欄目信息數,顯示欄目數[/listshowclass]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomead')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	bqstr="[phomead]"+fclassid+"[/phomead]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomead標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">廣告ID：</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              <input type="button" name="Submit622232354" value="查看廣告ID" onclick="window.open('../tool/ListAd.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomead" target="_blank" title="查看詳細標籤語法">[phomead]廣告ID[/phomead]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomevote')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	bqstr="[phomevote]"+fclassid+"[/phomevote]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomevote標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">投票ID：</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              <input type="button" name="Submit622232354" value="查看投票ID" onclick="window.open('../tool/ListVote.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomevote" target="_blank" title="查看詳細標籤語法">[phomevote]投票ID[/phomevote]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='phomelink')
{
	//類別
	$cstr='';
	$csql=$empire->query("select classid,classname from {$dbtbpre}enewslinkclass order by classid");
	while($cr=$empire->fetch($csql))
	{
		$cstr.="<option value='".$cr[classid]."'>".$cr[classname]."</option>";
	}
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var flnum=obj.lnum.value;
	var fcid=obj.cid.value;
	var fdotype=obj.dotype.value;
	var fshowlink=obj.showlink.value;
	bqstr="[phomelink]"+fline+","+flnum+","+fdotype+","+fcid+","+fshowlink+"[/phomelink]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">phomelink標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select20">
                <option value="0">所有鏈接</option>
                <option value="1">只調用圖片鏈接</option>
                <option value="2">只調用文字鏈接</option>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制分類：</td>
            <td width="76%"><select name="cid" id="select19">
                <option value="0">不限</option>
                <?=$cstr?>
              </select> <input type="button" name="Submit622232352" value="管理友情鏈接分類" onclick="window.open('../tool/LinkClass.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用總數量：</td>
            <td width="76%"><input name="lnum" type="text" id="lnum" value="12"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">每行顯示數量：</td>
            <td width="76%"><input name="line" type="text" id="line5" value="6">
            </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示原鏈接：</td>
            <td width="76%"><select name="showlink" id="select18">
                <option value="0">統計點擊鏈接</option>
                <option value="1">顯示原鏈接</option>
              </select> </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#phomelink" target="_blank" title="查看詳細標籤語法">[phomelink]每行顯示數,顯示總數,操作類型,分類id,是否顯示原鏈接[/phomelink]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='gbookinfo')
{
	//分類
	$cstr='';
	$csql=$empire->query("select bid,bname from {$dbtbpre}enewsgbookclass order by bid");
	while($cr=$empire->fetch($csql))
	{
		$cstr.="<option value='".$cr[bid]."'>".$cr[bname]."</option>";
	}
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var fcid=obj.cid.value;
	var ftempid=obj.tempid.value;
	bqstr="[gbookinfo]"+fline+","+ftempid+","+fcid+"[/gbookinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">gbookinfo標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select20">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit622232353" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制留言分類：</td>
            <td width="76%"><select name="cid" id="select19">
                <option value="0">不限</option>
				<?=$cstr?>
              </select> <input type="button" name="Submit622232352" value="管理留言分類" onclick="window.open('../tool/GbookClass.php<?=$ecms_hashur['whehref']?>');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line" value="5">
            </td>
          </tr>
        </table> </td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#gbookinfo" target="_blank" title="查看詳細標籤語法">[gbookinfo]顯示信息數,標籤模板ID,留言分類ID[/gbookinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='showplinfo')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fline=obj.line.value;
	var fclassid=obj.classid.value;
	var fid=obj.id.value;
	var ftempid=obj.tempid.value;
	var fisgood=obj.isgood.value;
	var fdotype=obj.dotype.value;
	bqstr="[showplinfo]"+fline+","+ftempid+","+fclassid+","+fid+","+fisgood+","+fdotype+"[/showplinfo]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">showplinfo標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數</td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="select22">
                <option value="0">按發佈時間排列</option>
                <option value="1">按支持數排列</option>
                <option value="2">按反對數排列</option>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">標籤模板：</td>
            <td width="76%"><select name="tempid" id="select21">
                <?=$bqtemp?>
              </select> <input type="button" name="Submit6222323532" value="管理標籤模板" onclick="window.open('ListBqtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
          </tr>
        </table> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制欄目ID：</td>
            <td width="76%"><input name="classid" type="text" id="classid" value="0">
              [<a href="#empirecms" onclick="document.bqform.classid.value='$GLOBALS[navclassid]';">當前欄目ID</a>] 
              <font color="#666666"> 
              <input type="button" name="Submit4222" value="查看欄目ID" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');">
              (0為不限)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制信息ID：</td>
            <td width="76%"><input name="id" type="text" id="id" value="0">
              [<a href="#empirecms" onclick="document.bqform.id.value='$navinfor[id]';">當前信息ID</a>] <font color="#666666"> (0為不限)</font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">只調用推薦評論：</td>
            <td width="76%"><select name="isgood" id="select23">
                <option value="0">不限</option>
                <option value="1">只調用推薦評論</option>
              </select> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#showplinfo" target="_blank" title="查看詳細標籤語法">[showplinfo]調用條數,標籤模板ID,欄目ID,信息ID,顯示推薦評論,操作類型[/showplinfo]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='echocheckbox')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfield=obj.lfield.value;
	var fexpstr=obj.expstr.value;
	bqstr="[echocheckbox]'"+flfield+"','"+fexpstr+"'[/echocheckbox]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">echocheckbox標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">復選字段名：</td>
            <td width="76%"><input name="lfield" type="text" id="lfield" value="title">
            </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">分隔符：</td>
            <td width="76%"><input name="expstr" type="text" id="expstr" value="&lt;br&gt;"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#echocheckbox" target="_blank" title="查看詳細標籤語法">[echocheckbox]'字段','分隔符'[/echocheckbox]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='includefile')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfile=obj.lfile.value;
	bqstr="[includefile]'"+flfile+"'[/includefile]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">includefile標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">引用文件地址：</td>
            <td width="76%"><input name="lfile" type="text" id="lfile" value="../../header.html">
              <font color="#666666">(相對於後台目錄)</font> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#includefile" target="_blank" title="查看詳細標籤語法">[includefile]'文件地址'[/includefile]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='readhttp')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfile=obj.lfile.value;
	bqstr="[readhttp]'"+flfile+"'[/readhttp]";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ecmsinfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">readhttp標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">讀取網頁地址：</td>
            <td width="76%"><input name="lfile" type="text" id="lfile" value="http://">
            </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#readhttp" target="_blank" title="查看詳細標籤語法">[readhttp]'頁面地址'[/readhttp]</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='ShowMemberInfo')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var flfield=obj.lfield.value;
	var fmuserid=obj.muserid.value;
	bqstr="<?="<?php\\r\\n\$userr=sys_ShowMemberInfo(\"+fmuserid+\",'\"+flfield+\"');\\r\\n?>"?>\r\n";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ShowMemberInfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">ShowMemberInfo函數調用生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">會員帳號ID：</td>
            <td width="76%"><input name="muserid" type="text" id="muserid" value="0">
              <input type="button" name="Submit62223235222" value="查看會員ID" onclick="window.open('../member/ListMember.php<?=$ecms_hashur['whehref']?>');">
              <font color="#666666">(0為發佈者ID)</font></td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">查詢字段：</td>
            <td width="76%"> 
              <input name="lfield" type="text" id="lfield">
              <font color="#666666">(空為查詢所有會員字段)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#ShowMemberInfo" target="_blank" title="查看詳細標籤語法">sys_ShowMemberInfo(用戶ID,查詢字段)</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="5" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='ListMemberInfo')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var tfont='';
	var dh='';
	var fdotype=obj.dotype.value;
	var fline=obj.line.value;
	var fmgroupid=obj.mgroupid.value;
	var fmuserid=obj.muserid.value;
	var flfield=obj.lfield.value;
	bqstr="<?="<?php\\r\\n\$usersql=sys_ListMemberInfo(\"+fline+\",\"+fdotype+\",'\"+fmgroupid+\"','\"+fmuserid+\"','\"+flfield+\"');\\r\\nwhile(\$userr=\$empire->fetch(\$usersql))\\r\\n{\\r\\n?>\\r\\n<a href=\\\"/e/space/?userid=<?=\$userr[userid]?>\\\"><?=\$userr[username]?></a><br>\\r\\n<?php\\r\\n}\\r\\n?>"?>";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ListMemberInfo">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">ListMemberInfo調用函數生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">標籤基本參數 </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">操作類型：</td>
            <td width="76%"><select name="dotype" id="dotype">
                <option value="0">按註冊時間排序</option>
                <option value="1">按積分排序排序</option>
                <option value="2">按資金排行排序</option>
                <option value="3">按會員空間人氣排行排序</option>
              </select> </td>
          </tr>
        </table></td>
      <td width="50%" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line7" value="10"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">限制會員組ID：</td>
            <td width="76%"><input name="mgroupid" type="text" id="mgroupid">
              <input type="button" name="Submit622232352222" value="查看會員組ID" onclick="window.open('../member/ListMemberGroup.php<?=$ecms_hashur['whehref']?>');"> 
              <font color="#666666">(不設置為不限，多個會員組用逗號隔開，如：'1,2') </font></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">會員帳號ID：</td>
            <td width="76%"><input name="muserid" type="text" id="muserid"> 
              <input type="button" name="Submit622232352223" value="查看會員ID" onclick="window.open('../member/ListMember.php<?=$ecms_hashur['whehref']?>');">
              <font color="#666666">(不設置為不限，多個用戶ID用逗號隔開，如：'25,27')</font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">查詢字段：</td>
            <td width="76%"> <input name="lfield" type="text" id="lfield3"> <font color="#666666">(空為查詢所有會員字段)</font> 
            </td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><font color="#333333"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#ListMemberInfo" target="_blank" title="查看詳細標籤語法">sys_ListMemberInfo(調用條數,操作類型,會員組ID,用戶ID,查詢字段)</a></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit2" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
elseif($bqname=='spaceeloop')
{
?>
<script>
//返回標籤
function ShowBqFun(){
	var obj=document.bqform;
	var bqstr;
	var addstr='';
	var fclassid=obj.classid.value;
	var fline=obj.line.value;
	var fdotype=obj.dotype.value;
	var fispic=obj.ispic.value;
	var faddsql=obj.addsql.value;
	var forderby=obj.orderby.value;
	addstr=ReturnAddSql(faddsql,forderby);
	bqstr="<?="<?php\\r\\n\$spacesql=espace_eloop(\"+fclassid+\",\"+fline+\",\"+fdotype+\",\"+fispic+addstr+\");\\r\\nwhile(\$spacer=\$empire->fetch(\$spacesql))\\r\\n{\\r\\n        \$spacesr=espace_eloop_sp(\$spacer);\\r\\n?>\\r\\n<a href=\\\"<?=\$spacesr[titleurl]?>\\\" target=\\\"_blank\\\"><?=\$spacer[title]?></a> <br>\\r\\n<?php\\r\\n}\\r\\n?>"?>";
	obj.bqshow.value=bqstr;
}
</script>
<form action="MakeBq.php" method="GET" name="bqform" id="bqform">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="spaceeloop">
	<?=$ecms_hashur['eform']?>
    <tr> 
      <td height="25" colspan="2" class="header">spaceeloop會員空間靈動標籤生成 
        <input name="bqname" type="hidden" id="bqname" value="<?=$bqname?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選擇調用對像： 
        <select name="doobject" id="doobject" onchange="self.location.href='MakeBq.php?<?=$ecms_hashur['ehref']?>&bqname=<?=$bqname?>&addselfinfo=1&doobject='+this.options[this.selectedIndex].value">
          <option value="1"<?=$doobject==1?' selected':''?>>按默認表( 
          <?=$public_r['tbname']?>
          )</option>
          <option value="2"<?=$doobject==2?' selected':''?>>欄目</option>
          <option value="5"<?=$doobject==5?' selected':''?>>標題分類</option>
          <option value="4"<?=$doobject==4?' selected':''?>>數據表</option>
          <option value="5"<?=$doobject==5?' selected':''?>>標題分類</option>
          <option value="6"<?=$doobject==6?' selected':''?>>按SQL調用</option>
        </select> </td>
    </tr>
    <tr> 
      <td width="50%" height="25" bgcolor="#FFFFFF"> 
        <?=$dotype?>
      </td>
      <td width="50%" bgcolor="#FFFFFF"> 
        <?=$changeobject?>
      </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">調用數量：</td>
            <td width="76%"><input name="line" type="text" id="line" value="10"></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF">只調用有標題圖片的信息： 
        <select name="ispic" id="select6">
          <option value="0">不限</option>
          <option value="1">是</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" colspan="2">選項設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">附加SQL條件：</td>
            <td width="76%"><input name="addsql" type="text" id="addsql"> <select name="addsqlselect" onchange="document.bqform.addsql.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="isgood=1">1級推薦</option>
<option value="firsttitle=1">1級頭條</option>
<option value="field='值'">字段等於某值</option>
</select></td>
          </tr>
        </table></td>
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="24%">顯示排序：</td>
            <td width="76%"><input name="orderby" type="text" id="orderby"> <select name="orderbyselect" onchange="document.bqform.orderby.value=this.value">
<option value=""> -- 預選項 -- </option>
<option value="newstime DESC">按發佈時間降序排序</option>
<option value="newstime ASC">按發佈時間升序排序</option>
<option value="id DESC">按ID降序排序</option>
<option value="onclick DESC">按點擊率降序排序</option>
<option value="totaldown DESC">按下載數降序排序</option>
<option value="plnum DESC">按評論數降序排序</option>
<option value="diggtop DESC">按頂數(digg)降序排序</option>
</select></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><input type="button" name="Submit3" value="輸出標籤" onclick="ShowBqFun();"> 
      </td>
    </tr>
    <tr>
      <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="EnewsBq.php<?=$ecms_hashur['whehref']?>#spaceeloop" target="_blank" title="查看詳細標籤語法">&lt;?php<br>
        $spacesql=espace_eloop(欄目ID,顯示條數,操作類型,只顯示有標題圖片,附加SQL條件,顯示排序);<br>
        while($spacer=$empire-&gt;fetch($spacesql))<br>
        {<br>
        $spacesr=espace_eloop_sp($spacer);<br>
        ?&gt;<br>
        模板代碼內容<br>
        &lt;?php<br>
        }<br>
        ?&gt;</a></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><textarea name="bqshow" cols="65" rows="12" id="bqshow" style="width:100%"></textarea></td>
          </tr>
          <tr> 
            <td height="25"><input type="button" name="Submit22" value="複製上面標籤內容" onclick="window.clipboardData.setData('Text',document.bqform.bqshow.value);document.bqform.bqshow.select()"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html>
<?php
db_close();
$empire=null;
?>
