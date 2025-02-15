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
            <h3>Archives</h3>
            <form action="{{ route('archives-home') }}" method="GET">
                <div class="d-flex">
                    <input type="text" class="form-control" name="paper_title" aria-label="default input example" placeholder="Search">
                    <button type="submit" class="btn btn-primary ms-1"><i class="bi bi-search"></i></button>
                  </div>
            </form>
            <a href="{{ route('archives-create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="table-responsive mt-3">
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>YEAR</th>
                        <th>VOLUME</th>
                        <th>ISSUE</th>
                        <th>TITLE</th>
                        <th>AUTHOR</th>
                        <th>PAGES</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($archives as $key => $arc)
                        <tr>
                            <td>{{ $archives->firstItem() + $key }}</td>
                            <td>{{ $arc->year }}</td>
                            <td>
                                {{ $arc->volume }}
                            </td>
                            <td>{{ $arc->issue }}</td>
                            <td>
                                {{ $arc->paper_title }}
                            </td>
                            <td>{{ $arc->paper_author }}</td>
                            <td>{{ $arc->paper_pages }}</td>

                            <td class="d-flex justify-content-between">
                                {{-- archives-edit --}}
                                <a href="{{ route('archives-view', $arc->paper_id) }}" target="_blank"
                                    class="btn btn-success mx-1">
                                    <i class="bi bi-eye"></i> View
                                </a>

                                <a href="{{ route('archives-edit', $arc->paper_id) }}" class="btn btn-primary mx-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('archives-delete', $arc->paper_id) }}" method="post">
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

            {{ $archives->links() }}

        </div>
    @endsection
