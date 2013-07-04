<?php

class model extends admin {

    function __construct() {
        parent::__construct();
        $this->m = load('m/elem_m');
    }

    function index() {
        $tot = $this->m->count(" and `mod`='model' ");
        $psize = 30;
        $pcurrent = isset($_GET['p']) ? $_GET['p'] : 0;
        $param['pagination'] = pagination($tot, $pcurrent, $psize, BASE . 'admin/model/index/?p=');
        $param['records'] = $this->m->get(" and `mod`='model' ", $pcurrent, $psize);
        $this->display('v/admin/model/list-table', $param);
    }

    function add() {
        $conf = array('title' => 'required', 'title_label' => 'required');
        $err = validate($conf);
        if ($err === TRUE) {
            $_POST['post_time'] = $_POST['update_time'] = time();
            $_POST['elem_info'] = _encode(array('title_label' => $_POST['title_label'], 'fields' => $this->arrange($_POST['fields'])));
            $id = $this->m->add();
            redirect(BASE . 'admin/model/template/' . $id, '发布成功！');
        } else {
            $param['val'] = $_POST;
            $param['err'] = $err;
            $this->display('v/admin/model/add', $param);
        }
    }

    function edit($id) {
        $conf = array('title' => 'required', 'title_label' => 'required');
        $err = validate($conf);
        if (is_array($err)) {
            $v = $this->m->get($id);
            $param['val'] = array_merge($_POST, $v, _decode($v['elem_info']));
            $param['err'] = $err;
            $this->display('v/admin/model/add', $param);
            exit();
        }
        $fields = array();
        $_POST['update_time'] = time();
        $_POST['elem_info'] = _encode(array('title_label' => $_POST['title_label'], 'fields' => $this->arrange($_POST['fields'])));
        $this->m->update($id);
        redirect(BASE . 'admin/model/', '修改成功！');
    }

    function template($id) {
        $v = $this->m->get($id);
        $info = _decode($v['elem_info'], true);
        $model_layout = '';
        if (is_array($info['fields'])) {
            foreach ($info['fields'] as $m) {
                switch ($m['model']) {
                    case 'pic':
                        $model_layout .='<div>' . $m['label'] . ': <img src="<?=$' . $m['name'] . '?>" /> </div>';
                    default:
                        $model_layout .='<div>' . $m['label'] . ': <?=$' . $m['name'] . '?> </div>';
                }
            }
        }
        $layout = '<h1><?=$title?></h1>
' . $model_layout . '
<ul class="elem-list" >
<?php
if(is_array($records )){
foreach ($records as $r ){ ?>
  <li><a href="<?=$r[\'page\']?>" ><?=$r[\'title\']?></a></li>
<?  }
}?>
</ul>
<?=isset($pagination)?$pagination:\'\'?>';
        //  $nid = $this->m->add(array('elem_name'=>$v['title'],'mod'=>'layout','elem_info'=>$layout , 'post_time'=>time(), 'update_time'=>time()));
        $fname = $v['title'] . '.php';

        if ( APP_SERVER == 'sae' ) {
            file_put_contents('saekv://tmp/' . $fname, $layout);
            file_put_contents('saestor://' . SAE_STORAGE_DOMAIN . '/tmp/' . $fname, $layout);
        } else {
            file_put_contents(APP . 'tmp/' . $fname, $layout);
        }
        redirect(BASE . 'admin/template/index/' . $fname . '/', '成功创建排板！');
    }

    function del($id) {
        $this->m->del($id);
        redirect(BASE . 'admin/model/', '删除成功！');
    }

    function arrange($arr) {
        // clear empty fields
        $narr = array();
        foreach ($arr as $a) {
            if ($a['name'])
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

}

?>