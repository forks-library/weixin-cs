<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;

class Viewer extends TagLib {
	
	protected $tags = array(
        'text'      => array('attr'=>'label,name,value,class,disabled,extend,match','close'=>0),
        'hidden'    => array('attr'=>'id,name,value,extend','close'=>0),
        'buttons'   => array('attr'=>'extend', 'level'=>3),
        'select'    => array('attr'=>'name,options,multiple,id,size,first,selected,class,disabled,extend','close'=>0),
        'radio'     => array('attr'=>'name,radios,label,checked,disabled,extend,simple','close'=>0),
        'ajaxinput' => array('attr'=>'label,id,name,value,click,disabled','close'=>0),
        'checkbox'  => array('attr'=>'name,checkboxes,checked,label,disabled,extend','close'=>0),
        'date'      => array('attr'=>'label,id,name,value,class,disabled,extend','close'=>0),
        'textarea'  => array('attr'=>'label,id,name,value,class,disabled,extend','close'=>0),
        'button'    => array('attr'=>'label,id,text,type,click,class,icon,disabled,extend,title','close'=>0),
        'upload'    => array('attr'=>'label,id,name,value,type,class,disabled,extend','close'=>0),
        'row'       => array('attr'=>'extend','level'=>3)
	);

	public function _text($tag, $content) {
		$parseStr = "";

		$name       = isset($tag['name']) && !empty($tag['name']) ? $tag['name'] : '';
		$value      = isset($tag['value']) && !empty($tag['value']) ? $tag['value'] : '';
		$id         = isset($tag['id']) && !empty($tag['id']) ? $tag['id'] : $name;
		$label      = isset($tag['label']) && !empty($tag['label']) ? $tag['label'] : '';
		$class      = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : '';
		$disabled   = isset($tag['disabled']) && !empty($tag['disabled']) ? $tag['disabled'] : '';
		$extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
		$match      = isset($tag["match"]) && !empty($tag["match"]) ? $tag["match"] : '';

		if (!empty($type) && strtolower($type) === "hidden") {
			$class = "";
		}

		if (!empty($value)) {
			$value = $this->tpl->get($value);
		} else if (!empty($name)) {
			$value = $this->tpl->get($name);
		}

		if (!empty($match)) {
			switch(strtolower($match)) {
				case 'money':
					$value = StringUtil::toWebMoney($value);
					break;
				default:
					break;
			}
		}

		if (!empty($label)) {
			$parseStr .= '<label>'.$label.':</label>';
		}

		$parseStr .= '<span id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$extend;

		if (!empty($disabled)) {
			$parseStr .= ' disabled="disabled" ';
		} else {
		}

		$parseStr .= ' >'.$value.'</span>';

		$parseStr = $this->_base($parseStr);

        return $parseStr;
	}

	public function _row($tag, $content) {
		$parseStr = "";

		if (!empty($content)) {
			$parseStr .= '<div class="infor-wrap">';
			$parseStr .= $this->tpl->parse($content);
			$parseStr .= '</div>';
		}

		return $parseStr;
	}
	
	protected function _base($parseStr) {
		if (!empty($parseStr)) {
			$parseStr = '<div class="form-group-sm form-ib">'.$parseStr.'</div>';
		}
		return $parseStr;
	}

}
?>