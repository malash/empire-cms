<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<link href="../../data/images/qcss.css" rel="stylesheet" type="text/css">
<title>�n��</title>
</head>

<body>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../doaction.php">
    <input type=hidden name=ecmsfrom value="<?=ehtmlspecialchars($_GET['from'])?>">
    <input type=hidden name=prtype value="<?=ehtmlspecialchars($_GET['prt'])?>">
    <input type=hidden name=enews value=login>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">�|���n��</div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="24%" height="25">�Τ�W�G</td>
      <td width="76%" height="25"><input name="username" type="text" id="username"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�K�X�G</td>
      <td height="25"><input name="password" type="password" id="password"></td>
    </tr>
	 <tr bgcolor="#FFFFFF">
      <td height="25">�O�s�G</td>
      <td height="25"> 
        <select name="lifetime">
          <option value="0">���O�s</option>
		  <option value="3600">�@�p��</option>
		  <option value="86400">�@��</option>
		  <option value="2592000">�@�Ӥ�</option>
		  <option value="315360000">�ä[</option>
        </select>
     </td>
    </tr>
    <?php
	if($public_r['loginkey_ok'])
	{
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">���ҽX�G</td>
      <td height="25"><input name="key" type="text" id="key" size="6">
        <img src="../../ShowKey/?v=login" name="loginKeyImg" id="loginKeyImg" onclick="loginKeyImg.src='../../ShowKey/?v=login&t='+Math.random()" title="�ݤ��M��,�I����s"></td>
    </tr>
    <?php
	}	
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">&nbsp;</td>
      <td height="25"><input type="submit" name="Submit" value="�n��"> <input type="button" name="button" value="���U" onclick="window.open('../register/');"></td>
    </tr>
	</form>
  </table>
</body>
</html>