@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Edit Paper</h4>
                    <form id="formAccountSettings" method="POST" action="{{ route('archives-update', $archives->paper_id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mt-1 gy-4">

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload New Paper</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload"
                                        class="account-file-input @if ($errors->has('paper_url')) is-invalid @endif"
                                        name="paper_url" hidden />
                                </label>

                                @if ($archives->paper_url)
                                    <div class="mb-2">
                                        <strong>Current File:</strong>
                                        <a href="{{ asset('storage/' . $archives->paper_url) }}" target="_blank">
                                            {{ $archives->paper_url }}
                                        </a>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                    id="resetFile">
                                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                @if ($errors->has('paper_url'))
                                    <div class="text-danger">
                                        <strong>{{ $errors->first('paper_url') }}</strong>
                                    </div>
                                @endif
                                <div class="text-muted small">Allowed PDF. Max size: 5MB</div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('year')) {{ 'is-invalid' }} @endif"
                                        type="text" id="year" name="year" placeholder="Year"
                                        value="{{ $archives->year }}" />
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
                                        value="{{ $archives->volume }}" />
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
                                        value="{{ $archives->issue }}" />
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
                                        name="paper_month">
                                        <option value="">Select</option>

        <option value="January-February" @if (old('paper_month', $archives->paper_month) == 'January-February') selected @endif>
        January-February</option>
        <option value="March-April" @if (old('paper_month', $archives->paper_month) == 'March-April') selected @endif>
        March-April</option>
        <option value="May-June"
            @if (old('paper_month', $archives->paper_month) == 'May-June') selected @endif>May-June
        </option>

        <option value="July-August"
            @if (old('paper_month', $archives->paper_month) == 'July-August') selected @endif>July-August
        </option>

        <option value="September-October"
            @if (old('paper_month', $archives->paper_month) == 'September-October') selected @endif>September-October
        </option>

        <option value="November-December"
            @if (old('paper_month', $archives->paper_month) == 'November-December') selected @endif>November-December
        </option>



        <!--                                         <option value="January-February">January-February</option>
                                        <option value="March-April">March-April</option>
                                        <option value="May-June">May-June</option>
                                        <option value="July-August">July-August</option>
                                        <option value="September-October">September-October</option>
                                        <option value="November-December">November-December</option> -->

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
                                        value="{{ $archives->paper_title }}" />
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
                                        value="{{ $archives->paper_author }}" />
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
                                        value="{{ $archives->paper_articletype }}" />
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
                                        value="{{ $archives->paper_doi }}" />
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
                                        value="{{ $archives->paper_pages }}" />
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
                                        placeholder="Abstract" name="paper_abstract">{{ $archives->paper_abstract }}</textarea>
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
