@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Add Paper</h4>
                    <form id="formAccountSettings" method="POST" action="{{ route('archives-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-1 gy-4">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('assets/img/avatars/pdf.png') }}" alt="user-avatar"
                                        class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload Paper</span>
                                            <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                            <input type="file" id="upload"
                                                class="account-file-input @if ($errors->has('paper_url')) {{ 'is-invalid' }} @endif"
                                                name="paper_url" hidden value="{{ old('paper_url') }}" />
                                        </label>
                                        <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                            id="resetImage">
                                            <i class="mdi mdi-reload d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>



                                        <div class="text-danger">
                                            <Strong>{{ $errors->first('paper_url') }}</Strong>
                                        </div>

                                        <div class="text-muted small">Allowed PDF. Max size of 5mb</div>
                                        <div id="imageName" class="mt-2"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('year')) {{ 'is-invalid' }} @endif"
                                        type="text" id="year" name="year" placeholder="Year"
                                        value="{{ old('year') }}" />
                                    <label for="year">Year</label>
                                    @if ($errors->has('year'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('year') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('volume')) {{ 'is-invalid' }} @endif"
                                        type="number" id="volume" name="volume" placeholder="Volume"
                                        value="{{ old('volume') }}" />
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
                                        class="form-control @if ($errors->has('issue')) {{ 'is-invalid' }} @endif"
                                        type="text" id="issue" name="issue" placeholder="Issue"
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
                                    <select id="month"
                                        class="select2 form-select @if ($errors->has('paper_month')) {{ 'is-invalid' }} @endif"
                                        name="paper_month" value="{{ old('paper_month') }}">
                                        <option value="">Select</option>
                                        <option value="January-February">January-February</option>
                                        <option value="March-April">March-April</option>
                                        <option value="May-June">May-June</option>
                                        <option value="July-August">July-August</option>
                                        <option value="September-October">September-October</option>
                                        <option value="November-December">November-December</option>

                                    </select>
                                    <label for="month">Month</label>
                                    @if ($errors->has('paper_month'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('paper_month') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('paper_title')) {{ 'is-invalid' }} @endif"
                                        type="text" id="title" name="paper_title" placeholder="Title"
                                        value="{{ old('paper_title') }}" />
                                    <label for="title">Title</label>
                                    @if ($errors->has('paper_title'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('paper_title') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('paper_author')) {{ 'is-invalid' }} @endif"
                                        type="text" name="paper_author" id="author" placeholder="Author"
                                        value="{{ old('paper_author') }}" />
                                    <label for="author">Author</label>
                                    @if ($errors->has('paper_author'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('paper_author') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="form-control @if ($errors->has('paper_articletype')) {{ 'is-invalid' }} @endif"
                                        id="article" name="paper_articletype" placeholder="Article Type"
                                        value="{{ old('paper_articletype') }}" />
                                    <label for="article">Article Type</label>
                                    @if ($errors->has('paper_articletype'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('paper_articletype') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="form-control @if ($errors->has('paper_doi')) {{ 'is-invalid' }} @endif"
                                        id="doi" name="paper_doi" placeholder="DOI NO"
                                        value="{{ old('paper_doi') }}" />
                                    <label for="doi">DOI NO</label>
                                    @if ($errors->has('paper_doi'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('paper_doi') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('paper_pages')) {{ 'is-invalid' }} @endif"
                                        type="text" id="state" name="paper_pages" placeholder="Pages"
                                        value="{{ old('paper_pages') }}" />
                                    <label for="state">Pages</label>
                                    @if ($errors->has('paper_pages'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('paper_pages') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control @if ($errors->has('paper_abstract')) {{ 'is-invalid' }} @endif" id="validationTextarea"
                                        placeholder="Abstract" name="paper_abstract">{{ old('paper_abstract') }}</textarea>
                                    <label for="validationTextarea" class="">Abstract</label>
                                    @if ($errors->has('paper_abstract'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('paper_abstract') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <a href="{{ route('archives-home') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
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
