-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 21, 2020 at 11:05 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libros`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin_password` varchar(180) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `admin_password`) VALUES
(16, 'coway', 'coway@gmail.com', '610689e41a68011729a5f61aafd0b16b'),
(14, 'admin3', 'admin3@hotmail.com', '4b93c8e2e2ee6a09b9a4e75b0d619c4b'),
(15, 'admin5', 'admin5@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bookname` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `quantity` int(5) NOT NULL,
  `detail` varchar(8000) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `bookname`, `author`, `price`, `category`, `quantity`, `detail`, `image_path`, `added_date`) VALUES
(22, 'It\'s Kind of a Funny Story', 'Ned Vizzini', '20.50', 'English Books', 100, 'It\'s Kind of a Funny Story is a 2006 novel by American author Ned Vizzini. The book was inspired by Vizzini\'s own brief hospitalization for depression in November 2004. Ned Vizzini later died by suicide on December 19, 2013. The book received recognition as a 2007 Best Book for Young Adults from the American Library Association.\r\nA film adaptation, directed by Anna Boden and Ryan Fleck, was released in the United States on October 8, 2010.', '../bookimage/Funny_Story_front.jpg', '2020-07-02'),
(23, 'Nineteen Eighty-Four: A Novel', 'George Orwell', '25.00', 'English Books', 32, 'Nineteen Eighty-Four: A Novel, often published as 1984, is a dystopian novel by English novelist George Orwell. It was published on 8 June 1949 by Secker & Warburg as Orwell\'s ninth and final book completed in his lifetime. Thematically, Nineteen Eighty-Four centres on the consequences of government over-reach, totalitarianism, mass surveillance, and repressive regimentation of all persons and behaviours within society. More broadly, it examines the role of truth and facts within politics and their manipulation.', '../bookimage/1984first.jpg', '2020-07-05'),
(4, 'FNAF: FAZBEAR FRIGHTS #02: FETCH', 'Scott Cawthon', '20.00', 'English Books', 9, 'The Fazbear Frights series continues with three more\r\nbone-chilling, novella-length tales to keep even the bravest Five\r\nNights at Freddy\'s player up at night...\r\nAfter years of being kicked around, Greg, Alec and Oscar are ready\r\nto take control of their lives. Greg decides to put the controversial\r\nscience he\'s been studying to the test. Alec launches a\r\nmaster plot to expose his golden sister for the spoiled brat he\r\nknows she is. And Oscar, ever the miniature grown-up his mom needs\r\nhim to be, decides to take something he wants ... even though he\r\nknows it\'s wrong. But as these three will learn, control is a fragile\r\nthing in the sinister world of Five Nights at Freddy\'s.', '../bookimage/FAZBEAR FRIGHTS.jpg', '2020-06-30'),
(5, 'THINK LIKE A MONK : TRAIN YOUR MIND FOR PEACE AND PURPOSE EVERY DAY', 'Jay Shetty', '40.00', 'English Books', 15, 'Jay Shetty, social media superstar and host of the #1 podcast \'On Purpose\', distils the timeless wisdom he learned as a practising monk into practical steps anyone can take every day to live a less anxious, more meaningful life.\r\nOver the past three years, Jay Shetty has become a favourite in the hearts and minds of millions of people worldwide. One of his clips was the most watched video on Facebook last year, with over 360 million views. His social media following totals over 32 million, he has produced over 400 viral videos, which have amassed more than 5 billion views, and his podcast, \'On Purpose\', is consistently ranked the world\'s #1 health-related podcast.', '../bookimage/think_like_a_monk.jpg', '2020-06-30'),
(7, 'Olive, Again', 'Elizabeth Strout', '23.50', 'English Books', 46, 'Olive, Again is a 2019 novel by Elizabeth Strout, published by Random House on October 15, 2019. It is a sequel to Olive Kitteridge (2008). Similar to the first novel, Olive, Again takes the form of 13 short stories that are interrelated but discontinuous in terms of narrative. It follows Olive Kitteridge from her seventies into her eighties.\r\n', '../bookimage/olive.jpg', '2020-07-01'),
(8, 'Can\'t You Sleep, Little Bear?', 'Martin Waddell', '5.00', 'Others', 5, 'Celebrate 25 years of Big Bear, Little Bear and their cosy cave in this gorgeous anniversary edition of a classic bedtime favourite.\r\nDescribed as \'the most perfect children\'s book ever written\', this is a beautiful 25th anniversary edition of the Kate Greenaway-winning story of Little Bear, who just can\'t sleep. There is dark all around him in the Bear Cave. Not even Big Bear\'s biggest lantern can light up the darkness of the night outside. Can Big Bear find a way to reassure restless Little Bear and help him fall fast asleep?', '../bookimage/bear.jpg', '2020-07-01'),
(9, 'Let\'s Go Home, Little Bear', 'Martin Waddell', '4.00', 'Others', 63, 'Big Bear and Little Bear are returning home from a wonderful romp through the snowy woods, when a noise startles Little Bear. Plod, plod, plodÂ—suddenly the woods are alive with unseen Plodders and Drippers and Ploppers. Poor Little Bear is very scared. But Big Bear is beside him with comforting explanations and a piggyback ride to bring him safely home.', '../bookimage/homebear.jpg', '2020-07-01'),
(10, 'Bears, Bears, Bears ', 'Martin Waddell', '3.50', 'Others', 29, 'Ruby likes bears. So she puts up a sign inviting them to call. She isn\'t content with just one bear though - she wants more and more and more. But, as Ruby soon discovers, you can have too much of a good thing!\r\n\r\nWritten by Martin Waddell, well known and respected the world over for his stunning storytelling. He wrote Farmer Duck and Can\'t You Sleep, Little Bear? both of which won the Smarties Prize, and the bestselling Owl Babies. Lee Wildish is the winner of the Red House Children\'s Book Award.', '../bookimage/bearsssss.jpg', '2020-07-01'),
(11, 'Kid Normal: Kid Normal', 'Greg James', '4.50', 'Others', 79, 'The first book in a laugh-out-loud funny adventure series for 8+ readers from radio stars Greg James and Chris Smith\r\n\'So funny, it\'s almost criminal\' INDEPENDENT\r\n\'Outrageous capers\' GUARDIAN\r\nSHORTLISTED FOR THE WATERSTONES CHILDREN\'S BOOK PRIZE\r\nA TOM FLETCHER BOOK CLUB PICK\r\nMurph Cooper has a problem.\r\nHis new school is top secret, and super weird. His classmates can all fly or control the weather or conjure tiny horses from thin air. And what\'s Murph\'s extraordinary skill? Um, oh yeah â€“ he hasn\'t got one.\r\nJust as well there are no revolting supervillains lurking nearby, their minds abuzz with evil plans. There are!? Right. Ok, then...\r\nIt\'s time for Kid Normal to become a hero!', '../bookimage/kids.jpg', '2020-07-01'),
(12, 'Slime: The new childrenâ€™s book from No. 1 bestselling author David Walliams.', 'David Walliams', '25.00', 'Others', 42, 'This little island is home to a large number of horrible grown-ups. The school, the local park, the toy shop and even the islandâ€™s ice-cream van are all run by awful adults who like nothing more than making children miserable. And the island is owned by the most awful one of all â€“ Aunt Greta Greed!\r\nSomething needs to be done about them.\r\nBut who could be brave enough?\r\nMeet Ned â€“ an extraordinary boy with a special power. SLIMEPOWER!', '../bookimage/slime.jpg', '2020-07-01'),
(24, 'æŠŠåæ—¥å­è¿‡æˆå¥½æ—¥å­ï¼šè§‚ç…§äº”ç§å†…åœ¨æœ¬è´¨ï¼Œæ‰¾å›žç”Ÿæ´»ä¸­çš„æ»¡è¶³æ„Ÿ', 'ä½•æƒå³°', '28.00', 'Chinese Books', 52, 'ä½ åŽŸæœ¬å°±æ˜¯å¿«ä¹çš„ï¼Œçƒ¦æ¼æ˜¯åŽæ¥æ‰æœ‰çš„ï¼Œå›žå½’å†…åœ¨æœ¬è´¨ï¼Œå°±æ˜¯å›žåˆ°æ²¡æœ‰çƒ¦æ¼ä»¥å‰çš„é‚£é¢—å¿ƒã€‚\r\nä½•åŒ»å¸ˆæ•™ä½ è§‚ç…§äº”ç§å†…åœ¨çš„æœ¬è´¨ï¼Œæ‰¾å›žå®‰å¿ƒã€å¹³é™çš„è‡ªå·±ã€‚\r\næˆ‘ä»¬æ¯å¤©è¿‡ç€ä¸€æ ·çš„æ—¥å­ï¼Œç”Ÿæ´»é‡Œçš„å†µå‘³åªæœ‰è‡ªå·±çŸ¥é“ã€‚\r\nä½†æˆ‘ä»¬å´æ€»æ˜¯å‘å¤–æ¸´æ±‚â€œå¿«ä¹â€ï¼Œè¶Šæ‰¾è¶Šå¤±åŽ»è‡ªæˆ‘ï¼Œæƒ…ç»ªä¹Ÿè¢«åˆ«äººç‰µç€é¼»å­èµ°ã€‚\r\nçˆ±å› æ–¯å¦æ›¾è¯´ï¼šâ€œä¸€ç›´åšç€ç›¸åŒçš„äº‹å´å¸Œæœ›æœ‰æ‰€æ”¹å˜çš„äººæ˜¯ç–¯å­ã€‚â€\r\nè€Œæˆ‘ä»¬å´ä¸è‡ªè§‰åœ¨è¿™ä¸ªå¿«é€Ÿå˜è¿çš„ç¤¾ä¼šä¸­è¢«é€¼åˆ°ç²¾ç¥žç´§ç»·ã€‚\r\n\r\nä½œè€…ç®€ä»‹:\r\nä½•æƒå³°\r\nåŒ»å¸ˆå…¼ä½œå®¶ï¼ŒåŒæ—¶ä¹Ÿåœ¨å¤§å­¦æŽˆè¯¾ï¼Œä¸“é•¿æ˜¯è„‘ç¥žç»ç§‘å­¦ã€‚1995å¹´ï¼Œä»–å¼€å§‹å†™ä½œï¼Œæ—©æœŸä¸ºã€Šè”åˆæŠ¥ã€‹ã€ã€Šå¸¸æ˜¥æœˆåˆŠã€‹ã€ã€Šæ‹¾ç©—æ‚å¿—ã€‹ç­‰æ’°å†™åŒ»å­¦ä¸“æ ã€‚éšåŽï¼Œå› æŽ¥è§¦â€œå¿ƒç†ç¥žç»å…ç–«å­¦â€ï¼ˆPsychoneuroimmunologyï¼‰ï¼Œè§¦å‘äº†å¯¹â€œå¿ƒçµå±‚é¢â€çš„æŽ¢ç©¶ï¼ŒäºŽæ˜¯ä½•åŒ»å¸ˆæ”¹å˜äº†æ–¹å‘ï¼Œä»–å¼€å§‹å†™ä¸€äº›å¿ƒçµæˆé•¿å’ŒåŠ±å¿—ç±»çš„ä½œå“ã€‚ç›®å‰ï¼Œä»–æ‰€å‡ºç‰ˆçš„å¿ƒçµåŠ±å¿—ä¹¦ï¼Œå·²ç´¯ç§¯è¿‘60æœ¬ã€‚\r\nåœ¨å°æ¸¯æ¾³ã€æ–°é©¬ã€ä¸­å›½å¤§é™†ç­‰åœ°åŒºæ‹¥æœ‰ä¼—å¤šè¯»è€…ã€‚ä»–çš„ç¬”è§¦ç»†è…»ï¼Œå¹³æ˜“ä¸­æ˜¾å“²ç†ï¼Œå¦™è¶£ä¸­è§æ™ºæ…§ã€‚å¯¹é—®é¢˜æœ‰å¾ˆæ·±çš„æ´žæ‚‰ï¼Œä¸å•æ˜¯â€œè¯Šæ–­é—®é¢˜â€ï¼ŒåŒæ—¶è¿˜æä¾›è§†é‡Žå°†å¿ƒæå‡æ›´é«˜çš„å±‚æ¬¡ï¼Œâ€œå¦‚æ­¤ï¼Œè¯»è€…æ‰€èŽ·å¾—çš„ï¼Œå°±ä¸å•åªæ˜¯ä¹¦æœ¬ä¸Šçš„çŸ¥è¯†ï¼Œè€Œæ˜¯å…¨æ–°çš„äººç”Ÿã€‚â€ä½•åŒ»å¸ˆå¦‚æ˜¯è¯´ã€‚', '../bookimage/goodlife.jpg', '2020-07-20'),
(17, 'The Fault in Our Stars', 'John Green', '42.55', 'English Books', 28, 'The Fault in Our Stars is a novel by John Green. It is his fourth solo novel, and sixth novel overall. It was published on January 10, 2012. The title is inspired by Act 1, Scene 2 of Shakespeare\'s play Julius Caesar, in which the nobleman Cassius says to Brutus: \"The fault, dear Brutus, is not in our stars, / But in ourselves, that we are underlings.\" The story is narrated by Hazel Grace Lancaster, a 16-year-old girl with thyroid cancer that has affected her lungs. Hazel is forced by her parents to attend a support group where she subsequently meets and falls in love with 17-year-old Augustus Waters, an ex-basketball player and amputee. An American feature film adaptation of the novel directed by Josh Boone and starring Shailene Woodley, Ansel Elgort, and Nat Wolff was released on June 6, 2014. A Hindi feature film adaptation is set to be released on 24 July 2020. Both the book and its American film adaptation were met with strong critical and commercial success.', '../bookimage/The_Fault_in_Our_Stars.jpg', '2020-07-01'),
(18, 'The Art of War', 'Sun Tzu', '12.00', 'Chinese Books', 14, 'The Art of War is an ancient Chinese military treatise dating from the Late Spring and Autumn Period (roughly 5th century BC). The work, which is attributed to the ancient Chinese military strategist Sun Tzu (\"Master Sun\", also spelled Sunzi), is composed of 13 chapters. Each one is devoted to an aspect of warfare and how it applies to military strategy and tactics. For almost 1,500 years it was the lead text in an anthology that would be formalised as the Seven Military Classics by Emperor Shenzong of Song in 1080. The Art of War remains the most influential strategy text in East Asian warfare[1] and has influenced both Eastern and Western military thinking, business tactics, legal strategy, lifestyles and beyond.', '../bookimage/art0fwar.jpg', '2020-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(6) NOT NULL,
  `book_id` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_order`
--

DROP TABLE IF EXISTS `cart_order`;
CREATE TABLE IF NOT EXISTS `cart_order` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(6) NOT NULL,
  `book_id` int(6) NOT NULL,
  `book_qty` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_order`
--

INSERT INTO `cart_order` (`id`, `order_id`, `book_id`, `book_qty`) VALUES
(1, 9, 9, 3),
(2, 10, 18, 1),
(3, 10, 11, 1),
(4, 11, 12, 3),
(5, 11, 5, 1),
(6, 12, 17, 2),
(7, 12, 7, 2),
(8, 18, 4, 1),
(9, 19, 11, 1),
(10, 20, 10, 1),
(11, 21, 12, 1),
(12, 21, 8, 1),
(13, 22, 12, 1),
(14, 22, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `book_id` int(6) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `datetime` date NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `book_id` (`book_id`),
  KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `username`, `book_id`, `topic`, `comment`, `datetime`) VALUES
(3, 'khorwei', 10, 'Delivery On time', 'Order on 11 July received it the next day!', '2020-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(6) NOT NULL,
  `order_qty` int(6) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `orderdate` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `ordernum` varchar(200) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_qty`, `total_amount`, `orderdate`, `status`, `ordernum`) VALUES
(11, 1, 4, '115.00', '2020-07-04', 'FAIL', '1291778869'),
(12, 1, 4, '132.10', '2020-07-04', 'PROCESSING', '3910526460'),
(22, 1, 2, '45.00', '2020-07-21', 'pending', '7463956440'),
(21, 1, 2, '30.00', '2020-07-21', 'pending', '9646881117'),
(20, 1, 1, '3.50', '2020-07-21', 'pending', '4258338553'),
(19, 1, 1, '4.50', '2020-07-21', 'pending', '2122280899');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(180) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(500) NOT NULL,
  `postcode` int(5) NOT NULL,
  `state` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `fullname`, `phone`, `email`, `address`, `city`, `postcode`, `state`, `country`) VALUES
(1, 'khorwei', 'c33367701511b4f6020ec61ded352059', 'Coway Yeap', '0123456789', 'imcoway@gmail.com', 'Tropicana Residence, Block A  08-03', 'Bandar Sunway', 47500, 'Johor Bharu', 'MALAYSIA'),
(3, 'user', 'e10adc3949ba59abbe56e057f20f883e', 'khorwei', '0123456789', 'khorwei@gmail.com', 'No 26, Jalan PJS 9/26', 'Bandar Sunway', 47500, 'Selangor', 'Malaysia');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
