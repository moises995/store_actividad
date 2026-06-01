# Sistema de Gestión de Inventario — Store Actividad

Aplicación web para la administración de un catálogo de productos con generación de códigos de barras.

Desarrollado con **CodeIgniter 4** como proyecto de práctica/actividad académica.

---

## Tabla de contenidos

- [Descripción](#descripción)
- [Tecnologías](#tecnologías)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Base de datos](#base-de-datos)
- [Módulos del sistema](#módulos-del-sistema)
- [Estructura del proyecto](#estructura-del-proyecto)

---

## Descripción

Permite gestionar un catálogo de productos con las operaciones CRUD básicas:

- Listar todos los productos activos
- Crear un nuevo producto
- Editar un producto existente
- Desactivar (borrado lógico) un producto

El borrado es **lógico**: los productos eliminados tienen `activo = 1`; los activos tienen `activo = NULL`.

---

## Tecnologías

| Capa | Tecnología | Versión |
|---|---|---|
| Backend | PHP | >= 8.1 |
| Framework | CodeIgniter 4 | ^4.4 |
| Base de datos | MySQL / MariaDB | >= 5.7 |
| Códigos de barras | picqer/php-barcode-generator | ^2.0 |
| UI | Bootstrap | 4.3.1 |
| Gestor de paquetes | Composer | >= 2.0 |

---

## Requisitos

- PHP >= 8.1 con extensiones: `mysqli`, `mbstring`, `json`
- MySQL >= 5.7 o MariaDB >= 10.4
- Composer >= 2.0

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/moises995/store_actividad.git
cd store_actividad
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Configurar el entorno

```bash
cp env .env
```

Editar `.env` con los valores de la base de datos (ver [Configuración](#configuración)).

### 4. Importar la base de datos

```bash
mysql -u root -p < store.sql
```

### 5. Levantar el servidor

```bash
php spark serve
```

Acceder a `http://localhost:8080`. En producción, apuntar el `DocumentRoot` a la carpeta `public/`.

---

## Configuración

Editar `.env` con los valores correspondientes:

```ini
# Entorno
CI_ENVIRONMENT = development

# URL base
app.baseURL = 'http://localhost:8080/'

# Base de datos
database.default.hostname = localhost
database.default.database = store
database.default.username = root
database.default.password = TU_PASSWORD
database.default.DBDriver = MySQLi
```

---

## Base de datos

Una sola base de datos con una tabla principal:

### Tabla `productos`

| Columna | Tipo | Descripción |
|---|---|---|
| `producto_id` | INT AUTO_INCREMENT | Clave primaria |
| `nombre` | VARCHAR(255) | Nombre del producto |
| `sku` | VARCHAR(25) | Código único del producto |
| `categoria` | VARCHAR(50) | Categoría |
| `precio` | FLOAT | Precio de venta |
| `descripcion` | VARCHAR(255) | Descripción |
| `codigo_de_barras` | VARCHAR(255) | Código de barras |
| `activo` | VARCHAR(1) | NULL = activo, 1 = desactivado (borrado lógico) |
| `create_time` | TIMESTAMP | Fecha de creación |
| `update_time` | TIMESTAMP | Última actualización |

Para importar el esquema y datos de prueba:

```bash
mysql -u root -p < store.sql
```

---

## Módulos del sistema

### Home (`/home`)
Lista todos los productos activos en una tabla con acceso a edición.

### Administración (`/administracion`)

| Ruta | Método | Descripción |
|---|---|---|
| `/administracion/nuevo` | GET | Formulario de creación |
| `/administracion/guardar` | POST | Guarda el nuevo producto |
| `/administracion/editar/{id}` | GET | Formulario de edición |
| `/administracion/update/{id}` | POST | Actualiza el producto |
| `/administracion/delete/{id}` | GET | Desactiva el producto (borrado lógico) |

---

## Estructura del proyecto

```
store_actividad/
├── app/
│   ├── Config/
│   │   └── Routes.php           # Rutas explícitas (auto-routing deshabilitado)
│   ├── Controllers/
│   │   ├── BaseController.php   # Helper renderLayout()
│   │   ├── Home.php             # Listado de productos
│   │   └── Administracion.php   # CRUD de productos
│   ├── Models/
│   │   └── productos.php        # getAll, getById, create, updateById, softDelete
│   └── Views/
│       ├── @shell/              # Layout: html_top, html_bottom
│       ├── home.php             # Vista principal con tabla de productos
│       └── administracion/
│           ├── nuevo.php        # Formulario de creación
│           └── editar.php       # Formulario de edición
├── public/                      # DocumentRoot del servidor web
├── store.sql                    # Esquema y datos de prueba
└── composer.json                # Dependencias PHP
```
