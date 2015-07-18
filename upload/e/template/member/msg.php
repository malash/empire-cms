<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='消息列表';
$url="<a href=../../../>首頁</a>&nbsp;>&nbsp;<a href=../cp/>會員中心</a>&nbsp;>&nbsp;消息列表&nbsp;&nbsp;(<a href='AddMsg/?enews=AddMsg'>發送消息</a>)";
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
              <td width="50%" bgcolor="#FFFFFF"><div align="right">[<a href="AddMsg/?enews=AddMsg">發送消息</a>]&nbsp;&nbsp;</div></td>
            </tr>
        </table>
        <br>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <form name="listmsg" method="post" action="../doaction.php" onsubmit="return confirm('確認要刪除?');">
            <tr class="header"> 
              <td width="4%" height="23"> <div align="center"></div></td>
              <td width="45%"><div align="center">標題</div></td>
              <td width="18%"><div align="center">發送者</div></td>
              <td width="23%"><div align="center">發送時間</div></td>
              <td width="10%"><div align="center">操作</div></td>
            </tr>
            <?php
			while($r=$empire->fetch($sql))
			{
				$img="haveread";
				if(!$r[haveread])
				{$img="nohaveread";}
				//後台管理員
				if($r['isadmin'])
				{
					$from_username="<a title='後台管理員'><b>".$r[from_username]."</b></a>";
				}
				else
				{
					$from_username="<a href='../ShowInfo/?userid=".$r[from_userid]."' target='_blank'>".$r[from_username]."</a>";
				}
				//系統信息
				if($r['issys'])
				{
					$from_username="<b>系統消息</b>";
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
              <td> <div align="center">&nbsp;[<a href="../doaction.php?enews=DelMsg&mid=<?=$r[mid]?>" onclick="return confirm('確認要刪除?');">刪除</a>]</div></td>
            </tr>
            <?php
			}
			?>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"> 
                  <input type=checkbox name=chkall value=on onclick=CheckAll(this.form)>
                </div></td>
              <td colspan="4"><input type="submit" name="Submit2" value="刪除選中"> 
                <input name="enews" type="hidden" value="DelMsg_all">              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td><div align="center"></div></td>
              <td colspan="4"> 
                <?=$returnpage?>              </td>
            </tr>
            <tr bgcolor="#FFFFFF"> 
              <td height="23" colspan="5"><div align="center">說明：<img src="../../data/images/nohaveread.gif" width="14" height="11"> 
                  代表未閱讀消息，<img src="../../data/images/haveread.gif" width="15" height="12"> 
                  代表已閱讀消息.</div></td>
            </tr>
          </form>
        </table>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>