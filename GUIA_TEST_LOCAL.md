# 🖥️ GUÍA PARA PROBAR LOCALMENTE (ANTES DE SUBIR A GODADDY)

## 📋 ¿QUÉ NECESITAS?

Para probar el sitio localmente necesitas:
1. **XAMPP** (incluye PHP y MySQL) - GRATIS
2. Tu carpeta `deploy` con los archivos

---

## PASO 1: INSTALAR XAMPP

### Descargar XAMPP
1. Ve a: https://www.apachefriends.org/download.html
2. Descarga **XAMPP para Windows** (versión más reciente)
3. Ejecuta el instalador
4. Durante la instalación:
   - Selecciona: **Apache** y **MySQL** (marca las casillas)
   - Deja las demás opciones por defecto
   - Instala en `C:\xampp` (ruta por defecto)

### Iniciar los servicios
1. Abre **XAMPP Control Panel** (desde el menú de inicio)
2. Haz clic en **"Start"** junto a **Apache**
3. Haz clic en **"Start"** junto a **MySQL**
4. Deberían ponerse en verde ✅

---

## PASO 2: CONFIGURAR LA BASE DE DATOS LOCAL

### Crear la base de datos
1. Abre tu navegador
2. Ve a: **http://localhost/phpmyadmin**
3. Se abrirá phpMyAdmin

### Crear base de datos
1. En el menú izquierdo, haz clic en **"Nueva"** o **"New"**
2. En **"Nombre de la base de datos"**, escribe: `grisof_consultas`
3. Haz clic en **"Crear"** o **"Create"**

### Crear la tabla
1. Selecciona tu base de datos `grisof_consultas` (menú izquierdo)
2. Ve a la pestaña **"SQL"**
3. Abre el archivo `deploy/database.sql` con Notepad
4. **Copia TODO** el contenido
5. **Pega** en el cuadro de texto de phpMyAdmin
6. Haz clic en **"Continuar"** o **"Go"**
7. Deberías ver: "La consulta se ejecutó correctamente"
8. Verifica que aparezca la tabla `consultas`

---

## PASO 3: CONFIGURAR LOS ARCHIVOS PARA LOCAL

### Configurar config.php
1. Abre `deploy/config.php`
2. Cámbialo para que quede así:

```php
<?php
// Configuración para LOCAL (XAMPP)
define('DB_HOST', 'localhost');
define('DB_NAME', 'grisof_consultas');  // ← El nombre que creaste
define('DB_USER', 'root');               // ← En XAMPP siempre es "root"
define('DB_PASS', '');                   // ← En XAMPP está vacío por defecto

session_start();
define('SESSION_TIMEOUT', 1800);
?>
```

**Nota:** En XAMPP:
- Usuario: siempre es `root`
- Contraseña: está vacía por defecto (deja `''`)

### Configurar admin/login.php (opcional)
Puedes dejarlo como está o cambiarlo. Ejemplo:
```php
$admin_username = 'admin';
$admin_password = 'admin123';
```

---

## PASO 4: COPIAR ARCHIVOS A XAMPP

### Opción A: Copiar manualmente
1. Abre la carpeta: `C:\xampp\htdocs\`
2. Crea una carpeta nueva llamada: `grisof` (o el nombre que quieras)
3. Copia **TODOS** los archivos de tu carpeta `deploy` a `C:\xampp\htdocs\grisof\`
   - Incluye: `index.html`, `contacto.php`, `config.php`, etc.
   - Incluye las carpetas: `assets/` y `admin/`

### Opción B: Usar comando (más rápido)
Abre PowerShell o CMD en la carpeta de tu proyecto y ejecuta:

```powershell
xcopy /E /I /Y "deploy\*" "C:\xampp\htdocs\grisof\"
```

---

## PASO 5: PROBAR EL SITIO LOCAL

### Ver el sitio
1. Abre tu navegador
2. Ve a: **http://localhost/grisof/**
3. Deberías ver tu sitio funcionando

### Probar el formulario
1. Baja hasta el formulario de contacto
2. Llena el formulario con datos de prueba
3. Haz clic en "Enviar mensaje"
4. Deberías ver un mensaje de éxito

### Verificar que se guardó
1. Ve a: **http://localhost/phpmyadmin**
2. Selecciona la base de datos `grisof_consultas`
3. Haz clic en la tabla `consultas`
4. Deberías ver tu consulta guardada

### Probar el panel de admin
1. Ve a: **http://localhost/grisof/admin/**
2. Ingresa las credenciales:
   - Usuario: `admin` (o el que pusiste)
   - Contraseña: `admin123` (o la que pusiste)
3. Deberías ver el panel con tu consulta

---

## ✅ CHECKLIST DE PRUEBA LOCAL

Antes de subir a GoDaddy, verifica que funcione localmente:

- [ ] XAMPP instalado y funcionando (Apache y MySQL en verde)
- [ ] Base de datos `grisof_consultas` creada en phpMyAdmin
- [ ] Tabla `consultas` creada correctamente
- [ ] `config.php` configurado con datos locales
- [ ] Archivos copiados a `C:\xampp\htdocs\grisof\`
- [ ] Sitio visible en `http://localhost/grisof/`
- [ ] Formulario de contacto funciona y guarda datos
- [ ] Panel de admin accesible y muestra consultas
- [ ] Puedes ver, marcar como leída y eliminar consultas

---

## 🔄 CUANDO ESTÉ LISTO PARA SUBIR A GODADDY

Una vez que todo funcione localmente:

1. **Cambia `config.php`** con los datos de GoDaddy (no los de localhost)
2. **Cambia las credenciales del admin** en `admin/login.php` por algo más seguro
3. **Sube todo** a GoDaddy siguiendo la guía de despliegue

---

## ❓ SOLUCIÓN DE PROBLEMAS LOCAL

### Problema: "Apache no inicia"
**Solución:**
- Cierra programas que usen el puerto 80 (Skype, IIS, etc.)
- O cambia el puerto de Apache en XAMPP: Config → Apache → httpd.conf → Busca "Listen 80" y cámbialo a "Listen 8080"

### Problema: "MySQL no inicia"
**Solución:**
- Verifica que no haya otro MySQL corriendo
- Revisa los logs en XAMPP para ver el error específico

### Problema: "No puedo acceder a localhost"
**Solución:**
- Verifica que Apache esté corriendo (verde en XAMPP)
- Prueba: `http://127.0.0.1/grisof/` en lugar de `localhost`

### Problema: "Error de conexión a la base de datos"
**Solución:**
- Verifica que MySQL esté corriendo
- Verifica que `config.php` tenga:
  - `DB_USER` = `'root'`
  - `DB_PASS` = `''` (vacío)
  - `DB_NAME` = el nombre exacto de tu BD

### Problema: "Las imágenes no se ven"
**Solución:**
- Verifica que la carpeta `assets/` esté en `C:\xampp\htdocs\grisof\assets\`
- Verifica las rutas en `index.html` (deben empezar con `/assets/...`)

---

## 🎯 RESUMEN RÁPIDO

1. **Instala XAMPP** → Inicia Apache y MySQL
2. **Crea BD** en phpMyAdmin: `grisof_consultas`
3. **Ejecuta** `database.sql` en phpMyAdmin
4. **Configura** `config.php` con datos locales (root, sin pass)
5. **Copia** archivos a `C:\xampp\htdocs\grisof\`
6. **Prueba** en `http://localhost/grisof/`

¡Listo para probar localmente! 🚀

