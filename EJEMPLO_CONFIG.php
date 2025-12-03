<?php
// ============================================
// EJEMPLO DE CÓMO DEBERÍA QUEDAR TU config.php
// ============================================
// 
// PASO 1: Ve a cPanel → MySQL Databases
// PASO 2: Crea una base de datos (ejemplo: "consultas")
// PASO 3: Crea un usuario (ejemplo: "admin_db")
// PASO 4: Asigna el usuario a la base de datos
// PASO 5: Anota los datos que te da GoDaddy
//
// ============================================

// Ejemplo de cómo quedaría con datos REALES:
// (Estos son EJEMPLOS, usa tus datos reales)

define('DB_HOST', 'localhost');  // ← Generalmente siempre es "localhost"

define('DB_NAME', 'miusuario_consultas');  
// ↑ Esto es lo que te da GoDaddy cuando creas la BD
// Formato: "tuusuario_nombredelabd"

define('DB_USER', 'miusuario_admin_db');  
// ↑ Esto es lo que te da GoDaddy cuando creas el usuario
// Formato: "tuusuario_nombredelusuario"

define('DB_PASS', 'MiContraseñaSegura123!');  
// ↑ La contraseña que TÚ elegiste al crear el usuario
// IMPORTANTE: Anótala bien, la necesitarás

// ============================================
// CONFIGURACIÓN DE SESIÓN (NO CAMBIAR)
// ============================================
session_start();
define('SESSION_TIMEOUT', 1800);
?>

