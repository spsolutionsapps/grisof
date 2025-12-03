@echo off
echo ========================================
echo   COPIANDO ARCHIVOS A XAMPP
echo ========================================
echo.

REM Verificar que XAMPP existe
if not exist "C:\xampp\htdocs\" (
    echo ERROR: XAMPP no encontrado en C:\xampp\
    echo Por favor instala XAMPP primero
    pause
    exit
)

REM Crear carpeta si no existe
if not exist "C:\xampp\htdocs\grisof\" (
    mkdir "C:\xampp\htdocs\grisof\"
    echo Carpeta creada: C:\xampp\htdocs\grisof\
)

REM Copiar archivos
echo Copiando archivos...
xcopy /E /I /Y "deploy\*" "C:\xampp\htdocs\grisof\"

REM Copiar config.local.php como config.php
copy /Y "config.local.php" "C:\xampp\htdocs\grisof\config.php"

echo.
echo ========================================
echo   ARCHIVOS COPIADOS EXITOSAMENTE
echo ========================================
echo.
echo Tu sitio esta disponible en:
echo http://localhost/grisof/
echo.
echo Panel de admin:
echo http://localhost/grisof/admin/
echo.
echo Usuario: admin
echo Password: admin123
echo.
pause

