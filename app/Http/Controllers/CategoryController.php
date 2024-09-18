<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.home', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create');
    }

    public function store(CategoryUpdateRequest $request)
    {

        $data = $request->validated();
        // dd($data);
        $data = Category::create($data);
        if ($data) {
            session()->flash('success', 'Categoria adicionada com sucesso');
            return redirect()->route('category.index');
        } else {
            session()->flash('error', 'Falha na criação');
            return redirect()->route('category.create');
        }
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.category.update', compact('categories', ));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $categories = Category::findOrFail($id);

        $nome = $request->nome;

        $categories->nome = $nome;

        $data = $categories->save();
        if ($data) {
            session()->flash('success', 'Categoria atualizada com sucesso!');
            return redirect()->route('category.index');
        } else {
            session()->flash('error', 'Falha na edição');
            return redirect()->route('category.update');
        }
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id)->delete();
        if ($categories) {
            session()->flash('success', 'Categoria excluída com sucesso!');
            return redirect()->route('category.index');
        } else {
            session()->flash('error', 'Erro na exclusão do item');
            return redirect()->route('category.index');
        }
    }
}