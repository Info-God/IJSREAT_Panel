@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Add Conference</h4>
                    <form id="formAccountSettings" method="POST" action="{{ route('conference-store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="form-floating form-floating-outline w-100">
                                    <select id="month"
                                        class="select2 form-select @if ($errors->has('category_id')) {{ 'is-invalid' }} @endif"
                                        name="category_id" value="{{ old('category_id') }}">
                                        <option value="">Select</option>
                                        @foreach ($records as $rec)
                                            <option value="{{ $rec->id }}">{{ $rec->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="month">Category</label>

                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('category_id') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal"
                                    data-bs-target="#addModal">ADD</button>
                            </div>
                        </div>

                        {{-- Popup Conference category  --}}

                        <div class="row mt-1 gy-4">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('assets/img/avatars/pdf.png') }}" alt="user-avatar"
                                        class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload Conference</span>
                                            <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                            <input type="file" id="upload"
                                                class="account-file-input @if ($errors->has('pdf_url')) {{ 'is-invalid' }} @endif"
                                                name="pdf_url" hidden value="{{ old('pdf_url') }}" />
                                        </label>
                                        <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                            id="resetImage">
                                            <i class="mdi mdi-reload d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>

                                        <div class="text-danger">
                                            <Strong>{{ $errors->first('pdf_url') }}</Strong>
                                        </div>

                                        <div class="text-muted small">Allowed PDF Max size of 2MB</div>
                                        <div id="imageName" class="mt-2"></div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('title')) {{ 'is-invalid' }} @endif"
                                        type="text" id="title" name="title" placeholder="Title"
                                        value="{{ old('title') }}" />
                                    <label for="title">Title</label>
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('author')) {{ 'is-invalid' }} @endif"
                                        type="text" name="author" id="author" placeholder="Author"
                                        value="{{ old('author') }}" />
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
                                        value="{{ old('article_type') }}" />
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
                                        value="{{ old('pages') }}" />
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
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="form" method="POST" action="{{ route('conference_categories-store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Your form fields go here -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card mb-4">
                                                    <div class="card-body pt-2 mt-1">

                                                        <div class="row mt-1 gy-4">
                                                            <div class="col-md-6">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input type="text"
                                                                        class="form-control @if ($errors->has('name')) {{ 'is-invalid' }} @endif"
                                                                        id="doi" name="name" placeholder="Name"
                                                                        value="{{ old('name') }}" />
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
                                                                    <input
                                                                        class="form-control @if ($errors->has('title')) {{ 'is-invalid' }} @endif"
                                                                        type="text" id="title" name="title"
                                                                        placeholder="Title"
                                                                        value="{{ old('title') }}" />
                                                                    <label for="title">Title</label>
                                                                    @if ($errors->has('title'))
                                                                        <div class="invalid-feedback">
                                                                            <strong>{{ $errors->first('title') }}</strong>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input type="text"
                                                                        class="form-control @if ($errors->has('organised_by')) {{ 'is-invalid' }} @endif"
                                                                        id="article" name="organised_by"
                                                                        placeholder="Organised by"
                                                                        value="{{ old('organised_by') }}" />
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
                                                                        type="text" id="state"
                                                                        name="conference_date"
                                                                        placeholder="Conference Date"
                                                                        value="{{ old('conference_date') }}" />
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
                                                                        type="number" id="volume" name="volume"
                                                                        placeholder="Volume"
                                                                        value="{{ old('volume') }}" />
                                                                    <label for="volume">Volume</label>
                                                                    @if ($errors->has('volume'))
                                                                        <div class="invalid-feedback">
                                                                            <strong>{{ $errors->first('volume') }}</strong>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input
                                                                        class="form-control @if ($errors->has('year')) {{ 'is-invalid' }} @endif"
                                                                        type="text" id="year" name="year"
                                                                        placeholder="Year" value="{{ old('year') }}" />
                                                                    <label for="year">Year</label>
                                                                    @if ($errors->has('year'))
                                                                        <div class="invalid-feedback">
                                                                            <strong>{{ $errors->first('year') }}</strong>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input
                                                                        class="form-control @if ($errors->has('issue')) {{ 'is-invalid' }} @endif"
                                                                        type="text" id="issue" name="issue"
                                                                        placeholder="Issue"
                                                                        value="{{ old('issue') }}" />
                                                                    <label for="issue">Issue</label>
                                                                    @if ($errors->has('issue'))
                                                                        <span class="invalid-feedback">
                                                                            <Strong>{{ $errors->first('issue') }}</Strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input
                                                                        class="form-control @if ($errors->has('issue')) {{ 'is-invalid' }} @endif"
                                                                        type="text" id="data" name="control"
                                                                        placeholder="Issue" value="Record" hidden />
                                                                    <label for="data" hidden>Issue</label>

                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadInput = document.getElementById("upload");
        const resetButton = document.getElementById("resetImage");
        const imageName = document.getElementById("imageName");

        // Handle Image Upload
        uploadInput.addEventListener("change", function(event) {
            const file = event.target.files[0]; // Get the selected file
            if (file) {
                imageName.innerHTML = `<strong> Selected Pdf:</strong> ${file.name} `;
            }
        });

        // Reset Image
        resetButton.addEventListener("click", function() {
            uploadInput.value = ''; // Reset the file input
            imageName.textContent = '';
        });
    });
</script>
