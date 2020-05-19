-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 13 日 09:44
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
CREATE DATABASE IF NOT EXISTS `car_rental` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `car_rental`;

-- --------------------------------------------------------

--
-- 資料表結構 `advertisement`
--

CREATE TABLE `advertisement` (
  `adNo` int(11) NOT NULL,
  `adTitle` varchar(255) NOT NULL,
  `adImg` varchar(255) NOT NULL,
  `adUrl` varchar(255) NOT NULL,
  `adState` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `commodity`
--

CREATE TABLE `commodity` (
  `pNo` int(11) NOT NULL,
  `pBrand` varchar(255) NOT NULL,
  `pModel` varchar(255) NOT NULL,
  `pSit` varchar(255) NOT NULL,
  `pType` varchar(255) NOT NULL,
  `pOdo` varchar(255) NOT NULL,
  `pCc` varchar(255) NOT NULL,
  `pAge` varchar(255) NOT NULL,
  `pImg` varchar(255) NOT NULL,
  `pRent` varchar(255) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `rentState` varchar(255) NOT NULL,
  `rentAssign` varchar(255) NOT NULL,
  `shopAddressSelect` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `driver`
--

CREATE TABLE `driver` (
  `driverNo` int(11) NOT NULL,
  `driverName` varchar(255) NOT NULL,
  `driverAccount` varchar(255) NOT NULL,
  `driverPwd` varchar(255) NOT NULL,
  `driverPhoto` varchar(255) NOT NULL,
  `driverPhone` varchar(255) NOT NULL,
  `driverEmail` varchar(255) NOT NULL,
  `driverAddress` varchar(255) NOT NULL,
  `driverBirthday` varchar(255) NOT NULL,
  `driverId` varchar(255) NOT NULL,
  `driverGender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `orderNo` int(11) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `pRent` varchar(255) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `rentPlace` varchar(255) NOT NULL,
  `rentAddress` varchar(255) NOT NULL,
  `deliveryFee` varchar(255) NOT NULL,
  `startPlace` varchar(255) NOT NULL,
  `endPlace` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `mNO` int(11) NOT NULL,
  `mName` varchar(255) NOT NULL,
  `mAccount` varchar(255) NOT NULL,
  `mPwd` varchar(255) NOT NULL,
  `mPhoto` varchar(255) NOT NULL,
  `mEmail` varchar(255) NOT NULL,
  `mAddress` varchar(255) NOT NULL,
  `mBirthday` varchar(255) NOT NULL,
  `mId` varchar(255) NOT NULL,
  `mGender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `user_shop`
--

CREATE TABLE `user_shop` (
  `shopNo` int(11) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `shopAccount` varchar(255) NOT NULL,
  `shopPwd` varchar(255) NOT NULL,
  `shopPhone` varchar(255) NOT NULL,
  `shopEmail` varchar(255) NOT NULL,
  `shopOwner` varchar(255) NOT NULL,
  `shopAgent` varchar(255) NOT NULL,
  `shopAddress` varchar(255) NOT NULL,
  `shopAddressUrl` varchar(255) NOT NULL,
  `shopInfo` varchar(255) NOT NULL,
  `shopId` varchar(255) NOT NULL,
  `shopImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`adNo`);

--
-- 資料表索引 `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`pNo`);

--
-- 資料表索引 `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverNo`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderNo`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`mNO`);

--
-- 資料表索引 `user_shop`
--
ALTER TABLE `user_shop`
  ADD PRIMARY KEY (`shopNo`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `adNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `commodity`
--
ALTER TABLE `commodity`
  MODIFY `pNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `driver`
--
ALTER TABLE `driver`
  MODIFY `driverNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `order`
--
ALTER TABLE `order`
  MODIFY `orderNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `mNO` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `user_shop`
--
ALTER TABLE `user_shop`
  MODIFY `shopNo` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
