SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+02:00";


CREATE TABLE `tasks` (
  `uuid` varchar(40) NOT NULL,
  `name` text NOT NULL,
  `miner` text NOT NULL,
  `miner_parameters` text NOT NULL,
  `def_miner` text NOT NULL,
  `def_miner_param` text NOT NULL,
  `comment` text NOT NULL,
  `def_comment` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `tasks` (`uuid`, `name`, `miner`, `miner_parameters`, `def_miner`,`def_miner_param`, `comment`, `def_comment`, `time`) VALUES
('03D502E0-045E-054C-7A06-B80700080009', '6x1080-1', '\\miners\\ccminer-x64-2.2.5-cuda9\\ccminer.exe', '-a X16S -o stratum+tcp://254.143.201.103:3101 -u usr_mine.81737 -p x', 'default /1', 'param_default /1', '81137', '1 default_coment', 1525884778),
('03D502E0-045E-054C-7B06-460700080009', '6x1080-2', '\\miners\\nevermore-v0.2.1-win64\\ccminer.exe', '-a PHI1612 -o stratum+tcp://254.143.201.103:3121 -u usr_mine.73513 -p x','default /2', 'param_default /2', '79513', '2 default_coment', 1525884778),
('1ED94B80-D7DA-11DD-B022-60A44C3CF236', 'Max 3*1080ti', '\\miners\\nevermore-v0.2.1-win64\\ccminer.exe', '-a X16R -o stratum+tcp://254.143.201.103:3314 -u usr_mine.74166 -p x','default /3', 'param_default /3', '76166', '3 default_coment', 1525884778),
('3E55EBA8-0D91-30A4-1581-B06EBFBC03F5', '8x1070ti-2', '\\miners\\ccminer-x64-2.2.5-cuda9\\ccminer.exe', '-a X16S -o stratum+tcp://254.143.201.103:3078 -u usr_mine.85130 -p x','default /4', 'param_default /4', '81130', '4 default_coment', 1525884773),
('3FEAF35F-5F7C-8EDF-6596-88D7F6C44642', '6x1060-1 yuriy', '\\miners\\nevermore-v0.2.1-win64\\ccminer.exe', '-a c11 -o stratum+tcp://254.143.201.103:3028 -u SRr2ooVmGAaDRCADvx8owqVVps1iKthrww -p c=SPD', 'default /5', 'param_default /5', 'SPD', '5 default_coment', 1525884778),
('78F9F067-EE08-D917-FAC3-45463D2FCB77', 'TEST gt750', '', '','default /6', 'param_default /6', '', '6 default_coment', 1525255224),
('B97CAE05-861E-18B1-97EB-2C4D54569187', '8x1070', '\\miners\\ccminer-x64-2.2.5-cuda9\\ccminer.exe', '-a X16S -o stratum+tcp://254.143.201.103:3919 -u usr_mine.81132 -p x','default /7', 'param_default /7', '81132', '7 default_coment', 1525884777),
('D59DE63B-6A48-D566-72FF-B06EBFBC01A4', '8x1070ti-3', '\\miners\\ccminer-x64-2.2.5-cuda9\\ccminer.exe', '-a LYRA2Z -o stratum+tcp://254.143.201.103:3372 -u usr_mine.78806 -p x','default /8', 'param_default /8', '78806', '8 default_coment', 1525884777),
('F5418578-DA5D-4BC9-284B-B06EBFBBFB2B', '8x1070ti-1', '\\miners\\ccminer-x64-2.2.5-cuda9\\ccminer.exe', '-a X16S -o stratum+tcp://254.143.201.103:3909 -u usr_mine.81133 -p x','default /9', 'param_default /9', '81133', '9 default_coment', 1525884773);


ALTER TABLE `tasks`
  ADD PRIMARY KEY (`uuid`);
COMMIT;