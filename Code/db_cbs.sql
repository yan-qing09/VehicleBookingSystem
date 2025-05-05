-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 06:54 PM
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
-- Database: `db_cbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_booking`
--

CREATE TABLE `tb_booking` (
  `b_id` int(10) NOT NULL,
  `b_ic` varchar(15) NOT NULL,
  `b_reg` varchar(10) NOT NULL,
  `b_pdate` date NOT NULL,
  `b_rdate` date NOT NULL,
  `b_total` float NOT NULL,
  `b_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_booking`
--

INSERT INTO `tb_booking` (`b_id`, `b_ic`, `b_reg`, `b_pdate`, `b_rdate`, `b_total`, `b_status`) VALUES
(41, '012345678901', 'CDD6666', '2024-01-28', '2024-01-30', 500, 4),
(48, '012345678901', 'ALK1111', '2024-01-28', '2024-02-02', 1250, 3),
(49, '012345678901', 'ALK1111', '2024-02-01', '2024-02-08', 1750, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `s_id` int(2) NOT NULL,
  `s_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`s_id`, `s_desc`) VALUES
(1, 'Received'),
(2, 'Approved'),
(3, 'Rejected'),
(4, 'Canceled'),
(5, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `tb_type`
--

CREATE TABLE `tb_type` (
  `t_id` int(2) NOT NULL,
  `t_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_type`
--

INSERT INTO `tb_type` (`t_id`, `t_desc`) VALUES
(1, 'Staff'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `u_ic` varchar(15) NOT NULL,
  `u_pwd` varchar(100) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_phone` varchar(20) NOT NULL,
  `u_email` varchar(50) DEFAULT NULL,
  `u_street` varchar(200) NOT NULL,
  `u_city` varchar(50) NOT NULL,
  `u_postcode` varchar(15) NOT NULL,
  `u_state` varchar(50) NOT NULL,
  `u_lic` varchar(20) NOT NULL,
  `u_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`u_ic`, `u_pwd`, `u_name`, `u_phone`, `u_email`, `u_street`, `u_city`, `u_postcode`, `u_state`, `u_lic`, `u_type`) VALUES
('012345678901', '$2y$10$kDqTCj5hNMExar32w9yzD.s/54YCA/ZrAVMbZx8.0CjoOWVgF7Te2', 'David', '601234567890', 'david100@gmail.com', 'NO 0, JALAN ABC, TAMAN ABC', 'ABC', '00000', 'ABC', 'ABC1234', 2),
('987654321098', '$2y$10$.yazddIL/yhvG4teNvDF3uBRvPLBtMcvbj91.yX7fvBfLMK0wRa7i', 'Mary', '601234567890', 'mary100@gmail.com', 'NO 1, JALAN XYZ, TAMAN XYZ', 'XYZ', '99999', 'XYZ', 'ABC9876', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vehicle`
--

CREATE TABLE `tb_vehicle` (
  `v_reg` varchar(10) NOT NULL,
  `v_model` varchar(100) NOT NULL,
  `v_type` varchar(50) NOT NULL,
  `v_mileage` varchar(10) NOT NULL,
  `v_seat` int(2) NOT NULL,
  `v_transmission` varchar(20) NOT NULL,
  `v_colour` varchar(20) DEFAULT NULL,
  `v_price` float NOT NULL,
  `v_pic` varchar(50) NOT NULL,
  `v_desc` varchar(700) NOT NULL,
  `v_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_vehicle`
--

INSERT INTO `tb_vehicle` (`v_reg`, `v_model`, `v_type`, `v_mileage`, `v_seat`, `v_transmission`, `v_colour`, `v_price`, `v_pic`, `v_desc`, `v_status`) VALUES
('AFF7777', 'Mercedes-AMG', 'Sports Car', '15,000', 2, 'Automatic', 'Yellow', 350, 'Cars/AFF7777.jpg', 'The Mercedes-AMG GT is a two-door, two-seater sports car known for its striking design, powerful performance, and luxurious features. It offers a range of performance variants, including different engine options and performance levels. The AMG GT is designed to deliver a thrilling driving experience, combining speed, agility, and comfort. The car features a distinctive long hood, sleek profile, and advanced technology, making it a flagship model in the Mercedes-AMG lineup.', 0),
('ALK1111', 'Mercedes-Benz SLK55 AMG', 'Roadster', '15,000', 3, 'Automatic', 'Red', 250, 'Cars/ALK1111.jpg', 'The Mercedes-Benz SLK55 is a high-performance roadster known for its sporty design and powerful performance. With a sleek and compact body, it offers a thrilling driving experience. Under the hood, it is equipped with a robust engine, delivering impressive speed and responsiveness. The SLK55 combines luxury and sportiness, making it a desirable choice for those seeking an exhilarating ride in a stylish convertible.', 1),
('CDD6666', 'Mercedes-Benz A200 AMG', 'Luxury Compact Car', '30,000', 5, 'Automatic', 'Blue', 250, 'Cars/CDD6666.jpg', 'The Mercedes-Benz A200 AMG Line is a stylish and sporty member of the A-Class lineup, boasting a perfect blend of luxury and performance. As part of the renowned AMG Line, this compact hatchback features distinctive exterior styling, including AMG body enhancements, a bold grille, and eye-catching alloy wheels. The A200 AMG Line is powered by an efficient yet potent engine, delivering a responsive and engaging driving experience. Inside, the cabin exudes sophistication with premium materials, advanced technology, and comfortable seating. This compact luxury car is known for its agility on urban streets and its ability to provide a comfortable and enjoyable ride. With a focus on both aestheti', 1),
('HKK4444', 'Ford Mustang GT-CS', 'Sports Car', '20,000', 4, 'Automatic', 'Black', 250, 'Cars/HKK4444.jpg', 'The Ford Mustang GT-CS embodies the spirit of American muscle, delivering a thrilling driving experience and a bold, unmistakable presence on the road. With a powerful V8 engine under the hood, the GT-CS roars to life, providing an exhilarating blend of performance and nostalgia. The California Special package enhances the Mustang\'s exterior aesthetics, making it a standout in the lineup. Inside, drivers can expect a combination of modern amenities and classic design cues, creating an interior that reflects the Mustang\'s rich heritage while offering contemporary comfort. Whether cruising down the highway or tearing up the track, the Ford Mustang GT-CS continues to be a symbol of pure, unbrid', 1),
('JVV3333', 'Range Rover Evoque', 'Coupe', '25,000', 5, 'Automatic', 'White', 250, 'Cars/JVV3333.jpg', 'The Range Rover Evoque Coupe Prestige SD4 is a luxury compact SUV that effortlessly blends sophistication with off-road capabilities. This stylish coupe variant of the Evoque lineup boasts a distinctive and aerodynamic design, setting it apart in the crowded SUV market. Its powerful SD4 engine ensures a dynamic driving experience, delivering a perfect balance of performance and fuel efficiency. The interior is appointed with high-quality materials, advanced technology features, and spacious seating, providing both comfort and elegance. With its iconic Range Rover pedigree, the Evoque Coupe Prestige SD4 is a symbol of refined luxury for urban adventures and beyond.', 1),
('KDD2222', 'McLaren 720S', 'Coupe', '18,000', 2, 'Automatic', 'White', 200, 'Cars/KDD2222.jpg', 'The McLaren 720S is an exceptional supercar that redefines performance and aerodynamic efficiency. With a sleek and futuristic design, the 720S captivates onlookers and enthusiasts alike. Powered by a potent twin-turbocharged V8 engine, it achieves mind-blowing speed and acceleration, making it a true powerhouse on the road. Its lightweight construction, innovative aerodynamics, and advanced suspension system contribute to an unparalleled driving experience. Inside the cockpit, drivers are surrounded by luxury and cutting-edge technology, creating a perfect harmony between performance and comfort. The McLaren 720S stands as a testament to the brand\'s commitment to pushing the boundaries of w', 1),
('WBB5555', 'BMW 3GT', 'Luxury Compact Car', '28,000', 5, 'Automatic', 'Blue', 300, 'Cars/WBB5555.jpg', 'The BMW 3 Series Gran Turismo is a luxurious and versatile member of the BMW 3 Series lineup. This Gran Turismo variant combines the sporty characteristics of the 3 Series with added practicality, offering a sleek design with a longer wheelbase and a distinctive hatchback rear. The 3GT provides a spacious and comfortable interior, featuring high-quality materials and advanced technology. Known for its smooth ride and dynamic handling, this BMW model delivers a balance of performance and everyday functionality. The Gran Turismo design not only adds a touch of elegance but also enhances the overall utility of the 3 Series, making it a compelling choice for those seeking a premium driving exper', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `b_ic` (`b_ic`),
  ADD KEY `b_reg` (`b_reg`),
  ADD KEY `b_status` (`b_status`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tb_type`
--
ALTER TABLE `tb_type`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`u_ic`),
  ADD KEY `u_type` (`u_type`);

--
-- Indexes for table `tb_vehicle`
--
ALTER TABLE `tb_vehicle`
  ADD PRIMARY KEY (`v_reg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_booking`
--
ALTER TABLE `tb_booking`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD CONSTRAINT `tb_booking_ibfk_1` FOREIGN KEY (`b_ic`) REFERENCES `tb_user` (`u_ic`),
  ADD CONSTRAINT `tb_booking_ibfk_2` FOREIGN KEY (`b_status`) REFERENCES `tb_status` (`s_id`),
  ADD CONSTRAINT `tb_booking_ibfk_3` FOREIGN KEY (`b_reg`) REFERENCES `tb_vehicle` (`v_reg`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`u_type`) REFERENCES `tb_type` (`t_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
