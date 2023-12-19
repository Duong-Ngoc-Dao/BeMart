@extends('templates.layout')
@section('content')
<h1 class="text-center">Edit Product </h1>
@if ($errors->any())
@foreach ($errors->all() as $error)
<p style="color: red;">{{ $error }}</p>
@endforeach
@endif



<form action="{{ route('edit_Product', ['id' => $detail->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label"> Product Name:</label>
        <input type="text" name="Name" class="form-control" value="{{ $detail->Name }}" placeholder="Product Name">
    </div>
    <div class="mb-3">
        <label class="form-label"> Product Price:</label>
        <input type="text" name="Price" class="form-control" value="{{ $detail->Price }}"  placeholder="Product Price">
    </div>
    <div class="mb-3">
        <label class="form-label"> Image:</label>
        <input type="file" name="image" class="form-control " class="@error('image') is-invalid @enderror" accept="image/*" id="image">
        <img class="img-thumbnail" src="{{ $detail->image ? ''. Storage::url($detail->image) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" id="image_preview" alt="Customer Image" style="width: 100px;">
    </div>
    <div class="mb-3">
        <label class="form-label"> Product Quanlity:</label>
        <input type="text" name="Quantity" class="form-control" value="{{ $detail->Quantity }}"  placeholder="Product Quanlity">
    </div>
    
    <div class="mb-3">
        <label class="form-label"> Product Desc:</label>
        <textarea type="text" name="Description" value="" class="form-control" placeholder="Product Desc">{{ $detail->Description }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label"> Product Category:</label>
        <textarea type="text" name="Category" value="" class="form-control" placeholder="Category">{{ $detail->Category }}</textarea>
    </div>
    <div class="form-label text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection