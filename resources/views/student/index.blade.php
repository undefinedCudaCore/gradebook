@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Studentų sąrašas</div>

               <div class="card-body">
                   @foreach ($students as $student)
                    <div class="card-body shadow p-3 bg-white rounded" style="margin: 0 0 20px;">
                        <h4>{{$student->name}} {{$student->surname}}</h4>
                        <img src="{{asset('images/'.$student->logo)}}" style="width: 100px; height: auto; margin-bottom: 15px;" alt="User_logo">
                        <a class="btn btn-dark" style="margin: 0 0 15px 10px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: #ffffff;" href="{{route('student.edit',[$student])}}" class="list-group-item">Redaguoti</a>
                        <a class="btn btn-dark" style="margin: 0 0 15px 10px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: #ffffff;" href="{{route('student.show',[$student])}}" class="list-group-item">Informacija</a>
                        <form method="POST" action="{{route('student.destroy', [$student])}}">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Ištrinti</button>
                        </form>
                        <br>
                    </div>
                    @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


