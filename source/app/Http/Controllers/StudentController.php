<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();
        $students_count = count($students);
        $http_code = 200;
        
        if($students_count==0){
            $message ='Não há estudantes cadastrados.';
        }else{
            $message = 'Lista de todos(as) os(as) estudantes.';
        }
        return response([
            'data'=>$students,
            'message'=>$message,
            'count'=>$students_count
        ], $http_code);
    }
    
    public function show($id)
    {
        $student = Student::find($id);
        if($student){
            $http_code = 200;
            $message ='Aluno(a).';
        }else{
            $http_code = 404;
            $message ='Não foi encontrado nenhum(a) aluno(a).';
        }
        return response([
            'data'=>$student,
            'message'=>$message
        ], $http_code);
    }

    public function search($name){
        $students = Student::where('name','like','%'.$name.'%')->get();
        $students_count = count($students);
        $http_code = 200;
        
        if($students_count==0){
            $message ='Não foi encontrado(a) nenhum(a) estudante.';
        }else{
            $message = 'Resultado da busca.';
        }
        return response([
            'data'=>$students,
            'message'=>$message,
            'count'=>$students_count
        ], $http_code);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);
        
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->birth_date = $request->birth_date;
        $student->gender = $request->gender;

        $student->save();
        return response(['date'=>$student], 201);
    }

    public function destroy($id){
        $student= Student::find($id);
        if($student){
            $http_code = 200;
            $student->delete();
            $message = "Aluno(a) exclido(a) com sucesso.";
        }else{
            $http_code = 404;
            $message = "Aluno(a) não encontrado(a).";
        }
        
        return response([
            'data'=>$student,
            'message'=>$message
        ], $http_code);

    }

    public function edit($id){
        $student = Student::find($id);
        if($student){
            $fields = (object) array(
                'name' => $student->name,
                'email' => $student->email,
                'phone'=> $student->phone,
                'birth_date'=> $student->birth_date,
                'gender'=> $student->gender
            );
            $http_code = 200;
            $message ='Editar aluno(a).';
        }else{
            $fields = null;
            $http_code = 404;
            $message ='Não foi encontrado nenhum(a) aluno(a).';
        }
        return response([
            'data'=>$fields,
            'message'=>$message
        ], $http_code);
    }
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if($student){
            $http_code = 200;
            $student->update($request->all());
            $message = "Os dados do(a) aluno(a) foram atualizados";
        }else{
            $http_code = 404;
            $message = "Aluno(a) não encontrado(a).";
        }
        return response([
            'data'=>$student,
            'message'=>$message
        ], $http_code);
    }
}
