@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Edit Member Details</h4>
                    <form id="formAccountSettings" method="POST"
                        action="{{ route('editorial-update', $editorial->member_id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mt-1 gy-4">

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Update Photo</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload"
                                        class="account-file-input @if ($errors->has('member_image_url')) is-invalid @endif"
                                        name="member_image_url" hidden />
                                </label>

                                @if ($editorial->member_image_url)
                                    <div class="mb-2">
                                        <strong>Current File:</strong>
                                        <a href="{{ asset('storage/' . $editorial->member_image_url) }}" target="_blank">
                                            {{ $editorial->member_image_url }}
                                        </a>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                    id="resetFile">
                                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                @if ($errors->has('member_image_url'))
                                    <div class="text-danger">
                                        <strong>{{ $errors->first('member_image_url') }}</strong>
                                    </div>
                                @endif
                                <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 2MB</div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('member_name')) {{ 'is-invalid' }} @endif"
                                        type="text" id="firstName" name="member_name" placeholder="Name"
                                        value="{{ $editorial->member_name }}" />
                                    <label for="firstName">Name</label>
                                    @if ($errors->has('member_name'))
                                        <div class="invalid-feedback"><strong>{{ $errors->first('member_name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('member_email')) {{ 'is-invalid' }} @endif"
                                        type="text" id="email" name="member_email" placeholder="Email"
                                        value="{{ $editorial->member_email }}" />
                                    <label for="email">E-mail</label>
                                    @if ($errors->has('member_email'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('member_email') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('member_role')) {{ 'is-invalid' }} @endif"
                                        type="text" name="member_role" id="lastName" placeholder="Role"
                                        value="{{ $editorial->member_role }}" />
                                    <label for="lastName">Role</label>
                                    @if ($errors->has('member_role'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('member_role') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="form-control @if ($errors->has('member_designation')) {{ 'is-invalid' }} @endif"
                                        id="Designation" name="member_designation" placeholder="Designation"
                                        value="{{ $editorial->member_designation }}" />
                                    <label for="Designation">Designation</label>
                                    @if ($errors->has('member_designation'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('member_designation') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="form-control @if ($errors->has('member_address')) {{ 'is-invalid' }} @endif"
                                        id="address" name="member_address" placeholder="Address"
                                        value="{{ $editorial->member_address }}" />
                                    <label for="address">Address</label>
                                    @if ($errors->has('member_address'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('member_address') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('member_researcharea')) {{ 'is-invalid' }} @endif"
                                        type="text" id="state" name="member_researcharea" placeholder="Research Area"
                                        value="{{ $editorial->member_researcharea }}" />
                                    <label for="state">Research Area</label>
                                    @if ($errors->has('member_researcharea'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('member_researcharea') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control @if ($errors->has('member_country')) is-invalid @endif"
                                        type="text" id="country" name="member_country" placeholder="Country"
                                        value="{{ old('member_country', $editorial->member_country) }}" />
                                    <label for="country">Country</label>
                                    @if ($errors->has('member_country'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('member_country') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        class="form-control @if ($errors->has('member_website')) {{ 'is-invalid' }} @endif"
                                        type="text" id="website" name="member_website" placeholder="Website"
                                        value="{{ $editorial->member_website }}" />
                                    <label for="website">Website</label>
                                    @if ($errors->has('member_website'))
                                        <span class="invalid-feedback">
                                            <Strong>{{ $errors->first('member_website') }}</Strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <a href="{{ route('editorial-home') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
