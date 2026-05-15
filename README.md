# 🌮 Taquería El Carnal - Sistema POS

Sistema de Punto de Venta para Taquería El Carnal, desarrollado en PHP puro con MySQL, HTML semántico, CSS vanilla y JavaScript vanilla.

## 📋 Requisitos del Sistema

- **PHP** 7.4 o superior (recomendado 8.0+)
- **MySQL** 5.7 o superior (o MariaDB 10.3+)
- **Apache** 2.4+ con mod_rewrite habilitado
- **Navegador web** moderno (Chrome, Firefox, Edge, Safari)

### Extensiones PHP requeridas
- `pdo_mysql` (conexión a base de datos)
- `json` (manejo de datos JSON)
- `mbstring` (soporte UTF-8)
- `session` (manejo de sesiones)

## 🚀 Instalación Rápida

### 1. Clonar/Copiar el proyecto
```bash
# Copiar la carpeta al directorio web de Apache
cp -r taqueria_elcarnal_php/ /var/www/html/taqueria/
# O si usas XAMPP/WAMP
cp -r taqueria_elcarnal_php/ /opt/lampp/htdocs/taqueria/
```

### 2. Crear la base de datos
```bash
mysql -u root -p < sql/schema.sql
```
O importar el archivo `sql/schema.sql` desde phpMyAdmin.

### 3. Configurar la conexión
Editar el archivo `config/database.php` con tus credenciales:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'taqueria_elcarnal');
define('DB_USER', 'root');
define('DB_PASS', ''); // Tu contraseña de MySQL
```

### 4. Configurar Apache (VirtualHost opcional)
```apache
<VirtualHost *:80>
    ServerName taqueria.local
    DocumentRoot /var/www/html/taqueria
    <Directory /var/www/html/taqueria>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 5. Acceder al sistema
Abrir en el navegador: `http://localhost/taqueria/` o `http://taqueria.local/`

## 🔑 Credenciales de Acceso de Prueba

| Usuario   | Contraseña | Rol      | Acceso                    |
|-----------|------------|----------|---------------------------|
| `admin`   | `admin`    | Admin    | Panel completo de administración |
| `mesero1` | `mesero1`  | Mesero   | Gestión de mesas y pedidos |
| `cocina1` | `cocina1`  | Cocina   | Vista de pedidos pendientes |

## 📦 Módulos del Sistema

### 🔐 Sistema de Autenticación
- Login con usuario y contraseña (password_hash/password_verify)
- 3 roles: Administrador, Mesero, Cocina
- Sesiones PHP seguras con control de acceso
- Registro de login/logout en bitácora

### 👑 Panel de Administración (`/admin/`)
- **Dashboard** con estadísticas en tiempo real (ventas del día, mesas ocupadas, pedidos)
- **Productos**: CRUD completo con categorías, precios, estados
- **Categorías**: Gestión de categorías de productos
- **Usuarios**: CRUD de usuarios con asignación de roles
- **Mesas**: Gestión de mesas (número, capacidad, estado)
- **Bitácora**: Visualización completa con filtros por usuario, módulo, fecha

### 🍽️ Interfaz de Mesero (`/mesero/`)
- Vista de mesas con estados visuales (disponible/ocupada)
- Toma de pedidos con selección de productos por categoría
- Búsqueda rápida de productos
- Cálculo automático de totales
- Ver pedidos activos por mesa
- Cancelar pedidos
- Cerrar cuenta con resumen detallado

### 👨‍🍳 Interfaz de Cocina (`/cocina/`)
- Pedidos pendientes ordenados por tiempo (más antiguos primero)
- Indicador visual de pedidos urgentes (+15 min)
- Marcar como "En Preparación" o "Completado"
- Auto-refresh opcional cada 30 segundos
- Pedidos completados recientes

### 📝 Sistema de Bitácora
- Registro automático de TODAS las operaciones
- Captura: usuario, acción, módulo, tabla, datos anteriores/nuevos (JSON), IP, user agent
- Filtros avanzados por usuario, módulo, acción, rango de fechas
- Paginación

## 🗂️ Estructura del Proyecto

```
taqueria_elcarnal_php/
├── index.php              # Página de login
├── logout.php             # Cerrar sesión
├── .htaccess              # Configuración Apache
├── config/
│   └── database.php       # Conexión a BD
├── includes/
│   ├── auth.php           # Autenticación y control de acceso
│   ├── bitacora.php       # Sistema de bitácora
│   └── helpers.php        # Funciones helper y layout
├── admin/
│   ├── index.php          # Dashboard
│   ├── productos.php      # CRUD productos
│   ├── categorias.php     # CRUD categorías
│   ├── usuarios.php       # CRUD usuarios
│   ├── mesas.php          # CRUD mesas
│   └── bitacora.php       # Visualización bitácora
├── mesero/
│   ├── index.php          # Vista de mesas
│   ├── nuevo_pedido.php   # Tomar pedido
│   ├── pedidos.php        # Mis pedidos
│   ├── ver_pedido.php     # Ver pedidos de mesa
│   ├── cerrar_cuenta.php  # Cerrar cuenta
│   └── cancelar_pedido.php # Cancelar pedido
├── cocina/
│   └── index.php          # Vista de cocina
├── assets/
│   ├── css/
│   │   └── styles.css     # Estilos completos
│   └── js/
│       └── main.js        # JavaScript principal
└── sql/
    └── schema.sql         # Esquema y datos iniciales
```

## 🔒 Seguridad Implementada

- Contraseñas hasheadas con `password_hash()` / `password_verify()`
- Prepared statements (PDO) para todas las consultas SQL
- Escapado de output con `htmlspecialchars()` (función `esc()`)
- Validación y sanitización de inputs
- Control de acceso por roles en cada página
- Sesiones PHP con configuración segura
- `.htaccess` protegiendo archivos sensibles

## 🛠️ Tecnologías

- **Backend**: PHP 7.4+ (sin frameworks)
- **Base de datos**: MySQL 5.7+ con PDO
- **Frontend**: HTML5 semántico, CSS3 vanilla, JavaScript ES5+ vanilla
- **Sin dependencias externas**: No requiere Composer, npm, ni librerías de terceros

## 📄 Licencia

Proyecto desarrollado para uso interno de Taquería El Carnal.
