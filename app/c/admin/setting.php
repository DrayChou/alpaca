<?php

class setting extends admin {

    function __construct() {
        parent::__construct();
        $this->m = load('m/elem_m');
        $this->submenu = array('index' => '网站设置', 'cleancache' => '清空缓存', 'backup' => '备份管理');
    }

    function index() {
        $param['config'] = array('site_title' => '网站名称', 'slogon' => '网站小标题', 'logo_url' => 'logo地址',
            'default_user_level' => '默认注册用户级别', 'icp' => 'icp备案', 'cache_time' => '缓存时间(关闭为0)');
        $setting = $param['setting'] = $this->m->setting();
        if (isset($_POST['setting'])) {
            foreach ($_POST['setting'] as $k => $v) {
                $this->m->setting($k, $v, 'config');
            }
            redirect(BASE . 'admin/setting/', '修改成功！');
        }
        $param['submenu'] = $this->submenu;
        $this->display('v/admin/setting/add', $param);
    }

    function cleancache() {
        cache_clean();
        load('c/admin/page')->cachedir();
    }

    function backup($action = '', $file = '') {
        switch ($action) {
            case 'create':
                $this->backup_create();
                return;
            case 'restore':
                $this->backup_restore($file);
                return;
            case 'del':
                $this->backup_del($file);
                return;
        }
        $file = array();

        if (APP_SERVER == 'sae') {

            //初始化SAE组件
            $stor = new SaeStorage();
            $base_dir = "db/";

            $num = 0;
            while ($ret = $stor->getList(SAE_STORAGE_DOMAIN, $base_dir, 100, $num)) {
                foreach ($ret as $flist) {
                    $temp = explode('/', $flist);
                    if (empty($temp[1])) {
                        continue;
                    }
                    $file[] = $temp[1];
                    $num++;
                }
            }
        } else {

            $base_dir = APP . "db/";
            $fso = opendir($base_dir);
            while ($flist = readdir($fso)) {
                $file[] = $flist;
            }
            closedir($fso);
        }

        $param['file'] = $file;
        $param['submenu'] = $this->submenu;
        $this->display('v/admin/setting/backup', $param);
    }

    function backup_create() {
        if (APP_SERVER == 'sae') {

            header('$charset=utf-8'); 
            $date = date('YmdHis');
            $dj = new SaeDeferredJob();
            $task_id = $dj->addTask("export", "mysql", "s02", "db/{$date}.sql.zip", SAE_MYSQL_DB, "", "");

            if ($task_id === false) {
                //echo "任务创建失败。。。<br/>";
                //var_dump($dj->errno(), $dj->errmsg());
                redirect('../', '备份任务创建失败。。。');
            }

            $ret = $dj->getStatus($task_id);
            if ($ret === false) {
                //echo "任务初始化失败。。。<br/>";
                //var_dump($dj->errno(), $dj->errmsg());
                redirect('../', '备份任务初始化失败。。。');
            }

            redirect('../', '备份任务已初始化成功，请等候系统备份完毕。');

            // while (1) {
            //     sleep(1);
            //     $ret = $dj->getStatus($task_id);
            //     if ($ret === false) {
            //         echo "任务初始化失败。。。<br/>";
            //         var_dump($dj->errno(), $dj->errmsg());
            //         break;
            //     }

            //     if ($ret === 'done') {
            //         echo "备份成功。。。<br/>";
            //         redirect('../', 'finished');
            //         break;
            //     }

            //     if ($ret === 'abort') {
            //         echo "备份失败。。。<br/>";
            //         var_dump($dj->errno(), $dj->errmsg());
            //         break;
            //     }

            //     if ($ret === 'waiting') {
            //         echo "等待执行。。。<br/>";
            //     }

            //     if ($ret === 'inqueue') {
            //         echo "执行中。。。<br/>";
            //     }
            // }
        } else {

            global $db_config;
            extract($db_config);
            if ($db_type == 'sqlite')
                exec('sqlite3 ' . $default_db . ' ".dump" > ' . APP . 'db/' . date('YmdHis') . '.sql');
            else
                exec('mysqldump -u' . $user . ' -p' . $password . ' ' . $default_db . ' >  ' . APP . 'db/' . date('YmdHis') . '.sql');
            redirect('../', 'finished');
        }
    }

    function backup_restore($file) {
        if (APP_SERVER == 'sae') {

            header('$charset=utf-8'); 
            $date = date('YmdHis');
            $dj = new SaeDeferredJob();
            $task_id = $dj->addTask("import", "mysql", "s02", "db/{$file}", SAE_MYSQL_DB, "", "");

            if ($task_id === false) {
                //echo "任务创建失败。。。<br/>";
                //var_dump($dj->errno(), $dj->errmsg());
                redirect('../', '还原任务创建失败。。。');
            }

            $ret = $dj->getStatus($task_id);
            if ($ret === false) {
                //echo "任务初始化失败。。。<br/>";
                //var_dump($dj->errno(), $dj->errmsg());
                redirect('../', '还原任务初始化失败。。。');
            }

            redirect('../', '还原任务已初始化成功，请等候系统还原完毕。');

            // while (1) {
            //     sleep(1);
            //     $ret = $dj->getStatus($task_id);
            //     if ($ret === false) {
            //         echo "任务初始化失败。。。<br/>";
            //         var_dump($dj->errno(), $dj->errmsg());
            //         break;
            //     }

            //     if ($ret === 'done') {
            //         echo "还原成功。。。<br/>";
            //         redirect('../../', 'finished');
            //         break;
            //     }

            //     if ($ret === 'abort') {
            //         echo "还原失败。。。<br/>";
            //         var_dump($dj->errno(), $dj->errmsg());
            //         break;
            //     }

            //     if ($ret === 'waiting') {
            //         echo "等待执行。。。<br/>";
            //     }

            //     if ($ret === 'inqueue') {
            //         echo "执行中。。。<br/>";
            //     }
            // }
        } else {
            global $db_config;
            extract($db_config);
            if ($db_type == 'sqlite')
                exec('sqlite3 ' . $default_db . ' <  ' . APP . 'db/' . $file);
            else
                exec('mysql -u' . $user . ' -p' . $password . ' ' . $default_db . ' <  ' . APP . 'db/' . $file);
            redirect('../../', 'finished');
        }
    }

    function backup_del($file) {
        if (APP_SERVER == 'sae') {

            //初始化SAE组件
            $stor = new SaeStorage();
            $base_dir = "db/";

            header('$charset=utf-8'); 
            if ($stor->delete(SAE_STORAGE_DOMAIN, $base_dir . $file) == false) {
                redirect('../../', $base_dir . $file . '删除失败。。。');
            }
        } else {
            unlink(APP . 'db/' . $file);
        }

        redirect('../../', 'finished');
    }

}

?>