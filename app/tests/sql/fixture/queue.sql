SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `queue`;
INSERT INTO `queue` VALUES (1,'Lorem','lorem@lipsum.com','+551234567',1,'Sports','sms',CURDATE(),'WAIT');
INSERT INTO `queue` VALUES (2,'Lorem','lorem@lipsum.com','+551234567',2,'Finance','sms',CURDATE(),'WAIT');
INSERT INTO `queue` VALUES (3,'Lorem','lorem@lipsum.com','+551234567',1,'Sports','email',CURDATE(),'WAIT');
INSERT INTO `queue` VALUES (4,'Lorem','lorem@lipsum.com','+551234567',2,'Finance','phone',CURDATE(),'WAIT');
INSERT INTO `queue` VALUES (5,'Ipsum','ipsum@lipsum.com','+123456789',2,'Finance','email',CURDATE(),'WAIT');

SET FOREIGN_KEY_CHECKS = 1;