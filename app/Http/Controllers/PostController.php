<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Technician;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $technicians = Technician::all();
        return view('posts.index', compact('posts', 'technicians'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'category' => 'nullable|max:100',
            'status' => 'required|in:pendiente,en_proceso,finalizada',
            'due_date' => 'nullable|date',
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index')
            ->with('success', 'Tarea creada correctamente.');
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'category' => 'nullable|max:100',
            'status' => 'required|in:pendiente,en_proceso,finalizada',
            'due_date' => 'nullable|date',
        ]);
        $post->update($request->all());
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
