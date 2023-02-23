@extends('admin.layouts.main')
@section('content')
<section class="h-100 bg-image"  style="margin-top:8%; margin-left:5%">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h1 class="text-uppercase text-center mb-5">update Category</h1>
              @if (Session::has('error'))
              <p class="text-danger">{{ Session::get('error') }}</p>
          @endif
          @if (Session::has('success'))
              <p class="text-success">{{ Session::get('success') }}</p>
          @endif
              <form method="post" action="">
                @csrf
                @method('put')
                <div class="form-outline mb-4">
                    <input type="text"  name="name"class="form-control form-control-lg" value="{{ $category->name }}"/>
                    <label class="form-label">Name</label>
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" name="description"class="form-control form-control-lg" value="{{ $category->description }}" />
                    <label class="form-label">Description</label>
                    <span class="text-danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </span>
                  </div>

                    <div class="text-center mt-5">
                        <input type="submit" class="btn btn-primary" value="Update" />
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
