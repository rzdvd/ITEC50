-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2025 at 02:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitna`
--

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `waist` decimal(5,2) DEFAULT NULL,
  `hips` decimal(5,2) DEFAULT NULL,
  `thigh` decimal(5,2) DEFAULT NULL,
  `arm` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `user_id`, `log_date`, `waist`, `hips`, `thigh`, `arm`) VALUES
(1, NULL, '2025-06-15', 0.05, NULL, NULL, NULL),
(2, NULL, '2025-06-15', 0.05, NULL, NULL, NULL),
(3, NULL, '2025-06-15', 0.05, NULL, NULL, NULL),
(4, NULL, '2025-06-15', 0.05, NULL, -0.02, NULL),
(5, NULL, '2025-06-15', NULL, NULL, NULL, NULL),
(6, NULL, '2025-06-15', NULL, NULL, NULL, NULL),
(7, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(8, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(9, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(10, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(11, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(12, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(13, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(14, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(15, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(16, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(17, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(18, NULL, '2025-06-15', 0.04, NULL, NULL, NULL),
(19, NULL, '2025-06-16', 0.04, 25.00, NULL, NULL),
(20, NULL, '2025-06-16', 0.04, 25.00, NULL, 99.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `emailAddress` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emailAddress`, `username`, `password`) VALUES
(2, 'gabriellim13@gmail.com', 'gabriel lim', '$2y$10$q/q3R9jzwJi8Wrxq6ic7Y.EIY1231l9mvn6gGM3j3jKGQKYkgNC6O'),
(3, 'ruiz@gmail.com', 'ruizDavid', '$2y$10$YQyXxJAhEJDl3X6w//XZge5TSzmiKOoY2zDYB4lVD2KeiyN9OUSAS'),
(6, 'troyhermosa@gmail.com', 'troy hermosa', '$2y$10$sQXQdFlW4l9WUtlk0rYov.BnCv77Le8EwwHG5DssW/O0uPCbwzSH6'),
(7, 'ruizdavidcabrera@gmail.com', 'rzdvd', '$2y$10$gi2bnnzHImRgCX16okrSve7y0l7FWsGGMYELxMEHsYUa.7jpXf4uS');

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

CREATE TABLE `user_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `reps` int(11) NOT NULL,
  `sets` int(11) NOT NULL,
  `duration_seconds` int(11) NOT NULL,
  `completed_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`id`, `user_id`, `exercise_name`, `reps`, `sets`, `duration_seconds`, `completed_at`) VALUES
(1, 2, 'Pull Ups', 8, 3, 40, '2025-06-14'),
(2, 2, 'Sit Ups', 9, 3, 30, '2025-06-14'),
(3, 2, 'Dumbbells', 12, 3, 20, '2025-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_image_url` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE `weight` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`id`, `user_id`, `log_date`, `weight`) VALUES
(1, NULL, '2025-06-15', 50.00),
(2, NULL, '2025-06-14', 50.00),
(3, NULL, '2025-06-15', 5.00),
(4, NULL, '2025-06-15', 4.00),
(5, NULL, '2025-06-15', 4.00),
(6, NULL, '2025-06-13', 55.00),
(7, NULL, '2025-06-15', 55.00),
(8, NULL, '2025-06-15', 50.00),
(9, NULL, '2025-06-15', 50.00),
(10, NULL, '2025-06-15', 60.00),
(11, NULL, '2025-06-15', 60.00),
(12, NULL, '2025-06-15', 50.00),
(13, NULL, '2025-06-15', 51.00),
(14, NULL, '2025-06-15', 51.00),
(15, NULL, '2025-06-16', 50.00),
(16, NULL, '2025-06-16', 50.00),
(17, NULL, '2025-06-16', 50.00),
(18, NULL, '2025-06-16', 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image_url2` varchar(255) DEFAULT NULL,
  `focus` varchar(35) NOT NULL,
  `equipment` varchar(255) DEFAULT NULL,
  `reps` varchar(25) NOT NULL DEFAULT '0',
  `duration` varchar(25) DEFAULT '0',
  `sets` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`id`, `name`, `image_url`, `image_url2`, `focus`, `equipment`, `reps`, `duration`, `sets`) VALUES
(1, 'Pull Up', 'back1.gif', 'back2.gif', 'back', 'Pull Up Bar', '8-12 reps', '', '3 sets'),
(2, 'Deadlift', 'back3.gif', 'back4.gif', 'back', 'Barbell / EZ-Bar', '3-5 reps', '', '3 sets'),
(3, 'Lat Pulldown', 'back5.gif', 'back6.gif', 'back', 'Lat Pulldown Machine', '12-15 reps', '', '3 sets'),
(4, 'Back Extension', 'back7.gif', 'back8.gif', 'back', 'Bench', '8-12 reps', '', '3 sets'),
(5, 'T-Bar Row', 'back9.gif', 'back10.gif', 'back', 'Barbell / EZ-Bar', '8-12 reps', '', '3 sets'),
(6, 'Chest Pres', 'chest1.gif', 'chest2.gif', 'chest', 'Barbell / EZ-Bar and Bench', '6-10 reps', '', '3 sets'),
(7, 'Lying Chest Overhead Extension', 'chest3.gif', 'chest4.gif', 'chest', 'Barbell / EZ-Bar and Bench', '10-12 reps', '', '3 sets'),
(8, 'Incline Dumbbell Bench Chest Press', 'chest5.gif', 'chest6.gif', 'chest', 'Dumbbells and Bench', '8-12 reps', '', '3 sets'),
(9, 'Push Up', 'chest7.gif', 'chest8.gif', 'chest', 'No equipment needed', '6-12 reps', '', '3 sets'),
(10, 'Standing Cable Chest Press', 'chest9.gif', 'chest10.gif', 'chest', 'Cable Station', '8-12 reps', '', '3 sets'),
(11, 'Sit Up', 'core1.gif', 'core2.gif', 'core', 'No equipment needed', '10-15 reps', '', '3 sets'),
(12, 'Weighted Russian Twist', 'core3.gif', 'core4.gif', 'core', 'Dumbbells', '8-12 reps', '', '3 sets'),
(13, 'Lying Leg Raise', 'core5.gif', 'core6.gif', 'core', 'No equipment needed', '8-12 reps', '', '3 sets'),
(14, 'Plank', 'core7.gif', 'core8.gif', 'core', 'No equipment needed', '', '20-60 sec', '3 sets'),
(15, 'Crunch', 'core9.gif', 'core10.gif', 'core', 'No equipment needed', '10-15 reps', '', '3 sets'),
(16, 'Bent Over Double Arm Tricep Kickback', 'arms1.gif', 'arms2.gif', 'arms', 'Dumbbells', '10-15 reps', '', '3 sets'),
(17, 'Standing Bicep Cable Curl', 'arms3.gif', 'arms4.gif', 'arms', 'Cable Station', '8-12 reps', '', '3 sets'),
(18, 'Tricep Cable Rope Pull Down', 'arms5.gif', 'arms6.gif', 'arms', 'Cable Station', '8-12 reps', '', '3 sets'),
(19, 'Seated Dumbbell Bicep Curl', 'arms7.gif', 'arms8.gif', 'arms', 'Dumbbells', '8-12 reps', '', '3 sets'),
(20, 'Bench Tricep Dip', 'arms9.gif', 'arms10.gif', 'arms', 'Bench', '8-12 reps', '', '3 sets'),
(21, 'Barbell Overhead Squat', 'legs1.gif', 'legs2.gif', 'legs', 'Barbell', '2-5 reps', '', '3 sets'),
(22, 'Leg Press Machine Calf Raise', 'legs3.gif', 'legs4.gif', 'legs', 'Leg Press Machine Calf Raises', '12-15 reps', '', '3 sets'),
(23, 'Lying Leg Curl', 'legs5.gif', 'legs6.gif', 'legs', 'Leg Curl Machine', '10-12 reps', '', '3 sets'),
(24, 'Jump Rope', 'legs7.gif', 'legs8.gif', 'legs', 'Rope', '', '30-60 sec', '3 sets'),
(25, 'Agility Ladder Drill', 'legs9.gif', 'legs10.gif', 'legs', 'Ladder', '3-5 reps', '', '3 sets'),
(26, 'Barbell Kneeling Squat', 'glutes1.gif', 'glutes2.gif', 'glutes', 'Barbell', '8-10 reps', '', '2 sets'),
(27, 'Glute Bridge', 'glutes3.gif', 'glutes4.gif', 'glutes', 'Yoga Mat', '10-15 reps', '', '3 sets'),
(28, 'Dumbbell Lunge', 'glutes5.gif', 'glutes6.gif', 'glutes', 'Dumbbells', '10-15 reps', '', '3 sets'),
(29, 'Jump Squat', 'glutes7.gif', 'glutes8.gif', 'glutes', 'No equipment needed', '8-12 reps', '', '3 sets'),
(30, 'Resistance Band Glute Kickback', 'glutes9.gif', 'glutes10.gif', 'glutes', 'Resistance Band', '10-15 reps', '', '3 sets');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan`
--

CREATE TABLE `workout_plan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `workout_day` varchar(20) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `sets` int(11) NOT NULL,
  `reps` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_meauserments_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_info_user` (`user_id`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_weight_user` (`user_id`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `image_url` (`image_url`),
  ADD UNIQUE KEY `image_url2` (`image_url2`),
  ADD KEY `focus` (`focus`),
  ADD KEY `equipment` (`equipment`),
  ADD KEY `reps` (`reps`),
  ADD KEY `duration` (`duration`),
  ADD KEY `sets` (`sets`);

--
-- Indexes for table `workout_plan`
--
ALTER TABLE `workout_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_workout_plan_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `workout_plan`
--
ALTER TABLE `workout_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `fk_meauserments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_history`
--
ALTER TABLE `user_history`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_user_info_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `weight`
--
ALTER TABLE `weight`
  ADD CONSTRAINT `fk_weight_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workout_plan`
--
ALTER TABLE `workout_plan`
  ADD CONSTRAINT `fk_workout_plan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
