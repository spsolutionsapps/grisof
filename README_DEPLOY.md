# Guía de Despliegue a GoDaddy cPanel

## Pasos para desplegar el sitio

### 1. Preparar el sitio estático

1. Construir el proyecto React:
```bash
npm run build
```

2. Los archivos estáticos estarán en la carpeta `dist/`

### 2. Configurar la base de datos en GoDaddy

1. Accede a tu cPanel de GoDaddy
2. Ve a "MySQL Databases" o "Bases de datos MySQL"
3. Crea una nueva base de datos (ej: `tuusuario_consultas`)
4. Crea un usuario de MySQL y asígnalo a la base de datos
5. Anota las credenciales:
   - Nombre de la base de datos
   - Usuario de MySQL
   - Contraseña

### 3. Crear la tabla en la base de datos

1. Ve a phpMyAdmin desde cPanel
2. Selecciona tu base de datos
3. Ve a la pestaña "SQL"
4. Copia y pega el contenido del archivo `database.sql`
5. Ejecuta el script

### 4. Configurar los archivos PHP

1. Edita el archivo `config.php` con tus credenciales de base de datos:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tu_base_de_datos'); // Tu nombre de base de datos
define('DB_USER', 'tu_usuario'); // Tu usuario de MySQL
define('DB_PASS', 'tu_contraseña'); // Tu contraseña
```

2. **IMPORTANTE**: Cambia las credenciales del admin en `admin/login.php`:
```php
$admin_username = 'admin'; // Cambia esto
$admin_password = 'admin123'; // Cambia esto por una contraseña segura
```

### 5. Subir archivos a GoDaddy

1. Accede a File Manager en cPanel
2. Ve a la carpeta `public_html` (o la carpeta de tu dominio)
3. Sube todos los archivos:
   - Archivos de la carpeta `dist/` (después de `npm run build`)
   - Todos los archivos PHP (`contacto.php`, `config.php`)
   - La carpeta `admin/` completa
   - El archivo `.htaccess`

### 6. Estructura de archivos en el servidor

```
public_html/
├── index.html (desde dist/)
├── assets/ (desde dist/)
├── contacto.php
├── config.php
├── .htaccess
├── database.sql (opcional, ya ejecutado)
└── admin/
    ├── index.php
    ├── login.php
    ├── logout.php
    ├── marcar_leida.php
    └── eliminar.php
```

### 7. Verificar permisos

1. Asegúrate de que los archivos PHP tengan permisos 644
2. Asegúrate de que las carpetas tengan permisos 755

### 8. Probar el sitio

1. Visita tu dominio para ver el sitio
2. Prueba el formulario de contacto
3. Accede al panel de administración en: `tudominio.com/admin/`
4. Usa las credenciales que configuraste en `login.php`

## Notas importantes

- **Seguridad**: Cambia las credenciales del admin antes de subir a producción
- **Base de datos**: Verifica que las credenciales en `config.php` sean correctas
- **Rutas**: Asegúrate de que las rutas de los assets sean correctas después del build
- **PHP**: Verifica que PHP esté habilitado en tu hosting (generalmente ya lo está en GoDaddy)

## Solución de problemas

### Error de conexión a la base de datos
- Verifica las credenciales en `config.php`
- Asegúrate de que el usuario tenga permisos sobre la base de datos
- Verifica que la base de datos exista

### El formulario no envía
- Verifica que `contacto.php` esté en la raíz del sitio
- Revisa la consola del navegador para ver errores
- Verifica los permisos de los archivos PHP

### No puedo acceder al admin
- Verifica que la carpeta `admin/` esté subida correctamente
- Verifica las credenciales en `login.php`
- Revisa los logs de error de PHP en cPanel

