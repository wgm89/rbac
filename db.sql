CREATE TABLE `node` (
     `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(20) NOT NULL COMMENT '节点name',
     `pid` int(20) NOT NULL COMMENT '父id',
     `remark` varchar(255) DEFAULT NULL COMMENT '菜单名',
     `sort` smallint(6) unsigned DEFAULT '999' COMMENT '排序',
     `controller` varchar(50) DEFAULT '' COMMENT '控制器',
     `action` varchar(25) DEFAULT '' COMMENT '方法',
     PRIMARY KEY (`id`),
     KEY `name` (`name`),
     KEY `sort` (`sort`),
     KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='节点表'

CREATE TABLE `role` (
     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(20) NOT NULL COMMENT '权限名',
     `pid` smallint(6) DEFAULT NULL COMMENT '父id',
     `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态',
     `remark` varchar(255) DEFAULT NULL COMMENT '权限说明',
     PRIMARY KEY (`id`),
     KEY `pid` (`pid`),
     KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='角色表'

CREATE TABLE `role_user` (
     `role_id` mediumint(9) NOT NULL,
     `user_id` int(11) NOT NULL,
     PRIMARY KEY (`user_id`,`role_id`),
     KEY `group_id` (`role_id`),
     KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色表'

CREATE TABLE `access` (
     `role_id` smallint(6) unsigned NOT NULL,
     `node_id` smallint(6) unsigned NOT NULL,
     PRIMARY KEY (`role_id`,`node_id`),
     KEY `groupId` (`role_id`),
     KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色权限表'
