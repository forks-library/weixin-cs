<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;
use Com\Leskymob\Util\WebUtil;

class Editbox extends TagLib {

	protected $tags = array(
        'text'      => array('attr'=>'label,id,name,value,class,disabled,extend,match','close'=>0),
        'hidden'    => array('attr'=>'id,name,value,extend','close'=>0),
        'buttons'   => array('attr'=>'extend', 'level'=>3),
        'select'    => array('attr'=>'name,options,multiple,id,size,first,selected,class,disabled,extend','close'=>0),
        'radio'     => array('attr'=>'name,radios,label,checked,disabled,extend,simple','close'=>0),
        'ajaxinput' => array('attr'=>'label,id,name,value,click,disabled,extend','close'=>0),
        'checkbox'  => array('attr'=>'name,checkboxes,checked,label,disabled,extend','close'=>0),
        'date'      => array('attr'=>'label,id,name,value,class,disabled,extend','close'=>0),
        'textarea'  => array('attr'=>'label,id,name,value,class,disabled,extend','close'=>0),
        'button'    => array('attr'=>'label,id,text,type,click,class,icon,disabled,extend,title','close'=>0),
        'upload'    => array('attr'=>'label,id,name,value,type,class,disabled,extend','close'=>0),
	    'password'  => array('attr'=>'label,id,name,value,class,disabled,extend,match','close'=>0)
	);
	
	public function _upload($tag) {
		$parseStr = "";
		$html     = new Html();
		$name     = isset($tag["name"]) && !empty($tag["name"]) ? $tag["name"] : '';
		$disabled = isset($tag['disabled']) && !empty($tag['disabled']) ? $tag['disabled'] : '';
//		$nameUp = !empty($name) ? $name."_up" : "";
//		$nameFlag = !empty($name) ? $name."_fg" : "";
		$imgFile = $this->tpl->get($nameUp);
		$tag["value"] = $nameUp;
        $tag["type"] = "hidden";
        $tag["class"] = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : "form-control small";
		$parseStr .= $html->_input($tag);
		$tag["type"] = "button";
        $tag["id"] = isset($tag['id']) && !empty($tag['id']) ? $tag['id'] : 'btn_upload_img';
        if (empty($disabled)) {
        	$parseStr .= $html->_imageBtn($tag);
        }
        unset($tag["id"]);
        unset($tag["class"]);
//        unset($tag["label"]);
        unset($tag["value"]);
//        $tag["name"] = $nameUp;
//        $parseStr .= $this->_hidden($tag);
        
//        $tag["name"] = $nameFlag;
//        $parseStr .= $this->_hidden($tag);
        
//        if (!empty($imgFile)) {
//        	$parseStr .= '<div id="_upload_img" style="max-width: 200px; max-height: 200px; margin-top: 10px; margin-left: 150px;">';
//	        $parseStr .= '<img src="'.$imgFile.'" width="100%" height="40%" >';
//	        $parseStr .= '</div>';
//        }
        
		$parseStr = $this->_base($parseStr,$tag);
		
		return $parseStr;
	}
	
	public function _button($tag) {
		$parseStr = "";
		$html = new Html();
		$label = isset($tag['label']) && !empty($tag['label']) ? $tag['label'] : '';
		
//		if (!empty($label)) {
//        	$parseStr .= '<label>'.$label.':</label>';
//        }
        $parseStr .= $html->_imagebtn($tag);
		$parseStr = $this->_base($parseStr,$label);
		
		return $parseStr;
	}

	
	public function _textarea($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$parseStr = $html->_textarea($tag, $content);
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}
	public function _text($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$tag["type"] = "text";
		$parseStr = $html->_input($tag, $content);
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}

	public function _password($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$tag["type"] = "password";
		$parseStr = $html->_input($tag, $content);
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}
	
	public function _date($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$tag["type"] = "text";
		$tag['class'] = "form-control date";
		$parseStr = $html->_input($tag, $content);
		$parseStr .= '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}
	
	public function _hidden($tag) {
		$parseStr = "";
		$html = new Html();
		$tag["type"] = "hidden";
		$parseStr = $html->_input($tag);
        
        return $parseStr;
	}
	
	public function _buttons($tag, $content) {
		$parseStr = "";
		
		if (!empty($content)) {
			$parseStr .= '<div class="table-footer">';
			$parseStr .= '<div class="table-footer-button">';
			$parseStr .= $this->tpl->parse($content);
			$parseStr .= '</div>';
			$parseStr .= '</div>';
		}
        
        return $parseStr;
	}
	
	public function _select($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$tag["flag"] = "select";
		$parseStr = $html->_select($tag, $content);
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}
	
	public function _radio($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$parseStr = $html->_radio($tag, $content);
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}
	
	public function _ajaxinput($tag, $content) {
		$parseStr = "";
		$html = new Html();
		$parseStr = $html->_ajaxinput($tag, $content);
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}
	
	public function _checkbox($tag) {
		$parseStr = "";
		$html = new Html();
		$parseStr = $html->_checkbox($tag);
		$parseStr = $this->_base($parseStr,$tag);
        
        return $parseStr;
	}
	
	protected function _base($parseStr,$tag) {
		if (!empty($parseStr)) {
			if (!empty($tag["flag"]) && $tag["flag"] == "select") {
				$parseStr = '<li class="width10 text-right">'.$tag['label'].' : </li><li class="width85 form-group-sm">'.$parseStr.'</li>';
				$parseStr = '<ul class="data-group" style="overflow: visible;">'.$parseStr.'</ul>';
			} else {
				$parseStr = '<li class="width10 text-right">'.$tag['label'].' : </li><li class="width40 form-group-sm">'.$parseStr.'</li>';
				$parseStr = '<ul class="data-group">'.$parseStr.'</ul>';
			}
		}
		return $parseStr;
	}
	
    
}
?>