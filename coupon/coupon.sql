-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 21 日 12:50
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
-- 資料庫： `coupon`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `couponNo` int(10) NOT NULL,
  `couponInfo` varchar(255) NOT NULL,
  `couponFunc` varchar(255) NOT NULL,
  `couponState` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `coupon`
--

INSERT INTO `coupon` (`couponNo`, `couponInfo`, `couponFunc`, `couponState`) VALUES
(1, '生日大驚喜！生日當月租車85折', '*0.85', 1),
(2, '訂車3次即享兩百折價優惠', '-200', 1),
(3, '租車4天加送一天!', '+1', 1),
(4, '租休旅車即享300折價優惠！', '-300', 1),
(5, '歡慶開幕！全站租車即享8折優惠！', '0.8', 1),
(6, '三五成行 ● 春遊趣', '*0.7', 0),
(7, '雙鐵接駁 ● 駕車趣', '*0.65', 0),
(8, '愛上中租 ● 計時趣', '$199/H', 0),
(9, '當日租還 ● 暢遊趣', '*0.55', 0),
(10, '台商返台 ● 思鄉趣', '*0.6', 0),
(11, '青春洋溢 ● 活力趣', '$1499 ', 0);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`couponNo`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `coupon`
--
ALTER TABLE `coupon`
  MODIFY `couponNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
