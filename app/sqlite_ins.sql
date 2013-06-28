PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
DROP TABLE IF EXISTS `elem`;
DROP TABLE IF EXISTS `user`;

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

INSERT INTO `elem` VALUES(1, '基本页面', 'model', NULL, NULL, '{"title_label":"\u6807\u9898","fields":[{"name":"content","label":"\u5185\u5bb9","model":"rte","enum":"\u9009\u98791\r\n\u9009\u98792\r\n\u9009\u98793","order":""}]}', NULL, 1340509085, 1340509114, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(2, NULL, 'setting', NULL, NULL, '{"site_title":{"val":"\u4f01\u4e1a\u540d\u79f0","type":"config"},"slogon":{"val":"\u4e00\u53e5\u8bdd\u7b80\u4ecb\u3001\u683c\u8a00","type":"config"},"logo_url":{"val":"","type":"config"},"default_user_level":{"val":"","type":"config"},"icp":{"val":"","type":"config"},"cache_time":{"val":"0","type":"config"},"category":{"val":{"7":"\u2500\u2500\u4ea7\u54c1\u548c\u670d\u52a1","8":"\u2500\u2500\u4f01\u4e1a\u52a8\u6001"},"type":"cache"},"tree":{"val":[[{"id":"7","title":"\u4ea7\u54c1\u548c\u670d\u52a1","name":"product","rel_id":"0"},{"id":"8","title":"\u4f01\u4e1a\u52a8\u6001","name":"news","rel_id":"0"}]],"type":"cache"},"dir":{"val":{"7":{"id":"7","title":"\u4ea7\u54c1\u548c\u670d\u52a1","name":"product","rel_id":"0"},"8":{"id":"8","title":"\u4f01\u4e1a\u52a8\u6001","name":"news","rel_id":"0"}},"type":"cache"},"plugin":{"val":["freeform"],"type":"system"}}', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(3, '产品', 'model', NULL, NULL, '{"title_label":"\u6807\u9898","fields":[{"name":"pic","label":"\u56fe\u7247","model":"pic","enum":"\u9009\u98791\r\n\u9009\u98792\r\n\u9009\u98793","order":"1"},{"name":"xinghao","label":"\u578b\u53f7","model":"text","enum":"\u9009\u98791\r\n\u9009\u98792\r\n\u9009\u98793","order":"2"},{"name":"price","label":"\u4ef7\u683c","model":"text","enum":"\u9009\u98791\r\n\u9009\u98792\r\n\u9009\u98793","order":"3"},{"name":"content","label":"\u63cf\u8ff0","model":"rte","enum":"\u9009\u98791\r\n\u9009\u98792\r\n\u9009\u98793","order":"10"}]}', NULL, 1340509278, 1340509963, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(4, '网站首页', 'page', 0, 'home', '{"model":"1","content":"<h3>\r\n\t\u516c\u544a<br \/>\r\n<\/h3>\r\n<p>\r\n\t\u516c\u53f8\u516c\u544a\u4fe1\u606f\u6216\u8005\u4f01\u4e1a\u7b80\u4ecb\u7b49\u5185\u5bb9\r\n<\/p>","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"home","page_size":"20","child_dir":1,"child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10","dir":0,"child_page":0,"grandchild":0}', '', 1340507186, 1340517966, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(5, NULL, 'link', NULL, 'main', '[{"label":"\u9996\u9875","link":"","order":"1"},{"label":"\u4ea7\u54c1\u548c\u670d\u52a1","link":"page\/product\/","order":"2"},{"label":"\u4f01\u4e1a\u4ecb\u7ecd","link":"page\/about\/","order":"3"},{"label":"\u4f01\u4e1a\u52a8\u6001","link":"page\/news\/","order":"4"},{"label":"\u8054\u7cfb\u6211\u4eec","link":"page\/contact\/","order":"5"},{"label":"\u7559\u8a00\u677f","link":"page\/feedback\/","order":"6"}]', NULL, 1340509451, 1340509586, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(6, NULL, 'link', NULL, 'friend', '[{"label":"\u7f8a\u9a7cCMS","link":"http:\/\/alpaca.b24.cn\/","order":"","blank":"1"}]', NULL, 1340509492, 1340509492, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(7, '产品和服务', 'dir', 0, 'product', '{"model":"1","content":"&nbsp;","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"product_list","dir":1,"page_size":"20","child_dir":"1","child_template":"","child_layout":"product_view","child_model":"3","user_browse":"0","user_add":"10"}', '', 1340507179, 1340507179, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(8, '企业动态', 'dir', 0, 'news', '{"model":"1","content":"","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"","page_size":"20","child_dir":1,"child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10","dir":1,"child_page":0,"grandchild":0}', '', 1340507196, 1340509616, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(9, '留言板', 'page', 0, 'feedback', '{"model":"1","content":"&nbsp;&nbsp;&nbsp;&nbsp;","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"feedback","page_size":"20","child_dir":"1","child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10"}', '', 1340507169, 1340507169, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(10, '联系方式', 'page', 0, 'contact', '{"model":"1","content":"\u7535&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      \u8bdd\uff1a86 21 00000000 <br \/>\r\n\u79fb\u52a8\u7535\u8bdd\uff1a86 21 00000000 <br \/>\r\n\u4f20&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      \u771f\uff1a86 21 00000000<br \/>\r\n\u5730&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      \u5740\uff1a\u4e2d\u56fd \u4e0a\u6d77\u5e02\u5609\u5b9a\u533a \u4e0a\u6d77\u5e02\u5609\u5b9a\u533aXXXXX\u8def100\u53f7 <br \/>\r\n\u90ae &nbsp; &nbsp; &nbsp;      \u7f16\uff1a201802 <br \/>\r\n\u516c\u53f8\u4e3b\u9875\uff1a","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"","page_size":"20","child_dir":"1","child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10"}', '', 1340507193, 1340507193, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(11, '企业介绍', 'page', 0, 'about', '{"model":"1","content":"\u4f01\u4e1a\u4ecb\u7ecd\u5185\u5bb9","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"","page_size":"20","child_dir":"1","child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10"}', '', 1340507187, 1340507187, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(12, '产品1', 'page', 7, '6lw5ca', '{"model":"3","pic":"\/upfile\/image\/20120624\/20120624115257_50199.jpg","xinghao":"232-22","price":"2000","content":"\u4ea7\u54c1\u4e00\uff0c\u5e05\u7f8a\u9a7c\uff0c \u5206\u7c7b\u901a\u8fc7\u7f16\u8f91\u6807\u7b7e\u6765\u5b9e\u73b0\u3002<br \/>","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"product_view","page_size":"20","child_dir":1,"child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10","dir":0,"child_page":0,"grandchild":0}', '类别1，推荐', 1340507208, 1340510028, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(14, '类别1', 'tag', 12, '%E7%B1%BB%E5%88%AB1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(15, '推荐', 'tag', 12, '%E6%8E%A8%E8%8D%90', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(16, '产品2', 'page', 7, 'z0jpup', '{"model":"3","pic":"\/upfile\/image\/20120624\/20120624115411_69093.jpg","xinghao":"2322-223","price":"1290","content":"\u63a8\u8350\u4ea7\u54c1","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"product_view","page_size":"20","child_dir":"1","child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10"}', '分类2，推荐', 1340507161, 1340507161, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(17, '分类2', 'tag', 16, '%E5%88%86%E7%B1%BB2', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(18, '推荐', 'tag', 16, '%E6%8E%A8%E8%8D%90', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(19, '公司网站上线', 'page', 8, 'v60nyb', '{"model":"1","content":"\u4f01\u4e1a\u52a8\u6001\u5b9e\u4f8b\uff0c\u516c\u53f8\u7f51\u7ad9\u4e0a\u7ebf","page_title":"","meta_keywords":"","meta_description":"","template":"","layout":"","page_size":"20","child_dir":"1","child_template":"","child_layout":"","child_model":"1","user_browse":"0","user_add":"10"}', '', 1340510805, 1340510805, NULL, NULL, NULL);
INSERT INTO `elem` VALUES(20, NULL, 'form', NULL, '留言板', '{"\u8d27\u7269\u540d\u79f0":"\u91c7\u8d2d\u6f14\u793a","\u6570\u91cf":"1000","\u5355\u4f4d":"\u4e2a","\u8be2\u4ef7\u6709\u6548\u671f":"30","\u4e3b\u9898":"\u7d27\u6025\u91c7\u8d2d\uff01","\u7559\u8a00\u5185\u5bb9":"\u8bf7\u5feb\u62a5\u4ef7","\u8054\u7cfb\u4eba":"brant","\u8054\u7cfb\u7535\u8bdd":"201919","_fm_p__0_en":"false"}', NULL, 1340510534, 1340510534, NULL, NULL, NULL);


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
