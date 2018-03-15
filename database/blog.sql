
drop table IF  EXISTS `chj_blog`;
create table if not exists `chj_blog` (
	`id` int unsigned auto_increment comment '博客id',
	`user_id` int unsigned not null  comment '用户id',
	`section_id` int unsigned not null comment '部门id',
	`title` varchar(50) not null comment '博客标题',
	`content` varchar(2048) not null comment '博客内容',
	`start_time` int unsigned not null comment '开始时间',	
	`deadline` int unsigned default 0 comment '结束时间',
	`address` varchar(100) not null comment '地点',
	`contact_phone` varchar(100) null comment '联系电话',
	`create_time` int unsigned default 0 comment '创建时间',
	`update_time` int unsigned default 0 comment '更新时间',
	`discuss` int unsigned default 0 comment '评论数',
	`approve` int unsigned default 0 comment '点赞数',
	`status` tinyint(1) unsigned default 1 comment '状态  1正常、0禁用',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT '博客表';


drop table if exists `chj_blog_img`;
create table if not exists `chj_blog_img`(
	`id` int unsigned auto_increment comment '图片id',
	`blog_id` int unsigned not null comment '博客id',
	`url` varchar(50) not null comment 'url地址',
	`status` tinyint(1) unsigned default 1 comment '状态  1正常、0禁用',
	PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT '博客图片表';

drop table if exists `chj_blog_discuss`;
create table if not exists `chj_blog_discuss`(
	`id` int  unsigned not null AUTO_INCREMENT COMMENT '表id',
	`art_id` int unsigned not null comment '文章id',
	`parent_id` int unsigned default 0 comment '父评论id',
	`user_id` int unsigned not null comment '评论用户id',	
	`content` varchar(255) not null comment '评论内容',
	`grade` tinyint(1) not null default 4 comment '评分',
	`addtime` int  unsigned not null comment '评论时间',
	`is_show` tinyint(1)  unsigned not null default 1 COMMENT '是否显示 1 是 0否', 
	primary key (`id`)
)engine=Innodb default charset= utf8mb4 COMMENT '评论表';

drop table if exists `chj_blog_approve`;
create table if not exists `chj_blog_approve`(
	`id` int  unsigned not null AUTO_INCREMENT COMMENT '表id',
	`art_id` int unsigned not null comment '文章id',
	`user_id` int unsigned not null comment '点赞用户id',	
	`addtime` int  unsigned not null comment '点赞时间',
	`is_approve` tinyint(1)  unsigned not null default 1 COMMENT '是否点赞 1 是 0否', 
	`is_show` tinyint(1)  unsigned not null default 1 COMMENT '是否显示 1 是 0否',
	primary key (`id`)
)engine=Innodb default charset= utf8mb4 COMMENT '点赞表';


drop table if exists `chj_section`;
create table if not exists `chj_section`(
	`id` int unsigned auto_increment comment '部门id',
	`school_id` int unsigned not null comment '学校id',
	`name` varchar(50) not null comment '部门名称',
	`logo` varchar(50) not null comment '部门logo',
	`leader` varchar(50) not null comment '部门负责人',
	`create_time` int unsigned default 0 comment '创建时间',
	`update_time` int unsigned default 0 comment '更新时间',
	`discuss` int unsigned default 0 comment '评论数',
	`approve` int unsigned default 0 comment '点赞数',
	`status` tinyint(1) unsigned default 1 comment '状态  1正常、0禁用',
	PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT '部门表';

drop table if exists `chj_user`;
create table if not exists `chj_user`(
	`id` int unsigned not null auto_increment COMMENT '用户id',
	`name`  varchar(100) not null  COMMENT '用户名',
	`opend_id` varchar(100) not null comment '微信opendid',
	`create_time` int unsigned default 0 comment '创建时间',
	`update_time` int unsigned default 0 comment '更新时间',	
	`status` tinyint(1) unsigned default 1 comment '状态  1正常、0禁用',
	primary key (`id`)
)engine=Innodb default charset= utf8mb4 COMMENT '用户表';

drop table if exists `chj_user_attr`;
create table if not exists `chj_user_attr`(
	`user_id` int unsigned not null  COMMENT '用户id',
	`level`  int unsigned default 0  COMMENT '经验',
	`score`  int unsigned default 0 comment '积分',
	primary key (`user_id`)
)engine=Innodb default charset= utf8mb4 COMMENT '用户属性表';


drop table if exists `chj_level`;
create table if not exists `chj_level`(
	`id` int unsigned not null auto_increment COMMENT '经验id',
	`user_id` int unsigned not null  COMMENT '用户id',
	`blog_id` int unsigned default 0  COMMENT '博客id',
	`level`  int  default 0  COMMENT '经验,正数增加、负数使用',
	`use` varchar(255) not null comment '用途',
	`create_time` int unsigned default 0 comment '创建时间',
	`status` tinyint(1) unsigned default 1 comment '状态  1正常、0禁用',
	primary key (`id`)
)engine=Innodb default charset= utf8mb4 COMMENT '经验表';

drop table if exists `chj_score`;
create table if not exists `chj_score`(
	`id` int unsigned not null auto_increment COMMENT '积分id',
	`user_id` int unsigned not null  COMMENT '用户id',
	`blog_id` int unsigned default 0  COMMENT '博客id',
	`score`  int  default 0 comment '积分,正数增加、负数使用',
	`use` varchar(255) not null comment '用途',
	`create_time` int unsigned default 0 comment '创建时间',
	`status` tinyint(1) unsigned default 1 comment '状态  1正常、0禁用',
	primary key (`id`)
)engine=Innodb default charset= utf8mb4 COMMENT '积分表';

drop table if exists `chj_system`;
create table if not exists `chj_system`(
	`id` int unsigned not null auto_increment COMMENT '表id',
	`content`  varchar(2048) not null  COMMENT '值',
	`create_time` int unsigned default 0 comment '创建时间',
	`update_time` int unsigned default 0 comment '更新时间',	
	`status` tinyint(1) unsigned default 1 comment '状态  1正常、0禁用',
	primary key (`id`)
)engine=Innodb default charset= utf8mb4 COMMENT '系统表';