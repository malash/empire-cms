<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//���ҥΤ�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//�����v��
CheckLevel($logininid,$loginin,$classid,"member");
$userdate=0;
$enews=ehtmlspecialchars($_GET['enews']);
$changegroupid=(int)$_GET['changegroupid'];
$url="<a href=ListMember.php".$ecms_hashur['whehref'].">�޲z�|��</a>&nbsp;>&nbsp;�W�[�|��";
if($enews=="EditMember")
{
	$userid=(int)$_GET['userid'];
	//���o�Τ���
	$r=ReturnUserInfo($userid);
	$r['groupid']=$r['groupid']?$r['groupid']:eReturnMemberDefGroupid();
	$addr=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid='$userid' limit 1");
	$url="<a href=ListMember.php".$ecms_hashur['whehref'].">�޲z�|��</a>&nbsp;>&nbsp;�ק�|����ơG<b>".$r[username]."</b>";
	//�ɶ�
	if($r[userdate])
	{
		$userdate=$r[userdate]-time();
		if($userdate<=0)
		{
			OutTimeZGroup($userid,$r['zgroupid']);
			if($r['zgroupid'])
			{
				$r['groupid']=$r['zgroupid'];
				$r['zgroupid']=0;
			}
			$userdate=0;
		}
		else
		{
			$userdate=round($userdate/(24*3600));
		}
	}
}
if($changegroupid)
{
	$r['groupid']=$changegroupid;
}
//----------�|����
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($sql))
{
	if($r[groupid]==$level_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$group.="<option value=".$level_r[groupid].$select.">".$level_r[groupname]."</option>";
	if($r[zgroupid]==$level_r[groupid])
	{$zselect=" selected";}
	else
	{$zselect="";}
	$zgroup.="<option value=".$level_r[groupid].$zselect.">".$level_r[groupname]."</option>";
}
//����
$spacestyle='';
$spacesql=$empire->query("select styleid,stylename from {$dbtbpre}enewsspacestyle");
while($spacer=$empire->fetch($spacesql))
{
	$selected='';
	if($spacer[styleid]==$addr[spacestyleid])
	{
		$selected=' selected';
	}
	$spacestyle.="<option value='$spacer[styleid]'".$selected.">".$spacer[stylename]."</option>";
}
//���o���
$formid=GetMemberFormId($r[groupid]);
$formfile='../../data/html/memberform'.$formid.'.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ק���</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<form name="form1" method="post" action="ListMember.php" enctype="multipart/form-data">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <input type=hidden name=add[oldusername] value='<?=$r[username]?>'>
    <input type=hidden name=add[userid] value='<?=$userid?>'>
    <tr class="header"> 
      <td height="25" colspan="2">�ק��� 
        <input name="enews" type="hidden" id="enews" value="<?=$enews?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="25%" height="25">�Τ�W</td>
      <td width="75%" height="25"><input name=add[username] type=text id="add[username]" value='<?=$r[username]?>'></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�K�X</td>
      <td height="25"><input name="add[password]" type="password" id="add[password]">
        (�ק�ɡG�p���Q�ק�,�Яd��)</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�f��</td>
      <td height="25"><input name="add[checked]" type="checkbox" id="add[checked]" value="1"<?=$r[checked]==1?' checked':''?>>
        �f�ֳq�L</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">���ݷ|����<br> <br> <input type="button" name="Submit3" value="�޲z�|����" onclick="window.open('ListMemberGroup.php<?=$ecms_hashur['whehref']?>');">      </td>
      <td height="25"><select name="add[groupid]" size="6" id="add[groupid]" onchange="self.location.href='AddMember.php?<?=$ecms_hashur['ehref']?>&enews=EditMember&userid=<?=$userid?>&changegroupid='+this.options[this.selectedIndex].value;">
          <?=$group?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�l�c</td>
      <td height="25"><input name="add[email]" type="text" id="add[email]" value="<?=$r[email]?>" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�Ѿl�Ѽ�</td>
      <td height="25"><input name=add[userdate] type=text id="add[userdate]" value='<?=$userdate?>' size="6">
        �ѡA�������V�Τ��: 
        <select name="add[zgroupid]" id="add[zgroupid]">
          <option value="0">���]�m</option>
          <?=$zgroup?>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�I��</td>
      <td height="25"><input name=add[userfen] type=text id="add[userfen]" value='<?=$r[userfen]?>' size="6">
        �I</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�b��l�B</td>
      <td height="25"><input name=add[money] type=text id="add[money]" value='<?=$r[money]?>' size="6">
        �� </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�Ŷ��ϥμҪO</td>
      <td height="25"><select name="add[spacestyleid]" id="add[spacestyleid]">
          <?=$spacestyle?>
        </select> <input type="button" name="Submit32" value="�޲z�Ŷ��ҪO" onclick="window.open('ListSpaceStyle.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���U�ɶ�</td>
      <td height="25"><?=eReturnMemberRegtime($r['registertime'],"Y-m-d H:i:s")?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">���UIP</td>
      <td height="25"><?=$addr[regip]?>:<?=$addr[regipport]?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�̫�n��</td>
      <td height="25">�`�n�����ơG<?=$addr[loginnum]?>�A�ɶ��G<?=date("Y-m-d H:i:s",$addr[lasttime])?>�A�n��IP�G<?=$addr[lastip]?>:<?=$addr[lastipport]?></td>
    </tr>
    <tr bgcolor="#FFFFFF" class="header"> 
      <td height="25" colspan="2">��L�H��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="2"> 
        <?php
	  @include($formfile);
	  ?>      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�ק�"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
db_close();
$empire=null;
?>