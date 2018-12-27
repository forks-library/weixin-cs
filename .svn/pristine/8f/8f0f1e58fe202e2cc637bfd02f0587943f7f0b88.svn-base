<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Think\Template\TagLib;
use Think\Template\TagLib;
//use Com\Mor\Manage\RedisManage;
use Com\Mor\Manage\SecurityManage;
use Com\Mor\Manage\MenuManage;
use Com\Mor\Util\StringUtil;
/**
 * Html标签库驱动
 */
class Html extends TagLib{
    // 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'editor'    => array('attr'=>'id,name,style,width,height,type','close'=>1),
        'select'    => array('attr'=>'name,options,multiple,id,size,first,selected,class,disabled,extend','close'=>0),
        'grid'      => array('attr'=>'id,pk,style,action,actionlist,show,datasource','close'=>0),
        'list'      => array('attr'=>'id,pk,style,action,actionlist,show,datasource,checkbox','close'=>0),
        'imagebtn'  => array('attr'=>'id,text,type,click,class,icon,disabled,extend,title','close'=>0),
        'checkbox'  => array('attr'=>'name,checkboxes,checked,label,disabled,extend','close'=>0),
        'radio'     => array('attr'=>'name,radios,label,checked,disabled,extend,simple','close'=>0),
        'input'     => array('attr'=>'label,id,name,value,type,class,disabled,extend,match','close'=>0),
        'ajaxinput' => array('attr'=>'label,id,name,value,click,disabled,extend','close'=>0),
        'menu'      => array('attr'=>'name,target,childs','close'=>0),
        'pagetitle' => array('attr'=>'name','close'=>0),
        'textarea'  => array('attr'=>'label,id,name,value,class,disabled,extend','close'=>0),
        'span'      => array('attr'=>'value,class','close'=>0),
        'label'     => array('attr'=>'value,class','close'=>0)
        );
	
	public function _label($tag) {
		$parseStr = "";
		
		$value = isset($tag['value']) && !empty($tag['value']) ? $tag['value'] : '';
		$class = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : '';
		
		if (!empty($value)) {
			$parseStr .= '<label ';
			
			if (!empty($class)) {
				$parseStr .= ' class="'.$class.'" ';
			}
			
			$parseStr .= ' >'.$value.'</label>';
		}
		
		return $parseStr;
	}
	
	public function _span($tag) {
		$parseStr = "";
		
		$value = isset($tag['value']) && !empty($tag['value']) ? $tag['value'] : '';
		$class = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : '';
		
		if (!empty($value)) {
			$parseStr .= '<span ';
			
			if (!empty($class)) {
				$parseStr .= ' class="'.$class.'" ';
			}
			
			$parseStr .= ' >'.$value.'</span>';
		}
		
		return $parseStr;
	}
	
	public function _textarea($tag, $content) {
		$parseStr = "";
		
		$name       = isset($tag['name']) && !empty($tag['name']) ? $tag['name'] : '';
        $value      = isset($tag['value']) && !empty($tag['value']) ? $tag['value'] : '';
        $id         = isset($tag['id']) && !empty($tag['id']) ? $tag['id'] : $name;
        $label      = isset($tag['label']) && !empty($tag['label']) ? $tag['label'] : '';
        $class      = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : 'form-control';
        $disabled   = isset($tag['disabled']) && !empty($tag['disabled']) ? $tag['disabled'] : '';
        $extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
        
        if (!empty($value)) {
        	$value = $this->tpl->parseVar($value);
        } else if (!empty($name)) {
//        	$value = $this->tpl->parseVar($name);
        }
        
        if (!empty($label)) {
//        	$parseStr .= '<div class="infor-itemL">';
//        	$parseStr .= '<label>'.$label.':</label>';
//        	$parseStr .= '</div>';
        }
        
//        $parseStr .= '<div class="infor-itemR">';
		$parseStr .= '<textarea id="'.$id.'"  name="'.$name.'" class="input textarea '.$class.'" '.$extend;
		
		if (!empty($disabled)) {
			$parseStr .= ' disabled="disabled" ';
		} else {
		}
		
		$parseStr .= ' >';
		$parseStr .= $value;
		$parseStr .= '</textarea>';
//		$parseStr .= '</div>';
		
		return $parseStr;
	}
	
	// 当前页面路径
	public function _pagetitle($tag, $content) {
		$parseStr = "";
		
		$name = isset($tag["name"]) ? $tag["name"] : '';
		
		if (!empty($name)) {
			$tempRute   = '';
			$menuManage = new MenuManage();
			$parents = $menuManage->getParentByName($name);
			
			if (!empty($parents)) {
				$tempRute .= $this->findMenuParentNode($parents);
			}
			
			$parseStr .= '<div class="route"><span><i class="img-b gg-b"></i></span>';
			$parseStr .= '<ul>';
			$parseStr .= $tempRute;
			$parseStr .= '<li class="opc8 text-w900">'.$name.'</li>';
			$parseStr .= '</ul>';
			$parseStr .= '</div>';
		}
		
		return $parseStr;
	}
	
	protected function findMenuParentNode($parents) {
		$parseStr = "";
		
		if (!empty($parents)) {
			if (isset($parents["parent"]) && !empty($parents["parent"]) && is_array($parents["parent"])) {
				$parseStr .= $this->findMenuParentNode($parents["parent"]);
			}
			
			$parseStr .= '<li class="opc8 text-w900">'.$parents["name"].'</li>';
		}
		
		return $parseStr;
	}
	
	private function _parseTopMenu($menu, $selected = "") {
		$parseStr = "";
		
		if (!empty($menu) && is_array($menu)) {
			$parseStr .= '<div class="ceng1 ';
			// 被选中的情况下
			if (!empty($selected) && $menu["name"] === $selected) {
				$parseStr .= 'ceng1-active';
			}
			$parseStr .= '">';
			
			$parseStr .= '<a href="';
			if (!empty($menu["url"])) {
				$parseStr .= U($menu["url"]);
			} else {
				$parseStr .= '#';
			}
			$parseStr .= '" data-parent="#aside" class="opc8 text-w900 color-w ';
			
			// 将图标缩小
			if (!empty($selected)) {
				$parseStr .= 'hide-left';
			} else {
				$parseStr .= 'show-left';
			}
			$parseStr .= '" title="'.$menu["name"].'">';
			
			$parseStr .= '<i class="'.$menu["icon"].'-w img-b ceng1-firstImg"></i>';
			// 隐藏汉字
			if (empty($selected)) {
				$parseStr .= '<span>'.$menu["name"].'</span>';
				$parseStr .= '<span class="float-right"><i class="img-s caret-right-w ceng1-lastImg"></i></span>';
			}
			
			$parseStr .= '</a>';
			$parseStr .= '</div>';
		}
		
		return $parseStr;
	}
	
	private function _parseSecondMenu($securityManage, $menu) {
		$parseStr = "";
		
		if (!empty($securityManage) && !empty($menu) && is_array($menu)) {
			$parseStr .= '<div class="ceng3">';
			$parseStr .= '<a class="opc8">';
//			$parseStr .= '<img class="img-s" src="__PUBLIC__/images/caret-right-b.png" />';
			$parseStr .= '<i class="img-s caret-right-b ceng3-img"></i>';
			$parseStr .= $menu["name"];
			$parseStr .= '</a>';
			
			if (isset($menu["childs"]) && !empty($menu["childs"]) && is_array($menu["childs"])) {
				// 三级菜单模版开始
				$parseStr .= '<div class="ceng3-data display-none">';
				$parseStr .= '<ul>';
				
				foreach ($menu["childs"] as $k1 => $nextMenu) {
					if ($securityManage->isAllowView($nextMenu["name"])) {
						// 解析下一级菜单
						$parseStr .= $this->_parseThirdMenu($nextMenu);
					}
				}
				
				// 三级菜单模版结束
				$parseStr .= '</ul>';
				$parseStr .= '</div>';
			}
			
			$parseStr .= '</div>';
		}
		
		return $parseStr;
	}
	
	private function _parseThirdMenu($menu) {
		$parseStr = "";
		
		if (!empty($menu) && is_array($menu)) {
			$parseStr .= '<li>';
			$parseStr .= '<a class="opc7" href="javascript: et.menu.click(\''.$menu["url"].'\')">'.$menu["name"].'</a>';
			$parseStr .= '</li>';
		}
		
		return $parseStr;
	}
	
	public function _menu($tag, $content) {
		$parseStr  = "";
		$target    = isset($tag["target"]) ? $tag["target"] : '';
		// 安全控制对象
		$securityManage = new SecurityManage();
		// 菜单对象
		$menuManage = new MenuManage();
		// 顶级菜单列表
		$topMenus   = $menuManage->getTop();

		if (!empty($topMenus) && is_array($topMenus)) {
			// 外层菜单模版开始
			$parseStr  .= '<div class="aside-left aside-left-bg float-left">';
			
			foreach ($topMenus as $k1 => $topMenu) {
				if ($securityManage->isAllowView($topMenu["name"])) {
					// 解析顶级菜单
					$parseStr .= $this->_parseTopMenu($topMenu, $target);
				}
			}
			
			// 外层菜单模版结束
			$parseStr .= '</div>';
			
			if (!empty($target) && $securityManage->isAllowView($target)) {
				// 下一级菜单
				$nextMenus = $menuManage->getNext($target);
				
				if (!empty($nextMenus) && is_array($nextMenus)) {
					// 二级菜单模版开始
					$parseStr .= '<div class="aside-right float-left aside-right-bd" style="width: auto;">';
					$parseStr .= '<div class="ceng2">';
					
					foreach ($nextMenus as $k1 => $nextMenu) {
						if ($securityManage->isAllowView($nextMenu["name"])) {
							// 解析下一级菜单
							$parseStr .= $this->_parseSecondMenu($securityManage, $nextMenu);
						}
					}
					
					// 二级菜单模版结束
					$parseStr .= '</div>';
					$parseStr .= '</div>';
				}
			}
		}
		

//		if (!empty($nameArr) && strpos($nameArr, ",") !== false) {
//			$nameArr = explode(",", $nameArr);
//		}
			// 循环处理
//			$arrFirstMenu = array();
//			$num = 0;
//			$menuImages  =  array("cog-w.png","file-archive-w.png","user-w.png","file-archive-w.png");
//			foreach ($nameArr as $key => $name) {
//				if (!empty($name) && $securityManage->isAllowView($name)) {
//					$parseStr = '';
////					$id = RedisManage::mget(R_SYS_MENU_NAME_ID, $name);
////					$viewId = R_SYS_MENU_ID_.$id;
//					$url = "";
//					$icon = "";
//					$childs = "";
//					
////					if (!is_null($id)) {
////						$url = RedisManage::mget(R_SYS_MENU_URL, $name);
////						$icon = RedisManage::hget(R_SYS_MENU_ICON, $name);
////						
////						if (!empty($icon)) {
////							$icon = explode("fa-",$icon);
////							$icon = $icon[1].'-w.png';
////						} else {
////							$icon = $menuImages[$num];
////						}
////						
////						$childs = RedisManage::sget($viewId);
////					}
//					
//					if (!empty($childs) && is_array($childs)) {
//						
//						$parseStr .= '<div class="ceng1">';
//						$parseStr .= '<a data-id="'.$viewId.'" data-parent="#aside" class="opc8 text-w900 color-w show-left" title="'.$name.'">';
//						$parseStr .= '<img class="img-b" src="__PUBLIC__/Images/'.$icon.'"/><span>'.$name.'</span><span class="float-right"><img class="img-s" src="__PUBLIC__/Images/caret-right-w.png"/></span>';
//						$parseStr .= '</a>';
//						$parseStr .= '</div>';
//						
//					} else if (!empty($url)) {
//						
//						$parseStr .= '<div class="ceng1">';
//						$parseStr .= '<a href="javascript: et.menuClick(\''.$url.'\')" data-id="'.$viewId.'" data-parent="#aside" class="opc8 text-w900 color-w show-left" title="'.$name.'">';
//						$parseStr .= '<img class="img-b" src="__PUBLIC__/Images/'.$icon.'"/><span>'.$name.'</span><span class="float-right"><img class="img-s" src="__PUBLIC__/Images/caret-right-w.png"/></span>';
//						$parseStr .= '</a>';
//						$parseStr .= '</div>';
//						
//					} else {
//						$parseStr .= '<div class="ceng1">';
//						$parseStr .= '<a href="#" data-parent="#aside" class="opc8 text-w900 color-w show-left" title="'.$name.'">';
//						$parseStr .= '<img class="img-b" src="__PUBLIC__/Images/'.$icon.'"/><span>'.$name.'</span><span class="float-right"><img class="img-s" src="__PUBLIC__/Images/caret-right-w.png"/></span>';
//						$parseStr .= '</a>';
//						$parseStr .= '</div>';
//					}
//					
//					$arrFirstMenu[$num]["one"] = $parseStr;
//
//					if (!empty($childs) && is_array($childs)) {
//						$childHtml = '';
//						foreach ($childs as $child) {
//							$childHtml .= $this->load_submenu($child);
//						}
//						if (!empty($childHtml)) {
//							$childHtml = '<div class="ceng2 display-none" id="'.$viewId.'">'.$childHtml.'</div>';
//							$arrFirstMenu[$num]["more"] = $childHtml;
//						}
//					}
//					$num ++;
//				}
//			}
			
//			$parseStr = '';
			
//			if (!empty($arrFirstMenu) && sizeof ($arrFirstMenu) > 0) {
//				$firstMenu  = '';
//				$remainMenu = '';
//				// 一级菜单
//				$parseStr  .= '<div class="aside-left header-title-bg float-left">';
//				foreach ($arrFirstMenu as $key => $val) {
//					$firstMenu  .= $val['one'];
//					$remainMenu .= $val['more'];
//				}
//				$parseStr .= $firstMenu;
//				
//				// 一级菜单收放按钮
//				$parseStr .= '<div class="ceng1-bottom pointer">';
//				$parseStr .= '<div class="ceng1-hide float-left pointer text-center"><img class="img-bb" src="__PUBLIC__/Images/off.gif"/></div>';
//				$parseStr .= '</div>';
//				
//				$parseStr .= '</div>';
//			
//				// 二三级菜单
//				$parseStr .= '<div class="aside-right aside-left-bd float-left">';
//				$parseStr .= $remainMenu;
//				$parseStr .= '</div>';
//				
//				// 二三级菜单收放按钮
//				$parseStr .= '<div id="show-data" class="hide-right-far text-center float-left pointer"><img class="img-b" src="__PUBLIC__/Images/outdent-b.png"/></div>';
//			}
		
		return $parseStr;
	}
	
	// 获取二级菜单及其下的三级菜单
	protected function load_submenu($menuName) {
		$parseStr = "";
		
		if (!empty($menuName) && SecurityManage::isAllowView($menuName)) {
			$id = RedisManage::mget(R_SYS_MENU_NAME_ID, $menuName);
			$viewId = R_SYS_MENU_ID_.$id;
			$url = "";
			$icon = "";
			$childs = "";
			
			if (!is_null($id)) {
				$url = RedisManage::mget(R_SYS_MENU_URL, $menuName);
//				$icon = RedisManage::hget(R_SYS_MENU_ICON, $menuName);
				$childs = RedisManage::sget($viewId);
			}
			
			$parseStr .= '<div class="ceng3">';
			if (!empty($childs) && is_array($childs)) {
				$parseStr .= '<a class="opc8" ><img class="img-s" src="__PUBLIC__/Images/caret-right-b.png"/>'.$menuName.'</a>';
			} else if (!empty($url)) {
				$parseStr .= '<a class="opc8" href="javascript: et.menu.click(\''.$url.'\')">'.$menuName.'</a>';
			} else {
				$parseStr .= '<a class="opc8" href="#">'.$menuName.'</a>';
			}
			
			if (!empty($childs) && is_array($childs)) {
				$childHtml = '';
				foreach ($childs as $child) {
					$childHtml .= $this->load_treemenu($child);
				}
				if (!empty($childHtml)) {
					$childHtml = '<div class="ceng3-data display-none"><ul>'.$childHtml.'</ul></div>';
				}
				$parseStr .= $childHtml;
			}
			
			$parseStr .= '</div>';
		}
		return $parseStr;
	}
	
	// 获取三级菜单
	protected function load_treemenu($menuName) {
		$parseStr = "";
		
		if (!empty($menuName) && SecurityManage::isAllowView($menuName)) {
			$url = RedisManage::mget(R_SYS_MENU_URL, $menuName);
			$url = strtolower($url);
			
			if (!empty($url)) {
				$parseStr .= '<li><a class="opc7" href="javascript: et.menu.click(\''.$url.'/index\')">'.$menuName.'</a></li>';
			} else {
				$parseStr .= '<li><a class="opc7" href="#">'.$menuName.'</a></li>';
			}
		}
		
		return $parseStr;
	}
	
    public function _ajaxinput($tag, $content) {
    	$parseStr = "";
    	
    	$name       = $tag['name'];
        $value      = isset($tag['value'])?$tag['value']:'';
        $id         = isset($tag['id'])?$tag['id']:'';
    	$click      = isset($tag['click'])?$tag['click']:'';
    	$label      = isset($tag['label'])?$tag['label']:'';
    	$disabled   = empty($tag['disabled'])?'':$tag['disabled'];
    	$extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
    	$value      = $this->tpl->get($value)?$this->tpl->get($value):"";
    	$keyVal     = $this->tpl->get($name)?$this->tpl->get($name):"";
    	
    	if (empty($id)) {
    		$id = $name;
    	}
    	
    	$btnId = $id."_cl";
    	$vlId  = $id.'_val';
    	$idId  = $id.'_id';
    	$vlVal = $this->tpl->get($vlId)?$this->tpl->get($vlId):"";
    	if (empty($value)) {
    		$value = $this->tpl->get($idId)?$this->tpl->get($idId):"";
    	}
    	
    	if (!empty($label)) {
//        	$parseStr .= '<label>'.$label.':</label>';
        }
        
        $parseStr .= '<input type="text" id="'.$id.'"  name="'.$name.'" value="'.$keyVal.'" onclick="'.$click.'" class="input form-control ajaxinput-left autocompleter-node" autocomplete="off" '.$extend;
		if (!empty($disabled)) {
			$parseStr .= ' disabled="disabled"';
		} else {
		}
		$parseStr .= ' />';
//		$parseStr .= '<button type="button" id="'.$btnId.'" class="input-group-addon ajaxinput" ';
//		if (!empty($disabled)) {
//			$parseStr .= ' disabled="disabled"';
//		} else {
//			$parseStr .= '  if($html_view_status == \'true\'):  disabled="disabled" php endif; ';
//		}
//		$parseStr .= ' ><i class="fa fa-search"></i></button>';
//		$parseStr .= '<input type="text" class="form-control ajaxinput" id="'.$vlId.'" value="'.$vlVal.'" disabled="disabled" />';
		$parseStr .= '<input type="hidden" id="'.$idId.'" value="'.$value.'" />';
    	
    	return $parseStr;
    }

	public function _input($tag) {
		$parseStr = "";
		
		$name       = isset($tag['name']) && !empty($tag['name']) ? $tag['name'] : '';
        $value      = isset($tag['value']) && !empty($tag['value']) ? $tag['value'] : '';
        $id         = isset($tag['id']) && !empty($tag['id']) ? $tag['id'] : $name;
        $type       = isset($tag['type']) && !empty($tag['type']) ? $tag['type'] : 'text';
        $label      = isset($tag['label']) && !empty($tag['label']) ? $tag['label'] : '';
        $class      = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : 'form-control';
        $disabled   = isset($tag['disabled']) && !empty($tag['disabled']) ? $tag['disabled'] : '';
        $extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
        $match      = isset($tag["match"]) && !empty($tag["match"]) ? $tag["match"] : '';
        $required   = isset($tag["required"]) && !empty($tag["required"]) ? $tag["required"] : '';
        
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
  //      	$parseStr .= '<label>'.$label.':</label>';
        }
        
		$parseStr .= '<input type="'.$type.'" id="'.$id.'"  name="'.$name.'" value="'.$value.'" class="input '.$class.'" '.$extend;
		
		if (!empty($label)) {
			$parseStr .= ' data-label="'.$label.'" ';
        }
		
		if (!empty($disabled)) {
			$parseStr .= ' disabled="disabled" ';
		} else {
		}
		
		$parseStr .= ' >';
		
		if(!empty($required)){
			$parseStr .= '<font>&nbsp;&nbsp;*</font>';
		}
		
		return $parseStr;
	}

    /**
     * editor标签解析 插入可视化编辑器
     * 格式： <html:editor id="editor" name="remark" type="FCKeditor" style="" >{$vo.remark}</html:editor>
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _editor($tag,$content) {
        $id			=	!empty($tag['id'])?$tag['id']: '_editor';
        $name   	=	$tag['name'];
        $style   	    =	!empty($tag['style'])?$tag['style']:'';
        $width		=	!empty($tag['width'])?$tag['width']: '100%';
        $height     =	!empty($tag['height'])?$tag['height'] :'320px';
     //   $content    =   $tag['content'];
        $type       =   $tag['type'] ;
        switch(strtoupper($type)) {
            case 'FCKEDITOR':
                $parseStr   =	'<!-- 编辑器调用开始 --><script type="text/javascript" src="__ROOT__/Public/Js/FCKeditor/fckeditor.js"></script><textarea id="'.$id.'" name="'.$name.'">'.$content.'</textarea><script type="text/javascript"> var oFCKeditor = new FCKeditor( "'.$id.'","'.$width.'","'.$height.'" ) ; oFCKeditor.BasePath = "__ROOT__/Public/Js/FCKeditor/" ; oFCKeditor.ReplaceTextarea() ;function resetEditor(){setContents("'.$id.'",document.getElementById("'.$id.'").value)}; function saveEditor(){document.getElementById("'.$id.'").value = getContents("'.$id.'");} function InsertHTML(html){ var oEditor = FCKeditorAPI.GetInstance("'.$id.'") ;if (oEditor.EditMode == FCK_EDITMODE_WYSIWYG ){oEditor.InsertHtml(html) ;}else	alert( "FCK必须处于WYSIWYG模式!" ) ;}</script> <!-- 编辑器调用结束 -->';
                break;
            case 'FCKMINI':
                $parseStr   =	'<!-- 编辑器调用开始 --><script type="text/javascript" src="__ROOT__/Public/Js/FCKMini/fckeditor.js"></script><textarea id="'.$id.'" name="'.$name.'">'.$content.'</textarea><script type="text/javascript"> var oFCKeditor = new FCKeditor( "'.$id.'","'.$width.'","'.$height.'" ) ; oFCKeditor.BasePath = "__ROOT__/Public/Js/FCKMini/" ; oFCKeditor.ReplaceTextarea() ;function resetEditor(){setContents("'.$id.'",document.getElementById("'.$id.'").value)}; function saveEditor(){document.getElementById("'.$id.'").value = getContents("'.$id.'");} function InsertHTML(html){ var oEditor = FCKeditorAPI.GetInstance("'.$id.'") ;if (oEditor.EditMode == FCK_EDITMODE_WYSIWYG ){oEditor.InsertHtml(html) ;}else	alert( "FCK必须处于WYSIWYG模式!" ) ;}</script> <!-- 编辑器调用结束 -->';
                break;
            case 'EWEBEDITOR':
                $parseStr	=	"<!-- 编辑器调用开始 --><script type='text/javascript' src='__ROOT__/Public/Js/eWebEditor/js/edit.js'></script><input type='hidden'  id='{$id}' name='{$name}'  value='{$conent}'><iframe src='__ROOT__/Public/Js/eWebEditor/ewebeditor.htm?id={$name}' frameborder=0 scrolling=no width='{$width}' height='{$height}'></iframe><script type='text/javascript'>function saveEditor(){document.getElementById('{$id}').value = getHTML();} </script><!-- 编辑器调用结束 -->";
                break;
            case 'NETEASE':
                $parseStr   =	'<!-- 编辑器调用开始 --><textarea id="'.$id.'" name="'.$name.'" style="display:none">'.$content.'</textarea><iframe ID="Editor" name="Editor" src="__ROOT__/Public/Js/HtmlEditor/index.html?ID='.$name.'" frameBorder="0" marginHeight="0" marginWidth="0" scrolling="No" style="height:'.$height.';width:'.$width.'"></iframe><!-- 编辑器调用结束 -->';
                break;
            case 'UBB':
                $parseStr	=	'<script type="text/javascript" src="__ROOT__/Public/Js/UbbEditor.js"></script><div style="padding:1px;width:'.$width.';border:1px solid silver;float:left;"><script LANGUAGE="JavaScript"> showTool(); </script></div><div><TEXTAREA id="UBBEditor" name="'.$name.'"  style="clear:both;float:none;width:'.$width.';height:'.$height.'" >'.$content.'</TEXTAREA></div><div style="padding:1px;width:'.$width.';border:1px solid silver;float:left;"><script LANGUAGE="JavaScript">showEmot();  </script></div>';
                break;
            case 'KINDEDITOR':
                $parseStr   =  '<script type="text/javascript" src="__ROOT__/Public/Js/KindEditor/kindeditor.js"></script><script type="text/javascript"> KE.show({ id : \''.$id.'\'  ,urlType : "absolute"});</script><textarea id="'.$id.'" style="'.$style.'" name="'.$name.'" >'.$content.'</textarea>';
                break;
            default :
                $parseStr  =  '<textarea id="'.$id.'" style="'.$style.'" name="'.$name.'" >'.$content.'</textarea>';
        }

        return $parseStr;
    }

    /**
     * imageBtn标签解析
     * 格式： <a class="button btn_add"><img class="img-b" src="__PUBLIC__/Images/plus-b.png"/>新增</a>
     * 修改时间： 2016/07/27 林建成
     * 格式修改为： <button class="button btn_add"><i class="img-b plus-b"></i> 新增</button>
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _imageBtn($tag) {
    	// 资源目录
    	$publicRoot = defined('SERVER_RESOURCE') ? SERVER_RESOURCE.'/Public' : __ROOT__.'/Public';
    	$parseStr 	= '';
    	$isAllow 	= true;
        $id         = isset($tag['id']) && !empty($tag['id']) ? $tag['id'] : '';
        $text       = isset($tag["text"]) && !empty($tag["text"]) ? $tag["text"] : '';
        $type       = isset($tag['type']) && !empty($tag['type']) ? $tag['type'] : '';
        $click      = isset($tag["click"]) && !empty($tag["click"]) ? $tag["click"] : '';
        $class      = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : '';
        $icon       = '';
        $disabled   = isset($tag['disabled']) && !empty($tag['disabled']) ? $tag['disabled'] : '';
        $extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
        $title      = isset($tag["title"]) && !empty($tag["title"]) ? $tag["title"] : '';
        $cool		= false;
        // 安全管理对象
        $securityManage = new SecurityManage();
        
        if (!empty($id)) {
        	switch(strtolower($id)) {
        		case 'btn_save':
	            	$text 	= empty($text) ? '保存' : $text;
        			$icon 	= "check-b";
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= 'button save';
	            	break;
	            case 'btn_saveList':
	            	$text 	= empty($text) ? '保存' : $text;
        			$icon 	= "check-b";
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= 'button save btn_save';
	            	break;
	            case 'btn_edit_del':
	            	$text 	= empty($text) ? '删除' : $text;
        			$icon 	= "close-b";
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= 'button button-red';
	            	break;
	            case 'btn_back':
	            	$text 	= empty($text) ? '返回' : $text;
        			$icon 	= "rotate-left-b";
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= 'button back';
	            	break;
	            case 'btn_backList':
	            	$text 	= empty($text) ? '返回' : $text;
        			$icon 	= "rotate-left-b";
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= 'button back btn_back';
	            	break;
        		case 'btn_add':
	            	$text 	= empty($text) ? '新增' : $text;
        			$icon 	= 'plus-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
        			$isAllow = $securityManage->isAllowNew($securityManage->getModularNameByUrl());
	            	break;
	            case 'btn_addList':
	            	$text 	= empty($text) ? '新增' : $text;
        			$icon 	= 'plus-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button btn_add' : $class;
        			$isAllow = $securityManage->isAllowNew($securityManage->getModularNameByUrl());
	            	break;
	             case 'btn_add_auths':
	            	$text 	= empty($text) ? '新增权限' : $text;
        			$icon 	= 'plus-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class."";
        			$isAllow = $securityManage->isAllowNew($securityManage->getModularNameByUrl());
	            	break;	
        		case 'btn_exp':
	            	$text = empty($text) ? '导出' : $text;
        			$icon = 'level-up-b';
        			$type = empty($type) ? 'button' : $type;
        			$class = empty($class) ? 'button' : $class;
        			$isAllow = $securityManage->isAllowDownload($securityManage->getModularNameByUrl());
	            	break;
	            case 'btn_imp':
	            	$text 	= empty($text) ? '导入' : $text;
        			$icon 	= 'level-down-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
        			$isAllow = $securityManage->isAllowDownload($securityManage->getModularNameByUrl());
	            	break;
//        		case 'btn_imp_tmp':
//	            	$text 	= empty($text) ? '模版下载' : $text;
//        			$icon 	= 'arrow-down-b.png';
//        			$type 	= empty($type) ? 'button' : $type;
//        			$class 	= empty($class) ? 'button' : $class;
//        			$isAllow = SecurityManage::isAllowDownload(SecurityManage::getModularNameByUrl());
//	            	break;
	            case 'btn_search_list':
	            	$text 	= empty($text) ? '' : $text;
        			$icon 	= 'list-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            case 'search_b':
	            	$text 	= empty($text) ? '' : $text;
        			$icon 	= 'search-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            case 'btn_preview':
	            	$text 	= empty($text) ? '' : $text;
        			$icon 	= 'file-text-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            case 'btn_edit':
	            	$text 	= empty($text) ? '' : $text;
        			$icon 	= 'pencil-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            case 'btn_del':
	            	$text 	= empty($text) ? '' : $text;
        			$icon 	= 'trash-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            case 'btn_upload_img':
	            	$text = empty($text) ? '上传图片' : $text;
        			$icon =  'plus-circle-b';      			
        			$type = empty($type) ? 'button' : $type;
        			$cool = true;
        			$class 	= 'btn-add-pic hover-color-blue';
        			$isAllow = $securityManage->isAllowUpload($securityManage->getModularNameByUrl());
	            	break;
	           case 'btn_pass':
	            	$text 	= empty($text) ? '通过' : $text;
        			$icon 	= 'pass-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            case 'btn_refuse':
	            	$text 	= empty($text) ? '拒绝' : $text;
        			$icon 	= 'refuse-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;	
	            case 'btn_test':
	            	$text 	= empty($text) ? '测试' : $text;
        			$icon 	= 'test-account-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            case 'btn_pay':
	            	$text 	= empty($text) ? '支付' : $text;
        			$icon 	= 'pay-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
	            	break;
	            default:
	            	$text 	= empty($text) ? '' : $text;
        			$icon 	= 'list-b';
        			$type 	= empty($type) ? 'button' : $type;
        			$class 	= empty($class) ? 'button' : $class;
        	}
        }
    	
    	if (empty($title) && !empty($text)) {
        	$title = $text;
        }
        
        if ($isAllow) {
//        	$parseStr .= ' <?php if($html_view_status !== \'true\'):';
        	
	        if (!$cool) {
	        	if ($id == "btn_exp" || $id == "btn_imp") {
	        		$parseStr .= '<button type="'.$type.'" class="button '.$id.'_box btn-dropdown-title '.$class.'"';
	        	} else {
	        		$parseStr .= '<button type="'.$type.'" class="'.$class.' '.$id.'" onclick="'.$click.'" title="'.$title.'" '.$extend;
					if (!empty($disabled)) {
						$parseStr .= ' disabled="disabled" ';
					}
	        	}
				$parseStr .= ' >';
			} else {
				$parseStr .= '<label class="'.$class.'" href="javascript:void(0);">';
				$parseStr .= '<span id="'.$id.'" data-type="img"><i class="img-b opc6 '.$icon.'"></i>&nbsp;'.$text.'</span>';
//				$parseStr .= '<input class="file-prew" type="file">';
			}
			
			if (!$cool) {
			//	$parseStr .= '<img class="img-b" src="'.$publicRoot.'/images/'.$icon.'"/>&nbsp;';	
				$parseStr .= '<i class="img-b '.$icon.'"></i>&nbsp;';	
				$parseStr .= $text;
				$parseStr .= '</button>';
			} else {
				$parseStr .= $text;
				$parseStr .= '</label>';
			}
			
//			$parseStr .= '<?php endif; ';
        }
        
        return $parseStr;
    }
	

    /**
     * imageLink标签解析
     * 格式： <html:imageLink type="" value="" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _imgLink($tag) {
        $name       = $tag['name'];                //名称
        $alt        = $tag['alt'];                //文字
        $id         = $tag['id'];                //ID
        $style      = $tag['style'];                //样式名
        $click      = $tag['click'];                //点击
        $type       = $tag['type'];                //点击
        if(empty($type)) {
            $type = 'button';
        }
       	$parseStr   = '<span class="'.$style.'" ><input title="'.$alt.'" type="'.$type.'" id="'.$id.'"  name="'.$name.'" onmouseover="this.style.filter=\'alpha(opacity=100)\'" onmouseout="this.style.filter=\'alpha(opacity=80)\'" onclick="'.$click.'" align="absmiddle" class="'.$name.' imgLink"></span>';

        return $parseStr;
    }

    /**
     * select标签解析
     * 格式： <html:select options="name" selected="value" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _select($tag) {
		$parseStr = "";
		
        $name       = isset($tag['name']) && !empty($tag['name']) ? $tag['name'] : '';
        $options    = isset($tag['options']) && !empty($tag['options']) ? $tag['options'] : '';
        $multiple   = isset($tag['multiple']) && !empty($tag['multiple']) ? $tag['multiple'] : '';
        $id         = isset($tag['id']) && !empty($tag['id']) ? $tag['id'] : '';
        $size       = isset($tag['size']) && !empty($tag['size']) ? $tag['size'] : '';
        $first      = isset($tag['first']) && !empty($tag['first']) ? $tag['first'] : '';
        $selected   = isset($tag['selected']) && !empty($tag['selected']) ? $tag['selected'] : '';
		$label     	= isset($tag['label']) && !empty($tag['label']) ? $tag['label'] : '';
		$disabled   = isset($tag['disabled']) && !empty($tag['disabled']) ? $tag['disabled'] : '';
		$class      = isset($tag['class']) && !empty($tag['class']) ? $tag['class'] : 'form-control';
		$extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
		$required   = isset($tag["required"]) && !empty($tag["required"]) ? $tag["required"] : '';
		
		if (!empty($label)) {
//			$parseStr .= '<label>'.$label.':</label>';
		}
		
		if (empty($id)) {
			$id = $name;
		}
		
		$parseStr .= '<div class="select-group" id="'.$id.'"';
		
		$parseStr .= $extend;
		
		if (!empty($disabled)) {
			$parseStr .= ' disabled="disabled" ';
		} else {
		}
		
		$parseStr .= '>';
		
		$parseStr .= '<div class="select select-close">';
		
		if (!empty($first)) {
			$parseStr .= '<span class="select-display">'.$first.'</span>';
		} else {
			$parseStr .= '<span class="select-display">请选择</span>';
			$parseStr .= '<input value="" name="'.$name.'" type="hidden"/>';
		}
		
		$parseStr .= '<div class="select-img float-right"><i class="caret-right-b"></i></div>';
		$parseStr .= '</div>';
		
		$parseStr .= '<div class="select-info display-none">';
		$parseStr .= '<ul>';
		
		if (!empty($options)) {
			$parseStr   .= '<li value="">请选择</li>';
			$parseStr   .= '<?php  foreach($'.$options.' as $key=>$val) { ?>';
            if (!empty($selected)) {
                $parseStr   .= '<?php if(!empty($'.$selected.') && ($'.$selected.' == $key)) { ?>';
               	if (!empty($disabled )) {
                	$parseStr   .= '<li selected="selected" value="<?php echo $key ?>"><?php echo $val ?></li>';
                } else {
                	$parseStr   .= '<li selected="selected" value="<?php echo $key ?>"><?php echo $val ?></li>';
                }
                $parseStr   .= '<?php } else { ?><li value="<?php echo $key ?>"><?php echo $val ?></li>';
                $parseStr   .= '<?php } ?>';
            } else {
                $parseStr   .= '<li value="<?php echo $key ?>"><?php echo $val ?></li>';
            }
            $parseStr   .= '<?php } ?>';
        }
		
		$parseStr .= '</ul>';
		$parseStr .= '</div>';
		$parseStr .= '</div>';
		
		if(!empty($required)){
			$parseStr .= '<font>&nbsp;&nbsp;*</font>';
		}
		
        return $parseStr;
    }

    /**
     * checkbox标签解析
     * 格式： <html:checkbox checkboxes="" checked="" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _checkbox($tag) {
    	$parseStr   = '';
    	
        $name       = isset($tag['name']) && !empty($tag['name']) ? $tag['name'] : '';
        $checkboxes = isset($tag['checkboxes']) && !empty($tag['checkboxes']) ? $tag['checkboxes'] : '';
        $checked    = isset($tag['checked']) && !empty($tag['checked']) ? $tag['checked'] : '&nbsp;';
        $label      = isset($tag["label"]) && !empty($tag["label"]) ? $tag["label"] : '';
        $disabled   = isset($tag["disabled"]) && !empty($tag["disabled"]) ? $tag["disabled"] : '';
        $extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
        $required   = isset($tag["required"]) && !empty($tag["required"]) ? $tag["required"] : '';
        $checkboxes = $this->tpl->get($checkboxes);
        $checked    = $this->tpl->get($checked) ? $this->tpl->get($checked) : $checked;
        
        if (!empty($label)) {
//        	$parseStr .= '<div class="infor-itemL">';
//        	$parseStr .= '<span>'.$label.':</span>';
//        	$parseStr .= '</div>';
//			$parseStr .= '<label>'.$label.':</label>';
        }
        
//        $parseStr .= '<div class="infor-itemR">';
		$parseStr .= '<div class="infor">';
		
        foreach($checkboxes as $key => $val) {
        	$parseStr .= '<div class="checkbox width22 float-left">';
        	$parseStr .= '<input type="checkbox" id="'.$name.'_id'.$key.'" name="'.$name.'[]" value="'.$key.'" class="regular-box display-none"';
            if (is_string($checked) && $checked == $key) {
                $parseStr .= ' checked="checked" ';
            } else if (is_array($checked) && in_array($key, $checked)) {
            	$parseStr .= ' checked="checked" ';
            }
            
            if (!empty($disabled)) {
            	$parseStr .= ' disabled="disabled" ';
            } else {
            }
            $parseStr .= $extend.' >';
            $parseStr .= '<label for="'.$name.'_id'.$key.'"></label>'.$val;
            $parseStr .= '</div>';
        }
        
        if (!empty($required)) {
        	$parseStr .= '<font>&nbsp;&nbsp;*</font>';
        }
        
        $parseStr .= '</div>';
        return $parseStr;
    }

    /**
     * radio标签解析
     * 格式： <html:radio radios="name" checked="value" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _radio($tag) {
    	$parseStr   = '';
    	
        $name       = isset($tag['name']) && !empty($tag['name']) ? $tag['name'] : '';
        $radios     = isset($tag['radios']) && !empty($tag['radios']) ? $tag['radios'] : '';
        $checked    = isset($tag['checked']) && !empty($tag['checked']) ? $tag['checked'] : '';
        $label      = isset($tag["label"]) && !empty($tag["label"]) ? $tag["label"] : '';
        $disabled   = isset($tag["disabled"]) && !empty($tag["disabled"]) ? $tag["disabled"] : '';
        $extend     = isset($tag["extend"]) && !empty($tag["extend"]) ? $tag["extend"] : '';
        $simple     = isset($tag["simple"]) && !empty($tag["simple"]) ? $tag["simple"] : '';
        $radios     = $this->tpl->get($radios);
        $checked    = $this->tpl->get($checked);
//        if (!empty($simple)) {
//        	$simple = strtolower($simple);
//        }
       
//        if (!empty($label) && $simple !== 'true') {
//  //      	$parseStr .= '<label>'.$label.':</label>';
//        }
        foreach ($radios as $key => $val) {
//        	if ($simple !== 'true') {
//        		$parseStr .= '<label class="checkbox-inline">';
//        	}
        	
        	$parseStr .= '<input type="radio" id="'.$name.'_id'.$key.'" name="'.$name.'[]" value="'.$key.'" class="regular-radio display-none" ';
            if ($checked == $key) {
                $parseStr .= ' checked="checked" ';
            }
            if (!empty($disabled)) {
            	$parseStr .= ' disabled="disabled" ';
            } else {
            }
            $parseStr .= $extend.' >';
            
            $parseStr .= '&nbsp;<label for="'.$name.'_id'.$key.'"></label>'.$val;
            $parseStr .= "&nbsp;&nbsp;";
//            if ($simple !== 'true') {
//            	$parseStr .= '</label>';
//            }
        }
        
        return $parseStr;
    }

    /**
     * list标签解析
     * 格式： <html:grid datasource="" show="vo" />
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function _grid($tag) {
        $id         = $tag['id'];                       //表格ID
        $datasource = $tag['datasource'];               //列表显示的数据源VoList名称
        $pk         = empty($tag['pk'])?'id':$tag['pk'];//主键名，默认为id
        $style      = $tag['style'];                    //样式名
        $name       = !empty($tag['name'])?$tag['name']:'vo';                 //Vo对象名
        $action     = !empty($tag['action'])?$tag['action']:false;                   //是否显示功能操作
        $key         =  !empty($tag['key'])?true:false;
        if(isset($tag['actionlist'])) {
            $actionlist = explode(',',trim($tag['actionlist']));    //指定功能列表
        }

        if(substr($tag['show'],0,1)=='$') {
            $show   = $this->tpl->get(substr($tag['show'],1));
        }else {
            $show   = $tag['show'];
        }
        $show       = explode(',',$show);                //列表显示字段列表

        //计算表格的列数
        $colNum     = count($show);
        if(!empty($action))     $colNum++;
        if(!empty($key))  $colNum++;

        //显示开始
		$parseStr	= "<!-- Think 系统列表组件开始 -->\n";
        $parseStr  .= '<table id="'.$id.'" class="'.$style.'" cellpadding=0 cellspacing=0 >';
        $parseStr  .= '<tr><td height="5" colspan="'.$colNum.'" class="topTd" ></td></tr>';
        $parseStr  .= '<tr class="row" >';
        //列表需要显示的字段
        $fields = array();
        foreach($show as $val) {
        	$fields[] = explode(':',$val);
        }

        if(!empty($key)) {
            $parseStr .= '<th width="12">No</th>';
        }
        foreach($fields as $field) {//显示指定的字段
            $property = explode('|',$field[0]);
            $showname = explode('|',$field[1]);
            if(isset($showname[1])) {
                $parseStr .= '<th width="'.$showname[1].'">';
            }else {
                $parseStr .= '<th>';
            }
            $parseStr .= $showname[0].'</th>';
        }
        if(!empty($action)) {//如果指定显示操作功能列
            $parseStr .= '<th >操作</th>';
        }
        $parseStr .= '</tr>';
        $parseStr .= '<volist name="'.$datasource.'" id="'.$name.'" ><tr class="row" >';	//支持鼠标移动单元行颜色变化 具体方法在js中定义

        if(!empty($key)) {
            $parseStr .= '<td>{$i}</td>';
        }
        foreach($fields as $field) {
            //显示定义的列表字段
            $parseStr   .=  '<td>';
            if(!empty($field[2])) {
                // 支持列表字段链接功能 具体方法由JS函数实现
                $href = explode('|',$field[2]);
                if(count($href)>1) {
                    //指定链接传的字段值
                    // 支持多个字段传递
                    $array = explode('^',$href[1]);
                    if(count($array)>1) {
                        foreach ($array as $a){
                            $temp[] =  '\'{$'.$name.'.'.$a.'|addslashes}\'';
                        }
                        $parseStr .= '<a href="javascript:'.$href[0].'('.implode(',',$temp).')">';
                    }else{
                        $parseStr .= '<a href="javascript:'.$href[0].'(\'{$'.$name.'.'.$href[1].'|addslashes}\')">';
                    }
                }else {
                    //如果没有指定默认传编号值
                    $parseStr .= '<a href="javascript:'.$field[2].'(\'{$'.$name.'.'.$pk.'|addslashes}\')">';
                }
            }
            if(strpos($field[0],'^')) {
                $property = explode('^',$field[0]);
                foreach ($property as $p){
                    $unit = explode('|',$p);
                    if(count($unit)>1) {
                        $parseStr .= '{$'.$name.'.'.$unit[0].'|'.$unit[1].'} ';
                    }else {
                        $parseStr .= '{$'.$name.'.'.$p.'} ';
                    }
                }
            }else{
                $property = explode('|',$field[0]);
                if(count($property)>1) {
                    $parseStr .= '{$'.$name.'.'.$property[0].'|'.$property[1].'}';
                }else {
                    $parseStr .= '{$'.$name.'.'.$field[0].'}';
                }
            }
            if(!empty($field[2])) {
                $parseStr .= '</a>';
            }
            $parseStr .= '</td>';

        }
        if(!empty($action)) {//显示功能操作
            if(!empty($actionlist[0])) {//显示指定的功能项
                $parseStr .= '<td>';
                foreach($actionlist as $val) {
					if(strpos($val,':')) {
						$a = explode(':',$val);
						if(count($a)>2) {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\')">'.$a[1].'</a>&nbsp;';
						}else {
							$parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$pk.'}\')">'.$a[1].'</a>&nbsp;';
						}
					}else{
						$array	=	explode('|',$val);
						if(count($array)>2) {
							$parseStr	.= ' <a href="javascript:'.$array[1].'(\'{$'.$name.'.'.$array[0].'}\')">'.$array[2].'</a>&nbsp;';
						}else{
							$parseStr .= ' {$'.$name.'.'.$val.'}&nbsp;';
						}
					}
                }
                $parseStr .= '</td>';
            }
        }
        $parseStr	.= '</tr></volist><tr><td height="5" colspan="'.$colNum.'" class="bottomTd"></td></tr></table>';
        $parseStr	.= "\n<!-- Think 系统列表组件结束 -->\n";
        return $parseStr;
    }

    /**
     * list标签解析
     * 格式： <html:list datasource="" show="" />
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function _list($tag) {
        $id         = $tag['id'];                       //表格ID
        $datasource = $tag['datasource'];               //列表显示的数据源VoList名称
        $pk         = empty($tag['pk'])?'id':$tag['pk'];//主键名，默认为id
        $style      = $tag['style'];                    //样式名
        $name       = !empty($tag['name'])?$tag['name']:'vo';                 //Vo对象名
        $action     = $tag['action']=='true'?true:false;                   //是否显示功能操作
        $key         =  !empty($tag['key'])?true:false;
        $sort      = $tag['sort']=='false'?false:true;
        $checkbox   = $tag['checkbox'];                 //是否显示Checkbox
        if(isset($tag['actionlist'])) {
            if(substr($tag['actionlist'],0,1)=='$') {
                $actionlist   = $this->tpl->get(substr($tag['actionlist'],1));
            }else {
                $actionlist   = $tag['actionlist'];
            }
            $actionlist = explode(',',trim($actionlist));    //指定功能列表
        }

        if(substr($tag['show'],0,1)=='$') {
            $show   = $this->tpl->get(substr($tag['show'],1));
        }else {
            $show   = $tag['show'];
        }
        $show       = explode(',',$show);                //列表显示字段列表

        //计算表格的列数
        $colNum     = count($show);
        if(!empty($checkbox))   $colNum++;
        if(!empty($action))     $colNum++;
        if(!empty($key))  $colNum++;

        //显示开始
		$parseStr	= "<!-- Think 系统列表组件开始 -->\n";
        $parseStr  .= '<table id="'.$id.'" class="'.$style.'" cellpadding=0 cellspacing=0 >';
        $parseStr  .= '<tr><td height="5" colspan="'.$colNum.'" class="topTd" ></td></tr>';
        $parseStr  .= '<tr class="row" >';
        //列表需要显示的字段
        $fields = array();
        foreach($show as $val) {
        	$fields[] = explode(':',$val);
        }
        if(!empty($checkbox) && 'true'==strtolower($checkbox)) {//如果指定需要显示checkbox列
            $parseStr .='<th width="8"><input type="checkbox" id="check" onclick="CheckAll(\''.$id.'\')"></th>';
        }
        if(!empty($key)) {
            $parseStr .= '<th width="12">No</th>';
        }
        foreach($fields as $field) {//显示指定的字段
            $property = explode('|',$field[0]);
            $showname = explode('|',$field[1]);
            if(isset($showname[1])) {
                $parseStr .= '<th width="'.$showname[1].'">';
            }else {
                $parseStr .= '<th>';
            }
            $showname[2] = isset($showname[2])?$showname[2]:$showname[0];
            if($sort) {
                $parseStr .= '<a href="javascript:sortBy(\''.$property[0].'\',\'{$sort}\',\''.ACTION_NAME.'\')" title="按照'.$showname[2].'{$sortType} ">'.$showname[0].'<eq name="order" value="'.$property[0].'" ><img src="__PUBLIC__/images/{$sortImg}.gif" width="12" height="17" border="0" align="absmiddle"></eq></a></th>';
            }else{
                $parseStr .= $showname[0].'</th>';
            }

        }
        if(!empty($action)) {//如果指定显示操作功能列
            $parseStr .= '<th >操作</th>';
        }

        $parseStr .= '</tr>';
        $parseStr .= '<volist name="'.$datasource.'" id="'.$name.'" ><tr class="row" ';	//支持鼠标移动单元行颜色变化 具体方法在js中定义
        if(!empty($checkbox)) {
        //    $parseStr .= 'onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ';
        }
        $parseStr .= '>';
        if(!empty($checkbox)) {//如果需要显示checkbox 则在每行开头显示checkbox
            $parseStr .= '<td><input type="checkbox" name="key"	value="{$'.$name.'.'.$pk.'}"></td>';
        }
        if(!empty($key)) {
            $parseStr .= '<td>{$i}</td>';
        }
        foreach($fields as $field) {
            //显示定义的列表字段
            $parseStr   .=  '<td>';
            if(!empty($field[2])) {
                // 支持列表字段链接功能 具体方法由JS函数实现
                $href = explode('|',$field[2]);
                if(count($href)>1) {
                    //指定链接传的字段值
                    // 支持多个字段传递
                    $array = explode('^',$href[1]);
                    if(count($array)>1) {
                        foreach ($array as $a){
                            $temp[] =  '\'{$'.$name.'.'.$a.'|addslashes}\'';
                        }
                        $parseStr .= '<a href="javascript:'.$href[0].'('.implode(',',$temp).')">';
                    }else{
                        $parseStr .= '<a href="javascript:'.$href[0].'(\'{$'.$name.'.'.$href[1].'|addslashes}\')">';
                    }
                }else {
                    //如果没有指定默认传编号值
                    $parseStr .= '<a href="javascript:'.$field[2].'(\'{$'.$name.'.'.$pk.'|addslashes}\')">';
                }
            }
            if(strpos($field[0],'^')) {
                $property = explode('^',$field[0]);
                foreach ($property as $p){
                    $unit = explode('|',$p);
                    if(count($unit)>1) {
                        $parseStr .= '{$'.$name.'.'.$unit[0].'|'.$unit[1].'} ';
                    }else {
                        $parseStr .= '{$'.$name.'.'.$p.'} ';
                    }
                }
            }else{
                $property = explode('|',$field[0]);
                if(count($property)>1) {
                    $parseStr .= '{$'.$name.'.'.$property[0].'|'.$property[1].'}';
                }else {
                    $parseStr .= '{$'.$name.'.'.$field[0].'}';
                }
            }
            if(!empty($field[2])) {
                $parseStr .= '</a>';
            }
            $parseStr .= '</td>';

        }
        if(!empty($action)) {//显示功能操作
            if(!empty($actionlist[0])) {//显示指定的功能项
                $parseStr .= '<td>';
                foreach($actionlist as $val) {
                    if(strpos($val,':')) {
                        $a = explode(':',$val);
                        if(count($a)>2) {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\')">'.$a[1].'</a>&nbsp;';
                        }else {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$pk.'}\')">'.$a[1].'</a>&nbsp;';
                        }
                    }else{
                        $array	=	explode('|',$val);
                        if(count($array)>2) {
                            $parseStr	.= ' <a href="javascript:'.$array[1].'(\'{$'.$name.'.'.$array[0].'}\')">'.$array[2].'</a>&nbsp;';
                        }else{
                            $parseStr .= ' {$'.$name.'.'.$val.'}&nbsp;';
                        }
                    }
                }
                $parseStr .= '</td>';
            }
        }
        $parseStr	.= '</tr></volist><tr><td height="5" colspan="'.$colNum.'" class="bottomTd"></td></tr></table>';
        $parseStr	.= "\n<!-- Think 系统列表组件结束 -->\n";
        return $parseStr;
    }
}