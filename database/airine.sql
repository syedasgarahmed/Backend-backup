
CREATE TABLE `airlines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `country`) VALUES
(1, 'AirCan', 'Canada'),
(2, 'USAir', 'USA'),
(3, 'BritAir', 'UK'),
(4, 'AirFrance', 'France'),
(5, 'LuftAir', 'Germany'),
(6, 'ItalAir', 'Italy');

-- --------------------------------------------------------

--
-- Table structure for table `airporttaxes`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingoffices`
--

CREATE TABLE `bookingoffices` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingoffices`
--

INSERT INTO `bookingoffices` (`id`, `city_id`, `address`) VALUES
(1, 1, '123 Maple St, Toronto'),
(2, 2, '456 St-Laurent Blvd, Montreal'),
(3, 3, '789 5th Ave, New York'),
(4, 4, '101 Wacker Dr, Chicago'),
(5, 5, '123 Baker St, London'),
(6, 6, '456 Princes St, Edinburgh'),
(7, 7, '789 Champs-Élysées, Paris'),
(8, 8, '101 Promenade des Anglais, Nice'),
(9, 9, '123 Beethoven St, Bonn'),
(10, 10, '456 Alexanderplatz, Berlin'),
(11, 11, '789 Via Veneto, Rome'),
(12, 12, '101 Piazza Plebiscito, Naples');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_number` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `booking_office_id` int(11) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `from_location_id` int(11) DEFAULT NULL,
  `to_location_id` int(11) DEFAULT NULL,
  `departure_datetime` datetime DEFAULT NULL,
  `arrival_datetime` datetime DEFAULT NULL,
  `class_indicator` enum('business','economy') DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status_indicator` enum('booked','canceled','scratched') DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `outstanding_balance` decimal(10,2) DEFAULT NULL,
  `ticket_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_number`, `customer_id`, `booking_office_id`, `booking_date`, `flight_id`, `from_location_id`, `to_location_id`, `departure_datetime`, `arrival_datetime`, `class_indicator`, `total_price`, `status_indicator`, `amount_paid`, `outstanding_balance`, `ticket_name`, `created_at`, `updated_at`) VALUES
(4, 'BOOK-CgvzVs98', 8, 1, NULL, 1, 10, 1, '2025-03-28 12:32:00', NULL, 'business', 10000.00, 'booked', 10000.00, 0.00, 'kooo', '2025-03-19 01:32:41', '2025-03-19 01:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country`) VALUES
(1, 'Toronto', 'Canada'),
(2, 'Montreal', 'Canada'),
(3, 'New York', 'USA'),
(4, 'Chicago', 'USA'),
(5, 'London', 'UK'),
(6, 'Edinburgh', 'UK'),
(7, 'Paris', 'France'),
(8, 'Nice', 'France'),
(9, 'Bonn', 'Germany'),
(10, 'Berlin', 'Germany'),
(11, 'Rome', 'Italy'),
(12, 'Naples', 'Italy');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', '2025-03-19 06:45:57', '2025-03-19 06:45:57'),
(2, 'Jane', 'Smith', '2025-03-19 06:45:57', '2025-03-19 06:45:57'),
(3, 'Robert', 'Brown', '2025-03-19 06:45:57', '2025-03-19 06:45:57'),
(4, 'Alice', 'Johnson', '2025-03-19 06:45:57', '2025-03-19 06:45:57'),
(5, 'SYED', 'Ahmed', '2025-03-19 01:18:45', '2025-03-19 01:18:45'),
(6, 'aaa', 'aaa', '2025-03-19 01:29:05', '2025-03-19 01:29:05'),
(7, 'afssdf', 'asdfadf', '2025-03-19 01:31:07', '2025-03-19 01:31:07'),
(8, 'llll', 'llll', '2025-03-19 01:32:41', '2025-03-19 01:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `customer_id`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 'john.doe@example.com', '2025-03-19 06:47:28', '2025-03-19 06:47:28'),
(2, 2, 'jane.smith@example.com', '2025-03-19 06:47:28', '2025-03-19 06:47:28'),
(3, 3, 'robert.brown@example.com', '2025-03-19 06:47:28', '2025-03-19 06:47:28'),
(4, 4, 'alice.johnson@example.com', '2025-03-19 06:47:28', '2025-03-19 06:47:28'),
(5, 5, 'syedasgarahmed11@gmail.com', '2025-03-19 01:18:45', '2025-03-19 01:18:45'),
(6, 6, 'aa@gmail.com', '2025-03-19 01:29:05', '2025-03-19 01:29:05'),
(7, 7, 'aa11@aa.in', '2025-03-19 01:31:07', '2025-03-19 01:31:07'),
(8, 8, 'lskdfjksdf@gmail.com', '2025-03-19 01:32:41', '2025-03-19 01:32:41');

-- --------------------------------------------------------

 
--
-- Table structure for table `flightavailability`
--

CREATE TABLE `flightavailability` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `departure_datetime` datetime DEFAULT NULL,
  `total_business_class_seats` int(11) DEFAULT NULL,
  `booked_business_class_seats` int(11) DEFAULT NULL,
  `total_economy_class_seats` int(11) DEFAULT NULL,
  `booked_economy_class_seats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flightavailability`
--

INSERT INTO `flightavailability` (`id`, `flight_id`, `departure_datetime`, `total_business_class_seats`, `booked_business_class_seats`, `total_economy_class_seats`, `booked_economy_class_seats`) VALUES
(1, 1, '2025-03-19 08:00:00', 20, 5, 100, 30),
(2, 2, '2025-03-19 09:00:00', 25, 10, 120, 50),
(3, 3, '2025-03-19 10:00:00', 15, 7, 80, 20),
(4, 4, '2025-03-19 11:00:00', 30, 12, 150, 60),
(5, 5, '2025-03-19 12:00:00', 22, 8, 90, 30),
(6, 6, '2025-03-19 13:00:00', 18, 6, 85, 25);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_number` varchar(50) DEFAULT NULL,
  `flight_name` varchar(255) NOT NULL,
  `airline_id` int(11) DEFAULT NULL,
  `business_class_indicator` tinyint(1) DEFAULT NULL,
  `smoking_allowed` tinyint(1) DEFAULT NULL,
  `origin_city_id` int(11) DEFAULT NULL,
  `destination_city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `flight_name`, `airline_id`, `business_class_indicator`, `smoking_allowed`, `origin_city_id`, `destination_city_id`) VALUES
(1, 'AC101', 'AirCan-AC101', 1, 1, 0, 1, 2),
(2, 'UA202', 'USAir-UA202', 2, 1, 1, 3, 4),
(3, 'BA303', 'BritAir-BA303', 3, 1, 0, 5, 6),
(4, 'AF404', 'AirFrance-AF404', 4, 1, 1, 7, 8),
(5, 'LA505', 'LuftAir-LA505', 5, 1, 0, 9, 10),
(6, 'IA606', 'ItalAir-IA606', 6, 1, 0, 11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `mailingaddresses`
--

CREATE TABLE `mailingaddresses` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province_or_state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mailingaddresses`
--

INSERT INTO `mailingaddresses` (`id`, `customer_id`, `street`, `city`, `province_or_state`, `postal_code`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, '789 Pine St', 'New York', 'NY', '10001', 'USA', '2025-03-19 06:48:05', '2025-03-19 06:48:05'),
(2, 2, '123 Elm St', 'London', 'England', 'SW1A 1AA', 'UK', '2025-03-19 06:48:05', '2025-03-19 06:48:05'),
(3, 3, '456 Oak St', 'Paris', 'Île-de-France', '75001', 'France', '2025-03-19 06:48:05', '2025-03-19 06:48:05'),
(4, 4, '789 Birch St', 'Rome', 'Lazio', '00100', 'Italy', '2025-03-19 06:48:05', '2025-03-19 06:48:05'),
(5, 5, NULL, 'Dummy City', 'Dummy State', '000000', 'Country', '2025-03-19 01:18:45', '2025-03-19 01:18:45'),
(6, 6, NULL, 'Dummy City', 'Dummy State', '000000', 'Country', '2025-03-19 01:29:05', '2025-03-19 01:29:05'),
(7, 7, NULL, 'Dummy City', 'Dummy State', '000000', 'Country', '2025-03-19 01:31:07', '2025-03-19 01:31:07'),
(8, 8, NULL, 'Dummy City', 'Dummy State', '000000', 'Country', '2025-03-19 01:32:41', '2025-03-19 01:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type` enum('phone','fax') DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `area_code` varchar(10) DEFAULT NULL,
  `local_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `customer_id`, `type`, `country_code`, `area_code`, `local_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'phone', '1', '212', '5551234', '2025-03-19 06:48:40', '2025-03-19 06:48:40'),
(2, 2, 'phone', '44', '20', '12345678', '2025-03-19 06:48:40', '2025-03-19 06:48:40'),
(3, 3, 'fax', '33', '1', '987654321', '2025-03-19 06:48:40', '2025-03-19 06:48:40'),
(4, 4, 'phone', '39', '06', '9876543', '2025-03-19 06:48:40', '2025-03-19 06:48:40'),
(5, 5, 'phone', NULL, NULL, '09342475168', '2025-03-19 01:18:45', '2025-03-19 01:18:45'),
(6, 6, 'phone', NULL, NULL, '1111111111', '2025-03-19 01:29:05', '2025-03-19 01:29:05'),
(7, 7, 'phone', NULL, NULL, '3333333333', '2025-03-19 01:31:07', '2025-03-19 01:31:07'),
(8, 8, 'phone', NULL, NULL, '555555555', '2025-03-19 01:32:41', '2025-03-19 01:32:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookingoffices`
--
ALTER TABLE `bookingoffices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_number` (`booking_number`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `booking_office_id` (`booking_office_id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `fk_bookings_from_location` (`from_location_id`),
  ADD KEY `fk_bookings_to_location` (`to_location_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `exchangerates`
--
ALTER TABLE `exchangerates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flightavailability`
--
ALTER TABLE `flightavailability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airline_id` (`airline_id`),
  ADD KEY `origin_city_id` (`origin_city_id`),
  ADD KEY `destination_city_id` (`destination_city_id`);

--
-- Indexes for table `mailingaddresses`
--
ALTER TABLE `mailingaddresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `airporttaxes`
--
ALTER TABLE `airporttaxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bookingoffices`
--
ALTER TABLE `bookingoffices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

 00
--
-- AUTO_INCREMENT for table `flightavailability`
--
ALTER TABLE `flightavailability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mailingaddresses`
--
ALTER TABLE `mailingaddresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airporttaxes`
--
ALTER TABLE `airporttaxes`
  ADD CONSTRAINT `airporttaxes_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `bookingoffices`
--
ALTER TABLE `bookingoffices`
  ADD CONSTRAINT `bookingoffices_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`booking_office_id`) REFERENCES `bookingoffices` (`id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `fk_bookings_from_location` FOREIGN KEY (`from_location_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_bookings_to_location` FOREIGN KEY (`to_location_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `flightavailability`
--
ALTER TABLE `flightavailability`
  ADD CONSTRAINT `flightavailability_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`);

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`origin_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `flights_ibfk_3` FOREIGN KEY (`destination_city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `mailingaddresses`
--
ALTER TABLE `mailingaddresses`
  ADD CONSTRAINT `mailingaddresses_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
