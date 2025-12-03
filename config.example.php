<?php
// Archivo de ejemplo de configuración
// Copia este archivo como config.php y completa con tus credenciales reales

// Configuración de la base de datos
// IMPORTANTE: Actualiza estos valores con tus credenciales de GoDaddy cPanel

define('DB_HOST', 'localhost');
define('DB_NAME', 'tu_base_de_datos'); // Cambiar por el nombre de tu base de datos
define('DB_USER', 'tu_usuario'); // Cambiar por tu usuario de MySQL
define('DB_PASS', 'tu_contraseña'); // Cambiar por tu contraseña de MySQL

// Configuración de sesión para el admin
session_start();

// Timeout de sesión (30 minutos)
define('SESSION_TIMEOUT', 1800);
?>

