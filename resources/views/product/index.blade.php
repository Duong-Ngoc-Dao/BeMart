@extends('templates.layout')
@section('content')
<h1 class="text-danger text-center">List Product</h1>

<div class="row">
    <div class="col">
        <button class="btn btn-primary"> <a style="text-decoration: none;" class="text-light" href="/product/add">Add New Product</a></button>
        {{-- hiển thị thông báo  --}}
        @if (Session::has('success'))
        {{ Session::get('success') }}
        @endif
        @if (Session::has('error'))
        {{ Session::get('error') }}
        @endif
    </div>
    <div class="col">
        <form class="d-flex" role="search" action="{{ route('list_Product') }}" method="POST">
            @csrf
            <input class="form-control me-2" type="text" name="search_product" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" name="btn_search" type="submit">Search</button>
        </form>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Desc</th>
            <th scope="col">Product Quanlity</th>
            <th scope="col">Product Category</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $c)
        <tr>
            <th scope="row">{{ $c->id}}</th>
            <td>{{ $c->Name }}</td>
            <td>{{ $c->Price }}</td>
            <td><img style="width: 100px;" src="{{ $c->image ? '' . Storage::url($c->image) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" alt=""></td>
            <td>{{ $c->Description }}</td>
            <td>{{ $c->Quantity }}</td>
            <td>{{ $c->Category }}</td>
            <td>
                <button class="btn btn-success "><a class="text-white" style="text-decoration: none;" href=" {{ route('edit_Product', ['id' => $c->id]) }} "><i class="fa-solid fa-pen-to-square"></i></a></button>
                <button class="btn btn-danger "><a class="text-white" style="text-decoration: none;" href="{{ route('delete_Product', ['id' => $c->id]) }}"><i class="fa-solid fa-trash"></i></a></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection