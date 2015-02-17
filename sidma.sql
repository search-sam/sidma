-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-06-2014 a las 00:49:01
-- Versión del servidor: 5.5.37-MariaDB
-- Versión de PHP: 5.5.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sidma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academic_information`
--

CREATE TABLE IF NOT EXISTS `academic_information` (
  `cod_academic_information` int(6) NOT NULL AUTO_INCREMENT,
  `cod_student` int(6) DEFAULT NULL,
  `level_course` varchar(20) DEFAULT NULL,
  `studied_before` tinyint(1) DEFAULT NULL,
  `last_school` varchar(20) DEFAULT NULL,
  `city_last_school` varchar(20) DEFAULT NULL,
  `completed_grade` varchar(20) DEFAULT NULL,
  `reason_changing_school` varchar(80) DEFAULT NULL,
  `reason_chose_school` varchar(80) DEFAULT NULL,
  `way_met_school` varchar(1) DEFAULT NULL,
  `birth_certificate` tinyint(1) DEFAULT NULL,
  `good_standing` tinyint(1) DEFAULT NULL,
  `payment_solvency` tinyint(1) DEFAULT NULL,
  `school_grades` tinyint(1) DEFAULT NULL,
  `insurance_student` tinyint(1) DEFAULT NULL,
  `tutor_compromise_signature` tinyint(1) DEFAULT NULL,
  `student_compromise_signature` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cod_academic_information`),
  KEY `cod_student` (`cod_student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_information`
--

CREATE TABLE IF NOT EXISTS `admin_information` (
  `cod_admin_information` int(6) NOT NULL AUTO_INCREMENT,
  `cod_student` int(6) DEFAULT NULL,
  `whom_student_live` varchar(1) DEFAULT NULL,
  `payment_responsable` varchar(1) DEFAULT NULL,
  `payment_plan_signature` tinyint(1) DEFAULT NULL,
  `school_contract_signature` tinyint(1) DEFAULT NULL,
  `transport_take` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cod_admin_information`),
  KEY `cod_student` (`cod_student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `behavior`
--

CREATE TABLE IF NOT EXISTS `behavior` (
  `cod_behavior` int(3) NOT NULL AUTO_INCREMENT,
  `behavior_name` varchar(20) DEFAULT NULL,
  `behavior_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_behavior`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `cod_class` int(10) NOT NULL AUTO_INCREMENT,
  `cod_subject` int(2) DEFAULT NULL,
  `cod_teacher` int(6) DEFAULT NULL,
  `semester_quantity` int(2) DEFAULT NULL,
  `cod_year_grupo` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_class`),
  KEY `cod_subject` (`cod_subject`),
  KEY `cod_teacher` (`cod_teacher`),
  KEY `cod_year_grupo` (`cod_year_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
  `cod_classroom` int(4) NOT NULL AUTO_INCREMENT,
  `create_date` int(12) DEFAULT NULL,
  `classroom_name` varchar(20) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `capacity` int(3) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_classroom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concept`
--

CREATE TABLE IF NOT EXISTS `concept` (
  `cod_concept` int(3) NOT NULL AUTO_INCREMENT,
  `concept_name` varchar(20) DEFAULT NULL,
  `concept_normal_quantity` varchar(20) DEFAULT NULL,
  `normal_payment` int(5) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_concept`),
  KEY `cod_school_year` (`cod_school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `cod_discount` int(3) NOT NULL AUTO_INCREMENT,
  `cod_concept` int(6) DEFAULT NULL,
  `discount_rate` decimal(10,0) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_discount`),
  KEY `cod_concept` (`cod_concept`),
  KEY `cod_school_year` (`cod_school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `cod_employee` int(6) NOT NULL AUTO_INCREMENT,
  `cod_employment` int(6) DEFAULT NULL,
  `employee_photo` varchar(30) DEFAULT NULL,
  `cedula` varchar(16) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `second_name` varchar(20) DEFAULT NULL,
  `first_last_name` varchar(20) DEFAULT NULL,
  `second_last_name` varchar(20) DEFAULT NULL,
  `employee_gender` tinyint(1) DEFAULT NULL,
  `city_live` varchar(20) DEFAULT NULL,
  `neighborhood_live` varchar(20) DEFAULT NULL,
  `address_detail` varchar(80) DEFAULT NULL,
  `house_number` varchar(5) DEFAULT NULL,
  `phone` int(8) DEFAULT NULL,
  `mobile` int(8) DEFAULT NULL,
  `other_phone` int(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `institutional_email` varchar(50) DEFAULT NULL,
  `degree` varchar(10) DEFAULT NULL,
  `employee_state` varchar(1) DEFAULT NULL,
  `cod_user` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_employee`),
  KEY `cod_employment` (`cod_employment`),
  KEY `cod_user` (`cod_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employment`
--

CREATE TABLE IF NOT EXISTS `employment` (
  `cod_employment` int(6) NOT NULL AUTO_INCREMENT,
  `employment_name` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_employment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employment_information`
--

CREATE TABLE IF NOT EXISTS `employment_information` (
  `cod_employment_information` int(6) NOT NULL AUTO_INCREMENT,
  `cod_family_detail` int(6) DEFAULT NULL,
  `company_name` varchar(20) DEFAULT NULL,
  `company_owner` tinyint(1) DEFAULT NULL,
  `company_phone` int(8) DEFAULT NULL,
  `phone_extension` int(5) DEFAULT NULL,
  `company_position` varchar(20) DEFAULT NULL,
  `company_mobile` int(8) DEFAULT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_employment_information`),
  KEY `cod_family_detail` (`cod_family_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollment`
--

CREATE TABLE IF NOT EXISTS `enrollment` (
  `cod_enrollment` int(6) NOT NULL AUTO_INCREMENT,
  `enrollment_date` int(12) DEFAULT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `enrollment_type` varchar(1) DEFAULT NULL,
  `cod_year_grupo` int(6) DEFAULT NULL,
  `enrollment_state` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`cod_enrollment`),
  KEY `cod_year_grupo` (`cod_year_grupo`),
  KEY `cod_student` (`cod_student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `cod_event` int(3) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(20) DEFAULT NULL,
  `event_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_class`
--

CREATE TABLE IF NOT EXISTS `failed_class` (
  `cod_failed_class` int(6) NOT NULL AUTO_INCREMENT,
  `cod_note` int(10) DEFAULT NULL,
  `status_final_test` tinyint(1) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_failed_class`),
  KEY `cod_note` (`cod_note`),
  KEY `cod_school_year` (`cod_school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `cod_family` int(6) NOT NULL AUTO_INCREMENT,
  `family_identity` varchar(11) DEFAULT NULL,
  `cod_user` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_family`),
  KEY `cod_user` (`cod_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `family`
--

INSERT INTO `family` (`cod_family`, `family_identity`, `cod_user`) VALUES
(1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `family_detail`
--

CREATE TABLE IF NOT EXISTS `family_detail` (
  `cod_family_detail` int(6) NOT NULL AUTO_INCREMENT,
  `cod_family` int(6) DEFAULT NULL,
  `relationship` varchar(10) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `second_name` varchar(20) DEFAULT NULL,
  `first_last_name` varchar(20) DEFAULT NULL,
  `second_last_name` varchar(20) DEFAULT NULL,
  `family_gender` tinyint(1) DEFAULT NULL,
  `phone` int(8) DEFAULT NULL,
  `mobile` int(8) DEFAULT NULL,
  `other_phone` int(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `city_live` varchar(20) DEFAULT NULL,
  `neighborhood_live` varchar(20) DEFAULT NULL,
  `address_detail` varchar(80) DEFAULT NULL,
  `house_number` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`cod_family_detail`),
  KEY `cod_family` (`cod_family`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `cod_grupo` int(3) NOT NULL AUTO_INCREMENT,
  `cod_level` int(2) DEFAULT NULL,
  `grupo_name` varchar(10) DEFAULT NULL,
  `cod_classroom` int(4) DEFAULT NULL,
  PRIMARY KEY (`cod_grupo`),
  KEY `cod_level` (`cod_level`),
  KEY `cod_classroom` (`cod_classroom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `cod_level` int(2) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cod_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `level`
--

INSERT INTO `level` (`cod_level`, `level_name`) VALUES
(1, 'PK-2'),
(2, 'PK-3'),
(3, 'K'),
(4, '1'),
(5, '2'),
(6, '3'),
(7, '4'),
(8, '5'),
(9, '6'),
(10, '7'),
(11, '8'),
(12, '9'),
(13, '10'),
(14, '11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medical_information`
--

CREATE TABLE IF NOT EXISTS `medical_information` (
  `cod_medical_information` int(6) NOT NULL AUTO_INCREMENT,
  `cod_student` int(6) DEFAULT NULL,
  `common_allergie` varchar(50) DEFAULT NULL,
  `medicine_allergie` varchar(50) DEFAULT NULL,
  `physical_impediment` varchar(50) DEFAULT NULL,
  `permanet_illness` varchar(50) DEFAULT NULL,
  `emergency_call` int(20) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_medical_information`),
  KEY `cod_student` (`cod_student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `cod_note` int(20) NOT NULL AUTO_INCREMENT,
  `cod_student` int(6) DEFAULT NULL,
  `cod_class` int(10) DEFAULT NULL,
  `note` int(3) DEFAULT NULL,
  `cod_period` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_note`),
  KEY `cod_student` (`cod_student`),
  KEY `cod_class` (`cod_class`),
  KEY `cod_period` (`cod_period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `cod_payment` int(20) NOT NULL AUTO_INCREMENT,
  `cod_receipt` int(20) DEFAULT NULL,
  `cod_quota_payment` int(20) DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`cod_payment`),
  KEY `cod_receipt` (`cod_receipt`),
  KEY `cod_quota_payment` (`cod_quota_payment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `cod_payment_method` int(2) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`cod_payment_method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_plan`
--

CREATE TABLE IF NOT EXISTS `payment_plan` (
  `cod_payment_plan` int(2) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(20) DEFAULT NULL,
  `payment_quantity` int(2) DEFAULT NULL,
  `discount_rate` float DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_payment_plan`),
  KEY `cod_school_year` (`cod_school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `period`
--

CREATE TABLE IF NOT EXISTS `period` (
  `cod_period` int(6) NOT NULL AUTO_INCREMENT,
  `period_name` varchar(20) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  `date_from` int(12) DEFAULT NULL,
  `date_to` int(12) DEFAULT NULL,
  PRIMARY KEY (`cod_period`),
  KEY `cod_school_year` (`cod_school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `cod_profile` int(3) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `privilege` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`cod_profile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`cod_profile`, `profile_name`, `privilege`) VALUES
(1, 'admin', 'crud'),
(2, 'director', 'crud'),
(3, 'secretaria', 'cru'),
(4, 'coordinador', 'crud'),
(5, 'docente guia', 'cru'),
(6, 'docente', 'cru'),
(7, 'estudiante', 'cr'),
(8, 'tutor', 'cr');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quota_payment`
--

CREATE TABLE IF NOT EXISTS `quota_payment` (
  `cod_quota_payment` int(20) NOT NULL AUTO_INCREMENT,
  `cod_student_payment_plan` int(6) DEFAULT NULL,
  `quota` int(2) DEFAULT NULL,
  `regular_payment_date` int(12) DEFAULT NULL,
  `limit_date` int(12) DEFAULT NULL,
  `quota_amount` double DEFAULT NULL,
  `quota_payment_state` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`cod_quota_payment`),
  KEY `cod_student_payment_plan` (`cod_student_payment_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quota_surcharge`
--

CREATE TABLE IF NOT EXISTS `quota_surcharge` (
  `cod_quota_surcharge` int(10) NOT NULL AUTO_INCREMENT,
  `cod_quota_payment` int(20) DEFAULT NULL,
  `surcharge_amount` double DEFAULT NULL,
  `limit_surcharge_date` int(12) DEFAULT NULL,
  `limit_extra_date` int(12) DEFAULT NULL,
  PRIMARY KEY (`cod_quota_surcharge`),
  KEY `cod_quota_payment` (`cod_quota_payment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receipt`
--

CREATE TABLE IF NOT EXISTS `receipt` (
  `cod_receipt` int(20) NOT NULL AUTO_INCREMENT,
  `date_receipt` int(12) DEFAULT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `payer_name` varchar(40) DEFAULT NULL,
  `cod_payment_method` int(2) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  PRIMARY KEY (`cod_receipt`),
  KEY `cod_student` (`cod_student`),
  KEY `cod_payment_method` (`cod_payment_method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation_enrollment`
--

CREATE TABLE IF NOT EXISTS `reservation_enrollment` (
  `cod_reservation_enrollment` int(6) NOT NULL AUTO_INCREMENT,
  `cod_enrollment` int(6) DEFAULT NULL,
  `reservation_date` int(12) DEFAULT NULL,
  `limit_date` int(12) DEFAULT NULL,
  PRIMARY KEY (`cod_reservation_enrollment`),
  KEY `cod_enrollment` (`cod_enrollment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `school_event`
--

CREATE TABLE IF NOT EXISTS `school_event` (
  `cod_school_event` int(6) NOT NULL AUTO_INCREMENT,
  `cod_event` int(6) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  `event_datetime_from` int(12) DEFAULT NULL,
  `event_datetime_to` int(12) DEFAULT NULL,
  `comment` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`cod_school_event`),
  KEY `cod_event` (`cod_event`),
  KEY `cod_school_year` (`cod_school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `school_year`
--

CREATE TABLE IF NOT EXISTS `school_year` (
  `cod_school_year` int(6) NOT NULL AUTO_INCREMENT,
  `name_school_year` varchar(20) DEFAULT NULL,
  `date_from` int(12) DEFAULT NULL,
  `date_to` int(12) DEFAULT NULL,
  `evaluation_quantity_semester` int(2) DEFAULT NULL,
  `minimum_note` int(2) DEFAULT NULL,
  `minimun_falied_class` int(2) DEFAULT NULL,
  `surcharge_rate` int(2) DEFAULT NULL,
  `surcharge_limit_days` int(2) DEFAULT NULL,
  PRIMARY KEY (`cod_school_year`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shift`
--

CREATE TABLE IF NOT EXISTS `shift` (
  `cod_shift` int(2) NOT NULL AUTO_INCREMENT,
  `shift_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`cod_shift`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO ` shift` (`cod_shift`, `shift_name`) VALUES
(1, 'Matutino'),
(2, 'Vespertino'),
(3, 'Sabatino'),
(4, 'Dominical');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `cod_student` int(6) NOT NULL AUTO_INCREMENT,
  `student_card` varchar(10) DEFAULT NULL,
  `student_photo` varchar(50) DEFAULT NULL,
  `cod_family` int(6) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `second_name` varchar(20) DEFAULT NULL,
  `first_last_name` varchar(20) DEFAULT NULL,
  `second_last_name` varchar(20) DEFAULT NULL,
  `birth_date` int(12) DEFAULT NULL,
  `birth_country` varchar(20) DEFAULT NULL,
  `birth_city` varchar(20) DEFAULT NULL,
  `student_gender` tinyint(1) DEFAULT NULL,
  `city_live` varchar(20) DEFAULT NULL,
  `neighborhood_live` varchar(20) DEFAULT NULL,
  `address_detail` varchar(80) DEFAULT NULL,
  `house_number` varchar(5) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `student_state` varchar(1) DEFAULT NULL,
  `cod_user` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_student`),
  KEY `cod_family` (`cod_family`),
  KEY `cod_user` (`cod_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`cod_student`, `student_card`, `student_photo`, `cod_family`, `first_name`, `second_name`, `first_last_name`, `second_last_name`, `birth_date`, `birth_country`, `birth_city`, `student_gender`, `city_live`, `neighborhood_live`, `address_detail`, `house_number`, `email`, `student_state`, `cod_user`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_behavior`
--

CREATE TABLE IF NOT EXISTS `student_behavior` (
  `cod_student_behavior` int(10) NOT NULL AUTO_INCREMENT,
  `cod_behavior` int(3) DEFAULT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `behevior_date` int(12) DEFAULT NULL,
  `behavior_datetime_from` int(12) DEFAULT NULL,
  `behavior_datetime_to` int(12) DEFAULT NULL,
  `cod_period` int(6) DEFAULT NULL,
  `person_reporting` int(6) DEFAULT NULL,
  `comments` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`cod_student_behavior`),
  KEY `cod_behavior` (`cod_behavior`),
  KEY `cod_student` (`cod_student`),
  KEY `person_reporting` (`person_reporting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_event`
--

CREATE TABLE IF NOT EXISTS `student_event` (
  `cod_student_event` int(6) NOT NULL AUTO_INCREMENT,
  `cod_student` int(6) DEFAULT NULL,
  `cod_event` int(3) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  `cod_teacher` int(6) DEFAULT NULL,
  `event_datetime_from` int(12) DEFAULT NULL,
  `event_datetime_to` int(12) DEFAULT NULL,
  `comment` varchar(80) DEFAULT NULL,
  `family_approve` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`cod_student_event`),
  KEY `cod_student` (`cod_student`),
  KEY `cod_event` (`cod_event`),
  KEY `cod_teacher` (`cod_teacher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_off`
--

CREATE TABLE IF NOT EXISTS `student_off` (
  `cod_student_off` int(6) NOT NULL AUTO_INCREMENT,
  `cod_student` int(6) DEFAULT NULL,
  `date_student_off` int(12) DEFAULT NULL,
  `reason_student_off` varchar(80) DEFAULT NULL,
  `next_school` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cod_student_off`),
  KEY `cod_student` (`cod_student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_payment_plan`
--

CREATE TABLE IF NOT EXISTS `student_payment_plan` (
  `cod_student_payment_plan` int(6) NOT NULL AUTO_INCREMENT,
  `cod_student` int(6) DEFAULT NULL,
  `cod_payment_plan` int(2) DEFAULT NULL,
  `cod_concept` int(3) DEFAULT NULL,
  `cod_discount` int(3) DEFAULT NULL,
  `cod_payment_method` int(2) DEFAULT NULL,
  `limit_payment_days` int(2) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_student_payment_plan`),
  KEY `cod_student` (`cod_student`),
  KEY `cod_payment_plan` (`cod_payment_plan`),
  KEY `cod_concept` (`cod_concept`),
  KEY `cod_discount` (`cod_discount`),
  KEY `cod_payment_method` (`cod_payment_method`),
  KEY `cod_school_year` (`cod_school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `cod_subject` int(2) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cod_subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `cod_user` int(6) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cod_profile` int(3) DEFAULT NULL,
  PRIMARY KEY (`cod_user`),
  KEY `cod_profile` (`cod_profile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`cod_user`, `user`, `password`, `cod_profile`) VALUES
(1, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `year_grupo`
--

CREATE TABLE IF NOT EXISTS `year_grupo` (
  `cod_year_grupo` int(10) NOT NULL AUTO_INCREMENT,
  `cod_grupo` int(3) DEFAULT NULL,
  `cod_teacher` int(6) DEFAULT NULL,
  `cod_shift` int(2) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_year_grupo`),
  KEY `cod_grupo` (`cod_grupo`),
  KEY `cod_teacher` (`cod_teacher`),
  KEY `cod_shift` (`cod_shift`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `academic_information`
--
ALTER TABLE `academic_information`
  ADD CONSTRAINT `academic_information_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `admin_information`
--
ALTER TABLE `admin_information`
  ADD CONSTRAINT `admin_information_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`cod_subject`) REFERENCES `subject` (`cod_subject`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`cod_teacher`) REFERENCES `employee` (`cod_employee`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`cod_year_grupo`) REFERENCES `year_grupo` (`cod_year_grupo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `concept`
--
ALTER TABLE `concept`
  ADD CONSTRAINT `concept_ibfk_1` FOREIGN KEY (`cod_school_year`) REFERENCES `school_year` (`cod_school_year`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`cod_concept`) REFERENCES `concept` (`cod_concept`),
  ADD CONSTRAINT `discount_ibfk_2` FOREIGN KEY (`cod_school_year`) REFERENCES `school_year` (`cod_school_year`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`cod_employment`) REFERENCES `employment` (`cod_employment`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`cod_user`) REFERENCES `user` (`cod_user`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `employment_information`
--
ALTER TABLE `employment_information`
  ADD CONSTRAINT `employment_information_ibfk_1` FOREIGN KEY (`cod_family_detail`) REFERENCES `family_detail` (`cod_family_detail`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`cod_year_grupo`) REFERENCES `year_grupo` (`cod_year_grupo`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `failed_class`
--
ALTER TABLE `failed_class`
  ADD CONSTRAINT `failed_class_ibfk_1` FOREIGN KEY (`cod_note`) REFERENCES `note` (`cod_note`),
  ADD CONSTRAINT `failed_class_ibfk_2` FOREIGN KEY (`cod_school_year`) REFERENCES `school_year` (`cod_school_year`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`cod_user`) REFERENCES `user` (`cod_user`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `family_detail`
--
ALTER TABLE `family_detail`
  ADD CONSTRAINT `family_detail_ibfk_1` FOREIGN KEY (`cod_family`) REFERENCES `family` (`cod_family`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`cod_level`) REFERENCES `level` (`cod_level`),
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`cod_classroom`) REFERENCES `classroom` (`cod_classroom`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `medical_information`
--
ALTER TABLE `medical_information`
  ADD CONSTRAINT `medical_information_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`cod_class`) REFERENCES `class` (`cod_class`),
  ADD CONSTRAINT `note_ibfk_3` FOREIGN KEY (`cod_period`) REFERENCES `period` (`cod_period`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`cod_receipt`) REFERENCES `receipt` (`cod_receipt`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`cod_quota_payment`) REFERENCES `quota_payment` (`cod_quota_payment`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `payment_plan`
--
ALTER TABLE `payment_plan`
  ADD CONSTRAINT `payment_plan_ibfk_1` FOREIGN KEY (`cod_school_year`) REFERENCES `school_year` (`cod_school_year`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `period`
--
ALTER TABLE `period`
  ADD CONSTRAINT `period_ibfk_1` FOREIGN KEY (`cod_school_year`) REFERENCES `school_year` (`cod_school_year`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `quota_payment`
--
ALTER TABLE `quota_payment`
  ADD CONSTRAINT `quota_payment_ibfk_1` FOREIGN KEY (`cod_student_payment_plan`) REFERENCES `student_payment_plan` (`cod_student_payment_plan`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `quota_surcharge`
--
ALTER TABLE `quota_surcharge`
  ADD CONSTRAINT `quota_surcharge_ibfk_1` FOREIGN KEY (`cod_quota_payment`) REFERENCES `quota_payment` (`cod_quota_payment`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`cod_payment_method`) REFERENCES `payment_method` (`cod_payment_method`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservation_enrollment`
--
ALTER TABLE `reservation_enrollment`
  ADD CONSTRAINT `reservation_enrollment_ibfk_1` FOREIGN KEY (`cod_enrollment`) REFERENCES `enrollment` (`cod_enrollment`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `school_event`
--
ALTER TABLE `school_event`
  ADD CONSTRAINT `school_event_ibfk_1` FOREIGN KEY (`cod_event`) REFERENCES `event` (`cod_event`),
  ADD CONSTRAINT `school_event_ibfk_2` FOREIGN KEY (`cod_school_year`) REFERENCES `school_year` (`cod_school_year`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`cod_family`) REFERENCES `family` (`cod_family`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`cod_user`) REFERENCES `user` (`cod_user`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `student_behavior`
--
ALTER TABLE `student_behavior`
  ADD CONSTRAINT `student_behavior_ibfk_1` FOREIGN KEY (`cod_behavior`) REFERENCES `behavior` (`cod_behavior`),
  ADD CONSTRAINT `student_behavior_ibfk_2` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`),
  ADD CONSTRAINT `student_behavior_ibfk_3` FOREIGN KEY (`person_reporting`) REFERENCES `employee` (`cod_employee`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `student_event`
--
ALTER TABLE `student_event`
  ADD CONSTRAINT `student_event_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`),
  ADD CONSTRAINT `student_event_ibfk_2` FOREIGN KEY (`cod_event`) REFERENCES `event` (`cod_event`),
  ADD CONSTRAINT `student_event_ibfk_3` FOREIGN KEY (`cod_teacher`) REFERENCES `employee` (`cod_employee`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `student_off`
--
ALTER TABLE `student_off`
  ADD CONSTRAINT `student_off_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `student_payment_plan`
--
ALTER TABLE `student_payment_plan`
  ADD CONSTRAINT `student_payment_plan_ibfk_1` FOREIGN KEY (`cod_student`) REFERENCES `student` (`cod_student`),
  ADD CONSTRAINT `student_payment_plan_ibfk_2` FOREIGN KEY (`cod_payment_plan`) REFERENCES `payment_plan` (`cod_payment_plan`),
  ADD CONSTRAINT `student_payment_plan_ibfk_3` FOREIGN KEY (`cod_concept`) REFERENCES `concept` (`cod_concept`),
  ADD CONSTRAINT `student_payment_plan_ibfk_4` FOREIGN KEY (`cod_discount`) REFERENCES `discount` (`cod_discount`),
  ADD CONSTRAINT `student_payment_plan_ibfk_5` FOREIGN KEY (`cod_payment_method`) REFERENCES `payment_method` (`cod_payment_method`),
  ADD CONSTRAINT `student_payment_plan_ibfk_6` FOREIGN KEY (`cod_school_year`) REFERENCES `school_year` (`cod_school_year`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`cod_profile`) REFERENCES `profile` (`cod_profile`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `year_grupo`
--
ALTER TABLE `year_grupo`
  ADD CONSTRAINT `year_grupo_ibfk_1` FOREIGN KEY (`cod_grupo`) REFERENCES `grupo` (`cod_grupo`),
  ADD CONSTRAINT `year_grupo_ibfk_2` FOREIGN KEY (`cod_teacher`) REFERENCES `employee` (`cod_employee`),
  ADD CONSTRAINT `year_grupo_ibfk_3` FOREIGN KEY (`cod_shift`) REFERENCES `shift` (`cod_shift`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
