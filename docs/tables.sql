/*CREATE DB*/
CREATE SCHEMA FLOWERS;
ALTER SCHEMA `FLOWERS`  DEFAULT COLLATE utf8_spanish_ci ;

/*Create webuser. Modify the server if necesary*/
CREATE USER 'floresdbu'@'localhost' IDENTIFIED BY 'oscar1234';
/*Grant permission only to this DB*/
GRANT SELECT,INSERT,UPDATE ON FLOWERS.* TO 'floresdbu'@'localhost' WITH GRANT OPTION;

/*Change Table*/
USE FLOWERS;

/*TEST TABLE.*/
CREATE TABLE `TESTS` (
  `ID_TST` int(5) NOT NULL AUTO_INCREMENT,
  `VC_NME_TST` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_TST`,`VC_NME_TST`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


/*QUESTIONS TABLE
	Relationship with the test table with ID_TST field
*/


/*OPTIONS TABLE
	There is a set of options for each test. So every question in a given test will have the same set of options as answer
*/
CREATE TABLE `QUESTIONS` (
  `ID_QSTN` int(5) NOT NULL AUTO_INCREMENT,
  `VC_CPY_QSTN` varchar(255) DEFAULT NULL,
  `ID_TST` int(5) NOT NULL DEFAULT '0',
  `I_QSTN` int(5) NOT NULL DEFAULT '0',
  `ID_PRDCT` int(5) DEFAULT '0',
  `I_GRP` int(5) DEFAULT '0',
  PRIMARY KEY (`ID_QSTN`,`ID_TST`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


/*PRODUCTS TABLE
	Refers to the flower itself. Other tables have references to this one.    
*/
CREATE TABLE `PRODUCTS` (
  `ID_PRDCT` int(5) NOT NULL AUTO_INCREMENT,
  `VC_PRDCT_TTL` varchar(100) DEFAULT NULL,
  `TXT_PRDCT_DSCRPTN` text,
  `VC_FL_IMG` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_PRDCT`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


/*USERS TABLE*/
CREATE TABLE `USERS` (
  `ID_USR` int(11) NOT NULL AUTO_INCREMENT,
  `VC_EMAIL` varchar(200) NOT NULL,
  `VC_NAME` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


/*USERS RESULTS TABLE. Will save he value of the option answered by the user*/
CREATE TABLE `USER_RESULTS` (
  `ID_USR_RSLTS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USR` int(11) DEFAULT NULL,
  `ID_TST` int(5) DEFAULT NULL,
  `I_QSTN` int(11) DEFAULT NULL,
  `I_GRP` int(11) DEFAULT NULL,
  `I_VALUE` int(5) DEFAULT NULL,
  `VC_SESSION_ID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_USR_RSLTS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


