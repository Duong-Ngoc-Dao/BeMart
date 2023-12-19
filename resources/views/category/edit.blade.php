@extends('templates.layout')
@section('content')
<h1 class="text-center">Edit Category </h1>
@if ($errors->any())
@foreach ($errors->all() as $error)
<p style="color: red;">{{ $error }}</p>
@endforeach
@endif


<form action="{{ route('edit_Category', ['id' => $detail->id]) }}" method="post">
    @csrf
    <div class="mb-3">
        <label class="form-label"> Category Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{ $detail->Name }}">
    </div>
    <div class="form-label text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection