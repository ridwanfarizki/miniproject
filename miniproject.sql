-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 21, 2018 at 02:22 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `md_kota`
--

CREATE TABLE `md_kota` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kode_woeid` int(11) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_kota`
--

INSERT INTO `md_kota` (`id`, `name`, `kode_woeid`, `counter`) VALUES
(1, 'Jakarta', 1047378, 3),
(2, 'Denpasar', 1047372, 1);

-- --------------------------------------------------------

--
-- Table structure for table `search_log_detail`
--

CREATE TABLE `search_log_detail` (
  `id` int(11) NOT NULL,
  `id_header` int(11) NOT NULL,
  `weather_state_abbr` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wind_direction_compass` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `weather_state_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `applicable_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `min_temp` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `max_temp` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `the_temp` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wind_speed` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wind_direction` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `air_pressure` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `humidity` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `visibility` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `predictability` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_consolidated_weather` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `search_log_detail`
--

INSERT INTO `search_log_detail` (`id`, `id_header`, `weather_state_abbr`, `wind_direction_compass`, `created`, `weather_state_name`, `applicable_date`, `min_temp`, `max_temp`, `the_temp`, `wind_speed`, `wind_direction`, `air_pressure`, `humidity`, `visibility`, `predictability`, `id_consolidated_weather`) VALUES
(1, 1, 'hr', 'N', '2018-09-21T09:06:10.31930', 'Heavy Rain', '2018-09-21', '25.263333333333', '30.303333333333', '29.855', '2.9390330674063', '4.4782820149726', '1017.41', '72', '12.800557245685', '77', 2147483647),
(2, 1, 'hr', 'ENE', '2018-09-21T09:06:13.73347', 'Heavy Rain', '2018-09-22', '25.25', '31.323333333333', '30.97', '4.7672719884488', '73.268174196677', '1018.345', '72', '9.1055734510459', '77', 2147483647),
(3, 1, 'hr', 'ENE', '2018-09-21T09:06:16.23802', 'Heavy Rain', '2018-09-23', '24.28', '30.513333333333', '30.64', '3.7798693187624', '68.072650577226', '1019.355', '76', '9.7449644078581', '77', 2147483647),
(4, 1, 'hc', 'ENE', '2018-09-21T09:06:19.33228', 'Heavy Cloud', '2018-09-24', '24.13', '31.74', '30.54', '3.5192452854901', '61.466053167191', '1018.655', '71', '13.142932772608', '71', 2147483647),
(5, 1, 'hc', 'NNE', '2018-09-21T09:06:22.42971', 'Heavy Cloud', '2018-09-25', '23.786666666667', '31.363333333333', '31.39', '3.6749524476285', '11.5', '1012.96', '57', '13.063086574405', '71', 2147483647),
(6, 1, 's', 'NNE', '2018-09-21T09:06:25.23698', 'Showers', '2018-09-26', '24.73', '32.053333333333', '30.65', '1.7776312335958', '22', '1015.19', '64', '9.9978624830987', '73', 2147483647),
(7, 2, 'hc', 'SE', '2018-09-21T07:48:20.64078', 'Heavy Cloud', '2018-09-21', '21.925', '30.995', '31.83', '6.598036286137', '125.35088054698', '991.89', '66', '13.333383043029', '71', 2147483647),
(8, 2, 'hc', 'SE', '2018-09-21T07:48:24.03311', 'Heavy Cloud', '2018-09-22', '21.3275', '30.4575', '30.24', '6.6997494760399', '124.53267382415', '992.195', '65', '14.182176091625', '71', 2147483647),
(9, 2, 'lr', 'SE', '2018-09-21T07:48:26.53292', 'Light Rain', '2018-09-23', '22.1825', '29.95', '30.46', '7.09095752671', '132.08169064395', '992.88', '68', '12.392627057981', '75', 2147483647),
(10, 2, 'hc', 'SE', '2018-09-21T07:48:29.54143', 'Heavy Cloud', '2018-09-24', '24.035', '29.4075', '29.33', '8.0404355271037', '126.5113697662', '1016.125', '71', '11.997124294122', '71', 2147483647),
(11, 2, 'hc', 'SE', '2018-09-21T07:48:32.32958', 'Heavy Cloud', '2018-09-25', '23.4525', '29.28', '29.585', '7.347668089557', '135.13531064724', '1015.585', '72', '12.507270042949', '71', 2147483647),
(12, 2, 'lc', 'SE', '2018-09-21T07:48:35.33697', 'Light Cloud', '2018-09-26', '23.0475', '29.2425', '28.1', '6.1912085421141', '141.87337547223', '1018.23', '71', '9.9978624830987', '70', 2147483647),
(13, 3, 'hr', 'N', '2018-09-21T09:06:10.31930', 'Heavy Rain', '2018-09-21', '25.263333333333', '30.303333333333', '29.855', '2.9390330674063', '4.4782820149726', '1017.41', '72', '12.800557245685', '77', 2147483647),
(14, 3, 'hr', 'ENE', '2018-09-21T09:06:13.73347', 'Heavy Rain', '2018-09-22', '25.25', '31.323333333333', '30.97', '4.7672719884488', '73.268174196677', '1018.345', '72', '9.1055734510459', '77', 2147483647),
(15, 3, 'hr', 'ENE', '2018-09-21T09:06:16.23802', 'Heavy Rain', '2018-09-23', '24.28', '30.513333333333', '30.64', '3.7798693187624', '68.072650577226', '1019.355', '76', '9.7449644078581', '77', 2147483647),
(16, 3, 'hc', 'ENE', '2018-09-21T09:06:19.33228', 'Heavy Cloud', '2018-09-24', '24.13', '31.74', '30.54', '3.5192452854901', '61.466053167191', '1018.655', '71', '13.142932772608', '71', 2147483647),
(17, 3, 'hc', 'NNE', '2018-09-21T09:06:22.42971', 'Heavy Cloud', '2018-09-25', '23.786666666667', '31.363333333333', '31.39', '3.6749524476285', '11.5', '1012.96', '57', '13.063086574405', '71', 2147483647),
(18, 3, 's', 'NNE', '2018-09-21T09:06:25.23698', 'Showers', '2018-09-26', '24.73', '32.053333333333', '30.65', '1.7776312335958', '22', '1015.19', '64', '9.9978624830987', '73', 2147483647),
(19, 4, 'hr', 'N', '2018-09-21T09:06:10.31930', 'Heavy Rain', '2018-09-21', '25.263333333333', '30.303333333333', '29.855', '2.9390330674063', '4.4782820149726', '1017.41', '72', '12.800557245685', '77', 2147483647),
(20, 4, 'hr', 'ENE', '2018-09-21T09:06:13.73347', 'Heavy Rain', '2018-09-22', '25.25', '31.323333333333', '30.97', '4.7672719884488', '73.268174196677', '1018.345', '72', '9.1055734510459', '77', 2147483647),
(21, 4, 'hr', 'ENE', '2018-09-21T09:06:16.23802', 'Heavy Rain', '2018-09-23', '24.28', '30.513333333333', '30.64', '3.7798693187624', '68.072650577226', '1019.355', '76', '9.7449644078581', '77', 2147483647),
(22, 4, 'hc', 'ENE', '2018-09-21T09:06:19.33228', 'Heavy Cloud', '2018-09-24', '24.13', '31.74', '30.54', '3.5192452854901', '61.466053167191', '1018.655', '71', '13.142932772608', '71', 2147483647),
(23, 4, 'hc', 'NNE', '2018-09-21T09:06:22.42971', 'Heavy Cloud', '2018-09-25', '23.786666666667', '31.363333333333', '31.39', '3.6749524476285', '11.5', '1012.96', '57', '13.063086574405', '71', 2147483647),
(24, 4, 's', 'NNE', '2018-09-21T09:06:25.23698', 'Showers', '2018-09-26', '24.73', '32.053333333333', '30.65', '1.7776312335958', '22', '1015.19', '64', '9.9978624830987', '73', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `search_log_header`
--

CREATE TABLE `search_log_header` (
  `id` int(11) NOT NULL,
  `user_agent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `search` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `search_log_header`
--

INSERT INTO `search_log_header` (`id`, `user_agent`, `search`, `deskripsi`, `created_datetime`) VALUES
(1, 'Platform Windows 10; Browser Chrome 69.0.3497.100; IP:127.0.0.1', 'Jakarta', 'title:Indonesia and location_type:Country and woeid:23424846 and latt_long:0.109740,113.917397 and  time :-6.171440,106.827820 and sunrise:-6.171440,106.827820 and sunset :-6.171440,106.827820', '2018-09-21 16:46:32'),
(2, 'Platform Windows 10; Browser Chrome 69.0.3497.100; IP:127.0.0.1', 'Denpasar', 'title:Indonesia and location_type:Country and woeid:23424846 and latt_long:0.109740,113.917397 and  time :-8.662690,115.215492 and sunrise:-8.662690,115.215492 and sunset :-8.662690,115.215492', '2018-09-21 16:46:44'),
(3, 'Platform Windows 10; Browser Chrome 69.0.3497.100; IP:127.0.0.1', 'Jakarta', 'title:Indonesia and location_type:Country and woeid:23424846 and latt_long:0.109740,113.917397 and  time :-6.171440,106.827820 and sunrise:-6.171440,106.827820 and sunset :-6.171440,106.827820', '2018-09-21 16:48:32'),
(4, 'Platform Windows 10; Browser Chrome 69.0.3497.100; IP:127.0.0.1', 'Jakarta', 'title:Indonesia and location_type:Country and woeid:23424846 and latt_long:0.109740,113.917397 and  time :-6.171440,106.827820 and sunrise:-6.171440,106.827820 and sunset :-6.171440,106.827820', '2018-09-21 17:02:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `md_kota`
--
ALTER TABLE `md_kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_log_detail`
--
ALTER TABLE `search_log_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_log_header`
--
ALTER TABLE `search_log_header`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `md_kota`
--
ALTER TABLE `md_kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `search_log_detail`
--
ALTER TABLE `search_log_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `search_log_header`
--
ALTER TABLE `search_log_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
