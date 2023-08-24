<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = Student::all();
        // dd($students);
        return view('home', compact('students'));
    }

    public function addStudent(){
        return view('addstudentform');
    }

    public function storeStudent(Request $request){
        $students = new Student;
        $students -> name = $request -> nameInput;
        $students -> email = $request -> emailInput;
        $students -> department = $request -> departmentInput;
        $students -> roll_no = $request -> rollNoInput;
        $students -> batch = $request -> batchYearInput;
        $students -> save();
        
        return response()->json(['status' => true,'message' => 'data has been added succesfully']);
    }

    public function loadStudentTable(){
        
        $students = Student::all();
        return view('loadstudenttable', compact('students'));
    }
}


