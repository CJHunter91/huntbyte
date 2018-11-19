# Dump of table blog_cats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_cats`;

CREATE TABLE `blog_cats` (
  `catID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catTitle` varchar(255) DEFAULT NULL,
  `catSlug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `blog_cats` WRITE;
/*!40000 ALTER TABLE `blog_cats` DISABLE KEYS */;

INSERT INTO `blog_cats` (`catID`, `catTitle`, `catSlug`)
VALUES
	(1,'General','general'),
	(2,'Development','development'),
	(5,'Misc','misc'),
	(4,'Testing','testing');

/*!40000 ALTER TABLE `blog_cats` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table porfolio_cats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `portfolio_cats`;

CREATE TABLE `portfolio_cats` (
  `catID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catTitle` varchar(255) DEFAULT NULL,
  `catSlug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `portfolio_cats` WRITE;
/*!40000 ALTER TABLE `porfolio_cats` DISABLE KEYS */;

INSERT INTO `portfolio_cats` (`catID`, `catTitle`, `catSlug`)
VALUES
	(1,'General','general'),
	(2,'Development','development'),
	(5,'Misc','misc'),
	(4,'Testing','testing');

/*!40000 ALTER TABLE `portfolio_cats` ENABLE KEYS */;
UNLOCK TABLES;

# Dump of table blog_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_members`;

CREATE TABLE `blog_members` (
  `memberID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `blog_members` WRITE;
/*!40000 ALTER TABLE `blog_members` DISABLE KEYS */;

INSERT INTO `blog_members` (`memberID`, `username`, `password`, `email`)
VALUES
	(1,'Demo','$2a$12$TF8u1maUr5kADc42g1FB0ONJDEtt24ue.UTIuP13gij5AHsg5f5s2','demo@demo.com');

/*!40000 ALTER TABLE `blog_members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog_post_cats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_post_cats`;

CREATE TABLE `blog_post_cats` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `blog_post_cats` WRITE;
/*!40000 ALTER TABLE `blog_post_cats` DISABLE KEYS */;

INSERT INTO `blog_post_cats` (`id`, `postID`, `catID`)
VALUES
	(25,2,5),
	(21,6,4),
	(24,2,1),
	(4,3,2),
	(20,6,1),
	(16,1,2);

/*!40000 ALTER TABLE `blog_post_cats` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog_posts_seo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_posts_seo`;

CREATE TABLE `blog_posts_seo` (
  `postID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(255) DEFAULT NULL,
  `postSlug` varchar(255) DEFAULT NULL,
  `postDesc` text,
  `postCont` text,
  `postDate` datetime DEFAULT NULL,
  `postImage` VARCHAR(255) DEFAULT NULL,
  `postThumb` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `blog_posts_seo` WRITE;
/*!40000 ALTER TABLE `blog_posts_seo` DISABLE KEYS */;

INSERT INTO `blog_posts_seo` (`postID`, `postTitle`, `postSlug`, `postDesc`, `postCont`, `postDate`, `postImage`, `postThumb`)
VALUES
	(1,'Bendless Love','bendless-love','<p>That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him! Interesting. No, wait, the other thing: tedious. Hey, guess what you\'re accessories to. The alien mothership is in orbit here. If we can hit that bullseye, the rest of the dominoes will fall like a house of cards. Checkmate.</p>','<h2>The Mutants Are Revolting</h2>\r\n<p>We don\'t have a brig. And until then, I can never die? We need rest. The spirit is willing, but the flesh is spongy and bruised. And yet you haven\'t said what I told you to say! How can any of us trust you?</p>\r\n<ul>\r\n<li>Oh, but you can. But you may have to metaphorically make a deal with the devil. And by , I mean Robot Devil. And by \"metaphorically\", I mean get your coat.</li>\r\n<li>Bender?! You stole the atom.</li>\r\n<li>I was having the most wonderful dream. Except you were there, and you were there, and you were there!</li>\r\n</ul>\r\n<h3>The Series Has Landed</h3>\r\n<p>Fry! Stay back! He\'s too powerful! No. We\'re on the top. Fry, you can\'t just sit here in the dark listening to classical music.</p>\r\n<h4>Future Stock</h4>\r\n<p>Does anybody else feel jealous and aroused and worried? We\'re also Santa Claus! You\'re going back for the Countess, aren\'t you? Well, let\'s just dump it in the sewer and say we delivered it.</p>\r\n<ol>\r\n<li>Spare me your space age technobabble, Attila the Hun!</li>\r\n<li>You guys realize you live in a sewer, right?</li>\r\n<li>I guess if you want children beaten, you have to do it yourself.</li>\r\n<li>Yeah. Give a little credit to our public schools.</li>\r\n</ol>\r\n<h5>The Why of Fry</h5>\r\n<p>Who are you, my warranty?! Shinier than yours, meatbag. Dr. Zoidberg, that doesn\'t make sense. But, okay! Yes, except the Dave Matthews Band doesn\'t rock.</p>','2013-05-29 00:00:00','images/fw square pic.jpg','images/fw square pic.jpg');

# Dump of table portfolio_post_cats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `portfolio_post_cats`;

CREATE TABLE `portfolio_post_cats` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `portfolio_post_cats` WRITE;
/*!40000 ALTER TABLE `portfolio_post_cats` DISABLE KEYS */;

INSERT INTO `portfolio_post_cats` (`id`, `postID`, `catID`)
VALUES
	(25,2,5),
	(21,6,4),
	(24,2,1),
	(4,3,2),
	(20,6,1),
	(16,1,2);

/*!40000 ALTER TABLE `portfolio_post_cats` ENABLE KEYS */;
UNLOCK TABLES;

# Dump of table portfolio_posts_seo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `portfolio_posts_seo`;

CREATE TABLE `portfolio_posts_seo` (
  `postID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(255) DEFAULT NULL,
  `postSlug` varchar(255) DEFAULT NULL,
  `postDesc` text,
  `postDate` datetime DEFAULT NULL,
  `postImage` VARCHAR(255) DEFAULT NULL,
  `postThumb` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `portfolio_posts_seo` WRITE;
/*!40000 ALTER TABLE `portfolio_posts_seo` DISABLE KEYS */;

INSERT INTO `portfolio_posts_seo` (`postID`, `postTitle`, `postSlug`, `postDesc`, `postDate`, `postImage`, `postThumb`)
VALUES
	(1,'Bendless Love','bendless-love','Something','2013-05-29 00:00:00','images/fw square pic.jpg','images/fw square pic.jpg');
     
	