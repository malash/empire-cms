<?php
//��^sql�y�y
function espace_ReturnBqQuery($classid,$line,$enews=0,$do=0,$ewhere='',$eorder=''){
	global $empire,$dbtbpre,$public_r,$class_r,$class_zr,$fun_r,$class_tr,$emod_r,$etable_r,$userid,$eyh_r;
	$userid=(int)$userid;
	if($enews==24)//��sql�d��
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
	if($enews==0||$enews==1||$enews==2||$enews==9||$enews==12||$enews==15)//���
	{
		if(strstr($classid,','))//�h���
		{
			$son_r=sys_ReturnMoreClass($classid,1);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
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
	elseif($enews==6||$enews==7||$enews==8||$enews==11||$enews==14||$enews==17)//�M�D
	{
		echo"Error�GChange to use e:indexloop";
		return false;
	}
	elseif($enews==25||$enews==26||$enews==27||$enews==28||$enews==29||$enews==30)//���D����
	{
		if(strstr($classid,','))//�h���D����
		{
			$son_r=sys_ReturnMoreTT($classid);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
			$where="ttid='$classid'";
		}
		$mid=$class_tr[$classid][mid];
		$tbname=$emod_r[$mid][tbname];
		$yhid=$class_tr[$classid][yhid];
	}
	$query=" where userid='$userid' and ismember=1";
	if($enews==0)//��س̷s
	{
		$query.=' and ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==1)//��ؼ���
	{
		$query.=' and ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==2)//��ر���
	{
		$query.=' and ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==9)//��ص��ױƦ�
	{
		$query.=' and ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==12)//����Y��
	{
		$query.=' and ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==15)//��ؤU���Ʀ�
	{
		$query.=' and ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	elseif($enews==3)//�Ҧ��̷s
	{
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==4)//�Ҧ��I���Ʀ�
	{
		$order='onclick';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==5)//�Ҧ�����
	{
		$query.=' and isgood>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==10)//�Ҧ����ױƦ�
	{
		$order='plnum';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==13)//�Ҧ��Y��
	{
		$query.=' and firsttitle>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==16)//�Ҧ��U���Ʀ�
	{
		$order='totaldown';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==18)//�U��̷s
	{
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==19)//�U�����
	{
		$order='onclick';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==20)//�U�����
	{
		$query.=' and isgood>0';
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==21)//�U����ױƦ�
	{
		$order='plnum';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==22)//�U���Y���H��
	{
		$query.=' and firsttitle>0';
		$order="newstime";
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==23)//�U��U���Ʀ�
	{
		$order='totaldown';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==25)//���D�����̷s
	{
		$query.=' and ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==26)//���D�����I���Ʀ�
	{
		$query.=' and ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==27)//���D��������
	{
		$query.=' and ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==28)//���D�������ױƦ�
	{
		$query.=' and ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==29)//���D�����Y��
	{
		$query.=' and ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==30)//���D�����U���Ʀ�
	{
		$query.=' and ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	//�u��
	$yhadd='';
	if(!empty($eyh_r[$yhid]['dosbq']))
	{
		$yhadd=ReturnYhSql($yhid,$yhvar);
		if(!empty($yhadd))
		{
			$query.=' and '.$yhadd;
		}
	}
	//���ե�
	if(!strstr($public_r['nottobq'],','.$classid.','))
	{
		$notbqwhere=ReturnNottoBqWhere();
		if(!empty($notbqwhere))
		{
			$query.=' and '.$notbqwhere;
		}
	}
	//�Ϥ��H��
	if(!empty($do))
	{
		$query.=" and ispic=1";
    }
	//���[����
	if(!empty($ewhere))
	{
		$query.=' and ('.$ewhere.')';
	}
	//����
	if(empty($tbname))
	{
		echo "ClassID=<b>".$classid."</b> Table not exists.(DoType=".$enews.")";
		return false;
	}
	//�Ƨ�
	$addorder=empty($eorder)?$order.' desc':$eorder;
	$query='select '.ReturnSqlListF($mid).' from '.$dbtbpre.'ecms_'.$tbname.$query.' order by '.$addorder.' limit '.$line;
	$sql=$empire->query1($query);
	if(!$sql)
	{
		echo"SQL Error: ".ReRepSqlTbpre($query);
	}
	return $sql;
}

//�F�ʼ��ҡG��^SQL���e���
function espace_eloop($classid=0,$line=10,$enews=3,$doing=0,$ewhere='',$eorder=''){
	return espace_ReturnBqQuery($classid,$line,$enews,$doing,$ewhere,$eorder);
}

//�F�ʼ��ҡG��^�S���e���
function espace_eloop_sp($r){
	global $class_r;
	$sr['titleurl']=sys_ReturnBqTitleLink($r);
	$sr['classname']=$class_r[$r[classid]][bname]?$class_r[$r[classid]][bname]:$class_r[$r[classid]][classname];
	$sr['classurl']=sys_ReturnBqClassname($r,9);
	return $sr;
}
?>