-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 06:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fullstack`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nrp_mahasiswa` char(9) DEFAULT NULL,
  `npk_dosen` char(6) DEFAULT NULL,
  `isadmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`username`, `password`, `nrp_mahasiswa`, `npk_dosen`, `isadmin`) VALUES
('200101', '$2y$10$GmyWCRD19pUCK73OZSobCuqnsMGBIAB/By2K2fxhlOriM1WDG0YHC', NULL, '200101', 0),
('200102', '$2y$10$r16l5sVvm.//oxHL9X2jpuelpnP/pDMo.4x0mPVdv39isZKoV72um', NULL, '200102', 0),
('200103', '$2y$10$3YRjUQ148P0UFYUZBuOade0cbeV94m4YRzjBcy1oqTBzUn4mONIPu', NULL, '200103', 0),
('200104', '$2y$10$F/TR7YokgMRcPyzpgI5fT.PAUoocYpNFPXkK.53ZJzeJV03syKFDW', NULL, '200104', 0),
('200105', '$2y$10$9sN9wiQ9SUKuLq239zvsAeisn3VNbMH/n9YBcPcD3TQd5v/CnqMI.', NULL, '200105', 0),
('200106', '$2y$10$WvNI1A/b0uFC5ivdcKn1qexBEPAFhh6EqSP485l2.1h3dZ6uSZsBW', NULL, '200106', 0),
('200107', '$2y$10$hK9qpXFh0kI5Ta1fwSmfnOXn6yhudgWlgtUqFBd4Fh5miA89pRueS', NULL, '200107', 0),
('200108', '$2y$10$qUb4vW9pDAx.TsfShqfFV.AOAWs2Sclzr6vn.fT9EgODrnfKBvynS', NULL, '200108', 0),
('200109', '$2y$10$JUlLX4CwXEmBPIKP8nsbWO.bYTeXa00mh6O7ChWsQL5dgqbMGfYZS', NULL, '200109', 0),
('200110', '$2y$10$m8NNmEJT2NyNlnRXRSM6cufr7YRGC7nTn15SJtPSDnu7TnAdJJODC', NULL, '200110', 0),
('200111', '$2y$10$Egfjelm9hVP6XpQyzfx5tuoelMtL6kb9L0cfOinzchEbrKKqubb02', NULL, '200111', 0),
('200112', '$2y$10$oEM5QQqjPlTs9uwerfiSteVnYB7/llDLw.EbDfV0S3LFhhPXtxyza', NULL, '200112', 0),
('200113', '$2y$10$4BhB5r/wBoQy6R42QkmVkuuRbHoo1p0bs8y041hY1Sp4dUuSmRmam', NULL, '200113', 0),
('200114', '$2y$10$Qgkyq08DEeS6JMH/hzifAOUSh0DpavNO95O5VDRrO0WiN1flE36de', NULL, '200114', 0),
('200115', '$2y$10$R8AUhxGq40JI7MIc2R76DuSAfGcIUUKwHAnVpdO39nmi7VH6XN95.', NULL, '200115', 0),
('200116', '$2y$10$huMO6tbJchXX1Fxmc9eoOOS65eT2x.BmQZ6fDjpAiPyYXGkFl0Rl2', NULL, '200116', 0),
('200117', '$2y$10$qm3wCQdyEB3OGb4Vg6B3CuAm4lW1G6w43M/pOcg6/N8yqxdViWj12', NULL, '200117', 0),
('200118', '$2y$10$a1cusSEI3xQ0Uo79Ds3eK.2s6zV/ibbCwSwqPipnox3rMYVVHFlVa', NULL, '200118', 0),
('200119', '$2y$10$STp8EIYvdmqAsC/Z3LPz/.SUkJGAXNWQ6Iqt5o6KwijQPbUG05dkC', NULL, '200119', 0),
('200120', '$2y$10$0bCbZ8AKiNiN.Pfkwj6NS.X5qp3G/91DzuOTAIIB67RgD/i1e1d3e', NULL, '200120', 0),
('200121', '$2y$10$pQJCn/SBQVYbgs3AVsQHluHtCP.8gynLXz5Z/WeZJs4mCuGSNNaou', NULL, '200121', 0),
('200122', '$2y$10$.lRQZefjwcaUSHRFcwg91eWg4IRJapAMI1YMFZ0VJmKD4ZXOu9sgi', NULL, '200122', 0),
('200123', '$2y$10$9714EouxLoIX3caWJhOOWOMMK6ZajJpVfsnbKoQ6oreDKntEyHnLu', NULL, '200123', 0),
('200124', '$2y$10$BKOfyVv.n8qGlYm3Usk.SubOhXYOL/6K7jMTpjWzkyI8vcRfTxvHa', NULL, '200124', 0),
('200125', '$2y$10$jpNLQ.oINzJ8YzwDWWwZyuel7cqlO.KWtLKv1t9hOTsa3VFjhGiK2', NULL, '200125', 0),
('200126', '$2y$10$V/kJGz4rTHzu0G9TY7Vj/OST32EGcwwWPDuiNSxHCl62mHggv1DaW', NULL, '200126', 0),
('200127', '$2y$10$rNy3lfJGHNb4FJ0uHGbCVefblNl8wcs4zvuEfrqXh0Ezd7PDWMjGK', NULL, '200127', 0),
('200128', '$2y$10$pCAXhH/hdz3aeydjQ8w1yecWyxTb/zssMoVJaNz2.UOB4TxD7fwca', NULL, '200128', 0),
('200129', '$2y$10$fdL6vszr8IPdezwG3K6z8e3TgaWrgt3SibmTsPSlfat7PwC0WDkqu', NULL, '200129', 0),
('200130', '$2y$10$wdKiI25NllS9h1dhia9tceNmFF6uVvGEytztau0X4JGf22E7.HqeS', NULL, '200130', 0),
('200131', '$2y$10$wCOrTdB5oiF64pmYYX0mlOQvaCMlRuCwM13bTdcFEgP0cXJM14A.u', NULL, '200131', 0),
('200132', '$2y$10$9ti9ZH/HZI2fUYDg2krSy.EP9ODDwkzEqoR8y0eNqwgJrKkcvYen2', NULL, '200132', 0),
('200133', '$2y$10$Nii./CvOTCjtnQ3Od.5gxO2aQd6ugdgo4E/SDzSVXBVFFcrwKu9l6', NULL, '200133', 0),
('200134', '$2y$10$X1711wbeXBiYWiENckN2Q.xPbU0mBDwFCfhcWm1O6D.zI5gvWcpiC', NULL, '200134', 0),
('200135', '$2y$10$DBLnl7mHuAu21pVYG8HvmespSfmu.hemTtekxDKl7kIOaXJp/PGj.', NULL, '200135', 0),
('200136', '$2y$10$99oglLObxCS9mFezMAFoHeonOyt5YCn4Pl6USjBLDCbYiiu6yaI5e', NULL, '200136', 0),
('200137', '$2y$10$by/9bMiMp61y45jDuzgjQeKbc5LywChEZ7n4hfx712iz6nWBTJueO', NULL, '200137', 0),
('200138', '$2y$10$7j0nGKZMNcGJx9XetJC9tOUGNuxoqnQkN4ComS6dAoAUoE3wZRtCa', NULL, '200138', 0),
('200139', '$2y$10$mrmxRLm3ypRAWVliE4Hlguz6w3sfBZqzX09Ru/Bm0JccPcR/7q9vy', NULL, '200139', 0),
('200140', '$2y$10$Cn8x3lNA861aHrMDKMO7MejDfe6ZoyGCdejo9wgFi1RYisG0T6ot.', NULL, '200140', 0),
('200141', '$2y$10$kFoJ7PYQXR.D5SD/A5Yo9u0q/K7kgJ.2YtCgGyHwxtDmNW/PyAyx6', NULL, '200141', 0),
('200142', '$2y$10$EwoGI6fx9hI3l1FbJd0Mn.yXl.teIBKKoTEdynJHrsZwpS229X2Tq', NULL, '200142', 0),
('200143', '$2y$10$ET0D2CtUVQ2UNki8YhEh4Ozipp4vCojbpBui1hXZH9TGRqQfsmPmK', NULL, '200143', 0),
('200144', '$2y$10$dXeDiVc3a1d6geaFzYqEyOrGT5CGl1y6nApOHTAfbPwzpQkxYab.S', NULL, '200144', 0),
('200145', '$2y$10$cYE5JK10bMzhBUcxhXv.5OKG7Wc07a6F57JcWJpaXP1sfaFzXIRRm', NULL, '200145', 0),
('200146', '$2y$10$OhtXBXBUTXlpbF/SZFMw9ulamW9zIIJt5xdOvW36/yGN158Ar58Ba', NULL, '200146', 0),
('200147', '$2y$10$5JwGBydYBWThXWsC1cBHH.MF71xbJUWLb6zWquH8WSDqC8aTG61ZW', NULL, '200147', 0),
('200148', '$2y$10$aJ.FrQ92d92E4IGF83etsOBUcCFqG1N0juJZvzCe0YMOtGSJV3/Ge', NULL, '200148', 0),
('200149', '$2y$10$bzZTUjJ1i5pQ7xFyNJX5hu8NrzcfrWEhfwmJwWvGrvxpKsW2X9fKG', NULL, '200149', 0),
('200150', '$2y$10$dfGf2WNvxVJSdeKodJYJAuj1aT5VsRyAuHzGCMsO1HLrFVj7KzeQ6', NULL, '200150', 0),
('200151', '$2y$10$FLTblxMpGCkAlKLRJibcZuCcWZ6dUUcmTuZLp0/4JLI9XmuiK8yju', NULL, '200151', 0),
('200152', '$2y$10$kjcoRRuFTXk1LCw5ZEQvoOQivdkJ31C21v7hPxmTfoc/aoc.cSxHq', NULL, '200152', 0),
('200153', '$2y$10$7umybKdTZHfMwsgMjZwiI.aP2DvoyGGtKWH/CRmtUTCDhuHXXMhu.', NULL, '200153', 0),
('200154', '$2y$10$JxUKi8UZ58CMx55M.U7YLeupaCM.Wih113YOvIqnFl6wq8au6.W4i', NULL, '200154', 0),
('200155', '$2y$10$/AV0yF1Ornhm.lO8tzM0Qus0gxUeKL6/H7zghfeGBpaHi5uBYiUL.', NULL, '200155', 0),
('200156', '$2y$10$jT6BwyXJCBGhRlj0t32KQeWMuP2k3RJzicaDy5PExIeLRZbcaa98u', NULL, '200156', 0),
('200157', '$2y$10$X0y0KE1LHyM/MYMpOuVfweStUgFSZsS1DanSKo2tn2XwVd8vaPfKy', NULL, '200157', 0),
('200158', '$2y$10$iGWho33mkQtZhpZg2zFAVOFFQwj5JyybmLwpOA55kx5Z.PSys2Ho.', NULL, '200158', 0),
('200159', '$2y$10$A9oE8buP/KrscrZafvaKseDz88kDdCn.ob4EEw8Gdinwvz.b7L4WW', NULL, '200159', 0),
('200160', '$2y$10$TKA4gm8Aef5JguyDGqVWReTaH6XrJWXTXAnrX5wGyX7UA754agNnu', NULL, '200160', 0),
('200161', '$2y$10$pJrI5lqrAysWz31XnXig.OVpBBVm/a2aG4yTLOAQxsWcrhWwlmJ5u', NULL, '200161', 0),
('200162', '$2y$10$1YCCBECIPQAwZFbY0PUCzOResqR.YLjIUoak85lKB2.ZY4v32TGma', NULL, '200162', 0),
('200163', '$2y$10$xzR83BCbaODpO9YW1SGBSujAGUVojkaRe.S6l54FJC0MeyPpAGxue', NULL, '200163', 0),
('200164', '$2y$10$2PG2rQStyTXsilfokQctiuCV4F6GP8DpLq.V7d0yqFsEt2TVv7lJm', NULL, '200164', 0),
('200165', '$2y$10$Wl.O7ZhAPBJf7i25g4.GbOdP6.l0xFaBaUc8n8Xe/uZxw7SJBXvk2', NULL, '200165', 0),
('200166', '$2y$10$Qf1pEDapCCcrWkVPsK.4xO7coDmce7iLX5Ezgu6DCaH66Xv/ld/HK', NULL, '200166', 0),
('200167', '$2y$10$p67s5IIWuIQ5dQbwp89Y3ediPb947l0MWDDsrJe5WE1b7DMpwY9t2', NULL, '200167', 0),
('200168', '$2y$10$b.qpoKTynfXd8kqiJXTDKe4iXx.wnvpCxNpyqbr96A36l/LRZOcT.', NULL, '200168', 0),
('200169', '$2y$10$KK22bmlBd9zOCHHaC141Pe50KYGsXtUOJo/nQ1P7en4Ebh8RN6ndC', NULL, '200169', 0),
('200170', '$2y$10$jlanQEgARR6Pp6m7oB1Y4Od../LnqMRwcKlqIS4RkU1V5UCd5yUn6', NULL, '200170', 0),
('200171', '$2y$10$9JOwPIiaXYpsrzPYQ/J8se1BU82FtdHODc4D1pJBcHdJ4MRZ/QUiq', NULL, '200171', 0),
('200172', '$2y$10$D6AlqLuOuAHmBt6qxM7DkO9/pEoxgbAf98f/nviqnvJ8SIJ/sxGEK', NULL, '200172', 0),
('200173', '$2y$10$827cB9eYqsyDTP1GZy4anOuM5ZRjm7FJTy6huPFzNqR2lCbBGAUFW', NULL, '200173', 0),
('200174', '$2y$10$/tEWlnj4LjvwQQRW0wDgSeyW601174nx843rNVoyObLm13Xg8z0A2', NULL, '200174', 0),
('200175', '$2y$10$LDBXhywSfo91.TZLpGLjRO9vanWH1521NpXYAeLFc1bgswRq0URhy', NULL, '200175', 0),
('200176', '$2y$10$R5Mx4BvvtTzqbHZna6mP/.l3QfQlDeKCOFytWh0KfCKr9cYKBmUNG', NULL, '200176', 0),
('200177', '$2y$10$tRMcgsR4Y2sYa1B42cCVu.mg/wK2ouFUlkYW/0QaCKtcJuX.CKHB6', NULL, '200177', 0),
('200178', '$2y$10$x4Npj2he558tG/fSLJP5LO7szRfq2EvAC7XtwvWP196fWWxfmIfeO', NULL, '200178', 0),
('200179', '$2y$10$6zFrXsWhNJJ1VEReDEroeuG9FYD.fLmwyBkjHeNZIAsi30XwPN6pW', NULL, '200179', 0),
('200180', '$2y$10$kXsW/9Kle4cQsGJlaTF1N.8afydrHAicPr7k0BLQuLuTuaGcLavwO', NULL, '200180', 0),
('200181', '$2y$10$6FoqQbAAczJMzoq9M9zz4OSZwqKYkjjLZUDE1L26Qsn0yEkQZIsX2', NULL, '200181', 0),
('200182', '$2y$10$kUTfFQ9nqWohDae0VIgMzesUaS9uKdnDTrlV6GFbghddwifqYy/Xm', NULL, '200182', 0),
('200183', '$2y$10$xo31zsIOHvxUkxmk92zfyejccRIl5SeXuM6C5w2YaU87oL/jksxme', NULL, '200183', 0),
('200184', '$2y$10$C4KGly1U3s7XAhNdjGg4UOnH2JNIHnshEpRvQek2nWDXuYV9GLkr6', NULL, '200184', 0),
('200185', '$2y$10$eS4geOvw8e9BphitaqeRE.cWv1LCVEej.xNnUDeyi8BjpB/8I4bjK', NULL, '200185', 0),
('200186', '$2y$10$tai/yMRwmmnxUFymOpc6Ke05qPANfQf3pNhzuPBRGf2koH6La1PTK', NULL, '200186', 0),
('200187', '$2y$10$S2zEtdhC4y0b5J15QjSlO.B.A8qUEsi5sDffRyaTOYvHmWyHFAINS', NULL, '200187', 0),
('200188', '$2y$10$2o6dqD97iDn68JGqpUJ4hOzbDedE29f/NArdIpKDNqiJatf03Hen.', NULL, '200188', 0),
('200189', '$2y$10$gqGlbVx/VyjuJFMlaj9.We4ntsXULFAWPKKgNJ5AJiaNbX4UQFPjq', NULL, '200189', 0),
('200190', '$2y$10$IYAptjYvh3uK7f2AuwTtt.eb/XSIBYd49FdxaZYoS/rd8YCuCKyuq', NULL, '200190', 0),
('200191', '$2y$10$l35vHuLVvIKviir/xlVsFuaklccYU2Qngjs7mcwIK2D905WzVZIwm', NULL, '200191', 0),
('200192', '$2y$10$uXicSFMnr6WD.HNxHEa9dOgZ1Zg9jw8nxcJpu2YAWnClY8jB0Vpvu', NULL, '200192', 0),
('200193', '$2y$10$QYiPG17MtGDaEPcqK0WbNeGWfAiw8/1guXYgGPfofKJybBbNlVpSK', NULL, '200193', 0),
('200194', '$2y$10$seKjNi0tZxFQUiEiuVFLs.iRKMCJOmXm/hgdU7RBkwrzjs3Fr2DM6', NULL, '200194', 0),
('200195', '$2y$10$iZTQuzp.H5Lk8mqvNG997uTkqTEcWYDYtsbfhoNGK2KIontescOiS', NULL, '200195', 0),
('200196', '$2y$10$WcGbdycKm6fus0gcGXd0LuVA.dKmlP/VrQ.2iEGJcmxCRMHGIWWCe', NULL, '200196', 0),
('200197', '$2y$10$Bk23kh8lYXWNx6bM02wgjOu.b.A306HlEBlxDIrG1NIfo.XgptslS', NULL, '200197', 0),
('200198', '$2y$10$o25jrAILFT7bqfqDtE0WY.Z8UBIAz9HKJbIaCEldEWIl4KMJo9FXC', NULL, '200198', 0),
('200199', '$2y$10$Yqt5/o4upWGpKe6n2tneU.O4GcJs9h4j60ItdHxAfJY/W5X9sHqHi', NULL, '200199', 0),
('201001', '$2y$10$OfxHLLhi4O9M5wymLbHbJeheTaI.UXCdE99SJZWISIqlQbya4UCGK', NULL, '201001', 0),
('201002', '$2y$10$pXB4pVmTcB7JQnBtsJt/.Oegq.UF3lQ3qMMDRzHHqgttbL6TpT2la', NULL, '201002', 0),
('201800001', '$2y$10$YHTZwqG3LxZWjbfzM8uXweUYLkhu80PDkMEM40.rofoy7Rr.umkRm', '201800001', NULL, 0),
('201800002', '$2y$10$hS1/corAJqrAuMMIRfUZKugBo8.XWqNn1Ol0OVSuppNZV0H1XSTni', '201800002', NULL, 0),
('201800004', '$2y$10$cPFJYwZderS2lTmpvQTzE.rGAdMQvocn2zASmxkeH95frANP5Z7cC', '201800004', NULL, 0),
('201800006', '$2y$10$P1muBou5qkofTDfZmGxFJeV3PCB0A7HDV75j0nBfCRdA54xhNQzb2', '201800006', NULL, 0),
('201800007', '$2y$10$Nx13JqjXmDhqDF6IkHAKfOddi50/2wzP5ZcrizLi26gwvbifeC/HG', '201800007', NULL, 0),
('201800008', '$2y$10$C0cUTV4wSVbeKrNZadOIdO4oLjoE3nMRdADkPHAJKsBdJ2tQbIcF2', '201800008', NULL, 0),
('201800009', '$2y$10$7dW1p72zDZ74ODsPOU6sA.2USizj2MJ/k43sA5Tx/UNLXCPadWpi6', '201800009', NULL, 0),
('201800010', '$2y$10$wUDnxbQkbavNKDNxUJSGceJ4tfPJyYUqPQFnW.DAnT8JVmlCKGfmC', '201800010', NULL, 0),
('201800011', '$2y$10$CDhAZyTou8e6SmJKQcquoOFohd4sa74s8GSQqB6s4yucTDyRdxE7K', '201800011', NULL, 0),
('201800012', '$2y$10$onFDGVHzfKL23LXzzXJ1pOK3.t/spkTrP19oCKUi42ESA0BLUktZO', '201800012', NULL, 0),
('201800013', '$2y$10$nnpFXJaOazGupDUlxeDSpuKEcOJe1rUv6ln2wyJ7vJLft4UMhJp0a', '201800013', NULL, 0),
('201800014', '$2y$10$s0JqNquwgt.AN1/xUCrWWOFMpiORgmX3ZpXTHXRPVntE4lpPf9fh6', '201800014', NULL, 0),
('201800015', '$2y$10$5hnf0lxuCfbZ5fT6..kXOOfhJMMc9N69ORMpyL352FwoHRxKI.wLK', '201800015', NULL, 0),
('201800016', '$2y$10$8X6O5e5Aj4k4fb0gYRRgKuKZ35JalN4sbh9EtJnDDXpm/dkxQ4C52', '201800016', NULL, 0),
('201800017', '$2y$10$zvhWWyRwJgprcy/20RWovuoqpakz8ApSmR5wm8x5bViR5oluKHvqK', '201800017', NULL, 0),
('201800018', '$2y$10$lZVczRfDyMj3Mga5lM/TPOkwh/1gXHx/iRA5X/6gJzRIkiGr0LiZ6', '201800018', NULL, 0),
('201800019', '$2y$10$PzlXZSQl9ZYGeOsWoJbwkOsYJZMG027Ajlwc6prVxS4GX6FDnjXuK', '201800019', NULL, 0),
('201800020', '$2y$10$Ty2QzRhgfeaT0f.65tM7Ref0SiImMSfBWmMLeeePmb5GMeGWwgR9K', '201800020', NULL, 0),
('201800021', '$2y$10$ZivMWWDdvb23Q3H.6u11GeKdfvYO7UEwwnQVxyLFtqN3bV26AGxby', '201800021', NULL, 0),
('201800022', '$2y$10$a1VcT.VUcdW2p1u1wqstaOESnw0CPTWJFItS7gVDPLFNY5V37ZMyq', '201800022', NULL, 0),
('201800023', '$2y$10$T1m1atNCUEosgUZJOITDkuyzu7dFlaPYdnijQTGUzEI3buS9TlLVe', '201800023', NULL, 0),
('201800024', '$2y$10$6ND2538zjqzwUquLP/SWeeVCX88YziqZK.HfCYyeweeBaARXa7siK', '201800024', NULL, 0),
('201800025', '$2y$10$ChD.crcITL/S0AHZ7CHtyuW9Qc8J27K7WchE2hT5TEkfY9WSWQFQK', '201800025', NULL, 0),
('201800026', '$2y$10$S35FMa0Up//qWGN0TPWgHuE2kO7daD5OVQNexTgILjKOlr5tNBk0y', '201800026', NULL, 0),
('201800027', '$2y$10$XrX8.AEBL0Jf.VhWtYGHMuSrBuD7mKjYuDmWj81TyMa5AAMPhUoUO', '201800027', NULL, 0),
('201800028', '$2y$10$lxiZuQJ6A8TaKAQmpWHNQu2QFm9UnafABuk/Ux.Rv9cfRnDWbF6Ue', '201800028', NULL, 0),
('201800029', '$2y$10$HlJBiSxs1G5zhsp9cuzKROE8DVvQ2lQs3h3i/Iliolmcuyg/DXSHS', '201800029', NULL, 0),
('201800030', '$2y$10$kVI8OW1CpS4qBMDs/zG0uuDtKc0OFdKO/2.430R9XVeqnHReleayu', '201800030', NULL, 0),
('201800031', '$2y$10$hPTbEGoXTr5lDKratKFSieSeA2ZxPQMNMdokj3.uFyzkWXHRjGOQK', '201800031', NULL, 0),
('201800032', '$2y$10$B/XNQyIR1DtWNwXjgnuLaO.k5R5eqkub39A93ZlEWX4SQaBT/uIWK', '201800032', NULL, 0),
('201800033', '$2y$10$FmyGrOHQAxthdtyrowRAD.6sYmBt/QhQ3zzhkAA0w9bflDKuFCGk6', '201800033', NULL, 0),
('201800034', '$2y$10$Tw50DEDkEdQDfqhqxVao2.vKRoIVH4.WQe8JQR5bO.FRP9HxKP6BO', '201800034', NULL, 0),
('201800035', '$2y$10$rt1ETUiHgw.yS4u01R7HGeVofTsnomkB5iLgtWfJJFU5BOa4tQLX2', '201800035', NULL, 0),
('201800036', '$2y$10$20zaeYRO.aS7kjEXOcUvIu6VG4wxKKl9K1PPdpDPs0AJIqhtQAna6', '201800036', NULL, 0),
('201800037', '$2y$10$d4ckWQrf6gz2SxKNdKi4p.0cfomG.rRmhnsiRx9qj6g3ctQR7VLIu', '201800037', NULL, 0),
('201800038', '$2y$10$BkC7HoflZuhpvhFJi2gttuQPnXf5CCBG9GLPqewISaqI1Ous7JR5y', '201800038', NULL, 0),
('201800039', '$2y$10$xp4QT9IxuqzBuF1zaKS8sukZXieJTR7qm9f4i1uWJ1bfHmLU3VlSW', '201800039', NULL, 0),
('201800040', '$2y$10$L7BOOovrEbfDicOi4F7lC./i6WaP6aTVaFHXsrOq04lUVMdS8ppLy', '201800040', NULL, 0),
('201800041', '$2y$10$hIKSiFh0wrCwALc6M7fuyuWSJZ2DHKG9PNyz4bWg55B6b6/N550oi', '201800041', NULL, 0),
('201800042', '$2y$10$UbTHgxllRjiD.M55O9e07Ot1QBnsn164oLl0kJR71jQpOIUJffcfq', '201800042', NULL, 0),
('201800043', '$2y$10$lv9f1CVE82AXSYgSQ2wNZ./rEYOm/1QL/HJQ0qZ6D6MBHx9TM32FG', '201800043', NULL, 0),
('201800044', '$2y$10$M6ktrOhhU6IW8bZUHrWv8uqMUW1cp8ebWp8sq3LdOuvyeDo2G/jre', '201800044', NULL, 0),
('201800045', '$2y$10$PZX1loK4qLcQhE9aYsCnfuA8dw50Km66c1Rbm5JxzEx30ZLam3gA6', '201800045', NULL, 0),
('201800046', '$2y$10$DlSX39YSFh8wphabW7rs/espfwEFMH7/Exa2DCNjb3Ew7cY/Rwmyi', '201800046', NULL, 0),
('admin', '$2y$10$ujfo1pEodssSlR.5nFRe2ee3TBslDpklsPBkXZnGiznF7mF8DmhZC', NULL, NULL, 1),
('aileen', '$2y$10$2gJR3gamyoctIJ/hTFyQg.XKewrUEAoUeO8xOoHyKeYDBBLa7hrm2', NULL, '271125', 0),
('aileendavid_', '$2y$10$xJOiry.h2uRz.J3Cyjx6ueXkCwQjXl1fWh1.F6zc.hb4j6sKv9F5W', '160423031', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `idthread` int(11) NOT NULL,
  `username_pembuat` varchar(20) NOT NULL,
  `isi` text DEFAULT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `npk` char(6) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `foto_extension` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`npk`, `nama`, `foto_extension`) VALUES
('200101', 'Dr. Kiki Pratama', 'png'),
('200102', 'Ir. Ahmad Maulana', 'jpg'),
('200103', 'Drs. Fajar Iskandar', 'webp'),
('200104', 'Prof. Bella Ramadhan', 'webp'),
('200105', 'Qori Sutanto', 'png'),
('200106', 'Prof. Halim Nugroho', 'webp'),
('200107', 'Dr. Fajar Rahman', 'jpg'),
('200108', 'Ir. Gilang Rahman', 'jpeg'),
('200109', 'Drs. Nadia Wijayanti', 'jpeg'),
('200110', 'Dr. Chandra Sukma', 'jpeg'),
('200111', 'Dr. Nina Wijayanti', 'png'),
('200112', 'Ir. Bella Suryanto', 'png'),
('200113', 'Ir. Ahmad Wijayanti', 'png'),
('200114', 'Lestari Wijayanti', 'jpg'),
('200115', 'Dr. Kiki Pertiwi', 'png'),
('200116', 'Ir. Rizal Suryanto', 'png'),
('200117', 'Ir. Sari Cahyadi', 'webp'),
('200118', 'Prof. Vega Maulana', 'png'),
('200119', 'Prof. Oktavian Setiawan', 'jpg'),
('200120', 'Prof. Wira Wijayanti', 'png'),
('200121', 'Ir. Yusuf Putra', 'png'),
('200122', 'Prof. Halim Rahman', 'jpeg'),
('200123', 'Drs. Rizal Cahyadi', 'png'),
('200124', 'Sari Pratama', 'png'),
('200125', 'Prof. Citra Saputra', 'jpg'),
('200126', 'Umar Pratama', 'png'),
('200127', 'Drs. Vega Supardi', 'png'),
('200128', 'Drs. Omar Adji', 'jpg'),
('200129', 'Kiki Maulana', 'jpeg'),
('200130', 'Dr. Joko Suryanto', 'webp'),
('200131', 'Eka Santoso', 'webp'),
('200132', 'Ahmad Maulana', 'webp'),
('200133', 'Prof. Putri Wijaya', 'png'),
('200134', 'Eka Wijaya', 'jpg'),
('200135', 'Prof. Zaki Kurniawan', 'webp'),
('200136', 'Prof. Eka Sukma', 'webp'),
('200137', 'Ir. Sinta Sutanto', 'jpeg'),
('200138', 'Mahendra Ramadhan', 'jpeg'),
('200139', 'Drs. Lina Pertiwi', 'png'),
('200140', 'Dr. Zaki Setiawan', 'webp'),
('200141', 'Prof. Nadia Pertiwi', 'jpeg'),
('200142', 'Joko Farah', 'png'),
('200143', 'Dr. Putu Maulana', 'webp'),
('200144', 'Prof. Intan Suryanto', 'png'),
('200145', 'Prof. Mila Pratama', 'jpg'),
('200146', 'Putri Cahyadi', 'webp'),
('200147', 'Drs. Zaki Farah', 'jpeg'),
('200148', 'Prof. Gilang Hidayat', 'jpg'),
('200149', 'Dr. Sinta Rahman', 'jpeg'),
('200150', 'Ir. Fikri Wijaya', 'webp'),
('200151', 'Dr. Yani Santoso', 'jpg'),
('200152', 'Gilang Cahyadi', 'jpeg'),
('200153', 'Dr. Aditya Wijaya', 'png'),
('200154', 'Ir. Ulfa Rahman', 'png'),
('200155', 'Ir. Halim Santoso', 'png'),
('200156', 'Drs. Eka Iskandar', 'png'),
('200157', 'Drs. Qori Saputra', 'webp'),
('200158', 'Dr. Halim Pertiwi', 'jpeg'),
('200159', 'Drs. Kevin Pratama', 'jpg'),
('200160', 'Dr. Eka Pertiwi', 'webp'),
('200161', 'Aditya Kurniawan', 'jpeg'),
('200162', 'Prof. Rara Santoso', 'jpeg'),
('200163', 'Drs. Umar Setiawan', 'jpeg'),
('200164', 'Drs. Zaki Ramadhan', 'jpeg'),
('200165', 'Prof. Umar Ramadhan', 'jpeg'),
('200166', 'Drs. Irma Anggraini', 'jpg'),
('200167', 'Umar Kurniawan', 'jpeg'),
('200168', 'Dr. Umar Kurniawan', 'jpg'),
('200169', 'Ir. Qori Wijaya', 'jpg'),
('200170', 'Ir. Taufik Saputra', 'jpeg'),
('200171', 'Ir. Tari Kurniawan', 'webp'),
('200172', 'Prof. Taufik Kurniawan', 'png'),
('200173', 'Drs. Budi Gunawan', 'jpeg'),
('200174', 'Halim Maulana', 'webp'),
('200175', 'Xena Sukma', 'webp'),
('200176', 'Drs. Oktavian Ramadhan', 'png'),
('200177', 'Ir. Eka Putra', 'jpeg'),
('200178', 'Drs. Wulan Pertiwi', 'webp'),
('200179', 'Ir. Hendra Cahyadi', 'webp'),
('200180', 'Prof. Fajar Saputra', 'webp'),
('200181', 'Jihan Setiawan', 'png'),
('200182', 'Dr. Nina Gunawan', 'jpg'),
('200183', 'Ir. Irma Anggraini', 'jpeg'),
('200184', 'Dr. Omar Rahman', 'png'),
('200185', 'Ir. Intan Wijaya', 'webp'),
('200186', 'Prof. Rizal Suryanto', 'jpeg'),
('200187', 'Ir. Gilang Kurniawan', 'webp'),
('200188', 'Prof. Zaki Anggraini', 'png'),
('200189', 'Prof. Oktavian Suryanto', 'jpeg'),
('200190', 'Eka Sukma', 'webp'),
('200191', 'Ir. Lestari Rahman', 'jpeg'),
('200192', 'Prof. Budi Hidayat', 'png'),
('200193', 'Dr. Intan Ramadhan', 'jpeg'),
('200194', 'Budi Pertiwi', 'jpg'),
('200195', 'Ir. Aditya Anggraini', 'jpeg'),
('200196', 'Budi Suryanto', 'png'),
('200197', 'Drs. Yusuf Wijayanti', 'webp'),
('200198', 'Drs. Wira Pertiwi', 'jpg'),
('200199', 'Dr. Ahmad Setiawan', 'webp'),
('201001', 'Kucing', 'webp'),
('201002', 'Miaw', 'jpeg'),
('271125', 'aileen', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `idgrup` int(11) NOT NULL,
  `judul` varchar(45) DEFAULT NULL,
  `judul-slug` varchar(45) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jenis` enum('Privat','Publik') DEFAULT NULL,
  `poster_extension` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `idgrup` int(11) NOT NULL,
  `username_pembuat` varchar(20) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `tanggal_pembentukan` datetime DEFAULT NULL,
  `jenis` enum('Privat','Publik') DEFAULT NULL,
  `kode_pendaftaran` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`idgrup`, `username_pembuat`, `nama`, `deskripsi`, `tanggal_pembentukan`, `jenis`, `kode_pendaftaran`) VALUES
(3, 'aileen', 'NMP 2025/2026', 'Kelas NMP 2025/2026', '2025-11-27 04:27:09', 'Privat', 'G37187'),
(5, 'aileen', 'FSP 2025/2026', 'FSP untuk tahun ajaran 2025/2026', '2025-11-27 05:57:25', 'Privat', 'G51808');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nrp` char(9) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `gender` enum('Pria','Wanita') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `foto_extention` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nrp`, `nama`, `gender`, `tanggal_lahir`, `angkatan`, `foto_extention`) VALUES
('160423031', 'Aileen Joyce David', 'Wanita', '2005-08-23', 2023, 'jpg'),
('201800001', 'Yani Pratama', 'Wanita', '2002-12-28', 2020, 'jpeg'),
('201800002', 'Kevin Supardi', 'Wanita', '1996-10-03', 2018, 'jpg'),
('201800004', 'Bayu Adji', 'Pria', '2001-05-05', 2021, 'png'),
('201800006', 'Yani Maulana', 'Pria', '2004-10-10', 2023, 'webp'),
('201800007', 'Sari Putra', 'Pria', '1999-07-25', 2018, 'png'),
('201800008', 'Fajar Anggraini', 'Pria', '1997-03-16', 2016, 'jpg'),
('201800009', 'Hendra Nugroho', 'Pria', '1996-06-25', 2022, 'webp'),
('201800010', 'Mila Supardi', 'Pria', '1999-07-25', 2018, 'jpeg'),
('201800011', 'Agus Saputra', 'Pria', '2002-12-31', 2016, 'jpeg'),
('201800012', 'Rara Santoso', 'Wanita', '1998-03-25', 2017, 'webp'),
('201800013', 'Yani Cahyadi', 'Pria', '1997-12-21', 2023, 'jpg'),
('201800014', 'Cahya Rahman', 'Wanita', '2001-12-20', 2016, 'jpg'),
('201800015', 'Vina Cahyadi', 'Wanita', '2001-11-07', 2019, 'jpg'),
('201800016', 'Sari Adji', 'Wanita', '1999-07-13', 2023, 'jpeg'),
('201800017', 'Agus Firmansyah', 'Pria', '1996-06-05', 2018, 'png'),
('201800018', 'Mira Wijaya', 'Wanita', '1998-03-04', 2023, 'jpg'),
('201800019', 'Budi Wicaksono', 'Wanita', '1996-06-26', 2022, 'png'),
('201800020', 'Erlina Wicaksono', 'Pria', '2001-12-15', 2016, 'jpeg'),
('201800021', 'Xena Santoso', 'Wanita', '2002-09-26', 2021, 'webp'),
('201800022', 'Xena Adji', 'Pria', '2004-06-24', 2016, 'webp'),
('201800023', 'Gita Maulana', 'Wanita', '2004-06-20', 2017, 'png'),
('201800024', 'Rara Putra', 'Pria', '1999-10-30', 2016, 'webp'),
('201800025', 'Tari Adji', 'Wanita', '1997-05-07', 2017, 'jpeg'),
('201800026', 'Vega Sutanto', 'Pria', '2001-12-21', 2019, 'png'),
('201800027', 'Dimas Hidayat', 'Pria', '1997-04-28', 2017, 'webp'),
('201800028', 'Naila Adji', 'Wanita', '1999-06-18', 2017, 'webp'),
('201800029', 'Bella Ramadhan', 'Pria', '2001-12-21', 2016, 'jpeg'),
('201800030', 'Sinta Ramadhan', 'Pria', '1998-04-15', 2021, 'png'),
('201800031', 'Intan Firmansyah', 'Pria', '2003-07-08', 2021, 'png'),
('201800032', 'Citra Setiawan', 'Pria', '1997-07-27', 2023, 'png'),
('201800033', 'Mira Kurniawan', 'Pria', '2004-04-25', 2016, 'webp'),
('201800034', 'Yusuf Iskandar', 'Wanita', '2000-03-30', 2018, 'jpg'),
('201800035', 'Agus Wicaksono', 'Wanita', '2002-06-06', 2018, 'jpg'),
('201800036', 'Omar Setiawan', 'Wanita', '2003-02-25', 2022, 'jpeg'),
('201800037', 'Ulfa Iskandar', 'Wanita', '2001-06-04', 2018, 'jpg'),
('201800038', 'Putu Gunawan', 'Wanita', '2002-08-01', 2016, 'jpeg'),
('201800039', 'Gilang Sukma', 'Pria', '1998-01-20', 2020, 'jpg'),
('201800040', 'Tari Putra', 'Wanita', '2002-01-01', 2017, 'jpeg'),
('201800041', 'Tari Rahman', 'Pria', '1997-09-16', 2021, 'jpeg'),
('201800042', 'Zaki Laksana', 'Pria', '2002-02-02', 2022, 'webp'),
('201800043', 'Rizal Prabowo', 'Wanita', '2001-04-16', 2022, 'webp'),
('201800044', 'Budi Laksana', 'Pria', '2002-09-24', 2020, 'png'),
('201800045', 'Putri Sukma', 'Pria', '1999-01-19', 2017, 'jpeg'),
('201800046', 'Vega Saputra', 'Wanita', '1996-09-15', 2016, 'png'),
('201800047', 'Sari Firmansyah', 'Pria', '2004-12-25', 2017, 'jpeg'),
('201800048', 'Sinta Sukma', 'Pria', '1996-08-14', 2019, 'webp'),
('201800049', 'Putri Wijaya', 'Pria', '2003-09-07', 2020, 'jpg'),
('201800050', 'Intan Firmansyah', 'Pria', '2001-11-13', 2019, 'jpg'),
('201800051', 'Vina Prabowo', 'Pria', '1996-02-18', 2022, 'webp'),
('201800052', 'Bella Putra', 'Pria', '2001-02-04', 2018, 'jpeg'),
('201800053', 'Yani Sutanto', 'Wanita', '2000-05-08', 2019, 'png'),
('201800054', 'Mila Supardi', 'Pria', '2004-08-29', 2022, 'jpeg'),
('201800055', 'Putu Pratama', 'Pria', '2000-05-30', 2021, 'jpeg'),
('201800056', 'Dimas Wijaya', 'Wanita', '1997-05-05', 2023, 'jpeg'),
('201800057', 'Vega Setiawan', 'Wanita', '1999-08-03', 2023, 'webp'),
('201800058', 'Erlina Kurniawan', 'Pria', '1998-06-15', 2016, 'jpg'),
('201800059', 'Intan Putra', 'Wanita', '2001-12-01', 2022, 'jpeg'),
('201800060', 'Mira Sukma', 'Wanita', '2003-07-31', 2023, 'webp'),
('201800061', 'Wira Setiawan', 'Pria', '1999-05-22', 2020, 'webp'),
('201800062', 'Sari Hidayat', 'Pria', '2004-07-01', 2019, 'png'),
('201800063', 'Rara Sukma', 'Wanita', '2003-01-26', 2020, 'webp'),
('201800064', 'Mila Wijaya', 'Pria', '2003-05-28', 2020, 'png'),
('201800065', 'Rizal Firmansyah', 'Pria', '2003-09-27', 2019, 'webp'),
('201800066', 'Bayu Pratama', 'Pria', '2000-11-30', 2020, 'jpg'),
('201800067', 'Bayu Suryanto', 'Wanita', '2001-07-21', 2019, 'jpeg'),
('201800068', 'Naila Prabowo', 'Pria', '1996-11-22', 2020, 'png'),
('201800069', 'Wira Prabowo', 'Pria', '2001-05-08', 2017, 'png'),
('201800070', 'Naila Adji', 'Wanita', '2001-04-04', 2019, 'jpg'),
('201800071', 'Vega Iskandar', 'Wanita', '2003-05-16', 2023, 'jpeg'),
('201800072', 'Dewi Saputra', 'Pria', '2002-03-15', 2016, 'jpg'),
('201800073', 'Bella Rahman', 'Wanita', '1999-05-21', 2016, 'png'),
('201800074', 'Joko Nugroho', 'Wanita', '2000-07-28', 2023, 'jpg'),
('201800075', 'Jihan Santoso', 'Wanita', '2004-04-13', 2017, 'jpeg'),
('201800076', 'Budi Wicaksono', 'Wanita', '2001-08-03', 2018, 'webp'),
('201800077', 'Omar Suryanto', 'Wanita', '1999-01-15', 2020, 'jpeg'),
('201800078', 'Kevin Laksana', 'Pria', '1999-11-23', 2018, 'png'),
('201800079', 'Naila Wicaksono', 'Wanita', '2003-05-29', 2016, 'png'),
('201800080', 'Kiki Kurniawan', 'Wanita', '2000-05-30', 2018, 'webp'),
('201800081', 'Joko Adji', 'Wanita', '1998-10-19', 2023, 'png'),
('201800082', 'Zahra Suryanto', 'Pria', '2003-10-31', 2021, 'webp'),
('201800083', 'Gilang Wijaya', 'Wanita', '1999-12-26', 2020, 'jpeg'),
('201800084', 'Gilang Supardi', 'Wanita', '1999-04-22', 2018, 'webp'),
('201800085', 'Bella Iskandar', 'Pria', '1996-02-15', 2016, 'jpg'),
('201800086', 'Yani Adji', 'Pria', '2002-08-28', 2020, 'jpeg'),
('201800087', 'Rara Putra', 'Wanita', '1998-07-25', 2021, 'jpg'),
('201800088', 'Cahya Suryanto', 'Pria', '1997-01-11', 2017, 'webp'),
('201800089', 'Wira Kurniawan', 'Pria', '1996-09-29', 2021, 'jpg'),
('201800090', 'Rizal Suryanto', 'Pria', '1998-11-18', 2018, 'jpeg'),
('201800091', 'Okan Iskandar', 'Wanita', '2003-07-12', 2016, 'webp'),
('201800092', 'Mira Nugroho', 'Wanita', '1999-08-08', 2017, 'png'),
('201800093', 'Gita Anggraini', 'Wanita', '2003-08-21', 2018, 'webp'),
('201800094', 'Bayu Nugroho', 'Wanita', '1999-12-18', 2020, 'jpeg'),
('201800095', 'Mila Santoso', 'Pria', '1999-04-06', 2020, 'jpg'),
('201800096', 'Ahmad Firmansyah', 'Pria', '2004-06-03', 2020, 'png'),
('201800097', 'Vina Suryanto', 'Pria', '2000-10-15', 2022, 'jpeg'),
('201800098', 'Cahya Putra', 'Wanita', '2004-09-21', 2019, 'jpg'),
('201800099', 'Bella Wicaksono', 'Wanita', '1998-03-31', 2022, 'png'),
('201800100', 'Yani Firmansyah', 'Wanita', '2000-07-28', 2021, 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member_grup`
--

CREATE TABLE `member_grup` (
  `idgrup` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `idthread` int(11) NOT NULL,
  `username_pembuat` varchar(20) NOT NULL,
  `idgrup` int(11) NOT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL,
  `status` enum('Open','Close') DEFAULT 'Open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_akun_mahasiswa_idx` (`nrp_mahasiswa`),
  ADD KEY `fk_akun_dosen1_idx` (`npk_dosen`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `fk_chat_thread1_idx` (`idthread`),
  ADD KEY `fk_chat_akun1_idx` (`username_pembuat`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`npk`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`),
  ADD KEY `fk_event_grup1_idx` (`idgrup`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`idgrup`),
  ADD KEY `fk_grup_akun1_idx` (`username_pembuat`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nrp`);

--
-- Indexes for table `member_grup`
--
ALTER TABLE `member_grup`
  ADD PRIMARY KEY (`idgrup`,`username`),
  ADD KEY `fk_grup_has_akun_akun1_idx` (`username`),
  ADD KEY `fk_grup_has_akun_grup1_idx` (`idgrup`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`idthread`),
  ADD KEY `fk_thread_akun1_idx` (`username_pembuat`),
  ADD KEY `fk_thread_grup1_idx` (`idgrup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `idgrup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `idthread` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `fk_akun_dosen1` FOREIGN KEY (`npk_dosen`) REFERENCES `dosen` (`npk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_akun_mahasiswa` FOREIGN KEY (`nrp_mahasiswa`) REFERENCES `mahasiswa` (`nrp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_chat_thread1` FOREIGN KEY (`idthread`) REFERENCES `thread` (`idthread`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `fk_grup_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_grup`
--
ALTER TABLE `member_grup`
  ADD CONSTRAINT `fk_grup_has_akun_akun1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_grup_has_akun_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `fk_thread_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_thread_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
