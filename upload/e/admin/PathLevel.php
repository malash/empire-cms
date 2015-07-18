<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
//���ҥΤ�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
db_close();
$empire=null;
//��^�ؿ��v�����G
function ReturnPathLevelResult($path){
	$testfile=$path."/test.test";
	$fp=@fopen($testfile,"wb");
	if($fp)
	{
		@fclose($fp);
		@unlink($testfile);
		return 1;
	}
	else
	{
		return 0;
	}
}
//��^����v�����G
function ReturnFileLevelResult($filename){
	return is_writable($filename);
}
//�˴��ؿ��v��
function CheckFileMod($filename,$smallfile=""){
	$succ="��";
	$error="<font color=red>��</font>";
	if(!file_exists($filename)||($smallfile&&!file_exists($smallfile)))
	{
		return $error;
	}
	if(is_dir($filename))//�ؿ�
	{
		if(!ReturnPathLevelResult($filename))
		{
			return $error;
		}
		//�l�ؿ�
		if($smallfile)
		{
			if(is_dir($smallfile))
			{
				if(!ReturnPathLevelResult($smallfile))
				{
					return $error;
				}
			}
			else//���
			{
				if(!ReturnFileLevelResult($smallfile))
				{
					return $error;
				}
			}
		}
	}
	else//���
	{
		if(!ReturnFileLevelResult($filename))
		{
			return $error;
		}
		if($smallfile)
		{
			if(!ReturnFileLevelResult($smallfile))
			{
				return $error;
			}
		}
	}
	return $succ;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�Ұ�����޲z�t��</title>

<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="">
    <tr class="header"> 
      <td height="25"> <div align="center">�ؿ��v���˴�</div></td>
    </tr>
    <tr> 
      <td height="100" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
            <tr> 
              <td height="23"><strong>���ܫH��</strong></td>
            </tr>
            <tr> 
              <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td height="25"> <li>�N�U���ؿ��v���]��0777, ���F����ؿ��~�A�O�ؿ������n���v�����Ω�l�ؿ��P���C<br>
                      </li></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          <br>
          <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
            <tr> 
              <td width="34%" height="23"> <div align="center"><strong>�ؿ����W��</strong></div></td>
              <td width="42%"> <div align="center"><strong>����</strong></div></td>
              <td width="24%"> <div align="center"><strong>�v���ˬd</strong></div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left"><font color="#FF0000"><strong>/</strong></font></div></td>
              <td> <div align="center"><font color="#FF0000">�t�ήڥؿ�(���n���Ω�l�ؿ�)</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/d</div></td>
              <td> <div align="center"><font color="#666666">����ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../d","../../d/txt");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/s</div></td>
              <td> <div align="center"><font color="#666666">�M�D�s��ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../s");?>
                </div></td>
            </tr>
			<tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/t</div></td>
              <td> <div align="center"><font color="#666666">���D�����s��ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../t");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/search</div></td>
              <td> <div align="center"><font color="#666666">�j�����</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../search","../../search/test.txt");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/index.html</div></td>
              <td> <div align="center"><font color="#666666">��������</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../index.html");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/html</div></td>
              <td> <div align="center"><font color="#666666">�q�{�i�諸HTML�s��ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../../html");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/admin/ebak/bdata</td>
              <td> <div align="center"><font color="#666666">�ƥ��ƾڦs��ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("ebak/bdata");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/admin/ebak/zip</td>
              <td> <div align="center"><font color="#666666">�ƥ��ƾ����Y�s��ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("ebak/zip");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/e/config/config.php</div></td>
              <td> <div align="center"><font color="#666666">�ƾڮw���Ѽưt�m���</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../config/config.php");?>
                </div></td>
            </tr>
            
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="left">/e/data</div></td>
              <td> <div align="center"><font color="#666666">�����t�m���s��ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../data","../data/tmp");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/install</td>
              <td> <div align="center"><font color="#666666">�w�˥ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../install");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/member/iframe/index.php</td>
              <td><div align="center"><font color="#666666">�n�����A���</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../member/iframe/index.php");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/member/login/loginjs.php</td>
              <td><div align="center"><font color="#666666">JS�n�����A���</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../member/login/loginjs.php");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/pl/more/index.php</td>
              <td> <div align="center"><font color="#666666">����JS�եΤ��</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../pl/more/index.php");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/sch/index.php</td>
              <td><div align="center"><font color="#666666">�����j�����</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../sch/index.php");?>
                </div></td>
            </tr>
			<tr bgcolor="#FFFFFF"> 
              <td height="25">/e/template</td>
              <td> <div align="center"><font color="#666666">�ʺA�������ҪO�ؿ�</font></div></td>
              <td> <div align="center"> 
                  <?=CheckFileMod("../template");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/tool/feedback/temp</td>
              <td><div align="center"><font color="#666666">�H�����X</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../tool/feedback/temp","../tool/feedback/temp/test.txt");?>
                </div></td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="25">/e/tool/gbook/index.php</td>
              <td><div align="center"><font color="#666666">�d���O</font></div></td>
              <td><div align="center"> 
                  <?=CheckFileMod("../tool/gbook/index.php");?>
                </div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr class="header"> 
      <td><div align="center"> 
          &nbsp;&nbsp; &nbsp;&nbsp; </div></td>
    </tr>
  </form>
</table>
</body>
</html>