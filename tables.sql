+----------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Table    | Create Table                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
+----------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| comments | CREATE TABLE `comments` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_username` varchar(20) NOT NULL,
  `comment_date` varchar(20) NOT NULL,
  `comment_body` varchar(500) NOT NULL,
  `comment_postid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_username` (`comment_username`),
  KEY `comment_id` (`comment_postid`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_username`) REFERENCES `user` (`username`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_postid`) REFERENCES `posts` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 |
+----------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.00 sec)

+-------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Table | Create Table                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
+-------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| posts | CREATE TABLE `posts` (
  `post_username` varchar(20) NOT NULL,
  `post_date` varchar(20) NOT NULL,
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` varchar(100) NOT NULL,
  `post_body` varchar(1000) NOT NULL,
  `post_link` varchar(1000) DEFAULT NULL,
  `filename` varchar(250) DEFAULT NULL,
  `votes` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_username` (`post_username`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1 |
+-------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.00 sec)

+-------+-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Table | Create Table                                                                                                                                                                  |
+-------+-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| user  | CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `hashed_password` char(61) NOT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 |
+-------+-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.00 sec)

+---------+---------------------------------------------------------------------------------------------------------------------------------+
| Table   | Create Table                                                                                                                    |
+---------+---------------------------------------------------------------------------------------------------------------------------------+
| upvotes | CREATE TABLE `upvotes` (
  `post_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 |
+---------+---------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.00 sec)


