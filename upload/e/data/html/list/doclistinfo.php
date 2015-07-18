<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
//查詢SQL，如果要顯示自定義字段記得在SQL裡增加查詢字段
$query="select id,classid,isurl,titleurl,isqf,havehtml,istop,isgood,firsttitle,ismember,userid,username,plnum,totaldown,onclick,newstime,truetime,lastdotime,titlepic,title from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_doc".$ewhere." order by ".$doorder." limit $offset,$line";
$sql=$empire->query($query);
//返回頭條和推薦級別名稱
$ftnr=ReturnFirsttitleNameList(0,0);
$ftnamer=$ftnr['ftr'];
$ignamer=$ftnr['igr'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link rel="stylesheet" href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" type="text/css">
<title>管理歸檔</title>
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
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>位置: <?=$url?></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <form name="form2" method="GET" action="ListInfoDoc.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
          <tr> 
            <td><div class="emenubutton"> 
                <div align="right">
                  <input type=button name=button value=增加信息 onClick="self.location.href='AddNews.php?enews=AddNews&bclassid=<?=$bclassid?>&classid=<?=$classid?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>'">
                  &nbsp; 
                  <input type="button" name="Submit" value="刷新首頁" onclick="self.location.href='ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>'">
                  &nbsp; 
                  <input type="button" name="Submit22" value="刷新本欄目" onclick="self.location.href='enews.php?<?=$ecms_hashur['href']?>&enews=ReListHtml&classid=<?=$classid?>'">
                  &nbsp; 
                  <input type="button" name="Submit4" value="刷新所有信息JS" onclick="window.open('ecmschtml.php?<?=$ecms_hashur['href']?>&enews=ReAllNewsJs&from=<?=$phpmyself?>','','');">
                  &nbsp; 
                  <input type="button" name="Submit10" value="欄目設置" onclick="self.location.href='AddClass.php?<?=$ecms_hashur['ehref']?>&enews=EditClass&classid=<?=$classid?>'">
                  &nbsp; 
                  <input type="button" name="Submit102" value="增加採集節點" onclick="self.location.href='AddInfoClass.php?enews=AddInfoClass&newsclassid=<?=$classid?><?=$ecms_hashur['ehref']?>'">
                  &nbsp; 
                  <input type="button" name="Submit103" value="管理採集節點" onclick="self.location.href='ListInfoClass.php<?=$ecms_hashur['whehref']?>'">
                </div>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td width="38%">
<div align="left">[<a href="InfoDoc.php<?=$ecms_hashur['whehref']?>" target="_blank">批量歸檔信息</a>]&nbsp;[<a href="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>" target=_blank>更新數據</a>]&nbsp;[<a href=../../ target=_blank>預覽首頁</a>]&nbsp;[<a href="<?=$classurl?>" target=_blank>預覽欄目</a>]</div></td>
      <td width="62%">
<div align="right"> 
          <input name="keyboard" type="text" id="keyboard2" value="<?=$keyboard?>" size="16">
          <select name="show">
            <option value="0" selected>不限字段</option>
            <?=$searchoptions_r['select']?>
          </select>
		  <?=$stts?>
          <input type="submit" name="Submit2" value="搜索">
          <input name="sear" type="hidden" id="sear2" value="1">
          <input name="bclassid" type="hidden" id="bclassid" value="<?=$bclassid?>">
          <input name="classid" type="hidden" id="classid" value="<?=$classid?>">
		  <input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
        </div></td>
    </tr>
  </form>
</table>
<br>
<form name="listform" method="post" action="ecmsinfo.php" onsubmit="return confirm('確認要執行此操作？');">
<?=$ecms_hashur['form']?>
<input type=hidden name=classid value=<?=$classid?>>
<input type=hidden name=bclassid value=<?=$bclassid?>>
  <input type=hidden name=enews value=DelInfoDoc_all>
  <input type=hidden name=doing value=1>
  <input name="ecmsdoc" type="hidden" id="ecmsdoc" value="0">
  <input name="docfrom" type="hidden" id="docfrom" value="<?=$phpmyself?>">
  <input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="10%" height="25" bgcolor="#C9F1FF"><div align="center"><a href="ListNews.php?bclassid=<?=$bclassid?>&classid=<?=$classid?><?=$ecms_hashur['ehref']?>">已發佈</a></div></td>
      <td width="10%" bgcolor="#C9F1FF"><div align="center"><a href="ListNews.php?bclassid=<?=$bclassid?>&classid=<?=$classid?>&ecmscheck=1<?=$ecms_hashur['ehref']?>">待審核</a></div></td>
      <td width="10%" class="header"><div align="center"><a href="ListInfoDoc.php?bclassid=<?=$bclassid?>&classid=<?=$classid?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>">歸檔</a></div></td>
      <td width="58%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td width="7%" height="25"><div align="center"><a href='ListInfoDoc.php?<?=$search1?>&myorder=4'><u>ID</u></a></div></td>
      <td width="47%" height="25"> <div align="center">標題</div></td>
      <td width="18%" height="25"><div align="center">發佈者</div></td>
      <td width="22%" height="25"> <div align="center"><a href='ListInfoDoc.php?<?=$search1?>&myorder=1'><u>發佈時間</u></a></div></td>
      <td width="6%" height="25"> <div align="center">選擇</div></td>
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
		$truetime=date("Y-m-d H:i:s",$r[truetime]);
		$lastdotime=date("Y-m-d H:i:s",$r[lastdotime]);
		$oldtitle=$r[title];
		$r[title]=stripSlashes(sub($r[title],0,50,false));
		$titleurl=sys_ReturnBqTitleLink($r);
		//會員投稿
		if($r[ismember])
		{
			$r[username]="<a href='member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target='_blank'><font color=red>".$r[username]."</font></a>";
		}
		//簽發
		$qf="";
		if($r[isqf])
		{
			$qfr=$empire->fetch1("select checktno,tstatus from {$dbtbpre}enewswfinfo where id='$r[id]' and classid='$r[classid]' limit 1");
			if($qfr[checktno]=='100')
			{
				$qf="(<font color='red'>已通過</font>)";
			}
			elseif($qfr[checktno]=='101')
			{
				$qf="(<font color='red'>返工</font>)";
			}
			elseif($qfr[checktno]=='102')
			{
				$qf="(<font color='red'>已否決</font>)";
			}
			else
			{
				$qf="(<font color='red'>$qfr[tstatus]</font>)";
			}
			$qf="<a href='#ecms' onclick=\"window.open('workflow/DoWfInfo.php?classid=$r[classid]&id=$r[id]".$addecmscheck.$ecms_hashur['ehref']."','','width=600,height=520,scrollbars=yes');\">".$qf."</a>";
		}
		//標題圖片
		$showtitlepic="";
		if($r[titlepic])
		{
			$showtitlepic="<a href='".$r[titlepic]."' title='預覽標題圖片' target=_blank><img src='../data/images/showimg.gif' border=0></a>";
		}
		//未生成
		$myid=$r['id'];
		if(empty($r[havehtml]))
		{
		$myid="<a title='未生成'><b>".$r[id]."</b></a>";
		}
	?>
    <tr bgcolor="#FFFFFF" id=news<?=$r[id]?> onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td height="32"> <div align="center"> 
          <?=$myid?>
        </div></td>
      <td height="25"> <div align="left"> 
          <?=$st?>
          <?=$showtitlepic?>
          <a href='<?=$titleurl?>' target=_blank title="<?=$oldtitle?>"> 
          <?=$r[title]?>
          </a> 
          <?=$qf?>
        </div></td>
      <td height="25"> <div align="center"> 
          <?=$r[username]?>
        </div></td>
      <td height="25"> <div align="center"> <a href="#ecms" title="<?php echo"增加時間：".$truetime."\r\n最後修改：".$lastdotime;?>"> 
          <?=date("Y-m-d H:i:s",$r[newstime])?>
          </a> </div></td>
      <td height="25"> <div align="center"> 
          <input name="id[]" type="checkbox" id="id[]" value="<?=$r[id]?>">
        </div></td>
    </tr>
    <?php
	}
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="4"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="83%"> 
              <?=$returnpage?>
            </td>
            <td width="17%"><div align="right"> 
                <input type="submit" name="Submit3" value="刪除" onClick="document.listform.enews.value='DelInfoDoc_all';document.listform.action='ecmsinfo.php';">
                <input type="submit" name="Submit11" value="還原歸檔" onClick="document.listform.enews.value='InfoToDoc';document.listform.doing.value='1';document.listform.action='ecmsinfo.php';">
              </div></td>
          </tr>
        </table></td>
      <td height="25"><div align="center">
          <input type=checkbox name=chkall value=on onClick=CheckAll(this.form)>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="5"> <font color="#666666">備註：發佈者紅色為會員投稿；信息ID粗體為未生成.</font></td>
    </tr>
  </table>
</form>
</body>
</html>