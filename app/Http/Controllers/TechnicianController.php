<?php
namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = Technician::latest()->get();
        return view('technicians.index', compact('technicians'));
    }

    public function create()
    {
        return view('technicians.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'names'    => 'required|min:2|max:100',
            'surnames' => 'required|min:2|max:100',
            'age'      => 'required|integer|min:18|max:99',
            'area'     => 'required|max:100',
            'email'    => 'required|email|unique:technicians,email',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('technicians', 'public');
            $data['photo'] = $path;
        }

        $technician = Technician::create($data);

        // Crear automáticamente un usuario para este técnico si no existe
        if (!\App\Models\User::where('email', $technician->email)->exists()) {
            \App\Models\User::create([
                'name' => $technician->names . ' ' . $technician->surnames,
                'email' => $technician->email,
                'password' => bcrypt('password123'), // Contraseña por defecto
                'role' => 'tecnico',
                'photo' => $technician->photo,
            ]);
        }

        return redirect()->route('technicians.index')
            ->with('success', 'Técnico creado correctamente.');
    }

    public function show(Technician $technician)
    {
        return view('technicians.show', compact('technician'));
    }

    public function edit(Technician $technician)
    {
        return view('technicians.edit', compact('technician'));
    }

    public function update(Request $request, Technician $technician)
    {
        $request->validate([
            'names'    => 'required|min:2|max:100',
            'surnames' => 'required|min:2|max:100',
            'age'      => 'required|integer|min:18|max:99',
            'area'     => 'required|max:100',
            'email'    => 'required|email|unique:technicians,email,' . $technician->id,
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($technician->photo && Storage::disk('public')->exists($technician->photo)) {
                Storage::disk('public')->delete($technician->photo);
            }
            $path = $request->file('photo')->store('technicians', 'public');
            $data['photo'] = $path;
        }

        $technician->update($data);

        return redirect()->route('technicians.index')
            ->with('success', 'Técnico actualizado correctamente.');
    }

    public function destroy(Technician $technician)
    {
        if ($technician->photo && Storage::disk('public')->exists($technician->photo)) {
            Storage::disk('public')->delete($technician->photo);
        }
        $technician->delete();

        return redirect()->route('technicians.index')
            ->with('success', 'Técnico eliminado correctamente.');
    }
}