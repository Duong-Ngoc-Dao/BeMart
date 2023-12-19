@extends('templates.layout')
@section('content')
<h1 class="text-danger text-center">List Post</h1>

<div class="row">
    <div class="col">
        <button class="btn btn-primary"> <a style="text-decoration: none;" class="text-light" href="/post/add">Add New Post</a></button>
        {{-- hiển thị thông báo  --}}
        @if (Session::has('success'))
        {{ Session::get('success') }}
        @endif
        @if (Session::has('error'))
        {{ Session::get('error') }}
        @endif
    </div>
    <div class="col">
        <form class="d-flex" role="search" action="{{ route('list_Post') }}" method="POST">
            @csrf
            <input class="form-control me-2" type="text" name="search_post" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" name="btn_search" type="submit">Search</button>
        </form>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Content</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Posts as $c)
        <tr>
            <th scope="row">{{ $c->id}}</th>
            <td>{{ $c->content }}</td>
            <td><img style="width: 100px;" src="{{ $c->image ? '' . Storage::url($c->image) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" alt=""></td>
            <td>
                <button class="btn btn-success "><a class="text-white" style="text-decoration: none;" href=" {{ route('edit_Post', ['id' => $c->id]) }} "><i class="fa-solid fa-pen-to-square"></i></a></button>
                <button class="btn btn-danger "><a class="text-white" style="text-decoration: none;" href="{{ route('delete_Post', ['id' => $c->id]) }}"><i class="fa-solid fa-trash"></i></a></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection