-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 06, 2025 lúc 04:40 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lichdatkham`
--
CREATE DATABASE IF NOT EXISTS `lichdatkham` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lichdatkham`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bacsi`
--

CREATE TABLE `bacsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `gioitinh` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `id_coso` bigint(20) UNSIGNED NOT NULL,
  `id_chuyenkhoa` bigint(20) UNSIGNED NOT NULL,
  `hocham` varchar(255) NOT NULL,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `hinhanh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bacsi`
--

INSERT INTO `bacsi` (`id`, `hoten`, `gioitinh`, `diachi`, `id_coso`, `id_chuyenkhoa`, `hocham`, `trangthai`, `hinhanh`, `created_at`, `updated_at`) VALUES
(1, 'Đào Nguyễn Trung Luân', 'Nam', 'TP.HCM', 1, 1, 'ThS BS.', 1, 'upload/bacsi/1745393541.png', '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(2, 'Hoàng Nguyễn Anh Tuấn', 'Nam', 'TP.HCM', 1, 1, 'ThS BS.', 1, 'upload/bacsi/1745393889.png', '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(3, 'Huỳnh Quốc Bảo', 'Nam', 'TP.HCM', 1, 1, 'BS CKII.', 1, 'upload/bacsi/1745394125.png', '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(4, 'Lê Tường Viễn', 'Nam', 'TP.HCM', 1, 1, 'BS CKII.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(5, 'Đỗ Hữu Thành', 'Nam', 'TP.HCM', 1, 2, 'ThS BS.', 1, 'upload/bacsi/1745394704.png', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(6, 'Nguyễn Ngọc Hoành Mỹ Tiên', 'Nữ', 'TP.HCM', 1, 2, 'BS CKII.', 1, 'upload/bacsi/1745395115.png', '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(7, 'Nguyễn Thị Minh Ngọc', 'Nữ', 'TP.HCM', 1, 2, 'BS CKII.', 1, 'upload/bacsi/1745395420.png', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(8, 'Trịnh Thị Bích Hà', 'Nữ', 'TP.HCM', 1, 2, 'ThS BS.', 1, 'upload/bacsi/1745395706.png', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(9, 'Đinh Huỳnh Tố Hương', 'Nữ', 'TP.HCM', 1, 3, 'ThS BS.', 1, 'upload/bacsi/1746017746.png', '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(10, 'Nguyễn Bá Thắng', 'Nam', 'TP.HCM', 1, 3, 'TS BS.', 1, 'upload/bacsi/1746017888.png', '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(11, 'Phạm Thành Trung', 'Nam', 'TP.HCM', 1, 3, 'ThS BS.', 1, 'upload/bacsi/1746018121.png', '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(12, 'Phạm Thị Ngọc Quyên', 'Nam', 'TP.HCM', 1, 3, 'BS CKII.', 1, 'upload/bacsi/1746018295.png', '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(13, 'Lê Minh Phúc', 'Nữ', 'TP.HCM', 1, 4, 'BS CKI.', 1, 'upload/bacsi/default-avatar-nu.png', '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(14, 'Lê Thái Vân Thanh', 'Nữ', 'TP.HCM', 1, 4, 'PGS TS BS.', 1, 'upload/bacsi/default-avatar-nu.png', '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(15, 'Lê Vi Anh', 'Nữ', 'TP.HCM', 1, 4, 'BS CKII.', 1, 'upload/bacsi/default-avatar-nu.png', '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(16, 'Ngô Anh Tuấn', 'Nam', 'TP.HCM', 1, 4, 'ThS BS.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(17, 'Bùi Đại Lịch', 'Nam', 'TP.HCM', 2, 5, 'TS BS.', 1, 'upload/bacsi/1746019515.png', '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(18, 'Huỳnh Minh Sang', 'Nam', 'TP.HCM', 2, 5, 'BS CKII.', 1, 'upload/bacsi/1746019764.jpg', '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(19, 'Ngô Thanh Bình', 'Nam', 'TP.HCM', 2, 5, 'PGS TS BS.', 1, 'upload/bacsi/1746019987.png', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(20, 'Nguyễn Thị Thu Ba', 'Nữ', 'TP.HCM', 2, 5, 'PGS TS BS.', 1, 'upload/bacsi/1746020205.png', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(21, 'Lê Ngọc Diệp', 'Nữ', 'TP.HCM', 2, 6, 'PGS TS BS.', 1, 'upload/bacsi/default-avatar-nu.png', '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(22, 'Nguyễn Thị Ngọc Mỹ', 'Nữ', 'TP.HCM', 2, 6, 'ThS BS.', 1, 'upload/bacsi/default-avatar-nu.png', '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(23, 'Trần Thị Thanh Mai', 'Nữ', 'TP.HCM', 2, 6, 'ThS BS.', 1, 'upload/bacsi/1746020954.png', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(24, 'Võ Quang Đỉnh', 'Nam', 'TP.HCM', 2, 6, 'ThS BS.', 1, 'upload/bacsi/1746021100.png', '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(25, 'Hồ Xuân Dũng', 'Nam', 'TP.HCM', 2, 7, 'BS CKII.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(26, 'Dương Bá Lập', 'Nam', 'TP.HCM', 2, 8, 'TS BS.', 1, 'upload/bacsi/1746021582.png', '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(27, 'Nguyễn Hải Sơn', 'Nam', 'TP.HCM', 2, 8, 'ThS BS.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(28, 'Nguyễn Phát Đạt', 'Nam', 'TP.HCM', 2, 8, 'ThS BS.', 1, 'upload/bacsi/1746021894.png', '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(29, 'Nguyễn Văn Hải', 'Nam', 'TP.HCM', 2, 8, 'PGS TS BS.', 1, 'upload/bacsi/1746022117.png', '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(30, 'Dương Thị Ngọc Lan', 'Nữ', 'TP.HCM', 3, 9, 'ThS BS.', 1, 'upload/bacsi/default-avatar-nu.png', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(31, 'Bùi Phạm Minh Mẫn', 'Nam', 'TP.HCM', 3, 10, 'ThS BS.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(32, 'Huỳnh Tấn Vũ', 'Nam', 'TP.HCM', 3, 10, 'BS CKII.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(33, 'Trần Thu Nga', 'Nam', 'TP.HCM', 3, 11, 'ThS BS.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(34, 'Nguyễn Thái Dương', 'Nam', 'TP.HCM', 3, 12, 'ThS BS.', 1, 'upload/bacsi/default-avatar-nam.png', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(35, 'Nguyễn Thị Cẩm Nhung', 'Nữ', 'TP HCM', 4, 13, 'BS CKI.', 1, 'upload/bacsi/default-avatar-nu.png', '2025-05-06 01:14:55', '2025-05-06 01:14:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `benhnhan`
--

CREATE TABLE `benhnhan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `hoten` varchar(255) NOT NULL,
  `sodienthoai` varchar(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `ngaysinh` date NOT NULL,
  `cccd` varchar(12) NOT NULL,
  `gioitinh` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `benhnhan`
--

INSERT INTO `benhnhan` (`id`, `id_user`, `hoten`, `sodienthoai`, `diachi`, `ngaysinh`, `cccd`, `gioitinh`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 4, 'Nguyễn Thành Phát', '0912345678', 'An Giang', '2003-03-01', '012345678910', 'Nam', NULL, '2025-04-23 08:46:28', '2025-04-23 08:46:28'),
(2, 4, 'Nguyễn Thị Cẩm Nhung', '0912345679', 'An Giang', '2003-02-23', '012345678911', 'Nữ', NULL, '2025-04-23 08:48:45', '2025-04-23 08:48:45'),
(3, 4, 'Phạm Thị Ánh Nguyệt', '0912345670', 'An Giang', '2003-09-02', '012345678912', 'Nữ', NULL, '2025-04-23 08:50:53', '2025-04-23 08:50:53'),
(4, 4, 'Võ Thành Đạt', '0912345671', 'An Giang', '2003-03-08', '012345678913', 'Nam', NULL, '2025-04-23 08:54:43', '2025-04-23 08:54:43'),
(5, 6, 'Nguyễn Thị Minh Ngọc', '01234567800', 'An Giang', '2005-07-08', '012345678915', 'Nữ', NULL, '2025-04-30 14:34:56', '2025-04-30 14:34:56'),
(6, 6, 'Lê Thái Vân Thanh', '01234567801', 'An Giang', '2006-07-28', '012345678916', 'Nữ', NULL, '2025-04-30 14:38:20', '2025-04-30 14:38:20'),
(7, 6, 'Mai Ngọc Quyên', '01234567802', 'An Giang', '2003-12-27', '012345678917', 'Nữ', NULL, '2025-04-30 14:39:35', '2025-04-30 14:39:35'),
(8, 6, 'Phan Triều Vỹ', '01234567803', 'An Giang', '2004-10-26', '012345678918', 'Nam', NULL, '2025-04-30 14:44:34', '2025-04-30 14:44:34'),
(9, 6, 'Bùi Thị Kim', '01234567804', 'An Giang', '1996-12-30', '012345678919', 'Nữ', NULL, '2025-04-30 14:47:45', '2025-04-30 14:47:45'),
(10, 7, 'Nguyễn Thắng', '01234567805', 'TP.HCM', '2002-06-27', '012345678920', 'Nam', NULL, '2025-04-30 14:56:40', '2025-04-30 14:56:40'),
(11, 7, 'Lê Thị Diệp', '01234567806', 'An Giang', '1996-09-05', '012345678921', 'Nữ', NULL, '2025-04-30 14:58:11', '2025-04-30 14:58:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyenkhoa`
--

CREATE TABLE `chuyenkhoa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_coso` bigint(20) UNSIGNED NOT NULL,
  `tenkhoa` varchar(255) NOT NULL,
  `giakham` int(11) NOT NULL,
  `mota` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyenkhoa`
--

INSERT INTO `chuyenkhoa` (`id`, `id_coso`, `tenkhoa`, `giakham`, `mota`, `created_at`, `updated_at`) VALUES
(1, 1, 'BỆNH LÝ CỘT SỐNG', 150000, NULL, '2025-04-23 07:10:48', '2025-04-23 07:10:48'),
(2, 1, 'CHĂM SÓC GIẢM NHẸ', 150000, NULL, '2025-04-23 07:11:15', '2025-04-23 07:11:15'),
(3, 1, 'CHUYÊN GIA THẦN KINH', 300000, NULL, '2025-04-23 07:11:35', '2025-04-23 07:11:35'),
(4, 1, 'DA LIỄU', 150000, NULL, '2025-04-23 07:12:16', '2025-04-23 07:12:16'),
(5, 2, 'KHÁM CHỨC NĂNG HÔ HẤP', 150000, NULL, '2025-04-23 07:15:37', '2025-04-23 07:15:37'),
(6, 2, 'KHÁM DA LIỄU', 150000, NULL, '2025-04-23 07:16:50', '2025-04-23 07:16:50'),
(7, 2, 'KHÁM ĐIỀU TRỊ VẾT THƯƠNG', 150000, NULL, '2025-04-23 07:17:30', '2025-04-23 07:17:30'),
(8, 2, 'KHÁM HẬU MÔN - TRỰC TRÀNG', 150000, NULL, '2025-04-23 07:18:11', '2025-04-23 07:18:11'),
(9, 3, 'KHÁM DINH DƯỠNG', 150000, NULL, '2025-04-23 07:20:01', '2025-04-23 07:20:01'),
(10, 3, 'NỘI TỔNG QUÁT', 150000, NULL, '2025-04-23 07:20:31', '2025-04-23 07:20:31'),
(11, 3, 'DA - THẨM MỸ YHCT', 150000, NULL, '2025-04-23 07:21:18', '2025-04-23 07:21:18'),
(12, 3, 'NHI -YHCT', 150000, NULL, '2025-04-23 07:21:58', '2025-04-23 07:21:58'),
(13, 4, 'CƠ XƯƠNG KHỚP', 220000, NULL, '2025-04-23 07:25:04', '2025-04-23 07:25:04'),
(14, 4, 'DA LIỄU', 220000, NULL, '2025-04-23 07:25:37', '2025-04-23 07:25:37'),
(15, 4, 'HÔ HẤP', 220000, NULL, '2025-04-23 07:26:41', '2025-04-23 07:26:41'),
(16, 4, 'NGOẠI CHẤN THƯƠNG', 220000, NULL, '2025-04-23 07:27:51', '2025-04-23 07:27:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coso`
--

CREATE TABLE `coso` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tencoso` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sodienthoai` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mota` text DEFAULT NULL,
  `noidung` text DEFAULT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coso`
--

INSERT INTO `coso` (`id`, `tencoso`, `diachi`, `sodienthoai`, `email`, `mota`, `noidung`, `hinhanh`, `created_at`, `updated_at`) VALUES
(1, 'Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1', '215 Hồng Bàng, Phường 11, Quận 5, TP.HCM', '02838554260', 'bvdhyd@umc.edu.vn', '<p>Sự nghiêm túc, chuyên nghiệp và tận tâm trong cách làm việc của đội ngũ y tế tại Bệnh viện Đại học Y Dược TP.HCM cơ sở 1 đã xây dựng một độ uy tín và sự tin cậy vững chắc trong cộng đồng. Với hơn 27 năm kinh nghiệm trong lĩnh vực chăm sóc sức khỏe, Bệnh viện đã trở thành biểu tượng của chất lượng y tế không chỉ hàng đầu tại Thành phố Hồ Chí Minh mà còn trên toàn quốc.</p>', '<h2><strong>Tìm hiểu thông tin về Bệnh viện Đại Học Y Dược Tp HCM:</strong></h2><p>Bệnh Viện Đại Học Y Dược Thành Phố Hồ Chí Minh - Cơ Sở 1, tọa lạc tại quận 5, Thành phố Hồ Chí Minh, là một trong những trung tâm y tế uy tín và đáng tin cậy nhất trong cộng đồng. Với tầm nhìn và phương châm \"Thấu hiểu nỗi đau – Niềm tin của bạn\", bênh viện đã xây dựng một sứ mệnh chăm sóc sức khỏe với sự tận tâm và chất lượng cao.</p><h2><strong>Tổng Quan Bệnh Viện</strong></h2><p>Bệnh Viện Đại Học Y Dược Thành phố Hồ Chí Minh có 3 cơ sở, với trụ sở chính nằm tại 215 Hồng Bàng, P.11, Q.5. Từ năm 2013, bệnh viện đã mở rộng tòa nhà 17 tầng để đáp ứng nhu cầu khám ngoại trú và điều trị nội trú tại bệnh viện. Đây là tòa nhà đạt tiêu chuẩn của bệnh viện quốc tế, mang lại môi trường khám chữa bệnh tiện nghi, xanh – sạch – đẹp, an ninh cho bệnh nhân và gia đình.</p><p>Mỗi năm, bệnh viện tiếp nhận trung bình hơn 2 triệu lượt người khám ngoại trú (khoảng 7.000 người khám/ngày), điều trị nội trú cho khoảng 55.000 người, và thực hiện phẫu thuật cho khoảng 30.000 trường hợp.</p><h2><strong>Chất Lượng Và Tầm Nhìn</strong></h2><p>Bệnh Viện Đại Học Y Dược Thành phố Hồ Chí Minh luôn nỗ lực phát huy những giá trị cốt lõi bền vững, gồm tiên phong trong điều trị, nghiên cứu khoa học, đào tạo và quản trị; thấu hiểu nỗi đau về thể xác lẫn tinh thần của người bệnh để đưa ra những giải pháp điều trị tối ưu; giữ vững sự chuẩn mực của người thầy giáo – thầy thuốc; quản lý chất lượng và đảm bảo an toàn cho người bệnh và nhân viên y tế.</p><h2><strong>Phục Vụ và Phát Triển</strong></h2><p>Là một bệnh viện của trường đại học, Bệnh viện Đại Học Y Dược Thành phố Hồ Chí Minh không chỉ tập trung vào việc cải thiện chất lượng chuyên môn và dịch vụ y tế, mà còn mong muốn mỗi người dân khi đến khám chữa bệnh luôn nhận được chất lượng dịch vụ y tế tốt nhất và vượt sự mong đợi.</p><p>Mục tiêu sắp tới của bệnh viện là xây dựng hệ thống trung tâm chuyên khoa sâu đạt chuẩn quốc tế, áp dụng những kỹ thuật hiện đại trong khám và điều trị, đồng thời trở thành môi trường đào tạo nhân tài cho ngành Y tế và chuyển giao mô hình quản lý tới các bệnh viện có nhu cầu.</p><h2><strong>Chính Sách Chất Lượng</strong></h2><p>Chính sách chất lượng của Bệnh viện Đại Học Y Dược Thành phố Hồ Chí Minh được tóm gọn và định hình bởi bốn yếu tố quan trọng: An Toàn, Hiệu Quả, Cải Tiến Liên Tục, và Phát Triển Bền Vững. Bệnh viện cam kết đảm bảo an toàn cho người bệnh và nhân viên y tế, sử dụng các kỹ thuật hiện đại để cải thiện hiệu quả, luôn nâng cao chất lượng dịch vụ, và phát triển bền vững qua thời gian.</p><h2><strong>Phòng - Trung Tâm - Khoa - Đơn Vị</strong></h2><p>Dưới đây là danh sách các Phòng, Trung tâm, Khoa, Khoa Cận Lâm sàng và Đơn vị trong Bệnh viện Đại Học Y Dược TP.HCM. Các phòng và đơn vị này cung cấp các dịch vụ y tế đa dạng và chuyên sâu để đáp ứng nhu cầu của bệnh nhân:</p><p><i><strong>Phòng</strong></i><strong>:</strong> Kế hoạch tổng hợp, Tổ chức cán bộ, Điều dưỡng, Tài chính kế toán, Khoa học và Đào tạo, Công nghệ thông tin, Vật tư thiết bị, Công tác xã hội, Hành chính, Quản lý chất lượng, Quản trị tòa nhà, Bảo hiểm y tế, Truyền thông.</p><p><i><strong>Trung tâm</strong></i><strong>:</strong> Huấn luyện và Phẫu thuật Nội soi, Khoa học thần kinh, Tim mạch, Ung thư, Nghiên cứu lâm sàng.</p><p><i><strong>Khoa Lâm sàng</strong></i><strong>:</strong> Cấp cứu, Phục hồi chức năng, Khám bệnh, Ngoại Tiêu hóa, Nội Tiết, Ngoại Gan - Mật - Tụy, Nội Tim mạch, Hậu môn - Trực tràng, Tim mạch can thiệp, Gây mê - Hồi sức, Thần kinh, Hồi sức tích cực, Tai - Mũi - Họng, Lão - Chăm sóc giảm nhẹ, Phụ sản, Tiết niệu, Tiêu hóa, Ngoại Thần kinh, Chấn thương chỉnh hình, Phẫu thuật Hàm Mặt - Răng Hàm Mặt, Hóa trị ung thư, Lồng ngực - Mạch máu, Nội thận - thận nhân tạo, Mắt, Nội cơ xương khớp, Tạo hình Thẩm mỹ, Da liễu - Thẩm mỹ da, Phẫu thuật tim mạch người lớn, Niệu học chức năng, Tuyến vú, Khám sức khỏe theo yêu cầu, Sơ sinh.</p><p><i><strong>Khoa Cận Lâm sàng</strong></i><strong>:</strong> Chẩn đoán hình ảnh, Nội soi, Thăm dò chức năng hô hấp, Xét nghiệm, Kiểm soát nhiễm khuẩn, Dược, Giải phẫu bệnh, Vi sinh, Dinh dưỡng - Tiết Chế, Y học hạt nhân.</p><p><i><strong>Các Đơn vị</strong></i><strong>:</strong> Can thiệp mạch máu tạng, Điều trị Đau, Dị ứng - Miễn dịch lâm sàng, Hồi sức Ngoại thần kinh, Trị liệu tế bào và Y học tái tạo, Phẫu thuật bệnh lý cột sống và Thần kinh ngoại biên, Bệnh giới tính nam, Can thiệp nội mạch thần kinh, Nhịp tim học, Quản lý Đái tháo đường, Hình ảnh tim mạch, Bàn chân Đái tháo đường, Can thiệp nội mạch, Ung thư Gan Mật và Ghép gan, Huấn luyện siêu âm tim, Rối loạn vận động, Rối loạn giấc ngủ, Đột quỵ, Điều trị khe hở môi vòm miệng, Tâm lý lâm sàng, Chẩn đoán trước sinh, Trí nhớ và Sa sút trí tuệ, Sàn - Đáy chậu, Đào tạo liên tục, Bệnh viêm ruột mạn, Rối loạn vận động tiêu hóa, Hỗ trợ sinh sản, Quản lý đấu thầu.</p>', 'upload/coso/cs_1745387489.png', '2025-04-23 05:51:29', '2025-04-23 05:51:29'),
(2, 'Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 2', '201 Nguyễn Chí Thanh, Phường 12, Quận 5, TP. Hồ Chí Minh', '02839555548', 'bvdaihoccoso2@umc.edu.vn', '<p>Bệnh Viện Đại Học Y Dược Thành phố Hồ Chí Minh - Cơ Sở 2 không chỉ là nơi cung cấp dịch vụ y tế, mà còn là biểu tượng của sự phát triển và chăm sóc sức khỏe cho cộng đồng. Với sứ mệnh \"Y Tế Cho Sự Sống\", cơ sở này tiếp tục nỗ lực để đem lại niềm tin và sức khỏe cho mọi người.</p>', '<p>Được thành lập vào năm 1990, phòng khám tập thể ngoài giờ của Trường Trung Học Kỹ Thuật Y Tế Trung Ương 3 ra đời với mục đích cung cấp dịch vụ chăm sóc sức khỏe cho cán bộ giáo viên, nhằm cải thiện chất lượng cuộc sống và tăng cường hiệu suất công việc. Đây có lẽ là một trong những mô hình đầu tiên ở thành phố, được thành lập với sự hỗ trợ của Sở Y Tế Thành Phố Hồ Chí Minh và cũng là tiền thân của Bệnh Viện Đại Học Y Dược Thành phố Hồ Chí Minh - Cơ Sở 2</p><h2><strong>Quá Trình Phát Triển</strong></h2><p>Ban đầu, phòng khám hợp tác với Bệnh Viện Chợ Rẫy, đặc biệt trong lĩnh vực tai mũi họng. Sự hợp tác này không chỉ tăng cường uy tín mà còn mở rộng dịch vụ để đáp ứng nhu cầu ngày càng tăng của bệnh nhân. Năm 1998, Trường Trung Học Kỹ Thuật Y Tế 3 sáp nhập vào Trường Đại Học Y Dược Thành phố Hồ Chí Minh, đánh dấu bước tiến quan trọng trong sự phát triển của cơ sở này.</p><h2><strong>Hệ Thống Vật Chất và Đội Ngũ Y Bác Sĩ</strong></h2><p>Dù ban đầu với cơ sở vật chất và thiết bị sơ khai, nhưng nỗ lực không ngừng của đội ngũ y bác sĩ và nhân viên đã giúp cơ sở ngày càng hoàn thiện. Tính đến nay, Bệnh Viện Đại Học Y Dược Thành phố Hồ Chí Minh - Cơ Sở 2 sở hữu đội ngũ giáo sư bác sĩ hàng đầu, trang thiết bị hiện đại và sự tin tưởng từ cộng đồng.</p><h2><strong>Lãnh Đạo Nổi Bật Trong Quá Khứ Và Hiện Tại</strong></h2><p>Các nhà lãnh đạo như GS Đỗ Đình Hồ, GS.TS.BS Trần Thiện Trung, và TS.BS Vũ Trí Thanh đã đưa Bệnh Viện Cơ Sở 2 đi lên một chặng đường thành công. Ngày nay, sự lãnh đạo của PGS.TS.BS Hà Mạnh Tuấn và PGS.TS.BS Trần Anh Tuấn tiếp tục giữ vững đẳng cấp và phát triển bền vững của cơ sở.</p><h2><strong>Dịch Vụ và Khoa Chuyên Sâu</strong></h2><p>Với hơn 500 nhân viên, 30 phòng khám chuyên khoa, và 05 khoa lâm sàng, Bệnh Viện Cơ Sở 2 không chỉ đáp ứng mà còn vượt qua mong đợi của bệnh nhân. Các dịch vụ từ Khoa Tai Mũi Họng đến Sản - Phụ Khoa, từ Gây Mê Hồi Sức đến Khoa Khám Bệnh đều được thực hiện với chất lượng cao.</p>', 'upload/coso/cs_1745387691.png', '2025-04-23 05:54:51', '2025-04-23 05:54:51'),
(3, 'Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 3 (Y học cổ truyền kết hợp y học hiện đại)', '221B Hoàng Văn Thụ, Phường 8, Quận Phú Nhuận, TP. Hồ Chí Minh', '02838451889', 'bvdaihoccoso3@umc.edu.vn', '<p>Đại học Y Dược TPHCM - Cơ sở 3 không chỉ là một bệnh viện uy tín hàng đầu tại Việt Nam, mà còn là địa điểm chuyên sâu về khám chữa bệnh và chăm sóc sức khỏe toàn diện cho người dân. Là cơ sở thực hành của Đại học Y Dược TPHCM, Cơ sở 3 luộn dẫn đầu về chất lượng, đạo đức nghề nghiệp và ứng dụng các phương pháp điều trị tiên tiến, kết hợp giữa Y học cổ truyền và Y học hiện đại.</p>', '<p>Đại học Y Dược TPHCM - Cơ sở 3 là một trong những bệnh viện uy tín hàng đầu Việt Nam. Là trung tâm đầu ngành trong điều trị, chẩn đoán, đào tạo và nghiên cứu khoa học, Cơ sở 3 luôn tiên phong trong công tác áp dụng các kết quả nghiên cứu khoa học vào trong thực tiễn điều trị lâm sàng. Cùng <a href=\"https://medpro.vn/\">Medpro</a> tìm hiểu thông tin chi tiết về bệnh viện trong bài viết bên dưới.</p><h2><strong>Lịch sử hình thành và phát triển của UMC3</strong></h2><p>Bệnh viện Đại học Y Dược TPHCM - Cơ sở 3 được thành lập từ năm từ năm 2000, trên cơ sở sáp nhập Trường Trung học Y Dược Dân tộc và Khoa Y học cổ truyền - Đại học Y Dược TPHCM.</p><p>Ban đầu, Cơ sở 3 chỉ có 2 chuyên khoa là Y học cổ truyền và Châm cứu dưỡng sinh. Ngày nay, Bệnh viện đã hoàn thiện bộ máy hoạt động với 2 khoa, 3 đơn vị, 1 trung tâm và các phòng ban hậu cần. Là cơ sở thực thành của Đại học Y Dược TPHCM, UMC3 luôn dẫn đầu về chuẩn mực và y đức trong công tác khám chữa bệnh.</p><h2><strong>Các chuyên khoa và dịch vụ tại bệnh viện</strong></h2><h3><strong>Khoa Khám Bệnh</strong></h3><p>Được trang bị các kỹ thuật đặc thù của Y học cổ truyền kết hợp với y học hiện đại, đáp ứng nhu cầu của mọi lứa tuổi trong việc chẩn đoán và điều trị các bệnh lý như cơ xương khớp, đau cấp/mạn tính, phục hồi chức năng vận động/cảm giác sau đột quỵ, rối loạn chức năng cơ thể và nhiều hơn nữa.</p><h3><strong>Khám Sức Khỏe Tổng Quát</strong></h3><p>Cung cấp các gói khám, tầm soát, chăm sóc và tư vấn sức khỏe định kỳ cho cá nhân, doanh nghiệp và tổ chức qua các gói khám theo lứa tuổi và giới tính. Bệnh viện đồng thời đáp ứng cả nhu cầu khám chữa bệnh tại các địa điểm ngoại trú với các gói khám chuyên sâu.</p><h3><strong>Điều Trị Nội Trú - Khoa Y Học Cổ Truyền</strong></h3><p>Áp dụng phương pháp Đông - Tây y trong điều trị các bệnh lý như cơ xương khớp, tim mạch, thần kinh, tiêu hóa gan mật, tiết niệu sinh dục, hô hấp, nội tiết, dinh dưỡng và chuyển hóa.</p><h3><strong>Đơn Vị Điều Trị Ban Ngày - Điều Trị Ngoại Trú</strong></h3><p>Chuyên điều trị các bệnh lý đau, liệt, rối loạn chức năng cơ thể và nhiều bệnh lý khác, cũng như cung cấp các dịch vụ như châm cứu, cấy chỉ, xoa bóp bấm huyệt, vật lý trị liệu và các liệu pháp truyền thống khác.</p><h3><strong>Đơn Vị Cận Lâm Sàng</strong></h3><p>Trang bị nhiều thiết bị hiện đại để đáp ứng nhu cầu xét nghiệm và chẩn đoán của bệnh nhân nội trú và ngoại trú. Các dịch vụ bao gồm thực hiện các xét nghiệm, chẩn đoán hình ảnh, thăm dò chức năng,…</p><h3><strong>Trung Tâm U Máu</strong></h3><p>Chuyên khám và điều trị các bệnh lý về u máu nhũ nhi, dị dạng tĩnh mạch, giãn mạch và nhiều bệnh lý da liễu khác.</p>', 'upload/coso/cs_1745388002.png', '2025-04-23 06:00:02', '2025-04-23 06:00:02'),
(4, 'Bệnh viện Nhân Dân 115', '527 Sư Vạn Hạnh, Phường 12, Quận 10, Thành phố Hồ Chí Minh', '02838683496', 'bvnd115tphcm@gmail.com', '<p>Là Bệnh viện Đa khoa Hạng 1 tuyến cuối trực thuộc Sở Y tế Tp HCM. Với hơn 30 năm hoạt động, BV đã phát triển được 5 chuyên khoa mũi nhọn, luôn nghiên cứu, phát triển và đào tạo song song với nâng cao dịch vụ y tế và chất lượng khám chữa bệnh.</p>', '<h2><strong>Sơ lược về Bệnh viện Nhân Dân 115</strong></h2><p><strong>Bệnh viện Nhân dân 115</strong>, một cơ sở y tế đa khoa hàng đầu tại Thành phố Hồ Chí Minh, trực thuộc Sở Y tế thành phố, được công nhận là bệnh viện hạng I tuyến cuối. Nổi tiếng với 5 chuyên khoa trọng điểm, bệnh viện hoạt động với 7 khối lâm sàng và 42 khoa phòng, cung cấp gần 2.000 giường bệnh. Đội ngũ y bác sĩ tại đây có trình độ chuyên môn cao, với gần 70% sở hữu bằng cấp sau đại học.</p><p>&nbsp;</p><p>Bệnh viện đã đạt được nhiều thành tựu đáng kể, bao gồm <strong>7 kỷ lục Việt Nam</strong> và <strong>3 kỷ lục châu Á</strong>. Trong 3 kỷ lục châu Á, 2 kỷ lục tập thể gồm: Đạt chuẩn Chất lượng Vàng của Hội Đột quỵ châu Âu; triển khai và phẫu thuật u não đầu tiên thành công bằng robot Modus V Synaptive; cùng 1 kỷ lục cá nhân được trao cho <strong>ThS-BSCK2 Chu Tấn Sĩ - Trưởng Khoa Ngoại Thần kinh</strong>, người đầu tiên phẫu thuật u não bằng hệ thống robot Modus V Synaptive.</p><p>&nbsp;</p><p>Hướng tới tương lai,<strong> Bệnh viện Nhân dân 115</strong> cam kết tiếp tục phát triển các chuyên khoa mũi nhọn, đẩy mạnh nghiên cứu và đào tạo, đồng thời không ngừng nâng cao chất lượng dịch vụ y tế để phục vụ cộng đồng một cách tốt nhất.</p><h2>&nbsp;</h2><h2><strong>Chuyên khoa</strong></h2><p>Bệnh viện Nhân dân 115 là một trung tâm y tế chuyên sâu, đặc biệt trong các lĩnh vực:</p><ul><li><strong>Khối Tim mạch</strong></li><li><strong>Khối Thần kinh</strong></li><li><strong>Khối Thận niệu</strong></li><li><strong>Khối Ung thư</strong></li><li><strong>Gây mê hồi sức - Hồi sức tích cực</strong></li></ul><h3>&nbsp;</h3><h3><strong>Khối Thần kinh:</strong></h3><ul><li>Nội thần kinh tổng quát</li><li>Ngoại thần kinh</li><li>Bệnh lý mạch máu não</li></ul><p><strong>Các kỹ thuật đặc biệt đã triển khai:</strong></p><ul><li>Chọc hút cục máu đông bằng dụng cụ Penumbra</li><li>Tiêu sợi huyết qua đường tĩnh mạch và động mạch</li><li>Nong mạch nội soi bằng đặt stent qua động mạch</li><li>Phẫu thuật động kinh</li><li>Phẫu thuật co cứng do di chứng</li><li>Nội soi mở thông não thất</li><li>Phẫu thuật kẹp túi phình động mạch não</li></ul><p>&nbsp;</p><h3><strong>Khối Tim mạch:</strong></h3><ul><li>Tim mạch tổng quát</li><li>Nhịp tim học</li><li>Tim mạch an thiệp</li><li>Phẫu thuật tim</li><li>Hồi sức tim mạch</li></ul><p><strong>Các kỹ thuật đặc biệt đã triển khai:</strong></p><ul><li>Chụp mạch vành</li><li>Can thiệp đặt stent động mạch vành</li><li>Đặt máy theo dõi sóng T đề phòng đột tử</li><li>Đặt bóng đối xung động mạch chủ</li><li>Phẫu thuật thay van tim, phẫu thuật mổ bắc cầu động mạch vành</li></ul><p>&nbsp;</p><h3><strong>Khoa Nội thận - Miễn dịch ghép và Ngoại niệu ghép thận</strong></h3><p><strong>Các kỹ thuật đặc biệt đã triển khai:</strong></p><ul><li>Tán sỏi ngoài cơ thể và mổ nội soi lấy sỏi thận</li><li>Ghép thận</li><li>Điều trị các bệnh lý nam khoa</li></ul><p>&nbsp;</p><h3>Khoa cấp cứu</h3><ul><li>Gây mê hồi sức</li><li>Hồi sức tích cực chống độc</li><li>Cấp cứu tổng hợp</li></ul><p><strong>Các kỹ thuật đặc biệt đã triển khai:</strong></p><ul><li>Gây mê phẫu thuật người bệnh ở tư thế ngồi</li><li>Đo áp lực nội sọ</li><li>Hấp phụ huyết tương kết hợp lọc máu liên tục để cấp cứu và điều trị cho người bệnh bị ngộ độc</li><li>Lọc máu hấp thụ</li><li>Theo dõi cung lượng tim bằng kỹ thuật PICCO</li><li>Gan thận nhân tạo, trao đổi khí bằng màng ngoài cơ thể,...</li></ul><p>&nbsp;</p><h3>Khoa Ung bướu</h3><p>Máy gia tốc tuyến tính, CT mô phỏng, máy xạ phẫu Gamma, hệ thống PET - CT, máy chụp cộng hưởng từ</p><p>&nbsp;</p><p>&nbsp;</p><h2><strong>Cơ sở vật chất</strong></h2><p>Khu Chẩn đoán và Điều trị Kỹ thuật cao của Bệnh viện Nhân dân 115, một dự án trọng điểm được khởi công vào ngày 5 tháng 7 năm 2016, đã đánh dấu một bước tiến vượt bậc trong việc nâng cao chất lượng dịch vụ y tế tại Thành phố Hồ Chí Minh. Với tổng diện tích sàn xây dựng hơn 19.000m² và vốn đầu tư 332 tỷ đồng từ ngân sách thành phố, tòa nhà 10 tầng này, tọa lạc <strong>tại số 818 Sư Vạn Hạnh, Quận 10</strong>, được trang bị cơ sở vật chất hiện đại, bao gồm 2 tầng hầm và đường hầm kết nối trực tiếp với khu vực cấp cứu và điều trị ngoại trú của bệnh viện. Điểm nhấn đặc biệt của công trình là sân đáp trực thăng trên nóc, mở ra tiềm năng cho việc cấp cứu bằng đường hàng không trong tương lai.</p><p>&nbsp;</p><p>Từ khi đi vào hoạt động, khu vực này đã trở thành điểm đến tin cậy cho người bệnh, đặc biệt là trong các lĩnh vực chuyên sâu như đột quỵ, tim mạch, ung thư, thận niệu và tiêu hóa. Bệnh viện đã không ngừng đầu tư vào các thiết bị y tế tiên tiến như<strong> hệ thống chụp CT, MRI</strong>, siêu âm và nội soi tiêu hóa tích hợp trí tuệ nhân tạo (AI), nhằm nâng cao hiệu quả chẩn đoán và điều trị.</p><p>Bên cạnh việc đầu tư vào cơ sở vật chất và thiết bị, Bệnh viện Nhân dân 115 cũng chú trọng đến việc đào tạo nguồn nhân lực chất lượng cao. Bệnh viện đã triển khai các chương trình đào tạo chuyên sâu trong nước và quốc tế, nhằm đảm bảo đội ngũ y bác sĩ có đủ năng lực để khai thác tối đa tiềm năng của các công nghệ y tế hiện đại.</p><p>&nbsp;</p><p>Trong bối cảnh chuyển đổi số của ngành y tế, bệnh viện đã áp dụng thành công nhiều công nghệ tiên tiến như<strong> phần mềm RAPID</strong> trong<strong> điều trị đột quỵ và mô hình nội soi tiêu hóa tích hợp AI trong tầm soát ung thư</strong>. Những ứng dụng này không chỉ giúp tối ưu hóa quy trình điều trị mà còn mang lại cơ hội sống cao hơn cho người bệnh.</p><p>Hướng đến tương lai, <strong>Bệnh viện Nhân dân 115</strong> cam kết tiếp tục phát triển cơ sở vật chất, đầu tư vào các thiết bị y tế hiện đại và tăng cường hợp tác quốc tế. Mục tiêu của bệnh viện là cung cấp dịch vụ y tế chất lượng cao, ứng dụng các phương pháp điều trị tiên tiến, góp phần nâng cao sức khỏe toàn diện cho người dân.</p>', 'upload/coso/cs_1745392042.png', '2025-04-23 07:07:22', '2025-04-23 07:07:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khunggio`
--

CREATE TABLE `khunggio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buoi` varchar(255) NOT NULL,
  `thoigianbatdau` varchar(255) NOT NULL,
  `thoigianketthuc` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khunggio`
--

INSERT INTO `khunggio` (`id`, `buoi`, `thoigianbatdau`, `thoigianketthuc`, `created_at`, `updated_at`) VALUES
(1, 'sáng', '07:00', '08:00', '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(2, 'sáng', '08:00', '09:00', '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(3, 'sáng', '09:00', '10:00', '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(4, 'sáng', '10:00', '11:00', '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(5, 'chiều', '13:30', '14:30', '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(6, 'chiều', '14:30', '15:30', '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(7, 'chiều', '15:30', '16:00', '2025-04-23 05:37:29', '2025-04-23 05:37:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichhen`
--

CREATE TABLE `lichhen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_benhnhan` bigint(20) UNSIGNED NOT NULL,
  `id_bacsi` bigint(20) UNSIGNED NOT NULL,
  `id_lichkhamkhunggio` bigint(20) UNSIGNED NOT NULL,
  `giakham` int(11) NOT NULL,
  `ngayhen` date NOT NULL,
  `buoi` varchar(255) NOT NULL,
  `thoigian` varchar(255) NOT NULL,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichhen`
--

INSERT INTO `lichhen` (`id`, `id_benhnhan`, `id_bacsi`, `id_lichkhamkhunggio`, `giakham`, `ngayhen`, `buoi`, `thoigian`, `trangthai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 150000, '2025-04-24', 'chiều', '13:30 - 14:30', 1, '2025-04-23 08:46:28', '2025-04-23 08:46:28'),
(2, 2, 1, 4, 150000, '2025-05-01', 'chiều', '13:30 - 14:30', 2, '2025-04-23 08:48:45', '2025-04-30 14:51:10'),
(3, 3, 1, 4, 150000, '2025-05-01', 'chiều', '13:30 - 14:30', 2, '2025-04-23 08:50:54', '2025-04-30 14:51:21'),
(4, 4, 5, 61, 150000, '2025-04-25', 'sáng', '07:00 - 08:00', 1, '2025-04-23 08:54:43', '2025-04-23 08:54:43'),
(5, 5, 9, 161, 300000, '2025-05-06', 'sáng', '07:00 - 08:00', 1, '2025-04-30 14:34:56', '2025-04-30 14:34:56'),
(6, 5, 1, 4, 150000, '2025-05-01', 'chiều', '13:30 - 14:30', 1, '2025-04-30 14:35:58', '2025-04-30 14:35:58'),
(7, 6, 1, 4, 150000, '2025-05-01', 'chiều', '13:30 - 14:30', 1, '2025-04-30 14:38:20', '2025-04-30 14:38:20'),
(8, 7, 1, 4, 150000, '2025-05-01', 'chiều', '13:30 - 14:30', 1, '2025-04-30 14:39:35', '2025-04-30 14:39:35'),
(9, 8, 1, 4, 150000, '2025-05-01', 'chiều', '13:30 - 14:30', 1, '2025-04-30 14:44:34', '2025-04-30 14:44:34'),
(10, 6, 10, 185, 300000, '2025-05-19', 'sáng', '07:00 - 08:00', 1, '2025-04-30 14:45:27', '2025-04-30 14:45:27'),
(11, 9, 13, 226, 150000, '2025-05-02', 'chiều', '14:30 - 15:30', 1, '2025-04-30 14:47:45', '2025-04-30 14:47:45'),
(12, 6, 15, 255, 150000, '2025-05-13', 'chiều', '13:30 - 14:30', 1, '2025-04-30 14:53:13', '2025-04-30 14:53:13'),
(13, 10, 18, 303, 150000, '2025-05-13', 'chiều', '13:30 - 14:30', 1, '2025-04-30 14:56:40', '2025-04-30 14:56:40'),
(14, 11, 25, 480, 150000, '2025-05-12', 'chiều', '15:30 - 16:00', 1, '2025-04-30 14:58:11', '2025-04-30 14:58:11'),
(15, 11, 34, 676, 150000, '2025-05-03', 'sáng', '08:00 - 09:00', 1, '2025-04-30 14:59:02', '2025-04-30 14:59:02'),
(16, 1, 11, 197, 300000, '2025-05-13', 'chiều', '14:30 - 15:30', 1, '2025-04-30 15:00:42', '2025-04-30 15:00:42'),
(17, 1, 18, 300, 150000, '2025-05-06', 'chiều', '13:30 - 14:30', 1, '2025-04-30 15:01:09', '2025-04-30 15:01:09'),
(18, 4, 25, 483, 150000, '2025-05-19', 'chiều', '15:30 - 16:00', 1, '2025-04-30 15:01:38', '2025-04-30 15:01:38'),
(19, 3, 31, 599, 150000, '2025-05-20', 'sáng', '07:00 - 08:00', 1, '2025-04-30 15:02:21', '2025-04-30 15:02:21'),
(20, 2, 17, 284, 150000, '2025-05-06', 'sáng', '07:00 - 08:00', 1, '2025-04-30 15:03:20', '2025-04-30 15:03:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichkham`
--

CREATE TABLE `lichkham` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bacsi` bigint(20) UNSIGNED NOT NULL,
  `ngaykham` date NOT NULL,
  `buoi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichkham`
--

INSERT INTO `lichkham` (`id`, `id_bacsi`, `ngaykham`, `buoi`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-24', 'Chiều', '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(2, 1, '2025-05-01', 'Chiều', '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(3, 1, '2025-05-08', 'Chiều', '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(4, 1, '2025-05-15', 'Chiều', '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(5, 2, '2025-04-29', 'Chiều', '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(6, 2, '2025-05-06', 'Chiều', '2025-04-23 07:38:09', '2025-04-23 07:38:39'),
(8, 2, '2025-05-13', 'Chiều', '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(9, 3, '2025-04-25', 'Sáng', '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(10, 3, '2025-05-02', 'Sáng', '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(11, 3, '2025-05-09', 'Sáng', '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(12, 3, '2025-05-16', 'Sáng', '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(13, 4, '2025-04-30', 'Sáng', '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(14, 4, '2025-04-29', 'Sáng', '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(15, 4, '2025-05-07', 'Sáng', '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(16, 4, '2025-05-14', 'Sáng', '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(17, 5, '2025-04-25', 'Sáng', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(18, 5, '2025-04-25', 'Chiều', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(19, 5, '2025-05-02', 'Sáng', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(20, 5, '2025-05-02', 'Chiều', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(21, 5, '2025-05-09', 'Sáng', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(22, 5, '2025-05-09', 'Chiều', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(23, 5, '2025-05-16', 'Sáng', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(24, 5, '2025-05-16', 'Chiều', '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(25, 6, '2025-04-24', 'Sáng', '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(26, 6, '2025-05-01', 'Sáng', '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(27, 6, '2025-05-08', 'Sáng', '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(28, 6, '2025-05-15', 'Sáng', '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(29, 7, '2025-05-07', 'Sáng', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(30, 7, '2025-05-07', 'Chiều', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(31, 7, '2025-05-14', 'Sáng', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(32, 7, '2025-05-14', 'Chiều', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(33, 7, '2025-05-21', 'Sáng', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(34, 7, '2025-05-21', 'Chiều', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(35, 7, '2025-05-28', 'Sáng', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(36, 7, '2025-05-28', 'Chiều', '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(37, 8, '2025-04-29', 'Sáng', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(38, 8, '2025-04-29', 'Chiều', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(39, 8, '2025-05-06', 'Sáng', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(40, 8, '2025-05-06', 'Chiều', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(41, 8, '2025-05-13', 'Sáng', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(42, 8, '2025-05-13', 'Chiều', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(43, 8, '2025-05-20', 'Sáng', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(44, 8, '2025-05-20', 'Chiều', '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(45, 9, '2025-05-06', 'Sáng', '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(46, 9, '2025-05-13', 'Sáng', '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(47, 9, '2025-05-20', 'Sáng', '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(48, 9, '2025-05-27', 'Sáng', '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(49, 10, '2025-05-05', 'Sáng', '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(50, 10, '2025-05-12', 'Sáng', '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(51, 10, '2025-05-19', 'Sáng', '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(52, 10, '2025-05-26', 'Sáng', '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(53, 11, '2025-05-06', 'Chiều', '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(54, 11, '2025-05-13', 'Chiều', '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(55, 11, '2025-05-20', 'Chiều', '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(56, 11, '2025-05-27', 'Chiều', '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(57, 12, '2025-05-01', 'Sáng', '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(58, 12, '2025-05-08', 'Sáng', '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(59, 12, '2025-05-15', 'Sáng', '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(60, 12, '2025-05-22', 'Sáng', '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(61, 12, '2025-05-29', 'Sáng', '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(62, 13, '2025-05-02', 'Chiều', '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(63, 13, '2025-05-09', 'Chiều', '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(64, 13, '2025-05-16', 'Chiều', '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(65, 13, '2025-05-23', 'Chiều', '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(66, 13, '2025-05-30', 'Chiều', '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(67, 14, '2025-05-07', 'Chiều', '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(68, 14, '2025-05-14', 'Chiều', '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(69, 14, '2025-05-21', 'Chiều', '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(70, 14, '2025-05-28', 'Chiều', '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(71, 15, '2025-05-06', 'Chiều', '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(72, 15, '2025-05-13', 'Chiều', '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(73, 15, '2025-05-20', 'Chiều', '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(74, 15, '2025-05-27', 'Chiều', '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(75, 16, '2025-05-02', 'Sáng', '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(76, 16, '2025-05-09', 'Sáng', '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(77, 16, '2025-05-16', 'Sáng', '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(78, 16, '2025-05-23', 'Sáng', '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(79, 16, '2025-05-30', 'Sáng', '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(80, 17, '2025-05-06', 'Sáng', '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(81, 17, '2025-05-13', 'Sáng', '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(82, 17, '2025-05-20', 'Sáng', '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(83, 17, '2025-05-27', 'Sáng', '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(84, 18, '2025-05-06', 'Chiều', '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(85, 18, '2025-05-13', 'Chiều', '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(86, 18, '2025-05-20', 'Chiều', '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(87, 18, '2025-05-27', 'Chiều', '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(88, 19, '2025-05-05', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(89, 19, '2025-05-07', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(90, 19, '2025-05-07', 'Chiều', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(91, 19, '2025-05-12', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(92, 19, '2025-05-14', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(93, 19, '2025-05-14', 'Chiều', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(94, 19, '2025-05-19', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(95, 19, '2025-05-21', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(96, 19, '2025-05-21', 'Chiều', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(97, 19, '2025-05-26', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(98, 19, '2025-05-28', 'Sáng', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(99, 19, '2025-05-28', 'Chiều', '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(100, 20, '2025-05-01', 'Sáng', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(101, 20, '2025-05-05', 'Chiều', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(102, 20, '2025-05-08', 'Sáng', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(103, 20, '2025-05-12', 'Chiều', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(104, 20, '2025-05-15', 'Sáng', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(105, 20, '2025-05-19', 'Chiều', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(106, 20, '2025-05-22', 'Sáng', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(107, 20, '2025-05-26', 'Chiều', '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(108, 20, '2025-05-29', 'Sáng', '2025-04-30 13:36:46', '2025-04-30 13:36:46'),
(109, 21, '2025-05-07', 'Sáng', '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(110, 21, '2025-05-14', 'Sáng', '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(111, 21, '2025-05-21', 'Sáng', '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(112, 21, '2025-05-28', 'Sáng', '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(113, 22, '2025-05-01', 'Sáng', '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(114, 22, '2025-05-08', 'Sáng', '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(115, 22, '2025-05-15', 'Sáng', '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(116, 22, '2025-05-22', 'Sáng', '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(117, 22, '2025-05-29', 'Sáng', '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(118, 23, '2025-05-03', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(119, 23, '2025-05-06', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(120, 23, '2025-05-10', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(121, 23, '2025-05-13', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(122, 23, '2025-05-16', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(123, 23, '2025-05-20', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(124, 23, '2025-05-24', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(125, 23, '2025-05-27', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(126, 23, '2025-05-31', 'Sáng', '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(127, 24, '2025-05-02', 'Chiều', '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(128, 24, '2025-05-09', 'Chiều', '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(129, 24, '2025-05-16', 'Chiều', '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(130, 24, '2025-05-23', 'Chiều', '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(131, 24, '2025-05-30', 'Chiều', '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(132, 25, '2025-05-05', 'Chiều', '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(133, 25, '2025-05-12', 'Chiều', '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(134, 25, '2025-05-19', 'Chiều', '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(135, 25, '2025-05-26', 'Chiều', '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(136, 26, '2025-05-05', 'Sáng', '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(137, 26, '2025-05-12', 'Sáng', '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(138, 26, '2025-05-19', 'Sáng', '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(139, 26, '2025-05-26', 'Sáng', '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(140, 27, '2025-05-01', 'Sáng', '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(141, 27, '2025-05-08', 'Sáng', '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(142, 27, '2025-05-15', 'Sáng', '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(143, 27, '2025-05-22', 'Sáng', '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(144, 27, '2025-05-29', 'Sáng', '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(145, 28, '2025-05-07', 'Sáng', '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(146, 28, '2025-05-13', 'Sáng', '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(147, 28, '2025-05-20', 'Sáng', '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(148, 28, '2025-05-27', 'Sáng', '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(149, 29, '2025-05-03', 'Sáng', '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(150, 29, '2025-05-10', 'Sáng', '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(151, 29, '2025-05-17', 'Sáng', '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(152, 29, '2025-05-24', 'Sáng', '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(153, 29, '2025-05-31', 'Sáng', '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(154, 30, '2025-05-02', 'Sáng', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(155, 30, '2025-05-05', 'Chiều', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(156, 30, '2025-05-09', 'Sáng', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(157, 30, '2025-05-12', 'Chiều', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(158, 30, '2025-05-16', 'Sáng', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(159, 30, '2025-05-19', 'Chiều', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(160, 30, '2025-05-23', 'Sáng', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(161, 30, '2025-05-26', 'Chiều', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(162, 30, '2025-05-30', 'Sáng', '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(163, 31, '2025-05-06', 'Sáng', '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(164, 31, '2025-05-13', 'Sáng', '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(165, 31, '2025-05-20', 'Sáng', '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(166, 31, '2025-05-27', 'Sáng', '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(167, 32, '2025-05-01', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(168, 32, '2025-05-06', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(169, 32, '2025-05-08', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(170, 32, '2025-05-12', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(171, 32, '2025-05-15', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(172, 32, '2025-05-19', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(173, 32, '2025-05-22', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(174, 32, '2025-05-26', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(175, 32, '2025-05-29', 'Sáng', '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(176, 33, '2025-05-06', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(177, 33, '2025-05-07', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(178, 33, '2025-05-13', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(179, 33, '2025-05-14', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(180, 33, '2025-05-20', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(181, 33, '2025-05-21', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(182, 33, '2025-05-27', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(183, 33, '2025-05-28', 'Sáng', '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(184, 34, '2025-05-03', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(185, 34, '2025-05-06', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(186, 34, '2025-05-06', 'Chiều', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(187, 34, '2025-05-10', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(188, 34, '2025-05-13', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(189, 34, '2025-05-13', 'Chiều', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(190, 34, '2025-05-17', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(191, 34, '2025-05-20', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(192, 34, '2025-05-20', 'Chiều', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(193, 34, '2025-05-24', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(194, 34, '2025-05-27', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(195, 34, '2025-05-27', 'Chiều', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(196, 34, '2025-05-31', 'Sáng', '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(197, 1, '2025-05-30', 'Sáng', '2025-05-06 01:13:18', '2025-05-06 01:13:18'),
(198, 35, '2025-05-31', 'Sáng', '2025-05-06 01:14:55', '2025-05-06 01:14:55'),
(199, 35, '2025-05-31', 'Chiều', '2025-05-06 01:14:55', '2025-05-06 01:14:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichkham_khunggio`
--

CREATE TABLE `lichkham_khunggio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_lichkham` bigint(20) UNSIGNED NOT NULL,
  `id_khunggio` bigint(20) UNSIGNED NOT NULL,
  `soluongtoida` int(11) NOT NULL,
  `soluongdadat` int(11) NOT NULL DEFAULT 0,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichkham_khunggio`
--

INSERT INTO `lichkham_khunggio` (`id`, `id_lichkham`, `id_khunggio`, `soluongtoida`, `soluongdadat`, `trangthai`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 6, 1, 1, '2025-04-23 07:32:21', '2025-04-23 08:46:28'),
(2, 1, 6, 6, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(3, 1, 7, 3, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(4, 2, 5, 6, 6, 0, '2025-04-23 07:32:21', '2025-04-30 14:44:47'),
(5, 2, 6, 6, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(6, 2, 7, 3, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(7, 3, 5, 6, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(8, 3, 6, 6, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(9, 3, 7, 3, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(10, 4, 5, 6, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(11, 4, 6, 6, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(12, 4, 7, 3, 0, 1, '2025-04-23 07:32:21', '2025-04-23 07:32:21'),
(13, 5, 5, 6, 0, 1, '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(14, 5, 6, 6, 0, 1, '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(15, 5, 7, 3, 0, 1, '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(23, 8, 5, 6, 0, 1, '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(24, 8, 6, 6, 0, 1, '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(25, 8, 7, 3, 0, 1, '2025-04-23 07:38:09', '2025-04-23 07:38:09'),
(26, 6, 5, 6, 0, 1, '2025-04-23 07:38:39', '2025-04-23 07:38:39'),
(27, 6, 6, 6, 0, 1, '2025-04-23 07:38:39', '2025-04-23 07:38:39'),
(28, 6, 7, 3, 0, 1, '2025-04-23 07:38:39', '2025-04-23 07:38:39'),
(29, 9, 1, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(30, 9, 2, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(31, 9, 3, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(32, 9, 4, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(33, 10, 1, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(34, 10, 2, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(35, 10, 3, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(36, 10, 4, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(37, 11, 1, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(38, 11, 2, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(39, 11, 3, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(40, 11, 4, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(41, 12, 1, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(42, 12, 2, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(43, 12, 3, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(44, 12, 4, 6, 0, 1, '2025-04-23 07:42:05', '2025-04-23 07:42:05'),
(45, 13, 1, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(46, 13, 2, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(47, 13, 3, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(48, 13, 4, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(49, 14, 1, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(50, 14, 2, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(51, 14, 3, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(52, 14, 4, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(53, 15, 1, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(54, 15, 2, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(55, 15, 3, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(56, 15, 4, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(57, 16, 1, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(58, 16, 2, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(59, 16, 3, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(60, 16, 4, 6, 0, 1, '2025-04-23 07:45:00', '2025-04-23 07:45:00'),
(61, 17, 1, 6, 1, 1, '2025-04-23 07:51:44', '2025-04-23 08:54:43'),
(62, 17, 2, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(63, 17, 3, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(64, 17, 4, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(65, 18, 5, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(66, 18, 6, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(67, 18, 7, 3, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(68, 19, 1, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(69, 19, 2, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(70, 19, 3, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(71, 19, 4, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(72, 20, 5, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(73, 20, 6, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(74, 20, 7, 3, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(75, 21, 1, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(76, 21, 2, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(77, 21, 3, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(78, 21, 4, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(79, 22, 5, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(80, 22, 6, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(81, 22, 7, 3, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(82, 23, 1, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(83, 23, 2, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(84, 23, 3, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(85, 23, 4, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(86, 24, 5, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(87, 24, 6, 6, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(88, 24, 7, 3, 0, 1, '2025-04-23 07:51:44', '2025-04-23 07:51:44'),
(89, 25, 1, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(90, 25, 2, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(91, 25, 3, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(92, 25, 4, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(93, 26, 1, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(94, 26, 2, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(95, 26, 3, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(96, 26, 4, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(97, 27, 1, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(98, 27, 2, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(99, 27, 3, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(100, 27, 4, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(101, 28, 1, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(102, 28, 2, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(103, 28, 3, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(104, 28, 4, 6, 0, 1, '2025-04-23 07:58:35', '2025-04-23 07:58:35'),
(105, 29, 1, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(106, 29, 2, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(107, 29, 3, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(108, 29, 4, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(109, 30, 5, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(110, 30, 6, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(111, 30, 7, 3, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(112, 31, 1, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(113, 31, 2, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(114, 31, 3, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(115, 31, 4, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(116, 32, 5, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(117, 32, 6, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(118, 32, 7, 3, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(119, 33, 1, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(120, 33, 2, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(121, 33, 3, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(122, 33, 4, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(123, 34, 5, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(124, 34, 6, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(125, 34, 7, 3, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(126, 35, 1, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(127, 35, 2, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(128, 35, 3, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(129, 35, 4, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(130, 36, 5, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(131, 36, 6, 6, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(132, 36, 7, 3, 0, 1, '2025-04-23 08:03:40', '2025-04-23 08:03:40'),
(133, 37, 1, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(134, 37, 2, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(135, 37, 3, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(136, 37, 4, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(137, 38, 5, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(138, 38, 6, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(139, 38, 7, 3, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(140, 39, 1, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(141, 39, 2, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(142, 39, 3, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(143, 39, 4, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(144, 40, 5, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(145, 40, 6, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(146, 40, 7, 3, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(147, 41, 1, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(148, 41, 2, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(149, 41, 3, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(150, 41, 4, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(151, 42, 5, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(152, 42, 6, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(153, 42, 7, 3, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(154, 43, 1, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(155, 43, 2, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(156, 43, 3, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(157, 43, 4, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(158, 44, 5, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(159, 44, 6, 6, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(160, 44, 7, 3, 0, 1, '2025-04-23 08:08:26', '2025-04-23 08:08:26'),
(161, 45, 1, 6, 1, 1, '2025-04-30 12:55:46', '2025-04-30 14:34:56'),
(162, 45, 2, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(163, 45, 3, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(164, 45, 4, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(165, 46, 1, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(166, 46, 2, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(167, 46, 3, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(168, 46, 4, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(169, 47, 1, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(170, 47, 2, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(171, 47, 3, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(172, 47, 4, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(173, 48, 1, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(174, 48, 2, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(175, 48, 3, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(176, 48, 4, 6, 0, 1, '2025-04-30 12:55:46', '2025-04-30 12:55:46'),
(177, 49, 1, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(178, 49, 2, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(179, 49, 3, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(180, 49, 4, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(181, 50, 1, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(182, 50, 2, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(183, 50, 3, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(184, 50, 4, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(185, 51, 1, 6, 1, 1, '2025-04-30 12:58:08', '2025-04-30 14:45:27'),
(186, 51, 2, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(187, 51, 3, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(188, 51, 4, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(189, 52, 1, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(190, 52, 2, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(191, 52, 3, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(192, 52, 4, 6, 0, 1, '2025-04-30 12:58:08', '2025-04-30 12:58:08'),
(193, 53, 5, 6, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(194, 53, 6, 6, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(195, 53, 7, 3, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(196, 54, 5, 6, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(197, 54, 6, 6, 1, 1, '2025-04-30 13:02:01', '2025-04-30 15:00:42'),
(198, 54, 7, 3, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(199, 55, 5, 6, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(200, 55, 6, 6, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(201, 55, 7, 3, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(202, 56, 5, 6, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(203, 56, 6, 6, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(204, 56, 7, 3, 0, 1, '2025-04-30 13:02:01', '2025-04-30 13:02:01'),
(205, 57, 1, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(206, 57, 2, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(207, 57, 3, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(208, 57, 4, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(209, 58, 1, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(210, 58, 2, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(211, 58, 3, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(212, 58, 4, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(213, 59, 1, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(214, 59, 2, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(215, 59, 3, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(216, 59, 4, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(217, 60, 1, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(218, 60, 2, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(219, 60, 3, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(220, 60, 4, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(221, 61, 1, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(222, 61, 2, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(223, 61, 3, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(224, 61, 4, 6, 0, 1, '2025-04-30 13:04:55', '2025-04-30 13:04:55'),
(225, 62, 5, 6, 0, 1, '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(226, 62, 6, 6, 1, 1, '2025-04-30 13:13:03', '2025-04-30 14:47:45'),
(227, 62, 7, 3, 0, 1, '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(228, 63, 5, 6, 0, 1, '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(229, 63, 6, 6, 0, 1, '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(230, 63, 7, 3, 0, 1, '2025-04-30 13:13:03', '2025-04-30 13:13:03'),
(231, 64, 5, 6, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(232, 64, 6, 6, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(233, 64, 7, 3, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(234, 65, 5, 6, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(235, 65, 6, 6, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(236, 65, 7, 3, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(237, 66, 5, 6, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(238, 66, 6, 6, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(239, 66, 7, 3, 0, 1, '2025-04-30 13:13:04', '2025-04-30 13:13:04'),
(240, 67, 5, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(241, 67, 6, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(242, 67, 7, 3, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(243, 68, 5, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(244, 68, 6, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(245, 68, 7, 3, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(246, 69, 5, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(247, 69, 6, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(248, 69, 7, 3, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(249, 70, 5, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(250, 70, 6, 6, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(251, 70, 7, 3, 0, 1, '2025-04-30 13:17:01', '2025-04-30 13:17:01'),
(252, 71, 5, 6, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(253, 71, 6, 6, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(254, 71, 7, 3, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(255, 72, 5, 6, 1, 1, '2025-04-30 13:19:15', '2025-04-30 14:53:13'),
(256, 72, 6, 6, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(257, 72, 7, 3, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(258, 73, 5, 6, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(259, 73, 6, 6, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(260, 73, 7, 3, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(261, 74, 5, 6, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(262, 74, 6, 6, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(263, 74, 7, 3, 0, 1, '2025-04-30 13:19:15', '2025-04-30 13:19:15'),
(264, 75, 1, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(265, 75, 2, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(266, 75, 3, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(267, 75, 4, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(268, 76, 1, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(269, 76, 2, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(270, 76, 3, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(271, 76, 4, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(272, 77, 1, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(273, 77, 2, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(274, 77, 3, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(275, 77, 4, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(276, 78, 1, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(277, 78, 2, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(278, 78, 3, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(279, 78, 4, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(280, 79, 1, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(281, 79, 2, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(282, 79, 3, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(283, 79, 4, 6, 0, 1, '2025-04-30 13:21:57', '2025-04-30 13:21:57'),
(284, 80, 1, 6, 1, 1, '2025-04-30 13:25:15', '2025-04-30 15:03:20'),
(285, 80, 2, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(286, 80, 3, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(287, 80, 4, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(288, 81, 1, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(289, 81, 2, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(290, 81, 3, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(291, 81, 4, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(292, 82, 1, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(293, 82, 2, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(294, 82, 3, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(295, 82, 4, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(296, 83, 1, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(297, 83, 2, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(298, 83, 3, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(299, 83, 4, 6, 0, 1, '2025-04-30 13:25:15', '2025-04-30 13:25:15'),
(300, 84, 5, 6, 1, 1, '2025-04-30 13:29:24', '2025-04-30 15:01:09'),
(301, 84, 6, 6, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(302, 84, 7, 3, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(303, 85, 5, 6, 1, 1, '2025-04-30 13:29:24', '2025-04-30 14:56:40'),
(304, 85, 6, 6, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(305, 85, 7, 3, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(306, 86, 5, 6, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(307, 86, 6, 6, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(308, 86, 7, 3, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(309, 87, 5, 6, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(310, 87, 6, 6, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(311, 87, 7, 3, 0, 1, '2025-04-30 13:29:24', '2025-04-30 13:29:24'),
(312, 88, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(313, 88, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(314, 88, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(315, 88, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(316, 89, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(317, 89, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(318, 89, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(319, 89, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(320, 90, 5, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(321, 90, 6, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(322, 90, 7, 3, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(323, 91, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(324, 91, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(325, 91, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(326, 91, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(327, 92, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(328, 92, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(329, 92, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(330, 92, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(331, 93, 5, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(332, 93, 6, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(333, 93, 7, 3, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(334, 94, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(335, 94, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(336, 94, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(337, 94, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(338, 95, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(339, 95, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(340, 95, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(341, 95, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(342, 96, 5, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(343, 96, 6, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(344, 96, 7, 3, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(345, 97, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(346, 97, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(347, 97, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(348, 97, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(349, 98, 1, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(350, 98, 2, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(351, 98, 3, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(352, 98, 4, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(353, 99, 5, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(354, 99, 6, 6, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(355, 99, 7, 3, 0, 1, '2025-04-30 13:33:07', '2025-04-30 13:33:07'),
(356, 100, 1, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(357, 100, 2, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(358, 100, 3, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(359, 100, 4, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(360, 101, 5, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(361, 101, 6, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(362, 101, 7, 3, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(363, 102, 1, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(364, 102, 2, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(365, 102, 3, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(366, 102, 4, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(367, 103, 5, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(368, 103, 6, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(369, 103, 7, 3, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(370, 104, 1, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(371, 104, 2, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(372, 104, 3, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(373, 104, 4, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(374, 105, 5, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(375, 105, 6, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(376, 105, 7, 3, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(377, 106, 1, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(378, 106, 2, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(379, 106, 3, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(380, 106, 4, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(381, 107, 5, 6, 0, 1, '2025-04-30 13:36:45', '2025-04-30 13:36:45'),
(382, 107, 6, 6, 0, 1, '2025-04-30 13:36:46', '2025-04-30 13:36:46'),
(383, 107, 7, 3, 0, 1, '2025-04-30 13:36:46', '2025-04-30 13:36:46'),
(384, 108, 1, 6, 0, 1, '2025-04-30 13:36:46', '2025-04-30 13:36:46'),
(385, 108, 2, 6, 0, 1, '2025-04-30 13:36:46', '2025-04-30 13:36:46'),
(386, 108, 3, 6, 0, 1, '2025-04-30 13:36:46', '2025-04-30 13:36:46'),
(387, 108, 4, 6, 0, 1, '2025-04-30 13:36:46', '2025-04-30 13:36:46'),
(388, 109, 1, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(389, 109, 2, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(390, 109, 3, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(391, 109, 4, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(392, 110, 1, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(393, 110, 2, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(394, 110, 3, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(395, 110, 4, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(396, 111, 1, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(397, 111, 2, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(398, 111, 3, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(399, 111, 4, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(400, 112, 1, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(401, 112, 2, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(402, 112, 3, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(403, 112, 4, 6, 0, 1, '2025-04-30 13:40:53', '2025-04-30 13:40:53'),
(404, 113, 1, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(405, 113, 2, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(406, 113, 3, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(407, 113, 4, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(408, 114, 1, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(409, 114, 2, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(410, 114, 3, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(411, 114, 4, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(412, 115, 1, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(413, 115, 2, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(414, 115, 3, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(415, 115, 4, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(416, 116, 1, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(417, 116, 2, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(418, 116, 3, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(419, 116, 4, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(420, 117, 1, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(421, 117, 2, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(422, 117, 3, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(423, 117, 4, 6, 0, 1, '2025-04-30 13:44:12', '2025-04-30 13:44:12'),
(424, 118, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(425, 118, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(426, 118, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(427, 118, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(428, 119, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(429, 119, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(430, 119, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(431, 119, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(432, 120, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(433, 120, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(434, 120, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(435, 120, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(436, 121, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(437, 121, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(438, 121, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(439, 121, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(440, 122, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(441, 122, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(442, 122, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(443, 122, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(444, 123, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(445, 123, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(446, 123, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(447, 123, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(448, 124, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(449, 124, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(450, 124, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(451, 124, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(452, 125, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(453, 125, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(454, 125, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(455, 125, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(456, 126, 1, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(457, 126, 2, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(458, 126, 3, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(459, 126, 4, 6, 0, 1, '2025-04-30 13:49:14', '2025-04-30 13:49:14'),
(460, 127, 5, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(461, 127, 6, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(462, 127, 7, 3, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(463, 128, 5, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(464, 128, 6, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(465, 128, 7, 3, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(466, 129, 5, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(467, 129, 6, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(468, 129, 7, 3, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(469, 130, 5, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(470, 130, 6, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(471, 130, 7, 3, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(472, 131, 5, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(473, 131, 6, 6, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(474, 131, 7, 3, 0, 1, '2025-04-30 13:51:40', '2025-04-30 13:51:40'),
(475, 132, 5, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(476, 132, 6, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(477, 132, 7, 3, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(478, 133, 5, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(479, 133, 6, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(480, 133, 7, 3, 1, 1, '2025-04-30 13:56:05', '2025-04-30 14:58:11'),
(481, 134, 5, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(482, 134, 6, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(483, 134, 7, 3, 1, 1, '2025-04-30 13:56:05', '2025-04-30 15:01:38'),
(484, 135, 5, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(485, 135, 6, 6, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(486, 135, 7, 3, 0, 1, '2025-04-30 13:56:05', '2025-04-30 13:56:05'),
(487, 136, 1, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(488, 136, 2, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(489, 136, 3, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(490, 136, 4, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(491, 137, 1, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(492, 137, 2, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(493, 137, 3, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(494, 137, 4, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(495, 138, 1, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(496, 138, 2, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(497, 138, 3, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(498, 138, 4, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(499, 139, 1, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(500, 139, 2, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(501, 139, 3, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(502, 139, 4, 6, 0, 1, '2025-04-30 13:59:42', '2025-04-30 13:59:42'),
(503, 140, 1, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(504, 140, 2, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(505, 140, 3, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(506, 140, 4, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(507, 141, 1, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(508, 141, 2, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(509, 141, 3, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(510, 141, 4, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(511, 142, 1, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(512, 142, 2, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(513, 142, 3, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(514, 142, 4, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(515, 143, 1, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(516, 143, 2, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(517, 143, 3, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(518, 143, 4, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(519, 144, 1, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(520, 144, 2, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(521, 144, 3, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(522, 144, 4, 6, 0, 1, '2025-04-30 14:01:59', '2025-04-30 14:01:59'),
(523, 145, 1, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(524, 145, 2, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(525, 145, 3, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(526, 145, 4, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(527, 146, 1, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(528, 146, 2, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(529, 146, 3, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(530, 146, 4, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(531, 147, 1, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(532, 147, 2, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(533, 147, 3, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(534, 147, 4, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(535, 148, 1, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(536, 148, 2, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(537, 148, 3, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(538, 148, 4, 6, 0, 1, '2025-04-30 14:04:54', '2025-04-30 14:04:54'),
(539, 149, 1, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(540, 149, 2, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(541, 149, 3, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(542, 149, 4, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(543, 150, 1, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(544, 150, 2, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(545, 150, 3, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(546, 150, 4, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(547, 151, 1, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(548, 151, 2, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(549, 151, 3, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(550, 151, 4, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(551, 152, 1, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(552, 152, 2, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(553, 152, 3, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(554, 152, 4, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(555, 153, 1, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(556, 153, 2, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(557, 153, 3, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(558, 153, 4, 6, 0, 1, '2025-04-30 14:08:37', '2025-04-30 14:08:37'),
(559, 154, 1, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(560, 154, 2, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(561, 154, 3, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(562, 154, 4, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(563, 155, 5, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(564, 155, 6, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(565, 155, 7, 3, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(566, 156, 1, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(567, 156, 2, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(568, 156, 3, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(569, 156, 4, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(570, 157, 5, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(571, 157, 6, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(572, 157, 7, 3, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(573, 158, 1, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(574, 158, 2, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(575, 158, 3, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(576, 158, 4, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(577, 159, 5, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(578, 159, 6, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(579, 159, 7, 3, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(580, 160, 1, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(581, 160, 2, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(582, 160, 3, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(583, 160, 4, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(584, 161, 5, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(585, 161, 6, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(586, 161, 7, 3, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(587, 162, 1, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(588, 162, 2, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(589, 162, 3, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(590, 162, 4, 6, 0, 1, '2025-04-30 14:14:58', '2025-04-30 14:14:58'),
(591, 163, 1, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(592, 163, 2, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(593, 163, 3, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(594, 163, 4, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(595, 164, 1, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(596, 164, 2, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(597, 164, 3, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(598, 164, 4, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(599, 165, 1, 6, 1, 1, '2025-04-30 14:17:31', '2025-04-30 15:02:21'),
(600, 165, 2, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(601, 165, 3, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(602, 165, 4, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(603, 166, 1, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(604, 166, 2, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(605, 166, 3, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(606, 166, 4, 6, 0, 1, '2025-04-30 14:17:31', '2025-04-30 14:17:31'),
(607, 167, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(608, 167, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(609, 167, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(610, 167, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(611, 168, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(612, 168, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(613, 168, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(614, 168, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(615, 169, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(616, 169, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(617, 169, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(618, 169, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(619, 170, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(620, 170, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(621, 170, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(622, 170, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(623, 171, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(624, 171, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(625, 171, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(626, 171, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(627, 172, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(628, 172, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(629, 172, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(630, 172, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(631, 173, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(632, 173, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(633, 173, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(634, 173, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(635, 174, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(636, 174, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(637, 174, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(638, 174, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(639, 175, 1, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(640, 175, 2, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(641, 175, 3, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(642, 175, 4, 6, 0, 1, '2025-04-30 14:21:03', '2025-04-30 14:21:03'),
(643, 176, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(644, 176, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(645, 176, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(646, 176, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(647, 177, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(648, 177, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(649, 177, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(650, 177, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(651, 178, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(652, 178, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(653, 178, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(654, 178, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(655, 179, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(656, 179, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(657, 179, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(658, 179, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(659, 180, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(660, 180, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(661, 180, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(662, 180, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(663, 181, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(664, 181, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(665, 181, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(666, 181, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(667, 182, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(668, 182, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(669, 182, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(670, 182, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(671, 183, 1, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(672, 183, 2, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(673, 183, 3, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(674, 183, 4, 6, 0, 1, '2025-04-30 14:24:47', '2025-04-30 14:24:47'),
(675, 184, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(676, 184, 2, 6, 1, 1, '2025-04-30 14:28:18', '2025-04-30 14:59:02'),
(677, 184, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(678, 184, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(679, 185, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(680, 185, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(681, 185, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(682, 185, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(683, 186, 5, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(684, 186, 6, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(685, 186, 7, 3, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(686, 187, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(687, 187, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(688, 187, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(689, 187, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(690, 188, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(691, 188, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(692, 188, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(693, 188, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(694, 189, 5, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(695, 189, 6, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(696, 189, 7, 3, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(697, 190, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(698, 190, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(699, 190, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(700, 190, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(701, 191, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(702, 191, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(703, 191, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(704, 191, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(705, 192, 5, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(706, 192, 6, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(707, 192, 7, 3, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(708, 193, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(709, 193, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(710, 193, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(711, 193, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(712, 194, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(713, 194, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(714, 194, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(715, 194, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(716, 195, 5, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(717, 195, 6, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(718, 195, 7, 3, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(719, 196, 1, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(720, 196, 2, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(721, 196, 3, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(722, 196, 4, 6, 0, 1, '2025-04-30 14:28:18', '2025-04-30 14:28:18'),
(723, 197, 1, 6, 0, 1, '2025-05-06 01:13:18', '2025-05-06 01:13:18'),
(724, 197, 2, 6, 0, 1, '2025-05-06 01:13:18', '2025-05-06 01:13:18'),
(725, 197, 3, 6, 0, 1, '2025-05-06 01:13:18', '2025-05-06 01:13:18'),
(726, 197, 4, 6, 0, 1, '2025-05-06 01:13:18', '2025-05-06 01:13:18'),
(727, 198, 1, 6, 0, 1, '2025-05-06 01:14:55', '2025-05-06 01:14:55'),
(728, 198, 2, 6, 0, 1, '2025-05-06 01:14:55', '2025-05-06 01:14:55'),
(729, 198, 3, 6, 0, 1, '2025-05-06 01:14:55', '2025-05-06 01:14:55'),
(730, 198, 4, 6, 0, 1, '2025-05-06 01:14:55', '2025-05-06 01:14:55'),
(731, 199, 5, 6, 0, 1, '2025-05-06 01:14:55', '2025-05-06 01:14:55'),
(732, 199, 6, 6, 0, 1, '2025-05-06 01:14:55', '2025-05-06 01:14:55'),
(733, 199, 7, 3, 0, 1, '2025-05-06 01:14:55', '2025-05-06 01:14:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsu`
--

CREATE TABLE `lichsu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `noidung` text NOT NULL,
  `thoigian` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsu`
--

INSERT INTO `lichsu` (`id`, `noidung`, `thoigian`) VALUES
(1, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 12:39:54'),
(2, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 12:40:30'),
(3, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 12:40:56'),
(4, 'Người dùng có tên tài khoản KhachHang (tranvanb@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 12:42:34'),
(5, 'Người dùng QuanLy (quanly@example.com) đã thêm Cơ Sở \"Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1\" vào CSDL!', '2025-04-23 12:51:29'),
(6, 'Người dùng QuanLy (quanly@example.com) đã thêm Cơ Sở \"Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 2\" vào CSDL!', '2025-04-23 12:54:51'),
(7, 'Người dùng QuanLy (quanly@example.com) đã thêm Cơ Sở \"Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 3 (Y học cổ truyền kết hợp y học hiện đại)\" vào CSDL!', '2025-04-23 13:00:02'),
(8, 'Người dùng QuanLy (quanly@example.com) đã thêm Cơ Sở \"Bệnh viện Nhân Dân 115\" vào CSDL!', '2025-04-23 14:07:22'),
(9, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"BỆNH LÝ CỘT SỐNG\" vào CSDL!', '2025-04-23 14:10:48'),
(10, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"CHĂM SÓC GIẢM NHẸ\" vào CSDL!', '2025-04-23 14:11:15'),
(11, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"CHUYÊN GIA THẦN KINH\" vào CSDL!', '2025-04-23 14:11:35'),
(12, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"DA LIỄU\" vào CSDL!', '2025-04-23 14:12:16'),
(13, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"KHÁM CHỨC NĂNG HÔ HẤP\" vào CSDL!', '2025-04-23 14:15:37'),
(14, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"KHÁM DA LIỄU\" vào CSDL!', '2025-04-23 14:16:50'),
(15, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"KHÁM ĐIỀU TRỊ VẾT THƯƠNG\" vào CSDL!', '2025-04-23 14:17:30'),
(16, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"KHÁM HẬU MÔN - TRỰC TRÀNG\" vào CSDL!', '2025-04-23 14:18:11'),
(17, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"KHÁM DINH DƯỠNG\" vào CSDL!', '2025-04-23 14:20:01'),
(18, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"NỘI TỔNG QUÁT\" vào CSDL!', '2025-04-23 14:20:31'),
(19, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"DA - THẨM MỸ YHCT\" vào CSDL!', '2025-04-23 14:21:18'),
(20, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"NHI -YHCT\" vào CSDL!', '2025-04-23 14:21:58'),
(21, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"CƠ XƯƠNG KHỚP\" vào CSDL!', '2025-04-23 14:25:04'),
(22, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"DA LIỄU\" vào CSDL!', '2025-04-23 14:25:37'),
(23, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"HÔ HẤP\" vào CSDL!', '2025-04-23 14:26:41'),
(24, 'Người dùng QuanLy (quanly@example.com) đã thêm Chuyên Khoa \"NGOẠI CHẤN THƯƠNG\" vào CSDL!', '2025-04-23 14:27:51'),
(25, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Đào Nguyễn Trung Luân\" vào CSDL!', '2025-04-23 14:32:21'),
(26, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Hoàng Nguyễn Anh Tuấn\" vào CSDL!', '2025-04-23 14:38:09'),
(27, 'Người dùng QuanLy (quanly@example.com) đã cập nhật thông tin Lịch Khám của bác sĩ \"ThS BS..Hoàng Nguyễn Anh Tuấn(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\" vào CSDL', '2025-04-23 14:38:39'),
(28, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Huỳnh Quốc Bảo\" vào CSDL!', '2025-04-23 14:42:05'),
(29, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Lê Tường Viễn\" vào CSDL!', '2025-04-23 14:45:00'),
(30, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Đỗ Hữu Thành\" vào CSDL!', '2025-04-23 14:51:44'),
(31, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Ngọc Hoành Mỹ Tiên\" vào CSDL!', '2025-04-23 14:58:35'),
(32, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Thị Minh Ngọc\" vào CSDL!', '2025-04-23 15:03:40'),
(33, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Trịnh Thị Bích Hà\" vào CSDL!', '2025-04-23 15:08:26'),
(34, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 15:10:07'),
(35, 'Người dùng có tên tài khoản NguoiDangTin (dangtin@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 15:10:17'),
(36, 'Người dùng NguoiDangTin (dangtin@example.com) đã thêm Tin Tức \"Top 4 bệnh viện tầm soát ung thư uy tín tại TPHCM\" vào CSDL!', '2025-04-23 15:29:06'),
(37, 'Người dùng NguoiDangTin (dangtin@example.com) đã thêm Tin Tức \"Tổng đài đặt khám Bệnh viện Đại học Y dược và hơn 50 bệnh viện\" vào CSDL!', '2025-04-23 15:31:57'),
(38, 'Người dùng NguoiDangTin (dangtin@example.com) đã thêm Tin Tức \"Khám hiếm muộn gồm những gì? Nên khám ở đâu TPHCM\" vào CSDL!', '2025-04-23 15:35:22'),
(39, 'Người dùng NguoiDangTin (dangtin@example.com) đã thêm Tin Tức \"Tư vấn tâm lý Online 1 - 1 với bác sĩ giỏi\" vào CSDL!', '2025-04-23 15:38:03'),
(40, 'Người dùng NguoiDangTin (dangtin@example.com) đã cập nhật Tin Tức \"Tư vấn tâm lý Online 1 - 1 với bác sĩ giỏi\" vào CSDL!', '2025-04-23 15:38:30'),
(41, 'Người dùng NguoiDangTin (dangtin@example.com) đã thêm Tin Tức \"Bệnh viêm hô hấp ở trẻ em: dấu hiệu và nguyên nhân\" vào CSDL!', '2025-04-23 15:41:29'),
(42, 'Người dùng có tên tài khoản NguoiDangTin (dangtin@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 15:42:30'),
(43, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 15:42:38'),
(44, 'Người dùng QuanLy (quanly@example.com) đã cập nhật trạng thái \"Đã duyệt\" cho Tin Tức \"Bệnh viêm hô hấp ở trẻ em: dấu hiệu và nguyên nhân\" vào CSDL!', '2025-04-23 15:42:56'),
(45, 'Người dùng QuanLy (quanly@example.com) đã cập nhật trạng thái \"Đã duyệt\" cho Tin Tức \"Tư vấn tâm lý Online 1 - 1 với bác sĩ giỏi\" vào CSDL!', '2025-04-23 15:43:09'),
(46, 'Người dùng QuanLy (quanly@example.com) đã cập nhật trạng thái \"Đã duyệt\" cho Tin Tức \"Khám hiếm muộn gồm những gì? Nên khám ở đâu TPHCM\" vào CSDL!', '2025-04-23 15:43:25'),
(47, 'Người dùng QuanLy (quanly@example.com) đã cập nhật trạng thái \"Đã duyệt\" cho Tin Tức \"Top 4 bệnh viện tầm soát ung thư uy tín tại TPHCM\" vào CSDL!', '2025-04-23 15:43:40'),
(48, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Nguyễn Thành Phát\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-23 15:46:28'),
(49, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Nguyễn Thị Cẩm Nhung\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-23 15:48:45'),
(50, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Phạm Thị Ánh Nguyệt\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-23 15:50:54'),
(51, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Võ Thành Đạt\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đỗ Hữu Thành(CHĂM SÓC GIẢM NHẸ - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-23 15:54:43'),
(52, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 15:55:12'),
(53, 'Người dùng có tên tài khoản NguoiDangTin (dangtin@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 15:55:43'),
(54, 'Người dùng có tên tài khoản NguoiDangTin (dangtin@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 15:55:49'),
(55, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 15:55:56'),
(56, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 16:07:05'),
(57, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 16:07:13'),
(58, 'Người dùng Admin (admin@example.com) đã thêm Nhân Viên \"Vương Thế Bích Thanh(Admin - admin@example.com)\" vào CSDL!', '2025-04-23 16:09:46'),
(59, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 16:10:00'),
(60, 'Người dùng có tên tài khoản NHANVIENBENHVIEN01 (nvbv@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 16:10:16'),
(61, 'Người dùng có tên tài khoản NHANVIENBENHVIEN01 (nvbv@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 16:14:09'),
(62, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 16:14:17'),
(63, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng xuất khỏi hệ thống!', '2025-04-23 16:15:42'),
(64, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng nhập vào hệ thống!', '2025-04-23 16:15:50'),
(65, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng nhập vào hệ thống!', '2025-04-30 19:18:12'),
(66, 'Người dùng có tên tài khoản DatVo03 (vtd@gmail.com) đã đăng xuất khỏi hệ thống!', '2025-04-30 19:26:54'),
(67, 'Người dùng có tên tài khoản DatVo03 (vtd@gmail.com) đã đăng nhập vào hệ thống!', '2025-04-30 19:28:13'),
(68, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Đinh Huỳnh Tố Hương\" vào CSDL!', '2025-04-30 19:55:46'),
(69, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Bá Thắng\" vào CSDL!', '2025-04-30 19:58:08'),
(70, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Phạm Thành Trung\" vào CSDL!', '2025-04-30 20:02:01'),
(71, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Phạm Thị Ngọc Quyên\" vào CSDL!', '2025-04-30 20:04:55'),
(72, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Lê Minh Phúc\" vào CSDL!', '2025-04-30 20:13:04'),
(73, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Lê Thái Vân Thanh\" vào CSDL!', '2025-04-30 20:17:01'),
(74, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Lê Vi Anh\" vào CSDL!', '2025-04-30 20:19:15'),
(75, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Ngô Anh Tuấn\" vào CSDL!', '2025-04-30 20:21:57'),
(76, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Bùi Đại Lịch\" vào CSDL!', '2025-04-30 20:25:15'),
(77, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Huỳnh Minh Sang\" vào CSDL!', '2025-04-30 20:29:24'),
(78, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Ngô Thanh Bình\" vào CSDL!', '2025-04-30 20:33:07'),
(79, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Thị Thu Ba\" vào CSDL!', '2025-04-30 20:36:46'),
(80, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Lê Ngọc Diệp\" vào CSDL!', '2025-04-30 20:40:53'),
(81, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Thị Ngọc Mỹ\" vào CSDL!', '2025-04-30 20:44:12'),
(82, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Trần Thị Thanh Mai\" vào CSDL!', '2025-04-30 20:49:14'),
(83, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Võ Quang Đỉnh\" vào CSDL!', '2025-04-30 20:51:40'),
(84, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Hồ Xuân Dũng\" vào CSDL!', '2025-04-30 20:56:05'),
(85, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Dương Bá Lập\" vào CSDL!', '2025-04-30 20:59:42'),
(86, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Hải Sơn\" vào CSDL!', '2025-04-30 21:01:59'),
(87, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Phát Đạt\" vào CSDL!', '2025-04-30 21:04:54'),
(88, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Văn Hải\" vào CSDL!', '2025-04-30 21:08:37'),
(89, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Dương Thị Ngọc Lan\" vào CSDL!', '2025-04-30 21:14:58'),
(90, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Bùi Phạm Minh Mẫn\" vào CSDL!', '2025-04-30 21:17:31'),
(91, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Huỳnh Tấn Vũ\" vào CSDL!', '2025-04-30 21:21:03'),
(92, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Trần Thu Nga\" vào CSDL!', '2025-04-30 21:24:47'),
(93, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Thái Dương\" vào CSDL!', '2025-04-30 21:28:18'),
(94, 'Người dùng có tên tài khoản DatVo03 (vtd@gmail.com) đã đăng nhập vào hệ thống!', '2025-04-30 21:30:05'),
(95, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Nguyễn Thị Minh Ngọc\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đinh Huỳnh Tố Hương(CHUYÊN GIA THẦN KINH - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:34:56'),
(96, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Nguyễn Thị Minh Ngọc\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:35:58'),
(97, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Lê Thái Vân Thanh\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:38:20'),
(98, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Mai Ngọc Quyên\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:39:35'),
(99, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Phan Triều Vỹ\" đã đặt lịch khám của Bác sĩ \"ThS BS.Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:44:34'),
(100, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Lê Thái Vân Thanh\" đã đặt lịch khám của Bác sĩ \"TS BS.Nguyễn Bá Thắng(CHUYÊN GIA THẦN KINH - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:45:27'),
(101, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Bùi Thị Kim\" đã đặt lịch khám của Bác sĩ \"BS CKI.Lê Minh Phúc(DA LIỄU - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:47:45'),
(102, 'Người dùng QuanLy (quanly@example.com) đã cập nhật trạng thái \"Đã khám\" cho Lịch Hẹn của bệnh nhân \"Nguyễn Thị Cẩm Nhungthuộc tài khoản KhachHang(tranvanb@example.com) đặt khám với bác sĩ ThS BS..Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\" vào CSDL', '2025-04-30 21:51:10'),
(103, 'Người dùng QuanLy (quanly@example.com) đã cập nhật trạng thái \"Đã khám\" cho Lịch Hẹn của bệnh nhân \"Phạm Thị Ánh Nguyệtthuộc tài khoản KhachHang(tranvanb@example.com) đặt khám với bác sĩ ThS BS..Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\" vào CSDL', '2025-04-30 21:51:21'),
(104, 'Người dùng DatVo03 (vtd@gmail.com) có hồ sơ Bệnh nhân \"Lê Thái Vân Thanh\" đã đặt lịch khám của Bác sĩ \"BS CKII.Lê Vi Anh(DA LIỄU - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 21:53:13'),
(105, 'Người dùng có tên tài khoản DatVo03 (vtd@gmail.com) đã đăng xuất khỏi hệ thống!', '2025-04-30 21:53:56'),
(106, 'Người dùng DatVo04 (vtd1@gmail.com) có hồ sơ Bệnh nhân \"Nguyễn Thắng\" đã đặt lịch khám của Bác sĩ \"BS CKII.Huỳnh Minh Sang(KHÁM CHỨC NĂNG HÔ HẤP - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 2)\"', '2025-04-30 21:56:40'),
(107, 'Người dùng DatVo04 (vtd1@gmail.com) có hồ sơ Bệnh nhân \"Lê Thị Diệp\" đã đặt lịch khám của Bác sĩ \"BS CKII.Hồ Xuân Dũng(KHÁM ĐIỀU TRỊ VẾT THƯƠNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 2)\"', '2025-04-30 21:58:11'),
(108, 'Người dùng DatVo04 (vtd1@gmail.com) có hồ sơ Bệnh nhân \"Lê Thị Diệp\" đã đặt lịch khám của Bác sĩ \"ThS BS.Nguyễn Thái Dương(NHI -YHCT - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 3 (Y học cổ truyền kết hợp y học hiện đại))\"', '2025-04-30 21:59:02'),
(109, 'Người dùng có tên tài khoản DatVo04 (vtd1@gmail.com) đã đăng xuất khỏi hệ thống!', '2025-04-30 21:59:49'),
(110, 'Người dùng có tên tài khoản KhachHang (tranvanb@example.com) đã đăng nhập vào hệ thống!', '2025-04-30 22:00:02'),
(111, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Nguyễn Thành Phát\" đã đặt lịch khám của Bác sĩ \"ThS BS.Phạm Thành Trung(CHUYÊN GIA THẦN KINH - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\"', '2025-04-30 22:00:42'),
(112, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Nguyễn Thành Phát\" đã đặt lịch khám của Bác sĩ \"BS CKII.Huỳnh Minh Sang(KHÁM CHỨC NĂNG HÔ HẤP - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 2)\"', '2025-04-30 22:01:09'),
(113, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Võ Thành Đạt\" đã đặt lịch khám của Bác sĩ \"BS CKII.Hồ Xuân Dũng(KHÁM ĐIỀU TRỊ VẾT THƯƠNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 2)\"', '2025-04-30 22:01:38'),
(114, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Phạm Thị Ánh Nguyệt\" đã đặt lịch khám của Bác sĩ \"ThS BS.Bùi Phạm Minh Mẫn(NỘI TỔNG QUÁT - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 3 (Y học cổ truyền kết hợp y học hiện đại))\"', '2025-04-30 22:02:21'),
(115, 'Người dùng KhachHang (tranvanb@example.com) có hồ sơ Bệnh nhân \"Nguyễn Thị Cẩm Nhung\" đã đặt lịch khám của Bác sĩ \"TS BS.Bùi Đại Lịch(KHÁM CHỨC NĂNG HÔ HẤP - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 2)\"', '2025-04-30 22:03:20'),
(116, 'Người dùng có tên tài khoản Thị Cẩm Nhung Nguyễn (nguyenthicamnhung070524@gmail.com) đã đăng nhập vào hệ thống!', '2025-05-06 08:12:15'),
(117, 'Người dùng có tên tài khoản Thị Cẩm Nhung Nguyễn (nguyenthicamnhung070524@gmail.com) đã đăng xuất khỏi hệ thống!', '2025-05-06 08:12:22'),
(118, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng nhập vào hệ thống!', '2025-05-06 08:12:31'),
(119, 'Người dùng QuanLy (quanly@example.com) đã thêm Lịch Khám cho bác sĩ \"ThS BS..Đào Nguyễn Trung Luân(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\" vào CSDL', '2025-05-06 08:13:18'),
(120, 'Người dùng QuanLy (quanly@example.com) đã thêm Bác Sĩ \"Nguyễn Thị Cẩm Nhung\" vào CSDL!', '2025-05-06 08:14:55'),
(121, 'Người dùng QuanLy (quanly@example.com) đã xóa Lịch Khám của bác sĩ \"ThS BS..Hoàng Nguyễn Anh Tuấn(BỆNH LÝ CỘT SỐNG - Bệnh viện Đại học Y Dược TP.HCM-Cơ Sở 1)\" khỏi CSDL', '2025-05-06 08:15:53'),
(122, 'Người dùng có tên tài khoản QuanLy (quanly@example.com) đã đăng nhập vào hệ thống!', '2025-05-06 08:33:34'),
(123, 'Người dùng có tên tài khoản Thị Cẩm Nhung Nguyễn (nguyenthicamnhung070524@gmail.com) đã đăng nhập vào hệ thống!', '2025-05-06 09:04:25'),
(124, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng nhập vào hệ thống!', '2025-05-06 09:09:39'),
(125, 'Người dùng Admin (admin@example.com) đã thêm Nhân Viên \"Nguyễn Thị Cẩm Nhung(NVQuanLy - nguyenthicamnhung070524@gmail.com)\" vào CSDL!', '2025-05-06 09:10:30'),
(126, 'Người dùng có tên tài khoản Admin (admin@example.com) đã đăng xuất khỏi hệ thống!', '2025-05-06 09:10:42'),
(127, 'Người dùng có tên tài khoản NVQuanLy (nguyenthicamnhung070524@gmail.com) đã đăng nhập vào hệ thống!', '2025-05-06 09:10:52'),
(128, 'Người dùng có tên tài khoản NVQuanLy (nguyenthicamnhung070524@gmail.com) đã đăng xuất khỏi hệ thống!', '2025-05-06 09:14:00'),
(129, 'Người dùng có tên tài khoản KhachHang (tranvanb@example.com) đã đăng nhập vào hệ thống!', '2025-05-06 09:22:06'),
(130, 'Người dùng có tên tài khoảnKhachHang (tranvanb@example.com) đã cập nhật thông tin cá nhân!', '2025-05-06 09:24:27'),
(131, 'Người dùng có tên tài khoảnKhachHang (tranvanb@example.com) đã cập nhật thông tin cá nhân!', '2025-05-06 09:29:44'),
(132, 'Người dùng có tên tài khoảnKhachHang (tranvanb@example.com) đã đổi mật khẩu!', '2025-05-06 09:38:47'),
(133, 'Người dùng có tên tài khoản KhachHang (tranvanb@example.com) đã đăng xuất khỏi hệ thống!', '2025-05-06 09:39:03'),
(134, 'Người dùng có tên tài khoản KhachHang (tranvanb@example.com) đã đăng nhập vào hệ thống!', '2025-05-06 09:39:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_coso` bigint(20) UNSIGNED DEFAULT NULL,
  `hoten` varchar(255) NOT NULL,
  `sodienthoai` varchar(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `gioitinh` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `id_user`, `id_coso`, `hoten`, `sodienthoai`, `diachi`, `gioitinh`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Nguyễn Văn Admin', '0987654321', '123 Đường ABC, TP.HCM', 'Nam', NULL, '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(2, 2, NULL, 'Nguyễn Văn A', '0987654345', '123 Đường ABC, TP.HCM', 'Nam', NULL, '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(3, 3, NULL, 'Nguyễn Thị A', '0987654538', '123 Đường ABC, TP.HCM', 'Nữ', NULL, '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(4, 5, 1, 'Vương Thế Bích Thanh', '0915603119', 'TP.HCM', 'Nữ', NULL, '2025-04-23 09:09:46', '2025-04-23 09:09:46'),
(5, 9, NULL, 'Nguyễn Thị Cẩm Nhung', '02838553245', 'An Giang', 'Nữ', NULL, '2025-05-06 02:10:30', '2025-05-06 02:10:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4utoIidzylyHq4PM3QfG4jZnh7hPo7n4m1iFchD3', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNHZnMzB3bXI2anhjbUlqMUJkclY4RzNwazZXOGJyVGFVa1ZQN0FFdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1746499158);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nhanvien` bigint(20) UNSIGNED NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `noidung` text NOT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `loai` tinyint(4) NOT NULL,
  `trangthai` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`id`, `id_nhanvien`, `tieude`, `mota`, `noidung`, `hinhanh`, `loai`, `trangthai`, `created_at`, `updated_at`) VALUES
(1, 3, 'Top 4 bệnh viện tầm soát ung thư uy tín tại TPHCM', 'Tầm soát ung thư ở đâu tốt? Chi phí tầm soát có đắt không? Medpro xin giới thiệu danh sách những bệnh viện tầm soát ung thư uy tín tại TPHCM.', '<p>Ung thư là một trong những nguyên nhân gây tử vong hàng đầu trên thế giới, đặc biệt là ung thư vú và ung thư phổi. Tính đến năm 2024, tại Việt Nam đã có hơn 183.000 ca mắc mới mỗi ngày, trên 122.000 ca gây tử vong do ung thư và có đến khoảng 354.000 người đang sống chung với ung thư. Việc<strong> tầm soát ung thư định kỳ</strong> là một trong những cách hiệu quả nhất để phát hiện ung thư từ sớm để kịp thời điều trị và giảm tỷ lệ tử vong do ung thư một cách đáng kể.</p><p>Hiện nay, tại TPHCM có rất nhiều bệnh viện, phòng khám cung cấp dịch vụ tầm soát ung thư tổng quát. Tuy nhiên, việc tìm kiếm một địa chỉ cơ sở uy tín để cho ra kết quả chính xác, an toàn và đáng tin cậy lại là điều không hề đơn giản. Trong bài viết này, EbookCare sẽ tổng hợp các bệnh viện tầm soát ung thư uy tín tại TPHCM dựa trên trình độ chuyên môn của bác sĩ, cơ sở vật chất, chất lượng dịch vụ và chi phí khám để bạn đọc có thể tham khảo và chọn lựa.</p><h2><strong>Top 4 bệnh viện tầm soát ung thư uy tín tại TPHCM</strong></h2><h3><strong>Bệnh viện Đại học Y Dược TPHCM</strong></h3><p>Nằm trong top những địa chỉ tin cậy hàng đầu cho nhu cầu tầm soát ung thư tại TP.HCM, <a href=\"https://medpro.vn/benh-vien-dai-hoc-y-duoc-co-so-1\"><strong>Bệnh viện Đại học Y Dược TP.HCM</strong></a> luôn được người dân tín nhiệm bởi chất lượng khám chữa bệnh uy tín đã được khẳng định qua nhiều năm. Đặc biệt, khoa Hóa trị ung thư của bệnh viện chuyên điều trị các loại bệnh ung thư với nhiều ca phẫu thuật thành công trong những năm qua.</p><ul><li>Khoa chuyên khám và điều trị các bệnh lý về ung thư bao gồm:<ul><li>Ung thư phổi;</li><li>Ung thư dạ dày;</li><li>Ung thư gan;</li><li>Ung thư đại trực tràng;</li><li>Ung thư tuyến vú;</li><li>Ung thư vòm họng;</li><li>Ung thư dạ dày.</li></ul></li><li>Cập nhật và áp dụng những chiến lược điều trị, phác đồ hóa trị mới nhất vào thực hành lâm sàng, mang đến cho người bệnh những lợi ích từ các nghiên cứu khoa học tiên tiến.</li><li>Thực hiện hội chẩn đa mô thức thường xuyên với các khoa lâm sàng trong bệnh viện như Ngoại Tiêu hoá, Ung Bướu Gan Mật và Ghép gan, Lồng ngực - Mạch máu, Tai - Mũi - Họng để đưa ra quyết định điều trị tối ưu cho các trường hợp bệnh ung thư mới, phức tạp, khó chẩn đoán và điều trị.</li><li>Cho phép bệnh nhân hóa trị có các bệnh lý nội khoa mãn tính đi kèm được điều trị song song và toàn diện cùng với các chuyên khoa khác.</li><li>Phối hợp chặt chẽ với các bệnh viện trong thành phố như Quân Y 175, Ung Bướu, Chợ Rẫy, 115, FV, Vinmec... để điều trị cho những người bệnh ung thư có chỉ định xạ trị.</li><li>Hợp tác với các chuyên gia quốc tế hàng đầu trong các lĩnh vực ung thư như vú, phổi, tiêu hoá, tiết niệu... đến từ các đại học danh tiếng của Hoa Kỳ, Anh, Italia, Australia, Hungary... để hội chẩn, chẩn đoán và điều trị những trường hợp ung thư khó hoặc hiếm gặp.</li></ul><p>Khi tầm soát ung thư tại đây, bạn sẽ được thăm khám bởi các bác sĩ là những chuyên gia đầu ngành như<strong> Bác sĩ Lâm Quốc Trung - Là Phó Trưởng Khoa Hóa trị ung thư; Bác sĩ Hoàng Thị Mai Hiền; ThS BS. Hoàng Đình Kính Khoa Hóa trị ung thư.</strong></p><p>Phòng điều trị được trang bị đầy đủ các trang thiết bị hiện đại, đáp ứng mọi nhu cầu của quá trình điều trị hóa trị. Từ ghế hóa trị cao cấp mang lại sự thoải mái cho bệnh nhân, đến máy bơm tiêm truyền tự động với khả năng điều chỉnh tốc độ truyền thuốc chính xác, máy monitor theo dõi sát sao các chỉ số sinh hiệu, và máy hút chân không hỗ trợ pha chế thuốc hóa trị an toàn.</p>', 'upload/tintuc/1745396946.png', 1, 1, '2025-04-23 08:29:06', '2025-04-23 08:43:40'),
(2, 3, 'Tổng đài đặt khám Bệnh viện Đại học Y dược và hơn 50 bệnh viện', 'Tìm hiểu chi tiết tổng đài đặt khám bệnh viện đại học y dược và hơn 50 bệnh lớn 1900 2115 giúp người bệnh nhanh chóng được hỗ trợ đặt lịch khám.', '<p>Tổng đài đặt khám Bệnh viện Đại học Y dược và hơn 50 bệnh lớn được nhiều người quan tâm để tham khảo khi có nhu cầu cần khám chữa bệnh tại các cơ sở uy tín. Điều này giúp mọi người tiết kiệm nhiều thời gian chờ đợi so với quá trình đi khám truyền thống. Cùng xem chi tiết các thông tin bên dưới của Medpro để cập nhật ngay.</p><h2>Tổng đài đặt khám bệnh viện Đại học Y dược và hơn 50 bệnh viện lớn</h2><p>Tổng đài đặt lịch khám bệnh 1900 2115 của Medpro được thiết lập để hỗ trợ các bệnh nhân, khách hàng khi có nhu cầu đặt lịch khám không chỉ ở bệnh viện Đại học Y dược mà còn ở các bệnh viện, cơ sở y tế chất lượng cao tại TPHCM và các tỉnh thành lân cận. Khi liên hệ tổng đài, mọi người sẽ được:</p><ul><li>Cung cấp thông tin về dịch vụ y tế: Chi tiết các thông tin về bệnh viện, cơ sở y tế được cập nhật đầy đủ để khách hàng hiểu rõ hơn trước khi chủ động đặt lịch khám.</li><li>Đặt lịch khám online nhanh chóng, tiết kiệm thời gian chờ đợi: Với vài thao tác đơn giản, người bệnh được hỗ trợ hoàn tất thông tin cá nhân để hẹn lịch khám nhanh trong ngày.</li><li>Hướng dẫn sử dụng ứng dụng y tế Medpro: Khách hàng được tư vấn hướng dẫn các tính năng của ứng dụng Medpro, cách sử dụng Medpro để đặt lịch trong những trường hợp cần thiết…</li></ul><p>Dưới đây là danh sách hơn 50 bệnh viện lớn mà bạn có thể dễ dàng đặt lịch khám nhanh chóng và thuận tiện thông qua tổng đài <strong>1900 2115</strong>.</p><h3>Bệnh viện công</h3><ul><li>Bệnh viện Đại học Y Dược cơ sở 1</li><li>Bệnh viện Đại học Y dược cơ sở 2</li><li>Bệnh viện Đại học Y dược cơ sở 3</li><li>Bệnh viện Chợ Rẫy</li><li>Bệnh viện Nhi Đồng 1</li><li>Bệnh viện Nhi đồng Thành phố</li><li>Bệnh viện Nhân dân Gia Định</li><li>Bệnh viện Nhân dân 115</li><li>Bệnh viện Chấn thương chỉnh hình</li><li>Bệnh viện Trưng Vương</li><li>Bệnh viện Da Liễu</li><li>Bệnh Viện Quận Bình Thạnh</li><li>Bệnh viện Bệnh Nhiệt Đới</li><li>Bệnh viện Quận 12</li><li>Bệnh viện Mắt</li><li>Bệnh viện quận 1</li><li>Bệnh viện Nguyễn Trãi</li><li>Bệnh viện Thống Nhất</li><li>Bệnh viện Bưu điện</li></ul><h3>Bệnh viện tư</h3><ul><li>Bệnh viện Đa khoa Vạn Hạnh</li><li>Bệnh Viện Ngoại Khoa Sante</li><li>Bệnh viện Đa khoa Quốc Tế Hoàn Mỹ Thủ Đức</li><li>Bệnh viện Quốc tế City - CIH</li><li>Bệnh viện Gia An 115</li><li>Bệnh viện Quốc tế Minh Anh</li><li>Bệnh viện Phụ Sản Quốc Tế Sài Gòn</li><li>Bệnh Viện Đa Khoa Hồng Đức II</li><li>Bệnh viện thẩm mỹ Kangnam</li></ul>', 'upload/tintuc/1745397117.png', 2, 0, '2025-04-23 08:31:57', '2025-04-23 08:31:57'),
(3, 3, 'Khám hiếm muộn gồm những gì? Nên khám ở đâu TPHCM', 'Tìm hiểu khám hiếm muộn và quá trình khám cũng như các bệnh viện uy tín tại TPHCM.', '<h2>Khám hiếm muộn gồm những gì?</h2><p>Khám hiếm muộn là quá trình kiểm tra và chẩn đoán sức khỏe và khả năng sinh sản của cắp cặp vợ chồng để tìm ra nguyên nhân và giải pháp cho trường hợp hiếm muộn. Các bác sĩ khuyến cáo nên đi khám về hiếm muộn để tìm ra phác đồ điều trị nếu các cặp vợ chồng dù quan hệ tình dục đều đặn bình thường trong vòng 1 năm (nếu vợ dưới 35 tuổi), 6 tháng (nếu vợ trên 35 tuổi) nhưng vẫn chưa có thai.</p><p>Khi đến các bệnh viện và phòng khám uy tín, mọi người sẽ được thực hiện một số bước xét nghiệm lâm sàng.</p><p><strong>Đối với nữ:</strong></p><ul><li>Xét nghiệm máu, kiểm tra mức FSH vào ngày 2 vòng kinh hoặc AMH, siêu âm kiểm tra AFC để đánh giá chất lượng trứng ở người vợ.</li><li><a href=\"https://medpro.vn/tin-tuc/dia-chi-kham-phu-khoa-tin-cay\"><strong>Khám phụ khoa</strong></a></li><li>Khám tuyến vú</li><li>Cập nhật tình trạng kinh nguyệt mỗi tháng</li></ul><p><strong>Đối với nam:</strong></p><ul><li>Xét nghiệm nước tiểu sau khi người chồng xuất tinh</li><li>Siêu âm vùng bìu, tinh hoàn</li><li>Xét nghiệm tinh dịch đồ. Nhờ đó bác sĩ có thế đánh giá số lượng và chất lượng tinh trùng.</li><li>Xét nghiệm nội tiết tố nam</li></ul><h2>Đi khám hiếm muộn cần chuẩn bị gì không?</h2><p>Đối với những vợ chồng đang băn khoăn về lần đầu tiên đi khám, mọi người hãy lưu ý những điểm sau khi đi khám tại các bệnh viện về hiếm muộn:</p><ul><li>Mang theo giấy tờ tùy thân đầy đủ của cả vợ lẫn chồng</li><li>Mang theo các giấy tờ liên quan nếu trước đó từng mắc phải các bệnh lý về sinh sản hoặc sinh dục</li><li>Ăn uống lành mạnh, không sử dụng đồ uống có cồn hoặc các chất kích thích</li><li>Chuẩn bị tâm lý thoải mái, không lo lắng khiến quá trình xét nghiệm có nhiều vấn đề khó chịu</li></ul><h2>Khám hiếm muộn bao nhiêu tiền?</h2><p>Chi phí khám ở khoa hiếm muộn hiện nay thường dao động từ <strong>2.000.000 - 10.000.000/người</strong>. Tuy nhiên mức giá cụ thể sẽ tùy thuộc vào từng bệnh viện cũng như từng phác đồ điều trị khác nhau của các bác sĩ.</p><p>Đừng lo lắng vì <strong>Medpro</strong> sẽ giới thiệu nhiều địa điểm khám uy tín để mọi người cân nhắc đặt lịch.</p><h2>Khám hiếm muộn ở đâu TPHCM</h2><p>Hiện nay có nhiều người vẫn thắc mắc về việc khám hiếm muộn ở đâu tốt nhất TP.HCM. Sau đây là một số bệnh viện Medpro đã tổng hợp để giới thiệu đến quý bạn đọc những điểm đến đáng tin cậy khi có nhu cầu</p><h3>Bệnh viện Đại học Y Dược</h3><p><a href=\"https://medpro.vn/benh-vien-dai-hoc-y-duoc-co-so-1\"><strong>Bệnh viện Đại học Y dược</strong></a> là top bệnh viện hàng đầu tại khu vực miền Nam về lĩnh vực sản khoa cũng như hiếm muộn. Bệnh viện quy tụ nhiều bác sĩ, tiến sĩ, giới trong trong lĩnh vực điều trị hiếm muộn.</p><p>Với sự chỉn chu về hệ thống vật chất, cùng kiến thức chuyên ngành nhiều năm kinh nghiệm, các bác sĩ sẽ hỗ trợ bệnh nhân với các giải pháp mong con tốt nhất hiện nay.</p><p>Địa chỉ khám: <strong>số 215 đường Hồng Bàng, phường 11, quận 5</strong></p><p>Bảng giá tham khảo về dịch vụ liên quan đến hiếm muộn tại bệnh viện:</p><ul><li>Siêu âm Doppler tinh hoàn, mào tinh hoàn cho nam: 400.000đ</li><li>Siêu âm tử cung buồng trứng cho nữ: 270.000đ</li><li>Định lượng Testosterone: 126.000đ</li><li>Định lượng Prolactin: 177.000đ</li></ul>', 'upload/tintuc/1745397322.png', 2, 1, '2025-04-23 08:35:22', '2025-04-23 08:43:25'),
(4, 3, 'Tư vấn tâm lý Online 1 - 1 với bác sĩ giỏi', 'Bạn đang tìm kiếm bác sĩ tâm lý online giỏi? EbookCare giúp bạn kết nối với chuyên gia tâm lý hàng đầu, hỗ trợ tư vấn trực tuyến 1-1 an toàn, bảo mật và hiệu quả.', '<p>Trong cuộc sống hiện đại, áp lực công việc, mối quan hệ và các vấn đề cá nhân có thể khiến tinh thần bị ảnh hưởng nghiêm trọng. Thay vì chờ đợi đến khi mọi thứ trở nên tồi tệ, việc tìm đến bác sĩ tâm lý online để được tư vấn sớm là một giải pháp tối ưu. Không cần đến trực tiếp phòng khám, bạn vẫn có thể kết nối với chuyên gia tâm lý hàng đầu thông qua nền tảng trực tuyến. Cùng <strong>Medpro</strong> tìm hiểu rõ hơn qua bài viết dưới đây nhé!</p><h2>Lợi ích của việc tư vấn với bác sĩ tâm lý online</h2><p>Tư vấn tâm lý online mang lại nhiều lợi ích đáng kể cho người sử dụng:</p><ul><li><strong>Tiện lợi và linh hoạt</strong>: Bạn có thể đặt lịch hẹn và tham gia buổi tư vấn từ bất kỳ đâu, vào thời gian phù hợp với lịch trình cá nhân.</li><li><strong>Bảo mật và riêng tư</strong>: Các buổi tư vấn trực tuyến đảm bảo tính bảo mật cao, giúp bạn thoải mái chia sẻ mà không lo ngại về sự riêng tư.</li><li><strong>Tiết kiệm chi phí và thời gian</strong>: Không cần di chuyển đến phòng khám, bạn tiết kiệm được chi phí đi lại và thời gian chờ đợi.</li><li><strong>Tiếp cận chuyên gia hàng đầu</strong>: Dễ dàng kết nối với các chuyên gia tâm lý uy tín mà không bị giới hạn bởi khoảng cách địa lý.</li></ul><h2>Khi nào nên tìm đến bác sĩ tâm lý online?</h2><p>Nếu bạn hoặc người thân đang gặp phải các dấu hiệu sau, hãy cân nhắc tìm đến bác sĩ tâm lý online để được hỗ trợ kịp thời:</p><ul><li><strong>Cảm giác buồn bã kéo dài:</strong> Mất hứng thú với các hoạt động thường ngày, cảm thấy chán nản, mất động lực.</li><li><strong>Lo âu và căng thẳng quá mức:</strong> Luôn trong trạng thái lo lắng, suy nghĩ tiêu cực, khó kiểm soát cảm xúc.</li><li><strong>Rối loạn giấc ngủ:</strong> Khó ngủ, mất ngủ hoặc ngủ quá nhiều, ảnh hưởng đến sinh hoạt hàng ngày.</li><li><strong>Thay đổi về cân nặng và khẩu vị:</strong> Ăn uống không kiểm soát hoặc chán ăn, dẫn đến thay đổi cân nặng đáng kể.</li><li><strong>Khó tập trung và ra quyết định:</strong> Gặp khó khăn trong công việc, học tập do mất khả năng tập trung, suy giảm trí nhớ.</li><li><strong>Cảm giác cô đơn, mất phương hướng:</strong> Thiếu kết nối với mọi người xung quanh, cảm thấy bế tắc, không tìm được hướng đi cho bản thân.</li></ul><p>Nếu nhận thấy bất kỳ dấu hiệu nào ở trên, đừng ngần ngại tìm kiếm sự hỗ trợ từ các chuyên gia tâm lý để cải thiện sức khỏe tinh thần của bạn.</p>', 'upload/tintuc/1745397483.png', 2, 1, '2025-04-23 08:38:03', '2025-04-23 08:43:09'),
(5, 3, 'Bệnh viêm hô hấp ở trẻ em: dấu hiệu và nguyên nhân', 'Nguyên nhân và dấu hiệu nhận biết viêm hô hấp ở trẻ? Phụ huynh cần làm gì khi trẻ bị viêm hô hấp? Tìm hiểu ngay trong bài viết dưới đây.', '<p>Trẻ em, đặc biệt là trẻ dưới 5 tuổi, rất dễ mắc các bệnh về hô hấp do hệ miễn dịch còn yếu và dễ bị tác động bởi các yếu tố bên ngoài. Theo các nghiên cứu, <strong>80% trẻ dưới 5 tuổi mắc ít nhất 1 lần viêm đường hô hấp mỗi năm, 30% trẻ em nhập viện do biến chứng từ các bệnh viêm đường hô hấp.</strong> Có thể thấy, đây là một nhóm bệnh phổ biến liên quan đến đường hô hấp, bao gồm cả viêm đường hô hấp trên và viêm đường hô hấp dưới:</p><p><strong>Viêm đường hô hấp trên </strong>là những bệnh xảy ra ở vùng mũi, họng, xoang và thanh quản. Các bệnh thường gặp bao gồm cảm lạnh, viêm họng, viêm amidan.</p><p><strong>Viêm đường hô hấp dưới </strong>là những bệnh liên quan đến vùng phổi và phế quản. Một số bệnh phổ biến có thể kể đến như viêm phế quản, viêm phổi, hen suyễn.</p><h2><strong>Nguyên nhân gây bệnh viêm hô hấp ở trẻ em</strong></h2><p>Viêm hô hấp ở trẻ em có thể biểu hiện dưới nhiều hình thức, từ những cơn cảm lạnh thông thường đến những trường hợp viêm phổi nặng. Việc hiểu rõ nguyên nhân gây bệnh là bước đầu tiên quan trọng để có thể phòng ngừa và điều trị hiệu quả. Dưới đây là một số nguyên nhân phổ biến gây ra viêm đường hô hấp ở trẻ em để các bậc phụ huynh có thể lưu ý:</p><ul><li><strong>Virus: </strong>Đây là nguyên nhân phổ biến nhất gây viêm hô hấp ở trẻ em. Một số loại virus thường gặp bao gồm:<ul><li><strong>Rhinovirus:</strong> Gây cảm lạnh thông thường.</li><li><strong>Virus cúm:</strong> Gây bệnh cúm, có thể dẫn đến viêm phổi.</li><li><strong>Virus RSV (Respiratory Syncytial Virus):</strong> Gây viêm phế quản, viêm phổi, đặc biệt nguy hiểm với trẻ sơ sinh và trẻ nhỏ.</li><li><strong>Adenovirus:</strong> Gây viêm kết mạc, viêm phổi, viêm amidan.</li><li><strong>Parainfluenza:</strong> Gây viêm thanh quản.</li></ul></li><li><strong>Vi khuẩn: </strong>Mặc dù ít phổ biến hơn virus, vi khuẩn cũng có thể gây viêm hô hấp ở trẻ em, cụ thể như sau:<ul><li><strong>Streptococcus pneumoniae:</strong> Gây viêm phổi, viêm tai giữa.</li><li><strong>Haemophilus influenzae:</strong> Gây viêm phổi, viêm tai giữa, viêm màng não.</li><li><strong>Bordetella pertussis:</strong> Gây ho gà.</li><li><strong>Mycoplasma pneumoniae:</strong> Gây viêm phổi.</li></ul></li></ul><p>Ngoài virus và vi khuẩn, một số yếu tố khác cũng có thể làm tăng nguy cơ viêm hô hấp ở trẻ em mà phụ huynh cần lưu ý như ô nhiễm không khí, thuốc lá tự động, trẻ bị dị ứng hoặc có hệ miễn dịch yếu.</p><h2><strong>Dấu hiệu cho thấy trẻ bị viêm hô hấp</strong></h2><p>Các bậc phụ huynh cần hiểu rõ về các triệu chứng và biết khi nào cần đưa trẻ đi khám. Một số triệu chứng mà phụ huynh có thể dễ dàng nhận biết về viêm đường hô hấp như:</p><ul><li>Sốt nhẹ hoặc không sốt</li><li>Sổ mũi, nghẹt mũi</li><li>Trẻ ho thường xuyên, không ngớt</li><li>Họng trẻ có thể đỏ, tuy nhiên Amidan không sưng và không có mủ và không bị loét.</li></ul><h2><strong>Ba mẹ nên làm gì khi trẻ bị viêm hô hấp?</strong></h2><p>Là một chuyên gia nhi khoa, tôi hiểu rõ nỗi lo lắng của các bậc cha mẹ khi con cái bị ốm. Những lúc này bố mẹ có thể cần xử lý đúng cách để giúp tình trạng của bé trở nên tốt hơn. Dưới đây là những điều bố mẹ có thể tham khảo để trẻ mau chóng hồi phục:</p><ul><li>Theo dõi các triệu chứng của trẻ thường xuyên bằng cách ghi lại nhiệt độ cơ thể, tần suất ho, khó thở của trẻ. Nếu các triệu chứng trở nên nặng hơn hoặc xuất hiện các dấu hiệu nguy hiểm như khó thở, tím tái, lờ đờ, hãy đưa trẻ đến gặp bác sĩ ngay lập tức.</li><li>Cho trẻ nằm nghỉ ngơi nhiều hơn, ngủ đủ giấc, tránh hoạt động mạnh.</li><li>Tránh tình trạng mất nước ở trẻ bằng cách cho bé uống nhiều nước, nước trái cây.</li><li>Súc miệng cho trẻ bằng nước muối sinh lý để làm sạch dịch nhầy và giảm nghẹt mũi.</li><li>Sử dụng máy tạo độ ẩm nhằm làm dịu đường hô hấp của trẻ.</li><li>Không nên tự ý cho trẻ uống thuốc kháng sinh, trừ khi được bác sĩ chỉ định. Thuốc kháng sinh chỉ có tác dụng với nhiễm trùng do vi khuẩn, không có tác dụng với virus.</li></ul><h2><strong>Khi nào cần đưa trẻ đi khám?</strong></h2><p>Việc nhận biết khi nào cần đưa trẻ đi khám là điều vô cùng quan trọng. Bố mẹ cần can thiệp kịp thời có thể giúp trẻ mau chóng hồi phục và tránh những biến chứng nguy hiểm. Dưới đây là một số dấu hiệu cảnh báo cho thấy bố mẹ nên đưa trẻ đi khám ngay lập tức:</p><ul><li>Trẻ có xu hướng khó thở hoặc thở nhanh hơn bình thường.</li><li>Da trẻ xanh xao hoặc môi bị tái nhợt.</li><li>Trẻ có hiện tượng biếng ăn, mệt mỏi.</li><li>Dùng thuốc hạ sốt vẫn không đỡ sốt.</li><li>Trẻ ho thường xuyên, có đờm màu xanh lá cây, vàng, hoặc có máu.</li></ul><p><strong>Lưu ý: </strong>Những dấu hiệu trên chỉ mang tính chất tham khảo dựa trên kinh nghiệm của tôi. Mỗi trẻ có thể có biểu hiện khác nhau. Nếu phụ huynh nghi ngờ trẻ bị bệnh, hãy liên hệ với bác sĩ ngay lập tức để được tư vấn và điều trị kịp thời. Bạn có thể tham khảo <a href=\"https://medpro.vn/pkbabydino\"><strong>Phòng Khám Nhi và Tâm lý Baby Dino</strong></a> - Phòng khám chuyên điều trị các bệnh lý về sức khỏe tinh thần lẫn thể chất của trẻ.</p><p><strong>Địa chỉ:</strong> Hado Centrosa Garden, Số 10 Đường Số 8, Phường 12, Quận 10, TPHCM.</p><p><strong>Đặt khám tại: </strong><a href=\"https://medpro.vn/chon-lich-kham?feature=booking.package&amp;bookingPage=%2Ftim-kiem%3Fkw%3Dbaby%2Bdino&amp;partnerId=pkbabydino&amp;stepName=service\"><strong>Phòng Khám Nhi và Tâm lý Baby Dino</strong></a></p><blockquote><p>Ngoài ra, bạn cũng có thể <strong>đặt lịch tư vấn khám bệnh qua video </strong>cùng với Bác sĩ Đặng Xuân Khôi tại nền tảng Medpro. Với 5 năm kinh nghiệm trong điều trị các bệnh lý về Nhi và nhiều năm công tác tại Bệnh viện Nhi Đồng 1 và Phòng khám Baby Dino, bác sĩ hoàn toàn có thể giải đáp những thắc mắc của bố mẹ về sức khỏe của trẻ, đặc biệt là trẻ đang gặp các vấn đề về hô hấp.&nbsp;</p></blockquote><p><strong>Tư vấn khám bệnh qua video cùng </strong><a href=\"https://medpro.vn/chon-lich-kham?feature=booking.TELEMEDNOW&amp;partnerId=digimed&amp;doctorId=digimed_KHOIDX212&amp;bookingPage=%2Ftim-kiem%3Fkw%3Db%25C3%25A1c%2Bs%25C4%25A9%2B%25C4%2591%25E1%25BA%25B7ng%2Bxu%25C3%25A2n%2Bkh%25C3%25B4i&amp;stepName=service&amp;subjectId=digimed_NHI\"><strong>Bác sĩ Đặng Xuân Khôi</strong></a><strong>.</strong></p><h2><strong>Biện pháp phòng ngừa viêm hô hấp hiệu quả</strong></h2><p>Việc phòng ngừa viêm hô hấp cho trẻ là một quá trình liên tục, đòi hỏi sự kiên trì và nỗ lực của cả gia đình. Hãy áp dụng những biện pháp trên một cách thường xuyên và nhất quán để bảo vệ sức khỏe cho con yêu. Sau đây là một số biện pháp phòng ngừa hiệu quả cho trẻ mà tôi muốn chia sẻ cho các bậc phụ huynh dựa trên kinh nghiệm chuyên môn của mình:</p><ul><li><strong>Giữ vệ sinh sạch sẽ cho trẻ:</strong> Bố mẹ cần rửa tay thường xuyên cho trẻ bằng xà phòng hoặc dung dịch sát khuẩn; Đây là biện pháp đơn giản nhưng hiệu quả nhất. Hãy dạy trẻ rửa tay bằng xà phòng và nước sạch trong ít nhất 20 giây, đặc biệt là trước khi ăn, sau khi đi vệ sinh, sau khi chơi đùa ngoài trời và sau khi tiếp xúc với người ốm. vệ sinh mũi, họng cho bé bằng nước muối sinh lý để làm sạch đường hô hấp.</li><li><strong>Giữ môi trường sống của trẻ luôn sạch sẽ:</strong> Ngoài ra, môi trường xung quanh bé cũng cần được đảm bảo luôn sạch sẽ, thoáng mát, tránh khói bụi và ô nhiễm. Bố mẹ hãy lau chùi thường xuyên các bề mặt thường xuyên tiếp xúc như tay nắm cửa, bàn ghế, đồ chơi bằng dung dịch sát khuẩn, đồng thời mở cửa sổ thường xuyên để không khí lưu thông, tránh ẩm thấp, tạo môi trường khó cho vi khuẩn và virus sinh sôi. Các đồ dùng thường ngày như khăn mặt, quần áo, chăn ga gối của trẻ cần được rửa sạch thường xuyên bằng nước nóng.</li><li><strong>Bổ sung đầy đủ các chất dinh dưỡng:</strong> Bố mẹ cho bé uống nhiều nước, sữa và các loại nước ép trái cây giàu vitamin C để tăng sức đề kháng; đảm bảo bé ăn đủ các nhóm chất: đạm, tinh bột, chất béo, vitamin và khoáng chất.</li><li><strong>Theo dõi thân nhiệt và tình trạng hô hấp:</strong> Đo thân nhiệt của bé đều đặn. Nếu bé sốt trên 38,5°C, cần hạ sốt bằng cách lau mát và cho bé uống thuốc hạ sốt theo chỉ dẫn của bác sĩ. Quan sát biểu hiện hô hấp, nếu bé khó thở, tím tái, cần đưa bé đến bệnh viện ngay.</li><li><strong>Tiêm chủng đầy đủ: </strong>Tiêm chủng là biện pháp phòng ngừa hiệu quả nhất cho nhiều loại bệnh hô hấp, bao gồm cúm, viêm phổi, ho gà. Hãy tuân thủ lịch tiêm chủng theo khuyến cáo của bác sĩ.</li></ul><p>Viêm đường hô hấp trên do virus thường khiến bố mẹ lo lắng, nhưng hãy yên tâm, với sự chăm sóc tận tình của bố mẹ và sự trợ giúp của bác sĩ, bé yêu sẽ nhanh chóng khỏe mạnh trở lại. Hãy tin tưởng vào sức đề kháng của bé và dành cho bé thật nhiều tình yêu thương. Chúc bé mau chóng vui cười, nô đùa như bình thường!</p>', 'upload/tintuc/1745397689.png', 3, 1, '2025-04-23 08:41:29', '2025-04-23 08:42:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', 'admin', 1, NULL, '$2y$12$Mu69JhfR5Z01QJMBRZ2D5eYA0rHQAKhGtOp0clOiUS1aAcFu/MR.W', NULL, '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(2, 'QuanLy', 'quanly@example.com', 'manage', 1, NULL, '$2y$12$TzUthNH4gteEFEfD.Kl2qu7KedIGIy7E5OSiSu/htuknkQo5nWiC6', NULL, '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(3, 'NguoiDangTin', 'dangtin@example.com', 'news', 1, NULL, '$2y$12$V2rw6VftFty/cI4uGNziTevq15pG96MLC4m7QAABheb07u1vOFsVC', NULL, '2025-04-23 05:37:29', '2025-04-23 05:37:29'),
(4, 'KhachHang', 'tranvanb@example.com', 'user', 1, NULL, '$2y$12$2ZumZbJYCwkWN/9xB2FdXeZvcuud9UcvmiKCHmr/XSLEYqojEmWMG', NULL, '2025-04-23 05:37:30', '2025-05-06 02:38:47'),
(5, 'NHANVIENBENHVIEN01', 'nvbv@example.com', 'hospital', 1, NULL, '$2y$12$Qb.HbY3d8K6LAy16k.n/X.zLE9gr/QmxWWNePZRMj7E8r/cK603Be', NULL, '2025-04-23 09:09:46', '2025-04-23 09:09:46'),
(6, 'DatVo03', 'dattd08032003@gmail.com', 'user', 1, NULL, '$2y$12$wNqLSxKT42ZFybTGNmbwcemWCyqtHojiIwf1FF1PW05Y5u0M9eqdW', NULL, '2025-04-30 12:25:28', '2025-04-30 12:25:28'),
(7, 'DatVo04', 'vtd1@gmail.com', 'user', 1, NULL, '$2y$12$K0MWWVylHQtmejmz77QvyeAkjRZuNQhOQ1zzo8kIxwcIaYHFZGgfy', NULL, '2025-04-30 14:54:42', '2025-04-30 14:54:42'),
(9, 'NVQuanLy', 'nguyenthicamnhung070524@gmail.com', 'manage', 1, NULL, '$2y$12$TVtzfrgneIBwD.RGEUMfqOtktO2Ue31bVEwXqHj2.T7BophSXeOHe', NULL, '2025-05-06 02:10:30', '2025-05-06 02:10:30');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bacsi`
--
ALTER TABLE `bacsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bacsi_id_coso_foreign` (`id_coso`),
  ADD KEY `bacsi_id_chuyenkhoa_foreign` (`id_chuyenkhoa`);

--
-- Chỉ mục cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benhnhan_cccd_unique` (`cccd`),
  ADD KEY `benhnhan_id_user_foreign` (`id_user`);

--
-- Chỉ mục cho bảng `chuyenkhoa`
--
ALTER TABLE `chuyenkhoa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chuyenkhoa_id_coso_foreign` (`id_coso`);

--
-- Chỉ mục cho bảng `coso`
--
ALTER TABLE `coso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coso_email_unique` (`email`);

--
-- Chỉ mục cho bảng `khunggio`
--
ALTER TABLE `khunggio`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lichhen`
--
ALTER TABLE `lichhen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lichhen_id_benhnhan_foreign` (`id_benhnhan`),
  ADD KEY `lichhen_id_bacsi_foreign` (`id_bacsi`),
  ADD KEY `lichhen_id_lichkhamkhunggio_foreign` (`id_lichkhamkhunggio`);

--
-- Chỉ mục cho bảng `lichkham`
--
ALTER TABLE `lichkham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lichkham_id_bacsi_foreign` (`id_bacsi`);

--
-- Chỉ mục cho bảng `lichkham_khunggio`
--
ALTER TABLE `lichkham_khunggio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lichkham_khunggio_id_lichkham_foreign` (`id_lichkham`),
  ADD KEY `lichkham_khunggio_id_khunggio_foreign` (`id_khunggio`);

--
-- Chỉ mục cho bảng `lichsu`
--
ALTER TABLE `lichsu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nhanvien_id_user_unique` (`id_user`),
  ADD KEY `nhanvien_id_coso_foreign` (`id_coso`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tintuc_id_nhanvien_foreign` (`id_nhanvien`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bacsi`
--
ALTER TABLE `bacsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `chuyenkhoa`
--
ALTER TABLE `chuyenkhoa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `coso`
--
ALTER TABLE `coso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khunggio`
--
ALTER TABLE `khunggio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `lichhen`
--
ALTER TABLE `lichhen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `lichkham`
--
ALTER TABLE `lichkham`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT cho bảng `lichkham_khunggio`
--
ALTER TABLE `lichkham_khunggio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=734;

--
-- AUTO_INCREMENT cho bảng `lichsu`
--
ALTER TABLE `lichsu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bacsi`
--
ALTER TABLE `bacsi`
  ADD CONSTRAINT `bacsi_id_chuyenkhoa_foreign` FOREIGN KEY (`id_chuyenkhoa`) REFERENCES `chuyenkhoa` (`id`),
  ADD CONSTRAINT `bacsi_id_coso_foreign` FOREIGN KEY (`id_coso`) REFERENCES `coso` (`id`);

--
-- Các ràng buộc cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  ADD CONSTRAINT `benhnhan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `chuyenkhoa`
--
ALTER TABLE `chuyenkhoa`
  ADD CONSTRAINT `chuyenkhoa_id_coso_foreign` FOREIGN KEY (`id_coso`) REFERENCES `coso` (`id`);

--
-- Các ràng buộc cho bảng `lichhen`
--
ALTER TABLE `lichhen`
  ADD CONSTRAINT `lichhen_id_bacsi_foreign` FOREIGN KEY (`id_bacsi`) REFERENCES `bacsi` (`id`),
  ADD CONSTRAINT `lichhen_id_benhnhan_foreign` FOREIGN KEY (`id_benhnhan`) REFERENCES `benhnhan` (`id`),
  ADD CONSTRAINT `lichhen_id_lichkhamkhunggio_foreign` FOREIGN KEY (`id_lichkhamkhunggio`) REFERENCES `lichkham_khunggio` (`id`);

--
-- Các ràng buộc cho bảng `lichkham`
--
ALTER TABLE `lichkham`
  ADD CONSTRAINT `lichkham_id_bacsi_foreign` FOREIGN KEY (`id_bacsi`) REFERENCES `bacsi` (`id`);

--
-- Các ràng buộc cho bảng `lichkham_khunggio`
--
ALTER TABLE `lichkham_khunggio`
  ADD CONSTRAINT `lichkham_khunggio_id_khunggio_foreign` FOREIGN KEY (`id_khunggio`) REFERENCES `khunggio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lichkham_khunggio_id_lichkham_foreign` FOREIGN KEY (`id_lichkham`) REFERENCES `lichkham` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_id_coso_foreign` FOREIGN KEY (`id_coso`) REFERENCES `coso` (`id`),
  ADD CONSTRAINT `nhanvien_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD CONSTRAINT `tintuc_id_nhanvien_foreign` FOREIGN KEY (`id_nhanvien`) REFERENCES `nhanvien` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
