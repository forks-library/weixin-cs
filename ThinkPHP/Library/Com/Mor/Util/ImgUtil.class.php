<?php
namespace Com\Mor\Util;

class ImgUtil {
	
	public static function imgHandy($img, $width = "650") {
		$handyImg = "";
		
		if (!empty($img) && (strrpos(strtolower($img), ".jpg") !== false
			|| strrpos(strtolower($img), ".jpeg") !== false
			)) {
			$basePath = "";
			
			if (strpos($img, "?") !== false) {
				$basePath = substr($img, 0, strpos($img, "?"));
			} else if (strpos($img, "@") !== false) {
				$basePath = substr($img, 0, strpos($img, "@"));
			} else {
				$basePath = $img;
			}
			
			if (!empty($basePath)) {
				$propLink = "?x-oss-process=image/resize,w_";
				
				if (!empty($width)) {
					$propLink .= $width;
				} else {
					$propLink .= "650";
				}
				
				$propLink .= "/auto-orient,1";
				
				$handyImg = $basePath.$propLink;
			}
		} else {
			$handyImg = $img;
		}
		
		return $handyImg;
	}
	
}
?>