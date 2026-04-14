<?php
namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;

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
        ]);

        Technician::create($request->all());

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
        ]);

        $technician->update($request->all());

        return redirect()->route('technicians.index')
            ->with('success', 'Técnico actualizado correctamente.');
    }

    public function destroy(Technician $technician)
    {
        $technician->delete();

        return redirect()->route('technicians.index')
            ->with('success', 'Técnico eliminado correctamente.');
    }
}