@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
            <div class="card-header p-3 bg-secondary text-white">Pažymiai</div>

               <div class="card-body">
               <div class="card-body shadow p-3 bg-white rounded">
                    <label>Paskaita</label>
                    <h4>{{$grade->gradeLecture->name}}</p></h4>
                    <label>Pažymis</label>
                    <h4>{{$grade->grade}}.</h4>
                    <label>Paskaitos info</label>
                    <h4>{!!$grade->gradeLecture->description!!}</p></h4>
                    <label>Studentas</label>
                    <h4>{{$grade->gradeStudent->name}} {{$grade->gradeStudent->surname}}</p></h4>
               </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection