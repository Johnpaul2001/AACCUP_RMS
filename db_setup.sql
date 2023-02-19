-- CREATE database arms_final;
-- USE arms_final;

--
-- Table structure for table courses
--
CREATE TABLE areas (
  Area_Key int(10) unsigned NOT NULL auto_increment,
  Area_Code char(10) NOT NULL,
  Area_Name char(100) NOT NULL,
  Area_Desc char(255) NOT NULL,
  PRIMARY KEY  (Area_Key),
  UNIQUE KEY tbl_unique (Area_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table level_areas
--
CREATE TABLE level_areas (
  Level_Area_Key int(10) unsigned NOT NULL auto_increment,
  Area_Key int(10) NOT NULL,
  Level_Code char(10) NOT NULL,
  Level_Desc varchar(255) NOT NULL,
  PRIMARY KEY  (Level_Area_Key),
  UNIQUE KEY tbl_unique (Area_Key, Level_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table task_force
--
CREATE TABLE task_force (
  Task_Force_Key int(10) unsigned NOT NULL auto_increment,
  Area_Key int(10) NOT NULL,
  First_Name char(100) NOT NULL,
  Last_Name char(100) NOT NULL,
  Is_Coordinator int(1) NOT NULL Default 0,
  Email char(100) NOT NULL,
  User_Name char(100) NOT NULL,
  Pass_Word char(32) NOT NULL,
  PRIMARY KEY  (Task_Force_Key),
  UNIQUE KEY tbl_unique (Area_Key,User_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table parameters
--
CREATE TABLE parameters (
  Parameter_Key int(10) unsigned NOT NULL auto_increment,
  Area_Key int(10) NOT NULL,
  Parameter_Code char(1) NOT NULL,
  Parameter_Desc varchar(255) NOT NULL,
  PRIMARY KEY  (Parameter_Key),
  UNIQUE KEY tbl_unique (Area_Key, Parameter_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table indicators
--
CREATE TABLE indicators (
  Indicator_Key int(10) unsigned NOT NULL auto_increment,
  Parameter_Key int(10) NOT NULL,
  Benchmark_Code char(10) NOT NULL,
  Indicator_Code char(20) NOT NULL,
  Indicator_Desc varchar(255) NOT NULL,
  PRIMARY KEY  (Indicator_Key),
  UNIQUE KEY tbl_unique (Parameter_Key, Benchmark_Code, Indicator_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------


-- CREATE user 'bisu'@'localhost' identified by 'B!su';
-- GRANT ALL PRIVILEGES ON arms_final.* TO 'bisu'@'localhost';
-- FLUSH PRIVILEGES;