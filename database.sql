CREATE DATABASE IF NOT EXISTS pet_record_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE pet_record_db;

CREATE TABLE IF NOT EXISTS pets (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(30) NOT NULL,
    breed VARCHAR(100) NULL,
    age SMALLINT UNSIGNED NOT NULL,
    gender VARCHAR(20) NOT NULL,
    owner_name VARCHAR(120) NOT NULL,
    contact_number VARCHAR(30) NOT NULL,
    address TEXT NOT NULL,
    date_registered DATE NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    KEY pets_name_index (name),
    KEY pets_owner_name_index (owner_name),
    KEY pets_type_index (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;