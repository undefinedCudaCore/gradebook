<?php

namespace App\Http\Controllers;

use Validator;
use App\Grade;
use App\Lecture;
use App\Student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('surname')->get();

        return view('student.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'student_name' => ['required', 'min:3', 'max:64'],
            'student_surname' => ['required', 'min:3', 'max:64'],
            'student_email' => ['required', 'min:3', 'max:64'],
            'student_phone' => ['required', 'min:3', 'max:32']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $student = new Student;
        $student->name = $request->student_name;
        $student->surname = $request->student_surname;
        $student->email = $request->student_email;
        $student->phone = $request->student_phone;
        $student->logo = '';

        if ($request->hasFile('student_logo')) {
            $image = $request->file('student_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $student->logo = $name;
        }
        
        $student->save();
        return redirect()->route('student.index')->with('success_message', 'Paskaita sekmingai įrašyta.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        $grades = Grade::orderBy('grade', 'desc')->get();
        $lectures = Lecture::orderBy('name')->get();
        return view('student.show', ['student' => $student, 'grades' => $grades, 'lectures' => $lectures]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('student.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(),
        [
            'student_name' => ['required', 'min:3', 'max:64'],
            'student_surname' => ['required', 'min:3', 'max:64'],
            'student_email' => ['required', 'min:3', 'max:64'],
            'student_phone' => ['required', 'min:3', 'max:32']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $student->name = $request->student_name;
        $student->surname = $request->student_surname;
        $student->email = $request->student_email;
        $student->phone = $request->student_phone;
        $student->logo = '';

        if ($request->hasFile('student_logo')) {
            $image = $request->file('student_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $student->logo = $name;
        }
        
        $student->save();
        return redirect()->route('student.index')->with('success_message', 'Paskaita sekmingai pakeista.');
    }

    /**
     * Remove the specified resource from storage.
     *+
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if($student->studentGrades->count()){
            return redirect()->route('student.index')->with('info_message', 'Trinti negalima, nes turi priskirtų studentų.');
        }
        $student->delete();
        return redirect()->route('student.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
