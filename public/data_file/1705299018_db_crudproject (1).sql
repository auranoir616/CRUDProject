-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 04:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_crudproject`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `allpost`
-- (See below for the actual view)
--
CREATE TABLE `allpost` (
`id` bigint(20) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`title` varchar(255)
,`body` longtext
,`images` varchar(255)
,`user_id` bigint(20) unsigned
,`name` varchar(255)
,`username` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_post` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_post`, `body`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '6', 'asdas', '2', '2024-01-08 08:28:05', '2024-01-08 08:28:05'),
(2, '6', 'asd', '2', '2024-01-08 08:46:18', '2024-01-08 08:46:18'),
(3, '3', 'asdas', '1', '2024-01-08 21:50:55', '2024-01-08 21:50:55'),
(4, '1', 'sawi', '1', '2024-01-08 22:04:46', '2024-01-08 22:04:46'),
(5, '1', 'sawi', '1', '2024-01-08 22:04:46', '2024-01-08 22:04:46'),
(6, '7', 'asdasd', '1', '2024-01-08 22:09:23', '2024-01-08 22:09:23'),
(7, '17', 'asdasd', '1', '2024-01-09 00:19:19', '2024-01-09 00:19:19'),
(8, '18', 'ljh', '1', '2024-01-09 21:32:34', '2024-01-09 21:32:34'),
(9, '19', 'sdasdww', '1', '2024-01-09 23:10:35', '2024-01-09 23:10:35'),
(10, '16', 'asdwws', '1', '2024-01-09 23:10:47', '2024-01-09 23:10:47'),
(11, '17', 'asd', '1', '2024-01-09 23:11:39', '2024-01-09 23:11:39'),
(12, '17', 'asd', '1', '2024-01-09 23:11:55', '2024-01-09 23:11:55'),
(13, '15', 'sadawww', '1', '2024-01-09 23:15:32', '2024-01-09 23:15:32'),
(14, '19', 'esdf', '1', '2024-01-10 22:20:44', '2024-01-10 22:20:44'),
(15, '8', 'sadas', '4', '2024-01-11 22:23:05', '2024-01-11 22:23:05'),
(16, '17', 'asd', '4', '2024-01-11 22:43:45', '2024-01-11 22:43:45'),
(17, '21', 'ss', '4', '2024-01-11 23:25:40', '2024-01-11 23:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(6, 2, 6, '2024-01-08 10:41:36', '2024-01-08 10:41:36'),
(9, 2, 2, '2024-01-08 11:02:38', '2024-01-08 11:02:38'),
(10, 2, 3, '2024-01-08 11:04:25', '2024-01-08 11:04:25'),
(16, 1, 3, '2024-01-08 21:51:03', '2024-01-08 21:51:03'),
(18, 1, 6, '2024-01-08 22:03:41', '2024-01-08 22:03:41'),
(19, 1, 1, '2024-01-08 22:06:30', '2024-01-08 22:06:30'),
(20, 1, 7, '2024-01-08 22:09:19', '2024-01-08 22:09:19'),
(21, 3, 12, '2024-01-08 22:15:25', '2024-01-08 22:15:25'),
(26, 1, 8, '2024-01-09 20:32:33', '2024-01-09 20:32:33'),
(27, 1, 16, '2024-01-09 20:43:20', '2024-01-09 20:43:20'),
(29, 4, 20, '2024-01-09 23:21:01', '2024-01-09 23:21:01'),
(30, 1, 20, '2024-01-10 21:02:14', '2024-01-10 21:02:14'),
(31, 4, 1, '2024-01-11 22:43:31', '2024-01-11 22:43:31'),
(32, 4, 17, '2024-01-11 22:44:11', '2024-01-11 22:44:11'),
(34, 2, 9, '2024-01-12 10:07:16', '2024-01-12 10:07:16'),
(35, 1, 21, '2024-01-13 04:37:47', '2024-01-13 04:37:47'),
(36, 1, 2, '2024-01-13 04:38:10', '2024-01-13 04:38:10'),
(40, 4, 19, '2024-01-13 17:31:27', '2024-01-13 17:31:27'),
(41, 4, 23, '2024-01-13 17:31:29', '2024-01-13 17:31:29'),
(42, 4, 21, '2024-01-13 17:32:52', '2024-01-13 17:32:52'),
(43, 1, 19, '2024-01-14 14:48:23', '2024-01-14 14:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `id_chat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `recipient_id`, `content`, `id_chat`, `created_at`, `updated_at`) VALUES
(198, 1, 3, '1', '13', '2024-01-13 06:19:32', '2024-01-13 06:19:32'),
(199, 1, 3, '2', '13', '2024-01-13 06:19:34', '2024-01-13 06:19:34'),
(200, 1, 3, '3', '13', '2024-01-13 06:19:40', '2024-01-13 06:19:40'),
(201, 1, 3, '4', '13', '2024-01-13 06:19:42', '2024-01-13 06:19:42'),
(202, 1, 3, '5', '13', '2024-01-13 06:19:45', '2024-01-13 06:19:45'),
(203, 1, 3, '6', '13', '2024-01-13 06:19:48', '2024-01-13 06:19:48'),
(204, 1, 3, 's', '13', '2024-01-13 07:04:25', '2024-01-13 07:04:25'),
(205, 4, 1, 'p', '41', '2024-01-13 14:33:35', '2024-01-13 14:33:35'),
(206, 1, 4, 'y', '14', '2024-01-13 14:35:51', '2024-01-13 14:35:51'),
(207, 4, 2, 'ads', '42', '2024-01-13 17:32:02', '2024-01-13 17:32:02'),
(208, 1, 2, 'p', '12', '2024-01-14 14:42:47', '2024-01-14 14:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_23_052535_tambah_kolom_ke_tabel', 1),
(6, '2023_12_23_055924_create_table_post', 1),
(7, '2023_12_27_061725_tambah_kolom_gambar_user', 1),
(8, '2024_01_08_042505_comments', 1),
(9, '2024_01_08_051742_commentsedit', 1),
(10, '2024_01_08_143041_add__likes_table', 1),
(11, '2024_01_12_060537_table_messages', 2),
(12, '2024_01_08_170436_likes_table', 3),
(13, '2024_01_12_142926_drop_table_msg', 3),
(14, '2024_01_12_143704_add_new_messages_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `images` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `created_at`, `updated_at`, `title`, `body`, `images`, `user_id`) VALUES
(1, '2024-01-08 08:10:17', '2024-01-08 08:10:17', 'sawi', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704726617_sawi.jpg', 1),
(2, '2024-01-08 08:11:47', '2024-01-08 08:11:47', 'kangkung', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a elit nibh. Duis vel condimentum enim, id mollis velit. Nulla placerat bibendum ante. Phasellus et dictum urna. Sed tempus ut tortor a sodales. Aliquam ullamcorper porta arcu sed porttitor. Fusce sagittis faucibus risus id maximus. Ut elementum velit ut nisi aliquet euismod. Sed volutpat felis libero, et aliquam nulla laoreet ac.\r\n\r\nNunc convallis vitae arcu quis fermentum. Fusce eu ex rhoncus elit ornare sagittis non quis risus. Nam accumsan ante mi, sed pulvinar tellus malesuada vel. Aliquam tempor viverra eros a condimentum. Aliquam porta posuere nisi at pulvinar. In convallis lacinia arcu. Suspendisse semper suscipit mi.\r\n\r\nPellentesque ac velit et risus fringilla suscipit ac vel enim. Integer vitae quam euismod, pulvinar mauris dapibus, euismod metus. Fusce quis rhoncus sapien. Proin et leo non elit tincidunt molestie. Pellentesque non risus quis sem venenatis efficitur vitae eget mauris. Donec ligula nibh, venenatis sed metus ac, tempor dapibus mauris. Nunc ipsum tellus, ultrices sed scelerisque a, convallis id augue. Mauris maximus, felis molestie dictum imperdiet, tellus nunc efficitur enim, porta hendrerit lorem dui nec lorem. Pellentesque nisi augue, porttitor in fringilla et, convallis non nisl. Nulla ac imperdiet eros, pretium imperdiet massa. Aliquam non malesuada urna, et suscipit est. Ut nec hendrerit erat, ac faucibus tortor.\r\n\r\nFusce non neque vel enim malesuada molestie vel nec erat. Phasellus justo nisl, dictum ac enim sed, congue cursus urna. Proin suscipit mauris vitae tortor efficitur, nec elementum mi hendrerit. Vivamus malesuada, neque id ornare aliquam, dui erat tempus ex, nec pharetra leo elit nec lectus. Suspendisse tortor nibh, consequat nec commodo hendrerit, scelerisque id massa. Pellentesque eget arcu dapibus, aliquam eros vel, pulvinar mi. Praesent ultrices augue ac quam efficitur placerat in at diam. Nam scelerisque semper dolor tempor facilisis.\r\n\r\nMaecenas vitae elementum enim, quis ornare lectus. Morbi pretium, ligula at bibendum fringilla, ante mauris elementum arcu, et condimentum leo metus at nunc. Phasellus iaculis eleifend metus at suscipit. Curabitur in nisi pharetra, tempor purus vitae, porta elit. Nullam suscipit luctus congue. Morbi ultricies, diam porta placerat consectetur, dui lorem luctus libero, a hendrerit massa quam et ante. Curabitur velit elit, sagittis non erat quis, convallis ornare felis. Morbi aliquam, magna et tempus fermentum, nulla leo lacinia sapien, ac dictum dolor leo vel tellus. Praesent consequat tellus at tristique sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce velit erat, auctor eu massa non, iaculis accumsan nibh. Donec finibus mauris vel fermentum tristique. Etiam ut velit a mi dictum pellentesque. Cras non blandit tellus, eu mollis nulla.', '1704726707_kangkung.jpg', 1),
(6, '2024-01-08 08:13:09', '2024-01-08 08:13:09', 'kepiting', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a elit nibh. Duis vel condimentum enim, id mollis velit. Nulla placerat bibendum ante. Phasellus et dictum urna. Sed tempus ut tortor a sodales. Aliquam ullamcorper porta arcu sed porttitor. Fusce sagittis faucibus risus id maximus. Ut elementum velit ut nisi aliquet euismod. Sed volutpat felis libero, et aliquam nulla laoreet ac.\r\n\r\nNunc convallis vitae arcu quis fermentum. Fusce eu ex rhoncus elit ornare sagittis non quis risus. Nam accumsan ante mi, sed pulvinar tellus malesuada vel. Aliquam tempor viverra eros a condimentum. Aliquam porta posuere nisi at pulvinar. In convallis lacinia arcu. Suspendisse semper suscipit mi.\r\n\r\nPellentesque ac velit et risus fringilla suscipit ac vel enim. Integer vitae quam euismod, pulvinar mauris dapibus, euismod metus. Fusce quis rhoncus sapien. Proin et leo non elit tincidunt molestie. Pellentesque non risus quis sem venenatis efficitur vitae eget mauris. Donec ligula nibh, venenatis sed metus ac, tempor dapibus mauris. Nunc ipsum tellus, ultrices sed scelerisque a, convallis id augue. Mauris maximus, felis molestie dictum imperdiet, tellus nunc efficitur enim, porta hendrerit lorem dui nec lorem. Pellentesque nisi augue, porttitor in fringilla et, convallis non nisl. Nulla ac imperdiet eros, pretium imperdiet massa. Aliquam non malesuada urna, et suscipit est. Ut nec hendrerit erat, ac faucibus tortor.\r\n\r\nFusce non neque vel enim malesuada molestie vel nec erat. Phasellus justo nisl, dictum ac enim sed, congue cursus urna. Proin suscipit mauris vitae tortor efficitur, nec elementum mi hendrerit. Vivamus malesuada, neque id ornare aliquam, dui erat tempus ex, nec pharetra leo elit nec lectus. Suspendisse tortor nibh, consequat nec commodo hendrerit, scelerisque id massa. Pellentesque eget arcu dapibus, aliquam eros vel, pulvinar mi. Praesent ultrices augue ac quam efficitur placerat in at diam. Nam scelerisque semper dolor tempor facilisis.\r\n\r\nMaecenas vitae elementum enim, quis ornare lectus. Morbi pretium, ligula at bibendum fringilla, ante mauris elementum arcu, et condimentum leo metus at nunc. Phasellus iaculis eleifend metus at suscipit. Curabitur in nisi pharetra, tempor purus vitae, porta elit. Nullam suscipit luctus congue. Morbi ultricies, diam porta placerat consectetur, dui lorem luctus libero, a hendrerit massa quam et ante. Curabitur velit elit, sagittis non erat quis, convallis ornare felis. Morbi aliquam, magna et tempus fermentum, nulla leo lacinia sapien, ac dictum dolor leo vel tellus. Praesent consequat tellus at tristique sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce velit erat, auctor eu massa non, iaculis accumsan nibh. Donec finibus mauris vel fermentum tristique. Etiam ut velit a mi dictum pellentesque. Cras non blandit tellus, eu mollis nulla.', '1704726789_kepiting.jpg', 2),
(9, '2024-01-08 22:10:48', '2024-01-11 00:26:56', 'sawoaa', '111Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777048_sawo.webp', 1),
(10, '2024-01-08 22:11:22', '2024-01-08 22:11:22', 'ikan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777082_ikan.jpg', 2),
(11, '2024-01-08 22:11:34', '2024-01-08 22:11:34', 'apel', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777094_apel.png', 2),
(12, '2024-01-08 22:11:43', '2024-01-08 22:11:43', 'jambu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777103_jambu.png.webp', 2),
(13, '2024-01-08 22:11:53', '2024-01-08 22:11:53', 'melon', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777113_melon.webp', 2),
(14, '2024-01-08 22:12:03', '2024-01-08 22:12:03', 'rambutan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777123_rambutan.jpeg', 2),
(15, '2024-01-08 22:12:15', '2024-01-08 22:12:15', 'lobak', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777135_lobak.jpg', 2),
(16, '2024-01-08 22:14:20', '2024-01-08 22:14:20', 'duku', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777260_duku.jpg', 3),
(17, '2024-01-08 22:14:35', '2024-01-08 22:14:35', 'burung', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777275_burung.jpg', 3),
(18, '2024-01-08 22:14:51', '2024-01-08 22:14:51', 'pir', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777291_pir.webp', 3),
(19, '2024-01-08 22:15:12', '2024-01-08 22:15:12', 'wortel', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1704777311_wortel.jpg', 3),
(21, '2024-01-11 22:30:25', '2024-01-11 22:30:25', 'rambutan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1705037425_rambutan.jpeg', 4),
(23, '2024-01-13 16:23:21', '2024-01-13 16:23:21', 'judul', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1705163001_DN 2023-11-12 16-09-57 Sun.jpg', 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `profiledata`
-- (See below for the actual view)
--
CREATE TABLE `profiledata` (
`name` varchar(255)
,`username` varchar(255)
,`email` varchar(255)
,`Images_profile` varchar(255)
,`post_title` varchar(255)
,`post_images` varchar(255)
,`post_body` longtext
,`post_id` bigint(20) unsigned
,`comment_body` text
,`comment_id` bigint(20) unsigned
,`comment_id_post` varchar(255)
,`like_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `Images_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `Images_profile`) VALUES
(1, 'keong sawah', 'keongsawah@mail.com', NULL, '$2y$12$V2UB0gsML0ncy1FYLdD3Ge.KCoH1I0mIXxMmxmAPmC1O1Pq/FJrAm', NULL, '2024-01-08 08:08:33', '2024-01-11 01:11:02', 'sawahkeong', '1704960662_keong.jpg_UserEdited'),
(2, 'kucing gurun', 'kucingGurun@mail.com', NULL, '$2y$12$MlTKjSRraDrdnnA95wFyUecx0C8nRAzmcOPo6gLRNFxF609DpGtdq', NULL, '2024-01-08 08:09:48', '2024-01-08 08:09:48', 'kucinggurun', '1704726588_profile_picture_kucing.jpg'),
(3, 'sapi hutan', 'sapi@mail.com', NULL, '$2y$12$inHREFBTVc0bDP62FcLmUeLWy9T3oydb5fzld3SuNspfY9R7Y.3Xi', NULL, '2024-01-08 22:13:49', '2024-01-08 22:13:49', 'sapihut', '1704777228_profile_picture_sapi.jpg'),
(4, 'burung hantu', 'burung@mail.com', NULL, '$2y$12$ZGeDIwxiLdr3bidQtmhDTecCY8N7VN5GrkP1uiGZm86un5O89/8x6', NULL, '2024-01-09 22:23:25', '2024-01-09 22:23:25', 'burunghantu', '1704864204_profile_picture_428f3f7137a95a10f7926cc02a11f11869cb904e.jpg'),
(5, 'jeruj', 'jeruk@mail.com', NULL, '$2y$12$TLfUVA33e1aprocGyL3fmuyAPvUyLe9yLheFE5uB9Bh/Gl8Wt1S9O', NULL, '2024-01-11 22:17:00', '2024-01-11 22:17:00', 'jeruk1', '1705036620_profile_picture_jeruk.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `userscomments`
-- (See below for the actual view)
--
CREATE TABLE `userscomments` (
`username` varchar(255)
,`name` varchar(255)
,`id` bigint(20) unsigned
,`id_post` varchar(255)
,`body` text
,`user_id` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `allpost`
--
DROP TABLE IF EXISTS `allpost`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allpost`  AS SELECT `post`.`id` AS `id`, `post`.`created_at` AS `created_at`, `post`.`updated_at` AS `updated_at`, `post`.`title` AS `title`, `post`.`body` AS `body`, `post`.`images` AS `images`, `post`.`user_id` AS `user_id`, `users`.`name` AS `name`, `users`.`username` AS `username` FROM (`users` left join `post` on(`users`.`id` = `post`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `profiledata`
--
DROP TABLE IF EXISTS `profiledata`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profiledata`  AS SELECT `users`.`name` AS `name`, `users`.`username` AS `username`, `users`.`email` AS `email`, `users`.`Images_profile` AS `Images_profile`, `post`.`title` AS `post_title`, `post`.`images` AS `post_images`, `post`.`body` AS `post_body`, `post`.`id` AS `post_id`, `comment`.`body` AS `comment_body`, `comment`.`id` AS `comment_id`, `comment`.`id_post` AS `comment_id_post`, `likes`.`id` AS `like_id` FROM (((`users` join `post` on(`users`.`id` = `post`.`user_id`)) join `comment` on(`post`.`id` = `comment`.`id_post`)) join `likes` on(`users`.`id` = `likes`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `userscomments`
--
DROP TABLE IF EXISTS `userscomments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userscomments`  AS SELECT `users`.`username` AS `username`, `users`.`name` AS `name`, `comment`.`id` AS `id`, `comment`.`id_post` AS `id_post`, `comment`.`body` AS `body`, `comment`.`user_id` AS `user_id`, `comment`.`created_at` AS `created_at`, `comment`.`updated_at` AS `updated_at` FROM (`users` left join `comment` on(`users`.`id` = `comment`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_recipient_id_foreign` (`recipient_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
