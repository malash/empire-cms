<?php
define('InEmpireCMSCopyPath',TRUE);

//���{�ǥ�wm_chief��СA�p�n����A�е����@�̻P�ӷ�(http://www.phome.net)
class copy_path{
	function wm_chief_copypath($o_path,$n_path)
	{
		$hand=@opendir($o_path);
		if(!file_exists($n_path))//�ؼХؿ����s�b�h�إ�
		{
			$this->wm_chief_createpath($n_path);
		}
		$i=0;
		while($file=@readdir($hand))
		{
			$i++;
			if($file!="."&&$file!="..")
			{
				//�ؿ�
				if(is_dir($o_path."/".$file))
				{
					$o_s_path=$o_path."/".$file;
					$n_s_path=$n_path."/".$file;
					$this->wm_chief_copypath($o_s_path,$n_s_path);
				}
				else
				{
					$o_file=$o_path."/".$file;
					$n_file=$n_path."/".$file;
					$this->wm_chief_copyfile($o_file,$n_file);
				}
			}
		}
		@closedir($hand);
		return true;
	}
	function wm_chief_copyfile($o_file,$n_file)
	{
		@copy($o_file,$n_file);
	}
	function wm_chief_createpath($n_path)
	{
		@mkdir($n_path,0777);
		@chmod($n_path,0777);
	}
}
//���{�ǥ�wm_chief��СA�p�n����A�е����@�̻P�ӷ�(http://www.phome.net)
?>