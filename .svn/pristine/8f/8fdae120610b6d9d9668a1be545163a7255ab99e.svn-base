<?php
namespace Com\Mor\Util;

class ImgsynUtil {
	
	public static function synthesisImg($amount, $imgUrl) {
		header("Content-Type:text/html; charset=utf-8");
        header('Content-type: image/jpg');
		
		$image = imagecreatefromjpeg($imgUrl);// 创建图像
		// 填充颜色 - ps里的点击画布填色
		$image_cololr =  imagecolorallocate($image, 149, 188, 205);
		imagefill($image, 0, 0,$image_cololr);
		$black = imagecolorallocate($image,  0, 0, 0);//文字颜色
		$red   = imagecolorallocate($image,  255, 0, 0);//文字颜色
		$text  = "并为有需要的人群捐赠了";
		$yuan  = "元";
		
		$address = "Public/font/msyh.ttf";
		$height  = "811";
		
		imagettftext($image, 16, 0, 180, $height, $black, $address, $text);// 设置中文文字
		imagettftext($image, 16, 0, 181, $height, $black, $address, $text);// 设置中文文字
		
		imagettftext($image, 20, 0, 419, $height, $red, $address, $amount);// 设置中文文字
		imagettftext($image, 20, 0, 420, $height, $red, $address, $amount);// 设置中文文字
		imagettftext($image, 20, 0, 421, $height, $red, $address, $amount);// 设置中文文字
		
		$len = strlen($amount);
		$strx = (421+10)+14*$len;
		
		imagettftext($image, 16, 0, $strx, $height, $black, $address, $yuan);// 设置中文文字
		imagettftext($image, 16, 0, $strx+1, $height, $black, $address, $yuan);// 设置中文文字
	    imagejpeg($image);// 生成图片
		imagedestroy($image);
		
	}
	
}
?>