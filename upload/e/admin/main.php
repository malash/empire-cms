<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require("../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
//驗證用戶
$lur=is_login();
$logininid=(int)$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=(int)$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//我的狀態
$user_r=$empire->fetch1("select pretime,preip,loginnum,preipport from {$dbtbpre}enewsuser where userid='$logininid'");
$gr=$empire->fetch1("select groupname from {$dbtbpre}enewsgroup where groupid='$loginlevel'");
//管理員統計
$adminnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsuser");
$date=date("Y-m-d");
$noplnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspl_".$public_r['pldeftb']." where checked=1");
//未審核會員
$nomembernum=$empire->gettotal("select count(*) as total from ".eReturnMemberTable()." where ".egetmf('checked')."=0");
//過期廣告
$outtimeadnum=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsad where endtime<'$date' and endtime<>'0000-00-00'");
//系統信息
	if(function_exists('ini_get')){
        $onoff = ini_get('register_globals');
    } else {
        $onoff = get_cfg_var('register_globals');
    }
    if($onoff){
        $onoff="打開";
    }else{
        $onoff="關閉";
    }
    if(function_exists('ini_get')){
        $upload = ini_get('file_uploads');
    } else {
        $upload = get_cfg_var('file_uploads');
    }
    if ($upload){
        $upload="可以";
    }else{
        $upload="不可以";
    }
	if(function_exists('ini_get')){
        $uploadsize = ini_get('upload_max_filesize');
    } else {
        $uploadsize = get_cfg_var('upload_max_filesize');
    }
	if(function_exists('ini_get')){
        $uploadpostsize = ini_get('post_max_size');
    } else {
        $uploadpostsize = get_cfg_var('post_max_size');
    }
//開啟
$register_ok="開啟";
if($public_r[register_ok])
{$register_ok="關閉";}
$addnews_ok="開啟";
if($public_r[addnews_ok])
{$addnews_ok="關閉";}
//版本
@include("../class/EmpireCMS_version.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>帝國網站管理系統</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><div align="center"><strong> 
        <h3>歡迎使用帝國網站管理系統 (EmpireCMS)</h3>
        </strong></div></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">我的狀態</td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"> <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="22">登錄者:&nbsp;<b>
                  <?=$loginin?>
                  </b>&nbsp;&nbsp;,所屬用戶組:&nbsp;<b>
                  <?=$gr[groupname]?>
                  </b></td>
              </tr>
              <tr>
                <td height="22">這是您第 <b>
                  <?=$user_r[loginnum]?>
                  </b> 次登錄，上次登錄時間：
                  <?=$user_r[pretime]?date('Y-m-d H:i:s',$user_r[pretime]):'---'?>
                  ，登錄IP：
                  <?=$user_r[preip]?$user_r[preip].':'.$user_r[preipport]:'---'?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td width="100%" height="25"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><strong><a href="#ecms">快捷菜單</a></strong></td>
                <td><div align="right"><a href="http://www.phome.net/edown25/" target="_blank"><strong>帝國下載系統</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>信息操作</strong>：&nbsp;&nbsp;<a href="AddInfoChClass.php<?=$ecms_hashur['whehref']?>">增加信息</a>&nbsp;&nbsp; 
            <a href="ListAllInfo.php<?=$ecms_hashur['whehref']?>">管理信息</a>&nbsp;&nbsp; <a href="ListAllInfo.php?ecmscheck=1<?=$ecms_hashur['ehref']?>">審核信息</a> 
            &nbsp;&nbsp; <a href="workflow/ListWfInfo.php<?=$ecms_hashur['whehref']?>">簽發信息</a>&nbsp;&nbsp; <a href="openpage/AdminPage.php?leftfile=<?=urlencode('../pl/PlNav.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../pl/PlMain.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('管理評論')?><?=$ecms_hashur['ehref']?>">管理評論</a>&nbsp;&nbsp; <a href="sp/UpdateSp.php<?=$ecms_hashur['whehref']?>">更新碎片</a>&nbsp;&nbsp; 
            <a href="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">數據更新中心</a></td>
           </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>欄目操作</strong>：&nbsp;&nbsp;<a href="ListClass.php<?=$ecms_hashur['whehref']?>">管理欄目</a>&nbsp;&nbsp; 
            <a href="special/ListZt.php<?=$ecms_hashur['whehref']?>">管理專題</a>&nbsp;&nbsp; <a href="ListInfoClass.php<?=$ecms_hashur['whehref']?>">管理採集</a> 
            &nbsp;&nbsp; <a href="openpage/AdminPage.php?leftfile=<?=urlencode('../file/FileNav.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('管理附件')?><?=$ecms_hashur['ehref']?>">附件管理</a>&nbsp;&nbsp; 
            <a href="SetEnews.php<?=$ecms_hashur['whehref']?>">系統參數設置</a></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>用戶操作</strong>：&nbsp;&nbsp;<a href="member/ListMember.php?sear=1&schecked=1<?=$ecms_hashur['ehref']?>">審核會員</a>&nbsp;&nbsp; 
            <a href="member/ListMember.php<?=$ecms_hashur['whehref']?>">管理會員</a> &nbsp; <a href="user/ListLog.php<?=$ecms_hashur['whehref']?>">管理登陸日誌</a> 
            &nbsp;&nbsp; <a href="user/ListDolog.php<?=$ecms_hashur['whehref']?>">管理操作日誌</a>&nbsp;&nbsp; <a href="user/EditPassword.php<?=$ecms_hashur['whehref']?>">修改個人資料</a>&nbsp;&nbsp; 
            <a href="user/UserTotal.php<?=$ecms_hashur['whehref']?>">用戶發佈統計</a></td>
        </tr>
        <tr> 
          <td height="25" bgcolor="#FFFFFF"><strong>反饋管理</strong>：&nbsp;&nbsp;<a href="tool/gbook.php<?=$ecms_hashur['whehref']?>">管理留言</a>&nbsp;&nbsp; 
            <a href="tool/feedback.php<?=$ecms_hashur['whehref']?>">管理反饋信息</a>&nbsp;&nbsp;<a href="DownSys/ListError.php<?=$ecms_hashur['whehref']?>">管理錯誤報告</a>&nbsp;&nbsp; 
            <a href="#empirecms" onclick="window.open('openpage/AdminPage.php?leftfile=<?=urlencode('../ShopSys/pageleft.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../ShopSys/ListDd.php'.$ecms_hashur['whehref'])?>&title=<?=urlencode('商城系統管理')?><?=$ecms_hashur['ehref']?>','AdminShopSys','');">管理訂單</a>&nbsp;&nbsp;<a href="pay/ListPayRecord.php<?=$ecms_hashur['whehref']?>">管理支付記錄</a>&nbsp;&nbsp; 
            <a href="PathLevel.php<?=$ecms_hashur['whehref']?>">查看目錄權限狀態</a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="42"> <div align="center"><strong><font color="#0000FF" size="3">帝國網站管理系統全面開源 
              － 最安全、最穩定的開源CMS系統</font></strong></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%"><a href="#"><strong>系統信息</strong></a></td>
                <td><div align="right"><a href="http://www.phome.net/ebak2010/" target="_blank"><strong>帝國MYSQL備份王下載</strong></a></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td width="43%"><strong>網站信息</strong></td>
          <td width="57%"><strong>服務器信息</strong></td>
        </tr>
        <tr> 
          <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td width="28%" height="23">會員註冊:</td>
                <td width="72%"> 
                  <?=$register_ok?>
                </td>
              </tr>
              <tr> 
                <td height="23">會員投稿:</td>
                <td> 
                  <?=$addnews_ok?>
                </td>
              </tr>
              <tr> 
                <td height="23">管理員個數:</td>
                <td><a href="user/ListUser.php<?=$ecms_hashur['whehref']?>"><?=$adminnum?></a> 人</td>
              </tr>
              <tr> 
                <td height="23">未審核評論:</td>
                <td><a href="openpage/AdminPage.php?leftfile=<?=urlencode('../pl/PlNav.php'.$ecms_hashur['whehref'])?>&mainfile=<?=urlencode('../pl/ListAllPl.php?checked=2'.$ecms_hashur['ehref'])?>&title=<?=urlencode('管理評論')?><?=$ecms_hashur['ehref']?>"><?=$noplnum?></a> 條</td>
              </tr>
              <tr> 
                <td height="23">未審核會員:</td>
                <td><a href="member/ListMember.php?sear=1&schecked=1<?=$ecms_hashur['ehref']?>"><?=$nomembernum?></a> 人</td>
              </tr>
              <tr> 
                <td height="23">過期廣告:</td>
                <td><a href="tool/ListAd.php?time=1<?=$ecms_hashur['ehref']?>"><?=$outtimeadnum?></a> 個</td>
              </tr>
              <tr> 
                <td height="23">登陸者IP:</td>
                <td><?php echo egetip();?></td>
              </tr>
              <tr> 
                <td height="23">程序版本:</td>
                <td> <a href="http://www.phome.net" target="_blank"><strong>EmpireCMS 
                  v<?=EmpireCMS_VERSION?> Free</strong></a> <font color="#666666">(<?=EmpireCMS_LASTTIME?>)</font></td>
              </tr>
              <tr>
                <td height="23">程序編碼:</td>
                <td><?=EmpireCMS_CHARVER?></td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td width="25%" height="23">服務器軟件:</td>
                <td width="75%"> 
                  <?=$_SERVER['SERVER_SOFTWARE']?>
                </td>
              </tr>
              <tr> 
                <td height="23">操作系統:</td>
                <td><?php echo defined('PHP_OS')?PHP_OS:'未知';?></td>
              </tr>
              <tr> 
                <td height="23">PHP版本:</td>
                <td><?php echo @phpversion();?></td>
              </tr>
              <tr> 
                <td height="23">MYSQL版本:</td>
                <td><?php echo @mysql_get_server_info();?></td>
              </tr>
              <tr> 
                <td height="23">全局變量:</td>
                <td> 
                  <?=$onoff?>
                  <font color="#666666">(建議關閉)</font></td>
              </tr>
              <tr>
                <td height="23">魔術引用:</td>
                <td> 
                  <?=MAGIC_QUOTES_GPC?'開啟':'關閉'?>
                  <font color="#666666">(建議開啟)</font></td>
              </tr>
              <tr> 
                <td height="23">上傳文件:</td>
                <td> 
                  <?=$upload?>
                  <font color="#666666">(最大文件：<?=$uploadsize?>，表單：<?=$uploadpostsize?>)</font> </td>
              </tr>
              <tr> 
                <td height="23">當前時間:</td>
                <td><?php echo date("Y-m-d H:i:s");?></td>
              </tr>
              <tr> 
                <td height="23">使用域名:</td>
                <td> 
                  <?=$_SERVER['HTTP_HOST']?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2">官方信息</td>
        </tr>
        <tr> 
          <td width="43%" bgcolor="#FFFFFF"> 
            <table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="28%" height="25">帝國官方主頁</td>
                <td width="72%" height="25"><a href="http://www.phome.net" target="_blank">http://www.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">帝國官方論壇</td>
                <td height="25"><a href="http://bbs.phome.net" target="_blank">http://bbs.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">帝國產品中心</td>
                <td height="25"><a href="http://www.phome.net/product/" target="_blank">http://www.phome.net/product/</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">公司網站</td>
                <td height="25"><a href="http://www.digod.com" target="_blank">http://www.digod.com</a></td>
              </tr>
            </table>
          </td>
          <td width="57%" height="125" valign="top" bgcolor="#FFFFFF"> 
            <IFRAME frameBorder="0" name="getinfo" scrolling="no" src="ginfo.php<?=$ecms_hashur['whehref']?>" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25">EmpireCMS 開發團隊</td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="80%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="15%" height="25">版權所有</td>
                <td width="85%"><a href="http://www.digod.com" target="_blank">漳州市薌城帝興軟件開發有限公司</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">開發與支持團隊</td>
                <td>wm_chief、amt、帝興、小游、zeedy</td>
              </tr>
              
              <tr bgcolor="#FFFFFF"> 
                <td height="25">特別感謝</td>
                <td>禾火木風、yingnt、hicode、sooden、老鬼、小林、天浪歌、TryLife、5starsgeneral</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>