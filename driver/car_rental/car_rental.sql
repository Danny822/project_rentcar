-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 20 日 03:46
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
-- 資料表結構 `driver`
--

CREATE TABLE `driver` (
  `driverNo` int(11) NOT NULL,
  `driverName` varchar(255) NOT NULL,
  `driverGender` varchar(255) NOT NULL,
  `driverAccount` varchar(255) NOT NULL,
  `driverPwd` varchar(255) NOT NULL,
  `driverPhone` varchar(255) NOT NULL,
  `driverEmail` varchar(255) NOT NULL,
  `driverAddress` varchar(255) NOT NULL,
  `driverBirthday` date NOT NULL,
  `driverId` varchar(255) NOT NULL,
  `driverPhotoName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `driver`
--

INSERT INTO `driver` (`driverNo`, `driverName`, `driverGender`, `driverAccount`, `driverPwd`, `driverPhone`, `driverEmail`, `driverAddress`, `driverBirthday`, `driverId`, `driverPhotoName`) VALUES
(2, '沙沙沙', '男', 'sasasa', 'sasasa', '0919888999', 'sasasa@gmail.com', '台北市大安區復興南路100號', '1994-01-01', 'A123405789', 'photo-attractive-man-contemplative-expression-450w-1239154384.jpg'),
(4, '悠悠', '男', 'uouo', 'uouo', '0915123654', 'uouo@gmail.com', '台南市', '1998-07-07', 'D124578963', ''),
(5, '李中明1', '男', 'ming1', 'ming1', '09181', 'ming1@gmail.com', '台南市1', '1990-02-03', 'D126805121', ''),
(6, '李中明2', '男', 'ming2', 'ming2', '09182', 'ming2@gmail.com', '台南市2', '1990-02-03', 'D126805122', ''),
(7, '李中明3', '男', 'ming3', 'ming3', '09183', 'ming3@gmail.com', '台南市3', '1990-02-03', 'D126805123', ''),
(8, '李中明4', '男', 'ming4', 'ming4', '09184', 'ming4@gmail.com', '台南市4', '1990-02-03', 'D126805124', ''),
(9, '李中明5', '男', 'ming5', 'ming5', '09185', 'ming5@gmail.com', '台南市5', '1990-02-03', 'D126805125', ''),
(10, '李中明6', '男', 'ming6', 'ming6', '09186', 'ming6@gmail.com', '台南市6', '1990-02-03', 'D126805126', ''),
(11, '李中明7', '男', 'ming7', 'ming7', '09187', 'ming7@gmail.com', '台南市7', '1990-02-03', 'D126805127', ''),
(13, '李中明9', '男', 'ming9', 'ming9', '09189', 'ming9@gmail.com', '台南市9', '1990-02-03', 'D126805129', ''),
(14, '勾勾勾', '男', 'gogogo', 'gogogo', '0912456545', 'gogogo@gmail.com', '台中市', '1994-05-05', 'B124589631', ''),
(15, '李曉明', '男', 'mingming', 'mingming', '0999887456', 'mingming@gmail.com', '台中市', '1998-05-05', 'B120589452', ''),
(16, 'dfsds', '男', 'dsf', 'sdf', '0913123489', 'xiaofeidsf@gmail.com', '台北市\r\n', '1999-09-09', 'J126548966', '989d125363bb86f9c015627ea11aa021acbef2c4.jpg'),
(17, 'dsf', '男', 'sdfa', 'sdf', '0913123456', 'xiaofdsfei@gmail.com', 'dasd', '1999-09-09', 'A123698785', 'ba4a182ede658d9a02fc427dbc02f57382b7d3de.jpg'),
(18, 'sdf', '男', 'sdf', 'sdf', '0913123456', 'xiaofei@gmail.com', 'dsf', '1999-09-09', 'J126548968', '863740a162646b8dbd2e51ff747a1ab4e386f3fb.jpg'),
(25, '小霏霏', '男', 'xiaofei456', 'mingming', '0913123454', 'mingmipng@gmail.com', 'p;[l', '1999-09-09', 'J126548985', 'eae49c9214c3f8f5800ef38c78524fccbbcc7b56.jpg'),
(32, 'dasasd', '男', 'sasasasasa', 'asdasdasdd', '0913123102', 'xiaofeidfsf@gmail.com', 'dsfdsfad', '1980-05-05', 'D126805999', '5d5b7722b5e8d201105e97568b915a6ea71fbded.jpg'),
(36, '陳小菲', '男', 'dsfjuiojuio', 'feifei', '0915654789', 'sheng1@gmail.com', 'yutyutuytyu', '1998-08-08', 'A123698123', '90b20accfe501aa60e2454b7a5eb463a2ccc2c8a.jpg'),
(37, 'gggggg', '男', 'ggggggg', 'gggggg', '0913123000', 'gggggg@gmail.com', 'ggggggg', '1996-06-01', 'A223698789', NULL),
(38, '陳小', '男', 'aaaaaa', 'aaaaaa', '0913123054', 'aaaaaa@gmail.com', 'aaaaaa', '1999-09-09', 'J126548010', NULL),
(39, 'ssssss', '男', 'ssssss', 'ssssss', '0913123456', 'ssssss@gmail.com', 'ssssss', '1999-09-09', 'S126548987', NULL),
(40, 'ffffffffffffffffff', '男', 'fffffffffffffffff', 'fffffffffffffffff', '0913123456', 'ffffffffffffff@gmail.com', 'fffffffffffff', '1980-05-05', 'J526548987', NULL),
(41, 'iiiiiiiiiii', '男', 'iiiiii', 'iiiiii', '0999123999', 'iiiiiiiii@gmail.com', 'iiiiiiiiii', '1990-08-08', 'I126548987', '08f133cb417a7811755d9e34b6909f340944ea48.jpg5c9197d6ba318.jpg'),
(42, 'dsfdsfdf', '男', 'dsfdsfd', 'dsfdsfds', '0913123789', 'sdfdsfdfs@gmail.com', 'dsfdsfdsdsf', '1999-09-10', 'A199745654', 'photo-1438761681033-6461ffad8d80.jpg5c91a23985941.jpg'),
(44, 'dsfdsfggggg', '男', 'ggdfgreg', 'eqwrewqe', '0910123456', 'xidsfdsfaofei@gmail.com', 'tytytyty', '0000-00-00', 'J126548987', '08f133cb417a7811755d9e34b6909f340944ea48.jpg5c9197d6ba318.jpg5c91a28530909.jpg');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverNo`),
  ADD UNIQUE KEY `driverAccount` (`driverAccount`),
  ADD UNIQUE KEY `driverEmail` (`driverEmail`),
  ADD UNIQUE KEY `driverId` (`driverId`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `driver`
--
ALTER TABLE `driver`
  MODIFY `driverNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
