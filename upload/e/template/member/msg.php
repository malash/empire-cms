<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='�����C��';
$url="<a href=../../../>����</a>&nbsp;>&nbsp;<a href=../cp/>�|������</a>&nbsp;>&nbsp;�����C��&nbsp;&nbsp;(<a href='AddMsg/?enews=AddMsg'>�o�e����</a>)";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
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
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
            <tr>
              <td width="50%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
              <td width="50%" bgcolor="#FFFFFF"><div align="right">[<a href="AddMsg/?enews=AddMsg">�o�e����</a>]&nbsp;&nbsp;</div></td>
            </tr>
        </table>
        <br>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form name="listmsg" method="post" action="../doaction.php" onsubmit="return confirm('�T�{�n�R��?');">
            <tr class="header"> 
              <td width="4%" height="23"> <div align="center"></div></td>
              <td width="45%"><div align="center">���D</div></td>
              <td width="18%"><div align="center">�o�e��</div></td>
              <td width="23%"><div align="center">�o�e�ɶ�</div></td>
              <td width="10%"><div align="center">�ާ@</div></td>
            </tr>
            <?php
			while($r=$empire->fetch($sql))
			{
				$img="haveread";
				if(!$r[haveread])
				{$img="nohaveread";}
				//��x�޲z��
				if($r['isadmin'])
				{
					$from_username="<a title='��x�޲z��'><b>".$r[from_username]."</b></a>";
				}
				else
				{
					$from_username="<a href='../ShowInfo/?userid=".$r[from_userid]."' target='_blank'>".$r[from_username]."</a>";
				}
				//�t�ΫH��
				if($r['issys'])
				{
					$from_username="<b>�t�ή���</b>";
					$r[title]="<b>".$r[title]."</b>";
				}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td height="25"> <div align="center"> 
                  <input name="mid[]" type="checkbox" id="mid[]2" value="<?=$r[mid]?>">
                </div></td>
              <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                    <td width="9%"><div align="center"><img src="../../data/images/<?=$img?>.gif" border=0></div></td>
                    <td width="91%"><a href="ViewMsg/?mid=<?=$r[mid]?>"> 
                      <?=stripSlashes($r[title])?>
                      </a></td>
                  </tr>
                </table></td>
              <td><div align="center"> 
                  <?=$from_username?>
                </div></td>
              <td><div align="center"> 
                  <?=$r[msgtime]?>
                </div></td>
              <td> <div align="center">&nbsp;[<a href="../doaction.php?enews=DelMsg&mid=<?=$r[mid]?>" onclick="return confirm('�T�{�n�R��?');">�R��</a>]</div></td>
            </tr>
            <?php
			}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"> 
                  <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
                </div></td>
              <td colspan="4"><input type="submit" name="Submit2" value="�R���襤"> 
                <input name="enews" type="hidden" value="DelMsg_all">              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"></div></td>
              <td colspan="4"> 
                <?=$returnpage?>              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="23" colspan="5"><div align="center">�����G<img src="../../data/images/nohaveread.gif" width="14" height="11"> 
                  �N���\Ū�����A<img src="../../data/images/haveread.gif" width="15" height="12"> 
                  �N��w�\Ū����.</div></td>
            </tr>
          </form>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>