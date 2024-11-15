-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2018 at 10:52 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
-- Database: `test`
-- Table structure for table `agent`
CREATE TABLE `agent` (
  `Agent_code` varchar(10) NOT NULL,
  `Agent_name` varchar(150) NOT NULL,
  `DOB` date NOT NULL,
  `Branch` varchar(50) NOT NULL,
  `Contact_Num` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `customer` (
  `Customer_Num` bigint(10) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Gender` char(1) NOT NULL,
  `DOB` date NOT NULL,
  `Father_Name` varchar(150) NOT NULL,
  `Mother_Name` varchar(150) NOT NULL,
  `Address` varchar(70) NOT NULL,
  `Contact_Number` bigint(10) NOT NULL,
  `Marital_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Table structure for table `policy_data`
CREATE TABLE `policy_data` (
  `Policy_Num` int(15) NOT NULL,
  `Customer_Num` bigint(10) NOT NULL,
  `Agent_code` varchar(10) NOT NULL,
  `DOC` date NOT NULL,
  `Product` varchar(50) NOT NULL,
  `Sum_Assured` int(10) NOT NULL,
  `Pay_Period` int(2) NOT NULL,
  `Ins_Period` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `agent`
  ADD PRIMARY KEY (`Agent_code`);
-- Indexes for table `customer`
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_Num`);
-- Indexes for table `policy_data`
ALTER TABLE `policy_data`
  ADD PRIMARY KEY (`Policy_Num`),
  ADD KEY `Agent_code` (`Agent_code`),
  ADD KEY `Customer_Num` (`Customer_Num`);
-- AUTO_INCREMENT for table `customer`
ALTER TABLE `customer`
  MODIFY `Customer_Num` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;
-- Constraints for table `policy_data`
ALTER TABLE `policy_data`
  ADD CONSTRAINT `Agent_code` FOREIGN KEY (`Agent_code`) REFERENCES `agent` (`Agent_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Customer_Num` FOREIGN KEY (`Customer_Num`) REFERENCES `customer` (`Customer_Num`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

