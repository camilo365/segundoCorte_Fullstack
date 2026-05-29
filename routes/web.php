<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se definen todas las rutas de la aplicación.
| El acceso está controlado por el middleware 'auth' y el middleware personalizado 'role'.
|
*/

// --- Ruta de Inicio ---
Route::get('/', function () {
    return view('welcome');
});

// --- Rutas Protegidas (Requieren Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard con estadísticas
    Route::get('/dashboard', function () {
        $stats = [
            'total_posts' => \App\Models\Post::count(),
            'total_technicians' => \App\Models\Technician::count(),
            'pending_posts' => \App\Models\Post::where('status', 'pendiente')->count(),
            'completed_posts' => \App\Models\Post::where('status', 'completado')->count(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');

    /**
     * MODULO DE TAREAS (POSTS)
     */
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    // Tareas: Crear y Guardar (Solo Admin y Editor)
    Route::middleware(['role:administrador,editor'])->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    });

    // Tareas: Editar y Actualizar (Admin, Editor y Tecnico)
    Route::middleware(['role:administrador,editor,tecnico'])->group(function () {
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    });

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::middleware(['role:administrador'])->group(function () {
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    /**
     * MODULO DE TÉCNICOS (TECHNICIANS)
     */
    Route::get('/technicians', [TechnicianController::class, 'index'])->name('technicians.index');

    Route::middleware(['role:administrador,editor'])->group(function () {
        Route::get('/technicians/create', [TechnicianController::class, 'create'])->name('technicians.create');
        Route::post('/technicians', [TechnicianController::class, 'store'])->name('technicians.store');
        Route::get('/technicians/{technician}/edit', [TechnicianController::class, 'edit'])->name('technicians.edit');
        Route::put('/technicians/{technician}', [TechnicianController::class, 'update'])->name('technicians.update');
    });

    Route::get('/technicians/{technician}', [TechnicianController::class, 'show'])->name('technicians.show');

    Route::middleware(['role:administrador'])->group(function () {
        Route::delete('/technicians/{technician}', [TechnicianController::class, 'destroy'])->name('technicians.destroy');
    });

    /**
     * MODULO DE USUARIOS (USERS)
     */
    Route::middleware(['role:administrador'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        
        // Alias para el registro (usado por Breeze internamente en algunos enlaces)
        Route::get('/register', [UserController::class, 'create'])->name('register');
    });

});

// Rutas de Autenticación (Login, Logout, Reset Password)
require __DIR__.'/auth.php';
