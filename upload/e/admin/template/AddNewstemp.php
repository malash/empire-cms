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
CheckLevel($logininid,$loginin,$classid,"template");
$gid=(int)$_GET['gid'];
$gname=CheckTempGroup($gid);
$urlgname=$gname."&nbsp;>&nbsp;";
$mid=ehtmlspecialchars($_GET['mid']);
$cid=ehtmlspecialchars($_GET['cid']);
$enews=ehtmlspecialchars($_GET['enews']);
$r[showdate]="Y-m-d H:i:s";
$url=$urlgname."<a href=ListNewstemp.php?gid=$gid".$ecms_hashur['ehref'].">管理內容模板</a>&nbsp;>&nbsp;增加內容模板";
//複製
if($enews=="AddNewstemp"&&$_GET['docopy'])
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempname,temptext,modid,showdate,classid from ".GetDoTemptb("enewsnewstemp",$gid)." where tempid='$tempid'");
	$url=$urlgname."<a href=ListNewstemp.php?gid=$gid".$ecms_hashur['ehref'].">管理內容模板</a>&nbsp;>&nbsp;複製內容模板：".$r[tempname];
}
//修改
if($enews=="EditNewstemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempname,temptext,modid,showdate,classid from ".GetDoTemptb("enewsnewstemp",$gid)." where tempid='$tempid'");
	$url=$urlgname."<a href=ListNewstemp.php?gid=$gid".$ecms_hashur['ehref'].">管理內容模板</a>&nbsp;>&nbsp;修改內容模板：".$r[tempname];
}
//系統模型
$msql=$empire->query("select mid,mname from {$dbtbpre}enewsmod where usemod=0 order by myorder,mid");
while($mr=$empire->fetch($msql))
{
	if($mr[mid]==$r[modid])
	{$select=" selected";}
	else
	{$select="";}
	$mod.="<option value=".$mr[mid].$select.">".$mr[mname]."</option>";
}
//分類
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewsnewstempclass order by classid");
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理內容模板</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.temptext.value=html;
}
</script>
<SCRIPT lanuage="JScript">
<!--
function tempturnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
-->
</SCRIPT>
<script>
function ReTempBak(){
	self.location.reload();
}
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>位置：<?=$url?></td>
  </tr>
</table>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="ListNewstemp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">增加模板 
        <input type=hidden name=enews value="<?=$enews?>"> <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> <input name="mid" type="hidden" id="mid" value="<?=$mid?>"> 
        <input name="gid" type="hidden" id="gid" value="<?=$gid?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="19%" height="25">模板名(*)</td>
      <td width="69%" height="25"> <input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>" size="30"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">所屬系統模型(*)</td>
      <td height="25"><select name="modid" id="modid">
          <?=$mod?>
        </select> <input type="button" name="Submit6" value="管理系統模型" onclick="window.open('../db/ListTable.php<?=$ecms_hashur['whehref']?>');"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">所屬分類</td>
      <td height="25"><select name="classid" id="classid">
          <option value="0">不隸屬於任何分類</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit6222322" value="管理分類" onclick="window.open('NewstempClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">時間顯示格式：</td>
      <td> <input name="showdate" type="text" id="showdate" value="<?=$r[showdate]?>" size="20"> 
        <select name="select4" onchange="document.form1.showdate.value=this.value">
          <option value="Y-m-d H:i:s">選擇</option>
          <option value="Y-m-d H:i:s">2005-01-27 11:04:27</option>
          <option value="Y-m-d">2005-01-27</option>
          <option value="m-d">01-27</option>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>模板內容</strong>(*)</td>
      <td> 請將模板內容<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.temptext.value);document.form1.temptext.select()" title="點擊複製模板內容"><strong>複製到Dreamweaver(推薦)</strong></a>或者使用<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.temptext.value&returnvar=opener.document.form1.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>模板在線編輯</strong></a>進行可視化編輯</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="2" valign="top"> <div align="center">
          <textarea name="temptext" cols="90" rows="27" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[temptext]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="保存模板">&nbsp;
        <input type="reset" name="Submit2" value="重置">
        <?php
		if($enews=='EditNewstemp')
		{
		?>
        &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=newstemp&tempid=<?=$tempid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">修改記錄</a>] 
        <?php
		}
		?>
      </td>
    </tr>
	</form>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"> &nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(showtempvar);">顯示模板變量說明</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=500,scrollbars=yes,resizable=yes');">查看模板標籤語法</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看JS調用地址</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看公共模板變量</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListBqtemp.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">查看標籤模板</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="2"><strong>模板變量說明：</strong><br> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="34%" height="25"> <input name="textfield18" type="text" value="[!--pagetitle--]">
              :頁面標題</td>
            <td width="33%"><input name="textfield72" type="text" value="[!--pagekey--]">
              :頁面關鍵字 </td>
            <td width="33%"><input name="textfield73" type="text" value="[!--pagedes--]">
              :頁面描述 </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield19" type="text" value="[!--newsnav--]">
              :導航條</td>
            <td><input name="textfield92" type="text" value="[!--class.menu--]">
              :一級欄目導航</td>
            <td><input name="textfield20" type="text" value="[!--page.stats--]">
              :統計訪問</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"> <input name="textfield21" type="text" value="[!--id--]">
              :信息ID</td>
            <td><input name="textfield22" type="text" value="[!--titleurl--]">
              :標題鏈接</td>
            <td><input name="textfield23" type="text" value="[!--keyboard--]">
              :關鍵字</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield24" type="text" value="[!--classid--]">
              :欄目ID</td>
            <td><input name="textfield25" type="text" value="[!--class.name--]">
              :欄目名稱</td>
            <td><input name="textfield26" type="text" value="[!--self.classid--]">
              :本欄目ID</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield30" type="text" value="[!--bclass.id--]">
              :父欄目ID<br></td>
            <td><input name="textfield31" type="text" value="[!--bclass.name--]">
              :父欄目名稱</td>
            <td><input name="textfield32" type="text" value="[!--other.link--]">
              :相關鏈接</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield19222" type="text" value="[!--p.title--]">
              :分頁標題</td>
            <td><input name="textfield34" type="text" value="[!--news.url--]">
              :網站地址</td>
            <td><input name="textfield35" type="text" value="[!--no.num--]">
              :信息編號</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield36" type="text" value="[!--userid--]">
              :發佈者ID</td>
            <td><input name="textfield37" type="text" value="[!--username--]">
              :發佈者</td>
            <td><input name="textfield38" type="text" value="[!--linkusername--]">
              :帶鏈接的用戶名</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield39" type="text" value="[!--userfen--]">
              :查看信息扣除點數</td>
            <td><input name="textfield40" type="text" value="[!--pinfopfen--]">
              :平均評分</td>
            <td><input name="textfield41" type="text" value="[!--infopfennum--]">
              :評分人數</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield42" type="text" value="[!--onclick--]">
              :點擊數</td>
            <td><input name="textfield43" type="text" value="[!--totaldown--]">
              :下載數</td>
            <td><input name="textfield44" type="text" value="[!--plnum--]">
              :評論數</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield45" type="text" value="[!--page.url--]">
              :分頁導航</td>
            <td><input name="textfield46" type="text" value="[!--title.select--]">
              :標題式分頁導航</td>
            <td><input name="textfield47" type="text" value="[!--next.page--]">
              :內容下一頁鏈接</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield48" type="text" value="[!--info.next--]">
              :下一篇</td>
            <td><input name="textfield49" type="text" value="[!--info.pre--]">
              :上一篇</td>
            <td><input name="textfield50" type="text" value="[!--info.vote--]">
              :信息投票</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield192" type="text" value="[!--ttid--]">
              :標題分類ID</td>
            <td><input name="textfield1922" type="text" value="[!--tt.name--]">
              :標題分類名稱</td>
            <td><input name="textfield19223" type="text" value="[!--tt.url--]">
:標題分類地址</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield252" type="text" value="[!--class.url--]">
:欄目頁面地址</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield51" type="text" value="[!--hotnews--]">
              :熱門信息JS調用(默認表)<br> <input name="textfield52" type="text" value="[!--self.hotnews--]">
              :本欄目熱門信息JS調用</td>
            <td><input name="textfield53" type="text" value="[!--newnews--]">
              :最新信息JS調用(默認表)<br> <input name="textfield54" type="text" value="[!--self.newnews--]">
              :本欄目最新信息JS調用 </td>
            <td><input name="textfield55" type="text" value="[!--goodnews--]">
              :推薦信息JS調用(默認表)<br> <input name="textfield56" type="text" value="[!--self.goodnews--]">
              :本欄目推薦信息JS調用</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield57" type="text" value="[!--hotplnews--]">
              :評論熱門信息JS調用(默認表)<br> <input name="textfield58" type="text" value="[!--self.hotplnews--]">
              :本欄目評論熱門信息JS調用</td>
            <td><input name="textfield59" type="text" value="[!--firstnews--]">
              :頭條信息JS調用(默認表)<br> <input name="textfield60" type="text" value="[!--self.firstnews--]">
              :本欄目頭條信息JS調用</td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>[!--字段名--]:數據表字段內容調用，點 
              <input type="button" name="Submit3" value="這裡" onclick="window.open('ShowVar.php?<?=$ecms_hashur['ehref']?>&modid='+document.form1.modid.value,'','width=300,height=520,scrollbars=yes');">
              可查看</strong></td>
            <td><strong>支持公共模板變量</strong></td>
            <td><strong>支持所有模板標籤</strong></td>
          </tr>
        </table>
        <br> <strong>其它JS調用及地址說明 </strong> <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="17%" height="25">實時顯示點擊數(不統計)</td>
            <td width="83%"><input name="textfield61" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">實時顯示點擊數(顯示+統計)</td>
            <td><input name="textfield62" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&amp;addclick=1&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">實時顯示下載數</td>
            <td><input name="textfield63" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&amp;down=1&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">實時顯示評論數</td>
            <td><input name="textfield64" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&amp;down=2&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">實時顯示平均評分數</td>
            <td><input name="textfield65" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&amp;down=3&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">實時顯示評分人數</td>
            <td><input name="textfield66" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&amp;down=4&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">實時顯示頂數</td>
            <td><input name="textfield67" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&amp;down=5&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">實時顯示踩數</td>
            <td><input name="textfield672" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=[!--classid--]&amp;id=[!--id--]&amp;down=6&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25">實時顯示專題評論數</td>
            <td><input name="textfield6723" type="text" style="WIDTH: 100%" value="&lt;script src=[!--news.url--]e/public/ViewClick/?classid=專題ID&amp;down=7&gt;&lt;/script&gt;"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td rowspan="2">上面多變量同時顯示<br>
              (變量1為顯示,0為不顯示) </td>
            <td height="25"><input name="textfield6722" type="text" value="&lt;script src=[!--news.url--]e/public/ViewClick/ViewMore.php?classid=[!--classid--]&amp;id=[!--id--]&amp;onclick=1&amp;down=1&amp;plnum=1&amp;pfen=0&amp;pfennum=0&amp;diggtop=0&amp;diggdown=0&amp;addclick=0&gt;&lt;/script&gt;" size="85"></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">顯示內容地方要加id=&quot;變量showdiv&quot;，比如點擊數：&lt;span id=&quot;onclickshowdiv&quot;&gt;0&lt;/span&gt;</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25">購物車地址</td>
            <td><input name="textfield68" type="text" style="WIDTH: 100%" value="[!--news.url--]e/ShopSys/buycar/?classid=[!--classid--]&amp;id=[!--id--]"></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25">評論JS調用</td>
            <td><input name="textfield682" type="text" style="WIDTH: 100%" value="&lt;script src=&quot;[!--news.url--]e/pl/more/?classid=[!--classid--]&amp;id=[!--id--]&amp;num=10&quot;&gt;&lt;/script&gt;"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</body>
</html>
