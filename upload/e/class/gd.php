<?php
define('InEmpireCMSGd',TRUE);

//����,�s���,�e��,����,�������
function ResizeImage($big_image_name, $new_name, $max_width = 400, $max_height = 400, $resize = 1){
	$returnr['file']='';
	$returnr['filetype']='';
    if($temp_img_type = @getimagesize($big_image_name)) {preg_match('/\/([a-z]+)$/i', $temp_img_type[mime], $tpn); $img_type = $tpn[1];}
    else {preg_match('/\.([a-z]+)$/i', $big_image_name, $tpn); $img_type = $tpn[1];}
    $all_type = array(
        "jpg"   => array("create"=>"ImageCreateFromjpeg", "output"=>"imagejpeg"  , "exn"=>".jpg"),
        "gif"   => array("create"=>"ImageCreateFromGIF" , "output"=>"imagegif"   , "exn"=>".gif"),
        "jpeg"  => array("create"=>"ImageCreateFromjpeg", "output"=>"imagejpeg"  , "exn"=>".jpg"),
        "png"   => array("create"=>"imagecreatefrompng" , "output"=>"imagepng"   , "exn"=>".png"),
        "wbmp"  => array("create"=>"imagecreatefromwbmp", "output"=>"image2wbmp" , "exn"=>".wbmp")
    );

    $func_create = $all_type[$img_type]['create'];
    if(empty($func_create) or !function_exists($func_create)) 
	{
		return $returnr;
	}
	//��X
    $func_output = $all_type[$img_type]['output'];
    $func_exname = $all_type[$img_type]['exn'];
	if(($func_exname=='.gif'||$func_exname=='.png'||$func_exname=='.wbmp')&&!function_exists($func_output))
	{
		$func_output='imagejpeg';
		$func_exname='.jpg';
	}
    $big_image   = $func_create($big_image_name);
    $big_width   = imagesx($big_image);
    $big_height  = imagesy($big_image);
    if($big_width <= $max_width and $big_height <= $max_height) 
	{ 
		$func_output($big_image, $new_name.$func_exname);
		$returnr['file']=$new_name.$func_exname;
		$returnr['filetype']=$func_exname;
		return $returnr; 
	}
    $ratiow      = $max_width  / $big_width;
    $ratioh      = $max_height / $big_height;
    if($resize == 1) {
        if($big_width >= $max_width and $big_height >= $max_height)
        {
            if($big_width > $big_height)
            {
            $tempx  = $max_width / $ratioh;
            $tempy  = $big_height;
            $srcX   = ($big_width - $tempx) / 2;
            $srcY   = 0;
            } else {
            $tempy  = $max_height / $ratiow;
            $tempx  = $big_width;
            $srcY   = ($big_height - $tempy) / 2;
            $srcX   = 0;
            }
        } else {
            if($big_width > $big_height)
            {
            $tempx  = $max_width;
            $tempy  = $big_height;
            $srcX   = ($big_width - $tempx) / 2;
            $srcY   = 0;
            } else {
            $tempy  = $max_height;
            $tempx  = $big_width;
            $srcY   = ($big_height - $tempy) / 2;
            $srcX   = 0;
            }
        }
    } else {
        $srcX      = 0;
        $srcY      = 0;
        $tempx     = $big_width;
        $tempy     = $big_height;
    }

    $new_width  = ($ratiow  > 1) ? $big_width  : $max_width;
    $new_height = ($ratioh  > 1) ? $big_height : $max_height;
    if(function_exists("imagecopyresampled"))
    {
        $temp_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($temp_image, $big_image, 0, 0, $srcX, $srcY, $new_width, $new_height, $tempx, $tempy);
    } else {
        $temp_image = imagecreate($new_width, $new_height);
        imagecopyresized($temp_image, $big_image, 0, 0, $srcX, $srcY, $new_width, $new_height, $tempx, $tempy);
    }
        $func_output($temp_image, $new_name.$func_exname);
        ImageDestroy($big_image);
        ImageDestroy($temp_image);
		$returnr['file']=$new_name.$func_exname;
		$returnr['filetype']=$func_exname;
    return $returnr;
}

/* 
* �\��G�Ϥ��[���L (���L����Ϥ��Τ�r) 
* �ѼơG 
*      $groundImage    �I���Ϥ��A�Y�ݭn�[���L���Ϥ��A�ȥu���GIF,JPG,PNG�榡�F 
*      $waterPos        ���L��m�A��10�ت��A�A0���H����m�F 
*                        1�����ݩ~���A2�����ݩ~���A3�����ݩ~�k�F 
*                        4�������~���A5�������~���A6�������~�k�F 
*                        7�����ݩ~���A8�����ݩ~���A9�����ݩ~�k�F 
*      $waterImage        �Ϥ����L�A�Y�@�����L���Ϥ��A�ȥu���GIF,JPG,PNG�榡�F 
*      $waterText        ��r���L�A�Y���r�@�������L�A���ASCII�X�A���������F 
*      $textFont        ��r�j�p�A�Ȭ�1�B2�B3�B4��5�A�q�{��5�F 
*      $textColor        ��r�C��A�Ȭ��Q���i���C��ȡA�q�{��#FF0000(����)�F 
* 
* �`�N�GSupport GD 2.0�ASupport FreeType�BGIF Read�BGIF Create�BJPG �BPNG 
*      $waterImage �M $waterText �̦n���n�P�ɨϥΡA��䤤���@�Y�i�A�u���ϥ� $waterImage�C 
*      ��$waterImage���ĮɡA�Ѽ�$waterString�B$stringFont�B$stringColor�����ͮġC 
*      �[���L�᪺�Ϥ������W�M $groundImage �@�ˡC 
*/ 
function imageWaterMark($groundImage,$waterPos=0,$waterImage="",$waterText="",$textFont=5,$textColor="#FF0000",$myfontpath="../data/mask/cour.ttf",$w_pct,$w_quality){
	global $fun_r,$editor;
	if($editor==1){$a='../';}
	elseif($editor==2){$a='../../';}
	elseif($editor==3){$a='../../../';}
	else{$a='';}
	$waterImage=$waterImage?$a.$waterImage:'';
	$myfontpath=$myfontpath?$a.$myfontpath:'';
    $isWaterImage = FALSE; 
    $formatMsg = $fun_r['synotdotype']; 

    //Ū�����L��� 
    if(!empty($waterImage) && file_exists($waterImage)) 
    { 
        $isWaterImage = TRUE; 
        $water_info = getimagesize($waterImage); 
        $water_w    = $water_info[0];//���o���L�Ϥ����e 
        $water_h    = $water_info[1];//���o���L�Ϥ����� 

        switch($water_info[2])//���o���L�Ϥ����榡 
        { 
            case 1:$water_im = imagecreatefromgif($waterImage);break; 
            case 2:$water_im = imagecreatefromjpeg($waterImage);break; 
            case 3:$water_im = imagecreatefrompng($waterImage);break; 
            default:echo $formatMsg;return ""; 
        } 
    } 

    //Ū���I���Ϥ� 
    if(!empty($groundImage) && file_exists($groundImage)) 
    { 
        $ground_info = getimagesize($groundImage); 
        $ground_w    = $ground_info[0];//���o�I���Ϥ����e 
        $ground_h    = $ground_info[1];//���o�I���Ϥ����� 

        switch($ground_info[2])//���o�I���Ϥ����榡 
        { 
            case 1:$ground_im = imagecreatefromgif($groundImage);break; 
            case 2:$ground_im = imagecreatefromjpeg($groundImage);break; 
            case 3:$ground_im = imagecreatefrompng($groundImage);break; 
            default:echo $formatMsg;return ""; 
        } 
    } 
    else 
    { 
        echo $fun_r['synotdoimg'];
		return "";
    } 

    //���L��m 
    if($isWaterImage)//�Ϥ����L 
    { 
        $w = $water_w; 
        $h = $water_h; 
        $label = "�Ϥ���"; 
    } 
    else//��r���L 
    { 
        $temp = imagettfbbox(ceil($textFont*2.5),0,$myfontpath,$waterText);//���o�ϥ� TrueType �r�骺�奻���d�� 
        $w = $temp[2] - $temp[6]; 
        $h = $temp[3] - $temp[7]; 
        unset($temp); 
        $label = "��r�ϰ�"; 
    } 
    if( ($ground_w<$w) || ($ground_h<$h) ) 
    { 
        echo $fun_r['sytoosmall']; 
        return ''; 
    } 
    switch($waterPos) 
    { 
        case 0://�H�� 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break; 
        case 1://1�����ݩ~�� 
            $posX = 0; 
            $posY = 0; 
            break; 
        case 2://2�����ݩ~�� 
            $posX = ($ground_w - $w) / 2; 
            $posY = 0; 
            break; 
        case 3://3�����ݩ~�k 
            $posX = $ground_w - $w; 
            $posY = 0; 
            break; 
        case 4://4�������~�� 
            $posX = 0; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 5://5�������~�� 
            $posX = ($ground_w - $w) / 2; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 6://6�������~�k 
            $posX = $ground_w - $w; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 7://7�����ݩ~�� 
            $posX = 0; 
            $posY = $ground_h - $h; 
            break; 
        case 8://8�����ݩ~�� 
            $posX = ($ground_w - $w) / 2; 
            $posY = $ground_h - $h; 
            break; 
        case 9://9�����ݩ~�k 
            $posX = $ground_w - $w; 
            $posY = $ground_h - $h; 
            break; 
        default://�H�� 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break;     
    } 

    //�]�w�Ϲ����V��Ҧ� 
    imagealphablending($ground_im, true); 

    if($isWaterImage)//�Ϥ����L 
    {
		if($water_info[2]==3)
		{
			imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//�������L��ؼФ��
		}
		else
		{
			imagecopymerge($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h,$w_pct);//�������L��ؼФ��
		}
    } 
    else//��r���L 
    { 
        if( !empty($textColor) && (strlen($textColor)==7) ) 
        { 
            $R = hexdec(substr($textColor,1,2)); 
            $G = hexdec(substr($textColor,3,2)); 
            $B = hexdec(substr($textColor,5)); 
        } 
        else 
        { 
            echo $fun_r['synotfontcolor'];
			return "";
        } 
        imagestring ( $ground_im, $textFont, $posX, $posY, $waterText, imagecolorallocate($ground_im, $R, $G, $B));         
    } 

    //�ͦ����L�᪺�Ϥ� 
    @unlink($groundImage); 
    switch($ground_info[2])//���o�I���Ϥ����榡 
    { 
        case 1:imagegif($ground_im,$groundImage);break; 
        case 2:imagejpeg($ground_im,$groundImage,$w_quality);break; 
        case 3:imagepng($ground_im,$groundImage);break; 
        default:echo $formatMsg;return ""; 
    } 

    //���񤺦s 
    if(isset($water_info)) unset($water_info); 
    if(isset($water_im)) imagedestroy($water_im); 
    unset($ground_info); 
    imagedestroy($ground_im); 
}
?>