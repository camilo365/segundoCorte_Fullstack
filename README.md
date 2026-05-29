# 🛠️ Sistema de Mesa de Ayuda (Help Desk) - Laravel 12

Este proyecto es una plataforma de gestión de tareas y técnicos diseñada para optimizar la resolución de incidencias en un entorno de desarrollo o soporte técnico.

---

## 📂 Guía Detallada de Archivos PHP

A continuación se describe la función de cada archivo `.php` en el proyecto, organizados por su ubicación:

### 🚀 Raíz y Arranque
*   **`artisan`**: Interfaz de línea de comandos de Laravel para ejecutar tareas de mantenimiento, migraciones y generación de código.
*   **`server.php`**: Permite emular el servidor web Apache `mod_rewrite` cuando se usa el servidor de desarrollo integrado de PHP.
*   **`public/index.php`**: El punto de entrada principal para todas las solicitudes que llegan a la aplicación. Carga el framework y procesa la petición.
*   **`bootstrap/app.php`**: Configura la instancia de la aplicación, registra proveedores de servicios y define los middlewares globales.

### 🧠 Lógica de la Aplicación (App)
#### Núcleo y Manejo de Errores
*   **`app/Http/Kernel.php`**: Registra middlewares HTTP y los organiza en grupos (como `web` y `api`).
*   **`app/Console/Kernel.php`**: Define comandos personalizados de Artisan y programa tareas recurrentes (cron jobs).
*   **`app/Exceptions/Handler.php`**: Centraliza el manejo de todas las excepciones y errores de la aplicación.

#### Controladores (`app/Http/Controllers/`)
*   **`Controller.php`**: Clase base de la que heredan todos los controladores de Laravel.
*   **`PostController.php`**: Maneja el CRUD de tareas (tickets). Implementa la lógica de visualización según el rol y la asignación a técnicos.
*   **`TechnicianController.php`**: Gestiona el registro y administración de técnicos, incluyendo la subida de fotos de perfil.
*   **`UserController.php`**: Administra los usuarios del sistema, sus datos y la asignación de roles.
*   **`AuthController.php`**: (Si existe en la raíz de Controllers) Gestiona la lógica personalizada de autenticación.
*   **`Auth/`**: Contiene controladores estándar de Laravel Breeze para login, registro y recuperación de contraseñas.

#### Modelos (`app/Models/`)
*   **`User.php`**: Representa a los usuarios del sistema. Incluye los campos de rol y foto.
*   **`Post.php`**: Representa las tareas o tickets. Define la relación con el técnico asignado.
*   **`Technician.php`**: Representa a los técnicos. Almacena su información, correo y foto.

#### Middleware (`app/Http/Middleware/`)
*   **`RoleMiddleware.php`**: Filtra el acceso a las rutas basándose en el rol del usuario (`administrador`, `editor`, `tecnico`, `invitado`).
*   **`Authenticate.php`**: Asegura que el usuario esté autenticado para acceder a ciertas rutas.
*   **`RedirectIfAuthenticated.php`**: Redirige a usuarios logueados que intentan acceder a páginas de login/registro.
*   **`VerifyCsrfToken.php`**: Protege la aplicación contra ataques CSRF (Cross-Site Request Forgery).
*   **Otros (`TrimStrings`, `TrustProxies`, etc.)**: Realizan tareas de limpieza y seguridad en las peticiones HTTP.

#### Otros en App
*   **`Mail/TicketAssigned.php`**: Define la estructura y el contenido del correo electrónico enviado cuando se asigna un ticket.
*   **`Providers/*.php`**: Registran servicios esenciales como rutas (`RouteServiceProvider`), eventos y políticas de seguridad.
*   **`View/Components/*.php`**: Lógica de PHP para componentes reutilizables de Blade como `AppLayout` y `GuestLayout`.

### ⚙️ Configuración (`config/`)
*   **`app.php`**: Configuración general del nombre, idioma, zona horaria y proveedores.
*   **`auth.php`**: Define los guards y proveedores de autenticación (quién se puede loguear).
*   **`database.php`**: Configura las conexiones a bases de datos (MySQL/SQLite/XAMPP).
*   **`filesystems.php`**: Configura el almacenamiento de archivos (Local, Public, S3).
*   **`mail.php`**: Ajustes para el envío de correos electrónicos.

### 🗄️ Base de Datos (`database/`)
*   **`migrations/*.php`**: Definen la estructura de las tablas (usuarios, posts, técnicos, roles).
*   **`seeders/DatabaseSeeder.php`**: Permite poblar la base de datos con datos de prueba iniciales.
*   **`factories/UserFactory.php`**: Genera datos aleatorios para el modelo User en pruebas.

### 🛤️ Rutas (`routes/`)
*   **`web.php`**: Define las URLs accesibles por el navegador y sus controladores/vistas asociados.
*   **`auth.php`**: Rutas específicas de autenticación (Login, Logout, Registro).
*   **`api.php`**: Rutas para interfaces de programación de aplicaciones (si se requieren).

---

## 🔐 Sistema de Roles y Permisos
... (Resto del contenido original)


El sistema está configurado con una jerarquía de acceso:

1.  **Administrador**: Acceso total (Crear, Editar, Eliminar todo). Puede gestionar usuarios.
2.  **Editor**: Puede crear y editar tareas y técnicos, pero no puede eliminar ni gestionar usuarios.
3.  **Técnico**: 
    *   Solo ve las tareas que tiene asignadas.
    *   No tiene acceso al módulo de Técnicos ni Usuarios.
    *   En edición de tareas, **solo puede cambiar el estado** (Pendiente -> Finalizada).
4.  **Invitado**: Solo lectura de tareas.

---

## 🚀 Funcionalidades Especiales

*   **Notificaciones por Email**: Cuando se asigna una tarea a un técnico, el sistema envía automáticamente un correo electrónico informándole del nuevo ticket.
*   **Gestión de Imágenes**: Los usuarios y técnicos pueden tener fotos de perfil almacenadas de forma segura en el servidor.
*   **Dashboard Moderno**: Panel visual con estadísticas dinámicas basadas en la base de datos real.

---

## 🛠️ Comandos Útiles

Si necesitas actualizar la base de datos o los enlaces de imágenes:

```bash
# Sincronizar la carpeta de imágenes
php artisan storage:link

# Ejecutar nuevas migraciones
php artisan migrate
```
