CREATE TABLE IF NOT EXISTS `loan` (
  `id` int(11) NOT NULL,
  `loan_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `property_value` decimal(11,2) NOT NULL DEFAULT '0.00',
  `ssn` varchar(16) COLLATE utf8_bin NOT NULL,
  `status` enum('Accepted','Rejected','','') COLLATE utf8_bin NOT NULL DEFAULT 'Accepted',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;