@echo off
echo ========================================
echo   CREANDO BASE DE DATOS DIRECTAMENTE
echo ========================================
echo.

REM Verificar que MySQL esté corriendo
netstat -an | findstr 3306 >nul
if errorlevel 1 (
    echo ERROR: MySQL no esta corriendo
    echo Por favor inicia MySQL desde XAMPP Control Panel
    pause
    exit
)

echo MySQL esta corriendo...
echo.

REM Ir a la carpeta de MySQL
cd /d C:\xampp\mysql\bin

REM Crear la base de datos
echo Creando base de datos grisof_consultas...
mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS grisof_consultas;"

if errorlevel 1 (
    echo ERROR al crear la base de datos
    pause
    exit
)

echo Base de datos creada exitosamente!
echo.

REM Crear la tabla
echo Creando tabla consultas...
mysql.exe -u root grisof_consultas -e "CREATE TABLE IF NOT EXISTS consultas (id int(11) NOT NULL AUTO_INCREMENT, nombre varchar(255) NOT NULL, email varchar(255) NOT NULL, telefono varchar(50) DEFAULT NULL, mensaje text NOT NULL, fecha_creacion datetime NOT NULL, leida tinyint(1) DEFAULT 0, PRIMARY KEY (id), KEY idx_fecha (fecha_creacion), KEY idx_leida (leida)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"

if errorlevel 1 (
    echo ERROR al crear la tabla
    pause
    exit
)

echo.
echo ========================================
echo   BASE DE DATOS CREADA EXITOSAMENTE!
echo ========================================
echo.
echo Base de datos: grisof_consultas
echo Tabla: consultas
echo.
echo Ahora puedes probar tu sitio en:
echo http://localhost/grisof/
echo.
pause

