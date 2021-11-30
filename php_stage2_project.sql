-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 30 2021 г., 09:48
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php_stage2_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `url`, `title`, `description`) VALUES
(1, 'Films', 'Фильмы', 'Фильмы бла бла бла'),
(2, 'Serials', 'Сериалы', 'Сериалы бла бла бла');

-- --------------------------------------------------------

--
-- Структура таблицы `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `cid` int(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `descr_min` varchar(1024) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info`
--

INSERT INTO `info` (`id`, `cid`, `title`, `url`, `descr_min`, `description`, `image`) VALUES
(1, 1, 'Матрица', 'matrix', 'Боевик, Фантастика', 'Мир Матрицы — это иллюзия, существующая только в бесконечном сне обреченного человечества. Холодный мир будущего, в котором люди — всего лишь батарейки в компьютерных системах.', 'matrix.png'),
(2, 1, 'Безумный Макс', 'mad max', 'Боевик', 'В недалёком будущем, после крупной катастрофы, поразившей нашу урбанистическую цивилизацию, вся жизнь сосредоточилась вдоль бесчисленных магистралей. Дорога стала способом существования. И дала многим возможность проявлять свои самые жестокие инстинкты. Банда байкеров на мощных мотоциклах, желая рассчитаться за своего убитого товарища, преследует молодого полицейского Макса. Жертвой их мести становится лучший друг Макса, и та же участь грозит самому Максу и его семье…', 'madmax.png'),
(3, 1, 'Пираты Карибского моря', 'PKM', 'Боевик, Приключение', 'Жизнь харизматичного авантюриста, капитана Джека Воробья, полная увлекательных приключений, резко меняется, когда его заклятый враг — капитан Барбосса — похищает корабль Джека, Черную Жемчужину, а затем нападает на Порт Ройал и крадет прекрасную дочь губернатора, Элизабет Свонн.', 'pirats.png'),
(4, 2, 'Теория Большого взрыва', 'TBB', 'Ситком, Комедия', 'Леонард Хофстадтер и Шелдон Купер в детстве были вундеркиндами и, став взрослыми, решили посвятить себя науке. Они оба — выпускники Калифорнийского технологического института, окончив который, стали работать в одном из ведущих физических институтов. Леонард — на кафедре экспериментальной физики, а Шелдон — как физик-теоретик. Они живут в одной квартире, вместе работают и свободное от исследовательской деятельности время тоже проводят вместе. Их любимые развлечения — просмотр научно-фантастических сериалов, чтение комиксов о супергероях и компьютерные игры. А больше всего они любят спорить на научные темы и доказывать друг другу свою правоту.', 'tbw.png'),
(5, 2, 'Ходящие мертвецы', 'WD', 'Боевик, Приключение, Ужасы', '«Ходячие мертвецы» — это история выживания в постапокалиптическом мире, которая показывает, что живые, разумные существа, доведенные до отчаяния, могут стать еще более опасными, чем ходячие трупы.', 'hodmertw.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hash` varchar(32) NOT NULL DEFAULT '',
  `ip` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `hash`, `ip`) VALUES
(3, 'admin2', '63ee451939ed580ef3c4b6f0109d1fd0', '47a20d2377f53b25ee06121fc6fa7048', 2130706433),
(7, 'viach', '63ee451939ed580ef3c4b6f0109d1fd0', '8817a89b0e739805ef6fb2b5113867e1', 2130706433);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
