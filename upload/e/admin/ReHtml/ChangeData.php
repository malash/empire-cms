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
CheckLevel($logininid,$loginin,$classid,"changedata");
//���
$fcfile="../../data/fc/ListEnews.php";
$class="<script src=../../data/fc/cmsclass.js></script>";
if(!file_exists($fcfile))
{$class=ShowClass_AddClass("",0,0,"|-",0,0);}
//��s��
$retable="";
$selecttable="";
$cleartable='';
$i=0;
$tsql=$empire->query("select tid,tbname,tname from {$dbtbpre}enewstable where intb=0 order by tid");
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
	$retable.="<input type=checkbox name=tbname[] value='$tr[tbname]' checked>$tr[tname]&nbsp;&nbsp;".$br;
	$selecttable.="<option value='".$tr[tbname]."'>".$tr[tname]."</option>";
	$cleartable.="<option value='".$tr[tid]."'>".$tr[tname]."</option>";
}
//�M�D
$ztclass="";
$ztsql=$empire->query("select ztid,ztname from {$dbtbpre}enewszt order by ztid desc");
while($ztr=$empire->fetch($ztsql))
{
	$ztclass.="<option value='".$ztr['ztid']."'>".$ztr['ztname']."</option>";
}
//��ܤ��
$todaydate=date("Y-m-d");
$todaytime=time();
$changeday="<select name=selectday onchange=\"document.reform.startday.value=this.value;document.reform.endday.value='".$todaydate."'\">
<option value='".$todaydate."'>--���--</option>
<option value='".$todaydate."'>����</option>
<option value='".ToChangeTime($todaytime,7)."'>�@�P</option>
<option value='".ToChangeTime($todaytime,30)."'>�@��</option>
<option value='".ToChangeTime($todaytime,90)."'>�T��</option>
<option value='".ToChangeTime($todaytime,180)."'>�b�~</option>
<option value='".ToChangeTime($todaytime,365)."'>�@�~</option>
</select>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��s�ƾ�</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script src="../ecmseditor/fieldfile/setday.js"></script>
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
    <td width="34%" height="25">��m�G<a href="ChangeData.php<?=$ecms_hashur['whehref']?>">�ƾڧ�s</a></td>
    <td width="66%"><table width="420" border="0" align="right" cellpadding="0" cellspacing="0">
        <tr> 
          <td> <div align="center">[<a href="#ReAllHtml">�`���s</a>]</div></td>
          <td> <div align="center">[<a href="#ReMoreListHtml">�h��ب�s</a>]</div></td>
          <td> <div align="center">[<a href="#ReIfInfoHtml">�������s���e��</a>]</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="6">
  <tr id=ReAllHtml> 
    <td width="69%" valign="top"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr class="header"> 
          <td height="25" colspan="2"> <div align="center">������s�޲z</div></td>
        </tr>
        <tr> 
          <td height="25"><div align="center"><strong>�㯸�D�n������s</strong></div></td>
          <td height="25"><div align="center"><strong>��L������s</strong></div></td>
        </tr>
        <tr> 
          <td width="50%" height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit2" value="��s����" onclick="self.location.href='../ecmschtml.php?enews=ReIndex<?=$ecms_hashur['href']?>'" title="�ͦ�����">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit22" value="��s�Ҧ��H����ح�" onclick="window.open('../ecmschtml.php?enews=ReListHtml_all&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��Ҧ���ح���">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <form action="ecmschtml.php" method="post" name="dorehtml" id="dorehtml">
					  <?=$ecms_hashur['form']?>
                        <tr> 
                          <td><div align="center"> 
                              <input type="button" name="Submit3" value="��s�Ҧ��H�����e����" onclick="var toredohtml=0;if(document.dorehtml.havehtml.checked==true){toredohtml=1;}window.open('DoRehtml.php?enews=ReNewsHtml&start=0&havehtml='+toredohtml+'&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��Ҧ����e��">
                            </div></td>
                        </tr>
                        <tr> 
                          <td height="25" valign="top"> <div align="center">������s 
                              <input name="havehtml" type="checkbox" id="havehtml" value="1" title="��w�g�ͦ������e���@�_��s">
                            </div></td>
                        </tr>
                      </form>
                    </table>
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit4" value="��s�Ҧ��H��JS�ե�" onclick="window.open('../ecmschtml.php?enews=ReAllNewsJs&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��Ҧ�JS�եΤ��">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"><div align="center"> 
                    <input type="button" name="Submit422232" value="��q��s�ʺA����" onclick="self.location.href='../ecmschtml.php?enews=ReDtPage<?=$ecms_hashur['href']?>';" title="�ͦ�����O�ҪO�B�n�����A�B�n��JS���ʺA����">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td height="48"><div align="center">
                  <input type="button" name="Submit222" value="��s�Ҧ����D������" onclick="window.open('../ecmschtml.php?enews=ReTtListHtml_all&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��Ҧ����D��������">
                </div></td>
              </tr>
            </table></td>
          <td width="50%" valign="top" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'">
                <td height="48"><div align="center">
                  <input type="button" name="Submit2222" value="��s�Ҧ��M�D��" onClick="window.open('../ecmschtml.php?enews=ReZtListHtml_all&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��Ҧ��M�D����">
                </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit422" value="��q��s�H�����" onclick="window.open('../ecmschtml.php?enews=ReSpAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��H�����">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit422" value="��q��s�벼JS" onclick="window.open('../tool/ListVote.php?enews=ReVoteJs_all&from=../ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��벼����JS���">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <input type="button" name="Submit4222" value="��q��s�s�iJS" onclick="window.open('../tool/ListAd.php?enews=ReAdJs_all&from=../ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>','','');" title="�ͦ��s�i����JS���">
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"> <div align="center"> 
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <form action="../ecmsmod.php" method="GET" name="dochangemodform" id="dochangemodform">
					  <?=$ecms_hashur['form']?>
                        <input type=hidden name=enews value="ChangeAllModForm">
                        <tr> 
                          <td><div align="center"> 
                              <input type="submit" name="Submit3" value="��q��s�ҫ����" title="�ͦ��o�G���Z���(�@��O�����h�a�ɨϥ�)">
                            </div></td>
                        </tr>
                        <tr> 
                          <td height="25"> <div align="center">��s��ؾɯ� 
                              <input name="ChangeClass" type="checkbox" id="ChangeClass" value="1" title="��s��Z�ɿ�ܪ����">
                            </div></td>
                        </tr>
                      </form>
                    </table>
                  </div></td>
              </tr>
              <tr onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
                <td height="48"><div align="center"> 
                    <input type="button" name="Submit4222322" value="��q��s���X���" onclick="self.location.href='../tool/FeedbackClass.php?enews=ReMoreFeedbackClassFile<?=$ecms_hashur['href']?>';" title="�ͦ��۩w�q���X�����(�@��O�����h�a�ɨϥ�)">
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <td width="31%" valign="top"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr> 
          <td height="25" class="header"> <div align="center">��s�w�s�ƾ�</div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../enews.php?enews=ChangeEnewsData<?=$ecms_hashur['href']?>" title="��s�t�Ϊ��w�s(�@��O�����h�a�ɨϥ�)">��s�ƾڮw�w�s</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReClassPath<?=$ecms_hashur['href']?>" title="���s�إ���إؿ�(�@��O�����h�a�ɨϥ�)">��_��إؿ�</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmsclass.php?enews=DelFcListClass<?=$ecms_hashur['href']?>" title="���s��s�u�H���޲z�v���U����ئC��Ρu��غ޲z�v���U���޲z��ح����C(�@��O�����h�a�ɨϥ�)">�R����ؽw�s���</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmsclass.php?enews=ChangeSonclass<?=$ecms_hashur['href']?>" title="�@�����Ω�ק���ة��ݤ���ث�ϥΦ��\��C">��s������Y</a></div></td>
        </tr>
        <tr>
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"><div align="center"><a href="../ecmschtml.php?enews=UpdateClassInfosAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" title="���s�έp��ؤU�H���ƶq�A�@�����Ω��q�R���H����ϥΦ��\��C" target="_blank">��s��ثH����</a></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmscom.php?enews=ClearTmpFileData<?=$ecms_hashur['href']?>" onclick="return confirm('�M���e�нT�{�Τ�S�����b�Ķ��B��q��s�����P���{�o�G�A�T�{?');" title="�M���{�ɩM�w�s���A�i�M�Ų��ͪ��{�ɤ��A�٦��N�O��s�ʺA�����ҪO�ɨϥΡA�Ω��ɧ󴫼ҪO">�M���{�ɤ��M�ƾ�</a></div></td>
        </tr>
      </table>
      <br>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <tr> 
          <td height="25" class="header"> <div align="center">�۩w�q������s</div></td>
        </tr>
        <tr> 
          <td height="30" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReUserpageAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" target="_blank" title="�ͦ��Ҧ��۩w�q����">��s�Ҧ��۩w�q����</a></div></td>
        </tr>
        <tr> 
          <td height="30" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReUserlistAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" target="_blank" title="�ͦ��Ҧ��۩w�q�C��">��s�Ҧ��۩w�q�C��</a></div></td>
        </tr>
        <tr> 
          <td height="30" bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#C3EFFF'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
            <div align="center"><a href="../ecmschtml.php?enews=ReUserjsAll&from=ReHtml/ChangeData.php<?=urlencode($ecms_hashur['whehref'])?><?=$ecms_hashur['href']?>" target="_blank" title="�ͦ��Ҧ��۩w�qJS">��s�Ҧ��۩w�qJS</a></div></td>
        </tr>
      </table> </td>
  </tr>
  <tr id=ReMoreListHtml> 
    <td width="69%" valign="top"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form2" method="post" action="../ecmschtml.php">
		<?=$ecms_hashur['form']?>
          <tr class="header"> 
            <td height="25"> <div align="center"><strong>��s�h��ح��� </strong></div></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="3">
                  <tr> 
                    <td><div align="center"> 
                        <select name="classid[]" size="12" multiple id="classid[]" style="width:310">
                          <?=$class?>
                        </select>
                      </div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"> 
                        <input type="submit" name="Submit8" value="�}�l��s">
                        <strong> 
                        <input name="enews" type="hidden" id="enews3" value="GoReListHtmlMore">
                        <input name="gore" type="hidden" id="enews4" value="0">
                        <input name="from" type="hidden" id="gore" value="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">
                        </strong></div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"><font color="#666666">�h�ӥ�ctrl/shift���</font></div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </form>
      </table></td>
    <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
        <form name="form2" method="post" action="../ecmschtml.php">
		<?=$ecms_hashur['form']?>
          <tr class="header"> 
            <td height="25"> <div align="center"><strong>��s�h�M�D���� </strong></div></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="3">
                  <tr> 
                    <td><div align="center"> 
                        <select name="classid[]" size="12" multiple id="select2" style="width:250">
                          <?=$ztclass?>
                        </select>
                      </div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"> 
                        <input name="ecms" type="checkbox" id="ecms" value="1" checked>
                        �t�l����
                        <input type="submit" name="Submit82" value="�}�l��s">
                        <strong> 
                        <input name="enews" type="hidden" id="enews5" value="GoReListHtmlMore">
                        <input name="gore" type="hidden" id="gore" value="1">
                        <input name="from" type="hidden" id="from" value="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">
                        </strong></div></td>
                  </tr>
                  <tr> 
                    <td><div align="center"><font color="#666666">�h�ӥ�ctrl/shift���</font></div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </form>
      </table></td>
  </tr>
</table>
<form action="DoRehtml.php" method="get" name="reform" target="_blank" onsubmit="return confirm('�T�{�n��s?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id=ReIfInfoHtml>
  <?=$ecms_hashur['form']?>
    <input name="from" type="hidden" id="from" value="ReHtml/ChangeData.php<?=$ecms_hashur['whehref']?>">
    <tr class="header"> 
      <td height="25"> <div align="center">�������s�H�����e����</div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <div align="center"> 
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
            <tr> 
              <td height="25">��s�ƾڪ�G
                <input name=chkall type=checkbox onClick=CheckAll(this.form) value=on checked>
                <font color="#666666">����</font></td>
              <td height="25">
                <?=$retable?>
              </td>
            </tr>
            <tr> 
              <td height="25">��s���</td>
              <td height="25"><select name="classid" id="classid">
                  <option value="0">�Ҧ����</option>
                  <?=$class?>
                </select>
                <font color="#666666"> (�p��ܤ���ءA�N��s�Ҧ��l���)</font></td>
            </tr>
            <tr> 
              <td width="23%" height="25"> <input name="retype" type="radio" value="0" checked>
                ���ɶ���s�G</td>
              <td width="77%" height="25">�q 
                <input name="startday" type="text" size="12" onclick="setday(this)">
                �� 
                <input name="endday" type="text" size="12" onclick="setday(this)">
                �������ƾ� 
                <?=$changeday?>
                <font color="#666666"> (����N��s�Ҧ�����)</font></td>
            </tr>
            <tr> 
              <td height="25"> <input name="retype" type="radio" value="1">
                ��ID��s�G</td>
              <td height="25">�q 
                <input name="startid" type="text" id="startid" value="0" size="6">
                �� 
                <input name="endid" type="text" id="endid" value="0" size="6">
                �������ƾ� <font color="#666666">(��ӭȬ�0�N��s�Ҧ�����)</font></td>
            </tr>
            <tr>
              <td height="25">������s�G</td>
              <td height="25"><input name="havehtml" type="checkbox" id="havehtml" value="1">
                �O<font color="#666666"> (����ܱN����s�w�ͦ��L���H��)</font></td>
            </tr>
            <tr> 
              <td height="25">&nbsp;</td>
              <td height="25"><input type="submit" name="Submit6" value="�}�l��s"> 
                <input type="reset" name="Submit7" value="���m"> <input name="enews" type="hidden" id="enews" value="ReNewsHtml"> 
              </td>
            </tr>
          </table>
        </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br>
</p>
</body>
</html>
<?php
db_close();
$empire=null;
?>
