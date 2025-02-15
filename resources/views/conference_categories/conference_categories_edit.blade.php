@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Edit Conference Categories</h4>
                    <form id="formAccountSettings" method="POST" action="{{ route('conference_categories-update', $rec->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-1 gy-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) {{ 'is-invalid' }} @endif"
                                        id="doi" name="name" placeholder="Name" value="{{ $rec->name }}" />
                                    <label for="doi">Name</label>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('name') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('title')) {{ 'is-invalid' }} @endif"
                                        type="text" id="title" name="title" placeholder="Title"
                                        value="{{$rec->title  }}" />
                                    <label for="title">Title</label>
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="form-control @if ($errors->has('organised_by')) {{ 'is-invalid' }} @endif"
                                        id="article" name="organised_by" placeholder="Organised by"
                                        value="{{$rec->organised_by  }}" />
                                    <label for="article">Organised by</label>
                                    @if ($errors->has('organised_by'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('organised_by') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('conference_date')) {{ 'is-invalid' }} @endif"
                                        type="text" id="state" name="conference_date" placeholder="Conference Date"
                                        value="{{ $rec->conference_date }}" />
                                    <label for="state">Conference Date</label>
                                    @if ($errors->has('conference_date'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('conference_date') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('volume')) {{ 'is-invalid' }} @endif"
                                        type="number" id="volume" name="volume" placeholder="Volume"
                                        value="{{ $rec->volume }}" />
                                    <label for="volume">Volume</label>
                                    @if ($errors->has('volume'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('volume') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('year')) {{ 'is-invalid' }} @endif"
                                        type="text" id="year" name="year" placeholder="Year"
                                        value="{{ $rec->year }}" />
                                    <label for="year">Year</label>
                                    @if ($errors->has('year'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('year') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('issue')) {{ 'is-invalid' }} @endif"
                                        type="text" id="issue" name="issue" placeholder="Issue"
                                        value="{{ $rec->issue }}" />
                                    <label for="issue">Issue</label>
                                    @if ($errors->has('issue'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('issue') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <a href="{{ route('conference_categories-home') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
