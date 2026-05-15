# Guia Completa: Desplegar Taqueria El Carnal en Railway

Esta guia te llevara paso a paso para desplegar tu aplicacion PHP en Railway.

## Requisitos Previos

- Una cuenta de GitHub (gratis): https://github.com/signup
- Una cuenta de Railway (gratis): https://railway.app/

---

## PASO 1: Crear Repositorio en GitHub

### 1.1 Crear cuenta en GitHub (si no tienes)
1. Ve a https://github.com/signup
2. Registrate con tu email
3. Verifica tu email

### 1.2 Crear nuevo repositorio
1. Inicia sesion en GitHub
2. Haz clic en el boton **"+"** (arriba derecha) → **"New repository"**
3. Llena los datos:
   - **Repository name:** `taqueria-elcarnal-pos`
   - **Description:** "Sistema POS para Taqueria El Carnal"
   - **Visibilidad:** Public (o Private si prefieres)
   - ❌ **NO marques** "Add a README file"
   - ❌ **NO agregues** .gitignore
   - ❌ **NO agregues** licencia
4. Haz clic en **"Create repository"**

**¡GUARDA LA URL!** Sera algo como:
```
https://github.com/TU-USUARIO/taqueria-elcarnal-pos.git
```

---

## PASO 2: Subir el Codigo a GitHub

### 2.1 Opcion A: Usar GitHub Desktop (MAS FACIL) ⭐ RECOMENDADA

1. **Descargar GitHub Desktop:**
   - Ve a https://desktop.github.com/
   - Descarga e instala

2. **Configurar GitHub Desktop:**
   - Abre GitHub Desktop
   - Ve a File → Options → Accounts
   - Haz clic en "Sign in" y autoriza con tu cuenta de GitHub

3. **Clonar tu repositorio:**
   - En GitHub Desktop: File → Clone repository
   - Busca `taqueria-elcarnal-pos`
   - Elige donde guardarlo en tu computadora
   - Haz clic en "Clone"

4. **Copiar los archivos:**
   - Abre la carpeta donde clonaste el repo
   - Copia TODOS los archivos de `taqueria_elcarnal_php` ahi
   - Vuelve a GitHub Desktop

5. **Hacer commit y push:**
   - En GitHub Desktop veras todos los archivos en "Changes"
   - En el campo "Summary", escribe: `Initial commit - Sistema POS`
   - Haz clic en **"Commit to main"**
   - Haz clic en **"Push origin"** (arriba)

✅ **¡Listo! Tu codigo ya esta en GitHub**

### 2.2 Opcion B: Usar Linea de Comandos (Git)

Si prefieres la terminal:

```bash
# 1. Ir a la carpeta del proyecto
cd /ruta/a/taqueria_elcarnal_php

# 2. Inicializar Git
git init

# 3. Agregar todos los archivos
git add .

# 4. Hacer commit
git commit -m "Initial commit - Sistema POS"

# 5. Agregar el repositorio remoto (CAMBIA LA URL POR LA TUYA)
git remote add origin https://github.com/TU-USUARIO/taqueria-elcarnal-pos.git

# 6. Subir a GitHub
git branch -M main
git push -u origin main
```

✅ **¡Codigo subido a GitHub!**

---

## PASO 3: Crear Cuenta en Railway

1. Ve a https://railway.app/
2. Haz clic en **"Login"** o **"Start a New Project"**
3. Selecciona **"Login with GitHub"**
4. Autoriza Railway para acceder a tu GitHub
5. ✅ **¡Cuenta creada!**

**💰 Creditos gratis:** Railway te da $5 de credito gratis cada mes

---

## PASO 4: Crear Base de Datos MySQL en Railway

### 4.1 Crear nuevo proyecto
1. En Railway, haz clic en **"New Project"**
2. Selecciona **"Provision MySQL"**
3. Espera unos segundos mientras Railway crea la base de datos
4. ✅ **Base de datos creada**

### 4.2 Obtener credenciales de la base de datos
1. Haz clic en el servicio **"MySQL"** (cuadro morado)
2. Ve a la pestaña **"Variables"**
3. Veras estas variables (APUNTALAS):
   - `MYSQLHOST` (ejemplo: `containers-us-west-123.railway.app`)
   - `MYSQLPORT` (ejemplo: `1234`)
   - `MYSQLDATABASE` (ejemplo: `railway`)
   - `MYSQLUSER` (ejemplo: `root`)
   - `MYSQLPASSWORD` (ejemplo: `abc123xyz`)

### 4.3 Importar el esquema de la base de datos

**Opcion 1: Usar phpMyAdmin (local)** - Si tienes XAMPP/WAMP instalado:
1. Abre phpMyAdmin en tu computadora
2. Ve a "Servidor remoto"
3. Conectate usando las credenciales de Railway
4. Importa el archivo `sql/schema.sql`

**Opcion 2: Usar Railway CLI** (mas facil):

1. Instalar Railway CLI:
   - Windows: Descarga de https://railway.app/cli
   - Mac: `brew install railway`
   - Linux: `npm install -g @railway/cli`

2. Conectar a la base de datos:
```bash
# Iniciar sesion
railway login

# Vincular al proyecto
railway link

# Conectar a MySQL
railway connect MySQL
```

3. Una vez conectado, ejecutar:
```sql
source /ruta/a/sql/schema.sql
```

**Opcion 3: Copiar y pegar en Railway** (MAS FACIL):

1. En Railway, haz clic en tu servicio MySQL
2. Ve a la pestaña "Data"
3. Abre el archivo `sql/schema.sql` en un editor de texto
4. Copia TODO el contenido
5. Pegalo en la consola de Railway y ejecuta

✅ **¡Base de datos lista con todas las tablas!**

---

## PASO 5: Desplegar la Aplicacion PHP desde GitHub

### 5.1 Agregar servicio PHP
1. En tu proyecto de Railway, haz clic en **"+ New"**
2. Selecciona **"GitHub Repo"**
3. Si es la primera vez, autoriza Railway para acceder a tus repos
4. Busca y selecciona **`taqueria-elcarnal-pos`**
5. Haz clic en **"Deploy Now"**

Railway detectara automaticamente que es PHP y comenzara el despliegue.

### 5.2 Configurar variables de entorno
1. Haz clic en tu servicio PHP (el nuevo que se creo)
2. Ve a la pestaña **"Variables"**
3. Agrega estas variables (usando los datos de tu MySQL):

```
DB_HOST=containers-us-west-123.railway.app (tu MYSQLHOST)
DB_PORT=1234 (tu MYSQLPORT)
DB_NAME=railway (tu MYSQLDATABASE)
DB_USER=root (tu MYSQLUSER)
DB_PASS=abc123xyz (tu MYSQLPASSWORD)
```

**¡OJO!** Usa el **puerto** y el **host** exactos de tu MySQL de Railway.

### 5.3 Modificar la configuracion de la base de datos

Tu archivo `config/database.php` debe usar el puerto tambien. Actualiza:

```php
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'taqueria_elcarnal');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// En el DSN:
$dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
```

**Haz este cambio en tu repositorio y haz push de nuevo.**

### 5.4 Redesplegar
1. Railway detectara el cambio automaticamente y redesplegara
2. O puedes hacer clic en **"Deploy"** manualmente

---

## PASO 6: Obtener tu URL Publica

1. Haz clic en tu servicio PHP
2. Ve a la pestaña **"Settings"**
3. Busca la seccion **"Networking"**
4. Haz clic en **"Generate Domain"**
5. ✅ **¡Railway te dara una URL publica!**

Sera algo como:
```
https://taqueria-elcarnal-pos-production.up.railway.app
```

---

## PASO 7: Probar la Aplicacion

1. Abre la URL que Railway te dio
2. Deberias ver la pantalla de login
3. Usa las credenciales de prueba:
   - **Admin:** `admin` / `admin`
   - **Mesero:** `mesero1` / `mesero1`
   - **Cocina:** `cocina1` / `cocina1`

✅ **¡APLICACION FUNCIONANDO EN INTERNET!**

---

## Solucionar Problemas Comunes

### Problema 1: Error de conexion a base de datos
**Solucion:**
- Verifica que las variables de entorno esten correctas
- Asegurate de usar el HOST y PORT de MySQL de Railway
- Verifica que el archivo `config/database.php` use las variables correctamente

### Problema 2: La aplicacion no carga
**Solucion:**
- Ve a la pestaña "Deployments" de tu servicio PHP
- Haz clic en el ultimo deployment
- Revisa los "Logs" para ver el error
- Asegurate de que `composer.json` este en la raiz del proyecto

### Problema 3: Error 500 en Railway
**Solucion:**
- Revisa los logs en Railway
- Puede ser un problema de permisos de escritura
- Verifica que no haya errores de sintaxis en PHP

---

## Actualizar la Aplicacion

Cada vez que hagas cambios:

1. **Edita** los archivos en tu computadora
2. **Commit** los cambios en GitHub Desktop
3. **Push** a GitHub
4. Railway detectara el cambio y **redesplegara automaticamente**

---

## Costos

- **GitHub:** Gratis
- **Railway:** 
  - $5 USD de credito gratis cada mes
  - Despues: ~$5-10/mes dependiendo del uso
  - Plan Hobby: $5/mes con mas recursos

---

## Comandos Utiles de Git

```bash
# Ver estado de archivos
git status

# Agregar archivos modificados
git add .

# Hacer commit
git commit -m "Descripcion de cambios"

# Subir a GitHub
git push

# Ver historial
git log

# Crear nueva rama
git checkout -b nueva-funcionalidad
```

---

## Recursos Adicionales

- **Documentacion de Railway:** https://docs.railway.app/
- **Soporte de Railway:** https://railway.app/help
- **GitHub Docs:** https://docs.github.com/

---

## Contacto y Soporte

Si tienes problemas:
1. Revisa los logs en Railway
2. Consulta la documentacion
3. Busca en la comunidad de Railway: https://railway.app/discord

---

¡Felicidades! Tu sistema POS ya esta en la nube y accesible desde cualquier lugar. 🎉
