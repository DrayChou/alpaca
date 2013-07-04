<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?= $page_title ?></title>
    <meta name="keywords" content="<?= $meta_keywords ?>"/>
    <meta name="description" content="<?= $meta_description ?>"/>
    <link href="<?= BASE ?>static/default.css" rel="stylesheet" type="text/css" media="screen" />
    <base href="<?= BASE ?>" />
</head>
<body>
    <div id="wrapper">
        <div id="page-content">
            <div id="header-wrapper">
                <div id="header">
                    <div id="logo">
                        <h1><a href="/"><?= alpa('site_title') ?></a></h1>
                        <p><?= alpa('slogon') ?></p>
                    </div>
                </div>
            </div>
            <!-- end #header -->
            <div id="menu-wrapper">
                <div id="menu">
                    <ul>
                        <?= alpa('main') ?>	
                    </ul>
                </div>
            </div>
            <!-- end #menu -->
            <div style="background: url(http://beiercn.com/static/bluemountain/header.jpg) repeat scroll 0 0 transparent;height: 250px;" id="banner"></div>
            <div id="content">
                <div id="breadcrumb" class="post" >
                    <?= alpa::breadcrumb() ?>
                </div>
                <div  class="post" >
                    <?= $al_content ?>
                </div>
                <div class="clear"> </div>
            </div>
            <!-- end #content -->

            <div id="sidebar">
                <ul>
                    <li>
                        <h2>产品&服务</h2>
                        <ul>	
                            <?= alpa::tags() ?>
                        </ul> 
                    </li>
                    <li>

                        <h2>友情链接</h2>
                        <ul>
                            <?= alpa('friend') ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- end #sidebar -->
            <div class="clear"> </div>
        </div>
        <div id="footer">
            <p>Powered by <a href="http://alpaca.b24.cn/" >Alpaca</a></p>
        </div>
        <!-- end #footer -->
</body>
</html>
