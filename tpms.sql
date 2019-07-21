/*
SQLyog Enterprise - MySQL GUI v8.18 
MySQL - 5.6.41-84.1-log : Database - nahami_tpms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `_tbl_admin` */

DROP TABLE IF EXISTS `_tbl_admin`;

CREATE TABLE `_tbl_admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) DEFAULT NULL,
  `AdminName` varchar(255) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_admin` */

insert  into `_tbl_admin`(`AdminID`,`Username`,`UserPassword`,`AdminName`,`Created`) values ('1','admin@admin.com','password','Administrator','2018-07-02 00:00:00');

/*Table structure for table `_tbl_branches` */

DROP TABLE IF EXISTS `_tbl_branches`;

CREATE TABLE `_tbl_branches` (
  `BranchID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) DEFAULT NULL,
  `BranchCode` varchar(255) DEFAULT NULL,
  `BranchName` varchar(255) DEFAULT NULL,
  `AddressLine1` varchar(255) DEFAULT NULL,
  `AddressLine2` varchar(255) DEFAULT NULL,
  `AddressLine3` varchar(255) DEFAULT NULL,
  `PinCode` varbinary(255) DEFAULT NULL,
  `PersonName` varchar(255) DEFAULT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(255) DEFAULT NULL,
  `WhatsappNumber` varchar(255) DEFAULT NULL,
  `LandlineNumer` varchar(255) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `CreatedByID` int(11) DEFAULT '0',
  `CreatedByName` varchar(255) DEFAULT NULL,
  `IsActive` int(11) DEFAULT '1',
  PRIMARY KEY (`BranchID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_branches` */

insert  into `_tbl_branches`(`BranchID`,`Username`,`UserPassword`,`BranchCode`,`BranchName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`PinCode`,`PersonName`,`EmailID`,`MobileNumber`,`WhatsappNumber`,`LandlineNumer`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('1','branch@branch.com','password','BRN0001','Admin Branch','Chennai','','','600000','Admin Branch','adminbranch@gmail.com','9000000000',NULL,NULL,'2019-07-02 06:55:16','1','1','Administrator','1');
insert  into `_tbl_branches`(`BranchID`,`Username`,`UserPassword`,`BranchCode`,`BranchName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`PinCode`,`PersonName`,`EmailID`,`MobileNumber`,`WhatsappNumber`,`LandlineNumer`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('2','branch1@branch1.com','password','BRN0002','Branch1','Nagercoil','Kanyakumari','TamilNadu','629303','Person1','Person1@gmail.com','8531070201','8531070201','','2019-07-19 16:55:16','1','1','Administrator','0');

/*Table structure for table `_tbl_branches_accounts` */

DROP TABLE IF EXISTS `_tbl_branches_accounts`;

CREATE TABLE `_tbl_branches_accounts` (
  `BranchTxnID` int(11) NOT NULL AUTO_INCREMENT,
  `BranchID` int(11) DEFAULT NULL,
  `BranchCode` varchar(255) DEFAULT NULL,
  `BranchName` varchar(255) DEFAULT NULL,
  `InvoiceID` int(11) DEFAULT NULL,
  `InvoiceNumber` varchar(255) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CustomerCode` varchar(255) DEFAULT NULL,
  `ReceiptID` int(11) DEFAULT NULL,
  `RecepitNumber` varchar(255) DEFAULT NULL,
  `ReceviedAmount` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `PaidToAdmin` varchar(255) DEFAULT NULL,
  `Particulars` varchar(255) DEFAULT NULL,
  `ModeOfTxn` varchar(255) DEFAULT NULL,
  `BalanceAmount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`BranchTxnID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_branches_accounts` */

insert  into `_tbl_branches_accounts`(`BranchTxnID`,`BranchID`,`BranchCode`,`BranchName`,`InvoiceID`,`InvoiceNumber`,`CustomerID`,`CustomerCode`,`ReceiptID`,`RecepitNumber`,`ReceviedAmount`,`TxnDate`,`PaidToAdmin`,`Particulars`,`ModeOfTxn`,`BalanceAmount`) values ('5','1','BRN0001','Admin Branch','3','INV0002','1','','5','RPT0001','1000','2019-07-21 09:56:14','0','Amount Recevied from Customer','','-1000');
insert  into `_tbl_branches_accounts`(`BranchTxnID`,`BranchID`,`BranchCode`,`BranchName`,`InvoiceID`,`InvoiceNumber`,`CustomerID`,`CustomerCode`,`ReceiptID`,`RecepitNumber`,`ReceviedAmount`,`TxnDate`,`PaidToAdmin`,`Particulars`,`ModeOfTxn`,`BalanceAmount`) values ('6','1','BRN0001','Admin Branch','3','INV0002','1','','6','RPT0002','250','2019-07-21 11:41:51','0','Amount Recevied from Customer ','','-1250');
insert  into `_tbl_branches_accounts`(`BranchTxnID`,`BranchID`,`BranchCode`,`BranchName`,`InvoiceID`,`InvoiceNumber`,`CustomerID`,`CustomerCode`,`ReceiptID`,`RecepitNumber`,`ReceviedAmount`,`TxnDate`,`PaidToAdmin`,`Particulars`,`ModeOfTxn`,`BalanceAmount`) values ('7','1','BRN0001','Admin Branch','0','0','0','0','0','0','0','2019-07-21 15:23:31','1000','Amount Recevied from Branch ','','-250');
insert  into `_tbl_branches_accounts`(`BranchTxnID`,`BranchID`,`BranchCode`,`BranchName`,`InvoiceID`,`InvoiceNumber`,`CustomerID`,`CustomerCode`,`ReceiptID`,`RecepitNumber`,`ReceviedAmount`,`TxnDate`,`PaidToAdmin`,`Particulars`,`ModeOfTxn`,`BalanceAmount`) values ('8','1','BRN0001','Admin Branch','0','0','0','0','0','0','0','2019-07-21 15:24:37','250','Amount Recevied from Branch ','',NULL);

/*Table structure for table `_tbl_customers` */

DROP TABLE IF EXISTS `_tbl_customers`;

CREATE TABLE `_tbl_customers` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerCode` varchar(255) DEFAULT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(255) DEFAULT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `AddressLine1` varchar(255) DEFAULT NULL,
  `AddressLine2` varchar(255) DEFAULT NULL,
  `AddressLine3` varchar(255) DEFAULT NULL,
  `PinCode` varchar(255) DEFAULT NULL,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `CreatedByID` int(11) DEFAULT '0',
  `CreatedByName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_customers` */

insert  into `_tbl_customers`(`CustomerID`,`CustomerCode`,`CustomerName`,`MobileNumber`,`EmailID`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`PinCode`,`CreatedBy`,`CreatedOn`,`CreatedByID`,`CreatedByName`) values ('1','CMR0001','Kanan C','9000000009','kanan@gmail.com','Nagercoil','Kanyakumari','TamilNadu','629303','Admin','2019-07-19 11:32:02','1','Administrator');
insert  into `_tbl_customers`(`CustomerID`,`CustomerCode`,`CustomerName`,`MobileNumber`,`EmailID`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`PinCode`,`CreatedBy`,`CreatedOn`,`CreatedByID`,`CreatedByName`) values ('2','CMR0002','Lekshmi','8000000000','lekshmi@gmail.com','Ozuhinesry','vadasery','Nagercoil','623123','Admin','2019-07-19 11:33:39','1','Administrator');
insert  into `_tbl_customers`(`CustomerID`,`CustomerCode`,`CustomerName`,`MobileNumber`,`EmailID`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`PinCode`,`CreatedBy`,`CreatedOn`,`CreatedByID`,`CreatedByName`) values ('3','CMR0003','lekshmi','8000000001','lekshmi1@gmail.com','AAAAAAAA','BNNNN','NNNNNNNNN','65432','Branch','2019-07-19 21:35:11','1','Admin Branch');
insert  into `_tbl_customers`(`CustomerID`,`CustomerCode`,`CustomerName`,`MobileNumber`,`EmailID`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`PinCode`,`CreatedBy`,`CreatedOn`,`CreatedByID`,`CreatedByName`) values ('4','CMR0004','Jeya','9300000000','jeya@gmail.com','add2','add3','add4','','Branch','2019-07-20 17:03:56','0','');

/*Table structure for table `_tbl_invoices` */

DROP TABLE IF EXISTS `_tbl_invoices`;

CREATE TABLE `_tbl_invoices` (
  `InvoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderID` int(11) DEFAULT NULL,
  `OrderNumber` varchar(255) DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `InvoiceDate` datetime DEFAULT NULL,
  `InvoiceNumber` varchar(255) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(255) DEFAULT NULL,
  `AddressLine1` varchar(255) DEFAULT NULL,
  `AddressLine2` varchar(255) DEFAULT NULL,
  `AddressLine3` varchar(255) DEFAULT NULL,
  `Pincode` varchar(255) DEFAULT NULL,
  `InvoiceValue` varchar(255) DEFAULT NULL,
  `Createdon` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `BranchName` varchar(255) DEFAULT NULL,
  `PaidAmount` varchar(255) DEFAULT NULL,
  `BalanceAmount` varbinary(255) DEFAULT NULL,
  PRIMARY KEY (`InvoiceID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_invoices` */

insert  into `_tbl_invoices`(`InvoiceID`,`OrderID`,`OrderNumber`,`OrderDate`,`InvoiceDate`,`InvoiceNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`InvoiceValue`,`Createdon`,`CreatedBy`,`BranchName`,`PaidAmount`,`BalanceAmount`) values ('2','1','ODR0001','2019-07-20 15:48:41','2019-07-20 21:25:41','INV0001','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','1050','2019-07-20 21:25:41','1','Admin Branch','0','2050');
insert  into `_tbl_invoices`(`InvoiceID`,`OrderID`,`OrderNumber`,`OrderDate`,`InvoiceDate`,`InvoiceNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`InvoiceValue`,`Createdon`,`CreatedBy`,`BranchName`,`PaidAmount`,`BalanceAmount`) values ('3','3','ODR0003','2019-07-20 22:07:32','2019-07-20 22:08:59','INV0002','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','1250','2019-07-20 22:08:59','1','Admin Branch','1250','0');
insert  into `_tbl_invoices`(`InvoiceID`,`OrderID`,`OrderNumber`,`OrderDate`,`InvoiceDate`,`InvoiceNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`InvoiceValue`,`Createdon`,`CreatedBy`,`BranchName`,`PaidAmount`,`BalanceAmount`) values ('4','2','ODR0002','2019-07-20 18:13:02','2019-07-20 22:13:46','INV0003','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','2600','2019-07-20 22:13:46','1','Admin Branch','0','2600');

/*Table structure for table `_tbl_invoices_items` */

DROP TABLE IF EXISTS `_tbl_invoices_items`;

CREATE TABLE `_tbl_invoices_items` (
  `InvoiceItemID` int(11) NOT NULL AUTO_INCREMENT,
  `InvoiceID` int(11) DEFAULT NULL,
  `AddedOn` datetime DEFAULT NULL,
  `SupplierID` int(11) DEFAULT NULL,
  `SupplierCode` varchar(255) DEFAULT NULL,
  `SupplierName` varchar(255) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ProductCode` varchar(255) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `Qty` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `TAmount` varchar(255) DEFAULT NULL,
  `ServiceCharge` varchar(255) DEFAULT NULL,
  `TsAmount` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `TimeOfJourney` varchar(255) DEFAULT NULL,
  `DateOfJourney` datetime DEFAULT NULL,
  `OffRemarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`InvoiceItemID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_invoices_items` */

insert  into `_tbl_invoices_items`(`InvoiceItemID`,`InvoiceID`,`AddedOn`,`SupplierID`,`SupplierCode`,`SupplierName`,`ProductID`,`ProductCode`,`ProductName`,`Qty`,`Amount`,`TAmount`,`ServiceCharge`,`TsAmount`,`Remarks`,`TimeOfJourney`,`DateOfJourney`,`OffRemarks`) values ('1','2','2019-07-20 21:25:41','1','SPR0001','RedBus','1','PCT0001','Bus Ticket Booking','1','1000','1000','50','','Nagercoil To Chennai','11:30','2019-07-25 00:00:00','');
insert  into `_tbl_invoices_items`(`InvoiceItemID`,`InvoiceID`,`AddedOn`,`SupplierID`,`SupplierCode`,`SupplierName`,`ProductID`,`ProductCode`,`ProductName`,`Qty`,`Amount`,`TAmount`,`ServiceCharge`,`TsAmount`,`Remarks`,`TimeOfJourney`,`DateOfJourney`,`OffRemarks`) values ('2','3','2019-07-20 22:08:59','4','SPR0004','trivago','3','PCT0003','Taxi Booking','12','100','1200','50','','Nagercoil To Valioor','11:30AM','0000-00-00 00:00:00','');
insert  into `_tbl_invoices_items`(`InvoiceItemID`,`InvoiceID`,`AddedOn`,`SupplierID`,`SupplierCode`,`SupplierName`,`ProductID`,`ProductCode`,`ProductName`,`Qty`,`Amount`,`TAmount`,`ServiceCharge`,`TsAmount`,`Remarks`,`TimeOfJourney`,`DateOfJourney`,`OffRemarks`) values ('3','4','2019-07-20 22:13:46','1','SPR0001','RedBus','1','PCT0001','Bus Ticket Booking','2','1250','2500','100','','Nagercoil To Chennai','19:30 ','2019-07-30 00:00:00','Nagercoil to Chennai');

/*Table structure for table `_tbl_orders` */

DROP TABLE IF EXISTS `_tbl_orders`;

CREATE TABLE `_tbl_orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderDate` datetime DEFAULT NULL,
  `OrderNumber` varchar(255) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(255) DEFAULT NULL,
  `AddressLine1` varchar(255) DEFAULT NULL,
  `AddressLine2` varchar(255) DEFAULT NULL,
  `AddressLine3` varchar(255) DEFAULT NULL,
  `Pincode` varchar(255) DEFAULT NULL,
  `OrderValue` varchar(255) DEFAULT NULL,
  `Createdon` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `BranchName` varchar(255) DEFAULT NULL,
  `OrderedOn` datetime DEFAULT NULL,
  `OrderedBy` int(11) DEFAULT '0',
  `InvoiceID` int(11) DEFAULT '0',
  `InvoiceNumber` varbinary(255) DEFAULT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_orders` */

insert  into `_tbl_orders`(`OrderID`,`OrderDate`,`OrderNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`OrderValue`,`Createdon`,`CreatedBy`,`BranchName`,`OrderedOn`,`OrderedBy`,`InvoiceID`,`InvoiceNumber`) values ('1','2019-07-20 15:48:41','ODR0001','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','1050','2019-07-20 15:48:41','1','Admin Branch','0000-00-00 00:00:00','0','2','INV0001');
insert  into `_tbl_orders`(`OrderID`,`OrderDate`,`OrderNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`OrderValue`,`Createdon`,`CreatedBy`,`BranchName`,`OrderedOn`,`OrderedBy`,`InvoiceID`,`InvoiceNumber`) values ('2','2019-07-20 18:13:02','ODR0002','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','2600','2019-07-20 18:13:02','1','Admin Branch','0000-00-00 00:00:00','0','4','INV0003');
insert  into `_tbl_orders`(`OrderID`,`OrderDate`,`OrderNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`OrderValue`,`Createdon`,`CreatedBy`,`BranchName`,`OrderedOn`,`OrderedBy`,`InvoiceID`,`InvoiceNumber`) values ('3','2019-07-20 22:07:32','ODR0003','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','1250','2019-07-20 22:07:32','1','Admin Branch','0000-00-00 00:00:00','0','3','INV0002');
insert  into `_tbl_orders`(`OrderID`,`OrderDate`,`OrderNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`OrderValue`,`Createdon`,`CreatedBy`,`BranchName`,`OrderedOn`,`OrderedBy`,`InvoiceID`,`InvoiceNumber`) values ('4','2019-07-20 22:14:54','ODR0004','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','3050','2019-07-20 22:14:54','1','Admin Branch','0000-00-00 00:00:00','0','0','');

/*Table structure for table `_tbl_orders_items` */

DROP TABLE IF EXISTS `_tbl_orders_items`;

CREATE TABLE `_tbl_orders_items` (
  `OrderItemID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderID` int(11) DEFAULT NULL,
  `AddedOn` datetime DEFAULT NULL,
  `SupplierID` int(11) DEFAULT NULL,
  `SupplierCode` varchar(255) DEFAULT NULL,
  `SupplierName` varchar(255) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ProductCode` varchar(255) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `Qty` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `TAmount` varchar(255) DEFAULT NULL,
  `ServiceCharge` varchar(255) DEFAULT NULL,
  `TsAmount` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `TimeOfJourney` varchar(255) DEFAULT NULL,
  `DateOfJourney` datetime DEFAULT NULL,
  `OffRemarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`OrderItemID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_orders_items` */

insert  into `_tbl_orders_items`(`OrderItemID`,`OrderID`,`AddedOn`,`SupplierID`,`SupplierCode`,`SupplierName`,`ProductID`,`ProductCode`,`ProductName`,`Qty`,`Amount`,`TAmount`,`ServiceCharge`,`TsAmount`,`Remarks`,`TimeOfJourney`,`DateOfJourney`,`OffRemarks`) values ('6','3','2019-07-20 22:07:32','4','SPR0004','trivago','3','PCT0003','Taxi Booking','12','100','1200','50','1250','Nagercoil To Valioor','11:30AM','0000-00-00 00:00:00','');
insert  into `_tbl_orders_items`(`OrderItemID`,`OrderID`,`AddedOn`,`SupplierID`,`SupplierCode`,`SupplierName`,`ProductID`,`ProductCode`,`ProductName`,`Qty`,`Amount`,`TAmount`,`ServiceCharge`,`TsAmount`,`Remarks`,`TimeOfJourney`,`DateOfJourney`,`OffRemarks`) values ('7','4','2019-07-20 22:14:54','6','SPR0006','Angel Cabs','3','PCT0003','Taxi Booking','3','1000','3000','50','3050','Nagercoil To Chennai','11:30 AM','0000-00-00 00:00:00','');
insert  into `_tbl_orders_items`(`OrderItemID`,`OrderID`,`AddedOn`,`SupplierID`,`SupplierCode`,`SupplierName`,`ProductID`,`ProductCode`,`ProductName`,`Qty`,`Amount`,`TAmount`,`ServiceCharge`,`TsAmount`,`Remarks`,`TimeOfJourney`,`DateOfJourney`,`OffRemarks`) values ('5','2','2019-07-20 18:13:02','1','SPR0001','RedBus','1','PCT0001','Bus Ticket Booking','2','1250','2500','100','2600','Nagercoil To Chennai','19:30 ','2019-07-30 00:00:00','Nagercoil to Chennai');
insert  into `_tbl_orders_items`(`OrderItemID`,`OrderID`,`AddedOn`,`SupplierID`,`SupplierCode`,`SupplierName`,`ProductID`,`ProductCode`,`ProductName`,`Qty`,`Amount`,`TAmount`,`ServiceCharge`,`TsAmount`,`Remarks`,`TimeOfJourney`,`DateOfJourney`,`OffRemarks`) values ('4','1','2019-07-20 15:48:41','1','SPR0001','RedBus','1','PCT0001','Bus Ticket Booking','1','1000','1000','50','1050','Nagercoil To Chennai','11:30','2019-07-25 00:00:00','');

/*Table structure for table `_tbl_products` */

DROP TABLE IF EXISTS `_tbl_products`;

CREATE TABLE `_tbl_products` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductCode` varchar(255) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductDescription` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `CreatedByID` int(11) DEFAULT NULL,
  `CreatedByName` varchar(255) DEFAULT NULL,
  `IsActive` int(11) DEFAULT '1',
  PRIMARY KEY (`ProductID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_products` */

insert  into `_tbl_products`(`ProductID`,`ProductCode`,`ProductName`,`ProductDescription`,`Remarks`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('1','PCT0001','Bus Ticket Booking',NULL,NULL,'2019-07-19 14:33:49','Admin','1','Administrator','1');
insert  into `_tbl_products`(`ProductID`,`ProductCode`,`ProductName`,`ProductDescription`,`Remarks`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('2','PCT0002','Cabs Booking','cabsbooking','booking','2019-07-19 14:34:11','Admin','1','Administrator','1');
insert  into `_tbl_products`(`ProductID`,`ProductCode`,`ProductName`,`ProductDescription`,`Remarks`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('3','PCT0003','Taxi Booking','Cabs BookingCabs Booking','Cabs BookingCabs BookingCabs BookingCabs Booking','2019-07-20 20:02:44','Admin','1','Administrator','1');

/*Table structure for table `_tbl_receipts` */

DROP TABLE IF EXISTS `_tbl_receipts`;

CREATE TABLE `_tbl_receipts` (
  `ReceiptID` int(11) NOT NULL AUTO_INCREMENT,
  `InvoiceID` int(11) DEFAULT NULL,
  `InvoiceNumber` varchar(255) DEFAULT NULL,
  `ReceiptDate` datetime DEFAULT NULL,
  `ReceiptNumber` varchar(255) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(255) DEFAULT NULL,
  `AddressLine1` varchar(255) DEFAULT NULL,
  `AddressLine2` varchar(255) DEFAULT NULL,
  `AddressLine3` varchar(255) DEFAULT NULL,
  `Pincode` varchar(255) DEFAULT NULL,
  `ReceiptAmount` varchar(255) DEFAULT NULL,
  `Createdon` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `BranchName` varchar(255) DEFAULT NULL,
  `Remarks` varbinary(255) DEFAULT NULL,
  PRIMARY KEY (`ReceiptID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_receipts` */

insert  into `_tbl_receipts`(`ReceiptID`,`InvoiceID`,`InvoiceNumber`,`ReceiptDate`,`ReceiptNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`ReceiptAmount`,`Createdon`,`CreatedBy`,`BranchName`,`Remarks`) values ('6','3','INV0002','2019-07-21 11:41:51','RPT0002','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','250','2019-07-21 11:41:51','1','Admin Branch','');
insert  into `_tbl_receipts`(`ReceiptID`,`InvoiceID`,`InvoiceNumber`,`ReceiptDate`,`ReceiptNumber`,`CustomerID`,`CustomerName`,`EmailID`,`MobileNumber`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`ReceiptAmount`,`Createdon`,`CreatedBy`,`BranchName`,`Remarks`) values ('5','3','INV0002','2019-07-21 09:56:14','RPT0001','1','Kanan C','kanan@gmail.com','9000000009','Nagercoil','Kanyakumari','TamilNadu','629303','1000','2019-07-21 09:56:14','1','Admin Branch','');

/*Table structure for table `_tbl_suppliers` */

DROP TABLE IF EXISTS `_tbl_suppliers`;

CREATE TABLE `_tbl_suppliers` (
  `SupplierID` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierCode` varchar(255) DEFAULT NULL,
  `SupplierName` varchar(255) DEFAULT NULL,
  `SupplierDescription` varchar(255) DEFAULT NULL,
  `PersonName` varchar(255) DEFAULT NULL,
  `AddressLine1` varchar(255) DEFAULT NULL,
  `AddressLine2` varchar(255) DEFAULT NULL,
  `AddressLine3` varchar(255) DEFAULT NULL,
  `Pincode` varchar(255) DEFAULT NULL,
  `WebsiteAddress` varchar(255) DEFAULT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(255) DEFAULT NULL,
  `LandlineNumber` varchar(255) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `CreatedByID` int(11) DEFAULT '0',
  `CreatedByName` varchar(255) DEFAULT NULL,
  `IsActive` int(11) DEFAULT '1',
  PRIMARY KEY (`SupplierID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `_tbl_suppliers` */

insert  into `_tbl_suppliers`(`SupplierID`,`SupplierCode`,`SupplierName`,`SupplierDescription`,`PersonName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`WebsiteAddress`,`EmailID`,`MobileNumber`,`LandlineNumber`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('1','SPR0001','RedBus','RedBus.in for bustickets','RedBus','WSHSDVSVDBV','kjhjhsdf','ajhbduhbaf','876876','subbugfdgf.com','subbuhghg@gmail.com','8531070111',NULL,'2019-07-19 14:03:27','Admin','1','Administrator','0');
insert  into `_tbl_suppliers`(`SupplierID`,`SupplierCode`,`SupplierName`,`SupplierDescription`,`PersonName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`WebsiteAddress`,`EmailID`,`MobileNumber`,`LandlineNumber`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('2','SPR0002','Makemytrip','Makemytrip.com for flight booking',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-07-19 14:04:02','Admin','1','Administrator','1');
insert  into `_tbl_suppliers`(`SupplierID`,`SupplierCode`,`SupplierName`,`SupplierDescription`,`PersonName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`WebsiteAddress`,`EmailID`,`MobileNumber`,`LandlineNumber`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('3','SPR0003','irctc','irctc.co.in for train ticket booking',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-07-19 14:49:42','Admin','1','Administrator','1');
insert  into `_tbl_suppliers`(`SupplierID`,`SupplierCode`,`SupplierName`,`SupplierDescription`,`PersonName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`WebsiteAddress`,`EmailID`,`MobileNumber`,`LandlineNumber`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('4','SPR0004','trivago','trivago.in for hotel booking',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-07-19 14:50:14','Admin','1','Administrator','1');
insert  into `_tbl_suppliers`(`SupplierID`,`SupplierCode`,`SupplierName`,`SupplierDescription`,`PersonName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`WebsiteAddress`,`EmailID`,`MobileNumber`,`LandlineNumber`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('5','SPR0005','Neo Cars','Neo Cars - Tirunelveli  (for cars  and vans)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-07-19 14:50:47','Admin','1','Administrator','1');
insert  into `_tbl_suppliers`(`SupplierID`,`SupplierCode`,`SupplierName`,`SupplierDescription`,`PersonName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Pincode`,`WebsiteAddress`,`EmailID`,`MobileNumber`,`LandlineNumber`,`CreatedOn`,`CreatedBy`,`CreatedByID`,`CreatedByName`,`IsActive`) values ('6','SPR0006','Angel Cabs','Angel Cabs - Nagercoil  for Cars, Vans and Buses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-07-19 14:52:09','Admin','1','Administrator','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
