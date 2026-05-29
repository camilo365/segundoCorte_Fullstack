<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Technician;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketAssigned;

class PostController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role == 'tecnico') {
            // Buscamos al técnico por el correo del usuario logueado
            $technician = Technician::where('email', $user->email)->first();
            
            if ($technician) {
                $posts = Post::where('technician_id', $technician->id)->latest()->get();
            } else {
                $posts = collect(); // Si no es técnico registrado, no ve nada
            }
        } else {
            $posts = Post::latest()->get();
        }

        $technicians = Technician::all();
        return view('posts.index', compact('posts', 'technicians'));
    }
    public function create()
    {
        $technicians = Technician::all();
        return view('posts.create', compact('technicians'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'category' => 'nullable|max:100',
            'status' => 'required|in:pendiente,en_proceso,finalizada',
            'due_date' => 'nullable|date',
            'technician_id' => 'nullable|exists:technicians,id',
        ]);
        $post = Post::create($request->all());

        if ($post->technician_id) {
            $technician = Technician::find($post->technician_id);
            if ($technician && $technician->email) {
                Mail::to($technician->email)->send(new TicketAssigned($post));
            }
        }

        return redirect()->route('posts.index')
            ->with('success', 'Tarea creada correctamente.');
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function edit(Post $post)
    {
        $technicians = Technician::all();
        return view('posts.edit', compact('post', 'technicians'));
    }
    public function update(Request $request, Post $post)
    {
        $user = auth()->user();

        if ($user->role == 'tecnico') {
            // El técnico solo puede actualizar el estado
            $request->validate([
                'status' => 'required|in:pendiente,en_proceso,finalizada',
            ]);
            
            $post->update($request->only('status'));
        } else {
            // Admin y Editor pueden actualizar todo
            $request->validate([
                'title' => 'required|min:3|max:255',
                'content' => 'required|min:10',
                'category' => 'nullable|max:100',
                'status' => 'required|in:pendiente,en_proceso,finalizada',
                'due_date' => 'nullable|date',
                'technician_id' => 'nullable|exists:technicians,id',
            ]);
            
            $oldTechnicianId = $post->technician_id;
            $post->update($request->all());

            if ($post->technician_id && $post->technician_id != $oldTechnicianId) {
                $technician = Technician::find($post->technician_id);
                if ($technician && $technician->email) {
                    Mail::to($technician->email)->send(new TicketAssigned($post));
                }
            }
        }

        return redirect()->route('posts.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Tarea eliminada correctamente.');
 
    }
}
