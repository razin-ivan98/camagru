-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Sep 18, 2019 at 02:49 PM
-- Server version: 5.7.27
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `base`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `user_id` int(11) NOT NULL,
  `image_name` char(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`user_id`, `image_name`) VALUES
(27, 'avatar.gif'),
(28, '89667e3ef981e4e742d5c4475f49197a.jpg'),
(29, '7d2a74c93f00acd2c8b22cc0487e9cf6.png'),
(30, 'f34927df34192a15b6af21fcf3fd4bf3.jpg'),
(31, '128a61a93dbc4ac74077d4943df0acc1.jpg'),
(32, 'avatar.gif'),
(33, 'a1c42e607f125e272403ccd228956204.jpg'),
(34, '903b114bf7021a3eafc04599231187cc.jpg'),
(35, 'ac2c95f64c3bb087fe2269dfc0b2c59d.jpg'),
(36, '48a6c9c478723d0eacf2980c87a145d2.jpg'),
(37, 'avatar.gif'),
(38, '26d8d4724bd6119b6e3f4e177b8aa549.jpg'),
(39, 'avatar.gif'),
(40, 'avatar.gif'),
(41, '86c8f47cf8a381c46d271a649c316caa.png'),
(42, 'avatar.gif'),
(43, 'avatar.gif'),
(44, 'e4afe2a6643ebc59fa5f7f907116ea44.jpeg'),
(45, 'avatar.gif'),
(46, 'avatar.gif'),
(47, 'avatar.gif'),
(48, 'avatar.gif'),
(49, 'avatar.gif'),
(50, 'avatar.gif'),
(51, 'avatar.gif'),
(52, 'avatar.gif'),
(53, 'avatar.gif'),
(54, 'avatar.gif');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publish_id` int(11) NOT NULL,
  `text` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `publish_id`, `text`) VALUES
(3, 27, 55, 'very funny photo'),
(5, 28, 55, 'tremendously absurd'),
(9, 28, 31, 'so cute'),
(12, 30, 55, 'biba'),
(21, 32, 78, 'comment'),
(22, 32, 55, 'file clean git 42'),
(23, 32, 79, 'file clean git 42'),
(24, 32, 79, 'myyyy Instagram'),
(25, 32, 79, 'Like'),
(26, 27, 82, 'bro'),
(27, 34, 83, 'nice, i am loving Stalin. I love USSR and Stalin loves my'),
(28, 35, 31, 'Stupid russian bear. Fucking fuck!'),
(30, 35, 82, 'Tupoi kachok'),
(31, 36, 83, 'Yes, I am Stalin and I love you. would you like to go to the Gulag?'),
(32, 38, 87, 'Facepalm'),
(33, 38, 28, 'Nice cheeks'),
(36, 34, 94, 'cool'),
(42, 38, 113, 'как знать'),
(43, 41, 113, 'может потому что это не картинка?'),
(45, 44, 117, 'этом*'),
(46, 44, 117, 'у вас прогружается картинка?'),
(49, 48, 123, 'good job'),
(50, 48, 122, 'lol'),
(52, 27, 119, 'это FdF так то'),
(53, 27, 17877, 'и от js-инъекций <script>alert(\'js-injection!\');</script>'),
(54, 27, 17877, 'и от sql-инъекций '),
(55, 27, 17877, 'DROP TABLE test;');

-- --------------------------------------------------------

--
-- Table structure for table `comments_likes`
--

CREATE TABLE `comments_likes` (
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `publish_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments_likes`
--

INSERT INTO `comments_likes` (`comment_id`, `user_id`, `publish_id`) VALUES
(3, 27, 55),
(3, 28, 55),
(5, 28, 55),
(9, 27, 31),
(21, 32, 78),
(3, 32, 55),
(22, 32, 55),
(12, 32, 55),
(5, 32, 55),
(23, 32, 79),
(24, 32, 79),
(25, 32, 79),
(3, 33, 55),
(23, 28, 79),
(24, 28, 79),
(26, 34, 82),
(27, 27, 83),
(31, 34, 83),
(32, 38, 87),
(33, 38, 28),
(32, 27, 87),
(24, 27, 79),
(26, 27, 82),
(30, 27, 82),
(31, 33, 83),
(36, 33, 94),
(25, 33, 79),
(43, 41, NULL),
(42, 41, NULL),
(41, 41, NULL),
(42, 27, NULL),
(43, 27, NULL),
(49, 27, NULL),
(53, 51, NULL),
(54, 51, NULL),
(55, 51, NULL),
(49, 51, NULL),
(49, 54, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dialogs`
--

CREATE TABLE `dialogs` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `last_active` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `dialogs`
--

INSERT INTO `dialogs` (`id`, `user1_id`, `user2_id`, `last_active`) VALUES
(1, 27, 28, '2019-09-02 12:08:41'),
(2, 34, 27, '2019-09-01 22:54:40'),
(3, 34, 31, '2019-09-01 22:54:40'),
(4, 35, 34, '2019-09-01 22:54:40'),
(5, 38, 27, '2019-09-01 22:54:40'),
(6, 27, 31, '2019-09-01 22:54:40'),
(7, 39, 27, '2019-09-01 22:54:40'),
(8, 33, 27, '2019-09-01 23:16:19'),
(9, 41, 27, '2019-09-01 22:54:40'),
(10, 42, 29, '2019-09-01 22:54:40'),
(11, 42, 38, '2019-09-01 22:54:40'),
(12, 27, 43, '2019-09-01 23:21:30'),
(13, 27, 44, '2019-09-02 13:11:01'),
(14, 27, 45, '2019-09-02 12:07:28'),
(15, 28, 44, '2019-09-02 13:05:42'),
(16, 46, 44, '2019-09-02 16:23:41'),
(17, 27, 47, '2019-09-03 19:08:21'),
(18, 48, 27, '2019-09-04 17:33:23'),
(19, 27, 35, '2019-09-11 14:10:03'),
(20, 51, 27, '2019-09-15 16:16:23'),
(21, 27, 52, '2019-09-16 11:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `user_id` int(11) NOT NULL,
  `reason` varchar(64) NOT NULL,
  `link` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dialog_id` int(11) NOT NULL,
  `message` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `dialog_id`, `message`, `date`, `is_read`) VALUES
(42, 34, 2, 'he', '2019-08-24 21:52:00', 1),
(43, 34, 2, 'hi', '2019-08-24 21:52:09', 1),
(45, 34, 3, '', '2019-08-24 21:52:49', 0),
(46, 34, 3, 'hi', '2019-08-24 21:52:53', 0),
(50, 34, 2, 'hillo)', '2019-08-24 21:55:10', 1),
(51, 34, 2, 'you', '2019-08-24 21:55:19', 1),
(52, 34, 2, '!1234', '2019-08-24 21:55:27', 1),
(53, 34, 2, '!!!    2344ho', '2019-08-24 21:55:39', 1),
(54, 34, 2, '!          1234hi', '2019-08-24 21:55:57', 1),
(57, 34, 3, 'How do you do??', '2019-08-24 21:58:02', 0),
(58, 34, 3, '<input type=\"text\">', '2019-08-24 21:58:46', 0),
(59, 34, 3, 'write now', '2019-08-24 21:58:59', 0),
(60, 34, 2, '<input type=\"text\">', '2019-08-24 22:00:21', 1),
(61, 34, 2, '', '2019-08-24 22:00:22', 1),
(64, 27, 2, '<button><a href=\"http://abdulovhell.blogspot.com/p/blog-page.html\">нажми меня</button></a>', '2019-08-24 22:09:30', 0),
(65, 35, 4, 'Fucking stupid motherfucker', '2019-08-24 22:10:21', 0),
(66, 34, 4, 'Suck my dick', '2019-08-24 22:14:34', 0),
(67, 34, 4, '<input type=\"text\">', '2019-08-24 22:15:22', 0),
(68, 35, 4, 'Stupid cunt', '2019-08-24 22:17:43', 0),
(69, 27, 5, '', '2019-08-24 22:39:14', 1),
(70, 27, 5, 'nu privet', '2019-08-24 22:39:23', 1),
(71, 38, 5, 'Hi', '2019-08-24 22:39:57', 1),
(72, 27, 5, 'kak dela', '2019-08-24 22:40:16', 1),
(73, 27, 6, '', '2019-08-24 22:41:10', 0),
(74, 27, 6, 'a', '2019-08-24 22:41:11', 0),
(75, 38, 5, 'Good', '2019-08-24 22:41:30', 1),
(76, 38, 5, 'How are u', '2019-08-24 22:41:38', 1),
(77, 27, 5, 'fine', '2019-08-24 22:41:55', 1),
(78, 38, 5, 'Pdrfect', '2019-08-24 22:42:55', 1),
(79, 27, 5, 'what do you think about my site', '2019-08-24 22:43:32', 1),
(80, 38, 5, 'I like it', '2019-08-24 22:48:39', 1),
(81, 27, 5, 'Uri', '2019-08-25 06:25:06', 1),
(82, 27, 2, 'Good morning', '2019-08-25 06:26:57', 0),
(83, 27, 6, 'au', '2019-08-25 11:57:28', 0),
(84, 38, 5, 'Pgo', '2019-08-25 14:45:30', 1),
(85, 38, 5, 'Ogo', '2019-08-25 14:45:37', 1),
(86, 38, 5, 'Ogo', '2019-08-25 14:45:40', 1),
(87, 38, 5, 'Ogo', '2019-08-25 14:45:43', 1),
(88, 38, 5, 'Ogo', '2019-08-25 14:45:48', 1),
(89, 38, 5, 'Ogo', '2019-08-25 14:45:50', 1),
(90, 38, 5, 'Ogo', '2019-08-25 14:46:00', 1),
(91, 38, 5, 'Blin', '2019-08-25 14:46:13', 1),
(92, 38, 5, '6 utra', '2019-08-25 14:46:52', 1),
(93, 34, 2, 'привет', '2019-08-26 16:01:44', 1),
(94, 34, 2, 'долго делал ?', '2019-08-26 16:01:58', 1),
(95, 34, 2, 'на стене можно энтер нажать и сообщение отправить ', '2019-08-26 16:19:44', 1),
(96, 27, 7, '', '2019-08-26 17:14:33', 0),
(97, 27, 7, 'прив', '2019-08-26 17:14:40', 0),
(98, 27, 2, 'на стене да', '2019-08-26 17:15:37', 0),
(99, 27, 2, 'а тут пока что нет', '2019-08-26 17:15:46', 0),
(100, 27, 5, 'хм', '2019-08-26 17:19:51', 1),
(101, 27, 5, 'странно', '2019-08-26 17:19:56', 1),
(102, 27, 5, 'не в 6 вроде было', '2019-08-26 17:20:06', 1),
(103, 38, 5, 'Написано в 6', '2019-08-28 17:21:53', 1),
(104, 33, 8, 'Какие изменения вносишь в сайт?', '2019-08-29 06:40:25', 1),
(105, 33, 8, 'У тебя на сайте время неправильное.', '2019-08-29 06:59:35', 1),
(106, 33, 8, 'Сделай чтобы можно было отправлять на клавишу Enter.', '2019-08-29 07:01:05', 1),
(107, 33, 8, '', '2019-08-29 07:01:06', 1),
(108, 33, 8, '', '2019-08-29 07:01:12', 1),
(109, 33, 8, 'PC  по русски звучит ну как то не очень.', '2019-08-29 12:22:29', 1),
(110, 33, 8, 'сделай чтобы можно было посмотреть кто лайкнул', '2019-08-29 12:43:16', 1),
(111, 41, 9, 'привет', '2019-09-01 03:55:02', 1),
(112, 27, 9, 'hello', '2019-09-01 03:56:02', 0),
(113, 42, 11, 'Хай бро', '2019-09-01 16:41:50', 1),
(114, 38, 11, 'Привяо', '2019-09-01 16:42:29', 0),
(115, 27, 8, 'К', '2019-09-01 23:16:19', 1),
(116, 27, 12, 'Привет', '2019-09-01 23:21:30', 1),
(117, 27, 13, 'Привет', '2019-09-02 09:04:19', 1),
(118, 44, 13, 'привет', '2019-09-02 09:09:19', 1),
(119, 27, 13, '', '2019-09-02 09:09:31', 1),
(120, 27, 13, 'Как дела', '2019-09-02 09:09:36', 1),
(121, 44, 13, 'хорошо', '2019-09-02 09:09:52', 1),
(122, 44, 13, 'хорошо', '2019-09-02 09:09:59', 1),
(123, 44, 13, 'хорошо', '2019-09-02 09:09:59', 1),
(124, 27, 13, 'Видишь как', '2019-09-02 09:10:01', 1),
(125, 44, 13, 'а у тебя как', '2019-09-02 09:10:09', 1),
(126, 27, 13, 'В реальном времени подгружается', '2019-09-02 09:10:14', 1),
(127, 27, 13, 'Тоже )', '2019-09-02 09:10:26', 1),
(128, 44, 13, 'да по сто раз отправляется пхахха', '2019-09-02 09:10:27', 1),
(129, 27, 13, 'Лол', '2019-09-02 09:10:51', 1),
(130, 27, 13, 'У меня нет', '2019-09-02 09:10:58', 1),
(131, 44, 13, 'а наш диалог защищен?', '2019-09-02 09:12:50', 1),
(132, 27, 13, 'Неа', '2019-09-02 09:14:36', 1),
(133, 27, 13, 'Ну вернее защищен на самом простом уровне', '2019-09-02 09:15:16', 1),
(134, 27, 13, 'Ничего не шифруется', '2019-09-02 09:15:31', 1),
(135, 27, 14, 'Привет пес', '2019-09-02 12:03:47', 1),
(136, 45, 14, 'Хело, 3.14др', '2019-09-02 12:06:17', 1),
(137, 27, 14, 'Аякс', '2019-09-02 12:07:19', 1),
(138, 28, 15, 'hello, bibas', '2019-09-02 12:07:28', 1),
(139, 45, 14, 'Работает ', '2019-09-02 12:07:28', 1),
(140, 27, 1, 'Хехос', '2019-09-02 12:08:41', 1),
(141, 44, 15, 'хайлоу!', '2019-09-02 13:05:33', 1),
(142, 44, 15, 'хайлоу!', '2019-09-02 13:05:35', 1),
(143, 44, 15, 'хайлоу!', '2019-09-02 13:05:36', 1),
(144, 44, 15, 'хайлоу!', '2019-09-02 13:05:39', 1),
(145, 44, 15, 'хайлоу!', '2019-09-02 13:05:40', 1),
(146, 44, 15, 'хайлоу!', '2019-09-02 13:05:42', 1),
(147, 44, 13, 'а почему мне не приходят оповещения о сердечках?  ', '2019-09-02 13:06:20', 1),
(148, 44, 13, 'и мне перед каждым новым сообщением приходится удалять старое!  ', '2019-09-02 13:07:01', 1),
(149, 44, 13, 'а еще у меня время отправки сообщений неправильное', '2019-09-02 13:11:01', 1),
(150, 27, 17, 'hi kek', '2019-09-03 19:06:10', 1),
(151, 47, 17, 'kek youself ', '2019-09-03 19:07:28', 1),
(152, 47, 17, 'got some kekez?', '2019-09-03 19:07:48', 1),
(153, 27, 17, ')))', '2019-09-03 19:08:21', 1),
(154, 48, 18, 'hey', '2019-09-04 10:59:24', 1),
(155, 48, 18, 'hey', '2019-09-04 10:59:24', 1),
(156, 48, 18, 'hey', '2019-09-04 10:59:50', 1),
(157, 27, 18, 'привет', '2019-09-04 11:00:05', 1),
(158, 27, 18, 'сообщения должны появляться без перезагрузки страниы', '2019-09-04 11:00:30', 1),
(159, 27, 18, 'теперь должно появиться новое сообщение', '2019-09-04 11:01:27', 1),
(160, 27, 18, 'lol', '2019-09-04 17:33:22', 0),
(161, 27, 19, 'hi bro', '2019-09-11 14:10:03', 0),
(162, 51, 20, 'Привет', '2019-09-13 16:37:28', 1),
(163, 51, 20, 'Привет', '2019-09-13 16:37:30', 1),
(164, 27, 20, 'привет+', '2019-09-15 16:16:23', 0),
(165, 27, 21, 'Приветь', '2019-09-16 11:00:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `publishes`
--

CREATE TABLE `publishes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_name` char(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''''''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishes`
--

INSERT INTO `publishes` (`id`, `user_id`, `image_name`, `description`) VALUES
(28, 27, 'f8a1e78cfc556abd7077d988232c0651.jpg', ''),
(30, 28, 'd1f06e94b7c8081dbf5a6c499d563eca.jpg', ''),
(31, 29, '25b2916b5c49db617f52fa5ea48efee7.jpg', ''),
(55, 31, 'a181e03b6806b82252737bb7b54160d0.jpg', ''),
(78, 32, 'non', 'my publish'),
(79, 32, 'non', 'Something'),
(82, 34, '6fd0a67f62b7b0da7db79c106cb817ac.jpg', ''),
(83, 35, 'a7837bd6ac7b8c01c69be0eb72a856b0.jpg', ''),
(85, 34, '6a4a108cc5b199249ac698cbbab93076.jpg', ''),
(87, 34, 'e81a0fe9c0575963a38e0ea51adf391e.png', ''),
(94, 27, 'non', 'Всем привет. Теперь можно по-русски'),
(99, 27, 'non', 'Экспериментируем с дизайном'),
(101, 33, 'd21c985a77e1fc07710489ae31b1234d.jpg', ''),
(102, 33, 'non', 'Слава Україні'),
(109, 27, 'non', 'Сайт тестируется. Многие разделы и функции недоступны'),
(110, 28, 'non', 'ля, родная помойка'),
(111, 28, '1d52be5e7ba55a7d4008d88009299742.pdf', ''),
(112, 28, 'bc251bf188ddf80c962476f0f3c8fed8.pdf', ''),
(113, 28, '1b786fc60663892993d3f1e004b02b1c.pdf', 'почему пдф с моей книгой не отображается?'),
(114, 42, '580b17a79759bfb4ffd1218d7de53cea.jpg', 'Подмосковье прекрасно :)'),
(115, 27, 'non', 'охоххохохохохохохохо'),
(116, 27, 'non', 'Сайт полностью функционален. Лайки, комменты, загрузка аватарки, диалоги'),
(117, 44, '3c7bdef86d87beb694af1fbb0a1d72a1.jpeg', 'Всем приветик в этой 4атике с:'),
(118, 44, 'non', 'а как поменять смайлик?'),
(119, 45, 'b40e18bf2d8ddacaa287eb79b825c823.jpeg', 'RTv0.1'),
(120, 44, 'non', 'желаю админу закончить 3-ий класс'),
(122, 47, '8055b44f8be181881116777e3b0c0962.png', ''),
(123, 27, 'b494a401a180adc3662af90ee78c5314.gif', 'работают ли гифки'),
(17874, 28, 'non', '<h1>BIBA</h1>'),
(17875, 44, 'd5495450f29f3fd4aa704c375ffcd078.gif', ''),
(17876, 27, 'non', 'баг с картинками поправлен'),
(17877, 27, 'non', '<h1>Защищено от HTML-инъекций</h1>'),
(17878, 51, 'non', 'Ииииигого'),
(17883, 27, '852d9c44b8ba9a3370657f630f52dca2.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `publishes_likes`
--

CREATE TABLE `publishes_likes` (
  `publish_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishes_likes`
--

INSERT INTO `publishes_likes` (`publish_id`, `user_id`) VALUES
(30, 28),
(28, 28),
(30, 30),
(28, 30),
(31, 29),
(30, 29),
(28, 29),
(31, 30),
(28, 31),
(31, 27),
(55, 27),
(31, 28),
(74, 30),
(55, 28),
(78, 32),
(79, 32),
(55, 33),
(28, 33),
(79, 28),
(82, 27),
(55, 35),
(83, 34),
(83, 35),
(55, 34),
(28, 34),
(55, 38),
(31, 38),
(94, 27),
(94, 34),
(85, 27),
(102, 27),
(94, 33),
(102, 33),
(113, 41),
(101, 41),
(99, 41),
(85, 41),
(83, 41),
(114, 42),
(114, 38),
(114, 41),
(114, 27),
(116, 27),
(115, 27),
(116, 44),
(102, 44),
(114, 33),
(117, 33),
(118, 33),
(119, 27),
(122, 47),
(122, 27),
(123, 48),
(122, 48),
(123, 50),
(122, 50),
(94, 50),
(28, 50),
(123, 27),
(559, 27),
(7878989, 27),
(123, 44),
(17874, 27),
(17874, 28),
(118, 44),
(17877, 51),
(17876, 51),
(17875, 51),
(17874, 51),
(123, 51),
(122, 51),
(55, 51);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `vbdfbv` int(11) NOT NULL,
  `fbfb` int(11) NOT NULL,
  `dfb` int(11) NOT NULL,
  `dfbb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `name` char(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` char(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `confirmed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `confirmed`) VALUES
(00000000027, 'Ivan', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'razin-ivan98@yandex.ru', 1),
(00000000028, 'EvgeniyPonasenkov', '0b8ef32d0a0f144dc33d9c3eb2725a62', 'razin-ivan98@yandex.ru', 1),
(00000000029, 'irina', 'e807f1fcf82d132f9bb018ca6738a19f', 'none', 0),
(00000000030, 'pupalupa', 'b49af1c38353da751daa03311e05abea', 'none', 0),
(00000000031, 'ksenia9898', '0f9084be6fa488525e562d8ccd1576b4', 'none', 0),
(00000000032, 'login', '5f4dcc3b5aa765d61d8327deb882cf99', 'none', 0),
(00000000033, 'leha', '256f656bbb1387836fa231732694eecc', 'none', 0),
(00000000034, 'Pain', 'a5eac69786b5be2ce6f21c702e8eb6bd', 'none', 0),
(00000000035, 'Sher', '074b62fb6c21b84e6b5846e6bb001f67', 'none', 0),
(00000000036, 'Joseph Stalin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'none', 0),
(00000000038, 'Pompilius', '262d4e4ee9bc96dba48864188c06dba7', 'none', 0),
(00000000039, 'biba', '2cce0ec300cfe8dd3024939db0448893', 'none', 0),
(00000000040, 'Batua', 'b26986ceee60f744534aaab928cc12df', 'none', 0),
(00000000041, 'new', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'none', 0),
(00000000042, 'Xeax', '7216fa74447edff86762b2816d8993e8', 'none', 0),
(00000000043, 'troubleveryday', '15cb8857be0d84c077215815c0406b7a', 'none', 0),
(00000000044, 'comtessekowar', '81dc9bdb52d04dc20036dbd8313ed055', 'none', 0),
(00000000045, 'mishania', '9ae883bc3c5ec23fdf8f176d4c7830fc', 'none', 0),
(00000000046, 'moluna', 'd93591bdf7860e1e4ee2fca799911215', 'none', 0),
(00000000047, 'kek', '202cb962ac59075b964b07152d234b70', 'none', 0),
(00000000048, 'shishkina', '97b5a84ab9b9cb62c14863893db730a6', 'none', 0),
(00000000049, 'adminvasheypomoiki', 'e03e4bc5014692f336b840c48b8bd3af', 'none', 0),
(00000000050, 'Madina', '17c81651bebdf4f3839f2153f5305a3e', 'none', 0),
(00000000051, 'pshenichnaia.anna 200', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'none', 0),
(00000000052, 'nanar_one', 'afdc722550a50c31a3920fd25cdc6f05', 'none', 0),
(00000000053, 'account', '961a26a41a0b4e38078426833bc72764', 'none', 0),
(00000000054, '123', '202cb962ac59075b964b07152d234b70', 'razin-ivan98@yandex.ru', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `Индекс 1` (`id`);

--
-- Indexes for table `dialogs`
--
ALTER TABLE `dialogs`
  ADD KEY `id` (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD KEY `id` (`id`);

--
-- Indexes for table `publishes`
--
ALTER TABLE `publishes`
  ADD KEY `Индекс 1` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `Индекс 1` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `dialogs`
--
ALTER TABLE `dialogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `publishes`
--
ALTER TABLE `publishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17884;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
