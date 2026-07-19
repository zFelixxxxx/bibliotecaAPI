# Biblioteca API

Proyecto desarrollado en **Laravel 10** como parte de la Evaluación Integral del curso **Programación Web Básica**.

El sistema permite administrar una biblioteca mediante una API RESTful y un Dashboard Web desarrollado con Laravel Blade.

---

# Autor

**Félix Ronaldo García Tume**

Curso: Programación Web Básica

Framework: Laravel 10

Base de datos: MySQL

---

# Tecnologías utilizadas

- Laravel 10
- PHP 8
- MySQL
- Bootstrap 5
- JavaScript
- Blade
- Vite
- Postman

---

# Funcionalidades

- CRUD de Autores
- CRUD de Categorías
- CRUD de Editoriales
- CRUD de Libros
- CRUD de Préstamos
- API RESTful
- Dashboard Web
- Validaciones de datos
- Relaciones Eloquent
- Autenticación de usuarios

---

# Módulos del sistema

- Autores
- Categorías
- Editoriales
- Libros
- Préstamos
- Usuarios

---

# Estructura del proyecto

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
```

Las vistas Blade están organizadas por entidad:

```
resources/views/

autores/
categorias/
libros/
```

---

# Instalación

Clonar el repositorio

```bash
git clone https://github.com/zFelixxxxx/bibliotecaAPI.git
```

Ingresar al proyecto

```bash
cd bibliotecaAPI
```

Instalar dependencias

```bash
composer install
```

```bash
npm install
```

Copiar el archivo de entorno

```bash
cp .env.example .env
```

Generar la llave de Laravel

```bash
php artisan key:generate
```

Configurar la conexión a la base de datos en el archivo `.env`

Ejecutar migraciones

```bash
php artisan migrate
```

Cargar datos de prueba

```bash
php artisan db:seed
```

Iniciar el servidor

```bash
php artisan serve
```

Compilar recursos

```bash
npm run dev
```

---

# Endpoints de la API

## Autores

```
GET     /api/autores
POST    /api/autores
GET     /api/autores/{id}
PUT     /api/autores/{id}
DELETE  /api/autores/{id}
```

## Categorías

```
GET     /api/categorias
POST    /api/categorias
GET     /api/categorias/{id}
PUT     /api/categorias/{id}
DELETE  /api/categorias/{id}
```

## Editoriales

```
GET     /api/editoriales
POST    /api/editoriales
GET     /api/editoriales/{id}
PUT     /api/editoriales/{id}
DELETE  /api/editoriales/{id}
```

## Libros

```
GET     /api/libros
POST    /api/libros
GET     /api/libros/{id}
PUT     /api/libros/{id}
DELETE  /api/libros/{id}
```

## Préstamos

```
GET     /api/prestamos
POST    /api/prestamos
GET     /api/prestamos/{id}
PUT     /api/prestamos/{id}
DELETE  /api/prestamos/{id}
```

---

# Dashboard

El sistema cuenta con un Dashboard Web que permite administrar:

- Autores
- Categorías
- Libros

Cada módulo permite:

- Registrar
- Consultar
- Editar
- Eliminar

---

# Base de datos

El proyecto utiliza las siguientes tablas:

- users
- autores
- categorias
- editoriales
- libros
- prestamos

---

# Datos de prueba

El proyecto incluye un seeder que registra datos iniciales para facilitar las pruebas.

Se generan registros para:

- 10 autores
- 10 categorías
- 10 editoriales
- 10 libros
- 10 préstamos

Para cargar los datos ejecutar:

```bash
php artisan db:seed
```

---

# Documentación Postman

Agregar aquí el enlace público de la colección de Postman.

Ejemplo:

```
https://documenter.getpostman.com/view/XXXXXXXXX/XXXXXXXX
```

---

# Repositorio GitHub

```
https://github.com/zFelixxxxx/bibliotecaAPI
```

---

# Licencia

Proyecto desarrollado con fines académicos para el curso **Programación Web Básica**, utilizando Laravel Framework.