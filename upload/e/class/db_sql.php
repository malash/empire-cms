<?php
define('InEmpireCMSDbSql',TRUE);

class mysqlquery
{
	var $dblink;
	var $sql;//sql�y�y���浲�G
	var $query;//sql�y�y
	var $num;//��^�O����
	var $r;//��^�Ʋ�
	var $id;//��^�ƾڮwid��
	//����mysql_query()�y�y
	function query($query){
		global $ecms_config;
		$this->sql=mysql_query($query,return_dblink($query)) or die($ecms_config['db']['showerror']==1?mysql_error().'<br>'.str_replace($GLOBALS['dbtbpre'],'***_',$query):'DbError');
		return $this->sql;
	}
	//����mysql_query()�y�y2
	function query1($query){
		$this->sql=mysql_query($query,return_dblink($query));
		return $this->sql;
	}
	//����mysql_query()�y�y(��ܼƾڮwUSE)
	function usequery($query){
		global $ecms_config;
		$this->sql=mysql_query($query,$GLOBALS['link']) or die($ecms_config['db']['showerror']==1?mysql_error().'<br>'.str_replace($GLOBALS['dbtbpre'],'***_',$query):'DbError');
		if($GLOBALS['linkrd'])
		{
			mysql_query($query,$GLOBALS['linkrd']);
		}
		return $this->sql;
	}
	//����mysql_query()�y�y(�ާ@�ƾڮw)
	function updatesql($query){
		global $ecms_config;
		$this->sql=mysql_query($query,return_dblink($query)) or die($ecms_config['db']['showerror']==1?mysql_error().'<br>'.str_replace($GLOBALS['dbtbpre'],'***_',$query):'DbError');
		return $this->sql;
	}
	//����mysql_fetch_array()
	function fetch($sql)//����k���ѼƬO$sql�N�Osql�y�y���浲�G
	{
		$this->r=mysql_fetch_array($sql);
		return $this->r;
	}
	//����fetchone(mysql_fetch_array())
	//����k�Pfetch()���ϧO�O:1�B����k���ѼƬO$query�N�Osql�y�y 
	//2�B����k�Ω�while(),for()�ƾڮw���w���|�۰ʤU���A��fetch()�i�H�۰ʤU���C
	function fetch1($query)
	{
		$this->sql=$this->query($query);
		$this->r=mysql_fetch_array($this->sql);
		return $this->r;
	}
	//����mysql_num_rows()
	function num($query)//�������ѼƬO$query�N�Osql�y�y
	{
		$this->sql=$this->query($query);
		$this->num=mysql_num_rows($this->sql);
		return $this->num;
	}
	//����numone(mysql_num_rows())
	//����k�Pnum()���ϧO�O�G1�B����k���ѼƬO$sql�N�Osql�y�y�����浲�G�C
	function num1($sql)
	{
		$this->num=mysql_num_rows($sql);
		return $this->num;
	}
	//����numone(mysql_num_rows())
	//�έp�O����
	function gettotal($query)
	{
		$this->r=$this->fetch1($query);
		return $this->r['total'];
	}
	//����free(mysql_result_free())
	//����k���ѼƬO$sql�N�Osql�y�y�����浲�G�C�u���b�Ψ�mysql_fetch_array�����p�U��
	function free($sql)
	{
		mysql_free_result($sql);
	}
	//����seek(mysql_data_seek())
	//����k���ѼƬO$sql�N�Osql�y�y�����浲�G,$pit��������w��������
	function seek($sql,$pit)
	{
		mysql_data_seek($sql,$pit);
	}
	//����id(mysql_insert_id())
	function lastid()//���o�̫�@������mysql�ƾڮwid��
	{
		$this->id=mysql_insert_id($GLOBALS['link']);
		if($this->id<0)
		{
			$this->id=$this->gettotal('SELECT last_insert_id() as total');
		}
		return $this->id;
	}
	//��^�v�T�ƶq(mysql_affected_rows())
	function affectnum()//���o�ާ@�ƾڪ����v�T���O����
	{
		return mysql_affected_rows($GLOBALS['link']);
	}
}
?>