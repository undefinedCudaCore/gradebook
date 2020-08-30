@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                <div class="title">Pažymių sąrašas</div>
                <label>Rušiuoti pagal: </label>
                <form action="{{route('grade.index')}}" method="get">
                  <div class="filter-box">
                    <label>Paskaitą: </label>
                    <select name="lecture_id" class="form-control">
                      <option value="0">Parodyti visus</option>
                      @foreach ($lectures as $lecture)
                      <option value="{{$lecture->id}}" @if ($selectId == $lecture->id) selected @endif>{{$lecture->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="filter-box">
                    <label>Studentą: </label>
                    <select name="student_id" class="form-control">
                      <option value="0">Parodyti visus</option>
                      @foreach ($students as $student)
                      <option value="{{$student->id}}" @if ($selectId2 == $student->id) selected @endif>{{$student->name}} {{$student->surname}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="filter-box">
                    <ul class="list-group">
                      <label>Pažymį: </label>
                      <input type="radio" name="sort" value="grade" @if ('grade' == $sort) checked @endif>
                    </ul>
                  </div>
                  <button type="submit" class="btn btn-success btn-new">Rušiuoti</button>
                  <a href="{{route('grade.index')}}" class="btn btn-outline-primary btn-new">Nunulinti</a>
              </form>
               </div>
                <div class="card-body">
                  <div class="card-body shadow p-3 bg-white rounded">
                      @foreach ($grades as $grade)
                      
                      <p style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: black;" href="{{route('grade.edit',[$grade])}}"  class="list-group-item">{{$grade->gradeLecture->name}} <img src="{{asset('images/'.$grade->logo)}}" style="width: 200px; height: auto; margin: 0 0 20px; alt="Lecture_logo"></p>
                        <p style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: black;" href="{{route('grade.edit',[$grade])}}"  class="list-group-item">{{$grade->gradeStudent->name}} {{$grade->gradeStudent->surname}}<img src="{{asset('images/'.$grade->gradeStudent->logo)}}" style="width: 200px; height: auto; margin: 0 0 0 50px" alt="Grade_logo"></p>
                        <img src="{{asset('images/'.$grade->gradeLecture->logo)}}" style="width: 200px; height: auto; margin: 0 0 20px 300px; alt="Lecture_logo">
                        <a class="btn btn-secondary" style="margin: 0 0 0 20px;" href="{{route('grade.edit',[$grade])}}">Redaguoti</a>
                        <a class="btn btn-secondary" style="margin: 0 0 0 20px;" href="{{route('grade.show',[$grade])}}">Peržiūrėti</a><br>
                        <form method="POST" action="{{route('grade.destroy', [$grade])}}">
                          @csrf
                          <button type="submit" class="btn btn-secondary btn-lg btn-block">Ištrinti</button>
                        </form>
                        <br>
                      @endforeach
                  </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
