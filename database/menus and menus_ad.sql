-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL 版本:                  10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table pjh_company.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单中文名称',
  `ename` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单英文简写，方便后端读取',
  `ename2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单英文名称，用于前端页面展示',
  `sort1` tinyint(11) NOT NULL COMMENT '所属一级菜单分类在导航栏中的排序',
  `sort2` tinyint(11) NOT NULL COMMENT '二级菜单排序',
  `isort` tinyint(11) DEFAULT NULL COMMENT '菜单分类在首页中模块展示的顺序',
  `href` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单链接',
  `txt` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单分类简述',
  `etxt` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单分类英文简述',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单分类小图标（站内图片/字体图标）',
  `text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单分类文字介绍',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单分类图片相对路径，存放在public/images下',
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单页面关键词，用于meta标签',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单页面描述，用于meta标签',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ename` (`ename`),
  UNIQUE KEY `order` (`sort1`,`sort2`) USING BTREE,
  UNIQUE KEY `isort` (`isort`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='菜单信息表';

-- Dumping data for table pjh_company.menus: ~19 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `name`, `ename`, `ename2`, `sort1`, `sort2`, `isort`, `href`, `txt`, `etxt`, `img`, `text`, `image`, `keywords`, `description`) VALUES
	(1, '产品服务', 'pro', 'Product Service', 1, 0, 1, '/product', NULL, NULL, 'dropbox', NULL, NULL, NULL, NULL),
	(2, '3D打印产品', 'pro_3dp', '3D Printing  Products', 1, 1, NULL, '/product/pro_3dp', '3D打印产品简介', NULL, 'print', '', 'images/icon_3dprint.png', '我是产品关键词组', '我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉'),
	(3, 'AR产品', 'pro_ar', 'AR Products', 1, 2, NULL, '/product/pro_ar', 'AR产品简介', NULL, 'drupal', '', 'images/icon_ar.png', '我是产品关键词组', '我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉'),
	(4, '机器人产品', 'pro_robot', 'Robot Products', 1, 3, NULL, '/product/pro_robot', '机器人产品简介', NULL, 'github-alt', '', 'images/icon_robot.png', '我是产品关键词组', '我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉'),
	(5, '天文产品', 'pro_ast', 'Astronomy Products', 1, 4, NULL, '/product/pro_ast', '天文产品简介', NULL, 'globe', '', 'images/icon_astronomy.png', '我是产品关键词组', '我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉我是产品描述巴拉巴拉'),
	(11, '新闻资讯', 'info', 'Information', 3, 0, NULL, '/information', NULL, NULL, 'newspaper-o', NULL, NULL, NULL, NULL),
	(12, '公司新闻', 'info_com', 'News', 3, 1, 3, '/information/company', NULL, NULL, 'home', NULL, NULL, NULL, NULL),
	(13, '行业资讯', 'info_ind', 'Industry Information', 3, 2, 4, '/information/industry', NULL, NULL, 'list-alt', NULL, NULL, NULL, NULL),
	(14, '关于我们', 'about', 'About Us', 4, 0, NULL, '/about', NULL, NULL, 'paper-plane', NULL, NULL, '公司关键词组', '公司简要描述'),
	(16, '活动报名', 'act', 'Activity Registration', 5, 0, NULL, '/active', NULL, NULL, 'gift', NULL, NULL, NULL, NULL),
	(17, '创享课程', 'cor', 'Creation Course', 2, 0, 2, '/course', '让您的孩子变得更聪明，让您的孩子在好玩中成长', 'Make your children smarter, and let your children grow in fun', 'briefcase', NULL, NULL, NULL, NULL),
	(18, 'AR课程', 'cor_ar', 'AR Courses', 2, 1, NULL, '/course/cor_ar', '智能机器人创意搭建和编程', NULL, 'reddit-alien', '<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>', 'images/course1.png', '我是课程关键词组', '我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉'),
	(19, '天文课程', 'cor_ast', 'Astronomy Courses', 2, 2, NULL, '/course/cor_ast', '立体地了解宇宙的奥秘', NULL, 'globe', '<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>', 'images/course2.png', '我是课程关键词组', '我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉'),
	(20, '3D打印课程', 'cor_3dp', '3D Printing Courses', 2, 3, NULL, '/course/cor_3dp', '3D打印“智”造', NULL, 'print', '<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>', 'images/course3.png', '我是课程关键词组', '我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉'),
	(21, '机器人课程', 'cor_robot', 'Robot Courses', 2, 4, NULL, '/course/cor_robot', '培养孩子创造力', NULL, 'video-camera', '<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>\r\n<p>我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉</p>', 'images/course4.png', '我是课程关键词组', '我是课程描述巴拉巴拉我是课程描述巴拉巴拉我是课程描述巴拉巴拉'),
	(24, '首页', 'index', NULL, 0, 9, NULL, '/index', NULL, NULL, NULL, NULL, NULL, '公司关键词词组词组词组', '用于SEO的公司描述描述描述描述描述描述'),
	(31, '未开始活动', 'act_ready', NULL, 5, 2, NULL, '/active/ready', NULL, NULL, 'battery-full', NULL, NULL, NULL, NULL),
	(32, '进行中活动', 'act_start', NULL, 5, 1, NULL, '/active/start', NULL, NULL, 'battery-half', NULL, NULL, NULL, NULL),
	(33, '已结束活动', 'act_end', NULL, 5, 3, NULL, '/active/end', NULL, NULL, 'battery-empty', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table pjh_company.menus_ad
CREATE TABLE IF NOT EXISTS `menus_ad` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单中文名称',
  `ename` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单英文简写，方便后端读取',
  `sort1` tinyint(11) NOT NULL COMMENT '一级菜单排序',
  `sort2` tinyint(11) NOT NULL COMMENT '二级菜单排序',
  `sort3` tinyint(11) NOT NULL COMMENT '三级菜单排序',
  `href` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单链接',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sort` (`sort1`,`sort2`,`sort3`),
  UNIQUE KEY `menus_ad_ename_unique` (`ename`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='后台菜单信息表';

-- Dumping data for table pjh_company.menus_ad: 17 rows
/*!40000 ALTER TABLE `menus_ad` DISABLE KEYS */;
INSERT INTO `menus_ad` (`id`, `name`, `ename`, `sort1`, `sort2`, `sort3`, `href`) VALUES
	(1, '用户', NULL, 1, 0, 0, '/admin/usersManage'),
	(2, '会员设置', NULL, 1, 1, 0, NULL),
	(3, '会员管理', 'user', 1, 1, 1, '/admin/user/userSet/userManage'),
	(4, '运营', NULL, 2, 0, 0, '/admin/run'),
	(5, '系统', NULL, 3, 0, 0, '/admin/system'),
	(6, '发布设置', NULL, 2, 1, 0, NULL),
	(7, '模块设置', NULL, 2, 2, 0, NULL),
	(8, '文章管理', 'article', 2, 1, 1, '/admin/run/publishSet/articleManage'),
	(9, '活动管理', 'active', 2, 1, 2, '/admin/run/publishSet/activeManage'),
	(10, '课程管理', 'course', 2, 1, 3, '/admin/run/publishSet/courseManage'),
	(11, '产品管理', 'product', 2, 1, 4, '/admin/run/publishSet/productManage'),
	(12, '广告位管理', 'advertise', 2, 2, 1, '/admin/run/publishSet/advertiseManage'),
	(13, '公司信息管理', 'company', 2, 2, 2, '/admin/run/publishSet/companyManage'),
	(14, '管理员设置', NULL, 3, 1, 0, NULL),
	(15, '角色管理', 'role', 3, 1, 1, '/admin/system/adminSet/roleManage'),
	(16, '管理员管理', 'admin', 3, 1, 2, '/admin/system/adminSet/adminManage'),
	(17, '后台首页', 'index', 0, 0, 0, '/admin');
/*!40000 ALTER TABLE `menus_ad` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
