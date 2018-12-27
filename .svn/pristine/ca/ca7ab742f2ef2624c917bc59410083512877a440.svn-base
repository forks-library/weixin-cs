<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;

class Table extends TagLib {

	protected $tags = array(
		'row' =>  array('attr'=>'extend', 'level'=>3),
        'button'=> array('attr'=>'id,click,extend', 'close'=>0)
	);
	
	public function _row($tag, $content) {
		$parseStr = "";
		
		if (!empty($content)) {
			$parseStr .= '<ul class="config-operlist">';
			$parseStr .= $this->tpl->parse($content);
			$parseStr .= '</ul>';
		}
		
		return $parseStr;
	}
	
	public function _button($tag) {
		$parseStr = "";
		$html = new Html();
		
		$id     = isset($tag['id']) && !empty($tag['id']) ? $tag['id'] : '';
		$click  = isset($tag["click"]) && !empty($tag["click"]) ? $tag["click"] : '';
		$extend = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
        $class	= isset($tag["class"]) && !empty($tag["class"]) ? $tag["class"] : '';
        
        if (!empty($id)) {
        	switch(strtolower($id)) {
        		case 'btn_edit':
        			$arrTag = array();
        			$arrTag["id"] = $id;
        			$arrTag["title"] = '编辑';
//        			$arrTag["icon"] = 'fa fa-pencil';
        			$arrTag["click"] = $click;
        			$arrTag["extend"] = $extend;
        			$arrTag["class"] = $class;
        			$parseStr = $html->_imageBtn($arrTag);
        			break;
        		case '_btn_edit':
        			$arrTag = array();
        			$arrTag["id"] = $id;
        			$arrTag["title"] = '编辑';
//        			$arrTag["icon"] = 'fa fa-pencil';
        			$arrTag["click"] = $click;
        			$arrTag["extend"] = $extend;
        			$arrTag["class"] = $class;
        			$parseStr = $html->_imageBtn($arrTag);
        			break;
        		case 'btn_preview':
        			$arrTag = array();
        			$arrTag["id"] = $id;
        			$arrTag["title"] = '预览';
//        			$arrTag["icon"] = 'fa fa-file-text-o';
        			$arrTag["click"] = $click;
        			$arrTag["extend"] = $extend;
        			$arrTag["class"] = $class;
        			$parseStr = $html->_imageBtn($arrTag);
        			break;
        		case 'btn_del':
        			$arrTag = array();
        			$arrTag["id"] = $id;
        			$arrTag["title"] = '删除';
//        			$arrTag["icon"] = 'fa fa-trash-o';
        			$arrTag["click"] = $click;
        			$arrTag["extend"] = $extend;
        			$arrTag["class"] = $class;
        			$parseStr = $html->_imageBtn($arrTag);
        			break;
        		case '_btn_del':
        			$arrTag = array();
        			$arrTag["id"] = $id;
        			$arrTag["title"] = '删除';
//        			$arrTag["icon"] = 'fa fa-trash-o';
        			$arrTag["click"] = $click;
        			$arrTag["extend"] = $extend;
        			$arrTag["class"] = $class;
        			$parseStr = $html->_imageBtn($arrTag);
        			break;
        		default:
        			$parseStr = '';
        	}
        }
        
//        if (!empty($parseStr)) {
//        	$parseStr = '<li>'.$parseStr.'</li>';
//        }
		
		return $parseStr;
	}
    
}
?>