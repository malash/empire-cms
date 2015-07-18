<?php
//*********************** �M�D *********************

//��^�r�q��
function ReturnZFvalue($value)
{
	$value=str_replace("\r\n","|",$value);
	return $value;
}

//���o�M�D��椸��html�N�X
function GetZtFform($type,$f,$fvalue,$fformsize=''){
	if($type=="select"||$type=="radio"||$type=="checkbox")
	{
		return GetZFformSelect($type,$f,$fvalue,$fformsize);
	}
	$file="../data/html/classfhtml.txt";
	$data=ReadFiletext($file);
	$exp="[!--".$type."--]";
	$r=explode($exp,$data);
	$string=str_replace("[!--enews.var--]",$f,$r[1]);
	$string=str_replace("[!--enews.def.val--]",$fvalue,$string);
	if($type=='editor')//�s�边
	{
		$editortype='Default';
		$string=str_replace("[!--editor.type--]",$editortype,$string);
		$string=str_replace("[!--editor.basepath--]",'../ecmseditor/infoeditor/',$string);
	}
	elseif($type=='img'||$type=='flash'||$type=='file')//����
	{
		$string=str_replace("[!--enews.modtype--]",'2',$string);
		$string=str_replace("[!--enews.path--]",'../',$string);
	}
	$string=RepZFformSize($f,$string,$type,$fformsize);
	return fAddAddsData($string);
}

//���oselect/radio�����N�X
function GetZFformSelect($type,$f,$fvalue,$fformsize=''){
	$vr=explode("|",$fvalue);
	$count=count($vr);
	$change="";
	$def=':default';
	for($i=0;$i<$count;$i++)
	{
		$val=$vr[$i];
		$isdef="";
		if(strstr($val,$def))
		{
			$dr=explode($def,$val);
			$val=$dr[0];
			$isdef="||\$ecmsfirstpost==1";
		}
		if($type=='select')
		{
			$change.="<option value=\"".$val."\"<?=\$r[".$f."]==\"".$val."\"".$isdef."?' selected':''?>>".$val."</option>";
		}
		elseif($type=='checkbox')
		{
			$change.="<input name=\"".$f."[]\" type=\"checkbox\" value=\"".$val."\"<?=strstr(\$r[".$f."],\"|".$val."|\")".$isdef."?' checked':''?>>".$val;
		}
		else
		{
			$change.="<input name=\"".$f."\" type=\"radio\" value=\"".$val."\"<?=\$r[".$f."]==\"".$val."\"".$isdef."?' checked':''?>>".$val;
		}
	}
	if($type=="select")
	{
		if($fformsize)
		{
			$addsize=' style="width:'.$fformsize.'"';
		}
		$change="<select name=\"".$f."\" id=\"".$f."\"".$addsize.">".$change."</select>";
	}
	return $change;
}

//������椸������
function RepZFformSize($f,$string,$type,$fformsize=''){
	$fformsize=ReturnDefZFformSize($f,$type,$fformsize);
	if($type=='textarea'||$type=='editor')
	{
		$r=explode(',',$fformsize);
		$string=str_replace('[!--fsize.w--]',$r[0],$string);
		$string=str_replace('[!--fsize.h--]',$r[1],$string);
	}
	else
	{
		$string=str_replace('[!--fsize.w--]',$fformsize,$string);
	}
	return $string;
}

//��^�q�{����
function ReturnDefZFformSize($f,$type,$fformsize){
	if(empty($fformsize))
	{
		if($type=='textarea')
		{
			$fformsize='60,10';
		}
		elseif($type=='img')
		{
			$fformsize='45';
		}
		elseif($type=='file')
		{
			$fformsize='45';
		}
		elseif($type=='flash')
		{
			$fformsize='45';
		}
		elseif($type=='date')
		{
			$fformsize='12';
		}
		elseif($type=='color')
		{
			$fformsize='10';
		}
		elseif($type=='linkfield')
		{
			$fformsize='45';
		}
		elseif($type=='downpath')
		{
			$fformsize='45';
		}
		elseif($type=='onlinepath')
		{
			$fformsize='45';
		}
		elseif($type=='editor')
		{
			$fformsize='100%,300';
		}
	}
	return $fformsize;
}

//��s��ت����
function ChangeZtForm(){
	global $empire,$dbtbpre;
	$file='../data/html/ztaddform.php';
	$mtemp='';
	$sql=$empire->query("select fname,f,fhtml from {$dbtbpre}enewsztf order by myorder,fid");
	while($r=$empire->fetch($sql))
	{
		$mtemp.="<tr bgcolor='#FFFFFF' height=25><td>".$r['fname']."</td><td>".$r['fhtml']."</td></tr>";
    }
	$mtemp="<?php
if(!defined('InEmpireCMS'))
{exit();}
?>".$mtemp;
	WriteFiletext($file,$mtemp);
}

//�W�[�M�D�r�q
function AddZtF($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"ztf");
	$add[f]=RepPostVar($add[f]);
	if(empty($add[f])||empty($add[fname]))
	{
		printerror("EmptyF","");
	}
	//�r�q�O�_����
	$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewsztadd");
	$b=0;
	while($r=$empire->fetch($s))
	{
		if($r[Field]==$add[f])
		{
			$b=1;
			break;
		}
    }
	if($b)
	{
		printerror("ReF","");
	}
	$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewszt");
	$b=0;
	while($r=$empire->fetch($s))
	{
		if($r[Field]==$add[f])
		{
			$b=1;
			break;
		}
    }
	if($b)
	{
		printerror("ReF","");
	}
	$add[fvalue]=ReturnZFvalue($add[fvalue]);//��l�ƭ�
	//�r�q����
	if($add[ftype]=="TINYINT"||$add[ftype]=="SMALLINT"||$add[ftype]=="INT"||$add[ftype]=="BIGINT"||$add[ftype]=="FLOAT"||$add[ftype]=="DOUBLE")
	{
		$def=" default '0'";
	}
	elseif($add[ftype]=="VARCHAR")
	{
		$def=" default ''";
	}
	else
	{
		$def="";
	}
	$type=$add[ftype];
	//VARCHAR
	if($add[ftype]=='VARCHAR'&&empty($add[flen]))
	{
		$add[flen]='255';
	}
	//�r�q����
	if($add[flen]){
		if($add[ftype]!="TEXT"&&$add[ftype]!="MEDIUMTEXT"&&$add[ftype]!="LONGTEXT"){
			$type.="(".$add[flen].")";
		}
	}
	$field="`".$add[f]."` ".$type." NOT NULL".$def;
	//�s�W�r�q
	$asql=$empire->query("alter table {$dbtbpre}enewsztadd add ".$field);
	//�����N�X
	$fhtml=GetZtFform($add[fform],$add[f],$add[fvalue],$add[fformsize]);
	if($add[fform]=='select'||$add[fform]=='radio'||$add[fform]=='checkbox')
	{
		$fhtml=str_replace("\$r[","\$addr[",$fhtml);
	}
	//�B�z�ܶq
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("insert into {$dbtbpre}enewsztf(f,fname,fform,fhtml,fzs,myorder,ftype,flen,fvalue,fformsize) values('$add[f]','$add[fname]','$add[fform]','".eaddslashes2($fhtml)."','".eaddslashes($add[fzs])."',$add[myorder],'$add[ftype]','$add[flen]','".eaddslashes2($add[fvalue])."','$add[fformsize]');");
	$lastid=$empire->lastid();
	//��s���
	ChangeZtForm();
	if($asql&&$sql)
	{
		//�ާ@��x
		insert_dolog("fid=".$lastid."<br>f=".$add[f]);
		printerror("AddFSuccess","special/AddZtF.php?enews=AddZtF".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק�M�D�r�q
function EditZtF($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"ztf");
	$fid=(int)$add['fid'];
	$add[f]=RepPostVar($add[f]);
	$add[oldf]=RepPostVar($add[oldf]);
	if(empty($add[f])||empty($add[fname])||!$fid){
		printerror("EmptyF","history.go(-1)");
	}
	if($add[f]<>$add[oldf]){
		//�r�q�O�_����
		$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewsztadd");
		$b=0;
		while($r=$empire->fetch($s)){
			if($r[Field]==$add[f]){
				$b=1;
				break;
			}
		}
		if($b){
			printerror("ReF","history.go(-1)");
		}
		$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewszt");
		$b=0;
		while($r=$empire->fetch($s))
		{
			if($r[Field]==$add[f])
			{
				$b=1;
				break;
			}
		}
		if($b)
		{
			printerror("ReF","");
		}
	}
	$add[fvalue]=ReturnZFvalue($add[fvalue]);//��l�ƭ�
	//�r�q����
	if($add[ftype]=="TINYINT"||$add[ftype]=="SMALLINT"||$add[ftype]=="INT"||$add[ftype]=="BIGINT"||$add[ftype]=="FLOAT"||$add[ftype]=="DOUBLE")
	{
		$def=" default '0'";
	}
	elseif($add[ftype]=="VARCHAR")
	{
		$def=" default ''";
	}
	else
	{
		$def="";
	}
	$type=$add[ftype];
	//VARCHAR
	if($add[ftype]=='VARCHAR'&&empty($add[flen]))
	{
		$add[flen]='255';
	}
	//�r�q����
	if($add[flen]){
		if($add[ftype]!="TEXT"&&$add[ftype]!="MEDIUMTEXT"&&$add[ftype]!="LONGTEXT"){
			$type.="(".$add[flen].")";
		}
	}
	$field="`".$add[f]."` ".$type." NOT NULL".$def;
	$usql=$empire->query("alter table {$dbtbpre}enewsztadd change `".$add[oldf]."` ".$field);
	//�����N�X
	if($add[f]<>$add[oldf]||$add[fform]<>$add[oldfform]||$add[fvalue]<>$add[oldfvalue]||$add[fformsize]<>$add[oldfformsize]){
		$fhtml=GetZtFform($add[fform],$add[f],$add[fvalue],$add[fformsize]);
		if($add[fform]=='select'||$add[fform]=='radio'||$add[fform]=='checkbox')
		{
			$fhtml=str_replace("\$r[","\$addr[",$fhtml);
		}
	}
	else{
		$fhtml=$add[fhtml];
	}
	//�B�z�ܶq
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("update {$dbtbpre}enewsztf set f='$add[f]',fname='$add[fname]',fform='$add[fform]',fhtml='".eaddslashes2($fhtml)."',fzs='".eaddslashes($add[fzs])."',myorder=$add[myorder],ftype='$add[ftype]',flen='$add[flen]',fvalue='".eaddslashes2($add[fvalue])."',fformsize='$add[fformsize]' where fid=$fid");
	//��s���
	ChangeZtForm();
	if($usql&&$sql)
	{
		insert_dolog("fid=".$fid."<br>f=".$add[f]);//�ާ@��x
		printerror("EditFSuccess","special/ListZtF.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R���M�D�r�q
function DelZtF($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"ztf");
	$fid=(int)$add['fid'];
	if(empty($fid)){
		printerror("EmptyFid","history.go(-1)");
	}
	$r=$empire->fetch1("select f from {$dbtbpre}enewsztf where fid='$fid'");
	if(!$r[f]){
		printerror("EmptyFid","history.go(-1)");
	}
	$usql=$empire->query("alter table {$dbtbpre}enewsztadd drop COLUMN `".$r[f]."`");
	$sql=$empire->query("delete from {$dbtbpre}enewsztf where fid='$fid'");
	//��s����
	ChangeZtForm();
	if($usql&&$sql)
	{
		insert_dolog("fid=".$fid."<br>f=".$r[f]);//�ާ@��x
		printerror("DelFSuccess","special/ListZtF.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק�M�D�r�q����
function EditZtFOrder($fid,$myorder,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"ztf");
	for($i=0;$i<count($myorder);$i++)
	{
		$fid[$i]=(int)$fid[$i];
		$newmyorder=(int)$myorder[$i];
		$usql=$empire->query("update {$dbtbpre}enewsztf set myorder=$newmyorder where fid='$fid[$i]'");
    }
	//��s����
	ChangeZtForm();
	printerror("EditFOrderSuccess","special/ListZtF.php".hReturnEcmsHashStrHref2(1));
}

//��^�M�D�r�q
function ReturnZtAddF($add,$ecms=0){
	global $empire,$dbtbpre;
	$ret_r[0]='';
	$ret_r[1]='';
	$fsql=$empire->query("select f from {$dbtbpre}enewsztf");
	if($ecms==0)//�W�[
	{
		while($fr=$empire->fetch($fsql))
		{
			$f=$fr['f'];
			$fval=$add[$f];
			$fval=RepPhpAspJspcode($fval);
			$ret_r[0].=",`".$f."`";
			$ret_r[1].=",'".AddAddsData($fval)."'";
		}
	}
	else//�ק�
	{
		while($fr=$empire->fetch($fsql))
		{
			$f=$fr['f'];
			$fval=$add[$f];
			$fval=RepPhpAspJspcode($fval);
			$ret_r[0].=",`".$f."`='".AddAddsData($fval)."'";
		}
	}
	return $ret_r;
}


//�B�z�M�D�����ܶq
function DoPostZtVar($add){
	if(empty($add[zttype])){
		$add[zttype]=".html";
	}
	if(empty($add[ztnum])){
		$add[ztnum]=25;
	}
	$add[zcid]=(int)$add['zcid'];
	$add[ztname]=eaddslashes(ehtmlspecialchars($add[ztname]));
	$add[intro]=eaddslashes(RepPhpAspJspcode($add[intro]));
	$add[ztpagekey]=eaddslashes(RepPhpAspJspcode($add[ztpagekey]));
	$add[ztnum]=(int)$add[ztnum];
	$add[listtempid]=(int)$add[listtempid];
	$add[classid]=(int)$add[classid];
	$add[islist]=(int)$add[islist];
	$add[maxnum]=(int)$add[maxnum];
	$add[showzt]=(int)$add[showzt];
	$add[classtempid]=(int)$add[classtempid];
	$add['myorder']=(int)$add['myorder'];
	$add[reorder]=RepPostVar2($add[reorder]);
	$add[classtext]=RepPhpAspJspcode($add[classtext]);
	$add[usezt]=(int)$add[usezt];
	$add[yhid]=(int)$add[yhid];
	$add['endtime']=$add['endtime']?to_time($add['endtime']):0;
	$add['closepl']=(int)$add['closepl'];
	$add['checkpl']=(int)$add['checkpl'];
	$add['from']=(int)$add['from'];
	$add['filepass']=(int)$add['filepass'];
	$add['pltempid']=(int)$add['pltempid'];
	if($add['usernames'])
	{
		$add['usernames']=','.$add['usernames'].',';
	}
	//�ؿ�
	$add[ztpath]=$add['pripath'].$add['ztpath'];
	$add[ztpath]=eaddslashes($add[ztpath]);
	return $add;
}

//�W�[�M�D
function AddZt($add,$userid,$username){
	global $empire,$class_r,$dbtbpre,$public_r;
	$add[ztpath]=trim($add[ztpath]);
	if(!$add[ztname]||!$add[listtempid]||!$add[ztpath]){
		printerror("EmptyZt","");
	}
	CheckLevel($userid,$username,$classid,"zt");
	$add=DoPostZtVar($add);
	$createpath='../../'.$add[ztpath];
	//�˴��ؿ��O�_�s�b
	if(file_exists($createpath)){
		printerror("ReZtpath","");
	}
	CreateZtPath($add[ztpath]);//�إ߱M�D�ؿ�
	$addtime=time();
	//���o��W
	$tabler=GetModTable(GetListtempMid($add[listtempid]));
	$tabler[tid]=(int)$tabler[tid];
	$sql=$empire->query("insert into {$dbtbpre}enewszt(ztname,ztnum,listtempid,onclick,ztpath,zttype,zturl,classid,islist,maxnum,reorder,intro,ztimg,zcid,showzt,ztpagekey,classtempid,myorder,usezt,yhid,endtime,closepl,checkpl,restb,usernames,addtime,pltempid) values('$add[ztname]',$add[ztnum],$add[listtempid],0,'$add[ztpath]','$add[zttype]','$add[zturl]',$add[classid],$add[islist],$add[maxnum],'$add[reorder]','$add[intro]','$add[ztimg]',$add[zcid],$add[showzt],'$add[ztpagekey]','$add[classtempid]',$add[myorder],'$add[usezt]','$add[yhid]','$add[endtime]','$add[closepl]','$add[checkpl]','$public_r[pldeftb]','$add[usernames]','$addtime','$add[pltempid]');");
	$ztid=$empire->lastid();
	//�ƪ�
	$ret_zr=ReturnZtAddF($add,0);
	$empire->query("replace into {$dbtbpre}enewsztadd(ztid,classtext".$ret_zr[0].") values('$ztid','".eaddslashes2($add[classtext])."'".$ret_zr[1].");");
	//��s����
	UpdateTheFileOther(2,$ztid,$add['filepass'],'other');
	//�ͦ�����
	if($add[islist]==0||$add[islist]==2)
	{
		$classtemp=$add[islist]==2?GetZtText($ztid):GetClassTemp($add['classtempid']);
		NewsBq($ztid,$classtemp,3,1);
    }
	GetClass();//��s�w�s
	if($sql){
		insert_dolog("ztid=".$ztid."<br>ztname=".$add[ztname]);//�ާ@��x
		printerror("AddZtSuccess","special/AddZt.php?enews=AddZt".hReturnEcmsHashStrHref2(0));
	}
	else{
		printerror("DbError","");
	}
}

//�ק�M�D
function EditZt($add,$userid,$username){
	global $empire,$class_r,$dbtbpre,$loginlevel;
	$add[ztid]=(int)$add[ztid];
	$add[ztpath]=trim($add[ztpath]);
	if(!$add[ztname]||!$add[listtempid]||!$add[ztpath]||!$add[ztid]){
		printerror("EmptyZt","");
	}
	$add=DoPostZtVar($add);
	//CheckLevel($userid,$username,$classid,"zt");
	$returnandlevel=CheckAndUsernamesLevel('dozt',$add[ztid],$userid,$username,$loginlevel);
	$upusernames='';
	if($returnandlevel==2)
	{
		$upusernames=",usernames='$add[usernames]'";
	}
	//���ܥؿ�
	if($add[oldztpath]<>$add[ztpath]){
		$createpath='../../'.$add[ztpath];
		if(file_exists($createpath)){
			printerror("ReZtpath","");
		}
		if($add['oldpripath']==$add['pripath']){
			$new="../../";
			@rename($new.$add[oldztpath],$new.$add[ztpath]);//���ܥؿ��W
		}
		else{
			CreateZtPath($add[ztpath]);//�إ߱M�D�ؿ�
		}
    }
	//���o��W
	$tabler=GetModTable(GetListtempMid($add[listtempid]));
	$tabler[tid]=(int)$tabler[tid];
	$sql=$empire->query("update {$dbtbpre}enewszt set ztname='$add[ztname]',ztnum=$add[ztnum],listtempid=$add[listtempid],ztpath='$add[ztpath]',zttype='$add[zttype]',zturl='$add[zturl]',classid=$add[classid],islist=$add[islist],maxnum=$add[maxnum],reorder='$add[reorder]',intro='$add[intro]',ztimg='$add[ztimg]',zcid=$add[zcid],showzt=$add[showzt],ztpagekey='$add[ztpagekey]',classtempid='$add[classtempid]',myorder=$add[myorder],usezt='$add[usezt]',yhid='$add[yhid]',endtime='$add[endtime]',closepl='$add[closepl]',checkpl='$add[checkpl]',pltempid='$add[pltempid]'".$upusernames." where ztid='$add[ztid]'");
	//�ƪ�
	$ret_zr=ReturnZtAddF($add,1);
	$empire->query("update {$dbtbpre}enewsztadd set classtext='".eaddslashes2($add[classtext])."'".$ret_zr[0]." where ztid='$add[ztid]'");
	//��s�M�D�l��
	if($add['endtime']!=$add['oldendtime'])
	{
		$empire->query("update {$dbtbpre}enewszttype set endtime='$add[endtime]' where ztid='$add[ztid]'");
	}
	//��s����
	UpdateTheFileEditOther(2,$add['ztid'],'other');
	GetClass();//��s�w�s
	//�ͦ�����
	if($add[islist]==0||$add[islist]==2)
	{
		$classtemp=$add[islist]==2?GetZtText($add[ztid]):GetClassTemp($add['classtempid']);
		NewsBq($add[ztid],$classtemp,3,1);
    }
	if($sql)
	{
		$returnurl='special/ListZt.php'.hReturnEcmsHashStrHref2(1);
		if($add['from'])
		{
			$returnurl='special/AddZt.php?enews=EditZt&ztid='.$add[ztid].'&from=1'.hReturnEcmsHashStrHref2(0);
		}
		insert_dolog("ztid=".$add[ztid]."<br>ztname=".$add[ztname]);//�ާ@��x
		printerror("EditZtSuccess",$returnurl);
	}
	else
	{
		printerror("DbError","");
	}
}

//�R���M�D
function DelZt($ztid,$userid,$username){
	global $empire,$dbtbpre;
	$ztid=(int)$ztid;
	if(!$ztid){
		printerror("NotDelZtid","");
	}
	CheckLevel($userid,$username,$classid,"zt");
	$r=$empire->fetch1("select * from {$dbtbpre}enewszt where ztid='$ztid'");
	if(empty($r[ztid])){
		printerror("NotDelZtid","history.go(-1)");
	}
	//�R���M�D
	$sql=$empire->query("delete from {$dbtbpre}enewszt where ztid='$ztid'");
	$empire->query("delete from {$dbtbpre}enewsztadd where ztid='$ztid'");
	$delpath="../../".$r[ztpath];
	$del=DelPath($delpath);
	//�R���M�D�l��
	$zttypesql=$empire->query("select cid from {$dbtbpre}enewszttype where ztid='$ztid'");
	while($zttyper=$empire->fetch($zttypesql))
	{
		$empire->query("delete from {$dbtbpre}enewszttypeadd where cid='$zttyper[cid]'");
	}
	$empire->query("delete from {$dbtbpre}enewszttype where ztid='$ztid'");
	$empire->query("delete from {$dbtbpre}enewsztinfo where ztid='$ztid'");
	//�R������
	DelFileOtherTable("id='$ztid' and modtype=2");
	GetClass();//��s�w�s
	if($sql){
		insert_dolog("ztid=".$ztid."<br>ztname=".$r[ztname]);//�ާ@��x
		printerror("DelZtSuccess","special/ListZt.php".hReturnEcmsHashStrHref2(1));
	}
	else{
		printerror("DbError","");
	}
}

//�զX�M�D
function TogZt($add,$userid,$username){
	global $empire,$class_r,$dbtbpre;
	$ztid=(int)$add['ztid'];
	if(empty($ztid))
	{
		printerror("ErrorUrl","history.go(-1)");
    }
	$r=$empire->fetch1("select ztid,ztname from {$dbtbpre}enewszt where ztid='$ztid'");
	if(empty($r['ztid']))
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$zcid=(int)$add['zcid'];
	$tbname=RepPostVar($add['tbname']);
	if(!$tbname)
	{
		printerror('EmptyTogZt','history.go(-1)');
	}
	$tbr=$empire->fetch1("select tid from {$dbtbpre}enewstable where tbname='$tbname' limit 1");
	if(!$tbr['tid'])
	{
		printerror('EmptyTogZt','history.go(-1)');
	}
	$wheresql="";
	$formvar="";
	//����r
	$keyboard=RepPostVar2($add['keyboard']);
	if($keyboard)
	{
		$formvar.=ReturnFormHidden('keyboard',$add['keyboard']);
		$searchfsql='';
		if($add['stitle'])//���D
		{
			$searchfsql.="title like '%$keyboard%'";
			$formvar.=ReturnFormHidden('stitle',$add['stitle']);
		}
		if($add['susername'])//�W�[��
		{
			if($searchfsql)
			{
				$or=" or ";
			}
			$searchfsql.=$or."username like '%$keyboard%'";
			$formvar.=ReturnFormHidden('susername',$add['susername']);
		}
		if($searchfsql)
		{
			$wheresql=" and (".$searchfsql.")";
		}
	}
	//�O�_����
	if($add['isgood'])
	{
		$wheresql.=" and isgood>0";
		$formvar.=ReturnFormHidden('isgood',$add['isgood']);
	}
	//�Y��
	if($add['firsttitle'])
	{
		$wheresql.=" and firsttitle>0";
		$formvar.=ReturnFormHidden('firsttitle',$add['firsttitle']);
	}
	//�����D�Ϥ�
	if($add['titlepic'])
	{
		$wheresql.=" and ispic=1";
		$formvar.=ReturnFormHidden('titlepic',$add['titlepic']);
	}
	//����ب�s
	$classid=(int)$add['classid'];
    if($classid)
	{
		$formvar.=ReturnFormHidden('classid',$classid);
		if(empty($class_r[$classid][islast]))//�j���
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		else//�׷����
		{
			$where="classid='$classid'";
		}
		$wheresql.=" and (".$where.")";
    }
	$startid=(int)$add[startid];
	$endid=(int)$add[endid];
	$startday=RepPostVar($add[startday]);
	$endday=RepPostVar($add[endday]);
	$formvar.=ReturnFormHidden('retype',$add['retype']);
	//��ID
    if($add['retype'])
	{
		if($endid)
		{
			$wheresql.=" and id>=$startid and id<=$endid";
			$formvar.=ReturnFormHidden('startid',$add[startid]).ReturnFormHidden('endid',$add[endid]);
	    }
    }
    else
	{
		if($startday&&$endday)
		{
			$wheresql.=" and truetime>=".to_time($startday." 00:00:00")." and truetime<=".to_time($endday." 23:59:59");
			$formvar.=ReturnFormHidden('startday',$add[startday]).ReturnFormHidden('endday',$add[endday]);
	    }
    }
	//����sql����
	$query=$add['query'];
	if($query)
	{
		$query=ClearAddsData($query);//�h��adds
		$wheresql.=" and (".$query.")";
		$formvar.=ReturnFormHidden('query',$add['query']);
	}
	if(empty($wheresql))
	{
		printerror('EmptyTogZt','history.go(-1)');
	}
	$wheresql=substr($wheresql,5);
	if($add['doecmszt'])
	{
		$togtype=(int)$add['togtype'];
		if($togtype==1)//�զX�襤
		{
			$add['inid']=eReturnInids($add['inid']);
			$wheresql="id in (".$add['inid'].")";
		}
		else//�ư��襤
		{
			if($add['inid'])
			{
				$add['inid']=eReturnInids($add['inid']);
				$wheresql.=" and id not in (".$add['inid'].")";
			}
		}
		AddMoreInfoToZt($ztid,$zcid,$tbname,$wheresql);
		//�ާ@��x
	    insert_dolog("ztid=$ztid&ztname=$r[ztname]");
		printerror("TogZtSuccess","TogZt.php?ztid=$ztid".hReturnEcmsHashStrHref2(0));
	}
	$re[0]=$wheresql;
	$re[1]=$formvar.ReturnFormHidden('ztid',$ztid).ReturnFormHidden('zcid',$zcid).ReturnFormHidden('tbname',$tbname).ReturnFormHidden('pline',$add[pline]).ReturnFormHidden('doecmszt',$add[doecmszt]).ReturnFormHidden('enews',$add[enews]).ReturnFormHidden('inid',$add[inid]);
	$re[2]=$tbname;
	$re[3]=$r['ztname'];
	return $re;
}

//�O�s�M�D�H��
function SaveTogZtInfo($add,$userid,$username){
	global $empire,$dbtbpre;
	if(!trim($add[togztname]))
	{
		printerror('EmptySaveTogZtname','history.go(-1)');
	}
	$add['doecmszt']=(int)$add['doecmszt'];
	$add[classid]=(int)$add[classid];
	//�j���r�q
	$searchf=',';
	if($add[stitle]==1)
	{
		$searchf.='stitle,';
	}
	if($add[susername]==1)
	{
		$searchf.='susername,';
	}
	if($add[snewstext]==1)
	{
		$searchf.='snewstext,';
	}
	//�S��r�q
	$specialsearch=',';
	if($add[isgood])
	{
		$specialsearch.='isgood,';
	}
	if($add[firsttitle])
	{
		$specialsearch.='firsttitle,';
	}
	if($add[titlepic])
	{
		$specialsearch.='titlepic,';
	}
	$add['retype']=(int)$add['retype'];
	$add['startid']=(int)$add['startid'];
	$add['endid']=(int)$add['endid'];
	$add['pline']=(int)$add['pline'];
	$r=$empire->fetch1("select togid from {$dbtbpre}enewstogzts where togztname='$add[togztname]'");
	if($r[togid])
	{
		$sql=$empire->query("update {$dbtbpre}enewstogzts set keyboard='".eaddslashes($add[keyboard])."',searchf='$searchf',query='".eaddslashes($add[query])."',specialsearch='$specialsearch',classid=$add[classid],retype=$add[retype],startday='".eaddslashes($add[startday])."',endday='".eaddslashes($add[endday])."',startid=$add[startid],endid=$add[endid],pline=$add[pline],doecmszt=$add[doecmszt] where togid='$r[togid]'");
		$togid=$r[togid];
	}
	else
	{
		$sql=$empire->query("insert into {$dbtbpre}enewstogzts(keyboard,searchf,query,specialsearch,classid,retype,startday,endday,startid,endid,pline,doecmszt,togztname) values('".eaddslashes($add[keyboard])."','$searchf','".eaddslashes($add[query])."','$specialsearch',$add[classid],$add[retype],'".eaddslashes($add[startday])."','".eaddslashes($add[endday])."',$add[startid],$add[endid],$add[pline],$add[doecmszt],'".eaddslashes($add[togztname])."');");
		$togid=$empire->lastid();
	}
	if($sql)
	{
		insert_dolog("togid=$togid&togztname=$add[togztname]");//�ާ@��x
		printerror("SaveTogZtInfoSuccess","TogZt.php?ztid=$add[ztid]&togid=$togid".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R���O�s�M�D�H��
function DelTogZtInfo($add,$userid,$username){
	global $empire,$dbtbpre;
	$togid=intval($add[togid]);
	if(!$togid)
	{
		printerror('EmptyDelTogztid','history.go(-1)');
	}
	$r=$empire->fetch1("select togid,togztname from {$dbtbpre}enewstogzts where togid='$togid'");
	if(!$r[togid])
	{
		printerror('EmptyDelTogztid','history.go(-1)');
	}
	$sql=$empire->query("delete from {$dbtbpre}enewstogzts where togid='$togid'");
	if($sql)
	{
		insert_dolog("togid=$togid&togztname=$r[togztname]");//�ާ@��x
		printerror('DelTogZtInfoSuccess',$_SERVER['HTTP_REFERER']);
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}


//************************************ ��� ************************************

//��^�r�q��
function ReturnCFvalue($value)
{
	$value=str_replace("\r\n","|",$value);
	return $value;
}

//���o��ت�椸��html�N�X
function GetClassFform($type,$f,$fvalue,$fformsize=''){
	if($type=="select"||$type=="radio"||$type=="checkbox")
	{
		return GetCFformSelect($type,$f,$fvalue,$fformsize);
	}
	$file="../data/html/classfhtml.txt";
	$data=ReadFiletext($file);
	$exp="[!--".$type."--]";
	$r=explode($exp,$data);
	$string=str_replace("[!--enews.var--]",$f,$r[1]);
	$string=str_replace("[!--enews.def.val--]",$fvalue,$string);
	if($type=='editor')//�s�边
	{
		$editortype='Default';
		$string=str_replace("[!--editor.type--]",$editortype,$string);
		$string=str_replace("[!--editor.basepath--]",'',$string);
	}
	elseif($type=='img'||$type=='flash'||$type=='file')//����
	{
		$string=str_replace("[!--enews.modtype--]",'1',$string);
		$string=str_replace("[!--enews.path--]",'',$string);
	}
	$string=RepCFformSize($f,$string,$type,$fformsize);
	return fAddAddsData($string);
}

//���oselect/radio�����N�X
function GetCFformSelect($type,$f,$fvalue,$fformsize=''){
	$vr=explode("|",$fvalue);
	$count=count($vr);
	$change="";
	$def=':default';
	for($i=0;$i<$count;$i++)
	{
		$val=$vr[$i];
		$isdef="";
		if(strstr($val,$def))
		{
			$dr=explode($def,$val);
			$val=$dr[0];
			$isdef="||\$ecmsfirstpost==1";
		}
		if($type=='select')
		{
			$change.="<option value=\"".$val."\"<?=\$r[".$f."]==\"".$val."\"".$isdef."?' selected':''?>>".$val."</option>";
		}
		elseif($type=='checkbox')
		{
			$change.="<input name=\"".$f."[]\" type=\"checkbox\" value=\"".$val."\"<?=strstr(\$r[".$f."],\"|".$val."|\")".$isdef."?' checked':''?>>".$val;
		}
		else
		{
			$change.="<input name=\"".$f."\" type=\"radio\" value=\"".$val."\"<?=\$r[".$f."]==\"".$val."\"".$isdef."?' checked':''?>>".$val;
		}
	}
	if($type=="select")
	{
		if($fformsize)
		{
			$addsize=' style="width:'.$fformsize.'"';
		}
		$change="<select name=\"".$f."\" id=\"".$f."\"".$addsize.">".$change."</select>";
	}
	return $change;
}

//������椸������
function RepCFformSize($f,$string,$type,$fformsize=''){
	$fformsize=ReturnDefCFformSize($f,$type,$fformsize);
	if($type=='textarea'||$type=='editor')
	{
		$r=explode(',',$fformsize);
		$string=str_replace('[!--fsize.w--]',$r[0],$string);
		$string=str_replace('[!--fsize.h--]',$r[1],$string);
	}
	else
	{
		$string=str_replace('[!--fsize.w--]',$fformsize,$string);
	}
	return $string;
}

//��^�q�{����
function ReturnDefCFformSize($f,$type,$fformsize){
	if(empty($fformsize))
	{
		if($type=='textarea')
		{
			$fformsize='60,10';
		}
		elseif($type=='img')
		{
			$fformsize='45';
		}
		elseif($type=='file')
		{
			$fformsize='45';
		}
		elseif($type=='flash')
		{
			$fformsize='45';
		}
		elseif($type=='date')
		{
			$fformsize='12';
		}
		elseif($type=='color')
		{
			$fformsize='10';
		}
		elseif($type=='linkfield')
		{
			$fformsize='45';
		}
		elseif($type=='downpath')
		{
			$fformsize='45';
		}
		elseif($type=='onlinepath')
		{
			$fformsize='45';
		}
		elseif($type=='editor')
		{
			$fformsize='100%,300';
		}
	}
	return $fformsize;
}

//��s��ت����
function ChangeClassForm(){
	global $empire,$dbtbpre;
	$file='../data/html/classaddform.php';
	$mtemp='';
	$sql=$empire->query("select fname,f,fhtml from {$dbtbpre}enewsclassf order by myorder,fid");
	while($r=$empire->fetch($sql))
	{
		$mtemp.="<tr bgcolor='#FFFFFF' height=25><td>".$r['fname']."</td><td>".$r['fhtml']."</td></tr>";
    }
	$mtemp="<?php
if(!defined('InEmpireCMS'))
{exit();}
?>".$mtemp;
	WriteFiletext($file,$mtemp);
}

//�W�[��ئr�q
function AddClassF($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"classf");
	$add[f]=RepPostVar($add[f]);
	if(empty($add[f])||empty($add[fname]))
	{
		printerror("EmptyF","");
	}
	//�r�q�O�_����
	$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewsclassadd");
	$b=0;
	while($r=$empire->fetch($s))
	{
		if($r[Field]==$add[f])
		{
			$b=1;
			break;
		}
    }
	if($b)
	{
		printerror("ReF","");
	}
	$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewsclass");
	$b=0;
	while($r=$empire->fetch($s))
	{
		if($r[Field]==$add[f])
		{
			$b=1;
			break;
		}
    }
	if($b)
	{
		printerror("ReF","");
	}
	$add[fvalue]=ReturnCFvalue($add[fvalue]);//��l�ƭ�
	//�r�q����
	if($add[ftype]=="TINYINT"||$add[ftype]=="SMALLINT"||$add[ftype]=="INT"||$add[ftype]=="BIGINT"||$add[ftype]=="FLOAT"||$add[ftype]=="DOUBLE")
	{
		$def=" default '0'";
	}
	elseif($add[ftype]=="VARCHAR")
	{
		$def=" default ''";
	}
	else
	{
		$def="";
	}
	$type=$add[ftype];
	//VARCHAR
	if($add[ftype]=='VARCHAR'&&empty($add[flen]))
	{
		$add[flen]='255';
	}
	//�r�q����
	if($add[flen]){
		if($add[ftype]!="TEXT"&&$add[ftype]!="MEDIUMTEXT"&&$add[ftype]!="LONGTEXT"){
			$type.="(".$add[flen].")";
		}
	}
	$field="`".$add[f]."` ".$type." NOT NULL".$def;
	//�s�W�r�q
	$asql=$empire->query("alter table {$dbtbpre}enewsclassadd add ".$field);
	//�����N�X
	$fhtml=GetClassFform($add[fform],$add[f],$add[fvalue],$add[fformsize]);
	if($add[fform]=='select'||$add[fform]=='radio'||$add[fform]=='checkbox')
	{
		$fhtml=str_replace("\$r[","\$addr[",$fhtml);
	}
	//�B�z�ܶq
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("insert into {$dbtbpre}enewsclassf(f,fname,fform,fhtml,fzs,myorder,ftype,flen,fvalue,fformsize) values('$add[f]','$add[fname]','$add[fform]','".eaddslashes2($fhtml)."','".eaddslashes($add[fzs])."',$add[myorder],'$add[ftype]','$add[flen]','".eaddslashes2($add[fvalue])."','$add[fformsize]');");
	$lastid=$empire->lastid();
	//��s���
	ChangeClassForm();
	if($asql&&$sql)
	{
		//�ާ@��x
		insert_dolog("fid=".$lastid."<br>f=".$add[f]);
		printerror("AddFSuccess","info/AddClassF.php?enews=AddClassF".hReturnEcmsHashStrHref2(0));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק���ئr�q
function EditClassF($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"classf");
	$fid=(int)$add['fid'];
	$add[f]=RepPostVar($add[f]);
	$add[oldf]=RepPostVar($add[oldf]);
	if(empty($add[f])||empty($add[fname])||!$fid){
		printerror("EmptyF","history.go(-1)");
	}
	if($add[f]<>$add[oldf]){
		//�r�q�O�_����
		$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewsclassadd");
		$b=0;
		while($r=$empire->fetch($s)){
			if($r[Field]==$add[f]){
				$b=1;
				break;
			}
		}
		if($b){
			printerror("ReF","history.go(-1)");
		}
		$s=$empire->query("SHOW FIELDS FROM {$dbtbpre}enewsclass");
		$b=0;
		while($r=$empire->fetch($s))
		{
			if($r[Field]==$add[f])
			{
				$b=1;
				break;
			}
		}
		if($b)
		{
			printerror("ReF","");
		}
	}
	$add[fvalue]=ReturnCFvalue($add[fvalue]);//��l�ƭ�
	//�r�q����
	if($add[ftype]=="TINYINT"||$add[ftype]=="SMALLINT"||$add[ftype]=="INT"||$add[ftype]=="BIGINT"||$add[ftype]=="FLOAT"||$add[ftype]=="DOUBLE")
	{
		$def=" default '0'";
	}
	elseif($add[ftype]=="VARCHAR")
	{
		$def=" default ''";
	}
	else
	{
		$def="";
	}
	$type=$add[ftype];
	//VARCHAR
	if($add[ftype]=='VARCHAR'&&empty($add[flen]))
	{
		$add[flen]='255';
	}
	//�r�q����
	if($add[flen]){
		if($add[ftype]!="TEXT"&&$add[ftype]!="MEDIUMTEXT"&&$add[ftype]!="LONGTEXT"){
			$type.="(".$add[flen].")";
		}
	}
	$field="`".$add[f]."` ".$type." NOT NULL".$def;
	$usql=$empire->query("alter table {$dbtbpre}enewsclassadd change `".$add[oldf]."` ".$field);
	//�����N�X
	if($add[f]<>$add[oldf]||$add[fform]<>$add[oldfform]||$add[fvalue]<>$add[oldfvalue]||$add[fformsize]<>$add[oldfformsize]){
		$fhtml=GetClassFform($add[fform],$add[f],$add[fvalue],$add[fformsize]);
		if($add[fform]=='select'||$add[fform]=='radio'||$add[fform]=='checkbox')
		{
			$fhtml=str_replace("\$r[","\$addr[",$fhtml);
		}
	}
	else{
		$fhtml=$add[fhtml];
	}
	//�B�z�ܶq
	$add[myorder]=(int)$add[myorder];
	$sql=$empire->query("update {$dbtbpre}enewsclassf set f='$add[f]',fname='$add[fname]',fform='$add[fform]',fhtml='".eaddslashes2($fhtml)."',fzs='".eaddslashes($add[fzs])."',myorder=$add[myorder],ftype='$add[ftype]',flen='$add[flen]',fvalue='".eaddslashes2($add[fvalue])."',fformsize='$add[fformsize]' where fid=$fid");
	//��s���
	ChangeClassForm();
	if($usql&&$sql)
	{
		insert_dolog("fid=".$fid."<br>f=".$add[f]);//�ާ@��x
		printerror("EditFSuccess","info/ListClassF.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�R����ئr�q
function DelClassF($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"classf");
	$fid=(int)$add['fid'];
	if(empty($fid)){
		printerror("EmptyFid","history.go(-1)");
	}
	$r=$empire->fetch1("select f from {$dbtbpre}enewsclassf where fid='$fid'");
	if(!$r[f]){
		printerror("EmptyFid","history.go(-1)");
	}
	$usql=$empire->query("alter table {$dbtbpre}enewsclassadd drop COLUMN `".$r[f]."`");
	$sql=$empire->query("delete from {$dbtbpre}enewsclassf where fid='$fid'");
	//��s����
	ChangeClassForm();
	if($usql&&$sql)
	{
		insert_dolog("fid=".$fid."<br>f=".$r[f]);//�ާ@��x
		printerror("DelFSuccess","info/ListClassF.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//�ק���ئr�q����
function EditClassFOrder($fid,$myorder,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"classf");
	for($i=0;$i<count($myorder);$i++)
	{
		$fid[$i]=(int)$fid[$i];
		$newmyorder=(int)$myorder[$i];
		$usql=$empire->query("update {$dbtbpre}enewsclassf set myorder=$newmyorder where fid='$fid[$i]'");
    }
	//��s����
	ChangeClassForm();
	printerror("EditFOrderSuccess","info/ListClassF.php".hReturnEcmsHashStrHref2(1));
}

//��^��ئr�q
function ReturnClassAddF($add,$ecms=0){
	global $empire,$dbtbpre;
	$ret_r[0]='';
	$ret_r[1]='';
	$fsql=$empire->query("select f from {$dbtbpre}enewsclassf");
	if($ecms==0)//�W�[
	{
		while($fr=$empire->fetch($fsql))
		{
			$f=$fr['f'];
			$fval=$add[$f];
			$fval=RepPhpAspJspcode($fval);
			$ret_r[0].=",`".$f."`";
			$ret_r[1].=",'".AddAddsData($fval)."'";
		}
	}
	else//�ק�
	{
		while($fr=$empire->fetch($fsql))
		{
			$f=$fr['f'];
			$fval=$add[$f];
			$fval=RepPhpAspJspcode($fval);
			$ret_r[0].=",`".$f."`='".AddAddsData($fval)."'";
		}
	}
	return $ret_r;
}


//�զX���ͦ�����ثH��
function TogNotReClass($changecache=0){
	global $empire,$dbtbpre;
	$sql=$empire->query("select classid,nreclass,nreinfo,nrejs,nottobq from {$dbtbpre}enewsclass where nreclass=1 or nreinfo=1 or nrejs=1 or nottobq=1");
	$nreclass=',';
	$nreinfo=',';
	$nrejs=',';
	$nottobq=',';
	while($r=$empire->fetch($sql))
	{
		if($r['nreclass']==1)
		{
			$nreclass.=$r['classid'].',';
		}
		if($r['nreinfo']==1)
		{
			$nreinfo.=$r['classid'].',';
		}
		if($r['nrejs']==1)
		{
			$nrejs.=$r['classid'].',';
		}
		if($r['nottobq']==1)
		{
			$nottobq.=$r['classid'].',';
		}
	}
	$empire->query("update {$dbtbpre}enewspublic set nreclass='$nreclass',nreinfo='$nreinfo',nrejs='$nrejs',nottobq='$nottobq' limit 1");
	if($changecache==1)
	{
		GetConfig();
	}
}

//��^��Z�v��
function DoPostClassQAddGroupid($groupid){
	$count=count($groupid);
	if(!$count)
	{
		return '';
	}
	$qg=',';
	for($i=0;$i<$count;$i++)
	{
		$groupid[$i]=(int)$groupid[$i];
		$qg.=$groupid[$i].',';
	}
	return $qg;
}

//�B�z��ش����ܶq
function DoPostClassVar($add){
	if(empty($add[classtype])){
		$add[classtype]=".html";
	}
	$add[classname]=eaddslashes(ehtmlspecialchars($add[classname]));
	$add[intro]=eaddslashes(RepPhpAspJspcode($add[intro]));
	$add[classpagekey]=eaddslashes(RepPhpAspJspcode($add[classpagekey]));
	//�L�o�r��
	$add[listorder]=RepPostVar2($add[listorder]);
	$add[reorder]=RepPostVar2($add[reorder]);
	//�B�z�ܶq
	$add[jstempid]=(int)$add['jstempid'];
	$add[bclassid]=(int)$add[bclassid];
	$add[link_num]=(int)$add[link_num];
	$add[newstempid]=(int)$add[newstempid];
	$add[islast]=(int)$add[islast];
	$add[filename]=(int)$add[filename];
	$add[openpl]=(int)$add[openpl];
	$add[openadd]=(int)$add[openadd];
	$add[newline]=(int)$add[newline];
	$add[hotline]=(int)$add[hotline];
	$add[goodline]=(int)$add[goodline];
	$add[groupid]=(int)$add[groupid];
	$add[hotplline]=(int)$add[hotplline];
	$add[modid]=(int)$add[modid];
	$add[checked]=(int)$add[checked];
	$add[firstline]=(int)$add[firstline];
	$add[islist]=(int)$add[islist];
	$add[searchtempid]=(int)$add[searchtempid];
	$add[checkpl]=(int)$add[checkpl];
	$add[down_num]=(int)$add[down_num];
	if(empty($add[down_num])){
		$add[down_num]=1;
	}
	$add[online_num]=(int)$add[online_num];
	if(empty($add[online_num])){
		$add[online_num]=1;
	}
	$add[addinfofen]=(int)$add[addinfofen];
	$add[listdt]=(int)$add[listdt];
	$add[showdt]=(int)$add[showdt];
	$add[maxnum]=(int)$add[maxnum];
	$add[showclass]=(int)$add[showclass];
	$add[checkqadd]=(int)$add[checkqadd];
	$add[qaddlist]=(int)$add[qaddlist];
	$add[qaddgroupid]=DoPostClassQAddGroupid($add[qaddgroupidck]);
	if(!$add[qaddgroupid])
	{
		$add[addinfofen]=0;
	}
	$add[qaddshowkey]=(int)$add[qaddshowkey];
	$add[adminqinfo]=(int)$add[adminqinfo];
	$add[doctime]=(int)$add[doctime];
	$add[nreclass]=(int)$add[nreclass];
	$add[nreinfo]=(int)$add[nreinfo];
	$add[nrejs]=(int)$add[nrejs];
	$add[nottobq]=(int)$add[nottobq];
	$add[lencord]=(int)$add[lencord];
	$add[listtempid]=(int)$add[listtempid];
	$add[dtlisttempid]=(int)$add[dtlisttempid];
	$add[classtempid]=(int)$add[classtempid];
	if(empty($add[bname])){
		$add[bname]=$add[classname];
	}
	$add[myorder]=(int)$add[myorder];
	if($add[infopath]==0)
	{
		$add[ipath]='';
	}
	$add[addreinfo]=(int)$add[addreinfo];
	$add[haddlist]=(int)$add[haddlist];
	$add[sametitle]=(int)$add[sametitle];
	$add[definfovoteid]=(int)$add[definfovoteid];
	$add[qeditchecked]=(int)$add[qeditchecked];
	$add[wapstyleid]=(int)$add[wapstyleid];
	$add[repreinfo]=(int)$add[repreinfo];
	$add[pltempid]=(int)$add[pltempid];
	$add[classtext]=RepPhpAspJspcode($add[classtext]);
	$add[yhid]=(int)$add[yhid];
	$add[wfid]=(int)$add[wfid];
	$add['repagenum']=(int)$add['repagenum'];
	$add['keycid']=(int)$add['keycid'];
	$add['filepass']=(int)$add['filepass'];
	$add[pripath]=eaddslashes($add[pripath]);
	$add[classpath]=eaddslashes($add[classpath]);
	if($add['islist']==3)
	{
		$add['bdinfoid']=RepPostVar($add['bdinfoid']);
	}
	else
	{
		$add['bdinfoid']='';
	}
	if($add[islast]&&$add['smallbdinfoid'])
	{
		$add['smallbdinfoid']=RepPostVar($add['smallbdinfoid']);
	}
	else
	{
		$add['smallbdinfoid']='';
	}
	//�]�m�X���v��
	$add[cgroupid]=DoPostClassQAddGroupid($add[cgroupidck]);
	$add[cgtoinfo]=(int)$add[cgtoinfo];
	if($add[cgroupid])
	{
		$add[classtype]='.php';
		if($add[cgtoinfo])
		{
			$add[filetype]='.php';
		}
	}
	else
	{
		$add[cgtoinfo]=0;
	}
	return $add;
}

//�W�[�~�����
function AddWbClass($add,$userid,$username){
	global $empire,$dbtbpre;
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,"class");
	$add=DoPostClassVar($add);
	if(!$add[classname]||!$add[wburl])
	{
		printerror("EmptyWbClass","");
	}
	$add[islast]=0;
	$addtime=time();
	//���o��W
	$tabler=GetModTable($add[modid]);
	$tabler[tid]=(int)$tabler[tid];
	if(empty($add[bclassid]))//�D���
	{
		$sonclass="";
		$featherclass="";
	}
	else//�������
	{
		//���o�W�@�Ť����
		$r=$empire->fetch1("select featherclass,islast,wburl from {$dbtbpre}enewsclass where classid='$add[bclassid]'");
		if($r[islast])//�O�_�׷����
		{
			printerror("BclassNotLast","");
		}
		if($r[wburl])
		{
			printerror("BclassNotWb","");
		}
		if(empty($r[featherclass]))
		{
			$r[featherclass]="|";
		}
		$featherclass=$r[featherclass].$add[bclassid]."|";
		$sonclass="";
	}
	$sql=$empire->query("insert into {$dbtbpre}enewsclass(bclassid,classname,is_zt,sonclass,lencord,link_num,newstempid,onclick,listtempid,featherclass,islast,classpath,classtype,newspath,filename,filetype,openpl,openadd,newline,hotline,goodline,classurl,groupid,myorder,filename_qz,hotplline,modid,checked,firstline,bname,islist,searchtempid,tid,tbname,maxnum,checkpl,down_num,online_num,listorder,reorder,intro,classimg,jstempid,addinfofen,listdt,showclass,showdt,checkqadd,qaddlist,qaddgroupid,qaddshowkey,adminqinfo,doctime,classpagekey,dtlisttempid,classtempid,nreclass,nreinfo,nrejs,nottobq,ipath,addreinfo,haddlist,sametitle,definfovoteid,wburl,qeditchecked,wapstyleid,repreinfo,pltempid,cgroupid,yhid,wfid,cgtoinfo,bdinfoid,repagenum,keycid,addtime) values($add[bclassid],'$add[classname]',0,'$sonclass',$add[lencord],$add[link_num],$add[newstempid],0,$add[listtempid],'$featherclass',$add[islast],'$classpath','$add[classtype]','$add[newspath]',$add[filename],'$add[filetype]',$add[openpl],$add[openadd],$add[newline],$add[hotline],$add[goodline],'$add[classurl]',$add[groupid],$add[myorder],'$add[filename_qz]',$add[hotplline],$add[modid],$add[checked],$add[firstline],'$add[bname]',$add[islist],$add[searchtempid],$tabler[tid],'$tabler[tbname]',$add[maxnum],$add[checkpl],$add[down_num],$add[online_num],'$add[listorder]','$add[reorder]','$add[intro]','$add[classimg]',$add[jstempid],$add[addinfofen],$add[listdt],$add[showclass],$add[showdt],$add[checkqadd],$add[qaddlist],'$add[qaddgroupid]',$add[qaddshowkey],$add[adminqinfo],$add[doctime],'$add[classpagekey]','$add[dtlisttempid]','$add[classtempid]',$add[nreclass],$add[nreinfo],$add[nrejs],$add[nottobq],'$add[ipath]',$add[addreinfo],$add[haddlist],$add[sametitle],$add[definfovoteid],'$add[wburl]',$add[qeditchecked],$add[wapstyleid],'$add[repreinfo]','$add[pltempid]','$add[cgroupid]','$add[yhid]','$add[wfid]','$add[cgtoinfo]','$add[bdinfoid]','$add[repagenum]','$add[keycid]','$addtime');");
	$lastid=$empire->lastid();
	//�ƪ�
	$ret_cr=ReturnClassAddF($add,0);
	$empire->query("replace into {$dbtbpre}enewsclassadd(classid,classtext".$ret_cr[0].") values('$lastid','".eaddslashes2($add[classtext])."'".$ret_cr[1].");");
	//�έp��
	$empire->query("replace into {$dbtbpre}enewsclass_stats(classid) values('$lastid');");
	//��s����
	UpdateTheFileOther(1,$lastid,$add['filepass'],'other');
	GetClass();
	//DelListEnews();//�R���w�s���
	if($sql)
	{
		//�R���ɯ�w�s
		$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass'");
		$cache_enews='doclass';
		$cache_ecmstourl=urlencode("AddClass.php?enews=AddClass&from=".ehtmlspecialchars($add[from]).hReturnEcmsHashStrHref2(0));
		$cache_mess='AddClassSuccess';
		$cache_url="CreateCache.php?enews=$cache_enews&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
		insert_dolog("classid=".$lastid."<br>classname=".$add[classname]);//�ާ@��x
		//printerror("AddClassSuccess","AddClass.php?enews=AddClass&from=".ehtmlspecialchars($add[from]).hReturnEcmsHashStrHref2(0));
		echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
		db_close();
		$empire=null;
		exit();
	}
	else
	{
		printerror("DbError","");
	}
}

//�W�[���
function AddClass($add,$userid,$username){
	global $empire,$dbtbpre;
	//�W�[�~�����
	if($add[ecmsclasstype])
	{
		AddWbClass($add,$userid,$username);
	}
	$add[classpath]=trim($add[classpath]);
	if(!$add[classname]||!$add[classpath]||!$add[modid])
	{
		printerror("EmptyClass","");
	}
	if($add[islast]&&(!$add[newstempid]||!$add[listtempid]))
	{
		printerror("LastMustChange","");
	}
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,"class");
	$add=DoPostClassVar($add);
	//�ؿ��w�s�b
	if(strstr($add[classpath],".")||strstr($add[classpath],"/")||strstr($add[classpath],"\\"))
	{
		printerror("badpath","");
	}
	$classpath=$add[pripath].$add[classpath];
	if(file_exists("../../".$classpath))
	{
		printerror("ReClasspath","");
	}
	$addtime=time();
	//���o��W
	$tabler=GetModTable($add[modid]);
	$tabler[tid]=(int)$tabler[tid];
	//�W�[�j���
	if(!$add[islast])
	{
		if(empty($add[bclassid]))//�D���
		{
			$sonclass="";
			$featherclass="";
	    }
		else//�������
		{
			//���o�W�@�Ť����
			$r=$empire->fetch1("select featherclass,islast,wburl from {$dbtbpre}enewsclass where classid='$add[bclassid]'");
			if($r[islast])//�O�_�׷����
			{
				printerror("BclassNotLast","");
			}
			if($r[wburl])
			{
				printerror("BclassNotWb","");
			}
			if(empty($r[featherclass]))
			{
				$r[featherclass]="|";
			}
			$featherclass=$r[featherclass].$add[bclassid]."|";
			$sonclass="";
	    }
		//�إߥؿ�
		CreateClassPath($classpath);
		$sql=$empire->query("insert into {$dbtbpre}enewsclass(bclassid,classname,is_zt,sonclass,lencord,link_num,newstempid,onclick,listtempid,featherclass,islast,classpath,classtype,newspath,filename,filetype,openpl,openadd,newline,hotline,goodline,classurl,groupid,myorder,filename_qz,hotplline,modid,checked,firstline,bname,islist,searchtempid,tid,tbname,maxnum,checkpl,down_num,online_num,listorder,reorder,intro,classimg,jstempid,addinfofen,listdt,showclass,showdt,checkqadd,qaddlist,qaddgroupid,qaddshowkey,adminqinfo,doctime,classpagekey,dtlisttempid,classtempid,nreclass,nreinfo,nrejs,nottobq,ipath,addreinfo,haddlist,sametitle,definfovoteid,wburl,qeditchecked,wapstyleid,repreinfo,pltempid,cgroupid,yhid,wfid,cgtoinfo,bdinfoid,repagenum,keycid,addtime) values($add[bclassid],'$add[classname]',0,'$sonclass',$add[lencord],$add[link_num],$add[newstempid],0,$add[listtempid],'$featherclass',$add[islast],'$classpath','$add[classtype]','$add[newspath]',$add[filename],'$add[filetype]',$add[openpl],$add[openadd],$add[newline],$add[hotline],$add[goodline],'$add[classurl]',$add[groupid],$add[myorder],'$add[filename_qz]',$add[hotplline],$add[modid],$add[checked],$add[firstline],'$add[bname]',$add[islist],$add[searchtempid],$tabler[tid],'$tabler[tbname]',$add[maxnum],$add[checkpl],$add[down_num],$add[online_num],'$add[listorder]','$add[reorder]','$add[intro]','$add[classimg]',$add[jstempid],$add[addinfofen],$add[listdt],$add[showclass],$add[showdt],$add[checkqadd],$add[qaddlist],'$add[qaddgroupid]',$add[qaddshowkey],$add[adminqinfo],$add[doctime],'$add[classpagekey]','$add[dtlisttempid]','$add[classtempid]',$add[nreclass],$add[nreinfo],$add[nrejs],$add[nottobq],'$add[ipath]',$add[addreinfo],$add[haddlist],$add[sametitle],$add[definfovoteid],'',$add[qeditchecked],$add[wapstyleid],'$add[repreinfo]','$add[pltempid]','$add[cgroupid]','$add[yhid]','$add[wfid]','$add[cgtoinfo]','$add[bdinfoid]','$add[repagenum]','$add[keycid]','$addtime');");
		$lastid=$empire->lastid();
		//�ƪ�
		$ret_cr=ReturnClassAddF($add,0);
		$empire->query("replace into {$dbtbpre}enewsclassadd(classid,classtext".$ret_cr[0].") values('$lastid','".eaddslashes2($add[classtext])."'".$ret_cr[1].");");
		//�έp��
		$empire->query("replace into {$dbtbpre}enewsclass_stats(classid) values('$lastid');");
		//��s����
		UpdateTheFileOther(1,$lastid,$add['filepass'],'other');
		TogNotReClass(1);
		GetClass();
		if($add[islist]==0||$add[islist]==2)
		{
			$classtemp=$add[islist]==2?GetClassText($lastid):GetClassTemp($add['classtempid']);
			NewsBq($lastid,$classtemp,0,1);
		}
		elseif($add[islist]==3)//��ظj�w�H��
		{
			ReClassBdInfo($lastid);
		}
		DelListEnews();//�R���w�s���
		//GetSearch($add[modid]);//��s�w�s
		if($sql)
		{
			//�R���ɯ�w�s
			$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or (navtype='modclass' and modid='$add[modid]')");
			DelFiletext("../d/js/js/addinfo".$add[modid].".js");
			$cache_enews='doclass,doinfo,domod,dostemp';
			$cache_ecmstourl=urlencode("AddClass.php?enews=AddClass&from=".ehtmlspecialchars($add[from]).hReturnEcmsHashStrHref2(0));
			$cache_mess='AddClassSuccess';
			$cache_mid=$add[modid];
			$cache_url="CreateCache.php?enews=$cache_enews&mid=$cache_mid&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
			insert_dolog("classid=".$lastid."<br>classname=".$add[classname]);//�ާ@��x
			//printerror("AddClassSuccess","AddClass.php?enews=AddClass&from=".ehtmlspecialchars($add[from]).hReturnEcmsHashStrHref2(0));
			echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
			db_close();
			$empire=null;
			exit();
		}
		else
		{
			printerror("DbError","");
		}
    }
	//�W�[�ׯ����
	else
	{
		//���e��
		$add[filename_qz]=RepFilenameQz($add[filename_qz]);
		if(empty($add[bclassid]))//�D���O���ׯ���خ�
		{
			$sonclass="";
			$featherclass="";
	    }
		else//�l���
		{
			//���o�W�@�Ť����
			$r=$empire->fetch1("select featherclass,islast,wburl from {$dbtbpre}enewsclass where classid='$add[bclassid]'");
			//�O�_�׷����O
			if($r[islast])
			{
				printerror("BclassNotLast","");
			}
			if($r[wburl])
			{
				printerror("BclassNotWb","");
			}
			if(empty($r[featherclass])){
				$r[featherclass]="|";
			}
			$featherclass=$r[featherclass].$add[bclassid]."|";
			$sonclass="";
		}
		//�إ���إؿ�
		CreateClassPath($classpath);
		$sql=$empire->query("insert into {$dbtbpre}enewsclass(bclassid,classname,sonclass,is_zt,lencord,link_num,newstempid,onclick,listtempid,featherclass,islast,classpath,classtype,newspath,filename,filetype,openpl,openadd,newline,hotline,goodline,classurl,groupid,myorder,filename_qz,hotplline,modid,checked,firstline,bname,islist,searchtempid,tid,tbname,maxnum,checkpl,down_num,online_num,listorder,reorder,intro,classimg,jstempid,addinfofen,listdt,showclass,showdt,checkqadd,qaddlist,qaddgroupid,qaddshowkey,adminqinfo,doctime,classpagekey,dtlisttempid,classtempid,nreclass,nreinfo,nrejs,nottobq,ipath,addreinfo,haddlist,sametitle,definfovoteid,wburl,qeditchecked,wapstyleid,repreinfo,pltempid,cgroupid,yhid,wfid,cgtoinfo,bdinfoid,repagenum,keycid,addtime) values($add[bclassid],'$add[classname]','$sonclass',0,$add[lencord],$add[link_num],$add[newstempid],0,$add[listtempid],'$featherclass',$add[islast],'$classpath','$add[classtype]','$add[newspath]',$add[filename],'$add[filetype]',$add[openpl],$add[openadd],$add[newline],$add[hotline],$add[goodline],'$add[classurl]',$add[groupid],$add[myorder],'$add[filename_qz]',$add[hotplline],$add[modid],$add[checked],$add[firstline],'$add[bname]',$add[islist],$add[searchtempid],$tabler[tid],'$tabler[tbname]',$add[maxnum],$add[checkpl],$add[down_num],$add[online_num],'$add[listorder]','$add[reorder]','$add[intro]','$add[classimg]',$add[jstempid],$add[addinfofen],$add[listdt],$add[showclass],$add[showdt],$add[checkqadd],$add[qaddlist],'$add[qaddgroupid]',$add[qaddshowkey],$add[adminqinfo],$add[doctime],'$add[classpagekey]','$add[dtlisttempid]','$add[classtempid]',$add[nreclass],$add[nreinfo],$add[nrejs],$add[nottobq],'$add[ipath]',$add[addreinfo],$add[haddlist],$add[sametitle],$add[definfovoteid],'',$add[qeditchecked],$add[wapstyleid],'$add[repreinfo]','$add[pltempid]','$add[cgroupid]','$add[yhid]','$add[wfid]','$add[cgtoinfo]','$add[smallbdinfoid]','$add[repagenum]','$add[keycid]','$addtime');");
		$lastid=$empire->lastid();
		//�ƪ�
		$ret_cr=ReturnClassAddF($add,0);
		$empire->query("replace into {$dbtbpre}enewsclassadd(classid,classtext".$ret_cr[0].") values('$lastid','".eaddslashes2($add[classtext])."'".$ret_cr[1].");");
		//�έp��
		$empire->query("replace into {$dbtbpre}enewsclass_stats(classid) values('$lastid');");
		//�ק����ت��l���
		if($add[bclassid])
		{
			$b_r=$empire->fetch1("select sonclass,featherclass from {$dbtbpre}enewsclass where classid='$add[bclassid]'");
			if(empty($b_r[sonclass]))
			{
				$b_r[sonclass]="|";
			}
			$new_sonclass=$b_r[sonclass].$lastid."|";
			$update=$empire->query("update {$dbtbpre}enewsclass set sonclass='$new_sonclass' where classid='$add[bclassid]'");
			//�������O������ت��l���
			$where=ReturnClass($b_r[featherclass]);
			if(empty($where)){
				$where="classid=0";
			}
			$bsql=$empire->query("select sonclass,classid from {$dbtbpre}enewsclass where ".$where);
			while($br=$empire->fetch($bsql))
			{
				if(empty($br[sonclass]))
				{
					$br[sonclass]="|";
				}
				$new_sonclass=$br[sonclass].$lastid."|";
				$update=$empire->query("update {$dbtbpre}enewsclass set sonclass='$new_sonclass' where classid='$br[classid]'");
            }
	    }
		//��s����
		UpdateTheFileOther(1,$lastid,$add['filepass'],'other');
		DelListEnews();//�R���w�s���
		TogNotReClass(1);
		GetClass();
		//GetSearch($add[modid]);//��s�w�s
		if($sql)
		{
			//�R���ɯ�w�s
			$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or (navtype='modclass' and modid='$add[modid]')");
			DelFiletext("../d/js/js/addinfo".$add[modid].".js");
			$cache_enews='doclass,doinfo,domod,dostemp';
			$cache_ecmstourl=urlencode("AddClass.php?enews=AddClass&from=".ehtmlspecialchars($add[from]).hReturnEcmsHashStrHref2(0));
			$cache_mess='AddLastClassSuccess';
			$cache_mid=$add[modid];
			$cache_url="CreateCache.php?enews=$cache_enews&mid=$cache_mid&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
			insert_dolog("classid=".$lastid."<br>classname=".$add[classname]);//�ާ@��x
			//printerror("AddLastClassSuccess","AddClass.php?enews=AddClass&from=".ehtmlspecialchars($add[from]).hReturnEcmsHashStrHref2(0));
			echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
			db_close();
			$empire=null;
			exit();
		}
		else
		{
			printerror("DbError","history.go(-1)");
		}
    }
}

//�j�w��W���Ω�l���
function UpdateSmallClassDomain($classid,$classurl,$classpath){
	global $empire,$dbtbpre;
	if(empty($classurl)){
		$query="update {$dbtbpre}enewsclass set classurl='' where featherclass like '%|".$classid."|%'";
    }
	else{
		$query="update {$dbtbpre}enewsclass set classurl=CONCAT('".$classurl."',SUBSTRING(classpath,LENGTH('".$classpath."')+1)) where featherclass like '%|".$classid."|%'";
    }
	$sql=$empire->query($query);
}

//��إؿ��ק�
function AlterClassPath($classid,$islast,$oldclasspath,$classpath){
	global $empire,$dbtbpre;
	//��s�ؿ��W
	if($oldclasspath!=$classpath)
	{
		@rename("../../".$oldclasspath,"../../".$classpath);
		@rename("../../d/file/".$oldclasspath,"../../d/file/".$classpath);
		if(empty($islast))
		{
			$sql=$empire->query("update {$dbtbpre}enewsclass set classpath=REPLACE(classpath,'".$oldclasspath."/','".$classpath."/') where featherclass like '%|".$classid."|%'");
		}
		DelListEnews();
	}
}

//�ק�~�����
function EditWbClass($add,$userid,$username){
	global $empire,$class_r,$dbtbpre;
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,"class");
	$add=DoPostClassVar($add);
	$add[classid]=(int)$add[classid];
	if(!$add[classname]||!$add[classid]||!$add[wburl])
	{
		printerror("EmptyWbClass","");
	}
	$add[islast]=0;
	//���o��W
	$tabler=GetModTable($add[modid]);
	$tabler[tid]=(int)$tabler[tid];
	//���ܤj���
	if($add[bclassid]<>$add[oldbclassid])
	{
		//���D���
		if(empty($add[bclassid]))
		{
			$sonclass="";
			$featherclass="";
		}
		//��줤�����
		else
		{
			//�j��ظ����جۦP
			if($add[classid]==$add[bclassid])
			{
				printerror("BclassIsself","");
			}
			//���o�{�b�j��ت���
	 		$b=$empire->fetch1("select featherclass,sonclass,islast,wburl from {$dbtbpre}enewsclass where classid='$add[bclassid]'");
			//�˴��j��جO�_���ׯ����
			if($b[islast])
			{
				printerror("BclassNotLast","");
			}
			if($b[wburl])
			{
				printerror("BclassNotWb","");
			}
			//�O�_�D�k�����
			if($b[featherclass])
			{
				$c_nb_r=explode("|".$add[classid]."|",$b[featherclass]);
				if(count($c_nb_r)<>1)
				{
					printerror("BclassIssmall","");
				}
			}
			if(empty($b[featherclass]))
			{
				$b[featherclass]="|";
			}
			$featherclass=$b[featherclass].$add[bclassid]."|";
		}
		$change=",bclassid=$add[bclassid],featherclass='$featherclass'";
	}
	//�ק�ƾڮw���
	$sql=$empire->query("update {$dbtbpre}enewsclass set classname='$add[classname]',classpath='$classpath',classtype='$add[classtype]',newline=$add[newline],hotline=$add[hotline],goodline=$add[goodline],classurl='$add[classurl]',groupid=$add[groupid],myorder=$add[myorder],filename_qz='$add[filename_qz]',hotplline=$add[hotplline],modid=$add[modid],checked=$add[checked],firstline=$add[firstline],bname='$add[bname]',islist=$add[islist],listtempid=$add[listtempid],lencord=$add[lencord],searchtempid=$add[searchtempid],tid=$tabler[tid],tbname='$tabler[tbname]',maxnum=$add[maxnum],checkpl=$add[checkpl],down_num=$add[down_num],online_num=$add[online_num],listorder='$add[listorder]',reorder='$add[reorder]',intro='$add[intro]',classimg='$add[classimg]',jstempid=$add[jstempid],listdt=$add[listdt],showclass=$add[showclass],showdt=$add[showdt],qaddgroupid='$add[qaddgroupid]',qaddshowkey=$add[qaddshowkey],adminqinfo=$add[adminqinfo],doctime=$add[doctime],classpagekey='$add[classpagekey]',dtlisttempid='$add[dtlisttempid]',classtempid='$add[classtempid]',nreclass=$add[nreclass],nreinfo=$add[nreinfo],nrejs=$add[nrejs],nottobq=$add[nottobq],ipath='$add[ipath]',addreinfo=$add[addreinfo],haddlist=$add[haddlist],sametitle=$add[sametitle],definfovoteid=$add[definfovoteid],wburl='$add[wburl]',qeditchecked=$add[qeditchecked],openadd=$add[openadd],wapstyleid='$add[wapstyleid]',repreinfo='$add[repreinfo]',pltempid='$add[pltempid]',cgroupid='$add[cgroupid]',yhid='$add[yhid]',wfid='$add[wfid]',cgtoinfo='$add[cgtoinfo]',bdinfoid='$add[bdinfoid]',repagenum='$add[repagenum]',keycid='$add[keycid]'".$change." where classid='$add[classid]'");
	//�ƪ�
	$ret_cr=ReturnClassAddF($add,1);
	$empire->query("update {$dbtbpre}enewsclassadd set classtext='".eaddslashes2($add[classtext])."'".$ret_cr[0]." where classid='$add[classid]'");
	//��s����
	UpdateTheFileEditOther(1,$add['classid'],'other');
	GetClass();
	//�R���w�s���
	$updatecache=0;
	if($add[oldclassname]<>$add[classname]||$add[bclassid]<>$add[oldbclassid]||$add[wburl]<>$add[oldwburl])
	{
		//DelListEnews();
		$updatecache=1;
    }
	//�ӷ�
	if($add['from'])
	{
		$returnurl="ListPageClass.php";
	}
	else
	{
		$returnurl="ListClass.php";
	}
	if($sql)
	{
		insert_dolog("classid=".$add[classid]."<br>classname=".$add[classname]);//�ާ@��x
		if($updatecache)
		{
			//�R���ɯ�w�s
			$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass'");
			$cache_enews='doclass';
			$cache_ecmstourl=$returnurl.urlencode(hReturnEcmsHashStrHref2(1));
			$cache_mess='EditClassSuccess';
			$cache_url="CreateCache.php?enews=$cache_enews&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
			echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
			db_close();
			$empire=null;
			exit();
		}
		printerror("EditClassSuccess",$returnurl.hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�ק����
function EditClass($add,$userid,$username){
	global $empire,$class_r,$dbtbpre;
	//�ק�~�����
	if($add[ecmsclasstype])
	{
		EditWbClass($add,$userid,$username);
	}
	$add[classid]=(int)$add[classid];
	$add[classpath]=trim($add[classpath]);
	$checkclasspath=$add['classpath'];
	if($add['oldclasspath']<>$add['pripath'].$add['oldcpath'])//�󴫤����
	{
		$add[classpath]=$add['oldcpath'];
	}
	if(!$add[classname]||!$add[classpath]||!$add[modid]||!$add[classid]){
		printerror("EmptyClass","");
	}
	if($add[islast]&&(!$add[newstempid]||!$add[listtempid])){
		printerror("LastMustChange","");
	}
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,"class");
	$add=DoPostClassVar($add);
	$add[oldmodid]=(int)$add[oldmodid];
	//���ܥؿ�
	$classpath=$add[pripath].$add[classpath];
	if($add[oldclasspath]<>$classpath&&$checkclasspath==$add['oldcpath']){
		if(file_exists("../../".$classpath)){//�˴��ؿ��O�_�s�b
			printerror("ReClasspath","");
		}
    }
	//���o��W
	$tabler=GetModTable($add[modid]);
	$tabler[tid]=(int)$tabler[tid];
	//�ק�j���
	if(!$add[islast]){
		//���ܤj���
		if($add[bclassid]<>$add[oldbclassid]){
			//���D���
			if(empty($add[bclassid])){
				$sonclass="";
				$featherclass="";
				//���o����ت��l���
				$r=$empire->fetch1("select sonclass,featherclass,classpath from {$dbtbpre}enewsclass where classid='$add[classid]'");
				//���ܤ���ت��l���
				$where=ReturnClass($r[featherclass]);
				if(empty($where)){
					$where="classid=0";
				}
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}enewsclass where ".$where);
				while($o=$empire->fetch($osql)){
					$newsonclass=str_replace($r[sonclass],"|",$o[sonclass]);
					$uosql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$o[classid]'");
				}
				//�ק�l��ت������
				$osql=$empire->query("select featherclass,classid,classpath from {$dbtbpre}enewsclass where featherclass like '%|".$add[classid]."%|'");
				while($o=$empire->fetch($osql)){
					$newclasspath=str_replace($r[classpath]."/",$classpath."/",$o[classpath]);
					$newfeatherclass=str_replace($r[featherclass],"|",$o[featherclass]);
					$uosql=$empire->query("update {$dbtbpre}enewsclass set featherclass='$newfeatherclass',classpath='$newclasspath' where classid='$o[classid]'");
				}
			}
			//��줤�����
			else
			{
				//�j��ظ����جۦP
				if($add[classid]==$add[bclassid]){
				  printerror("BclassIsself","");
				}
				//���o�{�b�j��ت���
	 			$b=$empire->fetch1("select featherclass,sonclass,islast,wburl from {$dbtbpre}enewsclass where classid='$add[bclassid]'");
				//�˴��j��جO�_���ׯ����
				if($b[islast])
				{
					printerror("BclassNotLast","");
				}
				if($b[wburl])
				{
					printerror("BclassNotWb","");
				}
				//�O�_�D�k�����
				if($b[featherclass]){
					$c_nb_r=explode("|".$add[classid]."|",$b[featherclass]);
					if(count($c_nb_r)<>1){
						printerror("BclassIssmall","");
					}
				}
				if(empty($b[featherclass])){
					$b[featherclass]="|";
				}
				$featherclass=$b[featherclass].$add[bclassid]."|";
				//���o�{�b��إ�������
				$o=$empire->fetch1("select featherclass,sonclass,classpath from {$dbtbpre}enewsclass where classid='$add[classid]'");
				//�ק�l��ت������
				$osql=$empire->query("select featherclass,classid,classpath from {$dbtbpre}enewsclass where featherclass like '%|".$add[classid]."|%'");
				while($or=$empire->fetch($osql)){
					$newclasspath=str_replace($o[classpath]."/",$classpath."/",$or[classpath]);
					if(empty($o[featherclass])){
						$newfeatherclass=$b[featherclass].$add[bclassid].$or[featherclass];
					}
					else{
						$newfeatherclass=str_replace($o[featherclass],$featherclass,$or[featherclass]);
					}
					$uosql=$empire->query("update {$dbtbpre}enewsclass set featherclass='$newfeatherclass',classpath='$newclasspath' where classid='$or[classid]'");
				}
				//�����¤j��ت��Ҧ��l���
				$owhere=ReturnClass($o[featherclass]);
				if(empty($owhere)){
					$owhere="classid=0";
				}
				$oosql=$empire->query("select sonclass,classid from {$dbtbpre}enewsclass where ".$owhere);
				while($oo=$empire->fetch($oosql)){
					$newsonclass=str_replace($o[sonclass],"|",$oo[sonclass]);
					$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$oo[classid]'");
				}
				//���ܷs�j��ت��l���
				$where=ReturnClass($featherclass);
				if(empty($where)){
					$where="classid=0";
				}
				$nbsql=$empire->query("select sonclass,classid from {$dbtbpre}enewsclass where ".$where);
				while($nb=$empire->fetch($nbsql)){
					if(empty($nb[sonclass]))
					{$nb[sonclass]="|";}
					$newsonclass=$nb[sonclass].substr($o[sonclass],1);
					$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$nb[classid]'");
				}
			}
			$change=",bclassid=$add[bclassid],featherclass='$featherclass'";
		}
		//�j�w��W���Ω�l���
		if($add['UrlToSmall']){
			UpdateSmallClassDomain($add['classid'],$add['classurl'],$classpath);
		}
		//wap�ҪO���Ω�l���
		if($add['wapstylesclass'])
		{
			$empire->query("update {$dbtbpre}enewsclass set wapstyleid='$add[wapstyleid]' where featherclass like '%|".$add[classid]."|%'");
		}
		//�ק�ƾڮw���
		$sql=$empire->query("update {$dbtbpre}enewsclass set classname='$add[classname]',classpath='$classpath',classtype='$add[classtype]',newline=$add[newline],hotline=$add[hotline],goodline=$add[goodline],classurl='$add[classurl]',groupid=$add[groupid],myorder=$add[myorder],filename_qz='$add[filename_qz]',hotplline=$add[hotplline],modid=$add[modid],checked=$add[checked],firstline=$add[firstline],bname='$add[bname]',islist=$add[islist],listtempid=$add[listtempid],lencord=$add[lencord],searchtempid=$add[searchtempid],tid=$tabler[tid],tbname='$tabler[tbname]',maxnum=$add[maxnum],checkpl=$add[checkpl],down_num=$add[down_num],online_num=$add[online_num],listorder='$add[listorder]',reorder='$add[reorder]',intro='$add[intro]',classimg='$add[classimg]',jstempid=$add[jstempid],listdt=$add[listdt],showclass=$add[showclass],showdt=$add[showdt],qaddgroupid='$add[qaddgroupid]',qaddshowkey=$add[qaddshowkey],adminqinfo=$add[adminqinfo],doctime=$add[doctime],classpagekey='$add[classpagekey]',dtlisttempid='$add[dtlisttempid]',classtempid='$add[classtempid]',nreclass=$add[nreclass],nreinfo=$add[nreinfo],nrejs=$add[nrejs],nottobq=$add[nottobq],ipath='$add[ipath]',addreinfo=$add[addreinfo],haddlist=$add[haddlist],sametitle=$add[sametitle],definfovoteid=$add[definfovoteid],wburl='',qeditchecked=$add[qeditchecked],openadd=$add[openadd],wapstyleid='$add[wapstyleid]',repreinfo='$add[repreinfo]',pltempid='$add[pltempid]',cgroupid='$add[cgroupid]',yhid='$add[yhid]',wfid='$add[wfid]',cgtoinfo='$add[cgtoinfo]',bdinfoid='$add[bdinfoid]',repagenum='$add[repagenum]',keycid='$add[keycid]'".$change." where classid='$add[classid]'");
		//�ƪ�
		$ret_cr=ReturnClassAddF($add,1);
		$empire->query("update {$dbtbpre}enewsclassadd set classtext='".eaddslashes2($add[classtext])."'".$ret_cr[0]." where classid='$add[classid]'");
		//��s����
		UpdateTheFileEditOther(1,$add['classid'],'other');
		GetClass();
		//�ͦ���ؤ��
		if($add[islist]==0||$add[islist]==2)
		{
			$classtemp=$add[islist]==2?GetClassText($add[classid]):GetClassTemp($add['classtempid']);
			NewsBq($add[classid],$classtemp,0,1);
		}
		elseif($add[islist]==3)
		{
			ReClassBdInfo($add[classid]);
		}
		if($add[islist]==2)
		{
			//�R���ʺA�ҪO�w�s���
			DelOneTempTmpfile('classpage'.$add[classid]);
		}
	}
	//�ׯ����
	else
	{
		if($add[modid]<>$add[oldmodid])//���t�μҫ�
		{
			$chmtbr=GetModTable($add[oldmodid]);
			if($chmtbr[tid]<>$tabler[tid]&&$chmtbr[tbname])
			{
				$chmchecknum=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_".$chmtbr[tbname]."_index where classid='$add[classid]'");
				if($chmchecknum)
				{
					printerror("ClassChangeModHaveInfo","history.go(-1)");
				}
			}
		}
		//���ܤj���
		if($add[bclassid]<>$add[oldbclassid]){
			//���D���
			if(empty($add[bclassid])){
				$sonclass="";
				$featherclass="";
				//���o��ح쥻���j���
				$r=$empire->fetch1("select featherclass,classpath from {$dbtbpre}enewsclass where classid='$add[classid]'");
				//���ܭ쥻�j��ت��l���
				$where=ReturnClass($r[featherclass]);
				if(empty($where)){
					$where="classid=0";
				}
				$bsql=$empire->query("select classid,sonclass from {$dbtbpre}enewsclass where ".$where);
				while($br=$empire->fetch($bsql)){
					$newsonclass=str_replace("|".$add[classid]."|","|",$br[sonclass]);
					$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$br[classid]'");
				}
			}
			//��줤�����
			else
			{
				//���o�{�b�j��ت���
				$b=$empire->fetch1("select featherclass,islast,wburl from {$dbtbpre}enewsclass where classid='$add[bclassid]'");
				//�˴��j��جO�_���ׯ����
				if($b[islast])
				{
					printerror("BclassNotLast","");
				}
				if($b[wburl])
				{
					printerror("BclassNotWb","");
				}
				if(empty($b[featherclass])){
					$b[featherclass]="|";
				}
				$featherclass=$b[featherclass].$add[bclassid]."|";
				//���ܷs�j��ت��l���
				$where=ReturnClass($featherclass);
				if(empty($where)){
					$where="classid=0";
				}
				$bsql=$empire->query("select sonclass,classid from {$dbtbpre}enewsclass where ".$where);
				while($nb=$empire->fetch($bsql))
				{
					if(empty($nb[sonclass]))
					{$nb[sonclass]="|";}
					$newsonclass=$nb[sonclass].$add[classid]."|";
					$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$nb[classid]'");
				}
				//�����¤j��ت��l���
				$o=$empire->fetch1("select sonclass,featherclass from {$dbtbpre}enewsclass where classid='$add[classid]'");
				$where=ReturnClass($o[featherclass]);
				if(empty($where)){
					$where="classid=0";
				}
				$osql=$empire->query("select sonclass,classid from {$dbtbpre}enewsclass where ".$where);
				while($ob=$empire->fetch($osql)){
				   $newsonclass=str_replace("|".$add[classid]."|","|",$ob[sonclass]);
				   $usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$ob[classid]'");
			   }
			}
			$change=",bclassid=$add[bclassid],featherclass='$featherclass'";
		}
		//���Ω�w�ͦ����H��
		if($add['tobetempinfo'])
		{
			UpdateAllDataTbField($tabler['tbname'],"newstempid='$add[newstempid]'"," where classid='$add[classid]'",1);
		}
		//���e��
	    $add[filename_qz]=RepFilenameQz($add[filename_qz]);
		$sql=$empire->query("update {$dbtbpre}enewsclass set classname='$add[classname]',classpath='$classpath',classtype='$add[classtype]',link_num=$add[link_num],lencord=$add[lencord],newstempid=$add[newstempid],listtempid=$add[listtempid],newspath='$add[newspath]',filename=$add[filename],filetype='$add[filetype]',openpl=$add[openpl],openadd=$add[openadd],newline=$add[newline],hotline=$add[hotline],goodline=$add[goodline],classurl='$add[classurl]',groupid=$add[groupid],myorder=$add[myorder],filename_qz='$add[filename_qz]',hotplline=$add[hotplline],modid=$add[modid],checked=$add[checked],firstline=$add[firstline],bname='$add[bname]',searchtempid=$add[searchtempid],tid=$tabler[tid],tbname='$tabler[tbname]',maxnum=$add[maxnum],checkpl=$add[checkpl],down_num=$add[down_num],online_num=$add[online_num],listorder='$add[listorder]',reorder='$add[reorder]',intro='$add[intro]',classimg='$add[classimg]',jstempid=$add[jstempid],addinfofen=$add[addinfofen],listdt=$add[listdt],showclass=$add[showclass],showdt=$add[showdt],checkqadd=$add[checkqadd],qaddlist=$add[qaddlist],qaddgroupid='$add[qaddgroupid]',qaddshowkey=$add[qaddshowkey],adminqinfo=$add[adminqinfo],doctime=$add[doctime],classpagekey='$add[classpagekey]',dtlisttempid='$add[dtlisttempid]',classtempid='$add[classtempid]',nreclass=$add[nreclass],nreinfo=$add[nreinfo],nrejs=$add[nrejs],nottobq=$add[nottobq],ipath='$add[ipath]',addreinfo=$add[addreinfo],haddlist=$add[haddlist],sametitle=$add[sametitle],definfovoteid=$add[definfovoteid],wburl='',qeditchecked=$add[qeditchecked],wapstyleid='$add[wapstyleid]',repreinfo='$add[repreinfo]',pltempid='$add[pltempid]',cgroupid='$add[cgroupid]',yhid='$add[yhid]',wfid='$add[wfid]',cgtoinfo='$add[cgtoinfo]',bdinfoid='$add[smallbdinfoid]',repagenum='$add[repagenum]',keycid='$add[keycid]'".$change." where classid='$add[classid]'");
		//�ƪ�
		$ret_cr=ReturnClassAddF($add,1);
		$empire->query("update {$dbtbpre}enewsclassadd set classtext='".eaddslashes2($add[classtext])."'".$ret_cr[0]." where classid='$add[classid]'");
		//��s����
		UpdateTheFileEditOther(1,$add['classid'],'other');
		GetClass();
	}
	//���ʥؿ�
	if($add[bclassid]<>$add[oldbclassid]||($add[oldclasspath]<>$classpath&&$add['classpath']==$add['oldcpath'])){
		$opath="../../".$add[oldclasspath];
		$newpath="../../".$classpath;
		MovePath($opath,$newpath);
		$opath="../../d/file/".$add[oldclasspath];
		$npath="../../d/file/".$classpath;
		CopyPath($opath,$npath);
    }
	else{
		if($add['oldcpath']<>$add['classpath'])//����إؿ�
		{
			AlterClassPath($add['classid'],$add['islast'],$add['oldclasspath'],$classpath);
			//�R���ɯ�w�s
			$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or navtype='userenews'");
			GetClass();
		}
	}
	//�R���w�s���
	$cache_mid=0;
	$cache_oldmid=0;
	if($add[oldclassname]<>$add[classname]||$add[bclassid]<>$add[oldbclassid])
	{
		DelListEnews();
		//GetSearch($add[modid]);
		DelFiletext("../d/js/js/addinfo".$add[modid].".js");
		//�R���ɯ�w�s
		$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or navtype='userenews' or (navtype='modclass' and modid='$add[modid]')");
		$cache_mid=$add[modid];
    }
	else
	{
		if(($add[oldclasspath]<>$classpath&&$add['classpath']==$add['oldcpath'])||$add[listdt]<>$add[oldlistdt])
		{
			DelListEnews();
			//�R���ɯ�w�s
			$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or navtype='userenews'");
		}
		if($add[openadd]<>$add[oldopenadd]||$add[modid]<>$add[oldmodid])
		{
			//GetSearch($add[modid]);
			DelFiletext("../d/js/js/addinfo".$add[modid].".js");
			//�R���ɯ�w�s
			$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='modclass' and modid='$add[modid]'");
			$cache_mid=$add[modid];
			if($add[modid]<>$add[oldmodid])
			{
				//GetSearch($add[oldmodid]);
				DelFiletext("../d/js/js/addinfo".$add[oldmodid].".js");
				//�R���ɯ�w�s
				$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='modclass' and modid='$add[oldmodid]'");
				$cache_oldmid=$add[oldmodid];
			}
		}
	}
	//�ק�����X�i�W
	if($add[oldclasstype]<>$add[classtype]){
		$todaytime=date("Y-m-d H:i:s");
		if($add[islast]){
			$query="select count(*) as total from {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]." where classid='$add[classid]'";
			$lencord=$add[oldlencord];
			$num=$empire->gettotal($query);
		}
		else{
			$lencord=$add[oldlencord];
			if($add[oldislist]==1){
				$where=ReturnClass($class_r[$add[classid]][sonclass]);
				$query="select count(*) as total from {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]." where (".$where.")";
				$num=$empire->gettotal($query);
			}
			else
			{
				$num=1;
			}
		}
		RenameListfile($add[classid],$lencord,$num,$add[oldclasstype],$add[classtype],$classpath);
	}
	//�ӷ�
	if($add['from']){
		$returnurl="ListPageClass.php";
	}
	else{
		$returnurl="ListClass.php";
	}
	TogNotReClass(1);
	if($sql)
	{
		insert_dolog("classid=".$add[classid]."<br>classname=".$add[classname]);//�ާ@��x
		$cache_enews='doclass,doinfo,douserinfo,domod,dostemp';
		$cache_ecmstourl=urlencode($returnurl.hReturnEcmsHashStrHref2(1));
		$cache_mess='EditClassSuccess';
		$cache_url="CreateCache.php?enews=$cache_enews&mid=$cache_mid&oldmid=$cache_oldmid&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
		//printerror("EditClassSuccess",$returnurl);
		echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
		db_close();
		$empire=null;
		exit();
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�׷���ػP�D�׷���ؤ������ഫ
function ChangeClassIslast($reclassid,$userid,$username){
	global $empire,$dbtbpre;
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,"class");
	$count=count($reclassid);
	$classid=(int)$reclassid[0];
	if($count==0||!$classid)
	{
		printerror("NotChangeIslastClassid","");
	}
	//���o����ثH��
	$r=$empire->fetch1("select classid,sonclass,featherclass,islist,islast,classname,modid,tbname,wburl from {$dbtbpre}enewsclass where classid=$classid");
	if(empty($r[classid]))
	{
		printerror("NotChangeIslastClassid","");
	}
	if($r[wburl])
	{
		printerror("NotChangeWbClassid","");
	}
	//�D�׷����
	if(!$r[islast])
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsclass where bclassid=$classid");
		if($num)
		{
			printerror("LastTheClassHaveSonclass","history.go(-1)");
		}
		//�ק����ت��l���
		$where=ReturnClass($r[featherclass]);
		if(empty($where))
		{
			$where="classid=0";
		}
		$sql=$empire->query("select classid,sonclass from {$dbtbpre}enewsclass where ".$where);
		while($br=$empire->fetch($sql))
		{
			if(empty($br[sonclass]))
			{
				$br[sonclass]="|";
			}
			$newsonclass=$br[sonclass].$classid."|";
			$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid=$br[classid]");
		}
		$dosql=$empire->query("update {$dbtbpre}enewsclass set islast=1 where classid=$classid");
		$mess="ChangeClassToLastSuccess";
	}
	//�׷����
	else
	{
		$num=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_".$r[tbname]."_index where classid='$classid'");
		if($num)
		{
			printerror("LastTheClassHaveInfo","history.go(-1)");
		}
		//�ק����ت��l���
		$where=ReturnClass($r[featherclass]);
		if(empty($where))
		{
			$where="classid=0";
		}
		$sql=$empire->query("select classid,sonclass from {$dbtbpre}enewsclass where ".$where);
		while($br=$empire->fetch($sql))
		{
			if(empty($br[sonclass]))
			{
				$br[sonclass]="|";
			}
			$newsonclass=str_replace("|".$classid."|","|",$br[sonclass]);
			$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid=$br[classid]");
		}
		$dosql=$empire->query("update {$dbtbpre}enewsclass set islast=0 where classid=$classid");
		$mess="ChangeClassToNolastSuccess";
	}
	//�R���w�s���
	DelListEnews();
	//��s�w�s
	GetClass();
	//GetSearch($r[modid]);
	if($dosql)
	{
		//�R���ɯ�w�s
		$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or navtype='userenews' or (navtype='modclass' and modid='$r[modid]')");
		DelFiletext("../d/js/js/addinfo".$r[modid].".js");
		$cache_enews='doclass,doinfo,douserinfo,domod,dostemp';
		$cache_ecmstourl=urlencode($_SERVER['HTTP_REFERER']);
		$cache_mess=$mess;
		$cache_mid=$r[modid];
		$cache_url="CreateCache.php?enews=$cache_enews&mid=$cache_mid&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
		//�ާ@��x
		insert_dolog("classid=".$classid."<br>classname=".$r[classname]);
		//printerror($mess,$_SERVER['HTTP_REFERER']);
		echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
		db_close();
		$empire=null;
		exit();
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

//�R�����
function DelClass($classid,$userid,$username){
	global $empire,$dbtbpre;
	$classid=(int)$classid;
	if(!$classid)
	{
		printerror("NotDelClassid","");
	}
	//�ާ@�v��
	CheckLevel($userid,$username,$classid,"class");
	$r=$empire->fetch1("select * from {$dbtbpre}enewsclass where classid='$classid'");
	if(empty($r[classid]))
	{
		printerror("NotClassid","history.go(-1)");
	}
    DelClass1($classid);
    GetClass();
	//GetSearch($r[modid]);
	//��^�a�}
	if($_GET['from'])
	{$returnurl="ListPageClass.php";}
	else
	{$returnurl="ListClass.php";}
	TogNotReClass(1);
	//�R���ɯ�w�s
	$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or navtype='userenews' or (navtype='modclass' and modid='$r[modid]')");
	$cache_enews='doclass,doinfo,douserinfo,domod,dostemp';
	$cache_ecmstourl=urlencode($returnurl.hReturnEcmsHashStrHref2(1));
	$cache_mess='DelClassSuccess';
	$cache_mid=$r[modid];
	$cache_url="CreateCache.php?enews=$cache_enews&mid=$cache_mid&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
	insert_dolog("classid=".$classid."<br>classname=".$r[classname]);//�ާ@��x
	//printerror("DelClassSuccess",$returnurl);
	echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
	db_close();
	$empire=null;
	exit();
}

//�R�����,����^��
function DelClass1($classid){
	global $empire,$class_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}enewsclass where classid='$classid'");
	//�~�����
	if($r[wburl])
	{
		$sql=$empire->query("delete from {$dbtbpre}enewsclass where classid='$classid'");
		$empire->query("delete from {$dbtbpre}enewsclassadd where classid='$classid'");
		$empire->query("delete from {$dbtbpre}enewsclass_stats where classid='$classid'");
		//�R����ت���
		DelFileOtherTable("modtype=1 and id='$classid'");
		//�R���w�s
		DelListEnews();
		return "";
	}
	//�R���׷����
	if($r[islast])
	{
		//�R���D��H��
		$indexsql=$empire->query("delete from {$dbtbpre}ecms_".$r[tbname]."_index where classid='$classid'");
		$sql=$empire->query("delete from {$dbtbpre}ecms_".$r[tbname]." where classid='$classid'");
		$empire->query("delete from {$dbtbpre}ecms_".$r[tbname]."_check where classid='$classid'");
		$empire->query("delete from {$dbtbpre}ecms_".$r[tbname]."_doc where classid='$classid'");
		//�R���ƪ�H��
		DelAllDataTbInfo($r['tbname'],"classid='$classid'",1,1);
		//�R���s�奻���
		DelInfoSaveTxtfile($r['modid'],$r['tbname'],"classid='$classid'");
		//�R���H�����[��P����
		DelMoreInfoOtherData($classid,0,0);
		$filepath="../../d/file/".$r[classpath];
		$delf=DelPath($filepath);
		DelFileOtherTable("modtype=1 and id='$classid'");
		//�R����إ���
	    $sql1=$empire->query("delete from {$dbtbpre}enewsclass where classid='$classid'");
		$empire->query("delete from {$dbtbpre}enewsclassadd where classid='$classid'");
		$empire->query("delete from {$dbtbpre}enewsclass_stats where classid='$classid'");
		$delpath="../../".$r[classpath];
		$del=DelPath($delpath);
		//��s�j��ت��l���
		$where=ReturnClass($r[featherclass]);
	    if(empty($where))
		{$where="classid=0";}
	    $bsql=$empire->query("select sonclass,classid from {$dbtbpre}enewsclass where ".$where);
		while($br=$empire->fetch($bsql))
		{
			$newsonclass=str_replace("|".$classid."|","|",$br[sonclass]);
			$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$br[classid]'");
		}
	}
	//�R���j���
	else
	{
	    //�R�����
		$where=ReturnClass($r[sonclass]);
		if(empty($where))
		{$where="classid=0";}
		$delcr=explode("|",$r[sonclass]);
		$count=count($delcr);
		for($i=1;$i<$count-1;$i++)
		{
			$delcid=$delcr[$i];
			//�R���D��H��
			$indexsql=$empire->query("delete from {$dbtbpre}ecms_".$class_r[$delcid][tbname]."_index where classid='$delcid'");
			$sql=$empire->query("delete from {$dbtbpre}ecms_".$class_r[$delcid][tbname]." where classid='$delcid'");
			$empire->query("delete from {$dbtbpre}ecms_".$class_r[$delcid][tbname]."_check where classid='$delcid'");
			$empire->query("delete from {$dbtbpre}ecms_".$class_r[$delcid][tbname]."_doc where classid='$delcid'");
			//�R���ƪ�H��
			DelAllDataTbInfo($class_r[$delcid][tbname],"classid='$delcid'",1,1);
			//�R���s�奻���
			DelInfoSaveTxtfile($class_r[$delcid][modid],$class_r[$delcid][tbname],"classid='$delcid'");
			//�R���H�����[��P����
			DelMoreInfoOtherData($delcid,0,0);
		}
		//�R������
		$filepath="../../d/file/".$r[classpath];
	    $delf=DelPath($filepath);
		if($where<>'classid=0')
		{
			DelFileOtherTable("modtype=1 and (".str_replace('classid','id',$where).")");
		}
		//�R���l��ذƪ�
		$fcsql=$empire->query("select classid from {$dbtbpre}enewsclass where featherclass like '%|".$classid."|%'");
		while($fcr=$empire->fetch($fcsql))
		{
			$empire->query("delete from {$dbtbpre}enewsclassadd where classid='$fcr[classid]'");
			$empire->query("delete from {$dbtbpre}enewsclass_stats where classid='$fcr[classid]'");
		}
		//�R���l���
		$sql1=$empire->query("delete from {$dbtbpre}enewsclass where featherclass like '%|".$classid."|%'");
		//���ܤ���ت��l��
		$where=ReturnClass($r[featherclass]);
		if(empty($where))
		{$where="classid=0";}
		$bbsql=$empire->query("select classid,sonclass from {$dbtbpre}enewsclass where ".$where);
		while($bbr=$empire->fetch($bbsql))
		{
			$newsonclass=str_replace($r[sonclass],"|",$bbr[sonclass]);
			$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$newsonclass' where classid='$bbr[classid]'");
		}
		//�R����إ���
		$sql2=$empire->query("delete from {$dbtbpre}enewsclass where classid='$classid'");
		$empire->query("delete from {$dbtbpre}enewsclassadd where classid='$classid'");
		$empire->query("delete from {$dbtbpre}enewsclass_stats where classid='$classid'");
		//�R����ت���
		DelFileOtherTable("modtype=1 and id='$classid'");
		$delpath="../../".$r[classpath];
		$del=DelPath($delpath);
	}
	//�R���w�s
	DelListEnews();
}

//�ק���ض���
function EditClassOrder($classid,$myorder,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"class");
	for($i=0;$i<count($classid);$i++)
	{
		$newmyorder=(int)$myorder[$i];
		$sql=$empire->query("update {$dbtbpre}enewsclass set myorder=$newmyorder where classid='$classid[$i]'");
    }
	//�R���w�s
	DelListEnews();
	//�R���ɯ�w�s
	$empire->query("delete from {$dbtbpre}enewsclassnavcache where navtype='listclass' or navtype='listenews' or navtype='jsclass' or navtype='userenews'");
	$cache_enews='doclass,doinfo,douserinfo';
	$cache_ecmstourl=urlencode($_SERVER['HTTP_REFERER']);
	$cache_mess='EditClassOrderSuccess';
	$cache_url="CreateCache.php?enews=$cache_enews&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
	//�ާ@��x
	insert_dolog("");
	//printerror("EditClassOrderSuccess",$_SERVER['HTTP_REFERER']);
	echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
	db_close();
	$empire=null;
	exit();
}

//��s������Y
function ChangeSonclass($start,$userid,$username){
	global $empire,$public_r,$fun_r,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"changedata");
	$start=(int)$start;
	$b=0;
	$sql=$empire->query("select classid from {$dbtbpre}enewsclass where islast=0 and classid>".$start." order by classid limit ".$public_r[relistnum]);
	while($r=$empire->fetch($sql))
	{
		$b=1;
		$newstart=$r[classid];
		//�l���
		$sonclass="|";
		$ssql=$empire->query("select classid from {$dbtbpre}enewsclass where islast=1 and featherclass like '%|".$r[classid]."|%' order by classid");
		while($sr=$empire->fetch($ssql))
		{
			$sonclass.=$sr[classid]."|";
	    }
		$usql=$empire->query("update {$dbtbpre}enewsclass set sonclass='$sonclass' where classid='$r[classid]'");
    }
	//����
	if(empty($b))
	{
		GetClass();
		printerror("ChangeSonclassSuccess","ReHtml/ChangeData.php".hReturnEcmsHashStrHref2(1));
	}
	echo $fun_r['OneChangeSonclassSuccess']."(ID:<font color=red><b>".$newstart."</b></font>)<script>self.location.href='ecmsclass.php?enews=ChangeSonclass&start=$newstart".hReturnEcmsHashStrHref(0)."';</script>";
	exit();
}

//�R����ؽw�s���
function DelFcListClass(){
	global $empire,$dbtbpre;
	DelListEnews();
	//�R���ɯ�w�s
	$empire->query("delete from {$dbtbpre}enewsclassnavcache");
	$cache_enews='doclass,doinfo,douserinfo,domod,dostemp';
	$cache_ecmstourl=urlencode("history.go(-1)");
	$cache_mess='DelListEnewsSuccess';
	$cache_url="CreateCache.php?enews=$cache_enews&ecmstourl=$cache_ecmstourl&mess=$cache_mess".hReturnEcmsHashStrHref2(0);
	//�ާ@��x
	insert_dolog("");
	//printerror("DelListEnewsSuccess","history.go(-1)");
	echo'<meta http-equiv="refresh" content="0;url='.$cache_url.'">';
	db_close();
	$empire=null;
	exit();
}

//��q�]�m���
function SetMoreClass($add,$userid,$username){
	global $empire,$dbtbpre;
	//�����v��
	CheckLevel($userid,$username,$classid,"setmclass");
	//���
	$classid=$add['classid'];
	$count=count($classid);
	if($count==0)
	{
		printerror("NotChangeSetClass","");
	}
	$cids='';
	$dh='';
	for($i=0;$i<$count;$i++)
	{
		$cids.=$dh.intval($classid[$i]);
		$dh=',';
	}
	$whereclass='classid in ('.$cids.')';
	$seting='';
	//���ݩ�
	if($add['doclasstype'])
	{
		$seting.=",classtype='$add[classtype]'";
	}
	if($add['dolisttempid']&&$add[listtempid])
	{
		$seting.=",listtempid='$add[listtempid]'";
	}
	if($add['dodtlisttempid'])
	{
		$seting.=",dtlisttempid='$add[dtlisttempid]'";
	}
	if($add['domaxnum'])
	{
		$seting.=",maxnum='$add[maxnum]'";
	}
	if($add['dolencord'])
	{
		$seting.=",lencord='$add[lencord]'";
	}
	if($add['dosearchtempid'])
	{
		$seting.=",searchtempid='$add[searchtempid]'";
	}
	if($add['dowapstyleid'])
	{
		$seting.=",wapstyleid='$add[wapstyleid]'";
	}
	if($add['dolistorder'])
	{
		$seting.=",listorder='$add[listorder]'";
	}
	if($add['doreorder'])
	{
		$seting.=",reorder='$add[reorder]'";
	}
	if($add['dolistdt'])
	{
		$seting.=",listdt='$add[listdt]'";
	}
	if($add['doshowdt'])
	{
		$seting.=",showdt='$add[showdt]'";
	}
	if($add['doshowclass'])
	{
		$seting.=",showclass='$add[showclass]'";
	}
	if($add['doopenadd'])
	{
		$seting.=",openadd='$add[openadd]'";
	}
	//�ﶵ�]�m[�j���]
	if($add['doclasstempid'])
	{
		$seting.=",classtempid='$add[classtempid]'";
	}
	if($add['doislist'])
	{
		$seting.=",islist='$add[islist]'";
	}
	//�ﶵ�]�m[�׷����]
	if($add['donewstempid']&&$add[newstempid])
	{
		$seting.=",newstempid='$add[newstempid]'";
		if($add['tobetempinfo'])
		{
			$donewstemp=1;
		}
	}
	if($add['dopltempid'])
	{
		$seting.=",pltempid='$add[pltempid]'";
	}
	if($add['dolink_num'])
	{
		$seting.=",link_num='$add[link_num]'";
	}
	if($add['doinfopath'])
	{
		if($add['infopath']==0)
		{
			$add['ipath']='';
		}
		$seting.=",ipath='$add[ipath]'";
	}
	if($add['donewspath'])
	{
		$seting.=",newspath='$add[newspath]'";
	}
	if($add['dofilename_qz'])
	{
		$seting.=",filename_qz='$add[filename_qz]'";
	}
	if($add['dofilename'])
	{
		$seting.=",filename='$add[filename]'";
	}
	if($add['dofiletype'])
	{
		$seting.=",filetype='$add[filetype]'";
	}
	if($add['doopenpl'])
	{
		$seting.=",openpl='$add[openpl]'";
	}
	if($add['docheckpl'])
	{
		$seting.=",checkpl='$add[checkpl]'";
	}
	if($add['doqaddshowkey'])
	{
		$seting.=",qaddshowkey='$add[qaddshowkey]'";
	}
	if($add['docheckqadd'])
	{
		$seting.=",checkqadd='$add[checkqadd]'";
	}
	if($add['doqaddgroupid'])
	{
		$add[qaddgroupid]=DoPostClassQAddGroupid($add[qaddgroupidck]);
		$seting.=",qaddgroupid='$add[qaddgroupid]'";
	}
	if($add['doqaddlist'])
	{
		$seting.=",qaddlist='$add[qaddlist]'";
	}
	if($add['doaddinfofen'])
	{
		$seting.=",addinfofen='$add[addinfofen]'";
	}
	if($add['doadminqinfo'])
	{
		$seting.=",adminqinfo='$add[adminqinfo]'";
	}
	if($add['doqeditchecked'])
	{
		$seting.=",qeditchecked='$add[qeditchecked]'";
	}
	if($add['doaddreinfo'])
	{
		$seting.=",addreinfo='$add[addreinfo]'";
	}
	if($add['dohaddlist'])
	{
		$seting.=",haddlist='$add[haddlist]'";
	}
	if($add['dosametitle'])
	{
		$seting.=",sametitle='$add[sametitle]'";
	}
	if($add['dochecked'])
	{
		$seting.=",checked='$add[checked]'";
	}
	if($add['dorepreinfo'])
	{
		$seting.=",repreinfo='$add[repreinfo]'";
	}
	if($add['dodefinfovoteid'])
	{
		$seting.=",definfovoteid='$add[definfovoteid]'";
	}
	if($add['dogroupid'])
	{
		$seting.=",groupid='$add[groupid]'";
	}
	if($add['dodoctime'])
	{
		$seting.=",doctime='$add[doctime]'";
	}
	//�S��ҫ��]�m
	if($add['dodown_num'])
	{
		$seting.=",down_num='$add[down_num]'";
	}
	if($add['doonline_num'])
	{
		$seting.=",online_num='$add[online_num]'";
	}
	//JS�եγ]�m
	if($add['dojstempid'])
	{
		$seting.=",jstempid='$add[jstempid]'";
	}
	if($add['donewjs'])
	{
		$seting.=",newline='$add[newline]'";
	}
	if($add['dohotjs'])
	{
		$seting.=",hotline='$add[hotline]'";
	}
	if($add['dogoodjs'])
	{
		$seting.=",goodline='$add[goodline]'";
	}
	if($add['dohotpljs'])
	{
		$seting.=",hotplline='$add[hotplline]'";
	}
	if($add['dofirstjs'])
	{
		$seting.=",firstline='$add[firstline]'";
	}
	if(empty($seting))
	{
		printerror("NotChangeSetClassInfo","");
	}
	$seting=substr($seting,1);
	$sql=$empire->query("update {$dbtbpre}enewsclass set ".$seting." where ".$whereclass);
	//���e�ҪO���Ω�l�ͦ����H��
	if($donewstemp==1)
	{
		$csql=$empire->query("select classid,tbname from {$dbtbpre}enewsclass where (".$whereclass.") and islast=1");
		while($r=$empire->fetch($csql))
		{
			UpdateAllDataTbField($r['tbname'],"newstempid='$add[newstempid]'"," where classid='$r[classid]'",1);
		}
	}
	if($sql)
	{
		GetClass();
		//�ާ@��x
		insert_dolog("");
		printerror("SetMoreClassSuccess","SetMoreClass.php".hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","");}
}
?>