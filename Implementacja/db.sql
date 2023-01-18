-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Sty 2023, 19:54
-- Wersja serwera: 8.0.31
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adopter`
--

CREATE TABLE `adopter` (
  `id` bigint NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `id_number` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `type` varchar(45) NOT NULL,
  `notes` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `adopter`
--

INSERT INTO `adopter` (`id`, `name`, `surname`, `id_number`, `address`, `email`, `phone`, `type`, `notes`) VALUES
(1, 'Jan', 'Kowalski', 'CG38A', 'Olsztyn, ul. Malborska 2', 'jkowalski@gmail.com', '+48123456789', 'Stały', ''),
(2, 'Henryk', 'Kowalski', 'CG34N', 'Mława, ul. Warszawska 30/5', 'email@email.com', '+48123456789', 'Stały', ''),
(3, 'Mirosław', 'Szpak', 'CP34k', 'Łódź, ul. Leśna 58', 'mszpak@gmail.com', '+48123456789', 'Tymczasowy', ''),
(4, 'Piotr', 'Łuszcz', 'CF13a', 'Katowice, ul. Polska 55', 'jestembogem@onet.pl', '+48984235756', 'Stały', 'Adoptujący zrezygnował z adopcji.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adoption`
--

CREATE TABLE `adoption` (
  `id` bigint NOT NULL,
  `date` date NOT NULL,
  `status` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `notes` longtext NOT NULL,
  `adopter_id` bigint NOT NULL,
  `dog_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `adoption`
--

INSERT INTO `adoption` (`id`, `date`, `status`, `type`, `notes`, `adopter_id`, `dog_id`) VALUES
(2, '2023-01-10', 'Przerwana', 'Tymczasowa', 'Adoptujący zrezygnował z adopcji.', 3, 11),
(3, '2023-01-20', 'Zaakceptowana', 'Stała', '', 1, 12),
(4, '2023-01-18', 'Zakończona', 'Stała', '', 2, 16),
(5, '2023-01-17', 'Zaakceptowana', 'Stała', '', 4, 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `auth_group`
--

INSERT INTO `auth_group` (`id`, `name`) VALUES
(6, 'Administrator'),
(3, 'Behawiorysta'),
(5, 'Kierownik magazynu'),
(4, 'Magazynier'),
(1, 'Pracownik biurowy'),
(2, 'Weterynarz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auth_user`
--

CREATE TABLE `auth_user` (
  `id` int NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `group_id` int NOT NULL,
  `date_joined` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `auth_user`
--

INSERT INTO `auth_user` (`id`, `password`, `username`, `first_name`, `last_name`, `group_id`, `date_joined`) VALUES
(1, 'YWRtaW4=', 'admin', 'Mirosław', 'Szpak', 6, '2023-01-06 19:56:17.000000'),
(2, 'amFuZWsxMjM=', 'jkowalski', 'Jan', 'Kowalski', 2, '2023-01-06 20:26:57.000000'),
(3, 'YW5pYTEyMw==', 'akowalska', 'Anna', 'Kowalska', 1, '2023-01-06 20:26:57.000000'),
(4, 'YWRyaWFuMTIz', 'anowak', 'Adrian', 'Nowak', 3, '2023-01-16 14:50:11.000000'),
(5, 'amFkemlhMTIz', 'jhymel', 'Jadwiga', 'Hymel', 5, '2023-01-01 14:52:10.000000'),
(6, 'ZmlmaTEyMw==', 'fkrzak', 'Filip', 'Krzak', 4, '2023-01-15 14:53:59.000000');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dog`
--

CREATE TABLE `dog` (
  `id` bigint NOT NULL,
  `admission_date` date NOT NULL,
  `box_number` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `age` varchar(45) NOT NULL,
  `breed` varchar(45) NOT NULL,
  `chip_number` varchar(45) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `alergies` longtext,
  `diseases` longtext,
  `picture` varchar(100) DEFAULT NULL,
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `dog`
--

INSERT INTO `dog` (`id`, `admission_date`, `box_number`, `name`, `gender`, `birthdate`, `age`, `breed`, `chip_number`, `status`, `alergies`, `diseases`, `picture`, `description`) VALUES
(1, '2023-01-01', 23, 'Burek', 'Samiec', '2021-01-10', '2 lata', 'Mieszaniec', '139013279830360', 'Przyjęty', '', '', '6933747b486ca5dc28d9413abe4e.jfif', ''),
(11, '2023-01-10', 20, 'Loki', 'Samiec', '2022-10-01', '3 miesiące', 'Mieszaniec', '542227254912573', 'Kwarantanna', '', 'kaszel kennelowy', 'Nierasowy-pies-o-czym-pamietac-przed-adopcja.jpg', ''),
(12, '2023-01-16', 12, 'Kira', 'Samica', '2021-01-02', '2 lata', 'Husky Syberyjski', '470749825962240', 'Zaadoptowany', '', '', 'siberian-husky-1.jpg', ''),
(14, '2023-01-05', 1, 'Azor', 'Samiec', '2019-06-04', '3 lata', 'Amerykański pitbulterier', '469293492730554', 'Do adopcji', 'nabiał, mięso kurcząt', '', 'black-dog-1331669.jpg', 'Pies agresywny względem innych zwierząt.'),
(15, '2023-01-05', 5, 'Edward', 'Samica', '2022-09-01', '4 miesiące', 'Amerykański pitbulterier', '857415630256840', 'Do adopcji', '', '', 'dog-bob-1405735.jpg', 'Pies strachliwy wzlędem ludzi.'),
(16, '2023-01-13', 9, 'Maczo', 'Samiec', '2018-06-08', '4 lata', 'Mieszaniec', '304731934251803', 'Zaadoptowany', '', '', 'miki-39.jpg', ''),
(17, '2023-01-13', 16, 'Chojrak', 'Samica', '2015-12-29', '7 lat', 'Mieszaniec', '962415733940305', 'Do adopcji', '', 'dysplazja stawów biodrowych', 'img-5655-252068.jpg', ''),
(18, '2023-01-08', 18, 'Goofy', 'Samiec', '2014-11-14', '8 lat', 'Jamnik', '669293252360254', 'Zaadoptowany', '', '', 'Jamnik-miniaturka-charakter-szczeniaki-ile-żyje.jpg', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `healthcard`
--

CREATE TABLE `healthcard` (
  `id` bigint NOT NULL,
  `action` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `notes` longtext NOT NULL,
  `dog_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `healthcard`
--

INSERT INTO `healthcard` (`id`, `action`, `category`, `type`, `date`, `notes`, `dog_id`) VALUES
(1, 'Szczepienie na wściekliznę', 'Weterynaryjna', 'Szczepienie', '2023-01-06', '', 1),
(3, 'Szczepienie na wściekliznę', 'Weterynaryjna', 'Szczepienie', '2023-01-13', '', 11),
(4, 'Terapia behawioralna', 'Behawioralna', 'Terapia', '2023-01-14', '', 11),
(5, 'Terapia behawioralna', 'Behawioralna', 'Terapia', '2023-01-17', '', 11),
(6, 'Zabieg sterylizacji', 'Weterynaryjna', 'Zabieg', '2023-01-18', '', 12),
(9, 'Podanie leków na kaszel kennelowy', 'Weterynaryjna', 'Zabieg', '2023-01-11', '', 11),
(10, 'Szczepienie na wściekliznę', 'Weterynaryjna', 'Szczepienie', '2023-01-06', '', 14),
(11, 'Szczepienie na wściekliznę', 'Weterynaryjna', 'Szczepienie', '2023-01-06', '', 15),
(12, 'Szczepienie na wściekliznę', 'Weterynaryjna', 'Szczepienie', '2023-01-14', '', 16),
(13, 'Szczepienie na wściekliznę', 'Weterynaryjna', 'Szczepienie', '2023-01-14', '', 17),
(14, 'Zabieg sterylizacji', 'Weterynaryjna', 'Zabieg', '2023-01-15', '', 17),
(15, 'Terapia behawioralna', 'Behawioralna', 'Terapia', '2023-01-07', '', 15),
(16, 'Terapia behawioralna', 'Behawioralna', 'Terapia', '2023-01-10', '', 15),
(17, 'Terapia behawioralna', 'Behawioralna', 'Terapia', '2023-01-07', '', 14),
(18, 'Terapia behawioralna', 'Behawioralna', 'Terapia', '2023-01-10', '', 14),
(19, 'Szczepienie na wściekliznę', 'Weterynaryjna', 'Szczepienie', '2023-01-19', '', 18),
(20, 'Odrobaczenie 1/2', 'Weterynaryjna', 'Odrobaczanie', '2022-12-28', '', 12),
(21, 'Odrobaczenie 2/2', 'Weterynaryjna', 'Odrobaczanie', '2023-01-11', '', 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `medicine`
--

CREATE TABLE `medicine` (
  `id` bigint NOT NULL,
  `dosage` varchar(45) NOT NULL,
  `entry_id` bigint NOT NULL,
  `product_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `medicine`
--

INSERT INTO `medicine` (`id`, `dosage`, `entry_id`, `product_id`) VALUES
(8, '20ml', 6, 16),
(9, '20ml', 14, 16),
(10, '2', 20, 17),
(11, '2', 21, 17);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` bigint NOT NULL,
  `name` varchar(45) NOT NULL,
  `manufacturer` varchar(45) NOT NULL,
  `quantity` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `name`, `manufacturer`, `quantity`, `category`, `type`) VALUES
(1, 'Veterinary Canine Gastrointestinal', 'VetPro', '30kg', 'Karma', 'Sucha'),
(3, 'Adult Blue River', 'Wolf of Wilderness', '30kg', 'Karma', 'Sucha'),
(4, 'Wild Freedom Adult Deep Forest', 'Wild Freedom', '1kg', 'Karma', 'Mokra'),
(5, 'Proszek z nowozelandzkiego małża zielonego', 'Dibo', '700g', 'Witaminy', 'Proszek'),
(8, 'Karma sucha dla seniorów', 'VetPro', '15kg', 'Karma', 'Sucha'),
(16, 'Narkotix', 'VetPro', '100ml', 'Środek leczniczy', 'Płyn'),
(17, 'InPar dla psów', 'VetAgro', '4szt', 'Środek leczniczy', 'Tabletki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `warehouse`
--

CREATE TABLE `warehouse` (
  `id` bigint NOT NULL,
  `arrival_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `quantity` int NOT NULL,
  `product_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Zrzut danych tabeli `warehouse`
--

INSERT INTO `warehouse` (`id`, `arrival_date`, `expiry_date`, `quantity`, `product_id`) VALUES
(1, '2023-01-06', '2024-04-23', 1, 1),
(2, '2023-01-10', '2023-08-01', 11, 4),
(4, '2023-01-01', '2026-07-18', 20, 16),
(5, '2023-01-03', '2025-05-15', 5, 8),
(6, '2023-01-04', '2025-04-23', 15, 4),
(7, '2023-01-09', '2026-03-30', 5, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adopter`
--
ALTER TABLE `adopter`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_shelter_app_a_adopter_id_3cf0b0ee_fk_animal_sh` (`adopter_id`),
  ADD KEY `animal_shelter_app_a_dog_id_025ea1d2_fk_animal_sh` (`dog_id`);

--
-- Indeksy dla tabeli `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `auth_user_group_id_b120cbf9_fk_auth_group_id` (`group_id`);

--
-- Indeksy dla tabeli `dog`
--
ALTER TABLE `dog`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `healthcard`
--
ALTER TABLE `healthcard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_shelter_app_h_dog_id_bfd764f4_fk_animal_sh` (`dog_id`);

--
-- Indeksy dla tabeli `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_shelter_app_m_entry_id_55f1b8fa_fk_animal_sh` (`entry_id`),
  ADD KEY `animal_shelter_app_m_product_id_6c3590de_fk_animal_sh` (`product_id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_shelter_app_w_product_id_98682312_fk_animal_sh` (`product_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `adopter`
--
ALTER TABLE `adopter`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `dog`
--
ALTER TABLE `dog`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `healthcard`
--
ALTER TABLE `healthcard`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `animal_shelter_app_a_adopter_id_3cf0b0ee_fk_animal_sh` FOREIGN KEY (`adopter_id`) REFERENCES `adopter` (`id`),
  ADD CONSTRAINT `animal_shelter_app_a_dog_id_025ea1d2_fk_animal_sh` FOREIGN KEY (`dog_id`) REFERENCES `dog` (`id`);

--
-- Ograniczenia dla tabeli `auth_user`
--
ALTER TABLE `auth_user`
  ADD CONSTRAINT `auth_user_group_id_b120cbf9_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`);

--
-- Ograniczenia dla tabeli `healthcard`
--
ALTER TABLE `healthcard`
  ADD CONSTRAINT `animal_shelter_app_h_dog_id_bfd764f4_fk_animal_sh` FOREIGN KEY (`dog_id`) REFERENCES `dog` (`id`);

--
-- Ograniczenia dla tabeli `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`entry_id`) REFERENCES `healthcard` (`id`),
  ADD CONSTRAINT `medicine_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Ograniczenia dla tabeli `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
