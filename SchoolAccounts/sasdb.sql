-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 01:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sasdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegisterDate` varchar(255) NOT NULL,
  `AcademyCode` varchar(255) NOT NULL,
  `AcademyStatus` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `Name`, `Email`, `Phone`, `Password`, `RegisterDate`, `AcademyCode`, `AcademyStatus`, `created_at`, `updated_at`) VALUES
(1, 'smart school', 'admin@gmail.com', '+923147828465', '12345', '2024-05-22', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '1', '2024-05-22 05:39:10', '2024-05-22 05:39:10'),
(2, 'City', 'city@gmail.com', '542154051', '12345', '2024-06-06', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN8', '1', '2024-06-05 21:19:08', '2024-06-05 21:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `admit_students`
--

CREATE TABLE `admit_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `SName` varchar(255) NOT NULL,
  `SGender` varchar(255) NOT NULL,
  `SDOB` varchar(255) NOT NULL,
  `SImage` varchar(255) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `FCard` varchar(255) NOT NULL,
  `FEmail` varchar(255) NOT NULL,
  `FPhone` varchar(255) NOT NULL,
  `MPhone` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `HomeAddress` longtext NOT NULL,
  `MonthlyFee` varchar(255) NOT NULL,
  `IsDiscountedStudent` varchar(255) NOT NULL,
  `WelcomeSmsAlert` varchar(255) NOT NULL,
  `GererateAdmissionFee` varchar(255) NOT NULL,
  `ClassID` bigint(20) UNSIGNED NOT NULL,
  `AdmissionDate` varchar(255) NOT NULL,
  `StudentType` varchar(255) NOT NULL DEFAULT '1',
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admit_students`
--

INSERT INTO `admit_students` (`id`, `SName`, `SGender`, `SDOB`, `SImage`, `FName`, `FCard`, `FEmail`, `FPhone`, `MPhone`, `Religion`, `HomeAddress`, `MonthlyFee`, `IsDiscountedStudent`, `WelcomeSmsAlert`, `GererateAdmissionFee`, `ClassID`, `AdmissionDate`, `StudentType`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(1, 'Abdullah khan', 'Male', '2024-05-15', '1716370201.jpg', 'Abdul Waqar Khan', '413024545454848', 'Father@gmail.com', '+923147828465', '+923147827845', 'Islam', 'bismillah city', '2', 'No', 'No', 'Yes', 1, '2024-05-17', '1', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'CVTt31', '2024-05-22 04:30:01', '2024-05-27 14:22:50'),
(2, 'Rafi khan', 'Male', '2005-03-04', '1716814383.jpg', 'Abdul Waqar Khan', '413024545454848', 'Father@gmail.com', '+923147828465', '+923147828466', 'Islam', 'bismillah city', '2', 'Yes', 'No', 'Yes', 1, '2024-05-27', '1', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'RCShWk', '2024-05-27 07:53:03', '2024-05-27 07:53:03'),
(3, 'Ali khan', 'Male', '2005-03-27', '1716814451.jpg', 'Abdul Waqar Khan', '413024545454848', 'Ali_Father@gmail.com', '+923472680135', '+923147828466', 'Islam', 'bismillah city', '2', 'Yes', 'No', 'No', 1, '2024-05-28', '1', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'ztw76S', '2024-05-27 07:54:11', '2024-05-27 07:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `assets_categories`
--

CREATE TABLE `assets_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CreateDate` varchar(255) NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets_categories`
--

INSERT INTO `assets_categories` (`id`, `CategoryName`, `CreateDate`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(1, 'Current Assets', '2024-06-01', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'S958RetnYanNfnEYIJsLz0aATJi93mFrAsp2J1lwAMLvGvo4cA', NULL, '2024-06-01 18:23:32'),
(3, 'Non-Current', '2024-06-01', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '17HlC4tAAyj8M17ODCnGPRTyyxDFnpTeW1zs4PZmCANqmMgYuy', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `BankName` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `BranchCode` varchar(255) NOT NULL,
  `AccountNumber` varchar(255) NOT NULL,
  `IBANNumber` varchar(255) NOT NULL DEFAULT '0',
  `AccountType` varchar(255) NOT NULL,
  `Balance` varchar(255) NOT NULL,
  `Description` longtext NOT NULL,
  `Date` varchar(255) NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `BankName`, `Title`, `BranchCode`, `AccountNumber`, `IBANNumber`, `AccountType`, `Balance`, `Description`, `Date`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(1, 'Meezan Bank', 'Abdullah khan', '0100', '051245154545484', '0', 'Capital', '100000', 'best', '2024-05-23', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'AeuQIXj2LwTrnaaFq9ZuhyXXX12lBtcaysiR3SpUWYaVvjjjdJ', '2024-05-23 05:29:05', '2024-06-20 18:17:25'),
(2, 'Allied Bank', 'Abdullah khan', '1065', '4540046454', '0541684181405164', 'FixedAssets', '100000', 'Expense Account', '2024-05-28', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '6cjGfXmDlvFQXpw1FwCsrDJtq9t3v0LRxRhIy32TqoZZs0SCYJ', '2024-05-28 17:26:50', '2024-06-06 19:00:32'),
(3, 'Easy Paisa', 'Ferzan Ahmed', '0100', '03356555356', 'PK90052414124NCKJN6', 'CurrentAccount', '16000', 'K', '2024-06-07', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'fqOFhy2gHNTYY266MPgSBO0JmEnyqljCaqslRWk3HG7yrCm85A', '2024-06-07 12:58:15', '2024-06-07 12:58:15'),
(4, 'Metro Bank', 'Ali khan', '054121', '201540117541', 'cs1w5d8wx74w6cf51401', 'SavingAccount', '6000', '.', '2024-06-12', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'Si5kjR1YnNPtv5CaaaagoylKWSbLMnbq6VlqQIBYe0jUnbAytZ', '2024-06-12 17:43:04', '2024-06-12 17:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expence_categories`
--

CREATE TABLE `expence_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CreateDate` varchar(255) NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expence_categories`
--

INSERT INTO `expence_categories` (`id`, `CategoryName`, `CreateDate`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(10, 'Account Payable', '2024-06-01', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 't2x6LHMIDo4UAC9WhM398PmxAQq41pAMQCiPvkLLlq4AbX4jRj', NULL, '2024-06-06 18:32:59'),
(11, 'Loan Payable', '2024-06-06', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '9NGnI0wcAOR4QUiiEIM3lacrsAPzXbQ1xKFzmo6kCr3q19Zv6V', NULL, '2024-06-06 18:33:13'),
(13, 'Other Liabilities', '2024-06-07', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '0sMGLqbOjB18yI3yH6F0htk0iiHzDRBmuHctOSUn0aRNhvXd50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_categories`
--

CREATE TABLE `fees_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `PaymentType` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Description` longtext NOT NULL,
  `Date` varchar(255) NOT NULL,
  `ClassID` bigint(20) UNSIGNED NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees_categories`
--

INSERT INTO `fees_categories` (`id`, `Title`, `PaymentType`, `Amount`, `Description`, `Date`, `ClassID`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(2, 'Monthly Fees', 'Cash', '1500', 'This is students monthly fees', '2024-05-23', 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'kEAi6bxnFbpJX9KJW7pwMqAuDAYc5xDoxOemqPb9s7MzfaHPtT', '2024-05-23 17:40:09', '2024-05-23 17:57:04'),
(3, 'Exam Fees', 'Cash', '2000', 'This is exam fees for all class 1 students', '2024-05-25', 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'WdYcuZzQl5jyk5GKVKM7VNokibmbZiaJPeRUTQgy64yV8FQaN3', '2024-05-25 04:22:56', '2024-05-25 04:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_assets`
--

CREATE TABLE `manage_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Description` longtext NOT NULL,
  `AssetID` bigint(20) UNSIGNED NOT NULL,
  `BankID` bigint(20) UNSIGNED NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_assets`
--

INSERT INTO `manage_assets` (`id`, `Date`, `Amount`, `Description`, `AssetID`, `BankID`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(2, '2024-06-02', '25000', 'knkcn', 1, 2, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'Dni6lO3grJ6e6m8UmLrn7ADcFFtxFz8VvGiDhe4Cuu5aoKxNWz', '2024-06-01 18:37:54', '2024-06-07 17:00:47'),
(3, '2024-05-27', '1200', 'mcks', 3, 2, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'ML5JWwsVf859mwsP6RpNkgC7Vths7us5es7ya96nQ0Iz2yHjoD', '2024-06-01 18:45:56', '2024-06-07 17:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `manage_expenses`
--

CREATE TABLE `manage_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Description` longtext NOT NULL,
  `ExpenseID` bigint(20) UNSIGNED NOT NULL,
  `BankID` bigint(20) UNSIGNED NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_expenses`
--

INSERT INTO `manage_expenses` (`id`, `Date`, `Amount`, `Description`, `ExpenseID`, `BankID`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(6, '2022-06-01', '200', 'k', 10, 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'rB9A2mqemKuhx42qXKxQ07BgG8D1eTWw4bQkJUSZG0yNBsFD24', '2024-06-01 19:04:48', '2024-06-01 19:09:01'),
(8, '2024-06-06', '25000', 'abc', 11, 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'ftRKXQnkK6xWjNeBd5uqQGr9IkP4KHIwM223rbADCHt0wiaPc9', '2024-06-06 11:14:15', '2024-06-06 11:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `manage_salaries`
--

CREATE TABLE `manage_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Date` varchar(255) NOT NULL,
  `EmployeeID` bigint(20) UNSIGNED NOT NULL,
  `ExpenseID` bigint(20) UNSIGNED NOT NULL,
  `BankID` bigint(20) UNSIGNED NOT NULL,
  `Salary` varchar(255) NOT NULL,
  `Allowances` varchar(255) NOT NULL,
  `NetSalary` varchar(255) NOT NULL,
  `Deductions` varchar(255) NOT NULL,
  `TotalSalary` varchar(255) NOT NULL,
  `Description` longtext NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_salaries`
--

INSERT INTO `manage_salaries` (`id`, `Date`, `EmployeeID`, `ExpenseID`, `BankID`, `Salary`, `Allowances`, `NetSalary`, `Deductions`, `TotalSalary`, `Description`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(2, '2024-06-22', 1, 1, 1, '15000', '1501', '16501', '0', '16501', 'Net Describe', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'CDCnWepgXFE3HNVDcznvFDHjOLqkjuBimiRE52FrmuBri1C7V5', '2024-06-21 18:26:37', '2024-06-21 18:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `manage_utlity_expenses`
--

CREATE TABLE `manage_utlity_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `Description` longtext NOT NULL,
  `ExpenseID` bigint(20) UNSIGNED NOT NULL,
  `BankID` bigint(20) UNSIGNED NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_utlity_expenses`
--

INSERT INTO `manage_utlity_expenses` (`id`, `Date`, `Amount`, `Description`, `ExpenseID`, `BankID`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(1, '2024-06-06', '1500', 'testing', 4, 2, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'tL6rCikqNzC9pab9PROgPMyXoTibxaOnq1wEUBTkzxZZQa459D', '2024-06-06 17:29:06', '2024-06-07 16:23:14'),
(4, '2024-05-27', '2000', 'jerkjrjroei', 4, 3, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'Tap1YCeH13jmPXtW6o6MTz3RNGzRNBIibPPHwb4kHlIsl6Vbij', '2024-06-07 13:00:33', '2024-06-07 13:00:33'),
(5, '2024-06-09', '15000', 'elecricty bill', 3, 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'DMOHarky6uJqL3VHjDX4DVYZGqa3CDy6C9ERGRVKu4yUiUgvsK', '2024-06-09 09:28:49', '2024-06-21 16:40:24'),
(6, '2024-06-09', '2500', '.', 5, 2, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '19wUa2E4oJ4i9ubonN65uQ6idljsbecpYJLMFiSDX3rgLwiauc', '2024-06-09 10:17:14', '2024-06-09 10:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_22_053325_create_admins_table', 2),
(5, '2024_05_22_053805_create_admins_table', 3),
(6, '2024_05_22_055713_create_s_classes_table', 4),
(7, '2024_05_22_061258_create_admit_students_table', 5),
(8, '2024_05_22_092519_create_admit_students_table', 6),
(9, '2024_05_22_093243_create_expence_categories_table', 7),
(10, '2024_05_22_104146_create_bank_accounts_table', 8),
(11, '2024_05_23_093906_create_bank_accounts_table', 9),
(12, '2024_05_23_095243_create_bank_accounts_table', 10),
(13, '2024_05_23_105721_create_manage_expenses_table', 11),
(14, '2024_05_23_110718_create_manage_expenses_table', 12),
(15, '2024_05_23_110816_create_manage_expenses_table', 13),
(16, '2024_05_23_221007_create_fees_categories_table', 14),
(17, '2024_05_23_230500_create_staff_accounts_table', 15),
(18, '2024_05_27_121313_create_payment_records_table', 16),
(19, '2024_05_27_165058_create_payment_records_table', 17),
(20, '2024_05_28_170703_create_payment_records_table', 18),
(21, '2024_05_30_180635_create_staff_accounts_table', 19),
(22, '2024_05_30_195739_create_manage_salaries_table', 20),
(23, '2024_05_30_213008_create_manage_salaries_table', 21),
(24, '2024_06_01_230841_create_assets_categories_table', 22),
(25, '2024_06_01_233212_create_manage_assets_table', 23),
(26, '2024_06_05_200004_create_super_admins_table', 24),
(27, '2024_06_06_215438_create_utlity_expense_categories_table', 25),
(28, '2024_06_06_222432_create_manage_utlity_expenses_table', 26),
(29, '2024_06_06_222803_create_manage_utlity_expenses_table', 27),
(30, '2024_06_06_234207_create_manage_salaries_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE `payment_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `PaymentID` bigint(20) UNSIGNED NOT NULL,
  `StudentID` bigint(20) UNSIGNED NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `BankID` bigint(20) UNSIGNED DEFAULT NULL,
  `AmtPaid` varchar(255) NOT NULL,
  `Balance` varchar(255) NOT NULL,
  `Paid` varchar(255) NOT NULL DEFAULT '0',
  `Year` varchar(255) NOT NULL,
  `FeeMonth` varchar(255) NOT NULL,
  `FeeMonthName` varchar(255) NOT NULL,
  `FeeAssignDate` varchar(255) NOT NULL,
  `FeeExpDate` varchar(255) NOT NULL,
  `IsLate` int(11) NOT NULL DEFAULT 0,
  `PaidStatus` int(11) NOT NULL DEFAULT 0,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_records`
--

INSERT INTO `payment_records` (`id`, `PaymentID`, `StudentID`, `PaymentMethod`, `BankID`, `AmtPaid`, `Balance`, `Paid`, `Year`, `FeeMonth`, `FeeMonthName`, `FeeAssignDate`, `FeeExpDate`, `IsLate`, `PaidStatus`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'Cash', NULL, '1500', '0', '1500', '2024', '6', 'May', '1', '2024-06-07', 1, 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'xXVR99', '2024-06-01 12:18:27', '2024-06-07 17:24:19'),
(5, 2, 2, 'Cash', NULL, '1500', '1000', '500', '2024', '6', 'May', '1', '2024-06-07', 0, 2, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'GgOZQ9', '2024-06-02 12:18:27', '2024-05-28 14:41:06'),
(6, 2, 3, 'Cash', NULL, '1500', '0', '0', '2024', '6', 'May', '3', '2024-06-07', 0, 0, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'RO8N3i', '2024-06-02 12:18:27', '2024-05-28 12:18:27'),
(7, 3, 1, 'Cash', NULL, '2000', '0', '500', '2024', '6', 'May', '3', '2024-06-07', 0, 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '5Hkthv', '2024-05-28 12:18:35', '2024-05-28 12:18:35'),
(8, 3, 2, 'Online', 1, '2000', '0', '2000', '2024', '6', 'May', '2', '2024-06-07', 0, 1, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'tdcxwu', '2024-05-28 12:18:35', '2024-05-28 14:46:56'),
(9, 3, 3, 'Cash', NULL, '2000', '0', '0', '2024', '6', 'May', '2', '2024-06-07', 0, 0, '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'dHhSgq', '2024-05-28 12:18:35', '2024-05-28 12:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Qc6TnUkERr4oLVPczbOVSMUJVWZ9Y3AD7LbFutcm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWQ2Tm9nSGVsSDFjcUF3T2NjaFhvQlFVMW81MDc0cW5XTmttU21RNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMToiQWNhZGVteUNvZGUiO3M6NTA6IjdxdDBSNm00TXhhRjZ0ZEpYSXZiNnB5dlhoSzd6TG1wRnJwNUZOODZzZm4xcXNJejFYIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL0luY29tZV9Mb3NzX1N0YXRlbWVudHMiO319', 1719013097);

-- --------------------------------------------------------

--
-- Table structure for table `staff_accounts`
--

CREATE TABLE `staff_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `AccountType` varchar(255) NOT NULL,
  `Salary` varchar(255) NOT NULL,
  `Allowances` varchar(255) NOT NULL DEFAULT '0',
  `Deductions` varchar(255) NOT NULL DEFAULT '0',
  `CanAdd` varchar(255) NOT NULL,
  `CanEdit` varchar(255) NOT NULL,
  `CanDrop` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL DEFAULT '12345',
  `Status` varchar(255) NOT NULL DEFAULT '0',
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_accounts`
--

INSERT INTO `staff_accounts` (`id`, `Name`, `Email`, `Phone`, `Image`, `AccountType`, `Salary`, `Allowances`, `Deductions`, `CanAdd`, `CanEdit`, `CanDrop`, `Password`, `Status`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(1, 'rafil', 'rafil@gmail.com', '+92314782684', '1717093100.jpg', 'Accountant', '15000', '1501', '1501', 'Yes', 'Yes', 'No', '12345', '1', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'WPKlUt', '2024-05-30 13:18:20', '2024-05-30 13:20:00'),
(2, 'Abkhan Teacher', 'teacher@gmail.com', '+923147824371', '1717093447.jpg', 'Teacher', '25000', '2000', '2000', 'Yes', 'Yes', 'No', '12345', '1', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'rx7NuU', '2024-04-30 13:24:07', '2024-05-30 13:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegisterDate` varchar(255) NOT NULL,
  `AccountCode` varchar(255) NOT NULL,
  `AccountStatus` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`id`, `Name`, `Email`, `Phone`, `Password`, `RegisterDate`, `AccountCode`, `AccountStatus`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', '+0454141878', '12345', '2024-06-06', 'ncsjhqw7c78s67w', '1', '2024-06-05 20:01:01', '2024-06-05 20:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `s_classes`
--

CREATE TABLE `s_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Class` varchar(255) NOT NULL,
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s_classes`
--

INSERT INTO `s_classes` (`id`, `Class`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(1, '1', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', '6iDyif0oSGVxOFi3SsZrMyBtDNQhAad617R6GxVruCDshihrLH', NULL, '2024-05-22 01:04:36'),
(5, '2', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'BxsEyxsEple9wywdbPi9wfHdroizPIsIpnxOOwZ6GMUMdsWFUu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utlity_expense_categories`
--

CREATE TABLE `utlity_expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CreateDate` varchar(255) NOT NULL,
  `AdminStatus` varchar(255) NOT NULL DEFAULT '0',
  `AcademyCode` varchar(255) NOT NULL,
  `UniqueCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utlity_expense_categories`
--

INSERT INTO `utlity_expense_categories` (`id`, `CategoryName`, `CreateDate`, `AdminStatus`, `AcademyCode`, `UniqueCode`, `created_at`, `updated_at`) VALUES
(1, 'Salary', '2024-06-06', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'g3fxnarPTZvE1o1jqKeR10BVASRKAyXdZEIQqMQBjs1SfqSma9', NULL, '2024-06-06 17:14:49'),
(3, 'Electricity Bill', '2024-06-06', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'BczkAIPSIu8kzA3RTVPDNBPw9IrZak669TyDewSiai2MnFhW1r', NULL, NULL),
(4, 'Supplies Expense', '2024-06-07', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'fTjRqrxNzxASHjVF8xzCAGqP6iW7vXZeUdXlBih5LcZvMbNjbc', NULL, NULL),
(5, 'Rent Expense', '2024-06-09', '0', '7qt0R6m4MxaF6tdJXIvb6pyvXhK7zLmpFrp5FN86sfn1qsIz1X', 'HodA7K5dYWszHEuGf7m9ZWYj2M2GqIYqek2vYv5Yo49Mm1gwmC', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admit_students`
--
ALTER TABLE `admit_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admit_students_classid_foreign` (`ClassID`);

--
-- Indexes for table `assets_categories`
--
ALTER TABLE `assets_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `expence_categories`
--
ALTER TABLE `expence_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fees_categories`
--
ALTER TABLE `fees_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_categories_classid_foreign` (`ClassID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_assets`
--
ALTER TABLE `manage_assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manage_assets_assetid_foreign` (`AssetID`),
  ADD KEY `manage_assets_bankid_foreign` (`BankID`);

--
-- Indexes for table `manage_expenses`
--
ALTER TABLE `manage_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manage_expenses_expenseid_foreign` (`ExpenseID`),
  ADD KEY `manage_expenses_bankid_foreign` (`BankID`);

--
-- Indexes for table `manage_salaries`
--
ALTER TABLE `manage_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manage_salaries_employeeid_foreign` (`EmployeeID`),
  ADD KEY `manage_salaries_expenseid_foreign` (`ExpenseID`),
  ADD KEY `manage_salaries_bankid_foreign` (`BankID`);

--
-- Indexes for table `manage_utlity_expenses`
--
ALTER TABLE `manage_utlity_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manage_utlity_expenses_expenseid_foreign` (`ExpenseID`),
  ADD KEY `manage_utlity_expenses_bankid_foreign` (`BankID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_records_paymentid_foreign` (`PaymentID`),
  ADD KEY `payment_records_studentid_foreign` (`StudentID`),
  ADD KEY `payment_records_bankid_foreign` (`BankID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff_accounts`
--
ALTER TABLE `staff_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_classes`
--
ALTER TABLE `s_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `utlity_expense_categories`
--
ALTER TABLE `utlity_expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admit_students`
--
ALTER TABLE `admit_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assets_categories`
--
ALTER TABLE `assets_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expence_categories`
--
ALTER TABLE `expence_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_categories`
--
ALTER TABLE `fees_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_assets`
--
ALTER TABLE `manage_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage_expenses`
--
ALTER TABLE `manage_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manage_salaries`
--
ALTER TABLE `manage_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manage_utlity_expenses`
--
ALTER TABLE `manage_utlity_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payment_records`
--
ALTER TABLE `payment_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff_accounts`
--
ALTER TABLE `staff_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `s_classes`
--
ALTER TABLE `s_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utlity_expense_categories`
--
ALTER TABLE `utlity_expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admit_students`
--
ALTER TABLE `admit_students`
  ADD CONSTRAINT `admit_students_classid_foreign` FOREIGN KEY (`ClassID`) REFERENCES `s_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fees_categories`
--
ALTER TABLE `fees_categories`
  ADD CONSTRAINT `fees_categories_classid_foreign` FOREIGN KEY (`ClassID`) REFERENCES `s_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_assets`
--
ALTER TABLE `manage_assets`
  ADD CONSTRAINT `manage_assets_assetid_foreign` FOREIGN KEY (`AssetID`) REFERENCES `assets_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_assets_bankid_foreign` FOREIGN KEY (`BankID`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_expenses`
--
ALTER TABLE `manage_expenses`
  ADD CONSTRAINT `manage_expenses_bankid_foreign` FOREIGN KEY (`BankID`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_expenses_expenseid_foreign` FOREIGN KEY (`ExpenseID`) REFERENCES `expence_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_salaries`
--
ALTER TABLE `manage_salaries`
  ADD CONSTRAINT `manage_salaries_bankid_foreign` FOREIGN KEY (`BankID`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_salaries_employeeid_foreign` FOREIGN KEY (`EmployeeID`) REFERENCES `staff_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_salaries_expenseid_foreign` FOREIGN KEY (`ExpenseID`) REFERENCES `utlity_expense_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_utlity_expenses`
--
ALTER TABLE `manage_utlity_expenses`
  ADD CONSTRAINT `manage_utlity_expenses_bankid_foreign` FOREIGN KEY (`BankID`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_utlity_expenses_expenseid_foreign` FOREIGN KEY (`ExpenseID`) REFERENCES `utlity_expense_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD CONSTRAINT `payment_records_bankid_foreign` FOREIGN KEY (`BankID`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_records_paymentid_foreign` FOREIGN KEY (`PaymentID`) REFERENCES `fees_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_records_studentid_foreign` FOREIGN KEY (`StudentID`) REFERENCES `admit_students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
