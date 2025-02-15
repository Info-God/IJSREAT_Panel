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
            <h3>Conference</h3>
            <form action="{{ route('conference-home') }}" method="GET">
                <div class="d-flex">
                    <input type="text" class="form-control" name="title" aria-label="default input example"
                        placeholder="Search">
                    <button type="submit" class="btn btn-primary ms-1"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <a href="{{ route('conference-create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="table-responsive mt-3">
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>TITLE</th>
                        <th>AUTHOR</th>
                        <th>ARTICLE TYPE</th>
                        <th>PAGES</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($records as $key => $rec)
                        <tr>
                            <td>{{ $records->firstItem() + $key }}</td>
                            <td>{{ $rec->title }}</td>
                            <td>
                                {{ $rec->author }}
                            </td>
                            <td>{{ $rec->article_type }}</td>

                            <td>{{ $rec->pages }}</td>

                            <td class="d-flex justify-center">
                                <a href="{{ route('conference-edit', $rec->id) }}"
                                    class="btn btn-primary mx-1"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('conference-delete', $rec->id) }}"
                                    class="btn btn-danger mx-1"><i class="bi bi-trash"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{$records->links()}}

        </div>
    </div>
@endsection
