<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
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
CheckLevel($logininid,$loginin,$classid,"repdownpath");
$url="<a href=RepDownLevel.php".$ecms_hashur['whehref'].">��q���a�}�v��</a>";
//���
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//�ƾڪ�
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable order by tid");
while($tr=$empire->fetch($tsql))
{
	$table.="<option value='".$tr[tbname]."'>".$tr[tname]."</option>";
}
$table="<select name='tbname'><option value='0'>--- ��ܼƾڪ� ---</option>".$table."</select>";
//----------�|����
$sql1=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($l_r=$empire->fetch($sql1))
{
	$ygroup.="<option value=".$l_r[groupid].">".$l_r[groupname]."</option>";
}
//----------�a�}�e��
$qz="";
$downsql=$empire->query("select urlname,urlid from {$dbtbpre}enewsdownurlqz order by urlid");
while($downr=$empire->fetch($downsql))
{
	$qz.="<option value='".$downr[urlid]."'>".$downr[urlname]."</option>";
}

db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��q���a�}�v��</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">��m�G<?=$url?></td>
  </tr>
</table>

<form name="form1" method="post" action="../ecmscom.php" target="_blank" onsubmit="return confirm('�T�{�n�ާ@�H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"> <div align="center">��q���U��/�b�u�a�}�v�� 
          <input name="enews" type="hidden" id="enews" value="RepDownLevel">
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="21%" height="25">�ާ@�ƾڪ�(*)�G</td>
      <td width="79%" height="25"> 
        <?=$table?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ާ@��ءG</td>
      <td height="25"><select name="classid" id="classid">
          <option value=0>�Ҧ����</option>
          <?=$class?>
        </select>
        <font color="#666666"> (�p��ܤj��ءA�N���Ω�Ҧ��l���)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ާ@�r�q(*)�G</td>
      <td height="25"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="32%"><input name="downpath" type="checkbox" id="downpath" value="1">
              �U���a�}(downpath)</td>
            <td width="68%"><input name="onlinepath" type="checkbox" id="onlinepath" value="1">
              �b�u�a�}(onlinepath)</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�v���ഫ�G 
        <input name="dogroup" type="checkbox" id="dogroup" value="1"></td>
      <td height="25"><div align="left"> 
          <table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
            <tr> 
              <td width="49%"><div align="center">��|����</div></td>
              <td width="51%"><div align="center">�s�|����</div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"> 
                  <select name="oldgroupid" id="oldgroupid">
                    <option value="no">���]�m</option>
                    <option value="0">�C��</option>
					<?=$ygroup?>
                  </select>
                </div></td>
              <td><div align="center"> 
                  <select name="newgroupid" id="newgroupid">
                    <option value="0">�C��</option>
					<?=$ygroup?>
                  </select>
                </div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�I���ഫ�G 
        <input name="dofen" type="checkbox" id="dofen" value="1"></td>
      <td height="25"><table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">���I��</div></td>
            <td width="51%"><div align="center">�s�I��</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldfen" type="text" id="oldfen" value="no" size="6">
              </div></td>
            <td><div align="center"> 
                <input name="newfen" type="text" id="newfen" value="0" size="6">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�e���ഫ�G 
        <input name="doqz" type="checkbox" id="doqz" value="1"></td>
      <td height="25"><table width="70%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">��e��</div></td>
            <td width="51%"><div align="center">�s�e��</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <select name="oldqz" id="oldqz">
                  <option value="no">���]�m</option>
				  <option value="0">�ūe��</option>
                  <?=$qz?>
                </select>
              </div></td>
            <td><div align="center"> 
                <select name="newqz">
				<option value="0">�ūe��</option>
                  <?=$qz?>
                </select>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�a�}�����G
        <input name="dopath" type="checkbox" id="dopath" value="1"></td>
      <td height="25"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">��U���a�}�r��</div></td>
            <td width="51%"><div align="center">�s�U���a�}�r��</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldpath" type="text" id="oldpath">
              </div></td>
            <td><div align="center"> 
                <input name="newpath" type="text" id="newpath">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25">�W�ٴ����G
        <input name="doname" type="checkbox" id="doname" value="1"></td>
      <td height="25"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="49%"><div align="center">��U���W�٦r��</div></td>
            <td width="51%"><div align="center">�s�U���W�٦r��</div></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td><div align="center"> 
                <input name="oldname" type="text" id="oldname">
              </div></td>
            <td><div align="center"> 
                <input name="newname" type="text" id="newname">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���[SQL����G</td>
      <td height="25"><input name="query" type="text" id="query" size="75"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><font color="#666666">�p�Gtitle='���D' and writer='�@��'</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25">�����G�p���I�Ƭ�no�A�h�Ҧ��H�����I�Ƴ����s�I�ơA�p�G�ﶵ�����]�m�A�h�Ҧ��H�������s���ȡC<br>
        �`�N�G<font color="#FF0000">�ϥΦ��\��A�̦n�ƥ��@�U�ƾڡA�H���U�@</font></td>
    </tr>
  </table>
</form>
</body>
</html>
