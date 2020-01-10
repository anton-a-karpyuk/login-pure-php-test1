-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

DROP DATABASE IF EXISTS test1;

CREATE DATABASE test1
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

--
-- Установка базы данных по умолчанию
--
USE test1;

--
-- Создать таблицу `users`
--
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(255) NOT NULL,
  username varchar(50) NOT NULL,
  hashed_password varchar(255) NOT NULL,
  first_name varchar(255) DEFAULT NULL,
  last_name varchar(255) DEFAULT NULL,
  father_name varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 5,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_general_ci;

--
-- Создать индекс `UK_users_email` для объекта типа таблица `users`
--
ALTER TABLE users
ADD UNIQUE INDEX UK_users_email (email);

--
-- Создать индекс `UK_users_username` для объекта типа таблица `users`
--
ALTER TABLE users
ADD UNIQUE INDEX UK_users_username (username);

CREATE USER 'test1'@'localhost' IDENTIFIED WITH mysql_native_password PASSWORD EXPIRE DEFAULT;
GRANT Select, Insert, Update, Delete, Create, Drop, Grant Option, References, Index, Alter, Create Temporary Tables, Lock Tables, Create View, Show View, Create Routine, Alter Routine, Execute, Event, Trigger ON  test1.* TO 'test1'@'localhost';

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;