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

INSERT INTO `vaccinations` (`name`, `vaccine`, `country`, `price`, `quantity`, `status`, `delete`) VALUES
('Bạch hầu, ho gà, uốn ván, bại liệt và viêm màng não mủ, viêm phổi do Hib', 'Pentaxim', 'Pháp', 795000, 100, 1, 0),
('Bạch hầu, ho gà, uốn ván, bại liệt, viêm màng não mủ, viêm phổi do Hib, viêm gan B', 'Infanrix Hexa (6in1)', 'Bỉ', 1015000, 120, 1, 0),
('Bạch hầu, ho gà, uốn ván, bại liệt, viêm màng não mủ, viêm phổi do Hib, viêm gan B', 'Hexaxim (6in1)', 'Pháp', 1048000, 50, 1, 0),
('Tiêu chảy cấp do Rota virus', 'Rotateq', 'Mỹ', 665000, 213, 1, 0),
('Tiêu chảy cấp do Rota virus', 'Rotarix', 'Bỉ', 825000, 432, 1, 0),
('Tiêu chảy cấp do Rota virus', 'Rotavin', 'Việt Nam', 490000, 123, 1, 0),
('Các bệnh do phế cầu', 'Synflorix', 'Bỉ', 1045000, 321, 1, 0),
('Các bệnh do phế cầu', 'Prevenar 13', 'Bỉ', 1290000, 245, 1, 0),
('Các bệnh do phế cầu', 'Pneumovax 23', 'Mỹ', 1450000, 634, 1, 0),
('Lao', 'BCG (lọ 1ml)', 'Việt Nam', 155000, 234, 1, 0),
('Viêm gan B người lớn', 'Gene Hbvax 1ml', 'Việt Nam', 220000, 432, 1, 0),
('Viêm gan B người lớn', 'Heberbiovac 1ml', 'Cu ba', 285000, 234, 1, 0),
('Viêm gan B trẻ em', 'Gene Hbvax 0.5ml', 'Việt Nam', 199000, 543, 1, 0),
('Viêm gan B trẻ em', 'Heberbiovac 0.5ml', 'Cu Ba', 265000, 10, 1, 0),
('Viêm màng não do não mô cầu nhóm B', 'Bexsero', 'Ý', 1750000, 40, 1, 0),
('Viêm màng não do não mô cầu nhóm B,C', 'VA-Mengoc-BC', 'Cu Ba', 315000, 78, 1, 0),
('Viêm màng não do não mô cầu nhóm A, C, Y, W-135', 'Menactra', 'Mỹ', 1370000, 95, 1, 0),
('Sởi', 'MVVac (Lọ 5ml)', 'Việt Nam', 396000, 142, 1, 0),
('Sởi', 'MVVac (Liều 0.5ml)', 'Việt Nam', 265000, 345, 1, 0),
('Sởi – Quai bị – Rubella', 'MMR II (3 in 1)', 'Mỹ', 445000, 765, 1, 0),
('Sởi – Quai bị – Rubella', 'Priorix', 'Bỉ', 495000, 1343, 1, 0),
('Thủy đậu', 'Varivax', 'Mỹ', 1085000, 324, 1, 0),
('Thủy đậu', 'Varilrix', 'Bỉ', 1085000, 543, 1, 0),
('Cúm', 'Vaxigrip Tetra 0.5ml', 'Pháp', 356000, 213, 1, 0),
('Cúm', 'Influvac Tetra 0.5ml', 'Hà Lan', 356000, 654, 1, 0),
('Cúm', 'Ivacflu-S 0.5ml', 'Việt Nam', 285000, 213, 1, 0),
('Ung thư cổ tử cung, ung thư hầu họng, sùi mào gà... do HPV (4 chủng)', 'Gardasil 0.5ml', 'Mỹ', 1790000, 423, 1, 0),
('Ung thư cổ tử cung, ung thư hầu họng, sùi mào gà... do HPV (9 chủng)', 'Gardasil 9 0.5ml', 'Mỹ', 2950000, 123, 1, 0),
('Sốt xuất huyết', 'Qdenga', 'Đức', 1390000, 312, 1, 0),
('Uốn ván', 'Vắc xin uốn ván hấp phụ (TT)', 'Việt Nam', 149000, 123, 1, 0),
('Uốn ván', 'Huyết thanh uốn ván (SAT)', 'Việt Nam', 175000, 23, 1, 0),
('Viêm não Nhật Bản', 'Imojev', 'Thái Lan', 875000, 435, 1, 0),
('Viêm não Nhật Bản', 'Jeev 3mcg/0.5ml', 'Ấn Độ', 399000, 321, 1, 0),
('Viêm não Nhật Bản', 'Jevax 1ml', 'Việt Nam', 198000, 231, 1, 0),
('Dại', 'Verorab 0.5ml (TB)', 'Pháp', 495000, 434, 1, 0),
('Dại', 'Verorab 0.5ml (TTD)', 'Pháp', 370000, 32, 1, 0),
('Dại', 'Abhayrab 0.5ml (TB)', 'Ấn Độ', 325000, 43, 1, 0),
('Dại', 'Abhayrab 0.5ml (TTD)', 'Ấn Độ', 250000, 64, 1, 0),
('Bạch hầu – Uốn ván – Ho gà', 'Adacel', 'Canada', 775000, 46, 1, 0),
('Bạch hầu – Uốn ván – Ho gà', 'Boostrix', 'Bỉ', 795000, 78, 1, 0),
('Bạch hầu – Ho gà – Uốn ván – Bại liệt', 'Tetraxim', 'Pháp', 645000, 98, 1, 0),
('Bạch hầu – Uốn ván', 'Uốn ván, bạch hầu hấp phụ (Td) – Lọ 0.5ml', 'Việt Nam', 225000, 53, 1, 0),
('Bạch hầu – Uốn ván', 'Uốn ván, bạch hầu hấp phụ (Td) - Liều', 'Việt Nam', 205000, 124, 1, 0),
('Viêm gan A + B', 'Twinrix', 'Bỉ', 690000, 534, 1, 0),
('Viêm gan A', 'Havax 0.5ml', 'Việt Nam', 255000, 23, 1, 0),
('Viêm gan A', 'Avaxim 80U', 'Pháp', 660000, 87, 1, 0),
('Thương hàn', 'Typhoid VI', 'Việt Nam', 265000, 95, 1, 0),
('Thương hàn', 'Typhim VI', 'Pháp', 390000, 54, 1, 0),
('Các bệnh do Hib', 'Quimi-Hib', 'Cu Ba', 315000, 67, 1, 0),
('Tả', 'Morcvax', 'Việt Nam', 165000, 54, 1, 0);

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

