<?php

namespace App\Http\Controllers;

use Validator;
use App\Student;
use App\Lecture;
use App\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
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
    public function index(Request $request)
    {
        $lectures = Lecture::all();
        $students = Student::all();
        $selectId = 0;
        $selectId2 = 0;
        $sort = '';

        if ($request->lecture_id) {

            if ($request->sort) {
                if ($request->sort == 'grade') {
                    $grades = Grade::where('lecture_id', $request->lecture_id)->orderBy('grade')->get();
                    $sort = 'grade';
                } else {
                    $grades = Grade::all();
                }
            } else {
                $grades = Grade::where('lecture_id', $request->lecture_id)->get();
            }

            $selectId = $request->lecture_id;
        } elseif ($request->student_id) {

            if ($request->sort) {
                if ($request->sort == 'grade') {
                    $grades = Grade::where('student_id', $request->student_id)->orderBy('grade')->get();
                    $sort = 'grade';
                } else {
                    $grades = Grade::all();
                }
            } else {
                $grades = Grade::where('student_id', $request->student_id)->get();
            }

            $selectId2 = $request->student_id;
            
        } else {
            
            if ($request->sort) {
                if ($request->sort == 'grade') {
                    $grades = Grade::orderBy('grade', 'desc')->get();
                    $sort = 'grade';
                } else {
                    $grades = Grade::all();
                }
            } else {
                $grades = Grade::all();
            }
        }

        return view('grade.index', compact('grades','lectures', 'students', 'selectId', 'selectId2', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::orderBy('surname')->get();
        $lectures = Lecture::orderBy('name')->get();
        return view('grade.create', ['students' => $students, 'lectures' => $lectures]);
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
            'grade_grade' => ['required'],
            'lecture_id' => ['required'],
            'student_id' => ['required']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $grade = new Grade;
        $grade->grade = $request->grade_grade;

        if ($request->grade_grade > 10) {
            return redirect()->route('grade.create')->with('info_message', 'Pažimys negali viršyti skaičiaus 10, naudojame 10 balę vertinimo sistemą.');
        }
        if ($request->grade_grade <= 0) {
            return redirect()->route('grade.create')->with('info_message', 'Pažimys negali būti neigiamas arba lygus 0.');
        }

        $grade->lecture_id = $request->lecture_id;
        $grade->student_id = $request->student_id;
        $grade->logo = '';
        
        if ($request->hasFile('grade_logo')) {
            $image = $request->file('grade_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $grade->logo = $name;
        }

        $grade->save();
        return redirect()->route('grade.index')->with('success_message', 'Pažimys sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        return view('grade.show', ['grade' => $grade]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        $students = Student::orderBy('surname')->get();
        $lectures = Lecture::orderBy('name')->get();
        return view('grade.edit', ['students' => $students, 'lectures' => $lectures, 'grade' => $grade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $validator = Validator::make($request->all(),
        [
            'grade_grade' => ['required'],
            'lecture_id' => ['required'],
            'student_id' => ['required']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $grade->grade = $request->grade_grade;
        $grade->lecture_id = $request->lecture_id;
        $grade->student_id = $request->student_id;
        $grade->logo = '';
        
        if ($request->hasFile('grade_logo')) {
            $image = $request->file('grade_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $grade->logo = $name;
        }

        $grade->save();
        return redirect()->route('grade.index')->with('success_message', 'Pažimys sekmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grade.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
