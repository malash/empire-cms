<?php
define('InEmpireCMSDbSql',TRUE);

class mysqlquery
{
	var $dblink;
	var $sql;//sql語句執行結果
	var $query;//sql語句
	var $num;//返回記錄數
	var $r;//返回數組
	var $id;//返回數據庫id號
	//執行mysql_query()語句
	function query($query){
		global $ecms_config;
		$this->sql=mysql_query($query,return_dblink($query)) or die($ecms_config['db']['showerror']==1?mysql_error().'<br>'.str_replace($GLOBALS['dbtbpre'],'***_',$query):'DbError');
		return $this->sql;
	}
	//執行mysql_query()語句2
	function query1($query){
		$this->sql=mysql_query($query,return_dblink($query));
		return $this->sql;
	}
	//執行mysql_query()語句(選擇數據庫USE)
	function usequery($query){
		global $ecms_config;
		$this->sql=mysql_query($query,$GLOBALS['link']) or die($ecms_config['db']['showerror']==1?mysql_error().'<br>'.str_replace($GLOBALS['dbtbpre'],'***_',$query):'DbError');
		if($GLOBALS['linkrd'])
		{
			mysql_query($query,$GLOBALS['linkrd']);
		}
		return $this->sql;
	}
	//執行mysql_query()語句(操作數據庫)
	function updatesql($query){
		global $ecms_config;
		$this->sql=mysql_query($query,return_dblink($query)) or die($ecms_config['db']['showerror']==1?mysql_error().'<br>'.str_replace($GLOBALS['dbtbpre'],'***_',$query):'DbError');
		return $this->sql;
	}
	//執行mysql_fetch_array()
	function fetch($sql)//此方法的參數是$sql就是sql語句執行結果
	{
		$this->r=mysql_fetch_array($sql);
		return $this->r;
	}
	//執行fetchone(mysql_fetch_array())
	//此方法與fetch()的區別是:1、此方法的參數是$query就是sql語句 
	//2、此方法用於while(),for()數據庫指針不會自動下移，而fetch()可以自動下移。
	function fetch1($query)
	{
		$this->sql=$this->query($query);
		$this->r=mysql_fetch_array($this->sql);
		return $this->r;
	}
	//執行mysql_num_rows()
	function num($query)//此類的參數是$query就是sql語句
	{
		$this->sql=$this->query($query);
		$this->num=mysql_num_rows($this->sql);
		return $this->num;
	}
	//執行numone(mysql_num_rows())
	//此方法與num()的區別是：1、此方法的參數是$sql就是sql語句的執行結果。
	function num1($sql)
	{
		$this->num=mysql_num_rows($sql);
		return $this->num;
	}
	//執行numone(mysql_num_rows())
	//統計記錄數
	function gettotal($query)
	{
		$this->r=$this->fetch1($query);
		return $this->r['total'];
	}
	//執行free(mysql_result_free())
	//此方法的參數是$sql就是sql語句的執行結果。只有在用到mysql_fetch_array的情況下用
	function free($sql)
	{
		mysql_free_result($sql);
	}
	//執行seek(mysql_data_seek())
	//此方法的參數是$sql就是sql語句的執行結果,$pit為執行指針的偏移數
	function seek($sql,$pit)
	{
		mysql_data_seek($sql,$pit);
	}
	//執行id(mysql_insert_id())
	function lastid()//取得最後一次執行mysql數據庫id號
	{
		$this->id=mysql_insert_id($GLOBALS['link']);
		if($this->id<0)
		{
			$this->id=$this->gettotal('SELECT last_insert_id() as total');
		}
		return $this->id;
	}
	//返回影響數量(mysql_affected_rows())
	function affectnum()//取得操作數據表後受影響的記錄數
	{
		return mysql_affected_rows($GLOBALS['link']);
	}
}
?>