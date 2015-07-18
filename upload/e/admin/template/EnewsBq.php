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

$sql=$empire->query("select bqname,bqsay,funname,bq,issys,bqgs from {$dbtbpre}enewsbq where isclose=0 order by myorder desc,bqid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>帝國網站管理系統標籤說明</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript">
window.resizeTo(760,600);
window.focus();
</script>
</head>
<body>
  <table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr> 
      <td id='bqnav'></td>
    </tr>
  </table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr> 
    <td colspan="2" class="header">信息標籤調用操作類型</td>
  </tr>
  <tr> 
    <td width="50%" bgcolor="#FFFFFF"> <table width="100%" border="0">
        <tr> 
          <td width="12%" rowspan="6" bgcolor="dbeaf5"> <div align="center"><strong>按<br>
              欄<br>
              目<br>
              調<br>
              用</strong></div></td>
          <td width="16%" height="20"><div align="center"><strong>0</strong></div></td>
          <td width="72%">欄目最新信息 <font color="#666666">(欄目ID=欄目ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>1</strong></div></td>
          <td>欄目點擊排行 <font color="#666666">(欄目ID=欄目ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>2</strong></div></td>
          <td>欄目推薦信息 <font color="#666666">(欄目ID=欄目ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>9</strong></div></td>
          <td>欄目評論排行 <font color="#666666">(欄目ID=欄目ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>12</strong></div></td>
          <td>欄目頭條信息 <font color="#666666">(欄目ID=欄目ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>15</strong></div></td>
          <td>欄目下載排行 <font color="#666666">(欄目ID=欄目ID)</font></td>
        </tr>
      </table></td>
    <td bgcolor="#FFFFFF"> <table width="100%" border="0">
        <tr> 
          <td width="11%" rowspan="6" bgcolor="dbeaf5"> <div align="center"><strong>按<br>
              默<br>
              認<br>
              表<br>
              調<br>
              用</strong></div></td>
          <td width="16%" height="20"><div align="center"><strong>3</strong></div></td>
          <td width="73%">默認表最新信息 <font color="#666666">(欄目ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>4</strong></div></td>
          <td>默認表點擊排行 <font color="#666666">(欄目ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>5</strong></div></td>
          <td>默認表推薦信息 <font color="#666666">(欄目ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>10</strong></div></td>
          <td>默認表評論排行 <font color="#666666">(欄目ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>13</strong></div></td>
          <td>默認表頭條信息 <font color="#666666">(欄目ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>16</strong></div></td>
          <td>默認表下載排行 <font color="#666666">(欄目ID=0)</font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <td width="12%" rowspan="6" bgcolor="dbeaf5"><div align="center"><strong>按<br>
          標<br>
          題<br>
          分<br>
          類<br>
          調<br>
          用</strong></div></td>
        <td width="16%" height="20"><div align="center"><strong>25</strong></div></td>
        <td width="72%">標題分類最新信息 <font color="#666666">(欄目ID=標題分類ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>26</strong></div></td>
        <td>標題分類點擊排行 <font color="#666666">(欄目ID=標題分類ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>27</strong></div></td>
        <td>標題分類推薦信息 <font color="#666666">(欄目ID=標題分類ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>28</strong></div></td>
        <td>標題分類評論排行 <font color="#666666">(欄目ID=標題分類ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>29</strong></div></td>
        <td>標題分類頭條信息 <font color="#666666">(欄目ID=標題分類ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>30</strong></div></td>
        <td>標題分類下載排行 <font color="#666666">(欄目ID=標題分類ID)</font></td>
      </tr>
    </table></td>
    <td bgcolor="#FFFFFF"> <table width="100%" border="0">
        <tr> 
          <td width="11%" rowspan="6" bgcolor="dbeaf5"> <div align="center"><strong>按<br>
              數<br>
              據<br>
              表<br>
              調<br>
              用</strong></div></td>
          <td width="16%" height="20"><div align="center"><strong>18</strong></div></td>
          <td width="73%">各表最新信息 <font color="#666666">(欄目ID='表名')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>19</strong></div></td>
          <td>各表點擊排行<font color="#666666"> (欄目ID='表名')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>20</strong></div></td>
          <td>各表推薦信息 <font color="#666666">(欄目ID='表名')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>21</strong></div></td>
          <td>各表評論排行 <font color="#666666">(欄目ID='表名')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>22</strong></div></td>
          <td>各表頭條信息 <font color="#666666">(欄目ID='表名')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>23</strong></div></td>
          <td>各表下載排行 <font color="#666666">(欄目ID='表名')</font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <td width="12%" rowspan="6" bgcolor="dbeaf5"><div align="center"><strong>按<br>
          S<br>
          Q<br>
          L<br>
          調<br>
          用</strong></div></td>
        <td width="15%" height="20" rowspan="2"><div align="center"><strong>24</strong></div></td>
        <td width="73%" height="20">按sql查詢 <font color="#666666">(欄目ID='sql語句')</font></td>
      </tr>
      <tr>
        <td height="20"><font color="#666666">數據表前綴可用：「[!db.pre!]&quot;表示</font></td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<br>
<?php
$bqnav="";
while($r=$empire->fetch($sql))
{
	$bqnav.="<option value='".$r['bq']."'>".$r['bqname']."(".$r['bq'].")</option>";
	$r['bqsay']=str_replace('[!--ehash--]',$ecms_hashur['ehref'],$r['bqsay']);
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="<?=$r[bq]?>">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b><?=$r[bqname]?>&nbsp;(<?=$r[bq]?>)</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td>
<input type=text name="text" size=80 value="<?=stripSlashes($r[bqgs])?>" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td>參數說明：</td>
        </tr>
        <tr> 
          <td><?=stripSlashes($r[bqsay])?></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<?php
}
$bqnav="<select name='bq' id='bq' onchange=window.location='#'+this.options[this.selectedIndex].value><option value='' selected style='background:#99C4E3'>標籤導航</option>".$bqnav."<option value='eloop'>靈動標籤 (e:loop)</option><option value='eindexloop'>索引靈動標籤 (e:indexloop)</option><option value='ShowMemberInfo'>會員信息調用函數</option><option value='ListMemberInfo'>會員列表調用函數</option><option value='spaceeloop'>會員空間信息調用函數</option><option value='wapeloop'>WAP信息調用函數</option><option value='echeckloginauth'>驗證會員登錄與返回登錄信息函數</option><option value='echeckmembergroup'>驗證會員訪問權限函數</option><option value='resizeimg'>生成縮圖函數</option><option value='egetzy'>轉義字符函數</option><option value='enewshowmorepic'>顯示圖集函數(全面型)</option><option value='emoreplayer'>顯示視頻播放器JS函數</option></select>";
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eloop">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>靈動標籤&nbsp;(e:loop)</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td width="86%"><textarea name="text" cols="80" rows="4" style="width:100%">[e:loop={欄目ID,顯示條數,操作類型,只顯示有標題圖片,附加SQL條件,顯示排序}]
模板代碼內容
[/e:loop]</textarea></td>
        </tr>
        <tr>
          <td>例子:</td>
          <td><textarea name="textarea" cols="80" rows="9" style="width:100%">&lt;table width="100%" border="0" cellspacing="1" cellpadding="3"&gt;
[e:loop={欄目ID,顯示條數,操作類型,只顯示有標題圖片,附加SQL條件,顯示排序}]
&lt;tr&gt;&lt;td&gt;
&lt;a href="&lt;?=$bqsr[titleurl]?&gt;" target="_blank"&gt;&lt;?=$bqr[title]?&gt;&lt;/a&gt;
(&lt;?=date('Y-m-d',$bqr[newstime])?&gt;)
&lt;/td&gt;&lt;/tr&gt;
[/e:loop]
&lt;/table&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="23"><strong>標籤說明</strong></td>
        </tr>
        <tr> 
          <td height="23">靈動標籤是無需做標籤模板，且模板內容為PHP代碼，因而更靈活，可以使用php所有處理函數。<font color="#666666">使用本標籤，需開啟模板支持程序代碼(參數設置)。</font></td>
        </tr>
        <tr> 
          <td height="23"><strong>參數</strong></td>
        </tr>
        <tr> 
          <td><table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td width="23%"> 
                    <div align="center">參數</div></td>
                  <td>參數說明</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">欄目ID</div></td>
                  <td height="25">查看欄目ID點<a onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');"><strong><u>這裡</u></strong></a>，查看標題分類ID點<a onclick="window.open('../info/InfoType.php<?=$ecms_hashur['whehref']?>');"><strong><u>這裡</u></strong></a>,當前ID='selfinfo'<br />
                    多個欄目ID與標題分類ID可用「,」逗號隔開，如：'1,2'</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">顯示條數</div></td>
                  <td height="25">顯示前幾條記錄</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">操作類型</div></td>
                  <td height="25">具體看操作類型說明</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">只顯示有標題圖片</div></td>
                  <td height="25">0為不限制，1為只顯示有標題圖片的信息</td>
                </tr>
				<tr bgcolor="#ffffff">
            		<td height="25">
            			<div align="center">附加SQL條件</div>
            		</td>
            		<td height="25">附加調用條件，如：&quot;title='帝國'&quot;</td>
        		</tr>
        		<tr bgcolor="#ffffff">
            		<td height="25">
            			<div align="center">顯示排序</div>
            		</td>
            		<td height="25">可指定按相應的字段排序，如：&quot;id desc&quot;</td>
        		</tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td><strong>變量說明</strong></td>
        </tr>
        <tr>
          <td height="139">
<table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td height="25"><div align="center">數組或變量</div></td>
                  <td height="25">說明</td>
                </tr>
                <tr> 
                  <td width="23%" height="25" bgcolor="#ffffff"> <div align="center">$bqr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqr[字段名]：顯示字段的內容</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"> <div align="center">$bqsr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqsr[titleurl]：標題鏈接<br>
                    $bqsr[classname]：欄目名稱<br>
                    $bqsr[classurl]：欄目鏈接</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"><div align="center">$bqno</div></td>
                  <td height="25" bgcolor="#ffffff">$bqno：為調用序號</td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#ffffff"><div align="center">$public_r</div></td>
                  <td height="25" bgcolor="#ffffff">$public_r[newsurl]：網站地址</td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr> 
          <td><strong>常用函數介紹</strong></td>
        </tr>
        <tr> 
          <td>文字截取：<strong>esub(字符串,截取長度)</strong>，例子：esub($bqr[title],30)截取標題前30個字符<br>
            時間格式：<strong>date('格式字串',時間字段)</strong>，例子：date('Y-m-d',$bqr[newstime])時間顯示格式為&quot;2008-10-01&quot;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eindexloop">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>索引靈動標籤&nbsp;(e:indexloop)</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td width="86%"><textarea name="textarea4" cols="80" rows="4" style="width:100%">[e:indexloop={索引分類ID,顯示條數,操作類型,欄目ID,系統模型ID,附加SQL條件}]
模板代碼內容
[/e:indexloop]</textarea></td>
        </tr>
        <tr> 
          <td>例子:</td>
          <td><textarea name="textarea4" cols="80" rows="9" style="width:100%">&lt;table width="100%" border="0" cellspacing="1" cellpadding="3"&gt;
[e:indexloop={索引分類ID,顯示條數,操作類型,欄目ID,系統模型ID,附加SQL條件}]
&lt;tr&gt;&lt;td&gt;
&lt;a href="&lt;?=$bqsr[titleurl]?&gt;" target="_blank"&gt;&lt;?=$bqr[title]?&gt;&lt;/a&gt;
(&lt;?=date('Y-m-d',$bqr[newstime])?&gt;)
&lt;/td&gt;&lt;/tr&gt;
[/e:indexloop]
&lt;/table&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="23"><strong>標籤說明</strong></td>
        </tr>
        <tr> 
          <td height="23">索引靈動標籤使用方法基本同靈動標籤，只是索引靈動標籤是以信息ID和欄目ID來獲取信息內容。<font color="#666666">使用本標籤，需開啟模板支持程序代碼(參數設置)。</font></td>
        </tr>
        <tr> 
          <td height="23"><strong>參數</strong></td>
        </tr>
        <tr> 
          <td><table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td width="23%"> <div align="center">參數</div></td>
                  <td>參數說明</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">索引分類ID</div></td>
                  <td height="25">查看專題ID點<a onclick="window.open('../special/ListZt.php<?=$ecms_hashur['whehref']?>');"><strong><u>這裡</u></strong></a>,查看TAGS的ID點<a onclick="window.open('../tags/ListTags.php<?=$ecms_hashur['whehref']?>');"><strong><u>這裡</u></strong></a>，查看碎片ID點<a onclick="window.open('../sp/ListSp.php<?=$ecms_hashur['whehref']?>');"><strong><u>這裡</u></strong></a>，當前專題ID='selfinfo'<br />
                    多個ID可用「,」逗號隔開，如：'1,2'</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">顯示條數</div></td>
                  <td height="25">顯示前幾條記錄</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">操作類型</div></td>
                  <td height="25"> 1、專題最新 <font color="#666666">(索引分類ID=專題ID)</font><br>
                    2、專題最早 <font color="#666666">(索引分類ID=專題ID)</font><br>
                    3、專題推薦 <font color="#666666">(索引分類ID=專題ID)</font><br>
                    4、專題子類最新 <font color="#666666">(索引分類ID=專題子類ID)</font><br>
                    5、專題子類最早 <font color="#666666">(索引分類ID=專題子類ID)</font><br>
                    6、專題子類推薦 <font color="#666666">(索引分類ID=專題子類ID)</font><br>
                    7、碎片最新 <font color="#666666">(索引分類ID=碎片ID)</font><br>
8、碎片最早 <font color="#666666">(索引分類ID=碎片ID)</font><br>
                    9、TAGS最新 <font color="#666666">(索引分類ID=TAGS的ID)</font><br>
                    10、TAGS最早 <font color="#666666">(索引分類ID=TAGS的ID)</font><br>
                    11、SQL調用 <font color="#666666">(索引分類ID='sql語句') [數據表前綴可用：「[!db.pre!]&quot;表示]</font></td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">欄目ID</div></td>
                  <td height="25">限制只調用某一個或多個欄目的信息<br>
                    多個ID可以用「,」號隔開，如：'1,2'</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">系統模型ID</div></td>
                  <td height="25">限制只調用某一個或多個系統模型的信息<br>
                    多個ID可以用「,」號隔開，如：'1,2'<br>
                    <font color="#FF0000">此參數對碎片調用無效，碎片調用時請把本參數設置為空：''</font></td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"> <div align="center">附加SQL條件</div></td>
                  <td height="25">附加調用條件，如：&quot;isgood=1&quot;</td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr> 
          <td><strong>變量說明</strong></td>
        </tr>
        <tr> 
          <td height="139"> <table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td height="25"><div align="center">數組或變量</div></td>
                  <td height="25">說明</td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#ffffff"><div align="center">$indexbqr</div></td>
                  <td height="25" bgcolor="#ffffff">$indexbqr[字段名]：顯示索引表的字段內容，如專題子類ID：$indexbqr[cid]</td>
                </tr>
                <tr> 
                  <td width="23%" height="25" bgcolor="#ffffff"> <div align="center">$bqr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqr[字段名]：顯示信息表字段的內容，如標題：$bqr[title]</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"> <div align="center">$bqsr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqsr[titleurl]：標題鏈接<br>
                    $bqsr[classname]：欄目名稱<br>
                    $bqsr[classurl]：欄目鏈接</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"><div align="center">$bqno</div></td>
                  <td height="25" bgcolor="#ffffff">$bqno：為調用序號</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"><div align="center">$public_r</div></td>
                  <td height="25" bgcolor="#ffffff">$public_r[newsurl]：網站地址</td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr> 
          <td><strong>常用函數介紹</strong></td>
        </tr>
        <tr> 
          <td>文字截取：<strong>esub(字符串,截取長度)</strong>，例子：esub($bqr[title],30)截取標題前30個字符<br>
            時間格式：<strong>date('格式字串',時間字段)</strong>，例子：date('Y-m-d',$bqr[newstime])時間顯示格式為&quot;2012-10-01&quot;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ShowMemberInfo">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>會員信息調用函數</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td>
<input type=text name="text" size=80 value="sys_ShowMemberInfo(用戶ID,查詢字段)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td>用戶ID：設置要調用的會員信息的用戶ID，在信息內容頁下調用可以設置為0，表示調用信息發佈者的資料。<br>
            查詢字段：默認為查詢所有會員字段，此參數一般不用設置，如果為了效率更高可以指定相應的字段。如：「u.userid,ui.company」(u為主表，ui為副表)。<br>
            <strong>使用教程：</strong><a href="http://bbs.phome.net/showthread-13-108558-0.html" target="_blank">http://bbs.phome.net/showthread-13-108558-0.html</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ListMemberInfo">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>會員列表調用函數</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td>
<input type=text name="text" size=80 value="sys_ListMemberInfo(調用條數,操作類型,會員組ID,用戶ID,查詢字段)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td>調用條數：調用前幾條記錄。<br>
            操作類型：0為按註冊時間、1為按積分排行、2為按資金排行、3為按會員空間人氣排行<br>
            會員組ID：指定要調用的會員組ID，不設置為不限，多個會員組用逗號隔開，如：'1,2'<br>
            用戶ID：指定要調用的會員ID，不設置為不限，多個用戶ID用逗號隔開，如：'25,27'<br>
            查詢字段：默認為查詢所有會員字段，此參數一般不用設置，如果為了效率更高可以指定相應的字段。如：「u.userid,ui.company」(u為主表，ui為副表)。<br>
            <strong>使用教程：</strong><a href="http://bbs.phome.net/showthread-13-108558-0.html" target="_blank">http://bbs.phome.net/showthread-13-108558-0.html</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="spaceeloop">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>會員空間信息調用函數</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <textarea name="textarea2" cols="80" rows="11" style="width:100%">&lt;?php
$spacesql=espace_eloop(欄目ID,顯示條數,操作類型,只顯示有標題圖片,附加SQL條件,顯示排序);
while($spacer=$empire->fetch($spacesql))
{
        $spacesr=espace_eloop_sp($spacer);
?&gt;
模板代碼內容
&lt;?
}
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td> <strong>使用教程：</strong><a href="http://bbs.phome.net/showthread-13-109152-0.html" target="_blank">http://bbs.phome.net/showthread-13-109152-0.html</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="wapeloop">
  <tr>
    <td class="header"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr class="header">
        <td width="14%">標籤名稱：</td>
        <td width="86%"><b>WAP信息調用函數</b></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">格式:</td>
        <td><textarea name="textarea7" cols="80" rows="11" style="width:100%">&lt;?php
$wapsql=ewap_eloop(欄目ID,顯示條數,操作類型,只顯示有標題圖片,附加SQL條件,顯示排序);
while($wapr=$empire->fetch($wapsql))
{
        $wapsr=ewap_eloop_sp($wapr);
?&gt;
模板代碼內容
&lt;?
}
?&gt;</textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr>
        <td>本函數參數和靈動標籤完全一樣，設置的內容也是一樣，支持靈動標籤的所有操作類型：<br>
          「$wapr[字段名]」等同於靈動標籤「$bqr[字段名]」變量。<br>
          「$wapsr」等同於靈動標籤「$bqsr」變量。（$wapsr[titleurl]：標題鏈接、$wapsr[classname]：欄目名稱、$wapsr[classurl]：欄目鏈接）</td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="echeckloginauth">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>Cookie驗證會員登錄與返回登錄信息函數</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <input type=text name="text22" size=80 value="qCheckLoginAuthstr()" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <textarea name="textarea3" cols="80" rows="9" style="width:100%">&lt;?php
$user=qCheckLoginAuthstr();
if(!$user['islogin'])
{
echo"您還未登錄";
exit();
}
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td>本函數返回帶用戶信息的數組：<br>
                數組項：islogin(0為未登錄,1為已登錄)、userid(用戶ID)、username(用戶名)、groupid(會員組ID)</td>
              </tr>
            </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="echeckmembergroup">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>驗證會員訪問權限函數</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <input type=text name="text22" size=80 value="sys_CheckMemberGroup(限制訪問的會員組ID)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <textarea name="textarea3" cols="80" rows="9" style="width:100%">&lt;?php
$levelst=sys_CheckMemberGroup('1,4');
if($levelst<=0)
{
echo"您沒有權限";
exit();
}
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td>本函數驗證當前登錄會員是否有訪問權限函數：sys_CheckMemberGroup(限制訪問的會員組ID)，限制多個會員組ID可用逗號隔開。<br>
                返回0則未登錄，返回-1則為沒權限，大於0為有權限。</td>
              </tr>
            </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="resizeimg">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>生成縮圖函數</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <input type=text name="text2" size=80 value="sys_ResizeImg(原圖片,縮圖寬度,縮圖高度,是否裁翦圖片,目標文件名,目標目錄名)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <textarea name="textarea2" cols="80" rows="5" style="width:100%">&lt;?php
$resizeimgurl=sys_ResizeImg($bqr[titlepic],170,120,1,'','');
echo"&lt;img src='$resizeimgurl'&gt;";
?&gt;</textarea></td>
        </tr>
      </table> 
    </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td>原圖片：要生成縮圖的源文件。<br>
            縮圖寬度、縮圖高度：生成縮圖的規格。<br>
            是否裁翦圖片：按比例縮圖後超出部分是事採用裁翦方式。<br>
            目標文件名：此項可省略，如果設置目標文件名將覆蓋此文件名，防止重複生成臨時圖片文件。<br>
            目標目錄名：此項可省略，默認為：e/data/tmp/titlepic/</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="egetzy">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">標籤名稱：</td>
          <td width="86%"><b>轉義字符函數</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <input type=text name="text22" size=80 value="egetzy(轉義字符)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">格式:</td>
          <td> <textarea name="textarea3" cols="80" rows="5" style="width:100%">&lt;?php
$zystr=egetzy('rn');
echo"$zystr";
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td>本函數方便用戶在調用模板使用反斜扛轉義：<br>
                  (1)、函數語法：egetzy(轉義字符)<br>
            (2)、轉義字符rn轉為\r\n、n轉為\n、r轉為\r、t轉為\t、syh轉為\&quot;、dyh轉為\'<br>
                  (3)、轉義字符為數字，則轉為對應數量的\，比如：2轉為\\<br>
                  (4)、分割換行符例子：$er=explode(egetzy('rn'),$navinfor[downpath]); </td>
              </tr>
            </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="enewshowmorepic">
  <tr>
    <td class="header"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr class="header">
        <td width="14%">標籤名稱：</td>
        <td width="86%"><b><strong>顯示圖集函數(全面型)</strong></b></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">格式:</td>
        <td><input type=text name="text222" size=80 value="sys_ModShowMorepic(導航小圖寬度,導航小圖高度,小圖導航模板內容)" style="width:100%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">例子:</td>
        <td><textarea name="textarea5" cols="80" rows="5" style="width:100%">&lt;?=sys_ModShowMorepic(120,80,'')?&gt;</textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr>
        <td><strong>使用教程：</strong><a href="../../data/modadd/morepic/ReadMe.html" target="_blank">[點擊這裡查看]</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="emoreplayer">
  <tr>
    <td class="header"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr class="header">
        <td width="14%">標籤名稱：</td>
        <td width="86%"><b><strong>顯示視頻播放器JS函數</strong></b></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">格式:</td>
        <td><textarea name="textarea6" cols="80" rows="5" style="width:100%">&lt;script src=&quot;/e/data/modadd/moreplayer/empirecmsplayer.js&quot;&gt;&lt;/script&gt;
&lt;script&gt;
EmpireCMSPlayVideo('播放器類型','視頻地址','顯示寬度','顯示高度',是否自動播放,'帝國CMS網站目錄地址');
&lt;/script&gt;</textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr>
        <td><strong>使用教程：</strong><a href="../../data/modadd/moreplayer/ReadMe.html" target="_blank">[點擊這裡查看]</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<script>
document.getElementById("bqnav").innerHTML="<?=$bqnav?>";
</script>
</body>
</html>
<?php
db_close();
$empire=null;
?>
