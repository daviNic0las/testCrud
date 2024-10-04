<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Category;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('student_id', 'desc')->get();
        $total = Student::count();
        $estudantes = Student::with('category')->get();
        return view('admin.student.home', compact(['students', 'total']));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.student.create', compact('categories'));
    }

    public function store(StudentUpdateRequest $request)
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

        $input = Student::create($data);
        if ($input) {
            session()->flash('success', 'Aluno adicionado com sucesso!');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Falha na adição do aluno.');
            return redirect()->route('student.create');
        }

    }

    public function edit($id)
    {
        $students = Student::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.student.update', compact('students', 'categories'));
    }

    public function update(StudentUpdateRequest $request, $id)
{
    $student = Student::findOrFail($id);
    $data = $request->validated();

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        if (\File::exists(public_path('img/employee/' . $student->image)) && $student->image !== "Foto_Desconhecido.jpg") {
            \File::delete(public_path('img/employee/' . $student->image));
        }

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('img/employee/'), $imageName);
        $data['image'] = $imageName;
    }

    $input = $student->fill($data)->save();

    if ($input) {
        session()->flash('success', 'Aluno atualizado com sucesso!');
        return redirect()->route('student.index');
    } else {
        session()->flash('error', 'Falha na edição do aluno.');
        return redirect()->route('student.update', $student->id)->withInput($request->all());
    }
}


    public function destroy($id)
    {
        $data = Student::find($id);
        if($data->image) 
        {
            $destination = public_path('img/employee/'.$data->image);

            if(file_exists($destination) && $destination != public_path('img/employee/Foto_Desconhecido.jpg')) 
            {
                unlink($destination);
            }; 
        };

        $input = Student::destroy($id);
        
        if ($input) {
            session()->flash('success', 'Aluno excluído com sucesso!');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Erro na exclusão do aluno.');
            return redirect()->route('student.index');
        }


    }
}