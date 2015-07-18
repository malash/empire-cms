<?php
define('InEmpireCMSDelPath',TRUE);

//刪除目錄
//本程序由wm_chief原創，如要轉載，請註明作者與來源(http://www.phome.net)
class del_path{
	function wm_chief_delpath($del_path)
	{
		if(!file_exists($del_path))//目標目錄不存在則建立
		{
			echo"Directory not found.";
			return false;
		}
		$hand=@opendir($del_path);
		$i=0;
		while($file=@readdir($hand))
		{
			$i++;
			if($file!="."&&$file!="..")
			{
				//目錄
				if(is_dir($del_path."/".$file))
				{
					$del_s_path=$del_path."/".$file;
					$this->wm_chief_delpath($del_s_path);
				}
				else
				{
					$del_file=$del_path."/".$file;
					$this->wm_chief_file($del_file);
				}
			}
		}
		@closedir($hand);
		$this->wm_chief_path($del_path);
		return true;
	}
	//刪除文件
	function wm_chief_file($del_file)
	{
		@unlink($del_file);
	}
	//刪除目錄
	function wm_chief_path($del_path)
	{
		@rmdir($del_path);
	}
}
//本程序由wm_chief原創，如要轉載，請註明作者與來源(http://www.phome.net)
?>