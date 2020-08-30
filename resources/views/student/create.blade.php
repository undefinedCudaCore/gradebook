@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Naujas studentas</div>

               <div class="card-body">
                    <form method="POST" action="{{route('student.store')}}" enctype="multipart/form-data">
                        <label>Vardas</label>
                        <input type="text" name="student_name" class="form-control" value="{{old('student_name')}}">
                        <label>Pavardė</label>
                        <input type="text" name="student_surname" class="form-control" value="{{old('student_surname')}}">
                        <label>El. paštas</label>
                        <input type="text" name="student_email" class="form-control" value="{{old('student_email')}}">
                        <label>Telefonas</label>
                        <input type="text" name="student_phone" class="form-control" value="{{old('student_phone')}}">
                        <label>Nuotrauka</label>
                        <input type="file" class="form-control" name="student_logo">
                        <small class="form-text text-muted">Norėdami pridėti studentą spauskite mygtuką "Sukurti".</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Sukurti</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
