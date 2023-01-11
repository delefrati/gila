SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `queue`;
INSERT INTO `queue` VALUES (1,'Lorem','lorem@lipsum.com','+551234567','Sports','This is a message for Sports.','sms',CURDATE());
INSERT INTO `queue` VALUES (2,'Lorem','lorem@lipsum.com','+551234567','Finance','This is a message for Finance.','sms',CURDATE());
INSERT INTO `queue` VALUES (3,'Lorem','lorem@lipsum.com','+551234567','Sports','This is a message for Sports.','email',CURDATE());
INSERT INTO `queue` VALUES (4,'Lorem','lorem@lipsum.com','+551234567','Finance','This is a message for Finance.','phone',CURDATE());
INSERT INTO `queue` VALUES (5,'Ipsum','ipsum@lipsum.com','+123456789','Finance','This is a message for Finance.','email',CURDATE());

SET FOREIGN_KEY_CHECKS = 1;