@extends('posts.layout')

@section('title', 'Dashboard - Mesa de Ayuda')

@section('content')
<style>
    .dashboard-header {
        margin-bottom: 2rem;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 1rem;
    }

    .dashboard-header h1 {
        margin-bottom: 0.5rem;
        color: #1e293b;
        font-size: 24px;
    }

    .dashboard-header p {
        color: #64748b;
        font-size: 14px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e2e8f0;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .stat-card .label {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-card .value {
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        display: block;
    }

    .stat-card.primary { border-left: 4px solid #3b82f6; }
    .stat-card.success { border-left: 4px solid #10b981; }
    .stat-card.warning { border-left: 4px solid #f59e0b; }
    .stat-card.info { border-left: 4px solid #06b6d4; }

    .welcome-section {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .welcome-text h2 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .welcome-text p {
        opacity: 0.8;
        font-size: 14px;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
    }

    .btn-white {
        background: white;
        color: #1e293b;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.2s;
    }

    .btn-white:hover {
        background: #f1f5f9;
    }
</style>

<div class="dashboard-header">
    <h1>Panel de Control</h1>
    <p>Bienvenido de nuevo, {{ auth()->user()->name }}. Aquí tienes un resumen de la mesa de ayuda.</p>
</div>

<div class="welcome-section">
    <div class="welcome-text">
        <h2>¡Hola, {{ explode(' ', auth()->user()->name)[0] }}!</h2>
        <p>Tienes {{ $stats['pending_posts'] }} tareas pendientes por atender.</p>
    </div>
    <div class="action-buttons">
        <a href="{{ route('posts.create') }}" class="btn-white">Crear Nueva Tarea</a>
        <a href="{{ route('posts.index') }}" class="btn-white">Ver Todo</a>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card primary">
        <span class="label">Total Tareas</span>
        <span class="value">{{ $stats['total_posts'] }}</span>
    </div>
    <div class="stat-card info">
        <span class="label">Técnicos Activos</span>
        <span class="value">{{ $stats['total_technicians'] }}</span>
    </div>
    <div class="stat-card warning">
        <span class="label">Pendientes</span>
        <span class="value">{{ $stats['pending_posts'] }}</span>
    </div>
    <div class="stat-card success">
        <span class="label">Completadas</span>
        <span class="value">{{ $stats['completed_posts'] }}</span>
    </div>
</div>

<div class="recent-activity card" style="background: white; border: 1px solid #e2e8f0;">
    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 1rem; color: #1e293b;">Accesos Rápidos</h3>
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="{{ route('posts.index') }}" style="flex: 1; min-width: 150px; padding: 1rem; border: 1px solid #f1f5f9; border-radius: 8px; text-decoration: none; color: #475569; text-align: center; transition: background 0.2s;">
            <div style="font-size: 24px; margin-bottom: 0.5rem;">📋</div>
            <div style="font-weight: 600;">Gestión de Tareas</div>
        </a>
        @if(auth()->user()->role != 'tecnico')
        <a href="{{ route('technicians.index') }}" style="flex: 1; min-width: 150px; padding: 1rem; border: 1px solid #f1f5f9; border-radius: 8px; text-decoration: none; color: #475569; text-align: center; transition: background 0.2s;">
            <div style="font-size: 24px; margin-bottom: 0.5rem;">👨‍🔧</div>
            <div style="font-weight: 600;">Técnicos</div>
        </a>
        @endif
        @if(auth()->user()->role == 'administrador')
        <a href="{{ route('users.index') }}" style="flex: 1; min-width: 150px; padding: 1rem; border: 1px solid #f1f5f9; border-radius: 8px; text-decoration: none; color: #475569; text-align: center; transition: background 0.2s;">
            <div style="font-size: 24px; margin-bottom: 0.5rem;">👥</div>
            <div style="font-weight: 600;">Usuarios</div>
        </a>
        @endif
    </div>
</div>

@endsection
