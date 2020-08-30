@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Redaguoti paskaitą</div>

               <div class="card-body">
                    <form method="POST" action="{{route('lecture.update',[$lecture->id])}}" enctype="multipart/form-data">
                        <label>Pavadinimas</label>
                        <input type="text" name="lecture_name" class="form-control" value="{{old('lecture_name', $lecture->name)}}">
                        <label>Apie</label>
                        <textarea style="margin-bottom: 15px;" name="lecture_description" class="form-control" id="summernote"  value="{{old('lecture_description', $lecture->description)}}">{{old('lecture_description', $lecture->description)}}</textarea>
                        <input type="file" class="form-control" name="lecture_logo">
                        <small class="form-text text-muted">Norėdami irašyti pakeitimus spauskite mygtuką "Pakeisti".</small>
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

