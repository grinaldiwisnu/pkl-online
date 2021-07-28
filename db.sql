-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 28, 2021 at 05:49 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pkl-online`
--

-- --------------------------------------------------------

--
-- Table structure for table `ADMIN`
--

CREATE TABLE `ADMIN` (
  `ADMIN_ID` smallint(6) NOT NULL,
  `ADMIN_NAME` varchar(60) NOT NULL,
  `ADMIN_EMAIL` varchar(60) NOT NULL,
  `ADMIN_PASSWORD` varchar(100) NOT NULL,
  `ADMIN_NOHP` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ADMIN`
--

INSERT INTO `ADMIN` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASSWORD`, `ADMIN_NOHP`) VALUES
(1, 'Grinaldi Admin', 'grinaldi@admin.com', '231099', '0852377238172');

-- --------------------------------------------------------

--
-- Table structure for table `COMPANY`
--

CREATE TABLE `COMPANY` (
  `COMPANY_ID` smallint(6) NOT NULL,
  `COMPANY_NAME` varchar(100) NOT NULL,
  `COMPANY_ADDRESS` varchar(100) NOT NULL,
  `COMPANY_IMAGE` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `COMPANY`
--

INSERT INTO `COMPANY` (`COMPANY_ID`, `COMPANY_NAME`, `COMPANY_ADDRESS`, `COMPANY_IMAGE`) VALUES
(3, 'PT. CPMA GROUP A', 'Jombang', '-'),
(4, 'EXCELLENCE INSTITUTE OF HYPNHOTHERAPY', '-', '-'),
(5, 'Direktur Indonesia Digital Entrepreneur Association', '-', '-'),
(6, 'PT. BOLIVA SIIRABAYA', '-', '-'),
(7, 'PT. BISNIS RESTO INDONESIA', '-', '-'),
(8, 'BOS KREATIF CLOTHXG', '-', '-'),
(9, 'PT SINAR SEJAHTERA INDONESIA ( PT.SSINDO)', '-', '-'),
(10, 'PT Pesan Code Integra', 'Malang', '-');

-- --------------------------------------------------------

--
-- Table structure for table `INSTITUTION`
--

CREATE TABLE `INSTITUTION` (
  `INSTITUTION_ID` smallint(6) NOT NULL,
  `INSTITUTION_NAME` varchar(100) NOT NULL,
  `INSTITUTION_ADDRESS` varchar(100) NOT NULL,
  `INSTITUTION_AS` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `INSTITUTION`
--

INSERT INTO `INSTITUTION` (`INSTITUTION_ID`, `INSTITUTION_NAME`, `INSTITUTION_ADDRESS`, `INSTITUTION_AS`) VALUES
(12, 'IAIN Tulungagung', 'Tulungagung', '-'),
(13, 'IAIN Madura', '-', '-'),
(14, 'Universitas Brawijaya', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `PAYMENT`
--

CREATE TABLE `PAYMENT` (
  `PAYMENT_ID` smallint(6) NOT NULL,
  `PAYMENT_NAME` varchar(45) NOT NULL,
  `PAYMENT_TOTAL` int(25) NOT NULL,
  `PAYMENT_METHOD` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT`
--

CREATE TABLE `PRODUCT` (
  `PRODUCT_ID` smallint(6) NOT NULL,
  `PRODUCT_NAME` varchar(45) NOT NULL,
  `PRODUCT_DESCRIPTION` text NOT NULL,
  `PRODUCT_PRICE` int(11) NOT NULL,
  `PRODUCT_STOCK` int(11) NOT NULL,
  `COMPANY_ID` smallint(6) NOT NULL,
  `CATEGORY_ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PRODUCT`
--

INSERT INTO `PRODUCT` (`PRODUCT_ID`, `PRODUCT_NAME`, `PRODUCT_DESCRIPTION`, `PRODUCT_PRICE`, `PRODUCT_STOCK`, `COMPANY_ID`, `CATEGORY_ID`) VALUES
(1, 'Pisang Goreng', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 2931831, 129, 3, 1),
(3, 'IAIN Tulungagung', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 123112312, 131, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT_CATEGORY`
--

CREATE TABLE `PRODUCT_CATEGORY` (
  `CATEGORY_ID` smallint(6) NOT NULL,
  `CATEGORY_NAME` varchar(45) NOT NULL,
  `CATEGORY_STATUS` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PRODUCT_CATEGORY`
--

INSERT INTO `PRODUCT_CATEGORY` (`CATEGORY_ID`, `CATEGORY_NAME`, `CATEGORY_STATUS`) VALUES
(1, 'Makanan', 1),
(2, 'Sandal', 1),
(3, 'Sepatu', 1),
(4, 'Baju', 1),
(5, 'Frozen Food', 1);

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT_IMAGE`
--

CREATE TABLE `PRODUCT_IMAGE` (
  `PRODUCT_IMAGE_ID` smallint(6) NOT NULL,
  `PRODUCT_IMAGE_NAME` varchar(100) NOT NULL,
  `PRODUCT_ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PRODUCT_IMAGE`
--

INSERT INTO `PRODUCT_IMAGE` (`PRODUCT_IMAGE_ID`, `PRODUCT_IMAGE_NAME`, `PRODUCT_ID`) VALUES
(1, 'ec7e18e14b779bad9cee491ea91cd20b.png', 3),
(2, '2d515413a644809af36c31e39583af18.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `TRANSACTION`
--

CREATE TABLE `TRANSACTION` (
  `TRANSACTION_ID` int(45) NOT NULL,
  `TRANSACTION_DATE` datetime NOT NULL,
  `TRANSACTION_CODE` varchar(45) NOT NULL,
  `TRANSACTION_STATUS` smallint(6) NOT NULL,
  `TRANSACTION_ADDRESS` text NOT NULL,
  `TRANSACTION_NOTE` text NOT NULL,
  `TRANSACTION_QTY` int(11) NOT NULL,
  `TRANSACTION_REFERENCE` text NOT NULL,
  `REFF_ID` varchar(45) NOT NULL,
  `USER_ID` smallint(6) NOT NULL,
  `PRODUCT_ID` smallint(6) NOT NULL,
  `PAYMENT_ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `USER_ID` smallint(6) NOT NULL,
  `USER_FULLNAME` varchar(45) NOT NULL,
  `USER_EMAIL` varchar(60) NOT NULL,
  `USER_PHONE` varchar(25) NOT NULL,
  `USER_PASSWORD` varchar(255) NOT NULL,
  `USER_AVATAR` varchar(45) DEFAULT NULL,
  `USER_BORNDATE` date DEFAULT NULL,
  `USER_CREATEDATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_STATUS` smallint(6) NOT NULL,
  `USER_IDENTIFICATION` varchar(45) DEFAULT NULL,
  `USER_NISN` varchar(45) DEFAULT NULL,
  `INSTITUTION_ID` smallint(6) NOT NULL,
  `COMPANY_ID` smallint(6) DEFAULT NULL,
  `TARGET` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`USER_ID`, `USER_FULLNAME`, `USER_EMAIL`, `USER_PHONE`, `USER_PASSWORD`, `USER_AVATAR`, `USER_BORNDATE`, `USER_CREATEDATE`, `USER_STATUS`, `USER_IDENTIFICATION`, `USER_NISN`, `INSTITUTION_ID`, `COMPANY_ID`, `TARGET`) VALUES
(1, 'Grinaldi Wisnu', 'grinaldifoc@gmail.com', '082244949484', '123456', NULL, NULL, '2021-04-03 03:54:07', 10, NULL, '3192313821312', 12, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `USER_PRODUCT`
--

CREATE TABLE `USER_PRODUCT` (
  `REFF_ID` varchar(45) NOT NULL,
  `REFF_DATE` datetime NOT NULL,
  `REFF_STATUS` smallint(6) NOT NULL,
  `USER_ID` smallint(6) NOT NULL,
  `PRODUCT_ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USER_PRODUCT`
--

INSERT INTO `USER_PRODUCT` (`REFF_ID`, `REFF_DATE`, `REFF_STATUS`, `USER_ID`, `PRODUCT_ID`) VALUES
('E0ZJG', '2021-07-21 11:47:13', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADMIN`
--
ALTER TABLE `ADMIN`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `COMPANY`
--
ALTER TABLE `COMPANY`
  ADD PRIMARY KEY (`COMPANY_ID`);

--
-- Indexes for table `INSTITUTION`
--
ALTER TABLE `INSTITUTION`
  ADD PRIMARY KEY (`INSTITUTION_ID`);

--
-- Indexes for table `PAYMENT`
--
ALTER TABLE `PAYMENT`
  ADD PRIMARY KEY (`PAYMENT_ID`);

--
-- Indexes for table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD PRIMARY KEY (`PRODUCT_ID`),
  ADD KEY `fkIdx_37` (`COMPANY_ID`),
  ADD KEY `fkIdx_44` (`CATEGORY_ID`);

--
-- Indexes for table `PRODUCT_CATEGORY`
--
ALTER TABLE `PRODUCT_CATEGORY`
  ADD PRIMARY KEY (`CATEGORY_ID`);

--
-- Indexes for table `PRODUCT_IMAGE`
--
ALTER TABLE `PRODUCT_IMAGE`
  ADD PRIMARY KEY (`PRODUCT_IMAGE_ID`),
  ADD KEY `fkIdx_82` (`PRODUCT_ID`);

--
-- Indexes for table `TRANSACTION`
--
ALTER TABLE `TRANSACTION`
  ADD PRIMARY KEY (`TRANSACTION_ID`),
  ADD KEY `fkIdx_64` (`REFF_ID`),
  ADD KEY `fkIdx_67` (`USER_ID`),
  ADD KEY `fkIdx_70` (`PRODUCT_ID`),
  ADD KEY `fkIdx_91` (`PAYMENT_ID`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `fkIdx_17` (`INSTITUTION_ID`),
  ADD KEY `fkIdx_27` (`COMPANY_ID`);

--
-- Indexes for table `USER_PRODUCT`
--
ALTER TABLE `USER_PRODUCT`
  ADD PRIMARY KEY (`REFF_ID`),
  ADD UNIQUE KEY `PRODUCT_ID` (`PRODUCT_ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`),
  ADD KEY `fkIdx_51` (`USER_ID`),
  ADD KEY `fkIdx_54` (`PRODUCT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ADMIN`
--
ALTER TABLE `ADMIN`
  MODIFY `ADMIN_ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `COMPANY`
--
ALTER TABLE `COMPANY`
  MODIFY `COMPANY_ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `INSTITUTION`
--
ALTER TABLE `INSTITUTION`
  MODIFY `INSTITUTION_ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  MODIFY `PRODUCT_ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `PRODUCT_CATEGORY`
--
ALTER TABLE `PRODUCT_CATEGORY`
  MODIFY `CATEGORY_ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `PRODUCT_IMAGE`
--
ALTER TABLE `PRODUCT_IMAGE`
  MODIFY `PRODUCT_IMAGE_ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TRANSACTION`
--
ALTER TABLE `TRANSACTION`
  MODIFY `TRANSACTION_ID` int(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `USER_ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `PRODUCT_CATEGORY` (`CATEGORY_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`COMPANY_ID`) REFERENCES `COMPANY` (`COMPANY_ID`);

--
-- Constraints for table `PRODUCT_IMAGE`
--
ALTER TABLE `PRODUCT_IMAGE`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`PRODUCT_ID`);

--
-- Constraints for table `TRANSACTION`
--
ALTER TABLE `TRANSACTION`
  ADD CONSTRAINT `FK_63` FOREIGN KEY (`REFF_ID`) REFERENCES `USER_PRODUCT` (`REFF_ID`),
  ADD CONSTRAINT `FK_90` FOREIGN KEY (`PAYMENT_ID`) REFERENCES `PAYMENT` (`PAYMENT_ID`),
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`PRODUCT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `USER` (`USER_ID`);

--
-- Constraints for table `USER`
--
ALTER TABLE `USER`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`INSTITUTION_ID`) REFERENCES `INSTITUTION` (`INSTITUTION_ID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`COMPANY_ID`) REFERENCES `COMPANY` (`COMPANY_ID`);

--
-- Constraints for table `USER_PRODUCT`
--
ALTER TABLE `USER_PRODUCT`
  ADD CONSTRAINT `user_product_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `USER` (`USER_ID`),
  ADD CONSTRAINT `user_product_ibfk_2` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`PRODUCT_ID`);
