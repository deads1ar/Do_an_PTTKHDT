-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2025 at 04:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlch`
--

-- --------------------------------------------------------

--
-- Table structure for table `ao`
--

CREATE TABLE `ao` (
  `IDAO` bigint(20) NOT NULL,
  `IDLOAI` bigint(20) DEFAULT NULL,
  `TEN` varchar(255) DEFAULT NULL,
  `IDSIZE` enum('S','M','L','XL') NOT NULL,
  `GIA` double NOT NULL,
  `TRANGTHAI` tinyint(4) NOT NULL,
  `MOTA` varchar(255) NOT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ao`
--

INSERT INTO `ao` (`IDAO`, `IDLOAI`, `TEN`, `IDSIZE`, `GIA`, `TRANGTHAI`, `MOTA`, `URL`) VALUES
(1, 1, 'Áo thun Polo', 'S', 120000, 1, 'Áo thun cotton thoáng mát', 'img/sanpham/aothun1.jpg'),
(2, 1, 'Áo thun Polo', 'M', 120000, 1, 'Áo thun cotton thoáng mát', 'img/sanpham/aothun1.jpg'),
(3, 1, 'Áo thun Polo', 'L', 120000, 1, 'Áo thun cotton thoáng mát', 'img/sanpham/aothun1.jpg'),
(4, 1, 'Áo thun Polo', 'XL', 120000, 0, 'Áo thun cotton thoáng mát', 'img/sanpham/aothun1.jpg'),
(5, 2, 'Áo sơ mi trắng', 'S', 180000, 1, 'Áo sơ mi công sở tay dài', 'img/sanpham/aosomi1.jpg'),
(6, 2, 'Áo sơ mi trắng', 'M', 180000, 0, 'Áo sơ mi công sở tay dài', 'img/sanpham/aosomi1.jpg'),
(7, 2, 'Áo sơ mi trắng', 'L', 180000, 1, 'Áo sơ mi công sở tay dài', 'img/sanpham/aosomi1.jpg'),
(8, 2, 'Áo sơ mi trắng', 'XL', 180000, 0, 'Áo sơ mi công sở tay dài', 'img/sanpham/aosomi1.jpg'),
(9, 3, 'Áo khoác bomber', 'S', 350000, 1, 'Áo khoác chất liệu gió nhẹ', 'img/sanpham/aokhoac1.jpg'),
(10, 3, 'Áo khoác bomber', 'M', 350000, 0, 'Áo khoác chất liệu gió nhẹ', 'img/sanpham/aokhoac1.jpg'),
(11, 3, 'Áo khoác bomber', 'L', 350000, 1, 'Áo khoác chất liệu gió nhẹ', 'img/sanpham/aokhoac1.jpg'),
(12, 3, 'Áo khoác bomber', 'XL', 350000, 0, 'Áo khoác chất liệu gió nhẹ', 'img/sanpham/aokhoac1.jpg'),
(13, 3, 'Áo hoodie đen', 'S', 250000, 1, 'Áo hoodie unisex form rộng', 'img/sanpham/aohoodie1.jpg'),
(14, 3, 'Áo hoodie đen', 'M', 250000, 0, 'Áo hoodie unisex form rộng', 'img/sanpham/aohoodie1.jpg'),
(15, 3, 'Áo hoodie đen', 'L', 250000, 1, 'Áo hoodie unisex form rộng', 'img/sanpham/aohoodie1.jpg'),
(16, 3, 'Áo hoodie đen', 'XL', 250000, 0, 'Áo hoodie unisex form rộng', 'img/sanpham/aohoodie1.jpg'),
(17, 3, 'Áo len cổ tròn', 'S', 300000, 1, 'Áo len ấm mùa đông', 'img/sanpham/aolen1.jpg'),
(18, 3, 'Áo len cổ tròn', 'M', 300000, 0, 'Áo len ấm mùa đông', 'img/sanpham/aolen1.jpg'),
(19, 3, 'Áo len cổ tròn', 'L', 300000, 1, 'Áo len ấm mùa đông', 'img/sanpham/aolen1.jpg'),
(20, 3, 'Áo len cổ tròn', 'XL', 300000, 0, 'Áo len ấm mùa đông', 'img/sanpham/aolen1.jpg'),
(21, 1, 'Áo phông basic', 'S', 100000, 1, 'Áo phông trơn 100% cotton', 'img/sanpham/aophong1.jpg'),
(22, 1, 'Áo phông basic', 'M', 100000, 0, 'Áo phông trơn 100% cotton', 'img/sanpham/aophong1.jpg'),
(23, 1, 'Áo phông basic', 'L', 100000, 1, 'Áo phông trơn 100% cotton', 'img/sanpham/aophong1.jpg'),
(24, 1, 'Áo phông basic', 'XL', 100000, 0, 'Áo phông trơn 100% cotton', 'img/sanpham/aophong1.jpg'),
(25, 2, 'Áo sơ mi caro', 'S', 190000, 1, 'Áo sơ mi caro trẻ trung', 'img/sanpham/aosomicaro1.jpg'),
(26, 2, 'Áo sơ mi caro', 'M', 190000, 0, 'Áo sơ mi caro trẻ trung', 'img/sanpham/aosomicaro1.jpg'),
(27, 2, 'Áo sơ mi caro', 'L', 190000, 1, 'Áo sơ mi caro trẻ trung', 'img/sanpham/aosomicaro1.jpg'),
(28, 2, 'Áo sơ mi caro', 'XL', 190000, 0, 'Áo sơ mi caro trẻ trung', 'img/sanpham/aosomicaro1.jpg'),
(29, 3, 'Áo khoác jean', 'S', 400000, 1, 'Áo khoác jean xanh đậm', 'img/sanpham/aokhoacjean1.jpg'),
(30, 3, 'Áo khoác jean', 'M', 400000, 0, 'Áo khoác jean xanh đậm', 'img/sanpham/aokhoacjean1.jpg'),
(31, 3, 'Áo khoác jean', 'L', 400000, 1, 'Áo khoác jean xanh đậm', 'img/sanpham/aokhoacjean1.jpg'),
(32, 3, 'Áo khoác jean', 'XL', 400000, 0, 'Áo khoác jean xanh đậm', 'img/sanpham/aokhoacjean1.jpg'),
(33, 1, 'Áo thun cổ trụ', 'S', 150000, 1, 'Áo cổ trụ phù hợp đi làm', 'img/sanpham/aocotru1.jpg'),
(34, 1, 'Áo thun cổ trụ', 'M', 150000, 0, 'Áo cổ trụ phù hợp đi làm', 'img/sanpham/aocotru1.jpg'),
(35, 1, 'Áo thun cổ trụ', 'L', 150000, 1, 'Áo cổ trụ phù hợp đi làm', 'img/sanpham/aocotru1.jpg'),
(36, 1, 'Áo thun cổ trụ', 'XL', 150000, 0, 'Áo cổ trụ phù hợp đi làm', 'img/sanpham/aocotru1.jpg'),
(37, 1, 'Áo thể thao', 'S', 200000, 1, 'Áo thể thao thấm hút mồ hôi', 'img/sanpham/aothethao1.jpg'),
(38, 1, 'Áo thể thao', 'M', 200000, 0, 'Áo thể thao thấm hút mồ hôi', 'img/sanpham/aothethao1.jpg'),
(39, 1, 'Áo thể thao', 'L', 200000, 1, 'Áo thể thao thấm hút mồ hôi', 'img/sanpham/aothethao1.jpg'),
(40, 1, 'Áo thể thao', 'XL', 200000, 0, 'Áo thể thao thấm hút mồ hôi', 'img/sanpham/aothethao1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ctdh`
--

CREATE TABLE `ctdh` (
  `IDDH` bigint(20) NOT NULL,
  `IDAO` bigint(20) NOT NULL,
  `SL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `IDDH` bigint(20) NOT NULL,
  `IDKH` bigint(20) NOT NULL,
  `IDNV` bigint(20) NOT NULL,
  `TONG` double NOT NULL,
  `TRANGTHAI` enum('CHUA XAC NHAN','DA XAC NHAN','DANG GIAO','THANH CONG') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`IDDH`, `IDKH`, `IDNV`, `TONG`, `TRANGTHAI`) VALUES
(1, 1, 1, 240000, 'CHUA XAC NHAN'),
(2, 2, 2, 300000, 'DA XAC NHAN'),
(3, 3, 3, 500000, 'DANG GIAO'),
(4, 4, 4, 200000, 'THANH CONG'),
(5, 5, 5, 120000, 'DA XAC NHAN'),
(6, 6, 6, 350000, 'DANG GIAO'),
(7, 7, 7, 400000, 'THANH CONG'),
(8, 8, 8, 150000, 'CHUA XAC NHAN'),
(9, 9, 9, 250000, 'DA XAC NHAN'),
(10, 10, 10, 180000, 'CHUA XAC NHAN');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `IDKH` bigint(20) NOT NULL,
  `TEN` varchar(255) DEFAULT NULL,
  `SDT` varchar(15) NOT NULL,
  `DIACHI` varchar(255) NOT NULL,
  `PWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`IDKH`, `TEN`, `SDT`, `DIACHI`, `PWORD`) VALUES
(1, 'Nguyễn Văn A', '0901234567', 'Hà Nội', '12345'),
(2, 'Trần Thị B', '0912345678', 'Hồ Chí Minh', 'abcd'),
(3, 'Lê Văn C', '0987654321', 'Đà Nẵng', 'pass1'),
(4, 'Phạm Thị D', '0978123456', 'Hải Phòng', 'pass2'),
(5, 'Đỗ Văn E', '0909988776', 'Cần Thơ', '123abc'),
(6, 'Ngô Thị F', '0934455667', 'Huế', 'pwf'),
(7, 'Bùi Văn G', '0955566778', 'Nha Trang', 'pw123'),
(8, 'Vũ Thị H', '0922334455', 'Bắc Ninh', '4567'),
(9, 'Lý Văn I', '0945566778', 'Nam Định', 'xyz'),
(10, 'Phan Thị K', '0967788990', 'Thanh Hóa', '0000'),
(11, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `loaiao`
--

CREATE TABLE `loaiao` (
  `IDLOAI` bigint(20) NOT NULL,
  `TENLOAI` varchar(255) NOT NULL,
  `MOTA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaiao`
--

INSERT INTO `loaiao` (`IDLOAI`, `TENLOAI`, `MOTA`) VALUES
(1, 'Áo thun', 'Các mẫu áo thun thoáng mát, năng động'),
(2, 'Áo sơ mi', 'Áo sơ mi công sở, thời trang nam nữ'),
(3, 'Áo khoác', 'Áo khoác bomber, jean, gió, v.v.');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `IDNV` bigint(20) NOT NULL,
  `TENNV` varchar(255) NOT NULL,
  `SDT` varchar(15) NOT NULL,
  `PWORD` varchar(255) NOT NULL,
  `DIACHI` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`IDNV`, `TENNV`, `SDT`, `PWORD`, `DIACHI`) VALUES
(1, 'Nguyễn Minh', '0909000001', 'nv1', 'Hà Nội'),
(2, 'Trần Hải', '0909000002', 'nv2', 'Đà Nẵng'),
(3, 'Lê Hòa', '0909000003', 'nv3', 'Huế'),
(4, 'Phạm Sơn', '0909000004', 'nv4', 'Hồ Chí Minh'),
(5, 'Đỗ Trang', '0909000005', 'nv5', 'Bắc Giang'),
(6, 'Ngô Tùng', '0909000006', 'nv6', 'Nha Trang'),
(7, 'Bùi Giang', '0909000007', 'nv7', 'Hải Phòng'),
(8, 'Vũ Mai', '0909000008', 'nv8', 'Hà Nội'),
(9, 'Lý Khang', '0909000009', 'nv9', 'Huế'),
(10, 'Phan Anh', '0909000010', 'nv10', 'Cần Thơ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ao`
--
ALTER TABLE `ao`
  ADD PRIMARY KEY (`IDAO`);

--
-- Indexes for table `ctdh`
--
ALTER TABLE `ctdh`
  ADD PRIMARY KEY (`IDDH`,`IDAO`),
  ADD KEY `IDAO` (`IDAO`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`IDDH`),
  ADD KEY `IDNV` (`IDNV`),
  ADD KEY `IDKH` (`IDKH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`IDKH`);

--
-- Indexes for table `loaiao`
--
ALTER TABLE `loaiao`
  ADD PRIMARY KEY (`IDLOAI`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`IDNV`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `IDDH` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `IDKH` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loaiao`
--
ALTER TABLE `loaiao`
  MODIFY `IDLOAI` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `IDNV` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ctdh`
--
ALTER TABLE `ctdh`
  ADD CONSTRAINT `ctdh_ibfk_1` FOREIGN KEY (`IDDH`) REFERENCES `donhang` (`IDDH`),
  ADD CONSTRAINT `ctdh_ibfk_2` FOREIGN KEY (`IDAO`) REFERENCES `ao` (`IDAO`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`IDNV`) REFERENCES `nhanvien` (`IDNV`),
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`IDKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
