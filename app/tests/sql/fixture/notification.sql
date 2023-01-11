SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `notification`;
INSERT INTO `notification` VALUES (1,1,1,'sms','WAIT');
INSERT INTO `notification` VALUES (2,1,2,'sms','WAIT');
INSERT INTO `notification` VALUES (3,1,3,'phone','WAIT');
INSERT INTO `notification` VALUES (4,2,2,'email','WAIT');
INSERT INTO `notification` VALUES (5,2,3,'sms','WAIT');
INSERT INTO `notification` VALUES (7,1,1,'email','WAIT');
INSERT INTO `notification` VALUES (8,1,2,'phone','WAIT');

SET FOREIGN_KEY_CHECKS = 1;