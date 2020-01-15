-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2020 at 10:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hitpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `a_id` int(11) NOT NULL,
  `a_date` varchar(100) NOT NULL,
  `a_time` int(11) NOT NULL,
  `a_user` int(11) NOT NULL,
  `a_description` text NOT NULL,
  `a_title` text NOT NULL,
  `a_to` int(11) NOT NULL,
  `a_table` varchar(255) NOT NULL,
  `a_row` int(11) NOT NULL,
  `a_seen` int(11) NOT NULL,
  `a_type` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`a_id`, `a_date`, `a_time`, `a_user`, `a_description`, `a_title`, `a_to`, `a_table`, `a_row`, `a_seen`, `a_type`) VALUES
(1, '24-Nov-2019', 1574592648, 1, 'Add new Project', 'aswadsqw', 0, '', 0, 0, ''),
(2, '29-Nov-2019', 1575052442, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(3, '29-Nov-2019', 1575052482, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 15, 1, 'tasks'),
(4, '29-Nov-2019', 1575052482, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 15, 0, 'tasks'),
(5, '01-Dec-2019', 1575213677, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(6, '01-Dec-2019', 1575214060, 1, 'An EOT(3) record has been editted', 'Extension of Time', 0, 'projects', 1, 1, 'eot'),
(7, '01-Dec-2019', 1575219988, 1, 'Project PROJEK PENURAPAN JALOAN BANGSAWAN KILOMETER 51-100 SKUDAI JOHOR BAHRU has been editted', 'Projects', 0, 'projects', 1, 1, 'projects'),
(8, '01-Dec-2019', 1575220161, 1, 'Project PROJEK PENURAPAN JALOAN BANGSAWAN KILOMETER 51-100 SKUDAI JOHOR BAHRU has been editted', 'Projects', 0, 'projects', 1, 1, 'projects'),
(9, '01-Dec-2019', 1575220305, 1, 'Project PROJEK PENURAPAN JALOAN BANGSAWAN KILOMETER 51-100 SKUDAI JOHOR BAHRU has been editted', 'Projects', 0, 'projects', 1, 1, 'projects'),
(10, '01-Dec-2019', 1575220771, 1, 'Project PROJEK PENURAPAN JALOAN BANGSAWAN KILOMETER 51-100 SKUDAI JOHOR BAHRU has been editted', 'Projects', 0, 'projects', 1, 1, 'projects'),
(11, '01-Dec-2019', 1575220857, 1, 'Project PROJEK PENURAPAN JALOAN BANGSAWAN KILOMETER 51-100 SKUDAI JOHOR BAHRU has been editted', 'Projects', 0, 'projects', 1, 1, 'projects'),
(12, '01-Dec-2019', 1575220868, 1, 'Project PROJEK PENURAPAN JALOAN BANGSAWAN KILOMETER 51-100 SKUDAI JOHOR BAHRU has been editted', 'Projects', 0, 'projects', 1, 1, 'projects'),
(13, '01-Dec-2019', 1575220874, 1, 'Project PROJEK PENURAPAN JALOAN BANGSAWAN KILOMETER 51-100 SKUDAI JOHOR BAHRU has been editted', 'Projects', 0, 'projects', 1, 1, 'projects'),
(14, '02-Dec-2019', 1575285507, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(15, '02-Dec-2019', 1575287250, 2, 'You have logged in.', 'Authorization Request', 2, '', 0, 1, 'login'),
(16, '02-Dec-2019', 1575287270, 2, 'You have logged in.', 'Authorization Request', 2, '', 0, 1, 'login'),
(17, '02-Dec-2019', 1575287361, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(18, '02-Dec-2019', 1575295820, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(19, '02-Dec-2019', 1575297867, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(20, '02-Dec-2019', 1575298802, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 16, 0, 'tasks'),
(21, '02-Dec-2019', 1575298819, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 16, 0, 'tasks'),
(22, '02-Dec-2019', 1575298832, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 16, 0, 'tasks'),
(23, '02-Dec-2019', 1575298872, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 15, 1, 'tasks'),
(24, '02-Dec-2019', 1575298872, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 15, 0, 'tasks'),
(25, '02-Dec-2019', 1575298887, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 15, 1, 'tasks'),
(26, '02-Dec-2019', 1575298887, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 15, 0, 'tasks'),
(27, '03-Dec-2019', 1575391536, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(28, '04-Dec-2019', 1575465017, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(29, '04-Dec-2019', 1575465041, 1, 'Project erwerwrew has been created', 'Projects', 0, '', 0, 1, 'projects'),
(30, '04-Dec-2019', 1575465042, 1, 'Add new Project', 'erwerwrew', 0, '', 0, 0, ''),
(31, '04-Dec-2019', 1575465852, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 17, 1, 'tasks'),
(32, '04-Dec-2019', 1575465852, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 17, 0, 'tasks'),
(33, '04-Dec-2019', 1575466263, 1, 'Replying on issue.', 'Issues & Discussions', 0, 'discussions', 3, 0, 'discussions'),
(34, '04-Dec-2019', 1575466266, 1, 'Replying on issue.', 'Issues & Discussions', 0, 'discussions', 1, 0, 'discussions'),
(35, '04-Dec-2019', 1575478705, 1, 'Project aefweawef has been created', 'Projects', 0, '', 0, 1, 'projects'),
(36, '04-Dec-2019', 1575478705, 1, 'Add new Project', 'aefweawef', 0, '', 0, 0, ''),
(37, '04-Dec-2019', 1575478797, 1, 'Add new Project', 'ertrete', 0, '', 0, 0, ''),
(38, '04-Dec-2019', 1575478987, 1, 'Project asdsad has been created', 'Projects', 0, '', 0, 1, 'projects'),
(39, '04-Dec-2019', 1575478987, 1, 'Add new Project', 'asdsad', 0, '', 0, 0, ''),
(40, '04-Dec-2019', 1575478997, 1, 'Project 234rewe has been created', 'Projects', 0, '', 0, 1, 'projects'),
(41, '04-Dec-2019', 1575478997, 1, 'Add new Project', '234rewe', 0, '', 0, 0, ''),
(42, '04-Dec-2019', 1575479007, 1, 'Project werewrew has been created', 'Projects', 0, '', 0, 1, 'projects'),
(43, '04-Dec-2019', 1575479007, 1, 'Add new Project', 'werewrew', 0, '', 0, 0, ''),
(44, '04-Dec-2019', 1575479466, 1, 'Project asewqweqwe has been created', 'Projects', 0, '', 0, 1, 'projects'),
(45, '04-Dec-2019', 1575479466, 1, 'Add new Project', 'asewqweqwe', 0, '', 0, 0, ''),
(46, '04-Dec-2019', 1575483370, 1, 'A maintenance log has been added', 'Project Maintenance', 0, 'projects', 1, 0, 'project_maintenance'),
(47, '04-Dec-2019', 1575483438, 1, 'A maintenance log has been added', 'Project Maintenance', 0, 'projects', 1, 0, 'project_maintenance'),
(48, '04-Dec-2019', 1575483611, 1, 'A maintenance log has been added', 'Project Maintenance', 0, 'projects', 1, 0, 'project_maintenance'),
(49, '04-Dec-2019', 1575483729, 1, 'A maintenance log has been added', 'Project Maintenance', 0, 'projects', 1, 0, 'project_maintenance'),
(50, '04-Dec-2019', 1575483775, 1, 'A maintenance log has been updated', 'Project Maintenance', 0, 'projects', 1, 0, 'project_maintenance'),
(51, '04-Dec-2019', 1575483778, 1, 'A maintenance log has been updated', 'Project Maintenance', 0, 'projects', 1, 0, 'project_maintenance'),
(52, '04-Dec-2019', 1575483811, 1, 'A maintenance log has been deleted', 'Project Maintenance', 0, 'projects', 1, 0, 'project_maintenance'),
(53, '06-Dec-2019', 1575652118, 1, 'A maintenance log has been added', 'Project Maintenance', 0, 'projects', 11, 0, 'project_maintenance'),
(54, '06-Dec-2019', 1575652129, 1, 'A maintenance log has been deleted', 'Project Maintenance', 0, 'projects', 11, 0, 'project_maintenance'),
(55, '06-Dec-2019', 1575654505, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 18, 1, 'tasks'),
(56, '06-Dec-2019', 1575654505, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 18, 0, 'tasks'),
(57, '06-Dec-2019', 1575654540, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 19, 1, 'tasks'),
(58, '06-Dec-2019', 1575654595, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 18, 1, 'tasks'),
(59, '06-Dec-2019', 1575654596, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 18, 0, 'tasks'),
(60, '06-Dec-2019', 1575654677, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 19, 1, 'tasks'),
(61, '06-Dec-2019', 1575657849, 1, 'Project Sistem Projeck Monitoring SUK Kedah has been editted', 'Projects', 0, 'projects', 11, 1, 'projects'),
(62, '06-Dec-2019', 1575657914, 1, 'Project Sistem Projeck Monitoring SUK Kedah has been editted', 'Projects', 0, 'projects', 11, 1, 'projects'),
(63, '07-Dec-2019', 1575710433, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(64, '07-Dec-2019', 1575710495, 1, 'A report has been submitted for review.', 'Reports', 0, 'projects', 11, 0, 'reports'),
(65, '07-Dec-2019', 1575710563, 1, 'A report has been submitted for review.', 'Reports', 0, 'projects', 11, 0, 'reports'),
(66, '07-Dec-2019', 1575713163, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(67, '07-Dec-2019', 1575727050, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(68, '07-Dec-2019', 1575727629, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(69, '07-Dec-2019', 1575727785, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(70, '07-Dec-2019', 1575727796, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(71, '07-Dec-2019', 1575727821, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(72, '08-Dec-2019', 1575759827, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(73, '08-Dec-2019', 1575760037, 2, 'You have logged in.', 'Authorization Request', 2, '', 0, 1, 'login'),
(74, '08-Dec-2019', 1575760238, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(75, '08-Dec-2019', 1575760264, 2, 'You have logged in.', 'Authorization Request', 2, '', 0, 1, 'login'),
(76, '08-Dec-2019', 1575760282, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(77, '08-Dec-2019', 1575761810, 1, 'Project Sistem Projeck Monitoring SUK Kedah has been editted', 'Projects', 0, 'projects', 11, 1, 'projects'),
(78, '08-Dec-2019', 1575763575, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(79, '08-Dec-2019', 1575763579, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(80, '08-Dec-2019', 1575764611, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(81, '08-Dec-2019', 1575764716, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(82, '08-Dec-2019', 1575764745, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(83, '08-Dec-2019', 1575764772, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(84, '08-Dec-2019', 1575765029, 1, 'Add new Project', 'Sub Porject Satu', 0, '', 0, 0, ''),
(85, '08-Dec-2019', 1575765080, 1, 'Sub project Sub Project Satu has been created', 'Projects', 0, 'projects', 13, 1, 'projects'),
(86, '08-Dec-2019', 1575765080, 1, 'Add new Project', 'Sub Project Satu', 0, '', 0, 0, ''),
(87, '08-Dec-2019', 1575765211, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 20, 1, 'tasks'),
(88, '08-Dec-2019', 1575765211, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 20, 0, 'tasks'),
(89, '08-Dec-2019', 1575765250, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 21, 1, 'tasks'),
(90, '08-Dec-2019', 1575765250, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 21, 0, 'tasks'),
(91, '08-Dec-2019', 1575765250, 1, 'Task has been assigned.', 'Tasks', 3, 'tasks', 21, 0, 'tasks'),
(92, '08-Dec-2019', 1575765272, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 21, 1, 'tasks'),
(93, '08-Dec-2019', 1575765272, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 21, 0, 'tasks'),
(94, '08-Dec-2019', 1575765272, 1, 'Task has been assigned.', 'Tasks', 3, 'tasks', 21, 0, 'tasks'),
(95, '08-Dec-2019', 1575765308, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 20, 1, 'tasks'),
(96, '08-Dec-2019', 1575765308, 1, 'Task has been assigned.', 'Tasks', 2, 'tasks', 20, 0, 'tasks'),
(97, '08-Dec-2019', 1575765472, 1, 'A report has been submitted for review.', 'Reports', 0, 'projects', 12, 0, 'reports'),
(98, '08-Dec-2019', 1575765701, 1, 'An Issue/Discussion has been submitted.', 'Issues & Discussions', 0, 'projects', 12, 0, 'discussions'),
(99, '08-Dec-2019', 1575765723, 1, 'Replying on issue.', 'Issues & Discussions', 0, 'discussions', 8, 0, 'discussions'),
(100, '08-Dec-2019', 1575766089, 1, 'Project Sistem Projeck Monitoring SUK Kedah has been editted', 'Projects', 0, 'projects', 11, 1, 'projects'),
(101, '08-Dec-2019', 1575766655, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(102, '08-Dec-2019', 1575767473, 1, 'Project hjgjgnbcnn has been created', 'Projects', 0, '', 0, 1, 'projects'),
(103, '08-Dec-2019', 1575767473, 1, 'Add new Project', 'hjgjgnbcnn', 0, '', 0, 0, ''),
(104, '08-Dec-2019', 1575767555, 1, 'Sub project sdsdsdfsdfsfsdf has been created', 'Projects', 0, 'projects', 15, 1, 'projects'),
(105, '08-Dec-2019', 1575767555, 1, 'Add new Project', 'sdsdsdfsdfsfsdf', 0, '', 0, 0, ''),
(106, '08-Dec-2019', 1575767570, 1, 'Project ssdfdf has been created', 'Projects', 0, '', 0, 1, 'projects'),
(107, '08-Dec-2019', 1575767570, 1, 'Add new Project', 'ssdfdf', 0, '', 0, 0, ''),
(108, '08-Dec-2019', 1575767676, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(109, '08-Dec-2019', 1575767712, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(110, '08-Dec-2019', 1575767808, 1, 'A report has been submitted for review.', 'Reports', 0, 'projects', 14, 0, 'reports'),
(111, '08-Dec-2019', 1575772455, 1, 'haha', 'Job: huhu', 1, 'jobs', 0, 1, 'jobs'),
(112, '08-Dec-2019', 1575772479, 1, 'yohoooo', 'Job Update: Lelelel', 1, 'jobs', 0, 1, 'jobs'),
(113, '08-Dec-2019', 1575772498, 1, 'A job has been removed from your list', 'Job Delete', 1, 'jobs', 0, 1, 'jobs'),
(114, '14-Jan-2020', 1578995604, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(115, '14-Jan-2020', 1578995928, 1, 'Project (16) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(116, '14-Jan-2020', 1578995936, 1, 'Project (15) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(117, '14-Jan-2020', 1578995946, 1, 'Project (14) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(118, '14-Jan-2020', 1578995954, 1, 'Project (13) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(119, '14-Jan-2020', 1578995960, 1, 'Project (12) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(120, '14-Jan-2020', 1578995966, 1, 'Project (11) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(121, '14-Jan-2020', 1578999853, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(122, '14-Jan-2020', 1579001177, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(123, '14-Jan-2020', 1579005506, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(124, '14-Jan-2020', 1579006221, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(125, '14-Jan-2020', 1579007956, 1, 'Project SDFSD has been created', 'Projects', 0, '', 0, 1, 'projects'),
(126, '14-Jan-2020', 1579007956, 1, 'Add new Project', 'sdfsd', 0, '', 0, 0, ''),
(127, '14-Jan-2020', 1579008010, 1, 'Project (17) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(128, '14-Jan-2020', 1579008193, 1, 'Project (18) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(129, '14-Jan-2020', 1579008220, 1, 'Project DSDF has been created', 'Projects', 0, '', 0, 1, 'projects'),
(130, '14-Jan-2020', 1579008220, 1, 'Add new Project', 'dsdf', 0, '', 0, 0, ''),
(131, '14-Jan-2020', 1579008226, 1, 'Project (19) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(132, '14-Jan-2020', 1579008404, 1, 'Project JHFJ has been created', 'Projects', 0, '', 0, 1, 'projects'),
(133, '14-Jan-2020', 1579008404, 1, 'Add new Project', 'jhfj', 0, '', 0, 0, ''),
(134, '14-Jan-2020', 1579008410, 1, 'Project (20) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(135, '14-Jan-2020', 1579008519, 1, 'Project LJLJ has been created', 'Projects', 0, '', 0, 1, 'projects'),
(136, '14-Jan-2020', 1579008519, 1, 'Add new Project', 'ljlj', 0, '', 0, 0, ''),
(137, '14-Jan-2020', 1579008575, 1, 'Project (21) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(138, '14-Jan-2020', 1579008640, 1, 'Project SDFGHJKL has been created', 'Projects', 0, '', 0, 1, 'projects'),
(139, '14-Jan-2020', 1579008640, 1, 'Add new Project', 'sdfghjkl', 0, '', 0, 0, ''),
(140, '14-Jan-2020', 1579008649, 1, 'Project (22) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(141, '14-Jan-2020', 1579011185, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(142, '14-Jan-2020', 1579011211, 1, 'Project PROJECT MANAGEMENT TOOLS has been created', 'Projects', 0, '', 0, 1, 'projects'),
(143, '14-Jan-2020', 1579011211, 1, 'Add new Project', 'Project Management Tools', 0, '', 0, 0, ''),
(144, '14-Jan-2020', 1579011234, 1, 'Project (23) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(145, '14-Jan-2020', 1579011754, 1, 'Project PROJEK WIFI KERAJAAN NEGERI has been created', 'Projects', 0, '', 0, 1, 'projects'),
(146, '14-Jan-2020', 1579011754, 1, 'Add new Project', 'Projek WIFI Kerajaan Negeri', 0, '', 0, 0, ''),
(147, '14-Jan-2020', 1579012634, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(148, '14-Jan-2020', 1579018491, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(149, '14-Jan-2020', 1579020368, 1, 'Project (25) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(150, '14-Jan-2020', 1579020377, 1, 'Project (24) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(151, '14-Jan-2020', 1579025738, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(152, '14-Jan-2020', 1579025779, 1, 'Client SEJATI SOLUTIONS SDN BHD added.', 'Client Registration', 1, 'clients', 0, 1, ''),
(153, '14-Jan-2020', 1579025797, 1, 'Client 1 deleted.', 'Client Alteration', 1, 'clients', 1, 1, ''),
(154, '14-Jan-2020', 1579025845, 1, 'Company SEJATI SOLUTIONS SDN BHD added.', 'Company Registration', 1, 'companies', 0, 1, ''),
(155, '14-Jan-2020', 1579026598, 1, 'Project PROJEK MEMBEKAL, MENGHANTAR, MEMASANG, MENGKONFIGURASI, MENGUJI DAN MENTAULIAH PENGUKUHAN SISTEM BACKUP DI PUSAT DATA KERAJAAN NEGERI KEDAH DARUL AMAN has been editted', 'Projects', 0, 'projects', 26, 1, 'projects'),
(156, '14-Jan-2020', 1579028333, 1, 'A report has been submitted for review.', 'Reports', 0, 'projects', 26, 0, 'reports'),
(157, '14-Jan-2020', 1579046345, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(158, '15-Jan-2020', 1579047221, 1, 'Project  PROJEK JALAN KAMPUNG TITI GAJAH has been created', 'Projects', 0, '', 0, 1, 'projects'),
(159, '15-Jan-2020', 1579047221, 1, 'Add new Project', ' Projek Jalan Kampung Titi Gajah', 0, '', 0, 0, ''),
(160, '15-Jan-2020', 1579047420, 1, 'Project  PROJEK JALAN KAMPUNG TITI GAJAH has been editted', 'Projects', 0, 'projects', 27, 1, 'projects'),
(161, '15-Jan-2020', 1579047536, 1, 'Project  PROJEK JALAN KAMPUNG TITI GAJAH has been editted', 'Projects', 0, 'projects', 27, 1, 'projects'),
(162, '15-Jan-2020', 1579047561, 1, 'Project  PROJEK JALAN KAMPUNG TITI GAJAH has been editted', 'Projects', 0, 'projects', 27, 1, 'projects'),
(163, '15-Jan-2020', 1579047798, 1, 'Company Delima Melati Sdn. Bhd. added.', 'Company Registration', 1, 'companies', 0, 1, ''),
(164, '15-Jan-2020', 1579047865, 1, 'Project  PROJEK JALAN KAMPUNG TITI GAJAH has been editted', 'Projects', 0, 'projects', 27, 1, 'projects'),
(165, '15-Jan-2020', 1579048087, 1, 'Sub project MEMBINA JALAN BARU has been created', 'Projects', 0, 'projects', 28, 1, 'projects'),
(166, '15-Jan-2020', 1579048087, 1, 'Add new Project', 'Membina jalan baru', 0, '', 0, 0, ''),
(167, '15-Jan-2020', 1579048188, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 22, 0, 'tasks'),
(168, '15-Jan-2020', 1579048399, 1, 'Project (28) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(169, '15-Jan-2020', 1579048467, 1, 'Project (27) has been deleted', 'Projects', 0, 'projects', 0, 1, 'projects'),
(170, '15-Jan-2020', 1579048844, 1, 'Project PROJEK JALAN KAMPUNG â€“ NAIK TARAF JALAN LUAR BANDAR DAN JAMBATAN KG TITI GAJAH has been editted', 'Projects', 0, 'projects', 29, 1, 'projects'),
(171, '15-Jan-2020', 1579049031, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 23, 0, 'tasks'),
(172, '15-Jan-2020', 1579049122, 1, 'Task has been assigned.', 'Tasks', 1, 'tasks', 24, 0, 'tasks'),
(173, '15-Jan-2020', 1579049376, 1, 'A report has been submitted for review.', 'Reports', 0, 'projects', 29, 0, 'reports'),
(174, '15-Jan-2020', 1579049878, 1, 'You are assigned to a project.', 'Project Team', 1, 'project_user', 29, 0, 'project_user'),
(175, '15-Jan-2020', 1579049887, 1, 'You are assigned to a project.', 'Project Team', 2, 'project_user', 29, 0, 'project_user'),
(176, '15-Jan-2020', 1579049926, 1, 'supaya jajaran jalan kampung dapat memberi faedah penggunaan yang maksimum', 'Job: Pembinaan Jalan Baru', 2, 'jobs', 0, 0, 'jobs'),
(177, '15-Jan-2020', 1579049963, 1, 'Pembayaran untuk pembinaan jalan', 'Job: Mengemaskini rekod pembayaran', 1, 'jobs', 0, 0, 'jobs'),
(178, '15-Jan-2020', 1579050022, 2, 'You have logged in.', 'Authorization Request', 2, '', 0, 1, 'login'),
(179, '15-Jan-2020', 1579052224, 2, 'Project PROJEK KUARTERS JKR DI DAERAH KUALA MUDA has been editted', 'Projects', 0, 'projects', 30, 1, 'projects'),
(180, '15-Jan-2020', 1579052370, 2, 'Company AIMAN PLATINUM SDN BHD added.', 'Company Registration', 2, 'companies', 0, 1, ''),
(181, '15-Jan-2020', 1579052392, 2, 'Project PROJEK KUARTERS JKR DI DAERAH KUALA MUDA has been editted', 'Projects', 0, 'projects', 30, 1, 'projects'),
(182, '15-Jan-2020', 1579052416, 2, 'Project PROJEK KUARTERS JKR DI DAERAH KUALA MUDA has been editted', 'Projects', 0, 'projects', 30, 1, 'projects'),
(183, '15-Jan-2020', 1579052486, 2, 'Project PROJEK KUARTERS JKR DI DAERAH KUALA MUDA has been editted', 'Projects', 0, 'projects', 30, 1, 'projects'),
(184, '15-Jan-2020', 1579052557, 2, 'Project PROJEK KUARTERS JKR DI DAERAH KUALA MUDA has been editted', 'Projects', 0, 'projects', 30, 1, 'projects'),
(185, '15-Jan-2020', 1579052740, 3, 'You have logged in.', 'Authorization Request', 3, '', 0, 1, 'login'),
(186, '15-Jan-2020', 1579052864, 3, 'Company Suite 8-25 Plaza Azalea Persiaran Bandaraya, Seksyen 14, 40000 Shah Alam, Selangor added.', 'Company Registration', 3, 'companies', 0, 1, ''),
(187, '15-Jan-2020', 1579052886, 3, 'Company Perumahan Kinrara Bhd editted.', 'Company Registration', 3, 'companies', 0, 1, ''),
(188, '15-Jan-2020', 1579053182, 3, 'Project PROJEK PERUMAHAN RAKYAT TAMAN MULIA has been editted', 'Projects', 0, 'projects', 31, 1, 'projects'),
(189, '15-Jan-2020', 1579053217, 3, 'Project PROJEK PERUMAHAN RAKYAT TAMAN MULIA has been editted', 'Projects', 0, 'projects', 31, 1, 'projects'),
(190, '15-Jan-2020', 1579053363, 3, 'Task has been assigned.', 'Tasks', 3, 'tasks', 25, 0, 'tasks'),
(191, '15-Jan-2020', 1579053472, 3, 'Task has been assigned.', 'Tasks', 3, 'tasks', 26, 0, 'tasks'),
(192, '15-Jan-2020', 1579053584, 3, 'Task has been assigned.', 'Tasks', 3, 'tasks', 27, 0, 'tasks'),
(193, '15-Jan-2020', 1579054022, 3, 'A report has been submitted for review.', 'Reports', 0, 'projects', 29, 0, 'reports'),
(194, '15-Jan-2020', 1579079845, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(195, '15-Jan-2020', 1579079888, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(196, '15-Jan-2020', 1579081899, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(197, '15-Jan-2020', 1579084167, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(198, '15-Jan-2020', 1579085236, 1, 'An Issue/Discussion has been submitted.', 'Issues & Discussions', 0, 'projects', 29, 0, 'discussions'),
(199, '15-Jan-2020', 1579085255, 1, 'Replying on issue.', 'Issues & Discussions', 0, 'discussions', 10, 0, 'discussions'),
(200, '15-Jan-2020', 1579085391, 1, 'A report has been submitted for review.', 'Reports', 0, 'projects', 29, 0, 'reports'),
(201, '15-Jan-2020', 1579094373, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login'),
(202, '15-Jan-2020', 1579097118, 1, 'You have logged in.', 'Authorization Request', 1, '', 0, 1, 'login');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `cl_id` int(11) NOT NULL,
  `cl_name` varchar(255) NOT NULL,
  `cl_email` varchar(255) NOT NULL,
  `cl_phone` varchar(255) NOT NULL,
  `cl_title` varchar(255) NOT NULL,
  `cl_password` text NOT NULL,
  `cl_address` text NOT NULL,
  `cl_company` int(11) NOT NULL,
  `cl_date` varchar(255) NOT NULL,
  `cl_time` int(15) NOT NULL,
  `cl_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_address` text NOT NULL,
  `c_phone` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_regno` varchar(255) NOT NULL,
  `c_date` varchar(255) NOT NULL,
  `c_time` int(15) NOT NULL,
  `c_logo` text NOT NULL,
  `c_category` varchar(255) NOT NULL,
  `c_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`c_id`, `c_name`, `c_address`, `c_phone`, `c_email`, `c_regno`, `c_date`, `c_time`, `c_logo`, `c_category`, `c_user`) VALUES
(5, 'NURKAMAL NETWORK SDN BHD', 'PENGURUS\r\nNURKAMAL NETWORK SDN BHD\r\n260 E JALAN DATUK KUMBAR\r\n05300 ALOR SETAR KEDAH', '', '', '', '14-Jan-2020', 1579000375, '1579000375-28b0ac07ed.png', '1', 1),
(6, 'SEJATI SOLUTIONS SDN BHD', '88-02-08, WISMA SRI WONDER, \r\nLINTANG SUNGAI PINANG, \r\nGEORGETOWN, \r\nPULAU PINANG', '', '', '', '14-Jan-2020', 1579025845, '1579025845-28b0ac07ed.png', '1', 1),
(7, 'Delima Melati Sdn. Bhd.', ' Lot 788, Taman Jaya, Perak, 34850 Teluk Intan', '05-855 2588', 'delimamelati@gmail.com', '89797979', '15-Jan-2020', 1579047798, '', '2', 1),
(8, 'AIMAN PLATINUM SDN BHD', 'Suite 8-25 Plaza Azalea Persiaran Bandaraya, Seksyen 14, 40000 Shah Alam, Selangor', '05-855 2588', '', '674915-W', '15-Jan-2020', 1579052370, '', '1', 2),
(9, 'Perumahan Kinrara Bhd', ' 31b, Jalan BK 5a/2, Bandar Kinrara, 47100 Puchong, Selangor', '03-8073 7100', '', '432434-B', '15-Jan-2020', 1579052886, '', '2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `company_category`
--

CREATE TABLE IF NOT EXISTS `company_category` (
  `cc_id` int(11) NOT NULL,
  `cc_name` varchar(255) NOT NULL,
  `cc_description` text NOT NULL,
  `cc_user` int(11) NOT NULL,
  `cc_date` varchar(255) NOT NULL,
  `cc_time` int(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_category`
--

INSERT INTO `company_category` (`cc_id`, `cc_name`, `cc_description`, `cc_user`, `cc_date`, `cc_time`) VALUES
(1, 'IT Software Supplier', '', 1, '06-Oct-2019', 1570372354),
(2, 'G1 Construction', '', 1, '06-Oct-2019', 1570372365),
(3, 'G2 Construction asd', '', 1, '07-Dec-2019', 1575716259);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_status` int(11) NOT NULL,
  `d_date` varchar(100) NOT NULL,
  `d_time` int(15) NOT NULL,
  `d_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`d_id`, `d_name`, `d_status`, `d_date`, `d_time`, `d_user`) VALUES
(5, 'BAHAGIAN PERANCANG EKONOMI NEGERI KEDAH', 1, '14-Jan-2020', 1578997775, 1),
(6, 'BAHAGIAAN PERUMAHAN', 1, '14-Jan-2020', 1578997873, 1),
(7, 'BAHAGIAN KERAJAAN TEMPATAN', 1, '14-Jan-2020', 1578997881, 1),
(8, 'BAHAGIAN TEKNOLOGI MAKLUMAT', 1, '14-Jan-2020', 1578997894, 1),
(9, 'JABATAN KERJA RAYA', 1, '14-Jan-2020', 1579002575, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE IF NOT EXISTS `discussions` (
  `d_id` int(11) NOT NULL,
  `d_date` varchar(100) NOT NULL,
  `d_time` int(15) NOT NULL,
  `d_project` int(11) NOT NULL,
  `d_user` int(11) NOT NULL,
  `d_main` int(11) NOT NULL,
  `d_tags` varchar(100) NOT NULL,
  `d_status` int(11) NOT NULL,
  `d_content` text NOT NULL,
  `d_title` text NOT NULL,
  `d_category` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`d_id`, `d_date`, `d_time`, `d_project`, `d_user`, `d_main`, `d_tags`, `d_status`, `d_content`, `d_title`, `d_category`) VALUES
(1, '14-Nov-2019', 1573689308, 1, 1, 0, '', 0, 'This is the discussion number one. Why and what and where and how? LOL', 'Discussion Number 1', 1),
(2, '14-Nov-2019', 1573664514, 0, 1, 1, '', 0, '', '', 0),
(3, '14-Nov-2019', 1573694078, 1, 1, 0, '', 0, 'sdfsdf', 'uhu', 0),
(4, '14-Nov-2019', 1573694137, 0, 1, 1, '', 0, 'hhuhu', '', 0),
(5, '14-Nov-2019', 1573694814, 0, 4, 1, '', 0, 'oii', '', 0),
(6, '04-Dec-2019', 1575466263, 0, 1, 3, '', 0, 'asd', '', 0),
(7, '04-Dec-2019', 1575466266, 0, 1, 1, '', 0, 'asd', '', 0),
(8, '08-Dec-2019', 1575765701, 12, 1, 0, '', 0, 'KSLDFDF', 'HSDFHSJDF', 1),
(9, '08-Dec-2019', 1575765723, 0, 1, 8, '', 0, 'SLKFLSKDJFLDF', '', 0),
(10, '15-Jan-2020', 1579085236, 29, 1, 0, '', 0, 'tidak cukup', 'Perlu tambahan bahan batu', 1),
(11, '15-Jan-2020', 1579085255, 0, 1, 10, '', 0, 'Pohon pic sedia bahan', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `discussion_category`
--

CREATE TABLE IF NOT EXISTS `discussion_category` (
  `dc_id` int(11) NOT NULL,
  `dc_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion_category`
--

INSERT INTO `discussion_category` (`dc_id`, `dc_name`) VALUES
(1, 'Category 1'),
(2, 'Category 2');

-- --------------------------------------------------------

--
-- Table structure for table `eot`
--

CREATE TABLE IF NOT EXISTS `eot` (
  `e_id` int(11) NOT NULL,
  `e_date` varchar(100) NOT NULL,
  `e_project` int(11) NOT NULL,
  `e_status` int(11) NOT NULL,
  `e_end` varchar(100) NOT NULL,
  `e_user` int(11) NOT NULL,
  `e_update` varchar(100) NOT NULL,
  `e_company` int(11) NOT NULL,
  `e_task` int(11) NOT NULL,
  `e_time` int(15) NOT NULL,
  `e_note` text NOT NULL,
  `e_ref` varchar(255) NOT NULL,
  `e_approve_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eot`
--

INSERT INTO `eot` (`e_id`, `e_date`, `e_project`, `e_status`, `e_end`, `e_user`, `e_update`, `e_company`, `e_task`, `e_time`, `e_note`, `e_ref`, `e_approve_by`) VALUES
(3, '01-Dec-2019', 1, 1, '2019-11-18', 2, '', 4, 15, 1575214060, 'tsting', '45fdsfdgf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `f_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_user` int(11) NOT NULL,
  `f_date` varchar(100) NOT NULL,
  `f_time` int(15) NOT NULL,
  `f_key` text NOT NULL,
  `f_title` text NOT NULL,
  `f_description` text NOT NULL,
  `f_for` varchar(255) NOT NULL,
  `f_to` int(11) NOT NULL,
  `f_type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`f_id`, `f_name`, `f_user`, `f_date`, `f_time`, `f_key`, `f_title`, `f_description`, `f_for`, `f_to`, `f_type`) VALUES
(10, '5debe05433f65-image.php.jpg', 1, '08-Dec-2019', 1575768276, 'FILE_5debe05437742', '5debe05433f65-image.php.jpg', '', '', 0, 0),
(11, '5debe0544c620-mhsx00logo.png', 1, '08-Dec-2019', 1575768276, 'FILE_5debe05451ed0', '5debe0544c620-mhsx00logo.png', '', '', 0, 0),
(12, '5debe05ea84f0-image.php.jpg', 1, '08-Dec-2019', 1575768286, 'FILE_5debe05eab105', '5debe05ea84f0-image.php.jpg', '', '', 0, 0),
(13, '5debe05eb57f5-mhsx00logo.png', 1, '08-Dec-2019', 1575768286, 'FILE_5debe05eb7fe3', '5debe05eb57f5-mhsx00logo.png', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `j_id` int(11) NOT NULL,
  `j_title` text NOT NULL,
  `j_description` text NOT NULL,
  `j_user` int(11) NOT NULL,
  `j_date` varchar(100) NOT NULL,
  `j_time` int(15) NOT NULL,
  `j_status` int(11) NOT NULL,
  `j_tags` varchar(100) NOT NULL,
  `j_project` int(11) NOT NULL,
  `j_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`j_id`, `j_title`, `j_description`, `j_user`, `j_date`, `j_time`, `j_status`, `j_tags`, `j_project`, `j_by`) VALUES
(3, 'Job 1', 'hasdhasdh', 4, '13-Nov-2019', 1573670362, 0, '1', 1, 1),
(4, 'job 2', 'asdklasd', 1, '13-Nov-2019', 1573670367, 0, '2', 1, 1),
(5, 'oI aMEK gAMBA', 'aMEK AMG', 1, '08-Dec-2019', 1575765589, 0, '1', 12, 1),
(6, 'Oi Gy Masak', 'HAHAHAH', 1, '08-Dec-2019', 1575771730, 0, '', 12, 1),
(8, 'Pembinaan Jalan Baru', 'supaya jajaran jalan kampung dapat memberi faedah penggunaan yang maksimum', 2, '15-Jan-2020', 1579049926, 0, '', 29, 1),
(9, 'Mengemaskini rekod pembayaran', 'Pembayaran untuk pembinaan jalan', 1, '15-Jan-2020', 1579049963, 0, '', 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_url` text NOT NULL,
  `m_main` int(11) NOT NULL,
  `m_icon` varchar(255) NOT NULL,
  `m_role` text NOT NULL,
  `m_description` text NOT NULL,
  `m_order` int(11) NOT NULL,
  `m_key` varchar(100) NOT NULL,
  `m_disabled` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`m_id`, `m_name`, `m_url`, `m_main`, `m_icon`, `m_role`, `m_description`, `m_order`, `m_key`, `m_disabled`) VALUES
(1, 'Dashboard', 'dashboard', 0, 'icon-th-small-outline', '3,4,5', 'Welcome to HIT Project Monitoring', 0, '', 0),
(2, 'Projects', 'projects', 0, 'icon-info-outline', '3', 'Manage all available complaints', 1, '5deb3e8f3ae46', 0),
(3, 'Applications', 'application', 2, '', '4', '', 0, '', 0),
(4, 'All Projects', 'all', 2, '', '5', '', 1, '', 0),
(5, 'Boards', 'boards', 2, '', '', '', 2, '', 0),
(6, 'Tasks', 'tasks', 0, 'icon-alarm', '', 'Manage list of tasks for projects progress', 2, '5deb3e8f4a099', 1),
(7, 'All Tasks', 'all', 6, '', '', '', 0, '', 0),
(8, 'Categories', 'categories', 6, '', '', '', 1, '', 0),
(9, 'Tags', 'tags', 6, '', '', '', 2, '', 1),
(10, 'Companies', 'companies', 0, 'icon-office', '', 'Manage all companies data', 3, '5deb3e8f56eae', 0),
(11, 'All Companies', 'all', 10, '', '', '', 0, '', 0),
(12, 'Clients', 'clients', 10, '', '', '', 1, '', 0),
(13, 'Reports', 'reports', 0, 'icon-file-text', '', 'Reports generator', 4, '5deb3e8f640cb', 0),
(14, 'All Reports', 'all', 13, '', '', '', 0, '', 0),
(15, 'EOT', 'eot', 0, 'icon-clock', '', 'Extension of Time', 5, '', 0),
(16, 'VO', 'vo', 0, 'icon-calculator', '', 'Variation Order', 6, '', 0),
(17, 'Settings', 'settings', 0, 'icon-cogs', '', 'Manage Departments & Source of Budget', 7, '5deb3e8f78a36', 0),
(18, 'Departments', 'departments', 17, '', '', '', 0, '', 0),
(19, 'Source of Budget', 'sob', 17, '', '', '', 1, '', 0),
(20, 'Sectors', 'sectors', 17, '', '', '', 2, '', 0),
(21, 'Project', 'project-setting', 17, '', '', '', 3, '', 0),
(22, 'Company', 'company-setting', 17, '', '', '', 4, '', 0),
(23, 'Options Setting', 'options', 17, '', '', '', 5, '', 0),
(24, 'Menus', 'menus', 17, '', '', '', 6, '', 0),
(25, 'User Boards', 'user-boards', 0, 'icon-users', '', 'User Boards', 8, '', 0),
(26, 'Users', 'users', 0, 'icon-group-outline', '3,4,5', 'Manages users', 9, '5deb3e8fa0633', 0),
(27, 'My Profile', 'my-profile', 26, '', '', '', 0, '', 0),
(28, 'All Users', 'all-users', 26, '', '3,4,5', '', 1, '', 0),
(29, 'Roles', 'roles', 26, '', '', '', 2, '', 0),
(30, 'Positions', 'positions', 26, '', '', '', 3, '', 0),
(31, 'Statistics', 'statistics', 0, 'icon-chart-line-outline', '', 'Statistics', 10, '5deb3e8fb50c3', 0),
(32, 'Statistical Summary', 'all', 31, '', '', '', 0, '', 0),
(33, 'Payments', 'payments', 31, '', '', '', 1, '', 0),
(34, 'Sources', 'sources', 31, '', '', '', 2, '', 0),
(35, 'Projects', 'projects', 31, '', '', '', 3, '', 0),
(36, 'Companies', 'companies', 31, '', '', '', 4, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`p_id`, `p_name`) VALUES
(3, 'Staff'),
(4, 'Admin'),
(5, 'Webmaster');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL,
  `p_category` int(11) NOT NULL,
  `p_tags` varchar(255) NOT NULL,
  `p_date` varchar(100) NOT NULL,
  `p_time` int(15) NOT NULL,
  `p_end` int(15) NOT NULL,
  `p_cost` double NOT NULL,
  `p_user` int(11) NOT NULL,
  `p_content` text NOT NULL,
  `p_status` int(11) NOT NULL,
  `p_key` text NOT NULL,
  `p_location` text NOT NULL,
  `p_department` text NOT NULL,
  `p_sob` int(11) NOT NULL,
  `p_ref` text NOT NULL,
  `p_main` int(11) NOT NULL,
  `p_sector` int(11) NOT NULL,
  `p_outsource` int(11) DEFAULT NULL,
  `p_period` int(11) DEFAULT NULL,
  `p_short` text DEFAULT NULL,
  `p_year` int(11) DEFAULT NULL,
  `p_departmentBudget` double DEFAULT NULL,
  `p_bid` double DEFAULT NULL,
  `p_estimateStart` varchar(100) DEFAULT NULL,
  `p_estimateEnd` varchar(100) DEFAULT NULL,
  `p_maintenanceStart` varchar(100) DEFAULT NULL,
  `p_maintenanceEnd` varchar(100) DEFAULT NULL,
  `p_type` int(11) NOT NULL,
  `p_offeredCost` double NOT NULL,
  `p_letterDate` varchar(100) NOT NULL,
  `p_warrantAcceptanceDate` varchar(100) NOT NULL,
  `p_warrantNo` varchar(100) NOT NULL,
  `p_indentNo` varchar(100) NOT NULL,
  `p_indentDate` varchar(100) NOT NULL,
  `p_kodObjek` varchar(100) NOT NULL,
  `p_kodLanjut` varchar(100) NOT NULL,
  `p_kodMaksud` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`p_id`, `p_name`, `p_category`, `p_tags`, `p_date`, `p_time`, `p_end`, `p_cost`, `p_user`, `p_content`, `p_status`, `p_key`, `p_location`, `p_department`, `p_sob`, `p_ref`, `p_main`, `p_sector`, `p_outsource`, `p_period`, `p_short`, `p_year`, `p_departmentBudget`, `p_bid`, `p_estimateStart`, `p_estimateEnd`, `p_maintenanceStart`, `p_maintenanceEnd`, `p_type`, `p_offeredCost`, `p_letterDate`, `p_warrantAcceptanceDate`, `p_warrantNo`, `p_indentNo`, `p_indentDate`, `p_kodObjek`, `p_kodLanjut`, `p_kodMaksud`) VALUES
(26, 'PROJEK MEMBEKAL, MENGHANTAR, MEMASANG, MENGKONFIGURASI, MENGUJI DAN MENTAULIAH PENGUKUHAN SISTEM BACKUP DI PUSAT DATA KERAJAAN NEGERI KEDAH DARUL AMAN', 5, '1', '14-Jan-2020', 1570406400, 1573430400, 430702, 1, '', 4, 'PROJECT_5e1d975e0cf1b', '6.1463790850054965,100.37192885253896', '', 4, 'PSU(K)128-28/2019', 0, 4, 1, 35, 'PUSAT DATA', 2020, 0, 0, '2019-10-07', '2019-11-11', '2020-01-14', '2020-01-14', 1, 0, '', '', '', '', '', '0', '0', '1'),
(29, 'PROJEK JALAN KAMPUNG â€“ NAIK TARAF JALAN LUAR BANDAR DAN JAMBATAN KG TITI GAJAH', 3, '3', '15-Jan-2020', 1579046400, 0, 980560, 1, '<p>Pada 2 November 2018, kerajaan yang diterajui Pakatan Harapan telah membentangkan Bajet 2019 oleh Menteri Kewangan, YB Lim Guan Eng. Intipati belanjawan tersebut memperlihatkan bahawa kerajaan telah memperuntukkan sebanyak <strong>RM926 juta untuk membina dan menaiktaraf jalan raya, jalan luar bandar dan jambatan.</strong></p>\r\n\r\n<p>Ianya merupakan kesinambungan yang bermula pada Jun 2004, dengan perlaksanaan <strong>Projek Jalan Kampung (PJK)</strong>&nbsp;melalui <strong>Jabatan Kerja Raya (JKR)</strong> selaku agensi pelaksana. Kaedah pelaksanaan ini adalah selaras dengan keputusan Mesyuarat Jemaah Menteri pada 12 Mei 2004.</p>\r\n\r\n<p>Perlaksanaan PJK melalui JKR adalah lanjutan dari siri kaedah yang digunapakai sebelum ini, iaitu melalui Pejabat Daerah (1981&ndash;1996) Kaedah Payong (1997&ndash;2000 ), Kaedah Bersepadu (2001&ndash;2002) dan Kaedah Alternatif (2003).</p>\r\n\r\n<p>Di antara skop program PJK adalah menaik taraf jalan raya dengan membina&nbsp;jalan baru, supaya jajaran jalan kampung dapat memberi faedah penggunaan yang maksimum. Selain daripada itu, menaik taraf jalan sedia ada&nbsp;tanpa mengubah jajaran atau dengan perubahan jajaran. Akhir sekali, membina dan menaik taraf jalan-jalan kampung di kawasan Lembaga Kemajuan Wilayah (LKW) / Lembaga Kemajuan Tanah (LKT) tetapi tidak termasuk Jalan Ladang.</p>\r\n\r\n<p>Skop seterusnya adalah penyelenggaraan jalan dengan pembaikan yang dibuat ke atas ubin jalan. Juga dibuat pembaikan ke atas bahu jalan, longkang, pembentung (culvert) dan perabot jalan. Akhir sekali, menurap semula permukaan jalan.</p>\r\n', 2, 'PROJECT_5e1deeb649ae0', '', '', 5, '354546464', 0, 2, 1, 60, 'PJKTG', 2020, 102000, 102000, '2020-01-15', '2020-03-15', '2020-01-14', '2020-01-14', 1, 101900, '2020-01-01', '2020-01-02', '43434343', '353535', '2020-01-14', '4', '1', '2'),
(30, 'PROJEK KUARTERS JKR DI DAERAH KUALA MUDA', 1, '2', '15-Jan-2020', 1579046400, 0, 5080200, 2, '<p>Pembinaan Kuarters baru untuk penjawat awam di sekitar Kuala Muda</p>\r\n', 2, 'PROJECT_5e1dfb9a8f337', '5.610796609254879,100.49807850692738', '', 4, 'JKR/Kuarters/2020', 0, 2, 1, 70, 'KUARTERSJKRKM', 2020, 5280200, 5180200, '2020-01-14', '2020-01-14', '2020-01-14', '2020-01-14', 0, 5000200, '2020-01-15', '2020-01-23', '859385938', '583459385', '', '0', '0', '2'),
(31, 'PROJEK PERUMAHAN RAKYAT TAMAN MULIA', 6, '1', '15-Jan-2020', 1579046400, 0, 560000, 3, '<p>PPR Taman Mulia, Jalan Budiman 1, Bandar Tun Razak, Cheras, 56000 Kuala Lumpur, Federal Territory of Kuala Lumpu</p>\r\n', 2, 'PROJECT_5e1dffa65b6d9', '5.878332109674556,100.47011916015614', '', 5, 'PERUMAHAN/01/2020', 0, 7, 1, 56, 'PPRTM', 2020, 560000, 560000, '2020-01-15', '2020-01-16', '2020-01-14', '2020-01-14', 0, 570000, '', '2020-01-23', '353535', '3535353', '', '0', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `project_application`
--

CREATE TABLE IF NOT EXISTS `project_application` (
  `pa_id` int(11) NOT NULL,
  `pa_project` int(11) DEFAULT NULL,
  `pa_manager` int(11) DEFAULT NULL,
  `pa_cost` double DEFAULT NULL,
  `pa_sob` int(11) DEFAULT NULL,
  `pa_outsource` int(11) DEFAULT NULL,
  `pa_period` int(11) DEFAULT NULL,
  `pa_estimateStart` varchar(100) DEFAULT NULL,
  `pa_estimateEnd` varchar(100) DEFAULT NULL,
  `pa_approvalDate` varchar(100) DEFAULT NULL,
  `pa_department` varchar(100) DEFAULT NULL,
  `pa_technicalDate` varchar(100) DEFAULT NULL,
  `pa_guideDate` varchar(100) DEFAULT NULL,
  `pa_kickOffDate` varchar(100) DEFAULT NULL,
  `pa_applicationBudgetDate` varchar(100) DEFAULT NULL,
  `pa_approvalBudgetDate` varchar(100) DEFAULT NULL,
  `pa_procumentDate` varchar(100) DEFAULT NULL,
  `pa_procumentNo` text DEFAULT NULL,
  `pa_status` int(11) DEFAULT NULL,
  `pa_notes` text DEFAULT NULL,
  `pa_director` int(11) DEFAULT NULL,
  `pa_category` int(11) DEFAULT NULL,
  `pa_maksudCode` int(11) DEFAULT NULL,
  `pa_objectCode` int(11) DEFAULT NULL,
  `pa_lanjutCode` int(11) DEFAULT NULL,
  `pa_date` varchar(100) DEFAULT NULL,
  `pa_time` int(11) DEFAULT NULL,
  `pa_user` int(11) DEFAULT NULL,
  `pa_client` varchar(100) DEFAULT NULL,
  `pa_title` text NOT NULL,
  `pa_key` text NOT NULL,
  `pa_sector` int(11) NOT NULL,
  `pa_type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_application`
--

INSERT INTO `project_application` (`pa_id`, `pa_project`, `pa_manager`, `pa_cost`, `pa_sob`, `pa_outsource`, `pa_period`, `pa_estimateStart`, `pa_estimateEnd`, `pa_approvalDate`, `pa_department`, `pa_technicalDate`, `pa_guideDate`, `pa_kickOffDate`, `pa_applicationBudgetDate`, `pa_approvalBudgetDate`, `pa_procumentDate`, `pa_procumentNo`, `pa_status`, `pa_notes`, `pa_director`, `pa_category`, `pa_maksudCode`, `pa_objectCode`, `pa_lanjutCode`, `pa_date`, `pa_time`, `pa_user`, `pa_client`, `pa_title`, `pa_key`, `pa_sector`, `pa_type`) VALUES
(8, 26, 1, 430702, 4, 0, 35, '2019-10-07', '2019-11-11', '2019-10-07', '8', '2019-11-11', '2019-10-07', '2019-10-10', '2019-09-03', '2019-09-08', '2019-10-07', 'PSUK(K)128-28/2019', 1, '&lt;p&gt;Skop sebutharga ini adalah bagi membekal, menghantar, memasang, mengkonfigurasi, menguji dan mentauliah pengukuhan sistem backup di Pusat Data Kerajaan Negeri Kedah Darul Aman&amp;nbsp;adalah terdiri daripada:&lt;/p&gt;\r\n\r\n&lt;table cellspacing=&quot;0&quot; style=&quot;border-collapse:collapse; width:459px&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:45px&quot;&gt;\r\n			&lt;p&gt;&lt;strong&gt;&lt;strong&gt;Bil&lt;/strong&gt;&lt;/strong&gt;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:334px&quot;&gt;\r\n			&lt;p&gt;&lt;strong&gt;&lt;strong&gt;Keterangan&lt;/strong&gt;&lt;/strong&gt;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:80px&quot;&gt;\r\n			&lt;p&gt;&lt;strong&gt;&lt;strong&gt;Unit&lt;/strong&gt;&lt;/strong&gt;&lt;strong&gt;&lt;strong&gt;&amp;nbsp;/ Lot&lt;/strong&gt;&lt;/strong&gt;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:center; width:45px&quot;&gt;\r\n			&lt;p&gt;1&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:334px&quot;&gt;\r\n			&lt;p&gt;&lt;strong&gt;&lt;strong&gt;Komputer Pelayan&lt;/strong&gt;&lt;/strong&gt;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:80px&quot;&gt;\r\n			&lt;p&gt;5 unit&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:center; width:45px&quot;&gt;\r\n			&lt;p&gt;2&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:334px&quot;&gt;\r\n			&lt;p&gt;&lt;strong&gt;&lt;em&gt;&lt;strong&gt;&lt;em&gt;Uninterrruptible Power Supply (UPS)&lt;/em&gt;&lt;/strong&gt;&lt;/em&gt;&lt;/strong&gt;&lt;strong&gt;&lt;em&gt;&amp;nbsp;&lt;/em&gt;&lt;/strong&gt;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:80px&quot;&gt;\r\n			&lt;p&gt;8 unit&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:center; width:45px&quot;&gt;\r\n			&lt;p&gt;3&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:334px&quot;&gt;\r\n			&lt;p&gt;&lt;strong&gt;&lt;em&gt;&lt;strong&gt;&lt;em&gt;Environmental &lt;/em&gt;&lt;/strong&gt;&lt;/em&gt;&lt;/strong&gt;&lt;strong&gt;&lt;em&gt;&lt;strong&gt;&lt;em&gt;M&lt;/em&gt;&lt;/strong&gt;&lt;/em&gt;&lt;/strong&gt;&lt;strong&gt;&lt;em&gt;&lt;strong&gt;&lt;em&gt;anagement System&lt;/em&gt;&lt;/strong&gt;&lt;/em&gt;&lt;/strong&gt;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:80px&quot;&gt;\r\n			&lt;p&gt;3 unit&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:center; width:45px&quot;&gt;\r\n			&lt;p&gt;4&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:334px&quot;&gt;\r\n			&lt;p&gt;&lt;strong&gt;&lt;em&gt;&lt;strong&gt;&lt;em&gt;Network Access Storage&lt;/em&gt;&lt;/strong&gt;&lt;/em&gt;&lt;/strong&gt;&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:80px&quot;&gt;\r\n			&lt;p&gt;2&amp;nbsp;unit&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n', 1, 1, 1, 0, 0, '14-Jan-2020', 1579026375, 1, '6', 'PROJEK MEMBEKAL, MENGHANTAR, MEMASANG, MENGKONFIGURASI, MENGUJI DAN MENTAULIAH PENGUKUHAN SISTEM BACKUP DI PUSAT DATA KERAJAAN NEGERI KEDAH DARUL AMAN', '5e1d965d20d0b', 0, 1),
(9, 29, 1, 980560, 5, 0, 60, '2020-01-15', '2020-03-15', '2020-01-06', '9', '2020-01-08', '2020-01-10', '2020-01-13', '2019-12-23', '2019-12-24', '2020-01-01', '43535325', 1, '&lt;p&gt;Pada 2 November 2018, kerajaan yang diterajui Pakatan Harapan telah membentangkan Bajet 2019 oleh Menteri Kewangan, YB Lim Guan Eng. Intipati belanjawan tersebut memperlihatkan bahawa kerajaan telah memperuntukkan sebanyak &lt;strong&gt;RM926 juta untuk membina dan menaiktaraf jalan raya, jalan luar bandar dan jambatan.&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Ianya merupakan kesinambungan yang bermula pada Jun 2004, dengan perlaksanaan &lt;strong&gt;Projek Jalan Kampung (PJK)&lt;/strong&gt;&amp;nbsp;melalui &lt;strong&gt;Jabatan Kerja Raya (JKR)&lt;/strong&gt; selaku agensi pelaksana. Kaedah pelaksanaan ini adalah selaras dengan keputusan Mesyuarat Jemaah Menteri pada 12 Mei 2004.&lt;/p&gt;\r\n\r\n&lt;p&gt;Perlaksanaan PJK melalui JKR adalah lanjutan dari siri kaedah yang digunapakai sebelum ini, iaitu melalui Pejabat Daerah (1981&amp;ndash;1996) Kaedah Payong (1997&amp;ndash;2000 ), Kaedah Bersepadu (2001&amp;ndash;2002) dan Kaedah Alternatif (2003).&lt;/p&gt;\r\n\r\n&lt;p&gt;Di antara skop program PJK adalah menaik taraf jalan raya dengan membina&amp;nbsp;jalan baru, supaya jajaran jalan kampung dapat memberi faedah penggunaan yang maksimum. Selain daripada itu, menaik taraf jalan sedia ada&amp;nbsp;tanpa mengubah jajaran atau dengan perubahan jajaran. Akhir sekali, membina dan menaik taraf jalan-jalan kampung di kawasan Lembaga Kemajuan Wilayah (LKW) / Lembaga Kemajuan Tanah (LKT) tetapi tidak termasuk Jalan Ladang.&lt;/p&gt;\r\n\r\n&lt;p&gt;Skop seterusnya adalah penyelenggaraan jalan dengan pembaikan yang dibuat ke atas ubin jalan. Juga dibuat pembaikan ke atas bahu jalan, longkang, pembentung (culvert) dan perabot jalan. Akhir sekali, menurap semula permukaan jalan.&lt;/p&gt;\r\n', 1, 3, 2, 4, 1, '15-Jan-2020', 1579048731, 1, '7', 'Projek Jalan Kampung â€“ Naik Taraf Jalan Luar Bandar dan Jambatan Kg Titi Gajah', '5e1dee5393ba4', 0, 1),
(10, 30, 2, 5080200, 4, 0, 70, '2020-01-14', '2020-01-14', '2020-01-14', '9', '2020-01-14', '2020-01-14', '2020-01-14', '2020-01-14', '2020-01-14', '2020-01-14', '', 1, '&lt;p&gt;&amp;nbsp;menambahkan bilangan &lt;em&gt;kuarters&lt;/em&gt; untuk pegawai dan kakitangan pihak kerajaan&lt;/p&gt;\r\n', 2, 1, 1, 0, 0, '15-Jan-2020', 1579052029, 2, '7', 'Projek Kuarters JKR Di Daerah Kuala Muda', '5e1dfa849857c', 0, 0),
(11, 31, 3, 0, 5, 0, 0, '2020-01-15', '2020-01-16', '2020-01-14', '6', '2020-01-16', '2020-01-22', '2020-01-23', '2020-01-21', '2020-01-23', '2020-01-29', '535353', 0, '&lt;p&gt;PPR Taman Mulia, Jalan Budiman 1, Bandar Tun Razak, Cheras, 56000 Kuala Lumpur, Federal Territory of Kuala Lumpur&lt;/p&gt;\r\n', 3, 6, 1, 0, 0, '15-Jan-2020', 1579053077, 3, '9', 'Projek Perumahan Rakyat Taman Mulia', '5e1dff955bef5', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE IF NOT EXISTS `project_categories` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_description` text NOT NULL,
  `c_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`c_id`, `c_name`, `c_description`, `c_user`) VALUES
(1, 'Kemajuan Luar Bandar', 'Rancangan Kecil Kemajuan Luar Bandar', 1),
(2, 'Pembangunan Sosial', 'Pembangunan Sosial', 1),
(3, 'Penyelenggaraan Jalanraya', 'Penyelenggaraan Jalanraya Dalam Kawasan ', 1),
(5, 'ICT', 'TEKNOLOGI MAKLUMAT DAN KOMUNIKASI', 1),
(6, 'Perumahan', 'Projek Perumahan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_company`
--

CREATE TABLE IF NOT EXISTS `project_company` (
  `c_id` int(11) NOT NULL,
  `c_project` int(11) NOT NULL,
  `c_company` int(11) NOT NULL,
  `c_date` varchar(100) NOT NULL,
  `c_time` int(15) NOT NULL,
  `c_status` int(11) NOT NULL,
  `c_message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_company`
--

INSERT INTO `project_company` (`c_id`, `c_project`, `c_company`, `c_date`, `c_time`, `c_status`, `c_message`) VALUES
(39, 26, 6, '14-Jan-2020', 1579026598, 1, ''),
(47, 29, 7, '15-Jan-2020', 1579048844, 0, ''),
(53, 30, 8, '15-Jan-2020', 1579052557, 0, ''),
(56, 31, 9, '15-Jan-2020', 1579053217, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `project_department`
--

CREATE TABLE IF NOT EXISTS `project_department` (
  `pd_id` int(11) NOT NULL,
  `pd_department` int(11) NOT NULL,
  `pd_project` int(11) NOT NULL,
  `pd_leader` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_department`
--

INSERT INTO `project_department` (`pd_id`, `pd_department`, `pd_project`, `pd_leader`) VALUES
(23, 8, 26, 0),
(31, 9, 29, 0),
(37, 9, 30, 0),
(40, 6, 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_file`
--

CREATE TABLE IF NOT EXISTS `project_file` (
  `pf_id` int(11) NOT NULL,
  `pf_project` int(11) NOT NULL,
  `pf_file` int(11) NOT NULL,
  `pf_date` varchar(100) NOT NULL,
  `pf_time` int(15) NOT NULL,
  `pf_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_file`
--

INSERT INTO `project_file` (`pf_id`, `pf_project`, `pf_file`, `pf_date`, `pf_time`, `pf_user`) VALUES
(10, 11, 10, '', 0, 0),
(11, 11, 11, '', 0, 0),
(12, 11, 12, '', 0, 0),
(13, 11, 13, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_finishing`
--

CREATE TABLE IF NOT EXISTS `project_finishing` (
  `pf_id` int(11) NOT NULL,
  `pf_date` varchar(100) DEFAULT NULL,
  `pf_time` int(15) DEFAULT NULL,
  `pf_user` int(11) DEFAULT NULL,
  `pf_status` int(11) DEFAULT NULL,
  `pf_notes` text DEFAULT NULL,
  `pf_project` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_finishing`
--

INSERT INTO `project_finishing` (`pf_id`, `pf_date`, `pf_time`, `pf_user`, `pf_status`, `pf_notes`, `pf_project`) VALUES
(1, '06-Dec-2019', 1575657990, 1, NULL, 'sdfdsf', 11);

-- --------------------------------------------------------

--
-- Table structure for table `project_maintenance`
--

CREATE TABLE IF NOT EXISTS `project_maintenance` (
  `pm_id` int(11) NOT NULL,
  `pm_date` varchar(100) NOT NULL,
  `pm_time` int(15) NOT NULL,
  `pm_user` int(11) NOT NULL,
  `pm_client` int(11) NOT NULL,
  `pm_description` text NOT NULL,
  `pm_content` text NOT NULL,
  `pm_project` int(11) NOT NULL,
  `pm_status` int(11) NOT NULL,
  `pm_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

CREATE TABLE IF NOT EXISTS `project_tags` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_description` text NOT NULL,
  `t_color` varchar(100) NOT NULL,
  `t_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_tags`
--

INSERT INTO `project_tags` (`t_id`, `t_name`, `t_description`, `t_color`, `t_user`) VALUES
(1, 'Important', '', '#ff0000', 1),
(2, 'Danger', '', '#ff8040', 1),
(3, 'Watch List', '', '#004080', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE IF NOT EXISTS `project_user` (
  `pu_id` int(11) NOT NULL,
  `pu_project` int(11) NOT NULL,
  `pu_user` int(11) NOT NULL,
  `pu_role` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`pu_id`, `pu_project`, `pu_user`, `pu_role`) VALUES
(5, 1, 1, 1),
(6, 2, 1, 0),
(7, 1, 4, 0),
(8, 12, 1, 1),
(9, 12, 2, 0),
(10, 29, 1, 1),
(11, 29, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `r_id` int(11) NOT NULL,
  `r_category` text COLLATE utf8_bin NOT NULL,
  `r_title` text COLLATE utf8_bin NOT NULL,
  `r_content` text COLLATE utf8_bin NOT NULL,
  `r_date` varchar(15) COLLATE utf8_bin NOT NULL,
  `r_time` varchar(15) COLLATE utf8_bin NOT NULL,
  `r_user` text COLLATE utf8_bin NOT NULL,
  `r_description` text COLLATE utf8_bin NOT NULL,
  `r_project` int(11) NOT NULL,
  `r_key` text COLLATE utf8_bin NOT NULL,
  `r_claim` double NOT NULL,
  `r_location` text COLLATE utf8_bin NOT NULL,
  `r_department` text COLLATE utf8_bin NOT NULL,
  `r_sob` text COLLATE utf8_bin NOT NULL,
  `r_status` int(11) NOT NULL,
  `r_verify` int(11) NOT NULL,
  `r_invoiceNo` text COLLATE utf8_bin DEFAULT NULL,
  `r_invoiceDate` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `r_invoiceAcknowledgeDate` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `r_loNo` text COLLATE utf8_bin DEFAULT NULL,
  `r_voucherNo` text COLLATE utf8_bin DEFAULT NULL,
  `r_byDate` varchar(100) COLLATE utf8_bin NOT NULL,
  `r_rejectNote` text COLLATE utf8_bin NOT NULL,
  `r_voucherDate` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`r_id`, `r_category`, `r_title`, `r_content`, `r_date`, `r_time`, `r_user`, `r_description`, `r_project`, `r_key`, `r_claim`, `r_location`, `r_department`, `r_sob`, `r_status`, `r_verify`, `r_invoiceNo`, `r_invoiceDate`, `r_invoiceAcknowledgeDate`, `r_loNo`, `r_voucherNo`, `r_byDate`, `r_rejectNote`, `r_voucherDate`) VALUES
(6, '', 'LAPORAN KEMAJUAN PROJEK BIL 1', '', '14-Jan-2020', '1579028333', '1', '', 26, '5e1d9eedb4be5', 0, '', '', '', 0, 0, '', '', '', '', NULL, '', '', ''),
(7, '', 'MEMBINA JALAN BARU', '<p>Pembayaran kepada Melati untuk pembinaan jalan baru</p>\r\n', '15-Jan-2020', '1579049396', '1', 'Pembayaran kepada Melati untuk pembinaan jalan baru', 26, '5e1df12057bc6', 100000, '', '', '', 1, 1, '4243343535', '2020-02-03', '2020-02-04', '35541355', NULL, '', '', ''),
(8, '', 'CLAIM 1', '<p>Bayaraan KEmajuan 1</p>\r\n', '15-Jan-2020', '1579054051', '3', 'PEmbayaran KEmajuan 1', 31, '5e1e0346cf390', 20000, '', '', '', 1, 3, '234234343', '2020-02-06', '2020-02-14', '43434343', NULL, '', '', ''),
(9, '', 'PEMABYARAN PEMBINAAN JALAN ', '<p>Pembyaran pembinaan jalan</p>\r\n', '15-Jan-2020', '1579085402', '1', 'PEmabyaran pembinaan jalan ', 26, '5e1e7dcf618bb', 100000, '', '', '', 1, 1, '424343', '2020-01-29', '2020-01-30', '4355454', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reports_category`
--

CREATE TABLE IF NOT EXISTS `reports_category` (
  `rc_id` int(11) NOT NULL,
  `rc_title` text COLLATE utf8_bin NOT NULL,
  `rc_projects` text COLLATE utf8_bin NOT NULL,
  `rc_date` varchar(15) COLLATE utf8_bin NOT NULL,
  `rc_time` varchar(15) COLLATE utf8_bin NOT NULL,
  `rc_users` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `report_images`
--

CREATE TABLE IF NOT EXISTS `report_images` (
  `ri_id` int(11) NOT NULL,
  `ri_report` text COLLATE utf8_bin NOT NULL,
  `ri_image` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `report_images`
--

INSERT INTO `report_images` (`ri_id`, `ri_report`, `ri_image`) VALUES
(2, '1', '1574962847-5dda20b72fd49x00covercloud2.png'),
(3, '6', '5e1d9eedb8939-MESYUARAT-BACKUP-31-OKT.pdf'),
(4, '7', '5e1df120616b5-Laporan_Pemantauan_dan_Kemajuan_SPEM.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `r_id` int(11) NOT NULL,
  `r_role` varchar(255) NOT NULL,
  `r_date` varchar(255) NOT NULL,
  `r_time` int(15) NOT NULL,
  `r_user` int(11) NOT NULL,
  `r_code` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_id`, `r_role`, `r_date`, `r_time`, `r_user`, `r_code`) VALUES
(1, 'User', '', 0, 0, 'user'),
(2, 'Leader', '', 0, 0, 'leader'),
(3, 'Admin', '', 0, 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE IF NOT EXISTS `sectors` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`s_id`, `s_name`, `s_description`) VALUES
(2, 'Pelancongan', ''),
(4, 'ICT', ''),
(5, 'PERTANIAN', ''),
(6, 'INDUSTRI', ''),
(7, 'PERUMAHAN', ''),
(8, 'KERAJAAN TEMPATAN', ''),
(9, 'Infrastruktur', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `s_id` int(11) NOT NULL,
  `s_key` text NOT NULL,
  `s_value` text NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_description` text NOT NULL,
  `s_user` int(11) NOT NULL,
  `s_date` varchar(100) NOT NULL,
  `s_time` int(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`s_id`, `s_key`, `s_value`, `s_name`, `s_description`, `s_user`, `s_date`, `s_time`) VALUES
(1, 'task_status', '0', 'New', '', 0, '', 0),
(2, 'task_status', '1', 'Pending', '', 0, '', 0),
(3, 'task_status', '2', 'In Progress', '', 0, '', 0),
(4, 'task_status', '3', 'Complete', '', 0, '', 0),
(5, 'project_status', '0', 'Application', '', 0, '', 0),
(6, 'project_status', '1', 'In Progress', '', 0, '', 0),
(7, 'project_status', '2', 'Pending', '', 0, '', 0),
(8, 'project_status', '3', 'Complete', '', 0, '', 0),
(9, 'project_status', '4', 'Cancelled', '', 0, '', 0),
(13, 'P.04', '0', 'PEJABAT SETIAUSAHA KERAJAAN', '', 1, '14-Jan-2020', 1579024168),
(14, 'kod_maksud', '1', 'P.04', 'PEJABAT SETIAUSAHA KERAJAAN', 1, '14-Jan-2020', 1579024325),
(15, 'kod_maksud', '2', 'P.06', 'PEJABAT KEWANGAN DAN PERBENDAHARAAN NEGERI', 1, '14-Jan-2020', 1579024390),
(16, 'kod_lanjut', '0', '10001', 'PRASARANA E KERAJAAN', 1, '14-Jan-2020', 1579025064),
(17, 'kod_lanjut', '1', '10003', 'APLIKASI E KERAJAAN', 1, '14-Jan-2020', 1579025043),
(19, 'kod_objek', '0', '01000', 'RANCANGAN KECIL KEMAJUAN LUAR BANDAR', 1, '14-Jan-2020', 1579024621),
(20, 'kod_objek', '1', '02000', 'MASJID/SURAU/SEKOLAH AGAMA', 1, '14-Jan-2020', 1579024673),
(21, 'kod_objek', '2', '03000', '', 1, '14-Jan-2020', 1579024726),
(22, 'project_type', '0', 'In-House', '', 1, '06-Dec-2019', 1575650362),
(23, 'project_type', '1', 'Outsource', '', 1, '06-Dec-2019', 1575650375),
(24, 'project_type', '2', 'Code Sourcing', '', 1, '06-Dec-2019', 1575650436),
(25, 'project_file_type', '0', 'Any', '', 1, '06-Dec-2019', 1575652373),
(26, 'project_file_type', '1', 'Project Completion', '', 1, '06-Dec-2019', 1575652386),
(27, 'project_file_type', '2', 'Report', '', 1, '06-Dec-2019', 1575652401),
(28, 'report_status', '0', 'Pending', '', 0, '', 0),
(29, 'report_status', '1', 'Approved', '', 0, '', 0),
(30, 'report_status', '2', 'Rejected', '', 0, '', 0),
(31, 'project_application_status', '0', 'Pending', '', 1, '08-Dec-2019', 1575761197),
(32, 'project_application_status', '1', 'Approved', '', 1, '08-Dec-2019', 1575761354),
(33, 'project_application_status', '2', 'Declined', '', 1, '08-Dec-2019', 1575761364),
(36, 'kod_objek', '3', '04000', '', 1, '14-Jan-2020', 1579024807),
(37, 'kod_objek', '4', '05000', '', 1, '14-Jan-2020', 1579024912),
(38, 'kod_objek', '5', '10000', '', 1, '14-Jan-2020', 1579025123);

-- --------------------------------------------------------

--
-- Table structure for table `setting_group`
--

CREATE TABLE IF NOT EXISTS `setting_group` (
  `sg_id` int(11) NOT NULL,
  `sg_name` varchar(255) NOT NULL,
  `sg_code` varchar(255) NOT NULL,
  `sg_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_group`
--

INSERT INTO `setting_group` (`sg_id`, `sg_name`, `sg_code`, `sg_description`) VALUES
(1, 'Task Status', 'task_status', ''),
(2, 'Project Status', 'project_status', ''),
(3, 'KOD MAKSUD', 'kod_maksud', ''),
(4, 'Kod Lanjut', 'kod_lanjut', ''),
(5, 'KOD OBJEK', 'kod_objek', ''),
(6, 'Project Type', 'project_type', ''),
(7, 'Project File Type', 'project_file_type', ''),
(8, 'Report Status', 'report_status', ''),
(9, 'Project Application Status', 'project_application_status', ''),
(10, 'Mantenance Status', 'maintenance_status', '');

-- --------------------------------------------------------

--
-- Table structure for table `sob`
--

CREATE TABLE IF NOT EXISTS `sob` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_amount` double NOT NULL,
  `s_description` text DEFAULT NULL,
  `s_date` int(100) DEFAULT NULL,
  `s_time` int(15) DEFAULT NULL,
  `s_user` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sob`
--

INSERT INTO `sob` (`s_id`, `s_name`, `s_amount`, `s_description`, `s_date`, `s_time`, `s_user`) VALUES
(4, 'KERAJAAN NEGERI - PEMBANGUNAN', 100000000, 'PERUNTUKAN KERAJAAN NEGERI DI BAWAH P04', 1, 1, 1),
(5, 'PEJABAT MENTERI BESAR', 900000000, 'Peruntukan PMB', 14, 1579011263, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`s_id`, `s_name`) VALUES
(1, 'New'),
(2, 'In Progress'),
(3, 'Pending'),
(4, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `t_color` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`t_id`, `t_name`, `t_color`) VALUES
(1, 'URGENT', 'danger'),
(2, 'WATCHED', 'primary');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `t_id` int(11) NOT NULL,
  `t_project` int(11) NOT NULL,
  `t_date` varchar(255) NOT NULL,
  `t_time` int(15) NOT NULL,
  `t_title` varchar(255) NOT NULL,
  `t_content` text NOT NULL,
  `t_status` int(11) NOT NULL,
  `t_user` int(11) NOT NULL,
  `t_category` int(11) NOT NULL,
  `t_tags` text NOT NULL,
  `t_day` int(11) NOT NULL,
  `t_after` int(11) NOT NULL,
  `t_key` text NOT NULL,
  `t_kstatus` int(11) NOT NULL DEFAULT 1,
  `t_percent` double NOT NULL,
  `t_main` int(11) NOT NULL,
  `t_complete` int(11) NOT NULL,
  `t_group` int(11) NOT NULL,
  `t_planStart` varchar(100) NOT NULL,
  `t_planEnd` varchar(100) NOT NULL,
  `t_start` varchar(100) NOT NULL,
  `t_end` varchar(100) NOT NULL,
  `t_color` varchar(100) NOT NULL,
  `t_subOf` int(11) NOT NULL,
  `t_text` text NOT NULL,
  `t_notes` text NOT NULL,
  `t_groupType` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`t_id`, `t_project`, `t_date`, `t_time`, `t_title`, `t_content`, `t_status`, `t_user`, `t_category`, `t_tags`, `t_day`, `t_after`, `t_key`, `t_kstatus`, `t_percent`, `t_main`, `t_complete`, `t_group`, `t_planStart`, `t_planEnd`, `t_start`, `t_end`, `t_color`, `t_subOf`, `t_text`, `t_notes`, `t_groupType`) VALUES
(15, 0, '02-Dec-2019', 1575298887, 'Test Task', 'asjdf;lj  la', 1, 1, 0, '', 0, 0, 'TASK_5de0f44200ac8', 1, 45, 0, 0, 3, '01-Nov-2019', '06-Nov-2019', '06-Nov-2019', '14-Nov-2019', 'gtaskpurple', 0, '', 'Something', 0),
(16, 0, '02-Dec-2019', 1575298832, 'Task 2', 'This is task 2', 1, 1, 0, '', 0, 0, 'TASK_5de4b6724d58f', 1, 0, 0, 0, 3, '10-Dec-2019', '13-Dec-2019', '11-Dec-2019', '15-Dec-2019', 'gtaskgreen', 15, '', '', 0),
(17, 0, '04-Dec-2019', 1575465852, 'Test Task', ' hai', 0, 1, 0, '', 0, 0, 'TASK_5de742fc74aa9', 1, 0, 0, 0, 4, '05-Dec-2019', '06-Dec-2019', '04-Dec-2019', '09-Dec-2019', 'gtaskgreen', 0, '', '', 0),
(18, 0, '06-Dec-2019', 1575654595, 'Task One', 'as adad ads', 0, 1, 0, '', 0, 0, 'TASK_5dea23e9ac906', 1, 50, 0, 0, 5, '09-Nov-2019', '20-Nov-2019', '26-Nov-2019', '03-Dec-2019', 'gtaskblue', 0, '', '', 0),
(19, 0, '06-Dec-2019', 1575654677, 'Task Two', ' asd ad asadad', 0, 1, 0, '', 0, 0, 'TASK_5dea240c1b3a8', 1, 10, 0, 0, 5, '13-Nov-2019', '15-Nov-2019', '01-Dec-2019', '11-Dec-2019', 'gtaskblue', 0, '', '', 0),
(20, 0, '08-Dec-2019', 1575765308, 'Task Satu', 'sd;lr ;lkwj kjh er', 0, 1, 0, '', 0, 0, 'TASK_5debd45b54721', 1, 30, 0, 0, 6, '03-Dec-2019', '10-Dec-2019', '09-Dec-2019', '13-Dec-2019', 'gtaskblue', 0, '', '', 0),
(21, 0, '08-Dec-2019', 1575765272, 'Task duakljjghlg', '', 0, 1, 0, '', 0, 0, 'TASK_5debd482bcc56', 1, 0, 0, 0, 6, '17-Dec-2019', '19-Dec-2019', '19-Dec-2019', '21-Dec-2019', 'gtaskblue', 0, '', '', 0),
(22, 0, '15-Jan-2020', 1579048188, 'Membina Jalan Baru', 'Membina Jalan Baru', 0, 1, 0, '', 0, 0, 'TASK_5e1dec7c7198a', 1, 0, 0, 0, 17, '15-Jan-2020', '31-Jan-2020', '16-Jan-2020', '03-Feb-2020', 'gtaskblue', 0, '', 'Jalan Baru', 0),
(23, 0, '15-Jan-2020', 1579049031, 'Membina Jalan Baru', 'Supaya jajaran jalan kampung dapat memberi faedah penggunaan yang maksimum', 0, 1, 0, '', 0, 0, 'TASK_5e1defc7994ce', 2, 0, 0, 0, 19, '15-Jan-2020', '31-Jan-2020', '16-Jan-2020', '01-Feb-2020', 'gtaskblue', 0, '', 'Jalan Baru', 0),
(24, 0, '15-Jan-2020', 1579049122, 'Menaik taraf jalan sedia', 'Membina dan menaik taraf jalan-jalan kampung di kawasan Lembaga Kemajuan Wilayah (LKW) / Lembaga Kemajuan Tanah (LKT) tetapi tidak termasuk Jalan Ladang.', 0, 1, 0, '', 0, 0, 'TASK_5e1df022513e1', 2, 0, 0, 0, 19, '03-Feb-2020', '29-Feb-2020', '10-Feb-2020', '02-Mar-2020', 'gtaskblue', 0, '', 'Naik taraf', 0),
(25, 0, '15-Jan-2020', 1579053362, 'Lawatan Tapak', 'Mesyuarat bersama Kontraktor yang dilantik', 0, 3, 0, '', 0, 0, 'TASK_5e1e00b2c546e', 1, 0, 0, 0, 20, '22-Jan-2020', '22-Jan-2020', '23-Jan-2020', '23-Jan-2020', 'gtaskblue', 0, '', 'lawatan', 0),
(26, 0, '15-Jan-2020', 1579053472, 'Pembangunan RPA', 'Mula', 0, 3, 0, '', 0, 0, 'TASK_5e1e0120231f2', 1, 0, 0, 0, 20, '29-Jan-2020', '29-Feb-2020', '31-Jan-2020', '02-Mar-2020', 'gtaskblue', 0, '', 'pembinaan', 0),
(27, 0, '15-Jan-2020', 1579053584, 'Pemberian Kunci', 'Beri Kunci', 0, 3, 0, '', 0, 0, 'TASK_5e1e0190e6661', 1, 0, 0, 0, 20, '09-Mar-2020', '13-Mar-2020', '10-Mar-2020', '13-Mar-2020', 'gtaskblue', 0, '', 'kunci', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task_category`
--

CREATE TABLE IF NOT EXISTS `task_category` (
  `t_id` int(11) NOT NULL,
  `t_title` varchar(255) NOT NULL,
  `t_content` text NOT NULL,
  `t_date` varchar(255) NOT NULL,
  `t_time` int(15) NOT NULL,
  `t_user` int(11) NOT NULL,
  `t_category` int(11) NOT NULL,
  `t_tags` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_company`
--

CREATE TABLE IF NOT EXISTS `task_company` (
  `t_id` int(11) NOT NULL,
  `t_company` int(11) NOT NULL,
  `t_task` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_completion`
--

CREATE TABLE IF NOT EXISTS `task_completion` (
  `tc_id` int(11) NOT NULL,
  `tc_task` int(11) NOT NULL,
  `tc_completion` int(11) NOT NULL,
  `tc_note` text NOT NULL,
  `tc_date` varchar(100) NOT NULL,
  `tc_time` int(15) NOT NULL,
  `tc_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_group`
--

CREATE TABLE IF NOT EXISTS `task_group` (
  `tg_id` int(11) NOT NULL,
  `tg_name` varchar(255) NOT NULL,
  `tg_status` int(11) NOT NULL,
  `tg_date` varchar(100) NOT NULL,
  `tg_time` int(15) NOT NULL,
  `tg_user` int(11) NOT NULL,
  `tg_note` text NOT NULL,
  `tg_project` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_group`
--

INSERT INTO `task_group` (`tg_id`, `tg_name`, `tg_status`, `tg_date`, `tg_time`, `tg_user`, `tg_note`, `tg_project`) VALUES
(3, 'Jadual Kerja 1', 0, '29-Nov-2019', 1575047323, 1, 'Jadual Pertama sdgvghgslkjdfsdkjj', 1),
(4, 'jadual 2', 0, '02-Dec-2019', 1575298930, 1, 'Penjadualan Semula', 1),
(5, 'Development Schedule', 0, '06-Dec-2019', 1575654473, 1, 'Initial Schedule', 11),
(6, 'First Scheduledvsdgsd ', 0, '08-Dec-2019', 1575765134, 1, 'Agreed Schedulsdfdsfe', 12),
(8, 'Mesyuarat Kick-Off Projek Pengukuhan Sisten Backup Pusat Data', 0, '14-Jan-2020', 1579026989, 1, 'BTMK/SEJATI', 26),
(9, 'Mesyuarat Jawatankuasa Teknikal Projek Bil 1 2019', 0, '14-Jan-2020', 1579027065, 1, 'LAPORAN KEMAJUAN PROJEK BIL 1', 26),
(10, 'Penyediaan ETA Projek dan Gantt Chart Projek', 0, '14-Jan-2020', 1579027215, 1, 'TINDAKAN : SEJATI', 26),
(11, 'Kajian Persediaan Tapak Projek Sebenar ', 0, '14-Jan-2020', 1579027347, 1, 'Penyediaan diagram susun atur perkakasan projek\r\nTindakan : Sejati / BTMK', 26),
(12, 'Mesyuarat Jawatankuasa Teknikal Projek Bil 2 2019 ', 0, '14-Jan-2020', 1579027442, 1, 'LAPORAN KEMAJUAN PROJEK BIL 2', 26),
(13, 'Bekalan dan Pemasangan Peralatan Projek', 0, '14-Jan-2020', 1579027509, 1, '1. SPPTindakan : Sejati/BTMK', 26),
(14, 'Pengujian dan Pentaulihan Projek', 0, '14-Jan-2020', 1579027576, 1, '1. UAT 2. SPP 3. Perakuan Siap Kerja Tindakan : Sejati / BTMK', 26),
(15, 'Mesyuarat Jawatankuasa Teknikal Projek Bil 3 2019 ', 0, '14-Jan-2020', 1579027686, 1, '1.LAPORAN KEMAJUAN PROJEK BIL 3 2. PERAKUAN BAYARAN PROJEK', 26),
(16, 'Majlis Sign-Off Projek', 0, '14-Jan-2020', 1579027753, 1, 'Tindakan : BTMK/Sejati', 26),
(17, 'Membina jalan baru', 0, '15-Jan-2020', 1579048115, 1, 'Di antara skop program PJK adalah menaik taraf jalan raya dengan membina jalan baru, supaya jajaran jalan kampung dapat memberi faedah penggunaan yang maksimum. Selain daripada itu, menaik taraf jalan sedia ada tanpa mengubah jajaran atau dengan perubahan jajaran. Akhir sekali, membina dan menaik taraf jalan-jalan kampung di kawasan Lembaga Kemajuan Wilayah (LKW) / Lembaga Kemajuan Tanah (LKT) tetapi tidak termasuk Jalan Ladang.', 27),
(19, 'Membina jalan baru', 0, '15-Jan-2020', 1579048959, 1, 'Supaya jajaran jalan kampung dapat memberi faedah penggunaan yang maksimum', 29),
(20, 'Penjadualan Fasa 1', 0, '15-Jan-2020', 1579053256, 3, 'Dikemaskini pada 1 Jan 2020', 31);

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE IF NOT EXISTS `task_status` (
  `t_id` int(11) NOT NULL,
  `t_task` text NOT NULL,
  `t_date` varchar(255) NOT NULL,
  `t_time` int(15) NOT NULL,
  `t_title` varchar(255) NOT NULL,
  `t_message` text NOT NULL,
  `t_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_tags`
--

CREATE TABLE IF NOT EXISTS `task_tags` (
  `t_id` int(11) NOT NULL,
  `t_title` varchar(255) NOT NULL,
  `t_content` text NOT NULL,
  `t_status` int(11) NOT NULL,
  `t_time` int(15) NOT NULL,
  `t_date` varchar(255) NOT NULL,
  `t_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE IF NOT EXISTS `task_user` (
  `tu_id` int(11) NOT NULL,
  `tu_task` int(11) NOT NULL,
  `tu_user` int(11) NOT NULL,
  `tu_company` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`tu_id`, `tu_task`, `tu_user`, `tu_company`) VALUES
(1, 11, 2, 0),
(2, 11, 3, 0),
(3, 11, 0, 3),
(4, 12, 2, 0),
(5, 12, 0, 3),
(16, 13, 1, 0),
(17, 14, 1, 0),
(18, 14, 0, 3),
(19, 14, 0, 1),
(27, 16, 2, 0),
(28, 16, 0, 1),
(32, 15, 1, 0),
(33, 15, 2, 0),
(34, 15, 0, 3),
(35, 17, 1, 0),
(36, 17, 2, 0),
(37, 17, 0, 1),
(43, 18, 1, 0),
(44, 18, 2, 0),
(45, 18, 0, 1),
(46, 19, 1, 0),
(47, 19, 0, 1),
(54, 21, 1, 0),
(55, 21, 2, 0),
(56, 21, 3, 0),
(57, 20, 1, 0),
(58, 20, 2, 0),
(59, 20, 0, 1),
(60, 22, 1, 0),
(61, 22, 0, 7),
(62, 23, 1, 0),
(63, 23, 0, 7),
(64, 24, 1, 0),
(65, 24, 0, 7),
(66, 25, 3, 0),
(67, 25, 0, 9),
(68, 26, 3, 0),
(69, 26, 0, 9),
(70, 27, 3, 0),
(71, 27, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_login` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_picture` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_key` text NOT NULL,
  `user_department` int(11) NOT NULL,
  `user_sector` int(11) NOT NULL,
  `user_position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_login`, `user_password`, `user_role`, `user_email`, `user_phone`, `user_picture`, `user_status`, `user_key`, `user_department`, `user_sector`, `user_position`) VALUES
(1, 'PIC BTMK', 'pic_btmk', '43bf1c0b7a496f576b8b198c587fe0a11f87ca40488557651e8da25b187c9d13', 2, 'rokiah@kedah.gov.my', '1234567890', '', 1, '', 8, 0, 3),
(2, 'PIC JKR', 'pic_jkr', '43bf1c0b7a496f576b8b198c587fe0a11f87ca40488557651e8da25b187c9d13', 2, 'pic_jkr@gmail.com', '018212869', '', 1, '', 9, 0, 4),
(3, 'PIC PERUMAHAN', 'pic_perumahan', '43bf1c0b7a496f576b8b198c587fe0a11f87ca40488557651e8da25b187c9d13', 2, '', '', '', 0, '', 6, 0, 4),
(4, 'PIC KERAJAAN TEMPATAN', 'pic_kt', '43bf1c0b7a496f576b8b198c587fe0a11f87ca40488557651e8da25b187c9d13', 2, 'asdasd', 'asdasd', '', 0, 'USER_5dcc3c02e61ed', 7, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_department`
--

CREATE TABLE IF NOT EXISTS `user_department` (
  `ud_id` int(11) NOT NULL,
  `ud_user` int(11) NOT NULL,
  `ud_department` int(11) NOT NULL,
  `ud_role` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_department`
--

INSERT INTO `user_department` (`ud_id`, `ud_user`, `ud_department`, `ud_role`) VALUES
(12, 2, 1, 'user'),
(13, 3, 3, 'user'),
(14, 1, 1, 'leader'),
(15, 1, 2, 'leader'),
(18, 4, 1, 'leader'),
(19, 4, 2, 'leader');

-- --------------------------------------------------------

--
-- Table structure for table `vo`
--

CREATE TABLE IF NOT EXISTS `vo` (
  `v_id` int(11) NOT NULL,
  `v_date` varchar(100) NOT NULL,
  `v_project` int(11) NOT NULL,
  `v_status` int(11) NOT NULL,
  `v_value` double NOT NULL,
  `v_user` int(11) NOT NULL,
  `v_update` varchar(100) NOT NULL,
  `v_company` int(11) NOT NULL,
  `v_task` int(11) NOT NULL,
  `v_time` int(15) NOT NULL,
  `v_note` text NOT NULL,
  `v_ref` varchar(255) NOT NULL,
  `v_approve_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `company_category`
--
ALTER TABLE `company_category`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `discussion_category`
--
ALTER TABLE `discussion_category`
  ADD PRIMARY KEY (`dc_id`);

--
-- Indexes for table `eot`
--
ALTER TABLE `eot`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`j_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `project_application`
--
ALTER TABLE `project_application`
  ADD PRIMARY KEY (`pa_id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `project_company`
--
ALTER TABLE `project_company`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `project_department`
--
ALTER TABLE `project_department`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `project_file`
--
ALTER TABLE `project_file`
  ADD PRIMARY KEY (`pf_id`);

--
-- Indexes for table `project_finishing`
--
ALTER TABLE `project_finishing`
  ADD PRIMARY KEY (`pf_id`);

--
-- Indexes for table `project_maintenance`
--
ALTER TABLE `project_maintenance`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`pu_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `reports_category`
--
ALTER TABLE `reports_category`
  ADD PRIMARY KEY (`rc_id`);

--
-- Indexes for table `report_images`
--
ALTER TABLE `report_images`
  ADD PRIMARY KEY (`ri_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `setting_group`
--
ALTER TABLE `setting_group`
  ADD PRIMARY KEY (`sg_id`);

--
-- Indexes for table `sob`
--
ALTER TABLE `sob`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `task_category`
--
ALTER TABLE `task_category`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `task_company`
--
ALTER TABLE `task_company`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `task_completion`
--
ALTER TABLE `task_completion`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `task_group`
--
ALTER TABLE `task_group`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `task_tags`
--
ALTER TABLE `task_tags`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`tu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_department`
--
ALTER TABLE `user_department`
  ADD PRIMARY KEY (`ud_id`);

--
-- Indexes for table `vo`
--
ALTER TABLE `vo`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `company_category`
--
ALTER TABLE `company_category`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `discussion_category`
--
ALTER TABLE `discussion_category`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `eot`
--
ALTER TABLE `eot`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `j_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `project_application`
--
ALTER TABLE `project_application`
  MODIFY `pa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `project_company`
--
ALTER TABLE `project_company`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `project_department`
--
ALTER TABLE `project_department`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `project_file`
--
ALTER TABLE `project_file`
  MODIFY `pf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `project_finishing`
--
ALTER TABLE `project_finishing`
  MODIFY `pf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `project_maintenance`
--
ALTER TABLE `project_maintenance`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_tags`
--
ALTER TABLE `project_tags`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `pu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `reports_category`
--
ALTER TABLE `reports_category`
  MODIFY `rc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `report_images`
--
ALTER TABLE `report_images`
  MODIFY `ri_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `setting_group`
--
ALTER TABLE `setting_group`
  MODIFY `sg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sob`
--
ALTER TABLE `sob`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `task_category`
--
ALTER TABLE `task_category`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_company`
--
ALTER TABLE `task_company`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_completion`
--
ALTER TABLE `task_completion`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_group`
--
ALTER TABLE `task_group`
  MODIFY `tg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_tags`
--
ALTER TABLE `task_tags`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `tu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_department`
--
ALTER TABLE `user_department`
  MODIFY `ud_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `vo`
--
ALTER TABLE `vo`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
