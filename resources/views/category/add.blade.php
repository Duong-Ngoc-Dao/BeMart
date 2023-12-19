@extends('templates.layout')
@section('content')
<h1 class="text-center">Add new Category</h1>
<!-- <button class="btn btn-primary text-center"> <a class="text-light" href="/customers">List</a></button> -->

@if ($errors->any())
@foreach ($errors->all() as $error)
<p style="color: red;">{{ $error }}</p>
@endforeach
@endif


<form action="{{ route('add_Category') }}" method="post">
    @csrf
    <div class="mb-3">
        <label class="form-label"> Category Name:</label>
        <input type="text" name="Name" class="form-control" placeholder="Category Name" >
    </div>
    <div class="form-label text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection