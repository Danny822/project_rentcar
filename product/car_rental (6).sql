-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 21 日 19:27
-- 伺服器版本: 10.1.37-MariaDB
-- PHP 版本： 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `car_rental`
--

-- --------------------------------------------------------

--
-- 資料表結構 `commodity`
--

CREATE TABLE `commodity` (
  `pNo` int(11) NOT NULL,
  `pBrand` varchar(255) NOT NULL,
  `pModel` varchar(255) NOT NULL,
  `pSit` int(2) NOT NULL,
  `pType` varchar(255) CHARACTER SET utf32 NOT NULL,
  `pOdo` int(255) NOT NULL,
  `pCc` int(4) NOT NULL,
  `pAge` int(3) NOT NULL,
  `pImg` varchar(255) NOT NULL,
  `pImg2` varchar(255) NOT NULL,
  `pImg3` varchar(255) NOT NULL,
  `pRent` int(255) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `rentState` varchar(255) NOT NULL,
  `rentAssign` varchar(255) NOT NULL,
  `shopAddressSelect` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `commodity`
--

INSERT INTO `commodity` (`pNo`, `pBrand`, `pModel`, `pSit`, `pType`, `pOdo`, `pCc`, `pAge`, `pImg`, `pImg2`, `pImg3`, `pRent`, `shopName`, `rentState`, `rentAssign`, `shopAddressSelect`) VALUES
(550, 'TOYOTA', 'VIOS', 5, '房車', 1000, 1600, 2, '5c935d9843c261.png', '5c935d9843c284.png', '5c935d9843c297.png', 2500, '', '未出租', '提供', '提供'),
(551, 'VOVO', 'XC60', 7, '休旅車', 2000, 2000, 2, '5c935e52f2c0c4.png', '5c935e52f2c11batman.jpg', '5c935e52f2c14border-image2.png', 2000, '', '未出租', '不提供', '不提供');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`pNo`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `commodity`
--
ALTER TABLE `commodity`
  MODIFY `pNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
