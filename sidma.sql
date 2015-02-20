-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2015 a las 05:38:39
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
`cod_academic_information` int(6) NOT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `level_course` varchar(20) DEFAULT NULL,
  `studied_before` tinyint(1) DEFAULT NULL,
  `last_school` varchar(20) DEFAULT NULL,
  `city_last_school` varchar(20) DEFAULT NULL,
  `completed_grade` varchar(20) DEFAULT NULL,
  `reason_changing_school` varchar(80) DEFAULT NULL,
  `reason_chose_school` varchar(80) DEFAULT NULL,
  `way_met_school` varchar(80) DEFAULT NULL,
  `birth_certificate` tinyint(1) DEFAULT NULL,
  `good_standing` tinyint(1) DEFAULT NULL,
  `payment_solvency` tinyint(1) DEFAULT NULL,
  `school_grades` tinyint(1) DEFAULT NULL,
  `insurance_student` tinyint(1) DEFAULT NULL,
  `tutor_compromise_signature` tinyint(1) DEFAULT NULL,
  `student_compromise_signature` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `academic_information`
--

INSERT INTO `academic_information` (`cod_academic_information`, `cod_student`, `level_course`, `studied_before`, `last_school`, `city_last_school`, `completed_grade`, `reason_changing_school`, `reason_chose_school`, `way_met_school`, `birth_certificate`, `good_standing`, `payment_solvency`, `school_grades`, `insurance_student`, `tutor_compromise_signature`, `student_compromise_signature`) VALUES
(5, 6, '1', NULL, NULL, NULL, NULL, NULL, '1,3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 7, '1', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_information`
--

CREATE TABLE IF NOT EXISTS `admin_information` (
`cod_admin_information` int(6) NOT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `whom_student_live` varchar(1) DEFAULT NULL,
  `payment_responsable` varchar(1) DEFAULT NULL,
  `payment_plan_signature` tinyint(1) DEFAULT NULL,
  `school_contract_signature` tinyint(1) DEFAULT NULL,
  `transport_take` tinyint(1) DEFAULT NULL,
  `other_tutor` varchar(100) NOT NULL,
  `other_payment_responsable` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin_information`
--

INSERT INTO `admin_information` (`cod_admin_information`, `cod_student`, `whom_student_live`, `payment_responsable`, `payment_plan_signature`, `school_contract_signature`, `transport_take`, `other_tutor`, `other_payment_responsable`) VALUES
(5, 6, '2', '4', NULL, NULL, NULL, '', ''),
(6, 7, '2', '3', NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `behavior`
--

CREATE TABLE IF NOT EXISTS `behavior` (
`cod_behavior` int(3) NOT NULL,
  `behavior_name` varchar(20) DEFAULT NULL,
  `behavior_description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`cod_class` int(10) NOT NULL,
  `cod_subject` int(2) DEFAULT NULL,
  `cod_teacher` int(6) DEFAULT NULL,
  `semester_quantity` int(2) DEFAULT NULL,
  `cod_year_grupo` int(6) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `class`
--

INSERT INTO `class` (`cod_class`, `cod_subject`, `cod_teacher`, `semester_quantity`, `cod_year_grupo`) VALUES
(2, 4, 1, 2, 1),
(3, 5, 2, 2, 1),
(4, 3, 2, 2, 2),
(5, 2, 1, 2, 2),
(6, 3, 1, 2, 1),
(7, 6, 3, 2, 2),
(8, 6, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
`cod_classroom` int(4) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `classroom_name` varchar(20) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  `capacity` int(3) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `classroom`
--

INSERT INTO `classroom` (`cod_classroom`, `create_date`, `classroom_name`, `building`, `capacity`, `description`) VALUES
(18, '2015-02-10 11:08:11', 'B4', 'Maderos', 22, 'Pabellón Central'),
(19, '2015-02-10 11:20:56', 'A2', 'Pedro Araúz', 56, 'Edificio  azul  junior'),
(20, '2015-02-10 11:21:50', 'Z21', 'Areito', 45, 'Secretaría Decanatura'),
(21, '2015-02-10 11:34:45', 'M3', 'Altamar', 47, 'Pabellón Central'),
(22, '2015-02-11 08:30:21', 'C5', 'Mendoza', 45, 'Estadio nacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concept`
--

CREATE TABLE IF NOT EXISTS `concept` (
`cod_concept` int(3) NOT NULL,
  `concept_name` varchar(20) DEFAULT NULL,
  `concept_normal_quantity` varchar(20) DEFAULT NULL,
  `normal_payment` int(5) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
`cod_discount` int(3) NOT NULL,
  `cod_concept` int(6) DEFAULT NULL,
  `discount_rate` decimal(10,0) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`cod_employee` int(6) NOT NULL,
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
  `cod_user` int(6) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`cod_employee`, `cod_employment`, `employee_photo`, `cedula`, `first_name`, `second_name`, `first_last_name`, `second_last_name`, `employee_gender`, `city_live`, `neighborhood_live`, `address_detail`, `house_number`, `phone`, `mobile`, `other_phone`, `email`, `institutional_email`, `degree`, `employee_state`, `cod_user`) VALUES
(1, 1, NULL, '001-291189-0063M', 'Eliazer', 'Antonio', 'García', 'Gallego', 0, 'Managua', 'Boér', 'Asamblea nacional 5 cuadras al oeste 20 vrs al sur', 'C25', 22223165, 88076679, 0, 'eliazer.garcia@gmail.com', '', 'Ing. Siste', '0', 74),
(4, 1, NULL, '001-231294-0045F', 'Guillermo', 'Antonio', 'Mendoza', 'Martinez', 0, 'Managua', 'Santa Ana', '', '', 0, 84568890, 0, 'gamo2015@hotmail.com', '', 'Licenciado', '0', 77),
(5, 1, NULL, '001-050789-0001R', 'Daniel', 'Josue', 'Gutierrez', 'Avilés', 0, 'Managua', 'Altagracia', 'Racachaca 2 cuadras al oeste 1cuadra al sur 1 cuadra al oeste', 'A-59', 0, 0, 0, 'dgutierrez@gmail.com', 'daniel.gutierrez@colegioangloamericano.edu.ni', '', '0', 78);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employment`
--

CREATE TABLE IF NOT EXISTS `employment` (
`cod_employment` int(6) NOT NULL,
  `employment_name` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employment`
--

INSERT INTO `employment` (`cod_employment`, `employment_name`, `description`) VALUES
(1, 'Docente', 'Docente, acceso a registro de notas, y usuario'),
(2, 'Secretaría académica', 'Control de sección académica de los estudiantes'),
(3, 'Coordinador', 'Es el coordinador'),
(4, 'Cajera', 'Caja de pagos'),
(5, 'Director', 'Es el director');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employment_information`
--

CREATE TABLE IF NOT EXISTS `employment_information` (
`cod_employment_information` int(6) NOT NULL,
  `cod_family_detail` int(6) DEFAULT NULL,
  `company_name` varchar(20) DEFAULT NULL,
  `company_owner` tinyint(1) DEFAULT NULL,
  `company_phone` int(8) DEFAULT NULL,
  `phone_extension` int(5) DEFAULT NULL,
  `company_position` varchar(20) DEFAULT NULL,
  `company_mobile` int(8) DEFAULT NULL,
  `company_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employment_information`
--

INSERT INTO `employment_information` (`cod_employment_information`, `cod_family_detail`, `company_name`, `company_owner`, `company_phone`, `phone_extension`, `company_position`, `company_mobile`, `company_email`) VALUES
(1, 2, 'INPASA', NULL, NULL, NULL, 'Empresa', NULL, 'eliazer.garciatuto@gmail.com'),
(2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'daniel@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollment`
--

CREATE TABLE IF NOT EXISTS `enrollment` (
`cod_enrollment` int(6) NOT NULL,
  `enrollment_date` int(12) DEFAULT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `enrollment_type` varchar(1) DEFAULT NULL,
  `cod_year_grupo` int(6) DEFAULT NULL,
  `enrollment_state` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`cod_event` int(3) NOT NULL,
  `event_name` varchar(20) DEFAULT NULL,
  `event_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_class`
--

CREATE TABLE IF NOT EXISTS `failed_class` (
`cod_failed_class` int(6) NOT NULL,
  `cod_note` int(10) DEFAULT NULL,
  `status_final_test` tinyint(1) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `family`
--

CREATE TABLE IF NOT EXISTS `family` (
`cod_family` int(6) NOT NULL,
  `family_identity` varchar(11) DEFAULT NULL,
  `cod_user` int(6) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `family`
--

INSERT INTO `family` (`cod_family`, `family_identity`, `cod_user`) VALUES
(6, '2015-FGG001', 82),
(7, '2015-FGG001', 83);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `family_detail`
--

CREATE TABLE IF NOT EXISTS `family_detail` (
`cod_family_detail` int(6) NOT NULL,
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
  `house_number` varchar(5) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `family_detail`
--

INSERT INTO `family_detail` (`cod_family_detail`, `cod_family`, `relationship`, `first_name`, `second_name`, `first_last_name`, `second_last_name`, `family_gender`, `phone`, `mobile`, `other_phone`, `email`, `city_live`, `neighborhood_live`, `address_detail`, `house_number`) VALUES
(2, 6, '1', 'Marcos', 'Antonio', 'Garc&iacute;a', 'Mercado', 6, 22223165, 88076679, NULL, 'eliazer.garciatuto@gmail.com', NULL, NULL, NULL, NULL),
(3, 6, '1', 'Blass', 'Del Socorro', 'Gallegos', 'Pav&oacute;n', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 7, '1', 'Chico', NULL, 'Morales', NULL, 7, NULL, NULL, NULL, 'daniel@gmail.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
`cod_grupo` int(3) NOT NULL,
  `cod_level` int(2) DEFAULT NULL,
  `grupo_name` varchar(10) DEFAULT NULL,
  `cod_classroom` int(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`cod_grupo`, `cod_level`, `grupo_name`, `cod_classroom`) VALUES
(6, 1, 'B', 18),
(7, 1, 'Z', 20),
(8, 5, 'M', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `level`
--

CREATE TABLE IF NOT EXISTS `level` (
`cod_level` int(2) NOT NULL,
  `level_name` varchar(20) DEFAULT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `level`
--

INSERT INTO `level` (`cod_level`, `level_name`, `description`) VALUES
(1, 'PK-2', 'Nivel superior'),
(3, 'PK3', 'Otrol nivel'),
(4, 'K', 'Nivel master'),
(5, '1', 'Nivel a'),
(6, '2', 'Something special');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medical_information`
--

CREATE TABLE IF NOT EXISTS `medical_information` (
`cod_medical_information` int(6) NOT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `common_allergie` varchar(50) DEFAULT NULL,
  `medicine_allergie` varchar(50) DEFAULT NULL,
  `physical_impediment` varchar(50) DEFAULT NULL,
  `permanet_illness` varchar(50) DEFAULT NULL,
  `emergency_call` int(20) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medical_information`
--

INSERT INTO `medical_information` (`cod_medical_information`, `cod_student`, `common_allergie`, `medicine_allergie`, `physical_impediment`, `permanet_illness`, `emergency_call`, `comment`) VALUES
(5, 6, NULL, 'Deasepan', NULL, NULL, NULL, NULL),
(6, 7, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `note`
--

CREATE TABLE IF NOT EXISTS `note` (
`cod_note` int(20) NOT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `cod_class` int(10) DEFAULT NULL,
  `note` int(3) DEFAULT NULL,
  `cod_period` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`cod_payment` int(20) NOT NULL,
  `cod_receipt` int(20) DEFAULT NULL,
  `cod_quota_payment` int(20) DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
`cod_payment_method` int(2) NOT NULL,
  `payment_method` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_plan`
--

CREATE TABLE IF NOT EXISTS `payment_plan` (
`cod_payment_plan` int(2) NOT NULL,
  `plan_name` varchar(20) DEFAULT NULL,
  `payment_quantity` int(2) DEFAULT NULL,
  `discount_rate` float DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `period`
--

CREATE TABLE IF NOT EXISTS `period` (
`cod_period` int(6) NOT NULL,
  `period_name` varchar(20) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `period`
--

INSERT INTO `period` (`cod_period`, `period_name`, `cod_school_year`, `date_from`, `date_to`) VALUES
(41, 'I Bimestre', 1, '2015-08-01', '2015-10-31'),
(42, 'II Bimestre', 1, '2015-11-01', '2016-01-31'),
(43, 'III Bimestre', 1, '2015-02-19', '2015-02-28'),
(44, 'IV Bimestre', 1, NULL, NULL),
(45, 'V Bimestre', 1, NULL, NULL),
(46, 'VI Bimestre', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
`cod_profile` int(3) NOT NULL,
  `profile_name` varchar(20) DEFAULT NULL,
  `privilege` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
`cod_quota_payment` int(20) NOT NULL,
  `cod_student_payment_plan` int(6) DEFAULT NULL,
  `quota` int(2) DEFAULT NULL,
  `regular_payment_date` int(12) DEFAULT NULL,
  `limit_date` int(12) DEFAULT NULL,
  `quota_amount` double DEFAULT NULL,
  `quota_payment_state` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quota_surcharge`
--

CREATE TABLE IF NOT EXISTS `quota_surcharge` (
`cod_quota_surcharge` int(10) NOT NULL,
  `cod_quota_payment` int(20) DEFAULT NULL,
  `surcharge_amount` double DEFAULT NULL,
  `limit_extra_date` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receipt`
--

CREATE TABLE IF NOT EXISTS `receipt` (
`cod_receipt` int(20) NOT NULL,
  `date_receipt` int(12) DEFAULT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `payer_name` varchar(40) DEFAULT NULL,
  `cod_payment_method` int(2) DEFAULT NULL,
  `total_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation_enrollment`
--

CREATE TABLE IF NOT EXISTS `reservation_enrollment` (
`cod_reservation_enrollment` int(6) NOT NULL,
  `cod_enrollment` int(6) DEFAULT NULL,
  `reservation_date` int(12) DEFAULT NULL,
  `limit_date` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `school_event`
--

CREATE TABLE IF NOT EXISTS `school_event` (
`cod_school_event` int(6) NOT NULL,
  `cod_event` int(6) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  `event_datetime_from` int(12) DEFAULT NULL,
  `event_datetime_to` int(12) DEFAULT NULL,
  `comment` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `school_year`
--

CREATE TABLE IF NOT EXISTS `school_year` (
`cod_school_year` int(6) NOT NULL,
  `name_school_year` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `evaluation_quantity_semester` int(2) DEFAULT NULL,
  `minimum_note` int(2) DEFAULT NULL,
  `minimum_failed_class` int(2) DEFAULT NULL,
  `surcharge_rate` int(2) DEFAULT NULL,
  `surcharge_limit_days` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `school_year`
--

INSERT INTO `school_year` (`cod_school_year`, `name_school_year`, `date_from`, `date_to`, `evaluation_quantity_semester`, `minimum_note`, `minimum_failed_class`, `surcharge_rate`, `surcharge_limit_days`) VALUES
(1, '2015-2016', '2015-08-01', '2016-06-05', 2, 60, 5, 10, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shift`
--

CREATE TABLE IF NOT EXISTS `shift` (
`cod_shift` int(2) NOT NULL,
  `shift_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `shift`
--

INSERT INTO `shift` (`cod_shift`, `shift_name`) VALUES
(1, 'Matutino'),
(2, 'Vespertino'),
(3, 'Sabatino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`cod_student` int(6) NOT NULL,
  `student_card` varchar(10) DEFAULT NULL,
  `student_photo` varchar(30) DEFAULT NULL,
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
  `cod_user` int(6) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`cod_student`, `student_card`, `student_photo`, `cod_family`, `first_name`, `second_name`, `first_last_name`, `second_last_name`, `birth_date`, `birth_country`, `birth_city`, `student_gender`, `city_live`, `neighborhood_live`, `address_detail`, `house_number`, `email`, `student_state`, `cod_user`) VALUES
(6, '2015-GG001', '', 6, 'Karen', 'Jamiilteh', 'Garc&iacute;a', 'Gallegos', 1424375080, 'Nicaragua', 'Managua', 0, 'Managua', 'Boer', 'Estadio nacional 3 cuadras al sur', 'T43', 'karenj@gmail.com', '0', 82),
(7, '2015-GG001', '', 7, 'Eliazer', 'Antonio', 'Garc&iacute;a', 'Gallegos', 1424404181, 'Nicaragua', 'Managua', 0, 'Managua', 'Boer', 'Estadio nacional', '', 'marcos@gmail.com', '0', 83);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_behavior`
--

CREATE TABLE IF NOT EXISTS `student_behavior` (
`cod_student_behavior` int(10) NOT NULL,
  `cod_behavior` int(3) DEFAULT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `behevior_date` int(12) DEFAULT NULL,
  `behavior_datetime_from` int(12) DEFAULT NULL,
  `behavior_datetime_to` int(12) DEFAULT NULL,
  `cod_period` int(6) DEFAULT NULL,
  `person_reporting` int(6) DEFAULT NULL,
  `comments` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_event`
--

CREATE TABLE IF NOT EXISTS `student_event` (
`cod_student_event` int(6) NOT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `cod_event` int(3) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL,
  `cod_teacher` int(6) DEFAULT NULL,
  `event_datetime_from` int(12) DEFAULT NULL,
  `event_datetime_to` int(12) DEFAULT NULL,
  `comment` varchar(80) DEFAULT NULL,
  `family_approve` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_off`
--

CREATE TABLE IF NOT EXISTS `student_off` (
`cod_student_off` int(6) NOT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `date_student_off` int(12) DEFAULT NULL,
  `reason_student_off` varchar(80) DEFAULT NULL,
  `next_school` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_payment_plan`
--

CREATE TABLE IF NOT EXISTS `student_payment_plan` (
`cod_student_payment_plan` int(6) NOT NULL,
  `cod_student` int(6) DEFAULT NULL,
  `cod_payment_plan` int(2) DEFAULT NULL,
  `cod_concept` int(3) DEFAULT NULL,
  `cod_discount` int(3) DEFAULT NULL,
  `cod_payment_method` int(2) DEFAULT NULL,
  `begin_payment_month` int(12) DEFAULT NULL,
  `limit_payment_days` int(2) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`cod_subject` int(2) NOT NULL,
  `subject_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`cod_subject`, `subject_name`) VALUES
(2, 'Español'),
(3, 'Inglés'),
(4, 'Matemáticas'),
(5, 'Música'),
(6, 'Ciencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
`cod_teacher` int(6) NOT NULL,
  `cod_employee` int(6) DEFAULT NULL,
  `edit_note` tinyint(1) DEFAULT NULL,
  `limit_edit_note` int(12) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `teacher`
--

INSERT INTO `teacher` (`cod_teacher`, `cod_employee`, `edit_note`, `limit_edit_note`) VALUES
(1, 1, 1, 5),
(2, 4, NULL, NULL),
(3, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`cod_user` int(6) NOT NULL,
  `user` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `cod_profile` int(3) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`cod_user`, `user`, `password`, `cod_profile`, `remember_token`) VALUES
(1, 'admin', 'admin', 1, 'ZSNghJMJZceNPxzEfpKEUhWIwPXcKFwxwRziHGYlje2hDyXaiX4wlikpE2NO'),
(74, '001-291189-0063M', 'CX1GEPC', 6, ''),
(75, '001-231294-0045F', '50LBCI2', 6, ''),
(76, '001-231294-0045F', 'OXLBQGO', 6, ''),
(77, '001-231294-0045F', '1RICE1W', 6, ''),
(78, '001-050789-0001R', 'KW5N7U0', 6, ''),
(82, '2015-GG001', 'WKCIU4B', 7, NULL),
(83, '2015-GG001', 'AHDTKV9', 7, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `year_grupo`
--

CREATE TABLE IF NOT EXISTS `year_grupo` (
`cod_year_grupo` int(10) NOT NULL,
  `cod_grupo` int(3) DEFAULT NULL,
  `cod_teacher` int(6) DEFAULT NULL,
  `cod_shift` int(2) DEFAULT NULL,
  `cod_school_year` int(6) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `year_grupo`
--

INSERT INTO `year_grupo` (`cod_year_grupo`, `cod_grupo`, `cod_teacher`, `cod_shift`, `cod_school_year`) VALUES
(1, 6, 2, 1, 1),
(2, 8, 1, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academic_information`
--
ALTER TABLE `academic_information`
 ADD PRIMARY KEY (`cod_academic_information`), ADD KEY `cod_student` (`cod_student`);

--
-- Indices de la tabla `admin_information`
--
ALTER TABLE `admin_information`
 ADD PRIMARY KEY (`cod_admin_information`), ADD KEY `cod_student` (`cod_student`);

--
-- Indices de la tabla `behavior`
--
ALTER TABLE `behavior`
 ADD PRIMARY KEY (`cod_behavior`);

--
-- Indices de la tabla `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`cod_class`), ADD KEY `cod_subject` (`cod_subject`), ADD KEY `cod_teacher` (`cod_teacher`), ADD KEY `cod_year_grupo` (`cod_year_grupo`);

--
-- Indices de la tabla `classroom`
--
ALTER TABLE `classroom`
 ADD PRIMARY KEY (`cod_classroom`);

--
-- Indices de la tabla `concept`
--
ALTER TABLE `concept`
 ADD PRIMARY KEY (`cod_concept`), ADD KEY `cod_school_year` (`cod_school_year`);

--
-- Indices de la tabla `discount`
--
ALTER TABLE `discount`
 ADD PRIMARY KEY (`cod_discount`), ADD KEY `cod_concept` (`cod_concept`), ADD KEY `cod_school_year` (`cod_school_year`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`cod_employee`), ADD KEY `cod_employment` (`cod_employment`), ADD KEY `cod_user` (`cod_user`);

--
-- Indices de la tabla `employment`
--
ALTER TABLE `employment`
 ADD PRIMARY KEY (`cod_employment`);

--
-- Indices de la tabla `employment_information`
--
ALTER TABLE `employment_information`
 ADD PRIMARY KEY (`cod_employment_information`), ADD KEY `cod_family_detail` (`cod_family_detail`);

--
-- Indices de la tabla `enrollment`
--
ALTER TABLE `enrollment`
 ADD PRIMARY KEY (`cod_enrollment`), ADD KEY `cod_year_grupo` (`cod_year_grupo`), ADD KEY `cod_student` (`cod_student`);

--
-- Indices de la tabla `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`cod_event`);

--
-- Indices de la tabla `failed_class`
--
ALTER TABLE `failed_class`
 ADD PRIMARY KEY (`cod_failed_class`), ADD KEY `cod_note` (`cod_note`), ADD KEY `cod_school_year` (`cod_school_year`);

--
-- Indices de la tabla `family`
--
ALTER TABLE `family`
 ADD PRIMARY KEY (`cod_family`), ADD KEY `cod_user` (`cod_user`);

--
-- Indices de la tabla `family_detail`
--
ALTER TABLE `family_detail`
 ADD PRIMARY KEY (`cod_family_detail`), ADD KEY `cod_family` (`cod_family`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
 ADD PRIMARY KEY (`cod_grupo`), ADD KEY `cod_level` (`cod_level`), ADD KEY `cod_classroom` (`cod_classroom`);

--
-- Indices de la tabla `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`cod_level`);

--
-- Indices de la tabla `medical_information`
--
ALTER TABLE `medical_information`
 ADD PRIMARY KEY (`cod_medical_information`), ADD KEY `cod_student` (`cod_student`);

--
-- Indices de la tabla `note`
--
ALTER TABLE `note`
 ADD PRIMARY KEY (`cod_note`), ADD KEY `cod_student` (`cod_student`), ADD KEY `cod_class` (`cod_class`), ADD KEY `cod_period` (`cod_period`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`cod_payment`), ADD KEY `cod_receipt` (`cod_receipt`), ADD KEY `cod_quota_payment` (`cod_quota_payment`);

--
-- Indices de la tabla `payment_method`
--
ALTER TABLE `payment_method`
 ADD PRIMARY KEY (`cod_payment_method`);

--
-- Indices de la tabla `payment_plan`
--
ALTER TABLE `payment_plan`
 ADD PRIMARY KEY (`cod_payment_plan`), ADD KEY `cod_school_year` (`cod_school_year`);

--
-- Indices de la tabla `period`
--
ALTER TABLE `period`
 ADD PRIMARY KEY (`cod_period`), ADD KEY `cod_school_year` (`cod_school_year`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`cod_profile`);

--
-- Indices de la tabla `quota_payment`
--
ALTER TABLE `quota_payment`
 ADD PRIMARY KEY (`cod_quota_payment`), ADD KEY `cod_student_payment_plan` (`cod_student_payment_plan`);

--
-- Indices de la tabla `quota_surcharge`
--
ALTER TABLE `quota_surcharge`
 ADD PRIMARY KEY (`cod_quota_surcharge`), ADD KEY `cod_quota_payment` (`cod_quota_payment`);

--
-- Indices de la tabla `receipt`
--
ALTER TABLE `receipt`
 ADD PRIMARY KEY (`cod_receipt`), ADD KEY `cod_student` (`cod_student`), ADD KEY `cod_payment_method` (`cod_payment_method`);

--
-- Indices de la tabla `reservation_enrollment`
--
ALTER TABLE `reservation_enrollment`
 ADD PRIMARY KEY (`cod_reservation_enrollment`), ADD KEY `cod_enrollment` (`cod_enrollment`);

--
-- Indices de la tabla `school_event`
--
ALTER TABLE `school_event`
 ADD PRIMARY KEY (`cod_school_event`), ADD KEY `cod_event` (`cod_event`), ADD KEY `cod_school_year` (`cod_school_year`);

--
-- Indices de la tabla `school_year`
--
ALTER TABLE `school_year`
 ADD PRIMARY KEY (`cod_school_year`);

--
-- Indices de la tabla `shift`
--
ALTER TABLE `shift`
 ADD PRIMARY KEY (`cod_shift`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`cod_student`), ADD KEY `cod_family` (`cod_family`), ADD KEY `cod_user` (`cod_user`);

--
-- Indices de la tabla `student_behavior`
--
ALTER TABLE `student_behavior`
 ADD PRIMARY KEY (`cod_student_behavior`), ADD KEY `cod_behavior` (`cod_behavior`), ADD KEY `cod_student` (`cod_student`), ADD KEY `person_reporting` (`person_reporting`);

--
-- Indices de la tabla `student_event`
--
ALTER TABLE `student_event`
 ADD PRIMARY KEY (`cod_student_event`), ADD KEY `cod_student` (`cod_student`), ADD KEY `cod_event` (`cod_event`), ADD KEY `cod_teacher` (`cod_teacher`);

--
-- Indices de la tabla `student_off`
--
ALTER TABLE `student_off`
 ADD PRIMARY KEY (`cod_student_off`), ADD KEY `cod_student` (`cod_student`);

--
-- Indices de la tabla `student_payment_plan`
--
ALTER TABLE `student_payment_plan`
 ADD PRIMARY KEY (`cod_student_payment_plan`), ADD KEY `cod_student` (`cod_student`), ADD KEY `cod_payment_plan` (`cod_payment_plan`), ADD KEY `cod_concept` (`cod_concept`), ADD KEY `cod_discount` (`cod_discount`), ADD KEY `cod_payment_method` (`cod_payment_method`), ADD KEY `cod_school_year` (`cod_school_year`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`cod_subject`);

--
-- Indices de la tabla `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`cod_teacher`), ADD KEY `cod_employee` (`cod_employee`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`cod_user`), ADD KEY `cod_profile` (`cod_profile`);

--
-- Indices de la tabla `year_grupo`
--
ALTER TABLE `year_grupo`
 ADD PRIMARY KEY (`cod_year_grupo`), ADD KEY `cod_grupo` (`cod_grupo`), ADD KEY `cod_teacher` (`cod_teacher`), ADD KEY `cod_shift` (`cod_shift`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academic_information`
--
ALTER TABLE `academic_information`
MODIFY `cod_academic_information` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `admin_information`
--
ALTER TABLE `admin_information`
MODIFY `cod_admin_information` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `behavior`
--
ALTER TABLE `behavior`
MODIFY `cod_behavior` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `class`
--
ALTER TABLE `class`
MODIFY `cod_class` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `classroom`
--
ALTER TABLE `classroom`
MODIFY `cod_classroom` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `concept`
--
ALTER TABLE `concept`
MODIFY `cod_concept` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `discount`
--
ALTER TABLE `discount`
MODIFY `cod_discount` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `employee`
--
ALTER TABLE `employee`
MODIFY `cod_employee` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `employment`
--
ALTER TABLE `employment`
MODIFY `cod_employment` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `employment_information`
--
ALTER TABLE `employment_information`
MODIFY `cod_employment_information` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `enrollment`
--
ALTER TABLE `enrollment`
MODIFY `cod_enrollment` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `event`
--
ALTER TABLE `event`
MODIFY `cod_event` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `failed_class`
--
ALTER TABLE `failed_class`
MODIFY `cod_failed_class` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `family`
--
ALTER TABLE `family`
MODIFY `cod_family` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `family_detail`
--
ALTER TABLE `family_detail`
MODIFY `cod_family_detail` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
MODIFY `cod_grupo` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `level`
--
ALTER TABLE `level`
MODIFY `cod_level` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `medical_information`
--
ALTER TABLE `medical_information`
MODIFY `cod_medical_information` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `note`
--
ALTER TABLE `note`
MODIFY `cod_note` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
MODIFY `cod_payment` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
MODIFY `cod_payment_method` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `payment_plan`
--
ALTER TABLE `payment_plan`
MODIFY `cod_payment_plan` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `period`
--
ALTER TABLE `period`
MODIFY `cod_period` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
MODIFY `cod_profile` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `quota_payment`
--
ALTER TABLE `quota_payment`
MODIFY `cod_quota_payment` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `quota_surcharge`
--
ALTER TABLE `quota_surcharge`
MODIFY `cod_quota_surcharge` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `receipt`
--
ALTER TABLE `receipt`
MODIFY `cod_receipt` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reservation_enrollment`
--
ALTER TABLE `reservation_enrollment`
MODIFY `cod_reservation_enrollment` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `school_event`
--
ALTER TABLE `school_event`
MODIFY `cod_school_event` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `school_year`
--
ALTER TABLE `school_year`
MODIFY `cod_school_year` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `shift`
--
ALTER TABLE `shift`
MODIFY `cod_shift` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
MODIFY `cod_student` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `student_behavior`
--
ALTER TABLE `student_behavior`
MODIFY `cod_student_behavior` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `student_event`
--
ALTER TABLE `student_event`
MODIFY `cod_student_event` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `student_off`
--
ALTER TABLE `student_off`
MODIFY `cod_student_off` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `student_payment_plan`
--
ALTER TABLE `student_payment_plan`
MODIFY `cod_student_payment_plan` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
MODIFY `cod_subject` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `teacher`
--
ALTER TABLE `teacher`
MODIFY `cod_teacher` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `cod_user` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT de la tabla `year_grupo`
--
ALTER TABLE `year_grupo`
MODIFY `cod_year_grupo` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`cod_teacher`) REFERENCES `teacher` (`cod_teacher`),
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
ADD CONSTRAINT `student_event_ibfk_3` FOREIGN KEY (`cod_teacher`) REFERENCES `teacher` (`cod_teacher`) ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
