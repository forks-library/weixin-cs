<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;

class Fronter extends TagLib {
	
	protected $tags = array(
        'search'  => array('attr'=>'textname,placeholder,extend', 'level'=>3)
        ,'shell'  => array('attr'=>'extend', 'level'=>3) 
	);
	
	public function _search($tag, $content) {
		$parseStr = "";
		$html = new Html();
		
		$textname = isset($tag['textname']) && !empty($tag['textname']) ? $tag['textname'] : '';
		$placeholder = isset($tag["placeholder"]) && !empty($tag["placeholder"]) ? $tag["placeholder"] : '';
		$extend = isset($tag['extend']) && !empty($tag['extend']) ? $tag['extend'] : '';
		
		$parseStr .= '<div class="w-filterSearch">';
		$parseStr .= '<div class="search-input-group">';
		
		/**
		 * 搜索文本条
		 */
		$inputTag = array("name" => $textname, "extend" => "placeholder='".$placeholder."'");
		$parseStr .= $html->_input($inputTag, '');
		
		$parseStr .= '<span class="input-group-btn">';
		/**
		 * 搜索按钮
		 */
		$imageBtn = array("id" => "btn_search");
		$parseStr .= $html->_imageBtn($imageBtn);
		$parseStr .= '</span>';
		
		$parseStr .= '</div>';
		$parseStr .= '</div>';
		
		if (!empty($content)) {
			$parseStr .= $this->tpl->parse($content);
		}
		
		return $parseStr;
	}
	
	public function _shell($tag, $content) {
		$parseStr = "";
		$parseStr .= '<div class="w-contentbox">';
		$parseStr .= '<div class="w-content-mainbox">';
		$parseStr .= '<div class="w-content-main">';
		
		if (!empty($content)) {
			$parseStr .= $this->tpl->parse($content);
		}
		
		$parseStr .= '</div>';
		$parseStr .= '</div>';
		$parseStr .= '</div>';
		return $parseStr;
	}
	
}
?>