<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
//�d��SQL�A�p�G�n��ܦ۩w�q�r�q�O�o�bSQL�̼W�[�d�ߦr�q
$query="select id,classid,isurl,titleurl,isqf,havehtml,istop,isgood,firsttitle,ismember,userid,username,plnum,totaldown,onclick,newstime,truetime,lastdotime,titlepic,title from ".$infotb.$where." order by ".$doorder." limit $offset,$line";
$sql=$empire->query($query);
//��^�Y���M���˯ŧO�W��
$ftnr=ReturnFirsttitleNameList(0,0);
$ftnamer=$ftnr['ftr'];
$ignamer=$ftnr['igr'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link rel="stylesheet" href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" type="text/css">
<title>�޲z�H��</title>
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
		alert('�п�ܭn���e���H��');
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
		alert('�п�ܭn���e���H��');
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
    <td width="24%">��m�G 
      <?=$url?>
    </td>
    <td width="76%"><div align="right" class="emenubutton">
		  <span id="showaddclassnav"></span>
          <input type="button" name="Submit" value="�W�[�H��" onclick="if(document.getElementById('addclassid').value!=0){window.open('AddNews.php?<?=$ecms_hashur['ehref']?>&enews=AddNews<?=$addecmscheck?>&classid='+document.getElementById('addclassid').value,'','');}else{alert('�п�ܭn�W�[�H�������');document.getElementById('addclassid').focus();}">
		  &nbsp; 
          <input type="button" name="Submit4" value="��s����" onclick="self.location.href='ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>'">
          &nbsp; 
          <input type="button" name="Submit4" value="��s�Ҧ��H��JS" onclick="window.open('ecmschtml.php?enews=ReAllNewsJs&from=<?=$phpmyself?><?=$ecms_hashur['href']?>','','');">
        </div></td>
  </tr>
</form>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="SearchForm" id="SearchForm" method="GET" action="ListAllInfo.php">
  <?=$ecms_hashur['eform']?>
    <tr> 
      <td width="100%"> <div align="right">&nbsp;�j���G 
          <select name="showspecial" id="showspecial">
            <option value="0"<?=$showspecial==0?' selected':''?>>�����ݩ�</option>
			<option value="1"<?=$showspecial==1?' selected':''?>>�m��</option>
            <option value="2"<?=$showspecial==2?' selected':''?>>����</option>
            <option value="3"<?=$showspecial==3?' selected':''?>>�Y��</option>
			<option value="7"<?=$showspecial==7?' selected':''?>>��Z</option>
            <option value="5"<?=$showspecial==5?' selected':''?>>ñ�o</option>
			<option value="8"<?=$showspecial==8?' selected':''?>>�ڪ��H��</option>
          </select>
          <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
          <select name="show">
            <option value="0"<?=$show==0?' selected':''?>>�����r�q</option>
            <option value="1"<?=$show==1?' selected':''?>>���D</option>
            <option value="2"<?=$show==2?' selected':''?>>�o�G��</option>
			<option value="3"<?=$show==3?' selected':''?>>ID</option>
          </select>
		  <?=$stts?>
		  <span id="searchclassnav"></span>
          <select name="myorder" id="myorder">
            <option value="1"<?=$myorder==1?' selected':''?>>���H��ID</option>
            <option value="2"<?=$myorder==2?' selected':''?>>���o�G�ɶ�</option>
            <option value="3"<?=$myorder==3?' selected':''?>>���I���v</option>
            <option value="4"<?=$myorder==4?' selected':''?>>���U����</option>
            <option value="5"<?=$myorder==5?' selected':''?>>�����׼�</option>
          </select>
          <select name="orderby" id="orderby">
            <option value="0"<?=$orderby==0?' selected':''?>>���ǱƧ�</option>
            <option value="1"<?=$orderby==1?' selected':''?>>�ɧǱƧ�</option>
          </select>
          <select name="infolday" id="infolday">
            <option value="1"<?=$infolday==1?' selected':''?>>�����ɶ�</option>
            <option value="86400"<?=$infolday==86400?' selected':''?>>1 ��</option>
            <option value="172800"<?=$infolday==172800?' selected':''?>>2 ��</option>
            <option value="604800"<?=$infolday==604800?' selected':''?>>�@�P</option>
            <option value="2592000"<?=$infolday==2592000?' selected':''?>>1 �Ӥ�</option>
            <option value="7948800"<?=$infolday==7948800?' selected':''?>>3 �Ӥ�</option>
            <option value="15897600"<?=$infolday==15897600?' selected':''?>>6 
            �Ӥ�</option>
            <option value="31536000"<?=$infolday==31536000?' selected':''?>>1 
            �~</option>
          </select>
          <input type="submit" name="Submit2" value="�j��">
          <input name="tbname" type="hidden" value="<?=$tbname?>">
          <input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
          <input name="sear" type="hidden" value="1">
        </div></td>
    </tr>
  </form>
</table>
<br>
<form name="listform" method="post" action="ecmsinfo.php" onsubmit="return confirm('�T�{�n���榹�ާ@�H');">
<?=$ecms_hashur['form']?>
  <input type=hidden name=enews value=DelNews_all>
  <input name=mid type=hidden id="mid" value=<?=$mid?>>
  <input type=hidden name=doing value=0>
  <input name="ecmscheck" type="hidden" id="ecmscheck" value="<?=$ecmscheck?>">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td width="10%" height="25"<?=$indexchecked==1?' class="header"':' bgcolor="#C9F1FF"'?>><div align="center"><a href="ListAllInfo.php?tbname=<?=$tbname?><?=$ecms_hashur['ehref']?>" title="�w�o�G�H���`�ơG<?=$tbinfos?>">�w�o�G (<?=$tbinfos?>)</a></div></td>
      <td width="10%"<?=$indexchecked==0?' class="header"':' bgcolor="#C9F1FF"'?> title="�ݼf�֫H���`�ơG<?=$tbckinfos?>"><div align="center"><a href="ListAllInfo.php?tbname=<?=$tbname?>&ecmscheck=1<?=$ecms_hashur['ehref']?>">�ݼf�� (<?=$tbckinfos?>)</a></div></td>
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
            <td width="75%"> <div align="right"><font color="#ffffff"><a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&sear=1&showspecial=8<?=$ecms_hashur['ehref']?>">�ڪ��H��</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&sear=1&showspecial=5<?=$ecms_hashur['ehref']?>">ñ�o�H��</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&sear=1&showspecial=7<?=$ecms_hashur['ehref']?>">��Z�H��</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&showretitle=1&srt=1<?=$ecms_hashur['ehref']?>" title="�d�߭��Ƽ��D�A�ëO�d�@���H��">�d�߭��Ƽ��DA</a> 
                | <a href="ListAllInfo.php?tbname=<?=$tbname?><?=$addecmscheck?>&showretitle=1&srt=0<?=$ecms_hashur['ehref']?>" title="�d�߭��Ƽ��D���H��(���O�d�H��)">�d�߭��Ƽ��DB</a> 
                | <a href="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>" target=_blank>��s�ƾ�</a> | <a href="../../" target=_blank>�w������</a></font></div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td width="3%"><div align="center"></div></td>
      <td width="6%" height="25"><div align="center">ID</div></td>
      <td width="36%" height="25"><div align="center">���D</div></td>
      <td width="12%" height="25"><div align="center">�o�G��</div></td>
      <td width="16%" height="25"> <div align="center">�o�G�ɶ�</div></td>
	  <td width="7%" height="25"><div align="center">�I��</div></td>
      <td width="6%"><div align="center">����</div></td>
      <td width="14%" height="25"> <div align="center">�ާ@</div></td>
    </tr>
    <?php
	while($r=$empire->fetch($sql))
	{
		//���A
		$st='';
		if($r[istop])//�m��
		{
			$st.="<font color=red>[��".$r[istop]."]</font>";
		}
		if($r[isgood])//����
		{
			$st.="<font color=red>[".$ignamer[$r[isgood]-1]."]</font>";
		}
		if($r[firsttitle])//�Y��
		{
			$st.="<font color=red>[".$ftnamer[$r[firsttitle]-1]."]</font>";
		}
		$oldtitle=$r[title];
		$r[title]=stripSlashes(sub($r[title],0,36,false));
		//�ɶ�
		$truetime=date("Y-m-d H:i:s",$r[truetime]);
		$lastdotime=date("Y-m-d H:i:s",$r[lastdotime]);
		//�f��
		if(empty($indexchecked))
		{
			$checked=" title='���f��' style='background:#99C4E3'";
			$titleurl="ShowInfo.php?classid=$r[classid]&id=$r[id]".$addecmscheck.$ecms_hashur['ehref'];
		}
		else
		{
			$checked="";
			$titleurl=sys_ReturnBqTitleLink($r);
		}
		//�|����Z
		if($r[ismember])
		{
			$r[username]="<a href='member/AddMember.php?enews=EditMember&userid=".$r[userid].$ecms_hashur['ehref']."' target='_blank'><font color=red>".$r[username]."</font></a>";
		}
		//���o���O�W
		$do=$r[classid];
		$dob=$class_r[$r[classid]][bclassid];
		//ñ�o
		$qf="";
		if($r[isqf])
		{
			$qfr=$empire->fetch1("select checktno,tstatus from {$dbtbpre}enewswfinfo where id='$r[id]' and classid='$r[classid]' limit 1");
			if($qfr[checktno]=='100')
			{
				$qf="(<font color='red'>�w�q�L</font>)";
			}
			elseif($qfr[checktno]=='101')
			{
				$qf="(<font color='red'>��u</font>)";
			}
			elseif($qfr[checktno]=='102')
			{
				$qf="(<font color='red'>�w�_�M</font>)";
			}
			else
			{
				$qf="(<font color='red'>$qfr[tstatus]</font>)";
			}
			$qf="<a href='#ecms' onclick=\"window.open('workflow/DoWfInfo.php?classid=$r[classid]&id=$r[id]".$addecmscheck.$ecms_hashur['ehref']."','','width=600,height=520,scrollbars=yes');\">".$qf."</a>";
		}
		//���D�Ϥ�
		$showtitlepic="";
		if($r[titlepic])
		{
			$showtitlepic="<a href='".$r[titlepic]."' title='�w�����D�Ϥ�' target=_blank><img src='../data/images/showimg.gif' border=0></a>";
		}
		//���ͦ�
		$myid="<a href='ecmschtml.php?enews=ReSingleInfo&classid=$r[classid]&id[]=".$r[id].$ecms_hashur['href']."'>".$r['id']."</a>";
		if(empty($r[havehtml]))
		{
			$myid="<a href='ecmschtml.php?enews=ReSingleInfo&classid=$r[classid]&id[]=".$r[id].$ecms_hashur['href']."' title='���ͦ�'><b>".$r[id]."</b></a>";
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
          <font color="#574D5C">���:<a href='ListNews.php?bclassid=<?=$class_r[$r[classid]][bclassid]?>&classid=<?=$r[classid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>'> 
          <font color="#574D5C">
          <?=$class_r[$dob][classname]?>
          </font> </a> > <a href='ListNews.php?bclassid=<?=$class_r[$r[classid]][bclassid]?>&classid=<?=$r[classid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>'> 
          <font color="#574D5C">
          <?=$class_r[$r[classid]][classname]?>
          </font> </a></font></div></td>
      <td height="25"> <div align="center"> 
          <?=$r[username]?>
        </div></td>
      <td height="25" title="<?php echo"�W�[�ɶ��G".$truetime."\r\n�̫�ק�G".$lastdotime;?>"> <div align="center">
          <input name="newstime[]" type="text" value="<?=date("Y-m-d H:i:s",$r[newstime])?>" size="20">
        </div></td>
      <td height="25"> <div align="center"><a title="�U������:<?=$r[totaldown]?>"> 
          <?=$r[onclick]?>
          </a></div></td>
      <td><div align="center"><a href="pl/ListPl.php?id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>" target="_blank" title="�޲z����"><u><?=$r[plnum]?></u></a></div></td>
      <td height="25"> <div align="center"><a href="AddNews.php?enews=EditNews&id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>" target="_blank">�ק�</a> | <a href="#empirecms" onclick="window.open('info/EditInfoSimple.php?enews=EditNews&id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['ehref']?>','EditInfoSimple','width=600,height=360,scrollbars=yes,resizable=yes');">²��</a> | <a href="ecmsinfo.php?enews=DelNews&id=<?=$r[id]?>&classid=<?=$r[classid]?>&bclassid=<?=$class_r[$r[classid]][bclassid]?><?=$addecmscheck?><?=$ecms_hashur['href']?>" onclick="return confirm('�T�{�n�R���H');">�R��</a> 
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
          <input type="submit" name="Submit3" value="�R��" onclick="document.listform.enews.value='DelNews_all';document.listform.action='ecmsinfo.php';">
		  <?php
		  if($ecmscheck)
		  {
		  ?>
		  <input type="submit" name="Submit8" value="�f��" onClick="document.listform.enews.value='CheckNews_all';document.listform.action='ecmsinfo.php';">
		  <?php
		  }
		  else
		  {
		  ?>
		  <input type="submit" name="Submit9" value="�����f��" onClick="document.listform.enews.value='NoCheckNews_all';document.listform.action='ecmsinfo.php';">
          <input type="submit" name="Submit8" value="��s" onClick="document.listform.enews.value='ReSingleInfo';document.listform.action='ecmschtml.php';">
          <input type="button" name="Submit112" value="���e" onClick="PushInfoToSp(this.form);">
		  <?php
		  }
		  ?> 
          <select name="isgood" id="isgood">
            <option value="0">������</option>
			<?=$ftnr['igname']?>
          </select>
          <input type="submit" name="Submit82" value="����" onClick="document.listform.enews.value='GoodInfo_all';document.listform.doing.value='0';document.listform.action='ecmsinfo.php';">
          <select name="firsttitle" id="firsttitle">
            <option value="0">�����Y��</option>
			<?=$ftnr['ftname']?>
          </select>
          <input type="submit" name="Submit823" value="�Y��" onClick="document.listform.enews.value='GoodInfo_all';document.listform.doing.value='1';document.listform.action='ecmsinfo.php';">
          <select name="istop" id="istop">
            <option value="0">���m��</option>
            <option value="1">�@�Ÿm��</option>
            <option value="2">�G�Ÿm��</option>
            <option value="3">�T�Ÿm��</option>
            <option value="4">�|�Ÿm��</option>
            <option value="5">���Ÿm��</option>
            <option value="6">���Ÿm��</option>
            <option value="7">�C�Ÿm��</option>
            <option value="8">�K�Ÿm��</option>
			<option value="9">�E�Ÿm��</option>
          </select>
          <input type="submit" name="Submit7" value="�m��" onclick="document.listform.enews.value='TopNews_all';document.listform.action='ecmsinfo.php';">
		  <input type="submit" name="Submit7" value="�ק�ɶ�" onclick="document.listform.enews.value='EditMoreInfoTime';document.listform.action='ecmsinfo.php';">
		  <input type="button" name="Submit1122" value="���e�ܱM�D" onClick="PushInfoToZt(this.form);">
          <span id="moveclassnav"></span> 
          <input type="submit" name="Submit5" value="����" onclick="document.listform.enews.value='MoveNews_all';document.listform.action='ecmsinfo.php';">
          <input type="submit" name="Submit6" value="�ƻs" onclick="document.listform.enews.value='CopyNews_all';document.listform.action='ecmsinfo.php';">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> 
        <?=$returnpage?>
      �@ </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="8"> <font color="#666666">�Ƶ��G�h����Ŧ⬰���f�֫H���F�o�G�̬��⬰�|����Z�F�H��ID���鬰���ͦ�,�I��ID�i��s����.</font></td>
    </tr>
  </table>
</form>
<IFRAME frameBorder="0" id="showclassnav" name="showclassnav" scrolling="no" src="ShowClassNav.php?ecms=2&classid=<?=$classid?><?=$ecms_hashur['ehref']?>" style="HEIGHT:0;VISIBILITY:inherit;WIDTH:0;Z-INDEX:1"></IFRAME>
</body>
</html>