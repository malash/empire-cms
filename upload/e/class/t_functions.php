<?php
if(!defined('InEmpireCMS'))
{
        exit();
}
define('InEmpireCMSTfun',TRUE);
require_once(ECMS_PATH."e/class/userfun.php");

//列表模板分頁函數
function sys_ShowListPage($num,$pagenum,$dolink,$dotype,$page,$lencord,$ok,$search="",$add){
	global $fun_r;
	//文件名
	if(empty($add['dofile']))
	{
		$add['dofile']='index';
	}
	//靜態頁數
	$repagenum=$add['repagenum'];
	//首頁
	if($pagenum<>1)
	{
		$pagetop="<a href='".$dolink.$add['dofile'].$dotype."'>".$fun_r['startpage']."</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagetop=$fun_r['startpage']."&nbsp;&nbsp;";
	}
	//上一頁
	if($pagenum<>1)
	{
		$pagepr=$pagenum-1;
		if($pagepr==1)
		{
			$prido=$add['dofile'].$dotype;
		}
		else
		{
			$prido=$add['dofile'].'_'.$pagepr.$dotype;
		}
		$pagepri="<a href='".$dolink.$prido."'>".$fun_r['pripage']."</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagepri=$fun_r['pripage']."&nbsp;&nbsp;";
	}
	//下一頁
	if($pagenum<>$page)
	{
		$pagenex=$pagenum+1;
		$nextpagelink=$repagenum&&$repagenum<$pagenex?eReturnRewritePageLink2($add,$pagenex):$dolink.$add['dofile'].'_'.$pagenex.$dotype;
		$pagenext="<a href='".$nextpagelink."'>".$fun_r['nextpage']."</a>&nbsp;&nbsp;";
	}
	else
	{
		$pagenext=$fun_r['nextpage']."&nbsp;&nbsp;";
	}
	//尾頁
	if($pagenum==$page)
	{
		$pageeof=$fun_r['lastpage'];
	}
	else
	{
		$lastpagelink=$repagenum&&$repagenum<$page?eReturnRewritePageLink2($add,$page):$dolink.$add['dofile'].'_'.$page.$dotype;
		$pageeof="<a href='".$lastpagelink."'>".$fun_r['lastpage']."</a>";
	}
	$options="";
	//取得下拉頁碼
	if(empty($search))
	{
		for($go=1;$go<=$page;$go++)
		{
			if($go==1)
			{$file=$add['dofile'].$dotype;}
			else
			{$file=$add['dofile'].'_'.$go.$dotype;}
			$thispagelink=$repagenum&&$repagenum<$go?eReturnRewritePageLink2($add,$go):$dolink.$file;
			if($ok==$go)
			{$select=" selected";}
			else
			{$select="";}
			$myoptions.="<option value='".$thispagelink."'>".$fun_r['gotos'].$go.$fun_r['gotol']."</option>";
			$options.="<option value='".$thispagelink."'".$select.">".$fun_r['gotos'].$go.$fun_r['gotol']."</option>";
		}
	}
	else
	{
		$myoptions=$search;
		$options=str_replace("value='".$dolink.$add['dofile'].'_'.$ok.$dotype."'>","value='".$dolink.$add['dofile']."_".$ok.$dotype."' selected>",$search);
	}
	$options="<select name=select onchange=\"self.location.href=this.options[this.selectedIndex].value\">".$options."</select>";
	//分頁
	$pagelink=$pagetop.$pagepri.$pagenext.$pageeof;
	//替換模板變量
	$pager['showpage']=ReturnListpageStr($pagenum,$page,$lencord,$num,$pagelink,$options);
	$pager['option']=$myoptions;
	return $pager;
}

//列表模板之列表式分頁
function sys_ShowListMorePage($num,$page,$dolink,$type,$totalpage,$line,$ok,$search="",$add){
	global $fun_r,$public_r;
	if($num<=$line)
	{
		$pager['showpage']='';
		return $pager;
	}
	//文件名
	if(empty($add['dofile']))
	{
		$add['dofile']='index';
	}
	//靜態頁數
	$repagenum=$add['repagenum'];
	$page_line=$public_r['listpagelistnum'];
	$snum=2;
	//$totalpage=ceil($num/$line);//取得總頁數
	$firststr='<a title="Total record">&nbsp;<b>'.$num.'</b> </a>&nbsp;&nbsp;';
	//上一頁
	if($page<>1)
	{
		$toppage='<a href="'.$dolink.$add['dofile'].$type.'">'.$fun_r['startpage'].'</a>&nbsp;';
		$pagepr=$page-1;
		if($pagepr==1)
		{
			$prido=$add['dofile'].$type;
		}
		else
		{
			$prido=$add['dofile'].'_'.$pagepr.$type;
		}
		$prepage='<a href="'.$dolink.$prido.'">'.$fun_r['pripage'].'</a>';
	}
	//下一頁
	if($page!=$totalpage)
	{
		$pagenex=$page+1;
		$nextpagelink=$repagenum&&$repagenum<$pagenex?eReturnRewritePageLink2($add,$pagenex):$dolink.$add['dofile'].'_'.$pagenex.$type;
		$lastpagelink=$repagenum&&$repagenum<$totalpage?eReturnRewritePageLink2($add,$totalpage):$dolink.$add['dofile'].'_'.$totalpage.$type;
		$nextpage='&nbsp;<a href="'.$nextpagelink.'">'.$fun_r['nextpage'].'</a>';
		$lastpage='&nbsp;<a href="'.$lastpagelink.'">'.$fun_r['lastpage'].'</a>';
	}
	$starti=$page-$snum<1?1:$page-$snum;
	$no=0;
	for($i=$starti;$i<=$totalpage&&$no<$page_line;$i++)
	{
		$no++;
		if($page==$i)
		{
			$is_1="<b>";
			$is_2="</b>";
		}
		elseif($i==1)
		{
			$is_1='<a href="'.$dolink.$add['dofile'].$type.'">';
			$is_2="</a>";
		}
		else
		{
			$thispagelink=$repagenum&&$repagenum<$i?eReturnRewritePageLink2($add,$i):$dolink.$add['dofile'].'_'.$i.$type;
			$is_1='<a href="'.$thispagelink.'">';
			$is_2="</a>";
		}
		$returnstr.='&nbsp;'.$is_1.$i.$is_2;
	}
	$returnstr=$firststr.$toppage.$prepage.$returnstr.$nextpage.$lastpage;
	$pager['showpage']=$returnstr;
	return $pager;
}

//返回內容分頁
function sys_ShowTextPage($totalpage,$page,$dolink,$add,$type,$search=""){
	global $fun_r,$public_r;
	if($totalpage==1)
	{
		return '';
	}
	$page_line=$public_r['textpagelistnum'];
	$snum=2;
	//$totalpage=ceil($num/$line);//取得總頁數
	$firststr='<a title="Page">&nbsp;<b>'.$page.'</b>/<b>'.$totalpage.'</b> </a>&nbsp;&nbsp;';
	//上一頁
	if($page<>1)
	{
		$toppage='<a href="'.$dolink.$add[filename].$type.'">'.$fun_r['startpage'].'</a>&nbsp;';
		$pagepr=$page-1;
		if($pagepr==1)
		{
			$prido=$add[filename].$type;
		}
		else
		{
			$prido=$add[filename].'_'.$pagepr.$type;
		}
		$prepage='<a href="'.$dolink.$prido.'">'.$fun_r['pripage'].'</a>';
	}
	//下一頁
	if($page!=$totalpage)
	{
		$pagenex=$page+1;
		$nextpage='&nbsp;<a href="'.$dolink.$add[filename].'_'.$pagenex.$type.'">'.$fun_r['nextpage'].'</a>';
		$lastpage='&nbsp;<a href="'.$dolink.$add[filename].'_'.$totalpage.$type.'">'.$fun_r['lastpage'].'</a>';
	}
	$starti=$page-$snum<1?1:$page-$snum;
	$no=0;
	for($i=$starti;$i<=$totalpage&&$no<$page_line;$i++)
	{
		$no++;
		if($page==$i)
		{
			$is_1="<b>";
			$is_2="</b>";
		}
		elseif($i==1)
		{
			$is_1='<a href="'.$dolink.$add[filename].$type.'">';
			$is_2="</a>";
		}
		else
		{
			$is_1='<a href="'.$dolink.$add[filename].'_'.$i.$type.'">';
			$is_2="</a>";
		}
		$returnstr.='&nbsp;'.$is_1.$i.$is_2;
	}
	$returnstr=$firststr.$toppage.$prepage.$returnstr.$nextpage.$lastpage;
	return $returnstr;
}

//返回下拉式內容分頁導航
function sys_ShowTextPageSelect($thispagenum,$dolink,$add,$filetype,$n_r){
	if($thispagenum==1)
	{
		return '';
	}
	$titleselect='';
	for($j=1;$j<=$thispagenum;$j++)
	{
	    if($j==1)
		{
			$title=$add[title];
			$plink=$add[filename].$filetype;
		}
		else
		{
			$k=$j-1;
			$ti_r=explode('[/!--empirenews.page--]',$n_r[$k]);
		    if(count($ti_r)>=2&&$ti_r[0])
			{
				$title=$ti_r[0];
			}
		    else
			{
				$title=$add[title].'('.$j.')';
			}
			$plink=$add[filename].'_'.$j.$filetype;
		}
		$titleselect.='<option value="'.$dolink.$plink.'?'.$j.'">'.$title.'</option>';
	}
	$titleselect='<select name="titleselect" onchange="self.location.href=this.options[this.selectedIndex].value">'.$titleselect.'</select>';
	return $titleselect;
}

//返回sql語句
function sys_ReturnBqQuery($classid,$line,$enews=0,$do=0,$ewhere='',$eorder=''){
	global $empire,$public_r,$class_r,$class_zr,$navclassid,$dbtbpre,$fun_r,$class_tr,$emod_r,$etable_r,$eyh_r;
	if($enews==24)//按sql查詢
	{
		$query_first=substr($classid,0,7);
		if(!($query_first=='select '||$query_first=='SELECT '))
		{
			return "";
		}
		$classid=RepSqlTbpre($classid);
		$sql=$empire->query1($classid);
		if(!$sql)
		{
			echo"SQL Error: ".ReRepSqlTbpre($classid);
		}
		return $sql;
	}
	if($enews==0||$enews==1||$enews==2||$enews==9||$enews==12||$enews==15)//欄目
	{
		if(strstr($classid,','))//多欄目
		{
			$son_r=sys_ReturnMoreClass($classid,1);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
			if($classid=='selfinfo')//顯示當前欄目信息
			{
				$classid=$navclassid;
			}
			if($class_r[$classid][islast])
			{
				$where="classid='$classid'";
			}
			else
			{
				$where=ReturnClass($class_r[$classid][sonclass]);
			}
		}
		$tbname=$class_r[$classid][tbname];
		$mid=$class_r[$classid][modid];
		$yhid=$class_r[$classid][yhid];
    }
	elseif($enews==6||$enews==7||$enews==8||$enews==11||$enews==14||$enews==17)//專題
	{
		echo"Error：Change to use e:indexloop";
		return false;
	}
	elseif($enews==25||$enews==26||$enews==27||$enews==28||$enews==29||$enews==30)//標題分類
	{
		if(strstr($classid,','))//多標題分類
		{
			$son_r=sys_ReturnMoreTT($classid);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
			if($classid=='selfinfo')//顯示當前標題分類信息
			{
				$classid=$navclassid;
			}
			$where="ttid='$classid'";
		}
		$mid=$class_tr[$classid][mid];
		$tbname=$emod_r[$mid][tbname];
		$yhid=$class_tr[$classid][yhid];
	}
	$query='';
	$qand=' and ';
	if($enews==0)//欄目最新
	{
		$query=' where ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==1)//欄目熱門
	{
		$query=' where ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==2)//欄目推薦
	{
		$query=' where ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==9)//欄目評論排行
	{
		$query=' where ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==12)//欄目頭條
	{
		$query=' where ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==15)//欄目下載排行
	{
		$query=' where ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	elseif($enews==3)//所有最新
	{
		$qand=' where ';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==4)//所有點擊排行
	{
		$qand=' where ';
		$order='onclick';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==5)//所有推薦
	{
		$query=' where isgood>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==10)//所有評論排行
	{
		$qand=' where ';
		$order='plnum';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==13)//所有頭條
	{
		$query=' where firsttitle>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==16)//所有下載排行
	{
		$qand=' where ';
		$order='totaldown';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==18)//各表最新
	{
		$qand=' where ';
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==19)//各表熱門
	{
		$qand=' where ';
		$order='onclick';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==20)//各表推薦
	{
		$query=' where isgood>0';
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==21)//各表評論排行
	{
		$qand=' where ';
		$order='plnum';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==22)//各表頭條信息
	{
		$query=' where firsttitle>0';
		$order="newstime";
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==23)//各表下載排行
	{
		$qand=' where ';
		$order='totaldown';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==25)//標題分類最新
	{
		$query=' where ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==26)//標題分類點擊排行
	{
		$query=' where ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==27)//標題分類推薦
	{
		$query=' where ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==28)//標題分類評論排行
	{
		$query=' where ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==29)//標題分類頭條
	{
		$query=' where ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==30)//標題分類下載排行
	{
		$query=' where ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	//優化
	$yhadd='';
	if(!empty($eyh_r[$yhid]['dobq']))
	{
		$yhadd=ReturnYhSql($yhid,$yhvar);
		if(!empty($yhadd))
		{
			$query.=$qand.$yhadd;
			$qand=' and ';
		}
	}
	//不調用
	if(!strstr($public_r['nottobq'],','.$classid.','))
	{
		$notbqwhere=ReturnNottoBqWhere();
		if(!empty($notbqwhere))
		{
			$query.=$qand.$notbqwhere;
			$qand=' and ';
		}
	}
	//圖片信息
	if(!empty($do))
	{
		$query.=$qand.'ispic=1';
		$qand=' and ';
    }
	//附加條件
	if(!empty($ewhere))
	{
		$query.=$qand.'('.$ewhere.')';
		$qand=' and ';
	}
	//中止
	if(empty($tbname))
	{
		echo $fun_r['BqErrorCid']."=<b>".$classid."</b>".$fun_r['BqErrorNtb']."(".$fun_r['BqErrorDo']."=".$enews.")";
		return false;
	}
	//排序
	$addorder=empty($eorder)?$order.' desc':$eorder;
	$query='select '.ReturnSqlListF($mid).' from '.$dbtbpre.'ecms_'.$tbname.$query.' order by '.ReturnSetTopSql('bq').$addorder.' limit '.$line;
	$sql=$empire->query1($query);
	if(!$sql)
	{
		echo"SQL Error: ".ReRepSqlTbpre($query);
	}
	return $sql;
}

//返回標籤模板
function sys_ReturnBqTemp($tempid){
	global $empire,$dbtbpre,$fun_r;
	$r=$empire->fetch1("select tempid,modid,temptext,showdate,listvar,subnews,rownum,docode from ".GetTemptb("enewsbqtemp")." where tempid='$tempid'");
	if(empty($r[tempid]))
	{
		echo $fun_r['BqErrorNbqtemp']."(ID=".$tempid.")";
	}
	return $r;
}

//替換欄目名
function ReplaceEcmsinfoClassname($temp,$enews,$classid){
	global $class_r,$class_zr;
	if(strstr($classid,","))
	{
		return $temp;
    }
	$thecdo=',0,1,2,9,12,15,';
	$thezdo=',6,7,8,11,14,17,';
	//欄目
	if(strstr($thecdo,",".$enews.","))
	{
		$classname=$class_r[$classid][classname];
		$r[classid]=$classid;
		$classurl=sys_ReturnBqClassname($r,9);
    }
	//專題
	elseif(strstr($thezdo,",".$enews.","))
	{
		$r[ztid]=$classid;
		$classname=$class_zr[$classid][ztname];
		$classurl=sys_ReturnBqZtname($r);
    }
	else
	{}
	if($classname)
	{
		$temp=str_replace("[!--the.classname--]",$classname,$temp);
		$temp=str_replace("[!--the.classurl--]",$classurl,$temp);
		$temp=str_replace("[!--the.classid--]",$classid,$temp);
	}
	return $temp;
}

//帶模板的標籤
function sys_GetEcmsInfo($classid,$line,$strlen,$have_class=0,$enews=0,$tempid,$doing=0,$ewhere='',$eorder=''){
	global $empire,$public_r;
	$sql=sys_ReturnBqQuery($classid,$line,$enews,$doing,$ewhere,$eorder);
	if(!$sql)
	{return "";}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	$docode=$tr[docode];
	//替換變量
	$listtemp=ReplaceEcmsinfoClassname($listtemp,$enews,$classid);
	if(empty($rownum))
	{$rownum=1;}
	//字段
	$ret_r=ReturnReplaceListF($tr[modid]);
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	while($r=$empire->fetch($sql))
	{
		$r[oldtitle]=$r[title];
		//替換列表變量
		$repvar=ReplaceListVars($no,$listvar,$subnews,$strlen,$formatdate,$url,$have_class,$r,$ret_r,$docode);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
    }
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//靈動標籤：返回SQL內容函數
function sys_ReturnEcmsLoopBq($classid=0,$line=10,$enews=3,$doing=0,$ewhere='',$eorder=''){
	return sys_ReturnBqQuery($classid,$line,$enews,$doing,$ewhere,$eorder);
}

//靈動標籤：返回特殊內容函數
function sys_ReturnEcmsLoopStext($r){
	global $class_r;
	$sr['titleurl']=sys_ReturnBqTitleLink($r);
	$sr['classname']=$class_r[$r[classid]][bname]?$class_r[$r[classid]][bname]:$class_r[$r[classid]][classname];
	$sr['classurl']=sys_ReturnBqClassname($r,9);
	return $sr;
}

//返回相關鏈接操作類型
function sys_OtherLinkQuery($classid,$line,$enews,$doing){
	global $empire,$public_r,$class_r,$class_zr,$navinfor,$dbtbpre,$eyh_r,$etable_r,$class_tr;
	if($enews==1)//按表
	{
		$tbname=$classid;
	}
	elseif($enews==2)//按欄目
	{
		if($classid=='selfinfo')//當前欄目
		{
			$classid=$navinfor['classid'];
		}
		$tbname=$class_r[$classid]['tbname'];
		if($class_r[$classid][islast])
		{
			$and="classid='$classid'";
		}
		else
		{
			$and=ReturnClass($class_r[$classid][sonclass]);
		}
	}
	elseif($enews==3)//按標題分類
	{
		$tbname=$class_tr[$classid]['tbname'];
		$and="ttid='$classid'";
	}
	else//默認
	{
		$tbname=$class_r[$navinfor[classid]]['tbname'];
	}
	//關鍵字
	$keys='';
	if(!empty($enews))
	{
		$repadd='';
		$keyr=explode(',',$navinfor['keyboard']);
		$count=count($keyr);
		for($i=0;$i<$count;$i++)
		{
			if($i==0)
			{
				$or='';
			}
			else
			{
				$or=' or ';
			}
			$repadd.=$or."[!--f--!] like '%".$keyr[$i]."%'";
		}
		//搜索範圍
		if($public_r['newslink']==1)
		{
			$keys='('.str_replace('[!--f--!]','keyboard',$repadd).')';
		}
		elseif($public_r['newslink']==2)
		{
			$keys='('.str_replace('[!--f--!]','keyboard',$repadd).' or '.str_replace('[!--f--!]','title',$repadd).')';
		}
		else
		{
			$keys='('.str_replace('[!--f--!]','title',$repadd).')';
		}
	}
	else
	{
		$keys='id in ('.$navinfor['keyid'].')';
	}
	//當前信息
	if($tbname==$class_r[$navinfor[classid]][tbname])
	{
		$and.=empty($and)?"id<>'$navinfor[id]'":" and id<>'$navinfor[id]'";
	}
	//圖片信息
	if($doing)
	{
		$and.=empty($and)?"ispic=1":" and ispic=1";
    }
	if($and)
	{
		$and.=' and ';
	}
	if(empty($line))
	{
		$line=$class_r[$navinfor[classid]]['link_num'];
	}
	//優化
	$yhvar='otherlink';
	$yhid=$etable_r[$tbname][yhid];
	$yhadd='';
	if($yhid)
	{
		$yhadd=ReturnYhSql($yhid,$yhvar,1);
	}
	$query="select * from {$dbtbpre}ecms_".$tbname." where ".$yhadd.$and.$keys." order by newstime desc limit $line";
	$sql=$empire->query1($query);
	if(!$sql)
	{
		echo"SQL Error: ".ReRepSqlTbpre($query);
	}
	return $sql;
}

//相關鏈接標籤
function sys_GetOtherLinkInfo($tempid,$classid='',$line=0,$strlen=60,$have_class=0,$enews=0,$doing=0){
	global $empire,$navinfor,$public_r;
	if(empty($navinfor['keyboard'])||(empty($enews)&&!$navinfor['keyid']))
	{
		return '';
	}
	$sql=sys_OtherLinkQuery($classid,$line,$enews,$doing);
	if(!$sql)
	{return "";}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	$docode=$tr[docode];
	//替換變量
	$listtemp=ReplaceEcmsinfoClassname($listtemp,$enews,$classid);
	if(empty($rownum))
	{$rownum=1;}
	//字段
	$ret_r=ReturnReplaceListF($tr[modid]);
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	while($r=$empire->fetch($sql))
	{
		$r[oldtitle]=$r[title];
		//替換列表變量
		$repvar=ReplaceListVars($no,$listvar,$subnews,$strlen,$formatdate,$url,$have_class,$r,$ret_r,$docode);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
    }
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//文字標籤函數
function sys_GetClassNews($classid,$line,$strlen,$showdate=true,$enews=0,$have_class=0,$formatdate='(m-d)',$ewhere='',$eorder=''){
	global $empire;
	$sql=sys_ReturnBqQuery($classid,$line,$enews,0,$ewhere,$eorder);
	if(!$sql)
	{return "";}
	$record=0;
	while($r=$empire->fetch($sql))
	{
		$record=1;
		$oldtitle=$r[title];
		$title=sub($r[title],0,$strlen,false);
		//標題屬性
		$title=DoTitleFont($r[titlefont],$title);
		//顯示欄目
		$myadd=sys_ReturnBqClassname($r,$have_class);
		//顯示時間
        if($showdate)
		{
			$newstime=date($formatdate,$r[newstime]);
            $newstime="&nbsp;".$newstime;
        }
		//標題鏈接
		$titleurl=sys_ReturnBqTitleLink($r);
        $title="<b>.</b>".$myadd."<a href='".$titleurl."' target=_blank title='".$oldtitle."'>".$title."</a>".$newstime;
        $allnews.="<tr><td height=20>".$title."</td></tr>";
    }
	if($record)
	{
		echo"<table border=0 cellpadding=0 cellspacing=0>$allnews</table>";
	}
}

//圖文信息調用
function sys_GetClassNewsPic($classid,$line,$num,$width,$height,$showtitle=true,$strlen,$enews=0,$ewhere='',$eorder=''){
	global $empire;
	$sql=sys_ReturnBqQuery($classid,$num,$enews,1,$ewhere,$eorder);
	if(!$sql)
	{return "";}
	//輸出
	$i=0;
	while($r=$empire->fetch($sql))
	{
		$i++;
		if(($i-1)%$line==0||$i==1)
		{$class_text.="<tr>";}
		//標題鏈接
		$titleurl=sys_ReturnBqTitleLink($r);
		//------是否顯示標題
		if($showtitle)
		{
			$oldtitle=$r[title];
			$title=sub($r[title],0,$strlen,false);
			//標題屬性
			$title=DoTitleFont($r[titlefont],$title);
			$title="<br><span style='line-height:15pt'>".$title."</span>";
		}
        $class_text.="<td align=center><a href='".$titleurl."' target=_blank><img src='".$r[titlepic]."' width='".$width."' height='".$height."' border=0 alt='".$oldtitle."'>".$title."</a></td>";
        //分割
        if($i%$line==0)
		{$class_text.="</tr>";}
    }
    if($i<>0)
	{
		$table="<table width=100% border=0 cellpadding=3 cellspacing=0>";$table1="</table>";
        $ys=$line-$i%$line;
		$p=0;
        for($j=0;$j<$ys&&$ys!=$line;$j++)
		{
			$p=1;
			$class_text.="<td></td>";
        }
		if($p==1)
		{
			$class_text.="</tr>";
		}
	}
    $text=$table.$class_text.$table1;
    echo"$text";
}

//廣告標籤
function sys_GetAd($adid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}enewsad where adid='$adid'");
	//到期
	if($r['endtime']<>'0000-00-00'&&time()>to_time($r['endtime']))
	{
		echo addslashes($r[reptext]);
		return '';
	}
	if($r['ylink'])
	{
		$ad_url=$r['url'];
	}
	else
	{
		$ad_url=$public_r[newsurl]."e/public/ClickAd?adid=".$adid;//廣告鏈接
	}
	//----------------------文字廣告
	if($r[t]==1)
	{
		$r[titlefont]=$r[titlecolor].','.$r[titlefont];
		$picurl=DoTitleFont($r[titlefont],$r[picurl]);//文字屬性
		$h="<a href='".$ad_url."' target=".$r[target]." title='".$r[alt]."'>".addslashes($picurl)."</a>";
		//普通顯示
		if($r[adtype]==1)
		{
			$html=$h;
	    }
		//可移動透明對話框
		else
		{
			$html="<script language=javascript src=".$public_r[newsurl]."d/js/acmsd/ecms_dialog.js></script> 
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >關閉>>><img border='0' src='".$public_r[newsurl]."d/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
	    }
    }
	//------------------html廣告
	elseif($r[t]==2)
	{
		$h=addslashes($r[htmlcode]);
		//普通顯示
		if($r[adtype]==1)
		{
			$html=$h;
		}
		//可移動透明對話框
		else
		{
			$html="<script language=javascript src=".$public_r[newsurl]."d/js/acmsd/ecms_dialog.js></script>
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >關閉>>><img border='0' src='".$public_r[newsurl]."d/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
		}
    }
	//------------------彈出廣告
	elseif($r[t]==3)
	{
		//打開新窗口
		if($r[adtype]==8)
		{
			$html="<script>window.open('".$r[url]."');</script>";
		}
		//彈出窗口
	    elseif($r[adtype]==9)
		{
			$html="<script>window.open('".$r[url]."','','width=".$r[pic_width].",height=".$r[pic_height].",scrollbars=yes');</script>";
		}
		//普能網頁窗口
		else
		{
			$html="<script>window.showModalDialog('".$r[url]."','','dialogWidth:".$r[pic_width]."px;dialogHeight:".$r[pic_height]."px;scroll:no;status:no;help:no');</script>";
		}
    }
	//---------------------圖片與flash廣告
	else
	{
		$filetype=GetFiletype($r[picurl]);
		//flash
		if($filetype==".swf")
		{
			$h="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' name='movie' width='".$r[pic_width]."' height='".$r[pic_height]."' id='movie'><param name='movie' value='".$r[picurl]."'><param name='quality' value='high'><param name='menu' value='false'><embed src='".$r[picurl]."' width='".$r[pic_width]."' height='".$r[pic_height]."' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' id='movie' name='movie' menu='false'></embed><PARAM NAME='wmode' VALUE='Opaque'></object>";
		}
		else
		{
			$h="<a href='".$ad_url."' target=".$r[target]."><img src='".$r[picurl]."' border=0 width='".$r[pic_width]."' height='".$r[pic_height]."' alt='".$r[alt]."'></a>";
		}
		//普通顯示
		if($r[adtype]==1)
		{
			$html=$h;
		}
		//滿屏浮動顯示
		elseif($r[adtype]==4)
		{
			$html="<script>ns4=(document.layers)?true:false;
ie4=(document.all)?true:false;
if(ns4){document.write(\"<layer id=DGbanner2 width=".$r[pic_width]." height=".$r[pic_height]." onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</layer>\");}
else{document.write(\"<div id=DGbanner2 style='position:absolute; width:".$r[pic_width]."px; height:".$r[pic_height]."px; z-index:9; filter: Alpha(Opacity=90)' onmouseover=stopme('DGbanner2') onmouseout=movechip('DGbanner2')>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[newsurl]."d/js/acmsd/ecms_float_fullscreen.js></script>";
		}
		//上下浮動顯示 - 右
		elseif($r[adtype]==5)
		{
			$html="<script>if (navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner3 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner3 style='position: absolute;width:".$r[pic_height].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[newsurl]."d/js/acmsd/ecms_float_upanddown.js></script>";
		}
		//上下浮動顯示 - 左
		elseif($r[adtype]==6)
		{
			$html="<script>if(navigator.appName == 'Netscape')
{document.write(\"<layer id=DGbanner10 top=150 width=".$r[pic_width]." height=".$r[pic_height].">".$h."</layer>\");}
else{document.write(\"<div id=DGbanner10 style='position: absolute;width:".$r[pic_width].";top:150;visibility: visible;z-index: 1'>".$h."</div>\");}</script>
<script language=javascript src=".$public_r[newsurl]."d/js/acmsd/ecms_float_upanddown_L.js></script>";
		}
		//全屏幕漸隱消失
		elseif($r[adtype]==7)
		{
			$html="<script>ns4=(document.layers)?true:false;
if(ns4){document.write(\"<layer id=DGbanner4Cont onLoad='moveToAbsolute(layer1.pageX-160,layer1.pageY);clip.height=".$r[pic_height].";clip.width=".$r[pic_width]."; visibility=show;'><layer id=DGbanner4News position:absolute; top:0; left:0>".$h."</layer></layer>\");}
else{document.write(\"<div id=DGbanner4 style='position:absolute;top:0; left:0;'><div id=DGbanner4Cont style='position:absolute;width:".$r[pic_width].";height:".$r[pic_height].";clip:rect(0,".$r[pic_width].",".$r[pic_height].",0)'><div id=DGbanner4News style='position:absolute;top:0;left:0;right:820'>".$h."</div></div></div>\");}</script> 
<script language=javascript src=".$public_r[newsurl]."d/js/acmsd/ecms_fullscreen.js></script>";
		}
		//可移動透明對話框
		elseif($r[adtype]==3)
		{
			$html="<script language=javascript src=".$public_r[newsurl]."d/js/acmsd/ecms_dialog.js></script> 
<div style='position:absolute;left:300px;top:150px;width:".$r[pic_width]."; height:".$r[pic_height].";z-index:1;solid;filter:alpha(opacity=90)' id=DGbanner5 onmousedown='down1(this)' onmousemove='move()' onmouseup='down=false'><table cellpadding=0 border=0 cellspacing=1 width=".$r[pic_width]." height=".$r[pic_height]." bgcolor=#000000><tr><td height=18 bgcolor=#5A8ACE align=right style='cursor:move;'><a href=# style='font-size: 9pt; color: #eeeeee; text-decoration: none' onClick=clase('DGbanner5') >關閉>>><img border='0' src='".$public_r[newsurl]."d/js/acmsd/close_o.gif'></a>&nbsp;</td></tr><tr><td bgcolor=f4f4f4 >&nbsp;".$h."</td></tr></table></div>";
		}
		else
		{
			$html="<script>function closeAd(){huashuolayer2.style.visibility='hidden';huashuolayer3.style.visibility='hidden';}function winload(){huashuolayer2.style.top=109;huashuolayer2.style.left=5;huashuolayer3.style.top=109;huashuolayer3.style.right=5;}//if(document.body.offsetWidth>800){
				{document.write(\"<div id=huashuolayer2 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[newsurl]."d/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\"+\"<div id=huashuolayer3 style='position: absolute;visibility:visible;z-index:1'><table width=0  border=0 cellspacing=0 cellpadding=0><tr><td height=10 align=right bgcolor=666666><a href=javascript:closeAd()><img src=".$public_r[newsurl]."d/js/acmsd/close.gif width=12 height=10 border=0></a></td></tr><tr><td>".$h."</td></tr></table></div>\");}winload()//}</script>";
		}
	}
	echo $html;
}

//投票標籤
function sys_GetVote($voteid){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}enewsvote where voteid='$voteid'");
	if(empty($r[votetext]))
	{
		return '';
	}
	//模板
	$votetemp=ReturnVoteTemp($r[tempid],0);
	$votetemp=RepVoteTempAllvar($votetemp,$r);
	$listexp="[!--empirenews.listtemp--]";
	$listtemp_r=explode($listexp,$votetemp);
	$r_exp="\r\n";
	$f_exp="::::::";
	//項目數
	$r_r=explode($r_exp,$r[votetext]);
	$checked=0;
	for($i=0;$i<count($r_r);$i++)
	{
		$checked++;
		$f_r=explode($f_exp,$r_r[$i]);
		//投票類型
		if($r[voteclass])
		{$vote="<input type=checkbox name=vote[] value=".$checked.">";}
		else
		{$vote="<input type=radio name=vote value=".$checked.">";}
		$votetext.=RepVoteTempListvar($listtemp_r[1],$vote,$f_r[0]);
    }
	$votetext=$listtemp_r[0].$votetext.$listtemp_r[2];
	echo"$votetext";
}

//信息投票標籤
function sys_GetInfoVote($classid,$id){
	global $empire,$public_r,$dbtbpre;
	$r=$empire->fetch1("select * from {$dbtbpre}enewsinfovote where id='$id' and classid='$classid' limit 1");
	if(empty($r[votetext]))
	{
		return '';
	}
	//模板
	$votetemp=ReturnVoteTemp($r[tempid],0);
	$votetemp=RepVoteTempAllvar($votetemp,$r);
	$listexp="[!--empirenews.listtemp--]";
	$listtemp_r=explode($listexp,$votetemp);
	$r_exp="\r\n";
	$f_exp="::::::";
	//項目數
	$r_r=explode($r_exp,$r[votetext]);
	$checked=0;
	for($i=0;$i<count($r_r);$i++)
	{
		$checked++;
		$f_r=explode($f_exp,$r_r[$i]);
		//投票類型
		if($r[voteclass])
		{$vote="<input type=checkbox name=vote[] value=".$checked.">";}
		else
		{$vote="<input type=radio name=vote value=".$checked.">";}
		$votetext.=RepVoteTempListvar($listtemp_r[1],$vote,$f_r[0]);
    }
	$votetext=$listtemp_r[0].$votetext.$listtemp_r[2];
	return $votetext;
}

//友情鏈接
function sys_GetSitelink($line,$num,$enews=0,$classid=0,$stats=0){
	global $empire,$public_r,$dbtbpre;
	//圖片
	if($enews==1)
	{$a=" and lpic<>''";}
	//文字
	elseif($enews==2)
	{$a=" and lpic=''";}
	else
	{$a="";}
	//調用相應的欄目分類
	if(!empty($classid))
	{
		$whereclass=" and classid='$classid'";
	}
	$sql=$empire->query("select * from {$dbtbpre}enewslink where checked=1".$a.$whereclass." order by myorder,lid limit ".$num);
	//輸出
	$i=0;
	while($r=$empire->fetch($sql))
	{
		//鏈接
		if(empty($stats))
		{
			$linkurl=$public_r[newsurl]."e/public/GotoSite/?lid=".$r[lid]."&url=".urlencode($r[lurl]);
		}
		else
		{
			$linkurl=$r[lurl];
		}
		$i++;
		if(($i-1)%$line==0||$i==1)
		{$class_text.="<tr>";}
		//文字
		if(empty($r[lpic]))
		{
			$logo="<a href='".$linkurl."' title='".$r[lname]."' target=".$r[target].">".$r[lname]."</a>";
		}
		//圖片
		else
		{
			$logo="<a href='".$linkurl."' target=".$r[target]."><img src='".$r[lpic]."' alt='".$r[lname]."' border=0 width='".$r[width]."' height='".$r[height]."'></a>";
		}
		$class_text.="<td align=center>".$logo."</td>";
		//分割
		if($i%$line==0)
		{$class_text.="</tr>";}
	}
	if($i<>0)
	{
		$table="<table width=100% border=0 cellpadding=3 cellspacing=0>";$table1="</table>";
        $ys=$line-$i%$line;
		$p=0;
        for($j=0;$j<$ys&&$ys!=$line;$j++)
		{
			$p=1;
			$class_text.="<td></td>";
        }
		if($p==1)
		{
			$class_text.="</tr>";
		}
	}
	$text=$table.$class_text.$table1;
    echo"$text";
}

//引用文件
function sys_IncludeFile($file){
	@include($file);
}

//讀取遠程文件
function sys_ReadFile($http){
	echo ReadFiletext($http);
}

//信息統計
function sys_TotalData($classid,$enews=0,$day=0,$totaltype=0){
	global $empire,$class_r,$class_zr,$dbtbpre,$fun_r,$class_tr;
	if(empty($classid))
	{
		return "";
    }
	//統計類型
	if($totaltype==1)//評論數
	{
		$totalfield='sum(plnum) as total';
	}
	elseif($totaltype==2)//點擊數
	{
		$totalfield='sum(onclick) as total';
	}
	elseif($totaltype==3)//下載數
	{
		$totalfield='sum(totaldown) as total';
	}
	else//信息數
	{
		$totalfield='count(*) as total';
	}
	if($day)
	{
		if($day==1)//今日信息
		{
			$date=date("Y-m-d");
			$starttime=$date." 00:00:01";
			$endtime=$date." 23:59:59";
		}
		elseif($day==2)//本月信息
		{
			$date=date("Y-m");
			$starttime=$date."-01 00:00:01";
			$endtime=$date."-".date("t")." 23:59:59";
		}
		elseif($day==3)//本年信息
		{
			$date=date("Y");
			$starttime=$date."-01-01 00:00:01";
			$endtime=($date+1)."-01-01 00:00:01";
		}
		$and=" and newstime>=".to_time($starttime)." and newstime<=".to_time($endtime);
	}
	if($enews==1)//統計標題分類
	{
		if(empty($class_tr[$classid][tbname]))
		{
			echo $fun_r['BqErrorTtid']."=<b>".$classid."</b>".$fun_r['BqErrorNtb'];
			return "";
		}
		$query="select ".$totalfield." from {$dbtbpre}ecms_".$class_tr[$classid][tbname]." where ttid='$classid'".$and;
    }
	elseif($enews==2)//統計數據表
	{
		$query="select ".$totalfield." from {$dbtbpre}ecms_".$classid.(empty($and)?'':' where '.substr($and,5));
    }
	else//統計欄目數據
	{
		if(empty($class_r[$classid][tbname]))
		{
			echo $fun_r['BqErrorCid']."=<b>".$classid."</b>".$fun_r['BqErrorNtb'];
			return "";
		}
		if($class_r[$classid][islast])//終極欄目
		{
			$where="classid='$classid'";
		}
		else//大欄目
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		$query="select ".$totalfield." from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where ".$where.$and;
    }
	$num=$empire->gettotal($query);
	echo $num;
}

//flash幻燈圖片信息調用
function sys_FlashPixpic($classid,$line,$width,$height,$showtitle=true,$strlen,$enews=0,$sec=5,$ewhere='',$eorder=''){
	global $empire,$public_r,$class_r,$class_zr;
	$sql=sys_ReturnBqQuery($classid,$line,$enews,1,$ewhere,$eorder);
	if(!$sql)
	{return "";}
	$i=0;
	while($r=$empire->fetch($sql))
	{
		//標題鏈接
		$titleurl=sys_ReturnBqTitleLink($r);
		//------是否顯示標題
		if($showtitle)
		{
			$title=sub($r[title],0,$strlen,false);
			//標題屬性
			$title=addslashes(DoTitleFont($r[titlefont],ehtmlspecialchars($title)));
		}
		$fh="|";
		if($i==0)
		{
			$fh="";
		}
		$url.=$fh.$titleurl;
		$pic.=$fh.$r[titlepic];
		$subject.=$fh.$title;
		$i=1;
	}
	//顯示標題
	if($showtitle)
	{
		$text_height=22;
	}
	else
	{
		$text_height=0;
	}
?>
<script type="text/javascript">
<!--
 var interval_time=<?=$sec?>;
 var focus_width=<?=$width?>;
 var focus_height=<?=$height?>;
 var text_height=<?=$text_height?>;
 var text_align="center";
 var swf_height = focus_height+text_height;
 var swfpath="<?=$public_r[newsurl]?>e/data/images/pixviewer.swf";
 var swfpatha="<?=$public_r[newsurl]?>e/data/images/pixviewer.swf";
 
 var pics="<?=urlencode($pic)?>";
 var links="<?=urlencode($url)?>";
 var texts="<?=ehtmlspecialchars($subject)?>";
 
 document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
 document.write('<param name="movie" value="'+swfpath+'"><param name="quality" value="high"><param name="bgcolor" value="#ffffff">');
 document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
 document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'&text_align='+text_align+'&interval_time='+interval_time+'">');
 document.write('<embed src="'+swfpath+'" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'&text_align='+text_align+'&interval_time='+interval_time+'" menu="false" bgcolor="#ffffff" quality="high" width="'+ focus_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
 document.write('</object>');
//-->
</script>
<?php
}

//搜索關鍵字
function sys_ShowSearchKey($line,$num,$classid=0,$enews=0){
	global $empire,$public_r,$dbtbpre;
	if($enews)
	{
		$order="searchid";
	}
	else
	{
		$order="onclick";
	}
	if($classid)
	{
		$add=" and classid='$classid'";
	}
	$sql=$empire->query("select searchid,keyboard from {$dbtbpre}enewssearch where iskey=0".$add." order by ".$order." desc limit ".$num);
	$i=0;
	$returnkey="";
	while($r=$empire->fetch($sql))
	{
		$i++;
		$keyurl=$public_r[newsurl]."e/search/result/?searchid=$r[searchid]";
		$br="";
		if($i%$line==0)
		{
			$br="<br>";
		}
		$jg="&nbsp;";
		if($br)
		{
			$jg="";
		}
		$returnkey.="<a href='".$keyurl."' target=_blank>".$r[keyboard]."</a>".$jg.$br;
	}
	echo $returnkey;
}

//帶模板的標籤顯示-循環
function sys_GetEcmsInfoMore($classid,$line,$strlen,$have_class=0,$ecms=0,$tr,$doing=0,$field,$cr,$dofirstinfo=0,$fsubtitle=0,$fsubnews=0,$fdoing=0,$ewhere='',$eorder=''){
	global $empire,$public_r;
	//操作類型
	if($ecms==0)//欄目最新
	{
		$enews=0;
	}
	elseif($ecms==1)//欄目熱門
	{
		$enews=1;
	}
	elseif($ecms==2)//欄目推薦
	{
		$enews=2;
	}
	elseif($ecms==3)//欄目評論排行
	{
		$enews=9;
	}
	elseif($ecms==4)//欄目頭條
	{
		$enews=12;
	}
	elseif($ecms==5)//欄目下載排行
	{
		$enews=15;
	}
	elseif($ecms==6)//欄目評分
	{
		$enews=25;
	}
	elseif($ecms==7)//欄目投票
	{
		$enews=26;
	}
	else
	{
		$enews=0;
	}
	$sql=sys_ReturnBqQuery($classid,$line,$enews,$doing,$ewhere,$eorder);
	if(!$sql)
	{return "";}
	//取得模板
	$listtemp=$tr[temptext];
	$subnews=$tr[subnews];
	$listvar=$tr[listvar];
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	$docode=$tr[docode];
	//替換變量
	$listtemp=ReplaceEcmsinfoClassname($listtemp,$enews,$classid);
	$listtemp=sys_ForSonclassDataFirstInfo($listtemp,$cr,$dofirstinfo,$fsubtitle,$fsubnews,$fdoing);
	if(empty($rownum))
	{$rownum=1;}
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	while($r=$empire->fetch($sql))
	{
		$r[oldtitle]=$r[title];
		//替換列表變量
		$repvar=ReplaceListVars($no,$listvar,$subnews,$strlen,$formatdate,$url,$have_class,$r,$field,$docode);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
    }
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//循環子欄目顯示頭條信息
function sys_ForSonclassDataFirstInfo($temptext,$cr,$ecms=0,$subtitle=0,$subnews=0,$fdoing=0){
	global $empire,$class_r,$public_r,$dbtbpre;
	if($ecms==2||$ecms==3||$ecms==4)
	{
		$where=$class_r[$cr[classid]][islast]?"classid='$cr[classid]'":ReturnClass($class_r[$cr[classid]][sonclass]);
	}
	if($fdoing)
	{
		$add=" and ispic=1";
	}
	if($ecms==1)//欄目縮圖
	{
		$id=$cr['classid'];
		$title=$cr['classname'];
		$titleurl=sys_ReturnBqClassname($cr,9);
		$titlepic=$cr['classimg'];
		$smalltext=$cr['intro'];
	}
	elseif($ecms==2)//推薦信息
	{
		$r=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$cr[classid]][tbname]." where isgood>0 and (".$where.")".$add." order by newstime desc limit 1");
	}
	elseif($ecms==3)//頭條信息
	{
		$r=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$cr[classid]][tbname]." where firsttitle>0 and (".$where.")".$add." order by newstime desc limit 1");
	}
	elseif($ecms==4)//最新信息
	{
		$r=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$cr[classid]][tbname]." where (".$where.")".$add." order by newstime desc limit 1");
	}
	else
	{
		return $temptext;
	}
	if($ecms!=1)
	{
		$id=$r['id'];
		$title=$r['title'];
		$titleurl=sys_ReturnBqTitleLink($r);
		$titlepic=$r['titlepic'];
		//簡介
		if($r['smalltext'])
		{$smalltext=$r['smalltext'];}
		elseif($r['flashsay'])
		{$smalltext=$r['flashsay'];}
		elseif($r['softsay'])
		{$smalltext=$r['softsay'];}
		elseif($r['moviesay'])
		{$smalltext=$r['moviesay'];}
		elseif($r['picsay'])
		{$smalltext=$r['picsay'];}
	}
	$oldtitle=$title;
	if($subtitle)
	{$title=sub($title,0,$subtitle,false);}
	if(empty($titlepic))
	{$titlepic=$public_r[newsurl]."e/data/images/notimg.gif";}
	if(!empty($subnews))
	{$smalltext=sub($smalltext,0,$subnews,false);}
	$temptext=str_replace('[!--sonclass.id--]',$id,$temptext);
	$temptext=str_replace('[!--sonclass.title--]',$title,$temptext);
	$temptext=str_replace('[!--sonclass.oldtitle--]',$oldtitle,$temptext);
	$temptext=str_replace('[!--sonclass.titlepic--]',$titlepic,$temptext);
	$temptext=str_replace('[!--sonclass.titleurl--]',$titleurl,$temptext);
	$temptext=str_replace('[!--sonclass.text--]',$smalltext,$temptext);
	return $temptext;
}

//循環子欄目數據
function sys_ForSonclassData($classid,$line,$strlen,$have_class=0,$enews=0,$tempid,$doing=0,$cline=0,$dofirstinfo=0,$fsubtitle=0,$fsubnews=0,$fdoing=0,$ewhere='',$eorder=''){
	global $empire,$public_r,$class_r,$class_zr,$navclassid,$dbtbpre;
	//多欄目
	if(strstr($classid,","))
	{
		$son_r=sys_ReturnMoreClass($classid);
		$classid=$son_r[0];
		$where=$son_r[1];
	}
	else
	{
		//當前欄目
		if($classid=="selfinfo")
		{
			$classid=$navclassid;
		}
		$where="bclassid='$classid'";
	}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$tr[temptext]=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$tr[listvar]=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	//限制條數
	if($cline)
	{
		$limit=" limit ".$cline;
	}
	//字段
	$ret_r=ReturnReplaceListF($tr[modid]);
	//欄目字段
	if($dofirstinfo==1)
	{
		$addclassfield=',classname,classimg,intro';
	}
	$csql=$empire->query("select classid".$addclassfield." from {$dbtbpre}enewsclass where ".$where." and wburl='' order by myorder,classid".$limit);
	while($cr=$empire->fetch($csql))
	{
		sys_GetEcmsInfoMore($cr[classid],$line,$strlen,$have_class,$enews,$tr,$doing,$ret_r,$cr,$dofirstinfo,$fsubtitle,$fsubnews,$fdoing,$ewhere,$eorder);
	}
}

//帶模板的欄目導航標籤
function sys_ShowClassByTemp($classid,$tempid,$show=0,$cline=0){
	global $navclassid,$empire,$class_r,$public_r,$dbtbpre;
	//當前欄目
	if($classid=="selfinfo")
	{
		if(empty($navclassid))
		{$classid=0;}
		else
		{
			$classid=$navclassid;
			//終極類別則顯示同級類別
			if($class_r[$classid][islast]&&$class_r[$classid][bclassid])
			{
				$classid=$class_r[$classid][bclassid];
			}
			if($class_r[$classid][islast]&&empty($class_r[$classid][bclassid]))
			{$classid=0;}
		}
	}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	if(empty($rownum))
	{$rownum=1;}
	//限制條數
	if($cline)
	{
		$limit=" limit ".$cline;
	}
	//替換變量
	$bclassname=$class_r[$classid][classname];
	$br[classid]=$classid;
	$bclassurl=sys_ReturnBqClassname($br,9);
	$listtemp=str_replace("[!--bclassname--]",$bclassname,$listtemp);
	$listtemp=str_replace("[!--bclassurl--]",$bclassurl,$listtemp);
	$listtemp=str_replace("[!--bclassid--]",$classid,$listtemp);
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	$sql=$empire->query("select classid,classname,islast,sonclass,tbname,intro,classimg,infos from {$dbtbpre}enewsclass where bclassid='$classid' and showclass=0 order by myorder,classid".$limit);
	while($r=$empire->fetch($sql))
	{
		//顯示類別數據數
		if($show)
		{
			$num=ReturnClassInfoNum($r);
		}
		//替換列表變量
		$repvar=ReplaceShowClassVars($no,$listvar,$r,$num,0,$subnews);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
	}
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//循環子欄目導航標籤
function sys_ForShowSonClass($classid,$tempid,$show=0,$cline=0){
	global $navclassid,$empire,$class_r,$public_r,$dbtbpre;
	//多欄目
	if(strstr($classid,","))
	{
		$where='classid in ('.$classid.')';
	}
	else
	{
		if($classid=="selfinfo")//當前欄目
		{
			$classid=intval($navclassid);
		}
		$where="bclassid='$classid'";
	}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$tr[temptext]=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$tr[listvar]=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	//限制條數
	if($cline)
	{
		$limit=" limit ".$cline;
	}
	$no=1;
	$sql=$empire->query("select classid,classname,islast,sonclass,tbname,intro,classimg,infos from {$dbtbpre}enewsclass where ".$where." and showclass=0 order by myorder,classid".$limit);
	while($r=$empire->fetch($sql))
	{
		//顯示欄目數據數
		if($show)
		{
			$num=ReturnClassInfoNum($r);
		}
		sys_GetShowClassMore($r[classid],$r,$tr,$no,$num,$show);
		$no++;
	}
}

//欄目導航標籤－循環
function sys_GetShowClassMore($bclassid,$bcr,$tr,$bno,$bnum,$show=0){
	global $empire,$class_r,$public_r,$dbtbpre;
	//取得模板
	$listtemp=$tr[temptext];
	$subnews=$tr[subnews];
	$listvar=$tr[listvar];
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	if(empty($rownum))
	{$rownum=1;}
	//替換變量
	$listtemp=str_replace("[!--bclassname--]",$bcr[classname],$listtemp);
	$bclassurl=sys_ReturnBqClassname($bcr,9);//欄目鏈接
	$listtemp=str_replace("[!--bclassurl--]",$bclassurl,$listtemp);
	$listtemp=str_replace("[!--bclassid--]",$bclassid,$listtemp);
	$bclassimg=$bcr[classimg]?$bcr[classimg]:$public_r[newsurl]."e/data/images/notimg.gif";//欄目圖片
	$listtemp=str_replace("[!--bclassimg--]",$bclassimg,$listtemp);
	$listtemp=str_replace("[!--bintro--]",nl2br($bcr[intro]),$listtemp);//欄目簡介
	$listtemp=str_replace("[!--bno--]",$bno,$listtemp);
	$listtemp=str_replace("[!--bnum--]",$bnum,$listtemp);
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	$sql=$empire->query("select classid,classname,islast,sonclass,tbname,intro,classimg,infos from {$dbtbpre}enewsclass where bclassid='$bclassid' and showclass=0 order by myorder,classid");
	while($r=$empire->fetch($sql))
	{
		//顯示欄目數據數
		if($show)
		{
			$num=ReturnClassInfoNum($r);
		}
		//替換列表變量
		$repvar=ReplaceShowClassVars($no,$listvar,$r,$num,0,$subnews);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
	}
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//替換欄目導航標籤
function ReplaceShowClassVars($no,$listtemp,$r,$num,$ecms=0,$subnews=0){
	global $public_r,$class_r;
	//欄目鏈接
	if($ecms==1)
	{
		$classurl=sys_ReturnBqZtname($r);
		$r['classname']=$r['ztname'];
		$r['classid']=$r['ztid'];
		$r['classimg']=$r['ztimg'];
	}
	else
	{
		$classurl=sys_ReturnBqClassname($r,9);
	}
	if($subnews)
	{
		$r[intro]=sub($r[intro],0,$subnews,false);
	}
	$listtemp=str_replace("[!--classurl--]",$classurl,$listtemp);
	//欄目名稱
	$listtemp=str_replace("[!--classname--]",$r[classname],$listtemp);
	//欄目id
	$listtemp=str_replace("[!--classid--]",$r[classid],$listtemp);
	//欄目圖片
	if(empty($r[classimg]))
	{
		$r[classimg]=$public_r[newsurl]."e/data/images/notimg.gif";
	}
	$listtemp=str_replace("[!--classimg--]",$r[classimg],$listtemp);
	//欄目簡介
	$listtemp=str_replace("[!--intro--]",nl2br($r[intro]),$listtemp);
	//記錄數
	$listtemp=str_replace("[!--num--]",$num,$listtemp);
	//序號
	$listtemp=str_replace("[!--no--]",$no,$listtemp);
	return $listtemp;
}

//留言調用
function sys_ShowLyInfo($line,$tempid,$bid=0){
	global $empire,$dbtbpre,$public_r;
	$a="";
	if($bid)
	{
		$a=" and bid='$bid'";
	}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	if(empty($rownum))
	{$rownum=1;}
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	$sql=$empire->query("select lyid,name,email,lytime,lytext,retext from {$dbtbpre}enewsgbook where checked=0".$a." order by lyid desc limit ".$line);
	while($r=$empire->fetch($sql))
	{
		//替換列表變量
		$repvar=ReplaceShowLyVars($no,$listvar,$r,$formatdate,$subnews);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
	}
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//替換留言標籤
function ReplaceShowLyVars($no,$listtemp,$r,$formatdate,$subnews=0){
	global $public_r;
	if($subnews)
	{
		$r['lytext']=sub($r['lytext'],0,$subnews,false);
	}
	$listtemp=str_replace("[!--lyid--]",$r['lyid'],$listtemp);//id
	$listtemp=str_replace("[!--lytext--]",nl2br($r['lytext']),$listtemp);//留言內容
	$listtemp=str_replace("[!--retext--]",nl2br($r['retext']),$listtemp);//回復
	$listtemp=str_replace("[!--lytime--]",format_datetime($r['lytime'],$formatdate),$listtemp);
	$listtemp=str_replace("[!--name--]",$r['name'],$listtemp);
	$listtemp=str_replace("[!--email--]",$r['email'],$listtemp);
	//序號
	$listtemp=str_replace("[!--no--]",$no,$listtemp);
	return $listtemp;
}

//專題調用
function sys_ShowZtData($tempid,$zcid=0,$cline=0,$classid=0){
	global $empire,$dbtbpre,$public_r;
	$a='';
	if($zcid)
	{
		$a.=' and zcid in ('.$zcid.')';
	}
	if($classid)
	{
		$a.=' and classid in ('.$classid.')';
	}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	if(empty($rownum))
	{$rownum=1;}
	//限制條數
	if($cline)
	{
		$limit=" limit ".$cline;
	}
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	$sql=$empire->query("select ztid,ztname,intro,ztimg from {$dbtbpre}enewszt where showzt=0".$a." order by myorder,ztid desc".$limit);
	while($r=$empire->fetch($sql))
	{
		//替換列表變量
		$repvar=ReplaceShowClassVars($no,$listvar,$r,$num,1,$subnews);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
	}
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//圖庫模型分頁標籤
function sys_PhotoMorepage($tempid,$spicwidth=0,$spicheight=0){
	global $navinfor;
	$morepic=$navinfor['morepic'];
	if(empty($morepic))
	{
		return "";
	}
	//取得標籤
	$tempr=sys_ReturnBqTemp($tempid);
	if(empty($tempr['tempid']))
	{return "";}
	$rexp="\r\n";
	$fexp="::::::";
	$gs="";
	if($spicwidth)
	{$gs=" width='".$spicwidth."'";}
	if($spicheight)
	{$gs.=" height='".$spicheight."'";}
	$rstr="";
	$sdh="";
	$firstpic="";
	$optionstr="";
	$titleoption="";
	$listpage="";
	$nbsp="";
	$rr=explode($rexp,$morepic);
	$count=count($rr);
	for($i=0;$i<$count;$i++)
	{
		$j=$i+1;
		$fr=explode($fexp,$rr[$i]);
		$smallpic=$fr[0];	//小圖
		$bigpic=$fr[1];	//大圖
		if(empty($bigpic))
		{
			$bigpic=$smallpic;
		}
		$picname=ehtmlspecialchars($fr[2]);	//名稱
		$showpic=ReplaceMorePagelistvar($tempr['listvar'],$picname,$bigpic);
		$sdh.=$nbsp."<a href='#ecms' onclick='GotoPhPage(".$j.");' title='".$picname."'><img src='".$smallpic."' alt='".$picname."' border=0".$gs."></a>";
		if($i==0)
		{
			$firstpic=$showpic;
		}
		$rstr.="photosr[".$j."]=\"".addslashes($showpic)."\";
		";
		$optionstr.="<option value=".$j.">第 ".$j." 頁</option>";
		$titleoption.="<option value=".$j.">".$j."、".$picname."</option>";
		$listpage.=$nbsp."<a href='#ecms' onclick='GotoPhPage(".$j.");' title='".$picname."'>".$j."</a>";
		$nbsp="&nbsp;";
	}
	echo ReplaceMorePagetemp($tempr['temptext'],$rstr,$sdh,$optionstr,$titleoption,$firstpic,$listpage);
}

//替換圖片集分頁模板
function ReplaceMorePagetemp($temp,$rstr,$sdh,$select,$titleselect,$showpic,$listpage){
	$temp=str_replace("[!--photor--]",$rstr,$temp);
	$temp=str_replace("[!--smalldh--]",$sdh,$temp);
	$temp=str_replace("[!--select--]",$select,$temp);
	$temp=str_replace("[!--titleselect--]",$titleselect,$temp);
	$temp=str_replace("[!--listpage--]",$listpage,$temp);
	$temp=str_replace("<!--list.var1-->",$showpic,$temp);
	return $temp;
}

//替換圖片集listvar模板
function ReplaceMorePagelistvar($temp,$picname,$picurl){
	$temp=str_replace("[!--picname--]",$picname,$temp);
	$temp=str_replace("[!--picurl--]",$picurl,$temp);
	return $temp;
}

//輸出復選框字段內容
function sys_EchoCheckboxFValue($f,$exp='<br>'){
	global $navinfor;
	$r=explode('|',$navinfor[$f]);
	$count=count($r);
	for($i=1;$i<$count-1;$i++)
	{
		if($i==1)
		{
			$str.=$r[$i];
		}
		else
		{
			$str.=$exp.$r[$i];
		}
	}
	echo $str;
}

//評論調用
function sys_ShowPlInfo($line,$tempid,$classid=0,$id=0,$isgood=0,$enews=0){
	global $empire,$dbtbpre,$class_r,$public_r;
	$a="";
	if($isgood)
	{
		$a.=" and isgood='$isgood'";
	}
	if($classid)
	{
		if($class_r[$classid][islast])
		{
			$where="classid='$classid'";
		}
		else
		{
			$where=ReturnClass($class_r[$classid][sonclass]);
		}
		$a.=" and ".$where;
	}
	if($id)
	{
		$a.=" and id='$id'";
	}
	//排序
	if($enews==1)//支持
	{
		$order='zcnum desc,plid desc';
	}
	elseif($enews==2)//反對
	{
		$order='fdnum desc,plid desc';
	}
	else//發佈時間
	{
		$order='plid desc';
	}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	if(empty($rownum))
	{$rownum=1;}
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	$sql=$empire->query("select plid,userid,username,saytime,id,classid,zcnum,fdnum,saytext from {$dbtbpre}enewspl_".$public_r['pldeftb']." where checked=0".$a." order by ".$order." limit ".$line);
	while($r=$empire->fetch($sql))
	{
		//替換列表變量
		$repvar=ReplaceShowPlVars($no,$listvar,$r,$formatdate,$subnews);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
	}
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//替換評論標籤
function ReplaceShowPlVars($no,$listtemp,$r,$formatdate,$subnews=0){
	global $public_r,$empire,$dbtbpre,$class_r;
	//標題
	$infor=$empire->fetch1("select isurl,titleurl,classid,id,title,titlepic from {$dbtbpre}ecms_".$class_r[$r[classid]][tbname]." where id='$r[id]' limit 1");
	$r['saytext']=stripSlashes($r['saytext']);
	if($subnews)
	{
		$r['saytext']=sub($r['saytext'],0,$subnews,false);
	}
	if($r['userid'])
	{
		$r['username']="<a href='".$public_r[newsurl]."e/space/?userid=$r[userid]' target='_blank'>$r[username]</a>";
	}
	if(empty($r['username']))
	{
		$r['username']='匿名';
	}
	$titleurl=sys_ReturnBqTitleLink($infor);
	$titlepic=$infor['titlepic']?$infor['titlepic']:$public_r['newsurl'].'e/data/images/notimg.gif';
	$listtemp=str_replace("[!--titleurl--]",$titleurl,$listtemp);
	$listtemp=str_replace("[!--title--]",$infor['title'],$listtemp);
	$listtemp=str_replace("[!--titlepic--]",$titlepic,$listtemp);
	$listtemp=str_replace("[!--plid--]",$r['plid'],$listtemp);
	$listtemp=str_replace("[!--pltext--]",RepPltextFace($r['saytext']),$listtemp);
	$listtemp=str_replace("[!--id--]",$r['id'],$listtemp);
	$listtemp=str_replace("[!--classid--]",$r['classid'],$listtemp);
	$listtemp=str_replace("[!--pltime--]",date($formatdate,$r['saytime']),$listtemp);
	$listtemp=str_replace("[!--username--]",$r['username'],$listtemp);
	$listtemp=str_replace("[!--zcnum--]",$r['zcnum'],$listtemp);
	$listtemp=str_replace("[!--fdnum--]",$r['fdnum'],$listtemp);
	//序號
	$listtemp=str_replace("[!--no--]",$no,$listtemp);
	return $listtemp;
}

//顯示單個會員信息
function sys_ShowMemberInfo($userid=0,$fields=''){
	global $empire,$dbtbpre,$public_r,$navinfor,$level_r;
	if(empty($userid)&&$navinfor[ismember]==0)
	{
		return '';
	}
	if(!defined('InEmpireCMSUser'))
	{
		include_once ECMS_PATH.'e/member/class/user.php';
	}
	$uid=$userid?$userid:$navinfor[userid];
	$uid=(int)$uid;
	if(empty($fields))
	{
		$fields='u.*,ui.*';
	}
	$r=$empire->fetch1("select ".$fields." from ".eReturnMemberTable()." u LEFT JOIN {$dbtbpre}enewsmemberadd ui ON u.".egetmf('userid')."=ui.userid where u.".egetmf('userid')."='$uid' limit 1");
	$field_groupid=egetmf('groupid');
	$r['groupname']=$level_r[$r[$field_groupid]][groupname];//會員組
	return $r;
}

//調用會員列表
function sys_ListMemberInfo($line=10,$ecms=0,$groupid=0,$userids=0,$fields=''){
	global $empire,$dbtbpre,$public_r,$navinfor,$level_r;
	if(!defined('InEmpireCMSUser'))
	{
		include_once ECMS_PATH.'e/member/class/user.php';
	}
	//操作類型
	if($ecms==1)//積分排行
	{
		$order='u.'.egetmf('userfen').' desc';
	}
	elseif($ecms==2)//資金排行
	{
		$order='u.'.egetmf('money').' desc';
	}
	elseif($ecms==3)//空間人氣排行
	{
		$order='ui.viewstats desc';
	}
	else//用戶ID排行
	{
		$order='u.'.egetmf('userid').' desc';
	}
	$where='';
	if($groupid)
	{
		$where.=' and u.'.egetmf('groupid').' in ('.$groupid.')';
	}
	if($userids)
	{
		$where.=' and u.'.egetmf('userid').' in ('.$userids.')';
	}
	if(empty($fields))
	{
		$fields='u.*,ui.*';
	}
	$sql=$empire->query("select ".$fields." from ".eReturnMemberTable()." u LEFT JOIN {$dbtbpre}enewsmemberadd ui ON u.".egetmf('userid')."=ui.userid where u.".egetmf('checked')."=1".$where." order by ".$order." limit ".$line);
	return $sql;
}

//顯示TAGS
function sys_eShowTags($cid,$num=0,$line=0,$order='',$isgood='',$isgoodshow='',$showjg='',$shownum=0,$cs='',$vartype=''){
	global $empire,$dbtbpre,$public_r,$navinfor;
	$str='';
	if(empty($showjg))
	{
		$showjg=' &nbsp; ';
	}
	$ln=0;
	if($cid=='selfinfo')
	{
		if(empty($navinfor['infotags']))
		{
			return '';
		}
		$jg='';
		$r=explode(',',$navinfor['infotags']);
		$count=count($r);
		for($i=0;$i<$count;$i++)
		{
			$ln++;
			$br='';
			if($line)
			{
				if($ln%$line==0)
				{
					$br='<br>';
				}
			}
			if(empty($cs))
			{
				$rewriter=eReturnRewriteTagsUrl(0,$r[$i],1);
				$tagsurl=$rewriter['pageurl'];
			}
			else
			{
				$tagsurl=$public_r[newsurl].'e/tags/?tagname='.urlencode($r[$i]).$cs;
			}
			$str.=$jg.'<a href="'.$tagsurl.'" target="_blank">'.$r[$i].'</a>'.$br;
			$jg=$br?'':$showjg;
		}
	}
	else
	{
		$and='';
		$where='';
		if($cid)
		{
			$where=strstr($cid,',')?"cid in ($cid)":"cid='$cid'";
			$and=' and ';
		}
		if($isgood)
		{
			$where.=$and.'isgood=1';
		}
		if($where)
		{
			$where=' where '.$where;
		}
		$order=$order?' '.$order:' tagid desc';
		$limit='';
		if($num)
		{
			$limit=' limit '.$num;
		}
		//推薦標紅
		$gfont1='';
		$gfont2='';
		if($isgoodshow)
		{
			if(strstr($isgoodshow,'r'))
			{
				$gfont1='<font color="red">';
				$gfont2='</font>';
			}
			if(strstr($isgoodshow,'s'))
			{
				$gfont1=$gfont1.'<b>';
				$gfont2='</b>'.$gfont2;
			}
		}
		$jg='';
		$snum='';
		$sql=$empire->query("select tagid,tagname,num,isgood from {$dbtbpre}enewstags".$where." order by".$order.$limit);
		while($r=$empire->fetch($sql))
		{
			if($shownum)
			{
				$snum='('.$r[num].')';
			}
			$font1='';
			$font2='';
			if($isgoodshow&&$r[isgood])
			{
				$font1=$gfont1;
				$font2=$gfont2;
			}
			$ln++;
			$br='';
			if($line)
			{
				if($ln%$line==0)
				{
					$br='<br>';
				}
			}
			if(empty($cs)&&$vartype<>'tagid')
			{
				$rewriter=eReturnRewriteTagsUrl($r['tagid'],$r['tagname'],1);
				$tagsurl=$rewriter['pageurl'];
			}
			else
			{
				$tagsurl=$public_r[newsurl].'e/tags/?'.($vartype=='tagid'?'tagid='.$r[tagid]:'tagname='.urlencode($r[tagname])).$cs;
			}
			$str.=$jg.'<a href="'.$tagsurl.'" target="_blank">'.$font1.$r[tagname].$snum.$font2.'</a>'.$br;
			$jg=$br?'':$showjg;
		}
	}
	echo $str;
}

//索引靈動標籤：返回SQL內容函數
function sys_ReturnEcmsIndexLoopBq($id=0,$line=10,$enews=3,$classid='',$mid='',$ewhere=''){
	global $navclassid;
	if($enews==1)//專題最新
	{
		$type='zt';
		$eorder='newstime desc';
		$selectf=',ztid,cid,isgood';
	}
	elseif($enews==2)//專題最早
	{
		$type='zt';
		$eorder='newstime asc';
		$selectf=',ztid,cid,isgood';
	}
	elseif($enews==3)//專題推薦
	{
		$type='zt';
		$eorder='newstime desc';
		$selectf=',ztid,cid,isgood';
		$where='isgood>0';
	}
	elseif($enews==4)//專題子類最新
	{
		$type='ztc';
		$eorder='newstime desc';
		$selectf=',ztid,cid,isgood';
	}
	elseif($enews==5)//專題子類最早
	{
		$type='ztc';
		$eorder='newstime asc';
		$selectf=',ztid,cid,isgood';
	}
	elseif($enews==6)//專題子類推薦
	{
		$type='ztc';
		$eorder='newstime desc';
		$selectf=',ztid,cid,isgood';
		$where='isgood>0';
	}
	elseif($enews==7)//碎片最新
	{
		$type='sp';
		$eorder='newstime desc';
		$selectf='';
	}
	elseif($enews==8)//碎片最早
	{
		$type='sp';
		$eorder='newstime asc';
		$selectf='';
	}
	elseif($enews==9)//TAGS最新
	{
		$type='tags';
		$eorder='newstime desc';
		$selectf='';
	}
	elseif($enews==10)//TAGS最早
	{
		$type='tags';
		$eorder='newstime asc';
		$selectf='';
	}
	elseif($enews==11)//SQL調用
	{
		$type='sql';
		$eorder='newstime asc';
		$selectf='';
	}
	if($id=='selfinfo')//顯示當前ID信息
	{
		$id=$navclassid;
	}
	if(!empty($where))
	{
		$ewhere=$ewhere?$where.' and ('.$ewhere.')':$where;
	}
	return sys_ReturnTogQuery($type,$id,$line,$classid,$mid,$ewhere,$eorder,$selectf);
}

//返回組合查詢
function sys_ReturnTogQuery($type,$id,$line,$classid='',$mid='',$ewhere='',$eorder='',$selectf=''){
	global $empire,$public_r,$class_r,$class_zr,$navclassid,$dbtbpre,$class_tr,$emod_r;
	if($type=='tags')//TAGS
	{
		$idf='tagid';
		$orderf='newstime desc';
		$table=$dbtbpre.'enewstagsdata';
	}
	elseif($type=='zt')//專題
	{
		$idf='ztid';
		$orderf='newstime desc';
		$table=$dbtbpre.'enewsztinfo';
	}
	elseif($type=='ztc')//專題子類
	{
		$idf='cid';
		$orderf='newstime desc';
		$table=$dbtbpre.'enewsztinfo';
	}
	elseif($type=='sql')//SQL查詢
	{
		$query_first=substr($id,0,7);
		if(!($query_first=='select '||$query_first=='SELECT '))
		{
			return '';
		}
		$id=RepSqlTbpre($id);
		$sql=$empire->query1($id);
		if(!$sql)
		{
			echo'SQL Error: '.ReRepSqlTbpre($id);
		}
		return $sql;
	}
	else//碎片
	{
		$idf='spid';
		$orderf='newstime desc';
		$table=$dbtbpre.'enewssp_2';
	}
	$where=strstr($id,',')?"$idf in ($id)":"$idf='$id'";
	//欄目
	if($classid)
	{
		if(strstr($classid,','))//多欄目
		{
			$son_r=sys_ReturnMoreClass($classid,1);
			$classid=$son_r[0];
			$add=$son_r[1];
		}
		else
		{
			if($classid=='selfinfo')//顯示當前欄目信息
			{
				$classid=$navclassid;
			}
			if($class_r[$classid][islast])
			{
				$add="classid='$classid'";
			}
			else
			{
				$add=ReturnClass($class_r[$classid][sonclass]);
			}
		}
		$where.=' and ('.$add.')';
	}
	//模型
	if($mid)
	{
		$where.=strstr($mid,',')?" and mid in ($mid)":" and mid='$mid'";
	}
	//附加sql條件
	if(!empty($ewhere))
	{
		$where.=' and ('.$ewhere.')';
	}
	//排序
	if(!empty($eorder))
	{
		$orderf=$eorder;
	}
	$query='select classid,id'.$selectf.' from '.$table.' where '.$where.' order by '.$orderf.' limit '.$line;
	$sql=$empire->query1($query);
	if(!$sql)
	{
		echo'SQL Error: '.ReRepSqlTbpre($query);
	}
	return $sql;
}

//調用TAGS信息
function sys_eShowTagsInfo($tagid,$line,$strlen,$tempid,$classid='',$mid=''){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r;
	if(empty($tagid))
	{
		return '';
	}
	$sql=sys_ReturnTogQuery('tags',$tagid,$line,$classid,$mid);
	if(!$sql)
	{return "";}
	//取得模板
	$tr=sys_ReturnBqTemp($tempid);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	$docode=$tr[docode];
	if(empty($rownum))
	{$rownum=1;}
	//字段
	$ret_r=ReturnReplaceListF($tr[modid]);
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	while($r=$empire->fetch($sql))
	{
		if(empty($class_r[$r[classid]][tbname]))
		{
			continue;
		}
		$infor=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$r[classid]][tbname]." where id='$r[id]' limit 1");
		if(empty($infor['id']))
		{
			continue;
		}
		$infor[oldtitle]=$infor[title];
		//替換列表變量
		$repvar=ReplaceListVars($no,$listvar,$subnews,$strlen,$formatdate,$url,$have_class,$infor,$ret_r,$docode);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
    }
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//-------------------------- 碎片 --------------------------
//顯示碎片
function sys_eShowSpInfo($spvar,$line=10,$strlen=0){
	global $empire,$dbtbpre,$public_r;
	if(empty($spvar))
	{
		return '';
	}
	$spr=$empire->fetch1("select spid,spname,sppic,spsay,tempid,sptype from {$dbtbpre}enewssp where varname='$spvar' limit 1");
	if($spr['sptype']==1)//靜態信息碎片
	{
		sys_eShowSp1($spr['spid'],$spr,$line,$strlen);
	}
	elseif($spr['sptype']==2)
	{
		sys_eShowSp2($spr['spid'],$spr,$line,$strlen);
	}
	elseif($spr['sptype']==3)
	{
		sys_eShowSp3($spr['spid']);
	}
}

//替換碎片名
function ReplaceSpClassname($temp,$spid,$spr){
	$temp=str_replace("[!--the.spname--]",$spr[spname],$temp);
	$temp=str_replace("[!--the.spid--]",$spid,$temp);
	$temp=str_replace("[!--the.sppic--]",$spr[sppic],$temp);
	$temp=str_replace("[!--the.spsay--]",$spr[spsay],$temp);
	return $temp;
}

//靜態信息碎片
function sys_eShowSp1($spid,$spr,$line,$strlen){
	global $empire,$dbtbpre,$public_r;
	//取得模板
	$tr=sys_ReturnBqTemp($spr['tempid']);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	//替換模板變量
	$listtemp=ReplaceSpClassname($listtemp,$spid,$spr);
	if(empty($rownum))
	{$rownum=1;}
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	$sql=$empire->query("select sid,title,titlepic,bigpic,titleurl,smalltext,titlefont,newstime,titlepre,titlenext from {$dbtbpre}enewssp_1 where spid='$spid' order by newstime desc limit ".$line);
	while($r=$empire->fetch($sql))
	{
		$r[oldtitle]=$r[title];
		//替換列表變量
		$repvar=ReplaceShowSponeVars($no,$listvar,$subnews,$strlen,$formatdate,$r);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
    }
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//替換靜態碎片標籤
function ReplaceShowSponeVars($no,$listtemp,$subnews,$subtitle,$formatdate,$r){
	global $public_r;
	//標題
	if(!empty($subtitle))//截取字符
	{
		$r[title]=sub($r[title],0,$subtitle,false);
	}
	$r[title]=DoTitleFont($r[titlefont],$r[title]);
	$listtemp=str_replace('[!--title--]',$r['title'],$listtemp);
	$listtemp=str_replace('[!--oldtitle--]',$r['oldtitle'],$listtemp);
	//時間
	$listtemp=str_replace('[!--newstime--]',date($formatdate,$r['newstime']),$listtemp);
	//其它變量
	$listtemp=str_replace('[!--id--]',$r['sid'],$listtemp);
	$listtemp=str_replace('[!--titleurl--]',$r['titleurl'],$listtemp);
	$listtemp=str_replace('[!--titlepic--]',$r['titlepic'],$listtemp);
	$listtemp=str_replace('[!--bigpic--]',$r['bigpic'],$listtemp);
	$listtemp=str_replace('[!--titlepre--]',$r['titlepre'],$listtemp);
	$listtemp=str_replace('[!--titlenext--]',$r['titlenext'],$listtemp);
	//簡介
	if(!empty($subnews))//截取字符
	{
		$r[smalltext]=sub($r[smalltext],0,$subnews,false);
	}
	$listtemp=str_replace('[!--smalltext--]',nl2br($r['smalltext']),$listtemp);
	//序號
	$listtemp=str_replace('[!--no.num--]',$no,$listtemp);
	return $listtemp;
}

//動態信息碎片
function sys_eShowSp2($spid,$spr,$line,$strlen){
	global $empire,$dbtbpre,$public_r,$class_r,$emod_r;
	$sql=sys_ReturnTogQuery('sp',$spid,$line,'','');
	if(!$sql)
	{return "";}
	//取得模板
	$tr=sys_ReturnBqTemp($spr['tempid']);
	if(empty($tr['tempid']))
	{return "";}
	$listtemp=str_replace('[!--news.url--]',$public_r[newsurl],$tr[temptext]);
	$subnews=$tr[subnews];
	$listvar=str_replace('[!--news.url--]',$public_r[newsurl],$tr[listvar]);
	$rownum=$tr[rownum];
	$formatdate=$tr[showdate];
	$docode=$tr[docode];
	//替換模板變量
	$listtemp=ReplaceSpClassname($listtemp,$spid,$spr);
	if(empty($rownum))
	{$rownum=1;}
	//字段
	$ret_r=ReturnReplaceListF($tr[modid]);
	//列表
	$list_exp="[!--empirenews.listtemp--]";
	$list_r=explode($list_exp,$listtemp);
	$listtext=$list_r[1];
	$no=1;
	$changerow=1;
	while($r=$empire->fetch($sql))
	{
		if(empty($class_r[$r[classid]][tbname]))
		{
			continue;
		}
		$infor=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$r[classid]][tbname]." where id='$r[id]' limit 1");
		if(empty($infor['id']))
		{
			continue;
		}
		$infor[oldtitle]=$infor[title];
		//替換列表變量
		$repvar=ReplaceListVars($no,$listvar,$subnews,$strlen,$formatdate,$url,$have_class,$infor,$ret_r,$docode);
		$listtext=str_replace("<!--list.var".$changerow."-->",$repvar,$listtext);
		$changerow+=1;
		//超過行數
		if($changerow>$rownum)
		{
			$changerow=1;
			$string.=$listtext;
			$listtext=$list_r[1];
		}
		$no++;
    }
	//多餘數據
    if($changerow<=$rownum&&$listtext<>$list_r[1])
	{
		$string.=$listtext;
    }
    $string=$list_r[0].$string.$list_r[2];
	echo $string;
}

//代碼碎片
function sys_eShowSp3($spid){
	global $empire,$dbtbpre;
	$r=$empire->fetch1("select sptext from {$dbtbpre}enewssp_3 where spid='$spid' limit 1");
	echo $r['sptext'];
}

//調用生成縮圖
function sys_ResizeImg($file,$width,$height,$docut=0,$target_filename='',$target_path='e/data/tmp/titlepic/'){
	global $public_r,$ecms_config;
	if(!$file||!$width||!$height)
	{
		return $file;
	}
	//擴展名
	$filetype=GetFiletype($file);
	if(!strstr($ecms_config['sets']['tranpicturetype'],','.$filetype.','))
	{
		return $file;
	}
	$efileurl=eReturnFileUrl();
	if(strstr($file,$efileurl))
	{
		$file=str_replace($efileurl,'/d/file/',$file);
	}
	if(strstr($file,'://'))
	{
		return $file;
	}
	$filename=eReturnEcmsMainPortPath().substr($file,1);//moreport
	if(!file_exists($filename))
	{
		return $file;
	}
	if($target_filename)
	{
		$newfilename=$target_filename;
	}
	else
	{
		$newfilename=md5($file.'-'.$width.'-'.$height.'-'.$docut);
	}
	$newpath=ECMS_PATH.$target_path;
	$newurl=$public_r['newsurl'].$target_path;
	$newname=$newpath.$newfilename;
	if(empty($target_filename)&&file_exists($newname.$filetype))
	{
		return $newurl.$newfilename.$filetype;
	}
	if(!defined('InEmpireCMSGd'))
	{
		include_once ECMS_PATH.'e/class/gd.php';
	}
	$filer=ResizeImage($filename,$newname,$width,$height,$docut);
	$fileurl=$newurl.$newfilename.$filer['filetype'];
	return $fileurl;
}

//顯示圖集函數
function sys_ModShowMorepic($epicswidth=120,$epicsheight=80,$temptext=''){
	global $navinfor,$public_r;
	$morepic=$navinfor['morepic'];
	if(empty($morepic))
	{
		return "";
	}
	//模板
	if(empty($temptext))
	{
		$temptext='<table><tr>[!--empirenews.listtemp--]<td bgcolor="#cccccc" align="center" id="espicid\'+i+\'"\'+cname+\'><a href="#empirecms" onclick="ecmsShowPic(\'+i+\');"><img src="\'+ecmspicr[i][0]+\'" width="\'+epicswidth+\'" height="\'+epicsheight+\'" border="0"></a><br>\'+(i+1)+\'/\'+ecmspicnum+\'</td>[!--empirenews.listtemp--]</tr></table>';
	}
	else
	{
		$temptext=str_replace("\r\n","",$temptext);
		$temptext=str_replace("'","\"",$temptext);
		$temptext=str_replace("[!--page--]","'+i+'",$temptext);
		$temptext=str_replace("[!--thiscss--]","'+cname+'",$temptext);
		$temptext=str_replace("[!--spicurl--]","'+ecmspicr[i][0]+'",$temptext);
		$temptext=str_replace("[!--spicwidth--]","'+epicswidth+'",$temptext);
		$temptext=str_replace("[!--spicheight--]","'+epicsheight+'",$temptext);
		$temptext=str_replace("[!--spicno--]","'+(i+1)+'/'+ecmspicnum+'",$temptext);
	}
	$tempr=explode('[!--empirenews.listtemp--]',$temptext);
	//圖片地址
	$rexp="\r\n";
	$fexp="::::::";
	$rr=explode($rexp,$morepic);
	$count=count($rr);
?>

<script>

var ecmspicr=new Array();

var epicswidth=<?=$epicswidth?>;	//小圖寬度
var epicsheight=<?=$epicsheight?>;	//小圖高度

var eopenlistpage=1;	//顯示列表分頁導航
var eopenselectpage=1;	//顯示下拉分頁導航
var eopensmallpics=1;	//顯示小圖導航

var ecmspicnum=0;

//圖片列表
<?php
for($i=0;$i<$count;$i++)
{
	$fr=explode($fexp,$rr[$i]);
	$smallpic=$fr[0];	//小圖
	$bigpic=$fr[1];	//大圖
	if(empty($bigpic))
	{
		$bigpic=$smallpic;
	}
	$picname=ehtmlspecialchars($fr[2]);	//名稱
?>
ecmspicr[<?=$i?>]=new Array("<?=$smallpic?>","<?=$bigpic?>","<?=$picname?>");
<?php
}
?>

ecmspicnum=ecmspicr.length;

if(document.getElementById("ecmssmallpicsid")==null)
{
	eopensmallpics=0;
}
if(document.getElementById("ecmsselectpagesid")==null)
{
	eopenselectpage=0;
}
if(document.getElementById("ecmslistpagesid")==null)
{
	eopenlistpage=0;
}


//showsmallpics
function ecmsShowSmallPics(){
	var str='';
	var selectpages='';
	var listpages='';
	var i;
	var cname='';
	var lname='';
	var sname='';
	for(i=0;i<ecmspicnum;i++)
	{
		cname='';
		lname='';
		sname='';
		if(i==0)
		{
			cname=' class="espiccss"';
			lname=' class="epiclpcss"';
			sname=' selected';
		}
		str+='<?=$tempr[1]?>';

		selectpages+='<option value="'+i+'"'+sname+'>第 '+(i+1)+' 頁</option>';

		listpages+='<a href="#empirecms" id="epiclpid'+i+'" onclick="ecmsShowPic('+i+');"'+lname+'>'+(i+1)+'</a> ';
	}
	if(eopensmallpics==1)
	{
		document.getElementById("ecmssmallpicsid").innerHTML='<?=$tempr[0]?>'+str+'<?=$tempr[2]?>';
	}
	if(eopenselectpage==1)
	{
		document.getElementById("ecmsselectpagesid").innerHTML='<select name="tothepicpage" id="tothepicpage" onchange="ecmsShowPic(this.options[this.selectedIndex].value);">'+selectpages+'</select>';
	}
	if(eopenlistpage==1)
	{
		document.getElementById("ecmslistpagesid").innerHTML=listpages;
	}
	document.getElementById("ethispage").value=0;
}

</script>

<script type="text/javascript" src="<?=$public_r['newsurl']?>e/data/modadd/morepic/empirecmsmorepic.js"></script>
<script>ecmsShowSmallPics();ecmsShowPic(0);</script>

<?php
}
?>