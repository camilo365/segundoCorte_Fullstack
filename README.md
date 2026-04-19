# Gestion de Tareas Colaborativas

Backend del proyecto desarrollado con Laravel.

## Objetivo

Construir una aplicacion web para gestionar tareas dentro de un equipo de trabajo.

## Requisitos

- PHP
- Composer
- MySQL

## Instalacion

1. Clonar el repositorio:

```bash
git clone <https://github.com/camilo365/segundoCorte_Fullstack>
cd segundoCorte_Fullstack
```

2. Instalar dependencias:

```bash
composer install
```

3. Crear el archivo de entorno:

```bash
cp .env.example .env
```

4. Generar la clave de la aplicacion:

```bash
php artisan key:generate
```

5. Configurar la base de datos en el archivo `.env`

6. Ejecutar las migraciones:

```bash
php artisan migrate
```

7. Iniciar el servidor:

```bash
php artisan serve
```

## Acceso

Luego de iniciar el servidor, la aplicacion estara disponible en:

```text
http://127.0.0.1:8000
```

## Funcionalidad actual

El sistema actualmente incluye:

- CRUD de tareas usando la entidad `posts`
- CRUD de tecnicos
- Inicio de sesion de usuarios
- Vistas Blade para listar, crear, editar y ver tareas

## Estructura principal

- `app/`
- `routes/`
- `resources/views/`
- `database/migrations/`

## Tecnologias

- Laravel
- PHP
- MySQL
- Blade

## Estado del proyecto

Proyecto backend en desarrollo para adaptarlo al enunciado de gestion de tareas colaborativas.
