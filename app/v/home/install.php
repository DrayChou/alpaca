<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF8"/>
    <title>羊驼!CMS 安装</title>
    <link type="text/css" rel="stylesheet" href="static/admin.css"/>
    <script src="static/js/jquery-1.7.1.min.js"></script>
    <script>
        $(function () {
            $('.db_type').click(function () {
                db = ($('.db_type:checked').val());
                if (db == 'mysql') $('#mysql').fadeIn();
                else  $('#mysql').fadeOut();
            });
        });
    </script>
</head>
<body>
<div id="menu"></div>
<div id="content">
    <h1>羊驼CMS 安装</h1>

    <div class="notice">
        <h3>注意，服务器环境需满足以下条件才可安装羊驼!</h3>
        <ul>
            <li>如选用 Sqlite， 需要 PHP 5 >= 5.3.0</li>
            <li>请确认 服务器安装url重写 url_rewrite 模块，并且已经开启</li>
            <li>apache 支持 .htaccess 配置</li>
            <li>确认php short_tag 选项为 on</li>
            <li>请确认 app/, upfile/ 目录为可写</li>
        </ul>
    </div>
    <form method="POST">
        <table class="table">
            <tr>
                <th width="100">安装网址</th>
                <td><input type="text" name="base_dir" value="<?= $base ?>"/> 如： http://domain/alpaca/</td>
            </tr>
            <tr>
                <th>数据库类型</th>
                <td>
                    <input type="radio" class="db_type" name="db_type" value="sqlite" checked/> Sqlite
                    <input type="radio" class="db_type" name="db_type" value="mysql"/> Mysql
                </td>
            </tr>
        </table>
        <table class="table" id="mysql" style="display:none;">
            <tr>
                <th width="100">服务器</th>
                <td><input type="text" name="host" value="localhost"/></td>
            </tr>
            <tr>
                <th>用户名</th>
                <td><input type="text" name="user" value="" placeholder="你的mysql用户名"/></td>
            </tr>
            <tr>
                <th>密　码</th>
                <td><input type="text" name="password" value="" placeholder="你的mysql用户密码"/></td>
            </tr>
            <tr>
                <th>数据库</th>
                <td><input type="text" name="default_db" value="" placeholder="你的mysql数据库"/></td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th width="100"></th>
                <td><input type="submit" value="现在安装"/></th>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
