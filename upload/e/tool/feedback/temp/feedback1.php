<?php
if(!defined('InEmpireCMS'))
{exit();}
?><?php include("../../data/template/cp_1.php");?>
<table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder">
  <form name='feedback' method='post' enctype='multipart/form-data' action='../../enews/index.php'>
    <input name='enews' type='hidden' value='AddFeedback'>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">�z���m�W:</div></td>
      <td bgcolor='ffffff'><input name='name' type='text' size='42'>
        (*)</td>
    </tr>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">¾��:</div></td>
      <td bgcolor='ffffff'><input name='job' type='text' size='42'></td>
    </tr>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">���q�W��:</div></td>
      <td bgcolor='ffffff'><input name='company' type='text' size='42'></td>
    </tr>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">�pô�l�c:</div></td>
      <td bgcolor='ffffff'><input name='email' type='text' size='42'></td>
    </tr>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">�pô�q��:</div></td>
      <td bgcolor='ffffff'><input name='mycall' type='text' size='42'>
        (*)</td>
    </tr>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">����:</div></td>
      <td bgcolor='ffffff'><input name='homepage' type='text' size='42'></td>
    </tr>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">�pô�a�}:</div></td>
      <td bgcolor='ffffff'><input name='address' type='text' size="42"></td>
    </tr>
    <tr>
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">�H�����D:</div></td>
      <td bgcolor='ffffff'><input name='title' type='text' size="42"> (*)</td>
    </tr>
    <tr> 
      <td width='16%' height=25 bgcolor='ffffff'><div align="right">�H�����e(*):</div></td>
      <td bgcolor='ffffff'><textarea name='saytext' cols='60' rows='12'></textarea> 
      </td>
    </tr>
    <tr>
      <td bgcolor='ffffff'></td>
      <td bgcolor='ffffff'><input type='submit' name='submit' value='����'></td>
    </tr>
  </form>
</table>
<?php include("../../data/template/cp_2.php");?>