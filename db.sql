CREATE TABLE `contacts` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `crm_id` VARCHAR(500),
    `name` TEXT NOT NULL,
    `email` VARCHAR(500),
    `phone` VARCHAR(500),
    `address` TEXT,
    `position` TEXT,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME
);

CREATE TABLE `leads` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `crm_id` VARCHAR(500),
    `name` TEXT NOT NULL,
    `transaction_stage` VARCHAR(500),
    `budget` VARCHAR(500),
    `contact_id` INT UNSIGNED,
    `crm_company_id` VARCHAR(500),
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME,
    FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
);

CREATE TABLE `roles` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `slug` VARCHAR(500),
    `permissions` VARCHAR(500) DEFAULT '{}',
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME
);

CREATE TABLE `role_users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED,
    `role_id` INT UNSIGNED,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
);
