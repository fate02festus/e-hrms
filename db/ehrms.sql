
create database `ehrms`;
  use `ehrms`;

CREATE TABLE `admin` (
  `admin_id` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `phone`) VALUES
('AD0003', 'admin@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 'Super', 'a', 'Administrator', '0705767676'),
('AD0007', 'jane@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'jane', 'k', 'Mwaura', '078855662211'),
('AD0009', 'fate02festus@gmail.c', '21232f297a57a5a743894a0e4a801fc3', 'john', 'k', 'kelly', '00000');

-- --------------------------------------------------------

--
-- Table structure for table `admin_archive`
--

CREATE TABLE `admin_archive` (
  `admin_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_archive`
--

INSERT INTO `admin_archive` (`admin_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `phone`) VALUES
('AD0008', 'tracy@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'tracy', 'm', 'murash', '0000000000');

-- --------------------------------------------------------

--
-- Table structure for table `attendant`
--

CREATE TABLE `attendant` (
  `user_id` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `idno` varchar(50) NOT NULL,
  `hospital` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendant`
--

INSERT INTO `attendant` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `idno`, `hospital`) VALUES
('AT0009', 'attendant@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 'francis', 'k', 'mweu', '0762352625', 'kitui', '82762543', 'BARAKA HOSPITAL'),
('AT0011', 'jaffeth@ehrms.com', '21232f297a57a5a743894a0e4a801fc3', 'praise', '', 'waship', '0745879652', 'rightjere', '21865421', 'AGA KHAN'),
('AT0012', 'henry@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'henry', '', 'l', '0788556622', 'kaleyo', '000000000000', 'BARAKA HOSPITAL');

-- --------------------------------------------------------

--
-- Table structure for table `attendant_archive`
--

CREATE TABLE `attendant_archive` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `idno` varchar(30) NOT NULL,
  `hospital` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendant_archive`
--

INSERT INTO `attendant_archive` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `idno`, `hospital`) VALUES
('AT0010', 'jaffeth@ehrms.com', 'c3284d0f94606de1fd2af172aba15bf3', 'gregory', 'c', 'kasau', '07776256', 'kathos', '564576786', 'aga khan');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `user_id` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` varchar(20) NOT NULL,
  `idno` varchar(15) NOT NULL,
  `hospital` varchar(20) NOT NULL,
  `medicsect` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `idno`, `hospital`, `medicsect`) VALUES
('DO0007', 'doctor@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 'isaac', 'mawia', 'kioko', '0788227722', 'kitui', '31542352', 'BARAKA HOSPITAL', 'general'),
('DO0008', 'francis@ehrms.com', '21232f297a57a5a743894a0e4a801fc3', 'francis', 'yule', 'Karao', '0792389383', 'nairobi', '072323988', 'AGA KHAN', 'general'),
('DO0009', 'dentist@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 'jose', 'the', 'dentist', '0745234116', 'kitui', '37665443', 'BARAKA HOSPITAL', 'dentist'),
('DO0010', 'fthao@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'festus', 'tha', 'thao', '075487986587', 'kakuma', '54879865', 'BARAKA HOSPITAL', 'general');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_archive`
--

CREATE TABLE `doctor_archive` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `idno` varchar(30) NOT NULL,
  `hospital` varchar(30) NOT NULL,
  `medicsect` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hos_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `is_current_hos` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hos_id`, `name`, `location`, `type`, `is_current_hos`) VALUES
('101', 'BARAKA HOSPITAL', 'Kitui', 'Private', 1),
('102', 'NAIROBI WOMEN', 'Nairobi', 'Private', 0),
('103', 'KNH', 'Nairobi', 'Public', 0),
('104', 'AGA KHAN', 'nairobi', 'national', 0),
('HS001', 'NAIROBI', 'nairobi', 'level3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrecold_temp`
--

CREATE TABLE `hrecold_temp` (
  `BP` int(11) NOT NULL,
  `TEMP` int(11) NOT NULL,
  `WT` int(11) NOT NULL,
  `HT` int(11) NOT NULL,
  `pat_no` varchar(30) NOT NULL,
  `date` varchar(20) NOT NULL,
  `doctor` varchar(10) NOT NULL,
  `hospital` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrecold_temp`
--

INSERT INTO `hrecold_temp` (`BP`, `TEMP`, `WT`, `HT`, `pat_no`, `date`, `doctor`, `hospital`) VALUES
(198, 36, 80, 169, '1010016', '22/03/2020', 'AT0009', '101'),
(186, 36, 63, 175, '1010015', '22/03/2020', 'DO0007', '101'),
(56, 20, 12, 12, '1010012', '22/03/2020', ' DO0007', '104'),
(185, 36, 59, 136, '1010014', '23/03/2020', 'DO0008', '104'),
(198, 37, 59, 160, '1010013', '23/03/2020', 'DO0007', '104'),
(10, 10, 10, 25, '1010017', '09/07/2020', 'AT0009', '101'),
(12, 12, 12, 12, '1010018', '03/08/2020', 'AT0009', '101');

-- --------------------------------------------------------

--
-- Table structure for table `labtech`
--

CREATE TABLE `labtech` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `idno` varchar(30) NOT NULL,
  `hospital` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labtech`
--

INSERT INTO `labtech` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `idno`, `hospital`) VALUES
('0', 'labtech@ehrms.org', '77e2edcc9b40441200e31dc57dbb8829', 'frolence', 'l', 'mwai', '0734453423', 'karatina', '34343442', 'BARAKA HOSPITAL');

-- --------------------------------------------------------

--
-- Table structure for table `latech_archive`
--

CREATE TABLE `latech_archive` (
  `user_id` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `idno` varchar(30) NOT NULL,
  `hospital` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `latech_archive`
--

INSERT INTO `latech_archive` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `idno`, `hospital`) VALUES
('LB002', 'bredarn@gmail.com', 'c3284d0f94606de1fd2af172aba15bf3', 'Bredar', '', 'kingori', '07882277', 'dee', '32343345', 'BARAKA HOSPITAL');

-- --------------------------------------------------------

--
-- Table structure for table `medicalsection`
--

CREATE TABLE `medicalsection` (
  `id` varchar(11) NOT NULL,
  `description` varchar(20) NOT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicalsection`
--

INSERT INTO `medicalsection` (`id`, `description`, `notes`) VALUES
('MS001', 'general', 'general doctor. like nurses '),
('MS002', 'Gynotherapist', 'gyno specialist'),
('MS003', 'Radiologist', 'Scanning expert'),
('MS004', 'lab', 'lab technisian'),
('MS005', 'dentist', 'teeth specialistsr');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pat_no` varchar(20) NOT NULL,
  `huduma_no` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `birthdate` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `civil_status` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `BP` varchar(10) NOT NULL,
  `TEMP` varchar(10) NOT NULL,
  `WT` varchar(10) NOT NULL,
  `HT` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pat_no`, `huduma_no`, `firstname`, `middlename`, `lastname`, `birthdate`, `address`, `phone`, `civil_status`, `gender`, `BP`, `TEMP`, `WT`, `HT`) VALUES
('1010009', ' 34342', 'iryn', '', 'mueni', '1998-11-12', 'kitui', '07233223232', 'Single', 'Female', '12', '23&deg;C', '23kg', '23'),
('1010010', ' 667', 'lacree', 'la', 'turnt', '3444-02-23', 'us', '0754342342', 'Single', 'Male', '12', '1&deg;C', '1kg', '10'),
('1010011', ' 4343', 'frankline', 'k', 'thui', '2033-06-07', 'machakos', '0723625222', 'Single', 'Male', '34', '56&deg;C', '67kg', '35'),
('1010012', '', 'Emanuel', 'fr', 'kamotho', '2018-11-27', 'kitui', '07546532', 'Single', 'Male', '56', '20', '12', '12'),
('1010013', '', 'joel', '', 'mugo', '2008-06-30', 'naitobi', '0726362332', 'Single', 'Male', '67', '1', '56', '76'),
('1010014', '', 'Yusuf', 'A', 'Athman', '1998-11-11', 'kalanba', '071245', 'Single', 'Male', '34', '34&deg;C', '23kg', '34cm'),
('1010015', '07215487', 'Janifer', 'l', 'Hunderson', '1993-06-12', 'kilifi', '07215487', 'Single', 'Male', '195', '36&deg;C', '100kg', '198cm'),
('1010016', ' ', 'Patrice', 'k', 'Lumumba', '1996-06-12', 'kangemi', '0705879566', 'Married', 'Male', '198', '36&deg;C', '80kg', '169cm'),
('1010017', ' ', 'john', '', 'kioko', '2018-07-05', 'jeruire', '072588996622', 'Married', 'Female', '10', '10', '10', '25'),
('1010018', ' ', 'jane', 'kiara', 'mwelu', '2018-08-01', 'werwer', '0754879865', 'Single', 'Female', '12', '12', '12', '12');

-- --------------------------------------------------------

--
-- Table structure for table `patient_hrecold`
--

CREATE TABLE `patient_hrecold` (
  `com_id` int(50) NOT NULL,
  `date` varchar(20) NOT NULL,
  `complaints` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `specialist` text NOT NULL,
  `prescription` varchar(100) NOT NULL,
  `pat_no` varchar(50) NOT NULL,
  `doctor` varchar(20) NOT NULL,
  `hospital` varchar(20) NOT NULL,
  `BP` int(11) NOT NULL,
  `TEMP` int(11) NOT NULL,
  `WT` int(11) NOT NULL,
  `HT` int(11) NOT NULL,
  `add_to_specialist` int(11) NOT NULL,
  `specialist_type` varchar(20) NOT NULL,
  `specialist_remarks` text NOT NULL,
  `lab_remarks` varchar(200) NOT NULL,
  `add_to_lab` tinyint(1) NOT NULL,
  `refer_to_hos` tinyint(1) NOT NULL,
  `hos_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_hrecold`
--

INSERT INTO `patient_hrecold` (`com_id`, `date`, `complaints`, `remark`, `specialist`, `prescription`, `pat_no`, `doctor`, `hospital`, `BP`, `TEMP`, `WT`, `HT`, `add_to_specialist`, `specialist_type`, `specialist_remarks`, `lab_remarks`, `add_to_lab`, `refer_to_hos`, `hos_name`) VALUES
(1, '22/03/2020', 'she sells sea shells', 'at the sea show', '', '', '1010012', 'DO0007', 'baraka hos', 56, 20, 12, 12, 0, '', '', '', 0, 1, 'aga khan'),
(2, '23/03/2020', 'check for covid-19', 'sent for trest of covid 19', '', '', '1010013', 'DO0007', 'baraka hos', 198, 37, 59, 160, 0, '', '', '', 1, 1, '104'),
(3, '03/08/2020', 'added information about the test and treatment of the trending diseases.', 'progreeing well', '', '', '1010018', 'DO0007', 'BARAKA HOSPITAL', 12, 12, 12, 12, 0, '', 'okay', '', 0, 0, ''),
(4, '03/08/2020', 'test 2 done', 'progreeing well', '', '', '1010018', 'DO0007', 'BARAKA HOSPITAL', 12, 12, 12, 12, 1, 'dentist', 'okay', '', 0, 0, ''),
(5, '03/08/2020', 'checked for complications.', 'progreeing well', '', '', '1010018', 'DO0009', 'BARAKA HOSPITAL', 12, 12, 12, 12, 0, '', 'okay', '', 0, 1, '104'),
(6, '03/08/2020', 'checked', 'progreeing well', '', '', '1010018', 'DO0008', 'AGA KHAN', 12, 12, 12, 12, 1, 'dentist', 'okay', '', 0, 1, '101');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `idno` varchar(30) NOT NULL,
  `hospital` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`user_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `contact`, `address`, `idno`, `hospital`) VALUES
('PH0003', 'pharmacist@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 'jane', 'k', 'Nthure', '0766256535', '', '63534422', 'BARAKA HOSPITAL'),
('PH0004', 'johnson@ehrms.org', '0db29679df2158cbce3b1af16ff12187', 'johnson', 'munuve', 'kioko', '074665667', '', '56345433', 'BARAKA HOSPITAL'),
('PH0005', 'irene@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'irene', 'we', 'kimUta', '2145785454', '', '21548798', 'BARAKA HOSPITAL');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist_archive`
--

CREATE TABLE `pharmacist_archive` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `idno` varchar(30) NOT NULL,
  `hospital` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_master`
--

CREATE TABLE `sys_master` (
  `id` int(11) NOT NULL,
  `item` varchar(20) NOT NULL,
  `length` int(11) NOT NULL,
  `last_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_master`
--

INSERT INTO `sys_master` (`id`, `item`, `length`, `last_no`) VALUES
(1, 'patient', 4, 18),
(2, 'hospital', 3, 2),
(3, 'admin', 4, 9),
(4, 'doctor', 4, 10),
(5, 'attendant', 4, 12),
(6, 'pharmacist', 4, 5),
(7, 'medicalsection', 3, 6),
(8, 'labtech', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE `sys_user` (
  `user_id` varchar(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `username`, `password`, `level`) VALUES
('AD0003', 'admin@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 3),
('AD0006', 'isaac@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 3),
('AD0007', 'jane@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 3),
('AD0008', 'tracy@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 3),
('AD0009', 'fate02festus@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 3),
('AT0009', 'attendant@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 2),
('AT0011', 'jaffeth@ehrms.com', '21232f297a57a5a743894a0e4a801fc3', 2),
('AT0012', 'henry@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 2),
('DO0007', 'doctor@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 1),
('DO0008', 'francis@ehrms.com', '21232f297a57a5a743894a0e4a801fc3', 1),
('DO0009', 'dentist@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 1),
('DO0010', 'fthao@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
('LB001', 'labtech@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 5),
('LB002', 'bredarn@gmail.com', 'c3284d0f94606de1fd2af172aba15bf3', 5),
('PH0003', 'pharmacist@ehrms.org', '21232f297a57a5a743894a0e4a801fc3', 4),
('PH0004', 'johnson@ehrms.org', '0db29679df2158cbce3b1af16ff12187', 4),
('PH0005', 'irene@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `level`) VALUES
(1, 'administrator', 3),
(2, 'attendant', 2),
(3, 'doctor', 1),
(4, 'pharmacist', 4),
(5, 'lab', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendant`
--
ALTER TABLE `attendant`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hos_id`);

--
-- Indexes for table `labtech`
--
ALTER TABLE `labtech`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `medicalsection`
--
ALTER TABLE `medicalsection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pat_no`);

--
-- Indexes for table `patient_hrecold`
--
ALTER TABLE `patient_hrecold`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sys_master`
--
ALTER TABLE `sys_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient_hrecold`
--
ALTER TABLE `patient_hrecold`
  MODIFY `com_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sys_master`
--
ALTER TABLE `sys_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
