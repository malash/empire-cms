<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(1000);

define('InEmpireCMS',TRUE);

//�ɤJ���
require('data/fun.php');
require('../class/EmpireCMS_version.php');

//------ �Ѽƶ}�l ------

$char_r=array();
$char_r=InstallReturnDbChar();
$version="7.2,1421510410";
$dbchar=$char_r['dbchar'];
$setchar=$char_r['setchar'];
$headerchar=$char_r['headerchar'];

//------ �ѼƵ��� ------

@header('Content-Type: text/html; charset='.$headerchar);

if(file_exists("install.off"))
{
	echo"�m�Ұ�����޲z�t�Ρn�w�˵{�Ǥw��w�C�p�G�n���s�w�ˡA�ЧR��<b>/e/install/install.off</b>���I";
	exit();
}

$enews=$_GET['enews'];
if(empty($enews))
{
	$enews=$_POST['enews'];
}
//���ձĶ�
if($enews=="TestCj")
{
	echo"<title>TEST</title>";
	TestCj();
}
$ok=$_GET['ok'];
if(empty($ok))
{
	$ok=$_POST['ok'];
}
$f=$_GET['f'];
if(empty($f))
{
	$f=$_POST['f'];
}
if(empty($f))
{
	$f=1;
}
$font="f".$f;
$$font="red";
//�B�z
if($enews=="setdb"&&$ok)
{
	SetDb($_POST);
}
elseif($enews=="firstadmin"&&$ok)
{
	FirstAdmin($_POST);
}
elseif($enews=="defaultdata"&&$ok)
{
	InstallDefaultData($_GET);
}
elseif($enews=="templatedata"&&$ok)
{
	InstallTemplateData($_GET);
}
elseif($enews=="moddata"&&$ok)
{
	InstallModData($_GET);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�Ұ�����޲z�t�Φw�˵{�� - Powered by EmpireCMS</title>

<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="C9F1FF" leftmargin="0" topmargin="0">
<table width="776" height="100%" border="0" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF">
  <tr> 
    <td height="56" colspan="2" background="images/topbg.gif"> 
      <div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="80%"><div align="center"><img src="images/installsay.gif" width="500" height="50"></div></td>
            <td width="20%" valign="bottom"><font color="#FFFFFF">�̫��s: <?php echo EmpireCMS_LASTTIME;?></font></td>
          </tr>
        </table>
        
      </div></td>
  </tr>
  <tr> 
    <td width="21%" rowspan="3" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><div align="center"><a href="http://www.phome.net" target="_blank"><img src="images/logo.gif" width="170" height="72" border="0"></a></div></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <div align="left"><strong><font color="#FFFFFF">���v�H��</font></strong></div></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="34%" height="25">�n��W��</td>
          <td width="66%" height="25">�Ұ�����޲z�t��</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="25">�^��W��</td>
          <td height="25">EmpireCMS</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">�{�Ǫ���</td>
          <td height="25">Version 7.2 </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">�}�o�ζ�</td>
          <td height="25">�Ұ�n��}�o�ζ�</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">���q�W��</td>
          <td height="25">�s�{���R���ҿ��n��}�o�������q</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25">�x�����</td>
          <td height="25"><a href="http://www.PHome.Net" target="_blank">www.PHome.Net</a></td>
        </tr>
      </table>
      <br> 
	  <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25"><strong><font color="#FFFFFF">�w�˶i�{</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f1;?>">�\Ū�Τ�ϥα���</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f2;?>">�˴��B������</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f3;?>">�]�m�ؿ��v��</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f4;?>">�t�m�ƾڮw</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f5;?>">��l�ƺ޲z���㸹</font></td>
              </tr>
              <tr> 
                <td><img src="images/noadd.gif" width="15" height="15">&nbsp;<font color="<?php echo $f6;?>">�w�˧���</font></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td><div align="center"><strong><font color="#0000FF" size="3">�Q��Y�i���� - �Ұ�����޲z�t��</font></strong></div></td>
  </tr>
  <tr> 
    <td valign="top"> 
    <?php
	//�Τ����
	if($enews=="checkfj")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">�ĤG�B�G�˴��B������</font></strong></div></td>
          </tr>
          <tr> 
            <td height="350" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23"><strong>���ܫH��</strong></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="21"> <li>����r���جO������������ءC</li></td>
                        </tr>
                        <tr> 
                          <td height="21"> <li>�����GD�w���v�T�t�Υ��`�B��A���Ϥ��Y���ϻP���L�\�ण��ϥΡC</li></td>
                        </tr>
                        <tr> 
                          <td height="21"> <li>������Ķ����v�T�t�Υ��`�ϥΡA���Ķ��\��P���{�O�s���󤣯ॿ�`�ϥΡC</li></td>
                        </tr>
                        <tr> 
                          <td height="21"> <li>�I���u����Ķ��v�챵�i��Ķ��i����աC</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="25%" height="23"> <div align="center"><strong>����</strong></div></td>
                    <td width="30%"> <div align="center"><strong>�Ұ�CMS�һݰt�m</strong></div></td>
                    <td width="30%"> <div align="center"><strong>��e�A�Ⱦ�</strong></div></td>
                    <td width="15%"> <div align="center"><strong>���յ��G</strong></div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center">�ާ@�t��</div></td>
                    <td><div align="center">����</div></td>
                    <td><div align="center"> 
                        <?php echo GetUseSys();?>
                      </div></td>
                    <td><div align="center">��</div></td>
                  </tr>
					<?php
					$phpr=GetPhpVer();
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>PHP����</strong></div></td>
                    <td><div align="center"><strong>4.2.3+<br>
                        </strong></div></td>
                    <td><div align="center"> <b> 
                        <?php echo $phpr['ver'];?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?php echo $phpr['result'];?>
                      </div></td>
                  </tr>
					<?php
  					$mysqlr=CanMysql();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>MYSQL���</strong></div></td>
                    <td><div align="center"><strong>���</strong></div></td>
                    <td><div align="center"> <b> 
                        <?php echo $mysqlr['can'];?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?php echo $mysqlr['result'];?>
                      </div></td>
                  </tr>
					<?php
 					$phpsafer=GetPhpSafemod();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center"><strong>PHP�B���w���Ҧ�</strong></div></td>
                    <td><div align="center"><strong>�_</strong></div></td>
                    <td><div align="center"> <b> 
                        <?php echo $phpsafer['word'];?>
                        </b> </div></td>
                    <td><div align="center"> 
                        <?php echo $phpsafer['result'];?>
                      </div></td>
                  </tr>
					<?php
  					$gdr=GetGd();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><div align="center">���GD�w</div></td>
                    <td><div align="center">����</div></td>
                    <td><div align="center"> 
                        <?php echo $gdr['can'];?>
                      </div></td>
                    <td><div align="center"> 
                        <?php echo $gdr['result'];?>
                      </div></td>
                  </tr>
					<?php
  					$cjr=GetCj();
  					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="24"> <div align="center"><a title="���ձĶ�" href="#empirecms" onclick="window.open('index.php?enews=TestCj','','width=200,height=80');"><u>����Ķ�</u></a></div></td>
                    <td><div align="center">����</div></td>
                    <td><div align="center"> 
                        <?php echo $cjr['word'];?>
                      </div></td>
                    <td><div align="center"> 
                        <?php echo $cjr['result'];?>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit523" value="�W�@�B" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="�U�@�B" onclick="self.location.href='index.php?enews=path&f=3';">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//�]�m�ؿ��v��
	elseif($enews=="path")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">�ĤT�B�G�]�m�ؿ��v��</font></strong></div></td>
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
                          <td height="25"><li><font color="#FF0000">�p�G�z���A�Ⱦ��ϥ� 
                              Windows �ާ@�t�ΡA�i���L�o�@�B�C</font></li></td>
                        </tr>
                        <tr> 
                          <td height="25"> <li>�N�U���ؿ��v���]��0777, ���F����ؿ��~�A�O�ؿ������n���v�����Ω�l�ؿ��P���C 
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
                    <td> <div align="center"> <?php echo CheckFileMod("../../");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/d</div></td>
                    <td> <div align="center"><font color="#666666">����ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../d","../../d/txt");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/s</div></td>
                    <td> <div align="center"><font color="#666666">�M�D�s��ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../s");?> 
                      </div></td>
                  </tr>
				  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/t</div></td>
                    <td> <div align="center"><font color="#666666">���D�����s��ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../t");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/search</div></td>
                    <td> <div align="center"><font color="#666666">�j�����</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../search","../../search/test.txt");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/index.html</div></td>
                    <td> <div align="center"><font color="#666666">��������</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../index.html");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/html</div></td>
                    <td> <div align="center"><font color="#666666">�q�{�i�諸HTML�s��ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../../html");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/admin/ebak/bdata</td>
                    <td> <div align="center"><font color="#666666">�ƥ��ƾڦs��ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../admin/ebak/bdata");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/admin/ebak/zip</td>
                    <td> <div align="center"><font color="#666666">�ƥ��ƾ����Y�s��ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../admin/ebak/zip");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/e/config/config.php</div></td>
                    <td> <div align="center"><font color="#666666">�ƾڮw���Ѽưt�m���</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../config/config.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"> <div align="left">/e/data</div></td>
                    <td> <div align="center"><font color="#666666">�����t�m���s��ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../data","../data/tmp");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/install</td>
                    <td> <div align="center"><font color="#666666">�w�˥ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../install");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/member/iframe/index.php</td>
                    <td><div align="center"><font color="#666666">�n�����A���</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../member/iframe/index.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/member/login/loginjs.php</td>
                    <td><div align="center"><font color="#666666">JS�n�����A���</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../member/login/loginjs.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/pl/more/index.php</td>
                    <td> <div align="center"><font color="#666666">����JS�եΤ��</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../pl/more/index.php");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/sch/index.php</td>
                    <td><div align="center"><font color="#666666">�����j�����</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../sch/index.php");?> 
                      </div></td>
                  </tr>
				  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/template</td>
                    <td> <div align="center"><font color="#666666">�ʺA�������ҪO�ؿ�</font></div></td>
                    <td> <div align="center"> <?php echo CheckFileMod("../template");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/tool/feedback/temp</td>
                    <td><div align="center"><font color="#666666">�H�����X</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../tool/feedback/temp","../tool/feedback/temp/test.txt");?> 
                      </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">/e/tool/gbook/index.php</td>
                    <td><div align="center"><font color="#666666">�d���O</font></div></td>
                    <td><div align="center"> <?php echo CheckFileMod("../tool/gbook/index.php");?> 
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <script>
			  function CheckNext()
			  {
			  var ok;
			  //ok=confirm("�T�{�����Ω�l�ؿ�?");
			  ok=true;
			  if(ok)
			  {
			  self.location.href='index.php?enews=setdb&f=4';
			  }
			  }
			  </script>
                <input type="button" name="Submit523" value="�W�@�B" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="button" name="Submit72" value="��s�v�����A" onclick="javascript:self.location.href='index.php?enews=path&f=3';">
                &nbsp;&nbsp; 
                <input type="button" name="Submit623" value="�U�@�B" onclick="javascript:CheckNext();">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//�]�m�t�m�ƾڮw
	elseif($enews=="setdb")
	{
		$mycookievarpre=strtolower(InstallMakePassword(5));
		$myadmincookievarpre=strtolower(InstallMakePassword(5));
	?>
      <script>
		  function CheckSubmit()
		  {
		  	var ok;
			ok=confirm("�T�{�n�i�J�U�@�B?");
			if(ok)
			{
		  		document.form1.Submit6223.disabled=true;
				return true;
			}
			return false;
		  }
		  </script> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?enews=setdb&ok=1&f=5" onsubmit="document.form1.Submit6223.disabled=true;">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">�ĥ|�B�G�t�m�ƾڮw</font></strong></div></td>
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
                          <td height="23"> <li>�Цb�U����g�z���ƾڮw�㸹�H��, �q�`���p�U���ݭn�ק���ﶵ���e�C</li></td>
                        </tr>
                        <tr> 
                          <td height="23"> <li>�a*�������ର�šC</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td width="21%" height="23"> <div align="center"><strong>�]�m�ﶵ</strong></div></td>
                    <td width="36%"><div align="center"><strong>��e��</strong></div></td>
                    <td width="43%"><div align="center"><strong>����</strong></div></td>
                  </tr>
					<?php
					$getmysqlver=@mysql_get_server_info();
					$selectmysqlver=$getmysqlver;
					if(empty($selectmysqlver))
					{
						$selectmysqlver='5.0';
					}
					?>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">MYSQL����:</td>
                    <td><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <tr> 
                          <td height="22"><input type="radio" name="mydbver" value="auto" checked>
                            �۰��ѧO</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.0">
                            MYSQL 4.0.*/3.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="4.1">
                            MYSQL 4.1.*</td>
                        </tr>
                        <tr> 
                          <td height="22"> <input type="radio" name="mydbver" value="5.0">
                            MYSQL 5.*�ΥH�W</td>
                        </tr>
                      </table></td>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                          <td>�t���˴��쪺������: <b> <u> 
                            <?php echo $getmysqlver?$getmysqlver:'';?>
                            </u> </b></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td width="21%" height="25"><font color="#009900">�ƾڮw�A�Ⱦ�(*):</font></td>
                    <td width="36%"> <input name="mydbhost" type="text" id="mydbhost" value="localhost" size="30"></td>
                    <td width="43%"><font color="#666666">�ƾڮw�A�Ⱦ��a�}, �@�묰 localhost</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">�ƾڮw�A�Ⱦ��ݤf:</font></td>
                    <td> <input name="mydbport" type="text" id="mydbport" size="30"> 
                    </td>
                    <td><font color="#666666">MYSQL�ݤf,�Ŭ��q�{�ݤf, �@�묰��</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">�ƾڮw�Τ�W:</td>
                    <td> <input name="mydbusername" type="text" id="mydbusername" value="username" size="30"></td>
                    <td><font color="#666666">MYSQL�ƾڮw�챵�㸹</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">�ƾڮw�K�X:</td>
                    <td> <input name="mydbpassword" type="password" id="mydbpassword" size="30"></td>
                    <td><font color="#666666">MYSQL�ƾڮw�챵�K�X</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">�ƾڮw�W(*):</td>
                    <td> <input name="mydbname" type="text" id="mydbname" value="empirecms" size="30"> 
                    </td>
                    <td><font color="#666666">�ƾڮw�W��</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">��W�e��(*):</font></td>
                    <td><input name="mydbtbpre" type="text" id="mydbtbpre" value="phome_" size="30"></td>
                    <td><font color="#666666">�P�@�ƾڮw�w�˦h��CMS�ɥi�����q�{�A����Ʀr�}�Y</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25"><font color="#009900">COOKIE�e��(*):</font></td>
                    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <td>�e�x�G
                            <input name="mycookievarpre" type="text" id="mycookievarpre" value="<?php echo $mycookievarpre;?>" size="22"></td>
                        </tr>
                        <tr>
                          <td>��x�G
                            <input name="myadmincookievarpre" type="text" id="myadmincookievarpre" value="<?php echo $myadmincookievarpre;?>" size="22"></td>
                        </tr>
                      </table>
                      
                    </td>
                    <td><font color="#666666">��<strong>�^��r��</strong>�զ��A�q�{�Y�i</font></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"> 
                    <td height="25">���m��l�ƾ�:</td>
                    <td><input name="defaultdata" type="checkbox" id="defaultdata" value="1">
                      �O</td>
                    <td><font color="#666666">���ճn��ɿ��</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5223" value="�W�@�B" onclick="javascript:history.go(-1);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit6223" value="�U�@�B">
                <input name="mydbtype" type="hidden" id="mydbtype" value="mysql">
                <input name="mydbchar" type="hidden" id="mydbchar" value="<?php echo $dbchar;?>">
                <input name="mysetchar" type="hidden" id="mysetchar" value="<?php echo $setchar;?>">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//��Ϥƺ޲z��
	elseif($enews=="firstadmin")
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?enews=firstadmin&ok=1&f=6" onsubmit="document.form1.Submit62222.disabled=true">
          <input type="hidden" name="defaultdata" value="<?php echo $_GET['defaultdata'];?>">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">�Ĥ��B�G��l�ƺ޲z���㸹</font></strong></div></td>
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
                          <td height="25"> <li>�Цb�U����g�z�n�]�m���޲z���㸹�H���C</li></td>
                        </tr>
                        <tr>
                          <td height="25"> <li>�K�X����]�t�G$�B&amp;�B*�B#�B&lt;�B&gt;�B'�B&quot;�B/�B\�B%�B;�B�Ů�</li></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="D6E0EF">
                  <tr> 
                    <td height="23" colspan="3"><strong>��l�ƺ޲z���㸹</strong></td>
                  </tr>
                  <tr> 
                    <td width="21%" height="25" bgcolor="#FFFFFF">�Τ�W:</td>
                    <td width="36%" bgcolor="#FFFFFF"> <input name="username" type="text" id="username" size="30"> 
                    </td>
                    <td width="43%" bgcolor="#FFFFFF"><font color="#666666">�޲z���Τ�W</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF">�K�X:</td>
                    <td bgcolor="#FFFFFF"> <input name="password" type="password" id="password" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">�޲z���㸹�K�X</font></td>
                  </tr>
                  <tr> 
                    <td height="25" bgcolor="#FFFFFF"> <p>���ƱK�X:</p></td>
                    <td bgcolor="#FFFFFF"> <input name="repassword" type="password" id="repassword" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#666666">�T�{�㸹�K�X</font></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#FFFFFF"><font color="#FF0000">�n���{�ҽX:</font></td>
                    <td bgcolor="#FFFFFF"><input name="loginauth" type="text" id="loginauth" size="30"></td>
                    <td bgcolor="#FFFFFF"><font color="#FF0000">�p�G�]�m��x�n���n��J�{�ҽX�A��w��</font></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit52223" value="�W�@�B" onclick="javascript:history.go(-3);">
                &nbsp;&nbsp; 
                <input type="submit" name="Submit62222" value="�U�@�B">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//�w�˧���
	elseif($enews=="success")
	{
		//��w�w�˵{��
		$fp=@fopen("install.off","w");
		@fclose($fp);
		$word='���߱z�I�z�w���\�w�˫Ұ�����޲z�t�ΡD';
		if($_GET['defaultdata'])
		{
			$word='���߱z�I�z�w���\�w�˫Ұ�����޲z�t�ΡD<br>���~��ާ@��l�Ƥ��m�ƾ�(�ݦw�˻����ĤT�j�B)�C';
		}
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="index.php?enews=setdb&ok=1&f=7">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">�Ĥ��B�G�w�˧���</font></strong></div></td>
          </tr>
          <tr> 
            <td height="100"> <div align="center"> 
                <table width="92%" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td bgcolor="#FFFFFF"> <div align="center"> 
                        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                          <tr> 
                            <td height="42"> <div align="center"><font color="#FF0000"> 
                                <?php echo $word;?>
                                </font></div></td>
                          </tr>
                          <tr> 
                            <td height="30"> <div align="center">(�ͱ����ܡG�а��W�R��/e/install�ؿ��A�H�קK�Q�A���w��.)</div></td>
                          </tr>
                          <tr> 
                            <td height="42"> <div align="center"> 
                                <input type="button" name="Submit82" value="�i�J��x����O" onclick="javascript:self.location.href='../admin/index.php'">
                              </div></td>
                          </tr>
                          <tr> 
                            <td height="25"> <div align="center" style="DISPLAY:none"><?=InstallSuccessShowInfo()?></div></td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> </div></td>
          </tr>
        </form>
      </table>
      <?php
	}
	//����
	else
	{
	?>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form1" method="post" action="">
          <tr class="header"> 
            <td height="25"> <div align="center"><strong><font color="#FFFFFF">�Ĥ@�B�G�Ұ�CMS�Τ�\�i��ĳ</font></strong></div></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" height="350" border="0" align="center" cellpadding="3" cellspacing="1">
                  <tr> 
                    <td><div align="center"> 
                        <IFRAME frameBorder=0 name=xy scrolling=auto src="data/xieyi.html" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr> 
            <td><div align="center"> 
                <input type="button" name="Submit5" value="�ڤ��P�N" onclick="window.close();">
				                &nbsp;&nbsp; 
				<input type="button" name="Submit6" value="�ڦP�N" onclick="javascript:self.location.href='index.php?enews=checkfj&f=2';">
              </div></td>
          </tr>
        </form>
      </table>
      <?php
		}
		?>
    </td>
  </tr>
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td><hr align="center"></td>
        </tr>
        <tr> 
          <td height="25"><div align="center"><a href="http://www.PHome.Net" target="_blank">�x�����</a>&nbsp; 
              | &nbsp;<a href="http://bbs.PHome.Net" target="_blank">����׾�</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/EmpireCMS/UserSite/" target="_blank">�����ר�</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/ecms7/?ecms=EmpireCMS" target="_blank">�t�ίS��</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/zy/template/" target="_blank">�ҪO�U��</a>&nbsp; 
              | &nbsp;<a href="http://bbs.phome.net/showthread-13-18902-0.html" target="_blank">�е{�U��</a>&nbsp; 
              | &nbsp;<a href="http://www.phome.net/service/about.html" target="_blank">����Ұ�</a></div></td>
        </tr>
        <tr> 
          <td height="36"> <div align="center">�ҿ��n��}�o�������q ���v�Ҧ�<BR>
              <font face="Arial, Helvetica, sans-serif">Copyright &copy; 2002 
              - 2015<b> <a href="http://www.PHome.net"><font color="#000000">PHome</font><font color="#FF6600">.Net</font></a></b></font></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
