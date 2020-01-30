-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 Oca 2020, 09:52:18
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `egitim`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `account_number` int(16) NOT NULL,
  `account_password` int(11) NOT NULL,
  `account_name` varchar(300) DEFAULT NULL,
  `account_surname` varchar(300) DEFAULT NULL,
  `account_balance` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `bank_accounts`
--

INSERT INTO `bank_accounts` (`account_number`, `account_password`, `account_name`, `account_surname`, `account_balance`) VALUES
(1001, 1234, 'Ferhat', 'Çil', 80),
(1002, 1234, 'Tolga', 'Uysal', 1020),
(1003, 1453, 'Saldırgan', 'Hesap', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bank_accounts_transfer`
--

CREATE TABLE `bank_accounts_transfer` (
  `request_id` int(11) NOT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `from_account` int(11) NOT NULL,
  `to_account` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `request_content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `bank_accounts_transfer`
--

INSERT INTO `bank_accounts_transfer` (`request_id`, `request_date`, `from_account`, `to_account`, `amount`, `request_content`) VALUES
(34, '2020-01-13 02:08:31', 1001, 1002, 10, 'Borç Ödemesi'),
(35, '2020-01-13 02:09:10', 1001, 1002, 10, 'Borç Ödemesi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `newsletter`
--

CREATE TABLE `newsletter` (
  `newsletter_id` int(11) NOT NULL,
  `newsletter_email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_user` varchar(250) NOT NULL,
  `post_content` varchar(550) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`post_id`, `post_user`, `post_content`, `post_date`, `post_status`) VALUES
(1, 'ferhat', 'Bilgisayarın mucidi tuhaf bir biçimde intihar etti. 7 Haziran 1954\'de bir elmayı bir siyanür solüsyonuna daldırdı ve bir sehpaya koydu. Daha sonra resmini yaptı elmanın ve arkasından da yedi. Apple\'ın logosunun dişlenmiş bir olmasının nedeninin bu olduğu söylenir. Alan Turing\'in elması.', '2020-01-09 02:38:11', 1),
(21, 'tolga', 'Uzun yıllardır tasarı halinde bekleyen ve 7 Nisan 2016 tarihinde yayımlanarak yürürlüğe giren ‘6698 Sayılı Kişisel Verilerin Korunması Kanunu’, kişisel verilerin işlenmesinde başta özel hayatın gizliliği olmak üzere kişilerin temel hak ve özgürlüklerini korumak ve kişisel verileri işleyen gerçek ve tüzel kişilerin yükümlülükleri ile uyacakları kuralları düzenleme amacını taşımaktadır.', '2020-01-09 17:05:05', 1),
(22, 'muratsahin', 'Test içerik.', '2020-01-10 18:01:30', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `post_comments`
--

CREATE TABLE `post_comments` (
  `post_comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_comment` varchar(250) NOT NULL,
  `post_comment_user` varchar(250) NOT NULL,
  `post_comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_comment_status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `post_comments`
--

INSERT INTO `post_comments` (`post_comment_id`, `post_id`, `post_comment`, `post_comment_user`, `post_comment_date`, `post_comment_status`) VALUES
(20, 21, 'Teşekkür ederim', 'ferhat', '2020-01-13 02:03:55', '1'),
(21, 21, 'Rica Ederim Ferhat', 'tolga', '2020-01-13 02:04:32', '1'),
(22, 1, 'Paylaşımın için teşekkürler.', 'tolga', '2020-01-13 02:05:27', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `supports`
--

CREATE TABLE `supports` (
  `support_id` varchar(100) NOT NULL,
  `support_secure_code` varchar(100) NOT NULL,
  `support_title` varchar(250) NOT NULL,
  `support_content` varchar(500) NOT NULL,
  `image_path` varchar(250) NOT NULL,
  `support_email` varchar(100) NOT NULL,
  `support_date` datetime NOT NULL DEFAULT current_timestamp(),
  `support_status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `age` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `name`, `age`, `username`, `password`, `email`) VALUES
(1, 'Alan Turing', 25, 'muratsahin', '123456', 'murat.sahin@sibertime.com.tr'),
(2, 'Ferhat Çil', 25, 'ferhat', 'sifre123', 'ferhat.cil@sibertime.com.tr'),
(3, 'Tolga Uysal', 25, 'tolga', '123', 'tolga.uysal@sibertime.com.tr');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`account_number`);

--
-- Tablo için indeksler `bank_accounts_transfer`
--
ALTER TABLE `bank_accounts_transfer`
  ADD PRIMARY KEY (`request_id`);

--
-- Tablo için indeksler `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`newsletter_id`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Tablo için indeksler `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`post_comment_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `account_number` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- Tablo için AUTO_INCREMENT değeri `bank_accounts_transfer`
--
ALTER TABLE `bank_accounts_transfer`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `newsletter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7238;

--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `post_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
