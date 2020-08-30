@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Studento informacijos redagavimas</div>

               <div class="card-body">
                    <form method="POST" action="{{route('student.update',[$student->id])}}" enctype="multipart/form-data">
                        <label>Vardas</label>
                        <input type="text" name="student_name" class="form-control" value="{{old('student_name', $student->name)}}">
                        <label>Pavardė</label>
                        <input type="text" name="student_surname" class="form-control" value="{{old('student_surname', $student->surname)}}">
                        <label>El. paštas</label>
                        <input type="text" name="student_email" class="form-control" value="{{old('student_email', $student->email)}}">
                        <label>Telefonas</label>
                        <input type="text" name="student_phone" class="form-control" value="{{old('student_phone', $student->phone)}}">
                        <label>Nuotrauka</label>
                        <input type="file" class="form-control" name="student_logo">
                        <small class="form-text text-muted">Norėdami irašyti studento informaciją spauskite mygtuką "Pakeisti".</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Pakeisti</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>
@endsection

