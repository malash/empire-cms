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

$sql=$empire->query("select bqname,bqsay,funname,bq,issys,bqgs from {$dbtbpre}enewsbq where isclose=0 order by myorder desc,bqid");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�Ұ�����޲z�t�μ��һ���</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script language="javascript">
window.resizeTo(760,600);
window.focus();
</script>
</head>
<body>
  <table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr> 
      <td id='bqnav'></td>
    </tr>
  </table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
  <tr> 
    <td colspan="2" class="header">�H�����ҽեξާ@����</td>
  </tr>
  <tr> 
    <td width="50%" bgcolor="#FFFFFF"> <table width="100%" border="0">
        <tr> 
          <td width="12%" rowspan="6" bgcolor="dbeaf5"> <div align="center"><strong>��<br>
              ��<br>
              ��<br>
              ��<br>
              ��</strong></div></td>
          <td width="16%" height="20"><div align="center"><strong>0</strong></div></td>
          <td width="72%">��س̷s�H�� <font color="#666666">(���ID=���ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>1</strong></div></td>
          <td>����I���Ʀ� <font color="#666666">(���ID=���ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>2</strong></div></td>
          <td>��ر��˫H�� <font color="#666666">(���ID=���ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>9</strong></div></td>
          <td>��ص��ױƦ� <font color="#666666">(���ID=���ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>12</strong></div></td>
          <td>����Y���H�� <font color="#666666">(���ID=���ID)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>15</strong></div></td>
          <td>��ؤU���Ʀ� <font color="#666666">(���ID=���ID)</font></td>
        </tr>
      </table></td>
    <td bgcolor="#FFFFFF"> <table width="100%" border="0">
        <tr> 
          <td width="11%" rowspan="6" bgcolor="dbeaf5"> <div align="center"><strong>��<br>
              �q<br>
              �{<br>
              ��<br>
              ��<br>
              ��</strong></div></td>
          <td width="16%" height="20"><div align="center"><strong>3</strong></div></td>
          <td width="73%">�q�{��̷s�H�� <font color="#666666">(���ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>4</strong></div></td>
          <td>�q�{���I���Ʀ� <font color="#666666">(���ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>5</strong></div></td>
          <td>�q�{����˫H�� <font color="#666666">(���ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>10</strong></div></td>
          <td>�q�{����ױƦ� <font color="#666666">(���ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>13</strong></div></td>
          <td>�q�{���Y���H�� <font color="#666666">(���ID=0)</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>16</strong></div></td>
          <td>�q�{��U���Ʀ� <font color="#666666">(���ID=0)</font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <td width="12%" rowspan="6" bgcolor="dbeaf5"><div align="center"><strong>��<br>
          ��<br>
          �D<br>
          ��<br>
          ��<br>
          ��<br>
          ��</strong></div></td>
        <td width="16%" height="20"><div align="center"><strong>25</strong></div></td>
        <td width="72%">���D�����̷s�H�� <font color="#666666">(���ID=���D����ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>26</strong></div></td>
        <td>���D�����I���Ʀ� <font color="#666666">(���ID=���D����ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>27</strong></div></td>
        <td>���D�������˫H�� <font color="#666666">(���ID=���D����ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>28</strong></div></td>
        <td>���D�������ױƦ� <font color="#666666">(���ID=���D����ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>29</strong></div></td>
        <td>���D�����Y���H�� <font color="#666666">(���ID=���D����ID)</font></td>
      </tr>
      <tr>
        <td height="20"><div align="center"><strong>30</strong></div></td>
        <td>���D�����U���Ʀ� <font color="#666666">(���ID=���D����ID)</font></td>
      </tr>
    </table></td>
    <td bgcolor="#FFFFFF"> <table width="100%" border="0">
        <tr> 
          <td width="11%" rowspan="6" bgcolor="dbeaf5"> <div align="center"><strong>��<br>
              ��<br>
              ��<br>
              ��<br>
              ��<br>
              ��</strong></div></td>
          <td width="16%" height="20"><div align="center"><strong>18</strong></div></td>
          <td width="73%">�U��̷s�H�� <font color="#666666">(���ID='��W')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>19</strong></div></td>
          <td>�U���I���Ʀ�<font color="#666666"> (���ID='��W')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>20</strong></div></td>
          <td>�U����˫H�� <font color="#666666">(���ID='��W')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>21</strong></div></td>
          <td>�U����ױƦ� <font color="#666666">(���ID='��W')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>22</strong></div></td>
          <td>�U���Y���H�� <font color="#666666">(���ID='��W')</font></td>
        </tr>
        <tr> 
          <td height="20"><div align="center"><strong>23</strong></div></td>
          <td>�U��U���Ʀ� <font color="#666666">(���ID='��W')</font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <td width="12%" rowspan="6" bgcolor="dbeaf5"><div align="center"><strong>��<br>
          S<br>
          Q<br>
          L<br>
          ��<br>
          ��</strong></div></td>
        <td width="15%" height="20" rowspan="2"><div align="center"><strong>24</strong></div></td>
        <td width="73%" height="20">��sql�d�� <font color="#666666">(���ID='sql�y�y')</font></td>
      </tr>
      <tr>
        <td height="20"><font color="#666666">�ƾڪ�e��i�ΡG�u[!db.pre!]&quot;���</font></td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<br>
<?php
$bqnav="";
while($r=$empire->fetch($sql))
{
	$bqnav.="<option value='".$r['bq']."'>".$r['bqname']."(".$r['bq'].")</option>";
	$r['bqsay']=str_replace('[!--ehash--]',$ecms_hashur['ehref'],$r['bqsay']);
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="<?=$r[bq]?>">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b><?=$r[bqname]?>&nbsp;(<?=$r[bq]?>)</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td>
<input type=text name="text" size=80 value="<?=stripSlashes($r[bqgs])?>" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td>�Ѽƻ����G</td>
        </tr>
        <tr> 
          <td><?=stripSlashes($r[bqsay])?></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<?php
}
$bqnav="<select name='bq' id='bq' onchange=window.location='#'+this.options[this.selectedIndex].value><option value='' selected style='background:#99C4E3'>���Ҿɯ�</option>".$bqnav."<option value='eloop'>�F�ʼ��� (e:loop)</option><option value='eindexloop'>�����F�ʼ��� (e:indexloop)</option><option value='ShowMemberInfo'>�|���H���եΨ��</option><option value='ListMemberInfo'>�|���C��եΨ��</option><option value='spaceeloop'>�|���Ŷ��H���եΨ��</option><option value='wapeloop'>WAP�H���եΨ��</option><option value='echeckloginauth'>���ҷ|���n���P��^�n���H�����</option><option value='echeckmembergroup'>���ҷ|���X���v�����</option><option value='resizeimg'>�ͦ��Y�Ϩ��</option><option value='egetzy'>��q�r�Ũ��</option><option value='enewshowmorepic'>��ܹ϶����(������)</option><option value='emoreplayer'>��ܵ��W����JS���</option></select>";
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eloop">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>�F�ʼ���&nbsp;(e:loop)</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td width="86%"><textarea name="text" cols="80" rows="4" style="width:100%">[e:loop={���ID,��ܱ���,�ާ@����,�u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�}]
�ҪO�N�X���e
[/e:loop]</textarea></td>
        </tr>
        <tr>
          <td>�Ҥl:</td>
          <td><textarea name="textarea" cols="80" rows="9" style="width:100%">&lt;table width="100%" border="0" cellspacing="1" cellpadding="3"&gt;
[e:loop={���ID,��ܱ���,�ާ@����,�u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�}]
&lt;tr&gt;&lt;td&gt;
&lt;a href="&lt;?=$bqsr[titleurl]?&gt;" target="_blank"&gt;&lt;?=$bqr[title]?&gt;&lt;/a&gt;
(&lt;?=date('Y-m-d',$bqr[newstime])?&gt;)
&lt;/td&gt;&lt;/tr&gt;
[/e:loop]
&lt;/table&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="23"><strong>���һ���</strong></td>
        </tr>
        <tr> 
          <td height="23">�F�ʼ��ҬO�L�ݰ����ҼҪO�A�B�ҪO���e��PHP�N�X�A�]�ӧ��F���A�i�H�ϥ�php�Ҧ��B�z��ơC<font color="#666666">�ϥΥ����ҡA�ݶ}�ҼҪO����{�ǥN�X(�ѼƳ]�m)�C</font></td>
        </tr>
        <tr> 
          <td height="23"><strong>�Ѽ�</strong></td>
        </tr>
        <tr> 
          <td><table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td width="23%"> 
                    <div align="center">�Ѽ�</div></td>
                  <td>�Ѽƻ���</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">���ID</div></td>
                  <td height="25">�d�����ID�I<a onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>');"><strong><u>�o��</u></strong></a>�A�d�ݼ��D����ID�I<a onclick="window.open('../info/InfoType.php<?=$ecms_hashur['whehref']?>');"><strong><u>�o��</u></strong></a>,��eID='selfinfo'<br />
                    �h�����ID�P���D����ID�i�Ρu,�v�r���j�}�A�p�G'1,2'</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">��ܱ���</div></td>
                  <td height="25">��ܫe�X���O��</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">�ާ@����</div></td>
                  <td height="25">����ݾާ@��������</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">�u��ܦ����D�Ϥ�</div></td>
                  <td height="25">0��������A1���u��ܦ����D�Ϥ����H��</td>
                </tr>
				<tr bgcolor="#ffffff">
            		<td height="25">
            			<div align="center">���[SQL����</div>
            		</td>
            		<td height="25">���[�եα���A�p�G&quot;title='�Ұ�'&quot;</td>
        		</tr>
        		<tr bgcolor="#ffffff">
            		<td height="25">
            			<div align="center">��ܱƧ�</div>
            		</td>
            		<td height="25">�i���w���������r�q�ƧǡA�p�G&quot;id desc&quot;</td>
        		</tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td><strong>�ܶq����</strong></td>
        </tr>
        <tr>
          <td height="139">
<table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td height="25"><div align="center">�Ʋթ��ܶq</div></td>
                  <td height="25">����</td>
                </tr>
                <tr> 
                  <td width="23%" height="25" bgcolor="#ffffff"> <div align="center">$bqr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqr[�r�q�W]�G��ܦr�q�����e</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"> <div align="center">$bqsr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqsr[titleurl]�G���D�챵<br>
                    $bqsr[classname]�G��ئW��<br>
                    $bqsr[classurl]�G����챵</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"><div align="center">$bqno</div></td>
                  <td height="25" bgcolor="#ffffff">$bqno�G���եΧǸ�</td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#ffffff"><div align="center">$public_r</div></td>
                  <td height="25" bgcolor="#ffffff">$public_r[newsurl]�G�����a�}</td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr> 
          <td><strong>�`�Ψ�Ƥ���</strong></td>
        </tr>
        <tr> 
          <td>��r�I���G<strong>esub(�r�Ŧ�,�I������)</strong>�A�Ҥl�Gesub($bqr[title],30)�I�����D�e30�Ӧr��<br>
            �ɶ��榡�G<strong>date('�榡�r��',�ɶ��r�q)</strong>�A�Ҥl�Gdate('Y-m-d',$bqr[newstime])�ɶ���ܮ榡��&quot;2008-10-01&quot;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="eindexloop">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>�����F�ʼ���&nbsp;(e:indexloop)</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td width="86%"><textarea name="textarea4" cols="80" rows="4" style="width:100%">[e:indexloop={���ޤ���ID,��ܱ���,�ާ@����,���ID,�t�μҫ�ID,���[SQL����}]
�ҪO�N�X���e
[/e:indexloop]</textarea></td>
        </tr>
        <tr> 
          <td>�Ҥl:</td>
          <td><textarea name="textarea4" cols="80" rows="9" style="width:100%">&lt;table width="100%" border="0" cellspacing="1" cellpadding="3"&gt;
[e:indexloop={���ޤ���ID,��ܱ���,�ާ@����,���ID,�t�μҫ�ID,���[SQL����}]
&lt;tr&gt;&lt;td&gt;
&lt;a href="&lt;?=$bqsr[titleurl]?&gt;" target="_blank"&gt;&lt;?=$bqr[title]?&gt;&lt;/a&gt;
(&lt;?=date('Y-m-d',$bqr[newstime])?&gt;)
&lt;/td&gt;&lt;/tr&gt;
[/e:indexloop]
&lt;/table&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td height="23"><strong>���һ���</strong></td>
        </tr>
        <tr> 
          <td height="23">�����F�ʼ��ҨϥΤ�k�򥻦P�F�ʼ��ҡA�u�O�����F�ʼ��ҬO�H�H��ID�M���ID������H�����e�C<font color="#666666">�ϥΥ����ҡA�ݶ}�ҼҪO����{�ǥN�X(�ѼƳ]�m)�C</font></td>
        </tr>
        <tr> 
          <td height="23"><strong>�Ѽ�</strong></td>
        </tr>
        <tr> 
          <td><table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td width="23%"> <div align="center">�Ѽ�</div></td>
                  <td>�Ѽƻ���</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">���ޤ���ID</div></td>
                  <td height="25">�d�ݱM�DID�I<a onclick="window.open('../special/ListZt.php<?=$ecms_hashur['whehref']?>');"><strong><u>�o��</u></strong></a>,�d��TAGS��ID�I<a onclick="window.open('../tags/ListTags.php<?=$ecms_hashur['whehref']?>');"><strong><u>�o��</u></strong></a>�A�d�ݸH��ID�I<a onclick="window.open('../sp/ListSp.php<?=$ecms_hashur['whehref']?>');"><strong><u>�o��</u></strong></a>�A��e�M�DID='selfinfo'<br />
                    �h��ID�i�Ρu,�v�r���j�}�A�p�G'1,2'</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">��ܱ���</div></td>
                  <td height="25">��ܫe�X���O��</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">�ާ@����</div></td>
                  <td height="25"> 1�B�M�D�̷s <font color="#666666">(���ޤ���ID=�M�DID)</font><br>
                    2�B�M�D�̦� <font color="#666666">(���ޤ���ID=�M�DID)</font><br>
                    3�B�M�D���� <font color="#666666">(���ޤ���ID=�M�DID)</font><br>
                    4�B�M�D�l���̷s <font color="#666666">(���ޤ���ID=�M�D�l��ID)</font><br>
                    5�B�M�D�l���̦� <font color="#666666">(���ޤ���ID=�M�D�l��ID)</font><br>
                    6�B�M�D�l������ <font color="#666666">(���ޤ���ID=�M�D�l��ID)</font><br>
                    7�B�H���̷s <font color="#666666">(���ޤ���ID=�H��ID)</font><br>
8�B�H���̦� <font color="#666666">(���ޤ���ID=�H��ID)</font><br>
                    9�BTAGS�̷s <font color="#666666">(���ޤ���ID=TAGS��ID)</font><br>
                    10�BTAGS�̦� <font color="#666666">(���ޤ���ID=TAGS��ID)</font><br>
                    11�BSQL�ե� <font color="#666666">(���ޤ���ID='sql�y�y') [�ƾڪ�e��i�ΡG�u[!db.pre!]&quot;���]</font></td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">���ID</div></td>
                  <td height="25">����u�եάY�@�өΦh����ت��H��<br>
                    �h��ID�i�H�Ρu,�v���j�}�A�p�G'1,2'</td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"><div align="center">�t�μҫ�ID</div></td>
                  <td height="25">����u�եάY�@�өΦh�Өt�μҫ����H��<br>
                    �h��ID�i�H�Ρu,�v���j�}�A�p�G'1,2'<br>
                    <font color="#FF0000">���Ѽƹ�H���եεL�ġA�H���եήɽЧ⥻�ѼƳ]�m���šG''</font></td>
                </tr>
                <tr bgcolor="#ffffff"> 
                  <td height="25"> <div align="center">���[SQL����</div></td>
                  <td height="25">���[�եα���A�p�G&quot;isgood=1&quot;</td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr> 
          <td><strong>�ܶq����</strong></td>
        </tr>
        <tr> 
          <td height="139"> <table cellspacing="1" cellpadding="3" width="100%" bgcolor="#dbeaf5" border="0">
              <tbody>
                <tr> 
                  <td height="25"><div align="center">�Ʋթ��ܶq</div></td>
                  <td height="25">����</td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#ffffff"><div align="center">$indexbqr</div></td>
                  <td height="25" bgcolor="#ffffff">$indexbqr[�r�q�W]�G��ܯ��ު��r�q���e�A�p�M�D�l��ID�G$indexbqr[cid]</td>
                </tr>
                <tr> 
                  <td width="23%" height="25" bgcolor="#ffffff"> <div align="center">$bqr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqr[�r�q�W]�G��ܫH����r�q�����e�A�p���D�G$bqr[title]</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"> <div align="center">$bqsr</div></td>
                  <td height="25" bgcolor="#ffffff">$bqsr[titleurl]�G���D�챵<br>
                    $bqsr[classname]�G��ئW��<br>
                    $bqsr[classurl]�G����챵</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"><div align="center">$bqno</div></td>
                  <td height="25" bgcolor="#ffffff">$bqno�G���եΧǸ�</td>
                </tr>
                <tr> 
                  <td height="25" bgcolor="#ffffff"><div align="center">$public_r</div></td>
                  <td height="25" bgcolor="#ffffff">$public_r[newsurl]�G�����a�}</td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr> 
          <td><strong>�`�Ψ�Ƥ���</strong></td>
        </tr>
        <tr> 
          <td>��r�I���G<strong>esub(�r�Ŧ�,�I������)</strong>�A�Ҥl�Gesub($bqr[title],30)�I�����D�e30�Ӧr��<br>
            �ɶ��榡�G<strong>date('�榡�r��',�ɶ��r�q)</strong>�A�Ҥl�Gdate('Y-m-d',$bqr[newstime])�ɶ���ܮ榡��&quot;2012-10-01&quot;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ShowMemberInfo">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>�|���H���եΨ��</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td>
<input type=text name="text" size=80 value="sys_ShowMemberInfo(�Τ�ID,�d�ߦr�q)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td>�Τ�ID�G�]�m�n�եΪ��|���H�����Τ�ID�A�b�H�����e���U�եΥi�H�]�m��0�A��ܽեΫH���o�G�̪���ơC<br>
            �d�ߦr�q�G�q�{���d�ߩҦ��|���r�q�A���ѼƤ@�뤣�γ]�m�A�p�G���F�Ĳv�󰪥i�H���w�������r�q�C�p�G�uu.userid,ui.company�v(u���D��Aui���ƪ�)�C<br>
            <strong>�ϥαе{�G</strong><a href="http://bbs.phome.net/showthread-13-108558-0.html" target="_blank">http://bbs.phome.net/showthread-13-108558-0.html</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="ListMemberInfo">
  <tr>
    <td class="header"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header">
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>�|���C��եΨ��</b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td>
<input type=text name="text" size=80 value="sys_ListMemberInfo(�եα���,�ާ@����,�|����ID,�Τ�ID,�d�ߦr�q)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td>�եα��ơG�եΫe�X���O���C<br>
            �ާ@�����G0�������U�ɶ��B1�����n���Ʀ�B2��������Ʀ�B3�����|���Ŷ��H��Ʀ�<br>
            �|����ID�G���w�n�եΪ��|����ID�A���]�m�������A�h�ӷ|���եγr���j�}�A�p�G'1,2'<br>
            �Τ�ID�G���w�n�եΪ��|��ID�A���]�m�������A�h�ӥΤ�ID�γr���j�}�A�p�G'25,27'<br>
            �d�ߦr�q�G�q�{���d�ߩҦ��|���r�q�A���ѼƤ@�뤣�γ]�m�A�p�G���F�Ĳv�󰪥i�H���w�������r�q�C�p�G�uu.userid,ui.company�v(u���D��Aui���ƪ�)�C<br>
            <strong>�ϥαе{�G</strong><a href="http://bbs.phome.net/showthread-13-108558-0.html" target="_blank">http://bbs.phome.net/showthread-13-108558-0.html</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="spaceeloop">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>�|���Ŷ��H���եΨ��</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <textarea name="textarea2" cols="80" rows="11" style="width:100%">&lt;?php
$spacesql=espace_eloop(���ID,��ܱ���,�ާ@����,�u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�);
while($spacer=$empire->fetch($spacesql))
{
        $spacesr=espace_eloop_sp($spacer);
?&gt;
�ҪO�N�X���e
&lt;?
}
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td> <strong>�ϥαе{�G</strong><a href="http://bbs.phome.net/showthread-13-109152-0.html" target="_blank">http://bbs.phome.net/showthread-13-109152-0.html</a></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="wapeloop">
  <tr>
    <td class="header"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr class="header">
        <td width="14%">���ҦW�١G</td>
        <td width="86%"><b>WAP�H���եΨ��</b></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">�榡:</td>
        <td><textarea name="textarea7" cols="80" rows="11" style="width:100%">&lt;?php
$wapsql=ewap_eloop(���ID,��ܱ���,�ާ@����,�u��ܦ����D�Ϥ�,���[SQL����,��ܱƧ�);
while($wapr=$empire->fetch($wapsql))
{
        $wapsr=ewap_eloop_sp($wapr);
?&gt;
�ҪO�N�X���e
&lt;?
}
?&gt;</textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr>
        <td>����ưѼƩM�F�ʼ��ҧ����@�ˡA�]�m�����e�]�O�@�ˡA����F�ʼ��Ҫ��Ҧ��ާ@�����G<br>
          �u$wapr[�r�q�W]�v���P���F�ʼ��ҡu$bqr[�r�q�W]�v�ܶq�C<br>
          �u$wapsr�v���P���F�ʼ��ҡu$bqsr�v�ܶq�C�]$wapsr[titleurl]�G���D�챵�B$wapsr[classname]�G��ئW�١B$wapsr[classurl]�G����챵�^</td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="echeckloginauth">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>Cookie���ҷ|���n���P��^�n���H�����</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <input type=text name="text22" size=80 value="qCheckLoginAuthstr()" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <textarea name="textarea3" cols="80" rows="9" style="width:100%">&lt;?php
$user=qCheckLoginAuthstr();
if(!$user['islogin'])
{
echo"�z�٥��n��";
exit();
}
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td>����ƪ�^�a�Τ�H�����ƲաG<br>
                �Ʋն��Gislogin(0�����n��,1���w�n��)�Buserid(�Τ�ID)�Busername(�Τ�W)�Bgroupid(�|����ID)</td>
              </tr>
            </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="echeckmembergroup">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>���ҷ|���X���v�����</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <input type=text name="text22" size=80 value="sys_CheckMemberGroup(����X�ݪ��|����ID)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <textarea name="textarea3" cols="80" rows="9" style="width:100%">&lt;?php
$levelst=sys_CheckMemberGroup('1,4');
if($levelst<=0)
{
echo"�z�S���v��";
exit();
}
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td>��������ҷ�e�n���|���O�_���X���v����ơGsys_CheckMemberGroup(����X�ݪ��|����ID)�A����h�ӷ|����ID�i�γr���j�}�C<br>
                ��^0�h���n���A��^-1�h���S�v���A�j��0�����v���C</td>
              </tr>
            </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="resizeimg">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>�ͦ��Y�Ϩ��</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <input type=text name="text2" size=80 value="sys_ResizeImg(��Ϥ�,�Y�ϼe��,�Y�ϰ���,�O�_�����Ϥ�,�ؼФ��W,�ؼХؿ��W)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <textarea name="textarea2" cols="80" rows="5" style="width:100%">&lt;?php
$resizeimgurl=sys_ResizeImg($bqr[titlepic],170,120,1,'','');
echo"&lt;img src='$resizeimgurl'&gt;";
?&gt;</textarea></td>
        </tr>
      </table> 
    </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td>��Ϥ��G�n�ͦ��Y�Ϫ������C<br>
            �Y�ϼe�סB�Y�ϰ��סG�ͦ��Y�Ϫ��W��C<br>
            �O�_�����Ϥ��G������Y�ϫ�W�X�����O�Ʊĥε����覡�C<br>
            �ؼФ��W�G�����i�ٲ��A�p�G�]�m�ؼФ��W�N�л\�����W�A����ƥͦ��{�ɹϤ����C<br>
            �ؼХؿ��W�G�����i�ٲ��A�q�{���Ge/data/tmp/titlepic/</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="egetzy">
  <tr> 
    <td class="header"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr class="header"> 
          <td width="14%">���ҦW�١G</td>
          <td width="86%"><b>��q�r�Ũ��</b></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <input type=text name="text22" size=80 value="egetzy(��q�r��)" style="width:100%"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="6%">�榡:</td>
          <td> <textarea name="textarea3" cols="80" rows="5" style="width:100%">&lt;?php
$zystr=egetzy('rn');
echo"$zystr";
?&gt;</textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td>����Ƥ�K�Τ�b�եμҪO�ϥΤϱצ���q�G<br>
                  (1)�B��ƻy�k�Gegetzy(��q�r��)<br>
            (2)�B��q�r��rn�ର\r\n�Bn�ର\n�Br�ର\r�Bt�ର\t�Bsyh�ର\&quot;�Bdyh�ର\'<br>
                  (3)�B��q�r�Ŭ��Ʀr�A�h�ର�����ƶq��\�A��p�G2�ର\\<br>
                  (4)�B���δ���ŨҤl�G$er=explode(egetzy('rn'),$navinfor[downpath]); </td>
              </tr>
            </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="enewshowmorepic">
  <tr>
    <td class="header"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr class="header">
        <td width="14%">���ҦW�١G</td>
        <td width="86%"><b><strong>��ܹ϶����(������)</strong></b></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">�榡:</td>
        <td><input type=text name="text222" size=80 value="sys_ModShowMorepic(�ɯ�p�ϼe��,�ɯ�p�ϰ���,�p�Ͼɯ�ҪO���e)" style="width:100%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">�Ҥl:</td>
        <td><textarea name="textarea5" cols="80" rows="5" style="width:100%">&lt;?=sys_ModShowMorepic(120,80,'')?&gt;</textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr>
        <td><strong>�ϥαе{�G</strong><a href="../../data/modadd/morepic/ReadMe.html" target="_blank">[�I���o�̬d��]</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder" id="emoreplayer">
  <tr>
    <td class="header"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr class="header">
        <td width="14%">���ҦW�١G</td>
        <td width="86%"><b><strong>��ܵ��W����JS���</strong></b></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="6%">�榡:</td>
        <td><textarea name="textarea6" cols="80" rows="5" style="width:100%">&lt;script src=&quot;/e/data/modadd/moreplayer/empirecmsplayer.js&quot;&gt;&lt;/script&gt;
&lt;script&gt;
EmpireCMSPlayVideo('��������','���W�a�}','��ܼe��','��ܰ���',�O�_�۰ʼ���,'�Ұ�CMS�����ؿ��a�}');
&lt;/script&gt;</textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
      <tr>
        <td><strong>�ϥαе{�G</strong><a href="../../data/modadd/moreplayer/ReadMe.html" target="_blank">[�I���o�̬d��]</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<script>
document.getElementById("bqnav").innerHTML="<?=$bqnav?>";
</script>
</body>
</html>
<?php
db_close();
$empire=null;
?>
