-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 14, 2025 alle 02:26
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luigi_tanzillo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `immagini_progetti`
--

CREATE TABLE `immagini_progetti` (
  `id` int(11) NOT NULL,
  `progetto_id` int(11) NOT NULL,
  `nome_file` varchar(255) NOT NULL,
  `percorso_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `immagini_progetti`
--

INSERT INTO `immagini_progetti` (`id`, `progetto_id`, `nome_file`, `percorso_file`) VALUES
(289, 142, 'B7900C6B-9CD6-4131-BC02-967BED20F23C_1749848390684c9146a669c.jpg', 'assets/uploads/projects/B7900C6B-9CD6-4131-BC02-967BED20F23C_1749848390684c9146a669c.jpg'),
(290, 142, 'IMG_8606_1749848390684c9146a74ba.JPG', 'assets/uploads/projects/IMG_8606_1749848390684c9146a74ba.JPG'),
(291, 142, 'IMG_8607_1749848390684c9146a8887.JPG', 'assets/uploads/projects/IMG_8607_1749848390684c9146a8887.JPG'),
(292, 142, 'IMG_8608_1749848390684c9146a9354.JPG', 'assets/uploads/projects/IMG_8608_1749848390684c9146a9354.JPG'),
(293, 142, 'IMG_8614_1749848390684c9146a9f83.JPEG', 'assets/uploads/projects/IMG_8614_1749848390684c9146a9f83.JPEG'),
(313, 144, 'IMG_3037_1749849965684c976d22d89.JPEG', 'assets/uploads/projects/IMG_3037_1749849965684c976d22d89.JPEG'),
(314, 144, 'IMG_2979_1749849965684c976d23439.JPG', 'assets/uploads/projects/IMG_2979_1749849965684c976d23439.JPG'),
(315, 144, 'IMG_2985_1749849965684c976d238ed.JPG', 'assets/uploads/projects/IMG_2985_1749849965684c976d238ed.JPG'),
(316, 144, 'IMG_2976_1749849965684c976d23f95.JPG', 'assets/uploads/projects/IMG_2976_1749849965684c976d23f95.JPG'),
(317, 144, 'IMG_2980_1749849965684c976d244e5.JPG', 'assets/uploads/projects/IMG_2980_1749849965684c976d244e5.JPG'),
(318, 144, 'IMG_2975_1749849965684c976d2492b.JPG', 'assets/uploads/projects/IMG_2975_1749849965684c976d2492b.JPG'),
(319, 144, 'IMG_2978_1749849965684c976d24c0f.JPG', 'assets/uploads/projects/IMG_2978_1749849965684c976d24c0f.JPG'),
(320, 144, 'IMG_2983_1749849965684c976d2518f.JPG', 'assets/uploads/projects/IMG_2983_1749849965684c976d2518f.JPG'),
(321, 144, 'IMG_2970_1749849965684c976d256c9.JPG', 'assets/uploads/projects/IMG_2970_1749849965684c976d256c9.JPG'),
(322, 144, 'IMG_2984_1749849965684c976d25b7e.JPG', 'assets/uploads/projects/IMG_2984_1749849965684c976d25b7e.JPG'),
(323, 144, 'IMG_2974_1749849965684c976d25f4b.JPG', 'assets/uploads/projects/IMG_2974_1749849965684c976d25f4b.JPG'),
(324, 144, 'IMG_2981_1749849965684c976d262c8.JPG', 'assets/uploads/projects/IMG_2981_1749849965684c976d262c8.JPG'),
(325, 144, 'IMG_2971_1749849965684c976d26506.JPG', 'assets/uploads/projects/IMG_2971_1749849965684c976d26506.JPG'),
(326, 144, 'IMG_2973_1749849965684c976d26839.JPG', 'assets/uploads/projects/IMG_2973_1749849965684c976d26839.JPG'),
(327, 144, 'IMG_2972_1749849965684c976d26b9a.JPG', 'assets/uploads/projects/IMG_2972_1749849965684c976d26b9a.JPG'),
(330, 147, 'IMG_2548_1749856109684caf6d1e521.JPG', 'assets/uploads/projects/IMG_2548_1749856109684caf6d1e521.JPG'),
(331, 147, '1682C7AE-5CE8-4448-A12E-89D44CDEBD42_1749856109684caf6d1e910.jpg', 'assets/uploads/projects/1682C7AE-5CE8-4448-A12E-89D44CDEBD42_1749856109684caf6d1e910.jpg'),
(332, 147, 'IMG_03BF8F4B-44F6-4B3E-9A9F-AA01673C92D7_1749856109684caf6d1eb45.jpeg', 'assets/uploads/projects/IMG_03BF8F4B-44F6-4B3E-9A9F-AA01673C92D7_1749856109684caf6d1eb45.jpeg'),
(333, 147, 'IMG_2542_1749856109684caf6d1f1fe.JPG', 'assets/uploads/projects/IMG_2542_1749856109684caf6d1f1fe.JPG'),
(334, 147, 'IMG_2466_1749856109684caf6d1f4e9.JPEG', 'assets/uploads/projects/IMG_2466_1749856109684caf6d1f4e9.JPEG'),
(335, 147, 'IMG_2544_1749856109684caf6d1f7dd.JPG', 'assets/uploads/projects/IMG_2544_1749856109684caf6d1f7dd.JPG'),
(336, 147, 'IMG_2543_1749856109684caf6d1fd71.JPG', 'assets/uploads/projects/IMG_2543_1749856109684caf6d1fd71.JPG'),
(337, 147, 'IMG_2541_1749856109684caf6d1ffaf.JPG', 'assets/uploads/projects/IMG_2541_1749856109684caf6d1ffaf.JPG'),
(338, 147, 'IMG_2545_1749856109684caf6d201ec.JPG', 'assets/uploads/projects/IMG_2545_1749856109684caf6d201ec.JPG'),
(339, 147, '1_1749856109684caf6d204bf.JPG', 'assets/uploads/projects/1_1749856109684caf6d204bf.JPG'),
(340, 147, 'IMG_2539_1749856109684caf6d20718.JPG', 'assets/uploads/projects/IMG_2539_1749856109684caf6d20718.JPG'),
(341, 147, 'IMG_2534_1749856109684caf6d2093d.JPG', 'assets/uploads/projects/IMG_2534_1749856109684caf6d2093d.JPG'),
(342, 147, 'IMG_2540_1749856109684caf6d20b5e.JPG', 'assets/uploads/projects/IMG_2540_1749856109684caf6d20b5e.JPG'),
(343, 147, 'IMG_2535_1749856109684caf6d20d53.JPG', 'assets/uploads/projects/IMG_2535_1749856109684caf6d20d53.JPG'),
(344, 147, 'IMG_2546_1749856109684caf6d20ec0.JPG', 'assets/uploads/projects/IMG_2546_1749856109684caf6d20ec0.JPG'),
(345, 147, 'IMG_2554_1749856109684caf6d21069.JPG', 'assets/uploads/projects/IMG_2554_1749856109684caf6d21069.JPG'),
(346, 147, 'IMG_2555_1749856109684caf6d212cf.JPG', 'assets/uploads/projects/IMG_2555_1749856109684caf6d212cf.JPG'),
(347, 147, 'IMG_2553_1749856109684caf6d2149f.JPG', 'assets/uploads/projects/IMG_2553_1749856109684caf6d2149f.JPG'),
(348, 147, 'IMG_2547_1749856109684caf6d21658.JPG', 'assets/uploads/projects/IMG_2547_1749856109684caf6d21658.JPG'),
(349, 148, '52E39D44-FBB6-4129-8AA0-16E2B55FBD26_1749856613684cb16572b43.JPEG', 'assets/uploads/projects/52E39D44-FBB6-4129-8AA0-16E2B55FBD26_1749856613684cb16572b43.JPEG'),
(350, 148, '618CFBB1-2D40-44FA-8163-1832D0C65E6D_1749856613684cb16572f91.JPEG', 'assets/uploads/projects/618CFBB1-2D40-44FA-8163-1832D0C65E6D_1749856613684cb16572f91.JPEG'),
(351, 148, 'IMG_6144_1749856613684cb165730f4.JPEG', 'assets/uploads/projects/IMG_6144_1749856613684cb165730f4.JPEG'),
(352, 148, 'IMG_6145_1749856613684cb1657325c.JPEG', 'assets/uploads/projects/IMG_6145_1749856613684cb1657325c.JPEG'),
(353, 148, 'IMG_6141_1749856613684cb1657361a.JPEG', 'assets/uploads/projects/IMG_6141_1749856613684cb1657361a.JPEG'),
(354, 148, 'IMG_6143 (1)_1749856613684cb1657384a.JPEG', 'assets/uploads/projects/IMG_6143 (1)_1749856613684cb1657384a.JPEG'),
(355, 149, 'IMG_2454_1749857367684cb45723079.JPG', 'assets/uploads/projects/IMG_2454_1749857367684cb45723079.JPG'),
(356, 149, 'IMG_2453_1749857367684cb4572334b.JPG', 'assets/uploads/projects/IMG_2453_1749857367684cb4572334b.JPG'),
(357, 149, 'IMG_2446_1749857367684cb4572361d.JPG', 'assets/uploads/projects/IMG_2446_1749857367684cb4572361d.JPG'),
(358, 149, 'IMG_2448_1749857367684cb457238a2.JPG', 'assets/uploads/projects/IMG_2448_1749857367684cb457238a2.JPG'),
(359, 149, 'IMG_2447_1749857367684cb45723add.JPG', 'assets/uploads/projects/IMG_2447_1749857367684cb45723add.JPG'),
(360, 149, 'IMG_2445_1749857367684cb45723d0c.JPG', 'assets/uploads/projects/IMG_2445_1749857367684cb45723d0c.JPG'),
(361, 149, 'IMG_2440_1749857367684cb45723f19.JPG', 'assets/uploads/projects/IMG_2440_1749857367684cb45723f19.JPG'),
(362, 149, 'IMG_2450_1749857367684cb45724102.JPG', 'assets/uploads/projects/IMG_2450_1749857367684cb45724102.JPG'),
(363, 149, 'IMG_2436_1749857367684cb457242ee.JPG', 'assets/uploads/projects/IMG_2436_1749857367684cb457242ee.JPG'),
(364, 149, 'IMG_2444_1749857367684cb45724745.JPG', 'assets/uploads/projects/IMG_2444_1749857367684cb45724745.JPG'),
(365, 149, 'IMG_2451_1749857367684cb457299f5.JPG', 'assets/uploads/projects/IMG_2451_1749857367684cb457299f5.JPG'),
(366, 149, 'IMG_2435_1749857367684cb45729e1a.JPG', 'assets/uploads/projects/IMG_2435_1749857367684cb45729e1a.JPG'),
(367, 149, 'IMG_2449_1749857367684cb4572a09c.JPG', 'assets/uploads/projects/IMG_2449_1749857367684cb4572a09c.JPG'),
(368, 149, 'IMG_2438_1749857367684cb4572a2d0.JPG', 'assets/uploads/projects/IMG_2438_1749857367684cb4572a2d0.JPG'),
(369, 149, 'IMG_2437_1749857367684cb4572a461.JPG', 'assets/uploads/projects/IMG_2437_1749857367684cb4572a461.JPG'),
(370, 149, 'IMG_2439_1749857367684cb4572a671.JPG', 'assets/uploads/projects/IMG_2439_1749857367684cb4572a671.JPG'),
(371, 149, 'IMG_2441_1749857367684cb4572d6c2.JPG', 'assets/uploads/projects/IMG_2441_1749857367684cb4572d6c2.JPG'),
(372, 149, 'IMG_2442_1749857367684cb4572d964.JPG', 'assets/uploads/projects/IMG_2442_1749857367684cb4572d964.JPG'),
(373, 150, 'IMG_8805_1749857767684cb5e79e49e.JPEG', 'assets/uploads/projects/IMG_8805_1749857767684cb5e79e49e.JPEG'),
(374, 150, 'IMG_8889_1749857767684cb5e79e7cd.JPG', 'assets/uploads/projects/IMG_8889_1749857767684cb5e79e7cd.JPG'),
(375, 150, 'IMG_8878_1749857767684cb5e79ea3e.JPG', 'assets/uploads/projects/IMG_8878_1749857767684cb5e79ea3e.JPG'),
(376, 150, 'IMG_8886_1749857767684cb5e79ebda.JPG', 'assets/uploads/projects/IMG_8886_1749857767684cb5e79ebda.JPG'),
(377, 150, 'IMG_8879_1749857767684cb5e79edfd.JPG', 'assets/uploads/projects/IMG_8879_1749857767684cb5e79edfd.JPG'),
(378, 150, 'IMG_8887_1749857767684cb5e79ef85.JPG', 'assets/uploads/projects/IMG_8887_1749857767684cb5e79ef85.JPG'),
(379, 150, 'IMG_8885_1749857767684cb5e79f0e5.JPG', 'assets/uploads/projects/IMG_8885_1749857767684cb5e79f0e5.JPG'),
(380, 150, 'IMG_8890_1749857767684cb5e79f290.JPG', 'assets/uploads/projects/IMG_8890_1749857767684cb5e79f290.JPG'),
(381, 150, 'IMG_8880_1749857767684cb5e79f454.JPG', 'assets/uploads/projects/IMG_8880_1749857767684cb5e79f454.JPG'),
(382, 150, 'IMG_8888_1749857767684cb5e79f67a.JPG', 'assets/uploads/projects/IMG_8888_1749857767684cb5e79f67a.JPG'),
(383, 151, 'IMG_2503_1749858216684cb7a83d2e6.JPEG', 'assets/uploads/projects/IMG_2503_1749858216684cb7a83d2e6.JPEG'),
(384, 151, 'IMG_2481_1749858216684cb7a83d69d.JPG', 'assets/uploads/projects/IMG_2481_1749858216684cb7a83d69d.JPG'),
(385, 151, 'IMG_2477_1749858216684cb7a83d8f9.JPG', 'assets/uploads/projects/IMG_2477_1749858216684cb7a83d8f9.JPG'),
(386, 151, 'IMG_2478_1749858216684cb7a83dc80.JPG', 'assets/uploads/projects/IMG_2478_1749858216684cb7a83dc80.JPG'),
(387, 151, 'IMG_2476_1749858216684cb7a83dec7.JPG', 'assets/uploads/projects/IMG_2476_1749858216684cb7a83dec7.JPG'),
(388, 151, 'IMG_2500_1749858216684cb7a83e0d5.JPG', 'assets/uploads/projects/IMG_2500_1749858216684cb7a83e0d5.JPG'),
(389, 151, 'IMG_2494_1749858216684cb7a83e259.JPG', 'assets/uploads/projects/IMG_2494_1749858216684cb7a83e259.JPG'),
(390, 151, 'IMG_2493_1749858216684cb7a83e399.JPG', 'assets/uploads/projects/IMG_2493_1749858216684cb7a83e399.JPG'),
(391, 151, 'IMG_2508_1749858216684cb7a83e64c.JPG', 'assets/uploads/projects/IMG_2508_1749858216684cb7a83e64c.JPG'),
(392, 151, 'IMG_2511_1749858216684cb7a844de0.JPG', 'assets/uploads/projects/IMG_2511_1749858216684cb7a844de0.JPG'),
(393, 151, 'IMG_2510_1749858216684cb7a845045.JPG', 'assets/uploads/projects/IMG_2510_1749858216684cb7a845045.JPG'),
(394, 152, 'IMG_2388_1749858676684cb97446707.JPG', 'assets/uploads/projects/IMG_2388_1749858676684cb97446707.JPG'),
(395, 152, 'IMG_2384_1749858676684cb97446b84.JPG', 'assets/uploads/projects/IMG_2384_1749858676684cb97446b84.JPG'),
(396, 152, 'IMG_2378_1749858676684cb97446ecb.JPG', 'assets/uploads/projects/IMG_2378_1749858676684cb97446ecb.JPG'),
(397, 152, 'IMG_2375_1749858676684cb974471bb.JPG', 'assets/uploads/projects/IMG_2375_1749858676684cb974471bb.JPG'),
(398, 152, 'IMG_2374_1749858676684cb974473be.JPG', 'assets/uploads/projects/IMG_2374_1749858676684cb974473be.JPG'),
(399, 152, 'IMG_2377_1749858676684cb9744758a.JPG', 'assets/uploads/projects/IMG_2377_1749858676684cb9744758a.JPG'),
(400, 152, 'IMG_2383_1749858676684cb97447784.JPG', 'assets/uploads/projects/IMG_2383_1749858676684cb97447784.JPG'),
(401, 152, 'IMG_2376_1749858676684cb97447987.JPG', 'assets/uploads/projects/IMG_2376_1749858676684cb97447987.JPG'),
(402, 152, 'IMG_2381_1749858676684cb97447b0e.JPG', 'assets/uploads/projects/IMG_2381_1749858676684cb97447b0e.JPG'),
(403, 152, 'IMG_2380_1749858676684cb97447cf3.JPG', 'assets/uploads/projects/IMG_2380_1749858676684cb97447cf3.JPG'),
(404, 152, 'IMG_2371_1749858676684cb97447ecb.JPG', 'assets/uploads/projects/IMG_2371_1749858676684cb97447ecb.JPG'),
(405, 152, 'IMG_2372_1749858676684cb97448069.JPG', 'assets/uploads/projects/IMG_2372_1749858676684cb97448069.JPG'),
(406, 152, 'IMG_2382_1749858676684cb97448258.JPG', 'assets/uploads/projects/IMG_2382_1749858676684cb97448258.JPG'),
(407, 152, 'IMG_2379_1749858676684cb97448456.JPG', 'assets/uploads/projects/IMG_2379_1749858676684cb97448456.JPG'),
(408, 152, 'IMG_2370_1749858676684cb97448623.JPG', 'assets/uploads/projects/IMG_2370_1749858676684cb97448623.JPG'),
(409, 152, 'IMG_2387_1749858676684cb97448895.JPG', 'assets/uploads/projects/IMG_2387_1749858676684cb97448895.JPG'),
(410, 152, 'IMG_2386_1749858676684cb97448bb1.JPG', 'assets/uploads/projects/IMG_2386_1749858676684cb97448bb1.JPG'),
(411, 152, 'IMG_2385_1749858676684cb97448d82.JPG', 'assets/uploads/projects/IMG_2385_1749858676684cb97448d82.JPG'),
(412, 152, 'IMG_2392_1749858676684cb97448f50.JPG', 'assets/uploads/projects/IMG_2392_1749858676684cb97448f50.JPG'),
(413, 153, 'Screenshot 2025-06-11 000952_1749859534684cbcce8eac7.png', 'assets/uploads/projects/Screenshot 2025-06-11 000952_1749859534684cbcce8eac7.png'),
(414, 153, 'IMG_0196_1749859534684cbcce8f268.JPEG', 'assets/uploads/projects/IMG_0196_1749859534684cbcce8f268.JPEG'),
(415, 153, 'IMG_0198_1749859534684cbcce8f899.JPEG', 'assets/uploads/projects/IMG_0198_1749859534684cbcce8f899.JPEG'),
(416, 153, 'IMG_0197_1749859534684cbcce8fb04.JPEG', 'assets/uploads/projects/IMG_0197_1749859534684cbcce8fb04.JPEG'),
(417, 153, 'IMG_2520_1749859534684cbcce8fe3f.JPG', 'assets/uploads/projects/IMG_2520_1749859534684cbcce8fe3f.JPG'),
(418, 153, 'IMG_2523_1749859534684cbcce90086.JPG', 'assets/uploads/projects/IMG_2523_1749859534684cbcce90086.JPG'),
(419, 153, 'IMG_2525_1749859534684cbcce9023e.JPG', 'assets/uploads/projects/IMG_2525_1749859534684cbcce9023e.JPG'),
(420, 153, 'IMG_2521_1749859534684cbcce904a6.JPG', 'assets/uploads/projects/IMG_2521_1749859534684cbcce904a6.JPG'),
(421, 153, 'IMG_2524_1749859534684cbcce906a9.JPG', 'assets/uploads/projects/IMG_2524_1749859534684cbcce906a9.JPG'),
(422, 153, 'IMG_2522_1749859534684cbcce908cf.JPG', 'assets/uploads/projects/IMG_2522_1749859534684cbcce908cf.JPG'),
(423, 153, 'IMG_3006_1749859534684cbcce90b09.JPG', 'assets/uploads/projects/IMG_3006_1749859534684cbcce90b09.JPG'),
(424, 153, 'IMG_3004_1749859534684cbcce90d71.JPG', 'assets/uploads/projects/IMG_3004_1749859534684cbcce90d71.JPG'),
(425, 153, 'IMG_3003_1749859534684cbcce91009.JPG', 'assets/uploads/projects/IMG_3003_1749859534684cbcce91009.JPG'),
(426, 153, 'IMG_3005_1749859534684cbcce912b4.JPG', 'assets/uploads/projects/IMG_3005_1749859534684cbcce912b4.JPG'),
(427, 153, 'IMG_3007_1749859534684cbcce93ef6.JPG', 'assets/uploads/projects/IMG_3007_1749859534684cbcce93ef6.JPG'),
(428, 153, 'Screenshot 2025-06-11 001107_1749859534684cbcce94135.png', 'assets/uploads/projects/Screenshot 2025-06-11 001107_1749859534684cbcce94135.png'),
(429, 153, 'IMG_3009_1749859534684cbcce943bc.JPG', 'assets/uploads/projects/IMG_3009_1749859534684cbcce943bc.JPG'),
(430, 153, 'IMG_3010_1749859534684cbcce94647.JPG', 'assets/uploads/projects/IMG_3010_1749859534684cbcce94647.JPG'),
(431, 153, 'IMG_3008_1749859534684cbcce948dc.JPG', 'assets/uploads/projects/IMG_3008_1749859534684cbcce948dc.JPG'),
(432, 154, 'IMG_2030_1749860119684cbf1730e2e.JPG', 'assets/uploads/projects/IMG_2030_1749860119684cbf1730e2e.JPG'),
(433, 154, 'IMG_2028_1749860119684cbf1731437.JPEG', 'assets/uploads/projects/IMG_2028_1749860119684cbf1731437.JPEG'),
(434, 154, 'IMG_2016_1749860119684cbf1731872.JPG', 'assets/uploads/projects/IMG_2016_1749860119684cbf1731872.JPG'),
(435, 154, 'IMG_2027_1749860119684cbf1731ba0.JPG', 'assets/uploads/projects/IMG_2027_1749860119684cbf1731ba0.JPG'),
(436, 154, 'IMG_2025_1749860119684cbf1731f15.JPG', 'assets/uploads/projects/IMG_2025_1749860119684cbf1731f15.JPG'),
(437, 154, 'IMG_2017_1749860119684cbf1732274.JPG', 'assets/uploads/projects/IMG_2017_1749860119684cbf1732274.JPG'),
(438, 154, 'IMG_2033_1749860119684cbf17324c9.JPG', 'assets/uploads/projects/IMG_2033_1749860119684cbf17324c9.JPG'),
(439, 154, 'IMG_2026_1749860119684cbf1732731.JPG', 'assets/uploads/projects/IMG_2026_1749860119684cbf1732731.JPG'),
(440, 154, 'IMG_2014_1749860119684cbf1732a6f.JPG', 'assets/uploads/projects/IMG_2014_1749860119684cbf1732a6f.JPG'),
(441, 154, 'IMG_2013_1749860119684cbf1732d79.JPG', 'assets/uploads/projects/IMG_2013_1749860119684cbf1732d79.JPG'),
(442, 154, 'IMG_2015_1749860119684cbf173306c.JPG', 'assets/uploads/projects/IMG_2015_1749860119684cbf173306c.JPG'),
(443, 154, 'IMG_2021_1749860119684cbf1733448.JPG', 'assets/uploads/projects/IMG_2021_1749860119684cbf1733448.JPG'),
(444, 154, 'IMG_2020_1749860119684cbf17336d5.JPG', 'assets/uploads/projects/IMG_2020_1749860119684cbf17336d5.JPG'),
(445, 154, 'IMG_2032_1749860119684cbf173392b.JPG', 'assets/uploads/projects/IMG_2032_1749860119684cbf173392b.JPG'),
(446, 154, 'IMG_2018_1749860119684cbf1733ac1.JPG', 'assets/uploads/projects/IMG_2018_1749860119684cbf1733ac1.JPG');

-- --------------------------------------------------------

--
-- Struttura della tabella `progetti`
--

CREATE TABLE `progetti` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `descrizione_breve` varchar(255) NOT NULL,
  `descrizione_completa` text NOT NULL,
  `data_creazione` timestamp NOT NULL DEFAULT current_timestamp(),
  `stato` tinyint(1) DEFAULT 1,
  `titolo_footer` varchar(21) NOT NULL,
  `descrizione_link_1` varchar(21) DEFAULT NULL,
  `link_1` text DEFAULT NULL,
  `descrizione_link_2` varchar(21) DEFAULT NULL,
  `link_2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `progetti`
--

INSERT INTO `progetti` (`id`, `titolo`, `descrizione_breve`, `descrizione_completa`, `data_creazione`, `stato`, `titolo_footer`, `descrizione_link_1`, `link_1`, `descrizione_link_2`, `link_2`) VALUES
(142, 'Pannello bottoni simulatore', 'Pannello con bottoni programmabili per simulatore MSFS con arduino', 'Il progetto “Pannello bottoni simulatore” è un\'interfaccia fisica realizzata artigianalmente per migliorare l’esperienza di volo nel simulatore Microsoft Flight Simulator (MSFS). È stato progettato per offrire al pilota virtuale un controllo tattile e intuitivo di numerose funzioni, eliminando la necessità di utilizzare mouse e tastiera durante il volo.\r\n\r\nIl pannello include una serie di bottoni meccanici ON-OFF-ON, interruttori a levetta e pulsanti retroilluminati, tutti programmabili tramite scheda Arduino Uno. Ogni pulsante è stato mappato tramite software mobiflight per inviare comandi precisi a MSFS, come luci di navigazione, carrello d’atterraggio, autopilota, flaps, accensione motori e molto altro. L\'interfaccia tra Arduino e il simulatore è realizzata tramite software come Mobiflight o una combinazione di FSUIPC e script personalizzati.\r\n\r\nIl design è compatto ma modulare, con un pannello frontale in plexiglass inciso a laser e un case robusto in MDF verniciato. L’assemblaggio è completamente fatto a mano, comprese le saldature e la disposizione dei cablaggi interni. L’obiettivo è offrire un’esperienza immersiva e realistica, particolarmente utile per chi vola su network online come VATSIM.', '2025-06-13 20:59:50', 1, 'Pannello simulatore', NULL, NULL, NULL, NULL),
(144, 'Cablaggio ethernet Casa', 'Cablaggio ethernet 5 linee con prese ethernet presso il mio domicilio', 'Il progetto “Cablaggio strutturato ethernet” riguarda l’installazione di una rete LAN cablata con 5 linee Ethernet su cavo Cat 5e, distribuite strategicamente all’interno del mio domicilio per garantire una connessione stabile, veloce e sicura a tutti i dispositivi di rete. Ogni linea è stata realizzata manualmente utilizzando una pinza crimpatrice professionale, seguendo lo standard T568B per l’ordinamento corretto dei conduttori. Dopo aver preparato e crimpato ogni connettore RJ45, ho verificato il corretto funzionamento con un tester per cavi Ethernet, controllando la continuità elettrica, l’ordine dei pin e l’assenza di corti o interruzioni.\r\n\r\nQuesto cablaggio è stato progettato per supportare pienamente l’infrastruttura di smart home presente nell’abitazione: router, switch, hub domotici e dispositivi connessi sono collegati tramite rete LAN per ottenere la massima affidabilità e velocità, senza dipendere esclusivamente dal Wi-Fi. L’interconnessione cablata tra i vari punti della casa consente una distribuzione uniforme della connessione, riducendo latenza e interferenze, particolarmente utile per streaming, domotica, gaming e telelavoro.\r\n\r\nLa scelta del cablaggio Cat 5e garantisce compatibilità fino a 1 Gbps, ideale per un ambiente domestico moderno in cui la rete locale è il cuore della comunicazione tra dispositivi intelligenti e servizi online.', '2025-06-13 21:26:05', 1, 'Cablaggio ethernet  ', NULL, NULL, NULL, NULL),
(147, 'Smart home CASA', 'Installazione relè smart sonoff con dashboard ewe link cast', 'Il progetto “Smart home CASA” ha previsto l’installazione e la configurazione di un sistema domotico basato su dispositivi Sonoff. Ho installato 5 relè smart Sonoff Mini R4 nei principali punti luce dell’abitazione, alloggiati direttamente dietro gli interruttori tradizionali. Ogni relè è stato collegato alla rete Wi-Fi domestica a 2,4 GHz, garantendo così il controllo remoto delle luci tramite smartphone, tablet o comandi vocali compatibili con Alexa e Google Assistant. La configurazione mantiene sempre attivo il controllo manuale tramite pulsanti fisici, anche in caso di perdita della connessione.\r\n\r\nParallelamente ho predisposto l’impianto per l’installazione futura di un termostato smart per la gestione della caldaia. I cavi di comando sono stati posizionati in modo da permettere l’integrazione semplice e veloce di un termostato compatibile con sistemi Wi-Fi e app di controllo remoto, aumentando l’efficienza energetica dell’abitazione.\r\n\r\nPer la gestione centralizzata dell’intero sistema ho configurato la dashboard eWeLink Cast, installata su un tablet fisso in un punto strategico della casa. La dashboard offre un’interfaccia chiara e intuitiva da cui posso controllare in tempo reale luci, dispositivi connessi e scene personalizzate. Questo progetto rende la casa più smart, efficiente e facilmente gestibile, migliorando comfort, automazione e controllo anche a distanza.', '2025-06-13 23:08:29', 1, 'Smart home', 'Link sonoff amazon', 'https://www.amazon.it/Interruttore-intelligente-staccabile-controllo-Assistant/dp/B0C5R8JWJZ/ref=sr_1_1_sspa?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=2RCHKD03AL6I4&dib=eyJ2IjoiMSJ9.QJGY0Hp1Q3M3YX-h6am4z7QKaYYH8GhWAz9b_ddWK6ddty7eRAZrEASzXtG7z7p8hGpKOlWtX9mU9M8Jc2F0goYD-2WuhAfDpi9zYJNUPHAF5m7agbph-JU1GIzDRcfBJ0Hht6jPs_5ahx0RAZ7qnehCUr45ZE8LgXj2DzVSLAs5Lq2-iRvbdfAKPx_c_oJFUpDf92c56CWUgMhWgMjMGNoLIMiFs_PXZF4EbdkNUJ-ttzlnkOXnZvEewmQwY_XLK_yFyvuSy2hh-6eNexS8-936dgBxhQTGkXrqOpntggI.7XS21_Hmf1n1aqRBsyjUqtKTO9NJ5S8bllhzl-GyOhE&dib_tag=se&keywords=sonoff%2Bmini&qid=1749856052&sprefix=sonoff%2Bmini%2B%2Caps%2C115&sr=8-1-spons&sp_csd=d2lkZ2V0TmFtZT1zcF9hdGY&th=1', '', ''),
(148, 'Magic box', 'Scatola di derivazione con due relè smart con uscita 12 v', 'La “Magic box” è una scatola di derivazione compatta che contiene un unico modulo con due relè smart integrati. Questo modulo, una volta alimentato e connesso alla rete Wi-Fi a 2,4 GHz, permette di controllare da remoto due canali separati. All’accensione, la Magic box fornisce in uscita una tensione di 12V, ideale per alimentare le strisce LED installate nella mia cucina.\r\n\r\nHo scelto questo sistema per avere un controllo intelligente e flessibile dell’illuminazione, potendo accendere, spegnere o programmare le luci tramite app mobile o assistenti vocali come Alexa e Google Assistant. Il modulo integrato semplifica il cablaggio all’interno della scatola, riducendo gli ingombri e aumentando l’affidabilità del sistema.\r\n\r\nLa scatola è stata montata con cura, proteggendo tutti i collegamenti elettrici per garantire sicurezza e durata nel tempo. Il sistema è ideale per chi vuole integrare facilmente l’automazione smart nelle proprie installazioni a bassa tensione, con la comodità di una gestione centralizzata e remota.', '2025-06-13 23:16:53', 1, 'Magic box', 'Link amazon ', 'https://www.amazon.it/QIACHIP-Interruttore-Intelligente-momentary-Compatibile/dp/B0CP5WJFD5/ref=sr_1_9?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=227R78573AR9A&dib=eyJ2IjoiMSJ9.UdhSKSqlCER_b3HjHcE3UVtji5RoYekhLxcIRl6IgdPvKT7VeA9qrlqDaQJ6TkFUV3GJyNAl1WgJXkj1ySlTz2GZ3nz3V0DLS6bQcAa0_TWuql6Yrd8p0qiYALUCOF2IEGtMgmVKLLVAuxupMVS2XYWnh3H4rZ3dwtXodNAJxLY6rHtuFaAUJioRJUXhUcT0LmszwdY_HgrzddMamQXHhGYTUraqMYOji3d8WuWewmfh0ZO1O1da-Cv8HmCrvX2ev3gjyeMhxsy5ppIDd9pWxUtgAkfauSsjkOkRVMOSBvg.npxHPdyNY0wTySBtheZFMcITRkKLiK6HkU-M-6Vk_nk&dib_tag=se&keywords=due%2Brele%2Bscheda%2Bsonoff&qid=1749856510&sprefix=due%2Brele%2Bsceda%2Bsonoff%2Caps%2C110&sr=8-9&th=1', '', ''),
(149, 'Gaming pc Custom 1500 euro', 'build pc fascia alta da gaming -i5 14th -5070 -z790 -32gb ddr5 ', 'Il progetto “Gaming PC Custom 1500 euro” è una build ad alte prestazioni pensata per garantire un’esperienza fluida e reattiva nei videogiochi più recenti e nelle attività multitasking intensive. Il cuore del sistema è un processore Intel Core i5 di 14ª generazione, abbinato a una scheda madre con chipset Z790, che garantisce massima compatibilità e possibilità di overclock.\r\n\r\nIl comparto grafico è affidato a una potente scheda video NVIDIA RTX 5070, in grado di gestire senza sforzi gaming in 1440p e 4K, ray tracing e applicazioni di rendering. La memoria RAM da 32 GB DDR5 assicura una velocità elevatissima e grande reattività, anche con più programmi aperti contemporaneamente. L’archiviazione è gestita da un SSD NVMe Gen4, che offre tempi di avvio e caricamento praticamente istantanei.\r\n\r\nIl tutto è alloggiato in un case ben ventilato, con gestione ordinata dei cavi, LED RGB personalizzabili e un sistema di raffreddamento ottimizzato per mantenere basse le temperature anche sotto stress. L’alimentatore certificato 80 Plus Gold garantisce stabilità e protezione dell’hardware.\r\n\r\nQuesta configurazione è ideale per il gaming competitivo, lo streaming, l’editing video e altre applicazioni professionali. Un investimento bilanciato per ottenere il massimo delle prestazioni a un budget contenuto.', '2025-06-13 23:29:27', 1, 'Gaming pc Custom', 'Lista prodotti AMZ', 'https://www.amazon.it/hz/wishlist/ls/3RCIYX38J52DK?ref_=wl_share', '', ''),
(150, 'Riparazione iPhone 7 64gb', 'Sostituzione batteria esausta iPhone 7', 'In questo progetto mi sono occupato della riparazione e rivendita di un iPhone 7 da 64GB, acquistato in condizioni non funzionanti al prezzo di 20 euro. Il dispositivo presentava una batteria esausta e segni di trascuratezza generale, ma nessun danno alla scheda madre o al display. Dopo una prima ispezione, ho proceduto con una pulizia completa interna ed esterna, rimuovendo polvere, residui di sporco e vecchi adesivi.\r\n\r\nHo poi smontato il dispositivo utilizzando strumenti professionali per sollevare il display senza danneggiare i connettori del Touch ID e della fotocamera. Ho sostituito la batteria con una nuova compatibile di alta qualità, applicando adesivi originali per fissarla correttamente, come da standard Apple. Durante la fase di riassemblaggio, ho controllato la tenuta del display, la funzionalità del tasto home, del Wi-Fi e della ricarica.\r\n\r\nDopo vari test di funzionamento, ho verificato che il telefono funzionasse perfettamente in ogni sua parte. A quel punto, l’ho messo in vendita e rivenduto per 100 euro. Considerando il costo del dispositivo (20 euro), della batteria (circa 15 euro) e piccoli materiali di consumo, ho ottenuto un profitto netto di circa 65 euro.\r\n\r\nQuesto progetto dimostra competenze tecniche nella diagnostica, riparazione, cura estetica e gestione della compravendita di dispositivi elettronici.', '2025-06-13 23:36:07', 1, 'Riparazione iPhone 7', 'Batteria compatibile', 'https://www.ebay.it/itm/283477584594?_skw=batteria+iphone+7&itmmeta=01JXNT8ZW8NX7Y9SBYR2JECNX5&hash=item420094aad2:g:xkcAAOSwisNlZbIg&itmprp=enc%3AAQAKAAAA0FkggFvd1GGDu0w3yXCmi1eWVc5pPUp1CvNAFPp5DQKJQ6fAlkg%2Fj9OodDCObsvNPeB0ZKRaGJzZgYpI3pGiBN%2FYBZeF1d271mVuNABQ%2BEGIiY0nRZcGJVQ8T%2BY9j2LI%2FXCI3OYZxANEY%2BJ8euLdExXgQYcujp6MOaAg0v8FKpoUo2pX59rI0BQ5ZslvT8TPDAUKvnaHfaYqA%2BPa1EHb9h%2FZKSIcFbRAisvRhVgvmu0lkZ9iuNpT9zS0krr8WlbbJD9eL7oc5fcbXkuvB0NRZak%3D%7Ctkp%3ABk9SR7D-o7rtZQ', '', ''),
(151, 'SFIM roma 2025 ', 'Starting Finance Investment Meeting Roma evento a tema finanza', 'Ho partecipato allo SFIM Roma 2025 (Starting Finance Investment Meeting), uno degli eventi più importanti in Italia dedicati alla finanza personale e agli investimenti. L’evento si è svolto il 9 maggio 2025 al Palazzo dei Congressi dell’EUR, con oltre 3.000 partecipanti tra studenti, giovani investitori, esperti del settore e aziende.\r\n\r\nPer me è stata un’occasione preziosa per confrontarmi con professionisti e approfondire tematiche legate a ETF, obbligazioni, azioni, mercati globali, criptovalute e startup. Ho seguito con interesse vari panel e conferenze, tra cui quelli con Carlo Cottarelli, Francesco Gattei, e anche con i noti giornalisti Giuseppe Cruciani e David Parenzo, che hanno portato un punto di vista critico e stimolante sulle dinamiche economiche e sociali attuali.\r\n\r\nHo partecipato a sessioni interattive, facendo domande agli speaker e confrontandomi con altri giovani appassionati di finanza. Ho apprezzato gli stand tematici di aziende come Enel, WindTre e Poste Italiane, dove si potevano scoprire strumenti concreti per investire e risparmiare consapevolmente.\r\n\r\nL’esperienza mi ha arricchito tecnicamente e motivazionalmente, rafforzando il mio impegno come investitore retail e alimentando la mia voglia di crescere in questo ambito.', '2025-06-13 23:43:36', 0, 'SFIM roma 2025 ', 'SFIM', 'https://home.startingfinance.com/starting-finance-investment-meeting-roma-2025', 'Binance', 'https://www.binance.com/it'),
(152, 'Stazione meteo wifi DIY', 'Stazione meteo assemblata con saldatura DIY con modulo esp32 wifi', 'Ho realizzato una stazione meteo fai-da-te (DIY) basata su un modulo ESP32 con connettività WiFi integrata. Il progetto ha previsto l’assemblaggio e la saldatura manuale dei componenti elettronici su una basetta, inclusi sensori di temperatura, umidità, pressione atmosferica e qualità dell’aria.\r\n\r\nIl modulo ESP32 consente di inviare i dati raccolti in tempo reale a una dashboard online, accessibile da qualsiasi dispositivo connesso a internet. Ho programmato il microcontrollore tramite Arduino IDE, configurando la connessione WiFi e la trasmissione dei dati tramite protocollo MQTT verso un server locale.\r\n\r\nL’intero sistema è alimentato da una batteria ricaricabile con pannello solare opzionale per autonomia prolungata. La stazione è stata progettata per essere compatta, efficiente e facilmente espandibile con sensori aggiuntivi in futuro.\r\n\r\nQuesto progetto mi ha permesso di approfondire la saldatura di componenti SMD, la programmazione dell’ESP32 e la gestione di dati IoT in cloud, con un’applicazione pratica per il monitoraggio ambientale domestico.', '2025-06-13 23:51:16', 1, 'Stazione meteo DIY', 'Esp32', 'https://it.aliexpress.com/item/1005006456519790.html?spm=a2g0o.productlist.main.1.47ff7krV7krVnN&aem_p4p_detail=202506131649428056719445259020001851914&algo_pvid=6c4df02c-322a-45dc-960e-c6f891eec064&algo_exp_id=6c4df02c-322a-45dc-960e-c6f891eec064-0&pdp_ext_f=%7B%22order%22%3A%2211113%22%2C%22eval%22%3A%221%22%7D&pdp_npi=4%40dis%21EUR%2113.80%213.98%21%21%21111.67%2132.20%21%4021038e1e17498585829133976efa14%2112000037265317361%21sea%21IT%210%21ABX&curPageLogUid=OjYDjM68J8uw&utparam-url=scene%3Asearch%7Cquery_from%3A&search_p4p_id=202506131649428056719445259020001851914_1', 'Oled display 0.96', 'https://it.aliexpress.com/item/1005006456519790.html?spm=a2g0o.productlist.main.1.47ff7krV7krVnN&aem_p4p_detail=202506131649428056719445259020001851914&algo_pvid=6c4df02c-322a-45dc-960e-c6f891eec064&algo_exp_id=6c4df02c-322a-45dc-960e-c6f891eec064-0&pdp_ext_f=%7B%22order%22%3A%2211113%22%2C%22eval%22%3A%221%22%7D&pdp_npi=4%40dis%21EUR%2113.80%213.98%21%21%21111.67%2132.20%21%4021038e1e17498585829133976efa14%2112000037265317361%21sea%21IT%210%21ABX&curPageLogUid=OjYDjM68J8uw&utparam-url=scene%3Asearch%7Cquery_from%3A&search_p4p_id=202506131649428056719445259020001851914_1'),
(153, 'Supporto iPhone magsafe DIY', 'Progettazione stampa e installazione supporto per iPhone', 'Il progetto consiste nella realizzazione di un supporto per iPhone compatibile con il sistema MagSafe, che ho trovato su internet e deciso di replicare e adattare alle mie esigenze personali. La scelta di questo modello è stata guidata dalla semplicità della struttura, dall’efficacia del sistema di aggancio magnetico e dalla possibilità di realizzarlo con la mia stampante 3D Bambu Lab A1, di cui conosco bene le potenzialità.\r\n\r\nPer la stampa ho utilizzato un materiale resistente e leggero, ideale per garantire stabilità e durabilità del supporto, anche in un ambiente dinamico come l’interno dell’auto. Dopo aver completato la stampa, ho eseguito una lavorazione manuale di finitura: con carta abrasiva a grana fine ho levigato la base del supporto, eliminando eventuali imperfezioni e creando una superficie liscia e uniforme. Questo passaggio è stato fondamentale per migliorare l’estetica del pezzo e, soprattutto, per aumentare l’aderenza del biadesivo che avrei utilizzato in seguito.\r\n\r\nIl fissaggio è stato effettuato con un nastro biadesivo 3M di alta qualità, noto per la sua forza adesiva e la capacità di resistere alle variazioni di temperatura e agli urti, condizioni tipiche all’interno dell’abitacolo di un’automobile. Ho scelto di applicare il supporto direttamente sulla scocca dell’auto, in una posizione strategica che consente un facile accesso e una buona visibilità dello schermo dell’iPhone durante la guida.', '2025-06-14 00:05:34', 1, 'Supporto iPhone DIY', 'Biadesivo specifico', 'https://www.amazon.it/dp/B0C9TGK79V?ref=ppx_yo2ov_dt_b_fed_asin_title', 'Bambu lab A1', 'https://eu.store.bambulab.com/it/products/a1?gad_source=1&gad_campaignid=20568636147&gbraid=0AAAAAqFjFZq4N3sfR5Jmif_aLYWzNEj4N&gclid=Cj0KCQjwmK_CBhCEARIsAMKwcD4g--cPvBgZ8gnRsgLLSljje1FKoxgBiNj7pPghdNT8vqRMK5k3-kAaAtTEEALw_wcB'),
(154, 'Taser 20KV DIY', 'Con modulo step-up 20KV con ricarica type-c integrata, batteria 3,6V', 'Il progetto \"Taser 20KV DIY\" consiste nella realizzazione di un dispositivo taser con una tensione di uscita di 20.000 volt, alimentato da una batteria Li-ion da 3,6V e dotato di un modulo step-up per aumentare la tensione. Tutti i componenti principali sono stati acquistati su AliExpress, con un costo totale dei materiali di circa 6 euro, rendendo il progetto economico e accessibile.\r\n\r\nLa batteria Li-ion garantisce una buona autonomia, mentre il modulo step-up converte la tensione della batteria ai 20KV necessari per il funzionamento del taser. La ricarica è stata resa pratica e moderna tramite una porta USB Type-C integrata nel circuito, che consente di ricaricare il dispositivo facilmente con un cavo standard.\r\n\r\nLa scocca del taser è stata progettata e stampata in 3D, adattata su misura per contenere tutti i componenti in modo compatto e sicuro. Per i contatti elettrici ho utilizzato dei chiodi piegati, scelti per la loro conducibilità e semplicità di modellazione all’interno del case stampato.\r\n\r\nQuesto progetto combina elettronica low cost, stampa 3D e soluzioni creative per realizzare un taser funzionante, dimostrando come con pochi euro e un po’ di manualità sia possibile costruire un dispositivo elettronico complesso e funzionale.', '2025-06-14 00:15:19', 1, 'Taser 20KV DIY', 'Progetto bambu lab', 'https://makerworld.com/it', '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `progetti_ruoli`
--

CREATE TABLE `progetti_ruoli` (
  `progetto_id` int(11) NOT NULL,
  `ruolo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `progetti_ruoli`
--

INSERT INTO `progetti_ruoli` (`progetto_id`, `ruolo_id`) VALUES
(142, 4),
(142, 5),
(144, 4),
(144, 5),
(147, 4),
(147, 5),
(148, 4),
(148, 5),
(149, 4),
(149, 5),
(149, 10),
(150, 4),
(150, 10),
(151, 4),
(152, 4),
(152, 5),
(154, 4),
(154, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `ruoli`
--

CREATE TABLE `ruoli` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ruoli`
--

INSERT INTO `ruoli` (`id`, `nome`, `descrizione`) VALUES
(0, 'owner', 'Il proprietario del Sito.'),
(1, 'admin', 'Il ruolo che permette l\'accesso completo al sito'),
(4, 'utente', 'Il ruolo di default per i nuovi utenti, non permette di accedere alle aree riservate'),
(5, 'guest', 'Utente non autenticato.'),
(10, 'about', 'Pagina about.');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `latest_login` datetime DEFAULT NULL,
  `data_creazione` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(200) DEFAULT NULL,
  `ruolo` int(11) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `name`, `surname`, `username`, `email`, `password`, `latest_login`, `data_creazione`, `avatar`, `ruolo`) VALUES
(4, 'Luigi', 'Tanzillo', 'admin', 'admin@admin.com', '123', '2025-06-13 22:17:51', '2025-06-01 00:43:29', NULL, 0),
(5, 'prova', 'prova', 'prova', 'pippo@icloud.com', '123', NULL, '2025-06-01 00:50:16', NULL, 4),
(6, 'asd', 'asd', 'asd', 'asd@gmail.com', '123', NULL, '2025-06-02 00:49:50', NULL, 4),
(7, 'Elena', 'Bianchi', 'EllyB_Wanderlust', 'ellyb.wanderlust@example.com', 'elena123', '2025-06-12 10:00:00', '2025-05-20 09:30:00', NULL, 4),
(8, 'Marco', 'Rossi', 'MarkoRocks', 'markorocks@example.com', 'marcoPswd', '2025-06-11 14:15:00', '2025-05-22 07:00:00', NULL, 4),
(9, 'Sofia', 'Verdi', 'Sofy_Star', 'sofystar@example.com', 'sofiaPass', '2025-06-10 09:30:00', '2025-05-24 14:00:00', NULL, 4),
(10, 'Luca', 'Gialli', 'LucaTheGreat', 'lucagreat@example.com', 'luca_Pwd!', '2025-06-09 17:45:00', '2025-05-26 08:00:00', NULL, 4),
(11, 'Giulia', 'Neri', 'Giu_Dreamer', 'giu.dreamer@example.com', 'giulia@1', '2025-06-08 11:00:00', '2025-05-28 12:00:00', NULL, 4),
(12, 'Andrea', 'Bruno', 'AndyExplorer', 'andyexplorer@example.com', 'Andrea123', '2025-06-07 08:30:00', '2025-05-30 06:30:00', NULL, 4),
(13, 'Chiara', 'Rizzo', 'ChiaraSky', 'chiarasky@example.com', 'Chiara_P', '2025-06-06 16:00:00', '2025-06-01 10:00:00', NULL, 4),
(14, 'Francesco', 'Conti', 'Frankie_Code', 'frankiecode@example.com', 'frankie1', '2025-06-05 10:45:00', '2025-06-03 07:30:00', NULL, 4),
(15, 'Sara', 'Ferrari', 'SassySaraF', 'sassy.sara@example.com', 'saraP@ss', '2025-06-04 13:20:00', '2025-06-05 13:00:00', NULL, 4),
(16, 'Alessandro', 'Marini', 'Alex_The_Ace', 'alex.ace@example.com', 'AlexPwd!', '2025-06-03 09:00:00', '2025-06-07 07:00:00', NULL, 4),
(17, 'Martina', 'Ricci', 'Marti_Travels', 'marti.travels@example.com', 'martina99', NULL, '2025-05-18 08:00:00', NULL, 4),
(18, 'Giovanni', 'Lombardi', 'Gio_Innovate', 'gio.innovate@example.com', 'gioLomb', '2025-06-12 11:30:00', '2025-05-20 07:00:00', NULL, 4),
(19, 'Laura', 'Moretti', 'Lau_Writes', 'lau.writes@example.com', 'Laura#22', '2025-06-11 14:00:00', '2025-05-22 11:00:00', NULL, 4),
(20, 'Filippo', 'Rinaldi', 'Pippo_Games', 'pippo.games@example.com', 'FilippoP', NULL, '2025-05-24 08:30:00', NULL, 4),
(21, 'Alice', 'Bruno', 'WonderAlice', 'wonder.alice@example.com', 'Alice@12', '2025-06-09 16:00:00', '2025-05-27 09:00:00', NULL, 4),
(22, 'Matteo', 'Greco', 'Teo_Tech', 'teo.tech@example.com', 'Matteo_23', '2025-06-08 09:45:00', '2025-05-29 12:00:00', NULL, 4),
(23, 'Valentina', 'Caruso', 'ValeSunshine', 'vale.sunshine@example.com', 'Valentina!', '2025-06-07 12:00:00', '2025-05-28 10:00:00', NULL, 4),
(24, 'Gabriele', 'De Luca', 'Gabe_Art', 'gabe.art@example.com', 'Gabriel#', '2025-06-06 10:10:00', '2025-05-17 06:30:00', NULL, 4),
(25, 'Rebecca', 'Russo', 'Reb_Adventures', 'reb.adventures@example.com', 'RebPass', '2025-06-05 15:00:00', '2025-05-21 15:00:00', NULL, 4),
(26, 'Simone', 'Ferrari', 'Sim_Musica', 'sim.musica@example.com', 'SimonePwd', '2025-06-04 11:00:00', '2025-05-23 11:30:00', NULL, 4),
(27, 'Beatrice', 'Costa', 'Bea_Reads', 'bea.reads@example.com', 'Beatrice@', '2025-06-03 18:00:00', '2025-05-25 07:00:00', NULL, 4),
(28, 'Lorenzo', 'Galli', 'Lory_Sport', 'lory.sport@example.com', 'Lory#Pwd', NULL, '2025-05-27 08:00:00', NULL, 4),
(29, 'Federica', 'Romano', 'Fede_Glam', 'fede.glam@example.com', 'Fede_P@ss', '2025-06-02 09:00:00', '2025-05-29 09:00:00', NULL, 4),
(30, 'Riccardo', 'Colombo', 'Rick_Bytes', 'rick.bytes@example.com', 'Riccardo1', '2025-06-01 14:00:00', '2025-05-30 12:00:00', NULL, 4),
(31, 'Anna', 'Marino', 'Anna_Creative', 'anna.creative@example.com', 'Anna@Pwd', '2025-06-12 09:30:00', '2025-05-19 10:00:00', NULL, 4),
(32, 'Pietro', 'Giordano', 'Pete_Lens', 'pete.lens@example.com', 'PietroPwd', '2025-06-10 13:00:00', '2025-05-21 08:30:00', NULL, 4),
(33, 'Camilla', 'Russo', 'Cami_Cooks', 'cami.cooks@example.com', 'Camilla!', '2025-06-09 16:30:00', '2025-05-23 13:00:00', NULL, 4),
(34, 'Davide', 'Mancini', 'Dave_Adven', 'dave.adven@example.com', 'DavideP', '2025-06-08 11:00:00', '2025-05-26 10:00:00', NULL, 4),
(35, 'Greta', 'Serra', 'Greta_Artistry', 'greta.artistry@example.com', 'GretaPwd', '2025-06-07 10:00:00', '2025-05-29 08:00:00', NULL, 4),
(36, 'Nicola', 'De Santis', 'Nico_Connect', 'nico.connect@example.com', 'Nicola123', '2025-06-06 14:00:00', '2025-05-18 15:00:00', NULL, 4),
(37, 'Eleonora', 'Monti', 'Ely_Harmony', 'ely.harmony@example.com', 'Eleonora@', '2025-06-05 09:00:00', '2025-05-20 09:00:00', NULL, 4),
(38, 'Angelo', 'Gallo', 'Ange_Thinker', 'ange.thinker@example.com', 'AngeloPwd', '2025-06-04 12:30:00', '2025-05-22 12:00:00', NULL, 4),
(39, 'Alessia', 'Vitale', 'Lexi_Vibes', 'lexi.vibes@example.com', 'Alessia#', '2025-06-03 15:00:00', '2025-05-24 14:00:00', NULL, 4),
(40, 'Michele', 'Sorrentino', 'Mike_Explore', 'mike.explore@example.com', 'Michele!', '2025-06-02 10:00:00', '2025-05-27 07:00:00', NULL, 4),
(41, 'Francesca', 'Riva', 'Fran_Joy', 'fran.joy@example.com', 'FranPwd', '2025-06-01 11:00:00', '2025-05-29 11:00:00', NULL, 4),
(42, 'Tommaso', 'Ferri', 'Tommy_Techie', 'tommy.techie@example.com', 'TommyPass', '2025-05-31 14:30:00', '2025-05-31 08:00:00', NULL, 4),
(43, 'Silvia', 'Duzioni', 'Silvia_Bloom', 'silvia.bloom@example.com', 'Silvia#2', '2025-05-30 17:00:00', '2025-06-01 15:00:00', NULL, 4),
(44, 'Edoardo', 'Gentile', 'Edo_Genius', 'edo.genius@example.com', 'EdoardoP', '2025-05-29 08:30:00', '2025-05-29 06:30:00', NULL, 4),
(45, 'Ilaria', 'Barbieri', 'Ila_Wonders', 'ila.wonders@example.com', 'IlariaPwd', '2025-06-12 13:00:00', '2025-05-20 13:00:00', NULL, 4),
(46, 'Vincenzo', 'Santi', 'Vince_Codes', 'vince.codes@example.com', 'Vincenzo!', '2025-06-11 10:00:00', '2025-05-22 10:00:00', NULL, 4),
(47, 'Giada', 'Leone', 'Giada_Art', 'giada.art@example.com', 'GiadaP@ss', '2025-06-10 11:00:00', '2025-05-24 12:00:00', NULL, 4),
(48, 'Christian', 'Mariani', 'Chris_Beats', 'chris.beats@example.com', 'ChrisPwd', '2025-06-09 14:00:00', '2025-05-26 14:00:00', NULL, 4),
(49, 'Vanessa', 'Basile', 'Nessa_Glows', 'nessa.glows@example.com', 'Vanessa12', '2025-06-08 16:00:00', '2025-05-29 14:00:00', NULL, 4),
(50, 'Mattia', 'Bellini', 'Mattia_Plays', 'mattia.plays@example.com', 'Mattia@', '2025-06-07 09:00:00', '2025-05-17 09:00:00', NULL, 4),
(51, 'Giorgia', 'Ferrara', 'Gio_Dreams', 'gio.dreams@example.com', 'GiorgiaPwd', '2025-06-06 10:30:00', '2025-05-19 11:00:00', NULL, 4),
(52, 'Fabio', 'Rizzo', 'Fabio_Tech', 'fabio.tech@example.com', 'Fabio_P', '2025-06-05 13:00:00', '2025-05-21 13:00:00', NULL, 4),
(53, 'Sofia', 'Palmieri', 'Sofy_Crafts', 'sofy.crafts@example.com', 'SofiaPwd', '2025-06-04 16:00:00', '2025-05-23 07:00:00', NULL, 4),
(54, 'Manuel', 'Grassi', 'Manny_Sports', 'manny.sports@example.com', 'Manuel#1', NULL, '2025-05-25 08:00:00', NULL, 4),
(55, 'Angela', 'De Angelis', 'Ange_Shine', 'ange.shine@example.com', 'AngelaPwd', '2025-06-03 14:00:00', '2025-05-27 10:00:00', NULL, 4),
(56, 'Leonardo', 'Gallo', 'Leo_Sketch', 'leo.sketch@example.com', 'Leonardo!', '2025-06-02 10:00:00', '2025-05-29 07:00:00', NULL, 4);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `immagini_progetti`
--
ALTER TABLE `immagini_progetti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progetto_id` (`progetto_id`);

--
-- Indici per le tabelle `progetti`
--
ALTER TABLE `progetti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_titolo` (`titolo`);

--
-- Indici per le tabelle `progetti_ruoli`
--
ALTER TABLE `progetti_ruoli`
  ADD PRIMARY KEY (`progetto_id`,`ruolo_id`),
  ADD KEY `ruolo_id` (`ruolo_id`);

--
-- Indici per le tabelle `ruoli`
--
ALTER TABLE `ruoli`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_ruolo` (`ruolo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `immagini_progetti`
--
ALTER TABLE `immagini_progetti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- AUTO_INCREMENT per la tabella `progetti`
--
ALTER TABLE `progetti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT per la tabella `ruoli`
--
ALTER TABLE `ruoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `immagini_progetti`
--
ALTER TABLE `immagini_progetti`
  ADD CONSTRAINT `immagini_progetti_ibfk_1` FOREIGN KEY (`progetto_id`) REFERENCES `progetti` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `progetti_ruoli`
--
ALTER TABLE `progetti_ruoli`
  ADD CONSTRAINT `progetti_ruoli_ibfk_1` FOREIGN KEY (`progetto_id`) REFERENCES `progetti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progetti_ruoli_ibfk_2` FOREIGN KEY (`ruolo_id`) REFERENCES `ruoli` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `FK_ruolo` FOREIGN KEY (`ruolo`) REFERENCES `ruoli` (`id`);


--
-- Metadati
--
USE `phpmyadmin`;

--
-- Metadati per tabella immagini_progetti
--

--
-- Metadati per tabella progetti
--

--
-- Metadati per tabella progetti_ruoli
--

--
-- Metadati per tabella ruoli
--

--
-- Metadati per tabella utenti
--

--
-- Dump dei dati per la tabella `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'luigi_tanzillo', 'utenti', '{\"sorted_col\":\"`latest_login` DESC\"}', '2025-06-13 20:53:01');

--
-- Metadati per database luigi_tanzillo
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
