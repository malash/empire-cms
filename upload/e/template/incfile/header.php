<?php
if(!defined('InEmpireCMS'))
{
	exit();
}

//--------------- �ɭ��Ѽ� ---------------

//�|���ɭ�����a�}�e��
$memberskinurl=$public_r['newsurl'].'skin/member/images/';

//LOGO�Ϥ��a�}
$logoimgurl=$memberskinurl.'logo.jpg';

//�[��Ϥ��a�}
$addimgurl=$memberskinurl.'add.gif';
$noaddimgurl=$memberskinurl.'noadd.gif';

//�W�U��u�I����
$bgcolor_line='#4FB4DE';

//�䥦��եi�ק�CSS����

//--------------- �ɭ��Ѽ� ---------------


//�ѧO����ܷ�e���
function EcmsShowThisMemberMenu(){
	global $memberskinurl,$noaddimgurl;
	$selffile=eReturnSelfPage(0);
	if(stristr($selffile,'/member/msg'))
	{
		$menuname='menumsg';
	}
	elseif(stristr($selffile,'e/DoInfo'))
	{
		$menuname='menuinfo';
	}
	elseif(stristr($selffile,'/member/mspace'))
	{
		$menuname='menuspace';
	}
	elseif(stristr($selffile,'e/ShopSys'))
	{
		$menuname='menushop';
	}
	elseif(stristr($selffile,'e/payapi')||stristr($selffile,'/member/buygroup')||stristr($selffile,'/member/card')||stristr($selffile,'/member/buybak')||stristr($selffile,'/member/downbak'))
	{
		$menuname='menupay';
	}
	else
	{
		$menuname='menumember';
	}
	echo'<script>turnit(do'.$menuname.',"'.$menuname.'img");</script>';
	?>
	<script>
	do<?=$menuname?>.style.display="";
	document.images.<?=$menuname?>img.src="<?=$noaddimgurl?>";
	</script>
	<?php
}

//�������D
$thispagetitle=$public_diyr['pagetitle']?$public_diyr['pagetitle']:'�|������';
//�|���H��
$tmgetuserid=(int)getcvar('mluserid');	//�Τ�ID
$tmgetusername=RepPostVar(getcvar('mlusername'));	//�Τ�W
$tmgetgroupid=(int)getcvar('mlgroupid');	//�Τ��ID
$tmgetgroupname='�C��';
//�|���զW��
if($tmgetgroupid)
{
	$tmgetgroupname=$level_r[$tmgetgroupid]['groupname'];
	if(!$tmgetgroupname)
	{
		include_once(ECMS_PATH.'e/data/dbcache/MemberLevel.php');
		$tmgetgroupname=$level_r[$tmgetgroupid]['groupname'];
	}
}

//�ҫ�
$tgetmid=(int)$_GET['mid'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?=$thispagetitle?></title>
<style>
a						{ text-decoration: none; color: #002280 }
a:hover					{ text-decoration: underline }
body					{ font-size: 9pt; }
table					{ font: 9pt Tahoma, Verdana; color: #000000 }
input,select,textarea	{ font: 9pt Tahoma, Verdana; font-weight: normal; }
select					{ font: 9pt Tahoma, Verdana; font-weight: normal; }
.category				{ font: 9pt Tahoma, Verdana; color: #000000; background-color: #fcfcfc }
.singleborder			{ font-size: 0px; line-height: 1px; padding: 0px; background-color: #F8F8F8 }
.bold					{ font-weight: bold }

/*�ק�D�n���*/
.header					{ font: 9pt Tahoma, Verdana; color: #FFFFFF; font-weight: bold; background-color: #4FB4DE }
.header a				{ color: #FFFFFF }
.tableborder			{ background: #C9F1FF; border: 1px solid #4FB4DE } 

/*�����˦�*/
.epages{margin:3px 0;font:11px/12px Tahoma}
.epages *{vertical-align:middle;}
.epages a{padding:1px 4px 1px;border:1px solid #A6CBE7;margin:0 1px 0 0;text-align:center;text-decoration:none;font:normal 12px/14px verdana;}
.epages a:hover{border:#659B28 1px solid;background:#f3f8ef;text-decoration:none;color:#004c7d}
.epages input{margin-bottom:0px;border:1px solid #659B28;height:15px;font:bold 12px/15px Verdana;padding-bottom:1px;padding-left:1px;margin-right:1px;color:#659B28;}

</style>

<SCRIPT lanuage="JScript">
function DisplayImg(ss,imgname,phome)
{
	if(imgname=="menumemberimg")
	{
		img=todisplay(domenumember,phome);
		document.images.menumemberimg.src=img;
	}
	else if(imgname=="menumsgimg")
	{
		img=todisplay(domenumsg,phome);
		document.images.menumsgimg.src=img;
	}
	else if(imgname=="menuinfoimg")
	{
		img=todisplay(domenuinfo,phome);
		document.images.menuinfoimg.src=img;
	}
	else if(imgname=="menuspaceimg")
	{
		img=todisplay(domenuspace,phome);
		document.images.menuspaceimg.src=img;
	}
	else if(imgname=="menupayimg")
	{
		img=todisplay(domenupay,phome);
		document.images.menupayimg.src=img;
	}
	else if(imgname=="menushopimg")
	{
		img=todisplay(domenushop,phome);
		document.images.menushopimg.src=img;
	}
	else
	{
	}
	DisplayAllMenu(imgname);
}
function todisplay(ss,phome)
{
	if(ss.style.display=="") 
	{
  		ss.style.display="none";
		theimg="<?=$addimgurl?>";
	}
	else
	{
  		ss.style.display="";
		theimg="<?=$noaddimgurl?>";
	}
	return theimg;
}
function turnit(ss,img)
{
	DisplayImg(ss,img,0);
}
function DisplayAllMenu(imgname)
{
	if(imgname!='menumemberimg'&&domenumember.style.display=="")
	{
		domenumember.style.display="none";
		document.images.menumemberimg.src="<?=$addimgurl?>";
	}
	if(imgname!='menumsgimg'&&domenumsg.style.display=="")
	{
		domenumsg.style.display="none";
		document.images.menumsgimg.src="<?=$addimgurl?>";
	}
	if(imgname!='menuinfoimg'&&domenuinfo.style.display=="")
	{
		domenuinfo.style.display="none";
		document.images.menuinfoimg.src="<?=$addimgurl?>";
	}
	if(imgname!='menuspaceimg'&&domenuspace.style.display=="")
	{
		domenuspace.style.display="none";
		document.images.menuspaceimg.src="<?=$addimgurl?>";
	}
	if(imgname!='menupayimg'&&domenupay.style.display=="")
	{
		domenupay.style.display="none";
		document.images.menupayimg.src="<?=$addimgurl?>";
	}
	if(imgname!='menushopimg'&&domenushop.style.display=="")
	{
		domenushop.style.display="none";
		document.images.menushopimg.src="<?=$addimgurl?>";
	}
}
</SCRIPT>
</head>

<body leftmargin="0" topmargin="0">
<table width="960" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td width="42%"><img src="<?=$logoimgurl?>" width="397" height="65" border="0"></td>
    <td width="58%">
	<?php
	if($tmgetuserid)	//�w�n��
	{
	?>
	<table width="100%" border="0" align="right" cellpadding="3" cellspacing="1">
      <tr>
        <td colspan="2">�z�n�A<strong><?=$tmgetusername?></strong> &lt;<?=$tmgetgroupname?>&gt; </td>
      </tr>
      <tr>
        <td width="65%">[ <a href="<?=$public_r['newsurl']?>e/space/?userid=<?=$tmgetuserid?>">�ڪ��Ŷ�</a> | <a href="<?=$public_r['newsurl']?>e/member/msg/">��������</a> | <a href="<?=$public_r['newsurl']?>e/member/fava/">���ç�</a> | <a href="<?=$public_r['newsurl']?>e/member/doaction.php?enews=exit" onclick="return confirm('�T�{�n�h�X?');">�h�X</a> ]</td>
        <td width="35%"><div align="right"><a href="<?=$public_r['newsurl']?>"><u>��������</u></a> | <a href="<?=$public_r['newsurl']?>e/member/cp/"><u>�|������</u></a> | <a href="<?=$public_r['newsurl']?>e/member/list/"><u>�|���C��</u></a></div></td>
      </tr>
    </table>
	<?php
	}
	else	//�C��
	{
	?>
	<table width="100%" border="0" align="right" cellpadding="3" cellspacing="1">
      <tr>
        <td colspan="2">�z�n�A<strong>�C��</strong> &lt;�C��&gt;</td>
      </tr>
      <tr>
        <td width="65%">[ <a href="<?=$public_r['newsurl']?>e/member/login/">���W�n��</a> | <a href="<?=$public_r['newsurl']?>e/member/register/">���U�b��</a> ]</td>
        <td width="35%"><div align="right"><a href="<?=$public_r['newsurl']?>"><u>��������</u></a> | <a href="<?=$public_r['newsurl']?>e/member/cp/"><u>�|������</u></a> | <a href="<?=$public_r['newsurl']?>e/member/list/"><u>�|���C��</u></a></div></td>
      </tr>
    </table>
	<?php
	}
	?>
    </td>
  </tr>
</table>
<table width="100%" height="6" border="0" cellpadding="3" cellspacing="1" bgcolor="<?=$bgcolor_line?>">
  <tr>
    <td></td>
  </tr>
</table>
<table width="960" border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td>��e��m�G<?=$url?></td>
  </tr>
</table>
<table width="960" border="0" align="center" cellpadding="12" cellspacing="1" bgcolor="#C9F1FF">
  <tr>
    <td width="20%" valign="top" bgcolor="#FFFFFF">
	<?php
	if($tmgetuserid)	//�w�n��
	{
	?>
	<table width="180" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
      <tr class="header" id="domenumemberid" onMouseUp="turnit(domenumember,'menumemberimg');" style="CURSOR: hand" title="�i�}/���Y">
        <td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menumemberimg" width="20" height="9" border="0">�b��</td>
      </tr>
      <tbody id="domenumember" style="display:none">
        <tr>
          <td bgcolor="#FFFFFF"><table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/EditInfo/">�ק���</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/EditInfo/EditSafeInfo.php">�ק�w���H��</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/my/">�b�����A</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/fava/">���ç�</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/friend/">�n�ͦC��</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/memberconnect/ListBind.php">�j�w�~���n��</a></td>
              </tr>
          </table></td>
        </tr>
      </tbody>
      <tr class="header" id="domenumsgid" onMouseUp="turnit(domenumsg,'menumsgimg');" style="CURSOR: hand" title="�i�}/���Y">
        <td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menumsgimg" width="20" height="9" border="0">��������</td>
      </tr>
      <tbody id="domenumsg" style="display:none">
        <tr>
          <td bgcolor="#FFFFFF"><table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/msg/AddMsg/?enews=AddMsg">�o�e����</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/msg/">�����C��</a></td>
              </tr>
          </table></td>
        </tr>
      </tbody>
      <tr class="header" id="domenuinfoid" onMouseUp="turnit(domenuinfo,'menuinfoimg');" style="CURSOR: hand" title="�i�}/���Y">
        <td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menuinfoimg" width="20" height="9" border="0">��Z</td>
      </tr>
      <tbody id="domenuinfo" style="display:none">
        <tr>
          <td bgcolor="#FFFFFF">
          <table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
			<?php
			//��X�i�޲z���ҫ�
			$tmodsql=$empire->query("select mid,qmname from {$dbtbpre}enewsmod where usemod=0 and showmod=0 and qenter<>'' order by myorder,mid");
			while($tmodr=$empire->fetch($tmodsql))
			{
				$fontb="";
				$fontb1="";
				if($tmodr['mid']==$tgetmid)
				{
					$fontb="<b>";
					$fontb1="</b>";
				}
			?>
              <tr>
                <td width="74%" height="23"><a href="<?=$public_r['newsurl']?>e/DoInfo/ListInfo.php?mid=<?=$tmodr['mid']?>"><?=$fontb?>�޲z<?=$tmodr[qmname]?><?=$fontb1?></a></td>
                <td width="26%"><div align="right"><a href="<?=$public_r['newsurl']?>e/DoInfo/ChangeClass.php?mid=<?=$tmodr['mid']?>"><?=$fontb?>�o�G<?=$fontb1?></a></div></td>
              </tr>
			<?php
			}
			?>
          </table>
          </td>
        </tr>
      </tbody>
      <tr class="header" id="domenuspaceid" onMouseUp="turnit(domenuspace,'menuspaceimg');" style="CURSOR: hand" title="�i�}/���Y">
        <td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menuspaceimg" width="20" height="9" border="0">�|���Ŷ�</td>
      </tr>
      <tbody id="domenuspace" style="display:none">
        <tr>
          <td bgcolor="#FFFFFF"><table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/space/?userid=<?=$tmgetuserid?>">�w���Ŷ�</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/mspace/SetSpace.php">�]�m�Ŷ�</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/mspace/ChangeStyle.php">��ܼҪO</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/mspace/gbook.php">�޲z�d��</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/mspace/feedback.php">�޲z���X</a></td>
              </tr>
          </table></td>
        </tr>
      </tbody>
      <tr class="header" id="domenupayid" onMouseUp="turnit(domenupay,'menupayimg');" style="CURSOR: hand" title="�i�}/���Y">
        <td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menupayimg" width="20" height="9" border="0">�]��</td>
      </tr>
      <tbody id="domenupay" style="display:none">
        <tr>
          <td bgcolor="#FFFFFF"><table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/payapi/">�b�u��I</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/buygroup/">�b�u�R��</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/card/">�I�d�R��</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/buybak/">�I�d�R�ȰO��</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/member/downbak/">�U�����O�O��</a></td>
              </tr>
          </table></td>
        </tr>
      </tbody>
      <tr class="header" id="domenushopid" onMouseUp="turnit(domenushop,'menushopimg');" style="CURSOR: hand" title="�i�}/���Y">
        <td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menushopimg" width="20" height="9" border="0">�ӫ�</td>
      </tr>
      <tbody id="domenushop" style="display:none">
        <tr>
          <td bgcolor="#FFFFFF"><table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/ShopSys/ListDd/">�ڪ��q��</a></td>
              </tr>
              <tr>
                <td height="23"><a href="#ecms" onclick="window.open('<?=$public_r['newsurl']?>e/ShopSys/buycar/','','width=680,height=500,scrollbars=yes,resizable=yes');">�ڪ��ʪ���</a></td>
              </tr>
              <tr>
                <td height="23"><a href="<?=$public_r['newsurl']?>e/ShopSys/address/ListAddress.php">�޲z�t�e�a�}</a></td>
              </tr>
          </table></td>
        </tr>
      </tbody>
      <tr class="header">
        <td height="25">&nbsp;&nbsp;<img src="<?=$noaddimgurl?>" width="20" height="9" border="0"><a href="<?=$public_r['newsurl']?>e/member/doaction.php?enews=exit" onclick="return confirm('�T�{�n�h�X?');">�h�X</a></td>
      </tr>
    </table>
	<?php
	}
	else	//�C��
	{
	?>
	<table width="180" border="0" align="center" cellspacing="1" cellpadding="3" class="tableborder">
	<tr class="header" id="domenumemberid" onMouseUp="turnit(domenumember,'menumemberimg');" style="CURSOR: hand" title="�i�}/���Y">
		<td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menumemberimg" width="20" height="9" border="0">�b��</td>
	</tr>
	<tbody id="domenumember" style="display:none">
	<tr>
		<td bgcolor="#FFFFFF">
		<table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
			<tr>
				<td height="23"><a href="<?=$public_r['newsurl']?>e/member/login/">�|���n��</a></td>
			</tr>
			<tr>
				<td height="23"><a href="<?=$public_r['newsurl']?>e/member/register/">���U�b��</a></td>
			</tr>
		</table>
		</td>
	</tr>
	</tbody>
	<tbody id="domenumsg" style="display:none">
	</tbody>
	<tr class="header" id="domenuinfoid" onMouseUp="turnit(domenuinfo,'menuinfoimg');" style="CURSOR: hand" title="�i�}/���Y">
		<td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menuinfoimg" width="20" height="9" border="0">��Z</td>
	</tr>
	<tbody id="domenuinfo" style="display:none">
	<tr>
		<td bgcolor="#FFFFFF">
		<table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
		<?php
		//��X�i�޲z���ҫ�
		$tmodsql=$empire->query("select mid,qmname from {$dbtbpre}enewsmod where usemod=0 and showmod=0 and qenter<>'' order by myorder,mid");
		while($tmodr=$empire->fetch($tmodsql))
		{
			$fontb="";
			$fontb1="";
			if($tmodr['mid']==$tgetmid)
			{
				$fontb="<b>";
				$fontb1="</b>";
			}
		?>
		<tr>
			<td width="74%" height="23"><a href="<?=$public_r['newsurl']?>e/DoInfo/ChangeClass.php?mid=<?=$tmodr['mid']?>"><?=$fontb?>�o�G<?=$tmodr[qmname]?><?=$fontb1?></a></td>
			<td width="26%"><div align="right"></div></td>
		</tr>
		<?php
		}
		?>
		</table>
		</td>
	</tr>
	</tbody>
	<tbody id="domenuspace" style="display:none">
	</tbody>
	<tbody id="domenupay" style="display:none">
	</tbody>
	<tr class="header" id="domenushopid" onMouseUp="turnit(domenushop,'menushopimg');" style="CURSOR: hand" title="�i�}/���Y">
		<td height="25">&nbsp;&nbsp;<img src="<?=$addimgurl?>" name="menushopimg" width="20" height="9" border="0">�ӫ�</td>
	</tr>
	<tbody id="domenushop" style="display:none">
	<tr>
		<td bgcolor="#FFFFFF">
		<table width="90%" border="0" align="right" cellpadding="3" cellspacing="1">
		<tr>
			<td height="23"><a href="#ecms" onclick="window.open('<?=$public_r['newsurl']?>e/ShopSys/buycar/','','width=680,height=500,scrollbars=yes,resizable=yes');">�ڪ��ʪ���</a></td>
		</tr>
		</table>
		</td>
	</tr>
	</tbody>
	</table>
	<?php
	}
	?>
	</td>
    <td width="80%" height="420" valign="top" bgcolor="#FFFFFF">
