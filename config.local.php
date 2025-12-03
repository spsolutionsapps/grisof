<?php
// ============================================
// CONFIGURACIÓN PARA PRUEBAS LOCALES (XAMPP)
// ============================================
// 
// Este archivo es para probar localmente
// Cuando subas a GoDaddy, usa config.php con los datos del servidor
//
// ============================================

// Configuración para XAMPP (local)
define('DB_HOST', 'localhost');
define('DB_NAME', 'grisof_consultas');  // Nombre de tu BD local
define('DB_USER', 'root');               // En XAMPP siempre es "root"
define('DB_PASS', '');                   // En XAMPP está vacío por defecto

// Configuración de sesión para el admin
session_start();

// Timeout de sesión (30 minutos)
define('SESSION_TIMEOUT', 1800);
?>

