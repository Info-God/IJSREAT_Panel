@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body pt-2 mt-1">
                    <h4 class="pt-3">Add Blog</h4>
                    <form id="formAccountSettings" method="POST" action="{{ route('blog-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-1 gy-4">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar"
                                        class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar"
                                        style="object-fit:contain;" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                            <input type="file" id="upload"
                                                class="account-file-input @if ($errors->has('image')) {{ 'is-invalid' }} @endif"
                                                name="image" hidden value="{{ old('image') }}" />
                                        </label>
                                        <button type="button" class="btn btn-outline-danger account-image-reset mb-3"
                                            id="resetImage">
                                            <i class="mdi mdi-reload d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>

                                        <div class="text-danger">
                                            <Strong>{{ $errors->first('image') }}</Strong>
                                        </div>

                                        <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 2MB</div>
                                        <div id="imageName" class="mt-2"></div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control @if ($errors->has('description')) {{ 'is-invalid' }} @endif" id="validationTextarea"
                                        placeholder="Content" name="description" rows="10">{{ old('description') }}</textarea>
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
                                    <input type="text" class="form-control @if ($errors->has('title')) {{ 'is-invalid' }} @endif"
                                        id="title" placeholder="Title" name="title" value="{{ old('title') }}" />
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
                                    <input  type="text"
                                        class="form-control @if ($errors->has('category')) {{ 'is-invalid' }} @endif"
                                        id="category" placeholder="Category" name="category"
                                        value="{{ old('category') }}" />
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
                                    <input  type="text"
                                        class="form-control @if ($errors->has('meta_title')) {{ 'is-invalid' }} @endif"
                                        id="meta_title" placeholder="Meta Title" name="meta_title"
                                        value="{{ old('meta_title') }}" />
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
                                    <input  type="text"
                                        class="form-control @if ($errors->has('meta_description')) {{ 'is-invalid' }} @endif"
                                        id="meta_description" placeholder="Meta Description" name="meta_description"
                                        value="{{ old('meta_description') }}" />
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
                                    <input  type="text"
                                        class="form-control @if ($errors->has('tags')) {{ 'is-invalid' }} @endif"
                                        id="tags" placeholder="Tags" name="tags" value="{{ old('tags') }}" />
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
                    </form>
                </div>
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
