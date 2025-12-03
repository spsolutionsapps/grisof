# 🔧 SOLUCIÓN RÁPIDA: phpMyAdmin no se conecta

## ✅ DIAGNÓSTICO:
MySQL SÍ está corriendo (puerto 3306 activo), pero phpMyAdmin no puede conectarse.
Esto es un problema de **configuración de phpMyAdmin**.

---

## 🎯 SOLUCIÓN RÁPIDA:

### Opción 1: Arreglar config.inc.php de phpMyAdmin

1. Ve a: `C:\xampp\phpMyAdmin\`
2. Busca el archivo `config.inc.php`
3. Ábrelo con Notepad o VS Code
4. Busca la sección que dice `$cfg['Servers']`
5. Asegúrate de que tenga esto:

```php
$cfg['Servers'][1]['host'] = '127.0.0.1';  // o 'localhost'
$cfg['Servers'][1]['port'] = '';
$cfg['Servers'][1]['user'] = 'root';
$cfg['Servers'][1]['password'] = '';  // Vacío en XAMPP por defecto
$cfg['Servers'][1]['auth_type'] = 'config';
```

6. Guarda el archivo
7. Intenta acceder a phpMyAdmin de nuevo

### Opción 2: Usar el configurador de phpMyAdmin

1. Ve a: `C:\xampp\phpMyAdmin\`
2. Si existe la carpeta `config`, elimínala o renómbrala
3. Ve a: http://localhost/phpmyadmin/setup/
4. Sigue el asistente de configuración
5. Configura:
   - Host: `127.0.0.1`
   - Puerto: `3306` (o déjalo vacío)
   - Usuario: `root`
   - Contraseña: (déjalo vacío)
6. Guarda la configuración

### Opción 3: Usar MySQL directamente (más fácil)

En lugar de phpMyAdmin, puedes usar **MySQL Workbench** o crear la BD desde la línea de comandos:

**Opción A: MySQL Workbench**
1. Descarga: https://dev.mysql.com/downloads/workbench/
2. Instala
3. Conecta con:
   - Host: `127.0.0.1`
   - Puerto: `3306`
   - Usuario: `root`
   - Contraseña: (vacío)

**Opción B: Línea de comandos MySQL**
1. Abre PowerShell o CMD
2. Ve a: `C:\xampp\mysql\bin\`
3. Ejecuta: `mysql.exe -u root`
4. Ejecuta estos comandos:

```sql
CREATE DATABASE grisof_consultas;
USE grisof_consultas;

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
```

---

## 🚀 SOLUCIÓN MÁS RÁPIDA (Recomendada):

Si phpMyAdmin te da problemas, puedes **saltarte phpMyAdmin** y crear la BD directamente:

1. Abre PowerShell
2. Ejecuta este comando (copia y pega todo):

```powershell
cd C:\xampp\mysql\bin
.\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS grisof_consultas;"
.\mysql.exe -u root grisof_consultas -e "CREATE TABLE IF NOT EXISTS consultas (id int(11) NOT NULL AUTO_INCREMENT, nombre varchar(255) NOT NULL, email varchar(255) NOT NULL, telefono varchar(50) DEFAULT NULL, mensaje text NOT NULL, fecha_creacion datetime NOT NULL, leida tinyint(1) DEFAULT 0, PRIMARY KEY (id), KEY idx_fecha (fecha_creacion), KEY idx_leida (leida)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
```

Esto creará la base de datos y la tabla directamente, sin necesidad de phpMyAdmin.

---

## ✅ VERIFICAR QUE FUNCIONÓ:

Después de crear la BD, prueba tu sitio:
1. Ve a: http://localhost/grisof/
2. Prueba el formulario de contacto
3. Si funciona, ¡listo! No necesitas phpMyAdmin para probar.

