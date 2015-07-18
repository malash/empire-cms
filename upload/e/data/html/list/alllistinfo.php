<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
//查詢SQL，如果要顯示自定義字段記得在SQL裡增加查詢字段
$query="select id,classid,isurl,titleurl,isqf,havehtml,istop,isgood,firsttitle,ismember,userid,username,plnum,totaldown,onclick,newstime,truetime,lastdotime,titlepic,title from ".$infotb.$where." order by ".$doorder." limit $offset,$line";
$sql=$empire->query($query);
//返回頭條和推薦級別名稱
$ftnr=ReturnFirsttitleNameList(0,0);
$ftnamer=$ftnr['ftr'];
$ignamer=$ftnr['igr'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" type="text/css">
<title>管理信息</title>
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

function GetSelectId(form)
{
  var ids='';
  var dh='';
  for (var i=0;i<form.elements.length;i++)
  {
	var e = form.elements[i];
	if (e.name == 'id[]')
	{
	   if(e.checked==true)
	   {
       		ids+=dh+e.value;
			dh=',';
	   }
	}
  }
  return ids;
}

function PushInfoToSp(form)
{
	var id='';
	id=GetSelectId(form);
	if(id=='')
	{
		alert('請選擇要推送的信息');
		return false;
	}
	window.open('sp/PushToSp.php?<?=$ecms_hashur['ehref']?>&tid=<?=$tid?>&id='+id,'PushToSp','width=360,height=500,scrollbars=yes,left=300,top=150,resizable=yes');
}

function PushInfoToZt(form)
{
	var id='';
	id=GetSelectId(form);
	if(id=='')
	{
		alert('請選擇要推送的信息');
		return false;
	}
	window.open('special/PushToZt.php?<?=$ecms_hashur['ehref']?>&tid=<?=$tid?>&id='+id,'PushToZt','width=360,height=500,scrollbars=yes,left=300,top=150,resizable=yes');
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
<form name="AddNewsForm" id="AddNewsForm" method="get">
  <tr> 
    <td width="24%">位置： 
      <?=$url?>
    </td>
    <td width="76%"><div align="right" class="emenubutton">
		  <span id="showaddclassnav"></span>
          <input type="button" name="Submit" value="增加信息" onclick="if(document.getElementById('addclassid').value!=0){window.open('AddNews.php?<?=$ecms_hashur['ehref']?>&enews=AddNews<?=$addecmscheck?>&classid='+document.getElementById('addclassid').value,'','');}else{alert('請選擇要增加信息的欄目');document.getElementById('addclassid').focus();}">
		  &nbsp; 
          <input type="button" name="Submit4" value="刷新首頁" onclick="self.location.href='ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>'">
          &nbsp; 
          <input type="button" name="Submit4" value="刷新所有信息JS" onclick="window.open('ecmschtml.php?enews=ReAllNewsJs&from=<?=$phpmyself?><?=$ecms_hashur['href']?>','','');">
        </div></td>
  </tr>
</form>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="SearchForm" id="SearchForm" method="GET" action="ListAllInfo.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td width="100%"> <div align="right">&nbsp;搜索： 
          <select name="showspecial" id="showspecial">
            <option value="0"<?=$showspecial==0?' selected':''?>>不限屬性</option>
			<option value="1"<?=$showspecial==1?' selected':''?>>置頂</option>
            <option value="2"<?=$showspecial==2?' selected':''?>>推薦</option>
            <option value="3"<?=$showspecial==3?' selected':''?>>頭條</option>
			<option value="7"<?=$showspecial==7?' selected':''?>>投稿</option>
            <option value="5"<?=$showspecial==5?' selected':''?>>簽發</option>
			<option value="8"<?=$showspecial==8?' selected':''?>>我的信息</option>
          </select>
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="show">
            <option value="0"<?=$show==0?' selected':''?>>不限字段</option>
            <option value="1"<?=$show==1?' selected':''?>>標題</option>
            <option value="2"<?=$show==2?' selected':''?>>發佈者</option>
			<option value="3"<?=$show==3?' selected':''?>>ID</option>
          </select>
		  <?=$stts?>
		  <span id="searchclassnav"></span>
          <select name="myorder" id="myorder">
            <option value="1"<?=$myorder==1?' selected':''?>>按信息ID</option>
            <option value="2"<?=$myorder==2?' selected':''?>>按發佈時間</option>
            <option value="3"<?=$myorder==3?' selected':''?>>按點擊率</option>
            <option value="4"<?=$myorder==4?' selected':''?>>按下載數</option>
            <option value="5"<?=$myorder==5?' selected':''?>>按評論數</option>
          </select>
          <select name="orderby" id="orderby">
            <option value="0"<?=$orderby==0?' selected':''?>>降序排序</option>
            <option value="1"<?=$orderby==1?' selected':''?>>升序排序</option>
          </select>
          <select name="infolday" id="infolday">
            <option value="1"<?=$infolday==1?' selected':''?>>全部時間</option>
            <option value="86400"<?=$infolday==86400?' selected':''?>>1 天</option>
            <option value="172800"<?=$infolday==172800?' selected':''?>>2 天</option>
            <option value="604800"<?=$infolday==604800?' selected':''?>>一周</option>
            <option value="2592000"<?=$infolday==2592000?' selected':''?>>1 個月</option>
            <option value="7948800"<?=$infolday==7948800?' selected':''?>>3 個月</option>
            <option value="15897600"<?=$infolday==15897600?' selected':''?>>6 
            個月</option>
            <option value="31536000"<?=$infolday==31536000?' selected':''?>>1 
            年</option>
          </select>
          <input type="submit" name="Submit2" value="搜索">
          <input name="tbname" type="hidden" value="<?=$tbname?>">
          <input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
          <input name="sear" type="hidden" value="1">
        </div></td>
    </tr>
  </form>
</table>
<br>
<form name="listform" method="post" action="ecmsinfo.php" onsubmit="return confirm('確認要執行此操作？');">
<?=$ecms_hashur['form']?>
  <input type=hidden name=enews value=DelNews_all>
  <input name=mid type=hidden id="mid" value=<?=$mid?>>
  <input type=hidden name=doing value=0>
  <input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="10%" height="25"<?=$indexchecked==1?' class="header"':' bgcolor="#C9F1FF"'?>><div align="center"><a href="ListAllInfo.php?tbname=<?=$tbname?><?=$ecms_hashur['ehref']?>" title="已發佈信息總數：<?=$tbinfos?>">已發佈 (<?=$tbinfos?>)</a></div></td>
      <td width="10%"<?=$indexchecked==0?' class="header"':' bgcolor="#C9F1FF"'?> title="待審核信息總數：<?=$tbckinfos?>"><div align="center"><a href="ListAllInfo.php?tbname=<?=$tbname?>&ecmscheck=1<?=$ecms_hashur['ehref']?>">待審核 (<?=$tbckinfos?>)</a></div></td>
      <td width="10%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
    <tr class="header"> 
      <td height="25" colspan="8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="25%"><select name="tbname" onchange="if(this.options[this.selectedIndex].value!=0){self.location.href='ListAllInfo.php?<?=str_replace('&tbname=','&',$search1)?>&tbname='+this.options[this.selectedIndex].value;}">
                <?=$changetbs?>
              </select> </td>
            <td width="75%"> <div align="right"><font color="#ffffff"><a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&sear=1&showspecial=8<?=$ecms_hashur['ehref']?>">我的信息</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&sear=1&showspecial=5<?=$ecms_hashur['ehref']?>">簽發信息</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&sear=1&showspecial=7<?=$ecms_hashur['ehref']?>">投稿信息</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&showretitle=1&srt=1<?=$ecms_hashur['ehref']?>" title="查詢重複標題，並保留一條信息">查詢重複標題A</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&showretitle=1&srt=0<?=$ecms_hashur['ehref']?>" title="查詢重複標題的信息(不保留信息)">查詢重複標題B</a> 
                | <a href="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>" target=_blank>更新數據</a> | <a href="../../" target=_blank>預覽首頁</a></font></div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td width="3%"><div align="center"></div></td>
      <td width="6%" height="25"><div align="center">ID</div></td>
      <td width="36%" height="25"><div align="center">標題</div></td>
      <td width="12%" height="25"><div align="center">發佈者</div></td>
      <td width="16%" height="25"> <div align="center">發佈時間</div></td>
	  <td width="7%" height="25"><div align="center">點擊</div></td>
      <td width="6%"><div align="center">評論</div></td>
      <td width="14%" height="25"> <div align="center">操作</div></td>
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
		$oldtitle=$r[title];
		$r[title]=stripSlashes(sub($r[title],0,36,false));
		//時間
		$truetime=date("Y-m-d H:i:s",$r[truetime]);
		$lastdotime=date("Y-m-d H:i:s",$r[lastdotime]);
		//審核
		if(empty($indexchecked))
		{
			$checked=" title='未審核' style='background:#99C4E3'";
			$titleurl="ShowInfo.php?classid=$r[classid]&id=$r[id]".$addecmscheck.$ecms_hashur['ehref'];
		}
		else
		{
			$checked="";
			$titleurl=sys_ReturnBqTitleLink($r);
		}
		//會員投稿
		if($r[ismember])
		{
			$r[username]="<a href='member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target='_blank'><font color=red>".$r[username]."</font></a>";
		}
		//取得類別名
		$do=$r[classid];
		$dob=$class_r[$r[classid]][bclassid];
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
		$myid="<a href='ecmschtml.php?enews=ReSingleInfo&classid=$r[classid]&id[]=".$r[id].$ecms_hashur['href']."'>".$r['id']."</a>";
		if(empty($r[havehtml]))
		{
			$myid="<a href='ecmschtml.php?enews=ReSingleInfo&classid=$r[classid]&id[]=".$r[id].$ecms_hashur['href']."' title='未生成'><b>".$r[id]."</b></a>";
		}
	?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td><div align="center"> 
          <input name="id[]" type="checkbox" id="id[]" value="<?=$r[id]?>"<?=$checked?>>
		  <input name="infoid[]" type="hidden" value="<?=$r['id']?>">
        </div></td>
      <td height="42"> <div align="center"> 
          <?=$myid?>
        </div></td>
      <td height="25"> <div align="left"> 
          <?=$st?>
          <?=$showtitlepic?>
          <a href='<?=$titleurl?>' target=_blank title="<?=$oldtitle?>">
          <?=$r[title]?>
          </a> 
          <?=$qf?>
          <br>
          <font color="#574D5C">欄目:<a href='ListNews.php?bclassid=<?=$class_r[$r[classid]][bclassid]?>&classid=<?=$r[classid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>'> 
          <font color="#574D5C">
          <?=$class_r[$dob][classname]?>
          </font> </a> > <a href='ListNews.php?bclassid=<?=$class_r[$r[classid]][bclassid]?>&classid=<?=$r[classid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>'> 
          <font color="#574D5C">
          <?=$class_r[$r[classid]][classname]?>
          </font> </a></font></div></td>
      <td height="25"> <div align="center"> 
          <?=$r[username]?>
        </div></td>
      <td height="25" title="<?php echo"增加時間：".$truetime."\r\n最後修改：".$lastdotime;?>"> <div align="center">
          <input name="newstime[]" type="text" value="<?=date("Y-m-d H:i:s",$r[newstime])?>" size="20">
        </div></td>
      <td height="25"> <div align="center"><a title="下載次數:<?=$r[totaldown]?>"> 
          <?=$r[onclick]?>
          </a></div></td>
      <td><div align="center"><a href="pl/ListPl.php?id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>" target="_blank" title="管理評論"><u><?=$r[plnum]?></u></a></div></td>
      <td height="25"> <div align="center"><a href="AddNews.php?enews=EditNews&id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>" target="_blank">修改</a> | <a href="#empirecms" onclick="window.open('info/EditInfoSimple.php?enews=EditNews&id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>','EditInfoSimple','width=600,height=360,scrollbars=yes,resizable=yes');">簡改</a> | <a href="ecmsinfo.php?enews=DelNews&id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['href']?>" onclick="return confirm('確認要刪除？');">刪除</a> 
        </div></td>
    </tr>
    <?php
	}
	?>
    <input type=hidden name=classid value=<?=$do?>>
    <input type=hidden name=bclassid value=<?=$dob?>>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="center"> 
          <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
        </div></td>
      <td height="25" colspan="7"><div align="right"> 
          <input type="submit" name="Submit3" value="刪除" onclick="document.listform.enews.value='DelNews_all';document.listform.action='ecmsinfo.php';">
		  <?php
		  if($ecmscheck)
		  {
		  ?>
		  <input type="submit" name="Submit8" value="審核" onClick="document.listform.enews.value='CheckNews_all';document.listform.action='ecmsinfo.php';">
		  <?php
		  }
		  else
		  {
		  ?>
		  <input type="submit" name="Submit9" value="取消審核" onClick="document.listform.enews.value='NoCheckNews_all';document.listform.action='ecmsinfo.php';">
          <input type="submit" name="Submit8" value="刷新" onClick="document.listform.enews.value='ReSingleInfo';document.listform.action='ecmschtml.php';">
          <input type="button" name="Submit112" value="推送" onClick="PushInfoToSp(this.form);">
		  <?php
		  }
		  ?> 
          <select name="isgood" id="isgood">
            <option value="0">不推薦</option>
			<?=$ftnr['igname']?>
          </select>
          <input type="submit" name="Submit82" value="推薦" onClick="document.listform.enews.value='GoodInfo_all';document.listform.doing.value='0';document.listform.action='ecmsinfo.php';">
          <select name="firsttitle" id="firsttitle">
            <option value="0">取消頭條</option>
			<?=$ftnr['ftname']?>
          </select>
          <input type="submit" name="Submit823" value="頭條" onClick="document.listform.enews.value='GoodInfo_all';document.listform.doing.value='1';document.listform.action='ecmsinfo.php';">
          <select name="istop" id="istop">
            <option value="0">不置頂</option>
            <option value="1">一級置頂</option>
            <option value="2">二級置頂</option>
            <option value="3">三級置頂</option>
            <option value="4">四級置頂</option>
            <option value="5">五級置頂</option>
            <option value="6">六級置頂</option>
            <option value="7">七級置頂</option>
            <option value="8">八級置頂</option>
			<option value="9">九級置頂</option>
          </select>
          <input type="submit" name="Submit7" value="置頂" onclick="document.listform.enews.value='TopNews_all';document.listform.action='ecmsinfo.php';">
		  <input type="submit" name="Submit7" value="修改時間" onclick="document.listform.enews.value='EditMoreInfoTime';document.listform.action='ecmsinfo.php';">
		  <input type="button" name="Submit1122" value="推送至專題" onClick="PushInfoToZt(this.form);">
          <span id="moveclassnav"></span> 
          <input type="submit" name="Submit5" value="移動" onclick="document.listform.enews.value='MoveNews_all';document.listform.action='ecmsinfo.php';">
          <input type="submit" name="Submit6" value="複製" onclick="document.listform.enews.value='CopyNews_all';document.listform.action='ecmsinfo.php';">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> 
        <?=$returnpage?>
      　 </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> <font color="#666666">備註：多選框藍色為未審核信息；發佈者紅色為會員投稿；信息ID粗體為未生成,點擊ID可刷新頁面.</font></td>
    </tr>
  </table>
</form>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="ShowClassNav.php?ecms=2&classid=<?=$classid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>