# 🔧 SOLUCIÓN: Error de Conexión phpMyAdmin

## ❌ Error que estás viendo:
```
Cannot connect: invalid settings.
mysqli::real_connect(): (HY000/2002): No se puede establecer una conexión 
ya que el equipo de destino denegó expresamente dicha conexión
```

## ✅ SOLUCIONES (prueba en orden):

### SOLUCIÓN 1: Verificar que MySQL esté corriendo en XAMPP

1. Abre **XAMPP Control Panel**
2. Busca **MySQL** en la lista
3. Si está en **rojo** o dice "Stopped":
   - Haz clic en **"Start"** junto a MySQL
   - Espera a que se ponga en **verde** ✅
4. Si ya está en verde pero sigue sin funcionar:
   - Haz clic en **"Stop"**
   - Espera 5 segundos
   - Haz clic en **"Start"** de nuevo

### SOLUCIÓN 2: Verificar que el puerto 3306 esté libre

1. Abre **XAMPP Control Panel**
2. Haz clic en **"Config"** junto a MySQL
3. Selecciona **"my.ini"**
4. Busca la línea: `port=3306`
5. Si está ocupado, puedes cambiarlo a `port=3307`
6. Guarda el archivo
7. Reinicia MySQL en XAMPP

### SOLUCIÓN 3: Verificar configuración de phpMyAdmin

1. Ve a: `C:\xampp\phpMyAdmin\`
2. Abre el archivo `config.inc.php`
3. Busca estas líneas y verifica:

```php
$cfg['Servers'][$i]['host'] = '127.0.0.1';  // o 'localhost'
$cfg['Servers'][$i]['port'] = '3306';        // o el puerto que uses
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = '';        // Vacío por defecto en XAMPP
```

### SOLUCIÓN 4: Reiniciar servicios de Windows

A veces otros servicios bloquean MySQL:

1. Abre **Administrador de tareas** (Ctrl + Shift + Esc)
2. Ve a la pestaña **"Servicios"**
3. Busca servicios relacionados con MySQL:
   - `MySQL` o `MySQL80` o `MySQL57`
   - Si están corriendo, **deténlos** (click derecho → Detener)
4. Vuelve a XAMPP y inicia MySQL

### SOLUCIÓN 5: Verificar logs de error

1. En **XAMPP Control Panel**, haz clic en **"Logs"** junto a MySQL
2. Revisa el último archivo de log
3. Busca errores específicos que te indiquen el problema

### SOLUCIÓN 6: Reinstalar MySQL en XAMPP (último recurso)

1. En XAMPP Control Panel, haz clic en **"Stop"** en MySQL
2. Ve a: `C:\xampp\mysql\data\`
3. Haz backup de tus bases de datos (copia la carpeta)
4. Elimina la carpeta `mysql` completa
5. Descarga XAMPP de nuevo e instala solo MySQL
6. O reinstala XAMPP completo

---

## 🎯 PASOS RÁPIDOS PARA PROBAR:

1. ✅ Abre XAMPP Control Panel
2. ✅ Verifica que MySQL esté en VERDE (corriendo)
3. ✅ Si está rojo, haz clic en "Start"
4. ✅ Espera 10 segundos
5. ✅ Intenta acceder a: http://localhost/phpmyadmin

---

## 📝 VERIFICACIÓN RÁPIDA:

Abre PowerShell o CMD y ejecuta:
```powershell
netstat -an | findstr 3306
```

Si ves algo como `0.0.0.0:3306`, significa que MySQL está escuchando en el puerto 3306.

Si NO ves nada, MySQL no está corriendo.

---

## 💡 ALTERNATIVA: Usar MySQL Workbench o HeidiSQL

Si phpMyAdmin sigue sin funcionar, puedes usar:

1. **MySQL Workbench** (gratis, oficial de MySQL)
2. **HeidiSQL** (gratis, ligero)
3. **DBeaver** (gratis, multiplataforma)

Estos se conectan directamente a MySQL sin pasar por phpMyAdmin.

---

## ❓ ¿QUÉ HACER AHORA?

1. Prueba la **SOLUCIÓN 1** primero (verificar que MySQL esté corriendo)
2. Si no funciona, prueba la **SOLUCIÓN 4** (detener otros servicios MySQL)
3. Si sigue sin funcionar, avísame qué ves en los logs de MySQL

