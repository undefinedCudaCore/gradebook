<?php

namespace App\Http\Controllers;

use Validator;
use App\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
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
        $lectures = Lecture::orderBy('name')->get();

        return view('lecture.index', ['lectures' => $lectures]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lecture.create');
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
            'lecture_name' => ['required', 'min:3', 'max:64'],
            'lecture_description' => ['required']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $lecture = new Lecture;
        $lecture->name = $request->lecture_name;
        $lecture->description = $request->lecture_description;
        $lecture->logo = '';

        if ($request->hasFile('lecture_logo')) {
            $image = $request->file('lecture_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $lecture->logo = $name;
        }
        
        $lecture->save();
        return redirect()->route('lecture.index')->with('success_message', 'Paskaita sekmingai įrašyta.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        return view('lecture.show', ['lecture' => $lecture]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        return view('lecture.edit', ['lecture' => $lecture]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecture $lecture)
    {
        $validator = Validator::make($request->all(),
        [
            'lecture_name' => ['required', 'min:3', 'max:64'],
            'lecture_description' => ['required']
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $lecture->name = $request->lecture_name;
        $lecture->description = $request->lecture_description;
        $lecture->logo = '';

        if ($request->hasFile('lecture_logo')) {
            $image = $request->file('lecture_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $lecture->logo = $name;
        }
        
        $lecture->save();
        return redirect()->route('lecture.index')->with('success_message', 'Paskaita sekmingai pakeista.');
    }

    /**
     * Remove the specified resource from storage.
     *+
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture)
    {
        if($lecture->lectureGrades->count()){
            return redirect()->route('lecture.index')->with('info_message', 'Trinti negalima, nes turi priskirtų studentų.');
        }
        $lecture->delete();
        return redirect()->route('lecture.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
