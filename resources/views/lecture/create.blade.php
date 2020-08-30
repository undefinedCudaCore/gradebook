@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">Nauja paskaita</div>

               <div class="card-body">
                    <form method="POST" action="{{route('lecture.store')}}" enctype="multipart/form-data">
                        <label>Paskaitos pavadinimas</label>
                        <input type="text" name="lecture_name" class="form-control" value="{{old('lecture_name')}}">
                        <label>Apie</label>
                        <textarea style="margin-bottom: 15px;" name="lecture_description" class="form-control" id="summernote"  value="{{old('lecture_description')}}"></textarea>
                        <label>Viršelis</label>
                        <input type="file" class="form-control" name="lecture_logo">
                        <small class="form-text text-muted">Norėdami sukurti paskaitą paspauskite mygtuką "Sukurti".</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary">Sukurti</button>
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
