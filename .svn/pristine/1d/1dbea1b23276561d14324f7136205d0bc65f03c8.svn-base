<?php
namespace Com\Mor\Util;

class CalculateUtil {
	
	public static function moneyToWeb($money) {
		$webMoney = "";
		
		if (!empty($money) && is_numeric($money)) {
			if ($money > 10000) {
				$webMoney = sprintf("%.2f", $money / 10000)." 万元";
			} else {
				$webMoney = sprintf("%.2f", $money)." 元";
			}
		}
		
		return $webMoney;
	}
	
	public static function carYear($goundTime) {
		$carYear = "";
		
		if (!empty($goundTime) && is_numeric($goundTime)) {
			$carYear = floor((time() - $goundTime) / (3600 * 24 * 365));
		}
		
		return $carYear;
	}
	
}
?>