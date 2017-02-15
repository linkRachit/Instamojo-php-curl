SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `fill_form`
--

CREATE TABLE IF NOT EXISTS `fill_form` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `amount` int(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `link_slug` varchar(100) DEFAULT NULL,
  `link_title` varchar(100) DEFAULT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_phone` varchar(16) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `currency` varchar(16) NOT NULL,
  `unit_price` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `fees` float(16,2) NOT NULL,
  `shipping_address` varchar(100) DEFAULT NULL,
  `shipping_city` varchar(50) DEFAULT NULL,
  `shipping_state` varchar(50) DEFAULT NULL,
  `shipping_zip` int(16) DEFAULT NULL,
  `shipping_country` varchar(50) DEFAULT NULL,
  `discount_code` varchar(16) DEFAULT NULL,
  `discount_amount_off` decimal(16,2) DEFAULT NULL,
  `variants` varchar(100) DEFAULT NULL,
  `custom_fields` varchar(100) DEFAULT NULL,
  `affiliate_id` varchar(50) DEFAULT NULL,
  `affiliate_commission` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` varchar(50) NOT NULL,
  `amount` int(16) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `buyer_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `redirect_url` varchar(200) NOT NULL,
  `webhook` varchar(200) NOT NULL,
  `allow_repeated_payments` tinyint(1) NOT NULL,
  `partner_fee_type` varchar(16) NOT NULL,
  `send_email` tinyint(1) DEFAULT NULL,
  `send_sms` tinyint(1) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `sms_status` tinyint(1) DEFAULT NULL,
  `email_status` tinyint(1) DEFAULT NULL,
  `shorturl` varchar(100) DEFAULT NULL,
  `longurl` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
