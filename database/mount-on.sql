-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2024 at 02:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mount-on`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(100) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_description`, `user_id`, `post_date`) VALUES
(1, 'UPGRADES AHEAD OF STARSHIP’S SECOND FLIGHT TEST', 'The first flight test of a fully integrated Starship and Super Heavy was a critical step in advancing the capabilities of the most powerful launch system ever developed. Starship’s first flight test provided numerous lessons learned that are directly contributing to several upgrades being made to both the vehicle and ground infrastructure to improve the probability of success on future Starship flights. This rapid iterative development approach has been the basis for all of SpaceX’s major innovative advancements, including Falcon, Dragon, and Starlink. SpaceX has led the investigation efforts following the flight with oversight from the FAA and participation from NASA and the National Transportation and Safety Board.\n\nStarship and Super Heavy successfully lifted off for the first time on April 20, 2023 at 8:33 a.m. CT (13:33:09 UTC) from the orbital launch pad at Starbase in Texas. Starship climbed to a maximum altitude of ~39 km (24 mi) over the Gulf of Mexico. During ascent, the vehicle sustained fires from leaking propellant in the aft end of the Super Heavy booster, which eventually severed connection with the vehicle’s primary flight computer. This led to a loss of communications to the majority of booster engines and, ultimately, control of the vehicle. SpaceX has since implemented leak mitigations and improved testing on both engine and booster hardware. As an additional corrective action, SpaceX has significantly expanded Super Heavy’s pre-existing fire suppression system in order to mitigate against future engine bay fires.\n\nThe Autonomous Flight Safety System (AFSS) automatically issued a destruct command, which fired all detonators as expected, after the vehicle deviated from the expected trajectory, lost altitude and began to tumble. After an unexpected delay following AFSS activation, Starship ultimately broke up 237.474 seconds after engine ignition. SpaceX has enhanced and requalified the AFSS to improve system reliability.\n\nSpaceX is also implementing a full suite of system performance upgrades unrelated to any issues observed during the first flight test. For example, SpaceX has built and tested a hot-stage separation system, in which Starship’s second stage engines will ignite to push the ship away from the booster. Additionally, SpaceX has engineered a new electronic Thrust Vector Control (TVC) system for Super Heavy Raptor engines. Using fully electric motors, the new system has fewer potential points of failure and is significantly more energy efficient than traditional hydraulic systems.\n\nSpaceX also made significant upgrades to the orbital launch mount and pad system in order to prevent a recurrence of the pad foundation failure observed during the first flight test. These upgrades include significant reinforcements to the pad foundation and the addition of a flame deflector, which SpaceX has successfully tested multiple times.\n\nTesting development flight hardware in a flight environment is what enables our teams to quickly learn and execute design changes and hardware upgrades to improve the probability of success in the future. We learned a tremendous amount about the vehicle and ground systems during Starship’s first flight test. Recursive improvement is essential as we work to build a fully reusable launch system capable of carrying satellites, payloads, crew, and cargo to a variety of orbits and Earth, lunar, or Martian landing sites.', 2, '2024-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `email`, `name`) VALUES
(1, 'admin', 'Demo123', '', ''),
(2, 'someone', '$2y$10$bU3.rDP7O4w3Ito2ncFV3evoz3vwXmcKEeVukzeUsZ00K9JQiE8Oq', 'some123@mail.com', 'someone'),
(3, 'test1', '$2y$10$ui1d.kRRzwwViz0.mcNllOb8O8fS4M.plOKZ9MowqOhiHC9SyHMEG', 'testEmail@mail.com', 'testname'),
(4, 'ishen', '$2y$10$jD9Xswdr2kTW3EVFaYf3.e8HQn0GwTHgkJ.i.ZFRgrwCE./V4wyEK', 'some@gmail.com', 'ishen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
