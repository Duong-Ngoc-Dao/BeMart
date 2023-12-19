@extends('templates.layout')
@section('content')
<h1 class="text-center">Add new Post</h1>
<!-- <button class="btn btn-primary text-center"> <a class="text-light" href="/customers">List</a></button> -->

@if ($errors->any())
@foreach ($errors->all() as $error)
<p style="color: red;">{{ $error }}</p>
@endforeach
@endif


<form action="{{ route('add_Post') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label"> Content:</label>
        <input type="text" name="content" class="form-control" placeholder="Content">
    </div>
    <div class="mb-3">
        <label class="form-label"> Image:</label>
        <input type="file" name="image" class="form-control " class="@error('image') is-invalid @enderror" accept="image/*" id="image">
        <img class="img-thumbnail" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" id="image_preview" alt="Product Image" style="width: 100px;">
    </div>
    <div class="form-label text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection