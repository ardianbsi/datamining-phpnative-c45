CREATE TABLE `mahasiswa_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ipk` decimal(3,2) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `jumlah_nilai_d` int(11) NOT NULL,
  `jumlah_nilai_e` int(11) NOT NULL,
  `status_kelulusan` enum('Tepat Waktu','Terlambat') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `mahasiswa_testing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ipk` decimal(3,2) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `jumlah_nilai_d` int(11) NOT NULL,
  `jumlah_nilai_e` int(11) NOT NULL,
  `status_kelulusan` enum('Tepat Waktu','Terlambat') DEFAULT NULL,
  `prediksi` enum('Tepat Waktu','Terlambat') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `mahasiswa_training` (`nim`, `nama`, `ipk`, `sks`, `semester`, `jumlah_nilai_d`, `jumlah_nilai_e`, `status_kelulusan`) VALUES
('190001', 'Andi Wijaya', 3.45, 144, 8, 0, 0, 'Tepat Waktu'),
('190002', 'Budi Santoso', 3.20, 144, 8, 1, 0, 'Tepat Waktu'),
('190003', 'Citra Dewi', 3.75, 144, 7, 0, 0, 'Tepat Waktu'),
('190004', 'Dian Pratama', 2.95, 140, 8, 2, 1, 'Terlambat'),
('190005', 'Eka Putri', 3.10, 144, 9, 1, 0, 'Terlambat'),
('190006', 'Fajar Nugroho', 2.80, 138, 8, 3, 2, 'Terlambat'),
('190007', 'Gita Maya', 3.60, 144, 7, 0, 0, 'Tepat Waktu'),
('190008', 'Hendra Kurnia', 3.30, 144, 8, 0, 0, 'Tepat Waktu'),
('190009', 'Indah Permata', 2.90, 142, 9, 2, 1, 'Terlambat'),
('190010', 'Joko Susilo', 3.25, 144, 8, 1, 0, 'Tepat Waktu');



INSERT INTO `mahasiswa_testing` (`nim`, `nama`, `ipk`, `sks`, `semester`, `jumlah_nilai_d`, `jumlah_nilai_e`, `status_kelulusan`) VALUES
('200001', 'Krisna Adi', 3.40, 144, 8, 0, 0, 'Tepat Waktu'),
('200002', 'Lina Marlina', 3.15, 144, 8, 1, 0, 'Tepat Waktu'),
('200003', 'Mega Wati', 2.85, 140, 9, 2, 1, 'Terlambat'),
('200004', 'Nando Pratama', 3.50, 144, 7, 0, 0, 'Tepat Waktu'),
('200005', 'Oki Setiawan', 2.95, 138, 8, 3, 1, 'Terlambat');