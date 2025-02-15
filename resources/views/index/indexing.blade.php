@extends('layouts/contentNavbarLayout')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h3>Indexing</h3>
            <form action="{{ route('index-home') }}" method="GET">
                <div class="d-flex">
                    <input type="text" class="form-control" name="indexing_name" aria-label="default input example" placeholder="Search">
                    <button type="submit" class="btn btn-primary ms-1"><i class="bi bi-search"></i></button>
                  </div>
            </form>
            <a href="{{ route('index-create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="table-responsive text-nowrap mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Indexing Name</th>
                        <th>Indexing URL</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($indexing as $key => $indexs)
                        <tr>
                            <td>{{ $indexing->firstItem() + $key }}</td>
                            <td>{{ $indexs->indexing_name }}</td>
                            <td>
                                {{ $indexs->indexing_url }}
                            </td>
                            <td>
                                <img class="img-fluid" width="200px" height="200px"
                                    src="{{ asset('storage/' . $indexs->indexing_image_url) }}"
                                    alt="{{ $indexs->indexing_name }}">
                            </td>

                            <td>
                                <!-- Toggle button (checkbox) -->
                                <form action="{{ route('indexing.toggle', $indexs->indexing_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="checkbox" name="is_active" class="form-check-input"
                                        {{ $indexs->is_active ? 'checked' : '' }} onchange="this.form.submit()" />
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('index-delete', $indexs->indexing_id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit"
                                        class="mdi mdi-trash-can-outline me-1"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $indexing->links() }}
    </div>
@endsection
