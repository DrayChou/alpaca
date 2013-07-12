<?php

class page extends base
{

    function __construct()
    {
        parent::__construct();
        $this->m = load('m/elem_m');
    }

    function view($url = 'home', $action = 'view')
    {
        global $rel_id, $pid;
        cache_start(alpa('cache_time'));
        $page = $this->m->gname($url, true);
        if (!is_array($page))
            show_404();

        $pid = $page['id'];
        $rel_id = $page['rel_id'];
        if ($rel_id)
            $page['parent'] = $this->m->get($rel_id);

        if ($action == 'add') {
            $this->add($pid);
            return;
        }
        $info = _decode($page['elem_info']);
        $meta = array(
            'page_title' => isset($info['page_title']) && $info['page_title'] != '' ? $info['page_title'] : $page['title'],
            'meta_keywords' => isset($info['meta_keywords']) && $info['meta_keywords'] != '' ? $info['meta_keywords'] : $page['title'],
            'meta_description' => isset($info['meta_description']) && $info['meta_description'] != '' ? $info['meta_description'] : $page['title']
        );
        $param = array_merge($page, $info, $meta);

        // children pages 
        if (isset($info['page_size']) && $info['page_size'] > 0) {

            $pids[] = $pid;
            $mods[] = '\'page\'';
            $tree = alpa('tree');
            $dir = alpa('dir');
            if (isset($info['grandchild']) && $info['grandchild'] > 0 && isset($tree[$pid])) {
                $pids = child_dir($pid);
            }

            if (isset($info['child_dir']) && $info['child_dir'] > 0)
                $mods[] = '\'dir\'';

            $where = ' and rel_id in (' . implode(',', $pids) . ') 
                 and `mod` in (' . implode(',', $mods) . ') 
                 order by `mod`, order_by desc, post_time desc';

            $tot = $this->m->count($where);
            $psize = isset($info['page_size']) ? $info['page_size'] : 30; //默认每页显示 30 条子页面 
            $p = isset($_GET['p']) ? $_GET['p'] : 0;
            $param['pagination'] = pagination($tot, $p, $psize, '/page/' . $url . '/?p=');

            $list = $this->m->get($where, $p, $psize);
            $al_list = array();
            foreach ($list as $l) {
                /*
                  $dirid = $l['rel_id'];
                  if( $dirid  ){
                  $l['dir_title'] = $dir[$dirid]['title'];
                  $l['dir_name'] = BASE.'page/'.$dir[$dirid]['name'].'/';
                  }
                 */
                $l['page'] = BASE . 'page/' . $l['elem_name'] . '/';
                $al_list[] = array_merge($l, _decode($l['elem_info']));
            }

            $param['pages'] = $al_list;
        }

        //载入模板
        $layout = isset($info['layout']) && is_file(APP . 'tmp/' . $info['layout'] . '.php') ? 'tmp/' . $info['layout'] : 'tmp/layout';
        $template = isset($info['template']) && is_file(APP . 'tmp/' . $info['template'] . '.php') ? 'tmp/' . $info['template'] : 'tmp/template';

        $layout = sae_file('tmp/' . $info['layout'] . '.php') ? ('tmp/' . $info['layout'] . '.php') : $layout;
        $template = sae_file('tmp/' . $info['template'] . '.php') ? ('tmp/' . $info['template'] . '.php') : $template;

        $param['al_content'] = view($layout, $param, TRUE);
        header("Content-type: text/html; charset=utf-8");
        view($template, $param);
        if (is_numeric(alpa('cache_time')) && alpa('cache_time') > 0)
            cache_end();
    }

    function tag($url = 'home')
    {
        global $rel_id, $pid;
        cache_start(alpa('cache_time'));
        $dir = alpa('dir');
        $eurl = urlencode($url);
        $where = " and `mod`='tag' and elem_name='" . $eurl . "'";
        $tot = $this->m->count($where);
        $psize = isset($info['page_size']) ? $info['page_size'] : 30; //默认每页显示 30 条子页面 
        $p = isset($_GET['p']) ? $_GET['p'] : 0;
        $param['pagination'] = pagination($tot, $p, $psize, '/page/' . $eurl . '/?p=');
        $where = " and id in ( select rel_id from elem where `mod`='tag' and elem_name='$eurl' )";
        $list = $this->m->get($where, $p, $psize);
        $al_list = array();
        foreach ($list as $l) {
            $l['page'] = BASE . 'page/' . $l['elem_name'] . '/';
            $dirid = $l['rel_id'];
            if ($dirid) {
                $l['dir_title'] = $dir[$dirid]['title'];
                $l['dir_name'] = BASE . 'page/' . $dir[$dirid]['name'] . '/';
            }
            $al_list[] = array_merge($l, _decode($l['elem_info']));
        }

        $param['pages'] = $al_list;

        //载入模板
        $layout = 'tmp/tag';
        $template = 'tmp/template';
        //.alpa('default_template');

        $param['al_content'] = view($layout, $param, TRUE);
        header("Content-type: text/html; charset=utf-8");
        view($template, $param);
        if (is_numeric(alpa('cache_time')) && alpa('cache_time') > 0)
            cache_end();
    }

    /* extends functions  */

    function add($rel_id = 0)
    {
        if (!$rel_id)
            redirect('/', '对不起，您没有权限');
        $parent = $this->m->get($rel_id);
        $info = _decode($parent['elem_info']);
        if ($this->u['level'] < $info['user_add'])
            redirect('/', '对不起，您没有权限');

        $conf = array('title' => 'required');
        $err = validate($conf);
        if ($err === TRUE) {
            $_POST['rel_id'] = $rel_id;
            $_POST['post_time'] = $_POST['update_time'] = time();
            $_POST['user_id'] = $this->u['id'];
            $_POST['user_name'] = $this->u['name'];
            $id = $this->m->add();
            $_POST['info']['template'] = $info['child_template'];
            $_POST['info']['layout'] = $info['child_layout'];
            $_POST['info']['model'] = $info['child_model'];
            $this->m->updateinfo($id, $_POST['info']);
            redirect(BASE . 'page/' . $rel_id . '/', '发布成功！');
        } else {
            $model = $this->m->get($info['child_model']);
            $param['cur_mod'] = _decode($model['elem_info']);
            $param['val'] = $_POST;
            $param['err'] = $err;
            $param['page_title'] = "添加页面";
            $this->display('v/elem/post', $param);
        }
    }

}

?>