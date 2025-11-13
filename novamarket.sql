-- -----------------------------------------------------
-- Base de datos: novamarket
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `novamarket` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `novamarket`;

-- -----------------------------------------------------
-- Estructura de tabla para la tabla `usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `correo` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Inserción de un usuario de prueba
-- -----------------------------------------------------
INSERT INTO `usuarios` (`nombre`, `correo`, `password`) 
VALUES ('Admin Demo', 'admin@novamarket.com', '$2y$10$eCbnQ/1hOogR.VxQy4AGxeJviD/3gUoEd8MUtO/7P6N8C0G1vwK7u');

-- Contraseña del usuario de prueba: admin123
