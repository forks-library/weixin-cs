<?php
namespace Com\Mor\Util;

/**
 * Copyright (C), 2015-2016, eyoo tech. Co., Ltd.
 * FileName: SystemCoderUtil.class.php
 * Summary:  系统各类编码生成器工具类
 * @author   Chen Mao
 * @Date     2016/9/21
 * @version  1.0.0
 */
class SystemCoderUtil {
	
	/**
	 * 生成商品唯一编号
	 * 编码组成规则说明：
	 * 第1、2、3位：   公司/企业代号
	 * 第4、5位：     品牌代号
	 * 第6、7位：     年份代号(如2016年，则代号为 16)
	 * 第8位：       年份的季度代号(如2016年春季，则代号为 1)
	 * 第9位：       商品品类代号(如：男装、女装、中性、童装等，商品为男装，代为 1)
	 * 第10、11位：    商品部类代号(如：外套类、裙子类、内衣类等，商品为内衣类，代号 12)
	 * 
	 * 第12、13、14、15位：商品编号随机码
	 * --第12、13、14位：商品颜色代号(参照色值对照)
	 * --第15、16、17位：商品尺码/号型(参照尺码号型对照)
	 * 
	 * 编码示例：
	 * 262 11 16 1 1 10 4255
	 * 
	 * @param string $compCode        公司/企业编码
	 * @param string $goodMark        商品品牌
	 * @param string $year            商品年份
	 * @param string $quarterStr      商品季度
	 * @param string $goodCategory    商品品类
	 * @param string $categoryDetail  商品部类
	 * @param string $color           颜色
	 * @param string $size            尺码
	 * @return string $goodNo 商品编号
	 */
	public static function generateGoodNo($compCode, $goodMark, $year, $quarterStr, $goodCategory, $categoryDetail) {
		$goodNo = "";
		
		// 示例: 262 11 16 1 1 10 4255
		
		if (!empty($compCode) && !empty($goodMark) && !empty($year) && !empty($quarterStr) && !empty($goodCategory) && !empty($categoryDetail)) {
			$goodNo = $compCode.$goodMark.$year.$quarterStr.$goodCategory.$categoryDetail.rand(1000, 9999);
		}
		
		return $goodNo;
	}
	
	/**
	 * 生成订单号
	 * @param  string $compCode    公司/企业编码
	 * @param  string $typeCode    订单类型编码
	 * @return string $orderNo     订单号
	 */
	public static function generateOrderNo($compCode, $typeCode = "") {
		$orderNo = "";
		
		// 示例: 333 00 20160928121234 565656
		
		if (!empty($compCode) && is_numeric($compCode)) {
			if (!empty($typeCode) && is_numeric($typeCode)) {
				$orderNo = $compCode.$typeCode.self::baseOrderNo();
			} else {
				$orderNo = $compCode."00".self::baseOrderNo();
			}
		}
		
		return $orderNo;
	}
	
	/**
	 * 编码的基本规则
	 */
	public static function baseOrderNo() {
		return date("YmdHis", time()).rand(100000, 999999);
	}
	
	/**
	 * 生成商品活动编号
	 * @param  string $compCode      公司/企业编码
	 * @param  string $startDate     活动开始日期
	 * @return string $activityNo    活动编号
	 */
	public static function generateActivityNo($compCode, $startDate) {
		$activityNo = "";
		
		// 示例: 333 20160929 9999 6868
		
		if (!empty($compCode) && is_numeric($compCode) && !empty($startDate) && is_numeric($startDate)) {
			$activityNo = $compCode.date("Ymd", $startDate).rand(1000, 9999)."6868";
		}
		
		return $activityNo;
	}
	
	/**
	 * 生成商品卡券编号
	 * @param  string $compCode      公司/企业编码
	 * @return string $goodCardNo    卡券编号
	 */
	public static function generateGoodCardNo($compCode) {
		$goodCardNo = "";
		
		// 示例: 333 20160929121256 99999 1212
		
		if (!empty($compCode) && is_numeric($compCode)) {
			$goodCardNo = $compCode.self::baseOrderNo()."1212";
		}
		
		return $goodCardNo;
	}
	
	/**
	 * 生成用户商品卡券编号
	 * @param  string $compCode      公司/企业编码
	 * @return string $goodCardNo    卡券编号
	 */
	public static function generateUserGoodCardNo($compCode) {
		$goodCardNo = "";
		
		// 示例: 333 20160929 99999 1111
		
		if (!empty($compCode) && is_numeric($compCode)) {
			$goodCardNo = $compCode.self::baseOrderNo()."1111";
		}
		
		return $goodCardNo;
	}
	
	/**
	 * 生成用户地址编号
	 * @param  string $cityCode      城市编码
	 * @return string $addressNo     地址编码
	 */
	public static function generateBuyerAddressNo($cityCode) {
		$addressNo = "";
		
		// 示例: 100002 20160929123456 9999
		
		if (!empty($cityCode) && is_numeric($cityCode)) {
			$addressNo = $cityCode.date("YmdHis", time()).rand(1000, 9999);
		}
		
		return $addressNo;
	}
	
	/**
	 * 生成公司预付款单据编号
	 * @param  string $compCode     公司编码
	 * @return string $prepayNo     预支付编码
	 */
	public static function generateCompPrepayNo($compCode) {
		$prepayNo = "";
		
		// 示例: 333 20161117204244 5110 1515
		
		if (!empty($compCode)) {
			$prepayNo = $compCode.date("YmdHis", time()).rand(1000, 9999)."1515";
		}
		
		return $prepayNo;
	}
	
	/**
	 * 生成公司结算单据编号
	 * @param  string $compCode     公司编码
	 * @return string $settleNo     地址编码
	 */
	public static function generateCompSettlementNo($compCode) {
		$settleNo = "";
		
		// 示例: 333 20161117204244 5110 3030
		
		if (!empty($compCode)) {
			$settleNo = $compCode.date("YmdHis", time()).rand(1000, 9999)."3030";
		}
		
		return $settleNo;
	}
	
	/**
	 * 生成用户购物车商品信息唯一记录编号
	 * @return string $shopCartNo   商品信息唯一记录编码
	 */
	public static function generateBuyerGoodIdentifyNo() {
		
		// 示例: 20161117204244 51101234
		
		return date("YmdHis", time()).rand(10000000, 99999999);
	}
}
?>