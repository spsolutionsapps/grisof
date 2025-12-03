# 📁 CONFIGURAR CUENTA FTP PARA GITHUB ACTIONS

## 🎯 CONFIGURACIÓN RECOMENDADA

Para que GitHub Actions funcione correctamente, tienes **2 opciones**:

---

## ✅ OPCIÓN 1: APUNTAR DIRECTAMENTE A PUBLIC_HTML (RECOMENDADA)

### En el formulario de FTP que estás viendo:

1. **Iniciar sesión (Login):**
   - Escribe: `grisfo` o `deploy` (el nombre que quieras)
   - Se completará como: `grisfo@92k.2ce.mytemp.website`

2. **Contraseña:**
   - Crea una contraseña segura
   - O usa el "Generador de contraseñas"

3. **Directorio:**
   - **CAMBIA** el directorio de `/home/162r1pbjxw7g/` a:
   - **ESCRIBE:** `/public_html/`
   - O la ruta completa: `/home/l62r1pbjxw7g/public_html/`

4. **Cuota:**
   - Deja "Ilimitado" seleccionado

5. **Clic en "Crear cuenta de FTP"**

### Ventajas:
- ✅ Acceso directo a la carpeta del sitio
- ✅ Más seguro (solo acceso a public_html)
- ✅ Más fácil de configurar en GitHub Actions

---

## ✅ OPCIÓN 2: CREAR SUBDIRECTORIO (SI QUIERES ORGANIZAR)

Si prefieres crear una subcarpeta dentro de public_html:

1. **Directorio:**
   - Escribe: `/public_html/grisfo/` o `/public_html/sitio/`
   - Esto creará una subcarpeta dentro de public_html

2. **Luego en GitHub Actions**, ajusta:
   ```yaml
   server-dir: /public_html/grisfo/  # En lugar de /public_html/
   ```

### Ventajas:
- ✅ Organización si tienes múltiples sitios
- ✅ Separación de proyectos

### Desventajas:
- ❌ Tu sitio estará en: `92k.2ce.mytemp.website/grisfo/` (con subcarpeta)
- ❌ Necesitas ajustar GitHub Actions

---

## 🎯 RECOMENDACIÓN PARA TU CASO

**Usa la OPCIÓN 1** (directo a public_html):

### Configuración exacta:

```
Iniciar sesión: grisfo
Contraseña: [una contraseña segura]
Directorio: /public_html/
Cuota: Ilimitado
```

**Usuario FTP completo será:** `grisfo@92k.2ce.mytemp.website`

---

## 📝 DESPUÉS DE CREAR LA CUENTA

Una vez creada, verás algo como:

```
Usuario FTP: grisfo@92k.2ce.mytemp.website
Servidor: 92k.2ce.mytemp.website
Puerto: 21
Directorio: /public_html/
```

**Anota estos datos** para configurar en GitHub Secrets.

---

## ⚠️ IMPORTANTE

- El directorio debe ser `/public_html/` (con barra al final)
- O la ruta completa: `/home/l62r1pbjxw7g/public_html/`
- **NO** uses `/home/l62r1pbjxw7g/` solo (eso da acceso a toda tu cuenta)

---

## 🔧 SI YA CREASTE LA CUENTA CON OTRO DIRECTORIO

No hay problema, puedes:
1. **Eliminar la cuenta FTP** y crear una nueva
2. O **ajustar GitHub Actions** para usar la ruta que configuraste

¿Qué opción prefieres usar?

