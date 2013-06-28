PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE `elem` (
  id INTEGER PRIMARY KEY, 
  `title` TEXT DEFAULT NULL,
  `mod` TEXT DEFAULT NULL,
  `rel_id` INT DEFAULT NULL,
  `elem_name` TEXT DEFAULT NULL,
  `elem_info` TEXT,
  `tags` TEXT,
  `post_time` INT DEFAULT NULL,
  `update_time` INT DEFAULT NULL,
  `user_id` INT DEFAULT NULL,
  `user_name` TEXT DEFAULT NULL,
  `order_by` INT DEFAULT NULL
);
INSERT INTO "elem" VALUES(1,'基本页面','model',NULL,NULL,'a:2:{s:11:"title_label";s:6:"标题";s:6:"fields";a:1:{i:0;a:4:{s:4:"name";s:7:"content";s:5:"label";s:6:"内容";s:5:"model";s:3:"rte";s:5:"order";s:0:"";}}}',NULL,1334849598,1334849598,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(2,'产品','model',NULL,NULL,'a:2:{s:11:"title_label";s:6:"标题";s:6:"fields";a:4:{i:0;a:5:{s:4:"name";s:7:"xinghao";s:5:"label";s:6:"型号";s:5:"model";s:4:"text";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"2";}i:1;a:5:{s:4:"name";s:3:"pic";s:5:"label";s:6:"图片";s:5:"model";s:3:"pic";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"3";}i:2;a:5:{s:4:"name";s:5:"price";s:5:"label";s:6:"价格";s:5:"model";s:4:"text";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"6";}i:3;a:5:{s:4:"name";s:7:"content";s:5:"label";s:6:"描述";s:5:"model";s:3:"rte";s:4:"enum";s:25:"选项1
选项2
选项3";s:5:"order";s:1:"9";}}}',NULL,1334849982,1340456575,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(4,NULL,'setting',NULL,NULL,'a:12:{s:16:"default_template";s:1:"3";s:10:"site_title";a:2:{s:3:"val";s:12:"网站名称";s:4:"type";s:6:"config";}s:6:"slogon";a:2:{s:3:"val";s:11:"it''s alpaca";s:4:"type";s:6:"config";}s:18:"default_user_level";a:2:{s:3:"val";s:1:"5";s:4:"type";s:6:"config";}s:5:"about";a:2:{s:3:"val";s:17:"关于 Alpaca !  ";s:4:"type";s:5:"label";}s:8:"logo_url";a:2:{s:3:"val";s:0:"";s:4:"type";s:6:"config";}s:3:"icp";a:2:{s:3:"val";s:0:"";s:4:"type";s:6:"config";}s:10:"cache_time";a:2:{s:3:"val";s:1:"0";s:4:"type";s:6:"config";}s:8:"category";a:2:{s:3:"val";a:2:{i:8;s:18:"──供应产品";i:13;s:18:"──公司动态";}s:4:"type";s:5:"cache";}s:4:"tree";a:2:{s:3:"val";a:1:{i:0;a:2:{i:0;a:4:{s:2:"id";i:8;s:5:"title";s:12:"供应产品";s:4:"name";s:7:"product";s:6:"rel_id";i:0;}i:1;a:4:{s:2:"id";i:13;s:5:"title";s:12:"公司动态";s:4:"name";s:4:"news";s:6:"rel_id";i:0;}}}s:4:"type";s:5:"cache";}s:3:"dir";a:2:{s:3:"val";a:2:{i:8;a:4:{s:2:"id";i:8;s:5:"title";s:12:"供应产品";s:4:"name";s:7:"product";s:6:"rel_id";i:0;}i:13;a:4:{s:2:"id";i:13;s:5:"title";s:12:"公司动态";s:4:"name";s:4:"news";s:6:"rel_id";i:0;}}s:4:"type";s:5:"cache";}s:6:"plugin";a:2:{s:3:"val";a:1:{i:0;s:8:"freeform";}s:4:"type";s:6:"system";}}',NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(5,'羊驼首页','page',0,'home','a:17:{s:5:"model";s:1:"1";s:7:"content";s:453:"点这里进后台 <a href="admin/">admin/</a> 用户名 admin , 初始密码&nbsp;&nbsp; admin
<ul>
	<li>
		登录后，请点击帐号修改初始密码
	</li>
	<li>
		如果有任何问题可以访问开发者社区 <a href="http://alpaca.b24.cn/bbs/" target="_blank">http://alpaca.b24.cn/bbs/</a> 
	</li>
	<li>
		我们网站上你可以找到多套风格下载使用 <a href="http://alpaca.b24.cn/">http://alpaca.b24.cn</a> 
	</li>
</ul>";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:4:"home";s:9:"page_size";s:2:"20";s:14:"child_template";s:1:"0";s:12:"child_layout";s:1:"2";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";s:3:"dir";i:0;s:10:"child_page";i:0;s:9:"child_dir";i:0;s:10:"grandchild";i:0;}','',1334847879,1340461723,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(6,NULL,'link',NULL,'main','a:6:{i:0;a:3:{s:5:"label";s:6:"首页";s:4:"link";s:0:"";s:5:"order";s:1:"1";}i:1;a:3:{s:5:"label";s:12:"供应产品";s:4:"link";s:13:"page/product/";s:5:"order";s:1:"2";}i:2;a:3:{s:5:"label";s:12:"公司介绍";s:4:"link";s:11:"page/about/";s:5:"order";s:1:"3";}i:3;a:3:{s:5:"label";s:12:"公司动态";s:4:"link";s:10:"page/news/";s:5:"order";s:1:"4";}i:4;a:3:{s:5:"label";s:12:"联系方式";s:4:"link";s:13:"page/contact/";s:5:"order";s:1:"5";}i:5;a:3:{s:5:"label";s:9:"留言板";s:4:"link";s:14:"page/feedback/";s:5:"order";s:1:"6";}}',NULL,1334849777,1340463746,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(7,NULL,'link',NULL,'friend','a:1:{i:0;a:4:{s:5:"label";s:13:"羊驼!来也";s:4:"link";s:20:"http://alpaca.b24.cn";s:5:"order";s:0:"";s:5:"blank";s:1:"1";}}',NULL,1334849874,1334971050,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(8,'供应产品','dir',0,'product','a:17:{s:5:"model";s:1:"1";s:7:"content";s:0:"";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:12:"product_list";s:9:"page_size";s:2:"20";s:9:"child_dir";i:1;s:14:"child_template";s:0:"";s:12:"child_layout";s:12:"product_view";s:11:"child_model";s:1:"2";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";s:3:"dir";i:1;s:10:"child_page";i:0;s:10:"grandchild";i:0;}','',1340373979,1340454464,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(9,'产品一','page',8,'8qzyja','a:20:{s:5:"model";s:1:"2";s:3:"pic";s:71:"http://alpaca.b24/alpaca/upfile/image/20120623/20120623195814_27964.jpg";s:5:"price";s:3:"100";s:7:"content";s:18:"产品详细描述";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:12:"product_view";s:9:"page_size";s:2:"20";s:9:"child_dir";i:1;s:14:"child_template";s:0:"";s:12:"child_layout";s:0:"";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";s:3:"dir";i:0;s:10:"child_page";i:0;s:10:"grandchild";i:0;s:7:"xinghao";s:11:"81872182-aq";}','分类一,推荐',1340374015,1340459522,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(11,'联系方式','page',0,'contact','a:17:{s:5:"model";s:1:"1";s:7:"content";s:441:"<p>
	电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：86 21 00000000
</p>
<p>
	移动电话：13900000000
</p>
<p>
	传&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真：86 21 00000000
</p>
<p>
	地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：中国 上海市嘉定区 XXXXXXXX
</p>
<p>
	邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编：00000000
</p>
<p>
	公司主页： 你的网址
</p>
<p>
	<br />
</p>
<p>
	<br />
</p>
<div>
</div>";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:0:"";s:9:"page_size";s:2:"20";s:9:"child_dir";i:1;s:14:"child_template";s:0:"";s:12:"child_layout";s:0:"";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";s:3:"dir";i:0;s:10:"child_page";i:0;s:10:"grandchild";i:0;}','',1340438792,1340438682,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(12,'公司介绍','page',0,'about','a:14:{s:5:"model";s:1:"1";s:7:"content";s:39:"请在此页面录入公司介绍信息";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:0:"";s:9:"page_size";s:2:"20";s:9:"child_dir";s:1:"1";s:14:"child_template";s:0:"";s:12:"child_layout";s:0:"";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";}','',1340438762,1340438762,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(13,'公司动态','dir',0,'news','a:15:{s:5:"model";s:1:"1";s:7:"content";s:0:"";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:0:"";s:3:"dir";i:1;s:9:"page_size";s:2:"20";s:9:"child_dir";s:1:"1";s:14:"child_template";s:0:"";s:12:"child_layout";s:0:"";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";}','',1340438803,1340438803,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(14,'企业网站上线','page',13,'fnqbh4','a:14:{s:5:"model";s:1:"1";s:7:"content";s:18:"企业网站上线";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:0:"";s:9:"page_size";s:2:"20";s:9:"child_dir";s:1:"1";s:14:"child_template";s:0:"";s:12:"child_layout";s:0:"";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";}','',1340438791,1340438791,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(16,'产品2','page',8,'tnp8lv','a:20:{s:5:"model";s:1:"2";s:3:"pic";s:71:"http://alpaca.b24/alpaca/upfile/image/20120623/20120623200602_15398.jpg";s:5:"price";s:3:"300";s:7:"content";s:18:"产品细节描述";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:12:"product_view";s:9:"page_size";s:2:"20";s:9:"child_dir";i:1;s:14:"child_template";s:0:"";s:12:"child_layout";s:0:"";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";s:3:"dir";i:0;s:10:"child_page";i:0;s:10:"grandchild";i:0;s:7:"xinghao";s:9:"823202-xx";}','分类二，推荐',1340453169,1340459557,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(20,'分类一','tag',9,'%E5%88%86%E7%B1%BB%E4%B8%80',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(21,'推荐','tag',9,'%E6%8E%A8%E8%8D%90',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(22,'分类二','tag',16,'%E5%88%86%E7%B1%BB%E4%BA%8C',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(23,'推荐','tag',16,'%E6%8E%A8%E8%8D%90',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO "elem" VALUES(24,'留言板','page',0,'feedback','a:14:{s:5:"model";s:1:"1";s:7:"content";s:0:"";s:10:"page_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";s:8:"template";s:0:"";s:6:"layout";s:8:"feedback";s:9:"page_size";s:2:"20";s:9:"child_dir";s:1:"1";s:14:"child_template";s:0:"";s:12:"child_layout";s:0:"";s:11:"child_model";s:1:"1";s:11:"user_browse";s:1:"0";s:8:"user_add";s:2:"10";}','',1340463975,1340463975,NULL,NULL,NULL);
CREATE TABLE `user` (
  id INTEGER PRIMARY KEY, 
  `email` TEXT DEFAULT NULL,
  `username` TEXT DEFAULT NULL,
  `password` TEXT DEFAULT NULL,
  `post_time` INT DEFAULT NULL,
  `update_time` INT DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `info` text
);
INSERT INTO "user" VALUES(1,'admin@local.com','admin','21232f297a57a5a743894a0e4a801fc3',1334938996,1340326584,20,NULL);
CREATE INDEX "elem_name" on elem (elem_name ASC);
CREATE INDEX "mod" on elem (mod ASC);
CREATE INDEX "rel_id" on elem (rel_id ASC);
COMMIT;
