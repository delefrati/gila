SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `notification_type`;
INSERT INTO `notification_type` VALUES ('email');
INSERT INTO `notification_type` VALUES ('phone');
INSERT INTO `notification_type` VALUES ('sms');

SET FOREIGN_KEY_CHECKS = 1;