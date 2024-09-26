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
            session()->flash('success', 'Aluno adicionado com sucesso');
            return redirect()->route('admin.students.home');
        } else {
            session()->flash('error', 'Falha na criação');
            return redirect()->route('admin.students.create');
        }

    }

    public function edit($id)
    {
        $students = Student::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('student.update', compact('students', 'categories'));
    }

    public function update(StudentUpdateRequest $request, $id)
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
            $request->image->move(public_path('img/employee/') . '/' . $imageName);
            $data['image'] = $imageName;

        };

        $student = Student::find($id);
        $input = $student->update($data);

        if ($input) {
            session()->flash('success', 'Aluno atualizado com sucesso!');
            return redirect()->route('admin.students.home');
        } else {
            session()->flash('error', 'Falha na edição');
            return redirect()->route('admin.students.update');
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
            return redirect()->route('admin.students.home');
        } else {
            session()->flash('error', 'Erro na exclusão do item');
            return redirect()->route('admin.students.home');
        }


    }
}