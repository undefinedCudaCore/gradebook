@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Paskaitų sąrašas</div>
               <div class="card-body">
                   @foreach ($lectures as $lecture)
                    <div class="card-body shadow p-3 bg-white rounded" style="margin: 0 0 20px;">
                    <h4>{{$lecture->name}}</h4>
                    <img src="{{asset('images/'.$lecture->logo)}}" style="width: 150px; height: auto; margin: 0 0 20px;" alt="User_logo">
                    <a class="btn btn-dark" style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: #ffffff; margin: 0 0 0 20px" href="{{route('lecture.edit',[$lecture])}}" class="list-group-item">Redaguoti</a>
                    <a class="btn btn-dark" style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: #ffffff; margin: 0 0 0 20px" href="{{route('lecture.show',[$lecture])}}" class="list-group-item">Informacija</a>
                    <form method="POST" action="{{route('lecture.destroy', [$lecture])}}">
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


