<?php
define('EmpireCMSAdmin','1');
require('../../class/connect.php');
require('../../class/db_sql.php');
require('../../class/functions.php');
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

$enews=ehtmlspecialchars($_GET['enews']);
$ztid=(int)$_GET['ztid'];
if($enews=='EditZt')
{
	//驗證權限
	$returnandlevel=CheckAndUsernamesLevel('dozt',$ztid,$logininid,$loginin,$loginlevel);
}
else
{
	//驗證權限
	CheckLevel($logininid,$loginin,$classid,"zt");
	$returnandlevel=2;
}
$url="<a href=ListZt.php".$ecms_hashur['whehref'].">管理專題</a>&nbsp;>&nbsp;增加專題";
$postword='增加專題';
//初使化數據
$r[reorder]="newstime DESC";
$r[maxnum]=0;
$r[ztnum]=25;
$r[zttype]=".html";
$r[newline]=10;
$r[hotline]=10;
$r[goodline]=10;
$r[hotplline]=10;
$r[firstline]=10;
$pripath='s/';
//複製專題
$docopy=RepPostStr($_GET['docopy'],1);
if($docopy&&$enews=="AddZt")
{
	$copyclass=1;
}
$ecmsfirstpost=1;
if($enews=='EditZt')
{
	$filepass=$ztid;
}
else
{
	$filepass=ReturnTranFilepass();
}
//修改專題
if($enews=="EditZt"||$copyclass)
{
	$ecmsfirstpost=0;
	if($copyclass)
	{
		$thisdo="複製";
	}
	else
	{
		$thisdo="修改";
	}
	$r=$empire->fetch1("select * from {$dbtbpre}enewszt where ztid='$ztid'");
	$addr=$empire->fetch1("select * from {$dbtbpre}enewsztadd where ztid='$ztid'");
	$usernames=substr($r['usernames'],1,-1);
	$url="<a href=ListZt.php".$ecms_hashur['whehref'].">管理專題</a>&nbsp;>&nbsp;".$thisdo."專題：".$r[ztname];
	$postword=$thisdo.'專題';
	//專題目錄
	$mycr=GetPathname($r[ztpath]);
	$pripath=$mycr[1];
	$ztpath=$mycr[0];
	//複製專題
	if($copyclass)
	{
		$r[ztname].='(1)';
		$ztpath.='1';
	}
}
//列表模板
$msql=$empire->query("select mid,mname from {$dbtbpre}enewsmod order by myorder,mid");
while($mr=$empire->fetch($msql))
{
	$listtemp_options.="<option value=0 style='background:#99C4E3'>".$mr[mname]."</option>";
	$l_sql=$empire->query("select tempid,tempname from ".GetTemptb("enewslisttemp")." where modid='$mr[mid]'");
	while($l_r=$empire->fetch($l_sql))
	{
		if($l_r[tempid]==$r[listtempid])
		{$l_d=" selected";}
		else
		{$l_d="";}
		$listtemp_options.="<option value=".$l_r[tempid].$l_d."> |-".$l_r[tempname]."</option>";
	}
}
//欄目
$options=ShowClass_AddClass("",$r[classid],0,"|-",0,0);
//封面模板
$classtempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewsclasstemp")." order by tempid");
while($classtempr=$empire->fetch($classtempsql))
{
	$select="";
	if($r[classtempid]==$classtempr[tempid])
	{
		$select=" selected";
	}
	$classtemp.="<option value='".$classtempr[tempid]."'".$select.">".$classtempr[tempname]."</option>";
}
//評論模板
$pltemp='';
$pltempsql=$empire->query("select tempid,tempname from ".GetTemptb("enewspltemp")." order by tempid");
while($pltempr=$empire->fetch($pltempsql))
{
	$select="";
	if($r[pltempid]==$pltempr[tempid])
	{
		$select=" selected";
	}
	$pltemp.="<option value='".$pltempr[tempid]."'".$select.">".$pltempr[tempname]."</option>";
}
//分類
$zcstr="";
$zcsql=$empire->query("select classid,classname from {$dbtbpre}enewsztclass order by classid");
while($zcr=$empire->fetch($zcsql))
{
	$select="";
	if($zcr[classid]==$r[zcid])
	{
		$select=" selected";
	}
	$zcstr.="<option value='".$zcr[classid]."'".$select.">".$zcr[classname]."</option>";
}
//優化方案
$yh_options='';
$yhsql=$empire->query("select id,yhname from {$dbtbpre}enewsyh order by id");
while($yhr=$empire->fetch($yhsql))
{
	$select='';
	if($r[yhid]==$yhr[id])
	{
		$select=' selected';
	}
	$yh_options.="<option value='".$yhr[id]."'".$select.">".$yhr[yhname]."</option>";
}
$from=(int)$_GET['from'];
//當前使用的模板組
$thegid=GetDoTempGid();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>增加專題</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
//檢查
function CheckForm(obj){
	if(obj.ztname.value=='')
	{
		alert("請輸入專題名稱");
		obj.ztname.focus();
		return false;
	}
	if(obj.ztpath.value=="")
	{
		alert("請輸入專題目錄");
		obj.ztpath.focus();
		return false;
	}
	if(obj.listtempid.value==0)
	{
		alert("請選擇列表模板");
		obj.listtempid.focus();
		return false;
	}
}
  </script>
<script src="../ecmseditor/fieldfile/setday.js"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置： 
      <?=$url?>
    </td>
  </tr>
</table>
<br>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../ecmsclass.php" onsubmit="return CheckForm(document.form1);">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> 
        <?=$postword?>
        <input type=hidden name=enews value=<?=$enews?>> <input name="from" type="hidden" id="from" value="<?=$from?>"></td>
    </tr>
    <tr> 
      <td height="25" colspan="2">基本屬性</td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">專題名稱(*)</td>
      <td width="76%" height="25" bgcolor="#FFFFFF"> <input name="ztname" type="text" id="ztname" value="<?=$r[ztname]?>" size="38"> 
        <?php
	  if($enews=="AddZt")
	  {
	  ?>
        <input type="button" name="Submit5" value="生成拼音目錄" onclick="window.open('../GetPinyin.php?<?=$ecms_hashur['href']?>&hz='+document.form1.ztname.value+'&returnform=opener.document.form1.ztpath.value','','width=160,height=100');"> 
        <?php
	  }
	  ?>
        <input name="ztid" type="hidden" id="ztid" value="<?=$ztid?>"> <input name="oldztid" type="hidden" id="oldztid" value="<?=$ztid?>">      <input name="filepass" type="hidden" id="filepass" value="<?=$filepass?>"></td>
    </tr>
	<?php
	if($returnandlevel==2)
	{
	?>
    <tr>
      <td height="25" bgcolor="#FFFFFF">可更新專題的用戶</td>
      <td height="25" bgcolor="#FFFFFF"><input name="usernames" type="text" id="usernames" value="<?=$usernames?>" size="38">
        <font color="#666666">
        <input type="button" name="Submit32" value="選擇" onclick="window.open('../ChangeUser.php?field=usernames&form=form1<?=$ecms_hashur['ehref']?>','','width=300,height=520,scrollbars=yes');">
(多個用戶用「,」逗號隔開)</font></td>
    </tr>
	<?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">隸屬信息欄目</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="classid" id="classid">
          <option value="0">隸屬於所有欄目</option>
          <?=$options?>
        </select> <input type="button" name="Submit622232" value="管理欄目" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');"> 
        <font color="#666666">(選擇父欄目，將應用於子欄目)</font></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">存放文件夾(*) 
        <input name="oldztpath" type="hidden" id="oldztpath2" value="<?=$r[ztpath]?>"> 
        <input name="oldpripath" type="hidden" id="oldztpath3" value="<?=$pripath?>">      </td>
      <td bgcolor="#FFFFFF"> <table border="0" cellspacing="1" cellpadding="3">
          <tr bgcolor="DBEAF5"> 
            <td bgcolor="DBEAF5">&nbsp;</td>
            <td bgcolor="DBEAF5">上層目錄</td>
            <td bgcolor="DBEAF5">本專題目錄</td>
            <td bgcolor="DBEAF5">&nbsp;</td>
          </tr>
          <tr> 
            <td><div align="right">根目錄/</div></td>
            <td><input name="pripath" type="text" id="pripath" value="<?=$pripath?>" size="30"></td>
            <td><input name="ztpath" type="text" id="ztpath2" value="<?=$ztpath?>" size="16"></td>
            <td><input type="button" name="Submit3" value="檢測目錄" onclick="javascript:window.open('../ecmscom.php?<?=$ecms_hashur['href']?>&enews=CheckPath&pripath='+document.form1.pripath.value+'&classpath='+document.form1.ztpath.value,'','width=100,height=100,top=250,left=450');"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">使用優化方案</td>
      <td bgcolor="#FFFFFF"><select name="yhid" id="yhid">
          <option name="0">不使用</option>
          <?=$yh_options?>
        </select> <input type="button" name="Submit63" value="管理優化方案" onclick="window.open('../db/ListYh.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">文件擴展名</td>
      <td bgcolor="#FFFFFF"> <input name="zttype" type="text" id="zttype4" value="<?=$r[zttype]?>" size="38"> 
        <select name="select" onchange="document.form1.zttype.value=this.value">
          <option value=".html">擴展名</option>
          <option value=".html">.html</option>
          <option value=".htm">.htm</option>
          <option value=".php">.php</option>
          <option value=".shtml">.shtml</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">綁定域名</td>
      <td bgcolor="#FFFFFF"> <input name="zturl" type="text" id="zturl" value="<?=$r[zturl]?>" size="38"> 
        <font color="#666666"> (如不綁定,請留空.後面無需加&quot;/&quot;)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">所屬分類</td>
      <td bgcolor="#FFFFFF"><select name="zcid" id="zcid">
          <option value="0">不隸屬於任何分類</option>
          <?=$zcstr?>
        </select> <input type="button" name="Submit6222322" value="管理分類" onclick="window.open('ListZtClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">專題縮略圖</td>
      <td bgcolor="#FFFFFF"> <input name="ztimg" type="text" id="ztimg" value="<?=$r[ztimg]?>" size="38"> 
        <a onclick="window.open('../ecmseditor/FileMain.php?<?=$ecms_hashur['ehref']?>&modtype=2&type=1&classid=&doing=2&field=ztimg&filepass=<?=$filepass?>&sinfo=1','','width=700,height=550,scrollbars=yes');" title="選擇已上傳的圖片"><img src="../../data/images/changeimg.gif" width="22" height="22" border="0" align="absbottom"></a></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">網頁關鍵字</td>
      <td bgcolor="#FFFFFF"> <input name="ztpagekey" type="text" id="ztpagekey" value="<?=$r[ztpagekey]?>" size="38"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF">專題簡介</td>
      <td bgcolor="#FFFFFF"> <textarea name="intro" cols="70" rows="8" id="intro"><?=stripSlashes($r[intro])?></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">排序</td>
      <td bgcolor="#FFFFFF"><input name="myorder" type="text" id="myorder" value="<?=$r[myorder]?>" size="38"> 
        <font color="#666666"> (值越小越前面)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">顯示到導航</td>
      <td bgcolor="#FFFFFF"> <input type="radio" name="showzt" value="0"<?=$r[showzt]==0?' checked':''?>>
        是 
        <input type="radio" name="showzt" value="1"<?=$r[showzt]==1?' checked':''?>>
        否<font color="#666666">（如：專題導航標籤）</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">信息可選擇</td>
      <td bgcolor="#FFFFFF"><input type="radio" name="usezt" value="0"<?=$r[usezt]==0?' checked':''?>>
        是 
        <input type="radio" name="usezt" value="1"<?=$r[usezt]==1?' checked':''?>>
        否<font color="#666666">（如果選擇否那麼增加信息時不會顯示這個專題）</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">過期時間</td>
      <td bgcolor="#FFFFFF"><input name="endtime" type="text" id="endtime" value="<?=$r[endtime]?date('Y-m-d',$r[endtime]):''?>" size="12" onClick="setday(this)">
        <font color="#666666">(超過此期限不再更新和評論,空為不限制)
        <input name="oldendtime" type="hidden" id="oldendtime" value="<?=$r[endtime]?>">
        </font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">評論</td>
      <td bgcolor="#FFFFFF"><input type="radio" name="closepl" value="0"<?=$r['closepl']==0?' checked':''?>>
        開啟
          <input type="radio" name="closepl" value="1"<?=$r['closepl']==1?' checked':''?>>
        關閉，評論是否審核：
        <input name="checkpl" type="checkbox" id="checkpl" value="1"<?=$r['checkpl']==1?' checked':''?>>
        是</td>
    </tr>
    <tr> 
      <td height="25" colspan="2">頁面設置</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">頁面顯示模式</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="islist" value="0"<?=$r[islist]==0?' checked':''?>>
        封面式 
        <input type="radio" name="islist" value="1"<?=$r[islist]==1?' checked':''?>>
        列表式 
        <input type="radio" name="islist" value="2"<?=$r[islist]==2?' checked':''?>>
        頁面內容式 
        <input name="oldislist" type="hidden" id="oldislist" value="<?=$r[islist]?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="25" bgcolor="#FFFFFF"><font color="#666666">說明：封面式要選擇封面模板、列表式要選擇列表模板、內容式要錄入頁面內容</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">封面模板</td>
      <td height="25" bgcolor="#FFFFFF"><select name="classtempid">
          <?=$classtemp?>
        </select> <input type="button" name="Submit6223" value="管理封面模板" onclick="window.open('../template/ListClasstemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">所用列表模板</td>
      <td height="25" bgcolor="#FFFFFF"> <select name="listtempid" id="listtempid">
          <?=$listtemp_options?>
        </select> <input type="button" name="Submit622" value="管理列表模板" onclick="window.open('../template/ListListtemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">評論模板</td>
      <td height="25" bgcolor="#FFFFFF"><select name="pltempid" id="pltempid">
        <option value="0">使用默認模板 </option>
        <?=$pltemp?>
      </select>
        <input type="button" name="Submit62" value="管理評論模板" onclick="window.open('../template/ListPltemp.php?gid=<?=$thegid?><?=$ecms_hashur['ehref']?>');"></td>
    </tr>
    <tr> 
      <td rowspan="3" valign="top" bgcolor="#FFFFFF">列表式設置</td>
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="90">排序方式</td>
            <td><input name="reorder" type="text" id="reorder" value="<?=$r[reorder]?>"> 
              <select name="orderselect" onchange="document.form1.reorder.value=this.value">
                <option value="newstime DESC"></option>
                <option value="newstime DESC">按發佈時間降序排序</option>
                <option value="id DESC">按信息ID降序排序</option>
                <option value="zid DESC">按加入ID降序排序</option>
				<option value="isgood DESC,newstime DESC">按推薦置頂排序</option>
              </select> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="90">顯示總記錄數</td>
            <td><input name="maxnum" type="text" id="maxnum" value="<?=$r[maxnum]?>" size="6"> 
              <font color="#666666">(0為顯示所有記錄)</font> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="90">每頁顯示記錄數</td>
            <td><input name="ztnum" type="text" id="ztnum3" value="<?=$r[ztnum]?>" size="6"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">頁面內容<font color="#666666">(支持標籤同封面模板)</font></td>
      <td height="25" bgcolor="#FFFFFF">請將內容<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.classtext.value);document.form1.classtext.select()" title="點擊複製模板內容"><strong>複製到Dreamweaver(推薦)</strong></a>或者使用<a href="#ecms" onclick="window.open('../template/editor.php?<?=$ecms_hashur['ehref']?>&getvar=opener.document.form1.classtext.value&returnvar=opener.document.form1.classtext.value&fun=ReturnHtml','editclasstext','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>模板在線編輯</strong></a>進行可視化編輯</td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <textarea name="classtext" cols="80" rows="23" id="classtext" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($addr[classtext]))?></textarea></td>
    </tr>
    <?php
  	$ztfnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsztf");
  	if($ztfnum)
  	{
  		$editorfnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsztf where fform='editor' limit 1");	
		if($editorfnum)
		{
			include('../ecmseditor/infoeditor/fckeditor.php');
		}
  	?>
    <tr> 
      <td height="25" colspan="2">自定義字段設置</td>
    </tr>
    <?php
	@include('../../data/html/ztaddform.php');
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="2"><strong>專題自定義字段調用說明</strong><br>
        內置調用專題自定義字段函數：ReturnZtAddField(專題ID,字段名)，專題ID=0為當前專題ID。取多個字段內容可用逗號隔開，例子：<br>
        取得'classtext'字段內容：$value=ReturnZtAddField(0,'classtext'); //$value就是字段內容。<br>
        取得多個字段內容：$value=ReturnZtAddField(1,'ztid,classtext'); //$value['classtext']才是字段內容。</td>
    </tr>
    <?php
	}
	?>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"></div></td>
      <td bgcolor="#FFFFFF"> <input type="submit" name="Submit" value="提交"> &nbsp;&nbsp; 
        <input type="reset" name="Submit2" value="重置"> </td>
    </tr>
  </form>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>