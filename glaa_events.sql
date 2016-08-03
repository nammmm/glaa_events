-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2016 at 04:54 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `glaa_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `EventID` int(10) unsigned NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text,
  `AcademicYear` char(7) NOT NULL,
  `HostID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Institutions`
--

CREATE TABLE `Institutions` (
  `InstitutionID` int(10) unsigned NOT NULL,
  `Institution` varchar(100) CHARACTER SET utf8 NOT NULL,
  `IsGLCA` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Participants`
--

CREATE TABLE `Participants` (
  `ParticipantID` int(10) unsigned NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `InstitutionID` int(10) unsigned NOT NULL,
  `Role` varchar(100) DEFAULT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Participations`
--

CREATE TABLE `Participations` (
  `ParticipantID` int(10) unsigned NOT NULL,
  `EventID` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `Constr_Events_Institution_fk` (`HostID`);

--
-- Indexes for table `Institutions`
--
ALTER TABLE `Institutions`
  ADD PRIMARY KEY (`InstitutionID`);

--
-- Indexes for table `Participants`
--
ALTER TABLE `Participants`
  ADD PRIMARY KEY (`ParticipantID`),
  ADD KEY `Constr_Participants_Institution_fk` (`InstitutionID`);

--
-- Indexes for table `Participations`
--
ALTER TABLE `Participations`
  ADD PRIMARY KEY (`ParticipantID`,`EventID`),
  ADD KEY `Constr_Participations_Event_fk` (`EventID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `EventID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Institutions`
--
ALTER TABLE `Institutions`
  MODIFY `InstitutionID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `Participants`
--
ALTER TABLE `Participants`
  MODIFY `ParticipantID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Events`
--
ALTER TABLE `Events`
  ADD CONSTRAINT `Constr_Events_Institution_fk` FOREIGN KEY (`HostID`) REFERENCES `Institutions` (`InstitutionID`);

--
-- Constraints for table `Participants`
--
ALTER TABLE `Participants`
  ADD CONSTRAINT `Constr_Participants_Institution_fk` FOREIGN KEY (`InstitutionID`) REFERENCES `Institutions` (`InstitutionID`);

--
-- Constraints for table `Participations`
--
ALTER TABLE `Participations`
  ADD CONSTRAINT `Constr_Participations_Event_fk` FOREIGN KEY (`EventID`) REFERENCES `Events` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Constr_Participations_Participant_fk` FOREIGN KEY (`ParticipantID`) REFERENCES `Participants` (`ParticipantID`) ON DELETE CASCADE ON UPDATE CASCADE;
