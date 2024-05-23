<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $total = Product::count();
        return view('admin.product.home', compact(['products','total']));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([  
            'nome'=> 'required',
            'categoria'=> 'required',
            'preço'=> 'required',
        ]);

        $data = Product::create($validation);
        if ($data) {
            session()->flash('success','Produto adicionado com sucesso');
            return redirect()->route('products.index');
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('products.create');
        }
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.product.update', compact('products',));
    }

    public function delete($id)
    {
        $products = Product::findOrFail($id)->delete();
        if ($products) {
            session()->flash('success', 'Produto excluído com sucesso!');
            return redirect()->route('products.index');
        } else {
            session()->flash('error','Erro na exclusão do item');
            return redirect()->route('products.index');
        }
    }
    public function update(Request $request, $id)
    {

        $validation = $request->validate([  
            'nome'=> 'required',
            'categoria'=> 'required',
            'preço'=> 'required',
        ]);

        $products = Product::findOrFail($id, $validation);
        $nome = $request->nome;
        $categoria = $request->categoria;
        $preço = $request->preço;

        $products->nome = $nome;
        $products->categoria = $categoria;
        $products->preço = $preço;
        $data = $products->save();
        if ($data) {
            session()->flash('success', 'Produto atualizado com sucesso!');
            return redirect()->route('products.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('products.update');
        }

    
}
}