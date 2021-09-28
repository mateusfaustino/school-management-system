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
}
