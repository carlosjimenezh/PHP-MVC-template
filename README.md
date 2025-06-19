# 🯡 Desarrollo MVC con Server Side Rendering

Este proyecto implementa el patrón **Modelo-Vista-Controlador (MVC)** con renderizado del lado del servidor (Server Side Rendering - SSR), organizado en capas separadas para el front, el panel de administración (admin) y la API REST.

---

## 🚀 Flujo de trabajo en GitHub

Se recomienda crear tres ramas principales para organizar los cambios:

| Rama    | Descripción                             |
| ------- | --------------------------------------- |
| `Front` | Cambios en el sitio público (frontend). |
| `Admin` | Cambios en el panel de administración.  |
| `API`   | Cambios en los modelos y endpoints API. |

---

## 🎨 Recomendaciones de estilos HTML

Se recomienda el uso de etiquetas HTML semánticas:

- `<strong>` para negrita semántica.
- `<em>` para cursiva semántica.
- `<ul>`, `<ol>`, `<li>` para listas.
- Evitar `b` o `i` salvo que sea solo por estilo.

---

## 🚏 Rutas Front y Admin

| Método | Ruta                           | Descripción             |
| ------ | ------------------------------ | ----------------------- |
| GET    | `/proyectos`                   | Listado de proyectos.   |
| GET    | `/proyectos/create`            | Formulario de creación. |
| GET    | `/proyectos/{idproducto}/edit` | Edición de producto.    |
| GET    | `/proyectos/{idproducto}`      | Detalle de producto.    |

---

## 🔌 Endpoints de la API REST

| Método | Ruta                          | Descripción                 |
| ------ | ----------------------------- | --------------------------- |
| GET    | `/api/proyectos`              | Listar todos los proyectos. |
| GET    | `/api/proyectos/{idproducto}` | Obtener un producto por ID. |
| POST   | `/api/proyectos`              | Crear un nuevo producto.    |
| POST   | `/api/proyectos/{idproducto}` | Actualizar un producto.     |
| DELETE | `/api/proyectos/{idproducto}` | Eliminar un producto.       |

### 📦 Estructura estándar de respuesta

- Éxito:

```json
{ "ok": true, ... }
```

- Error:

```json
{ "ok": false, "mensaje": "mensaje de error" }
```

> _Nota: en el futuro se agregará un campo "tipo de aviso"._

---

## 📁 Estructura de Carpetas

```bash
- admin/               # Administración
  ├── controllers/
  ├── templates/
  ├── views/
  ├── index.php
  └── .htaccess

- api/                 # API REST
  ├── controllers/
  ├── db/connection.php
  ├── models/
  ├── index.php
  └── .htaccess

- assets/              # Recursos estáticos
  ├── proyectos/
  ├── proyectos_s/
  └── imagen.jpg

- core/                # Configuración y utilidades globales
  ├── core.php
  └── functions.php

- controllers/         # Controladores del frontend
  └── proyectosController.php

- css/                 # Estilos CSS
  ├── w3css.css
  ├── fonts.css
  ├── root.css
  ├── common.css
  └── estilo.css

- fonts/               # Fuentes
  └── fuente.woff2

- js/                  # Scripts JS
  ├── common.js
  └── icons.js

- templates/           # Plantillas comunes
  ├── head.php
  ├── header.php
  └── footer.php

- views/               # Vistas públicas
  └── proyectos.php

.gitignore
.htaccess
index.php              # Entrada principal
```

---

## 🛠 Crear una nueva vista

Supongamos que deseas crear una nueva vista: `/nueva-vista`

1️⃣ **Crear el controlador**

- Ruta: `controllers/nuevaVistaController.php`\
  _(El nombre debe estar en CamelCase)_

2️⃣ **Crear la vista**

- Ruta: `views/nuevaVista.php`\
  _(El nombre corresponde al recurso de la URL)_

Cuando accedas a `/nueva-vista`, el enrutador buscará `nuevaVistaController`. Si no existe, devolverá error 404.

---

## 🛠 Crear un nuevo endpoint en la API

Supongamos que quieres agregar el recurso `proyectos`.

1️⃣ **Crear el modelo**

- Ruta: `api/models/proyectosModel.php`\
  _(Aquí va la lógica de base de datos)_

2️⃣ **Crear el controlador**

- Ruta: `api/controllers/proyectosController.php`\
  _(Este controlador llamará al modelo y devolverá la respuesta API)_

Cuando accedas a `/api/proyectos`, el enrutador buscará el controlador correspondiente.

---

## 🚀 Subir el proyecto a producción

En el archivo `core/core.php`, modificar la variable:

```php
$prod = true;
```

Esto activa el entorno de producción.
