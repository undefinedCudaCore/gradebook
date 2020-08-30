@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
                <div class="card-header p-3 bg-secondary text-white">Studento informacija</div>
                <div class="card-body">
                    <div class="card-body shadow p-3 bg-white rounded">
                        <label>Vardas</label>
                        <h4>{{$student->name}}</h4>
                        <label>Pavardė</label>
                        <h4>{{$student->surname}}</h4>
                        <label>El. paštas</label>
                        <h4>{{$student->email}}</h4>
                        <label>Telefonas</label>
                        <h4>{{$student->phone}}</h4>
                        <div class="photo">
                            <img src="{{asset('images/'.$student->logo)}}" style="width: 100px; height: auto; margin-bottom: 15px;" alt="Student_logo">
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection