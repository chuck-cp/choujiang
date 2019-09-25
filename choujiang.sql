/*
Navicat MySQL Data Transfer

Source Server         : 10.240.0.61
Source Server Version : 50622
Source Host           : 10.240.0.61:3306
Source Database       : choujiang

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2019-09-18 09:13:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yl_activity`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity`;
CREATE TABLE `yl_activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '活动标题',
  `subtitle` varchar(100) NOT NULL DEFAULT '' COMMENT '活动副标题',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态(0、未发布 1、正常 2、已结束)',
  `start_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '活动开始时间',
  `end_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '活动结束时间',
  `prize_time` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '开奖时间(1、上午 2、下午)',
  `browse_number` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `member_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '参与人数',
  `prize_code_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发放的抽奖码数量',
  `prize_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '获奖次数',
  `receive_prize_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领奖次数',
  `is_choice` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示选择题(1、显示)',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示必答题(1、显示)',
  `first_date` date NOT NULL COMMENT '首次开奖时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='活动表';

-- ----------------------------
-- Records of yl_activity
-- ----------------------------
INSERT INTO `yl_activity` VALUES ('15', '提现200审核成功', '胡家奇-诗选1111', '0', '2019-08-26', '2019-08-27', '1', '0', '0', '0', '22', '0', '0', '0', '2019-08-26');
INSERT INTO `yl_activity` VALUES ('16', '其味无穷', '驱蚊器翁', '1', '2019-08-28', '2019-08-28', '1', '0', '0', '0', '1', '0', '0', '0', '2019-08-28');

-- ----------------------------
-- Table structure for `yl_activity_config`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_config`;
CREATE TABLE `yl_activity_config` (
  `id` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL COMMENT '问题标题',
  `descition` varchar(255) NOT NULL DEFAULT '' COMMENT '问题描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='活动配置表';

-- ----------------------------
-- Records of yl_activity_config
-- ----------------------------
INSERT INTO `yl_activity_config` VALUES ('award_acceptance_period', '7', '领取奖品失效时长');
INSERT INTO `yl_activity_config` VALUES ('cash_to_coupon_rate', '1.2', '现金兑优惠券比例');
INSERT INTO `yl_activity_config` VALUES ('customer_service_telephone', '400-989-1819', '客服电话');
INSERT INTO `yl_activity_config` VALUES ('every_prize_number', '3', '每人每期每次可获奖次数');
INSERT INTO `yl_activity_config` VALUES ('issue_prize_number', '2', '每人每期活动可获奖次数');
INSERT INTO `yl_activity_config` VALUES ('maximum_winning_number', '8', '每人每期获得最大的获奖码');

-- ----------------------------
-- Table structure for `yl_activity_count`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_count`;
CREATE TABLE `yl_activity_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动统计表ID',
  `prize_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '奖品ID',
  `prize_title` varchar(30) NOT NULL DEFAULT '0' COMMENT '奖项名称',
  `prize_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '中奖人数',
  `receive_prize_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领奖人数',
  `prize_date` date NOT NULL COMMENT '开奖时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `count_id` (`activity_id`,`prize_date`,`prize_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=utf8mb4 COMMENT='活动统计表';

-- ----------------------------
-- Records of yl_activity_count
-- ----------------------------
INSERT INTO `yl_activity_count` VALUES ('256', '2', '7', '一等奖-2', '3', '0', '2019-07-28');
INSERT INTO `yl_activity_count` VALUES ('259', '2', '8', '二等奖-2', '3', '1', '2019-07-28');
INSERT INTO `yl_activity_count` VALUES ('262', '2', '7', '一等奖-2', '3', '0', '2019-07-30');
INSERT INTO `yl_activity_count` VALUES ('265', '2', '8', '二等奖-2', '3', '1', '2019-07-30');
INSERT INTO `yl_activity_count` VALUES ('268', '2', '7', '一等奖-2', '1', '0', '2019-07-31');
INSERT INTO `yl_activity_count` VALUES ('269', '2', '8', '二等奖-2', '2', '1', '2019-07-31');

-- ----------------------------
-- Table structure for `yl_activity_date`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_date`;
CREATE TABLE `yl_activity_date` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
  `prize_date` date NOT NULL COMMENT '开奖日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `activity_id` (`prize_date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COMMENT='活动表';

-- ----------------------------
-- Records of yl_activity_date
-- ----------------------------
INSERT INTO `yl_activity_date` VALUES ('55', '15', '2019-09-01');
INSERT INTO `yl_activity_date` VALUES ('56', '15', '2019-09-02');
INSERT INTO `yl_activity_date` VALUES ('57', '16', '2019-09-03');

-- ----------------------------
-- Table structure for `yl_activity_number_count`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_number_count`;
CREATE TABLE `yl_activity_number_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动统计表ID',
  `prize_date` date NOT NULL COMMENT '开奖时间',
  `member_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册用户数',
  `member_activity_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '参加活动的人数',
  `new_member_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '新增注册用户',
  `new_member_activity_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '新增参加活动人数',
  `total_member_activity_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当天参加活动的总人数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='活动用户数量统计表';

-- ----------------------------
-- Records of yl_activity_number_count
-- ----------------------------
INSERT INTO `yl_activity_number_count` VALUES ('1', '16', '2019-08-28', '1', '1', '1', '1', '1');
INSERT INTO `yl_activity_number_count` VALUES ('2', '16', '2019-08-29', '2', '2', '2', '2', '2');
INSERT INTO `yl_activity_number_count` VALUES ('3', '16', '2019-08-30', '3', '3', '3', '3', '3');

-- ----------------------------
-- Table structure for `yl_activity_prize`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_prize`;
CREATE TABLE `yl_activity_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
  `prize_title` varchar(30) NOT NULL COMMENT '奖项名称',
  `prize_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '奖品数量',
  `prize_name` varchar(30) NOT NULL COMMENT '奖品名称',
  `prize_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '奖品类型(1、实物 2、虚拟)',
  `prize_image` varchar(255) NOT NULL COMMENT '奖品图片',
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COMMENT='活动获奖详情表';

-- ----------------------------
-- Records of yl_activity_prize
-- ----------------------------
INSERT INTO `yl_activity_prize` VALUES ('1', '1', '一等奖', '2', '苹果手机', '1', '');
INSERT INTO `yl_activity_prize` VALUES ('2', '1', '二等奖', '10', '现金100元', '2', '');
INSERT INTO `yl_activity_prize` VALUES ('3', '1', '三等奖', '20', '现金10元', '2', '');
INSERT INTO `yl_activity_prize` VALUES ('7', '2', '一等奖-2', '3', '荣耀V20', '1', 'www.baidu.com');
INSERT INTO `yl_activity_prize` VALUES ('8', '2', '二等奖-2', '5', '蓝牙耳机', '1', 'www.baidu.com');
INSERT INTO `yl_activity_prize` VALUES ('9', '2', '三等奖-2', '10', '现金100元', '2', 'www.baidu.com');
INSERT INTO `yl_activity_prize` VALUES ('10', '11', '四等奖', '1', '111', '1', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1563175437.jpeg');
INSERT INTO `yl_activity_prize` VALUES ('19', '11', '五等奖', '2', '222', '1', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1563431042.jpeg');
INSERT INTO `yl_activity_prize` VALUES ('21', '12', '二等', '22', '5464', '1', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564295740.jpg');
INSERT INTO `yl_activity_prize` VALUES ('22', '13', '一等奖', '1', '1', '1', 'http://f0.1818lao.com/img/luckdraw/1908/1566891189.jpeg');
INSERT INTO `yl_activity_prize` VALUES ('23', '14', '二等', '22', '5464', '1', '');
INSERT INTO `yl_activity_prize` VALUES ('24', '15', '二等', '22', '5464', '1', '');
INSERT INTO `yl_activity_prize` VALUES ('25', '16', '1', '1', '1', '1', '');

-- ----------------------------
-- Table structure for `yl_activity_question`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_question`;
CREATE TABLE `yl_activity_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '问题标题',
  `answer` varchar(255) NOT NULL COMMENT '所有答案(多个以逗号分割)',
  `correct_answer` varchar(100) NOT NULL COMMENT '正确答案',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '问题描述',
  `select_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型(1、单选 2、多选)',
  `question_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '题型(1、必答题 2、选答题)',
  `prize_code_number` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '获得中奖码数量',
  `is_activity` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否在活动页显示(1、显示)',
  `is_prize` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否在领奖品页显示(1、显示)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of yl_activity_question
-- ----------------------------
INSERT INTO `yl_activity_question` VALUES ('1', '中奖问题', '今天中奖,明天中奖,后天中奖,不中奖', '明天中奖', '中奖描叙', '2', '1', '1', '1', '1');
INSERT INTO `yl_activity_question` VALUES ('2', '胡家奇-诗选', '胡家奇-诗选1,胡家奇-诗选2,胡家奇-诗选4,胡家奇-诗选3', '胡家奇-诗选2', '胡家奇-诗选111', '1', '2', '1', '1', '1');
INSERT INTO `yl_activity_question` VALUES ('3', '测试修改', '测试修改1,测试修改2', '测试修改2', '测试修改111', '1', '1', '1', '1', '1');
INSERT INTO `yl_activity_question` VALUES ('16', '胡家奇-诗选111', '测试修改1,测试修改2', '测试修改2', '胡家奇-诗选111111', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for `yl_activity_roster`
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_roster`;
CREATE TABLE `yl_activity_roster` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
  `activity_title` varchar(100) NOT NULL COMMENT '活动标题',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `member_name` varchar(10) NOT NULL DEFAULT '' COMMENT '姓名',
  `prize_code` varchar(30) NOT NULL COMMENT '中奖号码',
  `prize_date` date NOT NULL COMMENT '中奖期数',
  `prize_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '奖品ID',
  `prize_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '奖品类型(1、实物 2、虚拟)',
  `prize_title` varchar(50) NOT NULL COMMENT '奖项名称',
  `prize_name` varchar(50) NOT NULL DEFAULT '' COMMENT '奖品名称',
  `prize_image` varchar(255) NOT NULL COMMENT '活动图片',
  `prize_time` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '开奖时间(1、上午 2、下午)',
  `prize_code_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '抽奖码获取时间',
  `prize_coupon` varchar(5) NOT NULL DEFAULT '0' COMMENT '现金折合优惠券的金额',
  `receive` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否领取(0、未领取 1、已领取)',
  `receive_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '领取时间',
  `receive_address` varchar(255) NOT NULL DEFAULT '' COMMENT '收货地址',
  `receive_member_mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人手机号',
  `receive_member_name` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `receive_identity_number` varchar(50) NOT NULL DEFAULT '' COMMENT '收货人身份证号',
  `receive_prize_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '领取的奖品类型(1、实物 2、现金 3、购物款)',
  `express_name` varchar(50) NOT NULL DEFAULT '' COMMENT '快递名称',
  `express_number` varchar(50) NOT NULL DEFAULT '' COMMENT '快递单号',
  PRIMARY KEY (`id`),
  KEY `count_id` (`activity_id`,`member_id`) USING BTREE,
  KEY `prize_date` (`prize_date`),
  KEY `member_id` (`member_id`,`prize_code_date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=879 DEFAULT CHARSET=utf8mb4 COMMENT='活动获奖详情表';

-- ----------------------------
-- Records of yl_activity_roster
-- ----------------------------
INSERT INTO `yl_activity_roster` VALUES ('385', '2', '天天抽奖天天兑奖2', '18', '', '505461056', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('386', '2', '天天抽奖天天兑奖2', '29', '', '372994251', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('387', '2', '天天抽奖天天兑奖2', '32', '', '848492111', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('388', '2', '天天抽奖天天兑奖2', '27', '', '149284544', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('389', '2', '天天抽奖天天兑奖2', '24', '', '223423470', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('390', '2', '天天抽奖天天兑奖2', '30', '', '710728846', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('391', '2', '天天抽奖天天兑奖2', '26', '', '535459281', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('392', '2', '天天抽奖天天兑奖2', '22', '', '862376027', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('393', '2', '天天抽奖天天兑奖2', '31', '', '16676454', '2019-07-30', '24', '1', '一等奖', '华为手机', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('394', '2', '天天抽奖天天兑奖2', '28', '', '436966564', '2019-07-30', '25', '2', '二等奖', '100', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('395', '2', '天天抽奖天天兑奖2', '33', '', '285708309', '2019-07-30', '25', '2', '二等奖', '100', 'http://www.baidu.com/img/bd_logo1.png', '1', '2019-07-27 10:12:43', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('396', '2', '天天抽奖天天兑奖3', '34', '', '531620695', '2019-07-30', '28', '1', '1', '鞋子', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 14:15:20', '0', '1', '2019-07-30 10:27:35', '好多好多继续进行解决', '15988663234', '曹结结实实', '142227198704291011', '1', '圆通速递', '806726090788304893');
INSERT INTO `yl_activity_roster` VALUES ('397', '2', '天天抽奖天天兑奖3', '28', '', '838282491', '2019-07-30', '28', '1', '1', '鞋子', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 14:15:05', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('398', '2', '天天抽奖天天兑奖3', '23', '', '568177244', '2019-07-30', '28', '1', '1', '鞋子', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 16:05:16', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('399', '2', '天天抽奖天天兑奖3', '17', '', '307531010', '2019-07-30', '28', '1', '1', '鞋子', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 10:37:40', '0', '1', '2019-07-30 11:01:43', '北京市丰台区航丰路1号', '18410062437', '小巫', '230184198711571425', '1', '申通快递', '3717994571449');
INSERT INTO `yl_activity_roster` VALUES ('400', '2', '天天抽奖天天兑奖3', '26', '', '225749007', '2019-07-30', '28', '1', '1', '鞋子', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 14:10:32', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('401', '2', '天天抽奖天天兑奖3', '34', '', '308118178', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 13:45:53', '0', '1', '2019-08-13 11:15:32', 'Jjdjfj', '18600918319', '15811103076', '130424198510202216', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('402', '2', '天天抽奖天天兑奖3', '21', '', '835277124', '2019-07-30', '29', '2', '二等奖', '100', '', '1', '2019-07-30 13:53:40', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('403', '2', '天天抽奖天天兑奖3', '17', '', '534319512', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-30 15:28:36', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('404', '2', '天天抽奖天天兑奖3', '28', '', '75878659', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 14:15:05', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('405', '2', '天天抽奖天天兑奖3', '23', '', '729724003', '2019-07-30', '29', '2', '二等奖', '100', '', '1', '2019-07-29 16:05:16', '130', '1', '2019-07-31 15:40:57', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('406', '2', '天天抽奖天天兑奖3', '35', '', '74356680', '2019-07-30', '29', '2', '二等奖', '100', '', '1', '2019-07-30 16:06:25', '130', '1', '2019-08-01 14:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('407', '2', '天天抽奖天天兑奖3', '34', '', '80930684', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 14:14:38', '0', '1', '2019-07-31 16:30:31', '是计算机技术', '13835077853', '擦设计师', '142227198704191011', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('408', '2', '天天抽奖天天兑奖3', '17', '', '72435390', '2019-07-30', '29', '2', '二等奖', '100', '', '1', '2019-07-29 10:37:40', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('409', '2', '天天抽奖天天兑奖3', '34', '', '362880678', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 14:16:11', '0', '1', '2019-08-13 11:16:57', 'Hjdjjf', '18600918319', 'Bzjjcc', '130424198510202218', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('410', '2', '天天抽奖天天兑奖3', '21', '', '699875738', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-30 13:47:22', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('411', '2', '天天抽奖天天兑奖3', '26', '', '381885092', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 14:10:32', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('412', '2', '天天抽奖天天兑奖3', '17', '', '412737992', '2019-07-30', '28', '1', '一等奖', '定制类手工制作，牛皮低绑，增高无缝，超级牛逼鞋子一双', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564369247.jpg', '1', '2019-07-29 11:03:41', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('413', '2', '天天抽奖天天兑奖3', '35', '', '418759712', '2019-07-30', '29', '2', '二等奖', '100', '', '1', '2019-07-30 16:06:25', '130', '1', '2019-08-01 13:19:08', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('414', '2', '天天抽奖天天兑奖3', '24', '', '31174655', '2019-07-30', '29', '2', '二等奖', '100', '', '1', '2019-07-31 15:33:25', '130', '1', '0000-00-00 00:00:00', '', '', '', '', '3', '', '');
INSERT INTO `yl_activity_roster` VALUES ('415', '2', '单点活动测试', '18', '', '296801149', '2019-07-30', '30', '2', '一等奖', '1000', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564558425.jpg', '1', '2019-08-01 15:34:38', '1300', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('416', '2', '单点活动测试', '34', '', '400287470', '2019-07-30', '31', '2', '二等奖', '100', '', '1', '2019-08-01 15:26:10', '130', '1', '2019-08-15 10:25:50', '', '', '', '', '3', '', '');
INSERT INTO `yl_activity_roster` VALUES ('417', '2', '单点活动测试', '35', '', '496335658', '2019-07-30', '32', '2', '三等奖', '10', '', '1', '2019-08-01 16:33:15', '13', '1', '2019-08-02 10:31:52', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('418', '2', '单点活动测试', '24', '', '633971619', '2019-07-30', '30', '2', '一等奖', '1000', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1907/1564558425.jpg', '1', '2019-08-02 09:29:59', '1300', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('419', '2', '单点活动测试', '37', '', '190802', '2019-07-30', '31', '2', '二等奖', '100', '', '1', '2019-08-02 15:44:31', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('420', '2', '单点活动测试', '34', '', '23146487', '2019-07-30', '32', '2', '三等奖', '10', '', '1', '2019-08-02 09:14:56', '13', '1', '2019-08-15 09:50:30', '', '', '', '', '3', '', '');
INSERT INTO `yl_activity_roster` VALUES ('421', '2', '抽奖兑换购物款金额测试', '34', '', '822640116', '2019-07-30', '33', '2', '一等奖', '1000', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1565341177.jpg', '1', '2019-08-09 17:03:09', '1300', '1', '2019-08-13 11:18:40', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('422', '2', '抽奖兑换购物款金额测试', '18', '', '1908091', '2019-07-30', '33', '2', '一等奖', '1000', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1565341177.jpg', '1', '2019-08-09 17:48:10', '1300', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('424', '2', '天天抽天天兑（一把一把捞抽奖活动）', '52', '', '190819F561', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-19 15:26:45', '0', '1', '2019-08-20 09:48:47', '时代财富天地', '13241015007', 'wangzhi', '141123123546874562', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('425', '2', '抽奖兑换购物款金额测试', '34', '', '190809', '2019-07-30', '34', '2', '二等奖', '1000', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1565341200.jpg', '1', '2019-08-09 17:02:09', '1300', '1', '2019-08-15 14:24:07', '', '', '', '', '2', '', '');
INSERT INTO `yl_activity_roster` VALUES ('426', '2', '天天抽天天兑（一把一把捞抽奖活动）', '74', '', '190819USKS', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-19 16:18:01', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('427', '2', '天天抽天天兑（一把一把捞抽奖活动）', '60', '', '64191466', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-19 15:52:44', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('428', '2', '天天抽天天兑（一把一把捞抽奖活动）', '77', '', '1908199JOS', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-19 16:21:56', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('429', '2', '天天抽天天兑（一把一把捞抽奖活动）', '59', '', '190819G99M', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-19 15:32:25', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('430', '2', '天天抽天天兑（一把一把捞抽奖活动）', '68', '', '190819ZGOJ', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-19 16:11:45', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('431', '2', '天天抽天天兑（一把一把捞抽奖活动）', '51', '', '34965880', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-19 15:48:35', '130', '1', '2019-08-20 10:12:29', '', '', '', '', '2', '', '');
INSERT INTO `yl_activity_roster` VALUES ('432', '2', '天天抽天天兑（一把一把捞抽奖活动）', '41', '', '736208178', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-19 15:24:51', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('433', '2', '天天抽天天兑（一把一把捞抽奖活动）', '57', '', '19081931GN', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-19 15:27:33', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('434', '2', '天天抽天天兑（一把一把捞抽奖活动）', '56', '', '190819S450', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-19 15:28:57', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('435', '2', '天天抽天天兑（一把一把捞抽奖活动）', '82', '', '190819NK4B', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-19 16:52:56', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('436', '2', '天天抽天天兑（一把一把捞抽奖活动）', '64', '', '19081929A2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:51:35', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('437', '2', '天天抽天天兑（一把一把捞抽奖活动）', '72', '', '1908197H24', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:14:04', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('438', '2', '天天抽天天兑（一把一把捞抽奖活动）', '47', '', '671558309', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:28:33', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('439', '2', '天天抽天天兑（一把一把捞抽奖活动）', '70', '', '190819NZ2K', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:13:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('440', '2', '天天抽天天兑（一把一把捞抽奖活动）', '36', '', '1908190NL1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:07:21', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('441', '2', '天天抽天天兑（一把一把捞抽奖活动）', '55', '', '190819ANY2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:12:30', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('442', '2', '天天抽天天兑（一把一把捞抽奖活动）', '48', '', '666325237', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:45:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('443', '2', '天天抽天天兑（一把一把捞抽奖活动）', '62', '', '1908190143', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:33:52', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('444', '2', '天天抽天天兑（一把一把捞抽奖活动）', '43', '', '227953653', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:24:18', '13', '1', '2019-08-20 10:00:53', '', '', '', '', '2', '', '');
INSERT INTO `yl_activity_roster` VALUES ('445', '2', '天天抽天天兑（一把一把捞抽奖活动）', '67', '', '190819JC6U', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:05:30', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('446', '2', '天天抽天天兑（一把一把捞抽奖活动）', '44', '', '19081929', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:16:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('447', '2', '天天抽天天兑（一把一把捞抽奖活动）', '34', '', '237193882', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 10:10:29', '13', '1', '2019-08-22 10:04:50', '', '', '', '', '2', '', '');
INSERT INTO `yl_activity_roster` VALUES ('448', '2', '天天抽天天兑（一把一把捞抽奖活动）', '63', '', '190819I7R6', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:41:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('449', '2', '天天抽天天兑（一把一把捞抽奖活动）', '78', '', '19081917M8', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:27:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('450', '2', '天天抽天天兑（一把一把捞抽奖活动）', '53', '', '1908191S28', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:27:18', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('451', '2', '天天抽天天兑（一把一把捞抽奖活动）', '37', '', '190819F201', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:30:42', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('452', '2', '天天抽天天兑（一把一把捞抽奖活动）', '81', '', '190819C63I', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:50:56', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('453', '2', '天天抽天天兑（一把一把捞抽奖活动）', '71', '', '19081945YC', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:13:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('454', '2', '天天抽天天兑（一把一把捞抽奖活动）', '76', '', '19081909UO', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:24:23', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('455', '2', '天天抽天天兑（一把一把捞抽奖活动）', '42', '', '259115122', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:17:05', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('456', '2', '天天抽天天兑（一把一把捞抽奖活动）', '65', '', '1908195HS2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:59:15', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('457', '2', '天天抽天天兑（一把一把捞抽奖活动）', '49', '', '126198908', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:27:03', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('458', '2', '天天抽天天兑（一把一把捞抽奖活动）', '73', '', '190819D0D4', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:14:52', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('459', '2', '天天抽天天兑（一把一把捞抽奖活动）', '61', '', '1908192SJD', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:34:01', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('460', '2', '天天抽天天兑（一把一把捞抽奖活动）', '39', '', '19081945', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 14:55:13', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('461', '2', '天天抽天天兑（一把一把捞抽奖活动）', '69', '', '190819PY32', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:12:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('462', '2', '天天抽天天兑（一把一把捞抽奖活动）', '28', '', '190819844', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 14:49:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('463', '2', '天天抽天天兑（一把一把捞抽奖活动）', '75', '', '1908190W8T', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:19:13', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('464', '2', '天天抽天天兑（一把一把捞抽奖活动）', '40', '', '1908194', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 14:56:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('465', '2', '天天抽天天兑（一把一把捞抽奖活动）', '80', '', '190819P20M', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 16:39:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('466', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2620', '1880000003', '190820M38R', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-20 17:00:47', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('467', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2516', '1780000012', '190820314U', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-20 16:54:39', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('468', '2', '天天抽天天兑（一把一把捞抽奖活动）', '145', '1580000008', '190820Y18R', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-20 16:41:21', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('469', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2439', '1780000010', '190820H2ZJ', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-20 16:54:36', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('470', '2', '天天抽天天兑（一把一把捞抽奖活动）', '70', '1853141632', '1908194AU9', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-19 16:13:10', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('471', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2431', '1780000008', '190820N6W6', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:54:30', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('472', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2358', '1780000006', '1908202LLE', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:54:35', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('473', '2', '天天抽天天兑（一把一把捞抽奖活动）', '920', '1580000042', '1908201GL4', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:20:35', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('474', '2', '天天抽天天兑（一把一把捞抽奖活动）', '137', '1580000003', '190820BS4A', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:14:15', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('475', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1086', '1580000074', '190820229V', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:23:08', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('476', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1794', '1580000170', '1908201RY4', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:24:46', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('477', '2', '天天抽天天兑（一把一把捞抽奖活动）', '126', '1580000003', '190820Z3B9', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:41:11', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('478', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2449', '1780000009', '190820LZF2', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:54:43', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('479', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2647', '1880000006', '1908201W01', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 17:00:54', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('480', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2385', '1780000004', '190820K1B1', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:54:44', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('481', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2504', '1780000014', '190820DR54', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:33', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('482', '2', '天天抽天天兑（一把一把捞抽奖活动）', '258', '1580000036', '1908203V2P', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:13', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('483', '2', '天天抽天天兑（一把一把捞抽奖活动）', '926', '1580000033', '1908200927', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:22:27', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('484', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2595', '1880000001', '190820WDN8', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('485', '2', '天天抽天天兑（一把一把捞抽奖活动）', '238', '1580000006', '190820LF19', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:19', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('486', '2', '天天抽天天兑（一把一把捞抽奖活动）', '123', '1580000006', '1908208ZCF', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('487', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2152', '1680000006', '190820FCC6', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('488', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2156', '1680000007', '1908204ZT0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('489', '2', '天天抽天天兑（一把一把捞抽奖活动）', '88', '1580000000', '190820W7W5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:18', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('490', '2', '天天抽天天兑（一把一把捞抽奖活动）', '163', '1580000007', '190820NR02', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('491', '2', '天天抽天天兑（一把一把捞抽奖活动）', '437', '1580000149', '190820N0U0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('492', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2099', '1680000001', '1908202SVZ', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('493', '2', '天天抽天天兑（一把一把捞抽奖活动）', '138', '1580000005', '190820OC99', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('494', '2', '天天抽天天兑（一把一把捞抽奖活动）', '229', '1580000024', '190820843H', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('495', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1540', '1580000138', '190820YK19', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('496', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1569', '1580000141', '190820EM14', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('497', '2', '天天抽天天兑（一把一把捞抽奖活动）', '842', '1580000030', '190820F59F', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:20:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('498', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1761', '1580000166', '1908201076', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('499', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2612', '1880000002', '190820Q9RD', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('500', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2652', '1880000006', '19082083Q2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('501', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1577', '1580000142', '1908203T02', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('502', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2136', '1680000005', '190820FH7G', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:30', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('503', '2', '天天抽天天兑（一把一把捞抽奖活动）', '162', '1580000011', '1908202PH1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('504', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2182', '1680000009', '190820Q644', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('505', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2366', '1780000006', '1908203VQZ', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('506', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2677', '1880000009', '190820YR4U', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('507', '2', '天天抽天天兑（一把一把捞抽奖活动）', '181', '1580000005', '190820G4US', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:13', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('508', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2162', '1680000007', '190820KLEV', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('509', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2416', '1780000001', '190820TJ50', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('510', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2424', '1780000000', '19082075KB', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:55:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('511', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1248', '1580000101', '19082094HY', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('512', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2170', '1680000008', '1908208BPM', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('513', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1947', '1580000186', '19082008B5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:25:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('514', '2', '天天抽天天兑（一把一把捞抽奖活动）', '139', '1580000006', '190820016B', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('515', '2', '天天抽天天兑（一把一把捞抽奖活动）', '47', '1352028042', '659137838', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-19 15:28:24', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('516', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2571', '1780000028', '190820766S', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:55:01', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('517', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2473', '1780000021', '19082096IL', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('518', '2', '天天抽天天兑（一把一把捞抽奖活动）', '556', '1580000004', '190820N04L', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:20', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('519', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2603', '1880000001', '1908205341', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('520', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1327', '1580000112', '190820I315', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('521', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2401', '1780000002', '1908208VVQ', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:44', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('522', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2604', '1880000002', '190820Y870', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('523', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1702', '1580000159', '190820364H', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:33', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('524', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2418', '1780000001', '190820GK8G', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:35', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('525', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2450', '1780000009', '190820CUGY', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:55:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('526', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2649', '1880000006', '1908201S86', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('527', '2', '天天抽天天兑（一把一把捞抽奖活动）', '183', '1580000004', '1908209K0N', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('528', '2', '天天抽天天兑（一把一把捞抽奖活动）', '90', '1580000000', '190820048D', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:18', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('529', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1228', '1580000098', '190820N95I', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:34', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('530', '2', '天天抽天天兑（一把一把捞抽奖活动）', '101', '1580000001', '19082013MA', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:21', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('531', '2', '天天抽天天兑（一把一把捞抽奖活动）', '298', '1580000030', '190820DY2J', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('532', '2', '天天抽天天兑（一把一把捞抽奖活动）', '941', '1580000041', '190820M0LO', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:22:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('533', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1303', '1580000108', '1908201YOS', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:44', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('534', '2', '天天抽天天兑（一把一把捞抽奖活动）', '471', '1580000153', '190820L554', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:18', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('535', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1008', '1580000060', '190820CCW9', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:22:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('536', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1629', '1580000148', '190820CE4A', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:23', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('537', '2', '天天抽天天兑（一把一把捞抽奖活动）', '742', '1580000063', '19082087W5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:20:32', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('538', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1922', '1580000183', '19082083P0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:25:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('539', '2', '天天抽天天兑（一把一把捞抽奖活动）', '748', '1580000060', '1908206566', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:20:32', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('540', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1539', '1580000137', '19082023KV', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('541', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2406', '1780000001', '190820NK1A', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('542', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2667', '1880000008', '190820QS8P', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:01:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('543', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2357', '1780000007', '190820575L', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:55:01', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('544', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2178', '1680000008', '190820411S', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:25', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('545', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2134', '1680000004', '190820HOI2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('546', '2', '天天抽天天兑（一把一把捞抽奖活动）', '567', '1580000024', '1908201Q0Z', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:23', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('547', '2', '天天抽天天兑（一把一把捞抽奖活动）', '204', '1580000012', '190820DUPE', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('548', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2131', '1680000004', '1908202DQ0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:21', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('549', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2588', '1880000000', '190820LIU1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:46', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('550', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2121', '1680000003', '1908201I7F', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('551', '2', '天天抽天天兑（一把一把捞抽奖活动）', '107', '1580000002', '1908206FV1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('552', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2609', '1880000002', '19082057T1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:46', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('553', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1266', '1580000103', '19082004A0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('554', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2176', '1680000009', '1908201AH0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('555', '2', '天天抽天天兑（一把一把捞抽奖活动）', '824', '1580000022', '1908207K1I', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:20:30', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('556', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2373', '1780000005', '19082010H6', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('557', '2', '天天抽天天兑（一把一把捞抽奖活动）', '230', '1580000003', '1908202J0O', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:19', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('558', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2419', '1780000000', '1908204311', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('559', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1164', '1580000089', '1908206O1E', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:24', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('560', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2163', '1680000008', '190820B70O', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('561', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2391', '1780000003', '1908204400', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('562', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2655', '1880000007', '1908201F6M', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('563', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1751', '1580000165', '1908209654', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('564', '2', '天天抽天天兑（一把一把捞抽奖活动）', '382', '1580000075', '19082021H5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:16', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('565', '2', '天天抽天天兑（一把一把捞抽奖活动）', '995', '1580000057', '1908209YV5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:22:52', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('566', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2173', '1680000009', '1908201R1V', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('567', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2611', '1880000002', '190820RVW8', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('568', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2169', '1680000008', '190820IQ44', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('569', '2', '天天抽天天兑（一把一把捞抽奖活动）', '577', '1580000022', '190820Y3Y5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:23', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('570', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2193', '1680000027', '190820B963', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('571', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2638', '1880000005', '1908205Y3M', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:01:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('572', '2', '天天抽天天兑（一把一把捞抽奖活动）', '173', '1580000004', '1908204135', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:21', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('573', '2', '天天抽天天兑（一把一把捞抽奖活动）', '107', '1580000002', '1908205H3Y', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:19', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('574', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1027', '1580000065', '1908204F49', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:22:58', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('575', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2149', '1680000006', '1908204554', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:32', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('576', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2677', '1880000009', '190820078J', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('577', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1774', '1580000168', '190820EL32', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('578', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2427', '1780000000', '190820YRBR', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:32', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('579', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2385', '1780000004', '190820FFV5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('580', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2586', '1880000000', '19082027O2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('581', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5840', '1930000003', '19082105G1', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-21 10:31:03', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('582', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3696', '1850000000', '190821GQ72', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-21 10:32:32', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('583', '2', '天天抽天天兑（一把一把捞抽奖活动）', '387', '1580000079', '190820LZHI', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-20 16:14:16', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('584', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5273', '1910000007', '190821A4R5', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-21 10:31:34', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('585', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3689', '1850000000', '190821KLK4', '2019-07-30', '36', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179660.jpg', '1', '2019-08-21 10:32:30', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('586', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5263', '1910000006', '190821GQ4T', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-21 10:31:37', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('587', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2639', '1880000005', '190820HM17', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 17:00:45', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('588', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3630', '1850000007', '190821LNR1', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-21 10:32:34', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('589', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6157', '1940000000', '19082180I9', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-21 10:30:45', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('590', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4587', '1880000019', '1908216ZQ7', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-21 10:32:02', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('591', '2', '天天抽天天兑（一把一把捞抽奖活动）', '998', '1580000057', '190820F99V', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 16:22:52', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('592', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2669', '1880000008', '19082037R1', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-20 17:00:55', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('593', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5239', '1910000004', '1908210P83', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-21 10:31:37', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('594', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4400', '1870000010', '1908212284', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-21 10:32:06', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('595', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3240', '1830000010', '190821DS8S', '2019-07-30', '37', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179746.jpg', '1', '2019-08-21 10:32:46', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('596', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6966', '1970000006', '19082153KP', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:21', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('597', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1397', '1580000121', '1908207Q62', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:57', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('598', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5000', '1900000009', '1908217951', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('599', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2445', '1780000008', '190820RJJ0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('600', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3380', '1840000006', '1908211CHL', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('601', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2439', '1780000010', '190820Z212', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('602', '2', '天天抽天天兑（一把一把捞抽奖活动）', '460', '1580000065', '19082044AM', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('603', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1404', '1580000122', '190820N93R', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:57', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('604', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4233', '1870000002', '1908213EGN', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:09', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('605', '2', '天天抽天天兑（一把一把捞抽奖活动）', '113', '1580000003', '19082003ZT', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('606', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3136', '1830000009', '190821391Z', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('607', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3392', '1840000007', '190821TG1V', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:42', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('608', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2593', '1880000000', '190820ZJRS', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('609', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2818', '1820000002', '190821K04G', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:33:04', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('610', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3890', '1860000001', '1908210M3G', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:25', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('611', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4451', '1870000017', '1908219Y3Z', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:05', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('612', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5114', '1900000017', '19082120BU', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('613', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6749', '1960000004', '19082185VG', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('614', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4193', '1870000006', '190821YV5I', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('615', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2663', '1880000007', '190820Q0H5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('616', '2', '天天抽天天兑（一把一把捞抽奖活动）', '103', '1580000001', '190820NC49', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:11', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('617', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2654', '1880000006', '1908205H4R', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:53', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('618', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2372', '1780000005', '190820V603', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:44', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('619', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1991', '1580000190', '190820S3A5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:25:06', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('620', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3010', '1820000013', '1908210277', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('621', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5481', '1920000001', '190821503J', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:20', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('622', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2698', '1980000008', '190821HJ7O', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:33:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('623', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3070', '1830000005', '190821658T', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:52', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('624', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2621', '1880000003', '1908206171', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('625', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1434', '1580000126', '190820IEQS', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('626', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5355', '1910000013', '190821JEM8', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:35', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('627', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6469', '1950000009', '1908212CR5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:34', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('628', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4943', '1900000004', '190821Y4DL', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('629', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5856', '1930000001', '19082101B4', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('630', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6400', '1950000002', '190821B8M1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:34', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('631', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7059', '1970000000', '190821408F', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('632', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4929', '1900000006', '190821F2YO', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:46', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('633', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6751', '1960000008', '190821S5L1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('634', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3326', '1840000001', '190821C095', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('635', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4268', '1870000008', '190821B0PF', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('636', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6745', '1960000002', '1908210C32', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('637', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3604', '1840000025', '190821U8F1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:35', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('638', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2112', '1680000002', '190820F6S5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('639', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3626', '1850000006', '1908216Z9O', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('640', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3117', '1830000000', '190821W03U', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('641', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5801', '1930000007', '190821206N', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('642', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2716', '1980000005', '190821QO2R', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:33:13', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('643', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5280', '1910000007', '19082140SI', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:36', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('644', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5374', '1910000024', '190821A047', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:35', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('645', '2', '天天抽天天兑（一把一把捞抽奖活动）', '129', '1580000003', '1908203Q8P', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('646', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5747', '1920000011', '19082133I3', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('647', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2173', '1680000009', '1908200E71', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('648', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3219', '1830000029', '1908212515', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:49', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('649', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1855', '1580000176', '190820V029', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:50', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('650', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5862', '1930000003', '190821U4I9', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('651', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2733', '1980000003', '1908211YZ5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:33:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('652', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2612', '1880000002', '1908201CBJ', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('653', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6706', '1960000007', '190821CET7', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('654', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5472', '1920000007', '190821GAFT', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('655', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2822', '1820000003', '190821VSQ2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:57', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('656', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3087', '1830000003', '190821IQCM', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:50', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('657', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3344', '1840000002', '190821OI92', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('658', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4936', '1900000005', '1908214508', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('659', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3128', '1830000008', '190821UN54', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:52', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('660', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1850', '1580000176', '190820V5N4', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:24:49', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('661', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2361', '1780000006', '190820VTGV', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('662', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4679', '1890000005', '1908213C3R', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('663', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7142', '1970000028', '190821S3L9', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:16', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('664', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5567', '1920000008', '1908211I4S', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:25', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('665', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2785', '1820000001', '190821LSE9', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:56', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('666', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5218', '1910000001', '190821E4B4', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:35', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('667', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2795', '1820000001', '190821ANH2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:58', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('668', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5544', '1920000004', '1908213VSL', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:19', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('669', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5327', '1910000021', '19082146Z5', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('670', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6148', '1940000007', '190821VVDU', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:46', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('671', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2155', '1680000007', '190820O130', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:47:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('672', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2855', '1820000006', '190821F2U1', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:33:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('673', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4961', '1900000003', '19082102NV', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:48', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('674', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4645', '1890000002', '1908216PZ2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:56', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('675', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2419', '1780000000', '190820G414', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:34', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('676', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5467', '1920000005', '190821UPCH', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:30', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('677', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2881', '1820000008', '190821N0SA', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:56', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('678', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2650', '1880000006', '190820S1WQ', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('679', '2', '天天抽天天兑（一把一把捞抽奖活动）', '1241', '1580000100', '1908203N2S', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:23:34', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('680', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2657', '1880000007', '19082071SK', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 17:00:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('681', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4805', '1890000023', '1908215P61', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:53', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('682', '2', '天天抽天天兑（一把一把捞抽奖活动）', '140', '1580000005', '190820Q02P', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:18', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('683', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6814', '1960000020', '190821W215', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('684', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5665', '1920000010', '190821Z49B', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:22', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('685', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2435', '1780000009', '190820MOD0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:54:32', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('686', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7058', '1970000003', '19082144RI', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('687', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6406', '1950000004', '190821QD38', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('688', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4355', '1870000029', '190821YVI2', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:11', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('689', '2', '天天抽天天兑（一把一把捞抽奖活动）', '2798', '1820000000', '1908210HP4', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:56', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('690', '2', '天天抽天天兑（一把一把捞抽奖活动）', '662', '1580000072', '1908201KT0', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:14:22', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('691', '2', '天天抽天天兑（一把一把捞抽奖活动）', '6561', '1950000019', '190821Z42G', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:30:36', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('692', '2', '天天抽天天兑（一把一把捞抽奖活动）', '117', '1580000008', '190820O888', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-20 16:41:19', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('693', '2', '天天抽天天兑（一把一把捞抽奖活动）', '4990', '1900000008', '190821U80D', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:46', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('694', '2', '天天抽天天兑（一把一把捞抽奖活动）', '3907', '1860000001', '190821004F', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:32:20', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('695', '2', '天天抽天天兑（一把一把捞抽奖活动）', '5751', '1920000013', '190821150G', '2019-07-30', '38', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179799.jpg', '1', '2019-08-21 10:31:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('696', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7334', '1330000006', '19082235PB', '2019-07-30', '39', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179978.jpg', '1', '2019-08-22 17:04:11', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('697', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7343', '1330000008', '190822PA10', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:01:45', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('698', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7283', '1330000000', '190822AB2Y', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:03:32', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('699', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7551', '1330000022', '19082254HU', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:02:00', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('700', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7329', '1330000002', '190822M115', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:03:35', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('701', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7289', '1330000004', '1908224U4S', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:02:21', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('702', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7319', '1330000000', '19082279VR', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:02:26', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('703', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7363', '1330000003', '190822SRC3', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:04:13', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('704', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7563', '1330000016', '1908222WL8', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:01:50', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('705', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7275', '1330000002', '1908221434', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:04:30', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('706', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7653', '1340000005', '190822ZP45', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:03:11', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('707', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7553', '1330000026', '190822K16J', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('708', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7458', '1330000014', '190822YMAH', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:50', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('709', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7455', '1330000026', '190822S12T', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:50', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('710', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7604', '1340000001', '190822A2EJ', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:13', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('711', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7658', '1340000006', '19082259GM', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('712', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7390', '1330000006', '190822GP46', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:22', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('713', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7387', '1330000008', '1908229QF4', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:54', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('714', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7312', '1330000006', '1908220945', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('715', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7639', '1340000003', '1908224TV2', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:03', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('716', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7501', '1330000012', '19082234V4', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('717', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7274', '1330000005', '190822DNK1', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('718', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7331', '1330000000', '190822T355', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:22', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('719', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7345', '1330000004', '190822VMMC', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('720', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7453', '1330000028', '1908224JQM', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:51', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('721', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7673', '1340000008', '190822K365', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('722', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7303', '1330000000', '1908222530', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('723', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7662', '1340000005', '19082203H9', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('724', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7288', '1330000006', '190822RJO7', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:11', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('725', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7284', '1330000007', '190822A362', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('726', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7381', '1330000003', '190822HT6Y', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('727', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7364', '1330000004', '19082262SB', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('728', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7271', '1330000004', '1908220ODW', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('729', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7369', '1330000004', '1908221959', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:48', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('730', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7678', '1340000005', '19082289P2', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('731', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7340', '1330000006', '190822A9HL', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:56', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('732', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7335', '1330000009', '190822K05R', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:22', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('733', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7294', '1330000007', '1908224876', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:55', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('734', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7358', '1330000000', '1908220228', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:39', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('735', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7365', '1330000000', '190822KB3K', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:03', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('736', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7276', '1330000001', '190822L2E5', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('737', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7341', '1330000008', '1908227HIN', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:41', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('738', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7311', '1330000009', '1908224B9O', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:09', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('739', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7446', '1330000011', '1908223S1A', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:52', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('740', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7459', '1330000012', '190822P4IQ', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:48', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('741', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7606', '1340000000', '1908228QTI', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:23', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('742', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7304', '1330000007', '190822N7S4', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:53', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('743', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7277', '1330000001', '19082281E4', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('744', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7385', '1330000006', '1908221I8R', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:06', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('745', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7691', '1340000009', '190822330I', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:58', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('746', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7324', '1330000007', '19082292UV', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('747', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7665', '1340000007', '190822T760', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:01', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('748', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7655', '1340000006', '190822SZE1', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('749', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7291', '1330000001', '1908224JQ8', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:09', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('750', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7327', '1330000002', '190822S3ES', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('751', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7680', '1340000009', '190822W254', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:58', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('752', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7353', '1330000003', '190822QA5Y', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:47', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('753', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7682', '1340000009', '1908225PL9', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('754', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7350', '1330000009', '19082241SV', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('755', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7582', '1330000013', '19082246Z6', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:41', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('756', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7349', '1330000008', '1908223Y90', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('757', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7371', '1330000008', '1908229N12', '2019-07-30', '39', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179978.jpg', '1', '2019-08-22 17:02:27', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('758', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7733', '1350000002', '1908232011', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:01:16', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('759', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7387', '1330000008', '1908226G4P', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:04:17', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('760', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7959', '1350000016', '19082367U6', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:06:00', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('761', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7697', '1350000000', '190823H8FT', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:01:35', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('762', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7709', '1350000001', '1908237YMV', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:01:35', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('763', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7350', '1330000009', '1908224227', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:03:46', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('764', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7665', '1340000007', '190822SWNH', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:03:13', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('765', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7337', '1330000002', '190822KF79', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:02:29', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('766', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7855', '1350000016', '1908239996', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:00:49', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('767', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7312', '1330000006', '190822T5D4', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:04:23', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('768', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7361', '1330000009', '190822SSE1', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:24', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('769', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7292', '1330000001', '190822C3R0', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:09', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('770', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7331', '1330000000', '190822PBV5', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('771', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7726', '1350000004', '190823C052', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:59', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('772', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7311', '1330000009', '1908225RTP', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:25', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('773', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7720', '1350000003', '1908230IET', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:24', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('774', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7757', '1350000006', '1908233O35', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('775', '2', '天天抽天天兑（一把一把捞抽奖活动）', '18', '1861130920', '19082356DD', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 16:45:57', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('776', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7763', '1350000004', '19082303Y4', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('777', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7341', '1330000008', '190822SNBS', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('778', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7296', '1330000007', '19082264TB', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('779', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7724', '1350000002', '1908230SCJ', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('780', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7860', '1350000013', '1908235151', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:30', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('781', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7856', '1350000020', '190823ICB4', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:48', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('782', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7329', '1330000002', '190822F200', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('783', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7900', '1350000021', '1908238773', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:32', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('784', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7317', '1330000009', '190822TSC0', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:11', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('785', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7908', '1350000020', '1908236N6T', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('786', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7270', '1330000010', '1908225479', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:19', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('787', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7300', '1330000002', '1908220Q49', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:04', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('788', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7349', '1330000008', '190822IOZ3', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:49', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('789', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7753', '1350000007', '19082338G7', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('790', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7791', '1350000009', '190823JW97', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:05:48', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('791', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7742', '1350000006', '1908234NN9', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:32', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('792', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7276', '1330000001', '190822VSE6', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('793', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7519', '1330000021', '190822P7VG', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:18', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('794', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7767', '1350000007', '190823760W', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:13', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('795', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7596', '1340000000', '1908225775', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:12', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('796', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7741', '1350000004', '190823Z0K5', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('797', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7287', '1330000001', '1908221RWS', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('798', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7286', '1330000000', '190822PU9D', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:59', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('799', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7695', '1350000000', '190823J57M', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:44', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('800', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7873', '1350000023', '1908238262', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:46', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('801', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7815', '1350000013', '1908235K08', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('802', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7961', '1350000016', '190823H29U', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('803', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7923', '1350000026', '190823C355', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:21', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('804', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7725', '1350000002', '1908239860', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:04', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('805', '2', '天天抽天天兑（一把一把捞抽奖活动）', '41', '1521012008', '190823M6U2', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 16:40:41', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('806', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7759', '1350000006', '190823301G', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:56', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('807', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7279', '1330000005', '190822M90Z', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('808', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7348', '1330000007', '1908223370', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:19', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('809', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7313', '1330000003', '190822DT8W', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:27', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('810', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7752', '1350000005', '1908239M78', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:37', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('811', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7290', '1330000002', '1908229936', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:07', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('812', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7365', '1330000000', '190822S37M', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('813', '2', '天天抽天天兑（一把一把捞抽奖活动）', '46', '1381020615', '1908235MY7', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 16:58:22', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('814', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7383', '1330000001', '1908224MT0', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:20', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('815', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7707', '1350000002', '190823B237', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('816', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7919', '1350000026', '190823SFL1', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:25', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('817', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7708', '1350000000', '19082303LT', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:03', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('818', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7379', '1330000007', '190822C7QK', '2019-07-30', '39', '1', '一等奖', '手机一部', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566179978.jpg', '1', '2019-08-22 17:02:20', '0', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('819', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7756', '1350000006', '190823BK9U', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:01:34', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('820', '2', '天天抽天天兑（一把一把捞抽奖活动）', '37', '1731903312', '190823S5MS', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 16:47:25', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('821', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7916', '1350000027', '1908234H1L', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:06:26', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('822', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7419', '1330000012', '1908222EG9', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:03:32', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('823', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7676', '1340000008', '1908227S7O', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:02:57', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('824', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7681', '1340000009', '190822Q37M', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:03:08', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('825', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7314', '1330000004', '1908224DHK', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:01:44', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('826', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7791', '1350000009', '1908231TY2', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:00:57', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('827', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7773', '1350000006', '1908237C35', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-23 10:01:15', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('828', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7296', '1330000007', '19082230GJ', '2019-07-30', '40', '2', '二等奖', '100', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180003.jpg', '1', '2019-08-22 17:01:52', '130', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('829', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7699', '1350000001', '1908234ZH6', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:34', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('830', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7307', '1330000002', '1908225412', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:28', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('831', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7792', '1350000009', '190823H93U', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:00', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('832', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7732', '1350000004', '190823M1D9', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:36', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('833', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7714', '1350000001', '1908236E7V', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:01', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('834', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7733', '1350000002', '19082363W6', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('835', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7742', '1350000006', '190823T0AE', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:36', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('836', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7762', '1350000006', '190823632H', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:59', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('837', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7700', '1350000000', '19082326VA', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:09', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('838', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7740', '1350000003', '190823M937', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:36', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('839', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7300', '1330000002', '190822V921', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('840', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7632', '1340000004', '1908221EH3', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('841', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7982', '1350000018', '190823IR9F', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:05:58', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('842', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7527', '1330000025', '190822LSNV', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:14', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('843', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7684', '1340000008', '190822W233', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('844', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7754', '1350000006', '19082380J7', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:26', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('845', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7750', '1350000003', '1908239J4A', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:10', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('846', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7463', '1330000011', '1908222QNJ', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('847', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7725', '1350000002', '1908236DJB', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:01', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('848', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7705', '1350000001', '19082357L2', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('849', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7359', '1330000005', '190822NQWA', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:57', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('850', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7288', '1330000006', '1908222BG3', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:51', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('851', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7363', '1330000003', '1908227700', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:44', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('852', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7675', '1340000005', '190822MEK6', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:09', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('853', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7696', '1350000000', '19082366TA', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:01:04', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('854', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7697', '1350000000', '190823N456', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:18', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('855', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7649', '1340000004', '190822HD31', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:16', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('856', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7660', '1340000007', '190822S2IB', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:03', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('857', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7783', '1350000008', '190823WRLQ', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:05', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('858', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7370', '1330000008', '1908220Z45', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:42', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('859', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7788', '1350000009', '190823D0SE', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:27', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('860', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7744', '1350000005', '190823A0P4', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:40', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('861', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7378', '1330000005', '190822BN34', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:17', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('862', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7715', '1350000001', '190823C485', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:02', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('863', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7424', '1330000029', '190822Y3C0', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:31', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('864', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7800', '1350000012', '19082322YP', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:22', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('865', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7706', '1350000000', '19082392YN', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:43', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('866', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7376', '1330000004', '190822261E', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:38', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('867', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7883', '1350000026', '190823UR3K', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:45', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('868', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7738', '1350000004', '19082339SD', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:35', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('869', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7766', '1350000007', '1908230792', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:02:08', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('870', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7289', '1330000004', '19082293P0', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:46', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('871', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7570', '1330000015', '190822VGK2', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:01:49', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('872', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7789', '1350000009', '1908235BF6', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:06:15', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('873', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7305', '1330000002', '19082251UA', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:04:05', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('874', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7771', '1350000009', '1908230G3S', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:36', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('875', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7737', '1350000003', '190823ZQ0Z', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-23 10:00:29', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('876', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7511', '1330000023', '190822W270', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:23', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('877', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7651', '1340000006', '190822V22M', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:03:03', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');
INSERT INTO `yl_activity_roster` VALUES ('878', '2', '天天抽天天兑（一把一把捞抽奖活动）', '7310', '1330000003', '190822N78W', '2019-07-30', '41', '2', '三等奖', '10', 'http://pic-10043876.file.myqcloud.com/img/luckdraw/1908/1566180025.jpg', '1', '2019-08-22 17:02:38', '13', '0', '0000-00-00 00:00:00', '', '', '', '', '1', '', '');

-- ----------------------------
-- Table structure for `yl_member`
-- ----------------------------
DROP TABLE IF EXISTS `yl_member`;
CREATE TABLE `yl_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` char(16) NOT NULL DEFAULT '' COMMENT '邀请码',
  `mobile` varchar(20) NOT NULL COMMENT '手机号',
  `activity_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '参数活动数量',
  `draw_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '获奖码数量',
  `from` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '来源(1、APP 2、微信公众号)',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(1、正常 2、无资格)',
  `create_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `number` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

-- ----------------------------
-- Records of yl_member
-- ----------------------------
INSERT INTO `yl_member` VALUES ('1', '18500971054', '18500971054', '1', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('2', '', '13603466936', '0', '0', '1', '2', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('3', '', '18500971055', '0', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('5', '', '2', '0', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('7', '', '3', '2', '0', '1', '2', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('8', '', '18500971056', '14', '0', '1', '2', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('9', '5660da927f7f55b7', '13500671054', '0', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('10', '7a9b3697cca34c90', '13500671055', '0', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('11', 'c5b41efd67f3a5a3', '15811103076', '5', '21', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('12', '', '18500971111', '0', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('13', '', '18410000000', '1', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('14', '', '13500971111', '0', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('15', '', '13581948044', '0', '0', '1', '1', '0000-00-00 00:00:00');
INSERT INTO `yl_member` VALUES ('16', '', '2147483647', '0', '0', '1', '1', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `yl_member_detail`
-- ----------------------------
DROP TABLE IF EXISTS `yl_member_detail`;
CREATE TABLE `yl_member_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `member_number` varchar(30) NOT NULL DEFAULT '' COMMENT '用户编号',
  `friend_id` varchar(30) NOT NULL DEFAULT '' COMMENT '朋友的微信ID',
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
  `activity_title` varchar(100) NOT NULL COMMENT '活动名称',
  `grant_style` varchar(100) NOT NULL COMMENT '获取方式',
  `prize_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '奖品ID',
  `prize_code` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '抽奖码',
  `prize_title` varchar(30) NOT NULL DEFAULT '' COMMENT '所中奖项',
  `prize_name` varchar(30) NOT NULL DEFAULT '' COMMENT '奖品名称',
  `prize_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '中奖期数',
  `receive_prize_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '领取的奖品类型(1、实物 2、现金 3、购物款)',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '参与时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可以参加抽奖(1、可以 2、不可以)',
  PRIMARY KEY (`id`),
  KEY `mobile` (`activity_id`) USING BTREE,
  KEY `prize_code` (`prize_code`),
  KEY `member_id` (`member_id`) USING BTREE,
  KEY `member_number` (`member_number`,`friend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COMMENT='用户抽奖码获取记录表';

-- ----------------------------
-- Records of yl_member_detail
-- ----------------------------
INSERT INTO `yl_member_detail` VALUES ('9', '1', '', '', '11', '22', 'aaa好友打开', '1', '1111', '222', '333', '2019-07-15', '1', '2019-07-09 14:26:37', '1');
INSERT INTO `yl_member_detail` VALUES ('10', '2', '', '123456', '11', '22', '回答必答题', '0', '13810231', '', '', '2019-07-15', '1', '2019-07-09 15:22:37', '1');
INSERT INTO `yl_member_detail` VALUES ('12', '2', '', '123456', '11', '22', '回答必答题', '0', '333085197', '', '', '0000-00-00', '1', '2019-07-09 15:23:06', '1');
INSERT INTO `yl_member_detail` VALUES ('13', '1', '18500971054', '123456', '11', '22', '许鹏亮好友打开', '0', '427505355', '', '', '0000-00-00', '1', '2019-07-09 15:28:41', '1');
INSERT INTO `yl_member_detail` VALUES ('14', '1', '18500971054', '123456', '11', '22', '许鹏亮好友打开', '0', '426011651', '', '', '0000-00-00', '1', '2019-07-09 15:34:05', '1');
INSERT INTO `yl_member_detail` VALUES ('15', '1', '18500971054', '123456', '11', '22', '许鹏亮好友打开', '0', '184909792', '', '', '0000-00-00', '1', '2019-07-09 16:24:35', '1');
INSERT INTO `yl_member_detail` VALUES ('16', '1', '18500971054', '123456', '11', '22', '回答必答题', '0', '801876625', '', '', '0000-00-00', '1', '2019-07-09 16:25:36', '1');
INSERT INTO `yl_member_detail` VALUES ('17', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '1', '', '', '0000-00-00', '1', '2019-07-16 09:44:52', '1');
INSERT INTO `yl_member_detail` VALUES ('18', '1', '18500971054', '', '2', '活动2', '回答选答题', '8', '2', '二等奖-2', '蓝牙耳机', '2019-07-31', '2', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('19', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '3', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('20', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '4', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('21', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '5', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('22', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '6', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('23', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '7', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('24', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '8', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('25', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '9', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('26', '1', '18500971054', '', '2', '活动2', '回答选答题', '0', '10', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('27', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '11', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('28', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '12', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '1');
INSERT INTO `yl_member_detail` VALUES ('29', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '13', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '1');
INSERT INTO `yl_member_detail` VALUES ('30', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '14', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('31', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '15', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '1');
INSERT INTO `yl_member_detail` VALUES ('32', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '16', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('33', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '17', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('34', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '18', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '1');
INSERT INTO `yl_member_detail` VALUES ('35', '2', '13603466936', '', '2', '活动2', '回答选答题', '7', '19', '一等奖-2', '荣耀V20', '2019-07-31', '1', '2019-07-16 09:46:21', '2');
INSERT INTO `yl_member_detail` VALUES ('36', '2', '13603466936', '', '2', '活动2', '回答选答题', '0', '20', '', '', '0000-00-00', '1', '2019-07-16 09:46:21', '1');
INSERT INTO `yl_member_detail` VALUES ('43', '11', '', '', '2', 'bb', '回答选答题', '8', '257007212', '二等奖-2', '蓝牙耳机', '2019-07-31', '1', '2019-07-27 15:20:20', '2');
INSERT INTO `yl_member_detail` VALUES ('44', '11', '', '', '2', 'bb', '回答必答题', '0', '669014125', '', '', '0000-00-00', '1', '2019-07-27 15:20:21', '1');
INSERT INTO `yl_member_detail` VALUES ('45', '11', '', '', '2', 'bb', '回答必答题', '0', '575165629', '', '', '0000-00-00', '1', '2019-07-27 15:20:21', '2');
INSERT INTO `yl_member_detail` VALUES ('46', '11', '', '', '2', 'bb', '回答必答题', '0', '575165629', '', '', '0000-00-00', '1', '2019-07-27 15:28:59', '2');
INSERT INTO `yl_member_detail` VALUES ('47', '11', '', '', '2', 'bb', '回答必答题', '0', '575165629', '', '', '0000-00-00', '1', '2019-07-27 15:40:25', '2');
INSERT INTO `yl_member_detail` VALUES ('48', '11', '', '', '2', 'bb', '回答选答题', '0', '144476676', '', '', '0000-00-00', '1', '2019-07-27 15:42:58', '1');
INSERT INTO `yl_member_detail` VALUES ('49', '11', '', '', '2', 'bb', '回答必答题', '0', '665717074', '', '', '0000-00-00', '1', '2019-07-27 15:42:59', '2');
INSERT INTO `yl_member_detail` VALUES ('50', '11', '', '', '2', 'bb', '回答必答题', '0', '741564476', '', '', '0000-00-00', '1', '2019-07-27 15:42:59', '2');
INSERT INTO `yl_member_detail` VALUES ('51', '11', '', '', '2', 'bb', '回答必答题', '0', '123', '', '', '0000-00-00', '1', '2019-07-28 13:06:31', '2');
INSERT INTO `yl_member_detail` VALUES ('52', '11', '', '222', '2', 'bb', '222好友打开', '0', '1234', '', '', '0000-00-00', '1', '2019-07-28 13:07:18', '2');
INSERT INTO `yl_member_detail` VALUES ('53', '16', '', '223', '5', 'bb', '223好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-07-28 13:08:13', '2');
INSERT INTO `yl_member_detail` VALUES ('54', '16', '', '224', '5', 'bb', '224好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-07-28 13:08:17', '2');
INSERT INTO `yl_member_detail` VALUES ('55', '16', '', '225', '5', 'bb', '225好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-09-02 13:08:27', '2');
INSERT INTO `yl_member_detail` VALUES ('56', '16', '', '226', '5', 'bb', '226好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-09-02 13:08:43', '2');
INSERT INTO `yl_member_detail` VALUES ('57', '16', '', '227', '5', 'bb', '227好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-09-02 13:09:15', '2');
INSERT INTO `yl_member_detail` VALUES ('58', '16', '', '228', '5', 'bb', '228好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-09-02 13:09:26', '2');
INSERT INTO `yl_member_detail` VALUES ('59', '16', '', '229', '5', 'bb', '229好友打开', '0', '1233', '二等奖', '小米音响', '0000-00-00', '1', '2019-09-02 13:09:35', '2');
INSERT INTO `yl_member_detail` VALUES ('60', '16', '', '2210', '5', 'bb', '2210好友打开', '0', '1233', '一等奖', 'P30', '0000-00-00', '1', '2019-09-02 13:09:51', '2');
INSERT INTO `yl_member_detail` VALUES ('61', '16', '', '2211', '5', 'bb', '2211好友打开', '0', '12335', '', '', '0000-00-00', '1', '2019-09-02 13:10:10', '2');
INSERT INTO `yl_member_detail` VALUES ('62', '16', '', '2212', '5', 'bb', '2212好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-09-02 13:10:46', '2');
INSERT INTO `yl_member_detail` VALUES ('63', '16', '', '2213', '5', 'bb', '2213好友打开', '0', '1233', '', '', '0000-00-00', '1', '2019-09-02 13:11:29', '2');

-- ----------------------------
-- Table structure for `yl_member_log`
-- ----------------------------
DROP TABLE IF EXISTS `yl_member_log`;
CREATE TABLE `yl_member_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '变更类型(1、正常 2、无资格)',
  `descition` varchar(100) NOT NULL COMMENT '变更原因',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '参与时间',
  `create_user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '操作人',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COMMENT='用户状态变更记录表';

-- ----------------------------
-- Records of yl_member_log
-- ----------------------------
INSERT INTO `yl_member_log` VALUES ('9', '2', '1', '问', '2019-07-09 14:27:10', '');
INSERT INTO `yl_member_log` VALUES ('10', '1', '2', '虚假的', '2019-07-09 00:00:00', '');
INSERT INTO `yl_member_log` VALUES ('11', '2', '2', '撒地方斯蒂芬', '2019-07-09 15:00:18', '');
INSERT INTO `yl_member_log` VALUES ('12', '3', '2', '电饭锅电饭锅给第三方', '2019-07-09 15:03:00', '');
INSERT INTO `yl_member_log` VALUES ('13', '7', '2', '同意', '2019-07-09 15:05:50', '');
INSERT INTO `yl_member_log` VALUES ('14', '7', '2', '同意', '2019-07-09 15:05:51', '');
INSERT INTO `yl_member_log` VALUES ('15', '8', '2', '上述 ', '2019-07-09 15:07:40', '');
INSERT INTO `yl_member_log` VALUES ('16', '1', '1', '就是要恢复', '2019-07-09 15:15:16', '');
INSERT INTO `yl_member_log` VALUES ('17', '1', '2', '加了管理员', '2019-07-09 15:22:18', 'admin');
INSERT INTO `yl_member_log` VALUES ('18', '3', '1', '恢复了啊\n', '2019-07-09 15:25:16', 'admin');
INSERT INTO `yl_member_log` VALUES ('19', '5', '1', '是的撒旦所多所多', '2019-07-09 15:26:19', 'admin');
INSERT INTO `yl_member_log` VALUES ('20', '1', '1', '测试回复', '2019-07-14 13:24:16', 'admin');
INSERT INTO `yl_member_log` VALUES ('21', '8', '1', '314124', '2019-07-29 13:52:17', 'admin');
INSERT INTO `yl_member_log` VALUES ('22', '8', '2', '2412的风格的风格地方个', '2019-07-29 13:52:29', 'admin');

-- ----------------------------
-- Table structure for `yl_member_question`
-- ----------------------------
DROP TABLE IF EXISTS `yl_member_question`;
CREATE TABLE `yl_member_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `roster_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '中奖表的ID(不填写则是首次加入活动的答题)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `activity_id` (`activity_id`,`member_id`,`roster_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COMMENT='用户答题记录表';

-- ----------------------------
-- Records of yl_member_question
-- ----------------------------
INSERT INTO `yl_member_question` VALUES ('52', '2', '1', '0');
INSERT INTO `yl_member_question` VALUES ('53', '2', '1', '398');
INSERT INTO `yl_member_question` VALUES ('50', '2', '11', '0');
INSERT INTO `yl_member_question` VALUES ('51', '2', '13', '0');

-- ----------------------------
-- Table structure for `yl_message`
-- ----------------------------
DROP TABLE IF EXISTS `yl_message`;
CREATE TABLE `yl_message` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) NOT NULL COMMENT '手机号',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '短信内容',
  `result` varchar(255) NOT NULL DEFAULT '' COMMENT '返回值',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='短信发送日志表';

-- ----------------------------
-- Records of yl_message
-- ----------------------------

-- ----------------------------
-- Table structure for `yl_user`
-- ----------------------------
DROP TABLE IF EXISTS `yl_user`;
CREATE TABLE `yl_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(50) NOT NULL COMMENT '管理员登录名',
  `true_name` varchar(50) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `phone` varchar(20) NOT NULL COMMENT '电话',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `password_hash` varchar(255) NOT NULL COMMENT '密码',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(1、正常 2、锁定)',
  `member_group` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核用户组(用于两个人一组来审核商家,每组两人)',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `office_auth` varchar(50) NOT NULL DEFAULT '0' COMMENT '允许操作办事处的ID(多个以逗号分割)',
  `area_auth` varchar(255) NOT NULL DEFAULT '0' COMMENT '允许操作的地区ID(多个地区已逗号分割)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='广告管理平台管理员信息表';

-- ----------------------------
-- Records of yl_user
-- ----------------------------
INSERT INTO `yl_user` VALUES ('34', 'admin', 'liuzhiying', '13603466936', '13603466936@qq.com', '$2y$13$bYHuOUyklhZA8Qhxk/28Qeo0XsCo91WtKLxSFceUgWVGe/4JG74/y', '2018-07-23 13:22:05', '2018-07-23 13:22:05', '1', '0', '', '', '0');
