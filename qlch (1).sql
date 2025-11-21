-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 21, 2025 at 02:23 AM
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
  `GIA` double NOT NULL,
  `MOTA` varchar(255) NOT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `TRANGTHAI` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ao`
--

INSERT INTO `ao` (`IDAO`, `IDLOAI`, `TEN`, `GIA`, `MOTA`, `URL`, `TRANGTHAI`) VALUES
(1, 1, 'Áo thun Polo', 120000, 'ngon bổ rẻ\r\n', 'img/shop/aothun1.png', 1),
(2, 2, 'Áo sơ mi trắng', 180000, 'Áo sơ mi công sở tay dài', 'img/sanpham/ao_so_mi/ao_so_mi_1/aosomi1.jpg', 1),
(3, 3, 'Áo khoác bomber', 350000, 'Áo khoác chất liệu gió nhẹ', 'img/sanpham/ao_khoac/ao_khoac_1/aokhoac1.jpg', 1),
(4, 3, 'Áo hoodie đen', 250000, 'Áo hoodie unisex form rộng', 'img/sanpham/aohoodie1.jpg', 1),
(5, 1, 'Áo len cổ tròn', 300000, 'Áo len ấm mùa đông', 'img/sanpham/aolen1.jpg', 1),
(6, 1, 'Áo phông basic', 100000, 'Áo phông trơn 100% cotton', 'img/sanpham/aophong1.jpg', 1),
(7, 2, 'Áo sơ mi caro', 190000, 'Áo sơ mi caro trẻ trung', 'img/sanpham/aosomicaro1.jpg', 1),
(8, 3, 'Áo khoác jean', 400000, 'Áo khoác jean xanh đậm', 'img/sanpham/aokhoacjean1.jpg', 1),
(9, 1, 'Áo thun cổ trụ', 150000, 'Áo cổ trụ phù hợp đi làm', 'img/sanpham/aocotru1.jpg', 1),
(10, 1, 'Áo thể thao', 200000, 'Áo thể thao thấm hút mồ hôi', 'img/sanpham/aothethao1.jpg', 1),
(21, 1, 'linh', 2000000, 'tuyệt vời', 'img/shop/15-anh-meme-meo-gio-tay-inkythuatso-17-15-31-23.webp', 0),
(27, 3, 'Áo Khoác Nam Lông Vũ Nhẹ Gấp Gọn Có Mũ', 500000, 'Chất liệu: Vải ngoài: nylon 100%; Lót bông: 90% lông vũ, 10% lông nhỏ; Lót trong: polyester 100%; Bo viền: nylon 70%, elastane (Anh)/spandex (Mỹ) 30%; Dải băng: polyester 100%; Túi đựng: nylon 100%.\r\n\r\nDùng lông vũ 750 fill power; gấp gọn vào túi trong để', 'img/sanpham/ao_khoac/ao_khoac_1/aokhoac1.jpg', 1),
(28, 3, 'Áo Khoác Nam Vải Boa Fleece', 2, 'Chất liệu: Thân — mặt ngoài: polyester 100%, mặt trong: polyester 100% (lớp trong dùng nhựa polyurethane); Vải phụ: nylon 100%; Bo viền: nylon 72%, elastane (Anh)/spandex (Mỹ) 28%; Lót túi: polyester 100%.\r\n\r\nFleece nhẹ ấm được dán lót tăng giữ nhiệt. Vải', 'img/shop/aokhoac2.jpg', 1),
(29, 3, 'Áo Len Chui Đầu Vải Fleece Tái Chế', 3, 'Chất liệu: Thân: polyester 100%; Bo viền: polyester 100%; Túi lót (mảnh sau): polyester 100%; Túi lót (mảnh trước): polyester 100%; Viền trang trí: polyester 100%.\r\n\r\nChai tiện dụng để chiết/đựng dầu gội hoặc dầu xả.\r\n\r\nLưu ý: Thân sản phẩm dùng 100% poly', 'img/shop/aokhoac3.jpg', 1),
(30, 1, 'Áo Cardigan Vải Fleece Tái Chế', 4, 'Chất liệu: Thân: polyester 100%; Viền trang trí: polyester 100%; Bo viền: polyester 100%.\r\n\r\nChai tiện dụng để chiết/đựng dầu gội hoặc dầu xả.\r\n\r\nLưu ý: Thân sản phẩm dùng 100% polyester tái chế. Màu đậm có thể lem khi ma sát hoặc lúc ướt—giặt riêng. Ma s', 'img/shop/aokhoac4.jpg', 1),
(31, 1, 'Áo Khoác Nam Lông Vũ Nhẹ Gấp Gọn Cổ Trụ', 5, 'Chất liệu: Vải ngoài: nylon 100%; Lót: nylon 100%; Lớp nhồi: 90% lông vũ, 10% lông — Có bộ phận có nguồn gốc động vật (UK) / Down (ít nhất 90% down) (US) / 90% down, 10% lông thủy cầm (CA) / Tối thiểu 90% down, 10% lông nhỏ (AU).\r\n\r\nDùng lông vũ độ nở 750', 'img/shop/aokhoac5.jpg', 1),
(32, 2, 'Áo Sơ Mi Nam Vải Flannel Tay Dài', 1, 'Chất liệu: 100% cotton\r\n\r\nChải lông để mang lại độ ấm và chạm mềm; cotton được nuôi trồng trong điều kiện tự nhiên tại châu Phi.\r\n\r\nLưu ý: Màu đậm có thể lem do ma sát hoặc khi ướt—giặt riêng; tránh xa nguồn lửa vì lông bề mặt có thể bắt lửa; do chất liệu', 'img/shop/aosomi1.jpg', 1),
(33, 2, 'Áo Sơ Mi Nam Vải Kapok Double Gauze Tay Ngắn', 2, 'Chất liệu: Cotton 90%, Kapok 10%\r\nChất liệu vải xô mềm mại làm từ sợi kapok tự nhiên, nhẹ. Bông là bông hữu cơ.\r\nLưu ý: Sản phẩm màu đậm có thể bị lem màu do ma sát khi sử dụng hoặc khi tiếp xúc khi bị ướt. Giặt riêng với các sản phẩm khác. Do đặc tính ch', 'img/shop/aosomi2.jpg', 1),
(34, 1, 'Áo Sơ Mi Nam Ít Nhăn Cổ Rộng Tay Dài', 3, 'Chất liệu: 100% cotton\r\n\r\nXử lý để vải 100% cotton có thể mặc không cần ủi; cotton là hữu cơ.\r\n\r\nLưu ý: Màu đậm có thể lem—giặt riêng; tùy điều kiện giặt, có thể cần ủi nhẹ để bề mặt phẳng đẹp.', 'img/shop/aosomi3.jpg', 1),
(35, 2, 'Áo Sơ Mi Nam Cổ Trụ Tay Dài Vải Linen Washed', 4, 'Chất liệu: 100% linen\r\n\r\nNét đặc trưng của sản phẩm là chất liệu linen Pháp được giặt trước tạo nên bề mặt tự nhiên. Càng mặc càng trở nên mềm mại, thoải mái và mát mẻ.\r\n\r\nLưu ý: Sản phẩm màu đậm có thể bị lem màu do ma sát trong quá trình sử dụng hoặc kh', 'img/shop/aosomi4.jpg', 1),
(36, 2, 'Áo Sơ Mi Nam Vải Broadcloth Dáng Rộng Tay Ngắn', 5, 'Chất liệu: 100% cotton\r\n\r\nĐược giặt trước để tạo nên bề mặt mềm mại. Bông được nuôi trồng trong môi trường tự nhiên ở Châu Phi.\r\n\r\nLưu ý: Sản phẩm màu đậm có thể bị loang màu do ma sát hoặc tiếp xúc khi ướt. Vui lòng giặt riêng với các sản phẩm khác.', 'img/shop/aosomi5.jpg', 1),
(37, 1, 'Áo Thun Nam Vải Brushed Jersey Cổ Tròn Tay Dài', 1, 'Chất liệu: Thân: cotton 100%; Vải gân (rib): cotton 78%, elastomultiester (Anh)/elasterell-P (Mỹ) 22%.\r\n\r\nChải lông để mang lại sự ấm áp và bề mặt mịn; cotton được nuôi trồng trong điều kiện tự nhiên tại châu Phi.\r\n\r\nLưu ý: Màu đậm có thể lem do ma sát ho', 'img/shop/1.jpg', 1),
(38, 1, 'Áo Thun Nam Waffle Chống Uv Nhanh Khô Cổ Tròn Tay Dài', 2, 'Chất liệu: Thân áo: 100% polyester. Bo viền: 100% polyester\r\n\r\nMay từ vải waffle độ dày vừa, mặc dễ chịu với bề mặt mềm bồng bềnh.\r\n\r\nLưu ý: Sử dụng 38% polyester tái chế; màu đậm có thể lem—giặt riêng; UPF 50+ và tỷ lệ che chắn UV ≥90%; UPF là mức bảo vệ', 'img/shop/4547315475681_05_org.jpg', 1),
(39, 1, 'Áo Thun Nam Vải Washed Sợi Dày Tay Ngắn', 3, 'Được dệt từ sợi cotton dày để tạo ra chất liệu bền chắc Cotton sử dụng là cotton hữu cơ\r\n\r\nChất liệu: Thân áo: 100% cotton. Phần bo: 90% cotton, 10% elastomultiester (UK) / elasterell-p (US)\r\n\r\nLưu ý: Sản phẩm màu đậm có thể bị loang màu do ma sát hoặc kh', 'img/shop/3.jpg', 1),
(40, 1, 'Áo Thun Nam Vải Cool Touch Dáng Rộng Tay Ngắn', 4, 'Được dệt tinh tế từ chất liệu mang lại cảm giác mát lạnh khi mặc Sử dụng cotton hữu cơ\r\n\r\nChất liệu: Thân áo: 53% cotton, 47% polyester. Phần bo: 72% cotton, 28% elastomultiester (UK) / elasterell-p (US)\r\n\r\nLưu ý: Sản phẩm này sử dụng 47% polyester tái ch', 'img/shop/4.jpg', 1),
(41, 1, 'Áo Thun Nam Vải Jersey Kẻ Sọc Cổ Tròn Tay Ngắn', 5000, 'Được may từ chất liệu có độ dày vừa phải, mang lại cảm giác mịn màng, dễ chịu trên da. Cotton được nuôi trồng tự nhiên tại châu Phi.\r\n\r\nChất liệu: Thân áo: 60% cotton, 40% polyester. Phần bo: 57% cotton, 38% polyester, 5% elastane (UK) / spandex (US)\r\n\r\nL', 'img/shop/5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ao_size`
--

CREATE TABLE `ao_size` (
  `IDSIZE` int(10) NOT NULL,
  `IDAO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ao_size`
--

INSERT INTO `ao_size` (`IDSIZE`, `IDAO`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 21),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(2, 1),
(2, 21),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(3, 1),
(3, 21),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(4, 21),
(4, 27),
(4, 28),
(4, 29),
(4, 30),
(4, 31),
(4, 32),
(4, 33),
(4, 34),
(4, 35),
(4, 36),
(4, 37),
(4, 39),
(4, 40);

-- --------------------------------------------------------

--
-- Table structure for table `ctdh`
--

CREATE TABLE `ctdh` (
  `IDDH` bigint(20) NOT NULL,
  `IDAO` bigint(20) NOT NULL,
  `IDSIZE` int(11) NOT NULL,
  `SL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctdh`
--

INSERT INTO `ctdh` (`IDDH`, `IDAO`, `IDSIZE`, `SL`) VALUES
(1, 1, 1, 2),
(1, 2, 1, 1),
(2, 3, 1, 1),
(2, 4, 1, 2),
(3, 5, 1, 1),
(3, 6, 1, 3),
(4, 7, 1, 1),
(4, 8, 1, 1),
(5, 9, 1, 2),
(6, 1, 1, 1),
(6, 10, 1, 1),
(7, 2, 1, 3),
(8, 3, 1, 1),
(8, 4, 1, 1),
(9, 5, 1, 2),
(9, 6, 1, 1),
(10, 7, 1, 1),
(10, 8, 1, 2),
(11, 1, 2, 1),
(11, 1, 3, 2),
(11, 9, 1, 2),
(12, 1, 2, 1),
(12, 1, 3, 2),
(12, 9, 1, 2),
(13, 1, 2, 1),
(13, 1, 3, 2),
(13, 9, 1, 2),
(14, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `IDDH` bigint(20) NOT NULL,
  `IDKH` bigint(20) NOT NULL,
  `IDNV` bigint(20) DEFAULT NULL,
  `TONG` double NOT NULL,
  `TRANGTHAI` varchar(50) NOT NULL DEFAULT 'CHUA XAC NHAN',
  `TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `DIACHI` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`IDDH`, `IDKH`, `IDNV`, `TONG`, `TRANGTHAI`, `TIME`, `DIACHI`) VALUES
(1, 1, 1, 240000, 'CHUA XAC NHAN', '2025-11-11 16:32:45', 'HCM'),
(2, 2, 2, 300000, 'DA XAC NHAN', '2025-11-11 16:32:45', 'Q12'),
(3, 3, 3, 500000, 'DANG GIAO', '2025-11-11 16:32:45', 'BINH TAN'),
(4, 4, 4, 200000, 'THANH CONG', '2025-11-11 16:32:45', 'BINH THANH'),
(5, 5, 5, 120000, 'DA XAC NHAN', '2025-11-11 16:32:45', 'BINH DUONG'),
(6, 6, 6, 350000, 'DANG GIAO', '2025-11-11 16:32:45', 'CHAU DOC'),
(7, 7, 7, 400000, 'THANH CONG', '2025-11-11 16:32:45', 'LAM STARK'),
(8, 8, 8, 150000, 'CHUA XAC NHAN', '2025-11-11 16:32:45', '123 An Khánh, Phường Phú Nhuận, TPHCM'),
(9, 9, 9, 250000, 'DA XAC NHAN', '2025-11-11 16:32:45', NULL),
(10, 10, 10, 180000, 'CHUA XAC NHAN', '2025-11-11 16:32:45', NULL),
(11, 1, NULL, 660000, 'CHUA XAC NHAN', '2025-11-20 02:07:50', 'Hà Nội'),
(12, 1, NULL, 660000, 'CHUA XAC NHAN', '2025-11-20 02:07:56', 'Hà Nội'),
(13, 1, NULL, 660000, 'CHUA XAC NHAN', '2025-11-20 02:10:02', 'Hà Nội'),
(14, 1, NULL, 350000, 'CHUA XAC NHAN', '2025-11-20 02:12:00', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `IDKH` bigint(20) NOT NULL,
  `TEN` varchar(255) DEFAULT NULL,
  `SDT` varchar(15) NOT NULL,
  `DIACHI` varchar(255) NOT NULL,
  `PWORD` varchar(255) NOT NULL,
  `TRANGTHAI` bigint(20) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`IDKH`, `TEN`, `SDT`, `DIACHI`, `PWORD`, `TRANGTHAI`) VALUES
(1, 'Nguyễn Văn A', '0901234567', 'Hà Nội', '123', 1),
(2, 'Trần Thị B', '0912345678', 'Hồ Chí Minh', 'abcd', 1),
(3, 'Lê Văn C', '0987654321', 'Đà Nẵng', 'pass1', 1),
(4, 'Phạm Thị D', '0978123456', 'Hải Phòng', 'pass2', 1),
(5, 'Đỗ Văn E', '0909988776', 'Cần Thơ', '123abc', 1),
(6, 'Ngô Thị F', '0934455667', 'Huế', 'pwf', 1),
(7, 'Bùi Văn G', '0955566778', 'Nha Trang', 'pw123', 1),
(8, 'Vũ Thị H', '0922334455', 'Bắc Ninh', '4567', 1),
(9, 'Lý Văn I', '0945566778', 'Nam Định', 'xyz', 1),
(10, 'Phan Thị K', '0967788990', 'Thanh Hóa', '0000', 1),
(15, '1', '1', '11', '1', 0),
(16, '2', '1', '1', '123', 1),
(17, '2', '1', '122222222', '123', 1),
(18, '1', '1', '1', '1', 1);

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
(3, 'Áo khoác', 'Áo Khoác Nam Lông Vũ Nhẹ Gấp Gọn Có Mũ\n\nChất liệu: Vải ngoài: nylon 100%; Lót bông: 90% lông vũ, 10% lông nhỏ; Lót trong: polyester 100%; Bo viền: nylon 70%, elastane (Anh)/spandex (Mỹ) 30%; Dải băng: polyester 100%; Túi đựng: nylon 100%.\n\nDùng lông vũ 75');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `IDNV` bigint(20) NOT NULL,
  `TENNV` varchar(255) NOT NULL,
  `SDT` varchar(15) NOT NULL,
  `DIACHI` varchar(255) DEFAULT NULL,
  `TAIKHOAN` varchar(50) NOT NULL,
  `MATKHAU` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`IDNV`, `TENNV`, `SDT`, `DIACHI`, `TAIKHOAN`, `MATKHAU`) VALUES
(1, 'Admin', '0123456789', 'Hà Nội', 'admin', '1'),
(2, 'Trần Hải', '0909000002', 'Đà Nẵng', '123', '123'),
(3, 'Lê Hòa', '0909000003', 'Huế', 'asdAWD', 'WD'),
(4, 'Phạm Sơn', '0909000004', 'Hồ Chí Minh', 'sda', 'qD'),
(5, 'Đỗ Trang', '0909000005', 'Bắc Giang', 'QWDd', 'Dadw'),
(6, 'Ngô Tùng', '0909000006', 'Nha Trang', 'QD', 'qwd'),
(7, 'Bùi Giang', '0909000007', 'Hải Phòng', 'Dad', 'sca'),
(8, 'Vũ Mai', '0909000008', 'Hà Nội', 'ad', 'awd'),
(9, 'Lý Khang', '0909000009', 'Huế', 'Scd', 'CsA'),
(10, 'Phan Anh', '0909000010', 'Cần Thơ', 'casc', 'aacscs'),
(11, 'Nguyễn Minh', '0909000001', 'Hà Nội', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `IDSIZE` int(10) NOT NULL,
  `TENSIZE` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`IDSIZE`, `TENSIZE`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ao`
--
ALTER TABLE `ao`
  ADD PRIMARY KEY (`IDAO`);

--
-- Indexes for table `ao_size`
--
ALTER TABLE `ao_size`
  ADD PRIMARY KEY (`IDSIZE`,`IDAO`),
  ADD KEY `ao_size_ibfk_2` (`IDAO`);

--
-- Indexes for table `ctdh`
--
ALTER TABLE `ctdh`
  ADD PRIMARY KEY (`IDDH`,`IDAO`,`IDSIZE`) USING BTREE,
  ADD KEY `IDAO` (`IDAO`,`IDSIZE`) USING BTREE;

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
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`IDSIZE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ao`
--
ALTER TABLE `ao`
  MODIFY `IDAO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `IDDH` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `IDKH` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `loaiao`
--
ALTER TABLE `loaiao`
  MODIFY `IDLOAI` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `IDNV` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `IDSIZE` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ao_size`
--
ALTER TABLE `ao_size`
  ADD CONSTRAINT `ao_size_ibfk_1` FOREIGN KEY (`IDSIZE`) REFERENCES `size` (`IDSIZE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ao_size_ibfk_2` FOREIGN KEY (`IDAO`) REFERENCES `ao` (`IDAO`) ON DELETE CASCADE ON UPDATE CASCADE;

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
