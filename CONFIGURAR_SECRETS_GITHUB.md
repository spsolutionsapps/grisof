# 🔐 CONFIGURAR SECRETS EN GITHUB - PASO A PASO

## ✅ CREDENCIALES FTP QUE TIENES

- **Usuario FTP**: `grisof@92k.2ce.mytemp.website`
- **Contraseña**: `Gojira2019!`
- **Servidor**: `92k.2ce.mytemp.website`
- **Directorio**: `/public_html/`

---

## 📝 PASO A PASO PARA CONFIGURAR EN GITHUB

### Paso 1: Ir a tu repositorio en GitHub

1. Abre tu navegador
2. Ve a: `https://github.com/tu-usuario/tu-repo`
3. (Reemplaza con tu usuario y nombre del repo)

### Paso 2: Ir a Settings

1. En tu repositorio, haz clic en la pestaña **"Settings"** (arriba)
2. En el menú izquierdo, busca **"Secrets and variables"**
3. Haz clic en **"Actions"**

### Paso 3: Crear Secret 1 - FTP_SERVER

1. Haz clic en **"New repository secret"** (botón verde arriba a la derecha)
2. **Name**: `FTP_SERVER`
3. **Secret**: `92k.2ce.mytemp.website`
4. Haz clic en **"Add secret"**

### Paso 4: Crear Secret 2 - FTP_USERNAME

1. Haz clic en **"New repository secret"** de nuevo
2. **Name**: `FTP_USERNAME`
3. **Secret**: `grisof@92k.2ce.mytemp.website`
   - ⚠️ **IMPORTANTE**: Incluye el `@92k.2ce.mytemp.website` completo
4. Haz clic en **"Add secret"**

### Paso 5: Crear Secret 3 - FTP_PASSWORD

1. Haz clic en **"New repository secret"** de nuevo
2. **Name**: `FTP_PASSWORD`
3. **Secret**: `Gojira2019!`
4. Haz clic en **"Add secret"**

---

## ✅ VERIFICAR QUE ESTÉN CREADOS

Deberías ver 3 secrets en la lista:
- ✅ `FTP_SERVER`
- ✅ `FTP_USERNAME`
- ✅ `FTP_PASSWORD`

---

## 🚀 PROBAR EL DEPLOY

Ahora que los secrets están configurados:

1. Haz un cambio pequeño en tu código (o no, solo haz push)
2. Abre terminal/PowerShell en tu proyecto
3. Ejecuta:
   ```bash
   git add .
   git commit -m "Configurar deploy automático"
   git push origin main
   ```

4. Ve a GitHub → pestaña **"Actions"**
5. Verás un workflow ejecutándose llamado **"Deploy to GoDaddy"**
6. Haz clic en él para ver el progreso
7. Espera 1-2 minutos
8. Cuando termine (verde ✅), tu sitio estará desplegado

---

## 🔍 VERIFICAR QUE FUNCIONÓ

1. Ve a: `https://92k.2ce.mytemp.website`
2. Deberías ver tu sitio de Grisfo funcionando

---

## ⚠️ IMPORTANTE: CONFIG.PHP

Después del primer deploy automático:

1. Ve a cPanel → **File Manager**
2. Entra a `public_html`
3. Abre `config.php`
4. Edítalo con tus credenciales de base de datos:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tu_base_de_datos');
   define('DB_USER', 'tu_usuario');
   define('DB_PASS', 'tu_contraseña');
   ```
5. Guarda

**Esto solo lo haces UNA VEZ**, después GitHub Actions no lo sobrescribirá porque está excluido.

---

## ❓ SI HAY ERRORES

### Error: "Could not connect"
- Verifica que `FTP_SERVER` sea: `92k.2ce.mytemp.website`
- Prueba también: `ftp.92k.2ce.mytemp.website`

### Error: "Authentication failed"
- Verifica que `FTP_USERNAME` incluya: `grisof@92k.2ce.mytemp.website`
- Verifica que `FTP_PASSWORD` sea exactamente: `Gojira2019!`

### Error: "Directory not found"
- Verifica que el directorio en GoDaddy sea `/public_html/`
- O ajusta en `.github/workflows/deploy.yml` la línea `server-dir`

---

## 🎯 RESUMEN

1. ✅ Crear 3 secrets en GitHub (FTP_SERVER, FTP_USERNAME, FTP_PASSWORD)
2. ✅ Hacer push a GitHub
3. ✅ Ver el workflow ejecutándose en Actions
4. ✅ Configurar `config.php` manualmente después del primer deploy
5. ✅ ¡Listo! Cada push hará deploy automático

¡Avísame cuando hayas configurado los secrets y probemos el deploy!

