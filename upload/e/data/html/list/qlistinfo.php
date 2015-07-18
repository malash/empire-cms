<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
//查詢SQL，如果要顯示自定義字段記得在SQL裡增加查詢字段
$query="select id,classid,isurl,titleurl,isqf,havehtml,istop,isgood,firsttitle,ismember,username,plnum,totaldown,onclick,newstime,truetime,lastdotime,titlefont,titlepic,title from ".$infotb." where ".$yhadd."userid='$user[userid]' and ismember=1".$add." order by newstime desc limit $offset,$line";
$sql=$empire->query($query);
//返回頭條和推薦級別名稱
$ftnr=ReturnFirsttitleNameList(0,0);
$ftnamer=$ftnr['ftr'];
$ignamer=$ftnr['igr'];

$public_diyr['pagetitle']='管理信息';
$url="<a href='../../'>首頁</a>&nbsp;>&nbsp;<a href='../member/cp/'>會員中心</a>&nbsp;>&nbsp;<a href='ListInfo.php?mid=$mid".$addecmscheck."'>管理信息</a>&nbsp;(".$mr[qmname].")";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <form name="searchinfo" method="GET" action="ListInfo.php">
    <tr>
            <td width="25%" height="27"> 
              <input type="button" name="Submit" value="增加信息" onclick="self.location.href='ChangeClass.php?mid=<?=$mid?><?=$addecmscheck?>';">            </td>
      <td width="75%"><div align="right">&nbsp;搜索： 
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="show">
            <option value="0" selected>標題</option>
          </select>
          <input type="submit" name="Submit2" value="搜索">
          <input name="sear" type="hidden" id="sear" value="1">
          <input name="mid" type="hidden" value="<?=$mid?>">
		  <input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
        </div></td>
    </tr>
  </form>
</table>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="9%" height="25"<?=$indexchecked==1?' class="header"':' bgcolor="#C9F1FF"'?>><div align="center"><a href="ListInfo.php?mid=<?=$mid?>">已發佈</a></div></td>
    <td width="9%"<?=$indexchecked==0?' class="header"':' bgcolor="#C9F1FF"'?>><div align="center"><a href="ListInfo.php?mid=<?=$mid?>&ecmscheck=1">待審核</a></div></td>
    <td width="23%">&nbsp;</td>
    <td width="47%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <tr class="header"> 
    <td width="50%" height="25"> <div align="center">標題</div></td>
    <td width="13%" height="25"> <div align="center">發佈時間</div></td>
	<td width="8%" height="25"> 
      <div align="center">點擊</div></td>
    <td width="6%">
      <div align="center">評論</div></td>
    <td width="6%"><div align="center">審核</div></td>
    <td width="17%" height="25"> 
      <div align="center">操作</div></td>
  </tr>
  <?php
	while($r=$empire->fetch($sql))
	{
		//狀態
		$st='';
		if($r[istop])//置頂
		{
			$st.="<font color=red>[頂".$r[istop]."]</font>";
		}
		if($r[isgood])//推薦
		{
			$st.="<font color=red>[".$ignamer[$r[isgood]-1]."]</font>";
		}
		if($r[firsttitle])//頭條
		{
			$st.="<font color=red>[".$ftnamer[$r[firsttitle]-1]."]</font>";
		}
		//時間
		$newstime=date("Y-m-d",$r[newstime]);
		$oldtitle=$r[title];
		$r[title]=stripSlashes(sub($r[title],0,50,false));
		$r[title]=DoTitleFont($r[titlefont],$r[title]);
		if($indexchecked==0)
		{
			$checked='<font color=red>×</font>';
			$titleurl='AddInfo.php?enews=MEditInfo&classid='.$r[classid].'&id='.$r[id].'&mid='.$mid.$addecmscheck;//鏈接
		}
		else
		{
			$checked='√';
			$titleurl=sys_ReturnBqTitleLink($r);//鏈接
		}
		$plnum=$r[plnum];//評論個數
		//標題圖片
		$showtitlepic="";
		if($r[titlepic])
		{$showtitlepic="<a href='".$r[titlepic]."' title='預覽標題圖片' target=_blank><img src='../data/images/showimg.gif' border=0></a>";}
		//欄目
		$classname=$class_r[$r[classid]][classname];
		$classurl=sys_ReturnBqClassname($r,9);
		$bclassid=$class_r[$r[classid]][bclassid];
		$br['classid']=$bclassid;
		$bclassurl=sys_ReturnBqClassname($br,9);
		$bclassname=$class_r[$bclassid][classname];
		//評論地址
		$pagefunr=eReturnRewritePlUrl($r['classid'],$r['id'],'doinfo',0,0,1);
		$eplurl=$pagefunr['pageurl'];
	?>
  <tr bgcolor="#FFFFFF" id=news<?=$r[id]?>> 
    <td height="25"> <div align="left"> 
        <?=$st?>
		<?=$showtitlepic?>
        <a href="<?=$titleurl?>" target=_blank title="<?=$oldtitle?>"> 
        <strong><?=$r[title]?></strong>        </a>
		<br>
          欄目:<a href='<?=$bclassurl?>' target='_blank'><?=$bclassname?></a> > <a href='<?=$classurl?>' target='_blank'><?=$classname?></a>
      </div></td>
    <td height="25"> <div align="center"><?=$newstime?></div></td>
	<td height="25"> <div align="center"> <a title="下載次數:<?=$r[totaldown]?>"> 
        <?=$r[onclick]?>
        </a> </div></td>
    <td><div align="center"><a href="<?=$eplurl?>" title="查看評論" target=_blank><u><?=$plnum?></u></a></div></td>
    <td><div align="center">
        <?=$checked?>
      </div></td>
    <td height="25"><div align="center"><a href="AddInfo.php?enews=MEditInfo&classid=<?=$r[classid]?>&id=<?=$r[id]?>&mid=<?=$mid?><?=$addecmscheck?>">修改</a> | <a href="ecms.php?enews=MDelInfo&classid=<?=$r[classid]?>&id=<?=$r[id]?>&mid=<?=$mid?><?=$addecmscheck?>" onclick="return confirm('確認要刪除?');">刪除</a> 
      </div></td>
  </tr>
  <?php
	}
	?>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="6"> 
      <?=$returnpage?>    </td>
  </tr>
</table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>