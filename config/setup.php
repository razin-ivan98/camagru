<?php
    include_once "config/database.php";
    $pdo = new PDO($dsn, $db_user, $db_pass, $opt);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS base CHARACTER SET utf8 COLLATE utf8_general_ci");
    $pdo->exec("USE base");

    
  

    $avatars = "CREATE TABLE IF NOT EXISTS `avatars` (
        `user_id` int(11) NOT NULL,
        `image_name` char(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $comments = "CREATE TABLE IF NOT EXISTS `comments` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id` int(11) NOT NULL,
        `publish_id` int(11) NOT NULL,
        `text` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

   $comments_likes = "CREATE TABLE IF NOT EXISTS `comments_likes` (
        `comment_id` int(11) DEFAULT NULL,
        `user_id` int(11) DEFAULT NULL,
        `publish_id` int(11) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

 $dialogs = "CREATE TABLE IF NOT EXISTS `dialogs` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user1_id` int(11) NOT NULL,
        `user2_id` int(11) NOT NULL,
        `last_active` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;";

    $links = "CREATE TABLE IF NOT EXISTS `links` (
        `user_id` int(11) NOT NULL,
        `reason` varchar(64) NOT NULL,
        `link` varchar(64) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    $messages = "CREATE TABLE IF NOT EXISTS `messages` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id` int(11) NOT NULL,
        `dialog_id` int(11) NOT NULL,
        `message` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
        `date` datetime NOT NULL,
        `is_read` int(11) NOT NULL DEFAULT '0'
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $publishes = "CREATE TABLE IF NOT EXISTS `publishes` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id` int(11) NOT NULL,
        `image_name` char(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
        `description` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''''''
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $publishes_likes = "CREATE TABLE IF NOT EXISTS `publishes_likes` (
        `publish_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $users = "CREATE TABLE IF NOT EXISTS `users` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` char(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
        `password` char(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
        `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
        `confirmed` int(11) NOT NULL DEFAULT '0'
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $pdo->exec($users);
    $pdo->exec($comments);
    $pdo->exec($comments_likes);
    $pdo->exec($publishes_likes);
    $pdo->exec($publishes);
    $pdo->exec($dialogs);
    $pdo->exec($links);
    $pdo->exec($messages);
    $pdo->exec($avatars);
    $pdo = null;
?>