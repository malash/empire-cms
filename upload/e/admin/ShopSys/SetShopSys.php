<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("class/hShopSysFun.php");
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
CheckLevel($logininid,$loginin,$classid,"public");
$r=$empire->fetch1("select * from {$dbtbpre}enewsshop_set limit 1");
//��s��
$changetable='';
$i=0;
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	$i++;
	if($i%4==0)
	{
		$br="<br>";
	}
	else
	{
		$br="";
	}
	$checked='';
	if(stristr($r['shoptbs'],','.$tr[tbname].','))
	{
		$checked=' checked';
	}
	$changetable.="<input type=checkbox name=tbname[] value='$tr[tbname]'".$checked.">$tr[tname]&nbsp;&nbsp;".$br;
}
//�v��
$shopddgroup='';
$mgsql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($mgr=$empire->fetch($mgsql))
{
	if($r[shopddgroupid]==$mgr[groupid])
	{
		$shopddgroup_select=' selected';
	}
	else
	{
		$shopddgroup_select='';
	}
	$shopddgroup.="<option value=".$mgr[groupid].$shopddgroup_select.">".$mgr[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ӫ��ѼƳ]�m</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td><p>��m�G�ӫ��ѼƳ]�m</p>
      </td>
  </tr>
</table>
<form name="plset" method="post" action="ecmsshop.php">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2">�ӫ��ѼƳ]�m 
        <input name=enews type=hidden value=SetShopSys></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	  <td height="25">���w�ϥΰӫ��\�઺�ƾڪ�</td>
	  <td width="81%"><?=$changetable?></td>
    </tr>
	<tr bgcolor="#FFFFFF">
	  <td height="25">�ʶR�y�{</td>
	  <td><select name="buystep" size="1" id="buystep">
	    <option value="0"<?=$r['buystep']==0?' selected':''?>>�ʪ��� &gt; �pô�覡+�t�e�覡+��I�覡 &gt; �T�{�q�� &gt; ����q��</option>
		<option value="1"<?=$r['buystep']==1?' selected':''?>>�ʪ��� &gt; �pô�覡+�t�e�覡+��I�覡 &gt; ����q��</option>
		<option value="2"<?=$r['buystep']==2?' selected':''?>>�pô�覡+�t�e�覡+��I�覡 &gt; ����q��</option>
	    </select>	  </td>
    </tr>
	<tr bgcolor="#FFFFFF">
	  <td height="25">&nbsp;</td>
	  <td><input name="shoppsmust" type="checkbox" id="shoppsmust" value="1"<?=$r['shoppsmust']==1?' checked':''?>>
      ��ܰt�e�覡
      <input name="shoppayfsmust" type="checkbox" id="shoppayfsmust" value="1"<?=$r['shoppayfsmust']==1?' checked':''?>>
      ��ܤ�I�覡 <font color="#666666">(����q��ɤ���ܥB���D���ﶵ)</font></td>
    </tr>
	<tr bgcolor="#FFFFFF">
          <td height="25">����q���v��</td>
          <td><select name="shopddgroupid" id="shopddgroupid">
              <option value="0"<?=$r['shopddgroupid']==0?' selected':''?>>�C��</option>
			  <option value="1"<?=$r['shopddgroupid']==1?' selected':''?>>�|���~�ണ��q��</option>
            </select></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">�ʪ����̤j�ӫ~��</td>
          <td><input name="buycarnum" type="text" id="buycarnum" value="<?=$r[buycarnum]?>">
            <font color="#666666">(0�������A��1���ʪ����|�ĥδ�����ӫ~�覡)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">��ӫ~�̤j�ʶR��</td>
          <td><input name="singlenum" type="text" id="singlenum" value="<?=$r[singlenum]?>">
            <font color="#666666">(0�������A����q��̳�Ӱӫ~�̤j�ʶR�ƶq)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">���h�֪��B�K�B�O</td>
          <td><input name="freepstotal" type="text" id="freepstotal" value="<?=$r[freepstotal]?>">
            ��
          <font color="#666666">(0���L�K�B�O)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">�ʪ���������[�ݩ�</td>
          <td><input type="radio" name="haveatt" value="1"<?=$r['haveatt']==1?' checked':''?>>
�}��
  <input type="radio" name="haveatt" value="0"<?=$r['haveatt']==0?' checked':''?>>
����<font color="#666666">�]�[�J�ӫ~�i�Ρuaddatt�v�Ʋ��ܶq�ǻ��A�Ҧp�G&amp;addatt[]=�Ŧ�^</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">�|���i�ۤv�����q�檺�ɶ�</td>
          <td><input name="dddeltime" type="text" id="dddeltime" value="<?=$r[dddeltime]?>">
            ���� <font color="#666666">(�W�L�]�w�ɶ��|���ۤv����R���q��A0�����i�R��)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">�w�s��ֳ]�m</td>
          <td><select name="cutnumtype" id="cutnumtype">
            <option value="0"<?=$r[cutnumtype]==0?' selected':''?>>�U�q��ɴ�֮w�s</option>
            <option value="1"<?=$r[cutnumtype]==1?' selected':''?>>�U�q��ä�I�ɴ�֮w�s</option>
          </select>          </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">���I�ڦh�֮ɶ����٭�w�s</td>
          <td><input name="cutnumtime" type="text" id="cutnumtime" value="<?=$r[cutnumtime]?>">
            ���� <font color="#666666">(0�������A�W�L�]�w�ɶ��۰ʨ����q��A���ٷ��w�s)</font></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="22%" height="25">�O�_���ѵo��</td>
          <td><input name="havefp" type="checkbox" id="havefp" value="1"<?=$r[havefp]==1?' checked':''?>>
            �O,���� 
            <input name="fpnum" type="text" id="fpnum" value="<?=$r[fpnum]?>" size="6">
            % ���o���O</td>
    </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">�o���W��<br>
          <br>
          <font color="#666666">(�@��@�ӡA��p�G�줽�Ϋ~)</font></td>
          <td><textarea name="fpname" cols="38" rows="8" id="fpname"><?=ehtmlspecialchars($r[fpname])?></textarea></td>
        </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�q�楲��</td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="truename"<?=stristr($r['ddmust'],',truename,')?' checked':''?>>
            �m�W</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="oicq"<?=stristr($r['ddmust'],',oicq,')?' checked':''?>>
            QQ</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="msn"<?=stristr($r['ddmust'],',msn,')?' checked':''?>>
            MSN</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="email"<?=stristr($r['ddmust'],',email,')?' checked':''?>>
            �l�c</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="mycall"<?=stristr($r['ddmust'],',mycall,')?' checked':''?>>
            �T�w�q��</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="phone"<?=stristr($r['ddmust'],',phone,')?' checked':''?>>
            ���</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="address"<?=stristr($r['ddmust'],',address,')?' checked':''?>>
            �pô�a�}</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="zip"<?=stristr($r['ddmust'],',zip,')?' checked':''?>>
�l�s</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="signbuild"<?=stristr($r['ddmust'],',signbuild,')?' checked':''?>>
            �лx�ؿv</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="besttime"<?=stristr($r['ddmust'],',besttime,')?' checked':''?>>
            �e�f�̨ήɶ�</td>
          </tr>
        <tr>
          <td><input name="ddmustf[]" type="checkbox" id="ddmustf[]" value="bz"<?=stristr($r['ddmust'],',bz,')?' checked':''?>> 
            �Ƶ�</td>
        </tr>
      </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
</body>
</html>
