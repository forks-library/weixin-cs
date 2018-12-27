<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;
use Com\Leskymob\Manage\RedisManage;

class Search extends TagLib {
	
	protected $tags = array(
        'row' =>  array('attr'=>'extend', 'level'=>3),
        'input'=> array('attr'=>'label,id,name,value,class,disabled,extend','close'=>0),
        'select'    => array('attr'=>'name,options,multiple,id,size,first,selected,class,disabled,extend','close'=>0)
	);
	
	public function _input($tag, $content) {
		$parseStr = "";
		$html = new Html();
		
		$label = isset($tag['label']) && !empty($tag['label']) ? $tag['label'] : '';
		$type = isset($tag['type']) && !empty($tag['type']) ? $tag['type'] : '';
		$name = isset($tag['name']) && !empty($tag['name']) ? $tag['name'] : '';
		$value = isset($tag["value"]) && !empty($tag["value"]) ? $tag["value"] : '';
        $extend = isset($tag['extend']) && !empty($tag['extend']) ? $tag['extend'] : '';
        
        if (!empty($type)) {
        	switch(strtolower($type)) {
        		case 'text':
        			$arrTag = array();
        			$arrTag["type"] = $type;
        			$arrTag["value"] = $value;
        			$arrTag["name"] = $name;
        			$arrTag["label"] = $label;
        			$arrTag["extend"] = $extend;
        			$parseStr = $html->_input($arrTag, '');
        			break;
        		default:
        			$parseStr = '';
        	}
        }
        
        if (!empty($parseStr)) {
        	$parseStr = '<div class="form-group-sm form-inline">'.$parseStr.'</div>';
        }
		
		return $parseStr;
	}
	
	public function _select($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$tag["class"] = "form-control input-sm";
		$parseStr = $html->_select($tag, $content);
		
		if (!empty($parseStr)) {
        	$parseStr = '<div class="form-group-sm form-inline">'.$parseStr.'</div>';
        }
        
        return $parseStr;
	}
	
	public function _row($tag, $content) {
		$parseStr = "";
		
		if (!empty($content)) {
			$parseStr .= '<li class="search-item">';
			$parseStr .= $this->tpl->parse($content);
			$parseStr .= '</li>';
		}
		
		return $parseStr;
	}
    
    
}
?>