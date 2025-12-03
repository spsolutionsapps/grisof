-- Script SQL para crear la tabla de consultas
-- Ejecutar este script desde phpMyAdmin en GoDaddy cPanel

CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `leida` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_fecha` (`fecha_creacion`),
  KEY `idx_leida` (`leida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

