@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Redaguoti pažymį</div>

               <div class="card-body">
                    <form method="POST" action="{{route('grade.update',[$grade])}}" enctype="multipart/form-data">
                        <label>Pažymis</label>
                        <input type="text" name="grade_grade" value="{{old('grade_grade', $grade->grade)}}" class="form-control">
                        <label>Paveiksliukas</label>
                        <input type="file" class="form-control" name="grade_logo">
                        <label>Paskaita</label>
                        <select style="margin-bottom: 15px;" name="lecture_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($lectures as $lecture)
                                <option value="{{$lecture->id}}">{{$lecture->name}}</option>
                            @endforeach
                        </select>
                        <label>Studentas</label>
                        <select style="margin-bottom: 15px;" name="student_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($students as $student)
                                <option value="{{$student->id}}">{{$student->name}} {{$student->surname}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Norėdami išsaugoti informacija paspauskite mygtuką "Pakeisti".</small>
                        @csrf
                        <button type="submit"  class="btn btn-secondary btn-lg btn-block">Pakeisti</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

