-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 06, 2014 at 02:54 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `drt`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `t_bidang`
-- 

CREATE TABLE `t_bidang` (
  `id_bidang` int(11) NOT NULL auto_increment,
  `nama_bidang` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_bidang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `t_bidang`
-- 

INSERT INTO `t_bidang` VALUES (1, 'Leveransir');
INSERT INTO `t_bidang` VALUES (2, 'Konstruksi');
INSERT INTO `t_bidang` VALUES (3, 'Asuransi');
INSERT INTO `t_bidang` VALUES (4, 'Konsultansi');

-- --------------------------------------------------------

-- 
-- Table structure for table `t_bidang_h`
-- 

CREATE TABLE `t_bidang_h` (
  `id_bidang_h` int(11) NOT NULL,
  `nama_bidang_h` varchar(50) NOT NULL,
  `id_seleksi` int(11) NOT NULL,
  PRIMARY KEY  (`id_bidang_h`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `t_bidang_h`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `t_dokumen`
-- 

CREATE TABLE `t_dokumen` (
  `id_dokumen` int(5) NOT NULL auto_increment,
  `id_rekanan` int(5) NOT NULL,
  `n_srp_sbu` varchar(12) default NULL,
  `srp_sbu` date NOT NULL,
  `stat_srp` char(1) default '0',
  `n_akta_notaris` varchar(12) default NULL,
  `stat_akta` char(1) default '0',
  `n_tdp` varchar(12) default NULL,
  `tdp` date NOT NULL,
  `stat_tdp` char(1) default '0',
  `n_skitu` varchar(12) default NULL,
  `skitu` date NOT NULL,
  `stat_skitu` char(1) default '0',
  `n_siup` varchar(12) default NULL,
  `siup` date NOT NULL,
  `stat_siup` char(1) default '0',
  `n_iujk` varchar(12) default NULL,
  `iujk` date default NULL,
  `stat_iujk` char(1) default NULL,
  `n_npwp` varchar(20) NOT NULL,
  `stat_npwp` char(1) default '0',
  `n_kta_asosiasi` varchar(12) default NULL,
  `kta_asosiasi` date NOT NULL,
  `stat_kta_asosiasi` char(1) default '0',
  `struktur_org` char(1) NOT NULL,
  PRIMARY KEY  (`id_dokumen`),
  UNIQUE KEY `nama_perusahaan` (`id_rekanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- 
-- Dumping data for table `t_dokumen`
-- 

INSERT INTO `t_dokumen` VALUES (1, 1, '', '2015-01-01', '0', '123123123', '0', '', '2015-01-10', '0', '', '2015-01-12', '0', '', '2015-01-15', '0', NULL, '0000-00-00', NULL, '45.501.909.9-123.000', '0', '', '2015-01-21', '0', '1');
INSERT INTO `t_dokumen` VALUES (3, 2, '', '2015-01-01', '0', '', '0', '', '2015-01-01', '0', '', '2015-01-01', '0', '', '2013-12-24', '0', NULL, '0000-00-00', NULL, '888.999.888', '0', '', '2015-01-01', '0', '1');
INSERT INTO `t_dokumen` VALUES (4, 3, '', '2015-01-01', '0', '', '0', '', '2015-01-01', '0', '', '2013-01-01', '0', '', '2013-12-12', '1', NULL, '0000-00-00', NULL, '123.456.789', '0', '', '2015-01-01', '0', '1');
INSERT INTO `t_dokumen` VALUES (44, 51, NULL, '2014-03-05', '0', '-----', '0', NULL, '2014-03-06', '0', NULL, '2014-03-29', '0', NULL, '0000-00-00', '0', NULL, '0000-00-00', NULL, '345345345', '0', NULL, '2014-03-03', '0', '1');

-- --------------------------------------------------------

-- 
-- Table structure for table `t_kategori`
-- 

CREATE TABLE `t_kategori` (
  `id_kategori` int(3) NOT NULL auto_increment,
  `id_bidang` int(3) NOT NULL,
  `nama_kategori` varchar(50) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `t_kategori`
-- 

INSERT INTO `t_kategori` VALUES (1, 1, 'Bidang Pemasokan Barang');
INSERT INTO `t_kategori` VALUES (2, 1, 'Bidang Jasa');
INSERT INTO `t_kategori` VALUES (3, 2, 'Bidang Arsitektur ');
INSERT INTO `t_kategori` VALUES (4, 2, 'Bidang Sipil');
INSERT INTO `t_kategori` VALUES (5, 2, 'Bidang Mekanik');
INSERT INTO `t_kategori` VALUES (6, 2, 'Bidang Elektrik ');
INSERT INTO `t_kategori` VALUES (7, 2, 'Bidang Tata Lingkungan');
INSERT INTO `t_kategori` VALUES (8, 3, 'Asuransi & Perbankan');
INSERT INTO `t_kategori` VALUES (9, 4, 'Bidang Pertanian');
INSERT INTO `t_kategori` VALUES (10, 4, 'Bidang Perindustrian');
INSERT INTO `t_kategori` VALUES (11, 4, 'Bidang Pertambangan dan Energi');
INSERT INTO `t_kategori` VALUES (12, 4, 'Bidang Pembangkit Tenaga');
INSERT INTO `t_kategori` VALUES (13, 4, 'Bidang Lain-Lain');
INSERT INTO `t_kategori` VALUES (14, 4, 'Klasifikasi Layanan Pekerjaan');

-- --------------------------------------------------------

-- 
-- Table structure for table `t_rekanan`
-- 

CREATE TABLE `t_rekanan` (
  `id_rekanan` int(5) NOT NULL auto_increment,
  `nama_rekanan` varchar(50) NOT NULL,
  `alamat_rekanan` text NOT NULL,
  `no_telp` varchar(15) default NULL,
  `nama_pimpinan` varchar(50) NOT NULL,
  `jabatan_pimpinan` varchar(20) NOT NULL,
  `golongan` varchar(3) NOT NULL,
  `status` tinyint(1) default '0',
  PRIMARY KEY  (`id_rekanan`),
  UNIQUE KEY `nama_perusahaan` (`nama_rekanan`),
  UNIQUE KEY `nama_perusahaan_2` (`nama_rekanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

-- 
-- Dumping data for table `t_rekanan`
-- 

INSERT INTO `t_rekanan` VALUES (1, 'PT. Naga Sakti Perkasa', 'Jl. Darussalam Medan 20119', '012345678912', 'Muhammad Arifin Siregar', 'Direktur Utama', 'K', 1);
INSERT INTO `t_rekanan` VALUES (2, 'CV. Kencana Indah', 'Jl. T. Umar No.63 Gp. Peukan Langsa', '012345678912', 'Thamrin', 'Direktur Utama', 'K', 1);
INSERT INTO `t_rekanan` VALUES (3, 'CV. Indah Jaya', 'Jl. Asia No. 108 Medan, Sumatera Utara', '012345678912', 'Donald Trump', 'Direktur Operasional', 'K', 1);
INSERT INTO `t_rekanan` VALUES (51, 'aqaqaq', 'eqweqwessssss', '123456789', 'wqeeqaaaaaa', 'Direksi', 'G2', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `t_seleksi`
-- 

CREATE TABLE `t_seleksi` (
  `id_seleksi` int(11) NOT NULL auto_increment,
  `nomor` char(3) NOT NULL,
  `id_rekanan` int(11) NOT NULL,
  `penilaian` int(11) NOT NULL,
  `keterangan` varchar(100) default NULL,
  `tmt` date NOT NULL,
  `akhir_masa_berlaku` date NOT NULL,
  `no_skep` char(30) NOT NULL,
  `tahap_drt` char(3) NOT NULL,
  `tahun` char(4) NOT NULL,
  PRIMARY KEY  (`id_seleksi`),
  KEY `id_rekanan` (`id_rekanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- 
-- Dumping data for table `t_seleksi`
-- 

INSERT INTO `t_seleksi` VALUES (22, '', 2, 90, '', '2013-01-01', '2013-12-31', '01.CS/SKEP/1/2013', '1', '2013');
INSERT INTO `t_seleksi` VALUES (21, '', 1, 80, NULL, '2013-01-01', '2013-12-31', '01.CS/SKEP/1/2013', '2', '2013');
INSERT INTO `t_seleksi` VALUES (24, '', 3, 89, NULL, '2012-01-01', '2012-12-31', '123123123', '1', '2012');
INSERT INTO `t_seleksi` VALUES (25, '', 34, 65, '', '2013-01-01', '2013-12-31', '01.CS/SKEP/1/2013', '1', '2013');
INSERT INTO `t_seleksi` VALUES (28, '', 2, 90, NULL, '2013-12-04', '2013-12-06', '01.5/P/SKEP/1/2014', '1', '2014');
INSERT INTO `t_seleksi` VALUES (27, '', 36, 90, NULL, '2013-12-01', '2013-12-31', '01.CS/SKEP/10/2013', '10', '2013');
INSERT INTO `t_seleksi` VALUES (29, '', 36, 90, NULL, '2013-12-04', '2013-12-06', '01.5/P/SKEP/1/2014', '1', '2014');

-- --------------------------------------------------------

-- 
-- Table structure for table `t_sub`
-- 

CREATE TABLE `t_sub` (
  `id` int(5) NOT NULL auto_increment,
  `id_sub_bidang` int(5) NOT NULL,
  `id_rekanan` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=615 ;

-- 
-- Dumping data for table `t_sub`
-- 

INSERT INTO `t_sub` VALUES (1, 1, 1);
INSERT INTO `t_sub` VALUES (2, 2, 1);
INSERT INTO `t_sub` VALUES (3, 3, 1);
INSERT INTO `t_sub` VALUES (4, 4, 1);
INSERT INTO `t_sub` VALUES (5, 5, 1);
INSERT INTO `t_sub` VALUES (6, 6, 1);
INSERT INTO `t_sub` VALUES (7, 7, 1);
INSERT INTO `t_sub` VALUES (8, 8, 1);
INSERT INTO `t_sub` VALUES (9, 9, 1);
INSERT INTO `t_sub` VALUES (10, 10, 1);
INSERT INTO `t_sub` VALUES (11, 11, 1);
INSERT INTO `t_sub` VALUES (12, 12, 1);
INSERT INTO `t_sub` VALUES (13, 13, 1);
INSERT INTO `t_sub` VALUES (14, 14, 1);
INSERT INTO `t_sub` VALUES (15, 15, 1);
INSERT INTO `t_sub` VALUES (16, 16, 1);
INSERT INTO `t_sub` VALUES (17, 17, 1);
INSERT INTO `t_sub` VALUES (18, 18, 1);
INSERT INTO `t_sub` VALUES (19, 19, 1);
INSERT INTO `t_sub` VALUES (20, 20, 1);
INSERT INTO `t_sub` VALUES (21, 21, 1);
INSERT INTO `t_sub` VALUES (22, 40, 2);
INSERT INTO `t_sub` VALUES (23, 41, 2);
INSERT INTO `t_sub` VALUES (24, 42, 2);
INSERT INTO `t_sub` VALUES (25, 43, 2);
INSERT INTO `t_sub` VALUES (26, 44, 2);
INSERT INTO `t_sub` VALUES (27, 45, 2);
INSERT INTO `t_sub` VALUES (28, 46, 2);
INSERT INTO `t_sub` VALUES (29, 47, 2);
INSERT INTO `t_sub` VALUES (30, 48, 2);
INSERT INTO `t_sub` VALUES (31, 49, 2);
INSERT INTO `t_sub` VALUES (32, 50, 2);
INSERT INTO `t_sub` VALUES (33, 78, 3);
INSERT INTO `t_sub` VALUES (34, 79, 3);
INSERT INTO `t_sub` VALUES (35, 80, 3);
INSERT INTO `t_sub` VALUES (36, 81, 3);
INSERT INTO `t_sub` VALUES (37, 82, 3);
INSERT INTO `t_sub` VALUES (38, 83, 3);
INSERT INTO `t_sub` VALUES (39, 84, 3);
INSERT INTO `t_sub` VALUES (40, 40, 1);
INSERT INTO `t_sub` VALUES (41, 41, 1);
INSERT INTO `t_sub` VALUES (42, 42, 1);
INSERT INTO `t_sub` VALUES (43, 43, 1);
INSERT INTO `t_sub` VALUES (44, 44, 1);
INSERT INTO `t_sub` VALUES (583, 83, 3);
INSERT INTO `t_sub` VALUES (582, 82, 3);
INSERT INTO `t_sub` VALUES (581, 81, 3);
INSERT INTO `t_sub` VALUES (580, 80, 3);
INSERT INTO `t_sub` VALUES (579, 79, 3);
INSERT INTO `t_sub` VALUES (578, 78, 3);
INSERT INTO `t_sub` VALUES (577, 50, 2);
INSERT INTO `t_sub` VALUES (576, 49, 2);
INSERT INTO `t_sub` VALUES (575, 48, 2);
INSERT INTO `t_sub` VALUES (574, 47, 2);
INSERT INTO `t_sub` VALUES (573, 46, 2);
INSERT INTO `t_sub` VALUES (572, 45, 2);
INSERT INTO `t_sub` VALUES (571, 44, 2);
INSERT INTO `t_sub` VALUES (570, 43, 2);
INSERT INTO `t_sub` VALUES (569, 42, 2);
INSERT INTO `t_sub` VALUES (568, 41, 2);
INSERT INTO `t_sub` VALUES (567, 40, 2);
INSERT INTO `t_sub` VALUES (566, 50, 2);
INSERT INTO `t_sub` VALUES (565, 49, 2);
INSERT INTO `t_sub` VALUES (564, 48, 2);
INSERT INTO `t_sub` VALUES (563, 47, 2);
INSERT INTO `t_sub` VALUES (562, 46, 2);
INSERT INTO `t_sub` VALUES (561, 45, 2);
INSERT INTO `t_sub` VALUES (560, 44, 2);
INSERT INTO `t_sub` VALUES (559, 43, 2);
INSERT INTO `t_sub` VALUES (558, 42, 2);
INSERT INTO `t_sub` VALUES (557, 41, 2);
INSERT INTO `t_sub` VALUES (556, 40, 2);
INSERT INTO `t_sub` VALUES (555, 84, 3);
INSERT INTO `t_sub` VALUES (554, 83, 3);
INSERT INTO `t_sub` VALUES (553, 82, 3);
INSERT INTO `t_sub` VALUES (552, 81, 3);
INSERT INTO `t_sub` VALUES (551, 80, 3);
INSERT INTO `t_sub` VALUES (550, 79, 3);
INSERT INTO `t_sub` VALUES (549, 78, 3);
INSERT INTO `t_sub` VALUES (548, 84, 3);
INSERT INTO `t_sub` VALUES (547, 83, 3);
INSERT INTO `t_sub` VALUES (546, 82, 3);
INSERT INTO `t_sub` VALUES (545, 81, 3);
INSERT INTO `t_sub` VALUES (544, 80, 3);
INSERT INTO `t_sub` VALUES (543, 79, 3);
INSERT INTO `t_sub` VALUES (542, 78, 3);
INSERT INTO `t_sub` VALUES (604, 41, 51);
INSERT INTO `t_sub` VALUES (603, 40, 51);
INSERT INTO `t_sub` VALUES (602, 43, 51);
INSERT INTO `t_sub` VALUES (601, 42, 51);
INSERT INTO `t_sub` VALUES (600, 41, 51);
INSERT INTO `t_sub` VALUES (599, 40, 51);
INSERT INTO `t_sub` VALUES (598, 43, 51);
INSERT INTO `t_sub` VALUES (597, 42, 51);
INSERT INTO `t_sub` VALUES (596, 41, 51);
INSERT INTO `t_sub` VALUES (595, 40, 51);
INSERT INTO `t_sub` VALUES (584, 84, 3);
INSERT INTO `t_sub` VALUES (614, 43, 51);
INSERT INTO `t_sub` VALUES (613, 42, 51);
INSERT INTO `t_sub` VALUES (612, 41, 51);
INSERT INTO `t_sub` VALUES (611, 40, 51);
INSERT INTO `t_sub` VALUES (610, 43, 51);
INSERT INTO `t_sub` VALUES (609, 42, 51);
INSERT INTO `t_sub` VALUES (608, 41, 51);
INSERT INTO `t_sub` VALUES (607, 40, 51);
INSERT INTO `t_sub` VALUES (606, 43, 51);
INSERT INTO `t_sub` VALUES (605, 42, 51);

-- --------------------------------------------------------

-- 
-- Table structure for table `t_sub_bidang`
-- 

CREATE TABLE `t_sub_bidang` (
  `id_sub` int(3) NOT NULL auto_increment,
  `id_bidang` int(3) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `nama_sub` text NOT NULL,
  UNIQUE KEY `nama_perusahaan` (`id_sub`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

-- 
-- Dumping data for table `t_sub_bidang`
-- 

INSERT INTO `t_sub_bidang` VALUES (1, 1, 1, 'Alat/peralatan/suku cadang tulis, barang cetakan, kantor, pergudangan dan perlengkapan pegawai.');
INSERT INTO `t_sub_bidang` VALUES (2, 1, 1, 'Alat/peralatan/suku cadang teknik, mekanik, elektrik, ukur, survey laboratorium dan timbangan khusus.');
INSERT INTO `t_sub_bidang` VALUES (3, 1, 1, 'Alat/peralatan/suku cadang radio pos, telekomunikasi, navigasi, elektronik, meteorologi, geofisika, klimatologi, hidrologi.');
INSERT INTO `t_sub_bidang` VALUES (4, 1, 1, 'Alat/peralatan/suku cadang teknik pendidikan, peragaan, visualisasi, olahraga, dan kesenian.');
INSERT INTO `t_sub_bidang` VALUES (5, 1, 1, 'Alat/peralatan/suku cadang pertanian, perkebunan, peternakan, perikanan, dan kehutanan.');
INSERT INTO `t_sub_bidang` VALUES (6, 1, 1, 'Alat/peralatan/suku cadang kesehatan, kodokteran, dan farmasi');
INSERT INTO `t_sub_bidang` VALUES (7, 1, 1, 'Alat/peralatan/perabot rumah tangga.');
INSERT INTO `t_sub_bidang` VALUES (8, 1, 1, 'Alat/peralatan/suku cadang konstruksi (alat-alat besar, compressor, generator, dll, bahan bangunan dan logam).');
INSERT INTO `t_sub_bidang` VALUES (9, 1, 1, 'Alat/peralatan/suku cadang kendaraan bermotor dan pengujian (termasuk kereta api, pesawat terbang dan kapal  laut).');
INSERT INTO `t_sub_bidang` VALUES (10, 1, 1, 'Alat/peralatan/suku cadang keselamatan angkutan darat, laut, dan udara (termasuk peralatan untuk SAR).');
INSERT INTO `t_sub_bidang` VALUES (11, 1, 1, 'Alat/peralatan/suku cadang instalasi/distribusi zat cair dan gas.');
INSERT INTO `t_sub_bidang` VALUES (12, 1, 1, 'Alat/peralatan/suku cadang keselamatan kerja dan pemadam kebakaran.');
INSERT INTO `t_sub_bidang` VALUES (13, 1, 1, 'Alat/peralatan/suku cadang senjata api dan amunisi.');
INSERT INTO `t_sub_bidang` VALUES (14, 1, 1, 'Alat/peralatan/suku cadang komputer.');
INSERT INTO `t_sub_bidang` VALUES (15, 1, 1, 'Bahan bakar, pelumas, minyak, dan cat.');
INSERT INTO `t_sub_bidang` VALUES (16, 1, 1, 'Bahan makanan ternak, pestisida, obat pertanian, dan pupuk.');
INSERT INTO `t_sub_bidang` VALUES (17, 1, 1, 'Bahan pangan.');
INSERT INTO `t_sub_bidang` VALUES (18, 1, 1, 'Bahan kimia, bahan baku, dan obat jadi.');
INSERT INTO `t_sub_bidang` VALUES (19, 1, 1, 'Bibit dan usaha pertanian, peternakan, perikanan, dan kehutanan.');
INSERT INTO `t_sub_bidang` VALUES (20, 1, 1, 'Bahan kemasan.');
INSERT INTO `t_sub_bidang` VALUES (21, 1, 1, 'Bidang sub bidang pemasok barang lainnya.');
INSERT INTO `t_sub_bidang` VALUES (22, 1, 2, 'Percetakan');
INSERT INTO `t_sub_bidang` VALUES (23, 1, 2, 'Pemeliharaan/perbaikan alat/peralatan kantor.');
INSERT INTO `t_sub_bidang` VALUES (24, 1, 2, 'Pemeliharaan/perbaikan alat/peralatan angkutan darat, laut, dan udara.');
INSERT INTO `t_sub_bidang` VALUES (25, 1, 2, 'Pemeliharaan/perbaikan alat/peralatan pustaka (termasuk pemeliharaan pengawetan barang-barang awetan flora dan fauna, dll.).');
INSERT INTO `t_sub_bidang` VALUES (26, 1, 2, 'Jasa pembersih (Cleaning service), Post control, Termite control, dan fumigasi.');
INSERT INTO `t_sub_bidang` VALUES (27, 1, 2, 'Pengepakan, pengangkutan, pengurusan, dan penyampaian barang darat, laut, dan udara.');
INSERT INTO `t_sub_bidang` VALUES (28, 1, 2, 'Penjahit/konveksi.');
INSERT INTO `t_sub_bidang` VALUES (29, 1, 2, 'Jasa boga (catering).');
INSERT INTO `t_sub_bidang` VALUES (30, 1, 2, 'Jasa eksportir/importir.');
INSERT INTO `t_sub_bidang` VALUES (31, 1, 2, 'Perawatan komputer, alat/peralatan elektronik dan komunikasi.');
INSERT INTO `t_sub_bidang` VALUES (32, 1, 2, 'Iklan/reklame, film, dan fotografi.');
INSERT INTO `t_sub_bidang` VALUES (33, 1, 2, 'Jasa penulisan dan penerjemahan.');
INSERT INTO `t_sub_bidang` VALUES (34, 1, 2, 'Penyediaan tenaga kerja.');
INSERT INTO `t_sub_bidang` VALUES (35, 1, 2, 'Penyewaan alat angkutan darat, laut, dan udara.');
INSERT INTO `t_sub_bidang` VALUES (36, 1, 2, 'Penyewaan peralatan kerja, produksi, dan konstruksi.');
INSERT INTO `t_sub_bidang` VALUES (37, 1, 2, 'Jasa penyelaman/pekerjaan bawah air.');
INSERT INTO `t_sub_bidang` VALUES (38, 1, 2, 'Jasa asuransi.');
INSERT INTO `t_sub_bidang` VALUES (39, 1, 2, 'Pembelian hasil pertanian.');
INSERT INTO `t_sub_bidang` VALUES (40, 2, 3, 'Perumahan dan pemukiman termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (41, 2, 3, 'Non perumahan, gedung dan pabrik termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (42, 2, 3, 'Pertamanan, fasilitas rekreasi dan lainnya termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (43, 2, 3, 'Interior termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (44, 2, 4, 'Drainase kota dan saluran air termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (45, 2, 4, 'Jalan, landasan, dan lokasi termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (46, 2, 4, 'Jembatan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (47, 2, 4, 'Pengeboran darat termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (48, 2, 4, 'Jalan dan jembatan kereta api termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (49, 2, 4, 'Bendung dan bendungan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (50, 2, 4, 'Bendungan bawah air termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (51, 2, 4, 'Pelabuhan, dermaga penahan gelombang dan tanah termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (52, 2, 4, 'Reklamasi, pengerukan dan pengurungan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (53, 2, 4, 'Pembukaan areal transmigrasi termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (54, 2, 4, 'Percetakan sawah dan pembukaan lahan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (55, 2, 4, 'Penyiapan dan pengupasan lahan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (56, 2, 4, 'Penggalian/penambangan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (57, 2, 4, 'Irigasi dan drainase termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (58, 2, 4, 'Persungaian rawa dan pantai termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (59, 2, 4, 'Pekerjaan sipil lainnya termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (60, 2, 5, 'Tata udara (Air conditioner) termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (61, 2, 5, 'Pekerjaan mekanik termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (62, 2, 5, 'Instalasi industri dan pembangkit termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (63, 2, 5, 'Instalasi bertekanan (Thermal) termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (64, 2, 5, 'Fasilitas produksi, penyimpanan minyak dan gas termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (65, 2, 6, 'Kelistrikan dan pembangkit termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (66, 2, 6, 'Transmisi kelistrikan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (67, 2, 6, 'Radio telekomunikasi, saran bantu navigasi laut, rambu sungai, peralatan SAR, dan navigasi udara termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (68, 2, 6, 'Sinyal dan telekomunikasi kereta api termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (69, 2, 6, 'Sentral komunikasi termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (70, 2, 6, 'Jaringan telekomunikasi termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (71, 2, 6, 'Pemasangan instrument termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (72, 2, 6, 'Pos, telekomunikasi, dan instrument lainnya termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (73, 2, 7, 'Bangunan pengolahan air bersih dan air limbah termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (74, 2, 7, 'Perpipaan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (75, 2, 7, 'Reboisasi/penghijauan termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (76, 2, 7, 'Pengeboran air tanah termasuk perawatannya.');
INSERT INTO `t_sub_bidang` VALUES (77, 3, 8, 'Asuransi, perbankan, dan keuangan.');
INSERT INTO `t_sub_bidang` VALUES (78, 4, 9, 'Perkebunan tanaman keras.');
INSERT INTO `t_sub_bidang` VALUES (79, 4, 9, 'Pertanian tanaman pangan.');
INSERT INTO `t_sub_bidang` VALUES (80, 4, 9, 'Peternakan.');
INSERT INTO `t_sub_bidang` VALUES (81, 4, 9, 'Perikanan.');
INSERT INTO `t_sub_bidang` VALUES (82, 4, 9, 'Kehutanan.');
INSERT INTO `t_sub_bidang` VALUES (83, 4, 9, 'Konservasi dan penghijauan.');
INSERT INTO `t_sub_bidang` VALUES (84, 4, 9, 'Pertanian lainnya.');
INSERT INTO `t_sub_bidang` VALUES (85, 4, 10, 'Industri mesin dan logam.');
INSERT INTO `t_sub_bidang` VALUES (86, 4, 10, 'Industri kimia.');
INSERT INTO `t_sub_bidang` VALUES (87, 4, 10, 'Industri hasil pertanian.');
INSERT INTO `t_sub_bidang` VALUES (88, 4, 10, 'Industri elektronik.');
INSERT INTO `t_sub_bidang` VALUES (89, 4, 10, 'Industri bahan bangunan.');
INSERT INTO `t_sub_bidang` VALUES (90, 4, 10, 'Perindustrian lainnya.');
INSERT INTO `t_sub_bidang` VALUES (91, 4, 11, 'Perminyakan.');
INSERT INTO `t_sub_bidang` VALUES (92, 4, 11, 'Penambangan umum.');
INSERT INTO `t_sub_bidang` VALUES (93, 4, 11, 'Mineral.');
INSERT INTO `t_sub_bidang` VALUES (94, 4, 11, 'Pertambangan dan energi lainnya.');
INSERT INTO `t_sub_bidang` VALUES (95, 4, 12, 'Distribusi dan transmisi.');
INSERT INTO `t_sub_bidang` VALUES (96, 4, 12, 'Pembangkit tenaga lainnya');
INSERT INTO `t_sub_bidang` VALUES (97, 4, 13, 'Asuransi, perbankan, dan keuangan.');
INSERT INTO `t_sub_bidang` VALUES (98, 4, 13, 'Kesehatan, pendidikan, sumber daya manusia, dan kependudukan.');
INSERT INTO `t_sub_bidang` VALUES (99, 4, 13, 'Hukum penerangan.');
INSERT INTO `t_sub_bidang` VALUES (100, 4, 13, 'Sub bidang lainnya.');
INSERT INTO `t_sub_bidang` VALUES (101, 4, 14, 'Jasa survey.');
INSERT INTO `t_sub_bidang` VALUES (102, 4, 14, 'Perencanaan umum.');
INSERT INTO `t_sub_bidang` VALUES (103, 4, 14, 'Studi kelayakan.');
INSERT INTO `t_sub_bidang` VALUES (104, 4, 14, 'Perencanaan teknis.');
INSERT INTO `t_sub_bidang` VALUES (105, 4, 14, 'Penelitian.');
INSERT INTO `t_sub_bidang` VALUES (106, 4, 14, 'Pengawasan.');
INSERT INTO `t_sub_bidang` VALUES (107, 4, 14, 'Manajemen.');

-- --------------------------------------------------------

-- 
-- Table structure for table `t_sub_h`
-- 

CREATE TABLE `t_sub_h` (
  `id_sub_h` int(11) NOT NULL,
  `id_bidang_h` int(11) NOT NULL,
  `nama_sub_h` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `t_sub_h`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `register` char(18) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `login_counter` int(3) NOT NULL,
  `level` int(1) NOT NULL default '1',
  PRIMARY KEY  (`register`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `username_2` (`username`),
  UNIQUE KEY `username_3` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES ('123456789', 'anca', 'bd754cb79946b582127e2ddee', 'Muhammad Arifin Siregar', 46, 2);
INSERT INTO `user` VALUES ('9090', 'admin', 'bd754cb79946b582127e2ddee', 'admin', 5, 2);
INSERT INTO `user` VALUES ('01001010101', 'uli', 'ab224c09f1f18033d34baad25', 'Uli', 1, 2);
