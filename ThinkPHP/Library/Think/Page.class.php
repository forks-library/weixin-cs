<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Think;

class Page{
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $parameter; // 分页跳转时要带的参数
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $rollPage   = 5;// 分页栏每页显示的页数
	public $lastSuffix = true; // 最后一页是否显示总页数

    private $p           = 'p'; //分页参数名
    private $url         = ''; //当前链接URL
    private $nowPage     = 1;
    private $m           = 'm';
    private $method      = "";
    private $f           = "f";
    private $controlForm = "";
    private $s           = "s";
    private $succCall    = "";

	// 分页显示定制
    private $config  = array(
        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    );

    /**
     * 架构函数
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows, $listRows=20, $parameter = array()) {
        C('VAR_PAGE') && $this->p = C('VAR_PAGE'); //设置分页参数名称
        /* 基础设置 */
        $this->totalRows   = $totalRows; //设置总记录数
        $this->listRows    = $listRows;  //设置每页显示行数
        $this->parameter   = empty($parameter) ? $_GET : $parameter;
        $this->nowPage     = empty($this->parameter[$this->p]) ? 1 : intval($this->parameter[$this->p]);
//        \Think\Log::write("xx is ".ceil($this->totalRows / $this->listRows));
        $this->nowPage     = $this->nowPage > 0 && $this->totalRows > 0 ? (ceil($this->totalRows / $this->listRows) < $this->nowPage ? ceil($this->totalRows / $this->listRows) : $this->nowPage) : 1;
        $this->firstRow    = $this->listRows * ($this->nowPage - 1);
        $this->method      = empty($this->parameter[$this->m]) ? '' : $this->parameter[$this->m];
        $this->controlForm = empty($this->parameter[$this->f]) ? 'search_form' : $this->parameter[$this->f];
        $this->succCall    = empty($this->parameter[$this->s]) ? "''" : $this->parameter[$this->s];
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    private function url($page){
        return str_replace(urlencode('[PAGE]'), $page, $this->url);
    }

    /**
     * 组装分页链接
     * @return string
     */
    public function show() {
        if (0 == intval($this->totalRows)) return '';
        if (intval($this->totalRows) <= intval($this->listRows)) return '';
		// 图片资源目录
    	$publicRoot = defined('SERVER_RESOURCE') ? SERVER_RESOURCE.'/Public' : __ROOT__.'/Public';
    	
        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
        $this->url = U(ACTION_NAME, $this->parameter);
        /* 计算分页信息 */
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }

        /* 计算分页临时变量 */
        $now_cool_page      = $this->rollPage/2;
		$now_cool_page_ceil = ceil($now_cool_page);
		$this->lastSuffix && $this->config['last'] = $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
		if ($up_row > 0) {
			$up_page = '<li><a href="javascript: l.btnPageClick(\''.$up_row.'\', \''.$this->method.'\')" aria-label="Previous" title="上一页"><img class="img-b" src="'.$publicRoot.'/Images/back.png"/></a></li>';
		} else {
			$up_page = '<li class="disabled"><a href="#" aria-label="Previous" title="上一页"><img class="img-b" src="'.$publicRoot.'/Images/back.png"/></a></li>';
		}

        //下一页
        $down_row  = $this->nowPage + 1;
		if ($down_row <= $this->totalPages) {
			$down_page = '<li><a href="javascript: l.btnPageClick(\''.$down_row.'\', \''.$this->method.'\')" aria-label="Previous" title="下一页"><img class="img-b" src="'.$publicRoot.'/Images/go.png"/></a></li>';
		} else {
			$down_page = '<li class="disabled"><a href="#" aria-label="Next" title="下一页"><img class="img-b" src="'.$publicRoot.'/Images/go.png"/></a></li>';
		}

        //第一页
        $the_first = '';
        if ($this->totalPages >= 1) {
        	if ($up_row > 0) {
        		$the_first = '<li><a href="javascript: l.btnPageClick(\'1\', \''.$this->method.'\')" title="首页"><img class="img-b" src="'.$publicRoot.'/Images/previous.png"/></a></li>';
        	} else {
        		$the_first = '<li><a href="#" title="首页"><img class="img-b" src="'.$publicRoot.'/Images/previous.png"/></a></li>';
        	}
        }

        //最后一页
        $the_end = '';
        if ($this->totalPages >= 1) {
        	if($down_row <= $this->totalPages){
        		$the_end = '<li><a href="javascript: l.btnPageClick(\''.$this->totalPages.'\', \''.$this->method.'\')" title="尾页" ><img class="img-b" src="'.$publicRoot.'/Images/next.png"/></a></li>';
        	} else {
        		$the_end = '<li><a href="#" title="尾页"><img class="img-b" src="'.$publicRoot.'/Images/next.png"/></a></li>';
        	}
        }

        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
			if(($this->nowPage - $now_cool_page) <= 0 ){
				$page = $i;
			}elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
				$page = $this->totalPages - $this->rollPage + $i;
			}else{
				$page = $this->nowPage - $now_cool_page_ceil + $i;
			}
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                	$link_page .= '<li><a href="javascript: l.btnPageClick(\''.$page.'\', \''.$this->method.'\')" title="第'.$page.'页">'.$page.'</a></li>';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
					$link_page .= '<li class="active"><a class="page-active" href="#"  title="第'.$page.'页"><span>' . $page . '</span></a></li>';
                }
            }
        }

        //替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
            $this->config['theme']);
        return "<ul class='pagination'>{$page_str}</ul>";
    }
    
    
        /**
     * 组装前端分页链接
     * @return string
     */
    public function showL() {
        if(0 == $this->totalRows) return '';

        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
        $this->url = U(ACTION_NAME, $this->parameter);
        /* 计算分页信息 */
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }

        /* 计算分页临时变量 */
        $now_cool_page      = $this->rollPage/2;
		$now_cool_page_ceil = ceil($now_cool_page);
		$this->lastSuffix && $this->config['last'] = $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
        $up_page = $up_row > 0 ? '<li><a class="prev" href="' . $this->url($up_row) . '">' . '上一页' . '</a><li>' : '';

        //下一页
        $down_row  = $this->nowPage + 1;
        $down_page = ($down_row <= $this->totalPages) ? '<li><a class="next" href="' . $this->url($down_row) . '">' . '下一页' . '</a><li>' : '';

        //第一页
        $the_first = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
            //$the_first = '<li><a class="first" href="' . $this->url(1) . '">' . '首页' . '</a><li>';
        }

        //最后一页
        $the_end = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages){
            //$the_end = '<li><a class="end" href="' . $this->url($this->totalPages) . '">' . '最后一页' . '</a><li>';
        }

        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
			if(($this->nowPage - $now_cool_page) <= 0 ){
				$page = $i;
			}elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
				$page = $this->totalPages - $this->rollPage + $i;
			}else{
				$page = $this->nowPage - $now_cool_page_ceil + $i;
			}
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                    $link_page .= '<li><a class="num" href="' . $this->url($page) . '">' . $page . '</a><li>';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
                    $link_page .= '<li><span style="display:block; background:#ff861b; color:#fff;">' . $page . '</span><li>';
                }
            }
        }

        //替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
            $this->config['theme']);
        return "<div class='resultPage'><ul class='pagination'>{$page_str}<ul></div>";
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
