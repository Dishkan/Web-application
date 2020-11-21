-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 12 2020 г., 18:03
-- Версия сервера: 5.7.15
-- Версия PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mybase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_articles`
--

CREATE TABLE `lesson_articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro_text` text NOT NULL,
  `full_text` text NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `date` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson_articles`
--

INSERT INTO `lesson_articles` (`id`, `section_id`, `title`, `intro_text`, `full_text`, `meta_desc`, `meta_key`, `date`, `image`) VALUES
(1, 1, 'Функция addslashes', '<p>Экранирует строку с помощью слэшей</p>', 'Возвращает строку, в которой перед каждым спецсимволом добавлен обратный слэш, например, для последующего использования этой строки в запросе к базе данных и т.п. Экранируются одиночная кавычка (\'), двойная кавычка ("), обратный слэш (\\) и NUL (байт NULL). \r\n\r\nФункция addslashes() часто применяется при записи в базу данных. Предположим, если нужно внести в базу данных имя O\'reilly, то эту строку необходимо проэкранировать. Настоятельно рекомендуется использовать функцию экранирования, специфичную для используемой вами базы данных (например, mysqli_real_escape_string() для MySQL или pg_escape_string() для PostgreSQL), но если используемая вами база данных не имеет собственной функции экранирования и для экранирования специальных символов используется символ \\, то для этой цели можно воспользоваться данной функцией. Заметьте, что сам символ \\ в базу данных записан не будет, он используется только для корректной передачи данных в базу. Если директива конфигурации magic_quotes_sybase имеет значение on, то символ одинарной кавычки \' будет экранироваться добавлением еще одной кавычки \' вместо обратного слэша. \r\n\r\nДиректива конфигурации magic_quotes_gpc по умолчанию имеет значение on, при этом функция addslashes() автоматически применяется ко всем данным GET, POST, и COOKIE. Не используйте addslashes() для данных, обработанных magic_quotes_gpc, чтобы избежать двойного экранирования. Для проверки состояния этой директивы используется get_magic_quotes_gpc(). \r\n', 'Функция addslashes в PHP', 'addslashes, addslashes в PHP', 1498205436, '<img src="images/uio.jpg" alt="tre" />'),
(2, 1, 'Функция echo', '<p>Выводит одну или более строк</p>', 'Выводит все аргументы. \r\n\r\nНа самом деле echo() - это не функция, а конструкция языка, поэтому заключать аргументы в скобки необязательно. echo() (в отличии от других языковых конструкций) не ведет себя как функция, поэтому не всегда может быть использована в контексте функции. Вдобавок, если вы хотите передать более одного аргумента в echo(), эти аргументы нельзя заключать в скобки. \r\n\r\necho() имеет также краткую форму, представляющую собой знак равенства, следующий непосредственно за открывающим тэгом. Этот сокращенный синтаксис допустим только когда включена директива конфигурации short_open_tag. \r\n', 'Функция echo в PHP', 'echo, echo php', 1498205887, '<img src="images/dh.jpg" alt="dhe" />'),
(3, 2, 'Функция acos', '<p>Арккосинус</p>', 'float acos ( float $arg )\r\n\r\nВозвращает арккосинус числа arg в радианах. acos() - обратная тригонометрическая функция к cos(), т.е. a==cos(acos(a)) для каждого значения а, входящего в область значений функции acos(). \r\n', 'Функция acos в PHP', 'acos, acos php', 1498206441, '<img src="images/df.jpg" alt="op[" />'),
(4, 2, 'Функция asin', '<p>Арксинус</p>', '\r\nfloat asin ( float $arg )\r\n\r\nВозвращает арксинус числа arg в радианах. asin() - обратная тригонометрическая функция к sin(), т.е. a==sin(asin(a)) для каждого значения a, входящего в область значений функции asin(). \r\n\r\n\r\nСписок параметров\r\n\r\n\r\narg \r\nАргумент функции \r\n\r\n\r\n\r\nВозвращаемые значения\r\n\r\nАрксинус числа arg в радианах. \r\n\r\n\r\nСмотрите также', 'Функция asin в PHP', 'asin, asin php', 1498206622, '<img src="images/dp.jpg" alt="dp" />'),
(5, 2, 'Функция pow', '<p>Возведение в степень</p>', '\r\nnumber pow ( number $base , number $exp )\r\n\r\nВозвращает base, возведенное в степень exp. \r\n\r\n\r\nСписок параметров\r\n\r\n\r\nbase \r\nОснование \r\nexp \r\nПоказатель степени \r\n\r\n\r\n\r\nВозвращаемые значения\r\n\r\nОснование base возведенное в степень exp. Если результат может быть представлен целым числом, то он будет возвращен с типом integer, иначе - с типом float. \r\n\r\n\r\nСписок изменений', 'Функция pow в PHP', 'pow, pow php', 1498206824, '<img src="images/qaz.jpg" alt="qaz" />'),
(6, 3, 'Функция date', '<p>Форматирует вывод системной даты/времени</p>', 'Возвращает строку, отформатированную в соответствии с указанным шаблоном format. Используется метка времени, заданная аргументом timestamp, илитекущее системное время, если timestamp не задан. Таким образом, timestamp являетсянеобязательным и по умолчанию равен значению, возвращаемому функцией time(). ', 'Функция date в PHP', 'date,date в PHP', 1498207416, '<img src="images/we.jpg" alt="we" />');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_banners`
--

CREATE TABLE `lesson_banners` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson_banners`
--

INSERT INTO `lesson_banners` (`id`, `code`) VALUES
(1, 'Тут находится код баннера 1'),
(2, 'Тут находится код баннера 2');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_menu`
--

CREATE TABLE `lesson_menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson_menu`
--

INSERT INTO `lesson_menu` (`id`, `title`, `link`) VALUES
(1, 'Главная', '/'),
(2, 'Строковые функции', '/?view=section&amp;id=1'),
(3, 'Математические функции', '/?view=section&amp;id=2'),
(4, 'Функция даты и времени', '/?view=section&amp;id=3');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_poll`
--

CREATE TABLE `lesson_poll` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson_poll`
--

INSERT INTO `lesson_poll` (`id`, `title`) VALUES
(1, 'Ваш любимый язык программирование');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_poll_variants`
--

CREATE TABLE `lesson_poll_variants` (
  `id` int(11) UNSIGNED NOT NULL,
  `poll_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `votes` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson_poll_variants`
--

INSERT INTO `lesson_poll_variants` (`id`, `poll_id`, `title`, `votes`) VALUES
(1, 1, 'С++', 8),
(2, 1, 'JAVA', 8),
(3, 1, 'PHP', 14);

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_sections`
--

CREATE TABLE `lesson_sections` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson_sections`
--

INSERT INTO `lesson_sections` (`id`, `title`, `description`, `meta_desc`, `meta_key`) VALUES
(1, 'Строковые функции', '<p>PHP, что расшифровывается как "PHP: Hypertext Preprocessor" - «PHP: Препроцессор Гипертекста», является распространенным интерпретируемым языком общего назначения с открытым исходным кодом. PHP создавался специально для ведения Web-разработок и код на нем может внедряться непосредственно в HTML-код. Синтаксис языка берет начало из C, Java и Perl, и является легким для изучения. Основной целью PHP является предоставление web-разработчикам возможности быстрого создания динамически генерируемых web-страниц, однако область применения PHP не ограничивается только этим. \r\n\r\nЭто руководство состоит, главным образом, из  справочника функций, а также содержит справочник языка, комментарии к наиболее важным из отличительных особенностей PHP, и другие дополнительные сведения.</p> \r\n', 'Строковые функции', 'функции php,стрковые функции php'),
(2, 'Математические функции', '<p>Данные функции работают с числами в диапазонах типов integer и float на вашей машине (это соответствует C-типам long и double). Если вам нужно работать с большими числами, обратитесь к разделу математических функций произвольной точности. </p>', 'Математические функции в PHP', 'функции в php,математические функции php'),
(3, 'Функция даты и времени', '<p>Эти функции позволяют получить дату и время с сервера, на котором запущен PHP сценарий. Их можно использовать для форматирования даты и времени различными способами. \r\n\r\nИнформация о дате и времени хранится в памяти ввиде 64-разрядных чисел. Таким образом, поддерживаются все представления даты (включая отрицательные года). Диапазон составляет примерно 292 миллиарда лет в прошлое и будущее. </p>\r\n', 'Функция даты и времени в PHP', 'функции php, функции даты и времени php');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_users`
--

CREATE TABLE `lesson_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `regdate` int(11) UNSIGNED NOT NULL,
  `activation` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson_users`
--

INSERT INTO `lesson_users` (`id`, `login`, `password`, `regdate`, `activation`, `email`) VALUES
(1, 'Dilshod Khudayarov', 'de2ed28e3c1dd462dcc6cd8a8e138dab', 1498901620, '', ''),
(2, 'Tony Stark', 'f05e6ffdbe2e3d7c38d8bc40d856c6aa', 1498906251, '', ''),
(3, 'Timati', '666d96911ee7679c5e945d6f37bd76dc', 1498909832, '', ''),
(4, 'Klava Koka', '666d96911ee7679c5e945d6f37bd76dc', 1498909967, '', ''),
(5, 'Ronaldo', '666d96911ee7679c5e945d6f37bd76dc', 1498914855, '', ''),
(6, 'Messi', 'f1f60480aeff66cbe5c66b088343b1cc', 1499092131, '', ''),
(7, 'Egor Kreed', '20b165ac566d4ff915d33f7f07cc057d', 1499190230, '', ''),
(8, 'Natan', 'de2ed28e3c1dd462dcc6cd8a8e138dab', 1499190403, '', ''),
(9, 'L,ONE', 'de2ed28e3c1dd462dcc6cd8a8e138dab', 1499190518, '', ''),
(11, 'Бред Питт', 'a96a688e45b97ca264fdde8ca64ce1cb', 1499614863, '', ''),
(26, 'Pavel Durov', 'de2ed28e3c1dd462dcc6cd8a8e138dab', 1574961846, '0facd825b4fcd07f403921ba8e437234', 'PV.17@mail.ru'),
(27, 'Peter Pan', 'de2ed28e3c1dd462dcc6cd8a8e138dab', 1577218193, '0ebbd218c40dfc95e225dc77795a3f7d', 'PT17@mail.ru'),
(28, 'Hanckock123', '421b26d0ade10a05b2a72b764fdaf9fb', 1581334296, '71ad8483ec6482b22bdc7cc647513ba0', 'Hk@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lesson_articles`
--
ALTER TABLE `lesson_articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson_banners`
--
ALTER TABLE `lesson_banners`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson_menu`
--
ALTER TABLE `lesson_menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson_poll`
--
ALTER TABLE `lesson_poll`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson_poll_variants`
--
ALTER TABLE `lesson_poll_variants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson_sections`
--
ALTER TABLE `lesson_sections`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson_users`
--
ALTER TABLE `lesson_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lesson_articles`
--
ALTER TABLE `lesson_articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `lesson_banners`
--
ALTER TABLE `lesson_banners`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `lesson_menu`
--
ALTER TABLE `lesson_menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `lesson_poll`
--
ALTER TABLE `lesson_poll`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `lesson_poll_variants`
--
ALTER TABLE `lesson_poll_variants`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `lesson_sections`
--
ALTER TABLE `lesson_sections`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `lesson_users`
--
ALTER TABLE `lesson_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
