

CREATE TABLE `basket` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL,
  `quantity` int(8) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_user` (`ID_user`),
  KEY `ID_product` (`ID_product`),
  CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID`),
  CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8mb4;

INSERT INTO basket VALUES("202","30","10","1");
INSERT INTO basket VALUES("203","30","11","4");
INSERT INTO basket VALUES("205","1","5","9");





CREATE TABLE `filling` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO filling VALUES("1","Неуказанный");
INSERT INTO filling VALUES("2","Шоколадная");
INSERT INTO filling VALUES("3","Карамельная");
INSERT INTO filling VALUES("4","Фруктовая");
INSERT INTO filling VALUES("5","Крем-брюле");
INSERT INTO filling VALUES("6","Ванильная");
INSERT INTO filling VALUES("7","Кокосовая");
INSERT INTO filling VALUES("8","Ореховая");
INSERT INTO filling VALUES("9","Мятная");
INSERT INTO filling VALUES("10","Фисташковая");
INSERT INTO filling VALUES("11","Малиновая");





CREATE TABLE `ingredients` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock_balance` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO ingredients VALUES("1","Шоколадная крошка","0.00","0");
INSERT INTO ingredients VALUES("2","Карамельный сироп","0.00","0");
INSERT INTO ingredients VALUES("3","Фруктовый йогурт","0.00","0");
INSERT INTO ingredients VALUES("4","Кокосовая стружка","0.00","0");
INSERT INTO ingredients VALUES("5","Ореховая крошка","0.00","0");
INSERT INTO ingredients VALUES("6","Сливочное масло","0.00","0");
INSERT INTO ingredients VALUES("7","Сахарная пудра","0.00","0");
INSERT INTO ingredients VALUES("8","Ванильный экстракт","0.00","0");
INSERT INTO ingredients VALUES("9","Кукурузный крахмал","0.00","0");
INSERT INTO ingredients VALUES("10","Мука высшего сорта","0.00","0");
INSERT INTO ingredients VALUES("11","Изюм","0.00","0");
INSERT INTO ingredients VALUES("12","Семена подсолнечника","0.00","0");
INSERT INTO ingredients VALUES("13","Мед","0.00","0");
INSERT INTO ingredients VALUES("14","Орехи пекан","0.00","0");
INSERT INTO ingredients VALUES("15","Сода","0.00","0");
INSERT INTO ingredients VALUES("16","Разрыхлитель теста","0.00","0");
INSERT INTO ingredients VALUES("17","Какао-порошок","0.00","0");
INSERT INTO ingredients VALUES("18","Кукурузный сироп","0.00","0");
INSERT INTO ingredients VALUES("19","Цедра лимона","0.00","0");





CREATE TABLE `ordered_products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_order` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_order` (`ID_order`),
  KEY `ID_product` (`ID_product`),
  CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`ID_order`) REFERENCES `orders` (`ID`),
  CONSTRAINT `ordered_products_ibfk_2` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO ordered_products VALUES("1","2","3","5");
INSERT INTO ordered_products VALUES("2","3","3","5");
INSERT INTO ordered_products VALUES("3","4","3","5");
INSERT INTO ordered_products VALUES("4","4","8","1");





CREATE TABLE `orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `address` varchar(1028) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `receipt_date` datetime NOT NULL,
  `comment` varchar(4096) NOT NULL,
  `total_price` int(16) NOT NULL,
  `ID_status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `assembly_at` datetime DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_status` (`ID_status`),
  KEY `ID_user` (`ID_user`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO orders VALUES("2","3","Емельянова","Василиса","masking20531@gmail.com","г Москва, ул Нежинская, дом 8","+7(950) 463-07-32","2023-06-24 00:00:00","Это комментарий","0","1","2023-06-23 00:11:24","","");
INSERT INTO orders VALUES("3","3","Емельянова","Василиса","masking20531@gmail.com","г Москва, ул Нежинская, дом 8","+7(950) 463-07-32","2023-06-24 00:00:00","Это комментарий","0","1","2023-06-23 00:12:30","","");
INSERT INTO orders VALUES("4","3","Админов","Александр","masking20531@gmail.com","г Москва, пр-кт Нахимовский, дом 32","+7(235) 553-25-74","2023-06-29 00:00:00","Это тоже коммент","0","1","2023-06-23 00:16:52","","");





CREATE TABLE `product-filling` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_product` int(11) NOT NULL,
  `ID_filling` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_filling` (`ID_filling`),
  KEY `ID_product` (`ID_product`),
  CONSTRAINT `product-filling_ibfk_1` FOREIGN KEY (`ID_filling`) REFERENCES `filling` (`ID`),
  CONSTRAINT `product-filling_ibfk_2` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

INSERT INTO product-filling VALUES("1","7","1");
INSERT INTO product-filling VALUES("2","9","1");
INSERT INTO product-filling VALUES("3","3","3");
INSERT INTO product-filling VALUES("4","3","4");
INSERT INTO product-filling VALUES("5","8","4");
INSERT INTO product-filling VALUES("6","5","5");
INSERT INTO product-filling VALUES("7","6","8");
INSERT INTO product-filling VALUES("9","23","2");
INSERT INTO product-filling VALUES("23","38","6");
INSERT INTO product-filling VALUES("24","39","4");
INSERT INTO product-filling VALUES("25","39","6");
INSERT INTO product-filling VALUES("26","39","7");
INSERT INTO product-filling VALUES("27","39","9");
INSERT INTO product-filling VALUES("28","40","3");
INSERT INTO product-filling VALUES("29","40","5");
INSERT INTO product-filling VALUES("34","45","3");
INSERT INTO product-filling VALUES("35","45","11");
INSERT INTO product-filling VALUES("54","46","1");
INSERT INTO product-filling VALUES("55","44","4");
INSERT INTO product-filling VALUES("56","44","5");





CREATE TABLE `product-image` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_product` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_product` (`ID_product`),
  CONSTRAINT `product-image_ibfk_1` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4;

INSERT INTO product-image VALUES("1","3","cake.png");
INSERT INTO product-image VALUES("2","7","cake.png");
INSERT INTO product-image VALUES("3","6","cake.png");
INSERT INTO product-image VALUES("4","8","desert-1.jpg");
INSERT INTO product-image VALUES("5","8","desert-2.jpg");
INSERT INTO product-image VALUES("6","8","desert-3.jpg");
INSERT INTO product-image VALUES("7","5","desert-5.jpg");
INSERT INTO product-image VALUES("12","9","cake.png");
INSERT INTO product-image VALUES("14","11","cake.png");





CREATE TABLE `product-ingredient` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ingredient` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_ingredient` (`ID_ingredient`),
  KEY `ID_product` (`ID_product`),
  CONSTRAINT `product-ingredient_ibfk_1` FOREIGN KEY (`ID_ingredient`) REFERENCES `ingredients` (`ID`),
  CONSTRAINT `product-ingredient_ibfk_2` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO product-ingredient VALUES("1","2","8","10");
INSERT INTO product-ingredient VALUES("2","7","8","10");





CREATE TABLE `product_category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO product_category VALUES("1","Неуказанный");
INSERT INTO product_category VALUES("2","Шоколадные изделия");
INSERT INTO product_category VALUES("3","Торты и пирожные");
INSERT INTO product_category VALUES("4","Мороженое");
INSERT INTO product_category VALUES("5","Конфеты и карамели");
INSERT INTO product_category VALUES("6","Попкорн и чипсы");
INSERT INTO product_category VALUES("7","Вафельные изделия");
INSERT INTO product_category VALUES("8","Сладкие снеки");
INSERT INTO product_category VALUES("9","Выпечка");
INSERT INTO product_category VALUES("10","Украшения для десертов");
INSERT INTO product_category VALUES("11","Печенье и пряники");





CREATE TABLE `product_size` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO product_size VALUES("1","Неуказанный");
INSERT INTO product_size VALUES("2","S");
INSERT INTO product_size VALUES("3","M");
INSERT INTO product_size VALUES("4","L");
INSERT INTO product_size VALUES("5","XL");
INSERT INTO product_size VALUES("6","2XL");





CREATE TABLE `products` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL DEFAULT 0,
  `price` decimal(8,2) NOT NULL,
  `stock_balance` int(11) NOT NULL,
  `description` varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipe` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_size` int(11) NOT NULL DEFAULT 6,
  `ID_category` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_category` (`ID_category`),
  KEY `ID_size` (`ID_size`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`ID_category`) REFERENCES `product_category` (`ID`),
  CONSTRAINT `products_ibfk_3` FOREIGN KEY (`ID_size`) REFERENCES `product_size` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("3","Тирамису","250","1000.00","10","diosndvnklsvnds","","1","1");
INSERT INTO products VALUES("5","Шоколадный торт","260","2500.00","100","diosndvnklsvnds","","2","1");
INSERT INTO products VALUES("6","Панна-котта","10","900.00","10","diosndvnklsvnds","","6","1");
INSERT INTO products VALUES("7","Классический чизкейк","200","1500.00","10","diosndvnklsvnds","","1","1");
INSERT INTO products VALUES("8","Фондан","320","3400.00","10","diosndvnklsvnds","","1","3");
INSERT INTO products VALUES("9","Торт наполеон","320","3400.00","10","diosndvnklsvnds","","1","1");
INSERT INTO products VALUES("10","Гуакамоле ","320","3400.00","10","diosndvnklsvnds","","1","1");
INSERT INTO products VALUES("11","Торт песочный","200","1500.00","10","diosndvnklsvnds","","1","1");
INSERT INTO products VALUES("13","Малиновый чизкейк","120","350.00","0","Самый вкусный чизкейк в вашей жизни","","3","3");
INSERT INTO products VALUES("17","Морковный чизкейк","120","350.00","3","Простой, но несомненно вкусный","","2","3");
INSERT INTO products VALUES("23","Шоколадный чизкейк","120","300.00","12","Простой, но вкусный","","2","3");
INSERT INTO products VALUES("38","Классический чизкейк ","120","300.00","0","Простой, но такой эксклюзивный","","2","3");
INSERT INTO products VALUES("39","Тропическая фантазия","300","650.00","1"," Этот десерт привнесет в ваше меню нотки экзотики и летнего настроения. Кусочки свежих фруктов, посыпанных хрустящей кокосовой стружкой, легко сочетаются с нежным ванильным соусом. Добавьте свежую мяту для аромата и украшения - и ваша \"Тропическая фантазия\" готова к подаче.","1. Подготовьте фрукты: очистите манго, ананас и киви от кожуры и нарежьте на кусочки.
2. На дно тарелки выложите кусочки фруктов.
3. Посыпьте кокосовой стружкой.
4. Добавьте небольшое количество ванильного соуса сверху.
5. Украсьте десерт свежей мятой.
6. Готовый десерт можно подавать на стол, наслаждаясь его вкусом и ароматом.","4","3");
INSERT INTO products VALUES("40","Карамельный пирог","200","250.00","0","Карамельный пирог - это сочный и сладкий десерт с нежной карамельной начинкой. Этот десерт идеально подходит для любителей карамели и тех, кто любит наслаждаться сладкими лакомствами.","1. Приготовьте слоеное тесто или используйте готовое.
2. Взбейте 2 яйца с 150 граммами сахара до пышной массы.
3. Добавьте 200 миллилитров сливок и 100 грамм меда в яичную смесь и хорошо перемешайте.
4. Растопите 100 грамм сливочного масла и 200 грамм коричневого сахара на водяной бане, добавьте карамель в яичную смесь и снова хорошо перемешайте.
5. Раскатайте тесто и выложите его в форму для пирога, залейте карамельную начинку и выпекайте в разогретой до 180 градусов духовке в течение 20-25 минут.
6. Дайте пирогу остыть и подавайте с клубничным джемом и взбитыми сливками.","3","9");
INSERT INTO products VALUES("44"," Ванильный рулет","200","250.00","0","Ванильный рулет - это классический десерт с нежным ванильным вкусом и легкой текстурой. Этот десерт идеально подходит для любителей классических вкусов и тех, кто любит наслаждаться легкими сладкими лакомствами.","1. Взбейте 4 яйца с 150 граммами сахара до пышной массы.
2. Добавьте 150 грамм муки и 1 чайную ложку разрыхлителя в яичную смесь и хорошо перемешайте.
3. Выложите тесто на противень, покрытый бумагой для выпечки, и выпекайте в разогретой до 180 градусов духовке в течение 10-12 минут.
4. Остудите тесто и смажьте его ванильным кремом.
5. Сверните тесто в рулет и посыпьте сверху сахарной пудрой.
6. Подавайте ванильный рулет с клубничным джемом и взбитыми сливками.","3","3");
INSERT INTO products VALUES("45","Малиновый трюфельный диванчик","150","400.00","0","Этот тарт изготовлен из крошечного, хрустящего коржа, который наполнен густым шоколадным топпингом и украшен свежей малиной и тонкой карамелью","1. Подготовьте форму для выпечки тарта и разогрейте духовку до 180 градусов.

2. Измельчите печенье в крошку и смешайте с расплавленным маслом. Разложите полученную смесь на дно формы и равномерно распределите. Выпекайте в духовке 8-10 минут.

3. Растопите шоколад вместе со сливками на водяной бане, постоянно помешивая. Дайте смеси остыть.

4. Взбейте яйца с сахаром до образования густой пены. Постепенно добавляйте шоколадную смесь и перемешивайте до однородности.

5. Вылейте полученную смесь на подготовленный корж из печенья. Выпекайте тарт в духовке в течение 20-25 минут.

6. Дайте тарту остыть, затем украсьте свежей малиной и карамелью. ","2","3");
INSERT INTO products VALUES("46","Шоколадно-Малиновый Деликатес","300","650.00","0","Нежный и ароматный десерт, состоящий из двух слоев - шоколадного бисквита и малинового крема. Покрыт сверху шоколадной глазурью и украшен свежими ягодами малины. ","1. Для бисквита взбейте яйца с сахаром до густой пены. 
2. Добавьте просеянную муку и какао-порошок, аккуратно перемешивая. 
3. Вылейте тесто в форму для выпечки и выпекайте в разогретой до 180 градусов духовке в течение 20 минут. 
4. Для малинового крема размягчите желатин в холодной воде. 
5. Взбейте сливки с сахаром до плотной консистенции. 
6. Перемешайте малины и сахар в блендере до получения однородной массы. 
7. Разогрейте полученную малиновую массу в кастрюле и добавьте размягченный желатин, перемешивая до полного растворения желатина. 
8. Смешайте малиновую массу со взбитыми сливками. 
9. Выложите малиновый крем на бисквит и оставьте в холодильнике на 2 часа, чтобы крем застыл. 
10. Для шоколадной глазури растопите шоколад вместе со сливками на водяной бане. 
11. Выньте десерт из холодильника и покройте его шоколадной глазурью. 
12. Украсьте десерт свежими ягодами малины. ","3","3");





CREATE TABLE `provider` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `provider-ingradient` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_provider` int(11) NOT NULL,
  `ID_ingredient` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_provider` (`ID_provider`),
  KEY `ID_ingredient` (`ID_ingredient`),
  CONSTRAINT `provider-ingradient_ibfk_1` FOREIGN KEY (`ID_provider`) REFERENCES `provider` (`ID`),
  CONSTRAINT `provider-ingradient_ibfk_2` FOREIGN KEY (`ID_ingredient`) REFERENCES `ingredients` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `provider-product` (
  `ID` int(11) NOT NULL,
  `ID_provider` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL,
  KEY `ID_product` (`ID_product`),
  KEY `ID_provider` (`ID_provider`),
  CONSTRAINT `provider-product_ibfk_1` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`),
  CONSTRAINT `provider-product_ibfk_2` FOREIGN KEY (`ID_provider`) REFERENCES `provider` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `user_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO user_status VALUES("1","Новый");
INSERT INTO user_status VALUES("2","Подтверждённый");
INSERT INTO user_status VALUES("3","Заблокированный");
INSERT INTO user_status VALUES("4","Редактор");
INSERT INTO user_status VALUES("5","Администратор");





CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(12) NOT NULL,
  `ID_status` int(11) NOT NULL DEFAULT 1,
  `address` varchar(1024) NOT NULL,
  `password` varchar(512) NOT NULL,
  `hash` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_status` (`ID_status`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ID_status`) REFERENCES `user_status` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("1","User-1","Nom-non","User-1@gmail.com","2","2007-04-01","+88005553535","1","Респ Крым, г Алушта, с Лучистое, ул Смешная, ","8d8f2628cfce1853efc0d027be4f6ce4","");
INSERT INTO users VALUES("3","admin","","masking20531@gmail.com","1","0000-00-00","","5","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("4","жора","","31@gmail.com","1","0000-00-00","","1","","8d8f2628cfce1853efc0d027be4f6ce4","");
INSERT INTO users VALUES("5","Иван","","@iva.com","1","0000-00-00","","1","","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("6","Мишель","Емельянова","@emdetei.com","2","2023-06-03","999999999","1","край Пермский, г Добрянкад Боровково, ул Героя Лядова, дом 10","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("7","Наталья","","@nataha","2","0000-00-00","","1","","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("8","Мишаня","","@miha.com","1","0000-00-00","","1","","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("9","User-1","Nom-non","ne-user-1@","1","0000-00-00","","1","","0c158322512ca53033b9387d4ae0c9aa","");
INSERT INTO users VALUES("10","жанна","","\"\"\"\"\"\"\"\"\"\"2@","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("11","nanan","fasfaf","@ppppppppppppppp","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("12","nanan","fasfaf","@qqqqqqqqqqqqqqqqqq","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("13","nanan","fasfaf","@wwwwwww","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("14","nanan","fasfaf","@qqqqqqqqqqqqqqqqqqqqqqqqq","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("15","nanan","fasfaf","@qqwfdscs","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("16","Эрик-2","Давидыч","@dava.com","1","2023-05-12","+797777","1","0x121cfc9cb22292833cecf263fcb2f58a4fa931d9","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("17","Не Эрик","Давидыч","@wqfeogoepg","1","0000-00-00","","1","0x121cfc9cb22292833cecf263fcb2f58a4fa931d9","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("18","Мишень","Емельянова","iuui@jjpjoj","1","0000-00-00","","1","край Пермский, г Добрянкад Боровково, ул Героя Лядова, дом 10","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("19","sqdwefvbg","","@fewngkgnk","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("20","мышь","","qwerty123@","1","0000-00-00","","1","","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("21","мышишь","","qwerty1234@","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("22","мышишь2","","qwerty12345@","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("23","isibim3","","йцукен123456@","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("25","номи","","ауатзИПЩДИд@","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("27","жора-2","","ирваитяз@","2","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("30","Новый","Аккаунт","@newacc","1","2023-05-17","03460346","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("31","мышишь3","","qwerty12345@","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("32","мышишь3","","qwerty12345@","1","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("33","чупии","","@degfsgdfbbd","2","0000-00-00","","1","","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("34","Эрик-10
","Давидыч","@dava.com","1","2023-05-12","+797777","1","0x121cfc9cb22292833cecf263fcb2f58a4fa931d9","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("35","Эрик-3","Давидыч","@dava.com","1","2023-05-12","+797777","1","0x121cfc9cb22292833cecf263fcb2f58a4fa931d9","3fc0a7acf087f549ac2b266baf94b8b1","");
INSERT INTO users VALUES("36","Не Эрик","Давидыч","@wqfeogoepg","1","2023-06-16","","1","0x121cfc9cb22292833cecf263fcb2f58a4fa931d9","5a69888814ba29b9c047c759c1469be7","");
INSERT INTO users VALUES("37","эрик-3","укфпп","уфавыа","1","2023-06-10","56545у475","1","","","");
INSERT INTO users VALUES("38","etheth","","","0","0000-00-00","","1","","","");
INSERT INTO users VALUES("39","dndnd","","","1","2023-06-10","","1","","","");
INSERT INTO users VALUES("40","жора-22","","31@gmail.com","1","0000-00-00","","1","","8d8f2628cfce1853efc0d027be4f6ce4","");
INSERT INTO users VALUES("41","жора-54","","31@gmail.com","1","2023-06-23","","1","","8d8f2628cfce1853efc0d027be4f6ce4","");



