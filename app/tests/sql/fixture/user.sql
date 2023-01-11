SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `user`;
INSERT INTO `user` VALUES (1,'Lorem','lorem@lipsum.com','+551234567');
INSERT INTO `user` VALUES (2,'Ipsum','ipsum@lipsum.com','+123456789');
INSERT INTO `user` VALUES (3,'Lipsum','lipsum@lipsum.org','+2121212');

SET FOREIGN_KEY_CHECKS = 1;