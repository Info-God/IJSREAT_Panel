@extends('layouts/contentNavbarLayout')

@section('title', ' Horizontal Layouts - Forms')

@section('content')
    <!-- <h4 class="py-3 mb-4">Add Indexing</h4> -->

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Add Indexing</h5> <small class="text-muted float-end">Default label</small>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('index-store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Indexing Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  is-invalid" name="indexing_name"
                                    id="basic-default-name" placeholder="Enter the Indexing Name"
                                    value="{{ old('indexing_name') }}" />

                                @if ($errors->has('indexing_name'))
                                    <div class="invalid-feedback"><strong>{{ $errors->first('indexing_name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="index-url">Indexing URL</label>
                            <div class="col-sm-10">
                                <input type="text" name="indexing_url" class="form-control is-invalid" id="index-url"
                                    placeholder="Indexing URL" value="{{ old('indexing_url') }}" />
                                @if ($errors->has('indexing_url'))
                                    <span class="invalid-feedback">
                                        <Strong>{{ $errors->first('indexing_url') }}</Strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar"
                                class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" style="object-fit:contain;" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload"
                                        class="account-file-input @if ($errors->has('indexing_image_url')) {{ 'is-invalid' }} @endif"
                                        name="indexing_image_url" hidden accept="image/png, image/jpeg"
                                        value="{{ old('indexing_image_url') }}" />
                                </label>
                                <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                    id="resetImage">
                                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div class="text-danger">
                                    <Strong>{{ $errors->first('indexing_image_url') }}</Strong>
                                </div>

                                <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                <div id="imageName" class="mt-2"></div>

                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">ADD</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                <a href="{{ route('index-home') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadInput = document.getElementById("upload");
            const uploadedAvatar = document.getElementById("uploadedAvatar");
            const resetButton = document.getElementById("resetImage");
            const imageName = document.getElementById("imageName");

            // Handle Image Upload
            uploadInput.addEventListener("change", function(event) {
                const file = event.target.files[0]; // Get the selected file
                if (file) {

                    // Create a FileReader to display the image
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        uploadedAvatar.src = e.target.result; // Set image src to preview image
                        // Show the image attributes after it's loaded
                        const img = new Image();
                        img.src = e.target.result; // Load the image to get dimensions
                    };

                    reader.readAsDataURL(file); // Read the file as a data URL
                    imageName.innerHTML = `<strong> Selected Image:</strong> ${file.name} `;
                }
            });

            // Reset Image
            resetButton.addEventListener("click", function() {
                uploadedAvatar.src = "{{ asset('assets/img/avatars/1.png') }}"; // Reset image to default
                uploadInput.value = ''; // Reset the file input
                imageName.textContent = '';
            });
        });
    </script>
