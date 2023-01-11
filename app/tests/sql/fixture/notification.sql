SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `notification`;
INSERT INTO `notification` VALUES (1,1,1,'sms');
INSERT INTO `notification` VALUES (2,1,2,'sms');
INSERT INTO `notification` VALUES (3,1,3,'phone');
INSERT INTO `notification` VALUES (4,2,2,'email');
INSERT INTO `notification` VALUES (5,2,3,'sms');
INSERT INTO `notification` VALUES (7,1,1,'email');
INSERT INTO `notification` VALUES (8,1,2,'phone');

SET FOREIGN_KEY_CHECKS = 1;