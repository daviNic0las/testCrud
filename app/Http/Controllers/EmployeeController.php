<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeUpdateRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->get();
        $total = Employee::count();
        return view('admin.employee.home', compact(['employee','total']));
    }
        public function create()
    {
        return view('admin.employee.create');
    }

    public function save(EmployeeUpdateRequest $request)
    {
        
        $data = $request->validated();
        // dd($data);
        $data = Employee::create($data);
        if ($data) {
            session()->flash('success','Produto adicionado com sucesso');
            return redirect()->route('employee.index');
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('employee.create');
        }
    }

    public function edit($id)
    {
        $employees = Employee::findOrFail($id);
        return view('admin.employee.update', compact('employee'));
    }

    public function delete($id)
    {
        $employees = Employee::findOrFail($id)->delete();
        if ($employees) {
            session()->flash('success', 'Produto excluído com sucesso!');
            return redirect()->route('employee.index');
        } else {
            session()->flash('error','Erro na exclusão do item');
            return redirect()->route('employee.index');
        }
    }
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $employees = Employee::findOrFail($id);
        
        $nome = $request->nome;
        $categoria = $request->categoria;
        $valor = $request->valor;

        $employees->nome = $nome;
        $employees->categoria = $categoria;
        $employees->valor = $valor;
        $data = $employees->save();
        if ($data) {
            session()->flash('success', 'Produto atualizado com sucesso!');
            return redirect()->route('employee.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('employee.update');
        }

    
}
}

