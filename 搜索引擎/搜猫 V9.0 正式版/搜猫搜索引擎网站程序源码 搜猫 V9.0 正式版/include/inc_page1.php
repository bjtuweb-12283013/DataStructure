<?php
/**
*
* 此分页函数,是从我一个项目上拿下来改写的,原先只是一个函数,现写成一个类,贡献给大家
* 效果是百度分页那样的,不涉及数据库操作,
* 实际上,分页的确是和数据库操作分开的
* 使用方法
* $total = 50;
* $page = new Page($total);
* echo $page->show();
*
*/
class Page {
    public $total;  //总页数,在这里,你需要把总页数算出来
    public $pn;         //当前页数
    public $start;     //排序起始页
    public $end;       //排序终止页
    public $url;      //当前的url,例如 index.php?p=
    public $display;  //左边显示的页数,例如是5,就是说左边有5页,总共是10页
    public function __construct($total, $url = '?pn=', $display = '5') {
        $this->total = $total;
        $this->url = $url;
        $this->display = $display;
        $this->init();
        $this->order();
    }

/**
  *初始化,包括简单的安全处理,当然,你可以扩展这个函数以达到你的要求
  */
    public function init() {
        //获取当前的页数
        $this->pn = (@$_GET ['pn'] + 0 <= 0)? 1: (@$_GET ['pn'] + 0);
        if (!is_int($this->pn)) {
            $this->pn = 1;
        }
        //如果有人在页面上输入一个较大的数,我是这样处理的,显示最后一页
        //你可以自己扩展为"当前没有你找到的页",把下面的去掉,在show函数里加个判断就行了
        if ($this->pn >= $this->total) {
            $this->pn= $this->total;
        }
    } 
    /**
     *这里将是怎么显示为百度分页的那种效果,当然,已经够用了
     *还有局部没有处理好,如果处理好麻烦告诉我
     */
     public function order() {
        if ($this->total <= 2 * $this->display) {
            $this->start = 1;
            $this->end = $this->total;
        } else {
            if ($this->pn <= $this->display) {
                $this->start = 1;
                $this->end = 2 * $this->display;
            } else {
                if ($this->pn > $this->display && ($this->total - $this->pn >= $this->display - 1)) {
                    $this->start = $this->pn - $this->display;
                    $this->end = $this->pn + $this->display - 1;
                } else {
                    $this->start = $this->total - 2 * $this->display + 1;
                    $this->end = $this->total;
                }
            }
        }
    }
    public function show() {
        //如果没有数据,当然也就没有分页了
        if ($this->total <= 1) {
            return false;
			//exit;
        }
        else
		     {
               $re = '';  
               // $pre前一页 $next 后一页
               // $re .= "<a href=\"{$this->url}1\">首页</a>";
               $pre = ($this->pn - 1 <= 0) ? 1 : ($this->pn - 1);
               $re .= "";
               //如果当前页是第一页,不要首页和前一页
               if ($this->pn == 1) {
                   $re = '';
               }
               for ($i = $this->start; $i <= $this->end; $i++) {
                   $re .= ($i == $this->pn)? "$i ": "";
               }
  
               $next = ($this->pn + 1 >= $this->total) ? $this->total : ($this->pn + 1);
               //当前页是最后一页的页数,不要下一页和最后一页
               if ($this->pn != $this->total) {
                   $re .= "";
                  // $re .= "<a href=\"{$this->url}$this->total\">最后一页</a>";
               }   
                return $re;
		   }
    }
}
?>