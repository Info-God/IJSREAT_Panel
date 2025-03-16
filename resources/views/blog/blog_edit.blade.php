@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Edit Paper</h4>
                    <form id="formAccountSettings" method="POST" action="{{ route('blog-update', $blog->id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mt-1 gy-4">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Update Photo</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload"
                                        class="account-file-input @if ($errors->has('image')) is-invalid @endif"
                                        name="image" hidden />
                                </label>

                                @if ($blog->image)
                                    <div class="mb-2">
                                        <strong>Current File:</strong>
                                        <a href="{{ asset('storage/' . $blog->image) }}" target="_blank">
                                            {{ $blog->image }}
                                        </a>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                    id="resetFile">
                                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                @if ($errors->has('image'))
                                    <div class="text-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </div>
                                @endif
                                <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 2MB</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control @if ($errors->has('description')) {{ 'is-invalid' }} @endif" id="validationTextarea"
                                        placeholder="Content" name="description">{{ $blog->description }}</textarea>
                                    <label for="validationTextarea">Content</label>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('description') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @if ($errors->has('title')) {{ 'is-invalid' }} @endif"
                                        id="title" placeholder="Title" name="title" value="{{ $blog->title }}" />
                                    <label for="title">Title</label>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('title') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @if ($errors->has('category')) {{ 'is-invalid' }} @endif"
                                        id="category" placeholder="Category" name="category"
                                        value="{{ $blog->category }}" />
                                    <label for="category">Category</label>
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('category') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @if ($errors->has('meta_title')) {{ 'is-invalid' }} @endif"
                                        id="meta_title" placeholder="Meta Title" name="meta_title"
                                        value="{{ $blog->meta_title }}" />
                                    <label for="meta_title">Meta Title</label>
                                    @if ($errors->has('meta_title'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('meta_title') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @if ($errors->has('meta_description')) {{ 'is-invalid' }} @endif"
                                        id="meta_description" placeholder="Meta Description" name="meta_description"
                                        value="{{ $blog->meta_description }}" />
                                    <label for="meta_description">Meta Description</label>
                                    @if ($errors->has('meta_description'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('meta_description') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @if ($errors->has('tags')) {{ 'is-invalid' }} @endif"
                                        id="tags" placeholder="Tags" name="tags" value="{{ $blog->tags }}" />
                                    <label for="tags">Tags</label>
                                    @if ($errors->has('tags'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('tags') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <a href="{{ route('blog-home') }}" class="btn btn-danger">Back</a>
                        </div>

                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
