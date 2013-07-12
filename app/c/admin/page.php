<?php

class page extends admin
{

    function __construct()
    {
        parent::__construct();
        $this->m = load('m/elem_m');
        $this->submenu = array('index' => '内容', 'link' => '菜单');
    }

    function index($rel_id = 0)
    {
        if (isset($_POST['order_by'])) {
            foreach ($_POST['order_by'] as $k => $v) {
                $this->m->update($k, array('order_by' => $v));
            }
        }
        $param['rel_id'] = $rel_id;
        $tot = $this->m->count(" and `mod` in ('page','dir') and rel_id = '$rel_id' ");
        $psize = 30;
        $pcurrent = isset($_GET['p']) ? $_GET['p'] : 0;
        $param['pagination'] = pagination($tot, $pcurrent, $psize, '/admin/page/index/' . $rel_id . '/?p=');
        $param['category'] = alpa('category');
        $param['records'] = $this->m->get(" and `mod` in ('page','dir')  and rel_id = '$rel_id' order by `mod`, order_by desc", $pcurrent, $psize);
        $param['submenu'] = $this->submenu;
        $this->display('v/admin/page/list-table', $param);
    }

    function add($rel_id = 0)
    {
        $conf = array('title' => 'required');
        $err = validate($conf);
        if ($err === TRUE) {
            if ($rel_id) {
                $this->m->updateinfo($rel_id, array('dir' => 1));
            }
            $_POST['rel_id'] = $rel_id;
            $_POST['post_time'] = $_POST['update_time'] = strtotime($_POST['post_time']);
            $_POST['mod'] = isset($_POST['info']['dir']) ? 'dir' : 'page';
            $_POST['elem_name'] = isset($_POST['elem_name']) && $_POST['elem_name'] != '' ? urlencode(trim($_POST['elem_name'])) : randstr(6);
            $id = $this->m->add();
            $this->m->updateinfo($id, $_POST['info']);
            /* run tag class */
            if ($_POST['tags']) {
                $this->tag($_POST['tags'], $id);
            }

            if ($_POST['mod'] == 'dir')
                $this->cachedir();
            redirect(ADMIN_BASE . 'page/index/' . $rel_id . '/', '发布成功！');
        } else {
            $val = array();
            if ($rel_id) {
                $parent = $this->m->get($rel_id);
                $pinfo = _decode($parent['elem_info']);
                $_POST['info'] = array(
                    'template' => $pinfo['child_template'],
                    'layout' => $pinfo['child_layout'],
                    'model' => $pinfo['child_model']
                );
            }

            $model = $this->m->get(" and `mod`='model'", 0, 20);
            $nmodel = array();
            foreach ($model as $md) {
                $mid = $md['id'];
                $nmodel[$mid] = $md;
            }
            $param['model'] = $nmodel;

            $modid = 1;
            if (isset($pinfo['child_model']) && is_numeric($pinfo['child_model']))
                $modid = $pinfo['child_model'];
            if (isset($_GET['model']) && is_numeric($_GET['model']))
                $modid = $_GET['model'];
            $_POST['info']['model'] = $param['modid'] = $modid;

            if ($modid) {
                $param['cur_mod'] = _decode($nmodel[$modid]['elem_info']);
            }
            $param['val'] = $_POST;
            $param['val']['info']['child_dir'] = 1;
            $param['err'] = $err;
            $param['rel_id'] = $rel_id;
            $param['template'] = $this->m->get(" and `mod`='template'", 0, 20);
            $param['layout'] = $this->m->get(" and `mod`='layout'", 0, 20);
            $param['submenu'] = $this->submenu;
            $this->display('v/admin/page/add', $param);
        }
    }

    function edit($id)
    {
        $conf = array('title' => 'required');
        //,'mod'=>'required','rel_id'=>'required','elem_name'=>'required','elem_info'=>'required','elem_info'=>'required','post_time'=>'required','update_time'=>'required','user_id'=>'required','user_name'=>'required','order_by'=>'required',);
        $err = validate($conf);
        if ($err === TRUE) {
            $_POST['update_time'] = time();
            $_POST['post_time'] = strtotime($_POST['post_time']);
            $_POST['info']['dir'] = isset($_POST['info']['dir']) ? 1 : 0;
            $_POST['info']['child_page'] = isset($_POST['info']['child_page']) ? 1 : 0;
            $_POST['info']['child_dir'] = isset($_POST['info']['child_dir']) ? 1 : 0;
            $_POST['info']['grandchild'] = isset($_POST['info']['grandchild']) ? 1 : 0;
            $_POST['mod'] = $_POST['info']['dir'] ? 'dir' : 'page';
            $this->m->update($id);
            $this->m->updateinfo($id, $_POST['info']);
            /* run tag class */
            if ($_POST['tags']) {
                $this->tag($_POST['tags'], $id);
            }
            $p = $this->m->get($id);
            redirect(BASE . 'admin/page/index/' . $p['rel_id'] . '/', '修改成功！');
        } else {
            $val = $this->m->get($id);
            $val['info'] = $info = _decode($val['elem_info']);
            $model = $this->m->get(" and `mod`='model'", 0, 20);
            $nmodel = array();
            foreach ($model as $md) {
                $mid = $md['id'];
                $nmodel[$mid] = $md;
            }
            $param['model'] = $nmodel;

            $modid = 1;
            if (isset($pinfo['child_model']) && is_numeric($pinfo['child_model']))
                $modid = $pinfo['child_model'];
            if (isset($info['model']) && is_numeric($info['model']))
                $modid = $info['model'];
            if (isset($_GET['model']) && is_numeric($_GET['model']))
                $modid = $_GET['model'];
            $_POST['info']['model'] = $param['modid'] = $modid;

            if ($modid) {
                $param['cur_mod'] = _decode($nmodel[$modid]['elem_info']);
            }

            $param['val'] = array_merge($_POST, $val);
            $param['err'] = $err;
            $param['rel_id'] = $val['rel_id'];
            $param['template'] = $this->m->get(" and `mod`='template'", 0, 20);
            $param['layout'] = $this->m->get(" and `mod`='layout'", 0, 20);
            $param['submenu'] = $this->submenu;
            $this->display('v/admin/page/add', $param);
        }
    }

    function mdel()
    {
        $_POST['sid'][] = 0;
        $ids = implode(',', $_POST['sid']);
        $this->m->db->query("delete from elem where id in ($ids)");
        $this->cachedir();
        echo '1';
    }

    function move($rel_id = 0)
    {
        $_POST['sid'][] = 0;
        $ids = implode(',', $_POST['sid']);
        $this->m->db->query("update elem set rel_id = '$rel_id' where id in ($ids)");
        $this->cachedir();
        echo '1';
    }

    function cachedir()
    {
        $r = load('m/elem_m')->get(" and `mod` = 'dir'");
        foreach ($r as $e) {
            $id = $e['id'];
            $list[$id] = array(
                'id' => $id,
                'title' => $e['title'],
                'name' => $e['elem_name'],
                'rel_id' => $e['rel_id']
            );
        }

        if ($list) {
            foreach ($list as $k => $v) {
                $pt = $v['rel_id'];
                $list1 = @$tree[$pt] ? $tree[$pt] : array();
                array_push($list1, $v);
                $tree[$pt] = $list1;
            }
        }

        $menu = list2tree(0, $tree);
        $this->m->setting('category', $menu, 'cache');
        $this->m->setting('tree', $tree, 'cache');
        $this->m->setting('dir', $list, 'cache');
        redirect(BASE . 'admin/', '清空缓存成功');
    }

    /* 菜单链接 */

    function link($action = 'index', $id = 0)
    {
        switch ($action) {
            case 'add':
                $this->link_add();
                return;
            case 'edit':
                $this->link_edit($id);
                return;
        }
        $tot = $this->m->count(" and `mod`='link'   ");
        $psize = 30;
        $pcurrent = isset($_GET['p']) ? $_GET['p'] : 0;
        $param['pagination'] = pagination($tot, $pcurrent, $psize, ADMIN_BASE . 'page/link/?p=');
        $param['records'] = $this->m->get(" and `mod`='link' ", $pcurrent, $psize);
        $param['submenu'] = $this->submenu;
        $this->display('v/admin/link/list-table', $param);
    }

    function link_add()
    {
        $conf = array('elem_name' => 'required');
        $err = validate($conf);
        if ($err === TRUE) {
            $_POST['post_time'] = $_POST['update_time'] = time();
            $_POST['elem_info'] = _encode($this->arrange($_POST['info']));
            $this->m->add();
            redirect(BASE . 'admin/page/link/', '发布成功！');
        } else {
            $param['val'] = $_POST;
            $param['err'] = $err;
            $param['submenu'] = $this->submenu;
            $this->display('v/admin/link/add', $param);
        }
    }

    function link_edit($id)
    {
        $conf = array('elem_name' => 'required');
        $err = validate($conf);
        if (is_array($err)) {
            $param['val'] = $v = array_merge($_POST, $this->m->get($id));
            $param['links'] = _decode($v['elem_info']);
            $param['err'] = $err;
            $param['submenu'] = $this->submenu;
            $this->display('v/admin/link/add', $param);
            exit();
        }

        $_POST['update_time'] = time();
        $_POST['elem_info'] = _encode($this->arrange($_POST['info']));
        $this->m->update($id);
        redirect(BASE . 'admin/page/link/', '修改成功！');
    }

    function arrange($arr)
    {
        // clear empty fields
        $narr = array();
        foreach ($arr as $a) {
            if ($a['label'])
                $narr[] = $a;
        }
        $arr = $narr;
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {
            for ($j = $len - 1; $j >= $i; $j--) {
                if (!isset($arr[$j - 1]) || !isset($arr[$j]['order']))
                    continue;
                if ($arr[$j]['order'] < $arr[$j - 1]['order']) {
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$j - 1];
                    $arr[$j - 1] = $tmp;
                }
            }
        }
        return $arr;
    }

    function tag($val, $id)
    {

        $id = trim($id);
        $this->m->del_by_rel($id, 'tag');
        $val = str_replace('，', ',', $val);
        $strs = explode(',', $val);

        foreach ($strs as $val) {
            $val = trim($val);
            $pname = urlencode($val);
            $newtag = array(
                'title' => $val,
                'mod' => 'tag',
                'rel_id' => $id,
                'elem_name' => $pname
            );
            $this->m->add($newtag);
        }
    }

}

function admin_breadcrumb($id = 'current')
{
    global $pid;
    $c = '';
    if ($id == 'current')
        $id = $pid;
    if ($id == 0)
        return '<a href="' . BASE . 'admin/page/" >根目录</a> » ';
    $r = load('m/elem_m')->get($id);
    if ($id != $pid)
        $c = ' <a href="' . BASE . 'admin/page/index/' . $r['id'] . '/" >' . $r['title'] . '</a> » ';
    return admin_breadcrumb($r['rel_id']) . $c;
}

function list2tree($id, $tree, $prefix = '──')
{
    if (!isset($tree[$id]))
        return;
    foreach ($tree[$id] as $li) {
        $mid = $li['id'];
        $menu[$mid] = $prefix . $li['title'];
        $child = list2tree($li['id'], $tree, $prefix . '──');
        if (is_array($child))
            $menu = $menu + $child;
    }
    return $menu;
}

?>
