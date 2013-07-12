<?php

class file extends base
{

    function __construct()
    {
        parent::__construct();
    }

    function upload()
    {
        if (APP_SERVER == 'sae') {
            $this->upload_sae();
        } else {
            $this->upload_();
        }
    }

    function upload_sae()
    {
        if ($this->u['level'] < 5) {
            alert('权限不够');
        }
        //初始化SAE组件
        $stor = new SaeStorage();

        $php_path = '';
        //文件保存目录路径
        $save_path = $php_path . 'upfile/';
        //定义允许上传的文件扩展名
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );
        //最大文件大小
        $max_size = 1000000;

        //有上传文件时
        if (empty($_FILES) === false) {
            //原文件名
            $file_name = $_FILES['imgFile']['name'];
            //服务器上临时文件名
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            //文件大小
            $file_size = $_FILES['imgFile']['size'];
            //检查文件名
            if (!$file_name) {
                alert("请选择文件。");
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                alert("临时文件可能不是上传文件。");
            }
            //检查文件大小
            if ($file_size > $max_size) {
                alert("上传文件大小超过限制。");
            }
            //检查目录名
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            if (empty($ext_arr[$dir_name])) {
                alert("目录名不正确。");
            }
            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . "/";
            }
            $ymd = date("Ymd");
            $save_path .= $ymd . "/";

            //新文件名
            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            $file_url = $stor->upload(SAE_STORAGE_DOMAIN, $file_path, $tmp_name);
            if ($file_url == false) {
                alert("上传文件失败。");
            }

            header('Content-type: text/html; charset=UTF-8');
            echo _encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }

    function upload_()
    {
        if ($this->u['level'] < 5)
            alert('权限不够');
        $php_path = '';
        $php_url = BASE;
        //文件保存目录路径
        $save_path = $php_path . 'upfile/';
        //文件保存目录URL
        $save_url = $php_url . 'upfile/';
        //定义允许上传的文件扩展名
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );
        //最大文件大小
        $max_size = 1000000;
        $save_path = realpath($save_path) . '/';

        //有上传文件时
        if (empty($_FILES) === false) {
            //原文件名
            $file_name = $_FILES['imgFile']['name'];
            //服务器上临时文件名
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            //文件大小
            $file_size = $_FILES['imgFile']['size'];
            //检查文件名
            if (!$file_name) {
                alert("请选择文件。");
            }
            //检查目录
            if (@is_dir($save_path) === false) {
                alert("上传目录不存在。");
            }
            //检查目录写权限
            if (@is_writable($save_path) === false) {
                alert("上传目录没有写权限。");
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                alert("临时文件可能不是上传文件。");
            }
            //检查文件大小
            if ($file_size > $max_size) {
                alert("上传文件大小超过限制。");
            }
            //检查目录名
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            if (empty($ext_arr[$dir_name])) {
                alert("目录名不正确。");
            }
            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . "/";
                $save_url .= $dir_name . "/";
                if (!file_exists($save_path)) {
                    mkdir($save_path);
                }
            }
            $ymd = date("Ymd");
            $save_path .= $ymd . "/";
            $save_url .= $ymd . "/";
            if (!file_exists($save_path)) {
                mkdir($save_path);
            }
            //新文件名
            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false) {
                alert("上传文件失败。");
            }
            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;

            header('Content-type: text/html; charset=UTF-8');
            echo _encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }

    function filemanager()
    {
        if (APP_SERVER == 'sae') {
            $this->filemanager_sae();
        } else {
            $this->filemanager_();
        }
    }

    function filemanager_sae()
    {
        if ($this->u['level'] < 5) {
            alert('权限不够');
        }

        //初始化SAE组件
        $stor = new SaeStorage();

        $php_path = ''; //dirname(__FILE__) . '/';
        //根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_path = $php_path . 'upfile/';
        //图片扩展名
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

        //目录名
        $dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
        if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
            alert("Invalid Directory name.");
        }
        if ($dir_name !== '') {
            $root_path .= $dir_name . "/";
        }

        //根据path参数，设置各路径和URL
        if (empty($_GET['path'])) {
            $current_path = $root_path;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = $root_path . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        //排序形式，name or size or type
        $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            alert("Access is not allowed.");
        }
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            alert("Parameter is not valid.");
        }

        function digui(&$file_list, $i, $path)
        {
            $stor = new SaeStorage();
            $ret = $stor->getListByPath(SAE_STORAGE_DOMAIN, $path, 1000);
            if ($ret == false) {
                return;
            }

            if (isset($file_list[$i])) {
                $file_list[$i]['has_file'] = $ret['fileNum'] > 0;
                return;
            }

            foreach ($ret['files'] as $file) {
                $i = $i + 1;
                $file_list[$i]['is_dir'] = false;
                $file_list[$i]['has_file'] = false;
                $file_list[$i]['filesize'] = $file['length'];
                $file_list[$i]['dir_path'] = $path;
                $file_ext = strtolower(array_pop(explode('.', trim($file['Name']))));
                $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                $file_list[$i]['filetype'] = $file_ext;
                $file_list[$i]['filename'] = $file['Name']; //文件夹名
                $file_list[$i]['full_name'] = $file['fullName']; //路径
                $file_list[$i]['datetime'] = $file['uploadTime']; //上传时间
            }

            foreach ($ret['dirs'] as $dir) {
                $i = $i + 1;
                $file_list[$i]['is_dir'] = true; //是否文件夹
                $file_list[$i]['has_file'] = 0; //文件夹是否包含文件
                $file_list[$i]['filesize'] = 0; //文件大小
                $file_list[$i]['dir_path'] = $path;
                $file_list[$i]['is_photo'] = false; //是否图片
                $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                $file_list[$i]['filename'] = $dir['name']; //文件夹名
                $file_list[$i]['full_name'] = $dir['fullName']; //路径
                $file_list[$i]['datetime'] = 0; //上传时间

                digui($file_list, $i, $path . '/' . $dir['name']);
            }
        }

        $file_list = array();
        $upload_path = substr($current_path, 0, -1);
        digui($file_list, -1, $upload_path);

        //排序
        function cmp_func($a, $b)
        {
            global $order;
            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            } else if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            } else {
                if ($order == 'size') {
                    if ($a['filesize'] > $b['filesize']) {
                        return 1;
                    } else if ($a['filesize'] < $b['filesize']) {
                        return -1;
                    } else {
                        return 0;
                    }
                } else if ($order == 'type') {
                    return strcmp($a['filetype'], $b['filetype']);
                } else {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        }

        usort($file_list, 'cmp_func');

        $result = array();
        //相对于根目录的上一级目录
        $result['moveup_dir_path'] = $moveup_dir_path;
        //相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;
        //相对于根目录的当前目录
        $result['current_path'] = $current_path;
        //当前目录的URL
        $result['current_url'] = $stor->getUrl(SAE_STORAGE_DOMAIN, $upload_path);
        //文件数
        $result['total_count'] = count($file_list);
        //文件列表数组
        $result['file_list'] = $file_list;

        //输出JSON字符串
        header('Content-type: application/; charset=UTF-8');
        echo _encode($result);
        exit;
    }

    function filemanager_()
    {
        if ($this->u['level'] < 5)
            alert('权限不够');
        $php_path = ''; //dirname(__FILE__) . '/';
        $php_url = BASE;
        //根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_path = $php_path . 'upfile/';
        //根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
        $root_url = $php_url . 'upfile/';
        //图片扩展名
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

        //目录名
        $dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
        if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
            alert('Invalid Directory name.');
        }
        if ($dir_name !== '') {
            $root_path .= $dir_name . "/";
            $root_url .= $dir_name . "/";
            if (!file_exists($root_path)) {
                mkdir($root_path);
            }
        }

        //根据path参数，设置各路径和URL
        if (empty($_GET['path'])) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $_GET['path'];
            $current_url = $root_url . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        //排序形式，name or size or type
        $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            alert('Access is not allowed.');
        }
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            alert('Parameter is not valid.');
        }
        //目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            alert('Directory does not exist.');
        }

        //遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.')
                    continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(array_pop(explode('.', trim($file))));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }

        //排序
        function cmp_func($a, $b)
        {
            global $order;
            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            } else if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            } else {
                if ($order == 'size') {
                    if ($a['filesize'] > $b['filesize']) {
                        return 1;
                    } else if ($a['filesize'] < $b['filesize']) {
                        return -1;
                    } else {
                        return 0;
                    }
                } else if ($order == 'type') {
                    return strcmp($a['filetype'], $b['filetype']);
                } else {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        }

        usort($file_list, 'cmp_func');

        $result = array();
        //相对于根目录的上一级目录
        $result['moveup_dir_path'] = $moveup_dir_path;
        //相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;
        //当前目录的URL
        $result['current_url'] = $current_url;
        //文件数
        $result['total_count'] = count($file_list);
        //文件列表数组
        $result['file_list'] = $file_list;

        //输出JSON字符串
        header('Content-type: application/; charset=UTF-8');
        echo _encode($result);
        exit;
    }

    function thumb($size = 300, $file = '')
    {
        if (APP_SERVER == 'sae') {
            $this->thumb_sae($size, $file);
        } else {
            $this->thumb_($size, $file);
        }
    }

    function thumb_sae($size = 300, $file = '')
    {
        global $seg;
        $file = implode('/', array_slice($seg, 4)); // 原图地址
        $temp = @file_get_contents('saestor://' . SAE_STORAGE_DOMAIN . '/' . $file . '.php');

        if (empty($temp))
            return;
        $img = load('lib/img');
        $img->filename = $file;
        $img->file_tmp_name = $file;
        $img->save_file = 'thumb/' . $size . '/' . $file;
        $img->limit_w = $size;
        $img->display = true;
        $img->create();
    }

    function thumb_($size = 300, $file = '')
    {
        global $seg;
        $file = implode('/', array_slice($seg, 4)); // 原图地址
        if (!is_file($file))
            return;
        $img = load('lib/img');
        $img->filename = $file;
        $img->file_tmp_name = $file;
        $img->save_file = 'thumb/' . $size . '/' . $file;
        $attachDir = implode('/', array_slice($seg, 2, -1));
        if (!is_dir($attachDir)) {
            @mkdir($attachDir, 0777, true);
            @fclose(fopen($attachDir . '/index.htm', 'w'));
        }
        $img->limit_w = $size;
        $img->display = true;
        $img->create();
    }

}

function alert($msg)
{
    header('Content-type: text/html; charset=UTF-8');
    echo _encode(array('error' => 1, 'message' => $msg));
    exit;
}

?>