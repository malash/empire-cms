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
CheckLevel($logininid,$loginin,$classid,"template");
$gid=(int)$_GET['gid'];
$gname=CheckTempGroup($gid);
$urlgname=$gname."&nbsp;>&nbsp;";
$mid=ehtmlspecialchars($_GET['mid']);
$cid=ehtmlspecialchars($_GET['cid']);
$enews=ehtmlspecialchars($_GET['enews']);
$r[subnews]=0;
$r[rownum]=1;
$r[subtitle]=0;
$r[showdate]="Y-m-d H:i:s";
$url=$urlgname."<a href=ListListtemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲z�C��ҪO</a>&nbsp;>&nbsp;�W�[�C��ҪO";
$autorownum=" checked";
//�ƻs
if($enews=="AddListtemp"&&$_GET['docopy'])
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempname,temptext,subnews,listvar,rownum,modid,showdate,subtitle,classid,docode from ".GetDoTemptb("enewslisttemp",$gid)." where tempid='$tempid'");
	$url=$urlgname."<a href=ListListtemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲z�C��ҪO</a>&nbsp;>&nbsp;�ƻs�C��ҪO�G".$r[tempname];
}
//�ק�
if($enews=="EditListtemp")
{
	$tempid=(int)$_GET['tempid'];
	$r=$empire->fetch1("select tempname,temptext,subnews,listvar,rownum,modid,showdate,subtitle,classid,docode from ".GetDoTemptb("enewslisttemp",$gid)." where tempid='$tempid'");
	$url=$urlgname."<a href=ListListtemp.php?gid=$gid".$ecms_hashur['ehref'].">�޲z�C��ҪO</a>&nbsp;>&nbsp;�ק�C��ҪO�G".$r[tempname];
}
//�t�μҫ�
$msql=$empire->query("select mid,mname from {$dbtbpre}enewsmod where usemod=0 order by myorder,mid");
while($mr=$empire->fetch($msql))
{
	if($mr[mid]==$r[modid])
	{$select=" selected";}
	else
	{$select="";}
	$mod.="<option value=".$mr[mid].$select.">".$mr[mname]."</option>";
}
//����
$cstr="";
$csql=$empire->query("select classid,classname from {$dbtbpre}enewslisttempclass order by classid");
while($cr=$empire->fetch($csql))
{
	$select="";
	if($cr[classid]==$r[classid])
	{
		$select=" selected";
	}
	$cstr.="<option value='".$cr[classid]."'".$select.">".$cr[classname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z�C��ҪO</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function ReturnHtml(html)
{
document.form1.temptext.value=html;
}
</script>
<SCRIPT lanuage="JScript">
<!--
function tempturnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
-->
</SCRIPT>
<script>
function ReTempBak(){
	self.location.reload();
}
</script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>��m�G<?=$url?></td>
  </tr>
</table>
<br>
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="ListListtemp.php">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="3">�W�[�ҪO 
        <input type=hidden name=enews value="<?=$enews?>"> <input name="tempid" type="hidden" id="tempid" value="<?=$tempid?>"> 
        <input name="cid" type="hidden" id="cid" value="<?=$cid?>"> <input name="mid" type="hidden" id="mid" value="<?=$mid?>"> 
        <input name="gid" type="hidden" id="gid" value="<?=$gid?>"> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="22%" height="25">�ҪO�W(*)</td>
      <td height="25" colspan="2"><input name="tempname" type="text" id="tempname" value="<?=$r[tempname]?>" size="36"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݨt�μҫ�(*)</td>
      <td height="25" colspan="2"><select name="modid" id="modid">
          <?=$mod?>
        </select> <input type="button" name="Submit6" value="�޲z�t�μҫ�" onclick="window.open('../db/ListTable.php<?=$ecms_hashur['whehref']?>');"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ݤ���</td>
      <td height="25" colspan="2"><select name="classid" id="classid">
          <option value="0">�����ݩ�������</option>
          <?=$cstr?>
        </select> <input type="button" name="Submit6222322" value="�޲z����" onclick="window.open('ListtempClass.php<?=$ecms_hashur['whehref']?>');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">²���I���r��</td>
      <td height="25" colspan="2"><input name="subnews" type="text" id="subnews" value="<?=$r[subnews]?>" size="6">
        �Ӧr�`<font color="#666666">(0�����I��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���D�I���r��</td>
      <td height="25" colspan="2"><input name="subtitle" type="text" id="subtitle" value="<?=$r[subtitle]?>" size="6">
        �Ӧr�`<font color="#666666">(0�����I��)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�C�����</td>
      <td height="25" colspan="2"><input name="rownum" type="text" id="rownum" value="<?=$r[rownum]?>" size="6">
        ���O��<font color="#666666">( 
        <input name="autorownum" type="checkbox" id="autorownum" value="1"<?=$autorownum?>>
        �۰��ѧO)</font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ɶ���ܮ榡</td>
      <td colspan="2"> <input name="showdate" type="text" id="showdate" value="<?=$r[showdate]?>" size="20"> 
        <select name="select4" onchange="document.form1.showdate.value=this.value">
          <option value="Y-m-d H:i:s">���</option>
          <option value="Y-m-d H:i:s">2005-01-27 11:04:27</option>
          <option value="Y-m-d">2005-01-27</option>
          <option value="m-d">01-27</option>
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>�����ҪO���e</strong>(*)</td>
      <td colspan="2">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.temptext.value);document.form1.temptext.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.temptext.value&returnvar=opener.document.form1.temptext.value&fun=ReturnHtml<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="3" valign="top"><p> 
          <textarea name="temptext" cols="90" rows="27" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[temptext]))?></textarea>
        </p></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"><strong>�C���e�ҪO(list.var) </strong>(*)</td>
      <td width="64%">�бN�ҪO���e<a href="#ecms" onclick="window.clipboardData.setData('Text',document.form1.listvar.value);document.form1.listvar.select()" title="�I���ƻs�ҪO���e"><strong>�ƻs��Dreamweaver(����)</strong></a>�Ϊ̨ϥ�<a href="#ecms" onclick="window.open('editor.php?getvar=opener.document.form1.listvar.value&returnvar=opener.document.form1.listvar.value&fun=ReturnHtml&notfullpage=1<?=$ecms_hashur['ehref']?>','edittemp','width=880,height=600,scrollbars=auto,resizable=yes');"><strong>�ҪO�b�u�s��</strong></a>�i��i���ƽs��</td>
      <td width="14%"><div align="right">
          <input name="docode" type="checkbox" id="docode" value="1"<?=$r[docode]==1?' checked':''?>>
          <a title="list.var�ϥε{�ǥN�X">�ϥε{�ǥN�X</a></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="3" valign="top"> <div align="center"> 
          <textarea name="listvar" cols="90" rows="12" id="listvar" wrap="OFF" style="WIDTH: 100%"><?=ehtmlspecialchars(stripSlashes($r[listvar]))?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25" colspan="2"><input type="submit" name="Submit" value="�O�s�ҪO">
        &nbsp; <input type="reset" name="Submit2" value="���m">
        <?php
		if($enews=='EditListtemp')
		{
		?>
        &nbsp;&nbsp;[<a href="#empirecms" onclick="window.open('TempBak.php?temptype=listtemp&tempid=<?=$tempid?>&gid=<?=$gid?><?=$ecms_hashur['ehref']?>','ViewTempBak','width=450,height=500,scrollbars=yes,left=300,top=150,resizable=yes');">�ק�O��</a>] 
        <?php
		}
		?>
      </td>
    </tr>
	</form>
	<tr bgcolor="#FFFFFF"> 
      <td height="25" colspan="3">&nbsp;&nbsp;[<a href="#ecms" onclick="tempturnit(showtempvar);">��ܼҪO�ܶq����</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('EnewsBq.php<?=$ecms_hashur['whehref']?>','','width=600,height=500,scrollbars=yes,resizable=yes');">�d�ݼҪO���һy�k</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('../ListClass.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d��JS�եΦa�}</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListTempvar.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݤ��@�ҪO�ܶq</a>] 
        &nbsp;&nbsp;[<a href="#ecms" onclick="window.open('ListBqtemp.php<?=$ecms_hashur['whehref']?>','','width=800,height=600,scrollbars=yes,resizable=yes');">�d�ݼ��ҼҪO</a>]</td>
    </tr>
    <tr bgcolor="#FFFFFF" id="showtempvar" style="display:none"> 
      <td height="25" colspan="3"><strong>(1)�B�����ҪO���e������ܶq</strong><br> 
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield" type="text" value="[!--pagetitle--]">
              :�������D</td>
            <td width="34%"><input name="textfield72" type="text" value="[!--pagekey--]">
              :��������r </td>
            <td width="33%"><input name="textfield73" type="text" value="[!--pagedes--]">
              :�����y�z </td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="25"><input name="textfield2" type="text" value="[!--newsnav--]">
              :�ɯ��</td>
            <td><input name="textfield92" type="text" value="[!--class.menu--]">
              :�@����ؾɯ�</td>
            <td><input name="textfield132" type="text" value="[!--class.name--]">
              :��ئW</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield4" type="text" value="[!--self.classid--]">
              :�����/�M�DID</td>
            <td><input name="textfield5" type="text" value="[!--bclass.id--]">
              :�����ID</td>
            <td><input name="textfield6" type="text" value="[!--bclass.name--]">
              :����ئW��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield7" type="text" value="[!--class.intro--]">
              :���/�M�D²��</td>
            <td><input name="textfield8" type="text" value="[!--class.keywords--]">
              :���/�M�D����r</td>
            <td><input name="textfield9" type="text" value="[!--class.classimg--]">
              :���/�M�D�Y����</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield10" type="text" value="[!--show.page--]">
              :�����ɯ�(�U�Ԧ�)<br></td>
            <td><input name="textfield11" type="text" value="[!--show.listpage--]">
              :�����ɯ�(�C��)</td>
            <td><input name="textfield12" type="text" value="[!--list.pageno--]">
              :��e������</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield13" type="text" value="[!--hotnews--]">
              :�����H��JS�ե�(�q�{��)<br> <input name="textfield14" type="text" value="[!--self.hotnews--]">
              :����ؼ����H��JS�ե�</td>
            <td><input name="textfield15" type="text" value="[!--newnews--]">
              :�̷s�H��JS�ե�(�q�{��)<br> <input name="textfield16" type="text" value="[!--self.newnews--]">
              :����س̷s�H��JS�ե�</td>
            <td><input name="textfield17" type="text" value="[!--goodnews--]">
              :���˫H��JS�ե�(�q�{��)<br> <input name="textfield18" type="text" value="[!--self.goodnews--]">
              :����ر��˫H��JS�ե�</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield19" type="text" value="[!--hotplnews--]">
              :���׼����H��JS�ե�(�q�{��)<br> <input name="textfield20" type="text" value="[!--self.hotplnews--]">
              :����ص��׼����H��JS�ե�</td>
            <td><input name="textfield21" type="text" value="[!--firstnews--]">
              :�Y���H��JS�ե�(�q�{��)<br> <input name="textfield22" type="text" value="[!--self.firstnews--]">
              :������Y���H��JS�ե�</td>
            <td><strong>���e�ܶq�G &lt;!--list.var�s��--&gt; (�p�G&lt;!--list.var1--&gt;,&lt;!--list.var2--&gt;) 
              </strong> </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield3" type="text" value="[!--page.stats--]">
              :�έp�X��</td>
            <td><strong>������@�ҪO�ܶq</strong></td>
            <td><strong>����Ҧ��ҪO����</strong></td>
          </tr>
        </table>
        <br> <strong>(2)�B�C���e�ҪO(list.var)������ܶq</strong><br> <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr bgcolor="#FFFFFF"> 
            <td width="33%" height="25"> <input name="textfield23" type="text" value="[!--id--]">
              :�H��ID</td>
            <td width="34%"> <input name="textfield24" type="text" value="[!--titleurl--]">
              :���D�챵</td>
            <td width="33%"> <input name="textfield25" type="text" value="[!--oldtitle--]">
              :���DALT(���I���r��)</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield26" type="text" value="[!--classid--]">
              :���ID</td>
            <td><input name="textfield27" type="text" value="[!--class.name--]">
              :��ئW��(�a�챵)</td>
            <td><input name="textfield28" type="text" value="[!--this.classname--]">
              :��ئW��(���a�챵)</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield29" type="text" value="[!--this.classlink--]">
              :��ئa�}</td>
            <td><input name="textfield30" type="text" value="[!--news.url--]">
              :�����a�}</td>
            <td><input name="textfield31" type="text" value="[!--no.num--]">
              :�H���s��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield32" type="text" value="[!--userid--]">
              :�o�G��ID</td>
            <td><input name="textfield33" type="text" value="[!--username--]">
              :�o�G��</td>
            <td><input name="textfield34" type="text" value="[!--userfen--]">
              :�d�ݫH�������I��</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield35" type="text" value="[!--onclick--]">
              :�I����</td>
            <td><input name="textfield36" type="text" value="[!--totaldown--]">
              :�U����</td>
            <td><input name="textfield37" type="text" value="[!--plnum--]">
              :���׼�</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><input name="textfield192" type="text" value="[!--ttid--]">
              :���D����ID</td>
            <td><input name="textfield1922" type="text" value="[!--tt.name--]">
              :���D�����W��</td>
            <td><input name="textfield19222" type="text" value="[!--tt.url--]">
:���D�����a�}</td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td height="25"><strong>[!--�r�q�W--]:�ƾڪ�r�q���e�եΡA�I 
              <input type="button" name="Submit3" value="�o��" onclick="window.open('ShowVar.php?<?=$ecms_hashur['ehref']?>&modid='+document.form1.modid.value,'','width=300,height=520,scrollbars=yes');">
              �i�d��</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="80">�ҪO�榡����</td>
      <td height="25" colspan="2"><p> <strong>�����ҪO���e�G</strong>�C���Y[!--empirenews.listtemp--]�C���e[!--empirenews.listtemp--]�C���<br>
          �����ҪO�榡�|�C�G&lt;table&gt;[!--empirenews.listtemp--]&lt;tr&gt;&lt;td&gt;&lt;!--list.var1--&gt;&lt;/td&gt;&lt;td&gt;&lt;!--list.var2--&gt;&lt;/td&gt;&lt;/tr&gt;[!--empirenews.listtemp--]&lt;/table&gt;<font color="#FF0000">(�C�����2���O��)</font><br>
          <strong>�C���e�ҪO�G</strong>�Y�������ҪO���e������&lt;!--list.var*--&gt;��������ܪ����e�D</p></td>
    </tr>
  </table>
</body>
</html>
