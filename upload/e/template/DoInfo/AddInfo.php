<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']=$word;
$url="<a href='../../'>����</a>&nbsp;>&nbsp;<a href='../member/cp/'>�|������</a>&nbsp;>&nbsp;<a href='ListInfo.php?mid=".$mid."'>�޲z�H��</a>&nbsp;>&nbsp;".$word."&nbsp;(".$mr[qmname].")";
require(ECMS_PATH.'e/template/incfile/header.php');
?>
<script src="../data/html/setday.js"></script>
<script>
function bs(){
	var f=document.add
	if(f.title.value.length==0){alert("���D�٨S�g");f.title.focus();return false;}
	if(f.classid.value==0){alert("�п�����");f.classid.focus();return false;}
}
function foreColor(){
  if(!Error())	return;
  var arr = showModalDialog("../data/html/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) document.add.titlecolor.value=arr;
  else document.add.titlecolor.focus();
}
function FieldChangeColor(obj){
  if(!Error())	return;
  var arr = showModalDialog("../data/html/selcolor.html", "", "dialogWidth:18.5em; dialogHeight:17.5em; status:0");
  if (arr != null) obj.value=arr;
  else obj.focus();
}
</script>
<script src="../data/html/postinfo.js"></script>
<form name="add" method="POST" enctype="multipart/form-data" action="ecms.php" onsubmit="return EmpireCMSQInfoPostFun(document.add,'<?=$mid?>');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
          <tr class="header"> 
            <td height="25" colspan="2"> 
              <?=$word?>
              <input type=hidden value="<?=$enews?>" name=enews> <input type=hidden value="<?=$classid?>" name=classid> 
              <input name=id type=hidden id="id" value="<?=$id?>"> <input type=hidden value="<?=$filepass?>" name=filepass> 
              <input name=mid type=hidden id="mid" value="<?=$mid?>"></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td>�����</td>
            <td><b>
              <?=$musername?>
              </b></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="16%">���</td>
            <td>
              <?=$postclass?>            </td>
          </tr>
        </table>
  <?php
  @include($modfile);
  ?>
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  	<?=$showkey?>
    <tr class="header"> 
      <td width="16%">&nbsp;</td>
      <td><input type="submit" name="addnews" value="����"> <input type="reset" name="Submit2" value="���m"></td>
    </tr>
  </table>
</form>
<?php
require(ECMS_PATH.'e/template/incfile/footer.php');
?>