CREATE TABLE product (
  id_code int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  code varchar(10) NOT NULL,
  name varchar(75) NOT NULL,
  price double(9,2) NOT NULL,
  quantity int(10) NOT NULL,
  PRIMARY KEY (id_code),
  UNIQUE KEY (code),
  UNIQUE KEY (name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO product (id_code, code, name, price, quantity) VALUES
(1, '1234567', 'Хлеб \"Обеденный домашний\"', 7.25, 45),
(2, '6478392', 'Булка с маком', 10.15, 25),
(3, '8936274', 'Печенье', 50.35, 15),
(4, '6294739', 'Рулет с повидлом', 12.75, 32),
(5, '7364920', 'Лаваш', 10.55, 15),
(6, '5395021', 'Печенье \"Шахматное\"', 45.30, 10),
(7, '2432247', 'Хлеб \"Новосельский\"', 50.50, 3),
(8, '3425244', 'Хлеб \"Семейный\"', 23.50, 12),
(9, '8348768', 'Хлеб \"Белково-пшеничный\"', 13.50, 25),
(10, '2347834', 'Хлеб \"Бориславский\"', 15.30, 15),
(11, '2457834', 'Хлеб \"Медовый безжрожжевой\"', 25.70, 5),
(12, '5687972', 'Пряник Новомосковский', 35.70, 57),
(13, '3568797', 'Печиво Овсяное', 55.70, 37),
(14, '9348754', 'Пряник Пчелка', 87.30, 29),
(15, '9448754', 'Печенье Витушки', 97.90, 19),
(16, '4448754', 'Сухари Киевские', 7.40, 10),
(17, '4548744', 'Печенье ПРЕЛЕСТЬ', 18.40, 21),
(18, '3549744', 'Хлеб \"Братиславский\"', 11.40, 11),
(19, '2749744', 'Хлеб \"Хаджибеевский\"', 13.40, 12),
(20, '5549755', 'Калач \"Рождественский\"', 17.20, 5),
(21, '3242345', 'Плетенка с маком', 14.50, 20);


CREATE TABLE `sessions` (
  `id_session` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `sid` varchar(10) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_last` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `sessions` (`id_session`, `id_user`, `sid`, `time_start`, `time_last`) VALUES
(29, 1, 'IMh7JMlHGB', '2019-05-30 14:33:12', '2019-05-30 15:06:18'),
(27, 1, 'cqOMRT2aA6', '2019-05-28 00:55:53', '2019-05-30 14:17:52'),
(28, 2, 'nsNG9meWCR', '2019-05-30 14:32:49', '2019-05-30 14:32:49');

CREATE TABLE `users` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `fio` varchar(255) NOT NULL,
  `login` varchar(256) NOT NULL,
  `password` varchar(32) NOT NULL,
  `access_level` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id_user`, `fio`, `login`, `password`, `access_level`) VALUES
(1, 'Иван', 'admin', 'b0baee9d279d34fa1dfd71aadb908c3f', 7),
(2, 'Петька', 'user', '3d2172418ce305c7d16d4b05597c6a59', 5),
(3, 'Vanya', 'user1', 'b7bc2a2f5bb6d521e64c8974c143e9a0', 0);

ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id_session`),
  ADD UNIQUE KEY `sid` (`sid`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`);

ALTER TABLE `sessions`
  MODIFY `id_session` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

ALTER TABLE `users`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
