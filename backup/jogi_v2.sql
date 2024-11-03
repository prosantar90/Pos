-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2024 at 12:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jogi`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` int(11) NOT NULL,
  `bond_no` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `cfname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cphone` varchar(255) NOT NULL,
  `aadhar` varchar(255) NOT NULL,
  `other_c` varchar(255) NOT NULL,
  `other_c_n` varchar(255) NOT NULL,
  `dist` varchar(255) NOT NULL,
  `post_office` varchar(255) NOT NULL,
  `cps` varchar(255) NOT NULL,
  `p_cat` int(255) NOT NULL,
  `cdate` varchar(255) NOT NULL,
  `deliver_date` varchar(255) NOT NULL,
  `packet` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `lock_unlock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dist_db`
--

CREATE TABLE `dist_db` (
  `dib` int(11) NOT NULL,
  `dist_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dist_db`
--

INSERT INTO `dist_db` (`dib`, `dist_name`) VALUES
(1, 'Malda'),
(2, 'Alipurduar'),
(3, 'Bankura'),
(4, 'Birbhum'),
(5, 'Cooch Behar'),
(6, 'Dakshin Dinajpur'),
(7, 'Darjeeling'),
(8, 'Hooghly'),
(9, 'Howrah'),
(10, 'Jalpaiguri'),
(11, 'Jhargram'),
(12, 'Kalimpong'),
(13, 'Kolkata'),
(14, 'Malda'),
(15, 'Murshidabad'),
(16, 'Nadia'),
(17, 'North 24 Parganas'),
(18, 'Paschim Medinipur'),
(19, 'Paschim Burdwan'),
(20, 'Purba Burdwan'),
(21, 'Purba Medinipur'),
(22, 'Purulia'),
(23, 'South 24 Parganas'),
(24, 'Uttar Dinajpur');

-- --------------------------------------------------------

--
-- Table structure for table `expanses`
--

CREATE TABLE `expanses` (
  `eid` int(11) NOT NULL,
  `resaon` varchar(255) NOT NULL,
  `e_amount` varchar(255) NOT NULL,
  `e_remarks` varchar(255) NOT NULL,
  `e_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manage_status`
--

CREATE TABLE `manage_status` (
  `sid` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_status`
--

INSERT INTO `manage_status` (`sid`, `status_name`) VALUES
(1, 'Processing'),
(2, 'Good Quality'),
(3, 'Avarage Quality'),
(4, 'Small Quality'),
(5, 'Damage Quality'),
(6, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `manage_stock`
--

CREATE TABLE `manage_stock` (
  `mid` int(11) NOT NULL,
  `opening_stock` int(255) NOT NULL,
  `manage_colie` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage_stock`
--

INSERT INTO `manage_stock` (`mid`, `opening_stock`, `manage_colie`) VALUES
(1, 195096, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `money_recieve`
--

CREATE TABLE `money_recieve` (
  `rid` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `charge_name` varchar(255) NOT NULL,
  `r_packet` varchar(255) NOT NULL,
  `r_date` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `less_advance` varchar(255) NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `total_packet` int(11) NOT NULL,
  `party_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `otp_verify`
--

CREATE TABLE `otp_verify` (
  `otpId` int(11) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expired` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_office`
--

CREATE TABLE `post_office` (
  `post_id` int(11) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `distId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_office`
--

INSERT INTO `post_office` (`post_id`, `post_name`, `distId`) VALUES
(1, 'Adina Station', 1),
(2, 'Agra Harishchandrapur', 1),
(3, 'Ahil', 1),
(4, 'Ahora', 1),
(5, 'Aiho', 1),
(6, 'Akalpur', 1),
(7, 'Akandabaria', 1),
(8, 'Alal', 1),
(9, 'Amrity', 1),
(10, 'Araidanga', 1),
(11, 'Araji Jalsa', 1),
(12, 'Arapur', 1),
(13, 'Arbora', 1),
(14, 'Arjunpur', 1),
(15, 'Asrafpur', 1),
(16, 'Atgama', 1),
(17, 'Babupur', 1),
(18, 'Bachamari', 1),
(19, 'Badnagra', 1),
(20, 'Baghua', 1),
(21, 'Bagsarai', 1),
(22, 'Bahadurpur', 1),
(23, 'Baharal', 1),
(24, 'Bahirkap', 1),
(25, 'Bairachhi', 1),
(26, 'Baishnabnagar', 1),
(27, 'Bakdukra Anantalalpur', 1),
(28, 'Bakharpur', 1),
(29, 'Baldiapukur', 1),
(30, 'Balia Nawabganj', 1),
(31, 'Baliadanga', 1),
(32, 'Baluachara', 1),
(33, 'Baluchar', 1),
(34, 'Balupur', 1),
(35, 'Bamangola', 1),
(36, 'Bamangram', 1),
(37, 'Bangitola', 1),
(38, 'Bangrua', 1),
(39, 'Banikantatala', 1),
(40, 'Bansbari', 1),
(41, 'Bansdol Daulatpur', 1),
(42, 'Barduary', 1),
(43, 'Barkol', 1),
(44, 'Batna', 1),
(45, 'Bedrabad', 1),
(46, 'Bhabanipur', 1),
(47, 'Bhado', 1),
(48, 'Bhaluka Bazar', 1),
(49, 'Bhatol chandipur', 1),
(50, 'Bheba', 1),
(51, 'Bhgabanpur', 1),
(52, 'Bhingole', 1),
(53, 'Bholaichak', 1),
(54, 'Bhutni', 1),
(55, 'Bilaimari', 1),
(56, 'Binodpur', 1),
(57, 'Birampur', 1),
(58, 'Birosthali', 1),
(59, 'Bishanpur', 1),
(60, 'Boroi', 1),
(61, 'Brahmangram', 1),
(62, 'Budhia', 1),
(63, 'Bulbulchadi', 1),
(64, 'Chakbahadurpur', 1),
(65, 'Chaksukdebpur', 1),
(66, 'Chamagram', 1),
(67, 'Chanchal', 1),
(68, 'Chandipur', 1),
(69, 'Chandmoni', 1),
(70, 'Chandrapara', 1),
(71, 'Char Sujapur Mandai', 1),
(72, 'Charbabupur', 1),
(73, 'Charianantapur', 1),
(74, 'Chaspara', 1),
(75, 'Chhoto Sujapur', 1),
(76, 'Chorolmoni', 1),
(77, 'Chowki Mirdadpur', 1),
(78, 'Dahua', 1),
(79, 'Dakshin Alinagar', 1),
(80, 'Dakshin Lakshmipur', 1),
(81, 'Dalla Madhyapara', 1),
(82, 'Dallugram', 1),
(83, 'Dallutola', 1),
(84, 'Damaipur', 1),
(85, 'Damodartola', 1),
(86, 'Daulatnagar', 1),
(87, 'Debiganj', 1),
(88, 'Debipur Achintala', 1),
(89, 'Debipur', 1),
(90, 'Deotala', 1),
(91, 'Dhangara', 1),
(92, 'Dhaoel', 1),
(93, 'Dharampur', 1),
(94, 'Dharmadanga', 1),
(95, 'Dhumadighi', 1),
(96, 'Dighalbar', 1),
(97, 'District School Board', 1),
(98, 'Dobakhokshan', 1),
(99, 'Dohil', 1),
(100, 'Duisatabighi', 1),
(101, 'Ekborna', 1),
(102, 'Enayetpur', 1),
(103, 'Fatehkhani', 1),
(104, 'Fatehpur', 1),
(105, 'Fulbari', 1),
(106, 'Gajol', 1),
(107, 'Galimpur', 1),
(108, 'Gandhinagar', 1),
(109, 'Gangadevi', 1),
(110, 'Gangaprasad', 1),
(111, 'Gayeshbari', 1),
(112, 'Goalpara', 1),
(113, 'Golapganj', 1),
(114, 'Gopalpur', 1),
(115, 'Gopalpurhat', 1),
(116, 'Goraksha', 1),
(117, 'Gour', 1),
(118, 'Gouramari', 1),
(119, 'Gurutola', 1),
(120, 'Habibpur', 1),
(121, 'Hamidpur', 1),
(122, 'Hardamnagar', 1),
(123, 'Haripur', 1),
(124, 'Harishchandrapur Bazar', 1),
(125, 'Harishchandrapur', 1),
(126, 'Harkharkha', 1),
(127, 'Haruchak', 1),
(128, 'Hatimari', 1),
(129, 'Hatinda', 1),
(130, 'Hazarat Jalalpur', 1),
(131, 'Ichahar', 1),
(132, 'Ishadpur', 1),
(133, 'Ismailpur', 1),
(134, 'Jabra', 1),
(135, 'Jadupur', 1),
(136, 'Jagannathpur', 1),
(137, 'Jagannathpur Maltola', 1),
(138, 'Jagannathpur Rathbari', 1),
(139, 'Jagdala', 1),
(140, 'Jagjibanpur', 1),
(141, 'Jalalpur', 1),
(142, 'Jaluabadhal Mallikpara', 1),
(143, 'Jamirghata Sarkarpara', 1),
(144, 'Janakiramtola', 1),
(145, 'Jatradanga', 1),
(146, 'Jhaljhalia Railway Colony', 1),
(147, 'Jharpukhuria', 1),
(148, 'Jitarpur', 1),
(149, 'Jitnagar', 1),
(150, 'Jote Basanta', 1),
(151, 'Jotgopal Kagmari', 1),
(152, 'Jotparam', 1),
(153, 'Joyenpur', 1),
(154, 'Jugaltola', 1),
(155, 'K.B Jhowbona', 1),
(156, 'Kadamtala', 1),
(157, 'Kadamtali', 1),
(158, 'Kahala', 1),
(159, 'Kajigram Chandipur', 1),
(160, 'Kaliachak', 1),
(161, 'Kaligaon', 1),
(162, 'Kamalabari', 1),
(163, 'Kamaldanga', 1),
(164, 'Kamalpur', 1),
(165, 'Kanchantar', 1),
(166, 'Kandaran', 1),
(167, 'Kanturka', 1),
(168, 'Karbona', 1),
(169, 'Kariali', 1),
(170, 'Kashimpur', 1),
(171, 'Katikandar', 1),
(172, 'Katlamari', 1),
(173, 'Katna', 1),
(174, 'Kendpukur', 1),
(175, 'Khairtola', 1),
(176, 'Khanta', 1),
(177, 'Kharba', 1),
(178, 'Khaschandpur', 1),
(179, 'Khaskol Chandipur', 1),
(180, 'Khejuriaghat', 1),
(181, 'Khoilsona', 1),
(182, 'Khopakati', 1),
(183, 'Khoribari', 1),
(184, 'Khutadaha', 1),
(185, 'Koilabad', 1),
(186, 'Koklamari', 1),
(187, 'Kotalpur', 1),
(188, 'Kotwali ', 1),
(189, 'Krishnapur', 1),
(190, 'Kumarga R.S.', 1),
(191, 'Kupadaha', 1),
(192, 'Kushida', 1),
(193, 'Kushmai', 1),
(194, 'Kutubganj', 1),
(195, 'Kutubsahar', 1),
(196, 'Lakshmipur', 1),
(197, 'Lakshmipur', 1),
(198, 'Lalbathani', 1),
(199, 'Laskarpur', 1),
(200, 'Madapur', 1),
(201, 'Madhaipur', 1),
(202, 'Madhugaht Filature Estate', 1),
(203, 'Madnabati', 1),
(204, 'Magurai', 1),
(205, 'Mahadevpur', 1),
(206, 'Mahadipur', 1),
(207, 'Mahakalbona', 1),
(208, 'Mahanandatola', 1),
(209, 'Maharajpur', 1),
(210, 'Mahendrapur', 1),
(211, 'Malatipur', 1),
(212, 'Maliha', 1),
(213, 'Malikan', 1),
(214, 'Malior', 1),
(215, 'Malipara', 1),
(216, 'Mallikpara', 1),
(217, 'Mangalbari', 1),
(218, 'Manikchak', 1),
(219, 'Maniknagar', 1),
(220, 'Manikora', 1),
(221, 'Masheshpur', 1),
(222, 'Mathurapur ', 1),
(223, 'Mayna', 1),
(224, 'Meherapur', 1),
(225, 'Miahat', 1),
(226, 'Milangarh', 1),
(227, 'Milki', 1),
(228, 'Mirchak', 1),
(229, 'Mirjatpur', 1),
(230, 'Mohana', 1),
(231, 'Molladighi', 1),
(232, 'Mosimpur', 1),
(233, 'Mothabari', 1),
(234, 'Motiharpur', 1),
(235, 'Mudapur', 1),
(236, 'Mukdumpur', 1),
(237, 'Mulaibari', 1),
(238, 'Nabinagar', 1),
(239, 'Nageswarpur', 1),
(240, 'Nagharia', 1),
(241, 'Naikanda', 1),
(242, 'Nakail', 1),
(243, 'Nalagola', 1),
(244, 'Nandalalpur', 1),
(245, 'Narayanpur ', 1),
(246, 'Nawada', 1),
(247, 'Nayagram', 1),
(248, 'Nazirpur', 1),
(249, 'Netaji Subhas Road', 1),
(250, 'New Sadlichak', 1),
(251, 'Niamatpur', 1),
(252, 'Noaborar Jaigir', 1),
(253, 'Noorganj', 1),
(254, 'Nurpur', 1),
(255, 'Pakuahat', 1),
(256, 'Palgachhi', 1),
(257, 'Panchanandapur', 1),
(258, 'Panchpara', 1),
(259, 'Pannapur', 1),
(260, 'Parail', 1),
(261, 'Paraninagar', 1),
(262, 'Paranpur', 1),
(263, 'Parbatidanga', 1),
(264, 'Paro', 1),
(265, 'Patul', 1),
(266, 'Phulbaria', 1),
(267, 'Pipla', 1),
(268, 'Pirganj', 1),
(269, 'Pirpur', 1),
(270, 'Popra', 1),
(271, 'Pubarun', 1),
(272, 'Pukhuria', 1),
(273, 'Purba Bahadurpur', 1),
(274, 'Purba Ranipur', 1),
(275, 'Purbasaidpur', 1),
(276, 'Rabindra Avenue', 1),
(277, 'Rahimpur', 1),
(278, 'Rahutara', 1),
(279, 'Rajadighi', 1),
(280, 'Rajapur', 1),
(281, 'Rajbati Ramnagar', 1),
(282, 'Rajnagar', 1),
(283, 'Ramnagar', 1),
(284, 'Ramsimul', 1),
(285, 'Raninagar', 1),
(286, 'Rasulpur', 1),
(287, 'Rathbari', 1),
(288, 'Ratua', 1),
(289, 'Sabdalpur', 1),
(290, 'Sadarpur', 1),
(291, 'Sahabattola', 1),
(292, 'Sahabazpur', 1),
(293, 'Sahapur', 1),
(294, 'Salaidanga', 1),
(295, 'Sambalpur', 1),
(296, 'Sambalpur Tal', 1),
(297, 'Samsi', 1),
(298, 'Santoshpur', 1),
(299, 'Sapmari', 1),
(300, 'Sarbamangalapally', 1),
(301, 'Sattari', 1),
(302, 'Serpur Mukdumpur', 1),
(303, 'Shashani', 1),
(304, 'Sherpur', 1),
(305, 'Shersahi', 1),
(306, 'Shivajinagar', 1),
(307, 'Singabad', 1),
(308, 'Singhia', 1),
(309, 'Sirshi', 1),
(310, 'Sonarai', 1),
(311, 'South Kadamtala', 1),
(312, 'Sovanagar', 1),
(313, 'Sripur', 1),
(314, 'Sripur Colony', 1),
(315, 'Srirampur', 1),
(316, 'Sujapur', 1),
(317, 'Sukdevpur', 1),
(318, 'Sukdevtola', 1),
(319, 'Suksena', 1),
(320, 'Sultanganj', 1),
(321, 'Sultannagar', 1),
(322, 'Taherpur', 1),
(323, 'Talbangrua', 1),
(324, 'Talgachhi', 1),
(325, 'Talgramhat,', 1),
(326, 'Talsur', 1),
(327, 'Tulsihatta', 1),
(328, 'Umakantatola', 1),
(329, 'Uttar Chandipur', 1),
(330, 'Uttar Dariapur', 1),
(331, 'Uttar Lakshmipur', 1),
(332, 'Uttar Mahadipur', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_db`
--

CREATE TABLE `ps_db` (
  `psid` int(11) NOT NULL,
  `ps_name` varchar(255) NOT NULL,
  `dist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ps_db`
--

INSERT INTO `ps_db` (`psid`, `ps_name`, `dist_id`) VALUES
(1, 'Baishnabnagar', 1),
(2, 'Bamangola ', 1),
(3, 'Chanchal', 1),
(4, 'English Bazar', 1),
(5, 'Gajole', 1),
(6, 'Habibpur', 1),
(7, 'Harishchandrapur', 1),
(8, 'Kaliachak', 1),
(9, 'Malda', 1),
(10, 'Manickchak', 1),
(11, 'Mothabari O.P.', 1),
(12, 'Pakuahat O.P.', 1),
(13, 'Ratua', 1),
(14, 'Samsi O.P.', 1),
(15, 'Balurghat Police Station', 6),
(16, 'Banshihari Police Station', 6),
(17, 'Gangarampur Police Station', 6),
(18, 'Harirampur Police Station', 6),
(19, 'Hili Police Station', 6),
(20, 'Kumarganj Police Station', 6),
(21, 'Kushmandi Police Station', 6),
(22, 'Tapan Police Station', 6),
(23, 'Raiganj PS', 24),
(24, 'Kaliaganj PS', 24),
(25, 'tahar PS', 24),
(26, 'Hemtabad PS', 24),
(27, 'Islampur PS ', 24),
(28, 'Chopra PS', 24),
(29, 'Goalpukhur PS', 24),
(30, 'Karandighi PS', 24),
(31, 'Chakulia PS ', 24);

-- --------------------------------------------------------

--
-- Table structure for table `p_cat`
--

CREATE TABLE `p_cat` (
  `pid` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `csr` varchar(255) NOT NULL,
  `dcf` varchar(255) NOT NULL,
  `icf` varchar(255) NOT NULL,
  `misc` varchar(255) NOT NULL,
  `policy` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `p_cat`
--

INSERT INTO `p_cat` (`pid`, `p_name`, `csr`, `dcf`, `icf`, `misc`, `policy`) VALUES
(1, 'Potato', '86', '7', '4.9', '6.1', '&lt;p&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;/p&gt;&lt;h3 style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: 1.2rem;&quot;&gt;&lt;u&gt;&lt;b&gt;শর্তাবলী&lt;/b&gt;&lt;/u&gt;&lt;/span&gt;&lt;/h3&gt;১)বহুমুখী সংরক্ষনের সীমা ১৫ নভেম্বর ২০২৩&amp;nbsp;পর্য্যন্ত ধার্য্য&amp;nbsp; হইল।&lt;br&gt;২)বহুমুখী সংরক্ষনের সীমা ১৫ নভেম্বর পর্যন্ত সকল সংরক্ষণকারীর জন্য ভাড়ার হার কুইন্টাল প্রতি ১৯২.00 (একশত বিরানব্বই টাকা)&lt;br&gt;৩) সরকারি নিয়ম অনুযায়ী ভাড়ার হার পরিবর্ধন ও পরিবর্তন যোগ্য।&lt;br&gt;৪) ১৫ নভেম্বর উত্তীর্ন&amp;nbsp; হওয়া সত্ত্বেও যদি মাল ডেলিভারী না লওয়া হয় তাহা হইলে অতিরিক্ত দিনের জন্য কুইন্টাল প্রতি ২.০০ টাকা অতিরিক্ত ভাড়া দিতে হইবে। কিন্তু আলু ৩০ শে নভেম্বরর মধ্যে ডেলিভারী&amp;nbsp; না হইলে হিম কতৃপক্ষ উক্ত -দ্রব্যের জন্য দায়ী থাকিবেন না এবং প্রয়োজনে উক্ত দ্রব্য বিক্রয় করিয়া সমস্ত আদায় ওয়াশীল করিতে পারিবেন।&lt;br&gt;৫)হিমঘরে উক্ত দ্রব্য সংরক্ষনকারীর নিজ দায়িত্বে রাখিতে হইবে। উপযুক্ত তাপ, আদ্রতা, রাখিবার যথা সম্ভব চেষ্টা করা হইবে।&amp;nbsp; কিন্তু বন্যা বজ্রাঘাত ভূমিকম্প, ধর্মঘট, দাঙ্গা প্রভৃতি আয়ত্তের বাহিরে অন্য কোন প্রকার ক্ষয়ক্ষতি জন্য হিমঘর কর্তৃপক্ষ দায়ী থাকিবেন না। তবে নির্দিষ্ট জমা দ্রব্য যান্ত্রিক গোলযোগ বিদ্যুৎ সরবরাহের গোলযোগ এবং অগ্নির দরুন ক্ষয়ক্ষতি বিরুদ্ধে বিমাকারনের বেবস্থা থাকায় বস্তা /ঝুড়ি প্রতি দুই টাকা হিসাবে ইনসিওরেন্স চার্জ&amp;nbsp; দিতে হইবে। ( ইনসিওরেন্স চার্জ প্রয়োজনে পরিবর্তনযোগ্য).&lt;br&gt;৬)সুরক্ষিত উক্ত দ্রব্য শুকাইবার জন্য ৩০ শে সেপ্টেম্বর পর্য্যন্ত অগ্রাধিকার হিসাবে সুযোগ দেওয়া হইবে। কিন্তু উহার জন্য ৮ ঘন্টার অতিরিক্ত সময় দেওয়া হইবে না। উক্ত দ্রব্য শুকাইবার জন্য ভাড়া ব্যতীত বস্তা প্রতি (৫০ কেজি ) টাকা হরে অতিরিক্ত চার্জ খরচ দিতে হইবে। ৮ঘন্টার বেশী উক্ত দ্রব্য শুকাইবার সময় লাগিলে কর্তৃপক্ষ অতিরিক্ত সময়ের জন্য প্রতি ঘন্টায় কুইন্টাল প্রতি পয়সা চার্জ নেবেন।&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;৭)অগ্রিম ভাড়া বাবদ চুক্তির শর্তানুযায়ী উক্ত দ্রব্য রাখিলে সেই কম পরিমান উক্ত দ্রব্য সংরক্ষণের জন্য দেয় অগ্রিম টাকা বাজেয়াপ্ত হইবে।&lt;p&gt;৮)দ্রব্য প্রতি প্যাকেট /ঝুড়ি&amp;nbsp; ৫০ কেজি ওজন হিসাবে জমা দিতে হইবে ৫০ কেজি কম ওজন হইলে প্রতি প্যাকেট /ঝুড়ি ৫০ কেজি ওজন হিসাবে ভাড়া দিতে হইবে। মোটা এবং পুরাতন বস্তা /ঝুড়ির পরিবর্তে পাতলা (Hossian Bag) প্যাকেট /ঝুড়ি জমা দিতে হইবে।&lt;br&gt;পুরাতন বা খারাপ কিংবা মোটা বস্তার মাল কম বা বেশি ক্ষতি হইলে হিমঘর দায়ী থাকিবেন না।&lt;br&gt;৯)সংক্ষিত মালের শুক্তি শতকরা ৫ ভাগ দিতে হইবে।&amp;nbsp; সমস্ত পাওনা টাকা দেওয়া থাকিলে উক্ত দ্রব্য ফেরৎ দেওয়া হইবে। জামদাতার নিকট হইতে ১০ দিনের নোটিশ পাইলে উক্ত দ্রব্য ফেরৎ দেওয়ার দিন ও সময় ধার্য হইবে।&amp;nbsp; দ্রব্য হিমঘর হইতে বাহির করিয়া প্রয়োজন হইলে ওজন করা হইবে। জমাকারী বা তাহার ক্ষমতাপ্রাপ্ত প্রতিনিধি উপস্থিত না থাকিলেও উক্ত দ্রব্য ওজন হইলে জমাকারীকে উহা মানিয়া লইতে হইবে।&amp;nbsp; নোটিশের উল্লিখিত দিনে দ্রব্য ফেরতের জন্য হিমঘর কর্তৃপক্ষ যথাসাধ্য চেষ্টা করিবেন কিন্তু অত্যাধিক ভীর ও অসুবিধা বাঁচাইবার জন্য হিমঘর কর্তৃপক্ষ অন্য যে কোন দিন দ্রব্য ফেরতের জন্য হিমঘর কর্তৃপক্ষ যথাসাধ্য চেষ্টা করিবেন কিন্তু অত্যাধিক ভির ও অসুবিধা বাঁচাইবার জন্য হিমঘর কর্তৃপক্ষ অন্য যে কোন দিনে দ্রব্য ফেরতের দিন নির্দ্ধারিত করিতে পারিবে। দ্রব্য শুকাইবার পর ওজন করিয়া কোন কম হইলে তাহার জন্য হিমঘর কর্তৃপক্ষ দায়ী থাকবেন না&lt;br&gt;১০) জমার জন্য দ্রব্যের মধ্যে পচা বা খারাপ মাল থাকিলে তাহা জমাদাতাকে কর্তৃপক্ষের ইচ্ছামত মাল বাছিয়া দিতে হইবে। নইলে ঐ মাল কর্তৃপক্ষ রাখিতে বাধ্য নহেন।&lt;br&gt;১১)কোন বিজ্ঞপ্তি বা নোটিশ দিতে নইলে উহা জমা রসিদে দেওয়া ঠিকানায় পোস্টাল সার্টিফিকেটে পোস্ট করিলে যথেষ্ট হইবে। কর্তৃপক্ষ ইচ্ছা করিলে একটি বাংলা ও একটি ইংরেজি অথবা স্থানীয় কাগজে একবার প্রকাশ করিতেও পারে। প্রয়োজন বোধে জমাদাতাকে তিন দিনের নোটিশ মাল লইতে বাধ্য করা যাইতে পারে।&lt;br&gt;জমাদার হাজির না হইলে কর্তিপক্ষের ব্যবস্থাই চূড়ান্ত বলিয়া গণ্য হইবে।&lt;br&gt;১২)হিমঘর পক্ষ হইতে সংরক্ষনকারীকে লিখিতভাবে যে তারিখ দেওয়া&amp;nbsp; হইবে সেই তারিখে অবশ্যই দ্রব্য পাঠাইতে হইবে। তারিখ ব্যতীত দ্রব্য জমা লওয়া এবং ডেলিভারী দেওয়া হইবে না।&lt;br&gt;১৩)উপরিউল্লিখিত শর্তাবলী ব্যতীত হিমঘর কর্তৃপক্ষ পরবর্তীকালে কোন যুক্তিসঙ্গত শর্ত আরোপ করিলে তাহা সংরক্ষণকারীকে অবশ্যই মানিয়া লইতে হইবে এবং সরকার কোন নতুন কর ধার্য্য করলে তাহা অবশ্যই দিতে বাধ্য থাকিতে হইবে।বন্ডের উপরিউক্ত শর্তসাপেক্ষে কোন বিরোধ দেখা দিলে লাইসেন্সিং অফিসারের সিদ্ধান্ত চূড়ান্ত বলিয়া বিবেচিত হইবে।&lt;br&gt;১৪) দ্রব্য স্টোরের জন্য উপযুক্ত না অনুপযুক্ত তাহা পরিদর্শন করিবার দায়িত্ব পরিচালকমন্ডলীর থাকিবে। যদি স্টোরের পর কোন দ্রব্য দুর্গন্ধ হইয়া যায় অথবা স্টোরের জন্য দ্রব্যকে দূষিত ও নষ্ট করে তবে পরিচালিকেরা উক্ত দ্রব্য স্টোরের সীমার বাহিরে আনিতে পারিবেন এবং সেই দ্রব্য কোনোরূপ ক্ষতির জন্য পরিচালকমন্ডলী দায়ী হইবেন না প্রয়োজন অনুযায়ী যে কোন সংরক্ষন দ্রব্যের প্যাকেট /ঝুড়ি পরীক্ষা করিবার বা খুলিয়া দেখিবার অধিকার পরিচালক মণ্ডলী থাকিবে।&lt;br&gt;১৫)সংরক্ষিত দ্রব্য ওয়েস্টবেঙ্গল কোল্ড স্টোরেজ লাইসেন্সিং এমডি রেগুলেশন প্যাকেট ১৯৬৬-র ১২ নং ধারামতে এবং উহার সহিত সংশ্লিষ্ট নিয়ম অনুসারে সংরক্ষণকারী মাল বাহিরের নির্দিষ্ট তারিখের ৩দিন মধ্যে স্টোর হইতে যদি তাহার দ্রব্য বাহির না করেন তবে সেই উক্ত দ্রব্য প্রকাশ্য নিলামে বিক্রয় করিবার অধিকার পরিচালকদের থাকিবে।&lt;br&gt;১৬) কোল্ড স্টোরেজের রসিদ এই নিয়ম ও শর্তাবলী অনুযায়ী প্রস্তুত হইয়াছে এবং দ্রব্য গ্রহণ করিবার সময় উক্ত রসিদ আমাদের নিকট দাখিল করিতে হইবে।&lt;br&gt;১৭)যদি রাজ্যসরকার বা কোন লোকাল বডি দ্রব্যের কোন কর বা উপকর ধার্য্য করেন তবে সংরক্ষণকারী ঐ কর উপকর দিতে বাধ্য থাকিবেন।&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left; border-top:2px solid #000;&quot;&gt;বিঃদ্রঃ -১) কোন সদস্য তাহার নির্দিষ্ট (Quota) পরিমাণের বেশী দ্রব্য রাখিলে কর্তৃপক্ষ ওই অতিরিক্ত দ্রব্যের জন্য অন্যান্য ক্ষেত্রে ধার্য্য হারে চাজ আদায় করিতে পারিবেন। (২) ১৫ ই নভেম্বর উত্তীর্ন হইয়া সত্ত্বেও যদি কোন মাল ডেলিভারী না লওয়া হয় তাহা হইলে অতিরিক্ত প্রতিদানের জন্য কুইন্টাল প্রতি টাকা হারে অতিরিক্ত ভাড়া দিতে হইবে।&lt;/p&gt;&lt;p style=&quot;text-align: left; border-top:2px solid #000;&quot;&gt;আবেদনকারীর সাক্ষর&amp;nbsp; :&lt;br&gt;&lt;/p&gt;'),
(2, 'Eggs', '32', '0', '0', '0', '&lt;h5 dir=&quot;ltr&quot; style=&quot;margin-top: 11pt; margin-bottom: 2pt; font-family: &amp;quot;Source Sans Pro&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;; line-height: 1.38; color: rgb(0, 0, 0); text-align: center;&quot;&gt;&lt;span style=&quot;font-size: 10pt; font-family: Arial; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; text-decoration-line: underline; text-decoration-skip-ink: none; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;শর্তাবলী&lt;/span&gt;&lt;/h5&gt;&lt;h5 dir=&quot;ltr&quot; style=&quot;margin-top: 11pt; margin-bottom: 2pt; font-family: &amp;quot;Source Sans Pro&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;; line-height: 1.38; color: rgb(0, 0, 0);&quot;&gt;&lt;span id=&quot;docs-internal-guid-f0873142-7fff-6e6e-a3ae-06a215e2c555&quot;&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১)বহুমুখী সংরক্ষনের সীমা ১৫ নভেম্বর ২০২২ পর্য্যন্ত ধার্য্য&amp;nbsp; হইল।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;২)বহুমুখী সংরক্ষনের সীমা ১৫ নভেম্বর পর্যন্ত সকল সংরক্ষণকারীর জন্য ভাড়ার হার কুইন্টাল প্রতি ১৬১.০০(এক শত একষট্টি )&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;৩) সরকারি নিয়ম অনুযায়ী ভাড়ার হার পরিবর্ধন ও পরিবর্তন যোগ্য।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;৪) ১৫ নভেম্বর উত্তীর্ন&amp;nbsp; হওয়া সত্ত্বেও যদি মাল ডেলিভারী না লওয়া হয় তাহা হইলে অতিরিক্ত দিনের জন্য কুইন্টাল প্রতি ২.০০ টাকা অতিরিক্ত ভাড়া দিতে হইবে। কিন্তু আলু ৩০ শে নভেম্বরর মধ্যে ডেলিভারী&amp;nbsp; না হইলে হিম কতৃপক্ষ উক্ত -দ্রব্যের জন্য দায়ী থাকিবেন না এবং প্রয়োজনে উক্ত দ্রব্য বিক্রয় করিয়া সমস্ত আদায় ওয়াশীল করিতে পারিবেন।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;৫)হিমঘরে উক্ত দ্রব্য সংরক্ষনকারীর নিজ দায়িত্বে রাখিতে হইবে। উপযুক্ত তাপ, আদ্রতা, রাখিবার যথা সম্ভব চেষ্টা করা হইবে।&amp;nbsp; কিন্তু বন্যা বজ্রাঘাত ভূমিকম্প, ধর্মঘট, দাঙ্গা প্রভৃতি আয়ত্তের বাহিরে অন্য কোন প্রকার ক্ষয়ক্ষতি জন্য হিমঘর কর্তৃপক্ষ দায়ী থাকিবেন না। তবে নির্দিষ্ট জমা দ্রব্য যান্ত্রিক গোলযোগ বিদ্যুৎ সরবরাহের গোলযোগ এবং অগ্নির দরুন ক্ষয়ক্ষতি বিরুদ্ধে বিমাকারনের বেবস্থা থাকায় বস্তা /ঝুড়ি প্রতি দুই টাকা হিসাবে ইনসিওরেন্স চার্জ&amp;nbsp; দিতে হইবে। ( ইনসিওরেন্স চার্জ প্রয়োজনে পরিবর্তনযোগ্য).&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;৬)সুরক্ষিত উক্ত দ্রব্য শুকাইবার জন্য ৩০ শে সেপ্টেম্বর পর্য্যন্ত অগ্রাধিকার হিসাবে সুযোগ দেওয়া হইবে। কিন্তু উহার জন্য ৮ ঘন্টার অতিরিক্ত সময় দেওয়া হইবে না। উক্ত দ্রব্য শুকাইবার জন্য ভাড়া ব্যতীত বস্তা প্রতি (৫০ কেজি ) টাকা হরে অতিরিক্ত চার্জ খরচ দিতে হইবে। ৮ঘন্টার বেশী উক্ত দ্রব্য শুকাইবার সময় লাগিলে কর্তৃপক্ষ অতিরিক্ত সময়ের জন্য প্রতি ঘন্টায় কুইন্টাল প্রতি পয়সা চার্জ নেবেন।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;৭)অগ্রিম ভাড়া বাবদ চুক্তির শর্তানুযায়ী উক্ত দ্রব্য রাখিলে সেই কম পরিমান উক্ত দ্রব্য সংরক্ষণের জন্য দেয় অগ্রিম টাকা বাজেয়াপ্ত হইবে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;৮)দ্রব্য প্রতি প্যাকেট /ঝুড়ি&amp;nbsp; ৫০ কেজি ওজন হিসাবে জমা দিতে হইবে ৫০ কেজি কম ওজন হইলে প্রতি প্যাকেট /ঝুড়ি ৫০ কেজি ওজন হিসাবে ভাড়া দিতে হইবে। মোটা এবং পুরাতন বস্তা /ঝুড়ির পরিবর্তে পাতলা (Hossian Bag) প্যাকেট /ঝুড়ি জমা দিতে হইবে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;পুরাতন বা খারাপ কিংবা মোটা বস্তার মাল কম বা বেশি ক্ষতি হইলে হিমঘর দায়ী থাকিবেন না।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;৯)সংক্ষিত মালের শুক্তি শতকরা ৫ ভাগ দিতে হইবে।&amp;nbsp; সমস্ত পাওনা টাকা দেওয়া থাকিলে উক্ত দ্রব্য ফেরৎ দেওয়া হইবে। জামদাতার নিকট হইতে ১০ দিনের নোটিশ পাইলে উক্ত দ্রব্য ফেরৎ দেওয়ার দিন ও সময় ধার্য হইবে।&amp;nbsp; দ্রব্য হিমঘর হইতে বাহির করিয়া প্রয়োজন হইলে ওজন করা হইবে। জমাকারী বা তাহার ক্ষমতাপ্রাপ্ত প্রতিনিধি উপস্থিত না থাকিলেও উক্ত দ্রব্য ওজন হইলে জমাকারীকে উহা মানিয়া লইতে হইবে।&amp;nbsp; নোটিশের উল্লিখিত দিনে দ্রব্য ফেরতের জন্য হিমঘর কর্তৃপক্ষ যথাসাধ্য চেষ্টা করিবেন কিন্তু অত্যাধিক ভীর ও অসুবিধা বাঁচাইবার জন্য হিমঘর কর্তৃপক্ষ অন্য যে কোন দিন দ্রব্য ফেরতের জন্য হিমঘর কর্তৃপক্ষ যথাসাধ্য চেষ্টা করিবেন কিন্তু অত্যাধিক ভির ও অসুবিধা বাঁচাইবার জন্য হিমঘর কর্তৃপক্ষ অন্য যে কোন দিনে দ্রব্য ফেরতের দিন নির্দ্ধারিত করিতে পারিবে। দ্রব্য শুকাইবার পর ওজন করিয়া কোন কম হইলে তাহার জন্য হিমঘর কর্তৃপক্ষ দায়ী থাকবেন না&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১০) জমার জন্য দ্রব্যের মধ্যে পচা বা খারাপ মাল থাকিলে তাহা জমাদাতাকে কর্তৃপক্ষের ইচ্ছামত মাল বাছিয়া দিতে হইবে। নইলে ঐ মাল কর্তৃপক্ষ রাখিতে বাধ্য নহেন।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১১)কোন বিজ্ঞপ্তি বা নোটিশ দিতে নইলে উহা জমা রসিদে দেওয়া ঠিকানায় পোস্টাল সার্টিফিকেটে পোস্ট করিলে যথেষ্ট হইবে। কর্তৃপক্ষ ইচ্ছা করিলে একটি বাংলা ও একটি ইংরেজি অথবা স্থানীয় কাগজে একবার প্রকাশ করিতেও পারে। প্রয়োজন বোধে জমাদাতাকে তিন দিনের নোটিশ মাল লইতে বাধ্য করা যাইতে পারে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;জমাদার হাজির না হইলে কর্তিপক্ষের ব্যবস্থাই চূড়ান্ত বলিয়া গণ্য হইবে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১২)হিমঘর পক্ষ হইতে সংরক্ষনকারীকে লিখিতভাবে যে তারিখ দেওয়া&amp;nbsp; হইবে সেই তারিখে অবশ্যই দ্রব্য পাঠাইতে হইবে। তারিখ ব্যতীত দ্রব্য জমা লওয়া এবং ডেলিভারী দেওয়া হইবে না।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১৩)উপরিউল্লিখিত শর্তাবলী ব্যতীত হিমঘর কর্তৃপক্ষ পরবর্তীকালে কোন যুক্তিসঙ্গত শর্ত আরোপ করিলে তাহা সংরক্ষণকারীকে অবশ্যই মানিয়া লইতে হইবে এবং সরকার কোন নতুন কর ধার্য্য করলে তাহা অবশ্যই দিতে বাধ্য থাকিতে হইবে। বন্ডের উপরিউক্ত শর্তসাপেক্ষে কোন বিরোধ দেখা দিলে লাইসেন্সিং অফিসারের সিদ্ধান্ত চূড়ান্ত বলিয়া বিবেচিত হইবে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১৪) দ্রব্য স্টোরের জন্য উপযুক্ত না অনুপযুক্ত তাহা পরিদর্শন করিবার দায়িত্ব পরিচালকমন্ডলীর থাকিবে। যদি স্টোরের পর কোন দ্রব্য দুর্গন্ধ হইয়া যায় অথবা স্টোরের জন্য দ্রব্যকে দূষিত ও নষ্ট করে তবে পরিচালিকেরা উক্ত দ্রব্য স্টোরের সীমার বাহিরে আনিতে পারিবেন এবং সেই দ্রব্য কোনোরূপ ক্ষতির জন্য পরিচালকমন্ডলী দায়ী হইবেন না প্রয়োজন অনুযায়ী যে কোন সংরক্ষন দ্রব্যের প্যাকেট /ঝুড়ি পরীক্ষা করিবার বা খুলিয়া দেখিবার অধিকার পরিচালক মণ্ডলী থাকিবে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১৫)সংরক্ষিত দ্রব্য ওয়েস্টবেঙ্গল কোল্ড স্টোরেজ লাইসেন্সিং এমডি রেগুলেশন প্যাকেট ১৯৬৬-র ১২ নং ধারামতে এবং উহার সহিত সংশ্লিষ্ট নিয়ম অনুসারে সংরক্ষণকারী মাল বাহিরের নির্দিষ্ট তারিখের ৩দিন মধ্যে স্টোর হইতে যদি তাহার দ্রব্য বাহির না করেন তবে সেই উক্ত দ্রব্য প্রকাশ্য নিলামে বিক্রয় করিবার অধিকার পরিচালকদের থাকিবে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১৬) কোল্ড স্টোরেজের রসিদ এই নিয়ম ও শর্তাবলী অনুযায়ী প্রস্তুত হইয়াছে এবং দ্রব্য গ্রহণ করিবার সময় উক্ত রসিদ আমাদের নিকট দাখিল করিতে হইবে।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;১৭)যদি রাজ্যসরকার বা কোন লোকাল বডি দ্রব্যের কোন কর বা উপকর ধার্য্য করেন তবে সংরক্ষণকারী ঐ কর উপকর দিতে বাধ্য থাকিবেন।&lt;/span&gt;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 0pt; line-height: 1.38; border-top: 2.25pt solid rgb(0, 0, 0); padding: 0pt 0pt 12pt;&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;p dir=&quot;ltr&quot; style=&quot;margin-top: 12pt; margin-bottom: 12pt; line-height: 1.38;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt;বিঃদ্রঃ&lt;/span&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;&quot;&gt; -১) কোন সদস্য তাহার নির্দিষ্ট (Quota) পরিমাণের বেশী দ্রব্য রাখিলে কর্তৃপক্ষ ওই অতিরিক্ত দ্রব্যের জন্য অন্যান্য ক্ষেত্রে ধার্য্য হারে চাজ আদায় করিতে পারিবেন। (২) ১৫ ই নভেম্বর উত্তীর্ন হইয়া সত্ত্বেও যদি কোন মাল ডেলিভারী না লওয়া হয় তাহা হইলে অতিরিক্ত প্রতিদানের জন্য কুইন্টাল প্রতি টাকা হারে অতিরিক্ত ভাড়া দিতে হইবে।&lt;/span&gt;&lt;/p&gt;&lt;/span&gt;&lt;/h5&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `rec_packet`
--

CREATE TABLE `rec_packet` (
  `rp_id` int(11) NOT NULL,
  `rc_id` varchar(255) NOT NULL,
  `rc_pid` int(11) NOT NULL,
  `rc_packet` varchar(255) NOT NULL,
  `pro_type` varchar(255) NOT NULL,
  `rec_date` varchar(255) NOT NULL,
  `rc_date` varchar(255) NOT NULL,
  `rc_status` varchar(255) NOT NULL,
  `car_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uabout` mediumtext NOT NULL,
  `uname` varchar(255) NOT NULL,
  `uphoto` varchar(255) NOT NULL,
  `ucountry` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `com_name` varchar(255) NOT NULL,
  `cregd_no` varchar(255) NOT NULL,
  `u_address` varchar(255) NOT NULL,
  `u_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `uabout`, `uname`, `uphoto`, `ucountry`, `pass`, `com_name`, `cregd_no`, `u_address`, `u_phone`) VALUES
(1, 'Prosanta', 'joyjogi2021@gmail.com', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, necessitatibus. Necessitatibus quas expedita atque asperiores accusantium ad tempore voluptates vitae, magnam amet nobis perferendis pariatur ipsam, tenetur corporis cumque voluptatem quasi commodi error architecto dolores autem? Alias rerum a cupiditate beatae veritatis! Dolore quaerat cupiditate odio tempora mollitia, nemo nostrum? Amet ut perferendis excepturi autem quia deleniti nisi illo quibusdam, beatae sit, commodi ducimus repudiandae quisquam debitis consequatur eaque doloribus aut totam ratione! Veniam rerum est repellendus pariatur cumque similique laudantium ex sunt deleniti, iusto quam tempore ab expedita hic quaerat quas, nulla tempora cupiditate blanditiis ut? Soluta, aspernatur dolorem.', 'Prosanta Rajbanshi', 'uploads/prosanta.png', 'India', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Joy Jogi Cold Storage PVT.LTD.', 'CIN-U01409WB2021PTC245936', 'VILL-Kuriapara, P.O- Jharpukuria,P.S-Malda, PIN-732128', '9002918048 8967434475 9800762540'),
(2, 'admin', '', '', '', '', '', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `dist_db`
--
ALTER TABLE `dist_db`
  ADD PRIMARY KEY (`dib`);

--
-- Indexes for table `expanses`
--
ALTER TABLE `expanses`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `manage_status`
--
ALTER TABLE `manage_status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `manage_stock`
--
ALTER TABLE `manage_stock`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `money_recieve`
--
ALTER TABLE `money_recieve`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `otp_verify`
--
ALTER TABLE `otp_verify`
  ADD PRIMARY KEY (`otpId`);

--
-- Indexes for table `post_office`
--
ALTER TABLE `post_office`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `ps_db`
--
ALTER TABLE `ps_db`
  ADD PRIMARY KEY (`psid`);

--
-- Indexes for table `p_cat`
--
ALTER TABLE `p_cat`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `rec_packet`
--
ALTER TABLE `rec_packet`
  ADD PRIMARY KEY (`rp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dist_db`
--
ALTER TABLE `dist_db`
  MODIFY `dib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `expanses`
--
ALTER TABLE `expanses`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_status`
--
ALTER TABLE `manage_status`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `manage_stock`
--
ALTER TABLE `manage_stock`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `money_recieve`
--
ALTER TABLE `money_recieve`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_verify`
--
ALTER TABLE `otp_verify`
  MODIFY `otpId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_office`
--
ALTER TABLE `post_office`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `ps_db`
--
ALTER TABLE `ps_db`
  MODIFY `psid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `p_cat`
--
ALTER TABLE `p_cat`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rec_packet`
--
ALTER TABLE `rec_packet`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
