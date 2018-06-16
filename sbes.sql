-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2018 at 07:17 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbes`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `GetAllAcquiredItems`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllAcquiredItems` ()  BEGIN
SELECT `rec_acquired_items`.`acqitem_id`,
    `rec_acquired_items`.`acquisition_id`,
    `rec_acquired_items`.`material_id`,
    `rec_acquired_items`.`acqitem_qty`,
    `rec_acquired_items`.`acqitem_price`,
    `rec_acquired_items`.`acqitem_subtotal`,
    `rec_acquired_items`.`acqitem_status`,
    `rec_acquired_items`.`acqitem_dateacquired`
FROM `sbes`.`rec_acquired_items`;
END$$

DROP PROCEDURE IF EXISTS `GetAllAcquisitions`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllAcquisitions` ()  BEGIN
SELECT `rec_acquisitions`.`acquisition_id`,
    `rec_acquisitions`.`project_id`,
    `rec_acquisitions`.`acquisition_ponumber`,
    `rec_acquisitions`.`acquisition_supplier`,
    `rec_acquisitions`.`acquisition_date`,
    `rec_acquisitions`.`acquisition_inserted`
FROM `sbes`.`rec_acquisitions`;
END$$

DROP PROCEDURE IF EXISTS `GetAllAttendance`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllAttendance` ()  BEGIN
SELECT `rec_attendances`.`attendance_id`,
    `rec_attendances`.`employee_id`,
    `rec_attendances`.`attendance_day`,
    `rec_attendances`.`attendance_in`,
    `rec_attendances`.`attendance_out`,
    `rec_attendances`.`attendance_remark`
FROM `sbes`.`rec_attendances`;
END$$

DROP PROCEDURE IF EXISTS `GetAllBIometrics`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllBIometrics` ()  BEGIN
SELECT `rec_empbiometrics`.`empbiometric_id`,
    `rec_empbiometrics`.`employee_id`,
    `rec_empbiometrics`.`empbiometric_data`
FROM `sbes`.`rec_empbiometrics`;
END$$

DROP PROCEDURE IF EXISTS `GetAllBonuses`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllBonuses` ()  BEGIN
SELECT `lib_bonuses`.`bonus_id`,
    `lib_bonuses`.`bonus_name`,
    `lib_bonuses`.`bonus_percent`,
    `lib_bonuses`.`bonus_amount`
FROM `sbes`.`lib_bonuses`;
END$$

DROP PROCEDURE IF EXISTS `GetAllDeductions`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllDeductions` ()  BEGIN
SELECT `lib_deductions`.`deduction_id`,
    `lib_deductions`.`deduction_name`,
    `lib_deductions`.`deduction_percent`,
    `lib_deductions`.`deduction_amount`
FROM `sbes`.`lib_deductions`;
END$$

DROP PROCEDURE IF EXISTS `GetAllDraftMaterialPlans`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllDraftMaterialPlans` ()  BEGIN
SELECT `rec_project_draft_material_plans`.`projdraftmatplan_id`,
    `rec_project_draft_material_plans`.`project_id`,
    `rec_project_draft_material_plans`.`material_id`,
    `rec_project_draft_material_plans`.`projdraftmatplan_qty`
FROM `sbes`.`rec_project_draft_material_plans`;
END$$

DROP PROCEDURE IF EXISTS `GetAllEmployeeBonuses`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllEmployeeBonuses` ()  BEGIN
SELECT `rec_empdeductions`.`empdeduction_id`,
    `rec_empdeductions`.`employee_id`,
    `rec_empdeductions`.`deduction_id`
FROM `sbes`.`rec_empdeductions`;
END$$

DROP PROCEDURE IF EXISTS `GetAllEmployees`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllEmployees` ()  BEGIN
SELECT `rec_employees`.`employee_id`,
    `rec_employees`.`project_id`,
    `rec_employees`.`position_id`,
    `rec_employees`.`employee_fname`,
    `rec_employees`.`employee_mname`,
    `rec_employees`.`employee_lname`,
    `rec_employees`.`employee_imagepath`,
    `rec_employees`.`employee_empstatus`,
    `rec_employees`.`employee_wage`,
    `rec_employees`.`employee_tmonth`,
    `rec_employees`.`employee_status`,
    `rec_employees`.`employee_inserted`,
    `rec_employees`.`employee_lastupdated`
FROM `sbes`.`rec_employees`;
END$$

DROP PROCEDURE IF EXISTS `GetAllEmployeeSchedules`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllEmployeeSchedules` ()  BEGIN
SELECT `rec_empschedules`.`empschedule_id`,
    `rec_empschedules`.`employee_id`,
    `rec_empschedules`.`empschedule_day`,
    `rec_empschedules`.`empschedule_in`,
    `rec_empschedules`.`empschedule_out`,
    `rec_empschedules`.`empschedule_status`
FROM `sbes`.`rec_empschedules`;
END$$

DROP PROCEDURE IF EXISTS `GetAllEmplyeeBonuses`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllEmplyeeBonuses` ()  BEGIN
SELECT `rec_empbonuses`.`empbonus_id`,
    `rec_empbonuses`.`employee_id`,
    `rec_empbonuses`.`bonus_id`
FROM `sbes`.`rec_empbonuses`;
END$$

DROP PROCEDURE IF EXISTS `GetAllForemen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllForemen` ()  BEGIN
SELECT `rec_project_foremen`.`projectforeman_id`,
    `rec_project_foremen`.`project_id`,
    `rec_project_foremen`.`employee_id`,
    `rec_project_foremen`.`projectforeman_inserted`
FROM `sbes`.`rec_project_foremen`;
END$$

DROP PROCEDURE IF EXISTS `GetAllHolidays`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllHolidays` ()  BEGIN
    SELECT `lib_holidays`.`holiday_id`,
        `lib_holidays`.`holiday_date`,
        `lib_holidays`.`holiday_otrate`,
        `lib_holidays`.`holiday_status`
    FROM `sbes`.`lib_holidays`;
END$$

DROP PROCEDURE IF EXISTS `GetAllInventories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllInventories` ()  BEGIN
SELECT `rec_inventories`.`inventory_id`,
    `rec_inventories`.`project_id`,
    `rec_inventories`.`material_id`,
    `rec_inventories`.`inventory_qty`,
    `rec_inventories`.`inventory_lastupdated`
FROM `sbes`.`rec_inventories`;
END$$

DROP PROCEDURE IF EXISTS `GetAllIssuances`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllIssuances` ()  BEGIN
SELECT `rec_issuances`.`issuance_id`,
    `rec_issuances`.`project_id`,
    `rec_issuances`.`issuance_issuer`,
    `rec_issuances`.`issuance_recipient`,
    `rec_issuances`.`issuance_date`,
    `rec_issuances`.`issuance_inserted`
FROM `sbes`.`rec_issuances`;
END$$

DROP PROCEDURE IF EXISTS `GetAllIssuedItems`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllIssuedItems` ()  BEGIN
SELECT `rec_issued_items`.`issitem_id`,
    `rec_issued_items`.`issuance_id`,
    `rec_issued_items`.`material_id`,
    `rec_issued_items`.`issitem_qty`,
    `rec_issued_items`.`issitem_status`,
    `rec_issued_items`.`acqitem_dateissued`
FROM `sbes`.`rec_issued_items`;
END$$

DROP PROCEDURE IF EXISTS `GetAllMaterials`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllMaterials` ()  BEGIN
SELECT `lib_materials`.`material_id`,
    `lib_materials`.`material_name`,
    `lib_materials`.`material_metric`,
    `lib_materials`.`material_created`
FROM `sbes`.`lib_materials`;
END$$

DROP PROCEDURE IF EXISTS `GetAllOtherDeductionLogs`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllOtherDeductionLogs` ()  BEGIN
SELECT `rec_other_deduction_logs`.`otherdeductionlog_id`,
    `rec_other_deduction_logs`.`employee_id`,
    `rec_other_deduction_logs`.`otherdeductionlog_description`,
    `rec_other_deduction_logs`.`otherdeductionlog_amount`,
    `rec_other_deduction_logs`.`otherdeductionlog_date`
FROM `sbes`.`rec_other_deduction_logs`;
END$$

DROP PROCEDURE IF EXISTS `GetAllOtherDeductions`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllOtherDeductions` ()  BEGIN
SELECT `rec_other_deductions`.`otherdeduction_id`,
    `rec_other_deductions`.`employee_id`,
    `rec_other_deductions`.`otherdeduction_total`,
    `rec_other_deductions`.`otherdeduction_paid`
FROM `sbes`.`rec_other_deductions`;
END$$

DROP PROCEDURE IF EXISTS `GetAllPayroll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllPayroll` ()  BEGIN
SELECT `rec_payrolls`.`payroll_id`,
    `rec_payrolls`.`project_id`,
    `rec_payrolls`.`payroll_start`,
    `rec_payrolls`.`payroll_end`,
    `rec_payrolls`.`payroll_status`,
    `rec_payrolls`.`payroll_created`,
    `rec_payrolls`.`Payroll_lastupdated`
FROM `sbes`.`rec_payrolls`;
END$$

DROP PROCEDURE IF EXISTS `GetAllPayrollItemDates`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllPayrollItemDates` ()  BEGIN
SELECT `rec_payroll_item_dates`.`payrollitemdate_id`,
    `rec_payroll_item_dates`.`payrollitem_id`,
    `rec_payroll_item_dates`.`payrollitemdate_day`,
    `rec_payroll_item_dates`.`payrollitemdate_date`,
    `rec_payroll_item_dates`.`payrollitem_hours`
FROM `sbes`.`rec_payroll_item_dates`;
END$$

DROP PROCEDURE IF EXISTS `GetAllPayrollItems`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllPayrollItems` ()  BEGIN
SELECT `rec_payroll_items`.`payrollitem_id`,
    `rec_payroll_items`.`employee_id`,
    `rec_payroll_items`.`bonus_id`,
    `rec_payroll_items`.`deduction_id`,
    `rec_payroll_items`.`payrollitem_timereg`,
    `rec_payroll_items`.`payrollitem_timeot`,
    `rec_payroll_items`.`payrollitem_basic`,
    `rec_payroll_items`.`payrollitem_ot`,
    `rec_payroll_items`.`payrollitem_deminimis`,
    `rec_payroll_items`.`payrollitem_tmonthamount`,
    `rec_payroll_items`.`payrollitem_gross`,
    `rec_payroll_items`.`payrollitem_net`,
    `rec_payroll_items`.`payrollitem_status`,
    `rec_payroll_items`.`payrollitem_lastupdated`
FROM `sbes`.`rec_payroll_items`;
END$$

DROP PROCEDURE IF EXISTS `GetAllProjectDraftForemen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProjectDraftForemen` ()  BEGIN
SELECT `rec_project_draft_foremen`.`projdraftforeman_id`,
    `rec_project_draft_foremen`.`project_id`,
    `rec_project_draft_foremen`.`employee_id`
FROM `sbes`.`rec_project_draft_foremen`;
END$$

DROP PROCEDURE IF EXISTS `GetAllProjectDrafts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProjectDrafts` ()  BEGIN
SELECT `rec_project_drafts`.`projdraft_id`,
    `rec_project_drafts`.`projdraft_contractnum`,
    `rec_project_drafts`.`projdraft_name`,
    `rec_project_drafts`.`projdraft_description`,
    `rec_project_drafts`.`projdraft_client`,
    `rec_project_drafts`.`projdraft_start`,
    `rec_project_drafts`.`projdraft_end`,
    `rec_project_drafts`.`projdraft_estbudget`,
    `rec_project_drafts`.`projdraft_inserted`,
    `rec_project_drafts`.`projdraft_lastupdated`
FROM `sbes`.`rec_project_drafts`;
END$$

DROP PROCEDURE IF EXISTS `GetAllProjectMaterialPlans`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProjectMaterialPlans` ()  BEGIN
SELECT `rec_project_material_plans`.`projectmatplan_id`,
    `rec_project_material_plans`.`project_id`,
    `rec_project_material_plans`.`material_id`,
    `rec_project_material_plans`.`projectmatplan_qty`
FROM `sbes`.`rec_project_material_plans`;
END$$

DROP PROCEDURE IF EXISTS `GetAllProjects`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProjects` ()  BEGIN
SELECT `rec_projects`.`project_id`,
    `rec_projects`.`project_contractnum`,
    `rec_projects`.`project_name`,
    `rec_projects`.`project_description`,
    `rec_projects`.`project_client`,
    `rec_projects`.`project_start`,
    `rec_projects`.`project_end`,
    `rec_projects`.`project_estbudget`,
    `rec_projects`.`project_status`,
    `rec_projects`.`project_inserted`,
    `rec_projects`.`project_lastupdated`
FROM `sbes`.`rec_projects`;
END$$

DROP PROCEDURE IF EXISTS `GetAllSettings`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllSettings` ()  BEGIN
SELECT `lib_settings`.`overtime_rate`,
    `lib_settings`.`deminimis_cap`
FROM `sbes`.`lib_settings`;
END$$

DROP PROCEDURE IF EXISTS `GetAllTransferrals`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllTransferrals` ()  BEGIN
SELECT `rec_transferrals`.`transferral_id`,
    `rec_transferrals`.`transferral_projectfrom`,
    `rec_transferrals`.`transferral_projectto`,
    `rec_transferrals`.`transferral_date`,
    `rec_transferrals`.`transferral_dateinserted`
FROM `sbes`.`rec_transferrals`;
END$$

DROP PROCEDURE IF EXISTS `GetAllTransferredItems`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllTransferredItems` ()  BEGIN
SELECT `rec_transferred_items`.`transitem_id`,
    `rec_transferred_items`.`transferral_id`,
    `rec_transferred_items`.`material_id`,
    `rec_transferred_items`.`transitem_qty`,
    `rec_transferred_items`.`transitem_price`,
    `rec_transferred_items`.`transitem_subtotal`,
    `rec_transferred_items`.`transitem_status`,
    `rec_transferred_items`.`transitem_datetransferred`
FROM `sbes`.`rec_transferred_items`;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_bonuses`
--

DROP TABLE IF EXISTS `lib_bonuses`;
CREATE TABLE IF NOT EXISTS `lib_bonuses` (
  `bonus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bonus_name` varchar(50) NOT NULL,
  `bonus_percent` float NOT NULL,
  `bonus_amount` float NOT NULL,
  PRIMARY KEY (`bonus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_bonuses`
--

INSERT INTO `lib_bonuses` (`bonus_id`, `bonus_name`, `bonus_percent`, `bonus_amount`) VALUES
(1, '13th MONTH', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lib_deductions`
--

DROP TABLE IF EXISTS `lib_deductions`;
CREATE TABLE IF NOT EXISTS `lib_deductions` (
  `deduction_id` int(11) NOT NULL AUTO_INCREMENT,
  `deduction_name` varchar(50) NOT NULL,
  `deduction_percent` float NOT NULL,
  `deduction_amount` float NOT NULL,
  PRIMARY KEY (`deduction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_deductions`
--

INSERT INTO `lib_deductions` (`deduction_id`, `deduction_name`, `deduction_percent`, `deduction_amount`) VALUES
(1, 'SSS', 5, 0),
(2, 'PHILHEALTH', 0, 150);

-- --------------------------------------------------------

--
-- Table structure for table `lib_employee_positions`
--

DROP TABLE IF EXISTS `lib_employee_positions`;
CREATE TABLE IF NOT EXISTS `lib_employee_positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_employee_positions`
--

INSERT INTO `lib_employee_positions` (`position_id`, `position_name`) VALUES
(1, 'FOREMAN'),
(2, 'LABORER');

-- --------------------------------------------------------

--
-- Table structure for table `lib_holidays`
--

DROP TABLE IF EXISTS `lib_holidays`;
CREATE TABLE IF NOT EXISTS `lib_holidays` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(30) NOT NULL,
  `holiday_date` date NOT NULL,
  `holiday_otrate` decimal(10,0) NOT NULL,
  `holiday_status` varchar(20) NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lib_materials`
--

DROP TABLE IF EXISTS `lib_materials`;
CREATE TABLE IF NOT EXISTS `lib_materials` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(150) NOT NULL,
  `material_metric` varchar(10) NOT NULL,
  `material_created` datetime NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_materials`
--

INSERT INTO `lib_materials` (`material_id`, `material_name`, `material_metric`, `material_created`) VALUES
(1, 'LANSANG', 'pcs', '2017-10-10 00:00:00'),
(2, 'SEMENTO', 'sack(s)', '2017-10-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lib_settings`
--

DROP TABLE IF EXISTS `lib_settings`;
CREATE TABLE IF NOT EXISTS `lib_settings` (
  `overtime_rate` decimal(10,0) NOT NULL,
  `deminimis_cap` float NOT NULL,
  `minutes_allowance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_settings`
--

INSERT INTO `lib_settings` (`overtime_rate`, `deminimis_cap`, `minutes_allowance`) VALUES
('20', 10000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `rec_acquired_items`
--

DROP TABLE IF EXISTS `rec_acquired_items`;
CREATE TABLE IF NOT EXISTS `rec_acquired_items` (
  `acqitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `acquisition_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `acqitem_qty` decimal(10,0) NOT NULL,
  `acqitem_price` float NOT NULL,
  `acqitem_subtotal` float NOT NULL,
  `acqitem_status` varchar(20) NOT NULL,
  `acqitem_dateacquired` datetime NOT NULL,
  PRIMARY KEY (`acqitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_acquisitions`
--

DROP TABLE IF EXISTS `rec_acquisitions`;
CREATE TABLE IF NOT EXISTS `rec_acquisitions` (
  `acquisition_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `acquisition_ponumber` varchar(40) NOT NULL,
  `acquisition_supplier` varchar(150) NOT NULL,
  `acquisition_date` datetime NOT NULL,
  `acquisition_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`acquisition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_attendances`
--

DROP TABLE IF EXISTS `rec_attendances`;
CREATE TABLE IF NOT EXISTS `rec_attendances` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `attendance_day` varchar(5) NOT NULL,
  `attendance_in` datetime NOT NULL,
  `attendance_out` datetime NOT NULL,
  `attendance_remark` varchar(20) NOT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_attendances`
--

INSERT INTO `rec_attendances` (`attendance_id`, `employee_id`, `attendance_day`, `attendance_in`, `attendance_out`, `attendance_remark`) VALUES
(1, 1, 'SUN', '2018-05-06 08:00:00', '2018-05-06 16:00:00', 'OT'),
(2, 2, 'MON', '2018-01-02 08:00:00', '2018-01-02 15:00:00', ''),
(3, 1, 'MON', '2018-01-31 08:00:00', '2018-01-31 15:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `rec_empbiometrics`
--

DROP TABLE IF EXISTS `rec_empbiometrics`;
CREATE TABLE IF NOT EXISTS `rec_empbiometrics` (
  `empbiometric_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `empbiometric_data` varchar(255) NOT NULL,
  PRIMARY KEY (`empbiometric_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_empbonuses`
--

DROP TABLE IF EXISTS `rec_empbonuses`;
CREATE TABLE IF NOT EXISTS `rec_empbonuses` (
  `empbonus_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `bonus_id` int(11) NOT NULL,
  PRIMARY KEY (`empbonus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_empdeductions`
--

DROP TABLE IF EXISTS `rec_empdeductions`;
CREATE TABLE IF NOT EXISTS `rec_empdeductions` (
  `empdeduction_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `deduction_id` int(11) NOT NULL,
  PRIMARY KEY (`empdeduction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_employees`
--

DROP TABLE IF EXISTS `rec_employees`;
CREATE TABLE IF NOT EXISTS `rec_employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `employee_fname` varchar(50) NOT NULL,
  `employee_mname` varchar(50) NOT NULL,
  `employee_lname` varchar(50) NOT NULL,
  `employee_imagepath` varchar(255) NOT NULL,
  `employee_empstatus` varchar(20) NOT NULL,
  `employee_wage` float NOT NULL,
  `employee_tmonth` tinyint(1) NOT NULL,
  `employee_status` varchar(20) NOT NULL,
  `employee_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_employees`
--

INSERT INTO `rec_employees` (`employee_id`, `project_id`, `position_id`, `employee_fname`, `employee_mname`, `employee_lname`, `employee_imagepath`, `employee_empstatus`, `employee_wage`, `employee_tmonth`, `employee_status`, `employee_inserted`, `employee_lastupdated`) VALUES
(1, 81, 1, 'SHANE_a', 'TIO', 'DIGAL', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 13:00:22'),
(2, 0, 1, 'HARVEY CHARLES', 'MIDDLENAME', 'PIOQUINTO', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-01 21:09:32'),
(3, 0, 1, 'CHRISTOPHER', 'YAMAS', 'DOMAUB', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-05 13:30:53'),
(4, 68, 2, 'MARIGOLD_a', 'UMIPIG', 'ANINGAT', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 13:40:30'),
(5, 68, 1, 'SHANE', 'TIO', 'DIGAL', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 13:40:30'),
(6, 0, 1, 'HARVEY CHARLES', 'MIDDLENAME', 'PIOQUINTO', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-01 21:09:32'),
(7, 0, 1, 'CHRISTOPHER', 'YAMAS', 'DOMAUB', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-05 13:09:17'),
(8, 57, 2, 'MARIGOLD', 'UMIPIG', 'ANINGAT', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 13:30:47'),
(9, 57, 1, 'SHANE', 'TIO', 'DIGAL', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 13:30:47'),
(10, 0, 1, 'HARVEY CHARLES', 'MIDDLENAME', 'PIOQUINTO', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-01 21:09:32'),
(11, 0, 1, 'CHRISTOPHER', 'YAMAS', 'DOMAUB', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-05 13:45:27'),
(12, 81, 2, 'MARIGOLD', 'UMIPIG', 'ANINGAT', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 13:00:22'),
(13, 0, 1, 'SHANE', 'TIO', 'DIGAL', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 12:56:58'),
(14, 34, 1, 'HARVEY CHARLES', 'MIDDLENAME', 'PIOQUINTO', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 12:57:21'),
(15, 0, 1, 'CHRISTOPHER', 'YAMAS', 'DOMAUB', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-01 21:09:32'),
(16, 34, 2, 'MARIGOLD', 'UMIPIG', 'ANINGAT', 'BLANK', 'REGULAR', 40, 1, 'ACTIVE', '2017-10-24 00:53:18', '2018-02-10 12:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `rec_empschedules`
--

DROP TABLE IF EXISTS `rec_empschedules`;
CREATE TABLE IF NOT EXISTS `rec_empschedules` (
  `empschedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `empschedule_day` varchar(5) NOT NULL,
  `empschedule_in` datetime NOT NULL,
  `empschedule_out` datetime NOT NULL,
  `empschedule_status` varchar(20) NOT NULL,
  PRIMARY KEY (`empschedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_inventories`
--

DROP TABLE IF EXISTS `rec_inventories`;
CREATE TABLE IF NOT EXISTS `rec_inventories` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `inventory_qty` decimal(10,0) NOT NULL,
  `inventory_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_issuances`
--

DROP TABLE IF EXISTS `rec_issuances`;
CREATE TABLE IF NOT EXISTS `rec_issuances` (
  `issuance_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `issuance_issuer` varchar(150) NOT NULL,
  `issuance_recipient` varchar(150) NOT NULL,
  `issuance_date` datetime NOT NULL,
  `issuance_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`issuance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_issued_items`
--

DROP TABLE IF EXISTS `rec_issued_items`;
CREATE TABLE IF NOT EXISTS `rec_issued_items` (
  `issitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `issuance_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `issitem_qty` decimal(10,0) NOT NULL,
  `issitem_status` varchar(20) NOT NULL,
  `acqitem_dateissued` datetime NOT NULL,
  PRIMARY KEY (`issitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_other_deductions`
--

DROP TABLE IF EXISTS `rec_other_deductions`;
CREATE TABLE IF NOT EXISTS `rec_other_deductions` (
  `otherdeduction_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `otherdeduction_total` float NOT NULL,
  `otherdeduction_paid` float NOT NULL,
  PRIMARY KEY (`otherdeduction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_other_deduction_logs`
--

DROP TABLE IF EXISTS `rec_other_deduction_logs`;
CREATE TABLE IF NOT EXISTS `rec_other_deduction_logs` (
  `otherdeductionlog_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `otherdeductionlog_description` varchar(50) NOT NULL,
  `otherdeductionlog_amount` float NOT NULL,
  `otherdeductionlog_date` datetime NOT NULL,
  PRIMARY KEY (`otherdeductionlog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_payrolls`
--

DROP TABLE IF EXISTS `rec_payrolls`;
CREATE TABLE IF NOT EXISTS `rec_payrolls` (
  `payroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `payroll_start` datetime NOT NULL,
  `payroll_end` datetime NOT NULL,
  `payroll_status` varchar(20) NOT NULL,
  `payroll_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Payroll_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payroll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_payrolls`
--

INSERT INTO `rec_payrolls` (`payroll_id`, `project_id`, `payroll_start`, `payroll_end`, `payroll_status`, `payroll_created`, `Payroll_lastupdated`) VALUES
(11, 1, '2018-06-08 00:00:00', '2018-06-14 00:00:00', 'Pending', '2018-06-08 00:52:47', '2018-06-08 00:52:47'),
(12, 1, '2018-06-08 00:00:00', '2018-06-14 00:00:00', 'Pending', '2018-06-08 00:53:45', '2018-06-08 00:53:45'),
(13, 1, '2018-06-08 00:00:00', '2018-06-14 00:00:00', 'Pending', '2018-06-08 00:58:07', '2018-06-08 00:58:07');

--
-- Triggers `rec_payrolls`
--
DROP TRIGGER IF EXISTS `delete_items`;
DELIMITER $$
CREATE TRIGGER `delete_items` AFTER DELETE ON `rec_payrolls` FOR EACH ROW DELETE FROM rec_payroll_items WHERE payroll_id = old.payroll_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rec_payroll_drafts`
--

DROP TABLE IF EXISTS `rec_payroll_drafts`;
CREATE TABLE IF NOT EXISTS `rec_payroll_drafts` (
  `payroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `payroll_start` datetime NOT NULL,
  `payroll_end` datetime NOT NULL,
  `payroll_status` varchar(20) NOT NULL,
  `payroll_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Payroll_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payroll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_payroll_drafts`
--

INSERT INTO `rec_payroll_drafts` (`payroll_id`, `project_id`, `payroll_start`, `payroll_end`, `payroll_status`, `payroll_created`, `Payroll_lastupdated`) VALUES
(53, 1, '2018-06-07 00:00:00', '2018-06-13 00:00:00', 'Pending', '2018-06-07 23:47:14', '2018-06-07 23:47:14');

--
-- Triggers `rec_payroll_drafts`
--
DROP TRIGGER IF EXISTS `delete_draft_items`;
DELIMITER $$
CREATE TRIGGER `delete_draft_items` AFTER DELETE ON `rec_payroll_drafts` FOR EACH ROW DELETE FROM rec_payroll_item_drafts WHERE payroll_id = old.payroll_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rec_payroll_items`
--

DROP TABLE IF EXISTS `rec_payroll_items`;
CREATE TABLE IF NOT EXISTS `rec_payroll_items` (
  `payrollitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `bonus_id` varchar(50) DEFAULT NULL,
  `deduction_id` varchar(50) DEFAULT NULL,
  `payrollitem_timereg` decimal(10,0) NOT NULL,
  `payrollitem_timeot` decimal(10,0) NOT NULL,
  `payrollitem_basic` float NOT NULL,
  `payrollitem_ot` float NOT NULL,
  `payrollitem_deminimis` float NOT NULL,
  `payrollitem_tmonthamount` float NOT NULL,
  `payrollitem_gross` float NOT NULL,
  `payrollitem_net` float NOT NULL,
  `payrollitem_status` varchar(20) NOT NULL,
  `payrollitem_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payrollitem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_payroll_items`
--

INSERT INTO `rec_payroll_items` (`payrollitem_id`, `payroll_id`, `employee_id`, `bonus_id`, `deduction_id`, `payrollitem_timereg`, `payrollitem_timeot`, `payrollitem_basic`, `payrollitem_ot`, `payrollitem_deminimis`, `payrollitem_tmonthamount`, `payrollitem_gross`, `payrollitem_net`, `payrollitem_status`, `payrollitem_lastupdated`) VALUES
(16, 11, 1, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 'Pending', '2018-06-08 00:52:47'),
(17, 11, 2, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 'Pending', '2018-06-08 00:52:47'),
(18, 12, 1, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 'Pending', '2018-06-08 00:53:45'),
(19, 12, 2, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 'Pending', '2018-06-08 00:53:45'),
(20, 13, 1, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 'Pending', '2018-06-08 00:58:07');

--
-- Triggers `rec_payroll_items`
--
DROP TRIGGER IF EXISTS `delete_item_date`;
DELIMITER $$
CREATE TRIGGER `delete_item_date` AFTER DELETE ON `rec_payroll_items` FOR EACH ROW DELETE FROM rec_payroll_item_dates WHERE payrollitem_id = old.payrollitem_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rec_payroll_item_dates`
--

DROP TABLE IF EXISTS `rec_payroll_item_dates`;
CREATE TABLE IF NOT EXISTS `rec_payroll_item_dates` (
  `payrollitemdate_id` int(11) NOT NULL AUTO_INCREMENT,
  `payrollitem_id` int(11) NOT NULL,
  `payrollitemdate_day` varchar(5) NOT NULL,
  `payrollitemdate_date` date NOT NULL,
  `payrollitem_hours` decimal(10,0) NOT NULL,
  PRIMARY KEY (`payrollitemdate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_payroll_item_dates`
--

INSERT INTO `rec_payroll_item_dates` (`payrollitemdate_id`, `payrollitem_id`, `payrollitemdate_day`, `payrollitemdate_date`, `payrollitem_hours`) VALUES
(231, 16, 'FRI', '2018-06-09', '0'),
(232, 16, 'SAT', '2018-06-10', '0'),
(233, 16, 'SUN', '2018-06-11', '0'),
(234, 16, 'MON', '2018-06-12', '0'),
(235, 16, 'TUE', '2018-06-13', '0'),
(236, 16, 'WED', '2018-06-14', '0'),
(237, 16, 'THU', '2018-06-15', '0'),
(238, 17, 'FRI', '2018-06-09', '0'),
(239, 17, 'SAT', '2018-06-10', '0'),
(240, 17, 'SUN', '2018-06-11', '0'),
(241, 17, 'MON', '2018-06-12', '0'),
(242, 17, 'TUE', '2018-06-13', '0'),
(243, 17, 'WED', '2018-06-14', '0'),
(244, 17, 'THU', '2018-06-15', '0'),
(245, 18, 'FRI', '2018-06-09', '0'),
(246, 18, 'SAT', '2018-06-10', '0'),
(247, 18, 'SUN', '2018-06-11', '0'),
(248, 18, 'MON', '2018-06-12', '0'),
(249, 18, 'TUE', '2018-06-13', '0'),
(250, 18, 'WED', '2018-06-14', '0'),
(251, 18, 'THU', '2018-06-15', '0'),
(252, 19, 'FRI', '2018-06-09', '0'),
(253, 19, 'SAT', '2018-06-10', '0'),
(254, 19, 'SUN', '2018-06-11', '0'),
(255, 19, 'MON', '2018-06-12', '0'),
(256, 19, 'TUE', '2018-06-13', '0'),
(257, 19, 'WED', '2018-06-14', '0'),
(258, 19, 'THU', '2018-06-15', '0'),
(259, 20, 'FRI', '2018-06-08', '0'),
(260, 20, 'SAT', '2018-06-09', '0'),
(261, 20, 'SUN', '2018-06-10', '0'),
(262, 20, 'MON', '2018-06-11', '0'),
(263, 20, 'TUE', '2018-06-12', '0'),
(264, 20, 'WED', '2018-06-13', '0'),
(265, 20, 'THU', '2018-06-14', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rec_payroll_item_date_drafts`
--

DROP TABLE IF EXISTS `rec_payroll_item_date_drafts`;
CREATE TABLE IF NOT EXISTS `rec_payroll_item_date_drafts` (
  `payrollitemdate_id` int(11) NOT NULL AUTO_INCREMENT,
  `payrollitem_id` int(11) NOT NULL,
  `payrollitemdate_day` varchar(5) NOT NULL,
  `payrollitemdate_date` date NOT NULL,
  `payrollitem_hours` decimal(10,0) NOT NULL,
  PRIMARY KEY (`payrollitemdate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_payroll_item_date_drafts`
--

INSERT INTO `rec_payroll_item_date_drafts` (`payrollitemdate_id`, `payrollitem_id`, `payrollitemdate_day`, `payrollitemdate_date`, `payrollitem_hours`) VALUES
(149, 71, 'THU', '2018-06-08', '0'),
(150, 71, 'FRI', '2018-06-09', '0'),
(151, 71, 'SAT', '2018-06-10', '0'),
(152, 71, 'SUN', '2018-06-11', '0'),
(153, 71, 'MON', '2018-06-12', '0'),
(154, 71, 'TUE', '2018-06-13', '0'),
(155, 71, 'WED', '2018-06-14', '0'),
(156, 72, 'THU', '2018-06-08', '0'),
(157, 72, 'FRI', '2018-06-09', '0'),
(158, 72, 'SAT', '2018-06-10', '0'),
(159, 72, 'SUN', '2018-06-11', '0'),
(160, 72, 'MON', '2018-06-12', '0'),
(161, 72, 'TUE', '2018-06-13', '0'),
(162, 72, 'WED', '2018-06-14', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rec_payroll_item_drafts`
--

DROP TABLE IF EXISTS `rec_payroll_item_drafts`;
CREATE TABLE IF NOT EXISTS `rec_payroll_item_drafts` (
  `payrollitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `bonus_id` varchar(50) DEFAULT NULL,
  `deduction_id` varchar(50) DEFAULT NULL,
  `payrollitem_timereg` decimal(10,0) NOT NULL,
  `payrollitem_timeot` decimal(10,0) NOT NULL,
  `payrollitem_basic` float NOT NULL,
  `payrollitem_ot` float NOT NULL,
  `payrollitem_deminimis` float NOT NULL,
  `payrollitem_tmonthamount` float NOT NULL,
  `payrollitem_gross` float NOT NULL,
  `payrollitem_net` float NOT NULL,
  `payrollitem_status` varchar(20) NOT NULL,
  `payrollitem_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payrollitem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_payroll_item_drafts`
--

INSERT INTO `rec_payroll_item_drafts` (`payrollitem_id`, `payroll_id`, `employee_id`, `bonus_id`, `deduction_id`, `payrollitem_timereg`, `payrollitem_timeot`, `payrollitem_basic`, `payrollitem_ot`, `payrollitem_deminimis`, `payrollitem_tmonthamount`, `payrollitem_gross`, `payrollitem_net`, `payrollitem_status`, `payrollitem_lastupdated`) VALUES
(71, 53, 1, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 'Pending', '2018-06-07 23:47:14'),
(72, 53, 2, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 'Pending', '2018-06-07 23:47:14');

--
-- Triggers `rec_payroll_item_drafts`
--
DROP TRIGGER IF EXISTS `delete_item_dates`;
DELIMITER $$
CREATE TRIGGER `delete_item_dates` AFTER DELETE ON `rec_payroll_item_drafts` FOR EACH ROW DELETE FROM rec_payroll_item_date_drafts WHERE payrollitem_id = old.payrollitem_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rec_projects`
--

DROP TABLE IF EXISTS `rec_projects`;
CREATE TABLE IF NOT EXISTS `rec_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_contractnum` varchar(40) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_description` varchar(255) NOT NULL,
  `project_client` varchar(150) NOT NULL,
  `project_start` date NOT NULL,
  `project_end` date NOT NULL,
  `project_estbudget` double NOT NULL,
  `project_status` varchar(20) NOT NULL,
  `project_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_projects`
--

INSERT INTO `rec_projects` (`project_id`, `project_contractnum`, `project_name`, `project_description`, `project_client`, `project_start`, `project_end`, `project_estbudget`, `project_status`, `project_inserted`, `project_lastupdated`) VALUES
(1, 'cccccc', 'cccc', '					dsa			\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								\n								', 'das', '2018-02-05', '2018-02-05', 11, 'Pending', '2018-02-10 02:31:14', '2018-05-13 15:36:44'),
(56, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:30:02', '2018-02-10 05:30:02'),
(57, '11', 'ddas', 'dsa\n								\n								', 'da', '2018-02-10', '2018-02-10', 11, 'Pending', '2018-02-10 05:30:47', '2018-02-10 05:30:47'),
(58, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:31:02', '2018-02-10 05:31:02'),
(59, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:31:34', '2018-02-10 05:31:34'),
(60, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:31:47', '2018-02-10 05:31:47'),
(61, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:32:12', '2018-02-10 05:32:12'),
(62, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:32:21', '2018-02-10 05:32:21'),
(63, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:33:56', '2018-02-10 05:33:56'),
(64, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:34:10', '2018-02-10 05:34:10'),
(65, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:36:04', '2018-02-10 05:36:04'),
(66, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:38:21', '2018-02-10 05:38:21'),
(67, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:38:32', '2018-02-10 05:38:32'),
(68, 'ds', 'ds', 'd\n								', 'd', '2018-02-10', '2018-02-10', 11, 'Pending', '2018-02-10 05:40:30', '2018-02-10 05:40:30'),
(69, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:42:04', '2018-02-10 05:42:04'),
(70, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:42:09', '2018-02-10 05:42:09'),
(71, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:42:30', '2018-02-10 05:42:30'),
(72, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:43:14', '2018-02-10 05:43:14'),
(73, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:44:02', '2018-02-10 05:44:02'),
(74, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:44:45', '2018-02-10 05:44:45'),
(75, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:44:59', '2018-02-10 05:44:59'),
(76, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:45:37', '2018-02-10 05:45:37'),
(77, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:46:13', '2018-02-10 05:46:13'),
(78, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:46:37', '2018-02-10 05:46:37'),
(79, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:46:46', '2018-02-10 05:46:46'),
(80, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:47:16', '2018-02-10 05:47:16'),
(81, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:52:31', '2018-02-10 05:52:31'),
(82, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:53:11', '2018-02-10 05:53:11'),
(83, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 05:54:56', '2018-02-10 05:54:56'),
(84, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, 'Pending', '2018-02-10 06:04:00', '2018-02-10 06:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `rec_project_drafts`
--

DROP TABLE IF EXISTS `rec_project_drafts`;
CREATE TABLE IF NOT EXISTS `rec_project_drafts` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_contractnum` varchar(40) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_description` varchar(255) NOT NULL,
  `project_client` varchar(150) NOT NULL,
  `project_start` date NOT NULL,
  `project_end` date NOT NULL,
  `project_estbudget` double NOT NULL,
  `project_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_project_drafts`
--

INSERT INTO `rec_project_drafts` (`project_id`, `project_contractnum`, `project_name`, `project_description`, `project_client`, `project_start`, `project_end`, `project_estbudget`, `project_inserted`, `project_lastupdated`) VALUES
(82, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:30:08', '2018-02-10 05:30:08'),
(83, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:38:44', '2018-02-10 05:38:44'),
(84, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:45:33', '2018-02-10 05:45:33'),
(85, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:45:46', '2018-02-10 05:45:46'),
(86, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:46:10', '2018-02-10 05:46:10'),
(87, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:54:21', '2018-02-10 05:54:21'),
(88, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:55:06', '2018-02-10 05:55:06'),
(89, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:56:43', '2018-02-10 05:56:43'),
(90, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:56:48', '2018-02-10 05:56:48'),
(91, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:58:16', '2018-02-10 05:58:16'),
(92, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 05:59:33', '2018-02-10 05:59:33'),
(93, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 06:01:31', '2018-02-10 06:01:31'),
(94, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 06:02:31', '2018-02-10 06:02:31'),
(95, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 06:02:38', '2018-02-10 06:02:38'),
(96, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 06:04:12', '2018-02-10 06:04:12'),
(97, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 06:04:18', '2018-02-10 06:04:18'),
(98, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 06:04:36', '2018-02-10 06:04:36'),
(99, '', '', '\n								', '', '2018-02-10', '2018-02-10', 0, '2018-02-10 06:05:44', '2018-02-10 06:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `rec_project_draft_employees`
--

DROP TABLE IF EXISTS `rec_project_draft_employees`;
CREATE TABLE IF NOT EXISTS `rec_project_draft_employees` (
  `projectforeman_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `projectforeman_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`projectforeman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_project_draft_employees`
--

INSERT INTO `rec_project_draft_employees` (`projectforeman_id`, `project_id`, `employee_id`, `projectforeman_inserted`) VALUES
(1, 81, 12, '2018-02-10 05:00:22'),
(2, 82, 0, '2018-02-10 05:30:08'),
(3, 83, 0, '2018-02-10 05:38:44'),
(4, 84, 0, '2018-02-10 05:45:33'),
(5, 85, 0, '2018-02-10 05:45:46'),
(6, 86, 0, '2018-02-10 05:46:10'),
(7, 87, 0, '2018-02-10 05:54:21'),
(8, 88, 0, '2018-02-10 05:55:06'),
(9, 89, 0, '2018-02-10 05:56:43'),
(10, 90, 0, '2018-02-10 05:56:48'),
(11, 91, 0, '2018-02-10 05:58:16'),
(12, 92, 0, '2018-02-10 05:59:33'),
(13, 93, 0, '2018-02-10 06:01:31'),
(14, 94, 0, '2018-02-10 06:02:31'),
(15, 95, 0, '2018-02-10 06:02:38'),
(16, 96, 0, '2018-02-10 06:04:12'),
(17, 97, 0, '2018-02-10 06:04:18'),
(18, 98, 0, '2018-02-10 06:04:36'),
(19, 99, 0, '2018-02-10 06:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `rec_project_draft_foremen`
--

DROP TABLE IF EXISTS `rec_project_draft_foremen`;
CREATE TABLE IF NOT EXISTS `rec_project_draft_foremen` (
  `projectforeman_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `projectforeman_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`projectforeman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_project_draft_foremen`
--

INSERT INTO `rec_project_draft_foremen` (`projectforeman_id`, `project_id`, `employee_id`, `projectforeman_inserted`) VALUES
(1, 81, 1, '2018-02-10 05:00:22'),
(2, 82, 0, '2018-02-10 05:30:08'),
(3, 83, 0, '2018-02-10 05:38:44'),
(4, 84, 0, '2018-02-10 05:45:33'),
(5, 85, 0, '2018-02-10 05:45:46'),
(6, 86, 0, '2018-02-10 05:46:10'),
(7, 87, 0, '2018-02-10 05:54:21'),
(8, 88, 0, '2018-02-10 05:55:06'),
(9, 89, 0, '2018-02-10 05:56:43'),
(10, 90, 0, '2018-02-10 05:56:48'),
(11, 91, 0, '2018-02-10 05:58:16'),
(12, 92, 0, '2018-02-10 05:59:33'),
(13, 93, 0, '2018-02-10 06:01:31'),
(14, 94, 0, '2018-02-10 06:02:31'),
(15, 95, 0, '2018-02-10 06:02:38'),
(16, 96, 0, '2018-02-10 06:04:12'),
(17, 97, 0, '2018-02-10 06:04:18'),
(18, 98, 0, '2018-02-10 06:04:36'),
(19, 99, 0, '2018-02-10 06:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `rec_project_draft_material_plans`
--

DROP TABLE IF EXISTS `rec_project_draft_material_plans`;
CREATE TABLE IF NOT EXISTS `rec_project_draft_material_plans` (
  `projectmatplan_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `projectmatplan_qty` decimal(10,0) NOT NULL,
  PRIMARY KEY (`projectmatplan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_project_draft_material_plans`
--

INSERT INTO `rec_project_draft_material_plans` (`projectmatplan_id`, `project_id`, `material_id`, `projectmatplan_qty`) VALUES
(1, 81, 2, '0'),
(2, 82, 0, '0'),
(3, 83, 0, '0'),
(4, 84, 0, '0'),
(5, 85, 0, '0'),
(6, 86, 0, '0'),
(7, 87, 0, '0'),
(8, 88, 0, '0'),
(9, 89, 0, '0'),
(10, 90, 0, '0'),
(11, 91, 0, '0'),
(12, 92, 0, '0'),
(13, 93, 0, '0'),
(14, 94, 0, '0'),
(15, 95, 0, '0'),
(16, 96, 0, '0'),
(17, 97, 0, '0'),
(18, 98, 0, '0'),
(19, 99, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `rec_project_employees`
--

DROP TABLE IF EXISTS `rec_project_employees`;
CREATE TABLE IF NOT EXISTS `rec_project_employees` (
  `projectemployee_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `projectemployee_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`projectemployee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_project_employees`
--

INSERT INTO `rec_project_employees` (`projectemployee_id`, `project_id`, `employee_id`, `projectemployee_inserted`) VALUES
(4, 33, 4, '2017-11-08 12:40:04'),
(5, 34, 16, '2017-11-08 12:41:20'),
(6, 35, 12, '2017-11-08 13:01:48'),
(7, 59, 8, '2017-11-08 13:41:18'),
(9, 63, 12, '2017-12-11 17:56:36'),
(10, 64, 8, '2017-12-11 17:59:42'),
(27, 62, 12, '2017-12-12 13:11:31'),
(32, 1, 4, '2017-12-27 14:34:18'),
(33, 114, 8, '2018-01-30 01:19:16'),
(34, 115, 12, '2018-01-30 01:20:22'),
(35, 1, 4, '2018-01-30 01:33:10'),
(36, 2, 16, '2018-01-30 01:47:50'),
(37, 3, 8, '2018-01-30 01:48:22'),
(52, 1, 8, '2018-02-05 05:10:13'),
(53, 2, 12, '2018-02-05 05:11:20'),
(54, 3, 4, '2018-02-05 05:14:02'),
(55, 4, 8, '2018-02-05 05:15:19'),
(56, 4, 4, '2018-02-05 05:15:19'),
(57, 5, 8, '2018-02-05 05:15:35'),
(58, 5, 4, '2018-02-05 05:15:35'),
(59, 6, 16, '2018-02-05 05:21:47'),
(60, 7, 8, '2018-02-05 05:24:33'),
(61, 8, 12, '2018-02-05 05:26:38'),
(62, 9, 16, '2018-02-05 05:28:31'),
(63, 10, 4, '2018-02-05 05:30:12'),
(64, 11, 4, '2018-02-05 05:30:15'),
(65, 12, 12, '2018-02-05 05:32:10'),
(66, 13, 16, '2018-02-05 05:34:11'),
(67, 14, 8, '2018-02-05 05:34:46'),
(68, 15, 4, '2018-02-05 05:35:48'),
(69, 16, 4, '2018-02-05 05:35:51'),
(70, 17, 4, '2018-02-05 05:35:51'),
(71, 18, 12, '2018-02-05 05:45:38'),
(72, 19, 8, '2018-02-05 05:47:38'),
(73, 20, 16, '2018-02-09 17:31:33'),
(74, 21, 8, '2018-02-10 02:31:14'),
(75, 21, 4, '2018-02-10 02:31:14'),
(76, 22, 8, '2018-02-10 02:51:16'),
(77, 22, 4, '2018-02-10 02:51:16'),
(78, 23, 8, '2018-02-10 02:53:51'),
(79, 23, 4, '2018-02-10 02:53:51'),
(80, 24, 8, '2018-02-10 02:54:12'),
(81, 24, 4, '2018-02-10 02:54:12'),
(82, 25, 8, '2018-02-10 02:54:29'),
(83, 25, 4, '2018-02-10 02:54:29'),
(84, 26, 8, '2018-02-10 02:54:48'),
(85, 26, 4, '2018-02-10 02:54:48'),
(86, 27, 8, '2018-02-10 02:55:41'),
(87, 27, 4, '2018-02-10 02:55:41'),
(88, 28, 8, '2018-02-10 02:55:58'),
(89, 28, 4, '2018-02-10 02:55:58'),
(90, 29, 8, '2018-02-10 02:56:12'),
(91, 29, 4, '2018-02-10 02:56:12'),
(92, 30, 8, '2018-02-10 02:57:57'),
(93, 30, 4, '2018-02-10 02:57:57'),
(94, 31, 8, '2018-02-10 03:03:09'),
(95, 31, 4, '2018-02-10 03:03:09'),
(96, 32, 8, '2018-02-10 03:05:24'),
(97, 32, 4, '2018-02-10 03:05:24'),
(98, 0, 8, '2018-02-10 03:09:16'),
(99, 0, 4, '2018-02-10 03:09:16'),
(100, 0, 8, '2018-02-10 03:09:41'),
(101, 0, 4, '2018-02-10 03:09:41'),
(102, 0, 8, '2018-02-10 03:25:49'),
(103, 0, 4, '2018-02-10 03:25:49'),
(104, 0, 8, '2018-02-10 03:26:36'),
(105, 0, 4, '2018-02-10 03:26:36'),
(106, 0, 8, '2018-02-10 03:26:53'),
(107, 0, 4, '2018-02-10 03:26:53'),
(108, 0, 8, '2018-02-10 03:27:09'),
(109, 0, 4, '2018-02-10 03:27:09'),
(110, 0, 8, '2018-02-10 03:27:22'),
(111, 0, 4, '2018-02-10 03:27:22'),
(112, 21, 8, '2018-02-10 03:58:10'),
(113, 21, 4, '2018-02-10 03:58:10'),
(114, 21, 8, '2018-02-10 03:58:17'),
(115, 21, 4, '2018-02-10 03:58:17'),
(116, 21, 8, '2018-02-10 03:58:17'),
(117, 21, 4, '2018-02-10 03:58:17'),
(118, 21, 8, '2018-02-10 03:59:54'),
(119, 21, 4, '2018-02-10 03:59:54'),
(120, 21, 8, '2018-02-10 03:59:54'),
(121, 21, 4, '2018-02-10 03:59:54'),
(122, 21, 8, '2018-02-10 03:59:54'),
(123, 21, 4, '2018-02-10 03:59:54'),
(124, 21, 8, '2018-02-10 03:59:54'),
(125, 21, 4, '2018-02-10 03:59:54'),
(126, 33, 16, '2018-02-10 04:57:16'),
(127, 34, 16, '2018-02-10 04:57:21'),
(128, 35, 12, '2018-02-10 04:59:28'),
(129, 36, 12, '2018-02-10 05:00:21'),
(130, 53, 0, '2018-02-10 05:24:31'),
(131, 56, 0, '2018-02-10 05:30:02'),
(132, 57, 8, '2018-02-10 05:30:47'),
(133, 58, 0, '2018-02-10 05:31:02'),
(134, 59, 0, '2018-02-10 05:31:34'),
(135, 60, 0, '2018-02-10 05:31:47'),
(136, 61, 0, '2018-02-10 05:32:12'),
(137, 62, 0, '2018-02-10 05:32:21'),
(138, 63, 0, '2018-02-10 05:33:56'),
(139, 64, 0, '2018-02-10 05:34:10'),
(140, 65, 0, '2018-02-10 05:36:04'),
(141, 66, 0, '2018-02-10 05:38:21'),
(142, 67, 0, '2018-02-10 05:38:32'),
(143, 68, 4, '2018-02-10 05:40:30'),
(144, 69, 0, '2018-02-10 05:42:04'),
(145, 70, 0, '2018-02-10 05:42:09'),
(146, 71, 0, '2018-02-10 05:42:30'),
(147, 72, 0, '2018-02-10 05:43:14'),
(148, 73, 0, '2018-02-10 05:44:02'),
(149, 74, 0, '2018-02-10 05:44:45'),
(150, 75, 0, '2018-02-10 05:44:59'),
(151, 76, 0, '2018-02-10 05:45:37'),
(152, 77, 0, '2018-02-10 05:46:13'),
(153, 78, 0, '2018-02-10 05:46:37'),
(154, 79, 0, '2018-02-10 05:46:46'),
(155, 80, 0, '2018-02-10 05:47:16'),
(156, 81, 0, '2018-02-10 05:52:31'),
(157, 82, 0, '2018-02-10 05:53:11'),
(158, 83, 0, '2018-02-10 05:54:56'),
(159, 84, 0, '2018-02-10 06:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `rec_project_foremen`
--

DROP TABLE IF EXISTS `rec_project_foremen`;
CREATE TABLE IF NOT EXISTS `rec_project_foremen` (
  `projectforeman_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `projectforeman_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`projectforeman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_project_foremen`
--

INSERT INTO `rec_project_foremen` (`projectforeman_id`, `project_id`, `employee_id`, `projectforeman_inserted`) VALUES
(4, 33, 7, '2017-11-08 12:40:04'),
(5, 34, 14, '2017-11-08 12:41:20'),
(6, 35, 10, '2017-11-08 13:01:48'),
(7, 59, 3, '2017-11-08 13:41:18'),
(9, 63, 3, '2017-12-11 17:56:36'),
(10, 64, 5, '2017-12-11 17:59:42'),
(28, 62, 9, '2017-12-12 13:11:31'),
(33, 1, 1, '2017-12-27 14:34:18'),
(34, 114, 5, '2018-01-30 01:19:16'),
(35, 115, 13, '2018-01-30 01:20:22'),
(36, 1, 9, '2018-01-30 01:33:10'),
(37, 2, 5, '2018-01-30 01:47:50'),
(38, 3, 9, '2018-01-30 01:48:22'),
(53, 1, 5, '2018-02-05 05:10:13'),
(54, 2, 9, '2018-02-05 05:11:20'),
(55, 3, 1, '2018-02-05 05:14:02'),
(56, 4, 9, '2018-02-05 05:15:19'),
(57, 4, 1, '2018-02-05 05:15:19'),
(58, 5, 9, '2018-02-05 05:15:35'),
(59, 5, 1, '2018-02-05 05:15:35'),
(60, 6, 3, '2018-02-05 05:21:47'),
(61, 7, 5, '2018-02-05 05:24:33'),
(62, 8, 9, '2018-02-05 05:26:38'),
(63, 9, 13, '2018-02-05 05:28:31'),
(64, 10, 3, '2018-02-05 05:30:12'),
(65, 11, 3, '2018-02-05 05:30:15'),
(66, 12, 5, '2018-02-05 05:32:10'),
(67, 13, 9, '2018-02-05 05:34:11'),
(68, 14, 14, '2018-02-05 05:34:46'),
(69, 15, 11, '2018-02-05 05:35:48'),
(70, 16, 11, '2018-02-05 05:35:51'),
(71, 17, 11, '2018-02-05 05:35:51'),
(72, 18, 14, '2018-02-05 05:45:38'),
(73, 19, 13, '2018-02-05 05:47:38'),
(74, 20, 5, '2018-02-09 17:31:33'),
(75, 21, 9, '2018-02-10 02:31:14'),
(76, 21, 1, '2018-02-10 02:31:14'),
(77, 22, 9, '2018-02-10 02:51:16'),
(78, 22, 1, '2018-02-10 02:51:16'),
(79, 23, 9, '2018-02-10 02:53:51'),
(80, 23, 1, '2018-02-10 02:53:51'),
(81, 24, 9, '2018-02-10 02:54:12'),
(82, 24, 1, '2018-02-10 02:54:12'),
(83, 25, 9, '2018-02-10 02:54:29'),
(84, 25, 1, '2018-02-10 02:54:29'),
(85, 26, 9, '2018-02-10 02:54:48'),
(86, 26, 1, '2018-02-10 02:54:48'),
(87, 27, 9, '2018-02-10 02:55:41'),
(88, 27, 1, '2018-02-10 02:55:41'),
(89, 28, 9, '2018-02-10 02:55:58'),
(90, 28, 1, '2018-02-10 02:55:58'),
(91, 29, 9, '2018-02-10 02:56:12'),
(92, 29, 1, '2018-02-10 02:56:12'),
(93, 30, 9, '2018-02-10 02:57:57'),
(94, 30, 1, '2018-02-10 02:57:57'),
(95, 31, 9, '2018-02-10 03:03:09'),
(96, 31, 1, '2018-02-10 03:03:09'),
(97, 32, 9, '2018-02-10 03:05:24'),
(98, 32, 1, '2018-02-10 03:05:24'),
(99, 0, 9, '2018-02-10 03:09:16'),
(100, 0, 1, '2018-02-10 03:09:16'),
(101, 0, 9, '2018-02-10 03:09:41'),
(102, 0, 1, '2018-02-10 03:09:41'),
(103, 0, 9, '2018-02-10 03:25:49'),
(104, 0, 1, '2018-02-10 03:25:49'),
(105, 0, 9, '2018-02-10 03:26:36'),
(106, 0, 1, '2018-02-10 03:26:36'),
(107, 0, 9, '2018-02-10 03:26:53'),
(108, 0, 1, '2018-02-10 03:26:53'),
(109, 0, 9, '2018-02-10 03:27:09'),
(110, 0, 1, '2018-02-10 03:27:09'),
(111, 0, 9, '2018-02-10 03:27:22'),
(112, 0, 1, '2018-02-10 03:27:22'),
(113, 21, 9, '2018-02-10 03:58:10'),
(114, 21, 1, '2018-02-10 03:58:10'),
(115, 21, 9, '2018-02-10 03:58:17'),
(116, 21, 1, '2018-02-10 03:58:17'),
(117, 21, 9, '2018-02-10 03:58:17'),
(118, 21, 1, '2018-02-10 03:58:17'),
(119, 21, 9, '2018-02-10 03:59:54'),
(120, 21, 1, '2018-02-10 03:59:54'),
(121, 21, 9, '2018-02-10 03:59:54'),
(122, 21, 1, '2018-02-10 03:59:54'),
(123, 21, 9, '2018-02-10 03:59:54'),
(124, 21, 1, '2018-02-10 03:59:54'),
(125, 21, 9, '2018-02-10 03:59:54'),
(126, 21, 1, '2018-02-10 03:59:54'),
(127, 33, 14, '2018-02-10 04:57:16'),
(128, 34, 14, '2018-02-10 04:57:21'),
(129, 35, 1, '2018-02-10 04:59:28'),
(130, 36, 1, '2018-02-10 05:00:21'),
(131, 53, 0, '2018-02-10 05:24:31'),
(132, 55, 0, '2018-02-10 05:28:42'),
(133, 56, 0, '2018-02-10 05:30:02'),
(134, 57, 9, '2018-02-10 05:30:47'),
(135, 58, 0, '2018-02-10 05:31:02'),
(136, 59, 0, '2018-02-10 05:31:34'),
(137, 60, 0, '2018-02-10 05:31:47'),
(138, 61, 0, '2018-02-10 05:32:12'),
(139, 62, 0, '2018-02-10 05:32:21'),
(140, 63, 0, '2018-02-10 05:33:56'),
(141, 64, 0, '2018-02-10 05:34:10'),
(142, 65, 0, '2018-02-10 05:36:04'),
(143, 66, 0, '2018-02-10 05:38:21'),
(144, 67, 0, '2018-02-10 05:38:32'),
(145, 68, 5, '2018-02-10 05:40:30'),
(146, 69, 0, '2018-02-10 05:42:04'),
(147, 70, 0, '2018-02-10 05:42:09'),
(148, 71, 0, '2018-02-10 05:42:30'),
(149, 72, 0, '2018-02-10 05:43:14'),
(150, 73, 0, '2018-02-10 05:44:02'),
(151, 74, 0, '2018-02-10 05:44:45'),
(152, 75, 0, '2018-02-10 05:44:59'),
(153, 76, 0, '2018-02-10 05:45:37'),
(154, 77, 0, '2018-02-10 05:46:13'),
(155, 78, 0, '2018-02-10 05:46:37'),
(156, 79, 0, '2018-02-10 05:46:46'),
(157, 80, 0, '2018-02-10 05:47:16'),
(158, 81, 0, '2018-02-10 05:52:31'),
(159, 82, 0, '2018-02-10 05:53:11'),
(160, 83, 0, '2018-02-10 05:54:56'),
(161, 84, 0, '2018-02-10 06:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `rec_project_material_plans`
--

DROP TABLE IF EXISTS `rec_project_material_plans`;
CREATE TABLE IF NOT EXISTS `rec_project_material_plans` (
  `projectmatplan_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `projectmatplan_qty` decimal(10,0) NOT NULL,
  PRIMARY KEY (`projectmatplan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_project_material_plans`
--

INSERT INTO `rec_project_material_plans` (`projectmatplan_id`, `project_id`, `material_id`, `projectmatplan_qty`) VALUES
(17, 63, 1, '11'),
(18, 64, 1, '23'),
(36, 62, 2, '11'),
(41, 1, 2, '121'),
(42, 114, 2, '1'),
(43, 115, 2, '1'),
(44, 1, 2, '1'),
(45, 2, 2, '1'),
(46, 3, 2, '1'),
(61, 1, 2, '1'),
(62, 2, 2, '1'),
(63, 3, 2, '11'),
(64, 4, 2, '1'),
(65, 4, 2, '11'),
(66, 5, 2, '1'),
(67, 5, 2, '11'),
(68, 6, 2, '11'),
(69, 7, 2, '11'),
(70, 8, 2, '1'),
(71, 9, 2, '11'),
(72, 10, 2, '0'),
(73, 11, 2, '0'),
(74, 12, 2, '11'),
(75, 13, 2, '11'),
(76, 14, 2, '0'),
(77, 15, 2, '1'),
(78, 16, 2, '1'),
(79, 17, 2, '1'),
(80, 18, 2, '0'),
(81, 19, 2, '0'),
(82, 20, 2, '11'),
(83, 21, 2, '1'),
(84, 21, 2, '11'),
(85, 22, 2, '1'),
(86, 22, 2, '11'),
(87, 23, 2, '1'),
(88, 23, 2, '11'),
(89, 24, 2, '1'),
(90, 24, 2, '11'),
(91, 25, 2, '1'),
(92, 25, 2, '11'),
(93, 26, 2, '1'),
(94, 26, 2, '11'),
(95, 27, 2, '1'),
(96, 27, 2, '11'),
(97, 28, 2, '1'),
(98, 28, 2, '11'),
(99, 29, 2, '1'),
(100, 29, 2, '11'),
(101, 30, 2, '1'),
(102, 30, 2, '11'),
(103, 31, 2, '1'),
(104, 31, 2, '11'),
(105, 32, 2, '1'),
(106, 32, 2, '11'),
(107, 0, 2, '1'),
(108, 0, 2, '11'),
(109, 0, 2, '1'),
(110, 0, 2, '11'),
(111, 0, 2, '1'),
(112, 0, 2, '11'),
(113, 0, 2, '1'),
(114, 0, 2, '11'),
(115, 0, 2, '1'),
(116, 0, 2, '11'),
(117, 0, 2, '1'),
(118, 0, 2, '11'),
(119, 0, 2, '1'),
(120, 0, 2, '11'),
(121, 21, 2, '1'),
(122, 21, 2, '11'),
(123, 21, 2, '1'),
(124, 21, 2, '11'),
(125, 21, 2, '1'),
(126, 21, 2, '11'),
(127, 21, 2, '1'),
(128, 21, 2, '11'),
(129, 21, 2, '1'),
(130, 21, 2, '11'),
(131, 21, 2, '1'),
(132, 21, 2, '11'),
(133, 21, 2, '1'),
(134, 21, 2, '11'),
(135, 33, 0, '0'),
(136, 34, 1, '0'),
(137, 35, 2, '0'),
(138, 36, 2, '0'),
(139, 53, 0, '0'),
(140, 56, 0, '0'),
(141, 57, 2, '1'),
(142, 58, 0, '0'),
(143, 59, 0, '0'),
(144, 60, 0, '0'),
(145, 61, 0, '0'),
(146, 62, 0, '0'),
(147, 63, 0, '0'),
(148, 64, 0, '0'),
(149, 65, 0, '0'),
(150, 66, 0, '0'),
(151, 67, 0, '0'),
(152, 68, 2, '0'),
(153, 69, 0, '0'),
(154, 70, 0, '0'),
(155, 71, 0, '0'),
(156, 72, 0, '0'),
(157, 73, 0, '0'),
(158, 74, 0, '0'),
(159, 75, 0, '0'),
(160, 76, 0, '0'),
(161, 77, 0, '0'),
(162, 78, 0, '0'),
(163, 79, 0, '0'),
(164, 80, 0, '0'),
(165, 81, 0, '0'),
(166, 82, 0, '0'),
(167, 83, 0, '0'),
(168, 84, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `rec_transferrals`
--

DROP TABLE IF EXISTS `rec_transferrals`;
CREATE TABLE IF NOT EXISTS `rec_transferrals` (
  `transferral_id` int(11) NOT NULL AUTO_INCREMENT,
  `transferral_projectfrom` int(11) NOT NULL,
  `transferral_projectto` int(11) NOT NULL,
  `transferral_date` datetime NOT NULL,
  `transferral_dateinserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transferral_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rec_transferred_items`
--

DROP TABLE IF EXISTS `rec_transferred_items`;
CREATE TABLE IF NOT EXISTS `rec_transferred_items` (
  `transitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `transferral_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `transitem_qty` decimal(10,0) NOT NULL,
  `transitem_price` float NOT NULL,
  `transitem_subtotal` float NOT NULL,
  `transitem_status` varchar(20) NOT NULL,
  `transitem_datetransferred` datetime NOT NULL,
  PRIMARY KEY (`transitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
