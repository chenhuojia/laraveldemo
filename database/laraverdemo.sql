-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-31 18:12:19
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laraverdemo`
--

-- --------------------------------------------------------

--
-- 表的结构 `action_logs`
--

CREATE TABLE IF NOT EXISTS `action_logs` (
  `id` int(10) unsigned NOT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT '管理员id',
  `data` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '操作日志类型,1 权限操作日志, 2 登录操作日志'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `avatr` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `login_count` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_ip` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注册ip',
  `last_login_ip` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录IP',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态: 1 正常, 2=>禁止',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `avatr`, `login_count`, `create_ip`, `last_login_ip`, `status`, `created_at`, `updated_at`) VALUES
(3, 'admin', '$2y$10$n2IeKkWuJOHtDRA.hQ1ymujdzeiAF5eKPg2LphIRMrZZMJP4GMAMm', NULL, 3, '127.0.0.1', '127.0.0.1', 1, '2018-01-26 23:20:22', '2018-01-31 00:50:16'),
(5, 'root', '$2y$10$i2TTBAPQYN4tfksYkPDXF.rePiSk.8bgNKs/hirCQyjBJMrBS1n.q', NULL, 123, '127.0.0.1', '127.0.0.1', 1, '2018-01-29 23:28:42', '2018-01-31 01:13:04');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(10) unsigned NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`id`, `admin_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2018-01-31 00:10:41', '2018-01-31 00:10:41'),
(2, 3, 2, '2018-01-31 00:10:49', '2018-01-31 00:10:49');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '角色描述',
  `order` int(10) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态: 1 正常, 2=>禁止',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `remark`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '超级管理员', '超级管理员', 255, 1, '2018-01-30 23:51:49', '2018-01-30 23:51:49'),
(2, '管理员', '管理员', 0, 1, '2018-01-30 23:51:58', '2018-01-30 23:51:58');

-- --------------------------------------------------------

--
-- 表的结构 `role_auth`
--

CREATE TABLE IF NOT EXISTS `role_auth` (
  `id` int(10) unsigned NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `rule_id` int(11) NOT NULL COMMENT '权限id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `role_auth`
--

INSERT INTO `role_auth` (`id`, `role_id`, `rule_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(2, 1, 2, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(3, 1, 3, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(4, 1, 6, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(5, 1, 7, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(6, 1, 8, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(7, 1, 9, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(8, 1, 10, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(9, 1, 4, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(10, 1, 11, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(11, 1, 12, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(12, 1, 13, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(13, 1, 14, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(14, 1, 15, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(15, 1, 5, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(16, 1, 16, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(17, 1, 17, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(18, 1, 18, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(19, 1, 19, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(20, 1, 20, '2018-01-31 00:10:05', '2018-01-31 00:10:05'),
(21, 2, 2, '2018-01-31 00:10:28', '2018-01-31 00:10:28'),
(22, 2, 5, '2018-01-31 00:10:28', '2018-01-31 00:10:28'),
(23, 2, 16, '2018-01-31 00:10:28', '2018-01-31 00:10:28'),
(24, 2, 17, '2018-01-31 00:10:28', '2018-01-31 00:10:28'),
(25, 2, 18, '2018-01-31 00:10:28', '2018-01-31 00:10:28'),
(26, 2, 19, '2018-01-31 00:10:29', '2018-01-31 00:10:29'),
(27, 2, 20, '2018-01-31 00:10:29', '2018-01-31 00:10:29'),
(28, 1, 21, '2018-01-31 00:58:42', '2018-01-31 00:58:42'),
(29, 1, 22, '2018-01-31 00:58:43', '2018-01-31 00:58:43');

-- --------------------------------------------------------

--
-- 表的结构 `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限名称',
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限路由',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级权限',
  `is_hidden` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `sort` int(10) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态: 1 正常, 2=>禁止',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fonts` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单fonts图标'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `rules`
--

INSERT INTO `rules` (`id`, `name`, `route`, `parent_id`, `is_hidden`, `sort`, `status`, `created_at`, `updated_at`, `fonts`) VALUES
(1, '后台首页', 'admin.index', 0, 1, 0, 1, '2018-01-30 23:52:34', '2018-01-30 23:52:34', NULL),
(2, '后台授权', NULL, 0, 1, 0, 1, '2018-01-30 23:53:16', '2018-01-30 23:53:16', NULL),
(3, '管理员管理', 'admins.index', 2, 0, 255, 1, '2018-01-30 23:54:03', '2018-01-31 00:03:27', NULL),
(4, '角色管理', 'role.index', 2, 0, 255, 1, '2018-01-30 23:54:34', '2018-01-31 00:03:51', NULL),
(5, '权限管理', 'rule.index', 2, 0, 255, 1, '2018-01-30 23:55:09', '2018-01-31 00:04:01', NULL),
(6, '添加管理员页面', 'admins.create', 3, 0, 0, 1, '2018-01-30 23:56:35', '2018-01-30 23:59:13', NULL),
(7, '添加管理员', 'admins.store', 3, 1, 0, 1, '2018-01-30 23:58:42', '2018-01-30 23:58:42', NULL),
(8, '修改管理员页面', 'admins.show', 3, 1, 0, 1, '2018-01-30 23:59:51', '2018-01-30 23:59:51', NULL),
(9, '修改管理员', 'admins.update', 3, 1, 0, 1, '2018-01-31 00:00:19', '2018-01-31 00:00:19', NULL),
(10, '删除管理员', 'admins.destroy', 3, 1, 0, 1, '2018-01-31 00:01:14', '2018-01-31 00:01:14', NULL),
(11, '添加角色页面', 'role.create', 4, 1, 0, 1, '2018-01-31 00:05:09', '2018-01-31 00:05:09', NULL),
(12, '添加角色', 'role.store', 4, 1, 0, 1, '2018-01-31 00:05:35', '2018-01-31 00:05:35', NULL),
(13, '修改角色页面', 'role.show', 4, 1, 0, 1, '2018-01-31 00:06:00', '2018-01-31 00:06:00', NULL),
(14, '修改角色', 'role.update', 4, 1, 0, 1, '2018-01-31 00:06:26', '2018-01-31 00:06:26', NULL),
(15, '删除角色', 'role.destory', 4, 1, 0, 1, '2018-01-31 00:07:11', '2018-01-31 00:07:11', NULL),
(16, '添加权限页面', 'rule.create', 5, 1, 0, 1, '2018-01-31 00:07:43', '2018-01-31 00:07:43', NULL),
(17, '添加权限', 'rule.store', 5, 1, 0, 1, '2018-01-31 00:08:06', '2018-01-31 00:08:06', NULL),
(18, '修改权限页面', 'rule.show', 5, 1, 0, 1, '2018-01-31 00:08:26', '2018-01-31 00:08:26', NULL),
(19, '修改权限', 'rule.update', 5, 1, 0, 1, '2018-01-31 00:08:50', '2018-01-31 00:08:50', NULL),
(20, '删除权限', 'role.destory', 5, 1, 0, 1, '2018-01-31 00:09:19', '2018-01-31 00:09:19', NULL),
(21, '权限设置页面', 'role.access', 4, 1, 0, 1, '2018-01-31 00:52:58', '2018-01-31 00:52:58', NULL),
(22, '权限设置', 'role.group.access', 4, 1, 0, 1, '2018-01-31 00:53:18', '2018-01-31 00:53:18', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `openid` varchar(50) NOT NULL COMMENT '微信openID',
  `nickname` varchar(50) DEFAULT NULL COMMENT '微信昵称',
  `extend` varchar(255) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `openid`, `nickname`, `extend`, `delete_time`, `create_time`, `update_time`) VALUES
(1, '12345544', '323', NULL, NULL, NULL, NULL),
(2, '123455434', NULL, NULL, NULL, NULL, NULL),
(4, 'oJxgY42wBPrgJ1Pa2hSPut3mn1aI', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_logs_admin_id_index` (`admin_id`),
  ADD KEY `action_logs_type_index` (`type`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_status_index` (`status`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_role_admin_id_index` (`admin_id`),
  ADD KEY `admin_role_role_id_index` (`role_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_name_index` (`name`(191)),
  ADD KEY `roles_status_index` (`status`);

--
-- Indexes for table `role_auth`
--
ALTER TABLE `role_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_auth_role_id_index` (`role_id`),
  ADD KEY `role_auth_rule_id_index` (`rule_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rules_name_index` (`name`(191)),
  ADD KEY `rules_parent_id_index` (`parent_id`),
  ADD KEY `rules_is_hidden_index` (`is_hidden`),
  ADD KEY `rules_status_index` (`status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `openid` (`openid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role_auth`
--
ALTER TABLE `role_auth`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
