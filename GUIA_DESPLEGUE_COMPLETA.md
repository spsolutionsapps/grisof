# 🚀 GUÍA COMPLETA PASO A PASO - DESPLIEGUE A GODADDY CPANEL

## 📋 ÍNDICE
1. [Preparación de archivos](#1-preparación-de-archivos)
2. [Crear base de datos en GoDaddy](#2-crear-base-de-datos-en-godaddy)
3. [Crear la tabla en la base de datos](#3-crear-la-tabla-en-la-base-de-datos)
4. [Configurar archivos PHP](#4-configurar-archivos-php)
5. [Subir archivos al servidor](#5-subir-archivos-al-servidor)
6. [Probar el sitio](#6-probar-el-sitio)

---

## 1. PREPARACIÓN DE ARCHIVOS

### ✅ Verificar que tienes la carpeta "deploy"
En tu proyecto deberías tener una carpeta llamada `deploy` con estos archivos:
- `index.html`
- `contacto.php`
- `config.php`
- `config.example.php`
- `database.sql`
- `.htaccess`
- `favicon.ico`
- `README.txt`
- Carpeta `assets/` (con imágenes y CSS)
- Carpeta `admin/` (con los archivos del panel)

**Si no tienes la carpeta deploy, avísame y te ayudo a crearla.**

---

## 2. CREAR BASE DE DATOS EN GODADDY

### Paso 2.1: Acceder a cPanel
1. Ve a [godaddy.com](https://godaddy.com) e inicia sesión
2. Ve a "Mis Productos" o "My Products"
3. Busca tu hosting y haz clic en "Administrar" o "Manage"
4. Busca el botón "cPanel" o "cPanel Admin" y haz clic

### Paso 2.2: Crear la base de datos
1. En cPanel, busca la sección **"Bases de datos"** o **"Databases"**
2. Haz clic en **"MySQL Databases"** o **"Bases de datos MySQL"**
3. Verás un formulario para crear una nueva base de datos:
   - En el campo de texto, escribe un nombre (ejemplo: `consultas` o `contactos`)
   - Haz clic en **"Crear base de datos"** o **"Create Database"**
   - **ANOTA EL NOMBRE COMPLETO** que aparece (será algo como `tuusuario_consultas`)

### Paso 2.3: Crear usuario de MySQL
1. En la misma página, baja hasta **"Usuarios de MySQL"** o **"MySQL Users"**
2. Crea un nuevo usuario:
   - **Nombre de usuario**: escribe algo como `admin_db` o `user_db`
   - **Contraseña**: crea una contraseña segura (anótala bien)
   - Haz clic en **"Crear usuario"** o **"Create User"**
   - **ANOTA EL NOMBRE COMPLETO DEL USUARIO** (será algo como `tuusuario_admin_db`)

### Paso 2.4: Asignar usuario a la base de datos
1. Baja hasta **"Añadir usuario a la base de datos"** o **"Add User to Database"**
2. Selecciona:
   - El usuario que acabas de crear
   - La base de datos que creaste
3. Haz clic en **"Añadir"** o **"Add"**
4. Marca **"ALL PRIVILEGES"** (todos los privilegios)
5. Haz clic en **"Hacer cambios"** o **"Make Changes"**

### ✅ Resumen - Anota estos datos:
```
Nombre de la base de datos: tuusuario_consultas
Usuario MySQL: tuusuario_admin_db
Contraseña: [la que creaste]
Host: localhost (generalmente es este)
```

---

## 3. CREAR LA TABLA EN LA BASE DE DATOS

### Paso 3.1: Abrir phpMyAdmin
1. En cPanel, busca **"phpMyAdmin"** en la sección de bases de datos
2. Haz clic en **"phpMyAdmin"**
3. Se abrirá en una nueva pestaña

### Paso 3.2: Seleccionar tu base de datos
1. En el menú izquierdo, busca y haz clic en tu base de datos (ej: `tuusuario_consultas`)
2. Verás que está vacía (no hay tablas aún)

### Paso 3.3: Ejecutar el script SQL
1. En la parte superior, haz clic en la pestaña **"SQL"**
2. Se abrirá un cuadro de texto grande
3. Abre el archivo `database.sql` que está en tu carpeta `deploy` (puedes abrirlo con Notepad)
4. **Copia TODO el contenido** del archivo `database.sql`
5. **Pega el contenido** en el cuadro de texto de phpMyAdmin
6. Haz clic en el botón **"Continuar"** o **"Go"** (abajo a la derecha)
7. Deberías ver un mensaje de éxito: **"La consulta se ejecutó correctamente"**

### ✅ Verificar que funcionó:
1. En el menú izquierdo, haz clic en tu base de datos
2. Deberías ver una tabla llamada `consultas`
3. Si la ves, ¡perfecto! La base de datos está lista

---

## 4. CONFIGURAR ARCHIVOS PHP

### Paso 4.1: Editar config.php
1. Abre el archivo `deploy/config.php` con un editor de texto (Notepad, VS Code, etc.)
2. Verás estas líneas:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tu_base_de_datos'); // Cambiar por el nombre de tu base de datos
define('DB_USER', 'tu_usuario'); // Cambiar por tu usuario de MySQL
define('DB_PASS', 'tu_contraseña'); // Cambiar por tu contraseña de MySQL
```

3. **Reemplaza con tus datos reales:**
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tuusuario_consultas');  // ← El nombre completo de tu BD
define('DB_USER', 'tuusuario_admin_db');   // ← El nombre completo de tu usuario
define('DB_PASS', 'TuContraseña123');      // ← Tu contraseña
```

4. **Guarda el archivo**

### Paso 4.2: Cambiar credenciales del admin
1. Abre el archivo `deploy/admin/login.php`
2. Busca estas líneas (alrededor de la línea 12-13):
```php
$admin_username = 'admin';
$admin_password = 'admin123'; // Cambiar esta contraseña
```

3. **Cámbialas por credenciales seguras:**
```php
$admin_username = 'tu_usuario_admin';  // ← Elige un nombre de usuario
$admin_password = 'TuContraseñaSegura123';  // ← Elige una contraseña segura
```

4. **Guarda el archivo**

⚠️ **IMPORTANTE**: Anota estas credenciales porque las necesitarás para acceder al panel de administración.

---

## 5. SUBIR ARCHIVOS AL SERVIDOR

### Paso 5.1: Acceder al File Manager
1. En cPanel, busca **"File Manager"** o **"Administrador de archivos"**
2. Haz clic en **"File Manager"**
3. Se abrirá una nueva ventana

### Paso 5.2: Ir a la carpeta correcta
1. En el File Manager, busca la carpeta **`public_html`**
2. **Haz clic en `public_html`** para entrar
3. Esta es la carpeta donde van todos los archivos de tu sitio web

### Paso 5.3: Subir los archivos
Tienes dos opciones:

#### **Opción A: Subir archivo por archivo (más lento pero seguro)**
1. Haz clic en el botón **"Subir"** o **"Upload"** (arriba)
2. Haz clic en **"Seleccionar archivos"** o **"Select Files"**
3. Ve a tu carpeta `deploy` y selecciona los archivos uno por uno:
   - `index.html`
   - `contacto.php`
   - `config.php`
   - `.htaccess`
   - `database.sql` (opcional, ya lo ejecutaste)
   - `favicon.ico`
4. Espera a que se suban
5. Repite para subir las carpetas:
   - Haz clic en **"Crear carpeta"** o **"Create Folder"**
   - Crea una carpeta llamada `assets`
   - Entra a la carpeta `assets` y sube todos los archivos de `deploy/assets/`
   - Repite para crear la carpeta `admin` y subir sus archivos

#### **Opción B: Subir todo de una vez (más rápido)**
1. En tu computadora, comprime la carpeta `deploy` en un archivo ZIP:
   - Click derecho en la carpeta `deploy` → "Enviar a" → "Carpeta comprimida (en zip)"
   - Se creará `deploy.zip`
2. En File Manager de cPanel:
   - Haz clic en **"Subir"** o **"Upload"**
   - Sube el archivo `deploy.zip`
   - Espera a que termine
3. En File Manager:
   - Haz clic derecho en `deploy.zip`
   - Selecciona **"Extraer"** o **"Extract"**
   - Se extraerán todos los archivos
4. Mueve los archivos a `public_html`:
   - Selecciona todos los archivos dentro de `deploy`
   - Córtalos (Cut)
   - Ve a `public_html`
   - Pégalos (Paste)
5. Elimina la carpeta `deploy` vacía y el archivo ZIP

### Paso 5.4: Verificar estructura final
En `public_html` deberías tener:
```
public_html/
├── index.html
├── contacto.php
├── config.php
├── .htaccess
├── favicon.ico
├── assets/
│   ├── companies-logo/
│   ├── hero-section-card-image.svg
│   ├── index-y3-jrHkF.css
│   └── logo.svg
└── admin/
    ├── index.php
    ├── login.php
    ├── logout.php
    ├── marcar_leida.php
    └── eliminar.php
```

### Paso 5.5: Verificar permisos (opcional pero recomendado)
1. Selecciona todos los archivos `.php`
2. Click derecho → **"Cambiar permisos"** o **"Change Permissions"**
3. Marca: **644** (o escribe `644` en el campo)
4. Haz clic en **"Cambiar permisos"**
5. Repite para las carpetas con permisos **755**

---

## 6. PROBAR EL SITIO

### Paso 6.1: Ver el sitio web
1. Abre tu navegador
2. Ve a tu dominio (ej: `https://tudominio.com`)
3. Deberías ver tu sitio web funcionando

### Paso 6.2: Probar el formulario de contacto
1. Baja hasta el formulario de contacto (al final de la página)
2. Llena el formulario:
   - Nombre: prueba
   - Email: prueba@ejemplo.com
   - Teléfono: (opcional)
   - Mensaje: Este es un mensaje de prueba
3. Haz clic en **"Enviar mensaje"**
4. Deberías ver un mensaje verde: "¡Gracias! Tu mensaje ha sido enviado correctamente"

### Paso 6.3: Acceder al panel de administración
1. Ve a: `https://tudominio.com/admin/`
2. Verás una página de login
3. Ingresa las credenciales que configuraste en `admin/login.php`:
   - Usuario: (el que pusiste en login.php)
   - Contraseña: (la que pusiste en login.php)
4. Haz clic en **"Iniciar Sesión"**
5. Deberías ver el panel con la consulta que acabas de enviar

### Paso 6.4: Probar funciones del admin
- **Ver consulta**: Haz clic en "Ver" en cualquier consulta
- **Marcar como leída**: Haz clic en "Marcar leída"
- **Eliminar**: Haz clic en "Eliminar" (te pedirá confirmación)

---

## ❓ SOLUCIÓN DE PROBLEMAS

### Problema: "Error de conexión a la base de datos"
**Solución:**
- Verifica que `config.php` tenga los datos correctos
- Asegúrate de que el usuario tenga permisos sobre la base de datos
- Verifica que la base de datos exista

### Problema: "No puedo acceder al admin"
**Solución:**
- Verifica que la carpeta `admin/` esté en `public_html/admin/`
- Verifica las credenciales en `admin/login.php`
- Asegúrate de que los archivos PHP tengan permisos 644

### Problema: "El formulario no envía"
**Solución:**
- Verifica que `contacto.php` esté en `public_html/`
- Abre la consola del navegador (F12) y revisa si hay errores
- Verifica que la base de datos tenga la tabla `consultas`

### Problema: "Las imágenes no se ven"
**Solución:**
- Verifica que la carpeta `assets/` esté en `public_html/assets/`
- Verifica que las rutas en `index.html` sean `/assets/...` (con barra inicial)

---

## ✅ CHECKLIST FINAL

Antes de considerar que todo está listo, verifica:

- [ ] Base de datos creada en cPanel
- [ ] Tabla `consultas` creada en phpMyAdmin
- [ ] `config.php` configurado con datos reales
- [ ] Credenciales del admin cambiadas en `admin/login.php`
- [ ] Todos los archivos subidos a `public_html`
- [ ] Estructura de carpetas correcta
- [ ] Formulario de contacto funciona
- [ ] Panel de administración accesible
- [ ] Puedes ver las consultas en el admin

---

## 🎉 ¡LISTO!

Si completaste todos los pasos, tu sitio está funcionando. Cualquier duda, avísame.

