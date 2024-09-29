CREATE DATABASE IF NOT EXISTS tiem_chung;
USE tiem_chung;

CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(500) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `role` INT(1) NOT NULL
);

--  admin@gmail.com | 123456

INSERT INTO admins (name, username, password, email, role) VALUES
('admin', "admin123", "$2y$10$opS3OxSmPlXTsDm.SBelUOyceR0QrttLbzaYJCxBGGhN8Yy2NLaCi", "admin@gmail.com", 0);

CREATE TABLE IF NOT EXISTS `vaccinations` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `vaccine` VARCHAR(255) NOT NULL,
    `country` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `price` INT,
    `quantity` INT,
    `status` TINYINT(4) DEFAULT 1,
    `delete` TINYINT(4) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS `phieukhamsangloc` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `serviceId` INT NOT NULL,
    `HoVaTen` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL NOT NULL,
    `NgaySinh` varchar(10) DEFAULT NULL,
    `GioiTinh` tinyint(4) DEFAULT 0,
    `CMTCCCD` varchar(20) DEFAULT NULL,
    `SoDienThoai` varchar(20) DEFAULT NULL,
    `Email` varchar(64) DEFAULT NULL,
    `SoTheBHYT` varchar(64) DEFAULT NULL,
    `DiaChiNoiO` varchar(512) DEFAULT NULL,
    `GhiChu` varchar(512) DEFAULT NULL,
    `file` VARCHAR(255) NOT NULL,
    `KetLuan` tinyint(4) NOT NULL,
    `delete` TINYINT(4) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS `phieutiemchung` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `PhieuKhamSangLocID` INT NOT NULL,
    `NgayHenTiem` varchar(10) DEFAULT NULL,
    `GioHenTiem` varchar(6) DEFAULT NULL,
    `TinhTrangXacNhan` tinyint(4) DEFAULT 0,
    `NgayCheckin` varchar(10) DEFAULT NULL,
    `delete` TINYINT(4) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS `hoadontiemchung` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `PhieuTiemChungID` TEXT NOT NULL,
    `NgayThanhToan` varchar(20) NOT NULL,
    `price` INT NOT NULL,
    `XacNhan` tinyint(4),
    `delete` TINYINT(4) DEFAULT 0
);

