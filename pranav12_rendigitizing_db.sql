-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2020 at 08:20 AM
-- Server version: 5.7.29
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pranav12_rendigitizing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `admin_ip` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application`
--

CREATE TABLE `tbl_application` (
  `id` int(11) NOT NULL,
  `application` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_application`
--

INSERT INTO `tbl_application` (`id`, `application`) VALUES
(1, 'Select One'),
(2, 'Chest Front'),
(3, 'Puff'),
(4, 'Left Chest & Cap Combo'),
(5, 'Left Chest'),
(6, 'Jacket Back'),
(7, 'Cap');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applique`
--

CREATE TABLE `tbl_applique` (
  `id` int(11) NOT NULL,
  `applique` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_applique`
--

INSERT INTO `tbl_applique` (`id`, `applique`) VALUES
(1, 'YES'),
(2, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus`
--

CREATE TABLE `tbl_contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `company` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `is_registered` varchar(150) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_contactus`
--

INSERT INTO `tbl_contactus` (`id`, `name`, `email`, `phone`, `company`, `message`, `ip_address`, `is_registered`, `created_at`) VALUES
(1, 'Rishav Mandal', 'rishavmandal4@gmail.com', '9702771532', 'Student', 'cskhbcshbhsvgsvjhvsdcgvshj sdfvhsfhbvsjvcjhs cjsavcjhvws chsad cksdabchsdch savcsdahc sdhkc vusdvcudhvchadvyufwe', '::1', 'NO', '16/03/2020 12:15:23:pm'),
(2, 'Rishav Mandal', 'rishavmandal4@gmail.com', '9702771532', 'Student', 'dffbxdvjnfnmjjvklsdnvjusgunbsdnhjgnvjksdfbnjsdjfvbnskjbnvjiksdjfzbgvhjie', '::1', 'NO', '16/03/2020 12:18:47:pm'),
(3, 'Rishav Mandal', 'rishavmandal4@gmail.com', '9702771532', 'Student', 'dfgbvsdhdftrgsdfkjgsdbhfhZBfhuasdbgckjAZSncfjkhasbhfjkZSDbnfvjhikbvjihsdfbhuhuer', '::1', 'NO', '16/03/2020 12:20:49:pm'),
(4, 'Rishav Mandal', 'rishavmandal4@gmail.com', '9702771532', 'Student', 'sdfgsdzfszgdfcvyzbdzvcdyszfvczdxhcvszdgsdzxcvb gsfcvsdgyvcbgSFCVse', '123.136.188.127', 'YES, User : coder.rishav@gmail.com', '16/03/2020 10:06:06:pm'),
(5, 'Rishav Mandal', 'rishavmandal4@gmail.com', '9702771532', 'Student', 'scjhvfgvwgrvfahcbaugvcwhv beruvcbqhr3qfbvrgycvqugcvtrf3', '123.136.188.127', 'NO', '16/03/2020 10:08:44:pm'),
(6, 'Rishav Mandal', 'rishavmandal4@gmail.com', '9702771532', 'S', 'scjhvfgvwgrvfahcbaugvcwhv beruvcbqhr3qfbvrgycvqugcvtrf3', '123.136.188.127', 'NO', '16/03/2020 10:09:36:pm'),
(7, 'Rishav Mandal', 'rishavmandal4@gmail.com', 'Jjghhfhfjf', 'Fjfufr', 'Hhhhhhkydlyfdykkyxkydycmgdktdkycmxgmdktxmgxg', '123.136.188.127', 'NO', '17/03/2020 03:33:13:pm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fabric`
--

CREATE TABLE `tbl_fabric` (
  `id` int(11) NOT NULL,
  `fabric` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fabric`
--

INSERT INTO `tbl_fabric` (`id`, `fabric`) VALUES
(1, 'Select One'),
(2, 'Cotton / Twill'),
(3, 'Wool'),
(4, 'Football Shirts'),
(5, 'Fleece'),
(6, 'Towel / Terry Cloth'),
(7, 'Traditional(jersey,pique.etc)'),
(8, 'Lycra / Spandex trees'),
(9, 'Leather'),
(10, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `imageid` int(11) NOT NULL,
  `image_caption` varchar(20) NOT NULL,
  `image_path` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`imageid`, `image_caption`, `image_path`) VALUES
(1, 'Demo', 'Uploads/63ec85e8a238146961ab952d4b7aedbc.png'),
(2, 'Demo', 'Uploads/r_192233_DViJh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_including_backgroundcolor`
--

CREATE TABLE `tbl_including_backgroundcolor` (
  `id` int(11) NOT NULL,
  `yes_or_no` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_including_backgroundcolor`
--

INSERT INTO `tbl_including_backgroundcolor` (`id`, `yes_or_no`) VALUES
(1, 'YES'),
(2, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `emboridery_design_image` varchar(1000) DEFAULT NULL,
  `emboridery_supporting_image` varchar(1000) DEFAULT NULL,
  `emboridery_text` varchar(100) DEFAULT NULL,
  `emboridery_vector_design_image` varchar(1000) DEFAULT NULL,
  `emboridery_vector_supporting_image` varchar(1000) DEFAULT NULL,
  `vector_format` varchar(50) DEFAULT NULL,
  `printing_process` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `design_name` varchar(100) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `ponumber` varchar(10) DEFAULT NULL,
  `turnarround` varchar(50) DEFAULT NULL,
  `dimension` varchar(10) DEFAULT NULL,
  `dimension_width` varchar(10) DEFAULT NULL,
  `dimension_height` varchar(10) DEFAULT NULL,
  `have_bg_color` varchar(5) DEFAULT NULL,
  `stitch` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `fabric` varchar(100) DEFAULT NULL,
  `thread` varchar(100) DEFAULT NULL,
  `applique` varchar(5) DEFAULT NULL,
  `comments` varchar(150) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `order_flag` varchar(10) DEFAULT NULL,
  `order_at` varchar(50) DEFAULT NULL,
  `user` varchar(150) DEFAULT NULL,
  `user_ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `emboridery_design_image`, `emboridery_supporting_image`, `emboridery_text`, `emboridery_vector_design_image`, `emboridery_vector_supporting_image`, `vector_format`, `printing_process`, `color`, `design_name`, `category`, `ponumber`, `turnarround`, `dimension`, `dimension_width`, `dimension_height`, `have_bg_color`, `stitch`, `application`, `fabric`, `thread`, `applique`, `comments`, `price`, `order_flag`, `order_at`, `user`, `user_ip`) VALUES
(1, '8eeeY.png', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Image', '1234567890', 'Standard - 12 Hours', 'Inches', '12', '12', 'YES', 'Melco OFM', 'Puff', 'Traditional(jersey,pique.etc)', 'Medira Classic Rayon #40', 'YES', 'fdghdtttttttggggggggggggg', 30.00, 'NEW', '30/03/2020 05:52:43:pm', 'coder.rishav@gmail.com', '123.136.153.232'),
(2, NULL, NULL, 'Rishav', NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Text', '1234567890', 'Standard - 12 Hours', 'Inches', '12', '12', 'YES', 'Husqvarna HUS', 'Left Chest', 'Traditional(jersey,pique.etc)', 'Medira Classic Rayon #40', 'Yes', 'qawwwwwwwwwwwwwwwwwwwwwwwww', 40.00, 'NEW', '30/03/2020 05:54:53:pm', 'coder.rishav@gmail.com', '123.136.153.232'),
(3, NULL, NULL, NULL, 'laravel-5-6-multi-image.png', '', '.eps (Illusrator)', 'Spot Colours', '1-color logo', 'Rishav', 'Emboridery Vector', '1234567890', 'Budget - 24 Hours', 'Inches', '12', '12', 'Yes', NULL, 'Silkscreen', NULL, NULL, NULL, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 25.00, 'NEW', '30/03/2020 05:57:42:pm', 'coder.rishav@gmail.com', '123.136.153.232'),
(4, NULL, NULL, 'Rishav', NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Text', '1234567890', 'Standard - 12 Hours', 'Inches', '12', '12', 'YES', 'Husqvarna HUS', 'Left Chest', 'Traditional(jersey,pique.etc)', 'Medira Classic Rayon #40', 'Yes', 'qawwwwwwwwwwwwwwwwwwwwwwwww', 40.00, 'NEW', '30/03/2020 06:01:19:pm', 'coder.rishav@gmail.com', '123.136.153.232'),
(6, NULL, NULL, 'Rishav Demo', NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Text', '1234567890', 'Budget - 24 Hours', 'Inches', '12', '12', 'YES', 'Brother PES', 'Jacket Back', 'Wool', 'Medira Classic Rayon #40', 'Yes', 'cfcefwafwfvsafdsafsdafwfwfrwf3rfg3f34f3f3f3rgf3', 40.00, 'NEW', '15/04/2020 07:59:00:pm', 'coder.rishav@gmail.com', '123.136.151.133'),
(7, 'codercoder-logo-large.jpg', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Image', '1234567890', 'Budget - 24 Hours', 'Inches', '12', '12', 'YES', 'Barudan DSB', 'Jacket Back', 'Wool', 'Medira Classic Rayon #40', 'YES', 'sffffffffffffffffffffffffffffffffffffffffff', 40.00, 'NEW', '15/04/2020 08:04:47:pm', 'coder.rishav@gmail.com', '123.136.151.133'),
(8, NULL, NULL, NULL, 'codercoder-logo-large.jpg', '', '.ai', 'Spot Colours', 'As per part', 'Rishav Design', 'Emboridery Vector', '1234567890', 'Standard - 12 Hours', 'Inches', '12', '12', 'Yes', NULL, 'Laser engraving', NULL, NULL, NULL, 'eafwwwwwwwaaaaaaaaaaaaaaaaaaa', 50.00, 'NEW', '15/04/2020 08:24:57:pm', 'coder.rishav@gmail.com', '123.136.151.133'),
(9, NULL, NULL, 'dcwarvervtgtr', NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Text', '1234567890', 'Express - 5 hours', 'Inches', '12', '12', 'YES', 'Toyota 100', 'Left Chest & Cap Combo', 'Wool', 'Polyneon #40', 'Yes', '344444444444444444444444444444444444444rf', 40.00, 'NEW', '16/04/2020 11:14:04:am', 'coder.rishav@gmail.com', '203.90.96.79'),
(10, 'Af0sF2OS5S5gatqrKzVP_Silhoutte.jpg', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Image', '1234567890', 'Standard - 12 Hours', 'Inches', '12', '12', 'YES', 'DSZ', 'Left Chest', 'Towel / Terry Cloth', 'Medira Classic Rayon #30', 'YES', 'dqdnidgeudvgdcgyavjad cjdvycwfc wghcvweyt', 40.00, 'NEW', '16/04/2020 11:46:38:am', 'coder.rishav@gmail.com', '203.90.96.79'),
(11, NULL, NULL, NULL, 'Af0sF2OS5S5gatqrKzVP_Silhoutte.jpg', '', '.ai', 'Spot Colours', '1-color logo', 'Rishav Design', 'Emboridery Vector', '1234567890', 'Budget - 24 Hours', 'Inches', '12', '12', 'Yes', NULL, 'Laser engraving', NULL, NULL, NULL, 'ajvxgwdvcgdcwbdchvducdcvdcdjvcjwvcwu', 45.00, 'NEW', '16/04/2020 12:02:07:pm', 'coder.rishav@gmail.com', '203.90.96.79'),
(12, 'DSC100312350.jpg', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Design name', 'Emboridery Image', 'testNumber', 'Budget - 24 Hours', 'Inches', '10', '10', 'YES', 'SEW', 'Chest Front', 'Wool', 'Ackeman Isacord 30', 'YES', 'ab cd efg hi jk lm no pq rs tu v w xy z', 20.00, 'NEW', '18/04/2020 10:59:10:am', 'pranavmehta100.pm@gmail.com', '182.58.242.78'),
(13, NULL, NULL, 'Rishav Issue', NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Text', '1234567890', 'Express - 5 hours', 'Inches', '12', '12', 'YES', 'Barudan DSB', 'Puff', 'Lycra / Spandex trees', 'Medira Classic Rayon #30', 'Yes', 'xdfghdetrhjdfthfcjygfjfghftdyj75t6ut', 35.00, 'NEW', '18/04/2020 11:40:57:am', 'coder.rishav@gmail.com', '123.136.151.97'),
(14, NULL, NULL, 'issue', NULL, NULL, NULL, NULL, NULL, 'Demo', 'Emboridery Text', '1234567890', 'Express - 5 hours', 'Inches', '12', '12', 'YES', 'Barudan DSB', 'Left Chest', 'Traditional(jersey,pique.etc)', 'Ackeman Isacord 30', 'Yes', 'lnkjnjknnnkjnknkjnjnjnkjnkjnjinkjnkjnkjnkjnk', 45.00, 'NEW', '18/04/2020 11:45:08:am', 'coder.rishav@gmail.com', '123.136.151.97'),
(15, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, 'test', 'Emboridery Text', '1234567890', 'Budget - 24 Hours', 'Inches', '10', '10', 'YES', 'Toyota 100', 'Chest Front', 'Cotton / Twill', 'Ackeman Isacord 40', 'Yes', 'abcdefghijklm', 20.00, 'NEW', '18/04/2020 12:01:57:pm', 'pranavmehta100.pm@gmail.com', '182.58.242.78'),
(16, 'DSC100312350.jpg', '', NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'Emboridery Image', 'testNumber', 'Budget - 24 Hours', 'Inches', '10', '10', 'YES', 'Toyota 100', 'Chest Front', 'Cotton / Twill', 'Ackeman Isacord 40', 'YES', 'abcdefghijklm', 20.00, 'NEW', '18/04/2020 12:05:36:pm', 'pranavmehta100.pm@gmail.com', '182.58.242.78'),
(17, NULL, NULL, NULL, 'code-editoren-t.jpg', '', '.eps (Illusrator)', 'CMYK (process color)', '1-color logo', 'Rishav Vector', 'Emboridery Vector', '1234567890', 'Express - 5 hours', 'Inches', '12', '12', 'Yes', NULL, 'Sandblasting', NULL, NULL, NULL, 'fdvgfdsxgvxzvxkjvnbzxhjvsbzvuhsdbgbdfhuhvdsfbgvdsfdfbnyg', 55.00, 'NEW', '18/04/2020 12:08:35:pm', 'coder.rishav@gmail.com', '123.136.151.97'),
(18, NULL, NULL, NULL, 'DSC100312350.jpg', '', 'svg', 'Spot Colours', 'As per part', 'test', 'Emboridery Vector', 'testNumber', 'Budget - 24 Hours', 'Inches', '10', '10', 'Yes', NULL, 'Vector Art', NULL, NULL, NULL, 'abcdefghijklm', 20.00, 'NEW', '18/04/2020 12:09:37:pm', 'pranavmehta100.pm@gmail.com', '182.58.242.78');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stitch`
--

CREATE TABLE `tbl_stitch` (
  `id` int(11) NOT NULL,
  `stitch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stitch`
--

INSERT INTO `tbl_stitch` (`id`, `stitch`) VALUES
(1, 'Select Stitch'),
(2, 'Melco OFM'),
(3, 'Toyota 100'),
(4, 'Wilcom EMB'),
(5, 'Tajima DST'),
(6, 'Pulse PSF'),
(7, 'Melco Exp'),
(8, 'Compucon XXX'),
(9, 'Pfaff PCS'),
(10, 'Brother PES'),
(11, 'Husqvarna HUS'),
(12, 'Barudan DSB'),
(13, 'ZSK'),
(14, 'DSZ'),
(15, 'PCM'),
(16, 'SEW'),
(17, 'CSD'),
(18, 'Jef'),
(19, 'CND');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thread`
--

CREATE TABLE `tbl_thread` (
  `id` int(11) NOT NULL,
  `thread` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_thread`
--

INSERT INTO `tbl_thread` (`id`, `thread`) VALUES
(1, 'Select One'),
(2, 'Ackeman Isacord 40'),
(3, 'Ackeman Isacord 30'),
(4, 'Medira Classic Rayon #40'),
(5, 'Medira Classic Rayon #60'),
(6, 'Medira Classic Rayon #30'),
(7, 'Polyneon #40'),
(8, 'Polyneon #60');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_turnaround`
--

CREATE TABLE `tbl_turnaround` (
  `id` int(11) NOT NULL,
  `turnaround` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_turnaround`
--

INSERT INTO `tbl_turnaround` (`id`, `turnaround`) VALUES
(1, 'Select Plan'),
(2, 'Budget - 24 Hours'),
(3, 'Standard - 12 Hours'),
(4, 'Express - 5 hours');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `currency` varchar(15) DEFAULT NULL,
  `address` varchar(160) DEFAULT NULL,
  `postalcode` varchar(10) DEFAULT NULL,
  `password` varchar(1000) NOT NULL,
  `isemailconfirm` varchar(5) DEFAULT NULL,
  `token` varchar(10) NOT NULL,
  `token_expire` datetime DEFAULT NULL,
  `is_tnc_agreed` varchar(5) NOT NULL,
  `user_ip_address` varchar(50) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `user_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `firstname`, `lastname`, `email`, `phone`, `company`, `currency`, `address`, `postalcode`, `password`, `isemailconfirm`, `token`, `token_expire`, `is_tnc_agreed`, `user_ip_address`, `created_at`, `user_status`) VALUES
(2, 'ronak', 'singh', 'ronaksingh629@gmail.com', '9029938713', NULL, NULL, NULL, NULL, '13e18d53e084dfb5a496129467e74424204ec6fe', 'NO', 'Adm5bLEqf9', NULL, 'YES', '49.33.188.105', '16/03/2020 08:19:39:pm', 'ACTIVE'),
(3, 'Nitin', 'Singh', 'coder.rishav@hotmail.com', '9876543210', NULL, NULL, NULL, NULL, '94ba69fdd6ac7c1576e4b079514aa04004822824', 'NO', 'IMcfAgqnTZ', '2020-04-03 01:13:24', 'YES', '123.136.151.228', '19/03/2020 04:25:32:pm', 'ACTIVE'),
(4, 'ronak', 'singh', 'ronakrock662@gmail.com', '8976115076', NULL, NULL, NULL, NULL, 'cab5f285a1505618b43c477c78f95d04834d4329', 'NO', '93m2oF10QV', NULL, 'YES', '49.33.236.174', '21/03/2020 05:40:03:pm', 'ACTIVE'),
(10, 'Rishav', 'Mandal', 'coder.rishav@gmail.com', '7021150558', 'Student', 'USD', 'bhayander, Mubai', '401105', '407f06264ff6ce35fc9f3ba7cea79d16768b0d26', 'YES', '', NULL, 'YES', '1.23.57.244', '12/04/2020 12:17:09:pm', 'ACTIVE'),
(11, 'rahul', 'lanjewar', 'rahullanjewar93@gmail.com', '8805890931', NULL, NULL, NULL, NULL, '96a6c6d59836f78e563ffe920eb49462bb678f57', 'YES', 'qWv5hY0LEG', '2020-04-12 02:45:42', 'YES', '27.0.55.5', '12/04/2020 02:10:03:pm', 'ACTIVE'),
(12, 'Pranav', 'Mehta', 'pranavmehta100.pm@gmail.com', '9167236881', NULL, NULL, NULL, NULL, 'a50eb4df0ba510821ab4bc0614a4ce371e880cc2', 'YES', 'Qs9pgPm7hq', '2020-04-12 03:21:22', 'YES', '182.58.206.146', '12/04/2020 02:43:04:pm', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `tbl_application`
--
ALTER TABLE `tbl_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applique`
--
ALTER TABLE `tbl_applique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_fabric`
--
ALTER TABLE `tbl_fabric`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`imageid`);

--
-- Indexes for table `tbl_including_backgroundcolor`
--
ALTER TABLE `tbl_including_backgroundcolor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_stitch`
--
ALTER TABLE `tbl_stitch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_thread`
--
ALTER TABLE `tbl_thread`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_turnaround`
--
ALTER TABLE `tbl_turnaround`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_application`
--
ALTER TABLE `tbl_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_applique`
--
ALTER TABLE `tbl_applique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_fabric`
--
ALTER TABLE `tbl_fabric`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_including_backgroundcolor`
--
ALTER TABLE `tbl_including_backgroundcolor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_stitch`
--
ALTER TABLE `tbl_stitch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_thread`
--
ALTER TABLE `tbl_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_turnaround`
--
ALTER TABLE `tbl_turnaround`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
