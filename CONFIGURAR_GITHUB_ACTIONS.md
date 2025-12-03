# 🚀 CONFIGURAR GITHUB ACTIONS PARA GODADDY

## 📋 INFORMACIÓN QUE TIENES

Basado en tu panel de GoDaddy:
- **Usuario cPanel**: `l62r1pbjxw7g`
- **Dominio**: `92k.2ce.mytemp.website`
- **Directorio principal**: `/home/l62r1pbjxw7g`
- **Carpeta del sitio**: `/home/l62r1pbjxw7g/public_html/` (probablemente)

---

## PASO 1: OBTENER CREDENCIALES FTP

### Opción A: Desde cPanel
1. En tu cPanel, busca **"FTP Accounts"** o **"Cuentas FTP"**
2. Si no tienes una cuenta FTP creada:
   - Crea una nueva cuenta FTP
   - Usuario: puede ser `l62r1pbjxw7g` o crear uno nuevo
   - Contraseña: elige una segura
   - Directorio: `/public_html` o `/`
3. **Anota estas credenciales:**
   - Servidor FTP: `ftp.92k.2ce.mytemp.website` o `92k.2ce.mytemp.website`
   - Usuario FTP: `l62r1pbjxw7g` (o el que creaste)
   - Contraseña FTP: (la que configuraste)

### Opción B: Usar credenciales de cPanel
- Servidor FTP: `92k.2ce.mytemp.website` o `ftp.92k.2ce.mytemp.website`
- Usuario FTP: `l62r1pbjxw7g`
- Contraseña FTP: (tu contraseña de cPanel)

---

## PASO 2: CONFIGURAR SECRETS EN GITHUB

1. Ve a tu repositorio en GitHub
2. Ve a **Settings** → **Secrets and variables** → **Actions**
3. Haz clic en **"New repository secret"**
4. Crea estos 3 secrets:

### Secret 1: FTP_SERVER
- **Name**: `FTP_SERVER`
- **Value**: `92k.2ce.mytemp.website` o `ftp.92k.2ce.mytemp.website`
- Haz clic en **"Add secret"**

### Secret 2: FTP_USERNAME
- **Name**: `FTP_USERNAME`
- **Value**: `l62r1pbjxw7g` (o tu usuario FTP)
- Haz clic en **"Add secret"**

### Secret 3: FTP_PASSWORD
- **Name**: `FTP_PASSWORD`
- **Value**: (tu contraseña FTP)
- Haz clic en **"Add secret"**

---

## PASO 3: VERIFICAR ARCHIVO DE WORKFLOW

Ya creé el archivo `.github/workflows/deploy.yml` en tu proyecto.

Este archivo:
- ✅ Se ejecuta automáticamente cuando haces push a `main`
- ✅ Construye el proyecto (npm install + npm run build)
- ✅ Sube la carpeta `deploy/` a `/public_html/` en GoDaddy
- ✅ Excluye archivos innecesarios (node_modules, README, etc.)

---

## PASO 4: PRIMERA CONFIGURACIÓN MANUAL

Antes de usar GitHub Actions, necesitas:

1. **Subir `config.php` manualmente** (con tus credenciales de BD)
2. **Verificar que la estructura sea correcta** en GoDaddy

### Estructura esperada en GoDaddy:
```
/home/l62r1pbjxw7g/public_html/
├── index.html
├── contacto.php
├── config.php          ← Subir manualmente con credenciales
├── favicon.ico
├── assets/
└── admin/
```

---

## PASO 5: PROBAR EL DEPLOY

1. Haz un cambio pequeño en tu código
2. Haz commit y push:
   ```bash
   git add .
   git commit -m "Test deploy"
   git push origin main
   ```
3. Ve a GitHub → **Actions** (pestaña)
4. Verás el workflow ejecutándose
5. Espera a que termine (debería tomar 1-2 minutos)
6. Verifica tu sitio: `https://92k.2ce.mytemp.website`

---

## ⚠️ IMPORTANTE: CONFIG.PHP

**NO subas `config.php` con credenciales reales a GitHub.**

El workflow está configurado para:
- ✅ Subir todo de `deploy/`
- ❌ Excluir `config.example.php`

**Solución:**
1. Después del primer deploy, edita `config.php` directamente en GoDaddy vía File Manager
2. O crea un script que lo configure automáticamente

---

## 🔧 AJUSTAR RUTA DEL SERVIDOR

Si tu carpeta no es `/public_html/`, ajusta en `.github/workflows/deploy.yml`:

```yaml
server-dir: /public_html/  # Cambia esto si es diferente
```

Opciones comunes:
- `/public_html/` (más común)
- `/` (raíz del usuario)
- `/home/l62r1pbjxw7g/public_html/` (ruta completa)

---

## ❓ SOLUCIÓN DE PROBLEMAS

### Error: "Could not connect to FTP server"
- Verifica que `FTP_SERVER` sea correcto
- Prueba con y sin `ftp.` al inicio
- Verifica que el puerto FTP esté abierto (generalmente 21)

### Error: "Authentication failed"
- Verifica `FTP_USERNAME` y `FTP_PASSWORD`
- Asegúrate de que las credenciales sean correctas

### Error: "Directory not found"
- Verifica `server-dir` en el workflow
- Asegúrate de que la ruta sea correcta

### Los archivos se suben pero no funcionan
- Verifica permisos de archivos (644 para archivos, 755 para carpetas)
- Verifica que `config.php` tenga las credenciales correctas

---

## ✅ CHECKLIST

- [ ] Obtener credenciales FTP de GoDaddy
- [ ] Configurar 3 secrets en GitHub (FTP_SERVER, FTP_USERNAME, FTP_PASSWORD)
- [ ] Verificar que `.github/workflows/deploy.yml` existe
- [ ] Hacer push a GitHub
- [ ] Verificar que el workflow se ejecute correctamente
- [ ] Configurar `config.php` manualmente en GoDaddy después del primer deploy
- [ ] Probar el sitio

---

## 🎯 RESUMEN RÁPIDO

1. **Obtén credenciales FTP** desde cPanel → FTP Accounts
2. **Configura secrets** en GitHub (Settings → Secrets)
3. **Haz push** a GitHub
4. **Espera** a que GitHub Actions haga el deploy
5. **Configura `config.php`** manualmente en GoDaddy

¡Listo! Cada vez que hagas push a `main`, se desplegará automáticamente.

