<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $total = Product::count();
        $produtos = Product::with('category')->get();
        return view('admin.product.home', compact(['products','total']));
    }
        public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function save(StoreUpdateSupport $request)
    {
        
        $data = $request->validated();
        // dd($data);
        $data = Product::create($data);
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/products', $filename, 'public');
            $data['image'] = $path;
            }

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
        $categories = Category::all();
        return view('admin.product.update', compact('products', 'categories'));
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
    public function update(StoreUpdateSupport $request, $id)
    {
        $data = $request->validated();

        $products = Product::findOrFail($id);
        
        $nome = $request->nome;
        $category_id = $request->category_id;
        $valor = $request->valor;

        $products->nome = $nome;
        $products->category_id = $category_id;
        $products->valor = $valor;
        $data = $products->save();

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
           }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/products', $filename, 'public');
            $data['image'] = $path;
       }

        if ($data) {
            session()->flash('success', 'Produto atualizado com sucesso!');
            return redirect()->route('products.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('products.update');
        }

    
}
} 

// if($this->has('image')) {
//     $file = $this->file('image');
//     $extension = $file->getClientOriginalExtension();

//     $filename = time().'.'.$extension;

//     $path = 'uploads.category';
//     $file->move($path, $filename);

//     Product::create([
//         'image' => $path.$filename,
//     ]);

// }



// public function store(StoreUpdateSupport $request)
//     {
//         $data = $request->validated();

       

// public function update(StoreUpdateSupport $request, $id)
//     {
//         $product = Product::findOrFail($id);
//         $data = $request->validated();

         