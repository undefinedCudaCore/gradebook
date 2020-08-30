@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
            <div class="card-header p-3 bg-secondary text-white">Paskaitos informacija</div>

               <div class="card-body">
               <div class="card-body shadow p-3 bg-white rounded">
                    <label>Paskaita</label>
                    <h4>{{$lecture->name}}.</h4>
                    <label>Apie paskaitą</label>
                    <h4>{{$lecture->description}}.</h4>
               </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection