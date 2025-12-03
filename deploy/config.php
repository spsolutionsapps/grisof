<?php
// Configuración de la base de datos
// IMPORTANTE: Actualiza estos valores con tus credenciales de GoDaddy cPanel

define('DB_HOST', 'localhost');
define('DB_NAME', 'grisof_consultas'); // Base de datos local
define('DB_USER', 'root'); // Usuario de XAMPP
define('DB_PASS', ''); // Contraseña vacía en XAMPP por defecto

// Configuración de sesión para el admin
session_start();

// Timeout de sesión (30 minutos)
define('SESSION_TIMEOUT', 1800);
?>

