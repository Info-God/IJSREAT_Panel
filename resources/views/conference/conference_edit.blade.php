@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Add Conference</h4>
                    <form id="formAccountSettings" method="POST" action="{{ route('conference-update', $rec->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-1 gy-4">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload New Paper</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload"
                                        class="account-file-input @if ($errors->has('pdf_url')) is-invalid @endif"
                                        name="pdf_url" hidden />
                                </label>

                                @if ($rec->pdf_url)
                                    <div class="mb-2">
                                        <strong>Current File:</strong>
                                        <a href="{{ asset('storage/' . $rec->pdf_url) }}" target="_blank">
                                            {{ $rec->pdf_url }}
                                        </a>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                    id="resetFile">
                                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                @if ($errors->has('pdf_url'))
                                    <div class="text-danger">
                                        <strong>{{ $errors->first('pdf_url') }}</strong>
                                    </div>
                                @endif
                                <div class="text-muted small">Allowed PDF. Max size: 5MB</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('title')) {{ 'is-invalid' }} @endif"
                                        type="text" id="title" name="title" placeholder="Title"
                                        value="{{ $rec->title }}" />
                                    <label for="title">Title</label>
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('author')) {{ 'is-invalid' }} @endif"
                                        type="text" name="author" id="author" placeholder="Author"
                                        value="{{ $rec->author }}" />
                                    <label for="author">Author</label>
                                    @if ($errors->has('author'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('author') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="form-control @if ($errors->has('article_type')) {{ 'is-invalid' }} @endif"
                                        id="article" name="article_type" placeholder="Article Type"
                                        value="{{ $rec->article_type }}" />
                                    <label for="article">Article Type</label>
                                    @if ($errors->has('article_type'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('article_type') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('pages')) {{ 'is-invalid' }} @endif"
                                        type="text" id="state" name="pages" placeholder="Pages"
                                        value="{{ $rec->pages }}" />
                                    <label for="state">Pages</label>
                                    @if ($errors->has('pages'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('pages') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <a href="{{ route('conference-home') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
