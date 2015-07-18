<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require "../".LoadLang("pub/fun.php");
require("../../data/dbcache/class.php");
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
CheckLevel($logininid,$loginin,$classid,"file");
//參數
$modtype=(int)$_GET['modtype'];
$fstb=(int)$_GET['fstb'];
//附件表
$fstb=eReturnFileStb($fstb);
//附件類型
$isinfofile=0;
$showfstb='';
if($modtype==1)//欄目
{
	$query="select fileid,filename,filesize,path,filetime,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_other where modtype=1";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_other where modtype=1";
	$tranname='欄目';
}
elseif($modtype==2)//專題
{
	$query="select fileid,filename,filesize,path,filetime,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_other where modtype=2";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_other where modtype=2";
	$tranname='專題';
}
elseif($modtype==3)//廣告
{
	$query="select fileid,filename,filesize,path,filetime,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_other where modtype=3";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_other where modtype=3";
	$tranname='廣告';
}
elseif($modtype==4)//反饋
{
	$query="select fileid,filename,filesize,path,filetime,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_other where modtype=4";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_other where modtype=4";
	$tranname='反饋';
}
elseif($modtype==5)//公共
{
	$query="select fileid,filename,filesize,path,filetime,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_public where 1=1";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_public where 1=1";
	$tranname='公共';
}
elseif($modtype==6)//會員
{
	$query="select fileid,filename,filesize,path,filetime,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_member where 1=1";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_member where 1=1";
	$tranname='會員';
}
elseif($modtype==7)//碎片
{
	$query="select fileid,filename,filesize,path,filetime,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_other where modtype=7";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_other where modtype=7";
	$tranname='碎片';
}
else//信息
{
	$isinfofile=1;
	$showfstb=' - 分表'.$fstb.' ';
	$query="select fileid,filename,filesize,path,filetime,classid,no,fpath,adduser,id,type,onclick from {$dbtbpre}enewsfile_{$fstb} where 1=1";
	$totalquery="select count(*) as total from {$dbtbpre}enewsfile_{$fstb} where 1=1";
	$tranname='信息';
}
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=25;//每頁顯示條數
$page_line=12;//每頁顯示鏈接數
$offset=$page*$line;//總偏移量
$add='';
//附件類型
$type=(int)$_GET['type'];
if($type!=9)//其他附件
{
	$add.=" and type='$type'";
}
//選擇欄目
$classid=(int)$_GET['classid'];
/*
$fcjsfile='../../data/fc/cmsclass.js';
$classoptions=GetFcfiletext($fcjsfile);
*/
//欄目
if($isinfofile==1)
{
	if($classid)
	{
		if($class_r[$classid]['islast'])
		{
			$add.=" and classid='$classid'";
		}
		else
		{
			$add.=" and ".ReturnClass($class_r[$classid]['sonclass']);
		}
		//$classoptions=str_replace("<option value='$classid'","<option value='$classid' selected",$classoptions);
	}
}
//關鍵字
$keyboard=RepPostVar2($_GET['keyboard']);
if(!empty($keyboard))
{
	$show=RepPostStr($_GET['show'],1);
	//搜索全部
	if($show==0)
	{
		$add.=" and (filename like '%$keyboard%' or no like '%$keyboard%' or adduser like '%$keyboard%')";
	}
	//搜索文件名
	elseif($show==1)
	{
		$add.=" and filename like '%$keyboard%'";
	}
	//搜索編號
	elseif($show==2)
	{
		$add.=" and no like '%$keyboard%'";
	}
	//搜索上傳者
	else
	{
		$add.=" and adduser like '%$keyboard%'";
	}
}
$search="&classid=$classid&type=$type&modtype=$modtype&fstb=$fstb&show=$show&keyboard=$keyboard".$ecms_hashur['ehref'];
$query.=$add;
$totalquery.=$add;
$num=$empire->gettotal($totalquery);//取得總條數
$query=$query." order by fileid desc limit $offset,$line";
$sql=$empire->query($query);
$returnpage=page2($num,$line,$page_line,$start,$page,$search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<title>管理附件</title>
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td width="36%">位置：管理<?=$tranname?>附件<?=$showfstb?> (數據庫式)&nbsp;</td>
    <td width="64%"><div align="right" class="emenubutton">
      </div></td>
  </tr>
</table>
<br>
  
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <form name="form2" method="get" action="ListFile.php">
  <?=$ecms_hashur['eform']?>
    <input type=hidden name=classid value="<?=$classid?>">
	<input type=hidden name=modtype value="<?=$modtype?>">
    <input type=hidden name=fstb value="<?=$fstb?>">
    <tr> 
      <td width="82%">搜索: <select name="type" id="select">
          <option value="9">所有附件類型</option>
          <option value="1"<?=$type==1?' selected':''?>>圖片</option>
          <option value="2"<?=$type==2?' selected':''?>>Flash文件</option>
          <option value="3"<?=$type==3?' selected':''?>>多媒體文件</option>
          <option value="0"<?=$type==0?' selected':''?>>其他附件</option>
        </select> <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
        <select name="show" id="show">
          <option value="0"<?=$show==0?' checked':''?>>不限</option>
          <option value="1"<?=$show==1?' checked':''?>>文件名</option>
          <option value="2"<?=$show==2?' checked':''?>>編號</option>
          <option value="3"<?=$show==3?' checked':''?>>上傳者</option>
        </select>
		<span id="listfileclassnav"></span>
        <input type="submit" name="Submit2" value="搜索"> </td>
      <td width="18%"><div align="center">[<a href="../ecmsfile.php?enews=DelFreeFile<?=$ecms_hashur['href']?>" onclick="return confirm('確認要操作?');">清理失效附件</a>]</div></td>
    </tr>
  </form>
</table>
<form name="form1" method="post" action="../ecmsfile.php" onsubmit="return confirm('確認要刪除?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td width="5%" height="25"><div align="center">ID</div></td>
      <td width="29%" height="25"><div align="center">文件名</div></td>
      <td width="10%" height="25"><div align="center">增加者</div></td>
      <td width="9%"><div align="center">文件大小</div></td>
      <td width="17%" height="25"><div align="center">增加時間</div></td>
      <td width="11%" height="25"><div align="center">操作</div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		$filesize=ChTheFilesize($r[filesize]);
		$fspath=ReturnFileSavePath($r[classid],$r[fpath]);
		$filepath=$r[path]?$r[path].'/':$r[path];
		$path1=$fspath['fileurl'].$filepath.$r[filename];
		//引用
		$thisfileid=$r['fileid'];
		if($isinfofile==1&&$r['id'])
		{
			$thisfileid="<b><a href='../../public/InfoUrl/?classid=$r[classid]&id=$r[id]' target=_blank>".$r[fileid]."</a></b>";
		}
	?>
    <tr bgcolor="#FFFFFF" id="file<?=$r[fileid]?>" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="25"><div align="center"> 
          <?=$thisfileid?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=$r[no]?>
          <br>
          <a href="<?=$path1?>" target="_blank">
          <?=$r[filename]?>
          </a> </div></td>
      <td height="25"><div align="center"> 
          <?=$r[adduser]?>
        </div></td>
      <td><div align="center"> 
          <?=$filesize?>
        </div></td>
      <td height="25"><div align="center"> 
          <?=date('Y-m-d H:i:s',$r[filetime])?>
        </div></td>
      <td height="25"><div align="center">[<a href="../ecmsfile.php?enews=DelFile&fileid=<?=$r[fileid]?>&modtype=<?=$modtype?>&fstb=<?=$fstb?><?=$ecms_hashur['href']?>" onclick="return confirm('您是否要刪除？');">刪除</a> 
          <input name="fileid[]" type="checkbox" id="fileid[]" value="<?=$r[fileid]?>" onclick="if(this.checked){file<?=$r[fileid]?>.style.backgroundColor='#DBEAF5';}else{file<?=$r[fileid]?>.style.backgroundColor='#ffffff';}">
          ]</div></td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="6"> 
        <?=$returnpage?>
        &nbsp;&nbsp; <input type="submit" name="Submit" value="批量刪除"> <input name="enews" type="hidden" id="enews" value="DelFile_all"> 
        &nbsp;
        <input type=checkbox name=chkall value=on onClick=CheckAll(this.form)>
        選中全部
		<input type=hidden name=classid value="<?=$classid?>">
		<input type=hidden name=modtype value="<?=$modtype?>">
		<input type=hidden name=fstb value="<?=$fstb?>">
		</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="6"><font color="#666666">如果ID是粗體，表示有信息引用，點擊ID即可查看信息頁面</font></td>
    </tr>
  </table>
</form>
<?php
if($isinfofile==1)
{
?>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="../ShowClassNav.php?ecms=5&classid=<?=$classid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
<?php
}
?>
</body>
</html>
<?php
db_close();
$empire=null;
?>
