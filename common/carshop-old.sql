-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2016 at 10:13 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '1', 1476079004);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Admin', 1, 'This site of admin', NULL, NULL, 1476079004, 1476079004),
('LoginBackend', 2, 'Login to Backend Site', NULL, NULL, 1476079004, 1476079004);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'LoginBackend');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `caption` varchar(120) NOT NULL,
  `status` int(2) NOT NULL,
  `offer_status` int(2) NOT NULL,
  `make_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `mileage` float(10,2) DEFAULT NULL,
  `engine` varchar(120) DEFAULT NULL,
  `transmission` varchar(120) DEFAULT NULL,
  `fuel` varchar(45) DEFAULT NULL,
  `drive_train` varchar(45) DEFAULT NULL,
  `exterior_color` varchar(120) DEFAULT NULL,
  `interior_color` varchar(120) DEFAULT NULL,
  `vehicle_type` varchar(45) DEFAULT NULL,
  `description` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `thumbnail` text,
  `price1` float(10,2) NOT NULL,
  `price2` float(10,2) DEFAULT NULL,
  `photos` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `caption`, `status`, `offer_status`, `make_id`, `model_id`, `mileage`, `engine`, `transmission`, `fuel`, `drive_train`, `exterior_color`, `interior_color`, `vehicle_type`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `thumbnail`, `price1`, `price2`, `photos`) VALUES
(1, '2016 Audi Q5.0', 10, 10, 2, 5, 30000.00, '2.0L I4', 'Automatic 4 Speed', 'Diesel', '4X4', 'Black', 'Black', 'sedan', '<p>For more information on this or any of our vehicles, contact Graham Automotive&rsquo;s internet sales department at <u>888-540-6399. </u>We would be happy to answer your questions whether you are seeking a new, certified or pre-owned vehicle.&nbsp;<a href="https://www.audiusa.com/models/audi-q5" target="_blank">view...more</a></p>\r\n', NULL, 1476989337, NULL, 1, '4fc5a948ef920e351171876ac6279a59.jpg', 34.78, 36.61, 'e61c7808ca6ba1bb5f395e0e6158a846.jpg,522889356f5335280ba93ae1b68f23dc.jpg,dfce5ab4686de68e3e0874ee93526c90.jpg,b8fb47b817e38b7a911eff034c9cc48a.jpg,4fc5a948ef920e351171876ac6279a59.jpg'),
(3, 'Toyota begins shipping Le Yaris to America', 10, 10, 1, 3, 0.00, 'engine test', 'Automatic 3 Speed', 'Diesel', 'AWD', 'xxx', 'xxx', 'wagon', '<p>Our tiniest&nbsp;<a href="http://www.autoblog.com/toyota/">Toyota</a>&nbsp;(<a href="http://www.autoblog.com/scion/iq/">Scion iQ</a>&nbsp;notwithstanding) is about to get a little French flair. The Japanese automaker announced Thursday that its Toyota Motor Manufacturing France facility would begin building&nbsp;<a href="http://www.autoblog.com/toyota/yaris/">Yaris</a>&nbsp;models destined for North America &ndash; specifically, the United States, Puerto Rico and Canada. This will mark the first time in history that Toyota has exported vehicles to North America from Europe.<br />\r\n<br />\r\nInitially, Toyota will export roughly 25,000 Yaris models to North American markets from France each year. In order to handle this additional production, Toyota Motor Manufacturing France has invested 10 million euro into its French facility.<br />\r\n<br />\r\nDespite being somewhat of a snooze-fest (<a href="http://www.autoblog.com/2011/09/23/adspotting-toyota-yaris-is-a-car-and-apparently-not-much-else/">it&#39;s a car!</a>), the Yaris carries on in North America with a 106-horsepower 1.5-liter four-cylinder engine, with prices starting at $14,370 for the three-door and $15,395 for the five-door, not including $795 for destination.</p>\r\n', NULL, 1477058537, NULL, 1, '08c7c032daafaad7df221bb7b9c2cdce.jpg', 19.68, 24.60, '04ff581eaf3980f13dd6a9bfd8e70137.jpg,16e88ec19a04f95fa3ec4a65cf5e6b3d.jpg,dd62c91e3d461db7a6640a6d0454c768.jpg,08c7c032daafaad7df221bb7b9c2cdce.jpg'),
(4, '2013 Peugeot 207 SV 1.6 (A) FULL SPEC 1 LADY OWNER', 10, 10, 3, 6, 50000.00, '1597 cc', 'Automatic', 'Gasoline', 'FWD', 'Maroon', 'Maroon', 'coupe', '<p>WHY BUY WITH US???<br />\r\n-NO HIDDEN INFO<br />\r\n-TRUE YEAR MAKE 2013<br />\r\n-TRUE MILEAGE<br />\r\n-GUARANTEE ACCIDENT FREE<br />\r\n-1 YEAR WARRANTY*<br />\r\n(TERM AND CONDITION APPLY*)<br />\r\n<br />\r\n*********** SPECIAL PROMOTION ***********<br />\r\n** VIEW TO BELIEVE,WELCOME TEST DRIVER **<br />\r\n<br />\r\n$$$ CHEAPEREST IN TOWN $$$<br />\r\n<br />\r\nRM25,800 NEGO<br />\r\n<br />\r\n~FULL LOAN&nbsp;<br />\r\n~LOAN UP TO 9 YEARS<br />\r\n~LOW INTEREST<br />\r\n~WE ARE BANK PLATINUM DEALER<br />\r\n~FAST AND EASY LOAN APPROVE<br />\r\n<br />\r\nEASY DOCUMENT:<br />\r\n<br />\r\n~I.C,DRIVING LISEN<br />\r\n~3 MONTH PAYSLIP&nbsp;<br />\r\n~3 MONTH BANK STATEMENT<br />\r\n~KWSP STATEMENT (IF ANY)(JIKA ADA)<br />\r\n~COMPANY CONFIRMATION LETTER (IF ANY)(JIKA ADA)<br />\r\n<br />\r\n* 1 LADY OWNER (NO SMOKING)<br />\r\n<br />\r\n* LAST OWNER UPGRADE NEW CAR<br />\r\n<br />\r\n* 100% GUARANTEE ACCIDENT FREE&nbsp;<br />\r\n<br />\r\n* VERY CLEAN INTERIOR (WELL KEEP)<br />\r\n<br />\r\n* VERY LOW MILEAGE (SELDOM USE)<br />\r\n<br />\r\n* ENGINE PART GOOD (WELL MAINTAIN)<br />\r\n<br />\r\n* SMOOTH GEAR BOX AND ENGINE<br />\r\n<br />\r\n* SUSPENSION GOOD RUNNING<br />\r\n<br />\r\n* AIRCOND GOOD<br />\r\n<br />\r\nFULL SPEC&nbsp;<br />\r\n<br />\r\n~ FULL LEATHER SEATS<br />\r\n<br />\r\n~ DUAL SRS AIRBAG<br />\r\n<br />\r\n~ ABS BRAKE SYSTEM<br />\r\n<br />\r\n~ NICE SPORT RIM<br />\r\n<br />\r\n~ POWER SIDE MIRROR<br />\r\n<br />\r\n~ 4 TYRE LIKE NEW<br />\r\n<br />\r\n***ALL KEEP ORIGINAL PART,NO ANY MODIFY<br />\r\n***WELL KEEP BY LAST OWNER,DON&#39;T MISS<br />\r\n***GUARANTEE TIP-TOP CONDITION<br />\r\n***NO NEED REPAIR,JUST DRIVER GO!!!<br />\r\n<br />\r\n^^^^^ FREE TINTED ^^^^^<br />\r\n^^^^^ FREE TOWING ^^^^^<br />\r\n<br />\r\n~RM0 DOWNPAYMENT<br />\r\n~LOAN UP TO 9 YEARS<br />\r\n~LOW INTEREST&nbsp;<br />\r\n<br />\r\nPLEASE CALL FOR BEST DEAL:<br />\r\n(OUR FRIENDLY SALE PERSON)<br />\r\n<br />\r\n<a href="http://www.carlist.my/used-cars/3191481/2013-peugeot-207-sv-1-6-a-full-spec-1-lady-owner/#">Show Phone Number</a>012-3165727&nbsp;JIMMY<br />\r\n<br />\r\n<a href="http://www.carlist.my/used-cars/3191481/2013-peugeot-207-sv-1-6-a-full-spec-1-lady-owner/#">Show Phone Number</a>017-3729993&nbsp;JEFFREY<br />\r\n<br />\r\njimmychew198@yahoo.com<br />\r\n<br />\r\nLOCATION: TAMAN CHERAS HARTAMAS<br />\r\n<br />\r\nADDRESS: LOT 1525,JALAN CH1,TAMAN CHERAS<br />\r\nHARTAMAS,43200,CHERAS,SELANGOR<br />\r\n<br />\r\nGPS SEARCH: 3.&nbsp;<a href="http://www.carlist.my/used-cars/3191481/2013-peugeot-207-sv-1-6-a-full-spec-1-lady-owner/#">Show Phone Number</a>083056,101.7463<br />\r\n<br />\r\nNEAR:<br />\r\n<br />\r\n~TAMAN SEGAR<br />\r\n~TAMAN SEGAR PERDANA<br />\r\n~TAMAN CONNAUGHT<br />\r\n~TAMAN TAYTON VIEW<br />\r\n<br />\r\nLANDMARK:<br />\r\n<br />\r\n~CHERAS LEISURE MALL<br />\r\n~TAMAN SEGAR (PETRONAS PETROL STATION)<br />\r\n~JALAN CHERAS (MOBIL,CALTEX PETROL STATION)<br />\r\n<br />\r\nWE ARE OPEN 7 DAYS A WEEK:<br />\r\n<br />\r\n9:30a.m.-7:00p.m. (MONDAY TO SATURDAY)<br />\r\n10:30 a.m.-7:00p.m. (SUNDAY)</p>\r\n', 1477063210, 1477063491, 1, 1, '850710da61becdbd0e12d05ebd0f20c0.jpg', 25800.00, 30000.00, 'f47dbc22f67b6d76202435252ad6b301.jpg,a78cafeb2fd872b614984dadbfc434c2.jpg,0e5f70458925ecb0220867d55d48a9e4.jpg,36a252ad73cf11ac845eab7b03b971c9.jpg,ea229c886f2075e199b58de8d0128bc8.jpg,850710da61becdbd0e12d05ebd0f20c0.jpg'),
(5, '2016 Honda CR-V 2.4 i-VTEC Merdeka Bonus up to RM6000', 10, 10, 4, 8, 75000.00, '2354 cc', 'Automatic', 'Diesel', 'FWD', 'Black', 'White', 'coupe', '<p>2016 Honda CR-V 2.0 i-VTEC Merdeka Bonus up to RM6000<br />\r\n<br />\r\n-Auto aircon, two zone, incl. rear air vents<br />\r\n-Rear Seat Armrest with Cupholder<br />\r\n-Auto-dimming interior rear view mirror<br />\r\n-Leather Upholstery<br />\r\n-Door handles, chrome<br />\r\n-Sunshade Compartment Box<br />\r\n-Ultrasonic Sensor<br />\r\n-Wash/Wipe, Rear Window<br />\r\n-Wipers, Variable Intermittent<br />\r\n-Electric adjustable lumbar support - Driver seat<br />\r\n-Seat, Driver&#39;s - Electric Adjustment<br />\r\n-Automatic On/Off headlamps<br />\r\n-ECON Button<br />\r\n-Rain sensor<br />\r\n-Smart Entry &amp; Start System<br />\r\n-Hill Start Assist (HSA)<br />\r\n-7&#39;&#39; Display Audio with Navigation<br />\r\n-Foot Pedal Parking Brake<br />\r\n-Parking Sensor<br />\r\n-Electric Door Mirrors<br />\r\n-Reverse Camera<br />\r\n-2nd Row One-Motion Seat with 60:40<br />\r\n-Tilt &amp; Telescopic Steering Wheel<br />\r\n-Steering wheel mounted audio control<br />\r\n-Steering Wheel Switch i-MID &amp; Cruise Control<br />\r\n-Steering-wheel gearshift paddles<br />\r\n-Intelligent Multi-Information Display (i-MID)<br />\r\n-Hands-Free Telephone (HFT) capability system<br />\r\n-HDMI Socket<br />\r\n-Audio- 6 Speakers<br />\r\n-Center Console with Accessory Socket &amp; USB<br />\r\n-Fog lights, Front<br />\r\n-HID Lighting System with Auto-Levelling<br />\r\n-Projector Headlamps<br />\r\n-LED daytime running lights<br />\r\n-Fog Lights, Rear<br />\r\n-Side Mirror,Turning light<br />\r\n-Brake, Anti-Lock (ABS)<br />\r\n-Brake, Electronic Force Distribution (EBD)<br />\r\n-Security Alarm System<br />\r\n-Side and Curtain Airbags<br />\r\n-Airbag, driver&#39;s<br />\r\n-Airbag, front passenger&#39;s<br />\r\n-Electronic Immobiliser<br />\r\n-Child seat ISOFIX attachments at the rear<br />\r\n-Advanced Compatibility Engineering (ACE)<br />\r\n-Emergency Stop Signal (ESS)<br />\r\n-Honda LaneWatch<br />\r\n-Front,3-Point ELR<br />\r\n-Seat Belts, 3 ELR Rear/2nd Row<br />\r\n-Seat belts, front - height adjustable<br />\r\n-Vehicle Stability Assist (VSA)<br />\r\n-18&quot; Alloy wheels<br />\r\n<br />\r\n**Honda Merdeka Promotion**<br />\r\n# 5 Years warranty<br />\r\n# New free service<br />\r\n# Endorsement Fee for Ownership Claim is RM50<br />\r\n<br />\r\n**Drive your dream Honda today**<br />\r\nPlease call for more details<br />\r\n<br />\r\nDocument For Own Use :<br />\r\n1. My Card and Driving License<br />\r\n2. Latest 3 Months Payslip<br />\r\n3. Latest 3 Months Bank Statement<br />\r\n4. EPF/KWSP</p>\r\n', 1477064108, 1477064761, 1, 1, '35271688e62803933211a8bd42c69384.jpg', 172600.00, NULL, 'e6dcae8088c6ef2989381401fb0bdd20.jpg,026f67f5a4163c82e2b99e51df3c9183.jpg,9d06f8fedf1f8fc4ef31b6693f398147.jpg,a279fe59e9eb78df299c36916505baef.jpg,95ad40788b5aac7715815539aebe03c6.jpg,04fe56b6d5052e91d09c8236c3560a13.jpg,6643fa5f94aa52cb48c2e61190393334.jpg,ba339ff0aa7323884bba4eb037575fff.jpg,a3af86b20c994156a5fc838eaad4136b.jpg,fb418f19b05d53b4fa73a8954f842842.jpg'),
(6, '2012 Honda Civic 1.8 (A) SL Full Spec FaceLift', 10, 10, 4, 7, 75000.00, '1799 cc', 'Automatic', 'Gasoline', 'FWD', 'White', 'Black', 'coupe', '<p>2012 Honda Civic 1.8 (A)&nbsp;<br />\r\n<br />\r\n~~~ Honda Civic 1.8 (A) SL Full Spec Facelift<br />\r\n# Nice Number Plate<br />\r\n# Fog Lamp<br />\r\n# Adjustable &amp; Retractable Wing Mirrors With Turning Light<br />\r\n# Audio System With AM/FM Radio, CD/MP3 Player &amp; USB Connector<br />\r\n# Original Leather Seats<br />\r\n# Cruise Control<br />\r\n# 2 SRS Airbags<br />\r\n# ABS Brakes w EBD (Electronic Brake Distribution, BA(Brake Assist)<br />\r\n# Vehicle Stability Assist (VSA)<br />\r\n# Alarm with Remote Control &amp; Immobiliser<br />\r\n# Reverse Sensor<br />\r\n<br />\r\nCAR CONDITION<br />\r\n- 100% Careful Owner<br />\r\n- 100% Clean Interior &amp; Exterior<br />\r\n- 100% Low Mileage<br />\r\n- 100% Excellent Condition<br />\r\n- 100% Accident Free<br />\r\n- 100% Well Maintained<br />\r\n- 100% Smooth Engine &amp; Gearbox<br />\r\n- 100% Transmission &amp; Suspension Good<br />\r\n<br />\r\nKindly to contact us for more information:<br />\r\n<br />\r\nShow Phone Number&nbsp;012-3322223ANSON<br />\r\nShow Phone Number&nbsp;012-9442404HENRY</p>\r\n', 1477064951, 1477064980, 1, 1, '4a18c7f7054e5da1a9f3b37dc24b91af.jpg', 69800.00, NULL, '4a18c7f7054e5da1a9f3b37dc24b91af.jpg,aa7717db88c6ee67700988d4122f9df2.jpg,974a738725cdc735dd46ec281c81752f.jpg,f1fe9b3bd65fc7ed298ab3326e184446.jpg,29f60aa1577f269d0e1e2aa45a8cdf37.jpg,e86af34c511eea5c48ba911969871574.jpg'),
(7, '2014 Ford Ranger 3.2 (M)', 10, 0, 5, 9, 38225.00, '3198 cc', 'Manual', 'Diesel', '4WD', 'Black', 'Black', 'suv', '<p>2014 Ford Ranger 3.2 (M)&nbsp;</p>\r\n\r\n<p>-Air-conditioning<br />\r\n-Electro Chromic Rear View Mirror<br />\r\n-Theater Dimming with Illuminated Entry Lighting<br />\r\n-Leather steering wheel<br />\r\n-Chrome Fender Vents<br />\r\n-Chrome Front Grille<br />\r\n-Chrome Side Steps<br />\r\n-Chrome Sport Bar<br />\r\n-Chrome Steel Rear Bumper<br />\r\n-Double Tier Storage Center Armrest<br />\r\n-Gear Knob, Leather<br />\r\n-Rear Cargo Bed-liner with inner tie-down hooks<br />\r\n-Rear centre head restraint<br />\r\n-Seat trim, fabric<br />\r\n-Sunvisor<br />\r\n-Automatic headlights<br />\r\n-Wipers, Rain Sensing<br />\r\n-Cruise control<br />\r\n-Vanity Mirror (Passenger)<br />\r\n-4-eye rear parking sensor<br />\r\n-Electrically Folding and Adjustable Ext. Mirrors<br />\r\n-Power Windows with Driver one touch down<br />\r\n-Steering wheel mounted audio control<br />\r\n-Electronic-shift-on-the-fly (ESOF)<br />\r\n-Bluetooth Connectivity and Voice Control<br />\r\n-Audio System - CD, MP3, AM/FM &amp; Aux Input Port<br />\r\n-USB and iPod connectivity<br />\r\n-4.2 inch Color Multifunction Display<br />\r\n-6 Premium High Output Speakers<br />\r\n-Fog lights, Front<br />\r\n-Halogen headlamps<br />\r\n-Headlights Follow-me-home function<br />\r\n-Side mirror turn indicator<br />\r\n-Brake, Anti-Lock (ABS)<br />\r\n-Brake, Electronic Force Distribution (EBD)<br />\r\n-Emergency Brake Assist (EBA)<br />\r\n-Alarm - Immobilizer<br />\r\n-Burglar alarm<br />\r\n-Airbag, driver&#39;s<br />\r\n-Airbag, front passenger&#39;s<br />\r\n-Electronic Passive Anti Theft Security System<br />\r\n-ISOFIX child seat mounting<br />\r\n-Collapsible Steering Column &amp; Control Pedals<br />\r\n-Front &amp; Side Collision Protection Beams<br />\r\n-Load-Sensing Proportioning Valve (LSPV)<br />\r\n-Ultra Rigid Safety Cell &amp; Crash Crumple Zone<br />\r\n-Belt minder system (front seats only)<br />\r\n-Front,3-Point ELR<br />\r\n-Rear Outboard Seat Belts<br />\r\n-Seat Belts, 3 ELR Rear/2nd Row<br />\r\n-Electronic Stability Programme (ESP)<br />\r\n-Limited Slip Differential (LSD)<br />\r\n-17&quot; Alloy wheels<br />\r\n-Full Size Spare Tyre with Steel Wheel<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\nEXTRA INFO :<br />\r\n<br />\r\n** Trusted Car Seller<br />\r\n** Satisfaction guaranteed **<br />\r\n** Ready Stock<br />\r\n** Excellent Condition Inside/Out<br />\r\n** Genuine Dealer<br />\r\n** Low Mileage&nbsp;<br />\r\n<br />\r\n<br />\r\nDocument For Own Use :<br />\r\n1. My Card and Driving License<br />\r\n2. Latest 3 Months Payslip<br />\r\n3. Latest 3 Months Bank Statement<br />\r\n4. EPF/KWSP<br />\r\n<br />\r\n------ DO DROP BY TO OUR SHOWROOM ------</p>\r\n', 1477065239, 1477069321, 1, 1, '6d1064f1efee9c91f9e510d15b17627f.jpg', 72800.00, NULL, '6d1064f1efee9c91f9e510d15b17627f.jpg,19c4602e2f628ae6b1ef35c82d533122.jpg,b15b7e131356d3efae03c005303ccbb8.jpg,6286c0b95dfe2cb8bc5a98a380c8755c.jpg,fa1ce2fb5edeab40b5e9901dfdd80178.jpg,af900c66f0c807ad6a8526edb88609f4.jpg,aa387eb0e9a8b486b5e254c795274427.jpg,58dd0466ccb74b3e9a55ba51d041a994.jpg,9dd465ac1683aad07099b90edd9f487d.jpg'),
(8, '2012 Mercedes Benz C200 1.8 CGI', 10, 10, 6, 10, 55000.00, '1796 cc', 'Automatic', 'Gas/electric Hybrid', 'FWD', 'White', 'Black', 'sedan', '<p>2012 Mercedes Benz C200<br />\r\n<br />\r\n- 1.8 CGI&nbsp;<br />\r\n- ELECTRIC LEATHER SEATS<br />\r\n- MULTI FUNCTION STEERING<br />\r\n- AUTO CRUISE CONTROL<br />\r\n- RAINING SENSOR<br />\r\n- WOOD PANEL<br />\r\n- PARKTRONIC SENSOR<br />\r\n- 2 MODE(COMFORT, SPORT)<br />\r\n- ELECTRONIC &amp; INDICATOR SIDE MIRRORS<br />\r\n- BI-XENON PROJECTOR HEAD LAMP<br />\r\n- DUAL ZONE CLIMATE A/C CONTROL<br />\r\n- 4 SRS AIRBAGS (FR/SIDE)<br />\r\n- ANTI-LOCK BRAKING SYSTEM(ABS)<br />\r\n- BRAKE ASSISTANT(BA)<br />\r\n- ELECTRONIC BRAKE FORCE DISTRIBUTION(EBD)<br />\r\n- ELECTRONIC STABILITY PROGRAM(ESP)<br />\r\n<br />\r\n- 100% Careful Owner<br />\r\n- 100% Clean Interior &amp; Exterior<br />\r\n- 100% Low Mileage&nbsp;<br />\r\n- 100% Excellent Condition<br />\r\n- 100% Accident Free<br />\r\n- 100% Well Maintained<br />\r\n- 100% Smooth Engine &amp; Gearbox<br />\r\n- 100% Transmission &amp; Suspension Good<br />\r\n<br />\r\nKindly to contact us for more information:<br />\r\n<br />\r\nShow Phone Number&nbsp;012-9442404HENRY<br />\r\nShow Phone Number&nbsp;012-3322223ANSON</p>\r\n', 1477065529, 1477069093, 1, 1, '57d120d07fb1d6b6e15c042ad4a0eeba.jpg', 129800.00, 150000.00, '57d120d07fb1d6b6e15c042ad4a0eeba.jpg,ab1a169e14e452c123853b6576b84727.jpg,ce4afe9931efb53e91b3c481a19a7bd5.jpg,878e538ccd603764254a9e4df262457f.jpg,c8f2e8874fb4deeeddb2b46a56300f86.jpg,ddea9d4c9373936449fb6b7e5f52a4dc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `content_text` text,
  `mark` varchar(45) DEFAULT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `content_text`, `mark`, `page_id`) VALUES
(2, '<p><strong>Who Are CarSite.co.uk?</strong></p>\r\n\r\n<p>CarSite.co.uk is the UK&#39;s largest independent website for car buyers looking for new or used cars. The CarSite network is a division of BuyYour Ltd.</p>\r\n\r\n<p><strong>New Car Buyers</strong></p>\r\n\r\n<p>If someone&#39;s looking to buy a new car, CarSite.co.uk can provide them with a service that provides discounted prices on brand new UK cars.&nbsp; This service is free to use, and the consumer is under no obligation to buy a car from the quotes they receive.</p>\r\n\r\n<p><strong>Lease Cars</strong></p>\r\n\r\n<p>As an alternative to outright-purchase leasing can be an attractive option to those looking to get a brand new car.&nbsp; CarSite.co.uk has partnered with the most competitive contract hire and leasing brokers in the UK to provide the best leasing offers for personal or business leases.</p>\r\n\r\n<p><strong>Used Car Buyers</strong></p>\r\n\r\n<p>Used car buyers can use the classified pages in the used car section to find second-hand cars for sale anywhere in the UK from both dealers and private sellers.&nbsp; Detailed information is provided for each car that&#39;s for sale, including contact details for the buyer to contact the seller directly.</p>\r\n\r\n<p><strong>Car Parts</strong></p>\r\n\r\n<p>CarSite.co.uk provides a car parts service.&nbsp; It&#39;s similar to online dating, but for people looking for disounted car parts!&nbsp; the user enters the details of the part they are looking for and the online system scours over 250 parts suppliers to see who can supply the part to the user.&nbsp; Again, the customer is under no obligation to purchase any parts offered and there is no fee to use the system.</p>\r\n\r\n<p><strong>Advice &amp; Information</strong></p>\r\n\r\n<p>In addition, CarSite.co.uk has a team of independent journalists, car experts and enthusiasts bringing you the latest car news and reviews, and the website provides a wealth of information from the videos and images, through to car data - all useful for the car enthusiast or car buyer.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The site has been created so car buyers and sellers can make contact quickly and easily and see exactly what they&#39;re getting from the outset, as well as ordering their next car online.</p>\r\n\r\n<p>We have invited dealers from around the UK to sell their cars direct to you at the best possible prices. Our prices are entered directly by UK dealerships.</p>\r\n\r\n<p>Please note: CarSite&nbsp;does not sell any vehicles or parts to the customer and does not buy the vehicle from the supplier; we are an intermediary third party.</p>\r\n', 'about', 1),
(3, '<p>Contact Details</p>\r\n\r\n<p>18 Fresno,<br />\r\nCA 93727, USAS<br />\r\n<br />\r\ninfo@bootsshop.com<br />\r\n﻿Tel 123-456-6780<br />\r\nFax 123-456-5679<br />\r\nweb: car-shopping.com</p>\r\n', 'contact', 1),
(4, '<p>content legal notice</p>\r\n', 'legal notice', 2),
(5, '<p>content terms and conditions</p>\r\n', 'terms and conditions', 3);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `anwser` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `anwser`) VALUES
(2, '<p>question 23</p>\r\n', '<p>anwser&nbsp;2</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `name`) VALUES
(2, 'Audi'),
(5, 'Ford'),
(4, 'Honda'),
(6, 'Mercedes-Benz'),
(3, 'Peugeot'),
(1, 'Toyota');

-- --------------------------------------------------------

--
-- Table structure for table `make_has_model`
--

CREATE TABLE `make_has_model` (
  `make_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `make_has_model`
--

INSERT INTO `make_has_model` (`make_id`, `model_id`) VALUES
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1475748711),
('m130524_201442_init', 1475748715),
('m140506_102106_rbac_init', 1476078824);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`) VALUES
(6, '207'),
(10, 'C200 CGI'),
(2, 'camry'),
(7, 'Civic 1.8 (A) SL'),
(8, 'CR-V'),
(4, 'Q3'),
(5, 'Q5'),
(9, 'Ranger'),
(3, 'yaris');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`) VALUES
(1, 'about contact'),
(2, 'legal notice'),
(3, 'terms and conditions'),
(4, 'faq');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', '$2y$13$KlFTS4hiitGmN2/QwiGE5uZnZ56E/fYQ8ZWDIPoZp8ZQoXsrL9zuq', NULL, 'mrbankshart@gmail.com', 10, 1473411091, 1473411091);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_car_make1_idx` (`make_id`),
  ADD KEY `fk_car_model1_idx` (`model_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_table1_page1_idx` (`page_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image_car1_idx` (`car_id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `make_has_model`
--
ALTER TABLE `make_has_model`
  ADD PRIMARY KEY (`make_id`,`model_id`),
  ADD KEY `fk_make_has_model_model1_idx` (`model_id`),
  ADD KEY `fk_make_has_model_make_idx` (`make_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `fk_car_make1` FOREIGN KEY (`make_id`) REFERENCES `make` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_car_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `fk_table1_page1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_car1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `make_has_model`
--
ALTER TABLE `make_has_model`
  ADD CONSTRAINT `fk_make_has_model_make` FOREIGN KEY (`make_id`) REFERENCES `make` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_make_has_model_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
