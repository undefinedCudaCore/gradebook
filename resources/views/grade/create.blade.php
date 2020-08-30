@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Naujo pažymio įvedimas</div>

               <div class="card-body">
                    <form method="POST" action="{{route('grade.store')}}" enctype="multipart/form-data">
                        <label>Pažymis</label>
                        <input type="text" name="grade_grade" class="form-control" value="{{old('grade_grade')}}">
                        <label>Paveiksliukas</label>
                        <input type="file" class="form-control" name="grade_logo">
                        <label>Paskaita</label>
                        <select style="margin-bottom: 15px;" name="lecture_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($lectures as $lecture)
                                <option value="{{$lecture->id}}">{{$lecture->name}}</option>
                            @endforeach
                        </select>
                        <label>Pažymis</label>
                        <select style="margin-bottom: 15px;" name="student_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach ($students as $student)
                                <option value="{{$student->id}}">{{$student->name}} {{$student->surname}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Norint pridėti pažymį spauskite mygtuką "Sukurti".</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Sukurti</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

