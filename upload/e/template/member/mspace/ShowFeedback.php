<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�d�ݫH��</title>
<link href="../../data/images/qcss.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class=tableborder style='word-break:break-all'>
  <tr class=header> 
    <td height="25" colspan="2">���D�G<?=$r[title]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td width="19%" height="25">�����:</td>
    <td width="81%" height="25"> 
      <?=$r[uname]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�o�G�ɶ�:</td>
    <td height="25"> 
      <?=$r[addtime]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">IP�a�}:</td>
    <td height="25"> 
      <?=$r[ip]?>:<?=$r[eipport]?>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�m�W:</td>
    <td height="25"><?=$r[name]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">���q�W��:</td>
    <td height="25"><?=$r[company]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�pô�l�c:</td>
    <td height="25"><?=$r[email]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�pô�q��:</td>
    <td height="25"><?=$r[phone]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�ǯu:</td>
    <td height="25"><?=$r[fax]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�pô�a�}:</td>
    <td height="25"><?=$r[address]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�l�s�G<?=$r[zip]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25">�H�����D:</td>
    <td height="25"><?=$r[title]?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" valign="top">�H�����e:</td>
    <td height="25"><?=nl2br($r[ftext])?></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="25" colspan="2"><div align="center">[ <a href="javascript:window.close();">�� 
        ��</a> ]</div></td>
  </tr>
</table>
</body>
</html>