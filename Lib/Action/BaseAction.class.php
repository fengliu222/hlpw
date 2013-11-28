<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

/**
 +----------------------------------------------------------
 * 项目基类
 +----------------------------------------------------------
 */
class BaseAction extends Action {

    /**
     +----------------------------------------------------------
     * 项目初始化
     +----------------------------------------------------------
     */
    function _initialize()
    {
        // 获取导航列表
        $list   =  include DATA_PATH.'~menu.php';
        /*
        $Menu   =  M('Menu');
        $list   =  $Menu->field('name,link,title,target')->where('status=1 and level=1')->order('sort asc')->select();
        */
        $this->assign('navigation',$list);
    }

    // 404 错误定向
    protected function _404($message='',$jumpUrl='',$waitSecond=3) {
        $this->assign('message','访问的页面不存在！');
        if(!empty($jumpUrl)) {
            $this->assign('jumpUrl',$jumpUrl);
            $this->assign('waitSecond',$waitSecond);
        }
        $this->display(C('TMPL_ACTION_ERROR'));
    }

    /**
     +----------------------------------------------------------
     * 获取导航菜单
     +----------------------------------------------------------
     */
    private function get_navigation()
    {
        // 菜单定义
        return array (
            'Index'     => '首页',
            'Intro'     => '框架介绍',
            'Down'      => '下载',
            'Addons'    => '扩展',
            'Manual'    => '文档',
            'Case'      => '案例',
            'Blog'      => '博客',
            'Bbs'       => '论坛',
            'Change'    => '更新日志',
        );
    }

    // 查看某个模块的标签相关的记录
    public function tag()
    {
        $Tag = M("Tag");
        $tag=trim($_GET['tag']);
        $map['module']   =  $this->getActionName();
        $map['name'] =  $tag;
        $Stat  = $Tag->where($map)->field("id,count")->find();
        $tagId  =  $Stat['id'];
        $Tagged = M("Tagged");
        $map = array();
        $map['module']   =  $this->getActionName();
        $map['tag_id'] =  $tagId;
        $recordIds  =  $Tagged->where($map)->getField('id,record_id');
        if($recordIds) {
            $map = array();
            $map['id']   = array('IN',$recordIds);
            $map['status'] = 1;
            $model = M($this->getActionName());
            $list   =  $model->where($map)->select();
            $this->assign('list',$list);
        }
        $this->assign('tag',$tag);
        $this->assign('title',$tag);
        $this->display('tag');
    }

    public function download()
    {
        $id         =   intval($_GET['id']);
        $Attach        =   M("Attach");
        if($Attach->getById($id)) {
            $filename   =   $Attach->savepath.$Attach->savename;
            if(is_file($filename)) {
                $showname = auto_charset($Attach->name,'utf-8','gbk');
                if(!isset($_SESSION['download_'.$id])) {
                    $data['download_count'] = array('exp','download_count+1');
                    $data['id']   = $id;
       				$Attach->data($data)->save();
                    $_SESSION['download_'.$id]   =  true;
                }
		        import("ORG.Net.Http");
                Http::download($filename,$showname);
            }else{
                $this->error('附件不存在或者已经删除！');
            }
        }else{
            $this->error('附件不存在或者已经删除！');
        }
    }

	protected function getAttach($id,$module='') {
        //读取附件信息
        $module = empty($module)?$this->getActionName():$module;
        $Attach = M('Attach');
        $attachs = $Attach->where("status=1 and module='".$module."' and record_id=$id")->order('id desc')->select();
		//模板变量赋值
		$this->assign("attachs",$attachs);
	}


    /**
     +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    protected function _list($model='',$map='',$sortBy='',$asc=false)
    {
        $model        = empty($model)?$this->getActionName():$model;
        $model  =  M($model);
        //排序字段 默认为主键名
        if(isset($_REQUEST['_order'])) {
            $order = $_REQUEST['_order'];
        }else {
            $order = !empty($sortBy)? $sortBy: $model->getPk();
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if(isset($_REQUEST['_sort'])) {
            $sort = $_REQUEST['_sort']?'asc':'desc';
        }else {
            $sort = $asc?'asc':'desc';
        }
        //取得满足条件的记录数
        $count      = $model->where($map)->count('id');
		if($count>0) {
            //分页显示
            import("ORG.Util.Page");
            $p    = new Page($count,20);
            $page       = $p->show();
            $list   =  $model->order($order.' '.$sort)->where($map)->page(empty($_GET['p'])?1:$_GET['p'].',20')->select();
            $this->assign('page',$page);
            $this->assign('list',$list);
		}
        Cookie::set('_currentUrl_',__SELF__);
        return ;
    }

    public function _empty($method) {
        $this->assign('message','非法操作！');
        $this->display(C('TMPL_ACTION_ERROR'));
    }
// Base end
}
?>