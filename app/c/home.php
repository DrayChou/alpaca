<?php

class home extends base {

    function __construct() {
        parent::__construct();
    }

    function index() {
        global $db_config;
        if (!isset($db_config)) {
            $this->install();
            exit;
        }
        load('c/page')->view();
    }

    private function install() {
        global $db_config;
        if (is_array($db_config))
            redirect("/");
        if (isset($_POST['db_type'])) {
            $db_type = $_POST['db_type'] == 'sqlite' ? 'sqlite' : 'mysql';
            $_POST['default_db'] = $db_type == 'sqlite' ? rand(100000, 999999) . '.sqlite' : $_POST['default_db'];
            $cname = 'db_' . $db_type;
            $db = new $cname($_POST);
            $sql = file_get_contents(APP . $db_type . '_ins.sql');
            $db->muti_query($sql);
            $base_dir = rtrim($_POST['base_dir'], '/') . '/';
            $seed = randstr();
            file_put_contents(APP . 'config_user.php', '<?php
define(\'BASE\',\'' . $base_dir . '\');
define(\'ADMIN_BASE\',BASE.\'admin/\');
define(\'SEED\',\'' . $seed . '\');
$db_config = array(
  \'host\'      =>\'' . $_POST['host'] . '\', 
  \'user\'      =>\'' . $_POST['user'] . '\',  
  \'password\'  =>\'' . $_POST['password'] . '\', 
  \'db_type\'   =>\'' . $_POST['db_type'] . '\',
  \'default_db\'=>\'' . $_POST['default_db'] . '\'
);');
            redirect($_POST['base_dir'], '安装成功');
        } else {
            header("Content-type: text/html; charset=utf-8");
            $base = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
            view("v/home/install", array('base' => $base));
        }
    }

    function test() {
        $stor = new SaeStorage();
        $upload_domain = "s02";

        echo "<pre>";

        $kv = new SaeKV();
 
        // 初始化SaeKV对象
        $ret = $kv->init();
        var_dump($ret);
        $ret = $kv->pkrget('', 100);
        var_dump($ret);

        file_put_contents('saekv://testsaekv', chr(0xEF).chr(0xBB).chr(0xBF)."test");
        var_dump(file_get_contents('saekv://testsaekv'));

        // 更新key-value
        $ret = $kv->set('testset', 'test');
        var_dump($ret);

        // $ret = $stor->fileExists($upload_domain, "upfile/image/20120624");
        // echo '$stor->fileExists($upload_domain, "upfile/image/20120624")','<br/>';
        // var_dump($ret);

        // $ret = $stor->fileExists($upload_domain, "upfile/image/2012062420120624115257_50199.jpg");
        // echo '$stor->fileExists($upload_domain, "upfile/image/2012062420120624115257_50199.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->fileExists($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg");
        // echo '$stor->fileExists($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getAttr($upload_domain, "upfile/image/20120624");
        // echo '$stor->getAttr($upload_domain, "upfile/image/20120624")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getAttr($upload_domain, "upfile/image/2012062420120624115257_50199.jpg");
        // echo '$stor->getAttr($upload_domain, "upfile/image/2012062420120624115257_50199.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getAttr($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg");
        // echo '$stor->getAttr($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getUrl ($upload_domain, "upfile/image/20120624");
        // echo '$stor->getUrl ($upload_domain, "upfile/image/20120624")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getUrl ($upload_domain, "upfile/image/2012062420120624115257_50199.jpg");
        // echo '$stor->getUrl ($upload_domain, "upfile/image/2012062420120624115257_50199.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getUrl($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg");
        // echo '$stor->getUrl($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getFilesNum($upload_domain, "upfile/image/20120624");
        // echo '$stor->getFilesNum($upload_domain, "upfile/image/20120624")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getFilesNum($upload_domain, "upfile/image/2012062420120624115257_50199.jpg");
        // echo '$stor->getFilesNum($upload_domain, "upfile/image/2012062420120624115257_50199.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getFilesNum($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg");
        // echo '$stor->getFilesNum($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getListByPath($upload_domain, "upfile/image/20120624");
        // echo '$stor->getListByPath($upload_domain, "upfile/image/20120624")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getListByPath($upload_domain, "upfile/image/2012062420120624115257_50199.jpg");
        // echo '$stor->getListByPath($upload_domain, "upfile/image/2012062420120624115257_50199.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->getListByPath($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg");
        // echo '$stor->getListByPath($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->read($upload_domain, "upfile/image/20120624");
        // echo '$stor->read($upload_domain, "upfile/image/20120624")','<br/>';
        // var_dump($ret);

        // $ret = $stor->read($upload_domain, "upfile/image/2012062420120624115257_50199.jpg");
        // echo '$stor->read($upload_domain, "upfile/image/2012062420120624115257_50199.jpg")','<br/>';
        // var_dump($ret);

        // $ret = $stor->read($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg");
        // echo '$stor->read($upload_domain, "upfile/image/dsafdsgfdgfdgdf.jpg")','<br/>';
        // var_dump($ret);

        echo "</pre>";
    }

}

?>