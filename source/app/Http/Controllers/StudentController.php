<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $students_count = count($students);
        $http_code = 200;
        
        if($students_count==0){
            $message ='Não há estudantes cadastrados';
        }else{
            $message = 'Lista de todos(as) os(as) estudantes';
        }
        return response([
            'data'=>$students,
            'message'=>$message,
            'count'=>$students_count
        ], $http_code);
    }
}
