-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-28 10:26:17
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssisuo`
--

-- --------------------------------------------------------

--
-- 表的结构 `ssi_user`
--

CREATE TABLE `ssi_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `mdpsd` char(33) NOT NULL,
  `last_login_time` datetime NOT NULL,
  `limit_level` smallint(5) UNSIGNED NOT NULL,
  `group_name` varchar(32) NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `head_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ssi_user`
--

INSERT INTO `ssi_user` (`id`, `name`, `mdpsd`, `last_login_time`, `limit_level`, `group_name`, `member_id`, `customer_id`, `head_icon`) VALUES
(1, 'freefile', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-28 04:26:32', 1, '系统管理', 1, 1, '[1]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ssi_user`
--
ALTER TABLE `ssi_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `mdpsd` (`mdpsd`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ssi_user`
--
ALTER TABLE `ssi_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
