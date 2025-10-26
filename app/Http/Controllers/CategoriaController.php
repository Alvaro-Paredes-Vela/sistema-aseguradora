<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'coberturas' => 'nullable',
            'descripcion' => 'nullable',
        ]);

        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function show($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria);
        return view('categoria.show', compact('categoria'));
    }

    public function edit($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria);
        return view('categoria.edit', compact('categoria'));
    }

    public function update(Request $request, $id_categoria)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'coberturas' => 'nullable',
            'descripcion' => 'nullable',
        ]);

        $categoria = Categoria::findOrFail($id_categoria);
        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria);
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
