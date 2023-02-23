@extends('layouts.main')
@section('content')
<section class="h-100 bg-image">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h1 class="text-uppercase text-center mb-5">ADD Post</h1>
                            @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                            @endif
                            @if (Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                            @endif
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf

                                <div class="form-outline mb-4">
                                    <input type="text" name="title" class="form-control form-control-lg" />
                                    <label class="form-label">Your Title</label>
                                    <span class="text-danger">
                                        @error('title')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-outline mb-4">
                                    <textarea type="text" name="description"
                                        class="form-control form-control-lg"></textarea>
                                    <label class="form-label">description</label>
                                    <span class="text-danger">
                                        @error('description')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="">Upload Image</label>
                                    <input type="file" name="image" class="course form-control">
                                    <span class="text-danger">
                                        @error('image')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="body">
                                    <div class="form-group form-float">
                                        <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                            <label for="category">Select Category</label>
                                            <select name="categories[]" id="category" class="form-control show-tick"
                                                data-live-search="true" multiple>
                                                @foreach ($category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">
                                            @error('categories')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div><br>

                                    <div class="text-center mt-5">
                                        <input type="submit" class="btn btn-primary" value=" Add Post " />
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
