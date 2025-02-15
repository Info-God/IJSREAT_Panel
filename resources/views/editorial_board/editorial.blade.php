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
            <h3>Editorial Board</h3>
            <form action="{{ route('editorial-home') }}" method="GET">
                <div class="d-flex">
                    <input type="text" class="form-control" name="member_name" aria-label="default input example" placeholder="Search">
                    <button type="submit" class="btn btn-primary ms-1"><i class="bi bi-search"></i></button>
                  </div>
            </form>
            <a href="{{ route('editorial-create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="table-responsive text-nowrap mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>DESIGNATION</th>
                        <th>COUNTRY</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($editorial as $key => $edit)
                        <tr>
                            <td>{{ $editorial->firstItem() + $key }}</td>
                            <td>{{ $edit->member_name }}</td>
                            <td>
                                {{ $edit->member_email }}
                            </td>
                            <td>{{ $edit->member_role }}</td>
                            <td>
                                {{ $edit->member_designation }}
                            </td>
                            <td>{{ $edit->member_country }}</td>
                            <td class="d-flex justify-content-evenly">

                                <form action="{{ route('editorial-edit', $edit->member_id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <button class="btn btn-primary" type="submit"
                                        class="mdi mdi-trash-can-outline me-1"></i> Edit</button>
                                </form>
                                <form action="{{ route('editorial-delete', $edit->member_id) }}" method="post">
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

            {{ $editorial->links() }}

        </div>
    @endsection
