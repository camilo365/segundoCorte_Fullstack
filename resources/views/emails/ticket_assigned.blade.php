<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { padding: 20px; border: 1px solid #eee; border-radius: 10px; max-width: 600px; }
        .header { background: #1e293b; color: white; padding: 10px 20px; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nueva Tarea Asignada</h2>
        </div>
        <div class="content">
            <p><strong>¡Hola, Técnico!</strong></p>
            <p>Se te ha asignado el ticket <strong>#{{ $post->id }}</strong> para realizar la siguiente actividad:</p>
            
            <hr style="border: 0; border-top: 1px solid #eee;">
            
            <p><strong>Título de la tarea:</strong> {{ $post->title }}</p>
            <p><strong>Descripción:</strong><br>
            {{ $post->content }}</p>
            
            @if($post->due_date)
                <p><strong>Fecha límite:</strong> {{ $post->due_date }}</p>
            @endif

            <p>Por favor, ingresa al sistema para actualizar el estado una vez que comiences a trabajar en ella.</p>
        </div>
        <div class="footer">
            Este es un correo automático generado por la Mesa de Colaboración.
        </div>
    </div>
</body>
</html>
