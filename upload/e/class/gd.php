<?php
define('InEmpireCMSGd',TRUE);

//原文件,新文件,寬度,高度,維持比例
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
	//輸出
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
* 功能：圖片加水印 (水印支持圖片或文字) 
* 參數： 
*      $groundImage    背景圖片，即需要加水印的圖片，暫只支持GIF,JPG,PNG格式； 
*      $waterPos        水印位置，有10種狀態，0為隨機位置； 
*                        1為頂端居左，2為頂端居中，3為頂端居右； 
*                        4為中部居左，5為中部居中，6為中部居右； 
*                        7為底端居左，8為底端居中，9為底端居右； 
*      $waterImage        圖片水印，即作為水印的圖片，暫只支持GIF,JPG,PNG格式； 
*      $waterText        文字水印，即把文字作為為水印，支持ASCII碼，不支持中文； 
*      $textFont        文字大小，值為1、2、3、4或5，默認為5； 
*      $textColor        文字顏色，值為十六進制顏色值，默認為#FF0000(紅色)； 
* 
* 注意：Support GD 2.0，Support FreeType、GIF Read、GIF Create、JPG 、PNG 
*      $waterImage 和 $waterText 最好不要同時使用，選其中之一即可，優先使用 $waterImage。 
*      當$waterImage有效時，參數$waterString、$stringFont、$stringColor均不生效。 
*      加水印後的圖片的文件名和 $groundImage 一樣。 
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

    //讀取水印文件 
    if(!empty($waterImage) && file_exists($waterImage)) 
    { 
        $isWaterImage = TRUE; 
        $water_info = getimagesize($waterImage); 
        $water_w    = $water_info[0];//取得水印圖片的寬 
        $water_h    = $water_info[1];//取得水印圖片的高 

        switch($water_info[2])//取得水印圖片的格式 
        { 
            case 1:$water_im = imagecreatefromgif($waterImage);break; 
            case 2:$water_im = imagecreatefromjpeg($waterImage);break; 
            case 3:$water_im = imagecreatefrompng($waterImage);break; 
            default:echo $formatMsg;return ""; 
        } 
    } 

    //讀取背景圖片 
    if(!empty($groundImage) && file_exists($groundImage)) 
    { 
        $ground_info = getimagesize($groundImage); 
        $ground_w    = $ground_info[0];//取得背景圖片的寬 
        $ground_h    = $ground_info[1];//取得背景圖片的高 

        switch($ground_info[2])//取得背景圖片的格式 
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

    //水印位置 
    if($isWaterImage)//圖片水印 
    { 
        $w = $water_w; 
        $h = $water_h; 
        $label = "圖片的"; 
    } 
    else//文字水印 
    { 
        $temp = imagettfbbox(ceil($textFont*2.5),0,$myfontpath,$waterText);//取得使用 TrueType 字體的文本的範圍 
        $w = $temp[2] - $temp[6]; 
        $h = $temp[3] - $temp[7]; 
        unset($temp); 
        $label = "文字區域"; 
    } 
    if( ($ground_w<$w) || ($ground_h<$h) ) 
    { 
        echo $fun_r['sytoosmall']; 
        return ''; 
    } 
    switch($waterPos) 
    { 
        case 0://隨機 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break; 
        case 1://1為頂端居左 
            $posX = 0; 
            $posY = 0; 
            break; 
        case 2://2為頂端居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = 0; 
            break; 
        case 3://3為頂端居右 
            $posX = $ground_w - $w; 
            $posY = 0; 
            break; 
        case 4://4為中部居左 
            $posX = 0; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 5://5為中部居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 6://6為中部居右 
            $posX = $ground_w - $w; 
            $posY = ($ground_h - $h) / 2; 
            break; 
        case 7://7為底端居左 
            $posX = 0; 
            $posY = $ground_h - $h; 
            break; 
        case 8://8為底端居中 
            $posX = ($ground_w - $w) / 2; 
            $posY = $ground_h - $h; 
            break; 
        case 9://9為底端居右 
            $posX = $ground_w - $w; 
            $posY = $ground_h - $h; 
            break; 
        default://隨機 
            $posX = rand(0,($ground_w - $w)); 
            $posY = rand(0,($ground_h - $h)); 
            break;     
    } 

    //設定圖像的混色模式 
    imagealphablending($ground_im, true); 

    if($isWaterImage)//圖片水印 
    {
		if($water_info[2]==3)
		{
			imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//拷貝水印到目標文件
		}
		else
		{
			imagecopymerge($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h,$w_pct);//拷貝水印到目標文件
		}
    } 
    else//文字水印 
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

    //生成水印後的圖片 
    @unlink($groundImage); 
    switch($ground_info[2])//取得背景圖片的格式 
    { 
        case 1:imagegif($ground_im,$groundImage);break; 
        case 2:imagejpeg($ground_im,$groundImage,$w_quality);break; 
        case 3:imagepng($ground_im,$groundImage);break; 
        default:echo $formatMsg;return ""; 
    } 

    //釋放內存 
    if(isset($water_info)) unset($water_info); 
    if(isset($water_im)) imagedestroy($water_im); 
    unset($ground_info); 
    imagedestroy($ground_im); 
}
?>