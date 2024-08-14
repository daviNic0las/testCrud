<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Http\Requests\SectorUpdateRequest;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = Sector::orderBy('id', 'desc')->get();
        return view('admin.sector.home', compact(['sectors',]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectors = Sector::all();
        return view('admin.sector.create');
    }

    public function save(SectorUpdateRequest $request)
    {
        
        $data = $request->validated();
        // dd($data);
        $data = Sector::create($data);
        if ($data) {
            session()->flash('success','Setor adicionado com sucesso');
            return redirect()->route('sector.index');
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('sector.create');
        }
    }

    public function edit($id)
    {
        $sectors = Sector::findOrFail($id);
        return view('admin.sector.update', compact('sectors',));
    }

    public function delete($id)
    {
        $sectors = Sector::findOrFail($id)->delete();
        if ($sectors) {
            session()->flash('success', 'Setor excluído com sucesso!');
            return redirect()->route('sector.index');
        } else {
            session()->flash('error','Erro na exclusão do item');
            return redirect()->route('sector.index');
        }
    }
    public function update(SectorUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $sectors = Sector::findOrFail($id);
        
        $nome = $request->nome;
        
        $sectors->nome = $nome;

        $data = $sectors->save();
        if ($data) {
            session()->flash('success', 'Setor atualizado com sucesso!');
            return redirect()->route('sector.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('sector.update');
        }

    
}
}