===========================================
GUÍA DE DESPLIEGUE A GODADDY CPANEL
===========================================

ESTRUCTURA DE ARCHIVOS LISTA PARA SUBIR:
----------------------------------------
✓ index.html          - Página principal estática
✓ contacto.php        - Procesa formularios de contacto
✓ config.php          - Configuración de base de datos (EDITAR ANTES DE SUBIR)
✓ .htaccess          - Configuración del servidor
✓ database.sql       - Script para crear la tabla (ejecutar en phpMyAdmin)
✓ favicon.ico        - Icono del sitio
✓ assets/            - Carpeta con CSS, imágenes y logos
✓ admin/             - Panel de administración
  ├── index.php      - Panel principal
  ├── login.php      - Login (CAMBIAR CREDENCIALES)
  ├── logout.php     - Cerrar sesión
  ├── marcar_leida.php
  └── eliminar.php

PASOS PARA DESPLEGAR:
---------------------

1. CREAR BASE DE DATOS EN GODADDY:
   - Accede a cPanel
   - Ve a "MySQL Databases" o "Bases de datos MySQL"
   - Crea una nueva base de datos (ej: tuusuario_consultas)
   - Crea un usuario MySQL y asígnalo a la base de datos
   - Anota: nombre BD, usuario, contraseña

2. CREAR LA TABLA:
   - Ve a phpMyAdmin desde cPanel
   - Selecciona tu base de datos
   - Ve a la pestaña "SQL"
   - Copia y pega el contenido de database.sql
   - Ejecuta el script

3. CONFIGURAR ARCHIVOS:
   
   a) Edita config.php con tus datos:
      define('DB_HOST', 'localhost');
      define('DB_NAME', 'tu_base_de_datos');  ← Cambiar
      define('DB_USER', 'tu_usuario');         ← Cambiar
      define('DB_PASS', 'tu_contraseña');     ← Cambiar
   
   b) Edita admin/login.php (líneas 12-13):
      $admin_username = 'admin';        ← Cambiar
      $admin_password = 'admin123';    ← Cambiar por contraseña segura

4. SUBIR ARCHIVOS:
   - Accede a File Manager en cPanel
   - Ve a public_html (o la carpeta de tu dominio)
   - Sube TODOS los archivos y carpetas de esta carpeta "deploy"
   - Mantén la estructura de carpetas

5. VERIFICAR PERMISOS:
   - Archivos PHP: 644
   - Carpetas: 755

6. PROBAR:
   - Visita tu dominio
   - Prueba el formulario de contacto
   - Accede a: tudominio.com/admin/
   - Usa las credenciales que configuraste

NOTAS IMPORTANTES:
------------------
⚠️ CAMBIA las credenciales del admin ANTES de subir
⚠️ VERIFICA que las rutas de los assets sean correctas
⚠️ Si hay errores, revisa los logs de PHP en cPanel

¡Listo para desplegar!

