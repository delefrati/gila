SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `message`;
INSERT INTO `message` VALUES (1,1,'This is a message for Sports.',CURDATE());
INSERT INTO `message` VALUES (4,2,'This is a message for Finance.',CURDATE());


SET FOREIGN_KEY_CHECKS = 1;