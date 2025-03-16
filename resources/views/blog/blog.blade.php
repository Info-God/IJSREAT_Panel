@extends('layouts/contentNavbarLayout')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="card p-3 ">
        <div class="d-flex justify-content-between">
            <h3>Blog</h3>
            <form action="{{ route('blog-home') }}" method="GET">
                <div class="d-flex">
                    <input type="text" class="form-control" name="description" aria-label="default input example"
                        placeholder="Search">
                    <button type="submit" class="btn btn-primary ms-1"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <a href="{{ route('blog-create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="table-responsive mt-3">
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>IMAGES</th>
                        <th>CONTENT</th>
                        <th>TITLE</th>
                        <th>CATEGORY</th>
                        <th>META TITLE</th>
                        <th>META DESCRIPTION</th>
                        <th>TAGS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($blogs as $key => $blog)
                        <tr>
                            <td>{{ $blogs->firstItem() + $key }}</td>
                            <td><img width="170px" height="170px" src="{{ asset('storage/' . $blog->image) }}"
                                    alt="{{ asset('storage/' . $blog->image) }}"
                                    style="object-fit: contain;object-position:center;"></td>
                            <td>
                                {{ $blog->description }}
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->category }}</td>
                            <td>{{ $blog->meta_title }}</td>
                            <td>{{ $blog->meta_description }}</td>
                            <td>{{ $blog->tags }}</td>
                            <td class="d-flex ">

                                <form action="{{ route('blog-edit', $blog->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-primary mx-1" type="submit"
                                        class="mdi mdi-trash-can-outline me-1"><i class="bi bi-pencil-square"></i></button>
                                </form>
                                <form action="{{ route('blog-delete', $blog->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger mx-1" type="submit"
                                        class="mdi mdi-trash-can-outline me-1"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $blogs->links() }}

        </div>
    @endsection
