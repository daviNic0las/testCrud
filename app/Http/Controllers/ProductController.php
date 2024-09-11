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
        return view('admin.product.home', compact(['products', 'total']));
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

        if ($request->hasfile('image') && $request->file('image')->isValid()) {

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img/employee/'), $imageName);
            $data['image'] = $imageName;

        } else {
            $data['image'] = "Foto_Desconhecido.jpg";
        };

        $input = Product::create($data);
        if ($input) {
            session()->flash('success', 'Produto adicionado com sucesso');
            return redirect()->route('products.index');
        } else {
            session()->flash('error', 'Falha na criação');
            return redirect()->route('products.create');
        }

    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.update', compact('products', 'categories'));
    }

    public function update(StoreUpdateSupport $request, $id)
    {
        $data = $request->validated();

        if ($request->has('image')) 
        {
            //Check old image
            $destination = "img/employee/" . $request->image;

            //remove old images
            if(\File::exists($destination)) {
                \File::delete($destination);
            };
            //Add new image
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            //Update new image
            $request->image->move(public_path('img/employee/'), $imageName);
            $data['image'] = $imageName;

        };

        $product = product::find($id);
        $input = $product->update($data);

        if ($input) {
            session()->flash('success', 'Produto atualizado com sucesso!');
            return redirect()->route('products.index');
        } else {
            session()->flash('error', 'Falha na edição');
            return redirect()->route('products.update');
        }

    }

    public function delete($id)
    {
        $data = Product::find($id);
        if($data->image) 
        {
            $destination = public_path('img/employee/'.$data->image);

            if(file_exists($destination && $destination =! public_path('img/employee/Foto_Desconhecido.jpg'))) 
            {
                unlink($destination);
            }; 
        };
        $input = Product::destroy($id);
        
        if ($input) {
            session()->flash('success', 'Produto excluído com sucesso!');
            return redirect()->route('products.index');
        } else {
            session()->flash('error', 'Erro na exclusão do item');
            return redirect()->route('products.index');
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
