<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
//位置
$url="$spacename &gt; 首頁";
include("header.temp.php");
$registertime=eReturnMemberRegtime($ur['registertime'],"Y-m-d H:i:s");
//oicq
if($addur['oicq'])
{
	$addur['oicq']="<a href='http://wpa.qq.com/msgrd?V=1&amp;Uin=".$addur['oicq']."&amp;Site=".$public_r['sitename']."&amp;Menu=yes' target='_blank'><img src='http://wpa.qq.com/pa?p=1:".$addur['oicq'].":4'  border='0' alt='QQ' />".$addur['oicq']."</a>";
}
//簡介
$usersay=$addur['saytext']?$addur['saytext']:'暫無簡介';
$usersay=RepFieldtextNbsp(stripSlashes($usersay));
?>
<?=$spacegg?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#96C8F1">
  <tr>
    <td background="template/default/images/bg_title_sider.gif"><b>個人介紹</b></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <?=nl2br($usersay)?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#96C8F1">
  <tr> 
    <td background="template/default/images/bg_title_sider.gif"><b>詳細信息</b></td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td width="18%">用戶名</td>
          <td width="82%"> 
            <?=$username?>
          </td>
        </tr>
        <tr> 
          <td>會員等級</td>
          <td> 
            <?=$level_r[$ur['groupid']]['groupname']?>
          </td>
        </tr>
        <tr> 
          <td>註冊時間</td>
          <td> 
            <?=$registertime?>
          </td>
        </tr>
        <tr> 
          <td>聯繫郵箱</td>
          <td><a href="mailto:<?=$ur['email']?>"> 
            <?=$ur['email']?>
            </a></td>
        </tr>
        <tr> 
          <td>姓名</td>
          <td> 
            <?=$addur[truename]?>
          </td>
        </tr>
        <tr> 
          <td>聯繫電話</td>
          <td> 
            <?=$addur[mycall]?>
          </td>
        </tr>
        <tr> 
          <td>手機</td>
          <td> 
            <?=$addur[phone]?>
          </td>
        </tr>
        <tr> 
          <td>OICQ</td>
          <td> 
            <?=$addur[oicq]?>
          </td>
        </tr>
        <tr> 
          <td>MSN</td>
          <td> 
            <?=$addur[msn]?>
          </td>
        </tr>
        <tr> 
          <td>網站</td>
          <td> <a href="<?=$addur[homepage]?>" target="_blank"> 
            <?=$addur[homepage]?>
            </a> </td>
        </tr>
        <tr> 
          <td>聯繫地址</td>
          <td> 
            <?=$addur[address]?>
            &nbsp;&nbsp;&nbsp; 郵編 
            <?=$addur[zip]?>
          </td>
        </tr>
      </table> </td>
  </tr>
</table>
<?php
include("footer.temp.php");
?>